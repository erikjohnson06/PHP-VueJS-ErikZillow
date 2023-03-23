-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 23, 2023 at 10:06 AM
-- Server version: 5.7.36
-- PHP Version: 8.1.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `erikzillow`
--
CREATE DATABASE IF NOT EXISTS `erikzillow` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `erikzillow`;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Truncate table before insert `failed_jobs`
--

TRUNCATE TABLE `failed_jobs`;
-- --------------------------------------------------------

--
-- Table structure for table `listings`
--

DROP TABLE IF EXISTS `listings`;
CREATE TABLE IF NOT EXISTS `listings` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `beds` tinyint(3) UNSIGNED NOT NULL,
  `baths` tinyint(3) UNSIGNED NOT NULL,
  `area` smallint(5) UNSIGNED NOT NULL,
  `address` tinytext COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` tinytext COLLATE utf8mb4_unicode_ci NOT NULL,
  `zip` tinytext COLLATE utf8mb4_unicode_ci NOT NULL,
  `state` tinytext COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` double(10,2) UNSIGNED NOT NULL,
  `status_id` tinyint(4) NOT NULL DEFAULT '1',
  `posted_by` bigint(20) UNSIGNED NOT NULL,
  `comments` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `listings_posted_by_foreign` (`posted_by`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Truncate table before insert `listings`
--

TRUNCATE TABLE `listings`;
--
-- Dumping data for table `listings`
--

INSERT INTO `listings` (`id`, `beds`, `baths`, `area`, `address`, `city`, `zip`, `state`, `price`, `status_id`, `posted_by`, `comments`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 7, 5, 4743, '75 Pollich Mews', 'Judyton', '61071-8971', 'KY', 1491342.00, 1, 1, '', '2023-03-18 14:31:49', '2023-03-21 13:14:05', NULL),
(2, 1, 7, 2835, '116 Bechtelar Path', 'North Kyra', '63109', 'NC', 330502.00, 1, 1, '', '2023-03-18 14:31:49', '2023-03-21 13:11:02', '2023-03-21 13:11:02'),
(3, 3, 4, 2627, '116 Marcelo Groves', 'South Madieburgh', '86437', 'KY', 267999.00, 1, 1, '', '2023-03-18 14:31:49', '2023-03-18 14:31:49', NULL),
(4, 7, 7, 4819, '78 Walsh Burg', 'Floydville', '57409-0099', 'NC', 298037.00, 1, 1, '', '2023-03-18 14:31:49', '2023-03-18 14:31:49', NULL),
(5, 5, 3, 3278, '138 Golden Inlet', 'Schuppeborough', '58303', 'KY', 259326.00, 1, 1, '', '2023-03-18 14:31:49', '2023-03-18 14:31:49', NULL),
(6, 3, 4, 2906, '29 Maxine Greens', 'West Lukas', '64848-8541', 'GA', 964705.00, 1, 1, '', '2023-03-18 14:31:49', '2023-03-18 14:31:49', NULL),
(7, 2, 5, 3465, '115 Georgianna Street', 'Lake Gabefort', '74533', 'SC', 1199250.00, 1, 1, '', '2023-03-18 14:31:49', '2023-03-18 14:31:49', NULL),
(8, 7, 5, 3901, '76 Orn Skyway', 'West Annettaberg', '30238-2213', 'SC', 1390798.00, 1, 1, '', '2023-03-18 14:31:49', '2023-03-18 14:31:49', NULL),
(9, 5, 3, 3838, '104 Bart Land', 'Elainamouth', '59119-7964', 'GA', 968081.00, 1, 1, '', '2023-03-18 14:31:49', '2023-03-18 14:31:49', NULL),
(10, 5, 6, 4929, '181 Amelie Flats', 'Yosthaven', '33825-0112', 'SC', 91851.00, 1, 1, '', '2023-03-18 14:31:49', '2023-03-18 14:31:49', NULL),
(11, 4, 2, 2033, '187 Kutch Lodge', 'East Martineborough', '68923-3249', 'TN', 888830.00, 1, 2, '', '2023-03-18 14:31:49', '2023-03-21 13:27:26', '2023-03-21 13:27:26'),
(12, 4, 6, 2730, '39 Elmore Tunnel', 'West Jerrellborough', '17387-1410', 'NC', 946172.00, 1, 2, '', '2023-03-18 14:31:49', '2023-03-21 13:25:53', '2023-03-21 13:25:53'),
(13, 5, 3, 4358, '89 Eric Coves', 'Nickmouth', '29699-6297', 'SC', 740792.00, 1, 2, '', '2023-03-18 14:31:49', '2023-03-21 13:27:30', '2023-03-21 13:27:30'),
(14, 6, 2, 2095, '196 Streich Passage', 'New Norene', '77181-6574', 'GA', 1395033.00, 1, 2, '', '2023-03-18 14:31:49', '2023-03-18 14:31:49', NULL),
(15, 4, 7, 3189, '31 Madisen Lodge', 'Daynachester', '76872', 'KY', 1226306.00, 1, 2, '', '2023-03-18 14:31:49', '2023-03-18 14:31:49', NULL),
(16, 1, 4, 4180, '173 Kiera Views', 'Hauckland', '63521', 'NC', 697448.00, 1, 2, '', '2023-03-18 14:31:49', '2023-03-18 14:31:49', NULL),
(17, 7, 1, 4368, '91 Funk Forks', 'Boyerview', '29232-6161', 'NC', 732385.00, 1, 2, '', '2023-03-18 14:31:49', '2023-03-21 13:29:12', '2023-03-21 13:29:12'),
(18, 5, 7, 3276, '184 Rempel Points', 'East Theronbury', '68831-7014', 'GA', 1611549.00, 1, 2, '', '2023-03-18 14:31:49', '2023-03-18 14:31:49', NULL),
(19, 2, 6, 2451, '102 Jeff Views', 'North Javierberg', '43684-7764', 'NC', 1168670.00, 1, 2, '', '2023-03-18 14:31:49', '2023-03-18 14:31:49', NULL),
(20, 1, 3, 4491, '148 Triston Grove', 'Lake Susana', '53742', 'GA', 1750575.00, 1, 2, '', '2023-03-18 14:31:49', '2023-03-18 14:31:49', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=76 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Truncate table before insert `migrations`
--

TRUNCATE TABLE `migrations`;
--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(75, '2023_03_21_090650_add_soft_deletes_to_listings_table', 2),
(74, '2023_03_18_102901_add_is_admin_column_to_users_table', 1),
(69, '2014_10_12_000000_create_users_table', 1),
(70, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(71, '2019_08_19_000000_create_failed_jobs_table', 1),
(72, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(73, '2023_03_11_111356_create_listings_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Truncate table before insert `password_reset_tokens`
--

TRUNCATE TABLE `password_reset_tokens`;
-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Truncate table before insert `personal_access_tokens`
--

TRUNCATE TABLE `personal_access_tokens`;
-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Truncate table before insert `users`
--

TRUNCATE TABLE `users`;
--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `is_admin`) VALUES
(1, 'Test User', 'test@example.com', '2023-03-18 14:31:48', '$2y$10$i.b9Xk.M1XMJrGqMXXW19egbz7QWv9TyWadDPZA56fCP.k1I7m3.m', 'eITDeL3zWa', '2023-03-18 14:31:48', '2023-03-18 14:31:48', 1),
(2, 'Test User 2', 'test2@example.com', '2023-03-18 14:31:48', '$2y$10$cR49PUcUwVTXCtiTI6Zh8enQruOhznqlhpxUgczXhdrKGHZ2qeFti', 'K2WRR5z8ec', '2023-03-18 14:31:49', '2023-03-18 14:31:49', 0);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
