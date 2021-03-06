<?php
/**
 * Created by PhpStorm.
 * User: Andreea
 * Date: 27-Nov-18
 * Time: 11:44
 */

namespace Framework;


class BaseController
{
    private $twig;

    public function __construct()
    {
        session_start();
        $loader = new \Twig_Loader_Filesystem(__DIR__.'/../App/Views');
        $this->twig = new \Twig_Environment($loader,array(
           // 'cache' => __DIR__.'/../Storage/Cache/Views',
            "cache" => false
        ));

//        if(!isset($_SESSION))
//        {
//            session_start();
//        }
        if (!isset($_SESSION['Errors']))
        {
            $_SESSION['Errors'] = false;
        }
        if(!isset($_SESSION["UniqueError"])){
            $_SESSION["UniqueError"] = false;
        }
        $this->twig->addGlobal('session_errors', $_SESSION["Errors"]);
        $this->twig->addGlobal('session_logged', isset($_SESSION["Username"]));
        $this->twig->addGlobal('name', $_SESSION["Username"]);
        $this->twig->addGlobal('is_admin', $_SESSION["IsAdmin"]);
        $this->twig->addGlobal('unique_error', $_SESSION["UniqueError"]);
    }

    public function view(string $viewFile,array $params = [])
    {
        echo $this->twig->render($viewFile,$params);
    }
}