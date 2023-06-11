<?php
session_start();

class StudentController
{
    private $studentModel;

    public function __construct()
    {
        if (!isset($_SESSION['user_id']) && $_SESSION['role'] !== 'student') {
            header('Location: /');
        }

        $this->studentModel = new StudentModel();
    }

    public function index()
    {
        loadView('students/dashboard');
    }
}
?>