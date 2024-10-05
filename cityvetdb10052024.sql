/*
SQLyog Ultimate v13.1.1 (64 bit)
MySQL - 5.6.45-log : Database - cityvetdb
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
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
  `notes` text,
  `doctorId` varchar(100) DEFAULT NULL,
  `eventId` varchar(100) DEFAULT NULL,
  `description` text,
  PRIMARY KEY (`appointmentId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `appointment` */

insert  into `appointment`(`appointmentId`,`dateSet`,`timeSet`,`timestampSet`,`dateScheduled`,`appointmentStatus`,`meetId`,`calendarId`,`clientId`,`notes`,`doctorId`,`eventId`,`description`) values 
('APP10934BAAB0A28','2024-08-01','S4','1721801680','2024-07-24','ONGOING','https://meet.google.com/ajc-zhik-zhk','15df82f54cf28baa57c00d9fc76503ed9d5b0fcaef7ec5595fc7e04a87fb72f2@group.calendar.google.com','USR-78DEF39E9FBD2',' Booked an appointment for checkup. \n\nPet Owner: Lower Key \n\nNotes: I need my pet to be checked up\n\nVet to attend: GIAN JASPER GARCIA DVM \n\nReschedule Notes: asdasd \n\nReschedule Notes: IMOVE KAY BUSY KO \n\nReschedule Notes: asdasdasd \n\nReschedule Notes: asdasd \n\nReschedule Notes: asdasdasd \n\nReschedule Notes: asdasdasd','DOC-51A98D00F67D2','q42vqsdoor39vs79006irieno4',NULL),
('APP760304D5DD243','2024-07-29','S1','1721790111','2024-07-24','ONGOING','https://meet.google.com/nsf-uzfs-ywz','15df82f54cf28baa57c00d9fc76503ed9d5b0fcaef7ec5595fc7e04a87fb72f2@group.calendar.google.com','USR-78DEF39E9FBD2','SAMPLE APPOINTMENT','DOC-51A98D00F67D2','pn8hjgp9op9edi9gm9a9kfs1k4',NULL),
('APP8819AF727B270','2024-08-30','S5','1721809202','2024-07-24','DONE','https://meet.google.com/vyp-zgju-hrx','15df82f54cf28baa57c00d9fc76503ed9d5b0fcaef7ec5595fc7e04a87fb72f2@group.calendar.google.com','USR-78DEF39E9FBD2',' Booked an appointment for checkup. \n\nPet Owner: Lower Key \n\nNotes: asdasdasdasd\n\nVet to attend: GIAN JASPER GARCIA DVM','DOC-51A98D00F67D2','v4d2kltn8ddio6ppbqh718fk6s',NULL),
('APP8D84A0998463A','2024-08-05','S2','1721791455','2024-07-24','ONGOING','https://meet.google.com/xur-wyee-bpt','15df82f54cf28baa57c00d9fc76503ed9d5b0fcaef7ec5595fc7e04a87fb72f2@group.calendar.google.com','USR-78DEF39E9FBD2','THIS IS SAMPLE SAMPLE','DOC-51A98D00F67D2','95anbdgrtdb1m29jjnj2a4d52c',NULL),
('APPA1B2EAEF9274E','2024-07-24','S3','1721781186','2024-07-24','DONE','https://meet.google.com/zoh-ohzx-dyv','15df82f54cf28baa57c00d9fc76503ed9d5b0fcaef7ec5595fc7e04a87fb72f2@group.calendar.google.com','USR-78DEF39E9FBD2','I need to have an appointment for my dog chuchu!','DOC-51A98D00F67D2','i37uqp871f8n7erm7noiu05d9s',NULL),
('APPEB3A50554966A','2024-07-29','S8','1721802743','2024-07-24','PENDING',NULL,NULL,'USR-78DEF39E9FBD2','sample appointment',NULL,NULL,NULL),
('APPF0EE6B06FE3B9','2024-08-05','S6','1721807150','2024-07-24','DONE','https://meet.google.com/gpv-hqrb-qkd','15df82f54cf28baa57c00d9fc76503ed9d5b0fcaef7ec5595fc7e04a87fb72f2@group.calendar.google.com','USR-78DEF39E9FBD2',' Booked an appointment for checkup. \n\nPet Owner: Lower Key \n\nNotes: adsasdasdasdwwww NEW APPOINTMENT\n\nVet to attend: GIAN JASPER GARCIA DVM \n\nReschedule Notes: asdasdasd','DOC-51A98D00F67D2','8p78cthv6t9nnr5c8pf9qhfm80',NULL);

