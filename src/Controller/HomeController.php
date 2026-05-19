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

    public function displayAdminHome(Request $request, Response $response, array $args): Response
    {
        $view = new PhpRenderer("../view");
        $view->setLayout("layout.php");

        $data = [
            'title' => 'Login',
        ];

        return $view->render($response, 'adminHome.php', $data);
    }

}
