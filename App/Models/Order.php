<?php
/**
 * Created by PhpStorm.
 * User: Andreea
 * Date: 02-Feb-19
 * Time: 18:48
 */

namespace App\Models;
use Framework\Model;

class Order extends Model
{
    protected $table = "orders";

    public function insertOrder($idUser, $totalPrice){
        $data = ['IdUser' => $idUser, 'TotalPrice' => $totalPrice];
        $this->new($data);
    }

    public function insertFoodOrder($idFood,$idOrder){
        $data = ['IdFood' => $idFood, 'IdOrder' => $idOrder];
        $this->new($data);
    }

}