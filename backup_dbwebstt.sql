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
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `absensis`
--

LOCK TABLES `absensis` WRITE;
/*!40000 ALTER TABLE `absensis` DISABLE KEYS */;
INSERT INTO `absensis` VALUES
(1,'1','6','Tidak Hadir',10000,'2025-01-17 03:00:33','2025-01-17 03:23:29','Lunas','2025-01-17'),
(2,'1','7','Hadir',0,'2025-01-17 03:00:33','2025-01-17 03:00:33','-',NULL),
(3,'2','6','Tidak Hadir',10000,'2025-01-17 04:14:27','2025-01-19 08:52:35','Lunas','2025-01-19'),
(4,'2','7','Hadir',0,'2025-01-17 04:14:27','2025-01-17 04:14:27','-',NULL),
(5,'3','7','Hadir',0,'2025-01-19 11:44:19','2025-01-19 11:44:19','-',NULL),
(6,'3','8','Tidak Hadir',10000,'2025-01-19 11:44:19','2025-01-19 11:46:19','Lunas','2025-01-19'),
(7,'4','7','Hadir',0,'2025-01-20 04:07:42','2025-01-20 04:07:42','-',NULL),
(8,'4','13','Tidak Hadir',90000,'2025-01-20 04:07:42','2025-01-20 08:41:02','Lunas','2025-01-20'),
(9,'5','7','Hadir',0,'2025-01-20 08:45:35','2025-01-20 08:45:35','-',NULL),
(10,'5','13','Tidak Hadir',10000,'2025-01-20 08:45:35','2025-01-20 08:45:35','Belum Bayar',NULL),
(11,'6','7','Hadir',0,'2025-01-20 08:46:21','2025-01-20 08:46:21','-',NULL),
(12,'6','13','Tidak Hadir',10000,'2025-01-20 08:46:21','2025-01-20 08:46:21','Belum Bayar',NULL),
(13,'7','7','Hadir',0,'2025-01-20 08:46:43','2025-01-20 08:46:43','-',NULL),
(14,'7','13','Tidak Hadir',10000,'2025-01-20 08:46:43','2025-01-20 08:46:43','Belum Bayar',NULL),
(15,'8','7','Hadir',0,'2025-01-20 11:00:59','2025-01-20 11:00:59','-',NULL),
(16,'8','13','Tidak Hadir',90000,'2025-01-20 11:00:59','2025-01-20 11:00:59','Belum Bayar',NULL),
(17,'8','14','Tidak Hadir',90000,'2025-01-20 11:00:59','2025-01-20 11:00:59','Belum Bayar',NULL),
(18,'8','15','Tidak Hadir',90000,'2025-01-20 11:00:59','2025-01-20 11:00:59','Belum Bayar',NULL),
(19,'8','16','Tidak Hadir',90000,'2025-01-20 11:00:59','2025-01-20 11:00:59','Belum Bayar',NULL);
/*!40000 ALTER TABLE `absensis` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `alumni`
--

DROP TABLE IF EXISTS `alumni`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `alumni` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `idanggota` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `tgllahir` date NOT NULL,
  `tempek` varchar(255) NOT NULL,
  `alasan` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `alumni`
--

LOCK TABLES `alumni` WRITE;
/*!40000 ALTER TABLE `alumni` DISABLE KEYS */;
INSERT INTO `alumni` VALUES
(3,9,'I MADE PERMANA PUTRA','2000-05-17','Kangin','DO','2025-01-19 11:52:46','2025-01-19 11:52:46'),
(4,10,'SUTASOMA','2000-06-13','Kauh','Pergi','2025-01-19 11:54:39','2025-01-19 11:54:39'),
(5,11,'KETUT','2000-10-17','Kauh','akdjbfk','2025-01-19 13:52:41','2025-01-19 13:52:41'),
(6,12,'I MADE PERMANA MANI','2000-10-18','Kauh','menikah','2025-01-19 13:58:54','2025-01-19 13:58:54');
/*!40000 ALTER TABLE `alumni` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `anggota`
--

LOCK TABLES `anggota` WRITE;
/*!40000 ALTER TABLE `anggota` DISABLE KEYS */;
INSERT INTO `anggota` VALUES
(7,'NYOMAN','2000-02-08',24,'Mahasiswa','Kangin','Nekel','2025-01-13 12:44:56','2025-01-13 12:44:56'),
(13,'I MADE PERMANA PUTRA','2001-06-07',23,'Mahasiswa','Kangin','Aktif','2025-01-20 04:07:17','2025-01-20 04:07:17'),
(14,'Ngurah Yami','2003-06-09',21,'Mahasiswa','kangin','aktif','2025-01-20 10:49:52','2025-01-20 10:49:52'),
(15,'sulisman','2000-09-21',24,'Mahasiswa','kangin','aktif','2025-01-20 10:49:59','2025-01-20 10:49:59'),
(16,'I WAYAN YUDI','2000-02-09',24,'Bekerja','Kangin','aktif','2025-01-20 10:51:55','2025-01-20 10:51:55'),
(17,'I GUSTI MADE DEWASTIKA','1999-06-19',25,'Bekerja','Kauh','aktif','2025-01-20 12:34:44','2025-01-20 12:34:44');
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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bayariuran`
--

LOCK TABLES `bayariuran` WRITE;
/*!40000 ALTER TABLE `bayariuran` DISABLE KEYS */;
INSERT INTO `bayariuran` VALUES
(1,'6','1',10000,'2025-01-19 09:15:22','Terbayar','2025-01-18 04:25:17','2025-01-19 09:15:22'),
(2,'7','1',0,NULL,'Belum Bayar','2025-01-18 04:25:17','2025-01-19 07:22:45'),
(5,'7','3',0,NULL,'Belum Bayar','2025-01-19 11:44:33','2025-01-19 11:44:33'),
(6,'8','3',90000,'2025-01-19 11:46:57','Terbayar','2025-01-19 11:44:33','2025-01-19 11:46:57'),
(7,'7','4',0,NULL,'Belum Bayar','2025-01-20 04:08:12','2025-01-20 06:16:07'),
(8,'13','4',3243,'2025-01-20 08:43:21','Terbayar','2025-01-20 04:08:12','2025-01-20 08:43:21');
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
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `events`
--

LOCK TABLES `events` WRITE;
/*!40000 ALTER TABLE `events` DISABLE KEYS */;
INSERT INTO `events` VALUES
(31,NULL,'KEG0001','Masuk','2025-01-21','Kas STT','',3000000,3000000,'superadmin','2025-01-21 08:12:25','2025-01-21 08:12:25');
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
(1,'Ayam',10000,20000,2,1,1,10000,'Belum Lengkap','2025-01-18 04:25:17','2025-01-19 09:15:22'),
(3,'dfffd',90000,180000,2,1,1,90000,'Belum Lengkap','2025-01-19 11:44:33','2025-01-19 11:46:57'),
(4,'fgfg',3243,6486,2,1,1,3243,'Belum Lengkap','2025-01-20 04:08:12','2025-01-20 08:43:21');
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
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
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
(6,'KIN0005','Masuk','2025-01-13','Pembayaran Penekelan Atas Nama NYOMAN','-',0,100000,'superadmin','2025-01-13 12:45:25','2025-01-13 12:45:25'),
(7,'KIN0006','Masuk','2025-01-16','Membeli Baju Sebanyak : 2 Anggota','-',0,20000,'superadmin','2025-01-16 02:22:07','2025-01-16 02:22:07'),
(8,'KIN0007','Masuk','2025-01-17','Pembayaran Denda MADE','-',0,10000,'superadmin','2025-01-17 03:23:29','2025-01-17 03:23:29'),
(9,'KIN0008','Masuk','2025-01-17','Pembayaran Penekelan Atas Nama NYOMAN','-',0,50000,'superadmin','2025-01-17 04:16:28','2025-01-17 04:16:28'),
(10,'KIN0009','Masuk','2025-01-19','Pembayaran Denda MADE','-',0,10000,'superadmin','2025-01-19 08:52:35','2025-01-19 08:52:35'),
(11,'KIN0010','Masuk','2025-01-19','Pembayaran Denda KOMANG','-',0,10000,'superadmin','2025-01-19 11:46:19','2025-01-19 11:46:19'),
(12,'KIN0011','Masuk','2025-01-20','Pembayaran Denda I MADE PERMANA PUTRA','-',0,90000,'superadmin','2025-01-20 08:41:02','2025-01-20 08:41:02'),
(13,'KIN0012','Masuk','2025-01-21','Saldo Kegiatan : Ngae Ogoh ogoh','',0,3000000,'superadmin','2025-01-21 08:12:37','2025-01-21 08:12:37');
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
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kegiatan`
--

