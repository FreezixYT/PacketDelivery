<?php

namespace Root\Www\Model;
use PDO;
use PDOException;

class Paquet extends Database
{
    public string $numeroPostal;
    public string $nomDestinataire;
    public string $prenomDestinataire;
    public string $adresseDestinataire;



    public function __construct()
    {
        $numeroPostal = $this->numeroPostal;
        $nomDestinataire = $this->nomDestinataire;
        $prenomDestinataire = $this->prenomDestinataire;
        $adresseDestinataire = $this->adresseDestinataire;
    }

    //Recuper l'utilisateur et renvoie l'utilisateur si le mot de pass est just
    function login()
    {

        $sql = "SELECT * FROM Employe WHERE email = :email";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['email' => $this->email]);
        $response = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($response && password_verify($this->$motDePass, $response['motDePasse']))
        {
            return $response;
        }

    }
}