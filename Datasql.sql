-- MySQL dump 10.13  Distrib 8.0.34, for Win64 (x86_64)
--
-- Host: localhost    Database: hkdng5
-- ------------------------------------------------------
-- Server version	8.0.35

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
-- Table structure for table `cartlists`
--

DROP TABLE IF EXISTS `cartlists`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cartlists` (
  `id` int NOT NULL AUTO_INCREMENT,
  `maSP` int DEFAULT NULL,
  `uid` int DEFAULT NULL,
  `soLuongMua` int DEFAULT NULL,
  `status` tinyint DEFAULT NULL,
  `createdAt` timestamp NULL DEFAULT NULL,
  `updatedAt` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cartlists`
--

LOCK TABLES `cartlists` WRITE;
/*!40000 ALTER TABLE `cartlists` DISABLE KEYS */;
/*!40000 ALTER TABLE `cartlists` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `category` (
  `id` int NOT NULL AUTO_INCREMENT,
  `category_name` varchar(200) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `category_image` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `category`
--

LOCK TABLES `category` WRITE;
/*!40000 ALTER TABLE `category` DISABLE KEYS */;
INSERT INTO `category` VALUES (1,'Điện thoại-Máy tính bảng','http://th.bing.com/th/id/R.ab0501b96ca97ccf9cbd75d47c874502?rik=JlcDrnQi4Ym22Q&pid=ImgRaw&r=0'),(2,'Laptop-Máy vi tính-Linh kiện','http://th.bing.com/th/id/R.4d7cc9dc05113e97600e294c4b070f13?rik=j4lYD32es%2b7eLQ&pid=ImgRaw&r=0'),(3,'Nhà sách','http://png.pngtree.com/png-clipart/20190904/original/pngtree-a-book-to-open-learning-png-image_4475561.jpg'),(4,'Thiết bị sô -Phụ kiện số','http://png.pngtree.com/png-clipart/20220501/original/pngtree-headphones-cartoon-colorful-music-decorative-painting-png-image_7618407.png'),(5,'Đồng hồ - Trang sức','http://th.bing.com/th/id/R.8cd1f1f973c81eaf0161d004dcf8c2d0?rik=zf%2b72gEQ9H2EcA&riu=http%3a%2f%2fpngimg.com%2fuploads%2fwatches%2fwatches_PNG9863.png&ehk=ttwMOd1r2%2f7%2fMxhJSjxNMihWKBxd%2fD7rvUR9Wpjit28%3d&risl=&pid=ImgRaw&r=0');
/*!40000 ALTER TABLE `category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `images`
--

DROP TABLE IF EXISTS `images`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `images` (
  `id` int NOT NULL AUTO_INCREMENT,
  `path` varchar(255) DEFAULT NULL,
  `decs` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `images`
--

LOCK TABLES `images` WRITE;
/*!40000 ALTER TABLE `images` DISABLE KEYS */;
INSERT INTO `images` VALUES (9,'image/25-12-23-1703481056-23175.jpg',NULL);
/*!40000 ALTER TABLE `images` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product`
--

DROP TABLE IF EXISTS `product`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `product` (
  `id` int NOT NULL AUTO_INCREMENT,
  `product_name` varchar(200) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `product_price` int DEFAULT NULL,
  `product_image` varchar(200) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `category_id` int DEFAULT NULL,
  `product_decs` varchar(1000) DEFAULT NULL,
  `id_shop` int DEFAULT NULL,
  `product_review` int DEFAULT '0',
  `product_numbersell` int DEFAULT NULL,
  `product_selled` int DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product`
--

LOCK TABLES `product` WRITE;
/*!40000 ALTER TABLE `product` DISABLE KEYS */;
INSERT INTO `product` VALUES (6,'Apple iPhone 15',21750000,'https://jasystore.com/wp-content/uploads/2021/12/apple-iphone-15-pro-1.jpg',1,'Nội dung quảng cáoiPhone 15 sở hữu Dynamic Island, camera Chính 48MP và USB-C trong thiết kế bằng kính pha màu và nhôm bền bỉ. Tính năng nổi bậtDYNAMIC ISLAND RA MẮT TRÊN IPHONE 15 — Dynamic Isla...',12,18,1000,263),(7,'Điện thoại Samsung Galaxy S22 Plus 5G (8GB/256GB)',24550000,'https://files.refurbed.com/ii/samsung-galaxy-s22-ultra-5g-1653653899.jpg',1,'Mở ra quy chuẩn thiết kế thời thượngThiết kế thời thượng cùng chất liệu bền bỉ nhất, Samsung Galaxy S22 Plus mở ra quy chuẩn thiết kế cao cấp trên thị trường. Kiểu thiết kế Contour-Cut đậm chất sáng ...',12,5,1000,59),(10,'IPhone 15 Promax',25000000,'',1,'aaaaaaaaa',12,0,1000,0);
/*!40000 ALTER TABLE `product` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_image`
--

DROP TABLE IF EXISTS `product_image`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `product_image` (
  `idproduct_image` int NOT NULL AUTO_INCREMENT,
  `product_image` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`idproduct_image`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_image`
--

LOCK TABLES `product_image` WRITE;
/*!40000 ALTER TABLE `product_image` DISABLE KEYS */;
/*!40000 ALTER TABLE `product_image` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rateshops`
--

DROP TABLE IF EXISTS `rateshops`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `rateshops` (
  `idrateshops` int NOT NULL AUTO_INCREMENT,
  `idusers` int DEFAULT NULL,
  `comment` varchar(45) DEFAULT NULL,
  `rate_number` int DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `id_product` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idrateshops`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rateshops`
--

LOCK TABLES `rateshops` WRITE;
/*!40000 ALTER TABLE `rateshops` DISABLE KEYS */;
/*!40000 ALTER TABLE `rateshops` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `registor_sellers`
--

DROP TABLE IF EXISTS `registor_sellers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `registor_sellers` (
  `idregistor_seller` int NOT NULL AUTO_INCREMENT,
  `shop_name` varchar(255) DEFAULT NULL,
  `reason` varchar(255) DEFAULT NULL,
  `Image_shop` varchar(255) DEFAULT NULL,
  `Address` varchar(255) DEFAULT NULL,
  `kind_shop` varchar(255) DEFAULT NULL,
  `id_user` int DEFAULT NULL,
  `createdAt` timestamp NULL DEFAULT NULL,
  `updatedAt` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`idregistor_seller`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `registor_sellers`
--

LOCK TABLES `registor_sellers` WRITE;
/*!40000 ALTER TABLE `registor_sellers` DISABLE KEYS */;
/*!40000 ALTER TABLE `registor_sellers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `shops`
--

DROP TABLE IF EXISTS `shops`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `shops` (
  `id` int NOT NULL AUTO_INCREMENT,
  `shop_name` varchar(45) DEFAULT NULL,
  `kind_shop` varchar(45) DEFAULT NULL,
  `shop_rate` int DEFAULT '5',
  `Image_shop` varchar(200) DEFAULT NULL,
  `id_user` int DEFAULT NULL,
  `Address` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `status` enum('0','1') DEFAULT '1',
  `createdAt` timestamp NULL DEFAULT NULL,
  `updatedAt` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shops`
--

LOCK TABLES `shops` WRITE;
/*!40000 ALTER TABLE `shops` DISABLE KEYS */;
INSERT INTO `shops` VALUES (12,'phat','AD',5,' ',1,'DN','1','2023-12-25 15:48:44','2023-12-25 15:48:44');
/*!40000 ALTER TABLE `shops` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `Name` varchar(200) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `Passwords` varchar(100) DEFAULT NULL,
  `otp` varchar(6) NOT NULL,
  `is_verified` tinyint(1) NOT NULL DEFAULT '0',
  `Address` varchar(200) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `SDT` varchar(12) DEFAULT NULL,
  `thongtinthanhtoan` varchar(200) DEFAULT NULL,
  `imgUS` varchar(200) DEFAULT NULL,
  `role` int DEFAULT NULL,
  `refreshToken` varchar(200) DEFAULT NULL,
  `passwordChangedAt` varchar(200) DEFAULT NULL,
  `passwordResetExpires` varchar(200) DEFAULT NULL,
  `createdAt` timestamp NULL DEFAULT NULL,
  `updatedAt` timestamp NULL DEFAULT NULL,
  `passwordResetToken` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'vanphattk147@gmail.com','Phat','123456','484456',1,'DN','0762517263',NULL,NULL,2,'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpZCI6MSwiaWF0IjoxNzAzNTE5MzQ0LCJleHAiOjE3MDQxMjQxNDR9.jE9b9mzaZnWqOKgJOSRfaBfUn3DudHJGkmP7TKtJKOo',NULL,NULL,NULL,'2023-12-25 15:49:04',NULL),(6,'vanphattk159@gmail.com','Phat','123456','355910',1,'DN',NULL,NULL,NULL,3,'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpZCI6NiwiaWF0IjoxNzAzNTE3NTg1LCJleHAiOjE3MDQxMjIzODV9.e-57M39Xd8ZvA5eptlBn6QMgOv3umkTW7kQ2_i3j_i0',NULL,NULL,NULL,'2023-12-26 11:15:13',NULL),(7,'admin@gmail.com','phat','123456','123125',1,NULL,NULL,NULL,NULL,1,'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpZCI6NywiaWF0IjoxNzAzNTg4OTE5LCJleHAiOjE3MDQxOTM3MTl9.NuMOpiL614X2gKui58VxG4u9sk5bJJWYnPtGfxQKFcI',NULL,NULL,NULL,'2023-12-26 11:08:39',NULL);
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

-- Dump completed on 2023-12-28 14:56:36
