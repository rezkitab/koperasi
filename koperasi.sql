-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 25, 2023 at 11:20 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `koperasi`
--

-- --------------------------------------------------------

--
-- Table structure for table `anggota`
--

CREATE TABLE `anggota` (
  `id` int(11) NOT NULL,
  `kode_anggota` varchar(64) NOT NULL,
  `user_id` int(11) NOT NULL,
  `tempat_lahir` varchar(64) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `jenis_kelamin` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `anggota`
--

INSERT INTO `anggota` (`id`, `kode_anggota`, `user_id`, `tempat_lahir`, `tanggal_lahir`, `jenis_kelamin`) VALUES
(4, 'AGT997', 180, 'bandung', '2000-12-12', 'Laki-laki'),
(5, 'AGT60', 938, '123', '2023-06-03', 'Laki-laki'),
(6, 'AGT859', 777, 'coba', '2023-06-03', 'Laki-laki'),
(7, 'AGT869', 49, 'asdadaew', '2023-06-05', 'Laki-laki'),
(8, 'AGT913', 173, 'asdasd', '2023-06-05', 'Laki-laki'),
(9, 'AGT733', 134, 'tes', '2023-06-25', 'Laki-laki');

-- --------------------------------------------------------

--
-- Table structure for table `aplikasi`
--

CREATE TABLE `aplikasi` (
  `id` int(10) UNSIGNED NOT NULL,
  `nama_owner` varchar(100) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `tlp` varchar(50) DEFAULT NULL,
  `title` varchar(20) DEFAULT NULL,
  `nama_aplikasi` varchar(100) DEFAULT NULL,
  `logo` varchar(100) DEFAULT NULL,
  `copy_right` varchar(50) DEFAULT NULL,
  `versi` varchar(20) DEFAULT NULL,
  `tahun` year(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `aplikasi`
--

INSERT INTO `aplikasi` (`id`, `nama_owner`, `alamat`, `tlp`, `title`, `nama_aplikasi`, `logo`, `copy_right`, `versi`, `tahun`) VALUES
(1, 'Dani', 'JL. nin aja ya', '0812-9936-9059', 'Koprasi', 'KOPRASI', NULL, 'Copy Right ©', '1.0.0.0', '2022');

-- --------------------------------------------------------

--
-- Table structure for table `bulan`
--

CREATE TABLE `bulan` (
  `id_bulan` varchar(5) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `nama_bulan` varchar(10) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `val` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bulan`
--

INSERT INTO `bulan` (`id_bulan`, `nama_bulan`, `val`) VALUES
('01', 'Januari', 1),
('02', 'Februari', 2),
('03', 'Maret', 3),
('04', 'April', 4),
('05', 'Mei', 5),
('06', 'Juni', 6),
('07', 'Juli', 7),
('08', 'Agustus', 8),
('09', 'September', 9),
('10', 'Oktober', 10),
('11', 'November', 11),
('12', 'Desember', 12);

-- --------------------------------------------------------

--
-- Table structure for table `detail_pembiayaan`
--

CREATE TABLE `detail_pembiayaan` (
  `id` int(11) NOT NULL,
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
  `status` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pembiayaan`
--

CREATE TABLE `pembiayaan` (
  `id` int(11) NOT NULL,
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
  `status_pembiayaan` varchar(64) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pengurus`
--

CREATE TABLE `pengurus` (
  `id` int(11) NOT NULL,
  `nama_pengurus` varchar(64) NOT NULL,
  `fakultas` varchar(64) NOT NULL,
  `jabatan` varchar(64) NOT NULL,
  `no_hp` varchar(64) NOT NULL,
  `email` varchar(64) NOT NULL,
  `alamat` text NOT NULL,
  `image` varchar(255) NOT NULL DEFAULT 'default.png'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pengurus`
--

INSERT INTO `pengurus` (`id`, `nama_pengurus`, `fakultas`, `jabatan`, `no_hp`, `email`, `alamat`, `image`) VALUES
(2, 'Dr. Nelsi Wisna, S.E., M.Si.', 'Applied Sciences', '', '', '', '', 'default.png'),
(3, 'Anak Agung Gde Agung, S.T., M.M.', 'Applied Sciences', '', '', '', '', 'default.png'),
(4, 'Asniar, S.T., M.T', 'Applied Sciences', '', '', '', '', 'default.png'),
(5, 'Asti Widayanti, S.Si, M.T.', 'Ilmu Terapan', '', '', '', '', 'default.png'),
(6, 'Magdalena Karismariyanti, S.T., M.B.A.', 'Ilmu Terapan', '', '', '', '', 'default.png'),
(7, 'Irna Yuniar S.T., M.A.B.', 'Ilmu Terapan', '', '', '', '', 'default.png'),
(8, 'Kastaman, S.T., M.M.', 'Ilmu Terapan', '', '', '', '', 'default.png'),
(9, 'Raswyshnoe Boing Kotjoprayudi, S.E., M.M.', 'Ilmu Terapan', '', '', '', '', 'default.png'),
(10, 'Renny Sukawati , S.E., M.M.', 'Ilmu Terapan', '', '', '', '', 'default.png'),
(11, 'Rochmawati, S.T., M.T.', 'Ilmu Terapan', '', '', '', '', 'default.png'),
(12, 'Iji Samaji S.E., M.Si., Ak.', 'Ilmu Terapan', '', '', '', '', 'default.png'),
(13, 'Dr. Tora Fahrudin, S.T., M.T.', 'Ilmu Terapan', '', '', '', '', 'default.png');

-- --------------------------------------------------------

--
-- Table structure for table `riwayat_manasuka`
--

CREATE TABLE `riwayat_manasuka` (
  `id` int(11) NOT NULL,
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
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `riwayat_simpanan`
--

CREATE TABLE `riwayat_simpanan` (
  `id` int(11) NOT NULL,
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
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `riwayat_simpanan`
--

INSERT INTO `riwayat_simpanan` (`id`, `id_sim_wajib`, `id_user`, `id_bulan`, `tahun`, `nominal`, `tgl_bayar`, `order_id`, `pdf_url`, `status`, `created_at`, `updated_at`) VALUES
(3, 2, 568, 1, '2023', 200000, '2023-01-23 12:53:35', 1234883958, 'https://app.sandbox.midtrans.com/snap/v1/transactions/946eaf53-435b-43c3-9734-c39e43ed3882/pdf', 201, '2023-01-23 12:53:35', '0000-00-00 00:00:00'),
(4, 2, 568, 2, '2023', 100000, '2023-01-23 12:59:20', 812466061, 'https://app.sandbox.midtrans.com/snap/v1/transactions/c96861ce-7250-4c18-9eab-f4a85fe52986/pdf', 201, '2023-01-23 12:59:20', '0000-00-00 00:00:00'),
(5, 1, 11, 1, '2023', 50000, '2023-01-23 17:47:55', 1743257830, 'https://app.sandbox.midtrans.com/snap/v1/transactions/52a127fa-46f3-4ea6-ad0b-19b870d442a1/pdf', 201, '2023-01-23 17:47:55', '0000-00-00 00:00:00'),
(6, 1, 11, 2, '2023', 100000, '2023-01-23 17:56:54', 328196453, 'https://app.sandbox.midtrans.com/snap/v1/transactions/87246ec5-0acf-4b7e-a350-ef98e568ef39/pdf', 201, '2023-01-23 17:56:54', '0000-00-00 00:00:00'),
(7, 2, 568, 3, '2023', 50000, '2023-01-24 20:13:35', 1687569164, 'https://app.sandbox.midtrans.com/snap/v1/transactions/8af8ed71-28a1-4f3a-adda-fcd3c136dfa6/pdf', 201, '2023-01-24 20:13:35', '0000-00-00 00:00:00'),
(8, 10, 775, 1, '2023', 50000, '2023-01-24 21:07:23', 1510929542, 'https://app.sandbox.midtrans.com/snap/v1/transactions/84eab69c-2172-457b-9dcd-6928cec24725/pdf', 201, '2023-01-24 21:07:23', '0000-00-00 00:00:00'),
(9, 10, 775, 2, '2023', 50000, '2023-01-31 15:15:37', 179779320, 'https://app.sandbox.midtrans.com/snap/v1/transactions/b9456233-9f1d-4b3a-a858-209b62c8623d/pdf', 201, '2023-01-31 15:15:37', '0000-00-00 00:00:00'),
(10, 11, 565, 1, '2023', 50000, '2023-01-31 15:37:49', 352523422, 'https://app.sandbox.midtrans.com/snap/v1/transactions/22678ff8-3f39-4f99-8876-40547d3460fb/pdf', 201, '2023-01-31 15:37:49', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `simpanan_manasuka`
--

CREATE TABLE `simpanan_manasuka` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `nominal` int(11) NOT NULL,
  `tgl_bayar` datetime NOT NULL,
  `status` int(11) NOT NULL COMMENT '1=lunas, 2=pending\r\n',
  `metode_pembayaran` varchar(10) NOT NULL,
  `order_id` int(20) NOT NULL,
  `pdf_url` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `simpanan_manasuka`
--

INSERT INTO `simpanan_manasuka` (`id`, `id_user`, `nominal`, `tgl_bayar`, `status`, `metode_pembayaran`, `order_id`, `pdf_url`) VALUES
(11, 565, 100000, '2023-01-31 20:24:20', 1, 'Online', 563732379, 'https://app.sandbox.midtrans.com/snap/v1/transactions/c6bffe61-6ac4-4388-a8c8-cb9ec45e024c/pdf'),
(12, 565, 50000, '2023-02-01 21:08:05', 1, 'Online', 136139995, 'https://app.sandbox.midtrans.com/snap/v1/transactions/5f757dd4-2515-45ac-ad1d-297555b46b1a/pdf');

-- --------------------------------------------------------

--
-- Table structure for table `simpanan_pokok`
--

CREATE TABLE `simpanan_pokok` (
  `id` int(11) NOT NULL,
  `id_user` int(15) NOT NULL,
  `kode_transaksi` varchar(20) DEFAULT NULL,
  `nominal` int(11) DEFAULT NULL,
  `status` enum('1','2') DEFAULT NULL,
  `tgl_bayar` datetime DEFAULT NULL,
  `metode_pembayaran` enum('Online','Manual') DEFAULT NULL,
  `order_id` varchar(30) DEFAULT NULL,
  `pdf_url` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `simpanan_pokok`
--

INSERT INTO `simpanan_pokok` (`id`, `id_user`, `kode_transaksi`, `nominal`, `status`, `tgl_bayar`, `metode_pembayaran`, `order_id`, `pdf_url`) VALUES
(1, 1, NULL, NULL, NULL, NULL, '', '', ''),
(42, 42, 'TRK563', 50000, '1', '2023-02-01 23:01:46', 'Online', '1173298241', 'https://app.sandbox.midtrans.com/snap/v1/transactions/25ec225b-e0be-403e-9aa3-696c28ab0580/pdf'),
(565, 565, 'TRK698', 50000, '1', '2023-01-31 15:32:42', 'Online', '241028225', 'https://app.sandbox.midtrans.com/snap/v1/transactions/bde2f6f1-4bdf-4b6b-adbd-f34ea92fce9c/pdf'),
(888, 775, 'TRK254', 50000, '1', NULL, 'Online', NULL, '');

-- --------------------------------------------------------

--
-- Table structure for table `simpanan_wajib`
--

CREATE TABLE `simpanan_wajib` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `tahun` varchar(10) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `simpanan_wajib`
--

INSERT INTO `simpanan_wajib` (`id`, `id_user`, `tahun`, `created_at`, `updated_at`) VALUES
(1, 11, '2023', '2023-01-22 14:07:24', '0000-00-00 00:00:00'),
(2, 568, '2023', '2023-01-22 14:07:24', '0000-00-00 00:00:00'),
(3, 780, '2023', '2023-01-22 14:07:24', '0000-00-00 00:00:00'),
(4, 11, '2024', '2023-01-24 20:04:59', '0000-00-00 00:00:00'),
(5, 568, '2024', '2023-01-24 20:04:59', '0000-00-00 00:00:00'),
(6, 780, '2024', '2023-01-24 20:04:59', '0000-00-00 00:00:00'),
(7, 11, '2025', '2023-01-24 20:10:01', '0000-00-00 00:00:00'),
(8, 568, '2025', '2023-01-24 20:10:01', '0000-00-00 00:00:00'),
(9, 780, '2025', '2023-01-24 20:10:01', '0000-00-00 00:00:00'),
(10, 775, '2023', '2023-01-24 21:04:16', '0000-00-00 00:00:00'),
(11, 565, '2023', '2023-01-31 12:04:01', '0000-00-00 00:00:00'),
(12, 1, '2023', '2023-02-01 21:21:17', '0000-00-00 00:00:00'),
(13, 42, '2023', '2023-02-01 23:01:47', '0000-00-00 00:00:00'),
(14, 169, '2023', '2023-04-08 21:10:07', '0000-00-00 00:00:00'),
(15, 180, '2023', '2023-05-20 10:42:27', '0000-00-00 00:00:00'),
(16, 777, '2023', '2023-06-04 15:22:33', '0000-00-00 00:00:00'),
(17, 49, '2023', '2023-06-05 11:15:22', '0000-00-00 00:00:00'),
(18, 173, '2023', '2023-06-05 11:15:22', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` int(11) UNSIGNED NOT NULL,
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
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `username`, `full_name`, `password`, `nik`, `alamat`, `no_hp`, `tgl_registrasi`, `role`, `image`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'Administrator', '$2y$10$AUJVLREAPsG0hbAfngkVueXItUO6nK0iyfWxOvxlXoVRZf0N1QTJW', '1234567890123451', 'bandung', '081234567892', '0000-00-00 00:00:00', 1, 'anggota.png', '1', '0000-00-00 00:00:00', '2023-02-01 21:13:26'),
(6, 'user', 'anggota', '$2y$10$AUJVLREAPsG0hbAfngkVueXItUO6nK0iyfWxOvxlXoVRZf0N1QTJW', '', '', '', '0000-00-00 00:00:00', 2, 'user.jpg', '2', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(42, 'abran', 'tabrani', '$2y$10$AUJVLREAPsG0hbAfngkVueXItUO6nK0iyfWxOvxlXoVRZf0N1QTJW', '1234567890123455', '', '081234567893', '2023-02-01 23:01:17', 2, 'anggota.png', '1', '2023-02-01 23:01:17', '0000-00-00 00:00:00'),
(565, 'syahman', 'm syahman', '$2y$10$iRpX90pL8M9ckZGU7OYMN.FwWk0OLzHdMclYuie4pkeSG66x86Qba', '1234567890123457', 'Bandung', '081234567891', '2023-01-31 12:02:08', 2, 'anggota.png', '1', '2023-01-31 12:02:08', '2023-01-31 14:57:50'),
(775, 'ahmad', 'ahmad syair', '$2y$10$R3/qoqiVzihAIbpn.wQMgeT5jgqCpVY56ync8YHUicq.i8MSGCtxO', '1234567890123456', 'bandung', '081234567890', '2023-01-24 20:54:04', 2, 'anggota.png', '1', '2023-01-24 20:54:04', '0000-00-00 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `anggota`
--
ALTER TABLE `anggota`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `aplikasi`
--
ALTER TABLE `aplikasi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bulan`
--
ALTER TABLE `bulan`
  ADD PRIMARY KEY (`id_bulan`);

--
-- Indexes for table `detail_pembiayaan`
--
ALTER TABLE `detail_pembiayaan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pembiayaan_detail_id` (`pembiayaan_id`);

--
-- Indexes for table `pembiayaan`
--
ALTER TABLE `pembiayaan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pengurus`
--
ALTER TABLE `pengurus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `riwayat_manasuka`
--
ALTER TABLE `riwayat_manasuka`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `riwayat_simpanan`
--
ALTER TABLE `riwayat_simpanan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `simpanan_manasuka`
--
ALTER TABLE `simpanan_manasuka`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `simpanan_pokok`
--
ALTER TABLE `simpanan_pokok`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `simpanan_wajib`
--
ALTER TABLE `simpanan_wajib`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `anggota`
--
ALTER TABLE `anggota`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `aplikasi`
--
ALTER TABLE `aplikasi`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `detail_pembiayaan`
--
ALTER TABLE `detail_pembiayaan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- AUTO_INCREMENT for table `pembiayaan`
--
ALTER TABLE `pembiayaan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `pengurus`
--
ALTER TABLE `pengurus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `riwayat_manasuka`
--
ALTER TABLE `riwayat_manasuka`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `riwayat_simpanan`
--
ALTER TABLE `riwayat_simpanan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `simpanan_manasuka`
--
ALTER TABLE `simpanan_manasuka`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `simpanan_pokok`
--
ALTER TABLE `simpanan_pokok`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=902;

--
-- AUTO_INCREMENT for table `simpanan_wajib`
--
ALTER TABLE `simpanan_wajib`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=939;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `detail_pembiayaan`
--
ALTER TABLE `detail_pembiayaan`
  ADD CONSTRAINT `pembiayaan_detail_id` FOREIGN KEY (`pembiayaan_id`) REFERENCES `pembiayaan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
