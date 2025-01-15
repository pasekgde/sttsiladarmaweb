-- MariaDB dump 10.19  Distrib 10.11.6-MariaDB, for Linux (x86_64)
--
-- Host: localhost    Database: dbwebstt
-- ------------------------------------------------------
-- Server version	10.11.6-MariaDB

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
-- Table structure for table `absensis`
--

DROP TABLE IF EXISTS `absensis`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `absensis` (
  `idabsensi` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `idkegiatan` varchar(255) NOT NULL,
  `idanggota` varchar(255) NOT NULL,
  `presensi` varchar(255) NOT NULL,
  `denda` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` enum('-','Lunas','Belum Bayar') NOT NULL DEFAULT '-',
  `tanggal_bayar` date DEFAULT NULL,
  PRIMARY KEY (`idabsensi`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `absensis`
--

LOCK TABLES `absensis` WRITE;
/*!40000 ALTER TABLE `absensis` DISABLE KEYS */;
INSERT INTO `absensis` VALUES
(1,'1','1','Hadir',0,'2025-01-06 11:44:03','2025-01-06 11:44:03','-',NULL),
(4,'3','1','Hadir',0,'2025-01-11 04:12:43','2025-01-11 04:12:43','-',NULL),
(5,'3','3','Hadir',0,'2025-01-11 04:12:43','2025-01-11 04:12:43','-',NULL),
(6,'3','4','Hadir',0,'2025-01-11 04:12:43','2025-01-11 04:12:43','-',NULL),
(7,'4','3','Hadir',0,'2025-01-11 04:43:58','2025-01-11 04:43:58','-',NULL),
(8,'4','6','Tidak Hadir',1000,'2025-01-11 04:43:58','2025-01-11 04:46:25','Lunas','2025-01-11'),
(9,'5','3','Hadir',0,'2025-01-11 04:44:20','2025-01-11 04:44:20','-',NULL),
(10,'5','6','Tidak Hadir',1000,'2025-01-11 04:44:20','2025-01-11 04:46:25','Lunas','2025-01-11'),
(11,'6','3','Hadir',0,'2025-01-11 04:44:45','2025-01-11 04:44:45','-',NULL),
(12,'6','6','Tidak Hadir',1000,'2025-01-11 04:44:45','2025-01-11 04:46:25','Lunas','2025-01-11'),
(13,'7','3','Hadir',0,'2025-01-11 04:45:02','2025-01-11 04:45:02','-',NULL),
(14,'7','6','Tidak Hadir',1000,'2025-01-11 04:45:02','2025-01-11 04:46:25','Lunas','2025-01-11');
/*!40000 ALTER TABLE `absensis` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `anggota`
--

DROP TABLE IF EXISTS `anggota`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `anggota` (
  `idanggota` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) NOT NULL,
  `tgllahir` date NOT NULL,
  `umur` int(11) NOT NULL,
  `pekerjaan` varchar(255) NOT NULL,
  `tempek` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`idanggota`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `anggota`
--

LOCK TABLES `anggota` WRITE;
/*!40000 ALTER TABLE `anggota` DISABLE KEYS */;
INSERT INTO `anggota` VALUES
(6,'MADE','1991-06-18',33,'Mahasiswa','Kangin','Aktif','2025-01-11 04:43:41','2025-01-11 04:43:41'),
(7,'NYOMAN','2000-02-08',24,'Mahasiswa','Kangin','Nekel','2025-01-13 12:44:56','2025-01-13 12:44:56');
/*!40000 ALTER TABLE `anggota` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bayariuran`
--

DROP TABLE IF EXISTS `bayariuran`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bayariuran` (
  `idbayariuran` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `idanggota` varchar(255) NOT NULL,
  `idiuran` varchar(255) NOT NULL,
  `jumlahbayar` int(11) NOT NULL,
  `tanggalbayar` varchar(255) DEFAULT NULL,
  `statusbayar` enum('Terbayar','Belum Bayar') NOT NULL DEFAULT 'Belum Bayar',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`idbayariuran`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bayariuran`
--

LOCK TABLES `bayariuran` WRITE;
/*!40000 ALTER TABLE `bayariuran` DISABLE KEYS */;
INSERT INTO `bayariuran` VALUES
(5,'3','4',100000,'2025-01-11 04:33:55','Terbayar','2025-01-11 04:33:55','2025-01-11 04:33:55');
/*!40000 ALTER TABLE `bayariuran` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `events`
--

DROP TABLE IF EXISTS `events`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `events` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `kodeevent` varchar(255) DEFAULT NULL,
  `kodekegiatan` varchar(255) NOT NULL,
  `jeniskas` varchar(255) NOT NULL,
  `tglkas` date NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `qty` varchar(255) DEFAULT NULL,
  `harga` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `user` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `events`
--

LOCK TABLES `events` WRITE;
/*!40000 ALTER TABLE `events` DISABLE KEYS */;
/*!40000 ALTER TABLE `events` ENABLE KEYS */;
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
-- Table structure for table `iuran`
--

DROP TABLE IF EXISTS `iuran`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `iuran` (
  `idiuran` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `perihal` varchar(255) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `total_iuran` int(11) DEFAULT NULL,
  `total_anggota` int(11) DEFAULT NULL,
  `total_yangsudahbayar` int(11) DEFAULT NULL,
  `total_yangbelumbayar` int(11) DEFAULT NULL,
  `total_bayar` int(11) DEFAULT NULL,
  `status` enum('Lengkap','Belum Lengkap','Terkirim ke Kas') NOT NULL DEFAULT 'Belum Lengkap',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`idiuran`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `iuran`
--

LOCK TABLES `iuran` WRITE;
/*!40000 ALTER TABLE `iuran` DISABLE KEYS */;
INSERT INTO `iuran` VALUES
(4,'makan',100000,100000,1,1,0,100000,'Terkirim ke Kas','2025-01-11 04:33:39','2025-01-11 04:34:11');
/*!40000 ALTER TABLE `iuran` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kas`
--

DROP TABLE IF EXISTS `kas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `kas` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `kodekas` varchar(255) NOT NULL,
  `jeniskas` varchar(255) NOT NULL,
  `tglkas` date NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `qty` varchar(255) DEFAULT NULL,
  `harga` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `user` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kas`
--

LOCK TABLES `kas` WRITE;
/*!40000 ALTER TABLE `kas` DISABLE KEYS */;
INSERT INTO `kas` VALUES
(1,'KIN0001','Masuk','2025-01-10','Pembayaran Penekelan Atas Nama KETUT','-',0,50000,'superadmin','2025-01-10 15:17:20','2025-01-10 15:17:20'),
(2,'KIN0002','Masuk','2025-01-11','Pembayaran Penekelan Atas Nama WAYAN','',0,1005,'superadmin','2025-01-10 22:28:42','2025-01-11 04:36:27'),
(4,'KIN0003','Masuk','2025-01-11','Pembayaran Denda MADE','-',0,8000,'superadmin','2025-01-11 04:46:25','2025-01-11 04:46:25'),
(5,'KIN0004','Masuk','2025-01-12','Pembayaran Penekelan Atas Nama WAYAN','-',0,100000,'superadmin','2025-01-11 04:47:02','2025-01-11 04:47:02'),
(6,'KIN0005','Masuk','2025-01-13','Pembayaran Penekelan Atas Nama NYOMAN','-',0,100000,'superadmin','2025-01-13 12:45:25','2025-01-13 12:45:25');
/*!40000 ALTER TABLE `kas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kegiatan`
--

DROP TABLE IF EXISTS `kegiatan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `kegiatan` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `kodekegiatan` varchar(255) NOT NULL,
  `tglpembuatan` date NOT NULL,
  `namakegiatan` varchar(255) NOT NULL,
  `deskripsi` varchar(255) NOT NULL,
  `kasmasuk` int(11) DEFAULT NULL,
  `kaskeluar` int(11) DEFAULT NULL,
  `saldo` int(11) DEFAULT NULL,
  `user` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `pengguna` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`pengguna`)),
  `status` varchar(255) NOT NULL DEFAULT 'belum',
  `ketuapanitia` varchar(255) DEFAULT NULL,
  `sekretarispanitia` varchar(255) DEFAULT NULL,
  `bendaharapanitia` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kegiatan`
--

LOCK TABLES `kegiatan` WRITE;
/*!40000 ALTER TABLE `kegiatan` DISABLE KEYS */;
/*!40000 ALTER TABLE `kegiatan` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES
(1,'2014_10_12_000000_create_users_table',1),
(2,'2014_10_12_100000_create_password_resets_table',1),
(3,'2019_08_19_000000_create_failed_jobs_table',1),
(4,'2019_12_14_000001_create_personal_access_tokens_table',1),
(5,'2022_12_17_110456_create_anggotas_table',1),
(6,'2022_12_22_162009_create_kas_table',1),
(7,'2023_02_04_174613_create_kegiatans_table',1),
(8,'2023_02_09_161040_create_events_table',1),
(9,'2023_02_12_011128_create_temps_table',1),
(10,'2024_10_16_051709_create_absensis_table',1),
(11,'2024_10_23_045627_create_tabel_kegiatans_table',1),
(12,'2024_11_08_142414_add_denda_to_absensis_table',2),
(14,'2024_11_10_012054_add_total_denda_to_tabel_kegiatans--table=tabel_kegiatans',3),
(15,'2024_11_10_012926_add_total_denda_to_tabel_kegiatans--table=tabel_kegiatans',4),
(16,'2024_11_17_011821_add_status_to_absensis_table',5),
(17,'2024_11_17_035707_add_tanggal_bayar_to_absensis',6),
(18,'2024_12_02_060744_create_iurans_table',7),
(19,'2024_12_02_062236_create_bayariurans_table',7),
(20,'2024_12_04_053931_add_totaliuran_to_iuran_table',8),
(21,'2024_12_04_054630_remove_status_from_iuran',9),
(22,'2024_12_04_152653_add_total_bayar_to_iuran_table',10),
(23,'2024_12_06_040641_add_tglpembuatan_field_to_kegiatan_table',11),
(24,'2024_12_06_145619_add_datakas_to_kegiatan_table',12),
(25,'2024_12_09_045414_add_pengguna_to_kegiatan_table',13),
(26,'2024_12_12_062939_add_status_to_kegiatan_table',14),
(27,'2024_12_18_022828_create_penikelans_table',15),
(28,'2024_12_25_041456_create_sisteminfos_table',16),
(29,'2024_12_26_154925_add_organisasi_to_sisteminfo_table',17),
(30,'2024_12_27_033005_add_background_to_sisteminfo_table',18),
(31,'2025_01_06_104338_create_penguruses_table',19),
(32,'2025_01_06_122923_add_namapanitia_to_kegiatan_table',20),
(33,'2025_01_06_150650_create_penekelans_table',21);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
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
-- Table structure for table `penekelan`
--

DROP TABLE IF EXISTS `penekelan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `penekelan` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `idanggota` varchar(255) NOT NULL,
  `bayarpenekelan` varchar(255) NOT NULL,
  `tanggalbayar` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `penekelan`
--

LOCK TABLES `penekelan` WRITE;
/*!40000 ALTER TABLE `penekelan` DISABLE KEYS */;
INSERT INTO `penekelan` VALUES
(1,'3','100000','2025-01-12','2025-01-11 04:47:02','2025-01-11 04:47:02'),
(2,'7','100000','2025-01-13','2025-01-13 12:45:25','2025-01-13 12:45:25');
/*!40000 ALTER TABLE `penekelan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pengurus`
--

DROP TABLE IF EXISTS `pengurus`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pengurus` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `ketua` varchar(255) NOT NULL,
  `sekretaris` varchar(255) NOT NULL,
  `bendahara` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pengurus`
--

LOCK TABLES `pengurus` WRITE;
/*!40000 ALTER TABLE `pengurus` DISABLE KEYS */;
INSERT INTO `pengurus` VALUES
(1,'I Nyoman Prakoso','I Gutsi Alit Jambe','Sang Made putra erawan','2025-01-06 11:23:48','2025-01-06 11:43:04');
/*!40000 ALTER TABLE `pengurus` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `penikelan`
--

DROP TABLE IF EXISTS `penikelan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `penikelan` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `penikelan_denda` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `penikelan`
--

LOCK TABLES `penikelan` WRITE;
/*!40000 ALTER TABLE `penikelan` DISABLE KEYS */;
INSERT INTO `penikelan` VALUES
(1,3,'2024-12-18 03:00:52','2025-01-06 15:02:32');
/*!40000 ALTER TABLE `penikelan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
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
-- Table structure for table `sisteminfo`
--

DROP TABLE IF EXISTS `sisteminfo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sisteminfo` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nama_sistem` varchar(255) NOT NULL,
  `subjudul` varchar(255) NOT NULL,
  `logo` varchar(255) NOT NULL,
  `deskripsi1` varchar(255) NOT NULL,
  `deskripsi2` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `organisasi` varchar(255) DEFAULT NULL,
  `background` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sisteminfo`
--

LOCK TABLES `sisteminfo` WRITE;
/*!40000 ALTER TABLE `sisteminfo` DISABLE KEYS */;
INSERT INTO `sisteminfo` VALUES
(2,'SIDARMA','Sistem Informasi STT Sila Dharma','logos/1iFwCDTLFjCLgeVQEiPtscYfD43jMTDFbrv369FU.png','\"Sagilik Saguluk, Salunglung Sabayantaka, Paras Paros Sarpanaya, Saling Asah Asih Asuh\"','2024 Cempaga-Bangli','2024-12-26 15:11:14','2025-01-07 07:04:57','STT. SILA DHARMA','logos/BpdfpR0yLn9rrgp9A4MDXfMVxzGmmsPzaVEXDUg0.jpg');
/*!40000 ALTER TABLE `sisteminfo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tabel_kegiatans`
--

DROP TABLE IF EXISTS `tabel_kegiatans`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tabel_kegiatans` (
  `idkegiatan` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `tanggal_kegiatan` date NOT NULL,
  `nama_kegiatan` varchar(255) NOT NULL,
  `jenis_kegiatan` varchar(255) NOT NULL,
  `denda` varchar(255) NOT NULL,
  `total_denda` int(11) DEFAULT NULL,
  `total_anggota` int(11) DEFAULT NULL,
  `total_hadir` int(11) DEFAULT NULL,
  `total_tidak_hadir` int(11) DEFAULT NULL,
  `keterangan` varchar(255) NOT NULL,
  `user` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`idkegiatan`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tabel_kegiatans`
--

LOCK TABLES `tabel_kegiatans` WRITE;
/*!40000 ALTER TABLE `tabel_kegiatans` DISABLE KEYS */;
INSERT INTO `tabel_kegiatans` VALUES
(1,'2025-01-06','s','Ngayah','10000',0,1,1,0,'Bebas','superadmin','2025-01-06 11:44:03','2025-01-06 11:44:03'),
(3,'2025-01-01','judol bersama H-1','Acara Lain','100',0,3,3,0,'Malam hari jam 7','superadmin','2025-01-11 04:12:43','2025-01-11 04:12:43'),
(4,'2025-01-11','ds','Tedun','1000',1000,2,1,1,'Sdsf','superadmin','2025-01-11 04:43:58','2025-01-11 04:43:58'),
(5,'2025-01-08','sdfds','Ngayah','1000',1000,2,1,1,'Dds','superadmin','2025-01-11 04:44:20','2025-01-11 04:44:20'),
(6,'2025-01-09','sdfgds','Tedun','1000',1000,2,1,1,'Sddknfdksl','superadmin','2025-01-11 04:44:45','2025-01-11 04:44:45'),
(7,'2025-01-07','dslkflkds','Paum','1000',1000,2,1,1,'Dsjkbfkjds','superadmin','2025-01-11 04:45:02','2025-01-11 04:45:02');
/*!40000 ALTER TABLE `tabel_kegiatans` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `temps`
--

DROP TABLE IF EXISTS `temps`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `temps` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `kodekegiatan` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `temps`
--

LOCK TABLES `temps` WRITE;
/*!40000 ALTER TABLE `temps` DISABLE KEYS */;
/*!40000 ALTER TABLE `temps` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES
(2,'superadmin','superadmin@admin.com',NULL,'$2y$10$Rvv0Ji45ljn8mx5ht19TKeud/vJamf7KR7mOvD2tYKCTlHTgsUNse','Superadmin',NULL,'2024-10-29 01:55:09','2024-12-13 02:47:35'),
(3,'Budi','budi@sttcempaga.com',NULL,'$2y$10$KTEYiXiJOaCB7qoUsKvnauEgwYQf0ZTyVugcA.rKdhCWRy75bCSR.','Panitia',NULL,'2024-12-07 00:44:20','2024-12-09 06:58:01'),
(4,'Somai','somai@sttcempaga.com',NULL,'$2y$10$rTUyCJBTnfnoO.mA1JbiXO2EVEZvuptU4Q5h/jV0xnvzX8jJYSfNO','Panitia',NULL,'2024-12-11 07:02:07','2024-12-11 07:02:07'),
(5,'buda','buda@sttcempaga.com',NULL,'$2y$10$l5kQTMoqrvZSVfRpNidboOY45UeLPrwPNd2ny7k/1ZLx/QISITmVq','Pengurus',NULL,'2024-12-13 02:51:07','2024-12-13 02:51:07'),
(6,'kian dewi','uidwhuwhda@gmail.com',NULL,'$2y$10$G.DbjD/.tmwPctXUNWhRH.PBO9lOZBrSIVBueNb4y32daNtX.ux6K','Panitia',NULL,'2025-01-11 04:07:18','2025-01-11 04:07:18');
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

-- Dump completed on 2025-01-15  2:55:38
