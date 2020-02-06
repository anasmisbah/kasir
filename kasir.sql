-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 06 Feb 2020 pada 04.17
-- Versi server: 10.4.8-MariaDB
-- Versi PHP: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kasir`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `applications`
--

CREATE TABLE `applications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `toko` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `telepon` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `logo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'logo/default.jpg',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `applications`
--

INSERT INTO `applications` (`id`, `nama`, `toko`, `alamat`, `telepon`, `logo`, `created_at`, `updated_at`) VALUES
(1, 'bedun', 'cici bedu jayan', 'jl samarindan', '0852525252230', 'logo/4Nx1FNsdYfe5rU41nyplIr2a2SBGm2x7cfscR1Nj.png', '2020-02-03 22:44:01', '2020-02-04 19:24:08');

-- --------------------------------------------------------

--
-- Struktur dari tabel `bills`
--

CREATE TABLE `bills` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tanggal_nota` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `diskon` double NOT NULL,
  `total_nota` double NOT NULL,
  `jumlah_uang_nota` double NOT NULL,
  `kembalian_nota` double NOT NULL,
  `status` enum('lunas','piutang') COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_nota_kas` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `branch_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `bills`
--

INSERT INTO `bills` (`id`, `tanggal_nota`, `diskon`, `total_nota`, `jumlah_uang_nota`, `kembalian_nota`, `status`, `no_nota_kas`, `customer_id`, `user_id`, `branch_id`, `created_at`, `updated_at`) VALUES
(3, '2019-11-01 07:39:06', 5, 25650, 60000, 34350, 'lunas', '230522020', 4, 3, 2, '2020-02-05 07:39:06', '2020-02-05 07:39:06'),
(4, '2020-02-05 07:42:16', 10, 36900, 100000, 63100, 'lunas', '234522020', 6, 3, 2, '2020-02-05 07:42:16', '2020-02-05 07:42:16'),
(5, '2020-02-05 07:45:00', 0, 63000, 89000, 26000, 'lunas', '235522020', 4, 3, 2, '2020-02-05 07:45:00', '2020-02-05 07:45:00'),
(6, '2020-02-05 09:08:20', 0, 125000, 100000, -25000, 'piutang', '236522020', 7, 3, 2, '2020-02-05 09:08:20', '2020-02-05 09:08:20'),
(7, '2020-02-05 16:11:09', 7, 53010, 90000, 36990, 'lunas', '167622020', 9, 5, 1, '2020-02-05 16:11:09', '2020-02-05 16:11:09'),
(8, '2020-02-05 16:12:59', 7, 78120, 70000, -8120, 'piutang', '168622020', 10, 5, 1, '2020-02-05 16:12:59', '2020-02-05 16:12:59');

-- --------------------------------------------------------

--
-- Struktur dari tabel `branches`
--

CREATE TABLE `branches` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `telepon` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pimpinan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `branches`
--

INSERT INTO `branches` (`id`, `nama`, `alamat`, `telepon`, `pimpinan`, `created_at`, `updated_at`) VALUES
(1, 'samarinda', 'jl samarinda', '085253456545', 'ahmad', '2020-02-03 21:26:18', '2020-02-03 21:26:18'),
(2, 'balikpapan', 'jl balikpapan', '085253456545', 'tello', '2020-02-03 21:26:18', '2020-02-03 21:26:18'),
(3, 'tenggarong', 'jl tenggarong', '085253456545', 'adi', '2020-02-03 21:26:18', '2020-02-03 21:26:18');

-- --------------------------------------------------------

