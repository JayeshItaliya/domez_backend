-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 24, 2023 at 11:25 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `domez`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1=Dome Bookings,  2=League Bookings',
  `vendor_id` int(11) NOT NULL,
  `dome_id` int(11) DEFAULT NULL,
  `league_id` int(11) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `sport_id` int(11) NOT NULL,
  `field_id` int(11) NOT NULL,
  `booking_id` int(11) NOT NULL,
  `booking_date` date NOT NULL,
  `customer_name` varchar(255) DEFAULT NULL,
  `customer_email` varchar(255) NOT NULL,
  `customer_mobile` varchar(255) DEFAULT NULL,
  `team_name` varchar(255) DEFAULT NULL COMMENT 'For Leagues Booking Only',
  `players` int(11) NOT NULL,
  `slots` text DEFAULT NULL COMMENT 'For Domes Booking Only',
  `start_date` date DEFAULT NULL COMMENT 'For Leagues Booking Only	',
  `end_date` date DEFAULT NULL COMMENT 'For Leagues Booking Only	',
  `start_time` text NOT NULL,
  `end_time` text NOT NULL,
  `total_amount` double(8,2) NOT NULL,
  `paid_amount` double(8,2) NOT NULL DEFAULT 0.00,
  `due_amount` double(8,2) NOT NULL DEFAULT 0.00,
  `payment_mode` int(11) NOT NULL DEFAULT 1 COMMENT '1=online,2=offline',
  `payment_type` int(11) NOT NULL DEFAULT 1 COMMENT '1=Full Amount, 2=Split Amount',
  `payment_status` int(11) NOT NULL DEFAULT 1 COMMENT '1=Complete,2=Partial',
  `booking_status` int(11) NOT NULL DEFAULT 1 COMMENT '1=Confirmed, 2=Pending, 3=Cancelled	',
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `type`, `vendor_id`, `dome_id`, `league_id`, `user_id`, `sport_id`, `field_id`, `booking_id`, `booking_date`, `customer_name`, `customer_email`, `customer_mobile`, `team_name`, `players`, `slots`, `start_date`, `end_date`, `start_time`, `end_time`, `total_amount`, `paid_amount`, `due_amount`, `payment_mode`, `payment_type`, `payment_status`, `booking_status`, `created_at`, `updated_at`) VALUES
(22, 1, 2, 35, NULL, 9, 6, 3, 554611, '2003-11-09', 'Prof. Geovany Kuhn', 'arno.mayert@example.com', '+14809074204', NULL, 17, '06:30 AM - 07:30 AM', NULL, NULL, '1:41 PM', '11:35 AM', 87.00, 23.00, 26.00, 1, 2, 1, 1, '2023-02-20 04:57:41', '2023-02-20 04:57:41'),
(23, 1, 2, 37, NULL, 11, 10, 2, 416036, '1975-09-30', 'Ulises Ledner', 'dillan.sporer@example.com', '+1-940-940-5206', NULL, 25, '06:30 AM - 07:30 AM', NULL, NULL, '8:22 AM', '11:30 AM', 85.00, 40.00, 18.00, 2, 1, 2, 2, '2023-02-20 04:57:41', '2023-02-20 04:57:41'),
(24, 1, 2, 37, NULL, 7, 6, 2, 369746, '2008-01-05', 'Rodrick Dare PhD', 'schiller.kaelyn@example.net', '+1 (925) 464-1416', NULL, 24, '06:30 AM - 07:30 AM', NULL, NULL, '12:27 PM', '1:21 AM', 56.00, 42.00, 20.00, 1, 1, 1, 1, '2023-02-20 04:57:41', '2023-02-20 04:57:41'),
(25, 1, 2, 39, NULL, 10, 8, 5, 986568, '2007-07-13', 'Isabelle Dietrich', 'alba.heaney@example.net', '424-832-1927', NULL, 14, '06:30 AM - 07:30 AM', NULL, NULL, '9:18 AM', '6:58 AM', 72.00, 20.00, 10.00, 1, 1, 2, 1, '2023-02-20 04:57:41', '2023-02-20 04:57:41'),
(26, 1, 2, 36, NULL, 7, 8, 4, 166327, '2004-03-08', 'Ward Purdy', 'lamar04@example.net', '620.723.1946', NULL, 15, '06:30 AM - 07:30 AM', NULL, NULL, '3:38 AM', '5:23 PM', 47.00, 34.00, 25.00, 1, 1, 1, 2, '2023-02-20 04:57:41', '2023-02-20 04:57:41'),
(27, 1, 2, 36, NULL, 8, 9, 1, 457640, '2002-04-11', 'Dr. Lucile Hoppe', 'robin.mayer@example.org', '283-731-3348', NULL, 28, '06:30 AM - 07:30 AM', NULL, NULL, '8:56 AM', '3:47 AM', 61.00, 45.00, 19.00, 1, 1, 2, 2, '2023-02-20 04:57:41', '2023-02-20 04:57:41'),
(28, 1, 2, 36, NULL, 12, 9, 4, 637257, '2011-04-09', 'Adolphus Howe DVM', 'friesen.ezekiel@example.com', '(657) 566-7750', NULL, 24, '06:30 AM - 07:30 AM', NULL, NULL, '9:44 PM', '8:05 AM', 32.00, 37.00, 29.00, 1, 1, 1, 2, '2023-02-20 04:57:41', '2023-02-20 04:57:41'),
(29, 1, 2, 36, NULL, 11, 6, 2, 634153, '1974-01-15', 'Kyler O\'Conner', 'ramon76@example.com', '+1 (520) 281-8861', NULL, 14, '06:30 AM - 07:30 AM', NULL, NULL, '7:13 PM', '11:48 PM', 28.00, 25.00, 22.00, 1, 1, 2, 2, '2023-02-20 04:57:41', '2023-02-20 04:57:41'),
(30, 1, 2, 35, NULL, 9, 8, 5, 642194, '1989-11-13', 'Verona Marks MD', 'deshawn.abshire@example.com', '+1.918.990.4786', NULL, 14, '06:30 AM - 07:30 AM', NULL, NULL, '1:24 AM', '3:56 AM', 74.00, 34.00, 19.00, 1, 2, 1, 1, '2023-02-20 04:57:41', '2023-02-20 04:57:41'),
(31, 1, 2, 38, NULL, 6, 10, 5, 628792, '1980-08-18', 'Prof. Lindsey Breitenberg II', 'powlowski.kristopher@example.org', '617.771.7490', NULL, 13, '06:30 AM - 07:30 AM', NULL, NULL, '6:10 AM', '12:04 PM', 62.00, 11.00, 10.00, 1, 1, 1, 1, '2023-02-20 04:57:41', '2023-02-20 04:57:41'),
(32, 2, 2, 37, 2, 10, 7, 5, 811483, '2023-02-21', 'Rupert Mueller', 'beaulah95@example.net', '1-928-475-2913', 'Regular Old Football League', 27, NULL, '2023-03-10', '2023-04-10', '09:00 AM', '05:00 PM', 1848.00, 0.00, 0.00, 1, 1, 1, 1, '2023-02-21 01:52:13', '2023-02-21 01:52:13'),
(33, 2, 2, 37, 2, 5, 7, 5, 149051, '2023-02-21', 'Dariana Stark', 'veum.aaliyah@example.com', '+1-318-389-1635', 'Regular Old Football League', 28, NULL, '2023-03-10', '2023-04-10', '09:00 AM', '05:00 PM', 1848.00, 0.00, 0.00, 1, 1, 1, 1, '2023-02-22 00:29:14', '2023-02-22 00:29:14'),
(34, 2, 2, 37, 2, 13, 7, 5, 448414, '2023-02-21', 'Freeda Lynch', 'brandon.zieme@example.net', '+15746485171', 'Regular Old Football League', 19, NULL, '2023-03-10', '2023-04-10', '09:00 AM', '05:00 PM', 1848.00, 0.00, 0.00, 1, 1, 1, 1, '2023-02-22 00:29:24', '2023-02-22 00:29:24');

-- --------------------------------------------------------

--
-- Table structure for table `cms`
--

CREATE TABLE `cms` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type` int(11) NOT NULL COMMENT '1=Privacy Policy, 2=Terms & Conditions, 3=Refund Policy',
  `content` longtext NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `domes`
--

CREATE TABLE `domes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `vendor_id` int(11) NOT NULL,
  `sport_id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` double(8,2) DEFAULT NULL,
  `hst` double NOT NULL COMMENT 'tax(GST)',
  `address` text NOT NULL,
  `pin_code` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `start_time` varchar(255) NOT NULL,
  `end_time` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `lat` varchar(255) NOT NULL,
  `lng` varchar(255) NOT NULL,
  `benefits` varchar(255) NOT NULL,
  `benefits_description` text NOT NULL,
  `is_deleted` tinyint(4) NOT NULL DEFAULT 2 COMMENT '1=yes,2=no',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `domes`
--

INSERT INTO `domes` (`id`, `vendor_id`, `sport_id`, `name`, `price`, `hst`, `address`, `pin_code`, `city`, `state`, `country`, `start_time`, `end_time`, `description`, `lat`, `lng`, `benefits`, `benefits_description`, `is_deleted`, `created_at`, `updated_at`) VALUES
(35, 2, '6', 'Kinnara', 58.00, 5, 'Costen Tax Solutions, Inc, Birdneck Road North, Virginia Beach, VA, USA', '23451', 'Summerside', 'Prince Edward Island', 'Canada', '6:30 AM', '5:00 PM', 'DESCRIPTION', '28.5156729', '-81.4824233', 'Free Wifi|Changing Room|Parking', 'benefits-DESCRIPTION', 2, '2023-02-20 03:57:09', '2023-02-21 05:03:45'),
(36, 3, '7', 'Shott', 90.00, 5, '511 Notre Dame St, Summerside, PE, Canada', 'C1N 1T2', 'Summerside', 'Prince Edward Island', 'Canada', '12:03 PM', '7:51 AM', 'DESCRIPTION', '46.3981555', '-63.80031419999999', 'Changing Room', 'benefits-DESCRIPTION', 2, '2023-02-20 03:57:09', '2023-02-21 05:03:55'),
(37, 4, '8,9', 'geonardo', 80.00, 5, '511 Notre Dame St, Summerside, PE, Canada', 'C1N 1T2', 'Summerside', 'Prince Edward Island', 'Canada', '3:08 PM', '12:10 AM', 'DESCRIPTION', '46.3981555', '-63.80031419999999', 'Changing Room|Parking', 'benefits-DESCRIPTION', 2, '2023-02-20 03:57:09', '2023-02-21 05:04:05'),
(38, 5, '9,10', 'Shivakar', 85.00, 5, '511 Notre Dame St, Summerside, PE, Canada', 'C1N 1T2', 'Summerside', 'Prince Edward Island', 'Canada', '8:55 PM', '10:05 PM', 'DESCRIPTION', '46.3981555', '-63.80031419999999', 'Free Wifi|Changing Room', 'benefits-DESCRIPTION', 2, '2023-02-20 03:57:09', '2023-02-21 05:04:16'),
(39, 6, '7,8,10', 'Rockria', 64.00, 5, '511 Notre Dame St, Summerside, PE, Canada', 'C1N 1T2', 'Summerside', 'Prince Edward Island', 'Canada', '10:00 PM', '12:02 PM', 'DESCRIPTION', '46.3981555', '-63.80031419999999', 'Free Wifi|Changing Room|Parking', 'benefits-DESCRIPTION', 2, '2023-02-20 03:57:09', '2023-02-21 05:04:29'),
(40, 7, '6', 'Geodesic Dome Playground', 76.00, 5, 'Summerside Bowling Alleys, 511 Notre Dame St, Summerside, PE, Canada', 'C1N 1T2', 'Summerside', 'Prince Edward Island', 'Canada', '11:05 PM', '11:36 PM', 'DESCRIPTION', '46.39860830000001', '-63.8004099', 'Parking', 'benefits-DESCRIPTION', 2, '2023-02-20 04:57:41', '2023-02-20 05:06:24'),
(41, 8, '7,8,10', 'Geodesic Dome Playground', 57.00, 5, 'Summerside Car Rental, Inside Credit Union Place Building, 511 Notre Dame St, Summerside, PE, Canada', 'C1N 1T2', 'Summerside', 'Prince Edward Island', 'Canada', '5:40 AM', '6:46 PM', 'DESCRIPTION', '46.3981555', '-63.80031409999999', 'Free Wifi|Changing Room', 'benefits-DESCRIPTION', 2, '2023-02-20 04:57:41', '2023-02-20 05:06:44'),
(42, 9, '7,8,10', 'Shrinkle ground', 70.00, 5, 'Summerside Solar, 511 Notre Dame St, Summerside, PE, Canada', 'C1N 1T2', 'Summerside', 'Prince Edward Island', 'Canada', '1:14 AM', '4:14 PM', 'DESCRIPTION', '46.3993871', '-63.8010478', 'Changing Room', 'benefits-DESCRIPTION', 2, '2023-02-20 04:57:41', '2023-02-21 05:04:45'),
(43, 10, '6,8', 'Geodesic Dome Playground', 97.00, 5, '511 Notre Dame St, Summerside, PE, Canada', 'C1N 1T2', 'Summerside', 'Prince Edward Island', 'Canada', '10:38 AM', '9:33 PM', 'DESCRIPTION', '46.3981555', '-63.80031419999999', 'Changing Room|Parking', 'benefits-DESCRIPTION', 2, '2023-02-20 04:57:41', '2023-02-20 05:07:15'),
(44, 11, '9,10', 'Geodesic Dome Playground', 68.00, 5, 'Summerside Bowling Alleys, 511 Notre Dame St, Summerside, PE, Canada', 'C1N 1T2', 'Summerside', 'Prince Edward Island', 'Canada', '5:43 AM', '2:41 PM', 'DESCRIPTION', '46.39860830000001', '-63.8004099', 'Free Wifi|Changing Room', 'benefits-DESCRIPTION', 2, '2023-02-20 04:57:41', '2023-02-20 05:10:13');

