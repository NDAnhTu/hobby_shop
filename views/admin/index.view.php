<?php require base_path("views/partials/head.php") ?>
<?php require base_path("views/partials/nav.php") ?>

<div class="main">
    <div class="panel">
        <p class="title">Danh sách sản phẩm</p>
        <div class="action-button">
            <a href="/admin/create-product" class="add">Thêm sản phẩm mới</a>
            <a href="/admin/categories" class="add-category">Quản lí danh mục</a>
            <a href="/admin/brands" class="add">Quản lí nhãn hàng</a>
        </div>
        <table class="admin-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Hình</th>
                    <th>Tên SP</th>
                    <th>Hãng</th>
                    <th>Danh Mục</th>
                    <th>Giá</th>
                    <th>Hành Động</th>
                </tr>
            </thead>
            <tbody id="admin-table-body">
                <?php foreach ($products as $product) : ?>
                    <tr>
                        <td><?= $product['id'] ?></td>
                        <td><img src="<?= "/images//" . $product['image'] ?>" style="width:100px; height:100px; object-fit:cover; border-radius:5px;"></td>
                        <td><strong><?= $product['name'] ?></strong></td>
                        <td><span style="background:#eee; padding:5px 10px; border-radius:15px; font-size:12px;"><?= $product['brand_name'] ?></span></td>
                        <td><span style="background:#eee; padding:5px 10px; border-radius:15px; font-size:12px;"><?= $product['category_name'] ?></span></td>
                        <td><?= $product['price'] ?></td>
                        <td>
                            <div class="action">
                                <form action="/admin/destroy-product" method="POST">
                                    <input type="hidden" name="id" value="<?= $product['id'] ?>">
                                    <button class="btn-delete" data-id="${p.id}"><i class="fa-solid fa-trash"></i></button>
                                </form>
                                <a href="admin/edit-product?id=<?= $product['id'] ?>">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                            </div>
                        </td>

                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<script>
</script>
</body>

</html>