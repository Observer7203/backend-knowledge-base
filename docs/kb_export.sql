
/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
DROP TABLE IF EXISTS `cache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` bigint NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `cache` WRITE;
/*!40000 ALTER TABLE `cache` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `cache_locks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` bigint NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_locks_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `cache_locks` WRITE;
/*!40000 ALTER TABLE `cache_locks` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache_locks` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `job_batches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `job_batches` WRITE;
/*!40000 ALTER TABLE `job_batches` DISABLE KEYS */;
/*!40000 ALTER TABLE `job_batches` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` smallint unsigned NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `available_at` int unsigned NOT NULL,
  `created_at` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `jobs` WRITE;
/*!40000 ALTER TABLE `jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `jobs` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'0001_01_01_000000_create_users_table',1),(2,'0001_01_01_000001_create_cache_table',1),(3,'0001_01_01_000002_create_jobs_table',1),(4,'2024_01_01_000010_create_kb_progress_tables',1),(5,'2026_05_22_210000_extend_modules_for_pages',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `modules`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `modules` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `badge` varchar(64) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `badge_class` varchar(64) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `icon` varchar(64) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `icon_class` varchar(64) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `group_name` varchar(64) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `layout` varchar(16) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'sidebar',
  `is_published` tinyint(1) NOT NULL DEFAULT '1',
  `file` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_topics` int NOT NULL DEFAULT '0',
  `sort_order` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `modules_slug_unique` (`slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `modules` WRITE;
/*!40000 ALTER TABLE `modules` DISABLE KEYS */;
INSERT INTO `modules` VALUES ('backend-learning-program','Backend_Learning_Program','Программа & Расписание','Roadmap 9 фаз, 16-недельное расписание с интервальным повторением, 24 вопроса собеседования, топ курсы и ресурсы.','ROADMAP','badge-program','map','ic-purple','Modules','sidebar',1,'kb.Backend_Learning_Program',0,0,'2026-05-23 22:32:55','2026-05-23 22:32:55'),('kb1','KB_1_PHP_Core','PHP Core','Типы, ООП, traits, интерфейсы, магические методы, namespaces, PHP 8.x, генераторы, closures. 12 разделов.','PHP','badge-php','code-2','ic-purple','Modules','sidebar',1,'kb.KB_1_PHP_Core',0,10,'2026-05-23 22:32:55','2026-05-23 22:32:55'),('kb10','KB_10_Laravel_Helpers','Хелперы & методы','Практический справочник: request/validation, Eloquent, Collections, Str, Arr, Carbon, session/auth, routing, debug, artisan. Каждый хелпер с объяснением и use case. 95% повседневных задач.','HELPERS','badge-laravel','wrench','ic-blue','Modules','sidebar',1,'kb.KB_10_Laravel_Helpers',0,100,'2026-05-23 22:32:55','2026-05-23 22:32:55'),('kb11','KB_11_Cloud_DevOps_Networking','Cloud & DevOps — Сети','Виртуализация (VM, гипервизоры), типы сетей, OSI и TCP/IP с примерами, MAC/IPv4/IPv6, ARP/TCP/UDP/ICMP/порты, подсети и CIDR, NAT, VLAN. С аналогиями и диаграммами — понятно.','NETWORKING','badge-devops','network','ic-teal','Advanced','sidebar',1,'kb.KB_11_Cloud_DevOps_Networking',0,110,'2026-05-23 22:32:55','2026-05-23 22:32:55'),('kb12','KB_12_Eloquent_Advanced','Eloquent Advanced','Глубокий разбор: все relations (включая polymorphic, hasManyThrough), кастомные касты, observers, race conditions, chunk vs cursor vs lazy. С практикой и interview-вопросами middle/senior уровня.','ELOQUENT','badge-laravel','database','ic-orange','Advanced','sidebar',1,'kb.KB_12_Eloquent_Advanced',0,120,'2026-05-23 22:32:55','2026-05-23 22:32:55'),('kb13','KB_13_Service_Container_DI','Service Container & DI','Архитектурное ядро Laravel: bindings, contextual, tagged, autowiring, Service Providers, deferred, package providers. Practical patterns для расширяемых модулей и тестов.','CONTAINER','badge-arch','box','ic-purple','Advanced','sidebar',1,'kb.KB_13_Service_Container_DI',0,130,'2026-05-23 22:32:55','2026-05-23 22:32:55'),('kb14','KB_14_Testing_Deep','Тестирование — глубоко','Test doubles по Мезаросу, дизайн тестов, пирамида/трофей/соты, DB-стратегии, параллельные тесты, время и очереди, mutation testing, coverage, snapshot, миграция legacy. Дополняет KB_6.','TESTING','badge-devops','flask-conical','ic-blue','Advanced','sidebar',1,'kb.KB_14_Testing_Deep',0,140,'2026-05-23 22:32:55','2026-05-23 22:32:55'),('kb2','KB_2_SQL_Database','SQL & Базы данных','Реляционная модель, нормализация, JOIN-семантика, индексы (B-Tree, GIN, covering, leftmost), EXPLAIN, N+1, ACID, MVCC, deadlock, window-функции и CTE, MySQL vs Postgres, PDO. Middle/senior.','SQL','badge-sql','database','ic-teal','Modules','sidebar',1,'kb.KB_2_SQL_Database',0,20,'2026-05-23 22:32:55','2026-05-23 22:32:55'),('kb3','KB_3_Laravel','Laravel','Request Lifecycle, Routing с scoped bindings, Middleware и terminate, Validation/FormRequest, Eloquent основа, Cache с lock, Queues (retry, idempotency, afterCommit), Events, Scheduler, Auth/Gates/Policies, Octane long-running. Middle/senior.','LARAVEL','badge-laravel','flame','ic-orange','Modules','sidebar',1,'kb.KB_3_Laravel',0,30,'2026-05-23 22:32:55','2026-05-23 22:32:55'),('kb4','KB_4_Security','Безопасность','OWASP Top 10, пароли (bcrypt/argon2), JWT/Sanctum, OAuth 2.0 + PKCE, RBAC/ABAC, CSRF, XSS (3 типа), SQL Injection, CORS, Rate Limiting, TLS, Security Headers, Secrets Management. Middle/senior.','SECURITY','badge-security','shield-check','ic-danger','Modules','sidebar',1,'kb.KB_4_Security',0,40,'2026-05-23 22:32:55','2026-05-23 22:32:55'),('kb5','KB_5_Architecture','Архитектура & Паттерны','SOLID принципы, GoF-паттерны (Factory, Strategy, Observer, Decorator, Adapter), Repository vs Active Record, Service Layer, DTO, DDD-тактика (Entity, Value Object, Aggregate), Clean Architecture, Hexagonal. Middle/senior.','PATTERNS','badge-arch','layers','ic-warning','Modules','sidebar',1,'kb.KB_5_Architecture',0,50,'2026-05-23 22:32:55','2026-05-23 22:32:55'),('kb6','KB_6_Testing_DevOps','Тестирование & DevOps','PHPUnit/Pest основы, unit/feature тесты, TDD, Docker и Docker Compose, Git workflow, CI/CD (GitHub Actions), Nginx конфиг, Deploy стратегии (zero-downtime). Дополняет KB_14 по тестированию.','DEVOPS','badge-devops','flask-conical','ic-blue','Modules','sidebar',1,'kb.KB_6_Testing_DevOps',0,60,'2026-05-23 22:32:55','2026-05-23 22:32:55'),('kb9','KB_9_Laravel_Inheritance','Наследование & Базовые классы','Что наследуют Controller, Model, FormRequest, Middleware, Job, Command, Notification, Mailable, Event/Listener. Интерфейсы, трейты, фасады — цепочки наследования и API родителей.','INHERITANCE','badge-laravel','git-branch','ic-purple','Modules','sidebar',1,'kb.KB_9_Laravel_Inheritance',0,90,'2026-05-23 22:32:55','2026-05-23 22:32:55'),('schedule-daily','Schedule_Daily','Дневное расписание','Детальный план занятий на день с интервальным повторением.','SCHEDULE','badge-program','calendar','ic-purple','Methodology','fullwidth',1,'kb.Schedule_Daily',0,200,'2026-05-23 22:32:55','2026-05-23 22:32:55');
/*!40000 ALTER TABLE `modules` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `password_reset_tokens` WRITE;
/*!40000 ALTER TABLE `password_reset_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_reset_tokens` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `sessions` WRITE;
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `study_sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `study_sessions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `module_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `duration_minutes` int NOT NULL DEFAULT '0',
  `notes` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `studied_at` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `study_sessions` WRITE;
/*!40000 ALTER TABLE `study_sessions` DISABLE KEYS */;
/*!40000 ALTER TABLE `study_sessions` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `topics`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `topics` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `module_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'not_started',
  `sort_order` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `topics_module_id_foreign` (`module_id`),
  CONSTRAINT `topics_module_id_foreign` FOREIGN KEY (`module_id`) REFERENCES `modules` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `topics` WRITE;
/*!40000 ALTER TABLE `topics` DISABLE KEYS */;
/*!40000 ALTER TABLE `topics` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
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

