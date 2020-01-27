<?php

include 'database/Database.php';
//require 'controllers/RegisterController.php';

foreach (glob("controllers/*.php") as $filename)
{
    include $filename;
}

$configs = include('config.php');



//  This file is specifically to handle incoming API calls

if($_SERVER['REQUEST_METHOD'] === 'GET') {

    $database = new Database($configs['host'], $configs['username'], $configs['password'], $configs['database']);

    $method = $_GET['method'];

    $database->$method('user', 'zac@curiousm.com');

}

if($_SERVER['REQUEST_METHOD'] === 'POST') {

//    echo $_POST['name'];
//    $data = $_POST['data'];

    $class = $_POST['class'];
    $method = $_POST['method'];
//
    return $class::$method($configs);

//    return RegisterController::create($configs);

}

