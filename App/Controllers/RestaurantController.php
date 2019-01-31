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

        header('Location: /restaurant/showAllAdmin');
    }

    public function insert(){
        $rest = new Restaurant();
        $data = ['Name' => $_POST["name"], 'Adress' => $_POST["adress"]];
        $result = $rest->new( $data);

        header('Location: /restaurant/showAdmin');
    }

    public function showAdmin(){
        $rest = new Restaurant();
        $restaurants = $rest->getAll();

        return $this->view("restaurant/showAllAdmin.html",["restaurants" => $restaurants]);
    }

    public function updateGET($id){

        $rest = new Restaurant();
        $result = $rest->get($id);

        return $this->view("restaurant/editAdmin.html",["restaurants" => $result]);
    }

    public function updatePOST(){
        $rest = new Restaurant();
        $where = array();
        array_push($where, $name ="Name");
        array_push($where, $price ="Adress");

        $id = $_POST["id"];

        $data = ['Name' => $_POST["name"], 'Adress' => $_POST["adress"]];

        $result = $rest->update($data, $id);
        header('Location: /restaurant/showAdmin');
    }
}