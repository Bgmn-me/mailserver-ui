<?php
session_set_cookie_params(10800,TRUE,TRUE);
session_start();
require_once "./dbconnect.php";
?>
<!DOCTYPE html>
<html>
<head><title>Alias - Bgmn.me</title></head>
<?php
    if(empty($_SESSION["id"])){
        $_SESSION["msg"] = "Sie müssen eingeloggt sein, um diese Seite Aufrufen zu können!";
        header("Location: ../");
    }
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $edit = 1;
            $sql = "insert into domains (domain) values ('" . $_POST["domain"] . "')";
            if ($conn->query($sql) === TRUE){
                $_SESSION["msg"] = "Alias: " . $alias . "erfolgreich hinzugefügt";
                header("Location: ../");
            } else {
                $_SESSION["msg"] = "Upps, da ist irgendwas schiefgelaufen";
                header("Location: ../");
            }
            $conn->close();
        }
?>
<body>
<<form action="index.php" method="post">
        <p>: <input type = "text" name = "domain" /></p>
        <p><input type = "submit" name = "submit" value = "submit" /></p>
    </form>
</body>
</html>