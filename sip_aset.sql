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
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

/*Data for the table `aset_tetap` */

insert  into `aset_tetap`(`id`,`id_kategori_aset`,`id_jenis_barang`,`nama_barang`,`kode`,`register`,`asal_usul`,`harga`,`ket`,`status`,`tanggal_perolehan`,`created_at`,`updated_at`) values 
(6,1,5,'rumah barang','132','dasd123','Pembelian',600000000,'awas',0,'1998-02-11','2024-12-15 15:14:30','2024-12-15 17:23:26'),
(7,2,5,'motor updatre','dasds','dasd','Pembelian',7500000,'dasdsa',0,'2024-12-09','2024-12-15 15:20:54','2024-12-15 17:23:31'),
(9,3,5,'nama barang  updatre','kode','register','Inventaris',75000000,'keterangan',0,'1890-06-20','2024-12-15 16:25:41','2024-12-15 17:23:34'),
(10,4,5,'jalan  updatre','kode jalan','register jalan','Donasi',90000000,'dasdas',0,'1995-02-05','2024-12-15 16:27:30','2024-12-15 17:23:38'),
(11,5,5,'lainnya barang  updatre','kode lain','register lain','Pembelian',65000000,'dasdsadas',0,'1990-12-04','2024-12-15 16:29:37','2024-12-15 17:23:41');

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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `aset_tidak_tetap` */

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
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

/*Data for the table `detail_aset_tidak_tetap` */

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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `jenis_barang` */

insert  into `jenis_barang`(`id`,`name`,`created_at`,`updated_at`) values 
(5,'tanah',NULL,NULL);

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
(6,'ASET TIDAK TETAP',0,'2024-12-07 12:56:33','2024-12-13 12:30:22');

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `kib_a_tanah` */

insert  into `kib_a_tanah`(`id`,`id_at`,`luas`,`tahun_pengadaan`,`alamat`,`status_tanah`,`sertifikat_tgl`,`sertifikat_no`,`penggunaan`,`created_at`,`updated_at`) values 
(2,6,'das','1990','das','das','2024-12-01','das','das','2024-12-15 15:14:30','2024-12-15 15:14:30');

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `kib_b_peralatanmesin` */

insert  into `kib_b_peralatanmesin`(`id`,`id_at`,`merk_type`,`ukuran_cc`,`bahan`,`tahun_pengadaan`,`no_pabrik`,`no_rangka`,`no_mesin`,`no_polisi`,`no_bpkb`,`created_at`,`updated_at`) values 
(1,7,'honda','250','minyak','1998','pabrik','rangka','mesin','polisi','bpkb','2024-12-15 15:20:54','2024-12-15 15:20:54');

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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `kib_c_gedungbangunan` */

insert  into `kib_c_gedungbangunan`(`id`,`id_at`,`kondisi_bangunan`,`bertingkat`,`beton`,`luas_lantai`,`dok_tgl`,`dok_no`,`luas`,`status_tanah`,`no_kode_tanah`,`created_at`,`updated_at`) values 
(1,9,'kondisi','Bertingkat','Beton','lantai','1890-02-11','1890123dsa','luas','status tanah','nomor kode','2024-12-15 16:25:41','2024-12-15 16:25:41');

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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `kib_d_jalanirigasi` */

insert  into `kib_d_jalanirigasi`(`id`,`id_at`,`konstruksi`,`panjang`,`lebar`,`luas`,`alamat`,`dok_tgl`,`dok_no`,`status_tanah`,`no_kode_tanah`,`kondisi`,`created_at`,`updated_at`) values 
(1,10,'konstruksi jalan','panjang jalan','lebar jalan','luas jalan','alamat jalan','1995-02-05','05021995','status tanah','no kode tanah','kondisi jalan','2024-12-15 16:27:30','2024-12-15 16:27:30');

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
(NULL,11,'judul lain','pencipta lain','spek lain','asal lain','bahan lain','jenis lain','ukuran lain',200,'1990','2024-12-15 16:29:37','2024-12-15 17:18:20');

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
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `users` */

insert  into `users`(`id`,`name`,`username`,`email`,`email_verified_at`,`password`,`remember_token`,`created_at`,`updated_at`,`role`) values 
(1,'admin','admin','admin@gmail.com',NULL,'$2y$10$GkMt9T3CBBYzuaFrhee03OzM8SgGvLtjjxy6SdhniWsZBVIF79sFi',NULL,NULL,'2024-12-07 05:02:52','admin'),
(4,'pegawai','pegawai','pegawai@gmail.com',NULL,'$2y$10$bSiI3cBGiq6s9uLCMsLVi.4dJUu0IOIhqY/0mZqdSIB8laD0HewAa',NULL,'2024-12-07 04:56:43','2024-12-07 05:02:37','pegawai'),
(5,'Wali Nagari','walinagari','walinagari@gmail.com',NULL,'$2y$10$iYi8pRYzN8ZTVA5.6.F7AOYb4qe7lfriF8vYwNvl060G041Hk9QqC',NULL,'2024-12-07 05:20:52','2024-12-07 05:20:52','walinagari');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
