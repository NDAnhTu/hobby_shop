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
            <p class="title">Chi tiết đơn hàng #<?= $order['id'] ?></p>
            <a href="/admin/orders" class="btn-view">Quay lại danh sách</a>
        </div>

        <div class="order-detail-grid">
            <div class="order-summary-card">
                <h3>Thông tin đơn hàng</h3>
                <div class="order-summary-row">
                    <span>Mã đơn</span>
                    <strong>#<?= $order['id'] ?></strong>
                </div>
                <div class="order-summary-row">
                    <span>Khách hàng</span>
                    <strong><?= $order['customer_name'] ?> (ID <?= $order['user_id'] ?>)</strong>
                </div>
                <div class="order-summary-row">
                    <span>Email</span>
                    <strong><?= $order['customer_email'] ?></strong>
                </div>
                <div class="order-summary-row">
                    <span>Ngày đặt</span>
                    <strong><?= date("d/m/Y H:i", strtotime($order['order_date'])) ?></strong>
                </div>
                <div class="order-summary-row">
                    <span>Số lượng</span>
                    <strong><?= $totalQuantity ?> sản phẩm</strong>
                </div>
                <div class="order-summary-row">
                    <span>Tổng tiền</span>
                    <strong><?= moneyFormat($totalAmount) ?>đ</strong>
                </div>
                <div class="order-summary-row order-status-row">
                    <span>Trạng thái</span>
                    <?php if ($order['status'] === 'pending') : ?>
                        <span class="status-badge status-pending">Chờ xử lý</span>
                    <?php elseif ($order['status'] === 'delivered') : ?>
                        <span class="status-badge status-delivered">Đã giao</span>
                    <?php else : ?>
                        <span class="status-badge" style="background: #eee; color: #333;"><?= ucfirst($order['status']) ?></span>
                    <?php endif; ?>
                </div>
            </div>

            <div class="order-products-card">
                <h3>Sản phẩm đã đặt (<?= count($items) ?>)</h3>

                <?php if (!empty($items)) : ?>
                    <div class="checkout-product-list">
                        <?php foreach ($items as $item) : ?>
                            <?php $itemTotal = $item['price'] * $item['quantity']; ?>
                            <div class="checkout-product-item">
                                <div class="checkout-product-img">
                                    <img src="<?= "/images/" . $item['image'] ?>" alt="<?= $item['product_name'] ?>">
                                </div>
                                <div class="checkout-product-info">
                                    <div class="checkout-product-details">
                                        <span class="checkout-product-name"><?= $item['product_name'] ?></span>
                                        <span class="checkout-product-qty">Số lượng: <?= $item['quantity'] ?></span>
                                    </div>
                                    <div class="checkout-product-price-group">
                                        <span class="checkout-product-price"><?= moneyFormat($itemTotal) ?>đ</span>
                                        <span class="checkout-product-unit-price"><?= moneyFormat($item['price']) ?>đ / cái</span>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <div class="summary-details">
                        <div class="summary-line">
                            <span>Tạm tính</span>
                            <span><?= moneyFormat($totalAmount) ?>đ</span>
                        </div>
                        <div class="summary-line">
                            <span>Phí ship</span>
                            <span>0đ</span>
                        </div>
                        <div class="summary-total-line">
                            <span>Tổng đơn</span>
                            <span><?= moneyFormat($totalAmount) ?>đ</span>
                        </div>
                    </div>
                <?php else : ?>
                    <p class="no-products">Đơn hàng chưa có sản phẩm nào.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
</body>

</html>
