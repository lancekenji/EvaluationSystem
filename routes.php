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
    '/admin/manage' => 'Admin@editUser1',

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
    '/admin/professors/list/{department_id}' => 'Admin@getProfessorByDepartment',

    '/admin/students' => 'Admin@students',
    '/admin/students/create' => 'Admin@createStudent',
    '/admin/students/delete' => 'Admin@deleteStudent',
    '/admin/students/edit' => 'Admin@editStudent',
    '/admin/students/list' => 'Admin@listStudent',

    '/admin/evaluation' => 'Admin@evaluation',

    '/admin/category/list' => 'Admin@listCategory',
    '/admin/category/create' => 'Admin@createCategory',
    '/admin/category/delete' => 'Admin@deleteCategory',
    '/admin/category/edit' => 'Admin@editCategory',

    '/admin/questions/{id}' => 'Admin@questions',
    '/admin/questions/{id}/list' => 'Admin@listQuestion',
    '/admin/questions/{id}/create' => 'Admin@createQuestion',
    '/admin/questions/{id}/delete' => 'Admin@deleteQuestion',
    '/admin/questions/{id}/edit' => 'Admin@editQuestion',

    '/admin/result' => 'Admin@result',
    '/admin/result/{professor_id}/count' => 'Admin@countEvaluatedStudent',
    '/admin/result/{professor_id}/total' => 'Admin@total',
    '/admin/result/{professor_id}/{department_id}/print' => 'Admin@printResult',
    
    '/admin/users' => 'Admin@users',
    '/admin/users/list' => 'Admin@listUsers',
    '/admin/users/create' => 'Admin@createUser',
    '/admin/users/delete' => 'Admin@deleteUser',
    '/admin/users/edit' => 'Admin@editUser',

    // Student routes
    '/student/dashboard' => 'Student@index',
    '/student/evaluate' => 'Student@evaluate',
    '/student/professor/{id}/list' => 'Student@getProfessorNames',
    '/student/evaluate/check/{id}' => 'Student@check',
    '/student/evaluate/submit' => 'Student@submitEvaluation',
    '/student/manage' => 'Student@editStudent',

    // Professor routes
    '/professor/dashboard' => 'Professor@index',
    '/professor/result' => 'Professor@result',
    '/professor/result/count' => 'Professor@countEvaluatedStudent',
    '/professor/result/total' => 'Professor@total',
    '/professor/result/print' => 'Professor@printResult',
    '/professor/manage' => 'Professor@editProfessor',

];
