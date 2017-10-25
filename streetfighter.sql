-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Mer 25 Octobre 2017 à 11:53
-- Version du serveur :  10.1.19-MariaDB
-- Version de PHP :  7.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `streetfighter`
--

-- --------------------------------------------------------

--
-- Structure de la table `persos`
--

CREATE TABLE `persos` (
  `id` int(11) NOT NULL,
  `nom` varchar(32) NOT NULL,
  `type` int(11) NOT NULL,
  `degats` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `persos`
--

INSERT INTO `persos` (`id`, `nom`, `type`, `degats`) VALUES
(1, 'Bob', 4, 10),
(3, 'hola', 2, 3),
(4, 'Jojo', 0, 0),
(10, 'La Main', 3, 0),
(12, 'Bob', 1, 0),
(13, 'ko', 0, 0);

--
-- Index pour les tables exportées
--

--
-- Index pour la table `persos`
--
ALTER TABLE `persos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `persos`
--
ALTER TABLE `persos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
