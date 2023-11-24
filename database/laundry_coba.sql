-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 03 Apr 2021 pada 09.57
-- Versi Server: 10.1.28-MariaDB
-- PHP Version: 7.1.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laundry_coba`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_laundry`
--

CREATE TABLE `tb_laundry` (
  `id_laundry` int(11) NOT NULL,
  `id_pelanggan` varchar(15) NOT NULL,
  `id_outlet` varchar(20) NOT NULL,
  `kode_user` int(11) NOT NULL,
  `tanggal_terima` date NOT NULL,
  `tanggal_selesai` date NOT NULL,
  `id_paket` varchar(20) NOT NULL,
  `kg` int(5) NOT NULL,
  `nominal` int(20) NOT NULL,
  `diskon` int(5) NOT NULL,
  `biaya_tambahan` int(20) NOT NULL,
  `proses` varchar(50) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_laundry`
--

INSERT INTO `tb_laundry` (`id_laundry`, `id_pelanggan`, `id_outlet`, `kode_user`, `tanggal_terima`, `tanggal_selesai`, `id_paket`, `kg`, `nominal`, `diskon`, `biaya_tambahan`, `proses`, `status`) VALUES
(87, 'PLG-0005', 'OLT-0001', 1, '2021-04-03', '2021-04-15', ' Celana Jeans', 4, 100000, 10, 100000, 'baru', 'lunas'),
(88, 'PLG-0002', 'OLT-0002', 2, '2021-04-03', '2021-04-20', ' Celana Jeans', 4, 100000, 10, 100000, 'baru', 'lunas'),
(89, 'PLG-0001', 'OLT-0001', 1, '2021-04-03', '2021-04-21', ' Jaket Jeans', 2, 10000, 10, 100000, 'baru', 'lunas'),
(90, 'PLG-0009', 'OLT-0005', 9, '2021-04-03', '2021-04-06', ' baju', 1, 7000, 10, 5000, 'baru', 'lunas'),
(91, 'PLG-0002', 'OLT-0005', 9, '2021-04-03', '2021-04-06', ' baju', 1, 7000, 10, 9998, 'diambil', 'lunas');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_outlet`
--

CREATE TABLE `tb_outlet` (
  `kode_outlet` varchar(11) NOT NULL,
  `nama_outlet` varchar(100) NOT NULL,
  `alamat` text NOT NULL,
  `telpon` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_outlet`
--

INSERT INTO `tb_outlet` (`kode_outlet`, `nama_outlet`, `alamat`, `telpon`) VALUES
('OLT-0001', 'SMKN2 Laundrya', 'Jalan Perusahaan No 20, Tanjungtirto, singosari,malang,jawa timur', '034143451270'),
('OLT-0005', 'laundry kita', 'rumah jalan mawar', '08543523');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_paket`
--

CREATE TABLE `tb_paket` (
  `kode_paket` varchar(11) NOT NULL,
  `jenis` varchar(50) NOT NULL,
  `harga` int(11) NOT NULL,
  `kg` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_paket`
--

INSERT INTO `tb_paket` (`kode_paket`, `jenis`, `harga`, `kg`) VALUES
('PKT-0004', 'Jaket Jeans', 10000, 2),
('PKT-0007', 'baju', 7000, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_pelanggan`
--

CREATE TABLE `tb_pelanggan` (
  `kode_pelanggan` varchar(10) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `alamat` text NOT NULL,
  `telpon` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_pelanggan`
--

INSERT INTO `tb_pelanggan` (`kode_pelanggan`, `nama`, `alamat`, `telpon`) VALUES
('PLG-0001', 'orange', 'rumah', '029302572'),
('PLG-0002', 'orang dua', 'rumah', '0345789547'),
('PLG-0004', 'wer', 'qwe', '324'),
('PLG-0006', 'asd', 'asd', '12'),
('PLG-0009', 'Yonanda Haryono', 'rumah sebelah jalan melati', '054345345');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_transaksi`
--

CREATE TABLE `tb_transaksi` (
  `kode_transaksi` int(11) NOT NULL,
  `id_pelanggan` varchar(20) NOT NULL,
  `id_outlet` varchar(20) NOT NULL,
  `kode_user` int(11) NOT NULL,
  `tgl_transaksi` date NOT NULL,
  `id_paket` varchar(20) NOT NULL,
  `kg` int(5) NOT NULL,
  `nominal` int(20) NOT NULL,
  `diskon` int(20) NOT NULL,
  `biaya_tambahan` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_transaksi`
--

INSERT INTO `tb_transaksi` (`kode_transaksi`, `id_pelanggan`, `id_outlet`, `kode_user`, `tgl_transaksi`, `id_paket`, `kg`, `nominal`, `diskon`, `biaya_tambahan`) VALUES
(77, 'PLG-0005', 'OLT-0001', 1, '2021-04-03', ' Celana Jeans', 4, 100000, 10, 100000),
(78, 'PLG-0002', 'OLT-0002', 2, '2021-04-03', ' Celana Jeans', 4, 100000, 10, 100000),
(79, 'PLG-0001', 'OLT-0001', 1, '2021-04-03', ' Jaket Jeans', 2, 10000, 10, 100000),
(80, 'PLG-0009', 'OLT-0005', 9, '2021-04-03', ' baju', 1, 7000, 10, 5000),
(81, 'PLG-0002', 'OLT-0005', 9, '2021-04-03', ' baju', 1, 7000, 10, 9998);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_user`
--

CREATE TABLE `tb_user` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `nama_user` varchar(255) NOT NULL,
  `password` varchar(100) NOT NULL,
  `id_outlet` varchar(20) NOT NULL,
  `level` varchar(30) NOT NULL,
  `foto` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_user`
--

INSERT INTO `tb_user` (`id`, `username`, `nama_user`, `password`, `id_outlet`, `level`, `foto`) VALUES
(1, 'admin', 'Admin', 'admin', 'SMKN2 Laundrya', 'admin', 'avatar.png'),
(2, 'kasir', 'kasir1', 'kasir', 'SMKN2 Laundrya', 'kasir', 'avatar2.png'),
(5, 'owner', 'owner', 'owner', 'laundryyq', 'owner', 'avatar5.png'),
(9, 'yonanda', 'Yonanda ', 'kasir', '', 'kasir', '1006 5 (3).jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_laundry`
--
ALTER TABLE `tb_laundry`
  ADD PRIMARY KEY (`id_laundry`),
  ADD KEY `id_paket` (`id_paket`),
  ADD KEY `nominal` (`nominal`);

--
-- Indexes for table `tb_outlet`
--
ALTER TABLE `tb_outlet`
  ADD PRIMARY KEY (`kode_outlet`);

--
-- Indexes for table `tb_paket`
--
ALTER TABLE `tb_paket`
  ADD PRIMARY KEY (`kode_paket`),
  ADD KEY `jenis` (`jenis`),
  ADD KEY `harga` (`harga`);

--
-- Indexes for table `tb_pelanggan`
--
ALTER TABLE `tb_pelanggan`
  ADD PRIMARY KEY (`kode_pelanggan`);

--
-- Indexes for table `tb_transaksi`
--
ALTER TABLE `tb_transaksi`
  ADD PRIMARY KEY (`kode_transaksi`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_laundry`
--
ALTER TABLE `tb_laundry`
  MODIFY `id_laundry` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;

--
-- AUTO_INCREMENT for table `tb_transaksi`
--
ALTER TABLE `tb_transaksi`
  MODIFY `kode_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
