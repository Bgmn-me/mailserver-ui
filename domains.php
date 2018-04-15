<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head><title>Mail - Bgmn.me</title></head>
<?php
if(isset($_POST["domain"]) == TRUE){
    $pd = "POST is not empty";
    echo "<script>console.log('" . $pd . "')</script>";
    $username = "root";
    $password = "";
    $server = "127.0.0.1";
    $database = "vmail";

    $conn = new  mysqli($server,$username,$password,$database);
    if($conn->connect_error){
        die("Connection failed:" . $conn->connect_error);
    }

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
