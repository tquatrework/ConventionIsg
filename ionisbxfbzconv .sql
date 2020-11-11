-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le :  mar. 08 sep. 2020 à 16:57
-- Version du serveur :  10.3.21-MariaDB
-- Version de PHP :  7.2.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `ionisbxfbzconv`
--

-- --------------------------------------------------------

--
-- Structure de la table `entreprise`
--

CREATE TABLE `entreprise` (
  `id_entreprise` int(11) NOT NULL,
  `nom_entreprise` varchar(50) NOT NULL,
  `adresse_entreprise` varchar(50) NOT NULL,
  `ville_entreprise` varchar(50) NOT NULL,
  `telephone_entreprise` varchar(11) DEFAULT NULL,
  `mail_entreprise` varchar(50) NOT NULL,
  `secteur_activite_entreprise` varchar(50) DEFAULT NULL,
  `nom_representant_entreprise` varchar(50) DEFAULT NULL,
  `prenom_representant_entreprise` varchar(255) DEFAULT NULL,
  `fonction_representant_entreprise` varchar(50) DEFAULT NULL,
  `fk_utilisateur_entreprise` int(10) NOT NULL,
  `numero_rue_entreprise` varchar(10) NOT NULL,
  `code_postal_entreprise` varchar(50) NOT NULL,
  `complement_adresse_entreprise` varchar(50) NOT NULL,
  `statut` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `etablissement`
--

CREATE TABLE `etablissement` (
  `id_etablissement` int(11) NOT NULL,
  `nom_etablissement` varchar(50) NOT NULL,
  `numero_rue_etablissement` varchar(10) NOT NULL,
  `adresse_etablissement` varchar(50) NOT NULL,
  `complement_adresse_etablissement` varchar(50) NOT NULL,
  `code_postal_etablissement` varchar(50) NOT NULL,
  `ville_etablissement` varchar(50) DEFAULT NULL,
  `mail_etablissement` varchar(50) DEFAULT NULL,
  `telephone_etablissement` varchar(50) DEFAULT NULL,
  `nom_representant_etablissement` varchar(50) DEFAULT NULL,
  `prenom_representant_etablissement` varchar(50) DEFAULT NULL,
  `fonction_representant_etablissement` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `etablissement`
--

INSERT INTO `etablissement` (`id_etablissement`, `nom_etablissement`, `numero_rue_etablissement`, `adresse_etablissement`, `complement_adresse_etablissement`, `code_postal_etablissement`, `ville_etablissement`, `mail_etablissement`, `telephone_etablissement`, `nom_representant_etablissement`, `prenom_representant_etablissement`, `fonction_representant_etablissement`) VALUES
(2, 'ISEG LYON', '2', 'Rue du Professeur Charles Appleton', '', '69007', 'LYON', 'pierre-henri.dubois@iseg.fr', '04 78 62 37 37', 'Pierre-Henri Dubois', NULL, 'Directeur');

-- --------------------------------------------------------

--
-- Structure de la table `password_reset`
--

CREATE TABLE `password_reset` (
  `id_password_reset` int(10) NOT NULL,
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `expire` datetime(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `password_reset`
--

INSERT INTO `password_reset` (`id_password_reset`, `email`, `token`, `expire`) VALUES
(58, 'buivangiang@me.com', 'b77a1930d8867823cc59213c1c8ee3e7d0ef7da7db5e89bd552acedff777eeacd6df1b8adb3db2540ce3310ac135059c9be0', '2020-03-27 20:44:14.000000');

-- --------------------------------------------------------

--
-- Structure de la table `referent`
--

CREATE TABLE `referent` (
  `id_referent` int(11) NOT NULL,
  `nom_referent` varchar(50) NOT NULL,
  `prenom_referent` varchar(50) NOT NULL,
  `fonction_referent` varchar(50) NOT NULL,
  `telephone_referent` varchar(50) NOT NULL,
  `mail_referent` varchar(50) NOT NULL,
  `fk_enseignement_referent` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `stage`
--

CREATE TABLE `stage` (
  `id_stage` int(11) NOT NULL,
  `annee_universitaire` text NOT NULL,
  `date_debut` varchar(20) DEFAULT NULL,
  `date_fin` varchar(20) DEFAULT NULL,
  `duree_totale` varchar(20) DEFAULT NULL,
  `duree_totale_par` varchar(50) DEFAULT NULL,
  `temps_complet` varchar(20) DEFAULT NULL,
  `heure_partiel` varchar(20) DEFAULT NULL,
  `obligatoire` varchar(20) DEFAULT NULL,
  `lundi` varchar(20) DEFAULT NULL,
  `mardi` varchar(10) DEFAULT NULL,
  `mercredi` varchar(10) DEFAULT NULL,
  `jeudi` varchar(10) DEFAULT NULL,
  `vendredi` varchar(10) DEFAULT NULL,
  `samedi` varchar(10) DEFAULT NULL,
  `cas_particulier` text DEFAULT NULL,
  `gratification` varchar(20) DEFAULT NULL,
  `gratification_par` varchar(20) DEFAULT NULL,
  `activites_missions` text DEFAULT NULL,
  `cas_particulier_booleen` varchar(50) DEFAULT NULL,
  `modalite_conge` varchar(255) DEFAULT NULL,
  `modalite_conge_booleen` varchar(50) DEFAULT NULL,
  `conditions_remboursement` text DEFAULT NULL,
  `droit_avantage` varchar(255) DEFAULT NULL,
  `competences_developper` text DEFAULT NULL,
  `fk_utilisateur_stage` int(10) DEFAULT NULL,
  `fk_tuteur_stage` int(10) DEFAULT NULL,
  `fk_referent_stage` int(50) DEFAULT NULL,
  `statut` varchar(50) DEFAULT NULL,
  `lieu_bis_bool` varchar(50) DEFAULT NULL,
  `lieu_bis_entreprise` varchar(50) DEFAULT NULL,
  `fermeture_entreprise` varchar(50) DEFAULT NULL,
  `date_debut_fermeture_entreprise` varchar(50) DEFAULT NULL,
  `date_fin_fermeture_entreprise` varchar(50) DEFAULT NULL,
  `services_entreprise` varchar(255) DEFAULT NULL,
  `teletravail` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `stagiaire`
--

CREATE TABLE `stagiaire` (
  `id_stagiaire` int(11) NOT NULL,
  `nom_stagiaire` varchar(20) DEFAULT NULL,
  `prenom_stagiaire` varchar(20) DEFAULT NULL,
  `adresse_stagiaire` char(100) DEFAULT NULL,
  `date_naissance_stagiaire` varchar(50) DEFAULT NULL,
  `ville_stagiaire` varchar(50) DEFAULT NULL,
  `telephone_stagiaire` varchar(15) DEFAULT NULL,
  `nationalite` varchar(50) DEFAULT NULL,
  `mail_stagiaire` varchar(50) DEFAULT NULL,
  `classe` varchar(50) DEFAULT NULL,
  `numero_securite_social` varchar(17) DEFAULT NULL,
  `adresse_caisse_assurance` varchar(50) DEFAULT NULL,
  `ville_secu` varchar(50) DEFAULT NULL,
  `numero_rue_stagiaire` varchar(10) DEFAULT NULL,
  `code_postal_stagiaire` varchar(11) DEFAULT NULL,
  `complement_adresse_stagiaire` varchar(50) DEFAULT NULL,
  `numero_rue_assurance` varchar(255) DEFAULT NULL,
  `adresse_assurance` varchar(255) DEFAULT NULL,
  `complement_adresse_assurance` varchar(255) DEFAULT NULL,
  `code_postal_assurance` varchar(255) DEFAULT NULL,
  `ville_assurance` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `tuteur`
--

CREATE TABLE `tuteur` (
  `id_tuteur` int(11) NOT NULL,
  `nom_tuteur` varchar(50) NOT NULL,
  `prenom_tuteur` varchar(50) NOT NULL,
  `fonction_tuteur` varchar(50) NOT NULL,
  `telephone_tuteur` varchar(20) NOT NULL,
  `mail_tuteur` varchar(50) NOT NULL,
  `fk_entreprise` int(10) NOT NULL,
  `fk_utilisateur_tuteur` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `id` int(10) NOT NULL,
  `identifiant` varchar(50) NOT NULL,
  `password` char(100) NOT NULL,
  `compteur` int(10) DEFAULT 0,
  `profile` varchar(50) NOT NULL DEFAULT 'etudiant',
  `rgpd` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`id`, `identifiant`, `password`, `compteur`, `profile`, `rgpd`) VALUES
(1, 'buivangiang@me.com', '$2y$10$Q3X3zPsgwLpUc/V/Fc.kROoDUH2dDOkkDHUDLjCYLbUD.0iIJI79S', 1, 'administrateur', NULL),
(3, 'thierry.quatre@isg.fr', '$2y$10$6DqXTCgo36A9s3HKfEhE6.Cs45SOs461amquNEAc.4Mr/PhTgD2Fq', 3, 'administrateur', NULL),
(8, 'beatrice.vendeaud@iseg.fr', '$2y$10$mpVpny5yQH0bqcdO6LCjUeb/iyxrWj47fby.8ydFVa3yYT4UmmdP2', 2, 'administrateur', NULL),
(47, 'fanny.grizard@iseg.fr', '$2y$10$6DqXTCgo36A9s3HKfEhE6.Cs45SOs461amquNEAc.4Mr/PhTgD2Fq', 3, 'administrateur', NULL),
(48, 'nasr-eddine.berra@iseg.fr', '$2y$10$6DqXTCgo36A9s3HKfEhE6.Cs45SOs461amquNEAc.4Mr/PhTgD2Fq', 3, 'administrateur', NULL);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `entreprise`
--
ALTER TABLE `entreprise`
  ADD PRIMARY KEY (`id_entreprise`),
  ADD KEY `id_utilisateur` (`fk_utilisateur_entreprise`) USING BTREE;

--
-- Index pour la table `etablissement`
--
ALTER TABLE `etablissement`
  ADD PRIMARY KEY (`id_etablissement`);

--
-- Index pour la table `password_reset`
--
ALTER TABLE `password_reset`
  ADD PRIMARY KEY (`id_password_reset`),
  ADD UNIQUE KEY `token` (`token`);

--
-- Index pour la table `referent`
--
ALTER TABLE `referent`
  ADD PRIMARY KEY (`id_referent`),
  ADD KEY `fk_enseignement` (`fk_enseignement_referent`);

--
-- Index pour la table `stage`
--
ALTER TABLE `stage`
  ADD PRIMARY KEY (`id_stage`),
  ADD KEY `id_utilisateur` (`fk_utilisateur_stage`) USING BTREE,
  ADD KEY `fk_tuteur` (`fk_tuteur_stage`),
  ADD KEY `fk_referent` (`fk_referent_stage`);

--
-- Index pour la table `stagiaire`
--
ALTER TABLE `stagiaire`
  ADD PRIMARY KEY (`id_stagiaire`);

--
-- Index pour la table `tuteur`
--
ALTER TABLE `tuteur`
  ADD PRIMARY KEY (`id_tuteur`),
  ADD KEY `id_entreprise` (`fk_entreprise`),
  ADD KEY `id_utilisateur` (`fk_utilisateur_tuteur`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `identifiant` (`identifiant`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `entreprise`
--
ALTER TABLE `entreprise`
  MODIFY `id_entreprise` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT pour la table `etablissement`
--
ALTER TABLE `etablissement`
  MODIFY `id_etablissement` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `password_reset`
--
ALTER TABLE `password_reset`
  MODIFY `id_password_reset` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT pour la table `referent`
--
ALTER TABLE `referent`
  MODIFY `id_referent` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `stage`
--
ALTER TABLE `stage`
  MODIFY `id_stage` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT pour la table `tuteur`
--
ALTER TABLE `tuteur`
  MODIFY `id_tuteur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `entreprise`
--
ALTER TABLE `entreprise`
  ADD CONSTRAINT `entreprise_ibfk_1` FOREIGN KEY (`fk_utilisateur_entreprise`) REFERENCES `utilisateur` (`id`);

--
-- Contraintes pour la table `referent`
--
ALTER TABLE `referent`
  ADD CONSTRAINT `fk_enseignement` FOREIGN KEY (`fk_enseignement_referent`) REFERENCES `etablissement` (`id_etablissement`) ON DELETE CASCADE;

--
-- Contraintes pour la table `stage`
--
ALTER TABLE `stage`
  ADD CONSTRAINT `fk_referent` FOREIGN KEY (`fk_referent_stage`) REFERENCES `referent` (`id_referent`) ON DELETE CASCADE,
  ADD CONSTRAINT `stage_ibfk_2` FOREIGN KEY (`fk_utilisateur_stage`) REFERENCES `utilisateur` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `stage_ibfk_3` FOREIGN KEY (`fk_tuteur_stage`) REFERENCES `tuteur` (`id_tuteur`) ON DELETE CASCADE;

--
-- Contraintes pour la table `stagiaire`
--
ALTER TABLE `stagiaire`
  ADD CONSTRAINT `stagiaire_ibfk_1` FOREIGN KEY (`id_stagiaire`) REFERENCES `utilisateur` (`id`);

--
-- Contraintes pour la table `tuteur`
--
ALTER TABLE `tuteur`
  ADD CONSTRAINT `tuteur_ibfk_1` FOREIGN KEY (`fk_entreprise`) REFERENCES `entreprise` (`id_entreprise`) ON DELETE CASCADE,
  ADD CONSTRAINT `tuteur_ibfk_2` FOREIGN KEY (`fk_utilisateur_tuteur`) REFERENCES `utilisateur` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