--
-- Struktur dari tabel `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `categories`
--

INSERT INTO `categories` (`id`, `nama`, `created_at`, `updated_at`) VALUES
(1, 'Sembako', '2020-02-03 21:26:18', '2020-02-03 21:26:18'),
(2, 'Minuman', '2020-02-03 21:26:18', '2020-02-03 21:26:18'),
(3, 'Makanan', '2020-02-03 21:26:18', '2020-02-03 21:26:18');

-- --------------------------------------------------------

--
-- Struktur dari tabel `customers`
--

CREATE TABLE `customers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `telepon` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `branch_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `customers`
--

INSERT INTO `customers` (`id`, `nama`, `alamat`, `telepon`, `created_at`, `updated_at`, `branch_id`) VALUES
(1, 'anas', 'jl pramuka 13', '08525246584', '2020-02-04 08:44:30', '2020-02-04 08:44:30', 1),
(3, 'indah', 'jl indahan', '09090909', '2020-02-05 01:10:59', '2020-02-05 01:10:59', 2),
(4, 'jihan', 'jl jihan', '08078736', '2020-02-05 01:11:21', '2020-02-05 01:11:21', 2),
(5, 'julian', 'jl julian', '458795462', '2020-02-05 05:08:19', '2020-02-05 05:08:19', 2),
(6, 'anas', 'jl samarinda', '081255035199', '2020-02-05 05:12:53', '2020-02-05 05:12:53', 2),
(7, 'tiktok', 'jl tiktok', '8973748', '2020-02-05 05:15:07', '2020-02-05 05:15:07', 2),
(8, 'kelola', 'jl kelola', '76876', '2020-02-05 05:18:28', '2020-02-05 05:18:28', 2),
(9, 'intan', 'jl samarinda', '081255035199', '2020-02-05 16:10:36', '2020-02-05 16:10:36', 1),
(10, 'silvi', 'jl kuota', '081255035199', '2020-02-05 16:12:16', '2020-02-05 16:12:16', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `employees`
--

CREATE TABLE `employees` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis_kelamin` enum('laki-laki','perempuan') COLLATE utf8mb4_unicode_ci NOT NULL,
  `jabatan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `telepon` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'fotos/default.jpg',
  `branch_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `employees`
--

INSERT INTO `employees` (`id`, `nama`, `jenis_kelamin`, `jabatan`, `alamat`, `telepon`, `foto`, `branch_id`, `created_at`, `updated_at`) VALUES
(1, 'admin utama', 'laki-laki', 'ketua admin utama', 'jl samarinda', '085253456545', 'fotos/default.jpg', 1, '2020-02-03 21:26:18', '2020-02-03 21:26:18'),
(2, 'admin cabang', 'perempuan', 'bendahara cabang', 'jl balikpapan utara', '085253456545', 'fotos/default.jpg', 2, '2020-02-03 21:26:18', '2020-02-03 21:26:18'),
(3, 'kasir cabang', 'laki-laki', 'kasir', 'jl balikpapan selatan', '085253456545', 'fotos/default.jpg', 2, '2020-02-03 21:26:18', '2020-02-03 21:26:18'),
(5, 'anas', 'laki-laki', 'Sekretarista', 'jl samarinda', '081255035199', 'fotos/03b9z3wss6sdknbtrJUjUdQvJJnzWV6z3dbJNwmM.png', 1, '2020-02-04 18:37:52', '2020-02-04 18:37:52'),
(6, 'huan', 'laki-laki', 'kasir', 'jl kenangan', '85212354', 'fotos/aIrOvuNDxzi4dGWe3WahVZphcuSRFqsx7u9pWCJ9.png', 1, '2020-02-05 16:04:32', '2020-02-05 16:04:32');

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `items`
--

