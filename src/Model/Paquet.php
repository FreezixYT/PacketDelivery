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
        $sql = "SELECT * FROM Paquet";
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

    public function create(array $data): bool
    {
        var_dump($data);
        $sql = "INSERT INTO Paquet 
        (numeroPostal, nomDestinataire, prenomDestinataire, adresseDestinataire, dateLivraison, idLivreur) 
        VALUES 
        (:numeroPostal, :nomDestinataire, :prenomDestinataire, :adresseDestinataire, :dateLivraison, :idLivreur)";

        $stmt = $this->pdo->prepare($sql);

        return $stmt->execute([
            'numeroPostal' => (int)$data['numeroPostal'],
            'nomDestinataire' => $data['nomDestinataire'],
            'prenomDestinataire' => $data['prenomDestinataire'],
            'adresseDestinataire' => $data['adresseDestinataire'],
            'dateLivraison' => $data['dateLivraison'],
            'idLivreur' => (int)$data['idLivreur']
        ]);
    }
}