<?php
    $username = "root";
    $password = "";
    $server = "127.0.0.1";
    $database = "vmail";

    $conn = new  mysqli($server,$username,$password,$database);
    if($conn->connect_error){
        die("Connection failed:" . $conn->connect_error);
    }

    function aliases($sql){
        if ($conn->query($sql) === TRUE){
            $text = "New Record created successfully";
            echo "<script>console.log('" . $text . "')</script>";
        }
        else {
            echo "error: " . $sql . "<br>" . $conn->error;
        }
        //$conn->close();
    }
    ?>