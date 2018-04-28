<?php
session_set_cookie_params(3600,"","",TRUE,TRUE);
session_start();
require_once "CSPRNG/random.php";
require_once "./dbconnect.php";
?>
<!DOCTYPE html>
<html>
<head>
<title>Registrieren - Bgmn.me</title>
<meta charset = "utf8";>
</head>
<body>

<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){
    if($_POST["salutation"] == FALSE){
        $_SESSION["msg"] = "Bitte Anrede auswählen!";
        header("Location: ../register.php");
    } else {
        $salutation = $_POST["salutation"];
    }
    if(empty($_POST["firstname"])){
        $_SESSION["msg"] = "Bitte Vornamen eingeben!";
        header("Location: ../register.php");
    } else if (!preg_match("/^[a-zA-Z]*$/",$_POST["firstname"])) {
        $_SESSION["msg"] = "Bitte nur Buchstaben verwenden!";
        header("Location: ../register.php");
    } else {
        $firstname = $_POST["firstname"];
    }
    if(empty($_POST["lastname"])){
        $_SESSION["msg"] = "Bitte Nachname eingeben!";
        header("Location: ../register.php");
    }  else if (!preg_match("/^[a-zA-Z]*$/",$_POST["lastname"])) {
        $_SESSION["msg"] = "Bitte nur Buchstaben verwenden!";
        header("Location: ../register.php");
    } else {
        $lastname = $_POST["lastname"];
    }
    if(empty($_POST["username"])){
        $_SESSION["msg"] = "Bitte Username eingeben!";
        header("Location: ../register.php");
    } else if (!preg_match("/^[a-zA-Z0-9_.-]*$/",$_POST["username"])) {
        $_SESSION["msg"] = "Bitte nur Buchstaben verwenden!";
        header("Location: ../");
    } else {
        $username = $_POST["username"];
    }
    if(empty($_POST["birthdate"])) {
        $_SESSION["msg"] = "Bitte Geburtsdatum eingeben!";
        header("Location: ../register.php");
    } else {
        $birthdate = $_POST["birthdate"]; 
    }
    if($_POST["domain"] == FALSE){
        $_SESSION["msg"] = "Bitte Domain auswählen!";
        header("Location: ../register.php");
    } else {
        $domain = $_POST["domain"];
    }
    if(empty($_POST["password"])){
        $SESSION["msg"] = "Bitte Passwort eingeben!";
        header("Location: ../register.php");
    } else if ($_POST["password"] != $_POST["password2"]) {
        $_SESSION["msg"] = "Passwörter stimmen nicht überein!";
        header("Location: ../register.php");
    } else {
        $password = $_POST["password"];
        $rng = new CSPRNG(TRUE);
        $salt = $rng->GenerateString(60);
        $options = [
            'cost' => 8,
            'salt' => $salt,
        ];
        $password = "{BLF-CRYPT}" . password_hash($password, PASSWORD_BCRYPT, $options);
    }
    
    $edit = 1;
    $sqluser = "INSERT INTO users (username, password, salt, salutation, lastname, firstname, birthdate) VALUES ('" . $username . "','" . $password . "','" . $salt . "','" . $salutation . "','" . $lastname . "','" . $firstname . "','" . $birthdate . "')";
    if($conn->query($sqluser)){
        echo "Funktioniert";
    } else {
        echo "Funktioniert doch nicht, Error: " . $conn->error;
        }
}
?>
<form name = "register" action = "./register.php" method = "POST">
<p>Anrede:  <select name = "salutation">
                <option value = "FALSE">-- Bitte auswählen --</option>
                <option value = "frau">Frau</option>
                <option value = "herr">Herr</option>
            </select>
<p>Vorname: <input type = "firstname" name = "firstname"> Nachname: <input type = "lastname" name = "lastname"></p>
<p>Geburtsdatum: <input type ="date" name = "birthdate"></p>
<p>Username: <input type = "username" name = "username"></p>
<!--<p>Domain:  <select name = "domain">
            <option value = "FALSE">-- Bitte auswählen --</option>
            <?php
            /*$sql3 = "SELECT id, domain FROM domains";
            $result = $conn->query($sql3);
            while ($row = $result->fetch_assoc()){
                echo "<option value = '" . $row["domain"] . "'>" . $row["domain"] . "</option>";
            }*/
            ?>
            </select></p>-->
<p>Password: <input type = "password" name = "password"></p>
<p>Password wiederholen: <input type = "password" name = "password2"></p>
<input type = "submit" name = "submit" value = "Registrieren">
</form>
</body>
</html>
