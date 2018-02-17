# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: localhost (MySQL 5.7.21)
# Database: labaid
# Generation Time: 2018-02-17 19:14:01 +0000
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
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_name` varchar(256) DEFAULT NULL,
  `reg_number` varchar(256) DEFAULT NULL,
  `mobile_number` varchar(256) DEFAULT NULL,
  `alt_number` varchar(256) DEFAULT NULL,
  `chamber_location` varchar(256) DEFAULT NULL,
  `speciality` varchar(256) DEFAULT NULL,
  `doctor_id` varchar(256) DEFAULT NULL,
  `appointment_date` varchar(256) DEFAULT NULL,
  `appointment_time` varchar(256) DEFAULT NULL,
  `serial` varchar(4) DEFAULT NULL,
  `session` int(11) DEFAULT NULL COMMENT 'session_1 =1,session_2 =2,session_3 =3,',
  `reason` longtext,
  `agent_id` varchar(255) NOT NULL DEFAULT '',
  `status` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `sms_status` int(4) DEFAULT NULL,
  `start_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `end_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

LOCK TABLES `appointment` WRITE;
/*!40000 ALTER TABLE `appointment` DISABLE KEYS */;

INSERT INTO `appointment` (`id`, `customer_name`, `reg_number`, `mobile_number`, `alt_number`, `chamber_location`, `speciality`, `doctor_id`, `appointment_date`, `appointment_time`, `serial`, `session`, `reason`, `agent_id`, `status`, `created_at`, `sms_status`, `start_at`, `end_at`)
VALUES
	(1,'Mr. Shovon Rahman Shuvo','LABAID2018020500001','01534653592','NA','Mirpur ','Anesthesiologists','8002','09-02-2018','09:00 am',NULL,1,NULL,'2145',2,'2018-02-06 03:09:02',NULL,'2018-02-07 20:39:39','2018-02-07 20:39:39'),
	(2,'Mr. Yasir Taher','LABAID2018020500002','01534653592','NA','Dhanmondi','Anesthesiologists','8002','07-02-2018','09:00 am',NULL,1,NULL,'8004',2,'2018-02-06 03:11:29',NULL,'2018-02-07 20:39:39','2018-02-07 20:39:39'),
	(3,'Miss. Dil Ashrafi Anandi','LABAID2018020500005','01533355121','NA','Mohammadpur','Anesthesiologists','8002','07-02-2018','01:00 pm',NULL,2,NULL,'8003',2,'2018-02-06 03:11:55',NULL,'2018-02-07 20:39:39','2018-02-07 20:39:39'),
	(5,'Mr. Shovon Rahman Shuvo','LABAID2018020500001','01534653592','NA','Dhanmondi','Anesthesiologists','8002',NULL,NULL,NULL,NULL,NULL,'8004',NULL,'2018-02-06 03:32:50',NULL,'2018-02-07 20:39:39','2018-02-07 20:39:39'),
	(6,'Mr. Shovon Rahman Shuvo','LABAID2018020500001','01534653592','NA','Mohammadpur','Anesthesiologists','8002',NULL,NULL,NULL,NULL,NULL,'8003',NULL,'2018-02-06 03:33:54',NULL,'2018-02-07 20:39:39','2018-02-07 20:39:39'),
	(7,'Mr. Asadujjaman Rajib','LABAID2018020500003','01516123934','NA','Mirpur ','Anesthesiologists','8002','07-02-2018','09:20 am',NULL,1,NULL,'2145',2,'2018-02-06 03:43:42',NULL,'2018-02-07 20:39:39','2018-02-07 20:39:39'),
	(8,'Mr. Shovon Rahman Shuvo','LABAID2018020500001','01534653592','NA','Mirpur ','Anesthesiologists','8002','07-02-2018','09:10 am',NULL,1,NULL,'2145',2,'2018-02-06 04:11:19',NULL,'2018-02-07 20:39:39','2018-02-07 20:39:39'),
	(9,'Mr. Asadujjaman Rajib','LABAID2018020500003','01516123934','NA','Mirpur','Anesthesiologists','8002','07-02-2018','12:30 pm',NULL,1,NULL,'8004',2,'2018-02-06 05:11:19',NULL,'2018-02-07 20:39:39','2018-02-07 20:39:39'),
	(10,'Mr. Shovon Rahman Shuvo','LABAID2018020500001','01534653592','NA',NULL,'Anesthesiologists','8002',NULL,NULL,NULL,NULL,NULL,'',NULL,'2018-02-06 05:36:04',NULL,'2018-02-07 20:39:39','2018-02-07 20:39:39'),
	(11,'Mr. Asadujjaman Rajib','LABAID2018020500003','01516123934','NA','Mirpur ','Anesthesiologists','8002','07-02-2018','09:40 am',NULL,1,NULL,'2145',2,'2018-02-06 05:36:35',NULL,'2018-02-07 20:39:39','2018-02-07 20:39:39'),
	(12,'Mr. Shovon Rahman Shuvo','LABAID2018020500001','01534653592','NA','Mirpur ','Anesthesiologists','8002','09-02-2018','09:10 am',NULL,1,NULL,'2145',2,'2018-02-08 05:07:42',NULL,'2018-02-08 05:07:42','2018-02-08 05:07:42'),
	(13,'Mr. Asadujjaman Rajib','LABAID2018020500003','01516123934','NA',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'',NULL,'2018-02-08 05:09:43',NULL,'2018-02-08 05:09:43','2018-02-08 05:09:43');

/*!40000 ALTER TABLE `appointment` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table branch
# ------------------------------------------------------------

DROP TABLE IF EXISTS `branch`;

CREATE TABLE `branch` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `branch_name` varchar(128) DEFAULT NULL,
  `branch details` longtext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

LOCK TABLES `branch` WRITE;
/*!40000 ALTER TABLE `branch` DISABLE KEYS */;

INSERT INTO `branch` (`id`, `branch_name`, `branch details`)
VALUES
	(1,'Mirpur ','Near purobi bus stand'),
	(2,'Dhanmondi','dhanmondi 4');

/*!40000 ALTER TABLE `branch` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table cancel_appointment
# ------------------------------------------------------------

DROP TABLE IF EXISTS `cancel_appointment`;

CREATE TABLE `cancel_appointment` (
  `id` int(11) NOT NULL DEFAULT '0',
  `customer_name` varchar(256) DEFAULT NULL,
  `reg_number` varchar(256) DEFAULT NULL,
  `mobile_number` varchar(256) DEFAULT NULL,
  `alt_number` varchar(256) DEFAULT NULL,
  `chamber_location` varchar(256) DEFAULT NULL,
  `speciality` varchar(256) DEFAULT NULL,
  `doctor_id` varchar(256) DEFAULT NULL,
  `appointment_date` varchar(256) DEFAULT NULL,
  `appointment_time` varchar(256) DEFAULT NULL,
  `serial` int(4) DEFAULT NULL,
  `session` int(11) DEFAULT NULL COMMENT 'session_1 =1,session_2 =2,session_3 =3,',
  `status` int(11) DEFAULT NULL,
  `reason` longtext,
  `agent_id` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `cancel_appointment` WRITE;
/*!40000 ALTER TABLE `cancel_appointment` DISABLE KEYS */;

INSERT INTO `cancel_appointment` (`id`, `customer_name`, `reg_number`, `mobile_number`, `alt_number`, `chamber_location`, `speciality`, `doctor_id`, `appointment_date`, `appointment_time`, `serial`, `session`, `status`, `reason`, `agent_id`, `created_at`)
VALUES
	(1,'Mr. Asadujjaman Rajib','LABAID2017121500002','01534653592','NA','Mirpur ','Anesthesiologists','8002','29-01-2018','09:00 am',NULL,1,2,'hello from the other side.','2145','2018-01-29 18:55:15'),
	(3,'Mr. Asadujjaman Rajib','LABAID2017121500002','01534653592','NA',NULL,NULL,'8002','29-01-2018',NULL,NULL,NULL,NULL,'hello from the other side.','2145','2018-01-29 19:25:53'),
	(2,'Mr. Asadujjaman Rajib','LABAID2017121500002','01534653592','NA','Mirpur ','Anesthesiologists','8002','29-01-2018','09:00 am',NULL,1,2,'hello from the other side.','2145','2018-01-29 19:25:40'),
	(4,'Mr. Asadujjaman Rajib','LABAID2017121500002','01534653592','NA','Mirpur ','Anesthesiologists','8002','29-01-2018','09:00 am',NULL,1,2,'Can not come','2145','2018-01-29 19:33:59'),
	(4,'Mr. Asadujjaman Rajib','LABAID2018020500003','01516123934','NA','Mirpur ','Anesthesiologists','8002','07-02-2018','09:10 am',NULL,1,2,'Can not come','2145','2018-02-06 03:14:52');

/*!40000 ALTER TABLE `cancel_appointment` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table customer
# ------------------------------------------------------------

DROP TABLE IF EXISTS `customer`;

CREATE TABLE `customer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_name` varchar(255) DEFAULT NULL,
  `mobile_number` varchar(255) DEFAULT NULL,
  `alt_number` varchar(255) DEFAULT NULL,
  `date_of_birth` varchar(255) DEFAULT NULL,
  `age` int(16) DEFAULT NULL,
  `reg_number` varchar(255) DEFAULT NULL,
  `address` longtext,
  `patient_sex` varchar(16) DEFAULT NULL,
  `patient_designation` varchar(16) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

LOCK TABLES `customer` WRITE;
/*!40000 ALTER TABLE `customer` DISABLE KEYS */;

INSERT INTO `customer` (`id`, `customer_name`, `mobile_number`, `alt_number`, `date_of_birth`, `age`, `reg_number`, `address`, `patient_sex`, `patient_designation`)
VALUES
	(1,'Shovon Rahman Shuvo','01534653592','NA','NA',25,'LABAID2018020500001','Mirpur,Dhaka','Male','Mr.'),
	(2,'Yasir Taher','01534653592','NA','NA',25,'LABAID2018020500002','Farmgate,Dhaka','Male','Mr.'),
	(3,'Asadujjaman Rajib','01516123934','NA','NA',25,'LABAID2018020500003','Mirpur,Dhaka','Male','Mr.'),
	(4,'Sirajum Monir Parvez','01730404029','NA','NA',25,'LABAID2018020500004','Mirpur,Dhaka','Male','Mr.'),
	(5,'Dil Ashrafi Anandi','01533355121','NA','NA',25,'LABAID2018020500005','Kuril,Dhaka','Female','Miss.'),
	(6,'Sujana Samia Trina','01534653592','NA','NA',25,'LABAID2018020500006','Mirpur,Dhaka','Female','Mrs.');

/*!40000 ALTER TABLE `customer` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table department
# ------------------------------------------------------------

DROP TABLE IF EXISTS `department`;

CREATE TABLE `department` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `department_name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

