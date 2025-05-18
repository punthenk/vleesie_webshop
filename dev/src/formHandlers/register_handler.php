<?php
include_once(__DIR__."/../Database/Database.php");
include_once(__DIR__."/../helpers/message.php");


$validation_error = false;

if($_SERVER['HTTP_REFERER'] != 'http://localhost/register.php' || $_SERVER['REQUEST_METHOD'] != "POST") {
  setError("legal-error", "U mag alleen via deze pagina inloggen. Vul u gegevens in A.U.B");
  header("Location: ../../register.php");  
  die();
}

if(!isset($_POST['firstname']) || empty($_POST['firstname'])) {
  setError("firstname-error", "Vul uw voornaam in A.U.B");
  $validation_error = true;
}

if (!isset($_POST['lastname']) || empty($_POST['lastname'])) {
  setError("lastname-error", "Vul uw achternaam in A.U.B");
  $validation_error = true;
}

if (!isset($_POST['street']) || empty($_POST['street'])) {
  setError("street-error", "Vul uw straat naam in A.U.B");
  $validation_error = true;
}

if (!isset($_POST['housenumber']) || empty($_POST['housenumber'])) {
  setError("housenumber-error", "Vul uw huisnummer in A.U.B");
  $validation_error = true;
}

if (!isset($_POST['zipcode']) || empty($_POST['zipcode'])) {
  setError("zipcode-error", "Vul uw postcode in A.U.B");
  $validation_error = true;
}

if (!isset($_POST['city']) || empty($_POST['city'])) {
  setError("city-error", "Vul uw plaatsnaam in A.U.B");
  $validation_error = true;
}

if (!isset($_POST['email']) || empty($_POST['email'])) {
  setError("email-error", "Vul uw email in A.U.B");
  $validation_error = true;
}

if (!isset($_POST['password']) || empty($_POST['password'])) {
  setError("password-error", "Vul uw wachtwoord in A.U.B");
  $validation_error = true;
}

if (!isset($_POST['password_confirm']) || empty($_POST['password_confirm'])) {
  setError("passwordconfirm-error", "Vul uw wachtwoord nogmaals in A.U.B");
  $validation_error = true;
}

if ($_POST['password'] != $_POST['password_confirm']) {
  setError("passwordconfirm-validation-error", "Uw wachtwoorden komen niet overeen, probeer het opnieuw");
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

