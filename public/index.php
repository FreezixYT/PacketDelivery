<?php
use Slim\Factory\AppFactory;
use Root\Www\Controller\HomeController;
use Root\Www\Controller\LoginController;
use Root\Www\Controller\PaquetController;
use Root\Www\Middleware\AuthMiddleware;
use Slim\Routing\RouteCollectorProxy;

require __DIR__ . '/../vendor/autoload.php';

session_start();

$app = AppFactory::create();
$app->addErrorMiddleware(true, true, true);

$app->get('/', [HomeController::class, 'displayHome'])->add(AuthMiddleware::class);
$app->get('/{idLivreur}/{date}/', [HomeController::class, 'displayHome'])->add(AuthMiddleware::class);

$app->get('/login', [LoginController::class, 'displayLogin']);

//Paquets
$app->group('/paquet', function (RouteCollectorProxy $group)
{
    $group->post('/add', [PaquetController::class, 'addPaquets'])->add(AuthMiddleware::class);
    $group->post('/edit/{id}', [PaquetController::class, 'editPaquets'])->add(AuthMiddleware::class);
    $group->post('/delete/{id}', [PaquetController::class, 'deletePaquet'])->add(AuthMiddleware::class);
});

//login
$app->post('/login', [LoginController::class, 'login']);

$app->run();