LOCK TABLES `department` WRITE;
/*!40000 ALTER TABLE `department` DISABLE KEYS */;

INSERT INTO `department` (`id`, `department_name`)
VALUES
	(1,'Anaesthetics'),
	(2,'Cardiology'),
	(3,'Chaplaincy'),
	(4,'Critical care'),
	(5,'Discharge lounge');

/*!40000 ALTER TABLE `department` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table doctor_profile
# ------------------------------------------------------------

DROP TABLE IF EXISTS `doctor_profile`;

CREATE TABLE `doctor_profile` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `full_name` varchar(255) DEFAULT NULL,
  `employee_id` varchar(255) DEFAULT NULL,
  `doctor_id` varchar(255) DEFAULT NULL,
  `chamber_location` varchar(255) DEFAULT NULL,
  `chamber_address` longtext,
  `speciality` varchar(255) DEFAULT NULL,
  `department` varchar(255) DEFAULT NULL,
  `room_ext` longtext,
  `assistant_information` longtext,
  `type_of_doctor` varchar(255) DEFAULT NULL,
  `visit_charge` longtext,
  `doctors_degree` varchar(255) DEFAULT NULL,
  `short_description` longtext,
  `avg_load_patient` int(16) DEFAULT NULL,
  `avg_duration` int(16) DEFAULT NULL,
  `slot_serial` int(4) NOT NULL COMMENT 'slot = 1,serial = 2',
  `session_1` varchar(128) DEFAULT NULL,
  `session_2` varchar(128) DEFAULT NULL,
  `session_3` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

LOCK TABLES `doctor_profile` WRITE;
/*!40000 ALTER TABLE `doctor_profile` DISABLE KEYS */;

