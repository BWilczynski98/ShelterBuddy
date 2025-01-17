<?php
declare(strict_types=1);

namespace Core;

class Router
{
    private array $routes = array();
    protected CMS $cms;

    public function __construct(CMS $cms)
    {
        $this->cms = $cms;
    }

    public function add(string $method, string $path, string $controller, string $action): void
    {
        $this->routes[$method][$path] = [
            'controller'    =>  $controller,
            'action'        =>  $action
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
                $this->callController($key['controller'], $key['action'], $matches);
                return;
            }
        }

        echo "Dispatch";
        $this->abort();
    }

    public function callController(string $controller, string $action, array $params): void
    {
        $contoller_class = "App\\Controllers\\{$controller}";

        if (class_exists($contoller_class) && method_exists($contoller_class, $action)) {
            $controller_instance = new $contoller_class($this->cms);
            call_user_func_array([$controller_instance, $action], $params);
        } else {
            $this->abort(404);
        }
    }

    protected function abort(int $response_code = 404, string $view = '404.html.twig', array $args = []): void
    {
        http_response_code($response_code);
        View::render('abort.twig');
    }

}