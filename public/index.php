<?php
use Slim\Factory\AppFactory;
use Root\Www\Controller\HomeController;

require __DIR__ . '/../vendor/autoload.php';

$app = AppFactory::create();
$app->addErrorMiddleware(true, true, true);

$app->get('/', [HomeController::class, 'displayHome']);

$app->run();