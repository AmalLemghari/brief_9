<?php
require_once('../model/userModel.php');

class usercontroller
{

    public function Register()
    {
        $error = ""; // Initialize an empty error message

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
            $user = new UserModel();
            $role = 'membre';
            $user->setnom($_POST['nom']);
            $user->setprenom($_POST['prenom']);
            $user->setemail($_POST['email']);
            $user->setpass($_POST['pass']);
            $user->settel($_POST['tel']);
            $user->setrole($role);
            $error = $user->register(); // Capture the error message

            if (empty($error)) {
                header('Location: ../view/login.php');
                exit();
            }

            return $error; // Return the error message

        }
    }
    public function login()
    {
        if (isset($_POST['submit']) && isset($_POST['pass']) && isset($_POST['email'])) {
            $user = new UserModel();
            $user->setemail($_POST['email']);
            $user->setpass($_POST['pass']);
            if($user->login()){
                header("Location: ../view/dashboard.php");
                exit();
            }else{
                return "Email or password incorrect";
            }
            
        }
    }
    
    public function logout(){
        if (isset($_GET['deconn'])) {
            $user = new UserModel();
            return $user->logout();
        }
    }

    public function isLoggedIn()
    {
        session_start();

        if (!isset($_SESSION['iduser'])) {
            header("Location: login.php");
            exit();
        }
    }
}
