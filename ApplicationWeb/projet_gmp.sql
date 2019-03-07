-- phpMyAdmin SQL Dump
-- version 4.6.6deb4
-- https://www.phpmyadmin.net/
--
-- Client :  localhost:3306
-- Généré le :  Jeu 07 Mars 2019 à 14:55
-- Version du serveur :  10.1.37-MariaDB-0+deb9u1
-- Version de PHP :  7.0.30-0+deb9u1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `projet_gmp`
--

-- --------------------------------------------------------

--
-- Structure de la table `attribue`
--

CREATE TABLE `attribue` (
  `idUtilisateur` int(11) NOT NULL,
  `idSujet` int(11) NOT NULL,
  `dateAttribution` date NOT NULL,
  `dateLimite` date NOT NULL,
  `cooldown` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `donnee_calculee`
--

CREATE TABLE `donnee_calculee` (
  `idType` int(11) NOT NULL,
  `nomFormule` varchar(100) NOT NULL,
  `tableauIdParams` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `donnee_variable`
--

CREATE TABLE `donnee_variable` (
  `idDonneeVariable` int(11) NOT NULL,
  `idType` int(11) NOT NULL,
  `valeur` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `enonce`
--

CREATE TABLE `enonce` (
  `idEnonce` int(11) NOT NULL,
  `nomEnonce` varchar(100) NOT NULL,
  `enonce` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `note`
--

CREATE TABLE `note` (
  `idUtilisateur` int(11) NOT NULL,
  `idSujet` int(11) NOT NULL,
  `numNote` tinyint(4) NOT NULL,
  `note` float NOT NULL,
  `dateReponse` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `questions`
--

CREATE TABLE `questions` (
  `idQuestion` int(11) NOT NULL,
  `idEnonce` int(11) NOT NULL,
  `libelle` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `reponses`
--

CREATE TABLE `reponses` (
  `idReponse` int(11) NOT NULL,
  `idUtilisateur` int(11) DEFAULT NULL,
  `idSujet` int(11) DEFAULT NULL,
  `idQuestion` int(11) DEFAULT NULL,
  `valeur` varchar(200) DEFAULT NULL,
  `dateReponse` date DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `solutions`
--

CREATE TABLE `solutions` (
  `idQuestion` int(11) NOT NULL,
  `nomFormule` varchar(100) NOT NULL,
  `tableauIdParams` varchar(100) NOT NULL,
  `bareme` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `sujet`
--

CREATE TABLE `sujet` (
  `idSujet` int(11) NOT NULL,
  `idEnonce` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `sujet_possible`
--

CREATE TABLE `sujet_possible` (
  `idPossibilite` int(11) NOT NULL,
  `idSujet` int(11) NOT NULL,
  `idDonneeVariable` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `type_donnee`
--

CREATE TABLE `type_donnee` (
  `idType` int(11) NOT NULL,
  `libelle` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `idUtilisateur` int(11) NOT NULL,
  `estProf` tinyint(1) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `prenom` varchar(100) NOT NULL,
  `nomUtilisateur` varchar(100) NOT NULL,
  `motDePasse` varchar(100) NOT NULL,
  `annee` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Index pour les tables exportées
--

--
-- Index pour la table `attribue`
--
ALTER TABLE `attribue`
  ADD PRIMARY KEY (`idUtilisateur`,`idSujet`,`dateAttribution`),
  ADD KEY `FK_IDENONCE_ATTRIBUE` (`idSujet`) USING BTREE;

--
-- Index pour la table `donnee_calculee`
--
ALTER TABLE `donnee_calculee`
  ADD PRIMARY KEY (`idType`,`nomFormule`);

--
-- Index pour la table `donnee_variable`
--
ALTER TABLE `donnee_variable`
  ADD PRIMARY KEY (`idDonneeVariable`),
  ADD KEY `FK_IDTYPE_DONNEES_VARIABLE` (`idType`);

--
-- Index pour la table `enonce`
--
ALTER TABLE `enonce`
  ADD PRIMARY KEY (`idEnonce`);

--
-- Index pour la table `note`
--
ALTER TABLE `note`
  ADD PRIMARY KEY (`idUtilisateur`,`idSujet`,`numNote`),
  ADD KEY `FK_IDSUJET_NOTE` (`idSujet`);

--
-- Index pour la table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`idQuestion`),
  ADD KEY `FK_IDENONCE_QUESTION` (`idEnonce`);

--
-- Index pour la table `reponses`
--
ALTER TABLE `reponses`
  ADD PRIMARY KEY (`idReponse`),
  ADD KEY `FK_IDQUESTION_REPONSES` (`idQuestion`),
  ADD KEY `FK_IDSUJET_REPONSE` (`idSujet`),
  ADD KEY `FK_IDUSER_REPONSE` (`idUtilisateur`);

--
-- Index pour la table `solutions`
--
ALTER TABLE `solutions`
  ADD PRIMARY KEY (`idQuestion`);

--
-- Index pour la table `sujet`
--
ALTER TABLE `sujet`
  ADD PRIMARY KEY (`idSujet`),
  ADD KEY `FK_IDENONCE_SUJET` (`idEnonce`);

--
-- Index pour la table `sujet_possible`
--
ALTER TABLE `sujet_possible`
  ADD PRIMARY KEY (`idPossibilite`),
  ADD KEY `FK_IDDONEEVARIABLE_SUJETPOSSIBLE` (`idDonneeVariable`);

--
-- Index pour la table `type_donnee`
--
ALTER TABLE `type_donnee`
  ADD PRIMARY KEY (`idType`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`idUtilisateur`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `donnee_variable`
--
ALTER TABLE `donnee_variable`
  MODIFY `idDonneeVariable` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT pour la table `enonce`
--
ALTER TABLE `enonce`
  MODIFY `idEnonce` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `questions`
--
ALTER TABLE `questions`
  MODIFY `idQuestion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT pour la table `reponses`
--
ALTER TABLE `reponses`
  MODIFY `idReponse` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `sujet_possible`
--
ALTER TABLE `sujet_possible`
  MODIFY `idPossibilite` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;
--
-- AUTO_INCREMENT pour la table `type_donnee`
--
ALTER TABLE `type_donnee`
  MODIFY `idType` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `idUtilisateur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `attribue`
--
ALTER TABLE `attribue`
  ADD CONSTRAINT `FK_IDENONCE_ATTRIBUE` FOREIGN KEY (`idSujet`) REFERENCES `sujet` (`idSujet`),
  ADD CONSTRAINT `FK_USER_ATTRIBUE` FOREIGN KEY (`idUtilisateur`) REFERENCES `utilisateur` (`idUtilisateur`);

--
-- Contraintes pour la table `donnee_calculee`
--
ALTER TABLE `donnee_calculee`
  ADD CONSTRAINT `FK_IDTYPE_DONNEE_CALCULEE` FOREIGN KEY (`idType`) REFERENCES `type_donnee` (`idType`);

--
-- Contraintes pour la table `donnee_variable`
--
ALTER TABLE `donnee_variable`
  ADD CONSTRAINT `FK_IDTYPE_DONNEES_VARIABLE` FOREIGN KEY (`idType`) REFERENCES `type_donnee` (`idType`);

--
-- Contraintes pour la table `note`
--
ALTER TABLE `note`
  ADD CONSTRAINT `FK_IDSUJET_NOTE` FOREIGN KEY (`idSujet`) REFERENCES `sujet` (`idSujet`),
  ADD CONSTRAINT `FK_IDUTILISATEUR_NOTE` FOREIGN KEY (`idUtilisateur`) REFERENCES `utilisateur` (`idUtilisateur`);

--
-- Contraintes pour la table `questions`
--
ALTER TABLE `questions`
  ADD CONSTRAINT `FK_IDENONCE_QUESTION` FOREIGN KEY (`idEnonce`) REFERENCES `enonce` (`idEnonce`);

--
-- Contraintes pour la table `solutions`
--
ALTER TABLE `solutions`
  ADD CONSTRAINT `FK_IDQUESTION_SOLUTION` FOREIGN KEY (`idQuestion`) REFERENCES `questions` (`idQuestion`);

--
-- Contraintes pour la table `sujet`
--
ALTER TABLE `sujet`
  ADD CONSTRAINT `FK_IDENONCE_SUJET` FOREIGN KEY (`idEnonce`) REFERENCES `enonce` (`idEnonce`);

--
-- Contraintes pour la table `sujet_possible`
--
ALTER TABLE `sujet_possible`
  ADD CONSTRAINT `FK_IDDONEEVARIABLE_SUJETPOSSIBLE` FOREIGN KEY (`idDonneeVariable`) REFERENCES `donnee_variable` (`idDonneeVariable`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
