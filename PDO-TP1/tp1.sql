-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : jeu. 03 sep. 2020 à 14:28
-- Version du serveur :  5.7.26
-- Version de PHP : 7.3.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `tp1`
--

-- --------------------------------------------------------

--
-- Structure de la table `services`
--

DROP TABLE IF EXISTS `services`;
CREATE TABLE IF NOT EXISTS `services` (
  `services_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `description` varchar(100) NOT NULL,
  PRIMARY KEY (`services_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `services`
--

INSERT INTO `services` (`services_id`, `name`, `description`) VALUES
(1, 'Maintenance', 'Les spécialistes du hardware'),
(2, 'Web Developer', 'Pour eux, tout est code'),
(3, 'Web Designer', 'Y\'a que le CSS dans la vie'),
(4, 'Référenceur', 'Regarde les Serps Google du matin au soir et du soir au matin');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `users_id` int(11) NOT NULL AUTO_INCREMENT,
  `lastname` varchar(50) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `birthdate` date NOT NULL,
  `address` text NOT NULL,
  `zipcode` int(5) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `services_id` int(11) NOT NULL,
  PRIMARY KEY (`users_id`),
  KEY `FK_service_id` (`services_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`users_id`, `lastname`, `firstname`, `birthdate`, `address`, `zipcode`, `phone`, `services_id`) VALUES
(1, 'Warnier', 'Pierre-Baptiste', '1998-02-22', 'Une certaine adresse - Amiens', 80090, '0623359407', 4),
(3, 'Fontaine', 'Brian', '1998-02-19', 'Une certaine adresse - Abbeville', 80100, '0756984225', 2);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `FK_service_id` FOREIGN KEY (`services_id`) REFERENCES `services` (`services_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
