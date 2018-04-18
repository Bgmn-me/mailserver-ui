<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head><title>Domain - Bgmn.me</title></head>
<?php
if(isset($_SERVER["REQUEST_METHOD"]) == "POST"){
    $sql = "insert into domains (domain) values ('" . $_POST["domain"] . "')";
    if ($conn->query($sql) === TRUE){
        $text = "New Record created successfully";
        echo "<script>console.log('" . $text . "')</script>";
    }
    else {
        echo "error: " . $sql . "<br>" . $conn->error;
    }
    $conn->close();
}
else{
    $pd = "POST is empty";
    echo "<script>console.log('" . $pd . "')</script>";
}
?>
<body>
    <form action="index.php" method="post">
        <p>Domain: <input type = "text" name = "domain" /></p>
        <p><input type = "submit" name = "submit" value = "submit" /></p>
    </form>
</body>
</html>
