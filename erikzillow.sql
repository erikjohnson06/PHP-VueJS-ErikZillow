-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 01, 2023 at 10:36 AM
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

INSERT INTO `listings` (`id`, `beds`, `baths`, `area`, `address`, `city`, `zip`, `state`, `price`, `status_id`, `posted_by`, `sold_at`, `comments`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 3, 1, 4449, '29 Gutmann Circle', 'Lake Dorris', '39263-3477', 'KY', 1459574.00, 1, 2, '2023-03-31 13:57:11', '', '2023-03-31 13:52:21', '2023-03-31 13:57:11', NULL),
(2, 7, 6, 4471, '156 Cronin Underpass', 'South Alexanne', '76025-7638', 'GA', 1376303.00, 1, 2, NULL, '', '2023-03-31 13:52:21', '2023-03-31 13:52:21', NULL),
(3, 2, 7, 4182, '174 Okuneva Green', 'Vanessafurt', '94781', 'NC', 1992483.00, 1, 2, NULL, '', '2023-03-31 13:52:21', '2023-03-31 13:52:21', NULL),
(4, 2, 3, 4724, '39 Angelica Wall', 'New Emiliaton', '38782', 'GA', 1603784.00, 1, 2, NULL, '', '2023-03-31 13:52:21', '2023-03-31 13:52:21', NULL),
(5, 1, 3, 2520, '119 Evangeline Meadows', 'New Maynard', '61462-7063', 'SC', 1822488.00, 1, 2, NULL, '', '2023-03-31 13:52:21', '2023-03-31 13:52:21', NULL),
(6, 1, 2, 2934, '99 Medhurst Flats', 'East Jessyca', '55478', 'SC', 847594.00, 1, 2, NULL, '', '2023-03-31 13:52:21', '2023-03-31 13:52:21', NULL),
(7, 2, 1, 4526, '56 Hudson Bridge', 'Herzogland', '20686-6940', 'NC', 622105.00, 1, 2, NULL, '', '2023-03-31 13:52:21', '2023-03-31 13:52:21', NULL),
(8, 4, 1, 2853, '22 O\'Connell Expressway', 'East Eloisa', '73506-0355', 'TN', 1873778.00, 1, 2, NULL, '', '2023-03-31 13:52:21', '2023-03-31 13:52:21', NULL),
(9, 5, 2, 4933, '96 Selmer Extensions', 'Rodgerchester', '39255', 'GA', 416972.00, 1, 2, NULL, '', '2023-03-31 13:52:21', '2023-03-31 13:52:21', NULL),
(10, 5, 5, 3307, '16 Tyler Hills', 'Granttown', '98814-0454', 'SC', 1948066.00, 1, 2, NULL, '', '2023-03-31 13:52:21', '2023-03-31 13:52:21', NULL),
(11, 5, 3, 4769, '102 Jensen Green', 'Randalhaven', '39109-2748', 'SC', 788825.00, 1, 2, NULL, '', '2023-03-31 13:52:21', '2023-03-31 13:52:21', NULL),
(12, 1, 7, 2814, '116 Hintz Loaf', 'Bofurt', '48097-6851', 'NC', 1780622.00, 1, 2, NULL, '', '2023-03-31 13:52:21', '2023-03-31 13:52:21', NULL),
(13, 1, 6, 4354, '43 Bradtke Stream', 'Kaelynburgh', '56921', 'NC', 1746761.00, 1, 2, NULL, '', '2023-03-31 13:52:21', '2023-03-31 13:52:21', NULL),
(14, 3, 1, 2915, '126 Elna Rapids', 'Port Leora', '36338-8036', 'KY', 1884431.00, 1, 2, NULL, '', '2023-03-31 13:52:21', '2023-03-31 13:52:21', NULL),
(15, 4, 2, 3539, '17 Vergie Flats', 'South Janickburgh', '26325', 'NC', 62310.00, 1, 2, NULL, '', '2023-03-31 13:52:21', '2023-03-31 13:52:21', NULL),
(16, 6, 6, 4304, '67 Runolfsson Row', 'Lake Lambertton', '02824', 'TN', 141351.00, 1, 2, NULL, '', '2023-03-31 13:52:21', '2023-03-31 13:52:21', NULL),
(17, 2, 3, 3089, '143 Miller Forge', 'Marleychester', '16866-2856', 'TN', 482918.00, 1, 2, NULL, '', '2023-03-31 13:52:21', '2023-03-31 13:52:21', NULL),
(18, 7, 3, 3822, '160 Vernice Views', 'Ritchiemouth', '92094', 'TN', 1508280.00, 1, 2, NULL, '', '2023-03-31 13:52:21', '2023-03-31 13:52:21', NULL),
(19, 1, 6, 4829, '182 Buddy Motorway', 'South Abbigailstad', '44171', 'TN', 977803.00, 1, 2, NULL, '', '2023-03-31 13:52:21', '2023-03-31 13:52:21', NULL),
(20, 6, 7, 3376, '115 O\'Conner Trace', 'Cliffordstad', '08962', 'TN', 999802.00, 1, 2, NULL, '', '2023-03-31 13:52:21', '2023-03-31 13:52:21', NULL);

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
) ENGINE=MyISAM AUTO_INCREMENT=89 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Truncate table before insert `migrations`
--

