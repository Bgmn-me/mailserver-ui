<?php
session_start();
?>
<!DOCTYPE html>
<html>
<body>
<?php

if (isset($_POST["username"]) && isset($_POST["password"])) {
    if ($_POST["username"] == "Dominik" && $_POST["password"] == "Test") {
        header("Location: ../?msg=Du%20wurdest%20eingeloggt!");
        $_SESSION["sessionid"] = 001;
    }
} else {
    header("Location: ../?msg=Invalid%20request");
}


?>
</body>
</html>