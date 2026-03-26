<?php require base_path("views/partials/head.php") ?>
<?php require base_path("views/partials/nav.php") ?>

<div class="main">
    <div class="panel">
        <form action="/admin/store-category" method="POST" enctype="multipart/form-data">
            <p class="title">Thêm danh mục</p>
            <div class="add-product-section">
                <div class="add-product-input">
                    <p>Tên danh mục:</p>
                    <input type="text" name="name" placeholder="Nhập tên sản phẩm">
                    <?php if (hasError('name')) : ?>
                        <p class="input-error"> <?= getError('name') ?></p>
                    <?php endif; ?>
                </div>
                <button type="submit">
                    Lưu
                </button>
                <a href="/admin/categories" class="button full-width">Quay lại</a>
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