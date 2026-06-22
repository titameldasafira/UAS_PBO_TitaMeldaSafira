-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 22, 2026 at 07:34 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_uas_pbo_ti1c_titameldasafira`
--

-- --------------------------------------------------------

--
-- Table structure for table `tabel_karyawan`
--

CREATE TABLE `tabel_karyawan` (
  `id_karyawan` varchar(50) NOT NULL,
  `nama_karyawan` varchar(100) NOT NULL,
  `departemen` varchar(100) NOT NULL,
  `hari_kerja_masuk` int NOT NULL,
  `gaji_dasar_per_hari` decimal(15,2) NOT NULL,
  `jenis_karyawan` enum('kontrak','tetap','magang') NOT NULL,
  `durasi_kontrak_bulan` int DEFAULT NULL,
  `agen_penyalur` varchar(100) DEFAULT NULL,
  `tunjangan_kesehatan` decimal(15,2) DEFAULT NULL,
  `opsi_saham_id` varchar(50) DEFAULT NULL,
  `uang_saku_bulanan` decimal(15,2) DEFAULT NULL,
  `sertifikat_kampus_merdeka` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tabel_karyawan`
--

INSERT INTO `tabel_karyawan` (`id_karyawan`, `nama_karyawan`, `departemen`, `hari_kerja_masuk`, `gaji_dasar_per_hari`, `jenis_karyawan`, `durasi_kontrak_bulan`, `agen_penyalur`, `tunjangan_kesehatan`, `opsi_saham_id`, `uang_saku_bulanan`, `sertifikat_kampus_merdeka`) VALUES
('K001', 'Hadi Sucipto', 'Operasional', 18, '200000.00', 'kontrak', 12, 'PT Karya Mandiri', NULL, NULL, NULL, NULL),
('K002', 'Irfan Hakim', 'Logistik', 20, '180000.00', 'kontrak', 6, 'PT Bintang Alih Daya', NULL, NULL, NULL, NULL),
('K003', 'Joko Susanto', 'Keamanan', 24, '150000.00', 'kontrak', 12, 'PT Garda Nasional', NULL, NULL, NULL, NULL),
('K004', 'Kartika Sari', 'Pemasaran', 15, '220000.00', 'kontrak', 3, 'PT Karya Mandiri', NULL, NULL, NULL, NULL),
('K005', 'Lukman Sardi', 'Logistik', 22, '180000.00', 'kontrak', 6, 'PT Bintang Alih Daya', NULL, NULL, NULL, NULL),
('K006', 'Maya Wulan', 'Customer Service', 21, '190000.00', 'kontrak', 12, 'PT Pesona Kerja', NULL, NULL, NULL, NULL),
('K007', 'Nadia Safira', 'Customer Service', 20, '190000.00', 'kontrak', 6, 'PT Pesona Kerja', NULL, NULL, NULL, NULL),
('M001', 'Oki Setiawan', 'Teknologi Informasi', 12, '50000.00', 'magang', NULL, NULL, NULL, NULL, '1500000.00', 'KM-Tech-2026-01'),
('M002', 'Putri Diana', 'Pemasaran', 10, '45000.00', 'magang', NULL, NULL, NULL, NULL, '1200000.00', 'KM-Mkt-2026-12'),
('M003', 'Rizky Febian', 'Sumber Daya Manusia', 14, '40000.00', 'magang', NULL, NULL, NULL, NULL, '1000000.00', 'KM-HR-2026-05'),
('M004', 'Siti Aminah', 'Keuangan', 15, '45000.00', 'magang', NULL, NULL, NULL, NULL, '1200000.00', 'KM-Fin-2026-08'),
('M005', 'Tono Hermawan', 'Teknologi Informasi', 10, '50000.00', 'magang', NULL, NULL, NULL, NULL, '1500000.00', 'KM-Tech-2026-15'),
('M006', 'Vina Panduwinata', 'Operasional', 12, '40000.00', 'magang', NULL, NULL, NULL, NULL, '1000000.00', 'KM-Ops-2026-22'),
('T001', 'Andi Saputra', 'Teknologi Informasi', 22, '350000.00', 'tetap', NULL, NULL, '1500000.00', 'SHM-IT-01', NULL, NULL),
('T002', 'Budi Santoso', 'Keuangan', 20, '300000.00', 'tetap', NULL, NULL, '1200000.00', 'SHM-KU-02', NULL, NULL),
('T003', 'Citra Lestari', 'Sumber Daya Manusia', 21, '280000.00', 'tetap', NULL, NULL, '1000000.00', 'SHM-HR-01', NULL, NULL),
('T004', 'Deni Ridwan', 'Pemasaran', 22, '290000.00', 'tetap', NULL, NULL, '1100000.00', 'SHM-MKT-03', NULL, NULL),
('T005', 'Eka Putri', 'Operasional', 23, '270000.00', 'tetap', NULL, NULL, '1000000.00', 'SHM-OP-01', NULL, NULL),
('T006', 'Fajar Nugraha', 'Teknologi Informasi', 20, '360000.00', 'tetap', NULL, NULL, '1500000.00', 'SHM-IT-02', NULL, NULL),
('T007', 'Gita Amelia', 'Keuangan', 22, '310000.00', 'tetap', NULL, NULL, '1200000.00', 'SHM-KU-03', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tabel_karyawan`
--
ALTER TABLE `tabel_karyawan`
  ADD PRIMARY KEY (`id_karyawan`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
