DROP DATABASE dendo_jitensha;
CREATE DATABASE dendo_jitensha;
USE dendo_jitensha;

CREATE TABLE IF NOT EXISTS Utilisateurs(
     idUtilisateur INT NOT NULL AUTO_INCREMENT,
     nomUtilisateur VARCHAR(100) NOT NULL,
     prenomUtilisateur VARCHAR(100) NOT NULL,
     adresseUtilisateur VARCHAR(255) NOT NULL,
     emailUtilisateur VARCHAR(100) NOT NULL,
     passwordUtilisateur VARCHAR(255) NOT NULL,
     PRIMARY KEY (idUtilisateur)
);
