<?php
session_set_cookie_params(10800,TRUE,TRUE);
session_start();
require_once "./dbconnect.php";
?>
<!DOCTYPE html>
<html>
<head><title>Domain - Bgmn.me</title></head>
<?php
if (empty($_SESSION["sessionid"])) {
    $_SESSION["msg"] = "Bitte loggen Sie sich ein um diese Seite benutzen zu können!";
    header("Location: ../");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $edit = 1;
    $sql = "insert into domains (domain) values ('" . $_POST["domain"] . "')";
    if ($conn->query($sql) === TRUE){
        $_SESSION["msg"] = "Domain wurde erfolgreich hinzugefügt";
        header("Location: ../");
    } else {
        $_SESSION["msg"] = "Es ist ein Fehler aufgetreten!";
        header("Location: ../domains.php");
    }
    $conn->close();
}
?>
<body>
    <form action="./domains.php" method="post">
        <p>Domain: <input type = "text" name = "domain" /></p>
        <p><input type = "submit" name = "submit" value = "submit" /></p>
    </form>
</body>
</html>
