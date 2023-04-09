-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 08, 2023 at 01:54 PM
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
  `slots` text DEFAULT NULL COMMENT 'For Domes Booking Only',
  `start_date` date DEFAULT NULL COMMENT 'For Leagues Booking Only	',
  `end_date` date DEFAULT NULL COMMENT 'For Leagues Booking Only	',
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `sub_total` double NOT NULL DEFAULT 0,
  `service_fee` double NOT NULL DEFAULT 0,
  `hst` double NOT NULL DEFAULT 0,
  `total_amount` double(8,2) NOT NULL,
  `paid_amount` double(8,2) NOT NULL DEFAULT 0.00,
  `due_amount` double(8,2) NOT NULL DEFAULT 0.00,
  `refunded_amount` double DEFAULT 0,
  `payment_mode` int(11) NOT NULL DEFAULT 1 COMMENT '1=online,2=offline',
  `payment_type` int(11) NOT NULL DEFAULT 1 COMMENT '1=Full Amount, 2=Split Amount',
  `payment_status` int(11) NOT NULL DEFAULT 1 COMMENT '1=Complete,2=Partial',
  `booking_status` int(11) NOT NULL DEFAULT 1 COMMENT '1=Confirmed, 2=Pending, 3=Cancelled	',
  `token` text DEFAULT NULL,
  `players` int(11) NOT NULL,
  `customer_name` varchar(255) DEFAULT NULL,
  `customer_email` varchar(255) NOT NULL,
  `customer_mobile` varchar(255) DEFAULT NULL,
  `team_name` varchar(255) DEFAULT NULL COMMENT 'For Leagues Booking Only',
  `cancellation_reason` text DEFAULT NULL,
  `is_payment_released` tinyint(4) NOT NULL DEFAULT 2 COMMENT '1=Yes, 2=No',
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `type`, `vendor_id`, `dome_id`, `league_id`, `user_id`, `sport_id`, `field_id`, `booking_id`, `slots`, `start_date`, `end_date`, `start_time`, `end_time`, `sub_total`, `service_fee`, `hst`, `total_amount`, `paid_amount`, `due_amount`, `refunded_amount`, `payment_mode`, `payment_type`, `payment_status`, `booking_status`, `token`, `players`, `customer_name`, `customer_email`, `customer_mobile`, `team_name`, `cancellation_reason`, `is_payment_released`, `created_at`, `updated_at`) VALUES
(9, 1, 2, 35, NULL, 69, 10, '8', 'da545179', '01:30 PM - 03:00 PM,03:00 PM - 03:30 PM', '2023-04-07', NULL, '13:30:00', '15:30:00', 263, 10, 10, 283.00, 220.00, 63.00, 0, 1, 1, 1, 1, '2y102Hajf4sepsnEQi84P0gneLU2z9Y1JhEYe0Oxc7Fpn9IW88lx9d6', 12, 'diwakar', 'shivakar@gmail.com', '5385828289', '', NULL, 2, '2023-04-07 09:59:49', '2023-04-07 14:57:58'),
(10, 1, 2, 35, NULL, 69, 10, '8', '25fb48f3', '06:00 AM - 09:00 AM', '2023-04-28', NULL, '06:00:00', '09:00:00', 160, 8, 8, 176.00, 14.67, 161.33, 0, 1, 2, 2, 2, '2y10jgvLSiTPUaR3G86MrKcheNKx4L3ILaqw4l7zfMor1lpAqInkvbae', 12, 'diwakar', 'shivakar@gmail.com', '5385828289', '', NULL, 2, '2023-04-07 15:04:33', '2023-04-07 15:04:33'),
(11, 2, 2, 35, 11, 69, 6, '35,33,32,31,30', 'cab429c4', NULL, '2023-02-01', '2023-06-30', '09:00:00', '17:00:00', 1489, 74.45, 74.45, 1637.90, 1637.90, 0.00, 0, 1, 1, 1, 1, NULL, 55, 'diwakar', 'shivakar@gmail.com', '5385828289', 'null', NULL, 2, '2023-04-08 06:31:34', '2023-04-08 06:31:34'),
(12, 2, 2, 35, 11, 69, 6, '35,33,32,31,30', 'f085cc9a', NULL, '2023-02-01', '2023-06-30', '09:00:00', '17:00:00', 1489, 74.45, 74.45, 1637.90, 1637.90, 0.00, 0, 1, 1, 1, 1, NULL, 88, 'diwakar', 'shivakar@gmail.com', '5385828289', 'ffhh', NULL, 2, '2023-04-08 06:56:39', '2023-04-08 06:56:39'),
(13, 2, 2, 35, 11, 69, 6, '35,33,32,31,30', 'bb651c72', NULL, '2023-02-01', '2023-06-30', '09:00:00', '17:00:00', 1489, 74.45, 74.45, 1637.90, 1637.90, 0.00, 0, 1, 1, 1, 1, NULL, 99, 'diwakar', 'shivakar@gmail.com', '5385828289', 'vvhh', NULL, 2, '2023-04-08 07:02:28', '2023-04-08 07:02:28'),
(14, 2, 2, 35, 11, 69, 6, '35,33,32,31,30', '9e1920a2', NULL, '2023-02-01', '2023-06-30', '09:00:00', '17:00:00', 1489, 74.45, 74.45, 1637.90, 1637.90, 0.00, 0, 1, 1, 1, 1, NULL, 77, 'diwakar', 'shivakar@gmail.com', '5385828289', 'cc', NULL, 2, '2023-04-08 08:42:45', '2023-04-08 08:42:45'),
(15, 2, 2, 35, 11, 69, 6, '35,33,32,31,30', '0c9b00c0', NULL, '2023-02-01', '2023-06-30', '09:00:00', '17:00:00', 1489, 74.45, 74.45, 1637.90, 1637.90, 0.00, 0, 1, 1, 1, 1, NULL, 66, 'diwakar', 'shivakar@gmail.com', '5385828289', 'cvh', NULL, 2, '2023-04-08 10:19:36', '2023-04-08 10:19:36'),
(16, 2, 2, 35, 11, 69, 6, '35,33,32,31,30', '0d0e9f1b', NULL, '2023-02-01', '2023-06-30', '09:00:00', '17:00:00', 1489, 74.45, 74.45, 1637.90, 1637.90, 0.00, 0, 1, 1, 1, 1, NULL, 66, 'diwakar', 'shivakar@gmail.com', '5385828289', 'gg', NULL, 2, '2023-04-08 10:22:58', '2023-04-08 10:22:58'),
(17, 2, 2, 35, 11, 69, 6, '35,33,32,31,30', '8f2bc8a7', NULL, '2023-02-01', '2023-06-30', '09:00:00', '17:00:00', 1489, 74.45, 74.45, 1637.90, 1637.90, 0.00, 0, 1, 1, 1, 1, NULL, 66, 'diwakar', 'shivakar@gmail.com', '5385828289', 't', NULL, 2, '2023-04-08 10:24:47', '2023-04-08 10:24:47'),
(18, 2, 2, 35, 11, 69, 6, '35,33,32,31,30', '5339fede', NULL, '2023-02-01', '2023-06-30', '09:00:00', '17:00:00', 1489, 74.45, 74.45, 1637.90, 1637.90, 0.00, 0, 1, 1, 1, 1, NULL, 66, 'diwakar', 'shivakar@gmail.com', '5385828289', 'uuhh', NULL, 2, '2023-04-08 10:28:33', '2023-04-08 10:28:33'),
(19, 2, 2, 35, 11, 69, 6, '35,33,32,31,30', 'b0c00635', NULL, '2023-02-01', '2023-06-30', '09:00:00', '17:00:00', 1489, 74.45, 74.45, 1637.90, 1637.90, 0.00, 0, 1, 1, 1, 1, NULL, 67, 'diwakar', 'shivakar@gmail.com', '5385828289', 'be', NULL, 2, '2023-04-08 10:37:06', '2023-04-08 10:37:06'),
(20, 2, 2, 35, 11, 69, 6, '35,33,32,31,30', 'e27cc0af', NULL, '2023-02-01', '2023-06-30', '09:00:00', '17:00:00', 1489, 74.45, 74.45, 1637.90, 1637.90, 0.00, 0, 1, 1, 1, 1, NULL, 66, 'diwakar', 'shivakar@gmail.com', '5385828289', 'ff', NULL, 2, '2023-04-08 10:39:06', '2023-04-08 10:39:06'),
(21, 2, 2, 35, 11, 69, 6, '35,33,32,31,30', 'e9b83f74', NULL, '2023-02-01', '2023-06-30', '09:00:00', '17:00:00', 1489, 74.45, 74.45, 1637.90, 1637.90, 0.00, 0, 1, 1, 1, 1, NULL, 99, 'diwakar', 'shivakar@gmail.com', '5385828289', 'he', NULL, 2, '2023-04-08 10:40:23', '2023-04-08 10:40:23'),
(22, 2, 2, 35, 11, 69, 6, '35,33,32,31,30', '57d109c7', NULL, '2023-02-01', '2023-06-30', '09:00:00', '17:00:00', 1489, 74.45, 74.45, 1637.90, 1637.90, 0.00, 0, 1, 1, 1, 1, NULL, 55, 'diwakar', 'shivakar@gmail.com', '5385828289', 'jh', NULL, 2, '2023-04-08 10:41:28', '2023-04-08 10:41:28'),
(23, 2, 2, 35, 1, 69, 7, '36', '412aed29', NULL, '2023-05-26', '2023-08-25', '09:00:00', '17:00:00', 1489, 74.45, 74.45, 1637.90, 1637.90, 0.00, 0, 1, 1, 1, 1, NULL, 55, 'diwakar', 'shivakar@gmail.com', '5385828289', 'tr', NULL, 2, '2023-04-08 10:47:30', '2023-04-08 10:47:30');

-- --------------------------------------------------------

--
-- Table structure for table `cms`
--

CREATE TABLE `cms` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type` int(11) NOT NULL COMMENT '1=Privacy Policy, 2=Terms & Conditions, 3=Refund Policy, 4 - cancellation_policies',
  `content` longtext NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cms`
--

