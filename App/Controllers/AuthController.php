<?php
/**
 * Created by PhpStorm.
 * User: Andreea
 * Date: 11-Dec-18
 * Time: 10:49
 */

namespace App\Controllers;
use App\Models\User;
use Framework\BaseController;

class AuthController extends BaseController
{

    public function loginGET(){
        session_start();
        $_SESSION["Errors"] = false;

        if($_SESSION["Username"])
            header("Location: /");

        return $this->view("auth/login.html");
    }

    public function loginPOST(){

        $email  = $_POST["email"];
        $pass  = $_POST["password"];
        $userModel = new User();
        $result = $userModel->checkUser($email, $pass);

        if(!isset($_SESSION))
        {
            session_start();
        }
        if($result){

                $_SESSION["Username"] = $result->Username;
                $user = $userModel->isAdmin();
                $isAdmin = true;
                if($user->isAdmin == 0){
                    $isAdmin = false;
                }
                $_SESSION["IsAdmin"] = $isAdmin;
                header("Location: /");
            }
        else{
            $_SESSION["Errors"] = "invalid credentials";
            header("Location: /auth/login");
        }
    }

    public function registerGET(){
        session_start();
        $_SESSION["UniqueError"] = false;

        if($_SESSION["Username"])
            header("Location: /");

        return $this->view("auth/register.html");
    }

    public function registerPOST(){
        $email  = $_POST["email"];
        $pass  = $_POST["password"];
        $username  = $_POST["username"];

        $userModel = new User();
        $usernameDb = $userModel->getByUsername($username);
        if(!$usernameDb){
            $result = $userModel->register( $pass, $email, $username);
            header("Location: /auth/login");}
        else{
            session_start();
            $_SESSION["UniqueError"] = "This username is already taken";
            header("Location: /auth/register");
        }
    }

    public function logOutPost(){
        session_start();
        session_unset();
        session_destroy();

        header("Location: /auth/login");
    }


}