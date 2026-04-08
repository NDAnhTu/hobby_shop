<?php

use Core\Response;
use Core\Database;

function dd($value)
{
    echo "<pre>";
    var_dump($value);
    echo "</pre>";
    die();
}

function urlIs($value)
{
    return $_SERVER['REQUEST_URI'] === $value;
}

function authorize($condition, $statusCode = Response::HTTP_FORBIDDEN)
{
    if (!$condition) {
        abort($statusCode);
    }
}

function base_path($path = "")
{
    return BASE_PATH . $path;
}

function view($path, $attributes = [])
{
    extract($attributes);
    require base_path("views/" . $path);
}

function abort($code = 404)
{
    http_response_code($code);
    require base_path("views/{$code}.php");
    die();
}

function redirect($path)
{
    header("Location: {$path}");
    die();
}

function getOldValue($key)
{
    return $_SESSION['old'][$key] ?? "";
}

function setOldValue($key, $value)
{
    $oldValue = $_SESSION['old'] ?? [];
    $oldValue[$key] = $value;
    $_SESSION['old'] = $oldValue;
}

function getError($key)
{
    return $_SESSION['errors'][$key] ?? "";
}

function setError($key, $value)
{
    $oldValue = $_SESSION['errors'] ?? [];
    $oldValue[$key] = $value;
    $_SESSION['errors'] = $oldValue;
}

function hasError($key = "")
{
    if (empty($key)) {
        return !empty($_SESSION['errors']);
    }
    return isset($_SESSION['errors'][$key]);
}

function jsonResponse($data, $statusCode = 200)
{
    header('Content-Type: application/json');
    http_response_code($statusCode);
    echo json_encode($data);
    die();
}

function logout()
{
    $db = new Database();
    $db->query("DELETE FROM session_token WHERE user_id = :user_id", [
        "user_id" => $_SESSION['user']['id']
    ]);
    $_SESSION = [];
    redirect('/');
}

function isLoggedIn()
{
    return isset($_SESSION['user']);
}

function moneyFormat($data)
{
    return number_format($data, 0, ',', '.');
}

function cartCount()
{
    if (!isLoggedIn()) {
        return 0;
    }

    $db = new \Core\Database();
    $user = $_SESSION['user'];

    $result = $db->query("SELECT COUNT(*) as count FROM cart WHERE user_id = :user_id AND order_id = 0", [
        'user_id' => $user['id']
    ])->getOnce();

    return $result['count'] ?? 0;
}

function checkKeepLogin()
{
    $db = new Database();
    if (isset($_COOKIE['remember_token'])) {
        $token = $db->query("SELECT * FROM session_token WHERE token = :token ORDER BY id DESC LIMIT 1", [
            "token" => $_COOKIE['remember_token']
        ])->getOnce();
        if (!empty($token)) {
            $user = $db->query("SELECT * FROM users WHERE id = :id", [
                "id" => $token['id']
            ])->getOnce();
            $_SESSION['user'] = [
                "email" => $user['email'],
                "name" => $user['name'],
                "id" => $user['id']
            ];
        }
    }
}
