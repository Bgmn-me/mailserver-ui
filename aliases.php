<?php
session_start();
require_once "./dbconnect.php";
?>
<!DOCTYPE html>
<html>
<head><title>Mail - Bgmn.me</title></head>
<?php
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $sql = "insert into domains (domain) values ('" . $_POST["domain"] . "')";
        if ($conn->query($sql) === TRUE){
            $text = "New Record created successfully";
            echo "<script>console.log('" . $text . "')</script>";
        } else {
            echo "error: " . $sql . "<br>" . $conn->error;
        }
        $conn->close();
    } else {
        $_SESSION["msg"] = "Na na na, wie sind wir denn hier gelandet";
    }
?>
<body>
<!--<form action="index.php" method="post">
        <p>: <input type = "text" name = "domain" /></p>
        <p><input type = "submit" name = "submit" value = "submit" /></p>
    </form>-->
</body>
</html>