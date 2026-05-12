<?php

namespace Root\Www\Schema;

class PaquetsValide
{

    public int $numeroPostal;
    public string $nomDestinataire;
    public string $prenomDestinataire;
    public string $adresseDestinataire;


    public function __construct(array $data) {
        $this->numeroPostal = $data['numeroPostal'] ?? 0;
        $this->nomDestinataire = $data['nomDestinataire'] ?? '';
        $this->prenomDestinataire = $data['prenomDestinataire'] ?? '';
        $this->adresseDestinataire = $data['adresseDestinataire'] ?? '';
    }


    public function validate() : array
    {
        $errors = [];

        if ($this->numeroPostal <= 0) {
            $errors[] = "Le numéro postal doit être positif.";
        }

        if (empty($this->nomDestinataire)) {
            $errors[] = "Le nom du déstinatair est obligatoir";
        }

        if (empty($this->prenomDestinataire)) {
            $errors[] = "Le prénom du déstinataire est obligatoir";
        }

        if (empty($this->adresseDestinataire)) {
            $errors[] = "L'adress est obligatoir";
        }

        return $errors;

    }
}