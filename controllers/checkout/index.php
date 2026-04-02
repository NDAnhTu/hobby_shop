<?php

use Core\Database;

$db = new Database();
$user = $_SESSION['user'];

$data = $db->query("SELECT * FROM cart as c JOIN products as p ON c.product_id = p.id WHERE c.user_id = :user_id AND order_id = 0", [
    "user_id" => $user['id']
])->getAll();

$shipping_info = $db->query("SELECT * FROM user_shipping_info WHERE user_id = :user_id", [
    "user_id" => $user['id']
])->getOnce();

view('checkout/index.view.php', [
    "data" => $data,
    "user" => $user,
    "shipping_info" => $shipping_info
]);
