<?php
$router->get("/", "index.php");
$router->get("/login", "login/index.php")->only('guest');
$router->post("/login", "login/store.php")->only('guest');

$router->get("/register", "register/index.php")->only('guest');
$router->post("/register", "register/store.php")->only('guest');

$router->get("/detail", "detail/index.php");

/// admin
$router->get("/admin", "admin/index.php")->only('auth');

// product
$router->get("/admin/create-product", "admin/product/create.php")->only('auth');
$router->post("/admin/destroy-product", "admin/product/destroy.php")->only('auth');
$router->post("/admin/store-product", "admin/product/store.php")->only('auth');
$router->get("/admin/edit-product", "admin/product/edit.php")->only('auth');
$router->post("/admin/update-product", "admin/product/update.php")->only('auth');

// category
$router->get("/admin/categories", "admin/category/index.php")->only('auth');
$router->get("/admin/create-category", "admin/category/create.php")->only('auth');
$router->post("/admin/store-category", "admin/category/store.php")->only('auth');
$router->post("/admin/delete-category", "admin/category/destroy.php")->only('auth');

// brand
$router->get("/admin/brands", "admin/brand/index.php")->only('auth');
$router->get("/admin/create-brand", "admin/brand/create.php")->only('auth');
$router->post("/admin/store-brand", "admin/brand/store.php")->only('auth');
$router->post("/admin/delete-brand", "admin/brand/destroy.php")->only('auth');
