<?php require base_path("views/partials/head.php") ?>
<?php require base_path("views/partials/nav.php") ?>

<div class="login-container">
    <form class="login-form" method="POST" action="/login">
        <p class="title">Đăng Nhập</p>
        <p class="subtitle">Mừng bạn trở lại HobbySpace!</p>
        <div class="input-container">
            <p class="input-name">Email</p>
            <input type="text" name="email" placeholder="Nhập email của bạn" value="<?= getOldValue('email') ?>">
            <?php if (hasError('email')) : ?>
                <p class="input-error"> <?= getError('email') ?></p>
            <?php endif; ?>
        </div>
        <div class="input-container">
            <p class="input-name">Password</p>
            <div class="password-input-form">
                <input type="password" name="password" class="password-input" placeholder="Nhập mật khẩu của bạn" value="<?= getOldValue('password') ?>">
                <i class="fa-solid fa-eye toggle-icon"></i>
            </div>
            <?php if (hasError('password')) : ?>
                <p class="input-error"> <?= getError('password') ?></p>
            <?php endif; ?>
        </div>
        <button type="submit">
            Đăng nhập
        </button>
        <div class="register-link">
            <p>Chưa có tài khoản?</p>
            <a href="/register">Đăng ký ngay</a>
        </div>
    </form>
</div>
</body>

<script>
    $('input').on('input', function() {
        let inputError = $(this).closest('.input-container').find('.input-error');
        inputError.hide();
    });

    $('.toggle-icon').click(function() {
        let passwordInputForm = $('.password-input');
        let type = passwordInputForm.attr('type');
        if (type === 'password') {
            passwordInputForm.attr('type', 'text');
            $('.toggle-icon').removeClass('fa-eye').addClass('fa-lock');
        } else {
            passwordInputForm.attr('type', 'password');
            $('.toggle-icon').removeClass('fa-lock').addClass('fa-eye');
        }
    })
</script>

</html>