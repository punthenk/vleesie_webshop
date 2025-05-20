<?php
include_once(__DIR__."/../Database/Database.php");
include_once(__DIR__."/../helpers/auth.php");
include_once(__DIR__."/../helpers/message.php");

if($_SERVER['REQUEST_METHOD'] != "POST") {
  header("Location: " . getLastVisitedPage());
  exit();
}

if(!isLoggedIn()) {
  setMessage("not-login-warning", "Je moet inloggen om deze functie te kunnen gebruiken");
  header("Location: " . getLastVisitedPage());
  exit();
}

$product_id = intval($_POST['product_id']);
$cart_id = 0;

function getCartID():mixed 
{
  Database::query("SELECT ID FROM cart WHERE customer_id = :user_id AND ordered = 0",
    [':user_id' => user_id()]);
  $result = Database::get();
  if(isset($result) && !is_null($result) && !empty($result)) {
    return $result->ID;
  }
  return null;
}

if(empty(getCartID()) || is_null(getCartID())) {
  Database::query("INSERT INTO cart (customer_id) VALUES (:user_id)", [":user_id" => user_id()]);
  $result = Database::get();
  $cart_id = getCartID();
} else {
  $cart_id = getCartID();
}


Database::query("SELECT * FROM cart_items WHERE cart_id = :cart_id AND product_id = :product_id",
  [':cart_id' => $cart_id, ':product_id' => $product_id]);
$result = Database::get();

if(empty($result) || is_null($result) || !$result) {
  $amount = 1;
  $result_insert = Database::query("INSERT INTO cart_items(cart_id, product_id, amount) VALUES 
    (:cart_id, :product_id, :amount)", [':cart_id' => $cart_id, ':product_id' => $product_id, ':amount' => $amount]);

} else {
  Database::query("UPDATE cart_items SET amount = amount + :amount WHERE cart_id = :cart_id AND product_id = :product_id",
    [':amount' => 1, ':cart_id' => $cart_id, ':product_id' => $product_id]);
}

if(!headers_sent()) {
  header("Location: " . getLastVisitedPage());
  exit();
}
