<?php
/**
 * Created by PhpStorm.
 * User: Andreea
 * Date: 31-Jan-19
 * Time: 21:28
 */

namespace App\Controllers;


use Framework\BaseController;

class ErrorController extends BaseController
{
    public function notFound(){
        return $this->view("error/notFound.html");
    }

    public function unathorized(){
        return $this->view("error/unauthorized.html");
    }
}