<?php
session_set_cookie_params(10800,TRUE,TRUE);
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
    } else if (!preg_match("/^[a-zA-Z]*$/",$_POST["firstname"])) {
        $_SESSION["msg"] = "Bitte nur Buchstaben verwenden!";
        header("Location: ../register.php");
    } else {
        $firstname = $_POST["firstname"];
    }
    if(empty($_POST["lastname"])){
        $_SESSION["msg"] = "Bitte Nachname eingeben!";
    }  else if (!preg_match("/^[a-zA-Z]*$/",$_POST["lastname"])) {
        $_SESSION["msg"] = "Bitte nur Buchstaben verwenden!";
        header("Location: ../register.php");
    } else {
        $lastname = $_POST["lastname"];
    }
    if(empty($_POST["username"])){
        $_SESSION["msg"] = "Bitte Username eingeben!";
    } else if (!preg_match("/^[a-zA-Z0-9_.-]*$/",$_POST["username"])) {
        $_SESSION["msg"] = "Bitte nur Buchstaben verwenden!";
        header("Location: ../");
    } else {
        $username = $_POST["username"];
    }
    if(empty($_POST["birthday"]) || empty($_POST["birthmonth"]) || empty($_POST["birthyear"])) {
        $_SESSION["msg"] = "Bitte Geburtsdatum eingeben!";
    } else {
        $birthdate = $_POST["birthyear"] . "-" . $_POST["birthmonth"] . "-" . $_POST["birthmonth"]; 
    }
    if($_POST["domain"] == FALSE){
        $_SESSION["msg"] = "Bitte Domain auswählen!";
    } else {
        $domain = $_POST["domain"];
    }
    if(empty($_POST["password"])){
        $SESSION["msg"] = "Bitte Passwort eingeben!";
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
    $sqluser = "INSERT INTO users (username, salutation, lastname, firstname, birthdate) VALUES ('" . $username . "','" . $salutation . "','" . $lastname . "','" . $firstname . "','" . $birthdate . "')";
    if($conn->query($sqlacc) && $conn->query($sqluser)){
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
<p>Domain:  <select name = "domain">
            <option value = "FALSE">-- Bitte auswählen --</option>
            <?php
            $sql3 = "SELECT id, domain FROM domains";
            $result = $conn->query($sql3);
            while ($row = $result->fetch_assoc()){
                echo "<option value = '" . $row["domain"] . "'>" . $row["domain"] . "</option>";
            }
            ?>
            </select></p>
<p>Password: <input type = "password" name = "password"></p>
<p>Password wiederholen: <input type = "password" name = "password2"></p>
<input type = "submit" name = "submit" value = "Registrieren">
</form>
<script src = "/projects/mailserver-ui/js/javascript.js"></script>
</body>
</html>