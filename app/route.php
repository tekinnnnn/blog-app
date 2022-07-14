<?php

use Tekinaydogdu\Check24\Core\Routing\Router;

$router = new Router();

$router->get('/', function () {
    echo "<h1>Aloha!</h1>";
});
$router->get('/test', function () {
    echo "<h1>Hello Tester!</h1>";
});
$router->get('/users/:id', function ($id) {
    echo "<h1>Hello!</h1>";
    echo "<p>User ID: $id</p>";
});
$router->get('/users/:id/:name', function ($id, $name) {
    echo "<h1>Hello!</h1>";
    echo "<p>User ID: $id</p>";
    echo "<p>User Name: $name</p>";
});
