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
    routeLivraison_id INT DEFAULT NULL,
    employe_livreur_id INT NOT NULL,
    CONSTRAINT fk_paquet_route
        FOREIGN KEY (routeLivraison_id) REFERENCES RouteLivraison(id),
    CONSTRAINT fk_paquet_livreur
        FOREIGN KEY (employe_livreur_id) REFERENCES Employe(id)
);

-- Les donnée des utilisateur on été générer par chatgpt, et tout les mot des passe sont super

INSERT INTO Employe (nom, prenom, email, motDePasse, estLivreur) VALUES

-- ADMINS
('Freezix', 'dev', 'freezix.dev@gmail.com', '$2y$12$CR/T9RletfIdxBLL5GjLKe2ueDHS5iPVMP6yOee198PLNq9IUpI3C', 0),

-- EMPLOYÉS / LIVREURS
('Petit', 'Jean', 'jean@freezix.com', '$2y$12$CR/T9RletfIdxBLL5GjLKe2ueDHS5iPVMP6yOee198PLNq9IUpI3C', 1),
('Robert', 'Emma', 'emma.robert@company.com', '$2y$12$CR/T9RletfIdxBLL5GjLKe2ueDHS5iPVMP6yOee198PLNq9IUpI3C', 1);