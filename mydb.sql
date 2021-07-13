-- MariaDB dump 10.19  Distrib 10.4.19-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: mydb
-- ------------------------------------------------------
-- Server version	10.4.19-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `mst_product`
--

DROP TABLE IF EXISTS `mst_product`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mst_product` (
  `code` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `price` int(11) NOT NULL,
  `syuppan` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `nouki` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `gaku` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `gakun` int(255) NOT NULL,
  `zaiko` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mst_product`
--

LOCK TABLES `mst_product` WRITE;
/*!40000 ALTER TABLE `mst_product` DISABLE KEYS */;
INSERT INTO `mst_product` VALUES (1,'情報処理',100,'日経BP','','プロジェクトマネジメント学科',3,'あり'),(2,'PM概論',1000,'岩波書店','','プロジェクトマネジメント学科',3,'あり'),(3,'PM演習',6500,'工大書籍','20210713','プロジェクトマネジメント学科',3,'なし'),(4,'ビジネスアナリシス知識体系ガイド',0,'','','',0,''),(5,'いいい',0,'','','',0,''),(6,'いいい',1000,'','','',0,''),(7,'いいい',1000,'日経BP','','',0,''),(8,'いいい',1000,'日経BP','20210713','',0,''),(9,'いいい',1000,'日経BP','20210713','',0,'なし'),(10,'いいい',1000,'日経BP','20210713','プロジェクトマネジメント学科',1,'なし');
/*!40000 ALTER TABLE `mst_product` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-07-13 19:51:51
