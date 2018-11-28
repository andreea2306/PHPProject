<?php
/**
 * Created by PhpStorm.
 * User: Andreea
 * Date: 22-Nov-18
 * Time: 21:08
 */

namespace App\Controllers;
use Framework\BaseController;

class HomeController extends BaseController
{
    public function index(){
        echo "Hello user";
    }

}