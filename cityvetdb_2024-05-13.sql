# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 5.5.5-10.4.28-MariaDB)
# Database: cityvetdb
# Generation Time: 2024-05-13 12:42:09 AM +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table appointment
# ------------------------------------------------------------

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
  `clientId` varchar(100) DEFAULT NULL,
  `notes` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

LOCK TABLES `appointment` WRITE;
/*!40000 ALTER TABLE `appointment` DISABLE KEYS */;

INSERT INTO `appointment` (`appointmentId`, `dateSet`, `timeSet`, `timestampSet`, `dateScheduled`, `appointmentStatus`, `meetId`, `calendarId`, `clientId`, `notes`)
VALUES
	('APP3C8733167EAF4','2024-05-10','S8','1715243310','2024-05-09','ONGOING','https://meet.google.com/coz-qnqi-dcz',NULL,'USR-FB4DF72C86189','my dog is sick'),
	('APPA2D81FEA262E0','2024-05-21','S1','1715308368','2024-05-10','ONGOING','https://meet.google.com/cyd-rjqy-hec',NULL,'USR-78DEF39E9FBD2','MY CAT IS BLEEDING');

/*!40000 ALTER TABLE `appointment` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table checkup
# ------------------------------------------------------------

DROP TABLE IF EXISTS `checkup`;

CREATE TABLE `checkup` (
  `checkupId` varchar(100) DEFAULT NULL,
  `dateCheckup` varchar(100) DEFAULT NULL,
  `type` varchar(100) DEFAULT NULL,
  `petId` varchar(100) DEFAULT NULL,
  `prescription` text DEFAULT NULL,
  `symptoms` text DEFAULT NULL,
  `doctorsNote` text DEFAULT NULL,
  `service` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

LOCK TABLES `checkup` WRITE;
/*!40000 ALTER TABLE `checkup` DISABLE KEYS */;

INSERT INTO `checkup` (`checkupId`, `dateCheckup`, `type`, `petId`, `prescription`, `symptoms`, `doctorsNote`, `service`)
VALUES
	('MEDC15336B2D7862','2024-05-10 15:13:03','Online','PET3F75DD6D30DC2','<ol><li>b complex 2x a day</li><li>amoxicillin 3x a day</li></ol>','<ol><li>suka kalibang</li><li>yellow color of vomit</li></ol>','asdasdasdasdadsasdasd','Checkup'),
	('MED14867AE374111','2024-05-10 15:15:46','Walk-in','PET3F75DD6D30DC2','asdasdadasdasd','<ol><li>mao gihapon</li></ol>','adsadasdasdasdwwwasd','Checkup');

/*!40000 ALTER TABLE `checkup` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table checkup_disease
# ------------------------------------------------------------

DROP TABLE IF EXISTS `checkup_disease`;

CREATE TABLE `checkup_disease` (
  `checkupId` varchar(100) DEFAULT NULL,
  `diseaseId` varchar(100) DEFAULT NULL,
  `tblid` int(11) NOT NULL AUTO_INCREMENT,
  `petId` varchar(100) DEFAULT NULL,
  KEY `tblid` (`tblid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

LOCK TABLES `checkup_disease` WRITE;
/*!40000 ALTER TABLE `checkup_disease` DISABLE KEYS */;

INSERT INTO `checkup_disease` (`checkupId`, `diseaseId`, `tblid`, `petId`)
VALUES
	('MEDC15336B2D7862','0001',2,'PET3F75DD6D30DC2'),
	('MEDC15336B2D7862','0003',3,'PET3F75DD6D30DC2'),
	('MED14867AE374111','0001',4,'PET3F75DD6D30DC2'),
	('MED14867AE374111','0002',5,'PET3F75DD6D30DC2'),
	('MED14867AE374111','0003',6,'PET3F75DD6D30DC2');

/*!40000 ALTER TABLE `checkup_disease` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table client
# ------------------------------------------------------------

DROP TABLE IF EXISTS `client`;

CREATE TABLE `client` (
  `clientId` varchar(100) DEFAULT NULL,
  `firstname` varchar(100) DEFAULT NULL,
  `middlename` varchar(100) DEFAULT NULL,
  `lastname` varchar(100) DEFAULT NULL,
  `nameExtension` varchar(100) DEFAULT NULL,
  `region` varchar(100) DEFAULT NULL,
  `province` varchar(100) DEFAULT NULL,
  `cityMun` varchar(100) DEFAULT NULL,
  `barangay` varchar(100) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `contactNumber` varchar(100) DEFAULT NULL,
  `clientType` enum('ONLINE','WALK IN') DEFAULT NULL,
  `birthDate` varchar(100) DEFAULT NULL,
  `gender` varchar(100) DEFAULT NULL,
  `clientStatus` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

LOCK TABLES `client` WRITE;
/*!40000 ALTER TABLE `client` DISABLE KEYS */;

INSERT INTO `client` (`clientId`, `firstname`, `middlename`, `lastname`, `nameExtension`, `region`, `province`, `cityMun`, `barangay`, `address`, `contactNumber`, `clientType`, `birthDate`, `gender`, `clientStatus`)
VALUES
	('USR-FB4DF72C86189','BRIAN JADE','A','GARCIA','','REGION XI (DAVAO REGION)','DAVAO DEL NORTE','CITY OF PANABO','Southern Davao','SAHARAVILLE SUBD','(+63) 9912021547','ONLINE','1994-12-12','Male','DONE UPDATE'),
	('USR-78DEF39E9FBD2','GEANICA','NAMUAG','GARCIA','','REGION XI (DAVAO REGION)','DAVAO DEL NORTE','CITY OF PANABO','Cagangohan','NARTATEZ VILLAGE','(+63) 9912021578','ONLINE','1991-12-05','Female','DONE UPDATE');

