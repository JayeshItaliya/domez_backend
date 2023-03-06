-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 06, 2023 at 09:51 AM
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
  `field_id` varchar(255) NOT NULL,
  `booking_id` varchar(255) NOT NULL,
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
  `token` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `type`, `vendor_id`, `dome_id`, `league_id`, `user_id`, `sport_id`, `field_id`, `booking_id`, `booking_date`, `customer_name`, `customer_email`, `customer_mobile`, `team_name`, `players`, `slots`, `start_date`, `end_date`, `start_time`, `end_time`, `total_amount`, `paid_amount`, `due_amount`, `payment_mode`, `payment_type`, `payment_status`, `booking_status`, `token`, `created_at`, `updated_at`) VALUES
(22, 1, 2, 35, NULL, 9, 6, '3', '554611', '2003-11-09', 'Prof. Geovany Kuhn', 'arno.mayert@example.com', '+14809074204', NULL, 17, '06:30 AM - 07:30 AM', NULL, NULL, '1:41 PM', '11:35 AM', 87.00, 23.00, 26.00, 1, 2, 1, 1, NULL, '2023-02-20 04:57:41', '2023-02-20 04:57:41'),
(23, 1, 2, 37, NULL, 11, 10, '2', '416036', '1975-09-30', 'Ulises Ledner', 'dillan.sporer@example.com', '+1-940-940-5206', NULL, 25, '06:30 AM - 07:30 AM', NULL, NULL, '8:22 AM', '11:30 AM', 85.00, 40.00, 18.00, 2, 1, 2, 2, NULL, '2023-02-20 04:57:41', '2023-02-20 04:57:41'),
(24, 1, 2, 37, NULL, 7, 6, '2', '369746', '2008-01-05', 'Rodrick Dare PhD', 'schiller.kaelyn@example.net', '+1 (925) 464-1416', NULL, 24, '06:30 AM - 07:30 AM', NULL, NULL, '12:27 PM', '1:21 AM', 56.00, 42.00, 20.00, 1, 1, 1, 1, NULL, '2023-02-20 04:57:41', '2023-02-20 04:57:41'),
(25, 1, 2, 39, NULL, 10, 8, '5', '986568', '2007-07-13', 'Isabelle Dietrich', 'alba.heaney@example.net', '424-832-1927', NULL, 14, '06:30 AM - 07:30 AM', NULL, NULL, '9:18 AM', '6:58 AM', 72.00, 20.00, 10.00, 1, 1, 2, 1, NULL, '2023-02-20 04:57:41', '2023-02-20 04:57:41'),
(26, 1, 2, 36, NULL, 7, 8, '4', '166327', '2004-03-08', 'Ward Purdy', 'lamar04@example.net', '620.723.1946', NULL, 15, '06:30 AM - 07:30 AM', NULL, NULL, '3:38 AM', '5:23 PM', 47.00, 34.00, 25.00, 1, 1, 1, 2, NULL, '2023-02-20 04:57:41', '2023-02-20 04:57:41'),
(27, 1, 2, 36, NULL, 8, 9, '1', '457640', '2002-04-11', 'Dr. Lucile Hoppe', 'robin.mayer@example.org', '283-731-3348', NULL, 28, '06:30 AM - 07:30 AM', NULL, NULL, '8:56 AM', '3:47 AM', 61.00, 45.00, 19.00, 1, 1, 2, 2, NULL, '2023-02-20 04:57:41', '2023-02-20 04:57:41'),
(28, 1, 2, 36, NULL, 12, 9, '4', '637257', '2011-04-09', 'Adolphus Howe DVM', 'friesen.ezekiel@example.com', '(657) 566-7750', NULL, 24, '06:30 AM - 07:30 AM', NULL, NULL, '9:44 PM', '8:05 AM', 32.00, 37.00, 29.00, 1, 1, 1, 2, NULL, '2023-02-20 04:57:41', '2023-02-20 04:57:41'),
(29, 1, 2, 36, NULL, 11, 6, '2', '634153', '1974-01-15', 'Kyler O\'Conner', 'ramon76@example.com', '+1 (520) 281-8861', NULL, 14, '06:30 AM - 07:30 AM', NULL, NULL, '7:13 PM', '11:48 PM', 28.00, 25.00, 22.00, 1, 1, 2, 2, NULL, '2023-02-20 04:57:41', '2023-02-20 04:57:41'),
(30, 1, 2, 35, NULL, 9, 8, '5', '642194', '1989-11-13', 'Verona Marks MD', 'deshawn.abshire@example.com', '+1.918.990.4786', NULL, 14, '06:30 AM - 07:30 AM', NULL, NULL, '1:24 AM', '3:56 AM', 74.00, 34.00, 19.00, 1, 2, 1, 1, NULL, '2023-02-20 04:57:41', '2023-02-20 04:57:41'),
(31, 1, 2, 38, NULL, 6, 10, '5', '628792', '1980-08-18', 'Prof. Lindsey Breitenberg II', 'powlowski.kristopher@example.org', '617.771.7490', NULL, 13, '06:30 AM - 07:30 AM', NULL, NULL, '6:10 AM', '12:04 PM', 62.00, 11.00, 10.00, 1, 1, 1, 1, NULL, '2023-02-20 04:57:41', '2023-02-20 04:57:41'),
(32, 2, 2, 37, 2, 10, 7, '5', '811483', '2023-02-21', 'Rupert Mueller', 'beaulah95@example.net', '1-928-475-2913', 'Regular Old Football League', 27, NULL, '2023-03-10', '2023-04-10', '09:00 AM', '05:00 PM', 1848.00, 0.00, 0.00, 1, 1, 1, 1, NULL, '2023-02-21 01:52:13', '2023-02-21 01:52:13'),
(33, 2, 2, 37, 2, 5, 7, '5', '149051', '2023-02-21', 'Dariana Stark', 'veum.aaliyah@example.com', '+1-318-389-1635', 'Regular Old Football League', 28, NULL, '2023-03-10', '2023-04-10', '09:00 AM', '05:00 PM', 1848.00, 0.00, 0.00, 1, 1, 1, 1, NULL, '2023-02-22 00:29:14', '2023-02-22 00:29:14'),
(34, 2, 2, 37, 2, 13, 7, '5', '448414', '2023-02-21', 'Freeda Lynch', 'brandon.zieme@example.net', '+15746485171', 'Regular Old Football League', 19, NULL, '2023-03-10', '2022-04-06', '09:00 AM', '05:00 PM', 1848.00, 0.00, 0.00, 1, 1, 1, 1, NULL, '2023-02-22 00:29:24', '2023-02-22 00:29:24'),
(35, 1, 3, 36, NULL, 7, 7, '3', 'a2d4f6', '2023-03-02', 'Soham', 'domez@gmail.com', '6359478772', NULL, 20, '06:00 AM - 07:00 AM', NULL, NULL, '06:00 AM', '07:00 AM', 1000.00, 0.00, 1000.00, 1, 1, 2, 2, NULL, '2023-02-27 06:05:36', '2023-02-27 06:05:36'),
(36, 1, 3, 36, NULL, 7, 7, '3', 'f3a057', '2023-03-02', 'Soham', 'domez@gmail.com', '6359478772', NULL, 20, '06:00 AM - 07:00 AM', NULL, NULL, '06:00 AM', '07:00 AM', 1000.00, 0.00, 1000.00, 1, 1, 2, 2, NULL, '2023-02-27 06:15:21', '2023-02-27 06:15:21'),
(37, 1, 3, 36, NULL, 7, 7, '3', '97947f', '2023-03-02', 'Soham', 'domez@gmail.com', '6359478772', NULL, 20, '06:00 AM - 07:00 AM', NULL, NULL, '06:00 AM', '07:00 AM', 1000.00, 0.00, 1000.00, 1, 1, 2, 2, NULL, '2023-02-27 06:40:57', '2023-02-27 06:40:57'),
(38, 2, 4, 37, 2, 3, 7, '3', '068afd', '2023-02-28', 'test1', 'dummy@gmail.com', '6359487772', 'Test', 20, NULL, '2023-03-10', '2023-04-10', '09:00 AM', '05:00 PM', 1000.00, 0.00, 1000.00, 1, 1, 2, 2, NULL, '2023-02-27 23:24:26', '2023-02-27 23:24:26'),
(39, 2, 4, 37, 2, 5, 7, '3', '4d7dcf', '2023-03-02', 'test1', 'dummy@gmail.com', '6359487772', 'Test', 20, NULL, '2023-03-10', '2023-04-10', '09:00 AM', '05:00 PM', 1000.00, 0.00, 1000.00, 1, 1, 2, 2, NULL, '2023-02-27 23:25:53', '2023-02-27 23:25:53'),
(40, 2, 4, 37, 2, 4, 7, '3', 'c4e4f5', '2023-03-02', 'test1', 'dummy@gmail.com', '6359487772', 'Test', 20, NULL, '2023-03-10', '2023-04-10', '09:00 AM', '05:00 PM', 1000.00, 0.00, 0.00, 1, 1, 1, 1, NULL, '2023-02-27 23:30:15', '2023-02-27 23:30:15'),
(41, 1, 4, 37, NULL, 3, 7, '3', 'a7ee42', '2023-03-02', 'test1', 'dummy@gmail.com', '6359487772', 'Test', 20, NULL, '2023-03-10', '2023-04-10', '09:00 AM', '05:00 PM', 1000.00, 500.00, 500.00, 1, 2, 2, 2, NULL, '2023-02-27 23:40:59', '2023-02-27 23:40:59'),
(42, 1, 3, 36, NULL, 6, 7, '3', 'b9af50', '2023-03-02', 'test1', 'dummy@gmail.com', '6359487772', NULL, 20, '06:00 AM - 07:00 AM', NULL, NULL, '06:00 AM', '07:00 AM', 1000.00, 500.00, 500.00, 1, 2, 2, 2, NULL, '2023-02-27 23:41:33', '2023-02-27 23:41:33'),
(43, 1, 3, 36, NULL, 3, 7, '3', 'e55606', '2023-04-28', 'test1', 'dummy@gmail.com', '6359487772', NULL, 20, '06:00 AM - 07:00 AM', '2023-03-02', '2023-03-02', '06:00 AM', '07:00 AM', 1000.00, 500.00, 500.00, 1, 2, 2, 2, NULL, '2023-02-28 01:39:02', '2023-02-28 01:39:02'),
(44, 2, 4, 37, 2, 6, 7, '3', '68725f', '2023-02-28', 'test1', 'dummy@gmail.com', '6359487772', 'Test', 20, NULL, '2023-03-10', '2023-04-10', '09:00 AM', '05:00 PM', 1000.00, 500.00, 500.00, 1, 2, 2, 2, NULL, '2023-02-28 01:40:21', '2023-02-28 01:40:21'),
(45, 2, 4, 37, 2, 3, 7, '3', 'e27575', '2023-03-02', 'test1', 'dummy@gmail.com', '6359487772', 'Test', 20, NULL, '2023-03-10', '2023-04-10', '09:00 AM', '05:00 PM', 1000.00, 500.00, 500.00, 1, 2, 2, 2, NULL, '2023-03-02 05:59:51', '2023-03-02 05:59:51'),
(46, 2, 4, 37, 2, 3, 7, '3', '095a8a', '2023-03-02', 'test1', 'dummy@gmail.com', '6359487772', 'Test', 20, NULL, '2023-03-10', '2023-04-10', '09:00 AM', '05:00 PM', 1000.00, 500.00, 500.00, 1, 2, 2, 2, NULL, '2023-03-02 06:04:57', '2023-03-02 06:04:57'),
(47, 2, 4, 37, 2, 3, 7, '3', '625d3e', '2023-03-02', 'test1', 'dummy@gmail.com', '6359487772', 'Test', 20, NULL, '2023-03-10', '2023-04-10', '09:00 AM', '05:00 PM', 1000.00, 500.00, 500.00, 1, 2, 2, 2, NULL, '2023-03-02 06:07:42', '2023-03-02 06:07:42'),
(48, 2, 4, 37, 2, 3, 7, '3', 'ca9d2e', '2023-03-02', 'test1', 'dummy@gmail.com', '6359487772', 'Test', 20, NULL, '2023-03-10', '2023-04-10', '09:00 AM', '05:00 PM', 1000.00, 0.00, 0.00, 1, 1, 1, 1, NULL, '2023-03-02 06:09:39', '2023-03-02 06:09:39'),
(49, 2, 4, 37, 2, 3, 7, '3', '68dfeb', '2023-03-02', 'test1', 'dummy@gmail.com', '6359487772', 'Test', 20, NULL, '2023-03-10', '2023-04-10', '09:00 AM', '05:00 PM', 1000.00, 0.00, 0.00, 1, 1, 1, 1, NULL, '2023-03-02 06:17:21', '2023-03-02 06:17:21'),
(50, 2, 4, 37, 2, 3, 7, '3', '9f8d18', '2023-03-02', 'test1', 'dummy@gmail.com', '6359487772', 'Test', 20, NULL, '2023-03-10', '2023-04-10', '09:00 AM', '05:00 PM', 1000.00, 0.00, 0.00, 1, 1, 1, 1, NULL, '2023-03-02 06:19:00', '2023-03-02 06:19:00'),
(51, 2, 4, 37, 2, 3, 7, '3', '6bb93d', '2023-03-02', 'test1', 'dummy@gmail.com', '6359487772', 'Test', 20, NULL, '2023-03-10', '2023-04-10', '09:00 AM', '05:00 PM', 1000.00, 0.00, 0.00, 1, 1, 1, 1, NULL, '2023-03-02 08:00:26', '2023-03-02 08:00:26'),
(52, 2, 4, 37, 2, 3, 7, '3', 'ae2152', '2023-03-02', 'test1', 'dummy@gmail.com', '6359487772', 'Test', 20, NULL, '2023-03-10', '2023-04-10', '09:00 AM', '05:00 PM', 1000.00, 0.00, 0.00, 1, 1, 1, 1, NULL, '2023-03-02 08:01:36', '2023-03-02 08:01:36'),
(53, 2, 4, 37, 2, 3, 7, '3', 'cbf8b3', '2023-03-02', 'test1', 'dummy@gmail.com', '6359487772', 'Test', 20, NULL, '2023-03-10', '2023-04-10', '09:00 AM', '05:00 PM', 1000.00, 0.00, 0.00, 1, 1, 1, 1, NULL, '2023-03-02 08:02:00', '2023-03-02 08:02:00'),
(54, 2, 4, 37, 2, 3, 7, '3', 'f40253', '2023-03-02', 'test1', 'dummy@gmail.com', '6359487772', 'Test', 20, NULL, '2023-03-10', '2023-04-10', '09:00 AM', '05:00 PM', 1000.00, 0.00, 0.00, 1, 1, 1, 1, NULL, '2023-03-02 08:02:22', '2023-03-02 08:02:22'),
(55, 2, 4, 37, 2, 3, 7, '3', '2ec8c2', '2023-03-02', 'test1', 'dummy@gmail.com', '6359487772', 'Test', 20, NULL, '2023-03-10', '2023-04-10', '09:00 AM', '05:00 PM', 1000.00, 0.00, 0.00, 1, 1, 1, 1, NULL, '2023-03-02 08:02:24', '2023-03-02 08:02:24'),
(58, 2, 4, 37, 2, 3, 7, '3', '8e71af', '2023-03-03', 'test1', 'dummy@gmail.com', '6359487772', 'Test', 20, NULL, '2023-03-10', '2023-04-10', '09:00 AM', '05:00 PM', 1000.00, 500.00, 500.00, 1, 2, 2, 2, 'OSmGJlYvz8q9ycQlovaBz1fLqSAr1ecE', '2023-03-03 04:30:50', '2023-03-03 04:30:50'),
(60, 2, 4, 37, 2, 4, 7, '3', '98e174', '2023-03-28', 'test1', 'dummy@gmail.com', '6359487772', 'Test', 20, NULL, '2023-03-10', '2023-04-10', '09:00 AM', '05:00 PM', 1000.00, 500.00, 500.00, 1, 2, 2, 2, '2y10ZXcjnAZWbEw6RTW1g5ZDseyq3w5fgwhN77paIxESwlQCw2Lt4KMwm', '2023-03-03 04:33:28', '2023-03-03 04:33:28'),
(61, 1, 3, 36, NULL, 3, 7, '2', 'f7f426', '2023-03-03', 'test1', 'dummy@gmail.com', '6359487772', NULL, 20, '06:00 AM - 07:00 AM', '2023-03-04', '2023-03-04', '06:00 AM', '07:00 AM', 1000.00, 500.00, 500.00, 1, 2, 2, 2, '2y10U2bMJMGcDQcstxwcLvK2ureY5t5z2q5XJsa40rjFRXVOfKhEQB1m', '2023-03-03 05:17:30', '2023-03-03 05:17:30'),
(62, 1, 3, 36, NULL, 3, 7, '2', '9f2d55', '2023-03-03', 'test1', 'dummy@gmail.com', '6359487772', NULL, 20, '06:00 AM - 07:00 AM', '2023-03-04', '2023-03-04', '06:00 AM', '07:00 AM', 1000.00, 500.00, 500.00, 1, 2, 2, 2, '2y10vBW3Ja7dD6HgMG9Nf93dcGrlmxXNF1a1TG8t0Y1JS5FhVFSAOlS', '2023-03-03 06:05:06', '2023-03-03 06:05:06');

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
  `hst` double(8,2) NOT NULL COMMENT 'tax(GST)',
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
(35, 2, '6,7,10', 'Kinnara', 58.00, 5.00, 'Costen Tax Solutions, Inc, Birdneck Road North, Virginia Beach, VA, USA', '23451', 'Summerside', 'Prince Edward Island', 'Canada', '6:00 AM', '5:00 PM', 'DESCRIPTION', '28.5156729', '-81.4824233', 'Free Wifi|Changing Room|Parking', 'benefits-DESCRIPTION', 2, '2023-02-20 03:57:09', '2023-02-21 05:03:45'),
(36, 3, '7', 'Shott', 90.00, 5.00, '511 Notre Dame St, Summerside, PE, Canada', 'C1N 1T2', 'Summerside', 'Prince Edward Island', 'Canada', '12:00 PM', '7:00 AM', 'DESCRIPTION', '46.3981555', '-63.80031419999999', 'Changing Room', 'benefits-DESCRIPTION', 2, '2023-02-20 03:57:09', '2023-02-21 05:03:55'),
(37, 4, '8,9', 'geonardo', 80.00, 5.00, '511 Notre Dame St, Summerside, PE, Canada', 'C1N 1T2', 'Summerside', 'Prince Edward Island', 'Canada', '3:00 PM', '12:00 AM', 'DESCRIPTION', '46.3981555', '-63.80031419999999', 'Changing Room|Parking', 'benefits-DESCRIPTION', 2, '2023-02-20 03:57:09', '2023-02-21 05:04:05'),
(38, 5, '9,10', 'Shivakar', 85.00, 5.00, '511 Notre Dame St, Summerside, PE, Canada', 'C1N 1T2', 'Summerside', 'Prince Edward Island', 'Canada', '8:00 PM', '10:00 PM', 'DESCRIPTION', '46.3981555', '-63.80031419999999', 'Free Wifi|Changing Room', 'benefits-DESCRIPTION', 2, '2023-02-20 03:57:09', '2023-02-21 05:04:16'),
(39, 6, '7,8,10', 'Rockria', 64.00, 5.00, '511 Notre Dame St, Summerside, PE, Canada', 'C1N 1T2', 'Summerside', 'Prince Edward Island', 'Canada', '10:00 PM', '12:00 PM', 'DESCRIPTION', '46.3981555', '-63.80031419999999', 'Free Wifi|Changing Room|Parking', 'benefits-DESCRIPTION', 2, '2023-02-20 03:57:09', '2023-02-21 05:04:29'),
(40, 7, '6', 'Geodesic Dome Playground', 76.00, 5.00, 'Summerside Bowling Alleys, 511 Notre Dame St, Summerside, PE, Canada', 'C1N 1T2', 'Summerside', 'Prince Edward Island', 'Canada', '11:00 PM', '11:00 PM', 'DESCRIPTION', '46.39860830000001', '-63.8004099', 'Parking', 'benefits-DESCRIPTION', 2, '2023-02-20 04:57:41', '2023-02-20 05:06:24'),
(41, 8, '7,8,10', 'Geodesic Dome Playground', 57.00, 5.00, 'Summerside Car Rental, Inside Credit Union Place Building, 511 Notre Dame St, Summerside, PE, Canada', 'C1N 1T2', 'Summerside', 'Prince Edward Island', 'Canada', '5:00 AM', '6:00 PM', 'DESCRIPTION', '46.3981555', '-63.80031409999999', 'Free Wifi|Changing Room', 'benefits-DESCRIPTION', 2, '2023-02-20 04:57:41', '2023-02-20 05:06:44'),
(42, 9, '7,8,10', 'Shrinkle ground', 70.00, 5.00, 'Summerside Solar, 511 Notre Dame St, Summerside, PE, Canada', 'C1N 1T2', 'Summerside', 'Prince Edward Island', 'Canada', '1:00 AM', '4:00 PM', 'DESCRIPTION', '46.3993871', '-63.8010478', 'Changing Room', 'benefits-DESCRIPTION', 2, '2023-02-20 04:57:41', '2023-02-21 05:04:45'),
(43, 10, '6,8', 'Geodesic Dome Playground', 97.00, 5.00, '511 Notre Dame St, Summerside, PE, Canada', 'C1N 1T2', 'Summerside', 'Prince Edward Island', 'Canada', '10:00 AM', '9:00 PM', 'DESCRIPTION', '46.3981555', '-63.80031419999999', 'Changing Room|Parking', 'benefits-DESCRIPTION', 2, '2023-02-20 04:57:41', '2023-02-20 05:07:15'),
(44, 11, '9,10', 'Geodesic Dome Playground', 68.00, 5.00, 'Summerside Bowling Alleys, 511 Notre Dame St, Summerside, PE, Canada', 'C1N 1T2', 'Summerside', 'Prince Edward Island', 'Canada', '5:00 AM', '2:00 PM', 'DESCRIPTION', '46.39860830000001', '-63.8004099', 'Free Wifi|Changing Room', 'benefits-DESCRIPTION', 2, '2023-02-20 04:57:41', '2023-02-20 05:10:13'),
(45, 2, '8,9', 'Lorem Ipsum', 80.00, 5.00, 'Costen Tax Solutions, Inc, Birdneck Road North, Virginia Beach, VA, USA', '23451', 'Summerside', 'Prince Edward Island', 'Canada', '6:00 AM', '5:00 PM', 'DESCRIPTION', '28.5156729', '-81.4824233', 'Free Wifi|Changing Room|Parking', 'benefits-DESCRIPTION', 2, '2023-02-20 03:57:09', '2023-02-21 05:03:45');

