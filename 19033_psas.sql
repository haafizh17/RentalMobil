-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 08, 2024 at 11:03 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `19033_psas`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbkendaraan`
--

CREATE TABLE `tbkendaraan` (
  `id` int(11) NOT NULL,
  `jenis` varchar(100) NOT NULL,
  `seri` varchar(100) NOT NULL,
  `harga` decimal(10,2) NOT NULL,
  `durasisewa` int(225) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `gambar` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbkendaraan`
--

INSERT INTO `tbkendaraan` (`id`, `jenis`, `seri`, `harga`, `durasisewa`, `deskripsi`, `gambar`) VALUES
(2, 'Mobil Sport', 'Toyota Supra', 1200000.00, 1, 'Toyota Supra yang tersedia untuk disewa adalah mobil sport ikonik dengan performa tinggi dan desain aerodinamis. Dikenal karena mesin bertenaga dan teknologi canggih, Supra menawarkan pengalaman berkendara yang luar biasa. Mobil ini sangat diidamkan oleh para penggemar otomotif dan cocok untuk mereka yang mencari kecepatan dan gaya.', 'supra.jpg'),
(6, 'Mobil Sport', 'Ferarri', 1000000.00, 1, 'Rasakan sensasi berkendara dengan Ferrari, mobil sport ikonik dengan mesin bertenaga, akselerasi luar biasa, dan desain elegan. Nikmati pengalaman mengemudi premium dengan interior mewah dan sistem hiburan canggih. Ferrari adalah produsen mobil super asal Italia yang terkenal dengan performa tinggi, desain ikonik, dan warisan balap yang kaya. Didirikan oleh Enzo Ferrari pada tahun 1939, merek ini telah menjadi simbol kemewahan dan kecepatan di seluruh dunia. ', 'download.jpg'),
(7, 'Mobil MPV', 'Toyota Avanza', 600000.00, 1, 'Toyota Avanza adalah mobil MPV yang populer di Indonesia, dikenal karena ruang kabin yang luas dan kenyamanan berkendara. Didesain untuk keluarga, Avanza menawarkan fleksibilitas dengan konfigurasi tempat duduk yang dapat disesuaikan dan efisiensi bahan bakar yang baik. Dengan performa yang handal dan fitur-fitur modern, Avanza menjadi pilihan ideal untuk perjalanan sehari-hari maupun liburan bersama keluarga.', 'avanza.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tbpemesanan`
--

CREATE TABLE `tbpemesanan` (
  `id` int(11) NOT NULL,
  `namalengkap` varchar(100) NOT NULL,
  `nik` varchar(20) NOT NULL,
  `nokk` varchar(20) NOT NULL,
  `alamat` text NOT NULL,
  `jenis_kelamin` enum('L','P') NOT NULL,
  `total_pembayaran` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbpemesanan`
--

INSERT INTO `tbpemesanan` (`id`, `namalengkap`, `nik`, `nokk`, `alamat`, `jenis_kelamin`, `total_pembayaran`) VALUES
(1, 'test', '3333', '22', 'gaga', 'L', 4200000.00),
(2, 'Haafizh', '27676286', '29887289789', 'Petambakan, Banjarnegara, Jawa Tengah, Indonesia', 'L', 2400000.00);

-- --------------------------------------------------------

--
-- Table structure for table `tbpengguna`
--

CREATE TABLE `tbpengguna` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','user') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbpengguna`
--

INSERT INTO `tbpengguna` (`id`, `nama`, `password`, `role`) VALUES
(1, 'admin', 'e00cf25ad42683b3df678c61f42c6bda', 'admin'),
(2, 'user', '24c9e15e52afc47c225b757e7bee1f9d', 'user'),
(4, 'Haafizh', 'bcd724d15cde8c47650fda962968f102', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbkendaraan`
--
ALTER TABLE `tbkendaraan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbpemesanan`
--
ALTER TABLE `tbpemesanan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbpengguna`
--
ALTER TABLE `tbpengguna`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbkendaraan`
--
ALTER TABLE `tbkendaraan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbpemesanan`
--
ALTER TABLE `tbpemesanan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbpengguna`
--
ALTER TABLE `tbpengguna`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
