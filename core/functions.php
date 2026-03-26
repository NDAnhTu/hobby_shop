<?php

use Core\Response;

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
    $_SESSION = [];
    redirect('/');
}

function isLoggedIn()
{
    return isset($_SESSION['user']);
}
