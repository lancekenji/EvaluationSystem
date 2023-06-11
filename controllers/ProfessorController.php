<?php
session_start();

class ProfessorController
{
    private $professorModel;

    public function __construct()
    {
        if (!isset($_SESSION['user_id']) && $_SESSION['role'] !== 'professor') {
            header('Location: /');
        }

        $this->professorModel = new ProfessorModel();
    }

    public function index()
    {
        loadView('professors/dashboard');
    }
}
?>