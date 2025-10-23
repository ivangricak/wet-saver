-- MariaDB dump 10.19  Distrib 10.4.27-MariaDB, for osx10.10 (x86_64)
--
-- Host: localhost    Database: saver
-- ------------------------------------------------------
-- Server version	10.4.27-MariaDB

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
-- Table structure for table `cache`
--

DROP TABLE IF EXISTS `cache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache`
--

LOCK TABLES `cache` WRITE;
/*!40000 ALTER TABLE `cache` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache_locks`
--

DROP TABLE IF EXISTS `cache_locks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache_locks`
--

LOCK TABLES `cache_locks` WRITE;
/*!40000 ALTER TABLE `cache_locks` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache_locks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categories` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (1,'first',NULL,NULL,NULL),(2,'second',NULL,NULL,NULL);
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `default_groups`
--

DROP TABLE IF EXISTS `default_groups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `default_groups` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `category_id` bigint(20) unsigned DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `default_groups_user_id_foreign` (`user_id`),
  KEY `default_groups_category_id_foreign` (`category_id`),
  CONSTRAINT `default_groups_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL,
  CONSTRAINT `default_groups_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `default_groups`
--

LOCK TABLES `default_groups` WRITE;
/*!40000 ALTER TABLE `default_groups` DISABLE KEYS */;
INSERT INTO `default_groups` VALUES (1,'default group',NULL,1,NULL,'2025-08-30 16:28:41','2025-08-30 16:28:41'),(2,'default group',3,1,NULL,'2025-09-02 16:38:51','2025-09-02 16:38:51'),(3,'default group',4,1,NULL,'2025-09-27 10:52:32','2025-09-27 10:52:32'),(4,'default group',5,1,NULL,'2025-09-27 15:35:14','2025-09-27 15:35:14');
/*!40000 ALTER TABLE `default_groups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `group_user`
--

DROP TABLE IF EXISTS `group_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `group_user` (
  `group_id` bigint(20) unsigned NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`group_id`,`user_id`),
  KEY `group_user_user_id_foreign` (`user_id`),
  CONSTRAINT `group_user_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE,
  CONSTRAINT `group_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `group_user`
--

LOCK TABLES `group_user` WRITE;
/*!40000 ALTER TABLE `group_user` DISABLE KEYS */;
INSERT INTO `group_user` VALUES (1,1,NULL,NULL),(3,1,NULL,NULL),(23,5,NULL,NULL),(26,5,NULL,NULL),(47,3,NULL,NULL),(78,3,NULL,NULL),(79,3,NULL,NULL),(80,3,NULL,NULL),(81,3,NULL,NULL),(82,3,NULL,NULL),(85,3,NULL,NULL),(86,3,NULL,NULL),(87,3,NULL,NULL),(88,3,NULL,NULL);
/*!40000 ALTER TABLE `group_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `groups`
--

DROP TABLE IF EXISTS `groups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `groups` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `category_id` bigint(20) unsigned NOT NULL,
  `state` tinyint(3) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `groups_category_id_foreign` (`category_id`),
  CONSTRAINT `groups_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=89 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `groups`
--

LOCK TABLES `groups` WRITE;
/*!40000 ALTER TABLE `groups` DISABLE KEYS */;
INSERT INTO `groups` VALUES (1,'links',1,1,'2025-08-30 13:06:02','2025-08-30 13:06:02',NULL),(3,'new people',1,1,'2025-08-30 16:14:42','2025-08-30 16:14:42',NULL),(23,'dsasd',1,1,'2025-09-27 15:49:45','2025-09-27 15:49:45',NULL),(26,'oihil',1,1,'2025-09-27 15:57:00','2025-09-27 15:57:00',NULL),(47,'+',1,1,'2025-10-08 15:32:35','2025-10-09 16:24:26',NULL),(78,'cx',1,1,'2025-10-10 15:46:21','2025-10-10 15:46:21',NULL),(79,'ві',1,1,'2025-10-11 04:18:29','2025-10-11 04:18:29',NULL),(80,'d',1,1,'2025-10-11 05:02:21','2025-10-11 05:02:21',NULL),(81,'ff',1,1,'2025-10-11 05:13:53','2025-10-11 05:13:53',NULL),(82,'ff',1,1,'2025-10-11 06:35:07','2025-10-11 06:35:07',NULL),(85,'ff',1,1,'2025-10-11 06:37:14','2025-10-11 06:37:14',NULL),(86,'vdx',1,1,'2025-10-12 06:21:34','2025-10-12 06:21:34',NULL),(87,'ds',1,1,'2025-10-12 06:21:36','2025-10-12 06:21:36',NULL),(88,'fd',1,1,'2025-10-20 17:37:16','2025-10-20 17:37:16',NULL);
/*!40000 ALTER TABLE `groups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `item_tag`
--

DROP TABLE IF EXISTS `item_tag`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `item_tag` (
  `item_id` bigint(20) unsigned NOT NULL,
  `tag_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`item_id`,`tag_id`),
  KEY `item_tag_tag_id_foreign` (`tag_id`),
  CONSTRAINT `item_tag_item_id_foreign` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`) ON DELETE CASCADE,
  CONSTRAINT `item_tag_tag_id_foreign` FOREIGN KEY (`tag_id`) REFERENCES `tags` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `item_tag`
--

LOCK TABLES `item_tag` WRITE;
/*!40000 ALTER TABLE `item_tag` DISABLE KEYS */;
INSERT INTO `item_tag` VALUES (343,1,NULL,NULL),(344,1,NULL,NULL);
/*!40000 ALTER TABLE `item_tag` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `items`
--

DROP TABLE IF EXISTS `items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `items` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `group_id` bigint(20) unsigned DEFAULT NULL,
  `default_group_id` bigint(20) unsigned DEFAULT NULL,
  `name` varchar(100) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL,
  `state` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `items_group_id_foreign` (`group_id`),
  KEY `items_default_group_id_foreign` (`default_group_id`),
  CONSTRAINT `items_default_group_id_foreign` FOREIGN KEY (`default_group_id`) REFERENCES `default_groups` (`id`) ON DELETE SET NULL,
  CONSTRAINT `items_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=472 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `items`
--

LOCK TABLES `items` WRITE;
/*!40000 ALTER TABLE `items` DISABLE KEYS */;
INSERT INTO `items` VALUES (343,23,NULL,'ile','new change','dfauhlijh',1,'2025-09-27 15:56:53','2025-09-27 17:30:26',NULL),(344,26,NULL,'ilhl','lihliuh','hiulu',1,'2025-09-27 15:57:11','2025-09-27 15:57:11',NULL),(373,NULL,2,'k','k','kівґвісґі',1,'2025-09-28 17:52:44','2025-10-12 04:41:13',NULL),(374,NULL,2,'k','k','k',1,'2025-09-28 17:54:21','2025-09-28 17:54:21',NULL),(378,NULL,2,'k','k','k',1,'2025-09-28 17:57:45','2025-09-28 17:57:45',NULL),(402,47,NULL,'dfa','nullsd','dsa',1,'2025-10-09 16:05:39','2025-10-10 15:19:42',NULL),(404,47,NULL,'jkjk',NULL,'kk',1,'2025-10-09 16:24:37','2025-10-09 16:24:37',NULL),(410,47,NULL,'dsa',NULL,'d',1,'2025-10-10 15:19:28','2025-10-10 15:19:28',NULL),(411,47,NULL,'jklj',NULL,'nklj.jnl',1,'2025-10-10 15:19:49','2025-10-10 15:19:49',NULL),(413,47,NULL,'c',NULL,'cc',1,'2025-10-10 15:42:21','2025-10-10 15:42:21',NULL),(415,78,NULL,'xc','null','xc',1,'2025-10-10 15:46:26','2025-10-10 15:46:51',NULL),(416,78,NULL,'dd',NULL,'ss',1,'2025-10-11 04:19:14','2025-10-11 04:19:14',NULL),(417,78,NULL,'dd',NULL,'xc',1,'2025-10-11 04:32:59','2025-10-11 04:32:59',NULL),(418,78,NULL,'jkj',NULL,'jk',1,'2025-10-11 04:34:07','2025-10-11 04:34:07',NULL),(419,78,NULL,'kk',NULL,'kk',1,'2025-10-11 04:34:24','2025-10-11 04:34:24',NULL),(420,78,NULL,'klk',NULL,'l',1,'2025-10-11 04:35:13','2025-10-11 04:35:13',NULL),(421,78,NULL,'jkj',NULL,'jk',1,'2025-10-11 04:35:57','2025-10-11 04:35:57',NULL),(422,79,NULL,'cc',NULL,'cc',1,'2025-10-11 04:59:03','2025-10-11 04:59:03',NULL),(423,79,NULL,'jj',NULL,'jj',1,'2025-10-11 04:59:26','2025-10-11 04:59:26',NULL),(424,79,NULL,'jj',NULL,'jj',1,'2025-10-11 04:59:32','2025-10-11 04:59:32',NULL),(425,80,NULL,'f',NULL,'df',1,'2025-10-11 05:02:29','2025-10-11 05:02:29',NULL),(426,80,NULL,'ff',NULL,'ff',1,'2025-10-11 05:03:42','2025-10-11 05:03:42',NULL),(427,80,NULL,'ff',NULL,'ff',1,'2025-10-11 05:04:00','2025-10-11 05:04:00',NULL),(428,80,NULL,'ff',NULL,'ff',1,'2025-10-11 05:05:00','2025-10-11 05:05:00',NULL),(429,79,NULL,'ii',NULL,'yy',1,'2025-10-11 05:11:47','2025-10-11 05:11:47',NULL),(430,79,NULL,'ll','nulllo','llopoo',1,'2025-10-11 05:13:25','2025-10-11 05:13:38',NULL),(431,81,NULL,'ff',NULL,'ff',1,'2025-10-11 05:14:00','2025-10-11 05:14:00',NULL),(434,NULL,2,'вв',NULL,'вв',1,'2025-10-11 05:18:54','2025-10-11 05:18:54',NULL),(435,NULL,2,'вв',NULL,'вв',1,'2025-10-11 05:19:00','2025-10-11 05:19:00',NULL),(436,80,NULL,'гне',NULL,'ркеу',1,'2025-10-11 05:19:13','2025-10-11 05:19:13',NULL),(437,81,NULL,'kkk',NULL,'kk',1,'2025-10-11 06:29:27','2025-10-11 06:29:27',NULL),(438,81,NULL,'kk',NULL,'kk',1,'2025-10-11 06:29:36','2025-10-11 06:29:36',NULL),(439,81,NULL,'kk',NULL,'kk',1,'2025-10-11 06:29:36','2025-10-11 06:29:36',NULL),(440,80,NULL,'ppp',NULL,'ppp',1,'2025-10-11 06:29:51','2025-10-11 06:29:51',NULL),(441,80,NULL,'ppp',NULL,'ppp',1,'2025-10-11 06:29:51','2025-10-11 06:29:51',NULL),(442,80,NULL,'ppp',NULL,'ppp',1,'2025-10-11 06:29:51','2025-10-11 06:29:51',NULL),(443,78,NULL,'ooooooo',NULL,'oooooo',1,'2025-10-11 06:30:24','2025-10-11 06:30:24',NULL),(444,78,NULL,'ooooooo',NULL,'oooooo',1,'2025-10-11 06:30:24','2025-10-11 06:30:24',NULL),(445,82,NULL,'kkk','nulljlkjk','kkjljk',0,'2025-10-11 06:36:22','2025-10-11 07:06:12',NULL),(446,82,NULL,'kkk',NULL,'kk',1,'2025-10-11 06:36:22','2025-10-11 06:36:22',NULL),(447,82,NULL,'ggg',NULL,'g',1,'2025-10-11 06:36:54','2025-10-11 06:36:54',NULL),(448,82,NULL,'ff',NULL,'ff',1,'2025-10-11 06:37:03','2025-10-11 06:37:03',NULL),(449,85,NULL,'qqqwqw','nullfdz','шшvdfaz',0,'2025-10-11 06:37:23','2025-10-12 08:29:38',NULL),(450,85,NULL,'ll',NULL,'ll',1,'2025-10-11 06:44:45','2025-10-11 06:44:45',NULL),(453,86,NULL,'sd',NULL,'ds',1,'2025-10-12 06:21:47','2025-10-12 06:21:47',NULL),(454,85,NULL,'df',NULL,'v',1,'2025-10-12 08:30:02','2025-10-12 08:30:02',NULL),(455,82,NULL,'asdav',NULL,'fasda',1,'2025-10-12 11:41:12','2025-10-12 11:41:12',NULL),(456,82,NULL,'sad`',NULL,'ads`',1,'2025-10-12 11:41:17','2025-10-12 11:41:17',NULL),(457,82,NULL,'fdfdfd',NULL,'fdfdfdf',1,'2025-10-12 11:41:25','2025-10-12 11:41:25',NULL),(458,47,NULL,'aaaa',NULL,'aaaa',1,'2025-10-12 11:42:22','2025-10-12 11:42:22',NULL),(459,47,NULL,'aa',NULL,'aaa',1,'2025-10-12 11:42:28','2025-10-12 11:42:28',NULL),(460,47,NULL,'bbb',NULL,'bbb',1,'2025-10-12 11:42:35','2025-10-12 11:42:35',NULL),(461,47,NULL,'bb',NULL,'bbb',1,'2025-10-12 11:42:41','2025-10-12 11:42:41',NULL),(462,47,NULL,'ccc',NULL,'ccc',1,'2025-10-12 11:42:47','2025-10-12 11:42:47',NULL),(463,47,NULL,'ccc',NULL,'ccc',1,'2025-10-12 11:42:54','2025-10-12 11:42:54',NULL),(464,80,NULL,'fd',NULL,'ds',1,'2025-10-12 11:59:28','2025-10-12 11:59:28',NULL),(465,80,NULL,'ddd',NULL,'dd',1,'2025-10-12 11:59:36','2025-10-12 11:59:36',NULL),(466,80,NULL,'dd',NULL,'dd',1,'2025-10-12 11:59:41','2025-10-12 11:59:41',NULL),(467,80,NULL,'sd',NULL,'ds',1,'2025-10-12 11:59:47','2025-10-12 11:59:47',NULL),(468,80,NULL,'cx',NULL,'dsx',1,'2025-10-12 11:59:52','2025-10-12 11:59:52',NULL),(469,80,NULL,'dszx',NULL,'xz',1,'2025-10-12 11:59:57','2025-10-12 11:59:57',NULL),(470,87,NULL,'dfsa',NULL,'ds',1,'2025-10-13 14:34:08','2025-10-13 14:34:08',NULL),(471,88,NULL,'fdz','null','c',0,'2025-10-20 17:37:23','2025-10-20 17:37:29',NULL);
/*!40000 ALTER TABLE `items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `job_batches`
--

DROP TABLE IF EXISTS `job_batches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `job_batches`
--

LOCK TABLES `job_batches` WRITE;
/*!40000 ALTER TABLE `job_batches` DISABLE KEYS */;
/*!40000 ALTER TABLE `job_batches` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) unsigned NOT NULL,
  `reserved_at` int(10) unsigned DEFAULT NULL,
  `available_at` int(10) unsigned NOT NULL,
  `created_at` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jobs`
--

LOCK TABLES `jobs` WRITE;
/*!40000 ALTER TABLE `jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'0001_01_01_000000_create_users_table',1),(2,'0001_01_01_000001_create_cache_table',1),(3,'0001_01_01_000002_create_jobs_table',1),(4,'2025_08_20_162918_create_categories_table',1),(5,'2025_08_20_165247_create_tags_table',1),(6,'2025_08_20_165441_create_default_groups_table',1),(7,'2025_08_20_165442_create_groups_table',1),(8,'2025_08_20_192625_create_items_table',1),(9,'2025_08_20_192626_create_item_tag_table',1),(10,'2025_08_26_115927_create_group_user_table',1),(11,'2025_09_27_141732_add_state_to_groups',2);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_reset_tokens` (
  `login` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`login`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_reset_tokens`
--

LOCK TABLES `password_reset_tokens` WRITE;
/*!40000 ALTER TABLE `password_reset_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_reset_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sessions`
--

LOCK TABLES `sessions` WRITE;
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
INSERT INTO `sessions` VALUES ('qL6LLxykcEfzFUMedwpOQUjJqtfrXgFOGU6KWoZH',3,'127.0.0.1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36','YTo0OntzOjY6Il90b2tlbiI7czo0MDoiVFdHZHJhWmxjNWJSNk5wWnAxWWhJVGhSdTNWc1VnbG1URzdiRkpIUiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NTA6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9vbmxpbmUvZ3JvdXAvODYvaXRlbXM/cGFnZT0xIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6Mzt9',1760989550),('u18kJ4I6nafr2NCl6CdSqiq6aSPjpiiQfk6RqFLH',NULL,'127.0.0.1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiQUxpVVhvbGNxUEtvOFNpellHR3AwcG5XNWVGeThKT3dDcWJkZklrRyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1761037787);
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tags`
--

DROP TABLE IF EXISTS `tags`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tags` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tags`
--

LOCK TABLES `tags` WRITE;
/*!40000 ALTER TABLE `tags` DISABLE KEYS */;
INSERT INTO `tags` VALUES (1,'tag',NULL,NULL,NULL);
/*!40000 ALTER TABLE `tags` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nick` varchar(255) NOT NULL,
  `login` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `login_verified_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_login_unique` (`login`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'max','max','$2y$12$3BwZvkF6OARg.0waAA2zd.L0vwiRn8CDpfiqrwbhkKuDjKiqYRdEi',NULL,NULL,'2025-08-26 17:56:41','2025-08-26 17:56:41'),(3,'ivan','ivan','$2y$12$ED4UA67scsoIavrHI2w/auI3jyLuu2SwwyhsnCkMv0d2N6PLVnA16',NULL,NULL,'2025-09-02 16:38:51','2025-09-02 16:38:51'),(4,'o','o','$2y$12$POpm7vJeFNV3oFVgJoazUO1Do7MxiOojbQ988Y7fGwvv9mcaWJN3u',NULL,NULL,'2025-09-27 10:52:32','2025-09-27 10:52:32'),(5,'test','test','$2y$12$wm/5x12qdmr/1eutqfKuEe1aEGXmN/dVKRSrQ7ogyGFGP852iN4AS',NULL,NULL,'2025-09-27 15:35:14','2025-09-27 15:35:14');
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

-- Dump completed on 2025-10-21 16:21:15
