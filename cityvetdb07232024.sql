/*
SQLyog Ultimate v13.1.1 (64 bit)
MySQL - 10.4.20-MariaDB : Database - cityvetdb
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`cityvetdb` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;

USE `cityvetdb`;

/*Table structure for table `appointment` */

DROP TABLE IF EXISTS `appointment`;

CREATE TABLE `appointment` (
  `appointmentId` varchar(100) NOT NULL,
  `dateSet` varchar(100) DEFAULT NULL,
  `timeSet` varchar(100) DEFAULT NULL,
  `timestampSet` varchar(100) DEFAULT NULL,
  `dateScheduled` varchar(100) DEFAULT NULL,
  `appointmentStatus` varchar(100) DEFAULT NULL,
  `meetId` varchar(100) DEFAULT NULL,
  `calendarId` varchar(100) DEFAULT NULL,
  `clientId` varchar(100) DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `doctorId` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`appointmentId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `appointment` */

insert  into `appointment`(`appointmentId`,`dateSet`,`timeSet`,`timestampSet`,`dateScheduled`,`appointmentStatus`,`meetId`,`calendarId`,`clientId`,`notes`,`doctorId`) values 
('APP3C8733167EAF4','2024-05-10','S8','1715243310','2024-05-09','ONGOING','https://meet.google.com/coz-qnqi-dcz',NULL,'USR-FB4DF72C86189','my dog is sick','DOC-51A98D00F67D2'),
('APP3F06C85C16B70','2024-05-30','S8','1716724923','2024-05-26','ONGOING','https://meet.google.com/sgg-wfmf-vdd',NULL,'USR-FB4DF72C86189','I NEED IT','DOC-51A98D00F67D2'),
('APP4DFE05D021661','2024-05-27','S4','1716723965','2024-05-26','DONE','https://meet.google.com/twk-vxfb-cdh',NULL,'USR-FB4DF72C86189','I NEED MY PET TO BE CHECKUPED','DOC-51A98D00F67D2'),
('APPA2D81FEA262E0','2024-05-21','S1','1715308368','2024-05-10','ONGOING','https://meet.google.com/cyd-rjqy-hec',NULL,'USR-78DEF39E9FBD2','MY CAT IS BLEEDING','DOC-51A98D00F67D2'),
('APPA379E63027E4E','2024-05-15','S4','1715665407','2024-05-14','DONE','https://meet.google.com/wie-fgak-wzu',NULL,'USR-FB4DF72C86189','My pet dog is vomiting. I can\'t leave my pet and i dont have wheels. so i need to telemedicine the checkup','DOC-51A98D00F67D2');

/*Table structure for table `checkup` */

DROP TABLE IF EXISTS `checkup`;

CREATE TABLE `checkup` (
  `checkupId` varchar(100) NOT NULL,
  `dateCheckup` varchar(100) DEFAULT NULL,
  `type` varchar(100) DEFAULT NULL,
  `petId` varchar(100) DEFAULT NULL,
  `prescription` text DEFAULT NULL,
  `symptoms` text DEFAULT NULL,
  `doctorsNote` text DEFAULT NULL,
  `service` varchar(100) DEFAULT NULL,
  `diagnosis` text DEFAULT NULL,
  `treatment` text DEFAULT NULL,
  `doctorId` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`checkupId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `checkup` */

insert  into `checkup`(`checkupId`,`dateCheckup`,`type`,`petId`,`prescription`,`symptoms`,`doctorsNote`,`service`,`diagnosis`,`treatment`,`doctorId`) values 
('MED14867AE374111','2024-05-10 15:15:46','Walk-in','PET3F75DD6D30DC2','asdasdadasdasd','<ol><li>mao gihapon</li></ol>','adsadasdasdasdwwwasd','Checkup',NULL,NULL,'DOC-51A98D00F67D2'),
('MED1BF70CCFA11AC','2024-05-14 13:32:20','Walk-in','PETE1BF4AB9476D0','<ol><li>Amoxiclab 3x a day</li><li>Tambal No.2 4x a week after every meal of the pet patient</li><li>tambaling 3x a day</li></ol>','<ol><li>Vomitting</li><li>Weak Posture</li><li>Hard Belly</li></ol>','Food intake should be soft. Avoid contact to sunlight','Checkup','Food Poisoning','made the pet drink a vomitting solution','DOC-51A98D00F67D2'),
('MED9538FD9428D56','2024-05-15 14:43:48','Walk-in','PET9192474BC438A','<ol><li>Betadine</li></ol>','                    \r\n                  ','Let him rest','Checkup','Leg Fracture','Conduct dressing','DOC-51A98D00F67D2'),
('MED9FE0D26439FE4','2024-07-23 15:32:07','Online','PET9192474BC438A','<ol><li>Carboceistine 3x a day</li><li>Paracetamol 4x a week every morning except friday</li></ol>','                    \r\n                  ','                    \r\n                  ','Checkup','Food Poisoning','REST','DOC-51A98D00F67D2'),
('MEDC15336B2D7862','2024-05-10 15:13:03','Online','PET3F75DD6D30DC2','<ol><li>b complex 2x a day</li><li>amoxicillin 3x a day</li></ol>','<ol><li>suka kalibang</li><li>yellow color of vomit</li></ol>','asdasdasdasdadsasdasd','Checkup',NULL,NULL,'DOC-51A98D00F67D2');

/*Table structure for table `checkup_disease` */

DROP TABLE IF EXISTS `checkup_disease`;

CREATE TABLE `checkup_disease` (
  `checkupId` varchar(100) NOT NULL,
  `diseaseId` varchar(100) NOT NULL,
  `tblid` int(11) NOT NULL AUTO_INCREMENT,
  `petId` varchar(100) DEFAULT NULL,
  `barangay` varchar(100) DEFAULT NULL,
  `dateCheckUp` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`tblid`),
  KEY `tblid` (`tblid`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4;

/*Data for the table `checkup_disease` */

insert  into `checkup_disease`(`checkupId`,`diseaseId`,`tblid`,`petId`,`barangay`,`dateCheckUp`) values 
('MEDC15336B2D7862','0001',2,'PET3F75DD6D30DC2','36','2024-05-10 15:13:03'),
('MEDC15336B2D7862','0003',3,'PET3F75DD6D30DC2','36','2024-05-10 15:13:03'),
('MED14867AE374111','0001',4,'PET3F75DD6D30DC2','36','2024-05-10 15:15:46'),
('MED14867AE374111','0002',5,'PET3F75DD6D30DC2','36','2024-05-10 15:15:46'),
('MED14867AE374111','0003',6,'PET3F75DD6D30DC2','36','2024-05-10 15:15:46'),
('MED9FE0D26439FE4','0001',10,'PET9192474BC438A','1','2024-07-23 15:32:07'),
('MED9FE0D26439FE4','0002',11,'PET9192474BC438A','1','2024-07-23 15:32:07'),
('MED9FE0D26439FE4','0003',12,'PET9192474BC438A','1','2024-07-23 15:32:07');

/*Table structure for table `checkup_schedule` */

DROP TABLE IF EXISTS `checkup_schedule`;

CREATE TABLE `checkup_schedule` (
  `schedule_id` varchar(100) DEFAULT NULL,
  `clientId` varchar(100) NOT NULL,
  `dateScheduled` varchar(100) NOT NULL,
  `timeScheduled` varchar(100) DEFAULT NULL,
  `timestamp` varchar(100) DEFAULT NULL,
  `doctorId` varchar(100) NOT NULL,
  `status` varchar(100) DEFAULT NULL,
  `scheduledBy` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`clientId`,`dateScheduled`,`doctorId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `checkup_schedule` */

insert  into `checkup_schedule`(`schedule_id`,`clientId`,`dateScheduled`,`timeScheduled`,`timestamp`,`doctorId`,`status`,`scheduledBy`) values 
('SCHED76350392AC84C','USR-FB4DF72C86189','2024-05-26','18:58:19','1716721099','DOC-51A98D00F67D2','DONE','USER0001'),
('SCHEDB47A148DFC7EC','USR-FB4DF72C86189','2024-05-26','19:08:56','1716721736','DOC-FD603F339ADFD','PENDING','USER0001');

/*Table structure for table `client` */

DROP TABLE IF EXISTS `client`;

CREATE TABLE `client` (
  `clientId` varchar(100) NOT NULL,
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
  `clientStatus` varchar(100) DEFAULT NULL,
  `barangayId` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`clientId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `client` */

insert  into `client`(`clientId`,`firstname`,`middlename`,`lastname`,`nameExtension`,`region`,`province`,`cityMun`,`barangay`,`address`,`contactNumber`,`clientType`,`birthDate`,`gender`,`clientStatus`,`barangayId`) values 
('CL-E208F616DACEB','JOEY','','TRIBBIANI','','Region XI (DAVAO REGION)','DAVAO DEL NORTE','CITY OF PANABO','Dapco','PUROK 2','(+63) 9991919191','WALK IN','1990-01-01','Male','DONE UPDATE','7'),
('CL-F8D326C74CB6E','CLARK','','DACER','','REGION XI (DAVAO REGION)','DAVAO DEL NORTE','CITY OF PANABO','A. O. Floirendo','PUROK 1','(+63) 9912021566','WALK IN','1990-01-01','Male','DONE UPDATE','1'),
('USR-78DEF39E9FBD2','GEANICA','NAMUAG','GARCIA','','REGION XI (DAVAO REGION)','DAVAO DEL NORTE','CITY OF PANABO','Cagangohan','NARTATEZ VILLAGE','(+63) 9912021578','ONLINE','1991-12-05','Female','DONE UPDATE','5'),
('USR-F96662365944E',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'ONLINE',NULL,NULL,'FOR UPDATE',NULL),
('USR-FB4DF72C86189','BRIAN JADE','A','GARCIA','','REGION XI (DAVAO REGION)','DAVAO DEL NORTE','CITY OF PANABO','Southern Davao','SAHARAVILLE SUBD','(+63) 9912021547','ONLINE','1994-12-12','Male','DONE UPDATE','36');

/*Table structure for table `disease` */

DROP TABLE IF EXISTS `disease`;

CREATE TABLE `disease` (
  `diseaseId` varchar(100) NOT NULL,
  `diseaseName` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`diseaseId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `disease` */

insert  into `disease`(`diseaseId`,`diseaseName`) values 
('0001','PARVO'),
('0002','DENGUE'),
('0003','FLU');

/*Table structure for table `doctors` */

DROP TABLE IF EXISTS `doctors`;

CREATE TABLE `doctors` (
  `doctorsId` varchar(100) NOT NULL,
  `doctorsFirstname` varchar(100) DEFAULT NULL,
  `doctorsMiddlename` varchar(100) DEFAULT NULL,
  `doctorsLastname` varchar(100) DEFAULT NULL,
  `doctorsExtension` varchar(100) DEFAULT NULL,
  `doctorsRegion` varchar(100) DEFAULT NULL,
  `doctorsProvince` varchar(100) DEFAULT NULL,
  `doctorsCitymun` varchar(100) DEFAULT NULL,
  `doctorsBarangay` varchar(100) DEFAULT NULL,
  `doctorsAddress` varchar(100) DEFAULT NULL,
  `doctorsContactNumber` varchar(100) DEFAULT NULL,
  `doctorsSex` varchar(10) DEFAULT NULL,
  `doctorsBirthday` varchar(100) DEFAULT NULL,
  `doctorsLicenseNumber` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`doctorsId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `doctors` */

insert  into `doctors`(`doctorsId`,`doctorsFirstname`,`doctorsMiddlename`,`doctorsLastname`,`doctorsExtension`,`doctorsRegion`,`doctorsProvince`,`doctorsCitymun`,`doctorsBarangay`,`doctorsAddress`,`doctorsContactNumber`,`doctorsSex`,`doctorsBirthday`,`doctorsLicenseNumber`) values 
('DOC-51A98D00F67D2','GIAN JASPER','','GARCIA','DVM','REGION XI (DAVAO REGION)','DAVAO DEL NORTE','CITY OF PANABO','Southern Davao','PUROK 10','(+63) 9912021555','Male','2000-05-26','7162'),
('DOC-FD603F339ADFD','ROSS','','GELLER','','REGION XI (DAVAO REGION)','DAVAO DEL NORTE','CITY OF PANABO','Cacao','PUROK UBAS','(+63) 9910202020','Male','1990-01-01',NULL);

/*Table structure for table `notifications` */

DROP TABLE IF EXISTS `notifications`;

CREATE TABLE `notifications` (
  `notification_id` varchar(100) DEFAULT NULL,
  `notification` text DEFAULT NULL,
  `sender` varchar(100) DEFAULT NULL,
  `reciever` text DEFAULT NULL COMMENT 'array ni diri',
  `datetime` varchar(100) DEFAULT NULL,
  `timestamp` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `notifications` */

/*Table structure for table `pet` */

DROP TABLE IF EXISTS `pet`;

CREATE TABLE `pet` (
  `petId` varchar(100) NOT NULL,
  `petName` varchar(100) DEFAULT NULL,
  `petType` varchar(100) DEFAULT NULL,
  `petBreed` varchar(100) DEFAULT NULL COMMENT 'optional',
  `petAge` varchar(100) DEFAULT NULL COMMENT 'optional',
  `petDescription` text DEFAULT NULL,
  `clientId` varchar(100) DEFAULT NULL,
  `image` text DEFAULT NULL,
  `petGender` varchar(100) DEFAULT NULL,
  `petDob` varchar(100) DEFAULT NULL,
  `petCondition` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`petId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `pet` */

insert  into `pet`(`petId`,`petName`,`petType`,`petBreed`,`petAge`,`petDescription`,`clientId`,`image`,`petGender`,`petDob`,`petCondition`) values 
('PET1CA8255307B86','Blacky','Dog','Labrador',NULL,'Pure Black','USR-FB4DF72C86189',NULL,'Male','2023-09-10','Healthy'),
('PET3F75DD6D30DC2','SUGAR','Cat','HALF PERSIAN HALF PUSPIN',NULL,'DIRTY WHITE','USR-FB4DF72C86189',NULL,'Male','2022-09-10','Healthy'),
('PET53DD668749F2C','ISSA','Cat','Pure Persian',NULL,'Midnight Black','USR-FB4DF72C86189',NULL,'Male','2023-09-10','Healthy'),
('PET9192474BC438A','Choco','Dog','Pug',NULL,'','CL-F8D326C74CB6E',NULL,'Male','2022-05-30','Healthy'),
('PETBF89B9AE9266B','Miya','Cat','Persian',NULL,'Black and White','USR-78DEF39E9FBD2',NULL,'Female','2023-09-10','Healthy'),
('PETCCCB9A80E0D46','Hershey','Cat','Persian',NULL,'Grayish','USR-78DEF39E9FBD2',NULL,'Female','2023-01-10','Healthy'),
('PETE1BF4AB9476D0','HANABI','Dog','GOLDEN RETRIEVER',NULL,'','USR-FB4DF72C86189',NULL,'Female','2023-05-14','HEALTHY');

/*Table structure for table `siteoptions` */

DROP TABLE IF EXISTS `siteoptions`;

CREATE TABLE `siteoptions` (
  `google_clientID` varchar(100) DEFAULT NULL,
  `google_clientSecret` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `siteoptions` */

insert  into `siteoptions`(`google_clientID`,`google_clientSecret`) values 
('538691118774-50b5ak993tc510dlrmoishso1pi8qv2q.apps.googleusercontent.com','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');

/*Table structure for table `timeslot` */

DROP TABLE IF EXISTS `timeslot`;

CREATE TABLE `timeslot` (
  `slotId` varchar(100) NOT NULL,
  `timeSlot` varchar(100) DEFAULT NULL,
  `slotsAvailable` varchar(100) DEFAULT NULL,
  `remarks` varchar(100) DEFAULT NULL,
  `startTime` varchar(100) DEFAULT NULL,
  `endTime` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`slotId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `timeslot` */

insert  into `timeslot`(`slotId`,`timeSlot`,`slotsAvailable`,`remarks`,`startTime`,`endTime`) values 
('S1','AM 08:00 - 09:00','1','active','08:00','09:00'),
('S10','PM 05:00 - 06:00','1','inactive','17:00','18:00'),
('S11','PM 06:00 - 07:00','1','inactive','18:00','19:00'),
('S12','PM 07:00 - 08:00','1','inactive','19:00','20:00'),
('S2','AM 09:00 - 10:00','1','active','09:00','10:00'),
('S3','AM 10:00 - 11:00','1','active','10:00','11:00'),
('S4','AM 11:00 - 12:00','1','active','11:00','12:00'),
('S5','NN 12:00 - 01:00','1','active','12:00','13:00'),
('S6','PM 01:00 - 02:00','1','active','13:00','14:00'),
('S7','PM 02:00 - 03:00','1','active','14:00','15:00'),
('S8','PM 03:00 - 04:00','1','active','15:00','16:00'),
('S9','PM 04:00 - 05:00','1','active','16:00','17:00');

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `userid` varchar(100) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `role` varchar(100) DEFAULT NULL,
  `fullname` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`userid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `users` */

insert  into `users`(`userid`,`username`,`password`,`role`,`fullname`) values 
('DOC-51A98D00F67D2','crypto.manslayer@gmail.com','crypto.manslayer@gmail.com','DOCTOR','GIAN JASPER GARCIA'),
('DOC-FD603F339ADFD','imgeanican@gmail.com','imgeanican@gmail.com','DOCTOR','ROSS GELLER'),
('USER0001','tradebryant@gmail.com','$1$6XfVdlQw$RDy74tYnF9SUK8mcLV6CL.','admin','ADMIN ADMIN'),
('USR-78DEF39E9FBD2','keylower930@gmail.com','keylower930@gmail.com','CLIENT','Lower Key'),
('USR-F96662365944E','bosspanabo2020@gmail.com','bosspanabo2020@gmail.com','CLIENT','PANABO BUSINESS'),
('USR-FB4DF72C86189','bosspanabo20204@gmail.com','bosspanabo2020@gmail.com','CLIENT','PANABO BUSINESS');

/*Table structure for table `vaccine` */

DROP TABLE IF EXISTS `vaccine`;

CREATE TABLE `vaccine` (
  `vaccineId` varchar(100) NOT NULL,
  `vaccineName` varchar(100) DEFAULT NULL,
  `vaccineRemarks` text DEFAULT NULL,
  PRIMARY KEY (`vaccineId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `vaccine` */

/*Table structure for table `vaccineqrecords` */

DROP TABLE IF EXISTS `vaccineqrecords`;

CREATE TABLE `vaccineqrecords` (
  `recordId` varchar(100) NOT NULL,
  `vaccineId` varchar(100) DEFAULT NULL,
  `dosage` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`recordId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `vaccineqrecords` */

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
