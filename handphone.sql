-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 18, 2026 at 07:07 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `handphone`
--

-- --------------------------------------------------------

--
-- Table structure for table `alamats`
--

CREATE TABLE `alamats` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL,
  `phone_number` varchar(255) NOT NULL,
  `provinsi` varchar(255) NOT NULL,
  `kabupaten` varchar(255) NOT NULL,
  `kecamatan` varchar(255) NOT NULL,
  `desa` varchar(255) NOT NULL,
  `rt` varchar(3) DEFAULT NULL,
  `rw` varchar(3) DEFAULT NULL,
  `kode_pos` varchar(10) NOT NULL,
  `alamat_detail` text NOT NULL,
  `latitude` decimal(10,8) NOT NULL,
  `longitude` decimal(11,8) NOT NULL,
  `label` varchar(255) DEFAULT NULL,
  `is_utama` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `alamats`
--

INSERT INTO `alamats` (`id`, `user_id`, `nama`, `phone_number`, `provinsi`, `kabupaten`, `kecamatan`, `desa`, `rt`, `rw`, `kode_pos`, `alamat_detail`, `latitude`, `longitude`, `label`, `is_utama`, `created_at`, `updated_at`) VALUES
(1, 4, 'Muhammad Daffa Dzaki Pratama', '12345678', 'Jawa Tengah', 'Kabupaten Karanganyar', 'Karanganyar', 'Karanganyar', '016', '016', '123', 'rumah ada pagarnya', -7.58835720, 110.92739403, 'Rumah', 1, '2026-05-06 07:30:57', '2026-05-06 07:30:57'),
(2, 6, 'daffa dzaki', '0812345678', 'Jawa Tengah', 'Kabupaten Karanganyar', 'Karanganyar', 'Karanganyar', '008', '008', '57721', 'rumah kosong', -7.78240000, 110.36590080, 'Rumah', 1, '2026-05-17 21:23:52', '2026-05-17 21:23:52');

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `type`, `name`, `slug`, `created_at`, `updated_at`) VALUES
(1, 'hp', 'Apple', 'apple', '2026-05-05 01:26:38', '2026-05-05 01:26:38'),
(2, 'hp', 'Samsung', 'samsung', '2026-05-05 01:26:38', '2026-05-05 01:26:38'),
(3, 'hp', 'Xiaomi', 'xiaomi', '2026-05-05 01:26:38', '2026-05-05 01:26:38'),
(4, 'hp', 'Lenovo', 'lenovo', '2026-05-05 01:26:38', '2026-05-05 01:26:38'),
(5, 'aksesoris', 'Samsung', 'samsung2', '2026-05-05 01:26:38', '2026-05-05 01:26:38'),
(6, 'aksesoris', 'Ugreen', 'ugreen', '2026-05-05 01:26:38', '2026-05-05 01:26:38'),
(7, 'hp', 'Oppo', 'oppo', '2026-05-11 04:55:45', '2026-05-11 04:55:45'),
(8, 'hp', 'Vivo', 'vivo', '2026-05-11 04:55:45', '2026-05-11 04:55:45'),
(9, 'hp', 'Realme', 'realme', '2026-05-11 04:55:45', '2026-05-11 04:55:45'),
(10, 'hp', 'Infinix', 'infinix', '2026-05-11 04:55:45', '2026-05-11 04:55:45'),
(11, 'aksesoris', 'Baseus', 'baseus', '2026-05-11 04:55:45', '2026-05-11 04:55:45'),
(12, 'aksesoris', 'Aukey', 'aukey', '2026-05-11 04:55:45', '2026-05-11 04:55:45'),
(13, 'aksesoris', 'JBL', 'jbl', '2026-05-11 04:55:45', '2026-05-11 04:55:45');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `carts`
--

