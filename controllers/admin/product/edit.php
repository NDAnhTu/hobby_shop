<?php

use Core\Database;

$db = new Database();
$id = $_GET['id'];

$categories = $db->query('SELECT * FROM categories')->getAll();
$brands = $db->query('SELECT * FROM brands')->getAll();
$product = $db->query("SELECT * FROM products WHERE id = :id", [
    'id' => $id
])->getOnce();

view('admin/product/edit.view.php', [
    'categories' => $categories,
    'brands' => $brands,
    'product' => $product
]);
