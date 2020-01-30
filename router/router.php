<?php

require_once('app/helpers.php');
$configs = include_once('config.php');

class Router {

    public function __construct($request, $configs) {

        $this->base_uri = $GLOBALS['base_uri'];
        $this->request = $request;
        $this->configs = $configs;

    }

    public function get($route, $file, $function = null) {

        switch ($this->request) {

            case $this->request === $this->base_uri :
                require $this->base_uri . $file;
//                die(var_dump($this->request));
                break;
            case $this->request === $this->base_uri . $route :
//                die(var_dump($this->request));

                require($file);
                break;

        }

    }

    public function post($route, $file, $class, $method) {

        require_once(controllers($file));

        // TIL You can dynamically call a static function like this!
        $class::$method($this->configs);


//            switch ($this->request) {
//
//                case $this->request === $this->base_uri :
//                    echo 'home';
//                    require $this->base_uri . $file;
//                    break;
//                case $this->request === $this->base_uri . $route :
//                    require($file);
//                    break;
//
//            }

    }

}