-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 15, 2023 at 11:58 AM
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
(22, 1, 2, 35, NULL, 7, 6, '2', '554611', '2023-03-15', 'Prof. Geovany Kuhn', 'arno.mayert@example.com', '+14809074204', NULL, 17, '06:30 AM - 07:30 AM', NULL, NULL, '1:41 PM', '11:35 AM', 87.00, 23.00, 26.00, 1, 2, 1, 1, NULL, '2023-02-16 04:57:41', '2023-02-20 04:57:41'),
(30, 1, 2, 35, NULL, 7, 7, '14', '642194', '1989-11-13', 'Verona Marks MD', 'deshawn.abshire@example.com', '+1.918.990.4786', NULL, 14, '06:30 AM - 07:30 AM', NULL, NULL, '1:24 AM', '3:56 AM', 74.00, 34.00, 19.00, 1, 2, 1, 1, NULL, '2023-02-20 04:57:41', '2023-02-20 04:57:41'),
(63, 1, 2, 35, NULL, 7, 10, '20', '554611', '2023-04-10', 'james Carter', 'james123@example.com', '+14809074204', NULL, 17, '08:00 PM - 09:00 PM', NULL, NULL, '08:00 PM', '09:00 PM', 87.00, 23.00, 26.00, 1, 2, 1, 1, NULL, '2023-02-16 04:57:41', '2023-02-20 04:57:41'),
(67, 1, 2, 35, NULL, 7, 10, '8', '42db01', '2023-05-10', 'Soham', 'domez@gmail.com', '6359478772', NULL, 20, '07:00 AM - 08:00 AM', NULL, NULL, '07:00 AM', '08:00 AM', 1000.00, 0.00, 0.00, 1, 1, 1, 1, '', '2023-03-15 05:28:18', '2023-03-15 05:28:18');

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

--
-- Dumping data for table `cms`
--

