<?php
/**
 * Created by PhpStorm.
 * User: Andreea
 * Date: 20-Nov-18
 * Time: 10:25
 */

namespace App\Controllers;
use App\Models\User;
use Framework\BaseController;

class UserController extends BaseController
{
    public function updateGET(){

        session_start();
        $username = $_SESSION["Username"];
        $user = new User();
        $result = $user->getByUsername($username);

        return $this->view("user/edit.html",["user" => $result]);
    }

    public function updatePOST(){
        $user = new User();
        $where = array();
        array_push($where, $email ="Email");
        array_push($where, $phone ="Adress");
        array_push($where, $adress ="Telephone");
        $userFromDb = $user->getByUsername($_SESSION["Username"]);
        $id = $userFromDb->Id;

        $data = ['Email' => $_POST["email"], 'Adress' => $_POST["adress"], 'Telephone' => $_POST["phone"]];

        $result = $user->update($data, $id);
        return $this->view("user/edit.html",["user" => $result]);
    }

    public function showAll(){
        $model = new User();
        $result = $model->getAll();

        return $this->view("user/showAll.html",["users" => $result]);
    }

    public function delete($id){
        $user = new User();
        $rez = $user->delete($id);

        header('Location: /user/show');
    }
}