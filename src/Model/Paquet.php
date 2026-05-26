<?php

namespace Root\Www\Model;

use PDO;

class Paquet extends Database
{
    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = Database::getConnection();
    }

    public function getAll()
    {
        $sql = "SELECT * FROM Employe";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getCoByRoute(int $routeLivraison_id)
    {
        $sql = "SELECT * FROM Paquet WHERE routeLivraison_id = :routeLivraison_id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['routeLivraison_id' => $routeLivraison_id]);
        return $stmt->fetchAll();
    }
}