INSERT INTO `doctor_profile` (`id`, `full_name`, `employee_id`, `doctor_id`, `chamber_location`, `chamber_address`, `speciality`, `department`, `room_ext`, `assistant_information`, `type_of_doctor`, `visit_charge`, `doctors_degree`, `short_description`, `avg_load_patient`, `avg_duration`, `slot_serial`, `session_1`, `session_2`, `session_3`)
VALUES
	(1,'A','8002','8002','Mirpur','Mirpur','Anesthesiologists','Anaesthetics','901;9001','Jane Doe','Full Time','New: 500; First Follow: 300; Report: Free',NULL,'Lorem Ipsum Dolor Sit ammet',50,10,1,'09:00-13:00','13.00-15.00','16.00-20.00'),
	(2,'AB','8003','8003','khulna','Khilkhet','Anesthesiologists','Anaesthetics','901;9001','Jane Doe','Full Time','New: 500; First Follow: 300; Report: Free',NULL,'Lorem Ipsum Dolor Sit ammet',40,15,1,'09:00-13:00',NULL,NULL),
	(3,'Shovon Rahman shuvo','8004','8004','Dinajpur','Khilgoan','Anesthesiologists','Anaesthetics','901;9001','Jane Doe','Full Time','New: 500; First Follow: 300; Report: Free',NULL,'Lorem Ipsum Dolor Sit ammet',30,15,2,'09:00-13:00',NULL,NULL),
	(4,'Sabit Rahman','8005','8005','Mirpur','Mirpur','Cardiologists','Anaesthetics','901;9001','Jane Doe','Full Time','New: 500; First Follow: 300; Report: Free',NULL,'Lorem Ipsum Dolor Sit ammet',20,20,2,'09:00-13:00',NULL,NULL),
	(5,'shuvo','8006','8006','Mirpur','hello','Anesthesiologists','Anaesthetics','901','Shovon','Full Time','5000',NULL,'hello from the other side',10,15,1,'09:00-13:00','-','-'),
	(6,'rahman','8007','8007','Mirpur','hello','Anesthesiologists','Anaesthetics','901','Shovon','Full Time','5000',NULL,'hello from the other side',10,15,1,'09:00-13:00','-','-'),
	(7,'anisar rahman','8008','8008','Mirpur','hello','Anesthesiologists','Anaesthetics','901','Shovon','Full Time','5000','FCPS','hello from the other side',10,15,1,'09:00-13:00','-','-');