/*Table structure for table `checkup` */

DROP TABLE IF EXISTS `checkup`;

CREATE TABLE `checkup` (
  `checkupId` varchar(100) NOT NULL,
  `dateCheckup` varchar(100) DEFAULT NULL,
  `type` varchar(100) DEFAULT NULL,
  `petId` varchar(100) DEFAULT NULL,
  `prescription` text,
  `symptoms` text,
  `doctorsNote` text,
  `service` varchar(100) DEFAULT NULL,
  `diagnosis` text,
  `treatment` text,
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
('SCHEDF5F892018888E','CL-E208F616DACEB','2024-07-23','16:14:49','1721722489','DOC-51A98D00F67D2','DONE','USER0001'),
('SCHED41AF34D8640AD','CL-F8D326C74CB6E','2024-10-05','12:38:27','1728103107','DOC-FD603F339ADFD','PENDING','USER0001'),
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
  `notification` text,
  `sender` varchar(100) DEFAULT NULL,
  `reciever` text COMMENT 'array ni diri',
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
  `petDescription` text,
  `clientId` varchar(100) DEFAULT NULL,
  `image` text,
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
('PET8C45B81F56EC6','asdasdasdasd','Cat','CAT',NULL,'','CL-E208F616DACEB','uploads/PET8C45B81F56EC6.png','Male','2024-10-11',NULL),
('PET9192474BC438A','Choco','Dog','Pug',NULL,'','CL-F8D326C74CB6E',NULL,'Male','2022-05-30','Healthy'),
('PETBF89B9AE9266B','Miya','Cat','Persian',NULL,'Black and White','USR-78DEF39E9FBD2',NULL,'Female','2023-09-10','Healthy'),
('PETCCCB9A80E0D46','Hershey','Cat','Persian',NULL,'Grayish','USR-78DEF39E9FBD2',NULL,'Female','2023-01-10','Healthy'),
('PETE1BF4AB9476D0','HANABI','Dog','GOLDEN RETRIEVER',NULL,'','USR-FB4DF72C86189',NULL,'Female','2023-05-14','HEALTHY');

/*Table structure for table `pet_boarding` */

DROP TABLE IF EXISTS `pet_boarding`;

CREATE TABLE `pet_boarding` (
  `petBoardingId` int(10) NOT NULL AUTO_INCREMENT,
  `clientId` varchar(100) DEFAULT NULL,
  `from_date` varchar(100) DEFAULT NULL,
  `to_date` varchar(100) DEFAULT NULL,
  `numberPets` varchar(100) DEFAULT NULL,
  `dateSet` varchar(100) DEFAULT NULL,
  `status` varchar(100) DEFAULT NULL,
  `dateDone` varchar(100) DEFAULT NULL,
  KEY `petBoardingId` (`petBoardingId`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

/*Data for the table `pet_boarding` */

insert  into `pet_boarding`(`petBoardingId`,`clientId`,`from_date`,`to_date`,`numberPets`,`dateSet`,`status`,`dateDone`) values 
(1,'USR-78DEF39E9FBD2','2024-07-25 08:00:00','2024-07-25 17:00:00','2','2024-07-25 15:22:00','ONGOING',NULL);

/*Table structure for table `siteoptions` */

DROP TABLE IF EXISTS `siteoptions`;

CREATE TABLE `siteoptions` (
  `google_clientID` varchar(100) DEFAULT NULL,
  `google_clientSecret` varchar(100) DEFAULT NULL,
  `calendarId` varchar(100) DEFAULT NULL,
  `mainLogo` varchar(100) DEFAULT NULL,
  `mainTitle` varchar(100) DEFAULT NULL,
  `mainColor` varchar(100) DEFAULT NULL,
  `textColor` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `siteoptions` */

insert  into `siteoptions`(`google_clientID`,`google_clientSecret`,`calendarId`,`mainLogo`,`mainTitle`,`mainColor`,`textColor`) values 
('538691118774-50b5ak993tc510dlrmoishso1pi8qv2q.apps.googleusercontent.com','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','15df82f54cf28baa57c00d9fc76503ed9d5b0fcaef7ec5595fc7e04a87fb72f2@group.calendar.google.com','resources/theLogo.png','R.L SUMABAL VETERINARY CLINIC','#3B83D8','#F0F0F0');

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
  `vaccineRemarks` text,
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