-- --------------------------------------------------------

--
-- Table structure for table `dome_images`
--

CREATE TABLE `dome_images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `vendor_id` int(11) NOT NULL,
  `dome_id` int(11) NOT NULL,
  `images` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `dome_images`
--

INSERT INTO `dome_images` (`id`, `vendor_id`, `dome_id`, `images`, `created_at`, `updated_at`) VALUES
(17, 1, 35, 'dome-63f33f137daf5.png', '2023-02-20 04:06:19', '2023-02-20 04:06:19'),
(18, 1, 36, 'dome-63f34ce3141b4.jpg', '2023-02-20 05:05:15', '2023-02-20 05:05:15'),
(19, 1, 36, 'dome-63f34ce315178.png', '2023-02-20 05:05:15', '2023-02-20 05:05:15'),
(20, 1, 38, 'dome-63f34cfddbb9b.jpg', '2023-02-20 05:05:41', '2023-02-20 05:05:41'),
(21, 1, 38, 'dome-63f34cfddc864.png', '2023-02-20 05:05:41', '2023-02-20 05:05:41'),
(22, 1, 37, 'dome-63f34d071a031.jpg', '2023-02-20 05:05:51', '2023-02-20 05:05:51'),
(23, 1, 37, 'dome-63f34d071c65b.png', '2023-02-20 05:05:51', '2023-02-20 05:05:51'),
(24, 1, 39, 'dome-63f34d19b1030.jpg', '2023-02-20 05:06:09', '2023-02-20 05:06:09'),
(25, 1, 39, 'dome-63f34d19b1b0f.png', '2023-02-20 05:06:09', '2023-02-20 05:06:09'),
(26, 1, 40, 'dome-63f34d28721ba.jpg', '2023-02-20 05:06:24', '2023-02-20 05:06:24'),
(27, 1, 40, 'dome-63f34d2872c25.png', '2023-02-20 05:06:24', '2023-02-20 05:06:24'),
(28, 1, 41, 'dome-63f34d3c32120.jpg', '2023-02-20 05:06:44', '2023-02-20 05:06:44'),
(29, 1, 41, 'dome-63f34d3c32dad.png', '2023-02-20 05:06:44', '2023-02-20 05:06:44'),
(30, 1, 43, 'dome-63f34d5bc9946.jpg', '2023-02-20 05:07:15', '2023-02-20 05:07:15'),
(31, 1, 43, 'dome-63f34d5bca5e8.png', '2023-02-20 05:07:15', '2023-02-20 05:07:15'),
(32, 1, 44, 'dome-63f34e0d03fad.jpg', '2023-02-20 05:10:13', '2023-02-20 05:10:13'),
(33, 1, 44, 'dome-63f34e0d04c53.png', '2023-02-20 05:10:13', '2023-02-20 05:10:13');

-- --------------------------------------------------------

--
-- Table structure for table `enquiries`
--

CREATE TABLE `enquiries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `venue_name` varchar(255) DEFAULT NULL,
  `venue_address` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `message` varchar(255) DEFAULT NULL,
  `type` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1=HelpCenter, 2=GeneralEnquiry, 3=DomesRequest [From Landing Page],\r\n4=DomesRequest [From Mobile App]',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `enquiries`
--

INSERT INTO `enquiries` (`id`, `venue_name`, `venue_address`, `name`, `email`, `phone`, `subject`, `message`, `type`, `created_at`, `updated_at`) VALUES
(1, NULL, NULL, NULL, 'ipsum@yopmail.comn', NULL, 'Talk About Something..', 'Lorem is ipsum data to world to tast data.', 1, '2023-02-19 01:13:26', '2023-02-19 01:13:26'),
(2, NULL, NULL, NULL, 's@gmail.com', NULL, 'soham', 'Soham is sad', 1, '2023-02-20 01:26:33', '2023-02-20 01:26:33'),
(3, 'test', 'test', 'test', 'test@gmail.com', '12354679', NULL, 'test', 4, '2023-02-24 02:43:40', '2023-02-24 02:43:40');

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
-- Table structure for table `favourites`
--

CREATE TABLE `favourites` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `dome_id` int(11) DEFAULT NULL,
  `league_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `favourites`
--

INSERT INTO `favourites` (`id`, `user_id`, `dome_id`, `league_id`, `created_at`, `updated_at`) VALUES
(1, 5, NULL, 4, '2023-02-22 00:38:11', '2023-02-22 00:38:11'),
(2, 5, NULL, 1, '2023-02-22 00:38:11', '2023-02-22 00:38:11'),
(3, 6, NULL, 5, '2023-02-22 00:38:11', '2023-02-22 00:38:11'),
(4, 9, NULL, 2, '2023-02-22 00:38:11', '2023-02-22 00:38:11'),
(5, 13, NULL, 1, '2023-02-22 00:38:11', '2023-02-22 00:38:11'),
(6, 9, NULL, 4, '2023-02-22 00:38:11', '2023-02-22 00:38:11'),
(7, 6, NULL, 5, '2023-02-22 00:38:11', '2023-02-22 00:38:11'),
(8, 6, NULL, 2, '2023-02-22 00:38:11', '2023-02-22 00:38:11'),
(9, 7, NULL, 2, '2023-02-22 00:38:11', '2023-02-22 00:38:11'),
(10, 9, NULL, 3, '2023-02-22 00:38:11', '2023-02-22 00:38:11'),
(11, 12, 40, NULL, '2023-02-22 00:38:18', '2023-02-22 00:38:18'),
(12, 8, 40, NULL, '2023-02-22 00:38:18', '2023-02-22 00:38:18'),
(13, 8, 40, NULL, '2023-02-22 00:38:18', '2023-02-22 00:38:18'),
(15, 7, 36, NULL, '2023-02-22 00:38:18', '2023-02-22 00:38:18'),
(16, 3, 36, NULL, '2023-02-22 00:38:18', '2023-02-22 00:38:18'),
(17, 9, 39, NULL, '2023-02-22 00:38:18', '2023-02-22 00:38:18'),
(18, 9, 40, NULL, '2023-02-22 00:38:18', '2023-02-22 00:38:18'),
(19, 11, 36, NULL, '2023-02-22 00:38:18', '2023-02-22 00:38:18'),
(20, 10, 40, NULL, '2023-02-22 00:38:18', '2023-02-22 00:38:18'),
(25, 3, 35, NULL, '2023-02-23 01:05:07', '2023-02-23 01:05:07'),
(30, 9, 35, NULL, '2023-02-23 01:42:17', '2023-02-23 01:42:17'),
(54, 4, 38, NULL, '2023-02-24 03:19:45', '2023-02-24 03:19:45'),
(55, 4, 37, NULL, '2023-02-24 03:19:49', '2023-02-24 03:19:49'),
(56, 4, 36, NULL, '2023-02-24 03:19:51', '2023-02-24 03:19:51'),
(57, 4, NULL, 38, '2023-02-24 03:44:45', '2023-02-24 03:44:45'),
(58, 4, NULL, 2, '2023-02-24 03:53:32', '2023-02-24 03:53:32');

-- --------------------------------------------------------

--
-- Table structure for table `fields`
--

CREATE TABLE `fields` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `vendor_id` int(11) NOT NULL,
  `dome_id` int(11) NOT NULL,
  `sport_id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `area` double(8,2) NOT NULL DEFAULT 0.00,
  `min_person` int(11) NOT NULL,
  `max_person` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `is_available` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1=yes,2=no',
  `is_deleted` tinyint(4) NOT NULL DEFAULT 2 COMMENT '1=yes,2=no',
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `fields`
--

INSERT INTO `fields` (`id`, `vendor_id`, `dome_id`, `sport_id`, `name`, `area`, `min_person`, `max_person`, `image`, `is_available`, `is_deleted`, `created_at`, `updated_at`) VALUES
(1, 2, 38, '8', 'Dr. Christian Walter IV', 491.00, 8, 20, 'field-1135.jpg', 1, 2, '2023-02-20 05:57:52', '2023-02-20 05:57:52'),
(2, 2, 35, '6', 'Ms. Annie Gorczany IV', 452.00, 5, 30, 'field-1135.jpg', 1, 2, '2023-02-20 05:57:52', '2023-02-20 05:57:52'),
(3, 2, 36, '9', 'Christa Hettinger MD', 129.00, 6, 19, 'field-1135.jpg', 1, 2, '2023-02-20 05:57:52', '2023-02-20 05:57:52'),
(4, 2, 39, '8', 'Mr. Brent Shields I', 401.00, 6, 18, 'field-1135.jpg', 1, 2, '2023-02-20 05:57:52', '2023-02-20 05:57:52'),
(5, 2, 38, '10', 'Karianne Muller', 439.00, 6, 29, 'field-1135.jpg', 1, 2, '2023-02-20 05:57:52', '2023-02-20 05:57:52');

-- --------------------------------------------------------

--
-- Table structure for table `leagues`
--

CREATE TABLE `leagues` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `vendor_id` int(11) NOT NULL,
  `dome_id` int(11) NOT NULL,
  `field_id` varchar(255) NOT NULL,
  `sport_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `start_time` varchar(255) NOT NULL,
  `end_time` varchar(255) NOT NULL,
  `from_age` int(11) NOT NULL,
  `to_age` int(11) NOT NULL,
  `gender` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1=Male, 2=Female, 3=Other',
  `min_player` int(11) NOT NULL,
  `max_player` int(11) NOT NULL,
  `team_limit` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `image` varchar(255) NOT NULL DEFAULT 'default_league.png',
  `is_deleted` tinyint(4) NOT NULL DEFAULT 2 COMMENT '1=yes,2=no',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `leagues`
--

INSERT INTO `leagues` (`id`, `vendor_id`, `dome_id`, `field_id`, `sport_id`, `name`, `start_date`, `end_date`, `start_time`, `end_time`, `from_age`, `to_age`, `gender`, `min_player`, `max_player`, `team_limit`, `price`, `image`, `is_deleted`, `created_at`, `updated_at`) VALUES
(1, 2, 35, '2|3', 7, 'Regular Old Football League', '2023-03-10', '2023-04-10', '09:00 AM', '05:00 PM', 16, 28, 1, 12, 17, 13, 1489, 'default_league.png', 2, '2023-02-20 06:56:50', '2023-02-20 06:56:50'),
(2, 2, 37, '5', 7, 'Regular Old Football League', '2023-03-10', '2023-04-10', '09:00 AM', '05:00 PM', 20, 30, 1, 12, 16, 13, 1848, 'default_league.png', 2, '2023-02-20 06:56:50', '2023-02-20 06:56:50'),
(3, 2, 37, '4', 7, 'Regular Old Football League', '2023-03-10', '2023-04-10', '09:00 AM', '05:00 PM', 13, 24, 2, 13, 24, 14, 1976, 'default_league.png', 2, '2023-02-20 06:56:50', '2023-02-20 06:56:50'),
(4, 2, 38, '3', 9, 'Regular Old Football League', '2023-03-10', '2023-04-10', '09:00 AM', '05:00 PM', 13, 22, 1, 12, 17, 15, 1527, 'default_league.png', 2, '2023-02-20 06:56:50', '2023-02-20 06:56:50'),
(5, 2, 39, '4', 9, 'Regular Old Football League', '2023-03-10', '2023-04-10', '09:00 AM', '05:00 PM', 17, 21, 3, 13, 20, 12, 1909, 'default_league.png', 2, '2023-02-20 06:56:50', '2023-02-20 06:56:50');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2023_02_06_091247_create_domes_table', 2),
(3, '2023_02_06_100506_create_bookings_table', 3),
(4, '2023_02_06_101920_create_categories_table', 4),
(5, '2023_02_06_102808_create_c_m_s_table', 5),
(6, '2023_02_06_104026_create_dome_images_table', 6),
(7, '2023_02_06_105050_create_favourites_table', 7),
(8, '2023_02_06_105312_create_fields_table', 8),
(10, '2023_02_06_110210_create_payment_gateways_table', 9),
(11, '2023_02_06_110542_create_reviews_table', 10),
(12, '2023_02_06_110902_create_transactions_table', 11),
(14, '2023_02_19_062821_create_enquiries_table', 12),
(15, '2023_02_19_071908_add_fcm_token_column_to_users_table', 13),
(16, '2023_02_17_092343_create_leagues_table', 14);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payment_gateways`
--

CREATE TABLE `payment_gateways` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type` int(11) NOT NULL COMMENT '1=Stripe',
  `public_key` varchar(255) NOT NULL,
  `secret_key` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `dome_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `ratting` int(11) NOT NULL,
  `comment` varchar(255) DEFAULT NULL,
  `reply_message` text DEFAULT NULL,
  `replied_at` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `dome_id`, `user_id`, `ratting`, `comment`, `reply_message`, `replied_at`, `created_at`, `updated_at`) VALUES
