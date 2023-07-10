-- MySQL dump 10.19  Distrib 10.3.38-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: igtest
-- ------------------------------------------------------
-- Server version	10.3.38-MariaDB-0ubuntu0.20.04.1

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
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `user_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `uname` varchar(255) NOT NULL,
  `full_name` text DEFAULT NULL,
  `phone` text DEFAULT NULL,
  `pword` text NOT NULL,
  `is_active` int(11) NOT NULL,
  `ulevel` int(11) NOT NULL COMMENT '1 - Administrator, 2 - Logistics, 3 -Purchaser, 4 - Viewer',
  `email` text NOT NULL,
  `token` text NOT NULL,
  `date_added` datetime NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'admin','Mark Ramos','+971543501525','$2y$10$djEswg4WWk1RYcmQ.YX8VO7uGFmr/UqFxNZN43z9AldDxWbMT/FhG',1,1,'info@markramosonline.com','','2022-09-25 01:17:25'),(3,'','asdasdasd','asfsdfa','$2y$10$K5LjyQ8mZSJwzDFZ.WJWKuDuCQQb.eXXvTSmfLZRpfJwkl5wAJ3i2',1,0,'info2@markramosonline.com','','2023-07-08 17:42:16'),(5,'','john','123123','$2y$10$QZhZniMVrzj.apVQ7tY8jOgRwrIsJBiulcyuDLgqo2vcFBD88aqEa',1,0,'info3@markramosonline.com','','2023-07-08 18:29:51'),(7,'','John Smith','+971543501525','$2y$10$1ZqQW6MUKBHWSkIQNJAMwOK0SYAWaLijm85iggHmz0gpAytbR0g8u',1,0,'info1@markramosonline.com','','2023-07-08 19:04:11'),(8,'','mark5','123123123','$2y$10$TFa/kny5No1Zdlf4HkdqYuveEInxRJJP8sgFBolvEB213oSa.BF6C',1,0,'info5@markramosonline.com','','2023-07-08 19:56:38'),(9,'','Mark6','12313123','$2y$10$jj3MXpv/wHdEK1HaI7n8Z.dO8ygwoINx/srSULP4WgLUBvT0Z9dxe',1,0,'info6@markramosonline.com','','2023-07-08 19:57:55'),(10,'','Mark7','123123','$2y$10$tUAhZ6h6AbBAs7G9WXmVGeis/AZ0hTHQEi1vl/Q2vKGT3ZciKBKHy',1,0,'info7@markramosonline.com','','2023-07-08 20:01:07'),(11,'','John Smith','1231231','$2y$10$w2mjrSuDwMMrm7aYUgkhGeRuhmt1uiOi4rzB3R6FSgK/uVRzFkHle',1,0,'john@smith.com','','2023-07-08 21:05:08');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'igtest'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-07-10 15:36:27
