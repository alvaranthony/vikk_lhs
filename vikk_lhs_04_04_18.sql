-- MySQL dump 10.13  Distrib 5.5.57, for debian-linux-gnu (x86_64)
--
-- Host: 0.0.0.0    Database: vikk_lhs
-- ------------------------------------------------------
-- Server version	5.5.57-0ubuntu0.14.04.1

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
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `comments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `comment` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `thesis_id` int(10) unsigned DEFAULT NULL,
  `user_id` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `comments_thesis_id_foreign` (`thesis_id`),
  KEY `comments_user_id_foreign` (`user_id`),
  CONSTRAINT `comments_thesis_id_foreign` FOREIGN KEY (`thesis_id`) REFERENCES `theses` (`id`) ON DELETE CASCADE,
  CONSTRAINT `comments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comments`
--

LOCK TABLES `comments` WRITE;
/*!40000 ALTER TABLE `comments` DISABLE KEYS */;
INSERT INTO `comments` VALUES (12,'Test',34,47,'2018-03-14 19:32:10','2018-03-14 19:32:10'),(13,'Test2',34,47,'2018-03-14 19:32:39','2018-03-14 19:32:39'),(14,'Test 123',34,47,'2018-03-14 19:43:53','2018-03-14 19:43:53'),(15,'Olen administraator',34,54,'2018-03-14 19:44:18','2018-03-14 19:44:18'),(16,'Test',34,47,'2018-03-15 17:11:13','2018-03-15 17:11:13'),(19,'Test 123',34,47,'2018-03-17 12:27:55','2018-03-17 12:27:55'),(23,'Test123123',34,47,'2018-03-17 13:09:12','2018-03-17 13:09:12'),(25,'MIakds',34,46,'2018-03-18 16:27:08','2018-03-18 16:27:08'),(29,'See on uus kommentaar.',60,39,'2018-04-04 08:21:18','2018-04-04 08:21:18'),(33,'Päris tubli töö on sellega tehtud, väga hea!',65,54,'2018-04-04 19:38:38','2018-04-04 19:38:38');
/*!40000 ALTER TABLE `comments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `exam_languages`
--

DROP TABLE IF EXISTS `exam_languages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `exam_languages` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `language` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `exam_languages_language_unique` (`language`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `exam_languages`
--

LOCK TABLES `exam_languages` WRITE;
/*!40000 ALTER TABLE `exam_languages` DISABLE KEYS */;
INSERT INTO `exam_languages` VALUES (1,'Eesti',NULL,NULL),(2,'Inglise',NULL,NULL),(3,'Vene',NULL,NULL);
/*!40000 ALTER TABLE `exam_languages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `exam_types`
--

DROP TABLE IF EXISTS `exam_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `exam_types` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `type` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `exam_types_type_unique` (`type`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `exam_types`
--

LOCK TABLES `exam_types` WRITE;
/*!40000 ALTER TABLE `exam_types` DISABLE KEYS */;
INSERT INTO `exam_types` VALUES (1,'Juhtimise moodul A',NULL,NULL),(2,'Arenduse moodul B',NULL,NULL),(3,'Halduse moodul C',NULL,NULL),(4,'Arenduse moodul B light',NULL,NULL),(5,'Halduse moodul C light',NULL,NULL);
/*!40000 ALTER TABLE `exam_types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `exam_user`
--

