<?php
/**
 * Created by PhpStorm.
 * User: Andreea
 * Date: 02-Feb-19
 * Time: 13:02
 */

namespace App\Controllers;
use App\Models\Order;
use App\Models\User;
use Framework\BaseController;

class OrderController extends BaseController
{
    public function make(){
        $portions = $_POST["portions"];
        $idRestaurant = $_POST["idRestaurant"];
        $idFood = $_POST["idFood"];
        $priceOnePiece = $_POST['priceOnePiece'];
        $totalPrice = $portions * $priceOnePiece;

        $user = new User();
        $userDb = $user->getByUsername($_SESSION["Username"]);
        $id = $userDb->Id;

        $order = new Order();
        $resultOrder = $order->insertOrder($id, $totalPrice);

        header('Location: /');
    }
}