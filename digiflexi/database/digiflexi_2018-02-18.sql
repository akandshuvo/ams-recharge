# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: localhost (MySQL 5.7.21)
# Database: digiflexi
# Generation Time: 2018-02-17 19:13:35 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table balance_report
# ------------------------------------------------------------

DROP TABLE IF EXISTS `balance_report`;

CREATE TABLE `balance_report` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `new_balance` varchar(255) DEFAULT NULL,
  `previous_balance` varchar(255) DEFAULT NULL,
  `added_amount` varchar(255) DEFAULT NULL,
  `account_name` varchar(128) DEFAULT NULL,
  `added_by` varchar(255) DEFAULT NULL,
  `datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table notification
# ------------------------------------------------------------

DROP TABLE IF EXISTS `notification`;

CREATE TABLE `notification` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `message` longtext,
  `merchant_username` varchar(64) DEFAULT NULL,
  `response_code` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table recharge
# ------------------------------------------------------------

DROP TABLE IF EXISTS `recharge`;

CREATE TABLE `recharge` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `digiflexi_id` varchar(128) DEFAULT NULL,
  `digi_id` varchar(128) DEFAULT NULL,
  `response_code` varchar(128) DEFAULT NULL,
  `message` longtext,
  `response_time` varchar(128) DEFAULT NULL,
  `operator_id` varchar(128) DEFAULT NULL,
  `operator_name` varchar(64) DEFAULT NULL,
  `msisdn` varchar(128) DEFAULT NULL,
  `amount` int(32) DEFAULT NULL,
  `merchant_username` varchar(128) DEFAULT NULL,
  `datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `recharge_status` int(4) DEFAULT NULL,
  `msisdn_type` varchar(16) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `searching_digiflexi_id` (`digiflexi_id`),
  KEY `search_recharge_status` (`recharge_status`),
  KEY `merchant_username` (`merchant_username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table user
# ------------------------------------------------------------

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `full_name` varchar(128) NOT NULL,
  `username` varchar(32) DEFAULT NULL,
  `email` varchar(128) DEFAULT NULL,
  `password` varchar(128) NOT NULL,
  `user_level` int(1) DEFAULT NULL COMMENT 'admin=1;merchant:2',
  `balance` int(255) DEFAULT NULL,
  `status` int(1) DEFAULT NULL COMMENT 'active =1; deactive = 0',
  `activation_string` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;

INSERT INTO `user` (`id`, `full_name`, `username`, `email`, `password`, `user_level`, `balance`, `status`, `activation_string`)
VALUES
	(1,'Digicon Technologies Ltd','digicon','digicon@digicontechnologies.com','d6ec1253c69c6f282d12810a445a26fb',1,20000,1,NULL),
	(2,'Shovon Rahman Shuvo','akandshuvo','akandshuvo@gmail.com','d6ec1253c69c6f282d12810a445a26fb',2,5000,1,NULL),
	(3,'Sabit Rahman Sokal','sokal','akandsokal@gmail.com','d6ec1253c69c6f282d12810a445a26fb',2,5000,1,NULL),
	(4,'Shovon Rahman Shuvo','akandshuvo','akandshuvo@gmail.com','dg344i',2,0,0,'34KOAVUAvpUrqtgq0TAwm68Q4JmDpHXK8Ed6eECn7Ltjz38TyxDQCBah6ZvPuntSgOJq3xfMQR1dHU0tVFTna0Pdz0RUs589Wh6XuDiMlqKgh49ArqIJHaqwgmtPhNfl');

/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
