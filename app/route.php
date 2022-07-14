<?php

use App\Repository\UserRepository;
use Laminas\Db\Sql\Where;
use Tekinaydogdu\Check24\Core\JsonResponse;
use Tekinaydogdu\Check24\Core\Routing\Router;
use Tekinaydogdu\Check24\Core\Security\CSRF;
use Tekinaydogdu\Check24\Core\View\View;

$router = new Router();

$router->get('/login', function () {
    return new View('login');
});
$router->post('/login', function () {
    if (!CSRF::validate($_POST['csrf_token'])) {
        return new JsonResponse(['status' => false, 'message' => 'Invalid CSRF token']);
    }

    $userRepository = new UserRepository();

    $where = new Where();
    $where->equalTo('email', $_POST['email']);

    $user = $userRepository->findOne($where);

    if ($user === null) {
        return new JsonResponse(['status' => false, 'message' => 'User not found']);
    }

    if (!password_verify($_POST['password'], $user['password'])) {
        return new JsonResponse(['status' => false, 'message' => 'Password is incorrect']);
    }

    $_SESSION['user'] = $userRepository->hideSecrets($user);

    return new JsonResponse(['status' => true, 'message' => 'Login successful']);
});
$router->get('/logout', function () {
    unset($_SESSION['user']);

    return new \Tekinaydogdu\Check24\Core\View\Redirection('/home');
});
$router->get('/home', function () {

    return new View('home');
});
