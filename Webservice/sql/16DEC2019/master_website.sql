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

insert  into `_japp`(`appid`,`hostname`,`datadir`,`dbname`,`dateofcreation`,`licenceto`,`hosturl`) values ('1','allsaliyarmatrimony.com','data','allsaliy_website','2019-12-16 00:00:00','allsaliyarmatrimony.com','allsaliyarmatrimony.com');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `_jfaq` */

/*Table structure for table `_jfeature` */

DROP TABLE IF EXISTS `_jfeature`;

CREATE TABLE `_jfeature` (
  `featureid` int(11) NOT NULL AUTO_INCREMENT,
  `featurename` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`featureid`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

/*Data for the table `_jfeature` */

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `_jitemcategory` */

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `_jlisting` */

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `_jlistingimg` */

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
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

/*Data for the table `_jmenu` */

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
  `eventtime` datetime DEFAULT NULL,
  `ishomepage` int(2) DEFAULT '0',
  `noofvisit` int(11) DEFAULT '0',
  `keywords` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `pagefilename` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`pageid`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

/*Data for the table `_jpages` */

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
) ENGINE=InnoDB AUTO_INCREMENT=135 DEFAULT CHARSET=utf8;

/*Data for the table `_jsitesettings` */

insert  into `_jsitesettings`(`settingsid`,`param`,`paramvalue`) values ('1','sitetitle','allsaliyarmatrimony'),('2','sitename','allsaliyarmatrimony'),('3','backgroundimage',''),('4','backgroundcolor','FFFFFF'),('5','favoriteicon',''),('6','isenablevideo','0'),('7','isenablephoto','0'),('8','isenablemusic','0'),('9','isenabledownloads','0'),('10','isenablefaq','0'),('11','isenablesuccessstory','0'),('12','isenabletestimonial','0'),('13','isenablesubscriber','0'),('14','isenablenews','0'),('15','isenableevents','0'),('16','facebookurl',''),('17','twitterurl',''),('18','youtubeurl',''),('19','googleplusurl',''),('20','sharepage','0'),('21','googletranslator','1'),('22','metatag',''),('23','metadescription',''),('24','menubackgroundimage',''),('25','logo','_1576388051__1572336889_logo.jpg'),('26','isenableproduct','0'),('27','isenablecontact','1'),('28','isenablemap','0'),('29','mapcoding',''),('30','noimg',''),('31','newsperpage','5'),('32','eventsperpage','5'),('33','storyperpage','20'),('34','testmperpage','1'),('35','menufontcolor','FFFCF5'),('36','menufont','2'),('37','menufontsize','15'),('38','footerbgimage',''),('39','footerbgcolor','FFFFFF'),('40','footerfontcolor','FFFFFF'),('41','footerfont','2'),('42','footerfontsize','18'),('43','menubgcolor','026FB2'),('44','layout','1'),('45','menu_hover_font_color','FFFFFF'),('46','footerhover','FFFFFF'),('47','linkedpage','4'),('48','emailto',''),('49','sitebgposition','repeat'),('50','sharesize','small'),('51','siteurl','http://www.matrimony.dev.j2jsoftwaresolutions.com'),('52','seometadesc',''),('53','seometakey',''),('54','seometacontent',''),('55','footerbanner','FFFFFF'),('56','displaycontactusonhome','1'),('57','displaycontactus',''),('58','headerbgimg',''),('59','headerbgcolor','FFFFFF'),('60','sliderhideicon','none'),('61','headernoimagenocolor','1'),('62','headerheight','100'),('63','showheader','1'),('64','menu_font_bold','0'),('65','menu_font_italic','0'),('66','menu_font_underline','0'),('67','menu_hover_font_bold','0'),('68','menu_hover_font_italic','0'),('69','menu_hover_font_underline','0'),('70','menu_hover_backgroundcolor','48B2E8'),('71','menu_border_left_size','0'),('72','menu_border_right_size','0'),('73','menu_border_top_size','0'),('74','menu_border_bottom_size','0'),('75','menu_border_left_style','solid'),('76','menu_border_right_style','solid'),('77','menu_border_top_style','solid'),('78','menu_border_bottom_style','solid'),('79','menu_border_left_color','000000'),('80','menu_border_right_color','000000'),('81','menu_border_top_color','000000'),('82','menu_border_bottom_color','000000'),('83','menu_radius_left_top','10'),('84','menu_radius_right_top','10'),('85','menu_radius_left_bottom','0'),('86','menu_radius_right_bottom','0'),('87','menu_radius_left_top_scale','px'),('88','menu_radius_right_top_scale','px'),('89','menu_radius_left_bottom_scale','px'),('90','menu_radius_right_bottom_scale','px'),('91','menu_height','39'),('92','need_menu_hover_backgroundcolor','1'),('93','menu_text_padding_left','20'),('94','menu_text_padding_right','20'),('95','menu_text_padding_top','9'),('96','menu_text_padding_bottom','9'),('97','menu_background_image_color_noneed','0'),('98','menu_seperator_need','0'),('99','menu_seperator_size','2'),('100','menu_seperator_color','FFFFFF'),('101','slider_border_top_size','2'),('102','slider_border_bottom_size','0'),('103','slider_border_left_size','0'),('104','slider_border_right_size','0'),('105','slider_border_top_color','FFFFFF'),('106','slider_border_bottom_color','C1C2BC'),('107','slider_border_left_color','484094'),('108','slider_border_right_color','FA2121'),('109','slider_top_space','0'),('110','slider_bottom_space','0'),('111','menu_text_transform','none'),('112','menu_text_hover_transform','none'),('113','slider_border_radius_left_top','0'),('114','slider_border_radius_right_top','0'),('115','slider_border_radius_left_bottom','0'),('116','slider_border_radius_right_bottom','0'),('117','showslider','1'),('118','slider_height','380'),('119','slider_top_space_need_color','0'),('120','slider_top_space_color','F1F1F1'),('121','slider_bottom_space_need_color','0'),('122','slider_bottom_space_color','FFFFFF'),('123','video_page_video_height','320'),('124','video_page_video_width','369'),('125','video_page_video_layout',NULL),('126','video_page_clicktoplay','1'),('127','video_page_details_open_neworself','0'),('128','video_page_content',NULL),('129','header_logo_padding_right','0'),('130','header_logo_padding_left','0'),('131','header_logo_padding_top','10'),('132','header_logo_padding_bottom','10'),('133','header_background_repeat ','no-repeat'),('134','currencysymbol','Rs.');

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
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

/*Data for the table `_jslider` */

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

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;