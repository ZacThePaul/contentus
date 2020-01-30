<?php

class Table {

    public function __construct() {

    }

    public function autoincrement($name) {
        return '`' . $name . '`' . ' int(11) auto_increment';
    }

    public function varchar($name, $length, $nullable = true) {
        if($nullable) {
            return '`' . $name . '`' . ' VARCHAR(' . $length . ')';
        }
        elseif(!$nullable) {
            return '`' . $name . '`' . ' VARCHAR(' . strval($length) . ') NOT NULL';
        }
    }

    public function primarykey($name) {
        return 'primary key (' . $name . ')';
    }

    public function timestamp($name, $length, $nullable = true) {

        if($nullable) {
            return '`' . $name . '`' . ' VARCHAR(' . $length . ')';
        }
        elseif(!$nullable) {
            return '`' . $name . '`' . ' VARCHAR(' . $length . ') NOT NULL';
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

    public function longtext($name, $nullable = true) {
        if($nullable) {
            return $name . ' LONGTEXT';
        }
        elseif(!$nullable) {
            return $name . ' LONGTEXT NOT NULL';
        }
    }

    public function enum($name, $values, $nullable = true ) {

        if($nullable) {
             return $name . ' ENUM("Uncategorized")';
        }
        elseif(!$nullable) {
            return $name . ' ENUM(' . implode(", ", $values) . ') NOT NULL';
        }
    }

}