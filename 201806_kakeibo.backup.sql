-- MySQL dump 10.13  Distrib 5.6.38, for Linux (x86_64)
--
-- Host: localhost    Database: kakeibo
-- ------------------------------------------------------
-- Server version	5.6.38

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
-- Table structure for table `bankInOut`
--

DROP TABLE IF EXISTS `bankInOut`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bankInOut` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `yyyy` int(11) DEFAULT NULL,
  `mm` int(11) DEFAULT NULL,
  `dd` int(11) DEFAULT NULL,
  `sisyutu_type` int(11) DEFAULT NULL,
  `sisyutu_name` varchar(45) DEFAULT NULL,
  `kingaku` int(11) DEFAULT NULL,
  `biko` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=83 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bankInOut`
--

LOCK TABLES `bankInOut` WRITE;
/*!40000 ALTER TABLE `bankInOut` DISABLE KEYS */;
INSERT INTO `bankInOut` VALUES (77,2018,3,28,1,'',9000,''),(78,2018,3,23,1,'',9000,''),(79,2018,4,8,1,'',9000,''),(80,2018,5,1,1,'',9000,''),(81,2018,5,9,1,'',9000,''),(82,2018,5,19,1,'',6000,'');
/*!40000 ALTER TABLE `bankInOut` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `level1_spending`
--

DROP TABLE IF EXISTS `level1_spending`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `level1_spending` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `level_id` int(11) DEFAULT NULL,
  `money_name` text,
  `money` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=58 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `level1_spending`
--

LOCK TABLES `level1_spending` WRITE;
/*!40000 ALTER TABLE `level1_spending` DISABLE KEYS */;
INSERT INTO `level1_spending` VALUES (1,NULL,'月末用1',24000),(2,NULL,'jcb（月中）',36000),(3,NULL,'引き出しての出費',26200),(50,NULL,'家賃',45000),(52,NULL,'電話代',8000),(56,NULL,'11cc',22001),(57,NULL,'aaa',133);
/*!40000 ALTER TABLE `level1_spending` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `level2_spending`
--

DROP TABLE IF EXISTS `level2_spending`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `level2_spending` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `level1_id` int(11) DEFAULT NULL,
  `sort` int(10) unsigned DEFAULT NULL,
  `money_name` text,
  `money` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=89 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `level2_spending`
--

LOCK TABLES `level2_spending` WRITE;
/*!40000 ALTER TABLE `level2_spending` DISABLE KEYS */;
INSERT INTO `level2_spending` VALUES (12,2,3,'ジム代',13000),(13,2,5,'色々',5000),(14,2,1,'定期代',8000),(15,2,2,'保険',3000),(27,3,3,'定期代',6500),(28,3,1,'理容院',4500),(29,3,2,'薬',7000),(54,2,4,'カード調整',7000),(58,1,1,'生活支援',11000),(59,1,3,'保険',4000),(60,1,2,'ヨドバシ',9000),(63,50,1,'家賃',45000),(64,3,5,'自転車定期',2200),(65,3,4,'電気・ガス・水道',6000),(73,52,1,'電話代',8000),(77,56,2,'あああ',12000),(82,58,1,'aa',10001),(83,58,2,'aa',1000),(84,58,3,'aab',1000),(85,56,1,'いいい',10001),(86,57,1,'qqq',11),(87,57,3,'qqq',11),(88,57,2,'qqq2',111);
/*!40000 ALTER TABLE `level2_spending` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sisyutu`
--

DROP TABLE IF EXISTS `sisyutu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sisyutu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `yyyy` int(11) DEFAULT NULL,
  `mm` int(11) DEFAULT NULL,
  `dd` int(11) DEFAULT NULL,
  `sisyutu_type` int(11) DEFAULT NULL,
  `sisyutu_name` varchar(45) DEFAULT NULL,
  `kingaku` int(11) DEFAULT NULL,
  `biko` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=90 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sisyutu`
--

LOCK TABLES `sisyutu` WRITE;
/*!40000 ALTER TABLE `sisyutu` DISABLE KEYS */;
INSERT INTO `sisyutu` VALUES (4,2018,NULL,NULL,NULL,NULL,NULL,NULL),(14,2018,3,6,1,'朝食',400,''),(15,2018,3,6,2,'',300,'スタバ'),(16,2018,3,6,1,'昼',550,'松乃家'),(17,2018,3,6,2,'',330,'梅田'),(18,2018,3,7,2,'',550,'朝食兼ねる'),(19,2018,3,7,1,'松乃家',680,'昼'),(21,2018,3,8,1,'',1000,''),(23,0,0,0,1,'',3000,''),(25,0,0,0,1,'',600,''),(29,0,0,0,1,'',2345,''),(36,2018,3,9,2,'スタバ　朝',300,''),(37,2018,3,9,2,'スタバ　昼',100,''),(38,2018,3,9,2,'梅田',300,''),(39,2018,3,9,1,'朝',400,''),(40,2018,3,9,1,'晩御飯',450,''),(42,2018,3,10,2,'',500,''),(43,2018,3,10,2,'',300,''),(44,2018,3,11,4,'クリーニング代',1300,''),(45,2018,3,10,4,'薬',2000,''),(46,2018,3,13,1,'',1000,''),(47,2018,3,13,2,'',100,''),(48,2018,3,13,2,'',300,''),(58,2018,3,24,2,'',550,''),(59,2018,3,24,4,'クリーニング',800,''),(61,2018,3,13,3,'',100,''),(63,2018,3,24,1,'コメ',850,''),(64,2018,3,24,2,'夜',300,'スタバ'),(67,2018,3,25,2,'',550,''),(71,0,0,0,1,'qqq',555,''),(74,2018,3,26,2,'昼',320,''),(75,2018,3,26,2,'',500,'昼兼ねる'),(76,2018,3,20,1,'',10000,''),(80,2018,3,31,5,'交通費1000 ご飯等250 260 700 280 300',2700,''),(81,2018,3,31,1,'晩御飯',350,''),(82,2018,3,31,6,'',700,'パン　お菓子　バター等'),(83,2018,4,9,2,'250',0,''),(84,2018,4,9,2,'',300,''),(85,2018,4,10,1,'お昼',680,''),(86,2018,5,11,1,'',620,''),(87,2018,5,19,2,'',300,''),(88,2018,5,19,2,'',400,''),(89,2018,5,19,1,'朝',200,'');
/*!40000 ALTER TABLE `sisyutu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tag1Name`
--

DROP TABLE IF EXISTS `tag1Name`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tag1Name` (
  `id` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tag1Name`
--

LOCK TABLES `tag1Name` WRITE;
/*!40000 ALTER TABLE `tag1Name` DISABLE KEYS */;
INSERT INTO `tag1Name` VALUES (1,'食費'),(2,'カフェ'),(3,'お菓子'),(4,'清潔品'),(5,'観光費'),(6,'食費2');
/*!40000 ALTER TABLE `tag1Name` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tag2Name`
--

DROP TABLE IF EXISTS `tag2Name`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tag2Name` (
  `id` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tag2Name`
--

LOCK TABLES `tag2Name` WRITE;
/*!40000 ALTER TABLE `tag2Name` DISABLE KEYS */;
INSERT INTO `tag2Name` VALUES (1,'食費'),(2,'家賃'),(3,'現金出費');
/*!40000 ALTER TABLE `tag2Name` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-06-02 16:42:36
