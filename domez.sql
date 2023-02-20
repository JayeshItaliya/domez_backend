-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 20, 2023 at 05:18 AM
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
  `vendor_id` int(11) NOT NULL,
  `dome_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `sport_id` int(11) NOT NULL,
  `field_id` int(11) NOT NULL,
  `booking_id` int(11) NOT NULL,
  `booking_date` date NOT NULL,
  `customer_name` varchar(255) DEFAULT NULL,
  `customer_email` varchar(255) NOT NULL,
  `customer_mobile` varchar(255) DEFAULT NULL,
  `players` int(11) NOT NULL,
  `slots` text NOT NULL,
  `start_time` text NOT NULL,
  `end_time` text NOT NULL,
  `total_amount` double(8,2) NOT NULL,
  `paid_amount` double(8,2) NOT NULL DEFAULT 0.00,
  `due_amount` double(8,2) NOT NULL DEFAULT 0.00,
  `payment_mode` int(11) NOT NULL COMMENT '1=online,2=offline',
  `payment_type` int(11) NOT NULL COMMENT '1=Full Amount, 2=Split Amount',
  `payment_status` int(11) NOT NULL COMMENT '1=Complete,2=Partial',
  `booking_status` int(11) NOT NULL COMMENT '1=Confirmed, 2=Pending, 3=Cancelled	',
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `vendor_id`, `dome_id`, `user_id`, `sport_id`, `field_id`, `booking_id`, `booking_date`, `customer_name`, `customer_email`, `customer_mobile`, `players`, `slots`, `start_time`, `end_time`, `total_amount`, `paid_amount`, `due_amount`, `payment_mode`, `payment_type`, `payment_status`, `booking_status`, `created_at`, `updated_at`) VALUES
(1, 3, 1, 16, 1, 7, 621524, '2023-02-13', 'Michel Streich', 'blaze.quigley@example.com', '954.785.4257', 18, '', '8:04 PM', '8:07 PM', 53.00, 14.00, 17.00, 2, 1, 1, 1, '2023-02-10 04:42:24', '2023-02-10 04:42:24'),
(2, 6, 1, 6, 1, 7, 579195, '2013-05-24', 'Cornelius Howell', 'eichmann.grant@example.org', '1-346-256-2304', 14, '0', '12:05 AM', '3:24 AM', 17.00, 17.00, 10.00, 2, 1, 1, 1, '2023-02-10 04:42:24', '2023-02-10 04:42:24'),
(3, 4, 3, 11, 5, 2, 347737, '1984-11-13', 'Mr. Alexie O\'Kon', 'elise97@example.com', '+1-501-694-2586', 13, '0', '10:19 AM', '12:02 PM', 67.00, 37.00, 18.00, 1, 2, 2, 2, '2023-02-10 04:42:24', '2023-02-10 04:42:24'),
(4, 4, 2, 7, 5, 1, 213524, '1986-04-18', 'Lenny Jones', 'nschultz@example.com', '(629) 688-4293', 11, '0', '3:50 AM', '4:30 AM', 76.00, 19.00, 25.00, 2, 1, 1, 2, '2023-02-10 04:42:24', '2023-02-10 04:42:24'),
(5, 3, 1, 10, 2, 1, 381097, '2015-08-15', 'Benedict Smith', 'hettinger.jaclyn@example.com', '+1-505-821-5560', 15, '0', '10:56 PM', '9:50 PM', 60.00, 31.00, 21.00, 2, 2, 1, 1, '2023-02-10 04:42:24', '2023-02-10 04:42:24'),
(6, 3, 2, 3, 5, 2, 158792, '2006-06-08', 'Ara O\'Hara III', 'donald08@example.org', '1-878-456-6499', 31, '0', '9:16 PM', '12:56 PM', 23.00, 24.00, 14.00, 2, 1, 1, 1, '2023-02-10 04:42:24', '2023-02-10 04:42:24'),
(7, 6, 4, 8, 1, 2, 282082, '1971-06-24', 'Cecelia Thompson', 'caterina.auer@example.com', '+16828163787', 13, '0', '12:26 AM', '6:19 PM', 71.00, 44.00, 10.00, 1, 2, 2, 2, '2023-02-10 04:42:24', '2023-02-10 04:42:24'),
(8, 2, 1, 12, 4, 3, 156107, '2020-10-17', 'Karianne Senger', 'llubowitz@example.com', '(689) 280-8526', 32, '0', '6:33 AM', '8:59 AM', 84.00, 41.00, 24.00, 1, 2, 1, 2, '2023-02-10 04:42:24', '2023-02-10 04:42:24'),
(9, 5, 1, 12, 1, 1, 453539, '2008-03-25', 'Madilyn Little Sr.', 'bella98@example.com', '1-872-596-0362', 20, '0', '5:29 PM', '11:45 PM', 17.00, 27.00, 18.00, 1, 2, 1, 2, '2023-02-10 04:42:24', '2023-02-10 04:42:24'),
(10, 4, 4, 13, 3, 2, 872731, '1991-03-06', 'Mr. Berry Berge', 'garland98@example.org', '+1 (678) 228-6939', 26, '0', '1:09 PM', '5:09 AM', 87.00, 23.00, 14.00, 2, 2, 1, 1, '2023-02-10 04:42:24', '2023-02-10 04:42:24'),
(11, 5, 4, 14, 5, 2, 652726, '2005-04-17', 'Wyman Kris', 'rogahn.josiane@example.com', '931.835.8444', 17, '0', '11:31 PM', '3:56 PM', 76.00, 46.00, 27.00, 1, 2, 1, 1, '2023-02-10 04:42:24', '2023-02-10 04:42:24'),
(12, 3, 3, 3, 1, 1, 451470, '1974-03-09', 'Berniece Ullrich', 'erika.bogisich@example.org', '1-626-470-5576', 29, '0', '4:26 AM', '4:08 PM', 69.00, 25.00, 28.00, 2, 1, 2, 2, '2023-02-10 04:42:24', '2023-02-10 04:42:24'),
(13, 5, 1, 8, 4, 2, 253593, '1983-06-04', 'Dr. Eloy Rohan', 'nikolaus.justyn@example.com', '401-377-3174', 13, '0', '4:51 PM', '6:45 PM', 98.00, 33.00, 20.00, 1, 1, 1, 1, '2023-02-10 04:42:24', '2023-02-10 04:42:24'),
(14, 6, 3, 5, 5, 1, 340513, '2010-09-03', 'Tre Nicolas', 'zcartwright@example.org', '561-742-7527', 14, '0', '9:16 PM', '1:38 AM', 77.00, 31.00, 21.00, 1, 1, 2, 2, '2023-02-10 04:42:24', '2023-02-10 04:42:24'),
(15, 3, 2, 13, 3, 2, 697614, '2021-02-09', 'Dr. Franz Will IV', 'mclaughlin.lorena@example.com', '+17602183243', 32, '0', '2:02 PM', '1:25 AM', 92.00, 27.00, 22.00, 1, 2, 1, 2, '2023-02-10 04:42:24', '2023-02-10 04:42:24'),
(16, 6, 2, 16, 3, 3, 366355, '1996-06-17', 'Prof. Hattie Waelchi', 'simonis.darlene@example.net', '1-540-300-6715', 29, '0', '8:33 AM', '9:13 PM', 46.00, 19.00, 14.00, 2, 1, 2, 1, '2023-02-10 04:42:24', '2023-02-10 04:42:24'),
(17, 4, 3, 13, 2, 3, 843022, '1998-05-13', 'Mrs. Amy Jones II', 'ankunding.jalon@example.net', '+16023178892', 22, '0', '9:16 PM', '12:06 AM', 75.00, 41.00, 23.00, 1, 1, 1, 1, '2023-02-10 04:42:24', '2023-02-10 04:42:24'),
(18, 3, 3, 17, 5, 1, 796032, '1998-05-15', 'Isadore Predovic', 'shakira02@example.org', '+16576774742', 25, '0', '6:52 AM', '1:55 PM', 63.00, 11.00, 25.00, 2, 1, 1, 1, '2023-02-10 04:42:24', '2023-02-10 04:42:24'),
(19, 4, 1, 12, 5, 1, 117788, '1997-11-29', 'Dr. Jennie Kshlerin DDS', 'elisa.hand@example.com', '1-816-500-1638', 19, '0', '3:46 AM', '11:28 PM', 20.00, 45.00, 18.00, 1, 1, 2, 2, '2023-02-10 04:42:24', '2023-02-10 04:42:24'),
(20, 2, 2, 17, 1, 3, 652174, '1988-04-01', 'Miss Darlene Hermiston DDS', 'rutherford.rodrick@example.com', '520.590.3276', 22, '0', '7:32 PM', '1:05 AM', 93.00, 47.00, 12.00, 2, 1, 2, 2, '2023-02-10 04:42:24', '2023-02-10 04:42:24'),
(21, 3, 1, 16, 1, 1, 621524, '2023-02-13', 'Michel Streich', 'blaze.quigley@example.com', '954.785.4257', 18, '', '8:04 PM', '8:07 PM', 53.00, 14.00, 17.00, 2, 1, 1, 1, '2023-02-10 04:42:24', '2023-02-10 04:42:24');

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
(1, 2, '1,2,5', 'Dome A', 39.99, 0, 'Times Square, Manhattan, NY, USA', '10036', 'Manhattan', 'New York', 'United States', '09:00 AM', '08:00 PM', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has su', '21.079440', '72.881756', 'Free Wifi|Changing Room|Parking', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum', 2, '2022-12-01 22:23:40', '2022-12-19 18:48:09'),
(2, 2, '1,4', 'Dome B', 0.00, 0, 'Hollywood Studios Entrance, Kissimmee, FL, USA', '34747', 'Kissimmee', 'Florida', 'United States', '10:00 AM', '02:00 PM', 'rthbgfn vftrjng', '21.413700', '72.849655', 'Free Wifi|Changing Room|Parking', 'eryhfbd rfgedfv rg', 2, '2022-12-01 23:28:53', '2022-12-08 18:55:32'),
(3, 2, '1,3,5', 'Dome B', 99.00, 0, 'Frame Dubai - Picture Framing & Printing in Dubai, Dubai Garden Centre - Sheikh Zayed Road - Dubai - United Arab Emirates', NULL, NULL, NULL, NULL, '09:00 AM', '12:00 PM', 'hftrdrthfbdh', '21.336971', '73.155899', 'Free Wifi|Changing Room|Parking', 'grev sergwdv', 2, '2022-12-04 18:09:06', '2022-12-05 21:47:25'),
(4, 2, '1,2', 'Statdium', 99.99, 0, 'Testaccio, Rome, Metropolitan City of Rome, Italy', '00153', 'Rome', 'Lazio', 'Italy', '12:30 AM', '03:00 AM', 'Hello', '21.379437', '73.694916', 'Free Wifi|Changing Room|Parking', 'Test', 2, '2022-12-05 00:29:59', '2022-12-08 20:07:28'),
(5, 2, '2', 'Scarlett Nicolas', 97.00, 0, 'TEST-ADDRESS', '120442', 'Gaylord D\'Amore', 'Birdie Pfannerstill', 'Vernie Hane DVM', '2:35 AM', '9:49 AM', 'DESCRIPTION', '22.139593', '74.183807', 'Prof. Clement Zieme', 'benefits-DESCRIPTION', 2, '2023-02-09 04:22:40', '2023-02-09 04:22:40'),
(6, 2, '3', 'Mafalda O\'Keefe', 59.00, 0, 'TEST-ADDRESS', '582456', 'Dr. Sydney Beatty', 'Alvis Monahan', 'Teresa Friesen', '7:49 AM', '11:09 PM', 'DESCRIPTION', '22.867832', '75.551605', 'Jeramie Rowe', 'benefits-DESCRIPTION', 2, '2023-02-09 04:22:40', '2023-02-09 04:22:40'),
(7, 2, '1', 'Prof. Alejandra Kertzmann Sr.', 65.00, 0, 'TEST-ADDRESS', '639657', 'Mrs. Monica McDermott III', 'Jena Cartwright MD', 'Lacey Jenkins II', '10:00 AM', '4:50 AM', 'DESCRIPTION', '23.193900', '76.622772', 'Garland Pollich', 'benefits-DESCRIPTION', 2, '2023-02-09 04:22:40', '2023-02-09 04:22:40'),
(8, 2, '2', 'Ines Lynch', 95.00, 0, 'TEST-ADDRESS', '550077', 'Coralie Koepp', 'Jaren Lesch', 'Pascale Quitzon', '11:46 PM', '9:20 PM', 'DESCRIPTION', '23.375547', '74.609528', 'Dr. Enrique Christiansen IV', 'benefits-DESCRIPTION', 2, '2023-02-09 04:22:40', '2023-02-09 04:22:40'),
(9, 2, '2', 'Marquis DuBuque', 81.00, 0, 'TEST-ADDRESS', '951030', 'Prof. Janick Hansen V', 'Aurelio Trantow', 'Mathew Hegmann PhD', '12:07 PM', '7:27 PM', 'DESCRIPTION', '22.738705', '73.628998', 'Gudrun Hudson Jr.', 'benefits-DESCRIPTION', 2, '2023-02-09 04:22:40', '2023-02-09 04:22:40'),
(10, 2, '1', 'Milford Mohr', 51.00, 0, 'TEST-ADDRESS', '176145', 'Mr. Chaim Hermiston III', 'Mr. Warren Gusikowski', 'Rahsaan Stamm', '8:23 AM', '9:52 AM', 'DESCRIPTION', '22.365832', '72.843475', 'Vivian D\'Amore PhD', 'benefits-DESCRIPTION', 2, '2023-02-09 04:22:40', '2023-02-09 04:22:40'),
(11, 2, '2', 'Prof. Colten Sanford', 88.00, 0, 'TEST-ADDRESS', '977299', 'Prof. Jany Beahan', 'Shanel Spinka', 'Elna Schultz MD', '9:40 AM', '11:47 PM', 'DESCRIPTION', '21.979225', '73.357086', 'Bart Windler', 'benefits-DESCRIPTION', 2, '2023-02-09 04:22:40', '2023-02-09 04:22:40'),
(12, 2, '1', 'Darrin Towne', 61.00, 0, 'TEST-ADDRESS', '472611', 'Dr. Rosie Labadie', 'Eliza Cummings', 'Miss Dorothea Bailey DVM', '6:30 PM', '3:44 PM', 'DESCRIPTION', '21.594116', '73.087921', 'Charlotte Williamson', 'benefits-DESCRIPTION', 2, '2023-02-09 04:22:40', '2023-02-09 04:22:40'),
(13, 2, '2', 'Prof. Susie Larkin Jr.', 63.00, 0, 'TEST-ADDRESS', '201899', 'Mr. Rollin Treutel IV', 'Sunny Blanda', 'Mrs. Lindsay Grady PhD', '12:48 PM', '7:34 AM', 'DESCRIPTION', '21.097834', '72.950592', 'Mrs. Ima Herzog', 'benefits-DESCRIPTION', 2, '2023-02-09 04:22:40', '2023-02-09 04:22:40'),
(14, 2, '3', 'Miss Kenna Christiansen V', 78.00, 0, 'TEST-ADDRESS', '675629', 'Maximilian Ritchie PhD', 'Dr. Mossie Osinski', 'Rahsaan Farrell DDS', '8:19 PM', '1:44 AM', 'DESCRIPTION', '20.360601', '73.211517', 'Johnathan Abernathy', 'benefits-DESCRIPTION', 2, '2023-02-09 04:22:40', '2023-02-09 04:22:40'),
(15, 2, '3', 'Alexanne Ledner', 62.00, 0, 'TEST-ADDRESS', '370795', 'Ocie Kuhn IV', 'Edward Towne', 'Savanah Kris', '10:15 AM', '7:10 PM', 'DESCRIPTION', '20.002266', '73.788300', 'Kole Connelly', 'benefits-DESCRIPTION', 2, '2023-02-09 04:22:40', '2023-02-09 04:22:40'),
(16, 2, '2', 'Isabelle Hessel', 86.00, 0, 'TEST-ADDRESS', '199947', 'Alexander Marks', 'Mr. Oda Balistreri III', 'Eudora Schuster', '2:56 AM', '11:25 AM', 'DESCRIPTION', '20.479004', '73.769073', 'Mr. Tyrell Luettgen II', 'benefits-DESCRIPTION', 2, '2023-02-09 04:22:40', '2023-02-09 04:22:40'),
(17, 2, '2', 'Dr. Ryley McDermott', 56.00, 0, 'TEST-ADDRESS', '646649', 'Martine Cassin', 'Elvis Schmidt', 'Kiel Cole', '2:06 PM', '4:02 AM', 'DESCRIPTION', '20.708853', '74.288864', 'Randi Dicki', 'benefits-DESCRIPTION', 2, '2023-02-09 04:22:40', '2023-02-09 04:22:40'),
(18, 2, '3', 'Robb Rosenbaum', 62.00, 0, 'TEST-ADDRESS', '115439', 'Dr. Isobel Kirlin', 'Jacklyn Moen', 'Jarod Ebert', '7:51 AM', '6:23 PM', 'DESCRIPTION', '20.794895', '73.922195', 'Ottilie Nader', 'benefits-DESCRIPTION', 2, '2023-02-09 04:22:40', '2023-02-09 04:22:40'),
(19, 2, '4', 'Dr. Hanna Reichel DVM', 79.00, 0, 'TEST-ADDRESS', '114351', 'August Marvin V', 'Mr. Andres Reilly III', 'Elyse Koelpin DDS', '1:01 AM', '10:45 AM', 'DESCRIPTION', '20.945028', '74.137802', 'Leila Johns', 'benefits-DESCRIPTION', 2, '2023-02-09 04:22:40', '2023-02-09 04:22:40'),
(20, 2, '3', 'Dr. Randi McDermott Sr.', 63.00, 0, 'TEST-ADDRESS', '663926', 'Caitlyn McDermott', 'Jillian Williamson', 'Rhianna Mann', '10:03 PM', '5:04 PM', 'DESCRIPTION', '20.020855', '73.808899', 'Nelle Russel', 'benefits-DESCRIPTION', 2, '2023-02-09 04:22:40', '2023-02-09 04:22:40'),
(21, 2, '2', 'Kaylee Schimmel MD', 83.00, 0, 'TEST-ADDRESS', '370294', 'Elisabeth Stark IV', 'Miss Vanessa Pfeffer IV', 'Marge Rice', '3:22 AM', '9:32 PM', 'DESCRIPTION', '20.952222', '75.561218', 'Zion Schmeler', 'benefits-DESCRIPTION', 2, '2023-02-09 04:22:40', '2023-02-09 04:22:40'),
(22, 2, '3', 'Zack Lynch I', 75.00, 0, 'TEST-ADDRESS', '995142', 'Donavon Shanahan', 'Adrian Schinner', 'Manuel Mohr', '9:58 AM', '4:09 PM', 'DESCRIPTION', '21.683471', '75.090179', 'Dr. Heber Terry V', 'benefits-DESCRIPTION', 2, '2023-02-09 04:22:40', '2023-02-09 04:22:40'),
(23, 2, '2', 'Abigail Lakin', 65.00, 0, 'TEST-ADDRESS', '380939', 'Reyes Kreiger', 'Gregory Hilpert', 'Vern Predovic', '12:37 PM', '1:37 PM', 'DESCRIPTION', '21.581346', '74.244232', 'Prof. Enos Wyman', 'benefits-DESCRIPTION', 2, '2023-02-09 04:22:40', '2023-02-09 04:22:40'),
(24, 2, '2', 'Dr. Jacey Walter', 78.00, 0, 'TEST-ADDRESS', '380316', 'Dr. Delmer Schmeler II', 'Ole Grant', 'Emma Howe', '4:56 AM', '11:06 AM', 'DESCRIPTION', '21.765120', '74.856720', 'Jacky Carter I', 'benefits-DESCRIPTION', 2, '2023-02-09 04:22:40', '2023-02-09 04:22:40'),
(25, 2, '2', 'Mrs. Lysanne Ziemann', 88.00, 0, 'TEST-ADDRESS', '142030', 'Retha Reynolds I', 'Ms. Luisa Breitenberg MD', 'Karine Mosciski', '9:17 AM', '4:49 AM', 'DESCRIPTION', '22.304860', '74.293671', 'Theresia Mraz', 'benefits-DESCRIPTION', 2, '2023-02-09 04:22:40', '2023-02-09 04:22:40'),
(26, 2, '3', 'Madisyn Dicki IV', 82.00, 0, 'TEST-ADDRESS', '553975', 'Prof. Winston Tromp', 'Dr. Blanche Stark DVM', 'Dr. Dameon Blanda MD', '3:41 PM', '5:12 AM', 'DESCRIPTION', '22.124327', '73.453217', 'Madelynn Pollich', 'benefits-DESCRIPTION', 2, '2023-02-09 04:22:40', '2023-02-09 04:22:40'),
(27, 2, '4', 'Omari Kutch DDS', 83.00, 0, 'TEST-ADDRESS', '720863', 'Clint Lehner', 'Mr. Dudley Fahey', 'Mr. Erling Huel Sr.', '8:18 AM', '7:47 AM', 'DESCRIPTION', '22.200637', '73.744354', 'Jaiden Bailey', 'benefits-DESCRIPTION', 2, '2023-02-09 04:22:40', '2023-02-09 04:22:40'),
(28, 2, '4', 'Abelardo Waters DVM', 68.00, 0, 'TEST-ADDRESS', '221270', 'Miss Kirsten Krajcik', 'Mr. Tevin Sporer', 'Kristopher Hoeger', '3:41 PM', '2:35 PM', 'DESCRIPTION', '22.200637', '73.744354', 'Prof. Marshall Maggio', 'benefits-DESCRIPTION', 2, '2023-02-09 04:22:40', '2023-02-09 04:22:40'),
(29, 2, '3', 'Perry Larkin', 58.00, 0, 'TEST-ADDRESS', '212883', 'Prof. Priscilla Mayer', 'Webster Breitenberg DVM', 'Vidal Dach', '3:22 PM', '7:06 AM', 'DESCRIPTION', '22.505460', '73.667450', 'Jordon Carter DDS', 'benefits-DESCRIPTION', 2, '2023-02-09 04:22:40', '2023-02-09 04:22:40'),
(30, 2, '2', 'Jana Watsica', 50.00, 0, 'TEST-ADDRESS', '390049', 'Dr. Buck Rosenbaum III', 'Miss Nicole Graham', 'Shirley Goldner', '9:00 AM', '12:41 AM', 'DESCRIPTION', '23.024645', '73.527374', 'April Bednar', 'benefits-DESCRIPTION', 2, '2023-02-09 04:22:40', '2023-02-09 04:22:40'),
(31, 2, '2', 'Finn Schuppe', 86.00, 0, 'TEST-ADDRESS', '233065', 'Prof. Stevie Hayes PhD', 'Clarissa Leannon', 'Dorris Doyle', '5:55 AM', '6:30 AM', 'DESCRIPTION', '22.281988', '73.195038', 'Prof. Winston Connelly', 'benefits-DESCRIPTION', 2, '2023-02-09 04:22:40', '2023-02-09 04:22:40'),
(32, 2, '1', 'Dr. Clint Hackett', 93.00, 0, 'TEST-ADDRESS', '413875', 'Collin Hagenes III', 'Peyton Buckridge DVM', 'Milo Windler PhD', '2:05 PM', '5:31 PM', 'DESCRIPTION', '22.037793', '73.112640', 'Nick Cormier', 'benefits-DESCRIPTION', 2, '2023-02-09 04:22:40', '2023-02-09 04:22:40'),
(33, 2, '2', 'Aiyana Schultz', 70.00, 0, 'TEST-ADDRESS', '522262', 'Stanford Upton', 'Dr. Princess Lindgren', 'Caleb Ferry', '10:33 AM', '8:10 PM', 'DESCRIPTION', '22.129416', '73.420258', 'Dr. Ellsworth Towne', 'benefits-DESCRIPTION', 2, '2023-02-09 04:22:40', '2023-02-09 04:22:40'),
(34, 2, '1', 'Lizeth Macejkovic DVM', 81.00, 0, 'TEST-ADDRESS', '585703', 'Kayli Sawayn', 'Micheal Johnson V', 'Bret D\'Amore', '11:10 PM', '4:52 AM', 'DESCRIPTION', '22.421700', '72.917633', 'Reid McLaughlin Sr.', 'benefits-DESCRIPTION', 2, '2023-02-09 04:22:40', '2023-02-09 04:22:40');

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
(4, 2, 2, 'dome-6389d36541fc3.jpg', '2022-12-01 23:28:53', '2022-12-01 23:28:53'),
(5, 2, 2, 'dome-6389d365495ec.png', '2022-12-01 23:28:53', '2022-12-01 23:28:53'),
(6, 2, 2, 'dome-6389d365517ed.png', '2022-12-01 23:28:53', '2022-12-01 23:28:53'),
(7, 2, 1, 'dome-6389e98c291e1.jpg', '2022-12-02 01:03:24', '2022-12-02 01:03:24'),
(8, 2, 1, 'dome-6389e98c30fe2.jpg', '2022-12-02 01:03:24', '2022-12-02 01:03:24'),
(9, 2, 1, 'dome-6389e98c350af.png', '2022-12-02 01:03:24', '2022-12-02 01:03:24'),
(10, 2, 1, 'dome-6389e98c3d2fa.png', '2022-12-02 01:03:24', '2022-12-02 01:03:24'),
(11, 2, 3, 'dome-638d7cf2dfd43.png', '2022-12-04 18:09:06', '2022-12-04 18:09:06'),
(12, 2, 3, 'dome-638d7cf2e4ec7.png', '2022-12-04 18:09:06', '2022-12-04 18:09:06'),
(13, 2, 4, 'dome-638dd6372d73b.jpg', '2022-12-05 00:29:59', '2022-12-05 00:29:59'),
(14, 2, 4, 'dome-638dd637345bf.jpg', '2022-12-05 00:29:59', '2022-12-05 00:29:59'),
(15, 2, 4, 'dome-638dd63739be9.png', '2022-12-05 00:29:59', '2022-12-05 00:29:59');

-- --------------------------------------------------------

--
-- Table structure for table `enquiries`
--

CREATE TABLE `enquiries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `message` varchar(255) DEFAULT NULL,
  `type` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1=HelpCenter, 2=GeneralEnquiry, 3=DomesRequest',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `enquiries`
