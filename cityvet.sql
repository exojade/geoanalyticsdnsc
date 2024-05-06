/*
SQLyog Community v13.1.7 (64 bit)
MySQL - 10.4.20-MariaDB : Database - cityvet
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`cityvet` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;

USE `cityvet`;

/*Table structure for table `appointment` */

DROP TABLE IF EXISTS `appointment`;

CREATE TABLE `appointment` (
  `appointmentId` varchar(100) DEFAULT NULL,
  `dateSet` varchar(100) DEFAULT NULL,
  `timeSet` varchar(100) DEFAULT NULL,
  `timestampSet` varchar(100) DEFAULT NULL,
  `dateScheduled` varchar(100) DEFAULT NULL,
  `appointmentStatus` varchar(100) DEFAULT NULL,
  `meetId` varchar(100) DEFAULT NULL,
  `calendarId` varchar(100) DEFAULT NULL,
  `clientId` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `appointment` */

/*Table structure for table `checkup` */

DROP TABLE IF EXISTS `checkup`;

CREATE TABLE `checkup` (
  `checkupId` varchar(100) DEFAULT NULL,
  `dateCheckup` varchar(100) DEFAULT NULL,
  `type` varchar(100) DEFAULT NULL,
  `clientId` varchar(100) DEFAULT NULL,
  `appointmentId` varchar(100) DEFAULT NULL,
  `diagnosis` text DEFAULT NULL,
  `symptoms` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `checkup` */

/*Table structure for table `client` */

DROP TABLE IF EXISTS `client`;

CREATE TABLE `client` (
  `clientId` varchar(100) DEFAULT NULL,
  `firstname` varchar(100) DEFAULT NULL,
  `middlename` varchar(100) DEFAULT NULL,
  `lastname` varchar(100) DEFAULT NULL,
  `nameExtension` varchar(100) DEFAULT NULL,
  `province` varchar(100) DEFAULT NULL,
  `cityMun` varchar(100) DEFAULT NULL,
  `barangay` varchar(100) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `client` */

/*Table structure for table `pet` */

DROP TABLE IF EXISTS `pet`;

CREATE TABLE `pet` (
  `petId` varchar(100) DEFAULT NULL,
  `petName` varchar(100) DEFAULT NULL,
  `petType` varchar(100) DEFAULT NULL,
  `petBreed` varchar(100) DEFAULT NULL COMMENT 'optional',
  `petAge` varchar(100) DEFAULT NULL COMMENT 'optional',
  `petDescription` text DEFAULT NULL,
  `clientId` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `pet` */

/*Table structure for table `siteoptions` */

DROP TABLE IF EXISTS `siteoptions`;

CREATE TABLE `siteoptions` (
  `google_clientID` varchar(100) DEFAULT NULL,
  `google_clientSecret` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `siteoptions` */

insert  into `siteoptions`(`google_clientID`,`google_clientSecret`) values 
('538691118774-50b5ak993tc510dlrmoishso1pi8qv2q.apps.googleusercontent.com','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');

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `userid` varchar(100) DEFAULT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `role` varchar(100) DEFAULT NULL,
  `fullname` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `users` */

insert  into `users`(`userid`,`username`,`password`,`role`,`fullname`) values 
('USER0001','tradebryant@gmail.com','$1$6XfVdlQw$RDy74tYnF9SUK8mcLV6CL.','admin','ADMIN ADMIN'),
('USR-5048D9A6E8629','bosspanabo2020@gmail.com','bosspanabo2020@gmail.com','CLIENT','PANABO BUSINESS');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
