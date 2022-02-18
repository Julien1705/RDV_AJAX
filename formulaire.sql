-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : ven. 18 fév. 2022 à 09:09
-- Version du serveur : 10.4.21-MariaDB
-- Version de PHP : 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `formulaire`
--

-- --------------------------------------------------------

--
-- Structure de la table `client`
--

CREATE TABLE `client` (
  `id_client` int(11) NOT NULL,
  `nom_client` varchar(50) NOT NULL,
  `prenom_client` varchar(50) NOT NULL,
  `email_client` varchar(50) NOT NULL,
  `dateInscription` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `client`
--

INSERT INTO `client` (`id_client`, `nom_client`, `prenom_client`, `email_client`, `dateInscription`) VALUES
(1, 'Duval', 'Julien', 'julienduval17@gmail.com', '2022-02-10'),
(2, 'Duval', 'Olivia', 'dvzv@vdzb.fr', '2022-02-10');

-- --------------------------------------------------------

--
-- Structure de la table `intervenants`
--

CREATE TABLE `intervenants` (
  `id_interv` int(11) NOT NULL,
  `prenom_interv` varchar(30) NOT NULL,
  `qualification_interv` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `intervenants`
--

INSERT INTO `intervenants` (`id_interv`, `prenom_interv`, `qualification_interv`) VALUES
(1, 'Valérie', 'Coiffeur'),
(2, 'Nadine', 'Coiffeur'),
(3, 'Emilie', 'Coiffeur'),
(4, 'Julien', 'Barbier');

-- --------------------------------------------------------

--
-- Structure de la table `rendez-vous`
--

CREATE TABLE `rendez-vous` (
  `id_rdv` int(11) NOT NULL,
  `date_rdv` date NOT NULL,
  `heure_debut_rdv` time NOT NULL,
  `heure_fin_rdv` time NOT NULL,
  `id_interv` int(11) NOT NULL,
  `id_client` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `rendez-vous`
--

INSERT INTO `rendez-vous` (`id_rdv`, `date_rdv`, `heure_debut_rdv`, `heure_fin_rdv`, `id_interv`, `id_client`) VALUES
(9, '2022-02-19', '09:00:00', '10:00:00', 1, 1),
(10, '2022-02-17', '14:00:00', '16:00:00', 4, 2),
(11, '2022-02-14', '09:00:00', '10:00:00', 1, 1),
(12, '2022-02-18', '09:00:00', '10:00:00', 4, 2),
(13, '2022-02-18', '09:00:00', '12:00:00', 4, 2);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`id_client`);

--
-- Index pour la table `intervenants`
--
ALTER TABLE `intervenants`
  ADD PRIMARY KEY (`id_interv`);

--
-- Index pour la table `rendez-vous`
--
ALTER TABLE `rendez-vous`
  ADD PRIMARY KEY (`id_rdv`),
  ADD KEY `FK_INTERV` (`id_interv`),
  ADD KEY `FK_CLIENT` (`id_client`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `client`
--
ALTER TABLE `client`
  MODIFY `id_client` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT pour la table `intervenants`
--
ALTER TABLE `intervenants`
  MODIFY `id_interv` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `rendez-vous`
--
ALTER TABLE `rendez-vous`
  MODIFY `id_rdv` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `rendez-vous`
--
ALTER TABLE `rendez-vous`
  ADD CONSTRAINT `FK_CLIENT` FOREIGN KEY (`id_client`) REFERENCES `client` (`id_client`),
  ADD CONSTRAINT `FK_INTERV` FOREIGN KEY (`id_interv`) REFERENCES `intervenants` (`id_interv`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
