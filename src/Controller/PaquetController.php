<?php

namespace Root\Www\Controller;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Root\Www\Schema\PaquetsValide;
use Slim\Views\PhpRenderer;

class PaquetController
{
    public function addPaquets(Request $request, Response $response, array $args): Response
    {
        $view = new PhpRenderer("../view");
        $view->setLayout("layout.php");

        $data = $request->getParsedBody();

        $paquet = new PaquetsValide($data);
        $errors = $paquet->validate();

        if (empty($errors)) {

            return $response
                ->withHeader('Location', '/adminHome')
                ->withStatus(302);
        } else {
            return $view->render($response, 'adminHome.php', [
                'errors' => $errors
            ]);
        }
    }
}
