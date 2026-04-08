<?php

use Core\Database;

$db = new Database();

$data = $db->query('SELECT p.id, p.name, p.price, p.short_description, p.description, p.image, c.name as category_name FROM products as p JOIN categories as c ON p.category = c.id')->getAll();

view('index.view.php', [
    'products' => $data,
]);
