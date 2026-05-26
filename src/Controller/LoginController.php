<?php

namespace Root\Www\Controller;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Root\Www\Schema\UserLogin;
use Root\Www\Model\User;
use Slim\Views\PhpRenderer;

class LoginController
{
    public function login(Request $request, Response $response, array $args): Response
    {
        $view = new PhpRenderer("../view");
        $view->setLayout("layout.php");

        $errors = [];

        if ($request->getMethod() === 'POST') 
        {
            $data = $request->getParsedBody() ?? [];
            $userData = new UserLogin($data);
            $errors = $userData->validate();

            if (empty($errors)) 
            {
                $user = new User();
                $connectedUser = $user->login($userData);

                if ($connectedUser) 
                {
                    $dataUser = $user->getByEmail($userData->email);
                    $_SESSION["user"] = $dataUser;
                    return $response->withHeader('Location', '/')->withStatus(302);
                } 
                else 
                {
                    $errors[] = "Email ou mot de passe incorrect";
                }
            }
        }

        return $view->render($response, 'login.php', [
            'errors' => $errors
        ]);
    }
}