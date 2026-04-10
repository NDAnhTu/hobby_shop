<?php

use Core\Database;

$db = new Database();

$keyword = $_GET['key_word'];

$items = $db->query("SELECT p.id, p.name, p.price, p.short_description, p.description, p.image, c.name as category_name 
FROM products as p 
JOIN categories as c 
ON p.category = c.id 
WHERE p.name LIKE '%$keyword%'")->getAll();

if (!$items) {
    header('Content-Type: application/json', true, 404);
    echo json_encode(['error' => 'Item not found']);
    exit;
}

header('Content-Type: application/json');
echo json_encode([
    'success' => true,
    'items' => $items
]);
exit;
