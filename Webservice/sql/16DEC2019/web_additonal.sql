/*
SQLyog Enterprise - MySQL GUI v8.18 
MySQL - 5.7.28 : Database - j2jsoftw_matri_web
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`j2jsoftw_matri_web` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `j2jsoftw_matri_web`;

/*Table structure for table `_japp` */

DROP TABLE IF EXISTS `_japp`;

CREATE TABLE `_japp` (
  `appid` int(11) NOT NULL AUTO_INCREMENT,
  `hostname` varchar(255) DEFAULT NULL,
  `datadir` varchar(255) DEFAULT NULL,
  `dbname` varchar(255) DEFAULT NULL,
  `dateofcreation` datetime DEFAULT NULL,
  `licenceto` varchar(255) DEFAULT NULL,
  `hosturl` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`appid`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `_japp` */

insert  into `_japp`(`appid`,`hostname`,`datadir`,`dbname`,`dateofcreation`,`licenceto`,`hosturl`) values ('1','matrimony.dev.j2jsoftwaresolutions.com','data','j2jsoftw_matri_web','2019-12-10 00:00:00','matrimony.dev.j2jsoftwaresolutions.com','matrimony.dev.j2jsoftwaresolutions.com');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
