<?php

namespace Root\Www\Model;

use DateTime;
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

    public function getByDate(int $idLivreur, DateTime $dateLivraison)
    {
        $sql = "SELECT * FROM Paquet WHERE employe_livreur_id = :employe_livreur_id AND dateLivraison = :dateLivraison";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['employe_livreur_id' => $idLivreur,'dateLivraison' => $dateLivraison->format("Y-m-d")]);
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
        $sql = "INSERT INTO Paquet 
        (numeroPostal, nomDestinataire, prenomDestinataire, adresseDestinataire, latitudeAdresse, longitudeAdresse, dateLivraison, employe_livreur_id) 
        VALUES 
        (:numeroPostal, :nomDestinataire, :prenomDestinataire, :adresseDestinataire, :latitudeAdresse, :longitudeAdresse, :dateLivraison, :employe_livreur_id)";

        $stmt = $this->pdo->prepare($sql);

        return $stmt->execute([
            'numeroPostal' => (int)$data['numeroPostal'],
            'nomDestinataire' => $data['nomDestinataire'],
            'prenomDestinataire' => $data['prenomDestinataire'],
            'adresseDestinataire' => $data['adresseDestinataire'],
            'latitudeAdresse' => $data['latitudeAdresse'],
            'longitudeAdresse' => $data['longitudeAdresse'],
            'dateLivraison' => $data['dateLivraison'],
            'employe_livreur_id' => (int)$data['idLivreur']
        ]);
    }
}