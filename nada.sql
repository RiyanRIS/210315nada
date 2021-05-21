-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 30, 2021 at 07:04 PM
-- Server version: 8.0.23-0ubuntu0.20.04.1
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nada`
--

-- --------------------------------------------------------

--
-- Table structure for table `information`
--

CREATE TABLE `information` (
  `id` int NOT NULL,
  `namasitus` varchar(32) NOT NULL,
  `deskripsi` varchar(255) NOT NULL,
  `icon` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ;

--
-- Dumping data for table `information`
--

INSERT INTO `information` (`id`, `namasitus`, `deskripsi`, `icon`) VALUES
(1, 'WISATAKU.COM', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `paket`
--

CREATE TABLE `paket` (
  `id` int NOT NULL,
  `nama` varchar(64) NOT NULL,
  `deskripsi` varchar(255) NOT NULL,
  `kunjungan` varchar(255) NOT NULL,
  `harga` int NOT NULL,
  `gambar` varchar(255)  DEFAULT NULL,
  `status` tinyint NOT NULL DEFAULT '1',
  `create_at` int NOT NULL,
  `delete_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ;

--
-- Dumping data for table `paket`
--

INSERT INTO `paket` (`id`, `nama`, `deskripsi`, `kunjungan`, `harga`, `gambar`, `status`, `create_at`, `delete_at`) VALUES
(4, 'Paket Borobudur', 'Paket wisata selama 1 hari, include Kendaraan AC standar pariwisata dan Driver as Guide. Tiket masuk sesuai jadwal serta Free Antar Wisata Kuliner dan Wisata Oleh Oleh.', 'Candi Borobudur, Candi Prambanan dan Heha Sky View', 299000, '1617102843-Arupadhatu-Candi-Borobudur.jpg', 1, 1617102843, NULL),
(5, 'Paket Taman Sari', 'Paket wisata 1 hari, Kendaraan AC standar pariwisata Driver as Guide BBM Parkir Tiket masuk destinasi sesuai jadwal Drop in dan drop off (Terminal/ Bandara/ Stasiun/ Hotel) di Yogyakarta Free Antar Wisata Kuliner dan Wisata Oleh Oleh Air mineral', 'Taman Sari, Hutan Pinus Mangunan dan Malioboro', 150000, '1617103015-tamansari.jpg', 1, 1617103015, NULL),
(6, 'Paket Rafting', 'Kendaraan AC standar pariwisata Driver as Guide BBM Parkir Alat Reffting sungai elo Drop in dan drop off (Terminal/ Bandara/ Stasiun/ Hotel) di Yogyakarta Tiket masuk destinasi sesuai jadwal Air mineral Meeting poin di jogja\r\n', 'Refting Sungai Elo, Candi Borobudur, The Worl Lenmark Merapi dan Malioboro', 335000, '1617103370-rafting-sungai-elo.jpg', 1, 1617103370, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id` int NOT NULL,
  `paket` int NOT NULL,
  `user` int NOT NULL,
  `tanggal_berangkat` int NOT NULL,
  `jumlah_orang` int NOT NULL,
  `ket` varchar(255) DEFAULT NULL,
  `status_pemesanan` int NOT NULL DEFAULT '1',
  `unixpayment` int DEFAULT NULL,
  `create_at` int NOT NULL,
  `bayar_at` int DEFAULT NULL,
  `batal_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id`, `paket`, `user`, `tanggal_berangkat`, `jumlah_orang`, `ket`, `status_pemesanan`, `unixpayment`, `create_at`, `bayar_at`, `batal_at`) VALUES
(3, 4, 3, 1617449160, 3, '', 2, 61, 1617103513, 1617103563, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `username` varchar(16)  NOT NULL,
  `password` varchar(255)  NOT NULL,
  `email` varchar(64) NOT NULL,
  `nama` varchar(64) NOT NULL,
  `role` varchar(16) NOT NULL DEFAULT 'customer',
  `status` tinyint NOT NULL DEFAULT '1',
  `last_login` int DEFAULT NULL,
  `create_at` int NOT NULL,
  `delete_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `nama`, `role`, `status`, `last_login`, `create_at`, `delete_at`) VALUES
(1, 'admin', '$2y$10$m8lDyy5JYcx2/7CJfDYcSOQsXL.Hy.i4rGUeu78EAW00AtmfCqfh.', 'riyanrisky129@gmail.com', 'Riyan Risky', 'admin', 1, 1617102435, 1616738269, NULL),
(3, 'user', '$2y$10$OFYGNomNnyMmydVI9vSRD.x8QkS4dDshzKOc91kL7WgUfjJ/9fuBq', 'asd@ss.ds', 'Bayu Sulistyo', 'customer', 1, NULL, 1617101819, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `information`
--
ALTER TABLE `information`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `paket`
--
ALTER TABLE `paket`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `information`
--
ALTER TABLE `information`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `paket`
--
ALTER TABLE `paket`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