DROP TABLE IF EXISTS `exam_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `exam_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `exam_type_id` int(10) unsigned DEFAULT NULL,
  `user_id` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `exam_user_exam_type_id_index` (`exam_type_id`),
  KEY `exam_user_user_id_index` (`user_id`),
  CONSTRAINT `exam_user_exam_type_id_foreign` FOREIGN KEY (`exam_type_id`) REFERENCES `exam_types` (`id`) ON DELETE CASCADE,
  CONSTRAINT `exam_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `exam_user`
--

LOCK TABLES `exam_user` WRITE;
/*!40000 ALTER TABLE `exam_user` DISABLE KEYS */;
INSERT INTO `exam_user` VALUES (32,1,39),(33,2,39),(35,5,39),(39,1,56),(40,2,56);
/*!40000 ALTER TABLE `exam_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fileentries`
--

DROP TABLE IF EXISTS `fileentries`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fileentries` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `thesis_id` int(10) unsigned DEFAULT NULL,
  `filename` varchar(2083) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mime` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `original_filename` varchar(2083) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fileentries_thesis_id_foreign` (`thesis_id`),
  CONSTRAINT `fileentries_thesis_id_foreign` FOREIGN KEY (`thesis_id`) REFERENCES `theses` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fileentries`
--

LOCK TABLES `fileentries` WRITE;
/*!40000 ALTER TABLE `fileentries` DISABLE KEYS */;
INSERT INTO `fileentries` VALUES (13,34,'phpESTiCY.docx','application/vnd.openxmlformats-officedocument.wordprocessingml.document','Firma visioon ning eesmärgid.docx','2018-04-04 08:40:49','2018-04-04 08:40:49'),(14,60,'phpwakqc6.docx','application/vnd.openxmlformats-officedocument.wordprocessingml.document','Firma visioon ning eesmärgid.docx','2018-04-04 08:42:55','2018-04-04 08:42:55'),(15,60,'phprFu5IF.pdf','application/pdf','N2idistoo testiplaan.pdf','2018-04-04 08:44:24','2018-04-04 08:44:24'),(16,60,'phpGMA4k6.pdf','application/pdf','Live_Project_Test_Plan_SoftwareTestingHelp.pdf','2018-04-04 08:44:41','2018-04-04 08:44:41'),(17,65,'phpaP66yx.pdf','application/pdf','12-asja-mida-sulle-koolis-ei-õpetatud.pdf','2018-04-04 19:35:53','2018-04-04 19:35:53');
/*!40000 ALTER TABLE `fileentries` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `groups`
--

DROP TABLE IF EXISTS `groups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `groups` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `groups_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=62 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `groups`
--

LOCK TABLES `groups` WRITE;
/*!40000 ALTER TABLE `groups` DISABLE KEYS */;
INSERT INTO `groups` VALUES (3,'AK17','2018-03-06 17:56:17','2018-03-28 11:45:23'),(4,'AKT15','2018-03-06 17:56:24','2018-03-28 11:45:32'),(6,'AM15','2018-03-06 18:07:38','2018-03-28 11:45:37'),(8,'AM16','2018-03-06 18:14:06','2018-03-28 11:45:45'),(9,'AM17','2018-03-11 13:56:42','2018-03-28 11:45:50'),(10,'AMK17','2018-03-11 13:57:46','2018-03-28 11:45:57'),(11,'APK17','2018-03-11 13:58:42','2018-03-28 11:46:05'),(12,'BUK17','2018-03-11 13:59:57','2018-03-28 11:46:31'),(13,'BUKJ17','2018-03-11 14:00:38','2018-03-28 11:46:56'),(14,'EL16','2018-03-11 14:02:10','2018-03-28 11:47:15'),(15,'EV15','2018-03-11 14:02:48','2018-03-28 11:47:21'),(16,'EV16','2018-03-11 14:03:17','2018-03-28 11:47:26'),(17,'EV17','2018-03-28 11:31:02','2018-03-28 11:47:30'),(18,'EVL15','2018-03-28 11:47:37','2018-03-28 11:47:37'),(19,'EVL16','2018-03-28 11:47:54','2018-03-28 11:47:54'),(20,'EÜ15','2018-03-28 11:48:03','2018-03-28 11:48:03'),(21,'EÜ16','2018-03-28 11:48:10','2018-03-28 11:48:10'),(22,'EÜ17','2018-03-28 11:48:14','2018-03-28 11:48:14'),(23,'HTK16','2018-03-28 11:48:24','2018-03-28 11:48:24'),(24,'IS15','2018-03-28 11:48:26','2018-03-28 11:48:26'),(25,'IS16','2018-03-28 11:48:30','2018-03-28 11:48:30'),(26,'IS17','2018-03-28 11:48:33','2018-03-28 11:48:33'),(27,'K15','2018-03-28 11:48:38','2018-03-28 11:48:38'),(28,'K16','2018-03-28 11:48:41','2018-03-28 11:48:41'),(29,'K17','2018-03-28 11:48:45','2018-03-28 11:48:45'),(30,'KE15','2018-03-28 11:48:49','2018-03-28 11:48:49'),(31,'KE16','2018-03-28 11:48:57','2018-03-28 11:48:57'),(32,'KE17','2018-03-28 11:49:10','2018-03-28 11:49:10'),(33,'KEOP17','2018-03-28 11:49:30','2018-03-28 11:49:30'),(34,'KK17','2018-03-28 11:49:34','2018-03-28 11:49:34'),(35,'KT15','2018-03-28 11:49:38','2018-03-28 11:49:38'),(36,'MR17','2018-03-28 11:49:43','2018-03-28 11:49:43'),(37,'MST17','2018-03-28 11:49:47','2018-03-28 11:49:47'),(38,'MSTK17','2018-03-28 11:49:54','2018-03-28 11:49:54'),(39,'PKE15','2018-03-28 11:50:00','2018-03-28 11:50:00'),(40,'PKE16','2018-03-28 11:50:06','2018-03-28 11:50:06'),(41,'SAT15','2018-03-28 11:50:19','2018-03-28 11:50:19'),(42,'SAT16','2018-03-28 11:50:24','2018-03-28 11:50:24'),(43,'SE15','2018-03-28 11:50:29','2018-03-28 11:50:29'),(44,'SE16','2018-03-28 11:50:32','2018-03-28 11:50:32'),(45,'SE17','2018-03-28 11:50:35','2018-03-28 11:50:35'),(46,'SEK16','2018-03-28 11:51:03','2018-03-28 11:51:03'),(47,'SPR17','2018-03-28 11:51:11','2018-03-28 11:51:11'),(48,'TA15','2018-03-28 11:51:17','2018-03-28 11:51:17'),(49,'TAK16','2018-03-28 11:51:20','2018-03-28 11:51:20'),(50,'VA15','2018-03-28 11:51:30','2018-03-28 11:51:30'),(51,'VA16','2018-03-28 11:51:33','2018-03-28 11:51:33'),(52,'VA17','2018-03-28 11:51:37','2018-03-28 11:51:37'),(53,'VAK17','2018-03-28 11:51:42','2018-03-28 11:51:42'),(54,'VAKJ17','2018-03-28 11:51:46','2018-03-28 11:51:46'),(55,'VAKJO17','2018-03-28 11:51:52','2018-03-28 11:51:52'),(58,'ITT15','2018-04-01 10:11:55','2018-04-01 10:11:55'),(59,'ITT16','2018-04-01 10:11:59','2018-04-01 10:11:59'),(60,'ITT17','2018-04-01 10:12:02','2018-04-01 10:12:02');
/*!40000 ALTER TABLE `groups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `internships`
--

