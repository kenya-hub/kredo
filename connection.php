<?php
  
  function connection(){
        $server_name = "localhost";
        $username    = "root";
        $password    = "";
        $db_name     = "minimart_catalog";


    // Create Connection
    $conn = new mysqli($server_name,$username,$password,$db_name);

    // Check Connection
    if($conn->connect_error){
        // There is error
        die("Connection failed: " . $conn->connect_error);
    }else{
        // No error
        return $conn;
    }

}

?>