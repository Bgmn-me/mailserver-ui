<?php
    $username = "dev_vmail"; //MySQL Username
    $password = "password"; //MySQL Password
    $server = "127.0.0.1"; //MySQL Server-adress
    $database = "dev_vmail"; //MySQL Database

    $conn = new  mysqli($server,$username,$password,$database);
    if($conn->connect_error){
        die("Connection failed:" . $conn->connect_error);
    }
    ?>