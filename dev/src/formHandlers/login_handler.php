<?php
include_once(__DIR__."/../Database/Database.php");
include_once(__DIR__."/../helpers/auth.php");
include_once(__DIR__."/../helpers/message.php");


if($_SERVER['HTTP_REFERER'] != 'http://localhost/login.php' || $_SERVER['REQUEST_METHOD'] != "POST") {
  setError("legal-error", "U mag alleen via deze pagina inloggen. Vul u gegevens in A.U.B");
  header("Location: ../../login.php");  
  die();
}

$valid_error = false;

if(!isset($_POST['email']) || empty($_POST['email'])) {
  setError("login-email-error", "Vul uw email in A.U.B");
  $valid_error = true;
}
if(!isset($_POST['password']) || empty($_POST['password'])) {
  setError("login-password-error", "Vul uw wachtwoord in A.U.B");
  $valid_error = true;
}


if($valid_error) {
  header("Location ../../login.php");
  exit();
}

$email = htmlentities($_POST['email']);
$password = htmlentities($_POST['password']);

Database::query("SELECT * FROM customers WHERE email = :email", [':email' => $email]);
$customer_result = Database::get();

if(password_verify($password, $customer_result->password)) {
  if(login($customer_result)) {
    setMessage("succes", "Het inloggen is gelukt!");
    header("Location: ../../index.php");
  } else {
    setError("not-a-user", "Er is iets mis gegaan probeer het opnieuw");
    header("Location: ../../login.php");
  }
} else {
  setError("not-a-user", "Dit is niet een geldige gebruiker. Probeer het opnieuw");
  header("Location: ../../login.php");
}
