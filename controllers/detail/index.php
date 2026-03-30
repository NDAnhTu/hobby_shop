<?php

use Core\Database;

$db = new Database();
$id = $_GET['id'];

if (empty($id)) {
    abort();
}

$data = $db->query("SELECT * FROM products WHERE id = :id", [
    'id' => $id
])->getOnce();

if (empty($data)) {
    abort();
}

view('detail/index.view.php', [
    "product" => $data
]);
