CREATE DATABASE IF NOT EXISTS horaire_eleve
    CHARACTER SET utf8mb4
    COLLATE utf8mb4_unicode_ci;

USE horaire_eleve;

SET NAMES utf8mb4;

DROP TABLE IF EXISTS creneaux;
DROP TABLE IF EXISTS cours;
DROP TABLE IF EXISTS classes;

CREATE TABLE classes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(50) NOT NULL UNIQUE,
    annee_scolaire VARCHAR(9) NOT NULL
);

CREATE TABLE cours (
    id INT AUTO_INCREMENT PRIMARY KEY,
    code VARCHAR(20) NOT NULL,
    nom VARCHAR(120) NOT NULL
);

CREATE TABLE creneaux (
    id INT AUTO_INCREMENT PRIMARY KEY,
    classe_id INT NOT NULL,
    cours_id INT NOT NULL,
    jour ENUM('lundi', 'mardi', 'mercredi', 'jeudi', 'vendredi'),
    heure_debut TIME NOT NULL,
    heure_fin TIME NOT NULL,
    salle VARCHAR(20) NOT NULL,

    CONSTRAINT fk_creneaux_classes
        FOREIGN KEY (classe_id) REFERENCES classes(id)
        ON DELETE RESTRICT
        ON UPDATE CASCADE,

    CONSTRAINT fk_creneaux_cours
        FOREIGN KEY (cours_id) REFERENCES cours(id)
        ON DELETE RESTRICT
        ON UPDATE CASCADE
);

INSERT INTO classes (nom, annee_scolaire) VALUES
('I.DA-P3A', '2026-2027');

INSERT INTO cours (code, nom) VALUES
('AWEB3', 'Atelier Web 3e année S1');

INSERT INTO creneaux (classe_id, cours_id, jour, heure_debut, heure_fin, salle) VALUES
(1, 1, 'jeudi', '08:05:00', '11:40:00', 'R104');