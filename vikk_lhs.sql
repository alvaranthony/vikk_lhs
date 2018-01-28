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
-- Table structure for table `fileentries`
--

DROP TABLE IF EXISTS `fileentries`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fileentries` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned DEFAULT NULL,
  `filename` varchar(2083) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mime` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `original_filename` varchar(2083) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fileentries_user_id_foreign` (`user_id`),
  CONSTRAINT `fileentries_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fileentries`
--

LOCK TABLES `fileentries` WRITE;
/*!40000 ALTER TABLE `fileentries` DISABLE KEYS */;
INSERT INTO `fileentries` VALUES (1,39,'phpr706rg.docx','application/vnd.openxmlformats-officedocument.wordprocessingml.document','Failivahetus internetis - probleem või võimalus.docx','2018-01-28 17:31:40','2018-01-28 17:31:40'),(2,39,'phpdOsqte.docx','application/vnd.openxmlformats-officedocument.wordprocessingml.document','Kaitsekõne.docx','2018-01-28 17:33:43','2018-01-28 17:33:43'),(3,39,'php6ypLYP.docx','application/vnd.openxmlformats-officedocument.wordprocessingml.document','Kaitsmine.docx','2018-01-28 18:25:50','2018-01-28 18:25:50');
/*!40000 ALTER TABLE `fileentries` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `internships`
--

LOCK TABLES `internships` WRITE;
/*!40000 ALTER TABLE `internships` DISABLE KEYS */;
INSERT INTO `internships` VALUES (2,39,'Tarkvara Tehnoloogia Arenduskeskus OÜ','2017-04-04','2017-07-04',498,'2018-01-28 17:22:42','2018-01-28 17:23:08'),(3,39,'Edicy OÜ','2017-12-04','2018-04-04',500,'2018-01-28 17:23:41','2018-01-28 17:23:41');
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
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_000000_create_students_table',1),(2,'2014_10_12_100000_create_password_resets_table',1),(3,'2018_01_06_154048_create_theses_table',2),(4,'2018_01_06_185034_add_timestamps_column_to_theses_table',3),(5,'2018_01_07_104554_create_thesess_table',4),(6,'2018_01_07_155710_add_student_id_field_to_theses_table',5),(20,'2018_01_07_160251_create_theses_table',6),(21,'2018_01_08_192037_create_internships_table',6),(22,'2018_01_14_174345_create_fileentries_table',6),(23,'2018_01_16_184802_create_roles_table',6),(24,'2018_01_17_183842_create_users_table',6),(25,'2018_01_17_185928_add_user_id_to_theses_table',7),(26,'2018_01_17_185955_add_user_id_to_internships_table',7),(27,'2018_01_17_190006_add_user_id_to_fileentries_table',7),(28,'2018_01_17_191445_add_role_id_to_users_table',8),(29,'2018_01_18_114801_remove_role_id_from_users_table',9),(30,'2018_01_18_123134_remove_user_id_from_theses_table',10),(31,'2018_01_18_123423_remove_user_id_from_filentries_table',11),(32,'2018_01_18_124013_add_fileentry_id_to_theses_table',12),(33,'2018_01_18_124647_remove_fileentry_id_from_theses_table',13),(34,'2018_01_18_124751_add_thesis_id_to_fileentries_table',14),(42,'2018_01_18_193134_create_roles_theses_users_table',15),(43,'2018_01_28_172523_create_fileentries_table',16);
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
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'Õpilane'),(2,'Õpetaja'),(3,'Juhendaja'),(4,'Komisjoni esimees'),(5,'Komisjoni liige'),(6,'Administraator'),(7,'Vaikimisi');
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
  CONSTRAINT `roles_theses_users_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `roles_theses_users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE,
  CONSTRAINT `roles_theses_users_thesis_id_foreign` FOREIGN KEY (`thesis_id`) REFERENCES `theses` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles_theses_users`
--

LOCK TABLES `roles_theses_users` WRITE;
/*!40000 ALTER TABLE `roles_theses_users` DISABLE KEYS */;
INSERT INTO `roles_theses_users` VALUES (13,1,NULL,39),(14,1,NULL,40),(15,7,NULL,41),(19,1,18,39),(20,1,19,40);
/*!40000 ALTER TABLE `roles_theses_users` ENABLE KEYS */;
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
  `instructor_first_name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `instructor_last_name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `reviewer_first_name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `reviewer_last_name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `theses`
--

LOCK TABLES `theses` WRITE;
/*!40000 ALTER TABLE `theses` DISABLE KEYS */;
INSERT INTO `theses` VALUES (18,'Viljandi Kutseõppekeskuse lõpetamise Haldussüsteemi loomine','2018-03-22','Jaanus','Alnek','Mari','Murakas','2018-01-28 13:49:26','2018-01-28 13:49:26'),(19,'Rakendushaldus süsteem Viljandi Õpilaskojale','2018-01-19','Tiina','Mäetaguse','Sina','Murakas','2018-01-28 13:50:56','2018-01-28 13:50:56');
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
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  UNIQUE KEY `users_id_code_unique` (`id_code`),
  UNIQUE KEY `users_phone_number_unique` (`phone_number`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (39,'Alvar Anthony','Hämäläinen','alvar.hamalainen@vikk.ee','39501126816','56949584','$2y$10$MbgvnEwqMMm3CaSJtuimS.0zCoXdsqltJEo11C1qNXx5UPhVfYk5K','NpjyHMM1kK7FSPTHWcWUXXstnTJTQl6E8QJ00Qohyr2GkceBdvrIJipthKgY','2018-01-28 13:07:26','2018-01-28 13:07:26'),(40,'Alo','Malo','alo.malo@vikk.ee','12345678910','12120909','$2y$10$Vg98GbsQLapGTWq4NjwtrOc1uW3uyCEdKJV3liI2xiGsaGgSDDfQO','1PiGFYHdtFzwx5q0JI5hGMVG6Ys2M25tROpqfVttJNKTtUeAChG8aVtpB3gI','2018-01-28 13:08:10','2018-01-28 13:08:10'),(41,'Ott','Kukk','ott.kukk@vikk.ee','09091209120','12091209','$2y$10$j9XJLmwcc9TF99yTIYZpjOXh00LN1l7jJe70acQuqEEW14wOOz1O2','FmktkMvVjn2gI57MflCmIiQSOdTDi8LJdxJ83357ZkRFfslbWcQMw7jy3imj','2018-01-28 13:08:38','2018-01-28 13:08:38');
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

-- Dump completed on 2018-01-28 18:35:54
