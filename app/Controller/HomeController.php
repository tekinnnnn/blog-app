<?php

namespace App\Controller;

use App\Repository\PostRepository;
use Tekinaydogdu\Check24\Core\View\View;

class HomeController
{
    public int $pageBy = 3;

    public function index(): View
    {
        $page = $_GET['page'] ?? 1;
        $offset = ($page - 1) * $this->pageBy;

        $postRepository = new PostRepository();
        $posts = $postRepository->find(null, $offset, $this->pageBy);
        $pageCount = ceil($postRepository->count() / $this->pageBy);

        return new View('home', ['posts' => $posts, 'count' => $pageCount]);
    }
}