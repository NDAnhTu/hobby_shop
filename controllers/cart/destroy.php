<?php

use Core\Database;

$db = new Database();
$user = $_SESSION['user'];
$id = $_POST['id'];

if (! isset($id)) {
    abort();
}

$check = $db->query("SELECT * FROM cart WHERE id = :id", [
    "id" => $id
])->getOnce();

if (! $check) {
    abort();
}

$db->query("DELETE FROM cart WHERE id = :id", [
    "id" => $id
]);

redirect('/cart');
