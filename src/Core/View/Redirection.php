<?php

namespace Tekinaydogdu\Check24\Core\View;

class Redirection implements Renderable
{
    public function __construct(private readonly string $url, private readonly int $status = 301)
    {
    }

    public function render(): void
    {
        ob_clean();
        header('Location: ' . $this->url);
        http_response_code($this->status);
    }
}
