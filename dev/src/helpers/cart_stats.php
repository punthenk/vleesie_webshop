<?php
include_once(__DIR__.'../Database/Database.php');

function countItemsInCart(): int
{
  $amount = 0; 

  try {
    Database::query("SELECT SUM(amount) AS total FROM cart_items");
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
