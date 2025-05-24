<?php 
include_once(__DIR__."/../Database/Database.php");

$category_id = $_GET["category"];


function getProducts($category_id): mixed
{
    Database::query("SELECT * FROM products WHERE category = :category", [":category" => $category_id]);
    $result = Database::getAll();

    echo "<pre>";
    print_r($result);
    return $result;
}
