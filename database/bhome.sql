-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Dec 24, 2024 at 05:24 AM
-- Server version: 8.2.0
-- PHP Version: 8.2.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bhome`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_users`
--

DROP TABLE IF EXISTS `admin_users`;
CREATE TABLE IF NOT EXISTS `admin_users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(240) DEFAULT NULL,
  `email` varchar(240) DEFAULT NULL,
  `secure_user_id` int DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `core_log`
--

DROP TABLE IF EXISTS `core_log`;
CREATE TABLE IF NOT EXISTS `core_log` (
  `id` int NOT NULL AUTO_INCREMENT,
  `log` text COLLATE utf8mb3_unicode_ci,
  `time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=712 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `core_log`
--

INSERT INTO `core_log` (`id`, `log`, `time`) VALUES
(623, 'UPLOADING PATH: upload/bhomeenterprise/media/imagenes/ SITE ID: 2', '2022-07-27 12:00:56'),
(624, 'UP Array\n(\n    [name] => homeA.jpeg\n    [type] => image/jpeg\n    [tmp_name] => /tmp/phpSL5O1g\n    [error] => 0\n    [size] => 2632142\n)\n', '2022-07-27 12:00:56'),
(625, 'UP homeA.jpeg jn: homeA ext: jpeg', '2022-07-27 12:00:56'),
(626, 'Upload new image cover homeA.jpeg', '2022-07-27 12:00:57'),
(627, 'UPLOADING PATH: upload/bhomeenterprise/media/imagenes/ SITE ID: 2', '2022-07-27 15:01:49'),
(628, 'UP Array\n(\n    [name] => 7BEA0FFE-D44D-4DB9-B25C-17904B00C65C.jpeg\n    [type] => image/jpeg\n    [tmp_name] => /tmp/phpz9i4Od\n    [error] => 0\n    [size] => 82990\n)\n', '2022-07-27 15:01:49'),
(629, 'UP 7BEA0FFE-D44D-4DB9-B25C-17904B00C65C.jpeg jn: 7BEA0FFE-D44D-4DB9-B25C-17904B00C65C ext: jpeg', '2022-07-27 15:01:49'),
(630, 'Upload new image cover 7BEA0FFE-D44D-4DB9-B25C-17904B00C65C.jpeg', '2022-07-27 15:01:49'),
(631, 'p�ginas a ordenar 4', '2022-07-29 18:42:22'),
(632, 'Ordenar página 762 nuevo orden 1', '2022-07-29 18:42:22'),
(633, 'Ordenar página 764 nuevo orden 2', '2022-07-29 18:42:22'),
(634, 'Ordenar página 763 nuevo orden 3', '2022-07-29 18:42:22'),
(635, 'Ordenar página 765 nuevo orden 4', '2022-07-29 18:42:22'),
(636, 'p�ginas a ordenar 4', '2022-07-29 18:42:31'),
(637, 'Ordenar página 762 nuevo orden 1', '2022-07-29 18:42:31'),
(638, 'Ordenar página 764 nuevo orden 2', '2022-07-29 18:42:31'),
(639, 'Ordenar página 765 nuevo orden 3', '2022-07-29 18:42:31'),
(640, 'Ordenar página 763 nuevo orden 4', '2022-07-29 18:42:31'),
(641, 'UPLOADING PATH: upload/bhomeenterprise/media/imagenes/ SITE ID: 2', '2022-08-02 14:58:17'),
(642, 'UP Array\n(\n    [name] => homes.svg\n    [type] => image/svg+xml\n    [tmp_name] => /tmp/phpXhoknS\n    [error] => 0\n    [size] => 3542\n)\n', '2022-08-02 14:58:17'),
(643, 'UP homes.svg jn: homes ext: svg', '2022-08-02 14:58:17'),
(644, 'Upload new image icon homes.svg', '2022-08-02 14:58:17'),
(645, 'UPLOADING PATH: upload/bhomeenterprise/media/imagenes/ SITE ID: 2', '2022-08-02 14:59:47'),
(646, 'UP Array\n(\n    [name] => buildings.svg\n    [type] => image/svg+xml\n    [tmp_name] => /tmp/php7DR37t\n    [error] => 0\n    [size] => 4562\n)\n', '2022-08-02 14:59:47'),
(647, 'UP buildings.svg jn: buildings ext: svg', '2022-08-02 14:59:47'),
(648, 'Upload new image icon buildings.svg', '2022-08-02 14:59:47'),
(649, 'UPLOADING PATH: upload/bhomeenterprise/media/imagenes/ SITE ID: 2', '2022-08-02 15:00:25'),
(650, 'UP Array\n(\n    [name] => residential.svg\n    [type] => image/svg+xml\n    [tmp_name] => /tmp/phpmGXxQQ\n    [error] => 0\n    [size] => 1797\n)\n', '2022-08-02 15:00:25'),
(651, 'UP residential.svg jn: residential ext: svg', '2022-08-02 15:00:25'),
(652, 'Upload new image icon residential.svg', '2022-08-02 15:00:25'),
(653, 'UPLOADING PATH: upload/bhomeenterprise/media/imagenes/ SITE ID: 2', '2022-08-02 15:01:05'),
(654, 'UP Array\n(\n    [name] => industrial.svg\n    [type] => image/svg+xml\n    [tmp_name] => /tmp/phpTmDHpL\n    [error] => 0\n    [size] => 1249\n)\n', '2022-08-02 15:01:05'),
(655, 'UP industrial.svg jn: industrial ext: svg', '2022-08-02 15:01:05'),
(656, 'Upload new image icon industrial.svg', '2022-08-02 15:01:05'),
(657, 'UPLOADING PATH: upload/bhomeenterprise/media/imagenes/ SITE ID: 2', '2022-08-03 22:36:13'),
(658, 'UP Array\n(\n    [name] => anna.jpg\n    [type] => image/jpeg\n    [tmp_name] => /tmp/php8TCDub\n    [error] => 0\n    [size] => 95248\n)\n', '2022-08-03 22:36:13'),
(659, 'UP anna.jpg jn: anna ext: jpg', '2022-08-03 22:36:13'),
(660, 'Upload new image portrait anna.jpg', '2022-08-03 22:36:13'),
(661, 'UPLOADING PATH: upload/bhomeenterprise/media/imagenes/ SITE ID: 2', '2022-08-03 22:36:45'),
(662, 'UP Array\n(\n    [name] => daniela.jpg\n    [type] => image/jpeg\n    [tmp_name] => /tmp/phpwN6Jpy\n    [error] => 0\n    [size] => 159758\n)\n', '2022-08-03 22:36:45'),
(663, 'UP daniela.jpg jn: daniela ext: jpg', '2022-08-03 22:36:45'),
(664, 'Upload new image portrait daniela.jpg', '2022-08-03 22:36:45'),
(665, 'UPLOADING PATH: upload/bhomeenterprise/media/imagenes/ SITE ID: 2', '2022-08-03 22:37:18'),
(666, 'UP Array\n(\n    [name] => juan.jpg\n    [type] => image/jpeg\n    [tmp_name] => /tmp/phpqMxJyo\n    [error] => 0\n    [size] => 131338\n)\n', '2022-08-03 22:37:18'),
(667, 'UP juan.jpg jn: juan ext: jpg', '2022-08-03 22:37:18'),
(668, 'Upload new image portrait juan.jpg', '2022-08-03 22:37:18'),
(669, 'UPLOADING PATH: upload/bhomeenterprise/media/imagenes/ SITE ID: 2', '2022-08-03 22:37:47'),
(670, 'UP Array\n(\n    [name] => roberto.jpg\n    [type] => image/jpeg\n    [tmp_name] => /tmp/phpJL6nzj\n    [error] => 0\n    [size] => 87651\n)\n', '2022-08-03 22:37:47'),
(671, 'UP roberto.jpg jn: roberto ext: jpg', '2022-08-03 22:37:47'),
(672, 'Upload new image portrait roberto.jpg', '2022-08-03 22:37:47'),
(673, 'UPLOADING PATH: upload/bhomeenterprise/media/imagenes/ SITE ID: 2', '2022-08-03 22:38:14'),
(674, 'UP Array\n(\n    [name] => saul.jpg\n    [type] => image/jpeg\n    [tmp_name] => /tmp/phponC6ni\n    [error] => 0\n    [size] => 50700\n)\n', '2022-08-03 22:38:14'),
(675, 'UP saul.jpg jn: saul ext: jpg', '2022-08-03 22:38:14'),
(676, 'Upload new image portrait saul.jpg', '2022-08-03 22:38:14'),
(677, 'UPLOADING PATH: upload/bhomeenterprise/media/imagenes/ SITE ID: 2', '2022-08-03 22:40:43'),
(678, 'UP Array\n(\n    [name] => publication.jpg\n    [type] => image/jpeg\n    [tmp_name] => /tmp/phpaBQG0f\n    [error] => 0\n    [size] => 130669\n)\n', '2022-08-03 22:40:43'),
(679, 'UP publication.jpg jn: publication ext: jpg', '2022-08-03 22:40:43'),
(680, 'Upload new image cover publication.jpg', '2022-08-03 22:40:43'),
(681, 'p�ginas a ordenar 7', '2022-09-05 19:46:08'),
(682, 'Ordenar página 768 nuevo orden 1', '2022-09-05 19:46:08'),
(683, 'Ordenar página 806 nuevo orden 2', '2022-09-05 19:46:08'),
(684, 'Ordenar página 775 nuevo orden 3', '2022-09-05 19:46:08'),
(685, 'Ordenar página 776 nuevo orden 4', '2022-09-05 19:46:08'),
(686, 'Ordenar página 777 nuevo orden 5', '2022-09-05 19:46:08'),
(687, 'Ordenar página 778 nuevo orden 6', '2022-09-05 19:46:08'),
(688, 'Ordenar página 779 nuevo orden 7', '2022-09-05 19:46:08'),
(689, 'p�ginas a ordenar 5', '2023-01-23 20:32:07'),
(690, 'Ordenar página 762 nuevo orden 1', '2023-01-23 20:32:07'),
(691, 'Ordenar página 807 nuevo orden 2', '2023-01-23 20:32:07'),
(692, 'Ordenar página 764 nuevo orden 3', '2023-01-23 20:32:07'),
(693, 'Ordenar página 765 nuevo orden 4', '2023-01-23 20:32:07'),
(694, 'Ordenar página 763 nuevo orden 5', '2023-01-23 20:32:07'),
(695, 'p�ginas a ordenar 5', '2023-01-23 20:32:07'),
(696, 'Ordenar página 762 nuevo orden 1', '2023-01-23 20:32:07'),
(697, 'Ordenar página 807 nuevo orden 2', '2023-01-23 20:32:07'),
(698, 'Ordenar página 764 nuevo orden 3', '2023-01-23 20:32:07'),
(699, 'Ordenar página 765 nuevo orden 4', '2023-01-23 20:32:07'),
(700, 'Ordenar página 763 nuevo orden 5', '2023-01-23 20:32:07'),
(701, 'UPLOADING PATH: upload/bhomeenterprise/media/imagenes/ SITE ID: 2', '2024-05-15 17:32:29'),
(702, 'UP Array\n(\n    [name] => roxton image.jpg\n    [type] => image/jpeg\n    [tmp_name] => /tmp/phpSQ58LT\n    [error] => 0\n    [size] => 549153\n)\n', '2024-05-15 17:32:29'),
(703, 'UP roxton image.jpg jn: roxton image ext: jpg', '2024-05-15 17:32:29'),
(704, 'Upload new image home-photo roxton image.jpg', '2024-05-15 17:32:29'),
(705, 'p�ginas a ordenar 6', '2024-05-15 18:16:53'),
(706, 'Ordenar página 762 nuevo orden 1', '2024-05-15 18:16:53'),
(707, 'Ordenar página 808 nuevo orden 2', '2024-05-15 18:16:53'),
(708, 'Ordenar página 807 nuevo orden 3', '2024-05-15 18:16:53'),
(709, 'Ordenar página 764 nuevo orden 4', '2024-05-15 18:16:53'),
(710, 'Ordenar página 765 nuevo orden 5', '2024-05-15 18:16:53'),
(711, 'Ordenar página 763 nuevo orden 6', '2024-05-15 18:16:53');

-- --------------------------------------------------------

--
-- Table structure for table `data_collections`
--

DROP TABLE IF EXISTS `data_collections`;
CREATE TABLE IF NOT EXISTS `data_collections` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `collection_type` int DEFAULT NULL,
  `sites_id` int DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=506 DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `dynamic_datas`
--

DROP TABLE IF EXISTS `dynamic_datas`;
CREATE TABLE IF NOT EXISTS `dynamic_datas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `label` varchar(255) DEFAULT NULL,
  `value` varchar(255) DEFAULT NULL,
  `site_page_id` int DEFAULT NULL,
  `data_collection_id` int DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `external_datas`
--

DROP TABLE IF EXISTS `external_datas`;
CREATE TABLE IF NOT EXISTS `external_datas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `relation_owner_id` int DEFAULT NULL,
  `relation_owner` varchar(100) NOT NULL,
  `foreign_id` int DEFAULT NULL,
  `foreign_model` varchar(255) NOT NULL,
  `action_module` varchar(100) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

DROP TABLE IF EXISTS `images`;
CREATE TABLE IF NOT EXISTS `images` (
  `id` int NOT NULL AUTO_INCREMENT,
  `file_path` varchar(255) DEFAULT NULL,
  `file` varchar(255) DEFAULT NULL,
  `orden` mediumint DEFAULT NULL,
  `status` smallint DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `image_collection_id` int DEFAULT NULL,
  `coded_properties` text,
  `thumbnail` varchar(255) DEFAULT NULL,
  `sys_thumbnail` varchar(180) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3321 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`id`, `file_path`, `file`, `orden`, `status`, `created_at`, `updated_at`, `image_collection_id`, `coded_properties`, `thumbnail`, `sys_thumbnail`) VALUES
