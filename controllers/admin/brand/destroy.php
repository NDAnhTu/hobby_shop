<?php

use Core\Database;

$db = new Database();
$id = $_POST['id'];

$category = $db->query('SELECT * FROM brands WHERE id = :id', [
    'id' => $id
])->getOnce();

if (! empty($category)) {
    $db->query("UPDATE products SET brand = 0 WHERE brand = :id", [
        'id' => $id
    ]);
    $db->query('DELETE FROM brands WHERE id = :id', [
        'id' => $id
    ]);
    redirect('/admin/brands');
}
