<?php
declare(strict_types=1);
include "../src/bootstrap.php";


$path = mb_strtolower($_SERVER["REQUEST_URI"]);
$method = $_SERVER["REQUEST_METHOD"];

$path = substr($path, strlen(DOC_ROOT));
$path = parse_url($path, PHP_URL_PATH);

$router = new \Core\Router($cms);

$router->add("GET", "/", "HomeController", "index");
$router->add("GET", "/users", "UserController", 'listUsers');
$router->add("GET", "/user/{id}", "UserController", 'getById');

$router->add("GET", "/login", "LoginController", "index");
$router->add("GET", '/register', "Auth\RegisterController", 'index');
$router->add("POST", "/register", "Auth\RegisterController", 'register');
$router->dispatch($method, $path);
