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
        header("Location: ../?msg=" . htmlspecialchars("Du wurdest eingeloggt!"));
        exit();
    } else {
        header("Location: ../?msg=" . htmlspecialchars("Falsche Logindaten!")); //Falscher Benutzername Passwort!
        exit();
    }
}

if (isset($_SESSION["sessionid"])) {
    header("Location: ../?msg=Du%20bist%20bereits%20eingeloggt!");
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