DROP TABLE IF EXISTS `internships`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `internships` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned DEFAULT NULL,
  `company_name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `duration` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `internships_user_id_foreign` (`user_id`),
  CONSTRAINT `internships_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `internships`
--

LOCK TABLES `internships` WRITE;
/*!40000 ALTER TABLE `internships` DISABLE KEYS */;
INSERT INTO `internships` VALUES (13,39,'TEst 1','2018-04-13','2018-04-16',123,'2018-04-03 08:20:32','2018-04-03 08:20:32'),(14,39,'TEst 2','2018-04-05','2018-04-14',124,'2018-04-03 08:20:51','2018-04-03 08:20:51'),(15,39,'Uus koht','2018-04-17','2018-04-02',90,'2018-04-04 08:20:44','2018-04-04 08:20:57'),(16,56,'Tarkvara Tehnoloogia Arenduskeskus OÜ','2018-04-20','2018-07-20',494,'2018-04-04 19:36:53','2018-04-04 19:37:05'),(17,56,'Edicy OÜ','2018-04-06','2018-10-18',640,'2018-04-04 19:37:26','2018-04-04 19:37:26');
/*!40000 ALTER TABLE `internships` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=68 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_000000_create_students_table',1),(2,'2014_10_12_100000_create_password_resets_table',1),(3,'2018_01_06_154048_create_theses_table',2),(4,'2018_01_06_185034_add_timestamps_column_to_theses_table',3),(5,'2018_01_07_104554_create_thesess_table',4),(6,'2018_01_07_155710_add_student_id_field_to_theses_table',5),(20,'2018_01_07_160251_create_theses_table',6),(21,'2018_01_08_192037_create_internships_table',6),(22,'2018_01_14_174345_create_fileentries_table',6),(23,'2018_01_16_184802_create_roles_table',6),(24,'2018_01_17_183842_create_users_table',6),(25,'2018_01_17_185928_add_user_id_to_theses_table',7),(26,'2018_01_17_185955_add_user_id_to_internships_table',7),(27,'2018_01_17_190006_add_user_id_to_fileentries_table',7),(28,'2018_01_17_191445_add_role_id_to_users_table',8),(29,'2018_01_18_114801_remove_role_id_from_users_table',9),(30,'2018_01_18_123134_remove_user_id_from_theses_table',10),(31,'2018_01_18_123423_remove_user_id_from_filentries_table',11),(32,'2018_01_18_124013_add_fileentry_id_to_theses_table',12),(33,'2018_01_18_124647_remove_fileentry_id_from_theses_table',13),(34,'2018_01_18_124751_add_thesis_id_to_fileentries_table',14),(42,'2018_01_18_193134_create_roles_theses_users_table',15),(43,'2018_01_28_172523_create_fileentries_table',16),(44,'2018_01_30_171150_add_name_to_theses',17),(46,'2018_02_03_111714_create_fileentries_table',18),(47,'2018_02_04_095754_create_statuses_table',19),(48,'2018_02_04_100149_add_statuses_column_to_theses_table',20),(49,'2018_02_17_093019_create_comments_table',21),(52,'2018_03_05_191838_create_groups_table',22),(53,'2018_03_06_181639_add_group_id_to_theses_table',23),(55,'2018_03_18_111507_create_reviewer_grades_table',24),(56,'2018_03_18_112513_add_reviewer_grade_id_to_theses_table',25),(57,'2018_03_18_152336_create_reviewer_assessment_table',26),(58,'2018_03_18_153128_add_reviewer_assessment_id_to_theses_table',27),(59,'2018_03_18_160654_remove_reviewer_assessment_id_from_theses_table',28),(60,'2018_03_18_161223_add_reviewer_assessment_id_to_theses_table',29),(61,'2018_03_25_171348_create_exam_languages_table',30),(63,'2018_03_25_171937_create_exam_types_table',31),(64,'2018_03_25_173154_create_exams_table',32),(65,'2018_03_27_084446_add_group_id_to_users_table',33),(66,'2018_03_27_093356_add_exam_lang_id_to_users_table',34),(67,'2018_03_27_102506_create_exam_user_table',35);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
INSERT INTO `password_resets` VALUES ('alvar.hamalainen@vikk.ee','$2y$10$h.FKgUE/tjxhpY5go2lDeuyMRN5Gqt0kcci1kdL5J6DukIFPF.mha','2018-02-13 17:15:42');
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `profiles`
--

DROP TABLE IF EXISTS `profiles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `profiles` (
  `id` int(10) unsigned DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `profiles`
--

LOCK TABLES `profiles` WRITE;
/*!40000 ALTER TABLE `profiles` DISABLE KEYS */;
/*!40000 ALTER TABLE `profiles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reviewer_assessments`
--

DROP TABLE IF EXISTS `reviewer_assessments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `reviewer_assessments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `assessment` varchar(750) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reviewer_assessments`
--

LOCK TABLES `reviewer_assessments` WRITE;
/*!40000 ALTER TABLE `reviewer_assessments` DISABLE KEYS */;
INSERT INTO `reviewer_assessments` VALUES (1,'Olen administraator\r\nOlen administraatorOlen administraatorOlen administraatorOlen administraatorOlen administraatorOlen administraatorOlen administraatorOlen administraatorOlen administraatorOlen administraatorOlen administraatorOlen administraatorOlen administraatorOlen administraatorOlen administraatorOlen administraatorOlen administraatorOlen administraatorOlen administraatorOlen administraatorOlen administraatorOlen administraator','2018-03-18 16:33:33','2018-03-18 16:33:33'),(2,'sldglasdglksdgküaskdgksdgölsdkgölsdkgölksdgksdg\r\ns\r\ndgsdglsödglsdgsd\r\ng\r\nsdg\r\nsd\r\ng\r\nsdg\r\nsdöksdgöksdögkösdkg ödskög ködskg ösdkg äsdäg ksdkgsd kgsdä gsd','2018-03-18 16:33:55','2018-03-18 16:33:55'),(6,'Pole väga hullu midagi. Mõnest kohast sinna tänna oleks vaja siiski paremini aga muidu ok.','2018-03-20 18:46:29','2018-03-20 18:46:29'),(9,'Väga tubli!','2018-03-20 19:02:16','2018-03-20 19:02:16'),(11,'See on iseeneste hästi tehtud. See on iseeneste hästi tehtud. V\r\nSee on iseeneste hästi tehtud. V\r\nSee on iseeneste hästi tehtud. VSee on iseeneste hästi tehtud. VSee on iseeneste hästi tehtud. VSee on iseeneste hästi tehtud. VSee on iseeneste hästi tehtud. VSee on iseeneste hästi tehtud. VSee on iseeneste hästi tehtud. VSee on iseeneste hästi tehtud. V','2018-04-04 10:48:40','2018-04-04 10:48:40'),(12,'Töö on hästi üles ehitatud. 1) See on hea ja too on hea 2) Lisaks peab ära mainima mainitava mainimise, mida mainitakse sellega seoses, et selle teksti mainimine ei ole üldse loogiline.','2018-04-04 19:41:30','2018-04-04 19:41:30');
/*!40000 ALTER TABLE `reviewer_assessments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reviewer_grades`
--

DROP TABLE IF EXISTS `reviewer_grades`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `reviewer_grades` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `grade` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reviewer_grades`
--

LOCK TABLES `reviewer_grades` WRITE;
/*!40000 ALTER TABLE `reviewer_grades` DISABLE KEYS */;
INSERT INTO `reviewer_grades` VALUES (1,1,NULL,NULL),(2,2,NULL,NULL),(3,3,NULL,NULL),(4,4,NULL,NULL),(5,5,NULL,NULL);
/*!40000 ALTER TABLE `reviewer_grades` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'Õpilane'),(2,'Õpetaja'),(3,'Juhendaja'),(4,'Komisjoni esimees'),(5,'Komisjoni liige'),(6,'Administraator'),(7,'Vaikimisi'),(8,'Retsensent');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles_theses_users`
--

DROP TABLE IF EXISTS `roles_theses_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `roles_theses_users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `role_id` int(10) unsigned DEFAULT NULL,
  `thesis_id` int(10) unsigned DEFAULT NULL,
  `user_id` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `roles_theses_users_role_id_index` (`role_id`),
  KEY `roles_theses_users_thesis_id_index` (`thesis_id`),
  KEY `roles_theses_users_user_id_index` (`user_id`),
  CONSTRAINT `roles_theses_users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE,
  CONSTRAINT `roles_theses_users_thesis_id_foreign` FOREIGN KEY (`thesis_id`) REFERENCES `theses` (`id`) ON DELETE CASCADE,
  CONSTRAINT `roles_theses_users_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=145 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles_theses_users`
--

LOCK TABLES `roles_theses_users` WRITE;
/*!40000 ALTER TABLE `roles_theses_users` DISABLE KEYS */;
INSERT INTO `roles_theses_users` VALUES (13,1,NULL,39),(14,1,NULL,40),(15,7,NULL,41),(27,7,NULL,45),(28,7,NULL,46),(29,2,NULL,47),(54,1,34,48),(55,3,34,47),(99,7,NULL,54),(100,6,NULL,54),(104,8,34,46),(114,5,NULL,41),(118,4,NULL,45),(128,1,60,39),(129,3,60,46),(132,2,NULL,41),(133,5,NULL,45),(134,8,60,41),(139,1,64,40),(140,3,64,46),(141,1,NULL,56),(142,1,65,56),(143,3,65,54),(144,8,65,45);
/*!40000 ALTER TABLE `roles_theses_users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `statuses`
--

DROP TABLE IF EXISTS `statuses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `statuses` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `statuses`
--

LOCK TABLES `statuses` WRITE;
/*!40000 ALTER TABLE `statuses` DISABLE KEYS */;
INSERT INTO `statuses` VALUES (1,'Juhendajale esitatud'),(2,'Tagasi lükatud'),(3,'Kaitsmisele lubatud'),(4,'Kaitstud');
/*!40000 ALTER TABLE `statuses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `theses`
--

DROP TABLE IF EXISTS `theses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `theses` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `defense_date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status_id` int(10) unsigned DEFAULT NULL,
  `group_id` int(10) unsigned DEFAULT NULL,
  `reviewer_grade_id` int(10) unsigned DEFAULT NULL,
  `reviewer_assessment_id` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `theses_status_id_foreign` (`status_id`),
  KEY `theses_group_id_foreign` (`group_id`),
  KEY `theses_reviewer_grade_id_foreign` (`reviewer_grade_id`),
  KEY `theses_reviewer_assessment_id_foreign` (`reviewer_assessment_id`),
  CONSTRAINT `theses_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`),
  CONSTRAINT `theses_reviewer_assessment_id_foreign` FOREIGN KEY (`reviewer_assessment_id`) REFERENCES `reviewer_assessments` (`id`),
  CONSTRAINT `theses_reviewer_grade_id_foreign` FOREIGN KEY (`reviewer_grade_id`) REFERENCES `reviewer_grades` (`id`),
  CONSTRAINT `theses_status_id_foreign` FOREIGN KEY (`status_id`) REFERENCES `statuses` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=66 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `theses`
--

LOCK TABLES `theses` WRITE;
/*!40000 ALTER TABLE `theses` DISABLE KEYS */;
INSERT INTO `theses` VALUES (34,'Testin123','2018-02-22','2018-02-03 21:16:22','2018-04-04 19:18:58',3,3,NULL,NULL),(60,'laskflasf','2018-04-05','2018-04-02 07:27:14','2018-04-04 10:48:40',3,49,2,11),(64,'PHP ning Bootstrapi juhendi loomine','2018-04-20','2018-04-04 10:30:52','2018-04-04 10:30:52',1,49,NULL,NULL),(65,'Uus Uus lõputöö loomine','2018-06-14','2018-04-04 19:35:53','2018-04-04 19:41:45',4,49,5,12);
/*!40000 ALTER TABLE `theses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `first_name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_code` varchar(11) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_number` varchar(16) COLLATE utf8mb4_unicode_ci NOT NULL,
  `group_id` int(10) unsigned DEFAULT NULL,
  `exam_lang_id` int(10) unsigned DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  UNIQUE KEY `users_id_code_unique` (`id_code`),
  UNIQUE KEY `users_phone_number_unique` (`phone_number`),
  KEY `users_group_id_foreign` (`group_id`),
  KEY `users_exam_lang_id_foreign` (`exam_lang_id`),
  CONSTRAINT `users_exam_lang_id_foreign` FOREIGN KEY (`exam_lang_id`) REFERENCES `exam_languages` (`id`),
  CONSTRAINT `users_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=57 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (39,'Alvar Anthony','Hämäläinen','alvar.hamalainen@vikk.ee','39501126816','56949584',49,1,'$2y$10$MbgvnEwqMMm3CaSJtuimS.0zCoXdsqltJEo11C1qNXx5UPhVfYk5K','opNaApYnfAJove1GGYMWfKtlWCQ27nduQuUcDMfrrzAcFDoi2mZJCFZjulBB','2018-01-28 13:07:26','2018-03-28 11:53:41'),(40,'Alo','Malo','alo.malo@vikk.ee','12345678910','12120909',49,1,'$2y$10$Vg98GbsQLapGTWq4NjwtrOc1uW3uyCEdKJV3liI2xiGsaGgSDDfQO','rrIkiB8fqDeiSqKKTDayKGlY08YPDcdySuxuhV0KiYV0Er9E2dWwVU86dS6O','2018-01-28 13:08:10','2018-04-04 10:30:52'),(41,'Ott','Kukk','ott.kukk@vikk.ee','09091209120','12091209',NULL,NULL,'$2y$10$j9XJLmwcc9TF99yTIYZpjOXh00LN1l7jJe70acQuqEEW14wOOz1O2','meFhtCgGY9Wt8GyuEmdTzWmZj9x2QK1RENcHjO0hKpf70O7logifyCTtEkCe','2018-01-28 13:08:38','2018-01-28 13:08:38'),(45,'Tiina','Tambet','tiina.tambet@vikk.ee','12345678911','12421221',NULL,NULL,'$2y$10$Bsi1TpFzAS7qQ9JiYuS.Wum.Is1vmhrzVxLQ.zICCednjX4L9I4AO','BpnqPr9IP7WLnvbHjFpwhuRzIkj13Vv8Nng3yR1Zb4RBMt7a9IFQdnmr1Azf','2018-01-30 17:27:05','2018-01-30 17:27:05'),(46,'Jaanus','Alnek','jaanus.alnek@vikk.ee','12345678912','09098121',NULL,NULL,'$2y$10$9kdgxCyPBBUv4q4nCmkOv.3leAY2laI7mW9vf6ri4cEQXQCqZip8i','xHCTbPG6UsmyxE5NBZvQ2ypSZaqQ7QZLZKG6us4EWeyuZxPHCsR5CjIiGtNi','2018-01-30 17:28:57','2018-01-30 17:28:57'),(47,'Ülvi','Paas','ulvi.paas@vikk.ee','12345678922','12121212',NULL,NULL,'$2y$10$qx0Q5BRCBtY5GPb96VzvCObAogeK.kN3QpGFvzzusVV7lNWfA.kyC','qfiERAL8ZAjmR2PS0xtAzaNcxfC26kCF3m5luOO2lV2nW9lGGn2IphRn5wES','2018-01-30 17:29:27','2018-01-30 17:29:27'),(48,'Toomas','Männiku','toomas.manniku@vikk.ee','19289909091','12121290',NULL,NULL,'$2y$10$eKsJ9ydvfoVRpnXeLjavVuEEpnvnO1Uy4cd5exAr3lHER52jfQdgy','ytInhlZ0WpqWOOzQhhrMQM7wVB9s76HUqsLkvBA2hiBIhTvekyKQoEbblh3h','2018-02-01 19:39:55','2018-02-01 19:39:55'),(54,'Admin','Admin','admin@admin.com','090912122','12345891',NULL,NULL,'$2y$10$Dl1Z4aIIIK8L1sJv7RbTj.HDEeZ7.7kcC9h9c8rjS/MdkMEy/pHT6','TinPVtcCf1d3QLU9YIS5jQHBksji5KjCHBP92oh5YURge2BBkeohrsdrhXQI','2018-03-06 17:34:15','2018-03-06 17:34:15'),(56,'Uus','Uus','uus@uus.ee','09876543210','09091232',49,1,'$2y$10$Fmeb8X.7qfBSS7CfrEiyIevLUKONAjB2GyiRiLFjzsnzvOQLOk736','labPPWNjdSmPSWDzstmr8XHO1crtmUalcrNz8JXsq2sktYaVeWaovq4YMu9J','2018-04-04 19:27:44','2018-04-04 19:35:53');
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

-- Dump completed on 2018-04-04 19:45:59
