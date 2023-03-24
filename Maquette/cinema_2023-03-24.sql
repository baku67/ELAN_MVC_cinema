-- --------------------------------------------------------
-- Hôte:                         127.0.0.1
-- Version du serveur:           8.0.30 - MySQL Community Server - GPL
-- SE du serveur:                Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Listage de la structure de la base pour basile_cinema
CREATE DATABASE IF NOT EXISTS `basile_cinema` /*!40100 DEFAULT CHARACTER SET latin1 */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `basile_cinema`;

-- Listage de la structure de table basile_cinema. actor
CREATE TABLE IF NOT EXISTS `actor` (
  `actor_id` int NOT NULL AUTO_INCREMENT,
  `person_id` int DEFAULT NULL,
  `type` varchar(50) DEFAULT 'actor',
  PRIMARY KEY (`actor_id`),
  KEY `FK_actor_person` (`person_id`),
  CONSTRAINT `FK_actor_person` FOREIGN KEY (`person_id`) REFERENCES `person` (`person_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

-- Listage des données de la table basile_cinema.actor : ~8 rows (environ)
DELETE FROM `actor`;
INSERT INTO `actor` (`actor_id`, `person_id`, `type`) VALUES
	(1, 1, 'actor'),
	(2, 2, 'actor'),
	(3, 3, 'actor'),
	(4, 6, 'actor'),
	(5, 7, 'actor'),
	(7, 11, 'actor'),
	(8, 12, 'actor'),
	(10, 16, 'actor');

-- Listage de la structure de table basile_cinema. casting
CREATE TABLE IF NOT EXISTS `casting` (
  `movie_id` int NOT NULL,
  `actor_id` int NOT NULL,
  `role_id` int NOT NULL,
  KEY `movie_id` (`movie_id`),
  KEY `actor_id` (`actor_id`),
  KEY `role_id` (`role_id`),
  CONSTRAINT `FK_casting_actor` FOREIGN KEY (`actor_id`) REFERENCES `actor` (`actor_id`),
  CONSTRAINT `FK_casting_movie` FOREIGN KEY (`movie_id`) REFERENCES `movie` (`movie_id`),
  CONSTRAINT `FK_casting_role` FOREIGN KEY (`role_id`) REFERENCES `role` (`role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Listage des données de la table basile_cinema.casting : ~8 rows (environ)
DELETE FROM `casting`;
INSERT INTO `casting` (`movie_id`, `actor_id`, `role_id`) VALUES
	(1, 1, 2),
	(1, 2, 3),
	(1, 7, 3),
	(3, 1, 4),
	(4, 8, 7),
	(4, 1, 5),
	(16, 10, 9),
	(15, 10, 9),
	(3, 1, 2),
	(2, 1, 4);

-- Listage de la structure de table basile_cinema. director
CREATE TABLE IF NOT EXISTS `director` (
  `director_id` int NOT NULL AUTO_INCREMENT,
  `person_id` int DEFAULT NULL,
  `type` varchar(50) DEFAULT 'director',
  PRIMARY KEY (`director_id`),
  KEY `FK_director_person` (`person_id`),
  CONSTRAINT `FK_director_person` FOREIGN KEY (`person_id`) REFERENCES `person` (`person_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- Listage des données de la table basile_cinema.director : ~5 rows (environ)
DELETE FROM `director`;
INSERT INTO `director` (`director_id`, `person_id`, `type`) VALUES
	(1, 4, 'director'),
	(2, 5, 'director'),
	(3, 9, 'director'),
	(4, 10, 'director'),
	(6, 17, 'director');

-- Listage de la structure de table basile_cinema. movie
CREATE TABLE IF NOT EXISTS `movie` (
  `movie_id` int NOT NULL AUTO_INCREMENT,
  `movie_title` varchar(255) NOT NULL,
  `movie_frenchPublishDate` date DEFAULT NULL,
  `movie_length` int NOT NULL DEFAULT '0',
  `movie_synopsis` text,
  `movie_rating` tinyint DEFAULT NULL,
  `movie_imgUrl` varchar(255) DEFAULT NULL,
  `director_id` int DEFAULT NULL,
  `create_Time` datetime DEFAULT CURRENT_TIMESTAMP,
  `type` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT 'movie',
  PRIMARY KEY (`movie_id`),
  KEY `movie_director` (`director_id`),
  CONSTRAINT `movie` FOREIGN KEY (`director_id`) REFERENCES `director` (`director_id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

-- Listage des données de la table basile_cinema.movie : ~6 rows (environ)
DELETE FROM `movie`;
INSERT INTO `movie` (`movie_id`, `movie_title`, `movie_frenchPublishDate`, `movie_length`, `movie_synopsis`, `movie_rating`, `movie_imgUrl`, `director_id`, `create_Time`, `type`) VALUES
	(1, 'Titanic', '1997-12-05', 195, 'En septembre 1996, Brock Lovett est le coordinateur d\'une équipe qui fouille méticuleusement l\'épave du célèbre Titanic, paquebot géant réputé insubmersible qui connut pourtant un destin tragique. Lovett espère mettre la main sur le Cœur de l\'Océan, un collier de diamants unique à la valeur inestimable, porté par Louis XVI, dont la découverte lui apporterait la gloire (ce bijou, en réalité fictif, est inspiré du diamant bleu de la Couronne). Lors de sa sixième plongée en sous-marin, il remonte des profondeurs un coffre-fort dont il espère qu\'il contient le précieux objet. Mais il n\'y trouve que quelques vieux billets de banque et un dessin représentant une jeune femme nue portant le fameux bijou en pendentif.', 4, './uploads/moviesImg/titanic.jpg', 2, '2023-03-22 00:25:50', 'movie'),
	(2, 'Full Metal Jacket', '1987-06-10', 116, 'Le film est centré sur le personnage de J.T. Davis, surnommé « Joker » (« Guignol » dans la version française), un jeune engagé volontaire incorporant le corps des Marines des États-Unis à la fin des années 1960, à l\'époque de la guerre du Viêt Nam.', 5, './uploads/moviesImg/fullMetalJacket.jpg', 1, '2023-03-21 00:25:50', 'movie'),
	(3, 'La Plage', '2000-01-01', 115, 'Richard est un jeune Américain parti en Thaïlande pour vivre une expérience en marge des circuits touristiques. Il est vite déçu de ne trouver que des Occidentaux en mal de sensations dans le quartier des routards de Kaosan. Une nuit, à l\'hôtel, il rencontre Daffy, un homme fou qui lui parle d\'une île légendaire et paradisiaque où vivrait une communauté repliée sur elle-même, en communion avec la nature.', 3, './uploads/moviesImg/laPlage.jpg', 4, '2023-03-20 00:25:50', 'movie'),
	(4, 'Shutter Island', '2010-02-01', 130, 'Shutter Island est un thriller psychologique américain réalisé par Martin Scorsese et sorti en 2010. C\'est l\'adaptation du roman du même nom de l\'écrivain Dennis Lehane publié en 2003.', 4, './uploads/moviesImg/shutterIsland.jpg', 3, '2023-03-19 00:25:50', 'movie'),
	(15, 'Inglorious Basterds', '2013-03-21', 152, 'In 1941, SS-Standartenführer Hans Landa interrogates French farmer Perrier LaPadite as to the whereabouts of a Jewish family, the Dreyfuses. Landa suspects the LaPadites are hiding the Dreyfuses under their floorboards; LaPadite tearfully confirms it in order to spare his own family. The soldiers shoot through the floorboards, killing all but Shosanna Dreyfus. Landa, mockingly, spares Shosanna\'s life and lets her escape.', 4, './uploads/moviesImg/ingloriousBasterds.jpg', 6, '2023-03-17 00:25:50', 'movie'),
	(16, 'DjangoUnchained', '2015-02-26', 126, 'In 1858 Texas, brothers Ace and Dicky Speck drive a group of shackled black slaves on foot. Among them is Django, sold off and separated from his wife Broomhilda von Shaft, a house slave who speaks German and English. They are stopped by Dr. King Schultz, a German dentist-turned-bounty hunter seeking to buy Django for his knowledge of the three outlaw Brittle brothers, overseers at the plantation of Django\'s previous owner and for whom Schultz has a warrant. When Ace refuses to sell Django to Schultz and cocks his gun, Schultz kills him and shoots Dicky\'s horse in order to pin him to the ground; he advises the freed slaves to take the opportunity for revenge. Schultz offers Django his freedom and $75 in exchange for help tracking down the Brittles.', 3, './uploads/moviesImg/djangoUnchained.jpg', 6, '2023-03-15 00:25:50', 'movie');

-- Listage de la structure de table basile_cinema. moviegenrelist
CREATE TABLE IF NOT EXISTS `moviegenrelist` (
  `movie_id` int NOT NULL DEFAULT '0',
  `movieGenre_id` int NOT NULL DEFAULT '0',
  KEY `FK_moviegenrelist_movie` (`movie_id`),
  KEY `FK_moviegenrelist_movie_genre` (`movieGenre_id`),
  CONSTRAINT `FK_moviegenrelist_movie` FOREIGN KEY (`movie_id`) REFERENCES `movie` (`movie_id`),
  CONSTRAINT `FK_moviegenrelist_movie_genre` FOREIGN KEY (`movieGenre_id`) REFERENCES `movie_genre` (`movieGenre_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Listage des données de la table basile_cinema.moviegenrelist : ~12 rows (environ)
DELETE FROM `moviegenrelist`;
INSERT INTO `moviegenrelist` (`movie_id`, `movieGenre_id`) VALUES
	(1, 2),
	(1, 1),
	(2, 3),
	(2, 4),
	(2, 5),
	(2, 6),
	(3, 1),
	(3, 5),
	(4, 4),
	(4, 5),
	(15, 6),
	(15, 3),
	(16, 1);

-- Listage de la structure de table basile_cinema. movie_genre
CREATE TABLE IF NOT EXISTS `movie_genre` (
  `movieGenre_id` int NOT NULL AUTO_INCREMENT,
  `movieGenre_label` varchar(150) NOT NULL DEFAULT '0',
  `genreImgUrl` varchar(150) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `genreColor` varchar(50) DEFAULT 'black',
  PRIMARY KEY (`movieGenre_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- Listage des données de la table basile_cinema.movie_genre : ~6 rows (environ)
DELETE FROM `movie_genre`;
INSERT INTO `movie_genre` (`movieGenre_id`, `movieGenre_label`, `genreImgUrl`, `genreColor`) VALUES
	(1, 'drame', './uploads/genres/dramaRed.png', 'red'),
	(2, 'romance', './uploads/genres/romanticPink.png', '#ff7990'),
	(3, 'action', './uploads/genres/action2.png', '#ffce00'),
	(4, 'horreur', './uploads/genres/horrorPurple.png', 'purple'),
	(5, 'psychologique', './uploads/genres/psyBlue.png', '#005dff'),
	(6, 'guerre', NULL, 'argile');

-- Listage de la structure de table basile_cinema. news
CREATE TABLE IF NOT EXISTS `news` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(250) DEFAULT NULL,
  `content` text,
  `publishDate` date DEFAULT NULL,
  `author_id` int DEFAULT NULL,
  `imgUrl` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- Listage des données de la table basile_cinema.news : ~5 rows (environ)
DELETE FROM `news`;
INSERT INTO `news` (`id`, `title`, `content`, `publishDate`, `author_id`, `imgUrl`) VALUES
	(1, 'testTitle', '<span class="newsStrong">Tom Cruise</span> : première affiche vertigineuse pour Mission Impossible 7 !', '2023-03-17', NULL, './uploads/newsImg/test4.png'),
	(2, 'testTitle', '<span class="newsStrong">Jim Carrey</span> les fesses à l\'air : le film de ses débuts qu\'il préférerait sans doute oublier', '2023-03-19', NULL, './uploads/newsImg/test2.png'),
	(3, 'testTitle', 'Ce soir à la télé : un film où <span class="newsStrong">Brad Pitt</span> a encore oublié sa chemise…', '2023-03-18', NULL, './uploads/newsImg/test3.png'),
	(4, 'testTitle', '<span class="newsStrong">Brendan Fraser</span> : les 5 meilleurs films de l\'acteur à rattraper d\'urgence après son Oscar !', '2023-03-21', NULL, './uploads/newsImg/test1.png');

-- Listage de la structure de table basile_cinema. person
CREATE TABLE IF NOT EXISTS `person` (
  `person_id` int NOT NULL AUTO_INCREMENT,
  `person_firstName` varchar(150) NOT NULL,
  `person_lastName` varchar(150) NOT NULL,
  `person_gender` varchar(10) DEFAULT NULL,
  `person_birthDate` date DEFAULT NULL,
  `person_imgUrl` varchar(150) DEFAULT NULL,
  `create_Time` datetime DEFAULT CURRENT_TIMESTAMP,
  `type` varchar(50) DEFAULT 'person',
  PRIMARY KEY (`person_id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

-- Listage des données de la table basile_cinema.person : ~13 rows (environ)
DELETE FROM `person`;
INSERT INTO `person` (`person_id`, `person_firstName`, `person_lastName`, `person_gender`, `person_birthDate`, `person_imgUrl`, `create_Time`, `type`) VALUES
	(1, 'Leonardo', 'Di Caprio', 'homme', '1980-05-25', './uploads/personImg/leonardoDiCaprio.png', '2023-03-22 00:20:03', 'actor'),
	(2, 'Kate', 'Winslet', 'femme', '1975-08-05', './uploads/personImg/kateWingslet.png', '2022-03-22 00:20:03', 'actor'),
	(3, 'Billy', 'Zane', 'homme', '1925-08-05', './uploads/personImg/billyZane.png', '2022-03-22 00:20:03', 'actor'),
	(4, 'Stanley', 'Kubrik', 'homme', '1928-06-26', './uploads/personImg/stanleyKubrik.png', '2022-03-22 00:20:03', 'director'),
	(5, 'James', 'Cameron', 'homme', '1954-05-16', './uploads/personImg/jamesCameron.png', '2019-03-22 00:20:03', 'director'),
	(6, 'Matthew', 'Modine', 'homme', '1959-03-29', './uploads/personImg/matthewModine.jpg', '2017-03-22 00:20:03', 'actor'),
	(7, 'Adam', 'Baldwin', 'homme', '1962-02-27', './uploads/personImg/adamBaldwin.jpg', '2016-03-22 00:20:03', 'actor'),
	(9, 'Martin', 'Scorsese', 'homme', '1942-09-17', './uploads/personImg/martinScorsese.png', '2014-03-22 00:20:03', 'director'),
	(10, 'Danny', 'Boyle', 'homme', '1956-08-20', './uploads/personImg/dannyBoyle.jpg', '2012-03-22 00:20:03', 'director'),
	(11, 'Gloria', 'Stuart', 'femme', '1910-04-05', './uploads/personImg/gloriaStuart.png', '2007-03-22 00:20:03', 'actor'),
	(12, 'Ben', 'Kingsley', 'homme', '1971-02-02', './uploads/personImg/benKingsley.jpg', '2005-03-22 00:20:03', 'actor'),
	(16, 'Christoph', 'Waltz', 'homme', '1977-03-21', './uploads/personImg/christopheWaltz.jpg', '2002-03-22 00:20:03', 'actor'),
	(17, 'Quentin', 'Tarantino', 'homme', '2092-05-25', './uploads/personImg/quentinTarantino.png', '1999-03-22 00:20:03', 'director');

-- Listage de la structure de table basile_cinema. role
CREATE TABLE IF NOT EXISTS `role` (
  `role_id` int NOT NULL AUTO_INCREMENT,
  `role_name` varchar(150) DEFAULT NULL,
  `type` varchar(50) DEFAULT 'role',
  PRIMARY KEY (`role_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

-- Listage des données de la table basile_cinema.role : ~7 rows (environ)
DELETE FROM `role`;
INSERT INTO `role` (`role_id`, `role_name`, `type`) VALUES
	(1, 'James Bond', 'role'),
	(2, 'Jack Dawson', 'role'),
	(3, 'Rose DeWitt Bukater', 'role'),
	(4, 'Richard', 'role'),
	(5, 'Teddy Daniels', 'role'),
	(7, 'Docteur Cawley', 'role'),
	(9, 'Le mec là', 'role');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
