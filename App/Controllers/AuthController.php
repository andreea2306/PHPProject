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
        return $this->view("user/login.html");
    }

    public function loginPOST(){

        $email  = $_POST["email"];
        $pass  = $_POST["password"];
        $userModel = new User();
        $result = $userModel->checkUser($email, $pass);

        if($result){

                echo "Login successful";
                session_start();
                $_SESSION["Username"] = $result["Username"];
            }
        else{
            session_start();
            $_SESSION["Errors"] = "invalid credentials";
            header("Location: /auth/login");
        }
    }


}