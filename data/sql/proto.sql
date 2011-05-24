-- MySQL dump 10.11
--
-- Host: localhost    Database: protoglue
-- ------------------------------------------------------
-- Server version	5.0.45

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `account`
--

DROP TABLE IF EXISTS `account`;
CREATE TABLE `account` (
  `account_id` int(11) NOT NULL auto_increment,
  `user_id` int(11) NOT NULL,
  `name` varchar(240) NOT NULL,
  `domain_id` int(11) NOT NULL,
  `primary_user` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `address_id` int(11) default NULL,
  `plan_id` int(11) default NULL,
  PRIMARY KEY  (`account_id`),
  KEY `address_id_idx` (`address_id`),
  KEY `user_id_idx` (`user_id`),
  KEY `domain_id_idx` (`domain_id`),
  KEY `plan_id` (`plan_id`),
  CONSTRAINT `account_ibfk_4` FOREIGN KEY (`plan_id`) REFERENCES `plan` (`plan_id`),
  CONSTRAINT `account_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `sf_guard_user` (`id`),
  CONSTRAINT `account_ibfk_2` FOREIGN KEY (`domain_id`) REFERENCES `domain` (`id`),
  CONSTRAINT `account_ibfk_3` FOREIGN KEY (`address_id`) REFERENCES `address` (`address_id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `account`
--

LOCK TABLES `account` WRITE;
/*!40000 ALTER TABLE `account` DISABLE KEYS */;
INSERT INTO `account` VALUES (1,1,'dawes',1,1,'2009-03-31 21:39:38',NULL,1),(2,1,'willis',1,1,'2009-03-31 22:23:56',NULL,1),(3,1,'Koo',1,1,'2009-04-14 21:28:51',NULL,1),(4,1,'Koo',1,1,'2009-04-14 21:29:04',NULL,1),(5,1,'Koo',1,1,'2009-04-14 21:29:16',NULL,1),(6,7,'blowme',2,7,'2009-04-14 21:42:28',NULL,1),(7,8,'blowcal',2,8,'2009-04-14 21:47:31',NULL,1),(8,9,'blowsteve',2,9,'2009-04-14 21:52:27',NULL,1),(9,10,'bloweveryone',2,10,'2009-04-14 21:53:44',NULL,1),(12,11,'tabletennis',1,11,'2009-04-14 22:22:12',NULL,1),(14,12,'nixon',1,12,'2009-04-14 22:36:40',NULL,1),(15,1,'',1,1,'2009-04-14 22:38:20',NULL,1),(16,1,'harmonix',1,1,'2009-04-15 00:13:35',NULL,1),(17,1,'',1,1,'2009-04-23 23:52:28',NULL,1),(18,1,'',1,1,'2009-04-23 23:53:06',NULL,1),(19,1,'',1,1,'2009-04-23 23:53:35',NULL,1),(20,1,'',1,1,'2009-04-24 00:07:04',NULL,1),(21,18,'kodazi',1,18,'2009-04-30 19:49:27',NULL,1),(22,11,'ducati',1,11,'2009-04-30 22:27:26',NULL,1),(29,41,'boitoi',1,41,'2009-05-14 23:05:29',NULL,3),(31,11,'cadillaclounge',1,11,'2009-05-14 23:45:34',NULL,NULL),(32,42,'brownbag',1,42,'2009-05-21 20:21:21',NULL,1),(33,11,'alfresco',1,11,'2009-06-30 22:46:36',NULL,1);
/*!40000 ALTER TABLE `account` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `account_group`
--

DROP TABLE IF EXISTS `account_group`;
CREATE TABLE `account_group` (
  `group_id` int(11) NOT NULL auto_increment,
  `account_id` int(11) NOT NULL,
  `name` varchar(240) NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY  (`group_id`),
  KEY `account_id_idx` (`account_id`),
  CONSTRAINT `account_group_ibfk_1` FOREIGN KEY (`account_id`) REFERENCES `account` (`account_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `account_group`
--

LOCK TABLES `account_group` WRITE;
/*!40000 ALTER TABLE `account_group` DISABLE KEYS */;
/*!40000 ALTER TABLE `account_group` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `account_type`
--

DROP TABLE IF EXISTS `account_type`;
CREATE TABLE `account_type` (
  `user_id` int(11) NOT NULL default '0',
  `type_id` int(11) NOT NULL default '0',
  `created` datetime NOT NULL,
  PRIMARY KEY  (`user_id`,`type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `account_type`
--

LOCK TABLES `account_type` WRITE;
/*!40000 ALTER TABLE `account_type` DISABLE KEYS */;
/*!40000 ALTER TABLE `account_type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `account_user`
--

DROP TABLE IF EXISTS `account_user`;
CREATE TABLE `account_user` (
  `account_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `team_id` int(11) default NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY  (`account_id`,`user_id`),
  KEY `user_id` (`user_id`),
  KEY `team_id` (`team_id`),
  CONSTRAINT `account_user_ibfk_3` FOREIGN KEY (`team_id`) REFERENCES `team` (`team_id`),
  CONSTRAINT `account_user_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `sf_guard_user` (`id`),
  CONSTRAINT `account_user_ibfk_2` FOREIGN KEY (`account_id`) REFERENCES `account` (`account_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `account_user`
--

LOCK TABLES `account_user` WRITE;
/*!40000 ALTER TABLE `account_user` DISABLE KEYS */;
INSERT INTO `account_user` VALUES (1,2,NULL,'2009-04-09 22:37:56'),(1,3,NULL,'2009-04-09 22:47:13'),(2,4,NULL,'2009-04-10 16:44:36'),(6,7,NULL,'2009-04-14 21:42:28'),(7,8,NULL,'2009-04-14 21:47:31'),(8,9,NULL,'2009-04-14 21:52:27'),(9,10,NULL,'2009-04-14 21:53:44'),(12,11,NULL,'2009-04-14 22:22:12'),(12,16,NULL,'2009-04-27 00:35:34'),(12,21,NULL,'2009-05-07 21:32:10'),(12,22,NULL,'2009-05-07 21:38:31'),(12,23,NULL,'2009-05-07 19:51:10'),(12,37,NULL,'2009-05-07 23:13:50'),(12,38,NULL,'2009-05-07 23:29:21'),(12,39,NULL,'2009-05-07 23:29:40'),(14,12,NULL,'2009-04-14 22:36:40'),(15,1,NULL,'2009-04-14 22:38:20'),(16,1,NULL,'2009-04-15 00:13:36'),(17,1,NULL,'2009-04-23 23:52:29'),(18,1,NULL,'2009-04-23 23:53:07'),(19,1,NULL,'2009-04-23 23:53:35'),(20,1,NULL,'2009-04-24 00:07:05'),(21,18,NULL,'2009-04-30 19:49:27'),(22,11,NULL,'2009-04-30 22:27:27'),(22,44,NULL,'2009-05-24 12:27:40'),(29,41,NULL,'2009-05-14 23:05:29'),(31,11,NULL,'2009-05-14 23:45:34'),(32,42,NULL,'2009-05-21 20:21:21'),(32,43,NULL,'2009-05-21 22:08:02'),(33,11,NULL,'2009-06-30 22:46:37');
/*!40000 ALTER TABLE `account_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `account_user_role`
--

DROP TABLE IF EXISTS `account_user_role`;
CREATE TABLE `account_user_role` (
  `account_id` int(11) NOT NULL default '0',
  `role_id` int(11) NOT NULL default '0',
  `user_id` int(11) NOT NULL default '0',
  `created` datetime NOT NULL,
  PRIMARY KEY  (`account_id`,`role_id`,`user_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `account_user_role_ibfk_2` FOREIGN KEY (`account_id`) REFERENCES `account` (`account_id`),
  CONSTRAINT `account_user_role_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `sf_guard_user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `account_user_role`
--

LOCK TABLES `account_user_role` WRITE;
/*!40000 ALTER TABLE `account_user_role` DISABLE KEYS */;
INSERT INTO `account_user_role` VALUES (2,1,2,'0000-00-00 00:00:00'),(3,1,1,'2009-04-14 21:28:51'),(4,1,1,'2009-04-14 21:29:04'),(5,1,1,'2009-04-14 21:29:16'),(6,1,7,'2009-04-14 21:42:29'),(7,1,8,'2009-04-14 21:47:31'),(8,1,9,'2009-04-14 21:52:27'),(9,1,10,'2009-04-14 21:53:44'),(12,1,37,'2009-05-07 23:13:51'),(12,2,11,'2009-04-14 22:22:12'),(12,2,16,'2009-04-27 00:35:34'),(12,2,21,'2009-05-07 21:32:10'),(12,2,22,'2009-05-07 21:38:31'),(12,2,38,'2009-05-07 23:29:21'),(12,2,39,'2009-05-07 23:29:40'),(14,1,12,'2009-04-14 22:36:40'),(15,1,1,'2009-04-14 22:38:20'),(16,1,1,'2009-04-15 00:13:36'),(17,1,1,'2009-04-23 23:52:29'),(18,1,1,'2009-04-23 23:53:07'),(19,1,1,'2009-04-23 23:53:35'),(20,1,1,'2009-04-24 00:07:05'),(21,1,18,'2009-04-30 19:49:27'),(22,1,11,'2009-04-30 22:27:27'),(22,2,44,'2009-05-24 12:27:40'),(29,1,41,'2009-05-14 23:05:29'),(31,1,11,'2009-05-14 23:45:34'),(32,1,42,'2009-05-21 20:21:21'),(32,2,43,'2009-05-21 22:08:02'),(33,1,11,'2009-06-30 22:46:37');
/*!40000 ALTER TABLE `account_user_role` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `address`
--

DROP TABLE IF EXISTS `address`;
CREATE TABLE `address` (
  `address_id` int(11) NOT NULL auto_increment,
  `created` datetime NOT NULL,
  `street_1` varchar(48) default NULL,
  `street_2` varchar(128) default NULL,
  `street_3` varchar(128) default NULL,
  `city` varchar(128) default NULL,
  `state` varchar(128) default NULL,
  `country` varchar(128) default NULL,
  `zip` int(11) default NULL,
  `phone_id` int(11) default NULL,
  PRIMARY KEY  (`address_id`),
  KEY `phone_id_idx` (`phone_id`),
  CONSTRAINT `address_ibfk_1` FOREIGN KEY (`phone_id`) REFERENCES `phone` (`phone_id`)
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `address`
--

LOCK TABLES `address` WRITE;
/*!40000 ALTER TABLE `address` DISABLE KEYS */;
INSERT INTO `address` VALUES (1,'2009-04-09 22:37:56',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(2,'2009-04-09 22:47:12',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(3,'2009-04-10 16:44:35',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(6,'2009-04-14 21:42:28',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(7,'2009-04-14 21:47:30',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(8,'2009-04-14 21:52:26',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(9,'2009-04-14 21:53:43',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(10,'2009-04-14 22:12:53','English Breakfast 33','Unit # Earl Grey Street',NULL,'Boston',NULL,NULL,1021,1),(11,'2009-04-14 22:36:40',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(12,'2009-04-14 22:40:49',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(15,'2009-04-27 00:35:34',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(16,'2009-04-28 23:47:39',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(17,'2009-04-30 19:49:27',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(18,'2009-05-05 23:28:20',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(19,'2009-05-05 23:42:55',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(20,'2009-05-07 21:32:09',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(21,'2009-05-07 21:38:30',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(22,'2009-05-07 19:51:10','19-B Weston Ave.','',NULL,'Somerville',NULL,NULL,2144,3),(36,'2009-05-07 23:13:50',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(37,'2009-05-07 23:29:20',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(38,'2009-05-07 23:29:39',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(40,'2009-05-14 23:05:29',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(41,'2009-05-21 20:21:21',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(42,'2009-05-21 22:08:02',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(43,'2009-05-24 12:27:40',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `address` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `audit_log`
--

DROP TABLE IF EXISTS `audit_log`;
CREATE TABLE `audit_log` (
  `id` bigint(20) NOT NULL auto_increment,
  `log` text NOT NULL,
  `created_time` datetime NOT NULL,
  `action_name` varchar(244) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `audit_log`
--

LOCK TABLES `audit_log` WRITE;
/*!40000 ALTER TABLE `audit_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `audit_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `blacklist_word`
--

DROP TABLE IF EXISTS `blacklist_word`;
CREATE TABLE `blacklist_word` (
  `id` int(11) NOT NULL auto_increment,
  `word` varchar(48) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=344 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `blacklist_word`
--

LOCK TABLES `blacklist_word` WRITE;
/*!40000 ALTER TABLE `blacklist_word` DISABLE KEYS */;
INSERT INTO `blacklist_word` VALUES (1,'anus'),(2,'arse'),(3,'arsehole'),(4,'ass'),(5,'ass-hat'),(6,'ass-pirate'),(7,'assbag'),(8,'assbandit'),(9,'assbanger'),(10,'assbite'),(11,'assclown'),(12,'asscock'),(13,'asscracker'),(14,'assess'),(15,'assface'),(16,'assfuck'),(17,'assfucker'),(18,'assgoblin'),(19,'asshat'),(20,'asshead'),(21,'asshole'),(22,'asshopper'),(23,'assjacker'),(24,'asslick'),(25,'asslickerlicker'),(26,'assmonkey'),(27,'assmunch'),(28,'assmuncher'),(29,'assnigger'),(30,'asspirate'),(31,'assshit'),(32,'assshole'),(33,'asssucker'),(34,'asswad'),(35,'asswipe'),(36,'bampot'),(37,'bastard'),(38,'beaner'),(39,'bitch'),(40,'bitchass'),(41,'bitchess'),(42,'bitchtits'),(43,'bitchy'),(44,'blow job'),(45,'blowjob'),(46,'bollocks'),(47,'bollox'),(48,'boner'),(49,'brotherfucker'),(50,'bullshit'),(51,'bumblefuck'),(52,'butt plug'),(53,'butt-pirate'),(54,'buttfucka'),(55,'buttfucker'),(56,'camel toe'),(57,'carpetmuncher'),(58,'chinc'),(59,'chink'),(60,'choad'),(61,'chode'),(62,'clit'),(63,'clitface'),(64,'clitfuck'),(65,'clusterfuck'),(66,'cock'),(67,'cockass'),(68,'cockbite'),(69,'cockburger'),(70,'cockface'),(71,'cockfucker'),(72,'cockhead'),(73,'cockjockey'),(74,'cockknoker'),(75,'cockmaster'),(76,'cockmongler'),(77,'cockmongruel'),(78,'cockmonkey'),(79,'cockmuncher'),(80,'cocknose'),(81,'cocknugget'),(82,'cockshit'),(83,'cocksmith'),(84,'cocksmoker'),(85,'cocksucker'),(86,'coochie'),(87,'coochy'),(88,'coon'),(89,'cooter'),(90,'cracker'),(91,'cum'),(92,'cumbubble'),(93,'cumdumpster'),(94,'cumguzzler'),(95,'cumjockey'),(96,'cumslut'),(97,'cumtart'),(98,'cunnie'),(99,'cunnilingus'),(100,'cunt'),(101,'cuntface'),(102,'cunthole'),(103,'cuntlicker'),(104,'cuntrag'),(105,'cuntslut'),(106,'dago'),(107,'damn'),(108,'deggo'),(109,'dick'),(110,'dickbag'),(111,'dickbeaters'),(112,'dickface'),(113,'dickfuck'),(114,'dickfucker'),(115,'dickhead'),(116,'dickhole'),(117,'dickjuice'),(118,'dickmilk'),(119,'dickmonger'),(120,'dickses'),(121,'dickslap'),(122,'dicksucker'),(123,'dickwad'),(124,'dickweasel'),(125,'dickweed'),(126,'dickwod'),(127,'dike'),(128,'dildo'),(129,'dipshit'),(130,'doochbag'),(131,'dookie'),(132,'douche'),(133,'douche-fag'),(134,'douchebag'),(135,'douchewaffle'),(136,'dumass'),(137,'dumb ass'),(138,'dumbass'),(139,'dumbfuck'),(140,'dumbshit'),(141,'dumshit'),(142,'dyke'),(143,'fag'),(144,'fagbag'),(145,'fagfucker'),(146,'faggit'),(147,'faggot'),(148,'faggotcock'),(149,'fagtard idiot'),(150,'fatass'),(151,'fellatio'),(152,'feltch'),(153,'flamer'),(154,'fuck'),(155,'fuckass'),(156,'fuckbag'),(157,'fuckboy'),(158,'fuckbrain'),(159,'fuckbutt'),(160,'fucked'),(161,'fucker'),(162,'fuckersucker'),(163,'fuckface'),(164,'fuckhead'),(165,'fuckhole'),(166,'fuckin'),(167,'fucking'),(168,'fucknut'),(169,'fucknutt'),(170,'fuckoff'),(171,'fucks'),(172,'fuckstick'),(173,'fucktard'),(174,'fuckup'),(175,'fuckwad'),(176,'fuckwit'),(177,'fuckwitt'),(178,'fudgepacker'),(179,'gay'),(180,'gayass'),(181,'gaybob'),(182,'gaydo'),(183,'gayfuck'),(184,'gayfuckist'),(185,'gaylord'),(186,'gaytard'),(187,'gaywad'),(188,'goddamn'),(189,'goddamnitit'),(190,'gooch'),(191,'gook'),(192,'gringo'),(193,'guido'),(194,'handjob'),(195,'hard on'),(196,'heeb'),(197,'hell'),(198,'ho'),(199,'hoe'),(200,'homo'),(201,'homodumbshit'),(202,'honkey'),(203,'humping'),(204,'jackass'),(205,'jap'),(206,'jerk off'),(207,'jigaboo'),(208,'jizz'),(209,'jungle bunny'),(210,'junglebunny'),(211,'kike'),(212,'kooch'),(213,'kootch'),(214,'kunt'),(215,'kyke'),(216,'lesbian'),(217,'lesbo'),(218,'lezzie'),(219,'mcfagget'),(220,'mick'),(221,'minge'),(222,'mothafucka'),(223,'motherfucker'),(224,'motherfucking'),(225,'muff'),(226,'muffdiver'),(227,'munging'),(228,'negro'),(229,'nigga'),(230,'nigger'),(231,'niggerss'),(232,'niglet child'),(233,'nut sack'),(234,'nutsack'),(235,'paki'),(236,'panooch '),(237,'pecker'),(238,'peckerhead'),(239,'penis'),(240,'penisfucker'),(241,'penispuffer'),(242,'piss'),(243,'pissedd'),(244,'pissed off'),(245,'pissflaps'),(246,'polesmoker'),(247,'pollock'),(248,'poon'),(249,'poonani'),(250,'poonany'),(251,'poontang'),(252,'porch monkey'),(253,'porchmonkey'),(254,'prick'),(255,'punanny'),(256,'punta'),(257,'pussiess'),(258,'pussy'),(259,'pussylicking'),(260,'puto'),(261,'queefl fart.'),(262,'queer'),(263,'queerbait'),(264,'queerhole'),(265,'renob'),(266,'rimjob'),(267,'ruski'),(268,'sand nigger'),(269,'sandnigger'),(270,'schlong'),(271,'scrote'),(272,'shit'),(273,'shitass'),(274,'shitbag'),(275,'shitbagger'),(276,'shitbrains'),(277,'shitbreath'),(278,'shitcunt'),(279,'shitdick'),(280,'shitface'),(281,'shitfaced'),(282,'shithead'),(283,'shithole'),(284,'shithouse'),(285,'shitspitter'),(286,'shitstain'),(287,'shitter'),(288,'shittiest'),(289,'shittinging'),(290,'shitty'),(291,'shiz'),(292,'shiznit'),(293,'skank'),(294,'skeet'),(295,'skullfuck'),(296,'slut'),(297,'slutbag'),(298,'smeg'),(299,'snatch'),(300,'spic'),(301,'spick american'),(302,'splooge'),(303,'tard'),(304,'testicle'),(305,'thundercunt'),(306,'tit'),(307,'titfuck'),(308,'titss'),(309,'tittyfuck'),(310,'twat'),(311,'twatlips'),(312,'twatss'),(313,'twatwaffle'),(314,'unclefucker'),(315,'va-j-j'),(316,'vag '),(317,'vagina'),(318,'vjayjay'),(319,'wank'),(320,'wetback'),(321,'whore'),(322,'whorebag'),(323,'whoreface'),(324,'wop'),(325,'ballsack'),(326,'ballsac'),(327,'cumshot'),(328,'cum_shot'),(329,'cum-shot'),(330,'cumquat'),(331,'hobag'),(332,'kodazi'),(333,'kodaziapp'),(334,'kodazigroup'),(335,'kodazisupport'),(336,'kodazicustomerservice'),(337,'nutshell'),(338,'nutshellapp'),(339,'nutshellcustomerservice'),(340,'nutshellsupport'),(341,'tarbaby'),(342,'urine'),(343,'wanker');
/*!40000 ALTER TABLE `blacklist_word` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `comment`
--

DROP TABLE IF EXISTS `comment`;
CREATE TABLE `comment` (
  `comment_id` int(11) NOT NULL auto_increment,
  `account_id` int(11) NOT NULL,
  `project_id` int(11) default NULL,
  `milestone_id` int(11) default NULL,
  `task_id` int(11) default NULL,
  `file_id` int(11) default NULL,
  `submitted_by` int(11) NOT NULL,
  `status` char(1) NOT NULL default '0',
  `comment_text` text NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY  (`comment_id`),
  KEY `account_id` (`account_id`),
  KEY `project_id` (`project_id`),
  KEY `milestone_id` (`milestone_id`),
  KEY `task_id` (`task_id`),
  KEY `file_id` (`file_id`),
  KEY `submitted_by` (`submitted_by`),
  CONSTRAINT `comment_ibfk_6` FOREIGN KEY (`submitted_by`) REFERENCES `sf_guard_user` (`id`),
  CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`account_id`) REFERENCES `account` (`account_id`),
  CONSTRAINT `comment_ibfk_2` FOREIGN KEY (`project_id`) REFERENCES `project` (`project_id`),
  CONSTRAINT `comment_ibfk_3` FOREIGN KEY (`milestone_id`) REFERENCES `milestone` (`milestone_id`),
  CONSTRAINT `comment_ibfk_4` FOREIGN KEY (`task_id`) REFERENCES `task` (`task_id`),
  CONSTRAINT `comment_ibfk_5` FOREIGN KEY (`file_id`) REFERENCES `file` (`file_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comment`
--

LOCK TABLES `comment` WRITE;
/*!40000 ALTER TABLE `comment` DISABLE KEYS */;
INSERT INTO `comment` VALUES (1,12,NULL,NULL,NULL,NULL,11,'1','work baby work','2009-05-09 22:11:56'),(2,12,NULL,NULL,NULL,NULL,11,'1','NEw comment','2009-05-09 22:23:23'),(3,12,NULL,NULL,NULL,NULL,11,'1','project comment','2009-05-09 22:25:00'),(4,12,7,NULL,NULL,NULL,11,'1','test','2009-05-09 22:30:10'),(5,12,7,NULL,NULL,NULL,11,'1','hello to you too','2009-05-09 22:38:00'),(6,12,11,NULL,NULL,NULL,11,'1','Pinger boo boo','2009-05-09 22:40:59'),(7,12,7,NULL,NULL,NULL,11,'1','Test ajax comment','2009-05-09 22:52:16'),(8,12,7,NULL,NULL,NULL,11,'1','Test','2009-05-09 22:59:38'),(9,12,7,NULL,NULL,NULL,11,'1','Hello there','2009-05-09 23:05:54'),(10,12,11,NULL,NULL,NULL,11,'1','Comment from the site','2009-05-09 21:19:39'),(11,12,7,NULL,NULL,NULL,11,'1','this is my comment','2009-05-10 17:40:35'),(12,12,7,NULL,NULL,NULL,11,'1','Test lucene','2009-05-11 00:10:44');
/*!40000 ALTER TABLE `comment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `domain`
--

DROP TABLE IF EXISTS `domain`;
CREATE TABLE `domain` (
  `id` int(11) NOT NULL default '0',
  `name` varchar(148) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `domain`
--

LOCK TABLES `domain` WRITE;
/*!40000 ALTER TABLE `domain` DISABLE KEYS */;
INSERT INTO `domain` VALUES (1,'protoglue.com'),(2,'kodazi.com'),(3,'berklee.com');
/*!40000 ALTER TABLE `domain` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `email`
--

DROP TABLE IF EXISTS `email`;
CREATE TABLE `email` (
  `email_id` int(11) NOT NULL auto_increment,
  `user_id` int(11) NOT NULL,
  `email` varchar(240) NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY  (`email_id`),
  KEY `user_id_idx` (`user_id`),
  CONSTRAINT `email_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `sf_guard_user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `email`
--

LOCK TABLES `email` WRITE;
/*!40000 ALTER TABLE `email` DISABLE KEYS */;
INSERT INTO `email` VALUES (1,2,'adydasotoole@yahoo.com','2009-04-09 22:37:56'),(2,3,'bball@kodazi.com','2009-04-09 22:47:12'),(3,4,'spookyb@kodazi.com','2009-04-10 16:44:36'),(6,7,'boop@kodazi.com','2009-04-14 21:42:28'),(7,8,'poop@kodazi.com','2009-04-14 21:47:31'),(8,9,'gpoop@kodazi.com','2009-04-14 21:52:27'),(9,10,'gcrap@kodazi.com','2009-04-14 21:53:43'),(10,11,'teabag@kodazi.com','2009-04-14 22:12:54'),(11,12,'fnixon@kodazi.com','2009-04-14 22:36:40'),(12,13,'bboo@kodazi.com','2009-04-14 22:40:50'),(15,16,'ady1@kodazi.com','2009-04-27 00:35:34'),(16,17,'pro@hottiestats.com','2009-04-28 23:47:39'),(17,18,'','2009-04-30 19:49:27'),(18,19,'bitch@kodazi.com','2009-05-05 23:28:20'),(19,20,'meganfoxx@kodazi.com','2009-05-05 23:42:55'),(20,21,'tool@hottiestats.com','2009-05-07 21:32:09'),(21,22,'gay@hottiestats.com','2009-05-07 21:38:31'),(22,23,'calvin@kodazi.com','2009-05-07 19:51:10'),(36,37,'cyndi@hottiestats.com','2009-05-07 23:13:50'),(37,38,'adasotoole@gmail.com','2009-05-07 23:29:21'),(38,39,'blah@blah.com','2009-05-07 23:29:39'),(40,41,'babygoo@kodazi.com','2009-05-14 23:05:29'),(41,42,'brownbag@kodazi.com','2009-05-21 20:21:21'),(42,43,'blasphemy@hottiestats.com','2009-05-21 22:08:02'),(43,44,'hot_tea@hottiestats.com','2009-05-24 12:27:40');
/*!40000 ALTER TABLE `email` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `event_log`
--

DROP TABLE IF EXISTS `event_log`;
CREATE TABLE `event_log` (
  `event_log_id` int(11) NOT NULL auto_increment,
  `account_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `project_id` int(11) default NULL,
  `milestone_id` int(11) default NULL,
  `task_id` int(11) default NULL,
  `file_id` int(11) default NULL,
  `action` enum('CREATE','READ','UPDATE','DELETE','COMMENT','ASSIGN') default NULL,
  `action_detail` varchar(248) default NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY  (`event_log_id`),
  KEY `user_id` (`user_id`),
  KEY `account_id` (`account_id`),
  KEY `project_id` (`project_id`),
  KEY `milestone_id` (`milestone_id`),
  KEY `file_id` (`file_id`),
  CONSTRAINT `event_log_ibfk_5` FOREIGN KEY (`file_id`) REFERENCES `file` (`file_id`),
  CONSTRAINT `event_log_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `sf_guard_user` (`id`),
  CONSTRAINT `event_log_ibfk_2` FOREIGN KEY (`account_id`) REFERENCES `account` (`account_id`),
  CONSTRAINT `event_log_ibfk_3` FOREIGN KEY (`project_id`) REFERENCES `project` (`project_id`),
  CONSTRAINT `event_log_ibfk_4` FOREIGN KEY (`milestone_id`) REFERENCES `milestone` (`milestone_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `event_log`
--

LOCK TABLES `event_log` WRITE;
/*!40000 ALTER TABLE `event_log` DISABLE KEYS */;
INSERT INTO `event_log` VALUES (1,12,11,NULL,NULL,7,NULL,'CREATE','C:4:\"Task\":641:{a:10:{s:3:\"_id\";a:1:{s:7:\"task_id\";s:1:\"7\";}s:5:\"_data\";a:13:{s:7:\"task_id\";s:1:\"7\";s:10:\"created_by\";s:2:\"11\";s:4:\"name\";s:6:\"Brazen\";s:14:\"estimate_units\";s:4:\"6.00\";s:13:\"estimate_type\";s:1:\"3\";s:6:\"status\";s:1:\"2\";s:7:\"created\";','2009-09-09 00:17:17'),(2,12,11,NULL,NULL,7,NULL,'CREATE','C:4:\"Task\":641:{a:10:{s:3:\"_id\";a:1:{s:7:\"task_id\";s:1:\"7\";}s:5:\"_data\";a:13:{s:7:\"task_id\";s:1:\"7\";s:10:\"created_by\";s:2:\"11\";s:4:\"name\";s:6:\"Brazen\";s:14:\"estimate_units\";s:4:\"6.00\";s:13:\"estimate_type\";s:1:\"3\";s:6:\"status\";s:1:\"2\";s:7:\"created\";','2009-09-09 00:17:19'),(3,12,11,NULL,NULL,2,NULL,'CREATE','C:4:\"Task\":640:{a:10:{s:3:\"_id\";a:1:{s:7:\"task_id\";s:1:\"2\";}s:5:\"_data\";a:13:{s:7:\"task_id\";s:1:\"2\";s:10:\"created_by\";s:2:\"11\";s:4:\"name\";s:8:\"Pussycat\";s:14:\"estimate_units\";s:5:\"10.00\";s:13:\"estimate_type\";s:1:\"3\";s:6:\"status\";i:2;s:7:\"created\";s','2009-09-09 00:17:21'),(4,12,11,NULL,NULL,2,NULL,'CREATE','C:4:\"Task\":644:{a:10:{s:3:\"_id\";a:1:{s:7:\"task_id\";s:1:\"2\";}s:5:\"_data\";a:13:{s:7:\"task_id\";s:1:\"2\";s:10:\"created_by\";s:2:\"11\";s:4:\"name\";s:8:\"Pussycat\";s:14:\"estimate_units\";s:5:\"10.00\";s:13:\"estimate_type\";s:1:\"3\";s:6:\"status\";s:1:\"2\";s:7:\"create','2009-09-09 00:17:23');
/*!40000 ALTER TABLE `event_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `file`
--

DROP TABLE IF EXISTS `file`;
CREATE TABLE `file` (
  `file_id` int(11) NOT NULL auto_increment,
  `project_id` int(11) default NULL,
  `created` datetime default NULL,
  `is_public` smallint(1) default '0',
  PRIMARY KEY  (`file_id`),
  KEY `project_id` (`project_id`),
  CONSTRAINT `file_ibfk_1` FOREIGN KEY (`project_id`) REFERENCES `project` (`project_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `file`
--

LOCK TABLES `file` WRITE;
/*!40000 ALTER TABLE `file` DISABLE KEYS */;
INSERT INTO `file` VALUES (1,7,'2009-09-19 11:06:24',0),(3,7,'2009-09-22 21:51:52',0),(4,7,'2009-09-22 21:53:16',0),(5,7,'2009-09-22 22:27:14',0),(6,7,'2009-09-24 20:36:57',0);
/*!40000 ALTER TABLE `file` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `file_info`
--

DROP TABLE IF EXISTS `file_info`;
CREATE TABLE `file_info` (
  `file_id` int(11) NOT NULL default '0',
  `version` int(4) default '0',
  `version_id` int(11) NOT NULL default '0',
  `name` varchar(512) default NULL,
  `path` varchar(1048) default NULL,
  `description` text,
  `type` int(11) NOT NULL default '0',
  `size` int(11) default NULL,
  `creator_id` int(11) NOT NULL,
  PRIMARY KEY  (`file_id`,`version_id`),
  KEY `version_id` (`version_id`),
  KEY `creator_id` (`creator_id`),
  CONSTRAINT `file_info_ibfk_3` FOREIGN KEY (`creator_id`) REFERENCES `sf_guard_user` (`id`),
  CONSTRAINT `file_info_ibfk_1` FOREIGN KEY (`file_id`) REFERENCES `file` (`file_id`),
  CONSTRAINT `file_info_ibfk_2` FOREIGN KEY (`version_id`) REFERENCES `file_version` (`version_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `file_info`
--

LOCK TABLES `file_info` WRITE;
/*!40000 ALTER TABLE `file_info` DISABLE KEYS */;
INSERT INTO `file_info` VALUES (1,1,1,'MySql_ReadMe.txt','12/test',NULL,0,NULL,11),(1,2,2,'MySql_ReadMe.txt','12/test',NULL,0,NULL,11),(3,1,4,'MySql_ReadMe.txt','12/',NULL,0,NULL,11),(4,1,5,'nextGenArch.txt','12/',NULL,0,NULL,11),(4,2,6,'nextGenArch.txt','12/',NULL,0,NULL,11),(5,1,7,'CreatorsclubSecurityReview_PPT97.pot','12/',NULL,0,NULL,11),(6,1,8,'indexSuccess.php','12/',NULL,0,NULL,11);
/*!40000 ALTER TABLE `file_info` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `file_issue`
--

DROP TABLE IF EXISTS `file_issue`;
CREATE TABLE `file_issue` (
  `file_id` int(11) NOT NULL,
  `issue_id` int(11) NOT NULL,
  PRIMARY KEY  (`file_id`,`issue_id`),
  KEY `issue_id` (`issue_id`),
  CONSTRAINT `file_issue_ibfk_2` FOREIGN KEY (`issue_id`) REFERENCES `issue` (`issue_id`),
  CONSTRAINT `file_issue_ibfk_1` FOREIGN KEY (`file_id`) REFERENCES `file` (`file_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `file_issue`
--

LOCK TABLES `file_issue` WRITE;
/*!40000 ALTER TABLE `file_issue` DISABLE KEYS */;
INSERT INTO `file_issue` VALUES (5,4),(6,6);
/*!40000 ALTER TABLE `file_issue` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `file_message`
--

DROP TABLE IF EXISTS `file_message`;
CREATE TABLE `file_message` (
  `file_id` int(11) NOT NULL,
  `messg_id` int(11) NOT NULL,
  PRIMARY KEY  (`file_id`,`messg_id`),
  KEY `messg_id` (`messg_id`),
  CONSTRAINT `file_message_ibfk_2` FOREIGN KEY (`messg_id`) REFERENCES `message` (`messg_id`),
  CONSTRAINT `file_message_ibfk_1` FOREIGN KEY (`file_id`) REFERENCES `file` (`file_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `file_message`
--

LOCK TABLES `file_message` WRITE;
/*!40000 ALTER TABLE `file_message` DISABLE KEYS */;
/*!40000 ALTER TABLE `file_message` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `file_task`
--

DROP TABLE IF EXISTS `file_task`;
CREATE TABLE `file_task` (
  `file_id` int(11) NOT NULL,
  `task_id` int(11) NOT NULL,
  PRIMARY KEY  (`file_id`,`task_id`),
  KEY `task_id` (`task_id`),
  CONSTRAINT `file_task_ibfk_2` FOREIGN KEY (`task_id`) REFERENCES `task` (`task_id`),
  CONSTRAINT `file_task_ibfk_1` FOREIGN KEY (`file_id`) REFERENCES `file` (`file_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `file_task`
--

LOCK TABLES `file_task` WRITE;
/*!40000 ALTER TABLE `file_task` DISABLE KEYS */;
INSERT INTO `file_task` VALUES (1,2),(3,2),(4,2);
/*!40000 ALTER TABLE `file_task` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `file_user`
--

DROP TABLE IF EXISTS `file_user`;
CREATE TABLE `file_user` (
  `file_id` int(11) NOT NULL default '0',
  `viewer_id` int(11) NOT NULL default '0',
  `view_date` datetime default NULL,
  PRIMARY KEY  (`file_id`,`viewer_id`),
  KEY `viewer_id` (`viewer_id`),
  CONSTRAINT `file_user_ibfk_2` FOREIGN KEY (`file_id`) REFERENCES `file` (`file_id`),
  CONSTRAINT `file_user_ibfk_1` FOREIGN KEY (`viewer_id`) REFERENCES `sf_guard_user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `file_user`
--

LOCK TABLES `file_user` WRITE;
/*!40000 ALTER TABLE `file_user` DISABLE KEYS */;
/*!40000 ALTER TABLE `file_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `file_version`
--

DROP TABLE IF EXISTS `file_version`;
CREATE TABLE `file_version` (
  `version_id` int(11) NOT NULL auto_increment,
  `file_id` int(11) NOT NULL,
  `version` int(4) default '1',
  `created` datetime default NULL,
  PRIMARY KEY  (`version_id`),
  KEY `file_id` (`file_id`),
  CONSTRAINT `file_version_ibfk_1` FOREIGN KEY (`file_id`) REFERENCES `file` (`file_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `file_version`
--

LOCK TABLES `file_version` WRITE;
/*!40000 ALTER TABLE `file_version` DISABLE KEYS */;
INSERT INTO `file_version` VALUES (1,1,1,'2009-09-19 11:06:24'),(2,1,2,'2009-09-19 11:07:07'),(4,3,1,'2009-09-22 21:51:52'),(5,4,1,'2009-09-22 21:53:16'),(6,4,2,'2009-09-22 21:58:34'),(7,5,1,'2009-09-22 22:27:14'),(8,6,1,'2009-09-24 20:36:57');
/*!40000 ALTER TABLE `file_version` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `issue`
--

DROP TABLE IF EXISTS `issue`;
CREATE TABLE `issue` (
  `issue_id` int(11) NOT NULL auto_increment,
  `project_id` int(11) NOT NULL,
  `reported_by` int(11) NOT NULL,
  `assigned_to` int(11) default NULL,
  `summary` text,
  `description` text,
  `status` smallint(6) NOT NULL default '0',
  `level2_status` smallint(6) NOT NULL default '0',
  `level3_status` smallint(6) NOT NULL default '0',
  `created` datetime default NULL,
  `updated` datetime default NULL,
  PRIMARY KEY  (`issue_id`),
  KEY `project_id` (`project_id`),
  KEY `reported_by` (`reported_by`),
  KEY `assigned_to` (`assigned_to`),
  CONSTRAINT `issue_ibfk_3` FOREIGN KEY (`assigned_to`) REFERENCES `sf_guard_user` (`id`),
  CONSTRAINT `issue_ibfk_1` FOREIGN KEY (`project_id`) REFERENCES `project` (`project_id`),
  CONSTRAINT `issue_ibfk_2` FOREIGN KEY (`reported_by`) REFERENCES `sf_guard_user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `issue`
--

LOCK TABLES `issue` WRITE;
/*!40000 ALTER TABLE `issue` DISABLE KEYS */;
INSERT INTO `issue` VALUES (1,7,11,11,NULL,NULL,0,0,0,'2009-09-22 17:36:01','2009-09-22 17:36:01'),(2,7,11,11,NULL,NULL,0,0,0,'2009-09-22 22:01:04','2009-09-22 22:01:04'),(3,7,11,11,NULL,NULL,0,0,0,'2009-09-22 22:02:07','2009-09-22 22:02:07'),(4,7,11,11,'Test','Test',0,0,0,'2009-09-22 22:27:14','2009-09-22 22:27:14'),(5,7,11,11,'test','test',0,0,0,'2009-09-24 20:35:54','2009-09-24 20:35:54'),(6,7,11,11,'test','test',0,0,0,'2009-09-24 20:36:57','2009-09-24 20:36:57'),(7,7,11,11,'test','test',0,0,0,'2009-09-24 20:38:02','2009-09-24 20:38:02'),(9,7,11,11,'Test 15','Test 1115',0,0,0,'2009-09-24 22:31:34','2009-09-24 22:31:34');
/*!40000 ALTER TABLE `issue` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `issue_comment`
--

DROP TABLE IF EXISTS `issue_comment`;
CREATE TABLE `issue_comment` (
  `comment_id` int(11) NOT NULL auto_increment,
  `issue_id` int(11) NOT NULL,
  `author` int(11) NOT NULL,
  `body` text,
  `created` datetime default NULL,
  PRIMARY KEY  (`comment_id`,`issue_id`),
  KEY `issue_id` (`issue_id`),
  KEY `author` (`author`),
  CONSTRAINT `issue_comment_ibfk_2` FOREIGN KEY (`author`) REFERENCES `sf_guard_user` (`id`),
  CONSTRAINT `issue_comment_ibfk_1` FOREIGN KEY (`issue_id`) REFERENCES `issue` (`issue_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `issue_comment`
--

LOCK TABLES `issue_comment` WRITE;
/*!40000 ALTER TABLE `issue_comment` DISABLE KEYS */;
/*!40000 ALTER TABLE `issue_comment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `issue_meta`
--

DROP TABLE IF EXISTS `issue_meta`;
CREATE TABLE `issue_meta` (
  `issue_id` int(11) NOT NULL,
  `severity` varchar(24) default NULL,
  `frequency` varchar(8) default NULL,
  `hardware` varchar(24) default NULL,
  `version` varchar(12) default NULL,
  PRIMARY KEY  (`issue_id`),
  CONSTRAINT `issue_meta_ibfk_1` FOREIGN KEY (`issue_id`) REFERENCES `issue` (`issue_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `issue_meta`
--

LOCK TABLES `issue_meta` WRITE;
/*!40000 ALTER TABLE `issue_meta` DISABLE KEYS */;
/*!40000 ALTER TABLE `issue_meta` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `issue_task`
--

DROP TABLE IF EXISTS `issue_task`;
CREATE TABLE `issue_task` (
  `issue_id` int(11) NOT NULL,
  `task_id` int(11) NOT NULL,
  PRIMARY KEY  (`issue_id`,`task_id`),
  KEY `task_id` (`task_id`),
  CONSTRAINT `issue_task_ibfk_2` FOREIGN KEY (`issue_id`) REFERENCES `issue` (`issue_id`),
  CONSTRAINT `issue_task_ibfk_1` FOREIGN KEY (`task_id`) REFERENCES `task` (`task_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `issue_task`
--

LOCK TABLES `issue_task` WRITE;
/*!40000 ALTER TABLE `issue_task` DISABLE KEYS */;
INSERT INTO `issue_task` VALUES (1,2),(2,2),(3,2),(4,2),(5,2),(6,2),(7,2),(9,2);
/*!40000 ALTER TABLE `issue_task` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `issue_tracker`
--

DROP TABLE IF EXISTS `issue_tracker`;
CREATE TABLE `issue_tracker` (
  `tracker_id` int(11) NOT NULL auto_increment,
  `issue_id` int(11) NOT NULL,
  `track_info` longtext,
  `created` datetime default NULL,
  PRIMARY KEY  (`tracker_id`),
  KEY `issue_id` (`issue_id`),
  CONSTRAINT `issue_tracker_ibfk_1` FOREIGN KEY (`issue_id`) REFERENCES `issue` (`issue_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `issue_tracker`
--

LOCK TABLES `issue_tracker` WRITE;
/*!40000 ALTER TABLE `issue_tracker` DISABLE KEYS */;
INSERT INTO `issue_tracker` VALUES (1,9,'a:11:{s:8:\"issue_id\";s:1:\"9\";s:10:\"project_id\";s:1:\"7\";s:11:\"reported_by\";s:2:\"11\";s:6:\"status\";s:1:\"0\";s:13:\"level2_status\";s:1:\"0\";s:13:\"level3_status\";s:1:\"0\";s:11:\"assigned_to\";s:2:\"11\";s:7:\"summary\";s:7:\"Test 15\";s:11:\"description\";s:9:\"Test 1115\";s:7:\"created\";s:19:\"2009-09-24 22:31:34\";s:7:\"updated\";s:19:\"2009-09-24 22:31:34\";}',NULL);
/*!40000 ALTER TABLE `issue_tracker` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `message`
--

DROP TABLE IF EXISTS `message`;
CREATE TABLE `message` (
  `messg_id` int(11) NOT NULL auto_increment,
  `messg_sub_id` int(11) default NULL,
  `account_id` int(11) default NULL,
  `project_id` int(11) default NULL,
  `subject` varchar(2048) default 'Untitled Message',
  `body` text,
  `submitted_by` int(11) NOT NULL,
  `status` char(1) NOT NULL default '1',
  `created` datetime NOT NULL,
  PRIMARY KEY  (`messg_id`),
  KEY `project_id` (`project_id`),
  KEY `account_id` (`account_id`),
  KEY `submitted_by` (`submitted_by`),
  KEY `messg_sub_id` (`messg_sub_id`),
  CONSTRAINT `message_ibfk_4` FOREIGN KEY (`messg_sub_id`) REFERENCES `message` (`messg_id`),
  CONSTRAINT `message_ibfk_1` FOREIGN KEY (`project_id`) REFERENCES `project` (`project_id`),
  CONSTRAINT `message_ibfk_2` FOREIGN KEY (`account_id`) REFERENCES `account` (`account_id`),
  CONSTRAINT `message_ibfk_3` FOREIGN KEY (`submitted_by`) REFERENCES `sf_guard_user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `message`
--

LOCK TABLES `message` WRITE;
/*!40000 ALTER TABLE `message` DISABLE KEYS */;
INSERT INTO `message` VALUES (6,NULL,12,7,'Test','Test',11,'2','2009-05-26 11:37:59'),(8,NULL,12,7,'Hello poopy','Test poops',11,'1','2009-09-29 23:00:38'),(9,NULL,12,7,'Hello poopy','Test poops',11,'1','2009-09-29 23:00:39'),(10,NULL,12,7,'Hello poopy','Test poops',11,'1','2009-09-29 23:00:41'),(11,NULL,12,7,'Hello poopy','Test poops',11,'1','2009-09-29 23:00:42'),(12,NULL,12,7,'Hello poopy','Test poops',11,'1','2009-09-29 23:00:44'),(13,NULL,12,7,'Hello poopy','Test poops',11,'1','2009-09-29 23:00:45'),(14,NULL,12,7,'Hello poopy','Test poops',11,'1','2009-09-29 23:00:47'),(15,NULL,12,NULL,'Pooper scooper','Test pooper',11,'1','2009-09-29 23:34:51'),(16,NULL,12,NULL,'Primitive','Radio Gods',11,'1','2009-09-29 23:36:20'),(17,NULL,12,7,'blue','pill',11,'1','2009-09-29 23:40:55'),(18,14,12,7,'Be here now','And then',11,'1','2009-09-30 00:03:32'),(19,14,12,7,'2nd pooper message','pooper the scooper',11,'1','2009-09-30 00:18:25'),(21,13,12,7,'Hello Dad','Taffy',11,'1','2009-10-11 22:48:24'),(22,13,12,7,'Hello Dad','Taffy',11,'1','2009-10-11 22:48:26'),(23,13,12,7,'Hello Dad','Taffy',11,'1','2009-10-11 22:48:28'),(24,13,12,7,'Test','Test',11,'1','2009-10-11 22:50:20'),(25,13,12,7,'Test','Test',11,'1','2009-10-11 22:53:40'),(26,13,12,7,'Test','Test',11,'1','2009-10-11 22:53:41'),(27,13,12,7,'Test','Test',11,'1','2009-10-11 22:53:43'),(28,13,12,7,'Test','Test',11,'1','2009-10-11 22:53:45'),(29,13,12,7,'Test','Test',11,'1','2009-10-11 23:13:32'),(30,13,12,7,'Test','Test',11,'1','2009-10-11 23:22:55'),(31,13,12,7,'Test','Test',11,'1','2009-10-11 23:22:57'),(32,13,12,7,'Test','Test',11,'1','2009-10-11 23:28:06'),(33,13,12,7,'Test','Test',11,'1','2009-10-11 23:31:38');
/*!40000 ALTER TABLE `message` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `message_subs`
--

DROP TABLE IF EXISTS `message_subs`;
CREATE TABLE `message_subs` (
  `messg_id` int(11) NOT NULL,
  `subscriber_id` int(11) NOT NULL,
  PRIMARY KEY  (`messg_id`,`subscriber_id`),
  KEY `subscriber_id` (`subscriber_id`),
  CONSTRAINT `message_subs_ibfk_2` FOREIGN KEY (`subscriber_id`) REFERENCES `sf_guard_user` (`id`),
  CONSTRAINT `message_subs_ibfk_1` FOREIGN KEY (`messg_id`) REFERENCES `message` (`messg_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `message_subs`
--

LOCK TABLES `message_subs` WRITE;
/*!40000 ALTER TABLE `message_subs` DISABLE KEYS */;
INSERT INTO `message_subs` VALUES (6,11),(15,11),(6,16),(15,16),(6,21),(16,21),(16,22),(17,22),(17,23),(19,23),(25,23),(26,23),(27,23),(28,23),(29,23),(30,23),(31,23),(32,23),(33,23),(18,37),(19,37),(21,37),(22,37),(23,37),(18,38),(21,38),(22,38),(23,38),(24,38),(25,38),(26,38),(27,38),(28,38),(29,38),(30,38),(31,38),(32,38),(33,38),(24,39),(25,39),(26,39),(27,39),(28,39),(29,39),(30,39),(31,39),(32,39),(33,39);
/*!40000 ALTER TABLE `message_subs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `message_tag`
--

DROP TABLE IF EXISTS `message_tag`;
CREATE TABLE `message_tag` (
  `messg_tag_id` int(11) NOT NULL auto_increment,
  `messg_id` int(11) NOT NULL,
  `tags` varchar(2048) NOT NULL,
  PRIMARY KEY  (`messg_tag_id`),
  KEY `messg_id` (`messg_id`),
  CONSTRAINT `message_tag_ibfk_1` FOREIGN KEY (`messg_id`) REFERENCES `message` (`messg_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `message_tag`
--

LOCK TABLES `message_tag` WRITE;
/*!40000 ALTER TABLE `message_tag` DISABLE KEYS */;
/*!40000 ALTER TABLE `message_tag` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `milestone`
--

DROP TABLE IF EXISTS `milestone`;
CREATE TABLE `milestone` (
  `milestone_id` int(11) NOT NULL auto_increment,
  `sub_milestone_id` int(11) default NULL,
  `created_by` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `name` varchar(240) NOT NULL,
  `status` int(11) default '0',
  `created` datetime NOT NULL,
  `primary_owner` int(11) default NULL,
  `sec_owner` int(11) default NULL,
  `description` text,
  `start_time` datetime default NULL,
  `end_time` datetime default NULL,
  PRIMARY KEY  (`milestone_id`),
  KEY `primary_owner_idx` (`primary_owner`),
  KEY `sec_owner_idx` (`sec_owner`),
  KEY `project_id_idx` (`project_id`),
  KEY `created_by_idx` (`created_by`),
  KEY `sub_milestone_id` (`sub_milestone_id`),
  CONSTRAINT `milestone_ibfk_5` FOREIGN KEY (`sub_milestone_id`) REFERENCES `milestone` (`milestone_id`),
  CONSTRAINT `milestone_ibfk_1` FOREIGN KEY (`sec_owner`) REFERENCES `sf_guard_user` (`id`),
  CONSTRAINT `milestone_ibfk_2` FOREIGN KEY (`project_id`) REFERENCES `project` (`project_id`),
  CONSTRAINT `milestone_ibfk_3` FOREIGN KEY (`primary_owner`) REFERENCES `sf_guard_user` (`id`),
  CONSTRAINT `milestone_ibfk_4` FOREIGN KEY (`created_by`) REFERENCES `sf_guard_user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `milestone`
--

LOCK TABLES `milestone` WRITE;
/*!40000 ALTER TABLE `milestone` DISABLE KEYS */;
INSERT INTO `milestone` VALUES (3,NULL,11,7,'Mouse Hunt',1,'2009-04-28 21:32:09',NULL,NULL,'default content',NULL,'2009-04-28 00:00:00'),(5,NULL,11,7,'Pong me too',1,'2009-04-28 21:37:09',NULL,NULL,'default content',NULL,'2009-04-28 00:00:00'),(10,NULL,11,7,'Test Event Log',1,'2009-05-10 22:29:54',16,16,'default content',NULL,'2009-05-10 00:00:00'),(11,NULL,11,7,'Bullock',1,'2009-05-10 22:38:08',16,16,'default content',NULL,'2009-05-10 00:00:00'),(12,NULL,11,7,'Bang',1,'2009-05-10 22:40:37',16,16,'default content',NULL,'2009-05-10 00:00:00'),(13,NULL,11,11,'Booboo',1,'2009-05-10 22:41:37',16,16,'default content',NULL,'2009-05-10 00:00:00'),(18,NULL,11,11,'Test Lucent',1,'2009-05-10 23:13:20',16,16,'default content',NULL,'2009-05-30 00:00:00'),(20,NULL,11,7,'Production tease',1,'2009-05-10 22:17:44',16,16,'default content',NULL,'2009-05-19 00:00:00'),(21,NULL,11,11,'Cabbage pat',1,'2009-05-10 22:18:10',16,16,'default content',NULL,'2009-05-10 00:00:00'),(23,NULL,42,56,'Plastic Bag',1,'2009-05-21 20:36:30',NULL,NULL,'default content',NULL,'2009-05-21 00:00:00'),(25,NULL,11,10,'Prep bike for track day',1,'2009-05-21 18:42:46',11,11,'',NULL,'2009-06-01 00:00:00'),(26,NULL,11,10,'Get trailer from David',1,'2009-05-21 18:56:52',11,11,'default content',NULL,'2009-06-01 00:00:00'),(30,NULL,11,59,'Bangers',1,'2009-05-26 20:41:27',NULL,NULL,'The Tasks feature should be 100% complete.',NULL,'2009-06-30 00:00:00'),(31,NULL,11,10,'Suspension',1,'2009-05-27 00:44:36',NULL,NULL,'default content',NULL,'2009-05-27 00:00:00'),(32,NULL,11,59,'Mashy',1,'2009-05-28 20:12:20',NULL,NULL,'default content',NULL,'2009-05-28 00:00:00'),(33,NULL,11,57,'Bridgestones',1,'2009-05-28 18:31:36',NULL,NULL,'default content',NULL,'2009-05-28 00:00:00'),(34,NULL,11,57,'Slipons',1,'2009-05-28 18:40:28',NULL,NULL,'default content',NULL,'2009-05-28 00:00:00'),(36,NULL,11,57,'Lights off',1,'2009-05-28 20:43:58',NULL,NULL,'default content',NULL,'2009-05-28 00:00:00'),(37,NULL,11,10,'blah',1,'2009-07-02 22:17:05',11,11,'default content',NULL,'2009-07-02 00:00:00');
/*!40000 ALTER TABLE `milestone` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notif_message`
--

DROP TABLE IF EXISTS `notif_message`;
CREATE TABLE `notif_message` (
  `message_id` int(11) NOT NULL auto_increment,
  `body` text NOT NULL,
  `created_by` int(11) NOT NULL,
  `notif_type` smallint(6) NOT NULL default '0',
  `created` datetime NOT NULL,
  `sub_message_id` int(11) default NULL,
  `title` text,
  `subject` text,
  PRIMARY KEY  (`message_id`),
  KEY `created_by_idx` (`created_by`),
  KEY `sub_message_id_idx` (`sub_message_id`),
  CONSTRAINT `notif_message_ibfk_2` FOREIGN KEY (`created_by`) REFERENCES `sf_guard_user` (`id`),
  CONSTRAINT `notif_message_ibfk_1` FOREIGN KEY (`sub_message_id`) REFERENCES `notif_message` (`message_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notif_message`
--

LOCK TABLES `notif_message` WRITE;
/*!40000 ALTER TABLE `notif_message` DISABLE KEYS */;
/*!40000 ALTER TABLE `notif_message` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notif_user`
--

DROP TABLE IF EXISTS `notif_user`;
CREATE TABLE `notif_user` (
  `message_id` int(11) NOT NULL default '0',
  `recipient` int(11) NOT NULL default '0',
  `status` smallint(6) NOT NULL default '0',
  `updated` datetime NOT NULL,
  PRIMARY KEY  (`message_id`,`recipient`),
  KEY `recipient` (`recipient`),
  CONSTRAINT `notif_user_ibfk_1` FOREIGN KEY (`recipient`) REFERENCES `sf_guard_user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notif_user`
--

LOCK TABLES `notif_user` WRITE;
/*!40000 ALTER TABLE `notif_user` DISABLE KEYS */;
INSERT INTO `notif_user` VALUES (3,11,1,'2009-05-25 22:29:54'),(3,16,1,'2009-05-25 22:29:54'),(3,21,1,'2009-05-25 22:29:54');
/*!40000 ALTER TABLE `notif_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notification`
--

DROP TABLE IF EXISTS `notification`;
CREATE TABLE `notification` (
  `id` bigint(20) NOT NULL auto_increment,
  `invite_id` int(11) NOT NULL,
  `message` text NOT NULL,
  `type` int(11) NOT NULL,
  `read_status` smallint(6) NOT NULL default '0',
  `created` datetime NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notification`
--

LOCK TABLES `notification` WRITE;
/*!40000 ALTER TABLE `notification` DISABLE KEYS */;
/*!40000 ALTER TABLE `notification` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notification_type`
--

DROP TABLE IF EXISTS `notification_type`;
CREATE TABLE `notification_type` (
  `type_id` int(11) NOT NULL default '0',
  `notification` varchar(248) NOT NULL,
  `description` text,
  PRIMARY KEY  (`type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notification_type`
--

LOCK TABLES `notification_type` WRITE;
/*!40000 ALTER TABLE `notification_type` DISABLE KEYS */;
/*!40000 ALTER TABLE `notification_type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `payment_card`
--

DROP TABLE IF EXISTS `payment_card`;
CREATE TABLE `payment_card` (
  `payment_card_id` int(11) NOT NULL auto_increment,
  `first_name` varchar(148) NOT NULL,
  `last_name` varchar(148) NOT NULL,
  `card_num` varchar(24) NOT NULL default '',
  `card_type` varchar(5) default '',
  `expiry_month` varchar(2) NOT NULL,
  `expiry_year` varchar(4) NOT NULL,
  `ccv` varchar(8) default '',
  `created` datetime NOT NULL,
  `status` smallint(6) NOT NULL default '1',
  PRIMARY KEY  (`payment_card_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payment_card`
--

LOCK TABLES `payment_card` WRITE;
/*!40000 ALTER TABLE `payment_card` DISABLE KEYS */;
INSERT INTO `payment_card` VALUES (1,'Blurp','Boo','370000000000002','','02','2010','','2009-05-14 23:05:30',1);
/*!40000 ALTER TABLE `payment_card` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `payment_transaction`
--

DROP TABLE IF EXISTS `payment_transaction`;
CREATE TABLE `payment_transaction` (
  `payment_transaction_id` int(11) NOT NULL auto_increment,
  `gateway_transaction_id` varchar(124) NOT NULL,
  `account_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `payment_card_id` int(11) NOT NULL,
  `total_value` decimal(6,2) default '0.00',
  `currency` varchar(8) NOT NULL default 'USD',
  `status` smallint(6) NOT NULL default '0',
  PRIMARY KEY  (`payment_transaction_id`),
  KEY `payment_card_id` (`payment_card_id`),
  KEY `account_id` (`account_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `payment_transaction_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `sf_guard_user` (`id`),
  CONSTRAINT `payment_transaction_ibfk_1` FOREIGN KEY (`payment_card_id`) REFERENCES `payment_card` (`payment_card_id`),
  CONSTRAINT `payment_transaction_ibfk_2` FOREIGN KEY (`account_id`) REFERENCES `account` (`account_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payment_transaction`
--

LOCK TABLES `payment_transaction` WRITE;
/*!40000 ALTER TABLE `payment_transaction` DISABLE KEYS */;
INSERT INTO `payment_transaction` VALUES (1,'508338',29,41,'2009-05-14 23:05:30',1,'24.00','USD',1);
/*!40000 ALTER TABLE `payment_transaction` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phone`
--

DROP TABLE IF EXISTS `phone`;
CREATE TABLE `phone` (
  `phone_id` int(11) NOT NULL auto_increment,
  `type` int(11) default '0',
  `created` datetime NOT NULL,
  `number` varchar(20) default NULL,
  PRIMARY KEY  (`phone_id`),
  KEY `type_idx` (`type`),
  CONSTRAINT `phone_ibfk_1` FOREIGN KEY (`type`) REFERENCES `phone_type` (`type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `phone`
--

LOCK TABLES `phone` WRITE;
/*!40000 ALTER TABLE `phone` DISABLE KEYS */;
INSERT INTO `phone` VALUES (1,1,'2009-07-19 22:47:01',''),(3,1,'2009-05-21 19:27:02','');
/*!40000 ALTER TABLE `phone` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phone_type`
--

DROP TABLE IF EXISTS `phone_type`;
CREATE TABLE `phone_type` (
  `type_id` int(11) NOT NULL default '0',
  `name` varchar(20) default NULL,
  PRIMARY KEY  (`type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `phone_type`
--

LOCK TABLES `phone_type` WRITE;
/*!40000 ALTER TABLE `phone_type` DISABLE KEYS */;
INSERT INTO `phone_type` VALUES (1,'HOME'),(2,'CELL'),(3,'BUSINESS');
/*!40000 ALTER TABLE `phone_type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `plan`
--

DROP TABLE IF EXISTS `plan`;
CREATE TABLE `plan` (
  `plan_id` int(11) NOT NULL default '0',
  `type` varchar(48) NOT NULL,
  `description` varchar(255) default NULL,
  `price` decimal(5,2) default NULL,
  PRIMARY KEY  (`plan_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `plan`
--

LOCK TABLES `plan` WRITE;
/*!40000 ALTER TABLE `plan` DISABLE KEYS */;
INSERT INTO `plan` VALUES (1,'FREE','Free plan','0.00'),(2,'PERSONAL','Personal plan','12.00'),(3,'BASIC','Basic plan','24.00'),(4,'INTERMED','Interediate plan','49.00'),(5,'ADVANCED','Advanced plan','99.00'),(6,'PRO','Professional plan','149.00');
/*!40000 ALTER TABLE `plan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `plan_feature`
--

DROP TABLE IF EXISTS `plan_feature`;
CREATE TABLE `plan_feature` (
  `plan_id` int(11) NOT NULL default '0',
  `space` int(11) NOT NULL,
  `num_users` int(11) default NULL,
  `num_projects` int(11) default NULL,
  `iphone_access` char(1) default NULL,
  `ssl_on` char(1) default NULL,
  `data_backup` char(1) default NULL,
  PRIMARY KEY  (`plan_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `plan_feature`
--

LOCK TABLES `plan_feature` WRITE;
/*!40000 ALTER TABLE `plan_feature` DISABLE KEYS */;
INSERT INTO `plan_feature` VALUES (1,20,4,1,'0','0','0'),(2,500,8,5,'1','0','1'),(3,3072,-1,15,'1','0','1'),(4,10240,-1,30,'1','1','1'),(5,20480,-1,-1,'1','1','1'),(6,40960,-1,-1,'1','1','1');
/*!40000 ALTER TABLE `plan_feature` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `profile`
--

DROP TABLE IF EXISTS `profile`;
CREATE TABLE `profile` (
  `profile_id` int(11) NOT NULL auto_increment,
  `user_id` int(11) NOT NULL,
  `sex` char(1) default NULL,
  `created` datetime NOT NULL,
  `first_name` varchar(255) default NULL,
  `last_name` varchar(255) default NULL,
  `address_id` int(11) default NULL,
  PRIMARY KEY  (`profile_id`),
  KEY `user_id_idx` (`user_id`),
  KEY `address_id_idx` (`address_id`),
  CONSTRAINT `profile_ibfk_2` FOREIGN KEY (`address_id`) REFERENCES `address` (`address_id`),
  CONSTRAINT `profile_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `sf_guard_user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `profile`
--

LOCK TABLES `profile` WRITE;
/*!40000 ALTER TABLE `profile` DISABLE KEYS */;
INSERT INTO `profile` VALUES (1,1,NULL,'2008-12-05 20:31:45','Spooky','Boo',NULL),(2,2,NULL,'2009-04-09 22:37:56','Bree','Ball',1),(3,3,NULL,'2009-04-09 22:47:13','Brad','Gelina',2),(4,4,NULL,'2009-04-10 16:44:36','Spooky','Bob',3),(7,7,NULL,'2009-04-14 21:42:28','Baby','Boop',6),(8,8,NULL,'2009-04-14 21:47:31','Man','Poop',7),(9,9,NULL,'2009-04-14 21:52:27','Girl','Poop',8),(10,10,NULL,'2009-04-14 21:53:43','GirlMan','Crap',9),(11,11,NULL,'2009-04-14 22:12:54','Tea','Bags',10),(12,12,NULL,'2009-04-14 22:36:40','Frost','Nixon',11),(13,13,NULL,'2009-04-14 22:40:50','Broccoli','Boo',12),(16,16,NULL,'2009-04-27 00:35:34','Test','Daze',15),(17,17,NULL,'2009-04-28 23:47:39','pro','bono',16),(18,18,NULL,'2009-04-30 19:49:27','Tea','Bag',17),(19,19,NULL,'2009-05-05 23:28:21','Bitchy','Cock',18),(20,20,NULL,'2009-05-05 23:42:56','megan','foxx',19),(21,21,NULL,'2009-05-07 21:32:09','Prosthetic','Tool',20),(22,22,NULL,'2009-05-07 21:38:31','Gay','Keitas',21),(23,23,NULL,'2009-05-07 19:51:10','Calvin','Koo',22),(37,37,NULL,'2009-05-07 23:13:50','Cyndi','Lauper',36),(38,38,NULL,'2009-05-07 23:29:21','ady','das',37),(39,39,NULL,'2009-05-07 23:29:40','blah','blah',38),(41,41,NULL,'2009-05-14 23:05:29','Blurp','Boo',40),(42,42,NULL,'2009-05-21 20:21:21','brown','bag',41),(43,43,NULL,'2009-05-21 22:08:02','Blas','Phemy',42),(44,44,NULL,'2009-05-24 12:27:40','Hot','Tea',43);
/*!40000 ALTER TABLE `profile` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `project`
--

DROP TABLE IF EXISTS `project`;
CREATE TABLE `project` (
  `project_id` int(11) NOT NULL auto_increment,
  `created_by` int(11) NOT NULL,
  `name` varchar(240) NOT NULL,
  `status` int(11) default '0',
  `created` datetime NOT NULL,
  `address_id` int(11) default NULL,
  `description` text,
  `start_date` date default NULL,
  `end_date` date default NULL,
  PRIMARY KEY  (`project_id`),
  KEY `created_by_idx` (`created_by`),
  KEY `address_id_idx` (`address_id`),
  CONSTRAINT `project_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `sf_guard_user` (`id`),
  CONSTRAINT `project_ibfk_2` FOREIGN KEY (`address_id`) REFERENCES `address` (`address_id`)
) ENGINE=InnoDB AUTO_INCREMENT=63 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `project`
--

LOCK TABLES `project` WRITE;
/*!40000 ALTER TABLE `project` DISABLE KEYS */;
INSERT INTO `project` VALUES (1,1,'Avalon Project',1,'2009-03-31 22:18:10',NULL,' Setting the stage at Avalon Road',NULL,NULL),(2,1,'Avalon Project',1,'2009-03-31 22:18:16',NULL,' Setting the stage at Avalon Road',NULL,NULL),(3,1,'Spook 2',1,'2009-04-10 16:48:21',NULL,'Test this project',NULL,NULL),(5,1,'Dawes',1,'2009-04-15 00:14:33',NULL,' This is where I get robbed and mugged',NULL,NULL),(6,1,'Dawes',1,'2009-04-15 00:14:35',NULL,' This is where I get robbed and mugged',NULL,NULL),(7,11,'Ping the ding dong doggy doo',1,'2009-04-23 21:47:31',NULL,'Ping pong tasks',NULL,NULL),(10,11,'1098',1,'2009-05-05 10:31:15',NULL,'',NULL,NULL),(11,11,'Pinger',1,'2009-05-05 22:51:41',NULL,'This is dope poop and poop it is',NULL,NULL),(12,11,'Ady',1,'2009-05-07 23:30:37',NULL,' Ady\'s the best',NULL,NULL),(13,11,'Ady',1,'2009-05-07 23:31:03',NULL,' Ady\'s the best',NULL,NULL),(14,11,'Ady',1,'2009-05-07 23:31:34',NULL,' Ady\'s the best',NULL,NULL),(20,11,'Homes for Calvins Beatches!!',1,'2009-05-15 00:11:58',NULL,'This is what I\'m talking about boyyyyyyyyyyaaa.',NULL,NULL),(21,11,'Homeless Adys',1,'2009-05-15 00:13:19',NULL,NULL,NULL,NULL),(22,11,'Homeless Adys',1,'2009-05-15 00:13:28',NULL,NULL,NULL,NULL),(23,11,'Hello',1,'2009-05-15 00:29:23',NULL,NULL,NULL,NULL),(24,11,'Hello 2',1,'2009-05-15 00:31:12',NULL,NULL,NULL,NULL),(25,11,'what is this',1,'2009-05-15 00:36:32',NULL,NULL,NULL,NULL),(26,11,'Homes for Mayas Rule!',1,'2009-05-15 00:39:44',NULL,'',NULL,NULL),(27,11,'holy moly',1,'2009-05-15 00:41:54',NULL,NULL,NULL,NULL),(28,11,'Hi there',1,'2009-05-15 00:42:47',NULL,NULL,NULL,NULL),(29,11,'are you sure?',1,'2009-05-15 00:49:14',NULL,NULL,NULL,NULL),(30,11,'try again',1,'2009-05-15 00:51:08',NULL,NULL,NULL,NULL),(31,11,'Are you sure aagain',1,'2009-05-15 00:53:03',NULL,NULL,NULL,NULL),(32,11,'yes yea',1,'2009-05-15 00:56:41',NULL,NULL,NULL,NULL),(33,11,'no no',1,'2009-05-15 00:58:14',NULL,NULL,NULL,NULL),(34,11,'blah',1,'2009-05-15 01:05:26',NULL,NULL,NULL,NULL),(35,11,'blah blah',1,'2009-05-15 01:08:33',NULL,NULL,NULL,NULL),(36,11,'blah blah',1,'2009-05-15 01:08:35',NULL,NULL,NULL,NULL),(37,11,'jj',1,'2009-05-15 01:10:16',NULL,NULL,NULL,NULL),(38,11,'hjk',1,'2009-05-15 01:10:37',NULL,NULL,NULL,NULL),(39,11,'Last Food for Noah',1,'2009-05-17 21:36:39',NULL,NULL,NULL,NULL),(40,11,'Homes for Lynns',1,'2009-05-17 22:05:43',NULL,NULL,NULL,NULL),(41,11,'What\'s the problem?',1,'2009-05-17 22:19:46',NULL,NULL,NULL,NULL),(42,11,'Yes - another one',1,'2009-05-17 22:25:58',NULL,NULL,NULL,NULL),(43,11,'Calvin',1,'2009-05-17 23:18:37',NULL,NULL,NULL,NULL),(44,11,'Perforce',1,'2009-05-18 17:52:36',NULL,NULL,NULL,NULL),(45,11,'Slapper',1,'2009-05-18 18:36:55',NULL,NULL,NULL,NULL),(46,11,'Pants off',0,'2009-05-18 18:38:03',NULL,'',NULL,NULL),(47,11,'Red berries',1,'2009-05-18 18:39:10',NULL,NULL,NULL,NULL),(48,11,'Baristas',1,'2009-05-18 16:44:27',NULL,NULL,NULL,NULL),(49,11,'848',1,'2009-05-18 19:46:03',NULL,NULL,NULL,NULL),(50,11,'1198',1,'2009-05-18 19:47:13',NULL,NULL,NULL,NULL),(51,11,'Blue Berries',1,'2009-05-19 22:25:35',NULL,NULL,NULL,NULL),(52,11,'Black Berries',1,'2009-05-21 18:09:02',NULL,NULL,NULL,NULL),(53,11,'This is a really long project name...because my projects are off da hook!!  Yo Yo!!!',1,'2009-05-21 18:10:30',NULL,'Modal window looks ridiculous!',NULL,NULL),(54,11,'New projects',1,'2009-05-21 18:11:33',NULL,NULL,NULL,NULL),(56,42,'PaperBag',1,'2009-05-21 20:35:50',NULL,NULL,NULL,NULL),(57,11,'Streetfighter',1,'2009-05-21 20:54:30',NULL,NULL,NULL,NULL),(59,11,'Kodazi',1,'2009-05-26 20:38:57',NULL,NULL,'2009-05-01','2009-05-31'),(60,11,'Ping the ding dong doggy doo 2',1,'2009-06-01 23:47:46',NULL,NULL,'2009-06-01','2009-09-01'),(61,11,'Files',1,'2009-06-30 22:51:15',NULL,NULL,'2009-06-30','2009-06-30'),(62,11,'Nutshell Bugs',1,'2009-07-02 21:53:09',NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `project` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `project_account`
--

DROP TABLE IF EXISTS `project_account`;
CREATE TABLE `project_account` (
  `account_id` int(11) NOT NULL default '0',
  `project_id` int(11) NOT NULL default '0',
  `created` datetime NOT NULL,
  PRIMARY KEY  (`account_id`,`project_id`),
  KEY `project_id` (`project_id`),
  CONSTRAINT `project_account_ibfk_2` FOREIGN KEY (`account_id`) REFERENCES `account` (`account_id`),
  CONSTRAINT `project_account_ibfk_1` FOREIGN KEY (`project_id`) REFERENCES `project` (`project_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `project_account`
--

LOCK TABLES `project_account` WRITE;
/*!40000 ALTER TABLE `project_account` DISABLE KEYS */;
INSERT INTO `project_account` VALUES (1,1,'2009-03-31 22:18:10'),(1,2,'2009-03-31 22:18:16'),(2,3,'2009-04-10 16:48:21'),(12,7,'2009-04-23 21:47:31'),(12,11,'2009-05-05 22:51:41'),(12,12,'2009-05-07 23:30:37'),(12,13,'2009-05-07 23:31:03'),(12,14,'2009-05-07 23:31:34'),(12,44,'2009-05-18 17:52:37'),(12,45,'2009-05-18 18:36:55'),(12,46,'2009-05-18 18:38:04'),(12,47,'2009-05-18 18:39:11'),(12,51,'2009-05-19 22:25:35'),(12,52,'2009-05-21 18:09:02'),(12,53,'2009-05-21 18:10:30'),(12,54,'2009-05-21 18:11:33'),(12,60,'2009-06-01 23:47:46'),(16,5,'2009-04-15 00:14:33'),(16,6,'2009-04-15 00:14:35'),(22,10,'2009-05-05 10:31:15'),(22,49,'2009-05-18 19:46:03'),(22,50,'2009-05-18 19:47:13'),(22,57,'2009-05-21 20:54:30'),(22,59,'2009-05-26 20:38:57'),(22,62,'2009-07-02 21:53:09'),(31,20,'2009-05-15 00:11:58'),(31,21,'2009-05-15 00:13:19'),(31,22,'2009-05-15 00:13:28'),(31,23,'2009-05-15 00:29:23'),(31,24,'2009-05-15 00:31:12'),(31,25,'2009-05-15 00:36:32'),(31,26,'2009-05-15 00:39:44'),(31,27,'2009-05-15 00:41:55'),(31,28,'2009-05-15 00:42:47'),(31,29,'2009-05-15 00:49:14'),(31,30,'2009-05-15 00:51:08'),(31,31,'2009-05-15 00:53:03'),(31,32,'2009-05-15 00:56:41'),(31,33,'2009-05-15 00:58:15'),(31,34,'2009-05-15 01:05:26'),(31,35,'2009-05-15 01:08:33'),(31,36,'2009-05-15 01:08:35'),(31,37,'2009-05-15 01:10:16'),(31,38,'2009-05-15 01:10:37'),(31,39,'2009-05-17 21:36:40'),(31,40,'2009-05-17 22:05:43'),(31,41,'2009-05-17 22:19:46'),(31,42,'2009-05-17 22:25:58'),(31,43,'2009-05-17 23:18:38'),(31,48,'2009-05-18 16:44:27'),(32,56,'2009-05-21 20:35:50'),(33,61,'2009-06-30 22:51:15');
/*!40000 ALTER TABLE `project_account` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `project_email`
--

DROP TABLE IF EXISTS `project_email`;
CREATE TABLE `project_email` (
  `project_id` int(11) NOT NULL default '0',
  `email_id` int(11) NOT NULL default '0',
  `created` datetime NOT NULL,
  PRIMARY KEY  (`project_id`,`email_id`),
  KEY `email_id` (`email_id`),
  CONSTRAINT `project_email_ibfk_2` FOREIGN KEY (`email_id`) REFERENCES `email` (`email_id`),
  CONSTRAINT `project_email_ibfk_1` FOREIGN KEY (`project_id`) REFERENCES `project` (`project_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `project_email`
--

LOCK TABLES `project_email` WRITE;
/*!40000 ALTER TABLE `project_email` DISABLE KEYS */;
/*!40000 ALTER TABLE `project_email` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `project_file`
--

DROP TABLE IF EXISTS `project_file`;
CREATE TABLE `project_file` (
  `file_id` int(11) NOT NULL default '0',
  `project_id` int(11) NOT NULL default '0',
  `created` datetime NOT NULL,
  PRIMARY KEY  (`file_id`,`project_id`),
  KEY `project_id` (`project_id`),
  CONSTRAINT `project_file_ibfk_2` FOREIGN KEY (`file_id`) REFERENCES `file` (`file_id`),
  CONSTRAINT `project_file_ibfk_1` FOREIGN KEY (`project_id`) REFERENCES `project` (`project_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `project_file`
--

LOCK TABLES `project_file` WRITE;
/*!40000 ALTER TABLE `project_file` DISABLE KEYS */;
INSERT INTO `project_file` VALUES (6,7,'2009-09-03 17:03:31');
/*!40000 ALTER TABLE `project_file` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `project_user`
--

DROP TABLE IF EXISTS `project_user`;
CREATE TABLE `project_user` (
  `project_id` int(11) NOT NULL auto_increment,
  `user_id` int(11) NOT NULL default '0',
  `team_id` int(11) NOT NULL default '0',
  `created` datetime NOT NULL,
  PRIMARY KEY  (`user_id`,`team_id`),
  KEY `project_id_idx` (`project_id`),
  KEY `team_id` (`team_id`),
  CONSTRAINT `project_user_ibfk_3` FOREIGN KEY (`project_id`) REFERENCES `project` (`project_id`),
  CONSTRAINT `project_user_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `sf_guard_user` (`id`),
  CONSTRAINT `project_user_ibfk_2` FOREIGN KEY (`team_id`) REFERENCES `team` (`team_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `project_user`
--

LOCK TABLES `project_user` WRITE;
/*!40000 ALTER TABLE `project_user` DISABLE KEYS */;
INSERT INTO `project_user` VALUES (13,11,14,'2009-05-08 17:24:49'),(10,11,16,'2009-05-10 20:35:41'),(11,16,13,'2009-05-08 00:39:15'),(11,21,13,'2009-05-08 00:38:41'),(11,23,13,'2009-05-08 00:37:04'),(7,23,15,'2009-05-10 20:32:28'),(11,37,13,'2009-05-08 00:22:53');
/*!40000 ALTER TABLE `project_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `project_user_role`
--

DROP TABLE IF EXISTS `project_user_role`;
CREATE TABLE `project_user_role` (
  `project_id` int(11) NOT NULL default '0',
  `role_id` int(11) NOT NULL default '0',
  `user_id` int(11) NOT NULL default '0',
  `created` datetime NOT NULL,
  PRIMARY KEY  (`project_id`,`role_id`,`user_id`),
  KEY `user_id` (`user_id`),
  KEY `role_id` (`role_id`),
  CONSTRAINT `project_user_role_ibfk_2` FOREIGN KEY (`role_id`) REFERENCES `user_role` (`role_id`),
  CONSTRAINT `project_user_role_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `sf_guard_user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `project_user_role`
--

LOCK TABLES `project_user_role` WRITE;
/*!40000 ALTER TABLE `project_user_role` DISABLE KEYS */;
/*!40000 ALTER TABLE `project_user_role` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `session`
--

DROP TABLE IF EXISTS `session`;
CREATE TABLE `session` (
  `id` varchar(255) NOT NULL default '',
  `time` bigint(20) default '0',
  `data` text,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `session`
--

LOCK TABLES `session` WRITE;
/*!40000 ALTER TABLE `session` DISABLE KEYS */;
/*!40000 ALTER TABLE `session` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sf_guard_group`
--

DROP TABLE IF EXISTS `sf_guard_group`;
CREATE TABLE `sf_guard_group` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(255) default NULL,
  `description` text,
  `created_at` datetime default NULL,
  `updated_at` datetime default NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sf_guard_group`
--

LOCK TABLES `sf_guard_group` WRITE;
/*!40000 ALTER TABLE `sf_guard_group` DISABLE KEYS */;
INSERT INTO `sf_guard_group` VALUES (1,'admin','Administrator group',NULL,NULL),(2,'user','User Group',NULL,NULL),(3,'account_manager','Account Manager',NULL,NULL);
/*!40000 ALTER TABLE `sf_guard_group` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sf_guard_group_permission`
--

DROP TABLE IF EXISTS `sf_guard_group_permission`;
CREATE TABLE `sf_guard_group_permission` (
  `group_id` int(11) NOT NULL default '0',
  `permission_id` int(11) NOT NULL default '0',
  `created_at` datetime default NULL,
  `updated_at` datetime default NULL,
  PRIMARY KEY  (`group_id`,`permission_id`),
  KEY `permission_id` (`permission_id`),
  CONSTRAINT `sf_guard_group_permission_ibfk_2` FOREIGN KEY (`group_id`) REFERENCES `sf_guard_group` (`id`) ON DELETE CASCADE,
  CONSTRAINT `sf_guard_group_permission_ibfk_1` FOREIGN KEY (`permission_id`) REFERENCES `sf_guard_permission` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sf_guard_group_permission`
--

LOCK TABLES `sf_guard_group_permission` WRITE;
/*!40000 ALTER TABLE `sf_guard_group_permission` DISABLE KEYS */;
/*!40000 ALTER TABLE `sf_guard_group_permission` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sf_guard_permission`
--

DROP TABLE IF EXISTS `sf_guard_permission`;
CREATE TABLE `sf_guard_permission` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(255) default NULL,
  `description` text,
  `created_at` datetime default NULL,
  `updated_at` datetime default NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sf_guard_permission`
--

LOCK TABLES `sf_guard_permission` WRITE;
/*!40000 ALTER TABLE `sf_guard_permission` DISABLE KEYS */;
INSERT INTO `sf_guard_permission` VALUES (1,'admin','Administrator permission',NULL,NULL),(2,'user','User permissions',NULL,NULL),(3,'account_manager','Account management permissions',NULL,NULL);
/*!40000 ALTER TABLE `sf_guard_permission` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sf_guard_remember_key`
--

DROP TABLE IF EXISTS `sf_guard_remember_key`;
CREATE TABLE `sf_guard_remember_key` (
  `id` int(11) NOT NULL auto_increment,
  `user_id` int(11) default NULL,
  `remember_key` varchar(32) default NULL,
  `ip_address` varchar(50) NOT NULL default '',
  `created_at` datetime default NULL,
  `updated_at` datetime default NULL,
  PRIMARY KEY  (`id`,`ip_address`),
  KEY `user_id_idx` (`user_id`),
  CONSTRAINT `sf_guard_remember_key_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `sf_guard_user` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sf_guard_remember_key`
--

LOCK TABLES `sf_guard_remember_key` WRITE;
/*!40000 ALTER TABLE `sf_guard_remember_key` DISABLE KEYS */;
INSERT INTO `sf_guard_remember_key` VALUES (11,11,'01dcd79351b741317c649293d05c1f66','127.0.0.1','2009-11-03 22:34:55','2009-11-03 22:34:55');
/*!40000 ALTER TABLE `sf_guard_remember_key` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sf_guard_user`
--

DROP TABLE IF EXISTS `sf_guard_user`;
CREATE TABLE `sf_guard_user` (
  `id` int(11) NOT NULL auto_increment,
  `username` varchar(128) NOT NULL,
  `algorithm` varchar(128) NOT NULL default 'sha1',
  `salt` varchar(128) default NULL,
  `password` varchar(128) default NULL,
  `is_active` tinyint(1) default '1',
  `is_super_admin` tinyint(1) default '0',
  `last_login` datetime default NULL,
  `created_at` datetime default NULL,
  `updated_at` datetime default NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `username` (`username`),
  KEY `is_active_idx_idx` (`is_active`)
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sf_guard_user`
--

LOCK TABLES `sf_guard_user` WRITE;
/*!40000 ALTER TABLE `sf_guard_user` DISABLE KEYS */;
INSERT INTO `sf_guard_user` VALUES (1,'admin','sha1','d13e31f060770f294674d3e0f2fcacdc','23f940d7f853730e9e7a85485c800c534b99576e',1,1,'2009-09-03 10:52:57','2008-11-23 17:02:26','2009-09-03 22:52:57'),(2,'adydasotoole@yahoo.com','sha1','6d45f187a23a57edb1d505c4be74b4fb','469c0855e111086f8bf490ee629b9f71d4df4423',1,0,'2009-04-21 08:37:10','2009-04-09 22:37:55','2009-04-21 20:37:10'),(3,'bball@kodazi.com','sha1','57c59f31567f8a5340786dff1c367e22','5e664bb7dfbc3e4ef546163fe25ca9d249ca96aa',1,0,NULL,'2009-04-09 22:47:11','2009-04-09 22:47:11'),(4,'spookyb@kodazi.com','sha1','89668a3a00c28383521e88010e88f13f','573d5deb52ea925d1c6e72feee9be217957088d0',1,0,NULL,'2009-04-10 16:44:35','2009-04-10 16:44:35'),(7,'boop@kodazi.com','sha1','194d5fd8126e5c5397ecf1e8e64bf892','08bcdcba59b659a8163fddb890c72f6e96be09fd',1,0,NULL,'2009-04-14 21:42:27','2009-04-14 21:42:27'),(8,'poop@kodazi.com','sha1','0709f22a62bc3deb7534d6b4d91f1abc','5d2e73beb9beac5177fd7200e86dffdb155d44b6',1,0,NULL,'2009-04-14 21:47:30','2009-04-14 21:47:30'),(9,'gpoop@kodazi.com','sha1','1f55ba41c4adb38f7eeb791d36d37414','3b0965b8af01607a1cab6b3d1891950435bb615b',1,0,NULL,'2009-04-14 21:52:26','2009-04-14 21:52:26'),(10,'gcrap@kodazi.com','sha1','6674ea12106cf0a1d19f06b9dda71995','cfcaef07c860848317c173b0420e8ee40294c2af',1,0,'2009-04-14 09:53:44','2009-04-14 21:53:43','2009-04-14 21:53:44'),(11,'teabag@kodazi.com','sha1','f0f4235aa8e6768781227317fa6a7245','1bbe0d3c005712b3c79fd8856dffd7c8fffad8f5',1,0,'2009-11-08 11:14:25','2009-04-14 22:12:53','2009-11-08 23:14:26'),(12,'fnixon@kodazi.com','sha1','422d9e275fca95282bc543a790393a01','f6903477012aa94aeef5dac5b7f2e62ec8bb126a',1,0,'2009-04-14 10:37:19','2009-04-14 22:36:39','2009-04-14 22:37:19'),(13,'bboo@kodazi.com','sha1','3e4725df1d677fc9c3335b4f336cc5ea','e4e6fe03a941c8a0aaa6ada7b4329a209c8c5ba0',1,0,NULL,'2009-04-14 22:40:49','2009-04-14 22:40:49'),(16,'ady1@kodazi.com','sha1','1a509ddef0e827d2ed456a41f0bbe51b','018941608f95d5e0a207c60a424037c56657e65d',1,0,NULL,'2009-04-27 00:35:33','2009-04-27 00:35:33'),(17,'pro@hottiestats.com','sha1','487ed729f66c0a40fa89dbfa234a28c9','7af6cb409d8fb875d4972920afa01ee3b8919d2a',1,0,NULL,'2009-04-28 23:47:39','2009-04-28 23:47:39'),(18,'','sha1',NULL,NULL,1,0,'2009-04-30 07:49:27','2009-04-30 19:49:23','2009-04-30 19:49:27'),(19,'bitch@kodazi.com','sha1','7f3dd97f3f673283da2082a92a6367fa','b97842ef8ff615e4f554c7c0d74bca8a8ac171d2',1,0,NULL,'2009-05-05 23:28:20','2009-05-05 23:28:20'),(20,'meganfoxx@kodazi.com','sha1','d48a20d050cfac20cd419a6d79a0cee0','3828e235a8f9f4cac49a0c8b68af3e4f0341f87a',1,0,NULL,'2009-05-05 23:42:55','2009-05-05 23:42:55'),(21,'tool@hottiestats.com','sha1','42f8429fb07acab0b9fae783152ac39f','0bd935e8c6bbd36beeb8f23dc5d2a8440b5589eb',1,0,NULL,'2009-05-07 21:32:08','2009-05-07 21:32:08'),(22,'gay@hottiestats.com','sha1','d97d5d5610f8e559bf8afdaaab726066','893111263c6fd67ba05c393488cada4c19dfd538',1,0,NULL,'2009-05-07 21:38:30','2009-05-07 21:38:30'),(23,'calvin@kodazi.com','sha1','a907666b5478573d996f933ff3550448','b8db73a0dd346de98c313d8deebe78c480f29060',1,0,'2009-08-12 02:33:08','2009-05-07 19:51:10','2009-08-12 02:33:08'),(37,'cyndi@hottiestats.com','sha1','946b8b7a2e7d562829d1b3f5055b2e9a','925ce892ad64ffd55883a598390829aa173ccc27',1,0,NULL,'2009-05-07 23:13:49','2009-05-07 23:13:49'),(38,'adasotoole@gmail.com','sha1','0bf2c38eebc97cd4860dacaf2e02f22b','f7a06f1e46864aa4e6b6933916889a711d12220c',1,0,NULL,'2009-05-07 23:29:20','2009-05-07 23:29:20'),(39,'blah@blah.com','sha1','05875b26339147ab5df164e20faa78df','3a41df0c83cfb7784c4cefe7a6b6f561d41723f7',1,0,NULL,'2009-05-07 23:29:39','2009-05-07 23:29:39'),(41,'babygoo@kodazi.com','sha1','3a147c91f5b3d033dababd57896b4310','4d39871c138341ba2ef55ee7246e7622dfc3c129',1,0,'2009-05-14 11:05:30','2009-05-14 23:05:28','2009-05-14 23:05:30'),(42,'brownbag@kodazi.com','sha1','1a5d4119105abb933bb99bb9a59876c9','4e1f2fa7db83fa7cd1d40acb549b9bc2a1a879b5',1,0,'2009-05-21 09:58:10','2009-05-21 20:21:20','2009-05-21 21:58:10'),(43,'blasphemy@hottiestats.com','sha1','782234613afd3ee025f6014e080c72bf','a8768d2147ce5c751af1fa80d991f0e2ad6cb840',1,0,NULL,'2009-05-21 22:08:02','2009-05-21 22:08:02'),(44,'hot_tea@hottiestats.com','sha1','ec272eca3bb12a3194c0fb6359fc69dc','b792c4a854113e1291db1366fa09a5f2303c5e32',1,0,NULL,'2009-05-24 12:27:39','2009-05-24 12:27:39');
/*!40000 ALTER TABLE `sf_guard_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sf_guard_user_group`
--

DROP TABLE IF EXISTS `sf_guard_user_group`;
CREATE TABLE `sf_guard_user_group` (
  `user_id` int(11) NOT NULL default '0',
  `group_id` int(11) NOT NULL default '0',
  `created_at` datetime default NULL,
  `updated_at` datetime default NULL,
  PRIMARY KEY  (`user_id`,`group_id`),
  KEY `group_id` (`group_id`),
  CONSTRAINT `sf_guard_user_group_ibfk_2` FOREIGN KEY (`group_id`) REFERENCES `sf_guard_group` (`id`) ON DELETE CASCADE,
  CONSTRAINT `sf_guard_user_group_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `sf_guard_user` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sf_guard_user_group`
--

LOCK TABLES `sf_guard_user_group` WRITE;
/*!40000 ALTER TABLE `sf_guard_user_group` DISABLE KEYS */;
INSERT INTO `sf_guard_user_group` VALUES (2,1,'2009-04-09 22:37:55','2009-04-09 22:37:55'),(3,1,'2009-04-09 22:47:12','2009-04-09 22:47:12'),(4,1,'2009-04-10 16:44:35','2009-04-10 16:44:35'),(7,1,'2009-04-14 21:42:28','2009-04-14 21:42:28'),(8,1,'2009-04-14 21:47:30','2009-04-14 21:47:30'),(9,1,'2009-04-14 21:52:26','2009-04-14 21:52:26'),(10,1,'2009-04-14 21:53:43','2009-04-14 21:53:43'),(11,1,'2009-04-14 22:12:53','2009-04-14 22:12:53'),(12,1,'2009-04-14 22:36:39','2009-04-14 22:36:39'),(13,1,'2009-04-14 22:40:49','2009-04-14 22:40:49'),(16,1,'2009-04-27 00:35:34','2009-04-27 00:35:34'),(17,1,'2009-04-28 23:47:39','2009-04-28 23:47:39'),(18,1,'2009-04-30 19:49:27','2009-04-30 19:49:27'),(19,1,'2009-05-05 23:28:20','2009-05-05 23:28:20'),(20,1,'2009-05-05 23:42:55','2009-05-05 23:42:55'),(21,1,'2009-05-07 21:32:09','2009-05-07 21:32:09'),(22,1,'2009-05-07 21:38:30','2009-05-07 21:38:30'),(23,1,'2009-05-07 19:51:10','2009-05-07 19:51:10'),(37,1,'2009-05-07 23:13:50','2009-05-07 23:13:50'),(38,1,'2009-05-07 23:29:20','2009-05-07 23:29:20'),(39,1,'2009-05-07 23:29:39','2009-05-07 23:29:39'),(41,1,'2009-05-14 23:05:29','2009-05-14 23:05:29'),(42,1,'2009-05-21 20:21:20','2009-05-21 20:21:20'),(43,1,'2009-05-21 22:08:02','2009-05-21 22:08:02'),(44,1,'2009-05-24 12:27:39','2009-05-24 12:27:39');
/*!40000 ALTER TABLE `sf_guard_user_group` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sf_guard_user_permission`
--

DROP TABLE IF EXISTS `sf_guard_user_permission`;
CREATE TABLE `sf_guard_user_permission` (
  `user_id` int(11) NOT NULL default '0',
  `permission_id` int(11) NOT NULL default '0',
  `created_at` datetime default NULL,
  `updated_at` datetime default NULL,
  PRIMARY KEY  (`user_id`,`permission_id`),
  KEY `permission_id` (`permission_id`),
  CONSTRAINT `sf_guard_user_permission_ibfk_2` FOREIGN KEY (`permission_id`) REFERENCES `sf_guard_permission` (`id`) ON DELETE CASCADE,
  CONSTRAINT `sf_guard_user_permission_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `sf_guard_user` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sf_guard_user_permission`
--

LOCK TABLES `sf_guard_user_permission` WRITE;
/*!40000 ALTER TABLE `sf_guard_user_permission` DISABLE KEYS */;
/*!40000 ALTER TABLE `sf_guard_user_permission` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `task`
--

DROP TABLE IF EXISTS `task`;
CREATE TABLE `task` (
  `task_id` int(11) NOT NULL auto_increment,
  `created_by` int(11) NOT NULL,
  `name` varchar(240) NOT NULL,
  `estimate_units` decimal(4,2) default '0.00',
  `estimate_type` int(11) default '1',
  `status` int(11) NOT NULL default '0',
  `created` datetime NOT NULL,
  `project_id` int(11) NOT NULL,
  `milestone_id` int(11) default NULL,
  `owner` int(11) default NULL,
  `description` text,
  `due_date` datetime default NULL,
  `start_date` datetime default NULL,
  PRIMARY KEY  (`task_id`),
  KEY `owner_idx` (`owner`),
  KEY `milestone_id_idx` (`milestone_id`),
  KEY `project_id_idx` (`project_id`),
  KEY `created_by_idx` (`created_by`),
  CONSTRAINT `task_ibfk_1` FOREIGN KEY (`project_id`) REFERENCES `project` (`project_id`),
  CONSTRAINT `task_ibfk_2` FOREIGN KEY (`owner`) REFERENCES `sf_guard_user` (`id`),
  CONSTRAINT `task_ibfk_3` FOREIGN KEY (`milestone_id`) REFERENCES `milestone` (`milestone_id`),
  CONSTRAINT `task_ibfk_4` FOREIGN KEY (`created_by`) REFERENCES `sf_guard_user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=397 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `task`
--

LOCK TABLES `task` WRITE;
/*!40000 ALTER TABLE `task` DISABLE KEYS */;
INSERT INTO `task` VALUES (2,11,'Pussycat','10.00',3,2,'2009-04-28 23:59:23',7,5,11,'default content','2009-06-09 00:00:00','2009-04-29 00:00:00'),(8,42,'Paper or Plastic','5.00',3,1,'2009-05-21 20:37:24',56,23,42,'default content','2009-05-21 00:00:00','2009-05-21 00:00:00'),(11,11,'Set tire pressure ','1.00',3,2,'2009-05-21 18:43:38',10,25,11,'Set psi to 32/34','2009-06-01 00:00:00','2009-06-01 00:00:00'),(12,42,'Crapper','0.00',3,1,'2009-05-21 20:46:58',56,23,42,'default content','2009-05-21 00:00:00','2009-05-21 00:00:00'),(13,11,'Bring back protector','1.00',3,2,'2009-05-21 18:46:08',10,25,11,'','2009-06-01 00:00:00','2009-06-01 00:00:00'),(14,11,'Bring salt tablets to the show','0.00',3,1,'2009-10-22 22:57:46',10,25,11,'','2009-10-22 00:00:00',NULL),(16,42,'Tester','0.00',3,1,'2009-05-21 20:49:11',56,23,42,'default content',NULL,NULL),(23,11,'Bring gloves to work','0.00',3,1,'2009-10-23 10:59:39',10,25,11,'','2009-10-23 00:00:00',NULL),(24,11,'View Tasks Associated to a Milestone','0.00',3,2,'2009-05-26 20:56:47',59,30,11,'Get this use case done.','2009-06-30 00:00:00',NULL),(25,11,'View Milestone Landing Page','0.00',3,1,'2009-05-26 21:01:02',10,30,11,'This is the page that\'s displayed when a user clicks the \"milestones\" tab in the global navigation.','2009-06-30 00:00:00',NULL),(26,11,'Create Milestone','0.00',3,1,'2009-05-26 21:02:34',10,30,11,'','2009-06-30 00:00:00',NULL),(27,11,'Delete Milestone','0.00',3,1,'2009-05-26 21:03:17',10,30,11,'','2009-06-30 00:00:00',NULL),(28,11,'Edit Milestone','0.00',3,1,'2009-05-26 21:04:13',10,30,11,'','2009-06-30 00:00:00',NULL),(29,11,'Send Email to Milestone Notification List','0.00',3,1,'2009-05-26 21:04:41',10,30,11,'','2009-06-30 00:00:00',NULL),(30,11,'Write Copy for Email Notifications','0.00',3,1,'2009-05-26 21:05:18',10,30,44,'','2009-06-30 00:00:00',NULL),(31,11,'Create WF for Edit Milestone ','0.00',3,1,'2009-05-26 21:06:51',10,30,44,'','2009-05-31 00:00:00',NULL),(32,11,'Taters','4.00',3,1,'2009-05-28 20:29:27',59,32,11,'default content','2009-05-28 00:00:00','2009-05-28 00:00:00'),(33,11,'Skinz','5.00',3,2,'2009-05-28 18:31:11',59,32,11,'default content','2009-05-28 00:00:00','2009-05-28 00:00:00'),(34,11,'Headlight','8.00',3,1,'2009-05-28 20:44:49',57,36,11,'default content','2009-05-28 00:00:00','2009-05-28 00:00:00'),(35,11,'Buy new Stones','0.00',3,1,'2009-05-28 19:06:15',57,33,11,'',NULL,NULL),(36,11,'Oil','4.00',3,1,'2009-06-04 20:49:42',10,31,44,'default content','2009-06-04 00:00:00','2009-06-04 00:00:00'),(43,11,'Calvin rocks the Jackson','3.00',3,1,'2009-06-26 00:03:13',7,NULL,NULL,'default content','2009-06-26 00:00:00','2009-06-26 00:00:00'),(47,11,'','0.00',3,1,'2009-07-02 20:08:14',10,NULL,NULL,'default content','2009-07-02 00:00:00','2009-07-02 00:00:00'),(48,11,'Forgot Password link throws \"500 Internal Server\" error message','0.00',3,1,'2009-07-02 21:54:36',62,NULL,NULL,'',NULL,NULL),(52,11,'moo the cow cow','0.00',3,1,'2009-07-16 23:21:31',7,NULL,NULL,'default content','2009-07-16 00:00:00','2009-07-16 00:00:00'),(53,11,'porn is nice','0.00',3,1,'2009-07-16 23:22:19',7,NULL,NULL,'default content','2009-07-16 00:00:00','2009-07-16 00:00:00'),(54,11,'moo moo the cow cow','0.00',3,1,'2009-07-16 23:52:23',7,NULL,NULL,'default content','2009-07-16 00:00:00','2009-07-16 00:00:00'),(55,11,'moo moo the cow cow cow','0.00',3,1,'2009-07-16 23:53:12',7,NULL,NULL,'default content','2009-07-16 00:00:00','2009-07-16 00:00:00'),(56,11,'wowowow','0.00',3,1,'2009-07-17 00:05:35',7,NULL,NULL,'default content','2009-07-17 00:00:00','2009-07-17 00:00:00'),(57,11,'wowow','0.00',3,1,'2009-07-17 00:06:13',7,NULL,NULL,'default content','2009-07-17 00:00:00','2009-07-17 00:00:00'),(79,11,'Hello Task','0.00',3,1,'2009-07-21 22:14:43',10,NULL,NULL,'default content','2009-07-21 00:00:00','2009-07-21 00:00:00'),(80,11,'Blue Balls','0.00',3,1,'2009-07-22 00:10:45',10,NULL,NULL,'default content','2009-07-22 00:00:00','2009-07-22 00:00:00'),(81,11,'Hello boo','0.00',3,1,'2009-07-22 00:38:11',10,NULL,NULL,'default content','2009-07-22 00:00:00','2009-07-22 00:00:00'),(82,11,'Test','0.00',3,1,'2009-07-22 00:41:48',10,NULL,NULL,'default content','2009-07-22 00:00:00','2009-07-22 00:00:00'),(83,11,'Test 22','0.00',3,1,'2009-07-22 00:43:03',10,NULL,NULL,'default content','2009-07-22 00:00:00','2009-07-22 00:00:00'),(84,11,'asdadsd','0.00',3,1,'2009-07-22 00:45:26',10,NULL,NULL,'default content','2009-07-22 00:00:00','2009-07-22 00:00:00'),(89,11,'Test 13','0.00',3,1,'2009-07-23 22:37:15',7,NULL,NULL,'default content','2009-07-23 00:00:00','2009-07-23 00:00:00'),(90,11,'Test 13','0.00',3,1,'2009-07-23 22:38:33',7,NULL,NULL,'default content','2009-07-23 00:00:00','2009-07-23 00:00:00'),(108,11,'Blue man','0.00',3,1,'2009-07-27 17:13:39',7,NULL,NULL,'default content','2009-07-27 00:00:00','2009-07-27 00:00:00'),(109,11,'toothie 8','0.00',3,1,'2009-07-27 17:17:25',7,NULL,NULL,'default content','2009-07-27 00:00:00','2009-07-27 00:00:00'),(110,11,'toothie 9','0.00',3,1,'2009-07-27 17:18:15',7,NULL,NULL,'default content','2009-07-27 00:00:00','2009-07-27 00:00:00'),(111,11,'toothie 10','0.00',3,1,'2009-07-27 17:28:16',7,NULL,NULL,'default content','2009-07-27 00:00:00','2009-07-27 00:00:00'),(112,11,'toothie 11','0.00',3,1,'2009-07-27 17:35:42',7,NULL,NULL,'default content','2009-07-27 00:00:00','2009-07-27 00:00:00'),(113,11,'Toothie 12','0.00',3,1,'2009-07-27 17:37:26',7,NULL,NULL,'default content','2009-07-27 00:00:00','2009-07-27 00:00:00'),(114,11,'Toothie 13','0.00',3,1,'2009-07-27 17:39:40',7,NULL,NULL,'default content','2009-07-27 00:00:00','2009-07-27 00:00:00'),(115,11,'Toothie 14','0.00',3,1,'2009-07-27 17:41:38',7,NULL,NULL,'default content','2009-07-27 00:00:00','2009-07-27 00:00:00'),(116,11,'ady\'s new task is really groovey','0.00',3,1,'2009-07-28 21:14:01',7,NULL,11,'default content','2009-07-28 00:00:00','2009-07-28 00:00:00'),(117,11,'ady\'s new task is really groovey part deux','0.00',3,1,'2009-07-28 21:15:16',7,NULL,11,'default content','2009-07-28 00:00:00','2009-07-28 00:00:00'),(118,11,'ady\'s new task is really groovey part deux','0.00',3,1,'2009-07-28 21:16:43',7,NULL,11,'default content','2009-07-28 00:00:00','2009-07-28 00:00:00'),(119,11,'ady\'s new task is really groovey part tre','0.00',3,1,'2009-07-28 21:31:18',7,NULL,11,'default content','2009-07-28 00:00:00','2009-07-28 00:00:00'),(120,11,'MInt julep','0.00',3,1,'2009-07-28 21:37:49',7,NULL,NULL,'default content','2009-07-28 00:00:00','2009-07-28 00:00:00'),(121,11,'hi ady','0.00',3,1,'2009-07-28 22:22:34',7,NULL,11,'default content','2009-07-28 00:00:00','2009-07-28 00:00:00'),(122,11,'','0.00',3,1,'2009-07-28 22:33:05',7,NULL,11,'default content','2009-07-28 00:00:00','2009-07-28 00:00:00'),(123,11,'hello','0.00',3,1,'2009-07-28 22:33:14',7,NULL,11,'default content','2009-07-28 00:00:00','2009-07-28 00:00:00'),(124,11,'hello there','0.00',3,1,'2009-07-28 22:34:02',7,NULL,11,'default content','2009-07-28 00:00:00','2009-07-28 00:00:00'),(125,11,'hi there','0.00',3,1,'2009-07-28 22:35:11',7,NULL,11,'default content','2009-07-28 00:00:00','2009-07-28 00:00:00'),(126,11,'hi there again','0.00',3,1,'2009-07-28 22:39:44',7,NULL,11,'default content','2009-07-28 00:00:00','2009-07-28 00:00:00'),(127,11,'and again','0.00',3,1,'2009-07-28 22:39:55',7,NULL,11,'default content','2009-07-28 00:00:00','2009-07-28 00:00:00'),(128,11,'almost done','0.00',3,1,'2009-07-28 22:41:20',7,NULL,11,'default content','2009-07-28 00:00:00','2009-07-28 00:00:00'),(129,11,'almost done is done','0.00',3,1,'2009-07-28 22:41:31',7,NULL,11,'default content','2009-07-28 00:00:00','2009-07-28 00:00:00'),(130,11,'almost done is done and done','0.00',3,1,'2009-07-28 22:41:47',7,NULL,11,'default content','2009-07-28 00:00:00','2009-07-28 00:00:00'),(131,11,'calvin plays tennis','0.00',3,1,'2009-07-28 22:42:19',7,NULL,11,'default content','2009-07-28 00:00:00','2009-07-28 00:00:00'),(132,11,'calvin plays tennis','0.00',3,1,'2009-07-28 22:57:31',7,NULL,11,'default content','2009-07-28 00:00:00','2009-07-28 00:00:00'),(133,11,'calvin plays tennis with lovely ladies','0.00',3,1,'2009-07-28 22:57:40',7,NULL,11,'default content','2009-07-28 00:00:00','2009-07-28 00:00:00'),(134,11,'calvin plays tennis with 5 gay bulgarian men','0.00',3,1,'2009-07-28 22:59:22',7,NULL,11,'default content','2009-07-28 00:00:00','2009-07-28 00:00:00'),(135,11,'calvin plays tennis with 2 homos from Nantucket','0.00',3,1,'2009-07-28 23:00:51',7,NULL,11,'default content','2009-07-28 00:00:00','2009-07-28 00:00:00'),(136,11,'calvin plays tennis with 2 homos from Nantucket','0.00',3,1,'2009-07-28 23:07:19',7,NULL,11,'default content','2009-07-28 00:00:00','2009-07-28 00:00:00'),(137,11,'hi calvin','0.00',3,1,'2009-07-30 22:57:47',7,NULL,11,'default content','2009-07-30 00:00:00','2009-07-30 00:00:00'),(138,11,'calvin rocks the boat','0.00',3,1,'2009-08-04 22:49:04',7,NULL,11,'default content','2009-08-04 00:00:00','2009-08-04 00:00:00'),(139,11,'calvin rocks the boat again','0.00',3,1,'2009-08-04 22:51:16',7,NULL,11,'default content','2009-08-04 00:00:00','2009-08-04 00:00:00'),(140,11,'this is what it\'s about!','0.00',3,1,'2009-08-04 22:51:28',7,NULL,11,'default content','2009-08-04 00:00:00','2009-08-04 00:00:00'),(141,11,'holy moly','0.00',3,1,'2009-08-04 22:52:01',7,NULL,11,'default content','2009-08-04 00:00:00','2009-08-04 00:00:00'),(142,11,'task name','0.00',3,1,'2009-08-04 22:54:10',7,NULL,11,'default content','2009-08-04 00:00:00','2009-08-04 00:00:00'),(143,11,'hi there','0.00',3,1,'2009-08-04 22:55:44',7,NULL,11,'default content','2009-08-04 00:00:00','2009-08-04 00:00:00'),(144,11,'ady loves hermaphrodites','0.00',3,1,'2009-08-04 22:58:37',7,NULL,11,'default content','2009-08-04 00:00:00','2009-08-04 00:00:00'),(145,11,'ady loves US Open','0.00',3,1,'2009-08-04 23:03:16',7,NULL,11,'default content','2009-08-04 00:00:00','2009-08-04 00:00:00'),(146,11,'ady loves US Open Balls','0.00',3,1,'2009-08-04 23:04:44',7,NULL,11,'default content','2009-08-04 00:00:00','2009-08-04 00:00:00'),(147,11,'us open balls','0.00',3,1,'2009-08-04 23:08:22',7,NULL,11,'default content','2009-08-04 00:00:00','2009-08-04 00:00:00'),(148,11,'ady\'s balls','0.00',3,1,'2009-08-04 23:10:02',7,NULL,11,'default content','2009-08-04 00:00:00','2009-08-04 00:00:00'),(149,11,'another balls','0.00',3,1,'2009-08-04 23:10:20',7,NULL,11,'default content','2009-08-04 00:00:00','2009-08-04 00:00:00'),(150,11,'another balls and more balls','0.00',3,1,'2009-08-04 23:10:28',7,NULL,11,'default content','2009-08-04 00:00:00','2009-08-04 00:00:00'),(151,11,'think this is fast','0.00',3,1,'2009-08-04 23:10:46',7,NULL,11,'default content','2009-08-04 00:00:00','2009-08-04 00:00:00'),(152,11,'this is faster than it looks','0.00',3,1,'2009-08-04 23:12:10',7,NULL,11,'default content','2009-08-04 00:00:00','2009-08-04 00:00:00'),(153,11,'ady loves balls','0.00',3,1,'2009-08-04 23:29:13',7,NULL,11,'default content','2009-08-04 00:00:00','2009-08-04 00:00:00'),(154,11,'balls','0.00',3,1,'2009-08-04 23:33:43',7,NULL,11,'default content','2009-08-04 00:00:00','2009-08-04 00:00:00'),(155,11,'ady loves hermaphros','0.00',3,1,'2009-08-04 23:50:50',7,NULL,11,'default content','2009-08-04 00:00:00','2009-08-04 00:00:00'),(156,11,'ady loves hermaphroshomos','0.00',3,1,'2009-08-04 23:54:09',7,NULL,11,'default content','2009-08-04 00:00:00','2009-08-04 00:00:00'),(157,11,'ady loves hermaphroshomoscosmos','0.00',3,1,'2009-08-04 23:55:21',7,NULL,11,'default content','2009-08-04 00:00:00','2009-08-04 00:00:00'),(158,11,'ady loves hermaphroshomoscosmosCal','0.00',3,1,'2009-08-04 23:55:32',7,NULL,11,'default content','2009-08-04 00:00:00','2009-08-04 00:00:00'),(159,11,'ady loves hermaphroshomoscosmosCalCal','0.00',3,1,'2009-08-04 23:55:38',7,NULL,11,'default content','2009-08-04 00:00:00','2009-08-04 00:00:00'),(160,11,'ady loves hermaphroshomoscosmosCalCalCal','0.00',3,1,'2009-08-04 23:55:55',7,NULL,11,'default content','2009-08-04 00:00:00','2009-08-04 00:00:00'),(161,11,'Cal is lookin\'','0.00',3,1,'2009-08-04 23:56:33',7,NULL,11,'default content','2009-08-04 00:00:00','2009-08-04 00:00:00'),(162,11,'dita has a new fan club','0.00',3,1,'2009-08-06 21:25:03',7,NULL,11,'default content','2009-08-06 00:00:00','2009-08-06 00:00:00'),(163,11,'dita has a new fan club','0.00',3,1,'2009-08-06 21:26:11',7,NULL,11,'default content','2009-08-06 00:00:00','2009-08-06 00:00:00'),(164,11,'fan club','0.00',3,1,'2009-08-06 21:26:33',7,NULL,11,'default content','2009-08-06 00:00:00','2009-08-06 00:00:00'),(165,11,'fthis is teh fan club','0.00',3,1,'2009-08-06 21:29:49',7,NULL,11,'default content','2009-08-06 00:00:00','2009-08-06 00:00:00'),(166,11,'fthis is teh fan club','0.00',3,1,'2009-08-06 21:33:53',7,NULL,11,'default content',NULL,'2009-08-06 00:00:00'),(167,11,'this is the fan club','0.00',3,1,'2009-08-06 21:36:14',7,NULL,11,'default content',NULL,'2009-08-06 00:00:00'),(168,11,'calvin has a fan club','0.00',3,1,'2009-08-06 21:38:28',7,NULL,11,'default content',NULL,'2009-08-06 00:00:00'),(169,11,'calvin has a fan club i believe','0.00',3,1,'2009-08-06 21:40:45',7,NULL,11,'default content',NULL,'2009-08-06 00:00:00'),(170,11,'calvin has a fan club i believe it\'s true','0.00',3,1,'2009-08-06 21:42:18',7,NULL,11,'default content',NULL,'2009-08-06 00:00:00'),(171,11,'we give ady a hard time','0.00',3,1,'2009-08-06 21:43:50',7,NULL,11,'default content','2008-07-09 00:00:00','2009-08-06 00:00:00'),(172,11,'we give calvin a hard time and he likes it','0.00',3,1,'2009-08-06 21:48:07',7,NULL,11,'default content','2008-07-09 00:00:00','2009-08-06 00:00:00'),(173,11,'ho man','0.00',3,1,'2009-08-06 21:51:46',7,NULL,11,'default content','2008-07-09 00:00:00','2009-08-06 00:00:00'),(174,11,'ho man','0.00',3,1,'2009-08-06 21:52:07',7,NULL,11,'default content','2008-07-09 00:00:00','2009-08-06 00:00:00'),(175,11,'whorey moly','0.00',3,1,'2009-08-06 21:56:42',7,NULL,11,'default content','2008-07-09 00:00:00','2009-08-06 00:00:00'),(176,11,'whorey moly','0.00',3,1,'2009-08-06 22:02:25',7,NULL,11,'default content',NULL,'2009-08-06 00:00:00'),(177,11,'moley','0.00',3,1,'2009-08-06 22:05:56',7,NULL,11,'default content',NULL,'2009-08-06 00:00:00'),(178,11,'whoa','0.00',3,1,'2009-08-06 22:07:11',7,NULL,11,'default content',NULL,'2009-08-06 00:00:00'),(179,11,'scorpions','0.00',3,1,'2009-08-06 22:08:45',7,NULL,11,'default content',NULL,'2009-08-06 00:00:00'),(180,11,'what was up with slash?','0.00',3,1,'2009-08-06 22:25:07',7,NULL,11,'default content','2009-08-06 00:00:00','2009-08-06 00:00:00'),(182,11,'slahs','0.00',3,1,'2009-08-06 22:26:12',7,NULL,11,'default content','2009-08-06 00:00:00','2009-08-06 00:00:00'),(183,11,'duffy','0.00',3,1,'2009-08-06 22:29:41',7,NULL,11,'default content','2009-08-06 00:00:00','2009-08-06 00:00:00'),(289,11,'','0.00',3,1,'2009-09-08 23:51:38',7,NULL,11,'default content','2009-09-08 00:00:00','2009-09-08 00:00:00'),(290,11,'hello','0.00',3,1,'2009-09-08 23:52:43',7,NULL,11,'default content','2009-09-08 00:00:00','2009-09-08 00:00:00'),(291,11,'hello there ady poops','0.00',3,1,'2009-09-09 00:12:31',7,NULL,11,'default content','2009-09-09 00:00:00','2009-09-09 00:00:00'),(296,11,'lkjh','0.00',3,1,'2009-09-10 23:14:31',7,NULL,11,'default content','2009-09-10 00:00:00','2009-09-10 00:00:00'),(297,11,'another one','0.00',3,1,'2009-09-10 23:35:29',7,NULL,11,'default content','2009-09-10 00:00:00','2009-09-10 00:00:00'),(301,11,'hello','0.00',3,1,'2009-09-13 22:01:05',11,NULL,11,'default content','2009-09-13 00:00:00','2009-09-13 00:00:00'),(320,11,'Kim Cloisters wins the U.S. Open','0.00',3,1,'2009-09-13 23:00:20',11,NULL,21,'Holy Moly - that\'s unbelievable...','2009-09-18 00:00:00','2009-09-13 00:00:00'),(321,11,'hello there','0.00',3,1,'2009-09-13 23:03:32',11,NULL,21,'Now I\'m putting in some descriptions for the tasks\n','2009-09-18 00:00:00','2009-09-13 00:00:00'),(322,11,'Hi there','0.00',3,1,'2009-09-13 23:07:31',44,NULL,11,'default content','2009-09-13 00:00:00','2009-09-13 00:00:00'),(323,11,'Calvin Poopy head','0.00',3,1,'2009-09-25 01:07:57',11,13,11,'','2009-09-25 00:00:00','2009-09-13 00:00:00'),(325,11,'lksdf ','0.00',3,1,'2009-09-14 00:16:39',11,NULL,11,'','2009-09-14 00:00:00','2009-09-14 00:00:00'),(327,11,'New task','0.00',3,1,'2009-09-15 22:59:24',7,3,11,'','2009-09-15 00:00:00','2009-09-15 00:00:00'),(328,11,'this is it','0.00',3,1,'2009-09-15 23:04:50',7,3,11,'','2009-09-15 00:00:00','2009-09-15 00:00:00'),(333,11,'come on you bitch','0.00',3,1,'2009-09-15 23:42:00',7,NULL,11,'','2009-09-15 00:00:00','2009-09-15 00:00:00'),(348,11,'Ady\'s the bomb as usual','0.00',3,1,'2009-09-16 00:00:29',7,NULL,11,'','2009-09-20 00:00:00','2009-09-15 00:00:00'),(349,11,'calvin','0.00',3,1,'2009-09-16 00:02:41',7,NULL,11,'','2009-09-28 00:00:00','2009-09-15 00:00:00'),(350,11,'calvin again','0.00',3,1,'2009-09-16 00:03:05',7,NULL,11,'','2009-09-16 00:00:00','2009-09-15 00:00:00'),(351,11,'w9wee','0.00',3,1,'2009-09-16 00:03:41',7,NULL,11,'','2009-09-17 00:00:00','2009-09-15 00:00:00'),(352,11,'task','0.00',3,1,'2009-09-16 00:04:50',7,3,11,'','2009-09-17 00:00:00','2009-09-16 00:00:00'),(353,11,'ping the pongy poo','0.00',3,1,'2009-09-16 00:06:53',7,3,11,'','2009-09-17 00:00:00','2009-09-16 00:00:00'),(354,11,'','0.00',3,1,'2009-09-16 00:07:47',7,3,11,'','2009-09-17 00:00:00','2009-09-16 00:00:00'),(355,11,'hello','0.00',3,1,'2009-09-16 00:08:30',7,3,11,'','2009-09-17 00:00:00','2009-09-16 00:00:00'),(356,11,'how about this one\"','0.00',3,1,'2009-09-16 00:08:45',7,5,11,'','2009-09-17 00:00:00','2009-09-16 00:00:00'),(357,11,'ady is dabomb','0.00',3,1,'2009-09-16 00:14:30',7,5,11,'','2009-09-17 00:00:00','2009-09-16 00:00:00'),(358,11,'ady rocks','0.00',3,1,'2009-09-16 00:23:24',7,NULL,11,'','2009-09-17 00:00:00','2009-09-16 00:00:00'),(359,11,'ady rocks the ponger','0.00',3,1,'2009-09-16 00:23:37',7,5,11,'','2009-09-17 00:00:00','2009-09-16 00:00:00'),(360,11,'wowee','0.00',3,1,'2009-09-16 00:25:10',7,5,11,'','2009-09-17 00:00:00','2009-09-16 00:00:00'),(361,11,'task name','0.00',3,1,'2009-09-16 00:25:18',7,5,11,'','2009-09-17 00:00:00','2009-09-16 00:00:00'),(362,11,'ady is dabomb','0.00',3,1,'2009-09-16 00:26:41',7,5,11,'','2009-09-17 00:00:00','2009-09-16 00:00:00'),(363,11,'Calvin creates a vajayjay','0.00',3,1,'2009-09-16 00:27:40',7,20,21,'This vajajay will impress your friends!!!','2009-11-17 00:00:00','2009-09-16 00:00:00'),(364,11,'I can\'t believe this works now','0.00',3,1,'2009-09-16 10:27:19',7,10,21,'','2009-11-17 00:00:00','2009-09-16 00:00:00'),(366,11,'hello there','0.00',3,1,'2009-09-22 23:16:47',11,NULL,11,'','2009-09-22 00:00:00','2009-09-22 00:00:00'),(368,11,'Hello there dude finish this','0.00',3,1,'2009-10-14 00:15:28',11,13,11,'','2009-10-14 00:00:00','2009-09-24 00:00:00'),(369,11,'no milestone','0.00',3,1,'2009-09-24 23:11:07',11,NULL,21,'','2009-09-24 00:00:00','2009-09-24 00:00:00'),(370,11,'damnit','0.00',3,1,'2009-09-24 23:11:33',11,NULL,21,'','2009-09-24 00:00:00','2009-09-24 00:00:00'),(371,11,'holy','0.00',3,1,'2009-09-24 23:12:03',11,NULL,21,'','2009-09-24 00:00:00','2009-09-24 00:00:00'),(372,11,'hello there milestone lucent','0.00',3,1,'2009-09-24 23:40:10',11,18,21,'','2009-09-24 00:00:00','2009-09-24 00:00:00'),(373,11,'no milestone bitches','0.00',3,1,'2009-09-24 23:40:36',11,NULL,21,'','2009-09-24 00:00:00','2009-09-24 00:00:00'),(374,11,'Calvin Pooper','0.00',1,1,'2009-09-25 01:10:28',11,18,11,'','2009-09-25 00:00:00',NULL),(379,11,'howadoody','0.00',1,1,'2009-09-30 00:08:26',11,13,11,'','2009-09-30 00:00:00',NULL),(381,11,'booboo adding','0.00',1,1,'2009-09-30 00:21:11',11,13,11,'','2009-09-30 00:00:00',NULL),(384,11,'calvin rocks the bumski','0.00',1,1,'2009-09-30 00:48:15',11,21,11,'','2009-09-30 00:00:00',NULL),(385,11,'the feature is not the killer feiurua','0.00',1,1,'2009-10-01 23:40:08',10,NULL,11,'','2009-10-01 00:00:00',NULL),(386,11,'prep bike for track day','0.00',1,1,'2009-10-01 23:41:10',10,25,11,'','2009-10-01 00:00:00',NULL),(387,11,'booboobaby','0.00',1,1,'2009-10-06 22:42:34',11,13,11,'','2009-10-06 00:00:00',NULL),(388,11,'ady rules','0.00',1,1,'2009-10-11 21:25:51',11,13,11,'','2009-10-11 00:00:00',NULL),(389,11,'prosthetic task','0.00',1,1,'2009-10-11 22:54:38',11,NULL,21,'','2009-10-11 00:00:00',NULL),(390,11,'hello','0.00',1,1,'2009-10-11 23:49:58',20,NULL,11,'','2009-10-11 00:00:00',NULL),(391,11,'robert heath is awesome','0.00',3,1,'2009-11-04 10:49:55',10,NULL,11,'','2009-11-04 00:00:00','2009-11-04 00:00:00'),(392,11,'hello','0.00',3,1,'2009-11-04 10:50:05',10,25,11,'','2009-11-04 00:00:00','2009-11-04 00:00:00'),(393,11,'hello','0.00',3,1,'2009-11-04 10:50:12',10,25,11,'','2009-11-04 00:00:00','2009-11-04 00:00:00'),(394,11,'task n ame','0.00',3,1,'2009-11-04 10:50:20',10,25,11,'','2009-11-04 00:00:00','2009-11-04 00:00:00'),(395,11,'heath','0.00',3,1,'2009-11-04 10:50:39',10,NULL,11,'','2009-11-04 00:00:00','2009-11-04 00:00:00'),(396,11,'hiya','0.00',3,1,'2009-11-06 00:51:50',10,NULL,11,'','2009-11-05 00:00:00','2009-11-05 00:00:00');
/*!40000 ALTER TABLE `task` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `team`
--

DROP TABLE IF EXISTS `team`;
CREATE TABLE `team` (
  `team_id` int(11) NOT NULL auto_increment,
  `project_id` int(11) NOT NULL,
  `name` varchar(120) NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY  (`team_id`),
  KEY `project_id_idx` (`project_id`),
  CONSTRAINT `team_ibfk_1` FOREIGN KEY (`project_id`) REFERENCES `project` (`project_id`)
) ENGINE=InnoDB AUTO_INCREMENT=60 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `team`
--

LOCK TABLES `team` WRITE;
/*!40000 ALTER TABLE `team` DISABLE KEYS */;
INSERT INTO `team` VALUES (13,11,'DEFAULT','2009-05-07 23:13:51'),(14,13,'DEFAULT','2009-05-08 17:24:49'),(15,7,'DEFAULT','2009-05-10 20:32:28'),(16,10,'DEFAULT','2009-05-10 20:35:01'),(17,20,'DEFAULT','2009-05-15 00:11:58'),(18,21,'DEFAULT','2009-05-15 00:13:20'),(19,22,'DEFAULT','2009-05-15 00:13:28'),(20,23,'DEFAULT','2009-05-15 00:29:24'),(21,24,'DEFAULT','2009-05-15 00:31:13'),(22,25,'DEFAULT','2009-05-15 00:36:32'),(23,26,'DEFAULT','2009-05-15 00:39:44'),(24,27,'DEFAULT','2009-05-15 00:41:55'),(25,28,'DEFAULT','2009-05-15 00:42:47'),(26,29,'DEFAULT','2009-05-15 00:49:14'),(27,30,'DEFAULT','2009-05-15 00:51:08'),(28,31,'DEFAULT','2009-05-15 00:53:03'),(29,32,'DEFAULT','2009-05-15 00:56:41'),(30,33,'DEFAULT','2009-05-15 00:58:15'),(31,34,'DEFAULT','2009-05-15 01:05:26'),(32,35,'DEFAULT','2009-05-15 01:08:33'),(33,36,'DEFAULT','2009-05-15 01:08:35'),(34,37,'DEFAULT','2009-05-15 01:10:16'),(35,38,'DEFAULT','2009-05-15 01:10:37'),(36,39,'DEFAULT','2009-05-17 21:36:40'),(37,40,'DEFAULT','2009-05-17 22:05:43'),(38,41,'DEFAULT','2009-05-17 22:19:46'),(39,42,'DEFAULT','2009-05-17 22:25:58'),(40,43,'DEFAULT','2009-05-17 23:18:38'),(41,44,'DEFAULT','2009-05-18 17:52:37'),(42,45,'DEFAULT','2009-05-18 18:36:55'),(43,46,'DEFAULT','2009-05-18 18:38:04'),(44,47,'DEFAULT','2009-05-18 18:39:11'),(45,48,'DEFAULT','2009-05-18 16:44:27'),(46,49,'DEFAULT','2009-05-18 19:46:03'),(47,50,'DEFAULT','2009-05-18 19:47:13'),(48,51,'DEFAULT','2009-05-19 22:25:36'),(49,52,'DEFAULT','2009-05-21 18:09:02'),(50,53,'DEFAULT','2009-05-21 18:10:30'),(51,54,'DEFAULT','2009-05-21 18:11:33'),(53,56,'DEFAULT','2009-05-21 20:35:50'),(54,57,'DEFAULT','2009-05-21 20:54:30'),(56,59,'DEFAULT','2009-05-26 20:38:57'),(57,60,'DEFAULT','2009-06-01 23:47:46'),(58,61,'DEFAULT','2009-06-30 22:51:15'),(59,62,'DEFAULT','2009-07-02 21:53:09');
/*!40000 ALTER TABLE `team` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `team_user`
--

DROP TABLE IF EXISTS `team_user`;
CREATE TABLE `team_user` (
  `team_id` int(11) NOT NULL auto_increment,
  `user_id` int(11) NOT NULL default '0',
  `created` datetime NOT NULL,
  `user_role_id` int(11) default NULL,
  PRIMARY KEY  (`team_id`,`user_id`),
  KEY `user_role_id_idx` (`user_role_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `team_user_ibfk_3` FOREIGN KEY (`team_id`) REFERENCES `team` (`team_id`),
  CONSTRAINT `team_user_ibfk_1` FOREIGN KEY (`user_role_id`) REFERENCES `user_role` (`role_id`),
  CONSTRAINT `team_user_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `sf_guard_user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `team_user`
--

LOCK TABLES `team_user` WRITE;
/*!40000 ALTER TABLE `team_user` DISABLE KEYS */;
/*!40000 ALTER TABLE `team_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `user_id` int(11) NOT NULL auto_increment,
  PRIMARY KEY  (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_account`
--

DROP TABLE IF EXISTS `user_account`;
CREATE TABLE `user_account` (
  `user_id` int(11) NOT NULL default '0',
  `created` datetime NOT NULL,
  `first_name` varchar(255) default NULL,
  `last_name` varchar(255) default NULL,
  `email` varchar(255) default NULL,
  PRIMARY KEY  (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_account`
--

LOCK TABLES `user_account` WRITE;
/*!40000 ALTER TABLE `user_account` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_account` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_address`
--

DROP TABLE IF EXISTS `user_address`;
CREATE TABLE `user_address` (
  `address_id` int(11) NOT NULL default '0',
  `user_id` int(11) NOT NULL default '0',
  `created` datetime NOT NULL,
  `type` varchar(25) default NULL,
  PRIMARY KEY  (`address_id`,`user_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `user_address_ibfk_2` FOREIGN KEY (`address_id`) REFERENCES `address` (`address_id`),
  CONSTRAINT `user_address_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `sf_guard_user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_address`
--

LOCK TABLES `user_address` WRITE;
/*!40000 ALTER TABLE `user_address` DISABLE KEYS */;
INSERT INTO `user_address` VALUES (1,2,'2009-04-09 22:37:56','PRIMARY'),(2,3,'2009-04-09 22:47:12','PRIMARY'),(3,4,'2009-04-10 16:44:36','PRIMARY'),(6,7,'2009-04-14 21:42:28','PRIMARY'),(7,8,'2009-04-14 21:47:31','PRIMARY'),(8,9,'2009-04-14 21:52:26','PRIMARY'),(9,10,'2009-04-14 21:53:43','PRIMARY'),(10,11,'2009-04-14 22:12:53','PRIMARY'),(11,12,'2009-04-14 22:36:40','PRIMARY'),(12,13,'2009-04-14 22:40:49','PRIMARY'),(15,16,'2009-04-27 00:35:34','PRIMARY'),(16,17,'2009-04-28 23:47:39','PRIMARY'),(17,18,'2009-04-30 19:49:27','PRIMARY'),(18,19,'2009-05-05 23:28:20','PRIMARY'),(19,20,'2009-05-05 23:42:55','PRIMARY'),(20,21,'2009-05-07 21:32:09','PRIMARY'),(21,22,'2009-05-07 21:38:31','PRIMARY'),(22,23,'2009-05-07 19:51:10','PRIMARY'),(36,37,'2009-05-07 23:13:50','PRIMARY'),(37,38,'2009-05-07 23:29:20','PRIMARY'),(38,39,'2009-05-07 23:29:39','PRIMARY'),(40,41,'2009-05-14 23:05:29','PRIMARY'),(41,42,'2009-05-21 20:21:21','PRIMARY'),(42,43,'2009-05-21 22:08:02','PRIMARY'),(43,44,'2009-05-24 12:27:40','PRIMARY');
/*!40000 ALTER TABLE `user_address` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_email`
--

DROP TABLE IF EXISTS `user_email`;
CREATE TABLE `user_email` (
  `email_id` int(11) NOT NULL default '0',
  `user_id` int(11) NOT NULL default '0',
  `sequence` int(11) NOT NULL default '1',
  `created` datetime NOT NULL,
  PRIMARY KEY  (`email_id`,`user_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `user_email_ibfk_2` FOREIGN KEY (`email_id`) REFERENCES `email` (`email_id`),
  CONSTRAINT `user_email_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `sf_guard_user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_email`
--

LOCK TABLES `user_email` WRITE;
/*!40000 ALTER TABLE `user_email` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_email` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_group`
--

DROP TABLE IF EXISTS `user_group`;
CREATE TABLE `user_group` (
  `group_id` int(11) NOT NULL default '0',
  `user_id` int(11) NOT NULL default '0',
  PRIMARY KEY  (`group_id`,`user_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `user_group_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `sf_guard_user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_group`
--

LOCK TABLES `user_group` WRITE;
/*!40000 ALTER TABLE `user_group` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_group` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_phone`
--

DROP TABLE IF EXISTS `user_phone`;
CREATE TABLE `user_phone` (
  `phone_id` int(11) NOT NULL default '0',
  `user_id` int(11) NOT NULL default '0',
  `created` datetime NOT NULL,
  PRIMARY KEY  (`phone_id`,`user_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `user_phone_ibfk_2` FOREIGN KEY (`phone_id`) REFERENCES `phone` (`phone_id`),
  CONSTRAINT `user_phone_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `sf_guard_user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_phone`
--

LOCK TABLES `user_phone` WRITE;
/*!40000 ALTER TABLE `user_phone` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_phone` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_profile`
--

DROP TABLE IF EXISTS `user_profile`;
CREATE TABLE `user_profile` (
  `profile_id` int(11) NOT NULL auto_increment,
  `user_id` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `street_1` varchar(255) default NULL,
  `street_2` varchar(255) default NULL,
  `city` varchar(255) default NULL,
  `state` varchar(255) default NULL,
  `zip` varchar(48) default NULL,
  `country` varchar(48) default NULL,
  PRIMARY KEY  (`profile_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_profile`
--

LOCK TABLES `user_profile` WRITE;
/*!40000 ALTER TABLE `user_profile` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_profile` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_role`
--

DROP TABLE IF EXISTS `user_role`;
CREATE TABLE `user_role` (
  `role_id` int(11) NOT NULL default '0',
  `role_name` varchar(240) NOT NULL,
  `role_category` varchar(240) default NULL,
  PRIMARY KEY  (`role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_role`
--

LOCK TABLES `user_role` WRITE;
/*!40000 ALTER TABLE `user_role` DISABLE KEYS */;
INSERT INTO `user_role` VALUES (1,'ACCOUNT_OWNER','ACCOUNT'),(2,'ACCOUNT_USER','ACCOUNT');
/*!40000 ALTER TABLE `user_role` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_type`
--

DROP TABLE IF EXISTS `user_type`;
CREATE TABLE `user_type` (
  `type_id` int(11) NOT NULL default '0',
  `type` varchar(48) NOT NULL,
  `description` varchar(255) default NULL,
  PRIMARY KEY  (`type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_type`
--

LOCK TABLES `user_type` WRITE;
/*!40000 ALTER TABLE `user_type` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `user_id` int(10) unsigned NOT NULL auto_increment,
  `user` varchar(30) NOT NULL default '',
  `name` varchar(60) NOT NULL default '',
  `email` varchar(60) NOT NULL default '',
  `title` set('site creator','editor','contributing editor','contributor','past contributor') NOT NULL default '',
  `bio` text NOT NULL,
  `favorites` text NOT NULL,
  `favorites_date` datetime NOT NULL default '0000-00-00 00:00:00',
  `ofcs` enum('0','1') NOT NULL default '0',
  `reg_date` datetime NOT NULL default '0000-00-00 00:00:00',
  `last_active` datetime NOT NULL default '0000-00-00 00:00:00',
  `auth` enum('1','2','3','4','5') NOT NULL default '1',
  `active` enum('0','1') NOT NULL default '0',
  PRIMARY KEY  (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=47 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Rumsey','Rumsey Taylor','rumsey@notcoming.com','site creator,editor','Rumsey is a web designer, and resides in Boston, MA. He mourns the loss of <a href=\"http://www.cinemasmith.net/hardtofind.htm\">Cinemasmith</a>.','<p>The final shot of <em>Starman</em>. The final scene in <em>Sweetie</em>. And the final credits sequence of <em>Buckaroo Banzai</em>.</p>','2008-09-15 19:16:51','0','2004-07-20 15:32:28','2004-07-20 15:32:28','5','1'),(35,'Cullen','Cullen Gallagher','','contributing editor','Cullen is a Brooklyn-based film critic whose writing has also appeared in The L Magazine, Moving Image Source, Reverse Shot, The Brooklyn Rail, and Guitar Review. He also writes about vintage crime fiction and pulp novels at <a href=\"http://www.pulpserenade.blogspot.com\">http://www.pulpserenade.blogspot.com</a> and has a dish named after him at his local diner.','<p>The Life of the Party, Hellzapoppin&#39;, It&#39;s Love I&#39;m After, The Fatal Glass of Beer, Summertime, Caught, Lovefilm, The River, Intimate Lighting, Playtime, The Green Ray, Amarcord, An Autumn Afternoon, Goodbye Again, All Fall Down, Brief Encounter, and so many more.</p>','2009-05-13 20:26:21','0','0000-00-00 00:00:00','0000-00-00 00:00:00','3','1'),(36,'Katherine','Katherine Follett','katefollett@yahoo.com','contributing editor','Katherine is a freelance writer living in Boston. She is currently working on her third screenplay, which is about a necrophiliac who becomes a zombie. No kidding.','<p>Withnail and I\nRepo Man\nThe Big Lebowski\nDeathrace 2000\nBeavis and Butt-Head Do America</p>','2008-04-25 09:07:37','0','0000-00-00 00:00:00','0000-00-00 00:00:00','3','1'),(32,'Francis','Francis Cruz','','past contributor','','','0000-00-00 00:00:00','0','0000-00-00 00:00:00','0000-00-00 00:00:00','1','1'),(33,'Victoria','Victoria Large','','contributing editor','','','0000-00-00 00:00:00','0','0000-00-00 00:00:00','0000-00-00 00:00:00','3','1'),(31,'Megan','Megan Weireter','','editor','Megan lives in Boston, where she watches Showgirls and Labyrinth over and over again. She also blogs about the Beatles at http://beatles-365.blogspot.com.','','2009-01-19 06:21:21','0','0000-00-00 00:00:00','0000-00-00 00:00:00','4','1'),(2,'Matt','Matt Bailey','matt@notcoming.com','contributor','Matt is a librarian and loves British female-led post-punk groups of the early 1980s.','<p>On 1/18/04 7:24 PM, &#8220;Matt Bailey&#8221; wrote:</p>\r\n<p>I&#8217;m not submitting a list and would like to take this opportunity to announce my retirement from making lists of my favorite movies. In preparation for this feature, as I looked over the list I made just last year of my top twenty films, I realized that there were many films that I truly, honestly, and unabashedly love missing from the list, and in their place films that I might have put on the list simply because I felt they needed to be on the list. In attempting to rectify these injustices, I became even more conflicted. How could I quantify and compare the very different pleasures given to me by such diverse films as <em>The Exorcist</em> and <em>Cleo from 5 to 7</em>? <em>Scorpio Rising</em> and <em>Twentieth Century</em>? What possible rationale could I use to select one Luis Bu&ntilde;uel or Robert Bresson film over another? How would I reconcile my need to make a list that reflects the refined taste of someone who writes on film and has an advanced degree in the field with the fact that Don Knotts makes me laugh really, really hard and that I&#8217;ve seen <em>Auntie Mame</em> somewhere around 25 times? How do I finalize something that will remain static and public for some time to come when, in reality, it changes every day? How do I defend a list against criticism when I am perhaps the person most critical of it? The more I looked at my list, the more I realized that the answer to all of these questions is, &#8220;I can&#8217;t.&#8221; So, I&#8217;m throwing in the towel. I like what I like and I don&#8217;t feel a need to quantify and qualify it. I&#8217;m not saying that making lists isn&#8217;t fun or worthwhile. It&#8217;s just that I am no longer mentally prepared to tell Murnau or Antonioni that they didn&#8217;t make the cut this time around.</p>\r\n<p>Matt</p>','2005-05-18 18:53:32','0','2004-07-20 15:34:19','2004-07-20 15:34:19','2','1'),(3,'Leo','Leo Goldsmith','leo@notcoming.com','editor','Leo has also written for <em><a href=\"http://www.reverseshot.com\">Reverse Shot</a></em>, <em><a href=\"http://www.indiewire.com\">indieWire</a></em>, <em><a href=\"http://www.movingimagesource.us/articles/the-peoples-director-20081211\">Moving Image Source</a></em>, and <em>The Village Voice</em>. He has a band called <a href=\"http://www.myspace.com/littlefurythingsrecords\">Christian Science Minotaur</a>.','','2009-05-04 21:10:21','0','2004-07-20 15:35:47','2004-07-20 15:35:47','4','1'),(26,'Thomas','Thomas Scalzo','thomas@notcoming.com','contributing editor','Thomas is coauthor of <a href=\"http://www.amazon.com/gp/product/0595378862\"><em>ShockJune/ShockJanuary: A Smorgasbord of Horror</em></a>, proud cast member of <a href=\"http://www.filmbaby.com/films/2337\"><em>Freaky Farley</em></a> and the forthcoming <a href=\"http://www.youtube.com/watch?v=YQSNjtlGdx4\"><em>Monsters, Marriage &amp; Murder in Manchvegas</em></a>, and one-half of the most prolific songwriting duo in the universe, <a href=\"http://www.moeshaven.com\"><em>Moes Haven</em></a>.','','2009-01-10 13:33:29','0','2006-02-14 11:07:47','0000-00-00 00:00:00','3','1'),(30,'Eva','Eva Holland','eva.jt.holland@gmail.com','contributing editor','Eva is a freelance travel writer who&rsquo;s visited movie theaters in 6 countries. She writes about the intersection of travel and pop culture, and reviews road movies old and new, at <a href=\"http://www.worldhum.com\">World Hum</a> and blogs about chick flicks at <a href=\"http://thegoodthebadthefugly.blogspot.com\">thegoodthebadthefugly.blogspot.com</a>.','','2009-01-04 21:34:50','0','0000-00-00 00:00:00','0000-00-00 00:00:00','3','1'),(5,'David','David Carter','david@shockingimages.com','contributing editor','David is saddened that there was never a sequel to Aerobicide (aka Killer Workout).','<p><em>El Topo</em>, <em>The Holy Mountain</em>, and every film Andy Sidaris ever made.</p>','2008-12-21 16:14:18','0','2004-07-20 16:11:15','2004-07-20 16:11:15','3','1'),(6,'Marcus','Marcus Gilmer','','past contributor','','','0000-00-00 00:00:00','0','2004-07-20 16:13:05','2004-07-20 16:13:05','1','1'),(7,'Charles','Charles Hartney','','past contributor','','','0000-00-00 00:00:00','','2004-07-20 16:13:25','2004-07-20 16:13:25','1','1'),(8,'Dave','Dave Macchia','','past contributor','','','0000-00-00 00:00:00','','2004-07-20 16:13:45','2004-07-20 16:13:45','1','1'),(9,'Moira','Moira Sullivan','','past contributor','','','0000-00-00 00:00:00','','2004-07-20 16:14:05','2004-07-20 16:14:05','1','1'),(10,'Wenkai','Wenkai Tay','','past contributor','','','0000-00-00 00:00:00','','2004-07-20 16:14:34','2004-07-20 16:14:34','1','1'),(11,'Marlin','Marlin Tyree','','past contributor','','','2007-04-21 11:18:33','0','2004-07-20 16:14:53','2004-07-20 16:14:53','1','1'),(12,'Rachel','Rachel Lears','','past contributor','','','0000-00-00 00:00:00','0','2004-07-23 18:31:07','2004-07-23 18:31:07','1','1'),(14,'Martha','Martha Fischer','','past contributor','','','0000-00-00 00:00:00','0','2004-12-05 12:09:23','0000-00-00 00:00:00','1','1'),(4,'Beth','Beth Gilligan','','past contributor','','','2005-08-02 08:33:28','0','2004-12-14 06:08:55','0000-00-00 00:00:00','1','1'),(34,'Evan','Evan Kindley','evankindley@gmail.com','contributing editor','Evan Kindley is a graduate student in English at Princeton University and splits his time between New Jersey and New York.  He hates writing the second, &ldquo;funny&rdquo; sentence of bios.','','2008-04-07 05:11:00','0','0000-00-00 00:00:00','0000-00-00 00:00:00','3','1'),(13,'Rich','Rich Watts','rich@arbitraryconstant.co.uk','past contributor','Based in London in the UK, Rich watches films in what he laughingly calls his spare time.','','2005-05-18 18:53:32','0','2004-12-03 18:48:51','0000-00-00 00:00:00','1','1'),(16,'Jason','Jason Woloski','jason@notcoming.com','past contributor','Jason lives in Halifax, Canada.','','2005-08-16 20:17:14','0','2005-03-16 17:21:12','0000-00-00 00:00:00','1','1'),(20,'Ian','Ian Johnston','nzt@ms27.hinet.net','contributing editor','Ian is a New Zealander, living in Taipei, Taiwan.','','2005-11-07 16:55:39','','0000-00-00 00:00:00','0000-00-00 00:00:00','3','1'),(37,'Timothy','Timothy Sun','','contributing editor','','','0000-00-00 00:00:00','0','0000-00-00 00:00:00','0000-00-00 00:00:00','3','1'),(21,'Chiranjit','Chiranjit Goswami','jit@notcoming.com','contributor','Chiranjit is reading <em>Schulz and Peanuts: A Biography</em> by David Michaelis while waiting for his MoC Naruse DVD Boxset and his BFI <em>Bigger than Life</em> DVD to arrive.','','2007-12-05 11:56:01','0','0000-00-00 00:00:00','0000-00-00 00:00:00','2','1'),(22,'Jenny','Jenny Jediny','jenny@notcoming.com','editor','Jenny also works at a repertory theater in New York City.','','2008-06-14 07:07:55','','0000-00-00 00:00:00','0000-00-00 00:00:00','4','1'),(23,'Tom','Tom Huddleston','','past contributor','Tom is currently busy writing a bio for this website.','','2006-02-09 03:26:30','0','0000-00-00 00:00:00','0000-00-00 00:00:00','1','1'),(24,'Alan','Alan Hogue','','past contributor','','','0000-00-00 00:00:00','0','0000-00-00 00:00:00','0000-00-00 00:00:00','1','1'),(29,'Teddy','Teddy Blanks','tedblanks@gmail.com','contributor','Teddy Blanks is a graphic designer at <a href=\"http://www.winterhouse.com\" target=\"_blank\">Winterhouse Studio</a> in northwest Connecticut. He can also be seen in New York and Richmond, VA, singing with his band, <a href=\"http://www.thegaskets.com\" target=\"_blank\">Gaskets</a>.','','2008-01-10 19:47:19','0','0000-00-00 00:00:00','0000-00-00 00:00:00','2','1'),(25,'Adam','Adam Balz','adam@notcoming.com','contributing editor','Adam lives in Green Bay, WI.','','2007-12-12 06:15:43','','0000-00-00 00:00:00','0000-00-00 00:00:00','3','1'),(27,'Paul','Paul Garcia','','past contributor','','','0000-00-00 00:00:00','0','0000-00-00 00:00:00','0000-00-00 00:00:00','1','1'),(28,'Jack','Jack Gardner','','past contributor','','','0000-00-00 00:00:00','0','0000-00-00 00:00:00','0000-00-00 00:00:00','1','1'),(39,'Stephen','Stephen Snart','stephensnart@gmail.com','contributing editor','Stephen Snart holds a BA in Cinema Studies from New York University and a MA in Contemporary Cinema Cultures from King&rsquo;s College London. His dissertation examined the tension between the real and the artificial in cinema through analysis of the gross-out comedy. Stephen currently resides in New Jersey but divides his time evenly between the Garden State and Manhattan. He thanks Bruce Springsteen, not Zach Braff, for giving him the pride to claim his New Jersey heritage.','<p>Ferris Bueller&#39;s Day Off, Annie Hall, Rear Window, Day for Night, Les Diaboliques</p>','2009-01-31 11:59:52','0','0000-00-00 00:00:00','0000-00-00 00:00:00','3','1'),(38,'Chet','Chet Mellema','','contributing editor','','','0000-00-00 00:00:00','0','0000-00-00 00:00:00','0000-00-00 00:00:00','3','1'),(40,'Andrew','Andrew Schenker','schenker1980@gmail.com','contributor','Andrew Schenker is a freelance writer based in New York. In addition to <em>Not Coming</em>, he contributes regularly to <em>Slant Magazine</em> and <em>The House Next Door</em> and publishes the blog, <a href=\"http://aschenker.blogspot.com\"><em>The Cine File</em></a>.','','2008-06-18 16:22:52','0','0000-00-00 00:00:00','0000-00-00 00:00:00','2','1'),(42,'Sarah','Sarah Boslaugh','','past contributor','','','0000-00-00 00:00:00','0','0000-00-00 00:00:00','0000-00-00 00:00:00','1','1'),(43,'Simon','Simon Augustine','simonpaugustine@aol.com','contributor','Simon is a graduate of Harvard Divinity School and has also contributed to GreenCine and Stop Smiling. Writing poetry, Zen meditation, and watching movies are among his four most favorite things to do.','<p>Billy Jack \n2001: A Space Odyssey \nBeautiful Dreamers\nThe Wanderers \nAltered States \nSpring, Summmer, Fall, Winter&hellip;and Spring\nMeatballs</p>','2008-10-26 20:15:48','0','0000-00-00 00:00:00','0000-00-00 00:00:00','2','1'),(44,'Brendon','Brendon Bouzard','','past contributor','','','0000-00-00 00:00:00','0','0000-00-00 00:00:00','0000-00-00 00:00:00','1','1'),(45,'Aaron','Aaron Cutler','','past contributor','','','0000-00-00 00:00:00','0','0000-00-00 00:00:00','0000-00-00 00:00:00','1','1'),(46,'Sam','Sam Bett','','contributor','','','0000-00-00 00:00:00','0','0000-00-00 00:00:00','0000-00-00 00:00:00','2','1');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2009-11-11  4:51:55
