-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 04, 2023 at 04:04 PM
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
-- Database: `domez`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

DROP TABLE IF EXISTS `bookings`;
CREATE TABLE IF NOT EXISTS `bookings` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `type` tinyint NOT NULL DEFAULT '1' COMMENT '1=Dome Bookings,  2=League Bookings',
  `vendor_id` int NOT NULL,
  `dome_id` int DEFAULT NULL,
  `league_id` int DEFAULT NULL,
  `user_id` int NOT NULL,
  `sport_id` int NOT NULL,
  `field_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `booking_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slots` text COLLATE utf8mb4_unicode_ci COMMENT 'For Domes Booking Only',
  `start_date` date DEFAULT NULL COMMENT 'For Leagues Booking Only	',
  `end_date` date DEFAULT NULL COMMENT 'For Leagues Booking Only	',
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `sub_total` double NOT NULL DEFAULT '0',
  `service_fee` double NOT NULL DEFAULT '0',
  `hst` double NOT NULL DEFAULT '0',
  `total_amount` double(8,2) NOT NULL,
  `paid_amount` double(8,2) NOT NULL DEFAULT '0.00',
  `due_amount` double(8,2) NOT NULL DEFAULT '0.00',
  `refunded_amount` double DEFAULT '0',
  `payment_mode` int NOT NULL DEFAULT '1' COMMENT '1=online,2=offline',
  `payment_type` int NOT NULL DEFAULT '1' COMMENT '1=Full Amount, 2=Split Amount',
  `payment_status` int NOT NULL DEFAULT '1' COMMENT '1=Complete,2=Partial',
  `booking_status` int NOT NULL DEFAULT '1' COMMENT '1=Confirmed, 2=Pending, 3=Cancelled	',
  `token` text COLLATE utf8mb4_unicode_ci,
  `players` int NOT NULL,
  `customer_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customer_email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_mobile` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `team_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'For Leagues Booking Only',
  `cancellation_reason` text COLLATE utf8mb4_unicode_ci,
  `is_payment_released` tinyint NOT NULL DEFAULT '2' COMMENT '1=Yes, 2=No',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `type`, `vendor_id`, `dome_id`, `league_id`, `user_id`, `sport_id`, `field_id`, `booking_id`, `slots`, `start_date`, `end_date`, `start_time`, `end_time`, `sub_total`, `service_fee`, `hst`, `total_amount`, `paid_amount`, `due_amount`, `refunded_amount`, `payment_mode`, `payment_type`, `payment_status`, `booking_status`, `token`, `players`, `customer_name`, `customer_email`, `customer_mobile`, `team_name`, `cancellation_reason`, `is_payment_released`, `created_at`, `updated_at`) VALUES
(9, 1, 2, 35, NULL, 7, 8, '53', '9141d1', '06:00 AM - 09:00 AM', '2023-04-05', NULL, '06:00:00', '09:00:00', 210, 10.5, 10.5, 231.00, 231.00, 0.00, 0, 1, 1, 1, 1, NULL, 12, 'Soham', 'domez@gmail.com', '6359478772', '', NULL, 2, '2023-04-04 11:46:12', '2023-04-04 11:46:12'),
(10, 1, 2, 35, NULL, 7, 8, '53', 'dc57eb', '09:00 AM - 10:30 AM', '2023-04-28', NULL, '09:00:00', '10:30:00', 22, 1.1, 1.1, 24.20, 24.20, 0.00, 0, 1, 1, 2, 1, NULL, 12, 'Soham', 'domez@gmail.com', '6359478772', '', NULL, 2, '2023-04-04 13:13:52', '2023-04-04 13:13:52'),
(11, 1, 2, 35, NULL, 7, 10, '8', 'de274e', '02:00 PM - 09:00 PM', '2023-04-29', NULL, '14:00:00', '21:00:00', 200, 10, 10, 220.00, 220.00, 0.00, 0, 1, 1, 1, 1, NULL, 12, 'Soham', 'domez@gmail.com', '6359478772', '', NULL, 2, '2023-04-04 13:49:59', '2023-04-04 13:49:59'),
(12, 1, 2, 35, NULL, 7, 8, '53', '7a5928', '09:00 AM - 10:30 AM', '2023-04-28', NULL, '09:00:00', '10:30:00', 22, 1.1, 1.1, 24.20, 24.20, 0.00, 0, 1, 1, 2, 1, NULL, 12, 'Soham', 'domez@gmail.com', '6359478772', '', NULL, 2, '2023-04-04 13:51:41', '2023-04-04 13:51:41'),
(13, 1, 2, 35, NULL, 7, 10, '8', 'e44b99', '10:00 AM - 07:00 PM', '2023-04-05', NULL, '10:00:00', '19:00:00', 120, 6, 6, 132.00, 132.00, 0.00, 0, 1, 1, 1, 1, NULL, 12, 'Soham', 'domez@gmail.com', '6359478772', '', NULL, 2, '2023-04-04 13:54:04', '2023-04-04 13:54:04'),
(14, 1, 2, 35, NULL, 7, 8, '53', '67674d', '06:00 AM - 09:00 AM', '2023-04-19', NULL, '06:00:00', '09:00:00', 210, 10.5, 10.5, 231.00, 231.00, 0.00, 0, 1, 1, 1, 1, NULL, 12, 'Soham', 'domez@gmail.com', '6359478772', '', NULL, 2, '2023-04-04 13:55:39', '2023-04-04 13:55:39'),
(15, 1, 2, 35, NULL, 7, 8, '53', '5040de', '06:00 AM - 07:30 AM', '2023-04-21', NULL, '06:00:00', '07:30:00', 20, 1, 1, 22.00, 22.00, 0.00, 0, 1, 1, 2, 1, NULL, 12, 'Soham', 'domez@gmail.com', '6359478772', '', NULL, 2, '2023-04-04 14:04:25', '2023-04-04 14:04:25'),
(16, 1, 2, 35, NULL, 7, 10, '8', '59dec4', '01:00 AM - 06:00 AM', '2023-04-29', NULL, '01:00:00', '06:00:00', 120, 6, 6, 132.00, 132.00, 0.00, 0, 1, 1, 1, 1, NULL, 12, 'Soham', 'domez@gmail.com', '6359478772', '', NULL, 2, '2023-04-04 14:05:49', '2023-04-04 14:05:49');

-- --------------------------------------------------------

--
-- Table structure for table `cms`
--