LOCK TABLES `kegiatan` WRITE;
/*!40000 ALTER TABLE `kegiatan` DISABLE KEYS */;
INSERT INTO `kegiatan` VALUES
(7,'KEG0001','1970-01-01','Ngae Ogoh ogoh','Ds',3000000,0,3000000,'superadmin','2025-01-21 08:11:42','2025-01-21 08:12:37','[\"2\",\"3\"]','Sudah','I Made Sudiatmika','Putri Lestari','I Dewa Made Mandeg');
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
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
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
(33,'2025_01_06_150650_create_penekelans_table',21),
(34,'2025_01_16_025045_create_out_stts_table',22),
(35,'2025_01_19_104544_create_alumnis_table',23),
(36,'2025_01_19_113536_add_statusanggota_to_out_stt_table',24),
(37,'2025_01_20_094619_create_pendataans_table',25);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `out_stt`
--

DROP TABLE IF EXISTS `out_stt`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `out_stt` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `idanggota` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `tgllahir` date NOT NULL,
  `pekerjaan` varchar(255) NOT NULL,
  `tempek` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `alasankeluar` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `statusanggota` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `out_stt`
--

LOCK TABLES `out_stt` WRITE;
/*!40000 ALTER TABLE `out_stt` DISABLE KEYS */;
INSERT INTO `out_stt` VALUES
(1,'6','MADE','1991-06-18','Mahasiswa','Kangin','Aktif','Menikah','2025-01-16 06:13:57','2025-01-16 06:13:57','Alumni'),
(2,'8','KOMANG','2000-06-06','Mahasiswa','Kauh','Aktif','Menikah','2025-01-19 11:44:59','2025-01-19 11:44:59','Alumni'),
(10,'7','NYOMAN','2000-02-08','Mahasiswa','Kangin','Nekel','ds','2025-01-19 15:55:32','2025-01-19 15:55:32',NULL);
/*!40000 ALTER TABLE `out_stt` ENABLE KEYS */;
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
-- Table structure for table `pendataan`
--

