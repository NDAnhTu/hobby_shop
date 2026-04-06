<?php

use Core\Database;

$db = new Database();

// Fetch all products from the database
// Join with categories and brands tables to fetch names
$sql = "
    SELECT 
        p.id, p.name, p.description, p.price, 
        c.name as category_name, 
        b.name as brand_name 
    FROM products p
    JOIN categories c ON p.category = c.id
    LEFT JOIN brands b ON p.brand = b.id
    ORDER BY p.id ASC";

$products = $db->query($sql)->getAll();

if (empty($products)) {
    die("Không tìm thấy sản phẩm nào để xuất.");
}

$filename = "products_" . date('Ymd_His') . ".csv";

// Set CSV headers
header('Content-Type: text/csv; charset=UTF-8');
header('Content-Disposition: attachment; filename="' . $filename . '"');

// Open output stream
$output = fopen('php://output', 'w');

// Write CSV header row (Adjust these column names based on actual database schema)
fputcsv($output, ['ID Sản Phẩm', 'Tên Sản Phẩm', 'Mô tả', 'Giá', 'Danh Mục', 'Hãng']);

// Record data
foreach ($products as $product) {
    fputcsv($output, [
        $product['id'],
        $product['name'],
        $product['description'] ?? '',
        moneyFormat($product['price']),
        $product['category_name'] ?? 'N/A',
        $product['brand_name'] ?? 'N/A'
    ]);
}

fclose($output);
exit;
