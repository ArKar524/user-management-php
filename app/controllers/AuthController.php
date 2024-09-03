<?php

class Auth extends Controller
{



    public function index()
    {
        if (isset($_SESSION['authUser'])) {
            header('Location: ' . ROOT . 'url=home');
            exit();
        }
        $this->view('auth/login');
    }

    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];
            $userModel = new UserModel();
            $user = $userModel->find($email, 'email');
            if (($user->password === $password) && $user->is_active == 1) {
                $_SESSION['authUser'] = $user;
                header('Location: ' . ROOT . 'url=home');
            } else {
                header('Location: ' . ROOT . 'url=auth');
            }
        }
    }
    public function logout()
    {
        unset($_SESSION['authUser']);
        header('Location: ' . ROOT . 'url=auth');
    }
}