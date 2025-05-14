<?php
include_once(__DIR__."/../Database/Database.php");
include_once(__DIR__."/../helpers/auth.php");

if($_SERVER['REQUEST_METHOD'] != "POST") {
  header("Location: " . getLastVisitedPage());
  exit();
}

$product_id = $_POST['product_id'];

function UpdateAmount($product_id, $amount) {
  Database::query("UPDATE cart_items SET amount = amount + :amount WHERE product_id = :product_id", [':amount' => $amount, ':product_id' => $product_id]);
}

try {
  Database::query("SELECT * FROM cart_items WHERE product_id = :id", [':id' => $product_id]);
  $result = Database::getAll();

  if(empty($result)) {
    Database::query("INSERT INTO cart_items (ID, product_id, amount) VALUES (ID, :product_id, 1)", [':product_id' => $product_id]);
  } else {
    UpdateAmount($product_id, 1);
  }

} catch (PDOException $err) {
  echo "It all went very very wrong" . $err;
}

if(!headers_sent()) {
  header("Location: " . getLastVisitedPage());
  exit();
}
