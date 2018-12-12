<?php
/**
 * Created by PhpStorm.
 * User: Andreea
 * Date: 04-Dec-18
 * Time: 10:31
 */

namespace App\Models;
use Framework\Model;

class User extends Model
{
    //we have to set specify the corresponding model for the table
    protected $table = "users";

    public function checkUser(string $email,string $pass){
        $result = $this->find(["Email" => $email]);

        if($result && password_verify($pass,$result->Password))
            return $result;
    }

}