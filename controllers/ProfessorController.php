<?php
session_start();

class ProfessorController
{
    private $professorModel, $evaluationModel, $questionModel;

    public function __construct()
    {
        if (!isset($_SESSION['user_id']) && $_SESSION['role'] !== 'professor') {
            header('Location: /');
        }

        $this->professorModel = new ProfessorModel();
        $this->evaluationModel = new EvaluationModel();
        $this->questionModel = new QuestionModel();
    }

    public function index()
    {
        loadView('professors/dashboard');
    }

    public function result()
    {
        loadView('professors/result');
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
            $department_id = $_SESSION['department_id'];

            $professor = $this->professorModel->editProfessor($id, $fname, $lname, $email, $password, $department_id);

            if ($professor) {
                if ($professor) {
                    echo (json_encode(['success' => 'true']));
                    exit;
                }
                echo (json_encode(['success' => 'false']));
                $_SESSION['fname'] = $fname;
                $_SESSION['lname'] - $lname;
                $_SESSION['name'] = $fname.' '.$lname;
                $_SESSION['username'] = $email;
                $_SESSION['department_id'] = $_SESSION['department_id'];

                return false;
            }
        }
    }

    public function countEvaluatedStudent()
    {
        $count = $this->evaluationModel->countEvaluated($_SESSION['user_id']);
        if($count){
            echo(json_encode($count));
        }

        return $count;
    }

    public function total()
    {
        $questions = $this->questionModel->getAllQuestion();
        $result = [];
        $total1 = [];
        if($questions){
            foreach($questions as $q){
                $id = $q['question_id'];
                $total = $this->evaluationModel->calculateEvaluation($_SESSION['user_id'], $id);
                if($total){
                    $total1['question_text'] = $q['question_text'];
                    try {
                        $total1['percentage5'] = strval(((int) $total['answered_5_count'] / (int) $total['total_respondents']) * 100) . '%';
                    } catch (DivisionByZeroError $e) {
                        $total1['percentage5'] = '0%';
                    }
                    
                    try {
                        $total1['percentage4'] = strval(((int) $total['answered_4_count'] / (int) $total['total_respondents']) * 100) . '%';
                    } catch (DivisionByZeroError $e) {
                        $total1['percentage4'] = '0%';
                    }
                    
                    try {
                        $total1['percentage3'] = strval(((int) $total['answered_3_count'] / (int) $total['total_respondents']) * 100) . '%';
                    } catch (DivisionByZeroError $e) {
                        $total1['percentage3'] = '0%';
                    }
                    
                    try {
                        $total1['percentage2'] = strval(((int) $total['answered_2_count'] / (int) $total['total_respondents']) * 100) . '%';
                    } catch (DivisionByZeroError $e) {
                        $total1['percentage2'] = '0%';
                    }
                    
                    try {
                        $total1['percentage1'] = strval(((int) $total['answered_1_count'] / (int) $total['total_respondents']) * 100) . '%';
                    } catch (DivisionByZeroError $e) {
                        $total1['percentage1'] = '0%';
                    }
                    
                    $result[] = $total1;
                }
            }
        }
        echo(json_encode($result));
        return $result;
    }

    public function printResult()
    {
        $name = $_SESSION['name'];
        $department = $_SESSION['department'];
        $questions = $this->questionModel->getAllQuestion();
        $html = "
        <!DOCTYPE html>
        <html>
        <head>
            <title>Evaluation Report</title>
            <style>
                * {
                    font-family: 'Arial';
                }

                h2 {
                    text-align: center;
                }

                table {
                    margin: 0 auto;
                    border-collapse: collapse;
                }

                th, td {
                    border: 1px solid #000;
                    padding: 8px;
                }

                th {
                    background-color: #f2f2f2;
                }

                @page { size: auto;  margin: 0mm; }
            </style>
        </head>
        <body>
            <h2>Evaluation Report</h2>
            <hr>
            <table>
                <thead>
                    <tr>
                        <th colspan='3'>Professor: ".$name."</th>
                        <th colspan='3'>Department: ".$department."</th>
                    </tr>
                    <tr>
                        <th width='200'>Question</th>
                        <th width='50'>5</th>
                        <th width='50'>4</th>
                        <th width='50'>3</th>
                        <th width='50'>2</th>
                        <th width='50'>1</th>
                    </tr>
                </thead>
                <tbody>
        ";
        if($questions){
            $total1 = [];
            foreach($questions as $q){
                $id = $q['question_id'];
                $total = $this->evaluationModel->calculateEvaluation($_SESSION['user_id'], $id);
                if($total){
                    $html .= '<tr>';
                    try {
                        $total1['percentage5'] = strval(((int) $total['answered_5_count'] / (int) $total['total_respondents']) * 100) . '%';
                    } catch (DivisionByZeroError $e) {
                        $total1['percentage5'] = '0%';
                    }
                    
                    try {
                        $total1['percentage4'] = strval(((int) $total['answered_4_count'] / (int) $total['total_respondents']) * 100) . '%';
                    } catch (DivisionByZeroError $e) {
                        $total1['percentage4'] = '0%';
                    }
                    
                    try {
                        $total1['percentage3'] = strval(((int) $total['answered_3_count'] / (int) $total['total_respondents']) * 100) . '%';
                    } catch (DivisionByZeroError $e) {
                        $total1['percentage3'] = '0%';
                    }
                    
                    try {
                        $total1['percentage2'] = strval(((int) $total['answered_2_count'] / (int) $total['total_respondents']) * 100) . '%';
                    } catch (DivisionByZeroError $e) {
                        $total1['percentage2'] = '0%';
                    }
                    
                    try {
                        $total1['percentage1'] = strval(((int) $total['answered_1_count'] / (int) $total['total_respondents']) * 100) . '%';
                    } catch (DivisionByZeroError $e) {
                        $total1['percentage1'] = '0%';
                    }
                    $html .= '<td>'.$q['question_text'].'</td>';
                    $html .= "<td>".$total1['percentage5'].'</td>';
                    $html .= "<td>".$total1['percentage4'].'</td>';
                    $html .= "<td>".$total1['percentage3'].'</td>';
                    $html .= "<td>".$total1['percentage2'].'</td>';
                    $html .= "<td>".$total1['percentage1'].'</td>';
                    $html .= "</tr>";
                }
            }

            $html .= "</tbody><tfoot><tr>
            <th colspan='6'>Total Students Evaluated: ".$total['total_respondents']."</th>
        </tr></tfoot></table><script>window.print();</script></body></html>";
        }
        echo($html);
        return $html;
    }
}
?>