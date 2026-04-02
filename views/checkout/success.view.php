<?php require base_path("views/partials/head.php") ?>
<?php require base_path("views/partials/nav.php") ?>

<div class="main">
    <div style="display: flex; flex-direction: column; align-items: center; justify-content: center; height: 60vh; text-align: center;">
        <i class="fa-solid fa-circle-check" style="font-size: 80px; color: #1abc9c; margin-bottom: 20px;"></i>
        <h1 style="font-size: 32px; color: #2d3436; margin-bottom: 10px;">Đặt hàng thành công!</h1>
        <p style="font-size: 18px; color: #636e72;">Cảm ơn bạn đã mua sắm tại HobbySpace.</p>
        <p style="margin-top: 20px; color: #b2bec3;">Bạn sẽ được chuyển hướng về trang chủ sau 3 giây...</p>
    </div>
</div>

<script>
    setTimeout(function() {
        window.location.href = "/";
    }, 3000);
</script>

</body>

</html>
