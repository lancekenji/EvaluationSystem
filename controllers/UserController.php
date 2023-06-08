<?php
session_start();

class UserController {
    private $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function login() {
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $username = $_POST['username'];
            $password = $_POST['password'];
            $role = $_POST['role'];
            $user = $this->userModel->getUserByUsernameAndRole($username, $role);

            if($user) {
                if(md5($password) == $user['password']){
                    $_SESSION['user_id'] = $user['id'];
                    $_SESSION['role'] = $user['role'];
                    echo(json_encode(['success' => 'true']));
                    exit;
                }
            }

            echo(json_encode(['success' => 'false']));
            return false;
        }
    }

    public function logout() {
        $_SESSION = array();

        if(ini_get('session.use_cookies')){
            $params = session_get_cookie_params();
            setcookie(
                session_name(), '', time() - 42000,
                $params['path'], $params["domain"], $params["secure"], $params['httpOnly"]']
            );
        }

        session_destroy();
        header("Location: /");
        exit;
    }
}
