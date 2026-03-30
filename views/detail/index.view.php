<?php require base_path("views/partials/head.php") ?>
<?php require base_path("views/partials/nav.php") ?>

<div class="main">
    <div class="detail-section">
        <div class="panel">
            <div class="detail-main">
                <div class="detail-img">
                    <img src="<?= "/images//" . $product['image'] ?>" alt="">
                </div>
                <div class="detail-info">
                    <p>Trang chủ / <?= $product['name'] ?></p>
                    <h1><?= $product['name'] ?></h1>
                    <div class="detail-price">
                        <?= number_format($product['price']) ?>đ
                    </div>
                    <div class="detail-description">
                        <p>
                            <?= $product['description'] ?>
                        </p>
                    </div>
                    <form action="/cart" method="POST">
                        <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
                        <button class="submit-button">Thêm vào giỏ hàng</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>

</html>