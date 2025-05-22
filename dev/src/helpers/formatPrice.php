<?php 

function formatPrice($price): string
{
  if(is_numeric($price) && $price == floor($price)) {
    return $price . ",-";
  }

  return number_format($price, 2, ",");
}
