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

    public function getByName($name){
        $db = $this->newDbCon();
        $stmt = $db->prepare("SELECT * from $this->table where Name=?");
        $stmt->execute([$name]);
        $rez = $stmt->fetch();

        return $rez;
    }

    public function getUnique($name,$id){
        $db = $this->newDbCon();
        $stmt = $db->prepare("SELECT * from $this->table where Name=? AND Id != $id");
        $stmt->execute([$name]);
        $rez = $stmt->fetch();

        return $rez;
    }
}