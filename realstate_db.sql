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


-- Listage de la structure de la base pour realestate_db
DROP DATABASE IF EXISTS `realestate_db`;
CREATE DATABASE IF NOT EXISTS `realestate_db` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `realestate_db`;

-- Listage de la structure de table realestate_db. amenities
DROP TABLE IF EXISTS `amenities`;
CREATE TABLE IF NOT EXISTS `amenities` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `amenitie_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table realestate_db.amenities : ~18 rows (environ)
DELETE FROM `amenities`;
INSERT INTO `amenities` (`id`, `amenitie_name`, `created_at`, `updated_at`) VALUES
	(2, 'Air conditionnée', NULL, NULL),
	(3, 'Service de nettoyage', NULL, NULL),
	(4, 'Salle de gym', NULL, NULL),
	(5, 'Lave-vaisselle', NULL, '2023-05-31 09:20:04'),
	(6, 'Flux de bois dur', NULL, NULL),
	(7, 'Piscine', NULL, NULL),
	(8, 'Toillette externe', NULL, NULL),
	(9, 'Four micro onde', NULL, NULL),
	(10, 'Animaux acceptés', NULL, NULL),
	(11, 'Terrain de basketball', NULL, NULL),
	(12, 'Réfrigérateur', NULL, NULL),
	(13, 'Ascenseur', NULL, NULL),
	(14, 'Balcon ou Terrasse', NULL, NULL),
	(15, 'Conciergerie 24h/24', NULL, NULL),
	(16, 'Interphone', NULL, NULL),
	(17, 'Centre médical de premiers secours', NULL, NULL),
	(18, 'Sécurité de vidéosurveillance', NULL, NULL),
	(19, 'Electricité de secours', NULL, NULL);

-- Listage de la structure de table realestate_db. blog_categories
DROP TABLE IF EXISTS `blog_categories`;
CREATE TABLE IF NOT EXISTS `blog_categories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `category_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table realestate_db.blog_categories : ~6 rows (environ)
DELETE FROM `blog_categories`;
INSERT INTO `blog_categories` (`id`, `category_name`, `category_slug`, `created_at`, `updated_at`) VALUES
	(1, 'Maison refaite', 'maison-refaite', '2023-07-06 16:37:56', NULL),
	(2, 'Architecture', 'architecture', '2023-07-06 16:38:35', NULL),
	(3, 'Astuces et conseils', 'astuces-et-conseils', '2023-07-06 16:39:04', NULL),
	(4, 'Interieur', 'interieur', '2023-07-06 16:39:49', NULL),
	(5, 'Immobilier', 'immobilier', '2023-07-06 16:41:02', NULL),
	(6, 'Location et vente de maison', 'location-et-vente-de-maison', '2023-07-06 19:41:53', NULL);

-- Listage de la structure de table realestate_db. blog_posts
DROP TABLE IF EXISTS `blog_posts`;
CREATE TABLE IF NOT EXISTS `blog_posts` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `blogcat_id` int NOT NULL,
  `user_id` int DEFAULT NULL,
  `post_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `post_slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `post_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `short_desc` text COLLATE utf8mb4_unicode_ci,
  `long_desc` text COLLATE utf8mb4_unicode_ci,
  `post_tags` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table realestate_db.blog_posts : ~5 rows (environ)
