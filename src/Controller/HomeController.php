<?php
namespace Root\Www\Controller;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Views\PhpRenderer;


class HomeController
{
    public function displayHome(Request $request, Response $response, array $args): Response
    {
        $view = new PhpRenderer("../view");
        $view->setLayout("layout.php");

        $data = [
            'title' => 'Home',
        ];

        return $view->render($response, 'home.php', $data);
    }
}
