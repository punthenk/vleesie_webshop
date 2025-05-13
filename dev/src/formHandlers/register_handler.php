<?php
include_once(__DIR__."/../Database/Database.php");


$validation_error = false;

if($_SERVER['HTTP_REFERER'] != 'http://localhost/register.php' || $_SERVER['REQUEST_METHOD'] != "POST") {
  header("Location: ../../register.php");  
  die();
}

if(!isset($_POST['firstname']) || empty($_POST['firstname'])) {
   $validation_error = true;
}

if (!isset($_POST['lastname']) || empty($_POST['lastname'])) {
   
   $validation_error = true;
}

if (!isset($_POST['street']) || empty($_POST['street'])) {
   $validation_error = true;
}

if (!isset($_POST['housenumber']) || empty($_POST['housenumber'])) {
   $validation_error = true;
}

if (!isset($_POST['zipcode']) || empty($_POST['zipcode'])) {
   $validation_error = true;
}

if (!isset($_POST['city']) || empty($_POST['city'])) {
   $validation_error = true;
}

if (!isset($_POST['email']) || empty($_POST['email'])) {
   $validation_error = true;
}

if (!isset($_POST['password']) || empty($_POST['password'])) {
   $validation_error = true;
}

if (!isset($_POST['password_confirm']) || empty($_POST['password_confirm'])) {
   $validation_error = true;
}

if ($_POST['password'] != $_POST['password_confirm']) {
  header("Location: ../../register.php");
  exit();
}

if($validation_error) {
  header('Location: ../../register.php');
  exit();
}

$firstname = htmlentities($_POST['firstname']);
$lastname = htmlentities($_POST['lastname']);
$prefixes = htmlentities($_POST['prefixes']);
$street = htmlentities($_POST['street']);
$housenumber = htmlentities($_POST['housenumber']);
$addition = htmlentities($_POST['addition']);
$zipcode = htmlentities($_POST['zipcode']);
$city = htmlentities($_POST['city']);
$email = htmlentities($_POST['email']);
$password = htmlentities($_POST['password']);

$result = Database::query("INSERT INTO customers (ID, firstname, lastname, prefix, street, house_number, addition, zipcode, city, email, password)
  VALUES (ID, :firstname, :lastname, :prefix, :street, :house_number, :addition, :zipcode, :city, :email, :password)",
[
':firstname' => $firstname,
':lastname' => $lastname,
':prefix' => $prefixes,
':street' => $street,
':house_number' => $housenumber,
':addition' => $addition,
':zipcode' => $zipcode,
':city' => $city,
':email' => $email,
':password' => password_hash($password, PASSWORD_DEFAULT),
]);

header("Location: ../../register.php");
exit();

