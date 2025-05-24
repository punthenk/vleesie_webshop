<?php
include_once(__DIR__."/../helpers/auth.php");


if($_SERVER['REQUEST_METHOD'] == "POST") {
  if(isset($_POST['user_id']) && !empty($_POST['user_id'])) {
    logout();
  } else {
    echo"The user_id is not defined" . "<br>";
    var_dump($_POST['user_id']);
  }
} 


if(!headers_sent()) {
  header("Location: ../../index.php");
  exit();
}
