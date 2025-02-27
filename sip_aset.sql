/*
SQLyog Ultimate v13.1.1 (64 bit)
MySQL - 10.4.13-MariaDB-log : Database - sip_aset
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*Table structure for table `aset_tetap` */

DROP TABLE IF EXISTS `aset_tetap`;

CREATE TABLE `aset_tetap` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_kategori_aset` bigint(20) DEFAULT NULL,
  `id_jenis_barang` bigint(20) DEFAULT NULL,
  `nama_barang` varchar(255) DEFAULT NULL,
  `kode` varchar(255) DEFAULT NULL,
  `register` varchar(255) DEFAULT NULL,
  `asal_usul` varchar(255) DEFAULT NULL,
  `harga_beli` bigint(20) DEFAULT NULL,
  `harga` bigint(20) DEFAULT NULL,
  `ket` text DEFAULT NULL,
  `status` int(1) DEFAULT 1,
  `tanggal_perolehan` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_kategori_aset` (`id_kategori_aset`),
  KEY `id_jenis_barang` (`id_jenis_barang`),
  CONSTRAINT `aset_tetap_ibfk_1` FOREIGN KEY (`id_kategori_aset`) REFERENCES `kategori_aset` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `aset_tetap_ibfk_2` FOREIGN KEY (`id_jenis_barang`) REFERENCES `jenis_barang` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=latin1;

/*Data for the table `aset_tetap` */

