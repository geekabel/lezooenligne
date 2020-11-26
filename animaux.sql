-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : jeu. 26 nov. 2020 à 14:05
-- Version du serveur :  10.1.35-MariaDB
-- Version de PHP : 7.2.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `animaux`
--

-- --------------------------------------------------------

--
-- Structure de la table `administration`
--

CREATE TABLE `administration` (
  `login` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `administration`
--

INSERT INTO `administration` (`login`, `password`) VALUES
('godwin', '$2y$10$FwNCVF.zFlf/6A5pP3se8O8HyRDcvXCewXB76hMnUC0/Hvy4xaTaK');

-- --------------------------------------------------------

--
-- Structure de la table `animal`
--

CREATE TABLE `animal` (
  `animal_id` int(11) NOT NULL,
  `animal_nom` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `animal_description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `animal_image` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `famille_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `animal`
--

INSERT INTO `animal` (`animal_id`, `animal_nom`, `animal_description`, `animal_image`, `famille_id`) VALUES
(1, 'chien', 'un animal domestique tres mignon ', 'chien.png', 1),
(2, 'cochon', 'un animal de la ferme ', 'cochon.png', 1),
(3, 'serpent', 'un vrai danger de la nature', 'serpent.png', 2),
(4, 'crocodile', 'un animal tres dangereux', 'croco.png', 2),
(5, 'requin', 'un animal marin tres dangereux', 'requin.png', 3),
(11, 'poulet', 'un animal qui pond des oeufs', '78073_chicken.png', 1),
(12, 'pingouin', 'un animal qui aime le froid', '', 1),
(13, 'poulai', 'joli comme tout', '', 1),
(14, 'poulet 20', 'poulet de test ', '9279_chick.png', 1);

-- --------------------------------------------------------

--
-- Structure de la table `animal_continent`
--

CREATE TABLE `animal_continent` (
  `animal_id` int(11) NOT NULL,
  `continent_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `animal_continent`
--

INSERT INTO `animal_continent` (`animal_id`, `continent_id`) VALUES
(1, 1),
(3, 1),
(3, 3),
(3, 4),
(4, 2),
(4, 3),
(4, 4),
(5, 3),
(5, 4),
(11, 1),
(11, 3),
(11, 5),
(12, 4),
(13, 1),
(14, 1),
(14, 2),
(14, 5);

-- --------------------------------------------------------

--
-- Structure de la table `continent`
--

CREATE TABLE `continent` (
  `continent_id` int(11) NOT NULL,
  `continent_libelle` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `continent`
--

INSERT INTO `continent` (`continent_id`, `continent_libelle`) VALUES
(1, 'Europe'),
(2, 'Asie '),
(3, 'Afrique '),
(4, 'Oceanie'),
(5, 'Amerique');

-- --------------------------------------------------------

--
-- Structure de la table `famille`
--

CREATE TABLE `famille` (
  `famille_id` int(11) NOT NULL,
  `famille_libelle` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `famille_description` text COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `famille`
--

INSERT INTO `famille` (`famille_id`, `famille_libelle`, `famille_description`) VALUES
(1, 'mammifères', 'Les Mammifères forment une classe de Verté;br&eacute;s &agrave; sang chaud, &agrave; la peau couverte de poils (cependant, parmi les Mammifères, les C&eacute;tac&eacute;s n\'ont que des poils fort rares) et faisant presque toujours leurs petits vivants et dont les femelles sont pourvues de glandes sp&eacute;ciales appel&eacute;es mamelles, s&eacute;cr&eacute;tant le lait qui sert &agrave; la nourriture de ces petits. Ce dernier caract&egrave;re, qui est absolument sans exception, est celui qui a donn&eacute; son nom &agrave; la classe.'),
(2, 'Reptiles', 'Reptiles are air-breathing vertebrates covered in special skin made up of scales, bony plates, or a combination of both.\r\nThey include crocodiles, snakes, lizards, turtles, and tor- toises. All regularly shed the outer layer of their skin. Their metabolism depends on the temperature of their environment.'),
(3, 'poissons', 'This incredible predator lives a solitary life from the time it is born. The mother lays her eggs in the open water and they float along until hatching with no parental care. From then on, the fish spends most of its life alone, far from land, in the warm surface waters of the Atlantic, Pacific, and Indian Oceans. They can swim long distances and will follow warm ocean currents for hundreds and even thousands of miles.'),
(20, 'souris', 'la souris du sol\r\n');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `administration`
--
ALTER TABLE `administration`
  ADD PRIMARY KEY (`login`);

--
-- Index pour la table `animal`
--
ALTER TABLE `animal`
  ADD PRIMARY KEY (`animal_id`),
  ADD KEY `FK_ANIMAL_FAMILLE` (`famille_id`);

--
-- Index pour la table `animal_continent`
--
ALTER TABLE `animal_continent`
  ADD PRIMARY KEY (`animal_id`,`continent_id`),
  ADD KEY `FK_CONTINENT_ANIMAL_CONTINENT` (`continent_id`);

--
-- Index pour la table `continent`
--
ALTER TABLE `continent`
  ADD PRIMARY KEY (`continent_id`);

--
-- Index pour la table `famille`
--
ALTER TABLE `famille`
  ADD PRIMARY KEY (`famille_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `animal`
--
ALTER TABLE `animal`
  MODIFY `animal_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT pour la table `continent`
--
ALTER TABLE `continent`
  MODIFY `continent_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `famille`
--
ALTER TABLE `famille`
  MODIFY `famille_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `animal`
--
ALTER TABLE `animal`
  ADD CONSTRAINT `FK_ANIMAL_FAMILLE` FOREIGN KEY (`famille_id`) REFERENCES `famille` (`famille_id`);

--
-- Contraintes pour la table `animal_continent`
--
ALTER TABLE `animal_continent`
  ADD CONSTRAINT `FK_ANIMAL_CONTINENT` FOREIGN KEY (`animal_id`) REFERENCES `animal` (`animal_id`),
  ADD CONSTRAINT `FK_CONTINENT_ANIMAL_CONTINENT` FOREIGN KEY (`continent_id`) REFERENCES `continent` (`continent_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
