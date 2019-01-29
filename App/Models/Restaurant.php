<?php
/**
 * Created by PhpStorm.
 * User: Andreea
 * Date: 29-Jan-19
 * Time: 20:54
 */

namespace App\Models;
use Framework\Model;

class Restaurant extends Model
{
    protected $table = "restaurants";

    public function showAll(){
        return $this->getAll();
    }
}