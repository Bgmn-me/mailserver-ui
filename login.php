<?php
session_start();
?>
<!DOCTYPE html>
<html>
<body>
<?php

if (isset($_POST["username"]) && isset($_POST["password"])) {
    if ($_POST["username"] == "Dominik" && $_POST["password"] == "Test") {
        $_SESSION["sessionid"] = 001;
        $_SESSION["msg"] = "Du wurdest eingeloggt!";
        header("Location: ../");
        exit();
    } else {
        $_SESSION["msg"] = "Falsche Logindaten!";
        header("Location: ../");
        exit();
    }
}

if (isset($_SESSION["sessionid"])) {
    $_SESSION["msg"] = "Du bist bereits eingeloggt!";
    header("Location: ../");
    exit();
}

?>

<form action="" method="POST">
    <p>Username: <input type="text" name="username" id="username"></p>
    <p>Password: <input type="password" name="password" id="password"></p>
    <input type="submit" value="Login">
</form>

</body>
</html>