<?php
include_once(__DIR__."../Database/Database.php");
include_once(__DIR__."../helpers/auth.php");

function countItemsInCart(): int
{
  $amount = 0; 
  Database::query("SELECT ID FROM cart WHERE customer_id = :user_id", [':user_id' => user_id()]);
  $cart_id = Database::get();

  try {
    Database::query("SELECT SUM(amount) AS total FROM cart_items WHERE cart_id = :cart_id", [':cart_id' => $cart_id->ID]);
    $result = Database::get();

    if ($result && $result->total !== null) {
      $amount = (int) $result->total;
    }
  } catch (PDOException $err) {
    echo $err;
    echo "It did not work the way we wanted";
  }
  

  return $amount;
}