insert  into `aset_tetap`(`id`,`id_kategori_aset`,`id_jenis_barang`,`nama_barang`,`kode`,`register`,`asal_usul`,`harga_beli`,`harga`,`ket`,`status`,`tanggal_perolehan`,`created_at`,`updated_at`) values 
(7,2,5,'motor updatre','dasds','dasd','Pembelian',NULL,7500000,'dasdsa',0,'2024-12-09','2024-12-15 15:20:54','2024-12-15 17:23:31'),
(9,3,5,'nama barang  updatre','kode','register','Inventaris',NULL,75000000,'keterangan',0,'1890-06-20','2024-12-15 16:25:41','2024-12-15 17:23:34'),
(10,4,5,'jalan  updatre','kode jalan','register jalan','Donasi',NULL,90000000,'dasdas',0,'1995-02-05','2024-12-15 16:27:30','2024-12-15 17:23:38'),
(11,5,5,'lainnya barang  updatre','kode lain','register lain','Pembelian',NULL,65000000,'dasdsadas',0,'1990-12-04','2024-12-15 16:29:37','2024-12-15 17:23:41'),
(12,1,5,'Tanah Bangunan Tempat Kerja','01.10.04','0001','Hibah',100000000,198667590,'Kondisi Baik/Dokumen Belum Ada',1,'1970-10-15','2024-12-18 14:53:57','2025-02-19 18:39:16'),
(13,2,8,'Kendaraan Dinas','02.01.05','0001','Pembelian',NULL,13500000,'Rusak Ringan',1,'2002-06-15','2024-12-18 15:17:39','2024-12-18 15:17:39'),
(14,1,5,'Tanah Kantor Walijorong Paraman','01.10.04','0002','Hibah',NULL,7350000,'Belum Dibangun',1,'1970-10-10','2024-12-18 15:34:55','2024-12-18 15:34:55'),
(15,1,5,'Tanah Kantor Walijorong Kampung Tabu','01.10.04','0003','Hibah',NULL,50000000,'Rusak Ringan',1,'1970-10-10','2024-12-18 15:37:34','2024-12-18 15:37:34'),
(16,1,5,'Tanah Kantor Walijorong Sipinang','01.10.04','0004','Hibah',NULL,50000000,'Rusak Ringan',1,'2008-06-13','2024-12-18 15:40:26','2024-12-18 15:40:26'),
(17,2,9,'Komputer LG','02.12.01','0001','Pembelian',NULL,4500000,'Kurang Baik',1,'2007-07-10','2024-12-18 15:46:59','2024-12-18 15:46:59'),
(18,2,9,'Komputer Beno','02.12.01','0002','Pembelian',NULL,4700000,'Kurang Baik',1,'2008-06-15','2024-12-18 15:48:35','2024-12-18 15:48:35'),
(19,2,8,'Kendaraan Dinas','02.01.05','0001','Pembelian',NULL,17300000,'Kondisi Baik',1,'2015-08-14','2024-12-18 15:53:07','2024-12-18 15:53:07'),
(20,3,10,'Bangunan Kantor Walinagari Sipinang','01.10.04','0001','Inventaris',NULL,204670990,'Kondisi Baik',1,'2019-08-12','2024-12-18 16:03:30','2024-12-18 16:03:30'),
(21,3,10,'Bangunan Kantor Walijorong Kampung Tabu','01.10.04','0002','Inventaris',NULL,50000000,'Kurang Baik',1,'2015-07-09','2024-12-18 16:19:26','2024-12-18 16:19:26'),
(22,3,10,'Kantor Walijorong Sipinang','01.10.04','0003','Inventaris',NULL,65000000,'Kondisi Baik',1,'2013-08-10','2024-12-18 16:21:56','2024-12-18 16:21:56'),
(23,3,10,'Pos Ronda','01.10.04','0001','Inventaris',NULL,22128675,'Kondisi Baik',1,'2019-10-11','2024-12-18 16:24:35','2024-12-18 16:24:35'),
(24,4,12,'Jalan Nagari','04.01.01','0001','Inventaris',NULL,754713716,'Kondisi Baik',1,'2015-09-21','2024-12-18 16:29:34','2024-12-18 16:29:34'),
(25,4,12,'Jalan Nagari','04.01.01','0002','Inventaris',NULL,353585516,'Kondisi Rusak Ringan',1,'2015-09-10','2024-12-18 16:31:13','2024-12-18 16:31:13'),
(26,4,12,'Jalan Nagari','04.01.01','0003','Inventaris',NULL,905229085,'Kondisi Rusak Ringan',1,'2015-09-21','2024-12-18 16:33:28','2024-12-18 16:33:28'),
(27,4,12,'Irigasi','04.03.01','0001','Inventaris',NULL,383613502,'Kondisi Rusak Ringan',1,'2015-03-01','2024-12-18 16:37:05','2024-12-18 16:37:05'),
(28,5,11,'Buku Perpustakaan','05.01.01','0001','Hibah',NULL,23900,'Kondisi Baik',1,'2013-05-15','2024-12-18 16:40:13','2024-12-18 16:42:19'),
(29,5,11,'Buku Perpustakaan','05.01.01','0002','Hibah',NULL,23000,'Kondisi Baik',1,'2013-05-15','2024-12-18 16:42:06','2024-12-18 16:42:06'),
(30,5,11,'Buku Perpustakaan','05.01.01','0003','Hibah',NULL,23000,'Kondisi Baik',1,'2012-10-20','2024-12-18 16:44:31','2024-12-18 16:44:31'),
(31,5,11,'Buku Perpustakaan','05.01.01','0004','Hibah',NULL,28500,'Kondisi Baik',1,'2011-07-18','2024-12-18 16:46:08','2024-12-18 16:46:08'),
(32,5,11,'Buku Perpustakaan','05.01.01','0005','Hibah',NULL,20200,'Kondisi Baik',1,'2011-07-17','2024-12-18 16:47:35','2024-12-18 16:47:35'),
(33,5,11,'Buku Perpustakaan','05.01.01','0006','Hibah',NULL,16100,'Kondisi Baik',1,'2012-10-20','2024-12-18 16:49:43','2024-12-18 16:49:43'),
(34,5,11,'Buku Perpustakaan','05.01.01','0007','Hibah',NULL,13800,'Kondisi Baik',1,'2013-05-15','2024-12-18 16:52:49','2024-12-18 16:52:49'),
(35,1,5,'Tanah Kantor Walinagari Sipinang','01.10.04','0004','Hibah',NULL,10000000,'Kondisi Baik',1,'1990-01-01','2025-02-15 01:42:23','2025-02-15 01:42:23');

/*Table structure for table `aset_tidak_tetap` */

DROP TABLE IF EXISTS `aset_tidak_tetap`;

