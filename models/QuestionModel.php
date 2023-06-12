<?php

class QuestionModel
{
    private $db;
    private $table = 'question';

    public function __construct()
    {
        // Connect to the database
        $host = 'localhost';
        $user = 'root';
        $password = '';
        $dbname = 'evaluation_db';
        // mysqli connection
        $this->db = new mysqli($host, $user, $password, $dbname);
    }

    public function getAllQuestionByCategoryId($id)
    {
        $sql = "SELECT * FROM $this->table WHERE category_id = '$id'";
        $result = $this->db->query($sql);
        $category = $result->fetch_all(MYSQLI_ASSOC);
        
        return $category;
    }

    public function getAllQuestion()
    {
        $sql = "SELECT * FROM $this->table";
        $result = $this->db->query($sql);
        $question = $result->fetch_all(MYSQLI_ASSOC);
        
        return $question;
    }

    public function createQuestion($question_text, $category_id)
    {
        $sql = "INSERT INTO $this->table VALUES (NULL, '$category_id', '".$this->db->real_escape_string($question_text)."');";
        $result = $this->db->query($sql);
        
        return $result;
    }

    public function editQuestion($id, $question_text, $category_id)
    {
        $sql = "UPDATE $this->table SET `question_text` = '".$this->db->real_escape_string($question_text)."', `category_id` = '$category_id' WHERE `question_id` = '$id';";
        $result = $this->db->query($sql);
        
        return $result;
    }

    public function deleteQuestion($id)
    {
        $sql = "DELETE FROM $this->table WHERE `question_id` = '$id';";
        $result = $this->db->query($sql);
        
        return $result;
    }
}
?>