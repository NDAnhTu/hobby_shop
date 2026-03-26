<?php require base_path("views/partials/head.php") ?>
<?php require base_path("views/partials/nav.php") ?>

<div class="main">
    <div class="panel">
        <form action="/admin/update-product" method="POST" class="add-product-form" enctype="multipart/form-data">
            <p class="title">Thêm sản phẩm</p>
            <div class="add-product-section">
                <div class="add-product-input">
                    <p>Tên sản phẩm:</p>
                    <input type="text" name="name" placeholder="Nhập tên sản phẩm" value="<?= $product['name'] ?>">
                    <?php if (hasError('name')) : ?>
                        <p class="input-error"> <?= getError('name') ?></p>
                    <?php endif; ?>
                </div>
                <div class="add-product-input">
                    <p>Hãng:</p>
                    <select name="brand">
                        <?php foreach ($brands as $brand) : ?>
                            <option
                                value="<?= $brand['id'] ?>"
                                <?= ($product['brand'] === $brand['id']) ? "selected" : "" ?>>
                                <?= $brand['name'] ?></option>
                        <?php endforeach; ?>
                    </select>
                    <?php if (hasError('category')) : ?>
                        <p class="input-error"> <?= getError('category') ?></p>
                    <?php endif; ?>
                </div>
                <div class="add-product-input">
                    <p>Danh mục:</p>
                    <select name="category">
                        <?php foreach ($categories as $category) : ?>
                            <option value="<?= $category['id'] ?>" <?= ($product['category'] === $category['id']) ? "selected" : "" ?>><?= $category['name'] ?></option>
                        <?php endforeach; ?>
                    </select>
                    <?php if (hasError('category')) : ?>
                        <p class="input-error"> <?= getError('category') ?></p>
                    <?php endif; ?>
                </div>
                <div class="add-product-input">
                    <p>Giá tiền:</p>
                    <input type="text" name="price" placeholder="Nhập giá tiền" value="<?= $product['price'] ?>">
                    <?php if (hasError('price')) : ?>
                        <p class="input-error"> <?= getError('price') ?></p>
                    <?php endif; ?>
                </div>
                <div class="add-product-input">
                    <p>Mô tả ngắn:</p>
                    <input type="text" name="short-description" placeholder="Nhập mô tả sản phẩm" value="<?= $product['short_description'] ?>">
                </div>
                <div class="add-product-input full-width">
                    <p>Mô tả:</p>
                    <textarea name="description" id="description" rows="3" placeholder="Nhập mô tả sản phẩm"><?= $product['description'] ?></textarea>
                </div>
                <div class="add-product-input">
                    <p>Hình ảnh:</p>
                    <input type="file" class="image" name="image" accept="image/png, image/jpeg, image/jpg">
                    <?php if (hasError('image')) : ?>
                        <p class="input-error"> <?= getError('image') ?></p>
                    <?php endif; ?>
                </div>
                <img class="preview full-width" src="<?= "/images//" . $product['image'] ?>" style="display: block;">
                <input type="hidden" name="id" value="<?= $product['id'] ?>">
                <button type="submit">
                    Lưu sản phẩm
                </button>
                <a href="/admin" class="button full-width">Back</a>
            </div>
        </form>
    </div>
</div>
</body>

<script>
    $(function() {
        $(".image").on("change", function() {
            let file = this.files[0];
            if (file) {
                let reader = new FileReader();
                reader.onload = function(e) {
                    $(".preview").attr('src', e.target.result).show();
                }
                reader.readAsDataURL(file);
            }
        })
    })
</script>

</html>