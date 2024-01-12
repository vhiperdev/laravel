-- MySQL dump 10.13  Distrib 8.0.35, for Linux (x86_64)
--
-- Host: localhost    Database: laravel_database
-- ------------------------------------------------------
-- Server version	8.0.35-0ubuntu0.23.10.1

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
-- Current Database: `laravel_database`
--

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `laravel_database` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;

USE `laravel_database`;

--
-- Table structure for table `application`
--

DROP TABLE IF EXISTS `application`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `application` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_count` int NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT '2024-01-11 09:57:20',
  `updated_at` timestamp NOT NULL DEFAULT '2024-01-11 09:57:20',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `application`
--

LOCK TABLES `application` WRITE;
/*!40000 ALTER TABLE `application` DISABLE KEYS */;
INSERT INTO `application` VALUES (1,'chrome',0,'2024-01-11 09:57:20','2024-01-11 09:57:20'),(2,'Xciptv',0,'2024-01-11 09:57:20','2024-01-11 09:57:20'),(3,'pc',0,'2024-01-11 09:57:20','2024-01-11 09:57:20');
/*!40000 ALTER TABLE `application` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `billing_notice_histories`
--

DROP TABLE IF EXISTS `billing_notice_histories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `billing_notice_histories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `customer_id` bigint unsigned DEFAULT NULL,
  `billing_id` bigint unsigned DEFAULT NULL,
  `notice_delivery_status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT '2024-01-11 09:57:22',
  `updated_at` timestamp NOT NULL DEFAULT '2024-01-11 09:57:22',
  PRIMARY KEY (`id`),
  KEY `billing_notice_histories_customer_id_foreign` (`customer_id`),
  KEY `billing_notice_histories_billing_id_foreign` (`billing_id`),
  CONSTRAINT `billing_notice_histories_billing_id_foreign` FOREIGN KEY (`billing_id`) REFERENCES `billings` (`id`) ON DELETE CASCADE,
  CONSTRAINT `billing_notice_histories_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `billing_notice_histories`
--

LOCK TABLES `billing_notice_histories` WRITE;
/*!40000 ALTER TABLE `billing_notice_histories` DISABLE KEYS */;
INSERT INTO `billing_notice_histories` VALUES (1,1,1,1,'2024-01-12 07:02:50','2024-01-12 07:02:50');
/*!40000 ALTER TABLE `billing_notice_histories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `billings`
--

DROP TABLE IF EXISTS `billings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `billings` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `automatic_sending` tinyint(1) NOT NULL DEFAULT '0',
  `automatic_billing` tinyint(1) NOT NULL DEFAULT '0',
  `sunday_billing` tinyint(1) NOT NULL DEFAULT '0',
  `daily_billing` tinyint(1) NOT NULL DEFAULT '0',
  `monday_billing` tinyint(1) NOT NULL DEFAULT '0',
  `tuesday_billing` tinyint(1) NOT NULL DEFAULT '0',
  `wednesday_billing` tinyint(1) NOT NULL DEFAULT '0',
  `thursday_billing` tinyint(1) NOT NULL DEFAULT '0',
  `friday_billing` tinyint(1) NOT NULL DEFAULT '0',
  `saturday_billing` tinyint(1) NOT NULL DEFAULT '0',
  `shipping_time` time NOT NULL DEFAULT '00:00:00',
  `default_message` bigint unsigned DEFAULT NULL,
  `server` bigint unsigned DEFAULT NULL,
  `application_id` bigint unsigned DEFAULT NULL,
  `device_id` bigint unsigned DEFAULT NULL,
  `customer_referal_id` bigint unsigned DEFAULT NULL,
  `customer_subscription_status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `days_to_expire` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `shipping_interval` int NOT NULL DEFAULT '0',
  `last_shipment` timestamp NOT NULL DEFAULT '2024-01-11 09:57:22',
  `customer_count` int NOT NULL DEFAULT '0',
  `customer_received_count` int NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT '2024-01-11 09:57:22',
  `updated_at` timestamp NOT NULL DEFAULT '2024-01-11 09:57:22',
  `created_by` bigint unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `billings_default_message_foreign` (`default_message`),
  KEY `billings_server_foreign` (`server`),
  KEY `billings_application_id_foreign` (`application_id`),
  KEY `billings_device_id_foreign` (`device_id`),
  KEY `billings_customer_referal_id_foreign` (`customer_referal_id`),
  KEY `billings_created_by_foreign` (`created_by`),
  CONSTRAINT `billings_application_id_foreign` FOREIGN KEY (`application_id`) REFERENCES `application` (`id`) ON DELETE SET NULL,
  CONSTRAINT `billings_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  CONSTRAINT `billings_customer_referal_id_foreign` FOREIGN KEY (`customer_referal_id`) REFERENCES `customer_referal` (`id`) ON DELETE SET NULL,
  CONSTRAINT `billings_default_message_foreign` FOREIGN KEY (`default_message`) REFERENCES `message_template` (`id`) ON DELETE SET NULL,
  CONSTRAINT `billings_device_id_foreign` FOREIGN KEY (`device_id`) REFERENCES `device` (`id`) ON DELETE SET NULL,
  CONSTRAINT `billings_server_foreign` FOREIGN KEY (`server`) REFERENCES `servers` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `billings`
--

LOCK TABLES `billings` WRITE;
/*!40000 ALTER TABLE `billings` DISABLE KEYS */;
INSERT INTO `billings` VALUES (1,'3 dias de vencimento',1,1,1,1,1,1,1,1,1,1,'05:04:00',2,1,2,2,NULL,'all_client','0',3,'2024-01-12 07:02:50',1,1,'2024-01-12 07:02:29','2024-01-12 07:38:45',2);
/*!40000 ALTER TABLE `billings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `country`
--

DROP TABLE IF EXISTS `country`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `country` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `Country Name` varchar(32) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ISO2` varchar(2) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ISO3` varchar(3) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Top Level Domain` varchar(2) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `FIPS` varchar(2) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ISO Numeric` smallint unsigned DEFAULT NULL,
  `GeoNameID` varchar(7) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `E164` smallint unsigned DEFAULT NULL,
  `Phone Code` varchar(19) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Continent` varchar(13) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Capital` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Time Zone in Capital` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Currency` varchar(13) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Language Codes` varchar(89) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Languages` varchar(489) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Area KM2` int unsigned DEFAULT NULL,
  `Internet Hosts` varchar(9) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Internet Users` varchar(9) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Phones (Mobile)` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Phones (Landline)` varchar(9) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `GDP` varchar(14) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=168 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `country`
--

