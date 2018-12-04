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
    '/page/about-us' => ['controller' => 'PageController',
        'action' => 'aboutUsAction'],
    '/user/{id}' => ['controller' => 'UserController',
        'action' => 'showAction',
        'guard' => 'Authenticated']
];
