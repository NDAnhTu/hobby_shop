<?php

use Core\Database;

$db = new Database();
$page = $_GET['page'] ?? 1;
$product_per_page = 6;
$offset = ($page - 1) * $product_per_page;
$numberOfProducts = $db->query("SELECT COUNT(id) as count FROM products")->getOnce();
$pages = ceil($numberOfProducts['count'] / $product_per_page);

$data = $db->query("SELECT p.id, p.name, p.price, p.short_description, p.description, p.image, c.name as category_name 
FROM products as p 
JOIN categories as c 
ON p.category = c.id 
ORDER BY p.id
LIMIT $product_per_page 
OFFSET $offset")->getAll();

view('index.view.php', [
    'products' => $data,
    'numberOfProducts' => $numberOfProducts,
    'pages' => $pages,
    'page' => $page
]);
