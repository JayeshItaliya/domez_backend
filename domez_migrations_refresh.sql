-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Oct 05, 2023 at 02:07 PM
-- Server version: 8.0.31
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `domez_migrations_refresh`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

DROP TABLE IF EXISTS `bookings`;
CREATE TABLE IF NOT EXISTS `bookings` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `type` tinyint NOT NULL DEFAULT '1' COMMENT '1=Dome Bookings, 2=League Bookings',
  `vendor_id` bigint UNSIGNED NOT NULL,
  `provider_id` bigint UNSIGNED DEFAULT NULL,
  `dome_id` bigint UNSIGNED DEFAULT NULL,
  `league_id` bigint UNSIGNED DEFAULT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `sport_id` bigint UNSIGNED NOT NULL,
  `field_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `booking_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slots` text COLLATE utf8mb4_unicode_ci COMMENT 'For Domes Booking Only',
  `start_date` date DEFAULT NULL COMMENT 'For Leagues Booking Only',
  `end_date` date DEFAULT NULL COMMENT 'For Leagues Booking Only',
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `booking_mode` tinyint(1) NOT NULL DEFAULT '1' COMMENT '	1=Automatic, 2=Mannual',
  `age_discount_amount` double NOT NULL DEFAULT '0' COMMENT 'Total amount of Age Discount Amount',
  `fields_discount_amount` double NOT NULL DEFAULT '0' COMMENT 'Total amount of Fields Discount Amount',
  `sub_total` double NOT NULL DEFAULT '0',
  `service_fee` double NOT NULL DEFAULT '0',
  `hst` double NOT NULL DEFAULT '0',
  `total_amount` double NOT NULL,
  `paid_amount` double NOT NULL DEFAULT '0',
  `due_amount` double NOT NULL DEFAULT '0',
  `min_split_amount` double NOT NULL DEFAULT '0' COMMENT 'Minimum Split Payment amount',
  `refunded_amount` double NOT NULL DEFAULT '0',
  `payment_mode` int NOT NULL DEFAULT '1' COMMENT '1=Online, 2=Offline',
  `payment_type` int NOT NULL DEFAULT '0' COMMENT '0=WhenBookingIsRequested(BookingModeManual),1=Full Amount, 2=Split Amount',
  `payment_status` int NOT NULL DEFAULT '1' COMMENT '0=WhenBookingIsRequested(BookingModeManual),1=Complete, 2=Partial',
  `booking_status` int NOT NULL DEFAULT '1' COMMENT '1=Confirmed,\r\n2=Pending,\r\n3=Cancelled,\r\n4=WaitingApproval\r\n,\r\n',
  `booking_accepted_at` datetime DEFAULT NULL,
  `token` text COLLATE utf8mb4_unicode_ci,
  `players` int NOT NULL,
  `customer_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customer_email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_mobile` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `team_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'For Leagues Booking Only',
  `cancelled_by` tinyint DEFAULT NULL COMMENT '1=ByAuto, 2=ByDomeOwner, 3=ByCustomer',
  `cancellation_reason` text COLLATE utf8mb4_unicode_ci,
  `is_payment_released` tinyint NOT NULL DEFAULT '2' COMMENT '1=Yes, 2=No',
  `is_review_noti_send` tinyint NOT NULL DEFAULT '2',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `bookings_vendor_id_foreign` (`vendor_id`),
  KEY `bookings_provider_id_foreign` (`provider_id`),
  KEY `bookings_dome_id_foreign` (`dome_id`),
  KEY `bookings_league_id_foreign` (`league_id`),
  KEY `bookings_user_id_foreign` (`user_id`),
  KEY `bookings_sport_id_foreign` (`sport_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `type`, `vendor_id`, `provider_id`, `dome_id`, `league_id`, `user_id`, `sport_id`, `field_id`, `booking_id`, `slots`, `start_date`, `end_date`, `start_time`, `end_time`, `booking_mode`, `age_discount_amount`, `fields_discount_amount`, `sub_total`, `service_fee`, `hst`, `total_amount`, `paid_amount`, `due_amount`, `min_split_amount`, `refunded_amount`, `payment_mode`, `payment_type`, `payment_status`, `booking_status`, `booking_accepted_at`, `token`, `players`, `customer_name`, `customer_email`, `customer_mobile`, `team_name`, `cancelled_by`, `cancellation_reason`, `is_payment_released`, `is_review_noti_send`, `created_at`, `updated_at`) VALUES
(1, 1, 2, NULL, 1, NULL, 6, 1, '2', 'fae5f886', '09:00 AM - 10:00 AM', '2023-10-27', NULL, '09:00:00', '10:00:00', 2, 2.5, 0, 50, 2.5, 2.5, 52.5, 10, 12, 3, 0, 1, 1, 2, 2, NULL, '2y10g0Xw4kZKAfYGQqyyuzOPhXZcJWnannHPk2SiMgFkIN9leCfKWG', 12, 'Soham Shah', 'sohamtest404@gmail.com', '', '', 3, NULL, 2, 2, '2023-10-05 22:51:42', '2023-10-05 23:32:05'),
(2, 1, 2, NULL, 1, NULL, 6, 1, '2', '883f9b81', '09:00 AM - 10:00 AM', '2023-10-26', NULL, '09:00:00', '10:00:00', 2, 2.5, 0, 50, 2.5, 2.5, 52.5, 52.5, 52.5, 0, 0, 1, 0, 2, 3, NULL, '2y105Pb3kiqInFtobcSAcr6DiOTmZFbqQQiOOF4ToJwZp136fOgri4Iy', 12, 'Soham Shah', 'sohamtest404@gmail.com', '', '', 3, NULL, 2, 2, '2023-10-05 23:05:52', '2023-10-05 23:26:38');

-- --------------------------------------------------------

--
-- Table structure for table `cms`
--

DROP TABLE IF EXISTS `cms`;
CREATE TABLE IF NOT EXISTS `cms` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `type` int NOT NULL COMMENT '1=Privacy Policy, 2=Terms & Conditions, 3=Refund Policy, 4=Cancellation Policies',
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `domes`
--

DROP TABLE IF EXISTS `domes`;
CREATE TABLE IF NOT EXISTS `domes` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `vendor_id` bigint UNSIGNED NOT NULL,
  `sport_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` double(8,2) DEFAULT NULL,
  `hst` double(8,2) NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `pin_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slot_duration` tinyint NOT NULL DEFAULT '1' COMMENT '1=60 Minutes, 2=90 Minutes',
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `lat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lng` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `benefits` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `benefits_description` longtext COLLATE utf8mb4_unicode_ci,
  `multiple_fields_selection` int NOT NULL DEFAULT '0' COMMENT 'For Multiple Fields Selection Discount',
  `fields_discount` double NOT NULL DEFAULT '0',
  `fields_discount_type` tinyint NOT NULL DEFAULT '1' COMMENT '1=Percentage, 2=Fixed',
  `booking_mode` tinyint NOT NULL DEFAULT '1' COMMENT '1=Automatic, 2=Mannual',
  `policies_rules` longtext COLLATE utf8mb4_unicode_ci,
  `is_deleted` tinyint NOT NULL DEFAULT '2' COMMENT '1=Yes,2=No',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `domes_vendor_id_foreign` (`vendor_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `domes`
--

INSERT INTO `domes` (`id`, `vendor_id`, `sport_id`, `name`, `price`, `hst`, `address`, `pin_code`, `city`, `state`, `country`, `slot_duration`, `description`, `lat`, `lng`, `benefits`, `benefits_description`, `multiple_fields_selection`, `fields_discount`, `fields_discount_type`, `booking_mode`, `policies_rules`, `is_deleted`, `created_at`, `updated_at`) VALUES
(1, 2, '1,2', 'Lorem is Dome', 0.00, 5.00, 'Varachha, Surat, Gujarat, India', '395007', 'Surat', 'Gujarat', 'India', 1, 'Lorem is Ipsum. Lorem is Ipsum. Lorem is Ipsum. Lorem is Ipsum. Lorem is Ipsum. Lorem is Ipsum. Lorem is Ipsum. Lorem is Ipsum.', '21.2021189', '72.8672703', 'Free Wifi', 'Lorem is Ipsum. Lorem is Ipsum. Lorem is Ipsum. Lorem is Ipsum. Lorem is Ipsum. Lorem is Ipsum.', 2, 80, 1, 2, 'Lorem is Ipsum. Lorem is Ipsum. Lorem is Ipsum. Lorem is Ipsum. Lorem is Ipsum. Lorem is Ipsum. Lorem is Ipsum. Lorem is Ipsum. Lorem is Ipsum. Lorem is Ipsum. Lorem is Ipsum. Lorem is Ipsum. Lorem is Ipsum. Lorem is Ipsum. Lorem is Ipsum. Lorem is Ipsum. Lorem is Ipsum. Lorem is Ipsum.', 2, '2023-10-02 20:12:03', '2023-10-05 15:34:50'),
(2, 2, '1,2', 'Lorem is Ipsum dome', 0.00, 5.00, 'Varachha, Surat, Gujarat, India', '395007', 'Surat', 'Gujarat', 'India', 1, 'LOrem is Ipsum. LOrem is Ipsum. LOrem is Ipsum. LOrem is Ipsum. LOrem is Ipsum.', '21.2021189', '72.8672703', 'Free Wifi', 'LOrem is Ipsum. LOrem is Ipsum. LOrem is Ipsum. LOrem is Ipsum.', 0, 0, 1, 2, 'LOrem is Ipsum. LOrem is Ipsum. LOrem is Ipsum. LOrem is Ipsum. LOrem is Ipsum.', 2, '2023-10-04 20:22:09', '2023-10-04 20:22:09');

-- --------------------------------------------------------

--
-- Table structure for table `dome_discounts`
--

DROP TABLE IF EXISTS `dome_discounts`;
CREATE TABLE IF NOT EXISTS `dome_discounts` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `dome_id` bigint UNSIGNED NOT NULL,
  `from_age` int NOT NULL DEFAULT '0',
  `to_age` int NOT NULL DEFAULT '0',
  `age_discounts` double NOT NULL DEFAULT '0',
  `discount_type` double NOT NULL DEFAULT '1' COMMENT '1=In Percentage, 2=Fixed',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `dome_discounts_dome_id_foreign` (`dome_id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `dome_discounts`
--

INSERT INTO `dome_discounts` (`id`, `dome_id`, `from_age`, `to_age`, `age_discounts`, `discount_type`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 5, 5, 1, '2023-10-02 12:38:11', '2023-10-02 22:50:57'),
(2, 1, 6, 10, 6, 2, '2023-10-02 12:38:11', '2023-10-02 22:50:57'),
(3, 1, 11, 15, 20, 2, '2023-10-02 12:38:11', '2023-10-02 22:50:57'),
(5, 2, 2, 10, 5, 1, '2023-10-04 20:22:09', '2023-10-04 20:22:09'),
(6, 3, 18, 13, 50, 2, '2023-10-04 20:24:41', '2023-10-04 20:24:41');

-- --------------------------------------------------------

--
-- Table structure for table `dome_images`
--

DROP TABLE IF EXISTS `dome_images`;
CREATE TABLE IF NOT EXISTS `dome_images` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `dome_id` bigint UNSIGNED DEFAULT NULL,
  `league_id` bigint UNSIGNED DEFAULT NULL,
  `images` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `dome_images_dome_id_foreign` (`dome_id`),
  KEY `dome_images_league_id_foreign` (`league_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `dome_images`
--

INSERT INTO `dome_images` (`id`, `dome_id`, `league_id`, `images`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, 'dome-651a9e7bdb19c.png', '2023-10-02 20:12:03', '2023-10-02 20:12:03'),
(2, 2, NULL, 'dome-651d43d937e4d.jpg', '2023-10-04 20:22:09', '2023-10-04 20:22:09'),
(3, 3, NULL, 'dome-651d44712f556.png', '2023-10-04 20:24:41', '2023-10-04 20:24:41');

-- --------------------------------------------------------

--
-- Table structure for table `enquiries`
--

DROP TABLE IF EXISTS `enquiries`;
CREATE TABLE IF NOT EXISTS `enquiries` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `vendor_id` bigint UNSIGNED DEFAULT NULL,
  `type` tinyint NOT NULL DEFAULT '1' COMMENT '1=HelpCenter[Mobile App], 2=HelpCenter[Web], 3=DomesRequest[Web], 4=DomesRequest[Mobile App], 5=Supports[DomeOwner-AdminPanel]',
  `dome_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dome_zipcode` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dome_city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dome_state` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dome_country` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `venue_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `venue_address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subject` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `message` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_replied` tinyint NOT NULL DEFAULT '2' COMMENT '1=Yes, 2=No',
  `is_exist` tinyint NOT NULL DEFAULT '2' COMMENT 'Dome Owner (1=Yes, 2=No )',
  `is_accepted` tinyint NOT NULL DEFAULT '2' COMMENT '1=Yes, 2=Pending, 3=No',
  `is_deleted` tinyint NOT NULL DEFAULT '2' COMMENT '1=Yes, 2=No',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `enquiries_vendor_id_foreign` (`vendor_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `favourites`
--

DROP TABLE IF EXISTS `favourites`;
CREATE TABLE IF NOT EXISTS `favourites` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint UNSIGNED NOT NULL,
  `dome_id` bigint UNSIGNED DEFAULT NULL,
  `league_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `favourites_user_id_foreign` (`user_id`),
  KEY `favourites_dome_id_foreign` (`dome_id`),
  KEY `favourites_league_id_foreign` (`league_id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `fields`
--

DROP TABLE IF EXISTS `fields`;
CREATE TABLE IF NOT EXISTS `fields` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `vendor_id` bigint UNSIGNED NOT NULL,
  `dome_id` bigint UNSIGNED NOT NULL,
  `sport_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `area` double(8,2) NOT NULL DEFAULT '0.00',
  `min_person` int NOT NULL,
  `max_person` int NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `maintenance_date` date DEFAULT NULL,
  `in_maintenance` tinyint NOT NULL DEFAULT '2' COMMENT '1=Yes, 2=No',
  `is_available` tinyint NOT NULL DEFAULT '1' COMMENT '1=Yes, 2=No',
  `is_deleted` tinyint NOT NULL DEFAULT '2' COMMENT '1=Yes, 2=No',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `fields_vendor_id_foreign` (`vendor_id`),
  KEY `fields_dome_id_foreign` (`dome_id`),
  KEY `fields_sport_id_foreign` (`sport_id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `fields`
--

INSERT INTO `fields` (`id`, `vendor_id`, `dome_id`, `sport_id`, `name`, `area`, `min_person`, `max_person`, `image`, `maintenance_date`, `in_maintenance`, `is_available`, `is_deleted`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 2, 'FF', 1500.00, 3, 76, 'field-651aa63d78352.png', NULL, 2, 1, 2, '2023-10-02 20:45:09', '2023-10-02 20:45:09'),
(2, 2, 1, 1, 'FF', 10000.00, 9, 85, 'field-651aa65964897.jpg', NULL, 2, 1, 2, '2023-10-02 20:45:37', '2023-10-02 20:45:37'),
(3, 2, 1, 2, 'SF', 1500.00, 3, 76, 'field-651aa63d78352.png', NULL, 2, 1, 2, '2023-10-02 20:45:09', '2023-10-02 20:45:09'),
(4, 2, 1, 1, 'SF', 10000.00, 9, 85, 'field-651aa65964897.jpg', NULL, 2, 1, 2, '2023-10-02 20:45:37', '2023-10-02 20:45:37'),
(5, 2, 1, 2, 'TF', 1500.00, 3, 76, 'field-651aa63d78352.png', NULL, 2, 1, 2, '2023-10-02 20:45:09', '2023-10-02 20:45:09'),
(6, 2, 1, 1, 'TF', 10000.00, 9, 85, 'field-651aa65964897.jpg', NULL, 2, 1, 2, '2023-10-02 20:45:37', '2023-10-02 20:45:37'),
(7, 2, 1, 2, '4F', 1500.00, 3, 76, 'field-651aa63d78352.png', NULL, 2, 1, 2, '2023-10-02 20:45:09', '2023-10-02 20:45:09'),
(8, 2, 1, 1, '4F', 10000.00, 9, 85, 'field-651aa65964897.jpg', NULL, 2, 1, 2, '2023-10-02 20:45:37', '2023-10-02 20:45:37'),
(9, 2, 2, 1, 'fff', 1200.00, 1, 74, 'field-651d457b040ed.png', NULL, 2, 1, 2, '2023-10-04 20:29:07', '2023-10-04 20:29:07'),
(10, 2, 3, 2, '1234567890', 20.00, 1, 100, 'field-651d458452e8a.jpg', NULL, 2, 1, 2, '2023-10-04 20:29:16', '2023-10-04 20:33:04'),
(11, 2, 2, 2, 'ddd', 1000.00, 3, 77, 'field-651d45b1f3413.png', NULL, 2, 1, 2, '2023-10-04 20:30:02', '2023-10-04 20:30:02'),
(12, 2, 3, 1, 'ccc', 500.00, 17, 92, 'field-651d45d066962.jpg', NULL, 2, 1, 2, '2023-10-04 20:30:32', '2023-10-04 20:30:32');

-- --------------------------------------------------------

--
-- Table structure for table `leagues`
--

DROP TABLE IF EXISTS `leagues`;
CREATE TABLE IF NOT EXISTS `leagues` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `vendor_id` bigint UNSIGNED NOT NULL,
  `provider_id` bigint UNSIGNED DEFAULT NULL,
  `dome_id` bigint UNSIGNED NOT NULL,
  `field_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sport_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `booking_deadline` date DEFAULT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `start_time` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `end_time` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `days` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `from_age` int NOT NULL,
  `to_age` int NOT NULL,
  `gender` tinyint NOT NULL DEFAULT '1' COMMENT '1=Men, 2=Women, 3=Other',
  `min_player` int NOT NULL,
  `max_player` int NOT NULL,
  `team_limit` int NOT NULL,
  `price` int NOT NULL,
  `is_deleted` tinyint NOT NULL DEFAULT '2' COMMENT '1=Yes,2=No',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `leagues_vendor_id_foreign` (`vendor_id`),
  KEY `leagues_provider_id_foreign` (`provider_id`),
  KEY `leagues_dome_id_foreign` (`dome_id`),
  KEY `leagues_sport_id_foreign` (`sport_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2023_02_06_091247_create_domes_table', 1),
(6, '2023_02_06_100506_create_bookings_table', 1),
(7, '2023_02_06_101920_create_sports_table', 1),
(8, '2023_02_06_102808_create_c_m_s_table', 1),
(9, '2023_02_06_104026_create_dome_images_table', 1),
(10, '2023_02_06_105050_create_favourites_table', 1),
(11, '2023_02_06_105312_create_fields_table', 1),
(12, '2023_02_06_110210_create_payment_gateways_table', 1),
(13, '2023_02_06_110542_create_reviews_table', 1),
(14, '2023_02_06_110902_create_transactions_table', 1),
(15, '2023_02_17_092343_create_leagues_table', 1),
(16, '2023_02_19_062821_create_enquiries_table', 1),
(17, '2023_03_07_113029_create_set_prices_table', 1),
(18, '2023_03_07_113832_create_set_prices_days_slots_table', 1),
(19, '2023_05_02_170442_create_working_hours_table', 1),
(20, '2023_09_29_141021_create_dome_discounts_table', 1),
(21, '2099_09_14_113127_add_foreign_keys', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`(250))
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payment_gateways`
--

DROP TABLE IF EXISTS `payment_gateways`;
CREATE TABLE IF NOT EXISTS `payment_gateways` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `type` int NOT NULL COMMENT '1=Stripe',
  `vendor_id` bigint UNSIGNED NOT NULL,
  `account_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `public_key` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `secret_key` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `payment_gateways_vendor_id_foreign` (`vendor_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payment_gateways`
--

INSERT INTO `payment_gateways` (`id`, `type`, `vendor_id`, `account_id`, `public_key`, `secret_key`, `created_at`, `updated_at`) VALUES
(1, 1, 1, NULL, 'pk_test_51LlAvQFysF0okTxJcqvqe5FuA6eGnvPGx09mjkD9XamI1ZY3JDyRZyfI0yMohFkUmYfrYaQVkTqqqXwLtcu5DL4q00sg52wJEO', 'sk_test_51LlAvQFysF0okTxJjCODF1rt79hZpNypYCfAAUaSgy9EGXbg5dL3h9a93rxNCgXMpBJEFETvdWO1y5xyClOxn6D200JgDzWUe5', '2023-10-02 20:35:38', '2023-10-02 22:54:31');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

DROP TABLE IF EXISTS `reviews`;
CREATE TABLE IF NOT EXISTS `reviews` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `vendor_id` bigint UNSIGNED NOT NULL,
  `dome_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `rating` int NOT NULL,
  `comment` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reply_message` text COLLATE utf8mb4_unicode_ci,
  `replied_at` date DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `reviews_dome_id_foreign` (`dome_id`),
  KEY `reviews_vendor_id_foreign` (`vendor_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `set_prices`
--

DROP TABLE IF EXISTS `set_prices`;
CREATE TABLE IF NOT EXISTS `set_prices` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `vendor_id` int NOT NULL,
  `dome_id` int NOT NULL,
  `sport_id` int NOT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `price_type` int NOT NULL DEFAULT '1' COMMENT '1=default,2=daywise',
  `price` double(8,2) NOT NULL DEFAULT '0.00',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `set_prices_vendor_id_foreign` (`vendor_id`),
  KEY `set_prices_dome_id_foreign` (`dome_id`),
  KEY `set_prices_sport_id_foreign` (`sport_id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `set_prices`
--

INSERT INTO `set_prices` (`id`, `vendor_id`, `dome_id`, `sport_id`, `start_date`, `end_date`, `price_type`, `price`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 1, NULL, NULL, 1, 50.00, '2023-10-02 20:12:03', '2023-10-02 20:12:03'),
(2, 2, 1, 2, NULL, NULL, 1, 60.00, '2023-10-02 20:12:03', '2023-10-02 20:12:03'),
(3, 2, 1, 2, '2023-10-02', '2023-10-27', 2, 60.00, '2023-10-02 20:12:03', '2023-10-02 20:12:03'),
(4, 2, 2, 1, NULL, NULL, 1, 50.00, '2023-10-04 20:22:09', '2023-10-04 20:22:09'),
(5, 2, 2, 2, NULL, NULL, 1, 60.00, '2023-10-04 20:22:09', '2023-10-04 20:22:09'),
(6, 2, 3, 1, NULL, NULL, 1, 50.00, '2023-10-04 20:24:41', '2023-10-04 20:24:41'),
(7, 2, 3, 2, NULL, NULL, 1, 50.00, '2023-10-04 20:24:41', '2023-10-04 20:24:41');

-- --------------------------------------------------------

--
-- Table structure for table `set_prices_days_slots`
--

DROP TABLE IF EXISTS `set_prices_days_slots`;
CREATE TABLE IF NOT EXISTS `set_prices_days_slots` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `set_prices_id` bigint UNSIGNED NOT NULL,
  `dome_id` bigint UNSIGNED DEFAULT NULL,
  `sport_id` bigint UNSIGNED DEFAULT NULL,
  `date` date DEFAULT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `day` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` double(15,2) NOT NULL,
  `status` int NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `set_prices_days_slots_set_prices_id_foreign` (`set_prices_id`),
  KEY `set_prices_days_slots_dome_id_foreign` (`dome_id`),
  KEY `set_prices_days_slots_sport_id_foreign` (`sport_id`)
) ENGINE=MyISAM AUTO_INCREMENT=135 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `set_prices_days_slots`
--

INSERT INTO `set_prices_days_slots` (`id`, `set_prices_id`, `dome_id`, `sport_id`, `date`, `start_time`, `end_time`, `day`, `price`, `status`, `created_at`, `updated_at`) VALUES
(1, 3, 1, 1, '2023-11-03', '09:00:00', '10:00:00', 'monday', 50.00, 1, '2023-11-03 10:03:40', '2023-10-02 20:46:32'),
(2, 3, 1, 1, '2023-11-03', '10:00:00', '11:00:00', 'monday', 50.00, 1, '2023-11-03 10:03:40', '2023-10-02 20:46:32'),
(3, 3, 1, 1, '2023-11-03', '11:00:00', '12:00:00', 'monday', 50.00, 1, '2023-11-03 10:03:40', '2023-10-02 20:46:32'),
(4, 3, 1, 1, '2023-11-03', '12:00:00', '13:00:00', 'monday', 50.00, 1, '2023-11-03 10:03:40', '2023-10-02 20:46:32'),
(5, 3, 1, 1, '2023-11-03', '13:00:00', '14:00:00', 'monday', 50.00, 1, '2023-11-03 10:03:40', '2023-10-02 20:46:32'),
(6, 3, 1, 1, '2023-11-03', '14:00:00', '15:00:00', 'monday', 50.00, 1, '2023-11-03 10:03:40', '2023-10-02 20:46:32'),
(7, 3, 1, 1, '2023-10-11', '09:00:00', '10:00:00', 'wednesday', 50.00, 1, '2023-11-03 10:03:40', '2023-10-02 20:46:35'),
(8, 3, 1, 1, '2023-10-11', '10:00:00', '11:00:00', 'wednesday', 50.00, 1, '2023-11-03 10:03:40', '2023-10-02 20:46:35'),
(9, 3, 1, 1, '2023-10-11', '11:00:00', '12:00:00', 'wednesday', 50.00, 1, '2023-11-03 10:03:40', '2023-10-02 20:46:35'),
(10, 3, 1, 1, '2023-10-11', '12:00:00', '13:00:00', 'wednesday', 50.00, 1, '2023-11-03 10:03:40', '2023-10-02 20:46:35'),
(11, 3, 1, 1, '2023-10-11', '13:00:00', '14:00:00', 'wednesday', 50.00, 1, '2023-11-03 10:03:40', '2023-10-02 20:46:35'),
(12, 3, 1, 1, '2023-10-11', '14:00:00', '15:00:00', 'wednesday', 50.00, 1, '2023-11-03 10:03:40', '2023-10-02 20:46:35'),
(13, 3, 1, 1, '2023-11-03', '09:00:00', '10:00:00', 'tuesday', 50.00, 1, '2023-11-03 10:03:40', '2023-10-02 21:05:50'),
(14, 3, 1, 1, '2023-11-03', '10:00:00', '11:00:00', 'tuesday', 50.00, 1, '2023-11-03 10:03:40', '2023-10-02 21:05:50'),
(15, 3, 1, 1, '2023-11-03', '11:00:00', '12:00:00', 'tuesday', 50.00, 1, '2023-11-03 10:03:40', '2023-10-02 21:05:50'),
(16, 3, 1, 1, '2023-11-03', '12:00:00', '13:00:00', 'tuesday', 50.00, 1, '2023-11-03 10:03:40', '2023-10-02 21:05:50'),
(17, 3, 1, 1, '2023-11-03', '13:00:00', '14:00:00', 'tuesday', 50.00, 1, '2023-11-03 10:03:40', '2023-10-02 21:05:50'),
(18, 3, 1, 1, '2023-11-03', '14:00:00', '15:00:00', 'tuesday', 50.00, 1, '2023-11-03 10:03:40', '2023-10-02 21:05:50'),
(19, 3, 1, 1, '2023-11-03', '09:00:00', '10:00:00', 'wednesday', 50.00, 1, '2023-11-03 10:03:40', '2023-10-02 21:18:37'),
(20, 3, 1, 1, '2023-11-03', '10:00:00', '11:00:00', 'wednesday', 50.00, 1, '2023-11-03 10:03:40', '2023-10-02 21:18:37'),
(21, 3, 1, 1, '2023-11-03', '11:00:00', '12:00:00', 'wednesday', 50.00, 1, '2023-11-03 10:03:40', '2023-10-02 21:18:37'),
(22, 3, 1, 1, '2023-11-03', '12:00:00', '13:00:00', 'wednesday', 50.00, 1, '2023-11-03 10:03:40', '2023-10-02 21:18:37'),
(23, 3, 1, 1, '2023-11-03', '13:00:00', '14:00:00', 'wednesday', 50.00, 1, '2023-11-03 10:03:40', '2023-10-02 21:18:37'),
(24, 3, 1, 1, '2023-11-03', '14:00:00', '15:00:00', 'wednesday', 50.00, 1, '2023-11-03 10:03:40', '2023-10-02 21:18:37'),
(25, 3, 1, 2, '2023-11-03', '09:00:00', '10:00:00', 'monday', 60.00, 1, '2023-11-03 10:03:40', '2023-10-02 21:43:38'),
(26, 3, 1, 2, '2023-11-03', '10:00:00', '11:00:00', 'monday', 60.00, 1, '2023-11-03 10:03:40', '2023-10-02 21:43:38'),
(27, 3, 1, 2, '2023-11-03', '11:00:00', '12:00:00', 'monday', 60.00, 1, '2023-11-03 10:03:40', '2023-10-02 21:43:38'),
(28, 3, 1, 2, '2023-11-03', '12:00:00', '13:00:00', 'monday', 60.00, 1, '2023-11-03 10:03:40', '2023-10-02 21:43:38'),
(29, 3, 1, 2, '2023-11-03', '13:00:00', '14:00:00', 'monday', 60.00, 1, '2023-11-03 10:03:40', '2023-10-02 21:43:38'),
(30, 3, 1, 2, '2023-11-03', '14:00:00', '15:00:00', 'monday', 60.00, 1, '2023-11-03 10:03:40', '2023-10-02 21:43:38'),
(31, 3, 1, 2, '2023-10-19', '09:00:00', '10:00:00', 'thursday', 60.00, 1, '2023-11-03 10:03:40', '2023-10-05 19:54:16'),
(32, 3, 1, 2, '2023-10-19', '10:00:00', '11:00:00', 'thursday', 60.00, 1, '2023-11-03 10:03:40', '2023-10-05 19:04:22'),
(33, 3, 1, 2, '2023-10-19', '11:00:00', '12:00:00', 'thursday', 60.00, 1, '2023-11-03 10:03:40', '2023-10-05 14:45:29'),
(34, 3, 1, 2, '2023-10-19', '12:00:00', '13:00:00', 'thursday', 60.00, 1, '2023-11-03 10:03:40', '2023-10-05 14:45:29'),
(35, 3, 1, 2, '2023-10-19', '13:00:00', '14:00:00', 'thursday', 60.00, 1, '2023-11-03 10:03:40', '2023-10-05 14:45:29'),
(36, 3, 1, 2, '2023-10-19', '14:00:00', '15:00:00', 'thursday', 60.00, 1, '2023-11-03 10:03:40', '2023-10-05 15:26:20'),
(37, 3, 1, 1, '2023-10-12', '09:00:00', '10:00:00', 'thursday', 50.00, 1, '2023-11-03 10:03:40', '2023-10-02 21:47:56'),
(38, 3, 1, 1, '2023-10-12', '10:00:00', '11:00:00', 'thursday', 50.00, 1, '2023-11-03 10:03:40', '2023-10-02 21:47:56'),
(39, 3, 1, 1, '2023-10-12', '11:00:00', '12:00:00', 'thursday', 50.00, 1, '2023-11-03 10:03:40', '2023-10-02 21:47:56'),
(40, 3, 1, 1, '2023-10-12', '12:00:00', '13:00:00', 'thursday', 50.00, 1, '2023-11-03 10:03:40', '2023-10-02 21:47:56'),
(41, 3, 1, 1, '2023-10-12', '13:00:00', '14:00:00', 'thursday', 50.00, 1, '2023-11-03 10:03:40', '2023-10-02 21:47:56'),
(42, 3, 1, 1, '2023-10-12', '14:00:00', '15:00:00', 'thursday', 50.00, 1, '2023-11-03 10:03:40', '2023-10-02 21:47:56'),
(43, 3, 1, 1, '2023-10-19', '09:00:00', '10:00:00', 'thursday', 50.00, 1, '2023-11-03 10:03:40', '2023-10-02 22:14:27'),
(44, 3, 1, 1, '2023-10-19', '10:00:00', '11:00:00', 'thursday', 50.00, 1, '2023-11-03 10:03:40', '2023-10-02 22:14:27'),
(45, 3, 1, 1, '2023-10-19', '11:00:00', '12:00:00', 'thursday', 50.00, 1, '2023-11-03 10:03:40', '2023-10-02 22:14:27'),
(46, 3, 1, 1, '2023-10-19', '12:00:00', '13:00:00', 'thursday', 50.00, 1, '2023-11-03 10:03:40', '2023-10-02 22:14:27'),
(47, 3, 1, 1, '2023-10-19', '13:00:00', '14:00:00', 'thursday', 50.00, 1, '2023-11-03 10:03:40', '2023-10-02 22:14:27'),
(48, 3, 1, 1, '2023-10-19', '14:00:00', '15:00:00', 'thursday', 50.00, 1, '2023-11-03 10:03:40', '2023-10-02 22:14:27'),
(49, 3, 1, 2, '2023-10-07', '09:00:00', '10:00:00', 'saturday', 60.00, 1, '2023-11-03 10:03:40', '2023-10-05 15:28:39'),
(50, 3, 1, 2, '2023-10-07', '10:00:00', '11:00:00', 'saturday', 60.00, 1, '2023-11-03 10:03:40', '2023-10-05 14:30:27'),
(51, 3, 1, 2, '2023-10-07', '11:00:00', '12:00:00', 'saturday', 60.00, 1, '2023-11-03 10:03:40', '2023-10-05 14:30:27'),
(52, 3, 1, 2, '2023-10-07', '12:00:00', '13:00:00', 'saturday', 60.00, 1, '2023-11-03 10:03:40', '2023-10-05 15:26:20'),
(53, 3, 1, 2, '2023-10-07', '13:00:00', '14:00:00', 'saturday', 60.00, 1, '2023-11-03 10:03:40', '2023-10-05 15:29:38'),
(54, 3, 1, 2, '2023-10-07', '14:00:00', '15:00:00', 'saturday', 60.00, 1, '2023-11-03 10:03:40', '2023-10-02 22:46:37'),
(55, 3, 1, 2, '2023-10-27', '09:00:00', '10:00:00', 'friday', 60.00, 1, '2023-11-03 10:03:40', '2023-10-05 19:52:15'),
(56, 3, 1, 2, '2023-10-27', '10:00:00', '11:00:00', 'friday', 60.00, 1, '2023-11-03 10:03:40', '2023-10-05 15:30:15'),
(57, 3, 1, 2, '2023-10-27', '11:00:00', '12:00:00', 'friday', 60.00, 1, '2023-11-03 10:03:40', '2023-10-02 22:49:40'),
(58, 3, 1, 2, '2023-10-27', '12:00:00', '13:00:00', 'friday', 60.00, 1, '2023-11-03 10:03:40', '2023-10-02 22:49:40'),
(59, 3, 1, 2, '2023-10-27', '13:00:00', '14:00:00', 'friday', 60.00, 1, '2023-11-03 10:03:40', '2023-10-05 15:26:20'),
(60, 3, 1, 2, '2023-10-27', '14:00:00', '15:00:00', 'friday', 60.00, 1, '2023-11-03 10:03:40', '2023-10-02 22:49:40'),
(61, 3, 1, 2, '2023-11-03', '09:00:00', '10:00:00', 'tuesday', 60.00, 1, '2023-11-03 10:03:40', '2023-10-03 14:48:32'),
(62, 3, 1, 2, '2023-11-03', '10:00:00', '11:00:00', 'tuesday', 60.00, 1, '2023-11-03 10:03:40', '2023-10-03 14:48:32'),
(63, 3, 1, 2, '2023-11-03', '11:00:00', '12:00:00', 'tuesday', 60.00, 1, '2023-11-03 10:03:40', '2023-10-03 14:48:32'),
(64, 3, 1, 2, '2023-11-03', '12:00:00', '13:00:00', 'tuesday', 60.00, 1, '2023-11-03 10:03:40', '2023-10-03 14:48:32'),
(65, 3, 1, 2, '2023-11-03', '13:00:00', '14:00:00', 'tuesday', 60.00, 1, '2023-11-03 10:03:40', '2023-10-03 14:48:32'),
(66, 3, 1, 2, '2023-11-03', '14:00:00', '15:00:00', 'tuesday', 60.00, 1, '2023-11-03 10:03:40', '2023-10-03 14:48:32'),
(67, 3, 1, 2, '2023-11-03', '09:00:00', '10:00:00', 'wednesday', 60.00, 1, '2023-11-03 10:03:40', '2023-10-03 14:49:48'),
(68, 3, 1, 2, '2023-11-03', '10:00:00', '11:00:00', 'wednesday', 60.00, 1, '2023-11-03 10:03:40', '2023-10-03 14:49:48'),
(69, 3, 1, 2, '2023-11-03', '11:00:00', '12:00:00', 'wednesday', 60.00, 1, '2023-11-03 10:03:40', '2023-10-03 14:49:48'),
(70, 3, 1, 2, '2023-11-03', '12:00:00', '13:00:00', 'wednesday', 60.00, 1, '2023-11-03 10:03:40', '2023-10-03 14:49:48'),
(71, 3, 1, 2, '2023-11-03', '13:00:00', '14:00:00', 'wednesday', 60.00, 1, '2023-11-03 10:03:40', '2023-10-03 14:49:48'),
(72, 3, 1, 2, '2023-11-03', '14:00:00', '15:00:00', 'wednesday', 60.00, 1, '2023-11-03 10:03:40', '2023-10-03 14:49:48'),
(73, 3, 1, 2, '2023-10-21', '09:00:00', '10:00:00', 'saturday', 60.00, 1, '2023-11-03 10:03:40', '2023-10-05 15:50:32'),
(74, 3, 1, 2, '2023-10-21', '10:00:00', '11:00:00', 'saturday', 60.00, 1, '2023-11-03 10:03:40', '2023-10-05 19:04:22'),
(75, 3, 1, 2, '2023-10-21', '11:00:00', '12:00:00', 'saturday', 60.00, 1, '2023-11-03 10:03:40', '2023-10-05 19:04:22'),
(76, 3, 1, 2, '2023-10-21', '12:00:00', '13:00:00', 'saturday', 60.00, 1, '2023-11-03 10:03:40', '2023-10-05 19:52:57'),
(77, 3, 1, 2, '2023-10-21', '13:00:00', '14:00:00', 'saturday', 60.00, 1, '2023-11-03 10:03:40', '2023-10-03 14:50:21'),
(78, 3, 1, 2, '2023-10-21', '14:00:00', '15:00:00', 'saturday', 60.00, 1, '2023-11-03 10:03:40', '2023-10-05 15:30:55'),
(79, 3, 1, 1, '2023-10-27', '09:00:00', '10:00:00', 'friday', 50.00, 1, '2023-11-03 10:03:40', '2023-10-03 20:31:21'),
(80, 3, 1, 1, '2023-10-27', '10:00:00', '11:00:00', 'friday', 50.00, 1, '2023-11-03 10:03:40', '2023-10-03 20:31:21'),
(81, 3, 1, 1, '2023-10-27', '11:00:00', '12:00:00', 'friday', 50.00, 1, '2023-11-03 10:03:40', '2023-10-03 20:31:21'),
(82, 3, 1, 1, '2023-10-27', '12:00:00', '13:00:00', 'friday', 50.00, 1, '2023-11-03 10:03:40', '2023-10-03 20:31:21'),
(83, 3, 1, 1, '2023-10-27', '13:00:00', '14:00:00', 'friday', 50.00, 1, '2023-11-03 10:03:40', '2023-10-03 20:31:21'),
(84, 3, 1, 1, '2023-10-27', '14:00:00', '15:00:00', 'friday', 50.00, 1, '2023-11-03 10:03:40', '2023-10-03 20:31:21'),
(85, 3, 1, 1, '2023-10-05', '09:00:00', '10:00:00', 'thursday', 50.00, 1, '2023-11-03 10:03:40', '2023-10-03 20:36:11'),
(86, 3, 1, 1, '2023-10-05', '10:00:00', '11:00:00', 'thursday', 50.00, 1, '2023-11-03 10:03:40', '2023-10-03 20:36:11'),
(87, 3, 1, 1, '2023-10-05', '11:00:00', '12:00:00', 'thursday', 50.00, 1, '2023-11-03 10:03:40', '2023-10-03 20:36:11'),
(88, 3, 1, 1, '2023-10-05', '12:00:00', '13:00:00', 'thursday', 50.00, 1, '2023-11-03 10:03:40', '2023-10-03 20:36:11'),
(89, 3, 1, 1, '2023-10-05', '13:00:00', '14:00:00', 'thursday', 50.00, 1, '2023-11-03 10:03:40', '2023-10-03 20:36:11'),
(90, 3, 1, 1, '2023-10-05', '14:00:00', '15:00:00', 'thursday', 50.00, 1, '2023-11-03 10:03:40', '2023-10-03 20:36:12'),
(91, 3, 1, 1, '2023-10-20', '09:00:00', '10:00:00', 'friday', 50.00, 1, '2023-11-03 10:03:40', '2023-10-03 20:46:11'),
(92, 3, 1, 1, '2023-10-20', '10:00:00', '11:00:00', 'friday', 50.00, 1, '2023-11-03 10:03:40', '2023-10-03 20:46:11'),
(93, 3, 1, 1, '2023-10-20', '11:00:00', '12:00:00', 'friday', 50.00, 1, '2023-11-03 10:03:40', '2023-10-03 20:46:11'),
(94, 3, 1, 1, '2023-10-20', '12:00:00', '13:00:00', 'friday', 50.00, 1, '2023-11-03 10:03:40', '2023-10-03 20:46:11'),
(95, 3, 1, 1, '2023-10-20', '13:00:00', '14:00:00', 'friday', 50.00, 1, '2023-11-03 10:03:40', '2023-10-03 20:46:11'),
(96, 3, 1, 1, '2023-10-20', '14:00:00', '15:00:00', 'friday', 50.00, 1, '2023-11-03 10:03:40', '2023-10-03 20:46:11'),
(97, 3, 1, 1, '2023-10-26', '09:00:00', '10:00:00', 'thursday', 50.00, 1, '2023-11-03 10:03:40', '2023-10-03 21:07:47'),
(98, 3, 1, 1, '2023-10-26', '10:00:00', '11:00:00', 'thursday', 50.00, 1, '2023-11-03 10:03:40', '2023-10-03 21:07:47'),
(99, 3, 1, 1, '2023-10-26', '11:00:00', '12:00:00', 'thursday', 50.00, 1, '2023-11-03 10:03:40', '2023-10-03 21:07:47'),
(100, 3, 1, 1, '2023-10-26', '12:00:00', '13:00:00', 'thursday', 50.00, 1, '2023-11-03 10:03:40', '2023-10-03 21:07:47'),
(101, 3, 1, 1, '2023-10-26', '13:00:00', '14:00:00', 'thursday', 50.00, 1, '2023-11-03 10:03:40', '2023-10-03 21:07:47'),
(102, 3, 1, 1, '2023-10-26', '14:00:00', '15:00:00', 'thursday', 50.00, 1, '2023-11-03 10:03:40', '2023-10-03 21:07:47'),
(103, 3, 1, 1, '2023-10-13', '09:00:00', '10:00:00', 'friday', 50.00, 1, '2023-10-04 14:45:06', '2023-10-04 23:01:30'),
(104, 3, 1, 1, '2023-10-13', '10:00:00', '11:00:00', 'friday', 50.00, 1, '2023-10-04 14:45:06', '2023-10-04 23:01:30'),
(105, 3, 1, 1, '2023-10-13', '11:00:00', '12:00:00', 'friday', 50.00, 1, '2023-10-04 14:45:06', '2023-10-04 23:01:30'),
(106, 3, 1, 1, '2023-10-13', '12:00:00', '13:00:00', 'friday', 50.00, 1, '2023-10-04 14:45:06', '2023-10-04 14:45:06'),
(107, 3, 1, 1, '2023-10-13', '13:00:00', '14:00:00', 'friday', 50.00, 1, '2023-10-04 14:45:06', '2023-10-04 14:45:06'),
(108, 3, 1, 1, '2023-10-13', '14:00:00', '15:00:00', 'friday', 50.00, 1, '2023-10-04 14:45:06', '2023-10-04 14:45:06'),
(109, 0, 3, 1, '2023-11-03', '11:00:00', '12:00:00', 'wednesday', 50.00, 1, '2023-10-04 20:30:03', '2023-10-04 20:30:03'),
(110, 0, 3, 1, '2023-11-03', '12:00:00', '13:00:00', 'wednesday', 50.00, 1, '2023-10-04 20:30:03', '2023-10-04 20:30:03'),
(111, 0, 3, 1, '2023-11-03', '13:00:00', '14:00:00', 'wednesday', 50.00, 1, '2023-10-04 20:30:03', '2023-10-04 20:30:03'),
(112, 0, 3, 1, '2023-11-03', '14:00:00', '15:00:00', 'wednesday', 50.00, 1, '2023-10-04 20:30:03', '2023-10-04 20:30:03'),
(113, 0, 3, 1, '2023-11-03', '15:00:00', '16:00:00', 'wednesday', 50.00, 1, '2023-10-04 20:30:03', '2023-10-04 20:30:03'),
(114, 0, 3, 1, '2023-11-03', '16:00:00', '17:00:00', 'wednesday', 50.00, 1, '2023-10-04 20:30:03', '2023-10-04 20:30:03'),
(115, 0, 3, 1, '2023-11-03', '17:00:00', '18:00:00', 'wednesday', 50.00, 1, '2023-10-04 20:30:03', '2023-10-04 20:30:03'),
(116, 0, 3, 1, '2023-11-03', '18:00:00', '19:00:00', 'wednesday', 50.00, 1, '2023-10-04 20:30:03', '2023-10-04 20:30:03'),
(117, 0, 3, 1, '2023-11-03', '19:00:00', '20:00:00', 'wednesday', 50.00, 1, '2023-10-04 20:30:03', '2023-10-04 20:30:03'),
(118, 0, 3, 1, '2023-11-03', '20:00:00', '21:00:00', 'wednesday', 50.00, 1, '2023-10-04 20:30:03', '2023-10-04 20:30:03'),
(119, 0, 3, 1, '2023-11-03', '21:00:00', '22:00:00', 'wednesday', 50.00, 1, '2023-10-04 20:30:03', '2023-10-04 20:30:03'),
(120, 0, 3, 1, '2023-11-03', '22:00:00', '23:00:00', 'wednesday', 50.00, 1, '2023-10-04 20:30:03', '2023-10-04 20:30:03'),
(121, 0, 3, 1, '2023-11-03', '23:00:00', '23:30:00', 'wednesday', 50.00, 1, '2023-10-04 20:30:03', '2023-10-04 20:30:03'),
(122, 0, 3, 1, '2023-10-05', '11:00:00', '12:00:00', 'thursday', 50.00, 1, '2023-10-04 20:31:06', '2023-10-04 20:31:06'),
(123, 0, 1, 1, '2023-10-03', '12:00:00', '13:00:00', 'thursday', 50.00, 1, '2023-10-04 20:31:06', '2023-10-04 20:31:06'),
(124, 0, 3, 1, '2023-10-05', '13:00:00', '14:00:00', 'thursday', 50.00, 1, '2023-10-04 20:31:06', '2023-10-04 20:31:06'),
(125, 0, 3, 1, '2023-10-05', '14:00:00', '15:00:00', 'thursday', 50.00, 1, '2023-10-04 20:31:06', '2023-10-04 20:31:06'),
(126, 0, 3, 1, '2023-10-05', '15:00:00', '16:00:00', 'thursday', 50.00, 1, '2023-10-04 20:31:06', '2023-10-04 20:31:06'),
(127, 0, 3, 1, '2023-10-05', '16:00:00', '17:00:00', 'thursday', 50.00, 1, '2023-10-04 20:31:06', '2023-10-04 20:31:06'),
(128, 0, 3, 1, '2023-10-05', '17:00:00', '18:00:00', 'thursday', 50.00, 1, '2023-10-04 20:31:06', '2023-10-04 20:31:06'),
(129, 0, 3, 1, '2023-10-05', '18:00:00', '19:00:00', 'thursday', 50.00, 1, '2023-10-04 20:31:06', '2023-10-04 20:31:06'),
(130, 0, 3, 1, '2023-10-05', '19:00:00', '20:00:00', 'thursday', 50.00, 1, '2023-10-04 20:31:06', '2023-10-04 20:31:06'),
(131, 0, 3, 1, '2023-10-05', '20:00:00', '21:00:00', 'thursday', 50.00, 1, '2023-10-04 20:31:06', '2023-10-04 20:31:06'),
(132, 0, 3, 1, '2023-10-05', '21:00:00', '22:00:00', 'thursday', 50.00, 1, '2023-10-04 20:31:06', '2023-10-04 20:31:06'),
(133, 0, 3, 1, '2023-10-05', '22:00:00', '23:00:00', 'thursday', 50.00, 1, '2023-10-04 20:31:06', '2023-10-04 20:31:06'),
(134, 0, 3, 1, '2023-10-05', '23:00:00', '23:59:00', 'thursday', 50.00, 1, '2023-10-04 20:31:06', '2023-10-04 20:31:06');

-- --------------------------------------------------------

--
-- Table structure for table `sports`
--

DROP TABLE IF EXISTS `sports`;
CREATE TABLE IF NOT EXISTS `sports` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_available` tinyint NOT NULL DEFAULT '1' COMMENT '1=Yes,2=No',
  `is_deleted` tinyint NOT NULL DEFAULT '2' COMMENT '1=Yes,2=No',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sports`
--

INSERT INTO `sports` (`id`, `name`, `image`, `is_available`, `is_deleted`, `created_at`, `updated_at`) VALUES
(1, 'Sport 1', 'default-sport.png', 1, 2, '2023-10-02 20:09:58', '2023-10-02 20:09:58'),
(2, 'Sport 2', 'default-sport.png', 1, 2, '2023-10-02 20:10:06', '2023-10-02 20:10:06'),
(3, 'Sport 3', 'default-sport.png', 1, 2, '2023-10-02 20:10:16', '2023-10-02 20:10:16');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

DROP TABLE IF EXISTS `transactions`;
CREATE TABLE IF NOT EXISTS `transactions` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `type` tinyint NOT NULL COMMENT '1=incoming, 2=Outgoing(refund)',
  `vendor_id` bigint UNSIGNED NOT NULL,
  `dome_id` bigint UNSIGNED DEFAULT NULL,
  `league_id` bigint UNSIGNED DEFAULT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `booking_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contributor_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_method` int NOT NULL DEFAULT '1' COMMENT '1=Card, 2=Apple Pay, 3=Google Pay',
  `transaction_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` decimal(8,2) NOT NULL,
  `is_payment_released` tinyint NOT NULL DEFAULT '2' COMMENT '1=Yes, 2=No',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `transactions_vendor_id_foreign` (`vendor_id`),
  KEY `transactions_dome_id_foreign` (`dome_id`),
  KEY `transactions_league_id_foreign` (`league_id`),
  KEY `transactions_user_id_foreign` (`user_id`),
  KEY `transactions_booking_id_foreign` (`booking_id`(250))
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `type`, `vendor_id`, `dome_id`, `league_id`, `user_id`, `booking_id`, `contributor_name`, `payment_method`, `transaction_id`, `amount`, `is_payment_released`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 1, NULL, 6, 'eecb2382', NULL, 1, 'pi_3Nx7WAFysF0okTxJ0oEJC66W', '4.38', 2, '2023-10-03 21:46:22', '2023-10-03 21:46:22'),
(2, 1, 2, 1, NULL, 6, '3130916d', NULL, 1, 'pi_3Nx8CKFysF0okTxJ09OYcOu5', '52.50', 2, '2023-10-03 22:33:44', '2023-10-03 22:33:44'),
(3, 1, 2, 1, NULL, 6, 'addd3fb4', NULL, 1, 'pi_3Nx8vDFysF0okTxJ12yaUEaY', '52.50', 2, '2023-10-03 23:16:16', '2023-10-03 23:16:16'),
(4, 1, 2, 1, NULL, 6, '34555a33', NULL, 1, 'pi_3Nx9B2FysF0okTxJ0iSpxcTK', '4.38', 2, '2023-10-03 23:32:34', '2023-10-03 23:32:34'),
(5, 1, 2, 1, NULL, 6, 'e8659e18', NULL, 1, 'pi_3Nx9NmFysF0okTxJ1BVMsqGg', '4.38', 2, '2023-10-03 23:45:44', '2023-10-03 23:45:44'),
(6, 1, 2, 1, NULL, 6, '34555a33', NULL, 1, 'pi_3Nx9B2FysF0okTxJ0iSpxcTK', '4.38', 2, '2023-10-03 23:32:34', '2023-10-03 23:32:34'),
(7, 1, 2, 1, NULL, 6, '34555a33', NULL, 1, 'pi_3Nx9B2FysF0okTxJ0iSpxcTK', '4.38', 2, '2023-10-03 23:32:34', '2023-10-03 23:32:34'),
(8, 1, 2, 1, NULL, 6, '34555a33', NULL, 1, 'pi_3Nx9B2FysF0okTxJ0iSpxcTK', '4.38', 2, '2023-10-03 23:32:34', '2023-10-03 23:32:34'),
(9, 1, 2, 1, NULL, 6, '34555a33', NULL, 1, 'pi_3Nx9B2FysF0okTxJ0iSpxcTK', '4.38', 2, '2023-10-03 23:32:34', '2023-10-03 23:32:34'),
(10, 1, 2, 1, NULL, 6, '34555a33', NULL, 1, 'pi_3Nx9B2FysF0okTxJ0iSpxcTK', '4.38', 2, '2023-10-03 23:32:34', '2023-10-03 23:32:34'),
(11, 1, 2, 1, NULL, 6, '34555a33', NULL, 1, 'pi_3Nx9B2FysF0okTxJ0iSpxcTK', '4.38', 2, '2023-10-03 23:32:34', '2023-10-03 23:32:34'),
(12, 1, 2, 1, NULL, 6, '990ac26b', NULL, 1, 'pi_3NxPFVFysF0okTxJ1LIuTXr3', '52.50', 2, '2023-10-04 16:42:55', '2023-10-04 16:42:55'),
(13, 1, 2, 1, NULL, 6, '50bbb93a', NULL, 1, 'pi_3NxT0sFysF0okTxJ0xdArlbc', '52.50', 2, '2023-10-04 20:43:45', '2023-10-04 20:43:45'),
(14, 1, 2, 1, NULL, 6, 'fae5f886', NULL, 1, 'fsdgdfsgfd', '52.50', 2, '2023-10-05 23:32:05', '2023-10-05 23:32:05');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `type` int NOT NULL COMMENT '1=Admin, 2=Dome Owner, 3=User, 4=Employee, 5=Provider	',
  `login_type` int NOT NULL DEFAULT '1' COMMENT '1=Email, 2=Google, 3=Apple, 4=Facebook	',
  `vendor_id` bigint UNSIGNED DEFAULT NULL COMMENT 'For Workers use only',
  `dome_limit` tinyint DEFAULT NULL COMMENT 'Only For Dome Owner',
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `countrycode` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `google_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `apple_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `facebook_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fcm_token` text COLLATE utf8mb4_unicode_ci,
  `otp` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'default.png',
  `is_verified` int NOT NULL DEFAULT '2' COMMENT '1=Yes, 2=No',
  `is_available` int NOT NULL DEFAULT '1' COMMENT '1=Yes, 2=No',
  `is_deleted` int NOT NULL DEFAULT '2' COMMENT '1=Yes, 2=No',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `users_vendor_id_foreign` (`vendor_id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `type`, `login_type`, `vendor_id`, `dome_limit`, `name`, `email`, `countrycode`, `phone`, `password`, `google_id`, `apple_id`, `facebook_id`, `fcm_token`, `otp`, `image`, `is_verified`, `is_available`, `is_deleted`, `created_at`, `updated_at`) VALUES
(1, 1, 1, NULL, NULL, 'Admin', 'admin@gmail.com', NULL, NULL, '$2y$10$wPcjS6394evN1zKA.TOUUOkNBjdpA7KBOtQV.40v1IFGjyNkKB.Ra', NULL, NULL, NULL, NULL, NULL, 'default.png', 1, 1, 2, '2023-09-19 08:37:33', '2023-09-19 08:37:33'),
(2, 2, 1, NULL, 2, 'Admin', 'domeowner@yopmail.com', NULL, NULL, '$2y$10$wPcjS6394evN1zKA.TOUUOkNBjdpA7KBOtQV.40v1IFGjyNkKB.Ra', NULL, NULL, NULL, NULL, '', 'default.png', 1, 1, 2, '2023-06-08 18:49:52', '2023-08-24 05:58:27'),
(3, 3, 2, NULL, NULL, 'Meet Gabani', 'mitgabani350@gmail.com', '', '', NULL, '100445657511173093342', NULL, NULL, 'c4O8Q-d5Q-CeauLgBS8zvF:APA91bGykmUOlau9jtvmCQ-AdQZS_Q569EiWwyv_LsccdWq9WI3eWzXh6xYZeMCsl_hcSzoOehG4tVsLgbza3er3x2R0QgZTgiCMX-HX-BesTki1tjhjVmgKNC762jbtrgX0EXCFaEKg', NULL, 'default.png', 1, 1, 2, '2023-09-20 15:23:34', '2023-09-20 15:23:34'),
(4, 3, 2, NULL, NULL, 'Hitesh Suratikvxvkxvkxvkbmxbmx', 'suratihitesh44@gmail.com', 'AS', '3583383', NULL, '108590077845795740557', NULL, NULL, 'test', NULL, 'profiles-651aaf2de9a7d.png', 1, 1, 2, '2023-10-02 13:08:27', '2023-10-03 19:30:47'),
(5, 3, 2, NULL, NULL, 'Diwakar kumar tiwari', 'tdiwakarkumar@gmail.com', '', '', NULL, '108233109670195665567', NULL, NULL, 'ccC7ZcNxfUMQkcr9EM9oBD:APA91bG8cUSgyg2g0Hp0Z5qWou3TOd_oMCcn5lrxloBtPf1G9JXRAfp789dR_6GC8Ph6Ao1zVj-yAYkd0MTF8dQl0cKaRdJ6IzObrfSIP4q4JxEeYUVqAlQc8NsfNgW47Kl4D7v-Gjo6', NULL, 'default.png', 1, 1, 2, '2023-10-02 22:52:31', '2023-10-02 22:52:31'),
(6, 3, 2, NULL, NULL, 'Soham Shah', 'sohamtest404@gmail.com', '', '', NULL, '113314146991157284773', NULL, NULL, 'cYbBIL_zm01Mq26u2ctaOn:APA91bHHg2rKpJPYLa_d18y1cotVHBc2OAeAMYPbRMdQ20J65KOSaEY__Rn_M6OMwwO0pgrYegjHikpX3Jt5szEgnpnZI0l6gkku-vnPz4pOaphknzvdWktfUpzQ_FSalGJ0Ud-bjZ2I', NULL, 'default.png', 1, 1, 2, '2023-10-03 21:45:41', '2023-10-03 21:45:41'),
(7, 3, 2, NULL, NULL, 'Soham Shah', 'developersoham7@gmail.com', '', '', NULL, '102066544323619435645', NULL, NULL, 'cEGJg8XDlE0_sh0pA0sTks:APA91bGmu9KQEYZ4ipU14GuhgzaZP08fuyqilbT_PfbRB6wEJ89o01_5BR0rWYRVFvHB8AsMuRyu8GLRh0cT3kyXKQ8_83N0yEJCOnR6DHUIZTFtKiPiXjxQkVIWyR33ZLW38e7GMiFo', NULL, 'default.png', 1, 1, 2, '2023-10-05 22:05:42', '2023-10-05 22:05:42');

-- --------------------------------------------------------

--
-- Table structure for table `working_hours`
--

DROP TABLE IF EXISTS `working_hours`;
CREATE TABLE IF NOT EXISTS `working_hours` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `vendor_id` bigint UNSIGNED NOT NULL,
  `dome_id` bigint UNSIGNED NOT NULL,
  `day` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `open_time` time NOT NULL,
  `close_time` time NOT NULL,
  `is_closed` tinyint NOT NULL DEFAULT '2' COMMENT '1=Yes,2=No',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `working_hours_vendor_id_foreign` (`vendor_id`),
  KEY `working_hours_dome_id_foreign` (`dome_id`)
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `working_hours`
--

INSERT INTO `working_hours` (`id`, `vendor_id`, `dome_id`, `day`, `open_time`, `close_time`, `is_closed`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 'monday', '09:00:00', '15:00:00', 2, '2023-10-02 20:12:03', '2023-10-02 20:12:03'),
(2, 2, 1, 'tuesday', '09:00:00', '15:00:00', 2, '2023-10-02 20:12:03', '2023-10-02 20:12:03'),
(3, 2, 1, 'wednesday', '09:00:00', '15:00:00', 2, '2023-10-02 20:12:03', '2023-10-02 20:12:03'),
(4, 2, 1, 'thursday', '09:00:00', '15:00:00', 2, '2023-10-02 20:12:03', '2023-10-02 20:12:03'),
(5, 2, 1, 'friday', '09:00:00', '15:00:00', 2, '2023-10-02 20:12:03', '2023-10-02 20:12:03'),
(6, 2, 1, 'saturday', '09:00:00', '15:00:00', 2, '2023-10-02 20:12:03', '2023-10-02 20:12:03'),
(7, 2, 1, 'sunday', '09:00:00', '15:00:00', 2, '2023-10-02 20:12:03', '2023-10-02 20:12:03'),
(8, 2, 2, 'monday', '11:00:00', '21:00:00', 2, '2023-10-04 20:22:09', '2023-10-04 20:22:09'),
(9, 2, 2, 'tuesday', '11:00:00', '21:00:00', 2, '2023-10-04 20:22:09', '2023-10-04 20:22:09'),
(10, 2, 2, 'wednesday', '11:00:00', '21:00:00', 2, '2023-10-04 20:22:09', '2023-10-04 20:22:09'),
(11, 2, 2, 'thursday', '11:00:00', '21:00:00', 2, '2023-10-04 20:22:09', '2023-10-04 20:22:09'),
(12, 2, 2, 'friday', '11:00:00', '21:00:00', 2, '2023-10-04 20:22:09', '2023-10-04 20:22:09'),
(13, 2, 2, 'saturday', '11:00:00', '21:00:00', 2, '2023-10-04 20:22:09', '2023-10-04 20:22:09'),
(14, 2, 2, 'sunday', '11:00:00', '21:00:00', 2, '2023-10-04 20:22:09', '2023-10-04 20:22:09'),
(15, 2, 3, 'monday', '11:00:00', '23:59:00', 1, '2023-10-04 20:24:41', '2023-10-04 20:24:41'),
(16, 2, 3, 'tuesday', '11:00:00', '23:30:00', 1, '2023-10-04 20:24:41', '2023-10-04 20:24:41'),
(17, 2, 3, 'wednesday', '11:00:00', '23:30:00', 1, '2023-10-04 20:24:41', '2023-10-04 20:24:41'),
(18, 2, 3, 'thursday', '11:00:00', '23:59:00', 2, '2023-10-04 20:24:41', '2023-10-04 20:24:41'),
(19, 2, 3, 'friday', '11:00:00', '23:59:00', 1, '2023-10-04 20:24:41', '2023-10-04 20:24:41'),
(20, 2, 3, 'saturday', '11:00:00', '23:30:00', 2, '2023-10-04 20:24:41', '2023-10-04 20:24:41'),
(21, 2, 3, 'sunday', '11:00:00', '23:00:00', 1, '2023-10-04 20:24:41', '2023-10-04 20:24:41');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
