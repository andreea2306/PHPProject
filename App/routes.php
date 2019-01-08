<?php
/**
 * Created by PhpStorm.
 * User: Andreea
 * Date: 20-Nov-18
 * Time: 10:26
 */

$routes = [
    '/' => ['controller' => 'HomeController',
            'action' => 'index'],
            //'guard' => 'Authenticated'],
    '/page/about-us' => ['controller' => 'PageController',
        'action' => 'aboutUsAction'],
    '/user/{id}' => ['controller' => 'UserController',
        'action' => 'showAction',
        'guard' => 'Authenticated'],
    '/auth/login' => ['controller' => 'AuthController',
                    'action' => 'loginGET'],
    '/auth/login-action' => ['controller' => 'AuthController',
        'action' => 'loginPOST'],
    '/auth/register' => ['controller' => 'AuthController',
        'action' => 'registerGET'],
    '/auth/register-action' => ['controller' => 'AuthController',
        'action' => 'registerPOST'],
    '/auth/logout' => ['controller' => 'AuthController',
        'action' => 'logOutPost'],
];
