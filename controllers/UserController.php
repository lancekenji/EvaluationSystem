<?php
session_start();

class UserController {
    private $userModel, $studentModel, $professorModel, $sectionModel, $departmentModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->studentModel = new StudentModel();
        $this->professorModel = new ProfessorModel();
        $this->sectionModel = new SectionModel();
        $this->departmentModel = new DepartmentModel();
    }

    public function login() {
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $username = $_POST['username'];
            $password = $_POST['password'];
            $role = $_POST['role'];
            $user = $this->userModel->getUserByUsername($username);
            $student = $this->studentModel->getStudentByEmail($username);
            $professor = $this->professorModel->getProfessorByEmail($username);

            if($role == '1'){
                if($user) {
                    if(md5($password) == $user['password']){
                        $_SESSION['user_id'] = $user['user_id'];
                        $_SESSION['role'] = 'admin';
                        $_SESSION['name'] = $user['name'];
                        echo(json_encode(['success' => 'admin']));
                        exit;
                    }
                }
            } elseif($role == '2'){
                if($professor) {
                    if(md5($password) == $professor['password']){
                        $department = $this->departmentModel->getDepartmentById($professor['department_id']);
                        $_SESSION['user_id'] = $professor['professor_id'];
                        $_SESSION['role'] = 'professor';
                        $_SESSION['name'] = $professor['fname'].' '.$professor['lname'];
                        $_SESSION['department'] = $department['department_name'];
                        echo(json_encode(['success' => 'professor']));
                        exit;
                    }
                }
            } elseif($role == '3'){
                if($student) {
                    if(md5($password) == $student['password']){
                        $section = $this->sectionModel->getSectionById($student['section_id']);
                        $department = $this->departmentModel->getDepartmentById($student['department_id']);
                        $_SESSION['user_id'] = $student['student_id'];
                        $_SESSION['role'] = 'student';
                        $_SESSION['name'] = $student['fname'].' '.$student['lname'];
                        $_SESSION['section'] = $section['section_name'];
                        $_SESSION['department'] = $department['department_name'];
                        echo(json_encode(['success' => 'student']));
                        exit;
                    }
                }
            }

            echo(json_encode(['success' => 'false']));
            return false;
        }
    }

    public function logout() {
        $_SESSION = array();

        if(ini_get('session.use_cookies')){
            $params = session_get_cookie_params();
            setcookie(
                session_name(), '', time() - 42000,
                $params['path'], $params["domain"], $params["secure"], $params['httpOnly"]']
            );
        }

        session_destroy();
        header("Location: /");
        exit;
    }
}
