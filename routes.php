<?php

return [
    // User routes
    '/logout' => 'User@logout',
    '/login_ajax' => 'User@login',
    
    // Home routes
    '/' => 'Home@index',
    '/login' => 'Home@login',
    '/register' => 'Home@register',
    
    // Evaluation routes
    '/evaluation' => 'Evaluation@index',
    '/evaluation/create' => 'Evaluation@create',

    // Admin routes
    '/admin/dashboard' => 'Admin@index',

    '/admin/department' => 'Admin@department',
    '/admin/department/create' => 'Admin@createDept',
    '/admin/department/delete' => 'Admin@deleteDept',
    '/admin/department/edit' => 'Admin@editDept',
    '/admin/department/list' => 'Admin@listDept',

    '/admin/section' => 'Admin@section',
    '/admin/section/create' => 'Admin@createSection',
    '/admin/section/delete' => 'Admin@deleteSection',
    '/admin/section/edit' => 'Admin@editSection',
    '/admin/section/list' => 'Admin@listSection',

    '/admin/professors' => 'Admin@professors',
    '/admin/professors/create' => 'Admin@createProfessor',
    '/admin/professors/delete' => 'Admin@deleteProfessor',
    '/admin/professors/edit' => 'Admin@editProfessor',
    '/admin/professors/list' => 'Admin@listProfessor',

    '/admin/students' => 'Admin@students',

    '/admin/students/create' => 'Admin@createStudent',
    '/admin/students/delete' => 'Admin@deleteStudent',
    '/admin/students/edit' => 'Admin@editStudent',
    '/admin/students/list' => 'Admin@listStudent',

    '/admin/evaluation' => 'Admin@evaluation',
    '/admin/users' => 'Admin@users',
];
