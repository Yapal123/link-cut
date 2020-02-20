-- Adminer 4.7.1 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP DATABASE IF EXISTS `links`;
CREATE DATABASE `links` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `links`;

DROP TABLE IF EXISTS `links_list`;
CREATE TABLE `links_list` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `link_slug` varchar(255) NOT NULL,
  `redirect_link` varchar(1000) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `links_list` (`id`, `link_slug`, `redirect_link`) VALUES
(20,	'pJySF',	'google.com'),
(21,	'IKS3r',	'google.com'),
(22,	'FpkUR',	'google.com'),
(23,	'HafCp',	'google.com'),
(24,	'daiBg',	'google.com'),
(25,	'KhBau',	'google.com'),
(26,	'BqUY4',	'google.com'),
(27,	'6gYeh',	'vk.ru'),
(28,	'd2Zvn',	'vk.ru'),
(29,	'n7Fy2',	'vk.com');

-- 2020-02-20 11:40:55
