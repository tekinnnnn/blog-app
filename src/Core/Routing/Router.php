<?php

namespace Tekinaydogdu\Check24\Core\Routing;

use Tekinaydogdu\Check24\Core\View\Redirection;

class Router
{
    /**
     * @var Route[]
     */
    private array $routes = [];

    private function addRoute(string $method, string $path, callable $callback, bool $isPrivate = false): void
    {
        $this->routes[] = new Route($method, $path, $callback, $isPrivate);
    }

    public function get(string $path, callable $callback, bool $isPrivate = false): void
    {
        $this->addRoute('GET', $path, $callback, $isPrivate);
    }

    public function post(string $path, callable $callback, bool $isPrivate = false): void
    {
        $this->addRoute('POST', $path, $callback, $isPrivate);
    }

    public function patch(string $path, callable $callback, bool $isPrivate = false): void
    {
        $this->addRoute('PATCH', $path, $callback, $isPrivate);
    }

    public function put(string $path, callable $callback, bool $isPrivate = false): void
    {
        $this->addRoute('PUT', $path, $callback, $isPrivate);
    }

    public function delete(string $path, callable $callback, bool $isPrivate = false): void
    {
        $this->addRoute('DELETE', $path, $callback, $isPrivate);
    }

    public function any(string $path, callable $callback, bool $isPrivate = false): void
    {
        $this->addRoute('GET|POST|PATCH|PUT|DELETE', $path, $callback, $isPrivate);
    }

    private function run(): void
    {
        $method = $_SERVER['REQUEST_METHOD'];
        $path = $_SERVER['REQUEST_URI'];

        foreach ($this->routes as $route) {
            if ($route->match($method, $path)) {
                if ($route->isPrivate && !isset($_SESSION['user'])) {
                    if ($method === 'GET') {
                        new Route('GET', '/login', function () {
                            return new Redirection('/login');
                        });
                    }

                    http_response_code(401);
                    return;
                }

                $route();
                return;
            }
        }

        http_response_code(404);
    }

    public function __destruct()
    {
        $this->run();
    }
}