INSERT INTO `cms` (`id`, `type`, `content`, `created_at`, `updated_at`) VALUES
(1, 2, '<h1>Terms &amp; Conditions</h1>\n\n<h2>Agreement to Terms</h2>\n\n<p>These Terms &amp; Conditions constitute a legally binding agreement made between you, whether personally or on behalf of an entity (&ldquo;you&rdquo;) and Most Advanced Booking System For Your Dome (&amp;rd; &ldquo;our,&rdquo; or &ldquo;the company&rdquo;), concerning your access to and use of the Most Advanced Booking System For Your Dome website.</p>\n\n<p>You agree that by accessing or using our website, you have read, understood, and agree to be bound by all of these Terms &amp; Conditions. If you do not agree to all of these Terms &amp; Conditions, then you are prohibited from using the website and you must discontinue use immediately.</p>\n\n<h2>Modification of Terms</h2>\n\n<p>We reserve the right, at our sole discretion, to modify or replace these Terms &amp; Conditions at any time. If a revision is material, we will provide at least 30 days&rsquo; notice prior to any new terms taking effect. What constitutes a material change will be determined at our sole discretion.</p>\n\n<h2>Accuracy of Information</h2>\n\n<p>We do not warrant the accuracy, completeness, or usefulness of any information on our website. Any reliance you place on such information is strictly at your own risk. We disclaim all liability and responsibility arising from any reliance placed on such materials by you or any other visitor to our website, or by anyone who may be informed of any of its contents.</p>\n\n<h2>Intellectual Property</h2>\n\n<p>The website and its original content, features, and functionality are owned by Most Advanced Booking System For Your Dome and are protected by international copyright, trademark, patent, trade secret, and other intellectual property or proprietary rights laws.</p>\n\n<h2>Limitation of Liability</h2>\n\n<p>In no event shall Most Advanced Booking System For Your Dome, its directors, employees, partners, agents, suppliers, or affiliates, be liable for any indirect, incidental, special, consequential, or punitive damages, including without limitation, loss of profits, data, use, goodwill, or other intangible losses, resulting from (i) your access to or use of or inability to access or use the website; (ii) any conduct or content of any third party on the website; (iii) any content obtained from the website; and (iv) unauthorized access, use or alteration of your transmissions or content, whether based on warranty, contract, tort (including negligence) or any other legal theory, whether or not we have been informed of the possibility of such damage, and even if a remedy set forth herein is found to have failed of its essential purpose.</p>\n\n<h2>Indemnification</h2>\n\n<p>You agree to indemnify and hold Most Advanced Booking System For Your Dome, its directors, employees, partners, agents, suppliers, and affiliates, harmless from any claim or demand, including reasonable attorneys&rsquo; fees, made by any third-party due to or arising out of your breach of these Terms &amp; Conditions or your violation of any law or the rights of a third-party.</p>\n\n<h2>Governing Law</h2>\n\n<p>These Terms &amp; Conditions shall be governed and construed in accordance with the laws of the state of California, without regard to its conflict of law provisions.</p>\n\n<h2>Contacting Us</h2>\n\n<p>If you have any questions or comments about these Terms &amp; Conditions or our practices, please contact us at info@mostadvancedbooking.com.</p>\n\n<h2>Effective DateThese Terms &amp; Conditions are of January 1, 2022.</h2>', '2023-03-10 04:36:27', '2023-03-10 04:38:11'),
(2, 1, '<h1>Privacy Policy</h1>\n\n<p>We at Most Advanced Booking System For Your Dome take your privacy seriously. This Privacy Policy outlines our practices for collecting, using, maintaining, protecting, and disclosing your information when you use our website.</p>\n\n<p>Please read this Privacy Policy carefully to understand our policies and practices regarding your information and how we will treat it. By accessing or using our website, you agree to this Privacy Policy. This Privacy Policy may change from time to time. Your continued use of our website after we make changes is deemed to be acceptance of those changes, so please check this Privacy Policy periodically for updates.</p>\n\n<h2>Information We Collect</h2>\n\n<p>We may collect personal information from you, such as your name, email address, and phone number, when you use our website. We may also collect non-personal information, such as your IP address and browser type, when you use our website.</p>\n\n<h2>How We Use Your Information</h2>\n\n<p>We may use your personal information to contact you, respond to your inquiries, and provide you with information about our services. We may also use your non-personal information to improve our website and customize your user experience.</p>\n\n<h2>How We Protect Your Information</h2>\n\n<p>We take reasonable measures to protect your information from unauthorized access, use, or disclosure. However, no method of transmission over the Internet or electronic storage is completely secure, so we cannot guarantee absolute security.</p>\n\n<h2>Disclosure of Your Information</h2>\n\n<p>We may disclose your information to third-party service providers who assist us in operating our website or providing our services. We may also disclose your information required by or we that disclosure is necessary to protect our rights, your safety, or the safety of others.</p>\n\n<h2>Links to Other Websites</h2>\n\n<p>Our website may contain links to other websites that are not owned or operated by us. We are not responsible for the privacy practices or content of these websites. We encourage you to read the privacy policies of these websites.</p>\n\n<h2>Contacting Us</h2>\n\n<p>If you have any questions or comments about this Privacy Policy or our practices, please contact us at info@mostadvancedbooking.com.</p>\n\n<h2>Effective Date</h2>\n\n<p>This Privacy Policy is effective as of January 1, 2022.</p>', '2023-03-10 04:37:12', '2023-03-10 04:37:59');

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
(35, 2, '6,7,10', 'Domez', 58.00, 5.00, 'Costen Tax Solutions, Inc, Birdneck Road North, Virginia Beach, VA, USA', '23451', 'Summerside', 'Prince Edward Island', 'Canada', '6:00 AM', '7:00 PM', 'DESCRIPTION', '28.5156729', '-81.4824233', 'Free Wifi|Changing Room|Parking|Pool', 'benefits-DESCRIPTION', 2, '2023-02-20 03:57:09', '2023-02-21 05:03:45');

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
(8, 7, NULL, 16, '2023-02-22 00:38:11', '2023-02-22 00:38:11'),
(9, 7, NULL, 21, '2023-02-22 00:38:11', '2023-02-22 00:38:11'),
(10, 7, NULL, 1, '2023-02-22 00:38:11', '2023-02-22 00:38:11'),
(25, 7, 35, NULL, '2023-02-23 01:05:07', '2023-02-23 01:05:07'),
(82, 7, NULL, 6, '2023-03-01 02:41:00', '2023-03-01 02:41:00'),
(83, 7, NULL, 11, '2023-03-01 02:41:00', '2023-03-01 02:41:00');

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
(2, 2, 35, '6', '2', 452.00, 5, 30, 'field-1135.jpg', 1, 2, '2023-02-20 05:57:52', '2023-02-20 05:57:52'),
(8, 2, 35, '6', '3', 452.00, 5, 30, 'field-1135.jpg', 1, 2, '2023-02-20 05:57:52', '2023-02-20 05:57:52'),
(14, 2, 35, '6', '4', 452.00, 5, 30, 'field-1135.jpg', 1, 2, '2023-02-20 05:57:52', '2023-02-20 05:57:52'),
(20, 2, 35, '6', '5', 452.00, 5, 30, 'field-1135.jpg', 1, 2, '2023-02-20 05:57:52', '2023-02-20 05:57:52');

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

