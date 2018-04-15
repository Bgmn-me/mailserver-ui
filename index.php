<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head><title>Home - Bgmn.me</title></head>
<meta charset = 'utf8'>
<body>

<?php
if (isset($_SESSION["sessionid"]) == FALSE){
    echo "<form action = 'login.php' method = 'POST'>";
    echo "<p>Username: <input type = 'username' name = 'username'></p>";
    echo "<p>Password: <input type = 'password' name = 'password'></p>";
    echo "<input type = 'submit' name = 'submit' value = 'submit'>";
    echo "</form>";
}
else 
echo "Sie sind eingeloggt!";
?>
</body>
</html>