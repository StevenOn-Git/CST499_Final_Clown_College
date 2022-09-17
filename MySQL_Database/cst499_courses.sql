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
-- Table structure for table `courses`
--

DROP TABLE IF EXISTS `courses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `courses` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `CourseID` varchar(40) NOT NULL,
  `Name` varchar(100) NOT NULL,
  `Credit` int NOT NULL,
  `Description` varchar(4000) DEFAULT NULL,
  `DegreeIDs` json DEFAULT NULL,
  `PreRequisite` json DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `CourseID` (`CourseID`)
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `courses`
--

LOCK TABLES `courses` WRITE;
/*!40000 ALTER TABLE `courses` DISABLE KEYS */;
INSERT INTO `courses` VALUES (1,'DRA 115','Introduction to Theater I',3,'Survey of basic principles of drama from a diverse range of cultures and periods. Application of dramatic analysis principles to an inclusive selection of introductory texts.','[3, 4]',NULL),(2,'DRA 352','Survey of Theater History',3,'World theater from its ritual beginnings to the present. Changes in social, cultural, and political context related to changing theatrical and dramatic forms with an emphasis on inclusive work from diverse writers.','[3]','[1]'),(3,'DRA 355','Development of Theater and Drama I',3,'Theater and drama predating the Common Era through the 17th century. Changes in social, cultural, and political context related to changing theatrical and dramatic forms with an emphasis on inclusive work from diverse writers.','[3, 4]','[1]'),(4,'DRA 356','Development of Theater and Drama II',3,'Drama and theatrical production from the 18th century to the present with an emphasis on inclusive work from diverse writers.','[3, 4]','[1, 3]'),(5,'DRA 125','Introduction to Acting I',3,'Foundational acting techniques with an emphasis on: vocal, physical, and emotional relaxation; concentration; and dramatic action. The course includes work on consent, and draws heavily upon an inclusive range of work from diverse artists. Required of all first-year students majoring in Acting and Musical Theater.','[3, 4]',NULL),(6,'DRA 108','Musical Theater Vocal Techniques',1,'Private instruction in musical theater vocal techniques for non-majors. Development of vocal timbre, range, appropriate repertoire selection, and audition technique.',NULL,NULL),(7,'DRA 116','Introduction to Theater II',3,'Continued survey of basic principles of drama from a diverse range of cultures and periods. Application of dramatic analysis principles to an inclusive selection of intermediate texts.','[3, 4]','[1]'),(8,'DRA 308','Musical Theater Vocal Techniques II',1,'Private instruction in advanced musical theater vocal techniques for non-majors. Development of vocal timbre, range, appropriate repertoire selection, and audition technique.',NULL,NULL),(9,'DRA 318','Musical Theater Vocal Techniques III',1,'Private instruction in vocal techniques. Development of range, register balance, vocal timbre and musicianship as required for the diverse styles of the musical theater repertoire.',NULL,NULL),(10,'DRA 325','Comedy in Italy from Ancient to Modern Times',3,'Offered only in Florence. Explore the lively comedic tradition that began in the late Roman Republican era and continues to flourish. From the commedia dell\'arte of the Renaissance to comedies of manners in the 17th to 19th centuries to experimental drama during the 20th and 21st centuries.',NULL,NULL),(11,'DRA 126','Introduction to Acting II',3,'Continuation of acting techniques with an emphasis on: vocal, physical, and emotional relaxation; concentration; and dramatic action. The course includes work on consent, and draws heavily upon an inclusive range of work from diverse artists. Required of all first-year students majoring in Acting and Musical Theater.','[3]','[5]'),(12,'DRA 127','Core Intensives',3,'Intensive practical exploration of the fundamental physical, vocal, imaginative, and emotional skills required of actors.','[3]','[5, 11]'),(13,'DRA 273','Movement for Actors I',2,'Movement principles and techniques to develop balance, strength, flexibility, endurance and coordination combined with exercises to build physical awareness, confidence and good anatomical use. Required of all students majoring in Acting.','[3]','[11, 12]'),(14,'DRA 274','Movement for Actors II',2,'Emphasizes dynamic physical practice and analysis in the work of the actor. Required of all students majoring in Acting.','[3]','[13]'),(15,'DRA 373','Clown Techique',3,'Principles and techniques of clown with elements of the fool, bouffons, and the grotesque. Actor’s instincts heightened through exploration of clown logic, the rhythm of failure, repetition and resiliency. Required of all students majoring in Acting.','[3]','[14]'),(16,'DRA 220','Introduction to Scene Study',3,'Application of acting fundamentals to scenes from modern and contemporary drama with an emphasis on inclusive work from diverse artists.','[3]','[11, 12]'),(17,'DRA 121','The Actor\'s Speech',2,'Developing actors’ speech skills through vocal practice and the study of phonetics for clear, strong articulation, connection to language, and effective, expressive use of the voice using text from inclusive work of diverse artists.','[3]','[5]'),(18,'DRA 221','Voice/Verse I',3,'Introductory exercises to free the voice for healthy and spontaneous expression of thought and feeling. Students will work on a diverse array of materials to explore heightened poetic language.','[3]','[11, 12, 17]'),(19,'DRA 222','Voice/Verse II',3,'Continuation of DRA 221 with advanced vocal exercises. Students will engage with a wide range of diverse dramatic materials.','[3]','[18]'),(20,'DRA 421','Playing Comedy',3,'Advanced comedy techniques including play, complicity, rhythm/timing, and how to integrate comic principles into character development and scene work.',NULL,'[14, 16, 19]'),(21,'DRA 423','Character Mask for the Actor',3,'Exploration of extreme character and composition using advanced physical vocabulary and character mask exercises in the tradition of LeCoq.',NULL,NULL),(22,'DRA 321','Advanced Voice/Verse I',3,'A continuation of DRA 221 and 222 exploring challenging texts that expand the actor’s range. The class will cover a wide range of styles and will focus on facility with complex spoken language including work from a diverse group of artists.','[3]','[19]'),(23,'DRA 322','Advanced Voice/Verse II',3,'Exploration of accent acquisition and acting in dialect.  The course will offer a range of dramatic materials from a diverse group of artists.','[3]','[19]'),(24,'DRD 115','Introduction to Theater Production I',2,'Lecture, reading, and discussion of major aspects of theater production. Participation in construction, running, and front-of-house crews for Drama Department productions. Required of Acting and Musical Theater majors.','[3, 4]',NULL),(25,'DRD 116','Introduction to Theater Production II',2,'Continuation of DRD 115.','[3, 4]','[24]'),(26,'DRA 374','Solo Creation in Physical Poetry',3,'Student’s create original solo work using the analytical, qualities of physical poetry and exploring the use of theatrical metaphor. Required of all students majoring in Acting.','[3]','[15]'),(27,'DRA 320','Advanced Acting: Modern Drama',3,'Application of acting fundamentals to modern and contemporary works of varying styles with an emphasis on inclusive work from diverse artists. Method: assigned scenes. Prereq: acceptance for advanced work by departmental faculty.','[3]','[7, 16]'),(28,'DRA 420','Advanced Scene Study: Poetic Drama',3,'Dealing with acting challenges posed by verse and other forms of poetic writing from the classical, modern, and contemporary repertoire with an emphasis on inclusive work from diverse writers. Prereq: Acceptance for advanced work by Drama faculty.','[3]','[7, 16]'),(29,'WRT 105','Studio 1: Practices of Academic Writing',3,'Study and practice of writing processes, including critical reading, collaboration, revision, editing, and the use of technologies. Focuses on the aims, strategies, and conventions of academic prose, especially analysis and argumentation.','[3, 4]',NULL),(30,'WRT 205','Studio 2: Critical Research and Writing',3,'Study and practice of critical, research-based writing, including research methods, presentation genres, source evaluation, audience analysis, and library/online research. Students complete at least one sustained research project.','[3, 4]',NULL),(31,'DRD 301','Fundamentals of Theater Design',3,'Basic theory and techniques of design for the stage. Includes scenery, costumes and lights. Open to non-Design/Tech majors by Department consent.','[4]',NULL),(32,'DRM 194','Introduction to Theater Management',3,'Class lectures, discussion, and conversations with management guests from Syracuse Stage, Department of Drama and from other professional and diverse cultural organizations from central New York and across the country.  ','[4]',NULL),(33,'DRM 251','Introduction to Stage Management',3,'Combined classroom and practicum investigation of the stage management system. Student will be assigned as an assistant stage manager on an SU Drama production while discussing the elements of stage management in the classroom.','[4]',NULL),(34,'DRM 381','Theater Management Practicum',3,'Opportunities to apply the skills and techniques of theater management in a practical application. Students will pursue specific goals using management projects and/or internships during the semester. Guests are invited to the class from a wide variety of diverse backgrounds.','[4]','[32, 33]'),(35,'DRM 394','Theater Management I',3,'History of management in American theater. Management aspects of community theater, regional theater, summer stock, New York commercial theater, educational theater and theater serving diverse populations.','[4]',NULL),(36,'DRM 395','Theater Management II',3,'The creation of a detailed budget of a theatrical season including all income and expenses as well as a review of employee policies within the field, adhering to rules of theatrical unions based on collective bargaining agreements and Federal, state, and local laws.','[4]','[35]'),(37,'DRM 261','Stage Management Core Skills Lab',3,'Practical application of core stage management skills( including blocking, prompting, calling technical cues, organizing scene changes, running technical rehearsals, scheduling and personnel management) are exercised using actual production scenarios in a laboratory setting.',NULL,'[33]'),(38,'DRM 340','Stage Management Rehearsal Techniques',2,'Exploration of techniques used by stage manager in rehearsal process. Topics include technical script analysis, blocking, prompting, scheduling, and effective use of assistants.',NULL,'[33]'),(39,'DRM 450','Stage Management: Performance Techniques',3,'Exploration of techniques used by stage managers in the performance process. Topics include running technical and dress rehearsals, calling shows, managing and maintaining performances.',NULL,'[33, 38]'),(40,'DRM 465','Stage Management: Communication and Collaboration',3,'Communication and collaboration to meet the needs of diverse groups in specific theatrical production scenarios.',NULL,'[33]'),(41,'DRM 467','Stage Management: Touring Techniques',3,'Exploration of stage management techniques used specifically in touring theatrical productions.',NULL,'[33, 38, 39]'),(42,'DRM 492','Production Management',3,'The role of the production manager in the process of producing a theatrical season and administering a production department.',NULL,'[33, 38, 39]'),(43,'DRA 328','Practicum in Stage Makeup',2,'Problems and practice in stage makeup techniques',NULL,NULL);
/*!40000 ALTER TABLE `courses` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-05-10  0:55:50