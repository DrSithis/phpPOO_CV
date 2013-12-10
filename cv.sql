-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le : Mar 10 Décembre 2013 à 09:07
-- Version du serveur: 5.5.34
-- Version de PHP: 5.3.10-1ubuntu3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `cv`
--
CREATE DATABASE `cv` DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;
USE `cv`;

-- --------------------------------------------------------

--
-- Structure de la table `adresse`
--

CREATE TABLE IF NOT EXISTS `adresse` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `num` int(11) NOT NULL,
  `rue` text COLLATE utf8_bin NOT NULL,
  `cp` text COLLATE utf8_bin NOT NULL,
  `ville` text COLLATE utf8_bin NOT NULL,
  `pays` text COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

CREATE TABLE IF NOT EXISTS `categorie` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `intitule` text COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=3 ;

--
-- Contenu de la table `categorie`
--

INSERT INTO `categorie` (`id`, `intitule`) VALUES
(1, 'experience'),
(2, 'formation');

-- --------------------------------------------------------

--
-- Structure de la table `contenu`
--

CREATE TABLE IF NOT EXISTS `contenu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `intitule` text COLLATE utf8_bin NOT NULL,
  `anneedebut` text COLLATE utf8_bin NOT NULL,
  `anneefin` text COLLATE utf8_bin NOT NULL,
  `ecole` text COLLATE utf8_bin NOT NULL,
  `ville` text COLLATE utf8_bin NOT NULL,
  `personne` int(11) NOT NULL,
  `categorie` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `personne` (`personne`,`categorie`),
  KEY `categorie` (`categorie`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `personne`
--

CREATE TABLE IF NOT EXISTS `personne` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` text COLLATE utf8_bin NOT NULL,
  `prenom` text COLLATE utf8_bin NOT NULL,
  `email` text COLLATE utf8_bin NOT NULL,
  `intitulecv` text COLLATE utf8_bin NOT NULL,
  `adresse` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `adresse` (`adresse`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `contenu`
--
ALTER TABLE `contenu`
  ADD CONSTRAINT `contenu_ibfk_1` FOREIGN KEY (`personne`) REFERENCES `personne` (`id`),
  ADD CONSTRAINT `contenu_ibfk_2` FOREIGN KEY (`categorie`) REFERENCES `categorie` (`id`);

--
-- Contraintes pour la table `personne`
--
ALTER TABLE `personne`
  ADD CONSTRAINT `personne_ibfk_1` FOREIGN KEY (`adresse`) REFERENCES `adresse` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
