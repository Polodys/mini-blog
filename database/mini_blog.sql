-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mar. 10 sep. 2024 à 11:16
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.2.12

-- Création de la base de données
CREATE DATABASE IF NOT EXISTS `mini_blog` CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `mini_blog`;

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `mini_blog`
--

-- --------------------------------------------------------

--
-- Structure de la table `author`
--

CREATE TABLE `author` (
  `author_id` int(11) NOT NULL,
  `email` varchar(250) DEFAULT NULL,
  `pseudonym` varchar(250) DEFAULT NULL,
  `password` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `author`
--

INSERT INTO `author` (`author_id`, `email`, `pseudonym`, `password`) VALUES
(1, 'fictive-author@example.com', 'FictiveAuthor', '$2y$10$Lk3JPQzA/FfEqqPcHKcul.fivVe87MaWdQsAqKOcQ/p7d6nKw5Zt2');

-- --------------------------------------------------------

--
-- Structure de la table `post`
--

CREATE TABLE `post` (
  `post_id` int(11) NOT NULL,
  `title` varchar(250) DEFAULT NULL,
  `content` text DEFAULT NULL,
  `creation_date` datetime DEFAULT NULL,
  `author_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `post`
--

INSERT INTO `post` (`post_id`, `title`, `content`, `creation_date`, `author_id`) VALUES
(1, 'Bienvenue dans Mini Blog !', 'Ceci est le premier billet posté dans Mini Blog.\r\n\r\nMini Blog est une application PHP simple conçue pour présenter la gestion de base d\'articles de blog et l\'authentification des utilisateurs. \r\n\r\nCe projet permet :\r\n- la création, l\'affichage, la mise à jour et la suppression d\'articles de blog ;\r\n- l\'enregistrement et la connexion des utilisateurs ; \r\n- la gestion des erreurs.\r\n\r\n**Fonctionnalités principales** :\r\n- Liste des billets de blog : affichage de la liste des articles sur la page d\'accueil ;\r\n- Affichage d\'un billet : click sur le titre pour voir le contenu complet ;\r\n- Authentification des utilisateurs : enregistrement et connexion sécurisés des utilisateurs ;\r\n- Création d\'un billet : un utilisateur connecté peut publier un billet ;\r\n- Mise à jour et suppression d\'un billet : seul l\'auteur peut modifier ou supprimer ses billets ;\r\n- Gestion des erreurs : affichage de messages spécifiques et journalisation.', '2024-09-10 10:52:21', 1),
(2, 'Exemple de texte long', 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. \r\n\r\nQuod porro, fuga non sed corrupti dolore repellat veniam iusto nulla vitae maxime nostrum inventore eveniet doloremque soluta harum aspernatur, praesentium quaerat facere molestias officia nesciunt saepe cum possimus. Veniam, commodi possimus! Quia, officia voluptate. Voluptatem rem sunt culpa delectus hic odit natus inventore minima. Consequuntur aut aspernatur illo, earum, quibusdam aliquam tenetur porro natus inventore rerum doloremque quaerat totam error maiores! Saepe consequatur suscipit velit sapiente accusantium voluptatum, quia omnis eos, tempore quidem aliquid commodi sint possimus. \r\n\r\nFugit animi ea accusantium nobis eos nisi nesciunt numquam aspernatur a et accusamus aliquid eligendi obcaecati unde eveniet incidunt excepturi architecto ipsa, repudiandae mollitia! Cumque recusandae mollitia consequuntur est quae? Error cumque suscipit quidem incidunt tempore. Mollitia vitae enim sunt cumque, quasi non magnam necessitatibus sapiente, est impedit aperiam a optio tempore maxime eveniet voluptas. Ab, possimus quae tenetur vel dolores blanditiis delectus impedit. Soluta laborum assumenda enim cupiditate consequatur nesciunt obcaecati tempore illum, in rem ea quod impedit tempora esse minima error iste vero quia. Vel esse iste eos officiis natus nam sequi aperiam itaque aut sit, odio odit atque? Saepe odit illo ducimus labore. Ex culpa nemo consectetur? Maxime voluptas sit tempora quibusdam nam, eaque quae sunt libero consequatur! Facere et cupiditate tempora. Itaque, velit illo odio placeat sequi aliquid repellat et quod vitae eveniet asperiores cupiditate maxime, veniam natus, perspiciatis soluta aut. Impedit accusamus recusandae id fuga aut corrupti architecto modi, aspernatur iusto delectus at dolore labore quis et, placeat soluta velit. Nesciunt est porro, quae omnis doloribus iure dolores consequatur itaque quidem labore nobis quasi blanditiis. Quidem blanditiis sequi sint natus eos laudantium aliquam fugit ad. Officia quas fuga autem veniam quis, at quod ipsum ullam ducimus cumque molestias id veritatis error odit voluptatum accusamus aliquam laborum modi aperiam nesciunt laudantium, molestiae praesentium. Officia dolorum necessitatibus eligendi debitis sunt sequi quos porro, commodi provident, delectus nam repellendus inventore quasi sit aliquid fugit est iusto ipsum. Iste non impedit repellendus assumenda atque veritatis inventore magni eos corporis rerum consectetur, fuga, ipsam accusantium nam. Magni voluptatibus architecto quaerat sed libero? Non ipsam neque animi iste ut! Modi, nihil! \r\n\r\nQuae enim expedita doloremque dolore cupiditate temporibus sit quam nihil commodi voluptas rem dolorem inventore quibusdam exercitationem quaerat doloribus, a libero earum esse accusamus. Saepe recusandae cupiditate laborum debitis dolorum cumque fugiat, impedit hic. Dicta deleniti ab odio facilis aperiam a in explicabo dolor sapiente velit quos est quas excepturi corrupti, magni commodi voluptatem numquam magnam sequi fuga sunt libero. Mollitia veritatis ad pariatur nostrum molestias ipsa voluptatibus voluptas optio animi sapiente. Aliquam vel quos nisi necessitatibus eos ab magnam sint quaerat perspiciatis nam ex earum nobis ratione cumque culpa nihil, libero, explicabo iure placeat id perferendis, voluptatibus quibusdam! Sunt sed fugiat officiis corporis deserunt omnis autem inventore. Consectetur dolor ipsam possimus dolorum quia provident blanditiis nam nihil est. Velit reiciendis doloremque temporibus eius quaerat doloribus ut sit quis odio iusto corporis, facere laudantium sapiente quam atque officiis est obcaecati odit ad quibusdam blanditiis rem! Accusantium quos est aut blanditiis iure illo error doloremque? Explicabo ratione velit odit rerum corporis alias cum incidunt culpa tenetur! Voluptates nam illo aperiam similique dolorem quibusdam officiis deserunt! Dignissimos distinctio perferendis itaque voluptatem, necessitatibus veritatis fugit quas corrupti deserunt dolores enim error eos veniam repellendus pariatur dolore odio nemo reiciendis deleniti laborum quod? Perferendis modi quam aspernatur ex nemo doloribus numquam, quas id, ad nesciunt tempore atque labore nulla eum obcaecati quae sunt architecto voluptates ipsum deleniti autem corporis. \r\n\r\nNesciunt perspiciatis distinctio ex est modi vero consequuntur rerum quam quibusdam ipsa? Ullam dolorem doloribus dicta, corporis magni quaerat! Fugit, excepturi unde consequuntur voluptate at ad similique dolorum vero necessitatibus placeat quisquam, sequi totam aut illo consectetur ea, libero dolores voluptatum quos labore cum praesentium reprehenderit? Nihil autem quos fuga perferendis eius. Ipsa vitae dolore magni rem, velit beatae explicabo voluptas! Animi cupiditate vero perspiciatis labore fugiat beatae molestiae qui commodi assumenda quod architecto praesentium numquam a deserunt asperiores deleniti hic, nihil tempora culpa quibusdam quaerat quidem! Accusantium libero quaerat vero odit ab natus corrupti, non, cupiditate facilis illum porro. Laborum possimus tempora similique nesciunt assumenda dicta officiis fugit vitae rem quidem minima rerum cum et pariatur, deserunt beatae culpa molestiae eligendi fuga placeat suscipit velit voluptatem nam voluptatum! Laboriosam optio reprehenderit id consequatur perspiciatis eaque reiciendis voluptate, ex dolor earum tempora labore ducimus, aliquid saepe autem nulla veritatis sit repellendus deleniti aperiam. Maiores esse nulla repellat porro amet ab provident, sapiente voluptatem itaque hic, doloribus sit illo in beatae. Molestias, exercitationem, quia soluta recusandae beatae dolor praesentium asperiores rem atque omnis architecto quasi. \r\n\r\nCommodi, quae nulla. Veniam dolore reprehenderit delectus at deleniti officia quas eveniet nulla. Unde rem tempore dignissimos eligendi sed, sint blanditiis repellendus neque et esse in odit placeat perspiciatis. Eum dignissimos cumque ad cum maxime quisquam, saepe qui libero eligendi voluptas quis vel explicabo repellendus nisi aperiam illum, recusandae pariatur perspiciatis maiores minus eaque, excepturi ducimus ipsam? Cumque optio, sunt autem quae ipsam mollitia! Aspernatur eum sunt, nesciunt perspiciatis illo saepe porro, laudantium nostrum itaque vero officia molestias fuga, neque ipsa est? Nulla voluptatum repudiandae, deleniti nam accusamus itaque repellat suscipit aliquam eius autem saepe veritatis, laboriosam esse odit rerum reiciendis incidunt. Eveniet repudiandae maiores aliquid ullam officiis, voluptatibus non sequi, quia, illo omnis reprehenderit nobis alias? Quo odio reprehenderit soluta, quos velit laboriosam quas blanditiis. Quia numquam est quos qui voluptatum, voluptate maxime eveniet ducimus? Laboriosam tempore error voluptates eligendi perspiciatis doloremque placeat laudantium, nobis quam fuga quos quaerat totam iste laborum? Itaque incidunt dolore quidem? Dolor labore libero tenetur numquam aut laudantium explicabo facilis aliquam. Ducimus fuga, eveniet ea itaque error hic unde modi laudantium iste qui aperiam. Ad voluptatibus tenetur illum consequatur ea, id blanditiis! Error, aliquid nam? \r\n\r\nHarum, nemo possimus nisi mollitia consectetur deleniti aliquid itaque, fuga similique nam, consequuntur reprehenderit aliquam libero inventore? Odio, aliquam quisquam consequuntur modi ad eos expedita, illum nihil exercitationem saepe odit dignissimos quibusdam facilis aliquid accusantium temporibus veritatis libero? Temporibus corporis quo distinctio placeat commodi.', '2024-09-10 11:03:23', 1);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `author`
--
ALTER TABLE `author`
  ADD PRIMARY KEY (`author_id`);

--
-- Index pour la table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`post_id`),
  ADD KEY `author_id` (`author_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `author`
--
ALTER TABLE `author`
  MODIFY `author_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `post`
--
ALTER TABLE `post`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `post`
--
ALTER TABLE `post`
  ADD CONSTRAINT `post_ibfk_1` FOREIGN KEY (`author_id`) REFERENCES `author` (`author_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
