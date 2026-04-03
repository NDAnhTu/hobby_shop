<?php

use Core\Database;

$db = new Database();
$orderId = $_GET['id'] ?? null;

if (empty($orderId)) {
    $_SESSION['error'] = "Không tìm thấy mã đơn hàng.";
    redirect('/admin/orders');
}

$order = $db->query(
    "SELECT o.*, u.name as customer_name, u.email as customer_email FROM orders as o JOIN users as u ON o.user_id = u.id WHERE o.id = :id",
    ['id' => $orderId]
)->getOnce();

if (! $order) {
    $_SESSION['error'] = "Đơn hàng không tồn tại.";
    redirect('/admin/orders');
}

$items = $db->query(
    "SELECT c.id as cart_id, c.quantity, p.id as product_id, p.name as product_name, p.price, p.image
    FROM cart as c
    JOIN products as p ON c.product_id = p.id
    WHERE c.order_id = :order_id",
    ['order_id' => $orderId]
)->getAll();

$totalQuantity = 0;
$totalAmount = 0;

foreach ($items as $item) {
    $totalQuantity += $item['quantity'];
    $totalAmount += $item['price'] * $item['quantity'];
}

view("admin/orders/detail.view.php", [
    'order' => $order,
    'items' => $items,
    'totalAmount' => $totalAmount,
    'totalQuantity' => $totalQuantity
]);
