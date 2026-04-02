<?php

use Core\Database;

$db = new Database();

$orders = $db->query("
    SELECT o.id, u.id as customer_id, u.name as customer_name, o.order_date, SUM(p.price * c.quantity) as total_amount, o.status, COUNT(c.id) as count
    FROM orders as o 
    JOIN cart as c ON o.id = c.order_id
    JOIN products as p ON c.product_id = p.id
    JOIN users as u ON o.user_id = u.id
    GROUP BY o.id
    ORDER BY o.order_date DESC
")->getAll();

$filename = "orders_" . date('Ymd_His') . ".csv";

header('Content-Type: text/csv; charset=UTF-8');
header('Content-Disposition: attachment; filename="' . $filename . '"');

echo "\xEF\xBB\xBF";

$output = fopen('php://output', 'w');

// head
fputcsv($output, ['ID', 'ID Khách hàng', 'Tên Khách hàng', 'Ngày đặt', 'Số lượng', 'Tổng tiền', 'Trạng thái']);

// record
foreach ($orders as $order) {
    fputcsv($output, [
        $order['id'],
        $order['customer_id'],
        $order['customer_name'],
        $order['order_date'],
        $order['count'],
        $order['total_amount'],
        $order['status']
    ]);
}

fclose($output);
exit;
