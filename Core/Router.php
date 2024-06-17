<?php

namespace Core;

use Core\Middleware\Middleware;
use JetBrains\PhpStorm\NoReturn;

class Router
{
    protected array $routes = [];

    public function add($uri, $controller, $method): Router
    {
        $this->routes[] = [
            'uri' => $uri,
            'controller' => $controller,
            'method' => $method,
            'middleware' => null
        ];

        return $this;
    }

    public function get($uri, $controller): Router
    {
        return $this->add($uri, $controller, 'GET');
    }

    public function post($uri, $controller): Router
    {
        return $this->add($uri, $controller, 'POST');
    }

    public function delete($uri, $controller): Router
    {
        return $this->add($uri, $controller, 'DELETE');
    }

    public function patch($uri, $controller): Router
    {
        return $this->add($uri, $controller, 'PATCH');
    }

    public function put($uri, $controller): Router
    {
        return $this->add($uri, $controller, 'PUT');
    }

    public function only($key): static
    {
        $this->routes[array_key_last($this->routes)]['middleware'] = $key;

        return $this;
    }

    public function route($uri, $method)
    {
        foreach ($this->routes as $route) {
            if ($route['uri'] === $uri && $route['method'] === strtoupper($method)) {

                Middleware::resolve($route['middleware']);

                return require basePath('Http/controllers/' . $route['controller']);

            }
        }
        $this->abort(404);
    }

    public function previousUrl()
    {
        return $_SERVER['HTTP_REFERER'];
    }

    #[NoReturn] protected function abort($code): void
    {
        http_response_code($code);
        require basePath("views/partials/$code.php");
        die();
    }
}
