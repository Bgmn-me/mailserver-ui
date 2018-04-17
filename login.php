<?php
session_start();
require_once "./dbconnect.php" ;
?>
<!DOCTYPE html>
<html>
<body>
<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(empty($_POST["username"])){
        $_SESSION["msg"] = "Username darf nicht leer sein!";
        header("Location: ../");
    } else {
        $username = $_POST["username"];
    }
    if(empty($_POST["password"])){
        $_SESSION["msg"] = "Passwort darf nicht leer sein!";
        header("Location: ../");
    } else {
        $password = $_POST["password"];
    }
    $sql = "SELECT id, passwort, salt FROM accounts WHERE username = '" . $username . "'";
    $result = $conn->query($sql);
    while ($row = $result->fetch_assoc()){
        echo "id: " . $row["id"] . ", passwort: " . $row["passwort"] . ", salt: " . $row["salt"];
    }
    /*if ($_POST["username"] == "Dominik" && $_POST["password"] == "Test") {
        $_SESSION["sessionid"] = 001;
        $_SESSION["msg"] = "Du wurdest eingeloggt!";
        header("Location: ../");
        exit();
    } else {
        $_SESSION["msg"] = "Falsche Logindaten!";
        header("Location: ../");
        exit();
    }*/
}

if (isset($_SESSION["sessionid"])) {
    $_SESSION["msg"] = "Du bist bereits eingeloggt!";
    header("Location: ../");
    exit();
}


if(empty($_SESSION["sessionid"])){
echo '<form action="" method="POST">';
echo    '<p>Username: <input type="text" name="username" id="username"></p>';
echo    '<p>Password: <input type="password" name="password" id="password"></p>';
echo    '<input type="submit" value="Login">';
echo '</form>';
}
?>
</body>
</html>