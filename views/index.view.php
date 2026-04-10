<?php require base_path("views/partials/head.php") ?>
<?php require base_path("views/partials/nav.php") ?>

<div class="main">
    <div class="hero">
        <h1>Thế Giới Mô Hình Của Bạn</h1>
        <p>Khám phá bộ sưu tập Gundam, Figure, Lego mới nhất!</p>
    </div>
    <p class="main-title">SẢN PHẨM MỚI</p>
    <div class="main-action">
        <div class="pages">
            <?php for ($i = 1; $i <= $pages; $i++) : ?>
                <a href="/?page=<?= $i ?>" class="<?= $i == $page ? 'page-active' : '' ?>">
                    <?= $i ?>
                </a>
            <?php endfor; ?>
        </div>
        <div class="search">
            <div class="add-product-input">
                <input type="text" name="name" placeholder="Tìm sản phẩm">
            </div>
            <i class="fa-solid fa-magnifying-glass toggle-icon"></i>
        </div>
    </div>

    <div class="items">
        <?php foreach ($products as $product) : ?>
            <a href="/detail?id=<?= $product['id'] ?>">
                <div class="home-item">
                    <div class="image-container">
                        <img src="<?= "/images//" . $product['image'] ?>" alt="">
                    </div>
                    <div class="item-info">
                        <p class="category"><?= $product['category_name'] ?></p>
                        <p class="product-name"><?= $product['name'] ?></p>
                        <p class="price"><?= moneyFormat($product['price']) ?></p>
                        <div class="cart-button">
                            <i class="fa-solid fa-cart-arrow-down"></i>
                            <p>Mua</p>
                        </div>
                    </div>
                </div>
            </a>
        <?php endforeach; ?>
    </div>
</div>

<script>
    $(document).ready(function() {
        const originalItemsHtml = $('.items').html();
        const originalPagesHtml = $('.pages').html();
        const searchInput = document.querySelector('.search input');
        $(searchInput).on('input', function() {
            let value = searchInput.value.trim();
            if (value.length > 0) {
                $('.pages').html('');
                $.ajax({
                    url: '/search',
                    method: 'GET',
                    data: {
                        key_word: value,
                    },
                    success: function(response) {
                        if (response.success) {
                            console.log(response);
                            let itemsHtml = '';
                            response.items.forEach(function(product) {
                                itemsHtml += `
                                <a href="/detail?id=${product.id}">
                                    <div class="home-item">
                                        <div class="image-container">
                                            <img src="/images//${product.image}" alt="">
                                        </div>
                                        <div class="item-info">
                                            <p class="category">${product.category_name}</p>
                                            <p class="product-name">${product.name}</p>
                                            <p class="price">${product.price}</p>
                                            <div class="cart-button">
                                                <i class="fa-solid fa-cart-arrow-down"></i>
                                                <p>Mua</p>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                                `;
                            });
                            $('.items').html(itemsHtml);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.log('Request failed:', error);
                    }
                });
            } else {
                $('.items').html(originalItemsHtml);
                $('.pages').html(originalPagesHtml);
            }
        });
    });
</script>

</body>

</html>