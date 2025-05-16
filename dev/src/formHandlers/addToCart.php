<?php
include_once(__DIR__."/../Database/Database.php");
include_once(__DIR__."/../helpers/auth.php");

if($_SERVER['REQUEST_METHOD'] != "POST" || !isLoggedIn()) {
  /*header("Location: " . getLastVisitedPage());*/
  echo "Dit werd niet aangeroepen door de post method";
  /*exit();*/
}

$product_id = intval($_POST['product_id']);
$cart_id = 0;

Database::query("SELECT ID FROM cart WHERE customer_id = :user_id AND ordered = 0", [':user_id' => user_id()]);
$cart = Database::get();

if(empty($cart) || is_null($cart)) {
  Database::query("INSERT INTO cart (customer_id) VALUES (:user_id)", [":user_id" => user_id()]);
  $cart_id = Database::get()->ID;
  var_dump($cart_id);
} else {
  $cart_id = $cart->ID;
  var_dump($cart_id);
  var_dump($product_id);
}


Database::query("SELECT * FROM cart_items WHERE cart_id = :cart_id AND product_id = :product_id", [':cart_id' => $cart_id, ':product_id' => $product_id]);
$result = Database::get();
echo "<pre>";
var_dump($result);

if(empty($result) || is_null($result)) {
  Database::query("INSERT INTO `cart_items`(`ID`, `cart_id`, `product_id`, `amount`) VALUES (ID, :cart_id, :product_id, :amount)", [':cart_id' => $cart_id, ':product_id' => $product_id, ':amount' => 1]);
  $result_insert = Database::get();
  var_dump($result_insert);
  echo "He need to do a insert";
} else {
  Database::query("UPDATE cart_items SET amount = amount + :amount WHERE cart_id = :cart_id AND product_id = :product_id", [':amount' => 1, ':cart_id' => $cart_id, ':product_id' => $product_id]);
  echo "He need to do a update";
}


/*if(!headers_sent()) {*/
/*  header("Location: " . getLastVisitedPage());*/
/*  exit();*/
/*}*/
