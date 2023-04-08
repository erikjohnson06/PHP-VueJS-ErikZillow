-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 06, 2023 at 09:15 AM
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
  `posted_by` bigint(20) UNSIGNED NOT NULL,
  `sold_at` timestamp NULL DEFAULT NULL,
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

INSERT INTO `listings` (`id`, `beds`, `baths`, `area`, `address`, `city`, `zip`, `state`, `price`, `posted_by`, `sold_at`, `comments`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 3, 7, 4445, '88 Kertzmann Plains', 'Ondrickaberg', '68604-1290', 'SC', 492109.00, 1, NULL, '', '2023-04-05 13:09:50', '2023-04-05 13:09:50', NULL),
(2, 1, 6, 2449, '64 Jason Springs', 'South Connerside', '70732-2253', 'TN', 228642.00, 1, NULL, '', '2023-04-05 13:09:50', '2023-04-05 13:09:50', NULL),
(3, 5, 1, 2297, '165 Marlene Lane', 'Herzogtown', '44921', 'SC', 706531.00, 1, NULL, '', '2023-04-05 13:09:50', '2023-04-05 13:09:50', NULL),
(4, 6, 5, 2353, '145 Sanford Rapid', 'Simonisburgh', '21273', 'GA', 540676.00, 1, NULL, '', '2023-04-05 13:09:50', '2023-04-05 13:09:50', NULL),
(5, 4, 2, 4798, '79 Bartell Rue', 'Port Devynmouth', '94418', 'GA', 739618.00, 1, NULL, '', '2023-04-05 13:09:50', '2023-04-05 13:09:50', NULL),
(6, 5, 3, 2793, '121 Christa Alley', 'Lake Lorenzoland', '46348', 'NC', 270981.00, 1, NULL, '', '2023-04-05 13:09:50', '2023-04-05 13:09:50', NULL),
(7, 5, 3, 3524, '113 Nikko Walks', 'Catharineshire', '47251', 'TN', 769760.00, 1, NULL, '', '2023-04-05 13:09:50', '2023-04-05 13:09:50', NULL),
(8, 6, 1, 4221, '91 Russel View', 'Oceaneshire', '82451-2437', 'TN', 955444.00, 1, NULL, '', '2023-04-05 13:09:50', '2023-04-05 13:09:50', NULL),
(9, 7, 7, 4739, '184 Fanny Fort', 'South Dina', '44005-0257', 'GA', 312814.00, 1, NULL, '', '2023-04-05 13:09:50', '2023-04-05 13:09:50', NULL),
(10, 3, 2, 4875, '75 Bartell Coves', 'South Luciano', '31523', 'TN', 194446.00, 1, NULL, '', '2023-04-05 13:09:50', '2023-04-05 13:09:50', NULL),
(11, 3, 6, 3674, '197 Bayer Alley', 'West Aisha', '05470', 'TN', 177725.00, 2, NULL, '', '2023-04-05 13:09:50', '2023-04-05 13:09:50', NULL),
(12, 5, 1, 2616, '124 Nicholaus Estates', 'Hermanhaven', '13783-4608', 'KY', 574550.00, 2, NULL, '', '2023-04-05 13:09:50', '2023-04-05 13:09:50', NULL),
(13, 6, 6, 3819, '99 Erling Station', 'North Jalen', '90831', 'KY', 155912.00, 2, NULL, '', '2023-04-05 13:09:50', '2023-04-05 13:09:50', NULL),
(14, 2, 4, 3019, '107 Emmerich Brook', 'Lake Tre', '83807-0635', 'NC', 289156.00, 2, NULL, '', '2023-04-05 13:09:50', '2023-04-05 13:09:50', NULL),
(15, 7, 4, 2182, '169 Olen Loaf', 'Wuckertborough', '15403', 'GA', 449151.00, 2, NULL, '', '2023-04-05 13:09:50', '2023-04-05 13:09:50', NULL),
(16, 2, 1, 2357, '14 General Knoll', 'Rutherfordberg', '32070', 'GA', 691969.00, 2, NULL, '', '2023-04-05 13:09:50', '2023-04-05 13:09:50', NULL),
(17, 1, 6, 2334, '86 Pfeffer Glen', 'North Sibylmouth', '79058', 'SC', 774768.00, 2, NULL, '', '2023-04-05 13:09:50', '2023-04-05 13:09:50', NULL),
(18, 5, 3, 3700, '106 Emmerich Forest', 'Nonaburgh', '49056-5443', 'TN', 363638.00, 2, NULL, '', '2023-04-05 13:09:50', '2023-04-05 13:09:50', NULL),
(19, 6, 3, 2064, '180 Juanita Station', 'Garnettview', '74259-6517', 'GA', 493191.00, 2, NULL, '', '2023-04-05 13:09:50', '2023-04-05 13:09:50', NULL),
(20, 7, 7, 2789, '183 Hessel Union', 'North Kaelynchester', '26773', 'SC', 919222.00, 2, NULL, '', '2023-04-05 13:09:50', '2023-04-05 13:09:50', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `listing_images`
--

DROP TABLE IF EXISTS `listing_images`;
CREATE TABLE IF NOT EXISTS `listing_images` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `filename` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `listing_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `listing_images_listing_id_foreign` (`listing_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Truncate table before insert `listing_images`
--

TRUNCATE TABLE `listing_images`;
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
) ENGINE=MyISAM AUTO_INCREMENT=111 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Truncate table before insert `migrations`
--

