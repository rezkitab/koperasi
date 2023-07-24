-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 24 Jul 2023 pada 06.03
-- Versi server: 10.4.28-MariaDB
-- Versi PHP: 8.1.17

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
-- Struktur dari tabel `anggota`
--

CREATE TABLE `anggota` (
  `id` int(11) NOT NULL,
  `kode_anggota` varchar(64) NOT NULL,
  `user_id` int(11) NOT NULL,
  `tempat_lahir` varchar(64) DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `jenis_kelamin` varchar(64) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `anggota`
--

INSERT INTO `anggota` (`id`, `kode_anggota`, `user_id`, `tempat_lahir`, `tanggal_lahir`, `jenis_kelamin`) VALUES
(4, 'AGT997', 180, 'bandung', '2000-12-12', 'Laki-laki'),
(5, 'AGT60', 938, '123', '2023-06-03', 'Laki-laki'),
(6, 'AGT859', 777, 'coba', '2023-06-03', 'Laki-laki'),
(7, 'AGT869', 49, 'asdadaew', '2023-06-05', 'Laki-laki'),
(8, 'AGT913', 173, 'asdasd', '2023-06-05', 'Laki-laki'),
(9, 'AGT733', 134, 'tes', '2023-06-25', 'Laki-laki'),
(10, 'AGT12', 956, 'Bandung', '1954-04-25', 'Laki-laki'),
(11, 'AGT986', 66, 'Bandung', '1999-09-05', 'Laki-laki'),
(12, 'AGT549', 547, NULL, NULL, NULL),
(13, 'AGT574', 385, NULL, NULL, NULL),
(14, 'AGT890', 556, NULL, NULL, NULL),
(15, 'AGT732', 144, NULL, NULL, NULL),
(16, 'AGT987', 56, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `aplikasi`
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
-- Dumping data untuk tabel `aplikasi`
--

INSERT INTO `aplikasi` (`id`, `nama_owner`, `alamat`, `tlp`, `title`, `nama_aplikasi`, `logo`, `copy_right`, `versi`, `tahun`) VALUES
(1, 'Dani', 'JL. nin aja ya', '0812-9936-9059', 'Koprasi', 'KOPRASI', NULL, 'Copy Right ©', '1.0.0.0', '2022');

-- --------------------------------------------------------

--
-- Struktur dari tabel `bulan`
--

CREATE TABLE `bulan` (
  `id_bulan` varchar(5) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `nama_bulan` varchar(10) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `val` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `bulan`
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
-- Struktur dari tabel `coa_aktivitas`
--

CREATE TABLE `coa_aktivitas` (
  `kode` char(10) NOT NULL,
  `nama` varchar(150) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data untuk tabel `coa_aktivitas`
--

INSERT INTO `coa_aktivitas` (`kode`, `nama`, `created_at`, `updated_at`) VALUES
('AC.01', 'Aktivitas Operasi', '2023-01-14 14:17:31', '2023-01-14 14:17:31'),
('AC.02', 'Aktivitas Investasi', '2023-01-14 14:17:44', '2023-01-14 14:17:44'),
('AC.03', 'Aktivitas Pendanaan', '2023-01-14 14:17:53', '2023-01-14 14:17:53');

-- --------------------------------------------------------

--
-- Struktur dari tabel `coa_head`
--

CREATE TABLE `coa_head` (
  `kode` char(10) NOT NULL,
  `nama` varchar(150) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data untuk tabel `coa_head`
--

INSERT INTO `coa_head` (`kode`, `nama`, `created_at`, `updated_at`) VALUES
('1', 'Aktiva', '2023-01-14 14:20:24', '2023-01-14 14:20:24'),
('2', 'Pasiva', '2023-01-14 14:20:33', '2023-01-14 14:20:33'),
('3', 'Modal', '2023-01-14 14:20:37', '2023-01-14 14:20:37'),
('4', 'Pendapatan', '2023-01-14 14:20:46', '2023-01-14 14:20:46'),
('5', 'HPP', '2023-01-14 14:20:50', '2023-07-07 10:41:34'),
('6', 'Beban', '2023-07-07 10:41:30', '2023-07-07 10:41:30');

-- --------------------------------------------------------

--
-- Struktur dari tabel `coa_items`
--

CREATE TABLE `coa_items` (
  `kode` varchar(20) NOT NULL,
  `nama` varchar(150) NOT NULL,
  `dc` char(2) NOT NULL,
  `posted` varchar(50) NOT NULL,
  `sub_id` varchar(20) NOT NULL,
  `activity_id` char(10) DEFAULT NULL COMMENT 'aktivitas arus kas jika ada',
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data untuk tabel `coa_items`
--

INSERT INTO `coa_items` (`kode`, `nama`, `dc`, `posted`, `sub_id`, `activity_id`, `created_at`, `updated_at`) VALUES
('1101', 'Kas', 'd', 'nrc', '11', NULL, '2023-01-14 20:19:02', '2023-01-14 20:19:02'),
('1102', 'Bank', 'd', 'nrc', '11', NULL, '2023-01-14 20:19:28', '2023-07-06 21:46:18'),
('1103', 'Piutang Anggota', 'd', 'nrc', '11', 'AC.01', '2023-01-14 20:19:46', '2023-07-07 17:40:12'),
('1104', 'Persediaan Barang Dagang', 'd', 'nrc', '11', 'AC.01', '2023-07-07 17:37:33', '2023-07-07 17:37:33'),
('1201', 'Tanah', 'd', 'nrc', '12', 'AC.02', '2023-01-14 20:32:02', '2023-01-14 20:32:02'),
('1202', 'Peralatan Kantor', 'd', 'nrc', '12', 'AC.02', '2023-01-14 21:30:32', '2023-01-14 21:48:49'),
('3101', 'Modal Usaha', 'c', 'nrc', '11', 'AC.03', '2023-01-14 20:30:25', '2023-01-14 20:30:25'),
('3201', 'Simpanan Pokok', 'c', 'nrc', '32', 'AC.03', '2023-07-07 10:53:15', '2023-07-07 10:53:15'),
('3202', 'Simpanan Wajib', 'c', 'nrc', '32', 'AC.03', '2023-07-07 10:53:42', '2023-07-07 10:53:42'),
('3203', 'Simpanan Manasuka', 'c', 'nrc', '32', 'AC.03', '2023-07-07 10:54:02', '2023-07-07 10:54:02'),
('4101', 'Pendapatan Usaha', 'c', 'l/r', '41', 'AC.01', '2023-01-14 20:22:23', '2023-01-14 20:22:23'),
('4102', 'Pendapatan Akad Murabahah', 'c', 'l/r', '41', 'AC.01', '2023-01-14 20:22:45', '2023-07-07 17:44:55'),
('4103', 'Margin Akad Murabahah', 'c', 'l/r', '41', 'AC.01', '2023-07-07 17:46:10', '2023-07-07 17:46:10'),
('4104', 'Pendapatan Adm Akad Murabahah', 'c', 'l/r', '41', 'AC.01', '2023-07-07 17:46:56', '2023-07-07 17:46:56'),
('5101', 'Harga Pokok Penjualan', 'd', 'l/r', '51', NULL, '2023-07-07 17:43:37', '2023-07-07 17:43:37'),
('6101', 'Beban Listrik', 'd', 'l/r', '61        ', 'AC.01', '2023-01-14 20:31:08', '2023-07-07 10:42:41'),
('6102', 'Beban Air', 'd', 'l/r', '61        ', 'AC.01', '2023-01-14 21:13:04', '2023-07-07 10:42:45'),
('6103', 'Beban Gaji Karyawan', 'd', 'l/r', '61        ', 'AC.01', '2023-01-14 21:18:19', '2023-07-07 10:42:48'),
('6104', 'Beban Promosi dan Iklan', 'd', 'l/r', '61        ', 'AC.01', '2023-01-14 21:23:09', '2023-07-07 10:42:51'),
('6105', 'Beban Administrasi & Umum', 'd', 'l/r', '61        ', 'AC.01', '2023-01-14 21:24:16', '2023-07-07 10:42:53'),
('6106', 'Beban Konsumsi', 'd', 'l/r', '61        ', 'AC.01', '2023-01-15 00:52:35', '2023-07-07 10:42:56');

-- --------------------------------------------------------

--
-- Struktur dari tabel `coa_subhead`
--

CREATE TABLE `coa_subhead` (
  `kode` char(10) NOT NULL,
  `nama` varchar(150) NOT NULL,
  `head_id` char(10) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data untuk tabel `coa_subhead`
--

INSERT INTO `coa_subhead` (`kode`, `nama`, `head_id`, `created_at`, `updated_at`) VALUES
('11', 'Aktiva Lancar', '1', '2023-01-14 14:21:05', '2023-01-15 03:57:40'),
('12', 'Aktiva Tetap', '1', '2023-01-14 14:21:12', '2023-01-15 03:57:42'),
('13', 'Aktiva Tidak Berwujud', '1', '2023-01-14 14:21:33', '2023-01-15 03:57:43'),
('21', 'Kewajiban Jangka Pendek', '2', '2023-01-14 14:21:43', '2023-01-15 03:57:44'),
('22', 'Kewajiban Jangka Pendek', '2', '2023-01-14 14:21:50', '2023-01-15 03:57:45'),
('31', 'Modal', '3', '2023-01-14 14:21:54', '2023-01-15 03:57:47'),
('32', 'Simpanan', '3', '2023-01-14 14:21:54', '2023-01-15 03:57:47'),
('41', 'Pendapatan Usaha', '4', '2023-01-14 14:22:01', '2023-01-15 03:57:49'),
('51', 'Harga Pokok Penjualan', '5', '2023-07-07 10:42:11', '2023-07-07 10:42:11'),
('61', 'Beban Operasional', '6', '2023-01-14 14:22:06', '2023-07-07 10:42:14'),
('62', 'Beban Non Operasional', '6', '2023-01-14 14:22:18', '2023-07-07 10:42:16');

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_pembiayaan`
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

--
-- Dumping data untuk tabel `detail_pembiayaan`
--

INSERT INTO `detail_pembiayaan` (`id`, `pembiayaan_id`, `angsuran_ke`, `jumlah_angsuran`, `tgl_pembayaran`, `order_id`, `payment_type`, `status_message`, `transaction_id`, `transaction_status`, `transaction_time`, `bank`, `va_number`, `pdf_url`, `status`) VALUES
(79, 11, 1, 916666, NULL, '', '', '', '', '', '', '', '', '', 'Belum Dibayar'),
(80, 11, 2, 916666, NULL, '', '', '', '', '', '', '', '', '', 'Belum Dibayar'),
(81, 11, 3, 916666, NULL, '', '', '', '', '', '', '', '', '', 'Belum Dibayar'),
(82, 11, 4, 916666, NULL, '', '', '', '', '', '', '', '', '', 'Belum Dibayar'),
(83, 11, 5, 916666, NULL, '', '', '', '', '', '', '', '', '', 'Belum Dibayar'),
(84, 11, 6, 916666, NULL, '', '', '', '', '', '', '', '', '', 'Belum Dibayar'),
(85, 11, 7, 916666, NULL, '', '', '', '', '', '', '', '', '', 'Belum Dibayar'),
(86, 11, 8, 916666, NULL, '', '', '', '', '', '', '', '', '', 'Belum Dibayar'),
(87, 11, 9, 916666, NULL, '', '', '', '', '', '', '', '', '', 'Belum Dibayar'),
(88, 11, 10, 916666, NULL, '', '', '', '', '', '', '', '', '', 'Belum Dibayar'),
(89, 11, 11, 916666, NULL, '', '', '', '', '', '', '', '', '', 'Belum Dibayar'),
(90, 11, 12, 916666, NULL, '', '', '', '', '', '', '', '', '', 'Belum Dibayar'),
(91, 12, 1, 550000, NULL, '', '', '', '', '', '', '', '', '', 'Belum Dibayar'),
(92, 12, 2, 550000, NULL, '', '', '', '', '', '', '', '', '', 'Belum Dibayar'),
(93, 12, 3, 550000, NULL, '', '', '', '', '', '', '', '', '', 'Belum Dibayar'),
(94, 12, 4, 550000, NULL, '', '', '', '', '', '', '', '', '', 'Belum Dibayar'),
(95, 12, 5, 550000, NULL, '', '', '', '', '', '', '', '', '', 'Belum Dibayar'),
(96, 12, 6, 550000, NULL, '', '', '', '', '', '', '', '', '', 'Belum Dibayar'),
(97, 12, 7, 550000, NULL, '', '', '', '', '', '', '', '', '', 'Belum Dibayar'),
(98, 12, 8, 550000, NULL, '', '', '', '', '', '', '', '', '', 'Belum Dibayar'),
(99, 12, 9, 550000, NULL, '', '', '', '', '', '', '', '', '', 'Belum Dibayar'),
(100, 12, 10, 550000, NULL, '', '', '', '', '', '', '', '', '', 'Belum Dibayar');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jurnal_umum`
--

CREATE TABLE `jurnal_umum` (
  `jurnal_id` bigint(50) UNSIGNED NOT NULL,
  `tanggal` date NOT NULL,
  `periode` int(11) NOT NULL,
  `no_bukti` varchar(50) NOT NULL,
  `kode_akun` varchar(20) NOT NULL,
  `deskripsi` varchar(255) DEFAULT NULL,
  `dc` char(2) NOT NULL COMMENT 'd/c',
  `nominal` double NOT NULL,
  `trans_ref` varchar(100) NOT NULL COMMENT 'Keterangan Asal Transaksi',
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data untuk tabel `jurnal_umum`
--

INSERT INTO `jurnal_umum` (`jurnal_id`, `tanggal`, `periode`, `no_bukti`, `kode_akun`, `deskripsi`, `dc`, `nominal`, `trans_ref`, `created_at`, `updated_at`) VALUES
(1, '2023-01-01', 202301, 'TRX-MN-0001.001', '1101', 'Input Manual Modal Usaha', 'd', 100000000, 'MANUAL', '2023-01-15 04:25:54', '2023-01-15 04:26:30'),
(2, '2023-01-01', 202301, 'TRX-MN-0001.001', '3101', 'Input Manual Modal Usaha', 'c', 100000000, 'MANUAL', '2023-01-15 04:25:54', '2023-01-15 04:26:30'),
(3, '2023-01-14', 202301, 'TRX-KK-202301.0001', '6101', 'Beli token Listrik', 'd', 150000, 'PENGELUARAN', '2023-01-25 02:23:34', '2023-01-25 02:24:33'),
(4, '2023-01-14', 202301, 'TRX-KK-202301.0001', '1101', 'Beli token Listrik', 'c', 150000, 'PENGELUARAN', '2023-01-25 02:23:34', '2023-01-25 02:24:33'),
(9, '2023-01-15', 202301, 'TRX-KK-202301.0002', '6103', 'Bayar Gaji karyawan Bulan Januari', 'd', 60000000, 'PENGELUARAN', '2023-01-25 02:55:02', '2023-01-25 02:55:02'),
(10, '2023-01-15', 202301, 'TRX-KK-202301.0002', '1101', 'Bayar Gaji karyawan Bulan Januari', 'c', 60000000, 'PENGELUARAN', '2023-01-25 02:55:02', '2023-01-25 02:55:02'),
(11, '2023-01-16', 202301, 'TRX-KK-202301.0003', '6105', 'Beli Kertas HVS', 'd', 2000000, 'PENGELUARAN', '2023-01-25 02:55:41', '2023-01-25 02:55:41'),
(12, '2023-01-16', 202301, 'TRX-KK-202301.0003', '1101', 'Beli Kertas HVS', 'c', 2000000, 'PENGELUARAN', '2023-01-25 02:55:41', '2023-01-25 02:55:41'),
(13, '2023-02-01', 202302, 'TRX-KK-202302.0001', '6101', 'Pembelian Token Listrik', 'd', 450000, 'PENGELUARAN', '2023-02-02 12:50:30', '2023-02-02 12:50:30'),
(14, '2023-02-01', 202302, 'TRX-KK-202302.0001', '1101', 'Pembelian Token Listrik', 'c', 450000, 'PENGELUARAN', '2023-02-02 12:50:30', '2023-02-02 12:50:30'),
(15, '2023-07-07', 202307, 'TRX-POKOK-1426906036', '1102', 'Pembayaran Simpanan Pokok Anggota - 66', 'd', 100000, 'SIMPANAN POKOK', '2023-07-07 05:40:26', '2023-07-07 05:40:26'),
(16, '2023-07-07', 202307, 'TRX-POKOK-1426906036', '3201', 'Pembayaran Simpanan Pokok Anggota - 66', 'c', 100000, 'SIMPANAN POKOK', '2023-07-07 05:40:26', '2023-07-07 05:40:26'),
(17, '2023-07-07', 202307, 'TRX-MANASUKA-1538812254', '1102', 'Pembayaran Simpanan Manasuka Anggota - 66', 'd', 500000, 'SIMPANAN MANASUKA', '2023-07-07 05:57:36', '2023-07-07 05:57:36'),
(18, '2023-07-07', 202307, 'TRX-MANASUKA-1538812254', '3203', 'Pembayaran Simpanan Manasuka Anggota - 66', 'c', 500000, 'SIMPANAN MANASUKA', '2023-07-07 05:57:36', '2023-07-07 05:57:36'),
(19, '2023-07-22', 202307, 'TRX-MANASUKA-687458768', '1102', 'Pembayaran Simpanan Manasuka Anggota - 565', 'd', 400000, 'SIMPANAN MANASUKA', '2023-07-22 07:53:47', '2023-07-22 07:53:47'),
(20, '2023-07-22', 202307, 'TRX-MANASUKA-687458768', '3203', 'Pembayaran Simpanan Manasuka Anggota - 565', 'c', 400000, 'SIMPANAN MANASUKA', '2023-07-22 07:53:47', '2023-07-22 07:53:47'),
(21, '2023-07-22', 202307, 'TRX-MANASUKA-1955977803', '1102', 'Pembayaran Simpanan Manasuka Anggota - 42', 'd', 400000, 'SIMPANAN MANASUKA', '2023-07-22 07:59:19', '2023-07-22 07:59:19'),
(22, '2023-07-22', 202307, 'TRX-MANASUKA-1955977803', '3203', 'Pembayaran Simpanan Manasuka Anggota - 42', 'c', 400000, 'SIMPANAN MANASUKA', '2023-07-22 07:59:19', '2023-07-22 07:59:19'),
(23, '2023-07-22', 202307, 'TRX-MANASUKA-329103237', '1102', 'Pembayaran Simpanan Manasuka Anggota - 42', 'd', 123000, 'SIMPANAN MANASUKA', '2023-07-22 08:03:36', '2023-07-22 08:03:36'),
(24, '2023-07-22', 202307, 'TRX-MANASUKA-329103237', '3203', 'Pembayaran Simpanan Manasuka Anggota - 42', 'c', 123000, 'SIMPANAN MANASUKA', '2023-07-22 08:03:36', '2023-07-22 08:03:36'),
(25, '2023-07-22', 202307, 'TRX-MANASUKA-521740767', '1102', 'Pembayaran Simpanan Manasuka Anggota - 565', 'd', 456000, 'SIMPANAN MANASUKA', '2023-07-22 08:53:35', '2023-07-22 08:53:35'),
(26, '2023-07-22', 202307, 'TRX-MANASUKA-521740767', '3203', 'Pembayaran Simpanan Manasuka Anggota - 565', 'c', 456000, 'SIMPANAN MANASUKA', '2023-07-22 08:53:35', '2023-07-22 08:53:35'),
(27, '2023-07-22', 202307, 'TRX-POKOK-1401526605', '1102', 'Pembayaran Simpanan Pokok Anggota - 385', 'd', 100000, 'SIMPANAN POKOK', '2023-07-22 10:23:17', '2023-07-22 10:23:17'),
(28, '2023-07-22', 202307, 'TRX-POKOK-1401526605', '3201', 'Pembayaran Simpanan Pokok Anggota - 385', 'c', 100000, 'SIMPANAN POKOK', '2023-07-22 10:23:17', '2023-07-22 10:23:17'),
(29, '2023-07-22', 202307, 'TRX-WAJIB-541782686', '1102', 'Pembayaran Simpanan Wajib Anggota - 385', 'd', 50000, 'SIMPANAN WAJIB', '2023-07-22 10:23:58', '2023-07-22 10:23:58'),
(30, '2023-07-22', 202307, 'TRX-WAJIB-541782686', '3202', 'Pembayaran Simpanan Wajib Anggota - 385', 'c', 50000, 'SIMPANAN WAJIB', '2023-07-22 10:23:58', '2023-07-22 10:23:58'),
(31, '2023-07-22', 202307, 'TRX-WAJIB-678182986', '1102', 'Pembayaran Simpanan Wajib Anggota - 565', 'd', 50000, 'SIMPANAN WAJIB', '2023-07-22 13:48:11', '2023-07-22 13:48:11'),
(32, '2023-07-22', 202307, 'TRX-WAJIB-678182986', '3202', 'Pembayaran Simpanan Wajib Anggota - 565', 'c', 50000, 'SIMPANAN WAJIB', '2023-07-22 13:48:11', '2023-07-22 13:48:11'),
(33, '2023-07-23', 202307, 'TRX-POKOK-1803074184', '1102', 'Pembayaran Simpanan Pokok Anggota - 547', 'd', 100000, 'SIMPANAN POKOK', '2023-07-23 08:35:54', '2023-07-23 08:35:54'),
(34, '2023-07-23', 202307, 'TRX-POKOK-1803074184', '3201', 'Pembayaran Simpanan Pokok Anggota - 547', 'c', 100000, 'SIMPANAN POKOK', '2023-07-23 08:35:54', '2023-07-23 08:35:54'),
(35, '2023-07-23', 202307, 'TRX-POKOK-1086780280', '1102', 'Pembayaran Simpanan Pokok Anggota - 556', 'd', 100000, 'SIMPANAN POKOK', '2023-07-23 08:56:01', '2023-07-23 08:56:01'),
(36, '2023-07-23', 202307, 'TRX-POKOK-1086780280', '3201', 'Pembayaran Simpanan Pokok Anggota - 556', 'c', 100000, 'SIMPANAN POKOK', '2023-07-23 08:56:01', '2023-07-23 08:56:01'),
(37, '2023-07-23', 202307, 'TRX-POKOK-366834', '1102', 'Pembayaran Simpanan Pokok Anggota - 144', 'd', 100000, 'SIMPANAN POKOK', '2023-07-23 09:28:57', '2023-07-23 09:28:57'),
(38, '2023-07-23', 202307, 'TRX-POKOK-366834', '3201', 'Pembayaran Simpanan Pokok Anggota - 144', 'c', 100000, 'SIMPANAN POKOK', '2023-07-23 09:28:57', '2023-07-23 09:28:57'),
(39, '2023-07-23', 202307, 'TRX-WAJIB-8120515', '1102', 'Pembayaran Simpanan Wajib Anggota - 547', 'd', 50000, 'SIMPANAN WAJIB', '2023-07-23 15:50:04', '2023-07-23 15:50:04'),
(40, '2023-07-23', 202307, 'TRX-WAJIB-8120515', '3202', 'Pembayaran Simpanan Wajib Anggota - 547', 'c', 50000, 'SIMPANAN WAJIB', '2023-07-23 15:50:04', '2023-07-23 15:50:04'),
(41, '2023-07-23', 202307, 'TRX-POKOK-190698599', '1102', 'Pembayaran Simpanan Pokok Anggota - 56', 'd', 100000, 'SIMPANAN POKOK', '2023-07-23 16:00:09', '2023-07-23 16:00:09'),
(42, '2023-07-23', 202307, 'TRX-POKOK-190698599', '3201', 'Pembayaran Simpanan Pokok Anggota - 56', 'c', 100000, 'SIMPANAN POKOK', '2023-07-23 16:00:09', '2023-07-23 16:00:09');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori_pengeluaran`
--

CREATE TABLE `kategori_pengeluaran` (
  `kode` varchar(20) NOT NULL,
  `nama` varchar(150) NOT NULL,
  `akun_pengeluaran` varchar(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data untuk tabel `kategori_pengeluaran`
--

INSERT INTO `kategori_pengeluaran` (`kode`, `nama`, `akun_pengeluaran`, `created_at`, `updated_at`) VALUES
('KK-0001', 'Pembelian Aset Berupa Tanah', '1201', '2023-01-14 13:12:09', '2023-01-14 13:12:09'),
('KK-0002', 'Pembayaran Token Listrik', '6101', '2023-01-14 13:12:33', '2023-01-14 13:12:33'),
('KK-0003', 'Pembayaran Tagihan PDAM (Rekening Air)', '6102', '2023-01-14 13:13:29', '2023-01-14 13:15:37'),
('KK-0004', 'Pembayaran Gaji Karyawan', '6103', '2023-01-14 13:18:35', '2023-01-14 13:18:35'),
('KK-0005', 'Pembayaran Biaya Promosi atau Iklan', '6104', '2023-01-14 13:23:31', '2023-01-14 13:23:31'),
('KK-0006', 'Pembelian ATK', '6105', '2023-01-14 13:24:30', '2023-01-14 13:24:30'),
('KK-0007', 'Pembelian Peralatan Kantor', '1202', '2023-01-14 13:31:10', '2023-01-14 13:31:10'),
('KK-0008', 'Pemeblian Konsumsi untuk Rapat', '6106', '2023-01-14 16:55:54', '2023-01-14 16:55:54'),
('KK-0009', 'Pembelian Konsumsi untuk Security', '6106', '2023-02-01 22:47:41', '2023-02-01 22:47:41');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembiayaan`
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

--
-- Dumping data untuk tabel `pembiayaan`
--

INSERT INTO `pembiayaan` (`id`, `user_id`, `kode_pembiayaan`, `tgl_pembiayaan`, `tgl_pelunasan`, `nama_barang`, `jenis_pembiayaan`, `jumlah_pembiayaan`, `angsuran`, `margin`, `biaya_administrasi`, `total_angsuran`, `total_pembiayaan`, `status`, `status_pembiayaan`) VALUES
(11, 66, 'PMB89', '2023-07-07', NULL, '', 'Murabahah', 10000000, 12, 10, 340000, 916666, 11339992, 'Belum Lunas', 'Menunggu Persetujuan'),
(12, 565, 'PMB817', '2023-07-22', NULL, '', 'Murabahah', 5000000, 10, 10, 340000, 550000, 5840000, 'Belum Lunas', 'Menunggu Persetujuan');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengeluaran`
--

CREATE TABLE `pengeluaran` (
  `kode` varchar(50) NOT NULL,
  `tanggal` date NOT NULL,
  `periode` int(11) NOT NULL,
  `kode_kategori` varchar(20) NOT NULL COMMENT 'Kategori Pengeluaran',
  `deskripsi` varchar(255) DEFAULT NULL,
  `nominal` double DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data untuk tabel `pengeluaran`
--

INSERT INTO `pengeluaran` (`kode`, `tanggal`, `periode`, `kode_kategori`, `deskripsi`, `nominal`, `created_at`, `updated_at`) VALUES
('TRX-KK-202301.0001', '2023-01-14', 202301, 'KK-0002', 'Beli token Listrik', 150000, '2023-01-25 02:23:34', '2023-01-25 02:23:34'),
('TRX-KK-202301.0002', '2023-01-15', 202301, 'KK-0004', 'Bayar Gaji karyawan Bulan Januari', 60000000, '2023-01-25 02:25:09', '2023-01-25 02:55:02'),
('TRX-KK-202301.0003', '2023-01-16', 202301, 'KK-0006', 'Beli Kertas HVS', 2000000, '2023-01-25 02:55:41', '2023-01-25 02:55:41'),
('TRX-KK-202302.0001', '2023-02-01', 202302, 'KK-0002', 'Pembelian Token Listrik', 450000, '2023-02-02 12:50:30', '2023-02-02 12:50:30');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengurus`
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
-- Dumping data untuk tabel `pengurus`
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
-- Struktur dari tabel `riwayat_manasuka`
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
-- Struktur dari tabel `riwayat_simpanan`
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
-- Dumping data untuk tabel `riwayat_simpanan`
--

INSERT INTO `riwayat_simpanan` (`id`, `id_sim_wajib`, `id_user`, `id_bulan`, `tahun`, `nominal`, `tgl_bayar`, `order_id`, `pdf_url`, `status`, `created_at`, `updated_at`) VALUES
(3, 2, 568, 1, '2023', 200000, '2023-01-23 12:53:35', 1234883958, 'https://app.sandbox.midtrans.com/snap/v1/transactions/946eaf53-435b-43c3-9734-c39e43ed3882/pdf', 201, '2023-01-23 12:53:35', '0000-00-00 00:00:00'),
(4, 2, 568, 2, '2023', 100000, '2023-01-23 12:59:20', 812466061, 'https://app.sandbox.midtrans.com/snap/v1/transactions/c96861ce-7250-4c18-9eab-f4a85fe52986/pdf', 201, '2023-01-23 12:59:20', '0000-00-00 00:00:00'),
(5, 1, 11, 1, '2023', 50000, '2023-01-23 17:47:55', 1743257830, 'https://app.sandbox.midtrans.com/snap/v1/transactions/52a127fa-46f3-4ea6-ad0b-19b870d442a1/pdf', 201, '2023-01-23 17:47:55', '0000-00-00 00:00:00'),
(6, 1, 11, 2, '2023', 100000, '2023-01-23 17:56:54', 328196453, 'https://app.sandbox.midtrans.com/snap/v1/transactions/87246ec5-0acf-4b7e-a350-ef98e568ef39/pdf', 201, '2023-01-23 17:56:54', '0000-00-00 00:00:00'),
(7, 2, 568, 3, '2023', 50000, '2023-01-24 20:13:35', 1687569164, 'https://app.sandbox.midtrans.com/snap/v1/transactions/8af8ed71-28a1-4f3a-adda-fcd3c136dfa6/pdf', 201, '2023-01-24 20:13:35', '0000-00-00 00:00:00'),
(8, 10, 775, 1, '2023', 50000, '2023-01-24 21:07:23', 1510929542, 'https://app.sandbox.midtrans.com/snap/v1/transactions/84eab69c-2172-457b-9dcd-6928cec24725/pdf', 201, '2023-01-24 21:07:23', '0000-00-00 00:00:00'),
(9, 10, 775, 2, '2023', 50000, '2023-01-31 15:15:37', 179779320, 'https://app.sandbox.midtrans.com/snap/v1/transactions/b9456233-9f1d-4b3a-a858-209b62c8623d/pdf', 201, '2023-01-31 15:15:37', '0000-00-00 00:00:00'),
(10, 11, 565, 1, '2023', 50000, '2023-01-31 15:37:49', 352523422, 'https://app.sandbox.midtrans.com/snap/v1/transactions/22678ff8-3f39-4f99-8876-40547d3460fb/pdf', 500, '2023-01-31 15:37:49', '0000-00-00 00:00:00'),
(11, 23, 385, 1, '2023', 50000, '2023-07-22 17:23:58', 541782686, 'https://app.sandbox.midtrans.com/snap/v1/transactions/12cf2efd-999d-42a4-af88-160b7a721ae4/pdf', 200, '2023-07-22 17:23:58', '0000-00-00 00:00:00'),
(12, 11, 565, 2, '2023', 50000, '2023-07-22 20:48:11', 678182986, 'https://app.sandbox.midtrans.com/snap/v1/transactions/231da7a0-e7a7-4e06-b69e-37e333b1f393/pdf', 200, '2023-07-22 20:48:11', '0000-00-00 00:00:00'),
(13, 22, 547, 1, '2023', 50000, '2023-07-23 22:50:04', 8120515, 'https://app.sandbox.midtrans.com/snap/v1/transactions/ce0a4bfd-89cc-4210-8844-49174c27cecc/pdf', 200, '2023-07-23 22:50:04', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `simpanan_manasuka`
--

CREATE TABLE `simpanan_manasuka` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_admin` int(11) DEFAULT NULL,
  `nominal` int(11) DEFAULT NULL,
  `tgl_bayar` datetime DEFAULT NULL,
  `status` int(11) NOT NULL COMMENT '1=lunas, 2=pending\r\n',
  `jenis` varchar(30) NOT NULL,
  `metode_pembayaran` varchar(10) DEFAULT NULL,
  `order_id` int(20) DEFAULT NULL,
  `pdf_url` varchar(250) DEFAULT NULL,
  `nama_penerima` varchar(260) DEFAULT NULL,
  `nama_bank` varchar(100) DEFAULT NULL,
  `no_rekening` varchar(200) DEFAULT NULL,
  `nominal_tarik` int(11) DEFAULT NULL,
  `tgl_penarikan` datetime DEFAULT NULL,
  `image` varchar(400) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `simpanan_manasuka`
--

INSERT INTO `simpanan_manasuka` (`id`, `id_user`, `id_admin`, `nominal`, `tgl_bayar`, `status`, `jenis`, `metode_pembayaran`, `order_id`, `pdf_url`, `nama_penerima`, `nama_bank`, `no_rekening`, `nominal_tarik`, `tgl_penarikan`, `image`, `created_at`, `updated_at`) VALUES
(22, 42, NULL, 123000, '2023-07-22 15:03:36', 1, 'Masuk', 'Online', 329103237, 'https://app.sandbox.midtrans.com/snap/v1/transactions/bfa0c0a3-024b-4a82-b089-5b54db55a014/pdf', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(25, 42, 1, NULL, NULL, 1, 'Keluar', 'Transfer', NULL, NULL, 'DANI', 'BRI', '423524545', 100000, '2023-07-22 15:39:37', 'WhatsApp Image 2023-07-17 at 17.36.30.jpg', NULL, '2023-07-22 15:45:35'),
(26, 565, NULL, 456000, '2023-07-22 15:53:35', 1, 'Masuk', 'Online', 521740767, 'https://app.sandbox.midtrans.com/snap/v1/transactions/a3c34ac5-5240-4bcd-b14f-92a75c7c56e3/pdf', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(27, 565, 1, NULL, NULL, 1, 'Keluar', 'Transfer', NULL, NULL, 'DANI', 'BRI', '42342454254', 300000, '2023-07-22 16:10:07', 'Diagram Tanpa Judul.drawio (3).png', NULL, '2023-07-22 16:10:44');

-- --------------------------------------------------------

--
-- Struktur dari tabel `simpanan_pokok`
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
-- Dumping data untuk tabel `simpanan_pokok`
--

INSERT INTO `simpanan_pokok` (`id`, `id_user`, `kode_transaksi`, `nominal`, `status`, `tgl_bayar`, `metode_pembayaran`, `order_id`, `pdf_url`) VALUES
(1, 1, NULL, NULL, NULL, NULL, '', '', ''),
(42, 42, 'TRK563', 100000, '1', '2023-02-01 23:01:46', 'Online', '1173298241', 'https://app.sandbox.midtrans.com/snap/v1/transactions/25ec225b-e0be-403e-9aa3-696c28ab0580/pdf'),
(56, 56, 'TRK652', 100000, '1', '2023-07-23 23:00:09', 'Online', '190698599', 'https://app.sandbox.midtrans.com/snap/v1/transactions/37916c67-3299-4446-8524-b98f1d9a6004/pdf'),
(66, 66, 'TRK608', 100000, '1', '2023-07-07 12:40:26', 'Online', '1426906036', 'https://app.sandbox.midtrans.com/snap/v1/transactions/ad731930-1409-4a77-8be1-8cf9dd33e20e/pdf'),
(144, 144, 'TRK528', 100000, '1', '2023-07-23 16:28:57', 'Online', '366834', 'https://app.sandbox.midtrans.com/snap/v1/transactions/33646974-2411-4245-8ff3-745e0bc4a57d/pdf'),
(547, 547, 'TRK825', 100000, '1', '2023-07-23 15:35:54', 'Online', '1803074184', 'https://app.sandbox.midtrans.com/snap/v1/transactions/b2e195b4-838e-4459-b111-911583962ba5/pdf'),
(556, 556, 'TRK559', 100000, '1', '2023-07-23 15:56:01', 'Online', '1086780280', 'https://app.sandbox.midtrans.com/snap/v1/transactions/291c8388-268f-4d7f-aaf0-c057d6d6f55e/pdf'),
(565, 565, 'TRK698', 100000, '1', '2023-01-31 15:32:42', 'Online', '241028225', 'https://app.sandbox.midtrans.com/snap/v1/transactions/bde2f6f1-4bdf-4b6b-adbd-f34ea92fce9c/pdf');

-- --------------------------------------------------------

--
-- Struktur dari tabel `simpanan_wajib`
--

CREATE TABLE `simpanan_wajib` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `tahun` varchar(10) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `simpanan_wajib`
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
(18, 173, '2023', '2023-06-05 11:15:22', '0000-00-00 00:00:00'),
(20, 956, '2023', '2023-07-07 11:11:29', '0000-00-00 00:00:00'),
(21, 66, '2023', '2023-07-07 12:19:24', '0000-00-00 00:00:00'),
(22, 547, '2023', '2023-07-22 10:05:33', '0000-00-00 00:00:00'),
(24, 556, '2023', '2023-07-23 15:53:02', '0000-00-00 00:00:00'),
(25, 144, '2023', '2023-07-23 15:58:12', '0000-00-00 00:00:00'),
(26, 56, '2023', '2023-07-23 22:58:06', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
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
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id_user`, `username`, `full_name`, `password`, `nik`, `alamat`, `no_hp`, `tgl_registrasi`, `role`, `image`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'Administrator', '$2y$10$AUJVLREAPsG0hbAfngkVueXItUO6nK0iyfWxOvxlXoVRZf0N1QTJW', '1234567890123451', 'bandung', '081234567892', '0000-00-00 00:00:00', 1, 'anggota.png', '1', '0000-00-00 00:00:00', '2023-02-01 21:13:26'),
(6, 'user', 'anggota', '$2y$10$AUJVLREAPsG0hbAfngkVueXItUO6nK0iyfWxOvxlXoVRZf0N1QTJW', '', '', '', '0000-00-00 00:00:00', 2, 'user.jpg', '2', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(42, 'abran', 'tabrani', '$2y$10$dC9TFxnxU5gScQUGOvhBYeUI/U7cqblcJzL6LVP605n4515YTtTNS', '1234567890123455', '', '081234567893', '2023-02-01 23:01:17', 2, 'anggota.png', '1', '2023-02-01 23:01:17', '2023-07-22 13:27:39'),
(56, 'yanti', 'yanti', '$2y$10$/WQa6zDEYe3DEEkZKRDgd.YFv/mK4Llylkk.2ResCednXFUzdpUNa', '1234567890123456', '', '0812345678', '2023-07-23 22:57:48', 2, 'anggota.png', '1', '2023-07-23 22:57:48', '0000-00-00 00:00:00'),
(66, 'adit', 'Aditya', '$2y$10$lpgwuwAack9qCqQovzwwL.NngB.Aa.FWlZDoCiEqyA3NXpyc0Qvsu', '3201020509199900', '', '085111222333', '2023-07-07 12:19:12', 2, 'anggota.png', '1', '2023-07-07 12:19:12', '0000-00-00 00:00:00'),
(144, 'setia', 'setia', '$2y$10$z7cB5UL983H03DEWWq2MDO7rScnvzm/9iNUvtz/PrlMMZTAPsi0dy', '1234567890123456', '', '081234567890', '2023-07-23 15:58:01', 2, 'anggota.png', '1', '2023-07-23 15:58:01', '0000-00-00 00:00:00'),
(547, 'asd', 'asd', '$2y$10$2GqERuqLHKuP6pcFBu7OLe90FJx9cF32WG6JK5906YQynyR.7nB.6', '123413434', '', '23523525', '2023-07-22 00:25:54', 2, 'anggota.png', '1', '2023-07-22 00:25:54', '0000-00-00 00:00:00'),
(565, 'syahman', 'm syahman', '$2y$10$5sbU3BGsVP.emx4vpklQX.tLCgnuPyJ21ehcE4pRAbB/qt.bTuJ9i', '1234567890123457', 'Bandung', '081234567891', '2023-01-31 12:02:08', 2, 'anggota.png', '1', '2023-01-31 12:02:08', '2023-07-23 15:50:36');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `anggota`
--
ALTER TABLE `anggota`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `aplikasi`
--
ALTER TABLE `aplikasi`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `bulan`
--
ALTER TABLE `bulan`
  ADD PRIMARY KEY (`id_bulan`);

--
-- Indeks untuk tabel `coa_aktivitas`
--
ALTER TABLE `coa_aktivitas`
  ADD PRIMARY KEY (`kode`);

--
-- Indeks untuk tabel `coa_head`
--
ALTER TABLE `coa_head`
  ADD PRIMARY KEY (`kode`);

--
-- Indeks untuk tabel `coa_items`
--
ALTER TABLE `coa_items`
  ADD PRIMARY KEY (`kode`),
  ADD KEY `coa_items_sub_id_foreign` (`sub_id`),
  ADD KEY `activity_id` (`activity_id`);

--
-- Indeks untuk tabel `coa_subhead`
--
ALTER TABLE `coa_subhead`
  ADD PRIMARY KEY (`kode`),
  ADD KEY `head_id` (`head_id`);

--
-- Indeks untuk tabel `detail_pembiayaan`
--
ALTER TABLE `detail_pembiayaan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pembiayaan_detail_id` (`pembiayaan_id`);

--
-- Indeks untuk tabel `jurnal_umum`
--
ALTER TABLE `jurnal_umum`
  ADD PRIMARY KEY (`jurnal_id`),
  ADD KEY `kode_akun` (`kode_akun`);

--
-- Indeks untuk tabel `kategori_pengeluaran`
--
ALTER TABLE `kategori_pengeluaran`
  ADD PRIMARY KEY (`kode`),
  ADD KEY `akun_pengeluaran` (`akun_pengeluaran`);

--
-- Indeks untuk tabel `pembiayaan`
--
ALTER TABLE `pembiayaan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pengeluaran`
--
ALTER TABLE `pengeluaran`
  ADD PRIMARY KEY (`kode`),
  ADD KEY `kode_kategori` (`kode_kategori`);

--
-- Indeks untuk tabel `pengurus`
--
ALTER TABLE `pengurus`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `riwayat_manasuka`
--
ALTER TABLE `riwayat_manasuka`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `riwayat_simpanan`
--
ALTER TABLE `riwayat_simpanan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `simpanan_manasuka`
--
ALTER TABLE `simpanan_manasuka`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `simpanan_pokok`
--
ALTER TABLE `simpanan_pokok`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `simpanan_wajib`
--
ALTER TABLE `simpanan_wajib`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `anggota`
--
ALTER TABLE `anggota`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `aplikasi`
--
ALTER TABLE `aplikasi`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `detail_pembiayaan`
--
ALTER TABLE `detail_pembiayaan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT untuk tabel `jurnal_umum`
--
ALTER TABLE `jurnal_umum`
  MODIFY `jurnal_id` bigint(50) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT untuk tabel `pembiayaan`
--
ALTER TABLE `pembiayaan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `pengurus`
--
ALTER TABLE `pengurus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT untuk tabel `riwayat_manasuka`
--
ALTER TABLE `riwayat_manasuka`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `riwayat_simpanan`
--
ALTER TABLE `riwayat_simpanan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `simpanan_manasuka`
--
ALTER TABLE `simpanan_manasuka`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT untuk tabel `simpanan_pokok`
--
ALTER TABLE `simpanan_pokok`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=909;

--
-- AUTO_INCREMENT untuk tabel `simpanan_wajib`
--
ALTER TABLE `simpanan_wajib`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=957;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `coa_items`
--
ALTER TABLE `coa_items`
  ADD CONSTRAINT `coa_items_ibfk_1` FOREIGN KEY (`sub_id`) REFERENCES `coa_subhead` (`kode`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `coa_items_ibfk_2` FOREIGN KEY (`activity_id`) REFERENCES `coa_aktivitas` (`kode`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `coa_subhead`
--
ALTER TABLE `coa_subhead`
  ADD CONSTRAINT `coa_subhead_ibfk_1` FOREIGN KEY (`head_id`) REFERENCES `coa_head` (`kode`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `detail_pembiayaan`
--
ALTER TABLE `detail_pembiayaan`
  ADD CONSTRAINT `pembiayaan_detail_id` FOREIGN KEY (`pembiayaan_id`) REFERENCES `pembiayaan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `jurnal_umum`
--
ALTER TABLE `jurnal_umum`
  ADD CONSTRAINT `jurnal_umum_ibfk_1` FOREIGN KEY (`kode_akun`) REFERENCES `coa_items` (`kode`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `kategori_pengeluaran`
--
ALTER TABLE `kategori_pengeluaran`
  ADD CONSTRAINT `kategori_pengeluaran_ibfk_1` FOREIGN KEY (`akun_pengeluaran`) REFERENCES `coa_items` (`kode`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `pengeluaran`
--
ALTER TABLE `pengeluaran`
  ADD CONSTRAINT `pengeluaran_ibfk_1` FOREIGN KEY (`kode_kategori`) REFERENCES `kategori_pengeluaran` (`kode`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
