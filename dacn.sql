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
INSERT INTO `tbl_startUrl` (`id`, `name`, `region`, `url`, `status`, `created_at`) VALUES
	(1, 'batdongsan', 'VietNam', 'https://batdongsan.com.vn/', 'TODO', '2020-04-08 16:19:46');
/*!40000 ALTER TABLE `tbl_startUrl` ENABLE KEYS */;


-- Dumping structure for table db_batdongsan.tbl_Category
DROP TABLE IF EXISTS `tbl_Category`;
CREATE TABLE IF NOT EXISTS `tbl_Category` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `category1` varchar(255) DEFAULT NULL,
  `category2` varchar(255) DEFAULT NULL,
  `category3` varchar(255) DEFAULT NULL,
  `url` varchar(500) DEFAULT NULL,
  `url_encode` varchar(200) DEFAULT NULL,
  `ignore_code` varchar(200) DEFAULT NULL,
  `status` varchar(255) DEFAULT 'TODO',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
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
  `product_code` varchar(50) CHARACTER SET utf8 DEFAULT '',
  `name` varchar(255) CHARACTER SET utf8 DEFAULT '',
  `contact` varchar(255) CHARACTER SET utf8 DEFAULT '',
  `address` varchar(255) CHARACTER SET utf8 DEFAULT '',
  `category1` varchar(255) CHARACTER SET utf8 DEFAULT '',
  `category2` varchar(255) CHARACTER SET utf8 DEFAULT '',
  `category3` varchar(255) CHARACTER SET utf8 DEFAULT '',
  `price` varchar(50) CHARACTER SET utf8 DEFAULT '',
  `sale_price` varchar(50) CHARACTER SET utf8 DEFAULT '',
  `area` varchar(500) CHARACTER SET utf8 DEFAULT '',
  `desc` text CHARACTER SET utf8 DEFAULT '',
  `images` text DEFAULT '',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `product_code` (`product_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  `status` varchar(255) DEFAULT 'TODO',
  `url` varchar(500) DEFAULT '',
  `url_encode` varchar(255) DEFAULT '',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
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
