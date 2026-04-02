<?php

use Core\Database;

$db = new Database();

$orders = $db->query("
SELECT o.*, u.name as customer_name, SUM(p.price * c.quantity) as total_amount, COUNT(c.product_id) as count
FROM orders as o 
JOIN cart as c 
ON o.id = c.order_id
JOIN products as p 
ON c.product_id = p.id
JOIN users as u 
ON o.user_id = u.id
GROUP BY o.id
ORDER BY o.order_date DESC
")->getAll();

view("admin/orders/index.view.php", [
    'orders' => $orders
]);
