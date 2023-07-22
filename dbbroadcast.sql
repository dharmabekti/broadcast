/*
SQLyog Professional v12.5.1 (32 bit)
MySQL - 10.4.27-MariaDB : Database - dbbroadcast
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`dbbroadcast` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;

USE `dbbroadcast`;

/*Table structure for table `messages` */

DROP TABLE IF EXISTS `messages`;

CREATE TABLE `messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `message` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `messages` */

insert  into `messages`(`id`,`message`,`status`) values 
(1,'Hi, {{fullname}}.\nSelamat datang di Program Studi Sistem Informasi UAJY. Terimakasih telah mempercayakan Prodi SI UAJY sebagai tempat kuliah Anda. Untuk mengetahui lebih dalam Prodi SI, silahkan kunjungi Kampus Virtual SI di siuajy.com. Kunjungi juga Website resmi kami fti.uajy.ac.id/sisteminformasi, dan akun instagram @si_uajy untuk update kegiatan menarik lainya!',1),
(5,'Hi, {{fullname}}.\nSelamat datang di Program Studi Sistem Informasi UAJY. Terimakasih telah mempercayakan Prodi SI UAJY sebagai tempat kuliah Anda. Untuk mengetahui lebih dalam Prodi SI, silahkan kunjungi Kampus Virtual SI di siuajy.com. Kunjungi juga Website resmi kami fti.uajy.ac.id/sisteminformasi, dan akun instagram @si_uajy untuk update kegiatan menarik lainya!',0),
(6,'Hi, {{fullname}}.\nSelamat datang di Program Studi Sistem Informasi UAJY. Terimakasih telah mempercayakan Prodi SI UAJY sebagai tempat kuliah Anda. Untuk mengetahui lebih dalam Prodi SI, silahkan kunjungi Kampus Virtual SI di siuajy.com. Kunjungi juga Website resmi kami fti.uajy.ac.id/sisteminformasi, dan akun instagram @si_uajy untuk update kegiatan menarik lainya!',0);

/*Table structure for table `recipients` */

DROP TABLE IF EXISTS `recipients`;

CREATE TABLE `recipients` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `number` varchar(20) NOT NULL,
  `country_code` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `recipients` */

insert  into `recipients`(`id`,`name`,`number`,`country_code`) values 
(1,'Anom Suroto','85728418120',62),
(2,'Bekti Suratmanto','81326662126',62);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
