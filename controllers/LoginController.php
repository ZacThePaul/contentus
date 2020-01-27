<?php

$configs = include('config.php');
require_once('database/Database.php');

class loginController {

    public function __construct($configs) {

        $this->configs = $configs;

    }

    public static function login($configs) {

        $user_password = $_POST['password'];
        $user_email = $_POST['email'];

        $database = new Database($configs['host'], $configs['username'], $configs['password'], $configs['database']);

        // Testing data
        $valid_email = $database->select('user', $user_email, false, $user_password);

        if ($valid_email) {

            // if the email is good check password
            $valid_password = $database->select('user', $user_email, true, $user_password);

            if($valid_password) {

                include('app/User.php');

                session_start();
                $user = new User();
                $_SESSION['user'] = $user;
                $_SESSION['user']->logged_in = true;
                echo json_encode(true);

            }

        }

    }

}