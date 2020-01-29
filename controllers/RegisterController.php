<?php

//$configs = include_once('config.php');
require_once('database/Database.php');

class RegisterController {

    public function __construct($configs) {

        $this->configs = $configs;

    }

    public static function create($configs) {

        $user_name = $_POST['name'];
        $user_password = $_POST['password'];
        $user_email = $_POST['email'];
        $created_at = $timestamp = date("Y-m-d H:i:s");

        $database = new Database($configs['host'], $configs['username'], $configs['password'], $configs['database']);

        // Testing data
        $email_taken = $database->select('user',  $user_email);

        if($email_taken) {

            // If the email is already being used, return user to login page
            echo 'taken';

        }
        elseif(!$email_taken) {

            // If the email is not already being used, create the user and log them in
            // Also log them in via sessions

            $database->create_user($user_name, $user_password, $user_email, $created_at);

            echo 'not taken';
        }

    }

}