-- phpMyAdmin SQL Dump
-- version 4.4.13.1
-- http://www.phpmyadmin.net
--
-- Client :  mysql51-96.perso
-- Généré le :  Mer 11 Mai 2016 à 22:57
-- Version du serveur :  5.5.46-0+deb7u1-log
-- Version de PHP :  5.4.45-0+deb7u2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `tragosfm`
--

-- --------------------------------------------------------

--
-- Structure de la table `a28_user`
--

DROP TABLE IF EXISTS `a28_user`;
CREATE TABLE IF NOT EXISTS `a28_user` (
  `id` int(10) unsigned NOT NULL,
  `nom` varchar(256) NOT NULL,
  `prenom` varchar(256) NOT NULL,
  `log` varchar(256) NOT NULL,
  `pass` varchar(256) NOT NULL,
  `actif` enum('0','1') NOT NULL,
  `service_id` int(10) unsigned NOT NULL,
  `leader` enum('0','1') NOT NULL,
  `admin` enum('0','1') NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `a28_user`
--

INSERT INTO `a28_user` (`id`, `nom`, `prenom`, `log`, `pass`, `actif`, `service_id`, `leader`, `admin`) VALUES
(1, 'Meurin', 'Frédéric', 'SuperAdmin', '$1$z.0kQmzC$oRz9BxDZx5NVKk0.HcpYH1', '1', 1, '1', '1');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `a28_user`
--
ALTER TABLE `a28_user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `a28_user`
--
ALTER TABLE `a28_user`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
