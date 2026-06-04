<?php

namespace Root\Www\Controller;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Root\Www\Schema\PaquetsValide;
use Slim\Views\PhpRenderer;
use Root\Www\Model\Paquet;
use Root\Www\Model\User;


class PaquetController
{
    public function addPaquets(Request $request, Response $response, array $args): Response
    {
        $view = new PhpRenderer("../view");
        $view->setLayout("layout.php");

        $data = $request->getParsedBody();

        $paquetValide = new PaquetsValide($data);
        $errors = [];
        $errors = $paquetValide->validate();

        if (empty($errors)) 
        {
            $paquet = new Paquet();
            $paquet->create($data);

            return $response
                ->withHeader('Location', '/')
                ->withStatus(302);
        } else {
            $paquet = new Paquet();
            $listPaquet = $paquet->getAll();

            $livreur = new User();
            $listLivreur = $livreur->getAllLivreur();

            return $view->render($response, 'adminHome.php', [
                'errors' => $errors,
                'paquets' => $listPaquet,
                'livreurs' => $listLivreur
            ]);
        }
    }

    public function editPaquets(Request $request, Response $response, array $args): Response
    {
        $view = new PhpRenderer("../view");
        $view->setLayout("layout.php");

        $data = $request->getParsedBody();
        $id = (int)$args['id'];

        $paquetValide = new PaquetsValide($data);
        $errors = $paquetValide->validate();

        if (empty($errors)) 
        {
            $paquet = new Paquet();
            $paquet->edit($id, $data);

            return $response
                ->withHeader('Location', '/')
                ->withStatus(302);
        } else {
            $paquet = new Paquet();
            $listPaquet = $paquet->getAll();

            $livreur = new User();
            $listLivreur = $livreur->getAllLivreur();

            return $view->render($response, 'adminHome.php', [
                'errors' => $errors,
                'paquets' => $listPaquet,
                'livreurs' => $listLivreur,
                'openModal' => true
            ]);
        }
    }

    public function livrerPaquet(Request $request, Response $response, array $args): Response
    {
        $paquet = new Paquet();
        $paquet->livre((int)$args['id']);
    
        return $response->withHeader('Location', '/')->withStatus(302);
    }

    public function deletePaquet(Request $request, Response $response, array $args): Response
    {
        $paquet = new Paquet();
        $paquet->delete((int)$args['id']);
    
        return $response->withHeader('Location', '/')->withStatus(302);
    }
}
