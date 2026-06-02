<?php

namespace Root\Www\Model;

use PDO;
use Root\Www\Schema\UserLogin;

class User extends Database
{
    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = Database::getConnection();
    }

    public function getAll()
    {
        $sql = "SELECT id, nom, prenom, email, estLivreur FROM Employe";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllLivreur()
    {
        $sql = "SELECT id, nom, prenom, email, estLivreur FROM Employe WHERE estLivreur = true";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllFreeLivreur(string $date)
    {
        $sql = "SELECT e.id, e.nom, e.prenom, e.email, e.estLivreur 
                FROM Employe e
                WHERE e.estLivreur = true 
                AND (
                    SELECT COUNT(*) FROM Paquet p 
                    WHERE p.employe_livreur_id = e.id 
                    AND p.dateLivraison = :date
                ) < 10";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['date' => $date]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getByEmail(string $email)
    {
        $sql = "SELECT id, nom, prenom, email, estLivreur FROM Employe WHERE email = :email";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['email' => $email]);
        return $stmt->fetch();
    }

    public function login(UserLogin $user): array|false
    {
        $sql = "SELECT * FROM Employe WHERE email = :email";

        $stmt = $this->pdo->prepare($sql);

        $stmt->execute([
            'email' => $user->email
        ]);

        $response = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($response && password_verify($user->password, $response['motDePasse'])) {
            return $response;
        }

        return false;
    }
}