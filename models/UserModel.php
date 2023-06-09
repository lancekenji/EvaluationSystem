<?php

class UserModel
{

    private $db;
    private $table = 'users';

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

    public function getAllUsers()
    {
        $sql = "SELECT * FROM $this->table";
        $result = $this->db->query($sql);
        $users = $result->fetch_all(MYSQLI_ASSOC);
        return $users;
    }

    public function createUser($userData)
    {
        $username = $userData['username'];
        $password = md5($userData['password']);
        $name = $userData['name'];
        $sql = "INSERT INTO `$this->table` VALUES (NULL, '$username', '$password', '$name');";

        $result = $this->db->query($sql);
        return $result;
    }

    public function editUser($id, $username, $password, $name)
    {
        if(empty($password)){
            $sql = "UPDATE $this->table SET `name` = '$name', `username` = '$username', `name` = '$name' WHERE `user_id` = '$id';";
        } else {
            $password = md5($password);
            $sql = "UPDATE $this->table SET `name` = '$name', `username` = '$username', `name` = '$name', `password` = '$password' WHERE `user_id` = '$id';";
        }
        $result = $this->db->query($sql);

        return $result;
    }

    public function deleteUser($id)
    {
        $sql = "DELETE FROM $this->table WHERE `user_id` = '$id';";
        $result = $this->db->query($sql);
        
        return $result;
    }

    public function getUserById($userId)
    {
        $sql = "SELECT * FROM $this-table WHERE user_id = '$userId'";
        $result = $this->db->query($sql);
        $id = $result->fetch_assoc();

        return $id;
    }

    public function getUserByUsername($userName)
    {
        $sql = "SELECT * FROM $this->table WHERE username = '$userName'";
        $result = $this->db->query($sql);
        $user = $result->fetch_assoc();

        return $user;
    }

    // Add more methods as needed for user-related operations
}
