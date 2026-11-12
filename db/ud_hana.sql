-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 17 Bulan Mei 2025 pada 18.27
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ud_hana`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_pelanggan`
--

CREATE TABLE `tb_pelanggan` (
  `id_pelanggan` int(11) NOT NULL,
  `tanggal_pelanggan` date NOT NULL,
  `jenis_pelanggan` varchar(100) NOT NULL,
  `nomor_pelanggan` varchar(20) NOT NULL,
  `email_pelanggan` varchar(100) DEFAULT NULL,
  `alamat_pelanggan` text DEFAULT NULL,
  `catatan_pelanggan` text DEFAULT NULL,
  `datetime_pelanggan` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_pelanggan`
--

INSERT INTO `tb_pelanggan` (`id_pelanggan`, `tanggal_pelanggan`, `jenis_pelanggan`, `nomor_pelanggan`, `email_pelanggan`, `alamat_pelanggan`, `catatan_pelanggan`, `datetime_pelanggan`) VALUES
(1, '2025-05-02', 'Wismia', '085323423243', 'wismia@gmail.com', 'Jl. Penyabungan 1 A', 'Dari PT SATU DUA', '2025-05-16 12:53:29'),
(2, '2025-05-07', 'PT BAKSO URAT', '087523343423', 'baksourat@gmail.com', 'Jl Kasuari', 'Medok', '2025-05-16 13:04:40');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_pendapatan`
--

CREATE TABLE `tb_pendapatan` (
  `id_pendapatan` int(11) NOT NULL,
  `tanggal_pendapatan` date NOT NULL,
  `nama_pelanggan` varchar(100) NOT NULL,
  `nomor_pelanggan` varchar(50) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `nama_produk` varchar(100) NOT NULL,
  `harga_produk` decimal(50,0) NOT NULL,
  `satuan_produk` varchar(50) NOT NULL,
  `jumlah_produk` decimal(20,0) NOT NULL,
  `total_pendapatan` decimal(50,0) NOT NULL,
  `metode_pembayaran` varchar(50) NOT NULL,
  `catatan_pendapatan` text NOT NULL,
  `date_pendapatan` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_pendapatan`
--

INSERT INTO `tb_pendapatan` (`id_pendapatan`, `tanggal_pendapatan`, `nama_pelanggan`, `nomor_pelanggan`, `id_produk`, `nama_produk`, `harga_produk`, `satuan_produk`, `jumlah_produk`, `total_pendapatan`, `metode_pembayaran`, `catatan_pendapatan`, `date_pendapatan`) VALUES
(1, '2025-05-15', 'Ajit', '082432324343', 3, 'Kartu Nama', 35000, 'box (100 pcs)', 5, 175000, 'Tunai', 'SD 22222 Pane', '2025-05-15 22:46:22'),
(2, '2025-05-13', 'Suprianto', '086476343215', 12, 'Kalender Meja', 12000, 'pcs', 5, 60000, 'QRIS', 'HONDA', '2025-05-15 23:14:04'),
(3, '2025-05-10', 'Ahsi', '085363432343', 5, 'Flyer A5', 600, 'lembar', 2, 1200, 'Tunai', 'YAMAHA', '2025-05-16 13:32:39');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_pengeluaran`
--

CREATE TABLE `tb_pengeluaran` (
  `id_pengeluaran` int(11) NOT NULL,
  `tanggal_pengeluaran` date NOT NULL,
  `jenis_pengeluaran` varchar(100) NOT NULL,
  `rincian_pengeluaran` text NOT NULL,
  `jumlah_pengeluaran` decimal(50,0) NOT NULL,
  `metode_pengeluaran` varchar(50) NOT NULL,
  `kepada_pengeluaran` varchar(100) NOT NULL,
  `bukti_pengeluaran` varchar(200) NOT NULL,
  `datetime_pengeluaran` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_pengeluaran`
--

INSERT INTO `tb_pengeluaran` (`id_pengeluaran`, `tanggal_pengeluaran`, `jenis_pengeluaran`, `rincian_pengeluaran`, `jumlah_pengeluaran`, `metode_pengeluaran`, `kepada_pengeluaran`, `bukti_pengeluaran`, `datetime_pengeluaran`) VALUES
(1, '2025-05-16', 'Gaji', 'Gaji karyawan bulan april 2025', 3000000, 'Transfer', 'Seluruh karyawan', '1747368492-Screenshot 2025-05-08 132024.png', '2025-05-16 10:05:50'),
(4, '2025-05-17', 'Listrik', 'Bulan Mei', 200000, 'QRIS', 'PLN', '1747494252-Screenshot (15).png', '2025-05-17 22:04:12');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_produkjasa`
--

CREATE TABLE `tb_produkjasa` (
  `id_produk` int(11) NOT NULL,
  `nama_produk` varchar(100) NOT NULL,
  `kategori_produk` varchar(100) NOT NULL,
  `harga_produk` decimal(50,0) NOT NULL,
  `satuan_produk` varchar(50) NOT NULL,
  `tanggal_produk` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_produkjasa`
--

INSERT INTO `tb_produkjasa` (`id_produk`, `nama_produk`, `kategori_produk`, `harga_produk`, `satuan_produk`, `tanggal_produk`) VALUES
(3, 'Kartu Nama', 'Cetak Offset', 35000, 'box (100 pcs)', '2025-05-15 22:06:47'),
(4, 'Brosur A4', 'Cetak Offset', 800, 'lembar', '2025-05-15 22:06:47'),
(5, 'Flyer A5', 'Cetak Digital', 600, 'lembar', '2025-05-15 22:06:47'),
(6, 'Banner X-Banner', 'Large Format Print', 50000, 'pcs', '2025-05-15 22:06:47'),
(7, 'Spanduk MMT', 'Large Format Print', 25000, 'meter', '2025-05-15 22:06:47'),
(8, 'Nota / Kwitansi (Carbonized)', 'Cetak Offset', 18000, 'buku', '2025-05-15 22:06:47'),
(9, 'Kop Surat', 'Cetak Offset', 65000, 'rim (500 lbr)', '2025-05-15 22:06:47'),
(10, 'Amplop Surat', 'Cetak Offset', 45000, 'box (100 pcs)', '2025-05-15 22:06:47'),
(11, 'Stiker Label A3', 'Cetak Digital', 4000, 'lembar', '2025-05-15 22:06:47'),
(12, 'Kalender Meja', 'Finishing Khusus', 12000, 'pcs', '2025-05-15 22:06:47'),
(13, 'Kalender Dinding', 'Finishing Khusus', 10000, 'pcs', '2025-05-15 22:06:47'),
(14, 'Undangan Pernikahan', 'Cetak Offset', 2000, 'pcs', '2025-05-15 22:06:47'),
(15, 'Sertifikat', 'Cetak Digital', 2500, 'lembar', '2025-05-15 22:06:47'),
(16, 'ID Card + Tali & Holder', 'Digital & Aksesoris', 10000, 'pcs', '2025-05-15 22:06:47'),
(17, 'Cetak Foto 4R', 'Cetak Foto', 2500, 'pcs', '2025-05-15 22:06:47'),
(18, 'Jasa Desain Grafis', 'Jasa Desain', 25000, 'jam', '2025-05-15 22:06:47'),
(19, 'Laminasi Doff/Glossy', 'Finishing', 1500, 'lembar', '2025-05-15 22:06:47'),
(20, 'Potong Kertas', 'Finishing', 3000, 'rim', '2025-05-15 22:06:47'),
(21, 'Jilid Spiral / Lem Panas', 'Finishing', 8000, 'pcs', '2025-05-15 22:06:47');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_user`
--

CREATE TABLE `tb_user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` enum('Admin','Kasir') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_user`
--

INSERT INTO `tb_user` (`id_user`, `username`, `email`, `password`, `role`) VALUES
(1, 'Admin', 'admin@gmail.com', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'Admin'),
(2, 'Kasir', 'kasir@gmail.com', '8691e4fc53b99da544ce86e22acba62d13352eff', 'Kasir'),
(3, 'Antona', 'antona@gmail.com', '174c0586ac3bc857b5a0e96fc77542422244473b', 'Kasir');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tb_pelanggan`
--
ALTER TABLE `tb_pelanggan`
  ADD PRIMARY KEY (`id_pelanggan`);

--
-- Indeks untuk tabel `tb_pendapatan`
--
ALTER TABLE `tb_pendapatan`
  ADD PRIMARY KEY (`id_pendapatan`);

--
-- Indeks untuk tabel `tb_pengeluaran`
--
ALTER TABLE `tb_pengeluaran`
  ADD PRIMARY KEY (`id_pengeluaran`);

--
-- Indeks untuk tabel `tb_produkjasa`
--
ALTER TABLE `tb_produkjasa`
  ADD PRIMARY KEY (`id_produk`);

--
-- Indeks untuk tabel `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tb_pelanggan`
--
ALTER TABLE `tb_pelanggan`
  MODIFY `id_pelanggan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `tb_pendapatan`
--
ALTER TABLE `tb_pendapatan`
  MODIFY `id_pendapatan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `tb_pengeluaran`
--
ALTER TABLE `tb_pengeluaran`
  MODIFY `id_pengeluaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `tb_produkjasa`
--
ALTER TABLE `tb_produkjasa`
  MODIFY `id_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT untuk tabel `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
