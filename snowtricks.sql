-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  sam. 20 nov. 2021 à 09:54
-- Version du serveur :  8.0.18
-- Version de PHP :  7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `snowtricks`
--

-- --------------------------------------------------------

--
-- Structure de la table `doctrine_migration_versions`
--

DROP TABLE IF EXISTS `doctrine_migration_versions`;
CREATE TABLE IF NOT EXISTS `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20210910123832', '2021-09-10 12:39:05', 509),
('DoctrineMigrations\\Version20210910124557', '2021-09-10 12:46:24', 1302),
('DoctrineMigrations\\Version20210910132457', '2021-09-10 13:25:46', 1341),
('DoctrineMigrations\\Version20210930092329', '2021-09-30 09:24:00', 3487),
('DoctrineMigrations\\Version20210930092647', '2021-09-30 09:26:55', 1152),
('DoctrineMigrations\\Version20210930123824', '2021-09-30 12:38:28', 4157),
('DoctrineMigrations\\Version20210930152949', '2021-09-30 15:29:55', 1486),
('DoctrineMigrations\\Version20211025130851', '2021-10-25 13:09:13', 2396),
('DoctrineMigrations\\Version20211025141434', '2021-10-25 14:14:53', 484),
('DoctrineMigrations\\Version20211025142135', '2021-10-25 14:21:42', 1821),
('DoctrineMigrations\\Version20211026080817', '2021-10-26 08:08:37', 1100),
('DoctrineMigrations\\Version20211026081125', '2021-10-26 08:11:36', 298),
('DoctrineMigrations\\Version20211026084843', '2021-10-26 08:49:08', 257),
('DoctrineMigrations\\Version20211026085247', '2021-10-26 08:52:55', 1400),
('DoctrineMigrations\\Version20211028143225', '2021-10-28 14:32:39', 2550),
('DoctrineMigrations\\Version20211029065828', '2021-10-29 06:58:36', 7398),
('DoctrineMigrations\\Version20211120085157', '2021-11-20 08:52:18', 2828);

-- --------------------------------------------------------

--
-- Structure de la table `media`
--

DROP TABLE IF EXISTS `media`;
CREATE TABLE IF NOT EXISTS `media` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `snowtrick_id_id` int(11) NOT NULL,
  `lien` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type_media` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_6A2CA10C2109218F` (`snowtrick_id_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `message`
--

