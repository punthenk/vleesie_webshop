<?php
include_once(__DIR__."/../Database/Database.php");
include_once(__DIR__."/../helpers/auth.php");

if($_SERVER['REQUEST_METHOD'] != "POST") {
  /*header("Location: " . getLastVisitedPage());*/
  echo "Dit werd niet aangeroepen door de post method";
  /*exit();*/
}

$product_id = intval($_POST['product_id']);

Database::query("SELECT ID FROM cart WHERE customer_id = :user_id AND ordered = 0", [':user_id' => user_id()]);
$cart = Database::get();
$cart_id = 0;
if(empty($cart) || is_null($cart)) {
  Database::query("INSERT INTO cart (customer_id) VALUES (:id)", [":id" => user_id()]);
  $cart_id = Database::get();
} else {
  $cart_id = $cart->ID;
}

function UpdateAmount($product_id, $amount) {
  Database::query("UPDATE cart_items SET amount = amount + :amount WHERE product_id = :product_id", [':amount' => $amount, ':product_id' => $product_id]);
}

try {
  Database::query("SELECT * FROM cart_items WHERE cart_id = :cart_id AND product_id = :id", [':id' => $product_id, ':cart_id' => $cart_id]);
  $result = Database::get();

  if(empty($result) || is_null($result)) {
    Database::query("INSERT INTO cart_items (ID, cart_id, product_id, amount) VALUES (ID, :cart_id :product_id, 1)", [':cart_id' => $cart_id, ':product_id' => $product_id]);
  } else {
    UpdateAmount($product_id, 1);
  }

} catch (PDOException $err) {
  echo "It all went very very wrong" . $err;
}

/*if(!headers_sent()) {*/
/*  header("Location: " . getLastVisitedPage());*/
/*  exit();*/
/*}*/
