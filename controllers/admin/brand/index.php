<?php

use Core\Database;

$db = new Database();
$data = $db->query("SELECT * FROM brands")->getAll();

view('admin/brand/index.view.php', [
    "brands" => $data
]);
