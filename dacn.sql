-- --------------------------------------------------------
-- Host:                         localhost
-- Server version:               5.7.9 - MySQL Community Server (GPL)
-- Server OS:                    Win64
-- HeidiSQL Version:             9.2.0.4947
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping database structure for db_batdongsan
DROP DATABASE IF EXISTS `db_batdongsan`;
CREATE DATABASE IF NOT EXISTS `db_batdongsan` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `db_batdongsan`;


-- Dumping structure for table db_batdongsan.tbl_startUrl
DROP TABLE IF EXISTS `tbl_startUrl`;
CREATE TABLE IF NOT EXISTS `tbl_startUrl` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `initial` varchar(50) DEFAULT NULL,
  `region` varchar(50) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `status` varchar(11) DEFAULT 'TODO',
  `created_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `status` (`status`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- Dumping data for table db_batdongsan.tbl_startUrl: ~0 rows (approximately)
DELETE FROM `tbl_startUrl`;
/*!40000 ALTER TABLE `tbl_startUrl` DISABLE KEYS */;
INSERT INTO `tbl_startUrl` (`id`, `name`, `initial`, `region`, `url`, `status`, `created_at`) VALUES
	(1, 'batdongsan', 'dacn', 'VietNam', 'https://batdongsan.com.vn/', 'TODO', '2020-04-08 16:19:46');
/*!40000 ALTER TABLE `tbl_startUrl` ENABLE KEYS */;


-- Dumping structure for table db_batdongsan.tbl_Category
DROP TABLE IF EXISTS `tbl_Category`;
CREATE TABLE IF NOT EXISTS `tbl_Category` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `category1` varchar(255) DEFAULT NULL,
  `category2` varchar(255) DEFAULT NULL,
  `category3` varchar(255) DEFAULT NULL,
  `category4` varchar(255) DEFAULT NULL,
  `url` varchar(500) DEFAULT NULL,
  `url_encode` varchar(200) DEFAULT NULL,
  `ignore_code` varchar(200) DEFAULT NULL,
  `status` varchar(255) DEFAULT 'TODO',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `status` (`status`),
  KEY `ignore_code` (`ignore_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table db_batdongsan.tbl_Category: ~0 rows (approximately)
DELETE FROM `tbl_Category`;
/*!40000 ALTER TABLE `tbl_Category` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_Category` ENABLE KEYS */;


