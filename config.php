<?php

$GLOBALS['base_uri'] = '/noframework';

return array(

    'host' => '127.0.0.1',
    'username' => 'root',
    'password' => '',
    'database' => 'test'

);

//// Connect to a MySql Database
//$host = "127.0.0.1";
//$username = "root";
//$password = "";
//$database = 'test';

//if(isset($_GET['function']) && $_GET['function'] !=''){
//    $result = $_GET['function']();
//    //  This can also be encoded as JSON
//    //  echo json_encode($result);
//    echo $result;
//}
//
//function hello() {
//    return 'hello';
//}