USE deliveryPackage;

CREATE TABLE Employe (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nom VARCHAR(100) NOT NULL,
    prenom VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    motDePasse VARCHAR(255) NOT NULL,
    estLivreur BOOLEAN NOT NULL DEFAULT true
);

CREATE TABLE RouteLivraison (
    id INT PRIMARY KEY AUTO_INCREMENT,
    dateRoute DATE NOT NULL,
    employe_id INT NOT NULL,
    CONSTRAINT fk_route_employe 
    FOREIGN KEY (employe_id) REFERENCES Employe(id)
);

CREATE TABLE Paquet (
    id INT PRIMARY KEY AUTO_INCREMENT,
    numeroPostal VARCHAR(20)  NOT NULL,
    nomDestinataire VARCHAR(100) NOT NULL,
    prenomDestinataire VARCHAR(100) NOT NULL,
    adresseDestinataire VARCHAR(255) NOT NULL,
    latitudeAdresse DECIMAL(10, 7),
    longitudeAdresse DECIMAL(10, 7),
    dateLivraison DATE,
    ordreRouteLivraison INT,
    statutLivraison VARCHAR(50)  NOT NULL DEFAULT 'en_attente',
    routeLivraison_id INT NOT NULL,
    employe_livreur_id INT NOT NULL,
    CONSTRAINT fk_paquet_route
        FOREIGN KEY (routeLivraison_id) REFERENCES RouteLivraison(id),
    CONSTRAINT fk_paquet_livreur
        FOREIGN KEY (employe_livreur_id) REFERENCES Employe(id)
);