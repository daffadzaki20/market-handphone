-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 22, 2026 at 06:17 AM
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
(1, 2, 'Ardian', '081234567890', 'Aceh', 'Kabupaten Aceh Barat Daya', 'Babah Rot', 'Alue Dawah', '018', '018', '12323', 'adadad', -6.20000000, 106.81666600, 'Rumah', 1, '2026-05-21 20:05:34', '2026-05-21 20:05:34');

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
(1, 'hp', 'Apple', 'apple', '2026-05-21 20:04:30', '2026-05-21 20:04:30'),
(2, 'hp', 'Samsung', 'samsung', '2026-05-21 20:04:30', '2026-05-21 20:04:30'),
(3, 'hp', 'Xiaomi', 'xiaomi', '2026-05-21 20:04:30', '2026-05-21 20:04:30'),
(4, 'hp', 'Lenovo', 'lenovo', '2026-05-21 20:04:30', '2026-05-21 20:04:30'),
(5, 'hp', 'Oppo', 'oppo', '2026-05-21 20:04:30', '2026-05-21 20:04:30'),
(6, 'hp', 'Vivo', 'vivo', '2026-05-21 20:04:30', '2026-05-21 20:04:30'),
(7, 'hp', 'Realme', 'realme', '2026-05-21 20:04:30', '2026-05-21 20:04:30'),
(8, 'hp', 'Infinix', 'infinix', '2026-05-21 20:04:30', '2026-05-21 20:04:30'),
(9, 'aksesoris', 'Samsung', 'samsung2', '2026-05-21 20:04:30', '2026-05-21 20:04:30'),
(10, 'aksesoris', 'Ugreen', 'ugreen', '2026-05-21 20:04:30', '2026-05-21 20:04:30'),
(11, 'aksesoris', 'Baseus', 'baseus', '2026-05-21 20:04:30', '2026-05-21 20:04:30'),
(12, 'aksesoris', 'Aukey', 'aukey', '2026-05-21 20:04:30', '2026-05-21 20:04:30'),
(13, 'aksesoris', 'JBL', 'jbl', '2026-05-21 20:04:30', '2026-05-21 20:04:30'),
(14, 'aksesoris', 'Anker', 'anker', '2026-05-21 20:04:30', '2026-05-21 20:04:30'),
(15, 'aksesoris', 'Mixio', 'mixio', '2026-05-21 20:04:30', '2026-05-21 20:04:30');

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
(1, 2, 20, 1, '2026-05-21 20:05:12', '2026-05-21 20:05:12');

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
(10, '2026_05_06_145150_create_orders_table', 1),
(11, '2026_05_06_145224_create_order_items_table', 1);

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
(1, 1, 'IPHONE 17 PROMAX', 25000000, 5, 'products/IPHONE 17 PROMAX.png', 'Iphone seri terbaru', '8 GB', '1 TB', '5000 mAH', '2026-05-21 20:04:30', '2026-05-21 20:04:30'),
(2, 2, 'Samsung Galaxy A25', 24499000, 7, 'products/Samsung Galaxy A25.png', 'Samsung Galaxy S26 Ultra (rilis Februari 2026) adalah flagship premium yang mengunggulkan kamera utama 200MP dengan aperture f/1.4 yang lebih terang, chipset Snapdragon 8 Elite Gen 5, dan layar 6,9 inci. Ponsel ini berfokus pada AI,  nightography yang ditingkatkan, serta fitur unik seperti privacy display dan horizontal lock', '12 GB', '256 GB', '5000 mAH', '2026-05-21 20:04:30', '2026-05-21 20:04:30'),
(3, 1, 'IPHONE 14 PROMAX', 13500000, 8, 'products/IPHONE 14 PROMAX.png', 'Apple iPhone 14 Pro Max adalah smartphone flagship dari Apple yang dirilis dengan peningkatan besar di sektor kamera, performa, dan layar.\n\nDitenagai oleh chip A16 Bionic, iPhone ini menawarkan performa sangat cepat dan efisien, cocok untuk multitasking, gaming berat, hingga editing video profesional.\n\n✨ Fitur utama:\n📸 Kamera Pro 48MP dengan hasil foto lebih detail dan tajam\n🌙 Mode malam lebih optimal untuk low light\n📺 Layar Super Retina XDR 6.7 inci dengan ProMotion 120Hz\n⚡ Chip A16 Bionic (super kencang & hemat daya)\n🔋 Baterai tahan lama untuk penggunaan seharian\n🔒 Face ID & Dynamic Island (fitur interaktif notifikasi Apple)\n💡 Cocok untuk:\nKonten kreator 📷\nGaming 🎮\nFotografi & videografi 🎥\nPengguna yang butuh HP premium', '6 GB', '256 GB', '4500 mAH', '2026-05-21 20:04:30', '2026-05-21 20:04:30'),
(4, 1, 'IPHONE 16', 14000000, 10, 'products/IPHONE 16.png', 'Apple iPhone 16 adalah smartphone flagship terbaru dari Apple yang hadir dengan desain premium, performa super cepat, dan teknologi kamera generasi terbaru. Dibekali chipset terbaru Apple yang lebih efisien dan bertenaga, iPhone 16 mampu memberikan pengalaman multitasking, gaming, hingga editing video dengan sangat lancar.\n\nLayar Super Retina XDR yang cerah dan tajam membuat tampilan visual terlihat lebih hidup, baik saat menonton film, bermain game, maupun scrolling media sosial. Desainnya tetap elegan dengan material berkualitas tinggi yang nyaman digenggam dan memberikan kesan mewah.\n\nPada sektor kamera, iPhone 16 menawarkan peningkatan kualitas foto dan video dengan hasil lebih detail, warna natural, serta performa low-light yang semakin baik. Fitur AI terbaru juga membantu menghasilkan foto profesional hanya dengan sekali jepret.\n\nDaya tahan baterai lebih optimal sehingga dapat digunakan seharian penuh untuk aktivitas produktivitas maupun hiburan. Didukung sistem operasi iOS terbaru, iPhone 16 memberikan keamanan tinggi, performa stabil, dan ekosistem Apple yang terintegrasi dengan sangat baik.\n\nCocok untuk pengguna yang menginginkan smartphone premium dengan performa tinggi, kamera berkualitas profesional, desain modern, dan pengalaman penggunaan yang eksklusif.', '8 GB', '256 GB', '3561 mAh', '2026-05-21 20:04:30', '2026-05-21 20:04:30'),
(5, 3, 'xiaomi 14 ultra', 20000000, 12, 'products/xiaomi 14 ultra.png', 'Xiaomi 14 Ultra adalah salah satu HP flagship terbaik dari Xiaomi\n yang fokus pada fotografi profesional dan performa ekstrem. Smartphone ini dirancang untuk pengguna yang suka fotografi, videografi, gaming berat, hingga multitasking kelas tinggi.\n\n✨ Desain & Layar\n\nXiaomi 14 Ultra memakai desain premium dengan finishing elegan dan modul kamera besar khas Leica. Layarnya menggunakan panel AMOLED LTPO 6,73 inci resolusi WQHD+ dengan refresh rate 1–120Hz adaptif, sehingga animasi terasa sangat smooth sekaligus hemat baterai. Tingkat kecerahannya mencapai 3000 nits, jadi tetap jelas saat dipakai di bawah sinar matahari.\n\n⚡ Performa\n\nHP ini ditenagai chipset Snapdragon 8 Gen 3 fabrikasi 4nm yang termasuk chipset Android tercepat saat ini. Dipadukan RAM LPDDR5X dan storage UFS 4.0, performanya sangat kencang untuk:\n\nGaming ultra setting\nEditing video 4K/8K\nMultitasking berat\nAI processing dan rendering cepat\n\nHyperOS juga terasa lebih ringan dan responsif dibanding MIUI generasi lama.\n\n📸 Kamera Leica Profesional\n\nBagian paling menarik dari Xiaomi 14 Ultra adalah kameranya. Smartphone ini memakai sistem quad camera Leica 50MP:\n\nKamera utama 1 inci Sony LYT-900\nTelephoto 75mm\nPeriscope 120mm\nUltrawide 122°\n\nKualitas fotonya sangat detail dengan warna khas Leica yang terlihat lebih natural dan profesional. Bukaan variabel f/1.63–f/4.0 membuat hasil foto malam lebih bagus dan fleksibel seperti kamera DSLR. Banyak reviewer dan pengguna menyebut kamera Xiaomi 14 Ultra sebagai salah satu kamera HP terbaik saat ini.', '12 GB', '512 GB', '5300mAh', '2026-05-21 20:04:30', '2026-05-21 20:04:30'),
(6, 3, 'redmi note 14', 3199000, 10, 'products/redmi note 14.png', 'HP mid-range gaming dengan performa kencang dan layar AMOLED 120Hz.', '8 GB', '256', '5110 mAh', '2026-05-21 20:04:30', '2026-05-21 20:04:30'),
(7, 6, 'Vivo Y21d', 3399000, 7, 'products/Vivo Y21d.png', 'Smartphone baterai jumbo untuk pemakaian harian yang tahan lama.', '8 GB', '256', '6500 mAh', '2026-05-21 20:04:30', '2026-05-21 20:04:30'),
(8, 5, 'OPPO Reno 12F 5G', 4789000, 6, 'products/OPPO Reno 12F 5G.png', 'HP OPPO stylish dengan layar AMOLED 120Hz, kamera AI 50MP, dan storage besar cocok untuk gaming maupun content creator.', '12 GB', '512 GB', '5000 mAH', '2026-05-21 20:04:30', '2026-05-21 20:04:30'),
(9, 5, 'OPPO A5 Pro', 3499000, 8, 'products/OPPO A5 Pro.png', 'OPPO A5 Pro cocok untuk pengguna yang mencari HP murah tetapi tetap stylish dan awet dipakai sehari-hari. Sangat cocok untuk pelajar, pekerja, maupun penggunaan sosial media.', '8 GB', '256 GB', '5800 mAH', '2026-05-21 20:04:30', '2026-05-21 20:04:30'),
(10, 5, 'OPPO Find X8', 15998999, 8, 'products/OPPO Find X8.png', 'OPPO Find X8 adalah flagship premium dengan performa kelas atas untuk gaming berat, fotografi profesional, editing video, dan multitasking ekstrem. Desainnya elegan dengan build quality premium.', '16 GB', '512 GB', '5630 mAH', '2026-05-21 20:04:30', '2026-05-21 20:04:30'),
(11, 8, 'Infinix GT 20 Pro', 3555000, 9, 'products/Infinix GT 20 Pro.png', 'Infinix GT 20 Pro dibuat khusus untuk gamer yang ingin performa tinggi dengan harga lebih terjangkau dibanding flagship gaming phone lainnya. Desain RGB Mecha Loop di bagian belakang membuat tampilannya sangat futuristik dan cocok untuk gaming setup.', '128 GB', '256 GB', '5000 mAH', '2026-05-21 20:04:30', '2026-05-21 20:04:30'),
(12, 8, 'Infinix Note 40 Pro', 2587000, 10, 'products/Infinix Note 40 Pro.png', 'Infinix Note 40 Pro cocok untuk pengguna yang ingin desain premium dengan curved AMOLED display dan pengalaman multimedia yang nyaman. HP ini sangat cocok untuk sosial media, fotografi, dan penggunaan sehari-hari.', '8 GB', '256 GB', '5000 mAH', '2026-05-21 20:04:30', '2026-05-21 20:04:30'),
(13, 8, 'Infinix Hot 50 Pro Plus', 3000000, 9, 'products/Infinix Hot 50 Pro Plus.png', 'Infinix Hot 50 Pro Plus cocok untuk pengguna yang ingin HP murah tetapi tetap modern dan powerful. Desain tipis, layar AMOLED, dan refresh rate tinggi membuat HP ini sangat worth it di kelas harga 2 jutaan.', '8 GB', '256 GB', '5000 mAH', '2026-05-21 20:04:30', '2026-05-21 20:04:30'),
(14, 4, 'Lenovo Legion Y90', 12400000, 5, 'products/Lenovo Legion Y90.png', 'Lenovo Legion Y90 merupakan gaming phone premium yang dibuat khusus untuk gamer hardcore. HP ini memiliki desain futuristik dengan RGB lighting, dual cooling fan, dan trigger ultrasonic seperti console gaming. Sangat cocok untuk PUBG Mobile, Genshin Impact, CODM, hingga emulator berat.', '12 GB', '256 GB', '5600 mAH', '2026-05-21 20:04:30', '2026-05-21 20:04:30'),
(15, 4, 'Lenovo Legion Phone Pro', 10850000, 7, 'products/Lenovo Legion Phone Pro.png', 'Lenovo Legion Phone Pro hadir dengan desain unik horizontal gaming mode dan kamera pop-up samping untuk streamer maupun content creator gaming. HP ini terkenal karena performanya yang stabil dan sistem pendinginan yang agresif.', '16 GB', '512 GB', NULL, '2026-05-21 20:04:30', '2026-05-21 20:04:30'),
(16, 4, 'ThinkPhone 25 by motorola Lenovo', 10720000, 5, 'products/ThinkPhone 25 by motorola Lenovo.png', 'ThinkPhone by Motorola adalah HP premium enterprise dari Lenovo yang dibuat untuk profesional dan pebisnis. Desainnya terinspirasi dari laptop Lenovo ThinkPad dengan material aramid fiber yang kuat dan elegan.', '8 GB', '256 GB', '5000 mAH', '2026-05-21 20:04:30', '2026-05-21 20:04:30'),
(17, 7, 'Realme GT 7', 9399000, 3, 'products/Realme GT 7.png', 'Realme GT 7 adalah HP flagship terbaru Realme yang fokus pada performa gaming dan daya tahan baterai. Cocok untuk gamer, content creator, dan pengguna berat yang membutuhkan performa tinggi sepanjang hari. Desain IceSense Graphene membuat suhu HP tetap dingin saat bermain game berat.', '12 GB', '256 GB', '5000 mAH', '2026-05-21 20:04:30', '2026-05-21 20:04:30'),
(18, 7, 'Realme 13+ 5G', 3500000, 8, 'products/Realme 13 5G.png', 'Realme 13+ 5G cocok untuk pengguna yang mencari HP gaming murah tetapi tetap powerful. Performa Dimensity 7300 sangat stabil untuk PUBG Mobile, Mobile Legends, CODM, hingga multitasking harian.', '12 GB', '256 GB', '5000 mAH', '2026-05-21 20:04:30', '2026-05-21 20:04:30'),
(19, 7, 'Realme C75', 2400000, 6, 'products/Realme C75.png', 'Realme C75 cocok untuk pengguna yang ingin HP murah dengan fitur lengkap. Memiliki desain kokoh, baterai tahan lama, dan fitur NFC yang jarang ditemukan di kelas harga 2 jutaan.', '8 GB', '256 GB', '6000 mAH', '2026-05-21 20:04:30', '2026-05-21 20:04:30'),
(20, 9, 'Samsung 45W Super Fast Charger', 40000, 92, 'products/Samsung 45W Super Fast Charger.png', 'Adaptor charger USB-C dengan teknologi Super Fast Charging 2.0. Cocok untuk Samsung Galaxy, Xiaomi, Oppo, Vivo, hingga iPhone USB-C terbaru. Mendukung pengisian cepat stabil dan memiliki proteksi overheat serta overcharge.', NULL, NULL, NULL, '2026-05-21 20:04:30', '2026-05-21 20:04:30'),
(21, 2, 'Samsung Galaxy S24', 12999000, 8, 'products/Samsung Galaxy S24.jpg', 'Samsung Galaxy S24 hadir dengan layar Dynamic AMOLED 2X, kamera AI unggulan, dan performa smooth untuk gaming serta multitasking.', '8 GB', '256 GB', '3900 mAh', '2026-05-21 20:04:30', '2026-05-21 20:04:30'),
(22, 8, 'Infinix 30', 2899000, 10, 'products/Infinix 30.jpg', 'Infinix 30 menawarkan desain modern, baterai tahan lama, dan performa baik untuk penggunaan sosial media serta multimedia sehari-hari.', '8 GB', '256 GB', '5000 mAh', '2026-05-21 20:04:30', '2026-05-21 20:04:30'),
(23, 1, 'iPhone 15', 20999000, 6, 'products/iPhone 15.jpg', 'iPhone 15 hadir dengan desain elegan, kamera ganda canggih, dan performa Apple terbaru untuk pengalaman multimedia serta produktivitas yang lancar.', '8 GB', '128 GB', '3279 mAh', '2026-05-21 20:04:30', '2026-05-21 20:04:30'),
(24, 5, 'OPPO Reno 12', 6499000, 7, 'products/OPPO Reno 12.jpg', 'OPPO Reno 12 menawarkan kombinasi kamera AI, layar AMOLED, dan charging cepat untuk pengguna yang ingin smartphone stylish dan serba bisa.', '8 GB', '256 GB', '5000 mAh', '2026-05-21 20:04:30', '2026-05-21 20:04:30'),
(25, 6, 'Vivo V30', 3799000, 8, 'products/Vivo V30.jpg', 'Vivo V30 hadir dengan layar AMOLED besar, desain tipis, dan kamera selfie yang kuat untuk konten kreator serta penggunaan harian.', '8 GB', '128 GB', '4500 mAh', '2026-05-21 20:04:30', '2026-05-21 20:04:30'),
(26, 14, 'Soundcore R60i NC by Anker', 398000, 20, 'products/Soundcore R60i NC by Anker.jpg', 'Soundcore R60i NC by Anker menawarkan kualitas suara yang luar biasa dengan teknologi noise cancellation, cocok untuk penggunaan sehari-hari dan perjalanan.', NULL, NULL, NULL, '2026-05-21 20:04:30', '2026-05-21 20:04:30'),
(27, 11, 'TWS Baseus Encok WM01', 187290, 15, 'products/TWS Baseus Encok WM01.jpg', 'TWS Baseus Encok WM01 menawarkan kualitas suara yang luar biasa dengan teknologi noise cancellation, cocok untuk penggunaan sehari-hari dan perjalanan.', NULL, NULL, NULL, '2026-05-21 20:04:30', '2026-05-21 20:04:30'),
(28, 11, 'Baseus Kabel Type-C ke Type-C Tungsten Gold 240W', 165226, 15, 'products/Baseus Kabel Type-C ke Type-C Tungsten Gold 240W.jpg', 'Baseus Kabel Type-C ke Type-C Tungsten Gold 240W menawarkan kualitas dan daya tahan yang superior, cocok untuk penggunaan sehari-hari dan perjalanan.', NULL, NULL, NULL, '2026-05-21 20:04:30', '2026-05-21 20:04:30'),
(29, 15, 'MIXIO-T9/T10 Wireless Microphone Lavalier', 213220, 15, 'products/MIXIO-T9_T10 Wireless Microphone Lavalier.jpg', 'MIXIO-T9/T10 Wireless Microphone Lavalier menawarkan kualitas suara yang luar biasa dengan teknologi wireless, cocok untuk penggunaan sehari-hari dan perjalanan.', NULL, NULL, NULL, '2026-05-21 20:04:30', '2026-05-21 20:04:30');

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
('UnPZ60IbSwayJOSpcABnZs7QKIQFfFO0aUhXRXGY', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:150.0) Gecko/20100101 Firefox/150.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoidWdlenpPRkVpRm02QU9WcVhSQWRMQnd2Mmw5cWNLdHVCUlF4NEMxSCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sb2dpbiI7czo1OiJyb3V0ZSI7czo1OiJsb2dpbiI7fX0=', 1779419167);

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
(1, 'Admin', 'admin', 'admin@example.com', NULL, '$2y$12$5j7xEN3uy42d8t9hkPdnJ.t8KtuojTh85x5dd12k6m2QLhvvBgINu', NULL, NULL, NULL, NULL, 'admin', NULL, '2026-05-21 20:04:30', '2026-05-21 20:04:30'),
(2, 'Ardian', 'ardian', 'ardian@example.com', NULL, '$2y$12$lGPEVB28j0EtNmyVwkAJuePV4hzSaSMib3TLJ0PaZnk8xACuu/Wiq', NULL, '081234567890', NULL, NULL, 'user', NULL, '2026-05-21 20:04:30', '2026-05-21 20:04:30');

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