INSERT INTO `cms` (`id`, `type`, `content`, `created_at`, `updated_at`) VALUES
(1, 2, '<h1>Refund Policy</h1>\r\n\r\n<p>Our booking app offers a refund policy for cancellations made within a certain timeframe. Please review the cancellation policy for the specific activity or service you booked for refund eligibility information.</p>\r\n\r\n<p>No-shows are not eligible for refunds.</p>\r\n\r\n<p>If the activity or service is cancelled due to unforeseen circumstances such as weather or equipment failure, you may be eligible for a full or partial refund depending on the situation.</p>\r\n\r\n<h2>Requesting a Refund</h2>\r\n\r\n<p>To request a refund, please contact our customer service team as soon as possible. Refunds may take up to 5-7 business days to process.</p>\r\n\r\n<p>Refunds will be issued to the original payment method used for the booking.</p>\r\n\r\n<h2>Questions or Concerns</h2>\r\n\r\n<p>If you have any questions or concerns about our refund policy, please contact our customer service team for assistance.</p>\r\n\r\n<p>Note: Refund policies may be subject to change without notice. Please review the specific cancellation and refund policy for the activity or service you have booked for the most up-to-date information.</p>', '2023-03-10 04:36:27', '2023-03-31 01:42:14'),
(2, 1, '<h1>Privacy Policy</h1>\n\n<p>We at Most Advanced Booking System For Your Dome take your privacy seriously. This Privacy Policy outlines our practices for collecting, using, maintaining, protecting, and disclosing your information when you use our website.</p>\n\n<p>Please read this Privacy Policy carefully to understand our policies and practices regarding your information and how we will treat it. By accessing or using our website, you agree to this Privacy Policy. This Privacy Policy may change from time to time. Your continued use of our website after we make changes is deemed to be acceptance of those changes, so please check this Privacy Policy periodically for updates.</p>\n\n<h2>Information We Collect</h2>\n\n<p>We may collect personal information from you, such as your name, email address, and phone number, when you use our website. We may also collect non-personal information, such as your IP address and browser type, when you use our website.</p>\n\n<h2>How We Use Your Information</h2>\n\n<p>We may use your personal information to contact you, respond to your inquiries, and provide you with information about our services. We may also use your non-personal information to improve our website and customize your user experience.</p>\n\n<h2>How We Protect Your Information</h2>\n\n<p>We take reasonable measures to protect your information from unauthorized access, use, or disclosure. However, no method of transmission over the Internet or electronic storage is completely secure, so we cannot guarantee absolute security.</p>\n\n<h2>Disclosure of Your Information</h2>\n\n<p>We may disclose your information to third-party service providers who assist us in operating our website or providing our services. We may also disclose your information required by or we that disclosure is necessary to protect our rights, your safety, or the safety of others.</p>\n\n<h2>Links to Other Websites</h2>\n\n<p>Our website may contain links to other websites that are not owned or operated by us. We are not responsible for the privacy practices or content of these websites. We encourage you to read the privacy policies of these websites.</p>\n\n<h2>Contacting Us</h2>\n\n<p>If you have any questions or comments about this Privacy Policy or our practices, please contact us at info@mostadvancedbooking.com.</p>\n\n<h2>Effective Date</h2>\n\n<p>This Privacy Policy is effective as of January 1, 2022.</p>', '2023-03-10 04:37:12', '2023-03-10 04:37:59'),
(3, 4, '<h1>Refund Policy</h1>\r\n\r\n<p>Our booking app offers a refund policy for cancellations made within a certain timeframe. Please review the cancellation policy for the specific activity or service you booked for refund eligibility information.</p>\r\n\r\n<p>No-shows are not eligible for refunds.</p>\r\n\r\n<p>If the activity or service is cancelled due to unforeseen circumstances such as weather or equipment failure, you may be eligible for a full or partial refund depending on the situation.</p>\r\n\r\n<h2>Requesting a Refund</h2>\r\n\r\n<p>To request a refund, please contact our customer service team as soon as possible. Refunds may take up to 5-7 business days to process.</p>\r\n\r\n<p>Refunds will be issued to the original payment method used for the booking.</p>\r\n\r\n<h2>Questions or Concerns</h2>\r\n\r\n<p>If you have any questions or concerns about our refund policy, please contact our customer service team for assistance.</p>\r\n\r\n<p>Note: Refund policies may be subject to change without notice. Please review the specific cancellation and refund policy for the activity or service you have booked for the most up-to-date information.wdxqasdxsadxas</p>', '2023-03-31 01:43:18', '2023-03-31 01:43:18'),
(4, 3, '<h1>Refund Policy</h1>\r\n	<p>Our booking app offers a refund policy for cancellations made within a certain timeframe. Please review the cancellation policy for the specific activity or service you booked for refund eligibility information.</p>\r\n	<ul>\r\n		<li>No-shows are not eligible for refunds.</li>\r\n		<li>If the activity or service is cancelled due to unforeseen circumstances such as weather or equipment failure, you may be eligible for a full or partial refund depending on the situation.</li>\r\n		<li>To request a refund, please contact our customer service team as soon as possible. Refunds may take up to 5-7 business days to process.</li>\r\n		<li>Refunds will be issued to the original payment method used for the booking.</li>\r\n	</ul>\r\n	<p>If you have any questions or concerns about our refund policy, please contact our customer service team for assistance.</p>\r\n	<p class=\"note\">Note: Refund policies may be subject to change without notice. Please review the specific cancellation and refund policy for the activity or service you have booked for the most up-to-date information.</p>\r\n	<p class=\"contact\">Contact us at: <a href=\"tel:+123456789\">+123456789</a> or <a href=\"mailto:info@bookingapp.com\">info@bookingapp.com</a></p>', '2023-03-31 01:53:42', '2023-03-31 01:55:42');

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
  `slot_duration` tinyint(4) DEFAULT 1 COMMENT '1=60 Minutes, 2=90 Minutes',
  `start_time` varchar(255) NOT NULL,
  `end_time` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `lat` varchar(255) NOT NULL,
  `lng` varchar(255) NOT NULL,
  `benefits` varchar(255) NOT NULL,
  `benefits_description` text NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 2 COMMENT '1=yes,2=no',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `domes`
--

INSERT INTO `domes` (`id`, `vendor_id`, `sport_id`, `name`, `price`, `hst`, `address`, `pin_code`, `city`, `state`, `country`, `slot_duration`, `start_time`, `end_time`, `description`, `lat`, `lng`, `benefits`, `benefits_description`, `is_deleted`, `created_at`, `updated_at`) VALUES
(35, 2, '6,7,8,10', 'Domez', 0.00, 5.00, 'Costen Tax Solutions, Inc, Birdneck Road North, Virginia Beach, VA, USA', '23451', 'Summerside', 'Prince Edward Island', 'Canada', 1, '6:00 AM', '7:00 PM', 'DESCRIPTION', '28.5156729', '-81.4824233', 'Free Wifi|Changing Room|Parking|Pool|Others', 'benefits-DESCRIPTION', 2, '2023-02-20 03:57:09', '2023-04-03 06:55:09');

-- --------------------------------------------------------

--
-- Table structure for table `dome_images`
--

CREATE TABLE `dome_images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `dome_id` int(11) DEFAULT NULL,
  `league_id` int(11) DEFAULT NULL,
  `images` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `dome_images`
--

INSERT INTO `dome_images` (`id`, `dome_id`, `league_id`, `images`, `created_at`, `updated_at`) VALUES
(17, 35, NULL, 'dome-63f33f137daf5.png', '2023-02-20 04:06:19', '2023-02-20 04:06:19'),
(34, NULL, 1, 'league-63f33f137daf5.png', '2023-02-20 05:06:09', '2023-02-20 05:06:09'),
(35, NULL, 11, 'league-63f33f137daf5.png', '2023-02-20 05:06:44', '2023-02-20 05:06:44'),
(36, NULL, 16, 'league-63f33f137daf5.png', '2023-02-20 05:10:13', '2023-02-20 05:10:13');

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
  `is_replied` tinyint(1) NOT NULL DEFAULT 2 COMMENT '1=Yes, 2=No',
  `is_accepted` tinyint(1) NOT NULL DEFAULT 2 COMMENT '1=Yes, 2=No',
  `is_deleted` tinyint(1) NOT NULL DEFAULT 2 COMMENT '1=Yes, 2=No',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `enquiries`
--

INSERT INTO `enquiries` (`id`, `vendor_id`, `type`, `dome_name`, `dome_zipcode`, `dome_city`, `dome_state`, `dome_country`, `venue_name`, `venue_address`, `name`, `email`, `phone`, `subject`, `message`, `is_replied`, `is_accepted`, `is_deleted`, `created_at`, `updated_at`) VALUES
(1, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'shivakar@gmail.com', NULL, 'heyyya', 'hello big big issues', 2, 2, 2, '2023-04-06 09:58:12', '2023-04-06 09:58:12');

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
(9, 7, NULL, 21, '2023-02-22 00:38:11', '2023-02-22 00:38:11'),
(82, 7, NULL, 6, '2023-03-01 02:41:00', '2023-03-01 02:41:00'),
(137, 7, 35, NULL, '2023-04-01 04:41:57', '2023-04-01 04:41:57'),
(140, 7, NULL, 11, '2023-04-06 05:37:16', '2023-04-06 05:37:16'),
(144, 69, NULL, 1, '2023-04-06 09:53:17', '2023-04-06 09:53:17');

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
  `maintenance_date` date DEFAULT NULL,
  `in_maintenance` int(11) NOT NULL DEFAULT 2 COMMENT '1=Yes, 2=No',
  `is_available` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1=yes,2=no',
  `is_deleted` tinyint(4) NOT NULL DEFAULT 2 COMMENT '1=yes,2=no',
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `fields`
--

INSERT INTO `fields` (`id`, `vendor_id`, `dome_id`, `sport_id`, `name`, `area`, `min_person`, `max_person`, `image`, `maintenance_date`, `in_maintenance`, `is_available`, `is_deleted`, `created_at`, `updated_at`) VALUES
(2, 2, 35, '10', '2', 452.00, 5, 30, 'field-6712.jpg', NULL, 2, 1, 2, '2023-02-20 05:57:52', '2023-04-07 09:44:24'),
(8, 2, 35, '10', '3', 452.00, 10, 20, 'field-3851.jpg', NULL, 2, 1, 2, '2023-02-20 05:57:52', '2023-03-16 06:06:21'),
(14, 2, 35, '10', '4', 452.00, 5, 30, 'field-8856.jpg', NULL, 2, 1, 2, '2023-02-20 05:57:52', '2023-03-16 06:11:51'),
(20, 2, 35, '10', '5', 452.00, 10, 20, 'field-4042.jpg', NULL, 2, 1, 2, '2023-02-20 05:57:52', '2023-03-16 06:12:09'),
(26, 2, 35, '10', '6', 452.00, 5, 30, 'field-9648.jpg', NULL, 2, 1, 2, '2023-02-20 05:57:52', '2023-03-16 06:14:23'),
(30, 2, 35, '6', '2', 452.00, 5, 30, 'field-8878.jpg', NULL, 2, 1, 2, '2023-02-20 05:57:52', '2023-03-16 06:14:53'),
(31, 2, 35, '6', '3', 452.00, 5, 30, 'field-1132.jpg', NULL, 2, 1, 2, '2023-02-20 05:57:52', '2023-03-16 06:15:04'),
(32, 2, 35, '6', '4', 452.00, 5, 30, 'field-930.jpg', NULL, 2, 1, 2, '2023-02-20 05:57:52', '2023-03-16 06:15:17'),
(33, 2, 35, '6', '5', 452.00, 5, 30, 'field-3042.jpg', NULL, 2, 1, 2, '2023-02-20 05:57:52', '2023-03-16 06:15:30'),
(35, 2, 35, '6', '6', 452.00, 5, 30, 'field-6425.jpg', NULL, 2, 1, 2, '2023-02-20 05:57:52', '2023-03-16 06:15:45'),
(36, 2, 35, '7', '2', 452.00, 5, 30, 'field-1765.jpg', NULL, 2, 1, 2, '2023-02-20 05:57:52', '2023-03-16 06:16:24'),
(37, 2, 35, '7', '3', 452.00, 5, 30, 'field-8646.jpg', NULL, 2, 1, 2, '2023-02-20 05:57:52', '2023-03-16 06:16:20'),
(38, 2, 35, '7', '4', 452.00, 5, 30, 'field-6651.jpg', NULL, 2, 1, 2, '2023-02-20 05:57:52', '2023-03-16 06:16:15'),
(39, 2, 35, '7', '5', 452.00, 5, 30, 'field-7202.jpg', NULL, 2, 1, 2, '2023-02-20 05:57:52', '2023-03-16 06:17:00'),
(41, 2, 35, '7', '6', 452.00, 5, 30, 'field-7972.jpg', NULL, 2, 1, 2, '2023-02-20 05:57:52', '2023-03-16 06:16:03'),
(42, 2, 35, '9', '2', 452.00, 5, 30, 'field-2421.jpg', NULL, 2, 1, 2, '2023-02-20 05:57:52', '2023-03-16 06:18:12'),
(43, 2, 35, '9', '3', 452.00, 5, 30, 'field-8043.jpg', NULL, 2, 1, 2, '2023-02-20 05:57:52', '2023-03-16 06:18:20'),
(44, 2, 35, '9', '4', 452.00, 5, 30, 'field-4164.jpg', NULL, 2, 1, 2, '2023-02-20 05:57:52', '2023-03-16 06:18:36'),
(45, 2, 35, '9', '5', 452.00, 5, 30, 'field-5229.jpg', NULL, 2, 1, 2, '2023-02-20 05:57:52', '2023-03-16 06:18:42'),
(47, 2, 35, '9', '6', 452.00, 5, 30, 'field-9338.jpg', NULL, 2, 1, 2, '2023-02-20 05:57:52', '2023-03-16 06:18:47'),
(48, 2, 35, '8', '11', 452.00, 15, 30, 'field-6519.jpg', NULL, 2, 1, 2, '2023-02-20 05:57:52', '2023-03-16 06:21:55'),
(49, 2, 35, '8', '12', 452.00, 18, 30, 'field-9539.jpg', NULL, 2, 1, 2, '2023-02-20 05:57:52', '2023-03-16 06:22:01'),
(50, 2, 35, '8', '13', 452.00, 5, 30, 'field-4828.jpg', NULL, 2, 1, 2, '2023-02-20 05:57:52', '2023-03-16 06:22:04'),
(51, 2, 35, '8', '14', 452.00, 20, 30, 'field-4585.jpg', NULL, 2, 1, 2, '2023-02-20 05:57:52', '2023-03-16 06:22:08'),
(52, 2, 35, '8', '15', 452.00, 25, 30, 'field-9362.jpg', NULL, 2, 1, 2, '2023-02-20 05:57:52', '2023-03-16 06:22:12'),
(53, 2, 35, '8', '16', 452.00, 5, 30, 'field-897.jpg', NULL, 2, 1, 2, '2023-02-20 05:57:52', '2023-03-16 06:22:39'),
(54, 2, 35, '11', '21', 0.00, 5, 15, 'field-530.jpg', NULL, 2, 1, 2, '2023-03-16 06:38:44', '2023-03-16 06:38:44'),
(55, 2, 35, '11', '22', 0.00, 10, 20, 'field-4067.jpg', NULL, 2, 1, 2, '2023-03-16 06:39:54', '2023-03-16 06:39:54'),
(56, 2, 35, '12', '4', 0.00, 20, 40, 'field-7168.jpg', NULL, 2, 1, 2, '2023-03-16 06:42:14', '2023-03-16 06:42:14'),
(57, 2, 35, '12', '5', 0.00, 10, 20, 'field-8987.jpg', NULL, 2, 1, 2, '2023-03-16 06:43:04', '2023-03-16 06:43:04');

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
  `booking_deadline` date DEFAULT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `start_time` varchar(255) NOT NULL,
  `end_time` varchar(255) NOT NULL,
  `from_age` int(11) NOT NULL,
  `to_age` int(11) NOT NULL,
  `gender` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1=Men, 2=Women, 3=Other',
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

INSERT INTO `leagues` (`id`, `vendor_id`, `dome_id`, `field_id`, `sport_id`, `name`, `booking_deadline`, `start_date`, `end_date`, `start_time`, `end_time`, `from_age`, `to_age`, `gender`, `min_player`, `max_player`, `team_limit`, `price`, `is_deleted`, `created_at`, `updated_at`) VALUES
(1, 2, 35, '36', 7, 'The Golf League', '2023-05-05', '2023-05-26', '2023-08-25', '09:00 AM', '05:00 PM', 16, 28, 1, 12, 17, 13, 1489, 2, '2023-02-20 06:56:50', '2023-04-03 04:34:00'),
(11, 2, 35, '35,33,32,31,30', 6, 'The Soccer League', '2023-04-30', '2023-02-01', '2023-06-30', '09:00 AM', '05:00 PM', 16, 28, 1, 12, 17, 13, 1489, 2, '2023-02-20 06:56:50', '2023-04-02 12:30:39'),
(16, 2, 35, '26,20,14,8', 10, 'The Volleyball League', '2023-04-13', '2023-04-28', '2023-07-28', '09:00 AM', '05:00 PM', 16, 28, 1, 12, 17, 13, 1489, 2, '2023-02-20 06:56:50', '2023-04-02 11:55:53');

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
  `vendor_id` tinyint(4) NOT NULL,
  `account_id` varchar(255) DEFAULT NULL,
  `public_key` varchar(255) DEFAULT NULL,
  `secret_key` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payment_gateways`
