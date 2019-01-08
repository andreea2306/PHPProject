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

        return $this->view("user/login.html");
    }

    public function loginPOST(){

        $email  = $_POST["email"];
        $pass  = $_POST["password"];
        $userModel = new User();
        $result = $userModel->checkUser($email, $pass);

        session_start();
        if($result){

                echo "Login successful";
                $_SESSION["Username"] = $result->Username;
                header("Location: /");
            }
        else{
            $_SESSION["Errors"] = "invalid credentials";
            header("Location: /auth/login");
        }
    }

    public function registerGET(){
        return $this->view("user/register.html");
    }

    public function registerPOST(){
        $email  = $_POST["email"];
        $pass  = $_POST["password"];
        $username  = $_POST["username"];

        $userModel = new User();
        $result = $userModel->register( $pass, $email, $username);
    }

    public function logOutPost(){
        session_start();
        session_unset();
        session_destroy();

        header("Location: /auth/login");
    }


}