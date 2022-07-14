<?php

namespace Tekinaydogdu\Check24\Core\View;

class View implements Renderable
{
    public function __construct(protected readonly string $view, protected array $args = [])
    {
    }

    public function render(): void
    {
        extract($this->args);
        include('app/helpers.php');
        include("app/View/{$this->view}.php");
    }
}