--

INSERT INTO `payment_gateways` (`id`, `type`, `vendor_id`, `account_id`, `public_key`, `secret_key`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '', 'pk_test_51LlAvQFysF0okTxJURIkxuGDrkHuj0MwtW9BR7XAZlYZWoCVJ3F7tLR538Uonlw1msIhcm26oESamRKrVIzZOwMG00NvCxPLn8', 'sk_test_51LlAvQFysF0okTxJ2zYdNO3KY6BqSEQMCXuY7SxBvTlI7L2wEneSwWKL70Qhrsg52XWHm1aI95VN3Qna6R7dE7FU00JJ4aysw3', '2022-11-22 00:35:31', '2023-04-04 05:53:07'),
(2, 1, 2, 'acct_1MKDulSH4dKJS9Nn', NULL, NULL, '2023-04-04 05:55:59', '2023-04-04 05:55:59');

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
(2, 0, 35, 7, 2, 'sacds', NULL, NULL, '2023-04-01 15:34:36', '2023-04-01 15:34:36');

-- --------------------------------------------------------

--
-- Table structure for table `set_prices`
--

CREATE TABLE `set_prices` (
  `id` int(11) NOT NULL,
  `vendor_id` int(11) NOT NULL,
  `dome_id` int(11) NOT NULL,
  `sport_id` int(11) NOT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `price_type` int(11) NOT NULL DEFAULT 1 COMMENT '1=default,2=daywise',
  `price` double NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `set_prices`
--

INSERT INTO `set_prices` (`id`, `vendor_id`, `dome_id`, `sport_id`, `start_date`, `end_date`, `price_type`, `price`, `created_at`, `updated_at`) VALUES
(13, 2, 35, 6, NULL, NULL, 1, 180, '2023-03-12 05:30:16', '2023-03-12 05:30:16'),
(14, 2, 35, 7, NULL, NULL, 1, 200, '2023-03-12 05:30:16', '2023-03-12 05:30:16'),
(17, 2, 35, 10, NULL, NULL, 1, 120, '2023-03-12 05:30:16', '2023-03-12 05:30:16'),
(25, 2, 35, 8, NULL, NULL, 1, 140, '2023-04-03 06:55:09', '2023-04-03 06:55:09'),
(29, 2, 35, 10, '2023-04-06', '2023-05-31', 2, 0, '2023-04-06 07:26:32', '2023-04-06 07:26:32');

-- --------------------------------------------------------

--
-- Table structure for table `set_prices_days_slots`
--

CREATE TABLE `set_prices_days_slots` (
  `id` int(11) NOT NULL,
  `set_prices_id` int(11) NOT NULL,
  `dome_id` int(11) DEFAULT NULL,
  `sport_id` int(11) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `day` varchar(255) NOT NULL,
  `price` double NOT NULL DEFAULT 0,
  `status` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `set_prices_days_slots`
--

INSERT INTO `set_prices_days_slots` (`id`, `set_prices_id`, `dome_id`, `sport_id`, `date`, `start_time`, `end_time`, `day`, `price`, `status`, `created_at`, `updated_at`) VALUES
(1, 29, 35, 10, '2023-04-06', '12:00:00', '13:30:00', 'thursday', 220, 0, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(2, 29, 35, 10, '2023-04-06', '13:30:00', '15:00:00', 'thursday', 230, 0, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(3, 29, 35, 10, '2023-04-06', '15:00:00', '16:30:00', 'thursday', 180, 0, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(4, 29, 35, 10, '2023-04-06', '16:30:00', '18:00:00', 'thursday', 200, 1, '2023-04-06 07:26:32', '2023-04-06 09:48:59'),
(5, 29, 35, 10, '2023-04-07', '12:00:00', '13:30:00', 'friday', 160, 0, '2023-04-06 07:26:32', '2023-04-06 08:36:26'),
(6, 29, 35, 10, '2023-04-07', '13:30:00', '15:30:00', 'friday', 200, 0, '2023-04-06 07:26:32', '2023-04-07 14:57:58'),
(7, 29, 35, 10, '2023-04-07', '15:30:00', '16:30:00', 'friday', 127, 1, '2023-04-06 07:26:32', '2023-04-07 14:57:58'),
(8, 29, 35, 10, '2023-04-07', '16:30:00', '18:00:00', 'friday', 170, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(9, 29, 35, 10, '2023-04-08', '06:00:00', '09:00:00', 'saturday', 140, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(10, 29, 35, 10, '2023-04-08', '09:00:00', '12:00:00', 'saturday', 150, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(11, 29, 35, 10, '2023-04-08', '12:00:00', '15:00:00', 'saturday', 160, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(12, 29, 35, 10, '2023-04-08', '15:00:00', '18:00:00', 'saturday', 180, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(13, 29, 35, 10, '2023-04-09', '06:00:00', '07:30:00', 'sunday', 50, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(14, 29, 35, 10, '2023-04-09', '07:30:00', '09:00:00', 'sunday', 60, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(15, 29, 35, 10, '2023-04-09', '09:00:00', '10:30:00', 'sunday', 70, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(16, 29, 35, 10, '2023-04-09', '10:30:00', '12:00:00', 'sunday', 80, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(17, 29, 35, 10, '2023-04-09', '12:00:00', '13:30:00', 'sunday', 90, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(18, 29, 35, 10, '2023-04-09', '13:30:00', '15:00:00', 'sunday', 100, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(19, 29, 35, 10, '2023-04-09', '15:00:00', '16:30:00', 'sunday', 110, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(20, 29, 35, 10, '2023-04-09', '16:30:00', '18:00:00', 'sunday', 120, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(21, 29, 35, 10, '2023-04-10', '06:00:00', '07:30:00', 'monday', 50, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(22, 29, 35, 10, '2023-04-10', '07:30:00', '09:00:00', 'monday', 60, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(23, 29, 35, 10, '2023-04-10', '09:00:00', '10:30:00', 'monday', 70, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(24, 29, 35, 10, '2023-04-10', '10:30:00', '12:00:00', 'monday', 80, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(25, 29, 35, 10, '2023-04-10', '12:00:00', '13:30:00', 'monday', 90, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(26, 29, 35, 10, '2023-04-10', '13:30:00', '15:00:00', 'monday', 100, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(27, 29, 35, 10, '2023-04-10', '15:00:00', '16:30:00', 'monday', 120, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(28, 29, 35, 10, '2023-04-10', '16:30:00', '18:00:00', 'monday', 150, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(29, 29, 35, 10, '2023-04-11', '06:00:00', '07:30:00', 'tuesday', 120, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(30, 29, 35, 10, '2023-04-11', '07:30:00', '09:00:00', 'tuesday', 130, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(31, 29, 35, 10, '2023-04-11', '09:00:00', '10:30:00', 'tuesday', 140, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(32, 29, 35, 10, '2023-04-11', '10:30:00', '12:00:00', 'tuesday', 150, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(33, 29, 35, 10, '2023-04-11', '12:00:00', '13:30:00', 'tuesday', 160, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(34, 29, 35, 10, '2023-04-11', '13:30:00', '15:00:00', 'tuesday', 170, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(35, 29, 35, 10, '2023-04-11', '15:00:00', '16:30:00', 'tuesday', 180, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(36, 29, 35, 10, '2023-04-11', '16:30:00', '18:00:00', 'tuesday', 190, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(37, 29, 35, 10, '2023-04-12', '06:00:00', '07:30:00', 'wednesday', 220, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(38, 29, 35, 10, '2023-04-12', '07:30:00', '09:00:00', 'wednesday', 120, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(39, 29, 35, 10, '2023-04-12', '09:00:00', '10:30:00', 'wednesday', 150, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(40, 29, 35, 10, '2023-04-12', '10:30:00', '12:00:00', 'wednesday', 140, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(41, 29, 35, 10, '2023-04-12', '12:00:00', '13:30:00', 'wednesday', 100, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(42, 29, 35, 10, '2023-04-12', '13:30:00', '15:00:00', 'wednesday', 90, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(43, 29, 35, 10, '2023-04-12', '15:00:00', '16:30:00', 'wednesday', 80, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(44, 29, 35, 10, '2023-04-12', '16:30:00', '18:00:00', 'wednesday', 190, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(45, 29, 35, 10, '2023-04-13', '06:00:00', '09:00:00', 'thursday', 220, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(46, 29, 35, 10, '2023-04-13', '09:00:00', '12:00:00', 'thursday', 230, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(47, 29, 35, 10, '2023-04-13', '12:00:00', '15:00:00', 'thursday', 180, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(48, 29, 35, 10, '2023-04-13', '15:00:00', '18:00:00', 'thursday', 200, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(49, 29, 35, 10, '2023-04-14', '06:00:00', '09:00:00', 'friday', 160, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(50, 29, 35, 10, '2023-04-14', '09:00:00', '12:00:00', 'friday', 200, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(51, 29, 35, 10, '2023-04-14', '12:00:00', '15:00:00', 'friday', 190, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(52, 29, 35, 10, '2023-04-14', '15:00:00', '18:00:00', 'friday', 170, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(53, 29, 35, 10, '2023-04-15', '06:00:00', '09:00:00', 'saturday', 140, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(54, 29, 35, 10, '2023-04-15', '09:00:00', '12:00:00', 'saturday', 150, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(55, 29, 35, 10, '2023-04-15', '12:00:00', '15:00:00', 'saturday', 160, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(56, 29, 35, 10, '2023-04-15', '15:00:00', '18:00:00', 'saturday', 180, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(57, 29, 35, 10, '2023-04-16', '06:00:00', '07:30:00', 'sunday', 50, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(58, 29, 35, 10, '2023-04-16', '07:30:00', '09:00:00', 'sunday', 60, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(59, 29, 35, 10, '2023-04-16', '09:00:00', '10:30:00', 'sunday', 70, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(60, 29, 35, 10, '2023-04-16', '10:30:00', '12:00:00', 'sunday', 80, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(61, 29, 35, 10, '2023-04-16', '12:00:00', '13:30:00', 'sunday', 90, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(62, 29, 35, 10, '2023-04-16', '13:30:00', '15:00:00', 'sunday', 100, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(63, 29, 35, 10, '2023-04-16', '15:00:00', '16:30:00', 'sunday', 110, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(64, 29, 35, 10, '2023-04-16', '16:30:00', '18:00:00', 'sunday', 120, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(65, 29, 35, 10, '2023-04-17', '06:00:00', '07:30:00', 'monday', 50, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(66, 29, 35, 10, '2023-04-17', '07:30:00', '09:00:00', 'monday', 60, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(67, 29, 35, 10, '2023-04-17', '09:00:00', '10:30:00', 'monday', 70, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(68, 29, 35, 10, '2023-04-17', '10:30:00', '12:00:00', 'monday', 80, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(69, 29, 35, 10, '2023-04-17', '12:00:00', '13:30:00', 'monday', 90, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(70, 29, 35, 10, '2023-04-17', '13:30:00', '15:00:00', 'monday', 100, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(71, 29, 35, 10, '2023-04-17', '15:00:00', '16:30:00', 'monday', 120, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(72, 29, 35, 10, '2023-04-17', '16:30:00', '18:00:00', 'monday', 150, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(73, 29, 35, 10, '2023-04-18', '06:00:00', '07:30:00', 'tuesday', 120, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(74, 29, 35, 10, '2023-04-18', '07:30:00', '09:00:00', 'tuesday', 130, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(75, 29, 35, 10, '2023-04-18', '09:00:00', '10:30:00', 'tuesday', 140, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(76, 29, 35, 10, '2023-04-18', '10:30:00', '12:00:00', 'tuesday', 150, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(77, 29, 35, 10, '2023-04-18', '12:00:00', '13:30:00', 'tuesday', 160, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(78, 29, 35, 10, '2023-04-18', '13:30:00', '15:00:00', 'tuesday', 170, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(79, 29, 35, 10, '2023-04-18', '15:00:00', '16:30:00', 'tuesday', 180, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(80, 29, 35, 10, '2023-04-18', '16:30:00', '18:00:00', 'tuesday', 190, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(81, 29, 35, 10, '2023-04-19', '06:00:00', '07:30:00', 'wednesday', 220, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(82, 29, 35, 10, '2023-04-19', '07:30:00', '09:00:00', 'wednesday', 120, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(83, 29, 35, 10, '2023-04-19', '09:00:00', '10:30:00', 'wednesday', 150, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(84, 29, 35, 10, '2023-04-19', '10:30:00', '12:00:00', 'wednesday', 140, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(85, 29, 35, 10, '2023-04-19', '12:00:00', '13:30:00', 'wednesday', 100, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(86, 29, 35, 10, '2023-04-19', '13:30:00', '15:00:00', 'wednesday', 90, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(87, 29, 35, 10, '2023-04-19', '15:00:00', '16:30:00', 'wednesday', 80, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(88, 29, 35, 10, '2023-04-19', '16:30:00', '18:00:00', 'wednesday', 190, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(89, 29, 35, 10, '2023-04-20', '06:00:00', '09:00:00', 'thursday', 220, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(90, 29, 35, 10, '2023-04-20', '09:00:00', '12:00:00', 'thursday', 230, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(91, 29, 35, 10, '2023-04-20', '12:00:00', '15:00:00', 'thursday', 180, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(92, 29, 35, 10, '2023-04-20', '15:00:00', '18:00:00', 'thursday', 200, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(93, 29, 35, 10, '2023-04-21', '06:00:00', '09:00:00', 'friday', 160, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(94, 29, 35, 10, '2023-04-21', '09:00:00', '12:00:00', 'friday', 200, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(95, 29, 35, 10, '2023-04-21', '12:00:00', '15:00:00', 'friday', 190, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(96, 29, 35, 10, '2023-04-21', '15:00:00', '18:00:00', 'friday', 170, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(97, 29, 35, 10, '2023-04-22', '06:00:00', '09:00:00', 'saturday', 140, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(98, 29, 35, 10, '2023-04-22', '09:00:00', '12:00:00', 'saturday', 150, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(99, 29, 35, 10, '2023-04-22', '12:00:00', '15:00:00', 'saturday', 160, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(100, 29, 35, 10, '2023-04-22', '15:00:00', '18:00:00', 'saturday', 180, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(101, 29, 35, 10, '2023-04-23', '06:00:00', '07:30:00', 'sunday', 50, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(102, 29, 35, 10, '2023-04-23', '07:30:00', '09:00:00', 'sunday', 60, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(103, 29, 35, 10, '2023-04-23', '09:00:00', '10:30:00', 'sunday', 70, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(104, 29, 35, 10, '2023-04-23', '10:30:00', '12:00:00', 'sunday', 80, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(105, 29, 35, 10, '2023-04-23', '12:00:00', '13:30:00', 'sunday', 90, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(106, 29, 35, 10, '2023-04-23', '13:30:00', '15:00:00', 'sunday', 100, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(107, 29, 35, 10, '2023-04-23', '15:00:00', '16:30:00', 'sunday', 110, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(108, 29, 35, 10, '2023-04-23', '16:30:00', '18:00:00', 'sunday', 120, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(109, 29, 35, 10, '2023-04-24', '06:00:00', '07:30:00', 'monday', 50, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(110, 29, 35, 10, '2023-04-24', '07:30:00', '09:00:00', 'monday', 60, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(111, 29, 35, 10, '2023-04-24', '09:00:00', '10:30:00', 'monday', 70, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(112, 29, 35, 10, '2023-04-24', '10:30:00', '12:00:00', 'monday', 80, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(113, 29, 35, 10, '2023-04-24', '12:00:00', '13:30:00', 'monday', 90, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(114, 29, 35, 10, '2023-04-24', '13:30:00', '15:00:00', 'monday', 100, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(115, 29, 35, 10, '2023-04-24', '15:00:00', '16:30:00', 'monday', 120, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(116, 29, 35, 10, '2023-04-24', '16:30:00', '18:00:00', 'monday', 150, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(117, 29, 35, 10, '2023-04-25', '06:00:00', '07:30:00', 'tuesday', 120, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(118, 29, 35, 10, '2023-04-25', '07:30:00', '09:00:00', 'tuesday', 130, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(119, 29, 35, 10, '2023-04-25', '09:00:00', '10:30:00', 'tuesday', 140, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(120, 29, 35, 10, '2023-04-25', '10:30:00', '12:00:00', 'tuesday', 150, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(121, 29, 35, 10, '2023-04-25', '12:00:00', '13:30:00', 'tuesday', 160, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(122, 29, 35, 10, '2023-04-25', '13:30:00', '15:00:00', 'tuesday', 170, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(123, 29, 35, 10, '2023-04-25', '15:00:00', '16:30:00', 'tuesday', 180, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(124, 29, 35, 10, '2023-04-25', '16:30:00', '18:00:00', 'tuesday', 190, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(125, 29, 35, 10, '2023-04-26', '06:00:00', '07:30:00', 'wednesday', 220, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(126, 29, 35, 10, '2023-04-26', '07:30:00', '09:00:00', 'wednesday', 120, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(127, 29, 35, 10, '2023-04-26', '09:00:00', '10:30:00', 'wednesday', 150, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(128, 29, 35, 10, '2023-04-26', '10:30:00', '12:00:00', 'wednesday', 140, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(129, 29, 35, 10, '2023-04-26', '12:00:00', '13:30:00', 'wednesday', 100, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(130, 29, 35, 10, '2023-04-26', '13:30:00', '15:00:00', 'wednesday', 90, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(131, 29, 35, 10, '2023-04-26', '15:00:00', '16:30:00', 'wednesday', 80, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(132, 29, 35, 10, '2023-04-26', '16:30:00', '18:00:00', 'wednesday', 190, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(133, 29, 35, 10, '2023-04-27', '06:00:00', '09:00:00', 'thursday', 220, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(134, 29, 35, 10, '2023-04-27', '09:00:00', '12:00:00', 'thursday', 230, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(135, 29, 35, 10, '2023-04-27', '12:00:00', '15:00:00', 'thursday', 180, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(136, 29, 35, 10, '2023-04-27', '15:00:00', '18:00:00', 'thursday', 200, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(137, 29, 35, 10, '2023-04-28', '06:00:00', '09:00:00', 'friday', 160, 0, '2023-04-06 07:26:32', '2023-04-07 15:04:33'),
(138, 29, 35, 10, '2023-04-28', '09:00:00', '12:00:00', 'friday', 200, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(139, 29, 35, 10, '2023-04-28', '12:00:00', '15:00:00', 'friday', 190, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(140, 29, 35, 10, '2023-04-28', '15:00:00', '18:00:00', 'friday', 170, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(141, 29, 35, 10, '2023-04-29', '06:00:00', '09:00:00', 'saturday', 140, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(142, 29, 35, 10, '2023-04-29', '09:00:00', '12:00:00', 'saturday', 150, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(143, 29, 35, 10, '2023-04-29', '12:00:00', '15:00:00', 'saturday', 160, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(144, 29, 35, 10, '2023-04-29', '15:00:00', '18:00:00', 'saturday', 180, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(145, 29, 35, 10, '2023-04-30', '06:00:00', '07:30:00', 'sunday', 50, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(146, 29, 35, 10, '2023-04-30', '07:30:00', '09:00:00', 'sunday', 60, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(147, 29, 35, 10, '2023-04-30', '09:00:00', '10:30:00', 'sunday', 70, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(148, 29, 35, 10, '2023-04-30', '10:30:00', '12:00:00', 'sunday', 80, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(149, 29, 35, 10, '2023-04-30', '12:00:00', '13:30:00', 'sunday', 90, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(150, 29, 35, 10, '2023-04-30', '13:30:00', '15:00:00', 'sunday', 100, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(151, 29, 35, 10, '2023-04-30', '15:00:00', '16:30:00', 'sunday', 110, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(152, 29, 35, 10, '2023-04-30', '16:30:00', '18:00:00', 'sunday', 120, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(153, 29, 35, 10, '2023-05-01', '06:00:00', '07:30:00', 'monday', 50, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(154, 29, 35, 10, '2023-05-01', '07:30:00', '09:00:00', 'monday', 60, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(155, 29, 35, 10, '2023-05-01', '09:00:00', '10:30:00', 'monday', 70, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(156, 29, 35, 10, '2023-05-01', '10:30:00', '12:00:00', 'monday', 80, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(157, 29, 35, 10, '2023-05-01', '12:00:00', '13:30:00', 'monday', 90, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(158, 29, 35, 10, '2023-05-01', '13:30:00', '15:00:00', 'monday', 100, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(159, 29, 35, 10, '2023-05-01', '15:00:00', '16:30:00', 'monday', 120, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(160, 29, 35, 10, '2023-05-01', '16:30:00', '18:00:00', 'monday', 150, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(161, 29, 35, 10, '2023-05-02', '06:00:00', '07:30:00', 'tuesday', 120, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(162, 29, 35, 10, '2023-05-02', '07:30:00', '09:00:00', 'tuesday', 130, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(163, 29, 35, 10, '2023-05-02', '09:00:00', '10:30:00', 'tuesday', 140, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(164, 29, 35, 10, '2023-05-02', '10:30:00', '12:00:00', 'tuesday', 150, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(165, 29, 35, 10, '2023-05-02', '12:00:00', '13:30:00', 'tuesday', 160, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(166, 29, 35, 10, '2023-05-02', '13:30:00', '15:00:00', 'tuesday', 170, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(167, 29, 35, 10, '2023-05-02', '15:00:00', '16:30:00', 'tuesday', 180, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(168, 29, 35, 10, '2023-05-02', '16:30:00', '18:00:00', 'tuesday', 190, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(169, 29, 35, 10, '2023-05-03', '06:00:00', '07:30:00', 'wednesday', 220, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(170, 29, 35, 10, '2023-05-03', '07:30:00', '09:00:00', 'wednesday', 120, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(171, 29, 35, 10, '2023-05-03', '09:00:00', '10:30:00', 'wednesday', 150, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(172, 29, 35, 10, '2023-05-03', '10:30:00', '12:00:00', 'wednesday', 140, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(173, 29, 35, 10, '2023-05-03', '12:00:00', '13:30:00', 'wednesday', 100, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(174, 29, 35, 10, '2023-05-03', '13:30:00', '15:00:00', 'wednesday', 90, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(175, 29, 35, 10, '2023-05-03', '15:00:00', '16:30:00', 'wednesday', 80, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(176, 29, 35, 10, '2023-05-03', '16:30:00', '18:00:00', 'wednesday', 190, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(177, 29, 35, 10, '2023-05-04', '06:00:00', '09:00:00', 'thursday', 220, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(178, 29, 35, 10, '2023-05-04', '09:00:00', '12:00:00', 'thursday', 230, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(179, 29, 35, 10, '2023-05-04', '12:00:00', '15:00:00', 'thursday', 180, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(180, 29, 35, 10, '2023-05-04', '15:00:00', '18:00:00', 'thursday', 200, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(181, 29, 35, 10, '2023-05-05', '06:00:00', '09:00:00', 'friday', 160, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(182, 29, 35, 10, '2023-05-05', '09:00:00', '12:00:00', 'friday', 200, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(183, 29, 35, 10, '2023-05-05', '12:00:00', '15:00:00', 'friday', 190, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(184, 29, 35, 10, '2023-05-05', '15:00:00', '18:00:00', 'friday', 170, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(185, 29, 35, 10, '2023-05-06', '06:00:00', '09:00:00', 'saturday', 140, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(186, 29, 35, 10, '2023-05-06', '09:00:00', '12:00:00', 'saturday', 150, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(187, 29, 35, 10, '2023-05-06', '12:00:00', '15:00:00', 'saturday', 160, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(188, 29, 35, 10, '2023-05-06', '15:00:00', '18:00:00', 'saturday', 180, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(189, 29, 35, 10, '2023-05-07', '06:00:00', '07:30:00', 'sunday', 50, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(190, 29, 35, 10, '2023-05-07', '07:30:00', '09:00:00', 'sunday', 60, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(191, 29, 35, 10, '2023-05-07', '09:00:00', '10:30:00', 'sunday', 70, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(192, 29, 35, 10, '2023-05-07', '10:30:00', '12:00:00', 'sunday', 80, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(193, 29, 35, 10, '2023-05-07', '12:00:00', '13:30:00', 'sunday', 90, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(194, 29, 35, 10, '2023-05-07', '13:30:00', '15:00:00', 'sunday', 100, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(195, 29, 35, 10, '2023-05-07', '15:00:00', '16:30:00', 'sunday', 110, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(196, 29, 35, 10, '2023-05-07', '16:30:00', '18:00:00', 'sunday', 120, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(197, 29, 35, 10, '2023-05-08', '06:00:00', '07:30:00', 'monday', 50, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(198, 29, 35, 10, '2023-05-08', '07:30:00', '09:00:00', 'monday', 60, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(199, 29, 35, 10, '2023-05-08', '09:00:00', '10:30:00', 'monday', 70, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(200, 29, 35, 10, '2023-05-08', '10:30:00', '12:00:00', 'monday', 80, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(201, 29, 35, 10, '2023-05-08', '12:00:00', '13:30:00', 'monday', 90, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(202, 29, 35, 10, '2023-05-08', '13:30:00', '15:00:00', 'monday', 100, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(203, 29, 35, 10, '2023-05-08', '15:00:00', '16:30:00', 'monday', 120, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(204, 29, 35, 10, '2023-05-08', '16:30:00', '18:00:00', 'monday', 150, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(205, 29, 35, 10, '2023-05-09', '06:00:00', '07:30:00', 'tuesday', 120, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(206, 29, 35, 10, '2023-05-09', '07:30:00', '09:00:00', 'tuesday', 130, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(207, 29, 35, 10, '2023-05-09', '09:00:00', '10:30:00', 'tuesday', 140, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(208, 29, 35, 10, '2023-05-09', '10:30:00', '12:00:00', 'tuesday', 150, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(209, 29, 35, 10, '2023-05-09', '12:00:00', '13:30:00', 'tuesday', 160, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(210, 29, 35, 10, '2023-05-09', '13:30:00', '15:00:00', 'tuesday', 170, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(211, 29, 35, 10, '2023-05-09', '15:00:00', '16:30:00', 'tuesday', 180, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(212, 29, 35, 10, '2023-05-09', '16:30:00', '18:00:00', 'tuesday', 190, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(213, 29, 35, 10, '2023-05-10', '06:00:00', '07:30:00', 'wednesday', 220, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(214, 29, 35, 10, '2023-05-10', '07:30:00', '09:00:00', 'wednesday', 120, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(215, 29, 35, 10, '2023-05-10', '09:00:00', '10:30:00', 'wednesday', 150, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(216, 29, 35, 10, '2023-05-10', '10:30:00', '12:00:00', 'wednesday', 140, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(217, 29, 35, 10, '2023-05-10', '12:00:00', '13:30:00', 'wednesday', 100, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(218, 29, 35, 10, '2023-05-10', '13:30:00', '15:00:00', 'wednesday', 90, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(219, 29, 35, 10, '2023-05-10', '15:00:00', '16:30:00', 'wednesday', 80, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(220, 29, 35, 10, '2023-05-10', '16:30:00', '18:00:00', 'wednesday', 190, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(221, 29, 35, 10, '2023-05-11', '06:00:00', '09:00:00', 'thursday', 220, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(222, 29, 35, 10, '2023-05-11', '09:00:00', '12:00:00', 'thursday', 230, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(223, 29, 35, 10, '2023-05-11', '12:00:00', '15:00:00', 'thursday', 180, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(224, 29, 35, 10, '2023-05-11', '15:00:00', '18:00:00', 'thursday', 200, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(225, 29, 35, 10, '2023-05-12', '06:00:00', '09:00:00', 'friday', 160, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(226, 29, 35, 10, '2023-05-12', '09:00:00', '12:00:00', 'friday', 200, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(227, 29, 35, 10, '2023-05-12', '12:00:00', '15:00:00', 'friday', 190, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(228, 29, 35, 10, '2023-05-12', '15:00:00', '18:00:00', 'friday', 170, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(229, 29, 35, 10, '2023-05-13', '06:00:00', '09:00:00', 'saturday', 140, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(230, 29, 35, 10, '2023-05-13', '09:00:00', '12:00:00', 'saturday', 150, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(231, 29, 35, 10, '2023-05-13', '12:00:00', '15:00:00', 'saturday', 160, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(232, 29, 35, 10, '2023-05-13', '15:00:00', '18:00:00', 'saturday', 180, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(233, 29, 35, 10, '2023-05-14', '06:00:00', '07:30:00', 'sunday', 50, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(234, 29, 35, 10, '2023-05-14', '07:30:00', '09:00:00', 'sunday', 60, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(235, 29, 35, 10, '2023-05-14', '09:00:00', '10:30:00', 'sunday', 70, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(236, 29, 35, 10, '2023-05-14', '10:30:00', '12:00:00', 'sunday', 80, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(237, 29, 35, 10, '2023-05-14', '12:00:00', '13:30:00', 'sunday', 90, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(238, 29, 35, 10, '2023-05-14', '13:30:00', '15:00:00', 'sunday', 100, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(239, 29, 35, 10, '2023-05-14', '15:00:00', '16:30:00', 'sunday', 110, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(240, 29, 35, 10, '2023-05-14', '16:30:00', '18:00:00', 'sunday', 120, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(241, 29, 35, 10, '2023-05-15', '06:00:00', '07:30:00', 'monday', 50, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(242, 29, 35, 10, '2023-05-15', '07:30:00', '09:00:00', 'monday', 60, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(243, 29, 35, 10, '2023-05-15', '09:00:00', '10:30:00', 'monday', 70, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(244, 29, 35, 10, '2023-05-15', '10:30:00', '12:00:00', 'monday', 80, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(245, 29, 35, 10, '2023-05-15', '12:00:00', '13:30:00', 'monday', 90, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(246, 29, 35, 10, '2023-05-15', '13:30:00', '15:00:00', 'monday', 100, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(247, 29, 35, 10, '2023-05-15', '15:00:00', '16:30:00', 'monday', 120, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(248, 29, 35, 10, '2023-05-15', '16:30:00', '18:00:00', 'monday', 150, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(249, 29, 35, 10, '2023-05-16', '06:00:00', '07:30:00', 'tuesday', 120, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(250, 29, 35, 10, '2023-05-16', '07:30:00', '09:00:00', 'tuesday', 130, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(251, 29, 35, 10, '2023-05-16', '09:00:00', '10:30:00', 'tuesday', 140, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(252, 29, 35, 10, '2023-05-16', '10:30:00', '12:00:00', 'tuesday', 150, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(253, 29, 35, 10, '2023-05-16', '12:00:00', '13:30:00', 'tuesday', 160, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(254, 29, 35, 10, '2023-05-16', '13:30:00', '15:00:00', 'tuesday', 170, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(255, 29, 35, 10, '2023-05-16', '15:00:00', '16:30:00', 'tuesday', 180, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(256, 29, 35, 10, '2023-05-16', '16:30:00', '18:00:00', 'tuesday', 190, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(257, 29, 35, 10, '2023-05-17', '06:00:00', '07:30:00', 'wednesday', 220, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(258, 29, 35, 10, '2023-05-17', '07:30:00', '09:00:00', 'wednesday', 120, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(259, 29, 35, 10, '2023-05-17', '09:00:00', '10:30:00', 'wednesday', 150, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(260, 29, 35, 10, '2023-05-17', '10:30:00', '12:00:00', 'wednesday', 140, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(261, 29, 35, 10, '2023-05-17', '12:00:00', '13:30:00', 'wednesday', 100, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(262, 29, 35, 10, '2023-05-17', '13:30:00', '15:00:00', 'wednesday', 90, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(263, 29, 35, 10, '2023-05-17', '15:00:00', '16:30:00', 'wednesday', 80, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(264, 29, 35, 10, '2023-05-17', '16:30:00', '18:00:00', 'wednesday', 190, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(265, 29, 35, 10, '2023-05-18', '06:00:00', '09:00:00', 'thursday', 220, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(266, 29, 35, 10, '2023-05-18', '09:00:00', '12:00:00', 'thursday', 230, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(267, 29, 35, 10, '2023-05-18', '12:00:00', '15:00:00', 'thursday', 180, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(268, 29, 35, 10, '2023-05-18', '15:00:00', '18:00:00', 'thursday', 200, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(269, 29, 35, 10, '2023-05-19', '06:00:00', '09:00:00', 'friday', 160, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(270, 29, 35, 10, '2023-05-19', '09:00:00', '12:00:00', 'friday', 200, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(271, 29, 35, 10, '2023-05-19', '12:00:00', '15:00:00', 'friday', 190, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(272, 29, 35, 10, '2023-05-19', '15:00:00', '18:00:00', 'friday', 170, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(273, 29, 35, 10, '2023-05-20', '06:00:00', '09:00:00', 'saturday', 140, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(274, 29, 35, 10, '2023-05-20', '09:00:00', '12:00:00', 'saturday', 150, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(275, 29, 35, 10, '2023-05-20', '12:00:00', '15:00:00', 'saturday', 160, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(276, 29, 35, 10, '2023-05-20', '15:00:00', '18:00:00', 'saturday', 180, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(277, 29, 35, 10, '2023-05-21', '06:00:00', '07:30:00', 'sunday', 50, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(278, 29, 35, 10, '2023-05-21', '07:30:00', '09:00:00', 'sunday', 60, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(279, 29, 35, 10, '2023-05-21', '09:00:00', '10:30:00', 'sunday', 70, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(280, 29, 35, 10, '2023-05-21', '10:30:00', '12:00:00', 'sunday', 80, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(281, 29, 35, 10, '2023-05-21', '12:00:00', '13:30:00', 'sunday', 90, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(282, 29, 35, 10, '2023-05-21', '13:30:00', '15:00:00', 'sunday', 100, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(283, 29, 35, 10, '2023-05-21', '15:00:00', '16:30:00', 'sunday', 110, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(284, 29, 35, 10, '2023-05-21', '16:30:00', '18:00:00', 'sunday', 120, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(285, 29, 35, 10, '2023-05-22', '06:00:00', '07:30:00', 'monday', 50, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(286, 29, 35, 10, '2023-05-22', '07:30:00', '09:00:00', 'monday', 60, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(287, 29, 35, 10, '2023-05-22', '09:00:00', '10:30:00', 'monday', 70, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(288, 29, 35, 10, '2023-05-22', '10:30:00', '12:00:00', 'monday', 80, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(289, 29, 35, 10, '2023-05-22', '12:00:00', '13:30:00', 'monday', 90, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(290, 29, 35, 10, '2023-05-22', '13:30:00', '15:00:00', 'monday', 100, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(291, 29, 35, 10, '2023-05-22', '15:00:00', '16:30:00', 'monday', 120, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(292, 29, 35, 10, '2023-05-22', '16:30:00', '18:00:00', 'monday', 150, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(293, 29, 35, 10, '2023-05-23', '06:00:00', '07:30:00', 'tuesday', 120, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(294, 29, 35, 10, '2023-05-23', '07:30:00', '09:00:00', 'tuesday', 130, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(295, 29, 35, 10, '2023-05-23', '09:00:00', '10:30:00', 'tuesday', 140, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(296, 29, 35, 10, '2023-05-23', '10:30:00', '12:00:00', 'tuesday', 150, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(297, 29, 35, 10, '2023-05-23', '12:00:00', '13:30:00', 'tuesday', 160, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(298, 29, 35, 10, '2023-05-23', '13:30:00', '15:00:00', 'tuesday', 170, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(299, 29, 35, 10, '2023-05-23', '15:00:00', '16:30:00', 'tuesday', 180, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(300, 29, 35, 10, '2023-05-23', '16:30:00', '18:00:00', 'tuesday', 190, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(301, 29, 35, 10, '2023-05-24', '06:00:00', '07:30:00', 'wednesday', 220, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(302, 29, 35, 10, '2023-05-24', '07:30:00', '09:00:00', 'wednesday', 120, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(303, 29, 35, 10, '2023-05-24', '09:00:00', '10:30:00', 'wednesday', 150, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(304, 29, 35, 10, '2023-05-24', '10:30:00', '12:00:00', 'wednesday', 140, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(305, 29, 35, 10, '2023-05-24', '12:00:00', '13:30:00', 'wednesday', 100, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(306, 29, 35, 10, '2023-05-24', '13:30:00', '15:00:00', 'wednesday', 90, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(307, 29, 35, 10, '2023-05-24', '15:00:00', '16:30:00', 'wednesday', 80, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(308, 29, 35, 10, '2023-05-24', '16:30:00', '18:00:00', 'wednesday', 190, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(309, 29, 35, 10, '2023-05-25', '06:00:00', '09:00:00', 'thursday', 220, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(310, 29, 35, 10, '2023-05-25', '09:00:00', '12:00:00', 'thursday', 230, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(311, 29, 35, 10, '2023-05-25', '12:00:00', '15:00:00', 'thursday', 180, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(312, 29, 35, 10, '2023-05-25', '15:00:00', '18:00:00', 'thursday', 200, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(313, 29, 35, 10, '2023-05-26', '06:00:00', '09:00:00', 'friday', 160, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(314, 29, 35, 10, '2023-05-26', '09:00:00', '12:00:00', 'friday', 200, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(315, 29, 35, 10, '2023-05-26', '12:00:00', '15:00:00', 'friday', 190, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(316, 29, 35, 10, '2023-05-26', '15:00:00', '18:00:00', 'friday', 170, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(317, 29, 35, 10, '2023-05-27', '06:00:00', '09:00:00', 'saturday', 140, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(318, 29, 35, 10, '2023-05-27', '09:00:00', '12:00:00', 'saturday', 150, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(319, 29, 35, 10, '2023-05-27', '12:00:00', '15:00:00', 'saturday', 160, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(320, 29, 35, 10, '2023-05-27', '15:00:00', '18:00:00', 'saturday', 180, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(321, 29, 35, 10, '2023-05-28', '06:00:00', '07:30:00', 'sunday', 50, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(322, 29, 35, 10, '2023-05-28', '07:30:00', '09:00:00', 'sunday', 60, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(323, 29, 35, 10, '2023-05-28', '09:00:00', '10:30:00', 'sunday', 70, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(324, 29, 35, 10, '2023-05-28', '10:30:00', '12:00:00', 'sunday', 80, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(325, 29, 35, 10, '2023-05-28', '12:00:00', '13:30:00', 'sunday', 90, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(326, 29, 35, 10, '2023-05-28', '13:30:00', '15:00:00', 'sunday', 100, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(327, 29, 35, 10, '2023-05-28', '15:00:00', '16:30:00', 'sunday', 110, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(328, 29, 35, 10, '2023-05-28', '16:30:00', '18:00:00', 'sunday', 120, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(329, 29, 35, 10, '2023-05-29', '06:00:00', '07:30:00', 'monday', 50, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(330, 29, 35, 10, '2023-05-29', '07:30:00', '09:00:00', 'monday', 60, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(331, 29, 35, 10, '2023-05-29', '09:00:00', '10:30:00', 'monday', 70, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(332, 29, 35, 10, '2023-05-29', '10:30:00', '12:00:00', 'monday', 80, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(333, 29, 35, 10, '2023-05-29', '12:00:00', '13:30:00', 'monday', 90, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(334, 29, 35, 10, '2023-05-29', '13:30:00', '15:00:00', 'monday', 100, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(335, 29, 35, 10, '2023-05-29', '15:00:00', '16:30:00', 'monday', 120, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(336, 29, 35, 10, '2023-05-29', '16:30:00', '18:00:00', 'monday', 150, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(337, 29, 35, 10, '2023-05-30', '06:00:00', '07:30:00', 'tuesday', 120, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(338, 29, 35, 10, '2023-05-30', '07:30:00', '09:00:00', 'tuesday', 130, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(339, 29, 35, 10, '2023-05-30', '09:00:00', '10:30:00', 'tuesday', 140, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(340, 29, 35, 10, '2023-05-30', '10:30:00', '12:00:00', 'tuesday', 150, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(341, 29, 35, 10, '2023-05-30', '12:00:00', '13:30:00', 'tuesday', 160, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(342, 29, 35, 10, '2023-05-30', '13:30:00', '15:00:00', 'tuesday', 170, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(343, 29, 35, 10, '2023-05-30', '15:00:00', '16:30:00', 'tuesday', 180, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(344, 29, 35, 10, '2023-05-30', '16:30:00', '18:00:00', 'tuesday', 190, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(345, 29, 35, 10, '2023-05-31', '06:00:00', '07:30:00', 'wednesday', 220, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(346, 29, 35, 10, '2023-05-31', '07:30:00', '09:00:00', 'wednesday', 120, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(347, 29, 35, 10, '2023-05-31', '09:00:00', '10:30:00', 'wednesday', 150, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(348, 29, 35, 10, '2023-05-31', '10:30:00', '12:00:00', 'wednesday', 140, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(349, 29, 35, 10, '2023-05-31', '12:00:00', '13:30:00', 'wednesday', 100, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(350, 29, 35, 10, '2023-05-31', '13:30:00', '15:00:00', 'wednesday', 90, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(351, 29, 35, 10, '2023-05-31', '15:00:00', '16:30:00', 'wednesday', 80, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32'),
(352, 29, 35, 10, '2023-05-31', '16:30:00', '18:00:00', 'wednesday', 190, 1, '2023-04-06 07:26:32', '2023-04-06 07:26:32');

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
(6, 'Soccer', 'sport-9355.png', 1, 2, '2023-02-20 03:35:39', '2023-03-10 06:37:36'),
(7, 'Golf', 'sport-4980.png', 1, 2, '2023-02-20 03:35:56', '2023-03-16 06:23:56'),
(8, 'Basketball', 'sport-8484.png', 1, 2, '2023-02-20 03:37:44', '2023-03-16 06:24:04'),
(9, 'Cricket', 'sport-9539.png', 1, 2, '2023-02-20 03:41:14', '2023-03-16 06:24:15'),
(10, 'Volleyball', 'sport-7688.png', 1, 2, '2023-02-20 03:43:02', '2023-03-22 01:14:50'),
(11, 'Frisbee', 'sport-6527.png', 1, 2, '2023-03-16 06:24:52', '2023-03-16 06:24:52'),
(12, 'Hockey', 'sport-8189.png', 1, 2, '2023-03-16 06:25:13', '2023-03-16 06:25:13');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type` tinyint(1) NOT NULL COMMENT '1=incoming, 2=Outgoing(refund)',
  `vendor_id` int(11) NOT NULL,
  `dome_id` int(11) DEFAULT NULL,
  `league_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `booking_id` varchar(255) NOT NULL,
  `contributor_name` varchar(255) DEFAULT NULL,
  `payment_method` int(11) NOT NULL DEFAULT 1 COMMENT '1=Card, 2=Apple Pay, 3=Google Pay	',
  `transaction_id` varchar(255) NOT NULL,
  `amount` double(8,2) NOT NULL,
  `is_payment_released` tinyint(4) NOT NULL DEFAULT 2 COMMENT '1=Yes, 2=No',
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `type`, `vendor_id`, `dome_id`, `league_id`, `user_id`, `booking_id`, `contributor_name`, `payment_method`, `transaction_id`, `amount`, `is_payment_released`, `created_at`, `updated_at`) VALUES
(9, 1, 2, 35, NULL, 69, 'da545179', NULL, 1, 'pi_3MuC50FysF0okTxJ1GmGk7l2', 220.00, 2, '2023-04-07 09:59:49', '2023-04-07 09:59:49'),
(10, 1, 2, 35, NULL, 69, '25fb48f3', NULL, 1, 'pi_3MuGpUFysF0okTxJ14IWMqvP', 14.67, 2, '2023-04-07 15:04:33', '2023-04-07 15:04:33'),
(11, 1, 2, 35, 11, 69, 'cab429c4', NULL, 1, 'pi_3MuVIsFysF0okTxJ04Jg5Gpw', 1637.90, 2, '2023-04-08 06:31:34', '2023-04-08 06:31:34'),
(12, 1, 2, 35, 11, 69, 'f085cc9a', NULL, 1, 'pi_3MuVhAFysF0okTxJ0B10PRH7', 1637.90, 2, '2023-04-08 06:56:39', '2023-04-08 06:56:39'),
(13, 1, 2, 35, 11, 69, 'bb651c72', NULL, 1, 'pi_3MuVmdFysF0okTxJ0CmbokJe', 1637.90, 2, '2023-04-08 07:02:28', '2023-04-08 07:02:28'),
(14, 1, 2, 35, 11, 69, '9e1920a2', NULL, 1, 'pi_3MuXLeFysF0okTxJ1C9Eav77', 1637.90, 2, '2023-04-08 08:42:45', '2023-04-08 08:42:45'),
(15, 1, 2, 35, 11, 69, '0c9b00c0', NULL, 1, 'pi_3MuYraFysF0okTxJ1KpEV0IA', 1637.90, 2, '2023-04-08 10:19:36', '2023-04-08 10:19:36'),
(16, 1, 2, 35, 11, 69, '0d0e9f1b', NULL, 1, 'pi_3MuYukFysF0okTxJ09kFKrtY', 1637.90, 2, '2023-04-08 10:22:58', '2023-04-08 10:22:58'),
(17, 1, 2, 35, 11, 69, '8f2bc8a7', NULL, 1, 'pi_3MuYwaFysF0okTxJ0SDmsq1Q', 1637.90, 2, '2023-04-08 10:24:47', '2023-04-08 10:24:47'),
(18, 1, 2, 35, 11, 69, '5339fede', NULL, 1, 'pi_3MuZ07FysF0okTxJ0lNOijFC', 1637.90, 2, '2023-04-08 10:28:33', '2023-04-08 10:28:33'),
(19, 1, 2, 35, 11, 69, 'b0c00635', NULL, 1, 'pi_3MuZ8VFysF0okTxJ1PLFdxGh', 1637.90, 2, '2023-04-08 10:37:06', '2023-04-08 10:37:06'),
(20, 1, 2, 35, 11, 69, 'e27cc0af', NULL, 1, 'pi_3MuZAVFysF0okTxJ13QI9R7d', 1637.90, 2, '2023-04-08 10:39:06', '2023-04-08 10:39:06'),
(21, 1, 2, 35, 11, 69, 'e9b83f74', NULL, 1, 'pi_3MuZBhFysF0okTxJ1sqd2bWL', 1637.90, 2, '2023-04-08 10:40:23', '2023-04-08 10:40:23'),
(22, 1, 2, 35, 11, 69, '57d109c7', NULL, 1, 'pi_3MuZCkFysF0okTxJ09LElq0R', 1637.90, 2, '2023-04-08 10:41:28', '2023-04-08 10:41:28'),
(23, 1, 2, 35, 1, 69, '412aed29', NULL, 1, 'pi_3MuZIPFysF0okTxJ03NYdQDJ', 1637.90, 2, '2023-04-08 10:47:30', '2023-04-08 10:47:30');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `type` int(11) NOT NULL COMMENT '1=Admin, 2=Dome Owner, 3=User, 4=Employee, 5=Provider',
  `login_type` int(11) NOT NULL DEFAULT 1 COMMENT '1=Email, 2=Google, 3=Apple, 4=Facebook',
  `vendor_id` int(11) DEFAULT NULL COMMENT 'For Workers use only',
  `dome_limit` tinyint(4) DEFAULT NULL COMMENT 'Only For Dome Owqner',
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

INSERT INTO `users` (`id`, `type`, `login_type`, `vendor_id`, `dome_limit`, `name`, `email`, `countrycode`, `phone`, `password`, `google_id`, `apple_id`, `facebook_id`, `fcm_token`, `otp`, `image`, `is_verified`, `is_available`, `is_deleted`, `created_at`, `updated_at`) VALUES
(1, 1, 1, NULL, NULL, 'Admin', 'admin@gmail.com', 'CA', '1234567890', '$2y$10$z0eXm5BtjQQP77GHRvJAGOIp1osY2Lx0NvMvmkpTgPzpiTUvnIlri', NULL, NULL, NULL, NULL, NULL, 'default.png', 1, 1, 2, '2023-02-06 05:11:02', '2023-02-06 05:11:02'),
(2, 2, 1, NULL, 1, 'domez', 'domez@yopmail.com', 'CA', '1234657890', '$2y$10$z0eXm5BtjQQP77GHRvJAGOIp1osY2Lx0NvMvmkpTgPzpiTUvnIlri', NULL, NULL, NULL, NULL, NULL, 'default.png', 1, 1, 2, '2023-02-06 00:03:03', '2023-02-22 04:12:48'),
(35, 3, 1, NULL, NULL, 'Mona Vosa', 'mona@gmail.com', 'CA', '8946555414', '$2y$10$gtan0ZH/DCiZmnR2yLGiyeZAR0YeEu9krVXGHQfXBqk63ep0WQEEm', NULL, NULL, NULL, NULL, NULL, 'default.png', 1, 1, 2, '2023-05-19 02:22:29', '2023-05-19 05:28:51'),
(34, 3, 1, NULL, NULL, 'Docote Voho', 'docote@gmail.com', 'CA', '54654154654', '$2y$10$gtan0ZH/DCiZmnR2yLGiyeZAR0YeEu9krVXGHQfXBqk63ep0WQEEm', NULL, NULL, NULL, NULL, NULL, 'default.png', 1, 1, 2, '2023-05-19 02:22:29', '2023-05-19 05:28:51'),
(7, 3, 1, NULL, NULL, 'test1', 'dummy@yopmail.com', 'CA', '689463458', '$2y$10$gtan0ZH/DCiZmnR2yLGiyeZAR0YeEu9krVXGHQfXBqk63ep0WQEEm', NULL, NULL, NULL, NULL, NULL, 'profiles-642eb1bfbc3a6.png', 1, 1, 2, '2023-02-19 02:22:29', '2023-04-06 11:49:19'),
(33, 3, 1, NULL, NULL, 'Emmilia vice', 'emmilia@gmail.com', 'CA', '54654154654', '$2y$10$gtan0ZH/DCiZmnR2yLGiyeZAR0YeEu9krVXGHQfXBqk63ep0WQEEm', NULL, NULL, NULL, NULL, NULL, 'default.png', 1, 1, 2, '2023-04-19 02:22:29', '2023-05-19 05:28:51'),
(30, 3, 1, NULL, NULL, 'Wirag Wilow', 'wirag@gmail.com', 'CA', '684651616553', '$2y$10$gtan0ZH/DCiZmnR2yLGiyeZAR0YeEu9krVXGHQfXBqk63ep0WQEEm', NULL, NULL, NULL, NULL, NULL, 'default.png', 1, 1, 2, '2023-03-15 02:22:29', '2023-02-19 05:28:51'),
(29, 3, 1, NULL, NULL, 'Wirag Wilow', 'wirag@gmail.com', 'CA', '684651616553', '$2y$10$gtan0ZH/DCiZmnR2yLGiyeZAR0YeEu9krVXGHQfXBqk63ep0WQEEm', NULL, NULL, NULL, NULL, NULL, 'default.png', 1, 1, 2, '2023-03-19 02:22:29', '2023-02-19 05:28:51'),
(28, 3, 1, NULL, NULL, 'Lorem Ipsum', 'lorem@gmail.com', 'CA', '15646516541', '$2y$10$gtan0ZH/DCiZmnR2yLGiyeZAR0YeEu9krVXGHQfXBqk63ep0WQEEm', NULL, NULL, NULL, NULL, NULL, 'default.png', 1, 1, 2, '2023-01-19 02:22:29', '2023-02-19 05:28:51'),
(27, 3, 1, NULL, NULL, 'Jessy Carter', 'jessy@gmail.com', 'CA', '6546484516541', '$2y$10$gtan0ZH/DCiZmnR2yLGiyeZAR0YeEu9krVXGHQfXBqk63ep0WQEEm', NULL, NULL, NULL, NULL, NULL, 'default.png', 1, 1, 2, '2023-01-19 02:22:29', '2023-02-19 05:28:51'),
(26, 3, 1, NULL, NULL, 'Clara Demosy', 'clara@gmail.com', 'CA', '184651541', '$2y$10$gtan0ZH/DCiZmnR2yLGiyeZAR0YeEu9krVXGHQfXBqk63ep0WQEEm', NULL, NULL, NULL, NULL, NULL, 'default.png', 1, 1, 2, '2023-02-19 02:22:29', '2023-02-19 05:28:51'),
(25, 3, 1, NULL, NULL, 'Chrie Bovotie', 'chriee@gmail.com', 'CA', '896546416541', '$2y$10$gtan0ZH/DCiZmnR2yLGiyeZAR0YeEu9krVXGHQfXBqk63ep0WQEEm', NULL, NULL, NULL, NULL, NULL, 'default.png', 1, 1, 2, '2023-02-19 02:22:29', '2023-02-19 05:28:51'),
(24, 3, 1, NULL, NULL, 'Jessica Wislson', 'jessica@gmail.com', 'CA', '865465454', '$2y$10$gtan0ZH/DCiZmnR2yLGiyeZAR0YeEu9krVXGHQfXBqk63ep0WQEEm', NULL, NULL, NULL, NULL, NULL, 'default.png', 1, 1, 2, '2023-02-19 02:22:29', '2023-02-19 05:28:51'),
(23, 3, 1, NULL, NULL, 'James Carter', 'james@gmail.com', 'CA', '21321231231', '$2y$10$gtan0ZH/DCiZmnR2yLGiyeZAR0YeEu9krVXGHQfXBqk63ep0WQEEm', NULL, NULL, NULL, NULL, NULL, 'default.png', 1, 1, 2, '2023-02-19 02:22:29', '2023-02-19 05:28:51'),
(46, 2, 1, NULL, NULL, 'doMEZ 123', 'domez123@yopmail.com', 'CA', '1234657890', '$2y$10$z0eXm5BtjQQP77GHRvJAGOIp1osY2Lx0NvMvmkpTgPzpiTUvnIlri', NULL, NULL, NULL, NULL, NULL, 'default.png', 1, 1, 2, '2023-02-06 00:03:03', '2023-02-22 04:12:48'),
(38, 3, 1, NULL, NULL, 'Monna', 'monna@gmail.com', 'CA', '894165161', '$2y$10$gtan0ZH/DCiZmnR2yLGiyeZAR0YeEu9krVXGHQfXBqk63ep0WQEEm', NULL, NULL, NULL, NULL, NULL, 'default.png', 1, 1, 2, '2023-03-13 02:22:29', '2023-05-19 05:28:51'),
(39, 3, 1, NULL, NULL, 'Monnalisssa', 'monnalisssa@gmail.com', 'CA', '894165161', '$2y$10$gtan0ZH/DCiZmnR2yLGiyeZAR0YeEu9krVXGHQfXBqk63ep0WQEEm', NULL, NULL, NULL, NULL, NULL, 'default.png', 1, 1, 2, '2023-03-15 02:22:29', '2023-05-19 05:28:51'),
(40, 3, 1, NULL, NULL, 'Jerry', 'jerry@gmail.com', 'CA', '894165161', '$2y$10$gtan0ZH/DCiZmnR2yLGiyeZAR0YeEu9krVXGHQfXBqk63ep0WQEEm', NULL, NULL, NULL, NULL, NULL, 'default.png', 1, 1, 2, '2023-03-16 02:22:29', '2023-05-19 05:28:51'),
(41, 3, 1, NULL, NULL, 'Jerry', 'jerry@gmail.com', 'CA', '894165161', '$2y$10$gtan0ZH/DCiZmnR2yLGiyeZAR0YeEu9krVXGHQfXBqk63ep0WQEEm', NULL, NULL, NULL, NULL, NULL, 'default.png', 1, 1, 2, '2023-03-17 02:22:29', '2023-05-19 05:28:51'),
(42, 3, 1, NULL, NULL, 'Jerry', 'jerry@gmail.com', 'CA', '894165161', '$2y$10$gtan0ZH/DCiZmnR2yLGiyeZAR0YeEu9krVXGHQfXBqk63ep0WQEEm', NULL, NULL, NULL, NULL, NULL, 'default.png', 1, 1, 2, '2023-03-14 02:22:29', '2023-05-19 05:28:51'),
(43, 3, 1, NULL, NULL, 'Jemis', 'jemis@gmail.com', 'CA', '894165161', '$2y$10$gtan0ZH/DCiZmnR2yLGiyeZAR0YeEu9krVXGHQfXBqk63ep0WQEEm', NULL, NULL, NULL, NULL, NULL, 'default.png', 1, 1, 2, '2023-03-17 02:22:29', '2023-05-19 05:28:51'),
(44, 3, 1, NULL, NULL, 'Ipsum carter', 'ipsum@gmail.com', 'CA', '894165161', '$2y$10$gtan0ZH/DCiZmnR2yLGiyeZAR0YeEu9krVXGHQfXBqk63ep0WQEEm', NULL, NULL, NULL, NULL, NULL, 'default.png', 1, 1, 2, '2023-03-17 02:22:29', '2023-05-19 05:28:51'),
(47, 2, 1, NULL, NULL, 'doMEZ 123', 'domez1234@yopmail.com', 'CA', '1234657890', '$2y$10$z0eXm5BtjQQP77GHRvJAGOIp1osY2Lx0NvMvmkpTgPzpiTUvnIlri', NULL, NULL, NULL, NULL, NULL, 'default.png', 1, 1, 2, '2023-02-06 00:03:03', '2023-02-22 04:12:48'),
(48, 2, 1, NULL, NULL, 'doMEZ 123', 'domez1234@yopmail.com', 'CA', '1234657890', '$2y$10$z0eXm5BtjQQP77GHRvJAGOIp1osY2Lx0NvMvmkpTgPzpiTUvnIlri', NULL, NULL, NULL, NULL, NULL, 'default.png', 1, 1, 2, '2023-02-06 00:03:03', '2023-02-22 04:12:48'),
(49, 2, 1, NULL, NULL, 'Lorem Ipsum Dome', 'loremipsumdome@yopmail.com', 'CA', '655454490', '$2y$10$z0eXm5BtjQQP77GHRvJAGOIp1osY2Lx0NvMvmkpTgPzpiTUvnIlri', NULL, NULL, NULL, NULL, NULL, 'default.png', 1, 1, 2, '2023-01-06 00:03:03', '2023-02-22 04:12:48'),
(50, 2, 1, NULL, NULL, 'Ipsum Dome', 'ipsumdome@yopmail.com', 'CA', '897854654', '$2y$10$z0eXm5BtjQQP77GHRvJAGOIp1osY2Lx0NvMvmkpTgPzpiTUvnIlri', NULL, NULL, NULL, NULL, NULL, 'default.png', 1, 1, 2, '2023-04-05 00:03:03', '2023-02-22 04:12:48'),
(51, 2, 1, NULL, NULL, 'Lorem Dome', 'loremdome@yopmail.com', 'CA', '8945454546', '$2y$10$z0eXm5BtjQQP77GHRvJAGOIp1osY2Lx0NvMvmkpTgPzpiTUvnIlri', NULL, NULL, NULL, NULL, NULL, 'default.png', 1, 1, 2, '2023-04-06 00:03:03', '2023-02-22 04:12:48'),
(52, 2, 1, NULL, NULL, 'Carter Dome', 'carterdome@yopmail.com', 'CA', '123890', '$2y$10$z0eXm5BtjQQP77GHRvJAGOIp1osY2Lx0NvMvmkpTgPzpiTUvnIlri', NULL, NULL, NULL, NULL, NULL, 'default.png', 1, 1, 2, '2023-04-06 00:03:03', '2023-02-22 04:12:48'),
(53, 2, 1, NULL, NULL, 'Shotty Dome', 'shottydome@yopmail.com', 'CA', '4651651', '$2y$10$z0eXm5BtjQQP77GHRvJAGOIp1osY2Lx0NvMvmkpTgPzpiTUvnIlri', NULL, NULL, NULL, NULL, NULL, 'default.png', 1, 1, 2, '2023-05-06 00:03:03', '2023-02-22 04:12:48'),
(54, 2, 1, NULL, NULL, 'Jecky\"s Dome', 'jeckydome@yopmail.com', 'CA', '1237890', '$2y$10$z0eXm5BtjQQP77GHRvJAGOIp1osY2Lx0NvMvmkpTgPzpiTUvnIlri', NULL, NULL, NULL, NULL, NULL, 'default.png', 1, 1, 2, '2023-07-06 00:03:03', '2023-02-22 04:12:48'),
(55, 2, 1, NULL, NULL, 'Domaz Domez', 'domazdomez@yopmail.com', 'CA', '894651651', '$2y$10$z0eXm5BtjQQP77GHRvJAGOIp1osY2Lx0NvMvmkpTgPzpiTUvnIlri', NULL, NULL, NULL, NULL, NULL, 'default.png', 1, 1, 2, '2023-07-06 00:03:03', '2023-02-22 04:12:48'),
(56, 2, 1, NULL, NULL, 'Lomar Dome', 'lomardome@yopmail.com', 'CA', '894546515', '$2y$10$z0eXm5BtjQQP77GHRvJAGOIp1osY2Lx0NvMvmkpTgPzpiTUvnIlri', NULL, NULL, NULL, NULL, NULL, 'default.png', 1, 1, 2, '2023-08-06 00:03:03', '2023-02-22 04:12:48'),
(57, 2, 1, NULL, NULL, 'Ikara Dome', 'ikaradome@yopmail.com', 'CA', '4545151', '$2y$10$z0eXm5BtjQQP77GHRvJAGOIp1osY2Lx0NvMvmkpTgPzpiTUvnIlri', NULL, NULL, NULL, NULL, NULL, 'default.png', 1, 1, 2, '2023-08-06 00:03:03', '2023-02-22 04:12:48'),
(58, 2, 1, NULL, NULL, 'Sitara Domez', 'sitaradome@yopmail.com', 'CA', '84651151', '$2y$10$z0eXm5BtjQQP77GHRvJAGOIp1osY2Lx0NvMvmkpTgPzpiTUvnIlri', NULL, NULL, NULL, NULL, NULL, 'default.png', 1, 1, 2, '2023-09-06 00:03:03', '2023-02-22 04:12:48'),
(59, 2, 1, NULL, NULL, 'Coras Domez', 'corasdomez@yopmail.com', 'CA', '654565615', '$2y$10$z0eXm5BtjQQP77GHRvJAGOIp1osY2Lx0NvMvmkpTgPzpiTUvnIlri', NULL, NULL, NULL, NULL, NULL, 'default.png', 1, 1, 2, '2023-10-06 00:03:03', '2023-02-22 04:12:48'),
(60, 2, 1, NULL, NULL, 'Just Play Domez', 'justplaydomez@yopmail.com', 'CA', '5854854', '$2y$10$z0eXm5BtjQQP77GHRvJAGOIp1osY2Lx0NvMvmkpTgPzpiTUvnIlri', NULL, NULL, NULL, NULL, NULL, 'default.png', 1, 1, 2, '2023-10-06 00:03:03', '2023-02-22 04:12:48'),
(61, 4, 1, 2, NULL, 'hiren', 'hirenitaliya@gmail.com', NULL, NULL, '$2y$10$JrluFobu/xBEBKQZY1kr6.gAJe4QGuWZP6Ugp6ctXHWz4My5lnfeO', NULL, NULL, NULL, NULL, NULL, 'default.png', 1, 1, 2, '2023-03-29 09:29:58', '2023-03-29 09:29:58'),
(62, 3, 1, NULL, NULL, NULL, 's@gmail.com', NULL, NULL, '$2y$10$Em2kx11cJcQLN9iM2mK/ueOh7FrLUkTYOPxRt3AurFEAbITt67ZsK', NULL, NULL, NULL, NULL, NULL, 'default.png', 1, 1, 2, '2023-04-05 08:49:20', '2023-04-05 08:49:20'),
(63, 3, 1, NULL, NULL, 'santosh', 'santosh.vrajtechnosys@gmail.com', 'IN', '9998557245', '$2y$10$yd.DhVEEvTXUpF4M9mSueOwGzllrd8IGtUoa.PY9zA2Cl/DRQHW5O', NULL, NULL, NULL, NULL, NULL, 'default.png', 1, 1, 2, '2023-04-06 04:58:01', '2023-04-06 04:58:01'),
(64, 3, 1, NULL, NULL, NULL, 'null', NULL, NULL, '$2y$10$LhL0JeLWTAEE5atbggy4qO0Rq2bWdUpOiRAkeQZEEGoTsPdyE7zXG', NULL, NULL, NULL, NULL, NULL, 'default.png', 1, 1, 2, '2023-04-06 08:41:38', '2023-04-06 08:41:38'),
(65, 3, 1, NULL, NULL, NULL, 'abcd@gmail.com', NULL, NULL, '$2y$10$g0vu7lRdsBxOGbJiSPg0N.b6q/Q9Auvfdfi.sIQoiisl9xwM15sci', NULL, NULL, NULL, NULL, NULL, 'default.png', 1, 1, 2, '2023-04-06 08:47:26', '2023-04-06 08:47:26'),
(66, 3, 1, NULL, NULL, 'soham', 'domez@gmail.com', 'CA', '6359478772', '$2y$10$1cbNnJ379uwLbf0cBlmooupypHFEzQDVdZWL5jgA0XHfnYseLtpD2', NULL, NULL, NULL, NULL, NULL, 'default.png', 1, 1, 2, '2023-04-06 08:54:44', '2023-04-06 08:54:44'),
(67, 3, 2, NULL, NULL, 'Diya Developer', 'developeratdiyatechlab@gmail.com', '', 'null', NULL, '118229769592452480997', NULL, NULL, NULL, NULL, 'https://lh3.googleusercontent.com/a/AEdFTp4r8T_I6OUXFxYm5WjEdOTdiYMQERdYw0OWZi7V=s96-c', 1, 1, 2, '2023-04-06 08:58:37', '2023-04-06 08:58:37'),
(68, 3, 4, NULL, NULL, 'diwakar', 'tdiwakarkumar@gmail.com', '', '', NULL, NULL, NULL, NULL, NULL, NULL, 'default.png', 1, 1, 2, '2023-04-06 09:47:10', '2023-04-06 09:47:10'),
(69, 3, 1, NULL, NULL, 'diwakar', 'shivakar@gmail.com', 'CA', '5385828289', '$2y$10$gOpL3PLWkmtYfV81XSRZuOZYDR.msIC0w/Vve5g8/qbjGLzGZ3xze', NULL, NULL, NULL, '', NULL, 'profiles-642ebfd246f2a.png', 1, 1, 2, '2023-04-06 09:50:53', '2023-04-06 12:49:22'),
(70, 3, 1, NULL, NULL, 'test1', 'merry@gmail.com', 'CA', '6359478772', '$2y$10$2FVv8hx6eQKUDRINeMQPV.zLye95Og0u1GhYlXUV419PLAJIx6Bfm', NULL, NULL, NULL, '', NULL, 'default.png', 1, 1, 2, '2023-04-06 10:06:53', '2023-04-06 10:06:53'),
(71, 3, 1, NULL, NULL, 'Harshi Soham', 'harshisoham@gmail.com', 'IN', '6359496669', '$2y$10$Hq1ytlv4YIGouAbVxUAxaOE7ABZH.MgbC1LPWKmt41N/hHmRigaqu', NULL, NULL, NULL, '', NULL, 'default.png', 1, 1, 2, '2023-04-06 10:12:50', '2023-04-06 10:21:27'),
(72, 3, 1, NULL, NULL, 'khushi Sheth', 'khushi@gmail.com', 'CA', '6359487667', '$2y$10$XBnd9zLsm7UwUbr8rn3FWenmjzNIMPq/3pO6V5kxLTwkWvdJD5Pou', NULL, NULL, NULL, '', NULL, 'profiles-642eb73a6308e.png', 1, 1, 2, '2023-04-06 10:54:41', '2023-04-06 12:12:42');

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
-- Indexes for table `set_prices`
--
ALTER TABLE `set_prices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `set_prices_days_slots`
--
ALTER TABLE `set_prices_days_slots`
  ADD PRIMARY KEY (`id`),
  ADD KEY `set_prices_id_foreign` (`set_prices_id`);

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `cms`
--
ALTER TABLE `cms`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `domes`
--
ALTER TABLE `domes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `dome_images`
--
ALTER TABLE `dome_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `enquiries`
--
ALTER TABLE `enquiries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `favourites`
--
ALTER TABLE `favourites`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=149;

--
-- AUTO_INCREMENT for table `fields`
--
ALTER TABLE `fields`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `leagues`
--
ALTER TABLE `leagues`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `payment_gateways`
--
ALTER TABLE `payment_gateways`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `set_prices`
--
ALTER TABLE `set_prices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `set_prices_days_slots`
--
ALTER TABLE `set_prices_days_slots`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=353;

--
-- AUTO_INCREMENT for table `sports`
--
ALTER TABLE `sports`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
