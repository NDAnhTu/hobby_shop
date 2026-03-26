<?php

use Core\Database;
use Core\Validator;

$db = new Database();
$email = $_POST['email'];
$password = $_POST['password'];

setOldValue('email', $email);
setOldValue('password', $password);


if (! Validator::email($email)) {
    setError('email', 'Nhập địa chỉ email khả dụng.');
}

if (! Validator::string($password, 7, 255)) {
    setError('password', "Mật khẩu phải có ít nhất 7 kí tự.");
}

if (hasError()) {
    redirect('/login');
}

$user = $db->query("SELECT * FROM users WHERE email = :email", ['email' => $email])->getOnce();

if (! $user) {
    setError('password', 'Sai email hoặc mật khẩu.');
    redirect('/login');
}

if (password_verify($password, $user['password'])) {
    $_SESSION['user'] = [
        "email" => $user['email'],
        "name" => $user['name'],
        "id" => $user['id']
    ];
    redirect('/');
} else {
    setError('password', 'Sai email hoặc mật khẩu.');
    redirect('/login');
}
