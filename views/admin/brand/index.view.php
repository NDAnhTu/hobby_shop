<?php require base_path("views/partials/head.php") ?>
<?php require base_path("views/partials/nav.php") ?>

<div class="main">
    <div class="panel">
        <p class="title">Danh sách</p>
        <div class="action-button">
            <a href="/admin/create-brand" class="add">Thêm hãng mới</a>
        </div>
        <table class="admin-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tên</th>
                    <th>Hành Động</th>
                </tr>
            </thead>
            <tbody id="admin-table-body">
                <?php foreach ($brands as $brand) : ?>
                    <tr>
                        <td><?= $brand['id'] ?></td>
                        <td><?= $brand['name'] ?></td>
                        <form action="/admin/delete-brand" method="POST">
                            <input type="hidden" name="id" value="<?= $brand['id'] ?>">
                            <td><button class="btn-delete" data-id="${p.id}"><i class="fa-solid fa-trash"></i></button></td>
                        </form>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <div style="display: flex; margin-top: 10px">
            <a href="/admin" class="button">Quay lại</a>
        </div>
    </div>
</div>
<script>
</script>
</body>

</html>