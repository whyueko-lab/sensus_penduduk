-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 01 Nov 2025 pada 07.30
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
-- Database: `db_sensus`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `kota`
--

CREATE TABLE `kota` (
  `id` int(11) UNSIGNED NOT NULL,
  `nama_kota` varchar(100) NOT NULL,
  `id_provinsi` int(11) UNSIGNED NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `kota`
--

INSERT INTO `kota` (`id`, `nama_kota`, `id_provinsi`, `created_at`, `updated_at`) VALUES
(1, 'Bandung', 1, NULL, NULL),
(2, 'Semarang', 2, NULL, NULL),
(3, 'Surabaya', 3, NULL, NULL),
(4, 'Bekasi', 1, '2025-11-01 01:05:45', '2025-11-01 01:05:45'),
(5, 'Banjarmasin', 4, '2025-11-01 01:07:28', '2025-11-01 01:07:28'),
(6, 'Ende', 6, '2025-11-01 03:10:01', '2025-11-01 03:10:01'),
(10, 'Bogor', 1, '2025-11-01 04:18:07', '2025-11-01 04:18:07'),
(11, 'Bogor', 1, '2025-11-01 04:18:33', '2025-11-01 04:18:33'),
(12, 'Bogor', 1, '2025-11-01 05:30:11', '2025-11-01 05:30:11');

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(4, '2025-10-28-152304', 'App\\Database\\Migrations\\CreateUsersTable', 'default', 'App', 1761665667, 1),
(5, '2025-10-28-153618', 'App\\Database\\Migrations\\CreateProvinsiTable', 'default', 'App', 1761665849, 2),
(6, '2025-10-28-153635', 'App\\Database\\Migrations\\CreateKotaTable', 'default', 'App', 1761665850, 2),
(7, '2025-10-28-153645', 'App\\Database\\Migrations\\CreateSensusTable', 'default', 'App', 1761665850, 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `provinsi`
--

CREATE TABLE `provinsi` (
  `id` int(11) UNSIGNED NOT NULL,
  `nama_provinsi` varchar(100) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `provinsi`
--

INSERT INTO `provinsi` (`id`, `nama_provinsi`, `created_at`, `updated_at`) VALUES
(1, 'Jawa Barat', NULL, NULL),
(2, 'Jawa Tengah', NULL, '2025-11-01 05:29:45'),
(3, 'Jawa Timur', NULL, NULL),
(4, 'Kalimantan Selatan', '2025-10-31 23:59:12', '2025-10-31 23:59:12'),
(5, 'Bali', '2025-10-31 23:59:42', '2025-10-31 23:59:42'),
(6, 'NTT', '2025-11-01 00:58:58', '2025-11-01 00:58:58'),
(8, 'NTB', '2025-11-01 05:30:04', '2025-11-01 05:30:04');

-- --------------------------------------------------------

--
-- Struktur dari tabel `sensus`
--

CREATE TABLE `sensus` (
  `id` int(11) UNSIGNED NOT NULL,
  `nama_penduduk` varchar(255) NOT NULL,
  `nik` varchar(16) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `id_kota` int(11) UNSIGNED DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `jenis_kelamin` enum('L','P') DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `sensus`
--

INSERT INTO `sensus` (`id`, `nama_penduduk`, `nik`, `alamat`, `id_kota`, `tanggal_lahir`, `jenis_kelamin`, `created_at`, `updated_at`) VALUES
(1, 'Wahyu Eko Suroso', '3276012300010001', 'Jl. Merdeka No. 11, Bandung', 1, '1999-02-14', 'L', NULL, NULL),
(2, 'Dewi Lestari', '3276012300010002', 'Jl. Pandanaran No. 25, Semarang', 2, '1998-05-22', 'P', NULL, NULL),
(3, 'Eko', '3176548277129929', 'Jl. Merdeka no.19', 4, '2000-09-12', 'L', NULL, NULL),
(4, 'Yuli', '3212356562311111', 'Jalan Batu, NTT', 6, '2000-12-12', 'P', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(150) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(50) NOT NULL DEFAULT 'user',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `kota`
--
ALTER TABLE `kota`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kota_id_provinsi_foreign` (`id_provinsi`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `provinsi`
--
ALTER TABLE `provinsi`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `sensus`
--
ALTER TABLE `sensus`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sensus_id_kota_foreign` (`id_kota`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `kota`
--
ALTER TABLE `kota`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `provinsi`
--
ALTER TABLE `provinsi`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `sensus`
--
ALTER TABLE `sensus`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `kota`
--
ALTER TABLE `kota`
  ADD CONSTRAINT `kota_id_provinsi_foreign` FOREIGN KEY (`id_provinsi`) REFERENCES `provinsi` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `sensus`
--
ALTER TABLE `sensus`
  ADD CONSTRAINT `sensus_id_kota_foreign` FOREIGN KEY (`id_kota`) REFERENCES `kota` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
