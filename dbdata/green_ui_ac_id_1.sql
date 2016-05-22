-- Adminer 3.3.4 MySQL dump

SET NAMES utf8;
SET foreign_key_checks = 0;
SET time_zone = 'SYSTEM';
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `nebeng_beri_tebengan`;
CREATE TABLE `nebeng_beri_tebengan` (
  `user_id` int(11) NOT NULL,
  `id_tebengan` int(11) NOT NULL AUTO_INCREMENT,
  `asal` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `tujuan` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `kapasitas` int(3) NOT NULL,
  `sisa_kapasitas` int(3) NOT NULL,
  `waktu_berangkat` date NOT NULL,
  `jam_berangkat` time NOT NULL,
  `jam_kadaluarsa` time NOT NULL,
  `keterangan` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `detail_waktu_kadaluarsa` timestamp NULL DEFAULT NULL,
  UNIQUE KEY `npm` (`id_tebengan`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `nebeng_beri_tebengan` (`user_id`, `id_tebengan`, `asal`, `tujuan`, `kapasitas`, `sisa_kapasitas`, `waktu_berangkat`, `jam_berangkat`, `jam_kadaluarsa`, `keterangan`, `detail_waktu_kadaluarsa`) VALUES
(1,	1,	'Jl. Juragan Sinda 2 No.27',	'Jl. Juragan Sinda II No.42',	1,	1,	'2016-05-03',	'19:13:00',	'20:13:00',	'guff',	NULL),
(1,	2,	'University of Indonesia',	'UI Salemba',	1,	1,	'2016-05-09',	'03:01:00',	'04:01:00',	'',	NULL),
(1,	3,	'Kelapa Dua',	'Depok',	1,	1,	'2016-05-19',	'01:00:00',	'02:00:00',	'honda',	'2016-05-19 23:56:39'),
(1,	4,	'Detos 21',	'Margocity',	1,	1,	'2016-05-20',	'23:20:00',	'00:20:00',	'hello',	'2016-05-21 00:20:00'),
(1,	5,	'Detos 21',	'Margocity',	1,	1,	'2016-05-20',	'23:20:00',	'00:20:00',	'hello',	'2016-05-21 00:20:00'),
(1,	6,	'Detos 21',	'Margocity',	1,	1,	'2016-05-20',	'23:20:00',	'00:20:00',	'hello',	'2016-05-21 00:20:00'),
(1,	7,	'Detos 21',	'Margocity',	1,	1,	'2016-05-20',	'23:20:00',	'00:20:00',	'hello',	'2016-05-21 00:20:00'),
(1,	8,	'Detos 21',	'Margocity',	1,	1,	'2016-05-20',	'23:20:00',	'00:20:00',	'hello',	'2016-05-21 00:20:00'),
(1,	9,	'Detos 21',	'Margocity',	1,	1,	'2016-05-20',	'23:20:00',	'00:20:00',	'hello',	'2016-05-21 00:20:00'),
(1,	10,	'Detos 21',	'Margocity',	1,	1,	'2016-05-20',	'23:20:00',	'00:20:00',	'hello',	'2016-05-21 00:20:00'),
(1,	11,	'Detos 21',	'Margocity',	1,	1,	'2016-05-20',	'23:20:00',	'00:20:00',	'hello',	'2016-05-21 00:20:00'),
(1,	12,	'Detos 21',	'Margocity',	1,	1,	'2016-05-20',	'23:20:00',	'00:20:00',	'hello',	'2016-05-21 00:20:00'),
(1,	13,	'Detos 21',	'Margocity',	1,	1,	'2016-05-20',	'23:20:00',	'00:20:00',	'hello',	'2016-05-21 00:20:00'),
(1,	14,	'Detos 21',	'Margocity',	1,	1,	'2016-05-20',	'23:20:00',	'00:20:00',	'hello',	'2016-05-21 00:20:00'),
(1,	15,	'Detos 21',	'Margocity',	1,	1,	'2016-05-20',	'23:20:00',	'00:20:00',	'hello',	'2016-05-21 00:20:00'),
(1,	16,	'Detos 21',	'Margocity',	1,	1,	'2016-05-20',	'23:20:00',	'00:20:00',	'hello',	'2016-05-21 00:20:00'),
(1,	17,	'Detos 21',	'Margocity',	1,	1,	'2016-05-20',	'23:20:00',	'00:20:00',	'hello',	'2016-05-21 00:20:00');

DROP TABLE IF EXISTS `nebeng_konfirmasi_pemberi`;
CREATE TABLE `nebeng_konfirmasi_pemberi` (
  `npm_penebeng` varchar(11) DEFAULT NULL,
  `nama_penebeng` varchar(20) DEFAULT NULL,
  `asal` text,
  `tujuan` text,
  `waktu_berangkat` datetime DEFAULT NULL,
  `konfirmasi` smallint(1) DEFAULT NULL,
  `waktu_konfirmasi` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `nebeng_konfirmasi_penebeng`;
CREATE TABLE `nebeng_konfirmasi_penebeng` (
  `npm_pemberi` varchar(11) DEFAULT NULL,
  `nama_pemberi` varchar(11) DEFAULT NULL,
  `asal` text,
  `tujuan` text,
  `waktu_berangkat` datetime DEFAULT NULL,
  `waktu_konfirmasi` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `nebeng_login`;
CREATE TABLE `nebeng_login` (
  `session_id` int(11) DEFAULT NULL,
  `npm` varchar(11) DEFAULT NULL,
  `last_login` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `nebeng_nebeng`;
CREATE TABLE `nebeng_nebeng` (
  `id_penebeng` int(11) NOT NULL,
  `id_tebengan` int(11) NOT NULL,
  `waktu_konfirmasi` time DEFAULT NULL,
  PRIMARY KEY (`id_penebeng`,`id_tebengan`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `nebeng_user`;
CREATE TABLE `nebeng_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `npm` varchar(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `nama` text NOT NULL,
  `role` text NOT NULL,
  `no_handphone` text,
  `email` text,
  `gcm_token` tinytext,
  `telegram_id` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `nebeng_user` (`id`, `npm`, `username`, `nama`, `role`, `no_handphone`, `email`, `gcm_token`, `telegram_id`) VALUES
(1,	'1206202394',	'Sanadhi.sutandi',	'SANADHI SUTANDI I MADE',	'mahasiswa',	NULL,	'sanadhi.sutandi@ui.ac.id',	'cJN7N6lwico:APA91bF5loEL2PyOTqvb9lq_G_ydNuIu9CxsdvFse2c_P-uGZVTgIngUrfTKk1I-_d77msDU18CObcLhHN141TGye5AghO-UCVQvfzWtMiWwgPsqPkcA91agdT8JSLiRsBSC6lMUCcjh',	'200670275'),
(2,	'1206202261',	'yudi.andrean',	'YUDI ANDREAN PHANAMA',	'mahasiswa',	'yudiandreann@gmail.com',	'yudiandreann@gmail.com',	'cmNS_AQot0U:APA91bEeUbsaL2QjoEjuRPEDm37FljlZs7cdjx4F0MM8yOLdPMcCj8wu6PwGt_Nq5bHdx9egDyKy4jojso8g7o8ncg1smZXGUKheFoeCeVOdOSKO_65g_GOvtiShws0y3jh9xuUj0y1m',	NULL);

-- 2016-05-22 10:12:54
