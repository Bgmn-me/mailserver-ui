<?php 

session_start();

if (isset($_SESSION["sessionid"]) == FALSE) {
  header("Location: ./?msg=" . htmlspecialchars("Du musst eingeloggt sein, um dich auszuloggen zu können!"));
} else {
  session_destroy();
  header("Location: ./?msg=" . htmlspecialchars("Du wurdest ausgeloggt!"));
  exit();
}

?>