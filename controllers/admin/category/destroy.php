<?php

use Core\Database;

$db = new Database();
$id = $_POST['id'];

$category = $db->query('SELECT * FROM categories WHERE id = :id', [
    'id' => $id
])->getOnce();

if (! empty($category)) {
    $db->query("UPDATE products SET category = 0 WHERE category = :id", [
        'id' => $id
    ]);
    $db->query('DELETE FROM categories WHERE id = :id', [
        'id' => $id
    ]);
    redirect('/admin/categories');
}
