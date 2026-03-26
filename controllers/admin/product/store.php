<?php

use Core\Database;
use Core\Validator;

$db = new Database();
$user = $_SESSION['user'];
$name = $_POST['name'];
$category = $_POST['category'];
$price = $_POST['price'];
$short_description = $_POST['short-description'];
$description = $_POST['description'];
$brand = $_POST['brand'];
$image = $_FILES['image'];
$maxLength = 100;

setOldValue('name', $name);
setOldValue('category', $category);
setOldValue('brand', $brand);
setOldValue('price', $price);
setOldValue('short-description', $short_description);
setOldValue('description', $description);
setOldValue('image', $_FILES);

if (! Validator::string($name, 1, $maxLength)) {
    setError('name', "Nhập tên sản phẩm.");
}

if (! Validator::string($brand, 1, $maxLength)) {
    setError('category', "Nhập danh hãng sản phẩm.");
}

if (! Validator::string($category, 1, $maxLength)) {
    setError('category', "Nhập danh mục sản phẩm.");
}

if (! Validator::string($price, 1, $maxLength)) {
    setError('price', "Nhập giá sản phẩm.");
}

if (empty($image['full_path'])) {
    setError('image', "Hãy thêm hình ảnh.");
}

if (hasError()) {
    redirect('/admin/create-product');
}

if (isset($image) && $image['error'] === UPLOAD_ERR_OK) {
    $originalName = $image['name'];
    // Sử dụng pathinfo để lấy phần mở rộng (ví dụ: "png")
    $extension = pathinfo($originalName, PATHINFO_EXTENSION);
    // Kết hợp với uniqid để tạo tên file mới
    $imageName = uniqid() . '.' . $extension;
    $moveFile = move_uploaded_file($image['tmp_name'], base_path('public/images/') . $imageName);
    if (!$moveFile) {
        setError('image', "Xảy ra lỗi khi tải hình ảnh, vui lòng tải lại.");
        redirect('/admin/create-product');
    }
    $result = $db->query("INSERT INTO products (name, category, price, short_description, description, image, user_id, brand) VALUES (:name, :category, :price, :short_description, :description, :image, :user_id, :brand)", [
        "name" => $name,
        "category" => $category,
        "price" => $price,
        "short_description" => $short_description,
        "description" => $description,
        "image" => $imageName,
        "user_id" => $user['id'],
        "brand" => $brand
    ]);
    if ($result) {
        redirect('/admin');
    }
}
