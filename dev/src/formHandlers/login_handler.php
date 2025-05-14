<?php
include_once(__DIR__."/../Database/Database.php");
include_once(__DIR__."/../helpers/auth.php");


if($_SERVER['HTTP_REFERER'] != 'http://localhost/login.php' || $_SERVER['REQUEST_METHOD'] != "POST") {
  header("Location: ../../login.php");  
  die();
}

if(!isset($_POST['email']) || !isset($_POST['password'])) {
  echo "The email or password are not set";
}

$email = htmlentities($_POST['email']);
$password = htmlentities($_POST['password']);

Database::query("SELECT * FROM customers WHERE email = :email", [':email' => $email]);
$customer_result = Database::get();

if(password_verify($password, $customer_result->password)) {

  if(login($customer_result)) {
    header("Location: ../../index.php");
  } else {
    header("Location: ../../login.php");
  }

  echo "This is a know user and the password was correct";
} else {
  echo "This is not a valid user";
}