INSERT INTO `leagues` (`id`, `vendor_id`, `dome_id`, `field_id`, `sport_id`, `name`, `start_date`, `end_date`, `start_time`, `end_time`, `from_age`, `to_age`, `gender`, `min_player`, `max_player`, `team_limit`, `price`, `is_deleted`, `created_at`, `updated_at`) VALUES
(1, 2, 35, '2,8', 7, 'Regular Old Football League', '2023-03-10', '2023-04-10', '09:00 AM', '05:00 PM', 16, 28, 1, 12, 17, 13, 1489, 2, '2023-02-20 06:56:50', '2023-02-20 06:56:50'),
(6, 2, 35, '2,14', 6, 'Regular Old Football League', '2023-03-10', '2023-04-10', '09:00 AM', '05:00 PM', 16, 28, 1, 12, 17, 13, 1489, 2, '2023-02-20 06:56:50', '2023-02-20 06:56:50'),
(11, 2, 35, '2', 8, 'Regular Old Football League', '2023-03-10', '2023-04-10', '09:00 AM', '05:00 PM', 16, 28, 1, 12, 17, 13, 1489, 2, '2023-02-20 06:56:50', '2023-02-20 06:56:50'),
(16, 2, 35, '2,20', 9, 'Regular Old Football League', '2023-03-10', '2023-04-10', '09:00 AM', '05:00 PM', 16, 28, 1, 12, 17, 13, 1489, 2, '2023-02-20 06:56:50', '2023-02-20 06:56:50'),
(21, 2, 35, '2', 10, 'Ipsum League', '2023-03-14', '2023-03-31', '01:00 AM', '04:00 AM', 14, 18, 2, 3, 6, 6, 120, 2, '2023-03-05 07:08:44', '2023-03-14 04:37:02');

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
(30, 2, 35, 7, 4, 'Very Good Experience', NULL, NULL, '2023-03-02 03:31:58', '2023-03-02 03:31:58');

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
(16, 2, 35, 7, '2023-04-01', '2023-04-29', 2, 0, '2023-03-12 05:30:16', '2023-03-12 05:30:16'),
(17, 2, 35, 10, NULL, NULL, 1, 120, '2023-03-12 05:30:16', '2023-03-12 05:30:16');

-- --------------------------------------------------------

--
-- Table structure for table `set_prices_days_slots`
--

