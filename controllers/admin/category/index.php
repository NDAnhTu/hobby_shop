<?php

use Core\Database;

$db = new Database();
$data = $db->query("SELECT * FROM categories")->getAll();

view('admin/category/index.view.php', [
    "categories" => $data
]);
