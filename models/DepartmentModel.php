<?php

class DepartmentModel
{
    private $db;
    private $table = 'department';

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

    public function getAllDepartments()
    {
        $sql = "SELECT * FROM $this->table";
        $result = $this->db->query($sql);
        $departments = $result->fetch_all(MYSQLI_ASSOC);
        
        return $departments;
    }

    public function createDepartment($department_name, $description)
    {
        $sql = "INSERT INTO $this->table VALUES (NULL, '$department_name', '$description');";
        $result = $this->db->query($sql);
        
        return $result;
    }

    public function editDepartment($id, $department_name, $description)
    {
        $sql = "UPDATE $this->table SET `department_name` = '$department_name', `description` = '$description' WHERE `department_id` = '$id';";
        $result = $this->db->query($sql);
        
        return $result;
    }

    public function deleteDepartment($id)
    {
        $sql = "DELETE FROM $this->table WHERE `department_id` = '$id';";
        $result = $this->db->query($sql);
        
        return $result;
    }

    // Probably, will use this function in the future...
    public function getDepartmentById($departmentId)
    {
        $sql = "SELECT * FROM $this->table WHERE department_id = '$departmentId'";
        $result = $this->db->query($sql);
        $department = $result->fetch_assoc();

        return $department;
    }

}
