<?php
session_start();

class StudentController
{
    private $studentModel, $professorModel, $questionModel, $evaluationModel;

    public function __construct()
    {
        if (!isset($_SESSION['user_id']) && $_SESSION['role'] !== 'student') {
            header('Location: /');
        }

        $this->studentModel = new StudentModel();
        $this->professorModel = new ProfessorModel();
        $this->questionModel = new QuestionModel();
        $this->evaluationModel = new EvaluationModel();
    }

    public function index()
    {
        loadView('students/dashboard');
    }

    public function editStudent()
    {

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['student_id'];
            $fname = $_POST['fname'];
            $lname = $_POST['lname'];
            $email = $_POST['email'];
            $year_level = $_POST['year_level'];
            $section_id = $_POST['section_id'];
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
                $_SESSION['fname'] = $fname;
                $_SESSION['lname'] - $lname;
                $_SESSION['name'] = $fname.' '.$lname;
                $_SESSION['username'] = $email;

                return false;
            }
        }
    }

    public function evaluate()
    {
        loadView('students/evaluate');
    }

    public function check($professor_id)
    {
        $check = $this->evaluationModel->checkStudentEvaluation($_SESSION['user_id'], $professor_id);

        if($check) {
            echo(json_encode($check));
        }
        return $check;
    }

    public function getProfessorNames($id)
    {
        $professors = $this->professorModel->getProfessorByDepartmentID($id);

        if($professors){
            echo(json_encode($professors));
        }

        return $professors;
    }

    public function submitEvaluation()
    {
        if($_SERVER['REQUEST_METHOD'] === 'POST')
        {
            $student_id = $_POST['student_id'];
            $professor_id = $_POST['professor_id'];

            $questions = $this->questionModel->getAllQuestion();
            
            foreach($questions as $question)
            {
                $response_value = $_POST['q'.$question['question_id']];
                $insertSubmission = $this->evaluationModel->insertSubmission($question['question_id'], $student_id, $professor_id, $response_value);

                if(!$insertSubmission)
                {
                    echo(json_encode(['success' => 'false']));
                    return false;
                    break;
                }
            }

            echo(json_encode(['success' => 'true']));
            return $insertSubmission;

        }
    }
}
?>