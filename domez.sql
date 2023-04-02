-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 02, 2023 at 11:13 AM
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
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `type`, `vendor_id`, `dome_id`, `league_id`, `user_id`, `sport_id`, `field_id`, `booking_id`, `slots`, `start_date`, `end_date`, `start_time`, `end_time`, `sub_total`, `service_fee`, `hst`, `total_amount`, `paid_amount`, `due_amount`, `payment_mode`, `payment_type`, `payment_status`, `booking_status`, `token`, `players`, `customer_name`, `customer_email`, `customer_mobile`, `team_name`, `cancellation_reason`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 35, NULL, 7, 6, '31', 'c6b519', '07:00 PM - 08:00 PM', '2023-04-01', NULL, '18:00:00', '20:00:00', 200, 10, 10, 220.00, 18.33, 201.67, 1, 2, 2, 3, '2y10ipgMiX9CsfGDWicmctdz1uyjHAH3KG2b5fNueNUn3hcOr9jj4AkNa', 12, 'Soham', 'domez@gmail.com', '6359478772', '', NULL, '2023-04-01 06:56:52', '2023-04-01 13:06:00'),
(2, 1, 2, 35, NULL, 7, 6, '30', 'b48ecc', '06:00 AM - 07:00 AM', '2023-04-28', NULL, '06:00:00', '07:00:00', 50, 2.5, 2.5, 55.00, 4.58, 50.42, 1, 2, 2, 3, '2y10oCaojuclx0O2411EFrX1cel21JeH17shI9aYKV2xaIsYSUIeAw7K', 12, 'Soham', 'domez@gmail.com', '6359478772', '', '', '2023-04-02 06:05:13', '2023-04-02 06:20:41'),
(3, 1, 2, 35, NULL, 7, 7, '37', 'a752c5', '01:00 PM - 02:00 PM', '2023-04-02', NULL, '13:00:00', '14:00:00', 800, 40, 40, 880.00, 880.00, 0.00, 1, 2, 1, 1, '2y10UzGW9hi5W4pXm8ywVLYCuZvOyehy555LBP5nIzuulrqjAzBZzt2', 12, 'Soham', 'domez@gmail.com', '6359478772', '', NULL, '2023-04-02 06:38:23', '2023-04-02 06:42:23'),
(4, 1, 2, 35, NULL, 7, 7, '36', '9a1e97', '05:00 PM - 06:00 PM,03:00 PM - 04:00 PM', '2023-04-02', NULL, '15:00:00', '16:00:00', 800, 40, 40, 880.00, 880.00, 0.00, 1, 1, 1, 3, NULL, 12, 'Soham', 'domez@gmail.com', '6359478772', '', '', '2023-04-02 06:51:49', '2023-04-02 06:52:23'),
(5, 1, 2, 35, NULL, 7, 7, '37', 'f03b66', '03:00 PM - 04:00 PM', '2023-04-02', NULL, '15:00:00', '16:00:00', 800, 40, 40, 880.00, 880.00, 0.00, 1, 2, 1, 1, '2y10BwKiA7ki5aN9i1WasPLHaezrAdO9YDrQCk8ddld1vVASTlbkTlaTO', 12, 'Soham', 'domez@gmail.com', '6359478772', '', NULL, '2023-04-02 06:52:57', '2023-04-02 06:54:38');

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

