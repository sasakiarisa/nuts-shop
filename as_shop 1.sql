-- Adminer 4.8.1 MySQL 5.7.28 dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `customer`;
CREATE TABLE `customer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `address` varchar(200) NOT NULL,
  `email` varchar(200) DEFAULT NULL,
  `login` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `login` (`login`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `customer` (`id`, `name`, `address`, `email`, `login`, `password`) VALUES
(1,	'熊木 和夫',	'東京都新宿区西新宿2-8-1',	NULL,	'kumaki',	'BearTree1'),
(11,	'佐々木愛里沙',	'11111@gmail.com',	'2225@gmail.com',	'sasaki',	'kiuimoca'),
(25,	'ささきありさ',	'御所野2－2',	'11111@111',	'sasa',	'$2y$10$FbmVZyYy59af.vUcAvxhV.dSagvIqxg8C84/PokdG.Akab5cBQOnC'),
(26,	'ローストピーナッツ',	'静岡県静岡市葵区追手町9－6',	'2525arip@gmail.com',	'aaaa',	'aaaa'),
(27,	'zzzz',	'zzzz',	'zzzz@zz',	'zzzz',	'$2y$10$aU5uEGOQJEtIgQ2xfmfSK.CekoRCMB7fk3/fX7wQnStVDIb3NkGkW'),
(28,	'佐々木愛里沙',	'秋田県秋田市御所野堤台',	'kiui@gmail.com',	'kiui',	'$2y$10$N/.6x0Udhmw/BgaMXooTX.ciBKFnygNi9ft0UO6aPdz/WeA4tCjz6');

DROP TABLE IF EXISTS `denpyo`;
CREATE TABLE `denpyo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `customer_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `customer_id` (`customer_id`),
  CONSTRAINT `denpyo_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `favorite`;
CREATE TABLE `favorite` (
  `customer_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  PRIMARY KEY (`customer_id`,`product_id`),
  KEY `product_id` (`product_id`),
  CONSTRAINT `favorite_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`id`),
  CONSTRAINT `favorite_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `favorite` (`customer_id`, `product_id`) VALUES
(1,	1),
(11,	1),
(26,	1),
(27,	1),
(26,	2),
(11,	3),
(1,	5),
(11,	5),
(27,	10);

DROP TABLE IF EXISTS `product`;
CREATE TABLE `product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `price` int(11) NOT NULL,
  `images` blob NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `product` (`id`, `name`, `price`, `images`) VALUES
(1,	'松の実',	700,	''),
(2,	'くるみ',	270,	''),
(3,	'ひまわりの種',	210,	''),
(4,	'アーモンド',	220,	''),
(5,	'カシューナッツ',	250,	''),
(6,	'ジャイアントコーン',	180,	''),
(7,	'ピスタチオ',	310,	''),
(8,	'マカダミアナッツ',	600,	''),
(9,	'かぼちゃの種',	180,	''),
(10,	'ピーナッツ',	150,	''),
(11,	'クコの実',	400,	''),
(12,	'落花生',	1200,	''),
(13,	'そら豆',	1100,	''),
(14,	'枝豆',	1200,	'');

DROP TABLE IF EXISTS `purchase`;
CREATE TABLE `purchase` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `customer_id` (`customer_id`),
  CONSTRAINT `purchase_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `purchase` (`id`, `customer_id`, `date`) VALUES
(1,	1,	'2022-02-25 02:32:41'),
(2,	1,	'2022-02-25 02:32:41'),
(3,	1,	'2022-02-25 02:32:41'),
(4,	1,	'2022-02-25 02:32:41'),
(5,	11,	'2022-02-25 02:32:41'),
(6,	11,	'2022-02-25 02:32:41'),
(7,	11,	'2022-02-25 02:32:41'),
(8,	26,	'2022-02-25 02:32:41'),
(9,	27,	'2022-02-25 02:32:41');

DROP TABLE IF EXISTS `purchase_detail`;
CREATE TABLE `purchase_detail` (
  `purchase_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `count` int(11) NOT NULL,
  PRIMARY KEY (`purchase_id`,`product_id`),
  KEY `product_id` (`product_id`),
  CONSTRAINT `purchase_detail_ibfk_1` FOREIGN KEY (`purchase_id`) REFERENCES `purchase` (`id`),
  CONSTRAINT `purchase_detail_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `purchase_detail` (`purchase_id`, `product_id`, `count`) VALUES
(2,	1,	2),
(4,	2,	1),
(5,	1,	1),
(6,	2,	1),
(7,	2,	1),
(8,	1,	1),
(9,	1,	1);

-- 2022-02-25 23:52:21
