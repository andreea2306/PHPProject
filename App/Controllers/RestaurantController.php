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
}