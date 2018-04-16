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

if (isset($_SESSION["msg"])) {
    echo "<h3>".$_SESSION["msg"]."</h3>";
    $_SESSION["msg"] = null;
}

if (isset($_SESSION["sessionid"]) == FALSE) {
    echo "<h3>Sie sind nicht eingeloggt!</h3>";
    echo '<a href="login.php">Login</a> ';
    echo '<a href="register.php">Registrieren</a>';
} else {
    echo "<h3>Sie sind eingeloggt!</h3>";
    echo "<a href='logoff.php'>Ausloggen</a>";
}
?>
</body>
</html>