CREATE TABLE `set_prices_days_slots` (
  `id` int(11) NOT NULL,
  `set_prices_id` int(11) NOT NULL,
  `start_time` varchar(255) NOT NULL,
  `end_time` varchar(255) NOT NULL,
  `day` varchar(255) NOT NULL,
  `price` double NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `set_prices_days_slots`
--

INSERT INTO `set_prices_days_slots` (`id`, `set_prices_id`, `start_time`, `end_time`, `day`, `price`, `created_at`, `updated_at`) VALUES
(31, 5, '01:00 AM', '03:00 AM', 'monday', 120, '2023-03-12 05:30:16', '2023-03-12 05:30:16'),
(32, 5, '03:00 AM', '06:00 AM', 'monday', 150, '2023-03-12 05:30:16', '2023-03-12 05:30:16'),
(33, 5, '07:00 AM', '12:00 PM', 'monday', 170, '2023-03-12 05:30:16', '2023-03-12 05:30:16'),
(34, 5, '04:00 PM', '11:00 PM', 'monday', 190, '2023-03-12 05:30:16', '2023-03-12 05:30:16'),
(35, 5, '06:00 AM', '11:00 AM', 'tuesday', 50, '2023-03-12 05:30:16', '2023-03-12 05:30:16'),
(36, 5, '01:00 PM', '07:00 AM', 'tuesday', 40, '2023-03-12 05:30:16', '2023-03-12 05:30:16'),
(37, 5, '10:00 AM', '12:00 PM', 'wednesday', 120, '2023-03-12 05:30:16', '2023-03-12 05:30:16'),
(38, 5, '01:00 PM', '02:00 PM', 'thursday', 80, '2023-03-12 05:30:16', '2023-03-12 05:30:16'),
(39, 5, '05:00 PM', '11:00 PM', 'thursday', 100, '2023-03-12 05:30:16', '2023-03-12 05:30:16'),
(40, 5, '07:00 PM', '09:00 PM', 'friday', 50, '2023-03-12 05:30:16', '2023-03-12 05:30:16'),
(41, 5, '01:00 AM', '06:00 AM', 'saturday', 120, '2023-03-12 05:30:16', '2023-03-12 05:30:16'),
(42, 5, '03:00 PM', '09:00 PM', 'saturday', 200, '2023-03-12 05:30:16', '2023-03-12 05:30:16'),
(43, 5, '06:00 PM', '10:00 PM', 'sunday', 1100, '2023-03-12 05:30:16', '2023-03-12 05:30:16'),
(44, 15, '01:00 AM', '03:00 AM', 'monday', 120, '2023-03-12 05:30:16', '2023-03-12 05:30:16'),
(45, 15, '03:00 AM', '06:00 AM', 'monday', 150, '2023-03-12 05:30:16', '2023-03-12 05:30:16'),
(46, 15, '07:00 AM', '12:00 PM', 'monday', 170, '2023-03-12 05:30:16', '2023-03-12 05:30:16'),
(47, 15, '04:00 PM', '11:00 PM', 'monday', 190, '2023-03-12 05:30:16', '2023-03-12 05:30:16'),
(48, 15, '06:00 AM', '11:00 AM', 'tuesday', 50, '2023-03-12 05:30:16', '2023-03-12 05:30:16'),
(49, 15, '01:00 PM', '07:00 AM', 'tuesday', 40, '2023-03-12 05:30:16', '2023-03-12 05:30:16'),
(50, 15, '10:00 AM', '12:00 PM', 'wednesday', 120, '2023-03-12 05:30:16', '2023-03-12 05:30:16'),
(51, 15, '01:00 PM', '02:00 PM', 'thursday', 80, '2023-03-12 05:30:16', '2023-03-12 05:30:16'),
(52, 15, '05:00 PM', '11:00 PM', 'thursday', 100, '2023-03-12 05:30:16', '2023-03-12 05:30:16'),
(53, 15, '07:00 PM', '09:00 PM', 'friday', 50, '2023-03-12 05:30:16', '2023-03-12 05:30:16'),
(54, 15, '01:00 AM', '06:00 AM', 'saturday', 120, '2023-03-12 05:30:16', '2023-03-12 05:30:16'),
(55, 15, '03:00 PM', '09:00 PM', 'saturday', 200, '2023-03-12 05:30:16', '2023-03-12 05:30:16'),
(56, 15, '06:00 PM', '10:00 PM', 'sunday', 1100, '2023-03-12 05:30:16', '2023-03-12 05:30:16'),
(57, 16, '01:00 AM', '03:00 AM', 'monday', 120, '2023-03-12 05:30:16', '2023-03-12 05:30:16'),
(58, 16, '03:00 AM', '06:00 AM', 'monday', 150, '2023-03-12 05:30:16', '2023-03-12 05:30:16'),
(59, 16, '07:00 AM', '12:00 PM', 'monday', 170, '2023-03-12 05:30:16', '2023-03-12 05:30:16'),
(60, 16, '04:00 PM', '11:00 PM', 'monday', 190, '2023-03-12 05:30:16', '2023-03-12 05:30:16'),
(61, 16, '06:00 AM', '11:00 AM', 'tuesday', 50, '2023-03-12 05:30:16', '2023-03-12 05:30:16'),
(62, 16, '01:00 PM', '07:00 AM', 'tuesday', 40, '2023-03-12 05:30:16', '2023-03-12 05:30:16'),
(63, 16, '10:00 AM', '12:00 PM', 'wednesday', 120, '2023-03-12 05:30:16', '2023-03-12 05:30:16'),
(64, 16, '01:00 PM', '02:00 PM', 'thursday', 80, '2023-03-12 05:30:16', '2023-03-12 05:30:16'),
(65, 16, '05:00 PM', '11:00 PM', 'thursday', 100, '2023-03-12 05:30:16', '2023-03-12 05:30:16'),
(66, 16, '07:00 PM', '09:00 PM', 'friday', 50, '2023-03-12 05:30:16', '2023-03-12 05:30:16'),
(67, 16, '01:00 AM', '06:00 AM', 'saturday', 120, '2023-03-12 05:30:16', '2023-03-12 05:30:16'),
(68, 16, '03:00 PM', '09:00 PM', 'saturday', 200, '2023-03-12 05:30:16', '2023-03-12 05:30:16'),
(69, 16, '06:00 PM', '10:00 PM', 'sunday', 1100, '2023-03-12 05:30:16', '2023-03-12 05:30:16');

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
  `type` tinyint(1) NOT NULL COMMENT '1=incoming, 2=Outgoing(refund)',
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

INSERT INTO `transactions` (`id`, `type`, `vendor_id`, `dome_id`, `league_id`, `field_id`, `user_id`, `booking_id`, `contributor_name`, `payment_method`, `transaction_id`, `amount`, `created_at`, `updated_at`) VALUES
(1, 0, 2, 35, NULL, '8', 7, 'b98541', NULL, 1, '1c2132121c1132ee1ee21e2e1edw', 1000.00, '2023-03-15 05:20:57', '2023-03-15 05:20:57'),
(2, 0, 2, 35, NULL, '8', 7, 'f8da0d', NULL, 1, '1c2132121c1132ee1ee21e2e1edw', 1000.00, '2023-03-15 05:27:20', '2023-03-15 05:27:20'),
(3, 0, 2, 35, NULL, '8', 7, 'c3200a', NULL, 1, '1c2132121c1132ee1ee21e2e1edw', 1000.00, '2023-03-15 05:28:00', '2023-03-15 05:28:00'),
(4, 0, 2, 35, NULL, '8', 7, '42db01', NULL, 1, '1c2132121c1132ee1ee21e2e1edw', 1000.00, '2023-03-15 05:28:18', '2023-03-15 05:28:18');

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
(7, 3, 1, 'Soham', 'domez@gmail.com', 'CA', '6359478772', '$2y$10$gtan0ZH/DCiZmnR2yLGiyeZAR0YeEu9krVXGHQfXBqk63ep0WQEEm', NULL, NULL, NULL, NULL, NULL, 'default.png', 1, 1, 2, '2023-02-19 02:22:29', '2023-02-19 05:28:51');

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT for table `cms`
--
ALTER TABLE `cms`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `domes`
--
ALTER TABLE `domes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `dome_images`
--
ALTER TABLE `dome_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `enquiries`
--
ALTER TABLE `enquiries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

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
-- AUTO_INCREMENT for table `set_prices`
--
ALTER TABLE `set_prices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `set_prices_days_slots`
--
ALTER TABLE `set_prices_days_slots`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT for table `sports`
--
ALTER TABLE `sports`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