DROP TABLE IF EXISTS `cms`;
CREATE TABLE IF NOT EXISTS `cms` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `type` int NOT NULL COMMENT '\r\n1=Privacy Policy, 2=Terms & Conditions, 3=Refund Policy, 4=Cancellation Policy',
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cms`
--

INSERT INTO `cms` (`id`, `type`, `content`, `created_at`, `updated_at`) VALUES
(1, 2, '<h1>Terms &amp; Conditions</h1>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>1. AGREEMENT TO TERMS</strong></p>\r\n\r\n<p>These Terms of Use constitute a legally binding agreement made between you, whether personally or on behalf of an entity (&ldquo;you&rdquo;) and Domez Inc. (&quot;Company&quot;, &ldquo;we&rdquo;, &ldquo;us&rdquo;, or &ldquo;our&rdquo;), concerning your access to and use of the domez.io web mobile application DOMEZ as well as any other media form, media channel, mobile web mobile application DOMEZ or mobile application related, linked, or otherwise connected thereto (collectively, the &ldquo;Mobile application DOMEZ&rdquo;). You agree that by accessing the Mobile application DOMEZ, you have read, understood, and agree to be bound by all of these Terms of Use. IF YOU DO NOT AGREE WITH ALL OF THESE TERMS OF USE, THEN YOU ARE EXPRESSLY PROHIBITED FROM USING THE MOBILE APPLICATION DOMEZ AND YOU MUST DISCONTINUE USE IMMEDIATELY. Supplemental terms and conditions or documents that may be posted on the Mobile application DOMEZ from time to time are hereby expressly incorporated herein by reference. In our sole discretion, we reserve the right&nbsp;to change or modify these Terms of Use at any time and for any reason. We will alert you about any changes by updating the &ldquo;Last updated&rdquo; date of these Terms of Use, and you waive any right to receive specific notice of each such change. Please ensure that you check the applicable Terms every time you use our Mobile application DOMEZ so that you understand which Terms apply. You will be subject to and will be deemed to have been made aware of and to have accepted, the changes in any revised Terms of Use by your continued use of the Mobile application DOMEZ after the date such revised Terms of Use are posted. The information provided on the Mobile application DOMEZ is not intended for distribution to or use by any person or entity in any jurisdiction or country where such distribution or use would be contrary to law or regulation or which would subject us to any registration requirement within such jurisdiction or country. Accordingly, those persons who choose to access the Mobile application DOMEZ from other locations do so on their initiative and are solely responsible for compliance with local laws, if and to the extent local laws are applicable.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>2. Intellectual Property Rights</strong></p>\r\n\r\n<p>Unless otherwise indicated, the Mobile application DOMEZ is our proprietary property and all source code, databases, functionality, software, web mobile application DOMEZ designs, audio, video, text, photographs, and graphics on the Mobile application DOMEZ (collectively, the &ldquo;Content&rdquo;) and the trademarks, service marks, and logos contained therein (the &ldquo;Marks&rdquo;) are owned or controlled by us or licensed to us, and are protected by copyright and trademark laws and various other intellectual property rights and unfair competition laws of the United States, international copyright laws, and international conventions.</p>\r\n\r\n<p>The Content and the Marks are provided on the Mobile application DOMEZ &ldquo;AS IS&rdquo; for your information and personal use only. Except as expressly provided in these Terms of Use, no part of the Mobile application DOMEZ and no Content or Marks may be copied, reproduced, aggregated, republished, uploaded, posted, publicly displayed, encoded, translated, transmitted, distributed, sold, licensed, or otherwise exploited for any commercial purpose whatsoever, without our express prior written permission. Provided that you are eligible to use the Mobile application DOMEZ, you are granted a limited license to access and use the Mobile application DOMEZ and to download or print a copy of any portion of the Content to which you have properly gained access solely for your personal, non-commercial use. We reserve all rights not expressly granted to you in and to the Mobile application DOMEZ, the Content and the Marks.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>3. User Representations</strong></p>\r\n\r\n<p>By using the Mobile application DOMEZ, you represent and warrant that:</p>\r\n\r\n<ol>\r\n	<li>you have the legal capacity and you agree to comply with these Terms of Use;</li>\r\n	<li>you are not a minor in the jurisdiction in which you reside;</li>\r\n	<li>you will not access the Mobile application DOMEZ through automated or non-human means, whether through a bot, script or otherwise;</li>\r\n	<li>you will not use the Mobile application DOMEZ for any illegal or unauthorized purpose; and</li>\r\n	<li>your use of the Mobile application DOMEZ will not violate any applicable law or regulation.</li>\r\n</ol>\r\n\r\n<p>If you provide any information that is untrue, inaccurate, not current, or incomplete, we have the right to suspend or terminate your account and refuse any current or future use of the Mobile application DOMEZ (or any portion thereof).</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>4. FEES AND PAYMENT</strong></p>\r\n\r\n<p>We accept the following forms of payment: You may be required to purchase or pay a fee to access some of our services. You agree to provide current, complete, and accurate purchases and account for all purchases made via the Mobile application DOMEZ. You further agree to promptly update account and payment information, including email address, payment method, and payment card expiration date, so that we can complete your transactions and contact you as needed.</p>\r\n\r\n<p>We bill you through an online billing account for purchases made via the Mobile application DOMEZ. Sales tax will be added to the price of purchases as deemed required by us. We may change at any time. All payments shall be in __________. You agree to pay all charges or fees at the prices then in effect for your purchases, and you authorize us to charge your chosen payment provider any such amounts upon making your purchase. We reserve the right to correct any errors or mistakes in pricing, even if we have already requested or received payment. We also reserve the right to refuse any order placed through the Mobile application DOMEZ.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>5. CANCELLATION</strong></p>\r\n\r\n<p>You can cancel your subscription at any time __________. Your cancellation will take effect at the end of the current paid term. If you are unsatisfied with our services, please email us at __________.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>6. PROHIBITED ACTIVITIES</strong></p>\r\n\r\n<p>You may not access or use the Mobile application DOMEZ for any purpose other than that for which we make the Mobile application DOMEZ available. The Mobile application DOMEZ may not be used in connection with any commercial endeavours except those that are specifically endorsed or approved by us. As a user of the Mobile application DOMEZ, you agree not to: Systematically retrieve data or other content from the Mobile application DOMEZ to create or compile, directly or indirectly, a collection, compilation, database, or directory without written permission from us.</p>\r\n\r\n<p>They trick, defraud, or mislead us and other users, especially in any attempt to learn sensitive account information such as user passwords. Circumvent, disable, or otherwise interfere with -related features of the Mobile application DOMEZ, including features that prevent or restrict the use or copying of any Content or enforce limitations on the use of the Mobile application DOMEZ and/or the Content contained therein. Disparage, tarnish, or otherwise harm, in our opinion, us and/or the Mobile application DOMEZ. Use any information obtained from the Mobile application DOMEZ to harass, abuse, or harm another person. Make improper use of our support services or submit false reports of abuse or misconduct. Use the Mobile application DOMEZ in a manner with any applicable laws or regulations. Engage in unauthorized framing of or linking to the Mobile application DOMEZ.</p>\r\n\r\n<p>Upload or transmit (or attempt to upload or to transmit) viruses, Trojan horses, or other material, including excessive use of capital letters and spamming (continuous posting of repetitive), that interferes with any party&rsquo;s uninterrupted use and enjoyment of the Mobile application DOMEZ or modifies, impairs, disrupts, alters, or interferes with the use, features, functions, operation, or maintenance of the Mobile application DOMEZ. Engage in any automated use of the system, such as using scripts to send comments or messages, or using any data mining, robots, or data gathering and extraction tools. Delete the copyright or other proprietary rights notice from any Content. Attempt to impersonate another user or person or use the username of another user. Upload or transmit (or attempt to upload or to transmit) any material that acts as a passive or active information collection or transmission mechanism, including without limitation, clear graphics formats (&ldquo;gifs&rdquo;), 1&times;1 pixels, web bugs, cookies, or other similar devices (sometimes referred to as &ldquo;spyware&rdquo; or &ldquo;passive collection mechanisms&rdquo; or &ldquo;PCM&rdquo;). Interfere with, disrupt, or create an undue burden on the Mobile application DOMEZ or the networks or services connected to the Mobile application DOMEZ. Harass, annoy, intimidate, or threaten any of our employees or agents engaged in providing any portion of the Mobile application DOMEZ to you. Attempt to bypass any measures of the Mobile application DOMEZ designed to prevent or restrict access to the Mobile application, or any portion of the Mobile application DOMEZ.</p>\r\n\r\n<p>Copy or adapt the Mobile application DOMEZ&rsquo;s software, including but not limited to Flash, PHP, HTML, JavaScript, or other code. Except as permitted by applicable law, decipher, decompile, disassemble, or reverse engineer any of the software comprising or in any way making up a part of the Mobile application DOMEZ. Except as may be the result of the standard search engine or Internet browser usage, use, launch, develop, or distribute any automated system, including without limitation, any spider, robot, cheat utility, scraper, or offline reader that accesses the Mobile application DOMEZ, or using or launching any unauthorized script or other software. Use a buying agent or purchasing agent to make purchases on the Mobile application DOMEZ. Make any unauthorized use of the Mobile application DOMEZ, including collecting usernames and/or email addresses of users by electronic or other means to send unsolicited emails, or create user accounts by automated means or under pretences. Use the Mobile application DOMEZ as part of any effort to compete with us or otherwise use the Mobile application DOMEZ and/or the Content of any revenue-generating endeavour or commercial enterprise.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>7. USER-GENERATED CONTRIBUTIONS</strong></p>\r\n\r\n<p>The Mobile application DOMEZ does not offer users to submit or post content. We may provide you with the opportunity to create, submit, post, display, transmit, perform, publish, distribute, or broadcast content and materials to us or on the Mobile application DOMEZ, including but not limited to text, writings, video, audio, photographs, graphics, comments, suggestions, or personal or material (collectively, Contributions&quot;). Contributions may be viewable by other users of the Mobile application DOMEZ and through third-party web mobile application DOMEZs. As such, any Contributions you transmit may be treated by the Mobile application DOMEZ Privacy Policy. When you create or make available any Contributions, you thereby represent and warrant that:</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>8. CONTRIBUTION LICENSE</strong></p>\r\n\r\n<p>You and the Mobile application DOMEZ agree that we may access, store, process, and use any information and personal data that you provide following the terms of the Privacy Policy and your choices (including settings). By submitting suggestions or other feedback regarding the Mobile application DOMEZ, you agree that we can use and share such feedback for any purpose without compensation to you. We do not assert any ownership over your Contributions. You retain full ownership of all of your Contributions and any intellectual property rights or other proprietary rights associated with your Contributions. We are not liable for any statements or representations in your Contributions provided by you in any area on the Mobile application DOMEZ. You are solely responsible for your Contributions to the Mobile application DOMEZ and you expressly agree to exonerate us from any responsibility and to refrain from any legal action against us regarding your Contributions.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>9. SUBMISSIONS</strong></p>\r\n\r\n<p>You acknowledge and agree that any questions, comments, suggestions, ideas, feedback, or other information regarding the Mobile application DOMEZ (&quot;Submissions&quot;) provided by you to us are non-confidential and shall become our sole property. We shall own exclusive rights, including all intellectual property rights, and shall be entitled to the unrestricted use and dissemination of these Submissions for any lawful purpose, commercial or otherwise, without acknowledgement or compensation to you. You hereby waive all moral rights to any such Submissions, and you hereby warrant that any such Submissions are original with you or that you have the right to submit such Submissions. You agree there shall be no recourse against us for any alleged or actual infringement or misappropriation of any proprietary right in your Submissions.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>10. MOBILE APPLICATION DOMEZ MANAGEMENT</strong></p>\r\n\r\n<p>We reserve the right, but not the obligation, to (1) monitor the Mobile application DOMEZ for violations of these Terms of Use; (2) take appropriate legal action against anyone who, in our sole discretion, violates the law or these Terms of Use, including without limitation, reporting such user to law enforcement authorities; (3) in our sole discretion and without limitation, refuse, restrict access to, limit the availability of, or disable (to the extent technologically feasible) any of your Contributions or any portion thereof; (4) in our sole discretion and without limitation, notice, or liability, to remove from the Mobile application DOMEZ or otherwise disable all files and content that are excessive in size or are in any way burdensome to our systems, and (5) otherwise manage the Mobile application DOMEZ in a manner designed to protect our rights and property and to facilitate the proper functioning of the Mobile application DOMEZ.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>11. TERM AND TERMINATION</strong></p>\r\n\r\n<p>These Terms of Use shall remain in full force and effect while you use the Mobile application DOMEZ. WITHOUT LIMITING ANY OTHER PROVISION OF THESE TERMS OF USE, WE RESERVE THE RIGHT TO, IN OUR SOLE DISCRETION AND WITHOUT NOTICE OR LIABILITY, DENY ACCESS TO AND USE OF THE MOBILE APPLICATION DOMEZ (INCLUDING BLOCKING CERTAIN IP ADDRESSES), TO ANY PERSON FOR ANY REASON OR NO REASON, INCLUDING WITHOUT LIMITATION FOR BREACH OF ANY REPRESENTATION, WARRANTY, OR COVENANT CONTAINED IN THESE TERMS OF USE OR ANY APPLICABLE LAW OR REGULATION. WE MAY TERMINATE YOUR USE OR PARTICIPATION IN THE MOBILE APPLICATION DOMEZ OR DELETE ANY CONTENT OR INFORMATION THAT YOU POSTED AT ANY TIME, WITHOUT WARNING, AT OUR SOLE DISCRETION.</p>\r\n\r\n<p>If we terminate or suspend your account for any reason, you are prohibited from registering and creating a new account under your name, a fake or borrowed name, or the name of any third party, even if you may be acting on behalf of the third party. In addition to terminating or suspending your account, we reserve the right to take appropriate legal action, including without limitation pursuing civil, criminal, and injunctive redress.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>12. MODIFICATIONS AND INTERRUPTIONS</strong></p>\r\n\r\n<p>We reserve the right to change, modify, or remove the contents of the Mobile application DOMEZ at any time or for any reason at our sole discretion without notice. However, we have no obligation to update any information on our Mobile application DOMEZ. We also reserve the right to modify or discontinue all or part of the Mobile application DOMEZ without notice at any time. We will not be liable to you or any third party for any modification, price change, suspension, or discontinuance of the Mobile application DOMEZ. We cannot guarantee the Mobile application DOMEZ will be available at all times. We may experience hardware, software, or other problems or need to perform maintenance related to the Mobile application DOMEZ, resulting in interruptions, delays, or errors. We reserve the right to change, revise, update, suspend, discontinue, or otherwise modify the Mobile application DOMEZ at any time or for any reason without notice to you. You agree that we have no liability whatsoever for any loss, damage, or inconvenience caused by your inability to access or use the Mobile application DOMEZ during any downtime or discontinuance of the Mobile application DOMEZ. Nothing in these Terms of Use will be construed to obligate us to maintain and support the Mobile application DOMEZ or to supply any corrections, updates, or releases in connection therewith.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>13. GOVERNING LAW</strong></p>\r\n\r\n<p>These Terms shall be governed by and defined following the laws of Ontario, Canada, and you irrevocably consent that the courts of Canada shall have exclusive jurisdiction to resolve any dispute which may arise in connection with these terms.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>14. DISPUTE RESOLUTION</strong></p>\r\n\r\n<p>Informal Negotiations To expedite resolution and control the cost of any dispute, controversy, or claim related to these Terms of Use (each Dispute&quot; and collectively, the &ldquo;Disputes&rdquo;) brought by either you or us individually, a &ldquo;Party&rdquo; and collectively, the &ldquo;Parties&rdquo;), the Parties agree to first attempt to negotiate any Dispute (except those Disputes expressly provided below) informally for at least 30 days before initiating the arbitration. Such informal negotiations commence upon written notice from one Party to the other Party. Binding Arbitration Any dispute arising out of or in connection with this contract, including any question regarding its existence, validity, or termination, shall be referred to and finally resolved by the International Commercial Arbitration Court under the European Arbitration Chamber (Belgium, Brussels, Avenue Louise, 146) according to the Rules of this ICAC, which, as a result of referring to it, is considered as the part of this clause. The number of arbitrators shall be four, and The seat, or legal place, of arbitration, shall be three The language to be used in the arbitral proceedings shall be English. The governing law of the contract shall be the substantive law of Canada. Restrictions The Parties agree that any arbitration shall be limited to the Dispute between the Parties individually. To the full extent permitted by law,</p>\r\n\r\n<ol>\r\n	<li>no arbitration shall be joined with any other proceeding;</li>\r\n	<li>there is no right or authority for any Dispute to be arbitrated on a class-action basis or to utilize class-action procedures;</li>\r\n	<li>there is no right or authority for any Dispute to be brought in a purported representative capacity on behalf of the general public or any other persons.</li>\r\n</ol>\r\n\r\n<p>Exceptions to Informal Negotiations and Arbitration The Parties agree that the following Disputes are not subject to the above provisions concerning informal negotiations and binding arbitration:</p>\r\n\r\n<ol>\r\n	<li>any Disputes seeking to enforce or protect, or concerning the validity of, any of the intellectual property rights of a Party;</li>\r\n	<li>any Dispute related to, or arising from, allegations of theft, piracy, invasion of privacy, or unauthorized use;</li>\r\n	<li>any claim for injunctive relief.</li>\r\n</ol>\r\n\r\n<p>If this provision is found to be illegal or unenforceable, then neither Party will elect to arbitrate any Dispute falling within that portion of this provision found to be illegal or unenforceable and such Dispute shall be decided by a court of competent jurisdiction within the courts listed for jurisdiction above, and the Parties agree to submit to the personal jurisdiction of that court.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>15. CORRECTIONS</strong></p>\r\n\r\n<p>There may be information on the Mobile application DOMEZ that contains typographical errors, inaccuracies, or omissions, including descriptions, pricing, availability, and various other information. We reserve the right to correct any errors, inaccuracies, or omissions and to change or update the information on the Mobile application DOMEZ at any time, without prior notice.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>16. DISCLAIMER</strong></p>\r\n\r\n<p>THE MOBILE APPLICATION DOMEZ IS PROVIDED ON AN AS-IS AND ASAVAILABLE BASIS. YOU AGREE THAT YOUR USE OF THE MOBILE APPLICATION DOMEZ AND OUR SERVICES WILL BE AT YOUR SOLE RISK. TO THE FULLEST EXTENT PERMITTED BY LAW, WE DISCLAIM ALL WARRANTIES, EXPRESS OR IMPLIED, IN CONNECTION WITH THE MOBILE APPLICATION DOMEZ AND YOUR USE THEREOF, INCLUDING, WITHOUT LIMITATION, THE IMPLIED WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE, AND NON-INFRINGEMENT. WE MAKE NO WARRANTIES OR REPRESENTATIONS ABOUT THE ACCURACY OR COMPLETENESS OF THE MOBILE APPLICATION DOMEZ&rsquo;S CONTENT OR THE CONTENT OF ANY WEBMOBILE APPLICATION DOMEZS LINKED TO THE MOBILE APPLICATION DOMEZ AND WE WILL ASSUME NO LIABILITY OR RESPONSIBILITY FOR ANY (1) ERRORS, MISTAKES, OR INACCURACIES OF CONTENT AND MATERIALS, (2) PERSONAL INJURY OR PROPERTY DAMAGE, OF ANY NATURE WHATSOEVER, RESULTING FROM YOUR ACCESS TO AND USE OF THE MOBILE APPLICATION DOMEZ, (3) ANY UNAUTHORIZED ACCESS TO OR USE OF OUR SECURE SERVERS AND/OR ANY AND ALL PERSONAL INFORMATION AND/OR FINANCIAL INFORMATION STORED THEREIN, (4) ANY INTERRUPTION OR CESSATION OF TRANSMISSION TO OR FROM THE MOBILE APPLICATION DOMEZ, (5) ANY BUGS, VIRUSES, TROJAN HORSES, OR THE LIKE WHICH MAY BE TRANSMITTED TO OR THROUGH THE MOBILE APPLICATION DOMEZ BY ANY THIRD PARTY, AND/OR (6) ANY ERRORS OR OMISSIONS IN ANY CONTENT AND MATERIALS OR FOR ANY LOSS OR DAMAGE OF ANY KIND INCURRED AS A RESULT OF THE USE OF ANY CONTENT POSTED, TRANSMITTED, OR OTHERWISE MADE AVAILABLE VIA THE MOBILE APPLICATION DOMEZ. WE DO NOT WARRANT, ENDORSE, GUARANTEE, OR ASSUME RESPONSIBILITY FOR ANY PRODUCT OR SERVICE ADVERTISED OR OFFERED BY A THIRD PARTY THROUGH THE MOBILE APPLICATION DOMEZ, ANY HYPERLINKED WEB MOBILE APPLICATION DOMEZ, OR ANY WEB MOBILE APPLICATION DOMEZ OR MOBILE APPLICATION FEATURED IN ANY BANNER OR OTHER ADVERTISING, AND WE WILL NOT BE A PARTY TO OR IN ANY WAY BE RESPONSIBLE FOR MONITORING ANY TRANSACTION BETWEEN YOU AND ANY THIRD-PARTY PROVIDERS OF PRODUCTS OR SERVICES. AS WITH THE PURCHASE OF A PRODUCT OR SERVICE THROUGH ANY MEDIUM OR IN ANY ENVIRONMENT, YOU SHOULD USE YOUR BEST JUDGMENT AND EXERCISE CAUTION WHERE APPROPRIATE.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>17. LIMITATIONS OF LIABILITY</strong></p>\r\n\r\n<p>IN NO EVENT WILL WE OR OUR DIRECTORS, EMPLOYEES, OR AGENTS BE LIABLE TO YOU OR ANY THIRD PARTY FOR ANY DIRECT, INDIRECT, CONSEQUENTIAL, EXEMPLARY, INCIDENTAL, SPECIAL, OR PUNITIVE DAMAGES, INCLUDING LOST PROFIT, LOST REVENUE, LOSS OF DATA, OR OTHER DAMAGES ARISING FROM YOUR USE OF THE MOBILE APPLICATION DOMEZ, EVEN IF WE HAVE BEEN ADVISED OF THE POSSIBILITY OF SUCH DAMAGES. NOTWITHSTANDING ANYTHING TO THE CONTRARY CONTAINED HEREIN, OUR LIABILITY TO YOU FOR ANY CAUSE WHATSOEVER AND REGARDLESS OF THE FORM OF THE ACTION WILL AT ALL TIMES BE LIMITED TO THE LESSER OF THE AMOUNT PAID, IF ANY, BY YOU TO US OR OTHER PARTIES CERTAIN US STATE LAWS AND INTERNATIONAL LAWS DO NOT ALLOW LIMITATIONS ON IMPLIED WARRANTIES OR THE EXCLUSION OR LIMITATION OF CERTAIN DAMAGES. IF THESE LAWS APPLY TO YOU, SOME OR ALL OF THE ABOVE DISCLAIMERS OR LIMITATIONS MAY NOT APPLY TO YOU, AND YOU MAY HAVE ADDITIONAL RIGHTS.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>18. INDEMNIFICATION</strong></p>\r\n\r\n<p>You agree to defend, indemnify, and hold us harmless, including our subsidiaries, affiliates, and all of our respective officers, agents, partners, and employees, from and against any loss, damage, liability, claim, or demand, including reasonable attorneys&rsquo; fees and expenses, made by any third party due to or arising out of (1) use of the Mobile application DOMEZ; (2) breach of these Terms of Use; (3) any breach of your representations and warranties outlined in these Terms of Use; (4) your violation of the rights of a third party, including but not limited to intellectual property rights; or (5) any overt harmful act toward any other user of the Mobile application DOMEZ with whom you connected via the Mobile application DOMEZ. Notwithstanding the foregoing, we reserve the right, at your expense, to assume the exclusive defence and control of any matter for which you are required to indemnify us, and you agree to cooperate, at your expense, with our defence of such claims. We will use reasonable efforts to notify you of any such claim, action, or proceeding which is subject to this indemnification upon becoming aware of it.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>19. USER DATA</strong></p>\r\n\r\n<p>We will maintain certain data that you transmit to the Mobile application DOMEZ to manage the performance of the Mobile application DOMEZ, as well as data relating to your use of the Mobile application DOMEZ. Although we perform routine backups of data, you are solely responsible for all data that you transmit or that relates to any activity you have undertaken using the Mobile application DOMEZ. You agree that we shall have no liability to you for any loss or corruption of any such data, and you hereby waive any right of action against us arising from any such loss or corruption of such data.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>20. ELECTRONIC COMMUNICATIONS, TRANSACTIONS, AND SIGNATURES</strong></p>\r\n\r\n<p>Visiting the Mobile application DOMEZ, sending us emails, and completing online forms constitute electronic communications. You consent to receive electronic communications, and you agree that all agreements, notices, disclosures, and other communications we provide to you electronically, via email and on the Mobile application DOMEZ, satisfy any legal requirement that such communication is in writing. YOU HEREBY AGREE TO THE USE OF ELECTRONIC SIGNATURES, CONTRACTS, ORDERS, AND OTHER RECORDS AND THE ELECTRONIC DELIVERY OF NOTICES, POLICIES, AND RECORDS OF TRANSACTIONS INITIATED OR COMPLETED BY US OR VIA THE MOBILE APPLICATION DOMEZ. You hereby waive any rights or requirements under any statutes, regulations, rules, ordinances, or other laws in any jurisdiction which require an original signature or delivery or retention of non-electronic records, or to payments or the granting of credits by any means other than electronic means.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>21. MISCELLANEOUS</strong></p>\r\n\r\n<p>These Terms of Use and any policies or operating rules posted by us on the Mobile application DOMEZ or concerning the Mobile application DOMEZ constitute the entire agreement and understanding between you and us. Our failure to exercise or enforce any right or provision of these Terms of Use shall not operate as a waiver of such right or provision. These Terms of Use operate to the fullest extent permissible by law. We may assign any or all of our rights and obligations to others at any time. We shall not be responsible or liable for any loss, damage, delay, or failure to act caused by any cause beyond our reasonable control. If any provision or part of a provision of these Terms of Use is determined to be unlawful, void, or unenforceable, that provision or part of the provision is deemed severable from these Terms of Use and does not affect the validity and enforceability of any remaining provisions. There is no joint venture, partnership, employment or agency relationship created between you and us as a result of these Terms of Use or use of the Mobile application DOMEZ. You agree that these Terms of Use will not be construed against us by having drafted them. You hereby waive any defences you may have based on the electronic form of these Terms of Use and the lack of signing by the parties hereto to execute these Terms of Use.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>22. CONTACT US</strong></p>\r\n\r\n<p>To resolve a complaint regarding the Mobile application DOMEZ or to receive further information regarding the use of the Mobile application DOMEZ, please contact us at: dev@domez.io</p>', '2023-03-10 04:36:27', '2023-04-04 15:33:58'),
(2, 1, '<h1>Privacy Policy</h1>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>DOMEZ Inc. built the DOMEZ app as a Commercial app. This SERVICE is provided by DOMEZ Inc. and is intended for use as is. This page is used to inform visitors regarding our policies regarding the collection, use, and disclosure of Personal Information if anyone decided to use our Service. If you choose to use our Service, then you agree to the collection and use of information about this policy. The Personal Information that we collect is used for providing and improving the Service. We will not use or share your information with anyone except as described in this Privacy Policy. The terms used in this Privacy Policy have the same meanings as in our Terms and Conditions, which are accessible at DOMEZ unless otherwise defined in this Privacy Policy.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Information Collection and Use</strong></p>\r\n\r\n<p>For a better experience, while using our Service, we may require you to provide us with certain personally identifiable information, including but not limited to Contact. The information that we request will be retained by us and used as described in this privacy policy. The app does use third-party services that may collect information used to identify you. Link to the privacy policy of third-party service providers used by the app &bull; Google Play Services &bull; Facebook</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Log Data</strong></p>\r\n\r\n<p>We want to inform you that whenever you use our Service, in a case of an error in the app we collect data and information (through third-party products) on your phone called Log Data. This Log Data may include information such as your device Internet Protocol (&ldquo;IP&rdquo;) address, device name, operating system version, the configuration of the app when utilizing our Service, the time and date of your use of the Service, and other statistics.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Cookies</strong></p>\r\n\r\n<p>Cookies are files with a small amount of data that are commonly used as anonymous unique identifiers. These are sent to your browser from the websites that you visit and are stored on your device&#39;s internal memory. This Service does not use these &ldquo;cookies&rdquo; explicitly. However, the app may use third-party code and libraries that use &ldquo;cookies&rdquo; to collect information and improve their services. You have the option to either accept or refuse these cookies and know when a cookie is being sent to your device. If you choose to refuse our cookies, you may not be able to use some portions of this Service.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Service Providers</strong></p>\r\n\r\n<p>We may employ third-party companies and individuals due to the following reasons:</p>\r\n\r\n<ol>\r\n	<li>To facilitate our Service;</li>\r\n	<li>To provide the Service on our behalf;</li>\r\n	<li>To perform Service-related services;</li>\r\n	<li>you will not use the Mobile application DOMEZ for any illegal or unauthorized purpose; and</li>\r\n	<li>To assist us in analyzing how our Service is used.</li>\r\n</ol>\r\n\r\n<p>We want to inform users of this Service that these third parties have access to your Personal Information. The reason is to perform the tasks assigned to them on our behalf. However, they are obligated not to disclose or use the information for any other purpose.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Security</strong></p>\r\n\r\n<p>We value your trust in providing us with your Personal Information, thus we are striving to use commercially acceptable means of protecting it. But remember that no method of transmission over the internet, or method of electronic storage is 100% secure and reliable, and we cannot guarantee its absolute security.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Links to Other Sites</strong></p>\r\n\r\n<p>This Service may contain links to other sites. If you click on a third-party link, you will be directed to that site. Note that these external sites are not operated by us. Therefore, we strongly advise you to review the Privacy Policy of these websites. We have no control over and assume no responsibility for the content, privacy policies, or practices of any third-party sites or services.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Children&rsquo;s Privacy</strong></p>\r\n\r\n<p>These Services do not address anyone under the age of 13. We do not knowingly collect personally identifiable information from children under 13 years of age. In the case we discover that a child under 13 has provided us with personal information, we immediately delete this from our servers. If you are a parent or guardian and you are aware that your child has provided us with personal information, please contact us so that we will be able to do the necessary actions.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Changes to This Privacy Policy</strong></p>\r\n\r\n<p>We may update our Privacy Policy from time to time. Thus, you are advised to review this page periodically for any changes. We will notify you of any changes by posting the new Privacy Policy on this page. This policy is effective as of 2021-03-06</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Contact Us</strong></p>\r\n\r\n<p>If you have any questions or suggestions about our Privacy Policy, do not hesitate to contact us at dev@domez.io</p>', '2023-03-10 04:37:12', '2023-04-04 16:00:15'),
(3, 4, '<h1>Cancellation Policy</h1>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Cancellation by the User:</strong></p>\r\n\r\n<p>If you cancel your booking at least more than 2 hours before the scheduled start time, you will receive a refund minus a 3% cancellation fee. You will not receive a refund if you cancel your booking less than 2 hours before the scheduled start time.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Cancellation by the Service Provider:</strong></p>\r\n\r\n<p>If the service provider cancels your booking for any reason, you will receive a full refund. If the service provider cancels your booking due to unforeseen circumstances such as weather conditions or equipment failure), you will receive a full refund or the option to reschedule your booking.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>No-Show Policy:</strong></p>\r\n\r\n<p>If you do not show up for your booking without prior notice, you will not receive a refund. Please note that the above policies may be subject to change and may vary depending on the service provider you choose. We recommend that you carefully review the specific service provider\'s cancellation policy before booking.</p>', '2023-03-31 01:43:18', '2023-04-04 15:49:10'),
(4, 3, '<h1>Refund Policy:</h1>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Our booking app offers a refund policy for cancellations made within a certain timeframe. Please review the cancellation policy for the specific activity or service you have booked for information on refund eligibility. No-shows are not eligible for refunds. If the activity or service is cancelled due to unforeseen circumstances such as weather or equipment failure, you may be eligible for a full or partial refund depending on the situation. To request a refund, please contact our customer service team as soon as possible. Refunds may take up to 5-7 business days to process. Refunds will be issued to the original payment method used for the booking. If you have any questions or concerns about our refund policy, please contact our customer service team for assistance. Note: Refund policies may be subject to change without notice. Please review the specific cancellation and refund policy for the activity or service you have booked for the most up-to-date information.</p>', '2023-03-31 01:53:42', '2023-04-04 15:54:23');

-- --------------------------------------------------------

--
-- Table structure for table `domes`
--

DROP TABLE IF EXISTS `domes`;
CREATE TABLE IF NOT EXISTS `domes` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `vendor_id` int NOT NULL,
  `sport_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` double(8,2) DEFAULT NULL,
  `hst` double(8,2) NOT NULL COMMENT 'tax(GST)',
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `pin_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `start_time` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `end_time` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `lat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lng` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `benefits` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `benefits_description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '2' COMMENT '1=yes,2=no',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `domes`
--

INSERT INTO `domes` (`id`, `vendor_id`, `sport_id`, `name`, `price`, `hst`, `address`, `pin_code`, `city`, `state`, `country`, `start_time`, `end_time`, `description`, `lat`, `lng`, `benefits`, `benefits_description`, `is_deleted`, `created_at`, `updated_at`) VALUES
(35, 2, '6,7,8,10', 'Domez', 0.00, 5.00, 'Costen Tax Solutions, Inc, Birdneck Road North, Virginia Beach, VA, USA', '23451', 'Summerside', 'Prince Edward Island', 'Canada', '6:00 AM', '7:00 PM', 'DESCRIPTION', '28.5156729', '-81.4824233', 'Free Wifi|Changing Room|Parking|Pool|Others', 'benefits-DESCRIPTION', 2, '2023-02-20 03:57:09', '2023-04-03 06:55:09');

-- --------------------------------------------------------

--
-- Table structure for table `dome_images`
--

DROP TABLE IF EXISTS `dome_images`;
CREATE TABLE IF NOT EXISTS `dome_images` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `dome_id` int DEFAULT NULL,
  `league_id` int DEFAULT NULL,
  `images` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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

DROP TABLE IF EXISTS `enquiries`;
CREATE TABLE IF NOT EXISTS `enquiries` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `vendor_id` int DEFAULT NULL,
  `type` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1=HelpCenter[Mobile App], 2=HelpCenter[Web], 3=DomesRequest[Web], 4=DomesRequest[Mobile App], 5=Supports[DomeOwner-AdminPanel]',
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
  `is_replied` tinyint(1) NOT NULL DEFAULT '2' COMMENT '1=Yes, 2=No',
  `is_accepted` tinyint(1) NOT NULL DEFAULT '2' COMMENT '1=Yes, 2=No',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '2' COMMENT '1=Yes, 2=No',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `favourites`
--

DROP TABLE IF EXISTS `favourites`;
CREATE TABLE IF NOT EXISTS `favourites` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `dome_id` int DEFAULT NULL,
  `league_id` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=138 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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

DROP TABLE IF EXISTS `fields`;
CREATE TABLE IF NOT EXISTS `fields` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `vendor_id` int NOT NULL,
  `dome_id` int NOT NULL,
  `sport_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `area` double(8,2) NOT NULL DEFAULT '0.00',
  `min_person` int NOT NULL,
  `max_person` int NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_available` tinyint NOT NULL DEFAULT '1' COMMENT '1=yes,2=no',
  `is_deleted` tinyint NOT NULL DEFAULT '2' COMMENT '1=yes,2=no',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=58 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `fields`
--

INSERT INTO `fields` (`id`, `vendor_id`, `dome_id`, `sport_id`, `name`, `area`, `min_person`, `max_person`, `image`, `is_available`, `is_deleted`, `created_at`, `updated_at`) VALUES
(2, 2, 35, '10', '2', 452.00, 5, 30, 'field-6712.jpg', 1, 2, '2023-02-20 05:57:52', '2023-03-29 09:45:56'),
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

DROP TABLE IF EXISTS `leagues`;
CREATE TABLE IF NOT EXISTS `leagues` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `vendor_id` int NOT NULL,
  `dome_id` int NOT NULL,
  `field_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sport_id` int NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `booking_deadline` date DEFAULT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `start_time` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `end_time` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `from_age` int NOT NULL,
  `to_age` int NOT NULL,
  `gender` tinyint NOT NULL DEFAULT '1' COMMENT '1=Men, 2=Women, 3=Other',
  `min_player` int NOT NULL,
  `max_player` int NOT NULL,
  `team_limit` int NOT NULL,
  `price` int NOT NULL,
  `is_deleted` tinyint NOT NULL DEFAULT '2' COMMENT '1=yes,2=no',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `leagues`
--

INSERT INTO `leagues` (`id`, `vendor_id`, `dome_id`, `field_id`, `sport_id`, `name`, `booking_deadline`, `start_date`, `end_date`, `start_time`, `end_time`, `from_age`, `to_age`, `gender`, `min_player`, `max_player`, `team_limit`, `price`, `is_deleted`, `created_at`, `updated_at`) VALUES
(1, 2, 35, '36', 7, 'The Golf League', '2023-05-05', '2023-05-26', '2023-08-25', '09:00 AM', '05:00 PM', 16, 28, 1, 12, 17, 13, 1489, 2, '2023-02-20 06:56:50', '2023-04-03 04:34:00'),
(11, 2, 35, '35,33,32,31,30', 6, 'The Soccer League', '2023-03-08', '2023-03-16', '2023-04-10', '09:00 AM', '05:00 PM', 16, 28, 1, 12, 17, 13, 1489, 2, '2023-02-20 06:56:50', '2023-04-02 12:30:39'),
(16, 2, 35, '26,20,14,8', 10, 'The Volleyball League', '2023-04-13', '2023-04-28', '2023-07-28', '09:00 AM', '05:00 PM', 16, 28, 1, 12, 17, 13, 1489, 2, '2023-02-20 06:56:50', '2023-04-02 11:55:53');

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
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payment_gateways`
--

