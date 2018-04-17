<?php
session_start();
require_once "CSPRNG/random.php";
require_once "./dbconnect.php"
?>
<!DOCTYPE html>
<html>
<head>
<title>Home - Bgmn.me</title>
<meta charset = "utf8";>
</head>
<body>

<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(empty($_POST["salutation"])){
        $_SESSION["msg"] = "Anrede darf nicht Leer sein!";
        header("Location: ../");
    } else {
        $salutation = $_POST["salutation"];
    }
    if(empty($_POST["firstname"])){
        $_SESSION["msg"] = "Vorname darf nicht Leer sein!";
    } else {
        $firstname = $_POST["firstname"];
    }
    if(empty($_POST["lastname"])){
        $_SESSION["msg"] = "Nachname darf nicht Leer sein!";
    } else {
        $lastname = $_POST["lastname"];
    }
    if(empty($_POST["username"])){
        $_SESSION["msg"] = "Username darf nicht Leer sein!";
    } else {
        $username = $_POST["username"];
    }
    if($_POST["domain"] == FALSE){
        $_SESSION["msg"] = "Bitte Domain auswählen!";
    } else {
        $domain = $_POST["domain"];
    }
    if(empty($_POST["password"])){
        
    } else if ($_POST["password"] != $_POST["password2"]) {
        $_SESSION["msg"] = "Passwörter stimmen nicht überein!";
    } else {
        $password = $_POST["password"];
        $rng = new CSPRNG(TRUE);
        $salt = $rng->GenerateString(60);
        $options = [
            'cost' => 8,
            'salt' => $salt,
        ];
        $password = password_hash($password, PASSWORD_BCRYPT, $options);
    }
    
    $sqlacc = "INSERT INTO accounts (username, domain, passwort, salt) VALUES ('" . $username . "','" . $domain . "','" . $password . "','" . $salt . "')";
    $sqluser = "INSERT INTO users (salutation, username, lastname, firstname, birthdate) VALUES ('" . $salutation . "','" . $lastname . "','" . $firstname . "','" . $birthdate . "','" . $username . "')";
    $conn->query($sqlacc);
    $conn->query($sqluser);
}
?>
<form name = "register" action = "./login" method = "POST">
<p>Anrede:  <select name = "salutation">
                <option value = "FALSE">-- Bitte auswählen --</option>
                <option value = "frau">Frau</option>
                <option value = "mann">Mann</option>
            </select>
<p>Vorname: <input type = "firstname" name = "firstname"> Nachname: <input type = "lastname" name = "lastname"></p>
<p>Geburtsdatum: 
<select name = "birthday" onchange = "onBirthDate(0,this.value)">
<?php
for($day=1;$day <= 31;$day++){
    if ($day <= 9){
        $day = "0" . $day;
    }
    echo "<option id = 'bday" . $day . "'value = '" . $day . "'>" . $day . ".</option>";
}
?>
</select>
<select name = "birthmonth" id = "birthmonth" onchange="onBirthMonth(this.value)">
<?php
for($month=1;$month <= 12;$month++){
    if ($month <= 9){
        $month = "0" . $month;
    }
    echo "<option value = '" . $month ."'>" . $month . ".</option>";
}
?>
</select>
<select name = "birthyear" onchange = "onBirthDate(2,this.value)">
<?php
for($year=1970;$year <= 2018;$year++){
    echo "<option value = '" . $year . "'>" . $year . "</option>";
}
?>
</select>
</P>
<p id = "output"></p>
<p>Username: <input type = "username" name = "username"></p>
<p>Password: <input type = "password" name = "password"></p>
<p>Password wiederholen: <input type = "password" name = "password2"></p>
<input type = "submit" name = "submit" value = "Einloggen">
</form>
<script src = "/projects/mailserver-ui/js/javascript.js"></script>
</body>
</html>