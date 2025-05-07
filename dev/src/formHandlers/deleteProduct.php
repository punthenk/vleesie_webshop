<?php
require "../Database/Database.php";

$dbconnect = new Database();

$redirect_url = isset($_POST['redirect_url']) ? $_POST['redirect_url'] : '/index.php';
$product_id = $_POST['product_id'];
$cart_id = $_POST['cart_id'];

$sql = "DELETE FROM cart_items WHERE ID = :id AND product_id = :product_id";
$query = $dbconnect->prepare($sql);
$query->execute([':id' => $cart_id, ':product_id' => $product_id]);

$product = $query -> fetch(PDO::FETCH_ASSOC);

if(!headers_sent()) {
  header("Location: " . $redirect_url);
  exit;
}