INSERT INTO `domes` (`id`, `vendor_id`, `sport_id`, `name`, `price`, `hst`, `address`, `pin_code`, `city`, `state`, `country`, `start_time`, `end_time`, `description`, `lat`, `lng`, `benefits`, `benefits_description`, `is_deleted`, `created_at`, `updated_at`) VALUES
(35, 2, '6,7,10', 'Domez', 58.00, 5.00, 'Costen Tax Solutions, Inc, Birdneck Road North, Virginia Beach, VA, USA', '23451', 'Summerside', 'Prince Edward Island', 'Canada', '6:00 AM', '7:00 PM', 'DESCRIPTION', '28.5156729', '-81.4824233', 'Free Wifi|Changing Room|Parking|Pool', 'benefits-DESCRIPTION', 2, '2023-02-20 03:57:09', '2023-02-21 05:03:45');

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
(137, 7, 35, NULL, '2023-04-01 04:41:57', '2023-04-01 04:41:57');

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
(2, 2, 35, '10', '2', 452.00, 5, 30, 'field-6712.jpg', 1, 1, '2023-02-20 05:57:52', '2023-03-29 09:45:56'),
(8, 2, 35, '10', '3', 452.00, 10, 20, 'field-3851.jpg', 1, 2, '2023-02-20 05:57:52', '2023-03-16 06:06:21'),
(14, 2, 35, '10', '4', 452.00, 5, 30, 'field-8856.jpg', 1, 2, '2023-02-20 05:57:52', '2023-03-16 06:11:51'),
(20, 2, 35, '10', '5', 452.00, 10, 20, 'field-4042.jpg', 1, 2, '2023-02-20 05:57:52', '2023-03-16 06:12:09'),
(26, 2, 35, '10', '6', 452.00, 5, 30, 'field-9648.jpg', 1, 2, '2023-02-20 05:57:52', '2023-03-16 06:14:23'),
(30, 2, 35, '6', '2', 452.00, 5, 30, 'field-8878.jpg', 1, 2, '2023-02-20 05:57:52', '2023-03-16 06:14:53'),
(31, 2, 35, '6', '3', 452.00, 5, 30, 'field-1132.jpg', 1, 2, '2023-02-20 05:57:52', '2023-03-16 06:15:04'),
(32, 2, 35, '6', '4', 452.00, 5, 30, 'field-930.jpg', 1, 2, '2023-02-20 05:57:52', '2023-03-16 06:15:17'),
(33, 2, 35, '6', '5', 452.00, 5, 30, 'field-3042.jpg', 1, 2, '2023-02-20 05:57:52', '2023-03-16 06:15:30'),
(35, 2, 35, '6', '6', 452.00, 5, 30, 'field-6425.jpg', 1, 2, '2023-02-20 05:57:52', '2023-03-16 06:15:45'),
(36, 2, 35, '7', '2', 452.00, 5, 30, 'field-1765.jpg', 1, 2, '2023-02-20 05:57:52', '2023-03-16 06:16:24'),
(37, 2, 35, '7', '3', 452.00, 5, 30, 'field-8646.jpg', 1, 2, '2023-02-20 05:57:52', '2023-03-16 06:16:20'),
(38, 2, 35, '7', '4', 452.00, 5, 30, 'field-6651.jpg', 1, 2, '2023-02-20 05:57:52', '2023-03-16 06:16:15'),
(39, 2, 35, '7', '5', 452.00, 5, 30, 'field-7202.jpg', 1, 2, '2023-02-20 05:57:52', '2023-03-16 06:17:00'),
(41, 2, 35, '7', '6', 452.00, 5, 30, 'field-7972.jpg', 1, 2, '2023-02-20 05:57:52', '2023-03-16 06:16:03'),
(42, 2, 35, '9', '2', 452.00, 5, 30, 'field-2421.jpg', 1, 2, '2023-02-20 05:57:52', '2023-03-16 06:18:12'),
(43, 2, 35, '9', '3', 452.00, 5, 30, 'field-8043.jpg', 1, 2, '2023-02-20 05:57:52', '2023-03-16 06:18:20'),
(44, 2, 35, '9', '4', 452.00, 5, 30, 'field-4164.jpg', 1, 2, '2023-02-20 05:57:52', '2023-03-16 06:18:36'),
(45, 2, 35, '9', '5', 452.00, 5, 30, 'field-5229.jpg', 1, 2, '2023-02-20 05:57:52', '2023-03-16 06:18:42'),
(47, 2, 35, '9', '6', 452.00, 5, 30, 'field-9338.jpg', 1, 2, '2023-02-20 05:57:52', '2023-03-16 06:18:47'),
(48, 2, 35, '8', '11', 452.00, 15, 30, 'field-6519.jpg', 1, 2, '2023-02-20 05:57:52', '2023-03-16 06:21:55'),
(49, 2, 35, '8', '12', 452.00, 18, 30, 'field-9539.jpg', 1, 2, '2023-02-20 05:57:52', '2023-03-16 06:22:01'),
(50, 2, 35, '8', '13', 452.00, 5, 30, 'field-4828.jpg', 1, 2, '2023-02-20 05:57:52', '2023-03-16 06:22:04'),
(51, 2, 35, '8', '14', 452.00, 20, 30, 'field-4585.jpg', 1, 2, '2023-02-20 05:57:52', '2023-03-16 06:22:08'),
(52, 2, 35, '8', '15', 452.00, 25, 30, 'field-9362.jpg', 1, 2, '2023-02-20 05:57:52', '2023-03-16 06:22:12'),
(53, 2, 35, '8', '16', 452.00, 5, 30, 'field-897.jpg', 1, 2, '2023-02-20 05:57:52', '2023-03-16 06:22:39'),
(54, 2, 35, '11', '21', 0.00, 5, 15, 'field-530.jpg', 1, 2, '2023-03-16 06:38:44', '2023-03-16 06:38:44'),
(55, 2, 35, '11', '22', 0.00, 10, 20, 'field-4067.jpg', 1, 2, '2023-03-16 06:39:54', '2023-03-16 06:39:54'),
(56, 2, 35, '12', '4', 0.00, 20, 40, 'field-7168.jpg', 1, 2, '2023-03-16 06:42:14', '2023-03-16 06:42:14'),
(57, 2, 35, '12', '5', 0.00, 10, 20, 'field-8987.jpg', 1, 2, '2023-03-16 06:43:04', '2023-03-16 06:43:04');

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
(1, 2, 35, '56,55,54,53', 10, 'The Golf League', '2023-05-05', '2023-05-26', '2023-08-25', '09:00 AM', '05:00 PM', 16, 28, 1, 12, 17, 13, 1489, 2, '2023-02-20 06:56:50', '2023-03-31 06:56:41'),
(11, 2, 35, '57,55,52', 10, 'The Soccer League', '2023-03-08', '2023-03-16', '2023-04-10', '09:00 AM', '05:00 PM', 16, 28, 1, 12, 17, 13, 1489, 2, '2023-02-20 06:56:50', '2023-03-31 06:56:05'),
(16, 2, 35, '57', 10, 'The Volleyball League', '2023-04-13', '2023-04-28', '2023-07-28', '09:00 AM', '05:00 PM', 16, 28, 1, 12, 17, 13, 1489, 2, '2023-02-20 06:56:50', '2023-03-31 06:55:50');

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
(5, 2, 35, 10, '2023-04-01', '2023-04-29', 2, 0, '2023-03-12 05:30:16', '2023-03-12 05:30:16'),
(13, 2, 35, 6, NULL, NULL, 1, 800, '2023-03-12 05:30:16', '2023-03-12 05:30:16'),
(14, 2, 35, 7, NULL, NULL, 1, 800, '2023-03-12 05:30:16', '2023-03-12 05:30:16'),
(15, 2, 35, 6, '2023-04-01', '2023-04-29', 2, 0, '2023-03-12 05:30:16', '2023-03-12 05:30:16'),
(16, 2, 35, 7, '2023-06-14', '2023-06-30', 2, 0, '2023-03-12 05:30:16', '2023-04-01 13:35:32'),
(17, 2, 35, 10, NULL, NULL, 1, 120, '2023-03-12 05:30:16', '2023-03-12 05:30:16');

-- --------------------------------------------------------

--
-- Table structure for table `set_prices_days_slots`
--