/*!40000 ALTER TABLE `doctor_profile` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table location
# ------------------------------------------------------------

DROP TABLE IF EXISTS `location`;

CREATE TABLE `location` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `location` varchar(256) DEFAULT NULL,
  `thana` varchar(256) DEFAULT NULL,
  `district` varchar(256) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

LOCK TABLES `location` WRITE;
/*!40000 ALTER TABLE `location` DISABLE KEYS */;

INSERT INTO `location` (`id`, `location`, `thana`, `district`)
VALUES
	(1,'Mirpur  11.5','Mirpur 12','Dhaka'),
	(2,'Mirpur 10','Mirpur 10','Dhaka');

/*!40000 ALTER TABLE `location` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table notification
# ------------------------------------------------------------

DROP TABLE IF EXISTS `notification`;

CREATE TABLE `notification` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(16) DEFAULT NULL,
  `message` longtext,
  `status` int(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

LOCK TABLES `notification` WRITE;
/*!40000 ALTER TABLE `notification` DISABLE KEYS */;

INSERT INTO `notification` (`id`, `username`, `message`, `status`)
VALUES
	(1,'akandshuvo','Your Appointment has been taken.',0),
	(2,'chapuadevil','Yoo bro. wass up.',0);

/*!40000 ALTER TABLE `notification` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table schedule
# ------------------------------------------------------------

DROP TABLE IF EXISTS `schedule`;

CREATE TABLE `schedule` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `doctor_id` varchar(255) DEFAULT NULL,
  `employee_id` varchar(255) DEFAULT NULL,
  `schedule_date` varchar(255) DEFAULT NULL,
  `session_1` varchar(255) DEFAULT NULL,
  `session_2` varchar(255) DEFAULT NULL,
  `session_3` varchar(255) DEFAULT NULL,
  `avg_load_patient` varchar(255) DEFAULT NULL,
  `avg_duration` varchar(255) DEFAULT NULL,
  `slot_serial` varchar(255) DEFAULT NULL,
  `month` varchar(255) DEFAULT NULL,
  `year` varchar(255) NOT NULL,
  `status` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=152 DEFAULT CHARSET=latin1;

LOCK TABLES `schedule` WRITE;
/*!40000 ALTER TABLE `schedule` DISABLE KEYS */;

