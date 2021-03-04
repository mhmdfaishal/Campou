-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 09, 2020 at 09:31 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `campou`
--

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `username_cust` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `Email` varchar(50) DEFAULT NULL,
  `foto` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`username_cust`, `password`, `Email`, `foto`) VALUES
('mhmdfaishal12', '$2y$10$3hZC1m/Ble2xMLMNmVLMDOJiWiO94hGmNU8Wieg5crWlr.KVkS8l6', 'mhmd.faishal123@gmail.com', '1607357198_233163ac3d542daa5ee5.png'),
('test12', '$2y$10$r9o.0r6sPQE2XmYOEVdu8e7xhpu3X7DhsLOKeGsoyCvM08NYCLB/a', 'mhmd.faishal12@gmail.com', '1607500677_ffd9bb9bb8102421e763.png'),
('test123', '$2y$10$Dt2Y4DeBIGEsrYBYDcaB6eiAcEiiPhDpSPoazYukTi6nwBEay3jJi', 'tes1@gmail.com', '1607436334_9aeb62c4374f0e7f470b.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `detail_penyewaan`
--

CREATE TABLE `detail_penyewaan` (
  `nomor_penyewaan` varchar(4) NOT NULL,
  `username_cust` varchar(100) DEFAULT NULL,
  `Nama` varchar(30) NOT NULL,
  `Nomor_Telepon` char(12) NOT NULL,
  `Nama_Lapangan` varchar(30) NOT NULL,
  `IdLapangan` varchar(4) DEFAULT NULL,
  `tgl_main` date NOT NULL,
  `jam_mulai` time NOT NULL,
  `jam_selesai` time NOT NULL,
  `total_harga` int(11) NOT NULL,
  `durasi` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `detail_penyewaan`
--

INSERT INTO `detail_penyewaan` (`nomor_penyewaan`, `username_cust`, `Nama`, `Nomor_Telepon`, `Nama_Lapangan`, `IdLapangan`, `tgl_main`, `jam_mulai`, `jam_selesai`, `total_harga`, `durasi`) VALUES
('2851', 'test12', 'test', '0897664564', 'Lapangan Futsal 01', 'LP1', '2020-12-10', '14:00:00', '16:00:00', 130000, 2);

-- --------------------------------------------------------

--
-- Table structure for table `lapangan`
--

CREATE TABLE `lapangan` (
  `IdLapangan` varchar(4) NOT NULL,
  `Nama_Lapangan` varchar(25) NOT NULL,
  `kode_tarif` varchar(4) NOT NULL,
  `Nomor_Lapangan` varchar(5) NOT NULL,
  `deskripsi` varchar(255) NOT NULL,
  `foto` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `lapangan`
--

INSERT INTO `lapangan` (`IdLapangan`, `Nama_Lapangan`, `kode_tarif`, `Nomor_Lapangan`, `deskripsi`, `foto`) VALUES
('LP1', 'Lapangan Futsal2', 'trf2', '01', 'Lapangan Futsal dengan ukuran dan fasilitas standard internasional', '1607437683_cb3cf4ae8ee88da71f6a.jpg'),
('LP2', 'Lapangan Basket', 'trf2', '01', 'Lapangan voly dengan ukuran dan fasilitas standard internasional', 'basket1.jpg'),
('LP3', 'Lapangan Voly', 'trf1', '01', 'Lapangan basket dengan ukuran dan fasilitas standard internasional', 'voly1.jpg'),
('LP4', 'Lapangan Futsal', 'trf1', '02', 'tes', '1607501071_d7a90c58e69e0eb1e98b.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `penyedia`
--

CREATE TABLE `penyedia` (
  `IdPenyedia` varchar(100) NOT NULL,
  `Nama_Penyedia` varchar(30) NOT NULL,
  `email` varchar(100) NOT NULL,
  `foto` varchar(255) NOT NULL,
  `password` varchar(100) NOT NULL,
  `Nomor_Telepon` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `penyedia`
--

INSERT INTO `penyedia` (`IdPenyedia`, `Nama_Penyedia`, `email`, `foto`, `password`, `Nomor_Telepon`) VALUES
('0001', 'Faishal', 'faishal@gmail.com', '16.jpg', '$2y$10$U/KMa0GM.PCFKK8xo0NKeOO5tIw201tGXDpQxWBcRZcZ04AW3x/xu', '082127177132'),
('0002', 'Join', 'join@gmail.com', '1607143741_fb26c068048797d0c2d0.jpg', '$2y$10$8eB3O2OzgussEdkCr/.quuX9VrMZhlChFX/HZV.G57p5AYdnr43K2', '08927372324'),
('0003', 'ridho', 'ridho@gmail.com', '44.jpg', '$2y$10$OnFSm7l0iXUNihMGeamE/urDzXjOf5sROHkrOkLxA47FkNn.DkZeG', '07887867868');

-- --------------------------------------------------------

--
-- Table structure for table `tarif`
--

CREATE TABLE `tarif` (
  `kode_tarif` varchar(4) NOT NULL,
  `harga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tarif`
--

INSERT INTO `tarif` (`kode_tarif`, `harga`) VALUES
('trf1', 65000),
('trf2', 125000);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`username_cust`);

--
-- Indexes for table `detail_penyewaan`
--
ALTER TABLE `detail_penyewaan`
  ADD PRIMARY KEY (`nomor_penyewaan`),
  ADD KEY `IdLapangan` (`IdLapangan`),
  ADD KEY `username_cust` (`username_cust`);

--
-- Indexes for table `lapangan`
--
ALTER TABLE `lapangan`
  ADD PRIMARY KEY (`IdLapangan`),
  ADD KEY `kode_tarif` (`kode_tarif`);

--
-- Indexes for table `penyedia`
--
ALTER TABLE `penyedia`
  ADD PRIMARY KEY (`IdPenyedia`);

--
-- Indexes for table `tarif`
--
ALTER TABLE `tarif`
  ADD PRIMARY KEY (`kode_tarif`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `detail_penyewaan`
--
ALTER TABLE `detail_penyewaan`
  ADD CONSTRAINT `IdLapangan` FOREIGN KEY (`IdLapangan`) REFERENCES `lapangan` (`IdLapangan`),
  ADD CONSTRAINT `username_cust` FOREIGN KEY (`username_cust`) REFERENCES `customer` (`username_cust`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