(1, 2, 3, 5, NULL, NULL, NULL, '2022-12-12 19:55:45', '2022-12-12 19:56:38'),
(2, 1, 3, 2, 'sacds', NULL, NULL, '2022-12-12 19:56:49', '2023-02-17 23:53:05'),
(3, 2, 6, 2, NULL, NULL, NULL, '2022-12-12 19:59:07', '2022-12-12 19:59:07'),
(4, 4, 4, 2, NULL, NULL, NULL, '2022-12-12 19:59:07', '2022-12-12 19:59:07'),
(5, 4, 3, 3, NULL, NULL, NULL, '2022-12-12 19:59:07', '2022-12-12 19:59:07'),
(6, 2, 4, 3, NULL, NULL, NULL, '2022-12-12 19:59:07', '2022-12-12 19:59:07'),
(7, 4, 6, 4, NULL, NULL, NULL, '2022-12-12 19:59:07', '2022-12-12 19:59:07'),
(8, 4, 3, 4, NULL, NULL, NULL, '2022-12-12 19:59:07', '2022-12-12 19:59:07'),
(9, 1, 3, 4, NULL, NULL, NULL, '2022-12-12 19:59:07', '2022-12-12 19:59:07'),
(10, 1, 5, 2, NULL, NULL, NULL, '2022-12-12 19:59:07', '2022-12-12 19:59:07'),
(11, 2, 4, 3, NULL, NULL, NULL, '2022-12-12 19:59:07', '2022-12-12 19:59:07'),
(12, 1, 4, 4, NULL, NULL, NULL, '2022-12-12 19:59:07', '2022-12-12 19:59:07'),
(13, 4, 6, 1, NULL, NULL, NULL, '2022-12-12 19:59:07', '2022-12-12 19:59:07'),
(14, 2, 4, 1, NULL, NULL, NULL, '2022-12-12 19:59:07', '2022-12-12 19:59:07'),
(15, 2, 3, 5, NULL, NULL, NULL, '2022-12-12 19:59:07', '2022-12-12 19:59:07'),
(16, 1, 3, 4, NULL, NULL, NULL, '2022-12-12 19:59:07', '2022-12-12 19:59:07'),
(17, 2, 3, 5, NULL, NULL, NULL, '2022-12-12 19:59:07', '2022-12-12 19:59:07'),
(18, 3, 4, 5, NULL, NULL, NULL, '2022-12-12 19:59:07', '2022-12-12 19:59:07'),
(19, 1, 4, 2, NULL, NULL, NULL, '2022-12-12 19:59:07', '2022-12-12 19:59:07'),
(20, 3, 4, 3, NULL, NULL, NULL, '2022-12-12 19:59:07', '2022-12-12 19:59:07'),
(21, 1, 6, 4, NULL, NULL, NULL, '2022-12-12 19:59:07', '2022-12-12 19:59:07'),
(22, 1, 5, 3, NULL, NULL, NULL, '2022-12-12 19:59:07', '2022-12-12 19:59:07'),
(23, 4, 5, 3, NULL, NULL, NULL, '2022-12-12 19:59:07', '2022-12-12 19:59:07'),
(24, 2, 4, 3, NULL, NULL, NULL, '2022-12-12 19:59:08', '2022-12-12 19:59:08'),
(25, 2, 4, 2, NULL, NULL, NULL, '2022-12-12 19:59:08', '2022-12-12 19:59:08'),
(26, 1, 6, 4, NULL, NULL, NULL, '2022-12-12 19:59:08', '2022-12-12 19:59:08'),
(27, 3, 4, 1, NULL, NULL, NULL, '2022-12-12 19:59:08', '2022-12-12 19:59:08'),
(28, 4, 6, 4, NULL, NULL, NULL, '2022-12-12 19:59:08', '2022-12-12 19:59:08'),
(29, 1, 3, 4, NULL, NULL, NULL, '2022-12-12 19:59:08', '2022-12-12 19:59:08'),
(30, 3, 5, 4, NULL, NULL, NULL, '2022-12-12 19:59:08', '2022-12-12 19:59:08'),
(31, 3, 3, 1, NULL, NULL, NULL, '2022-12-12 19:59:08', '2022-12-12 19:59:08'),
(32, 2, 3, 1, NULL, NULL, NULL, '2022-12-12 19:59:08', '2022-12-12 19:59:08'),
(33, 2, 4, 5, NULL, NULL, NULL, '2022-12-12 19:59:08', '2022-12-12 19:59:08'),
(34, 3, 3, 4, NULL, NULL, NULL, '2022-12-12 19:59:08', '2022-12-12 19:59:08'),
(35, 1, 5, 2, NULL, NULL, NULL, '2022-12-12 19:59:08', '2022-12-12 19:59:08'),
(36, 3, 3, 2, NULL, NULL, NULL, '2022-12-12 19:59:08', '2022-12-12 19:59:08'),
(37, 3, 3, 1, NULL, NULL, NULL, '2022-12-12 19:59:08', '2022-12-12 19:59:08'),
(38, 2, 6, 5, NULL, NULL, NULL, '2022-12-12 19:59:08', '2022-12-12 19:59:08'),
(39, 4, 3, 5, NULL, NULL, NULL, '2022-12-12 19:59:08', '2022-12-12 19:59:08'),
(40, 2, 5, 4, NULL, NULL, NULL, '2022-12-12 19:59:08', '2022-12-12 19:59:08'),
(41, 1, 4, 3, NULL, NULL, NULL, '2022-12-12 19:59:08', '2022-12-12 19:59:08'),
(42, 2, 4, 5, NULL, NULL, NULL, '2022-12-12 19:59:08', '2022-12-12 19:59:08'),
(43, 2, 5, 4, NULL, NULL, NULL, '2022-12-12 19:59:08', '2022-12-12 19:59:08'),
(44, 3, 5, 1, NULL, NULL, NULL, '2022-12-12 19:59:08', '2022-12-12 19:59:08'),
(45, 3, 4, 4, NULL, NULL, NULL, '2022-12-12 19:59:08', '2022-12-12 19:59:08'),
(46, 1, 3, 4, NULL, NULL, NULL, '2022-12-12 19:59:08', '2022-12-12 19:59:08'),
(47, 1, 3, 4, NULL, NULL, NULL, '2022-12-12 19:59:08', '2022-12-12 19:59:08'),
(48, 3, 4, 5, NULL, NULL, NULL, '2022-12-12 19:59:08', '2022-12-12 19:59:08'),
(49, 2, 3, 2, NULL, NULL, NULL, '2022-12-12 19:59:08', '2022-12-12 19:59:08'),
(50, 4, 3, 3, NULL, NULL, NULL, '2022-12-12 19:59:08', '2022-12-12 19:59:08'),
(51, 1, 6, 2, NULL, NULL, NULL, '2022-12-12 19:59:08', '2022-12-12 19:59:08'),
(52, 2, 3, 3, NULL, NULL, NULL, '2022-12-12 19:59:08', '2022-12-12 19:59:08'),
(53, 1, 3, 2, NULL, NULL, NULL, '2022-12-12 22:44:53', '2022-12-12 22:44:53'),
(54, 3, 3, 2, NULL, NULL, NULL, '2022-12-12 22:44:53', '2022-12-12 22:44:53'),
(55, 4, 4, 1, NULL, NULL, NULL, '2022-12-12 22:44:53', '2022-12-12 22:44:53'),
(56, 1, 5, 3, NULL, NULL, NULL, '2022-12-12 22:44:53', '2022-12-12 22:44:53'),
(57, 4, 5, 3, NULL, NULL, NULL, '2022-12-12 22:44:53', '2022-12-12 22:44:53'),
(58, 4, 6, 5, NULL, NULL, NULL, '2022-12-12 22:44:53', '2022-12-12 22:44:53'),
(59, 1, 3, 1, NULL, NULL, NULL, '2022-12-12 22:44:53', '2022-12-12 22:44:53'),
(60, 2, 3, 5, NULL, NULL, NULL, '2022-12-12 22:44:53', '2022-12-12 22:44:53'),
(61, 4, 3, 1, NULL, NULL, NULL, '2022-12-12 22:44:54', '2022-12-12 22:44:54'),
(62, 3, 5, 3, NULL, NULL, NULL, '2022-12-12 22:44:54', '2022-12-12 22:44:54'),
(63, 2, 4, 1, NULL, NULL, NULL, '2022-12-12 22:44:54', '2022-12-12 22:44:54'),
(64, 3, 4, 3, NULL, NULL, NULL, '2022-12-12 22:44:54', '2022-12-12 22:44:54'),
(65, 2, 3, 4, NULL, NULL, NULL, '2022-12-12 22:44:54', '2022-12-12 22:44:54'),
(66, 4, 4, 2, NULL, NULL, NULL, '2022-12-12 22:44:54', '2022-12-12 22:44:54'),
(67, 4, 3, 1, NULL, NULL, NULL, '2022-12-12 22:44:54', '2022-12-12 22:44:54'),
(68, 1, 6, 4, NULL, NULL, NULL, '2022-12-12 22:44:54', '2022-12-12 22:44:54'),
(69, 4, 5, 2, NULL, NULL, NULL, '2022-12-12 22:44:54', '2022-12-12 22:44:54'),
(70, 3, 3, 3, NULL, NULL, NULL, '2022-12-12 22:44:54', '2022-12-12 22:44:54'),
(71, 2, 3, 3, NULL, NULL, NULL, '2022-12-12 22:44:54', '2022-12-12 22:44:54'),
(72, 2, 3, 5, NULL, NULL, NULL, '2022-12-12 22:44:54', '2022-12-12 22:44:54'),
(73, 3, 5, 5, NULL, NULL, NULL, '2022-12-12 22:44:54', '2022-12-12 22:44:54'),
(74, 4, 3, 1, NULL, NULL, NULL, '2022-12-12 22:44:54', '2022-12-12 22:44:54'),
(75, 3, 6, 4, NULL, NULL, NULL, '2022-12-12 22:44:54', '2022-12-12 22:44:54'),
(76, 4, 6, 4, NULL, NULL, NULL, '2022-12-12 22:44:54', '2022-12-12 22:44:54'),
(77, 1, 3, 5, NULL, NULL, NULL, '2022-12-12 22:44:54', '2022-12-12 22:44:54'),
(78, 3, 3, 4, NULL, NULL, NULL, '2022-12-12 22:44:54', '2022-12-12 22:44:54'),
(79, 3, 4, 1, NULL, NULL, NULL, '2022-12-12 22:44:54', '2022-12-12 22:44:54'),
(80, 3, 3, 4, NULL, NULL, NULL, '2022-12-12 22:44:54', '2022-12-12 22:44:54'),
(81, 2, 4, 5, NULL, NULL, NULL, '2022-12-12 22:44:54', '2022-12-12 22:44:54'),
(82, 4, 5, 4, NULL, NULL, NULL, '2022-12-12 22:44:54', '2022-12-12 22:44:54'),
(83, 3, 4, 1, NULL, NULL, NULL, '2022-12-12 22:44:54', '2022-12-12 22:44:54'),
(84, 4, 3, 4, NULL, NULL, NULL, '2022-12-12 22:44:54', '2022-12-12 22:44:54'),
(85, 4, 5, 2, NULL, NULL, NULL, '2022-12-12 22:44:54', '2022-12-12 22:44:54'),
(86, 1, 5, 3, NULL, NULL, NULL, '2022-12-12 22:44:54', '2022-12-12 22:44:54'),
(87, 1, 3, 2, NULL, NULL, NULL, '2022-12-12 22:44:54', '2022-12-12 22:44:54'),
(88, 4, 4, 2, NULL, NULL, NULL, '2022-12-12 22:44:54', '2022-12-12 22:44:54'),
(89, 1, 4, 2, NULL, NULL, NULL, '2022-12-12 22:44:55', '2022-12-12 22:44:55'),
(90, 3, 4, 4, NULL, NULL, NULL, '2022-12-12 22:44:55', '2022-12-12 22:44:55'),
(91, 1, 4, 4, NULL, NULL, NULL, '2022-12-12 22:44:55', '2022-12-12 22:44:55'),
(92, 2, 6, 2, NULL, NULL, NULL, '2022-12-12 22:44:55', '2022-12-12 22:44:55'),
(93, 1, 4, 5, NULL, NULL, NULL, '2022-12-12 22:44:55', '2022-12-12 22:44:55'),
(94, 3, 3, 1, NULL, NULL, NULL, '2022-12-12 22:44:55', '2022-12-12 22:44:55'),
(95, 2, 3, 1, NULL, NULL, NULL, '2022-12-12 22:44:55', '2022-12-12 22:44:55'),
(96, 4, 5, 3, NULL, NULL, NULL, '2022-12-12 22:44:55', '2022-12-12 22:44:55'),
(97, 4, 5, 5, NULL, NULL, NULL, '2022-12-12 22:44:55', '2022-12-12 22:44:55'),
(98, 2, 4, 2, NULL, NULL, NULL, '2022-12-12 22:44:55', '2022-12-12 22:44:55'),
(99, 3, 4, 4, NULL, NULL, NULL, '2022-12-12 22:44:55', '2022-12-12 22:44:55'),
(100, 1, 5, 1, NULL, NULL, NULL, '2022-12-12 22:44:55', '2022-12-12 22:44:55'),
(101, 2, 5, 3, NULL, NULL, NULL, '2022-12-12 22:44:55', '2022-12-12 22:44:55'),
(102, 2, 4, 5, NULL, NULL, NULL, '2022-12-12 22:44:55', '2022-12-12 22:44:55'),
(103, 2, 4, 3, NULL, NULL, NULL, '2022-12-12 22:45:49', '2022-12-12 22:45:49'),
(104, 4, 4, 5, NULL, NULL, NULL, '2022-12-12 22:45:49', '2022-12-12 22:45:49'),
(105, 3, 3, 5, NULL, NULL, NULL, '2022-12-12 22:45:49', '2022-12-12 22:45:49'),
(106, 4, 6, 4, NULL, NULL, NULL, '2022-12-12 22:45:49', '2022-12-12 22:45:49'),
(107, 1, 3, 2, NULL, NULL, NULL, '2022-12-12 22:45:49', '2022-12-12 22:45:49'),
(108, 2, 5, 2, NULL, NULL, NULL, '2022-12-12 22:45:49', '2022-12-12 22:45:49'),
(109, 3, 3, 2, NULL, NULL, NULL, '2022-12-12 22:45:49', '2022-12-12 22:45:49'),
(110, 4, 4, 4, NULL, NULL, NULL, '2022-12-12 22:45:49', '2022-12-12 22:45:49'),
(111, 3, 6, 3, NULL, NULL, NULL, '2022-12-12 22:45:49', '2022-12-12 22:45:49'),
(112, 4, 6, 1, NULL, NULL, NULL, '2022-12-12 22:45:49', '2022-12-12 22:45:49'),
(113, 1, 5, 4, NULL, NULL, NULL, '2022-12-12 22:45:49', '2022-12-12 22:45:49'),
(114, 1, 4, 4, NULL, NULL, NULL, '2022-12-12 22:45:49', '2022-12-12 22:45:49'),
(115, 4, 4, 2, NULL, NULL, NULL, '2022-12-12 22:45:49', '2022-12-12 22:45:49'),
(116, 1, 4, 2, NULL, NULL, NULL, '2022-12-12 22:45:49', '2022-12-12 22:45:49'),
(117, 2, 3, 1, NULL, NULL, NULL, '2022-12-12 22:45:49', '2022-12-12 22:45:49'),
(118, 3, 6, 3, NULL, NULL, NULL, '2022-12-12 22:45:49', '2022-12-12 22:45:49'),
(119, 4, 4, 3, NULL, NULL, NULL, '2022-12-12 22:45:49', '2022-12-12 22:45:49'),
(120, 2, 6, 1, NULL, NULL, NULL, '2022-12-12 22:45:49', '2022-12-12 22:45:49'),
(121, 3, 4, 1, NULL, NULL, NULL, '2022-12-12 22:45:49', '2022-12-12 22:45:49'),
(122, 1, 5, 4, NULL, NULL, NULL, '2022-12-12 22:45:49', '2022-12-12 22:45:49'),
(123, 4, 4, 2, NULL, NULL, NULL, '2022-12-12 22:45:49', '2022-12-12 22:45:49'),
(124, 4, 6, 5, NULL, NULL, NULL, '2022-12-12 22:45:49', '2022-12-12 22:45:49'),
(125, 1, 5, 2, NULL, NULL, NULL, '2022-12-12 22:45:49', '2022-12-12 22:45:49'),
(126, 3, 5, 1, NULL, NULL, NULL, '2022-12-12 22:45:49', '2022-12-12 22:45:49'),
(127, 4, 5, 5, NULL, NULL, NULL, '2022-12-12 22:45:50', '2022-12-12 22:45:50'),
(128, 4, 5, 5, NULL, NULL, NULL, '2022-12-12 22:45:50', '2022-12-12 22:45:50'),
(129, 4, 5, 4, NULL, NULL, NULL, '2022-12-12 22:45:50', '2022-12-12 22:45:50'),
(130, 4, 3, 3, NULL, NULL, NULL, '2022-12-12 22:45:50', '2022-12-12 22:45:50'),
(131, 4, 4, 3, NULL, NULL, NULL, '2022-12-12 22:45:50', '2022-12-12 22:45:50'),
(132, 2, 6, 5, NULL, NULL, NULL, '2022-12-12 22:45:50', '2022-12-12 22:45:50'),
(133, 1, 4, 3, NULL, NULL, NULL, '2022-12-12 22:45:50', '2022-12-12 22:45:50'),
(134, 3, 5, 5, NULL, NULL, NULL, '2022-12-12 22:45:50', '2022-12-12 22:45:50'),
(135, 1, 3, 3, NULL, NULL, NULL, '2022-12-12 22:45:50', '2022-12-12 22:45:50'),
(136, 2, 4, 2, NULL, NULL, NULL, '2022-12-12 22:45:50', '2022-12-12 22:45:50'),
(137, 3, 4, 1, NULL, NULL, NULL, '2022-12-12 22:45:50', '2022-12-12 22:45:50'),
(138, 3, 3, 5, NULL, NULL, NULL, '2022-12-12 22:45:50', '2022-12-12 22:45:50'),
(139, 2, 4, 2, NULL, NULL, NULL, '2022-12-12 22:45:50', '2022-12-12 22:45:50'),
(140, 1, 3, 1, NULL, NULL, NULL, '2022-12-12 22:45:50', '2022-12-12 22:45:50'),
(141, 2, 5, 3, NULL, NULL, NULL, '2022-12-12 22:45:50', '2022-12-12 22:45:50'),
(142, 1, 5, 3, NULL, NULL, NULL, '2022-12-12 22:45:50', '2022-12-12 22:45:50'),
(143, 1, 5, 4, NULL, NULL, NULL, '2022-12-12 22:45:50', '2022-12-12 22:45:50'),
(144, 3, 4, 3, NULL, NULL, NULL, '2022-12-12 22:45:50', '2022-12-12 22:45:50'),
(145, 2, 3, 5, NULL, NULL, NULL, '2022-12-12 22:45:50', '2022-12-12 22:45:50'),
(146, 3, 6, 5, NULL, NULL, NULL, '2022-12-12 22:45:50', '2022-12-12 22:45:50'),
(147, 1, 4, 5, NULL, NULL, NULL, '2022-12-12 22:45:50', '2022-12-12 22:45:50'),
(148, 1, 4, 2, NULL, NULL, NULL, '2022-12-12 22:45:50', '2022-12-12 22:45:50'),
(149, 4, 6, 4, NULL, NULL, NULL, '2022-12-12 22:45:50', '2022-12-12 22:45:50'),
(150, 2, 6, 3, NULL, NULL, NULL, '2022-12-12 22:45:50', '2022-12-12 22:45:50'),
(151, 4, 3, 1, NULL, NULL, NULL, '2022-12-12 22:45:50', '2022-12-12 22:45:50'),
(152, 4, 6, 4, NULL, NULL, NULL, '2022-12-12 22:45:50', '2022-12-12 22:45:50'),
(153, 1, 5, 5, NULL, NULL, NULL, '2022-12-12 22:46:00', '2022-12-12 22:46:00'),
(154, 2, 4, 3, NULL, NULL, NULL, '2022-12-12 22:46:00', '2022-12-12 22:46:00'),
(155, 4, 5, 4, NULL, NULL, NULL, '2022-12-12 22:46:00', '2022-12-12 22:46:00'),
(156, 3, 6, 4, NULL, NULL, NULL, '2022-12-12 22:46:00', '2022-12-12 22:46:00'),
(157, 4, 4, 3, NULL, NULL, NULL, '2022-12-12 22:46:00', '2022-12-12 22:46:00'),
(158, 3, 3, 5, NULL, NULL, NULL, '2022-12-12 22:46:01', '2022-12-12 22:46:01'),
(159, 3, 5, 3, NULL, NULL, NULL, '2022-12-12 22:46:01', '2022-12-12 22:46:01'),
(160, 2, 4, 3, NULL, NULL, NULL, '2022-12-12 22:46:01', '2022-12-12 22:46:01'),
(161, 1, 6, 2, NULL, NULL, NULL, '2022-12-12 22:46:01', '2022-12-12 22:46:01'),
(162, 1, 3, 2, NULL, NULL, NULL, '2022-12-12 22:46:01', '2022-12-12 22:46:01'),
(163, 4, 5, 1, NULL, NULL, NULL, '2022-12-12 22:46:01', '2022-12-12 22:46:01'),
(164, 2, 4, 2, NULL, NULL, NULL, '2022-12-12 22:46:01', '2022-12-12 22:46:01'),
(165, 2, 3, 5, NULL, NULL, NULL, '2022-12-12 22:46:01', '2022-12-12 22:46:01'),
(166, 2, 5, 5, NULL, NULL, NULL, '2022-12-12 22:46:01', '2022-12-12 22:46:01'),
(167, 3, 4, 1, NULL, NULL, NULL, '2022-12-12 22:46:01', '2022-12-12 22:46:01'),
(168, 2, 4, 2, NULL, NULL, NULL, '2022-12-12 22:46:01', '2022-12-12 22:46:01'),
(169, 4, 5, 1, NULL, NULL, NULL, '2022-12-12 22:46:01', '2022-12-12 22:46:01'),
(170, 2, 5, 5, NULL, NULL, NULL, '2022-12-12 22:46:01', '2022-12-12 22:46:01'),
(171, 2, 6, 1, NULL, NULL, NULL, '2022-12-12 22:46:01', '2022-12-12 22:46:01'),
(172, 1, 4, 4, NULL, NULL, NULL, '2022-12-12 22:46:01', '2022-12-12 22:46:01'),
(173, 2, 5, 3, NULL, NULL, NULL, '2022-12-12 22:46:01', '2022-12-12 22:46:01'),
(174, 1, 3, 3, NULL, NULL, NULL, '2022-12-12 22:46:01', '2022-12-12 22:46:01'),
(175, 3, 3, 3, NULL, NULL, NULL, '2022-12-12 22:46:01', '2022-12-12 22:46:01'),
(176, 2, 4, 2, NULL, NULL, NULL, '2022-12-12 22:46:01', '2022-12-12 22:46:01'),
(177, 1, 6, 3, NULL, NULL, NULL, '2022-12-12 22:46:01', '2022-12-12 22:46:01'),
(178, 1, 6, 2, NULL, NULL, NULL, '2022-12-12 22:46:01', '2022-12-12 22:46:01'),
(179, 4, 6, 3, NULL, NULL, NULL, '2022-12-12 22:46:01', '2022-12-12 22:46:01'),
(180, 2, 4, 1, NULL, NULL, NULL, '2022-12-12 22:46:01', '2022-12-12 22:46:01'),
(181, 2, 5, 2, NULL, NULL, NULL, '2022-12-12 22:46:01', '2022-12-12 22:46:01'),
(182, 3, 3, 5, NULL, NULL, NULL, '2022-12-12 22:46:01', '2022-12-12 22:46:01'),
(183, 1, 3, 2, NULL, NULL, NULL, '2022-12-12 22:46:01', '2022-12-12 22:46:01'),
(184, 4, 5, 4, NULL, NULL, NULL, '2022-12-12 22:46:01', '2022-12-12 22:46:01'),
(185, 2, 3, 5, NULL, NULL, NULL, '2022-12-12 22:46:01', '2022-12-12 22:46:01'),
(186, 3, 3, 3, NULL, NULL, NULL, '2022-12-12 22:46:02', '2022-12-12 22:46:02'),
(187, 3, 5, 1, NULL, NULL, NULL, '2022-12-12 22:46:02', '2022-12-12 22:46:02'),
(188, 3, 3, 1, NULL, NULL, NULL, '2022-12-12 22:46:02', '2022-12-12 22:46:02'),
(189, 4, 4, 5, NULL, NULL, NULL, '2022-12-12 22:46:02', '2022-12-12 22:46:02'),
(190, 2, 5, 1, NULL, NULL, NULL, '2022-12-12 22:46:02', '2022-12-12 22:46:02'),
(191, 3, 6, 1, NULL, NULL, NULL, '2022-12-12 22:46:02', '2022-12-12 22:46:02'),
(192, 4, 6, 1, NULL, NULL, NULL, '2022-12-12 22:46:02', '2022-12-12 22:46:02'),
(193, 3, 4, 5, NULL, NULL, NULL, '2022-12-12 22:46:02', '2022-12-12 22:46:02'),
(194, 2, 4, 4, NULL, NULL, NULL, '2022-12-12 22:46:02', '2022-12-12 22:46:02'),
(195, 3, 5, 1, NULL, NULL, NULL, '2022-12-12 22:46:02', '2022-12-12 22:46:02'),
(196, 3, 5, 3, NULL, NULL, NULL, '2022-12-12 22:46:02', '2022-12-12 22:46:02'),
(197, 2, 5, 4, NULL, NULL, NULL, '2022-12-12 22:46:02', '2022-12-12 22:46:02'),
(198, 2, 4, 2, NULL, NULL, NULL, '2022-12-12 22:46:02', '2022-12-12 22:46:02'),
(199, 4, 3, 4, NULL, NULL, NULL, '2022-12-12 22:46:02', '2022-12-12 22:46:02'),
(200, 1, 5, 1, NULL, NULL, NULL, '2022-12-12 22:46:02', '2022-12-12 22:46:02'),
(201, 4, 3, 4, NULL, NULL, NULL, '2022-12-12 22:46:02', '2022-12-12 22:46:02'),
(202, 3, 5, 5, NULL, NULL, NULL, '2022-12-12 22:46:02', '2022-12-12 22:46:02'),
(203, 3, 4, 3, NULL, NULL, NULL, '2022-12-12 22:46:57', '2022-12-12 22:46:57'),
(204, 3, 3, 1, NULL, NULL, NULL, '2022-12-12 22:46:57', '2022-12-12 22:46:57'),
(205, 4, 6, 2, NULL, NULL, NULL, '2022-12-12 22:46:57', '2022-12-12 22:46:57'),
(206, 4, 6, 4, NULL, NULL, NULL, '2022-12-12 22:46:57', '2022-12-12 22:46:57'),
(207, 3, 3, 3, NULL, NULL, NULL, '2022-12-12 22:46:57', '2022-12-12 22:46:57'),
(208, 2, 4, 1, NULL, NULL, NULL, '2022-12-12 22:46:57', '2022-12-12 22:46:57'),
(209, 1, 5, 4, NULL, NULL, NULL, '2022-12-12 22:46:57', '2022-12-12 22:46:57'),
(210, 2, 3, 4, NULL, NULL, NULL, '2022-12-12 22:46:57', '2022-12-12 22:46:57'),
(211, 4, 3, 5, NULL, NULL, NULL, '2022-12-12 22:46:57', '2022-12-12 22:46:57'),
(212, 3, 4, 1, NULL, NULL, NULL, '2022-12-12 22:46:57', '2022-12-12 22:46:57'),
(213, 2, 5, 1, NULL, NULL, NULL, '2022-12-12 22:46:57', '2022-12-12 22:46:57'),
(214, 1, 3, 2, NULL, NULL, NULL, '2022-12-12 22:46:57', '2022-12-12 22:46:57'),
(215, 1, 6, 1, NULL, NULL, NULL, '2022-12-12 22:46:57', '2022-12-12 22:46:57'),
(216, 4, 3, 1, NULL, NULL, NULL, '2022-12-12 22:46:57', '2022-12-12 22:46:57'),
(217, 2, 3, 2, NULL, NULL, NULL, '2022-12-12 22:46:57', '2022-12-12 22:46:57'),
(218, 2, 4, 2, NULL, NULL, NULL, '2022-12-12 22:46:57', '2022-12-12 22:46:57'),
(219, 3, 6, 1, NULL, NULL, NULL, '2022-12-12 22:46:57', '2022-12-12 22:46:57'),
(220, 1, 5, 3, NULL, NULL, NULL, '2022-12-12 22:46:57', '2022-12-12 22:46:57'),
(221, 3, 6, 3, NULL, NULL, NULL, '2022-12-12 22:46:57', '2022-12-12 22:46:57'),
(222, 1, 3, 2, NULL, NULL, NULL, '2022-12-12 22:46:57', '2022-12-12 22:46:57'),
(223, 2, 4, 4, NULL, NULL, NULL, '2022-12-12 22:46:57', '2022-12-12 22:46:57'),
(224, 4, 3, 4, NULL, NULL, NULL, '2022-12-12 22:46:57', '2022-12-12 22:46:57'),
(225, 2, 3, 3, NULL, NULL, NULL, '2022-12-12 22:46:58', '2022-12-12 22:46:58'),
(226, 3, 3, 2, NULL, NULL, NULL, '2022-12-12 22:46:58', '2022-12-12 22:46:58'),
(227, 3, 3, 3, NULL, NULL, NULL, '2022-12-12 22:46:58', '2022-12-12 22:46:58'),
(228, 2, 3, 2, NULL, NULL, NULL, '2022-12-12 22:46:58', '2022-12-12 22:46:58'),
(229, 3, 4, 2, NULL, NULL, NULL, '2022-12-12 22:46:58', '2022-12-12 22:46:58'),
(230, 1, 5, 5, NULL, NULL, NULL, '2022-12-12 22:46:58', '2022-12-12 22:46:58'),
(231, 1, 4, 3, NULL, NULL, NULL, '2022-12-12 22:46:58', '2022-12-12 22:46:58'),
(232, 4, 3, 2, NULL, NULL, NULL, '2022-12-12 22:46:58', '2022-12-12 22:46:58'),
(233, 1, 6, 1, NULL, NULL, NULL, '2022-12-12 22:46:58', '2022-12-12 22:46:58'),
(234, 1, 6, 3, NULL, NULL, NULL, '2022-12-12 22:46:58', '2022-12-12 22:46:58'),
(235, 2, 5, 2, NULL, NULL, NULL, '2022-12-12 22:46:58', '2022-12-12 22:46:58'),
(236, 4, 4, 3, NULL, NULL, NULL, '2022-12-12 22:46:58', '2022-12-12 22:46:58'),
(237, 1, 4, 5, NULL, NULL, NULL, '2022-12-12 22:46:58', '2022-12-12 22:46:58'),
(238, 1, 3, 3, NULL, NULL, NULL, '2022-12-12 22:46:58', '2022-12-12 22:46:58'),
(239, 4, 5, 2, NULL, NULL, NULL, '2022-12-12 22:46:58', '2022-12-12 22:46:58'),
(240, 4, 4, 1, NULL, NULL, NULL, '2022-12-12 22:46:58', '2022-12-12 22:46:58'),
(241, 3, 4, 4, NULL, NULL, NULL, '2022-12-12 22:46:58', '2022-12-12 22:46:58'),
(242, 3, 6, 1, NULL, NULL, NULL, '2022-12-12 22:46:58', '2022-12-12 22:46:58'),
(243, 4, 6, 2, NULL, NULL, NULL, '2022-12-12 22:46:58', '2022-12-12 22:46:58'),
(244, 4, 5, 5, NULL, NULL, NULL, '2022-12-12 22:46:58', '2022-12-12 22:46:58'),
(245, 2, 3, 5, NULL, NULL, NULL, '2022-12-12 22:46:58', '2022-12-12 22:46:58'),
(246, 3, 3, 1, NULL, NULL, NULL, '2022-12-12 22:46:58', '2022-12-12 22:46:58'),
(247, 3, 3, 5, NULL, NULL, NULL, '2022-12-12 22:46:58', '2022-12-12 22:46:58'),
(248, 2, 4, 4, NULL, NULL, NULL, '2022-12-12 22:46:58', '2022-12-12 22:46:58'),
(249, 3, 6, 2, NULL, NULL, NULL, '2022-12-12 22:46:58', '2022-12-12 22:46:58'),
(250, 4, 6, 3, NULL, NULL, NULL, '2022-12-12 22:46:58', '2022-12-12 22:46:58'),
(251, 3, 3, 2, NULL, NULL, NULL, '2022-12-12 22:46:58', '2022-12-12 22:46:58'),
(252, 4, 6, 1, NULL, NULL, NULL, '2022-12-12 22:46:58', '2022-12-12 22:46:58'),
(253, 4, 3, 5, NULL, NULL, NULL, '2022-12-12 22:46:58', '2022-12-12 22:46:58'),
(254, 2, 4, 5, NULL, NULL, NULL, '2022-12-12 22:46:58', '2022-12-12 22:46:58'),
(255, 2, 3, 4, NULL, NULL, NULL, '2022-12-12 22:46:58', '2022-12-12 22:46:58'),
(256, 2, 6, 2, NULL, NULL, NULL, '2022-12-12 22:46:59', '2022-12-12 22:46:59'),
(257, 1, 4, 2, NULL, NULL, NULL, '2022-12-12 22:46:59', '2022-12-12 22:46:59'),
(258, 4, 3, 3, NULL, NULL, NULL, '2022-12-12 22:46:59', '2022-12-12 22:46:59'),
(259, 4, 5, 3, NULL, NULL, NULL, '2022-12-12 22:46:59', '2022-12-12 22:46:59'),
(260, 4, 4, 5, NULL, NULL, NULL, '2022-12-12 22:46:59', '2022-12-12 22:46:59'),
(261, 1, 6, 4, NULL, NULL, NULL, '2022-12-12 22:46:59', '2022-12-12 22:46:59'),
(262, 4, 5, 4, NULL, NULL, NULL, '2022-12-12 22:46:59', '2022-12-12 22:46:59'),
(263, 2, 5, 4, NULL, NULL, NULL, '2022-12-12 22:46:59', '2022-12-12 22:46:59'),
(264, 1, 6, 4, NULL, NULL, NULL, '2022-12-12 22:46:59', '2022-12-12 22:46:59'),
(265, 4, 6, 5, NULL, NULL, NULL, '2022-12-12 22:46:59', '2022-12-12 22:46:59'),
(266, 2, 6, 3, NULL, NULL, NULL, '2022-12-12 22:46:59', '2022-12-12 22:46:59'),
(267, 3, 3, 1, NULL, NULL, NULL, '2022-12-12 22:46:59', '2022-12-12 22:46:59'),
(268, 3, 4, 4, NULL, NULL, NULL, '2022-12-12 22:46:59', '2022-12-12 22:46:59'),
(269, 2, 3, 1, NULL, NULL, NULL, '2022-12-12 22:46:59', '2022-12-12 22:46:59'),
(270, 4, 6, 3, NULL, NULL, NULL, '2022-12-12 22:46:59', '2022-12-12 22:46:59'),
(271, 3, 4, 1, NULL, NULL, NULL, '2022-12-12 22:46:59', '2022-12-12 22:46:59'),
(272, 4, 6, 2, NULL, NULL, NULL, '2022-12-12 22:46:59', '2022-12-12 22:46:59'),
(273, 3, 6, 3, NULL, NULL, NULL, '2022-12-12 22:46:59', '2022-12-12 22:46:59'),
(274, 4, 6, 5, NULL, NULL, NULL, '2022-12-12 22:46:59', '2022-12-12 22:46:59'),
(275, 1, 6, 3, NULL, NULL, NULL, '2022-12-12 22:46:59', '2022-12-12 22:46:59'),
(276, 3, 4, 3, NULL, NULL, NULL, '2022-12-12 22:46:59', '2022-12-12 22:46:59'),
(277, 4, 5, 2, NULL, NULL, NULL, '2022-12-12 22:46:59', '2022-12-12 22:46:59'),
(278, 4, 6, 2, NULL, NULL, NULL, '2022-12-12 22:46:59', '2022-12-12 22:46:59'),
(279, 4, 3, 3, NULL, NULL, NULL, '2022-12-12 22:46:59', '2022-12-12 22:46:59'),
(280, 4, 6, 2, NULL, NULL, NULL, '2022-12-12 22:46:59', '2022-12-12 22:46:59'),
(281, 3, 5, 4, NULL, NULL, NULL, '2022-12-12 22:46:59', '2022-12-12 22:46:59'),
(282, 1, 5, 5, NULL, NULL, NULL, '2022-12-12 22:46:59', '2022-12-12 22:46:59'),
(283, 3, 5, 2, NULL, NULL, NULL, '2022-12-12 22:46:59', '2022-12-12 22:46:59'),
(284, 4, 5, 5, NULL, NULL, NULL, '2022-12-12 22:46:59', '2022-12-12 22:46:59'),
(285, 4, 3, 4, NULL, NULL, NULL, '2022-12-12 22:46:59', '2022-12-12 22:46:59'),
(286, 4, 4, 5, NULL, NULL, NULL, '2022-12-12 22:46:59', '2022-12-12 22:46:59'),
(287, 2, 4, 4, NULL, NULL, NULL, '2022-12-12 22:46:59', '2022-12-12 22:46:59'),
(288, 4, 3, 1, NULL, NULL, NULL, '2022-12-12 22:46:59', '2022-12-12 22:46:59'),
(289, 3, 6, 4, NULL, NULL, NULL, '2022-12-12 22:46:59', '2022-12-12 22:46:59'),
(290, 3, 3, 1, NULL, NULL, NULL, '2022-12-12 22:46:59', '2022-12-12 22:46:59'),
(291, 2, 6, 2, NULL, NULL, NULL, '2022-12-12 22:46:59', '2022-12-12 22:46:59'),
(292, 1, 6, 3, NULL, NULL, NULL, '2022-12-12 22:47:00', '2022-12-12 22:47:00'),
(293, 1, 4, 5, NULL, NULL, NULL, '2022-12-12 22:47:00', '2022-12-12 22:47:00'),
(294, 2, 4, 2, NULL, NULL, NULL, '2022-12-12 22:47:00', '2022-12-12 22:47:00'),
(295, 4, 6, 3, NULL, NULL, NULL, '2022-12-12 22:47:00', '2022-12-12 22:47:00'),
(296, 4, 3, 3, NULL, NULL, NULL, '2022-12-12 22:47:00', '2022-12-12 22:47:00'),
(297, 4, 4, 4, NULL, NULL, NULL, '2022-12-12 22:47:00', '2022-12-12 22:47:00'),
(298, 1, 4, 2, NULL, NULL, NULL, '2022-12-12 22:47:00', '2022-12-12 22:47:00'),
(299, 1, 6, 2, NULL, NULL, NULL, '2022-12-12 22:47:00', '2022-12-12 22:47:00'),
(300, 1, 4, 2, NULL, NULL, NULL, '2022-12-12 22:47:00', '2022-12-12 22:47:00'),
(301, 2, 4, 5, NULL, NULL, NULL, '2022-12-12 22:47:00', '2022-12-12 22:47:00'),
(302, 3, 6, 3, NULL, NULL, NULL, '2022-12-12 22:47:00', '2022-12-12 22:47:00'),
(303, 4, 3, 1, NULL, NULL, NULL, '2022-12-12 22:47:00', '2022-12-12 22:47:00'),
(304, 4, 4, 2, NULL, NULL, NULL, '2022-12-12 22:47:00', '2022-12-12 22:47:00'),
(305, 3, 3, 2, NULL, NULL, NULL, '2022-12-12 22:47:00', '2022-12-12 22:47:00'),
(306, 4, 4, 2, NULL, NULL, NULL, '2022-12-12 22:47:00', '2022-12-12 22:47:00'),
(307, 1, 5, 2, NULL, NULL, NULL, '2022-12-12 22:47:00', '2022-12-12 22:47:00'),
(308, 1, 5, 4, NULL, NULL, NULL, '2022-12-12 22:47:00', '2022-12-12 22:47:00'),
(309, 2, 4, 4, NULL, NULL, NULL, '2022-12-12 22:47:00', '2022-12-12 22:47:00'),
(310, 2, 3, 5, NULL, NULL, NULL, '2022-12-12 22:47:00', '2022-12-12 22:47:00'),
(311, 1, 5, 5, NULL, NULL, NULL, '2022-12-12 22:47:00', '2022-12-12 22:47:00'),
(312, 4, 3, 4, NULL, NULL, NULL, '2022-12-12 22:47:00', '2022-12-12 22:47:00'),
(313, 3, 5, 4, NULL, NULL, NULL, '2022-12-12 22:47:00', '2022-12-12 22:47:00'),
(314, 2, 3, 2, NULL, NULL, NULL, '2022-12-12 22:47:00', '2022-12-12 22:47:00'),
(315, 2, 6, 3, NULL, NULL, NULL, '2022-12-12 22:47:00', '2022-12-12 22:47:00'),
(316, 3, 6, 1, NULL, NULL, NULL, '2022-12-12 22:47:00', '2022-12-12 22:47:00'),
(317, 3, 3, 2, NULL, NULL, NULL, '2022-12-12 22:47:00', '2022-12-12 22:47:00'),
(318, 1, 6, 1, NULL, NULL, NULL, '2022-12-12 22:47:00', '2022-12-12 22:47:00'),
(319, 3, 3, 3, NULL, NULL, NULL, '2022-12-12 22:47:00', '2022-12-12 22:47:00'),
(320, 4, 5, 3, NULL, NULL, NULL, '2022-12-12 22:47:01', '2022-12-12 22:47:01'),
(321, 1, 5, 1, NULL, NULL, NULL, '2022-12-12 22:47:01', '2022-12-12 22:47:01'),
(322, 1, 6, 2, NULL, NULL, NULL, '2022-12-12 22:47:01', '2022-12-12 22:47:01'),
(323, 1, 5, 2, NULL, NULL, NULL, '2022-12-12 22:47:01', '2022-12-12 22:47:01'),
(324, 3, 4, 1, NULL, NULL, NULL, '2022-12-12 22:47:01', '2022-12-12 22:47:01'),
(325, 1, 4, 3, NULL, NULL, NULL, '2022-12-12 22:47:01', '2022-12-12 22:47:01'),
(326, 1, 4, 1, NULL, NULL, NULL, '2022-12-12 22:47:01', '2022-12-12 22:47:01'),
(327, 4, 6, 4, NULL, NULL, NULL, '2022-12-12 22:47:01', '2022-12-12 22:47:01'),
(328, 1, 4, 3, NULL, NULL, NULL, '2022-12-12 22:47:01', '2022-12-12 22:47:01'),
(329, 2, 4, 4, NULL, NULL, NULL, '2022-12-12 22:47:01', '2022-12-12 22:47:01'),
(330, 1, 6, 3, NULL, NULL, NULL, '2022-12-12 22:47:01', '2022-12-12 22:47:01'),
(331, 3, 4, 5, NULL, NULL, NULL, '2022-12-12 22:47:01', '2022-12-12 22:47:01'),
(332, 1, 5, 3, NULL, NULL, NULL, '2022-12-12 22:47:01', '2022-12-12 22:47:01'),
(333, 2, 5, 4, NULL, NULL, NULL, '2022-12-12 22:47:01', '2022-12-12 22:47:01'),
(334, 3, 3, 3, NULL, NULL, NULL, '2022-12-12 22:47:01', '2022-12-12 22:47:01'),
(335, 1, 6, 1, NULL, NULL, NULL, '2022-12-12 22:47:01', '2022-12-12 22:47:01'),
(336, 1, 5, 2, NULL, NULL, NULL, '2022-12-12 22:47:01', '2022-12-12 22:47:01'),
(337, 2, 3, 1, NULL, NULL, NULL, '2022-12-12 22:47:01', '2022-12-12 22:47:01'),
(338, 4, 3, 2, NULL, NULL, NULL, '2022-12-12 22:47:01', '2022-12-12 22:47:01'),
(339, 3, 6, 4, NULL, NULL, NULL, '2022-12-12 22:47:01', '2022-12-12 22:47:01'),
(340, 2, 3, 4, NULL, NULL, NULL, '2022-12-12 22:47:01', '2022-12-12 22:47:01'),
(341, 1, 4, 5, NULL, NULL, NULL, '2022-12-12 22:47:01', '2022-12-12 22:47:01'),
(342, 3, 3, 2, NULL, NULL, NULL, '2022-12-12 22:47:01', '2022-12-12 22:47:01'),
(343, 1, 6, 2, NULL, NULL, NULL, '2022-12-12 22:47:01', '2022-12-12 22:47:01'),
(344, 3, 3, 2, NULL, NULL, NULL, '2022-12-12 22:47:01', '2022-12-12 22:47:01'),
(345, 4, 6, 2, NULL, NULL, NULL, '2022-12-12 22:47:01', '2022-12-12 22:47:01'),
(346, 1, 4, 1, NULL, NULL, NULL, '2022-12-12 22:47:01', '2022-12-12 22:47:01'),
(347, 4, 4, 5, NULL, NULL, NULL, '2022-12-12 22:47:01', '2022-12-12 22:47:01'),
(348, 3, 3, 2, NULL, NULL, NULL, '2022-12-12 22:47:01', '2022-12-12 22:47:01'),
(349, 4, 3, 3, NULL, NULL, NULL, '2022-12-12 22:47:01', '2022-12-12 22:47:01'),
(350, 1, 5, 4, NULL, NULL, NULL, '2022-12-12 22:47:01', '2022-12-12 22:47:01'),
(351, 2, 4, 3, NULL, NULL, NULL, '2022-12-12 22:47:01', '2022-12-12 22:47:01'),
(352, 1, 3, 1, NULL, NULL, NULL, '2022-12-12 22:47:01', '2022-12-12 22:47:01'),
(353, 1, 5, 4, NULL, NULL, NULL, '2022-12-12 22:47:01', '2022-12-12 22:47:01'),
(354, 3, 3, 5, NULL, NULL, NULL, '2022-12-12 22:47:01', '2022-12-12 22:47:01'),
(355, 3, 4, 5, NULL, NULL, NULL, '2022-12-12 22:47:02', '2022-12-12 22:47:02'),
(356, 2, 3, 4, NULL, NULL, NULL, '2022-12-12 22:47:02', '2022-12-12 22:47:02'),
(357, 3, 6, 4, NULL, NULL, NULL, '2022-12-12 22:47:02', '2022-12-12 22:47:02'),
(358, 3, 5, 4, NULL, NULL, NULL, '2022-12-12 22:47:02', '2022-12-12 22:47:02'),
(359, 2, 4, 3, NULL, NULL, NULL, '2022-12-12 22:47:02', '2022-12-12 22:47:02'),
(360, 1, 3, 5, NULL, NULL, NULL, '2022-12-12 22:47:02', '2022-12-12 22:47:02'),
(361, 4, 5, 4, NULL, NULL, NULL, '2022-12-12 22:47:02', '2022-12-12 22:47:02'),
(362, 4, 5, 5, NULL, NULL, NULL, '2022-12-12 22:47:02', '2022-12-12 22:47:02'),
(363, 1, 5, 3, NULL, NULL, NULL, '2022-12-12 22:47:02', '2022-12-12 22:47:02'),
(364, 2, 3, 1, NULL, NULL, NULL, '2022-12-12 22:47:02', '2022-12-12 22:47:02'),
(365, 1, 5, 4, NULL, NULL, NULL, '2022-12-12 22:47:02', '2022-12-12 22:47:02'),
(366, 1, 6, 1, NULL, NULL, NULL, '2022-12-12 22:47:02', '2022-12-12 22:47:02'),
(367, 4, 4, 2, NULL, NULL, NULL, '2022-12-12 22:47:02', '2022-12-12 22:47:02'),
(368, 3, 6, 3, NULL, NULL, NULL, '2022-12-12 22:47:02', '2022-12-12 22:47:02'),
(369, 2, 4, 4, NULL, NULL, NULL, '2022-12-12 22:47:02', '2022-12-12 22:47:02'),
(370, 4, 4, 3, NULL, NULL, NULL, '2022-12-12 22:47:02', '2022-12-12 22:47:02'),
(371, 3, 5, 5, NULL, NULL, NULL, '2022-12-12 22:47:02', '2022-12-12 22:47:02'),
(372, 2, 3, 1, NULL, NULL, NULL, '2022-12-12 22:47:02', '2022-12-12 22:47:02'),
(373, 1, 5, 3, NULL, NULL, NULL, '2022-12-12 22:47:02', '2022-12-12 22:47:02'),
(374, 1, 4, 4, NULL, NULL, NULL, '2022-12-12 22:47:02', '2022-12-12 22:47:02'),
(375, 4, 4, 5, NULL, NULL, NULL, '2022-12-12 22:47:02', '2022-12-12 22:47:02'),
(376, 1, 3, 3, NULL, NULL, NULL, '2022-12-12 22:47:02', '2022-12-12 22:47:02'),
(377, 1, 4, 4, NULL, NULL, NULL, '2022-12-12 22:47:02', '2022-12-12 22:47:02'),
(378, 1, 3, 3, NULL, NULL, NULL, '2022-12-12 22:47:02', '2022-12-12 22:47:02'),
(379, 4, 4, 3, NULL, NULL, NULL, '2022-12-12 22:47:02', '2022-12-12 22:47:02'),
(380, 4, 5, 3, NULL, NULL, NULL, '2022-12-12 22:47:02', '2022-12-12 22:47:02'),
(381, 4, 4, 5, NULL, NULL, NULL, '2022-12-12 22:47:02', '2022-12-12 22:47:02'),
(382, 3, 6, 2, NULL, NULL, NULL, '2022-12-12 22:47:02', '2022-12-12 22:47:02'),
(383, 3, 3, 2, NULL, NULL, NULL, '2022-12-12 22:47:02', '2022-12-12 22:47:02'),
(384, 3, 3, 3, NULL, NULL, NULL, '2022-12-12 22:47:03', '2022-12-12 22:47:03'),
(385, 1, 5, 2, NULL, NULL, NULL, '2022-12-12 22:47:03', '2022-12-12 22:47:03'),
(386, 1, 4, 4, NULL, NULL, NULL, '2022-12-12 22:47:03', '2022-12-12 22:47:03'),
(387, 4, 4, 1, NULL, NULL, NULL, '2022-12-12 22:47:03', '2022-12-12 22:47:03'),
(388, 3, 5, 4, NULL, NULL, NULL, '2022-12-12 22:47:03', '2022-12-12 22:47:03'),
(389, 2, 4, 5, NULL, NULL, NULL, '2022-12-12 22:47:03', '2022-12-12 22:47:03'),
(390, 4, 6, 3, NULL, NULL, NULL, '2022-12-12 22:47:03', '2022-12-12 22:47:03'),
(391, 1, 3, 4, NULL, NULL, NULL, '2022-12-12 22:47:03', '2022-12-12 22:47:03'),
(392, 1, 6, 5, NULL, NULL, NULL, '2022-12-12 22:47:03', '2022-12-12 22:47:03'),
(393, 4, 4, 1, NULL, NULL, NULL, '2022-12-12 22:47:03', '2022-12-12 22:47:03'),
(394, 1, 4, 4, NULL, NULL, NULL, '2022-12-12 22:47:03', '2022-12-12 22:47:03'),
(395, 4, 6, 2, NULL, NULL, NULL, '2022-12-12 22:47:03', '2022-12-12 22:47:03'),
(396, 4, 4, 1, NULL, NULL, NULL, '2022-12-12 22:47:03', '2022-12-12 22:47:03'),
(397, 2, 6, 5, NULL, NULL, NULL, '2022-12-12 22:47:03', '2022-12-12 22:47:03'),
(398, 1, 3, 4, NULL, NULL, NULL, '2022-12-12 22:47:03', '2022-12-12 22:47:03'),
(399, 2, 4, 3, NULL, NULL, NULL, '2022-12-12 22:47:03', '2022-12-12 22:47:03'),
(400, 1, 5, 5, NULL, NULL, NULL, '2022-12-12 22:47:03', '2022-12-12 22:47:03'),
(401, 3, 5, 5, NULL, NULL, NULL, '2022-12-12 22:47:03', '2022-12-12 22:47:03'),
(402, 1, 3, 2, NULL, NULL, NULL, '2022-12-12 22:47:03', '2022-12-12 22:47:03'),
(403, 2, 4, 1, NULL, NULL, NULL, '2022-12-12 22:47:03', '2022-12-12 22:47:03'),
(404, 4, 4, 3, NULL, NULL, NULL, '2022-12-12 22:47:03', '2022-12-12 22:47:03'),
(405, 1, 6, 4, NULL, NULL, NULL, '2022-12-12 22:47:03', '2022-12-12 22:47:03'),
(406, 1, 5, 3, NULL, NULL, NULL, '2022-12-12 22:47:03', '2022-12-12 22:47:03'),
(407, 3, 6, 1, NULL, NULL, NULL, '2022-12-12 22:47:03', '2022-12-12 22:47:03'),
(408, 1, 4, 3, NULL, NULL, NULL, '2022-12-12 22:47:03', '2022-12-12 22:47:03'),
(409, 3, 6, 5, NULL, NULL, NULL, '2022-12-12 22:47:03', '2022-12-12 22:47:03'),
(410, 4, 6, 5, NULL, NULL, NULL, '2022-12-12 22:47:03', '2022-12-12 22:47:03'),
(411, 1, 3, 2, NULL, NULL, NULL, '2022-12-12 22:47:03', '2022-12-12 22:47:03'),
(412, 1, 5, 5, NULL, NULL, NULL, '2022-12-12 22:47:03', '2022-12-12 22:47:03'),
(413, 4, 5, 5, NULL, NULL, NULL, '2022-12-12 22:47:03', '2022-12-12 22:47:03'),
(414, 1, 4, 3, NULL, NULL, NULL, '2022-12-12 22:47:03', '2022-12-12 22:47:03'),
(415, 2, 5, 1, NULL, NULL, NULL, '2022-12-12 22:47:03', '2022-12-12 22:47:03'),
(416, 2, 3, 2, NULL, NULL, NULL, '2022-12-12 22:47:03', '2022-12-12 22:47:03'),
(417, 2, 5, 5, NULL, NULL, NULL, '2022-12-12 22:47:03', '2022-12-12 22:47:03'),
(418, 4, 4, 5, NULL, NULL, NULL, '2022-12-12 22:47:03', '2022-12-12 22:47:03'),
(419, 1, 3, 2, NULL, NULL, NULL, '2022-12-12 22:47:03', '2022-12-12 22:47:03'),
(420, 2, 3, 5, NULL, NULL, NULL, '2022-12-12 22:47:03', '2022-12-12 22:47:03'),
(421, 2, 6, 1, NULL, NULL, NULL, '2022-12-12 22:47:04', '2022-12-12 22:47:04'),
(422, 2, 5, 3, NULL, NULL, NULL, '2022-12-12 22:47:04', '2022-12-12 22:47:04'),
(423, 1, 5, 2, NULL, NULL, NULL, '2022-12-12 22:47:04', '2022-12-12 22:47:04'),
(424, 2, 5, 1, NULL, NULL, NULL, '2022-12-12 22:47:04', '2022-12-12 22:47:04'),
(425, 1, 5, 5, NULL, NULL, NULL, '2022-12-12 22:47:04', '2022-12-12 22:47:04'),
(426, 1, 6, 3, NULL, NULL, NULL, '2022-12-12 22:47:04', '2022-12-12 22:47:04'),
(427, 1, 3, 1, NULL, NULL, NULL, '2022-12-12 22:47:04', '2022-12-12 22:47:04'),
(428, 3, 4, 4, NULL, NULL, NULL, '2022-12-12 22:47:04', '2022-12-12 22:47:04'),
(429, 1, 5, 3, NULL, NULL, NULL, '2022-12-12 22:47:04', '2022-12-12 22:47:04'),
(430, 2, 3, 2, NULL, NULL, NULL, '2022-12-12 22:47:04', '2022-12-12 22:47:04'),
(431, 2, 3, 5, NULL, NULL, NULL, '2022-12-12 22:47:04', '2022-12-12 22:47:04'),
(432, 4, 6, 1, NULL, NULL, NULL, '2022-12-12 22:47:04', '2022-12-12 22:47:04'),
(433, 1, 4, 4, NULL, NULL, NULL, '2022-12-12 22:47:04', '2022-12-12 22:47:04'),
(434, 3, 3, 1, NULL, NULL, NULL, '2022-12-12 22:47:04', '2022-12-12 22:47:04'),
(435, 2, 3, 4, NULL, NULL, NULL, '2022-12-12 22:47:04', '2022-12-12 22:47:04'),
(436, 1, 5, 1, NULL, NULL, NULL, '2022-12-12 22:47:04', '2022-12-12 22:47:04'),
(437, 1, 3, 2, NULL, NULL, NULL, '2022-12-12 22:47:04', '2022-12-12 22:47:04'),
(438, 4, 6, 1, NULL, NULL, NULL, '2022-12-12 22:47:04', '2022-12-12 22:47:04'),
(439, 2, 5, 1, NULL, NULL, NULL, '2022-12-12 22:47:04', '2022-12-12 22:47:04'),
(440, 1, 5, 1, NULL, NULL, NULL, '2022-12-12 22:47:04', '2022-12-12 22:47:04'),
(441, 3, 5, 3, NULL, NULL, NULL, '2022-12-12 22:47:04', '2022-12-12 22:47:04'),
(442, 4, 5, 3, NULL, NULL, NULL, '2022-12-12 22:47:04', '2022-12-12 22:47:04'),
(443, 4, 6, 4, NULL, NULL, NULL, '2022-12-12 22:47:04', '2022-12-12 22:47:04'),
(444, 3, 3, 3, NULL, NULL, NULL, '2022-12-12 22:47:04', '2022-12-12 22:47:04'),
(445, 3, 6, 5, NULL, NULL, NULL, '2022-12-12 22:47:04', '2022-12-12 22:47:04'),
(446, 4, 5, 3, NULL, NULL, NULL, '2022-12-12 22:47:04', '2022-12-12 22:47:04'),
(447, 1, 6, 3, NULL, NULL, NULL, '2022-12-12 22:47:04', '2022-12-12 22:47:04'),
(448, 4, 5, 5, NULL, NULL, NULL, '2022-12-12 22:47:04', '2022-12-12 22:47:04'),
(449, 2, 4, 4, NULL, NULL, NULL, '2022-12-12 22:47:04', '2022-12-12 22:47:04'),
(450, 4, 4, 3, NULL, NULL, NULL, '2022-12-12 22:47:04', '2022-12-12 22:47:04'),
(451, 1, 3, 3, NULL, NULL, NULL, '2022-12-12 22:47:04', '2022-12-12 22:47:04'),
(452, 2, 6, 3, NULL, NULL, NULL, '2022-12-12 22:47:04', '2022-12-12 22:47:04'),
(453, 1, 6, 1, NULL, NULL, NULL, '2022-12-12 22:47:04', '2022-12-12 22:47:04'),
(454, 3, 5, 2, NULL, NULL, NULL, '2022-12-12 22:47:04', '2022-12-12 22:47:04'),
(455, 1, 6, 5, NULL, NULL, NULL, '2022-12-12 22:47:05', '2022-12-12 22:47:05'),
(456, 1, 4, 4, NULL, NULL, NULL, '2022-12-12 22:47:05', '2022-12-12 22:47:05'),
(457, 3, 4, 5, NULL, NULL, NULL, '2022-12-12 22:47:05', '2022-12-12 22:47:05'),
(458, 1, 6, 1, NULL, NULL, NULL, '2022-12-12 22:47:05', '2022-12-12 22:47:05'),
(459, 4, 3, 4, NULL, NULL, NULL, '2022-12-12 22:47:05', '2022-12-12 22:47:05'),
(460, 3, 4, 1, NULL, NULL, NULL, '2022-12-12 22:47:05', '2022-12-12 22:47:05'),
(461, 1, 3, 3, NULL, NULL, NULL, '2022-12-12 22:47:05', '2022-12-12 22:47:05'),
(462, 4, 5, 5, NULL, NULL, NULL, '2022-12-12 22:47:05', '2022-12-12 22:47:05'),
(463, 3, 4, 3, NULL, NULL, NULL, '2022-12-12 22:47:05', '2022-12-12 22:47:05'),
(464, 2, 6, 4, NULL, NULL, NULL, '2022-12-12 22:47:05', '2022-12-12 22:47:05'),
(465, 2, 6, 1, NULL, NULL, NULL, '2022-12-12 22:47:05', '2022-12-12 22:47:05'),
(466, 4, 3, 1, NULL, NULL, NULL, '2022-12-12 22:47:05', '2022-12-12 22:47:05'),
(467, 1, 4, 4, NULL, NULL, NULL, '2022-12-12 22:47:05', '2022-12-12 22:47:05'),
(468, 4, 5, 4, NULL, NULL, NULL, '2022-12-12 22:47:05', '2022-12-12 22:47:05'),
(469, 3, 5, 5, NULL, NULL, NULL, '2022-12-12 22:47:05', '2022-12-12 22:47:05'),
(470, 2, 5, 5, NULL, NULL, NULL, '2022-12-12 22:47:05', '2022-12-12 22:47:05'),
(471, 4, 4, 3, NULL, NULL, NULL, '2022-12-12 22:47:05', '2022-12-12 22:47:05'),
(472, 2, 6, 3, NULL, NULL, NULL, '2022-12-12 22:47:05', '2022-12-12 22:47:05'),
(473, 2, 3, 2, NULL, NULL, NULL, '2022-12-12 22:47:05', '2022-12-12 22:47:05'),
(474, 2, 3, 2, NULL, NULL, NULL, '2022-12-12 22:47:05', '2022-12-12 22:47:05'),
(475, 2, 6, 4, NULL, NULL, NULL, '2022-12-12 22:47:05', '2022-12-12 22:47:05'),
(476, 1, 5, 2, NULL, NULL, NULL, '2022-12-12 22:47:05', '2022-12-12 22:47:05'),
(477, 2, 6, 5, NULL, NULL, NULL, '2022-12-12 22:47:05', '2022-12-12 22:47:05'),
(478, 3, 4, 1, NULL, NULL, NULL, '2022-12-12 22:47:05', '2022-12-12 22:47:05'),
(479, 3, 4, 2, NULL, NULL, NULL, '2022-12-12 22:47:05', '2022-12-12 22:47:05'),
(480, 1, 3, 3, NULL, NULL, NULL, '2022-12-12 22:47:05', '2022-12-12 22:47:05'),
(481, 2, 3, 1, NULL, NULL, NULL, '2022-12-12 22:47:05', '2022-12-12 22:47:05'),
(482, 1, 5, 3, NULL, NULL, NULL, '2022-12-12 22:47:05', '2022-12-12 22:47:05'),
(483, 2, 3, 2, NULL, NULL, NULL, '2022-12-12 22:47:05', '2022-12-12 22:47:05'),
(484, 3, 3, 1, NULL, NULL, NULL, '2022-12-12 22:47:05', '2022-12-12 22:47:05'),
(485, 2, 4, 3, NULL, NULL, NULL, '2022-12-12 22:47:05', '2022-12-12 22:47:05'),
(486, 4, 3, 5, NULL, NULL, NULL, '2022-12-12 22:47:05', '2022-12-12 22:47:05'),
(487, 4, 5, 1, NULL, NULL, NULL, '2022-12-12 22:47:05', '2022-12-12 22:47:05'),
(488, 3, 5, 1, NULL, NULL, NULL, '2022-12-12 22:47:06', '2022-12-12 22:47:06'),
(489, 3, 4, 4, NULL, NULL, NULL, '2022-12-12 22:47:06', '2022-12-12 22:47:06'),
(490, 2, 4, 5, NULL, NULL, NULL, '2022-12-12 22:47:06', '2022-12-12 22:47:06'),
(491, 2, 3, 3, NULL, NULL, NULL, '2022-12-12 22:47:06', '2022-12-12 22:47:06'),
(492, 4, 3, 5, NULL, NULL, NULL, '2022-12-12 22:47:06', '2022-12-12 22:47:06'),
(493, 3, 4, 3, NULL, NULL, NULL, '2022-12-12 22:47:06', '2022-12-12 22:47:06'),
(494, 2, 4, 4, NULL, NULL, NULL, '2022-12-12 22:47:06', '2022-12-12 22:47:06'),
(495, 3, 3, 2, NULL, NULL, NULL, '2022-12-12 22:47:06', '2022-12-12 22:47:06'),
(496, 4, 3, 4, NULL, NULL, NULL, '2022-12-12 22:47:06', '2022-12-12 22:47:06'),
(497, 1, 6, 4, NULL, NULL, NULL, '2022-12-12 22:47:06', '2022-12-12 22:47:06'),
(498, 3, 4, 4, NULL, NULL, NULL, '2022-12-12 22:47:06', '2022-12-12 22:47:06'),
(499, 1, 3, 1, NULL, NULL, NULL, '2022-12-12 22:47:06', '2022-12-12 22:47:06'),
(500, 4, 4, 3, NULL, NULL, NULL, '2022-12-12 22:47:06', '2022-12-12 22:47:06'),
(501, 36, 4, 5, 'Sohammmmmmmmmm', NULL, NULL, '2023-02-21 07:32:04', '2023-02-21 07:33:27');

