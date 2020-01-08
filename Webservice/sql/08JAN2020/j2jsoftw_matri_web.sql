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

/*Table structure for table `_jalbum` */

DROP TABLE IF EXISTS `_jalbum`;

CREATE TABLE `_jalbum` (
  `albumid` int(11) NOT NULL AUTO_INCREMENT,
  `albumtit` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `albumdesc` text CHARACTER SET latin1,
  `filepath` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `ispublish` int(2) NOT NULL DEFAULT '0',
  `postedon` datetime DEFAULT NULL,
  PRIMARY KEY (`albumid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `_jalbum` */

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

/*Table structure for table `_jcontact` */

DROP TABLE IF EXISTS `_jcontact`;

CREATE TABLE `_jcontact` (
  `contactid` int(11) NOT NULL AUTO_INCREMENT,
  `contacttitle` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `contactdescription` text CHARACTER SET latin1,
  `contactmobile` int(11) NOT NULL,
  `contactemail` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  PRIMARY KEY (`contactid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `_jcontact` */

/*Table structure for table `_jcontactus` */

DROP TABLE IF EXISTS `_jcontactus`;

CREATE TABLE `_jcontactus` (
  `contid` int(11) NOT NULL AUTO_INCREMENT,
  `contmob` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `contemail` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `personname` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `content` varchar(255) DEFAULT NULL,
  `convtime` varchar(255) DEFAULT NULL,
  `postedon` datetime DEFAULT NULL,
  PRIMARY KEY (`contid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `_jcontactus` */

/*Table structure for table `_jdayevent` */

DROP TABLE IF EXISTS `_jdayevent`;

CREATE TABLE `_jdayevent` (
  `eventid` int(11) NOT NULL AUTO_INCREMENT,
  `edate` datetime DEFAULT NULL,
  `descT` text CHARACTER SET latin1,
  `descE` text CHARACTER SET latin1,
  `descM` text CHARACTER SET latin1,
  `eventcate` int(11) NOT NULL,
  PRIMARY KEY (`eventid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `_jdayevent` */

/*Table structure for table `_jdownalbum` */

DROP TABLE IF EXISTS `_jdownalbum`;

CREATE TABLE `_jdownalbum` (
  `dalbumid` int(11) NOT NULL AUTO_INCREMENT,
  `albumtit` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `albumdesc` text CHARACTER SET latin1,
  `filepath` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `ispublish` int(11) DEFAULT NULL,
  `postedon` datetime DEFAULT NULL,
  PRIMARY KEY (`dalbumid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `_jdownalbum` */

/*Table structure for table `_jdownloads` */

DROP TABLE IF EXISTS `_jdownloads`;

CREATE TABLE `_jdownloads` (
  `downloadid` int(11) NOT NULL AUTO_INCREMENT,
  `downloadtitle` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `downloaddescription` text CHARACTER SET latin1,
  `downloadfilepath` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `ispublished` int(11) NOT NULL,
  `albumid` int(11) DEFAULT NULL,
  `thumbfile` varchar(255) DEFAULT NULL,
  `postedon` datetime DEFAULT NULL,
  PRIMARY KEY (`downloadid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `_jdownloads` */

/*Table structure for table `_jfaq` */

DROP TABLE IF EXISTS `_jfaq`;

CREATE TABLE `_jfaq` (
  `faqid` int(11) NOT NULL AUTO_INCREMENT,
  `faqquestion` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `faqanswer` text CHARACTER SET latin1,
  `ispublished` int(11) NOT NULL,
  `postedon` datetime DEFAULT NULL,
  `isusefulY` int(5) DEFAULT '1',
  `isusefulN` int(5) DEFAULT '0',
  PRIMARY KEY (`faqid`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

/*Data for the table `_jfaq` */

insert  into `_jfaq`(`faqid`,`faqquestion`,`faqanswer`,`ispublished`,`postedon`,`isusefulY`,`isusefulN`) values ('2','How can I register on happymarriages.in ?','Registering in our wedlink matrimony site is a simple process, you can register by filling the online registration that runs for 3 pages or use the Quick registration form, a shorter and simpler process available. You can also call our customer support staff @ 9750057678 and can register over mobile phone also from 10.00 am to 6.30 pm. ','1','2019-10-29 10:21:36','3','1'),('3','I did my registration, but my profile does not show up online ?','Every new profile will be validated by our ADMIN (Backend Team) and upon activation, your profile will be visible to all ! Verification of profiles is done manually. Our support team checks each and every profile carefully for any invalid or incorrect information and also candidates are contacted over the phone for confirmation of authority. You will get a notification once the profile is active !','1','2019-10-29 10:21:49','2','0'),('4',' Can I upload my photograph?','You have the option of uploading your photograph on My Profile Page. You can upload a maximum of three photographs.','1','2019-10-29 10:22:05','2','0'),('5','How do I upload Horoscope ?','We have an exclusive interface to key in your horoscope details. Login to your Matrimony account and click Manage Horoscope','1','2019-10-29 10:22:21','2','0'),('6','Can I edit all my details ?','At any time, you can update your profile by clicking Modify My Profile button .','1','2019-10-29 10:22:35','2','0'),('7','I see a tab called MY MATCHES, What’s the use of it ?','My Matches fetches the profiles matching your partner preferences that you keyed in while registering your profile. Its dynamically updated','1','2019-10-29 10:22:48','1','0'),('8','Can I shortlist/bookmark a Profile ?','Yes, you can ! Its an useful feature to make a note of the interested profiles. You need to be logged in to use the shortlist feature.','1','2019-10-29 10:23:03','1','0'),('9','How do I delete Shortlisted profiles?','Login using your matrimonial \"User ID\" and \"Password\". Click on the \"Shortlisted Profiles\". You could view and delete the Bookmarked members !','1','2019-10-29 10:23:16','1','0'),('10','Is my personal information safe?','Please read our privacy policy displayed seperately','1','2019-10-29 10:23:31','1','0'),('11','Why should I choose your paid membership package ?','A paid membership have various packages and options to help you access advanced features of happymarriages.in. Its Benefits : Search suitable profile through our matrimonial Website Contact suitable matches via contact number, personalized messages, and customer service. Send and receive personalized messages. Customer care support. Paid Matrimonial Members get top services and benefits that are not available to members who choose a free membership. Paid Matrimonial Members can express interest and write messages to other members of happymarriages.in','1','2019-10-29 10:24:07','1','0');

/*Table structure for table `_jfeature` */

DROP TABLE IF EXISTS `_jfeature`;

CREATE TABLE `_jfeature` (
  `featureid` int(11) NOT NULL AUTO_INCREMENT,
  `featurename` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`featureid`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

/*Data for the table `_jfeature` */

insert  into `_jfeature`(`featureid`,`featurename`) values ('1','Brand Name');

/*Table structure for table `_jfonts` */

DROP TABLE IF EXISTS `_jfonts`;

CREATE TABLE `_jfonts` (
  `fontid` int(11) NOT NULL AUTO_INCREMENT,
  `fontname` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `fontpath` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  PRIMARY KEY (`fontid`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `_jfonts` */

insert  into `_jfonts`(`fontid`,`fontname`,`fontpath`) values ('1','Oswald','http://fonts.googleapis.com/css?family=Oswald'),('2','Droid Sans','http://fonts.googleapis.com/css?family=Droid+Sans');

/*Table structure for table `_jitemcategory` */

DROP TABLE IF EXISTS `_jitemcategory`;

CREATE TABLE `_jitemcategory` (
  `categoryid` int(11) NOT NULL AUTO_INCREMENT,
  `categoryname` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  PRIMARY KEY (`categoryid`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8;

/*Data for the table `_jitemcategory` */

insert  into `_jitemcategory`(`categoryid`,`categoryname`) values ('10','Cotton'),('11','Cotton Kurti'),('12','Cotton Synthetic Chudi'),('13','Cotton Synthetic'),('14','Cotton Synthetic Saree'),('15','Cotton Nighty'),('16','Cotton Shirts'),('17','Silk Cotton Saree'),('18','Cotton Saree'),('19','Fancy Cotton'),('20','Cotton Chudithar Material'),('21','Batik Special'),('22','Karachi Style'),('23','Blouse Material'),('24','Stiched Kurti'),('25','Unstiched Kurti'),('26','Silk Cotton Chudi');

/*Table structure for table `_jlisting` */

DROP TABLE IF EXISTS `_jlisting`;

CREATE TABLE `_jlisting` (
  `itemid` int(11) NOT NULL AUTO_INCREMENT,
  `categoryid` int(11) NOT NULL DEFAULT '0',
  `itemname` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `itemdesc` text CHARACTER SET latin1,
  `itemprice` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `filename` varchar(255) DEFAULT NULL,
  `ispublished` int(11) DEFAULT NULL,
  `postedon` datetime DEFAULT NULL,
  `itemfilename` varchar(255) DEFAULT NULL,
  `shortdescription` varchar(255) DEFAULT NULL,
  `keywords` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`itemid`)
) ENGINE=InnoDB AUTO_INCREMENT=65 DEFAULT CHARSET=utf8;

/*Data for the table `_jlisting` */

insert  into `_jlisting`(`itemid`,`categoryid`,`itemname`,`itemdesc`,`itemprice`,`filename`,`ispublished`,`postedon`,`itemfilename`,`shortdescription`,`keywords`) values ('43','10','Aarvi Fashions ','<p>cotton</p>','20','_1504527464_kkk_copy.png','1','2017-09-04 12:12:12','aarvi-fashions','cotton',''),('44','11','Me Style','<p>cotton</p>','10','1504603070787de4d38ad008b01e4fe98f341cd472.png','1','2017-09-05 09:17:55','me-style','cotton',''),('45','18','Bagalpori Mercrised Cotten','<p>cotton</p>','22','_1504855210_67.png','1','2017-09-05 09:27:00','bagalpori-mercrised-cotten','cotton',''),('46','12','Cotton Chudi ','<p>cotton</p>','25','_1504780179_111.png','1','2017-09-05 09:51:39','cotton-chudi','cotton',''),('47','17','Silk Cotton','<p>cotton</p>','100','1504605904d58ecf97bf17509290e60d80bdaa1a5d.png','1','2017-09-05 10:05:12','silk-cotton','cotton',''),('48','12','Angroop Mokshaa','<p>chudi</p>','150','150460636094d42922eadf104f6899d22d40cdfd73.png','1','2017-09-05 10:12:46','angroop-mokshaa','chudi',''),('49','14','Baalar Pari','<p>cotton</p>','390','1504607813dd45c1dc32d2f6a7a7a0964d07175224.png','1','2017-09-05 10:36:58','baalar-pari','cotton',''),('50','20','Gogars ','<p>chudi</p>','400','15046082414a753b73edfd855a9d831b7775347ffc.png','1','2017-09-05 10:44:06','gogars','chudi',''),('51','22','Aarvi Roop Mohini','<p>chudi</p>','56','_1504609302_mo_copy.png','1','2017-09-05 10:56:22','aarvi-roop-mohini','chudi ',''),('52','24','Angroop Dairy Milk','<p>kurti</p>','44','1504612507a6353b8a53d2392b2d8a331663249bb6.png','1','2017-09-05 11:55:12','angroop-dairy-milk','kurti',''),('53','21','Aarvi Batik Spcial','<p>batik</p>','300','15047615797cc97f464a27cbc5d41cef4973dbe6db.png','1','2017-09-07 05:19:45','aarvi-batik-spcial','batik',''),('54','10','Aarvi Prachi ','<p>cotton</p>','39','15047628551a4e0e6fe555ef32e005cc9420d08d53.png','1','2017-09-07 05:41:03','aarvi-prachi','cotton',''),('55','19','Aarvi Mahi Vol 2 Patiyala','<p>patiyala</p>','40','1504763496a50a37ea199ed374a7726da2769e1c7e.png','1','2017-09-07 05:51:40','aarvi-mahi-vol-2-patiyala','patiyala',''),('56','19','Aarvi Rangoli','<p>rangoli</p>','500','1504764160c8794bfad1ea6b11725ef7a15432b4f5.png','1','2017-09-07 06:02:44','aarvi-rangoli','rangoli',''),('57','20','Aarvi Madhubani','<p>madhubani</p>','500','15047645280387f1a49b444fc20d000c81be0f8252.png','1','2017-09-07 06:08:52','aarvi-madhubani','madhubani',''),('58','13','Aarvi Bandhej','<p>cotton</p>','600','1504765094d7dae310d9979aeca564e73c9059fa6c.png','1','2017-09-07 06:18:19','aarvi-bandhej','cotton',''),('59','13','Aarvi Odhani','<p>cotton</p>','300','1504765514f61656bebb0d05ee84ace59e8e253f49.png','1','2017-09-07 06:25:19','aarvi-odhani','cotton',''),('60','14','Deeptex Mother India Vol 21','<p>deeptex</p>','500','1504766535bbca760a565298e274c912811d81bc4b.png','1','2017-09-07 06:42:19','deeptex-mother-india-vol-21','Deeptex',''),('61','20','Pranjul Priyanka Patiyala Spl 9','<p>cotton</p>','300','15047692102972bf23bea0c24454f2df3f661f3e2d.png','1','2017-09-07 07:27:04','pranjul-priyanka-patiyala-spl-9','cotton',''),('62','24','Pranjul Pankhuri Kurti Fabrics Vol 4','<p>kurti</p>','1000','15047721262d14bef1d456ded29a7d527d6d4786d6.png','1','2017-09-07 08:15:33','pranjul-pankhuri-kurti-fabrics-vol-4','kurti',''),('63','26','Baalar Collection','<p>chudi</p>','500','150484986037e04b80586b9e68ca23e204b855fdde.png','1','2017-09-08 05:51:05','baalar-collection','chudi',''),('64','26','Baalar Premium Collection','<p>chudi</p>','2000','1504852905eaa4ec2fd091a8a75bb648a51f7c8353.png','1','2017-09-08 06:41:50','baalar-premium-collection','chudi','');

/*Table structure for table `_jlistingfeature` */

DROP TABLE IF EXISTS `_jlistingfeature`;

CREATE TABLE `_jlistingfeature` (
  `itemfeatureid` int(11) NOT NULL AUTO_INCREMENT,
  `itemid` int(11) DEFAULT NULL,
  `featureid` int(11) DEFAULT NULL,
  `itemvalue` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`itemfeatureid`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

/*Data for the table `_jlistingfeature` */

/*Table structure for table `_jlistingimg` */

DROP TABLE IF EXISTS `_jlistingimg`;

CREATE TABLE `_jlistingimg` (
  `itemimgid` int(11) NOT NULL AUTO_INCREMENT,
  `itemid` int(11) NOT NULL DEFAULT '0',
  `filename` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `ispublished` int(11) DEFAULT NULL,
  `postedon` datetime DEFAULT NULL,
  PRIMARY KEY (`itemimgid`)
) ENGINE=InnoDB AUTO_INCREMENT=315 DEFAULT CHARSET=utf8;

/*Data for the table `_jlistingimg` */

insert  into `_jlistingimg`(`itemimgid`,`itemid`,`filename`,`ispublished`,`postedon`) values ('165','18','_1501563979_white.jpg','1','2017-08-01 05:06:19'),('166','18','_1501563994_53b1618198a9299e9b625a1213da01a3_large.jpg','1','2017-08-01 05:06:34'),('167','18','_1501564094_2003-tata-indigo-gls---75-000-kms-driven-in-old-navy-nagar-vb201705171774173-ak_lwbp480413606-1500485918_gv.jpeg','1','2017-08-01 05:08:14'),('168','34','_1501564579_amba.jpg','1','2017-08-01 05:16:19'),('169','34','_1501564602_ambassador-car-and-goat-fort-kochi-india.jpg','1','2017-08-01 05:16:42'),('170','34','_1501564637_ambassador-car.jpg','1','2017-08-01 05:17:17'),('171','34','_1501564665__1501137337_real_sweet_ambassador!.jpg','1','2017-08-01 05:17:45'),('172','31','_1502952590_loyu.jpg','1','2017-08-17 06:49:50'),('173','31','_1502952603_loyjki.jpg','0','2017-08-17 06:50:03'),('174','31','_1502952616_loyu2.jpg','1','2017-08-17 06:50:16'),('175','31','_1502952628_loyukl.jpg','1','2017-08-17 06:50:28'),('176','31','_1502952676_loyu2.jpg','1','2017-08-17 06:51:16'),('179','43','_1504595602_amr_copy.png','1','2017-09-05 07:13:22'),('180','43','_1504595857_sd_copy.png','1','2017-09-05 07:17:37'),('181','43','_1504596083_aop_copy.png','1','2017-09-05 07:21:23'),('182','43','_1504596395_mu_copy.png','1','2017-09-05 07:26:35'),('183','43','_1504596589_yyy_copy.png','1','2017-09-05 07:29:49'),('184','43','_1504596786_nf_copy.png','1','2017-09-05 07:33:06'),('185','43','_1504596908_do_copy.png','1','2017-09-05 07:35:08'),('186','43','_1504600822_ff_copy.png','1','2017-09-05 08:40:22'),('187','44','_1504603121_pa_copy.png','1','2017-09-05 09:18:41'),('188','51','_1504611165_1.png','1','2017-09-05 11:32:45'),('189','51','_1504611182_2.png','1','2017-09-05 11:33:02'),('190','51','_1504611198_3.png','1','2017-09-05 11:33:18'),('191','51','_1504611217_4.png','1','2017-09-05 11:33:37'),('192','51','_1504611241_5.png','1','2017-09-05 11:34:01'),('193','51','_1504611269_6.png','1','2017-09-05 11:34:29'),('194','51','_1504611297_7.png','1','2017-09-05 11:34:57'),('195','51','_1504611318_8.png','1','2017-09-05 11:35:18'),('196','51','_1504611340_9.png','1','2017-09-05 11:35:40'),('197','51','_1504611360_10.png','1','2017-09-05 11:36:00'),('198','52','_1504612539_2.png','1','2017-09-05 11:55:39'),('199','52','_1504612574_3.png','1','2017-09-05 11:56:14'),('200','52','_1504612590_4.png','1','2017-09-05 11:56:30'),('201','52','_1504612604_5.png','1','2017-09-05 11:56:44'),('202','52','_1504612633_7.png','1','2017-09-05 11:57:13'),('203','52','_1504613034_8.png','1','2017-09-05 12:03:54'),('204','53','_1504761718_2.png','1','2017-09-07 05:21:58'),('205','54','_1504762895_1.png','1','2017-09-07 05:41:35'),('206','55','_1504763631_3.png','1','2017-09-07 05:53:51'),('207','56','_1504764193_2.png','1','2017-09-07 06:03:13'),('208','58','_1504765128_2.png','1','2017-09-07 06:18:48'),('209','59','_1504765655_odahni_2.png','1','2017-09-07 06:27:35'),('210','59','_1504765780_odahani_3.png','1','2017-09-07 06:29:40'),('211','60','_1504766574_2.png','1','2017-09-07 06:42:54'),('212','60','_1504766987_3.png','1','2017-09-07 06:49:47'),('213','60','_1504767014_4.png','1','2017-09-07 06:50:14'),('214','60','_1504767063_6.png','1','2017-09-07 06:51:03'),('215','60','_1504767098_5.png','1','2017-09-07 06:51:38'),('216','61','_1504771300_2.png','1','2017-09-07 08:01:40'),('217','61','_1504771321_3.png','1','2017-09-07 08:02:01'),('218','61','_1504771340_4.png','1','2017-09-07 08:02:20'),('219','61','_1504771593_5.png','1','2017-09-07 08:06:33'),('220','61','_1504771608_6.png','1','2017-09-07 08:06:48'),('221','62','_1504772559_2.png','1','2017-09-07 08:22:39'),('222','62','_1504772575_3.png','1','2017-09-07 08:22:55'),('223','62','_1504772592_4.png','1','2017-09-07 08:23:12'),('224','62','_1504772612_5.png','1','2017-09-07 08:23:32'),('225','62','_1504772632_7.png','1','2017-09-07 08:23:52'),('226','48','_1504773031_1.png','1','2017-09-07 08:30:31'),('227','48','_1504773541_2.png','1','2017-09-07 08:39:01'),('228','48','_1504773558_3.png','1','2017-09-07 08:39:18'),('229','58','_1504774248_4.png','1','2017-09-07 08:50:48'),('230','58','_1504774265_5.png','1','2017-09-07 08:51:05'),('231','58','_1504774279_6.png','1','2017-09-07 08:51:19'),('232','58','_1504774293_7.png','1','2017-09-07 08:51:33'),('233','58','_1504774310_8.png','1','2017-09-07 08:51:50'),('234','56','_1504774820_3.png','1','2017-09-07 09:00:20'),('235','56','_1504774840_4.png','1','2017-09-07 09:00:40'),('236','56','_1504774856_5.png','1','2017-09-07 09:00:56'),('237','56','_1504774875_6.png','1','2017-09-07 09:01:15'),('241','55','_1504775656_4.png','1','2017-09-07 09:14:16'),('242','55','_1504775672_5.png','1','2017-09-07 09:14:32'),('243','55','_1504775691_6.png','1','2017-09-07 09:14:51'),('244','55','_1504775707_7.png','1','2017-09-07 09:15:07'),('245','54','_1504776130_8.png','1','2017-09-07 09:22:10'),('246','54','_1504776149_9.png','1','2017-09-07 09:22:29'),('247','54','_1504776210_10.png','1','2017-09-07 09:23:30'),('248','53','_1504776687_67.png','1','2017-09-07 09:31:27'),('249','53','_1504776707_68.png','1','2017-09-07 09:31:47'),('250','53','_1504776732_69.png','1','2017-09-07 09:32:12'),('251','50','_1504777563_3.png','1','2017-09-07 09:46:03'),('252','50','_1504777596_4.png','1','2017-09-07 09:46:36'),('253','50','_1504777616_5.png','1','2017-09-07 09:46:56'),('254','50','_1504777636_6.png','1','2017-09-07 09:47:16'),('255','50','_1504777654_7.png','1','2017-09-07 09:47:34'),('256','49','_1504778774_10.png','1','2017-09-07 10:06:14'),('257','49','_1504778789_11.png','1','2017-09-07 10:06:29'),('258','49','_1504778806_12.png','1','2017-09-07 10:06:46'),('259','49','_1504778822_13.png','1','2017-09-07 10:07:02'),('260','49','_1504778841_14.png','1','2017-09-07 10:07:21'),('261','47','_1504779257_16.png','1','2017-09-07 10:14:17'),('262','47','_1504779276_17.png','1','2017-09-07 10:14:36'),('263','47','_1504779367_18.png','1','2017-09-07 10:16:07'),('264','47','_1504779484_19.png','1','2017-09-07 10:18:04'),('265','46','_1504779978_24.png','1','2017-09-07 10:26:18'),('266','46','_1504779996_25.png','1','2017-09-07 10:26:36'),('267','46','_1504780022_22.png','1','2017-09-07 10:27:02'),('268','46','_1504780036_23.png','1','2017-09-07 10:27:16'),('276','44','_1504785865_108.png','1','2017-09-07 12:04:25'),('277','44','_1504785898_109.png','1','2017-09-07 12:04:58'),('278','44','_1504785928_110.png','1','2017-09-07 12:05:28'),('279','63','_1504849941_35.png','1','2017-09-08 05:52:21'),('280','63','_1504849958_36.png','1','2017-09-08 05:52:38'),('281','63','_1504849973_37.png','1','2017-09-08 05:52:53'),('282','63','_1504849987_38.png','1','2017-09-08 05:53:07'),('283','63','_1504850007_39.png','1','2017-09-08 05:53:27'),('284','63','_1504850718_41.png','1','2017-09-08 06:05:18'),('285','63','_1504850756_42.png','1','2017-09-08 06:05:56'),('286','63','_1504850776_43.png','1','2017-09-08 06:06:16'),('287','63','_1504850798_44.png','1','2017-09-08 06:06:38'),('288','63','_1504850817_45.png','1','2017-09-08 06:06:57'),('289','63','_1504850834_46.png','1','2017-09-08 06:07:14'),('290','63','_1504851453_47.png','1','2017-09-08 06:17:33'),('291','63','_1504851488_48.png','1','2017-09-08 06:18:08'),('292','63','_1504851508_49.png','1','2017-09-08 06:18:28'),('293','63','_1504851529_50.png','1','2017-09-08 06:18:49'),('294','63','_1504851547_51.png','1','2017-09-08 06:19:07'),('296','63','_1504851618_52.png','1','2017-09-08 06:20:18'),('297','64','_1504852946_53.png','1','2017-09-08 06:42:26'),('298','64','_1504852981_54.png','1','2017-09-08 06:43:01'),('299','64','_1504853000_55.png','1','2017-09-08 06:43:20'),('300','64','_1504853018_56.png','1','2017-09-08 06:43:38'),('301','64','_1504853038_57.png','1','2017-09-08 06:43:58'),('302','64','_1504853061_58.png','1','2017-09-08 06:44:21'),('303','64','_1504853779_60.png','1','2017-09-08 06:56:19'),('304','64','_1504853801_61.png','1','2017-09-08 06:56:41'),('305','64','_1504853821_62.png','1','2017-09-08 06:57:01'),('307','64','_1504853884_63.png','1','2017-09-08 06:58:04'),('308','64','_1504853904_64.png','1','2017-09-08 06:58:24'),('309','64','_1504853928_65.png','1','2017-09-08 06:58:48'),('310','64','_1504853962_66.png','1','2017-09-08 06:59:22'),('311','45','_1504855284_69.png','1','2017-09-08 07:21:24'),('312','45','_1504855321_70.png','1','2017-09-08 07:22:01'),('313','45','_1504855355_68.png','1','2017-09-08 07:22:35'),('314','45','_1504855380_71.png','1','2017-09-08 07:23:00');

/*Table structure for table `_jmaincateproduct` */

DROP TABLE IF EXISTS `_jmaincateproduct`;

CREATE TABLE `_jmaincateproduct` (
  `maincateid` int(11) NOT NULL AUTO_INCREMENT,
  `maincatename` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  PRIMARY KEY (`maincateid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `_jmaincateproduct` */

/*Table structure for table `_jmap` */

DROP TABLE IF EXISTS `_jmap`;

CREATE TABLE `_jmap` (
  `mapid` int(11) NOT NULL AUTO_INCREMENT,
  `mapcoding` text CHARACTER SET latin1,
  PRIMARY KEY (`mapid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `_jmap` */

/*Table structure for table `_jmenu` */

DROP TABLE IF EXISTS `_jmenu`;

CREATE TABLE `_jmenu` (
  `menuid` int(11) NOT NULL AUTO_INCREMENT,
  `menuname` varchar(100) CHARACTER SET latin1 DEFAULT NULL,
  `pageid` int(11) DEFAULT '0',
  `orderf` int(2) DEFAULT '0',
  `isheader` int(2) DEFAULT '1',
  `target` int(2) DEFAULT '0',
  `customurl` varchar(255) DEFAULT NULL,
  `linkedto` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`menuid`)
) ENGINE=InnoDB AUTO_INCREMENT=114 DEFAULT CHARSET=utf8;

/*Data for the table `_jmenu` */

insert  into `_jmenu`(`menuid`,`menuname`,`pageid`,`orderf`,`isheader`,`target`,`customurl`,`linkedto`) values ('110','About Us','135','1','1','0','','frmpage'),('113','Contact Us','138','4','1','0','','frmpage');

/*Table structure for table `_jmusics` */

DROP TABLE IF EXISTS `_jmusics`;

CREATE TABLE `_jmusics` (
  `musicid` int(11) NOT NULL AUTO_INCREMENT,
  `musictitle` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `musicdescription` text CHARACTER SET latin1,
  `musicfilepath` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `ispublished` int(11) NOT NULL,
  `albumid` int(11) DEFAULT NULL,
  `thumbfile` varchar(255) DEFAULT NULL,
  `postedon` datetime DEFAULT NULL,
  PRIMARY KEY (`musicid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `_jmusics` */

/*Table structure for table `_jpages` */

DROP TABLE IF EXISTS `_jpages`;

CREATE TABLE `_jpages` (
  `pageid` int(11) NOT NULL AUTO_INCREMENT,
  `pagetitle` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `pagedescription` text CHARACTER SET latin1,
  `pagetype` varchar(2) CHARACTER SET latin1 DEFAULT NULL,
  `filepath` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `postedon` datetime DEFAULT NULL,
  `lastmodified` datetime DEFAULT NULL,
  `ispublish` int(2) DEFAULT '0',
  `eventtime` date DEFAULT '0000-00-00',
  `ishomepage` int(2) DEFAULT '0',
  `noofvisit` int(11) DEFAULT '0',
  `keywords` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `pagefilename` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`pageid`)
) ENGINE=InnoDB AUTO_INCREMENT=143 DEFAULT CHARSET=utf8;

/*Data for the table `_jpages` */

insert  into `_jpages`(`pageid`,`pagetitle`,`pagedescription`,`pagetype`,`filepath`,`postedon`,`lastmodified`,`ispublish`,`eventtime`,`ishomepage`,`noofvisit`,`keywords`,`description`,`pagefilename`) values ('135','About Us','<p><span style=\"color: #333333; font-size: medium; font-family: arial, helvetica, sans-serif;\"><strong>Wedlink.in</strong>&nbsp;is  a dream project of Srimathi Shyamala Balasubramanian and now Srimathi  Padmini Ravichandran developed it and maintaining the project.&nbsp;In this,  the scope is to give better information to everyone &nbsp;to fulfil their or  their son / daughters marriage at an comfortable manner.&nbsp;For this, now a  days no one can get the better information for their dream without  paying money. Eventhough if they are paying money there is &nbsp;lot of  formalities and restrictions to get the particulars and to fix the  marriage.</span></p>\r\n<p><span style=\"color: #333333; font-size: medium; font-family: arial, helvetica, sans-serif;\">To  overcome from this we have decided to give all the particulars&nbsp;including  contact mail id, mobile numbers,&nbsp;of the registered profiles of boys and  girls to all who are viewing &nbsp;a particular profile of their choice in  our site.&nbsp;(Moreover a special option is also provided in the  registration panel whether to show the email id or mobile Number visible  in their respective pages. Aslo one more option is extended to become  an exclusive plus member, in which a seperate email id or mobile number  or both of our management will be published instead of thier own to  maintain secrecy).&nbsp;Here the viewer can view unlimited number of profiles  and to select a suitable profile of their choice in a couple of hours  and to contact them directly without any hindrance. In this the  registering person has to pay an amount according to their wish, and  permit us to publish all their detials to the entire persons searching  for thier needs. So a registered profile can be viewed by more than  thousand persons per hour, if possible, &nbsp;and huge chances are their to  get fix the marriage within a couple of week or less. &nbsp;</span></p>\r\n<p><span style=\"color: #333333; font-size: medium; font-family: arial, helvetica, sans-serif;\">The main  source &nbsp;we expect from our customers is their &nbsp;full hearted support  only, without their guidence and support we cannot keep even a single  step ahead. So we pray each and every one to offer their&nbsp;esteemed  suggestions and supports for the development of our sight by referring  our site amoung their friends, neighbours and relatives to enroll  themselves. We are very eagerly waiting to hear your valuable words for  the same because we know that \" We cannot spell&nbsp;<strong>S_CCESS</strong>&nbsp;without&nbsp;<strong>\'U\'. <br /></strong></span></p>','P','','2017-09-05 06:53:58','2019-11-04 07:38:01','1','0000-00-00','0','0','','','about-us'),('138','Contact Us','<p>23/A, Perumal Koil Street, Karaikal <br /> Karaikal - 609602, Puducherry, India</p>\r\n<p>&nbsp;</p>\r\n<p><strong>R.Venkataragavan</strong><br />+91-7558 177 277</p>','P','','2017-09-05 06:55:10','2019-11-05 14:23:51','1','0000-00-00','0','0','','','contact-us'),('139','Home Page','','P','','2017-09-07 06:53:13','2017-09-07 06:53:13','1','0000-00-00','0','0','','','home-page'),('141','Terms and Conditions','<p>Welcome to wedlink.in. In order to use the wedlink.in Site (\"Site\"),  you must Register as a member of the Site (\"Member\") and agree to be  bound by these Terms of Use (\"Agreement\"). If you wish to become a  Member and communicate with other Members and make use of the service  (\"Service\"), read these Terms of Use and follow the instructions in the  Registration process. This Agreement sets out the legally binding terms  for your membership. This Agreement may be modified by wedlink.in from  time to time effective upon notice to you as a Member. Whenever there is  a change in the Terms of Use, wedlink.in will intimate you of such  change. Your continued use of the Site pursuant to such change will  constitute deemed acceptance of such changes.<br /><br />1. Eligibility.<br /><br />You  must be at least 18 years of age or over to Register as a member of  wedlink.in or use this Site. Membership to the Site is void where  prohibited. Your use of this Site represents and warrants that you have  the right, authority, and capacity to enter into this Agreement and to  abide by all of the terms and conditions of this Agreement. This site is  not meant to encourage and/or promote illicit sexual relations or extra  marital affairs. If wedlink.in discovers or becomes aware that any  member is using this site to promote or engage or indulge in illicit  sexual relations or extra marital affairs his/her membership will be  terminated forthwith without any refund and without any liability to  wedlink.in. wedlink.in \'s discretion to terminate shall be final and  binding.</p>\r\n<p>2. Term.<br /><br />This Agreement will remain in full force and effect  while you use the Site and/or are a Member of wedlink.in. You may  terminate your membership at any time, for any reason by informing  wedlink.in in writing to terminate your Membership. In the event you  terminate your membership, you will not be entitled to a refund of any  unutilized subscription fees. wedlink.in may terminate your access to  the Site and/or your membership for any reason which shall be effective  upon sending notice of termination to you at the email address you  provide in your application for membership or such other email address  as you may later provide to wedlink.in . If wedlink.in terminates your  membership because of your breaching the Agreement, you will not be  entitled to any refund of any unused Subscription fees. Even after this  Agreement is terminated, certain provisions will remain in effect  including sections 4,5,7,9 -12, inclusive, of this Agreement.<br /><br />3. Non-Commercial Use by Members.<br /><br />The  wedlink.in site is for the personal use of individual members only, and  may not be used in connection with any commercial endeavors. This  includes providing links to other websites, whether deemed competitive  to wedlink.in or otherwise. Organizations, companies, and/or businesses  may not become Members of wedlink.in and should not use the wedlink.in  Service or Site for any purpose. Illegal and/or unauthorized uses of the  Site, including unauthorized framing of or linking to the Site will be  investigated, and appropriate legal action will be taken, including  without limitation, civil, criminal, and injunctive redress.<br /><br />4. Other Terms of Use by Members.</p>\r\n<ul>\r\n<li>You may not engage in advertising to, or solicitation of, other  Members to buy or sell any products or services through the Service. You  will not transmit any chain letters or junk email to other wedlink.in  Members. Although wedlink.in cannot monitor the conduct of its Members  on the&nbsp;wedlink.in Site, it is also a violation of this Agreement to use  any information obtained from the Service in order to harass, abuse, or  harm another person, or in order to contact, advertise to, solicit, or  sell to any Member without their prior explicit consent. In order to  protect wedlink.in and/or our Members from any abuse/misuse, wedlink.in  reserves the right to restrict the number of communications/profile  contacts &amp; responses/emails which a Member may send to other  Member(s) in any 24-hour period to a number which wedlink.in deems  appropriate in its sole discretion. You will not send any messages to  other Members that are obscene,&nbsp; licentious, and defamatory, promote  hatred and/or are racial or abusive in any manner. Transmission of any  such messages shall constitute a breach of this Agreement and wedlink.in  Shall be entitled to terminate your membership forthwith. wedlink.in  reserves the right to screen messages that you may send to other  Member(s) and also regulate the number of your chat sessions in its sole  discretion.</li>\r\n</ul>\r\n<ul>\r\n<li>You may not use any automated processes, including IRC Bots, EXE\'s,  CGI or any other programs/scripts to view content on or  communicate/contact/respond/interact with wedlink.in and/or its Members</li>\r\n</ul>\r\n<p>5. Content Posted on the Site.</p>\r\n<ul>\r\n<li>wedlink.in&nbsp;owns and retains all proprietary rights, including  without limitation, all intellectual property rights in the wedlink.in  Site and the wedlink.in Service. The Site contains the copyrighted  material, trademarks, and other proprietary information of wedlink.in,  and its licensors. Except for that information which is in the public  domain or for which you have been given express permission by  wedlink.in, you may not copy, modify, publish, transmit, distribute,  perform, display, or sell any such proprietary information. All lawful,  legal and non-objectionable messages (in the sole discretion of  wedlink.in), content and/or other information, content or material that  you post on the forum boards shall become the property of wedlink.in.  wedlink.in reserves the right to scrutinize all such information,  content and/or material posted on the forum boards and shall have the  exclusive right to either remove, edit and/or display such information,  material and/or content</li>\r\n</ul>\r\n<ul>\r\n<li>You understand and agree that wedlink.in may delete any content,  messages, photos or profiles (collectively, \"Content\") that in the sole  judgment of wedlink.in violates this Agreement or which might be  offensive, illegal, defamatory, obscene, libelous, or that might violate  the rights, harm, or threaten the safety of other wedlink.in Members.</li>\r\n</ul>\r\n<ul>\r\n<li>You are solely responsible for the Content that you publish or  display (hereinafter, \"post\") on the Site through the wedlink.in  Service, or transmit to other wedlink.in Members. wedlink.in reserves  the right to verify the authenticity of Content posted on the Site. In  exercising this right, wedlink.in may ask you to provide any documentary  or other form of evidence supporting the Content you post on the Site.  If you fail to produce such evidence, or if such evidence does not in  the reasonable opinion of wedlink.in establish or justify the claim,  wedlink.in may, in its sole discretion, terminate your Membership  without a refund of your subscription fees</li>\r\n</ul>\r\n<ul>\r\n<li>By posting Content to any public area of wedlink.in, you  automatically grant, and you represent and warrant that you have the  right to grant, to wedlink.in, and other wedlink.in Members, an  irrevocable, perpetual, non-exclusive, fully-paid, worldwide license to  use, copy, perform, display, and distribute such information and content  and to prepare derivative works of, or incorporate into other works,  such information and content, and to grant and authorize sublicenses of  the foregoing.</li>\r\n</ul>\r\n<ul>\r\n<li>The following is a partial list of the kind of Content that is  illegal or prohibited on the Site. wedlink.in will investigate and take  appropriate legal action in its sole discretion against anyone who  violates this provision, including without limitation, removing the  offending communication from the Service and the Site and terminating  the Membership of such violators without a refund. It includes (but is  not limited to) Content that:</li>\r\n</ul>\r\n<ol>\r\n<li>Newly created profile will be checked for correctness and will be  immediately activated after quality declaration verify by wedlink.in.</li>\r\n<li>wedlink.in reserves the rights to discontinue, deactivate, or  terminate profile if the profile in terms of bad manners and the profile  contents are not acceptable if it contains violent language or wrong  material.</li>\r\n<li>You are only liable for your connections with other members through wedlink.in.</li>\r\n<li>Contact information of member&rsquo;s profile will display only to paid  members. Free membership is for limited time. wedlink.in reserves right  to discontinue free membership at any time.</li>\r\n<li>Members agree that they are legally eligible to get married as far  as the age is concerned. wedlink.in will not be responsible for misuse  of any facility/service it provides, which is in violation to the local  government laws.</li>\r\n<li>Every member submitting his/her matrimonial profile is required to  give all the facts essential for establishing a marital relation.  Concealing facts relevant to marriage could result in loss or damage to  any individual and for which, kalyanavasantham.incannot be held  responsible in any which way.</li>\r\n<li>wedlink.in in no way guarantees the genuineness of the information provided by its members.</li>\r\n<li>Members will not have any claim against kalyanavasantham.infor any  time delay in posting their information into wedlink.in website due to  any technical reasons.</li>\r\n<li>wedlink.in is not liable for damages caused due to incorrectness of  the information provided by its members regarding the religion, caste or  creed or any other personal information. If the members&rsquo; profile is  deemed to be unfit, wedlink.in has the right to delete, alter or refuse  the same at any point of time without any notice.</li>\r\n<li>wedlink.in cannot be held responsible for any loss or damage  resulting from discontinuation of the service. wedlink.in will also not  be responsible for any damage caused due to others accessing members  profile.</li>\r\n<li>wedlink.in cannot guarantee that you as an applicant will receive  responses and hence cannot be held responsible for no replies. In this  case we cannot give any refunds or credits.</li>\r\n<li>wedlink.in is not legally responsible for any delay in operation due to technical or other reasons.</li>\r\n<li>Harasses or advocates harassment of another person;</li>\r\n<li>Involves the transmission of \"junk mail\", \"chain letters,\" or unsolicited mass mailing or \"spamming\";</li>\r\n<li>Promotes information that the person posting it is aware that it is  false, misleading or promotes illegal activities or conduct that is  abusive, threatening, obscene, defamatory or libelous;</li>\r\n<li>Promotes an illegal or unauthorized copy of another person\'s  copyrighted work, such as providing pirated computer programs or links  to them, providing information to circumvent manufacture-installed  copy-protect devices, or providing pirated music or links to pirated  music files;</li>\r\n<li>Contains restricted or password only access pages, or hidden pages  or images (those not linked to or from another accessible page) ;</li>\r\n<li>Displays pornographic or sexually explicit material of any kind;</li>\r\n<li>Provides material that exploits people under the age of 18 years in a  sexual or violent manner, or solicits personal information from anyone  under the age of 18 years;</li>\r\n<li>Provides instructional information about illegal activities such as  making or buying illegal weapons, violating someone\'s privacy, or  providing or creating computer viruses;</li>\r\n<li>Solicits passwords or personal identifying information for commercial or unlawful purposes from other users / Members; and</li>\r\n<li>Engages in commercial activities and/or sales without the prior  written consent wedlink.in Such as contests, sweepstakes, barter,  advertising, and pyramid schemes.</li>\r\n<li>Encourages, invites or solicits extra marital affairs.</li>\r\n</ol> \r\n<ul>\r\n<li>You must use the wedlink.in Service in a manner consistent with any  and all applicable local, state, and federal laws and regulations.</li>\r\n</ul>\r\n<ul>\r\n<li>You are not permitted to create multiple profiles. If wedlink.in is  aware that you have created multiple profiles, your membership will be  liable to be terminated forthwith without any refund of subscription  fees.</li>\r\n</ul>\r\n<ul>\r\n<li>If at any time wedlink.in is of the view in its sole discretion that  your profile contains any information or material or content which is  objectionable, unlawful or illegal, Fropper has the right in its sole  discretion to either forthwith terminate your membership without refund  of your subscription fees or delete such objectionable, illegal or  unlawful information, material or content from your profile and allow  you to continue as a Member.</li>\r\n</ul>\r\n<p>6. Copyright Policy.<br /><br />You may not post, distribute, or  reproduce in any way any copyrighted material, trademarks, or other  proprietary information without obtaining the prior written consent of  the owner of such proprietary rights. Without limiting the foregoing, if  you believe that your work has been copied and posted on the Site  through the wedlink.in Service in a way that constitutes copyright  infringement, please provide our Copyright Agent with the following  information: an electronic or physical signature of the person  authorized to act on behalf of the owner of the copyright interest; a  description of the copyrighted work that you claim has been infringed; a  description of where the material that you claim is infringing is  located on the Site; your address, telephone number, and email address; a  written statement by you that you have a good faith belief that the  disputed use is not authorized by the copyright owner, its agent, or the  law; and where applicable a copy of the registration certificate  proving registration of copyright or any other applicable intellectual  property right; a statement by you, made under penalty of perjury, that  the above information in your Notice is accurate and that you are the  copyright owner or authorized to act on the copyright owner\'s behalf.  wedlink.in \'s Copyright Agent for Notice of claims of copyright  infringement can be reached by writing to the Mumbai address located  under the Help/Contact section on the site.<br /><br />7. Member Disputes.<br /><br />You  are solely responsible for your interactions with other wedlink.in  Members. wedlink.in reserves the right, but has no obligation, to  monitor disputes between you and other Members.<br /><br />8. Privacy.<br /><br />Use of the wedlink.in Site and/or the wedlink.in Service is governed by the wedlink.in Privacy Policy.</p>\r\n<p>9. Disclaimers.<br /><br />wedlink.in is not responsible for any  incorrect or inaccurate Content posted on the Site or in connection with  the wedlink.in Service, whether caused by users visiting the Site,  Members or by any of the equipment or programming associated with or  utilized in the Service, nor for the conduct of any user and/or Member  of the wedlink.in Service whether online or offline. wedlink.in assumes  no responsibility for any error, omission, interruption, deletion,  defect, delay in operation or transmission, communications line failure,  theft or destruction or unauthorized access to, or alteration of, user  and/or Member communications. wedlink.in is not responsible for any  problems or technical malfunction of any telephone network or lines,  computer on-line-systems, servers or providers, computer equipment,  software, failure of email or players on account of technical problems  or traffic congestion on the Internet or at any website or combination  thereof, including injury or damage to users and/or Members or to any  other person\'s computer related to or resulting from participating or  downloading materials in connection with the wedlink.in Site and/or in  connection with the wedlink.in Service. Under no circumstances will  wedlink.in be responsible for any loss or damage to any person resulting  from anyone\'s use of the Site or the Service and/or any Content posted  on the wedlink.in Site or transmitted to wedlink.in Members. The  exchange of profile(s) through or by wedlink.in Should not in any way be  construed as any offer and/or recommendation from/by wedlink.in .  wedlink.in Shall not be responsible for any loss or damage to any  individual arising out of, or subsequent to, relations established  pursuant to the use of wedlink.in . The Site and the Service are  provided \"AS-IS AVALIABLE BASIS\" and wedlink.in expressly disclaims any  warranty of fitness for a particular purpose or non-infringement.  wedlink.in cannot guarantee and does not promise any specific results  from use of the Site and/or the wedlink.in Service.<br /><br />10. Limitation on Liability.<br /><br />Except  in jurisdictions where such provisions are restricted, in no event will  wedlink.in be liable to you or any third person for any indirect,  consequential, exemplary, incidental, special or punitive damages,  including also lost profits arising from your use of the Site or the  wedlink.in Service, even if wedlink.in has been advised of the  possibility of such damages. Notwithstanding anything to the contrary  contained herein, wedlink.in , liability to you for any cause  whatsoever, and regardless of the form of the action, will at all times  be limited to the amount paid, if any, by you to wedlink.in , for the  Service during the term of membership.<br /><br />11. Disputes.<br /><br />If  there is any dispute about or involving the Site and/or the Service, by  using the Site, you agree that the dispute will be governed by the laws  of India. You agree to the exclusive jurisdiction to the courts of  Karaikal, India.</p>\r\n<p>12. Indemnity.<br /><br />You agree to indemnify and hold wedlink.in ,  its subsidiaries, directors, affiliates, officers, agents, and other  partners and employees, harmless from any loss, liability, claim, or  demand, including reasonable attorney\'s fees, made by any third party  due to or arising out of your use of the Service in violation of this  Agreement and/or arising from a breach of these Terms of Use and/or any  breach of your representations and warranties set forth above.<br /><br />Other.</p>\r\n<ul>\r\n<li>By becoming a Member of the Site / wedlink.in Service, you agree to receive certain specific emails from wedlink.in .</li>\r\n</ul>\r\n<ul>\r\n<li>This Agreement, accepted upon use of the Site and further affirmed  by becoming a Member of the wedlink.in Service, contains the entire  agreement between you and wedlink.in regarding the use of the Site  and/or the Service. If any provision of this Agreement is held invalid,  the remainder of this Agreement shall continue in full force and effect.</li>\r\n</ul>\r\n<ul>\r\n<li>You are under an obligation to report any misuse or abuse of the  Site. If you notice any abuse or misuse of the Site or any thing which  is in violation of this Agreement, you shall forthwith report such  violation to wedlink.in by writing to Customer Care. On receipt of such  complaint, wedlink.in may investigate such complaint and if necessary  may terminate the membership of the Member responsible for such  violation abuse or misuse without any refund of subscription fee. Any  false complaint made by a Member shall make such Member liable for  termination of his / her membership without any refund of the  subscription fee.</li>\r\n</ul>\r\n<p>Please contact us with any questions regarding this Agreement.</p>','P','','2019-10-29 11:59:38','2019-10-29 11:59:38','1','0000-00-00','0','0','','','terms-of-conditions'),('142','Privacy Policy','<div class=\"col-md-12 col-sm-12  col-xs-12\">\r\n<h2 class=\"pagetitel\"><span style=\"color: #ff0000;\">wedlink.in&nbsp;<span style=\"color: #000000;\"><strong>is an online matrimonial service designed to provide an easy way for its members to meet each other on the Web.</strong></span></span></h2>\r\n</div>\r\n<div class=\"col-md-12 col-sm-12  col-xs-12\">\r\n<p class=\"text-med\">We are strongly committed to your right to privacy,  we have drawn have a privacy statement in place with regard to the  information we collect from you.</p>\r\n<p class=\"text-med\">We gather information from members and guests who  apply for the various services our site offers. It includes, but may not  be limited to, email address, first name, last name, a user-specified  password, e-mail Id, mailing address, zip code and telephone number or  fax number.</p>\r\n<p class=\"text-med\">We collect information from our clients primarily to  ensure that we are able to fulfill your requirements and to deliver  personalized experience.</p>\r\n<p class=\"text-med\">The information collected from our users is shared  only with members of DadhichMatrimony or members of our partners. Any  information you give us is held with the utmost care and security. We  are also bound to cooperate fully should a situation arise where we are  required by law or legal process to provide information about a  customer. No personal member information is exchanged with the Affiliate  Partner.</p>\r\n<p class=\"text-med\">We use email extensively to help you find your match on<span style=\"color: #ff0000;\"> wedlink.in</span>. Our main email products and services include:</p>\r\n<ul>\r\n<li>Member responses to your profile;</li>\r\n<li>Partner matches for you; and</li>\r\n<li>Newsletters updating you of the latest features on our site.</li>\r\n</ul>\r\n<p class=\"text-med\">Occasionally, we may also send you:</p>\r\n<ul>\r\n<li>Announcements of special events which <span style=\"color: #ff0000;\">wedlink.in</span> is associated with; or</li>\r\n<li>Special offers from partner sites or group sites, which we believe are useful for you.</li>\r\n</ul>\r\n<p class=\"text-med\">You can stop the delivery of promotional e-mail from a <span style=\"color: #ff0000;\">wedlink.in</span> site or service by following the instructions in the e-mail you receive.</p>\r\n<p class=\"text-med\">We may collect information about your interaction with <span style=\"color: #ff0000;\">wedlink.in</span> sites and services. For example, we may use Web site analytics tools on  our site to retrieve information from your browser, including the site  you came from, the search engine(s) and the keywords you used to find  our site, the pages you view within our site, your browser add-ons, and  your browser\'s width and height. Additionally, we collect certain  standard information that your browser sends to every website you visit,  such as your IP address, browser type and language, access times and  referring Web site addresses.</p>\r\n<p class=\"text-med\">All visitors to our site may browse the site, search  the ads and view any articles or features our site has to offer without  entering any personal information or paying money.</p>\r\n<p class=\"text-med\"><strong>Legal Disclaimer&nbsp;</strong><br />Though the  Website makes every effort to preserve user privacy, the Website may  disclose information you provide if required to do so by law,  enforcement agency or court order or if the Website has a good faith  belief that disclosure is necessary to (1) comply with the law or with  legal process served on us; (2) protect and defend its rights or  property; (3) act in an emergency to protect someone\'s safety or (4) as  expressly provided herein.</p>\r\n<p class=\"text-med\">The Website also may disclose this information to  its subsidiary and parent companies and businesses, and other affiliated  legal entities and businesses with who the Website is under common  corporate control. However, all of these parent, subsidiary and  affiliated legal entities and businesses that receive your personal  information from the Website will comply with the terms of this privacy  policy with respect to their use and disclosure of such personal  information.</p>\r\n<p class=\"text-med\"><strong>Age Restrictions<br /></strong>The Website  will not create matches for anyone not within the legally marriageable  age. Any information received by the Website from a person the Website  believes to be a minor will be purged from its database.</p>\r\n<p class=\"text-med\"><strong>Security</strong><br />The Website has  extensive security measures in place to protect the loss, misuse and  alteration of the information stored in its database. These measures  include the use of Secure Server technology during credit card  transactions and administrative access to site data, as well as other  proprietary security measures which are applied to all repositories and  transfers of user information. The Website shall exercise reasonable  care in providing secure transmission of information between your  computer and the Website\'s servers, the Website cannot ensure or warrant  the security of any information transmitted to the Website over the  Internet and the shall accept no liability for any unintentional  disclosure.</p>\r\n<p class=\"text-med\"><strong>Please take the following steps to further protect your privacy:</strong></p>\r\n<ol>\r\n<li>Always close your browser and log out from the Website once you have  finished surfing the net to prevent other people gaining access to your  information and correspondence.</li>\r\n<li>The Website has no control over other websites that it may be link  to, and the Website takes no responsibility for the conduct of these  companies. Always read the Terms and Conditions when using other  websites.</li>\r\n<li>Keep your passwords and your member details secret. If unauthorized  access of your account occurs please inform us immediately. Frequently  change your password.</li>\r\n<li>Posting of personal contact information is prohibited on the  Website. The Website takes no responsibility for any personal contact  information disclosed to other members in its network. Personal  information includes information such as full names, telephone numbers  and home addresses. Beware - if you voluntarily disclose personal  information it may be collected and used by others.</li>\r\n</ol>\r\n<p class=\"text-med\">Advertisements, promotions and offers from  third-party advertisers may be provided to you while you visit the  Website. Similarly when paying the Website subscription fees,  advertisements, promotions and offers from third-party advertisers may  be provided to you. If you choose to accept any such offers, the Website  may provide your information, including billing information, to the  advertiser. Your information will not be transferred until you actually  accept the offer. You may opt-out of the offer at any time up until this  point. Please refer to the third-party advertisers own privacy policy  (provided on the offer pages) if you have questions regarding how your  information is used. Please be aware that these offers may be presented  on pages framed by the Website. The Website does this to provide a  seamless experience. Although these offer pages have the look and feel  of Website, you will be submitting your information directly to the  third-party advertiser.</p>\r\n<p class=\"text-med\">BY USING THE WEBSITE, YOU ARE ACCEPTING THE PRACTICES SET OUT IN THIS PRIVACY POLICY AND TERMS AND CONDITIONS OF SERVICE.</p>\r\n<p class=\"text-med\">Notice: We may change this Privacy Policy from time  to time based on your comments or as a result of a change of policy in  our company. If you have any questions regarding our Privacy Statement,  please write in to wedlink@gmail.com</p>\r\n</div>','P','','2019-10-29 12:00:03','2019-10-29 12:00:03','1','0000-00-00','0','0','','','privacy-policy');

/*Table structure for table `_jphotogallery` */

DROP TABLE IF EXISTS `_jphotogallery`;

CREATE TABLE `_jphotogallery` (
  `groupid` int(11) NOT NULL AUTO_INCREMENT,
  `groupname` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `groupdescription` text CHARACTER SET latin1,
  `ispublished` int(11) NOT NULL,
  `filepath` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `postedon` datetime DEFAULT NULL,
  PRIMARY KEY (`groupid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `_jphotogallery` */

/*Table structure for table `_jphotos` */

DROP TABLE IF EXISTS `_jphotos`;

CREATE TABLE `_jphotos` (
  `photoid` int(11) NOT NULL AUTO_INCREMENT,
  `phototitle` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `photodescription` text CHARACTER SET latin1,
  `photofilepath` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `ispublished` int(2) NOT NULL,
  `groupid` int(3) NOT NULL,
  `postedon` datetime DEFAULT NULL,
  PRIMARY KEY (`photoid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `_jphotos` */

/*Table structure for table `_jproduct` */

DROP TABLE IF EXISTS `_jproduct`;

CREATE TABLE `_jproduct` (
  `productid` int(11) NOT NULL AUTO_INCREMENT,
  `maincateid` int(11) NOT NULL DEFAULT '0',
  `subcateid` int(11) NOT NULL DEFAULT '0',
  `itemname` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `itemdesc` text CHARACTER SET latin1,
  `itemprice` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `ispublished` int(11) DEFAULT NULL,
  `postedon` datetime DEFAULT NULL,
  PRIMARY KEY (`productid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `_jproduct` */

/*Table structure for table `_jreading` */

DROP TABLE IF EXISTS `_jreading`;

CREATE TABLE `_jreading` (
  `readingid` int(11) NOT NULL AUTO_INCREMENT,
  `date` date DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `details` text,
  `title_t` text,
  `details_t` text,
  PRIMARY KEY (`readingid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `_jreading` */

/*Table structure for table `_jsitemap` */

DROP TABLE IF EXISTS `_jsitemap`;

CREATE TABLE `_jsitemap` (
  `sitemapid` int(11) NOT NULL AUTO_INCREMENT,
  `postedon` datetime DEFAULT NULL,
  `content` text,
  PRIMARY KEY (`sitemapid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `_jsitemap` */

/*Table structure for table `_jsitesettings` */

DROP TABLE IF EXISTS `_jsitesettings`;

CREATE TABLE `_jsitesettings` (
  `settingsid` int(11) NOT NULL AUTO_INCREMENT,
  `param` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `paramvalue` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  PRIMARY KEY (`settingsid`)
) ENGINE=InnoDB AUTO_INCREMENT=137 DEFAULT CHARSET=utf8;

/*Data for the table `_jsitesettings` */

insert  into `_jsitesettings`(`settingsid`,`param`,`paramvalue`) values ('1','sitetitle','JMatrimony'),('2','sitename','Happymarriages'),('3','backgroundimage',''),('4','backgroundcolor','FFF'),('5','favoriteicon',''),('6','isenablevideo','0'),('7','isenablephoto','0'),('8','isenablemusic','0'),('9','isenabledownloads','0'),('10','isenablefaq','0'),('11','isenablesuccessstory','0'),('12','isenabletestimonial','0'),('13','isenablesubscriber','0'),('14','isenablenews','0'),('15','isenableevents','0'),('16','facebookurl',''),('17','twitterurl',''),('18','youtubeurl',''),('19','googleplusurl',''),('20','sharepage','0'),('21','googletranslator','1'),('22','metatag',''),('23','metadescription',''),('24','menubackgroundimage',''),('25','logo','_1572336889_logo.jpg'),('26','isenableproduct','0'),('27','isenablecontact','1'),('28','isenablemap','0'),('29','mapcoding',''),('30','noimg',''),('31','newsperpage','5'),('32','eventsperpage','5'),('33','storyperpage','20'),('34','testmperpage','1'),('35','menufontcolor','FFFCF5'),('36','menufont','2'),('37','menufontsize','15'),('38','footerbgimage',''),('39','footerbgcolor','FFFFFF'),('40','footerfontcolor','FFFFFF'),('41','footerfont','2'),('42','footerfontsize','18'),('43','menubgcolor','ff0000'),('44','layout','1'),('45','menu_hover_font_color','ffffff'),('46','footerhover','FFFFFF'),('47','linkedpage','135'),('48','emailto',''),('49','sitebgposition','repeat'),('50','sharesize','small'),('51','siteurl','http://www.matrimony.dev.j2jsoftwaresolutions.com'),('52','seometadesc',''),('53','seometakey',''),('54','seometacontent',''),('55','footerbanner','FFFFFF'),('56','displaycontactusonhome','1'),('57','displaycontactus',''),('58','headerbgimg',''),('59','headerbgcolor','FFFFFF'),('60','sliderhideicon','none'),('61','headernoimagenocolor','1'),('62','headerheight','50'),('63','showheader','1'),('64','menu_font_bold','0'),('65','menu_font_italic','0'),('66','menu_font_underline','0'),('67','menu_hover_font_bold','0'),('68','menu_hover_font_italic','0'),('69','menu_hover_font_underline','0'),('70','menu_hover_backgroundcolor','8233BD'),('71','menu_border_left_size','7'),('72','menu_border_right_size','0'),('73','menu_border_top_size','0'),('74','menu_border_bottom_size','0'),('75','menu_border_left_style','solid'),('76','menu_border_right_style','solid'),('77','menu_border_top_style','solid'),('78','menu_border_bottom_style','solid'),('79','menu_border_left_color','ff0000'),('80','menu_border_right_color','000000'),('81','menu_border_top_color','000000'),('82','menu_border_bottom_color','000000'),('83','menu_radius_left_top','0'),('84','menu_radius_right_top','0'),('85','menu_radius_left_bottom','0'),('86','menu_radius_right_bottom','0'),('87','menu_radius_left_top_scale','px'),('88','menu_radius_right_top_scale','px'),('89','menu_radius_left_bottom_scale','px'),('90','menu_radius_right_bottom_scale','px'),('91','menu_height','35'),('92','need_menu_hover_backgroundcolor','1'),('93','menu_text_padding_left','20'),('94','menu_text_padding_right','20'),('95','menu_text_padding_top','9'),('96','menu_text_padding_bottom','9'),('97','menu_background_image_color_noneed','0'),('98','menu_seperator_need','1'),('99','menu_seperator_size','2'),('100','menu_seperator_color','FFFFFF'),('101','slider_border_top_size','2'),('102','slider_border_bottom_size','0'),('103','slider_border_left_size','0'),('104','slider_border_right_size','0'),('105','slider_border_top_color','FFFFFF'),('106','slider_border_bottom_color','C1C2BC'),('107','slider_border_left_color','484094'),('108','slider_border_right_color','FA2121'),('109','slider_top_space','0'),('110','slider_bottom_space','0'),('111','menu_text_transform','none'),('112','menu_text_hover_transform','none'),('113','slider_border_radius_left_top','0'),('114','slider_border_radius_right_top','0'),('115','slider_border_radius_left_bottom','0'),('116','slider_border_radius_right_bottom','0'),('117','showslider','1'),('118','slider_height','380'),('119','slider_top_space_need_color','0'),('120','slider_top_space_color','F1F1F1'),('121','slider_bottom_space_need_color','0'),('122','slider_bottom_space_color','FFFFFF'),('123','video_page_video_height','320'),('124','video_page_video_width','369'),('125','video_page_video_layout',NULL),('126','video_page_clicktoplay','1'),('127','video_page_details_open_neworself','0'),('128','video_page_content',NULL),('129','header_logo_padding_right','0'),('130','header_logo_padding_left','0'),('131','header_logo_padding_top','10'),('132','header_logo_padding_bottom','10'),('133','header_background_repeat ','no-repeat'),('134','currencysymbol','Rs.'),('135','copyright_text','JMatrimony'),('136','copyright_url','JMatrimony');

/*Table structure for table `_jslider` */

DROP TABLE IF EXISTS `_jslider`;

CREATE TABLE `_jslider` (
  `sliderid` int(11) NOT NULL AUTO_INCREMENT,
  `slidertitle` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `sliderdescription` text CHARACTER SET latin1,
  `filepath` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `ispublished` int(11) NOT NULL,
  `postedon` datetime DEFAULT NULL,
  `sliderorder` int(2) DEFAULT NULL,
  PRIMARY KEY (`sliderid`)
) ENGINE=InnoDB AUTO_INCREMENT=75 DEFAULT CHARSET=utf8;

/*Data for the table `_jslider` */

insert  into `_jslider`(`sliderid`,`slidertitle`,`sliderdescription`,`filepath`,`ispublished`,`postedon`,`sliderorder`) values ('73','Banner1','','_1572332604_banner1.jpg','1','2019-10-29 07:03:24','1'),('74','Banner 2','','_1572333205_banner2.jpg','1','2019-10-29 07:13:25','2');

/*Table structure for table `_jsubcategoryproduct` */

DROP TABLE IF EXISTS `_jsubcategoryproduct`;

CREATE TABLE `_jsubcategoryproduct` (
  `subcateid` int(11) NOT NULL AUTO_INCREMENT,
  `maincateid` int(11) DEFAULT '0',
  `subcatename` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  PRIMARY KEY (`subcateid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `_jsubcategoryproduct` */

/*Table structure for table `_jsubscriber` */

DROP TABLE IF EXISTS `_jsubscriber`;

CREATE TABLE `_jsubscriber` (
  `subscriberid` int(11) NOT NULL AUTO_INCREMENT,
  `subscribername` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `subscriberemail` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `subscribermobile` varchar(11) CHARACTER SET latin1 NOT NULL,
  `others` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  PRIMARY KEY (`subscriberid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `_jsubscriber` */

/*Table structure for table `_jsuccessstory` */

DROP TABLE IF EXISTS `_jsuccessstory`;

CREATE TABLE `_jsuccessstory` (
  `storyid` int(11) NOT NULL AUTO_INCREMENT,
  `storytitle` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `storydescription` text CHARACTER SET latin1,
  `storyname` varchar(100) CHARACTER SET latin1 DEFAULT NULL,
  `email` varchar(100) CHARACTER SET latin1 DEFAULT NULL,
  `mobileno` varchar(11) CHARACTER SET latin1 NOT NULL,
  `storytype` varchar(100) CHARACTER SET latin1 DEFAULT NULL,
  `filepath` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `postedon` datetime DEFAULT NULL,
  `lastmodified` datetime DEFAULT NULL,
  `ispublish` int(11) NOT NULL,
  PRIMARY KEY (`storyid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `_jsuccessstory` */

/*Table structure for table `_jusertable` */

DROP TABLE IF EXISTS `_jusertable`;

CREATE TABLE `_jusertable` (
  `userid` int(11) NOT NULL AUTO_INCREMENT,
  `personname` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `uname` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `pwd` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `createdon` datetime DEFAULT NULL,
  `isactive` int(11) DEFAULT NULL,
  `isadmin` int(11) DEFAULT '0',
  PRIMARY KEY (`userid`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `_jusertable` */

insert  into `_jusertable`(`userid`,`personname`,`uname`,`pwd`,`createdon`,`isactive`,`isadmin`) values ('1','admin','admin','password','2017-09-04 14:02:19','1','1');

/*Table structure for table `_jvideo` */

DROP TABLE IF EXISTS `_jvideo`;

CREATE TABLE `_jvideo` (
  `videoid` int(11) NOT NULL AUTO_INCREMENT,
  `videotitle` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `videodescription` text CHARACTER SET latin1,
  `videourl` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `postedon` datetime DEFAULT NULL,
  `lastmodified` datetime DEFAULT NULL,
  PRIMARY KEY (`videoid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `_jvideo` */

/*Table structure for table `_nicus_enquiry` */

DROP TABLE IF EXISTS `_nicus_enquiry`;

CREATE TABLE `_nicus_enquiry` (
  `enquiryid` int(11) NOT NULL AUTO_INCREMENT,
  `orgname` varchar(255) DEFAULT NULL,
  `custname` varchar(255) DEFAULT NULL,
  `emailid` varchar(255) DEFAULT NULL,
  `mobilenumber` varchar(255) DEFAULT NULL,
  `landline` varchar(255) DEFAULT NULL,
  `shortdescription` varchar(255) DEFAULT NULL,
  `detaildescription` text,
  `enquiredon` datetime DEFAULT NULL,
  `itemid` int(11) DEFAULT NULL,
  `purpose` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`enquiryid`)
) ENGINE=MyISAM AUTO_INCREMENT=27 DEFAULT CHARSET=latin1;

/*Data for the table `_nicus_enquiry` */

insert  into `_nicus_enquiry`(`enquiryid`,`orgname`,`custname`,`emailid`,`mobilenumber`,`landline`,`shortdescription`,`detaildescription`,`enquiredon`,`itemid`,`purpose`) values ('22','subiksha','brindha','brindha@gmail.com','7852369841','0458925366','nice product good quality','collection very nice','2018-03-08 05:57:55','0','Individual Purpose'),('23','sureka','nithya','nithya@gmail.com','8521463978','04596897526','good','nice','2018-03-08 06:02:40','0','Individual Purpose'),('24','SRA','MARY','mary@gmail.com','8541236978','04655963145','good','very nice','2018-03-08 06:14:10','0','Individual Purpose'),('25','ASS','LATHA','latha@gmail.com','8532147596','04655897412','good','nice\r\n','2018-03-08 07:17:04','0','Individual Purpose'),('26','SRM','LEKA','leka@gmail.com','8574963256','04658963147','good','nice','2018-03-08 08:58:59','0','Business Purpose');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
