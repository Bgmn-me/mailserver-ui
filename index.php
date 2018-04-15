<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Home - Bgmn.me</title>
    <meta charset="UTF-8">
    <link rel="shortcut icon" href="img/mail_green.png">
</head>
<body>

<?php

if (isset($_GET["msg"])) {
    echo "<h3>".$_GET["msg"]."</h3>";
}

if (isset($_SESSION["sessionid"]) == FALSE){
    echo "<form action = 'login.php' method = 'POST'>";
    echo "<p>Username: <input type = 'username' name = 'username'></p>";
    echo "<p>Password: <input type = 'password' name = 'password'></p>";
    echo "<input type = 'submit' name = 'login' value = 'login'>";
    echo "<input type = 'submit' name = 'register' value = 'register'>";
    echo "</form>";
} else {
    echo "Sie sind eingeloggt!";
}
?>
</body>
</html>
