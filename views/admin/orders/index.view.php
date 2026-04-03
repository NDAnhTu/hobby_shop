<?php require base_path("views/partials/head.php") ?>
<?php require base_path("views/partials/nav.php") ?>

<div class="main">
    <div class="panel">
        <?php if (isset($_SESSION['success'])) : ?>
            <p style="background: #e8f5e9; color: #2e7d32; padding: 10px; border-radius: 5px; margin-bottom: 20px;"><?= $_SESSION['success'] ?></p>
            <?php unset($_SESSION['success']) ?>
        <?php endif; ?>
        <?php if (isset($_SESSION['error'])) : ?>
            <p style="background: #ffebee; color: #c62828; padding: 10px; border-radius: 5px; margin-bottom: 20px;"><?= $_SESSION['error'] ?></p>
            <?php unset($_SESSION['error']) ?>
        <?php endif; ?>

        <div class="admin-title">
            <p class="title">Quản lý đơn hàng</p>
            <div style="display: flex; gap: 20px; align-items: center;">
                <form action="/admin/orders/import" method="POST" enctype="multipart/form-data" style="display: flex; align-items: center; gap: 10px;">
                    <input type="file" name="csv_file" required style="font-size: 14px;">
                    <button type="submit" style="background: #34495e; color: white; padding: 5px 15px; border: none; border-radius: 5px; cursor: pointer;">Import</button>
                </form>
                <a href="/admin/orders/export" style="background: #27ae60; color: white; padding: 8px 20px; border-radius: 5px; font-weight: bold; font-size: 14px; text-decoration: none;">Export</a>
            </div>
        </div>

        <table class="admin-table">
            <thead>
                <tr>
                    <th>Mã đơn</th>
                    <th>Khách hàng</th>
                    <th>Ngày đặt</th>
                    <th>Số lượng</th>
                    <th>Tổng tiền</th>
                    <th>Trạng thái</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($orders as $order) : ?>
                    <tr>
                        <td style="color: #6c5ce7; font-weight: bold;"><?= $order['id'] ?></td>
                        <td><?= $order['customer_name'] ?></td>
                        <td><?= date("d/m/Y", strtotime($order['order_date'])) ?></td>
                        <td><?= $order['count'] ?></td>
                        <td style="font-weight: 600;"><?= moneyFormat($order['total_amount']) ?>đ</td>
                        <td>
                            <?php if ($order['status'] === 'pending') : ?>
                                <span class="status-badge status-pending">Chờ xử lý</span>
                            <?php elseif ($order['status'] === 'delivered') : ?>
                                <span class="status-badge status-delivered">Đã giao</span>
                            <?php else : ?>
                                <span class="status-badge" style="background: #eee;"><?= $order['status'] ?></span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <a href="/admin/orders/detail?id=<?= $order['id'] ?>" class="btn-view">Xem</a>
                        </td>
                    </tr>
                <?php endforeach; ?>

                <?php if (empty($orders)) : ?>
                    <tr>
                        <td colspan="7" style="text-align: center; padding: 40px; color: #999;">Chưa có đơn hàng nào.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

</body>

</html>