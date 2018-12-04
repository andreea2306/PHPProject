<?php
/**
 * Created by PhpStorm.
 * User: Andreea
 * Date: 04-Dec-18
 * Time: 11:11
 */

namespace Framework;


interface Guard
{
    //this function will contain the “guarding” logic
    function handle(array $params = null);
    //this function will be called when the guarding check fails and will contain the logic to be executed in such a case
    function reject();

}