<?php

class Database {

    public function __construct($host, $username, $password, $database) {

        $this->host = $host;
        $this->username = $username;
        $this->password = $password;
        $this->database = $database;

        $this->connection = new mysqli($this->host, $this->username, $this->password, $this->database);

        // check connection
        if ($this->connection->connect_errno) {
            exit('Connect failed: '. mysqli_connect_error());
        }

        // Run all core DB migrations
        $this->migrations();

    }

    public function create_table($table_name, $data) {


        if(!$this->connection) {
            // if there is no connection to the database
        }
        else {

            $query = '';

            // These variables exist to check if the loop is the last one
            // so we don't add a comma after the last item
            $max = count($data) - 1;
            $counter = 0;

            // We are looping through the data and creating a query from it
            foreach ($data as $datum) {

                // This if statement checks to make sure we don't add a comma
                // to the last item
                if($counter >= $max) {
                    $query .= $datum;
                }

                elseif($counter < $max) {
                    $query .= $datum . ', ';
                }

                $counter++;

            }

            $sql = "CREATE TABLE IF NOT EXISTS `$table_name` ($query)";

//             This runs the query
            mysqli_query($this->connection, $sql) or die(mysqli_error($this->connection));


        }

    }

    public function create_user($name, $password, $email, $created_at) {


        $sql = "INSERT INTO `user` (`name`, `password`, `email`, `created_at`, `updated_at`) VALUES ('$name', '$password', '$email', '$created_at', '$created_at');";

//        die($sql);
        mysqli_query($this->connection, $sql)or die(mysqli_error($this->connection));

    }

    public function select($table, $item, $login = null, $password = null) {

        if($login) {

            $query = "SELECT * FROM `$table` WHERE email='".$item."' AND password='".$password."'";

            $result = $this->connection->query($query);

            $query = mysqli_query($this->connection, "SELECT * FROM user WHERE email='".$item."'");

            if ($result->num_rows > 0) {

                // This is how you display results
                while ($row = mysqli_fetch_array($result)) {

                    return json_encode($row);

                }

            }
            else {

                die('oops');

            }

        }

        // check if item exists in column of table

        $query = "SELECT * FROM `$table` WHERE email='".$item."'";

        $result = $this->connection->query($query);

//            $query = mysqli_query($this->connection, "SELECT * FROM user WHERE email='".$item."'");

        if ($result->num_rows > 0) {

//             This is how you display results
            while ($row = mysqli_fetch_array($result)) {
                //
                return $row;

            }

            return true;

        }
        else {

            return false;
        }

    }

    public function select_item($item, $table, $column, $needle) {

        $query = "SELECT $item FROM `$table` WHERE $column='".$needle."'";

        $result = $this->connection->query($query);

        if ($result->num_rows > 0) {

            while ($row = mysqli_fetch_array($result)) {
                return $row;
            }
        }
        else {
            return false;
        }

        return false;
    }

    public function core_menu() {

        $core_menu_items = serialize([
            'dashboard', 'pages', 'posts', 'media', 'users',  'settings'
        ]);

        // Adding the core menu items
        $query = "SELECT * FROM `con_menu` WHERE menu_name='con_core_menu'";

        $result = $this->connection->query($query);

        // Making sure this is the first run before adding the menu items
        if ($result->num_rows > 0) {

        }
        else {
            $time = date("Y-m-d H:i:s");
            $new_sql = "INSERT INTO `con_menu` (`menu_name`, `menu_items`, `class_names`, `created_at`, `updated_at`) VALUES ('con_core_menu', '$core_menu_items', 'menu-items', '$time', '$time')";
            mysqli_query($this->connection, $new_sql)or die(var_dump($new_sql));
        }

    }

    public function migrations() {

        require_once('Table.php');
        $table = new Table();

        // Creates Core Database
        $sql = "CREATE DATABASE IF NOT EXISTS `contentus`";

        // If there is an error, display it.
        echo ($this->connection->query($sql) ? '' : 'Error: '. $this->connection->error);

        // Migration for the core user table
        $this->create_table('user', [
            $table->autoincrement('id'),
            $table->varchar('name', 20, false),
            $table->varchar('password', 55, false),
            $table->varchar('email', 55, false),
            $table->timestamp('created_at', 55),
            $table->timestamp('updated_at', 55, true),
            $table->primarykey('id')
        ]);

        // Migration for the core admin menu table
        $this->create_table('con_menu', [
            $table->autoincrement('id'),
            $table->varchar('menu_name', 55, false),
            // Menu items need to be serialized before adding to DB
            $table->varchar('menu_items', 500 , false),
            $table->varchar('class_names', 55, true),
            $table->timestamp('created_at', 55),
            $table->timestamp('updated_at', 55, true),
            $table->primarykey('id')
        ]);

        // Migration for the core admin posts table
        $this->create_table('posts', [
            $table->autoincrement('id'),
            $table->varchar('post_title', 110, false),
            $table->varchar('post_excerpt', 110, true),
            $table->longtext('post_body', true),
            $table->varchar('post_image', 500, true),
            $table->integer('author_id', false),
            $table->primarykey('id')
        ]);

        // Adding the core menu items
        $this->core_menu();

    }

}