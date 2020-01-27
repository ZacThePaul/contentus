<?php

function views($file) {

    return dirname('index.php') . '/views/' . $file;

}

function controllers($file) {

    return dirname('index.php') . '/controllers/' . $file;

}

function is_user_logged_in() {

    if(!isset($_SESSION['user']->logged_in)) {
        return false;
    }
    else {
        if (!$_SESSION['user']->logged_in) {
            return false;
        } elseif ($_SESSION['user']->logged_in) {
            return true;
        }
    }

}