DROP TABLE IF EXISTS `pendataan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pendataan` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) NOT NULL,
  `tglLahir` date NOT NULL,
  `umur` int(11) NOT NULL,
  `pekerjaan` varchar(255) NOT NULL,
  `tempek` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pendataan`
--

LOCK TABLES `pendataan` WRITE;
/*!40000 ALTER TABLE `pendataan` DISABLE KEYS */;
INSERT INTO `pendataan` VALUES
(7,'Gde Gung Prabawa','1995-09-22',29,'Bekerja','kangin','aktif','2025-01-21 10:39:32','2025-01-21 10:39:32');
/*!40000 ALTER TABLE `pendataan` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `penekelan`
--

LOCK TABLES `penekelan` WRITE;
/*!40000 ALTER TABLE `penekelan` DISABLE KEYS */;
INSERT INTO `penekelan` VALUES
(1,'7','50000','2025-01-17','2025-01-17 04:16:28','2025-01-17 04:16:28');
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
(1,1,'2024-12-18 03:00:52','2025-01-21 08:57:47');
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
(2,'SIDARMA','Sistem Informasi STT Sila Dharma','logos/0kooSIT7eGO4j8Ml09zAub7p26hS27yUvelLCBMR.webp','\"Sagilik Saguluk, Salunglung Sabayantaka, Paras Paros Sarpanaya, Saling Asah Asih Asuh\"','2024 Cempaga-Bangli','2024-12-26 15:11:14','2025-01-20 13:00:17','STT. SILA DHARMA','logos/nfaaifz8pgvG2Ak7athsjQfGOh83PgIR6ic1k5nZ.webp');
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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tabel_kegiatans`
--

LOCK TABLES `tabel_kegiatans` WRITE;
/*!40000 ALTER TABLE `tabel_kegiatans` DISABLE KEYS */;
INSERT INTO `tabel_kegiatans` VALUES
(1,'2025-01-17','d','Ngayah','10000',10000,2,1,1,'Sad','superadmin','2025-01-17 03:00:33','2025-01-17 03:00:33'),
(2,'2025-01-17','d','Tedun','10000',10000,2,1,1,'S','superadmin','2025-01-17 04:14:27','2025-01-17 04:14:27'),
(3,'2025-01-19','dsfds','Tedun','10000',10000,2,1,1,'Sfdsf','superadmin','2025-01-19 11:44:19','2025-01-19 11:44:19'),
(4,'2025-01-20','asdas','Ngayah','90000',90000,2,1,1,'Asd','superadmin','2025-01-20 04:07:42','2025-01-20 04:07:42'),
(5,'2025-01-20','Meju','Tedun','10000',10000,2,1,1,'D','superadmin','2025-01-20 08:45:35','2025-01-20 08:45:35'),
(6,'2025-01-07','dd','Tedun','10000',10000,2,1,1,'Df','superadmin','2025-01-20 08:46:21','2025-01-20 08:46:21'),
(7,'2025-01-06','sds','Acara Lain','10000',10000,2,1,1,'Dd','superadmin','2025-01-20 08:46:43','2025-01-20 08:46:43'),
(8,'2025-01-20','dsds','Tedun','90000',360000,5,1,4,'Sdfs','superadmin','2025-01-20 11:00:59','2025-01-20 11:00:59');
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

-- Dump completed on 2025-01-21 11:26:40
