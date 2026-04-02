<?php

use Core\Database;

$db = new Database();
$user = $_SESSION['user'];

$data = $db->query('SELECT p.name,
CASE 
	WHEN (ca.id IS NULL) THEN "Chưa phân loại"
    ELSE ca.name
END as category_name, 
CASE 
	WHEN (b.id IS NULL) THEN "Chưa phân loại"
    ELSE b.name
END as brand_name,
c.quantity,
p.image,
p.price,
c.id
FROM cart as c 
JOIN products as p 
ON c.product_id = p.id
LEFT JOIN categories as ca 
ON p.category = ca.id
LEFT JOIN brands as b 
ON p.brand = b.id
WHERE c.user_id = :user_id AND order_id = 0', [
    "user_id" => $user['id'],
])->getAll();

view("cart/index.view.php", [
    'data' => $data
]);
