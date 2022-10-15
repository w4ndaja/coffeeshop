-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 15, 2022 at 08:56 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `caffeshop`
--

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `menu_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL,
  `notes` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

CREATE TABLE `menus` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `menu_category_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rating` double NOT NULL DEFAULT 5,
  `price` int(11) NOT NULL,
  `stock` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`id`, `menu_category_id`, `name`, `rating`, `price`, `stock`, `created_at`, `updated_at`) VALUES
(1, 1, 'Tubruk', 5, 10000, 99999999, '2022-10-14 20:57:58', '2022-10-14 20:57:58'),
(2, 1, 'V60', 5, 14000, 99999, '2022-10-14 20:58:09', '2022-10-14 20:58:09'),
(3, 1, 'Japanese ice kopi', 5, 16000, 9999, '2022-10-14 20:58:32', '2022-10-14 20:58:32'),
(4, 1, 'Vietnam drip', 5, 12000, 9999, '2022-10-14 20:58:51', '2022-10-14 20:58:51'),
(5, 1, 'Espresso', 5, 12000, 9999, '2022-10-14 20:59:04', '2022-10-14 20:59:04'),
(6, 1, 'Americano', 5, 13000, 9999, '2022-10-14 20:59:18', '2022-10-14 20:59:18'),
(7, 1, 'Mood presso', 5, 14000, 9999, '2022-10-14 20:59:29', '2022-10-14 20:59:29'),
(8, 1, 'Sarabic', 5, 13000, 9999, '2022-10-14 20:59:42', '2022-10-14 20:59:42'),
(9, 1, 'Cappucino', 5, 15000, 9999, '2022-10-14 20:59:56', '2022-10-14 20:59:56'),
(10, 1, 'Moccanico', 5, 16000, 9999, '2022-10-14 21:00:08', '2022-10-14 21:00:08'),
(11, 1, 'Caffe Latte', 5, 17000, 9999, '2022-10-14 21:00:18', '2022-10-14 21:00:18'),
(12, 1, 'Vannila Latte', 5, 17000, 9999, '2022-10-14 21:00:31', '2022-10-14 21:00:31'),
(13, 1, 'Caramel Latte', 5, 18000, 9999, '2022-10-14 21:00:43', '2022-10-14 21:00:43'),
(14, 1, 'Kosuka', 5, 15000, 9999, '2022-10-14 21:00:54', '2022-10-14 21:00:54'),
(15, 1, 'Kopikiran', 5, 15000, 9999, '2022-10-14 21:01:06', '2022-10-14 21:01:06'),
(16, 2, 'Milk', 5, 10000, 9999, '2022-10-14 21:01:19', '2022-10-14 21:01:19'),
(17, 2, 'Cloud Vanilla', 5, 15000, 9999, '2022-10-14 21:03:41', '2022-10-14 21:03:41'),
(18, 2, 'Pinky smoothies', 5, 17000, 9999, '2022-10-14 21:03:56', '2022-10-14 21:03:56'),
(19, 2, 'Summer mango', 5, 17000, 9999, '2022-10-14 21:04:06', '2022-10-14 21:04:06'),
(20, 3, 'Chocolate', 5, 15000, 9999, '2022-10-14 21:04:20', '2022-10-14 21:04:20'),
(21, 3, 'Taro', 5, 15000, 9999, '2022-10-14 21:04:28', '2022-10-14 21:04:28'),
(22, 3, 'Red velvet', 5, 15000, 9999, '2022-10-14 21:04:36', '2022-10-14 21:04:36'),
(23, 3, 'matcha', 5, 18000, 9999, '2022-10-14 21:04:46', '2022-10-14 21:04:46'),
(24, 4, 'Green tea', 5, 10000, 9999, '2022-10-14 21:05:02', '2022-10-14 21:05:02'),
(25, 4, 'Lemon tea', 5, 10000, 9999, '2022-10-14 21:05:12', '2022-10-14 21:05:12'),
(26, 4, 'Strawberry tea', 5, 14000, 9999, '2022-10-14 21:05:22', '2022-10-14 21:05:22'),
(27, 4, 'Special tea', 5, 14000, 9999, '2022-10-14 21:05:28', '2022-10-14 21:05:28'),
(28, 5, 'Flattered', 5, 15000, 9999, '2022-10-14 21:05:36', '2022-10-14 21:05:36'),
(29, 5, 'Sun memories', 5, 15000, 9999, '2022-10-14 21:05:45', '2022-10-14 21:05:45');

-- --------------------------------------------------------

--
-- Table structure for table `menu_categories`
--

CREATE TABLE `menu_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `menu_categories`
--

