-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:8889
-- Généré le : dim. 03 nov. 2024 à 17:15
-- Version du serveur : 5.7.39
-- Version de PHP : 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `projet1`
--

-- --------------------------------------------------------

--
-- Structure de la table `ACTIVITE`
--

CREATE TABLE `ACTIVITE` (
  `CODEANIM` char(8) NOT NULL,
  `DATEACT` date NOT NULL,
  `CODEETATACT` char(2) NOT NULL,
  `HRRDVACT` time DEFAULT NULL,
  `PRIXACT` decimal(7,2) DEFAULT NULL,
  `HRDEBUTACT` time DEFAULT NULL,
  `HRFINACT` time DEFAULT NULL,
  `DATEANNULEACT` date DEFAULT NULL,
  `NOMRESP` char(40) DEFAULT NULL,
  `PRENOMRESP` char(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `ACTIVITE`
--

INSERT INTO `ACTIVITE` (`CODEANIM`, `DATEACT`, `CODEETATACT`, `HRRDVACT`, `PRIXACT`, `HRDEBUTACT`, `HRFINACT`, `DATEANNULEACT`, `NOMRESP`, `PRENOMRESP`) VALUES
('1', '2024-10-12', '1', '03:00:00', '25.00', '11:00:00', '14:00:00', '2024-10-12', 'Football', 'Football'),
('1', '2024-10-13', '1', '09:00:00', '20.00', '10:00:00', '13:00:00', NULL, 'Basketball', 'Basketball'),
('1', '2024-10-14', '1', '08:30:00', '15.00', '09:30:00', '12:30:00', NULL, 'Volley-ball', 'Volley-ball'),
('1', '2024-10-15', '1', '10:00:00', '25.00', '11:00:00', '14:00:00', NULL, 'Volley-ball', 'Volley-ball'),
('2', '2024-10-16', '2', '07:00:00', '30.00', '08:00:00', '12:00:00', NULL, 'Randonnée', 'Montagne'),
('2', '2024-10-17', '2', '08:30:00', '25.00', '09:30:00', '12:30:00', NULL, 'Randonnée à vélo', 'Randonnée à vélo'),
('2', '2024-10-18', '2', '09:00:00', '20.00', '10:00:00', '13:00:00', NULL, 'Marche', 'Nordique'),
('2', '2024-10-19', '2', '07:30:00', '35.00', '08:30:00', '12:30:00', NULL, 'Trail', 'Nature'),
('3', '2024-10-20', '3', '09:00:00', '15.00', '10:00:00', '12:00:00', NULL, 'Chasse', 'Trésor'),
('3', '2024-10-21', '3', '08:30:00', '20.00', '09:30:00', '12:30:00', NULL, 'Course', 'Orientation'),
('3', '2024-10-22', '3', '13:00:00', '25.00', '14:00:00', '17:00:00', NULL, 'Escape', 'Game'),
('4', '2024-10-23', '4', '09:00:00', '35.00', '10:00:00', '13:00:00', NULL, 'Accrobranche', 'Aventure'),
('4', '2024-10-24', '4', '08:30:00', '30.00', '09:30:00', '12:30:00', NULL, 'VTT', 'Aventure'),
('4', '2024-10-25', '4', '14:00:00', '20.00', '15:00:00', '17:00:00', NULL, 'Tir', 'Arc'),
('4', '2024-10-26', '4', '10:00:00', '40.00', '11:00:00', '14:00:00', NULL, 'Paintball', 'Aventure'),
('4', '2024-10-27', '4', '13:00:00', '25.00', '14:00:00', '16:00:00', NULL, 'Initiation', 'Skateboard'),
('5', '2024-10-28', '5', '18:00:00', '10.00', '18:30:00', '21:30:00', NULL, 'Jeux', 'Plateau'),
('5', '2024-10-29', '5', '18:30:00', '15.00', '19:00:00', '22:00:00', NULL, 'Tournoi', 'Cartes'),
('5', '2024-10-30', '5', '17:00:00', '20.00', '17:30:00', '21:00:00', NULL, 'Jeux', 'Rôle');

-- --------------------------------------------------------

--
-- Structure de la table `ANIMATION`
--

CREATE TABLE `ANIMATION` (
  `CODEANIM` char(8) NOT NULL,
  `CODETYPEANIM` char(5) NOT NULL,
  `NOMANIM` char(40) DEFAULT NULL,
  `DATECREATIONANIM` date DEFAULT NULL,
  `DATEVALIDITEANIM` date DEFAULT NULL,
  `DUREEANIM` double(5,0) DEFAULT NULL,
  `LIMITEAGE` int(2) DEFAULT NULL,
  `TARIFANIM` decimal(7,2) DEFAULT NULL,
  `NBREPLACEANIM` int(2) DEFAULT NULL,
  `DESCRIPTANIM` char(250) DEFAULT NULL,
  `COMMENTANIM` char(250) DEFAULT NULL,
  `DIFFICULTEANIM` char(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `ANIMATION`
--

INSERT INTO `ANIMATION` (`CODEANIM`, `CODETYPEANIM`, `NOMANIM`, `DATECREATIONANIM`, `DATEVALIDITEANIM`, `DUREEANIM`, `LIMITEAGE`, `TARIFANIM`, `NBREPLACEANIM`, `DESCRIPTANIM`, `COMMENTANIM`, `DIFFICULTEANIM`) VALUES
('1', '1', 'Tournoi de sports collectifs', '2024-10-12', '2024-10-12', 2, 19, '25.00', 20, 'Des tournois en équipe pour favoriser la compétition et l’esprit d’équipe', 'Des tournois en équipe pour favoriser la compétition et l’esprit d’équipe', 'Facile'),
('2', '2', 'Randonnées sportives', '2024-10-14', '2024-10-14', 2, 20, '12.00', 15, 'Une activité de plein air qui combine découverte et effort physique.', 'Une activité de plein air qui combine découverte et effort physique.', 'Difficile'),
('3', '3', 'Chasse au trésor', '2024-10-16', '2024-10-16', 2, 15, '7.00', 22, 'Une activité ludique qui plaît autant aux enfants qu’aux adultes.\r\n', 'Une activité ludique qui plaît autant aux enfants qu’aux adultes.\r\n', 'Moyen'),
('4', '4', 'Activités d’aventure pour adolescents', '2024-10-20', '2024-10-22', 2, 11, '5.00', 20, 'Des activités plus physiques et stimulantes pour les ados.\r\n', 'Des activités plus physiques et stimulantes pour les ados.\r\n', 'Facile'),
('5', '5', 'Soirée jeux de société', '2024-10-24', '2024-10-25', 2, 9, '4.00', 10, 'Une soirée tranquille mais conviviale.', 'Une soirée tranquille mais conviviale.', 'Facile');

-- --------------------------------------------------------

--
-- Structure de la table `COMPTE`
--

CREATE TABLE `COMPTE` (
  `USER` char(8) NOT NULL,
  `MDP` char(10) DEFAULT NULL,
  `NOMCOMPTE` char(40) DEFAULT NULL,
  `PRENOMCOMPTE` char(30) DEFAULT NULL,
  `DATEINSCRIP` date DEFAULT NULL,
  `DATEFERME` date DEFAULT NULL,
  `TYPEPROFIL` char(2) DEFAULT NULL,
  `DATEDEBSEJOUR` date DEFAULT NULL,
  `DATEFINSEJOUR` date DEFAULT NULL,
  `DATENAISCOMPTE` date DEFAULT NULL,
  `ADRMAILCOMPTE` char(70) DEFAULT NULL,
  `NOTELCOMPTE` char(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `COMPTE`
--

INSERT INTO `COMPTE` (`USER`, `MDP`, `NOMCOMPTE`, `PRENOMCOMPTE`, `DATEINSCRIP`, `DATEFERME`, `TYPEPROFIL`, `DATEDEBSEJOUR`, `DATEFINSEJOUR`, `DATENAISCOMPTE`, `ADRMAILCOMPTE`, `NOTELCOMPTE`) VALUES
('aa', 'aa', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('ej', 'elyeselyes', 'jaffel', 'elyes', '2024-09-10', NULL, 'ad', NULL, NULL, NULL, NULL, NULL),
('mh', 'azerty', 'balti', 'momo', '2024-09-10', NULL, 'en', NULL, NULL, NULL, NULL, NULL),
('om', 'azerty', 'akakba', 'omar', '2024-09-10', NULL, 'va', NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `ETAT_ACT`
--

CREATE TABLE `ETAT_ACT` (
  `CODEETATACT` char(2) NOT NULL,
  `NOMETATACT` char(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `ETAT_ACT`
--

INSERT INTO `ETAT_ACT` (`CODEETATACT`, `NOMETATACT`) VALUES
('1', 'sport'),
('2', 'Randonnées'),
('3', 'Chasse au trésor'),
('4', 'Activités d’aventure'),
('5', 'Soirée jeux de société');

-- --------------------------------------------------------

--
-- Structure de la table `INSCRIPTION`
--

CREATE TABLE `INSCRIPTION` (
  `NOINSCRIP` bigint(6) NOT NULL,
  `USER` char(8) NOT NULL,
  `CODEANIM` char(8) NOT NULL,
  `DATEACT` date NOT NULL,
  `DATEINSCRIP` date DEFAULT NULL,
  `DATEANNULE` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `INSCRIPTION`
--

INSERT INTO `INSCRIPTION` (`NOINSCRIP`, `USER`, `CODEANIM`, `DATEACT`, `DATEINSCRIP`, `DATEANNULE`) VALUES
(2, 'ej', '1', '2024-10-14', '2024-10-08', NULL),
(3, 'aa', '3', '2024-10-22', '2024-10-08', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `TYPE_ANIM`
--

CREATE TABLE `TYPE_ANIM` (
  `CODETYPEANIM` char(5) NOT NULL,
  `NOMTYPEANIM` char(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `TYPE_ANIM`
--

INSERT INTO `TYPE_ANIM` (`CODETYPEANIM`, `NOMTYPEANIM`) VALUES
('1', 'sports'),
('2', 'Randonnées'),
('3', 'Chasse au trésor'),
('4', 'Activités d’aventure pour adolescents'),
('5', 'Soirée jeux de société');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `ACTIVITE`
--
ALTER TABLE `ACTIVITE`
  ADD PRIMARY KEY (`CODEANIM`,`DATEACT`),
  ADD KEY `I_FK_ACTIVITE_ANIMATION` (`CODEANIM`),
  ADD KEY `I_FK_ACTIVITE_ETAT_ACT` (`CODEETATACT`);

--
-- Index pour la table `ANIMATION`
--
ALTER TABLE `ANIMATION`
  ADD PRIMARY KEY (`CODEANIM`),
  ADD KEY `I_FK_ANIMATION_TYPE_ANIM` (`CODETYPEANIM`);

--
-- Index pour la table `COMPTE`
--
ALTER TABLE `COMPTE`
  ADD PRIMARY KEY (`USER`);

--
-- Index pour la table `ETAT_ACT`
--
ALTER TABLE `ETAT_ACT`
  ADD PRIMARY KEY (`CODEETATACT`);

--
-- Index pour la table `INSCRIPTION`
--
ALTER TABLE `INSCRIPTION`
  ADD PRIMARY KEY (`NOINSCRIP`),
  ADD KEY `I_FK_INSCRIPTION_COMPTE` (`USER`),
  ADD KEY `I_FK_INSCRIPTION_ACTIVITE` (`CODEANIM`,`DATEACT`);

--
-- Index pour la table `TYPE_ANIM`
--
ALTER TABLE `TYPE_ANIM`
  ADD PRIMARY KEY (`CODETYPEANIM`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `INSCRIPTION`
--
ALTER TABLE `INSCRIPTION`
  MODIFY `NOINSCRIP` bigint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `ACTIVITE`
--
ALTER TABLE `ACTIVITE`
  ADD CONSTRAINT `activite_ibfk_1` FOREIGN KEY (`CODEANIM`) REFERENCES `ANIMATION` (`CODEANIM`),
  ADD CONSTRAINT `activite_ibfk_2` FOREIGN KEY (`CODEETATACT`) REFERENCES `ETAT_ACT` (`CODEETATACT`);

--
-- Contraintes pour la table `ANIMATION`
--
ALTER TABLE `ANIMATION`
  ADD CONSTRAINT `animation_ibfk_1` FOREIGN KEY (`CODETYPEANIM`) REFERENCES `TYPE_ANIM` (`CODETYPEANIM`);

--
-- Contraintes pour la table `INSCRIPTION`
--
ALTER TABLE `INSCRIPTION`
  ADD CONSTRAINT `inscription_ibfk_1` FOREIGN KEY (`USER`) REFERENCES `COMPTE` (`USER`),
  ADD CONSTRAINT `inscription_ibfk_2` FOREIGN KEY (`CODEANIM`,`DATEACT`) REFERENCES `ACTIVITE` (`CODEANIM`, `DATEACT`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
