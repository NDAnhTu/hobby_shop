<?php

use Core\Database;

$db = new Database();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["csv_file"])) {
    $file = $_FILES["csv_file"]["tmp_name"];

    if (($handle = fopen($file, "r")) !== FALSE) {
        $bom = fread($handle, 3);
        if ($bom !== "\xEF\xBB\xBF") {
            rewind($handle);
        }

        fgetcsv($handle);

        $successCount = 0;

        while (($data = fgetcsv($handle)) !== FALSE) {
            // id, cus_id, cus_name, date, count, total, status
            $orderId = $data[0];
            $userId = $data[1];
            $orderDate = $data[3];
            $status = $data[6] ?? 'pending';

            $orderExists = $db->query("SELECT * FROM orders WHERE id = :id", ['id' => $orderId])->getOnce();

            if ($orderExists) {
                $db->query("UPDATE orders SET user_id = :user_id, status = :status, order_date = :order_date WHERE id = :id", [
                    'id' => $orderId,
                    'user_id' => $userId,
                    'order_date' => $orderDate,
                    'status' => $status
                ]);
                $successCount++;
            } else {
                $db->query("INSERT INTO orders (id, user_id, status, order_date) VALUES (:id, :user_id, :status, :order_date)", [
                    "id" => $orderId,
                    "user_id" => $userId,
                    "status" => $status,
                    "order_date" => $orderDate
                ]);
                $successCount++;
            }
        }
        fclose($handle);

        $_SESSION['success'] = "Đã cập nhật $successCount đơn hàng thành công!";
        redirect('/admin/orders');
    }
}

$_SESSION['error'] = "Vui lòng chọn file CSV.";
redirect('/admin/orders');