CREATE TABLE `items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `harga` double NOT NULL DEFAULT 0,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `items`
--

INSERT INTO `items` (`id`, `nama`, `harga`, `category_id`, `created_at`, `updated_at`) VALUES
(1, 'Beras Murtiara', 5000, 1, '2020-02-03 21:28:45', '2020-02-03 21:28:45'),
(2, 'Oronamin C', 5000, 2, '2020-02-03 21:28:45', '2020-02-03 21:28:45'),
(3, 'Indomie', 7000, 3, '2020-02-03 21:28:45', '2020-02-04 16:58:44');

-- --------------------------------------------------------

--
-- Struktur dari tabel `levels`
--

CREATE TABLE `levels` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `levels`
--

INSERT INTO `levels` (`id`, `nama`, `created_at`, `updated_at`) VALUES
(1, 'utama', '2020-02-03 21:26:18', '2020-02-03 21:26:18'),
(2, 'cabang', '2020-02-03 21:26:18', '2020-02-03 21:26:18'),
(3, 'kasir', '2020-02-03 21:26:18', '2020-02-03 21:26:18');

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_100000_create_password_resets_table', 1),
(2, '2019_08_19_000000_create_failed_jobs_table', 1),
(3, '2020_02_03_165232_create_levels_table', 1),
(4, '2020_02_03_165447_create_users_table', 1),
(5, '2020_02_03_170102_create_branches_table', 1),
(6, '2020_02_03_170149_create_employees_table', 1),
(7, '2020_02_03_170548_create_categories_table', 1),
(8, '2020_02_03_170630_create_items_table', 1),
(9, '2020_02_03_170838_create_supplies_table', 1),
(10, '2020_02_03_171126_create_customers_table', 1),
(11, '2020_02_03_171312_create_applications_table', 1),
(12, '2020_02_03_171732_create_bills_table', 1),
(13, '2020_02_03_172248_create_transactions_table', 1),
(14, '2020_02_04_050533_add_foreign_karyawan_user', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `supplies`
--

CREATE TABLE `supplies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `harga_selisih` double NOT NULL,
  `harga_cabang` double NOT NULL,
  `stok` bigint(20) NOT NULL,
  `item_id` bigint(20) UNSIGNED NOT NULL,
  `branch_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `supplies`
--

INSERT INTO `supplies` (`id`, `harga_selisih`, `harga_cabang`, `stok`, `item_id`, `branch_id`, `created_at`, `updated_at`) VALUES
(3, 3000, 8000, 90, 1, 2, '2020-02-05 01:12:00', '2020-02-05 01:12:00'),
(4, 4000, 9000, 6, 2, 2, '2020-02-05 02:11:28', '2020-02-05 02:11:28'),
(5, 2000, 9000, 90, 3, 2, '2020-02-05 02:11:46', '2020-02-05 02:11:46'),
(6, 3000, 8000, 40, 1, 2, '2020-02-05 16:07:00', '2020-02-05 16:07:00'),
(7, 2000, 7000, 90, 1, 1, '2020-02-05 16:09:20', '2020-02-05 16:09:20'),
(8, 2000, 9000, 70, 3, 1, '2020-02-05 16:09:36', '2020-02-05 16:09:36'),
(9, 1000, 6000, 60, 2, 1, '2020-02-05 16:09:58', '2020-02-05 16:09:58');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tanggal`
--

