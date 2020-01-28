<?php

include('app/User.php');
$configs = include('config.php');

// instantiate a session object as soon as we are routed to the index.php and have it persist.
session_start();

//session_destroy();


// --------------------------------- //

//require_once('config.php');
require_once('router/router.php');
require_once('app/helpers.php');
require_once('database/Database.php');
date_default_timezone_set('America/New_York');

// Instantiate the database object
$database = new Database($configs['host'], $configs['username'], $configs['password'], $configs['database']);

// Instantiate the router object
$router = new Router($_SERVER['REQUEST_URI'], $configs);


// If user is logged in they can access these pages
if(is_user_logged_in()) {

    // Get routes
    if($_SERVER['REQUEST_METHOD'] === 'GET') {
        $router->get('/', views('home.php', 'Home'));
        $router->get('/home', views('home.php', 'Home'));
        $router->get('/dashboard', views('dashboard/dashboard.php', 'Dashboard'));
        $router->get('/about', views('about.html', 'About'));
        $router->get('/register', views('auth/register.php', 'Register'));
        // if user is logged in reroute them to the dashboard
        $router->get('/login', views('auth/login.php', 'Login'));
    }

    // Post routes
    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        $router->post('/register', 'RegisterController.php', 'RegisterController', 'create');
    }

}

elseif(!is_user_logged_in()) {

    // Get routes
    if($_SERVER['REQUEST_METHOD'] === 'GET') {
        $router->get('/', views('index.php', 'Home'));
        $router->get('/home', views('home.php', 'Home'));
        $router->get('/about', views('about.html', 'About'));
        $router->get('/register', views('auth/register.php', 'Register'));
        $router->get('/login', views('auth/login.php', 'Login'));
    }

    // Post routes
    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        $router->post('/register', 'RegisterController.php', 'RegisterController', 'create');
    }

}

// It doesn't make sense not to use AJAX and to turn the controllers into an API
// never actually having the PHP serve anything

// Do I actually have to create a whole new API directory and query the database via that?
// I want to use JavaScript to ping the API

// I'm not going to need the code in RegisterController or Router.php I don't think!
// I can handle all of that with AJAX -- I think.

// Apparently you can call php function from AJAX like this https://stackoverflow.com/questions/42596191/get-json-data-from-php-function-using-ajax

// YES you can! We can use this to replace PHP controllers now! See examples in test.js and config.php
// I want to do this because it will enable Asynchronous refreshes and JS is easier to deal with
// also since it's proving complicated to transfer data from PHP controller to view, this will be a
// much more simple way of doing this.

// replace PHP methods with JS methods when calling controller

// router > AJAX > PHP Controller

// Need to create a PHP api file that handles AJAX requests