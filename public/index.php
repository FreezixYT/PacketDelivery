<?php
use Slim\Factory\AppFactory;
use Root\Www\Controller\HomeController;
use Root\Www\Controller\LoginController;
use Root\Www\Controller\PaquetController;
use Root\Www\Middleware\AuthMiddleware;

require __DIR__ . '/../vendor/autoload.php';

session_start();

$app = AppFactory::create();
$app->addErrorMiddleware(true, true, true);

$app->get('/', [HomeController::class, 'displayHome'])->add(AuthMiddleware::class);
$app->get('/{idLivreur}/{date}/', [HomeController::class, 'displayHome'])->add(AuthMiddleware::class);

$app->get('/login', [LoginController::class, 'displayLogin']);

//Paquets
$app->post('/paquet/add', [PaquetController::class, 'addPaquets']);

//login
$app->post('/login', [LoginController::class, 'login']);

$app->run();