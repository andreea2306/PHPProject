<?php
/**
 * Created by PhpStorm.
 * User: Andreea
 * Date: 13-Nov-18
 * Time: 10:36
 */
require __DIR__ . '/../vendor/autoload.php';
require_once "../App/Config.php";
require_once "../App/routes.php";
Tracy\Debugger::enable(Tracy\Debugger::DEVELOPMENT);
ini_set("error_log",__DIR__."/../Logs/error.log");
error_reporting(E_ALL);
ini_set("display_errors",0);

if(App\Config::ENV == "dev"){
    ini_set("display_errors",1);
}

$router = new \Framework\Router();
$router->checkUrl($routes,$_SERVER["REQUEST_URI"],$_SERVER["QUERY_STRING"]);