CREATE TABLE `aset_tidak_tetap` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_jenis_barang` bigint(20) DEFAULT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `harga` bigint(20) DEFAULT NULL,
  `asal_perolehan` varchar(255) DEFAULT NULL,
  `jumlah_awal` int(10) DEFAULT NULL,
  `jumlah_masuk` int(10) DEFAULT NULL,
  `jumlah_keluar` int(10) DEFAULT NULL,
  `sisa` int(10) DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `tgl_pakai` date DEFAULT NULL,
  `tgl_beli` date DEFAULT NULL,
  `tgl_perolehan_aset` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_jenis_barang` (`id_jenis_barang`),
  CONSTRAINT `aset_tidak_tetap_ibfk_1` FOREIGN KEY (`id_jenis_barang`) REFERENCES `jenis_barang` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `aset_tidak_tetap` */

insert  into `aset_tidak_tetap`(`id`,`id_jenis_barang`,`nama`,`harga`,`asal_perolehan`,`jumlah_awal`,`jumlah_masuk`,`jumlah_keluar`,`sisa`,`keterangan`,`tgl_pakai`,`tgl_beli`,`tgl_perolehan_aset`,`created_at`,`updated_at`) values 
(2,6,'Kertas HVS',68000,'Pembelian',30,30,20,10,'Kertas HVS A4','2024-03-24','2024-03-23','2024-03-23','2024-12-18 16:58:24','2025-02-18 10:21:54'),
(3,6,'Pena',48000,'Pembelian',15,15,28,-13,'Pena Bold Liner','2024-03-25','2024-03-23','2024-03-23','2024-12-18 17:00:40','2025-02-15 02:00:32'),
(4,6,'Tinta Printer',93000,'Pembelian',40,40,24,16,'Tinta Printer Epson','2024-03-24','2024-03-23','2024-03-23','2024-12-18 17:03:03','2024-12-18 17:03:18'),
(5,6,'Penggaris',10000,'Pembelian',10,10,0,10,'Penggaris','2025-02-15','2025-02-17','2025-02-17','2025-02-15 02:24:20','2025-02-15 02:24:20');

/*Table structure for table `detail_aset_tidak_tetap` */

DROP TABLE IF EXISTS `detail_aset_tidak_tetap`;

CREATE TABLE `detail_aset_tidak_tetap` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_att` bigint(20) DEFAULT NULL,
  `awal` int(10) DEFAULT NULL,
  `masuk` int(10) DEFAULT NULL,
  `keluar` int(10) DEFAULT NULL,
  `sisa` int(10) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_att` (`id_att`),
  CONSTRAINT `detail_aset_tidak_tetap_ibfk_1` FOREIGN KEY (`id_att`) REFERENCES `aset_tidak_tetap` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

/*Data for the table `detail_aset_tidak_tetap` */

insert  into `detail_aset_tidak_tetap`(`id`,`id_att`,`awal`,`masuk`,`keluar`,`sisa`,`created_at`,`updated_at`) values 
(10,2,30,0,0,30,'2024-12-18 16:58:24','2024-12-18 16:58:24'),
(11,2,30,0,15,15,'2024-12-18 16:58:46','2024-12-18 16:58:46'),
(12,3,15,0,0,15,'2024-12-18 17:00:40','2024-12-18 17:00:40'),
(13,3,15,0,8,7,'2024-12-18 17:00:56','2024-12-18 17:00:56'),
(14,4,40,0,0,40,'2024-12-18 17:03:03','2024-12-18 17:03:03'),
(15,4,40,0,24,16,'2024-12-18 17:03:18','2024-12-18 17:03:18'),
(16,3,7,0,20,-13,'2025-02-15 02:00:32','2025-02-15 02:00:32'),
(17,5,10,0,0,10,'2025-02-15 02:24:20','2025-02-15 02:24:20'),
(18,2,15,0,2,13,'2025-02-18 09:58:41','2025-02-18 09:58:41'),
(19,2,13,0,2,11,'2025-02-18 10:21:14','2025-02-18 10:21:14'),
(20,2,11,0,1,10,'2025-02-18 10:21:54','2025-02-18 10:21:54');

/*Table structure for table `failed_jobs` */

