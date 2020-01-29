<?php

global $database;

include_once('app/User.php');
$configs = include_once('config.php');

// instantiate a session object as soon as we are routed to the index.php and have it persist.
if(!isset($_SESSION))
{
    session_start();
}

define('PROJECT_ROOT', $_SERVER['DOCUMENT_ROOT'] . '/noframework/');

//require_once('config.php');
require_once('router/router.php');
require_once('app/helpers.php');
require_once('database/Database.php');
date_default_timezone_set('America/New_York');

$database = new Database('127.0.0.1:3307', 'root', '', 'contentus');

// Instantiate the database object
//$database = new Database($configs['host'], $configs['username'], $configs['password'], $configs['database']);

// Instantiate the router object
$router = new Router($_SERVER['REQUEST_URI'], $configs);

if(!is_user_logged_in()) {

    // Get LOGGED OUT routes
    if($_SERVER['REQUEST_METHOD'] === 'GET') {

        $router->get('/', views('home.php', 'Home'));
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
else {

    // Get LOGGED IN routes
    if($_SERVER['REQUEST_METHOD'] === 'GET') {
        // this code is literally doing nothing
        $router->get('/', views('home.php', 'Home'));
        $router->get('/home', views('home.php', 'Home'));
        $router->get('/dashboard', views('dashboard/dashboard.php', 'dashboard'));
        $router->get('/about', views('about.html', 'About'));
        $router->get('/register', views('auth/register.php', 'Register'));
        $router->get('/conlog', views('auth/login.php', 'Conlog'));
        $router->get('/pages', views('dashboard/admin-page-template.php', 'pages'));
        $router->get('/posts', views('dashboard/admin-page-template.php', 'posts'));
        $router->get('/settings', views('dashboard/admin-page-template.php', 'settings'));
        $router->get('/logout', views('auth/logout.php', 'logout'));
    }

    // Post routes
    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        $router->post('/register', 'RegisterController.php', 'RegisterController', 'create');
    }

}
