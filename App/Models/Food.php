<?php
/**
 * Created by PhpStorm.
 * User: Andreea
 * Date: 06-Jan-19
 * Time: 18:47
 */

namespace App\Models;
use Framework\Model;

class Food extends Model
{
    protected $table = "foods";

    public function showAll(){
        return $this->getAll();
    }

    public function getByRestaurantId($id)
    {
        $db = $this->newDbCon();
        $stmt = $db->prepare("SELECT * from $this->table where IdRestaurant=?");
        $stmt->execute([$id]);
        $rez = $stmt->fetchAll();
        return $rez;
    }

}