<?php

include 'database/Database.php';
include_once('app/User.php');


// I genuinely don't understand why I need to instantiate the user Class here but
// According to https://stackoverflow.com/questions/4155967/catchable-fatal-error-object-of-class-php-incomplete-class
// I needed to and it fixed my problem.
$user = new User();
session_start();

foreach (glob("controllers/*.php") as $filename)
{
    include $filename;
}

$configs = include('config.php');

//  This file is specifically to handle incoming API calls

if($_SERVER['REQUEST_METHOD'] === 'GET') {

    $database = new Database($configs['host'], $configs['username'], $configs['password'], $configs['database']);

    $method = $_GET['method'];
    $email = $_SESSION['user']->email;

    $database->$method('user', $email);

}

if($_SERVER['REQUEST_METHOD'] === 'POST') {

    $class = $_POST['class'];
    $method = $_POST['method'];

    return $class::$method($configs);

}