--

INSERT INTO `enquiries` (`id`, `email`, `subject`, `message`, `type`, `created_at`, `updated_at`) VALUES
(1, 'ipsum@yopmail.comn', 'Talk About Something..', 'Lorem is ipsum data to world to tast data.', 1, '2023-02-19 01:13:26', '2023-02-19 01:13:26');

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
  `dome_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `favourites`
--

INSERT INTO `favourites` (`id`, `user_id`, `dome_id`, `created_at`, `updated_at`) VALUES
(1, 7, 2, '2023-02-13 02:09:37', '2023-02-13 02:09:37'),
(23, 4, 1, '2023-02-14 04:47:58', '2023-02-14 04:47:58'),
(24, 4, 1, '2023-02-14 04:47:58', '2023-02-14 04:47:58');

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
(2, 2, 1, '2', 'Test 1', 0.00, 2, 9, 'field-1135.jpg', 1, 2, '2022-12-03 21:26:27', '2022-12-04 17:54:18'),
(3, 6, 3, '1', 'Test 2', 0.00, 2, 9, 'field-9600.jpg', 1, 2, '2022-12-04 18:10:37', '2022-12-04 18:10:37'),
(4, 3, 2, '2', 'Chelsea Mayer', 489.00, 8, 22, 'field-9600.jpg', 1, 2, '2022-12-19 22:36:53', '2022-12-19 22:36:53'),
(6, 2, 3, '5', 'Valentin Sipes', 159.00, 9, 18, 'field-9600.jpg', 1, 2, '2022-12-19 22:36:53', '2022-12-19 22:36:53'),
(7, 5, 1, '1', 'Mrs. Jazmyn Jerde', 117.00, 5, 28, 'field-9600.jpg', 1, 2, '2022-12-19 22:36:53', '2022-12-19 22:36:53'),
(9, 6, 1, '3', 'Zetta Leuschke', 194.00, 8, 28, 'field-9600.jpg', 1, 2, '2022-12-19 22:36:53', '2022-12-19 22:36:53'),
(11, 6, 2, '2', 'Verna Dickinson MD', 130.00, 7, 25, 'field-9600.jpg', 1, 2, '2022-12-19 22:36:53', '2022-12-19 22:36:53'),
(12, 2, 1, '4', 'Kimberly Gerlach', 251.00, 4, 22, 'field-9600.jpg', 1, 2, '2022-12-19 22:36:53', '2022-12-19 22:36:53'),
(13, 5, 1, '5', 'Kailey Gutmann V', 227.00, 4, 19, 'field-9600.jpg', 1, 2, '2022-12-19 22:36:53', '2022-12-19 22:36:53'),
(14, 3, 4, '1', 'Norberto Douglas', 280.00, 10, 24, 'field-9600.jpg', 1, 2, '2022-12-19 22:36:53', '2022-12-19 22:36:53'),
(15, 2, 1, '5', 'Mrs. Dessie Tillman V', 421.00, 5, 25, 'field-9600.jpg', 1, 2, '2022-12-19 22:36:53', '2022-12-19 22:36:53'),
(16, 6, 3, '1', 'Amari Toy', 311.00, 8, 19, 'field-9600.jpg', 1, 2, '2022-12-19 22:36:53', '2022-12-19 22:36:53'),
(17, 4, 2, '5', 'Vella Hackett V', 103.00, 4, 30, 'field-9600.jpg', 1, 2, '2022-12-19 22:36:53', '2022-12-19 22:36:53'),
(18, 4, 2, '2', 'Garfield Eichmann', 158.00, 5, 23, 'field-9600.jpg', 1, 2, '2022-12-19 22:36:53', '2022-12-19 22:36:53'),
(20, 4, 1, '5', 'Gabe Beahan', 395.00, 4, 21, 'field-9600.jpg', 1, 2, '2022-12-19 22:36:53', '2022-12-19 22:36:53'),
(21, 5, 1, '1', 'Mrs. Jazmyn Jerde', 117.00, 5, 28, 'field-9600.jpg', 1, 2, '2022-12-19 22:36:53', '2022-12-19 22:36:53'),
(22, 3, 3, '1', 'Antwan Hilpert', 242.00, 8, 25, 'field-9600.jpg', 1, 2, '2022-12-19 22:36:53', '2022-12-19 22:36:53'),
(23, 3, 4, '1', 'Chauncey Weissnat V', 396.00, 8, 20, 'field-9600.jpg', 1, 2, '2022-12-19 22:36:53', '2022-12-19 22:36:53'),
(24, 6, 2, '2', 'Mr. Jamel Armstrong', 165.00, 7, 21, 'field-9600.jpg', 1, 2, '2022-12-19 22:36:53', '2022-12-19 22:36:53'),
(25, 4, 3, '5', 'Alexandre Larson V', 286.00, 7, 18, 'field-9600.jpg', 1, 2, '2022-12-19 22:36:53', '2022-12-19 22:36:53'),
(26, 5, 3, '2', 'Clint Tremblay MD', 136.00, 5, 21, 'field-9600.jpg', 1, 2, '2022-12-19 22:36:53', '2022-12-19 22:36:53'),
(27, 6, 3, '1', 'Mrs. Dandre Kutch I', 302.00, 10, 28, 'field-9600.jpg', 1, 2, '2022-12-19 22:36:53', '2022-12-19 22:36:53'),
(28, 4, 3, '4', 'Mayra Moen', 149.00, 9, 29, 'field-9600.jpg', 1, 2, '2022-12-19 22:36:53', '2022-12-19 22:36:53'),
(29, 5, 1, '1', 'Mrs. Jazmyn Jerde', 117.00, 5, 28, 'field-9600.jpg', 1, 2, '2022-12-19 22:36:53', '2022-12-19 22:36:53');

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
(15, '2023_02_19_071908_add_fcm_token_column_to_users_table', 13);

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
(500, 4, 4, 3, NULL, NULL, NULL, '2022-12-12 22:47:06', '2022-12-12 22:47:06');

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
(1, 'Cricket', 'sport-4213.png', 1, 2, '2022-11-21 23:57:58', '2022-12-08 19:02:44'),
(2, 'Vollyball', 'sport-7411.png', 1, 2, '2022-11-22 01:16:14', '2022-11-22 01:16:14'),
(3, 'Golf', 'sport-923.png', 1, 2, '2022-11-22 01:16:26', '2022-11-22 01:16:26'),
(4, 'Tennis', 'sport-5843.png', 1, 2, '2022-11-22 01:16:39', '2022-11-22 01:16:39'),
(5, 'Soccer', 'sport-8388.png', 1, 2, '2022-12-05 00:14:04', '2022-12-05 00:14:04');

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
(2, 2, 1, 'test', 'test@yopmail.com', 'CA', '1234657890', '$2y$10$z0eXm5BtjQQP77GHRvJAGOIp1osY2Lx0NvMvmkpTgPzpiTUvnIlri', NULL, NULL, NULL, NULL, NULL, 'default.png', 1, 1, 2, '2023-02-06 00:03:03', '2023-02-09 05:23:37'),
(3, 3, 2, 'test1', 'dummy@gmail.com', 'CA', '6359487772', NULL, NULL, NULL, NULL, NULL, NULL, 'default.png', 1, 1, 2, '2023-02-06 00:14:06', '2023-02-19 00:44:25'),
(4, 3, 1, 'test1', 's@gmail.com', 'CA', '12345679', '$2y$10$ZT0nObeNnoOfxpc51wNMjuEMdj.wDjDWwTN7HrpIF4PLgHp73A3b2', NULL, NULL, NULL, NULL, NULL, 'default.png', 1, 1, 2, '2023-02-09 04:55:36', '2023-02-15 07:35:53'),
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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `cms`
--
ALTER TABLE `cms`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `domes`
--
ALTER TABLE `domes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `dome_images`
--
ALTER TABLE `dome_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `enquiries`
--
ALTER TABLE `enquiries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `favourites`
--
ALTER TABLE `favourites`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `fields`
--
ALTER TABLE `fields`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `payment_gateways`
--
ALTER TABLE `payment_gateways`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=501;

--
-- AUTO_INCREMENT for table `sports`
--
ALTER TABLE `sports`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

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