/*!40000 ALTER TABLE `client` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table disease
# ------------------------------------------------------------

DROP TABLE IF EXISTS `disease`;

CREATE TABLE `disease` (
  `diseaseId` varchar(100) DEFAULT NULL,
  `diseaseName` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

LOCK TABLES `disease` WRITE;
/*!40000 ALTER TABLE `disease` DISABLE KEYS */;

INSERT INTO `disease` (`diseaseId`, `diseaseName`)
VALUES
	('0001','PARVO'),
	('0002','DENGUE'),
	('0003','FLU');

/*!40000 ALTER TABLE `disease` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table pet
# ------------------------------------------------------------

DROP TABLE IF EXISTS `pet`;

CREATE TABLE `pet` (
  `petId` varchar(100) DEFAULT NULL,
  `petName` varchar(100) DEFAULT NULL,
  `petType` varchar(100) DEFAULT NULL,
  `petBreed` varchar(100) DEFAULT NULL COMMENT 'optional',
  `petAge` varchar(100) DEFAULT NULL COMMENT 'optional',
  `petDescription` text DEFAULT NULL,
  `clientId` varchar(100) DEFAULT NULL,
  `image` text DEFAULT NULL,
  `petGender` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

LOCK TABLES `pet` WRITE;
/*!40000 ALTER TABLE `pet` DISABLE KEYS */;

INSERT INTO `pet` (`petId`, `petName`, `petType`, `petBreed`, `petAge`, `petDescription`, `clientId`, `image`, `petGender`)
VALUES
	('PET3F75DD6D30DC2','SUGAR','Cat','HALF PERSIAN HALF PUSPIN',NULL,'DIRTY WHITE','USR-FB4DF72C86189',NULL,NULL),
	('PET53DD668749F2C','ISSA','Cat','Pure Persian',NULL,'Midnight Black','USR-FB4DF72C86189',NULL,NULL),
	('PET1CA8255307B86','Blacky','Dog','Labrador',NULL,'Pure Black','USR-FB4DF72C86189',NULL,NULL),
	('PETCCCB9A80E0D46','Hershey','Cat','Persian',NULL,'Grayish','USR-78DEF39E9FBD2',NULL,NULL),
	('PETBF89B9AE9266B','Miya','Cat','Persian',NULL,'Black and White','USR-78DEF39E9FBD2',NULL,NULL);

/*!40000 ALTER TABLE `pet` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table siteoptions
# ------------------------------------------------------------

DROP TABLE IF EXISTS `siteoptions`;

CREATE TABLE `siteoptions` (
  `google_clientID` varchar(100) DEFAULT NULL,
  `google_clientSecret` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

LOCK TABLES `siteoptions` WRITE;
/*!40000 ALTER TABLE `siteoptions` DISABLE KEYS */;

INSERT INTO `siteoptions` (`google_clientID`, `google_clientSecret`)
VALUES
	('538691118774-50b5ak993tc510dlrmoishso1pi8qv2q.apps.googleusercontent.com','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');

/*!40000 ALTER TABLE `siteoptions` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table timeslot
# ------------------------------------------------------------

DROP TABLE IF EXISTS `timeslot`;

CREATE TABLE `timeslot` (
  `slotId` varchar(100) DEFAULT NULL,
  `timeSlot` varchar(100) DEFAULT NULL,
  `slotsAvailable` varchar(100) DEFAULT NULL,
  `remarks` varchar(100) DEFAULT NULL,
  `startTime` varchar(100) DEFAULT NULL,
  `endTime` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

LOCK TABLES `timeslot` WRITE;
/*!40000 ALTER TABLE `timeslot` DISABLE KEYS */;

INSERT INTO `timeslot` (`slotId`, `timeSlot`, `slotsAvailable`, `remarks`, `startTime`, `endTime`)
VALUES
	('S1','AM 08:00 - 09:00','1','active','08:00','09:00'),
	('S2','AM 09:00 - 10:00','1','active','09:00','10:00'),
	('S3','AM 10:00 - 11:00','1','active','10:00','11:00'),
	('S4','AM 11:00 - 12:00','1','active','11:00','12:00'),
	('S5','NN 12:00 - 01:00','1','active','12:00','13:00'),
	('S6','PM 01:00 - 02:00','1','active','13:00','14:00'),
	('S7','PM 02:00 - 03:00','1','active','14:00','15:00'),
	('S8','PM 03:00 - 04:00','1','active','15:00','16:00'),
	('S9','PM 04:00 - 05:00','1','active','16:00','17:00'),
	('S10','PM 05:00 - 06:00','1','inactive','17:00','18:00'),
	('S11','PM 06:00 - 07:00','1','inactive','18:00','19:00'),
	('S12','PM 07:00 - 08:00','1','inactive','19:00','20:00');

/*!40000 ALTER TABLE `timeslot` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table users
# ------------------------------------------------------------

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `userid` varchar(100) DEFAULT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `role` varchar(100) DEFAULT NULL,
  `fullname` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;

INSERT INTO `users` (`userid`, `username`, `password`, `role`, `fullname`)
VALUES
	('USER0001','tradebryant@gmail.com','$1$6XfVdlQw$RDy74tYnF9SUK8mcLV6CL.','admin','ADMIN ADMIN'),
	('USR-FB4DF72C86189','bosspanabo2020@gmail.com','bosspanabo2020@gmail.com','CLIENT','PANABO BUSINESS'),
	('USR-78DEF39E9FBD2','keylower930@gmail.com','keylower930@gmail.com','CLIENT','Lower Key');

/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
