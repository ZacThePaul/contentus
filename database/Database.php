<?php

class Database {

    public function __construct($host, $username, $password, $database) {

        require_once('Table.php');

        $table = new Table();

        // This creates the connection to the database that persists through the entire site
        $this->connection = mysqli_connect($host, $username, $password, $database);

        // Similar to migrations here we are creating the table and the columns
        $this->create_table('user', [
            $table->autoincrement('id'),
            $table->varchar('name', 20, false),
            $table->varchar('password', 55, false),
            $table->varchar('email', 55, false),
            $table->timestamp('created_at', 55),
            $table->timestamp('updated_at', 55, true),
            $table->primarykey('id')
        ]);

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

            $sql = "create table if not exists $table_name($query)";

            // This runs the query
//            if(mysqli_query($this->connection, $sql) or die(mysqli_error($this->connection))){
//                echo "Table created successfully";
//            } else {
//                echo "Table is not created successfully ";
//            }

        }

    }

    public function create_user($name, $password, $email, $created_at) {

//        $sql = "INSERT INTO user (name, password, email, created_at, updated_at) VALUES ('$name, $password, $email, $created_at, $created_at')";
//
//        $this->connection->query($sql) or die(mysqli_error($this->connection));;

        $stmt = $this->connection->prepare("INSERT INTO user (name, password, email, created_at, updated_at) VALUES (?, ?, ?, ?, ?)");
        $stmt -> bind_param("sssss", $name,$password, $email, $created_at, $created_at);
        $stmt -> execute();

    }

    public function select($table, $item, $login = false, $password = null) {

        if($login) {

            $query = "SELECT * FROM `$table` WHERE email='".$item."' AND password='".$password."'";

            $result = $this->connection->query($query);

            $query = mysqli_query($this->connection, "SELECT * FROM user WHERE email='".$item."'");

            if ($result->num_rows > 0) {

                // This is how you display results
                while ($row = mysqli_fetch_array($result)) {

                    echo 'got it';

                }

            }
            else {

                var_dump($result);

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
                    echo json_encode($row);

                }

                return true;

            }
            else {
                return false;
            }

        }

}