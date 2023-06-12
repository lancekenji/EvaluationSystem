<?php

class EvaluationModel
{
    private $db;
    private $table = 'evaluation_result';
    private $table1 = 'evaluation';
    private $date;

    public function __construct()
    {
        // Connect to the database
        $host = 'localhost';
        $user = 'root';
        $password = '';
        $dbname = 'evaluation_db';
        // mysqli connection
        $this->db = new mysqli($host, $user, $password, $dbname);
        $this->date = new DateTime('now', new DateTimeZone('Asia/Manila'));
    }

    public function getAllEvaluationResults()
    {
        $sql = "SELECT * FROM $this->table";
        $result = $this->db->query($sql);
        $results = $result->fetch_all(MYSQLI_ASSOC);
        
        return $results;
    }

    public function insertSubmission($question_id, $student_id, $professor_id, $response_value)
    {
        $sql = "INSERT INTO $this->table1 VALUES (NULL, '".$this->date->format('Y-m-d')."');";
        $result = $this->db->query($sql);

        if($result)
        {
            $evaluation_id = $this->db->insert_id;
            $sql = "INSERT INTO $this->table VALUES (NULL, '$evaluation_id', '$question_id', '$student_id', '$professor_id', '$response_value');";
            $result = $this->db->query($sql);
        }
        
        return $result;
    }

    public function checkStudentEvaluation($student_id, $professor_id)
    {
        $sql = "SELECT response_id FROM $this->table WHERE student_id = '$student_id' AND professor_id = '$professor_id'";
        $result = $this->db->query($sql);
        $results = $result->fetch_all(MYSQLI_ASSOC);
        
        if(empty($results)){
            $results = array();
        }
        
        return $results;
    }

    public function countEvaluated($professor_id)
    {
        $sql = "SELECT COUNT(DISTINCT student_id) as student_count FROM evaluation_result WHERE professor_id = '$professor_id'";
        $result = $this->db->query($sql);
        $results = $result->fetch_assoc();

        return $results;
    }

    public function calculateEvaluation($professor_id, $question_id)
    {
        $sql = "SELECT 
        COUNT(DISTINCT student_id) as total_respondents, 
        SUM(response_value = 5) as answered_5_count, 
        SUM(response_value = 4) as answered_4_count, 
        SUM(response_value = 3) as answered_3_count, 
        SUM(response_value = 2) as answered_2_count, 
        SUM(response_value = 1) as answered_1_count 
        FROM evaluation_result 
        WHERE professor_id = '$professor_id' AND question_id = '$question_id';
        ";
        $result = $this->db->query($sql);
        $results = $result->fetch_assoc();

        return $results;
    }

    public function editCategory($id, $category_name)
    {
        $sql = "UPDATE $this->table SET `category_name` = '$category_name' WHERE `category_id` = '$id';";
        $result = $this->db->query($sql);
        
        return $result;
    }

    public function deleteCategory($id)
    {
        $sql = "DELETE FROM $this->table WHERE `category_id` = '$id';";
        $result = $this->db->query($sql);
        
        return $result;
    }
}
?>