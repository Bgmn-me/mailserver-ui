<?php
    $username = "dev_vmail";
    $password = "password";
    $server = "127.0.0.1";
    $database = "dev_vmail";

    $conn = new  mysqli($server,$username,$password,$database);
    if($conn->connect_error){
        die("Connection failed:" . $conn->connect_error);
    }
    ?>