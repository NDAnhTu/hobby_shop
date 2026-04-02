<nav class="nav-bar">
    <a href="/" class="logo"><i class="fa-solid fa-robot"></i> Hobby<span>Space</span></a>
    <?php if (isLoggedIn()) : ?>
        <div class="user-action">
            <a href="/cart" class="nav-links cart-icon-container">
                <i class="fa-solid fa-cart-arrow-down"></i>
                <?php if (cartCount() > 0) : ?>
                    <span class="cart-badge" id="nav-cart-count"><?= cartCount() ?></span>
                <?php endif; ?>
            </a>
            <div class="dropdown">
                <a href="/" class="nav-links"><?= $_SESSION['user']['name'] ?></a>
                <div class="dropdown-content">
                    <div class="dropdown-action">
                        <form action="/logout" method="POST">
                            <button type="submit">Logout</button>
                        </form>
                    </div>
                    <div class="dropdown-action">
                        <a href="">Đơn hàng đã đặt</a>
                    </div>
                </div>
            </div>
        </div>
    <?php else : ?>
        <div class="nav-link-group">
            <a href="/login" class="nav-links">Đăng nhập</a>
            <a href="/register" class="nav-links">Đăng ký</a>
        </div>
    <?php endif; ?>
</nav>