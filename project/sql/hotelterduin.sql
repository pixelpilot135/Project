-- MySQL dump 10.13  Distrib 8.0.32, for Win64 (x86_64)
--
-- Host: localhost    Database: hotelterduin
-- ------------------------------------------------------
-- Server version	8.0.32

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
-- Table structure for table `alarm`
--

DROP TABLE IF EXISTS alarm;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE alarm (
  AlarmID int NOT NULL AUTO_INCREMENT,
  Datum date NOT NULL,
  AantalKamersVrij int NOT NULL,
  PRIMARY KEY (AlarmID),
  CONSTRAINT alarm_chk_1 CHECK ((`AantalKamersVrij` >= 0))
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `alarm`
--

LOCK TABLES alarm WRITE;
/*!40000 ALTER TABLE alarm DISABLE KEYS */;
INSERT INTO alarm VALUES (1,'2025-03-15',2),(2,'2025-03-15',2),(3,'2025-03-15',2),(4,'2025-03-15',2),(5,'2025-03-15',2),(6,'2025-03-15',2),(7,'2025-03-15',2),(8,'2025-03-15',2),(9,'2025-03-15',2),(10,'2025-03-15',2),(11,'2025-03-15',2),(12,'2025-03-15',2),(13,'2025-03-15',2),(14,'2025-03-15',2),(15,'2025-03-15',2),(16,'2025-03-15',1),(17,'2025-03-15',1),(18,'2025-03-15',1),(19,'2025-03-15',1),(20,'2025-03-15',2),(21,'2025-03-15',2),(22,'2025-03-15',1),(23,'2025-03-15',1),(24,'2025-03-15',1),(25,'2025-03-15',1),(26,'2025-03-15',1),(27,'2025-03-15',1),(28,'2025-03-15',0),(29,'2025-03-15',0),(30,'2025-03-18',1),(31,'2025-03-18',2),(32,'2025-03-18',2),(33,'2025-03-18',2),(34,'2025-03-18',2),(35,'2025-03-18',2),(36,'2025-03-18',1),(37,'2025-03-18',1),(38,'2025-03-18',0),(39,'2025-03-18',0),(40,'2025-03-18',0),(41,'2025-03-18',1),(42,'2025-03-18',0),(43,'2025-03-18',0),(44,'2025-03-20',2),(45,'2025-03-20',2),(46,'2025-03-20',2),(47,'2025-03-20',2),(48,'2025-03-20',2),(49,'2025-03-20',2);
/*!40000 ALTER TABLE alarm ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kamer`
--

DROP TABLE IF EXISTS kamer;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE kamer (
  KamerID int NOT NULL AUTO_INCREMENT,
  Kamernummer int NOT NULL,
  `Type` enum('standaard','luxe') NOT NULL,
  Prijs decimal(10,2) NOT NULL,
  Verhuurd tinyint(1) DEFAULT '0',
  PRIMARY KEY (KamerID),
  UNIQUE KEY Kamernummer (Kamernummer)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kamer`
--

LOCK TABLES kamer WRITE;
/*!40000 ALTER TABLE kamer DISABLE KEYS */;
INSERT INTO kamer VALUES (1,1,'standaard',75.00,1),(2,2,'standaard',75.00,1),(3,3,'luxe',120.00,1);
/*!40000 ALTER TABLE kamer ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `klant`
--

DROP TABLE IF EXISTS klant;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE klant (
  KlantID int NOT NULL AUTO_INCREMENT,
  Naam varchar(100) NOT NULL,
  Email varchar(100) NOT NULL,
  Telefoonnummer varchar(20) NOT NULL,
  PRIMARY KEY (KlantID),
  UNIQUE KEY Email (Email)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `klant`
--

LOCK TABLES klant WRITE;
/*!40000 ALTER TABLE klant DISABLE KEYS */;
/*!40000 ALTER TABLE klant ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `medewerker`
--

DROP TABLE IF EXISTS medewerker;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE medewerker (
  MedewerkerID int NOT NULL AUTO_INCREMENT,
  Naam varchar(100) NOT NULL,
  Gebruikersnaam varchar(50) NOT NULL,
  Wachtwoord varchar(255) NOT NULL,
  PRIMARY KEY (MedewerkerID),
  UNIQUE KEY Gebruikersnaam (Gebruikersnaam)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `medewerker`
--

LOCK TABLES medewerker WRITE;
/*!40000 ALTER TABLE medewerker DISABLE KEYS */;
INSERT INTO medewerker VALUES (4,'Admin','admin','admin123');
/*!40000 ALTER TABLE medewerker ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reservering`
--

DROP TABLE IF EXISTS reservering;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE reservering (
  ReserveringID int NOT NULL AUTO_INCREMENT,
  KlantID int NOT NULL,
  KamerID int NOT NULL,
  CheckInDatum date NOT NULL,
  CheckOutDatum date NOT NULL,
  `Status` enum('bevestigd','geannuleerd','in behandeling') DEFAULT 'in behandeling',
  PRIMARY KEY (ReserveringID),
  KEY KlantID (KlantID),
  KEY KamerID (KamerID),
  CONSTRAINT reservering_ibfk_1 FOREIGN KEY (KlantID) REFERENCES klant (KlantID) ON DELETE CASCADE,
  CONSTRAINT reservering_ibfk_2 FOREIGN KEY (KamerID) REFERENCES kamer (KamerID) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reservering`
--

LOCK TABLES reservering WRITE;
/*!40000 ALTER TABLE reservering DISABLE KEYS */;
/*!40000 ALTER TABLE reservering ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-03-21 18:02:12