INSERT INTO `carts` (`id`, `user_id`, `product_id`, `quantity`, `created_at`, `updated_at`) VALUES
(12, 5, 28, 1, '2026-05-10 21:45:55', '2026-05-10 21:45:55');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2026_04_28_141854_create_brands_table', 1),
(5, '2026_04_28_142004_create_products_table', 1),
(6, '2026_04_29_060017_create_user_profiles_table', 1),
(7, '2026_04_30_000001_fix_brands_type_unique_index', 1),
(8, '2026_05_01_100436_create_carts_table', 1),
(9, '2026_05_01_154441_create_alamats_table', 1),
(10, '2026_05_06_145150_create_orders_table', 2),
(11, '2026_05_06_145224_create_order_items_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `total` decimal(12,2) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `total`, `status`, `created_at`, `updated_at`) VALUES
(1, 4, 1913084.00, 'diproses', '2026-05-06 07:58:51', '2026-05-06 07:58:51'),
(2, 4, 14343781.00, 'diproses', '2026-05-06 08:03:27', '2026-05-06 08:03:27'),
(3, 4, 14343781.00, 'diproses', '2026-05-06 08:06:12', '2026-05-06 08:06:12'),
(4, 4, 14343781.00, 'diproses', '2026-05-06 08:09:50', '2026-05-06 08:09:50'),
(5, 4, 1617985.00, 'diproses', '2026-05-06 08:41:31', '2026-05-06 08:41:31'),
(6, 4, 14343781.00, 'diproses', '2026-05-06 08:46:17', '2026-05-06 08:46:17'),
(7, 4, 14343781.00, 'diproses', '2026-05-06 08:49:20', '2026-05-06 08:49:20'),
(8, 4, 14343781.00, 'diproses', '2026-05-06 09:06:58', '2026-05-06 09:06:58'),
(9, 4, 4431949.00, 'diproses', '2026-05-06 09:07:15', '2026-05-06 09:07:15'),
(11, 4, 4431949.00, 'diproses', '2026-05-06 10:09:05', '2026-05-06 10:09:05'),
(12, 6, 3500000.00, 'diproses', '2026-05-17 21:24:04', '2026-05-17 21:24:04');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(12,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `quantity`, `price`, `created_at`, `updated_at`) VALUES
(12, 12, 42, 1, 3500000.00, '2026-05-17 21:24:04', '2026-05-17 21:24:04');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `brand_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `stock` int(11) NOT NULL DEFAULT 0,
  `image` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `ram` varchar(255) DEFAULT NULL,
  `storage` varchar(255) DEFAULT NULL,
  `battery` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `brand_id`, `name`, `price`, `stock`, `image`, `description`, `ram`, `storage`, `battery`, `created_at`, `updated_at`) VALUES
(25, 1, 'IPHONE 17 PROMAX', 25000000, 5, 'products/xZl7r193Q7UiBSZNhbckE4K9lXiwcw6Jj2Swkgxj.png', 'Iphone seri terbaru', '8 GB', '1 TB', '5000 mAH', '2026-05-10 20:36:36', '2026-05-10 20:36:36'),
(26, 2, 'Samsung Galaxy A25', 24499000, 7, 'products/VxPk8uXtd5O6omUhcjTvVdWQr5iudtsXYrko3AMe.png', 'Samsung Galaxy S26 Ultra (rilis Februari 2026) adalah flagship premium yang mengunggulkan kamera utama 200MP dengan aperture f/1.4 yang lebih terang, chipset Snapdragon 8 Elite Gen 5, dan layar 6,9 inci. Ponsel ini berfokus pada AI,  nightography yang ditingkatkan, serta fitur unik seperti privacy display dan horizontal lock', '12 GB', '256 GB', '5000 mAH', '2026-05-10 20:42:49', '2026-05-10 20:42:49'),
(27, 1, 'IPHONE 14 PROMAX', 13500000, 8, 'products/zIhydTkKc8OW7RA7iR8Xqhv4kLD91XW3lHeFLWNs.png', 'Apple iPhone 14 Pro Max adalah smartphone flagship dari Apple yang dirilis dengan peningkatan besar di sektor kamera, performa, dan layar.\r\n\r\nDitenagai oleh chip A16 Bionic, iPhone ini menawarkan performa sangat cepat dan efisien, cocok untuk multitasking, gaming berat, hingga editing video profesional.\r\n\r\n✨ Fitur utama:\r\n📸 Kamera Pro 48MP dengan hasil foto lebih detail dan tajam\r\n🌙 Mode malam lebih optimal untuk low light\r\n📺 Layar Super Retina XDR 6.7 inci dengan ProMotion 120Hz\r\n⚡ Chip A16 Bionic (super kencang & hemat daya)\r\n🔋 Baterai tahan lama untuk penggunaan seharian\r\n🔒 Face ID & Dynamic Island (fitur interaktif notifikasi Apple)\r\n💡 Cocok untuk:\r\nKonten kreator 📷\r\nGaming 🎮\r\nFotografi & videografi 🎥\r\nPengguna yang butuh HP premium', '6 GB', '256 GB', '4500 mAH', '2026-05-10 20:50:40', '2026-05-10 20:50:40'),
(28, 1, 'IPHONE 16', 14000000, 10, 'products/mWKlLBbYVEmSByDD5YfVCKuERTVTeuejBJnclYJo.png', 'Apple iPhone 16 adalah smartphone flagship terbaru dari Apple yang hadir dengan desain premium, performa super cepat, dan teknologi kamera generasi terbaru. Dibekali chipset terbaru Apple yang lebih efisien dan bertenaga, iPhone 16 mampu memberikan pengalaman multitasking, gaming, hingga editing video dengan sangat lancar.\r\n\r\nLayar Super Retina XDR yang cerah dan tajam membuat tampilan visual terlihat lebih hidup, baik saat menonton film, bermain game, maupun scrolling media sosial. Desainnya tetap elegan dengan material berkualitas tinggi yang nyaman digenggam dan memberikan kesan mewah.\r\n\r\nPada sektor kamera, iPhone 16 menawarkan peningkatan kualitas foto dan video dengan hasil lebih detail, warna natural, serta performa low-light yang semakin baik. Fitur AI terbaru juga membantu menghasilkan foto profesional hanya dengan sekali jepret.\r\n\r\nDaya tahan baterai lebih optimal sehingga dapat digunakan seharian penuh untuk aktivitas produktivitas maupun hiburan. Didukung sistem operasi iOS terbaru, iPhone 16 memberikan keamanan tinggi, performa stabil, dan ekosistem Apple yang terintegrasi dengan sangat baik.\r\n\r\nCocok untuk pengguna yang menginginkan smartphone premium dengan performa tinggi, kamera berkualitas profesional, desain modern, dan pengalaman penggunaan yang eksklusif.', '8 GB', '256 GB', '3561 mAh', '2026-05-10 21:25:43', '2026-05-10 21:25:43'),
(29, 3, 'xiaomi 14 ultra', 20000000, 12, 'images/products/DDRPGL2sJwmgwgmjFKrk63aORioUARgwE5AIHFr8.png', 'Xiaomi 14 Ultra adalah salah satu HP flagship terbaik dari Xiaomi\r\n yang fokus pada fotografi profesional dan performa ekstrem. Smartphone ini dirancang untuk pengguna yang suka fotografi, videografi, gaming berat, hingga multitasking kelas tinggi.\r\n\r\n✨ Desain & Layar\r\n\r\nXiaomi 14 Ultra memakai desain premium dengan finishing elegan dan modul kamera besar khas Leica. Layarnya menggunakan panel AMOLED LTPO 6,73 inci resolusi WQHD+ dengan refresh rate 1–120Hz adaptif, sehingga animasi terasa sangat smooth sekaligus hemat baterai. Tingkat kecerahannya mencapai 3000 nits, jadi tetap jelas saat dipakai di bawah sinar matahari.\r\n\r\n⚡ Performa\r\n\r\nHP ini ditenagai chipset Snapdragon 8 Gen 3 fabrikasi 4nm yang termasuk chipset Android tercepat saat ini. Dipadukan RAM LPDDR5X dan storage UFS 4.0, performanya sangat kencang untuk:\r\n\r\nGaming ultra setting\r\nEditing video 4K/8K\r\nMultitasking berat\r\nAI processing dan rendering cepat\r\n\r\nHyperOS juga terasa lebih ringan dan responsif dibanding MIUI generasi lama.\r\n\r\n📸 Kamera Leica Profesional\r\n\r\nBagian paling menarik dari Xiaomi 14 Ultra adalah kameranya. Smartphone ini memakai sistem quad camera Leica 50MP:\r\n\r\nKamera utama 1 inci Sony LYT-900\r\nTelephoto 75mm\r\nPeriscope 120mm\r\nUltrawide 122°\r\n\r\nKualitas fotonya sangat detail dengan warna khas Leica yang terlihat lebih natural dan profesional. Bukaan variabel f/1.63–f/4.0 membuat hasil foto malam lebih bagus dan fleksibel seperti kamera DSLR. Banyak reviewer dan pengguna menyebut kamera Xiaomi 14 Ultra sebagai salah satu kamera HP terbaik saat ini.', '12 GB', '512 GB', '5300mAh', '2026-05-10 21:30:44', '2026-05-17 07:12:29'),
(30, 3, 'redmi note 14', 3199000, 10, 'products/Hdme4NH6wQAYIWMga3tMPn9qxc3eT8lYYHrqiSi5.png', 'HP mid-range gaming dengan performa kencang dan layar AMOLED 120Hz.', '8 GB', '256', '5110 mAh', '2026-05-17 07:07:45', '2026-05-17 07:07:45'),
(31, 8, 'Vivo Y21d', 3399000, 7, 'products/J8yfOsd57NysjCE64AQ8nW34oz4iWDNnqZYhvIYm.png', 'Smartphone baterai jumbo untuk pemakaian harian yang tahan lama.', '8 GB', '256', '6500 mAh', '2026-05-17 07:10:43', '2026-05-17 07:10:43'),
(32, 7, 'OPPO Reno 12F 5G', 4789000, 6, 'products/dN94ybdIayRyiWa3w6l7xFtjCt3awsQTGSR9OX7Z.png', 'HP OPPO stylish dengan layar AMOLED 120Hz, kamera AI 50MP, dan storage besar cocok untuk gaming maupun content creator.', '12 GB', '512 GB', '5000 mAH', '2026-05-17 07:22:06', '2026-05-17 07:22:06'),
(33, 7, 'OPPO A5 Pro', 3499000, 8, 'products/T4INr5Q58jRifcVDcNe9RVi6zMCBVWKSWOh14T8y.png', 'OPPO A5 Pro cocok untuk pengguna yang mencari HP murah tetapi tetap stylish dan awet dipakai sehari-hari. Sangat cocok untuk pelajar, pekerja, maupun penggunaan sosial media.', '8 GB', '256 GB', '5800 mAH', '2026-05-17 07:24:53', '2026-05-17 07:24:53'),
(34, 7, 'OPPO Find X8', 15998999, 8, 'products/6RPFEusrfDRt8CoMOV2Ua5VI2aRmBW2wSYH4O5T1.png', 'OPPO Find X8 adalah flagship premium dengan performa kelas atas untuk gaming berat, fotografi profesional, editing video, dan multitasking ekstrem. Desainnya elegan dengan build quality premium.', '16 GB', '512 GB', '5630 mAH', '2026-05-17 07:28:11', '2026-05-17 07:28:11'),
(35, 10, 'Infinix GT 20 Pro', 3555000, 9, 'products/D2B5saBHqeJDRmKxhBbjAcvTNn1wIwJgxnAyOj7e.png', 'Infinix GT 20 Pro dibuat khusus untuk gamer yang ingin performa tinggi dengan harga lebih terjangkau dibanding flagship gaming phone lainnya. Desain RGB Mecha Loop di bagian belakang membuat tampilannya sangat futuristik dan cocok untuk gaming setup.', '128 GB', '256 GB', '5000 mAH', '2026-05-17 07:31:46', '2026-05-17 07:31:46'),
(36, 10, 'Infinix Note 40 Pro', 2587000, 10, 'products/4b41vu5x8QzLj2vpthXsz5quSCXBvIFxQelnDoGx.png', 'Infinix Note 40 Pro cocok untuk pengguna yang ingin desain premium dengan curved AMOLED display dan pengalaman multimedia yang nyaman. HP ini sangat cocok untuk sosial media, fotografi, dan penggunaan sehari-hari.', '8 GB', '256 GB', '5000 mAH', '2026-05-17 07:34:16', '2026-05-17 07:34:16'),
(37, 10, 'Infinix Hot 50 Pro Plus', 3000000, 9, 'products/t5gOZVqHos9hsj9mfuNA3kdTAwmazOpHpbI0cnBH.png', 'Infinix Hot 50 Pro Plus cocok untuk pengguna yang ingin HP murah tetapi tetap modern dan powerful. Desain tipis, layar AMOLED, dan refresh rate tinggi membuat HP ini sangat worth it di kelas harga 2 jutaan.', '8 GB', '256 GB', '5000 mAH', '2026-05-17 07:36:51', '2026-05-17 07:36:51'),
(38, 4, 'Lenovo Legion Y90', 12400000, 5, 'products/tQqpybJrxpxB6DJ0upSrfJ1CtpR973dNHI2QMJkO.png', 'Lenovo Legion Y90 merupakan gaming phone premium yang dibuat khusus untuk gamer hardcore. HP ini memiliki desain futuristik dengan RGB lighting, dual cooling fan, dan trigger ultrasonic seperti console gaming. Sangat cocok untuk PUBG Mobile, Genshin Impact, CODM, hingga emulator berat.', '12 GB', '256 GB', '5600 mAH', '2026-05-17 07:41:56', '2026-05-17 07:41:56'),
(39, 4, 'Lenovo Legion Phone Pro', 10850000, 7, 'products/WrKxdqvIa8xopD36ub6W96Ft4gCfFvM03jectLEQ.png', 'Lenovo Legion Phone Pro hadir dengan desain unik horizontal gaming mode dan kamera pop-up samping untuk streamer maupun content creator gaming. HP ini terkenal karena performanya yang stabil dan sistem pendinginan yang agresif.', '16 GB', '512 GB', NULL, '2026-05-17 07:44:39', '2026-05-17 07:44:39'),
(40, 4, 'Motorola ThinkPhone by Lenovo', 10720000, 5, 'products/dAySHrPNRh9YDOt3Gpn5rZzFED1b6hemIwJaHuZk.png', 'ThinkPhone by Motorola adalah HP premium enterprise dari Lenovo yang dibuat untuk profesional dan pebisnis. Desainnya terinspirasi dari laptop Lenovo ThinkPad dengan material aramid fiber yang kuat dan elegan.', '8 GB', '256 GB', '5000 mAH', '2026-05-17 07:50:51', '2026-05-17 07:50:51'),
(41, 9, 'Realme GT 7', 9399000, 3, 'products/ZF3GsU4OhXsCK5EO2wW04BFuW2QDBH6cB2I8fIQb.png', 'Realme GT 7 adalah HP flagship terbaru Realme yang fokus pada performa gaming dan daya tahan baterai. Cocok untuk gamer, content creator, dan pengguna berat yang membutuhkan performa tinggi sepanjang hari. Desain IceSense Graphene membuat suhu HP tetap dingin saat bermain game berat.', '12 GB', '256 GB', '5000 mAH', '2026-05-17 07:55:58', '2026-05-17 07:55:58'),
(42, 9, 'Realme 13+ 5G', 3500000, 8, 'products/UOpywHO8DfcdEVn44KFNnUcQVZtl2SC5nGtNgpij.png', 'Realme 13+ 5G cocok untuk pengguna yang mencari HP gaming murah tetapi tetap powerful. Performa Dimensity 7300 sangat stabil untuk PUBG Mobile, Mobile Legends, CODM, hingga multitasking harian.', '12 GB', '256 GB', '5000 mAH', '2026-05-17 07:58:21', '2026-05-17 07:58:21'),
(43, 9, 'Realme C75', 2400000, 6, 'products/UlQZ1TzoYAip4kC719BlQYAD2AgfD1Su27sc1Qdf.png', 'Realme C75 cocok untuk pengguna yang ingin HP murah dengan fitur lengkap. Memiliki desain kokoh, baterai tahan lama, dan fitur NFC yang jarang ditemukan di kelas harga 2 jutaan.', '8 GB', '256 GB', '6000 mAH', '2026-05-17 08:03:14', '2026-05-17 08:03:14'),
(44, 5, 'Samsung 45W Super Fast Charger', 40000, 92, 'images/products/WJyAYsgE80uImLXXqJS8FCsNGfcYjc05L5PCiskp.png', 'Adaptor charger USB-C dengan teknologi Super Fast Charging 2.0. Cocok untuk Samsung Galaxy, Xiaomi, Oppo, Vivo, hingga iPhone USB-C terbaru. Mendukung pengisian cepat stabil dan memiliki proteksi overheat serta overcharge.', NULL, NULL, NULL, '2026-05-17 21:55:35', '2026-05-17 21:55:35');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('1rhC1Vwz5rMyMSLZ2lJZZmfqiHKiPMAq24S24aJR', 6, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 OPR/131.0.0.0 (Edition ms_store)', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiV3Z0Um8xZEdXS0FHSUY0c28xNlE1OWRrRGliMVBMZUg2Mzl4N2tqQiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDA6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9wcm9kdWN0cy9ha3Nlc29yaXMiO3M6NToicm91dGUiO3M6MTU6ImFrc2Vzb3Jpcy5pbmRleCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjY7fQ==', 1779078447),
('ikYMFvvCdGn28Mf219ljXQYZmXjiSdZv92Y11SWd', 6, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiVk5nOVh4OE9ZQjNlQUdaSllxUHN2NFJkd0NnSmFXR1BIOG5SNTRUcCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDA6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9wcm9kdWN0cy9ha3Nlc29yaXMiO3M6NToicm91dGUiO3M6MTU6ImFrc2Vzb3Jpcy5pbmRleCI7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjY7fQ==', 1779080164);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `profile_photo` varchar(255) DEFAULT NULL,
  `phone_number` varchar(15) DEFAULT NULL,
  `gender` varchar(255) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `role` enum('admin','user') NOT NULL DEFAULT 'user',
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `email`, `email_verified_at`, `password`, `profile_photo`, `phone_number`, `gender`, `date_of_birth`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin', 'admin@example.com', NULL, '$2y$12$dGEzMTAqLHpxDufnzWNYReuMjr86jFqfx7IfJdoubAXixyJVPyLrO', NULL, NULL, NULL, NULL, 'admin', NULL, '2026-05-05 01:26:38', '2026-05-05 01:26:38'),
(2, 'Ardian', 'ardian', 'ardian@example.com', NULL, '$2y$12$TtJXSO/aa43DzmVeVsB8h.R5/XqTfbKFhmHVx1aXJef16sTnZlY1y', NULL, '081234567890', NULL, NULL, 'user', NULL, '2026-05-05 01:26:38', '2026-05-05 01:26:38'),
(3, 'Muhammad Daffa Dzaki Pratama', 'Daffa Dzaki', 'daffa@gmail.com', NULL, '$2y$12$pJZsYIozCH3aJdUdtE9Nl.qcT920ceb/f3UY7ACNNRBnRXnRN5qYy', NULL, NULL, NULL, NULL, 'user', NULL, '2026-05-05 01:28:08', '2026-05-05 01:28:08'),
(4, 'Muhammad Daffa Dzaki Pratama', 'Muhammad Daffa Dzaki Pratama', 'dzaki546@gmail.com', NULL, '$2y$12$NXqGvbTVkf.zpnm8p03KseARp3CnuauA.LF1uIiIukUM3k0a3ApPG', NULL, '12345678', 'Laki-laki', '2025-04-11', 'user', NULL, '2026-05-06 07:23:26', '2026-05-06 07:30:01'),
(5, 'udinudin', 'udin123', 'udin123@gmail.com', NULL, '$2y$12$PEkuppD74MW01db8d.k7K.NLRqR3PlQq.AKyN4vGd9omuX8jvmL9K', NULL, NULL, NULL, NULL, 'user', NULL, '2026-05-10 19:57:37', '2026-05-10 19:57:37'),
(6, 'daffa dzaki', 'dzaki pratama', 'dzaki130546@gmail.com', NULL, '$2y$12$mgmoWaGKpoDd2Wx6ay1OzOBQixa5spUojeEyMdTVFkWaS380bX542', NULL, '0812345678', 'Laki-laki', '2004-11-25', 'user', NULL, '2026-05-17 06:58:26', '2026-05-17 21:23:13');

-- --------------------------------------------------------

--
-- Table structure for table `user_profiles`
--

CREATE TABLE `user_profiles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `phone_number` varchar(255) DEFAULT NULL,
  `profile_picture` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `alamats`
--
ALTER TABLE `alamats`
  ADD PRIMARY KEY (`id`),
  ADD KEY `alamats_user_id_foreign` (`user_id`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `brands_slug_unique` (`slug`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_expiration_index` (`expiration`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_locks_expiration_index` (`expiration`);

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `carts_user_id_foreign` (`user_id`),
  ADD KEY `carts_product_id_foreign` (`product_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_user_id_foreign` (`user_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_items_order_id_foreign` (`order_id`),
  ADD KEY `order_items_product_id_foreign` (`product_id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_brand_id_foreign` (`brand_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `user_profiles`
--
ALTER TABLE `user_profiles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_profiles_user_id_foreign` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `alamats`
--
ALTER TABLE `alamats`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user_profiles`
--
ALTER TABLE `user_profiles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `alamats`
--
ALTER TABLE `alamats`
  ADD CONSTRAINT `alamats_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `carts_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `carts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_brand_id_foreign` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `user_profiles`
--
ALTER TABLE `user_profiles`
  ADD CONSTRAINT `user_profiles_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
