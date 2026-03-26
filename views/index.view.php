<?php require base_path("views/partials/head.php") ?>
<?php require base_path("views/partials/nav.php") ?>

</body>
<div class="main">
    <div class="hero">
        <h1>Thế Giới Mô Hình Của Bạn</h1>
        <p>Khám phá bộ sưu tập Gundam, Figure, Lego mới nhất!</p>
    </div>
    <p class="main-title">SẢN PHẨM MỚI</p>
    <div class="items">
        <?php foreach ($products as $product) : ?>
            <div class="home-item">
                <div class="image-container">
                    <img src="<?= "/images//" . $product['image'] ?>" alt="">
                </div>
                <div class="item-info">
                    <p class="category"><?= $product['category_name'] ?></p>
                    <p class="product-name"><?= $product['name'] ?></p>
                    <p class="price"><?= $product['price'] ?></p>
                    <div class="cart-button">
                        <i class="fa-solid fa-cart-arrow-down"></i>
                        <p>Mua</p>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

</html>