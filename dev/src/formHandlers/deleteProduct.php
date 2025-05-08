<?php
include_once(__DIR__."/../Database/Database.php");

$product_id = $_POST['product_id'];
$cart_id = $_POST['cart_id'];

Database::query("DELETE FROM cart_items WHERE ID = :id AND product_id = :product_id", [':id' => $cart_id, ':product_id' => $product_id]);


header("Location: ../../cart.php");
