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
        $loader = new \Twig_Loader_Filesystem(__DIR__.'/../App/Views');
        $this->twig = new \Twig_Environment($loader,array(
            'cache' => __DIR__.'/../Storage/Cache/Views',
        ));
        $this->twig = new \Twig_Environment($loader);
        session_start();
        $this->twig->addGlobal('session.errors', $_SESSION["Errors"]);
    }

    public function view(string $viewFile,array $params = [])
    {
        echo $this->twig->render($viewFile,$params);
    }
}