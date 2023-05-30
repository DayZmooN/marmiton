-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : lun. 29 mai 2023 à 14:40
-- Version du serveur : 5.7.40
-- Version de PHP : 8.1.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `marmiton`
--

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(150) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`id`, `title`) VALUES
(1, 'Plat'),
(2, 'Sandwiches'),
(3, 'Desserts'),
(4, 'Amuses bouches'),
(5, 'Entrées');

-- --------------------------------------------------------

--
-- Structure de la table `categories_recipes`
--

DROP TABLE IF EXISTS `categories_recipes`;
CREATE TABLE IF NOT EXISTS `categories_recipes` (
  `recipe_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  KEY `RECIPES` (`recipe_id`) USING BTREE,
  KEY `CATEGORY` (`category_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `categories_recipes`
--

INSERT INTO `categories_recipes` (`recipe_id`, `category_id`) VALUES
(1, 5),
(2, 3),
(2, 4);

-- --------------------------------------------------------

--
-- Structure de la table `ingredients`
--

DROP TABLE IF EXISTS `ingredients`;
CREATE TABLE IF NOT EXISTS `ingredients` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `ingredients`
--

INSERT INTO `ingredients` (`id`, `name`) VALUES
(1, 'Sucre'),
(2, 'Farine'),
(3, 'Levure chimique'),
(4, 'Beurre'),
(5, 'Lait'),
(6, 'Oeuf'),
(7, 'Salade'),
(8, 'Tamate'),
(9, 'Mais'),
(10, 'Concombre');

-- --------------------------------------------------------

--
-- Structure de la table `ingredient_recipes`
--

DROP TABLE IF EXISTS `ingredient_recipes`;
CREATE TABLE IF NOT EXISTS `ingredient_recipes` (
  `recipe_id` int(11) NOT NULL,
  `ingredient_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `unit` varchar(15) NOT NULL,
  KEY `recipe` (`recipe_id`) USING BTREE,
  KEY `INGREDIENTS` (`ingredient_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `ingredient_recipes`
--

INSERT INTO `ingredient_recipes` (`recipe_id`, `ingredient_id`, `quantity`, `unit`) VALUES
(2, 1, 150, 'grames'),
(2, 2, 200, 'grames'),
(2, 3, 8, 'grames'),
(2, 4, 100, 'grames'),
(2, 5, 3, 'grames'),
(2, 1, 150, 'grames'),
(2, 2, 200, 'grames'),
(2, 3, 8, 'grames'),
(2, 4, 100, 'grames'),
(2, 5, 3, 'grames'),
(2, 1, 150, 'grames'),
(2, 2, 200, 'grames'),
(2, 3, 8, 'grames'),
(2, 4, 100, 'grames'),
(2, 5, 3, 'grames'),
(2, 6, 3, ''),
(1, 6, 1, '');

-- --------------------------------------------------------

--
-- Structure de la table `recipes`
--

DROP TABLE IF EXISTS `recipes`;
CREATE TABLE IF NOT EXISTS `recipes` (
  `id_recipes` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `slug` varchar(50) NOT NULL,
  `duration` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `thumbnail` varchar(255) NOT NULL,
  `content` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_recipes`),
  KEY `USER_ID` (`userid`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `recipes`
--

INSERT INTO `recipes` (`id_recipes`, `title`, `slug`, `duration`, `userid`, `thumbnail`, `content`, `created_at`) VALUES
(1, 'Soupe', 'soupe', 15, 1, '2217290_w472h265c1cx600cy300cxt0cyt0cxb1200cyb600.webp', 'Soupe veloutée de potimarron et pommes de terre', '0000-00-00 00:00:00'),
(2, 'Madeleine', 'madeleine', 20, 1, 'les-madeleines-de-chef-simon-p1250973-r-scaled.webp', 'Madeleine nappée de chocolat', '0000-00-00 00:00:00'),
(3, 'gfg', 'gfgg', 10, 52, '2217290_w472h265c1cx600cy300cxt0cyt0cxb1200cyb600', 'dfgdf', '0000-00-00 00:00:00'),
(4, 'gfg', 'gfgg', 10, 52, '-simon-p1250973-r-scaled.webp', 'dfgdf', '0000-00-00 00:00:00'),
(5, 'coucou angeline', 'cocucou', 10, 52, 'cjcjcjc', 'djjcdncj', '0000-00-00 00:00:00'),
(6, 'fdgdfg', 'hgf', 10, 92, 'gh', 'gjhjy', '0000-00-00 00:00:00'),
(7, 'cococ', 'coco', 20, 92, '-simon-p1250973-r-scaled.webp', 'blopblop', '0000-00-00 00:00:00'),
(8, 'toto', 'toto', 20, 93, 'toto.png', 'totottotot', '0000-00-00 00:00:00'),
(27, 'jojoooaaaaa', 'ggg', 10, 97, 'uhuyguygg', 'uygghg', '2023-05-26 13:20:19'),
(29, 'lalala', 'bgwbccvb', 15, 97, 'bcgbx', 'hello', '2023-05-26 13:29:08'),
(30, 'chocolat', 'chocholat', 15, 97, 'kiovjoijfvu', 'jkfvkjhvh', '2023-05-28 14:38:38'),
(32, 'dl,c', 'kld,kls,v', 10, 97, 'mdjfildjiv', 'cdsjshvu', '2023-05-28 19:07:44'),
(33, 'madeleine', 'madeleine', 10, 97, 'mdklvljlj', 'jvfjdkvnkjnj', '2023-05-28 19:12:25'),
(34, 'madeleine', 'madeleine', 10, 97, 'mdklvljlj', 'jvfjdkvnkjnj', '2023-05-28 19:15:17'),
(35, 'madeleine', 'madeleine', 10, 97, 'mdklvljlj', 'jvfjdkvnkjnj', '2023-05-28 19:15:17'),
(36, 'madeleine', 'madeleine', 10, 97, 'mdklvljlj', 'jvfjdkvnkjnj', '2023-05-28 19:15:18'),
(37, 'm,f,kl,', 'ckjxnkjc', 10, 97, 'njdkjn', 'jdnkj', '2023-05-28 19:15:44'),
(38, 'm,f,kl,', 'ckjxnkjc', 10, 97, 'njdkjn', 'jdnkj', '2023-05-28 19:17:19'),
(39, ';mlv;dfmlv', ',lkfklf,v', 10, 97, 'mlfd;lm,bvlk', ',kvfd,vlk,', '2023-05-29 13:06:24');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `email` varchar(155) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=106 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `created_at`) VALUES
(1, 'goku', 'goku@gmailcom', '12345', '2023-04-04 22:00:00'),
(2, 'chichi', 'chichi@gmailcom', '12345', '2023-04-04 22:00:00'),
(3, 'toto', 'toto@gmail.com', '$argon2id$v=19$m=65536,t=4,p=1$WFB1bHpQcGNHa1dpdHBXNQ$0Y2cXHEiS+gOtoo6D/H9nIx1Y3RszlkkKoJZBtrLL1Y', NULL),
(4, 'toto', 'toto@gmail.com', '$argon2id$v=19$m=65536,t=4,p=1$TTVuM056ZElmLkI1ZjRpaA$MbwoS5J75FRiTNEt2B/eAy0h0+tNp96QHYxerM1ryvw', NULL),
(10, 'lala', 'lalal@gmail.com', '12345', NULL),
(12, 'lolo', 'lolo@gmail.com', '$2y$10$FKeTP/k0Qc0cd9HAZfG8T.0dklvRgmiCYI1.POFxTDLrTE2BsjPM2', NULL),
(46, 'bebe', 'bebe@gmail.com', '$2y$10$puh0.fJJIjbjliUv9Vz00uvM4JPTYjiX4SU4qvOd63Ifd.dz6F0LW', NULL),
(48, 'hello', 'hello@gmail.com', '$2y$10$bqApz2.hjWZLszhhiCzn9eLjq77B43SV719UWGaFbQTZsN0B966eC', NULL),
(49, 'vegeta', 'vegeta@gmail.com', '$2y$10$BiH7C2na5ls2V3uzf3mJeeKpkemLWqIFJubdRldLMbj9aOe.dY9z2', NULL),
(50, 'bulma', 'bulma@gmail.com', '$2y$10$NbmKA7LvDAfam3ZnxdPqUe0v7KZ689h.6nkvBwjH9z2OSt75JZq/i', NULL),
(51, 'bulma', 'bulma@gmail.com', '$2y$10$52pz1muJH24b1fU7WJD6A.g8jNxV41vuwQyWhq8EbFQS//510wnam', NULL),
(52, 'trucs', 'trucs@gmail.com', '$2y$10$SgLEbtU8NZFC4O4u7o.nW.FGPM47HloRWfAcHZDPXolqzHkEI1hWi', NULL),
(53, 'trucs', 'trucs@gmail.com', '$2y$10$/Khn/rFmlSxwjy45hjW7CeF7APo6ppZixYu3qrKAx7sZA0medNpIC', NULL),
(54, 'coca', 'coca@gmail.com', '$2y$10$XTVTEhrew.XzmgByeMpm/eCCGoR8U3Jcc19RrgVaJLYhCUpQJeeVG', NULL),
(55, 'popo', 'popo@gmail.com', '$2y$10$wkRu3k1HxiQajxVxTBM4meK4FoT5hsmqFL3cYhD4B5jSdyFinHjaS', '2023-05-23 14:26:09'),
(56, 'karim', 'karim@gmail.com', '$2y$10$0hj7.h/jKvdeDll8LLD2IuK5AO99bF7MeeATsEw4pVrhVIa.J7nt.', '2023-05-23 14:38:52'),
(57, 'popo', 'popo@gmail.com', '$2y$10$QcvU.92dFDLum0PT/5ggjOAAHpT6o6QqZ2N22TN0kVmCWDlj12m5y', '2023-05-23 14:50:53'),
(58, 'trucs@gmail.com', 'trucs@gmail.com', '$2y$10$LIttb62CJtXwR80hT8jLo.a3vvzGJvmmu3QwdXP1BfbAdxPWhBCy.', '2023-05-24 07:18:15'),
(59, 'trucs@gmail.com', 'trucs@gmail.com', '$2y$10$FdhHQ0aVu8Xy9DOTbgl57uT3AKu6hlxc5O83iP2HvP4UmNcfueY36', '2023-05-24 07:21:27'),
(60, 'bobobo', 'bobobo@gmail.com', '$2y$10$62qxYhSwpKqq/HjNJ6ROPegNau7bTw0Wx2g.7OxyXePvwh3vLTFJC', '2023-05-24 07:32:06'),
(61, 'lalala', 'lalalam@gmail.com', '$2y$10$6URfpVrwPMHLmFthQGLp0eJ81nY2CA1iIyEq2r8gWFBoz0vzmKBjS', '2023-05-24 07:36:09'),
(62, 'trucs@gmail.com', 'alala@gmail.com', '$2y$10$U8RMeA4XTipA7cTEo0O3tuf7GEtYY5gBcd2kYGP7tzUC52dHmxRAq', '2023-05-24 07:37:56'),
(63, 'aa', 'a@gmail.com', '$2y$10$KJ3OJNLFfD5AUnVYaUPyZOKLnhqF1qMPS0DyPWHMP5ahCludxmIBu', '2023-05-24 07:38:33'),
(64, 'trucs@gmail.com', 'ri@gmail.com', '$2y$10$dP3ieJ6fbtOLmA2Ok0D5Guf1c3syRrEOpDSU4/JMOGvjkElpt5Gj6', '2023-05-24 07:40:39'),
(66, 'baba', 'baba@gmail.com', '$2y$10$ItjWXP3qnK7CWqdXmooNQ.HHrDphEA1Zc/m3uFsZ4xxGpLJMdvs8S', '2023-05-24 07:44:06'),
(67, 'haahah', 'haha@gmail.com', '$2y$10$dk/AVrGQxNOaz3WxXRuD7OHhyqpxVFWHlEigsZgGk4woED1QScqOC', '2023-05-24 07:46:28'),
(68, 'trucs', 'hahaahah@gmail.com', '$2y$10$1U.ZlfPV9eJpYY5FPUoiOORGpIxYTIkbp2JVieJLCW9SDu0i6.5pC', '2023-05-24 07:46:48'),
(69, 'helloo', 'hello333@gmail.com', '$2y$10$YPXTRQRREfGfAVStXRddPeMKnxhHgvpzO1Bp0EirJo.Y6GxfRC7l.', '2023-05-24 07:47:37'),
(70, 'haha124', 'hahaah44@gmail.com', '$2y$10$xDZHKzQNfDGIThebzZ.ihO5iq9L8HQpNQVpQ86MEsM0evMC5pdyqK', '2023-05-24 07:50:00'),
(71, 'babai', 'bobo4521@gmail.com', '$2y$10$7qAObnHVslI9wqyRoi4fm.Va2kQn55MsWimtAR5f7wOA5t7F8lI2C', '2023-05-24 07:58:02'),
(72, 'yamato', 'yamato@gmail.com', '$2y$10$NjEaGPjgKq47b5MWQZXGzO.e2je1hvSYoDrBGf0YXNWxWv.OJPnM6', '2023-05-24 07:59:39'),
(73, 'titi', 'titi@gmail.com', '$2y$10$18qQXAIT/y5D3FxpraaafOfbiyCBiCTleOaSwtyqlh4ZipcVV3Nj2', '2023-05-24 08:01:01'),
(74, 'gogog', 'gogog@gmail.com', '$2y$10$4aUw03ht3xmvR/6zqYtQ.uqKfrEtZLIduXrpkxF9W3shpgN1JW4b.', '2023-05-24 08:01:50'),
(75, 'uguggu', 'uttu@gmail.com', '$2y$10$cp1wI2Ex.i1lvZP5f19hNu4B0IZlP3BFxosc2rrb5uzVjnqlq.BKq', '2023-05-24 08:02:21'),
(76, 'tutu', 'tututu@gmail.com', '$2y$10$kNJzlliqkKpDrHgYNmzMCeXqXbi1bmwvvLq.sc4vc6elr4K9EhRdm', '2023-05-24 08:06:27'),
(77, 'tata', 'tata@gmail.com', '$2y$10$bTj.aKcXVEXQ88tB0sWUXOGkin0kSXKV8zwzvTc.yS2j.lYKHoLQG', '2023-05-24 08:07:36'),
(78, 'trucs@gmail.com', 'jiji@gmail.com', '$2y$10$qfhRiJTrJ7NQV7o1DhK/Pu8BDKl9I/L8zEfrm/3Fz4DSTiWJICAMy', '2023-05-24 08:08:23'),
(79, 'aiaiai', 'aiaia@gmail.com', '$2y$10$vMdK4hJeq20cdcORXlsMs.2SHz0Rm5B4Rv0iKTpUkQIr9f36V6KWe', '2023-05-24 08:09:57'),
(80, 'r', 'tytyt@gmail.com', '$2y$10$7Uy/aMoBF0nYzvlx364U8.G0sOjIV2NZ6X6SVpEaJFVBQfc3qkLNK', '2023-05-24 08:17:22'),
(81, 'tktkt', 'tktkt@gmail.com', '$2y$10$5pal/G7q7OoFjJUvSfz2f.LbfidTdbKCAUm2.GSwgiNu1itxY5CvW', '2023-05-24 08:21:21'),
(82, 'dd', 'dd@gmail.com', '$2y$10$ZOzqUaKXm/TK/1nagjmCheJVMC3zN2oeo4G3xR85znmLaE4P.5fqm', '2023-05-24 08:22:20'),
(83, 'trucs@gmail.com', 'rroror@gmail.com', '$2y$10$BLAgaSUqq3rIL..AVthEgOrfbX33jMONM9v2J.b4.yT.8kQKtTqJK', '2023-05-24 08:23:10'),
(84, 'f1f1', 'f1f1f@gmail.com', '$2y$10$Cul26F2aoRqfcYNgmbnEf.hncCGJcficF7eHksNhPEKZGu013Kx6G', '2023-05-24 08:25:14'),
(85, 'h1', 'h1h1h@gmail.com', '$2y$10$HzOQEBSJXp7lg2LGBjR7N.Uxs8eu9c25DkZWzN1hgxIG6fQHyH5fu', '2023-05-24 08:26:06'),
(86, 't1t2', 't1t2@gmail.com', '$2y$10$DpSSzT.JJG1DTgdv7Ez9U.dVsO7SxaKPpMeA.x2SmjWuAN4FVK1Nq', '2023-05-24 08:27:51'),
(87, 'gogogo', 'ggogogo@gmail.com', '$2y$10$BbukL6ELcluvc8gI2qLIS.ZGqd4PKGdQ0SSPTOsIQKDNlZc/oCUm6', '2023-05-24 08:30:10'),
(88, 'tbtbt', 'ttbtbt@gmail.com', '$2y$10$UCq6NDMJ66cTWgN6ka5Z4eV651KuTT/u.uOgBovqnBSbuu0fM3N/O', '2023-05-24 08:32:11'),
(89, 'trucs@gmail.com', 'bdbdbd@gmail.com', '$2y$10$CTKqnIB8ITArwkBghSxqAuSrdyI7NIPLwNI83jGTJoJICKf3oQN2m', '2023-05-24 08:32:34'),
(90, 'trucs@gmail.com', 'heyyyy@gmail.com', '$2y$10$fDYE5I1Jui7toO8bIbrpSeAI936L2vig.Nv/9VP3CPVUtgtv6O1CK', '2023-05-24 08:34:25'),
(91, 'titi', 'titit@gmail.com', '$2y$10$mkslW7CFGDIbCl/CelCcCO8vDEQzP6KZvptitZTI63RWGgzQQFFgS', '2023-05-24 08:38:18'),
(92, 'jojo', 'jojo@gmail.com', '$2y$10$V71n8DoaNHU/ANE4SssPNuKuL0RShFsJkC8LAYvWoxNNOfUJZaNMe', '2023-05-25 07:31:30'),
(93, 'coc', 'cocoooo@gmail.com', '$2y$10$IuiaF./Jn/hQ2DLHoxgNEOkxEydGmIrPWwf9HHAErGvkjehnWeeWS', '2023-05-25 07:47:33'),
(94, 'gogoggo', 'oggogogo@gmail.com', '$2y$10$P/UtYrIuMC6mWGx8RhkW4.wYY/08kil7lqODyv9rBZ3Q6Ags1rKaW', '2023-05-25 08:55:05'),
(95, 'papa', 'paap@gmail.com', '$2y$10$e.cBz3Bx7/nDi7I.d53KQeCnRNCG9GpnZ4czYVwn2QhPuFFW5Qggy', '2023-05-25 09:21:26'),
(96, 'blabla', 'blalabla@gmail.com', '$2y$10$QKGgOtOcys1Z9SKZnHVWgewaZ84BNVZ2.yf14hWg.tjxnqB0t2WG2', '2023-05-25 09:30:09'),
(97, 'walscatetedechat', 'walesca@gmail.com', '$2y$10$OMrM4sl8lQ9lKUH0xD4J8.Lwd18OxmYkfp8UQPk/WNbSpMG6CP4Eu', '2023-05-25 09:51:23'),
(98, 'gogo', 'gog@gmail.com', '$2y$10$4qfNCFdfVQBotg/KirdKT.8vA5JnYHgTZREm.gbGjpcQeuaEAJrFi', '2023-05-26 06:51:53'),
(99, 'walesca@gmail.com', 'lol@hmail.com', '$2y$10$ELDYMpD1h2TAenbJXCOFGOPYq85w1KCEbIry4nAnFtqtwOH7hdhIC', '2023-05-26 06:54:33'),
(100, 'gogo', 'iiir@gmail.com', '$2y$10$Y7On7/sZvIpcd09x6KHwWOCmYfxOTvxQVnRXd1A0uTdLAUYBNKulO', '2023-05-26 07:02:16'),
(101, 'aga', 'ohoho@gmail.com', '$2y$10$qoKgnfyhRZExk7BhC.GfhO9spLLSOdlMSjCsK4EeTAAEj7gJVVa8e', '2023-05-26 07:04:19'),
(102, 'rk', 'rk@gmail.com', '$2y$10$ang35DdcfBHdPX3UrE2pdOykdqJ5pQP57FUIiOIjS6KjFOfoXajxO', '2023-05-26 08:05:42'),
(103, 'gpgp', 'gpgpg@gmail.com', '$2y$10$7V6beuySfS/BTrKFMvTqZOemvsPIt5WgKFHN.coJiDRQTWjuuD7yy', '2023-05-26 08:14:46'),
(104, 'pk', 'pk@gmail.com', '$2y$10$ST0sbjpMI2jK9xvXBvgs0.0WlLFA40TZ.i.Feyr8TxI6r.n7WYJyu', '2023-05-26 08:19:48'),
(105, 'phphp', 'phphp@gmail.com', '$2y$10$E/QCqptKPgwRahbXo245rOHzUi5hXOj1r/L.lhfGDqrIWtGI9GpMO', '2023-05-26 08:28:32');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `categories_recipes`
--
ALTER TABLE `categories_recipes`
  ADD CONSTRAINT `categories_recipes_ibfk_1` FOREIGN KEY (`recipe_id`) REFERENCES `recipes` (`id_recipes`),
  ADD CONSTRAINT `categories_recipes_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);

--
-- Contraintes pour la table `ingredient_recipes`
--
ALTER TABLE `ingredient_recipes`
  ADD CONSTRAINT `ingredient_recipes_ibfk_1` FOREIGN KEY (`recipe_id`) REFERENCES `recipes` (`id_recipes`),
  ADD CONSTRAINT `ingredient_recipes_ibfk_2` FOREIGN KEY (`ingredient_id`) REFERENCES `ingredients` (`id`);

--
-- Contraintes pour la table `recipes`
--
ALTER TABLE `recipes`
  ADD CONSTRAINT `recipes_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
