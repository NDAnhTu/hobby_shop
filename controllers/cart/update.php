<?php

use Core\Database;

$db = new Database();

if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST['id']) || !isset($_POST['action'])) {
    http_response_code(400);
    echo json_encode(['error' => 'Invalid request']);
    exit;
}

$id = $_POST['id'];
$action = $_POST['action'];
$user = $_SESSION['user'];

$item = $db->query("SELECT * FROM cart WHERE id = :id AND user_id = :user_id", [
    'id' => $id,
    'user_id' => $user['id']
])->getOnce();

if (!$item) {
    echo json_encode(['error' => 'Item not found']);
    exit;
}

$newQuantity = $item['quantity'];

if ($action === 'increase') {
    $newQuantity++;
} elseif ($action === 'decrease' && $newQuantity > 1) {
    $newQuantity--;
}

if ($newQuantity !== $item['quantity']) {
    $db->query("UPDATE cart SET quantity = :quantity WHERE id = :id", [
        'id' => $id,
        'quantity' => $newQuantity
    ]);
}

$product = $db->query("SELECT price FROM products WHERE id = :product_id", [
    'product_id' => $item['product_id']
])->getOnce();

$cartItems = $db->query("SELECT c.quantity, p.price FROM cart c JOIN products p ON c.product_id = p.id WHERE c.user_id = :user_id", [
    'user_id' => $user['id']
])->getAll();

$total = 0;
$totalCount = 0;
foreach ($cartItems as $ci) {
    $total += $ci['price'] * $ci['quantity'];
    $totalCount += 1;
}

header('Content-Type: application/json');
echo json_encode([
    'success' => true,
    'newQuantity' => $newQuantity,
    'itemPrice' => moneyFormat($product['price'] * $newQuantity) . 'đ',
    'total' => moneyFormat($total) . 'đ',
    'subtotal' => moneyFormat($total) . 'đ',
    'totalCartCount' => $totalCount
]);
exit;
