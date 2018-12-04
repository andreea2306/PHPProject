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
    public function showAction($id){

        $user = new User();
        $user = $user->get($id);

        return $this->view("user/show.html",["name" => $user->Email]);
    }
}