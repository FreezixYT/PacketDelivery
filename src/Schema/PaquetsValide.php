<?php

namespace Root\Www\Schema;

use DateTime;

class PaquetsValide
{
    public int $numeroPostal;
    public string $nomDestinataire;
    public string $prenomDestinataire;
    public string $adresseDestinataire;
    public ?DateTime $dateLivraison;
    public int $idLivreur;

    public function __construct(array $data)
    {
        $this->numeroPostal = (int)($data['numeroPostal'] ?? 0);
        $this->nomDestinataire = $data['nomDestinataire'] ?? '';
        $this->prenomDestinataire = $data['prenomDestinataire'] ?? '';
        $this->adresseDestinataire = $data['adresseDestinataire'] ?? '';
        $this->idLivreur = (int)($data['idLivreur'] ?? 0);

        $this->dateLivraison = !empty($data['dateLivraison'])
            ? DateTime::createFromFormat('Y-m-d', $data['dateLivraison'])
            : null;
    }

    public function validate(): array
    {
        $errors = [];

        if ($this->numeroPostal <= 0) {
            $errors[] = "Le numéro postal doit être positif.";
        }

        if ($this->nomDestinataire === '') {
            $errors[] = "Le nom du destinataire est obligatoire.";
        }

        if ($this->prenomDestinataire === '') {
            $errors[] = "Le prénom du destinataire est obligatoire.";
        }

        if ($this->adresseDestinataire === '') {
            $errors[] = "L'adresse du destinataire est obligatoire.";
        }

        if ($this->idLivreur <= 0) {
            $errors[] = "Veuillez sélectionner un livreur.";
        }

        if ($this->dateLivraison === null) {
            $errors[] = "La date de livraison est obligatoire.";
        } 
        else 
        {
            $today = new DateTime('today');
            $maxDate = new DateTime('today +3 days');

            if ($this->dateLivraison < $today || $this->dateLivraison > $maxDate) {
                $errors[] = "La date de livraison doit être comprise entre aujourd'hui et dans 3 jours.";
            }
        }

        return $errors;
    }
}