TRUNCATE TABLE `migrations`;
--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(85, '2023_03_25_130347_create_listing_images_table', 1),
(78, '2014_10_12_000000_create_users_table', 1),
(79, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(80, '2019_08_19_000000_create_failed_jobs_table', 1),
(81, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(82, '2023_03_11_111356_create_listings_table', 1),
(83, '2023_03_18_102901_add_is_admin_column_to_users_table', 1),
(84, '2023_03_21_090650_add_soft_deletes_to_listings_table', 1),
(86, '2023_03_27_092245_create_offers_table', 1),
(87, '2023_03_31_094829_add_sold_at_column_to_listings_table', 1),
(88, '2023_03_31_174644_create_notifications_table', 2);

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
--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `type`, `notifiable_type`, `notifiable_id`, `data`, `read_at`, `created_at`, `updated_at`) VALUES
('454c0214-6ed1-4473-9ff7-3bf475db66e8', 'App\\Notifications\\OfferMade', 'App\\Models\\User', 1, '{\"offer_id\":2,\"listing_id\":5,\"amount\":1855244,\"bidder_id\":1}', '2023-04-01 14:32:47', '2023-03-31 22:05:36', '2023-04-01 14:32:47');

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
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Truncate table before insert `offers`
--

TRUNCATE TABLE `offers`;
--
-- Dumping data for table `offers`
--

INSERT INTO `offers` (`id`, `listing_id`, `bidder_id`, `amount`, `accepted_at`, `rejected_at`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1512787, '2023-03-31 13:57:11', NULL, '2023-03-31 13:55:04', '2023-03-31 13:57:11'),
(2, 5, 1, 1855244, NULL, NULL, '2023-03-31 22:05:35', '2023-03-31 22:05:35');

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
(1, 'Test User', 'test@example.com', '2023-03-31 13:52:21', '$2y$10$.c4ltl1BBi5gWJlx.t3wn.rKs/y9Aj/TZV016QbSnDnDUtBW2551i', 'FaJwVa1J9YfKjfcRr2SOlxe2d8bCNJmv8cayFgLY9T1ZdiKEifxzvHLnaIue', '2023-03-31 13:52:21', '2023-03-31 13:52:21', 1),
(2, 'Test User 2', 'test2@example.com', '2023-03-31 13:52:21', '$2y$10$s99wA1RnNT.T5q.ZPSqiR.2dHrB7RojWP.dsx/yVnUAL71gPD6w7i', 'xwRe9pMv13', '2023-03-31 13:52:21', '2023-03-31 13:52:21', 0);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
