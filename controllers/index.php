<?php

use Core\Database;

$db = new Database();
$page = $_GET['page'] ?? 1;
$search = $_GET['key_word'] ?? '';
$product_per_page = 6;
$offset = ($page - 1) * $product_per_page;

if (! empty($search)) {
    $numberOfProducts = $db->query("SELECT COUNT(id) as count FROM products WHERE name LIKE '%$search%'")->getOnce();
    $data = $db->query("SELECT p.id, p.name, p.price, p.short_description, p.description, p.image, c.name as category_name 
    FROM products as p 
    JOIN categories as c 
    ON p.category = c.id 
    WHERE p.name LIKE '%$search%'
    ORDER BY p.id
    LIMIT $product_per_page 
    OFFSET $offset")->getAll();
} else {
    $numberOfProducts = $db->query("SELECT COUNT(id) as count FROM products")->getOnce();
    $data = $db->query("SELECT p.id, p.name, p.price, p.short_description, p.description, p.image, c.name as category_name 
    FROM products as p 
    JOIN categories as c 
    ON p.category = c.id 
    ORDER BY p.id
    LIMIT $product_per_page 
    OFFSET $offset")->getAll();
}

$pages = ceil($numberOfProducts['count'] / $product_per_page);

view('index.view.php', [
    'products' => $data,
    'numberOfProducts' => $numberOfProducts,
    'pages' => $pages,
    'page' => $page,
    'search' => $search
]);
