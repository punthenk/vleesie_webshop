<?php
require "../database/dbconnection.class.php";
$dbconnect = new Database();

$product_id = $_POST['product_id'];

try {
  $product_sql = "SELECT * FROM products WHERE ID = :id";
  $query = $dbconnect->prepare($product_sql);
  $query->execute([':id' => $product_id]);

  $result = $query -> fetch(PDO::FETCH_ASSOC);
} catch (PDOException $err) {
  echo $err;
}

function UpdateAmount($product_id, $amount) {
  $dbconnect = new Database();
  $update_amount_sql = "UPDATE cart_items SET amount = amount + :amount WHERE product_id = :product_id";
  $update_amount_query = $dbconnect->prepare($update_amount_sql);
  $update_amount_query->execute([':amount' => $amount, ':product_id' => $product_id]);
}

try {
  $insert_product_sql = "INSERT INTO cart_items (ID, product_id, amount) VALUES (ID, :product_id, 2)";
  $insert_query = $dbconnect->prepare($insert_product_sql);
  $insert_query->execute([':product_id' => $product_id]);
} catch (PDOException $err) {
  UpdateAmount($product_id, 1, $dbconnect);
}


