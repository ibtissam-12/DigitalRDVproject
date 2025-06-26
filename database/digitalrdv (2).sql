-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : jeu. 22 mai 2025 à 00:01
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

-- --------------------------------------------------------

--
-- Structure de la table `rendezvous`
--

CREATE TABLE `rendezvous` (
  `id` int(11) NOT NULL,
  `utilisateur_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `heure` time NOT NULL,
  `statut` enum('prévu','annulé','terminé') DEFAULT 'prévu',
  `nom` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `rendezvous`
--

INSERT INTO `rendezvous` (`id`, `utilisateur_id`, `date`, `heure`, `statut`, `nom`, `email`) VALUES
(5, 1, '2025-05-18', '16:30:00', 'prévu', 'Ibtissam Gaamouche', 'gaamibtissam@gmail.com'),
(6, 1, '2025-05-09', '16:00:00', 'prévu', 'Ibtissam Gaamouche', 'gaamouibtissam@gmail.com'),
(7, 1, '2025-05-17', '16:30:00', 'prévu', 'Ibtissam Gaamouche', 'gaamouibtissam@gmail.com'),
(8, 1, '2025-05-16', '16:00:00', 'prévu', 'Ibtissam Gaamouche', 'gaamouibtissam@gmail.com');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

CREATE TABLE `utilisateurs` (
  `id` int(11) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `prenom` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `mot_de_passe` varchar(255) NOT NULL,
  `role` enum('patient','admin') DEFAULT 'patient',
  `date_inscription` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`id`, `nom`, `prenom`, `email`, `mot_de_passe`, `role`, `date_inscription`) VALUES
(1, 'Gaamouche', 'Ibtissam', 'gaamouibtissam@gmail.com', '$2y$10$CSUiw0BlHa8RfTCYYRcbqelfdX92qwf./XQGCyueSuSSLpMugy5R2', 'patient', '2025-05-15 15:24:27'),
(9, 'elbalaoui', 'hasnae', 'hasnae@gmail.com', '$2y$10$M196zK.IcImsp8fNInY.ZeoXpsZyD8Xt1AtavSfwPMzmUSHPPXcXe', 'patient', '2025-05-15 15:41:02'),
(24, 'gaam', 'fatima', 'fatima@gmail.com', '$2y$10$pf4tQUZuQl8wN9RTO/5zjeMDRIpytJWZO/AB9sB9zzfBNDRL5Zj/O', 'patient', '2025-05-17 16:12:15'),
(26, 'gaam', 'nihad', 'nihad@gmail.com', '$2y$10$m.ac.0X/PiHTWmRE1Ne/TOJUVCPbEWYNltCd3dd4dAjlanGis7rVO', 'patient', '2025-05-17 16:18:55'),
(29, 'gaam', 'sanae', 'sanae@gmail.com', '$2y$10$jV/iq.UqrILm3ZgJ2XmiqO5Jvb4ZiDeOOucQrQnysL14tIEyvN6i2', 'patient', '2025-05-18 16:05:10'),
(30, 'gaam', 'amin', 'amin@gmail.com', '$2y$10$T2/FfebsO/ak8k2nunzhmedN6R1w06wyb2kNQ.ZlOag.7lUvoMVQC', 'patient', '2025-05-19 11:55:51'),
(31, 'gaam ', 'safae', 'safae@gmail.com', '$2y$10$k7FPWeqlZP4D89Nu5q2dlebAhskAyP5pSaUQU0QdqQEpkVROii0ua', 'patient', '2025-05-20 09:07:18'),
(32, 'gaamouche', 'abdelaziz', 'abdelaziz@gmail.com', '$2y$10$kAd7vfYGFVdD0cJPYRxpQ.MvjPE7pKGps9FI4WEbpWdLPfu7J6JQO', 'patient', '2025-05-20 09:12:54'),
(33, 'admin', 'adm', 'admin@gmail.com', '$2y$10$AuiJHT9mhjmGpZ/SmrQG0epGpqRDvWsq0WzT8SL5U7MESSBeQCvdC', 'admin', '2025-05-20 18:05:15');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `rendezvous`
--
ALTER TABLE `rendezvous`
  ADD PRIMARY KEY (`id`),
  ADD KEY `utilisateur_id` (`utilisateur_id`);

--
-- Index pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `rendezvous`
--
ALTER TABLE `rendezvous`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `rendezvous`
--
ALTER TABLE `rendezvous`
  ADD CONSTRAINT `rendezvous_ibfk_1` FOREIGN KEY (`utilisateur_id`) REFERENCES `utilisateurs` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
