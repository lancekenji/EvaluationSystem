<?php

class ProfessorModel
{
    private $db;
    private $table = 'professor';

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

    public function getAllProfessors()
    {
        $sql = "SELECT * FROM $this->table";
        $result = $this->db->query($sql);
        $professors = $result->fetch_all(MYSQLI_ASSOC);
        
        return $professors;
    }

    public function createProfessor($fname, $lname, $email, $password, $department_id)
    {
        $sql = "INSERT INTO $this->table VALUES (NULL, '$fname', '$lname', '$email', '$password', '$department_id');";
        $result = $this->db->query($sql);
        
        return $result;
    }

    public function editProfessor($id, $fname, $lname, $email, $password, $department_id)
    {
        if(empty($password)){
            $sql = "UPDATE $this->table SET `fname` = '$fname', `lname` = '$lname', `email` = '$email', `department_id` = '$department_id' WHERE `professor_id` = '$id';";
        } else {
            $password = md5($password);
            $sql = "UPDATE $this->table SET `fname` = '$fname', `lname` = '$lname', `email` = '$email', `password` = '$password', `department_id` = '$department_id' WHERE `professor_id` = '$id';";
        }
        $result = $this->db->query($sql);

        return $result;
    }


    public function deleteProfessor($id)
    {
        $sql = "DELETE FROM $this->table WHERE `professor_id` = '$id';";
        $result = $this->db->query($sql);
        
        return $result;
    }

    // Probably, will use this function in the future...
    public function getProfessorById($professorId)
    {
        $sql = "SELECT * FROM $this->table WHERE professor_id = '$professorId'";
        $result = $this->db->query($sql);
        $professor = $result->fetch_assoc();

        return $professor;
    }

}
