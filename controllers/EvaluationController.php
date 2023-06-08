<?php

class EvaluationController
{
    public function index()
    {
        // Retrieve data from the model
        $data = [
            'title' => 'Welcome to My App',
            'content' => 'This is the home page.',
        ];
        // Render the view with the data
        loadView('home', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Create a new product',
            'content' => 'This is the create page.',
        ];
        loadView('evaluation/create', $data);
    }
}
