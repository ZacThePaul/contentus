<?php

class Table {

    public function __construct() {

    }

    public function autoincrement($name) {
        return $name . ' INT AUTO_INCREMENT';
    }

    public function varchar($name, $length, $nullable = true) {
        if($nullable) {
            return $name . ' VARCHAR(' . $length . ')';
        }
        elseif(!$nullable) {
            return $name . ' VARCHAR(' . strval($length) . ') NOT NULL';
        }
    }

    public function primarykey($name) {
        return 'primary key (' . $name . ')';
    }

    public function timestamp($name, $length, $nullable = true) {

        if($nullable) {
            return $name . ' VARCHAR(' . $length . ')';
        }
        elseif(!$nullable) {
            return $name . ' VARCHAR(' . $length . ') NOT NULL';
        }
    }

    public function integer($name, $nullable = true) {
        if($nullable) {
            return $name . ' INT';
        }
        elseif(!$nullable) {
            return $name . ' INT NOT NULL';
        }
    }

}