CREATE DATABASE  IF NOT EXISTS `ics325fa2113`; 
USE `ics325fa2113`;
-- MySQL dump 10.13  Distrib 8.0.27, for Win64 (x86_64)
--
-- Host: localhost    Database: ics325fa2113
-- ------------------------------------------------------
-- Server version	8.0.28-0ubuntu0.20.04.3

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
-- Table structure for table `menu`
--

DROP TABLE IF EXISTS `menu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `menu` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `price` float DEFAULT NULL,
  `picture` varchar(45) DEFAULT NULL,
  `description` varchar(150) DEFAULT NULL,
  `size` int DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menu`
--

LOCK TABLES `menu` WRITE;
/*!40000 ALTER TABLE `menu` DISABLE KEYS */;
INSERT INTO `menu` VALUES (2,'cappuccino',2.6,'cappuccino.jpg','',12),(3,'cappuccino',3.1,'cappuccino.jpg','',16),(4,'cappuccino',3.6,'cappuccino.jpg','',20),(5,'latte',2.5,'latte.jpg','',12),(6,'latte',3,'latte.jpg','',16),(7,'latte',3.5,'latte.jpg','',20),(8,'chai',3,'chai.jpg','',12),(9,'chai',3,'chai.jpg','',12),(10,'chai',3.4,'chai.jpg','',16),(11,'chai',3.8,'chai.jpg','',20),(12,'mocha',3.5,'mocha.jpg','',12),(13,'mocha',4,'mocha.jpg','',16),(14,'mocha',4.5,'mocha.jpg','',20),(15,'white chocolate',4.5,'whitechocolate.jpg','',12),(16,'hot chocolate',2,'hotchocolate.jpg','',12),(17,'hot chocolate',2.25,'hotchocolate.jpg','',16),(18,'hot chocolate',2.5,'hotchocolate.jpg','',20),(19,'ice coffee',2,'icecoffee.jpg','',16),(20,'fresh brew',1.5,'freshbrew.jpg','',12),(21,'fresh brew',1.7,'freshbrew.jpg','',16),(22,'fresh brew',2,'freshbrew.jpg','',20),(26,'cuban brew',2.75,'cubanbrew.jpg','',12),(27,'cuban brew',3.25,'cubanbrew.jpg','',16),(28,'cuban brew',3.75,'cubanbrew.jpg','',20),(29,'ice coffee',1.75,'icecoffee.jpg','',12),(30,'ice coffee',2.75,'icecoffee.jpg','',20);
/*!40000 ALTER TABLE `menu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `userID` int NOT NULL AUTO_INCREMENT,
  `fname` varchar(100) DEFAULT NULL,
  `lname` varchar(100) DEFAULT NULL,
  `password` varchar(20) NOT NULL,
  `role` int DEFAULT '0',
  `username` varchar(20) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phonenum` varchar(10) DEFAULT NULL,
  `lastlogin` datetime DEFAULT CURRENT_TIMESTAMP,
  `locked` int DEFAULT '0',
  PRIMARY KEY (`userID`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (24,NULL,NULL,'password',0,'test',NULL,NULL,'2022-03-01 21:28:54',0),(25,'User1','Busy','password',0,'User1','busy@busy.com','3212257889','2022-02-23 21:31:58',0),(26,'Shaun','Graham','ShaunG',0,'ShaunG','shaunkiliangraham@gmail.com','','2022-02-28 18:52:20',0),(27,'Ivan','Miranda','Lim01Kmm',0,'ivanM','ivan@ivan.com','3605089338','2022-02-28 19:17:45',0),(28,'Jose','Labastida','mycoffee',0,'Jose','jose.labastida@my.metro.edu','1234567898','2022-04-02 17:07:48',0),(29,'Mel','McCormack','test12',0,'meljack','maus93.mm@gmail.com','','2022-02-28 19:23:27',0);
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

-- Dump completed on 2022-04-03  0:21:49
