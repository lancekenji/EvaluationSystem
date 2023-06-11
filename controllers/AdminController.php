<?php
session_start();

class AdminController
{
    private $departmentModel, $sectionModel, $professorModel, $studentModel, $userModel, $categoryModel, $questionModel;

    public function __construct()
    {
        if (!isset($_SESSION['user_id']) && $_SESSION['role'] !== 'admin') {
            header('Location: /');
        }

        $this->departmentModel = new DepartmentModel();
        $this->sectionModel = new SectionModel();
        $this->professorModel = new ProfessorModel();
        $this->studentModel = new StudentModel();
        $this->userModel = new UserModel();
        $this->categoryModel = new CategoryModel();
        $this->questionModel = new QuestionModel();
    }

    public function index()
    {
        loadView('admin/dashboard');
    }

    /* START Department Actions */

    public function department()
    {
        loadView('admin/department');
    }

    public function createDept()
    {

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = $_POST['department_name'];
            $desc = $_POST['description'];
            $department = $this->departmentModel->createDepartment($name, $desc);

            if ($department) {
                echo (json_encode(['success' => 'true']));
                return $department;
            }
            echo (json_encode(['success' => 'false']));

            return false;
        }
    }

    public function deleteDept()
    {

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['department_id'];
            $department = $this->departmentModel->deleteDepartment($id);

            if ($department) {
                if ($department) {
                    echo (json_encode(['success' => 'true']));
                    return $department;
                }
                echo (json_encode(['success' => 'false']));

                return false;
            }
        }
    }

    public function editDept()
    {

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['department_id'];
            $name = $_POST['department_name'];
            $desc = $_POST['description'];

            $department = $this->departmentModel->editDepartment($id, $name, $desc);

            if ($department) {
                if ($department) {
                    echo (json_encode(['success' => 'true']));
                    exit;
                }
                echo (json_encode(['success' => 'false']));

                return false;
            }
        }
    }

    public function listDept()
    {
        $department = $this->departmentModel->getAllDepartments();
        echo json_encode($department);

        return $department;
    }

    /* END Department Actions */

    /* START Section Actions */

    public function section()
    {
        loadView('admin/section');
    }

    public function createSection(){
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = $_POST['section_name'];
            $section = $this->sectionModel->createSection($name);

            if ($section) {
                echo (json_encode(['success' => 'true']));
                return $section;
            }
            echo (json_encode(['success' => 'false']));

            return false;
        }
    }

    public function editSection()
    {

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['section_id'];
            $name = $_POST['section_name'];

            $section = $this->sectionModel->editSection($id, $name);

            if ($section) {
                if ($section) {
                    echo (json_encode(['success' => 'true']));
                    exit;
                }
                echo (json_encode(['success' => 'false']));

                return false;
            }
        }
    }

    public function deleteSection()
    {

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['section_id'];
            $section = $this->sectionModel->deleteSection($id);

            if ($section) {
                if ($section) {
                    echo (json_encode(['success' => 'true']));
                    return $section;
                }
                echo (json_encode(['success' => 'false']));

                return false;
            }
        }
    }

    public function listSection()
    {
        $section = $this->sectionModel->getAllSections();
        echo json_encode($section);

        return $section;
    }

    /* END Section Actions */

    /* START Professors Actions */

    public function professors()
    {
        loadView('admin/professors');
    }

    public function createProfessor()
    {

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $fname = $_POST['fname'];
            $lname = $_POST['lname'];
            $email = $_POST['email'];
            $password = md5($_POST['password']);
            $department_id = $_POST['department_id'];
            $professor = $this->professorModel->createProfessor($fname, $lname, $email, $password, $department_id);

            if ($professor) {
                echo (json_encode(['success' => 'true']));
                return $professor;
            }
            echo (json_encode(['success' => 'false']));

            return false;
        }
    }

    public function deleteProfessor()
    {

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['professor_id'];
            $professor = $this->professorModel->deleteProfessor($id);

            if ($professor) {
                if ($professor) {
                    echo (json_encode(['success' => 'true']));
                    return $professor;
                }
                echo (json_encode(['success' => 'false']));

                return false;
            }
        }
    }

    public function editProfessor()
    {

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['professor_id'];
            $fname = $_POST['fname'];
            $lname = $_POST['lname'];
            $email = $_POST['email'];
            if(!isset($_POST['password']) || empty($_POST['password'])){
                $password = '';
            } else {
                $password = $_POST['password'];
            }
            $department_id = $_POST['department_id'];

            $professor = $this->professorModel->editProfessor($id, $fname, $lname, $email, $password, $department_id);

            if ($professor) {
                if ($professor) {
                    echo (json_encode(['success' => 'true']));
                    exit;
                }
                echo (json_encode(['success' => 'false']));

                return false;
            }
        }
    }

    public function listProfessor()
    {
        $professor = $this->professorModel->getAllProfessors();
        if($professor) {
            foreach ($professor as &$item) {
                $department = $this->departmentModel->getDepartmentById($item['department_id']);
                $item['department_name'] = $department['department_name'];
            }            
            echo json_encode($professor);

            return $professor;
        }

        echo json_encode($professor);
        return false;
    }

    /* END Professors Actions */

    /* START Students Actions */

    public function students()
    {
        loadView('admin/students');
    }

    public function createStudent()
    {

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $fname = $_POST['fname'];
            $lname = $_POST['lname'];
            $email = $_POST['email'];
            $password = md5($_POST['password']);
            $department_id = $_POST['department_id'];
            $year_level = $_POST['year_level'];
            $section_id = $_POST['section'];
            $student = $this->studentModel->createStudent($fname, $lname, $email, $password, $year_level, $department_id, $section_id);

            if ($student) {
                echo (json_encode(['success' => 'true']));
                return $student;
            }
            echo (json_encode(['success' => 'false']));

            return false;
        }
    }

    public function deleteStudent()
    {

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['student_id'];
            $student = $this->studentModel->deleteStudent($id);

            if ($student) {
                if ($student) {
                    echo (json_encode(['success' => 'true']));
                    return $student;
                }
                echo (json_encode(['success' => 'false']));

                return false;
            }
        }
    }

    public function editStudent()
    {

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['student_id'];
            $fname = $_POST['fname'];
            $lname = $_POST['lname'];
            $email = $_POST['email'];
            $year_level = $_POST['year_level'];
            $section_id = $_POST['section'];
            if(!isset($_POST['password']) || empty($_POST['password'])){
                $password = '';
            } else {
                $password = $_POST['password'];
            }
            $department_id = $_POST['department_id'];

            $student = $this->studentModel->editStudent($id, $fname, $lname, $email, $password, $year_level, $department_id, $section_id);

            if ($student) {
                if ($student) {
                    echo (json_encode(['success' => 'true']));
                    exit;
                }
                echo (json_encode(['success' => 'false']));

                return false;
            }
        }
    }

    public function listStudent()
    {
        $student = $this->studentModel->getAllStudents();
        if($student) {
            foreach ($student as &$item) {
                $department = $this->departmentModel->getDepartmentById($item['department_id']);
                $item['department_name'] = $department['department_name'];
                $section = $this->sectionModel->getSectionById($item['section_id']);
                $item['section_name'] = $section['section_name'];
            }            
            echo json_encode($student);

            return $student;
        }

        echo json_encode($student);
        return false;
    }

    /* END Students Actions */

    /* START Question Actions */

    public function questions($id)
    {
        loadView('admin/questions');
    }

    public function listQuestion($id)
    {
        $question = $this->questionModel->getAllQuestionByCategoryId($id);
        echo json_encode($question);

        return $question;
    }

    public function createQuestion($id){
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $question_text = $_POST['question_text'];
            $category_id = $_POST['category_id'];
            $question = $this->questionModel->createQuestion($question_text, $category_id);

            if ($question) {
                echo (json_encode(['success' => 'true']));
                return $question;
            }
            echo (json_encode(['success' => 'false']));

            return false;
        }
    }

    public function editQuestion($id)
    {

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $question_id = $_POST['question_id'];
            $question_text = $_POST['question_text'];
            $category_id = $_POST['category_id'];

            $question = $this->questionModel->editQuestion($question_id, $question_text, $category_id);

            if ($question) {
                if ($question) {
                    echo (json_encode(['success' => 'true']));
                    exit;
                }
                echo (json_encode(['success' => 'false']));

                return false;
            }
        }
    }

    public function deleteQuestion($id)
    {

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $question_id = $_POST['question_id'];
            $question = $this->questionModel->deleteQuestion($question_id);

            if ($question) {
                if ($question) {
                    echo (json_encode(['success' => 'true']));
                    return $question;
                }
                echo (json_encode(['success' => 'false']));

                return false;
            }
        }
    }

    /* END Question Actions */
    /* START Evaluation Actions */

    public function evaluation()
    {
        loadView('admin/evaluation');
    }

    public function listCategory()
    {
        $category = $this->categoryModel->getAllCategory();
        echo json_encode($category);

        return $category;
    }

    public function createCategory(){
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = $_POST['category_name'];
            $category = $this->categoryModel->createCategory($name);

            if ($category) {
                echo (json_encode(['success' => 'true']));
                return $category;
            }
            echo (json_encode(['success' => 'false']));

            return false;
        }
    }

    public function editCategory()
    {

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['category_id'];
            $name = $_POST['category_name'];

            $category = $this->categoryModel->editCategory($id, $name);

            if ($category) {
                if ($category) {
                    echo (json_encode(['success' => 'true']));
                    exit;
                }
                echo (json_encode(['success' => 'false']));

                return false;
            }
        }
    }

    public function deleteCategory()
    {

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['category_id'];
            $category = $this->categoryModel->deleteCategory($id);

            if ($category) {
                if ($category) {
                    echo (json_encode(['success' => 'true']));
                    return $category;
                }
                echo (json_encode(['success' => 'false']));

                return false;
            }
        }
    }

    /* END Evaluation Actions */

    /* START Users Actions */
    
    public function users()
    {
        loadView('admin/users');
    }

    public function createUser()
    {

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'username' => $_POST['username'],
                'password' => md5($_POST['password']),
                'name' => $_POST['name']
            ];
            $user = $this->userModel->createUser($data);

            if ($user) {
                echo (json_encode(['success' => 'true']));
                return $user;
            }
            echo (json_encode(['success' => 'false']));

            return false;
        }
    }

    public function deleteUser()
    {

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['user_id'];
            $user = $this->userModel->deleteUser($id);

            if ($user) {
                if ($user) {
                    echo (json_encode(['success' => 'true']));
                    return $user;
                }
                echo (json_encode(['success' => 'false']));

                return false;
            }
        }
    }

    public function editUser()
    {

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['user_id'];
            $name = $_POST['name'];
            $email = $_POST['username'];
            if(!isset($_POST['password']) || empty($_POST['password'])){
                $password = '';
            } else {
                $password = $_POST['password'];
            }

            $user = $this->userModel->editUser($id, $email, $password, $name);

            if ($user) {
                if ($user) {
                    echo (json_encode(['success' => 'true']));
                    exit;
                }
                echo (json_encode(['success' => 'false']));

                return false;
            }
        }
    }

    public function listUsers()
    {
        $users = $this->userModel->getAllUsers();
        echo json_encode($users);

        return $users;
    }

    /* END Users Actions */
}
