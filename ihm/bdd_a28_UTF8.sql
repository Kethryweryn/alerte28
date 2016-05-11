-- phpMyAdmin SQL Dump
-- version 4.4.13.1
-- http://www.phpmyadmin.net
--
-- Client :  mysql51-96.perso
-- Généré le :  Lun 28 Mars 2016 à 10:05
-- Version du serveur :  5.5.46-0+deb7u1-log
-- Version de PHP :  5.3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `tragosfm`
--

-- --------------------------------------------------------

--
-- Structure de la table `a28_action`
--

CREATE TABLE IF NOT EXISTS `a28_action` (
  `id` int(11) NOT NULL,
  `service_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `a28_actionTask`
--

CREATE TABLE IF NOT EXISTS `a28_actionTask` (
  `id` int(11) NOT NULL,
  `action_id` int(11) DEFAULT NULL,
  `task_id` int(11) DEFAULT NULL,
  `impact` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `a28_service`
--

CREATE TABLE IF NOT EXISTS `a28_service` (
  `id` int(10) unsigned NOT NULL,
  `nom` varchar(256) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `a28_service`
--

INSERT INTO `a28_service` (`id`, `nom`) VALUES
(1, 'PÃ´le SÃ©curitÃ©'),
(2, 'Direction scientifique'),
(3, 'Direction des stratÃ©gies de communication'),
(4, 'Direction des Ressources Humaines et FinanciÃ¨res'),
(5, 'Direction des SystÃ¨mes d''Information');

-- --------------------------------------------------------

--
-- Structure de la table `a28_task`
--

CREATE TABLE IF NOT EXISTS `a28_task` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `duration` int(11) NOT NULL,
  `predecessor` int(11) NOT NULL,
  `successor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `a28_user`
--

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
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `a28_user`
--

INSERT INTO `a28_user` (`id`, `nom`, `prenom`, `log`, `pass`, `actif`, `service_id`, `leader`, `admin`) VALUES
(1, 'Meurin', 'Frédéric', 'SuperAdmin', '$1$53.nr/x4$TxGvXq2lfzdPAssf9WOnX0', '1', 1, '1', '1');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `a28_action`
--
ALTER TABLE `a28_action`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_406089A4ED5CA9E6` (`service_id`);

--
-- Index pour la table `a28_actionTask`
--
ALTER TABLE `a28_actionTask`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_CD80F0719D32F035` (`action_id`),
  ADD KEY `IDX_CD80F0718DB60186` (`task_id`);

--
-- Index pour la table `a28_service`
--
ALTER TABLE `a28_service`
  ADD UNIQUE KEY `id_dir` (`id`);

--
-- Index pour la table `a28_task`
--
ALTER TABLE `a28_task`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT pour la table `a28_action`
--
ALTER TABLE `a28_action`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `a28_actionTask`
--
ALTER TABLE `a28_actionTask`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `a28_service`
--
ALTER TABLE `a28_service`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT pour la table `a28_task`
--
ALTER TABLE `a28_task`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `a28_user`
--
ALTER TABLE `a28_user`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
