<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
</head>
<body>
<?php
if(empty($_SESSION["userid"])){
    $_SESSION["msg"] = "Sie müssen eingeloggt sein, um diese Seite benutzen zu können";
    header("Location: ../");
} else {
    echo "<form action = './accounts.php' method = 'POST'>";
    echo "<p>Username: <input type = 'text' name = 'username'></p>";
    echo "<p>Domain: <select name = 'domain'>";
    echo "<option value = 'FALSE'>-- Bitte auswählen --</option>";
            $sql = "SELECT id, domain FROM domains";
            $result = $conn->query($sql);
            while ($row = $result->fetch_assoc()){
                echo "<option value = '" . $row["domain"] . "'>" . $row["domain"] . "</option>";
            }
    echo "</select></p>";
    echo "<p>Passwort: <input type ='password' name = 'password'></p>";
    echo "<";
}
?>
</body>
</html>