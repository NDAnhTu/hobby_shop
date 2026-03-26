<?php

use Core\Database;

$db = new Database();

$categories = $db->query('SELECT * FROM categories')->getAll();
$brands = $db->query('SELECT * FROM brands')->getAll();

view('admin/product/create.view.php', [
    'categories' => $categories,
    'brands' => $brands
]);
