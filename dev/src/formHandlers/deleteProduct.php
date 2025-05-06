<?php
require "../database/dbconnection.class.php";

$dbconnect = new Database();

$product_id = $_POST['product_id'];
$cart_id = $_POST['cart_id'];

echo $product_id;
echo $cart_id;

$sql = "DELETE FROM cart_items WHERE ID = :id AND product_id = :product_id";
$query = $dbconnect->prepare($sql);
$query->execute([':id' => $cart_id, ':product_id' => $product_id]);

$product = $query -> fetch(PDO::FETCH_ASSOC);
