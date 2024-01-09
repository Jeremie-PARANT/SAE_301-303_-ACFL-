-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mar. 09 jan. 2024 à 21:04
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
  `autorisation` tinyint(1) NOT NULL,
  PRIMARY KEY (`num`)
) ENGINE=InnoDB AUTO_INCREMENT=65 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `plld_adherent`
--

INSERT INTO `plld_adherent` (`num`, `name`, `surname`, `mail`, `activity`, `age`, `phone`, `other`, `autorisation`) VALUES
(1, 'admin', 'admin', 'admin@gmail.com', NULL, NULL, NULL, NULL, 1),
(2, 'LE MOIL', 'Arno', 'arno@gmail.com', 'Cours de pilotage<br>Baptême de l\'air<br>Cours de réparation<br>', 21, '1111111111', 'Clown unijambiste', 0),
(3, 'DE ABREU', 'Ruben', 'ruru@gmail.com', '<br>Baptême de l\'air<br>', 42, '0656485354', '', 0),
(4, 'LE NORMAND', 'Morgane', 'airgonomie@gmail.com', '', NULL, '', 'Proffesseur d\'airgonomie', 0),
(5, 'PARANT', 'Jérémie', 'jj@gmail.com', 'Cours de pilotage<br>Baptême de l\'air<br>', 20, '0606060606', 'J\'ai des lunettes', 0);

-- --------------------------------------------------------

--
-- Structure de la table `plld_pilote`
--

DROP TABLE IF EXISTS `plld_pilote`;
CREATE TABLE IF NOT EXISTS `plld_pilote` (
  `name` varchar(255) NOT NULL,
  `surname` varchar(255) NOT NULL,
  `num` int NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`num`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `plld_pilote`
--

INSERT INTO `plld_pilote` (`name`, `surname`, `num`) VALUES
('GUILLARD', 'Glenn', 1),
('RIMBERT', 'Marius', 2),
('Besnier', 'Arnault', 3),
('HANCHON', 'Alexandre', 4);

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
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `plld_reservation`
--

INSERT INTO `plld_reservation` (`date_debut`, `date_fin`, `date`, `model`, `status`, `num`, `num_adherent`, `num_pilote`, `num_ulm`) VALUES
('2024-01-01', '2024-01-10', '2024-01-09', 'Pendulaire', 'accepter', 34, 5, 1, 2),
('2024-01-15', '2025-04-26', '0000-00-00', 'Pendulaire', 'accepter', 38, 5, 4, 1),
('2024-01-18', '2024-01-20', NULL, 'Autogire', 'en attente', 39, 2, NULL, NULL),
('2024-01-19', '2024-05-18', '2024-03-13', 'Pendulaire', 'accepter', 40, 3, 2, 3),
('2024-05-09', '2024-06-29', NULL, 'Multiaxe', 'en attente', 41, 3, NULL, NULL),
('2024-01-20', '2024-04-20', NULL, 'Autogire', 'en attente', 42, 4, NULL, NULL),
('2024-01-12', '2024-01-19', NULL, 'Tetse', 'en attente', 45, 5, NULL, NULL),
('2024-01-11', '2024-01-19', NULL, 'dazdazd', 'en attente', 46, 5, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `plld_ulm`
--

DROP TABLE IF EXISTS `plld_ulm`;
CREATE TABLE IF NOT EXISTS `plld_ulm` (
  `type` varchar(255) NOT NULL,
  `num` int NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`num`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `plld_ulm`
--

INSERT INTO `plld_ulm` (`type`, `num`) VALUES
('Pendulaire', 1),
('Pendulaire', 2),
('Pendulaire', 3),
('Multiaxe', 4),
('Multiaxe', 5),
('Multiaxe', 6),
('Multiaxe', 7),
('Autogire', 8);

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
