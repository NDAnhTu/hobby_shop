<?php

use Core\Database;

$db = new Database();
$newName = $_POST['fullname'] ?? '';
$address = $_POST['address'] ?? '';
$phoneNumber = $_POST['phone'] ?? '';
$shipping_id = $_POST['shipping-info-id'] ?? '';
$user = $_SESSION['user'];

$currentCart = $db->query("SELECT * FROM cart WHERE user_id = :user_id AND order_id = 0", [
    'user_id' => $user['id']
])->getAll();

if (empty($currentCart)) {
    redirect('/cart');
}

if (empty($shipping_id)) {
    $db->query("INSERT INTO user_shipping_info (user_id, name, address, phone_number) VALUES (:user_id, :name, :address, :phone_number)", [
        'user_id' => $user['id'],
        'name' => $newName,
        'address' => $address,
        'phone_number' => $phoneNumber
    ]);

    $shippingInfo = $db->query("SELECT * FROM user_shipping_info WHERE user_id = :user_id ORDER BY id DESC LIMIT 1", [
        'user_id' => $user['id']
    ])->getOnce();
} else {
    $shippingInfo = $db->query("SELECT * FROM user_shipping_info WHERE id = :id AND user_id = :user_id", [
        "id" => $shipping_id,
        "user_id" => $user['id']
    ])->getOnce();
}

if (! empty($shippingInfo)) {
    try {
        $db->beginTransaction();
        $db->query("INSERT INTO orders (user_id, status, order_date) VALUES (:user_id, :status, :order_date)", [
            'user_id' => $user['id'],
            'status' => 'pending',
            'order_date' => date("Y-m-d H:i:s"),
        ]);
        $latestOrder = $db->query("SELECT * FROM orders WHERE user_id = :user_id ORDER BY order_date DESC LIMIT 1", [
            'user_id' => $user['id']
        ])->getOnce();

        foreach ($currentCart as $cart) {
            $db->query("UPDATE cart SET order_id = :order_id WHERE id = :id", [
                'order_id' => $latestOrder['id'],
                'id' => $cart['id']
            ]);
        }
        $db->commit();
    } catch (\Throwable $e) {
        if ($db->inTransaction()) {
            $db->rollback();
        }
        setError('checkout_error', 'Has an error! ' . $e->getMessage());
        redirect('/checkout');
    }

    view('/checkout/success.view.php');
} else {
    abort(400);
}