-- --------------------------------------------------------

--
-- Table structure for table `sports`
--

CREATE TABLE `sports` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `is_available` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1=yes,2=no',
  `is_deleted` tinyint(4) NOT NULL DEFAULT 2 COMMENT '1=yes,2=no',
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sports`
--

INSERT INTO `sports` (`id`, `name`, `image`, `is_available`, `is_deleted`, `created_at`, `updated_at`) VALUES
(6, 'Soccer', 'sport-7424.png', 1, 2, '2023-02-20 03:35:39', '2023-02-20 03:35:39'),
(7, 'Golf', 'sport-3424.png', 1, 2, '2023-02-20 03:35:56', '2023-02-20 03:35:56'),
(8, 'Basketball', 'sport-9595.png', 1, 2, '2023-02-20 03:37:44', '2023-02-20 03:37:44'),
(9, 'Cricket', 'sport-1841.png', 1, 2, '2023-02-20 03:41:14', '2023-02-20 03:41:14'),
(10, 'Vollyball', 'sport-2840.png', 1, 2, '2023-02-20 03:43:02', '2023-02-20 03:43:02');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `vendor_id` int(11) NOT NULL,
  `dome_id` int(11) NOT NULL,
  `field_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `booking_id` int(11) NOT NULL,
  `payment_method` int(11) NOT NULL DEFAULT 1 COMMENT '1=Card, 2=Apple Pay, 3=Google Pay	',
  `transaction_id` varchar(255) NOT NULL,
  `amount` double(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `vendor_id`, `dome_id`, `field_id`, `user_id`, `booking_id`, `payment_method`, `transaction_id`, `amount`, `created_at`, `updated_at`) VALUES
