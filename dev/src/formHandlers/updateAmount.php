<?php
require "../database/dbconnection.class.php";
$dbconnect = new Database();

function UpdateAmount($product_id, $amount) {
  $dbconnect = new Database();
  $update_amount_sql = "UPDATE cart_items SET amount = amount + :amount WHERE product_id = :product_id";
  $update_amount_query = $dbconnect->prepare($update_amount_sql);
  $update_amount_query->execute([':amount' => $amount, ':product_id' => $product_id]);
}
