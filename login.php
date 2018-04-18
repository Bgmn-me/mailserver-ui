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
        $_SESSION["msg"] = "Bitte Username eingeben!";
        header("Location: ../");
    } else {
        $username = $_POST["username"];
    }
    if(empty($_POST["password"])){
        $_SESSION["msg"] = "Bitte Passwort eingeben!";
        header("Location: ../");
    } else {
        $password = $_POST["password"];
    }
    $sql = "SELECT id, passwort, salt FROM accounts WHERE username = '" . $username . "'";
    $result = $conn->query($sql);
    while ($row = $result->fetch_assoc()){
        $password_sql = $row["passwort"];
        $salt = $row["salt"];
        $id = $row["id"];
    }
    $options = [
        'cost' => 8,
        'salt' => $salt,
    ];
    $passwordhash = password_hash($password, PASSWORD_BCRYPT, $options);
    if(strlen($password_sql) == strlen($passwordhash)) {
    $y = 0;
    $pw_err = false;
    for($x = 1;$x <= strlen($password_sql);$x++){
        if(substr($password_sql,$y,$x) != substr($passwordhash,$y,$x)) {
            $pw_err = true;
        }
        $y++;

    }
}
if($pw_err != true){
    $_SESSION["sessionid"] = $id;
}
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