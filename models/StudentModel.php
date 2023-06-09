<?php

class StudentModel
{
    private $db;
    private $table = 'student';

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

    public function getAllStudents()
    {
        $sql = "SELECT * FROM $this->table";
        $result = $this->db->query($sql);
        $students = $result->fetch_all(MYSQLI_ASSOC);
        
        return $students;
    }

    public function createStudent($fname, $lname, $email, $password, $year_level, $department_id, $section_id)
    {
        $sql = "INSERT INTO $this->table VALUES (NULL, '$fname', '$lname', '$email', '$password', '$year_level', '$department_id', $section_id);";
        $result = $this->db->query($sql);
        
        return $result;
    }

    public function editStudent($id, $fname, $lname, $email, $password, $year_level, $department_id, $section_id)
    {
        if(empty($password)){
            $sql = "UPDATE $this->table SET `fname` = '$fname', `lname` = '$lname', `email` = '$email', `department_id` = '$department_id', `year_level` = '$year_level', `section_id` = '$section_id' WHERE `student_id` = '$id';";
        } else {
            $password = md5($password);
            $sql = "UPDATE $this->table SET `fname` = '$fname', `lname` = '$lname', `email` = '$email', `password` = '$password', `department_id` = '$department_id', `year_level` = '$year_level', `section_id` = '$section_id' WHERE `student_id` = '$id';";
        }
        $result = $this->db->query($sql);

        return $result;
    }


    public function deleteStudent($id)
    {
        $sql = "DELETE FROM $this->table WHERE `student_id` = '$id';";
        $result = $this->db->query($sql);
        
        return $result;
    }

    public function getStudentByEmail($email)
    {
        $sql = "SELECT * FROM $this->table WHERE email = '$email'";
        $result = $this->db->query($sql);
        $student = $result->fetch_assoc();

        return $student;
    }

    // Probably, will use this function in the future...
    public function getStudentById($studentId)
    {
        $sql = "SELECT * FROM $this->table WHERE student_id = '$studentId'";
        $result = $this->db->query($sql);
        $student = $result->fetch_assoc();

        return $student;
    }

}