(1, 2, 3, 3, 3, 344745, 2, 'OI3v7zGMF7', 21.00, '2022-12-12 19:06:01', '2022-12-12 19:06:01'),
(2, 2, 4, 1, 3, 643111, 2, 'SJbkABNqIA', 76.00, '2022-12-12 19:06:01', '2022-12-12 19:06:01'),
(3, 2, 3, 3, 3, 234374, 2, 'BeoX048BAA', 20.00, '2022-12-12 19:06:01', '2022-12-12 19:06:01'),
(4, 2, 1, 2, 3, 518257, 3, 'Y3oH25BdCj', 21.00, '2022-12-12 19:06:01', '2022-12-12 19:06:01'),
(5, 2, 3, 3, 3, 146627, 1, 'LboYc8CRqj', 13.00, '2022-12-12 19:06:01', '2022-12-12 19:06:01'),
(6, 2, 3, 2, 3, 166168, 3, 'awoySB9vEX', 54.00, '2022-12-12 19:06:01', '2022-12-12 19:06:01'),
(7, 2, 1, 2, 3, 408163, 3, 'go6HEG9YIQ', 48.00, '2022-12-12 19:06:01', '2022-12-12 19:06:01'),
(8, 2, 1, 3, 3, 467846, 3, 'F3WrVccBt3', 45.00, '2022-12-12 19:06:01', '2022-12-12 19:06:01'),
(9, 2, 1, 2, 3, 371420, 1, '4BvaU4k8RJ', 74.00, '2022-12-12 19:06:01', '2022-12-12 19:06:01'),
(10, 2, 3, 2, 3, 691642, 1, 'DediVzOOlT', 83.00, '2022-12-12 19:06:01', '2022-12-12 19:06:01'),
(11, 2, 4, 1, 3, 691884, 1, '60hM5JAek6', 93.00, '2022-12-12 19:06:01', '2022-12-12 19:06:01'),
(12, 2, 4, 1, 3, 513459, 3, 'CT5T5jNY6x', 84.00, '2022-12-12 19:06:01', '2022-12-12 19:06:01'),
(13, 2, 3, 2, 3, 716429, 1, '8ZIRXc4Lap', 75.00, '2022-12-12 19:06:01', '2022-12-12 19:06:01'),
(14, 2, 1, 3, 3, 483578, 1, 'tbhenin4ag', 32.00, '2022-12-12 19:06:01', '2022-12-12 19:06:01'),
(15, 2, 4, 1, 3, 348874, 3, 'sqPzEipZyf', 84.00, '2022-12-12 19:06:01', '2022-12-12 19:06:01'),
(16, 2, 1, 3, 3, 918370, 2, 'Ol4NVrGZIh', 38.00, '2022-12-12 19:06:01', '2022-12-12 19:06:01'),
(17, 2, 2, 1, 3, 699003, 3, '19WJONlAAi', 73.00, '2022-12-12 19:06:01', '2022-12-12 19:06:01'),
(18, 2, 4, 1, 3, 424867, 1, 'D6wCsh5zTq', 77.00, '2022-12-12 19:06:01', '2022-12-12 19:06:01'),
(19, 2, 2, 1, 3, 863175, 1, 'jdWhDDQeoL', 59.00, '2022-12-12 19:06:02', '2022-12-12 19:06:02'),
(20, 2, 1, 2, 3, 281408, 2, 'dVMlzBwypl', 88.00, '2022-12-12 19:06:02', '2022-12-12 19:06:02'),
(21, 2, 1, 3, 3, 479279, 3, 'gPDOIRFccc', 47.00, '2022-12-12 19:06:02', '2022-12-12 19:06:02'),
(22, 2, 4, 1, 3, 836934, 1, 'sEEQGslYup', 57.00, '2022-12-12 19:06:02', '2022-12-12 19:06:02'),
(23, 2, 4, 1, 3, 989315, 2, 'ORr6ycMxEJ', 14.00, '2022-12-12 19:06:02', '2022-12-12 19:06:02'),
(24, 2, 4, 3, 3, 682596, 2, 'BtPNv8UaDA', 23.00, '2022-12-12 19:06:02', '2022-12-12 19:06:02'),
(25, 2, 1, 1, 3, 321990, 2, 'sKQTpm08Uw', 64.00, '2022-12-12 19:06:02', '2022-12-12 19:06:02'),
(26, 2, 1, 2, 3, 469789, 3, 'BXFwN63rTH', 96.00, '2022-12-15 19:46:51', '2022-12-15 19:46:51'),
(27, 2, 2, 3, 3, 993232, 2, 'd8wLcp2xNC', 60.00, '2022-12-15 19:46:51', '2022-12-15 19:46:51'),
(28, 2, 4, 3, 3, 881106, 1, 'zmTrRIaEzs', 17.00, '2022-12-15 19:46:51', '2022-12-15 19:46:51'),
(29, 2, 4, 2, 3, 529624, 3, 'aAyKIhQDIi', 80.00, '2022-12-15 19:46:51', '2022-12-15 19:46:51'),
(30, 2, 1, 3, 3, 900633, 2, 'ytCbV8T3b1', 26.00, '2022-12-15 19:46:51', '2022-12-15 19:46:51'),
(31, 2, 3, 1, 3, 168110, 2, 'F2hfJiB8xm', 59.00, '2022-12-15 19:48:16', '2022-12-15 19:48:16'),
(32, 2, 4, 3, 3, 385074, 1, 'A2scV9KeCT', 60.00, '2022-12-15 19:48:16', '2022-12-15 19:48:16'),
(33, 2, 1, 1, 3, 274609, 3, 'ObX6QwRBgY', 58.00, '2022-12-15 19:48:16', '2022-12-15 19:48:16'),
(34, 2, 2, 3, 3, 904609, 3, 'tTzNqCk1M9', 57.00, '2022-12-15 19:48:16', '2022-12-15 19:48:16'),
(35, 2, 3, 1, 3, 852524, 2, 'bxDSr5WfkL', 95.00, '2022-12-15 19:48:16', '2022-12-15 19:48:16'),
(36, 2, 3, 2, 3, 604680, 3, 's1Te7Bc6ju', 13.00, '2022-12-19 22:36:52', '2022-12-19 22:36:52'),
(37, 2, 1, 3, 3, 456361, 3, 'TAqDgpbDYz', 36.00, '2022-12-19 22:36:52', '2022-12-19 22:36:52'),
(38, 2, 4, 1, 3, 539163, 1, 'gzQj1EMaNP', 41.00, '2022-12-19 22:36:52', '2022-12-19 22:36:52'),
(39, 2, 2, 3, 3, 780909, 3, 'ruCG4dtPrk', 37.00, '2022-12-19 22:36:52', '2022-12-19 22:36:52'),
(40, 2, 4, 3, 3, 670027, 1, 'bIAwgcKUl6', 78.00, '2022-12-19 22:36:52', '2022-12-19 22:36:52');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `type` int(11) NOT NULL COMMENT '1=Admin, 2=Dome Owner, 3=User',
  `login_type` int(11) NOT NULL DEFAULT 1 COMMENT '1=Email, 2=Google, 3=Apple, 4=Facebook',
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `countrycode` varchar(255) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `google_id` varchar(255) DEFAULT NULL,
  `apple_id` varchar(255) DEFAULT NULL,
  `facebook_id` varchar(255) DEFAULT NULL,
  `fcm_token` text DEFAULT NULL,
  `otp` varchar(255) DEFAULT NULL,
  `image` varchar(255) NOT NULL DEFAULT 'default.png',
  `is_verified` int(11) NOT NULL DEFAULT 2 COMMENT '1=Yes, 2=No',
  `is_available` int(11) NOT NULL DEFAULT 1 COMMENT '1=Yes, 2=No',
  `is_deleted` int(11) NOT NULL DEFAULT 2 COMMENT '1=Yes, 2=No',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `type`, `login_type`, `name`, `email`, `countrycode`, `phone`, `password`, `google_id`, `apple_id`, `facebook_id`, `fcm_token`, `otp`, `image`, `is_verified`, `is_available`, `is_deleted`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'Admin', 'admin@gmail.com', 'CA', '1234567890', '$2y$10$z0eXm5BtjQQP77GHRvJAGOIp1osY2Lx0NvMvmkpTgPzpiTUvnIlri', NULL, NULL, NULL, NULL, NULL, 'default.png', 1, 1, 2, '2023-02-06 05:11:02', '2023-02-06 05:11:02'),
