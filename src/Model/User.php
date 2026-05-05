<?php

namespace Root\Www\Model;
use PDO;
use PDOException;

class User extends Database
{
    public string $nom;
    public string $prenom;
    public string $email;
    public string $motDePass;
    public bool $estLivreur;


    public function __construct()
    {
        $nom = $this->nom;
        $prenom = $this->prenom;
        $email = $this->email;
        $motDePass = $this->motDePass;
        $estLivreur = $this->estLivreur;
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