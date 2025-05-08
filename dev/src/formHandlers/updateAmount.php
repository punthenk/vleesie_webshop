<?php
include_once(__DIR__."/../Database/Database.php");

$cart_id = $_POST['cart_id'];
$product_id = $_POST['product_id'];
$amount = $_POST['amount'];

Database::query("UPDATE cart_items SET amount = :amount WHERE ID = :cart_id AND product_id = :product_id",
  [
    ':amount' => $amount,
    ':product_id' => $product_id,
    ':cart_id' => $cart_id
  ]
);

header("Location: ../../cart.php");
