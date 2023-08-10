/*
 Navicat Premium Data Transfer

 Source Server         : Personal Database
 Source Server Type    : MySQL
 Source Server Version : 50732
 Source Host           : localhost:8889
 Source Schema         : koperasi_db

 Target Server Type    : MySQL
 Target Server Version : 50732
 File Encoding         : 65001

 Date: 09/08/2023 16:04:19
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for anggota
-- ----------------------------
DROP TABLE IF EXISTS `anggota`;
CREATE TABLE `anggota` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode_anggota` varchar(64) NOT NULL,
  `user_id` int(11) NOT NULL,
  `tempat_lahir` varchar(64) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `jenis_kelamin` varchar(64) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of anggota
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for aplikasi
-- ----------------------------
DROP TABLE IF EXISTS `aplikasi`;
CREATE TABLE `aplikasi` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nama_owner` varchar(100) DEFAULT NULL,
  `alamat` text,
  `tlp` varchar(50) DEFAULT NULL,
  `title` varchar(20) DEFAULT NULL,
  `nama_aplikasi` varchar(100) DEFAULT NULL,
  `logo` varchar(100) DEFAULT NULL,
  `copy_right` varchar(50) DEFAULT NULL,
  `versi` varchar(20) DEFAULT NULL,
  `tahun` year(4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of aplikasi
-- ----------------------------
BEGIN;
INSERT INTO `aplikasi` VALUES (1, 'Dani', 'JL. nin aja ya', '0812-9936-9059', 'Koprasi', 'KOPRASI', NULL, 'Copy Right ©', '1.0.0.0', 2022);
COMMIT;

-- ----------------------------
-- Table structure for bulan
-- ----------------------------
DROP TABLE IF EXISTS `bulan`;
CREATE TABLE `bulan` (
  `id_bulan` varchar(5) CHARACTER SET latin1 NOT NULL,
  `nama_bulan` varchar(10) CHARACTER SET latin1 NOT NULL,
  `val` int(11) NOT NULL,
  PRIMARY KEY (`id_bulan`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of bulan
-- ----------------------------
BEGIN;
INSERT INTO `bulan` VALUES ('01', 'Januari', 1);
INSERT INTO `bulan` VALUES ('02', 'Februari', 2);
INSERT INTO `bulan` VALUES ('03', 'Maret', 3);
INSERT INTO `bulan` VALUES ('04', 'April', 4);
INSERT INTO `bulan` VALUES ('05', 'Mei', 5);
INSERT INTO `bulan` VALUES ('06', 'Juni', 6);
INSERT INTO `bulan` VALUES ('07', 'Juli', 7);
INSERT INTO `bulan` VALUES ('08', 'Agustus', 8);
INSERT INTO `bulan` VALUES ('09', 'September', 9);
INSERT INTO `bulan` VALUES ('10', 'Oktober', 10);
INSERT INTO `bulan` VALUES ('11', 'November', 11);
INSERT INTO `bulan` VALUES ('12', 'Desember', 12);
COMMIT;

-- ----------------------------
-- Table structure for coa_aktivitas
-- ----------------------------
DROP TABLE IF EXISTS `coa_aktivitas`;
CREATE TABLE `coa_aktivitas` (
  `kode` char(10) NOT NULL,
  `nama` varchar(150) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`kode`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of coa_aktivitas
-- ----------------------------
BEGIN;
INSERT INTO `coa_aktivitas` VALUES ('AC.01', 'Aktivitas Operasi', '2023-01-14 22:17:31', '2023-01-14 22:17:31');
INSERT INTO `coa_aktivitas` VALUES ('AC.02', 'Aktivitas Investasi', '2023-01-14 22:17:44', '2023-01-14 22:17:44');
INSERT INTO `coa_aktivitas` VALUES ('AC.03', 'Aktivitas Pendanaan', '2023-01-14 22:17:53', '2023-01-14 22:17:53');
COMMIT;

-- ----------------------------
-- Table structure for coa_head
-- ----------------------------
DROP TABLE IF EXISTS `coa_head`;
CREATE TABLE `coa_head` (
  `kode` char(10) NOT NULL,
  `nama` varchar(150) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`kode`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of coa_head
-- ----------------------------
BEGIN;
INSERT INTO `coa_head` VALUES ('1', 'Aktiva', '2023-01-14 22:20:24', '2023-01-14 22:20:24');
INSERT INTO `coa_head` VALUES ('2', 'Pasiva', '2023-01-14 22:20:33', '2023-01-14 22:20:33');
INSERT INTO `coa_head` VALUES ('3', 'Modal', '2023-01-14 22:20:37', '2023-01-14 22:20:37');
INSERT INTO `coa_head` VALUES ('4', 'Pendapatan', '2023-01-14 22:20:46', '2023-01-14 22:20:46');
INSERT INTO `coa_head` VALUES ('5', 'HPP', '2023-01-14 22:20:50', '2023-07-07 18:41:34');
INSERT INTO `coa_head` VALUES ('6', 'Beban', '2023-07-07 18:41:30', '2023-07-07 18:41:30');
COMMIT;

-- ----------------------------
-- Table structure for coa_items
-- ----------------------------
DROP TABLE IF EXISTS `coa_items`;
CREATE TABLE `coa_items` (
  `kode` varchar(20) NOT NULL,
  `nama` varchar(150) NOT NULL,
  `dc` char(2) NOT NULL,
  `posted` varchar(50) NOT NULL,
  `sub_id` varchar(20) NOT NULL,
  `activity_id` char(10) DEFAULT NULL COMMENT 'aktivitas arus kas jika ada',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`kode`),
  KEY `coa_items_sub_id_foreign` (`sub_id`),
  KEY `activity_id` (`activity_id`),
  CONSTRAINT `coa_items_ibfk_1` FOREIGN KEY (`sub_id`) REFERENCES `coa_subhead` (`kode`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `coa_items_ibfk_2` FOREIGN KEY (`activity_id`) REFERENCES `coa_aktivitas` (`kode`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of coa_items
-- ----------------------------
BEGIN;
INSERT INTO `coa_items` VALUES ('1101', 'Kas', 'd', 'nrc', '11', NULL, '2023-01-14 20:19:02', '2023-01-14 20:19:02');
INSERT INTO `coa_items` VALUES ('1102', 'Bank', 'd', 'nrc', '11', NULL, '2023-01-14 20:19:28', '2023-07-06 21:46:18');
INSERT INTO `coa_items` VALUES ('1103', 'Piutang Anggota', 'd', 'nrc', '11', 'AC.01', '2023-01-14 20:19:46', '2023-07-07 17:40:12');
INSERT INTO `coa_items` VALUES ('1104', 'Persediaan Barang Dagang', 'd', 'nrc', '11', 'AC.01', '2023-07-07 17:37:33', '2023-07-07 17:37:33');
INSERT INTO `coa_items` VALUES ('1201', 'Tanah', 'd', 'nrc', '12', 'AC.02', '2023-01-14 20:32:02', '2023-01-14 20:32:02');
INSERT INTO `coa_items` VALUES ('1202', 'Peralatan Kantor', 'd', 'nrc', '12', 'AC.02', '2023-01-14 21:30:32', '2023-01-14 21:48:49');
INSERT INTO `coa_items` VALUES ('3101', 'Modal Usaha', 'c', 'nrc', '11', 'AC.03', '2023-01-14 20:30:25', '2023-01-14 20:30:25');
INSERT INTO `coa_items` VALUES ('3201', 'Simpanan Pokok', 'c', 'nrc', '32', 'AC.03', '2023-07-07 10:53:15', '2023-07-07 10:53:15');
INSERT INTO `coa_items` VALUES ('3202', 'Simpanan Wajib', 'c', 'nrc', '32', 'AC.03', '2023-07-07 10:53:42', '2023-07-07 10:53:42');
INSERT INTO `coa_items` VALUES ('3203', 'Simpanan Manasuka', 'c', 'nrc', '32', 'AC.03', '2023-07-07 10:54:02', '2023-07-07 10:54:02');
INSERT INTO `coa_items` VALUES ('4101', 'Pendapatan Usaha', 'c', 'l/r', '41', 'AC.01', '2023-01-14 20:22:23', '2023-01-14 20:22:23');
INSERT INTO `coa_items` VALUES ('4102', 'Pendapatan Akad Murabahah', 'c', 'l/r', '41', 'AC.01', '2023-01-14 20:22:45', '2023-07-07 17:44:55');
INSERT INTO `coa_items` VALUES ('4103', 'Margin Akad Murabahah', 'c', 'l/r', '41', 'AC.01', '2023-07-07 17:46:10', '2023-07-07 17:46:10');
INSERT INTO `coa_items` VALUES ('4104', 'Pendapatan Adm Akad Murabahah', 'c', 'l/r', '41', 'AC.01', '2023-07-07 17:46:56', '2023-07-07 17:46:56');
INSERT INTO `coa_items` VALUES ('5101', 'Harga Pokok Penjualan', 'd', 'l/r', '51', NULL, '2023-07-07 17:43:37', '2023-07-07 17:43:37');
INSERT INTO `coa_items` VALUES ('6101', 'Beban Listrik', 'd', 'l/r', '61        ', 'AC.01', '2023-01-14 20:31:08', '2023-07-07 10:42:41');
INSERT INTO `coa_items` VALUES ('6102', 'Beban Air', 'd', 'l/r', '61        ', 'AC.01', '2023-01-14 21:13:04', '2023-07-07 10:42:45');
INSERT INTO `coa_items` VALUES ('6103', 'Beban Gaji Karyawan', 'd', 'l/r', '61        ', 'AC.01', '2023-01-14 21:18:19', '2023-07-07 10:42:48');
INSERT INTO `coa_items` VALUES ('6104', 'Beban Promosi dan Iklan', 'd', 'l/r', '61        ', 'AC.01', '2023-01-14 21:23:09', '2023-07-07 10:42:51');
INSERT INTO `coa_items` VALUES ('6105', 'Beban Administrasi & Umum', 'd', 'l/r', '61        ', 'AC.01', '2023-01-14 21:24:16', '2023-07-07 10:42:53');
INSERT INTO `coa_items` VALUES ('6106', 'Beban Konsumsi', 'd', 'l/r', '61        ', 'AC.01', '2023-01-15 00:52:35', '2023-07-07 10:42:56');
COMMIT;

-- ----------------------------
-- Table structure for coa_subhead
-- ----------------------------
DROP TABLE IF EXISTS `coa_subhead`;
CREATE TABLE `coa_subhead` (
  `kode` char(10) NOT NULL,
  `nama` varchar(150) NOT NULL,
  `head_id` char(10) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`kode`),
  KEY `head_id` (`head_id`),
  CONSTRAINT `coa_subhead_ibfk_1` FOREIGN KEY (`head_id`) REFERENCES `coa_head` (`kode`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of coa_subhead
-- ----------------------------
BEGIN;
INSERT INTO `coa_subhead` VALUES ('11', 'Aktiva Lancar', '1', '2023-01-14 22:21:05', '2023-01-15 11:57:40');
INSERT INTO `coa_subhead` VALUES ('12', 'Aktiva Tetap', '1', '2023-01-14 22:21:12', '2023-01-15 11:57:42');
INSERT INTO `coa_subhead` VALUES ('13', 'Aktiva Tidak Berwujud', '1', '2023-01-14 22:21:33', '2023-01-15 11:57:43');
INSERT INTO `coa_subhead` VALUES ('21', 'Kewajiban Jangka Pendek', '2', '2023-01-14 22:21:43', '2023-01-15 11:57:44');
INSERT INTO `coa_subhead` VALUES ('22', 'Kewajiban Jangka Pendek', '2', '2023-01-14 22:21:50', '2023-01-15 11:57:45');
INSERT INTO `coa_subhead` VALUES ('31', 'Modal', '3', '2023-01-14 22:21:54', '2023-01-15 11:57:47');
INSERT INTO `coa_subhead` VALUES ('32', 'Simpanan', '3', '2023-01-14 22:21:54', '2023-01-15 11:57:47');
INSERT INTO `coa_subhead` VALUES ('41', 'Pendapatan Usaha', '4', '2023-01-14 22:22:01', '2023-01-15 11:57:49');
INSERT INTO `coa_subhead` VALUES ('51', 'Harga Pokok Penjualan', '5', '2023-07-07 18:42:11', '2023-07-07 18:42:11');
INSERT INTO `coa_subhead` VALUES ('61', 'Beban Operasional', '6', '2023-01-14 22:22:06', '2023-07-07 18:42:14');
INSERT INTO `coa_subhead` VALUES ('62', 'Beban Non Operasional', '6', '2023-01-14 22:22:18', '2023-07-07 18:42:16');
COMMIT;

-- ----------------------------
-- Table structure for detail_pembiayaan
-- ----------------------------
DROP TABLE IF EXISTS `detail_pembiayaan`;
CREATE TABLE `detail_pembiayaan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pembiayaan_id` int(11) NOT NULL,
  `angsuran_ke` int(11) NOT NULL,
  `jumlah_angsuran` double NOT NULL,
  `tgl_pembayaran` date DEFAULT NULL,
  `order_id` varchar(255) NOT NULL,
  `payment_type` varchar(255) NOT NULL,
  `status_message` varchar(255) NOT NULL,
  `transaction_id` varchar(255) NOT NULL,
  `transaction_status` varchar(255) NOT NULL,
  `transaction_time` varchar(255) NOT NULL,
  `bank` varchar(255) NOT NULL,
  `va_number` varchar(255) NOT NULL,
  `pdf_url` varchar(255) NOT NULL,
  `status` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `pembiayaan_detail_id` (`pembiayaan_id`),
  CONSTRAINT `pembiayaan_detail_id` FOREIGN KEY (`pembiayaan_id`) REFERENCES `pembiayaan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=106 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of detail_pembiayaan
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for jurnal_umum
-- ----------------------------
DROP TABLE IF EXISTS `jurnal_umum`;
CREATE TABLE `jurnal_umum` (
  `jurnal_id` bigint(50) unsigned NOT NULL AUTO_INCREMENT,
  `tanggal` date NOT NULL,
  `periode` int(11) NOT NULL,
  `no_bukti` varchar(50) NOT NULL,
  `kode_akun` varchar(20) NOT NULL,
  `deskripsi` varchar(255) DEFAULT NULL,
  `dc` char(2) NOT NULL COMMENT 'd/c',
  `nominal` double NOT NULL,
  `trans_ref` varchar(100) NOT NULL COMMENT 'Keterangan Asal Transaksi',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`jurnal_id`),
  KEY `kode_akun` (`kode_akun`),
  CONSTRAINT `jurnal_umum_ibfk_1` FOREIGN KEY (`kode_akun`) REFERENCES `coa_items` (`kode`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of jurnal_umum
-- ----------------------------
BEGIN;
INSERT INTO `jurnal_umum` VALUES (1, '2023-01-01', 202301, 'TRX-MN-0001.001', '1101', 'Input Manual Modal Usaha', 'd', 100000000, 'MANUAL', '2023-01-15 12:25:54', '2023-01-15 12:26:30');
INSERT INTO `jurnal_umum` VALUES (2, '2023-01-01', 202301, 'TRX-MN-0001.001', '3101', 'Input Manual Modal Usaha', 'c', 100000000, 'MANUAL', '2023-01-15 12:25:54', '2023-01-15 12:26:30');
INSERT INTO `jurnal_umum` VALUES (40, '2023-01-01', 202301, 'TRX-MN-0001.002', '1102', 'Input Manual Modal Usaha (BANK)', 'd', 100000000, 'MANUAL', '2023-01-15 12:25:54', '2023-01-15 12:26:30');
INSERT INTO `jurnal_umum` VALUES (41, '2023-01-01', 202301, 'TRX-MN-0001.002', '3101', 'Input Manual Modal Usaha (BANK)', 'c', 100000000, 'MANUAL', '2023-01-15 12:25:54', '2023-01-15 12:26:30');
COMMIT;

-- ----------------------------
-- Table structure for kategori_pengeluaran
-- ----------------------------
DROP TABLE IF EXISTS `kategori_pengeluaran`;
CREATE TABLE `kategori_pengeluaran` (
  `kode` varchar(20) NOT NULL,
  `nama` varchar(150) NOT NULL,
  `akun_pengeluaran` varchar(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`kode`),
  KEY `akun_pengeluaran` (`akun_pengeluaran`),
  CONSTRAINT `kategori_pengeluaran_ibfk_1` FOREIGN KEY (`akun_pengeluaran`) REFERENCES `coa_items` (`kode`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of kategori_pengeluaran
-- ----------------------------
BEGIN;
INSERT INTO `kategori_pengeluaran` VALUES ('KK-0001', 'Pembelian Aset Berupa Tanah', '1201', '2023-01-14 21:12:09', '2023-01-14 21:12:09');
INSERT INTO `kategori_pengeluaran` VALUES ('KK-0002', 'Pembayaran Token Listrik', '6101', '2023-01-14 21:12:33', '2023-01-14 21:12:33');
INSERT INTO `kategori_pengeluaran` VALUES ('KK-0003', 'Pembayaran Tagihan PDAM (Rekening Air)', '6102', '2023-01-14 21:13:29', '2023-01-14 21:15:37');
INSERT INTO `kategori_pengeluaran` VALUES ('KK-0004', 'Pembayaran Gaji Karyawan', '6103', '2023-01-14 21:18:35', '2023-01-14 21:18:35');
INSERT INTO `kategori_pengeluaran` VALUES ('KK-0005', 'Pembayaran Biaya Promosi atau Iklan', '6104', '2023-01-14 21:23:31', '2023-01-14 21:23:31');
INSERT INTO `kategori_pengeluaran` VALUES ('KK-0006', 'Pembelian ATK', '6105', '2023-01-14 21:24:30', '2023-01-14 21:24:30');
INSERT INTO `kategori_pengeluaran` VALUES ('KK-0007', 'Pembelian Peralatan Kantor', '1202', '2023-01-14 21:31:10', '2023-01-14 21:31:10');
INSERT INTO `kategori_pengeluaran` VALUES ('KK-0008', 'Pemeblian Konsumsi untuk Rapat', '6106', '2023-01-15 00:55:54', '2023-01-15 00:55:54');
INSERT INTO `kategori_pengeluaran` VALUES ('KK-0009', 'Pembelian Konsumsi untuk Security', '6106', '2023-02-02 06:47:41', '2023-02-02 06:47:41');
COMMIT;

-- ----------------------------
-- Table structure for pembiayaan
-- ----------------------------
DROP TABLE IF EXISTS `pembiayaan`;
CREATE TABLE `pembiayaan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `kode_pembiayaan` varchar(20) NOT NULL,
  `tgl_pembiayaan` date NOT NULL,
  `tgl_pelunasan` date DEFAULT NULL,
  `nama_barang` varchar(64) NOT NULL,
  `jenis_pembiayaan` varchar(64) NOT NULL,
  `jumlah_pembiayaan` int(11) NOT NULL,
  `angsuran` int(11) NOT NULL,
  `margin` int(11) NOT NULL,
  `biaya_administrasi` double NOT NULL,
  `total_angsuran` double NOT NULL,
  `total_pembiayaan` double NOT NULL,
  `status` text NOT NULL,
  `status_pembiayaan` varchar(64) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of pembiayaan
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for pengeluaran
-- ----------------------------
DROP TABLE IF EXISTS `pengeluaran`;
CREATE TABLE `pengeluaran` (
  `kode` varchar(50) NOT NULL,
  `tanggal` date NOT NULL,
  `periode` int(11) NOT NULL,
  `kode_kategori` varchar(20) NOT NULL COMMENT 'Kategori Pengeluaran',
  `deskripsi` varchar(255) DEFAULT NULL,
  `nominal` double DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`kode`),
  KEY `kode_kategori` (`kode_kategori`),
  CONSTRAINT `pengeluaran_ibfk_1` FOREIGN KEY (`kode_kategori`) REFERENCES `kategori_pengeluaran` (`kode`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of pengeluaran
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for pengurus
-- ----------------------------
DROP TABLE IF EXISTS `pengurus`;
CREATE TABLE `pengurus` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_pengurus` varchar(64) NOT NULL,
  `fakultas` varchar(64) NOT NULL,
  `jabatan` varchar(64) NOT NULL,
  `no_hp` varchar(64) NOT NULL,
  `email` varchar(64) NOT NULL,
  `alamat` text NOT NULL,
  `image` varchar(255) NOT NULL DEFAULT 'default.png',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of pengurus
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for riwayat_manasuka
-- ----------------------------
DROP TABLE IF EXISTS `riwayat_manasuka`;
CREATE TABLE `riwayat_manasuka` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_manasuka` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_admin` int(11) NOT NULL,
  `nama_penerima` varchar(50) NOT NULL,
  `nama_bank` varchar(15) NOT NULL,
  `no_rekening` int(11) NOT NULL,
  `nominal` int(11) NOT NULL,
  `tgl_penarikan` datetime NOT NULL,
  `status` int(11) NOT NULL COMMENT '1=lunas, 2=pending, 3=verifikasi Admin\r\n',
  `image` varchar(200) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of riwayat_manasuka
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for riwayat_simpanan
-- ----------------------------
DROP TABLE IF EXISTS `riwayat_simpanan`;
CREATE TABLE `riwayat_simpanan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_sim_wajib` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_bulan` int(11) NOT NULL,
  `tahun` varchar(10) NOT NULL,
  `nominal` int(11) NOT NULL,
  `tgl_bayar` datetime NOT NULL,
  `order_id` int(20) NOT NULL,
  `pdf_url` varchar(300) NOT NULL,
  `status` int(100) NOT NULL COMMENT '200=Lunas, 201=pending',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of riwayat_simpanan
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for simpanan_manasuka
-- ----------------------------
DROP TABLE IF EXISTS `simpanan_manasuka`;
CREATE TABLE `simpanan_manasuka` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `nominal` int(11) NOT NULL,
  `tgl_bayar` datetime NOT NULL,
  `status` int(11) NOT NULL COMMENT '1=lunas, 2=pending\r\n',
  `metode_pembayaran` varchar(10) NOT NULL,
  `order_id` int(20) NOT NULL,
  `pdf_url` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of simpanan_manasuka
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for simpanan_pokok
-- ----------------------------
DROP TABLE IF EXISTS `simpanan_pokok`;
CREATE TABLE `simpanan_pokok` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(15) NOT NULL,
  `kode_transaksi` varchar(20) DEFAULT NULL,
  `nominal` int(11) DEFAULT NULL,
  `status` enum('1','2') DEFAULT NULL,
  `tgl_bayar` datetime DEFAULT NULL,
  `metode_pembayaran` enum('Online','Manual') DEFAULT NULL,
  `order_id` varchar(30) DEFAULT NULL,
  `pdf_url` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=904 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of simpanan_pokok
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for simpanan_wajib
-- ----------------------------
DROP TABLE IF EXISTS `simpanan_wajib`;
CREATE TABLE `simpanan_wajib` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `tahun` varchar(10) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of simpanan_wajib
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id_user` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(20) DEFAULT NULL,
  `full_name` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `nik` varchar(16) NOT NULL,
  `alamat` varchar(200) NOT NULL,
  `no_hp` varchar(20) NOT NULL,
  `tgl_registrasi` datetime NOT NULL,
  `role` int(11) DEFAULT NULL,
  `image` varchar(500) DEFAULT NULL,
  `is_active` enum('1','2') DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=957 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of users
-- ----------------------------
BEGIN;
INSERT INTO `users` VALUES (1, 'admin', 'Administrator', '$2y$10$AUJVLREAPsG0hbAfngkVueXItUO6nK0iyfWxOvxlXoVRZf0N1QTJW', '1234567890123451', 'bandung', '081234567892', '0000-00-00 00:00:00', 1, 'anggota.png', '1', '0000-00-00 00:00:00', '2023-02-01 21:13:26');
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;
