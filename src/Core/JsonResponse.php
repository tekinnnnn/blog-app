<?php

namespace Tekinaydogdu\Check24\Core;

use Tekinaydogdu\Check24\Core\View\Renderable;

class JsonResponse implements Renderable
{
    public function __construct(private readonly array $data)
    {
    }

    public function render(): void
    {
        header('Content-Type: application/json');
        echo json_encode($this->data);
    }
}
