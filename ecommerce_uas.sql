-- MySQL dump 10.13  Distrib 8.0.33, for Linux (x86_64)
--
-- Host: localhost    Database: ecommerce_uas
-- ------------------------------------------------------
-- Server version	8.0.33-0ubuntu0.22.04.2

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

--
-- Table structure for table `cart_items`
--

DROP TABLE IF EXISTS `cart_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cart_items` (
  `id` int NOT NULL AUTO_INCREMENT,
  `cart_id` int NOT NULL,
  `prod_id` int NOT NULL,
  `quantity` int DEFAULT '0',
  `status` int DEFAULT '1',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `fk_cart_items_cart_id` (`cart_id`),
  KEY `fk_cart_items_prod_id` (`prod_id`),
  CONSTRAINT `fk_cart_items_cart_id` FOREIGN KEY (`cart_id`) REFERENCES `carts` (`id`),
  CONSTRAINT `fk_cart_items_prod_id` FOREIGN KEY (`prod_id`) REFERENCES `products` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cart_items`
--

LOCK TABLES `cart_items` WRITE;
/*!40000 ALTER TABLE `cart_items` DISABLE KEYS */;
INSERT INTO `cart_items` VALUES (1,1,1,0,0,'2023-07-11 02:43:06'),(3,1,2,0,0,'2023-07-12 16:15:04'),(6,2,2,0,0,'2023-07-13 13:04:50'),(7,2,1,0,0,'2023-07-13 13:06:01'),(8,3,3,1,1,'2023-07-14 17:00:08'),(9,3,2,1,1,'2023-07-14 19:54:45'),(10,3,4,1,1,'2023-07-14 19:56:37'),(11,1,6,0,0,'2023-07-15 04:17:26'),(12,1,4,0,0,'2023-07-15 04:34:55'),(13,1,3,0,0,'2023-07-15 04:37:35'),(14,2,6,0,0,'2023-07-15 04:47:57'),(15,2,4,0,0,'2023-07-15 05:47:39');
/*!40000 ALTER TABLE `cart_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `carts`
--

DROP TABLE IF EXISTS `carts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `carts` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `fk_carts_id` (`user_id`),
  CONSTRAINT `fk_carts_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `carts`
--

LOCK TABLES `carts` WRITE;
/*!40000 ALTER TABLE `carts` DISABLE KEYS */;
INSERT INTO `carts` VALUES (1,3,'2023-07-11 02:40:03'),(2,1,'2023-07-11 06:53:52'),(3,4,'2023-07-14 16:30:53'),(4,7,'2023-07-15 19:20:37');
/*!40000 ALTER TABLE `carts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
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
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_reset_tokens_table',1),(3,'2014_10_12_100000_create_password_resets_table',1),(4,'2019_08_19_000000_create_failed_jobs_table',1),(5,'2019_12_14_000001_create_personal_access_tokens_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `order_items`
--

DROP TABLE IF EXISTS `order_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `order_items` (
  `id` int NOT NULL AUTO_INCREMENT,
  `order_id` int NOT NULL,
  `prod_id` int NOT NULL,
  `quantity` int NOT NULL,
  `price` int NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `fk_order_items_order_id` (`order_id`),
  KEY `fk_order_items_prod_id` (`prod_id`),
  CONSTRAINT `fk_order_items_order_id` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
  CONSTRAINT `fk_order_items_prod_id` FOREIGN KEY (`prod_id`) REFERENCES `products` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order_items`
--

LOCK TABLES `order_items` WRITE;
/*!40000 ALTER TABLE `order_items` DISABLE KEYS */;
INSERT INTO `order_items` VALUES (1,1,1,3,75000000,'2023-07-15 02:33:21'),(2,1,2,3,37800000,'2023-07-15 02:33:22'),(3,2,6,1,10500000,'2023-07-15 04:31:58'),(4,3,4,1,20000000,'2023-07-15 04:35:14'),(5,4,3,1,19000000,'2023-07-15 04:37:51'),(6,5,2,4,50400000,'2023-07-15 04:45:07'),(7,5,1,3,75000000,'2023-07-15 04:45:08'),(8,6,6,1,10500000,'2023-07-15 04:48:17'),(9,7,4,1,20000000,'2023-07-15 05:48:00'),(10,8,6,1,10500000,'2023-07-15 05:49:40'),(11,9,2,1,12600000,'2023-07-15 05:54:10'),(12,10,4,2,40000000,'2023-07-15 06:00:47');
/*!40000 ALTER TABLE `order_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `orders` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `invoice` varchar(50) NOT NULL,
  `shipping_method` enum('standard','express') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `shipping_price` int NOT NULL,
  `payment_method` enum('visa','mastercard','paypal','amex') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `status` enum('inprogress','done') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `fk_orders_user_id` (`user_id`),
  CONSTRAINT `fk_orders_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders`
--

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
INSERT INTO `orders` VALUES (1,3,'INV2023071','standard',112800000,'visa','done','2023-07-15 02:33:21'),(2,3,'INV2023072','standard',10500000,'visa','done','2023-07-15 04:31:57'),(3,3,'INV2023073','standard',20000000,'visa','done','2023-07-15 04:35:13'),(4,3,'INV2023074','standard',19000000,'visa','done','2023-07-15 04:37:50'),(5,1,'INV2023075','standard',125400000,'visa','inprogress','2023-07-15 04:45:07'),(6,1,'INV2023076','standard',10500000,'visa','inprogress','2023-07-15 04:48:16'),(7,1,'INV2023077','standard',20000000,'mastercard','done','2023-07-15 05:47:59'),(8,1,'INV2023078','standard',10500000,'visa','inprogress','2023-07-15 05:49:39'),(9,1,'INV2023079','standard',12600000,'visa','inprogress','2023-07-15 05:54:09'),(10,1,'INV20230710','standard',40000000,'mastercard','inprogress','2023-07-15 06:00:47');
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
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
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_resets` (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
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
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personal_access_tokens`
--

LOCK TABLES `personal_access_tokens` WRITE;
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_categories`
--

DROP TABLE IF EXISTS `product_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `product_categories` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `slug` varchar(100) NOT NULL,
  `image_url` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_categories`
--

LOCK TABLES `product_categories` WRITE;
/*!40000 ALTER TABLE `product_categories` DISABLE KEYS */;
INSERT INTO `product_categories` VALUES (1,'Elektronik','elektronik','categories/thumbnail-1.jpeg','2023-07-09 14:04:39','2023-07-14 03:20:11'),(2,'Furniture','furniture','categories/thumbnail-2.jpeg','2023-07-09 14:04:39','2023-07-14 03:20:11'),(3,'Fashion','fashion','categories/thumbnail-3.jpeg','2023-07-09 14:04:39','2023-07-14 03:20:11'),(11,'testing','testing',NULL,'2023-07-16 01:38:57','2023-07-16 01:38:57');
/*!40000 ALTER TABLE `product_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_colors`
--

DROP TABLE IF EXISTS `product_colors`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `product_colors` (
  `id` int NOT NULL AUTO_INCREMENT,
  `prod_id` int NOT NULL,
  `color` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_colors`
--

LOCK TABLES `product_colors` WRITE;
/*!40000 ALTER TABLE `product_colors` DISABLE KEYS */;
INSERT INTO `product_colors` VALUES (1,1,'Red'),(2,1,'Yellow'),(3,1,'Blue'),(4,1,'Green');
/*!40000 ALTER TABLE `product_colors` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_images`
--

DROP TABLE IF EXISTS `product_images`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `product_images` (
  `id` int NOT NULL AUTO_INCREMENT,
  `prod_id` int NOT NULL,
  `path` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=69 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_images`
--

LOCK TABLES `product_images` WRITE;
/*!40000 ALTER TABLE `product_images` DISABLE KEYS */;
INSERT INTO `product_images` VALUES (1,1,'products/ele-dtl1.jpeg'),(2,1,'products/ele-dtl2.jpeg'),(3,1,'products/ele-dtl3.jpeg'),(4,1,'products/ele-dtl4.jpeg'),(5,1,'products/ele-dtl5.jpeg'),(6,2,'products/furn-dtl1.jpeg'),(7,2,'products/furn-dtl2.jpeg'),(8,2,'products/furn-dtl3.jpeg'),(9,2,'products/furn-dtl4.jpeg'),(10,2,'products/furn-dtl5.jpeg'),(11,3,'products/ele-smg1.jpeg'),(12,3,'products/ele-smg2.jpeg'),(13,3,'products/ele-smg3.jpeg'),(14,3,'products/ele-smg4.jpeg'),(15,3,'products/ele-smg5.jpeg'),(16,4,'products/furn-lmr1.jpeg'),(17,4,'products/furn-lmr2.jpeg'),(18,4,'products/furn-lmr3.jpeg'),(19,4,'products/furn-lmr4.jpeg'),(20,4,'products/furn-lmr5.jpeg'),(21,5,'products/fash-sb1.jpeg'),(22,5,'products/fash-sb2.jpeg'),(23,5,'products/fash-sb3.jpeg'),(24,5,'products/fash-sb4.jpeg'),(25,5,'products/fash-sb5.jpeg'),(26,6,'products/fash-bj1.jpeg'),(27,6,'products/fash-bj2.jpeg'),(28,6,'products/fash-bj3.jpeg'),(29,6,'products/fash-bj4.jpeg'),(30,6,'products/fash-bj5.jpeg');
/*!40000 ALTER TABLE `product_images` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `products` (
  `id` int NOT NULL AUTO_INCREMENT,
  `cat_id` int NOT NULL,
  `thumbnail` varchar(255) NOT NULL,
  `sku` varchar(50) NOT NULL,
  `name` varchar(100) NOT NULL,
  `slug` varchar(100) NOT NULL,
  `acq_price` int DEFAULT '0',
  `sell_price` int DEFAULT '0',
  `discount_price` int DEFAULT '0',
  `stock` int DEFAULT '0',
  `rating` decimal(3,2) DEFAULT '0.00',
  `discount` decimal(5,2) DEFAULT NULL,
  `size` varchar(100) DEFAULT NULL,
  `weight` varchar(100) DEFAULT NULL,
  `manufacturer` varchar(100) DEFAULT NULL,
  `description` text,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `fk_products_cat_id` (`cat_id`),
  CONSTRAINT `fk_products_cat_id` FOREIGN KEY (`cat_id`) REFERENCES `product_categories` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (1,1,'products/thumbnail-1.jpeg','PR01-001','Laptop Macbook Pro 2019','laptop-macbook-pro-2019',20000000,25000000,0,88,0.00,NULL,NULL,NULL,NULL,'Dapatkan pengalaman komputasi yang luar biasa dengan MacBook Pro 2019! Laptop yang canggih ini menggabungkan kinerja yang luar biasa dengan desain yang elegan dan fitur-fitur unggulan yang akan memenuhi kebutuhan Anda. Dilengkapi dengan prosesor Intel Core generasi ke-9 yang kuat, MacBook Pro 2019 menawarkan kinerja yang cepat dan responsif untuk menangani tugas-tugas berat dan multitasking. Nikmati visual yang mengagumkan pada layar Retina 13,3 inci yang menghadirkan gambar yang tajam, warna yang kaya, dan kontras yang tinggi. Tampilan ini juga didukung oleh teknologi True Tone yang menyesuaikan warna layar dengan pencahayaan sekitar, memberikan pengalaman visual yang lebih alami. Dapatkan MacBook Pro 2019 sekarang dan nikmati kinerja yang andal, desain yang elegan, dan fitur-fitur unggulan yang mampu mengatasi tugas-tugas komputasi Anda dengan mudah.','2023-07-09 14:24:18','2023-07-15 17:59:52'),(2,2,'products/thumbnail-2.jpeg','PR02-001','Meja Anak Lucu','meja-anak-lucu',10000000,14000000,12600000,189,5.00,10.00,NULL,NULL,NULL,'Meja lipat anak ini terbuat dari bahan kayu MDF premium Grade A dengan kaki logam yang kokoh. Dengan berat hanya 3 kg, meja ini memiliki ukuran panjang 60 cm, lebar 40 cm, dan tinggi 28 cm. Anda dapat menggunakannya di tempat tidur atau di lantai sesuai kenyamanan Anda. Dilengkapi dengan fitur meja laptop compact, meja ini memberikan fleksibilitas yang luar biasa.','2023-07-09 14:33:48','2023-07-15 17:59:54'),(3,1,'products/thumbnail-3.jpeg','PR01-002','Samsung A09','samsung-a09',15000000,19000000,0,999,4.00,NULL,NULL,NULL,NULL,'Dapatkan pengalaman yang luar biasa dengan Samsung A04e! Ponsel pintar yang handal ini menawarkan performa yang tangguh dan fitur-fitur menarik yang akan memenuhi kebutuhan Anda sehari-hari. Nikmati tampilan yang jernih dan cerah pada layar TFT 5,7 inci yang memungkinkan Anda menikmati konten multimedia dengan detail yang kaya. Tangkap momen-momen berharga dengan kamera belakang 13 MP yang menghasilkan gambar yang tajam dan jelas, sementara kamera depan 5 MP akan memastikan selfie Anda tampak sempurna. Ditenagai oleh prosesor quad-core 1,5 GHz dan RAM 2 GB, Samsung A04e menawarkan kinerja yang cepat dan responsif. Simpan semua foto, video, dan aplikasi favorit Anda dengan kapasitas penyimpanan internal 32 GB yang dapat diperluas hingga 1 TB menggunakan kartu microSD. Baterai berkapasitas 3.000 mAh akan menjaga ponsel tetap menyala sepanjang hari. Samsung A04e menjalankan sistem operasi Android, memberikan Anda akses ke berbagai aplikasi dan fitur Android terbaru. Lindungi data pribadi Anda dengan pemindai sidik jari yang terintegrasi, yang memungkinkan Anda membuka kunci ponsel dengan mudah dan memberikan perlindungan tambahan. Dengan desain yang ramping dan ergonomis, ponsel ini cocok untuk penggunaan sehari-hari dan tersedia dalam pilihan warna yang stylish.','2023-07-09 14:33:48','2023-07-15 17:59:53'),(4,2,'products/thumbnail-4.jpeg','PR02-002','Lemari Baju','lemari-baju',20000000,25000000,20000000,146,4.50,20.00,NULL,NULL,NULL,'Dapatkan pengalaman yang luar biasa dengan Samsung A04e! Ponsel pintar yang handal ini menawarkan performa yang tangguh dan fitur-fitur menarik yang akan memenuhi kebutuhan Anda sehari-hari. Nikmati tampilan yang jernih dan cerah pada layar TFT 5,7 inci yang memungkinkan Anda menikmati konten multimedia dengan detail yang kaya. Tangkap momen-momen berharga dengan kamera belakang 13 MP yang menghasilkan gambar yang tajam dan jelas, sementara kamera depan 5 MP akan memastikan selfie Anda tampak sempurna. Ditenagai oleh prosesor quad-core 1,5 GHz dan RAM 2 GB, Samsung A04e menawarkan kinerja yang cepat dan responsif. Simpan semua foto, video, dan aplikasi favorit Anda dengan kapasitas penyimpanan internal 32 GB yang dapat diperluas hingga 1 TB menggunakan kartu microSD. Baterai berkapasitas 3.000 mAh akan menjaga ponsel tetap menyala sepanjang hari. Samsung A04e menjalankan sistem operasi Android, memberikan Anda akses ke berbagai aplikasi dan fitur Android terbaru. Lindungi data pribadi Anda dengan pemindai sidik jari yang terintegrasi, yang memungkinkan Anda membuka kunci ponsel dengan mudah dan memberikan perlindungan tambahan. Dengan desain yang ramping dan ergonomis, ponsel ini cocok untuk penggunaan sehari-hari dan tersedia dalam pilihan warna yang stylish.','2023-07-09 14:35:48','2023-07-15 17:59:54'),(5,3,'products/thumbnail-5.jpeg','PR03-001','Small Bag','small-bag',12500000,15000000,0,250,4.00,NULL,NULL,NULL,NULL,'Temukan kenyamanan dan gaya yang kompak dengan Small Bag terbaru kami! Dirancang dengan inner zipper pocket dan inner unzipped pocket, tas ini memberikan ruang yang cukup untuk menyimpan barang-barang penting Anda dengan aman. Dengan penutup magnetik yang praktis, akses cepat menjadi lebih mudah. Tersedia dalam pilihan warna yang beragam seperti Ginger, Camel, White, dan yang terbaru, BLACK! Dengan ukuran 22x9x15cm, Small Bag ini sempurna untuk menemani aktivitas sehari-hari Anda dengan gaya yang tak tertandingi. Dapatkan sekarang dan buat pernyataan fashion yang unik!','2023-07-09 14:40:48','2023-07-15 17:59:52'),(6,3,'products/thumbnail-6.jpeg','PR03-002','T-Shirt','tshirt',10000000,15000000,10500000,222,4.50,30.00,NULL,NULL,NULL,'\"Upgrade penampilanmu dengan T-Shirt berkualitas terbaik dari kami! Dibuat dengan perpaduan sempurna antara kenyamanan dan gaya, T-Shirt ini hadir dalam potongan Regular Fit yang cocok untuk semua orang. Terbuat dari bahan 100% combed cotton 24s yang lembut dan berkualitas tinggi, memastikan kenyamanan maksimal sepanjang hari. Dengan sablon Plastisol yang tahan lama dan design unisex yang stylish, T-Shirt ini adalah pilihan yang sempurna untuk gaya sehari-hari yang berkelas. Kualitas jahitan dan sablon yang terbaik menjamin keawetan produk ini. Cek Size Chart pada slide terakhir untuk menemukan ukuran yang pas untukmu! Tampilkan gayamu dengan percaya diri, dapatkan T-Shirt ini sekarang!\"','2023-07-09 14:45:48','2023-07-15 17:59:53');
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reviews`
--

DROP TABLE IF EXISTS `reviews`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `reviews` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `prod_id` int NOT NULL,
  `rating` decimal(3,2) DEFAULT '0.00',
  `review` text NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `fk_reviews_user_id` (`user_id`),
  KEY `fk_reviews_prod_id` (`prod_id`),
  CONSTRAINT `fk_reviews_prod_id` FOREIGN KEY (`prod_id`) REFERENCES `products` (`id`),
  CONSTRAINT `fk_reviews_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reviews`
--

LOCK TABLES `reviews` WRITE;
/*!40000 ALTER TABLE `reviews` DISABLE KEYS */;
INSERT INTO `reviews` VALUES (1,3,1,4.00,'Mantap barangnya saya suka!','2023-07-11 02:51:10',NULL);
/*!40000 ALTER TABLE `reviews` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_number` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `image_url` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` enum('admin','manager','pelanggan') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT 'pelanggan',
  `status` int DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Ahmad Ganteng','ahmad_ganteng@gmail.com',NULL,NULL,NULL,NULL,'$2y$10$i./jqB/zeArznqsUwpUX7ukHtd3YIBNDpm6a4AW9XZVqsG08GCbD6',NULL,'manager',1,'2023-07-09 15:16:42',NULL),(2,'Aat Ganteng','aat_ganteng@gmail.com',NULL,NULL,NULL,NULL,'$2y$10$i./jqB/zeArznqsUwpUX7ukHtd3YIBNDpm6a4AW9XZVqsG08GCbD6',NULL,'admin',1,'2023-07-09 15:17:25',NULL),(3,'Ahmad W','ahmad.waluyo@renos.id',NULL,NULL,NULL,NULL,'$2y$10$qj86wyNYfiGZzrwfM1BygeGVu6CtZqOyRpTPmzoF1ikyVZ30yLMkG',NULL,'pelanggan',1,'2023-07-09 13:17:52','2023-07-15 22:13:55'),(4,'Niszhan Syahranie','nizhan_nf@gmail.com','+6281383356527','Darmaga, Rt. 03/02 Bogor Kota',NULL,NULL,'$2y$10$nLKCc9id5vYYr9MOUAlWieN6WeBeLdmNP9Qev/3A0en3yA.f03G1e',NULL,'pelanggan',1,'2023-07-14 16:30:51','2023-07-15 22:14:27'),(5,'Abdul Thariq','abdulthariq@gmail.com','0812710988278','Ngetes',NULL,NULL,'$2y$10$i./jqB/zeArznqsUwpUX7ukHtd3YIBNDpm6a4AW9XZVqsG08GCbD6',NULL,'manager',1,'2023-07-15 15:00:09','2023-07-15 21:13:18'),(6,'Josh Gandoz','josh_gandoz@gmail.com','0898773827833','Oke','/users/thumbnail-/private/var/folders/qs/lm6nzfwj11q8b5ng8jlzz8880000gn/T/phpAEBvJ1',NULL,'$2y$10$6tce4n/BaU2ZNxwRQ8ic5uVPh38rlKRU5PKJ8rBQkE5EhGLNZsTVe',NULL,'admin',1,'2023-07-15 18:16:04','2023-07-15 18:16:04'),(7,'Arul Evos','arul_evos@gmail.com','08873882749289','Arul Depok','/users/thumbnail-Q5HbhJGbNcAJ4HfEJ18MJmNkN.jpeg',NULL,'$2y$10$AHtYesq1IdG0zUJtdjOJkOEeShenlPuiAnADhGfo6QgW1Zm14cOjW',NULL,'admin',1,'2023-07-15 18:25:55','2023-07-15 18:25:55');
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

-- Dump completed on 2023-07-16  2:12:59
