-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Waktu pembuatan: 07 Jul 2023 pada 10.49
-- Versi server: 5.7.32
-- Versi PHP: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `koperasi_db`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `anggota`
--

CREATE TABLE `anggota` (
  `id` int(11) NOT NULL,
  `kode_anggota` varchar(64) NOT NULL,
  `user_id` int(11) NOT NULL,
  `tempat_lahir` varchar(64) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `jenis_kelamin` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
(11, 'AGT986', 66, 'Bandung', '1999-09-05', 'Laki-laki');

-- --------------------------------------------------------

--
-- Struktur dari tabel `aplikasi`
--

CREATE TABLE `aplikasi` (
  `id` int(10) UNSIGNED NOT NULL,
  `nama_owner` varchar(100) DEFAULT NULL,
  `alamat` text,
  `tlp` varchar(50) DEFAULT NULL,
  `title` varchar(20) DEFAULT NULL,
  `nama_aplikasi` varchar(100) DEFAULT NULL,
  `logo` varchar(100) DEFAULT NULL,
  `copy_right` varchar(50) DEFAULT NULL,
  `versi` varchar(20) DEFAULT NULL,
  `tahun` year(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `aplikasi`
--

INSERT INTO `aplikasi` (`id`, `nama_owner`, `alamat`, `tlp`, `title`, `nama_aplikasi`, `logo`, `copy_right`, `versi`, `tahun`) VALUES
(1, 'Dani', 'JL. nin aja ya', '0812-9936-9059', 'Koprasi', 'KOPRASI', NULL, 'Copy Right ©', '1.0.0.0', 2022);

-- --------------------------------------------------------

--
-- Struktur dari tabel `bulan`
--

CREATE TABLE `bulan` (
  `id_bulan` varchar(5) CHARACTER SET latin1 NOT NULL,
  `nama_bulan` varchar(10) CHARACTER SET latin1 NOT NULL,
  `val` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
(90, 11, 12, 916666, NULL, '', '', '', '', '', '', '', '', '', 'Belum Dibayar');

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
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
(18, '2023-07-07', 202307, 'TRX-MANASUKA-1538812254', '3203', 'Pembayaran Simpanan Manasuka Anggota - 66', 'c', 500000, 'SIMPANAN MANASUKA', '2023-07-07 05:57:36', '2023-07-07 05:57:36');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori_pengeluaran`
--

CREATE TABLE `kategori_pengeluaran` (
  `kode` varchar(20) NOT NULL,
  `nama` varchar(150) NOT NULL,
  `akun_pengeluaran` varchar(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pembiayaan`
--

INSERT INTO `pembiayaan` (`id`, `user_id`, `kode_pembiayaan`, `tgl_pembiayaan`, `tgl_pelunasan`, `nama_barang`, `jenis_pembiayaan`, `jumlah_pembiayaan`, `angsuran`, `margin`, `biaya_administrasi`, `total_angsuran`, `total_pembiayaan`, `status`, `status_pembiayaan`) VALUES
(11, 66, 'PMB89', '2023-07-07', NULL, '', 'Murabahah', 10000000, 12, 10, 340000, 916666, 11339992, 'Belum Lunas', 'Menunggu Persetujuan');

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
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
(10, 11, 565, 1, '2023', 50000, '2023-01-31 15:37:49', 352523422, 'https://app.sandbox.midtrans.com/snap/v1/transactions/22678ff8-3f39-4f99-8876-40547d3460fb/pdf', 201, '2023-01-31 15:37:49', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `simpanan_manasuka`
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `simpanan_manasuka`
--

INSERT INTO `simpanan_manasuka` (`id`, `id_user`, `nominal`, `tgl_bayar`, `status`, `metode_pembayaran`, `order_id`, `pdf_url`) VALUES
(11, 565, 100000, '2023-01-31 20:24:20', 1, 'Online', 563732379, 'https://app.sandbox.midtrans.com/snap/v1/transactions/c6bffe61-6ac4-4388-a8c8-cb9ec45e024c/pdf'),
(12, 565, 50000, '2023-02-01 21:08:05', 1, 'Online', 136139995, 'https://app.sandbox.midtrans.com/snap/v1/transactions/5f757dd4-2515-45ac-ad1d-297555b46b1a/pdf'),
(13, 66, 500000, '2023-07-07 12:57:36', 1, 'Online', 1538812254, 'https://app.sandbox.midtrans.com/snap/v1/transactions/94189f3c-693e-4b81-9abb-11e634fd15e4/pdf');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `simpanan_pokok`
--

INSERT INTO `simpanan_pokok` (`id`, `id_user`, `kode_transaksi`, `nominal`, `status`, `tgl_bayar`, `metode_pembayaran`, `order_id`, `pdf_url`) VALUES
(1, 1, NULL, NULL, NULL, NULL, '', '', ''),
(42, 42, 'TRK563', 50000, '1', '2023-02-01 23:01:46', 'Online', '1173298241', 'https://app.sandbox.midtrans.com/snap/v1/transactions/25ec225b-e0be-403e-9aa3-696c28ab0580/pdf'),
(66, 66, 'TRK608', 100000, '1', '2023-07-07 12:40:26', 'Online', '1426906036', 'https://app.sandbox.midtrans.com/snap/v1/transactions/ad731930-1409-4a77-8be1-8cf9dd33e20e/pdf'),
(565, 565, 'TRK698', 50000, '1', '2023-01-31 15:32:42', 'Online', '241028225', 'https://app.sandbox.midtrans.com/snap/v1/transactions/bde2f6f1-4bdf-4b6b-adbd-f34ea92fce9c/pdf'),
(888, 775, 'TRK254', 50000, '1', NULL, 'Online', NULL, '');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
(21, 66, '2023', '2023-07-07 12:19:24', '0000-00-00 00:00:00');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id_user`, `username`, `full_name`, `password`, `nik`, `alamat`, `no_hp`, `tgl_registrasi`, `role`, `image`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'Administrator', '$2y$10$AUJVLREAPsG0hbAfngkVueXItUO6nK0iyfWxOvxlXoVRZf0N1QTJW', '1234567890123451', 'bandung', '081234567892', '0000-00-00 00:00:00', 1, 'anggota.png', '1', '0000-00-00 00:00:00', '2023-02-01 21:13:26'),
(6, 'user', 'anggota', '$2y$10$AUJVLREAPsG0hbAfngkVueXItUO6nK0iyfWxOvxlXoVRZf0N1QTJW', '', '', '', '0000-00-00 00:00:00', 2, 'user.jpg', '2', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(42, 'abran', 'tabrani', '$2y$10$AUJVLREAPsG0hbAfngkVueXItUO6nK0iyfWxOvxlXoVRZf0N1QTJW', '1234567890123455', '', '081234567893', '2023-02-01 23:01:17', 2, 'anggota.png', '1', '2023-02-01 23:01:17', '0000-00-00 00:00:00'),
(66, 'adit', 'Aditya', '$2y$10$lpgwuwAack9qCqQovzwwL.NngB.Aa.FWlZDoCiEqyA3NXpyc0Qvsu', '3201020509199900', '', '085111222333', '2023-07-07 12:19:12', 2, 'anggota.png', '1', '2023-07-07 12:19:12', '0000-00-00 00:00:00'),
(565, 'syahman', 'm syahman', '$2y$10$iRpX90pL8M9ckZGU7OYMN.FwWk0OLzHdMclYuie4pkeSG66x86Qba', '1234567890123457', 'Bandung', '081234567891', '2023-01-31 12:02:08', 2, 'anggota.png', '1', '2023-01-31 12:02:08', '2023-01-31 14:57:50'),
(775, 'ahmad', 'ahmad syair', '$2y$10$R3/qoqiVzihAIbpn.wQMgeT5jgqCpVY56ync8YHUicq.i8MSGCtxO', '1234567890123456', 'bandung', '081234567890', '2023-01-24 20:54:04', 2, 'anggota.png', '1', '2023-01-24 20:54:04', '0000-00-00 00:00:00'),
(956, 'toha', 'Muh Toha', '$2y$10$oufwapXzFRiWhTYwSaCOcOXQPB9IRbxYRURCXjw9ua1TEkQtXdiFm', '3201232504540001', '', '085222333444', '2023-07-07 11:11:13', 2, 'anggota.png', '1', '2023-07-07 11:11:13', '0000-00-00 00:00:00');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `aplikasi`
--
ALTER TABLE `aplikasi`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `detail_pembiayaan`
--
ALTER TABLE `detail_pembiayaan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--
-- AUTO_INCREMENT untuk tabel `jurnal_umum`
--
ALTER TABLE `jurnal_umum`
  MODIFY `jurnal_id` bigint(50) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT untuk tabel `pembiayaan`
--
ALTER TABLE `pembiayaan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `simpanan_manasuka`
--
ALTER TABLE `simpanan_manasuka`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `simpanan_pokok`
--
ALTER TABLE `simpanan_pokok`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=904;

--
-- AUTO_INCREMENT untuk tabel `simpanan_wajib`
--
ALTER TABLE `simpanan_wajib`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

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
