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
        session_start();
        if (!isset($_SESSION['Errors']))
        {
            $_SESSION['Errors'] = false;
        }
        $this->twig->addGlobal('session_errors', $_SESSION["Errors"]);
        $this->twig->addGlobal('session_logged', isset($_SESSION["Username"]));

    }

    public function view(string $viewFile,array $params = [])
    {
        echo $this->twig->render($viewFile,$params);
    }
}