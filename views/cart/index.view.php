<?php require base_path("views/partials/head.php") ?>
<?php require base_path("views/partials/nav.php") ?>

<div class="main">
    <div class="cart-header">
        <h1>Giỏ hàng của bạn</h1>
    </div>
    <div class="cart-container">
        <div class="cart-items">
            <?php
            $subtotal = 0;
            foreach ($data as $cart) :
                $itemTotal = $cart['price'] * $cart['quantity'];
                $subtotal += $itemTotal;
            ?>
                <div class="cart-item" data-id="<?= $cart['id'] ?>">
                    <div class="cart-item-img">
                        <img src="<?= "/images//" . $cart['image'] ?>" alt="">
                    </div>
                    <div class="cart-item-info">
                        <div class="cart-item-top">
                            <div>
                                <div class="cart-item-title"><?= $cart['name'] ?></div>
                                <div class="cart-item-type">Hãng: <?= $cart['brand_name'] ?></div>
                                <div class="cart-item-type">Loại: <?= $cart['category_name'] ?></div>
                                <div class="cart-item-type">Giá: <?= moneyFormat($cart['price']) ?>đ</div>
                            </div>
                            <div class="cart-item-price" id="item-price-<?= $cart['id'] ?>">
                                <?= moneyFormat($itemTotal) ?>đ
                            </div>
                        </div>
                        <div class="cart-item-bottom">
                            <div class="quantity-control">
                                <button class="quantity-btn decrease" data-id="<?= $cart['id'] ?>">-</button>
                                <div class="quantity-val" id="qty-<?= $cart['id'] ?>"><?= $cart['quantity'] ?></div>
                                <button class="quantity-btn increase" data-id="<?= $cart['id'] ?>">+</button>
                            </div>
                            <form action="/cart-delete" method="POST">
                                <input type="hidden" name="id" value="<?= $cart['id'] ?>">
                                <button class="delete-item">Xóa</button>
                            </form>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="order-summary">
            <div class="summary-title">Tóm tắt đơn hàng</div>

            <div class="summary-row">
                <span>Tạm tính:</span>
                <span id="subtotal"><?= moneyFormat($subtotal) ?>đ</span>
            </div>

            <div class="summary-row">
                <span>Phí vận chuyển:</span>
                <span class="text-free">Miễn phí</span>
            </div>

            <div class="summary-total">
                <span>Tổng cộng:</span>
                <span id="total"><?= moneyFormat($subtotal) ?>đ</span>
            </div>

            <a href="/checkout" class="btn-checkout">Thanh toán ngay</a>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('.quantity-btn').on('click', function() {
            const btn = $(this);
            const id = btn.data('id');
            const action = btn.hasClass('increase') ? 'increase' : 'decrease';
            const itemQuantity = $('#qty-' + id);

            if (action === 'decrease' && parseInt(itemQuantity.text()) <= 1) {
                return;
            }

            btn.prop('disabled', true);

            $.ajax({
                url: '/cart-update',
                method: 'POST',
                data: {
                    id: id,
                    action: action
                },
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        console.log(response);
                        itemQuantity.text(response.newQuantity);
                        $('#item-price-' + id).text(response.itemPrice);
                        $('#subtotal').text(response.subtotal);
                        $('#total').text(response.total);

                        const badge = $('#nav-cart-count');
                        if (response.totalCartCount > 0) {
                            badge.show();
                            badge.text(response.totalCartCount);
                        } else {
                            badge.remove();
                        }
                    } else {
                        alert(response.error || 'Có lỗi xảy ra');
                    }
                },
                error: function() {
                    alert('Không thể kết nối đến máy chủ');
                },
                complete: function() {
                    btn.prop('disabled', false);
                }
            });
        });
    });
</script>
</body>

</html>