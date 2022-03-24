-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : jeu. 24 mars 2022 à 08:28
-- Version du serveur : 5.7.36
-- Version de PHP : 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `basegroup`
--

-- --------------------------------------------------------

--
-- Structure de la table `eleves`
--

DROP TABLE IF EXISTS `eleves`;
CREATE TABLE IF NOT EXISTS `eleves` (
  `id_Student` int(11) NOT NULL AUTO_INCREMENT,
  `nom_eleve` varchar(255) NOT NULL,
  `prenom_eleve` varchar(255) NOT NULL,
  `avatar_eleve` varchar(255) NOT NULL,
  `date_naissance_eleve` varchar(255) NOT NULL,
  `age_eleve` int(11) NOT NULL,
  `classe_eleve` varchar(255) NOT NULL,
  `absence_eleve` tinyint(1) NOT NULL,
  PRIMARY KEY (`id_Student`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `eleves`
--

INSERT INTO `eleves` (`id_Student`, `nom_eleve`, `prenom_eleve`, `avatar_eleve`, `date_naissance_eleve`, `age_eleve`, `classe_eleve`, `absence_eleve`) VALUES
(1, 'Dupont', 'Julien', '/image.jpg', '20/12/2010', 12, '6ème', 1),
(2, 'Martin', 'Céline', 'image/avatarfille.jpg', '22/03/2010', 12, '6ème', 0),
(3, 'calandri', 'valentin', 'image/avatar_valou.jpg', '19/12/1984', 12, '6ème', 0),
(4, 'arrestier', 'valentine', 'avatar_valentine.jpg', '10/09/2009', 10, '6ème', 1),
(5, 'arrestier', 'Romy', 'image/avat_romy.jpg', '20/05/09', 11, '6eme', 1),
(6, 'Martin', 'jean', 'avatar_jean.jpg', '1/01/2010', 12, '6ème', 0);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
