-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : dim. 18 mai 2025 à 16:29
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `digitalrdv`
--

--
-- Déchargement des données de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`id`, `nom`, `prenom`, `email`, `mot_de_passe`, `role`, `date_inscription`) VALUES
(1, 'Gaamouche', 'Ibtissam', 'gaamouibtissam@gmail.com', '$2y$10$CSUiw0BlHa8RfTCYYRcbqelfdX92qwf./XQGCyueSuSSLpMugy5R2', 'patient', '2025-05-15 15:24:27'),
(9, 'elbalaoui', 'hasnae', 'hasnae@gmail.com', '$2y$10$M196zK.IcImsp8fNInY.ZeoXpsZyD8Xt1AtavSfwPMzmUSHPPXcXe', 'patient', '2025-05-15 15:41:02'),
(24, 'gaam', 'fatima', 'fatima@gmail.com', '$2y$10$pf4tQUZuQl8wN9RTO/5zjeMDRIpytJWZO/AB9sB9zzfBNDRL5Zj/O', 'patient', '2025-05-17 16:12:15'),
(26, 'gaam', 'nihad', 'nihad@gmail.com', '$2y$10$m.ac.0X/PiHTWmRE1Ne/TOJUVCPbEWYNltCd3dd4dAjlanGis7rVO', 'patient', '2025-05-17 16:18:55');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
