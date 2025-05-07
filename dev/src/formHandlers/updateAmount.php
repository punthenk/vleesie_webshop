<?php
require "../Database/Database.php";
$dbconnect = new Database();

$cart_id = $_POST['card_id'];
$product_id = $_POST['product_id'];
$amount = $_POST['amount'];

$sql = "UPDATE cart_items SET amount WHERE ID = :cart_id";
$query = $dbconnect->prepare($sql);
$query->execute([":cart_id" => $cart_id]);
