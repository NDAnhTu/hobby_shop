<?php

use Core\Database;

$db = new Database();
$id = $_POST['id'] ?? null;

if (empty($id)) {
    $_SESSION['error'] = "Không tìm thấy mã đơn hàng.";
    redirect('/admin/orders');
}

$order = $db->query("SELECT * FROM orders WHERE id = :id", [
    'id' => $id
])->getOnce();

if (! $order) {
    $_SESSION['error'] = "Đơn hàng không tồn tại hoặc đã bị xóa.";
    redirect('/admin/orders');
}

$db->query("DELETE FROM cart WHERE order_id = :id", [
    'id' => $id
]);

$db->query("DELETE FROM orders WHERE id = :id", [
    'id' => $id
]);

$_SESSION['success'] = "Đã xóa đơn hàng #{$id}.";
redirect('/admin/orders');