INSERT INTO `schedule` (`id`, `doctor_id`, `employee_id`, `schedule_date`, `session_1`, `session_2`, `session_3`, `avg_load_patient`, `avg_duration`, `slot_serial`, `month`, `year`, `status`)
VALUES
	(1,'8002','8002','01-11-2017','\n                                09:00-13:00                            ','13.00-15.00','16.00-20.00','50','10','1','11','2017','0'),
	(2,'8002','8002','02-11-2017','\n                                09:00-13:00                            ','13.00-15.00','16.00-20.00','50','10','1','11','2017','1'),
	(3,'8002','8002','03-11-2017','09:00-13:00','\n                                13.00-15.00                            ','16.00-20.00','50','10','1','11','2017','1'),
	(4,'8002','8002','04-11-2017','09:00-13:00','13.00-15.00','16.00-20.00','50','10','1','11','2017','1'),
	(5,'8002','8002','05-11-2017','09:00-13:00','13.00-15.00','16.00-20.00','50','10','1','11','2017','1'),
	(6,'8002','8002','06-11-2017','09:00-13:00','13.00-15.00','16.00-20.00','50','10','1','11','2017','1'),
	(7,'8002','8002','07-11-2017','\n                                09:00-13:00                            ','13.00-15.00','16.00-20.00','50','10','2','11','2017','1'),
	(8,'8002','8002','08-11-2017','09:00-13:00','13.00-15.00','16.00-20.00','50','10','1','11','2017','1'),
	(9,'8002','8002','09-11-2017','09:00-13:00','13.00-15.00','16.00-20.00','50','10','1','11','2017','1'),
	(10,'8002','8002','10-11-2017','09:00-13:00','13.00-15.00','16.00-20.00','50','10','1','11','2017','1'),
	(11,'8002','8002','11-11-2017','09:00-13:00','13.00-15.00','16.00-20.00','50','10','1','11','2017','1'),
	(12,'8002','8002','12-11-2017','09:00-13:00','13.00-15.00','16.00-20.00','50','10','1','11','2017','1'),
	(13,'8002','8002','13-11-2017','09:00-13:00','13.00-15.00','16.00-20.00','50','10','1','11','2017','1'),
	(14,'8002','8002','14-11-2017','09:00-13:00','13.00-15.00','16.00-20.00','50','10','1','11','2017','1'),
	(15,'8002','8002','15-11-2017','09:00-13:00','13.00-15.00','16.00-20.00','50','10','1','11','2017','1'),
	(16,'8002','8002','16-11-2017','09:00-13:00','13.00-15.00','16.00-20.00','50','10','1','11','2017','1'),
	(17,'8002','8002','17-11-2017','09:00-13:00','13.00-15.00','16.00-20.00','50','10','1','11','2017','1'),
	(18,'8002','8002','18-11-2017','09:00-13:00','13.00-15.00','16.00-20.00','50','10','1','11','2017','1'),
	(19,'8002','8002','19-11-2017','09:00-13:00','13.00-15.00','16.00-20.00','50','10','1','11','2017','1'),
	(20,'8002','8002','20-11-2017','09:00-13:00','13.00-15.00','16.00-20.00','50','10','1','11','2017','1'),
	(21,'8002','8002','21-11-2017','09:00-13:00','13.00-15.00','16.00-20.00','50','10','1','11','2017','1'),
	(22,'8002','8002','22-11-2017','09:00-13:00','13.00-15.00','16.00-20.00','50','10','1','11','2017','1'),
	(23,'8002','8002','23-11-2017','09:00-13:00','13.00-15.00','16.00-20.00','50','10','1','11','2017','1'),
	(24,'8002','8002','24-11-2017','09:00-13:00','13.00-15.00','16.00-20.00','50','10','1','11','2017','1'),
	(25,'8002','8002','25-11-2017','09:00-13:00','13.00-15.00','16.00-20.00','50','10','1','11','2017','1'),
	(26,'8002','8002','26-11-2017','09:00-13:00','13.00-15.00','16.00-20.00','50','10','1','11','2017','1'),
	(27,'8002','8002','27-11-2017','09:00-13:00','13.00-15.00','16.00-20.00','50','10','1','11','2017','1'),
	(28,'8002','8002','28-11-2017','09:00-13:00','13.00-15.00','16.00-20.00','50','10','1','11','2017','1'),
	(29,'8002','8002','29-11-2017','09:00-13:00','13.00-15.00','16.00-20.00','50','10','1','11','2017','1'),
	(30,'8002','8002','30-11-2017','09:00-13:00','13.00-15.00','16.00-20.00','50','10','1','11','2017','1'),
	(31,'8002','8002','01-12-2017','09:00-13:00','13.00-15.00','16.00-20.00','50','10','1','12','2017','1'),
	(32,'8002','8002','02-12-2017','09:00-13:00','13.00-15.00','16.00-20.00','50','10','1','12','2017','1'),
	(33,'8002','8002','03-12-2017','09:00-13:00','13.00-15.00','16.00-20.00','50','10','1','12','2017','1'),
	(34,'8002','8002','04-12-2017','09:00-13:00','13.00-15.00','16.00-20.00','50','10','1','12','2017','1'),
	(35,'8002','8002','05-12-2017','09:00-13:00','13.00-15.00','16.00-20.00','50','10','1','12','2017','1'),
	(36,'8002','8002','06-12-2017','09:00-13:00','13.00-15.00','16.00-20.00','50','10','1','12','2017','1'),
	(37,'8002','8002','07-12-2017','09:00-13:00','13.00-15.00','16.00-20.00','50','10','1','12','2017','1'),
	(38,'8002','8002','08-12-2017','09:00-13:00','13.00-15.00','16.00-20.00','50','10','1','12','2017','1'),
	(39,'8002','8002','09-12-2017','09:00-13:00','13.00-15.00','16.00-20.00','50','10','1','12','2017','1'),
	(40,'8002','8002','10-12-2017','09:00-13:00','13.00-15.00','16.00-20.00','50','10','1','12','2017','1'),
	(41,'8002','8002','11-12-2017','09:00-13:00','13.00-15.00','16.00-20.00','50','10','1','12','2017','1'),
	(42,'8002','8002','12-12-2017','09:00-13:00','13.00-15.00','16.00-20.00','50','10','1','12','2017','1'),
	(43,'8002','8002','13-12-2017','09:00-13:00','13.00-15.00','16.00-20.00','50','10','1','12','2017','1'),
	(44,'8002','8002','14-12-2017','09:00-13:00','13.00-15.00','16.00-20.00','50','10','1','12','2017','1'),
	(45,'8002','8002','15-12-2017','09:00-13:00','13.00-15.00','16.00-20.00','50','10','1','12','2017','1'),
	(46,'8002','8002','16-12-2017','09:00-13:00','13.00-15.00','16.00-20.00','50','10','1','12','2017','1'),
	(47,'8002','8002','17-12-2017','09:00-13:00','13.00-15.00','16.00-20.00','50','10','1','12','2017','1'),
	(48,'8002','8002','18-12-2017','09:00-13:00','13.00-15.00','16.00-20.00','50','10','1','12','2017','1'),
	(49,'8002','8002','19-12-2017','09:00-13:00','13.00-15.00','16.00-20.00','50','10','1','12','2017','1'),
	(50,'8002','8002','20-12-2017','09:00-13:00','13.00-15.00','16.00-20.00','50','10','1','12','2017','1'),
	(51,'8002','8002','21-12-2017','09:00-13:00','13.00-15.00','16.00-20.00','50','10','1','12','2017','1'),
	(52,'8002','8002','22-12-2017','09:00-13:00','13.00-15.00','16.00-20.00','50','10','1','12','2017','1'),
	(53,'8002','8002','23-12-2017','09:00-13:00','13.00-15.00','16.00-20.00','50','10','1','12','2017','1'),
	(54,'8002','8002','24-12-2017','09:00-13:00','13.00-15.00','16.00-20.00','50','10','1','12','2017','1'),
	(55,'8002','8002','25-12-2017','09:00-13:00','13.00-15.00','16.00-20.00','50','10','1','12','2017','1'),
	(56,'8002','8002','26-12-2017','09:00-13:00','13.00-15.00','16.00-20.00','50','10','1','12','2017','1'),
	(57,'8002','8002','27-12-2017','09:00-13:00','13.00-15.00','16.00-20.00','50','10','1','12','2017','1'),
	(58,'8002','8002','28-12-2017','09:00-13:00','13.00-15.00','16.00-20.00','50','10','1','12','2017','1'),
	(59,'8002','8002','29-12-2017','09:00-13:00','13.00-15.00','16.00-20.00','50','10','1','12','2017','1'),
	(60,'8002','8002','30-12-2017','09:00-13:00','13.00-15.00','16.00-20.00','50','10','\n                                1                            ','12','2017','1'),
	(61,'8002','8002','31-12-2017','09:00-13:00','13.00-15.00','16.00-20.00','50','10','1','12','2017','1'),
	(62,'8004','8004','01-12-2017','09:00-13:00',NULL,NULL,'30','15','2','12','2017','1'),
	(63,'8004','8004','02-12-2017','09:00-13:00',NULL,NULL,'30','15','2','12','2017','1'),
	(64,'8004','8004','03-12-2017','09:00-13:00',NULL,NULL,'30','15','2','12','2017','1'),
	(65,'8004','8004','04-12-2017','09:00-13:00',NULL,NULL,'30','15','2','12','2017','1'),
	(66,'8004','8004','05-12-2017','09:00-13:00',NULL,NULL,'30','15','2','12','2017','1'),
	(67,'8004','8004','06-12-2017','09:00-13:00',NULL,NULL,'30','15','2','12','2017','1'),
	(68,'8004','8004','07-12-2017','09:00-13:00',NULL,NULL,'30','15','2','12','2017','1'),
	(69,'8004','8004','08-12-2017','09:00-13:00',NULL,NULL,'30','15','2','12','2017','1'),
	(70,'8004','8004','09-12-2017','09:00-13:00',NULL,NULL,'30','15','2','12','2017','1'),
	(71,'8004','8004','10-12-2017','09:00-13:00',NULL,NULL,'30','15','2','12','2017','1'),
	(72,'8004','8004','11-12-2017','09:00-13:00',NULL,NULL,'30','15','2','12','2017','1'),
	(73,'8004','8004','12-12-2017','09:00-13:00',NULL,NULL,'30','15','2','12','2017','1'),
	(74,'8004','8004','13-12-2017','09:00-13:00',NULL,NULL,'30','15','2','12','2017','1'),
	(75,'8004','8004','14-12-2017','09:00-13:00',NULL,NULL,'30','15','2','12','2017','1'),
	(76,'8004','8004','15-12-2017','09:00-13:00',NULL,NULL,'30','15','2','12','2017','1'),
	(77,'8004','8004','16-12-2017','09:00-13:00',NULL,NULL,'30','15','2','12','2017','1'),
	(78,'8004','8004','17-12-2017','09:00-13:00',NULL,NULL,'30','15','2','12','2017','1'),
	(79,'8004','8004','18-12-2017','09:00-13:00',NULL,NULL,'30','15','2','12','2017','1'),
	(80,'8004','8004','19-12-2017','09:00-13:00',NULL,NULL,'30','15','2','12','2017','1'),
	(81,'8004','8004','20-12-2017','09:00-13:00',NULL,NULL,'30','15','2','12','2017','1'),
	(82,'8004','8004','21-12-2017','09:00-13:00',NULL,NULL,'30','15','2','12','2017','1'),
	(83,'8004','8004','22-12-2017','09:00-13:00',NULL,NULL,'30','15','2','12','2017','1'),
	(84,'8004','8004','23-12-2017','09:00-13:00',NULL,NULL,'30','15','2','12','2017','1'),
	(85,'8004','8004','24-12-2017','09:00-13:00',NULL,NULL,'30','15','2','12','2017','1'),
	(86,'8004','8004','25-12-2017','09:00-13:00',NULL,NULL,'30','15','2','12','2017','1'),
	(87,'8004','8004','26-12-2017','09:00-13:00',NULL,NULL,'30','15','2','12','2017','1'),
	(88,'8004','8004','27-12-2017','09:00-13:00',NULL,NULL,'30','15','2','12','2017','1'),
	(89,'8004','8004','28-12-2017','09:00-13:00',NULL,NULL,'30','15','2','12','2017','1'),
	(90,'8004','8004','29-12-2017','09:00-13:00',NULL,NULL,'30','15','2','12','2017','1'),
	(91,'8004','8004','30-12-2017','09:00-13:00',NULL,NULL,'30','15','1','12','2017','1'),
	(92,'8004','8004','31-12-2017','09:00-13:00',NULL,NULL,'30','15','1','12','2017','1'),
	(93,'8002','8002','01-01-2018','09:00-13:00','13.00-15.00','16.00-20.00','50','10','1','01','2018','1'),
	(94,'8002','8002','02-01-2018','09:00-13:00','13.00-15.00','16.00-20.00','50','10','1','01','2018','1'),
	(95,'8002','8002','03-01-2018','09:00-13:00','13.00-15.00','16.00-20.00','50','10','1','01','2018','1'),
	(96,'8002','8002','04-01-2018','09:00-13:00','13.00-15.00','\n                                16.00-20.00                            ','50','10','2','01','2018','1'),
	(97,'8002','8002','05-01-2018','09:00-13:00','13.00-15.00','16.00-20.00','50','10','2','01','2018','1'),
	(98,'8002','8002','06-01-2018','09:00-13:00','13.00-15.00','16.00-20.00','50','10','2','01','2018','1'),
	(99,'8002','8002','07-01-2018','09:00-13:00','13.00-15.00','16.00-20.00','50','10','2','01','2018','1'),
	(100,'8002','8002','08-01-2018','09:00-13:00','13.00-15.00','16.00-20.00','50','10','1','01','2018','1'),
	(101,'8002','8002','09-01-2018','09:00-13:00','13.00-15.00','16.00-20.00','50','10','1','01','2018','1'),
	(102,'8002','8002','10-01-2018','09:00-13:00','13.00-15.00','16.00-20.00','50','10','1','01','2018','1'),
	(103,'8002','8002','11-01-2018','09:00-13:00','13.00-15.00','16.00-20.00','50','10','1','01','2018','1'),
	(104,'8002','8002','12-01-2018','09:00-13:00','13.00-15.00','16.00-20.00','50','10','1','01','2018','1'),
	(105,'8002','8002','13-01-2018','09:00-13:00','13.00-15.00','16.00-20.00','50','10','1','01','2018','1'),
	(106,'8002','8002','14-01-2018','09:00-13:00','13.00-15.00','16.00-20.00','50','10','1','01','2018','1'),
	(107,'8002','8002','15-01-2018','09:00-13:00','13.00-15.00','16.00-20.00','50','10','1','01','2018','1'),
	(108,'8002','8002','16-01-2018','09:00-13:00','13.00-15.00','16.00-20.00','50','10','1','01','2018','1'),
	(109,'8002','8002','17-01-2018','09:00-13:00','13.00-15.00','16.00-20.00','50','10','1','01','2018','1'),
	(110,'8002','8002','18-01-2018','09:00-13:00','13.00-15.00','16.00-20.00','50','10','1','01','2018','1'),
	(111,'8002','8002','19-01-2018','09:00-13:00','13.00-15.00','16.00-20.00','50','10','1','01','2018','1'),
	(112,'8002','8002','20-01-2018','09:00-13:00','13.00-15.00','16.00-20.00','50','10','1','01','2018','1'),
	(113,'8002','8002','21-01-2018','09:00-13:00','13.00-15.00','16.00-20.00','50','10','1','01','2018','1'),
	(114,'8002','8002','22-01-2018','09:00-13:00','-','-','50','10','1','01','2018','1'),
	(115,'8002','8002','23-01-2018','09:00-13:00','13.00-15.00','16.00-20.00','50','10','1','01','2018','1'),
	(116,'8002','8002','24-01-2018','09:00-13:00','13.00-15.00','16.00-20.00','50','10','1','01','2018','1'),
	(117,'8002','8002','25-01-2018','09:00-13:00','13.00-15.00','16.00-20.00','50','10','1','01','2018','1'),
	(118,'8002','8002','26-01-2018','09:00-13:00','13.00-15.00','16.00-20.00','50','10','1','01','2018','1'),
	(119,'8002','8002','27-01-2018','09:00-13:00','13.00-15.00','16.00-20.00','50','10','1','01','2018','1'),
	(120,'8002','8002','28-01-2018','09:00-13:00','13.00-15.00','16.00-20.00','50','10','1','01','2018','1'),
	(121,'8002','8002','29-01-2018','09:00-13:00','13.00-15.00','16.00-20.00','50','10','1','01','2018','1'),
	(122,'8002','8002','30-01-2018','09:00-13:00','13.00-15.00','16.00-20.00','50','10','1','01','2018','1'),
	(123,'8002','8002','31-01-2018','09:00-13:00','-','-','50','10','2','01','2018','1'),
	(124,'8002','8002','01-02-2018','09:00-13:00','13.00-15.00','16.00-20.00','50','10','1','02','2018','1'),
	(125,'8002','8002','02-02-2018','09:00-13:00','13.00-15.00','16.00-20.00','50','10','1','02','2018','1'),
	(126,'8002','8002','03-02-2018','09:00-13:00','13.00-15.00','16.00-20.00','50','10','1','02','2018','1'),
	(127,'8002','8002','04-02-2018','09:00-13:00','13.00-15.00','16.00-20.00','50','10','1','02','2018','1'),
	(128,'8002','8002','05-02-2018','09:00-13:00','13.00-15.00','16.00-20.00','50','10','1','02','2018','1'),
	(129,'8002','8002','06-02-2018','09:00-13:00','13.00-15.00','16.00-20.00','50','10','1','02','2018','1'),
	(130,'8002','8002','07-02-2018','09:00-13:00','13.00-15.00','16.00-20.00','50','10','1','02','2018','1'),
	(131,'8002','8002','08-02-2018','09:00-13:00','13.00-15.00','16.00-20.00','50','10','2','02','2018','1'),
	(132,'8002','8002','09-02-2018','09:00-13:00','13.00-15.00','16.00-20.00','50','10','1','02','2018','1'),
	(133,'8002','8002','10-02-2018','09:00-13:00','13.00-15.00','16.00-20.00','50','10','1','02','2018','1'),
	(134,'8002','8002','11-02-2018','09:00-13:00','13.00-15.00','16.00-20.00','50','10','1','02','2018','1'),
	(135,'8002','8002','12-02-2018','09:00-13:00','13.00-15.00','16.00-20.00','50','10','1','02','2018','1'),
	(136,'8002','8002','13-02-2018','09:00-13:00','13.00-15.00','16.00-20.00','50','10','1','02','2018','1'),
	(137,'8002','8002','14-02-2018','09:00-13:00','13.00-15.00','16.00-20.00','50','10','1','02','2018','1'),
	(138,'8002','8002','15-02-2018','09:00-13:00','13.00-15.00','16.00-20.00','50','10','1','02','2018','1'),
	(139,'8002','8002','16-02-2018','09:00-13:00','13.00-15.00','16.00-20.00','50','10','1','02','2018','1'),
	(140,'8002','8002','17-02-2018','09:00-13:00','13.00-15.00','16.00-20.00','50','10','1','02','2018','1'),
	(141,'8002','8002','18-02-2018','09:00-13:00','13.00-15.00','16.00-20.00','50','10','1','02','2018','1'),
	(142,'8002','8002','19-02-2018','09:00-13:00','13.00-15.00','16.00-20.00','50','10','1','02','2018','1'),
	(143,'8002','8002','20-02-2018','09:00-13:00','13.00-15.00','16.00-20.00','50','10','1','02','2018','1'),
	(144,'8002','8002','21-02-2018','09:00-13:00','13.00-15.00','16.00-20.00','50','10','1','02','2018','1'),
	(145,'8002','8002','22-02-2018','09:00-13:00','13.00-15.00','16.00-20.00','50','10','1','02','2018','1'),
	(146,'8002','8002','23-02-2018','09:00-13:00','13.00-15.00','16.00-20.00','50','10','1','02','2018','1'),
	(147,'8002','8002','24-02-2018','09:00-13:00','13.00-15.00','16.00-20.00','50','10','1','02','2018','1'),
	(148,'8002','8002','25-02-2018','09:00-13:00','13.00-15.00','16.00-20.00','50','10','1','02','2018','1'),
	(149,'8002','8002','26-02-2018','09:00-13:00','13.00-15.00','16.00-20.00','50','10','1','02','2018','1'),
	(150,'8002','8002','27-02-2018','09:00-13:00','13.00-15.00','16.00-20.00','50','10','1','02','2018','1'),
	(151,'8002','8002','28-02-2018','09:00-13:00','13.00-15.00','16.00-20.00','50','10','1','02','2018','1');