INSERT INTO `menu_categories` (`id`, `name`, `active`, `created_at`, `updated_at`) VALUES
(1, 'COFFEE', 1, '2022-10-14 20:55:58', '2022-10-14 20:55:58'),
(2, 'MILK', 1, '2022-10-14 20:56:07', '2022-10-14 20:56:07'),
(3, 'COLOR CLOUD', 1, '2022-10-14 20:56:16', '2022-10-14 20:56:16'),
(4, 'TEA', 1, '2022-10-14 20:56:22', '2022-10-14 20:56:22'),
(5, 'MOCKTAIl', 1, '2022-10-14 20:56:31', '2022-10-14 20:57:09');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2022_08_24_160828_create_menu_categories_table', 1),
(5, '2022_08_24_172235_create_menus_table', 1),
(6, '2022_08_27_070521_create_carts_table', 1),
(7, '2022_08_27_071407_create_orders_table', 1),
(9, '2022_09_20_114105_create_settings_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `queue_no` int(11) NOT NULL,
  `paid_at` timestamp NULL DEFAULT NULL,
  `canceled_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `key`, `value`, `created_at`, `updated_at`) VALUES
(1, 'qrcode', 'https://b283-111-94-88-127.ngrok.io/showcase', '2022-09-20 05:26:08', '2022-10-14 20:48:19');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` enum('Admin','Kasir','User') COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `phone`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@coffeshop.com', '2022-08-27 01:30:18', '$2y$10$1p177CGIYwlYtFOQssMfxuWKF/ycmsK4yeiM18gLr7Qz3B.wnFFvS', '00000000', 'Admin', NULL, NULL, NULL),
(2, 'Christian Rios', 'lejus@mailinator.com', NULL, '$2y$10$w0MLHtlPewrc/xiMl67UnelP8TVdADPVxiKefkG9CXrWSHRLm0b5.', NULL, 'User', NULL, '2022-09-19 05:02:29', '2022-09-19 05:02:29'),
(3, 'Conan Richards', 'xujokafen@mailinator.com', NULL, 'Pa$$w0rd!', NULL, 'User', NULL, '2022-10-14 20:18:51', '2022-10-14 20:18:51'),
(4, 'Bradley Rodriguez', 'geryregufu@mailinator.com', NULL, 'Pa$$w0rd!', NULL, 'User', NULL, '2022-10-14 23:52:54', '2022-10-14 23:52:54');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `carts_menu_id_foreign` (`menu_id`),
  ADD KEY `carts_user_id_foreign` (`user_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`),
  ADD KEY `menus_menu_category_id_foreign` (`menu_category_id`);

--
-- Indexes for table `menu_categories`
--
ALTER TABLE `menu_categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `menu_categories_name_unique` (`name`);

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
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `menus`
--
ALTER TABLE `menus`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `menu_categories`
--
ALTER TABLE `menu_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `carts_menu_id_foreign` FOREIGN KEY (`menu_id`) REFERENCES `menus` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `carts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `menus`
--
ALTER TABLE `menus`
  ADD CONSTRAINT `menus_menu_category_id_foreign` FOREIGN KEY (`menu_category_id`) REFERENCES `menu_categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
