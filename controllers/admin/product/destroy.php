<?php

use Core\Database;

$user = $_SESSION['user'];
$id = $_POST['id'];
$db = new Database();

$product = $db->query("SELECT * FROM products WHERE id = :id AND user_id = :user_id", [
    "id" => $id,
    "user_id" => $user['id']
])->getOnce();

if ($product) {
    if (! empty($product['image'])) {
        $oldFile = base_path('public/images/') . $product["image"];
        $deleteOldFile = unlink($oldFile);
    }
    $db->query("DELETE FROM products WHERE id = :id AND user_id = :user_id", [
        "id" => $id,
        "user_id" => $user['id']
    ]);
    redirect('/admin');
}
