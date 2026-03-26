<?php

use Core\Database;

$db = new Database();

$data = $db->query('SELECT p.id, p.name, p.price, p.short_description, p.description, p.image,
CASE 
	WHEN (c.id IS NULL) THEN "Chưa phân loại"
    ELSE c.name
END as category_name, 
CASE 
	WHEN (b.id IS NULL) THEN "Chưa phân loại"
    ELSE b.name
END as brand_name
FROM products as p 
LEFT JOIN categories as c
ON p.category = c.id
LEFT JOIN brands as b
ON p.brand = b.id')->getAll();;

view('admin/index.view.php', [
    "products" => $data
]);
