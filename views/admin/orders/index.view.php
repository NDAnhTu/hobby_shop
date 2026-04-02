<?php require base_path("views/partials/head.php") ?>
<?php require base_path("views/partials/nav.php") ?>

<div class="main">
    <div class="panel">
        <p class="title">Quản lý đơn hàng</p>

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
                        <td colspan="6" style="text-align: center; padding: 40px; color: #999;">Chưa có đơn hàng nào.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

</body>

</html>