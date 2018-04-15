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

if (isset($_SESSION["sessionid"]) == FALSE) {
    echo '<a href="login.php">Login</a> ';
    echo '<a href="register.php">Registrieren</a>';
} else {
    echo "<p>Sie sind eingeloggt!</p>";
    echo "<a href='logoff.php'>Ausloggen</a>";
}
?>
</body>
</html>