(3201, 'upload/bhomeenterprise/media/imagenes/8DB05B45-04A1-4508-BFE7-DFC6311DBC40.jpeg', '8DB05B45-04A1-4508-BFE7-DFC6311DBC40.jpeg', NULL, 1, '2022-07-27 15:00:21', NULL, NULL, NULL, NULL, NULL),
(3202, 'upload/bhomeenterprise/media/imagenes/homeA_1.jpg', 'homeA.jpg', NULL, 1, '2022-07-28 14:01:20', NULL, NULL, NULL, NULL, 'cache/images/homeA_1.jpg'),
(3203, 'upload/bhomeenterprise/media/imagenes/t_santa_isabel.jpg', 't_santa_isabel.jpg', NULL, 1, '2022-07-29 17:28:16', NULL, NULL, NULL, NULL, 'cache/images/t_santa_isabel.jpg'),
(3204, '.', NULL, NULL, 1, '2022-07-29 17:28:16', NULL, NULL, NULL, NULL, NULL),
(3205, '.', NULL, NULL, 1, '2022-07-29 17:28:16', NULL, NULL, NULL, NULL, NULL),
(3207, 'upload/bhomeenterprise/media/galerias/vemudldaxp.jpg', 'santa_isabel_01.jpg', NULL, 1, '2022-07-29 23:03:29', NULL, 1017, NULL, NULL, 'cache/images/vemudldaxp.jpg'),
(3208, 'upload/bhomeenterprise/media/galerias/lvaxhhjdrb.jpg', 'santa_isabel_02.jpg', 1, 1, '2022-07-29 23:03:29', NULL, 1017, NULL, NULL, 'cache/images/lvaxhhjdrb.jpg'),
(3209, 'upload/bhomeenterprise/media/galerias/ujhyulqddj.jpg', 'santa_isabel_03.jpg', 2, 1, '2022-07-29 23:03:29', NULL, 1017, NULL, NULL, 'cache/images/ujhyulqddj.jpg'),
(3210, 'upload/bhomeenterprise/media/galerias/xbzmawxjkc.jpg', 'santa_isabel_04.jpg', 3, 1, '2022-07-29 23:03:29', NULL, 1017, NULL, NULL, 'cache/images/xbzmawxjkc.jpg'),
(3211, 'upload/bhomeenterprise/media/galerias/whjxhvzwlz.jpg', 'santa_isabel_06.jpg', 5, 1, '2022-07-29 23:03:29', NULL, 1017, NULL, NULL, 'cache/images/whjxhvzwlz.jpg'),
(3212, 'upload/bhomeenterprise/media/galerias/himuaooclw.jpg', 'santa_isabel_09.jpg', 8, 1, '2022-07-29 23:03:29', NULL, 1017, NULL, NULL, 'cache/images/himuaooclw.jpg'),
(3213, 'upload/bhomeenterprise/media/galerias/xgtmxauawi.jpg', 'santa_isabel_08.jpg', 7, 1, '2022-07-29 23:03:29', NULL, 1017, NULL, NULL, 'cache/images/xgtmxauawi.jpg'),
(3214, 'upload/bhomeenterprise/media/galerias/uwliadanuy.jpg', 'santa_isabel_07.jpg', 6, 1, '2022-07-29 23:03:29', NULL, 1017, NULL, NULL, 'cache/images/uwliadanuy.jpg'),
(3215, 'upload/bhomeenterprise/media/galerias/xukcmkynhk.jpg', 'santa_isabel_05.jpg', 4, 1, '2022-07-29 23:03:29', NULL, 1017, NULL, NULL, 'cache/images/xukcmkynhk.jpg'),
(3216, 'upload/bhomeenterprise/media/imagenes/1_1_1.jpeg', '1_1.jpeg', NULL, 1, '2022-07-29 18:06:37', NULL, NULL, NULL, NULL, 'cache/images/1_1_1.jpeg'),
(3217, 'upload/bhomeenterprise/media/imagenes/derby_1.gif', 'derby.gif', NULL, 1, '2022-07-29 18:06:37', NULL, NULL, NULL, NULL, 'cache/images/derby_1.gif'),
(3218, 'upload/bhomeenterprise/media/imagenes/paint.jpg', 'paint.jpg', NULL, 1, '2022-07-29 18:06:37', NULL, NULL, NULL, NULL, 'cache/images/paint.jpg'),
(3227, 'upload/bhomeenterprise/media/galerias/zslydbtxnk.jpg', 'canyon-elementary2.jpg', 1, 1, '2022-07-29 23:17:23', NULL, 1020, '{\"image_link\":\"http:\\/\\/\",\"image_name\":\"\",\"image_description\":\"Notice: Trying to get property \'image_description\' of non-object in \\/var\\/www\\/html\\/cms\\/Cms\\/View\\/image\\/popconfigure.php on line 70rn\"}', NULL, 'cache/images/zslydbtxnk.jpg'),
(3228, 'upload/bhomeenterprise/media/galerias/gluvbnzsom.jpg', 'pexels-elina-sazonova-1850629.jpg', 2, 1, '2022-07-29 23:17:23', NULL, 1020, '{\"image_link\":\"http:\\/\\/\",\"image_name\":\"\",\"image_description\":\"Notice: Trying to get property \'image_description\' of non-object in \\/var\\/www\\/html\\/cms\\/Cms\\/View\\/image\\/popconfigure.php on line 70rn\"}', NULL, 'cache/images/gluvbnzsom.jpg'),
(3229, 'upload/bhomeenterprise/media/galerias/dkhtzsocvj.jpg', 'handsworth-high1.jpg', 3, 1, '2022-07-29 23:18:00', NULL, 1020, NULL, NULL, 'cache/images/dkhtzsocvj.jpg'),
(3230, 'upload/bhomeenterprise/media/galerias/epdfkxdqcq.jpg', 'highlands2.jpg', 4, 1, '2022-07-29 23:18:15', NULL, 1020, NULL, NULL, 'cache/images/epdfkxdqcq.jpg'),
(3231, 'upload/bhomeenterprise/media/galerias/dvmijsadlm.jpg', 'Hockey-Academy-0779---Copy.jpg', 5, 1, '2022-07-29 23:18:24', NULL, 1020, NULL, NULL, 'cache/images/dvmijsadlm.jpg'),
(3232, 'upload/bhomeenterprise/media/galerias/zoaxyvtyme.jpg', 'Capilano_river.jpg', 6, 1, '2022-07-29 23:18:41', NULL, 1020, NULL, NULL, 'cache/images/zoaxyvtyme.jpg'),
(3233, 'upload/bhomeenterprise/media/galerias/fnrigoaoyb.jpg', 'Pexels-lukas.jpg', 7, 1, '2022-07-29 23:19:05', NULL, 1020, NULL, NULL, 'cache/images/fnrigoaoyb.jpg'),
(3234, 'upload/bhomeenterprise/media/galerias/zsrgmngoja.jpg', 'cleveland_dam.jpg', 8, 1, '2022-07-29 23:19:16', NULL, 1020, NULL, NULL, 'cache/images/zsrgmngoja.jpg'),
(3235, 'upload/bhomeenterprise/media/imagenes/t_punta_mita.jpg', 't_punta_mita.jpg', NULL, 1, '2022-07-29 18:37:09', NULL, NULL, NULL, NULL, 'cache/images/t_punta_mita.jpg'),
(3236, '.', NULL, NULL, 1, '2022-07-29 18:37:09', NULL, NULL, NULL, NULL, NULL),
(3237, '.', NULL, NULL, 1, '2022-07-29 18:37:09', NULL, NULL, NULL, NULL, NULL),
(3238, 'upload/bhomeenterprise/media/galerias/dkrfbquvre.jpg', 'mita_03.jpg', 2, 1, '2022-07-29 23:37:24', NULL, 1021, NULL, NULL, 'cache/images/dkrfbquvre.jpg'),
(3239, 'upload/bhomeenterprise/media/galerias/zspdehibvg.jpg', 'mita_02.jpg', 1, 1, '2022-07-29 23:37:25', NULL, 1021, NULL, NULL, 'cache/images/zspdehibvg.jpg'),
(3240, 'upload/bhomeenterprise/media/galerias/kdsusqegyk.jpg', 'mita_01.jpg', NULL, 1, '2022-07-29 23:37:25', NULL, 1021, NULL, NULL, 'cache/images/kdsusqegyk.jpg'),
(3241, 'upload/bhomeenterprise/media/imagenes/jepo.jpg', 'jepo.jpg', NULL, 1, '2022-07-29 21:57:56', NULL, NULL, NULL, NULL, 'cache/images/jepo.jpg'),
(3242, '.', NULL, NULL, 1, '2022-07-29 21:58:44', NULL, NULL, NULL, NULL, NULL),
(3243, 'upload/bhomeenterprise/media/imagenes/residential.jpg', 'residential.jpg', NULL, 1, '2022-07-29 22:00:29', NULL, NULL, NULL, NULL, 'cache/images/residential.jpg'),
(3244, 'upload/bhomeenterprise/media/imagenes/residential_1.jpg', 'residential.jpg', NULL, 1, '2022-07-29 22:02:02', NULL, NULL, NULL, NULL, 'cache/images/residential_1.jpg'),
(3245, 'upload/bhomeenterprise/media/imagenes/industrial.jpg', 'industrial.jpg', NULL, 1, '2022-07-29 22:03:01', NULL, NULL, NULL, NULL, 'cache/images/industrial.jpg'),
(3246, 'upload/bhomeenterprise/media/imagenes/homes.svg', 'homes.svg', NULL, 1, '2022-08-02 14:58:17', NULL, NULL, NULL, NULL, NULL),
(3247, 'upload/bhomeenterprise/media/imagenes/buildings.svg', 'buildings.svg', NULL, 1, '2022-08-02 14:59:47', NULL, NULL, NULL, NULL, NULL),
(3248, 'upload/bhomeenterprise/media/imagenes/residential.svg', 'residential.svg', NULL, 1, '2022-08-02 15:00:25', NULL, NULL, NULL, NULL, NULL),
(3249, 'upload/bhomeenterprise/media/imagenes/industrial.svg', 'industrial.svg', NULL, 1, '2022-08-02 15:01:05', NULL, NULL, NULL, NULL, NULL),
(3250, '.', NULL, NULL, 1, '2022-08-02 15:01:31', NULL, NULL, NULL, NULL, NULL),
(3251, 'upload/bhomeenterprise/media/imagenes/casa.jpg', 'casa.jpg', NULL, 1, '2022-08-03 19:18:37', NULL, NULL, NULL, NULL, 'cache/images/casa.jpg'),
(3252, 'upload/bhomeenterprise/media/imagenes/eugenio.jpg', 'eugenio.jpg', NULL, 1, '2022-08-03 19:18:59', NULL, NULL, NULL, NULL, 'cache/images/eugenio.jpg'),
(3253, 'upload/bhomeenterprise/media/imagenes/4.jpg', '4.jpg', NULL, 1, '2022-08-03 21:38:21', NULL, NULL, NULL, NULL, 'cache/images/4.jpg'),
(3254, 'upload/bhomeenterprise/media/imagenes/anna.jpg', 'anna.jpg', NULL, 1, '2022-08-03 22:36:13', NULL, NULL, NULL, NULL, 'cache/images/anna.jpg'),
(3255, 'upload/bhomeenterprise/media/imagenes/daniela.jpg', 'daniela.jpg', NULL, 1, '2022-08-03 22:36:45', NULL, NULL, NULL, NULL, 'cache/images/daniela.jpg'),
(3256, 'upload/bhomeenterprise/media/imagenes/juan.jpg', 'juan.jpg', NULL, 1, '2022-08-03 22:37:18', NULL, NULL, NULL, NULL, 'cache/images/juan.jpg'),
(3257, 'upload/bhomeenterprise/media/imagenes/roberto.jpg', 'roberto.jpg', NULL, 1, '2022-08-03 22:37:47', NULL, NULL, NULL, NULL, 'cache/images/roberto.jpg'),
(3258, 'upload/bhomeenterprise/media/imagenes/saul.jpg', 'saul.jpg', NULL, 1, '2022-08-03 22:38:14', NULL, NULL, NULL, NULL, 'cache/images/saul.jpg'),
(3259, 'upload/bhomeenterprise/media/imagenes/t_2017_abrl_ad.jpg', 't_2017_abrl_ad.jpg', NULL, 1, '2022-08-03 22:40:43', NULL, NULL, NULL, NULL, 'cache/images/t_2017_abrl_ad.jpg'),
(3260, '.', NULL, NULL, 1, '2022-09-05 19:45:59', NULL, NULL, NULL, NULL, NULL),
(3261, 'upload/bhomeenterprise/media/imagenes/t_mathers.jpg', 't_mathers.jpg', NULL, 1, '2023-01-23 20:31:49', NULL, NULL, NULL, NULL, 'cache/images/t_mathers.jpg'),
(3262, 'upload/bhomeenterprise/media/imagenes/anim_plants_mather_1.gif', 'anim_plants_mather.gif', NULL, 1, '2023-01-23 20:31:49', NULL, NULL, NULL, NULL, 'cache/images/anim_plants_mather_1.gif'),
(3263, '.', NULL, NULL, 1, '2023-01-23 20:31:49', NULL, NULL, NULL, NULL, NULL),
(3264, 'upload/bhomeenterprise/media/galerias/ppukuewohh.jpg', '1685_mathers_02.jpg', 1, 1, '2023-01-24 22:54:16', NULL, 1023, NULL, NULL, 'cache/images/ppukuewohh.jpg'),
(3265, 'upload/bhomeenterprise/media/galerias/xhxnacwxrd.jpg', '1685_mathers_03.jpg', 1, 1, '2023-01-24 22:54:16', NULL, 1023, NULL, NULL, 'cache/images/xhxnacwxrd.jpg'),
(3266, 'upload/bhomeenterprise/media/galerias/bsmnyhkqfv.jpg', '1685_mathers_01.jpg', 2, 1, '2023-01-24 22:54:16', NULL, 1023, NULL, NULL, 'cache/images/bsmnyhkqfv.jpg'),
(3267, 'upload/bhomeenterprise/media/galerias/rggzcinpne.jpg', 'pexels-james-wheeler-1630885.jpg', NULL, 1, '2023-01-25 02:04:12', NULL, 1024, NULL, NULL, 'cache/images/rggzcinpne.jpg'),
(3268, 'upload/bhomeenterprise/media/galerias/eilfkihlsr.jpg', 'pexels-james-wheeler-3882514.jpg', 1, 1, '2023-01-25 02:04:12', NULL, 1024, NULL, NULL, 'cache/images/eilfkihlsr.jpg'),
(3269, 'upload/bhomeenterprise/media/galerias/vrvrjlgjyk.jpg', 'pexels-adi-k-3222187.jpg', 2, 1, '2023-01-25 02:04:12', NULL, 1024, NULL, NULL, 'cache/images/vrvrjlgjyk.jpg'),
(3270, 'upload/bhomeenterprise/media/galerias/mvdcrrzuhc.jpg', 'pexels-lukas-kloeppel-2416602.jpg', 7, 1, '2023-01-25 02:04:12', NULL, 1024, NULL, NULL, 'cache/images/mvdcrrzuhc.jpg'),
(3271, 'upload/bhomeenterprise/media/galerias/rizgfonimh.jpg', 'pexels-jaxon-castellan-9969065.jpg', 4, 1, '2023-01-25 02:04:12', NULL, 1024, NULL, NULL, 'cache/images/rizgfonimh.jpg'),
(3272, 'upload/bhomeenterprise/media/galerias/bgvfzppzic.jpg', 'pexels-pixabay-63332.jpg', 5, 1, '2023-01-25 02:04:12', NULL, 1024, NULL, NULL, 'cache/images/bgvfzppzic.jpg'),
(3273, 'upload/bhomeenterprise/media/galerias/axallestgz.jpg', 'pexels-khantushig-khosbayar-11449468.jpg', 8, 1, '2023-01-25 02:04:12', NULL, 1024, NULL, NULL, 'cache/images/axallestgz.jpg'),
(3274, 'upload/bhomeenterprise/media/galerias/oerxhzvqbx.jpg', 'pexels-pnw-production-8997725.jpg', 6, 1, '2023-01-25 02:04:12', NULL, 1024, NULL, NULL, 'cache/images/oerxhzvqbx.jpg'),
(3275, 'upload/bhomeenterprise/media/galerias/zqopwwlvpt.jpg', 'pexels-pnw-production-8997731.jpg', 9, 1, '2023-01-25 02:04:12', NULL, 1024, NULL, NULL, 'cache/images/zqopwwlvpt.jpg'),
(3276, 'upload/bhomeenterprise/media/galerias/qacnsdjrqq.jpg', 'pexels-luke-miller-5623288.jpg', 3, 1, '2023-01-25 02:04:12', NULL, 1024, NULL, NULL, 'cache/images/qacnsdjrqq.jpg'),
(3277, 'upload/bhomeenterprise/media/galerias/txafhedhuz.jpg', 'pexels-tomas-williams-2287233.jpg', 10, 1, '2023-01-25 02:04:12', NULL, 1024, NULL, NULL, 'cache/images/txafhedhuz.jpg'),
(3278, NULL, NULL, NULL, NULL, '2023-01-26 18:31:55', NULL, NULL, NULL, NULL, NULL),
(3280, 'upload/bhomeenterprise/media/galerias/vxkuvkzgwk.jpeg', '1.jpeg', 9, 1, '2023-10-05 17:28:55', NULL, 1019, NULL, NULL, 'cache/images/vxkuvkzgwk.jpeg'),
(3281, 'upload/bhomeenterprise/media/galerias/piypjmhcyt.jpeg', '2.jpeg', 10, 1, '2023-10-05 17:29:24', NULL, 1019, NULL, NULL, 'cache/images/piypjmhcyt.jpeg'),
(3282, 'upload/bhomeenterprise/media/galerias/qijtmtejom.jpeg', '3.jpeg', 11, 1, '2023-10-05 17:29:30', NULL, 1019, NULL, NULL, 'cache/images/qijtmtejom.jpeg'),
(3283, 'upload/bhomeenterprise/media/galerias/gamkyypzkc.jpg', '5.jpg', 12, 1, '2023-10-05 17:29:36', NULL, 1019, NULL, NULL, 'cache/images/gamkyypzkc.jpg'),
(3284, 'upload/bhomeenterprise/media/galerias/clurpmgloq.jpg', '6.jpg', 13, 1, '2023-10-05 17:30:03', NULL, 1019, NULL, NULL, 'cache/images/clurpmgloq.jpg'),
(3285, 'upload/bhomeenterprise/media/galerias/dqvqqyvjee.jpg', '7.jpg', 14, 1, '2023-10-05 17:30:06', NULL, 1019, NULL, NULL, 'cache/images/dqvqqyvjee.jpg'),
(3286, 'upload/bhomeenterprise/media/galerias/mumlutiann.jpg', '8.jpg', 15, 1, '2023-10-05 17:30:17', NULL, 1019, NULL, NULL, 'cache/images/mumlutiann.jpg'),
(3287, 'upload/bhomeenterprise/media/galerias/xfcjvaoqfw.jpg', '9.jpg', 16, 1, '2023-10-05 17:30:23', NULL, 1019, NULL, NULL, 'cache/images/xfcjvaoqfw.jpg'),
(3288, 'upload/bhomeenterprise/media/galerias/sitrbhggrg.jpg', '10.jpg', 17, 1, '2023-10-05 17:30:28', NULL, 1019, NULL, NULL, 'cache/images/sitrbhggrg.jpg'),
(3289, 'upload/bhomeenterprise/media/galerias/koyhpebszw.jpg', '11.jpg', 18, 1, '2023-10-05 17:30:33', NULL, 1019, NULL, NULL, 'cache/images/koyhpebszw.jpg'),
(3290, 'upload/bhomeenterprise/media/imagenes/roxton image_1.jpg', 'roxton image.jpg', NULL, 1, '2024-05-15 17:32:29', NULL, NULL, NULL, NULL, 'cache/images/roxton image_1.jpg'),
(3291, '.', NULL, NULL, 1, '2024-05-15 17:32:29', NULL, NULL, NULL, NULL, NULL),
(3292, 'upload/bhomeenterprise/media/imagenes/Roxton.jpg', 'Roxton.jpg', NULL, 1, '2024-05-15 17:32:29', NULL, NULL, NULL, NULL, 'cache/images/Roxton.jpg'),
(3293, 'upload/bhomeenterprise/media/galerias/hdualejrnl.jpg', 'roxton image.jpg', 1, 1, '2024-05-15 23:39:01', NULL, 1025, NULL, NULL, 'cache/images/hdualejrnl.jpg'),
(3294, 'upload/bhomeenterprise/media/galerias/fnggkmwbct.png', '01.png', 2, 1, '2024-05-16 04:41:05', NULL, 1025, NULL, NULL, 'cache/images/fnggkmwbct.png'),
(3295, 'upload/bhomeenterprise/media/galerias/wydtblcfns.png', '02.png', 3, 1, '2024-05-16 04:41:27', NULL, 1025, NULL, NULL, 'cache/images/wydtblcfns.png'),
(3296, 'upload/bhomeenterprise/media/galerias/rgblpgxhzy.png', '03.png', 4, 1, '2024-05-16 04:41:33', NULL, 1025, NULL, NULL, 'cache/images/rgblpgxhzy.png'),
(3297, 'upload/bhomeenterprise/media/galerias/jytlyzthjm.png', '04.png', 5, 1, '2024-05-16 04:41:38', NULL, 1025, NULL, NULL, 'cache/images/jytlyzthjm.png'),
(3298, 'upload/bhomeenterprise/media/galerias/sjwbclpohh.png', '05.png', 6, 1, '2024-05-16 04:41:43', NULL, 1025, NULL, NULL, 'cache/images/sjwbclpohh.png'),
(3299, 'upload/bhomeenterprise/media/galerias/gliufvujur.png', '06.png', 7, 1, '2024-05-16 04:41:48', NULL, 1025, NULL, NULL, 'cache/images/gliufvujur.png'),
(3306, 'upload/bhomeenterprise/media/galerias/igaqneecom.jpg', 'City Hall.jpg', 1, 1, '2024-05-18 21:40:54', NULL, 1026, NULL, NULL, 'cache/images/igaqneecom.jpg'),
(3307, 'upload/bhomeenterprise/media/galerias/mynwdgpakw.jpg', '1634339-bm1a.jpg', 2, 1, '2024-05-18 21:41:08', NULL, 1026, NULL, NULL, 'cache/images/mynwdgpakw.jpg'),
(3309, 'upload/bhomeenterprise/media/galerias/klzdjkgpfz.JPG', 'IMG_E5921.JPG', 4, 1, '2024-05-18 21:41:33', NULL, 1026, NULL, NULL, 'cache/images/klzdjkgpfz.JPG'),
(3310, 'upload/bhomeenterprise/media/galerias/rsjzkumwnf.JPG', 'Coquitlam BC_How to Explore like a Local_ Towne Centre Park.JPG', 5, 1, '2024-05-18 21:41:36', NULL, 1026, NULL, NULL, 'cache/images/rsjzkumwnf.JPG'),
(3311, 'upload/bhomeenterprise/media/galerias/bizghyvzzh.JPG', 'Coquitlam BC- How to Explore Like a Local_Towne Centre Park.JPG', 6, 1, '2024-05-18 21:41:39', NULL, 1026, NULL, NULL, 'cache/images/bizghyvzzh.JPG'),
(3312, 'upload/bhomeenterprise/media/galerias/tkgqoqcsup.jpg', 'Park.jpg', 7, 1, '2024-05-18 21:41:46', NULL, 1026, NULL, NULL, 'cache/images/tkgqoqcsup.jpg'),
(3313, 'upload/bhomeenterprise/media/galerias/apcfaoyahg.jpg', 'Park 3.jpg', 8, 1, '2024-05-18 21:41:49', NULL, 1026, NULL, NULL, 'cache/images/apcfaoyahg.jpg'),
(3314, 'upload/bhomeenterprise/media/galerias/btvnpyhcvy.jpeg', 'destination-coquitlam-1.jpeg', 9, 1, '2024-05-18 21:43:17', NULL, 1026, NULL, NULL, 'cache/images/btvnpyhcvy.jpeg'),
(3317, 'upload/bhomeenterprise/media/galerias/wcutbkjsbf.jpg', 'Day-32-Maillardville.jpg', 10, 1, '2024-05-18 21:46:48', NULL, 1026, NULL, NULL, 'cache/images/wcutbkjsbf.jpg'),
(3319, '.', NULL, NULL, 1, '2024-11-19 05:02:44', NULL, NULL, NULL, NULL, NULL),
(3320, '.', NULL, NULL, 1, '2024-11-19 05:28:49', NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `image_collections`
--

DROP TABLE IF EXISTS `image_collections`;
CREATE TABLE IF NOT EXISTS `image_collections` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `description` text,
  `width` int DEFAULT NULL,
  `height` int DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1027 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `image_collections`
--

INSERT INTO `image_collections` (`id`, `name`, `description`, `width`, `height`, `created_at`, `updated_at`) VALUES
(1017, NULL, NULL, NULL, NULL, '2022-07-29 17:28:16', NULL),
(1018, NULL, NULL, NULL, NULL, '2022-07-29 17:28:16', NULL),
(1019, NULL, NULL, NULL, NULL, '2022-07-29 18:06:37', NULL),
(1020, NULL, NULL, NULL, NULL, '2022-07-29 18:06:37', NULL),
(1021, NULL, NULL, NULL, NULL, '2022-07-29 18:37:09', NULL),
(1022, NULL, NULL, NULL, NULL, '2022-07-29 18:37:09', NULL),
(1023, NULL, NULL, NULL, NULL, '2023-01-23 20:31:48', NULL),
(1024, NULL, NULL, NULL, NULL, '2023-01-23 20:31:49', NULL),
(1025, NULL, NULL, NULL, NULL, '2024-05-15 17:32:29', NULL),
(1026, NULL, NULL, NULL, NULL, '2024-05-15 17:32:29', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `menu_items`
--

DROP TABLE IF EXISTS `menu_items`;
CREATE TABLE IF NOT EXISTS `menu_items` (
  `id` int NOT NULL AUTO_INCREMENT,
  `site_menu_id` int DEFAULT NULL,
  `title` varchar(200) DEFAULT NULL,
  `content_id` int DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `content_type` smallint DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `parent_id` int DEFAULT NULL,
  `orden` mediumint DEFAULT NULL,
  `parent_type` smallint DEFAULT NULL,
  `publish_status` tinyint DEFAULT '1',
  `index_status` tinyint DEFAULT '0',
  `code_name` varchar(255) DEFAULT NULL,
  `lang_code` varchar(3) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `page_datas`
--

DROP TABLE IF EXISTS `page_datas`;
CREATE TABLE IF NOT EXISTS `page_datas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `data_type` smallint DEFAULT NULL,
  `str_value` varchar(255) DEFAULT NULL,
  `int_value` int DEFAULT NULL,
  `text_value` text,
  `date_value` date DEFAULT NULL,
  `foreign_id` int DEFAULT NULL,
  `foreign_model` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `site_page_id` int DEFAULT NULL,
  `structure_field_id` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6875 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `page_datas`
--

INSERT INTO `page_datas` (`id`, `data_type`, `str_value`, `int_value`, `text_value`, `date_value`, `foreign_id`, `foreign_model`, `created_at`, `updated_at`, `site_page_id`, `structure_field_id`) VALUES
(6690, 2, NULL, NULL, 'Title here', NULL, NULL, NULL, NULL, NULL, 760, 25),
(6691, 4, NULL, NULL, NULL, NULL, 3201, 'Cms_Model_Image', NULL, NULL, 760, 26),
(6692, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 761, 25),
(6693, 4, NULL, NULL, NULL, NULL, 3202, 'Cms_Model_Image', NULL, NULL, 761, 26),
(6694, 5, NULL, NULL, NULL, NULL, 1017, 'Cms_Model_ImageCollection', NULL, NULL, 763, 31),
(6695, 3, NULL, NULL, '<p>Located in nearby Guadalajara City, this residence main  characteristics are: it&rsquo;s cozyness and freshness trhough vibrant  colors, along with a smart way to inlcude bio-climate strategies into  the integral design of the house.  Moreover, it uses the emblematic &ldquo;patio&rdquo; as a corner stone design guide  in order to promote the interaction among the family members and their  contact with nature. It is also surrounded my wondersful views of the  surrondings. Interiorwise, this residence promotes  the values of the family through active communicative space  relationships and a wise use of natural finishes and meterials. Overall,  an effective way to set a frame for a family life!</p>\r\n<h6>Credits:</h6>\r\n<p>Architecture: <a href=\"https://www.legorreta.mx/en/index\" target=\"_blank\">Legorreta Aquitectos S.C.</a></p>\r\n<p>Photo credits: Lourdes Legorreta</p>', NULL, NULL, NULL, NULL, NULL, 763, 32),
(6696, 9, 'Built', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 763, 33),
(6697, 4, NULL, NULL, NULL, NULL, 3203, 'Cms_Model_Image', NULL, NULL, 763, 34),
(6698, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 763, 35),
(6699, 4, NULL, NULL, NULL, NULL, 3204, 'Cms_Model_Image', NULL, NULL, 763, 36),
(6700, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 763, 37),
(6701, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 763, 38),
(6702, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 763, 39),
(6703, 5, NULL, NULL, NULL, NULL, 1018, 'Cms_Model_ImageCollection', NULL, NULL, 763, 40),
(6704, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 763, 41),
(6705, 4, NULL, NULL, NULL, NULL, 3205, 'Cms_Model_Image', NULL, NULL, 763, 42),
(6706, 2, NULL, NULL, 'Beautiful and functional residential architecture.', NULL, NULL, NULL, '2022-07-29 17:47:21', NULL, 762, 43),
(6707, 5, NULL, NULL, NULL, NULL, 1019, 'Cms_Model_ImageCollection', NULL, NULL, 764, 31),
(6708, 3, NULL, NULL, '<p>Under the leadership of our highly creative team of architects and  designers, BHOME has worked to fully renovate 4436 Derby Place  Residence, integrating a variety of modern architectural elements with  comfortable, high quality enhanced ambiances.</p>\r\n<p>We have adapted the residence&rsquo;s easy-going functionality with  today&rsquo;s lifestyle and to make it a a beautiful addition and sight for  the entire neighborhood.</p>\r\n<p><strong><a href=\"https://my.matterport.com/show/?m=AdvMVvFimZX\" target=\"_blank\">Take a 360&deg; VR Tour of the Derby Place House!</a></strong></p>', NULL, NULL, NULL, NULL, NULL, 764, 32),
(6709, 9, 'Built', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 764, 33),
(6710, 4, NULL, NULL, NULL, NULL, 3216, 'Cms_Model_Image', NULL, NULL, 764, 34),
(6711, 3, NULL, NULL, '<ul id=\"lista\">\r\n<li><span>2 Levels</span></li>\r\n<li><span>5 Bedrooms</span></li>\r\n<li><span>5 Bathrooms</span></li>\r\n<li><span>Open Kitchen</span></li>\r\n<li><span>Open Livingroom</span></li>\r\n<li><span>Dining Room</span></li>\r\n<li><span>Family Room</span></li>\r\n<li><span>Laundry</span></li>\r\n<li><span>Pet Shower</span></li>\r\n<li><span>Hot Tube</span></li>\r\n<li><span>Fire Pit</span></li>\r\n<li><span>BBQ Terrace (Deck)</span></li>\r\n<li><span>Areas:</span></li>\r\n<li><span>Main Level 1,302.03 ft<sup>2</sup></span></li>\r\n<li><span>Down Level 1,277.13 ft<sup>2</sup></span></li>\r\n<li><span>Garage 186.70 ft<sup>2</sup></span></li>\r\n<li><span>Deck 489.63 ft<sup>2</sup></span></li>\r\n<li><span>Total: 8,996 ft<sup>2</sup></span></li>\r\n</ul>\r\n<ul id=\"lista\">\r\n</ul>', NULL, NULL, NULL, NULL, NULL, 764, 35),
(6712, 4, NULL, NULL, NULL, NULL, 3217, 'Cms_Model_Image', NULL, NULL, 764, 36),
(6713, 3, NULL, NULL, '<p>4436 Derby Place is located 100 m. from Canyon Heights Elementary  School, 350 m. from Handsworth Secondary &amp; High School. Edgemont  Village, an emblematic place with local cafes, and great shopping and  dining are only 1.5 km away.</p>\r\n<p>Moreover, this area has consolidated as one of the highest-value  areas for new families, due to the impressive appreciation of its  properties during the last few years. Not only are new houses being  developed, but most of its houses that were built in the 50&rsquo;s, are now  being remodeled, accelerating its modernization and appreciation.</p>\r\n<p>Recent statistics show it is an active market being one of the top preferences for buyers.</p>', NULL, NULL, NULL, NULL, NULL, 764, 37),
(6714, 2, NULL, NULL, '<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2599.0569226292087!2d-123.09742878397802!3d49.35107117384291!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x54866fc28051caa7%3A0x477ae56dafa2b4f8!2s4436%20Derby%20Pl%2C%20North%20Vancouver%2C%20BC%20V7R%203S1%2C%20Canada!5e0!3m2!1sen!2smx!4v1661178512802!5m2!1sen!2smx\" width=\"100%\" height=\"700\" style=\"border:0; max-height:800px;\" allowfullscreen=\"\" loading=\"lazy\" referrerpolicy=\"no-referrer-when-downgrade\"></iframe>', NULL, NULL, NULL, NULL, NULL, 764, 38),
(6715, 3, NULL, NULL, '<h6>North Vancouver</h6>\r\n<p>We chose to start operations in North Vancouver for the following reasons:</p>\r\n<ol id=\"lista2\">\r\n<li><span>Its strategic location with close and easy access to the Downtown area and Sky Grouse, Seymour and Cypress centers.</span></li>\r\n<li><span>High quality of life that integrates the incredible Canadian nature and the comforts offered by the city of Vancouver.</span></li>\r\n<li><span>It is one of Canada\'s wealthiest and most beautiful communities.</span></li>\r\n<li><span>It is fitted with world-class ski hills, hiking trails, boating and swimming.</span></li>\r\n<li><span>One of Metro Vancouver\'s greenest municipalities, with 11 km of green space.</span></li>\r\n</ol>', NULL, NULL, NULL, NULL, NULL, 764, 39),
(6716, 5, NULL, NULL, NULL, NULL, 1020, 'Cms_Model_ImageCollection', NULL, NULL, 764, 40),
(6717, 3, NULL, NULL, '<h6><span>A Special Gift</span></h6>\r\n<p>As a thank you gift, for your trust in our team we have partnered with  Artist Margarita Pointelin to gift you a painting of hers. Also as a  reminder of the beauty of transformation that the monarch butterfly  represents. We invite you to click here to know more about her work and  trajectory.</p>\r\n<p><a href=\"http://bhomeenterprise.ca/pdf/artista.pdf\" target=\"_blank\">Meet the artist</a> <a href=\"https://www.margaritapointelin.art\" target=\"_blank\">margaritapointelin.art</a></p>', NULL, NULL, NULL, NULL, NULL, 764, 41),
(6718, 4, NULL, NULL, NULL, NULL, 3218, 'Cms_Model_Image', NULL, NULL, 764, 42),
(6719, 5, NULL, NULL, NULL, NULL, 1021, 'Cms_Model_ImageCollection', NULL, NULL, 765, 31),
(6720, 3, NULL, NULL, '<p>Punta Mita is a beatifil location  on the Pacific beaches of Colima. This residences integrates a variety  of modern architectural elements with comfortable, high quality enhanced  ambiances.</p>\r\n<p>We have adapted the residence&rsquo;s  easy-going functionality with today&rsquo;s lifestyle and to make it a a  beautiful addition and sight for a peaceful and laid back way of living.</p>\r\n<h6>Credits:</h6>\r\n<p>Architecture: <a href=\"https://www.legorreta.mx/en/index\" target=\"_blank\">Legorreta Aquitectos S.C.</a></p>\r\n<p>Photo credits: Lourdes Legorreta</p>', NULL, NULL, NULL, NULL, NULL, 765, 32),
(6721, 9, 'Under design', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 765, 33),
(6722, 4, NULL, NULL, NULL, NULL, 3235, 'Cms_Model_Image', NULL, NULL, 765, 34),
(6723, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 765, 35),
(6724, 4, NULL, NULL, NULL, NULL, 3236, 'Cms_Model_Image', NULL, NULL, 765, 36),
(6725, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 765, 37),
(6726, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 765, 38),
(6727, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 765, 39),
(6728, 5, NULL, NULL, NULL, NULL, 1022, 'Cms_Model_ImageCollection', NULL, NULL, 765, 40),
(6729, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 765, 41),
(6730, 4, NULL, NULL, NULL, NULL, 3237, 'Cms_Model_Image', NULL, NULL, 765, 42),
(6731, 3, NULL, NULL, '<p>A serial entrepreneur, BHOME&rsquo;s founder, and CEO, Jose Portillo, founded his first real estate development company together with his family in 2002. Since then, he has been leading a conglomerate of vertically and horizontally integrated companies, developing +5,000 homes and urbanizing +9,000,000 square feet for +USD $80M in Jalisco, Mexico.</p>\r\n<p>Since 2018, the company ventured into industrial real estate under his leadership, building its first +96,000 square feet warehouse, a railway sidewalk, and two 1,000 meters long railway branch lines.</p>\r\n<h2>Uniting families with their environment</h2>\r\n<p>After graduating from the Faculty of Civil Engineering at the Tecnol&oacute;gico de Estudios Superiores de Occidente (ITESO), he completed his first Master\'s Degree program in Business Fundamentals, Business Administration and Guidance.</p>\r\n<p>Later, he became first in his class and got selected as a graduate speaker after completing his second Master&rsquo;s Degree Program in Control and Strategic Marketing at Universidad Panamericana (UP) in Guadalajara City.</p>', NULL, NULL, NULL, NULL, NULL, 766, 27),
(6732, 4, NULL, NULL, NULL, NULL, 3241, 'Cms_Model_Image', NULL, NULL, 766, 28),
(6733, 1, 'In 2021 we started operations, in North Vancouver, with all our expertise and passion for building always combining aesthetics and functionality.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 766, 44),
(6734, 1, '30', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 768, 46),
(6735, 4, NULL, NULL, NULL, NULL, 3242, 'Cms_Model_Image', NULL, NULL, 768, 47),
(6736, 4, NULL, NULL, NULL, NULL, 3243, 'Cms_Model_Image', NULL, NULL, 769, 48),
(6737, 2, NULL, NULL, 'El Salto, Jalisco, México | in process | area 70 ac | 2,154 houses and retail stores.', NULL, NULL, NULL, NULL, NULL, 770, 49),
(6738, 1, '2018', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 770, 50),
(6739, 4, NULL, NULL, NULL, NULL, 3244, 'Cms_Model_Image', NULL, NULL, 771, 48),
(6740, 2, NULL, NULL, 'Riviera, Nayarit, Mexico | living area 13,455 sqft.', NULL, NULL, NULL, NULL, NULL, 772, 49),
(6741, 1, '2017', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 772, 50),
(6742, 4, NULL, NULL, NULL, NULL, 3245, 'Cms_Model_Image', NULL, NULL, 773, 48),
(6743, 2, NULL, NULL, 'El Salto, Jalisco, México | lenght 900 m.', NULL, NULL, NULL, NULL, NULL, 774, 49),
(6744, 1, '2019', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 774, 50),
(6745, 1, '5', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 775, 46),
(6746, 4, NULL, NULL, NULL, NULL, 3246, 'Cms_Model_Image', NULL, NULL, 775, 47),
(6747, 1, '9', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 776, 46),
(6748, 4, NULL, NULL, NULL, NULL, 3247, 'Cms_Model_Image', NULL, NULL, 776, 47),
(6749, 1, '40', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 777, 46),
(6750, 4, NULL, NULL, NULL, NULL, 3248, 'Cms_Model_Image', NULL, NULL, 777, 47),
(6751, 1, '96', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 778, 46),
(6752, 4, NULL, NULL, NULL, NULL, 3249, 'Cms_Model_Image', NULL, NULL, 778, 47),
(6753, 1, '4', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 779, 46),
(6754, 4, NULL, NULL, NULL, NULL, 3250, 'Cms_Model_Image', NULL, NULL, 779, 47),
(6755, 2, NULL, NULL, 'Tlajomulco de Zúñiga, Jalisco, México | in process | area 50 ac | 1,530 houses and retail stores.', NULL, NULL, NULL, NULL, NULL, 780, 49),
(6756, 1, '2016', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 780, 50),
(6757, 2, NULL, NULL, 'Tlajomulco de Zúñiga, Jalisco, Mexico | area 42 ac | 1,264 houses and retail stores.', NULL, NULL, NULL, NULL, NULL, 781, 49),
(6758, 1, '2014', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 781, 50),
(6759, 2, NULL, NULL, 'Tlajomulco de Zúñiga, Jalisco, México | area 56 ac | 1,800 houses.', NULL, NULL, NULL, NULL, NULL, 782, 49),
(6760, 1, '2011', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 782, 50),
(6761, 2, NULL, NULL, 'Tlajomulco de Zúñiga, Jalisco, México | area 23.5 ac | 733 houses.', NULL, NULL, NULL, NULL, NULL, 783, 49),
(6762, 1, '2009', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 783, 50),
(6763, 2, NULL, NULL, 'Tlajomulco de Zúñiga, Jalisco, México | area 20 ac | 605 houses.', NULL, NULL, NULL, NULL, NULL, 784, 49),
(6764, 1, '2007', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 784, 50),
(6765, 2, NULL, NULL, 'Tlajomulco de Zúñiga, Jalisco, México | area 8 ac | 229 houses.', NULL, NULL, NULL, NULL, NULL, 785, 49),
(6766, 1, '2006', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 785, 50),
(6767, 2, NULL, NULL, 'Zapopan, Jalisco, México | area 9 ac | 201 houses.', NULL, NULL, NULL, NULL, NULL, 786, 49),
(6768, 1, '2004', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 786, 50),
(6769, 2, NULL, NULL, 'Tonalá, Jalisco, México | area 5 ac | 164 houses.', NULL, NULL, NULL, NULL, NULL, 787, 49),
(6770, 1, '2003', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 787, 50),
(6771, 2, NULL, NULL, 'Jalisco, Mexico | Living area 5,598 sqft.', NULL, NULL, NULL, NULL, NULL, 788, 49),
(6772, 1, '2016', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 788, 50),
(6773, 2, NULL, NULL, 'Zapopan, Jalisco, Mexico | living area 11,302 sqft.', NULL, NULL, NULL, NULL, NULL, 789, 49),
(6774, 1, '2013', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 789, 50),
(6775, 2, NULL, NULL, 'Zapopan, Jalisco, Mexico | living area 3,445 sq ft.', NULL, NULL, NULL, NULL, NULL, 790, 49),
(6776, 1, '2012', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 790, 50),
(6777, 2, NULL, NULL, 'Zapopan, Jalisco, Mexico | living area 3,832 sq ft.', NULL, NULL, NULL, NULL, NULL, 791, 49),
(6778, 1, '2011', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 791, 50),
(6779, 2, NULL, NULL, 'Zapopan, Jalisco, Mexico | living area 3,230 sq ft.', NULL, NULL, NULL, NULL, NULL, 792, 49),
(6780, 1, '2010', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 792, 50),
(6781, 2, NULL, NULL, 'Zapopan, Jalisco, Mexico | living area 3,767 sq ft.', NULL, NULL, NULL, NULL, NULL, 793, 49),
(6782, 1, '2006', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 793, 50),
(6783, 2, NULL, NULL, 'El Salto, Jalisco, Mexico | usable area 96,875 sq ft.', NULL, NULL, NULL, NULL, NULL, 794, 49),
(6784, 1, '2018', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 794, 50),
(6785, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2022-08-03 19:10:06', NULL, 768, 51),
(6786, 1, '+', NULL, NULL, NULL, NULL, NULL, '2022-08-03 19:10:06', NULL, 775, 51),
(6787, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2022-08-03 19:10:06', NULL, 776, 51),
(6788, 1, '+', NULL, NULL, NULL, NULL, NULL, '2022-08-03 19:10:06', NULL, 777, 51),
(6789, 1, '+', NULL, NULL, NULL, NULL, NULL, '2022-08-03 19:10:06', NULL, 778, 51),
(6790, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2022-08-03 19:10:06', NULL, 779, 51),
(6791, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2022-08-03 19:10:11', NULL, 768, 52),
(6792, 1, 'k', NULL, NULL, NULL, NULL, NULL, '2022-08-03 19:10:11', NULL, 775, 52),
(6793, 1, 'm', NULL, NULL, NULL, NULL, NULL, '2022-08-03 19:10:11', NULL, 776, 52),
(6794, 1, 'k', NULL, NULL, NULL, NULL, NULL, '2022-08-03 19:10:11', NULL, 777, 52),
(6795, 1, 'k', NULL, NULL, NULL, NULL, NULL, '2022-08-03 19:10:11', NULL, 778, 52),
(6796, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2022-08-03 19:10:11', NULL, 779, 52),
(6797, 3, NULL, NULL, '<p>Founded in 2002, our group started as a Real Estate Developer that began operations creating housing developments in Mexico. Following our early success, we have now ventured into the construction of industrial buildings and shopping centers in Mexico, and started operations in the United States and Canada.</p>\r\n<p>Above all, the most important thing you should know about us is that we have the knowledge and most importantly, that we are passionate and talented for what we do.</p>\r\n<p>Designwise, it is important for us to always look for concepts that make spaces transmit a sense of harmony and integration where families feel as a whole, becoming realized in their own home while setting a frame for life.</p>\r\n<h2>We believe beauty and functionality should always work together.</h2>', NULL, NULL, NULL, NULL, NULL, 795, 53),
(6798, 4, NULL, NULL, NULL, NULL, 3251, 'Cms_Model_Image', NULL, NULL, 795, 54),
(6799, 3, NULL, NULL, '<h4>Mission</h4>\r\n<p>Our mission is to join the life project of our clients, by building spaces of the highest quality at competitive prices, generating jobs, well-being to our employees and sustainability.</p>', NULL, NULL, NULL, NULL, NULL, 795, 55),
(6800, 3, NULL, NULL, '<h4>Vision</h4>\r\n<p>Become the leading comfort &amp; space developers in North America, recognized for the application of design, and joining aesthetics and functionality.</p>', NULL, NULL, NULL, NULL, NULL, 795, 56),
(6801, 3, NULL, NULL, '<h2>Led by a team of highly creative architects and interior designers, at BHOME we are committed to integrate beauty with functionality in everything we do.</h2>\r\n<p></p>\r\n<h2>Our marketing and realtor team is made up of successful creatives who specialize in the Vancouver market.</h2>', NULL, NULL, NULL, NULL, NULL, 795, 57),
(6802, 3, NULL, NULL, '<p><span>Together, CEOs, architects, and designers generate and design the best spaces and environments for our clients to grow along with their families. With this in mind, our designs always integrate areas of daily coexistence, such as an open kitchen complemented by the living room, dining room, and terrace.</span></p>', NULL, NULL, NULL, NULL, NULL, 795, 60),
(6803, 1, 'President', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 796, 58),
(6804, 4, NULL, NULL, NULL, NULL, 3252, 'Cms_Model_Image', NULL, NULL, 796, 59),
(6805, 1, 'April 2022', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 798, 61),
(6806, 3, NULL, NULL, '<p style=\"text-align: right;\">Can you picture yourself living in our Derby Place Home? Learn more about this amazing project, our team and our architectural vision and background directly from our CEO. <br /> <br /> <a class=\"russell\" href=\"https://player.vimeo.com/video/868874890?autoplay=1&amp;loop=1&amp;badge=0&amp;autopause=0&amp;quality_selector=1&amp;progress_bar=1&amp;player_id=0&amp;app_id=58479\" target=\"_blank\">Watch video</a></p>', NULL, NULL, NULL, NULL, NULL, 798, 62),
(6807, 4, NULL, NULL, NULL, NULL, 3253, 'Cms_Model_Image', NULL, NULL, 798, 63),
(6808, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 798, 64),
(6809, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 798, 65),
(6810, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 798, 66),
(6811, 1, 'Real Estate Marketing', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 799, 58),
(6812, 4, NULL, NULL, NULL, NULL, 3254, 'Cms_Model_Image', NULL, NULL, 799, 59),
(6813, 1, 'Marketing', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 800, 58),
(6814, 4, NULL, NULL, NULL, NULL, 3255, 'Cms_Model_Image', NULL, NULL, 800, 59),
(6815, 1, 'Luxury Design House', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 801, 58),
(6816, 4, NULL, NULL, NULL, NULL, 3256, 'Cms_Model_Image', NULL, NULL, 801, 59),
(6817, 1, 'Luxury Design House', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 802, 58),
(6818, 4, NULL, NULL, NULL, NULL, 3257, 'Cms_Model_Image', NULL, NULL, 802, 59),
(6819, 1, 'Development', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 803, 58),
(6820, 4, NULL, NULL, NULL, NULL, 3258, 'Cms_Model_Image', NULL, NULL, 803, 59),
(6821, 1, 'April, 2017', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 804, 61),
(6822, 3, NULL, NULL, '<p>We are happy to share that our Santa Isabel project was featured in Architectural Digest Magazine as one of the most beautiful Mexican residences. We invite you to click the image to read the article.</p>', NULL, NULL, NULL, NULL, NULL, 804, 62),
(6823, 4, NULL, NULL, NULL, NULL, 3259, 'Cms_Model_Image', NULL, NULL, 804, 63),
(6824, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 804, 64),
(6825, 1, 'http://bhomeenterprise.ca/pdf/2017_abril_ad.pdf', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 804, 65),
(6826, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 804, 66),
(6827, 3, NULL, NULL, '<p><span>Great Homes begin with great relationships, let\'s meet.</span></p>', NULL, NULL, NULL, NULL, NULL, 805, 67),
(6828, 1, 'https://wa.me/16725152483', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 805, 68),
(6829, 1, 'https://www.facebook.com/Bhome-102503232585787', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 805, 69),
(6830, 1, 'https://www.instagram.com/bhomeenterprise', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 805, 70),
(6831, 1, '80', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 806, 46),
(6832, 4, NULL, NULL, NULL, NULL, 3260, 'Cms_Model_Image', NULL, NULL, 806, 47),
(6833, 1, '+', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 806, 51),
(6834, 1, 'm', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 806, 52),
(6835, 5, NULL, NULL, NULL, NULL, 1023, 'Cms_Model_ImageCollection', NULL, NULL, 807, 31),
(6836, 3, NULL, NULL, '<p>Under the leadership of our highly creative team of architects and designers, BHOME is working to fully renovate 1685 Mathers Residence, integrating a variety of modern architectural elements with comfortable, high quality enhanced ambiances.<br /><br />We have adapted the residence&rsquo;s easy-going functionality with today&rsquo;s lifestyle and to make it a a beautiful addition and sight for the entire neighborhood.</p>', NULL, NULL, NULL, NULL, NULL, 807, 32),
(6837, 9, 'Under construction', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 807, 33),
(6838, 4, NULL, NULL, NULL, NULL, 3261, 'Cms_Model_Image', NULL, NULL, 807, 34),
(6839, 3, NULL, NULL, '<ul id=\"lista\">\r\n<li><span>2 Levels</span></li>\r\n<li><span>Coach house</span></li>\r\n<li><span>5 Bedrooms in the main house</span></li>\r\n<li><span>2 Bedrooms in the coach house</span></li>\r\n<li><span>5 Bathrooms in the main house</span></li>\r\n<li><span>1 Bathroom in the coach house</span></li>\r\n<li><span>Open Kitchen</span></li>\r\n<li><span>Open Livingroom</span></li>\r\n<li><span>Dining Room</span></li>\r\n<li><span>Family Room</span></li>\r\n<li><span>Laundry</span></li>\r\n<li><span>Pet Shower</span></li>\r\n<li><span>Hot Tube</span></li>\r\n<li><span>Fire Pit</span></li>\r\n<li><span>BBQ Terrace (Deck)</span></li>\r\n<li><span>Areas:</span></li>\r\n<li><span>Main Level 1,359.00 ft<sup>2</sup></span></li>\r\n<li><span>Down Level 1,359.00 ft<sup>2</sup></span></li>\r\n<li><span>Garage 621.14 ft<sup>2</sup></span></li>\r\n<li><span>Deck 446.60 ft<sup>2</sup></span></li>\r\n<li><span>Total: 8,996 ft<sup>2</sup></span></li>\r\n</ul>', NULL, NULL, NULL, NULL, NULL, 807, 35),
(6840, 4, NULL, NULL, NULL, NULL, 3262, 'Cms_Model_Image', NULL, NULL, 807, 36),
(6841, 3, NULL, NULL, '<p>The property is located in one of the best and most desirable areas of West Vancouver: Ambleside. Many places are within walking distance such as elementary and high schools, Ambleside beach, recreational parks and main commercial street, Marine Dr., which has numerous shops and restaurants including Boutique Antique stores, banks, Starbucks, Shoppers, and the famous Japanese luxury grocery store Aburi Market. Downtown Vancouver is about 10 km.<br /><br />Moreover, this area has consolidated as one of the most exclusive and highest-value areas for most demanding families, due to the impressive appreciation of its properties during the last few years. Not only are new houses being developed, but most of its houses that were built in the 50&rsquo;s, are now being remodeled, accelerating its modernization and appreciation.<br /><br />Recent statistics show it is an active market being one of the top preferences for luxurius buyers.<br /><br /><br /></p>', NULL, NULL, NULL, NULL, NULL, 807, 37),
(6842, 2, NULL, NULL, '<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2599.721995194811!2d-123.15950090000001!3d49.338481900000005!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x54866e15572a2925%3A0x63634d3443380857!2s1685%20Mathers%20Ave%2C%20West%20Vancouver%2C%20BC%20V7V%202G6%2C%20Canada!5e0!3m2!1sen!2smx!4v1674527938599!5m2!1sen!2smx\" width=\"100%\" height=\"700\" style=\"border:0; max-height:800px;\" allowfullscreen=\"\" loading=\"lazy\" referrerpolicy=\"no-referrer-when-downgrade\"></iframe>', NULL, NULL, NULL, NULL, NULL, 807, 38),
(6843, 3, NULL, NULL, '<h6>West Vancouver</h6>\r\n<p>Located on the North Shore across Burrard Inlet via the Lions Gate Bridge from Vancouver, West Vancouver is one of the wealthiest cities in Canada.<br />West Vancouver is Canada\'s wealthiest municipality, with an average household net worth of $4,454,424. North Vancouver just next door is the tenth richest. West Vancouver is home to some very large, luxurious and expensive properties and houses. Occasionally, houses have been priced and sold at around $30,000,000. In 2021, West Vancouver\'s average house sold for over $2,500,000.<br />In West Vancouver, average total incomes were $86,253 for males and $48,070 for females, almost double the provincial average. Over 80% of the population has a total family income of at least $100,000.30.<br />West Vancouver as a city has on average the highest ranking for high school compared to all other British Columbia cities. Collingwood and Mulgrave are private schools which are top tier well-known schools in Canada. Sentinel and West Vancouver are public high schools and have great reputations which are also top of the provincial rankings compared to other public high schools. <br /><br />West Vancouver is also home to Park Royal Shopping Centre, Canada\'s first mall and the second largest mall in British Columbia. Opened in the 1950s, it now consumes 2 kilometres (1.2 mi) of both sides of Marine Drive near North Vancouver.<br /><br />With a population of close to 43,000, West Vancouver is home to movie stars, professional athletes, old-wealth families and successful business people from around the world. It&rsquo;s also home to splendid parks, ski trails, beaches and miles of natural beauty.<br /><br /><br /><br /><br /><br /><br /></p>', NULL, NULL, NULL, NULL, NULL, 807, 39),
(6844, 5, NULL, NULL, NULL, NULL, 1024, 'Cms_Model_ImageCollection', NULL, NULL, 807, 40),
(6845, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 807, 41),
(6846, 4, NULL, NULL, NULL, NULL, 3278, 'Cms_Model_Image', NULL, NULL, 807, 42),
(6847, 5, NULL, NULL, NULL, NULL, 1025, 'Cms_Model_ImageCollection', NULL, NULL, 808, 31),
(6848, 3, NULL, NULL, '<p></p>\r\n<p>Under the guidance of our innovative team of architects and designers, BHOME is developing three new residences that blend modern architectural features with comfortable, high-quality living environments.<br /><br />We have tailored our residences to match today\'s lifestyle needs, ensuring they are both functional and aesthetically pleasing, enhancing the overall appeal of the neighborhood.</p>', NULL, NULL, NULL, NULL, NULL, 808, 32),
(6849, 9, 'Under design', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 808, 33),
(6850, 4, NULL, NULL, NULL, NULL, 3290, 'Cms_Model_Image', NULL, NULL, 808, 34),
(6851, 3, NULL, NULL, '<p>Each residence has:</p>\r\n<ul id=\"lista\">\r\n<li><span>3 Levels</span></li>\r\n<li><span>3 Bedrooms</span></li>\r\n<li><span>2.5 Bathrooms</span></li>\r\n<li><span>Open Kitchen</span></li>\r\n<li><span>Open Living Room</span></li>\r\n<li><span>Dining Room</span></li>\r\n<li><span>Family Room</span></li>\r\n<li><span>Laundry</span></li>\r\n<li><span>Areas:</span></li>\r\n<li><span>Basement floor 76.49 sqf</span></li>\r\n<li><span>Main Floor 77.90 sqf</span></li>\r\n<li><span>Upper Floor 74.38 sqf</span></li>\r\n<li><span>Garage 30.36 sqf</span></li>\r\n<li><span>Total: 259.13 sqf</span></li>\r\n</ul>', NULL, NULL, NULL, NULL, NULL, 808, 35),
(6852, 4, NULL, NULL, NULL, NULL, 3291, 'Cms_Model_Image', NULL, NULL, 808, 36),
(6853, 3, NULL, NULL, '<p></p>\r\n<p>The property is located in a highly sought-after Coquitlam neighborhood, this home offers the perfect blend of urban convenience and natural beauty. Enjoy quick access to top-rated schools, vibrant shopping centers, delectable dining options, and efficient public transportation. For nature enthusiasts, nearby parks, hiking trails, and green spaces provide endless outdoor activities.<br /><br />Living at 3429 Roxton Ave means becoming part of a friendly and vibrant community. With excellent schools, community centers, and recreational facilities nearby, your family will thrive in this welcoming environment.</p>', NULL, NULL, NULL, NULL, NULL, 808, 37),
(6854, 2, NULL, NULL, '<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2602.3501268848!2d-122.7537349232863!3d49.28871027032708!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x54867f0d4f5d8345%3A0xaa62233efd01beff!2s3429%20Roxton%20Ave%2C%20Coquitlam%2C%20BC%20V3B%203H7%2C%20Canada!5e0!3m2!1sen!2sbd!4v1715818689485!5m2!1sen!2sbd\"  width=\"100%\" height=\"700\" style=\"border:0; max-height:800px;\" allowfullscreen=\"\" loading=\"lazy\" referrerpolicy=\"no-referrer-when-downgrade\"></iframe>', NULL, NULL, NULL, NULL, NULL, 808, 38),
(6855, 3, NULL, NULL, '<h6>Coquitlam</h6>\r\n<p></p>\r\n<p><strong>Natural Beauty</strong>: Stunning landscapes with parks, forests, and lakes for outdoor activities.<br /><br /><strong>Strong Community</strong>: Friendly, welcoming neighborhoods with numerous local events and festivals.<br /><br /><strong>Excellent Education</strong>: Top-rated schools and educational institutions like Douglas College.<br /><br /><strong>Convenient Transportation</strong>: Efficient public transit and easy access to Vancouver and major highways.<br /><br /><strong>Cultural Diversity</strong>: Rich cultural scene with events, festivals, and cultural centers.<br /><br /><strong>Robust Economy</strong>: Thriving economy with diverse industries and ample employment opportunities.<br /><br /><strong>Recreational Facilities</strong>: Wide range of sports fields, golf courses, aquatic centers, and recreation complexes.<br /><br /><strong>Family-Friendly</strong>: Numerous parks, playgrounds, and family-oriented programs and services.<br /><br /><strong>Safe and Clean</strong>: Safe neighborhoods and well-maintained public spaces.<br /><br /><strong>Proximity to Vancouver</strong>: Easy access to metropolitan amenities while enjoying a relaxed suburban lifestyle.</p>\r\n<p>Coquitlam combines the best of urban and suburban living, offering   residents a vibrant, safe, and prosperous environment with access to   beautiful nature, excellent amenities, and a strong community spirit.</p>', NULL, NULL, NULL, NULL, NULL, 808, 39),
(6856, 5, NULL, NULL, NULL, NULL, 1026, 'Cms_Model_ImageCollection', NULL, NULL, 808, 40),
(6857, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 808, 41),
(6858, 4, NULL, NULL, NULL, NULL, 3292, 'Cms_Model_Image', NULL, NULL, 808, 42),
(6859, 2, NULL, NULL, 'Test ', NULL, NULL, NULL, NULL, NULL, 810, 49),
(6860, 1, '2024', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 810, 50),
(6861, 2, NULL, NULL, 'Explore logics', NULL, NULL, NULL, NULL, NULL, 811, 25),
(6862, 4, NULL, NULL, NULL, NULL, 3203, 'Cms_Model_Image', NULL, NULL, 811, 26),
(6863, 3, NULL, NULL, '<p>Explore logics solutions<br />Explore logics solutions<br /><br /></p>\r\n<p>Explore logics solutions<br />Explore logics solutions<br /><br /></p>\r\n<p>Explore logics solutions<br />Explore logics solutions<br /><br /></p>\r\n<p>Explore logics solutions<br />Explore logics solutions<br /><br /></p>\r\n<p>Explore logics solutions<br />Explore logics solutions<br /><br /></p>\r\n<p>Explore logics solutions<br />Explore logics solutions<br /><br /></p>\r\n<p>Explore logics solutions<br />Explore logics solutions<br /><br /><br /></p>', NULL, NULL, NULL, NULL, NULL, 812, 53),
(6864, 4, NULL, NULL, NULL, NULL, 3210, 'Cms_Model_Image', NULL, NULL, 812, 54),
(6865, 3, NULL, NULL, '<p>Explore logics solutions<br />Explore logics solutions<br /><br /></p>\r\n<p>Explore logics solutions<br />Explore logics solutions<br /><br /></p>\r\n<p>Explore logics solutions<br />Explore logics solutions<br /><br /></p>\r\n<p>Explore logics solutions<br />Explore logics solutions<br /><br /></p>\r\n<p>Explore logics solutions<br />Explore logics solutions<br /><br /></p>\r\n<p>Explore logics solutions<br />Explore logics solutions<br /><br /></p>\r\n<p>Explore logics solutions<br />Explore logics solutions<br /><br /></p>\r\n<p>Explore logics solutions<br />Explore logics solutions<br /><br /></p>\r\n<p>Explore logics solutions<br />Explore logics solutions<br /><br /></p>\r\n<p>Explore logics solutions<br />Explore logics solutions<br /><br /></p>\r\n<p>Explore logics solutions<br />Explore logics solutions<br /><br /></p>\r\n<p>Explore logics solutions<br />Explore logics solutions<br /><br /></p>\r\n<p>Explore logics solutions<br />Explore logics solutions<br /><br /></p>\r\n<p>Explore logics solutions<br />Explore logics solutions<br /><br /><br /></p>', NULL, NULL, NULL, NULL, NULL, 812, 55),
(6866, 3, NULL, NULL, '<p>Explore logics solutions<br />Explore logics solutions<br /><br /></p>\r\n<p>Explore logics solutions<br />Explore logics solutions<br /><br /></p>\r\n<p>Explore logics solutions<br />Explore logics solutions<br /><br /></p>\r\n<p>Explore logics solutions<br />Explore logics solutions<br /><br /></p>\r\n<p>Explore logics solutions<br />Explore logics solutions<br /><br /></p>\r\n<p>Explore logics solutions<br />Explore logics solutions<br /><br /><br /></p>', NULL, NULL, NULL, NULL, NULL, 812, 56),
(6867, 3, NULL, NULL, '<p>Explore logics solutions<br />Explore logics solutions<br /><br /></p>\r\n<p>Explore logics solutions<br />Explore logics solutions<br /><br /></p>\r\n<p>Explore logics solutions<br />Explore logics solutions<br /><br /></p>\r\n<p>Explore logics solutions<br />Explore logics solutions<br /><br /></p>\r\n<p>Explore logics solutions<br />Explore logics solutions<br /><br /></p>\r\n<p>Explore logics solutions<br />Explore logics solutions<br /><br /><br /></p>', NULL, NULL, NULL, NULL, NULL, 812, 57),
(6868, 3, NULL, NULL, '<p>Explore logics solutions<br />Explore logics solutions<br /><br /></p>\r\n<p>Explore logics solutions<br />Explore logics solutions<br /><br /></p>\r\n<p>Explore logics solutions<br />Explore logics solutions<br /><br /></p>\r\n<p>Explore logics solutions<br />Explore logics solutions<br /><br /></p>\r\n<p>Explore logics solutions<br />Explore logics solutions<br /><br /></p>\r\n<p>Explore logics solutions<br />Explore logics solutions<br /><br /></p>\r\n<p>Explore logics solutions<br />Explore logics solutions<br /><br /><br /></p>', NULL, NULL, NULL, NULL, NULL, 812, 60),
(6869, 3, NULL, NULL, '<p>Testing</p>', NULL, NULL, NULL, NULL, NULL, 813, 53),
(6870, 4, NULL, NULL, NULL, NULL, 3214, 'Cms_Model_Image', NULL, NULL, 813, 54),
(6871, 3, NULL, NULL, '<p>Testing</p>', NULL, NULL, NULL, NULL, NULL, 813, 55),
(6872, 3, NULL, NULL, '<p>Testing</p>', NULL, NULL, NULL, NULL, NULL, 813, 56),
(6873, 3, NULL, NULL, '<p>Testing</p>', NULL, NULL, NULL, NULL, NULL, 813, 57),
(6874, 3, NULL, NULL, '<p>Testing</p>', NULL, NULL, NULL, NULL, NULL, 813, 60);

-- --------------------------------------------------------

--
-- Table structure for table `page_structures`
--

DROP TABLE IF EXISTS `page_structures`;
CREATE TABLE IF NOT EXISTS `page_structures` (
  `id` int NOT NULL AUTO_INCREMENT,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `site_id` int DEFAULT NULL,
  `template_html_path` varchar(255) DEFAULT NULL,
  `public` tinyint DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `page_structures`
--

INSERT INTO `page_structures` (`id`, `created_at`, `updated_at`, `name`, `description`, `site_id`, `template_html_path`, `public`) VALUES
(9, '2022-07-27 11:58:31', NULL, 'Home', NULL, 2, 'index', NULL),
(10, '2022-07-29 12:48:21', NULL, 'About Us', NULL, 2, 'about', NULL),
(11, '2022-07-29 12:57:59', NULL, 'Developmet listing', NULL, 2, NULL, NULL),
(12, '2022-07-29 12:58:26', NULL, 'Development - Item', NULL, 2, NULL, NULL),
(13, '2022-07-29 13:03:26', NULL, 'Why us', NULL, 2, NULL, NULL),
(14, '2022-07-29 13:05:56', NULL, 'Projects - Home', NULL, 2, 'projects', NULL),
(15, '2022-07-29 13:06:51', NULL, 'Project', NULL, 2, 'project_detail', NULL),
(16, '2022-07-29 21:55:02', NULL, 'About US - Folder', NULL, 2, NULL, NULL),
(17, '2022-07-29 21:57:00', NULL, 'About Us - Numbers', NULL, 2, NULL, NULL),
(18, '2022-07-29 21:59:38', NULL, 'About Us - Developments folder', NULL, 2, NULL, NULL),
(19, '2022-07-29 22:00:47', NULL, 'About US - Development Item', NULL, 2, NULL, NULL),
(20, '2022-08-03 19:15:29', NULL, 'Why us - home', NULL, 2, 'why', NULL),
(21, '2022-08-03 19:16:47', NULL, 'Why us - Profile', NULL, 2, NULL, NULL),
(22, '2022-08-03 19:19:19', NULL, 'Media - Home', NULL, 2, 'media', NULL),
(23, '2022-08-03 19:19:37', NULL, 'Media - Publication', NULL, 2, NULL, NULL),
(24, '2022-08-04 09:08:19', NULL, 'Contact', NULL, 2, 'contact', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `page_structure_taxonomies`
--

DROP TABLE IF EXISTS `page_structure_taxonomies`;
CREATE TABLE IF NOT EXISTS `page_structure_taxonomies` (
  `id` int NOT NULL AUTO_INCREMENT,
  `site_section_id` int DEFAULT NULL,
  `page_structure_id` int DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `schema_migrations`
--

DROP TABLE IF EXISTS `schema_migrations`;
CREATE TABLE IF NOT EXISTS `schema_migrations` (
  `version` varchar(255) NOT NULL,
  UNIQUE KEY `unique_schema_migrations` (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `sites`
--

DROP TABLE IF EXISTS `sites`;
CREATE TABLE IF NOT EXISTS `sites` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `domain` varchar(255) DEFAULT NULL,
  `path` varchar(255) DEFAULT NULL,
  `description` text,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `theme_path` varchar(255) DEFAULT NULL,
  `media_path` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `sites`
--

INSERT INTO `sites` (`id`, `name`, `url`, `domain`, `path`, `description`, `created_at`, `updated_at`, `theme_path`, `media_path`) VALUES
(2, 'bhomeenterprise', NULL, 'localhost', '/', NULL, NULL, NULL, './themes/bhome/', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `site_configurations`
--

DROP TABLE IF EXISTS `site_configurations`;
CREATE TABLE IF NOT EXISTS `site_configurations` (
  `id` int NOT NULL AUTO_INCREMENT,
  `site_id` int DEFAULT NULL,
  `option_name` varchar(255) DEFAULT NULL,
  `option_value` varchar(255) DEFAULT NULL,
  `option_key` varchar(255) DEFAULT NULL,
  `group` varchar(255) DEFAULT NULL,
  `order` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `site_configurations`
--

INSERT INTO `site_configurations` (`id`, `site_id`, `option_name`, `option_value`, `option_key`, `group`, `order`, `status`, `created_at`, `updated_at`) VALUES
(11, 2, 'Carpeta para media', 'upload/bhomeenterprise/media/', 'media_upload_path', 'Información sobre Media', '1', '1', '2022-07-22 12:00:43', NULL),
(12, 2, 'Carpeta para imagenes de galerias', 'upload/bhomeenterprise/media/galerias/', 'gallerys_upload_path', 'Información sobre Media', '1', '1', '2022-07-22 12:00:43', NULL),
(13, 2, 'Carpeta para imagenes', 'upload/bhomeenterprise/media/imagenes/', 'images_upload_path', 'Información sobre Media', '1', '1', '2022-07-22 12:00:43', NULL),
(14, 2, 'Dominio del sitio', 'http://localhost/indexcode/', 'site_domain', 'Configuración del sitio web', '1', '1', '2022-07-22 12:00:43', NULL),
(15, 2, 'Url al index del sitio', 'http://localhost/indexcode/', 'site_url', 'Configuración del sitio web', '1', '1', '2022-07-22 12:00:43', NULL),
(16, 2, 'El sitio utilizará URL Friendly', 'http://localhost/indexcode/', 'friendly_url', 'Configuración del sitio web', '1', '1', '2022-07-22 12:00:43', NULL),
(17, 2, 'El sitio utilizará URL Friendly', 'http://localhost/indexcode/', 'friendly_url_base', 'Configuración del sitio web', '1', '1', '2022-07-22 12:00:43', NULL),
(18, 2, 'Habilitar uso de libreria GD2', '1', 'enable_gd2', 'Configuración de sistema', '10', '1', '2022-07-22 12:00:43', NULL),
(19, 2, 'Hábilitar ligas moviles', NULL, 'enable_mobile', 'Moviles', '11', '1', '2022-07-22 12:00:43', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `site_languages`
--

DROP TABLE IF EXISTS `site_languages`;
CREATE TABLE IF NOT EXISTS `site_languages` (
  `id` int NOT NULL AUTO_INCREMENT,
  `site_id` int DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `code` varchar(5) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `site_menus`
--

DROP TABLE IF EXISTS `site_menus`;
CREATE TABLE IF NOT EXISTS `site_menus` (
  `id` int NOT NULL AUTO_INCREMENT,
  `site_id` int DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `owner_type` varchar(50) DEFAULT NULL,
  `owner_id` int DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `type` smallint DEFAULT NULL,
  `code_name` varchar(40) DEFAULT NULL,
  `index_status` smallint DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `site_pages`
--

DROP TABLE IF EXISTS `site_pages`;
CREATE TABLE IF NOT EXISTS `site_pages` (
  `id` int NOT NULL AUTO_INCREMENT,
  `page_structure_id` int DEFAULT NULL,
  `site_section_id` int DEFAULT NULL,
  `publish_status` tinyint(1) DEFAULT NULL,
  `status` smallint DEFAULT NULL,
  `publish_date` date DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `orden` smallint DEFAULT NULL,
  `parent_page_id` int DEFAULT NULL,
  `name_code` varchar(80) DEFAULT NULL,
  `index_status` smallint DEFAULT NULL,
  `site_id` int DEFAULT NULL,
  `lang_main_page_id` int DEFAULT NULL,
  `lang_code` varchar(10) DEFAULT NULL,
  `site_language_id` int DEFAULT NULL,
  `meta_description` text,
  `meta_keywords` text,
  `short_url` varchar(60) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=814 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `site_pages`
--

INSERT INTO `site_pages` (`id`, `page_structure_id`, `site_section_id`, `publish_status`, `status`, `publish_date`, `created_at`, `updated_at`, `name`, `orden`, `parent_page_id`, `name_code`, `index_status`, `site_id`, `lang_main_page_id`, `lang_code`, `site_language_id`, `meta_description`, `meta_keywords`, `short_url`) VALUES
(761, 9, 9, 1, 1, '2022-07-27', '2022-07-27 15:01:49', '2022-08-30 17:52:21', 'Home', 1, NULL, 'home', 1, 2, NULL, NULL, NULL, 'Bhome since 2018, the company ventured into industrial real estate under his leadership, building its first +96,000 square feet warehouse, a railway sidewalk, and two 1,000 meters long railway branch lines.\r\n\r\nBHOME we are committed to integrate beauty with functionality in everything we do.', 'Real estate Canada, Industrial real estate, housing development, Industrial buildings, shopping centers, building spaces, comfort & space developers', NULL),
(762, 14, 12, 1, 1, '2022-07-29', '2022-07-29 15:55:07', '2022-07-29 17:48:10', 'Projects', 1, NULL, 'projects', 1, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(763, 15, 12, 1, 1, '2022-07-29', '2022-07-29 17:28:16', '2022-08-15 12:32:24', 'Santa Isabel', 6, NULL, 'santa-isabel', NULL, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(764, 15, 12, 1, 1, '2022-07-29', '2022-07-29 18:06:37', '2023-10-11 17:20:22', 'Derby Place House', 4, NULL, 'derby-place-house', NULL, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(765, 15, 12, 1, 1, '2022-07-29', '2022-07-29 18:37:09', '2022-08-15 12:17:13', 'Punta Mita', 5, NULL, 'punta-mita', NULL, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(766, 10, 10, 1, 1, '2022-07-29', '2022-07-29 21:57:56', '2022-08-02 14:55:00', 'About us', 1, NULL, 'about-us', 1, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(767, 16, 10, NULL, 1, '2022-07-29', '2022-07-29 21:58:16', NULL, 'Numbers', 2, NULL, 'numbers', NULL, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(768, 17, 10, 1, 1, '2022-07-29', '2022-07-29 21:58:44', NULL, 'YEARS OF EXPIERENCE AS HOUSING DEVELOPERS', 1, 767, 'years-of-expierence-as-housing-developers', NULL, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(769, 18, 10, 1, 1, '2022-07-29', '2022-07-29 22:00:29', '2022-11-22 13:39:38', 'Housing Developments', 4, NULL, 'housing-developments', NULL, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(770, 19, 10, 1, 1, '2022-07-29', '2022-07-29 22:01:38', '2022-11-22 13:41:08', 'Savana development', 5, 769, 'savana-development', NULL, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(771, 18, 10, 1, 1, '2022-07-29', '2022-07-29 22:02:02', '2022-11-22 13:39:49', 'Residential Developments', 6, NULL, 'residential-developments', NULL, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(772, 19, 10, 1, 1, '2022-07-29', '2022-07-29 22:02:36', '2022-09-26 12:19:19', 'Punta Mita', 7, 771, 'punta-mita', NULL, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(773, 18, 10, 1, 1, '2022-08-09', '2022-07-29 22:03:01', '2022-11-22 13:40:00', 'Industrial Developments', 8, NULL, 'industrial-developments', NULL, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(774, 19, 10, 1, 1, '2022-08-02', '2022-07-29 22:03:19', '2022-09-26 12:25:43', 'Railway, Sidewalk and two railway Branch Lines', 9, 773, 'railway-sidewalk-and-two-railway-branch-lines', NULL, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(775, 17, 10, 1, 1, '2022-08-02', '2022-08-02 14:58:17', '2022-08-03 21:12:55', 'built homes', 3, 767, 'built-homes', NULL, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(776, 17, 10, 1, 1, '2022-08-02', '2022-08-02 14:59:47', '2022-09-05 19:51:40', 'sq ft of urbanized projects', 4, 767, 'sq-ft-of-urbanized-projects', NULL, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(777, 17, 10, 1, 1, '2022-08-02', '2022-08-02 15:00:25', '2022-09-05 19:49:16', 'sq ft of residential projects', 5, 767, 'sq-ft-of-residential-projects', NULL, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(778, 17, 10, 1, 1, '2022-08-02', '2022-08-02 15:01:05', '2022-09-05 19:50:32', 'sq ft of industrial projects', 6, 767, 'sq-ft-of-industrial-projects', NULL, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(779, 17, 10, 1, 1, '2022-08-02', '2022-08-02 15:01:31', NULL, 'Years as industrial real estate developer', 7, 767, 'years-as-industrial-real-estate-developer', NULL, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(780, 19, 10, 1, 1, '2022-08-02', '2022-08-02 15:04:16', '2022-09-26 12:12:26', 'Maranta development', 15, 769, 'maranta-development', NULL, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(781, 19, 10, 1, 1, '2022-08-02', '2022-08-02 15:06:12', '2022-09-26 12:13:32', 'Colina Real development', 16, 769, 'colina-real-development', NULL, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(782, 19, 10, 1, 1, '2022-08-02', '2022-08-02 15:06:36', '2022-09-26 12:14:35', 'Puerta Real development', 17, 769, 'puerta-real-development', NULL, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(783, 19, 10, 1, 1, '2022-08-02', '2022-08-02 15:07:01', '2022-09-26 12:15:35', 'Real del Parque development', 18, 769, 'real-del-parque-development', NULL, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(784, 19, 10, 1, 1, '2022-08-02', '2022-08-02 15:07:25', '2022-09-26 12:16:13', 'Real de San Sebastián development', 19, 769, 'real-de-san-sebastian-development', NULL, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(785, 19, 10, 1, 1, '2022-08-02', '2022-08-02 15:07:48', '2022-09-26 12:16:58', 'Real de Santa Anita development', 20, 769, 'real-de-santa-anita-development', NULL, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(786, 19, 10, 1, 1, '2022-08-02', '2022-08-02 15:08:19', '2022-09-26 12:17:45', 'Villas de Santa Lucía development', 21, 769, 'villas-de-santa-lucia-development', NULL, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(787, 19, 10, 1, 1, '2022-08-02', '2022-08-02 15:08:42', '2022-09-26 12:18:16', 'Lomas de Aztlán development', 22, 769, 'lomas-de-aztlan-development', NULL, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(788, 19, 10, 1, 1, '2022-08-02', '2022-08-02 15:10:07', '2022-09-26 12:20:38', 'Tapalpa', 23, 771, 'tapalpa', NULL, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(789, 19, 10, 1, 1, '2022-08-02', '2022-08-02 15:10:31', '2022-09-26 12:21:23', 'Santa Isabel', 24, 771, 'santa-isabel', NULL, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(790, 19, 10, 1, 1, '2022-08-02', '2022-08-02 15:18:20', '2022-09-26 12:22:10', 'Castaños 87 ', 25, 771, 'castanos-87-', NULL, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(791, 19, 10, 1, 1, '2022-08-02', '2022-08-02 15:19:45', '2022-09-26 12:22:42', 'Castaños 97', 26, 771, 'castanos-97', NULL, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(792, 19, 10, 1, 1, '2022-08-02', '2022-08-02 15:20:50', '2022-09-26 12:23:13', 'Castaños 84', 27, 771, 'castanos-84', NULL, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(793, 19, 10, 1, 1, '2022-08-02', '2022-08-02 15:22:02', '2022-09-26 12:23:43', 'Las Cumbres', 28, 771, 'las-cumbres', NULL, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(794, 19, 10, 1, 1, '2022-08-02', '2022-08-02 15:24:46', '2022-09-26 12:25:13', 'Warehouse', 29, 773, 'warehouse', NULL, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(795, 20, 11, 1, 1, '2022-08-03', '2022-08-03 19:18:37', '2024-01-28 14:20:08', 'Why us?', 1, NULL, 'why-us', 1, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(796, 21, 11, 1, 1, '2022-08-03', '2022-08-03 19:18:59', '2022-08-03 22:35:27', 'Jose Portillo', 2, NULL, 'jose-portillo', NULL, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(797, 22, 13, 1, 1, '2022-08-03', '2022-08-03 19:21:06', NULL, 'Media', 1, NULL, 'media', 1, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(798, 23, 13, 1, 1, '2022-08-03', '2022-08-03 21:38:21', '2023-10-10 14:14:16', 'BHome Derby Place, Video.', 2, NULL, 'bhome-derby-place-video', NULL, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(799, 21, 11, 1, 1, '2022-08-03', '2022-08-03 22:36:13', NULL, 'Anna Zhang', 3, NULL, 'anna-zhang', NULL, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(800, 21, 11, 1, 1, '2022-08-03', '2022-08-03 22:36:45', NULL, 'Daniela Farah', 4, NULL, 'daniela-farah', NULL, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(801, 21, 11, 1, 1, '2022-08-03', '2022-08-03 22:37:18', NULL, 'Juan Moreno', 5, NULL, 'juan-moreno', NULL, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(802, 21, 11, 1, 1, '2022-08-03', '2022-08-03 22:37:47', NULL, 'Roberto Lopez ', 6, NULL, 'roberto-lopez-', NULL, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(803, 21, 11, 1, 1, '2022-08-03', '2022-08-03 22:38:14', NULL, 'Saul Mendoza', 7, NULL, 'saul-mendoza', NULL, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(804, 23, 13, 1, 1, '2022-08-03', '2022-08-03 22:40:43', '2022-08-16 15:42:52', 'Architectural Digest. Press', 3, NULL, 'architectural-digest-press', NULL, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(805, 24, 14, 1, 1, '2022-08-04', '2022-08-04 09:10:35', '2022-08-25 11:51:50', 'Contact', 1, NULL, 'contact', 1, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(806, 17, 10, 1, 1, '2022-09-05', '2022-09-05 19:45:59', '2022-09-05 19:51:11', 'USD in investments', 2, 767, 'usd-in-investments', NULL, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(807, 15, 12, 1, 1, '2023-01-25', '2023-01-23 20:31:48', '2024-05-18 15:49:46', '1685 Mathers Residence', 3, NULL, '1685-mathers-residence', NULL, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(808, 15, 12, 1, 1, '2024-05-16', '2024-05-15 17:32:29', '2024-05-18 15:52:17', '3429 Roxton Ave', 2, NULL, '3429-roxton-ave', NULL, 2, NULL, NULL, NULL, 'Coquitlam combines the best of urban and suburban living, offering residents a vibrant, safe, and prosperous environment with access to beautiful nature, excellent amenities, and a strong community spirit.', '3429 Roxton Ave', NULL),
(811, 9, 9, NULL, 1, '2024-11-19', '2024-11-19 05:02:44', '2024-11-19 05:05:34', 'Explore logics', 2, NULL, 'explore-logics', NULL, 2, NULL, NULL, NULL, 'Explore logics', 'Explore logics', NULL),
(812, 20, 16, NULL, 1, '2024-11-19', '2024-11-19 05:07:42', NULL, 'Explore logics solutions', 1, NULL, 'explore-logics-solutions', 1, 2, NULL, NULL, NULL, 'Explore logics solutions\r\nExplore logics solutions\r\n\r\n', 'Explore logics solutions\r\nExplore logics solutions\r\n\r\n', NULL),
(813, 20, 16, NULL, 1, '2024-11-19', '2024-11-19 05:28:49', '2024-11-19 05:30:36', 'Testing', 2, 812, 'testing', NULL, 2, NULL, NULL, NULL, 'Testing', 'Testing', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `site_pages_search`
--

DROP TABLE IF EXISTS `site_pages_search`;
CREATE TABLE IF NOT EXISTS `site_pages_search` (
  `id` int NOT NULL AUTO_INCREMENT,
  `page_id` int DEFAULT NULL,
  `page_name` varchar(250) DEFAULT NULL,
  `descripcion` text,
  `keywords` text,
  `created_at` date DEFAULT NULL,
  `updated_at` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=760 DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `site_sections`
--

DROP TABLE IF EXISTS `site_sections`;
CREATE TABLE IF NOT EXISTS `site_sections` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `site_menu` varchar(255) DEFAULT NULL,
  `section_type` varchar(255) DEFAULT NULL,
  `publish_status` tinyint(1) DEFAULT NULL,
  `status` smallint DEFAULT NULL,
  `publish_date` date DEFAULT NULL,
  `site_section_id` int DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `site_id` int DEFAULT NULL,
  `page_structure_id` int DEFAULT NULL,
  `index_status` smallint DEFAULT NULL,
  `code_name` varchar(255) DEFAULT NULL,
  `lang_code` varchar(5) DEFAULT NULL,
  `lang_main_section_id` int DEFAULT NULL,
  `site_language_id` int DEFAULT NULL,
  `orden` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `site_sections`
--

INSERT INTO `site_sections` (`id`, `name`, `site_menu`, `section_type`, `publish_status`, `status`, `publish_date`, `site_section_id`, `created_at`, `updated_at`, `site_id`, `page_structure_id`, `index_status`, `code_name`, `lang_code`, `lang_main_section_id`, `site_language_id`, `orden`) VALUES
(9, 'Sección Index', NULL, NULL, 1, 1, '2022-07-27', NULL, '2022-07-22 12:00:43', NULL, 2, 9, 1, 'seccion-index', NULL, NULL, NULL, NULL),
(10, 'About Us', NULL, NULL, 1, 1, '2022-07-29', NULL, NULL, NULL, 2, 19, NULL, 'about-us', NULL, NULL, NULL, NULL),
(11, 'Why Us', NULL, NULL, 1, 1, '2022-08-03', NULL, NULL, NULL, 2, 21, NULL, 'why-us', NULL, NULL, NULL, NULL),
(12, 'Projects', NULL, NULL, 1, 1, NULL, NULL, NULL, NULL, 2, 15, NULL, 'projects', NULL, NULL, NULL, NULL),
(13, 'Media', NULL, NULL, 1, 1, NULL, NULL, NULL, NULL, 2, 23, NULL, 'media', NULL, NULL, NULL, NULL),
(14, 'Contact', NULL, NULL, 1, 1, NULL, NULL, NULL, NULL, 2, 24, NULL, 'contact', NULL, NULL, NULL, NULL),
(16, 'Abdul Waheed', NULL, NULL, 1, 1, NULL, NULL, NULL, NULL, 2, 20, NULL, 'abdul-waheed', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `site_templates`
--

DROP TABLE IF EXISTS `site_templates`;
CREATE TABLE IF NOT EXISTS `site_templates` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `path` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `site_versions`
--

DROP TABLE IF EXISTS `site_versions`;
CREATE TABLE IF NOT EXISTS `site_versions` (
  `id` int NOT NULL AUTO_INCREMENT,
  `site_template_id` int DEFAULT NULL,
  `version` varchar(10) DEFAULT NULL,
  `description` text,
  `publish_status` tinyint DEFAULT NULL,
  `status` smallint DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `structure_fields`
--

DROP TABLE IF EXISTS `structure_fields`;
CREATE TABLE IF NOT EXISTS `structure_fields` (
  `id` int NOT NULL AUTO_INCREMENT,
  `page_structure_id` int DEFAULT NULL,
  `field_type` smallint DEFAULT NULL,
  `status` smallint DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `orden` mediumint DEFAULT '0',
  `unique_key` varchar(50) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=71 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `structure_fields`
--

INSERT INTO `structure_fields` (`id`, `page_structure_id`, `field_type`, `status`, `created_at`, `updated_at`, `name`, `orden`, `unique_key`, `description`) VALUES
(25, 9, 2, 1, '2022-07-27 11:59:08', NULL, 'Title', 1, 'title', NULL),
(26, 9, 4, 1, '2022-07-27 11:59:17', NULL, 'Cover', 2, 'cover', NULL),
(27, 10, 3, 1, '2022-07-29 12:48:44', NULL, 'Introduction', 1, 'introduction', NULL),
(28, 10, 4, 1, '2022-07-29 12:48:59', NULL, 'Photo', 2, 'photo', NULL),
(29, 12, 1, 1, '2022-07-29 12:58:44', NULL, 'Year', 1, 'year', NULL),
(30, 12, 2, 1, '2022-07-29 13:02:55', NULL, 'Description', 2, 'description', NULL),
(31, 15, 5, 1, '2022-07-29 15:51:37', NULL, 'Gallery', 1, 'project-gallery', NULL),
(32, 15, 3, 1, '2022-07-29 15:51:44', NULL, 'Description', 2, 'description', NULL),
(33, 15, 9, 1, '2022-07-29 15:54:17', NULL, 'Status', 3, 'status', 'Built|Under design|Under construction'),
(34, 15, 4, 1, '2022-07-29 16:03:16', NULL, 'Home photo', 4, 'home-photo', NULL),
(35, 15, 3, 1, '2022-07-29 17:21:55', NULL, 'Characteristics', 5, 'characteristics', NULL),
(36, 15, 4, 1, '2022-07-29 17:22:11', NULL, 'Animated image', 6, 'animated-image', NULL),
(37, 15, 3, 1, '2022-07-29 17:22:32', NULL, 'Description 2', 7, 'description-2', NULL),
(38, 15, 2, 1, '2022-07-29 17:24:24', NULL, 'Location Map Embed', 8, 'location-map-embed', NULL),
(39, 15, 3, 1, '2022-07-29 17:25:21', NULL, 'Description 3', 9, 'description-3', NULL),
(40, 15, 5, 1, '2022-07-29 17:25:28', NULL, 'Gallery', 10, 'gallery', NULL),
(41, 15, 3, 1, '2022-07-29 17:25:48', NULL, 'Description 4', 11, 'description-4', NULL),
(42, 15, 4, 1, '2022-07-29 17:25:56', NULL, 'Image', 12, 'image', NULL),
(43, 14, 2, 1, '2022-07-29 17:47:21', NULL, 'Tagline', 1, 'tagline', NULL),
(44, 10, 1, 1, '2022-07-29 21:50:04', NULL, 'Phrase', 3, 'phrase', NULL),
(46, 17, 1, 1, '2022-07-29 21:57:12', NULL, 'Value', 1, 'value', NULL),
(47, 17, 4, 1, '2022-07-29 21:57:19', NULL, 'Icon', 2, 'icon', NULL),
(48, 18, 4, 1, '2022-07-29 22:00:17', NULL, 'Banner', 1, 'banner', NULL),
(49, 19, 2, 1, '2022-07-29 22:01:01', NULL, 'Description', 1, 'description', NULL),
(50, 19, 1, 1, '2022-07-29 22:01:07', NULL, 'Year', 2, 'year', NULL),
(51, 17, 1, 1, '2022-08-03 19:10:06', NULL, 'Value Sign', 3, 'value-sign', NULL),
(52, 17, 1, 1, '2022-08-03 19:10:11', NULL, 'Value Unit', 4, 'value-unit', NULL),
(53, 20, 3, 1, '2022-08-03 19:15:51', NULL, 'Introduction', 1, 'introduction', NULL),
(54, 20, 4, 1, '2022-08-03 19:15:59', NULL, 'Main image', 2, 'main-image', NULL),
(55, 20, 3, 1, '2022-08-03 19:16:14', NULL, 'Text 1', 3, 'text-1', NULL),
(56, 20, 3, 1, '2022-08-03 19:16:20', NULL, 'Text 2', 4, 'text-2', NULL),
(57, 20, 3, 1, '2022-08-03 19:16:30', NULL, 'Text 3', 5, 'text-3', NULL),
(58, 21, 1, 1, '2022-08-03 19:16:54', NULL, 'Position', 1, 'position', NULL),
(59, 21, 4, 1, '2022-08-03 19:17:04', NULL, 'Portrait', 2, 'portrait', NULL),
(60, 20, 3, 1, '2022-08-03 19:17:22', NULL, 'Closure', 6, 'closure', NULL),
(61, 23, 1, 1, '2022-08-03 19:19:49', NULL, 'Year', 1, 'year', NULL),
(62, 23, 3, 1, '2022-08-03 19:19:56', NULL, 'Description', 2, 'description', NULL),
(63, 23, 4, 1, '2022-08-03 19:20:07', NULL, 'Cover', 3, 'cover', NULL),
(64, 23, 1, 1, '2022-08-03 19:20:23', NULL, 'VIMEO Video ID', 4, 'vimeo-video-id', NULL),
(65, 23, 1, 1, '2022-08-03 19:20:32', NULL, 'Pdf File', 5, 'pdf-file', NULL),
(66, 23, 1, 1, '2022-08-03 19:20:38', NULL, 'URL', 6, 'url', NULL),
(67, 24, 3, 1, '2022-08-04 09:08:35', NULL, 'Text', 1, 'text', NULL),
(68, 24, 1, 1, '2022-08-04 09:08:54', NULL, 'Whats app', 2, 'whats-app', NULL),
(69, 24, 1, 1, '2022-08-04 09:08:59', NULL, 'Facebook', 3, 'facebook', NULL),
(70, 24, 1, 1, '2022-08-04 09:09:03', NULL, 'Instagram', 4, 'instagram', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(180) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `valid` tinyint(1) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `user_credentials`
--

DROP TABLE IF EXISTS `user_credentials`;
CREATE TABLE IF NOT EXISTS `user_credentials` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user` varchar(200) DEFAULT NULL,
  `password` varchar(40) DEFAULT NULL,
  `hash` varchar(30) DEFAULT NULL,
  `status` tinyint DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `user_credentials`
--

INSERT INTO `user_credentials` (`id`, `user`, `password`, `hash`, `status`, `created_at`, `updated_at`) VALUES
(1, 'admin', '$s=[D8EyDkCS@aXG', NULL, 1, '2012-01-24 22:45:10', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_profiles`
--

DROP TABLE IF EXISTS `user_profiles`;
CREATE TABLE IF NOT EXISTS `user_profiles` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT NULL,
  `domain` varchar(60) DEFAULT NULL,
  `default_path` varchar(20) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `user_profiles`
--

INSERT INTO `user_profiles` (`id`, `user_id`, `domain`, `default_path`, `created_at`, `updated_at`) VALUES
(1, 1, 'CMS.ADMIN', 'a=cms', '2012-01-24 22:45:39', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `site_pages_search`
--
ALTER TABLE `site_pages_search` ADD FULLTEXT KEY `FULLTEXT` (`keywords`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
