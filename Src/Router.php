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
            $isValid = $this->getControllerName($routes,$url,$id[0]);
            if($isValid !== false) {
                list($controllerObj, $action) = $this->getControllerName($routes, $url, $id[0]);
                $controllerObj->{$action}($id[0]);
            }
            else{
                header("Location: /custom-error/not-found");
                echo "404";
            }
        }
        else{
            header("Location: /custom-error/not-found");
            echo "404";
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
        $this->checkAuthorizedGuard($routes,$url);

        if(!class_exists($controller)){
            return false;
        }
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

    private function checkAuthorizedGuard(array $routes,string $route): void
    {
        if (isset($routes[$route]['authorizedGuard'])) {
            $guard = "\\App\\Guards\\" . $routes[$route]['authorizedGuard'];
            //instantiate and execute the handle action
            (new $guard)->handle();
        }
    }
}