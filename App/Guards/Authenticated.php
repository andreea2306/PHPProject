<?php
/**
 * Created by PhpStorm.
 * User: Andreea
 * Date: 04-Dec-18
 * Time: 11:16
 */
namespace App\Guards;
use Framework\Guard;

class Authenticated implements Guard
{
    public function handle(array $params = null)
    {
        session_start();
        if (!isset($_SESSION['username']))
            $this->reject();
    }

    public function reject()
    {
         header("Location: /auth/login");
    }
}