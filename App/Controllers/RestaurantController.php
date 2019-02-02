<?php
/**
 * Created by PhpStorm.
 * User: Andreea
 * Date: 29-Jan-19
 * Time: 20:51
 */

namespace App\Controllers;
use App\Models\Restaurant;
use Framework\BaseController;

class RestaurantController extends BaseController
{
    public function showAll(){

        $model = new Restaurant();
        $result = $model->showAll();

        return $this->view("restaurant/showAll.html",["restaurants" => $result]);
    }

    public function delete($id){
        $rest = new Restaurant();
        $rez = $rest->delete($id);

        header('Location: /restaurant/showAdmin');
    }

    public function insert(){
        $rest = new Restaurant();

        $nameDb = $rest->getByName($_POST["name"]);
        if(!$nameDb) {
            $data = ['Name' => $_POST["name"], 'Adress' => $_POST["adress"]];
            $result = $rest->new($data);

            header('Location: /restaurant/showAdmin');
        }
        else{
            session_start();
            $_SESSION["UniqueError"] = "This name is already taken";
            header("Location: /restaurant/showAdmin");
        }
    }

    public function showAdmin(){
        session_start();
        $_SESSION["UniqueError"] = false;

        $rest = new Restaurant();
        $restaurants = $rest->getAll();

        return $this->view("restaurant/showAllAdmin.html",["restaurants" => $restaurants]);
    }

    public function updateGET($id){
        session_start();
        $_SESSION["UniqueError"] = false;

        $rest = new Restaurant();
        $result = $rest->get($id);

        return $this->view("restaurant/editAdmin.html",["restaurant" => $result]);
    }

    public function updatePOST(){
        $rest = new Restaurant();
        $where = array();
        array_push($where, $name ="Name");
        array_push($where, $price ="Adress");

        $nameDb = $rest->getByName($_POST["name"]);
        $id = $_POST["id"];

        if(!$nameDb) {
            $data = ['Name' => $_POST["name"], 'Adress' => $_POST["adress"]];

            $result = $rest->update($data, $id);
            header('Location: /restaurant/showAdmin');
        }
        else{
            session_start();
            $_SESSION["UniqueError"] = "This name is already taken";
            header("Location: /restaurant/edit/$id");
        }
    }
}