DELETE FROM `blog_posts`;
INSERT INTO `blog_posts` (`id`, `blogcat_id`, `user_id`, `post_title`, `post_slug`, `post_image`, `short_desc`, `long_desc`, `post_tags`, `created_at`, `updated_at`) VALUES
	(1, 6, 1, 'Location d\'un appartement', 'location-d\'un-appartement', 'upload/posts/1771027604832563jpg', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Alias, blanditiis!', '<div>\r\n<div style="text-align: justify;">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Praesentium repudiandae esse non fugiat, error explicabo, distinctio facilis repellat atque fuga fugit! Minima dolore velit error sed perferendis ratione inventore sequi facilis accusamus sint tempore placeat porro obcaecati, corporis maiores. Hic eum eveniet quod, ex animi earum voluptatum. Nesciunt, deleniti veritatis, neque dolore, sequi facilis pariatur nulla ut illo quaerat illum? Tenetur optio praesentium omnis minus, voluptatem vitae repudiandae asperiores commodi. Sunt libero molestias nobis autem eaque voluptatem tenetur! Voluptatum assumenda rem cupiditate vero perspiciatis, voluptatibus magni doloribus voluptate totam saepe a itaque, sed sequi praesentium explicabo est. Iusto, doloribus velit.</div>\r\n<div style="text-align: justify;">&nbsp;</div>\r\n<div style="text-align: justify;">\r\n<div>\r\n<div style="text-align: center;"><span style="color: rgb(53, 152, 219); font-size: 14pt; font-family: \'comic sans ms\', sans-serif;"><strong>Lorem ipsum dolor sit amet consectetur.</strong></span></div>\r\n<div>&nbsp;</div>\r\n<div>\r\n<div>\r\n<div>\r\n<ul>\r\n<li>Lorem ipsum dolor sit amet consectetur adipisicing elit. Fugit consectetur esse iste omnis commodi magnam deleniti quia, vel veritatis modi obcaecati, impedit cum ex enim atque debitis doloremque.</li>\r\n<li>\r\n<div>\r\n<div>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ducimus earum quaerat possimus dolores ipsa aut ex voluptas a!</div>\r\n</div>\r\n</li>\r\n</ul>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>', 'Immobilier,Location,Vente,Bail', '2023-07-07 11:07:29', '2023-07-10 10:05:45'),
	(2, 3, 1, 'Including Animation In Your Design System', 'including-animation-in-your-design-system', 'upload/posts/1771027573500017jpg', 'Enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat duis.', '<p style="text-align: justify;">Lorem ipsum dolor sit amet consectetur adipisicing sed do eiusmod tempor incididunt labore dolore magna aliqua enim minim veniam quis nostrud exercitation ullamco laboris nisi aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>\r\n<p style="text-align: justify;">Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed perspiciatis unde omnis iste natus error sit voluptem accusantium doloremque laudantium.</p>\r\n<blockquote>\r\n<h4 style="text-align: left;">&ldquo;Enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat duis.&rdquo;</h4>\r\n</blockquote>\r\n<p style="text-align: justify;">Sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed perspiciatis unde omnis iste natus error sit voluptem accusantium doloremque laudantium totam rem aperiam.</p>', 'Immobilier,Conseils,Astuces,Interieur,Maison refaite', '2023-07-07 11:12:26', '2023-07-10 10:05:15'),
	(4, 5, 1, 'Secret pour basculer totalement votre immobilier', 'secret-pour-basculer-totalement-votre-immobilier', 'upload/posts/1771027231477031jpg', 'Lorem ipsum dolor consectetur adipisicing sed.', '<div>\r\n<div>Lorem ipsum dolor sit amet consectetur adipisicing elit. Porro, quo repellat repellendus excepturi possimus adipisci, necessitatibus laudantium fugit accusantium quibusdam pariatur harum similique aspernatur maiores inventore incidunt earum quis qui. Quisquam excepturi, eius iure aperiam officiis optio voluptatum voluptates. Delectus nihil veniam animi eum itaque sapiente soluta eveniet fuga quasi maiores in, consequuntur officiis quos nobis nulla explicabo unde fugit debitis.</div>\r\n<div>&nbsp;</div>\r\n<div style="text-align: left;"><em>\'\'Cumque quaerat eos, ullam, laboriosam aliquid sequi magni, repellendus necessitatibus consequuntur delectus dolore aspernatur placeat error! Voluptates laborum maxime necessitatibus consequuntur possimus nemo quis dolorum, illum magni error perferendis quibusdam numquam.\'\'</em></div>\r\n<div>&nbsp;</div>\r\n<div>Deserunt quod dolores ipsa debitis, voluptatem tempora. Cupiditate soluta omnis accusamus optio consequatur vero ipsam, rerum perferendis voluptate iure nemo quisquam laboriosam quibusdam voluptatem corrupti porro totam cumque temporibus obcaecati voluptas aperiam illum nostrum! Non iusto in assumenda itaque, saepe laudantium obcaecati ad temporibus maiores tenetur at voluptatibus voluptas ex consequuntur veniam numquam ab sint voluptates? Iste, voluptates! Enim delectus sapiente corrupti, quia iusto tempore sint dolorum alias, expedita illo culpa. Veniam laborum cumque nesciunt illum aliquid. Error sunt alias autem facere voluptatibus tempore expedita numquam, cumque, ab assumenda enim aspernatur voluptatem! Error consequatur laborum atque voluptatem unde cumque, harum blanditiis soluta laudantium fuga maiores? Pariatur, expedita et.</div>\r\n</div>', 'Immobilier,Vente et location,Astuces', '2023-07-07 15:54:53', '2023-07-10 10:04:26'),
	(5, 3, 1, 'Cette semaine, j\'ai pensé que ce serait bien', 'cette-semaine,-j\'ai-pensé-que-ce-serait-bien', 'upload/posts/1771026896192798jpg', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Soluta, eius.', '<div>\r\n<div>Lorem ipsum dolor sit amet consectetur adipisicing elit. Tempore quae architecto magnam eveniet natus soluta laudantium quos sint nihil. Hic nobis, repellendus iusto libero architecto laboriosam at aut, officiis consequuntur qui eius, deleniti ipsum praesentium atque commodi esse. Fuga id excepturi pariatur! Exercitationem quisquam dolores sit officia nulla explicabo aliquid minus aut natus ipsum qui commodi optio quod eos provident reprehenderit aliquam incidunt et nam eaque, dolorem iusto blanditiis minima consequuntur. Corporis expedita iste assumenda minima recusandae laboriosam!</div>\r\n<br>\r\n<div>\r\n<ul>\r\n<li><span style="font-size: 10pt; font-family: \'trebuchet ms\', geneva, sans-serif;">Quam doloremque cumque ipsa aspernatur sequi adipisci dolores, a cupiditate distinctio nam expedita ipsum, quisquam iusto veniam iure, fugit harum quis dicta consequuntur.</span></li>\r\n</ul>\r\n</div>\r\n<div>\r\n<ul>\r\n<li><span style="font-size: 10pt; font-family: \'trebuchet ms\', geneva, sans-serif;">Quibusdam magni quae aspernatur cum dignissimos vel quo ipsum dolore amet quam quidem ratione odit accusamus odio obcaecati explicabo, laboriosam laborum!</span></li>\r\n</ul>\r\n</div>\r\n<br>\r\n<div>Libero laboriosam quae minus natus itaque maxime rem modi voluptatem tempore molestias eaque molestiae accusamus fugit quos nemo, nostrum amet odit consectetur, deleniti quasi iure soluta harum fuga! Recusandae veritatis repudiandae iure, soluta eveniet obcaecati modi placeat voluptate cum repellat, alias cupiditate. Amet dolor qui tempore doloribus necessitatibus veniam distinctio fugiat optio harum, cumque magni fuga quod quidem molestias accusantium rerum iste eius vitae voluptas adipisci eaque porro ex voluptatem exercitationem. Doloribus, maiores dolore temporibus voluptas aliquam expedita cum molestias! Quae, voluptatem aliquam? Soluta non sunt aliquam iste eos omnis culpa ab velit similique, dolorum ea eligendi dolores debitis totam nemo quidem repellat laborum reprehenderit magni consequuntur dicta enim. Blanditiis deserunt vero officiis quidem alias mollitia quisquam, explicabo assumenda magnam pariatur iste eos quae asperiores ipsa odit impedit incidunt aliquam ratione ipsum iure magni earum quo? Accusantium, recusandae!</div>\r\n</div>', 'Immobilier,Visite de propriété,Achat de maison', '2023-07-07 15:58:49', '2023-07-10 09:55:31'),
	(6, 3, 1, 'Nous vous apporterons le meilleur de Donec Luctus', 'nous-vous-apporterons-le-meilleur-de-donec-luctus', 'upload/posts/1771026782599727jpg', 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Amet, deleniti.', '<div>\r\n<div style="text-align: justify;">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Minima ad, alias quia iusto natus odit. Perspiciatis possimus dolorum ex quos tempora ullam aspernatur ab porro optio, magni asperiores nobis magnam veritatis doloremque incidunt, dolorem eaque reiciendis laudantium fuga libero accusantium quisquam quo sequi? Temporibus voluptatem, sunt asperiores, quisquam dolore unde quaerat vitae dolores, sapiente quo cumque odit autem ad suscipit. Natus fugit ducimus, deserunt dolorem reprehenderit maxime dolorum.</div>\r\n<br>\r\n<div style="text-align: justify;">Doloremque optio dolore a, voluptatem voluptatibus vero error sapiente alias cupiditate esse quibusdam soluta perferendis blanditiis at deleniti ex? Officia iure reiciendis saepe sequi? Corporis iste reprehenderit totam voluptas molestiae amet itaque accusantium eveniet! Hic quia repudiandae ipsam maiores incidunt laboriosam assumenda fugit modi. Labore aperiam assumenda fuga maiores eius adipisci impedit! Similique, iste nobis! Alias qui excepturi eos nulla quaerat quo laborum molestiae dolores nisi commodi! Dignissimos magnam dolore ipsum qui quidem nesciunt iure nihil quae modi provident sequi eum impedit ex, alias quasi officia perspiciatis possimus labore voluptatibus. Culpa, ratione.</div>\r\n</div>', 'Immobilier,Restauration,Nouriture,Vente et location', '2023-07-07 16:01:49', '2023-07-10 09:55:21');

-- Listage de la structure de table realestate_db. comments
DROP TABLE IF EXISTS `comments`;
CREATE TABLE IF NOT EXISTS `comments` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `post_id` int NOT NULL,
  `parent_id` int DEFAULT NULL,
  `subject` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table realestate_db.comments : ~4 rows (environ)
DELETE FROM `comments`;
INSERT INTO `comments` (`id`, `user_id`, `post_id`, `parent_id`, `subject`, `message`, `created_at`, `updated_at`) VALUES
	(1, 3, 6, NULL, 'Juste un coucou', 'Salut là-bas. Comment allez-vous ce soir ? Quand à moi, je vais bien par la grâce de Dieu.\r\nMerci.', '2023-07-10 19:02:30', NULL),
	(2, 4, 6, NULL, 'La bouffe', 'Comment se procurer des frites pareilles ? J\'ai trop faim en ce moment même :)', '2023-07-10 19:07:12', NULL),
	(3, 1, 6, 2, 'Merci pour le commentaire sur la bouffe', 'Merci pour votre comment. Nous rentrerons en contact avec vous tout l\'heure pour vous donner plus de détails.', '2023-07-10 20:39:46', NULL),
	(6, 1, 6, 1, 'Salutations', 'Nous nous portons à merveille par la grâce divine. Comment allez-vous ?', '2023-07-11 10:12:49', NULL);

-- Listage de la structure de table realestate_db. compares
DROP TABLE IF EXISTS `compares`;
CREATE TABLE IF NOT EXISTS `compares` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `property_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table realestate_db.compares : ~3 rows (environ)
DELETE FROM `compares`;
INSERT INTO `compares` (`id`, `user_id`, `property_id`, `created_at`, `updated_at`) VALUES
	(1, 4, 4, '2023-06-20 20:00:14', NULL),
	(4, 4, 5, '2023-06-21 10:19:18', NULL),
	(5, 3, 10, '2023-06-24 22:02:37', NULL);

-- Listage de la structure de table realestate_db. facilities
DROP TABLE IF EXISTS `facilities`;
CREATE TABLE IF NOT EXISTS `facilities` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `property_id` int NOT NULL,
  `facility_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `distance` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=66 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table realestate_db.facilities : ~36 rows (environ)
DELETE FROM `facilities`;
INSERT INTO `facilities` (`id`, `property_id`, `facility_name`, `distance`, `created_at`, `updated_at`) VALUES
	(11, 3, 'Parmacie', '0.6', '2023-06-02 12:04:35', '2023-06-02 12:04:35'),
	(12, 3, 'Arrêt de bus', '0.7', '2023-06-02 12:04:35', '2023-06-02 12:04:35'),
	(13, 3, 'Banque', '1', '2023-06-02 12:04:35', '2023-06-02 12:04:35'),
	(14, 3, 'Centre commercial', '0.2', '2023-06-02 12:04:35', '2023-06-02 12:04:35'),
	(15, 3, 'Plage', '1.5', '2023-06-02 12:04:35', '2023-06-02 12:04:35'),
	(16, 3, 'Hopital', '2.1', '2023-06-02 12:04:35', '2023-06-02 12:04:35'),
	(17, 3, 'Aéroport', '7', '2023-06-02 12:04:35', '2023-06-02 12:04:35'),
	(27, 1, 'Hopital', '0.7', '2023-06-04 10:29:11', '2023-06-04 10:29:11'),
	(28, 1, 'Ecole', '0.6', '2023-06-04 10:29:11', '2023-06-04 10:29:11'),
	(29, 1, 'Banque', '0.5', '2023-06-04 10:29:11', '2023-06-04 10:29:11'),
	(30, 1, 'Aéroport', '17', '2023-06-04 10:29:11', '2023-06-04 10:29:11'),
	(31, 5, 'Hopital', '0.5', '2023-06-09 10:43:24', '2023-06-09 10:43:24'),
	(32, 5, 'Ecole', '0.7', '2023-06-09 10:43:24', '2023-06-09 10:43:24'),
	(33, 5, 'Parmacie', '0.5', '2023-06-09 10:43:24', '2023-06-09 10:43:24'),
	(34, 5, 'Aéroport', '2', '2023-06-09 10:43:24', '2023-06-09 10:43:24'),
	(35, 5, 'Banque', '1', '2023-06-09 10:43:24', '2023-06-09 10:43:24'),
	(36, 5, 'Arrêt de bus', '1.2', '2023-06-09 10:43:24', '2023-06-09 10:43:24'),
	(47, 8, 'Ecole', '1', '2023-06-11 07:41:38', '2023-06-11 07:41:38'),
	(48, 8, 'Centre commercial', '1.2', '2023-06-11 07:41:38', '2023-06-11 07:41:38'),
	(49, 8, 'Parmacie', '0.7', '2023-06-11 07:41:38', '2023-06-11 07:41:38'),
	(50, 8, 'Hopital', '1.5', '2023-06-11 07:41:38', '2023-06-11 07:41:38'),
	(51, 8, 'Banque', '1', '2023-06-11 07:41:38', '2023-06-11 07:41:38'),
	(52, 9, 'Ecole', '1', '2023-06-15 21:04:05', '2023-06-15 21:04:05'),
	(53, 9, 'Parmacie', '2', '2023-06-15 21:04:05', '2023-06-15 21:04:05'),
	(54, 9, 'Super marché', '3', '2023-06-15 21:04:05', '2023-06-15 21:04:05'),
	(55, 9, 'Divertissement', '2', '2023-06-15 21:04:05', '2023-06-15 21:04:05'),
	(56, 10, 'Hopital', '0.3', '2023-06-23 09:34:52', '2023-06-23 09:34:52'),
	(57, 11, 'Super marché', '2', '2023-07-11 13:05:30', '2023-07-11 13:05:30'),
	(58, 11, 'Hopital', '2', '2023-07-11 13:05:30', '2023-07-11 13:05:30'),
	(59, 11, 'Parmacie', '0.7', '2023-07-11 13:05:30', '2023-07-11 13:05:30'),
	(60, 11, 'Ecole', '0.5', '2023-07-11 13:05:30', '2023-07-11 13:05:30'),
	(61, 11, 'Divertissement', '0.5', '2023-07-11 13:05:30', '2023-07-11 13:05:30'),
	(62, 12, 'Hopital', '7', '2023-07-12 16:42:21', '2023-07-12 16:42:21'),
	(63, 12, 'Super marché', '7', '2023-07-12 16:42:21', '2023-07-12 16:42:21'),
	(64, 12, 'Ecole', '1', '2023-07-12 16:42:21', '2023-07-12 16:42:21'),
	(65, 12, 'Arrêt de bus', '1.5', '2023-07-12 16:42:21', '2023-07-12 16:42:21');

-- Listage de la structure de table realestate_db. failed_jobs
DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table realestate_db.failed_jobs : ~0 rows (environ)
DELETE FROM `failed_jobs`;

-- Listage de la structure de table realestate_db. migrations
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table realestate_db.migrations : ~22 rows (environ)
DELETE FROM `migrations`;
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '2014_10_12_000000_create_users_table', 1),
	(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
	(3, '2019_08_19_000000_create_failed_jobs_table', 1),
	(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
	(5, '2023_05_30_121156_create_property_types_table', 2),
	(6, '2023_05_30_203439_create_amenities_table', 3),
	(7, '2023_05_31_065233_create_properties_table', 4),
	(8, '2023_05_31_123807_create_multi_images_table', 4),
	(9, '2023_05_31_124915_create_facilities_table', 4),
	(10, '2023_06_11_065623_create_package_plans_table', 5),
	(11, '2023_06_18_154435_create_wishlists_table', 6),
	(12, '2023_06_19_130922_create_compares_table', 7),
	(13, '2023_06_21_103138_create_property_messages_table', 8),
	(14, '2023_07_01_231706_create_states_table', 9),
	(15, '2023_07_06_095803_create_testimonials_table', 10),
	(16, '2023_07_06_125815_create_blog_categories_table', 11),
	(17, '2023_07_07_084808_create_blog_posts_table', 12),
	(18, '2023_07_10_115700_create_comments_table', 13),
	(19, '2023_07_11_101713_create_schedules_table', 14),
	(20, '2023_07_15_153919_create_smtp_settings_table', 15),
	(21, '2023_07_15_194515_create_site_settings_table', 16),
	(22, '2023_07_16_163201_create_permission_tables', 17);

-- Listage de la structure de table realestate_db. model_has_permissions
DROP TABLE IF EXISTS `model_has_permissions`;
CREATE TABLE IF NOT EXISTS `model_has_permissions` (
  `permission_id` bigint unsigned NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table realestate_db.model_has_permissions : ~0 rows (environ)
DELETE FROM `model_has_permissions`;

-- Listage de la structure de table realestate_db. model_has_roles
DROP TABLE IF EXISTS `model_has_roles`;
CREATE TABLE IF NOT EXISTS `model_has_roles` (
  `role_id` bigint unsigned NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table realestate_db.model_has_roles : ~3 rows (environ)
DELETE FROM `model_has_roles`;
INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
	(1, 'App\\Models\\User', 1),
	(2, 'App\\Models\\User', 13),
	(4, 'App\\Models\\User', 15);

-- Listage de la structure de table realestate_db. multi_images
DROP TABLE IF EXISTS `multi_images`;
CREATE TABLE IF NOT EXISTS `multi_images` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `property_id` int NOT NULL,
  `photo_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=69 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table realestate_db.multi_images : ~47 rows (environ)
DELETE FROM `multi_images`;
INSERT INTO `multi_images` (`id`, `property_id`, `photo_name`, `created_at`, `updated_at`) VALUES
	(2, 1, 'upload/property/multiImg/1767586264540445.jpg', '2023-06-02 10:27:02', NULL),
	(3, 1, 'upload/property/multiImg/1767586264763831.jpg', '2023-06-02 10:27:02', NULL),
	(7, 3, 'upload/property/multiImg/1767592401404349.jpg', '2023-06-02 12:04:35', NULL),
	(8, 3, 'upload/property/multiImg/1767592401649335.jpg', '2023-06-02 12:04:35', NULL),
	(9, 3, 'upload/property/multiImg/1767592401849028.jpg', '2023-06-02 12:04:35', NULL),
	(15, 1, 'upload/property/multiImg/1767723652105349.jpg', '2023-06-03 22:50:50', NULL),
	(16, 1, 'upload/property/multiImg/1767723657544424.jpg', '2023-06-03 22:51:00', NULL),
	(17, 1, 'upload/property/multiImg/1767723667539491.jpg', '2023-06-03 22:51:02', NULL),
	(18, 1, 'upload/property/multiImg/1767723669753851.jpg', '2023-06-03 22:51:07', NULL),
	(24, 5, 'upload/property/multiImg/1768224121680670.jpg', '2023-06-09 10:43:19', '2023-06-09 11:25:34'),
	(25, 5, 'upload/property/multiImg/1768221467797751.jpg', '2023-06-09 10:43:20', NULL),
	(26, 5, 'upload/property/multiImg/1768224294657943.jpg', '2023-06-09 10:43:22', '2023-06-09 11:28:16'),
	(28, 5, 'upload/property/multiImg/1768225245506229.jpg', '2023-06-09 11:43:24', NULL),
	(29, 5, 'upload/property/multiImg/1768225247622668.jpg', '2023-06-09 11:43:26', NULL),
	(30, 5, 'upload/property/multiImg/1768225249832073.jpg', '2023-06-09 11:43:28', NULL),
	(37, 8, 'upload/property/multiImg/1768391216736038.jpg', '2023-06-11 07:41:30', NULL),
	(38, 8, 'upload/property/multiImg/1768391222464792.jpg', '2023-06-11 07:41:33', NULL),
	(39, 8, 'upload/property/multiImg/1768391226148850.jpg', '2023-06-11 07:41:38', NULL),
	(40, 9, 'upload/property/multiImg/1768804096250868.jpg', '2023-06-15 21:03:58', NULL),
	(41, 9, 'upload/property/multiImg/1768804097554781.jpg', '2023-06-15 21:04:01', NULL),
	(42, 9, 'upload/property/multiImg/1768804100711055.jpg', '2023-06-15 21:04:04', NULL),
	(43, 9, 'upload/property/multiImg/1768804103242379.jpg', '2023-06-15 21:04:05', NULL),
	(44, 2, 'upload/property/multiImg/1768986382154979.jpg', '2023-06-17 21:21:20', NULL),
	(45, 2, 'upload/property/multiImg/1768986459775564.jpg', '2023-06-17 21:22:38', NULL),
	(46, 2, 'upload/property/multiImg/1768986465979574.jpg', '2023-06-17 21:22:43', NULL),
	(47, 2, 'upload/property/multiImg/1768986470902946.jpg', '2023-06-17 21:22:50', NULL),
	(48, 2, 'upload/property/multiImg/1768986478723910.jpg', '2023-06-17 21:22:54', NULL),
	(49, 10, 'upload/property/multiImg/1769485517791413.jpg', '2023-06-23 09:34:51', NULL),
	(50, 10, 'upload/property/multiImg/1769485518009227.jpg', '2023-06-23 09:34:52', NULL),
	(51, 10, 'upload/property/multiImg/1769485518377071.jpg', '2023-06-23 09:34:52', NULL),
	(52, 4, 'upload/property/multiImg/1771126787024247.jpg', '2023-07-11 12:22:17', NULL),
	(53, 4, 'upload/property/multiImg/1771126796773902.jpg', '2023-07-11 12:22:27', NULL),
	(54, 4, 'upload/property/multiImg/1771126807228246.jpg', '2023-07-11 12:22:41', NULL),
	(55, 4, 'upload/property/multiImg/1771126822235195.jpg', '2023-07-11 12:22:45', NULL),
	(56, 11, 'upload/property/multiImg/1771129510029410.jpg', '2023-07-11 13:05:26', NULL),
	(57, 11, 'upload/property/multiImg/1771129511493289.jpg', '2023-07-11 13:05:28', NULL),
	(58, 11, 'upload/property/multiImg/1771129513777160.jpg', '2023-07-11 13:05:30', NULL),
	(59, 11, 'upload/property/multiImg/1771129846976592.jpg', '2023-07-11 13:10:47', NULL),
	(60, 11, 'upload/property/multiImg/1771129848320892.jpg', '2023-07-11 13:10:49', NULL),
	(61, 11, 'upload/property/multiImg/1771129850219547.jpg', '2023-07-11 13:10:50', NULL),
	(62, 11, 'upload/property/multiImg/1771135022186427.webp', '2023-07-11 14:33:02', NULL),
	(63, 12, 'upload/property/multiImg/1771233741270593.jpg', '2023-07-12 16:42:08', NULL),
	(64, 12, 'upload/property/multiImg/1771233742833920.jpg', '2023-07-12 16:42:13', NULL),
	(65, 12, 'upload/property/multiImg/1771233747939619.jpg', '2023-07-12 16:42:16', NULL),
	(66, 12, 'upload/property/multiImg/1771233750828790.jpg', '2023-07-12 16:42:17', NULL),
	(67, 12, 'upload/property/multiImg/1771233752034733.jpg', '2023-07-12 16:42:20', NULL),
	(68, 12, 'upload/property/multiImg/1771233754497022.jpg', '2023-07-12 16:42:21', NULL);

-- Listage de la structure de table realestate_db. package_plans
DROP TABLE IF EXISTS `package_plans`;
CREATE TABLE IF NOT EXISTS `package_plans` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `package_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `invoice` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `package_credits` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `package_amount` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table realestate_db.package_plans : ~2 rows (environ)
DELETE FROM `package_plans`;
INSERT INTO `package_plans` (`id`, `user_id`, `package_name`, `invoice`, `package_credits`, `package_amount`, `created_at`, `updated_at`) VALUES
	(1, 2, 'Business', 'MR26433688494', '3', '20', '2023-06-15 10:26:26', NULL),
	(2, 5, 'Business', 'MR15862997825', '3', '20', '2023-06-21 19:47:44', NULL);

-- Listage de la structure de table realestate_db. password_reset_tokens
DROP TABLE IF EXISTS `password_reset_tokens`;
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table realestate_db.password_reset_tokens : ~0 rows (environ)
DELETE FROM `password_reset_tokens`;

-- Listage de la structure de table realestate_db. permissions
DROP TABLE IF EXISTS `permissions`;
CREATE TABLE IF NOT EXISTS `permissions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `group_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB AUTO_INCREMENT=144 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table realestate_db.permissions : ~38 rows (environ)
DELETE FROM `permissions`;
INSERT INTO `permissions` (`id`, `name`, `guard_name`, `group_name`, `created_at`, `updated_at`) VALUES
	(106, 'state.menu', 'web', 'state', '2023-07-18 20:37:47', '2023-07-18 20:37:47'),
	(107, 'state.all', 'web', 'state', '2023-07-18 20:37:47', '2023-07-18 20:37:47'),
	(108, 'state.add', 'web', 'state', '2023-07-18 20:37:47', '2023-07-18 20:37:47'),
	(109, 'state.edit', 'web', 'state', '2023-07-18 20:37:47', '2023-07-18 20:37:47'),
	(110, 'state.delete', 'web', 'state', '2023-07-18 20:37:47', '2023-07-18 20:37:47'),
	(111, 'amenities.menu', 'web', 'amenities', '2023-07-18 20:37:47', '2023-07-18 20:37:47'),
	(112, 'amenities.all', 'web', 'amenities', '2023-07-18 20:37:47', '2023-07-18 20:37:47'),
	(113, 'amenities.add', 'web', 'amenities', '2023-07-18 20:37:47', '2023-07-18 20:37:47'),
	(114, 'amenities.edit', 'web', 'amenities', '2023-07-18 20:37:47', '2023-07-18 20:37:47'),
	(115, 'amenities.delete', 'web', 'amenities', '2023-07-18 20:37:47', '2023-07-18 20:37:47'),
	(116, 'property.menu', 'web', 'property', '2023-07-18 20:37:47', '2023-07-18 20:37:47'),
	(117, 'property.all', 'web', 'property', '2023-07-18 20:37:47', '2023-07-18 20:37:47'),
	(118, 'property.add', 'web', 'property', '2023-07-18 20:37:47', '2023-07-18 20:37:47'),
	(119, 'property.edit', 'web', 'property', '2023-07-18 20:37:47', '2023-07-18 20:37:47'),
	(120, 'property.delete', 'web', 'property', '2023-07-18 20:37:47', '2023-07-18 20:37:47'),
	(121, 'testimonial.menu', 'web', 'testimonials', '2023-07-18 20:37:47', '2023-07-18 20:37:47'),
	(122, 'testimonial.all', 'web', 'testimonials', '2023-07-18 20:37:47', '2023-07-18 20:37:47'),
	(123, 'testimonial.add', 'web', 'testimonials', '2023-07-18 20:37:47', '2023-07-18 20:37:47'),
	(124, 'testimial.edit', 'web', 'testimonials', '2023-07-18 20:37:47', '2023-07-18 20:37:47'),
	(125, 'testimial.delete', 'web', 'testimonials', '2023-07-18 20:37:47', '2023-07-18 20:37:47'),
	(126, 'agent.menu', 'web', 'agent', '2023-07-18 20:37:47', '2023-07-18 20:37:47'),
	(127, 'agent.all', 'web', 'agent', '2023-07-18 20:37:47', '2023-07-18 20:37:47'),
	(128, 'agent.add', 'web', 'agent', '2023-07-18 20:37:47', '2023-07-18 20:37:47'),
	(129, 'agent.edit', 'web', 'agent', '2023-07-18 20:37:47', '2023-07-18 20:37:47'),
	(130, 'agent.delete', 'web', 'agent', '2023-07-18 20:37:47', '2023-07-18 20:37:47'),
	(131, 'category.menu', 'web', 'category', '2023-07-18 20:37:47', '2023-07-18 20:46:54'),
	(132, 'site.menu', 'web', 'site', '2023-07-18 20:37:47', '2023-07-18 20:37:47'),
	(133, 'smtp.menu', 'web', 'smtp', '2023-07-18 20:37:47', '2023-07-18 20:37:47'),
	(134, 'comment.menu', 'web', 'comment', '2023-07-18 20:37:47', '2023-07-18 20:37:47'),
	(135, 'post.menu', 'web', 'post', '2023-07-18 20:37:47', '2023-07-18 20:37:47'),
	(136, 'history.menu', 'web', 'history', '2023-07-18 20:37:47', '2023-07-18 20:37:47'),
	(137, 'role.menu', 'web', 'role', '2023-07-18 20:37:47', '2023-07-18 20:37:47'),
	(138, 'message.menu', 'web', 'message', '2023-07-18 20:37:47', '2023-07-18 20:37:47'),
	(139, 'type.menu', 'web', 'type', '2023-07-18 20:45:24', '2023-07-18 20:45:24'),
	(140, 'type.all', 'web', 'type', '2023-07-18 20:45:24', '2023-07-18 20:45:24'),
	(141, 'type.add', 'web', 'type', '2023-07-18 20:45:24', '2023-07-18 20:45:24'),
	(142, 'type.edit', 'web', 'type', '2023-07-18 20:45:24', '2023-07-18 20:45:24'),
	(143, 'type.delete', 'web', 'type', '2023-07-18 20:45:24', '2023-07-18 20:45:24');

-- Listage de la structure de table realestate_db. personal_access_tokens
DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table realestate_db.personal_access_tokens : ~0 rows (environ)
DELETE FROM `personal_access_tokens`;

-- Listage de la structure de table realestate_db. properties
DROP TABLE IF EXISTS `properties`;
CREATE TABLE IF NOT EXISTS `properties` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `ptype_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amenities_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `property_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `property_slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `property_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `property_status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `property_size` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lowest_price` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `max_price` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `property_thumbnail` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `short_desc` text COLLATE utf8mb4_unicode_ci,
  `long_desc` text COLLATE utf8mb4_unicode_ci,
  `bedrooms` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bathrooms` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `garage` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `garage_size` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `property_video` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state_id` int DEFAULT NULL,
  `postal_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `neighborhood` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `latitude` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `longitude` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `featured` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hot` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `agent_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table realestate_db.properties : ~9 rows (environ)
DELETE FROM `properties`;
INSERT INTO `properties` (`id`, `ptype_id`, `amenities_id`, `property_name`, `property_slug`, `property_code`, `property_status`, `property_size`, `lowest_price`, `max_price`, `property_thumbnail`, `short_desc`, `long_desc`, `bedrooms`, `bathrooms`, `garage`, `garage_size`, `property_video`, `address`, `city`, `state_id`, `postal_code`, `neighborhood`, `latitude`, `longitude`, `featured`, `hot`, `agent_id`, `status`, `created_at`, `updated_at`) VALUES
	(1, '7', 'Piscine,Réfrigérateur,Sécurité de vidéosurveillance,Electricité de secours', 'Immeuble CISSE', 'immeuble-cisse', 'PC001', 'A louer', '1600', '15000', '23000', 'upload/property/thumbnail/1768231036247440.jpg', 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Doloribus, numquam!', '<div>\r\n<div style="text-align: justify;">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quos eligendi maxime voluptates enim molestiae distinctio ea quas harum asperiores unde rem, iste omnis, nobis aliquam maiores dicta cum ab corrupti ducimus magnam officiis? Animi soluta in maiores ducimus. Enim autem asperiores rem ratione?</div>\r\n<div style="text-align: justify;">Assumenda, quisquam laborum corrupti, enim dolore quae neque alias dolor laudantium eius consectetur aliquam dolorum fugiat accusamus ad velit, impedit perspiciatis officiis? Iste laboriosam, sunt dolorem ducimus pariatur nostrum qui earum rem itaque ipsum tempore sapiente vitae. Omnis libero facilis repellendus sequi magnam iste explicabo incidunt animi saepe, non earum sed, repudiandae accusantium consequuntur placeat! Ullam, aliquam! updated</div>\r\n</div>', '4', '4', '1', '170', 'https://www.youtube.com/embed/ec_fXMrD7Ow', 'Kaloum', 'Kankan Ville', 5, '9398', 'Coronthie', '10.382789', '-9.311828', NULL, '1', '5', 1, '2023-06-02 10:27:02', '2023-07-05 11:45:06'),
	(2, '2', 'Salle de gym,Flux de bois dur,Piscine,Conciergerie 24h/24,Centre médical de premiers secours', 'Immeuble Dr Mansour', 'immeuble-dr-mansour', 'PC003', 'A louer', '1500', '2000', '5000', 'upload/property/thumbnail/1768986694207896.jpg', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Asperiores beatae atque aliquam, facilis alias commodi.', '<div>\r\n<div style="text-align: justify;">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Beatae sunt voluptatibus tempora aut sequi doloribus deleniti! Perspiciatis quae voluptatum molestias alias et facilis cumque, inventore dolorem, dicta officia suscipit veritatis maxime accusamus saepe quia sunt delectus aspernatur pariatur optio soluta maiores unde obcaecati aperiam illo. Distinctio ratione quisquam quaerat blanditiis aspernatur!</div>\r\n<br>\r\n<div style="text-align: justify;">Amet, doloribus rerum nesciunt odit neque incidunt vel consequuntur voluptatibus repellat labore esse maxime, rem quasi repudiandae laborum ullam nihil ipsa vitae tempore? Totam, incidunt laudantium corrupti pariatur quidem ipsam distinctio mollitia tempore, quisquam eius aliquid! Harum ab ad impedit accusantium. Doloribus quia illo itaque cupiditate ratione, repellat suscipit!</div>\r\n</div>', '10', '5', '2', '200', 'https://www.youtube.com/embed/1ovIKzSpNQk', 'Ratoma', 'Conakry', 1, '2427', 'Kipé', '10.382789', '-9.311828', '1', '1', '5', 1, '2023-06-02 12:04:35', '2023-07-05 11:44:02'),
	(3, '2', 'Service de nettoyage,Salle de gym,Lave-vaisselle,Piscine,Sécurité de vidéosurveillance,Electricité de secours', 'Malick Tower', 'malick-tower', 'PC004', 'A vendre', '1500', '3000', '5000', 'upload/property/thumbnail/1768221398286849.jpg', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Magni sint repudiandae vitae id sequi accusamus dignissimos quas facilis commodi?', '<p style="text-align: justify;">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Sint quis voluptate recusandae ratione at aliquid fugit asperiores nisi a, alias, omnis unde et aspernatur deserunt dignissimos provident consequunur, porro quia!</p>\r\n<p style="text-align: justify;">Lorem ipsum dolor sit amet consectetur adipisicing elit. Vitae, molestiae. Laudantium odio et voluptatum laborum. Laborum doloremque id dicta vero repudiandae architecto similique accusantium, animi est. Sequi, optio adipisci nesciunt porro tenetur sapiente ratione expedita est labore nihil voluptas hic? Debitis molestias esse minus quam, eum assumenda vitae nihil vel tempora magnam temporibus libero at inventore? Expedita natus, et consectetur voluptatum illum vitae, reprehenderit velit deserunt veritatis optio culpa laboriosam dolor architecto tenetur hic! Dolores, dolorum. Dignissimos error possimus quas? Corrupti labore quis, saepe rem quisquam ex laborum sapiente a tempora.</p>', '5', '5', '1', '300', 'https://www.youtube.com/embed/y9j-BL5ocW8', 'Labé', 'Labé', 4, '9732', 'Mosquée', '11.317080', '-12.276980', '1', '1', '2', 1, '2023-06-09 10:42:14', '2023-07-05 22:10:46'),
	(4, '7', 'Air conditionnée,Piscine,Centre médical de premiers secours,Electricité de secours', 'Malick Tower 2', 'malick-tower-2', 'PC005', 'A louer', '1500', '5000', '7000', 'upload/property/thumbnail/1768223184634385.jpg', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Magni sint repudiandae vitae id sequi accusamus dignissimos quas facilis commodi?', '<p style="text-align: justify;">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Sint quis voluptate recusandae ratione at aliquid fugit asperiores nisi a, alias, omnis unde et aspernatur deserunt dignissimos provident consequunur, porro quia!</p>\r\n<p style="text-align: justify;">Lorem ipsum dolor sit amet consectetur adipisicing elit. Vitae, molestiae. Laudantium odio et voluptatum laborum. Laborum doloremque id dicta vero repudiandae architecto similique accusantium, animi est. Sequi, optio adipisci nesciunt porro tenetur sapiente ratione expedita est labore nihil voluptas hic? Debitis molestias esse minus quam, eum assumenda vitae nihil vel tempora magnam temporibus libero at inventore? Expedita natus, et consectetur voluptatum illum vitae, reprehenderit velit deserunt veritatis optio culpa laboriosam dolor architecto tenetur hic! Dolores, dolorum. Dignissimos error possimus quas? Corrupti labore quis, saepe rem quisquam ex laborum sapiente a tempora.</p>', '25', '30', '5', '500', 'https://www.youtube.com/embed/7EHnQ0VM4KY', 'Kankan', 'Kankan', 5, '3929', 'Mosquée', '10.382789', '-9.311828', '1', '1', '5', 1, '2023-06-09 10:43:15', '2023-07-05 11:42:44'),
	(5, '5', 'Service de nettoyage,Lave-vaisselle,Flux de bois dur,Piscine,Conciergerie 24h/24,Sécurité de vidéosurveillance,Electricité de secours', 'Black House', 'black-house', 'PC008', 'A vendre', '1300', '250000', '320000', 'upload/property/thumbnail/1768391213650685.jpg', 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Quos consequatur, sunt ipsa nesciunt similique in!', '<p style="text-align: justify;">Lorem ipsum dolor sit amet consectetur adipisicing elit. Iusto beatae pariatur commodi debitis dolores. Earum at nesciunt fugit tenetur molestiae, ducimus accusamus maxime expedita beatae sapiente dolorum exercitationem aliquam quos.Lorem ipsum dolor sit amet consectetur adipisicing elit. Amet corporis accusamus quisquam aliquam reiciendis. Illum, eaque et!</p>\r\n<p style="text-align: justify;"><br>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Obcaecati est harum pariatur necessitatibus perspiciatis ullam deleniti facere optio sunt quo corrupti dignissimos dolores quis quae saepe nobis perferendis, quas eveniet reiciendis illo omnis delectus enim. Nam provident beatae autem, cum ratione eaque quibusdam voluptates maxime quidem accusamus sed quae enim quia veniam ex eos optio temporibus. Odio obcaecati cum maiores rerum recusandae debitis distinctio sit quos facere a repellat, suscipit nulla reprehenderit, et saepe magni cupiditate in. Cupiditate nulla at consequatur officia praesentium adipisci velit aliquam, obcaecati, dolore ad temporibus cumque incidunt possimus non? Soluta iure reprehenderit facere error minus.</p>', '3', '3', '1', '120', 'https://www.youtube.com/embed/mgulkcaPMCY', 'Tata', 'Labé', 4, '9732', 'Tata - Labé', '11.317080', '-12.276980', '1', '1', '2', 1, '2023-06-11 07:41:24', '2023-07-05 11:41:40'),
	(9, '1', 'Toillette externe,Animaux acceptés,Balcon ou Terrasse,Electricité de secours', 'IB House', 'ib-house', 'PC009', 'A louer', '1580', '500', '1500', 'upload/property/thumbnail/1768804094961179.jpg', 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Iure, ullam nostrum distinctio neque temporibus quas illo inventore laboriosam omnis?', '<p style="text-align: justify;">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusantium magni nemo, voluptatibus reiciendis aspernatur porro eos commodi ab. Natus odit consequatur temporibus similique tempora deleniti optio porro, nostrum ratione reprehenderit?</p>\r\n<p style="text-align: justify;">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Voluptatibus architecto quam, deserunt aliquid minus at. Velit architecto saepe in modi voluptatum est accusamus aliquam illum quos suscipit consectetur, tenetur nihil?</p>\r\n<p style="text-align: justify;">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quod ex incidunt est facere libero quasi repudiandae ratione tenetur! Debitis sunt harum tenetur labore voluptate facilis exercitationem explicabo necessitatibus dolore fugiat.</p>', '3', '3', '1', '100', 'https://www.youtube.com/embed/uv0PsdVFOtM', 'Pellal', 'Mali', 4, '9872', 'Missidé', '11.316973', '-12.276953', NULL, '1', '2', 1, '2023-06-15 21:03:57', '2023-07-05 11:38:20'),
	(10, '3', 'Service de nettoyage,Flux de bois dur,Piscine,Conciergerie 24h/24', 'House Paradis', 'house-paradis', 'PC010', 'A vendre', '700', '500', '700', 'upload/property/thumbnail/1769485517670551.jpg', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Facere ratione aspernatur eveniet inventore voluptas dignissimos molestiae, eius nostrum at voluptatem corrupti minus veritatis excepturi dolore ipsam repellendus rem, obcaecati itaque!', '<p style="text-align: justify;">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Ducimus corporis minima ex similique repellendus hic odio, sequi iste. Est ex dolores aliquam odio ipsum obcaecati dolor enim quasi fugit ratione.</p>\r\n<p style="text-align: justify;">Lorem ipsum dolor sit amet consectetur adipisicing elit. Ex totam aspernatur magni laboriosam, veniam ea molestias assumenda obcaecati aliquam maxime quas distinctio dolor expedita. Laudantium deserunt consequuntur expedita nulla harum.</p>\r\n<p style="text-align: justify;">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Hic iusto error incidunt dolores nobis amet aliquam ea accusantium corrupti optio voluptatibus aut cumque, eum consectetur necessitatibus molestiae sed blanditiis aperiam?</p>\r\n<p style="text-align: justify;">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Doloribus nulla ipsa labore amet et. Consectetur voluptatem dolorem natus reprehenderit, ipsum neque ullam voluptas ratione. Cupiditate ipsum ex minus qui. Quas.</p>', '3', '2', '1', '60', 'https://www.youtube.com/embed/4jnzf1yj48M', 'Contournante', 'Kindia', 3, '2872', 'Centre ville', '12.435640', '-2.036650', '1', '1', '10', 1, '2023-06-23 09:34:51', '2023-07-05 11:40:50'),
	(11, '3', 'Air conditionnée,Balcon ou Terrasse,Centre médical de premiers secours,Conciergerie 24h/24,Electricité de secours,Flux de bois dur,Piscine', 'Résidence de vacance', 'résidence-de-vacance', 'PC011', 'A louer', '250', '150', '320', 'upload/property/thumbnail/1771129507878232.jpg', 'Monsieur Ali est un homme maigre, solide comme sa barque, lent, lucide ; un des hommes qui semblent faits pour être toujours en contact avec leur monde préféré : la mer. Il a un gros nez, un gros front, de gros yeux qui peuvent détecter les profonds secrets de la mer.', '<div style="text-align: justify;"><strong><span style="color: red;">Exemple 1 :</span></strong></div>\r\n<div style="text-align: justify;">&nbsp;</div>\r\n<div style="text-align: justify;">C&acute;est une fille.C&acute;est une lyc&eacute;enne. Elle est mince,brune et timide. Elle est un peu t&ecirc;tue et aussi calme. Elle n&acute;est pas sportive. Elle arrive toujours tard. Elle a les yeux marron et grands. Ses cheveux sont longs, bruns et raides. Sa couleur c&acute;est le bleu. Elle a le nez petit. Elle a la bouche grande. Elle aime lire et danser mais elle n&acute;aime pas chanter. C&acute;est Sara.</div>\r\n<div style="text-align: justify;">&nbsp;</div>\r\n<div style="text-align: justify;"><strong><span style="color: red;">Exemple 2 :</span></strong></div>\r\n<div style="text-align: justify;">&nbsp;</div>\r\n<div style="text-align: justify;">C&acute;est une jeune fille de dix-neuf ans environ. Elle est petite, sympathique et amusante. Aussi elle est gentille, dynamique, sportive, mince intelligente, jolie et dr&ocirc;le. Ses cheveux sont bruns et raides. Elle a les yeux marrons et petits. Elle porte un pantalon bleu, un pull gris, une &eacute;charpe bleue et grise, des baskets noires et un manteau gris. Elle a aussi une montre et des lunettes. Elle a un visage agr&eacute;able et avec la forme d&acute;un ballon. Elle a un baladeur et elle porte un sac &agrave; dos rouge et jaune.</div>\r\n<div id="google_ads_iframe_/1254144,22873923255/coursfrancaisfacile_com-medrectangle-3_1__container__" style="border: 0pt none; width: 250px; height: 0px;"></div>\r\n<p><span class="ezoic-ad ezoic-at-0 medrectangle-3 medrectangle-3320 adtester-container adtester-container-320 ezoic-ad-adaptive" data-ez-name="coursfrancaisfacile_com-medrectangle-3"><span class="ezoic-ad medrectangle-3 medrectangle-3-multi-320 adtester-container adtester-container-320" data-ez-name="coursfrancaisfacile_com-medrectangle-3"><span id="div-gpt-ad-coursfrancaisfacile_com-medrectangle-3-0_1" class="ezoic-ad ezfound" style="position: relative; z-index: 0; display: inline-block; padding: 0; min-height: 250px; min-width: 290px;" data-google-query-id="CIjj0onbhoADFRJO0wodXGoGJg"></span></span></span></p>', '3', '2', '50', '100', 'https://www.youtube.com/embed/UxO9ZzvKU4Y', 'Yembéring', 'Mali', 4, '2872', 'Bowal Weedhou', '11.816380', '-12.351320', '1', NULL, '5', 1, '2023-07-11 13:05:24', NULL),
	(12, '3', '3,5,6,17,18,19', 'Cchalet de luxe', 'cchalet-de-luxe', 'PC012', 'A louer', '150', '150', '500', 'upload/property/thumbnail/1771233737648882.jpg', 'Comment décrire une personne physiquement et moralement en français', '<p>Pour d&eacute;crire un personnage en fran&ccedil;ais , on vous propose aujourd\'hui une liste de vocabulaire de la description d\'un personnage , vous trouverez dans cette fiche de vocabulaire des mots et des exemples de paragraphes pour apprendre &agrave; d&eacute;crire en fran&ccedil;ais un personnage , vous pouvez gr&acirc;ce &agrave; ces vocabulaires et ces phrases &nbsp;r&eacute;diger la description d\'un personnage physique et morale.</p>\r\n<p><strong>Exemple 1 :</strong></p>\r\n<p>C&acute;est un gar&ccedil;on mignon et amoureux. Il a les yeux marron et les cheveux ch&acirc;tains. C&acute;est un lyc&eacute;en. Il porte des v&ecirc;tements de sport: son pantalon est noir et son sweat noir et blanc. Il est t&ecirc;tu et tr&egrave;s bavard. Il est mince et grand. Il est tr&egrave;s gentil. J\'aime ce gar&ccedil;on .</p>\r\n<div><strong>Exemple 2 :</strong></div>\r\n<p>C&acute;est un gar&ccedil;on, il s&acute;appelle Pablo. Il a les cheveux longs et bruns. Il a dix-sept ans. Il n&acute;&eacute;tudie pas beaucoup. Il aime &eacute;couter la chanson &ldquo;The number of the beast&rdquo; de Iron Maiden. Il aime jouer avec la Xbox le vendredi apr&egrave;s-midi. Il aime parler sur l&acute;univers et ses secrets. Il aime &eacute;tudier avec les ordinateurs .</p>', '3', '3', '1', '60', 'https://www.youtube.com/embed/ewgoSXwsv44', 'Yembéring', 'Mali', 4, '2827', 'Pellal Missidé', '11.76892', '-12.36580', '1', NULL, '2', 1, '2023-07-12 16:42:07', '2023-07-12 23:56:04');

-- Listage de la structure de table realestate_db. property_messages
DROP TABLE IF EXISTS `property_messages`;
CREATE TABLE IF NOT EXISTS `property_messages` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT NULL,
  `agent_id` int DEFAULT NULL,
  `property_id` int DEFAULT NULL,
  `msg_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `msg_email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `msg_phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `message` text COLLATE utf8mb4_unicode_ci,
  `msg_status` int DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table realestate_db.property_messages : ~6 rows (environ)
DELETE FROM `property_messages`;
INSERT INTO `property_messages` (`id`, `user_id`, `agent_id`, `property_id`, `msg_name`, `msg_email`, `msg_phone`, `message`, `msg_status`, `created_at`, `updated_at`) VALUES
	(1, 4, 5, 4, 'Dembo TOURE', 'dembo.toure@malickroi.com', '660 838 830', 'Bonjour Easy Estate. Je suis à la recherche d\'un appartement, et je trouve celui-ci me convient parfaitement.', 1, '2023-06-22 09:03:05', '2023-06-22 09:21:01'),
	(2, 3, 5, 4, 'Mansour DIALLO', 'user3.malickroi@gmail.com', '610151406', 'Bonjour Easy Estate. \r\nJe trouve vos prix de louer trop chers. Veuillez réduire les prix SVP.', 1, '2023-06-22 09:23:41', '2023-06-22 10:30:11'),
	(3, 5, 5, 4, 'Easy Estate', 'easy@email.com', '631 00 00 00', 'test', 1, '2023-06-22 10:16:05', '2023-06-22 10:29:14'),
	(4, 3, 2, 3, 'Mansour DIALLO', 'user3.malickroi@gmail.com', '610151406', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Labore delectus omnis veniam deleniti magnam dolores possimus, at ea adipisci consectetur repellendus. Repellendus recusandae voluptates tempore est consequuntur eaque, eos vero?', 0, '2023-06-22 12:22:37', NULL),
	(5, 3, 2, NULL, 'Mansour DIALLO', 'user3.malickroi@gmail.com', '610151406', 'Test d\'envoi d\'un message. Salut Marewa Location.', 0, '2023-06-24 23:46:14', NULL),
	(6, 1, 2, 9, 'MalickRoi', 'worldpython3@gmail.com', '660 838 830', 'Bonjour Marewa Location. A combien pour cette demeure ?', 0, '2023-07-02 21:09:49', NULL);

-- Listage de la structure de table realestate_db. property_types
DROP TABLE IF EXISTS `property_types`;
CREATE TABLE IF NOT EXISTS `property_types` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `type_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type_icon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table realestate_db.property_types : ~5 rows (environ)
DELETE FROM `property_types`;
INSERT INTO `property_types` (`id`, `type_name`, `type_icon`, `created_at`, `updated_at`) VALUES
	(1, 'Appartement', 'icon-1', NULL, '2023-05-30 18:19:20'),
	(2, 'Bureau', 'icon-2', NULL, NULL),
	(3, 'Ordinaire', 'icon-3', NULL, '2023-06-15 20:49:44'),
	(5, 'Duplex', 'icon-4', NULL, NULL),
	(7, 'Building', 'icon-5', NULL, '2023-06-15 20:50:50');

-- Listage de la structure de table realestate_db. roles
DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table realestate_db.roles : ~4 rows (environ)
DELETE FROM `roles`;
INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
	(1, 'SuperAdmin', 'web', '2023-07-17 12:24:48', '2023-07-17 12:33:49'),
	(2, 'Manager', 'web', '2023-07-17 12:26:53', '2023-07-17 12:26:53'),
	(3, 'Admin', 'web', '2023-07-17 12:27:00', '2023-07-17 12:27:00'),
	(4, 'Sales', 'web', '2023-07-17 12:27:17', '2023-07-17 12:27:17');

-- Listage de la structure de table realestate_db. role_has_permissions
DROP TABLE IF EXISTS `role_has_permissions`;
CREATE TABLE IF NOT EXISTS `role_has_permissions` (
  `permission_id` bigint unsigned NOT NULL,
  `role_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `role_has_permissions_role_id_foreign` (`role_id`),
  CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table realestate_db.role_has_permissions : ~72 rows (environ)
DELETE FROM `role_has_permissions`;
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
	(106, 1),
	(107, 1),
	(108, 1),
	(109, 1),
	(110, 1),
	(111, 1),
	(112, 1),
	(113, 1),
	(114, 1),
	(115, 1),
	(116, 1),
	(117, 1),
	(118, 1),
	(119, 1),
	(120, 1),
	(121, 1),
	(122, 1),
	(123, 1),
	(124, 1),
	(125, 1),
	(126, 1),
	(127, 1),
	(128, 1),
	(129, 1),
	(130, 1),
	(131, 1),
	(132, 1),
	(133, 1),
	(134, 1),
	(135, 1),
	(136, 1),
	(137, 1),
	(138, 1),
	(106, 2),
	(107, 2),
	(108, 2),
	(109, 2),
	(116, 2),
	(117, 2),
	(118, 2),
	(119, 2),
	(126, 2),
	(127, 2),
	(128, 2),
	(129, 2),
	(131, 2),
	(134, 2),
	(136, 2),
	(106, 3),
	(107, 3),
	(108, 3),
	(109, 3),
	(110, 3),
	(116, 3),
	(117, 3),
	(118, 3),
	(119, 3),
	(120, 3),
	(126, 3),
	(127, 3),
	(128, 3),
	(129, 3),
	(130, 3),
	(132, 3),
	(133, 3),
	(137, 3),
	(111, 4),
	(112, 4),
	(113, 4),
	(114, 4),
	(131, 4),
	(134, 4);

-- Listage de la structure de table realestate_db. schedules
DROP TABLE IF EXISTS `schedules`;
CREATE TABLE IF NOT EXISTS `schedules` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT NULL,
  `property_id` int DEFAULT NULL,
  `agent_id` int DEFAULT NULL,
  `tour_date` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tour_time` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `message` text COLLATE utf8mb4_unicode_ci,
  `status` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table realestate_db.schedules : ~2 rows (environ)
DELETE FROM `schedules`;
INSERT INTO `schedules` (`id`, `user_id`, `property_id`, `agent_id`, `tour_date`, `tour_time`, `message`, `status`, `created_at`, `updated_at`) VALUES
	(1, 4, 10, 10, '2023-07-15', '10:00', 'Bonjour,\r\nJe voudrais visiter cette propriété le week-end prochain, si possible.', 0, '2023-07-11 12:32:22', '2023-07-12 11:04:53'),
	(2, 3, 9, 2, '2023-07-14', '09:30', 'Bonjour,\r\nJe voudrai prendre rendez-vous avec vous vendredi prochain pour une visite de la propriété.', 1, '2023-07-12 11:19:24', '2023-07-18 11:06:55');

-- Listage de la structure de table realestate_db. site_settings
DROP TABLE IF EXISTS `site_settings`;
CREATE TABLE IF NOT EXISTS `site_settings` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `logo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `support_phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_address` text COLLATE utf8mb4_unicode_ci,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `facebook` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `twitter` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `copyright` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table realestate_db.site_settings : ~1 rows (environ)
DELETE FROM `site_settings`;
INSERT INTO `site_settings` (`id`, `logo`, `support_phone`, `company_address`, `email`, `facebook`, `twitter`, `copyright`, `created_at`, `updated_at`) VALUES
	(1, 'upload/site/1771522629697267.png', '628 257 170', 'Koloma Soloprimo, Conakry, République de Guinée', 'worldpython3@gmail.com', 'https://www.facebook.com/malikdiallo176', 'https://twitter.com/lord_malick', '&copy; {{ date(\'Y\') }} Tous droits reservés', '2023-07-15 20:03:25', '2023-07-16 00:19:11');

-- Listage de la structure de table realestate_db. smtp_settings
DROP TABLE IF EXISTS `smtp_settings`;
CREATE TABLE IF NOT EXISTS `smtp_settings` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `mailer` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `host` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `port` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `encryption` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `from_address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table realestate_db.smtp_settings : ~1 rows (environ)
DELETE FROM `smtp_settings`;
INSERT INTO `smtp_settings` (`id`, `mailer`, `host`, `port`, `username`, `password`, `encryption`, `from_address`, `created_at`, `updated_at`) VALUES
	(1, 'smtp', 'sandbox.smtp.mailtrap.io', '2525', '8393f669c5ed08', 'e0ba56afbdae33', 'tls', 'malickroi2019@gmail.com', '2023-07-15 16:25:50', '2023-07-15 16:43:23');

-- Listage de la structure de table realestate_db. states
DROP TABLE IF EXISTS `states`;
CREATE TABLE IF NOT EXISTS `states` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `state_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `state_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table realestate_db.states : ~8 rows (environ)
DELETE FROM `states`;
INSERT INTO `states` (`id`, `state_name`, `state_image`, `created_at`, `updated_at`) VALUES
	(1, 'Conakry', 'upload/states/1770268450294314.jpg', '2023-07-02 00:59:15', NULL),
	(2, 'Boké', 'upload/states/1770326795372674.jpg', '2023-07-02 00:59:51', '2023-07-02 16:26:56'),
	(3, 'Kindia', 'upload/states/1770268521658817.jpg', '2023-07-02 01:00:24', NULL),
	(4, 'Labé', 'upload/states/1770268598933360.jpg', '2023-07-02 01:00:57', '2023-07-02 16:23:47'),
	(5, 'Kankan', 'upload/states/1770268558879629.jpg', '2023-07-02 01:01:00', NULL),
	(6, 'Faranah', 'upload/states/1770268632216568.jpg', '2023-07-02 01:02:09', NULL),
	(7, 'Mamou', 'upload/states/1770268653531927.jpg', '2023-07-02 01:02:31', NULL),
	(8, 'N\'Zérékoré', 'upload/states/1770268686924305.jpg', '2023-07-02 01:03:01', NULL);

-- Listage de la structure de table realestate_db. testimonials
DROP TABLE IF EXISTS `testimonials`;
CREATE TABLE IF NOT EXISTS `testimonials` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `position` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `message` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table realestate_db.testimonials : ~3 rows (environ)
DELETE FROM `testimonials`;
INSERT INTO `testimonials` (`id`, `name`, `position`, `image`, `message`, `created_at`, `updated_at`) VALUES
	(1, 'Mohamed KANTE', 'Développeur Web', 'upload/testimonials/1770671377408823.jpg', '<p><span style="color: rgb(35, 111, 161);">Our goal each day is to ensure that our residents&rsquo; needs are not only met but exceeded. To make that happen we are committed to provid ing an environment in which residents can enjoy.</span></p>', '2023-07-06 11:10:59', '2023-07-06 11:43:38'),
	(2, 'Salifou KEITA', 'PDG', 'upload/testimonials/1770671333404428.jpg', '<p><span style="color: rgb(53, 152, 219);">Notre objectif quotidien est de veiller &agrave; ce que les besoins de nos r&eacute;sidents soient non seulement satisfaits, mais d&eacute;pass&eacute;s. Pour ce faire, nous nous engageons &agrave; fournir un environnement dans lequel les r&eacute;sidents peuvent profiter.</span></p>', '2023-07-06 11:17:46', '2023-07-06 12:49:37'),
	(5, 'Mariame DIALLO', 'Economiste', 'upload/testimonials/1770672367767114.jpg', '<p><span style="color: rgb(53, 152, 219);">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Id quae aspernatur laborum doloribus tenetur dolor, neque maiores provident iste veritatis quos molestias porro cum, accusamus et quam quaerat? Iure, necessitatibus.</span></p>', '2023-07-06 11:58:56', '2023-07-06 12:50:44');

-- Listage de la structure de table realestate_db. users
DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cover_photo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` enum('admin','agent','user') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user',
  `status` enum('active','inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `credit` int DEFAULT '0',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table realestate_db.users : ~13 rows (environ)
DELETE FROM `users`;
INSERT INTO `users` (`id`, `name`, `username`, `email`, `email_verified_at`, `password`, `photo`, `cover_photo`, `phone`, `address`, `role`, `status`, `credit`, `remember_token`, `created_at`, `updated_at`) VALUES
	(1, 'MalickRoi', 'malickroi', 'user2.malickroi@gmail.com', NULL, '$2y$10$nVW3cH4n7s172vxZ1BEC3OvTFB8G6d09/pceEjTptaJATZt.w8rEO', '202305202203admin.png', '202305202207cover.jpg', '660 838 830', 'Ratoma, Conakry, République de Guinée', 'admin', 'active', 0, NULL, '2023-05-13 00:07:55', '2023-07-18 14:06:00'),
	(2, 'Marewa Location', 'marewa.location', 'user3.malickroi@gmail.com', NULL, '$2y$10$QZrnWd4pytuEA0vAZXJAbe1qZjmGcUnKqMAv07oaLC39B/Ew/6nQq', NULL, '202306061636cover.jpg', '631 10 20 30', 'Kobaya - Ratoma - Conakry', 'agent', 'active', 7, NULL, '2023-05-13 00:07:55', '2023-07-12 16:42:21'),
	(3, 'Mansour DIALLO', 'mansour.diallo', 'worldpython3@gmail.com', NULL, '$2y$10$BqSf9uePJSz3xUn9V3qiH.dqk7.WbRybriTSXuQY0KouskRlkp5tO', '202305251516user.png', '202305251513cover.jpg', '610151406', 'Yembéring, Mali, République de Guinée', 'user', 'active', 0, NULL, '2023-05-13 00:07:55', '2023-05-25 17:57:50'),
	(4, 'Dembo TOURE', 'dembo.toure', 'dembo.toure@malickroi.com', NULL, '$2y$10$G72odPO4TSKKE86mlraAIOuIN1awDOUL6DTvUMYt9pah8vUIYCnlq', '202306190934user.png', '202306190931cover.jpg', '660 838 830', 'Luanda, Angola', 'user', 'active', 0, NULL, '2023-05-21 16:31:13', '2023-06-19 09:36:12'),
	(5, 'Easy Estate', 'easy.estate', 'easy@email.com', NULL, '$2y$10$kf7n7WaEukiy82reMHepE.kElfJSGufJ8qU./th4qkORpITmqbMtW', '202306061121agent.jpg', '202306061121cover.jpg', '631 00 00 00', 'Dixinn Gare', 'agent', 'active', 7, NULL, '2023-06-05 15:15:44', '2023-07-11 13:05:30'),
	(6, 'Help Agency', 'help.agency', 'help.agency@email.com', NULL, '$2y$10$4lAT97yXTmAxtCVegm1JBeleRXQj4TTCckdwQzTFSsJIP6SaMmHPi', '202306061540agent.jpg', '202306061543cover.jpg', '657 00 00 00', 'Enta - Matoto - Conakry', 'agent', 'inactive', 0, NULL, '2023-06-05 15:24:43', '2023-06-06 15:43:55'),
	(7, 'New Horizon', 'new.horizon', 'new.horizon@email.com', NULL, '$2y$10$xMBesg8g5t641GcGiZSCNOEV/V3PTEzMixN5oSC1lOtjrvM9lDBiK', '202306070945agent.jpg', '202306070945cover.jpg', '631 01 02 03', 'Kaloum - Conakry - Guinée', 'agent', 'active', 0, NULL, NULL, '2023-06-23 09:18:19'),
	(9, 'Home & Home', 'home.and.home', 'home@malickroi.com', NULL, '$2y$10$oefh9YGCcYL0UyafCPmdJ.YKuAOQeecQQIdrwxyYY8TxTiDvvtY/G', '202306231006agent.jpg', '202306231019cover.webp', '627 00 00 00', 'Conakry, République de Guinée', 'agent', 'active', 0, NULL, '2023-06-23 09:13:46', '2023-06-23 10:19:58'),
	(10, 'Demolition', 'demolition', 'demolition@malickroi.com', NULL, '$2y$10$yvZbVUvID0YjJc4Za24Dt.XmVMkwEwS8WMefkrpCWL7teXxvjZUSO', '202306231005agent.webp', '202306230922cover.jpg', '654 00 00 00', 'Kindia, République de Guinée', 'agent', 'active', 1, NULL, '2023-06-23 09:20:36', '2023-06-23 10:05:37'),
	(11, 'Calm Mountain', 'calm.mountain', 'mountain@malickroi.com', NULL, '$2y$10$BRAVtPdn9qUrTb2bdHh.C.rmOF2CjXxHx9c7jj9DNa2Qdj0rfmyZe', '202306231003agent.jpg', '202306230958cover.jpg', '667 00 00 00', 'Lambanyi, Conakry, Rép. de Guinée', 'agent', 'active', 0, NULL, '2023-06-23 09:51:52', '2023-06-23 10:03:24'),
	(12, 'Test Agent', 'test.agent', 'test.agant@malickroi.com', NULL, '$2y$10$eAeUMkrkvTZfGi/h3IwcnePBR9M22k7y4weJdT4kIvGxR145zsMse', NULL, NULL, '282792272', NULL, 'agent', 'inactive', 0, NULL, '2023-06-27 11:39:19', '2023-06-27 11:39:19'),
	(13, 'Oumar BAH', 'admin', 'admin@malickroi.com', NULL, '$2y$10$z4KiAhsmnLoauVxydD/ocuCFO3LuThCNKoJdKEwreprObfolUNGKK', NULL, NULL, '657 000 111', 'Bantounka, Conakry, République de Guinée', 'admin', 'active', 0, NULL, '2023-07-18 13:26:26', '2023-07-18 13:26:26'),
	(15, 'Maladho KABA', 'maladho', 'maladho@malickroi.com', NULL, '$2y$10$qGxqx4e/Ch2jsmUEAvHttua2d/w/jMiZS62jeD5.grtjGtVCgH79C', NULL, NULL, '631 000 111', 'Kankan Koura, Kankan, République de Guinée', 'admin', 'active', 0, NULL, '2023-07-18 15:26:02', '2023-07-18 15:29:05');

-- Listage de la structure de table realestate_db. wishlists
DROP TABLE IF EXISTS `wishlists`;
CREATE TABLE IF NOT EXISTS `wishlists` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `property_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table realestate_db.wishlists : ~3 rows (environ)
DELETE FROM `wishlists`;
INSERT INTO `wishlists` (`id`, `user_id`, `property_id`, `created_at`, `updated_at`) VALUES
	(1, 3, 5, '2023-06-18 22:14:31', NULL),
	(3, 4, 4, '2023-06-19 09:54:08', NULL),
	(7, 4, 3, '2023-06-19 16:07:40', NULL);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