LOCK TABLES `country` WRITE;
/*!40000 ALTER TABLE `country` DISABLE KEYS */;
INSERT INTO `country` VALUES (1,'Afghanistan','AF','AFG','af','AF',4,'1149361',93,'93','Asia','Kabul','Asia/Kabul','Afghani','fa-AF,ps,uz-AF,tk','Afghan Persian or Dari (official) 50%, Pashto (official) 35%, Turkic languages (primarily Uzbek and Turkmen) 11%, 30 minor languages (primarily Balochi and Pashai) 4%, much bilingualism, but Dari functions as the lingua franca',647500,'223','1000000','18000000','13500','20650000000',NULL,NULL),(2,'Albania','AL','ALB','al','AL',8,'783754',355,'355','Europe','Tirana','Europe/Tirane','Lek','sq,el','Albanian 98.8% (official - derived from Tosk dialect), Greek 0.5%, other 0.6% (including Macedonian, Roma, Vlach, Turkish, Italian, and Serbo-Croatian), unspecified 0.1% (2011 est.)',28748,'15528','1300000','3500000','312000','12800000000',NULL,NULL),(3,'Algeria','DZ','DZA','dz','AG',12,'2589581',213,'213','Africa','Algiers','Africa/Algiers','Dinar','ar-DZ','Arabic (official), French (lingua franca), Berber dialects: Kabylie Berber (Tamazight), Chaouia Berber (Tachawit), Mzab Berber, Tuareg Berber (Tamahaq)',2381740,'676','4700000','37692000','3200000','215700000000',NULL,NULL),(4,'American Samoa','AS','ASM','as','AQ',16,'5880801',1,'1-684','Oceania','Pago Pago','Pacific/Pago_Pago','Dollar','en-AS,sm,to','Samoan 90.6% (closely related to Hawaiian and other Polynesian languages), English 2.9%, Tongan 2.4%, other Pacific islander 2.1%, other 2%',199,'2387','','','10000','462200000',NULL,NULL),(5,'Andorra','AD','AND','ad','AN',20,'3041565',376,'376','Europe','Andorra la Vella','Europe/Andorra','Euro','ca','Catalan (official), French, Castilian, Portuguese',468,'28383','67100','65000','39000','4800000000',NULL,NULL),(6,'Angola','AO','AGO','ao','AO',24,'3351879',244,'244','Africa','Luanda','Africa/Luanda','Kwanza','pt-AO','Portuguese (official), Bantu and other African languages',1246700,'20703','606700','9800000','303000','124000000000',NULL,NULL),(7,'Anguilla','AI','AIA','ai','AV',660,'3573511',1,'1-264','North America','The Valley','America/Anguilla','Dollar','en-AI','English (official)',102,'269','3700','26000','6000','175400000',NULL,NULL),(8,'Antarctica','AQ','ATA','aq','AY',10,'6697173',672,'672','Antarctica','','Antarctica/Troll','','','',14000000,'7764','','','','',NULL,NULL),(9,'Antigua and Barbuda','AG','ATG','ag','AC',28,'3576396',1,'1-268','North America','St. John\'s','America/Antigua','Dollar','en-AG','English (official), local dialects',443,'11532','65000','179800','35000','1220000000',NULL,NULL),(10,'Argentina','AR','ARG','ar','AR',32,'3865483',54,'54','South America','Buenos Aires','America/Argentina/Buenos_Aires','Peso','es-AR,en,it,de,fr,gn','Spanish (official), Italian, English, German, French, indigenous (Mapudungun, Quechua)',2766890,'11232000','13694000','58600000','1','484600000000',NULL,NULL),(11,'Armenia','AM','ARM','am','AM',51,'174982',374,'374','Asia','Yerevan','Asia/Yerevan','Dram','hy','Armenian (official) 97.9%, Kurdish (spoken by Yezidi minority) 1%, other 1% (2011 est.)',29800,'194142','208200','3223000','584000','10440000000',NULL,NULL),(12,'Aruba','AW','ABW','aw','AA',533,'3577279',297,'297','North America','Oranjestad','America/Aruba','Guilder','nl-AW,es,en','Papiamento (a Spanish-Portuguese-Dutch-English dialect) 69.4%, Spanish 13.7%, English (widely spoken) 7.1%, Dutch (official) 6.1%, Chinese 1.5%, other 1.7%, unspecified 0.4% (2010 est.)',193,'40560','24000','135000','43000','2516000000',NULL,NULL),(13,'Australia','AU','AUS','au','AS',36,'2077456',61,'61','Oceania','Canberra','Australia/Sydney','Dollar','en-AU','English 76.8%, Mandarin 1.6%, Italian 1.4%, Arabic 1.3%, Greek 1.2%, Cantonese 1.2%, Vietnamese 1.1%, other 10.4%, unspecified 5% (2011 est.)',7686850,'17081000','15810000','24400000','10470000','1488000000000',NULL,NULL),(14,'Austria','AT','AUT','at','AU',40,'2782113',43,'43','Europe','Vienna','Europe/Vienna','Euro','de-AT,hr,hu,sl','German (official nationwide) 88.6%, Turkish 2.3%, Serbian 2.2%, Croatian (official in Burgenland) 1.6%, other (includes Slovene, official in Carinthia, and Hungarian, official in Burgenland) 5.3% (2001 census)',83858,'3512000','6143000','13590000','3342000','417900000000',NULL,NULL),(15,'Azerbaijan','AZ','AZE','az','AJ',31,'587116',994,'994','Asia','Baku','Asia/Baku','Manat','az,ru,hy','Azerbaijani (Azeri) (official) 92.5%, Russian 1.4%, Armenian 1.4%, other 4.7% (2009 est.)',86600,'46856','2420000','10125000','1734000','76010000000',NULL,NULL),(16,'Bahamas','BS','BHS','bs','BF',44,'3572887',1,'1-242','North America','Nassau','America/Nassau','Dollar','en-BS','English (official), Creole (among Haitian immigrants)',13940,'20661','115800','254000','137000','8373000000',NULL,NULL),(17,'Bahrain','BH','BHR','bh','BA',48,'290291',973,'973','Asia','Manama','Asia/Bahrain','Dinar','ar-BH,en,fa,ur','Arabic (official), English, Farsi, Urdu',665,'47727','419500','2125000','290000','28360000000',NULL,NULL),(18,'Bangladesh','BD','BGD','bd','BG',50,'1210997',880,'880','Asia','Dhaka','Asia/Dhaka','Taka','bn-BD,en','Bangla (official, also known as Bengali), English',144000,'71164','617300','97180000','962000','140200000000',NULL,NULL),(19,'Barbados','BB','BRB','bb','BB',52,'3374084',1,'1-246','North America','Bridgetown','America/Barbados','Dollar','en-BB','English (official), Bajan (English-based creole language, widely spoken in informal settings)',431,'1524','188000','347000','144000','4262000000',NULL,NULL),(20,'Belarus','BY','BLR','by','BO',112,'630336',375,'375','Europe','Minsk','Europe/Minsk','Ruble','be,ru','Belarusian (official) 23.4%, Russian (official) 70.2%, other 3.1% (includes small Polish- and Ukrainian-speaking minorities), unspecified 3.3% (2009 est.)',207600,'295217','2643000','10675000','4407000','69240000000',NULL,NULL),(21,'Belgium','BE','BEL','be','BE',56,'2802361',32,'32','Europe','Brussels','Europe/Brussels','Euro','nl-BE,fr-BE,de-BE','Dutch (official) 60%, French (official) 40%, German (official) less than 1%, legally bilingual (Dutch and French)',30510,'5192000','8113000','12880000','4631000','507400000000',NULL,NULL),(22,'Belize','BZ','BLZ','bz','BH',84,'3582678',501,'501','North America','Belmopan','America/Belize','Dollar','en-BZ,es','Spanish 46%, Creole 32.9%, Mayan dialects 8.9%, English 3.9% (official), Garifuna 3.4% (Carib), German 3.3%, other 1.4%, unknown 0.2% (2000 census)',22966,'3392','36000','164200','25400','1637000000',NULL,NULL),(23,'Benin','BJ','BEN','bj','BN',204,'2395170',229,'229','Africa','Porto-Novo','Africa/Porto-Novo','Franc','fr-BJ','French (official), Fon and Yoruba (most common vernaculars in south), tribal languages (at least six major ones in north)',112620,'491','200100','8408000','156700','8359000000',NULL,NULL),(24,'Bermuda','BM','BMU','bm','BD',60,'3573345',1,'1-441','North America','Hamilton','Atlantic/Bermuda','Dollar','en-BM,pt','English (official), Portuguese',53,'20040','54000','91000','69000','5600000000',NULL,NULL),(25,'Bhutan','BT','BTN','bt','BT',64,'1252634',975,'975','Asia','Thimphu','Asia/Thimphu','Ngultrum','dz','Sharchhopka 28%, Dzongkha (official) 24%, Lhotshamkha 22%, other 26% (includes foreign languages) (2005 est.)',47000,'14590','50000','560000','27000','2133000000',NULL,NULL),(26,'Bolivia','BO','BOL','bo','BL',68,'3923057',591,'591','South America','Sucre','America/La_Paz','Boliviano','es-BO,qu,ay','Spanish (official) 60.7%, Quechua (official) 21.2%, Aymara (official) 14.6%, Guarani (official), foreign languages 2.4%, other 1.2%',1098580,'180988','1103000','9494000','880600','30790000000',NULL,NULL),(27,'Bosnia and Herzegovina','BA','BIH','ba','BK',70,'3277605',387,'387','Europe','Sarajevo','Europe/Sarajevo','Marka','bs,hr-BA,sr-BA','Bosnian (official), Croatian (official), Serbian (official)',51129,'155252','1422000','3350000','878000','18870000000',NULL,NULL),(28,'Botswana','BW','BWA','bw','BC',72,'933860',267,'267','Africa','Gaborone','Africa/Gaborone','Pula','en-BW,tn-BW','Setswana 78.2%, Kalanga 7.9%, Sekgalagadi 2.8%, English (official) 2.1%, other 8.6%, unspecified 0.4% (2001 census)',600370,'1806','120000','3082000','160500','15530000000',NULL,NULL),(29,'Brazil','BR','BRA','br','BR',76,'3469034',55,'55','South America','Brasilia','America/Sao_Paulo','Real','pt-BR,es,en,fr','Portuguese (official and most widely spoken language)',8511965,'26577000','75982000','248324000','44300000','2190000000000',NULL,NULL),(30,'British Indian Ocean Territory','IO','IOT','io','IO',86,'1282588',246,'246','Asia','Diego Garcia','Indian/Chagos','Dollar','en-IO','English',60,'75006','','','','',NULL,NULL),(31,'British Virgin Islands','VG','VGB','vg','VI',92,'3577718',1,'1-284','North America','Road Town','America/Tortola','Dollar','en-VG','English (official)',153,'505','4000','48700','12268','1095000000',NULL,NULL),(32,'Brunei','BN','BRN','bn','BX',96,'1820814',673,'673','Asia','Bandar Seri Begawan','Asia/Brunei','Dollar','ms-BN,en-BN','Malay (official), English, Chinese',5770,'49457','314900','469700','70933','16560000000',NULL,NULL),(33,'Bulgaria','BG','BGR','bg','BU',100,'732800',359,'359','Europe','Sofia','Europe/Sofia','Lev','bg,tr-BG','Bulgarian (official) 76.8%, Turkish 8.2%, Roma 3.8%, other 0.7%, unspecified 10.5% (2011 est.)',110910,'976277','3395000','10780000','2253000','53700000000',NULL,NULL),(34,'Burkina Faso','BF','BFA','bf','UV',854,'2361809',226,'226','Africa','Ouagadougou','Africa/Ouagadougou','Franc','fr-BF','French (official), native African languages belonging to Sudanic family spoken by 90% of the population',274200,'1795','178100','9980000','141400','12130000000',NULL,NULL),(35,'Burundi','BI','BDI','bi','BY',108,'433561',257,'257','Africa','Bujumbura','Africa/Bujumbura','Franc','fr-BI,rn','Kirundi 29.7% (official), Kirundi and other language 9.1%, French (official) and French and other language 0.3%, Swahili and Swahili and other language 0.2% (along Lake Tanganyika and in the Bujumbura area), English and English and other language 0.06%, more than 2 languages 3.7%, unspecified 56.9% (2008 est.)',27830,'229','157800','2247000','17400','2676000000',NULL,NULL),(36,'Cambodia','KH','KHM','kh','CB',116,'1831722',855,'855','Asia','Phnom Penh','Asia/Phnom_Penh','Riels','km,fr,en','Khmer (official) 96.3%, other 3.7% (2008 est.)',181040,'13784','78500','19100000','584000','15640000000',NULL,NULL),(37,'Cameroon','CM','CMR','cm','CM',120,'2233387',237,'237','Africa','Yaounde','Africa/Douala','Franc','en-CM,fr-CM','24 major African language groups, English (official), French (official)',475440,'10207','749600','13100000','737400','27880000000',NULL,NULL),(38,'Canada','CA','CAN','ca','CA',124,'6251999',1,'1','North America','Ottawa','America/Toronto','Dollar','en-CA,fr-CA,iu','English (official) 58.7%, French (official) 22%, Punjabi 1.4%, Italian 1.3%, Spanish 1.3%, German 1.3%, Cantonese 1.2%, Tagalog 1.2%, Arabic 1.1%, other 10.5% (2011 est.)',9984670,'8743000','26960000','26263000','18010000','1825000000000',NULL,NULL),(39,'Cape Verde','CV','CPV','cv','CV',132,'3374766',238,'238','Africa','Praia','Atlantic/Cape_Verde','Escudo','pt-CV','Portuguese (official), Crioulo (a blend of Portuguese and West African words)',4033,'38','150000','425300','70200','1955000000',NULL,NULL),(40,'Cayman Islands','KY','CYM','ky','CJ',136,'3580718',1,'1-345','North America','George Town','America/Cayman','Dollar','en-KY','English (official) 90.9%, Spanish 4%, Filipino 3.3%, other 1.7%, unspecified 0.1% (2010 est.)',262,'23472','23000','96300','37400','2250000000',NULL,NULL),(41,'Central African Republic','CF','CAF','cf','CT',140,'239880',236,'236','Africa','Bangui','Africa/Bangui','Franc','fr-CF,sg,ln,kg','French (official), Sangho (lingua franca and national language), tribal languages',622984,'20','22600','1070000','5600','2050000000',NULL,NULL),(42,'Chad','TD','TCD','td','CD',148,'2434508',235,'235','Africa','N\'Djamena','Africa/Ndjamena','Franc','fr-TD,ar-TD,sre','French (official), Arabic (official), Sara (in south), more than 120 different languages and dialects',1284000,'6','168100','4200000','29900','13590000000',NULL,NULL),(43,'Chile','CL','CHL','cl','CI',152,'3895114',56,'56','South America','Santiago','America/Santiago','Peso','es-CL','Spanish 99.5% (official), English 10.2%, indigenous 1% (includes Mapudungun, Aymara, Quechua, Rapa Nui), other 2.3%, unspecified 0.2%',756950,'2152000','7009000','24130000','3276000','281700000000',NULL,NULL),(44,'China','CN','CHN','cn','CH',156,'1814991',86,'86','Asia','Beijing','Asia/Shanghai','Yuan Renminbi','zh-CN,yue,wuu,dta,ug,za','Standard Chinese or Mandarin (official; Putonghua, based on the Beijing dialect), Yue (Cantonese), Wu (Shanghainese), Minbei (Fuzhou), Minnan (Hokkien-Taiwanese), Xiang, Gan, Hakka dialects, minority languages',9596960,'20602000','389000000','1100000000','278860000','9330000000000',NULL,NULL),(45,'Christmas Island','CX','CXR','cx','KT',162,'2078138',61,'61','Asia','Flying Fish Cove','Indian/Christmas','Dollar','en,zh,ms-CC','English (official), Chinese, Malay',135,'3028','464','','','',NULL,NULL),(46,'Cocos Islands','CC','CCK','cc','CK',166,'1547376',61,'61','Asia','West Island','Indian/Cocos','Dollar','ms-CC,en','Malay (Cocos dialect), English',14,'','','','','',NULL,NULL),(47,'Colombia','CO','COL','co','CO',170,'3686110',57,'57','South America','Bogota','America/Bogota','Peso','es-CO','Spanish (official)',1138910,'4410000','22538000','49066000','6291000','369200000000',NULL,NULL),(48,'Comoros','KM','COM','km','CN',174,'921929',269,'269','Africa','Moroni','Indian/Comoro','Franc','ar,fr-KM','Arabic (official), French (official), Shikomoro (a blend of Swahili and Arabic)',2170,'14','24300','250000','24000','658000000',NULL,NULL),(49,'Cook Islands','CK','COK','ck','CW',184,'1899402',682,'682','Oceania','Avarua','Pacific/Rarotonga','Dollar','en-CK,mi','English (official) 86.4%, Cook Islands Maori (Rarotongan) (official) 76.2%, other 8.3%',240,'3562','6000','7800','7200','183200000',NULL,NULL),(50,'Costa Rica','CR','CRI','cr','CS',188,'3624060',506,'506','North America','San Jose','America/Costa_Rica','Colon','es-CR,en','Spanish (official), English',51100,'147258','1485000','6151000','1018000','48510000000',NULL,NULL),(51,'Croatia','HR','HRV','hr','HR',191,'3202326',385,'385','Europe','Zagreb','Europe/Zagreb','Kuna','hr-HR,sr','Croatian (official) 95.6%, Serbian 1.2%, other 3% (including Hungarian, Czech, Slovak, and Albanian), unspecified 0.2% (2011 est.)',56542,'729420','2234000','4970000','1640000','59140000000',NULL,NULL),(52,'Cuba','CU','CUB','cu','CU',192,'3562981',53,'53','North America','Havana','America/Havana','Peso','es-CU','Spanish (official)',110860,'3244','1606000','1682000','1217000','72300000000',NULL,NULL),(53,'Curacao','CW','CUW','cw','UC',531,'7626836',599,'599','North America','Willemstad','America/Curacao','Guilder','nl,pap','Papiamentu (a Spanish-Portuguese-Dutch-English dialect) 81.2%, Dutch (official) 8%, Spanish 4%, English 2.9%, other 3.9% (2001 census)',444,'','','','','5600000000',NULL,NULL),(54,'Cyprus','CY','CYP','cy','CY',196,'146669',357,'357','Europe','Nicosia','Asia/Nicosia','Euro','el-CY,tr-CY,en','Greek (official) 80.9%, Turkish (official) 0.2%, English 4.1%, Romanian 2.9%, Russian 2.5%, Bulgarian 2.2%, Arabic 1.2%, Filippino 1.1%, other 4.3%, unspecified 0.6% (2011 est.)',9250,'252013','433900','1110000','373200','21780000000',NULL,NULL),(55,'Czech Republic','CZ','CZE','cz','EZ',203,'3077311',420,'420','Europe','Prague','Europe/Prague','Koruna','cs,sk','Czech 95.4%, Slovak 1.6%, other 3% (2011 census)',78866,'4148000','6681000','12973000','2100000','194800000000',NULL,NULL),(56,'Democratic Republic of the Congo','CD','COD','cd','CG',180,'203312',243,'243','Africa','Kinshasa','Africa/Kinshasa','Franc','fr-CD,ln,kg','French (official), Lingala (a lingua franca trade language), Kingwana (a dialect of Kiswahili or Swahili), Kikongo, Tshiluba',2345410,'2515','290000','19487000','58200','18560000000',NULL,NULL),(57,'Denmark','DK','DNK','dk','DA',208,'2623032',45,'45','Europe','Copenhagen','Europe/Copenhagen','Krone','da-DK,en,fo,de-DK','Danish, Faroese, Greenlandic (an Inuit dialect), German (small minority)',43094,'4297000','4750000','6600000','2431000','324300000000',NULL,NULL),(58,'Djibouti','DJ','DJI','dj','DJ',262,'223816',253,'253','Africa','Djibouti','Africa/Djibouti','Franc','fr-DJ,ar,so-DJ,aa','French (official), Arabic (official), Somali, Afar',23000,'215','25900','209000','18000','1459000000',NULL,NULL),(59,'Dominica','DM','DMA','dm','DO',212,'3575830',1,'1-767','North America','Roseau','America/Dominica','Dollar','en-DM','English (official), French patois',754,'723','28000','109300','14600','495000000',NULL,NULL),(60,'Dominican Republic','DO','DOM','do','DR',214,'3508796',1,'1-809, 1-829, 1-849','North America','Santo Domingo','America/Santo_Domingo','Peso','es-DO','Spanish (official)',48730,'404500','2701000','9038000','1065000','59270000000',NULL,NULL),(61,'East Timor','TL','TLS','tl','TT',626,'1966436',670,'670','Oceania','Dili','Asia/Dili','Dollar','tet,pt-TL,id,en','Tetum (official), Portuguese (official), Indonesian, English',15007,'252','2100','621000','3000','6129000000',NULL,NULL),(62,'Ecuador','EC','ECU','ec','EC',218,'3658394',593,'593','South America','Quito','America/Guayaquil','Dollar','es-EC','Spanish (Castillian) 93% (official), Quechua 4.1%, other indigenous 0.7%, foreign 2.2%',283560,'170538','3352000','16457000','2310000','91410000000',NULL,NULL),(63,'Egypt','EG','EGY','eg','EG',818,'357994',20,'20','Africa','Cairo','Africa/Cairo','Pound','ar-EG,en,fr','Arabic (official), English and French widely understood by educated classes',1001450,'200430','20136000','96800000','8557000','262000000000',NULL,NULL),(64,'El Salvador','SV','SLV','sv','ES',222,'3585968',503,'503','North America','San Salvador','America/El_Salvador','Dollar','es-SV','Spanish (official), Nahua (among some Amerindians)',21040,'24070','746000','8650000','1060000','24670000000',NULL,NULL),(65,'Equatorial Guinea','GQ','GNQ','gq','EK',226,'2309096',240,'240','Africa','Malabo','Africa/Malabo','Franc','es-GQ,fr','Spanish (official) 67.6%, other (includes French (official), Fang, Bubi) 32.4% (1994 census)',28051,'7','14400','501000','14900','17080000000',NULL,NULL),(66,'Eritrea','ER','ERI','er','ER',232,'338010',291,'291','Africa','Asmara','Africa/Asmara','Nakfa','aa-ER,ar,tig,kun,ti-ER','Tigrinya (official), Arabic (official), English (official), Tigre, Kunama, Afar, other Cushitic languages',121320,'701','200000','305300','60000','3438000000',NULL,NULL),(67,'Estonia','EE','EST','ee','EN',233,'453733',372,'372','Europe','Tallinn','Europe/Tallinn','Euro','et,ru','Estonian (official) 68.5%, Russian 29.6%, Ukrainian 0.6%, other 1.2%, unspecified 0.1% (2011 est.)',45226,'865494','971700','2070000','448200','24280000000',NULL,NULL),(68,'Ethiopia','ET','ETH','et','ET',231,'337996',251,'251','Africa','Addis Ababa','Africa/Addis_Ababa','Birr','am,en-ET,om-ET,ti-ET,so-ET,sid','Oromo (official working language in the State of Oromiya) 33.8%, Amharic (official national language) 29.3%, Somali (official working language of the State of Sumale) 6.2%, Tigrigna (Tigrinya) (official working language of the State of Tigray) 5.9%, Sidamo 4%, Wolaytta 2.2%, Gurage 2%, Afar (official working language of the State of Afar) 1.7%, Hadiyya 1.7%, Gamo 1.5%, Gedeo 1.3%, Opuuo 1.2%, Kafa 1.1%, other 8.1%, English (major foreign language taught in schools), Arabic (2007 est.)',1127127,'179','447300','20524000','797500','47340000000',NULL,NULL),(69,'Falkland Islands','FK','FLK','fk','FK',238,'3474414',500,'500','South America','Stanley','Atlantic/Stanley','Pound','en-FK','English 89%, Spanish 7.7%, other 3.3% (2006 est.)',12173,'110','2900','3450','1980','164500000',NULL,NULL),(70,'Faroe Islands','FO','FRO','fo','FO',234,'2622320',298,'298','Europe','Torshavn','Atlantic/Faroe','Krone','fo,da-FO','Faroese (derived from Old Norse), Danish',1399,'7575','37500','61000','24000','2320000000',NULL,NULL),(71,'Fiji','FJ','FJI','fj','FJ',242,'2205218',679,'679','Oceania','Suva','Pacific/Fiji','Dollar','en-FJ,fj','English (official), Fijian (official), Hindustani',18270,'21739','114200','858800','88400','4218000000',NULL,NULL),(72,'Finland','FI','FIN','fi','FI',246,'660013',358,'358','Europe','Helsinki','Europe/Helsinki','Euro','fi-FI,sv-FI,smn','Finnish (official) 94.2%, Swedish (official) 5.5%, other (small Sami- and Russian-speaking minorities) 0.2% (2012 est.)',337030,'4763000','4393000','9320000','890000','259600000000',NULL,NULL),(73,'France','FR','FRA','fr','FR',250,'3017382',33,'33','Europe','Paris','Europe/Paris','Euro','fr-FR,frp,br,co,ca,eu,oc','French (official) 100%, rapidly declining regional dialects and languages (Provencal, Breton, Alsatian, Corsican, Catalan, Basque, Flemish)',547030,'17266000','45262000','62280000','39290000','2739000000000',NULL,NULL),(74,'French Polynesia','PF','PYF','pf','FP',258,'4030656',689,'689','Oceania','Papeete','Pacific/Tahiti','Franc','fr-PF,ty','French (official) 61.1%, Polynesian (official) 31.4%, Asian languages 1.2%, other 0.3%, unspecified 6% (2002 census)',4167,'37949','120000','226000','55000','5650000000',NULL,NULL),(75,'Gabon','GA','GAB','ga','GB',266,'2400553',241,'241','Africa','Libreville','Africa/Libreville','Franc','fr-GA','French (official), Fang, Myene, Nzebi, Bapounou/Eschira, Bandjabi',267667,'127','98800','2930000','17000','19970000000',NULL,NULL),(76,'Gambia','GM','GMB','gm','GA',270,'2413451',220,'220','Africa','Banjul','Africa/Banjul','Dalasi','en-GM,mnk,wof,wo,ff','English (official), Mandinka, Wolof, Fula, other indigenous vernaculars',11300,'656','130100','1526000','64200','896000000',NULL,NULL),(77,'Georgia','GE','GEO','ge','GG',268,'614540',995,'995','Asia','Tbilisi','Asia/Tbilisi','Lari','ka,ru,hy,az','Georgian (official) 71%, Russian 9%, Armenian 7%, Azeri 6%, other 7%',69700,'357864','1300000','4699000','1276000','15950000000',NULL,NULL),(78,'Germany','DE','DEU','de','GM',276,'2921044',49,'49','Europe','Berlin','Europe/Berlin','Euro','de','German (official)',357021,'20043000','65125000','107700000','50700000','3593000000000',NULL,NULL),(79,'Ghana','GH','GHA','gh','GH',288,'2300660',233,'233','Africa','Accra','Africa/Accra','Cedi','en-GH,ak,ee,tw','Asante 14.8%, Ewe 12.7%, Fante 9.9%, Boron (Brong) 4.6%, Dagomba 4.3%, Dangme 4.3%, Dagarte (Dagaba) 3.7%, Akyem 3.4%, Ga 3.4%, Akuapem 2.9%, other (includes English (official)) 36.1% (2000 census)',239460,'59086','1297000','25618000','285000','45550000000',NULL,NULL),(80,'Gibraltar','GI','GIB','gi','GI',292,'2411586',350,'350','Europe','Gibraltar','Europe/Gibraltar','Pound','en-GI,es,it,pt','English (used in schools and for official purposes), Spanish, Italian, Portuguese',7,'3509','20200','34750','23100','1106000000',NULL,NULL),(81,'Greece','GR','GRC','gr','GR',300,'390903',30,'30','Europe','Athens','Europe/Athens','Euro','el-GR,en,fr','Greek (official) 99%, other (includes English and French) 1%',131940,'3201000','4971000','13354000','5461000','243300000000',NULL,NULL),(82,'Greenland','GL','GRL','gl','GL',304,'3425505',299,'299','North America','Nuuk','America/Godthab','Krone','kl,da-GL,en','Greenlandic (East Inuit) (official), Danish (official), English',2166086,'15645','36000','59455','18900','2160000000',NULL,NULL),(83,'Grenada','GD','GRD','gd','GJ',308,'3580239',1,'1-473','North America','St. George\'s','America/Grenada','Dollar','en-GD','English (official), French patois',344,'80','25000','128000','28500','811000000',NULL,NULL),(84,'Guam','GU','GUM','gu','GQ',316,'4043988',1,'1-671','Oceania','Hagatna','Pacific/Guam','Dollar','en-GU,ch-GU','English 43.6%, Filipino 21.2%, Chamorro 17.8%, other Pacific island languages 10%, Asian languages 6.3%, other 1.1% (2010 est.)',549,'23','90000','98000','67000','4600000000',NULL,NULL),(85,'Guatemala','GT','GTM','gt','GT',320,'3595528',502,'502','North America','Guatemala City','America/Guatemala','Quetzal','es-GT','Spanish (official) 60%, Amerindian languages 40%',108890,'357552','2279000','20787000','1744000','53900000000',NULL,NULL),(86,'Guernsey','GG','GGY','gg','GK',831,'3042362',44,'44-1481','Europe','St Peter Port','Europe/Guernsey','Pound','en,fr','English, French, Norman-French dialect spoken in country districts',78,'239','48300','43800','45100','2742000000',NULL,NULL),(87,'Guinea','GN','GIN','gn','GV',324,'2420477',224,'224','Africa','Conakry','Africa/Conakry','Franc','fr-GN','French (official)',245857,'15','95000','4781000','18000','6544000000',NULL,NULL),(88,'Guinea-Bissau','GW','GNB','gw','PU',624,'2372248',245,'245','Africa','Bissau','Africa/Bissau','Franc','pt-GW,pov','Portuguese (official), Crioulo, African languages',36120,'90','37100','1100000','5000','880000000',NULL,NULL),(89,'Guyana','GY','GUY','gy','GY',328,'3378535',592,'592','South America','Georgetown','America/Guyana','Dollar','en-GY','English, Amerindian dialects, Creole, Caribbean Hindustani (a dialect of Hindi), Urdu',214970,'24936','189600','547000','154200','3020000000',NULL,NULL),(90,'Haiti','HT','HTI','ht','HA',332,'3723988',509,'509','North America','Port-au-Prince','America/Port-au-Prince','Gourde','ht,fr-HT','French (official), Creole (official)',27750,'555','1000000','6095000','50000','8287000000',NULL,NULL),(91,'Honduras','HN','HND','hn','HO',340,'3608932',504,'504','North America','Tegucigalpa','America/Tegucigalpa','Lempira','es-HN','Spanish (official), Amerindian dialects',112090,'30955','731700','7370000','610000','18880000000',NULL,NULL),(92,'Hong Kong','HK','HKG','hk','HK',344,'1819730',852,'852','Asia','Hong Kong','Asia/Hong_Kong','Dollar','zh-HK,yue,zh,en','Cantonese (official) 89.5%, English (official) 3.5%, Putonghua (Mandarin) 1.4%, other Chinese dialects 4%, other 1.6% (2011 est.)',1092,'870041','4873000','16403000','4362000','272100000000',NULL,NULL),(93,'Hungary','HU','HUN','hu','HU',348,'719819',36,'36','Europe','Budapest','Europe/Budapest','Forint','hu-HU','Hungarian (official) 99.6%, English 16%, German 11.2%, Russian 1.6%, Romanian 1.3%, French 1.2%, other 4.2%',93030,'3145000','6176000','11580000','2960000','130600000000',NULL,NULL),(94,'Iceland','IS','ISL','is','IC',352,'2629691',354,'354','Europe','Reykjavik','Atlantic/Reykjavik','Krona','is,en,de,da,sv,no','Icelandic, English, Nordic languages, German widely spoken',103000,'369969','301600','346000','189000','14590000000',NULL,NULL),(95,'India','IN','IND','in','IN',356,'1269750',91,'91','Asia','New Delhi','Asia/Kolkata','Rupee','en-IN,hi,bn,te,mr,ta,ur,gu,kn,ml,or,pa,as,bh,sat,ks,ne,sd,kok,doi,mni,sit,sa,fr,lus,inc','Hindi 41%, Bengali 8.1%, Telugu 7.2%, Marathi 7%, Tamil 5.9%, Urdu 5%, Gujarati 4.5%, Kannada 3.7%, Malayalam 3.2%, Oriya 3.2%, Punjabi 2.8%, Assamese 1.3%, Maithili 1.2%, other 5.9%',3287590,'6746000','61338000','893862000','31080000','1670000000000',NULL,NULL),(96,'Indonesia','ID','IDN','id','ID',360,'1643084',62,'62','Asia','Jakarta','Asia/Jakarta','Rupiah','id,en,nl,jv','Bahasa Indonesia (official, modified form of Malay), English, Dutch, local dialects (of which the most widely spoken is Javanese)',1919440,'1344000','20000000','281960000','37983000','867500000000',NULL,NULL),(97,'Iran','IR','IRN','ir','IR',364,'130758',98,'98','Asia','Tehran','Asia/Tehran','Rial','fa-IR,ku','Persian (official) 53%, Azeri Turkic and Turkic dialects 18%, Kurdish 10%, Gilaki and Mazandarani 7%, Luri 6%, Balochi 2%, Arabic 2%, other 2%',1648000,'197804','8214000','58160000','28760000','411900000000',NULL,NULL),(98,'Iraq','IQ','IRQ','iq','IZ',368,'99237',964,'964','Asia','Baghdad','Asia/Baghdad','Dinar','ar-IQ,ku,hy','Arabic (official), Kurdish (official), Turkmen (a Turkish dialect) and Assyrian (Neo-Aramaic) are official in areas where they constitute a majority of the population), Armenian',437072,'26','325900','26760000','1870000','221800000000',NULL,NULL),(99,'Ireland','IE','IRL','ie','EI',372,'2963597',353,'353','Europe','Dublin','Europe/Dublin','Euro','en-IE,ga-IE','English (official, the language generally used), Irish (Gaelic or Gaeilge) (official, spoken mainly in areas along the western coast)',70280,'1387000','3042000','4906000','2007000','220900000000',NULL,NULL),(100,'Isle of Man','IM','IMN','im','IM',833,'3042225',44,'44-1624','Europe','Douglas, Isle of Man','Europe/Isle_of_Man','Pound','en,gv','English, Manx Gaelic (about 2% of the population has some knowledge)',572,'895','','','','4076000000',NULL,NULL),(101,'Israel','IL','ISR','il','IS',376,'294640',972,'972','Asia','Jerusalem','Asia/Jerusalem','Shekel','he,ar-IL,en-IL,','Hebrew (official), Arabic (used officially for Arab minority), English (most commonly used foreign language)',20770,'2483000','4525000','9225000','3594000','272700000000',NULL,NULL),(102,'Italy','IT','ITA','it','IT',380,'3175395',39,'39','Europe','Rome','Europe/Rome','Euro','it-IT,de-IT,fr-IT,sc,ca,co,sl','Italian (official), German (parts of Trentino-Alto Adige region are predominantly German-speaking), French (small French-speaking minority in Valle d\'Aosta region), Slovene (Slovene-speaking minority in the Trieste-Gorizia area)',301230,'25662000','29235000','97225000','21656000','2068000000000',NULL,NULL),(103,'Ivory Coast','CI','CIV','ci','IV',384,'2287781',225,'225','Africa','Yamoussoukro','Africa/Abidjan','Franc','fr-CI','French (official), 60 native dialects of which Dioula is the most widely spoken',322460,'9115','967300','19827000','268000','28280000000',NULL,NULL),(104,'Jamaica','JM','JAM','jm','JM',388,'3489940',1,'1-876','North America','Kingston','America/Jamaica','Dollar','en-JM','English, English patois',10991,'3906','1581000','2665000','265000','14390000000',NULL,NULL),(105,'Japan','JP','JPN','jp','JA',392,'1861060',81,'81','Asia','Tokyo','Asia/Tokyo','Yen','ja','Japanese',377835,'64453000','99182000','138363000','64273000','5007000000000',NULL,NULL),(106,'Jersey','JE','JEY','je','JE',832,'3042142',44,'44-1534','Europe','Saint Helier','Europe/Jersey','Pound','en,pt','English 94.5% (official), Portuguese 4.6%, other 0.9% (2001 census)',116,'264','29500','108000','73800','5100000000',NULL,NULL),(107,'Jordan','JO','JOR','jo','JO',400,'248816',962,'962','Asia','Amman','Asia/Amman','Dinar','ar-JO,en','Arabic (official), English (widely understood among upper and middle classes)',92300,'69473','1642000','8984000','435000','34080000000',NULL,NULL),(108,'Kazakhstan','KZ','KAZ','kz','KZ',398,'1522867',7,'7','Asia','Astana','Asia/Almaty','Tenge','kk,ru','Kazakh (official, Qazaq) 64.4%, Russian (official, used in everyday business, designated the \"language of interethnic communication\") 95% (2001 est.)',2717300,'67464','5299000','28731000','4340000','224900000000',NULL,NULL),(109,'Kenya','KE','KEN','ke','KE',404,'192950',254,'254','Africa','Nairobi','Africa/Nairobi','Shilling','en-KE,sw-KE','English (official), Kiswahili (official), numerous indigenous languages',582650,'71018','3996000','30732000','251600','45310000000',NULL,NULL),(110,'Kiribati','KI','KIR','ki','KR',296,'4030945',686,'686','Oceania','Tarawa','Pacific/Tarawa','Dollar','en-KI,gil','I-Kiribati, English (official)',811,'327','7800','16000','9000','173000000',NULL,NULL),(111,'Kosovo','XK','XKX','','KV',0,'831053',383,'383','Europe','Pristina','Europe/Podgorica','Euro','sq,sr','Albanian (official), Serbian (official), Bosnian, Turkish, Roma',10887,'','','562000','106300','7150000000',NULL,NULL),(112,'Kuwait','KW','KWT','kw','KU',414,'285570',965,'965','Asia','Kuwait City','Asia/Kuwait','Dinar','ar-KW,en','Arabic (official), English widely spoken',17820,'2771','1100000','5526000','510000','179500000000',NULL,NULL),(113,'Kyrgyzstan','KG','KGZ','kg','KG',417,'1527747',996,'996','Asia','Bishkek','Asia/Bishkek','Som','ky,uz,ru','Kyrgyz (official) 64.7%, Uzbek 13.6%, Russian (official) 12.5%, Dungun 1%, other 8.2% (1999 census)',198500,'115573','2195000','6800000','489000','7234000000',NULL,NULL),(114,'Laos','LA','LAO','la','LA',418,'1655842',856,'856','Asia','Vientiane','Asia/Vientiane','Kip','lo,fr,en','Lao (official), French, English, various ethnic languages',236800,'1532','300000','6492000','112000','10100000000',NULL,NULL),(115,'Latvia','LV','LVA','lv','LG',428,'458258',371,'371','Europe','Riga','Europe/Riga','Euro','lv,ru,lt','Latvian (official) 56.3%, Russian 33.8%, other 0.6% (includes Polish, Ukrainian, and Belarusian), unspecified 9.4% (2011 est.)',64589,'359604','1504000','2310000','501000','30380000000',NULL,NULL),(116,'Lebanon','LB','LBN','lb','LE',422,'272103',961,'961','Asia','Beirut','Asia/Beirut','Pound','ar-LB,fr-LB,en,hy','Arabic (official), French, English, Armenian',10400,'64926','1000000','4000000','878000','43490000000',NULL,NULL),(117,'Lesotho','LS','LSO','ls','LT',426,'932692',266,'266','Africa','Maseru','Africa/Maseru','Loti','en-LS,st,zu,xh','Sesotho (official) (southern Sotho), English (official), Zulu, Xhosa',30355,'11030','76800','1312000','43100','2457000000',NULL,NULL),(118,'Liberia','LR','LBR','lr','LI',430,'2275384',231,'231','Africa','Monrovia','Africa/Monrovia','Dollar','en-LR','English 20% (official), some 20 ethnic group languages few of which can be written or used in correspondence',111370,'7','20000','2394000','3200','1977000000',NULL,NULL),(119,'Libya','LY','LBY','ly','LY',434,'2215636',218,'218','Africa','Tripolis','Africa/Tripoli','Dinar','ar-LY,it,en','Arabic (official), Italian, English (all widely understood in the major cities); Berber (Nafusi, Ghadamis, Suknah, Awjilah, Tamasheq)',1759540,'17926','353900','9590000','814000','70920000000',NULL,NULL),(120,'Liechtenstein','LI','LIE','li','LS',438,'3042058',423,'423','Europe','Vaduz','Europe/Vaduz','Franc','de-LI','German 94.5% (official) (Alemannic is the main dialect), Italian 1.1%, other 4.3% (2010 est.)',160,'14278','23000','38000','20000','5113000000',NULL,NULL),(121,'Lithuania','LT','LTU','lt','LH',440,'597427',370,'370','Europe','Vilnius','Europe/Vilnius','Euro','lt,ru,pl','Lithuanian (official) 82%, Russian 8%, Polish 5.6%, other 0.9%, unspecified 3.5% (2011 est.)',65200,'1205000','1964000','5000000','667300','46710000000',NULL,NULL),(122,'Luxembourg','LU','LUX','lu','LU',442,'2960313',352,'352','Europe','Luxembourg','Europe/Luxembourg','Euro','lb,de-LU,fr-LU','Luxembourgish (official administrative language and national language (spoken vernacular)), French (official administrative language), German (official administrative language)',2586,'250900','424500','761300','266700','60540000000',NULL,NULL),(123,'Macau','MO','MAC','mo','MC',446,'1821275',853,'853','Asia','Macao','Asia/Macau','Pataca','zh,zh-MO,pt','Cantonese 83.3%, Mandarin 5%, Hokkien 3.7%, English 2.3%, other Chinese dialects 2%, Tagalog 1.7%, Portuguese 0.7%, other 1.3%',254,'327','270200','1613000','162500','51680000000',NULL,NULL),(124,'Macedonia','MK','MKD','mk','MK',807,'718075',389,'389','Europe','Skopje','Europe/Skopje','Denar','mk,sq,tr,rmm,sr','Macedonian (official) 66.5%, Albanian (official) 25.1%, Turkish 3.5%, Roma 1.9%, Serbian 1.2%, other 1.8% (2002 census)',25333,'62826','1057000','2235000','407900','10650000000',NULL,NULL),(125,'Madagascar','MG','MDG','mg','MA',450,'1062947',261,'261','Africa','Antananarivo','Indian/Antananarivo','Ariary','fr-MG,mg','French (official), Malagasy (official), English',587040,'38392','319900','8564000','143700','10530000000',NULL,NULL),(126,'Malawi','MW','MWI','mw','MI',454,'927384',265,'265','Africa','Lilongwe','Africa/Blantyre','Kwacha','ny,yao,tum,swk','English (official), Chichewa (common), Chinyanja, Chiyao, Chitumbuka, Chilomwe, Chinkhonde, Chingoni, Chisena, Chitonga, Chinyakyusa, Chilambya',118480,'1099','716400','4420000','227300','3683000000',NULL,NULL),(127,'Malaysia','MY','MYS','my','MY',458,'1733045',60,'60','Asia','Kuala Lumpur','Asia/Kuala_Lumpur','Ringgit','ms-MY,en,zh,ta,te,ml,pa,th','Bahasa Malaysia (official), English, Chinese (Cantonese, Mandarin, Hokkien, Hakka, Hainan, Foochow), Tamil, Telugu, Malayalam, Panjabi, Thai',329750,'422470','15355000','41325000','4589000','312400000000',NULL,NULL),(128,'Maldives','MV','MDV','mv','MV',462,'1282028',960,'960','Asia','Male','Indian/Maldives','Rufiyaa','dv,en','Dhivehi (official, dialect of Sinhala, script derived from Arabic), English (spoken by most government officials)',300,'3296','86400','560000','23140','2270000000',NULL,NULL),(129,'Mali','ML','MLI','ml','ML',466,'2453866',223,'223','Africa','Bamako','Africa/Bamako','Franc','fr-ML,bm','French (official), Bambara 46.3%, Peul/foulfoulbe 9.4%, Dogon 7.2%, Maraka/soninke 6.4%, Malinke 5.6%, Sonrhai/djerma 5.6%, Minianka 4.3%, Tamacheq 3.5%, Senoufo 2.6%, unspecified 0.6%, other 8.5%',1240000,'437','249800','14613000','112000','11370000000',NULL,NULL),(130,'Malta','MT','MLT','mt','MT',470,'2562770',356,'356','Europe','Valletta','Europe/Malta','Euro','mt,en-MT','Maltese (official) 90.1%, English (official) 6%, multilingual 3%, other 0.9% (2005 est.)',316,'14754','240600','539500','229700','9541000000',NULL,NULL),(131,'Marshall Islands','MH','MHL','mh','RM',584,'2080185',692,'692','Oceania','Majuro','Pacific/Majuro','Dollar','mh,en-MH','Marshallese (official) 98.2%, other languages 1.8% (1999 census)',181,'3','2200','3800','4400','193000000',NULL,NULL),(132,'Mauritania','MR','MRT','mr','MR',478,'2378080',222,'222','Africa','Nouakchott','Africa/Nouakchott','Ouguiya','ar-MR,fuc,snk,fr,mey,wo','Arabic (official and national), Pulaar, Soninke, Wolof (all national languages), French, Hassaniya (a variety of Arabic)',1030700,'22','75000','4024000','65100','4183000000',NULL,NULL),(133,'Mauritius','MU','MUS','mu','MP',480,'934292',230,'230','Africa','Port Louis','Indian/Mauritius','Rupee','en-MU,bho,fr','Creole 86.5%, Bhojpuri 5.3%, French 4.1%, two languages 1.4%, other 2.6% (includes English, the official language, which is spoken by less than 1% of the population), unspecified 0.1% (2011 est.)',2040,'51139','290000','1485000','349100','11900000000',NULL,NULL),(134,'Mayotte','YT','MYT','yt','MF',175,'1024031',262,'262','Africa','Mamoudzou','Indian/Mayotte','Euro','fr-YT','French',374,'','','','','',NULL,NULL),(135,'Mexico','MX','MEX','mx','MX',484,'3996063',52,'52','North America','Mexico City','America/Mexico_City','Peso','es-MX','Spanish only 92.7%, Spanish and indigenous languages 5.7%, indigenous only 0.8%, unspecified 0.8%',1972550,'16233000','31020000','100786000','20220000','1327000000000',NULL,NULL),(136,'Micronesia','FM','FSM','fm','FM',583,'2081918',691,'691','Oceania','Palikir','Pacific/Pohnpei','Dollar','en-FM,chk,pon,yap,kos,uli,woe,nkr,kpg','English (official and common language), Chuukese, Kosrean, Pohnpeian, Yapese, Ulithian, Woleaian, Nukuoro, Kapingamarangi',702,'4668','17000','27600','8400','339000000',NULL,NULL),(137,'Moldova','MD','MDA','md','MD',498,'617790',373,'373','Europe','Chisinau','Europe/Chisinau','Leu','ro,ru,gag,tr','Moldovan 58.8% (official; virtually the same as the Romanian language), Romanian 16.4%, Russian 16%, Ukrainian 3.8%, Gagauz 3.1% (a Turkish language), Bulgarian 1.1%, other 0.3%, unspecified 0.4%',33843,'711564','1333000','4080000','1206000','7932000000',NULL,NULL),(138,'Monaco','MC','MCO','mc','MN',492,'2993457',377,'377','Europe','Monaco','Europe/Monaco','Euro','fr-MC,en,it','French (official), English, Italian, Monegasque',2,'26009','23000','33200','44500','5748000000',NULL,NULL),(139,'Mongolia','MN','MNG','mn','MG',496,'2029969',976,'976','Asia','Ulan Bator','Asia/Ulaanbaatar','Tugrik','mn,ru','Khalkha Mongol 90% (official), Turkic, Russian (1999)',1565000,'20084','330000','3375000','176700','11140000000',NULL,NULL),(140,'Montenegro','ME','MNE','me','MJ',499,'3194884',382,'382','Europe','Podgorica','Europe/Podgorica','Euro','sr,hu,bs,sq,hr,rom','Serbian 42.9%, Montenegrin (official) 37%, Bosnian 5.3%, Albanian 5.3%, Serbo-Croat 2%, other 3.5%, unspecified 4% (2011 est.)',14026,'10088','280000','1126000','163000','4518000000',NULL,NULL),(141,'Montserrat','MS','MSR','ms','MH',500,'3578097',1,'1-664','North America','Plymouth','America/Montserrat','Dollar','en-MS','English',102,'2431','1200','4000','3000','',NULL,NULL),(142,'Morocco','MA','MAR','ma','MO',504,'2542007',212,'212','Africa','Rabat','Africa/Casablanca','Dirham','ar-MA,fr','Arabic (official), Berber languages (Tamazight (official), Tachelhit, Tarifit), French (often the language of business, government, and diplomacy)',446550,'277338','13213000','39016000','3280000','104800000000',NULL,NULL),(143,'Mozambique','MZ','MOZ','mz','MZ',508,'1036973',258,'258','Africa','Maputo','Africa/Maputo','Metical','pt-MZ,vmw','Emakhuwa 25.3%, Portuguese (official) 10.7%, Xichangana 10.3%, Cisena 7.5%, Elomwe 7%, Echuwabo 5.1%, other Mozambican languages 30.1%, other 4% (1997 census)',801590,'89737','613600','8108000','88100','14670000000',NULL,NULL),(144,'Myanmar','MM','MMR','mm','BM',104,'1327865',95,'95','Asia','Nay Pyi Taw','Asia/Rangoon','Kyat','my','Burmese (official)',678500,'1055','110000','5440000','556000','59430000000',NULL,NULL),(145,'Namibia','NA','NAM','na','WA',516,'3355338',264,'264','Africa','Windhoek','Africa/Windhoek','Dollar','en-NA,af,de,hz,naq','Oshiwambo languages 48.9%, Nama/Damara 11.3%, Afrikaans 10.4% (common language of most of the population and about 60% of the white population), Otjiherero languages 8.6%, Kavango languages 8.5%, Caprivi languages 4.8%, English (official) 3.4%, other African languages 2.3%, other 1.7%',825418,'78280','127500','2435000','171000','12300000000',NULL,NULL),(146,'Nauru','NR','NRU','nr','NR',520,'2110425',674,'674','Oceania','Yaren','Pacific/Nauru','Dollar','na,en-NR','Nauruan 93% (official, a distinct Pacific Island language), English 2% (widely understood, spoken, and used for most government and commercial purposes), other 5% (includes I-Kiribati 2% and Chinese 2%)',21,'8162','','6800','1900','',NULL,NULL),(147,'Nepal','NP','NPL','np','NP',524,'1282988',977,'977','Asia','Kathmandu','Asia/Kathmandu','Rupee','ne,en','Nepali (official) 44.6%, Maithali 11.7%, Bhojpuri 6%, Tharu 5.8%, Tamang 5.1%, Newar 3.2%, Magar 3%, Bajjika 3%, Urdu 2.6%, Avadhi 1.9%, Limbu 1.3%, Gurung 1.2%, other 10.4%, unspecified 0.2%',140800,'41256','577800','18138000','834000','19340000000',NULL,NULL),(148,'Netherlands','NL','NLD','nl','NL',528,'2750405',31,'31','Europe','Amsterdam','Europe/Amsterdam','Euro','nl-NL,fy-NL','Dutch (official)',41526,'13699000','14872000','19643000','7086000','722300000000',NULL,NULL),(149,'Netherlands Antilles','AN','ANT','an','NT',530,'',599,'599','North America','Willemstad','America/Curacao','Guilder','nl-AN,en,es','Dutch, English, Spanish',960,'','','','','',NULL,NULL),(150,'New Caledonia','NC','NCL','nc','NC',540,'2139685',687,'687','Oceania','Noumea','Pacific/Noumea','Franc','fr-NC','French (official), 33 Melanesian-Polynesian dialects',19060,'34231','85000','231000','80000','9280000000',NULL,NULL),(151,'New Zealand','NZ','NZL','nz','NZ',554,'2186224',64,'64','Oceania','Wellington','Pacific/Auckland','Dollar','en-NZ,mi','English (de facto official) 89.8%, Maori (de jure official) 3.5%, Samoan 2%, Hindi 1.6%, French 1.2%, Northern Chinese 1.2%, Yue 1%, Other or not stated 20.5%, New Zealand Sign Language (de jure official)',268680,'3026000','3400000','4922000','1880000','181100000000',NULL,NULL),(152,'Nicaragua','NI','NIC','ni','NU',558,'3617476',505,'505','North America','Managua','America/Managua','Cordoba','es-NI,en','Spanish (official) 95.3%, Miskito 2.2%, Mestizo of the Caribbean coast 2%, other 0.5%',129494,'296068','199800','5346000','320000','11260000000',NULL,NULL),(153,'Niger','NE','NER','ne','NG',562,'2440476',227,'227','Africa','Niamey','Africa/Niamey','Franc','fr-NE,ha,kr,dje','French (official), Hausa, Djerma',1267000,'454','115900','5400000','100500','7304000000',NULL,NULL),(154,'Nigeria','NG','NGA','ng','NI',566,'2328926',234,'234','Africa','Abuja','Africa/Lagos','Naira','en-NG,ha,yo,ig,ff','English (official), Hausa, Yoruba, Igbo (Ibo), Fulani, over 500 additional indigenous languages',923768,'1234','43989000','112780000','418200','502000000000',NULL,NULL),(155,'Niue','NU','NIU','nu','NE',570,'4036232',683,'683','Oceania','Alofi','Pacific/Niue','Dollar','niu,en-NU','Niuean (official) 46% (a Polynesian language closely related to Tongan and Samoan), Niuean and English 32%, English (official) 11%, Niuean and others 5%, other 6% (2011 est.)',260,'79508','1100','','','10010000',NULL,NULL),(156,'North Korea','KP','PRK','kp','KN',408,'1873107',850,'850','Asia','Pyongyang','Asia/Pyongyang','Won','ko-KP','Korean',120540,'8','','1700000','1180000','28000000000',NULL,NULL),(157,'Northern Mariana Islands','MP','MNP','mp','CQ',580,'4041468',1,'1-670','Oceania','Saipan','Pacific/Saipan','Dollar','fil,tl,zh,ch-MP,en-MP','Philippine languages 32.8%, Chamorro (official) 24.1%, English (official) 17%, other Pacific island languages 10.1%, Chinese 6.8%, other Asian languages 7.3%, other 1.9% (2010 est.)',477,'17','','','','733000000',NULL,NULL),(158,'Norway','NO','NOR','no','NO',578,'3144096',47,'47','Europe','Oslo','Europe/Oslo','Krone','no,nb,nn,se,fi','Bokmal Norwegian (official), Nynorsk Norwegian (official), small Sami- and Finnish-speaking minorities',324220,'3588000','4431000','5732000','1465000','515800000000',NULL,NULL),(159,'Oman','OM','OMN','om','MU',512,'286963',968,'968','Asia','Muscat','Asia/Muscat','Rial','ar-OM,en,bal,ur','Arabic (official), English, Baluchi, Urdu, Indian dialects',212460,'14531','1465000','5278000','305000','81950000000',NULL,NULL),(160,'Pakistan','PK','PAK','pk','PK',586,'1168579',92,'92','Asia','Islamabad','Asia/Karachi','Rupee','ur-PK,en-PK,pa,sd,ps,brh','Punjabi 48%, Sindhi 12%, Saraiki (a Punjabi variant) 10%, Pashto (alternate name, Pashtu) 8%, Urdu (official) 8%, Balochi 3%, Hindko 2%, Brahui 1%, English (official; lingua franca of Pakistani elite and most government ministries), Burushaski, and other 8%',803940,'365813','20431000','125000000','5803000','236500000000',NULL,NULL),(161,'Palau','PW','PLW','pw','PS',585,'1559582',680,'680','Oceania','Melekeok','Pacific/Palau','Dollar','pau,sov,en-PW,tox,ja,fil,zh','Palauan (official on most islands) 66.6%, Carolinian 0.7%, other Micronesian 0.7%, English (official) 15.5%, Filipino 10.8%, Chinese 1.8%, other Asian 2.6%, other 1.3%',458,'4','','17150','7300','221000000',NULL,NULL),(162,'Palestine','PS','PSE','ps','WE',275,'6254930',970,'970','Asia','East Jerusalem','Asia/Hebron','Shekel','ar-PS','Arabic, Hebrew, English',5970,'','1379000','3041000','406000','6641000000',NULL,NULL),(163,'Panama','PA','PAN','pa','PM',591,'3703430',507,'507','North America','Panama City','America/Panama','Balboa','es-PA,en','Spanish (official), English 14%',78200,'11022','959800','6770000','640000','40620000000',NULL,NULL),(164,'Papua New Guinea','PG','PNG','pg','PP',598,'2088628',675,'675','Oceania','Port Moresby','Pacific/Port_Moresby','Kina','en-PG,ho,meu,tpi','Tok Pisin (official), English (official), Hiri Motu (official), some 836 indigenous languages spoken (about 12% of the world\'s total); most languages have fewer than 1,000 speakers',462840,'5006','125000','2709000','139000','16100000000',NULL,NULL),(165,'Paraguay','PY','PRY','py','PA',600,'3437598',595,'595','South America','Asuncion','America/Asuncion','Guarani','es-PY,gn','Spanish (official), Guarani (official)',406750,'280658','1105000','6790000','376000','30560000000',NULL,NULL),(166,'Peru','PE','PER','pe','PE',604,'3932488',51,'51','South America','Lima','America/Lima','Sol','es-PE,qu,ay','Spanish (official) 84.1%, Quechua (official) 13%, Aymara (official) 1.7%, Ashaninka 0.3%, other native languages (includes a large number of minor Amazonian languages) 0.7%, other (includes foreign languages and sign language) 0.2% (2007 est.)',1285220,'234102','9158000','29400000','3420000','210300000000',NULL,NULL),(167,'Philippines','PH','PHL','ph','RP',608,'1694008',63,'63','Asia','Manila','Asia/Manila','Peso','tl,en-PH,fil','Filipino (official; based on Tagalog) and English (official); eight major dialects - Tagalog, Cebuano, Ilocano, Hiligaynon or Ilonggo, Bicol, Waray, Pampango, and Pangasinan',300000,'425812','8278000','103000000','3939000','272200000000',NULL,NULL);
/*!40000 ALTER TABLE `country` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `currencies`
--

DROP TABLE IF EXISTS `currencies`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `currencies` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `symbol` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '2024-01-11 09:57:21',
  `updated_at` timestamp NOT NULL DEFAULT '2024-01-11 09:57:21',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `currencies`
--

LOCK TABLES `currencies` WRITE;
/*!40000 ALTER TABLE `currencies` DISABLE KEYS */;
INSERT INTO `currencies` VALUES (1,'Dolar','USD','$','2024-01-01 06:51:19','2024-01-01 06:51:19'),(2,'Brazilian Real','BRL','R$','2024-01-01 06:51:19','2024-01-01 06:51:19');
/*!40000 ALTER TABLE `currencies` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `customer_alert`
--

DROP TABLE IF EXISTS `customer_alert`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `customer_alert` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `customer_id` bigint unsigned DEFAULT NULL,
  `reseller_id` bigint unsigned DEFAULT NULL,
  `message_template_id` bigint unsigned DEFAULT NULL,
  `delivery_status` tinyint(1) NOT NULL DEFAULT '1',
  `message_content` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '2024-01-11 09:57:23',
  `updated_at` timestamp NOT NULL DEFAULT '2024-01-11 09:57:23',
  PRIMARY KEY (`id`),
  KEY `customer_alert_customer_id_foreign` (`customer_id`),
  KEY `customer_alert_reseller_id_foreign` (`reseller_id`),
  KEY `customer_alert_message_template_id_foreign` (`message_template_id`),
  CONSTRAINT `customer_alert_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE,
  CONSTRAINT `customer_alert_message_template_id_foreign` FOREIGN KEY (`message_template_id`) REFERENCES `message_template` (`id`) ON DELETE SET NULL,
  CONSTRAINT `customer_alert_reseller_id_foreign` FOREIGN KEY (`reseller_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customer_alert`
--

LOCK TABLES `customer_alert` WRITE;
/*!40000 ALTER TABLE `customer_alert` DISABLE KEYS */;
INSERT INTO `customer_alert` VALUES (1,1,NULL,1,1,'TESTE','2024-01-11 19:22:57','2024-01-11 19:22:57'),(2,1,NULL,1,1,'TESTE','2024-01-11 19:48:34','2024-01-11 19:48:34'),(3,1,NULL,1,1,'TESTE','2024-01-11 19:50:17','2024-01-11 19:50:17'),(4,1,NULL,NULL,1,'TESTE','2024-01-12 06:23:18','2024-01-12 06:23:18'),(5,NULL,3,3,1,'Olá seu usuário vence em 2 dias','2024-01-12 06:54:41','2024-01-12 06:54:41'),(6,1,NULL,2,1,'Olá seu usuario vence em 3 dias','2024-01-12 21:10:03','2024-01-12 21:10:03');
/*!40000 ALTER TABLE `customer_alert` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `customer_referal`
--

DROP TABLE IF EXISTS `customer_referal`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `customer_referal` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'facebook',
  `customer_count` int NOT NULL DEFAULT '0',
  `cost_per_customer` int NOT NULL DEFAULT '0',
  `amount_earned` int NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT '2024-01-11 09:57:21',
  `updated_at` timestamp NOT NULL DEFAULT '2024-01-11 09:57:21',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customer_referal`
--

LOCK TABLES `customer_referal` WRITE;
/*!40000 ALTER TABLE `customer_referal` DISABLE KEYS */;
INSERT INTO `customer_referal` VALUES (1,'Diego Bernardino',0,1,1,'2024-01-12 07:28:14','2024-01-12 07:28:14');
/*!40000 ALTER TABLE `customer_referal` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `customers`
--

DROP TABLE IF EXISTS `customers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `customers` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `whatsapp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `screen` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `server` bigint unsigned DEFAULT NULL,
  `expiry_date` date DEFAULT NULL,
  `application_id` bigint unsigned DEFAULT NULL,
  `device_id` bigint unsigned DEFAULT NULL,
  `mac` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` bigint unsigned NOT NULL,
  `country_code` varchar(5) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `customers_server_foreign` (`server`),
  KEY `customers_application_id_foreign` (`application_id`),
  KEY `customers_device_id_foreign` (`device_id`),
  KEY `customers_created_by_foreign` (`created_by`),
  CONSTRAINT `customers_application_id_foreign` FOREIGN KEY (`application_id`) REFERENCES `application` (`id`) ON DELETE SET NULL,
  CONSTRAINT `customers_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`),
  CONSTRAINT `customers_device_id_foreign` FOREIGN KEY (`device_id`) REFERENCES `device` (`id`) ON DELETE SET NULL,
  CONSTRAINT `customers_server_foreign` FOREIGN KEY (`server`) REFERENCES `servers` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customers`
--

LOCK TABLES `customers` WRITE;
/*!40000 ALTER TABLE `customers` DISABLE KEYS */;
INSERT INTO `customers` VALUES (1,'Diego Bernardino','diegobfl.universal@gmail.com','+558596295391','1',1,'2024-03-12',2,2,'65ASD:AS:D:49749','95749574','2024-01-11 19:22:38','2024-01-12 07:27:30',2,NULL),(2,'TESTE5DIAS','TESTE5DIAS','+5585996295391','1',2,NULL,2,2,'22222112','3223232323','2024-01-12 07:11:15','2024-01-12 07:14:13',2,NULL),(3,'TESTE2DIAS','TESTE2DIAS','+558596295391','1',2,NULL,1,1,'123123','123213','2024-01-12 07:11:33','2024-01-12 07:13:31',2,NULL),(4,'TESTE3DIAS','TESTE3DIAS','+5585996295391','1',2,NULL,2,2,'123FDQWE','QWE123Q','2024-01-12 07:11:51','2024-01-12 07:13:56',2,NULL);
/*!40000 ALTER TABLE `customers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `device`
--

DROP TABLE IF EXISTS `device`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `device` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_count` int NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT '2024-01-11 09:57:20',
  `updated_at` timestamp NOT NULL DEFAULT '2024-01-11 09:57:20',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `device`
--

LOCK TABLES `device` WRITE;
/*!40000 ALTER TABLE `device` DISABLE KEYS */;
INSERT INTO `device` VALUES (1,'mackbook',0,'2024-01-11 09:57:20','2024-01-11 09:57:20'),(2,'Teste',0,'2024-01-11 09:57:20','2024-01-11 09:57:20'),(3,'Macbook',0,'2024-01-11 09:57:20','2024-01-11 09:57:20'),(4,'revenda',0,'2024-01-11 09:57:20','2024-01-11 09:57:20');
/*!40000 ALTER TABLE `device` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

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

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint unsigned NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `available_at` int unsigned NOT NULL,
  `created_at` int unsigned NOT NULL,
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
-- Table structure for table `message_tag`
--

DROP TABLE IF EXISTS `message_tag`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `message_tag` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tag` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '2024-01-11 09:57:21',
  `updated_at` timestamp NOT NULL DEFAULT '2024-01-11 09:57:21',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `message_tag`
--

LOCK TABLES `message_tag` WRITE;
/*!40000 ALTER TABLE `message_tag` DISABLE KEYS */;
/*!40000 ALTER TABLE `message_tag` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `message_template`
--

DROP TABLE IF EXISTS `message_template`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `message_template` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `vcard_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vcard_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image_attachment_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `video_attachment_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `audio_attachment_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `sentcount` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT '2024-01-11 09:57:20',
  `updated_at` timestamp NOT NULL DEFAULT '2024-01-11 09:57:20',
  `created_by` bigint unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `message_template_created_by_foreign` (`created_by`),
  CONSTRAINT `message_template_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `message_template`
--

LOCK TABLES `message_template` WRITE;
/*!40000 ALTER TABLE `message_template` DISABLE KEYS */;
INSERT INTO `message_template` VALUES (1,'TESTE','TESTE',NULL,NULL,NULL,NULL,NULL,1,1,'2024-01-11 18:38:00','2024-01-11 18:38:00',2),(2,'3 DIAS DE VENCIMENTO','Olá seu usuario vence em 3 dias',NULL,NULL,NULL,NULL,NULL,1,1,'2024-01-12 06:36:55','2024-01-12 06:36:55',2),(3,'2 DIAS DE VENCIMENTO','Olá seu usuário vence em 2 dias',NULL,NULL,NULL,NULL,NULL,1,1,'2024-01-12 06:37:15','2024-01-12 06:37:15',2),(4,'VENCE EM 1 DIA','Olá seu usuário vence em 1 dia',NULL,NULL,NULL,NULL,NULL,1,1,'2024-01-12 06:37:34','2024-01-12 06:37:34',2),(5,'VENCE HOJE','VENCE HOJE PAGUE AGORA',NULL,NULL,NULL,NULL,NULL,1,1,'2024-01-12 06:37:52','2024-01-12 06:37:52',2);
/*!40000 ALTER TABLE `message_template` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_reset_tokens_table',1),(3,'2014_10_12_100000_create_password_resets_table',1),(4,'2019_08_19_000000_create_failed_jobs_table',1),(5,'2019_12_14_000001_create_personal_access_tokens_table',1),(6,'2023_12_25_050959_create_roles_table',1),(7,'2023_12_25_050965_create_product_table',1),(8,'2023_12_25_052634_create_plan_table',1),(9,'2023_12_25_052635_create_application_table',1),(10,'2023_12_25_052635_create_device_table',1),(11,'2023_12_25_052635_create_message_template_table',1),(12,'2023_12_25_052635_create_servers_table',1),(13,'2023_12_25_052640_create_customers_table',1),(14,'2023_12_25_091248_create_role_user_table',1),(15,'2023_12_25_114949_add_created_by_to_customers_table',1),(16,'2023_12_26_034829_add_created_by_to_plans_table',1),(17,'2023_12_26_040022_create_product_plan',1),(18,'2023_12_26_040022_create_subscription_table',1),(19,'2023_12_26_045206_add_created_by_to_products_table',1),(20,'2023_12_26_045735_add_default_value_for_created_and_updated_to_products_table',1),(21,'2023_12_30_060539_create_subsription_payment_history_table',1),(22,'2023_12_30_061353_add_subscription_duration_to_subsription_payment_history_table',1),(23,'2023_12_30_061421_add_subscription_duration_to_subsriptions_table',1),(24,'2023_12_30_062031_add_subscription_id_to_subsription_payment_history_table',1),(25,'2023_12_30_080130_add_payment_status_payme_gateway_transaction_reference_to_subsription_payment_history_table',1),(26,'2023_12_30_085754_add_active_status_subsriptions_table',1),(27,'2023_12_31_062858_create_message_tag_table',1),(28,'2023_12_31_192335_create_currency_table',1),(29,'2023_12_31_192336_create_settings_table',1),(30,'2024_01_01_060411_create_customer_referal_table',1),(31,'2024_01_01_060430_create_billings_table',1),(32,'2024_01_01_062230_create_billing_notice_histories_table',1),(33,'2024_01_01_075739_add_country_code_to_users_table',1),(34,'2024_01_01_080642_create_tbl_country_table',1),(35,'2024_01_01_085926_add_country_code_to_customers_table',1),(36,'2024_01_01_091246_add_country_device_server_to_customers_table',1),(37,'2024_01_04_063039_add_created_by_to_message_template_table',1),(38,'2024_01_04_065221_add_created_by_to_billings_table',1),(39,'2024_01_06_211200_create_jobs_table',1),(40,'2024_01_09_065333_create_customer_alert_table',1),(41,'2024_01_09_073836_add_site_name_and_logo_and_favicon_to_settings_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_reset_tokens`
--

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
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
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
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
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
-- Table structure for table `plans`
--

DROP TABLE IF EXISTS `plans`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `plans` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` bigint unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `plans_created_by_foreign` (`created_by`),
  CONSTRAINT `plans_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `plans`
--

LOCK TABLES `plans` WRITE;
/*!40000 ALTER TABLE `plans` DISABLE KEYS */;
INSERT INTO `plans` VALUES (1,'PLANO MENSAL 35,00','35,00','2024-01-11 18:37:19','2024-01-12 07:16:58',2),(2,'PLANO MENSAL 30,00','30,00','2024-01-12 06:55:48','2024-01-12 07:18:25',2),(3,'PLANO MENSAL 25,00','25,00','2024-01-12 07:16:46','2024-01-12 07:16:46',2);
/*!40000 ALTER TABLE `plans` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_plan`
--

DROP TABLE IF EXISTS `product_plan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `product_plan` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `plan_id` bigint unsigned NOT NULL,
  `product_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `product_plan_plan_id_foreign` (`plan_id`),
  KEY `product_plan_product_id_foreign` (`product_id`),
  CONSTRAINT `product_plan_plan_id_foreign` FOREIGN KEY (`plan_id`) REFERENCES `plans` (`id`) ON DELETE CASCADE,
  CONSTRAINT `product_plan_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_plan`
--

LOCK TABLES `product_plan` WRITE;
/*!40000 ALTER TABLE `product_plan` DISABLE KEYS */;
INSERT INTO `product_plan` VALUES (1,1,5,'2024-01-12 07:24:45','2024-01-12 07:24:45'),(2,2,5,'2024-01-12 07:24:55','2024-01-12 07:24:55'),(3,3,5,'2024-01-12 07:25:32','2024-01-12 07:25:32');
/*!40000 ALTER TABLE `product_plan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `products` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '2024-01-11 09:57:21',
  `updated_at` timestamp NOT NULL DEFAULT '2024-01-11 09:57:21',
  `created_by` bigint unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `products_created_by_foreign` (`created_by`),
  CONSTRAINT `products_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (1,'Product 1','1000','2024-01-01 09:02:14','2024-01-01 09:02:14',1),(2,'Product 2','200','2024-01-01 09:02:25','2024-01-01 09:02:25',1),(3,'Reseller product','234','2024-01-03 18:47:32','2024-01-03 18:47:32',1),(4,'Reseller product 22','345','2024-01-03 18:59:36','2024-01-04 05:01:48',1),(5,'CLUB TV','4,50','2024-01-11 18:36:52','2024-01-11 18:36:52',2);
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `role_user`
--

DROP TABLE IF EXISTS `role_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `role_user` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `role_id` bigint unsigned NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `role_user_role_id_foreign` (`role_id`),
  KEY `role_user_user_id_foreign` (`user_id`),
  CONSTRAINT `role_user_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`),
  CONSTRAINT `role_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role_user`
--

LOCK TABLES `role_user` WRITE;
/*!40000 ALTER TABLE `role_user` DISABLE KEYS */;
INSERT INTO `role_user` VALUES (1,1,1,NULL,NULL),(2,1,2,NULL,NULL),(3,2,3,NULL,NULL),(4,2,4,NULL,NULL);
/*!40000 ALTER TABLE `role_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `roles` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'admin','2024-01-11 10:20:21','2024-01-11 10:20:21'),(2,'reseller','2024-01-11 10:20:21','2024-01-11 10:20:21');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `servers`
--

DROP TABLE IF EXISTS `servers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `servers` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_count` int NOT NULL DEFAULT '0',
  `cost_of_server_product` int NOT NULL DEFAULT '0',
  `default_message` bigint unsigned DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '2024-01-11 09:57:20',
  `updated_at` timestamp NOT NULL DEFAULT '2024-01-11 09:57:20',
  PRIMARY KEY (`id`),
  KEY `servers_default_message_foreign` (`default_message`),
  CONSTRAINT `servers_default_message_foreign` FOREIGN KEY (`default_message`) REFERENCES `message_template` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `servers`
--

LOCK TABLES `servers` WRITE;
/*!40000 ALTER TABLE `servers` DISABLE KEYS */;
INSERT INTO `servers` VALUES (1,'WAREZ',0,0,NULL,'2024-01-11 09:57:20','2024-01-11 18:39:55'),(2,'CLUB TV',0,0,NULL,'2024-01-11 09:57:20','2024-01-11 18:39:45'),(3,'master',0,0,NULL,'2024-01-11 09:57:20','2024-01-11 09:57:20');
/*!40000 ALTER TABLE `servers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `settings`
--

DROP TABLE IF EXISTS `settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `settings` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `default_payment_message` bigint unsigned DEFAULT NULL,
  `currency` bigint unsigned DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '2024-01-11 09:57:21',
  `updated_at` timestamp NOT NULL DEFAULT '2024-01-11 09:57:21',
  `site_logo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `site_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `site_description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `site_favicon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `settings_default_payment_message_foreign` (`default_payment_message`),
  KEY `settings_currency_foreign` (`currency`),
  CONSTRAINT `settings_currency_foreign` FOREIGN KEY (`currency`) REFERENCES `currencies` (`id`) ON DELETE SET NULL,
  CONSTRAINT `settings_default_payment_message_foreign` FOREIGN KEY (`default_payment_message`) REFERENCES `message_template` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `settings`
--

LOCK TABLES `settings` WRITE;
/*!40000 ALTER TABLE `settings` DISABLE KEYS */;
INSERT INTO `settings` VALUES (1,1,2,'2024-01-01 06:51:19','2024-01-01 06:51:19','http://dev.dblplay.top/storage/uploads/site_images/QvQmm4BXY9kzsY3TtPPhSoSn8e3aLPSLjWdjqYh4.png','Gestor DBL Digital','Plataforma de gestão de clientes','http://dev.dblplay.top/storage/uploads/site_images/RxNPpxwKs9BZOgeNsJiitOekYHUE5DJMHD7KQ0fi.jpg');
/*!40000 ALTER TABLE `settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `subscriptions`
--

DROP TABLE IF EXISTS `subscriptions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `subscriptions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `product_plan_id` bigint unsigned NOT NULL,
  `customer_id` bigint unsigned DEFAULT NULL,
  `reseller_id` bigint unsigned DEFAULT NULL,
  `next_due_date` timestamp NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '2024-01-11 09:57:20',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `subscription_duration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `active_status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `subscriptions_product_plan_id_foreign` (`product_plan_id`),
  KEY `subscriptions_customer_id_foreign` (`customer_id`),
  KEY `subscriptions_reseller_id_foreign` (`reseller_id`),
  CONSTRAINT `subscriptions_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE,
  CONSTRAINT `subscriptions_product_plan_id_foreign` FOREIGN KEY (`product_plan_id`) REFERENCES `product_plan` (`id`) ON DELETE CASCADE,
  CONSTRAINT `subscriptions_reseller_id_foreign` FOREIGN KEY (`reseller_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `subscriptions`
--

LOCK TABLES `subscriptions` WRITE;
/*!40000 ALTER TABLE `subscriptions` DISABLE KEYS */;
INSERT INTO `subscriptions` VALUES (1,1,1,NULL,'2024-03-12 07:26:56','2024-01-12 07:26:56','2024-01-12 07:28:40','monthly',0);
/*!40000 ALTER TABLE `subscriptions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `subsription_payment_history`
--

DROP TABLE IF EXISTS `subsription_payment_history`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `subsription_payment_history` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `product_plan_id` bigint unsigned NOT NULL,
  `customer_id` bigint unsigned DEFAULT NULL,
  `reseller_id` bigint unsigned DEFAULT NULL,
  `next_due_date_payment` timestamp NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '2024-01-11 09:57:21',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `subscription_duration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subscription_id` bigint unsigned NOT NULL,
  `payment_status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `payment_gateway` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'cash',
  `payment_reference` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `subsription_payment_history_product_plan_id_foreign` (`product_plan_id`),
  KEY `subsription_payment_history_customer_id_foreign` (`customer_id`),
  KEY `subsription_payment_history_reseller_id_foreign` (`reseller_id`),
  KEY `subsription_payment_history_subscription_id_foreign` (`subscription_id`),
  CONSTRAINT `subsription_payment_history_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE,
  CONSTRAINT `subsription_payment_history_product_plan_id_foreign` FOREIGN KEY (`product_plan_id`) REFERENCES `product_plan` (`id`) ON DELETE CASCADE,
  CONSTRAINT `subsription_payment_history_reseller_id_foreign` FOREIGN KEY (`reseller_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `subsription_payment_history_subscription_id_foreign` FOREIGN KEY (`subscription_id`) REFERENCES `subscriptions` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `subsription_payment_history`
--

LOCK TABLES `subsription_payment_history` WRITE;
/*!40000 ALTER TABLE `subsription_payment_history` DISABLE KEYS */;
INSERT INTO `subsription_payment_history` VALUES (1,1,1,NULL,'2024-02-12 07:26:56','2024-01-12 07:27:30','2024-01-12 07:27:30','monthly',1,'1',NULL,'pos',NULL);
/*!40000 ALTER TABLE `subsription_payment_history` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `whatsapp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `screen` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `server` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `device` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `expiry_date` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `application` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mac` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `key` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `country_code` varchar(5) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Emmanuel Austine','emmauser','08143233341',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'eaustine890@yahoo.com',NULL,'$2y$12$omGdSs079fEhcs4oHB01guSr5HBHmS4.mBb3WJi6NxZVr33Xnwnyu',NULL,'2024-01-11 10:18:29','2024-01-11 10:18:29',NULL),(2,'Diego Bernardino','Diego Bernardino','85996295391',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'diegobfl.universal@gmail.com',NULL,'$2y$12$ixJYlw8K0DuNC.KTYInIwuzLZMOhCb5ZvOyTTT7nGXLa.n/0rGcTq','eIcUf3tnVyp1BLi5EBgfeJ59qAS2KLTrqUfmot7ylqzhA4tUulqfbpRu7Jyd','2024-01-11 16:20:48','2024-01-11 16:20:48',NULL),(3,'Emmanuel Reseller','reseller','07033244935',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'eaustine89@gmail.com',NULL,'$2y$12$WPx2FHXZ.hOlSLEI/zRUwe9LxCkG9GnA.s4SSqvQJGKytVtDf4dta',NULL,'2024-01-11 16:24:24','2024-01-11 16:24:24',NULL),(4,'marcos','marcospaulo','8596295391',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'guspiyarda@gufum.com',NULL,'$2y$12$cHPheTJk9X4oUdlCpsCt2.WXZwKXtcwgaZR4bU4yt8JQhhfV6/ZPm',NULL,'2024-01-12 07:20:25','2024-01-12 07:20:25',NULL);
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

-- Dump completed on 2024-01-12 21:52:44