-- --------------------------------------------------------

--
-- Table structure for table `dome_images`
--

CREATE TABLE `dome_images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `vendor_id` int(11) NOT NULL,
  `dome_id` int(11) DEFAULT NULL,
  `league_id` int(11) DEFAULT NULL,
  `images` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `dome_images`
--

INSERT INTO `dome_images` (`id`, `vendor_id`, `dome_id`, `league_id`, `images`, `created_at`, `updated_at`) VALUES
(17, 1, 35, NULL, 'dome-63f33f137daf5.png', '2023-02-20 04:06:19', '2023-02-20 04:06:19'),
(18, 1, 36, NULL, 'dome-63f34ce3141b4.jpg', '2023-02-20 05:05:15', '2023-02-20 05:05:15'),
(19, 1, 36, NULL, 'dome-63f34ce315178.png', '2023-02-20 05:05:15', '2023-02-20 05:05:15'),
(20, 1, 38, NULL, 'dome-63f34cfddbb9b.jpg', '2023-02-20 05:05:41', '2023-02-20 05:05:41'),
(21, 1, 38, NULL, 'dome-63f34cfddc864.png', '2023-02-20 05:05:41', '2023-02-20 05:05:41'),
(22, 1, 37, NULL, 'dome-63f34d071a031.jpg', '2023-02-20 05:05:51', '2023-02-20 05:05:51'),
(23, 1, 37, NULL, 'dome-63f34d071c65b.png', '2023-02-20 05:05:51', '2023-02-20 05:05:51'),
(24, 1, 39, NULL, 'dome-63f34d19b1030.jpg', '2023-02-20 05:06:09', '2023-02-20 05:06:09'),
(25, 1, 39, NULL, 'dome-63f34d19b1b0f.png', '2023-02-20 05:06:09', '2023-02-20 05:06:09'),
(26, 1, 40, NULL, 'dome-63f34d28721ba.jpg', '2023-02-20 05:06:24', '2023-02-20 05:06:24'),
(27, 1, 40, NULL, 'dome-63f34d2872c25.png', '2023-02-20 05:06:24', '2023-02-20 05:06:24'),
(28, 1, 41, NULL, 'dome-63f34d3c32120.jpg', '2023-02-20 05:06:44', '2023-02-20 05:06:44'),
(29, 1, 41, NULL, 'dome-63f34d3c32dad.png', '2023-02-20 05:06:44', '2023-02-20 05:06:44'),
(30, 1, 43, NULL, 'dome-63f34d5bc9946.jpg', '2023-02-20 05:07:15', '2023-02-20 05:07:15'),
(31, 1, 43, NULL, 'dome-63f34d5bca5e8.png', '2023-02-20 05:07:15', '2023-02-20 05:07:15'),
(32, 1, 44, NULL, 'dome-63f34e0d03fad.jpg', '2023-02-20 05:10:13', '2023-02-20 05:10:13'),
(33, 1, 44, NULL, 'dome-63f34e0d04c53.png', '2023-02-20 05:10:13', '2023-02-20 05:10:13'),
(34, 1, NULL, 4, 'dome-63f34d19b1b0f.png', '2023-02-20 05:06:09', '2023-02-20 05:06:09'),
(35, 1, NULL, 5, 'dome-63f34d3c32dad.png', '2023-02-20 05:06:44', '2023-02-20 05:06:44'),
(36, 1, NULL, 2, 'dome-63f34e0d03fad.jpg', '2023-02-20 05:10:13', '2023-02-20 05:10:13'),
(37, 2, NULL, 21, 'league-64048d5489032.jpg', '2023-03-05 07:08:44', '2023-03-05 07:08:44');

-- --------------------------------------------------------

--
-- Table structure for table `enquiries`
--

CREATE TABLE `enquiries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `vendor_id` int(11) DEFAULT NULL,
  `type` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1=HelpCenter[Mobile App], 2=HelpCenter[Web], 3=DomesRequest[Web], 4=DomesRequest[Mobile App], 5=Supports[DomeOwner-AdminPanel]',
  `dome_name` varchar(255) DEFAULT NULL,
  `dome_zipcode` varchar(255) DEFAULT NULL,
  `dome_city` varchar(255) DEFAULT NULL,
  `dome_state` varchar(255) DEFAULT NULL,
  `dome_country` varchar(255) DEFAULT NULL,
  `venue_name` varchar(255) DEFAULT NULL,
  `venue_address` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `message` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `enquiries`
