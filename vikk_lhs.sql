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
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comments`
--

LOCK TABLES `comments` WRITE;
/*!40000 ALTER TABLE `comments` DISABLE KEYS */;
INSERT INTO `comments` VALUES (9,'g123',51,40,'2018-02-17 11:23:17','2018-02-17 11:23:17'),(10,'asfasf',51,40,'2018-02-17 11:24:45','2018-02-17 11:24:45');
/*!40000 ALTER TABLE `comments` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fileentries`
--

LOCK TABLES `fileentries` WRITE;
/*!40000 ALTER TABLE `fileentries` DISABLE KEYS */;
INSERT INTO `fileentries` VALUES (4,34,'phpOgbJqd.txt','text/plain','New Text Document.txt','2018-02-03 21:16:35','2018-02-03 21:16:35'),(25,51,'php8G6zmx.pdf','application/pdf','Tunniplaan 27.02-03.03.pdf','2018-02-17 11:23:01','2018-02-17 11:23:01'),(26,51,'phpIvSr5M.pdf','application/pdf','Tunniplaan 3.pdf','2018-02-19 10:01:26','2018-02-19 10:01:26'),(27,54,'php6P8ZHn.pdf','application/pdf','Tunniplaan 1.pdf','2018-03-10 12:06:36','2018-03-10 12:06:36');
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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `groups`
--

LOCK TABLES `groups` WRITE;
/*!40000 ALTER TABLE `groups` DISABLE KEYS */;
INSERT INTO `groups` VALUES (3,'TAK17','2018-03-06 17:56:17','2018-03-06 17:56:17'),(4,'IS18','2018-03-06 17:56:24','2018-03-06 17:56:24'),(6,'KE14','2018-03-06 18:07:38','2018-03-06 18:07:38'),(8,'IS17','2018-03-06 18:14:06','2018-03-06 18:14:06');
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
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `internships`
--