(2, 2, 1, 'domez', 'domez@yopmail.com', 'CA', '1234657890', '$2y$10$z0eXm5BtjQQP77GHRvJAGOIp1osY2Lx0NvMvmkpTgPzpiTUvnIlri', NULL, NULL, NULL, NULL, NULL, 'default.png', 1, 1, 2, '2023-02-06 00:03:03', '2023-02-22 04:12:48'),
(3, 3, 2, 'test1', 'dummy@gmail.com', 'CA', '6359487772', NULL, NULL, NULL, NULL, NULL, NULL, 'user-8767.jpg', 1, 1, 2, '2023-02-06 00:14:06', '2023-02-20 01:27:18'),
(4, 3, 1, 'soham1', 's@gmail.com', 'CA', '1234567988', '$2y$10$ZT0nObeNnoOfxpc51wNMjuEMdj.wDjDWwTN7HrpIF4PLgHp73A3b2', NULL, NULL, NULL, NULL, NULL, 'user-63f3392b4218e.png', 1, 1, 2, '2023-02-09 04:55:36', '2023-02-20 22:45:18'),
(5, 3, 1, 'Siwakar', 'siwakar@gmail.com', 'CA', '6666666666', '$2y$10$HJpJ0YcLA8xpmy7vElmcDuwPhJKphXxvZZNsshwsKhKA73kqaDQSC', NULL, NULL, NULL, NULL, NULL, 'default.png', 1, 1, 2, '2023-02-17 05:44:14', '2023-02-17 05:44:14'),
(6, 3, 1, 'test1', 'shiva@gmail.com', 'CA', '12345679', '$2y$10$IeoPopibjXY5aAKkxxa9bepetQY6gAF1K/316ghgG5MzAqI1.3MfK', NULL, NULL, NULL, NULL, NULL, 'default.png', 1, 1, 2, '2023-02-19 01:50:12', '2023-02-19 01:50:12'),
(7, 3, 1, 'Soham', 'domez@gmail.com', 'CA', '6359478772', '$2y$10$gtan0ZH/DCiZmnR2yLGiyeZAR0YeEu9krVXGHQfXBqk63ep0WQEEm', NULL, NULL, NULL, NULL, NULL, 'default.png', 1, 1, 2, '2023-02-19 02:22:29', '2023-02-19 05:28:51'),
(8, 3, 1, 'Soham', 'rahul@gmail.com', 'CA', '6359478772', '$2y$10$X1zB07DVhnotX2/mINs8S.50S6zMODymJkeAESIQAFn7hN8vGS6t2', NULL, NULL, NULL, NULL, NULL, 'default.png', 1, 1, 2, '2023-02-19 04:05:29', '2023-02-19 04:05:29'),
(9, 3, 1, 'Soham', 'dhrutish@gmail.com', 'CA', '6359478772', '$2y$10$H1yMjmp7D/3EG.8qnvFRg.XW0U9SU1u7blXZMKpKNuCI/2BBgyOFi', NULL, NULL, NULL, NULL, NULL, 'default.png', 1, 1, 2, '2023-02-19 04:08:12', '2023-02-19 04:08:12'),
(10, 3, 1, 'test1', 'shivda@gmail.com', 'CA', '12345679', '$2y$10$JLjTCxbdEFMY/S2vQU7z5.MOu9DGHDbV1sqpSEaimoyVNMMyPKTmC', NULL, NULL, NULL, NULL, NULL, 'default.png', 1, 1, 2, '2023-02-19 05:59:51', '2023-02-19 05:59:51'),
(11, 3, 1, 'test1', 'shivdxa@gmail.com', 'CA', '12345679', '$2y$10$QSpgBloNHA7JhcHVrNl.zu8apCMuzFrn6MHxk/iT15UKuX.E8/w6O', NULL, NULL, NULL, NULL, NULL, 'default.png', 1, 1, 2, '2023-02-19 06:01:17', '2023-02-19 06:01:17'),
(12, 3, 1, 'test1', 'shivdxxa@gmail.com', 'CA', '12345679', '$2y$10$kovPuSe5RlvMtu9B9tkggOFA.C056m1RLx/jWzq3cpj8BWuY5C/N.', NULL, NULL, NULL, NULL, NULL, 'default.png', 1, 1, 2, '2023-02-19 06:01:39', '2023-02-19 06:01:39'),
(13, 3, 1, 'test1', 'shivdxxa@gmail.comx', 'CA', '12345679', '$2y$10$yL6EdwslUs4QaJst9tuSAOJXOv1U0JecesknmKdY0x1xgltJlCxZy', NULL, NULL, NULL, NULL, NULL, 'default.png', 1, 1, 2, '2023-02-19 06:02:37', '2023-02-19 06:02:37');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cms`
--
ALTER TABLE `cms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `domes`
--
ALTER TABLE `domes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dome_images`
--
ALTER TABLE `dome_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `enquiries`
--
ALTER TABLE `enquiries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `favourites`
--
ALTER TABLE `favourites`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fields`
--
ALTER TABLE `fields`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `leagues`
--
ALTER TABLE `leagues`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment_gateways`
--
ALTER TABLE `payment_gateways`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sports`
--
ALTER TABLE `sports`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `cms`
--
ALTER TABLE `cms`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `domes`
--
ALTER TABLE `domes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `dome_images`
--
ALTER TABLE `dome_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `enquiries`
--
ALTER TABLE `enquiries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `favourites`
--
ALTER TABLE `favourites`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `fields`
--
ALTER TABLE `fields`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `leagues`
--
ALTER TABLE `leagues`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `payment_gateways`
--
ALTER TABLE `payment_gateways`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=502;

--
-- AUTO_INCREMENT for table `sports`
--
ALTER TABLE `sports`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
