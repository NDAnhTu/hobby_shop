<?php require base_path("views/partials/head.php") ?>
<?php require base_path("views/partials/nav.php") ?>

<div class="login-container">
    <form class="login-form" method="POST" action="/register">
        <p class="title">Tạo tài khoản</p>
        <p class="subtitle">Gia nhập cộng đồng sưu tầm mô hình!</p>
        <div class="input-container">
            <p class="input-name">Tên</p>
            <input type="text" name="name" placeholder="Nhập tên của bạn" value="<?= getOldValue('name') ?>">
            <?php if (hasError('name')) : ?>
                <p class="input-error"> <?= getError('name') ?></p>
            <?php endif; ?>
        </div>
        <div class="input-container">
            <p class="input-name">Email</p>
            <input type="email" name="email" placeholder="Nhập email của bạn" value="<?= getOldValue('email') ?>">
            <?php if (hasError('email')) : ?>
                <p class=" input-error"> <?= getError('email') ?></p>
            <?php endif; ?>
        </div>
        <div class="input-container">
            <p class="input-name">Password</p>
            <div class="password-input-form">
                <input type="password" class="password-input" name="password" placeholder="Nhập mật khẩu của bạn" value="<?= getOldValue('password') ?>">
                <i class="fa-solid fa-eye toggle-icon"></i>
            </div>
            <?php if (hasError('password')) : ?>
                <p class=" input-error"> <?= getError('password') ?></p>
            <?php endif; ?>
        </div>
        <div class="input-container">
            <p class="input-name">Password</p>
            <div class="password-input-form">
                <input type="password" class="password-input" name="password-confirmation" placeholder="Nhập lại mật khẩu của bạn" value="<?= getOldValue('password-confirmation') ?>">
                <i class="fa-solid fa-eye toggle-icon"></i>
            </div>
            <?php if (hasError('password-confirmation')) : ?>
                <p class=" input-error"> <?= getError('password-confirmation') ?></p>
            <?php endif; ?>
        </div>
        <button type="submit">
            Đăng ký
        </button>
        <div class="register-link">
            <p>Đã có tài khoản?</p>
            <a href="/login">Đăng nhập ngay</a>
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