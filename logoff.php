<?php 
session_start();

if (isset($_SESSION["sessionid"]) == FALSE) {
  $_SESSION["msg"] = "Du musst eingeloggt sein, um dich auszuloggen zu können!";
  header("Location: ../");
  exit();
} else {
  session_destroy();
  header("Location: ../");
  exit();
}

?>