<?php

namespace Tekinaydogdu\Check24\Core\Routing;

use Tekinaydogdu\Check24\Core\View\Renderable;
use Tekinaydogdu\Check24\Core\View\View;

class Route
{
    /** @var array<string,mixed> */
    protected array $args = [];

    /**
     * @param string $method HTTP method (GET, POST, PUT, etc. or 'GET|POST|PATCH|PUT|DELETE')
     * @param string $path Path to match against (e.g. '/users/:id')
     * @param callable $callback to call when the route matches
     * @param bool $isPrivate Whether the route is private (only accessible by the users who logged-in)
     */
    public function __construct(
        private readonly string $method,
        private string $path,
        private $callback,
        public bool $isPrivate = false
    ) {
        $this->path = $this->normalizePath($path);
    }

    private function normalizePath(string $path): string
    {
        $path = trim($path, '/');
        $path = preg_replace('/:(\w+)/', '(?<$1>[^/]+)', $path);
        $path = preg_replace('/\//', '\\/', $path);

        return "/^$path$/";
    }

    private function matchMethod(string $method): bool
    {
        return str_contains($this->method, $method);
    }

    /**
     * @param string $path Path to match against (e.g. '/users/:id')
     * @return false|array<int|string,mixed> Array of arguments if the path matches, false otherwise
     */
    private function matchPath(string $path): false|array
    {
        if (!preg_match($this->path, trim($path, '/'), $matches)) {
            return false;
        }

        return array_slice($matches, 1);
    }

    private function parseArgs(array $matches): void
    {
        foreach ($matches as $key => $value) {
            if (is_int($key)) {
                continue;
            }

            $this->args[$key] = $value;
        }
    }

    /**
     * @param string $method HTTP method (GET, POST, PUT, etc. or 'GET|POST|PATCH|PUT|DELETE')
     * @param string $path Path to match against (e.g. '/users/:id')
     * @return bool
     */
    public function match(string $method, string $path): bool
    {
        if (!$this->matchMethod($method)) {
            return false;
        }

        $matches = $this->matchPath($path);

        if ($matches === false) {
            return false;
        }

        $this->parseArgs($matches);

        return true;
    }

    public function __invoke(): mixed
    {
        $return = call_user_func($this->callback, ...$this->args);

        if ($return instanceof Renderable) {
            $return->render();
            return null;
        }

        return $return;
    }
}
