-- Adminer 4.8.1 MySQL 5.5.5-10.5.25-MariaDB-ubu2004 dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DELIMITER ;;

DROP FUNCTION IF EXISTS `custom_sum`;;
CREATE FUNCTION `custom_sum`(`a` int, `b` int) RETURNS int(11)
return a + b;;

DELIMITER ;

DROP TABLE IF EXISTS `orders`;
CREATE TABLE `orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `total` double NOT NULL,
  `vat` double NOT NULL,
  `created_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp(),
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_user` (`id_user`),
  CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

INSERT INTO `orders` (`id`, `id_user`, `total`, `vat`, `created_at`, `updated_at`) VALUES
(1,	1,	709,	141.8,	'2024-07-20 00:09:28',	'2024-07-20 00:09:28'),
(2,	1,	537,	107.4,	'2024-07-20 00:09:28',	'2024-07-20 00:09:28'),
(3,	1,	334,	66.8,	'2024-07-20 00:09:28',	'2024-07-20 00:09:28'),
(4,	1,	427,	85.4,	'2024-07-20 00:09:28',	'2024-07-20 00:09:28'),
(5,	2,	482,	96.4,	'2024-07-20 00:09:28',	'2024-07-20 00:09:28'),
(6,	2,	779,	155.8,	'2024-07-20 00:09:28',	'2024-07-20 00:09:28'),
(7,	3,	113,	22.6,	'2024-07-20 00:09:28',	'2024-07-20 00:09:28'),
(8,	3,	983,	196.6,	'2024-07-20 00:09:28',	'2024-07-20 00:09:28'),
(9,	4,	870,	174,	'2024-07-20 00:09:28',	'2024-07-20 00:09:28'),
(10,	4,	606,	121.2,	'2024-07-20 00:09:28',	'2024-07-20 00:09:28'),
(11,	4,	951,	190.2,	'2024-07-20 00:09:28',	'2024-07-20 00:09:28');

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

INSERT INTO `users` (`id`, `username`) VALUES
(3,	'anicka'),
(2,	'janko'),
(1,	'jozko'),
(4,	'jurko');

-- 2024-07-20 19:58:16