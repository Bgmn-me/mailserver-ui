<?php
session_start();
?>
<!DOCTYPE html>
<html>
<body>
<?php
if($_POST["username"] == "Dominik" && $_POST["password"] == "Test"){

    echo "Login successfully!";
    echo "<a href = './'>zurück</a>";
    $_SESSION["sessionid"] = 001;
}
?>
</body>
</html>