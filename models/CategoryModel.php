<?php

class CategoryModel
{
    private $db;
    private $table = 'category';

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

    public function getAllCategory()
    {
        $sql = "SELECT * FROM $this->table";
        $result = $this->db->query($sql);
        $category = $result->fetch_all(MYSQLI_ASSOC);
        
        return $category;
    }

    public function createCategory($category_name)
    {
        $sql = "INSERT INTO $this->table VALUES (NULL, '$category_name');";
        $result = $this->db->query($sql);
        
        return $result;
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