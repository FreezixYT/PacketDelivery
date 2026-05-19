<?php
use Slim\Factory\AppFactory;
use Root\Www\Controller\HomeController;
use Root\Www\Controller\LoginController;
use Root\Www\Controller\PaquetController;

require __DIR__ . '/../vendor/autoload.php';

session_start();

$app = AppFactory::create();
$app->addErrorMiddleware(true, true, true);

$app->get('/', [HomeController::class, 'displayHome']);
$app->get('/login', [HomeController::class, 'displayLogin']);

//Paquets
$app->post('/addPaquets', [PaquetController::class, 'addPaquets']);

//login
$app->post('/login', [LoginController::class, 'login']);

//debug routes
$app->get('/adminHome', [HomeController::class, 'displayAdminHome']);

$app->run();