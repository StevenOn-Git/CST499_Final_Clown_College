-- MySQL dump 10.13  Distrib 8.0.23, for Win64 (x86_64)
--
-- Host: localhost    Database: cst499
-- ------------------------------------------------------
-- Server version	8.0.23

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `sections`
--

DROP TABLE IF EXISTS `sections`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sections` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(40) NOT NULL,
  `semesterid` int unsigned NOT NULL,
  `classDays` json DEFAULT NULL,
  `class_start` time DEFAULT NULL,
  `class_end` time DEFAULT NULL,
  `roster_cap` int unsigned NOT NULL DEFAULT '4',
  `waitlist_cap` int unsigned DEFAULT '0',
  `courseid` int NOT NULL,
  `professorid` int NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sections`
--

LOCK TABLES `sections` WRITE;
/*!40000 ALTER TABLE `sections` DISABLE KEYS */;
INSERT INTO `sections` VALUES (1,'DRA115-01',2,'[\"Mon\", \"Wed\", \"Fri\"]','08:00:00','09:30:00',4,2,1,2),(2,'DRA115-02',2,'[\"Mon\", \"Wed\", \"Fri\"]','10:00:00','11:30:00',4,2,1,2),(3,'A',2,'[\"Tue\", \"Thu\"]','08:00:00','10:00:00',4,2,29,6),(4,'B',2,'[\"Tue\", \"Thu\"]','10:00:00','12:00:00',4,2,29,6),(5,'1A',2,'[\"Mon\", \"Wed\", \"Fri\"]','13:00:00','14:00:00',4,2,31,4),(6,'1B',2,'[\"Mon\", \"Wed\", \"Fri\"]','15:00:00','16:00:00',4,2,31,4),(7,'P01',2,'[\"Mon\", \"Wed\", \"Fri\"]','13:00:00','14:30:00',2,1,21,2),(8,'DRM194-01',2,'[\"Tue\", \"Thu\"]','13:00:00','15:00:00',2,1,32,7),(10,'DRM251-01',2,'[\"Tue\", \"Thu\"]','16:00:00','18:00:00',2,1,33,7),(11,'P02',2,'[\"Mon\", \"Wed\", \"Fri\"]','15:00:00','16:00:00',4,2,6,2),(12,'P03',2,'[\"Mon\", \"Wed\", \"Fri\"]','16:30:00','18:00:00',4,2,17,2),(13,'1C',2,'[\"Tue\", \"Thu\"]','16:30:00','18:00:00',2,1,25,4);
/*!40000 ALTER TABLE `sections` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-05-10  0:55:51
