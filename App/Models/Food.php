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
}