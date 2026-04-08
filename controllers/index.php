<?php

use Core\Database;

$db = new Database();

$data = $db->query('SELECT p.id, p.name, p.price, p.short_description, p.description, p.image, c.name as category_name FROM products as p JOIN categories as c ON p.category = c.id')->getAll();

if (isset($_COOKIE['remember_token'])) {
    $token = $db->query("SELECT * FROM session_token WHERE token = :token ORDER BY id DESC LIMIT 1", [
        "token" => $_COOKIE['remember_token']
    ])->getOnce();
    if (!empty($token)) {
        $user = $db->query("SELECT * FROM users WHERE id = :id", [
            "id" => $token['id']
        ])->getOnce();
        $_SESSION['user'] = [
            "email" => $user['email'],
            "name" => $user['name'],
            "id" => $user['id']
        ];
    }
}

view('index.view.php', [
    'products' => $data,
]);
