<?php

use Core\Database;
use Core\Validator;

$db = new Database();
$id = $_POST['id'] ?? null;

if (!$id) {
    die("Thiếu ID sản phẩm.");
}

$name = $_POST['name'];
$category = $_POST['category'];
$price = $_POST['price'];
$short_description = $_POST['short-description'];
$description = $_POST['description'];
$brand = $_POST['brand'];
$image = $_FILES['image'] ?? null;
$maxLength = 100;

setOldValue('name', $name);
setOldValue('category', $category);
setOldValue('brand', $brand);
setOldValue('price', $price);
setOldValue('short-description', $short_description);
setOldValue('description', $description);

if (! Validator::string($name, 1, $maxLength)) setError('name', "Nhập tên sản phẩm.");
if (! Validator::string($brand, 1, $maxLength)) setError('brand', "Nhập hãng sản phẩm.");
if (! Validator::string($category, 1, $maxLength)) setError('category', "Nhập danh mục sản phẩm.");
if (! Validator::string($price, 1, $maxLength)) setError('price', "Nhập giá sản phẩm.");

if (hasError()) {
    redirect('/admin/edit-product');
}

$product = $db->query("SELECT * FROM products WHERE id = :id", ['id' => $id])->getOnce();

$imageName = $product['image'];

// Xử lý nếu có upload ảnh mới
if (isset($image) && $image['error'] === UPLOAD_ERR_OK) {
    $extension = pathinfo($image['name'], PATHINFO_EXTENSION);
    $imageName = uniqid() . '.' . $extension;
    $uploadPath = base_path('public/images/') . $imageName;

    if (move_uploaded_file($image['tmp_name'], $uploadPath)) {
        // Xóa ảnh cũ nếu tồn tại
        if (!empty($product['image'])) {
            $oldFilePath = base_path('public/images/') . $product["image"];
            if (file_exists($oldFilePath)) {
                unlink($oldFilePath);
            }
        }
    } else {
        setError('image', "Lỗi khi lưu hình ảnh.");
        redirect('/admin/create-product');
    }
}

$result = $db->query("UPDATE products SET 
    name = :name, 
    category = :category, 
    price = :price, 
    short_description = :short_description, 
    description = :description, 
    image = :image, 
    brand = :brand
    WHERE id = :id", [
    "name" => $name,
    "category" => $category,
    "price" => $price,
    "short_description" => $short_description,
    "description" => $description,
    "image" => $imageName,
    "brand" => $brand,
    "id" => $id
]);

if ($result) {
    redirect('/admin');
}
