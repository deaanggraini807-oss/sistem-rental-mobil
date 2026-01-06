-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 06 Jan 2026 pada 13.30
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rental_mobil`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `mobil`
--

CREATE TABLE `mobil` (
  `id_mobil` int(11) NOT NULL,
  `no_plat` varchar(20) DEFAULT NULL,
  `merk` varchar(50) DEFAULT NULL,
  `tipe` varchar(50) DEFAULT NULL,
  `tahun` int(11) DEFAULT NULL,
  `harga_sewa` int(11) DEFAULT NULL,
  `status` enum('Tersedia','Disewa') DEFAULT 'Tersedia'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `mobil`
--

INSERT INTO `mobil` (`id_mobil`, `no_plat`, `merk`, `tipe`, `tahun`, `harga_sewa`, `status`) VALUES
(1, 'B 2010 JWA', 'HONDA JAZ', 'B 0001', 2023, 400000, 'Tersedia'),
(2, 'B 2016 TWF', 'AYLA', '0005', 2018, 1050000, 'Tersedia'),
(3, 'B 0225 QWE', 'HONDA', 'BRIO', 2022, 350000000, 'Tersedia'),
(4, 'B 89889 GHJ', 'INOVA', 'ZENIX', 2023, 700000, 'Tersedia'),
(5, 'B 0989 BSH', 'AVANZA', 'PELOZ', 2021, 500000, 'Tersedia');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id_pelanggan` int(11) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `telp` varchar(20) DEFAULT NULL,
  `no_ktp` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pelanggan`
--

INSERT INTO `pelanggan` (`id_pelanggan`, `nama`, `alamat`, `telp`, `no_ktp`) VALUES
(2, 'DEA ANGGRAINI', 'pakuhaji', '081224617265', '787777968676567'),
(3, 'ANISA', 'cipondoh', '081726627771', '526718181771'),
(4, 'FIZI', 'PAKUHAJI', '080298227', '2637379999'),
(5, 'RIZKI', 'SEPATAN', '0898273987', '982638898870006');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id_bayar` int(11) NOT NULL,
  `id_sewa` int(11) DEFAULT NULL,
  `tgl_bayar` date DEFAULT NULL,
  `jumlah_bayar` int(11) DEFAULT NULL,
  `metode` enum('Cash','Transfer') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pembayaran`
--

INSERT INTO `pembayaran` (`id_bayar`, `id_sewa`, `tgl_bayar`, `jumlah_bayar`, `metode`) VALUES
(1, 4, '2026-01-01', 200000, 'Cash'),
(2, 7, '2026-01-07', 5000000, 'Cash'),
(3, 6, '2026-01-07', 2000000, 'Transfer'),
(4, 8, '2026-01-05', 2500000, 'Transfer');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi_sewa`
--

CREATE TABLE `transaksi_sewa` (
  `id_sewa` int(11) NOT NULL,
  `id_mobil` int(11) DEFAULT NULL,
  `id_pelanggan` int(11) DEFAULT NULL,
  `tgl_sewa` date DEFAULT NULL,
  `tgl_kembali` date DEFAULT NULL,
  `total_hari` int(11) DEFAULT NULL,
  `total_bayar` int(11) DEFAULT NULL,
  `status` enum('Disewa','Selesai') DEFAULT 'Disewa'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `transaksi_sewa`
--

INSERT INTO `transaksi_sewa` (`id_sewa`, `id_mobil`, `id_pelanggan`, `tgl_sewa`, `tgl_kembali`, `total_hari`, `total_bayar`, `status`) VALUES
(4, 1, 2, '2025-12-29', '2026-01-29', 31, 94550000, 'Selesai'),
(5, 2, 2, '2025-12-25', '2026-01-01', 7, 7350000, 'Selesai'),
(6, 2, 3, '2026-01-01', '2026-01-04', 3, 3150000, 'Selesai'),
(7, 1, 4, '2026-01-01', '2026-01-07', 6, 18300000, 'Selesai'),
(8, 5, 5, '2026-01-01', '2026-01-05', 4, 2000000, 'Selesai');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `level` enum('admin','petugas') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `nama`, `username`, `password`, `level`) VALUES
(1, 'Admin', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `mobil`
--
ALTER TABLE `mobil`
  ADD PRIMARY KEY (`id_mobil`);

--
-- Indeks untuk tabel `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id_pelanggan`);

--
-- Indeks untuk tabel `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id_bayar`),
  ADD KEY `id_sewa` (`id_sewa`);

--
-- Indeks untuk tabel `transaksi_sewa`
--
ALTER TABLE `transaksi_sewa`
  ADD PRIMARY KEY (`id_sewa`),
  ADD KEY `id_mobil` (`id_mobil`),
  ADD KEY `id_pelanggan` (`id_pelanggan`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `mobil`
--
ALTER TABLE `mobil`
  MODIFY `id_mobil` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id_pelanggan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id_bayar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `transaksi_sewa`
--
ALTER TABLE `transaksi_sewa`
  MODIFY `id_sewa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD CONSTRAINT `pembayaran_ibfk_1` FOREIGN KEY (`id_sewa`) REFERENCES `transaksi_sewa` (`id_sewa`);

--
-- Ketidakleluasaan untuk tabel `transaksi_sewa`
--
ALTER TABLE `transaksi_sewa`
  ADD CONSTRAINT `transaksi_sewa_ibfk_1` FOREIGN KEY (`id_mobil`) REFERENCES `mobil` (`id_mobil`),
  ADD CONSTRAINT `transaksi_sewa_ibfk_2` FOREIGN KEY (`id_pelanggan`) REFERENCES `pelanggan` (`id_pelanggan`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