CREATE TABLE `set_prices_days_slots` (
  `id` int(11) NOT NULL,
  `set_prices_id` int(11) NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `day` varchar(255) NOT NULL,
  `price` double NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `set_prices_days_slots`
--

INSERT INTO `set_prices_days_slots` (`id`, `set_prices_id`, `start_time`, `end_time`, `day`, `price`, `created_at`, `updated_at`) VALUES
(174, 5, '01:00:00', '03:00:00', 'monday', 120, '2023-03-29 00:22:37', '2023-03-29 00:22:37'),
(175, 5, '03:00:00', '06:00:00', 'monday', 150, '2023-03-29 00:22:37', '2023-03-29 00:22:37'),
(176, 5, '07:00:00', '12:00:00', 'monday', 170, '2023-03-29 00:22:37', '2023-03-29 00:22:37'),
(177, 5, '14:00:00', '22:00:00', 'monday', 190, '2023-03-29 00:22:37', '2023-03-29 00:22:37'),
(178, 5, '06:00:00', '11:00:00', 'tuesday', 50, '2023-03-29 00:22:37', '2023-03-29 00:22:37'),
(179, 5, '16:00:00', '23:00:00', 'tuesday', 40, '2023-03-29 00:22:37', '2023-03-29 00:22:37'),
(180, 5, '10:00:00', '19:00:00', 'wednesday', 120, '2023-03-29 00:22:37', '2023-03-29 00:22:37'),
(181, 5, '01:00:00', '02:00:00', 'thursday', 80, '2023-03-29 00:22:37', '2023-03-29 00:22:37'),
(182, 5, '05:00:00', '11:00:00', 'thursday', 100, '2023-03-29 00:22:37', '2023-03-29 00:22:37'),
(183, 5, '05:00:00', '09:00:00', 'friday', 50, '2023-03-29 00:22:37', '2023-03-29 00:22:37'),
(184, 5, '01:00:00', '06:00:00', 'saturday', 120, '2023-03-29 00:22:37', '2023-03-29 00:22:37'),
(185, 5, '14:00:00', '21:00:00', 'saturday', 200, '2023-03-29 00:22:37', '2023-03-29 00:22:37'),
(186, 5, '02:00:00', '10:00:00', 'sunday', 1100, '2023-03-29 00:22:37', '2023-03-29 00:22:37'),
(199, 16, '01:00:00', '03:00:00', 'monday', 120, '2023-04-01 13:35:32', '2023-04-01 13:35:32'),
(200, 16, '03:00:00', '06:00:00', 'monday', 150, '2023-04-01 13:35:32', '2023-04-01 13:35:32'),
(201, 16, '07:00:00', '12:00:00', 'monday', 170, '2023-04-01 13:35:32', '2023-04-01 13:35:32'),
(202, 16, '13:00:00', '22:00:00', 'monday', 190, '2023-04-01 13:35:32', '2023-04-01 13:35:32'),
(203, 16, '06:00:00', '11:00:00', 'tuesday', 50, '2023-04-01 13:35:32', '2023-04-01 13:35:32'),
(204, 16, '01:00:00', '07:00:00', 'tuesday', 40, '2023-04-01 13:35:32', '2023-04-01 13:35:32'),
(205, 16, '04:00:00', '11:00:00', 'wednesday', 120, '2023-04-01 13:35:32', '2023-04-01 13:35:32'),
(206, 16, '01:00:00', '02:00:00', 'thursday', 80, '2023-04-01 13:35:32', '2023-04-01 13:35:32'),
(207, 16, '05:00:00', '11:00:00', 'thursday', 100, '2023-04-01 13:35:32', '2023-04-01 13:35:32'),
(208, 16, '04:00:00', '11:00:00', 'friday', 50, '2023-04-01 13:35:32', '2023-04-01 13:35:32'),
(209, 16, '01:00:00', '06:00:00', 'saturday', 120, '2023-04-01 13:35:32', '2023-04-01 13:35:32'),
(210, 16, '03:00:00', '09:00:00', 'saturday', 200, '2023-04-01 13:35:32', '2023-04-01 13:35:32'),
(211, 16, '09:00:00', '09:00:00', 'sunday', 1100, '2023-04-01 13:35:32', '2023-04-01 13:35:32'),
(212, 15, '01:00:00', '03:00:00', 'monday', 120, '2023-04-01 13:39:29', '2023-04-01 13:39:29'),
(213, 15, '07:00:00', '12:00:00', 'monday', 170, '2023-04-01 13:39:29', '2023-04-01 13:39:29'),
(214, 15, '08:00:00', '09:00:00', 'monday', 3333333333, '2023-04-01 13:39:29', '2023-04-01 13:39:29'),
(215, 15, '06:00:00', '11:00:00', 'tuesday', 50, '2023-04-01 13:39:29', '2023-04-01 13:39:29'),
(216, 15, '17:00:00', '21:00:00', 'tuesday', 40, '2023-04-01 13:39:29', '2023-04-01 13:39:29'),
(217, 15, '10:00:00', '06:00:00', 'wednesday', 120, '2023-04-01 13:39:29', '2023-04-01 13:39:29'),
(218, 15, '01:00:00', '02:00:00', 'thursday', 80, '2023-04-01 13:39:29', '2023-04-01 13:39:29'),
(219, 15, '05:00:00', '11:00:00', 'thursday', 100, '2023-04-01 13:39:29', '2023-04-01 13:39:29'),
(220, 15, '04:00:00', '09:00:00', 'friday', 50, '2023-04-01 13:39:29', '2023-04-01 13:39:29'),
(221, 15, '03:00:00', '07:00:00', 'saturday', 120, '2023-04-01 13:39:29', '2023-04-01 13:39:29'),
(222, 15, '13:00:00', '20:00:00', 'saturday', 200, '2023-04-01 13:39:29', '2023-04-01 13:39:29'),
(223, 15, '03:00:00', '10:00:00', 'sunday', 1100, '2023-04-01 13:39:29', '2023-04-01 13:39:29');

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
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `type`, `vendor_id`, `dome_id`, `league_id`, `user_id`, `booking_id`, `contributor_name`, `payment_method`, `transaction_id`, `amount`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 35, NULL, 7, 'b98541', NULL, 1, '1c2132121c1132ee1ee21e2e1edw', 1000.00, '2023-03-15 05:20:57', '2023-03-15 05:20:57'),
(2, 1, 2, 35, NULL, 7, 'f8da0d', NULL, 1, '1c2132121c1132ee1ee21e2e1edw', 1000.00, '2023-03-15 05:27:20', '2023-03-15 05:27:20'),
(3, 1, 2, 35, NULL, 7, 'c3200a', NULL, 1, '1c2132121c1132ee1ee21e2e1edw', 1000.00, '2023-03-15 05:28:00', '2023-03-15 05:28:00'),
(4, 1, 2, 35, NULL, 7, '42db01', NULL, 1, '1c2132121c1132ee1ee21e2e1edw', 1000.00, '2023-03-15 05:28:18', '2023-03-15 05:28:18'),
(5, 1, 2, 35, NULL, 7, 'b98541', NULL, 1, '1c2132121c1132ee1ee21e2e1edw', 120.00, '2023-03-08 05:20:57', '2023-03-15 05:20:57'),
(6, 1, 2, 35, NULL, 7, 'f8da0d', NULL, 1, '1c2132121c1132ee1ee21e2e1edw', 150.00, '2023-02-08 05:27:20', '2023-03-15 05:27:20'),
(7, 1, 2, 35, NULL, 7, 'c3200a', NULL, 1, '1c2132121c1132ee1ee21e2e1edw', 200.00, '2023-02-15 05:28:00', '2023-03-15 05:28:00'),
(8, 1, 2, 35, NULL, 7, '42db01', NULL, 1, '1c2132121c1132ee1ee21e2e1edw', 350.00, '2023-02-14 05:28:18', '2023-03-15 05:28:18'),
(9, 1, 2, 35, NULL, 7, 'feb086', NULL, 1, 'pi_3MmV0GFysF0okTxJ0kGziJSH', 90.00, '2023-03-16 23:05:13', '2023-03-16 23:05:13'),
(10, 1, 2, 35, NULL, 7, '34b86f', NULL, 1, 'pi_3MmV4NFysF0okTxJ1n3TgWGT', 90.00, '2023-03-16 23:09:25', '2023-03-16 23:09:25'),
(11, 1, 2, 35, NULL, 7, '2a248b', NULL, 1, 'pi_3MmVtlFysF0okTxJ04yXLIzF', 220.00, '2023-03-17 00:02:37', '2023-03-17 00:02:37'),
(12, 1, 2, 35, NULL, 7, '6420c7', NULL, 1, 'pi_3MmVwlFysF0okTxJ1yp8ZZRp', 90.00, '2023-03-17 00:05:38', '2023-03-17 00:05:38'),
(13, 1, 2, 35, NULL, 7, 'bc3167', NULL, 1, 'pi_3MmcQbFysF0okTxJ0VqbZG0E', 80.00, '2023-03-17 07:00:54', '2023-03-17 07:00:54'),
(14, 1, 2, 35, NULL, 7, '71299e', NULL, 1, 'pi_3MmdNKFysF0okTxJ0LLPnqhl', 147.00, '2023-03-17 08:01:33', '2023-03-17 08:01:33'),
(15, 1, 2, 35, NULL, 7, 'd728dc', NULL, 1, 'pi_3Mo2ZhFysF0okTxJ18cO9X50', 80.00, '2023-03-21 05:08:07', '2023-03-21 05:08:07'),
(16, 1, 2, 35, NULL, 7, '13e3f3', NULL, 1, 'pi_3Mo37CFysF0okTxJ00jv8dy9', 150.00, '2023-03-21 05:42:43', '2023-03-21 05:42:43'),
(17, 1, 2, 35, NULL, 7, '27b51d', NULL, 1, 'pi_3Mo3jrFysF0okTxJ1relo4nB', 73.35, '2023-03-21 06:22:42', '2023-03-21 06:22:42'),
(18, 1, 2, 35, NULL, 7, '7c9636', NULL, 1, 'pi_3Mo3nFFysF0okTxJ1KxbBCJl', 80.00, '2023-03-21 11:56:09', '2023-03-21 11:56:09'),
(19, 1, 2, 35, NULL, 7, '0756ad', NULL, 1, 'pi_3Mo3qpFysF0okTxJ1ZSJHyGn', 875.00, '2023-03-21 11:59:51', '2023-03-21 11:59:51'),
(20, 1, 2, 35, NULL, 7, '7c975a', NULL, 1, 'pi_3Mo4tbFysF0okTxJ0TBhi5eH', 73.45, '2023-03-21 07:36:51', '2023-03-21 07:36:51'),
(21, 1, 2, 35, NULL, NULL, '7c975a', 'James', 1, 'pi_3MoOeXFysF0okTxJ1wf2GWqy', 3.00, '2023-03-22 04:43:35', '2023-03-22 04:43:35'),
(22, 1, 2, 35, NULL, NULL, '7c975a', 'James', 1, 'pi_3MoPE0FysF0okTxJ0PbXNjb6', 7.00, '2023-03-22 05:19:29', '2023-03-22 05:19:29'),
(23, 1, 2, 35, NULL, NULL, '7c975a', 'James', 1, 'pi_3MoPKJFysF0okTxJ1I7Vp8RK', 6.55, '2023-03-22 05:26:31', '2023-03-22 05:26:31'),
(24, 1, 2, 35, NULL, NULL, '7c975a', 'james', 1, 'pi_3MoPRUFysF0okTxJ1xj4BiPn', 8.00, '2023-03-22 05:33:20', '2023-03-22 05:33:20'),
(25, 1, 2, 35, NULL, NULL, '6420c7', 'James', 1, 'pi_3MojmCHSYZd3efX11KjqM8JT', 20.00, '2023-03-23 03:16:36', '2023-03-23 03:16:36'),
(26, 1, 2, 35, NULL, 7, '312a52', NULL, 1, 'pi_3Mp2wfFysF0okTxJ14llCllb', 3520.00, '2023-03-23 23:44:11', '2023-03-23 23:44:11'),
(27, 1, 2, 35, NULL, 7, 'eda29f', NULL, 1, 'pi_3MoQ10FysF0okTxJ0yYjf201', 155.29, '2023-03-24 03:52:05', '2023-03-24 03:52:05'),
(28, 1, 2, 35, 11, 7, '97305d', NULL, 1, 'pi_3MoQ10FysF0okTxJ0yYjf201', 2640.00, '2023-03-24 03:53:23', '2023-03-24 03:53:23'),
(29, 1, 2, 35, NULL, 7, '0f7fc8', NULL, 1, 'pi_3Mp7MgFysF0okTxJ02K3F0HA', 11.00, '2023-03-24 04:27:37', '2023-03-24 04:27:37'),
(30, 1, 2, 35, NULL, NULL, '0f7fc8', 'Soham', 1, 'pi_3Mp7SuFysF0okTxJ1RqZYq4t', 121.00, '2023-03-24 04:34:02', '2023-03-24 04:34:02'),
(31, 1, 2, 35, NULL, 7, '852d8a', NULL, 1, 'pi_3Mp7VxFysF0okTxJ1V5Eqj3d', 80.00, '2023-03-24 04:36:57', '2023-03-24 04:36:57'),
(32, 1, 2, 35, NULL, 7, '78c912', NULL, 1, 'pi_3Mp7gyFysF0okTxJ0XQqPF0K', 264.00, '2023-03-24 04:48:11', '2023-03-24 04:48:11'),
(33, 1, 2, 35, 16, 7, 'b64ef1', NULL, 1, 'pi_3Mp80XFysF0okTxJ1WRxUoGk', 1637.90, '2023-03-24 05:08:25', '2023-03-24 05:08:25'),
(34, 1, 2, 35, 16, 7, 'ff954a', NULL, 1, 'pi_3Mp82UFysF0okTxJ1grHcptz', 1637.90, '2023-03-24 05:10:25', '2023-03-24 05:10:25'),
(35, 1, 2, 35, NULL, 7, '0a1dd7', NULL, 1, 'pi_3Mq7soFysF0okTxJ007pJWvh', 8.46, '2023-03-26 23:13:51', '2023-03-26 23:13:51'),
(36, 1, 2, 35, NULL, 7, '704fae', NULL, 1, 'pi_3Mq8IDFysF0okTxJ1x3B9MBG', 880.00, '2023-03-27 05:08:41', '2023-03-27 05:08:41'),
(37, 1, 2, 35, NULL, 7, '76c8b6', NULL, 1, 'pi_3Mq8OxFysF0okTxJ0ZewZyHA', 73.33, '2023-03-26 23:45:52', '2023-03-26 23:45:52'),
(38, 1, 2, 35, NULL, 7, 'ef5355', NULL, 1, 'pi_3Mq8jCFysF0okTxJ04EdubQc', 880.00, '2023-03-27 05:36:34', '2023-03-27 05:36:34'),
(39, 1, 2, 35, NULL, 7, 'b482cb', NULL, 1, 'pi_3Mq8kgFysF0okTxJ1Jp1cOaR', 73.33, '2023-03-27 05:38:32', '2023-03-27 05:38:32'),
(40, 1, 2, 35, NULL, 7, 'd7444d', NULL, 1, 'pi_3Mq8qhFysF0okTxJ1Wrog6Os', 73.33, '2023-03-27 05:44:20', '2023-03-27 05:44:20'),
(41, 1, 2, 35, NULL, 7, 'ce9d6a', NULL, 1, 'pi_3Mq9x0FysF0okTxJ0wqTpJ0M', 73.33, '2023-03-27 06:55:33', '2023-03-27 06:55:33'),
(42, 1, 2, 35, NULL, 7, '0c23ae', NULL, 1, 'pi_3MqCXCFysF0okTxJ0UZNpu8A', 73.33, '2023-03-27 04:10:42', '2023-03-27 04:10:42'),
(43, 1, 2, 35, NULL, 7, '5224da', NULL, 1, 'pi_3MqCvJFysF0okTxJ0xEl2sCV', 67.69, '2023-03-27 04:35:42', '2023-03-27 04:35:42'),
(44, 1, 2, 35, NULL, 7, '0e6a68', NULL, 1, 'pi_3MqD1KFysF0okTxJ0TXNkc83', 73.33, '2023-03-27 04:41:53', '2023-03-27 04:41:53'),
(45, 1, 2, 35, NULL, 7, '8f0247', NULL, 1, 'pi_3MqDBRFysF0okTxJ0GcxVqO2', 333.00, '2023-03-27 04:52:28', '2023-03-27 04:52:28'),
(46, 1, 2, 35, NULL, 7, '2af076', NULL, 1, 'pi_3MqDHPFysF0okTxJ0QRGNOVz', 73.33, '2023-03-27 04:58:14', '2023-03-27 04:58:14'),
(47, 1, 2, 35, NULL, 7, '61de2e', NULL, 1, 'pi_3MqDIjFysF0okTxJ03rbCRBa', 880.00, '2023-03-27 04:59:33', '2023-03-27 04:59:33'),
(48, 1, 2, 35, NULL, 7, '19f0a4', NULL, 1, 'pi_3MqDLCFysF0okTxJ0aq6U1n4', 132.00, '2023-03-27 05:02:11', '2023-03-27 05:02:11'),
(49, 1, 2, 35, NULL, 7, 'fb7764', NULL, 1, 'pi_3MqVtDFysF0okTxJ1MIvhIKg', 80.00, '2023-03-28 00:50:28', '2023-03-28 00:50:28'),
(50, 1, 2, 35, NULL, 7, 'b3a5d8', NULL, 1, 'pi_3MqXt1FysF0okTxJ1X5KWY7W', 73.33, '2023-03-28 08:28:27', '2023-03-28 08:28:27'),
(51, 1, 2, 35, NULL, 7, 'a37581', NULL, 1, 'pi_3Mqs4ZFysF0okTxJ0CJtI8Zm', 73.33, '2023-03-29 00:31:40', '2023-03-29 00:31:40'),
(52, 1, 2, 35, NULL, 7, 'fb3d3f', NULL, 1, 'pi_3Mqs58FysF0okTxJ0LPt32P8', 880.00, '2023-03-29 00:32:16', '2023-03-29 00:32:16'),
(53, 1, 2, 35, NULL, 7, '0fbea8', NULL, 1, 'pi_3MqsjZFysF0okTxJ1uR7pS5v', 11.00, '2023-03-29 01:14:02', '2023-03-29 01:14:02'),
(54, 1, 2, 35, NULL, 7, 'dbfe34', NULL, 1, 'pi_3MqskzFysF0okTxJ0hjDsGmP', 880.00, '2023-03-29 01:15:32', '2023-03-29 01:15:32'),
(55, 1, 2, 35, NULL, 7, '339b80', NULL, 1, 'pi_3MqtKVFysF0okTxJ0rFkc0RF', 880.00, '2023-03-29 01:52:10', '2023-03-29 01:52:10'),
(56, 1, 2, 35, NULL, 7, '133453', NULL, 1, 'pi_3MqtMWFysF0okTxJ0Pj2ZI7A', 132.00, '2023-03-29 01:54:19', '2023-03-29 01:54:19'),
(57, 1, 2, 35, NULL, 7, '87690f', NULL, 1, 'pi_3MqtlJFysF0okTxJ0aC4YMAY', 132.00, '2023-03-29 02:19:58', '2023-03-29 02:19:58'),
(58, 1, 2, 35, NULL, 7, 'e417ff', NULL, 1, 'pi_3MqtrbFysF0okTxJ1HQ43r5e', 880.00, '2023-03-29 02:26:25', '2023-03-29 02:26:25'),
(59, 1, 2, 35, NULL, 7, 'c0317a', NULL, 1, 'pi_3MqttFFysF0okTxJ0ApMq1o6', 880.00, '2023-03-29 02:28:05', '2023-03-29 02:28:05'),
(60, 1, 2, 35, NULL, 7, 'eb54cb', NULL, 1, 'pi_3MqtxCFysF0okTxJ1qkNKzbx', 132.00, '2023-03-29 02:32:20', '2023-03-29 02:32:20'),
(61, 1, 2, 35, NULL, 7, 'b7c30b', NULL, 1, 'pi_3Mqu1gFysF0okTxJ0sSZXNh6', 132.00, '2023-03-29 02:36:54', '2023-03-29 02:36:54'),
(62, 1, 2, 35, NULL, 7, 'd52db0', NULL, 1, 'pi_3Mqu3iFysF0okTxJ0YW6VeOz', 880.00, '2023-03-29 02:38:56', '2023-03-29 02:38:56'),
(63, 1, 2, 35, NULL, 7, 'f1c58c', NULL, 1, 'pi_3MquK0FysF0okTxJ19vOTZVJ', 880.00, '2023-03-29 02:55:50', '2023-03-29 02:55:50'),
(64, 1, 2, 35, NULL, 7, '93c8de', NULL, 1, 'pi_3MquN7FysF0okTxJ1Wlbc7n4', 880.00, '2023-03-29 02:59:00', '2023-03-29 02:59:00'),
(65, 1, 2, 35, 16, 7, '8e7aa6', NULL, 1, 'pi_3MqvasFysF0okTxJ0iBfbWsZ', 1637.90, '2023-03-29 04:17:15', '2023-03-29 04:17:15'),
(66, 1, 2, 35, NULL, 7, 'e015e2', NULL, 1, 'pi_3MoQ10FysF0okTxJ0yYjf201', 155.29, '2023-03-29 04:27:09', '2023-03-29 04:27:09'),
(67, 1, 2, 35, 16, 7, 'f6529e', NULL, 1, 'pi_3MqvtrFysF0okTxJ17zFqUV3', 1637.90, '2023-03-29 04:37:25', '2023-03-29 04:37:25'),
(68, 1, 2, 35, 16, 7, '9dfcf1', NULL, 1, 'pi_3Mqw4MFysF0okTxJ0t74TKKn', 1637.90, '2023-03-29 04:47:48', '2023-03-29 04:47:48'),
(69, 1, 2, 35, NULL, 7, '79c2ca', NULL, 1, 'pi_3MqwQsFysF0okTxJ1EIMEXSA', 880.00, '2023-03-29 05:10:59', '2023-03-29 05:10:59'),
(70, 1, 2, 35, NULL, 7, '2bb5de', NULL, 1, 'pi_3MqwhLFysF0okTxJ0ezldKvX', 73.33, '2023-03-29 05:28:06', '2023-03-29 05:28:06'),
(71, 1, 2, 35, 16, 7, '08bda0', NULL, 1, 'pi_3MqwjIFysF0okTxJ1TYj0V1Q', 1637.90, '2023-03-29 05:30:08', '2023-03-29 05:30:08'),
(72, 1, 2, 35, 16, 7, '0f1376', NULL, 1, 'pi_3MqwksFysF0okTxJ0IzLr1Ik', 1637.90, '2023-03-29 05:31:40', '2023-03-29 05:31:40'),
(73, 1, 2, 35, 16, 7, '2c8fb5', NULL, 1, 'pi_3MqwmRFysF0okTxJ0tdrM1mu', 1637.90, '2023-03-29 05:33:15', '2023-03-29 05:33:15'),
(74, 1, 2, 35, NULL, 7, '2b167c', NULL, 1, 'pi_3Mqx6lFysF0okTxJ1xbjYS2c', 73.33, '2023-03-29 05:54:20', '2023-03-29 05:54:20'),
(75, 1, 2, 35, NULL, 7, '635bd7', NULL, 1, 'pi_3MrDQDFysF0okTxJ1VXZ7zz4', 880.00, '2023-03-29 23:19:34', '2023-03-29 23:19:34'),
(76, 1, 2, 35, NULL, 7, 'c03274', NULL, 1, 'pi_3MrDWyFysF0okTxJ0wZm0nuh', 73.33, '2023-03-29 23:26:25', '2023-03-29 23:26:25'),
(77, 1, 2, 35, NULL, 7, '66f934', NULL, 1, 'pi_3MrGvSFysF0okTxJ0TaCgV6D', 80.00, '2023-03-30 03:03:58', '2023-03-30 03:03:58'),
(78, 1, 2, 35, NULL, 7, 'a21be1', NULL, 1, 'pi_3MrHnoFysF0okTxJ1nUzCgMf', 802.30, '2023-03-30 04:00:25', '2023-03-30 04:00:25'),
(79, 1, 2, 35, NULL, 7, '3791ce', NULL, 1, 'pi_3MrHzbFysF0okTxJ1kMeOtoA', 73.33, '2023-03-30 04:12:16', '2023-03-30 04:12:16'),
(80, 1, 2, 35, NULL, 7, '670a1f', NULL, 1, 'pi_3MrI0lFysF0okTxJ04p53bJx', 99.00, '2023-03-30 04:13:34', '2023-03-30 04:13:34'),
(81, 1, 2, 35, NULL, 7, '092948', NULL, 1, 'pi_3MrITIFysF0okTxJ0a3Cvs0e', 73.36, '2023-03-30 04:42:56', '2023-03-30 04:42:56'),
(82, 1, 2, 35, NULL, 7, '715f07', NULL, 1, 'pi_3MrIUqFysF0okTxJ1QdyGcjT', 80.00, '2023-03-30 04:44:33', '2023-03-30 04:44:33'),
(83, 1, 2, 35, NULL, 7, '7d03d8', NULL, 1, 'pi_3MrIWlFysF0okTxJ0mvPZ43c', 73.33, '2023-03-30 04:46:35', '2023-03-30 04:46:35'),
(84, 1, 2, 35, NULL, 7, 'f79110', NULL, 1, 'pi_3MrJEpFysF0okTxJ0c8y9vsO', 73.33, '2023-03-30 05:32:03', '2023-03-30 05:32:03'),
(85, 1, 2, 35, NULL, 7, '73c344', NULL, 1, 'pi_3MrJI7FysF0okTxJ0h1ISNFx', 4.58, '2023-03-30 05:35:34', '2023-03-30 05:35:34'),
(86, 1, 2, 35, NULL, 7, 'd3532d', NULL, 1, 'pi_3MrZgvFysF0okTxJ0bD8hbfF', 73.33, '2023-03-30 23:06:14', '2023-03-30 23:06:14'),
(87, 1, 2, 35, NULL, 7, 'cd325b', NULL, 1, 'pi_3MrZu6FysF0okTxJ1g3cDRG6', 100.00, '2023-03-30 23:19:50', '2023-03-30 23:19:50'),
(88, 1, 2, 35, NULL, NULL, 'cd325b', 'ew', 1, 'pi_3Mraq3FysF0okTxJ1CZPWxGo', 11.00, '2023-03-31 00:19:44', '2023-03-31 00:19:44'),
(89, 1, 2, 35, NULL, NULL, 'cd325b', '7uyt', 1, 'pi_3MraqaFysF0okTxJ0aeoObvP', 222.00, '2023-03-31 00:20:12', '2023-03-31 00:20:12'),
(90, 1, 2, 35, NULL, NULL, 'cd325b', 'dsfhs', 1, 'pi_3Mrar5FysF0okTxJ0Vb9g9LT', 22.00, '2023-03-31 00:20:38', '2023-03-31 00:20:38'),
(91, 1, 2, 35, NULL, NULL, 'cd325b', '125', 1, 'pi_3MrarhFysF0okTxJ1uT3XXGx', 344.00, '2023-03-31 00:21:20', '2023-03-31 00:21:20'),
(92, 1, 2, 35, NULL, NULL, 'cd325b', '12312', 1, 'pi_3Mras9FysF0okTxJ17r9gFV9', 111.00, '2023-03-31 00:21:44', '2023-03-31 00:21:44'),
(93, 1, 2, 35, NULL, NULL, 'cd325b', 'ddf', 1, 'pi_3MrasYFysF0okTxJ0GXoQGZP', 20.00, '2023-03-31 00:22:11', '2023-03-31 00:22:11'),
(94, 1, 2, 35, NULL, NULL, 'cd325b', '4242 4242 4242 4242', 1, 'pi_3MrasvFysF0okTxJ19cEWYqe', 4.00, '2023-03-31 00:22:31', '2023-03-31 00:22:31'),
(95, 1, 2, 35, NULL, NULL, 'cd325b', 'FDC', 1, 'pi_3MratIFysF0okTxJ0GByZgVo', 23.00, '2023-03-31 00:23:03', '2023-03-31 00:23:03'),
(96, 1, 2, 35, NULL, NULL, 'cd325b', 'CDSV', 1, 'pi_3MratsFysF0okTxJ059h03uO', 22.50, '2023-03-31 00:23:31', '2023-03-31 00:23:31'),
(97, 1, 2, 35, NULL, NULL, 'cd325b', 'ERG', 1, 'pi_3MrauFFysF0okTxJ0UrQjIzD', 0.50, '2023-03-31 00:23:52', '2023-03-31 00:23:52'),
(98, 1, 2, 35, NULL, 7, '989fef', NULL, 1, 'pi_3MrbulFysF0okTxJ1z8vmAq4', 7.33, '2023-03-31 01:29:06', '2023-03-31 01:29:06'),
(99, 1, 2, 35, NULL, 7, 'bfe54e', NULL, 1, 'pi_3MreWAFysF0okTxJ0Xfkg3rm', 99.00, '2023-03-31 04:15:27', '2023-03-31 04:15:27'),
(100, 1, 2, 35, NULL, 7, 'a4ecda', NULL, 1, 'pi_3MrecvFysF0okTxJ1WwrixfX', 73.33, '2023-03-31 04:22:29', '2023-03-31 04:22:29'),
(101, 1, 2, 35, NULL, NULL, 'a4ecda', 'dsjdj', 1, 'pi_3MrefCFysF0okTxJ0GPY3E7o', 400.00, '2023-03-31 04:24:50', '2023-03-31 04:24:50'),
(102, 1, 2, 35, NULL, NULL, 'a4ecda', 'gfg', 1, 'pi_3Mreg3FysF0okTxJ0wfW7OtE', 200.00, '2023-03-31 04:25:39', '2023-03-31 04:25:39'),
(103, 1, 2, 35, NULL, NULL, 'a4ecda', 'a', 1, 'pi_3MregqFysF0okTxJ1wOHr7W8', 100.00, '2023-03-31 04:26:45', '2023-03-31 04:26:45'),
(104, 1, 2, 35, NULL, NULL, 'a4ecda', 'dss', 1, 'pi_3MreiFFysF0okTxJ0eMHmBwn', 106.67, '2023-03-31 04:27:47', '2023-03-31 04:27:47'),
(105, 1, 2, 35, NULL, 7, 'a54fae', NULL, 1, 'pi_3MrfvCFysF0okTxJ18gfQNZc', 880.00, '2023-03-31 05:45:22', '2023-03-31 05:45:22'),
(106, 1, 2, 35, NULL, 7, 'f809dd', NULL, 1, 'pi_3MrwFuFysF0okTxJ0LHOqmhk', 18.33, '2023-03-31 23:11:51', '2023-03-31 23:11:51'),
(107, 1, 2, 35, NULL, 7, 'd38fbf', NULL, 1, 'pi_3MrwYGFysF0okTxJ1iAFFkla', 9.17, '2023-03-31 23:30:44', '2023-03-31 23:30:44'),
(108, 1, 2, 35, NULL, 7, 'd9e8ef', NULL, 1, 'pi_3MryHPFysF0okTxJ1VyASmQx', 88.00, '2023-04-01 01:21:26', '2023-04-01 01:21:26'),
(109, 1, 2, 35, NULL, 7, '4ea4bd', NULL, 1, 'pi_3MryIkFysF0okTxJ1SDT1yVF', 18.33, '2023-04-01 01:22:49', '2023-04-01 01:22:49'),
(110, 1, 2, 35, NULL, 7, 'df3e70', NULL, 1, 'pi_3MryyRFysF0okTxJ09RBE1b7', 4.58, '2023-04-01 02:05:55', '2023-04-01 02:05:55'),
(111, 1, 2, 35, NULL, 7, '137a6b', NULL, 1, 'pi_3MryzEFysF0okTxJ06jsTnBD', 18.33, '2023-04-01 02:06:47', '2023-04-01 02:06:47'),
(112, 1, 2, 35, NULL, 7, '4722a1', NULL, 1, 'pi_3MrzukFysF0okTxJ0JI4loDS', 88.00, '2023-04-01 03:06:15', '2023-04-01 03:06:15'),
(113, 1, 2, 35, NULL, 7, '2799c6', NULL, 1, 'pi_3MrzxiFysF0okTxJ0Mn4VYNK', 18.33, '2023-04-01 03:09:14', '2023-04-01 03:09:14'),
(114, 1, 2, 35, NULL, 7, '27dc01', NULL, 1, 'pi_3Ms0tdFysF0okTxJ09ceHauv', 18.33, '2023-04-01 04:09:03', '2023-04-01 04:09:03'),
(115, 1, 2, 35, NULL, 7, '514641', NULL, 1, 'pi_3Ms0ubFysF0okTxJ0mAs2Z0r', 18.33, '2023-04-01 04:10:04', '2023-04-01 04:10:04'),
(116, 1, 2, 35, NULL, 7, '2e9eea', NULL, 1, 'pi_3Ms0vEFysF0okTxJ0EdWBxon', 11.00, '2023-04-01 04:10:45', '2023-04-01 04:10:45'),
(117, 1, 2, 35, NULL, 7, '374a58', NULL, 1, 'pi_3Ms1E0FysF0okTxJ0jteQvEZ', 18.33, '2023-04-01 04:30:08', '2023-04-01 04:30:08'),
(118, 1, 2, 35, NULL, 7, 'ffb438', NULL, 1, 'pi_3Ms1OcFysF0okTxJ1ShBwhjI', 11.00, '2023-04-01 04:41:04', '2023-04-01 04:41:04'),
(119, 1, 2, 35, NULL, 7, '17c881', NULL, 1, 'pi_3Ms1fDFysF0okTxJ1YcUZmF2', 18.33, '2023-04-01 04:58:13', '2023-04-01 04:58:13'),
(120, 1, 2, 35, NULL, 7, '611435', NULL, 1, 'pi_3Ms1i4FysF0okTxJ11WZ5wyq', 18.33, '2023-04-01 05:01:12', '2023-04-01 05:01:12'),
(121, 1, 2, 35, NULL, 7, '09a31f', NULL, 1, 'pi_3Ms224FysF0okTxJ1wzmaZcQ', 18.33, '2023-04-01 05:22:18', '2023-04-01 05:22:18'),
(122, 1, 2, 35, NULL, 7, '6bd117', NULL, 1, 'pi_3Ms24xFysF0okTxJ10pI8gxM', 18.33, '2023-04-01 05:24:52', '2023-04-01 05:24:52'),
(123, 1, 2, 35, NULL, 7, '2d3230', NULL, 1, 'pi_3Ms25xFysF0okTxJ1amZxHBP', 18.33, '2023-04-01 05:25:51', '2023-04-01 05:25:51'),
(124, 1, 2, 35, NULL, 7, '6c9814', NULL, 1, 'pi_3Ms27xFysF0okTxJ1CdsZ1t4', 18.33, '2023-04-01 05:27:58', '2023-04-01 05:27:58'),
(125, 1, 2, 35, NULL, 7, '335561', NULL, 1, 'pi_3Ms2S5FysF0okTxJ04ciHmw2', 18.33, '2023-04-01 05:48:43', '2023-04-01 05:48:43'),
(126, 1, 2, 35, NULL, 7, '6a2f7b', NULL, 1, 'pi_3Ms2TBFysF0okTxJ0roMJ7A7', 4.58, '2023-04-01 05:49:53', '2023-04-01 05:49:53'),
(127, 1, 2, 35, NULL, 7, 'a387de', NULL, 1, 'pi_3Ms2TqFysF0okTxJ194ehW67', 55.00, '2023-04-01 05:50:36', '2023-04-01 05:50:36'),
(128, 1, 2, 35, NULL, 7, '5eb597', NULL, 1, 'pi_3Ms2cLFysF0okTxJ1S6yPxQh', 18.33, '2023-04-01 05:59:20', '2023-04-01 05:59:20'),
(129, 1, 2, 35, NULL, 7, 'd68b08', NULL, 1, 'pi_3Ms2r7FysF0okTxJ15k5WjX8', 4.58, '2023-04-01 06:14:39', '2023-04-01 06:14:39'),
(130, 1, 2, 35, NULL, 7, '3aef93', NULL, 1, 'pi_3Ms3NLFysF0okTxJ1GuuZbBH', 18.33, '2023-04-01 06:47:54', '2023-04-01 06:47:54'),
(131, 1, 2, 35, NULL, 7, '5808d8', NULL, 1, 'pi_3Ms3ZsFysF0okTxJ0EhHGfs2', 18.33, '2023-04-01 07:01:11', '2023-04-01 07:01:11'),
(132, 1, 2, 35, NULL, 7, 'c6b519', NULL, 1, 'pi_3Ms3yvFysF0okTxJ1jv5DTUs', 18.33, '2023-04-01 12:56:52', '2023-04-01 12:56:52'),
(133, 1, 2, 35, NULL, 7, 'b48ecc', NULL, 1, 'pi_3MsJz0FysF0okTxJ0uFNuTD6', 4.58, '2023-04-02 06:05:13', '2023-04-02 06:05:13'),
(134, 1, 2, 35, NULL, 7, 'a752c5', NULL, 1, 'pi_3MsKYCFysF0okTxJ1AhhmgvY', 73.33, '2023-04-02 06:38:22', '2023-04-02 06:38:22'),
(135, 1, 2, 35, NULL, NULL, 'a752c5', 'soham', 1, 'pi_3MsKZSFysF0okTxJ0tyVV2lI', 22.00, '2023-04-02 06:39:50', '2023-04-02 06:39:50'),
(136, 1, 2, 35, NULL, NULL, 'a752c5', 'HIREN', 1, 'pi_3MsKaKFysF0okTxJ1XyhTQBU', 66.00, '2023-04-02 06:40:32', '2023-04-02 06:40:32'),
(137, 1, 2, 35, NULL, NULL, 'a752c5', 'SOHAM', 1, 'pi_3MsKayFysF0okTxJ02baTKxV', 500.00, '2023-04-02 06:41:04', '2023-04-02 06:41:04'),
(138, 1, 2, 35, NULL, NULL, 'a752c5', 'SAURABHG', 1, 'pi_3MsKbXFysF0okTxJ0wQaxtHU', 33.00, '2023-04-02 06:41:38', '2023-04-02 06:41:38'),
(139, 1, 2, 35, NULL, NULL, 'a752c5', 'JAYESH', 1, 'pi_3MsKbtFysF0okTxJ1ziWOyye', 22.00, '2023-04-02 06:41:59', '2023-04-02 06:41:59'),
(140, 1, 2, 35, NULL, NULL, 'a752c5', 'VRAJ', 1, 'pi_3MsKcGFysF0okTxJ1gETujuV', 163.67, '2023-04-02 06:42:23', '2023-04-02 06:42:23'),
(141, 1, 2, 35, NULL, 7, '9a1e97', NULL, 1, 'pi_3MsKlEFysF0okTxJ0JGSnWvQ', 880.00, '2023-04-02 06:51:49', '2023-04-02 06:51:49'),
(142, 1, 2, 35, NULL, 7, 'f03b66', NULL, 1, 'pi_3MsKmKFysF0okTxJ1EVK37XV', 73.33, '2023-04-02 06:52:57', '2023-04-02 06:52:57'),
(143, 1, 2, 35, NULL, NULL, 'f03b66', 'soham kings', 1, 'pi_3MsKn8FysF0okTxJ1iZPr4Tc', 123.00, '2023-04-02 06:53:46', '2023-04-02 06:53:46'),
(144, 1, 2, 35, NULL, NULL, 'f03b66', 'hiren bhai', 1, 'pi_3MsKndFysF0okTxJ1A0pNdNW', 333.00, '2023-04-02 06:54:06', '2023-04-02 06:54:06'),
(145, 1, 2, 35, NULL, NULL, 'f03b66', 'Jayesh Bossz', 1, 'pi_3MsKo9FysF0okTxJ1CjKIO3m', 350.67, '2023-04-02 06:54:38', '2023-04-02 06:54:38');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `type` int(11) NOT NULL COMMENT '1=Admin, 2=Dome Owner, 3=User',
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
(7, 3, 1, NULL, NULL, 'Soham', 'domez@gmail.com', 'CA', '6359478772', '$2y$10$gtan0ZH/DCiZmnR2yLGiyeZAR0YeEu9krVXGHQfXBqk63ep0WQEEm', NULL, NULL, NULL, NULL, NULL, 'default.png', 1, 1, 2, '2023-02-19 02:22:29', '2023-03-28 06:45:53'),
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
(50, 2, 1, NULL, NULL, 'Ipsum Dome', 'ipsumdome@yopmail.com', 'CA', '897854654', '$2y$10$z0eXm5BtjQQP77GHRvJAGOIp1osY2Lx0NvMvmkpTgPzpiTUvnIlri', NULL, NULL, NULL, NULL, NULL, 'default.png', 1, 1, 2, '2023-03-14 00:03:03', '2023-02-22 04:12:48'),
(51, 2, 1, NULL, NULL, 'Lorem Dome', 'loremdome@yopmail.com', 'CA', '8945454546', '$2y$10$z0eXm5BtjQQP77GHRvJAGOIp1osY2Lx0NvMvmkpTgPzpiTUvnIlri', NULL, NULL, NULL, NULL, NULL, 'default.png', 1, 1, 2, '2023-03-17 00:03:03', '2023-02-22 04:12:48'),
(52, 2, 1, NULL, NULL, 'Carter Dome', 'carterdome@yopmail.com', 'CA', '123890', '$2y$10$z0eXm5BtjQQP77GHRvJAGOIp1osY2Lx0NvMvmkpTgPzpiTUvnIlri', NULL, NULL, NULL, NULL, NULL, 'default.png', 1, 1, 2, '2023-04-06 00:03:03', '2023-02-22 04:12:48'),
(53, 2, 1, NULL, NULL, 'Shotty Dome', 'shottydome@yopmail.com', 'CA', '4651651', '$2y$10$z0eXm5BtjQQP77GHRvJAGOIp1osY2Lx0NvMvmkpTgPzpiTUvnIlri', NULL, NULL, NULL, NULL, NULL, 'default.png', 1, 1, 2, '2023-05-06 00:03:03', '2023-02-22 04:12:48'),
(54, 2, 1, NULL, NULL, 'Jecky\"s Dome', 'jeckydome@yopmail.com', 'CA', '1237890', '$2y$10$z0eXm5BtjQQP77GHRvJAGOIp1osY2Lx0NvMvmkpTgPzpiTUvnIlri', NULL, NULL, NULL, NULL, NULL, 'default.png', 1, 1, 2, '2023-07-06 00:03:03', '2023-02-22 04:12:48'),
(55, 2, 1, NULL, NULL, 'Domaz Domez', 'domazdomez@yopmail.com', 'CA', '894651651', '$2y$10$z0eXm5BtjQQP77GHRvJAGOIp1osY2Lx0NvMvmkpTgPzpiTUvnIlri', NULL, NULL, NULL, NULL, NULL, 'default.png', 1, 1, 2, '2023-07-06 00:03:03', '2023-02-22 04:12:48'),
(56, 2, 1, NULL, NULL, 'Lomar Dome', 'lomardome@yopmail.com', 'CA', '894546515', '$2y$10$z0eXm5BtjQQP77GHRvJAGOIp1osY2Lx0NvMvmkpTgPzpiTUvnIlri', NULL, NULL, NULL, NULL, NULL, 'default.png', 1, 1, 2, '2023-08-06 00:03:03', '2023-02-22 04:12:48'),
(57, 2, 1, NULL, NULL, 'Ikara Dome', 'ikaradome@yopmail.com', 'CA', '4545151', '$2y$10$z0eXm5BtjQQP77GHRvJAGOIp1osY2Lx0NvMvmkpTgPzpiTUvnIlri', NULL, NULL, NULL, NULL, NULL, 'default.png', 1, 1, 2, '2023-08-06 00:03:03', '2023-02-22 04:12:48'),
(58, 2, 1, NULL, NULL, 'Sitara Domez', 'sitaradome@yopmail.com', 'CA', '84651151', '$2y$10$z0eXm5BtjQQP77GHRvJAGOIp1osY2Lx0NvMvmkpTgPzpiTUvnIlri', NULL, NULL, NULL, NULL, NULL, 'default.png', 1, 1, 2, '2023-09-06 00:03:03', '2023-02-22 04:12:48'),
(59, 2, 1, NULL, NULL, 'Coras Domez', 'corasdomez@yopmail.com', 'CA', '654565615', '$2y$10$z0eXm5BtjQQP77GHRvJAGOIp1osY2Lx0NvMvmkpTgPzpiTUvnIlri', NULL, NULL, NULL, NULL, NULL, 'default.png', 1, 1, 2, '2023-10-06 00:03:03', '2023-02-22 04:12:48'),
(60, 2, 1, NULL, NULL, 'Just Play Domez', 'justplaydomez@yopmail.com', 'CA', '5854854', '$2y$10$z0eXm5BtjQQP77GHRvJAGOIp1osY2Lx0NvMvmkpTgPzpiTUvnIlri', NULL, NULL, NULL, NULL, NULL, 'default.png', 1, 1, 2, '2023-10-06 00:03:03', '2023-02-22 04:12:48'),
(61, 4, 1, 2, NULL, 'hiren', 'hirenitaliya@gmail.com', NULL, NULL, '$2y$10$JrluFobu/xBEBKQZY1kr6.gAJe4QGuWZP6Ugp6ctXHWz4My5lnfeO', NULL, NULL, NULL, NULL, NULL, 'default.png', 1, 1, 2, '2023-03-29 09:29:58', '2023-03-29 09:29:58');

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `cms`
--
ALTER TABLE `cms`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `domes`
--
ALTER TABLE `domes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `dome_images`
--
ALTER TABLE `dome_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `enquiries`
--
ALTER TABLE `enquiries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `favourites`
--
ALTER TABLE `favourites`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=138;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `set_prices`
--
ALTER TABLE `set_prices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `set_prices_days_slots`
--
ALTER TABLE `set_prices_days_slots`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=224;

--
-- AUTO_INCREMENT for table `sports`
--
ALTER TABLE `sports`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=146;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
