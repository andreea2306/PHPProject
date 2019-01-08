<?php
/**
 * Created by PhpStorm.
 * User: Andreea
 * Date: 22-Nov-18
 * Time: 21:08
 */

namespace App\Controllers;
use App\Models\Food;
use Framework\BaseController;

class HomeController extends BaseController
{
    public function index(){
        //echo "Hello user";

        $model = new Food();
        $result = $model->showAll();

        return $this->view("user/home.html",["foods" => $result]);
    }

}