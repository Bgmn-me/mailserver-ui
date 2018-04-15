<?php 

session_start();

if (isset($_SESSION["sessionid"]) == FALSE) {
  header("Location: ../?msg=Du%20musst%20eingeloggt%20sein%2C%20um%20dich%20ausloggen%20zu%20k%C3%B6nnen!");
} else {
  session_destroy();
  header("Location: ../?msg=Du%20wurdest%20ausgeloggt!");
  exit();
}

?>