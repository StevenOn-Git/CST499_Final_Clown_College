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
-- Temporary view structure for view `courseslist_v`
--

DROP TABLE IF EXISTS `courseslist_v`;
/*!50001 DROP VIEW IF EXISTS `courseslist_v`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `courseslist_v` AS SELECT 
 1 AS `id`,
 1 AS `courseid`,
 1 AS `name`,
 1 AS `credit`,
 1 AS `description`,
 1 AS `PR`*/;
SET character_set_client = @saved_cs_client;

--
-- Final view structure for view `courseslist_v`
--

/*!50001 DROP VIEW IF EXISTS `courseslist_v`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_0900_ai_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `courseslist_v` AS select `b`.`id` AS `id`,`b`.`CourseID` AS `courseid`,`b`.`Name` AS `name`,`b`.`Credit` AS `credit`,`b`.`Description` AS `description`,trim(trailing '; ' from concat(ifnull(concat(`b`.`cr1`,'; '),''),ifnull(concat(`b`.`cr2`,'; '),''),ifnull(concat(`b`.`cr3`,'; '),''))) AS `PR` from (select `a`.`id` AS `id`,`a`.`CourseID` AS `CourseID`,`a`.`Name` AS `Name`,`a`.`Credit` AS `Credit`,`a`.`Description` AS `Description`,`a`.`DegreeIDs` AS `DegreeIDs`,`a`.`PreRequisite` AS `PreRequisite`,`a`.`firs` AS `firs`,`a`.`seco` AS `seco`,`a`.`thir` AS `thir`,(select `courses`.`CourseID` from `courses` where (`courses`.`id` = `a`.`firs`)) AS `cr1`,(select `courses`.`CourseID` from `courses` where (`courses`.`id` = `a`.`seco`)) AS `cr2`,(select `courses`.`CourseID` from `courses` where (`courses`.`id` = `a`.`thir`)) AS `cr3` from (select `courses`.`id` AS `id`,`courses`.`CourseID` AS `CourseID`,`courses`.`Name` AS `Name`,`courses`.`Credit` AS `Credit`,`courses`.`Description` AS `Description`,`courses`.`DegreeIDs` AS `DegreeIDs`,`courses`.`PreRequisite` AS `PreRequisite`,json_extract(`courses`.`PreRequisite`,'$[0]') AS `firs`,json_extract(`courses`.`PreRequisite`,'$[1]') AS `seco`,json_extract(`courses`.`PreRequisite`,'$[2]') AS `thir` from `courses`) `a`) `b` order by `b`.`CourseID` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Dumping events for database 'cst499'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-05-10  0:55:52
