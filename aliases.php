<?php
session_set_cookie_params(10800,TRUE,TRUE);
session_start();
require_once "./dbconnect.php";
?>
<!DOCTYPE html>
<html>
<head><title>Alias hinzufügen- Bgmn.me</title></head>
<?php
    if(empty($_SESSION["id"])){
        $_SESSION["msg"] = "Sie müssen eingeloggt sein, um diese Seite Aufrufen zu können!";
        header("Location: ../");
    }
?>
<body>
<form action="index.php" method="post">
    <p>Account:
        <select name = "account">
            <option value = "FALSE">-- Bitte auswählen --</option>
                <?php
                    $sql3 = "SELECT id, domain FROM domains";
                    $result = $conn->query($sql3);
                    while ($row = $result->fetch_assoc()){
                        echo "<option value = '" . $row["domain"] . "'>" . $row["domain"] . "</option>";
                    }
                ?>
        </select>
    </p>
    <p>Username: <input  type = "text" name = "username"></p>
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
     <p><input type = "submit" name = "submit" value = "submit" /></p>
</form>
</body>
</html>