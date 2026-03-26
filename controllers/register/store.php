<?php

use Core\Database;
use Core\Validator;

$db = new Database();
$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];
$password_confirmation = $_POST['password-confirmation'];

setOldValue('name', $name);
setOldValue('email', $email);
setOldValue('password', $password);
setOldValue('password-confirmation', $password_confirmation);

if (! Validator::string($name, 2, 255)) {
    setError('name', 'Tên người dùng phải có ít nhất 2 kí tự.');
}

if (! Validator::email($email)) {
    setError('email', 'Nhập địa chỉ email khả dụng.');
}

if (! Validator::string($password, 7, 255)) {
    setError('password', "Mật khẩu phải có ít nhất 7 kí tự.");
}

if ($password !== $password_confirmation) {
    setError('password-confirmation', "Mật khẩu không giống nhau.");
}

if (hasError()) {
    redirect('/register');
}

$user = $db->query("SELECT * FROM users WHERE email = :email", ['email' => $email])->getOnce();

if ($user) {
    setError('email', 'Email đã tồn tại.');
    redirect('/register');
}

$result = $db->query('INSERT INTO users(name, admin, email, password) values(:name, :admin, :email, :password)', [
    'name' => $name,
    'admin' => 0,
    'email' => $email,
    'password' => password_hash($password, PASSWORD_BCRYPT),
]);

if ($result) {
    header('location: /login');
    exit();
} else {
    setError('password-confirmation', 'Xảy ra lỗi trong quá trình đăng ký.');
    redirect('/register');
}
