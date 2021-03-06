<?php
/**
 * Created by PhpStorm.
 * User: Andreea
 * Date: 01-Feb-19
 * Time: 21:41
 */

namespace App\Guards;
use Framework\Guard;

class Authorized implements Guard
{
    public function handle(array $params = null)
    {
        session_start();
        if (!isset($_SESSION['IsAdmin']) || $_SESSION['IsAdmin'] === false)
            $this->reject();
    }

    public function reject()
    {
        header("Location: /custom-error/unauthorized");
        die();
    }
}