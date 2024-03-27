-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte :
-- Généré le : mer. 27 mars 2024 à 16:54
-- Version du serveur : 8.2.0
-- Version de PHP : 8.2.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `projetfullstackv2`
--

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `description` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`id`, `name`, `image`, `description`) VALUES
(1, 'Burger', 'burgerclassique.webp', 'Savoure l\'instant, dévore l\'exquis : chaque bouchée, un festin divin à déguster!'),
(2, 'Pizza', 'pizza.webp', 'Délices d\'Italie dans chaque part, une symphonie de saveurs à chaque bouchée!');

-- --------------------------------------------------------

--
-- Structure de la table `produits`
--

DROP TABLE IF EXISTS `produits`;
CREATE TABLE IF NOT EXISTS `produits` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `prix` int NOT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `description` varchar(255) NOT NULL,
  `quantité` int NOT NULL,
  `category_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `produits_categories_id_foreign` (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `produits`
--

INSERT INTO `produits` (`id`, `name`, `prix`, `image`, `description`, `quantité`, `category_id`) VALUES
(1, 'Burger Classique', 4, 'burgerclassique.webp', 'Le Burger Classique : steak grillé, fromage fondant, légumes frais dans un pain moelleux, délicieusement assemblé.', 1, 1),
(2, 'Burger Raclette', 7, 'burgerraclette.webp', 'Burger raclette gourmand, alliance parfaite de fromage fondant et de viande grillée dans un pain moelleux.', 1, 1),
(3, 'Burger Vege', 9, 'burgervege.webp', 'Burger végétarien délicieusement fondant, alliant fromage raclette végétalien et galette végé dans un pain moelleux.', 1, 1),
(4, 'Pizza Marguarita', 5, 'pizza.webp', 'Pizza Margherita authentique, avec une base de sauce tomate savoureuse, mozzarella fondante et touches de basilic frais.', 1, 2),
(5, 'Pizza Saumon', 8, 'pizzasaumon.webp', 'Pizza Saumon délicate : crème citronnée, saumon fumé, câpres et oignons rouges sur une croûte croustillante.', 1, 2),
(6, 'Pizza Raclette', 10, 'pizzaraclette.webp', 'Pizza Raclette irrésistible : une base crémeuse de fromage raclette fondant, des pommes de terre savoureuses.', 1, 2);

-- --------------------------------------------------------

--
-- Structure de la table `sales`
--

DROP TABLE IF EXISTS `sales`;
CREATE TABLE IF NOT EXISTS `sales` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name_product` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `prix` int NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `sales`
--

INSERT INTO `sales` (`id`, `name_product`, `prix`, `date`) VALUES
(10, 'Pizza Raclette', 10, '2024-01-30 09:10:50'),
(11, 'Pizza Marguarita', 5, '2024-01-30 15:54:20'),
(12, 'Pizza Saumon', 8, '2024-01-30 15:54:20'),
(13, 'Pizza Marguarita', 5, '2024-03-11 09:32:59'),
(15, 'Pizza Raclette', 10, '2024-03-22 14:40:19'),
(19, 'Burger Classique', 4, '2024-03-26 05:37:13'),
(20, 'Burger Raclette', 7, '2024-03-26 05:37:13');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `mail` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `name`, `mail`, `password`, `role`) VALUES
(1, 'Dylan', 'a@a.com', '$2y$10$DxIXmOtBxlZfpOcFvR7Vd.KP2eXUZBG6MYlwHzYHE5JvyvxMf5742', 'customer'),
(9, 'Admin', 'admin@admin.com', '$2y$10$JzYHDSrsZ8byZP5mpoDQE.pTd7NHDJ7.2Fpp4Guy7QH2G3h/eRRj2', 'admin');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `produits`
--
ALTER TABLE `produits`
  ADD CONSTRAINT `produits_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