-- Dumping structure for table db_batdongsan.tbl_Detail
DROP TABLE IF EXISTS `tbl_Detail`;
CREATE TABLE IF NOT EXISTS `tbl_Detail` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `url` varchar(500) CHARACTER SET utf8 DEFAULT '',
  `original_product_code` varchar(500) CHARACTER SET utf8 DEFAULT '',
  `product_code` varchar(50) CHARACTER SET utf8 DEFAULT '',
  `name` varchar(255) CHARACTER SET utf8 DEFAULT '',
  `brand` varchar(255) CHARACTER SET utf8 DEFAULT '',
  `category1` varchar(255) CHARACTER SET utf8 DEFAULT '',
  `category2` varchar(255) CHARACTER SET utf8 DEFAULT '',
  `category3` varchar(255) CHARACTER SET utf8 DEFAULT '',
  `category4` varchar(255) DEFAULT '',
  `price` varchar(50) CHARACTER SET utf8 DEFAULT '',
  `sale_price` varchar(50) CHARACTER SET utf8 DEFAULT '',
  `size` varchar(500) CHARACTER SET utf8 DEFAULT '',
  `size_chart` varchar(500) DEFAULT '',
  `size_chat_html` text,
  `color` varchar(500) CHARACTER SET utf8 DEFAULT '',
  `detail1` text CHARACTER SET utf8,
  `detail2` text CHARACTER SET utf8,
  `detail3` text CHARACTER SET utf8,
  `detail4` text CHARACTER SET utf8,
  `detail5` text CHARACTER SET utf8,
  `detail6` text CHARACTER SET utf8,
  `detail7` text CHARACTER SET utf8,
  `detail8` text CHARACTER SET utf8,
  `detail9` text CHARACTER SET utf8,
  `detail10` text CHARACTER SET utf8,
  `detail11` text CHARACTER SET utf8,
  `detail12` text CHARACTER SET utf8,
  `detail13` text CHARACTER SET utf8,
  `detail14` text CHARACTER SET utf8,
  `detail15` text CHARACTER SET utf8,
  `detail16` text CHARACTER SET utf8,
  `detail17` text CHARACTER SET utf8,
  `detail18` text CHARACTER SET utf8,
  `detail19` text CHARACTER SET utf8,
  `detail20` text CHARACTER SET utf8,
  `detail21` text,
  `detail22` text,
  `detail23` text,
  `detail24` text,
  `detail25` text,
  `detail26` text,
  `detail27` text,
  `detail28` text,
  `detail29` text,
  `detail30` text,
  `detail31` text,
  `detail32` text,
  `detail33` text,
  `detail34` text,
  `detail35` text,
  `detail36` text,
  `detail37` text,
  `detail38` text,
  `detail39` text,
  `detail40` text,
  `image1` varchar(500) CHARACTER SET utf8 DEFAULT '',
  `image2` varchar(500) CHARACTER SET utf8 DEFAULT '',
  `image3` varchar(500) CHARACTER SET utf8 DEFAULT '',
  `image4` varchar(500) CHARACTER SET utf8 DEFAULT '',
  `image5` varchar(500) CHARACTER SET utf8 DEFAULT '',
  `image6` varchar(500) CHARACTER SET utf8 DEFAULT '',
  `image7` varchar(500) CHARACTER SET utf8 DEFAULT '',
  `image8` varchar(500) CHARACTER SET utf8 DEFAULT '',
  `image9` varchar(500) CHARACTER SET utf8 DEFAULT '',
  `image10` varchar(500) CHARACTER SET utf8 DEFAULT '',
  `image11` varchar(500) CHARACTER SET utf8 DEFAULT '',
  `image12` varchar(500) CHARACTER SET utf8 DEFAULT '',
  `image13` varchar(500) CHARACTER SET utf8 DEFAULT '',
  `image14` varchar(500) CHARACTER SET utf8 DEFAULT '',
  `image15` varchar(500) CHARACTER SET utf8 DEFAULT '',
  `image16` varchar(500) DEFAULT '',
  `image17` varchar(500) DEFAULT '',
  `image18` varchar(500) DEFAULT '',
  `image19` varchar(500) DEFAULT '',
  `image20` varchar(500) DEFAULT '',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `product_code` (`product_code`)
) ENGINE=InnoDB DEFAULT CHARSET=sjis;

-- Dumping data for table db_batdongsan.tbl_Detail: ~0 rows (approximately)
DELETE FROM `tbl_Detail`;
/*!40000 ALTER TABLE `tbl_Detail` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_Detail` ENABLE KEYS */;


-- Dumping structure for table db_batdongsan.tbl_ignore_urls
DROP TABLE IF EXISTS `tbl_ignore_urls`;
CREATE TABLE IF NOT EXISTS `tbl_ignore_urls` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `category1` varchar(500) DEFAULT '',
  `category2` varchar(500) DEFAULT '',
  `category3` varchar(500) DEFAULT '',
  `category4` varchar(500) DEFAULT '',
  `url` varchar(500) DEFAULT '',
  `ignore_code` varchar(500) DEFAULT '',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `url` (`url`(255))
) ENGINE=InnoDB AUTO_INCREMENT=257 DEFAULT CHARSET=utf8;


-- Dumping structure for table db_batdongsan.tbl_Product
DROP TABLE IF EXISTS `tbl_Product`;
CREATE TABLE IF NOT EXISTS `tbl_Product` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `category1` varchar(255) DEFAULT NULL,
  `category2` varchar(255) DEFAULT '',
  `category3` varchar(255) DEFAULT '',
  `category4` varchar(255) DEFAULT '',
  `status` varchar(255) DEFAULT 'TODO',
  `url` varchar(500) DEFAULT '',
  `url_encode` varchar(255) DEFAULT '',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `url_encode` (`url_encode`),
  KEY `status` (`status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table db_batdongsan.tbl_Product: ~0 rows (approximately)
DELETE FROM `tbl_Product`;
/*!40000 ALTER TABLE `tbl_Product` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_Product` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
