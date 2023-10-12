-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Oct 12, 2023 at 01:10 PM
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
  `payment_status` int NOT NULL DEFAULT '1' COMMENT '0=WhenBookingIsRequested(BookingModeManual),1=Complete, 2=Partial, 3=Refunded',
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
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `type`, `vendor_id`, `provider_id`, `dome_id`, `league_id`, `user_id`, `sport_id`, `field_id`, `booking_id`, `slots`, `start_date`, `end_date`, `start_time`, `end_time`, `booking_mode`, `age_discount_amount`, `fields_discount_amount`, `sub_total`, `service_fee`, `hst`, `total_amount`, `paid_amount`, `due_amount`, `min_split_amount`, `refunded_amount`, `payment_mode`, `payment_type`, `payment_status`, `booking_status`, `booking_accepted_at`, `token`, `players`, `customer_name`, `customer_email`, `customer_mobile`, `team_name`, `cancelled_by`, `cancellation_reason`, `is_payment_released`, `is_review_noti_send`, `created_at`, `updated_at`) VALUES
(1, 1, 2, NULL, 4, NULL, 12, 1, '5', '8d0727d3', '09:00 AM - 10:30 AM', '2023-10-26', NULL, '09:00:00', '10:30:00', 2, 80, 0, 120, 6, 14.4, 60.4, 60.4, 0, 0, 0, 1, 1, 1, 1, '2023-10-11 19:23:42', '2y10JjPrpThB1GZzJ9iecCIMkndeTQUkSH4P0NtcVrhhP0YuOYo4uu', 12, 'dddddh', 'ffd@gmail.com', '5555555555', '', NULL, NULL, 2, 2, '2023-10-11 23:22:13', '2023-10-11 23:25:02'),
(2, 1, 2, NULL, 4, NULL, 12, 1, '5', 'abaee6aa', '09:00 AM - 10:30 AM,10:30 AM - 12:00 PM,12:00 PM - 01:30 PM,01:30 PM - 03:00 PM', '2023-10-27', NULL, '09:00:00', '15:00:00', 1, 0, 0, 480, 24, 57.6, 561.6, 561.6, 0, 0, 0, 1, 1, 1, 1, NULL, '2y107WEp9ITfGhCpgtGO9bv6OXF2vjnQo9kOecrSuASVydNAQJM7Dg3O', 12, 'dddddh', 'ffd@gmail.com', '5555555555', '', NULL, NULL, 2, 2, '2023-10-12 14:14:20', '2023-10-12 14:14:20'),
(3, 1, 2, NULL, 4, NULL, 5, 1, '2', 'eb42e99b', '09:00 AM - 10:30 AM,10:30 AM - 12:00 PM,12:00 PM - 01:30 PM,01:30 PM - 03:00 PM', '2023-10-26', NULL, '09:00:00', '15:00:00', 1, 0, 0, 480, 24, 57.6, 561.6, 561.6, 0, 0, 0, 1, 1, 1, 1, NULL, '2y10FIGaaLFTkaJSMBHO1T1aVuOz08jsBL0iGTI5SlAnHqtTJNcB8JJWy', 12, 'Diwakar kumar tiwari', 'tdiwakarkumar@gmail.com', '', '', NULL, NULL, 2, 2, '2023-10-12 19:17:26', '2023-10-12 19:17:26'),
(4, 1, 2, NULL, 4, NULL, 5, 1, '2,3', '8bbae046', '09:00 AM - 10:30 AM', '2023-10-19', NULL, '09:00:00', '10:30:00', 2, 20, 24, 240, 12, 28.8, 236.8, 19.73, 217.07, 0, 0, 1, 2, 2, 2, '2023-10-12 15:31:57', '2y10krLtmEvw6naMzXYbbd013G8hMA6M73YXPQV9H0aBEOg7Y9OlCW', 12, 'Diwakar kumar tiwari', 'tdiwakarkumar@gmail.com', '', '', NULL, NULL, 2, 2, '2023-10-12 19:31:35', '2023-10-12 19:33:03'),
(5, 1, 2, NULL, 4, NULL, 7, 1, '2,3', 'f5eec2c7', '09:00 AM - 10:30 AM', '2023-10-27', NULL, '09:00:00', '10:30:00', 2, 20, 24, 240, 12, 28.8, 236.8, 236.8, 236.8, 0, 0, 1, 0, 2, 4, NULL, '2y1051CN97UmNyPX1nMiAUCkOSGGGqm2A7MqAoCwre1ts56i5BD99fXW', 12, 'Soham Shah', 'developersoham7@gmail.com', '', '', NULL, NULL, 2, 2, '2023-10-12 22:18:27', '2023-10-12 22:18:27');

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
  `multiple_fields_selection` int DEFAULT '0' COMMENT 'For Multiple Fields Selection Discount',
  `fields_discount` double DEFAULT '0',
  `fields_discount_type` tinyint DEFAULT '1' COMMENT '1=Percentage, 2=Fixed',
  `booking_mode` tinyint NOT NULL DEFAULT '1' COMMENT '1=Automatic, 2=Mannual',
  `policies_rules` longtext COLLATE utf8mb4_unicode_ci,
  `is_deleted` tinyint NOT NULL DEFAULT '2' COMMENT '1=Yes,2=No',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `domes_vendor_id_foreign` (`vendor_id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `domes`
--

INSERT INTO `domes` (`id`, `vendor_id`, `sport_id`, `name`, `price`, `hst`, `address`, `pin_code`, `city`, `state`, `country`, `slot_duration`, `description`, `lat`, `lng`, `benefits`, `benefits_description`, `multiple_fields_selection`, `fields_discount`, `fields_discount_type`, `booking_mode`, `policies_rules`, `is_deleted`, `created_at`, `updated_at`) VALUES
(1, 2, '1,2,3', 'First Dome', 0.00, 10.00, 'Varachha, Surat, Gujarat, India', '395007', 'Surat', 'Gujarat', 'India', 1, 'Lorem is Dome policy to check the data of fake words to the industry. Lorem is Dome policy to check the data of fake words to the industry. Lorem is Dome policy to check the data of fake words to the industry. Lorem is Dome policy to check the data of fake words to the industry. Lorem is Dome policy to check the data of fake words to the industry. Lorem is Dome policy to check the data of fake words to the industry. Lorem is Dome policy to check the data of fake words to the industry.', '21.2021189', '72.8672703', 'Free Wifi|Changing Room|Parking', 'Lorem is Dome policy to check the data of fake words to the industry. Lorem is Dome policy to check the data of fake words to the industry. Lorem is Dome policy to check the data of fake words to the industry.', 3, 50, 1, 2, 'Lorem is Dome policy to check the data of fake words to the industry. Lorem is Dome policy to check the data of fake words to the industry. Lorem is Dome policy to check the data of fake words to the industry. Lorem is Dome policy to check the data of fake words to the industry. Lorem is Dome policy to check the data of fake words to the industry. Lorem is Dome policy to check the data of fake words to the industry.', 1, '2023-10-11 20:14:43', '2023-10-11 22:31:14'),
(2, 2, '1,2', 'Soham', 0.00, 50.00, 'Canada\'s Wonderland, Vaughan, ON, Canada', 'L6A 1S6', 'Vaughan', 'Ontario', 'Canada', 1, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '43.8423619', '-79.54121549999999', 'Free Wifi|Changing Room', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 5, 50, 1, 2, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 2, '2023-10-11 20:16:20', '2023-10-12 16:38:00'),
(4, 2, '1,2,3', 'Second Dome', 0.00, 12.00, 'Varachha, Surat, Gujarat, India', '395007', 'Surat', 'Gujarat', 'India', 2, 'Lorem is Dome policy to check the data of fake words to the industry. Lorem is Dome policy to check the data of fake words to the industry. Lorem is Dome policy to check the data of fake words to the industry. Lorem is Dome policy to check the data of fake words to the industry. Lorem is Dome policy to check the data of fake words to the industry. Lorem is Dome policy to check the data of fake words to the industry. Lorem is Dome policy to check the data of fake words to the industry.', '21.2021189', '72.8672703', 'Free Wifi|Others', 'Lorem is Dome policy to check the data of fake words to the industry. Lorem is Dome policy to check the data of fake words to the industry. Lorem is Dome policy to check the data of fake words to the industry.', 5, 10, 2, 2, 'ss', 2, '2023-10-11 20:19:03', '2023-10-12 22:05:23');

-- --------------------------------------------------------

--
-- Table structure for table `dome_discounts`
--

DROP TABLE IF EXISTS `dome_discounts`;
CREATE TABLE IF NOT EXISTS `dome_discounts` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `dome_id` bigint UNSIGNED NOT NULL,
  `sport_id` bigint UNSIGNED NOT NULL,
  `from_age` int NOT NULL DEFAULT '0',
  `to_age` int NOT NULL DEFAULT '0',
  `age_discounts` double NOT NULL DEFAULT '0',
  `discount_type` double NOT NULL DEFAULT '1' COMMENT '1=In Percentage, 2=Fixed',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `dome_discounts_dome_id_foreign` (`dome_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `dome_discounts`
--

INSERT INTO `dome_discounts` (`id`, `dome_id`, `sport_id`, `from_age`, `to_age`, `age_discounts`, `discount_type`, `created_at`, `updated_at`) VALUES
(1, 4, 1, 1, 4, 20, 2, '2023-10-12 16:17:23', '2023-10-12 19:18:39'),
(2, 4, 1, 5, 11, 11, 1, '2023-10-12 16:17:23', '2023-10-12 22:05:23'),
(4, 4, 3, 42, 61, 5, 1, '2023-10-12 16:18:12', '2023-10-12 19:18:39'),
(5, 2, 1, 1, 9, 10, 1, '2023-10-12 16:38:00', '2023-10-12 16:38:00');

-- --------------------------------------------------------

--
-- Table structure for table `dome_field_discounts`
--

DROP TABLE IF EXISTS `dome_field_discounts`;
CREATE TABLE IF NOT EXISTS `dome_field_discounts` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `dome_id` bigint UNSIGNED NOT NULL,
  `sport_id` bigint UNSIGNED NOT NULL,
  `number_of_fields` int NOT NULL DEFAULT '0',
  `discount` double NOT NULL DEFAULT '1' COMMENT '1=In Percentage, 2=Fixed',
  `discount_type` tinyint NOT NULL DEFAULT '1' COMMENT '1=In Percentage, 2=Fixed',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `dome_field_discounts_dome_id_foreign` (`dome_id`),
  KEY `dome_field_discounts_sport_id_foreign` (`sport_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `dome_field_discounts`
--

INSERT INTO `dome_field_discounts` (`id`, `dome_id`, `sport_id`, `number_of_fields`, `discount`, `discount_type`, `created_at`, `updated_at`) VALUES
(1, 4, 1, 2, 10, 1, '2023-10-12 16:17:23', '2023-10-12 19:18:39'),
(2, 4, 2, 2, 20, 2, '2023-10-12 16:17:23', '2023-10-12 19:18:39'),
(3, 2, 1, 3, 4, 2, '2023-10-12 16:38:00', '2023-10-12 16:38:00'),
(4, 4, 3, 2, 2, 1, '2023-10-12 16:54:04', '2023-10-12 19:18:39');

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
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `dome_images`
--

INSERT INTO `dome_images` (`id`, `dome_id`, `league_id`, `images`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, 'dome-65267c9b439a0.jpg', '2023-10-11 20:14:43', '2023-10-11 20:14:43'),
(2, 2, NULL, 'dome-65267cfcf3b43.jpg', '2023-10-11 20:16:21', '2023-10-11 20:16:21'),
(3, 2, NULL, 'dome-65267cfd029e6.jpg', '2023-10-11 20:16:21', '2023-10-11 20:16:21'),
(4, 3, NULL, 'dome-65267d07958bf.jpg', '2023-10-11 20:16:31', '2023-10-11 20:16:31'),
(5, 3, NULL, 'dome-65267d0797b6b.jpg', '2023-10-11 20:16:31', '2023-10-11 20:16:31'),
(6, 4, NULL, 'dome-65267d9fbb77c.jpg', '2023-10-11 20:19:03', '2023-10-11 20:19:03'),
(7, 5, NULL, 'dome-65268f992259a.png', '2023-10-11 21:35:45', '2023-10-11 21:35:45'),
(8, 6, NULL, 'dome-65269625b7707.jpg', '2023-10-11 22:03:41', '2023-10-11 22:03:41'),
(9, 7, NULL, 'dome-6526964cd59f6.jpg', '2023-10-11 22:04:20', '2023-10-11 22:04:20'),
(10, 8, NULL, 'dome-65269c05af0b1.jpeg', '2023-10-11 22:28:45', '2023-10-11 22:28:45'),
(12, NULL, 1, 'league-652789b23a735.jpg', '2023-10-12 15:22:50', '2023-10-12 15:22:50'),
(16, 4, NULL, 'dome-6527a0360b631.jpg', '2023-10-12 16:58:54', '2023-10-12 16:58:54'),
(15, 4, NULL, 'dome-6527a036093e5.jpg', '2023-10-12 16:58:54', '2023-10-12 16:58:54'),
(17, 4, NULL, 'dome-6527a0360d0a6.jpg', '2023-10-12 16:58:54', '2023-10-12 16:58:54');

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
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `fields`
--

INSERT INTO `fields` (`id`, `vendor_id`, `dome_id`, `sport_id`, `name`, `area`, `min_person`, `max_person`, `image`, `maintenance_date`, `in_maintenance`, `is_available`, `is_deleted`, `created_at`, `updated_at`) VALUES
(1, 2, 2, 1, '99', 12.00, 1, 100, 'field-65267d4e3f99f.jpg', NULL, 2, 1, 2, '2023-10-11 20:17:42', '2023-10-11 22:21:31'),
(2, 2, 4, 1, '22', 122.00, 1, 64, 'field-65269c2c14af9.jpg', NULL, 2, 1, 2, '2023-10-11 22:29:24', '2023-10-12 18:49:49'),
(3, 2, 4, 1, '33', 222.00, 1, 65, 'field-65269cddb54e2.jpg', NULL, 2, 1, 2, '2023-10-11 22:32:21', '2023-10-12 18:48:24'),
(4, 2, 2, 2, 'first', 1500.00, 2, 54, 'field-6526a74a649ae.png', NULL, 2, 1, 2, '2023-10-11 23:16:50', '2023-10-11 23:16:50'),
(5, 2, 4, 1, '123', 1000.00, 1, 58, 'field-6526a778af7ce.jpg', NULL, 2, 1, 2, '2023-10-11 23:17:36', '2023-10-11 23:17:36'),
(6, 2, 4, 2, 'test', 5000.00, 3, 15, 'field-6527b10b94e12.jpg', NULL, 2, 1, 2, '2023-10-12 18:10:43', '2023-10-12 18:10:43'),
(7, 2, 4, 3, 'f123', 12000.00, 10, 59, 'field-6527b131ddb30.jpg', NULL, 2, 1, 2, '2023-10-12 18:11:21', '2023-10-12 18:11:21');

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
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `leagues`
--

INSERT INTO `leagues` (`id`, `vendor_id`, `provider_id`, `dome_id`, `field_id`, `sport_id`, `name`, `booking_deadline`, `start_date`, `end_date`, `start_time`, `end_time`, `days`, `from_age`, `to_age`, `gender`, `min_player`, `max_player`, `team_limit`, `price`, `is_deleted`, `created_at`, `updated_at`) VALUES
(1, 2, NULL, 2, '4', 2, 'soham', '2023-10-12', '2023-10-13', '2023-10-14', '01:30', '17:30', 'Tue | Wed | Sun', 1, 90, 1, 12, 14, 8, 22, 2, '2023-10-12 15:20:48', '2023-10-12 15:20:48');

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
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(21, '2099_09_14_113127_add_foreign_keys', 1),
(22, '2023_10_11_172002_create_dome_field_discounts_table', 2);

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
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `set_prices`
--

INSERT INTO `set_prices` (`id`, `vendor_id`, `dome_id`, `sport_id`, `start_date`, `end_date`, `price_type`, `price`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 1, NULL, NULL, 1, 20.00, '2023-10-11 20:14:43', '2023-10-11 20:14:43'),
(2, 2, 1, 2, NULL, NULL, 1, 50.00, '2023-10-11 20:14:43', '2023-10-11 20:14:43'),
(3, 2, 1, 3, NULL, NULL, 1, 30.00, '2023-10-11 20:14:43', '2023-10-11 20:14:43'),
(4, 2, 2, 1, NULL, NULL, 1, 100.00, '2023-10-11 20:16:21', '2023-10-11 22:22:53'),
(5, 2, 2, 2, NULL, NULL, 1, 15.00, '2023-10-11 20:16:21', '2023-10-11 20:16:21'),
(6, 2, 3, 1, NULL, NULL, 1, 12.00, '2023-10-11 20:16:31', '2023-10-11 20:16:31'),
(7, 2, 3, 2, NULL, NULL, 1, 15.00, '2023-10-11 20:16:31', '2023-10-11 20:16:31'),
(8, 2, 4, 1, NULL, NULL, 1, 120.00, '2023-10-11 20:19:03', '2023-10-11 20:19:03'),
(9, 2, 4, 2, NULL, NULL, 1, 150.00, '2023-10-11 20:19:03', '2023-10-11 20:19:03'),
(10, 2, 4, 3, NULL, NULL, 1, 130.00, '2023-10-11 20:19:03', '2023-10-11 20:19:03'),
(11, 2, 5, 1, NULL, NULL, 1, 110.00, '2023-10-11 21:35:45', '2023-10-11 21:35:45'),
(12, 2, 5, 2, NULL, NULL, 1, 120.00, '2023-10-11 21:35:45', '2023-10-11 21:35:45'),
(13, 2, 5, 3, NULL, NULL, 1, 150.00, '2023-10-11 21:35:45', '2023-10-11 21:35:45'),
(14, 2, 6, 1, NULL, NULL, 1, 50.00, '2023-10-11 22:03:41', '2023-10-11 22:03:41'),
(15, 2, 6, 2, NULL, NULL, 1, 60.00, '2023-10-11 22:03:41', '2023-10-11 22:03:41'),
(16, 2, 6, 3, NULL, NULL, 1, 80.00, '2023-10-11 22:03:41', '2023-10-11 22:03:41'),
(17, 2, 7, 1, NULL, NULL, 1, 50.00, '2023-10-11 22:04:20', '2023-10-11 22:04:20'),
(18, 2, 7, 2, NULL, NULL, 1, 60.00, '2023-10-11 22:04:20', '2023-10-11 22:04:20'),
(19, 2, 7, 3, NULL, NULL, 1, 80.00, '2023-10-11 22:04:20', '2023-10-11 22:04:20'),
(20, 2, 8, 1, NULL, NULL, 1, 20.00, '2023-10-11 22:28:45', '2023-10-11 22:28:45'),
(21, 2, 8, 2, NULL, NULL, 1, 20.00, '2023-10-11 22:28:45', '2023-10-11 22:28:45'),
(22, 2, 8, 3, NULL, NULL, 1, 20.00, '2023-10-11 22:28:45', '2023-10-11 22:28:45');

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
  `status` int NOT NULL COMMENT '0=BlockedFromApp,1=Available,2=AdminBLocked',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `set_prices_days_slots_set_prices_id_foreign` (`set_prices_id`),
  KEY `set_prices_days_slots_dome_id_foreign` (`dome_id`),
  KEY `set_prices_days_slots_sport_id_foreign` (`sport_id`)
) ENGINE=MyISAM AUTO_INCREMENT=269 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `set_prices_days_slots`
--

INSERT INTO `set_prices_days_slots` (`id`, `set_prices_id`, `dome_id`, `sport_id`, `date`, `start_time`, `end_time`, `day`, `price`, `status`, `created_at`, `updated_at`) VALUES
(1, 0, 2, 1, '2023-10-11', '01:00:00', '02:00:00', 'wednesday', 12.00, 1, '2023-10-11 20:20:44', '2023-10-11 20:20:44'),
(2, 0, 2, 1, '2023-10-11', '02:00:00', '03:00:00', 'wednesday', 12.00, 1, '2023-10-11 20:20:44', '2023-10-11 20:20:44'),
(3, 0, 2, 1, '2023-10-11', '03:00:00', '04:00:00', 'wednesday', 12.00, 1, '2023-10-11 20:20:44', '2023-10-11 20:20:44'),
(4, 0, 2, 1, '2023-10-11', '04:00:00', '05:00:00', 'wednesday', 12.00, 1, '2023-10-11 20:20:44', '2023-10-11 20:20:44'),
(5, 0, 2, 1, '2023-10-11', '05:00:00', '06:00:00', 'wednesday', 12.00, 1, '2023-10-11 20:20:44', '2023-10-11 20:20:44'),
(6, 0, 2, 1, '2023-10-11', '06:00:00', '07:00:00', 'wednesday', 12.00, 1, '2023-10-11 20:20:44', '2023-10-11 20:20:44'),
(7, 0, 2, 1, '2023-10-11', '07:00:00', '08:00:00', 'wednesday', 12.00, 1, '2023-10-11 20:20:44', '2023-10-11 20:20:44'),
(8, 0, 2, 1, '2023-10-11', '08:00:00', '09:00:00', 'wednesday', 12.00, 1, '2023-10-11 20:20:44', '2023-10-11 20:20:44'),
(9, 0, 2, 1, '2023-10-11', '09:00:00', '10:00:00', 'wednesday', 12.00, 1, '2023-10-11 20:20:44', '2023-10-11 20:20:44'),
(10, 0, 2, 1, '2023-10-11', '10:00:00', '11:00:00', 'wednesday', 12.00, 1, '2023-10-11 20:20:44', '2023-10-11 20:20:44'),
(11, 0, 2, 1, '2023-10-11', '11:00:00', '12:00:00', 'wednesday', 12.00, 1, '2023-10-11 20:20:44', '2023-10-11 20:20:44'),
(12, 0, 2, 1, '2023-10-11', '12:00:00', '13:00:00', 'wednesday', 12.00, 1, '2023-10-11 20:20:44', '2023-10-11 20:20:44'),
(13, 0, 2, 1, '2023-10-11', '13:00:00', '14:00:00', 'wednesday', 12.00, 1, '2023-10-11 20:20:44', '2023-10-11 20:20:44'),
(14, 0, 2, 1, '2023-10-11', '14:00:00', '15:00:00', 'wednesday', 12.00, 1, '2023-10-11 20:20:44', '2023-10-11 20:20:44'),
(15, 0, 2, 1, '2023-10-11', '15:00:00', '16:00:00', 'wednesday', 12.00, 1, '2023-10-11 20:20:44', '2023-10-11 20:20:44'),
(16, 0, 2, 1, '2023-10-11', '16:00:00', '17:00:00', 'wednesday', 12.00, 1, '2023-10-11 20:20:44', '2023-10-11 20:20:44'),
(17, 0, 2, 1, '2023-10-11', '17:00:00', '18:00:00', 'wednesday', 12.00, 1, '2023-10-11 20:20:44', '2023-10-11 20:20:44'),
(18, 0, 2, 1, '2023-10-11', '18:00:00', '19:00:00', 'wednesday', 12.00, 1, '2023-10-11 20:20:44', '2023-10-11 20:20:44'),
(19, 0, 2, 1, '2023-10-11', '19:00:00', '20:00:00', 'wednesday', 12.00, 1, '2023-10-11 20:20:44', '2023-10-11 23:00:55'),
(20, 0, 2, 1, '2023-10-11', '20:00:00', '21:00:00', 'wednesday', 12.00, 1, '2023-10-11 20:20:44', '2023-10-11 23:00:55'),
(21, 0, 2, 1, '2023-10-11', '21:00:00', '22:00:00', 'wednesday', 12.00, 1, '2023-10-11 20:20:44', '2023-10-11 20:20:44'),
(22, 0, 2, 1, '2023-10-11', '22:00:00', '22:30:00', 'wednesday', 12.00, 1, '2023-10-11 20:20:44', '2023-10-11 20:20:44'),
(23, 0, 2, 1, '2023-10-11', '00:00:00', '01:00:00', 'wednesday', 20.00, 1, '2023-10-11 22:29:36', '2023-10-11 22:29:36'),
(24, 0, 2, 1, '2023-10-11', '01:00:00', '02:00:00', 'wednesday', 20.00, 1, '2023-10-11 22:29:36', '2023-10-11 22:29:36'),
(25, 0, 2, 1, '2023-10-11', '02:00:00', '03:00:00', 'wednesday', 20.00, 1, '2023-10-11 22:29:36', '2023-10-11 22:29:36'),
(26, 0, 2, 1, '2023-10-11', '03:00:00', '04:00:00', 'wednesday', 20.00, 1, '2023-10-11 22:29:36', '2023-10-11 22:29:36'),
(27, 0, 2, 1, '2023-10-11', '04:00:00', '05:00:00', 'wednesday', 20.00, 1, '2023-10-11 22:29:36', '2023-10-11 22:29:36'),
(28, 0, 2, 1, '2023-10-11', '05:00:00', '06:00:00', 'wednesday', 20.00, 1, '2023-10-11 22:29:36', '2023-10-11 22:29:36'),
(29, 0, 2, 1, '2023-10-11', '06:00:00', '07:00:00', 'wednesday', 20.00, 1, '2023-10-11 22:29:36', '2023-10-11 22:29:36'),
(30, 0, 2, 1, '2023-10-11', '07:00:00', '08:00:00', 'wednesday', 20.00, 1, '2023-10-11 22:29:36', '2023-10-11 22:29:36'),
(31, 0, 2, 1, '2023-10-11', '08:00:00', '09:00:00', 'wednesday', 20.00, 1, '2023-10-11 22:29:36', '2023-10-11 22:29:36'),
(32, 0, 2, 1, '2023-10-11', '09:00:00', '10:00:00', 'wednesday', 20.00, 1, '2023-10-11 22:29:36', '2023-10-11 22:29:36'),
(33, 0, 2, 1, '2023-10-11', '10:00:00', '11:00:00', 'wednesday', 20.00, 1, '2023-10-11 22:29:36', '2023-10-11 22:29:36'),
(34, 0, 2, 1, '2023-10-11', '11:00:00', '12:00:00', 'wednesday', 20.00, 1, '2023-10-11 22:29:36', '2023-10-11 22:29:36'),
(35, 0, 2, 1, '2023-10-11', '12:00:00', '13:00:00', 'wednesday', 20.00, 1, '2023-10-11 22:29:36', '2023-10-11 22:29:36'),
(36, 0, 2, 1, '2023-10-11', '13:00:00', '14:00:00', 'wednesday', 20.00, 1, '2023-10-11 22:29:36', '2023-10-11 22:29:36'),
(37, 0, 2, 1, '2023-10-11', '14:00:00', '15:00:00', 'wednesday', 20.00, 1, '2023-10-11 22:29:36', '2023-10-11 22:29:36'),
(38, 0, 2, 1, '2023-10-11', '15:00:00', '16:00:00', 'wednesday', 20.00, 1, '2023-10-11 22:29:36', '2023-10-11 22:29:36'),
(39, 0, 2, 1, '2023-10-11', '16:00:00', '17:00:00', 'wednesday', 20.00, 1, '2023-10-11 22:29:36', '2023-10-11 22:29:36'),
(40, 0, 2, 1, '2023-10-11', '17:00:00', '18:00:00', 'wednesday', 20.00, 1, '2023-10-11 22:29:36', '2023-10-11 22:29:36'),
(41, 0, 2, 1, '2023-10-11', '18:00:00', '19:00:00', 'wednesday', 20.00, 1, '2023-10-11 22:29:36', '2023-10-11 22:29:36'),
(42, 0, 2, 1, '2023-10-11', '19:00:00', '20:00:00', 'wednesday', 20.00, 1, '2023-10-11 22:29:36', '2023-10-11 22:29:36'),
(43, 0, 2, 1, '2023-10-11', '20:00:00', '21:00:00', 'wednesday', 20.00, 1, '2023-10-11 22:29:36', '2023-10-11 22:29:36'),
(44, 0, 2, 1, '2023-10-11', '21:00:00', '22:00:00', 'wednesday', 20.00, 1, '2023-10-11 22:29:36', '2023-10-11 22:29:36'),
(45, 0, 2, 1, '2023-10-11', '22:00:00', '23:00:00', 'wednesday', 20.00, 1, '2023-10-11 22:29:36', '2023-10-11 22:29:36'),
(46, 0, 2, 1, '2023-10-11', '23:00:00', '23:59:00', 'wednesday', 20.00, 1, '2023-10-11 22:29:36', '2023-10-11 22:29:36'),
(47, 0, 2, 1, '2023-10-12', '00:00:00', '01:00:00', 'thursday', 20.00, 1, '2023-10-11 22:29:38', '2023-10-11 22:29:38'),
(48, 0, 2, 1, '2023-10-12', '01:00:00', '02:00:00', 'thursday', 20.00, 1, '2023-10-11 22:29:38', '2023-10-11 22:29:38'),
(49, 0, 2, 1, '2023-10-12', '02:00:00', '03:00:00', 'thursday', 20.00, 1, '2023-10-11 22:29:38', '2023-10-11 22:52:23'),
(50, 0, 2, 1, '2023-10-12', '03:00:00', '04:00:00', 'thursday', 20.00, 0, '2023-10-11 22:29:38', '2023-10-11 23:35:08'),
(51, 0, 2, 1, '2023-10-12', '04:00:00', '05:00:00', 'thursday', 20.00, 0, '2023-10-11 22:29:38', '2023-10-11 23:35:08'),
(52, 0, 2, 1, '2023-10-12', '05:00:00', '06:00:00', 'thursday', 20.00, 1, '2023-10-11 22:29:38', '2023-10-11 22:29:38'),
(53, 0, 2, 1, '2023-10-12', '06:00:00', '07:00:00', 'thursday', 20.00, 1, '2023-10-11 22:29:38', '2023-10-11 22:29:38'),
(54, 0, 2, 1, '2023-10-12', '07:00:00', '08:00:00', 'thursday', 20.00, 1, '2023-10-11 22:29:38', '2023-10-11 22:29:38'),
(55, 0, 2, 1, '2023-10-12', '08:00:00', '09:00:00', 'thursday', 20.00, 1, '2023-10-11 22:29:38', '2023-10-11 22:29:38'),
(56, 0, 2, 1, '2023-10-12', '09:00:00', '10:00:00', 'thursday', 20.00, 1, '2023-10-11 22:29:38', '2023-10-11 22:29:38'),
(57, 0, 2, 1, '2023-10-12', '10:00:00', '11:00:00', 'thursday', 20.00, 1, '2023-10-11 22:29:38', '2023-10-11 22:29:38'),
(58, 0, 2, 1, '2023-10-12', '11:00:00', '12:00:00', 'thursday', 20.00, 2, '2023-10-11 22:29:38', '2023-10-11 22:29:38'),
(59, 0, 2, 1, '2023-10-12', '12:00:00', '13:00:00', 'thursday', 20.00, 1, '2023-10-11 22:29:38', '2023-10-12 16:04:03'),
(60, 0, 2, 1, '2023-10-12', '13:00:00', '14:00:00', 'thursday', 20.00, 2, '2023-10-11 22:29:38', '2023-10-11 22:29:38'),
(61, 0, 2, 1, '2023-10-12', '14:00:00', '15:00:00', 'thursday', 20.00, 1, '2023-10-11 22:29:38', '2023-10-11 22:29:38'),
(62, 0, 2, 1, '2023-10-12', '15:00:00', '16:00:00', 'thursday', 20.00, 1, '2023-10-11 22:29:38', '2023-10-11 22:29:38'),
(63, 0, 2, 1, '2023-10-12', '16:00:00', '17:00:00', 'thursday', 20.00, 1, '2023-10-11 22:29:38', '2023-10-12 18:34:46'),
(64, 0, 2, 1, '2023-10-12', '17:00:00', '18:00:00', 'thursday', 20.00, 1, '2023-10-11 22:29:38', '2023-10-12 16:42:49'),
(65, 0, 2, 1, '2023-10-12', '18:00:00', '19:00:00', 'thursday', 20.00, 1, '2023-10-11 22:29:38', '2023-10-12 18:33:45'),
(66, 0, 2, 1, '2023-10-12', '19:00:00', '20:00:00', 'thursday', 20.00, 1, '2023-10-11 22:29:38', '2023-10-12 18:34:46'),
(67, 0, 2, 1, '2023-10-12', '20:00:00', '21:00:00', 'thursday', 20.00, 1, '2023-10-11 22:29:38', '2023-10-12 18:34:46'),
(68, 0, 2, 1, '2023-10-12', '21:00:00', '22:00:00', 'thursday', 20.00, 1, '2023-10-11 22:29:38', '2023-10-12 16:34:47'),
(69, 0, 2, 1, '2023-10-12', '22:00:00', '23:00:00', 'thursday', 20.00, 1, '2023-10-11 22:29:38', '2023-10-12 16:34:47'),
(70, 0, 2, 1, '2023-10-12', '23:00:00', '23:59:00', 'thursday', 20.00, 1, '2023-10-11 22:29:38', '2023-10-12 18:34:14'),
(71, 0, 4, 1, '2023-10-11', '09:00:00', '10:30:00', 'wednesday', 120.00, 1, '2023-10-11 23:20:00', '2023-10-11 23:20:00'),
(72, 0, 4, 1, '2023-10-11', '10:30:00', '12:00:00', 'wednesday', 120.00, 1, '2023-10-11 23:20:00', '2023-10-11 23:20:00'),
(73, 0, 4, 1, '2023-10-11', '12:00:00', '13:30:00', 'wednesday', 120.00, 1, '2023-10-11 23:20:00', '2023-10-11 23:20:00'),
(74, 0, 4, 1, '2023-10-11', '13:30:00', '15:00:00', 'wednesday', 120.00, 1, '2023-10-11 23:20:00', '2023-10-11 23:20:00'),
(75, 0, 4, 1, '2023-10-11', '15:00:00', '16:00:00', 'wednesday', 120.00, 1, '2023-10-11 23:20:00', '2023-10-11 23:20:00'),
(76, 0, 4, 1, '2023-10-26', '09:00:00', '10:30:00', 'thursday', 120.00, 1, '2023-10-11 23:20:02', '2023-10-11 23:20:02'),
(77, 0, 4, 1, '2023-10-26', '10:30:00', '12:00:00', 'thursday', 120.00, 1, '2023-10-11 23:20:02', '2023-10-11 23:20:02'),
(78, 0, 4, 1, '2023-10-26', '12:00:00', '13:30:00', 'thursday', 120.00, 1, '2023-10-11 23:20:02', '2023-10-11 23:20:02'),
(79, 0, 4, 1, '2023-10-26', '13:30:00', '15:00:00', 'thursday', 120.00, 1, '2023-10-11 23:20:02', '2023-10-11 23:20:02'),
(80, 0, 4, 1, '2023-10-26', '15:00:00', '16:00:00', 'thursday', 120.00, 1, '2023-10-11 23:20:02', '2023-10-11 23:20:02'),
(81, 0, 4, 1, '2023-10-19', '09:00:00', '10:30:00', 'thursday', 120.00, 1, '2023-10-11 23:54:44', '2023-10-11 23:54:44'),
(82, 0, 4, 1, '2023-10-19', '10:30:00', '12:00:00', 'thursday', 120.00, 1, '2023-10-11 23:54:44', '2023-10-11 23:54:44'),
(83, 0, 4, 1, '2023-10-19', '12:00:00', '13:30:00', 'thursday', 120.00, 1, '2023-10-11 23:54:44', '2023-10-11 23:54:44'),
(84, 0, 4, 1, '2023-10-19', '13:30:00', '15:00:00', 'thursday', 120.00, 1, '2023-10-11 23:54:44', '2023-10-11 23:54:44'),
(85, 0, 4, 1, '2023-10-19', '15:00:00', '16:00:00', 'thursday', 120.00, 1, '2023-10-11 23:54:44', '2023-10-11 23:54:44'),
(86, 0, 4, 1, '2023-10-12', '09:00:00', '10:30:00', 'thursday', 120.00, 1, '2023-10-12 14:13:06', '2023-10-12 14:13:06'),
(87, 0, 4, 1, '2023-10-12', '10:30:00', '12:00:00', 'thursday', 120.00, 1, '2023-10-12 14:13:06', '2023-10-12 14:13:06'),
(88, 0, 4, 1, '2023-10-12', '12:00:00', '13:30:00', 'thursday', 120.00, 1, '2023-10-12 14:13:06', '2023-10-12 14:13:06'),
(89, 0, 4, 1, '2023-10-12', '13:30:00', '15:00:00', 'thursday', 120.00, 1, '2023-10-12 14:13:06', '2023-10-12 14:13:06'),
(90, 0, 4, 1, '2023-10-12', '15:00:00', '16:00:00', 'thursday', 120.00, 1, '2023-10-12 14:13:06', '2023-10-12 14:13:06'),
(91, 0, 4, 1, '2023-10-27', '09:00:00', '10:30:00', 'friday', 120.00, 1, '2023-10-12 14:13:58', '2023-10-12 14:13:58'),
(92, 0, 4, 1, '2023-10-27', '10:30:00', '12:00:00', 'friday', 120.00, 1, '2023-10-12 14:13:58', '2023-10-12 14:13:58'),
(93, 0, 4, 1, '2023-10-27', '12:00:00', '13:30:00', 'friday', 120.00, 1, '2023-10-12 14:13:58', '2023-10-12 14:13:58'),
(94, 0, 4, 1, '2023-10-27', '13:30:00', '15:00:00', 'friday', 120.00, 1, '2023-10-12 14:13:58', '2023-10-12 14:13:58'),
(95, 0, 4, 1, '2023-10-27', '15:00:00', '16:00:00', 'friday', 120.00, 1, '2023-10-12 14:13:58', '2023-10-12 14:13:58'),
(96, 0, 2, 1, '2023-10-27', '02:00:00', '03:00:00', 'friday', 100.00, 1, '2023-10-12 15:18:35', '2023-10-12 15:18:35'),
(97, 0, 2, 1, '2023-10-27', '03:00:00', '04:00:00', 'friday', 100.00, 1, '2023-10-12 15:18:35', '2023-10-12 15:18:35'),
(98, 0, 2, 1, '2023-10-27', '04:00:00', '05:00:00', 'friday', 100.00, 1, '2023-10-12 15:18:35', '2023-10-12 15:18:35'),
(99, 0, 2, 1, '2023-10-27', '05:00:00', '06:00:00', 'friday', 100.00, 1, '2023-10-12 15:18:35', '2023-10-12 15:18:35'),
(100, 0, 2, 1, '2023-10-27', '06:00:00', '07:00:00', 'friday', 100.00, 1, '2023-10-12 15:18:35', '2023-10-12 15:18:35'),
(101, 0, 2, 1, '2023-10-27', '07:00:00', '08:00:00', 'friday', 100.00, 1, '2023-10-12 15:18:35', '2023-10-12 15:18:35'),
(102, 0, 2, 1, '2023-10-27', '08:00:00', '09:00:00', 'friday', 100.00, 1, '2023-10-12 15:18:35', '2023-10-12 15:18:35'),
(103, 0, 2, 1, '2023-10-27', '09:00:00', '10:00:00', 'friday', 100.00, 1, '2023-10-12 15:18:35', '2023-10-12 15:18:35'),
(104, 0, 2, 1, '2023-10-27', '10:00:00', '11:00:00', 'friday', 100.00, 1, '2023-10-12 15:18:35', '2023-10-12 15:18:35'),
(105, 0, 2, 1, '2023-10-27', '11:00:00', '12:00:00', 'friday', 100.00, 1, '2023-10-12 15:18:35', '2023-10-12 15:18:35'),
(106, 0, 2, 1, '2023-10-27', '12:00:00', '13:00:00', 'friday', 100.00, 1, '2023-10-12 15:18:35', '2023-10-12 15:18:35'),
(107, 0, 2, 1, '2023-10-27', '13:00:00', '14:00:00', 'friday', 100.00, 1, '2023-10-12 15:18:35', '2023-10-12 15:18:35'),
(108, 0, 2, 1, '2023-10-27', '14:00:00', '15:00:00', 'friday', 100.00, 1, '2023-10-12 15:18:35', '2023-10-12 15:18:35'),
(109, 0, 2, 1, '2023-10-27', '15:00:00', '16:00:00', 'friday', 100.00, 1, '2023-10-12 15:18:35', '2023-10-12 15:18:35'),
(110, 0, 2, 1, '2023-10-27', '16:00:00', '17:00:00', 'friday', 100.00, 1, '2023-10-12 15:18:35', '2023-10-12 15:18:35'),
(111, 0, 2, 1, '2023-10-27', '17:00:00', '18:00:00', 'friday', 100.00, 1, '2023-10-12 15:18:35', '2023-10-12 15:18:35'),
(112, 0, 2, 1, '2023-10-27', '18:00:00', '19:00:00', 'friday', 100.00, 1, '2023-10-12 15:18:35', '2023-10-12 15:18:35'),
(113, 0, 2, 1, '2023-10-27', '19:00:00', '20:00:00', 'friday', 100.00, 1, '2023-10-12 15:18:35', '2023-10-12 15:18:35'),
(114, 0, 2, 1, '2023-10-27', '20:00:00', '21:00:00', 'friday', 100.00, 1, '2023-10-12 15:18:35', '2023-10-12 15:18:35'),
(115, 0, 2, 1, '2023-10-27', '21:00:00', '22:00:00', 'friday', 100.00, 1, '2023-10-12 15:18:35', '2023-10-12 15:18:35'),
(116, 0, 2, 1, '2023-10-27', '22:00:00', '23:00:00', 'friday', 100.00, 1, '2023-10-12 15:18:35', '2023-10-12 15:18:35'),
(117, 0, 2, 1, '2023-10-27', '23:00:00', '23:30:00', 'friday', 100.00, 1, '2023-10-12 15:18:35', '2023-10-12 18:34:46'),
(118, 0, 2, 1, '2023-10-25', '01:00:00', '02:00:00', 'wednesday', 100.00, 1, '2023-10-12 15:32:28', '2023-10-12 21:51:59'),
(119, 0, 2, 1, '2023-10-25', '02:00:00', '03:00:00', 'wednesday', 100.00, 1, '2023-10-12 15:32:28', '2023-10-12 21:51:59'),
(120, 0, 2, 1, '2023-10-25', '03:00:00', '04:00:00', 'wednesday', 100.00, 2, '2023-10-12 15:32:28', '2023-10-12 21:46:55'),
(121, 0, 2, 1, '2023-10-25', '04:00:00', '05:00:00', 'wednesday', 100.00, 1, '2023-10-12 15:32:28', '2023-10-12 15:32:28'),
(122, 0, 2, 1, '2023-10-25', '05:00:00', '06:00:00', 'wednesday', 100.00, 1, '2023-10-12 15:32:28', '2023-10-12 15:32:28'),
(123, 0, 2, 1, '2023-10-25', '06:00:00', '07:00:00', 'wednesday', 100.00, 1, '2023-10-12 15:32:28', '2023-10-12 18:41:43'),
(124, 0, 2, 1, '2023-10-25', '07:00:00', '08:00:00', 'wednesday', 100.00, 1, '2023-10-12 15:32:28', '2023-10-12 18:41:43'),
(125, 0, 2, 1, '2023-10-25', '08:00:00', '09:00:00', 'wednesday', 100.00, 2, '2023-10-12 15:32:28', '2023-10-12 21:52:59'),
(126, 0, 2, 1, '2023-10-25', '09:00:00', '10:00:00', 'wednesday', 100.00, 1, '2023-10-12 15:32:28', '2023-10-12 15:32:28'),
(127, 0, 2, 1, '2023-10-25', '10:00:00', '11:00:00', 'wednesday', 100.00, 1, '2023-10-12 15:32:28', '2023-10-12 15:32:28'),
(128, 0, 2, 1, '2023-10-25', '11:00:00', '12:00:00', 'wednesday', 100.00, 1, '2023-10-12 15:32:28', '2023-10-12 15:32:28'),
(129, 0, 2, 1, '2023-10-25', '12:00:00', '13:00:00', 'wednesday', 100.00, 1, '2023-10-12 15:32:28', '2023-10-12 18:41:12'),
(130, 0, 2, 1, '2023-10-25', '13:00:00', '14:00:00', 'wednesday', 100.00, 1, '2023-10-12 15:32:28', '2023-10-12 18:41:12'),
(131, 0, 2, 1, '2023-10-25', '14:00:00', '15:00:00', 'wednesday', 100.00, 2, '2023-10-12 15:32:28', '2023-10-12 21:52:59'),
(132, 0, 2, 1, '2023-10-25', '15:00:00', '16:00:00', 'wednesday', 100.00, 1, '2023-10-12 15:32:28', '2023-10-12 15:32:28'),
(133, 0, 2, 1, '2023-10-25', '16:00:00', '17:00:00', 'wednesday', 100.00, 1, '2023-10-12 15:32:28', '2023-10-12 15:32:28'),
(134, 0, 2, 1, '2023-10-25', '17:00:00', '18:00:00', 'wednesday', 100.00, 1, '2023-10-12 15:32:28', '2023-10-12 21:55:43'),
(135, 0, 2, 1, '2023-10-25', '18:00:00', '19:00:00', 'wednesday', 100.00, 1, '2023-10-12 15:32:28', '2023-10-12 21:55:43'),
(136, 0, 2, 1, '2023-10-25', '19:00:00', '20:00:00', 'wednesday', 100.00, 1, '2023-10-12 15:32:28', '2023-10-12 15:32:28'),
(137, 0, 2, 1, '2023-10-25', '20:00:00', '21:00:00', 'wednesday', 100.00, 2, '2023-10-12 15:32:28', '2023-10-12 21:52:59'),
(138, 0, 2, 1, '2023-10-25', '21:00:00', '22:00:00', 'wednesday', 100.00, 1, '2023-10-12 15:32:28', '2023-10-12 15:32:28'),
(139, 0, 2, 1, '2023-10-25', '22:00:00', '22:30:00', 'wednesday', 100.00, 1, '2023-10-12 15:32:28', '2023-10-12 15:32:28'),
(140, 0, 4, 3, '2023-10-12', '09:00:00', '10:30:00', 'thursday', 130.00, 1, '2023-10-12 16:47:10', '2023-10-12 16:47:10'),
(141, 0, 4, 3, '2023-10-12', '10:30:00', '12:00:00', 'thursday', 130.00, 1, '2023-10-12 16:47:10', '2023-10-12 16:47:10'),
(142, 0, 4, 3, '2023-10-12', '12:00:00', '13:30:00', 'thursday', 130.00, 1, '2023-10-12 16:47:10', '2023-10-12 16:47:10'),
(143, 0, 4, 3, '2023-10-12', '13:30:00', '15:00:00', 'thursday', 130.00, 1, '2023-10-12 16:47:10', '2023-10-12 16:47:10'),
(144, 0, 4, 3, '2023-10-12', '15:00:00', '16:00:00', 'thursday', 130.00, 1, '2023-10-12 16:47:10', '2023-10-12 16:47:10'),
(145, 0, 4, 3, '2023-10-27', '09:00:00', '10:30:00', 'friday', 130.00, 1, '2023-10-12 16:47:12', '2023-10-12 16:47:12'),
(146, 0, 4, 3, '2023-10-27', '10:30:00', '12:00:00', 'friday', 130.00, 1, '2023-10-12 16:47:12', '2023-10-12 16:47:12'),
(147, 0, 4, 3, '2023-10-27', '12:00:00', '13:30:00', 'friday', 130.00, 1, '2023-10-12 16:47:12', '2023-10-12 16:47:12'),
(148, 0, 4, 3, '2023-10-27', '13:30:00', '15:00:00', 'friday', 130.00, 1, '2023-10-12 16:47:12', '2023-10-12 16:47:12'),
(149, 0, 4, 3, '2023-10-27', '15:00:00', '16:00:00', 'friday', 130.00, 1, '2023-10-12 16:47:12', '2023-10-12 16:47:12'),
(150, 0, 4, 3, '2023-10-26', '09:00:00', '10:30:00', 'thursday', 130.00, 1, '2023-10-12 16:47:15', '2023-10-12 16:47:15'),
(151, 0, 4, 3, '2023-10-26', '10:30:00', '12:00:00', 'thursday', 130.00, 1, '2023-10-12 16:47:15', '2023-10-12 16:47:15'),
(152, 0, 4, 3, '2023-10-26', '12:00:00', '13:30:00', 'thursday', 130.00, 1, '2023-10-12 16:47:15', '2023-10-12 16:47:15'),
(153, 0, 4, 3, '2023-10-26', '13:30:00', '15:00:00', 'thursday', 130.00, 1, '2023-10-12 16:47:15', '2023-10-12 16:47:15'),
(154, 0, 4, 3, '2023-10-26', '15:00:00', '16:00:00', 'thursday', 130.00, 1, '2023-10-12 16:47:15', '2023-10-12 16:47:15'),
(155, 0, 4, 3, '2023-10-20', '09:00:00', '10:30:00', 'friday', 130.00, 1, '2023-10-12 16:47:18', '2023-10-12 16:47:18'),
(156, 0, 4, 3, '2023-10-20', '10:30:00', '12:00:00', 'friday', 130.00, 1, '2023-10-12 16:47:18', '2023-10-12 16:47:18'),
(157, 0, 4, 3, '2023-10-20', '12:00:00', '13:30:00', 'friday', 130.00, 1, '2023-10-12 16:47:18', '2023-10-12 16:47:18'),
(158, 0, 4, 3, '2023-10-20', '13:30:00', '15:00:00', 'friday', 130.00, 1, '2023-10-12 16:47:18', '2023-10-12 16:47:18'),
(159, 0, 4, 3, '2023-10-20', '15:00:00', '16:00:00', 'friday', 130.00, 1, '2023-10-12 16:47:18', '2023-10-12 16:47:18'),
(160, 0, 4, 3, '2023-10-18', '09:00:00', '10:30:00', 'wednesday', 130.00, 1, '2023-10-12 16:47:20', '2023-10-12 16:47:20'),
(161, 0, 4, 3, '2023-10-18', '10:30:00', '12:00:00', 'wednesday', 130.00, 1, '2023-10-12 16:47:20', '2023-10-12 16:47:20'),
(162, 0, 4, 3, '2023-10-18', '12:00:00', '13:30:00', 'wednesday', 130.00, 1, '2023-10-12 16:47:20', '2023-10-12 16:47:20'),
(163, 0, 4, 3, '2023-10-18', '13:30:00', '15:00:00', 'wednesday', 130.00, 1, '2023-10-12 16:47:20', '2023-10-12 16:47:20'),
(164, 0, 4, 3, '2023-10-18', '15:00:00', '16:00:00', 'wednesday', 130.00, 1, '2023-10-12 16:47:20', '2023-10-12 16:47:20'),
(165, 0, 4, 3, '2023-10-17', '09:00:00', '10:30:00', 'tuesday', 130.00, 1, '2023-10-12 16:47:22', '2023-10-12 16:47:22'),
(166, 0, 4, 3, '2023-10-17', '10:30:00', '12:00:00', 'tuesday', 130.00, 1, '2023-10-12 16:47:22', '2023-10-12 16:47:22'),
(167, 0, 4, 3, '2023-10-17', '12:00:00', '13:30:00', 'tuesday', 130.00, 1, '2023-10-12 16:47:22', '2023-10-12 16:47:22'),
(168, 0, 4, 3, '2023-10-17', '13:30:00', '15:00:00', 'tuesday', 130.00, 1, '2023-10-12 16:47:22', '2023-10-12 16:47:22'),
(169, 0, 4, 3, '2023-10-17', '15:00:00', '16:00:00', 'tuesday', 130.00, 1, '2023-10-12 16:47:22', '2023-10-12 16:47:22'),
(170, 0, 4, 3, '2023-10-16', '09:00:00', '10:30:00', 'monday', 130.00, 1, '2023-10-12 16:47:24', '2023-10-12 16:47:24'),
(171, 0, 4, 3, '2023-10-16', '10:30:00', '12:00:00', 'monday', 130.00, 1, '2023-10-12 16:47:24', '2023-10-12 16:47:24'),
(172, 0, 4, 3, '2023-10-16', '12:00:00', '13:30:00', 'monday', 130.00, 1, '2023-10-12 16:47:24', '2023-10-12 16:47:24'),
(173, 0, 4, 3, '2023-10-16', '13:30:00', '15:00:00', 'monday', 130.00, 1, '2023-10-12 16:47:24', '2023-10-12 16:47:24'),
(174, 0, 4, 3, '2023-10-16', '15:00:00', '16:00:00', 'monday', 130.00, 1, '2023-10-12 16:47:24', '2023-10-12 16:47:24'),
(175, 0, 4, 3, '2023-10-29', '09:00:00', '10:30:00', 'sunday', 130.00, 1, '2023-10-12 16:47:26', '2023-10-12 16:47:26'),
(176, 0, 4, 3, '2023-10-29', '10:30:00', '12:00:00', 'sunday', 130.00, 1, '2023-10-12 16:47:26', '2023-10-12 16:47:26'),
(177, 0, 4, 3, '2023-10-29', '12:00:00', '13:30:00', 'sunday', 130.00, 1, '2023-10-12 16:47:26', '2023-10-12 16:47:26'),
(178, 0, 4, 3, '2023-10-29', '13:30:00', '15:00:00', 'sunday', 130.00, 1, '2023-10-12 16:47:26', '2023-10-12 16:47:26'),
(179, 0, 4, 3, '2023-10-29', '15:00:00', '16:00:00', 'sunday', 130.00, 1, '2023-10-12 16:47:26', '2023-10-12 16:47:26'),
(180, 0, 4, 3, '2023-11-25', '09:00:00', '10:30:00', 'saturday', 130.00, 1, '2023-10-12 16:47:30', '2023-10-12 16:47:30'),
(181, 0, 4, 3, '2023-11-25', '10:30:00', '12:00:00', 'saturday', 130.00, 1, '2023-10-12 16:47:30', '2023-10-12 16:47:30'),
(182, 0, 4, 3, '2023-11-25', '12:00:00', '13:30:00', 'saturday', 130.00, 1, '2023-10-12 16:47:30', '2023-10-12 16:47:30'),
(183, 0, 4, 3, '2023-11-25', '13:30:00', '15:00:00', 'saturday', 130.00, 1, '2023-10-12 16:47:30', '2023-10-12 16:47:30'),
(184, 0, 4, 3, '2023-11-25', '15:00:00', '16:00:00', 'saturday', 130.00, 1, '2023-10-12 16:47:30', '2023-10-12 16:47:30'),
(185, 0, 2, 2, '2023-10-12', '01:00:00', '02:00:00', 'thursday', 15.00, 1, '2023-10-12 16:47:39', '2023-10-12 16:47:39'),
(186, 0, 2, 2, '2023-10-12', '02:00:00', '03:00:00', 'thursday', 15.00, 1, '2023-10-12 16:47:39', '2023-10-12 16:47:39'),
(187, 0, 2, 2, '2023-10-12', '03:00:00', '04:00:00', 'thursday', 15.00, 1, '2023-10-12 16:47:39', '2023-10-12 16:47:39'),
(188, 0, 2, 2, '2023-10-12', '04:00:00', '05:00:00', 'thursday', 15.00, 1, '2023-10-12 16:47:39', '2023-10-12 16:47:39'),
(189, 0, 2, 2, '2023-10-12', '05:00:00', '06:00:00', 'thursday', 15.00, 1, '2023-10-12 16:47:39', '2023-10-12 16:47:39'),
(190, 0, 2, 2, '2023-10-12', '06:00:00', '07:00:00', 'thursday', 15.00, 1, '2023-10-12 16:47:39', '2023-10-12 16:47:39'),
(191, 0, 2, 2, '2023-10-12', '07:00:00', '08:00:00', 'thursday', 15.00, 1, '2023-10-12 16:47:40', '2023-10-12 16:47:40'),
(192, 0, 2, 2, '2023-10-12', '08:00:00', '09:00:00', 'thursday', 15.00, 1, '2023-10-12 16:47:40', '2023-10-12 16:47:40'),
(193, 0, 2, 2, '2023-10-12', '09:00:00', '10:00:00', 'thursday', 15.00, 1, '2023-10-12 16:47:40', '2023-10-12 16:47:40'),
(194, 0, 2, 2, '2023-10-12', '10:00:00', '11:00:00', 'thursday', 15.00, 1, '2023-10-12 16:47:40', '2023-10-12 16:47:40'),
(195, 0, 2, 2, '2023-10-12', '11:00:00', '12:00:00', 'thursday', 15.00, 1, '2023-10-12 16:47:40', '2023-10-12 16:47:40'),
(196, 0, 2, 2, '2023-10-12', '12:00:00', '13:00:00', 'thursday', 15.00, 1, '2023-10-12 16:47:40', '2023-10-12 16:47:40'),
(197, 0, 2, 2, '2023-10-12', '13:00:00', '14:00:00', 'thursday', 15.00, 1, '2023-10-12 16:47:40', '2023-10-12 16:47:40'),
(198, 0, 2, 2, '2023-10-12', '14:00:00', '15:00:00', 'thursday', 15.00, 1, '2023-10-12 16:47:40', '2023-10-12 16:47:40'),
(199, 0, 2, 2, '2023-10-12', '15:00:00', '16:00:00', 'thursday', 15.00, 1, '2023-10-12 16:47:40', '2023-10-12 16:47:40'),
(200, 0, 2, 2, '2023-10-12', '16:00:00', '17:00:00', 'thursday', 15.00, 1, '2023-10-12 16:47:40', '2023-10-12 16:47:40'),
(201, 0, 2, 2, '2023-10-12', '17:00:00', '18:00:00', 'thursday', 15.00, 1, '2023-10-12 16:47:40', '2023-10-12 16:47:40'),
(202, 0, 2, 2, '2023-10-12', '18:00:00', '19:00:00', 'thursday', 15.00, 1, '2023-10-12 16:47:40', '2023-10-12 16:47:40'),
(203, 0, 2, 2, '2023-10-12', '19:00:00', '20:00:00', 'thursday', 15.00, 1, '2023-10-12 16:47:40', '2023-10-12 16:47:40'),
(204, 0, 2, 2, '2023-10-12', '20:00:00', '21:00:00', 'thursday', 15.00, 1, '2023-10-12 16:47:40', '2023-10-12 16:47:40'),
(205, 0, 2, 2, '2023-10-12', '21:00:00', '22:00:00', 'thursday', 15.00, 1, '2023-10-12 16:47:40', '2023-10-12 16:47:40'),
(206, 0, 2, 2, '2023-10-12', '22:00:00', '23:00:00', 'thursday', 15.00, 1, '2023-10-12 16:47:40', '2023-10-12 16:47:40'),
(207, 0, 2, 2, '2023-10-20', '02:00:00', '03:00:00', 'friday', 15.00, 1, '2023-10-12 16:47:43', '2023-10-12 16:47:43'),
(208, 0, 2, 2, '2023-10-20', '03:00:00', '04:00:00', 'friday', 15.00, 1, '2023-10-12 16:47:43', '2023-10-12 16:47:43'),
(209, 0, 2, 2, '2023-10-20', '04:00:00', '05:00:00', 'friday', 15.00, 1, '2023-10-12 16:47:43', '2023-10-12 16:47:43'),
(210, 0, 2, 2, '2023-10-20', '05:00:00', '06:00:00', 'friday', 15.00, 1, '2023-10-12 16:47:43', '2023-10-12 16:47:43'),
(211, 0, 2, 2, '2023-10-20', '06:00:00', '07:00:00', 'friday', 15.00, 1, '2023-10-12 16:47:43', '2023-10-12 16:47:43'),
(212, 0, 2, 2, '2023-10-20', '07:00:00', '08:00:00', 'friday', 15.00, 1, '2023-10-12 16:47:43', '2023-10-12 16:47:43'),
(213, 0, 2, 2, '2023-10-20', '08:00:00', '09:00:00', 'friday', 15.00, 1, '2023-10-12 16:47:43', '2023-10-12 16:47:43'),
(214, 0, 2, 2, '2023-10-20', '09:00:00', '10:00:00', 'friday', 15.00, 1, '2023-10-12 16:47:43', '2023-10-12 16:47:43'),
(215, 0, 2, 2, '2023-10-20', '10:00:00', '11:00:00', 'friday', 15.00, 1, '2023-10-12 16:47:43', '2023-10-12 16:47:43'),
(216, 0, 2, 2, '2023-10-20', '11:00:00', '12:00:00', 'friday', 15.00, 1, '2023-10-12 16:47:43', '2023-10-12 16:47:43'),
(217, 0, 2, 2, '2023-10-20', '12:00:00', '13:00:00', 'friday', 15.00, 1, '2023-10-12 16:47:43', '2023-10-12 16:47:43'),
(218, 0, 2, 2, '2023-10-20', '13:00:00', '14:00:00', 'friday', 15.00, 1, '2023-10-12 16:47:43', '2023-10-12 16:47:43'),
(219, 0, 2, 2, '2023-10-20', '14:00:00', '15:00:00', 'friday', 15.00, 1, '2023-10-12 16:47:43', '2023-10-12 16:47:43'),
(220, 0, 2, 2, '2023-10-20', '15:00:00', '16:00:00', 'friday', 15.00, 1, '2023-10-12 16:47:43', '2023-10-12 16:47:43'),
(221, 0, 2, 2, '2023-10-20', '16:00:00', '17:00:00', 'friday', 15.00, 1, '2023-10-12 16:47:43', '2023-10-12 16:47:43'),
(222, 0, 2, 2, '2023-10-20', '17:00:00', '18:00:00', 'friday', 15.00, 1, '2023-10-12 16:47:43', '2023-10-12 16:47:43'),
(223, 0, 2, 2, '2023-10-20', '18:00:00', '19:00:00', 'friday', 15.00, 1, '2023-10-12 16:47:43', '2023-10-12 16:47:43'),
(224, 0, 2, 2, '2023-10-20', '19:00:00', '20:00:00', 'friday', 15.00, 1, '2023-10-12 16:47:43', '2023-10-12 16:47:43'),
(225, 0, 2, 2, '2023-10-20', '20:00:00', '21:00:00', 'friday', 15.00, 1, '2023-10-12 16:47:43', '2023-10-12 16:47:43'),
(226, 0, 2, 2, '2023-10-20', '21:00:00', '22:00:00', 'friday', 15.00, 1, '2023-10-12 16:47:43', '2023-10-12 16:47:43'),
(227, 0, 2, 2, '2023-10-20', '22:00:00', '23:00:00', 'friday', 15.00, 1, '2023-10-12 16:47:43', '2023-10-12 16:47:43'),
(228, 0, 2, 2, '2023-10-20', '23:00:00', '23:30:00', 'friday', 15.00, 1, '2023-10-12 16:47:43', '2023-10-12 16:47:43'),
(229, 0, 4, 2, '2023-10-12', '09:00:00', '10:30:00', 'thursday', 150.00, 1, '2023-10-12 16:48:46', '2023-10-12 16:48:46'),
(230, 0, 4, 2, '2023-10-12', '10:30:00', '12:00:00', 'thursday', 150.00, 1, '2023-10-12 16:48:46', '2023-10-12 16:48:46'),
(231, 0, 4, 2, '2023-10-12', '12:00:00', '13:30:00', 'thursday', 150.00, 1, '2023-10-12 16:48:46', '2023-10-12 16:48:46'),
(232, 0, 4, 2, '2023-10-12', '13:30:00', '15:00:00', 'thursday', 150.00, 1, '2023-10-12 16:48:46', '2023-10-12 16:48:46'),
(233, 0, 4, 2, '2023-10-12', '15:00:00', '16:00:00', 'thursday', 150.00, 1, '2023-10-12 16:48:46', '2023-10-12 16:48:46'),
(234, 0, 4, 2, '2023-10-27', '09:00:00', '10:30:00', 'friday', 150.00, 1, '2023-10-12 16:48:48', '2023-10-12 16:48:48'),
(235, 0, 4, 2, '2023-10-27', '10:30:00', '12:00:00', 'friday', 150.00, 1, '2023-10-12 16:48:48', '2023-10-12 16:48:48'),
(236, 0, 4, 2, '2023-10-27', '12:00:00', '13:30:00', 'friday', 150.00, 1, '2023-10-12 16:48:48', '2023-10-12 16:48:48'),
(237, 0, 4, 2, '2023-10-27', '13:30:00', '15:00:00', 'friday', 150.00, 1, '2023-10-12 16:48:48', '2023-10-12 16:48:48'),
(238, 0, 4, 2, '2023-10-27', '15:00:00', '16:00:00', 'friday', 150.00, 1, '2023-10-12 16:48:48', '2023-10-12 16:48:48'),
(239, 0, 4, 2, '2023-10-29', '09:00:00', '10:30:00', 'sunday', 150.00, 1, '2023-10-12 16:48:50', '2023-10-12 16:48:50'),
(240, 0, 4, 2, '2023-10-29', '10:30:00', '12:00:00', 'sunday', 150.00, 1, '2023-10-12 16:48:50', '2023-10-12 16:48:50'),
(241, 0, 4, 2, '2023-10-29', '12:00:00', '13:30:00', 'sunday', 150.00, 1, '2023-10-12 16:48:50', '2023-10-12 16:48:50'),
(242, 0, 4, 2, '2023-10-29', '13:30:00', '15:00:00', 'sunday', 150.00, 1, '2023-10-12 16:48:50', '2023-10-12 16:48:50'),
(243, 0, 4, 2, '2023-10-29', '15:00:00', '16:00:00', 'sunday', 150.00, 1, '2023-10-12 16:48:50', '2023-10-12 16:48:50'),
(244, 0, 4, 2, '2023-10-31', '09:00:00', '10:30:00', 'tuesday', 150.00, 1, '2023-10-12 16:48:51', '2023-10-12 16:48:51'),
(245, 0, 4, 2, '2023-10-31', '10:30:00', '12:00:00', 'tuesday', 150.00, 1, '2023-10-12 16:48:51', '2023-10-12 16:48:51'),
(246, 0, 4, 2, '2023-10-31', '12:00:00', '13:30:00', 'tuesday', 150.00, 1, '2023-10-12 16:48:51', '2023-10-12 16:48:51'),
(247, 0, 4, 2, '2023-10-31', '13:30:00', '15:00:00', 'tuesday', 150.00, 1, '2023-10-12 16:48:51', '2023-10-12 16:48:51'),
(248, 0, 4, 2, '2023-10-31', '15:00:00', '16:00:00', 'tuesday', 150.00, 1, '2023-10-12 16:48:51', '2023-10-12 16:48:51'),
(249, 0, 4, 2, '2023-10-28', '09:00:00', '10:30:00', 'saturday', 150.00, 1, '2023-10-12 16:49:14', '2023-10-12 16:49:14'),
(250, 0, 4, 2, '2023-10-28', '10:30:00', '12:00:00', 'saturday', 150.00, 1, '2023-10-12 16:49:14', '2023-10-12 16:49:14'),
(251, 0, 4, 2, '2023-10-28', '12:00:00', '13:30:00', 'saturday', 150.00, 1, '2023-10-12 16:49:14', '2023-10-12 16:49:14'),
(252, 0, 4, 2, '2023-10-28', '13:30:00', '15:00:00', 'saturday', 150.00, 1, '2023-10-12 16:49:14', '2023-10-12 16:49:14'),
(253, 0, 4, 2, '2023-10-28', '15:00:00', '16:00:00', 'saturday', 150.00, 1, '2023-10-12 16:49:14', '2023-10-12 16:49:14'),
(254, 0, 4, 1, '2023-10-20', '09:00:00', '10:30:00', 'friday', 120.00, 1, '2023-10-12 18:10:17', '2023-10-12 18:10:17'),
(255, 0, 4, 1, '2023-10-20', '10:30:00', '12:00:00', 'friday', 120.00, 1, '2023-10-12 18:10:17', '2023-10-12 18:10:17'),
(256, 0, 4, 1, '2023-10-20', '12:00:00', '13:30:00', 'friday', 120.00, 1, '2023-10-12 18:10:17', '2023-10-12 18:10:17'),
(257, 0, 4, 1, '2023-10-20', '13:30:00', '15:00:00', 'friday', 120.00, 1, '2023-10-12 18:10:17', '2023-10-12 18:10:17'),
(258, 0, 4, 1, '2023-10-20', '15:00:00', '16:00:00', 'friday', 120.00, 1, '2023-10-12 18:10:17', '2023-10-12 18:10:17'),
(259, 0, 4, 2, '2023-10-20', '09:00:00', '10:30:00', 'friday', 150.00, 1, '2023-10-12 18:55:28', '2023-10-12 18:55:28'),
(260, 0, 4, 2, '2023-10-20', '10:30:00', '12:00:00', 'friday', 150.00, 1, '2023-10-12 18:55:28', '2023-10-12 18:55:28'),
(261, 0, 4, 2, '2023-10-20', '12:00:00', '13:30:00', 'friday', 150.00, 1, '2023-10-12 18:55:28', '2023-10-12 18:55:28'),
(262, 0, 4, 2, '2023-10-20', '13:30:00', '15:00:00', 'friday', 150.00, 1, '2023-10-12 18:55:28', '2023-10-12 18:55:28'),
(263, 0, 4, 2, '2023-10-20', '15:00:00', '16:00:00', 'friday', 150.00, 1, '2023-10-12 18:55:28', '2023-10-12 18:55:28'),
(264, 0, 4, 2, '2023-10-26', '09:00:00', '10:30:00', 'thursday', 150.00, 1, '2023-10-12 19:02:04', '2023-10-12 19:02:04'),
(265, 0, 4, 2, '2023-10-26', '10:30:00', '12:00:00', 'thursday', 150.00, 1, '2023-10-12 19:02:04', '2023-10-12 19:02:04'),
(266, 0, 4, 2, '2023-10-26', '12:00:00', '13:30:00', 'thursday', 150.00, 1, '2023-10-12 19:02:04', '2023-10-12 19:02:04'),
(267, 0, 4, 2, '2023-10-26', '13:30:00', '15:00:00', 'thursday', 150.00, 1, '2023-10-12 19:02:04', '2023-10-12 19:02:04'),
(268, 0, 4, 2, '2023-10-26', '15:00:00', '16:00:00', 'thursday', 150.00, 1, '2023-10-12 19:02:04', '2023-10-12 19:02:04');

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
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `type`, `vendor_id`, `dome_id`, `league_id`, `user_id`, `booking_id`, `contributor_name`, `payment_method`, `transaction_id`, `amount`, `is_payment_released`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 2, NULL, 12, '6c4d0f30', NULL, 1, 'pi_3O01s2FysF0okTxJ0JWijdsu', '11.40', 2, '2023-10-11 22:21:00', '2023-10-11 22:21:00'),
(2, 1, 2, 4, NULL, 12, '8d0727d3', NULL, 1, 'pi_3O02s1FysF0okTxJ08tK49b6', '60.40', 2, '2023-10-11 23:25:02', '2023-10-11 23:25:02'),
(3, 1, 2, 4, NULL, 12, 'abaee6aa', NULL, 1, 'pi_3O0GkmFysF0okTxJ0EG29PvE', '561.60', 2, '2023-10-12 14:14:20', '2023-10-12 14:14:20'),
(4, 1, 2, 4, NULL, 5, 'eb42e99b', NULL, 1, 'pi_3O0LU2FysF0okTxJ10K5BUVI', '561.60', 2, '2023-10-12 19:17:26', '2023-10-12 19:17:26'),
(5, 1, 2, 4, NULL, 5, '8bbae046', NULL, 1, 'pi_3O0LizFysF0okTxJ0Hts2V1e', '236.80', 2, '2023-10-12 19:33:03', '2023-10-12 19:33:03');

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
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `type`, `login_type`, `vendor_id`, `dome_limit`, `name`, `email`, `countrycode`, `phone`, `password`, `google_id`, `apple_id`, `facebook_id`, `fcm_token`, `otp`, `image`, `is_verified`, `is_available`, `is_deleted`, `created_at`, `updated_at`) VALUES
(1, 1, 1, NULL, NULL, 'Admin', 'admin@gmail.com', NULL, NULL, '$2y$10$wPcjS6394evN1zKA.TOUUOkNBjdpA7KBOtQV.40v1IFGjyNkKB.Ra', NULL, NULL, NULL, NULL, NULL, 'default.png', 1, 1, 2, '2023-09-19 08:37:33', '2023-09-19 08:37:33'),
(2, 2, 1, NULL, 4, 'First Domeowner', 'domeowner@yopmail.com', NULL, NULL, '$2y$10$wPcjS6394evN1zKA.TOUUOkNBjdpA7KBOtQV.40v1IFGjyNkKB.Ra', NULL, NULL, NULL, NULL, '', 'default.png', 1, 1, 2, '2023-06-08 18:49:52', '2023-08-24 05:58:27'),
(3, 3, 2, NULL, NULL, 'Meet Gabani', 'mitgabani350@gmail.com', '', '', NULL, '100445657511173093342', NULL, NULL, 'c4O8Q-d5Q-CeauLgBS8zvF:APA91bGykmUOlau9jtvmCQ-AdQZS_Q569EiWwyv_LsccdWq9WI3eWzXh6xYZeMCsl_hcSzoOehG4tVsLgbza3er3x2R0QgZTgiCMX-HX-BesTki1tjhjVmgKNC762jbtrgX0EXCFaEKg', NULL, 'default.png', 1, 1, 2, '2023-09-20 15:23:34', '2023-09-20 15:23:34'),
(4, 3, 2, NULL, NULL, 'Hitesh Suratikvxvkxvkxvkbmxbmx', 'suratihitesh44@gmail.com', 'AS', '3583383', NULL, '108590077845795740557', NULL, NULL, 'test', NULL, 'profiles-651aaf2de9a7d.png', 1, 1, 2, '2023-10-02 13:08:27', '2023-10-03 19:30:47'),
(5, 3, 2, NULL, NULL, 'Diwakar kumar tiwari', 'tdiwakarkumar@gmail.com', '', '', NULL, '108233109670195665567', NULL, NULL, 'ccC7ZcNxfUMQkcr9EM9oBD:APA91bG8cUSgyg2g0Hp0Z5qWou3TOd_oMCcn5lrxloBtPf1G9JXRAfp789dR_6GC8Ph6Ao1zVj-yAYkd0MTF8dQl0cKaRdJ6IzObrfSIP4q4JxEeYUVqAlQc8NsfNgW47Kl4D7v-Gjo6', NULL, 'default.png', 1, 1, 2, '2023-10-02 22:52:31', '2023-10-02 22:52:31'),
(6, 3, 2, NULL, NULL, 'Soham Shah', 'sohamtest404@gmail.com', '', '', NULL, '113314146991157284773', NULL, NULL, 'cYbBIL_zm01Mq26u2ctaOn:APA91bHHg2rKpJPYLa_d18y1cotVHBc2OAeAMYPbRMdQ20J65KOSaEY__Rn_M6OMwwO0pgrYegjHikpX3Jt5szEgnpnZI0l6gkku-vnPz4pOaphknzvdWktfUpzQ_FSalGJ0Ud-bjZ2I', NULL, 'default.png', 1, 1, 2, '2023-10-03 21:45:41', '2023-10-03 21:45:41'),
(7, 3, 2, NULL, NULL, 'Soham Shah', 'developersoham7@gmail.com', '', '', NULL, '102066544323619435645', NULL, NULL, 'cEGJg8XDlE0_sh0pA0sTks:APA91bGmu9KQEYZ4ipU14GuhgzaZP08fuyqilbT_PfbRB6wEJ89o01_5BR0rWYRVFvHB8AsMuRyu8GLRh0cT3kyXKQ8_83N0yEJCOnR6DHUIZTFtKiPiXjxQkVIWyR33ZLW38e7GMiFo', NULL, 'default.png', 1, 1, 2, '2023-10-05 22:05:42', '2023-10-05 22:05:42'),
(8, 3, 2, NULL, NULL, 'Meet Gabani', 'meetgabani82@gmail.com', 'CA', NULL, NULL, '112020540315266415798', NULL, NULL, 'fvAGjGZcTmCx9L_c9euJN0:APA91bGayR-e_UPb1gWDbhJFCTnc6-V22P5Gy3ameUWikCVeoa4mbsDfwjp5mXS6SrvS_sR8VSxhDYlSNjz1bR1GTM-7udgn7pjxp49nrasoPcPyuX4jciLpNSIMrTfMzXFE_NUJwWHk', NULL, 'default.png', 1, 1, 2, '2023-10-09 20:22:02', '2023-10-09 22:17:36'),
(10, 2, 1, NULL, 1, 'James Dome Owner', 'domeowner1@yopmail.com', NULL, '689113264545', '$2y$10$qKDpnmDiL1IvAKf5pun6XuSzW1FjuwrUhTUy1Aq7fXopWGyioELcq', NULL, NULL, NULL, NULL, '0', 'profiles-65264311bd67b.png', 1, 1, 2, '2023-10-11 16:09:13', '2023-10-11 16:40:56'),
(11, 5, 1, 2, NULL, 'Provider 1', 'provider1@yopmail.com', NULL, NULL, '$2y$10$kGrfgXyvm4S9jnlzErUrduFVxIcB/hMESBtKTCpmm3PKc.MtQEaYW', NULL, NULL, NULL, NULL, NULL, 'default.png', 1, 1, 2, '2023-10-11 16:36:25', '2023-10-11 16:36:25'),
(12, 3, 1, NULL, NULL, 'dddddh', 'ffd@gmail.com', 'CA', '5555555555', '$2y$10$TrUdbeKLaJuDFMZoWNaNTu45N9kZen9fQFlHtLBeOet.1REgQsrGS', NULL, NULL, NULL, '', NULL, 'default.png', 1, 1, 2, '2023-10-11 20:28:49', '2023-10-11 20:30:22'),
(13, 3, 1, NULL, NULL, 'Soham', 'ssss@gmail.com', 'CA', '1234567890', '$2y$10$.sbZULovuLX8VjKuaedeFeXUNBJAljXgVbsRTnlpfiygPkNPTxULq', NULL, NULL, NULL, '', NULL, 'default.png', 1, 1, 2, '2023-10-12 19:40:34', '2023-10-12 19:40:34'),
(14, 3, 1, NULL, NULL, 'Soham', 'sssss@gmail.com', 'CA', '1569874236', '$2y$10$Hihten.QaDFs5x2eXyw0ZO/O2HKTGX3DPsU6iObFrtkoCTGFKbhd.', NULL, NULL, NULL, '', NULL, 'default.png', 1, 1, 2, '2023-10-12 19:41:35', '2023-10-12 19:41:35');

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
) ENGINE=MyISAM AUTO_INCREMENT=57 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `working_hours`
--

INSERT INTO `working_hours` (`id`, `vendor_id`, `dome_id`, `day`, `open_time`, `close_time`, `is_closed`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 'monday', '05:00:00', '15:00:00', 2, '2023-10-11 20:14:43', '2023-10-11 20:14:43'),
(2, 2, 1, 'tuesday', '05:00:00', '15:00:00', 2, '2023-10-11 20:14:43', '2023-10-11 20:14:43'),
(3, 2, 1, 'wednesday', '05:00:00', '15:00:00', 2, '2023-10-11 20:14:43', '2023-10-11 20:14:43'),
(4, 2, 1, 'thursday', '05:00:00', '15:00:00', 2, '2023-10-11 20:14:43', '2023-10-11 20:14:43'),
(5, 2, 1, 'friday', '05:00:00', '15:00:00', 2, '2023-10-11 20:14:43', '2023-10-11 20:14:43'),
(6, 2, 1, 'saturday', '05:00:00', '15:00:00', 2, '2023-10-11 20:14:43', '2023-10-11 20:14:43'),
(7, 2, 1, 'sunday', '05:00:00', '15:00:00', 2, '2023-10-11 20:14:43', '2023-10-11 20:14:43'),
(8, 2, 2, 'monday', '01:00:00', '23:59:00', 1, '2023-10-11 20:16:20', '2023-10-11 20:16:20'),
(9, 2, 2, 'tuesday', '01:00:00', '22:30:00', 2, '2023-10-11 20:16:20', '2023-10-11 20:16:20'),
(10, 2, 2, 'wednesday', '01:00:00', '22:30:00', 2, '2023-10-11 20:16:20', '2023-10-11 20:16:20'),
(11, 2, 2, 'thursday', '01:00:00', '23:00:00', 1, '2023-10-11 20:16:20', '2023-10-11 20:16:20'),
(12, 2, 2, 'friday', '02:00:00', '23:30:00', 2, '2023-10-11 20:16:20', '2023-10-11 20:16:20'),
(13, 2, 2, 'saturday', '02:00:00', '23:30:00', 1, '2023-10-11 20:16:20', '2023-10-11 20:16:20'),
(14, 2, 2, 'sunday', '02:00:00', '23:59:00', 2, '2023-10-11 20:16:20', '2023-10-11 20:16:20'),
(15, 2, 3, 'monday', '01:00:00', '23:59:00', 1, '2023-10-11 20:16:31', '2023-10-11 20:16:31'),
(16, 2, 3, 'tuesday', '01:00:00', '22:30:00', 2, '2023-10-11 20:16:31', '2023-10-11 20:16:31'),
(17, 2, 3, 'wednesday', '01:00:00', '22:30:00', 2, '2023-10-11 20:16:31', '2023-10-11 20:16:31'),
(18, 2, 3, 'thursday', '01:00:00', '23:00:00', 1, '2023-10-11 20:16:31', '2023-10-11 20:16:31'),
(19, 2, 3, 'friday', '02:00:00', '23:30:00', 2, '2023-10-11 20:16:31', '2023-10-11 20:16:31'),
(20, 2, 3, 'saturday', '02:00:00', '23:30:00', 1, '2023-10-11 20:16:31', '2023-10-11 20:16:31'),
(21, 2, 3, 'sunday', '02:00:00', '23:59:00', 2, '2023-10-11 20:16:31', '2023-10-11 20:16:31'),
(22, 2, 4, 'monday', '01:00:00', '07:00:00', 1, '2023-10-11 20:19:03', '2023-10-12 19:04:39'),
(23, 2, 4, 'tuesday', '09:00:00', '16:00:00', 2, '2023-10-11 20:19:03', '2023-10-12 19:04:39'),
(24, 2, 4, 'wednesday', '09:00:00', '16:00:00', 2, '2023-10-11 20:19:03', '2023-10-12 19:04:39'),
(25, 2, 4, 'thursday', '09:00:00', '16:00:00', 2, '2023-10-11 20:19:03', '2023-10-12 19:04:39'),
(26, 2, 4, 'friday', '09:00:00', '16:00:00', 2, '2023-10-11 20:19:03', '2023-10-12 19:04:39'),
(27, 2, 4, 'saturday', '09:00:00', '16:00:00', 2, '2023-10-11 20:19:03', '2023-10-12 19:04:39'),
(28, 2, 4, 'sunday', '09:00:00', '16:00:00', 2, '2023-10-11 20:19:03', '2023-10-12 19:04:39'),
(29, 2, 5, 'monday', '07:00:00', '15:00:00', 2, '2023-10-11 21:35:45', '2023-10-11 21:35:45'),
(30, 2, 5, 'tuesday', '07:00:00', '15:00:00', 2, '2023-10-11 21:35:45', '2023-10-11 21:35:45'),
(31, 2, 5, 'wednesday', '07:00:00', '15:00:00', 2, '2023-10-11 21:35:45', '2023-10-11 21:35:45'),
(32, 2, 5, 'thursday', '07:00:00', '15:00:00', 2, '2023-10-11 21:35:45', '2023-10-11 21:35:45'),
(33, 2, 5, 'friday', '07:00:00', '15:00:00', 2, '2023-10-11 21:35:45', '2023-10-11 21:35:45'),
(34, 2, 5, 'saturday', '07:00:00', '15:00:00', 2, '2023-10-11 21:35:45', '2023-10-11 21:35:45'),
(35, 2, 5, 'sunday', '07:00:00', '15:00:00', 2, '2023-10-11 21:35:45', '2023-10-11 21:35:45'),
(36, 2, 6, 'monday', '06:00:00', '13:30:00', 2, '2023-10-11 22:03:41', '2023-10-11 22:03:41'),
(37, 2, 6, 'tuesday', '06:00:00', '13:30:00', 2, '2023-10-11 22:03:41', '2023-10-11 22:03:41'),
(38, 2, 6, 'wednesday', '06:00:00', '13:30:00', 2, '2023-10-11 22:03:41', '2023-10-11 22:03:41'),
(39, 2, 6, 'thursday', '06:00:00', '13:30:00', 2, '2023-10-11 22:03:41', '2023-10-11 22:03:41'),
(40, 2, 6, 'friday', '06:00:00', '13:30:00', 2, '2023-10-11 22:03:41', '2023-10-11 22:03:41'),
(41, 2, 6, 'saturday', '06:00:00', '13:30:00', 2, '2023-10-11 22:03:41', '2023-10-11 22:03:41'),
(42, 2, 6, 'sunday', '06:00:00', '13:30:00', 2, '2023-10-11 22:03:41', '2023-10-11 22:03:41'),
(43, 2, 7, 'monday', '06:00:00', '13:30:00', 2, '2023-10-11 22:04:20', '2023-10-11 22:04:20'),
(44, 2, 7, 'tuesday', '06:00:00', '13:30:00', 2, '2023-10-11 22:04:20', '2023-10-11 22:04:20'),
(45, 2, 7, 'wednesday', '06:00:00', '13:30:00', 2, '2023-10-11 22:04:20', '2023-10-11 22:04:20'),
(46, 2, 7, 'thursday', '06:00:00', '13:30:00', 2, '2023-10-11 22:04:20', '2023-10-11 22:04:20'),
(47, 2, 7, 'friday', '06:00:00', '13:30:00', 2, '2023-10-11 22:04:20', '2023-10-11 22:04:20'),
(48, 2, 7, 'saturday', '06:00:00', '13:30:00', 2, '2023-10-11 22:04:20', '2023-10-11 22:04:20'),
(49, 2, 7, 'sunday', '06:00:00', '13:30:00', 2, '2023-10-11 22:04:20', '2023-10-11 22:04:20'),
(50, 2, 8, 'monday', '00:00:00', '23:59:00', 1, '2023-10-11 22:28:45', '2023-10-11 22:28:45'),
(51, 2, 8, 'tuesday', '00:00:00', '23:59:00', 2, '2023-10-11 22:28:45', '2023-10-11 22:28:45'),
(52, 2, 8, 'wednesday', '00:00:00', '23:59:00', 1, '2023-10-11 22:28:45', '2023-10-11 22:28:45'),
(53, 2, 8, 'thursday', '00:00:00', '23:59:00', 2, '2023-10-11 22:28:45', '2023-10-11 22:28:45'),
(54, 2, 8, 'friday', '00:00:00', '23:59:00', 1, '2023-10-11 22:28:45', '2023-10-11 22:28:45'),
(55, 2, 8, 'saturday', '00:00:00', '23:59:00', 2, '2023-10-11 22:28:45', '2023-10-11 22:28:45'),
(56, 2, 8, 'sunday', '00:00:00', '23:59:00', 2, '2023-10-11 22:28:45', '2023-10-11 22:28:45');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