DROP TABLE IF EXISTS `failed_jobs`;

CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `failed_jobs` */

/*Table structure for table `jenis_barang` */

DROP TABLE IF EXISTS `jenis_barang`;

CREATE TABLE `jenis_barang` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

/*Data for the table `jenis_barang` */

insert  into `jenis_barang`(`id`,`name`,`created_at`,`updated_at`) values 
(5,'TANAH',NULL,'2024-12-18 14:39:18'),
(6,'ALAT KANTOR DAN RUMAH TANGGA','2024-12-18 14:39:45','2024-12-18 14:39:45'),
(7,'ALAT STUDIO KOMUNIKASI DAN PEMANCAR','2024-12-18 14:40:11','2024-12-18 14:40:11'),
(8,'ALAT ANGKUTAN','2024-12-18 14:41:24','2024-12-18 14:41:24'),
(9,'ALAT KOMPUTER','2024-12-18 14:41:43','2024-12-18 14:41:43'),
(10,'BANGUNAN GEDUNG','2024-12-18 14:42:03','2024-12-18 14:42:03'),
(11,'BAHAN PERPUSTAKAAN','2024-12-18 14:42:23','2024-12-18 14:42:23'),
(12,'JALAN, IRIGASI DAN JARINGAN','2024-12-18 14:42:41','2024-12-18 14:42:41'),
(13,'ALAT BESAR','2024-12-18 14:42:54','2024-12-18 14:42:54');

/*Table structure for table `kategori_aset` */

DROP TABLE IF EXISTS `kategori_aset`;

CREATE TABLE `kategori_aset` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `status` int(1) DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

/*Data for the table `kategori_aset` */

insert  into `kategori_aset`(`id`,`name`,`status`,`created_at`,`updated_at`) values 
(1,'KIB A. Tanah',1,'2024-12-07 05:43:58','2024-12-07 05:50:39'),
(2,'KIB B. PERALATAN DAN MESIN',1,'2024-12-07 12:55:55','2024-12-07 12:55:55'),
(3,'KIB C. GEDUNG DAN BANGUNAN',1,'2024-12-07 12:56:03','2024-12-07 12:56:03'),
(4,'KIB D. JALAN, IRIGASI DAN JARINGAN',1,'2024-12-07 12:56:14','2024-12-07 12:56:14'),
(5,'KIB E. ASET TETAP LAINNYA',1,'2024-12-07 12:56:22','2024-12-07 13:26:01'),
(6,'ASET TIDAK TETAP',0,'2024-12-07 12:56:33','2024-12-18 14:46:16');

/*Table structure for table `kib_a_tanah` */

DROP TABLE IF EXISTS `kib_a_tanah`;

CREATE TABLE `kib_a_tanah` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_at` bigint(20) DEFAULT NULL,
  `luas` varchar(255) DEFAULT NULL,
  `tahun_pengadaan` varchar(255) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `status_tanah` varchar(255) DEFAULT NULL,
  `sertifikat_tgl` date DEFAULT NULL,
  `sertifikat_no` varchar(255) DEFAULT NULL,
  `penggunaan` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_at` (`id_at`),
  CONSTRAINT `kib_a_tanah_ibfk_1` FOREIGN KEY (`id_at`) REFERENCES `aset_tetap` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

/*Data for the table `kib_a_tanah` */

insert  into `kib_a_tanah`(`id`,`id_at`,`luas`,`tahun_pengadaan`,`alamat`,`status_tanah`,`sertifikat_tgl`,`sertifikat_no`,`penggunaan`,`created_at`,`updated_at`) values 
(3,12,'150','1970','Jorong Kampung Tabu','Hak Pakai','1970-10-15','1','Kantor Walinagari','2024-12-18 14:53:57','2024-12-18 14:55:09'),
(4,14,'10','1970','Jorong Paraman','Hak Pakai','1970-10-10','2','Kantor Walijorong','2024-12-18 15:34:55','2024-12-18 15:34:55'),
(5,15,'64','1970','Jorong Kampung Tabu','Hak Pakai','1970-10-10','3','Kantor Walijorong','2024-12-18 15:37:34','2024-12-18 15:37:34'),
(6,16,'100','2008','Jorong Sipinang','Hak Pakai','2008-06-13','4','Kantor Walijorong','2024-12-18 15:40:26','2024-12-18 15:40:26'),
(7,35,'100','1990','Kampung Tabu Nagari Sipinang','Hak Pakai','1990-01-01','04','Kantor Walinagari','2025-02-15 01:42:23','2025-02-15 01:42:23');

