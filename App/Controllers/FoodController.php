<?php
/**
 * Created by PhpStorm.
 * User: Andreea
 * Date: 22-Nov-18
 * Time: 21:08
 */

namespace App\Controllers;
use App\Models\Food;
use App\Models\Restaurant;
use Framework\BaseController;

class FoodController extends BaseController
{
    public function showAll(){

        $model = new Food();
        $result = $model->showAll();

        return $this->view("food/showAll.html",["foods" => $result]);
    }

    public function showByRestauntName($id){
        $model = new Food();
        $result = $model->getByRestaurantId($id);

        $modelRestaurant = new Restaurant();
        $restaurant = $modelRestaurant->get($id);

        return $this->view("food/showFoodsByRestaurant.html",["foods" => $result, "restaurant" => $restaurant]);
    }

    public function show($id){
        $modelFood = new Food();
        $result = $modelFood->get($id);
        $modelRestaurant = new Restaurant();
        $restaunt = $modelRestaurant->get($result->IdRestaurant);

        return $this->view("food/showFood.html",["food" => $result, "restaurant" => $restaunt]);
    }

    public function delete($id){
        $food = new Food();
        $rez = $food->delete($id);

        header('Location: /food/showAdmin');
    }

    public function insert(){
        $food = new Food();

        $target_dir = "images/";
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);

        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
        $data = ['Name' => $_POST["name"], 'Price' => $_POST["money"], 'IdRestaurant' => $_POST["restaurants"], "Ingredients" => $_POST["ingredients"],'PhotoName' => $target_file];
        $result = $food->new( $data);

        header('Location: /food/showAdmin');
    }

    public function showAdmin(){
        $food = new Food();
         $foods = $food->getAll();

        $rest = new Restaurant();
        $restaurants = $rest->getAll();
        return $this->view("food/showAllAdmin.html",["foods" => $foods, "restaurants" => $restaurants]);
    }

    public function updateGET($id){

        $food = new Food();
        $result = $food->get($id);
        $modelRestaurant = new Restaurant();
        $restaurant = $modelRestaurant->get($result->IdRestaurant);

        return $this->view("food/editAdmin.html",["food" => $result, "restaurant" => $restaurant]);
    }

    public function updatePOST(){
        $food = new Food();
        $where = array();
        array_push($where, $name ="Name");
        array_push($where, $price ="Price");
        array_push($where, $ingrdients ="Ingredients");

        $id = $_POST["id"];

        $target_dir = "images/";
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);

        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
        } else {
            echo "Sorry, there was an error uploading your file.";
        }

        $data = ['Name' => $_POST["name"], 'Price' => $_POST["money"], 'Ingredients' => $_POST["ingredients"], 'PhotoName' => $target_file];
        $result = $food->update($data, $id);
        header('Location: /food/showAdmin');
    }
}