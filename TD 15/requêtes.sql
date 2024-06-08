-- Création de la base de données
CREATE DATABASE note;

-- Création de l'utilisateur et définition des privilèges
CREATE USER 'note'@'localhost' IDENTIFIED BY 'note123';
GRANT SELECT, INSERT, UPDATE, DELETE ON note.* TO 'note'@'localhost';
FLUSH PRIVILEGES;

USE note;

-- Création de la table matiere
CREATE TABLE matiere (
    id INT AUTO_INCREMENT PRIMARY KEY,
    description VARCHAR(255) NOT NULL
);

-- Création de la table annee
CREATE TABLE annee (
    annee YEAR PRIMARY KEY
);

-- Création de la table note
CREATE TABLE note (
    id INT AUTO_INCREMENT PRIMARY KEY,
    note FLOAT NOT NULL,
    annee YEAR NOT NULL,
    matiereID INT NOT NULL,
    eleveId INT NOT NULL,
    FOREIGN KEY (matiereID) REFERENCES matiere(id),
    FOREIGN KEY (annee) REFERENCES annee(annee)
);

-- Ajout des matières
INSERT INTO matiere (description) values ('NFA008'),  ('NFA021'),  ('NFA040'),  ('NFA041'),  ('NFA042');
INSERT INTO annee (annee) values ('2020'),  ('2023'),  ('2024'),  ('2025'),  ('2026');

TRUNCATE note;