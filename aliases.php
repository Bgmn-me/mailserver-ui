<?php
session_start();
require_once "./dbconnect.php";
?>
<!DOCTYPE html>
<html>
<head><title>Alias - Bgmn.me</title></head>
<?php
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $sql = "insert into domains (domain) values ('" . $_POST["domain"] . "')";
        if ($conn->query($sql) === TRUE){
            $_SESSION["msg"] = "Alias: " . $alias . "erfolgreich hinzugefügt";
            header("Location: ../");
        } else {
            $_SESSION["msg"] = "Upps, da ist irgendwas schiefgelaufen";
            header("Location: ../");
        }
        $conn->close();
    } else {
        $_SESSION["msg"] = "Na na na, wie sind wir denn hier gelandet";
        header("Location: ../");
    }
?>
<body>
<!--<form action="index.php" method="post">
        <p>: <input type = "text" name = "domain" /></p>
        <p><input type = "submit" name = "submit" value = "submit" /></p>
    </form>-->
</body>
</html>