CREATE TABLE `tanggal` (
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `nama` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tanggal`
--

INSERT INTO `tanggal` (`date`, `nama`) VALUES
('2020-01-22 16:00:00', ''),
('2020-01-23 16:00:00', ''),
('2020-01-23 16:00:00', ''),
('2020-01-27 16:00:00', ''),
('2020-01-31 16:00:00', ''),
('2020-02-02 16:00:00', ''),
('2019-12-03 16:00:00', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transactions`
--

CREATE TABLE `transactions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kuantitas` bigint(20) NOT NULL,
  `total_harga` double NOT NULL,
  `no_urut` bigint(20) NOT NULL,
  `supply_id` bigint(20) UNSIGNED NOT NULL,
  `bill_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `transactions`
--

INSERT INTO `transactions` (`id`, `kuantitas`, `total_harga`, `no_urut`, `supply_id`, `bill_id`, `created_at`, `updated_at`) VALUES
(1, 1, 9000, 1, 4, 3, '2020-02-05 07:39:06', '2020-02-05 07:39:06'),
(2, 2, 18000, 2, 5, 3, '2020-02-05 07:39:06', '2020-02-05 07:39:06'),
(3, 1, 9000, 1, 4, 4, '2020-02-05 07:42:16', '2020-02-05 07:42:16'),
(4, 4, 32000, 2, 3, 4, '2020-02-05 07:42:16', '2020-02-05 07:42:16'),
(5, 3, 27000, 1, 4, 5, '2020-02-05 07:45:00', '2020-02-05 07:45:00'),
(6, 4, 36000, 2, 5, 5, '2020-02-05 07:45:00', '2020-02-05 07:45:00'),
(7, 10, 80000, 1, 3, 6, '2020-02-05 09:08:20', '2020-02-05 09:08:20'),
(8, 5, 45000, 2, 4, 6, '2020-02-05 09:08:20', '2020-02-05 09:08:20'),
(9, 3, 21000, 1, 7, 7, '2020-02-05 16:11:09', '2020-02-05 16:11:09'),
(10, 4, 36000, 2, 8, 7, '2020-02-05 16:11:09', '2020-02-05 16:11:09'),
(11, 3, 21000, 1, 7, 8, '2020-02-05 16:12:59', '2020-02-05 16:12:59'),
(12, 7, 63000, 2, 8, 8, '2020-02-05 16:12:59', '2020-02-05 16:12:59');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `level_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `employee_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `remember_token`, `level_id`, `created_at`, `updated_at`, `employee_id`) VALUES
(1, 'adminutama', 'adminutama@admin.com', '$2y$10$AuvSBa7wiU2hhhSPntbB9uzNxLG7AMWDNJ2zfMWBxzS7Rf7hofgD2', NULL, 1, '2020-02-03 21:26:18', '2020-02-03 21:26:18', 1),
(2, 'admincabang', 'admincabang@admin.com', '$2y$10$lBcdaN2ZbugKAEIky9nJS.pUeyHz07WHWyI.4CIQrYBgejBM1p2dO', NULL, 2, '2020-02-03 21:26:18', '2020-02-03 21:26:18', 2),
(3, 'kasircabang', 'kasircabang@admin.com', '$2y$10$apb2BZgp.v0YGdRxGO3qDucmSp1///8qF46G1dgO8oLCTw3w15Xhu', NULL, 3, '2020-02-03 21:26:19', '2020-02-03 21:26:19', 3),
(5, 'huan', 'huan@admin.com', '$2y$10$EaEo9fP0/7QpoxO7X68csue3jBxFwnUuHuSRP.2mTOMv9Mk9Z6fNW', NULL, 3, '2020-02-05 16:05:18', '2020-02-05 16:05:18', 6);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `applications`
--
ALTER TABLE `applications`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `bills`
--
ALTER TABLE `bills`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `bills_no_nota_kas_unique` (`no_nota_kas`),
  ADD KEY `bills_customer_id_foreign` (`customer_id`),
  ADD KEY `bills_user_id_foreign` (`user_id`),
  ADD KEY `bills_branch_id_foreign` (`branch_id`);

--
-- Indeks untuk tabel `branches`
--
ALTER TABLE `branches`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customers_branch_id_foreign` (`branch_id`);

--
-- Indeks untuk tabel `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`),
  ADD KEY `employees_branch_id_foreign` (`branch_id`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `items_category_id_foreign` (`category_id`);

--
-- Indeks untuk tabel `levels`
--
ALTER TABLE `levels`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indeks untuk tabel `supplies`
--
ALTER TABLE `supplies`
  ADD PRIMARY KEY (`id`),
  ADD KEY `supplies_branch_id_foreign` (`branch_id`),
  ADD KEY `supplies_item_id_foreign` (`item_id`);

--
-- Indeks untuk tabel `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transactions_supply_id_foreign` (`supply_id`),
  ADD KEY `transactions_bill_id_foreign` (`bill_id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_level_id_foreign` (`level_id`),
  ADD KEY `users_employee_id_foreign` (`employee_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `applications`
--
ALTER TABLE `applications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `bills`
--
ALTER TABLE `bills`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `branches`
--
ALTER TABLE `branches`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `customers`
--
ALTER TABLE `customers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `employees`
--
ALTER TABLE `employees`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `items`
--
ALTER TABLE `items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `levels`
--
ALTER TABLE `levels`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `supplies`
--
ALTER TABLE `supplies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `bills`
--
ALTER TABLE `bills`
  ADD CONSTRAINT `bills_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `bills_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `bills_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `customers`
--
ALTER TABLE `customers`
  ADD CONSTRAINT `customers_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `employees`
--
ALTER TABLE `employees`
  ADD CONSTRAINT `employees_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `items`
--
ALTER TABLE `items`
  ADD CONSTRAINT `items_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `supplies`
--
ALTER TABLE `supplies`
  ADD CONSTRAINT `supplies_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `supplies_item_id_foreign` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `transactions_bill_id_foreign` FOREIGN KEY (`bill_id`) REFERENCES `bills` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `transactions_supply_id_foreign` FOREIGN KEY (`supply_id`) REFERENCES `supplies` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `users_level_id_foreign` FOREIGN KEY (`level_id`) REFERENCES `levels` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
