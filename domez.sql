-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 28, 2023 at 12:06 PM
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
  `start_time` text NOT NULL,
  `end_time` text NOT NULL,
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
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `type`, `vendor_id`, `dome_id`, `league_id`, `user_id`, `sport_id`, `field_id`, `booking_id`, `slots`, `start_date`, `end_date`, `start_time`, `end_time`, `sub_total`, `service_fee`, `hst`, `total_amount`, `paid_amount`, `due_amount`, `payment_mode`, `payment_type`, `payment_status`, `booking_status`, `token`, `players`, `customer_name`, `customer_email`, `customer_mobile`, `team_name`, `created_at`, `updated_at`) VALUES
(22, 1, 2, 35, NULL, 7, 6, '2', '554611', '06:30 AM - 07:30 AM', '2023-03-24', NULL, '8:00 AM', '11:35 AM', 0, 0, 0, 87.00, 23.00, 26.00, 1, 2, 2, 3, NULL, 17, 'Prof. Geovany Kuhn', 'arno.mayert@example.com', '+14809074204', 'Lorem Ipsum League', '2023-03-23 04:30:00', '2023-03-24 08:54:00'),
(63, 1, 2, 35, NULL, 7, 10, '20,2', '565454', '02:00 AM - 03:00 AM,03:00 AM - 04:00 AM,04:00 AM - 05:00 AM', '2023-03-16', NULL, '08:00 PM', '09:00 PM', 0, 0, 0, 87.00, 23.00, 26.00, 1, 2, 1, 1, NULL, 17, 'james Carter', 'james123@example.com', '+14809074204', 'Lorem Ipsum League', '2023-02-16 04:57:41', '2023-03-24 08:54:00'),
(68, 1, 2, 35, NULL, 7, 8, '12,13', '325689', '02:00 AM - 03:00 AM,03:00 AM - 04:00 AM', '2023-03-09', NULL, '08:00 PM', '09:00 PM', 0, 0, 0, 180.00, 23.00, 26.00, 1, 2, 1, 1, NULL, 17, 'james Carter', 'james123@example.com', '+14809074204', 'Lorem Ipsum League', '2023-02-16 04:57:41', '2023-03-24 08:54:00'),
(69, 1, 2, 35, NULL, 7, 8, '11', '457856', '03:00 AM - 04:00 AM', '2023-03-30', NULL, '03:00 AM', '04:00 AM', 0, 0, 0, 250.00, 23.00, 26.00, 1, 2, 1, 1, NULL, 17, 'james Carter', 'james123@example.com', '+14809074204', 'Lorem Ipsum League', '2023-02-16 04:57:41', '2023-03-24 08:54:00'),
(70, 1, 2, 35, NULL, 7, 9, '5', '458923', '03:00 AM - 04:00 AM,04:00 AM - 05:00 AM', '2023-04-20', NULL, '03:00 AM', '05:00 AM', 0, 0, 0, 87.00, 23.00, 26.00, 1, 2, 1, 1, NULL, 17, 'james Carter', 'james123@example.com', '+14809074204', 'Lorem Ipsum League', '2023-02-25 04:57:41', '2023-03-24 08:54:00'),
(71, 2, 2, 35, 11, 7, 7, '3', '458978', '03:00 AM - 04:00 AM,04:00 AM - 05:00 AM', '2023-03-21', NULL, '03:00 AM', '05:00 AM', 0, 0, 0, 87.00, 23.00, 26.00, 1, 2, 1, 1, NULL, 17, 'Lorem Ipsum', 'loremipsum@example.com', '+14809074204', 'Lorem Ipsum League', '2023-02-25 04:57:41', '2023-03-24 08:54:00'),
(72, 1, 2, 35, NULL, 7, 9, '4', '458923', '03:00 AM - 04:00 AM,04:00 AM - 05:00 AM', '2023-03-06', NULL, '03:00 AM', '05:00 AM', 0, 0, 0, 87.00, 23.00, 26.00, 1, 2, 1, 1, NULL, 17, 'james Carter', 'james123@example.com', '+14809074204', 'Lorem Ipsum League', '2023-02-25 04:57:41', '2023-03-24 08:54:00'),
(73, 1, 2, 35, NULL, 7, 9, '6', '458923', '03:00 AM - 04:00 AM,04:00 AM - 05:00 AM', '2023-03-07', NULL, '03:00 AM', '05:00 AM', 0, 0, 0, 87.00, 23.00, 26.00, 1, 2, 1, 1, NULL, 17, 'james Carter', 'james123@example.com', '+14809074204', 'Lorem Ipsum League', '2023-02-25 04:57:41', '2023-03-24 08:54:00'),
(74, 1, 2, 35, NULL, 7, 7, '3', '458978', '03:00 AM - 04:00 AM,04:00 AM - 05:00 AM', '2023-03-22', NULL, '03:00 AM', '05:00 AM', 0, 0, 0, 87.00, 23.00, 26.00, 1, 2, 1, 1, NULL, 17, 'Lorem Ipsum', 'loremipsum@example.com', '+14809074204', 'Lorem Ipsum League', '2023-02-25 04:57:41', '2023-03-24 08:54:00'),
(75, 1, 2, 35, NULL, 7, 6, '30', 'feb086', '06:00 AM - 07:00 AM', '2023-03-28', NULL, '06:00 AM', '07:00 AM', 0, 0, 0, 880.00, 90.00, 790.00, 1, 2, 2, 3, '2y10AJCTI10ZEfbzvBqVVuRAepCbXKs2i4PegQuVtQaht7IwSNstsWG', 12, 'Soham', 'domez@gmail.com', '6359478772', 'Lorem Ipsum League', '2023-03-16 23:05:13', '2023-03-24 08:54:00'),
(76, 1, 2, 35, NULL, 7, 6, '30', '34b86f', '03:00 PM - 04:00 PM', '2023-03-01', NULL, '03:00 PM', '04:00 PM', 0, 0, 0, 880.00, 90.00, 790.00, 1, 2, 2, 3, '2y10wTO0zKtivVjQnUHaSZsO3yBMqREEWrAbvj7HQUojipynJD0y7W', 12, 'Soham', 'domez@gmail.com', '6359478772', 'Lorem Ipsum League', '2023-03-16 23:09:25', '2023-03-24 08:54:00'),
(77, 1, 2, 35, NULL, 7, 6, '31', '2a248b', '06:00 AM - 07:00 AM', '2023-03-31', NULL, '06:00 AM', '07:00 AM', 0, 0, 0, 2640.00, 220.00, 2420.00, 1, 2, 2, 3, '2y10FyAjLVLx4YhsVQzePNGctuGVjobiCj72PsFRgdKT3YqxMfopL0Ra', 12, 'Soham', 'domez@gmail.com', '6359478772', 'Lorem Ipsum League', '2023-03-17 00:02:37', '2023-03-24 08:54:00'),
(78, 1, 2, 35, NULL, 7, 6, '30', '6420c7', '10:00 AM - 11:00 AM', '2023-03-12', NULL, '10:00 AM', '11:00 AM', 0, 0, 0, 880.00, 110.00, 770.00, 1, 2, 2, 3, '2y10btNPJ2idHcjrfEOGY16n5OKEkRGNIUoLHgXO50zjQ9jBFu2bnm', 12, 'Soham', 'domez@gmail.com', '6359478772', 'Lorem Ipsum League', '2023-03-17 00:05:38', '2023-03-24 08:54:00'),
(79, 1, 2, 35, NULL, 7, 6, '33', 'bc3167', '07:00 AM - 08:00 AM', '2023-03-08', NULL, '07:00 AM', '08:00 AM', 0, 0, 0, 880.00, 80.00, 800.00, 1, 2, 2, 3, '2y10IZ3pc3IVKlrmpvjF6rqfePRKePgG4v31mBesjram1rpyUXD4y5m', 12, 'Soham', 'domez@gmail.com', '6359478772', 'Lorem Ipsum League', '2023-03-17 07:00:54', '2023-03-24 08:54:00'),
(80, 1, 2, 35, NULL, 7, 6, '30', '71299e', '06:00 AM - 07:00 AM,05:00 PM - 06:00 PM', '2023-04-27', NULL, '05:00 PM', '06:00 PM', 0, 0, 0, 1760.00, 147.00, 1613.00, 1, 2, 2, 3, '2y1071VD3QNZ5NdyupeW4PQ6oeTzAQTRstmq5e7wfujvseV8diaYqJ3C', 12, 'Soham', 'domez@gmail.com', '6359478772', 'Lorem Ipsum League', '2023-03-17 08:01:33', '2023-03-24 08:54:00'),
(81, 1, 2, 35, NULL, 7, 6, '30', 'd728dc', '05:00 PM - 06:00 PM', '2023-03-21', NULL, '04:00 PM', '05:00 PM', 0, 0, 0, 880.00, 80.00, 800.00, 1, 2, 2, 3, '2y10Sn6kV40myt3Mztn7nFW7ux4FDRXYAqgQDr1QA3V7CNiVGXfoK', 12, 'Soham', 'domez@gmail.com', '6359478772', 'Lorem Ipsum League', '2023-03-21 05:08:07', '2023-03-24 08:54:00'),
(82, 1, 2, 35, NULL, 7, 6, '30', '13e3f3', '09:00 AM - 10:00 AM,06:00 AM - 07:00 AM', '2023-03-21', NULL, '06:00 AM', '08:03 PM', 0, 0, 0, 1760.00, 150.00, 1610.00, 1, 2, 2, 3, '2y10e7iF5tY9OKaqOrJOYFoc7wo1coyPzU9gVGNLXOiLAusWXmBiE', 12, 'Soham', 'domez@gmail.com', '6359478772', 'Lorem Ipsum League', '2023-03-21 05:42:44', '2023-03-24 08:54:00'),
(83, 1, 2, 35, NULL, 7, 6, '30', '27b51d', '06:00 PM - 07:00 PM,06:00 AM - 07:00 AM', '2023-03-22', NULL, '06:00 AM', '07:00 AM', 0, 0, 0, 880.00, 73.35, 806.65, 1, 2, 2, 3, '2y106RRpSanIckeXhPVsJA6tuRyeLv5Z4gVytBWhiSaVQKzfm7S', 12, 'Soham', 'domez@gmail.com', '6359478772', 'Lorem Ipsum League', '2023-03-21 06:22:42', '2023-03-24 08:54:00'),
(84, 1, 2, 35, NULL, 7, 6, '31', '7c9636', '10:00 AM - 11:00 AM', '2023-03-22', NULL, '10:00 AM', '11:00 AM', 0, 0, 0, 880.00, 80.00, 800.00, 1, 2, 2, 3, '2y104tPHhfXtAvbCZDUegyyMYuXS3mSUDWxMsgTXZk6sZYtbNKp8srRq', 12, 'Soham', 'domez@gmail.com', '6359478772', 'Lorem Ipsum League', '2023-03-21 11:56:09', '2023-03-24 08:54:00'),
(85, 1, 2, 35, NULL, 7, 6, '30', '0756ad', '07:00 AM - 08:00 AM', '2023-03-21', NULL, '07:00 AM', '07:15 PM', 0, 0, 0, 880.00, 875.00, 5.00, 1, 2, 2, 3, '2y10r21zOHumVKlVjkn02DBeCObJFvVfhON5ywVcIKzF2KyJcblKA9k8', 12, 'Soham', 'domez@gmail.com', '6359478772', 'Lorem Ipsum League', '2023-03-21 11:59:51', '2023-03-24 08:54:00'),
(86, 1, 2, 35, NULL, 7, 6, '32', '7c975a', '01:00 PM - 02:00 PM', '2023-03-22', NULL, '01:00 PM', '02:00 PM', 0, 0, 0, 880.00, 104.55, 0.00, 1, 2, 2, 3, '2y10GmKhpL2PCKVNdeVx7gcE2OYg6bcIFRjjX2ROwVI40Bx3h98smdXm', 12, 'Soham', 'domez@gmail.com', '6359478772', 'Lorem Ipsum League', '2023-03-21 07:36:51', '2023-03-24 08:54:00'),
(87, 1, 2, 35, NULL, 7, 7, '36,37', '312a52', '11:00 AM - 12:00 PM,12:00 PM - 01:00 PM', '2023-03-24', NULL, '11:00 AM', '01:00 PM', 0, 0, 0, 3520.00, 0.00, 0.00, 1, 1, 1, 1, NULL, 21, 'Soham', 'domez@gmail.com', '6359478772', '', '2023-03-23 23:44:11', '2023-03-23 23:44:11'),
(88, 1, 2, 35, NULL, 7, 6, '30', 'eda29f', '06:00 AM - 07:00 AM,07:00 AM - 08:00 AM,08:00 AM - 09:00 AM', '2023-03-25', NULL, '07:00 AM', '09:00 AM', 0, 0, 0, 2640.00, 155.29, 2484.71, 1, 2, 2, 3, '2y10Hcmevo7Cpe2kgJoJktACJOP2vY2kFaEQPuxdZS9k8MtnxuMdnMzma', 17, 'Soham', 'domez@gmail.com', '6359478772', '', '2023-03-24 03:52:05', '2023-03-27 04:23:01'),
(89, 2, 2, 35, 11, 7, 6, '2,8', '97305d', NULL, '2023-03-16', '2023-04-10', '09:00 AM', '05:00 PM', 0, 0, 0, 2640.00, 0.00, 0.00, 1, 1, 1, 1, NULL, 17, 'Soham', 'domez@gmail.com', '6359478772', 'fd', '2023-03-24 03:53:23', '2023-03-24 03:53:23'),
(90, 1, 2, 35, NULL, 7, 10, '2', '0f7fc8', '04:00 PM - 05:00 PM', '2023-03-24', NULL, '04:00 PM', '05:00 PM', 0, 0, 0, 132.00, 132.00, 0.00, 1, 2, 2, 3, '2y10JGDTKpMJyqtdDoGRyhu7OuG2oblDXsvpDATme6K2f1efQwGZ46q', 12, 'Soham', 'domez@gmail.com', '6359478772', '', '2023-03-24 04:27:37', '2023-03-24 10:31:00'),
(91, 1, 2, 35, NULL, 7, 6, '30', '852d8a', '06:00 PM - 07:00 PM', '2023-03-24', NULL, '06:00 PM', '07:00 PM', 0, 0, 0, 880.00, 80.00, 800.00, 1, 2, 2, 3, '2y10nqjPenB11cj2ContQd4UuOhfOQU6ngaND8h8zTWcvkHT8MoAhioS', 12, 'Soham', 'domez@gmail.com', '6359478772', '', '2023-03-24 04:36:57', '2023-03-24 12:31:00'),
(92, 1, 2, 35, NULL, 7, 10, '2', '78c912', '06:00 PM - 07:00 PM,05:00 PM - 06:00 PM,06:00 PM - 07:00 PM', '2023-03-24', NULL, '05:00 PM', '07:00 PM', 0, 0, 0, 264.00, 0.00, 0.00, 1, 1, 1, 1, NULL, 12, 'Soham', 'domez@gmail.com', '6359478772', '', '2023-03-24 04:48:11', '2023-03-24 04:48:11'),
(93, 2, 2, 35, 16, 7, 6, '8,11', 'b64ef1', NULL, '2023-03-16', '2023-04-10', '09:00 AM', '05:00 PM', 0, 0, 0, 1637.90, 0.00, 0.00, 1, 1, 1, 1, NULL, 6, 'Soham', 'domez@gmail.com', '6359478772', 'Ty', '2023-03-24 05:08:25', '2023-03-24 05:08:25'),
(94, 2, 2, 35, 16, 7, 6, '8,11', 'ff954a', NULL, '2023-03-16', '2023-04-10', '09:00 AM', '05:00 PM', 0, 0, 0, 1637.90, 0.00, 0.00, 1, 1, 1, 1, NULL, 99, 'Soham', 'domez@gmail.com', '6359478772', 'Ty', '2023-03-24 05:10:25', '2023-03-24 05:10:25'),
(95, 1, 2, 35, NULL, 7, 6, '30,31', '0a1dd7', '05:00 AM - 06:00 AM', '2023-04-07', NULL, '05:00 AM', '06:00 AM', 0, 0, 0, 110.00, 8.46, 101.54, 1, 2, 2, 3, '2y10YfFTHGExP3WfX2X2JPJ3cngiQd1yAi1bPdiOU53k4oHk7I0C', 13, 'Soham', 'domez@gmail.com', '6359478772', '', '2023-03-26 23:13:51', '2023-03-28 01:11:01'),
(96, 1, 2, 35, NULL, 7, 6, '30', '704fae', '02:00 PM - 03:00 PM', '2023-03-27', NULL, '02:00 PM', '03:00 PM', 0, 0, 0, 880.00, 0.00, 0.00, 1, 1, 1, 1, NULL, 12, 'Soham', 'domez@gmail.com', '6359478772', '', '2023-03-27 05:08:41', '2023-03-27 05:08:41'),
(97, 1, 2, 35, NULL, 7, 6, '31', '76c8b6', '12:00 PM - 01:00 PM', '2023-03-27', NULL, '12:00 PM', '01:00 PM', 0, 0, 0, 880.00, 73.33, 806.67, 1, 2, 2, 3, '2y10Gn37U4FUFTqZqA1eyBuHlTqsVLI5CUZAv4W3tpH5nXym9vAER5G', 12, 'Soham', 'domez@gmail.com', '6359478772', '', '2023-03-26 23:45:52', '2023-03-28 04:33:49'),
(98, 1, 2, 35, NULL, 7, 6, '32', '0c23ae', '04:00 PM - 05:00 PM', '2023-03-27', NULL, '04:00 PM', '05:00 PM', 0, 0, 0, 880.00, 73.33, 0.00, 1, 2, 1, 1, '2y10lHIfsOVhtTf0sx7w7GSdUuuf2jp8oehqyBgokCQIMX1mCaBbwVzsS', 12, 'Soham', 'domez@gmail.com', '6359478772', '', '2023-03-27 04:10:42', '2023-03-27 04:10:42'),
(99, 1, 2, 35, NULL, 7, 6, '33', '5224da', '05:00 PM - 06:00 PM', '2023-03-27', NULL, '05:00 PM', '06:00 PM', 0, 0, 0, 880.00, 67.69, 0.00, 1, 2, 1, 1, '2y108vQ8r7CrfzmdInIWGfVXweaHcrRbIPahpV8e7AQy54DLOq7vrS4nq', 13, 'Soham', 'domez@gmail.com', '6359478772', '', '2023-03-27 04:35:42', '2023-03-27 04:35:42'),
(100, 1, 2, 35, NULL, 7, 6, '35', '0e6a68', '06:00 PM - 07:00 PM', '2023-03-27', NULL, '06:00 PM', '07:00 PM', 0, 0, 0, 880.00, 73.33, 0.00, 1, 2, 1, 1, '2y103T4tSq7XOvTaxgBLGGYMK6jKmoWiuneaDBWz4sEo7HNqch7e', 12, 'Soham', 'domez@gmail.com', '6359478772', '', '2023-03-27 04:41:53', '2023-03-27 04:41:53'),
(101, 1, 2, 35, NULL, 7, 6, '30', '8f0247', '06:00 AM - 07:00 AM', '2023-03-29', NULL, '06:00 AM', '07:00 AM', 800, 40, 40, 880.00, 333.00, 547.00, 1, 2, 2, 2, '2y10qsQgPTBt9dHDlasmqLIDOkDYlEXSiwQHPZJmvraJVC8EBS0eukC', 12, 'Soham', 'domez@gmail.com', '6359478772', '', '2023-03-27 04:52:28', '2023-03-28 01:11:01'),
(102, 1, 2, 35, NULL, 7, 6, '30', '2af076', '06:00 AM - 07:00 AM', '2023-03-31', NULL, '06:00 AM', '07:00 AM', 800, 40, 40, 880.00, 73.33, 806.67, 1, 2, 2, 3, '2y10e20kCmEZNLR9JHvyzu4KuTKvuDLfNpbVBa98ASYhrk8gfftrJjJq', 12, 'Soham', 'domez@gmail.com', '6359478772', '', '2023-03-27 04:58:15', '2023-03-28 01:11:01'),
(103, 1, 2, 35, NULL, 7, 7, '37', '61de2e', '04:00 PM - 05:00 PM,04:00 PM - 05:00 PM', '2023-03-27', NULL, '04:00 PM', '05:00 PM', 800, 40, 40, 880.00, 0.00, 0.00, 1, 1, 1, 1, NULL, 12, 'Soham', 'domez@gmail.com', '6359478772', '', '2023-03-27 04:59:33', '2023-03-27 04:59:33'),
(104, 1, 2, 35, NULL, 7, 10, '2', '19f0a4', '05:00 PM - 06:00 PM', '2023-03-27', NULL, '05:00 PM', '06:00 PM', 120, 6, 6, 132.00, 0.00, 0.00, 1, 1, 1, 1, NULL, 12, 'Soham', 'domez@gmail.com', '6359478772', '', '2023-03-27 05:02:11', '2023-03-27 05:02:11'),
(105, 1, 2, 35, NULL, 7, 6, '30', 'fb7764', '12:00 PM - 01:00 PM', '2023-03-28', NULL, '12:00 PM', '01:00 PM', 800, 40, 40, 880.00, 80.00, 800.00, 1, 2, 2, 2, '2y10D26Y6q5SP5VlQiMaDBCtzOXn0nEuu0RGSiEubhMO3Nv9tdb36hIXi', 12, 'Soham', 'domez@gmail.com', '6359478772', '', '2023-03-28 00:50:28', '2023-03-28 07:02:00'),
(106, 1, 2, 35, NULL, 7, 6, '30', 'b3a5d8', '02:00 PM - 03:00 PM', '2023-03-28', NULL, '02:00 PM', '03:00 PM', 800, 40, 40, 880.00, 73.33, 806.67, 1, 2, 2, 2, '2y10CxpoAUmFFE1CSFIz4euG9e6ZmAJNku4maMSl4R4tDj8YZsD0MgMS', 12, 'Soham', 'domez@gmail.com', '6359478772', '', '2023-03-28 08:28:27', '2023-03-28 08:31:00');

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
(34, NULL, 1, 'dome-63f33f137daf5.png', '2023-02-20 05:06:09', '2023-02-20 05:06:09'),
(35, NULL, 11, 'dome-63f33f137daf5.png', '2023-02-20 05:06:44', '2023-02-20 05:06:44'),
(36, NULL, 16, 'dome-63f33f137daf5.png', '2023-02-20 05:10:13', '2023-02-20 05:10:13'),
(37, NULL, 21, 'dome-63f33f137daf5.png', '2023-03-05 07:08:44', '2023-03-05 07:08:44');

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
(82, 7, NULL, 6, '2023-03-01 02:41:00', '2023-03-01 02:41:00');

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
(2, 2, 35, '10', '2', 452.00, 5, 30, 'field-6712.jpg', 1, 2, '2023-02-20 05:57:52', '2023-03-16 06:04:23'),
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
(1, 2, 35, '2', 6, 'The Golf League', '2023-03-16', '2023-04-10', '09:00 AM', '05:00 PM', 16, 28, 1, 12, 17, 13, 1489, 2, '2023-02-20 06:56:50', '2023-03-16 07:08:09'),
(11, 2, 35, '2,8', 6, 'The Soccer League', '2023-03-16', '2023-04-10', '09:00 AM', '05:00 PM', 16, 28, 1, 12, 17, 13, 1489, 2, '2023-02-20 06:56:50', '2023-03-16 07:03:19'),
(16, 2, 35, '8,11', 6, 'The Volleyball League', '2023-03-16', '2023-04-10', '09:00 AM', '05:00 PM', 16, 28, 1, 12, 17, 13, 1489, 2, '2023-02-20 06:56:50', '2023-03-16 07:02:49');

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
(70, 16, '01:00 AM', '03:00 AM', 'monday', 120, '2023-03-16 21:45:53', '2023-03-16 21:45:53'),
(71, 16, '03:00 AM', '06:00 AM', 'monday', 150, '2023-03-16 21:45:53', '2023-03-16 21:45:53'),
(72, 16, '07:00 AM', '12:00 PM', 'monday', 170, '2023-03-16 21:45:53', '2023-03-16 21:45:53'),
(73, 16, '04:00 PM', '11:00 PM', 'monday', 190, '2023-03-16 21:45:53', '2023-03-16 21:45:53'),
(74, 16, '06:00 AM', '11:00 AM', 'tuesday', 50, '2023-03-16 21:45:53', '2023-03-16 21:45:53'),
(75, 16, '01:00 PM', '07:00 AM', 'tuesday', 40, '2023-03-16 21:45:53', '2023-03-16 21:45:53'),
(76, 16, '04:00 AM', '11:00 PM', 'wednesday', 120, '2023-03-16 21:45:53', '2023-03-16 21:45:53'),
(77, 16, '01:00 PM', '02:00 PM', 'thursday', 80, '2023-03-16 21:45:53', '2023-03-16 21:45:53'),
(78, 16, '05:00 PM', '11:00 PM', 'thursday', 100, '2023-03-16 21:45:53', '2023-03-16 21:45:53'),
(79, 16, '04:00 PM', '11:00 PM', 'friday', 50, '2023-03-16 21:45:53', '2023-03-16 21:45:53'),
(80, 16, '01:00 AM', '06:00 AM', 'saturday', 120, '2023-03-16 21:45:53', '2023-03-16 21:45:53'),
(81, 16, '03:00 PM', '09:00 PM', 'saturday', 200, '2023-03-16 21:45:53', '2023-03-16 21:45:53'),
(82, 16, '09:00 AM', '09:00 PM', 'sunday', 1100, '2023-03-16 21:45:53', '2023-03-16 21:45:53'),
(83, 15, '01:00 AM', '03:00 AM', 'monday', 120, '2023-03-16 21:48:44', '2023-03-16 21:48:44'),
(84, 15, '03:00 AM', '06:00 AM', 'monday', 150, '2023-03-16 21:48:44', '2023-03-16 21:48:44'),
(85, 15, '07:00 AM', '12:00 PM', 'monday', 170, '2023-03-16 21:48:44', '2023-03-16 21:48:44'),
(86, 15, '04:00 PM', '11:00 PM', 'monday', 190, '2023-03-16 21:48:44', '2023-03-16 21:48:44'),
(87, 15, '06:00 AM', '11:00 AM', 'tuesday', 50, '2023-03-16 21:48:44', '2023-03-16 21:48:44'),
(88, 15, '01:00 PM', '07:00 AM', 'tuesday', 40, '2023-03-16 21:48:44', '2023-03-16 21:48:44'),
(89, 15, '10:00 AM', '10:00 PM', 'wednesday', 120, '2023-03-16 21:48:44', '2023-03-16 21:48:44'),
(90, 15, '01:00 PM', '02:00 PM', 'thursday', 80, '2023-03-16 21:48:44', '2023-03-16 21:48:44'),
(91, 15, '05:00 PM', '11:00 PM', 'thursday', 100, '2023-03-16 21:48:44', '2023-03-16 21:48:44'),
(92, 15, '04:00 AM', '09:00 PM', 'friday', 50, '2023-03-16 21:48:44', '2023-03-16 21:48:44'),
(93, 15, '01:00 AM', '06:00 AM', 'saturday', 120, '2023-03-16 21:48:44', '2023-03-16 21:48:44'),
(94, 15, '03:00 PM', '09:00 PM', 'saturday', 200, '2023-03-16 21:48:44', '2023-03-16 21:48:44'),
(95, 15, '03:00 AM', '10:00 PM', 'sunday', 1100, '2023-03-16 21:48:44', '2023-03-16 21:48:44'),
(96, 5, '01:00 AM', '03:00 AM', 'monday', 120, '2023-03-16 21:49:19', '2023-03-16 21:49:19'),
(97, 5, '03:00 AM', '06:00 AM', 'monday', 150, '2023-03-16 21:49:19', '2023-03-16 21:49:19'),
(98, 5, '07:00 AM', '12:00 PM', 'monday', 170, '2023-03-16 21:49:19', '2023-03-16 21:49:19'),
(99, 5, '04:00 PM', '11:00 PM', 'monday', 190, '2023-03-16 21:49:19', '2023-03-16 21:49:19'),
(100, 5, '06:00 AM', '11:00 AM', 'tuesday', 50, '2023-03-16 21:49:19', '2023-03-16 21:49:19'),
(101, 5, '01:00 PM', '07:00 AM', 'tuesday', 40, '2023-03-16 21:49:19', '2023-03-16 21:49:19'),
(102, 5, '10:00 AM', '10:00 PM', 'wednesday', 120, '2023-03-16 21:49:19', '2023-03-16 21:49:19'),
(103, 5, '01:00 PM', '02:00 PM', 'thursday', 80, '2023-03-16 21:49:19', '2023-03-16 21:49:19'),
(104, 5, '05:00 PM', '11:00 PM', 'thursday', 100, '2023-03-16 21:49:19', '2023-03-16 21:49:19'),
(105, 5, '05:00 AM', '09:00 PM', 'friday', 50, '2023-03-16 21:49:19', '2023-03-16 21:49:19'),
(106, 5, '01:00 AM', '06:00 AM', 'saturday', 120, '2023-03-16 21:49:19', '2023-03-16 21:49:19'),
(107, 5, '03:00 PM', '09:00 PM', 'saturday', 200, '2023-03-16 21:49:19', '2023-03-16 21:49:19'),
(108, 5, '02:00 AM', '10:00 PM', 'sunday', 1100, '2023-03-16 21:49:19', '2023-03-16 21:49:19');

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
(50, 1, 2, 35, NULL, 7, 'b3a5d8', NULL, 1, 'pi_3MqXt1FysF0okTxJ1X5KWY7W', 73.33, '2023-03-28 08:28:27', '2023-03-28 08:28:27');

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
(2, 2, 1, NULL, NULL, 'domez', 'domez@yopmail.com', 'CA', '1234657890', '$2y$10$z0eXm5BtjQQP77GHRvJAGOIp1osY2Lx0NvMvmkpTgPzpiTUvnIlri', NULL, NULL, NULL, NULL, NULL, 'default.png', 1, 1, 2, '2023-02-06 00:03:03', '2023-02-22 04:12:48'),
(35, 3, 1, NULL, NULL, 'Mona Vosa', 'mona@gmail.com', 'CA', '8946555414', '$2y$10$gtan0ZH/DCiZmnR2yLGiyeZAR0YeEu9krVXGHQfXBqk63ep0WQEEm', NULL, NULL, NULL, NULL, NULL, 'default.png', 1, 1, 2, '2023-05-19 02:22:29', '2023-05-19 05:28:51'),
(34, 3, 1, NULL, NULL, 'Docote Voho', 'docote@gmail.com', 'CA', '54654154654', '$2y$10$gtan0ZH/DCiZmnR2yLGiyeZAR0YeEu9krVXGHQfXBqk63ep0WQEEm', NULL, NULL, NULL, NULL, NULL, 'default.png', 1, 1, 2, '2023-05-19 02:22:29', '2023-05-19 05:28:51'),
(7, 3, 1, NULL, NULL, 'Soham', 'domez@gmail.com', 'CA', '6359478772', '$2y$10$gtan0ZH/DCiZmnR2yLGiyeZAR0YeEu9krVXGHQfXBqk63ep0WQEEm', NULL, NULL, NULL, NULL, NULL, 'default.png', 1, 1, 2, '2023-02-19 02:22:29', '2023-02-19 05:28:51'),
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
(60, 2, 1, NULL, NULL, 'Just Play Domez', 'justplaydomez@yopmail.com', 'CA', '5854854', '$2y$10$z0eXm5BtjQQP77GHRvJAGOIp1osY2Lx0NvMvmkpTgPzpiTUvnIlri', NULL, NULL, NULL, NULL, NULL, 'default.png', 1, 1, 2, '2023-10-06 00:03:03', '2023-02-22 04:12:48');

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=107;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=136;

--
-- AUTO_INCREMENT for table `fields`
--
ALTER TABLE `fields`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=109;

--
-- AUTO_INCREMENT for table `sports`
--
ALTER TABLE `sports`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
