
-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 10, 2017 at 05:07 AM
-- Server version: 10.0.28-MariaDB
-- PHP Version: 5.2.17

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `u625731772_pisc`
--

-- --------------------------------------------------------

--
-- Table structure for table `Admin`
--

CREATE TABLE IF NOT EXISTS `Admin` (
  `mail_admin` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `nom_admin` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `prenom_admin` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `mot_de_passe` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`mail_admin`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `Admin`
--

INSERT INTO `Admin` (`mail_admin`, `nom_admin`, `prenom_admin`, `mot_de_passe`) VALUES
('enzo.fabre@etu.umontpellier.fr', 'enzo', 'fabre', 'P1sc1ne');

-- --------------------------------------------------------

--
-- Table structure for table `Choisir`
--

CREATE TABLE IF NOT EXISTS `Choisir` (
  `mail_etud` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `nom_profil` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `pourcentage` double(10,0) NOT NULL,
  PRIMARY KEY (`mail_etud`,`nom_profil`),
  KEY `id_prop1` (`nom_profil`),
  KEY `id_prop2` (`pourcentage`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `Choisir`
--

INSERT INTO `Choisir` (`mail_etud`, `nom_profil`, `pourcentage`) VALUES
('cameron.diaz@etu.umontpellier.fr', 'Réaliste', 15),
('enzo.fabre@etu.umontpellier.fr', 'Conventionnel', 12),
('enzo.fabre@etu.umontpellier.fr', 'Social', 19),
('enzo.fabre@etu.umontpellier.fr', 'Artistique', 11),
('antoine.sanchez@etu.umontpellier.fr', 'Réaliste', 17),
('antoine.sanchez@etu.umontpellier.fr', 'Investigatif', 31),
('antoine.sanchez@etu.umontpellier.fr', 'Artistique', 22),
('antoine.sanchez@etu.umontpellier.fr', 'Social', 4),
('antoine.sanchez@etu.umontpellier.fr', 'Entrepreneur', 10),
('antoine.sanchez@etu.umontpellier.fr', 'Conventionnel', 17),
('enzo.fabre@etu.umontpellier.fr', 'Réaliste', 22),
('enzo.fabre@etu.umontpellier.fr', 'Investigatif', 18),
('marion.rul@etu.umontpellier.fr', 'Conventionnel', 15),
('marion.rul@etu.umontpellier.fr', 'Entrepreneur', 15),
('marion.rul@etu.umontpellier.fr', 'Social', 22),
('marion.rul@etu.umontpellier.fr', 'Artistique', 14),
('marion.rul@etu.umontpellier.fr', 'Investigatif', 15),
('marion.rul@etu.umontpellier.fr', 'Réaliste', 18),
('enzo.fabre@etu.umontpellier.fr', 'Entrepreneur', 17),
('cameron.diaz@etu.umontpellier.fr', 'Investigatif', 19),
('cameron.diaz@etu.umontpellier.fr', 'Artistique', 29),
('cameron.diaz@etu.umontpellier.fr', 'Social', 10),
('cameron.diaz@etu.umontpellier.fr', 'Entrepreneur', 14),
('cameron.diaz@etu.umontpellier.fr', 'Conventionnel', 12),
('omar.sy@etu.umontpellier.fr', 'Réaliste', 17),
('omar.sy@etu.umontpellier.fr', 'Investigatif', 14),
('omar.sy@etu.umontpellier.fr', 'Artistique', 21),
('omar.sy@etu.umontpellier.fr', 'Social', 12),
('omar.sy@etu.umontpellier.fr', 'Entrepreneur', 15),
('omar.sy@etu.umontpellier.fr', 'Conventionnel', 21),
('barack.obama@etu.umontpellier.fr', 'Réaliste', 19),
('barack.obama@etu.umontpellier.fr', 'Investigatif', 19),
('barack.obama@etu.umontpellier.fr', 'Artistique', 10),
('barack.obama@etu.umontpellier.fr', 'Social', 12),
('barack.obama@etu.umontpellier.fr', 'Entrepreneur', 19),
('barack.obama@etu.umontpellier.fr', 'Conventionnel', 19),
('brad.pitt@etu.umontpellier.fr', 'Réaliste', 26),
('brad.pitt@etu.umontpellier.fr', 'Investigatif', 19),
('brad.pitt@etu.umontpellier.fr', 'Artistique', 18),
('brad.pitt@etu.umontpellier.fr', 'Social', 14),
('brad.pitt@etu.umontpellier.fr', 'Entrepreneur', 7),
('brad.pitt@etu.umontpellier.fr', 'Conventionnel', 15),
('emma.stone@etu.umontpellier.fr', 'Réaliste', 25),
('emma.stone@etu.umontpellier.fr', 'Investigatif', 22),
('emma.stone@etu.umontpellier.fr', 'Artistique', 10),
('emma.stone@etu.umontpellier.fr', 'Social', 10),
('emma.stone@etu.umontpellier.fr', 'Entrepreneur', 18),
('emma.stone@etu.umontpellier.fr', 'Conventionnel', 15),
('mila.kunis@etu.umontpellier.fr', 'Réaliste', 14),
('mila.kunis@etu.umontpellier.fr', 'Investigatif', 11),
('mila.kunis@etu.umontpellier.fr', 'Artistique', 24),
('mila.kunis@etu.umontpellier.fr', 'Social', 17),
('mila.kunis@etu.umontpellier.fr', 'Entrepreneur', 14),
('mila.kunis@etu.umontpellier.fr', 'Conventionnel', 21),
('ryan.gosling@etu.umontpellier.fr', 'Réaliste', 17),
('ryan.gosling@etu.umontpellier.fr', 'Investigatif', 22),
('ryan.gosling@etu.umontpellier.fr', 'Artistique', 17),
('ryan.gosling@etu.umontpellier.fr', 'Social', 12),
('ryan.gosling@etu.umontpellier.fr', 'Entrepreneur', 24),
('ryan.gosling@etu.umontpellier.fr', 'Conventionnel', 8),
('ben.affleck@etu.umontpellier.fr', 'Réaliste', 26),
('ben.affleck@etu.umontpellier.fr', 'Investigatif', 18),
('ben.affleck@etu.umontpellier.fr', 'Artistique', 12),
('ben.affleck@etu.umontpellier.fr', 'Social', 12),
('ben.affleck@etu.umontpellier.fr', 'Entrepreneur', 17),
('ben.affleck@etu.umontpellier.fr', 'Conventionnel', 14),
('bradley.cooper@etu.umontpellier.fr', 'Réaliste', 12),
('bradley.cooper@etu.umontpellier.fr', 'Investigatif', 15),
('bradley.cooper@etu.umontpellier.fr', 'Artistique', 21),
('bradley.cooper@etu.umontpellier.fr', 'Social', 18),
('bradley.cooper@etu.umontpellier.fr', 'Entrepreneur', 17),
('bradley.cooper@etu.umontpellier.fr', 'Conventionnel', 17);

-- --------------------------------------------------------

--
-- Table structure for table `Etudiant`
--

CREATE TABLE IF NOT EXISTS `Etudiant` (
  `mail_etud` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `nom_etud` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `prenom_etud` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `nom_promo` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`mail_etud`),
  KEY `nom_promo` (`nom_promo`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `Etudiant`
--

INSERT INTO `Etudiant` (`mail_etud`, `nom_etud`, `prenom_etud`, `nom_promo`) VALUES
('mohamed-iheb.faiza@etu.umontpellier.fr', 'FAIZA', 'Mohamed Iheb', 'IG'),
('enzo.fabre@etu.umontpellier.fr', 'Fabre', 'Enzo', 'IG'),
('marion.rul@etu.umontpellier.fr', 'Rul', 'Marion', 'IG'),
('antoine.sanchez@etu.umontpellier.fr', 'Sanchez', 'Antoine', 'IG'),
('barack.obama@etu.umontpellier.fr', 'Obama', 'Barack', 'IG'),
('brad.pitt@etu.umontpellier.fr', 'Pitt', 'Brad', 'IG'),
('emma.stone@etu.umontpellier.fr', 'Stone', 'Emma', 'GBA'),
('mila.kunis@etu.umontpellier.fr', 'Kunis', 'Mila', 'GBA'),
('ryan.gosling@etu.umontpellier.fr', 'Gosling', 'Ryan', 'MAT'),
('ben.affleck@etu.umontpellier.fr', 'Affleck', 'Ben', 'MAT'),
('cameron.diaz@etu.umontpellier.fr', 'Diaz', 'Cameron', 'STE'),
('omar.sy@etu.umontpellier.fr', 'Sy', 'Omar', 'STE'),
('bradley.cooper@etu.umontpellier.fr', 'Cooper', 'Bradley', 'MI');

-- --------------------------------------------------------

--
-- Table structure for table `Groupe_question`
--

CREATE TABLE IF NOT EXISTS `Groupe_question` (
  `num_groupe` int(2) NOT NULL,
  PRIMARY KEY (`num_groupe`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `Groupe_question`
--

INSERT INTO `Groupe_question` (`num_groupe`) VALUES
(1),
(2),
(3),
(4),
(5),
(6),
(7),
(8),
(9),
(10),
(11),
(12);

-- --------------------------------------------------------

--
-- Table structure for table `Profil`
--

CREATE TABLE IF NOT EXISTS `Profil` (
  `nom_profil` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`nom_profil`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `Profil`
--

INSERT INTO `Profil` (`nom_profil`, `description`) VALUES
('Realiste', 'La personne de type réaliste préfère les activités ancrées dans la\nréalité et permettant la manipulation ordonnée et systématique\nd''objets, de machines ou d''animaux. Elle est souvent moins\nintéressée par les échanges sociaux et est plutôt réservée. Elle a\nun bon sens pratique et abandonne rarement une tâche avant\nd''être arrivée à bonne fin.'),
('Investigatif', 'Une personne douée pour les mathématiques et les sciences mais\nqui n''aime pas trop diriger une équipe, car elle aime son\nindépendance. Elle est modeste, circonspecte, intellectuelle, précise,\ncurieuse et méthodique. Elle est créative mais n''aime pas forcément\naller jusqu''au bout d''une réalisation.'),
('Artistique', 'Si l''«artiste» ne laisse pas indiférent, il peut aussi totalement\ndérouter ses interlocuteurs. Il est, en effet, désordonné,\nidéaliste, impulsif, intuitif mais peu pratique. Il est bien sûr très\ncréatif et imaginatif et il a souvent des manières nouvelles de\nposer les problèmes pour trouver des solutions.'),
('Social', 'La personne de type social aime par-dessus tout donner assistance à\nautrui. Former, enseigner, soigner ou informer sont ses activités\nfavorites. On la décrit comme accueillante, responsable,\nconvaincante, généreuse et tolérante.\n'),
('Entrepreneur', 'La personne de type entreprenant est particulièrement tonique\net ambitieuse. Elle est très douée pour obtenir le leadership car\nelle s''exprime facilement. On la décrit comme une personne aventureuse, énergique, aimant la vie, \nun peu tapageuse, autoritaire quoique le plus souvent populaire.'),
('Conventionnel', 'Les personnes de type classique aiment surtout les activités qui\nnécessitent ordre et systématisme. En un mot, elles aiment la\nrégularité dans le travail et sont parfois réticentes au changement.\nCe sont des personnes calmes, méthodiques et consciencieuses, qui \ns''intègrent souvent très bien dans un travail d''équipe.');

-- --------------------------------------------------------

--
-- Table structure for table `Promo`
--

CREATE TABLE IF NOT EXISTS `Promo` (
  `nom_promo` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `code` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`nom_promo`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `Promo`
--

INSERT INTO `Promo` (`nom_promo`, `code`) VALUES
('IG', 'InfGestPol'),
('MEA', 'MeaProm'),
('MI', 'MiPol2016'),
('MAT', 'MatPol2016'),
('STE', 'StePol3'),
('GBA', 'Gba6Pol');

-- --------------------------------------------------------

--
-- Table structure for table `Proposition`
--

CREATE TABLE IF NOT EXISTS `Proposition` (
  `id_prop` varchar(4) COLLATE utf8_unicode_ci NOT NULL,
  `libelle` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `num_groupe` int(2) NOT NULL,
  `nom_profil` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id_prop`),
  KEY `num_groupe` (`num_groupe`),
  KEY `nom_profil` (`nom_profil`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `Proposition`
--

INSERT INTO `Proposition` (`id_prop`, `libelle`, `num_groupe`, `nom_profil`) VALUES
('1A', 'Vous aimez avoir des activités à l''extérieur, travailler en plein air ', 1, 'Realiste'),
('1B', 'Vous aimez élargir vos connaissances par l''étude, pouvoir approfondir un sujet', 1, 'Investigatif'),
('1C', 'Vous aimez travailler de façon indépendante, sans méthode ni objectif structurés', 1, 'Artistique'),
('1D', 'Vous aimez travailler avec d''autres personnes pour les informer', 1, 'Social'),
('1E', 'Vous admirez les personnes qui ont du pouvoir ou qui gagnent beaucoup d''argent', 1, 'Entrepreneur'),
('1F', 'Vous aimez travailler avec des chiffres', 1, 'Conventionnel '),
('2A', 'Vous admirez les personnes qui travaillent pour soigner les autres', 2, 'Social'),
('2B', 'Vous aimez une organisation claire et bien définie', 2, 'Conventionnel'),
('2C', 'Vous aimez contribuer à atteindre les objectifs d''une organisation', 2, 'Entrepreneur'),
('2D', 'Vous aimez le sport, vous dépenser physiquement', 2, 'Realiste'),
('2E', 'Vous aimez étudier les choses, les phénomènes ou les comportements', 2, 'Investigatif'),
('2F', 'Vous admirez les personnes qui ont des capacités artistiques', 2, 'Artistique'),
('3A', 'Vous aimez travailler avec d''autres personnes pour les former, les entraîner', 3, 'Social'),
('3B', 'Vous aimez les changements ou les personnes ', 3, 'Artistique'),
('3C', 'Vous aimez ne faire qu’une seule chose à la fois et vous ne vous laissez pas distraire', 3, 'Conventionnel'),
('3D', 'Vous aimez donner des ordres ou consignes et organiser l’activité des autres', 3, 'Entrepreneur'),
('3E', 'Vous aimez tirer vos propres conclusions de l’analyse d’une situation donnée', 3, 'Investigatif'),
('3F', 'Vous aimez conduire des véhicules ou faire fonctionner des machines', 3, 'Realiste'),
('4A', 'Vous aimez fabriquer ou réparer des objets', 4, 'Realiste'),
('4B', 'Vous aimez ne pas savoir précisément ce que vous avez à faire', 4, 'Artistique'),
('4C', 'Vous aimez mettre en œuvre des « bonnes pratiques » acquises par l’expérience', 4, 'Conventionnel'),
('4D', 'Vous aimez faire preuve d’initiative et prendre des décisions rapides', 4, 'Entrepreneur'),
('4E', 'Vous aimez écouter, dialoguer, essayer de comprendre les autres', 4, 'Social'),
('4F', 'Vous aimez vous fier à votre jugement pour décider comment faire les choses', 4, 'Investigatif'),
('5A', 'Vous aimez faire plusieurs activités en même temps, ou passer d’une action à l’autre', 5, 'Artistique'),
('5B', 'Vous aimez décider de ce qui doit être fait', 5, 'Entrepreneur'),
('5C', 'Vous aimez rencontrer des gens nouveaux', 5, 'Social'),
('5D', 'Vous aimez vérifier une conclusion par des tests ou des informations complémentaires', 5, 'Investigatif'),
('5E', 'Vous aimez appuyer vos conclusions sur des bases déjà prouvées', 5, 'Conventionnel'),
('5F', 'Vous aimez bricoler, utiliser des outils tels que tournevis, ciseaux, pinces, etc.…', 5, 'Realiste'),
('6A', 'Vous aimez résoudre les problèmes de façon rationnelle, étape par étape', 6, 'Investigatif'),
('6B', 'Vous aimez la nature, les plantes, les animaux…', 6, 'Realiste'),
('6C', 'Vous aimez respecter les valeurs que vous vous êtes fixées', 6, 'Conventionnel'),
('6D', 'Vous aimez faire un travail en commun avec d’autres', 6, 'Social'),
('6E', 'Vous aimez relever des défis', 6, 'Entrepreneur'),
('6F', 'Vous aimez vous fier à votre intuition pour prendre des décisions', 6, 'Artistique'),
('7A', 'Vous aimez convaincre les autres d’agir d’une certaine façon', 7, 'Entrepreneur'),
('7B', 'Vous aimez résoudre un problème sans avoir recours à une méthode logique', 7, 'Artistique'),
('7C', ' Vous aimez prendre une décision après une réflexion, si possible logique', 7, 'Investigatif'),
('7D', 'Vous aimez suivre attentivement un plan pour atteindre le meilleur résultat possible', 7, 'Conventionnel'),
('7E', 'Vous aimez écouter les autres et les conseiller sur la façon de résoudre leurs problèmes', 7, 'Social'),
('7F', 'Vous aimez trouver une solution concrète, réaliste et simple aux problèmes', 7, 'Realiste'),
('8A', 'Vous aimez concevoir ou améliorer les méthodes de travail', 8, 'Investigatif'),
('8B', 'Vous aimez utiliser votre « bon sens »', 8, 'Realiste'),
('8C', 'Vous aimez rendre service, venir en aide à d''autres personnes', 8, 'Social'),
('8D', 'Vous aimez répondre aux objections de vos interlocuteurs pour mieux les convaincre', 8, 'Entrepreneur'),
('8E', ' Vous aimez montrer votre originalité', 8, 'Artistique'),
('8F', 'Vous aimez travailler avec soin pour obtenir un résultat parfait', 8, 'Conventionnel'),
('9A', 'Vous aimez ou aimeriez animer des activités collectives, associatives…', 9, 'Social'),
('9B', ' Vous aimez ou aimeriez étudier la physique, la biologie, ou la technologie', 9, 'Investigatif'),
('9C', 'Vous aimez démonter un appareil pour le réparer vous-même', 9, 'Realiste'),
('9D', 'Vous aimez discuter avec un commerçant pour obtenir des réductions de prix', 9, 'Entrepreneur'),
('9E', 'Vous aimez exprimer vos idées, vos points de vue ou vos émotions', 9, 'Artistique'),
('9F', 'Vous aimez rédiger un résumé, une lettre, un compte-rendu', 9, 'Conventionnel'),
('10A', 'Vous aimez faire face aux situations urgentes ou imprévues', 10, 'Entrepreneur'),
('10B', 'Vous aimez vous occuper de démarches administratives ou d’ordre juridique', 10, 'Conventionnel'),
('10C', 'Vous aimez ou aimeriez faire des reportages, écrire des articles, etc…', 10, 'Social'),
('10D', 'Vous aimez chercher à comprendre et à expliquer le pourquoi des choses et des êtres', 10, 'Investigatif'),
('10E', 'Vous aimez imaginer des solutions qui sortent de l’ordinaire', 10, 'Artistique'),
('10F', 'Vous aimez ou aimeriez utiliser un objet que vous avez fabriqué vous-même', 10, 'Realiste'),
('11A', ' Vous aimez apprendre aux autres ce que vous savez', 11, 'Social'),
('11B', 'Vous aimez collectionner des choses : timbres, cartes postales, pierres, etc.…', 11, 'Realiste'),
('11C', 'Vous aimez passer une grande partie de votre temps sur des documents écrits', 11, 'Conventionnel'),
('11D', 'Vous aimez ou aimeriez vendre des produits ou services', 11, 'Entrepreneur'),
('11E', 'Vous aimez vous servir d’un microscope ou autre appareil de mesure…', 11, 'Investigatif'),
('11F', 'Vous aimez ou aimeriez avoir des loisirs créatifs : peinture, musique…', 11, 'Artistique'),
('12A', 'Vous aimez classer, ordonner des documents ou des objets', 12, 'Conventionnel'),
('12B', 'Vous aimez conduire une discussion, un débat', 12, 'Entrepreneur'),
('12C', 'Vous aimez échanger des idées avec les autres', 12, 'Social'),
('12D', 'Vous aimez que ce que vous faites débouche sur des résultats concrets', 12, 'Realiste'),
('12E', 'Vous aimez ou aimeriez mettre au point et réaliser des expériences scientifiques', 12, 'Investigatif'),
('12F', 'Vous aimez étudier ou inventer plusieurs solutions pour répondre à un problème', 12, 'Artistique');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