/*Table structure for table `kib_b_peralatanmesin` */

DROP TABLE IF EXISTS `kib_b_peralatanmesin`;

CREATE TABLE `kib_b_peralatanmesin` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_at` bigint(20) DEFAULT NULL,
  `merk_type` varchar(255) DEFAULT NULL,
  `ukuran_cc` varchar(255) DEFAULT NULL,
  `bahan` varchar(255) DEFAULT NULL,
  `tahun_pengadaan` varchar(255) DEFAULT NULL,
  `no_pabrik` varchar(255) DEFAULT NULL,
  `no_rangka` varchar(255) DEFAULT NULL,
  `no_mesin` varchar(255) DEFAULT NULL,
  `no_polisi` varchar(255) DEFAULT NULL,
  `no_bpkb` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_at` (`id_at`),
  CONSTRAINT `kib_b_peralatanmesin_ibfk_1` FOREIGN KEY (`id_at`) REFERENCES `aset_tetap` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Data for the table `kib_b_peralatanmesin` */

insert  into `kib_b_peralatanmesin`(`id`,`id_at`,`merk_type`,`ukuran_cc`,`bahan`,`tahun_pengadaan`,`no_pabrik`,`no_rangka`,`no_mesin`,`no_polisi`,`no_bpkb`,`created_at`,`updated_at`) values 
(1,7,'honda','250','minyak','1998','pabrik','rangka','mesin','polisi','bpkb','2024-12-15 15:20:54','2024-12-15 15:20:54'),
(3,13,'Honda','125 CC','Besi Campuran','2002','MHIVF112FK215725','MH09BT112KA314956','JBIIE,1062144','BA 7591 BG','IHIJBIII83KO6214','2024-12-18 15:17:39','2024-12-18 15:17:39'),
(4,17,'LG','14 Inchi','Campuran','2007','50 SEMATISKud','-','-','-','-','2024-12-18 15:46:59','2024-12-18 15:53:56'),
(5,18,'Beno','20 Inchi','Campuran','2008','E900 Hd','-','-','-','-','2024-12-18 15:48:35','2024-12-18 15:53:36'),
(6,19,'Honda','125 CC','Campuran','2015','-','MH1JFV112FK224756','JV1E-1224405F','BA 3531 T','L-06621830','2024-12-18 15:53:07','2024-12-18 15:53:07');

/*Table structure for table `kib_c_gedungbangunan` */

DROP TABLE IF EXISTS `kib_c_gedungbangunan`;

CREATE TABLE `kib_c_gedungbangunan` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_at` bigint(20) DEFAULT NULL,
  `kondisi_bangunan` varchar(255) DEFAULT NULL,
  `bertingkat` varchar(255) DEFAULT NULL,
  `beton` varchar(255) DEFAULT NULL,
  `luas_lantai` varchar(255) DEFAULT NULL,
  `dok_tgl` date DEFAULT NULL,
  `dok_no` varchar(255) DEFAULT NULL,
  `luas` varchar(255) DEFAULT NULL,
  `status_tanah` varchar(255) DEFAULT NULL,
  `no_kode_tanah` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_at` (`id_at`),
  CONSTRAINT `kib_c_gedungbangunan_ibfk_1` FOREIGN KEY (`id_at`) REFERENCES `aset_tetap` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `kib_c_gedungbangunan` */

