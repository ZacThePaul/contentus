<?php

include_once "Database.php";
include_once "config.php";

class Post extends Database {

    public function __construct() {
        $this->database = new Database('127.0.0.1:3307', 'root', '', 'contentus');
    }



}