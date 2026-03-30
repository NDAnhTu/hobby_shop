<?php

use Core\Database;

$db = new Database();
$product_id = $_POST['product_id'];
$user = $_SESSION['user'];

$check = $db->query("SELECT * FROM cart WHERE user_id = :user_id AND product_id = :product_id", [
    'product_id' => $product_id,
    'user_id' => $user['id'],
])->getOnce();

if (! $check) {
    $db->query("INSERT INTO cart (product_id, user_id, quantity) VALUES (:product_id, :user_id, :quantity)", [
        'product_id' => $product_id,
        'user_id' => $user['id'],
        'quantity' => 1
    ]);
    redirect('/');
}

$quantity = $check['quantity'] += 1;

$db->query("UPDATE cart SET quantity = :quantity WHERE product_id = :product_id AND user_id = :user_id", [
    'product_id' => $product_id,
    'user_id' => $user['id'],
    'quantity' => $quantity
]);

redirect('/');