LOCK TABLES `internships` WRITE;
/*!40000 ALTER TABLE `internships` DISABLE KEYS */;
INSERT INTO `internships` VALUES (10,39,'Tarkvara Tehnoloogia Arenduskeskus','2018-02-08','2018-05-12',452,'2018-02-10 15:25:41','2018-02-10 15:25:41'),(11,39,'Voog','2018-02-06','2018-04-19',542,'2018-02-10 15:26:00','2018-02-10 15:26:00'),(12,40,'Nortal','2018-02-09','2018-05-24',531,'2018-02-13 17:34:04','2018-02-13 17:34:04');
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
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_000000_create_students_table',1),(2,'2014_10_12_100000_create_password_resets_table',1),(3,'2018_01_06_154048_create_theses_table',2),(4,'2018_01_06_185034_add_timestamps_column_to_theses_table',3),(5,'2018_01_07_104554_create_thesess_table',4),(6,'2018_01_07_155710_add_student_id_field_to_theses_table',5),(20,'2018_01_07_160251_create_theses_table',6),(21,'2018_01_08_192037_create_internships_table',6),(22,'2018_01_14_174345_create_fileentries_table',6),(23,'2018_01_16_184802_create_roles_table',6),(24,'2018_01_17_183842_create_users_table',6),(25,'2018_01_17_185928_add_user_id_to_theses_table',7),(26,'2018_01_17_185955_add_user_id_to_internships_table',7),(27,'2018_01_17_190006_add_user_id_to_fileentries_table',7),(28,'2018_01_17_191445_add_role_id_to_users_table',8),(29,'2018_01_18_114801_remove_role_id_from_users_table',9),(30,'2018_01_18_123134_remove_user_id_from_theses_table',10),(31,'2018_01_18_123423_remove_user_id_from_filentries_table',11),(32,'2018_01_18_124013_add_fileentry_id_to_theses_table',12),(33,'2018_01_18_124647_remove_fileentry_id_from_theses_table',13),(34,'2018_01_18_124751_add_thesis_id_to_fileentries_table',14),(42,'2018_01_18_193134_create_roles_theses_users_table',15),(43,'2018_01_28_172523_create_fileentries_table',16),(44,'2018_01_30_171150_add_name_to_theses',17),(46,'2018_02_03_111714_create_fileentries_table',18),(47,'2018_02_04_095754_create_statuses_table',19),(48,'2018_02_04_100149_add_statuses_column_to_theses_table',20),(49,'2018_02_17_093019_create_comments_table',21),(52,'2018_03_05_191838_create_groups_table',22),(53,'2018_03_06_181639_add_group_id_to_theses_table',23);
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
  CONSTRAINT `roles_theses_users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE,
  CONSTRAINT `roles_theses_users_thesis_id_foreign` FOREIGN KEY (`thesis_id`) REFERENCES `theses` (`id`) ON DELETE CASCADE,
  CONSTRAINT `roles_theses_users_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=103 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles_theses_users`
--

LOCK TABLES `roles_theses_users` WRITE;
/*!40000 ALTER TABLE `roles_theses_users` DISABLE KEYS */;
INSERT INTO `roles_theses_users` VALUES (13,1,NULL,39),(14,1,NULL,40),(15,7,NULL,41),(27,7,NULL,45),(28,7,NULL,46),(29,2,NULL,47),(46,7,NULL,48),(54,1,34,48),(55,3,34,41),(89,1,51,40),(90,3,51,47),(97,5,NULL,39),(99,7,NULL,54),(100,6,NULL,54),(101,1,54,39),(102,3,54,46);
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
  PRIMARY KEY (`id`),
  KEY `theses_status_id_foreign` (`status_id`),
  KEY `theses_group_id_foreign` (`group_id`),
  CONSTRAINT `theses_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`),
  CONSTRAINT `theses_status_id_foreign` FOREIGN KEY (`status_id`) REFERENCES `statuses` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `theses`
--

LOCK TABLES `theses` WRITE;
/*!40000 ALTER TABLE `theses` DISABLE KEYS */;
INSERT INTO `theses` VALUES (34,'Testin123','2018-02-22','2018-02-03 21:16:22','2018-02-03 21:16:22',1,3),(51,'Android rakenduse loomine Viljandi Gümnaasiumile','2018-02-16','2018-02-17 11:23:00','2018-02-17 11:23:00',1,6),(54,'Viljandi Kutseõppekeskuse lõpetamise haldussüsteemi loomine','2018-06-14','2018-03-06 18:34:06','2018-03-06 18:44:43',1,6);
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
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (39,'Alvar Anthony','Hämäläinen','alvar.hamalainen@vikk.ee','39501126816','56949584','$2y$10$MbgvnEwqMMm3CaSJtuimS.0zCoXdsqltJEo11C1qNXx5UPhVfYk5K','OrtZOan8n8Rz76xHtm4L2Gos4rJeH7kz1L4QPc0futFn2RhhEMLSamuwjs8J','2018-01-28 13:07:26','2018-01-28 13:07:26'),(40,'Alo','Malo','alo.malo@vikk.ee','12345678910','12120909','$2y$10$Vg98GbsQLapGTWq4NjwtrOc1uW3uyCEdKJV3liI2xiGsaGgSDDfQO','PJb2o4OcxanoAvuqT8JMAZGyTKuzW0j9r0IqAbwqPpQI6l4dHQaBVNFxvcXr','2018-01-28 13:08:10','2018-01-28 13:08:10'),(41,'Ott','Kukk','ott.kukk@vikk.ee','09091209120','12091209','$2y$10$j9XJLmwcc9TF99yTIYZpjOXh00LN1l7jJe70acQuqEEW14wOOz1O2','vTjOYHuid2KfYnC3L7PPz9Z48sg4TYdvSbxX4zwv9KGrCYqmslIliLrkzEid','2018-01-28 13:08:38','2018-01-28 13:08:38'),(45,'Tiina','Tambet','tiina.tambet@vikk.ee','12345678911','12421221','$2y$10$Bsi1TpFzAS7qQ9JiYuS.Wum.Is1vmhrzVxLQ.zICCednjX4L9I4AO','FkmQ2icmD9XHyckxLI55Ng0qAKgxLf3EPCCiwgMPt3ahA5ALujMVnis3dWmP','2018-01-30 17:27:05','2018-01-30 17:27:05'),(46,'Jaanus','Alnek','jaanus.alnek@vikk.ee','12345678912','09098121','$2y$10$9kdgxCyPBBUv4q4nCmkOv.3leAY2laI7mW9vf6ri4cEQXQCqZip8i','Bf0UR4rxjstZa46oad1NJzqhK1yrSRn4qX9yTYgAAUGtkfhIE4Kyv6azQL5x','2018-01-30 17:28:57','2018-01-30 17:28:57'),(47,'Ülvi','Paas','ulvi.paas@vikk.ee','12345678922','12121212','$2y$10$qx0Q5BRCBtY5GPb96VzvCObAogeK.kN3QpGFvzzusVV7lNWfA.kyC','sDonZSjK6dEObU3rUZP5jNsYsdidcCO91eTFqfGT1kOL70jNqm8GSH06ggPk','2018-01-30 17:29:27','2018-01-30 17:29:27'),(48,'Toomas','Männiku','toomas.manniku@vikk.ee','19289909091','12121290','$2y$10$eKsJ9ydvfoVRpnXeLjavVuEEpnvnO1Uy4cd5exAr3lHER52jfQdgy','kKZbosRQc4bfwBSlnM5ouSGVj4ZJuJqIjYEIyxETglnnoqayY1CtPrUyluel','2018-02-01 19:39:55','2018-02-01 19:39:55'),(54,'Admin','Admin','admin@admin.com','090912122','12345891','$2y$10$Dl1Z4aIIIK8L1sJv7RbTj.HDEeZ7.7kcC9h9c8rjS/MdkMEy/pHT6','mJMChSn7Cjda5lOnmgtQsLCWW6xvcbjUiWqKXlyHyj7GtRhRAy84yABtOuOi','2018-03-06 17:34:15','2018-03-06 17:34:15');
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

-- Dump completed on 2018-03-10 12:12:51
