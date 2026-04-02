<?php require base_path("views/partials/head.php") ?>
<?php require base_path("views/partials/nav.php") ?>

<div class="main">
    <div class="checkout-container">
        <div class="checkout-left">
            <h2 class="checkout-section-title">Thông tin giao hàng</h2>
            <form id="checkout-form" action="/checkout-conplete" method="POST">
                <input type="hidden" name="shipping-info-id" value="<?= !empty($shipping_info) ? $shipping_info['id'] : "" ?>">
                <div class="checkout-form-group">
                    <div class="checkout-input-item">
                        <label for="fullname">Họ tên</label>
                        <input type="text" id="fullname" name="fullname" placeholder="Nhập họ tên của bạn" required value="<?= !empty($shipping_info) ? $shipping_info['name'] : $_SESSION['user']['name'] ?>">
                    </div>
                    <div class="checkout-input-item">
                        <label for="phone">Số điện thoại</label>
                        <input type="text" id="phone" name="phone" placeholder="Nhập số điện thoại" required value="<?= !empty($shipping_info) ? $shipping_info['phone_number'] : "" ?>">
                    </div>
                </div>
                <div class="checkout-form-group">
                    <div class="checkout-input-item">
                        <label for="address">Địa chỉ cụ thể</label>
                        <input type="text" id="address" name="address" placeholder="Số nhà, tên đường, phường/xã..." required value="<?= !empty($shipping_info) ? $shipping_info['address'] : "" ?>">
                    </div>
                </div>

                <!-- <h2 class="checkout-section-title" style="margin-top: 40px;">Phương thức thanh toán</h2>
                <div class="payment-methods">
                    <label class="payment-method-item">
                        <input type="radio" name="payment_method" value="cod" checked>
                        <span>Thanh toán khi nhận hàng (COD)</span>
                    </label>
                    <label class="payment-method-item">
                        <input type="radio" name="payment_method" value="bank">
                        <span>Chuyển khoản ngân hàng</span>
                    </label>
                </div> -->
            </form>
        </div>

        <div class="checkout-right">
            <div class="order-summary-box">
                <h2>Đơn hàng của bạn</h2>
                <div class="checkout-product-list">
                    <?php if (isset($data) && !empty($data)) : ?>
                        <?php
                        $total = 0;
                        foreach ($data as $item) :
                            $itemTotal = $item['price'] * $item['quantity'];
                            $total += $itemTotal;
                        ?>
                            <div class="checkout-product-item">
                                <div class="checkout-product-img">
                                    <img src="<?= "/images//" . $item['image'] ?>" alt="<?= $item['name'] ?>">
                                </div>
                                <div class="checkout-product-info">
                                    <div class="checkout-product-details">
                                        <span class="checkout-product-name"><?= $item['name'] ?></span>
                                        <span class="checkout-product-qty">Số lượng: <?= $item['quantity'] ?></span>
                                    </div>
                                    <span class="checkout-product-price"><?= moneyFormat($itemTotal) ?>đ</span>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif ?>
                </div>

                <div class="summary-details">
                    <div class="summary-line">
                        <span>Tạm tính</span>
                        <span><?= isset($total) ? moneyFormat($total) : '0' ?>đ</span>
                    </div>
                    <div class="summary-line">
                        <span>Phí ship</span>
                        <span>0đ</span>
                    </div>
                    <div class="summary-total-line">
                        <span>Tổng cộng</span>
                        <span><?= isset($total) ? moneyFormat($total) : '0' ?>đ</span>
                    </div>
                </div>
                <button type="submit" form="checkout-form" class="btn-order-now">ĐẶT HÀNG NGAY</button>
            </div>
        </div>
    </div>
</div>
</body>

</html>