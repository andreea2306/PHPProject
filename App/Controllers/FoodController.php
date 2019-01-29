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

        return $this->view("food/showFoodsByRestaurant.html",["foods" => $result]);
    }

    public function show($id){
        $modelFood = new Food();
        $result = $modelFood->get($id);
        $modelRestaurant = new Restaurant();
        $restaunt = $modelRestaurant->get($result->IdRestaurant);

        return $this->view("food/showFood.html",["food" => $result, "restaurant" => $restaunt]);
    }

}