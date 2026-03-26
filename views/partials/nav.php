<nav class="nav-bar">
    <a href="/" class="logo"><i class="fa-solid fa-robot"></i> Hobby<span>Space</span></a>
    <?php if (isLoggedIn()) : ?>
        <a href="/" class="nav-links">Quay lại trang chủ</a>
    <?php else : ?>
        <div class="nav-link-group">
            <a href="/login" class="nav-links">Đăng nhập</a>
            <a href="/register" class="nav-links">Đăng ký</a>
        </div>
    <?php endif; ?>
</nav>