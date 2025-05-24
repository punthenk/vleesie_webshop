<?php

function getShippingCosts(float $order_total_price): float
{
    if($order_total_price < 40) {
        return 6.99;
    }
    return 0.00;
}
