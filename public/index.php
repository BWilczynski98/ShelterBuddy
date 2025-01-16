<?php
declare(strict_types=1);
include "../src/bootstrap.php";


$path = mb_strtolower($_SERVER["REQUEST_URI"]);
$method = $_SERVER["REQUEST_METHOD"];

$path = substr($path, strlen(DOC_ROOT));
$path = parse_url($path, PHP_URL_PATH);

$router = new \Core\Router;

$router->add("GET", "/", function() {
    global $twig;
    echo $twig->render("index.html.twig", []);
});

$router->add("GET", '/user/{id}', function ($id) {
    global $twig;
    echo $twig->render("user.html.twig", ['id' => $id]);
});

$router->add("GET", "/login", function () {
    global $twig;
    echo $twig->render('login.html.twig');
});

$router->add("GET", "/register", function () {
    global $twig;
    echo $twig->render('register.html.twig');
});

$router->add("POST", '/login', function () {
    echo "Login page";
});

$router->dispatch($method, $path);