DROP TABLE IF EXISTS `message`;
CREATE TABLE IF NOT EXISTS `message` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `message` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `snowtricks_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_B6BD307FA76ED395` (`user_id`),
  KEY `IDX_B6BD307FC38C303B` (`snowtricks_id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `message`
--

INSERT INTO `message` (`id`, `message`, `created_at`, `user_id`, `snowtricks_id`) VALUES
(5, 'salut moi c\'est jean pierre', '2021-09-24 11:17:21', 1, 1),
(9, 'je suis un commentaire pour l\'article 1', '2021-11-17 17:42:18', 7, 1),
(15, 'bonjour,  je suis un commentaire qui me renvoie sur cette page', '2021-11-17 18:08:33', 7, 1),
(16, 'test 2021', '2021-11-18 17:13:16', 7, 1);

-- --------------------------------------------------------

--
-- Structure de la table `reset_password_request`
--

DROP TABLE IF EXISTS `reset_password_request`;
CREATE TABLE IF NOT EXISTS `reset_password_request` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `selector` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hashed_token` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `requested_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `expires_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  PRIMARY KEY (`id`),
  KEY `IDX_7CE748AA76ED395` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `reset_password_request`
--

INSERT INTO `reset_password_request` (`id`, `user_id`, `selector`, `hashed_token`, `requested_at`, `expires_at`) VALUES
(4, 8, 'HIkkgMUsKLcsM7EAO3Fr', 'CZ2N2hro8Uu7dPguX/w+rbtdfEEwV+ZoN4fagIIKQbQ=', '2021-11-20 09:32:20', '2021-11-20 10:32:20');

-- --------------------------------------------------------

--
-- Structure de la table `snowtricks`
--

DROP TABLE IF EXISTS `snowtricks`;
CREATE TABLE IF NOT EXISTS `snowtricks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `groupe_figure` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `user_id_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_1A4AF30B9D86650F` (`user_id_id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `snowtricks`
--

INSERT INTO `snowtricks` (`id`, `nom`, `description`, `groupe_figure`, `created_at`, `updated_at`, `user_id_id`) VALUES
(1, 'tricks 1', 'Le Lorem Ipsum est simplement du faux texte employé dans la composition et la mise en page avant impression. Le Lorem Ipsum est le faux texte standard de l\'imprimerie depuis les années 1500, quand un imprimeur anonyme assembla ensemble des morceaux de texte pour réaliser un livre spécimen de polices de texte. Il n\'a pas fait que survivre cinq siècles, mais s\'est aussi adapté à la bureautique informatique, sans que son contenu n\'en soit modifié. Il a été popularisé dans les années 1960 grâce à la vente de feuilles Letraset contenant des passages du Lorem Ipsum, et, plus récemment, par son inclusion dans des applications de mise en page de texte, comme Aldus PageMaker.', 'saut', '2021-09-01 00:00:00', '2021-09-01 00:00:00', 1),
(3, 'tricks 3', 'Le Lorem Ipsum est simplement du faux texte employé dans la composition et la mise en page avant impression. Le Lorem Ipsum est le faux texte standard de l\'imprimerie depuis les années 1500, quand un imprimeur anonyme assembla ensemble des morceaux de texte pour réaliser un livre spécimen de polices de texte. Il n\'a pas fait que survivre cinq siècles, mais s\'est aussi adapté à la bureautique informatique, sans que son contenu n\'en soit modifié. Il a été popularisé dans les années 1960 grâce à la vente de feuilles Letraset contenant des passages du Lorem Ipsum, et, plus récemment, par son inclusion dans des applications de mise en page de texte, comme Aldus PageMaker.', 'saut', '2021-09-07 19:28:00', '2021-09-01 00:00:00', 1),
(4, 'tricks 4', 'Le Lorem Ipsum est simplement du faux texte employé dans la composition et la mise en page avant impression. Le Lorem Ipsum est le faux texte standard de l\'imprimerie depuis les années 1500, quand un imprimeur anonyme assembla ensemble des morceaux de texte pour réaliser un livre spécimen de polices de texte. Il n\'a pas fait que survivre cinq siècles, mais s\'est aussi adapté à la bureautique informatique, sans que son contenu n\'en soit modifié. Il a été popularisé dans les années 1960 grâce à la vente de feuilles Letraset contenant des passages du Lorem Ipsum, et, plus récemment, par son inclusion dans des applications de mise en page de texte, comme Aldus PageMaker.', 'saut', '0000-00-00 00:00:00', '2021-10-28 16:31:09', 7),
(5, 'tricks 5', 'Le Lorem Ipsum est simplement du faux texte employé dans la composition et la mise en page avant impression. Le Lorem Ipsum est le faux texte standard de l\'imprimerie depuis les années 1500, quand un imprimeur anonyme assembla ensemble des morceaux de texte pour réaliser un livre spécimen de polices de texte. Il n\'a pas fait que survivre cinq siècles, mais s\'est aussi adapté à la bureautique informatique, sans que son contenu n\'en soit modifié. Il a été popularisé dans les années 1960 grâce à la vente de feuilles Letraset contenant des passages du Lorem Ipsum, et, plus récemment, par son inclusion dans des applications de mise en page de texte, comme Aldus PageMaker.', 'saut', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 7),
(7, 'tricks 7', 'Le Lorem Ipsum est simplement du faux texte employé dans la composition et la mise en page avant impression. Le Lorem Ipsum est le faux texte standard de l\'imprimerie depuis les années 1500, quand un imprimeur anonyme assembla ensemble des morceaux de texte pour réaliser un livre spécimen de polices de texte. Il n\'a pas fait que survivre cinq siècles, mais s\'est aussi adapté à la bureautique informatique, sans que son contenu n\'en soit modifié. Il a été popularisé dans les années 1960 grâce à la vente de feuilles Letraset contenant des passages du Lorem Ipsum, et, plus récemment, par son inclusion dans des applications de mise en page de texte, comme Aldus PageMaker.', 'saut', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 7),
(21, 'mute', 'Les grabs sont la base des figures freestyle en snowboard. C\'est le fait d\'attraper sa planche avec une ou deux mains pendant un saut. On en compte six de base : indy, mute, nose grab, melon, stalefish et tail grab', 'grabs', '2021-10-25 10:31:44', '2021-10-25 10:31:44', 7),
(28, 'azerty1011', 'zertyuiop', 'zaeztrhtjyuk', '2021-11-11 12:10:56', '2021-11-11 12:10:56', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` json NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pseudo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_verified` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `email`, `roles`, `password`, `pseudo`, `is_verified`) VALUES
(1, '', 'null', '', '', 0),
(7, 'k.fardeau123@gmail.com', '[]', '$2y$13$31MFMH72GBC1M3O4NPvcZ./nh8vXLjgGVcgxDMvpE3nvL37SriNoy', NULL, 1),
(8, 'test@gmail.com', '[]', '$2y$13$EXAEpU6iDC5NmkOhUhq39uO9Ap7.5V4T8G.mm8V17qswShuHfpJ0u', NULL, 1);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `media`
--
ALTER TABLE `media`
  ADD CONSTRAINT `FK_6A2CA10C2109218F` FOREIGN KEY (`snowtrick_id_id`) REFERENCES `snowtricks` (`id`);

--
-- Contraintes pour la table `message`
--
ALTER TABLE `message`
  ADD CONSTRAINT `FK_B6BD307FA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `FK_B6BD307FC38C303B` FOREIGN KEY (`snowtricks_id`) REFERENCES `snowtricks` (`id`);

--
-- Contraintes pour la table `reset_password_request`
--
ALTER TABLE `reset_password_request`
  ADD CONSTRAINT `FK_7CE748AA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `snowtricks`
--
ALTER TABLE `snowtricks`
  ADD CONSTRAINT `FK_1A4AF30B9D86650F` FOREIGN KEY (`user_id_id`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
