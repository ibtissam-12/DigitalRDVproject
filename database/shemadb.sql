CREATE DATABASE IF NOT EXISTS digitalrdv;
USE digitalrdv;
CREATE TABLE IF NOT EXISTS utilisateurs(
  id INT AUTO_INCREMENT PRIMARY KEY,
  nom VARCHAR(100) NOT NULL,
  prenom VARCHAR(100) NOT NULL,
  email VARCHAR(100) UNIQUE NOT NULL,
  mot_de_passe VARCHAR(255) NOT NULL,
  role ENUM('patient', 'admin') DEFAULT 'patient',
  date_inscription DATETIME DEFAULT CURRENT_TIMESTAMP
);
CREATE TABLE rendezvous (
  id INT AUTO_INCREMENT PRIMARY KEY,
  utilisateur_id INT NOT NULL,
  date DATE NOT NULL,
  heure TIME NOT NULL,
  statut ENUM('prévu', 'annulé', 'terminé') DEFAULT 'prévu',
  FOREIGN KEY (utilisateur_id) REFERENCES utilisateurs(id) ON DELETE CASCADE
);
