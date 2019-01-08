<?php
/**
 * Created by PhpStorm.
 * User: Andreea
 * Date: 13-Nov-18
 * Time: 11:18
 */

namespace App;

class Config {
    const ENV = "dev";
    CONST DB = [
        "host" => "localhost",
        "port" => 3306,
        "driver" => "mysql",
        "dbname" => "users",
        "charset" => "utf8mb4",
        "user" => "root",
        "pass" => "",
        ];
    const CLOUD = [
        "cloud_name" => "andreea",
        "api_key" => "587295255591389",
        "api_secret" => "23FqFcPLPyu_9kbCBTvT_XORAJE",
        "cloud_url" => "http://res.cloudinary.com/andreea"
    ];
}
