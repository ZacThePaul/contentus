<?php

include_once('config.php');
require_once('database/Database.php');

class HomeController {

    public function __construct() {

    }

    public static function index() {

        $host = "127.0.0.1";
        $username = "root";
        $password = "";
        $database = 'test';

        $database = new Database($host, $username, $password, $database);

    }

}