insert  into `kib_c_gedungbangunan`(`id`,`id_at`,`kondisi_bangunan`,`bertingkat`,`beton`,`luas_lantai`,`dok_tgl`,`dok_no`,`luas`,`status_tanah`,`no_kode_tanah`,`created_at`,`updated_at`) values 
(1,9,'kondisi','Bertingkat','Beton','lantai','1890-02-11','1890123dsa','luas','status tanah','nomor kode','2024-12-15 16:25:41','2024-12-15 16:25:41'),
(2,20,'Baik','Bertingkat','Beton','100M2','2019-08-12','1','150','Hak Pakai','01.10.04','2024-12-18 16:03:30','2024-12-18 16:04:29'),
(3,21,'Baik','Tidak Bertingkat','Beton','64M2','2015-07-09','2','64M2','Hak Pakai','01.10.04','2024-12-18 16:19:26','2024-12-18 16:19:26'),
(4,22,'Baik','Tidak Bertingkat','Beton','100M2','2013-08-10','3','100M2','Hak Milik','01.10.04','2024-12-18 16:21:56','2024-12-18 16:21:56'),
(5,23,'Baik','Tidak Bertingkat','Tidak Beton','6M2','2019-10-11','4','30M2','Hak Pakai','01.10.04','2024-12-18 16:24:35','2024-12-18 16:24:35');

/*Table structure for table `kib_d_jalanirigasi` */

DROP TABLE IF EXISTS `kib_d_jalanirigasi`;

CREATE TABLE `kib_d_jalanirigasi` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_at` bigint(20) DEFAULT NULL,
  `konstruksi` varchar(255) DEFAULT NULL,
  `panjang` varchar(255) DEFAULT NULL,
  `lebar` varchar(255) DEFAULT NULL,
  `luas` varchar(255) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `dok_tgl` date DEFAULT NULL,
  `dok_no` varchar(255) DEFAULT NULL,
  `status_tanah` varchar(255) DEFAULT NULL,
  `no_kode_tanah` varchar(255) DEFAULT NULL,
  `kondisi` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_at` (`id_at`),
  CONSTRAINT `kib_d_jalanirigasi_ibfk_1` FOREIGN KEY (`id_at`) REFERENCES `aset_tetap` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `kib_d_jalanirigasi` */

insert  into `kib_d_jalanirigasi`(`id`,`id_at`,`konstruksi`,`panjang`,`lebar`,`luas`,`alamat`,`dok_tgl`,`dok_no`,`status_tanah`,`no_kode_tanah`,`kondisi`,`created_at`,`updated_at`) values 
(1,10,'konstruksi jalan','panjang jalan','lebar jalan','luas jalan','alamat jalan','1995-02-05','05021995','status tanah','no kode tanah','kondisi jalan','2024-12-15 16:27:30','2024-12-15 16:27:30'),
(2,24,'-','4Km','3M','12000M2','Jorong Kampung Tabu, Nagari Sipinang','2015-09-21','-','Hak Pakai','04.01.01','Baik','2024-12-18 16:29:34','2024-12-18 16:29:34'),
(3,25,'-','4Km','3M','12000M2','Jorong Sipinang, Nagari Sipinang','2015-09-21','-','Hak Pakai','04.01.01','Rusak Ringan','2024-12-18 16:31:13','2024-12-18 16:31:13'),
(4,26,'-','6Km','3M','18000M2','Jorong Paraman, Nagari Sipinang','2015-09-21','-','Hak Pakai','04.01.01','Rusak Ringan','2024-12-18 16:33:28','2024-12-18 16:33:28'),
(5,27,'-','250M','-','-','Jorong Kampung Tabu, Nagari Sipinang','2015-03-01','-','Hak Pakai','04.01.04','Rusak Ringan','2024-12-18 16:37:06','2024-12-18 16:37:06');

/*Table structure for table `kib_e_asetlainnya` */

DROP TABLE IF EXISTS `kib_e_asetlainnya`;

