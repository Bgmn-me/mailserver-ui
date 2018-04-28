<?php
session_set_cookie_params(0,"","",TRUE,TRUE);
session_start();
require_once "./dbconnect.php" ;
?>
<!DOCTYPE html>
<html>
<body>
<?php

if (isset($_SESSION["sessionid"])) {
    $_SESSION["msg"] = "Du bist bereits eingeloggt!";
    header("Location: ../");
    exit();
} else if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["email"]) && empty($_POST["password"])){
        $_SESSION["msg"] = "Bitte Email und Passwort eingeben!";
        header("Location: ../login.php");
    }
    if (empty($_POST["email"]) && isset($_POST["password"])){
        $_SESSION["msg"] = "Bitte Email eingeben!";
        header("Location: ../login.php");
    } else {
        $email = $_POST["email"];
        $emailarr = str_split($email);
        for($i=0; $i <= (strlen($email)-1);$i++){
            eval("\$posofchar = \$emailarr[" . $i . "];");
            if($posofchar == "@"){
                $posofat = $i;
                $username = substr($email,0,$i);
                $domain = substr($email,($i+1),strlen($email));
                break;
            }
        }
    }
    if(empty($_POST["password"]) && isset($_POST["email"])){
        $_SESSION["msg"] = "Bitte Passwort eingeben!";
        header("Location: ../login.php");
    } else {
        $password = $_POST["password"];
    }
    $sql = "SELECT id, passwort, salt FROM users WHERE username = '" . $username . "' AND domain = '" . $domain . "'";
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
        $_SESSION["userid"] = $id;
        $_SESSION["msg"] = "Sie sind eingeloggt";
        if(empty($_POST["savelogin"])) {
            $_POST["savelogin"] = false;
        } else {
            $_SESSION["sl"] = "Yes";
        }
        header("Location: ../");
    }
} else if(empty($_SESSION["sessionid"])){

    if (isset($_SESSION["msg"])) {
        echo "<h3>".$_SESSION["msg"]."</h3>";
        $_SESSION["msg"] = null;
    }

    echo '<form action="" method="POST">';
    echo    '<p>Email: <input type="email" name="email" id="email"></p>';
    echo    '<p>Password: <input type="password" name="password" id="password"></p>';
    echo    '<p>Login speichern <input type = "checkbox" name = "savelogin" value = "true"></p>';
    echo    '<input type = "submit" value = "Login" >';
    echo '</form>';
    }
?>
</body>
</html>