TRUNCATE TABLE `migrations`;
--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(110, '2023_03_31_174644_create_notifications_table', 1),
(100, '2014_10_12_000000_create_users_table', 1),
(101, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(102, '2019_08_19_000000_create_failed_jobs_table', 1),
(103, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(104, '2023_03_11_111356_create_listings_table', 1),
(105, '2023_03_18_102901_add_is_admin_column_to_users_table', 1),
(106, '2023_03_21_090650_add_soft_deletes_to_listings_table', 1),
(107, '2023_03_25_130347_create_listing_images_table', 1),
(108, '2023_03_27_092245_create_offers_table', 1),
(109, '2023_03_31_094829_add_sold_at_column_to_listings_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

DROP TABLE IF EXISTS `notifications`;
CREATE TABLE IF NOT EXISTS `notifications` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_id` bigint(20) UNSIGNED NOT NULL,
  `data` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Truncate table before insert `notifications`
--

TRUNCATE TABLE `notifications`;
-- --------------------------------------------------------

--
-- Table structure for table `offers`
--

DROP TABLE IF EXISTS `offers`;
CREATE TABLE IF NOT EXISTS `offers` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `listing_id` bigint(20) UNSIGNED NOT NULL,
  `bidder_id` bigint(20) UNSIGNED NOT NULL,
  `amount` int(10) UNSIGNED NOT NULL,
  `accepted_at` timestamp NULL DEFAULT NULL,
  `rejected_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `offers_listing_id_foreign` (`listing_id`),
  KEY `offers_bidder_id_foreign` (`bidder_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Truncate table before insert `offers`
--

TRUNCATE TABLE `offers`;
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
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Truncate table before insert `users`
--

TRUNCATE TABLE `users`;
--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `is_admin`) VALUES
(1, 'Test User', 'test@example.com', '2023-04-05 13:09:50', '$2y$10$tsfMYNJKiCAAZSW6lK7SR.QnQp9uuS5oVbiQwqBeKKB9WGnDWzA96', 'a3ptgH5k1g', '2023-04-05 13:09:50', '2023-04-05 13:09:50', 1),
(2, 'Test User 2', 'test2@example.com', '2023-04-05 13:09:50', '$2y$10$tsfMYNJKiCAAZSW6lK7SR.QnQp9uuS5oVbiQwqBeKKB9WGnDWzA96', 'efGXsGenkj', '2023-04-05 13:09:50', '2023-04-05 13:09:50', 0)
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
