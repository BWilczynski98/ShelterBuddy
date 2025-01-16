<?php
declare(strict_types=1);
namespace Core;

class Router
{
    private array $routes = array();
    private array $middlewares = array();

    public function add(string $method, string $path, \Closure $handler, array $middleware = []): void
    {
        $this->routes[$method][$path] = [
            'handler'       =>  $handler,
            'middleware'    =>  $middleware
        ];
    }

    public function dispatch(string $method, string $path): void
    {
        $route_for_method = $this->routes[$method] ?? [];

        foreach ($route_for_method as $route => $key) {
            $pattern = preg_replace('#\{[a-zA-Z0-9_]+\}#', '([a-zA-Z0-9_-]+)', $route);
            $pattern = "#^" . $pattern . "$#";

            if (preg_match($pattern, $path, $matches)) {
                array_shift($matches);
                call_user_func_array($key['handler'], $matches);
                return;
            }
        }

        $this->abort();
    }

    protected function abort(int $response_code = 404, string $view = '404.html.twig', array $args = []): void
    {
        http_response_code($response_code);

        global $twig;
        echo $twig->render("{$response_code}.html.twig", $args);
    }

}