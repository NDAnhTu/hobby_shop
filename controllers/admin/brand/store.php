<?php

use Core\Database;
use Core\Validator;

$db = new Database();
$user = $_SESSION['user'];
$name = $_POST['name'];
$maxLength = 100;

setOldValue('name', $name);

if (! Validator::string($name, 1, $maxLength)) {
    setError('name', "Nhập tên nhãn hàng.");
}

if (hasError()) {
    redirect('/admin/create-brand');
}

$result = $db->query("INSERT INTO brands (name) VALUES (:name)", [
    "name" => $name,
]);
if ($result) {
    redirect('/admin/brands');
}
