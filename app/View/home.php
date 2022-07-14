<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home</title>
    <?php
    inc('styles'); ?>
</head>
<body>
<?php
inc('header'); ?>

<div class="container">
    <div class="row mb-2">
        <?php
        foreach ($posts as $post): ?>
            <div class="col-md-12">
                <div class="card flex-md-row mb-4 box-shadow h-md-250">
                    <div class="card-body d-flex flex-column align-items-start">
                        <h3 class="mb-0">
                            <a class="text-dark" href="/post/<?= $post['id'] ?>"><?= $post['title'] ?></a>
                        </h3>
                        <div class="mb-1 text-muted"><?= $post['created_at'] ?></div>
                        <p class="card-text mb-auto"><?= substr($post['content'], 0, 1000) . (strlen(
                                $post['content']
                            ) > 1000 ? '...' : '') ?></p>
                        <br>
                        <a href="/post/<?= $post['id'] ?>">Continue reading</a>
                    </div>
                    <img class="card-img-right flex-auto d-none d-md-block" data-src="holder.js/200x250?theme=thumb" style="width: 150px; height: 150px;"
                         src="<?= $post['image_url'] ?>"
                         data-holder-rendered="true">
                </div>
            </div>
        <?php endforeach; ?>
        <nav aria-label="Page navigation">
            <ul class="pagination">
                <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                <?php for ($i = 1; $i <= $count; $i++): ?>
                    <li class="page-item"><a class="page-link" href="/home/<?= $i ?>"><?= $i ?></a></li>
                <?php endfor; ?>
                <li class="page-item"><a class="page-link" href="#">Next</a></li>
            </ul>
        </nav>
    </div>
</div>
</body>
<?php
inc('scripts'); ?>
</html>