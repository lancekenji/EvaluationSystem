<?php

class SectionModel
{
    private $db;
    private $table = 'section';

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

    public function getAllSections()
    {
        $sql = "SELECT * FROM $this->table";
        $result = $this->db->query($sql);
        $sections = $result->fetch_all(MYSQLI_ASSOC);
        
        return $sections;
    }

    public function createSection($section_name)
    {
        $sql = "INSERT INTO $this->table VALUES (NULL, '$section_name');";
        $result = $this->db->query($sql);
        
        return $result;
    }

    public function editSection($id, $section_name)
    {
        $sql = "UPDATE $this->table SET `section_name` = '$section_name' WHERE `section_id` = '$id';";
        $result = $this->db->query($sql);
        
        return $result;
    }

    public function deleteSection($id)
    {
        $sql = "DELETE FROM $this->table WHERE `section_id` = '$id';";
        $result = $this->db->query($sql);
        
        return $result;
    }

    // Probably, will use this function in the future...
    public function getSectionById($sectionId)
    {
        $sql = "SELECT * FROM $this->table WHERE section_id = '$sectionId'";
        $result = $this->db->query($sql);
        $section = $result->fetch_assoc();

        return $section;
    }

}