/*!40000 ALTER TABLE `schedule` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table speciality
# ------------------------------------------------------------

DROP TABLE IF EXISTS `speciality`;

CREATE TABLE `speciality` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `speciality` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

LOCK TABLES `speciality` WRITE;
/*!40000 ALTER TABLE `speciality` DISABLE KEYS */;

INSERT INTO `speciality` (`id`, `speciality`)
VALUES
	(1,'Anesthesiologists'),
	(2,'Cardiologists'),
	(3,'Coroners'),
	(4,'Dermatologists'),
	(5,'Diabetologists'),
	(6,'Emergency physicians');

/*!40000 ALTER TABLE `speciality` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table user
# ------------------------------------------------------------

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `full_name` varchar(128) NOT NULL,
  `employee_id` int(128) NOT NULL,
  `password` varchar(128) NOT NULL,
  `user_level` int(1) NOT NULL COMMENT ' super admin = 1;admin=2;doctor = 3;agent = 4;receptionist = 5;',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;

INSERT INTO `user` (`id`, `full_name`, `employee_id`, `password`, `user_level`)
VALUES
	(1,'Shovon Rahman Shuvo',2145,'dg344i',1),
	(4,'Super Admin',8000,'dg344i',1),
	(5,'Admin',8001,'dg344i',2),
	(6,'Doctor',8002,'dg344i',3),
	(7,'Asadujjaman Rajib',8003,'dg344i',4),
	(8,'Sirajum Monir',8004,'dg344i',4);

/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