--

INSERT INTO `enquiries` (`id`, `vendor_id`, `type`, `dome_name`, `dome_zipcode`, `dome_city`, `dome_state`, `dome_country`, `venue_name`, `venue_address`, `name`, `email`, `phone`, `subject`, `message`, `created_at`, `updated_at`) VALUES
(1, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ipsum@yopmail.comn', NULL, 'Talk About Something..', 'Lorem is ipsum data to world to tast data.', '2023-02-19 01:13:26', '2023-02-19 01:13:26'),
(2, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 's@gmail.com', NULL, 'soham', 'Soham is sad', '2023-02-20 01:26:33', '2023-02-20 01:26:33'),
(3, NULL, 4, NULL, NULL, NULL, NULL, NULL, 'test', 'test', 'test', 'test@gmail.com', '12354679', NULL, 'test', '2023-02-24 02:43:40', '2023-02-24 02:43:40'),
(4, NULL, 4, NULL, NULL, NULL, NULL, NULL, 'test', 'test', 'test', 'test@gmail.com', '12354679', NULL, 'test', '2023-02-24 09:38:18', '2023-02-24 09:38:18'),
(5, 2, 5, NULL, NULL, NULL, NULL, NULL, 'SOh,', 'OJ', 'O', 's@gmail.com', '1234567890', 'Ipsum', 'CDSDS', '2023-02-24 11:50:37', '2023-02-24 11:50:37'),
(6, 2, 5, NULL, NULL, NULL, NULL, NULL, 'qws', 'qww', 'qw', 's@gmail.com', '1234567890', 'Lorem', 'qw', '2023-02-24 11:51:12', '2023-02-24 11:51:12'),
(7, NULL, 4, NULL, NULL, NULL, NULL, NULL, 'sads', 'asdasd', 'asda', 's@gmail.com', '1235467890', NULL, 'asd', '2023-02-24 11:53:55', '2023-02-24 11:53:55'),
(8, NULL, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'test', 'test@yopmail.com', NULL, 'test', 'test', '2023-03-02 01:10:02', '2023-03-02 01:10:02'),
(9, NULL, 3, 'Dome 1', NULL, 'Surat', 'Gujarat', 'Country', NULL, NULL, 'Domez', 'domez@yopmail.com', '1234567890', NULL, NULL, '2023-03-02 04:47:56', '2023-03-02 04:47:56');

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
(57, 4, NULL, 38, '2023-02-24 03:44:45', '2023-02-24 03:44:45'),
(68, 4, NULL, 36, '2023-02-28 04:17:31', '2023-02-28 04:17:31'),
(69, 4, NULL, 35, '2023-02-28 04:17:33', '2023-02-28 04:17:33'),
(71, 16, 38, NULL, '2023-02-28 04:29:34', '2023-02-28 04:29:34'),
(82, 4, NULL, 2, '2023-03-01 02:41:00', '2023-03-01 02:41:00'),
(83, 4, NULL, 2, '2023-03-01 02:41:00', '2023-03-01 02:41:00'),
(96, 16, 36, NULL, '2023-03-03 01:34:32', '2023-03-03 01:34:32'),
(97, 16, 35, NULL, '2023-03-03 01:34:43', '2023-03-03 01:34:43'),
(98, 16, NULL, 38, '2023-03-03 01:44:12', '2023-03-03 01:44:12');

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
(1, 2, 38, '8', '2', 491.00, 8, 20, 'field-1135.jpg', 1, 2, '2023-02-20 05:57:52', '2023-02-20 05:57:52'),
(2, 2, 35, '6', '2', 452.00, 5, 30, 'field-1135.jpg', 1, 2, '2023-02-20 05:57:52', '2023-02-20 05:57:52'),
(3, 2, 36, '7', '2', 129.00, 6, 19, 'field-1135.jpg', 1, 2, '2023-02-20 05:57:52', '2023-02-20 05:57:52'),
(4, 2, 39, '8', '2', 401.00, 6, 18, 'field-1135.jpg', 1, 2, '2023-02-20 05:57:52', '2023-02-20 05:57:52'),
(5, 2, 38, '10', '2', 439.00, 6, 29, 'field-1135.jpg', 1, 2, '2023-02-20 05:57:52', '2023-02-20 05:57:52'),
(6, 2, 36, '7', '2', 199.00, 6, 19, 'field-1135.jpg', 1, 2, '2023-02-20 05:57:52', '2023-02-20 05:57:52'),
(7, 2, 38, '8', '2', 491.00, 8, 20, 'field-1135.jpg', 1, 2, '2023-02-20 05:57:52', '2023-02-20 05:57:52'),
(8, 2, 35, '6', '2', 452.00, 5, 30, 'field-1135.jpg', 1, 2, '2023-02-20 05:57:52', '2023-02-20 05:57:52'),
(9, 2, 36, '7', '2', 129.00, 6, 19, 'field-1135.jpg', 1, 2, '2023-02-20 05:57:52', '2023-02-20 05:57:52'),
(10, 2, 39, '8', '2', 401.00, 6, 18, 'field-1135.jpg', 1, 2, '2023-02-20 05:57:52', '2023-02-20 05:57:52'),
(11, 2, 38, '10', '2', 439.00, 6, 29, 'field-1135.jpg', 1, 2, '2023-02-20 05:57:52', '2023-02-20 05:57:52'),
(12, 2, 36, '7', '2', 199.00, 6, 19, 'field-1135.jpg', 1, 2, '2023-02-20 05:57:52', '2023-02-20 05:57:52'),
(13, 2, 38, '8', '2', 491.00, 8, 20, 'field-1135.jpg', 1, 2, '2023-02-20 05:57:52', '2023-02-20 05:57:52'),
(14, 2, 35, '6', '2', 452.00, 5, 30, 'field-1135.jpg', 1, 2, '2023-02-20 05:57:52', '2023-02-20 05:57:52'),
(15, 2, 36, '7', '2', 129.00, 6, 19, 'field-1135.jpg', 1, 2, '2023-02-20 05:57:52', '2023-02-20 05:57:52'),
(16, 2, 39, '8', '2', 401.00, 6, 18, 'field-1135.jpg', 1, 2, '2023-02-20 05:57:52', '2023-02-20 05:57:52'),
(17, 2, 38, '10', '2', 439.00, 6, 29, 'field-1135.jpg', 1, 2, '2023-02-20 05:57:52', '2023-02-20 05:57:52'),
(18, 2, 36, '7', '2', 199.00, 6, 19, 'field-1135.jpg', 1, 2, '2023-02-20 05:57:52', '2023-02-20 05:57:52'),
(19, 2, 38, '8', '2', 491.00, 8, 20, 'field-1135.jpg', 1, 2, '2023-02-20 05:57:52', '2023-02-20 05:57:52'),
(20, 2, 35, '6', '2', 452.00, 5, 30, 'field-1135.jpg', 1, 2, '2023-02-20 05:57:52', '2023-02-20 05:57:52'),
(21, 2, 36, '7', '2', 129.00, 6, 19, 'field-1135.jpg', 1, 2, '2023-02-20 05:57:52', '2023-02-20 05:57:52'),
(22, 2, 39, '8', '2', 401.00, 6, 18, 'field-1135.jpg', 1, 2, '2023-02-20 05:57:52', '2023-02-20 05:57:52'),
(23, 2, 38, '10', '2', 439.00, 6, 29, 'field-1135.jpg', 1, 2, '2023-02-20 05:57:52', '2023-02-20 05:57:52'),
(24, 2, 36, '7', '2', 199.00, 6, 19, 'field-1135.jpg', 1, 2, '2023-02-20 05:57:52', '2023-02-20 05:57:52');

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
  `is_deleted` tinyint(4) NOT NULL DEFAULT 2 COMMENT '1=yes,2=no',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `leagues`
--

INSERT INTO `leagues` (`id`, `vendor_id`, `dome_id`, `field_id`, `sport_id`, `name`, `start_date`, `end_date`, `start_time`, `end_time`, `from_age`, `to_age`, `gender`, `min_player`, `max_player`, `team_limit`, `price`, `is_deleted`, `created_at`, `updated_at`) VALUES
(1, 2, 35, '2|3', 7, 'Regular Old Football League', '2023-03-10', '2023-04-10', '09:00 AM', '05:00 PM', 16, 28, 1, 12, 17, 13, 1489, 2, '2023-02-20 06:56:50', '2023-02-20 06:56:50'),
(2, 2, 37, '5', 7, 'Regular Old Football League', '2023-03-10', '2023-04-10', '09:00 AM', '05:00 PM', 20, 30, 1, 12, 16, 13, 1848, 2, '2023-02-20 06:56:50', '2023-02-20 06:56:50'),
(3, 2, 37, '4', 7, 'Regular Old Football League', '2023-03-10', '2023-04-10', '09:00 AM', '05:00 PM', 13, 24, 2, 13, 24, 14, 1976, 2, '2023-02-20 06:56:50', '2023-02-20 06:56:50'),
(4, 2, 38, '3', 9, 'Regular Old Football League', '2023-03-10', '2023-04-10', '09:00 AM', '05:00 PM', 13, 22, 1, 12, 17, 15, 1527, 2, '2023-02-20 06:56:50', '2023-02-20 06:56:50'),
(5, 2, 39, '4', 9, 'Regular Old Football League', '2023-03-10', '2023-04-10', '09:00 AM', '05:00 PM', 17, 21, 3, 13, 20, 12, 1909, 2, '2023-02-20 06:56:50', '2023-02-20 06:56:50'),
(6, 2, 35, '2|3', 7, 'Regular Old Football League', '2023-03-10', '2023-04-10', '09:00 AM', '05:00 PM', 16, 28, 1, 12, 17, 13, 1489, 2, '2023-02-20 06:56:50', '2023-02-20 06:56:50'),
(7, 2, 37, '5', 7, 'Regular Old Football League', '2023-03-10', '2023-04-10', '09:00 AM', '05:00 PM', 20, 30, 1, 12, 16, 13, 1848, 2, '2023-02-20 06:56:50', '2023-02-20 06:56:50'),
(8, 2, 37, '4', 7, 'Regular Old Football League', '2023-03-10', '2023-04-10', '09:00 AM', '05:00 PM', 13, 24, 2, 13, 24, 14, 1976, 2, '2023-02-20 06:56:50', '2023-02-20 06:56:50'),
(9, 2, 38, '3', 9, 'Regular Old Football League', '2023-03-10', '2023-04-10', '09:00 AM', '05:00 PM', 13, 22, 1, 12, 17, 15, 1527, 2, '2023-02-20 06:56:50', '2023-02-20 06:56:50'),
(10, 2, 39, '4', 9, 'Regular Old Football League', '2023-03-10', '2023-04-10', '09:00 AM', '05:00 PM', 17, 21, 3, 13, 20, 12, 1909, 2, '2023-02-20 06:56:50', '2023-02-20 06:56:50'),
(11, 2, 35, '2|3', 7, 'Regular Old Football League', '2023-03-10', '2023-04-10', '09:00 AM', '05:00 PM', 16, 28, 1, 12, 17, 13, 1489, 2, '2023-02-20 06:56:50', '2023-02-20 06:56:50'),
(12, 2, 37, '5', 7, 'Regular Old Football League', '2023-03-10', '2023-04-10', '09:00 AM', '05:00 PM', 20, 30, 1, 12, 16, 13, 1848, 2, '2023-02-20 06:56:50', '2023-02-20 06:56:50'),
(13, 2, 37, '4', 7, 'Regular Old Football League', '2023-03-10', '2023-04-10', '09:00 AM', '05:00 PM', 13, 24, 2, 13, 24, 14, 1976, 2, '2023-02-20 06:56:50', '2023-02-20 06:56:50'),
(14, 2, 38, '3', 9, 'Regular Old Football League', '2023-03-10', '2023-04-10', '09:00 AM', '05:00 PM', 13, 22, 1, 12, 17, 15, 1527, 2, '2023-02-20 06:56:50', '2023-02-20 06:56:50'),
(15, 2, 39, '4', 9, 'Regular Old Football League', '2023-03-10', '2023-04-10', '09:00 AM', '05:00 PM', 17, 21, 3, 13, 20, 12, 1909, 2, '2023-02-20 06:56:50', '2023-02-20 06:56:50'),
(16, 2, 35, '2|3', 7, 'Regular Old Football League', '2023-03-10', '2023-04-10', '09:00 AM', '05:00 PM', 16, 28, 1, 12, 17, 13, 1489, 2, '2023-02-20 06:56:50', '2023-02-20 06:56:50'),
(17, 2, 37, '5', 7, 'Regular Old Football League', '2023-03-10', '2023-04-10', '09:00 AM', '05:00 PM', 20, 30, 1, 12, 16, 13, 1848, 2, '2023-02-20 06:56:50', '2023-02-20 06:56:50'),
(18, 2, 37, '4', 7, 'Regular Old Football League', '2023-03-10', '2023-04-10', '09:00 AM', '05:00 PM', 13, 24, 2, 13, 24, 14, 1976, 2, '2023-02-20 06:56:50', '2023-02-20 06:56:50'),
(19, 2, 38, '3', 9, 'Regular Old Football League', '2023-03-10', '2023-04-10', '09:00 AM', '05:00 PM', 13, 22, 1, 12, 17, 15, 1527, 2, '2023-02-20 06:56:50', '2023-02-20 06:56:50'),
(20, 2, 39, '4', 9, 'Regular Old Football League', '2023-03-10', '2023-04-10', '09:00 AM', '05:00 PM', 17, 21, 3, 13, 20, 12, 1909, 2, '2023-02-20 06:56:50', '2023-02-20 06:56:50'),
(21, 2, 35, '20', 6, 'Ipsum League', '2023-03-08', '2023-03-31', '01:00 AM', '04:00 AM', 14, 18, 2, 3, 6, 6, 120, 2, '2023-03-05 07:08:44', '2023-03-05 07:25:42');

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

--
-- Dumping data for table `payment_gateways`
--

INSERT INTO `payment_gateways` (`id`, `type`, `public_key`, `secret_key`, `created_at`, `updated_at`) VALUES
(1, 1, 'pk_test_51LlAvQFysF0okTxJURIkxuGDrkHuj0MwtW9BR7XAZlYZWoCVJ3F7tLR538Uonlw1msIhcm26oESamRKrVIzZOwMG00NvCxPLn8', 'sk_test_51LlAvQFysF0okTxJ2zYdNO3KY6BqSEQMCXuY7SxBvTlI7L2wEneSwWKL70Qhrsg52XWHm1aI95VN3Qna6R7dE7FU00JJ4aysw3', '2022-11-22 00:35:31', '2022-11-22 23:54:25');

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
  `vendor_id` int(11) NOT NULL,
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

INSERT INTO `reviews` (`id`, `vendor_id`, `dome_id`, `user_id`, `ratting`, `comment`, `reply_message`, `replied_at`, `created_at`, `updated_at`) VALUES
(1, 2, 35, 6, 3, 'Very Good Experience', NULL, NULL, '2023-03-02 03:31:58', '2023-03-02 03:31:58'),
(3, 2, 38, 15, 1, 'Very Good Experience', NULL, NULL, '2023-03-02 03:31:58', '2023-03-02 03:31:58'),
(4, 2, 35, 5, 5, 'Very Good Experience', NULL, NULL, '2023-03-02 03:31:58', '2023-03-02 03:31:58'),
(5, 2, 38, 8, 4, 'Very Good Experience', NULL, NULL, '2023-03-02 03:31:58', '2023-03-02 03:31:58'),
(6, 2, 36, 7, 2, 'Very Good Experience', NULL, NULL, '2023-03-02 03:31:58', '2023-03-02 03:31:58'),
(7, 2, 38, 8, 5, 'Very Good Experience', NULL, NULL, '2023-03-02 03:31:58', '2023-03-02 03:31:58'),
(8, 2, 38, 15, 2, 'Very Good Experience', NULL, NULL, '2023-03-02 03:31:58', '2023-03-02 03:31:58'),
(9, 2, 37, 8, 2, 'Very Good Experience', NULL, NULL, '2023-03-02 03:31:58', '2023-03-02 03:31:58'),
(10, 2, 38, 12, 3, 'Very Good Experience', NULL, NULL, '2023-03-02 03:31:58', '2023-03-02 03:31:58'),
(11, 2, 38, 16, 2, 'Very Good Experience', NULL, NULL, '2023-03-02 03:31:58', '2023-03-02 03:31:58'),
(12, 2, 36, 7, 5, 'Very Good Experience', NULL, NULL, '2023-03-02 03:31:58', '2023-03-02 03:31:58'),
(13, 2, 40, 13, 2, 'Very Good Experience', NULL, NULL, '2023-03-02 03:31:58', '2023-03-02 03:31:58'),
(14, 2, 37, 5, 3, 'Very Good Experience', NULL, NULL, '2023-03-02 03:31:58', '2023-03-02 03:31:58'),
(15, 2, 38, 15, 5, 'Very Good Experience', NULL, NULL, '2023-03-02 03:31:58', '2023-03-02 03:31:58'),
(16, 2, 40, 10, 4, 'Very Good Experience', NULL, NULL, '2023-03-02 03:31:58', '2023-03-02 03:31:58'),
(17, 2, 40, 5, 3, 'Very Good Experience', NULL, NULL, '2023-03-02 03:31:58', '2023-03-02 03:31:58'),
(18, 2, 37, 3, 4, 'Very Good Experience', NULL, NULL, '2023-03-02 03:31:58', '2023-03-02 03:31:58'),
(19, 2, 37, 10, 4, 'Very Good Experience', NULL, NULL, '2023-03-02 03:31:58', '2023-03-02 03:31:58'),
(20, 2, 38, 3, 5, 'Very Good Experience', NULL, NULL, '2023-03-02 03:31:58', '2023-03-02 03:31:58'),
(21, 2, 36, 13, 5, 'Very Good Experience', NULL, NULL, '2023-03-02 03:31:58', '2023-03-02 03:31:58'),
(22, 2, 39, 15, 3, 'Very Good Experience', NULL, NULL, '2023-03-02 03:31:58', '2023-03-02 03:31:58'),
(23, 2, 37, 15, 1, 'Very Good Experience', NULL, NULL, '2023-03-02 03:31:58', '2023-03-02 03:31:58'),
(24, 2, 40, 11, 5, 'Very Good Experience', NULL, NULL, '2023-03-02 03:31:58', '2023-03-02 03:31:58'),
(25, 2, 38, 9, 4, 'Very Good Experience', NULL, NULL, '2023-03-02 03:31:58', '2023-03-02 03:31:58'),
(26, 2, 35, 8, 3, 'Very Good Experience', NULL, NULL, '2023-03-02 03:31:58', '2023-03-02 03:31:58'),
(27, 2, 40, 11, 1, 'Very Good Experience', NULL, NULL, '2023-03-02 03:31:58', '2023-03-02 03:31:58'),
(28, 2, 40, 9, 4, 'Very Good Experience', NULL, NULL, '2023-03-02 03:31:58', '2023-03-02 03:31:58'),
(30, 2, 35, 7, 4, 'Very Good Experience', NULL, NULL, '2023-03-02 03:31:58', '2023-03-02 03:31:58'),
(31, 2, 40, 8, 5, 'Very Good Experience', NULL, NULL, '2023-03-02 03:31:58', '2023-03-02 03:31:58'),
(32, 2, 38, 9, 2, 'Very Good Experience', NULL, NULL, '2023-03-02 03:31:58', '2023-03-02 03:31:58'),
(33, 2, 38, 7, 4, 'Very Good Experience', NULL, NULL, '2023-03-02 03:31:58', '2023-03-02 03:31:58'),
(34, 2, 37, 12, 1, 'Very Good Experience', NULL, NULL, '2023-03-02 03:31:58', '2023-03-02 03:31:58'),
(35, 2, 38, 5, 4, 'Very Good Experience', NULL, NULL, '2023-03-02 03:31:58', '2023-03-02 03:31:58'),
(36, 2, 37, 3, 3, 'Very Good Experience', NULL, NULL, '2023-03-02 03:31:58', '2023-03-02 03:31:58'),
(37, 2, 37, 7, 3, 'Very Good Experience', NULL, NULL, '2023-03-02 03:31:58', '2023-03-02 03:31:58'),
(38, 2, 40, 15, 4, 'Very Good Experience', NULL, NULL, '2023-03-02 03:31:58', '2023-03-02 03:31:58'),
(39, 2, 36, 9, 5, 'Very Good Experience', NULL, NULL, '2023-03-02 03:31:58', '2023-03-02 03:31:58'),
(40, 2, 35, 8, 3, 'Very Good Experience', NULL, NULL, '2023-03-02 03:31:58', '2023-03-02 03:31:58'),
(41, 2, 39, 3, 2, 'Very Good Experience', NULL, NULL, '2023-03-02 03:31:58', '2023-03-02 03:31:58'),
(42, 2, 36, 7, 3, 'Very Good Experience', NULL, NULL, '2023-03-02 03:31:58', '2023-03-02 03:31:58'),
(43, 2, 35, 10, 1, 'Very Good Experience', NULL, NULL, '2023-03-02 03:31:58', '2023-03-02 03:31:58'),
(44, 2, 38, 9, 5, 'Very Good Experience', NULL, NULL, '2023-03-02 03:31:58', '2023-03-02 03:31:58'),
(45, 2, 36, 13, 5, 'Very Good Experience', NULL, NULL, '2023-03-02 03:31:58', '2023-03-02 03:31:58'),
(46, 2, 36, 10, 2, 'Very Good Experience', NULL, NULL, '2023-03-02 03:31:58', '2023-03-02 03:31:58'),
(47, 2, 36, 13, 3, 'Very Good Experience', NULL, NULL, '2023-03-02 03:31:58', '2023-03-02 03:31:58'),
(48, 2, 40, 10, 2, 'Very Good Experience', NULL, NULL, '2023-03-02 03:31:58', '2023-03-02 03:31:58'),
(49, 2, 38, 10, 2, 'Very Good Experience', NULL, NULL, '2023-03-02 03:31:58', '2023-03-02 03:31:58'),
(51, 2, 39, 9, 2, 'Very Good Experience', NULL, NULL, '2023-03-02 03:32:40', '2023-03-02 03:32:40'),
(53, 2, 37, 10, 1, 'Very Good Experience', NULL, NULL, '2023-03-02 03:32:40', '2023-03-02 03:32:40'),
(54, 2, 36, 16, 3, 'Very Good Experience', NULL, NULL, '2023-03-02 03:32:40', '2023-03-02 03:32:40'),
(55, 2, 37, 13, 1, 'Very Good Experience', NULL, NULL, '2023-03-02 03:32:40', '2023-03-02 03:32:40'),
(56, 2, 39, 10, 5, 'Very Good Experience', NULL, NULL, '2023-03-02 03:32:40', '2023-03-02 03:32:40'),
(57, 2, 38, 8, 4, 'Very Good Experience', NULL, NULL, '2023-03-02 03:32:40', '2023-03-02 03:32:40'),
(58, 2, 38, 4, 4, 'Very Good Experience', 'Thanks', '2023-03-01', '2023-03-02 03:32:40', '2023-03-02 03:32:40'),
(59, 2, 40, 5, 3, 'Very Good Experience', NULL, NULL, '2023-03-02 03:32:40', '2023-03-02 03:32:40'),
(60, 2, 36, 6, 4, 'Very Good Experience', NULL, NULL, '2023-03-02 03:32:40', '2023-03-02 03:32:40'),
(61, 2, 38, 13, 5, 'Very Good Experience', NULL, NULL, '2023-03-02 03:32:40', '2023-03-02 03:32:40'),
(62, 2, 36, 15, 4, 'Very Good Experience', NULL, NULL, '2023-03-02 03:32:40', '2023-03-02 03:32:40'),
(64, 2, 38, 6, 3, 'Very Good Experience', NULL, NULL, '2023-03-02 03:32:40', '2023-03-02 03:32:40'),
(65, 2, 39, 4, 1, 'Very Good Experience', NULL, NULL, '2023-03-02 03:32:40', '2023-03-02 03:32:40'),
(66, 2, 40, 15, 2, 'Very Good Experience', NULL, NULL, '2023-03-02 03:32:40', '2023-03-02 03:32:40'),
(67, 2, 38, 12, 5, 'Very Good Experience', NULL, NULL, '2023-03-02 03:32:40', '2023-03-02 03:32:40'),
(68, 2, 37, 12, 1, 'Very Good Experience', NULL, NULL, '2023-03-02 03:32:40', '2023-03-02 03:32:40'),
(69, 2, 36, 4, 3, 'Very Good Experience', NULL, NULL, '2023-03-02 03:32:40', '2023-03-02 03:32:40'),
(70, 2, 35, 4, 5, 'Very Good Experience', NULL, NULL, '2023-03-02 03:32:40', '2023-03-02 03:32:40'),
(71, 2, 40, 13, 5, 'Very Good Experience', NULL, NULL, '2023-03-02 03:32:40', '2023-03-02 03:32:40'),
(72, 2, 40, 15, 3, 'Very Good Experience', NULL, NULL, '2023-03-02 03:32:40', '2023-03-02 03:32:40'),
(73, 2, 40, 10, 5, 'Very Good Experience', NULL, NULL, '2023-03-02 03:32:40', '2023-03-02 03:32:40'),
(74, 2, 38, 3, 2, 'Very Good Experience', NULL, NULL, '2023-03-02 03:32:40', '2023-03-02 03:32:40'),
(75, 2, 37, 10, 5, 'Very Good Experience', NULL, NULL, '2023-03-02 03:32:40', '2023-03-02 03:32:40'),
(76, 2, 40, 9, 1, 'Very Good Experience', NULL, NULL, '2023-03-02 03:32:40', '2023-03-02 03:32:40'),
(77, 2, 40, 6, 3, 'Very Good Experience', NULL, NULL, '2023-03-02 03:32:40', '2023-03-02 03:32:40'),
(78, 2, 36, 3, 1, 'Very Good Experience', NULL, NULL, '2023-03-02 03:32:40', '2023-03-02 03:32:40'),
(79, 2, 36, 10, 2, 'Very Good Experience', NULL, NULL, '2023-03-02 03:32:40', '2023-03-02 03:32:40'),
(80, 2, 40, 3, 1, 'Very Good Experience', NULL, NULL, '2023-03-02 03:32:40', '2023-03-02 03:32:40'),
(81, 2, 37, 4, 1, 'Very Good Experience', NULL, NULL, '2023-03-02 03:32:40', '2023-03-02 03:32:40'),
(82, 2, 35, 9, 1, 'Very Good Experience', NULL, NULL, '2023-03-02 03:32:40', '2023-03-02 03:32:40'),
(83, 2, 38, 12, 4, 'Very Good Experience', NULL, NULL, '2023-03-02 03:32:40', '2023-03-02 03:32:40'),
(84, 2, 40, 15, 1, 'Very Good Experience', NULL, NULL, '2023-03-02 03:32:40', '2023-03-02 03:32:40'),
(85, 2, 36, 8, 2, 'Very Good Experience', NULL, NULL, '2023-03-02 03:32:40', '2023-03-02 03:32:40'),
(86, 2, 37, 15, 5, 'Very Good Experience', NULL, NULL, '2023-03-02 03:32:40', '2023-03-02 03:32:40'),
(87, 2, 35, 12, 5, 'Very Good Experience', NULL, NULL, '2023-03-02 03:32:40', '2023-03-02 03:32:40'),
(88, 2, 38, 11, 2, 'Very Good Experience', NULL, NULL, '2023-03-02 03:32:40', '2023-03-02 03:32:40'),
(89, 2, 40, 11, 3, 'Very Good Experience', NULL, NULL, '2023-03-02 03:32:40', '2023-03-02 03:32:40'),
(90, 2, 37, 16, 3, 'Very Good Experience', NULL, NULL, '2023-03-02 03:32:40', '2023-03-02 03:32:40'),
(91, 2, 37, 6, 5, 'Very Good Experience', NULL, NULL, '2023-03-02 03:32:40', '2023-03-02 03:32:40'),
(92, 2, 40, 12, 1, 'Very Good Experience', NULL, NULL, '2023-03-02 03:32:40', '2023-03-02 03:32:40'),
(93, 2, 38, 7, 4, 'Very Good Experience', NULL, NULL, '2023-03-02 03:32:40', '2023-03-02 03:32:40'),
(94, 2, 39, 11, 5, 'Very Good Experience', NULL, NULL, '2023-03-02 03:32:40', '2023-03-02 03:32:40'),
(95, 2, 38, 10, 3, 'Very Good Experience', NULL, NULL, '2023-03-02 03:32:40', '2023-03-02 03:32:40'),
(96, 2, 40, 12, 3, 'Very Good Experience', NULL, NULL, '2023-03-02 03:32:40', '2023-03-02 03:32:40'),
(97, 2, 37, 7, 5, 'Very Good Experience', NULL, NULL, '2023-03-02 03:32:40', '2023-03-02 03:32:40'),
(98, 2, 36, 11, 3, 'Very Good Experience', NULL, NULL, '2023-03-02 03:32:40', '2023-03-02 03:32:40'),
(99, 2, 40, 11, 5, 'Very Good Experience', NULL, NULL, '2023-03-02 03:32:40', '2023-03-02 03:32:40'),
(100, 2, 35, 11, 3, 'Very Good Experience', NULL, NULL, '2023-03-02 03:32:40', '2023-03-02 03:32:40'),
(101, 2, 37, 13, 5, 'Very Good Experience', NULL, NULL, '2023-03-02 03:32:40', '2023-03-02 03:32:40'),
(102, 2, 35, 12, 5, 'Very Good Experience', NULL, NULL, '2023-03-02 03:32:40', '2023-03-02 03:32:40'),
(103, 2, 40, 12, 1, 'Very Good Experience', NULL, NULL, '2023-03-02 03:32:40', '2023-03-02 03:32:40'),
(104, 2, 40, 10, 2, 'Very Good Experience', NULL, NULL, '2023-03-02 03:32:40', '2023-03-02 03:32:40'),
(105, 2, 35, 9, 5, 'Very Good Experience', NULL, NULL, '2023-03-02 03:32:40', '2023-03-02 03:32:40'),
(106, 2, 35, 9, 3, 'Very Good Experience', NULL, NULL, '2023-03-02 03:32:40', '2023-03-02 03:32:40'),
(107, 2, 40, 11, 2, 'Very Good Experience', NULL, NULL, '2023-03-02 03:32:40', '2023-03-02 03:32:40'),
(108, 2, 37, 10, 1, 'Very Good Experience', NULL, NULL, '2023-03-02 03:32:40', '2023-03-02 03:32:40'),
(109, 2, 38, 8, 2, 'Very Good Experience', NULL, NULL, '2023-03-02 03:32:40', '2023-03-02 03:32:40'),
(110, 2, 40, 3, 3, 'Very Good Experience', NULL, NULL, '2023-03-02 03:32:40', '2023-03-02 03:32:40'),
(111, 2, 38, 15, 5, 'Very Good Experience', NULL, NULL, '2023-03-02 03:32:40', '2023-03-02 03:32:40'),
(112, 2, 36, 9, 5, 'Very Good Experience', NULL, NULL, '2023-03-02 03:32:40', '2023-03-02 03:32:40'),
(113, 2, 36, 7, 2, 'Very Good Experience', NULL, NULL, '2023-03-02 03:32:40', '2023-03-02 03:32:40'),
(114, 2, 37, 8, 5, 'Very Good Experience', NULL, NULL, '2023-03-02 03:32:40', '2023-03-02 03:32:40'),
(115, 2, 38, 3, 4, 'Very Good Experience', NULL, NULL, '2023-03-02 03:32:40', '2023-03-02 03:32:40'),
(116, 2, 37, 6, 1, 'Very Good Experience', NULL, NULL, '2023-03-02 03:32:40', '2023-03-02 03:32:40'),
(117, 2, 40, 11, 2, 'Very Good Experience', NULL, NULL, '2023-03-02 03:32:40', '2023-03-02 03:32:40'),
(118, 2, 40, 15, 4, 'Very Good Experience', NULL, NULL, '2023-03-02 03:32:40', '2023-03-02 03:32:40'),
(120, 2, 40, 6, 1, 'Very Good Experience', NULL, NULL, '2023-03-02 03:32:40', '2023-03-02 03:32:40'),
(121, 2, 37, 13, 2, 'Very Good Experience', NULL, NULL, '2023-03-02 03:32:40', '2023-03-02 03:32:40'),
(122, 2, 35, 16, 2, 'Very Good Experience', NULL, NULL, '2023-03-02 03:32:40', '2023-03-02 03:32:40'),
(123, 2, 40, 5, 1, 'Very Good Experience', NULL, NULL, '2023-03-02 03:32:40', '2023-03-02 03:32:40'),
(124, 2, 39, 6, 5, 'Very Good Experience', NULL, NULL, '2023-03-02 03:32:40', '2023-03-02 03:32:40'),
(125, 2, 37, 13, 3, 'Very Good Experience', NULL, NULL, '2023-03-02 03:32:40', '2023-03-02 03:32:40'),
(126, 2, 39, 16, 5, 'Very Good Experience', NULL, NULL, '2023-03-02 03:32:40', '2023-03-02 03:32:40'),
(127, 2, 38, 15, 3, 'Very Good Experience', NULL, NULL, '2023-03-02 03:32:40', '2023-03-02 03:32:40'),
(128, 2, 37, 15, 2, 'Very Good Experience', NULL, NULL, '2023-03-02 03:32:40', '2023-03-02 03:32:40'),
(129, 2, 36, 3, 3, 'Very Good Experience', NULL, NULL, '2023-03-02 03:32:40', '2023-03-02 03:32:40'),
(130, 2, 39, 3, 5, 'Very Good Experience', NULL, NULL, '2023-03-02 03:32:40', '2023-03-02 03:32:40'),
(131, 2, 39, 15, 5, 'Very Good Experience', NULL, NULL, '2023-03-02 03:32:40', '2023-03-02 03:32:40'),
(132, 2, 35, 3, 2, 'Very Good Experience', NULL, NULL, '2023-03-02 03:32:40', '2023-03-02 03:32:40'),
(133, 2, 39, 3, 4, 'Very Good Experience', NULL, NULL, '2023-03-02 03:32:40', '2023-03-02 03:32:40'),
(134, 2, 36, 8, 4, 'Very Good Experience', NULL, NULL, '2023-03-02 03:32:40', '2023-03-02 03:32:40'),
(135, 2, 37, 4, 4, 'Very Good Experience', NULL, NULL, '2023-03-02 03:32:40', '2023-03-02 03:32:40'),
(136, 2, 40, 16, 5, 'Very Good Experience', NULL, NULL, '2023-03-02 03:32:40', '2023-03-02 03:32:40'),
(137, 2, 38, 15, 4, 'Very Good Experience', NULL, NULL, '2023-03-02 03:32:40', '2023-03-02 03:32:40'),
(138, 2, 37, 7, 4, 'Very Good Experience', NULL, NULL, '2023-03-02 03:32:40', '2023-03-02 03:32:40'),
(140, 2, 37, 15, 2, 'Very Good Experience', NULL, NULL, '2023-03-02 03:32:40', '2023-03-02 03:32:40'),
(141, 2, 35, 9, 1, 'Very Good Experience', NULL, NULL, '2023-03-02 03:32:40', '2023-03-02 03:32:40'),
(142, 2, 39, 12, 1, 'Very Good Experience', NULL, NULL, '2023-03-02 03:32:40', '2023-03-02 03:32:40'),
(143, 2, 35, 16, 3, 'Very Good Experience', NULL, NULL, '2023-03-02 03:32:40', '2023-03-02 03:32:40'),
(145, 2, 37, 9, 4, 'Very Good Experience', NULL, NULL, '2023-03-02 03:32:40', '2023-03-02 03:32:40'),
(146, 2, 36, 5, 2, 'Very Good Experience', NULL, NULL, '2023-03-02 03:32:40', '2023-03-02 03:32:40'),
(147, 2, 38, 5, 1, 'Very Good Experience', NULL, NULL, '2023-03-02 03:32:40', '2023-03-02 03:32:40'),
(148, 2, 39, 12, 2, 'Very Good Experience', NULL, NULL, '2023-03-02 03:32:40', '2023-03-02 03:32:40'),
(149, 2, 38, 13, 4, 'Very Good Experience', NULL, NULL, '2023-03-02 03:32:40', '2023-03-02 03:32:40'),
(150, 2, 37, 7, 5, 'Very Good Experience', NULL, NULL, '2023-03-02 03:32:40', '2023-03-02 03:32:40'),
(151, 2, 40, 13, 1, 'Very Good Experience', NULL, NULL, '2023-03-02 03:32:40', '2023-03-02 03:32:40'),
(152, 2, 39, 10, 5, 'Very Good Experience', NULL, NULL, '2023-03-02 03:32:40', '2023-03-02 03:32:40'),
(153, 2, 35, 8, 1, 'Very Good Experience', NULL, NULL, '2023-03-02 03:32:40', '2023-03-02 03:32:40'),
(154, 2, 40, 15, 3, 'Very Good Experience', NULL, NULL, '2023-03-02 03:32:40', '2023-03-02 03:32:40'),
(155, 2, 38, 8, 3, 'Very Good Experience', NULL, NULL, '2023-03-02 03:32:40', '2023-03-02 03:32:40'),
(156, 2, 37, 8, 5, 'Very Good Experience', NULL, NULL, '2023-03-02 03:32:40', '2023-03-02 03:32:40'),
(158, 2, 37, 16, 4, 'Very Good Experience', NULL, NULL, '2023-03-02 03:32:40', '2023-03-02 03:32:40'),
(159, 2, 35, 4, 1, 'Very Good Experience', NULL, NULL, '2023-03-02 03:32:40', '2023-03-02 03:32:40'),
(160, 2, 35, 5, 1, 'Very Good Experience', NULL, NULL, '2023-03-02 03:32:40', '2023-03-02 03:32:40'),
(161, 2, 37, 7, 1, 'Very Good Experience', NULL, NULL, '2023-03-02 03:32:40', '2023-03-02 03:32:40'),
(162, 2, 36, 3, 3, 'Very Good Experience', NULL, NULL, '2023-03-02 03:32:40', '2023-03-02 03:32:40'),
(163, 2, 40, 8, 4, 'Very Good Experience', NULL, NULL, '2023-03-02 03:32:40', '2023-03-02 03:32:40'),
(164, 2, 40, 11, 3, 'Very Good Experience', NULL, NULL, '2023-03-02 03:32:40', '2023-03-02 03:32:40'),
(165, 2, 35, 7, 5, 'Very Good Experience', NULL, NULL, '2023-03-02 03:32:40', '2023-03-02 03:32:40'),
(166, 2, 35, 15, 5, 'Very Good Experience', NULL, NULL, '2023-03-02 03:32:40', '2023-03-02 03:32:40'),
(167, 2, 36, 4, 3, 'Very Good Experience', NULL, NULL, '2023-03-02 03:32:40', '2023-03-02 03:32:40'),
(168, 2, 38, 3, 4, 'Very Good Experience', NULL, NULL, '2023-03-02 03:32:40', '2023-03-02 03:32:40'),
(170, 2, 39, 5, 3, 'Very Good Experience', NULL, NULL, '2023-03-02 03:32:40', '2023-03-02 03:32:40'),
(171, 2, 37, 3, 2, 'Very Good Experience', NULL, NULL, '2023-03-02 03:32:40', '2023-03-02 03:32:40'),
(172, 2, 38, 13, 5, 'Very Good Experience', NULL, NULL, '2023-03-02 03:32:40', '2023-03-02 03:32:40'),
(173, 2, 35, 13, 1, 'Very Good Experience', NULL, NULL, '2023-03-02 03:32:40', '2023-03-02 03:32:40'),
(174, 2, 37, 8, 2, 'Very Good Experience', NULL, NULL, '2023-03-02 03:32:40', '2023-03-02 03:32:40'),
(175, 2, 36, 15, 5, 'Very Good Experience', NULL, NULL, '2023-03-02 03:32:40', '2023-03-02 03:32:40'),
(176, 2, 37, 9, 2, 'Very Good Experience', NULL, NULL, '2023-03-02 03:32:40', '2023-03-02 03:32:40'),
(177, 2, 36, 13, 4, 'Very Good Experience', NULL, NULL, '2023-03-02 03:32:40', '2023-03-02 03:32:40'),
(178, 2, 40, 6, 1, 'Very Good Experience', NULL, NULL, '2023-03-02 03:32:40', '2023-03-02 03:32:40'),
(179, 2, 38, 4, 3, 'Very Good Experience', NULL, NULL, '2023-03-02 03:32:40', '2023-03-02 03:32:40'),
(180, 2, 36, 15, 1, 'Very Good Experience', NULL, NULL, '2023-03-02 03:32:40', '2023-03-02 03:32:40'),
(181, 2, 37, 12, 3, 'Very Good Experience', NULL, NULL, '2023-03-02 03:32:40', '2023-03-02 03:32:40'),
(182, 2, 38, 11, 2, 'Very Good Experience', NULL, NULL, '2023-03-02 03:32:40', '2023-03-02 03:32:40'),
(183, 2, 38, 11, 4, 'Very Good Experience', NULL, NULL, '2023-03-02 03:32:40', '2023-03-02 03:32:40'),
(184, 2, 39, 5, 1, 'Very Good Experience', NULL, NULL, '2023-03-02 03:32:40', '2023-03-02 03:32:40'),
(185, 2, 36, 12, 3, 'Very Good Experience', NULL, NULL, '2023-03-02 03:32:40', '2023-03-02 03:32:40'),
(186, 2, 35, 6, 3, 'Very Good Experience', NULL, NULL, '2023-03-02 03:32:40', '2023-03-02 03:32:40'),
(187, 2, 40, 16, 5, 'Very Good Experience', NULL, NULL, '2023-03-02 03:32:40', '2023-03-02 03:32:40'),
(188, 2, 37, 11, 3, 'Very Good Experience', NULL, NULL, '2023-03-02 03:32:40', '2023-03-02 03:32:40'),
(189, 2, 35, 13, 3, 'Very Good Experience', NULL, NULL, '2023-03-02 03:32:40', '2023-03-02 03:32:40'),
(190, 2, 38, 10, 3, 'Very Good Experience', NULL, NULL, '2023-03-02 03:32:40', '2023-03-02 03:32:40'),
(191, 2, 37, 13, 1, 'Very Good Experience', NULL, NULL, '2023-03-02 03:32:40', '2023-03-02 03:32:40'),
(192, 2, 35, 10, 4, 'Very Good Experience', NULL, NULL, '2023-03-02 03:32:40', '2023-03-02 03:32:40'),
(193, 2, 39, 12, 3, 'Very Good Experience', NULL, NULL, '2023-03-02 03:32:40', '2023-03-02 03:32:40'),
(194, 2, 38, 13, 5, 'Very Good Experience', NULL, NULL, '2023-03-02 03:32:40', '2023-03-02 03:32:40'),
(195, 2, 38, 3, 2, 'Very Good Experience', NULL, NULL, '2023-03-02 03:32:40', '2023-03-02 03:32:40'),
(196, 2, 39, 6, 4, 'Very Good Experience', NULL, NULL, '2023-03-02 03:32:40', '2023-03-02 03:32:40'),
(197, 2, 39, 15, 5, 'Very Good Experience', NULL, NULL, '2023-03-02 03:32:40', '2023-03-02 03:32:40'),
(198, 2, 39, 12, 1, 'Very Good Experience', NULL, NULL, '2023-03-02 03:32:40', '2023-03-02 03:32:40'),
(199, 2, 35, 9, 5, 'Very Good Experience', NULL, NULL, '2023-03-02 03:32:40', '2023-03-02 03:32:40'),
(200, 2, 40, 15, 4, 'Very Good Experience', NULL, NULL, '2023-03-02 03:32:40', '2023-03-02 03:32:40');

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
  `dome_id` int(11) DEFAULT NULL,
  `league_id` int(11) DEFAULT NULL,
  `field_id` varchar(255) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `booking_id` varchar(255) NOT NULL,
  `contributor_name` varchar(255) DEFAULT NULL,
  `payment_method` int(11) NOT NULL DEFAULT 1 COMMENT '1=Card, 2=Apple Pay, 3=Google Pay	',
  `transaction_id` varchar(255) NOT NULL,
  `amount` double(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `vendor_id`, `dome_id`, `league_id`, `field_id`, `user_id`, `booking_id`, `contributor_name`, `payment_method`, `transaction_id`, `amount`, `created_at`, `updated_at`) VALUES
(1, 2, 3, NULL, '3', 3, '344745', NULL, 2, 'OI3v7zGMF7', 21.00, '2022-12-12 19:06:01', '2022-12-12 19:06:01'),
(2, 2, 4, NULL, '1', 3, '643111', NULL, 2, 'SJbkABNqIA', 76.00, '2022-12-12 19:06:01', '2022-12-12 19:06:01'),
(3, 2, 3, NULL, '3', 3, '234374', NULL, 2, 'BeoX048BAA', 20.00, '2022-12-12 19:06:01', '2022-12-12 19:06:01'),
(4, 2, 1, NULL, '2', 3, '518257', NULL, 3, 'Y3oH25BdCj', 21.00, '2022-12-12 19:06:01', '2022-12-12 19:06:01'),
(5, 2, 3, NULL, '3', 3, '146627', NULL, 1, 'LboYc8CRqj', 13.00, '2022-12-12 19:06:01', '2022-12-12 19:06:01'),
(6, 2, 3, NULL, '2', 3, '166168', NULL, 3, 'awoySB9vEX', 54.00, '2022-12-12 19:06:01', '2022-12-12 19:06:01'),
(7, 2, 1, NULL, '2', 3, '408163', NULL, 3, 'go6HEG9YIQ', 48.00, '2022-12-12 19:06:01', '2022-12-12 19:06:01'),
(8, 2, 1, NULL, '3', 3, '467846', NULL, 3, 'F3WrVccBt3', 45.00, '2022-12-12 19:06:01', '2022-12-12 19:06:01'),
(9, 2, 1, NULL, '2', 3, '371420', NULL, 1, '4BvaU4k8RJ', 74.00, '2022-12-12 19:06:01', '2022-12-12 19:06:01'),
(10, 2, 3, NULL, '2', 3, '691642', NULL, 1, 'DediVzOOlT', 83.00, '2022-12-12 19:06:01', '2022-12-12 19:06:01'),
(11, 2, 4, NULL, '1', 3, '691884', NULL, 1, '60hM5JAek6', 93.00, '2022-12-12 19:06:01', '2022-12-12 19:06:01'),
(12, 2, 4, NULL, '1', 3, '513459', NULL, 3, 'CT5T5jNY6x', 84.00, '2022-12-12 19:06:01', '2022-12-12 19:06:01'),
(13, 2, 3, NULL, '2', 3, '716429', NULL, 1, '8ZIRXc4Lap', 75.00, '2022-12-12 19:06:01', '2022-12-12 19:06:01'),
(14, 2, 1, NULL, '3', 3, '483578', NULL, 1, 'tbhenin4ag', 32.00, '2022-12-12 19:06:01', '2022-12-12 19:06:01'),
(15, 2, 4, NULL, '1', 3, '348874', NULL, 3, 'sqPzEipZyf', 84.00, '2022-12-12 19:06:01', '2022-12-12 19:06:01'),
(16, 2, 1, NULL, '3', 3, '918370', NULL, 2, 'Ol4NVrGZIh', 38.00, '2022-12-12 19:06:01', '2022-12-12 19:06:01'),
(17, 2, 2, NULL, '1', 3, '699003', NULL, 3, '19WJONlAAi', 73.00, '2022-12-12 19:06:01', '2022-12-12 19:06:01'),
(18, 2, 4, NULL, '1', 3, '424867', NULL, 1, 'D6wCsh5zTq', 77.00, '2022-12-12 19:06:01', '2022-12-12 19:06:01'),
(19, 2, 2, NULL, '1', 3, '863175', NULL, 1, 'jdWhDDQeoL', 59.00, '2022-12-12 19:06:02', '2022-12-12 19:06:02'),
(20, 2, 1, NULL, '2', 3, '281408', NULL, 2, 'dVMlzBwypl', 88.00, '2022-12-12 19:06:02', '2022-12-12 19:06:02'),
(21, 2, 1, NULL, '3', 3, '479279', NULL, 3, 'gPDOIRFccc', 47.00, '2022-12-12 19:06:02', '2022-12-12 19:06:02'),
(22, 2, 4, NULL, '1', 3, '836934', NULL, 1, 'sEEQGslYup', 57.00, '2022-12-12 19:06:02', '2022-12-12 19:06:02'),
(23, 2, 4, NULL, '1', 3, '989315', NULL, 2, 'ORr6ycMxEJ', 14.00, '2022-12-12 19:06:02', '2022-12-12 19:06:02'),
(24, 2, 4, NULL, '3', 3, '682596', NULL, 2, 'BtPNv8UaDA', 23.00, '2022-12-12 19:06:02', '2022-12-12 19:06:02'),
(25, 2, 1, NULL, '1', 3, '321990', NULL, 2, 'sKQTpm08Uw', 64.00, '2022-12-12 19:06:02', '2022-12-12 19:06:02'),
(26, 2, 1, NULL, '2', 3, '469789', NULL, 3, 'BXFwN63rTH', 96.00, '2022-12-15 19:46:51', '2022-12-15 19:46:51'),
(27, 2, 2, NULL, '3', 3, '993232', NULL, 2, 'd8wLcp2xNC', 60.00, '2022-12-15 19:46:51', '2022-12-15 19:46:51'),
(28, 2, 4, NULL, '3', 3, '881106', NULL, 1, 'zmTrRIaEzs', 17.00, '2022-12-15 19:46:51', '2022-12-15 19:46:51'),
(29, 2, 4, NULL, '2', 3, '529624', NULL, 3, 'aAyKIhQDIi', 80.00, '2022-12-15 19:46:51', '2022-12-15 19:46:51'),
(30, 2, 1, NULL, '3', 3, '900633', NULL, 2, 'ytCbV8T3b1', 26.00, '2022-12-15 19:46:51', '2022-12-15 19:46:51'),
(31, 2, 3, NULL, '1', 3, '168110', NULL, 2, 'F2hfJiB8xm', 59.00, '2022-12-15 19:48:16', '2022-12-15 19:48:16'),
(32, 2, 4, NULL, '3', 3, '385074', NULL, 1, 'A2scV9KeCT', 60.00, '2022-12-15 19:48:16', '2022-12-15 19:48:16'),
(33, 2, 1, NULL, '1', 3, '274609', NULL, 3, 'ObX6QwRBgY', 58.00, '2022-12-15 19:48:16', '2022-12-15 19:48:16'),
(34, 2, 2, NULL, '3', 3, '904609', NULL, 3, 'tTzNqCk1M9', 57.00, '2022-12-15 19:48:16', '2022-12-15 19:48:16'),
(35, 2, 3, NULL, '1', 3, '852524', NULL, 2, 'bxDSr5WfkL', 95.00, '2022-12-15 19:48:16', '2022-12-15 19:48:16'),
(36, 2, 3, NULL, '2', 3, '604680', NULL, 3, 's1Te7Bc6ju', 13.00, '2022-12-19 22:36:52', '2022-12-19 22:36:52'),
(37, 2, 1, NULL, '3', 3, '456361', NULL, 3, 'TAqDgpbDYz', 36.00, '2022-12-19 22:36:52', '2022-12-19 22:36:52'),
(38, 2, 4, NULL, '1', 3, '539163', NULL, 1, 'gzQj1EMaNP', 41.00, '2022-12-19 22:36:52', '2022-12-19 22:36:52'),
(39, 2, 2, NULL, '3', 3, '780909', NULL, 3, 'ruCG4dtPrk', 37.00, '2022-12-19 22:36:52', '2022-12-19 22:36:52'),
(40, 2, 4, NULL, '3', 3, '670027', NULL, 1, 'bIAwgcKUl6', 78.00, '2022-12-19 22:36:52', '2022-12-19 22:36:52'),
(41, 3, 36, NULL, '3', 3, 'e26866', NULL, 1, 'ch_3Mg4Y3FysF0okTxJ1smALWh6', 1000.00, '2023-02-27 05:37:15', '2023-02-27 05:37:15'),
(42, 3, 36, NULL, '3', 7, '2a175a', NULL, 1, 'ch_3Mg4nnFysF0okTxJ1DReTQbE', 1000.00, '2023-02-27 05:53:31', '2023-02-27 05:53:31'),
(43, 3, 36, NULL, '3', 7, '5ab581', NULL, 1, 'ch_3Mg4oUFysF0okTxJ1TtuVNoB', 1000.00, '2023-02-27 05:54:15', '2023-02-27 05:54:15'),
(44, 3, 36, NULL, '3', 7, '1fe20d', NULL, 1, 'ch_3Mg4ocFysF0okTxJ1oHaYE7H', 1000.00, '2023-02-27 05:54:23', '2023-02-27 05:54:23'),
(45, 3, 36, NULL, '3', 7, 'e24229', NULL, 1, 'ch_3Mg4onFysF0okTxJ026ZGeh0', 1000.00, '2023-02-27 05:54:34', '2023-02-27 05:54:34'),
(46, 3, 36, NULL, '3', 7, '35f680', NULL, 1, 'ch_3Mg4p6FysF0okTxJ0XJaVT48', 1000.00, '2023-02-27 05:54:53', '2023-02-27 05:54:53'),
(47, 3, 36, NULL, '3', 7, 'f85558', NULL, 1, 'ch_3Mg4pZFysF0okTxJ0gQrSXzl', 1000.00, '2023-02-27 05:55:22', '2023-02-27 05:55:22'),
(48, 3, 36, NULL, '3', 7, '5d28b9', NULL, 1, 'ch_3Mg4ukFysF0okTxJ1BVElxeq', 1000.00, '2023-02-27 06:00:43', '2023-02-27 06:00:43'),
(49, 3, 36, NULL, '3', 7, '3f3b46', NULL, 1, 'ch_3Mg4v0FysF0okTxJ02EDrZn8', 1000.00, '2023-02-27 06:00:59', '2023-02-27 06:00:59'),
(50, 3, 36, NULL, '3', 7, 'adcf4a', NULL, 1, 'ch_3Mg4yOFysF0okTxJ0NRAQ1T9', 1000.00, '2023-02-27 06:04:29', '2023-02-27 06:04:29'),
(51, 3, 36, NULL, '3', 7, 'a2d4f6', NULL, 1, 'ch_3Mg4zTFysF0okTxJ1Vp49OrU', 1000.00, '2023-02-27 06:05:36', '2023-02-27 06:05:36'),
(52, 3, 36, NULL, '3', 7, 'f3a057', NULL, 1, 'ch_3Mg58uFysF0okTxJ01ybl8V6', 1000.00, '2023-02-27 06:15:21', '2023-02-27 06:15:21'),
(53, 3, 36, NULL, '3', 7, '97947f', NULL, 1, 'ch_3Mg5XgFysF0okTxJ1ysIUHdI', 1000.00, '2023-02-27 06:40:57', '2023-02-27 06:40:57'),
(54, 4, NULL, 2, '3', 3, '068afd', NULL, 1, 'ch_3MgLCoFysF0okTxJ0ue44fEB', 1000.00, '2023-02-27 23:24:26', '2023-02-27 23:24:26'),
(55, 4, NULL, 2, '3', 3, '4d7dcf', NULL, 1, 'ch_3MgLEDFysF0okTxJ1qTQk4nI', 1000.00, '2023-02-27 23:25:53', '2023-02-27 23:25:53'),
(56, 4, NULL, 2, '3', 3, 'c4e4f5', NULL, 1, 'ch_3MgLIQFysF0okTxJ1f8ubalw', 1000.00, '2023-02-27 23:30:15', '2023-02-27 23:30:15'),
(57, 4, NULL, 2, '3', 3, 'a7ee42', NULL, 1, 'ch_3MgLSoFysF0okTxJ10t7XCvA', 500.00, '2023-02-27 23:40:59', '2023-02-27 23:40:59'),
(58, 3, 36, NULL, '3', 3, 'b9af50', NULL, 1, 'ch_3MgLTMFysF0okTxJ1ya8U5tH', 500.00, '2023-02-27 23:41:32', '2023-02-27 23:41:32'),
(59, 3, 36, NULL, '3', 3, '2fe7c8', NULL, 1, 'ch_3MgNIVFysF0okTxJ1JaYhzem', 500.00, '2023-02-28 01:38:27', '2023-02-28 01:38:27'),
(60, 3, 36, NULL, '3', 3, 'e55606', NULL, 1, 'ch_3MgNJ4FysF0okTxJ04FECdZ8', 500.00, '2023-02-28 01:39:02', '2023-02-28 01:39:02'),
(61, 4, NULL, 2, '3', 3, '68725f', NULL, 1, 'ch_3MgNKLFysF0okTxJ0QP5NU2o', 500.00, '2023-02-28 01:40:21', '2023-02-28 01:40:21'),
(62, 4, NULL, 2, '3', 3, 'e27575', NULL, 1, 'ch_3MhAKZFysF0okTxJ0XIr9cyL', 500.00, '2023-03-02 05:59:51', '2023-03-02 05:59:51'),
(63, 4, NULL, 2, '3', 3, '095a8a', NULL, 2, 'pi_3MhAPDFysF0okTxJ169v3Uhe', 500.00, '2023-03-02 06:04:57', '2023-03-02 06:04:57'),
(64, 4, NULL, 2, '3', 3, '625d3e', NULL, 3, 'pi_3MhAPyFysF0okTxJ0rSzoSa8', 500.00, '2023-03-02 06:07:42', '2023-03-02 06:07:42'),
(65, 4, NULL, 2, '3', 3, 'ca9d2e', NULL, 3, 'pi_3MhASkFysF0okTxJ03UHylKm', 1000.00, '2023-03-02 06:09:39', '2023-03-02 06:09:39'),
(66, 4, NULL, 2, '3', 3, '68dfeb', NULL, 1, 'ch_3MhAbVFysF0okTxJ1s1rMCNK', 1000.00, '2023-03-02 06:17:21', '2023-03-02 06:17:21'),
(67, 4, NULL, 2, '3', 3, '9f8d18', NULL, 2, 'pi_3MhAcDFysF0okTxJ1Lff0WbC', 1000.00, '2023-03-02 06:19:00', '2023-03-02 06:19:00'),
(68, 4, NULL, 2, '3', 3, '6bb93d', NULL, 2, 'pi_3MhCBLFysF0okTxJ1nUGQ0pJ', 1000.00, '2023-03-02 08:00:26', '2023-03-02 08:00:26'),
(69, 4, NULL, 2, '3', 3, 'ae2152', NULL, 2, 'pi_3MhCBLFysFokTxJ1nUGQ0pJ', 1000.00, '2023-03-02 08:01:36', '2023-03-02 08:01:36'),
(70, 4, NULL, 2, '3', 3, 'cbf8b3', NULL, 2, 'pi_3MhCBLFysF0okTxJ1nUGQ0pJ', 1000.00, '2023-03-02 08:02:00', '2023-03-02 08:02:00'),
(71, 4, NULL, 2, '3', 3, 'f40253', NULL, 2, 'pi_3MhCBLFysF0okTxJ1nUGQ0pJ', 1000.00, '2023-03-02 08:02:22', '2023-03-02 08:02:22'),
(72, 4, NULL, 2, '3', 3, '2ec8c2', NULL, 2, 'pi_3MhCBLFysF0okTxJ1nUGQ0pJ', 1000.00, '2023-03-02 08:02:24', '2023-03-02 08:02:24'),
(73, 4, NULL, 2, '3', 3, '993fd8', NULL, 1, 'ch_3MhVCyFysF0okTxJ1MEoSw8n', 500.00, '2023-03-03 04:17:25', '2023-03-03 04:17:25'),
(74, 4, NULL, 2, '3', 3, '232edf', NULL, 1, 'ch_3MhVOpFysF0okTxJ1dxW0oPV', 500.00, '2023-03-03 04:29:40', '2023-03-03 04:29:40'),
(75, 4, NULL, 2, '3', 3, '8e71af', NULL, 1, 'ch_3MhVPxFysF0okTxJ0F1rwCP0', 500.00, '2023-03-03 04:30:49', '2023-03-03 04:30:49'),
(76, 4, NULL, 2, '3', 3, 'f0d27b', NULL, 1, 'ch_3MhVRHFysF0okTxJ1zhEQ4M6', 500.00, '2023-03-03 04:32:12', '2023-03-03 04:32:12'),
(78, 3, 36, NULL, '2', 3, 'f7f426', NULL, 1, 'ch_3MhW97FysF0okTxJ1Rf2uAru', 500.00, '2023-03-03 05:17:30', '2023-03-03 05:17:30'),
(79, 2, 3, NULL, '3', 4, '98e174', NULL, 2, 'ch_3MhVSWFysF0okTxJ0bDtwJwv', 21.00, '2022-12-12 19:06:01', '2022-12-12 19:06:01'),
(80, 2, 3, NULL, '3', NULL, '98e174', 'test', 2, 'OI3v7zGMF7', 1.00, '2022-12-12 19:06:01', '2022-12-12 19:06:01'),
(81, 2, 3, NULL, '3', NULL, '98e174', 'tetstest', 2, 'OI3v7zGMF7', 8.00, '2022-12-12 19:06:01', '2022-12-12 19:06:01'),
(82, 2, 3, NULL, '3', NULL, '98e174', 'test', 2, 'OI3v7zGMF7', 7.00, '2022-12-12 19:06:01', '2022-12-12 19:06:01'),
(83, 2, 3, NULL, '3', NULL, '98e174', 'test', 2, 'OI3v7zGMF7', 5.00, '2022-12-12 19:06:01', '2022-12-12 19:06:01'),
(84, 3, 36, NULL, '2', 3, '9f2d55', NULL, 1, 'ch_3MhWtBFysF0okTxJ1laJBbw8', 500.00, '2023-03-03 06:05:06', '2023-03-03 06:05:06');

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
  `countrycode` varchar(255) DEFAULT NULL,
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
(4, 3, 1, 'ahmed', 's@gmail.com', 'CA', '1234567988', '$2y$10$gifxyr72bUYjB8csJ0QBTeoIX.D/nYG0rAp1PRthL9af.EkQok4dq', NULL, NULL, NULL, NULL, NULL, 'user-63f3392b4218e.png', 1, 1, 2, '2023-02-09 04:55:36', '2023-03-03 06:54:24'),
(5, 3, 1, 'Siwakar', 'siwakar@gmail.com', 'CA', '6666666666', '$2y$10$HJpJ0YcLA8xpmy7vElmcDuwPhJKphXxvZZNsshwsKhKA73kqaDQSC', NULL, NULL, NULL, NULL, NULL, 'default.png', 1, 1, 2, '2023-02-17 05:44:14', '2023-02-17 05:44:14'),
(6, 3, 1, 'test1', 'shiva@gmail.com', 'CA', '12345679', '$2y$10$IeoPopibjXY5aAKkxxa9bepetQY6gAF1K/316ghgG5MzAqI1.3MfK', NULL, NULL, NULL, NULL, NULL, 'default.png', 1, 1, 2, '2023-02-19 01:50:12', '2023-02-19 01:50:12'),
(7, 3, 1, 'Soham', 'domez@gmail.com', 'CA', '6359478772', '$2y$10$gtan0ZH/DCiZmnR2yLGiyeZAR0YeEu9krVXGHQfXBqk63ep0WQEEm', NULL, NULL, NULL, NULL, NULL, 'default.png', 1, 1, 2, '2023-02-19 02:22:29', '2023-02-19 05:28:51'),
(8, 3, 1, 'Soham', 'rahul@gmail.com', 'CA', '6359478772', '$2y$10$X1zB07DVhnotX2/mINs8S.50S6zMODymJkeAESIQAFn7hN8vGS6t2', NULL, NULL, NULL, NULL, NULL, 'default.png', 1, 1, 2, '2023-02-19 04:05:29', '2023-02-19 04:05:29'),
(9, 3, 1, 'Soham', 'dhrutish@gmail.com', 'CA', '6359478772', '$2y$10$H1yMjmp7D/3EG.8qnvFRg.XW0U9SU1u7blXZMKpKNuCI/2BBgyOFi', NULL, NULL, NULL, NULL, NULL, 'default.png', 1, 1, 2, '2023-02-19 04:08:12', '2023-02-19 04:08:12'),
(10, 3, 1, 'test1', 'shivda@gmail.com', 'CA', '12345679', '$2y$10$JLjTCxbdEFMY/S2vQU7z5.MOu9DGHDbV1sqpSEaimoyVNMMyPKTmC', NULL, NULL, NULL, NULL, NULL, 'default.png', 1, 1, 2, '2023-02-19 05:59:51', '2023-02-19 05:59:51'),
(11, 3, 1, 'test1', 'shivdxa@gmail.com', 'CA', '12345679', '$2y$10$QSpgBloNHA7JhcHVrNl.zu8apCMuzFrn6MHxk/iT15UKuX.E8/w6O', NULL, NULL, NULL, NULL, NULL, 'default.png', 1, 1, 2, '2023-02-19 06:01:17', '2023-02-19 06:01:17'),
(12, 3, 1, 'test1', 'shivdxxa@gmail.com', 'CA', '12345679', '$2y$10$kovPuSe5RlvMtu9B9tkggOFA.C056m1RLx/jWzq3cpj8BWuY5C/N.', NULL, NULL, NULL, NULL, NULL, 'default.png', 1, 1, 2, '2023-02-19 06:01:39', '2023-02-19 06:01:39'),
(13, 3, 1, 'test1', 'shivdxxa@gmail.comx', 'CA', '12345679', '$2y$10$yL6EdwslUs4QaJst9tuSAOJXOv1U0JecesknmKdY0x1xgltJlCxZy', NULL, NULL, NULL, NULL, NULL, 'default.png', 1, 1, 2, '2023-02-19 06:02:37', '2023-02-19 06:02:37'),
(14, 3, 1, NULL, 'd@gmail.com', NULL, NULL, '$2y$10$15NTmYFdh3eVBKRdTXZwNu6nsRH/0MqPs.MS6h5eg0X5Z17FFnTnO', NULL, NULL, NULL, NULL, NULL, 'default.png', 1, 1, 2, '2023-02-27 05:44:49', '2023-02-27 05:44:49'),
(15, 3, 2, 'vraj chhatraya', 'vrajchhatraya@gmail.com', NULL, '8686532698', NULL, '107475471444076936237', NULL, NULL, NULL, NULL, 'user-63fdcf59afe4a.jpg', 1, 1, 2, '2023-02-28 04:19:38', '2023-02-28 04:24:33'),
(16, 3, 1, 'Diwakar Tiwari', 'tdiwakarkumar@gmail.com', 'IN', '7562904785', '$2y$10$pqybuiH79pR34A6q3J0VcO08OPSME1lP8bgeT3ILjPKmaHTG.iXj.', NULL, NULL, NULL, NULL, NULL, 'user-64004901ba7c2.png', 1, 1, 2, '2023-02-28 04:28:39', '2023-03-02 01:28:09');

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `cms`
--
ALTER TABLE `cms`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `domes`
--
ALTER TABLE `domes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `dome_images`
--
ALTER TABLE `dome_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `enquiries`
--
ALTER TABLE `enquiries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `favourites`
--
ALTER TABLE `favourites`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;

--
-- AUTO_INCREMENT for table `fields`
--
ALTER TABLE `fields`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `leagues`
--
ALTER TABLE `leagues`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `payment_gateways`
--
ALTER TABLE `payment_gateways`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=201;

--
-- AUTO_INCREMENT for table `sports`
--
ALTER TABLE `sports`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
