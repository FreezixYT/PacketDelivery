<?php
use Slim\Factory\AppFactory;
use Root\Www\Controller\HomeController;
use Root\Www\Controller\PaquetController;

require __DIR__ . '/../vendor/autoload.php';

$app = AppFactory::create();
$app->addErrorMiddleware(true, true, true);

$app->get('/', [HomeController::class, 'displayHome']);
$app->get('/login', [HomeController::class, 'displayLogin']);

//Paquets
$app->post('/addPaquets', [PaquetController::class, 'addPaquets']);

//debug routes
$app->get('/adminHome', [HomeController::class, 'displayAdminHome']);

$app->run();