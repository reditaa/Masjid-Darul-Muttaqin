/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
DROP TABLE IF EXISTS `cache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` bigint(20) NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `cache_locks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` bigint(20) NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_locks_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) NOT NULL,
  `connection` varchar(255) NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`),
  KEY `failed_jobs_connection_queue_failed_at_index` (`connection`,`queue`,`failed_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `galeri_kategoris`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `galeri_kategoris` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nama_kategori` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `galeris`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `galeris` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `judul` varchar(255) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `file` varchar(255) NOT NULL,
  `tipe` enum('foto','video') NOT NULL DEFAULT 'foto',
  `galeri_kategori_id` bigint(20) unsigned DEFAULT NULL,
  `kegiatan_id` bigint(20) unsigned DEFAULT NULL,
  `tanggal` date NOT NULL,
  `diunggah_oleh` bigint(20) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `galeris_galeri_kategori_id_foreign` (`galeri_kategori_id`),
  KEY `galeris_kegiatan_id_foreign` (`kegiatan_id`),
  KEY `galeris_diunggah_oleh_foreign` (`diunggah_oleh`),
  CONSTRAINT `galeris_diunggah_oleh_foreign` FOREIGN KEY (`diunggah_oleh`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  CONSTRAINT `galeris_galeri_kategori_id_foreign` FOREIGN KEY (`galeri_kategori_id`) REFERENCES `galeri_kategoris` (`id`) ON DELETE SET NULL,
  CONSTRAINT `galeris_kegiatan_id_foreign` FOREIGN KEY (`kegiatan_id`) REFERENCES `kegiatans` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `inventaris`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `inventaris` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `kode_inventaris` varchar(255) NOT NULL,
  `nama_barang` varchar(255) NOT NULL,
  `kategori` enum('elektronik','mebel','perlengkapan_ibadah','kebersihan','dokumen','lainnya') NOT NULL DEFAULT 'lainnya',
  `jumlah` int(10) unsigned NOT NULL DEFAULT 1,
  `satuan` varchar(255) NOT NULL DEFAULT 'unit',
  `kondisi` enum('baik','rusak_ringan','rusak_berat','hilang') NOT NULL DEFAULT 'baik',
  `lokasi_penyimpanan` varchar(255) DEFAULT NULL,
  `tanggal_perolehan` date DEFAULT NULL,
  `sumber_perolehan` enum('pembelian','donasi','hibah','lainnya') NOT NULL DEFAULT 'lainnya',
  `harga_perolehan` decimal(15,2) DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `inventaris_kode_inventaris_unique` (`kode_inventaris`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `jabatans`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jabatans` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nama_jabatan` varchar(255) NOT NULL,
  `urutan` int(10) unsigned NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `jadwal_bilal_anggotas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jadwal_bilal_anggotas` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `jadwal_bilal_id` bigint(20) unsigned NOT NULL,
  `pengurus_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `bilal_anggota_unique` (`jadwal_bilal_id`,`pengurus_id`),
  KEY `jadwal_bilal_anggotas_pengurus_id_foreign` (`pengurus_id`),
  CONSTRAINT `jadwal_bilal_anggotas_jadwal_bilal_id_foreign` FOREIGN KEY (`jadwal_bilal_id`) REFERENCES `jadwal_bilals` (`id`) ON DELETE CASCADE,
  CONSTRAINT `jadwal_bilal_anggotas_pengurus_id_foreign` FOREIGN KEY (`pengurus_id`) REFERENCES `pengurus` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `jadwal_bilals`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jadwal_bilals` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `pasaran` enum('legi','pahing','pon','wage','kliwon') NOT NULL,
  `keterangan` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `jadwal_bilals_pasaran_unique` (`pasaran`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `jadwal_imam_muazin_anggotas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jadwal_imam_muazin_anggotas` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `jadwal_imam_muazin_id` bigint(20) unsigned NOT NULL,
  `pengurus_id` bigint(20) unsigned NOT NULL,
  `peran` enum('imam','muazin') NOT NULL DEFAULT 'imam',
  `urutan` tinyint(3) unsigned NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `imam_anggota_unique` (`jadwal_imam_muazin_id`,`pengurus_id`),
  KEY `jadwal_imam_muazin_anggotas_pengurus_id_foreign` (`pengurus_id`),
  CONSTRAINT `jadwal_imam_muazin_anggotas_jadwal_imam_muazin_id_foreign` FOREIGN KEY (`jadwal_imam_muazin_id`) REFERENCES `jadwal_imam_muazins` (`id`) ON DELETE CASCADE,
  CONSTRAINT `jadwal_imam_muazin_anggotas_pengurus_id_foreign` FOREIGN KEY (`pengurus_id`) REFERENCES `pengurus` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `jadwal_imam_muazins`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jadwal_imam_muazins` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `hari` enum('senin','selasa','rabu','kamis','jumat','sabtu','minggu') NOT NULL,
  `waktu_sholat` enum('subuh','dzuhur','ashar','maghrib','isya','jumat') NOT NULL,
  `keterangan` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `jadwal_imam_muazins_hari_waktu_sholat_unique` (`hari`,`waktu_sholat`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `jadwal_jumat_anggotas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jadwal_jumat_anggotas` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `jadwal_jumat_id` bigint(20) unsigned NOT NULL,
  `pengurus_id` bigint(20) unsigned NOT NULL,
  `peran` enum('khatib','imam','bilal') NOT NULL,
  `urutan` tinyint(3) unsigned NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `jumat_anggota_unique` (`jadwal_jumat_id`,`pengurus_id`,`peran`),
  KEY `jadwal_jumat_anggotas_pengurus_id_foreign` (`pengurus_id`),
  CONSTRAINT `jadwal_jumat_anggotas_jadwal_jumat_id_foreign` FOREIGN KEY (`jadwal_jumat_id`) REFERENCES `jadwal_jumats` (`id`) ON DELETE CASCADE,
  CONSTRAINT `jadwal_jumat_anggotas_pengurus_id_foreign` FOREIGN KEY (`pengurus_id`) REFERENCES `pengurus` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `jadwal_jumats`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jadwal_jumats` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `pasaran` enum('legi','pahing','pon','wage','kliwon') NOT NULL,
  `keterangan` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `jadwal_jumats_pasaran_unique` (`pasaran`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `jadwal_piket_anggotas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jadwal_piket_anggotas` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `jadwal_piket_kebersihan_id` bigint(20) unsigned NOT NULL,
  `pengurus_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `piket_anggota_unique` (`jadwal_piket_kebersihan_id`,`pengurus_id`),
  KEY `jadwal_piket_anggotas_pengurus_id_foreign` (`pengurus_id`),
  CONSTRAINT `jadwal_piket_anggotas_jadwal_piket_kebersihan_id_foreign` FOREIGN KEY (`jadwal_piket_kebersihan_id`) REFERENCES `jadwal_piket_kebersihans` (`id`) ON DELETE CASCADE,
  CONSTRAINT `jadwal_piket_anggotas_pengurus_id_foreign` FOREIGN KEY (`pengurus_id`) REFERENCES `pengurus` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `jadwal_piket_kebersihans`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jadwal_piket_kebersihans` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `hari` enum('senin','selasa','rabu','kamis','jumat','sabtu','minggu') NOT NULL,
  `area_tugas` text DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `jadwal_piket_kebersihans_hari_unique` (`hari`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `job_batches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` smallint(5) unsigned NOT NULL,
  `reserved_at` int(10) unsigned DEFAULT NULL,
  `available_at` int(10) unsigned NOT NULL,
  `created_at` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `kategori_transaksis`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `kategori_transaksis` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nama_kategori` varchar(255) NOT NULL,
  `jenis` enum('pemasukan','pengeluaran') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `kegiatans`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `kegiatans` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `judul` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `kategori` enum('kajian','pengajian','phbi','santunan','bakti_sosial','lainnya') NOT NULL DEFAULT 'lainnya',
  `tanggal_mulai` date NOT NULL,
  `tanggal_selesai` date DEFAULT NULL,
  `waktu_mulai` time DEFAULT NULL,
  `waktu_selesai` time DEFAULT NULL,
  `lokasi` varchar(255) DEFAULT NULL,
  `penanggung_jawab_id` bigint(20) unsigned DEFAULT NULL,
  `status` enum('akan_datang','berlangsung','selesai','dibatalkan') NOT NULL DEFAULT 'akan_datang',
  `poster` varchar(255) DEFAULT NULL,
  `anggaran` decimal(15,2) DEFAULT NULL,
  `jumlah_peserta` int(10) unsigned DEFAULT NULL,
  `laporan_hasil` longtext DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `kegiatans_slug_unique` (`slug`),
  KEY `kegiatans_penanggung_jawab_id_foreign` (`penanggung_jawab_id`),
  CONSTRAINT `kegiatans_penanggung_jawab_id_foreign` FOREIGN KEY (`penanggung_jawab_id`) REFERENCES `pengurus` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `pengumumans`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pengumumans` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `judul` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `isi` longtext NOT NULL,
  `kategori` enum('umum','kegiatan','keuangan','sosial','lainnya') NOT NULL DEFAULT 'umum',
  `gambar` varchar(255) DEFAULT NULL,
  `tanggal_publish` datetime NOT NULL,
  `tanggal_berakhir` datetime DEFAULT NULL,
  `status` enum('draft','published','arsip') NOT NULL DEFAULT 'draft',
  `dilihat` int(10) unsigned NOT NULL DEFAULT 0,
  `penulis_id` bigint(20) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `pengumumans_slug_unique` (`slug`),
  KEY `pengumumans_penulis_id_foreign` (`penulis_id`),
  CONSTRAINT `pengumumans_penulis_id_foreign` FOREIGN KEY (`penulis_id`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `pengurus`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pengurus` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `jabatan_id` bigint(20) unsigned DEFAULT NULL,
  `asal` enum('guru','siswa','umum') DEFAULT NULL,
  `nama` varchar(255) NOT NULL,
  `nik` varchar(20) DEFAULT NULL,
  `jenis_kelamin` enum('L','P') NOT NULL,
  `tempat_lahir` varchar(255) DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `no_hp` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `bio` text DEFAULT NULL,
  `periode_mulai` date DEFAULT NULL,
  `periode_selesai` date DEFAULT NULL,
  `status` enum('aktif','nonaktif') NOT NULL DEFAULT 'aktif',
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pengurus_user_id_foreign` (`user_id`),
  KEY `pengurus_jabatan_id_foreign` (`jabatan_id`),
  CONSTRAINT `pengurus_jabatan_id_foreign` FOREIGN KEY (`jabatan_id`) REFERENCES `jabatans` (`id`) ON DELETE SET NULL,
  CONSTRAINT `pengurus_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `presensis`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `presensis` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `presentable_type` varchar(255) NOT NULL,
  `presentable_id` bigint(20) unsigned NOT NULL,
  `pengurus_id` bigint(20) unsigned NOT NULL,
  `tanggal` date NOT NULL,
  `status` enum('hadir','tidak_hadir','izin','sakit','diganti') NOT NULL DEFAULT 'hadir',
  `waktu_presensi` time DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `metode` varchar(20) NOT NULL DEFAULT 'manual',
  `pengganti_id` bigint(20) unsigned DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `dicatat_oleh` bigint(20) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `presensi_unique_per_hari` (`presentable_type`,`presentable_id`,`pengurus_id`,`tanggal`),
  KEY `presensis_presentable_type_presentable_id_index` (`presentable_type`,`presentable_id`),
  KEY `presensis_pengurus_id_foreign` (`pengurus_id`),
  KEY `presensis_pengganti_id_foreign` (`pengganti_id`),
  KEY `presensis_dicatat_oleh_foreign` (`dicatat_oleh`),
  KEY `presensis_tanggal_status_index` (`tanggal`,`status`),
  CONSTRAINT `presensis_dicatat_oleh_foreign` FOREIGN KEY (`dicatat_oleh`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  CONSTRAINT `presensis_pengganti_id_foreign` FOREIGN KEY (`pengganti_id`) REFERENCES `pengurus` (`id`) ON DELETE SET NULL,
  CONSTRAINT `presensis_pengurus_id_foreign` FOREIGN KEY (`pengurus_id`) REFERENCES `pengurus` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `profil_masjid`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `profil_masjid` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nama_masjid` varchar(255) NOT NULL,
  `slogan` varchar(255) DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `kelurahan` varchar(255) DEFAULT NULL,
  `kecamatan` varchar(255) DEFAULT NULL,
  `kabupaten_kota` varchar(255) DEFAULT NULL,
  `provinsi` varchar(255) DEFAULT NULL,
  `kode_pos` varchar(10) DEFAULT NULL,
  `latitude` decimal(10,7) DEFAULT NULL,
  `longitude` decimal(10,7) DEFAULT NULL,
  `no_telepon` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `website` varchar(255) DEFAULT NULL,
  `tahun_berdiri` year(4) DEFAULT NULL,
  `luas_tanah` decimal(10,2) DEFAULT NULL,
  `luas_bangunan` decimal(10,2) DEFAULT NULL,
  `kapasitas_jamaah` int(10) unsigned DEFAULT NULL,
  `sejarah` text DEFAULT NULL,
  `visi` text DEFAULT NULL,
  `misi` text DEFAULT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `foto_utama` varchar(255) DEFAULT NULL,
  `foto_hero` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `transaksi_keuangans`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `transaksi_keuangans` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `kategori_transaksi_id` bigint(20) unsigned NOT NULL,
  `jenis` enum('pemasukan','pengeluaran') NOT NULL,
  `tanggal` date NOT NULL,
  `jumlah` decimal(15,2) NOT NULL,
  `sumber_tujuan` varchar(255) DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `bukti` varchar(255) DEFAULT NULL,
  `dicatat_oleh` bigint(20) unsigned DEFAULT NULL,
  `kegiatan_id` bigint(20) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `transaksi_keuangans_kategori_transaksi_id_foreign` (`kategori_transaksi_id`),
  KEY `transaksi_keuangans_dicatat_oleh_foreign` (`dicatat_oleh`),
  KEY `transaksi_keuangans_kegiatan_id_foreign` (`kegiatan_id`),
  CONSTRAINT `transaksi_keuangans_dicatat_oleh_foreign` FOREIGN KEY (`dicatat_oleh`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  CONSTRAINT `transaksi_keuangans_kategori_transaksi_id_foreign` FOREIGN KEY (`kategori_transaksi_id`) REFERENCES `kategori_transaksis` (`id`) ON DELETE CASCADE,
  CONSTRAINT `transaksi_keuangans_kegiatan_id_foreign` FOREIGN KEY (`kegiatan_id`) REFERENCES `kegiatans` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','anggota') NOT NULL DEFAULT 'anggota',
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (1,'0001_01_01_000000_create_users_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (2,'0001_01_01_000001_create_cache_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (3,'0001_01_01_000002_create_jobs_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (4,'2026_07_21_132912_add_role_to_users_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (5,'2026_07_22_033900_create_pengumumen_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (6,'2026_07_27_110324_create_gurus_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (7,'2026_07_27_110342_create_siswas_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (8,'2026_07_27_110353_create_anggotas_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (9,'2026_07_27_110402_create_pengurus_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (10,'2026_07_27_110411_create_jadwal_pikets_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (11,'2026_07_27_120000_create_jadwal_adzans_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (18,'2026_07_29_161216_create_jadwal_imams_table',2);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (19,'2026_07_30_143324_update_jadwal_imams_table',2);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (22,'2026_07_30_143402_create_jadwal_jumats_table',3);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (23,'2026_07_31_032252_update_jadwal_imams_to_dzuhur_ashar',4);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (24,'2026_08_03_022328_add_hari_to_jadwal_adzans_table',5);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (25,'2026_08_03_023921_add_email_password_to_anggotas_table',6);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (26,'2026_08_03_031601_add_tim_columns_to_jadwal_pikets_table',7);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (27,'2026_08_05_000000_rename_old_tables_to_backup',8);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (28,'2026_08_05_000001_create_profil_masjid_table',8);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (29,'2026_08_05_000002_create_jabatans_table',8);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (30,'2026_08_05_000003_create_pengurus_table',8);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (31,'2026_08_05_000004_create_jadwal_imam_muazins_table',8);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (32,'2026_08_05_000005_create_jadwal_bilals_table',8);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (33,'2026_08_05_000006_create_jadwal_piket_kebersihans_table',8);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (34,'2026_08_05_000007_create_jadwal_piket_anggotas_table',8);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (35,'2026_08_05_000009_create_kegiatans_table',8);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (36,'2026_08_05_000010_create_galeri_kategoris_table',8);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (37,'2026_08_05_000011_create_galeris_table',8);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (38,'2026_08_05_000012_create_inventaris_table',8);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (39,'2026_08_05_000013_create_kategori_transaksis_table',8);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (40,'2026_08_05_000014_create_transaksi_keuangans_table',8);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (41,'2026_08_05_000015_create_presensis_table',8);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (42,'2026_08_05_000016_add_khatib_id_to_jadwal_imam_muazins_table',8);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (43,'2026_08_05_000008_create_pengumumans_table',9);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (44,'2026_08_06_110957_add_asal_and_nullable_jabatan_to_pengurus_table',10);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (45,'2026_08_07_183046_change_jadwal_bilals_to_pasaran_structure',11);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (46,'2026_08_07_183512_create_jadwal_bilal_anggotas_table',11);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (47,'2026_08_07_185241_change_jadwal_piket_kebersihans_to_hari_structure',12);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (49,'2026_08_08_184742_add_foto_to_presensis_table',13);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (50,'2026_08_10_081839_change_role_enum_in_users_table',13);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (51,'2026_08_13_182004_remove_single_person_columns_from_jadwal_imam_muazins_table',14);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (52,'2026_08_18_130321_create_jadwal_jumats_table',15);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (54,'2026_08_20_093924_add_foto_hero_to_profil_masjid_table',16);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (55,'2026_08_26_074832_add_peran_to_jadwal_imam_muazin_anggotas_table',17);
