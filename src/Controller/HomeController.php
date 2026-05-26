<?php

namespace Root\Www\Controller;

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

        if (!$_SESSION['user']['estLivreur']) {
            $paquet = new Paquet();
            $listPaquet = $paquet->getCoByRoute(1);

            $data = [
                'title' => 'Home',
                'paquets' => $listPaquet
            ];

            return $view->render($response, 'home.php', $data);
        } 
        else 
        {
            $paquet = new Paquet();
            $listPaquet = $paquet->getAll();

            $livreur = new User();
            $listLivreur = $livreur->getAllLivreur();

            $data = [
                'title' => 'Login',
                'livreurs' => $listLivreur,
                'paquets' => $listPaquet
            ];

            return $view->render($response, 'adminHome.php', $data);
        }
    }

    public function displayLogin(Request $request, Response $response, array $args): Response
    {
        $view = new PhpRenderer("../view");
        $view->setLayout("layout.php");

        $data = [
            'title' => 'Login',
            'errors' => ''
        ];

        return $view->render($response, 'login.php', $data);
    }
}
