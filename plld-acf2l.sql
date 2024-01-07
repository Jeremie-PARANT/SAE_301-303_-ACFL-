-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mer. 03 jan. 2024 à 17:28
-- Version du serveur : 8.2.0
-- Version de PHP : 8.2.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `plld-acf2l`
--

-- --------------------------------------------------------

--
-- Structure de la table `plld_adherent`
--

DROP TABLE IF EXISTS `plld_adherent`;
CREATE TABLE IF NOT EXISTS `plld_adherent` (
  `num` int NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  `surname` varchar(128) NOT NULL,
  `mail` varchar(128) NOT NULL,
  `activity` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `age` int DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `other` text,
  PRIMARY KEY (`num`)
) ENGINE=InnoDB AUTO_INCREMENT=65 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `plld_adherent`
--

INSERT INTO `plld_adherent` (`num`, `name`, `surname`, `mail`, `activity`, `age`, `phone`, `other`) VALUES
(1, 'PARANT', 'Jérémie', 'jj@gmail.com', 'Maintenance des ULM Moteur<br>', 20, '0606060606', 'J\'ai des lunettes'),
(2, 'Arno', 'LE MOIL', 'arno@gmail.com', 'Location d’emplacement ULM<br>', 21, '1111111111', 'Unijambiste');

-- --------------------------------------------------------

--
-- Structure de la table `plld_pilote`
--

DROP TABLE IF EXISTS `plld_pilote`;
CREATE TABLE IF NOT EXISTS `plld_pilote` (
  `name` varchar(255) NOT NULL,
  `surname` varchar(255) NOT NULL,
  `num` int NOT NULL,
  PRIMARY KEY (`num`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `plld_pilote`
--

INSERT INTO `plld_pilote` (`name`, `surname`, `num`) VALUES
('LE MOIL', 'Arno', 1);

-- --------------------------------------------------------

--
-- Structure de la table `plld_reservation`
--

DROP TABLE IF EXISTS `plld_reservation`;
CREATE TABLE IF NOT EXISTS `plld_reservation` (
  `date_debut` date DEFAULT NULL,
  `date_fin` date DEFAULT NULL,
  `date` date DEFAULT NULL,
  `model` varchar(255) NOT NULL,
  `status` varchar(255) DEFAULT NULL,
  `num` int NOT NULL AUTO_INCREMENT,
  `num_adherent` int DEFAULT NULL,
  `num_pilote` int DEFAULT NULL,
  `num_ulm` int DEFAULT NULL,
  PRIMARY KEY (`num`),
  KEY `fk_reservation_adherent` (`num_adherent`),
  KEY `fk_reservation_pilote` (`num_pilote`),
  KEY `fk_reservation_ulm` (`num_ulm`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `plld_reservation`
--

INSERT INTO `plld_reservation` (`date_debut`, `date_fin`, `date`, `model`, `status`, `num`, `num_adherent`, `num_pilote`, `num_ulm`) VALUES
('2024-01-11', '2024-01-02', NULL, '5', 'en attente', 33, 1, NULL, NULL),
('2024-01-01', '2024-01-10', NULL, 'aaaaaaaaaaaaaaaaaaaaaaaaaaa', 'en attente', 34, 1, NULL, NULL),
('2024-01-04', '2024-01-05', NULL, '', 'en attente', 35, 1, NULL, NULL),
('2024-01-11', '2024-01-19', NULL, '', 'en attente', 36, 1, NULL, NULL),
('2024-01-11', '2024-01-19', NULL, '', 'en attente', 37, 1, NULL, NULL),
('2024-01-10', '2025-04-26', NULL, '', 'en attente', 38, 1, NULL, NULL),
('2024-01-18', '2024-01-20', NULL, 'XG-8', 'en attente', 39, 2, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `plld_ulm`
--

DROP TABLE IF EXISTS `plld_ulm`;
CREATE TABLE IF NOT EXISTS `plld_ulm` (
  `type` varchar(255) NOT NULL,
  `num` int NOT NULL,
  PRIMARY KEY (`num`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `plld_ulm`
--

INSERT INTO `plld_ulm` (`type`, `num`) VALUES
('Avion', 1);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `plld_reservation`
--
ALTER TABLE `plld_reservation`
  ADD CONSTRAINT `fk_reservation_adherent` FOREIGN KEY (`num_adherent`) REFERENCES `plld_adherent` (`num`),
  ADD CONSTRAINT `fk_reservation_pilote` FOREIGN KEY (`num_pilote`) REFERENCES `plld_pilote` (`num`),
  ADD CONSTRAINT `fk_reservation_ulm` FOREIGN KEY (`num_ulm`) REFERENCES `plld_ulm` (`num`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
