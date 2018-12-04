<?php
/**
 * Created by PhpStorm.
 * User: Andreea
 * Date: 20-Nov-18
 * Time: 10:24
 */

namespace Framework;

class Router
{

    public function checkUrl(array $routes,string $url,string $param):void{

        if(isset($routes[$url])) {
            list($controllerObj, $action) = $this->getControllerName($routes, $url);
            $controllerObj->{$action}();
        }
        else if(preg_match('/\d+/', $url, $id))
        {
            list($controllerObj, $action) = $this->getControllerName($routes, $url,$id[0]);
            $controllerObj->{$action}($id[0]);
        }
        else{
            echo "404 Not Found";
        }
    }

    public function getControllerName(array $routes, string $url,int $id=null)
    {
        if($id){
            $url = str_replace($id,"{id}",$url);
        }
        $controller = $routes[$url]['controller'];
        $controller = "App\\Controllers\\".$controller;

        $this->checkGuard($routes,$url);

        $controllerObj = new $controller();
        $action = $routes[$url]['action'];
        return array($controllerObj, $action);
    }

    private function checkGuard(array $routes,string $route): void
    {
        if (isset($routes[$route]['guard'])) {
            $guard = "\\App\\Guards\\" . $routes[$route]['guard'];
            //instantiate and execute the handle action
            (new $guard)->handle();
	        }
    }
}