CREATE TABLE `kib_e_asetlainnya` (
  `id` bigint(20) DEFAULT NULL,
  `id_at` bigint(20) DEFAULT NULL,
  `judul` varchar(255) DEFAULT NULL,
  `pencipta` varchar(255) DEFAULT NULL,
  `spesifikasi` varchar(255) DEFAULT NULL,
  `asal_daerah` varchar(255) DEFAULT NULL,
  `bahan` varchar(255) DEFAULT NULL,
  `jenis` varchar(255) DEFAULT NULL,
  `ukuran` varchar(255) DEFAULT NULL,
  `jumlah` int(10) DEFAULT NULL,
  `tahun` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  KEY `id_at` (`id_at`),
  CONSTRAINT `kib_e_asetlainnya_ibfk_1` FOREIGN KEY (`id_at`) REFERENCES `aset_tetap` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `kib_e_asetlainnya` */

insert  into `kib_e_asetlainnya`(`id`,`id_at`,`judul`,`pencipta`,`spesifikasi`,`asal_daerah`,`bahan`,`jenis`,`ukuran`,`jumlah`,`tahun`,`created_at`,`updated_at`) values 
(NULL,11,'judul lain','pencipta lain','spek lain','asal lain','bahan lain','jenis lain','ukuran lain',200,'2010','2024-12-15 16:29:37','2024-12-18 16:50:10'),
(NULL,28,'Usaha warnet yang menjanjikan','T.Yasima','Kertas','-','Kertas','Buku','-',2,'2010','2024-12-18 16:40:13','2024-12-18 16:50:10'),
(NULL,29,'Anak Muslim Mahir Membaca','Ummu Aisah','Kertas','-','Kertas','Buku','-',2,'2010','2024-12-18 16:42:06','2024-12-18 16:50:10'),
(NULL,30,'Seni Mendesain Hidup','Muhamad Noor','Kertas','-','Kertas','Buku','-',2,'2010','2024-12-18 16:44:31','2024-12-18 16:50:10'),
(NULL,31,'Jurus Mewujudkan Mimpimu','An Ubaedy','Kertas','-','Kertas','Buku','-',2,'2010','2024-12-18 16:46:08','2024-12-18 16:50:10'),
(NULL,32,'Kecerdasan Optimal','Indragiri','Kertas','-','Kertas','Buku','-',2,'2010','2024-12-18 16:47:35','2024-12-18 16:50:10'),
(NULL,33,'Kisah optimalisasi anak berkebutuhan khusus disleksia','Andi Rismawan','Kertas','-','Kertas','Buku','-',2,'2010','2024-12-18 16:49:43','2024-12-18 16:50:10'),
(NULL,34,'Kisah motivasi anak berkebutuhan khusus Autis','Leni Susanti','Kertas','-','Kertas','Buku','-',2,'2013','2024-12-18 16:52:49','2024-12-18 16:52:49');

/*Table structure for table `migrations` */

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `migrations` */

insert  into `migrations`(`id`,`migration`,`batch`) values 
(1,'2014_10_12_000000_create_users_table',1),
(2,'2014_10_12_100000_create_password_resets_table',1),
(3,'2019_08_19_000000_create_failed_jobs_table',1),
(4,'2019_12_14_000001_create_personal_access_tokens_table',1);

/*Table structure for table `password_resets` */

DROP TABLE IF EXISTS `password_resets`;

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `password_resets` */

/*Table structure for table `personal_access_tokens` */

DROP TABLE IF EXISTS `personal_access_tokens`;

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `personal_access_tokens` */

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(1) DEFAULT 1,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `users` */

insert  into `users`(`id`,`name`,`username`,`email`,`email_verified_at`,`password`,`remember_token`,`created_at`,`updated_at`,`role`,`status`) values 
(1,'admin','admin','admin@gmail.com',NULL,'$2y$10$GkMt9T3CBBYzuaFrhee03OzM8SgGvLtjjxy6SdhniWsZBVIF79sFi',NULL,NULL,'2025-02-19 14:01:05','admin',1),
(4,'pegawai','pegawai','pegawai@gmail.com',NULL,'$2y$10$bSiI3cBGiq6s9uLCMsLVi.4dJUu0IOIhqY/0mZqdSIB8laD0HewAa',NULL,'2024-12-07 04:56:43','2024-12-07 05:02:37','pegawai',1),
(5,'Wali Nagari','walinagari','walinagari@gmail.com',NULL,'$2y$10$iYi8pRYzN8ZTVA5.6.F7AOYb4qe7lfriF8vYwNvl060G041Hk9QqC',NULL,'2024-12-07 05:20:52','2025-02-19 14:02:12','walinagari',1);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
