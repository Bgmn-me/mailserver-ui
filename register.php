<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
<title>Home - Bgmn.me</title>
<meta charset = "utf8";>
</head>
<body>

<?php
require_once "CSPRNG/random.php";
$rng = new CSPRNG(TRUE);
$str = $rng->GenerateString(60);
echo "Salt: " . $str . "<br>";
$options = [
    'cost' => 8,
    'salt' => $str,
];
$password = password_hash("Hello", PASSWORD_BCRYPT, $options);
echo "Passwort: " . $password . "<br>";
if (password_verify("Hello", $password) == TRUE){
 echo "Yeah, Richtiges Passwort";
} else {
    echo "Hah, verkackt";
}
?>
<form action = "./login" method = "POST">
<p>Anrede:  <select name = "salutation">
                <option value = "FALSE">-- Bitte auswählen --</option>
                <option value = "women">Frau</option>
                <option value = "men">Mann</option>
            </select>
<p>Vorname: <input type = "firstname" name = "firstname"> Nachname: <input type = "lastname" name = "lastname"></p>
<p>Geburtsdatum: 
<select name = "birthday">
<?php
for($day=1;$day <= 31;$day++){
    if ($day <= 9){
        $day = "0" . $day;
    }
    echo "<option value = '" . $day . "'>" . $day . ".</option>";
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
<select name = "birthyear">
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
<p>Password wiederholen: <input type = "password" name = "password"></p>
<input type = "submit" name = "submit" value = "Einloggen">
</form>
<script src = "/projects/mail/JS/javascript.js"></script>
</body>
</html>