DROP TABLE IF EXISTS `payment_gateways`;
CREATE TABLE IF NOT EXISTS `payment_gateways` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `type` int NOT NULL COMMENT '1=Stripe',
  `vendor_id` tinyint NOT NULL,
  `account_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `public_key` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `secret_key` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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

DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

DROP TABLE IF EXISTS `reviews`;
CREATE TABLE IF NOT EXISTS `reviews` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `vendor_id` int NOT NULL,
  `dome_id` int NOT NULL,
  `user_id` int NOT NULL,
  `ratting` int NOT NULL,
  `comment` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reply_message` text COLLATE utf8mb4_unicode_ci,
  `replied_at` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `vendor_id`, `dome_id`, `user_id`, `ratting`, `comment`, `reply_message`, `replied_at`, `created_at`, `updated_at`) VALUES
(2, 0, 35, 7, 2, 'sacds', NULL, NULL, '2023-04-01 15:34:36', '2023-04-01 15:34:36');

-- --------------------------------------------------------

--
-- Table structure for table `set_prices`
--

DROP TABLE IF EXISTS `set_prices`;
CREATE TABLE IF NOT EXISTS `set_prices` (
  `id` int NOT NULL AUTO_INCREMENT,
  `vendor_id` int NOT NULL,
  `dome_id` int NOT NULL,
  `sport_id` int NOT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `price_type` int NOT NULL DEFAULT '1' COMMENT '1=default,2=daywise',
  `price` double NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `set_prices`
--

INSERT INTO `set_prices` (`id`, `vendor_id`, `dome_id`, `sport_id`, `start_date`, `end_date`, `price_type`, `price`, `created_at`, `updated_at`) VALUES
(5, 2, 35, 10, '2023-04-01', '2023-04-29', 2, 0, '2023-03-12 05:30:16', '2023-03-12 05:30:16'),
(13, 2, 35, 6, NULL, NULL, 1, 800, '2023-03-12 05:30:16', '2023-03-12 05:30:16'),
(14, 2, 35, 7, NULL, NULL, 1, 800, '2023-03-12 05:30:16', '2023-03-12 05:30:16'),
(15, 2, 35, 6, '2023-04-01', '2023-04-29', 2, 0, '2023-03-12 05:30:16', '2023-03-12 05:30:16'),
(16, 2, 35, 7, '2023-06-14', '2023-06-30', 2, 0, '2023-03-12 05:30:16', '2023-04-01 13:35:32'),
(17, 2, 35, 10, NULL, NULL, 1, 120, '2023-03-12 05:30:16', '2023-03-12 05:30:16'),
(25, 2, 35, 8, NULL, NULL, 1, 1501, '2023-04-03 06:55:09', '2023-04-03 06:55:09'),
(27, 2, 35, 8, '2023-04-04', '2023-04-30', 2, 0, '2023-04-04 11:44:44', '2023-04-04 11:44:44');

-- --------------------------------------------------------

--
-- Table structure for table `set_prices_days_slots`
--

DROP TABLE IF EXISTS `set_prices_days_slots`;
CREATE TABLE IF NOT EXISTS `set_prices_days_slots` (
  `id` int NOT NULL AUTO_INCREMENT,
  `set_prices_id` int NOT NULL,
  `dome_id` int DEFAULT NULL,
  `sport_id` int DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `day` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `price` double NOT NULL DEFAULT '0',
  `status` int NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `set_prices_id_foreign` (`set_prices_id`)
) ENGINE=InnoDB AUTO_INCREMENT=287 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `set_prices_days_slots`
--

INSERT INTO `set_prices_days_slots` (`id`, `set_prices_id`, `dome_id`, `sport_id`, `start_date`, `end_date`, `start_time`, `end_time`, `day`, `price`, `status`, `created_at`, `updated_at`) VALUES
(174, 5, NULL, NULL, NULL, NULL, '01:00:00', '03:00:00', 'monday', 120, 0, '2023-03-29 00:22:37', '2023-03-29 00:22:37'),
(175, 5, NULL, NULL, NULL, NULL, '03:00:00', '06:00:00', 'monday', 150, 0, '2023-03-29 00:22:37', '2023-03-29 00:22:37'),
(176, 5, NULL, NULL, NULL, NULL, '07:00:00', '12:00:00', 'monday', 170, 0, '2023-03-29 00:22:37', '2023-03-29 00:22:37'),
(177, 5, NULL, NULL, NULL, NULL, '14:00:00', '22:00:00', 'monday', 190, 0, '2023-03-29 00:22:37', '2023-03-29 00:22:37'),
(178, 5, NULL, NULL, NULL, NULL, '06:00:00', '11:00:00', 'tuesday', 50, 0, '2023-03-29 00:22:37', '2023-03-29 00:22:37'),
(179, 5, NULL, NULL, NULL, NULL, '16:00:00', '23:00:00', 'tuesday', 40, 0, '2023-03-29 00:22:37', '2023-03-29 00:22:37'),
(180, 5, NULL, NULL, NULL, NULL, '10:00:00', '19:00:00', 'wednesday', 120, 0, '2023-03-29 00:22:37', '2023-03-29 00:22:37'),
(181, 5, NULL, NULL, NULL, NULL, '01:00:00', '02:00:00', 'thursday', 80, 0, '2023-03-29 00:22:37', '2023-03-29 00:22:37'),
(182, 5, NULL, NULL, NULL, NULL, '05:00:00', '11:00:00', 'thursday', 100, 0, '2023-03-29 00:22:37', '2023-03-29 00:22:37'),
(183, 5, NULL, NULL, NULL, NULL, '05:00:00', '09:00:00', 'friday', 50, 0, '2023-03-29 00:22:37', '2023-03-29 00:22:37'),
(184, 5, NULL, NULL, NULL, NULL, '01:00:00', '06:00:00', 'saturday', 120, 0, '2023-03-29 00:22:37', '2023-03-29 00:22:37'),
(185, 5, NULL, NULL, NULL, NULL, '14:00:00', '21:00:00', 'saturday', 200, 0, '2023-03-29 00:22:37', '2023-03-29 00:22:37'),
(186, 5, NULL, NULL, NULL, NULL, '02:00:00', '10:00:00', 'sunday', 1100, 0, '2023-03-29 00:22:37', '2023-03-29 00:22:37'),
(199, 16, NULL, NULL, NULL, NULL, '01:00:00', '03:00:00', 'monday', 120, 0, '2023-04-01 13:35:32', '2023-04-01 13:35:32'),
(200, 16, NULL, NULL, NULL, NULL, '03:00:00', '06:00:00', 'monday', 150, 0, '2023-04-01 13:35:32', '2023-04-01 13:35:32'),
(201, 16, NULL, NULL, NULL, NULL, '07:00:00', '12:00:00', 'monday', 170, 0, '2023-04-01 13:35:32', '2023-04-01 13:35:32'),
(202, 16, NULL, NULL, NULL, NULL, '13:00:00', '22:00:00', 'monday', 190, 0, '2023-04-01 13:35:32', '2023-04-01 13:35:32'),
(203, 16, NULL, NULL, NULL, NULL, '06:00:00', '11:00:00', 'tuesday', 50, 0, '2023-04-01 13:35:32', '2023-04-01 13:35:32'),
(204, 16, NULL, NULL, NULL, NULL, '01:00:00', '07:00:00', 'tuesday', 40, 0, '2023-04-01 13:35:32', '2023-04-01 13:35:32'),
(205, 16, NULL, NULL, NULL, NULL, '04:00:00', '11:00:00', 'wednesday', 120, 0, '2023-04-01 13:35:32', '2023-04-01 13:35:32'),
(206, 16, NULL, NULL, NULL, NULL, '01:00:00', '02:00:00', 'thursday', 80, 0, '2023-04-01 13:35:32', '2023-04-01 13:35:32'),
(207, 16, NULL, NULL, NULL, NULL, '05:00:00', '11:00:00', 'thursday', 100, 0, '2023-04-01 13:35:32', '2023-04-01 13:35:32'),
(208, 16, NULL, NULL, NULL, NULL, '04:00:00', '11:00:00', 'friday', 50, 0, '2023-04-01 13:35:32', '2023-04-01 13:35:32'),
(209, 16, NULL, NULL, NULL, NULL, '01:00:00', '06:00:00', 'saturday', 120, 0, '2023-04-01 13:35:32', '2023-04-01 13:35:32'),
(210, 16, NULL, NULL, NULL, NULL, '03:00:00', '09:00:00', 'saturday', 200, 0, '2023-04-01 13:35:32', '2023-04-01 13:35:32'),
(211, 16, NULL, NULL, NULL, NULL, '09:00:00', '09:00:00', 'sunday', 1100, 0, '2023-04-01 13:35:32', '2023-04-01 13:35:32'),
(212, 15, NULL, NULL, NULL, NULL, '01:00:00', '03:00:00', 'monday', 120, 0, '2023-04-01 13:39:29', '2023-04-01 13:39:29'),
(213, 15, NULL, NULL, NULL, NULL, '07:00:00', '12:00:00', 'monday', 170, 0, '2023-04-01 13:39:29', '2023-04-01 13:39:29'),
(214, 15, NULL, NULL, NULL, NULL, '08:00:00', '09:00:00', 'monday', 3333333333, 0, '2023-04-01 13:39:29', '2023-04-01 13:39:29'),
(215, 15, NULL, NULL, NULL, NULL, '06:00:00', '11:00:00', 'tuesday', 50, 0, '2023-04-01 13:39:29', '2023-04-01 13:39:29'),
(216, 15, NULL, NULL, NULL, NULL, '17:00:00', '21:00:00', 'tuesday', 40, 0, '2023-04-01 13:39:29', '2023-04-01 13:39:29'),
(217, 15, NULL, NULL, NULL, NULL, '10:00:00', '06:00:00', 'wednesday', 120, 0, '2023-04-01 13:39:29', '2023-04-01 13:39:29'),
(218, 15, NULL, NULL, NULL, NULL, '01:00:00', '02:00:00', 'thursday', 80, 0, '2023-04-01 13:39:29', '2023-04-01 13:39:29'),
(219, 15, NULL, NULL, NULL, NULL, '05:00:00', '11:00:00', 'thursday', 100, 0, '2023-04-01 13:39:29', '2023-04-01 13:39:29'),
(220, 15, NULL, NULL, NULL, NULL, '04:00:00', '09:00:00', 'friday', 50, 0, '2023-04-01 13:39:29', '2023-04-01 13:39:29'),
(221, 15, NULL, NULL, NULL, NULL, '03:00:00', '07:00:00', 'saturday', 120, 0, '2023-04-01 13:39:29', '2023-04-01 13:39:29'),
(222, 15, NULL, NULL, NULL, NULL, '13:00:00', '20:00:00', 'saturday', 200, 0, '2023-04-01 13:39:29', '2023-04-01 13:39:29'),
(223, 15, NULL, NULL, NULL, NULL, '03:00:00', '10:00:00', 'sunday', 1100, 0, '2023-04-01 13:39:29', '2023-04-01 13:39:29'),
(254, 27, 35, 8, '2023-04-04', '2023-04-30', '06:00:00', '07:30:00', 'monday', 120, 1, '2023-04-04 11:44:44', '2023-04-04 11:44:44'),
(255, 27, 35, 8, '2023-04-04', '2023-04-30', '07:30:00', '09:00:00', 'monday', 130, 1, '2023-04-04 11:44:44', '2023-04-04 11:44:44'),
(256, 27, 35, 8, '2023-04-04', '2023-04-30', '09:00:00', '13:30:00', 'monday', 140, 1, '2023-04-04 11:44:44', '2023-04-04 11:44:44'),
(257, 27, 35, 8, '2023-04-04', '2023-04-30', '13:30:00', '16:30:00', 'monday', 150, 1, '2023-04-04 11:44:44', '2023-04-04 11:44:44'),
(258, 27, 35, 8, '2023-04-04', '2023-04-30', '16:30:00', '18:00:00', 'monday', 160, 1, '2023-04-04 11:44:44', '2023-04-04 11:44:44'),
(259, 27, 35, 8, '2023-04-04', '2023-04-30', '06:00:00', '09:00:00', 'tuesday', 20, 1, '2023-04-04 11:44:44', '2023-04-04 11:44:44'),
(260, 27, 35, 8, '2023-04-04', '2023-04-30', '09:00:00', '10:30:00', 'tuesday', 40, 1, '2023-04-04 11:44:44', '2023-04-04 11:44:44'),
(261, 27, 35, 8, '2023-04-04', '2023-04-30', '10:30:00', '12:00:00', 'tuesday', 60, 1, '2023-04-04 11:44:44', '2023-04-04 11:44:44'),
(262, 27, 35, 8, '2023-04-04', '2023-04-30', '12:00:00', '15:00:00', 'tuesday', 80, 1, '2023-04-04 11:44:44', '2023-04-04 11:44:44'),
(263, 27, 35, 8, '2023-04-04', '2023-04-30', '15:00:00', '18:00:00', 'tuesday', 100, 1, '2023-04-04 11:44:44', '2023-04-04 11:44:44'),
(264, 27, 35, 8, '2023-04-04', '2023-04-30', '06:00:00', '09:00:00', 'wednesday', 210, 1, '2023-04-04 11:44:44', '2023-04-04 11:44:44'),
(265, 27, 35, 8, '2023-04-04', '2023-04-30', '09:00:00', '12:00:00', 'wednesday', 220, 1, '2023-04-04 11:44:44', '2023-04-04 11:44:44'),
(266, 27, 35, 8, '2023-04-04', '2023-04-30', '12:00:00', '15:00:00', 'wednesday', 230, 1, '2023-04-04 11:44:44', '2023-04-04 11:44:44'),
(267, 27, 35, 8, '2023-04-04', '2023-04-30', '15:00:00', '18:00:00', 'wednesday', 240, 1, '2023-04-04 11:44:44', '2023-04-04 11:44:44'),
(268, 27, 35, 8, '2023-04-04', '2023-04-30', '06:00:00', '10:30:00', 'thursday', 450, 1, '2023-04-04 11:44:44', '2023-04-04 11:44:44'),
(269, 27, 35, 8, '2023-04-04', '2023-04-30', '10:30:00', '15:00:00', 'thursday', 550, 1, '2023-04-04 11:44:44', '2023-04-04 11:44:44'),
(270, 27, 35, 8, '2023-04-04', '2023-04-30', '15:00:00', '18:00:00', 'thursday', 650, 1, '2023-04-04 11:44:44', '2023-04-04 11:44:44'),
(271, 27, 35, 8, '2023-04-04', '2023-04-30', '06:00:00', '07:30:00', 'friday', 20, 1, '2023-04-04 11:44:44', '2023-04-04 11:44:44'),
(272, 27, 35, 8, '2023-04-04', '2023-04-30', '07:30:00', '09:00:00', 'friday', 21, 1, '2023-04-04 11:44:44', '2023-04-04 11:44:44'),
(273, 27, 35, 8, '2023-04-04', '2023-04-30', '09:00:00', '10:30:00', 'friday', 22, 1, '2023-04-04 11:44:44', '2023-04-04 11:44:44'),
(274, 27, 35, 8, '2023-04-04', '2023-04-30', '10:30:00', '12:00:00', 'friday', 23, 1, '2023-04-04 11:44:44', '2023-04-04 11:44:44'),
(275, 27, 35, 8, '2023-04-04', '2023-04-30', '12:00:00', '13:30:00', 'friday', 24, 1, '2023-04-04 11:44:44', '2023-04-04 11:44:44'),
(276, 27, 35, 8, '2023-04-04', '2023-04-30', '13:30:00', '15:00:00', 'friday', 25, 1, '2023-04-04 11:44:44', '2023-04-04 11:44:44'),
(277, 27, 35, 8, '2023-04-04', '2023-04-30', '15:00:00', '16:30:00', 'friday', 26, 1, '2023-04-04 11:44:44', '2023-04-04 11:44:44'),
(278, 27, 35, 8, '2023-04-04', '2023-04-30', '16:30:00', '18:00:00', 'friday', 27, 1, '2023-04-04 11:44:44', '2023-04-04 11:44:44'),
(279, 27, 35, 8, '2023-04-04', '2023-04-30', '06:00:00', '10:30:00', 'saturday', 444, 1, '2023-04-04 11:44:44', '2023-04-04 11:44:44'),
(280, 27, 35, 8, '2023-04-04', '2023-04-30', '10:30:00', '16:30:00', 'saturday', 555, 1, '2023-04-04 11:44:44', '2023-04-04 11:44:44'),
(281, 27, 35, 8, '2023-04-04', '2023-04-30', '16:30:00', '18:00:00', 'saturday', 666, 1, '2023-04-04 11:44:44', '2023-04-04 11:44:44'),
(282, 27, 35, 8, '2023-04-04', '2023-04-30', '06:00:00', '07:30:00', 'sunday', 123, 1, '2023-04-04 11:44:44', '2023-04-04 11:44:44'),
(283, 27, 35, 8, '2023-04-04', '2023-04-30', '07:30:00', '09:00:00', 'sunday', 234, 1, '2023-04-04 11:44:44', '2023-04-04 11:44:44'),
(284, 27, 35, 8, '2023-04-04', '2023-04-30', '09:00:00', '12:00:00', 'sunday', 456, 1, '2023-04-04 11:44:44', '2023-04-04 11:44:44'),
(285, 27, 35, 8, '2023-04-04', '2023-04-30', '12:00:00', '13:30:00', 'sunday', 567, 1, '2023-04-04 11:44:44', '2023-04-04 11:44:44'),
(286, 27, 35, 8, '2023-04-04', '2023-04-30', '13:30:00', '15:00:00', 'sunday', 678, 1, '2023-04-04 11:44:44', '2023-04-04 11:44:44');

-- --------------------------------------------------------

--
-- Table structure for table `sports`
--

DROP TABLE IF EXISTS `sports`;
CREATE TABLE IF NOT EXISTS `sports` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_available` tinyint NOT NULL DEFAULT '1' COMMENT '1=yes,2=no',
  `is_deleted` tinyint NOT NULL DEFAULT '2' COMMENT '1=yes,2=no',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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

DROP TABLE IF EXISTS `transactions`;
CREATE TABLE IF NOT EXISTS `transactions` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `type` tinyint(1) NOT NULL COMMENT '1=incoming, 2=Outgoing(refund)',
  `vendor_id` int NOT NULL,
  `dome_id` int DEFAULT NULL,
  `league_id` int DEFAULT NULL,
  `user_id` int DEFAULT NULL,
  `booking_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contributor_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_method` int NOT NULL DEFAULT '1' COMMENT '1=Card, 2=Apple Pay, 3=Google Pay	',
  `transaction_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` double(8,2) NOT NULL,
  `is_payment_released` tinyint NOT NULL DEFAULT '2' COMMENT '1=Yes, 2=No',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `type`, `vendor_id`, `dome_id`, `league_id`, `user_id`, `booking_id`, `contributor_name`, `payment_method`, `transaction_id`, `amount`, `is_payment_released`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 35, NULL, 7, 'e0f570', NULL, 1, 'pi_3Mt5zVFysF0okTxJ0dkinyK3', 44.00, 2, '2023-04-04 09:18:20', '2023-04-04 09:18:20'),
(2, 1, 2, 35, NULL, 7, '30ffa2', NULL, 1, 'pi_3Mt61RFysF0okTxJ1bE7OoPM', 132.00, 2, '2023-04-04 09:19:35', '2023-04-04 09:19:35'),
(3, 1, 2, 35, NULL, 7, '4b271e', NULL, 1, 'pi_3Mt66pFysF0okTxJ0d6rzh7z', 462.00, 2, '2023-04-04 09:25:11', '2023-04-04 09:25:11'),
(4, 1, 2, 35, NULL, 7, '3ba181', NULL, 1, 'pi_3Mt67LFysF0okTxJ1eK4ezmJ', 88.00, 2, '2023-04-04 09:25:42', '2023-04-04 09:25:42'),
(5, 1, 2, 35, NULL, 7, '9010f1', NULL, 1, 'pi_3Mt68UFysF0okTxJ1Da9EH2G', 1760.00, 2, '2023-04-04 09:27:04', '2023-04-04 09:27:04'),
(6, 1, 2, 35, NULL, 7, 'ee9a09', NULL, 1, 'pi_3Mt699FysF0okTxJ0FOzg8py', 73.33, 2, '2023-04-04 09:27:36', '2023-04-04 09:27:36'),
(7, 1, 2, 35, NULL, 7, '65ac02', NULL, 1, 'pi_3Mt69qFysF0okTxJ1fMcfn7N', 73.33, 2, '2023-04-04 09:28:16', '2023-04-04 09:28:16'),
(8, 1, 2, 35, NULL, 7, '81c0ea', NULL, 1, 'pi_3Mt6AMFysF0okTxJ0W4xT2CR', 7.33, 2, '2023-04-04 09:28:48', '2023-04-04 09:28:48'),
(9, 1, 2, 35, NULL, 7, '9141d1', NULL, 1, 'pi_3Mt8JDFysF0okTxJ0nIXDU2R', 231.00, 2, '2023-04-04 11:46:12', '2023-04-04 11:46:12'),
(10, 1, 2, 35, NULL, 7, 'dc57eb', NULL, 1, 'pi_3Mt9g8FysF0okTxJ0clARRdf', 24.20, 2, '2023-04-04 13:13:52', '2023-04-04 13:13:52'),
(11, 1, 2, 35, NULL, 7, 'de274e', NULL, 1, 'pi_3MtAF3FysF0okTxJ03Cww6ub', 220.00, 2, '2023-04-04 13:49:59', '2023-04-04 13:49:59'),
(12, 1, 2, 35, NULL, 7, '7a5928', NULL, 1, 'pi_3MtAGlFysF0okTxJ0rcUbDCN', 24.20, 2, '2023-04-04 13:51:41', '2023-04-04 13:51:41'),
(13, 1, 2, 35, NULL, 7, 'e44b99', NULL, 1, 'pi_3MtAJ4FysF0okTxJ1mvM9ZPn', 132.00, 2, '2023-04-04 13:54:04', '2023-04-04 13:54:04'),
(14, 1, 2, 35, NULL, 7, '67674d', NULL, 1, 'pi_3MtAKZFysF0okTxJ1lZoUcNF', 231.00, 2, '2023-04-04 13:55:39', '2023-04-04 13:55:39'),
(15, 1, 2, 35, NULL, 7, '5040de', NULL, 1, 'pi_3MtAT4FysF0okTxJ0ZBa8eXw', 22.00, 2, '2023-04-04 14:04:25', '2023-04-04 14:04:25'),
(16, 1, 2, 35, NULL, 7, '59dec4', NULL, 1, 'pi_3MtAUNFysF0okTxJ0B0e0AWD', 132.00, 2, '2023-04-04 14:05:49', '2023-04-04 14:05:49');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `type` int NOT NULL COMMENT '1=Admin, 2=Dome Owner, 3=User, 4=Employee, 5=Provider',
  `login_type` int NOT NULL DEFAULT '1' COMMENT '1=Email, 2=Google, 3=Apple, 4=Facebook',
  `vendor_id` int DEFAULT NULL COMMENT 'For Workers use only',
  `dome_limit` tinyint DEFAULT NULL COMMENT 'Only For Dome Owqner',
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
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=62 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
