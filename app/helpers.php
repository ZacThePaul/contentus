<?php

function views($file, $slug) {

    $_SESSION['filename'] = $file;
    $_SESSION['slug'] = $slug;

    return dirname('index.php') . '/views/base.php';

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

function get_header() {

    include_once "views/partials/header.php";

}

function get_footer() {

    include_once "views/partials/footer.php";

}