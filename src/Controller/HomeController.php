<?php

namespace Root\Www\Controller;

use DateTime;
use Root\Www\Model\Paquet;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Root\Www\Model\User;
use Slim\Views\PhpRenderer;


class HomeController
{
    public function displayHome(Request $request, Response $response, array $args): Response
    {
        $view = new PhpRenderer("../view");
        $view->setLayout("layout.php");

        if ($_SESSION['user']['estLivreur']) {
            if (!isset($args['date']) || !isset($args['idLivreur'])) {
                return $response->withHeader('Location', '/' . $_SESSION['user']['id'] . "/" . date('Y-m-d') . "/")->withStatus(302);
            }

            $paquet = new Paquet();

            $date = $args['date'] ?? date('Y-m-d');
            $idLivreur = $args['idLivreur'] ?? $_SESSION['user']['id'];

            $date = new DateTime($args['date']);

            $listPaquet = $paquet->getByDate($idLivreur, $date);
            $livreur = new User();
            $listLivreur = $livreur->getAllLivreur();

            $data = [
                'title' => 'Map',
                'paquets' => $listPaquet,
                'idLivreur' => $idLivreur,
                'date' => $date->format('Y-m-d')
            ];
            return $view->render($response, 'home.php', $data);
            
        } else {
            $paquet = new Paquet();
            $livreur = new User();

            $listPaquet = $paquet->getAll();
            $listLivreur = $livreur->getAllLivreur();

            $data = [
                'title' => 'Map',
                'paquets' => $listPaquet,
                'livreurs' => $listLivreur
            ];

            return $view->render($response, 'adminHome.php', $data);
        }
    }
}
