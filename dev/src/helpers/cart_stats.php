<?php
require_once("/var/www/html/src/database/dbconnection.class.php");

function countItemsInCart(): int
{
  $dbconnect = new Database();

  $amount = 0; 

  $sql = "SELECT SUM(amount) AS total FROM cart_items";
  $query = $dbconnect->prepare($sql);
  $query->execute(); 

  $result = $query->fetch(PDO::FETCH_ASSOC);
  
  if ($result && $result['total'] !== null) {
    $amount = (int) $result['total'];
  }

  return $amount;
}
