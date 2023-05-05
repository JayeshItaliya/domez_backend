-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 05, 2023 at 03:50 AM
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
  `type` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1=Dome Bookings,  2=League Bookings',
  `vendor_id` int(11) NOT NULL,
  `provider_id` int(11) DEFAULT NULL,
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
  `min_split_amount` double DEFAULT 0 COMMENT 'Minimum Split Payment amount',
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
  `cancelled_by` tinyint(4) DEFAULT NULL COMMENT '1=ByAuto, 2=ByDomeOwner, 3=ByCustomer',
  `cancellation_reason` text DEFAULT NULL,
  `is_payment_released` tinyint(4) NOT NULL DEFAULT 2 COMMENT '1=Yes, 2=No',
  `is_review_noti_send` tinyint(4) DEFAULT 2,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(1, 2, '<h1>Terms &amp; Conditions</h1>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>1. AGREEMENT TO TERMS</strong></p>\r\n\r\n<p>These Terms of Use constitute a legally binding agreement made between you, whether personally or on behalf of an entity (&ldquo;you&rdquo;) and Domez Inc. (&quot;Company&quot;, &ldquo;we&rdquo;, &ldquo;us&rdquo;, or &ldquo;our&rdquo;), concerning your access to and use of the domez.io webmobile application DOMEZ as well as any other media form, media channel, mobile webmobile application DOMEZ or mobile application related, linked, or otherwise connected thereto (collectively, the Mobile application DOMEZ&rdquo;). You agree that by accessing the Mobile application DOMEZ, you have read, understood, and agree to be bound by all of these Terms of Use. IF YOU DO NOT AGREE WITH ALL OF THESE TERMS OF USE, THEN YOU ARE EXPRESSLY PROHIBITED FROM USING THE MOBILE APPLICATION DOMEZ AND YOU MUST DISCONTINUE USE IMMEDIATELY. Supplemental terms and conditions or documents that may be posted on the Mobile application DOMEZ from time to time are hereby expressly incorporated herein by reference. We reserve the right, in our sole discretion, to make changes or modifications to these Terms of Use at any time and for any reason. We will alert you about any changes by updating the &ldquo;Last updated&rdquo; date of these Terms of Use, and you waive any right to receive specific notice of each such change. Please ensure that you check the applicable Terms every time you use our Mobile application DOMEZ so that you understand which Terms apply. You will be subject to, and will be deemed to have been made aware of and to have accepted, the changes in any revised Terms of Use by your continued use of the Mobile application DOMEZ after the date such revised Terms of Use are posted. The information provided on the Mobile application DOMEZ is not intended for distribution to or use by any person or entity in any jurisdiction or country where such distribution or use would be contrary to law or regulation or which would subject us to any registration requirement within such jurisdiction or country. Accordingly, those persons who choose to access the Mobile application DOMEZ from other locations do so on their own initiative and are solely responsible for compliance with local laws, if and to the extent local laws are applicable.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>2. INTELLECTUAL PROPERTY RIGHTS</strong></p>\r\n\r\n<p>Unless otherwise indicated, the Mobile application DOMEZ is our proprietary property and all source code, databases, functionality, software, webmobile application DOMEZ designs, audio, video, text, photographs, and graphics on the Mobile application DOMEZ (collectively, the &ldquo;Content&rdquo;) and the trademarks, service marks, and logos contained therein (the Marks&rdquo;) are owned or controlled by us or licensed to us, and are protected by copyright and trademark laws and various other intellectual property rights and unfair competition laws of the United States, international copyright laws, and international conventions. The Content and the Marks are provided on the Mobile application DOMEZ &ldquo;AS IS&rdquo; for your information and personal use only. Except as expressly provided in these Terms of Use, no part of the Mobile application DOMEZ and no Content or Marks may be copied, reproduced, aggregated, republished, uploaded, posted, publicly displayed, encoded, translated, transmitted, distributed, sold, licensed, or otherwise exploited for any commercial purpose whatsoever, without our express prior written permission. Provided that you are eligible to use the Mobile application DOMEZ, you are granted a limited license to access and use the Mobile application DOMEZ and to download or print a copy of any portion of the Content to which you have properly gained access solely for your personal, non-commercial use. We reserve all rights not expressly granted to you in and to the Mobile application DOMEZ, the Content and the Marks.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>3. USER REPRESENTATIONS</strong></p>\r\n\r\n<p>By using the Mobile application DOMEZ, you represent and warrant that: (1) you have the legal capacity and you agree to comply with these Terms of Use; (2) you are not a minor in the jurisdiction in which you reside; (3) you will not access the Mobile application DOMEZ through automated or nonhuman means, whether through a bot, script or otherwise; (4) you will not use the Mobile application DOMEZ for any illegal or unauthorized purpose; and (5) your use of the Mobile application DOMEZ will not violate any applicable law or regulation. If you provide any information that is untrue, inaccurate, not current, or incomplete, we have the right to suspend or terminate your account and refuse any and all current or future use of the Mobile application DOMEZ (or any portion thereof).</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>4. FEES AND PAYMENT</strong></p>\r\n\r\n<p>We accept the following forms of payment: You may be required&nbsp;to purchase or pay a fee to access some of our services. You&nbsp;agree to provide current, complete, and accurate purchase and&nbsp;account information for all purchases made via the Mobile&nbsp;application DOMEZ. You further agree to promptly update&nbsp;account and payment information, including email address,&nbsp;payment method, and payment card expiration date, so that we&nbsp;can complete your transactions and contact you as needed. We&nbsp;bill you through an online billing account for purchases made via&nbsp;the Mobile application DOMEZ. Sales tax will be added to the&nbsp;price of purchases as deemed required by us. We may change&nbsp;prices at any time. All payments shall be made electronically. You&nbsp;agree to pay all charges or fees at the prices then in effect for&nbsp;your purchases, and you authorize us to charge your chosen&nbsp;payment provider for any such amounts upon making your&nbsp;purchase. We reserve the right to correct any errors or mistakes&nbsp;in pricing, even if we have already requested or received&nbsp;payment. We also reserve the right to r efuse any order placed&nbsp;through the Mobile application DOMEZ.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>5. CANCELLATION</strong></p>\r\n\r\n<p>You can cancel your subscription at any time. Your cancellation&nbsp;will take effect at the end of the current paid term. If you are&nbsp;unsatisfied with our services, please email us at info@domez.io</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>6. PROHIBITED ACTIVITIES</strong></p>\r\n\r\n<p>You may not access or use the Mobile application DOMEZ for any purpose other than that for which we make the Mobile application DOMEZ available. The Mobile application DOMEZ may not be used in connection with any commercial endeavors except those that are specifically endorsed or approved by us. As a user of the Mobile application DOMEZ, you agree not to: Systematically retrieve data or other content from the Mobile application DOMEZ to create or compile, directly or indirectly, a collection, compilation, database, or directory without written permission from us. Trick, defraud, or mislead us and other users, especially in any attempt to learn sensitive account information such as user passwords. Circumvent, disable, or otherwise interfere with security-related features of the Mobile application DOMEZ, including features that prevent or restrict the use or copying of any Content or enforce limitations on the use of the Mobile application DOMEZ and/or the Content contained therein. Disparage, tarnish, or otherwise harm, in our opinion, us and/or the Mobile application DOMEZ. Use any information obtained from the Mobile application DOMEZ in order to harass, abuse, or harm another person. Make improper use of our support services or submit false reports of abuse or misconduct. Use the Mobile application DOMEZ in a manner inconsistent with any applicable laws or regulations. Engage in unauthorized framing of or linking to the Mobile application DOMEZ. Upload or transmit (or attempt to upload or to transmit) viruses, Trojan horses, or other material, including excessive use of capital letters and spamming (continuous posting of repetitive text), that interferes with any party&rsquo;s uninterrupted use and enjoyment of the Mobile application DOMEZ or modifies, impairs, disrupts, alters, or interferes with the use, features, functions, operation, or maintenance of the Mobile application DOMEZ. Engage in any automated use of the system, such as using scripts to send comments or messages, or using any data mining, robots, or similar data gathering and extraction tools. Delete the copyright or other proprietary rights notice from any Content. Attempt to impersonate another user or person or use the username of another user. Upload or transmit (or attempt to upload or to transmit) any material that acts as a passive or active information collection or transmission mechanism, including without limitation, clear graphics interchange formats (&ldquo;gifs&rdquo;), 1&times;1 pixels, web bugs, cookies, or other similar devices (sometimes referred to as &ldquo;spyware&rdquo; or &ldquo;passive collection mechanisms&rdquo; or &ldquo;pcms&rdquo;). Interfere with, disrupt, or create an undue burden on the Mobile application DOMEZ or the networks or services connected to the Mobile application DOMEZ. Harass, annoy, intimidate, or threaten any of our employees or agents engaged in providing any portion of the Mobile application DOMEZ to you. Attempt to bypass any measures of the Mobile application DOMEZ designed to prevent or restrict access to the Mobile application DOMEZ, or any portion of the Mobile application DOMEZ. Copy or adapt the Mobile application DOMEZ&rsquo;s software, including but not limited to Flash, PHP, HTML, JavaScript, or other code. Except as permitted by applicable law, decipher, decompile, disassemble, or reverse engineer any of the software comprising or in any way making up a part of the Mobile application DOMEZ. Except as may be the result of standard search engine or Internet browser usage, use, launch, develop, or distribute any automated system, including without limitation, any spider, robot, cheat utility, scraper, or offline reader that accesses the Mobile application DOMEZ, or using or launching any unauthorized script or other software. Use a buying agent or purchasing agent to make purchases on the Mobile application DOMEZ. Make any unauthorized use of the Mobile application DOMEZ, including collecting usernames and/or email addresses of users by electronic or other means for the purpose of sending unsolicited email, or creating user accounts by automated means or under false pretenses. Use the Mobile application DOMEZ as part of any effort to compete with us or otherwise use the Mobile application DOMEZ and/or the Content for any revenuegenerating endeavor or commercial enterprise.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>7. USER GENERATED CONTRIBUTIONS</strong></p>\r\n\r\n<p>The Mobile application DOMEZ does not offer users to submit or post content. We may provide you with the opportunity to create, submit, post, display, transmit, perform, publish, distribute, or broadcast content and materials to us or on the Mobile application DOMEZ, including but not limited to text, writings, video, audio, photographs, graphics, comments, suggestions, or personal information or other material (collectively, Contributions&quot;). Contributions may be viewable by other users of the Mobile application DOMEZ and through third-party webmobile application DOMEZs. As such, any Contributions you transmit may be treated in accordance with the Mobile application DOMEZ Privacy Policy. When you create or make available any Contributions, you thereby represent and warrant that:</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>8. CONTRIBUTION LICENSE</strong></p>\r\n\r\n<p>You and the Mobile application DOMEZ agree that we may access, store, process, and use any information and personal data that you provide following the terms of the Privacy Policy and your choices (including settings). By submitting suggestions or other feedback regarding the Mobile application DOMEZ, you agree that we can use and share such feedback for any purpose without compensation to you. We do not assert any ownership over your Contributions. You retain full ownership of all of your Contributions and any intellectual property rights or other proprietary rights associated with your Contributions. We are not liable for any statements or representations in your Contributions provided by you in any area on the Mobile application DOMEZ. You are solely responsible for your Contributions to the Mobile application DOMEZ and you expressly agree to exonerate us from any and all responsibility and to refrain from any legal action against us regarding your Contributions.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>9. SUBMISSIONS</strong></p>\r\n\r\n<p>You acknowledge and agree that any questions, comments, suggestions, ideas, feedback, or other information regarding the Mobile application DOMEZ (&quot;Submissions&quot;) provided by you to us are non-confidential and shall become our sole property. We shall own exclusive rights, including all intellectual property rights, and shall be entitled to the unrestricted use and dissemination of these Submissions for any lawful purpose, commercial or otherwise, without acknowledgment or compensation to you. You hereby waive all moral rights to any such Submissions, and you hereby warrant that any such Submissions are original with you or that you have the right to submit such Submissions. You agree there shall be no recourse against us for any alleged or actual infringement or misappropriation of any proprietary right in your Submissions.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>10. MOBILE APPLICATION DOMEZ MANAGEMENT</strong></p>\r\n\r\n<p>We reserve the right, but not the obligation, to: (1) monitor the Mobile application DOMEZ for violations of these Terms of Use; (2) take appropriate legal action against anyone who, in our sole discretion, violates the law or these Terms of Use, including without limitation, reporting such user to law enforcement authorities; (3) in our sole discretion and without limitation, refuse, restrict access to, limit the availability of, or disable (to the extent technologically feasible) any of your Contributions or any portion thereof; (4) in our sole discretion and without limitation, notice, or liability, to remove from the Mobile application DOMEZ or otherwise disable all files and content that are excessive in size or are in any way burdensome to our systems; and (5) otherwise manage the Mobile application DOMEZ in a manner designed to protect our rights and property and to facilitate the proper functioning of the Mobile application DOMEZ.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>11. TERM AND TERMINATION</strong></p>\r\n\r\n<p>These Terms of Use shall remain in full force and effect while you use the Mobile application DOMEZ. WITHOUT LIMITING ANY OTHER PROVISION OF THESE TERMS OF USE, WE RESERVE THE RIGHT TO, IN OUR SOLE DISCRETION AND WITHOUT NOTICE OR LIABILITY, DENY ACCESS TO AND USE OF THE MOBILE APPLICATION DOMEZ (INCLUDING BLOCKING CERTAIN IP ADDRESSES), TO ANY PERSON FOR ANY REASON OR FOR NO REASON, INCLUDING WITHOUT LIMITATION FOR BREACH OF ANY REPRESENTATION, WARRANTY, OR COVENANT CONTAINED IN THESE TERMS OF USE OR OF ANY APPLICABLE LAW OR REGULATION. WE MAY TERMINATE YOUR USE OR PARTICIPATION IN THE MOBILE APPLICATION DOMEZ OR DELETE ANY CONTENT OR INFORMATION THAT YOU POSTED AT ANY TIME, WITHOUT WARNING, IN OUR SOLE DISCRETION. If we terminate or suspend your account for any reason, you are prohibited from registering and creating a new account under your name, a fake or borrowed name, or the name of any third party, even if you may be acting on behalf of the third party. In addition to terminating or suspending your account, we reserve the right to take appropriate legal action, including without limitation pursuing civil, criminal, and injunctive redress.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>12. MODIFICATIONS AND INTERRUPTIONS</strong></p>\r\n\r\n<p>We reserve the right to change, modify, or remove the contents of the Mobile application DOMEZ at any time or for any reason at our sole discretion without notice. However, we have no obligation to update any information on our Mobile application DOMEZ. We also reserve the right to modify or discontinue all or part of the Mobile application DOMEZ without notice at any time. We will not be liable to you or any third party for any modification, price change, suspension, or discontinuance of the Mobile application DOMEZ. We cannot guarantee the Mobile application DOMEZ will be available at all times. We may experience hardware, software, or other problems or need to perform maintenance related to the Mobile application DOMEZ, resulting in interruptions, delays, or errors. We reserve the right to change, revise, update, suspend, discontinue, or otherwise modify the Mobile application DOMEZ at any time or for any reason without notice to you. You agree that we have no liability whatsoever for any loss, damage, or inconvenience caused by your inability to access or use the Mobile application DOMEZ during any downtime or discontinuance of the Mobile application DOMEZ. Nothing in these Terms of Use will be construed to obligate us to maintain and support the Mobile application DOMEZ or to supply any corrections, updates, or releases in connection therewith.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>13. GOVERNING LAW</strong></p>\r\n\r\n<p>These Terms shall be governed by and defined following the laws of Ontario, Canada, and yourself irrevocably consent that the courts of Canada shall have exclusive jurisdiction to resolve any dispute which may arise in connection with these terms.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>14. DISPUTE RESOLUTION</strong></p>\r\n\r\n<p>Informal Negotiations To expedite resolution and control the cost of any dispute, controversy, or claim related to these Terms of Use (each Dispute&quot; and collectively, the &ldquo;Disputes&rdquo;) brought by either you or us individually, a &ldquo;Party&rdquo; and collectively, the &ldquo;Parties&rdquo;), the Parties agree to first attempt to negotiate any Dispute (except those Disputes expressly provided below) informally for at least 30 days before initiating the arbitration. Such informal negotiations commence upon written notice from one Party to the other Party. Binding Arbitration Any dispute arising out of or in connection with this contract, including any question regarding its existence, validity, or termination, shall be referred to and finally resolved by the International Commercial Arbitration Court under the European Arbitration Chamber (Belgium, Brussels, Avenue Louise, 146) according to the Rules of this ICAC, which, as a result of referring to it, is considered as the part of this clause. The number of arbitrators shall be four, The seat, or legal place, of arbitration, shall be three The language to be used in the arbitral proceedings shall be English. The governing law of the contract shall be the substantive law of Canada. Restrictions The Parties agree that any arbitration shall be limited to the Dispute between the Parties individually. To the full extent permitted by law, (a) no arbitration shall be joined with any other proceeding; (b) there is no right or authority for any Dispute to be arbitrated on a class-action basis or to utilize class action procedures; and (c) there is no right or authority for any Dispute to be brought in a purported representative capacity on behalf of the general public or any other persons. Exceptions to Informal Negotiations and Arbitration The Parties agree that the following Disputes are not subject to the above provisions concerning informal negotiations and binding arbitration: (a) any Disputes seeking to enforce or protect, or concerning the validity of, any of the intellectual property rights of a Party; b) any Dispute related to, or arising from, allegations of theft, piracy, invasion of privacy, or unauthorized use; and (c) any claim for injunctive relief. If this provision is found to be illegal or unenforceable, then neither Party will elect to arbitrate any Dispute falling within that portion of this provision found to be illegal or unenforceable and such Dispute shall be decided by a court of competent jurisdiction within the courts listed for jurisdiction above, and the Parties agree to submit to the personal jurisdiction of that court.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>15. CORRECTIONS</strong></p>\r\n\r\n<p>There may be information on the Mobile application DOMEZ that contains typographical errors, inaccuracies, or omissions, including descriptions, pricing, availability, and various other information. We reserve the right to correct any errors, inaccuracies, or omissions and to change or update the information on the Mobile application DOMEZ at any time, without prior notice.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>16. DISCLAIMER</strong></p>\r\n\r\n<p>THE MOBILE APPLICATION DOMEZ IS PROVIDED ON AN AS-IS AND ASAVAILABLE BASIS. YOU AGREE THAT YOUR USE OF THE MOBILE APPLICATION DOMEZ AND OUR SERVICES WILL BE AT YOUR SOLE RISK. TO THE FULLEST EXTENT PERMITTED BY LAW, WE DISCLAIM ALL WARRANTIES, EXPRESS OR IMPLIED, IN CONNECTION WITH THE MOBILE APPLICATION DOMEZ AND YOUR USE THEREOF, INCLUDING, WITHOUT LIMITATION, THE IMPLIED WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE, AND NON-INFRINGEMENT. WE MAKE NO WARRANTIES OR REPRESENTATIONS ABOUT THE ACCURACY OR COMPLETENESS OF THE MOBILE APPLICATION DOMEZ&rsquo;S CONTENT OR THE CONTENT OF ANY WEBMOBILE APPLICATION DOMEZS LINKED TO THE MOBILE APPLICATION DOMEZ AND WE WILL ASSUME NO LIABILITY OR RESPONSIBILITY FOR ANY (1) ERRORS, MISTAKES, OR INACCURACIES OF CONTENT AND MATERIALS, (2) PERSONAL INJURY OR PROPERTY DAMAGE, OF ANY NATURE WHATSOEVER, RESULTING FROM YOUR ACCESS TO AND USE OF THE MOBILE APPLICATION DOMEZ, (3) ANY UNAUTHORIZED ACCESS TO OR USE OF OUR SECURE SERVERS AND/OR ANY AND ALL PERSONAL INFORMATION AND/OR FINANCIAL INFORMATION STORED THEREIN, (4) ANY INTERRUPTION OR CESSATION OF TRANSMISSION TO OR FROM THE MOBILE APPLICATION DOMEZ, (5) ANY BUGS, VIRUSES, TROJAN HORSES, OR THE LIKE WHICH MAY BE TRANSMITTED TO OR THROUGH THE MOBILE APPLICATION DOMEZ BY ANY THIRD PARTY, AND/OR (6) ANY ERRORS OR OMISSIONS IN ANY CONTENT AND MATERIALS OR FOR ANY LOSS OR DAMAGE OF ANY KIND INCURRED AS A RESULT OF THE USE OF ANY CONTENT POSTED, TRANSMITTED, OR OTHERWISE MADE AVAILABLE VIA THE MOBILE APPLICATION DOMEZ. WE DO NOT WARRANT, ENDORSE, GUARANTEE, OR ASSUME RESPONSIBILITY FOR ANY PRODUCT OR SERVICE ADVERTISED OR OFFERED BY A THIRD PARTY THROUGH THE MOBILE APPLICATION DOMEZ, ANY HYPERLINKED WEBMOBILE APPLICATION DOMEZ, OR ANY WEBMOBILE APPLICATION DOMEZ OR MOBILE APPLICATION FEATURED IN ANY BANNER OR OTHER ADVERTISING, AND WE WILL NOT BE A PARTY TO OR IN ANY WAY BE RESPONSIBLE FOR MONITORING ANY TRANSACTION BETWEEN YOU AND ANY THIRD-PARTY PROVIDERS OF PRODUCTS OR SERVICES. AS WITH THE PURCHASE OF A PRODUCT OR SERVICE THROUGH ANY MEDIUM OR IN ANY ENVIRONMENT, YOU SHOULD USE YOUR BEST JUDGMENT AND EXERCISE CAUTION WHERE APPROPRIATE.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>17. LIMITATIONS OF LIABILITY</strong></p>\r\n\r\n<p>IN NO EVENT WILL WE OR OUR DIRECTORS, EMPLOYEES, OR AGENTS BE LIABLE TO YOU OR ANY THIRD PARTY FOR ANY DIRECT, INDIRECT, CONSEQUENTIAL, EXEMPLARY, INCIDENTAL, SPECIAL, OR PUNITIVE DAMAGES, INCLUDING LOST PROFIT, LOST REVENUE, LOSS OF DATA, OR OTHER DAMAGES ARISING FROM YOUR USE OF THE MOBILE APPLICATION DOMEZ, EVEN IF WE HAVE BEEN ADVISED OF THE POSSIBILITY OF SUCH DAMAGES. NOTWITHSTANDING ANYTHING TO THE CONTRARY CONTAINED HEREIN, OUR LIABILITY TO YOU FOR ANY CAUSE WHATSOEVER AND REGARDLESS OF THE FORM OF THE ACTION WILL AT ALL TIMES BE LIMITED TO THE LESSER OF THE AMOUNT PAID, IF ANY, BY YOU TO US OR OTHER PARTIES CERTAIN US STATE LAWS AND INTERNATIONAL LAWS DO NOT ALLOW LIMITATIONS ON IMPLIED WARRANTIES OR THE EXCLUSION OR LIMITATION OF CERTAIN DAMAGES. IF THESE LAWS APPLY TO YOU, SOME OR ALL OF THE ABOVE DISCLAIMERS OR LIMITATIONS MAY NOT APPLY TO YOU, AND YOU MAY HAVE ADDITIONAL RIGHTS.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>18. INDEMNIFICATION</strong></p>\r\n\r\n<p>You agree to defend, indemnify, and hold us harmless, including our subsidiaries, affiliates, and all of our respective officers, agents, partners, and employees, from and against any loss, damage, liability, claim, or demand, including reasonable attorneys&rsquo; fees and expenses, made by any third party due to or arising out of: (1) use of the Mobile application DOMEZ; (2) breach of these Terms of Use; (3) any breach of your representations and warranties set forth in these Terms of Use; (4) your violation of the rights of a third party, including but not limited to intellectual property rights; or (5) any overt harmful act toward any other user of the Mobile application DOMEZ with whom you connected via the Mobile application DOMEZ. Notwithstanding the foregoing, we reserve the right, at your expense, to assume the exclusive defense and control of any matter for which you are required to indemnify us, and you agree to cooperate, at your expense, with our defense of such claims. We will use reasonable efforts to notify you of any such claim, action, or proceeding which is subject to this indemnification upon becoming aware of it.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>19. USER DATA</strong></p>\r\n\r\n<p>We will maintain certain data that you transmit to the Mobile application DOMEZ for the purpose of managing the performance of the Mobile application DOMEZ, as well as data relating to your use of the Mobile application DOMEZ. Although we perform regular routine backups of data, you are solely responsible for all data that you transmit or that relates to any activity you have undertaken using the Mobile application DOMEZ. You agree that we shall have no liability to you for any loss or corruption of any such data, and you hereby waive any right of action against us arising from any such loss or corruption of such data.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>20. ELECTRONIC COMMUNICATIONS, TRANSACTIONS, AND SIGNATURES</strong></p>\r\n\r\n<p>Visiting the Mobile application DOMEZ, sending us emails, and completing online forms constitute electronic communications. You consent to receive electronic communications, and you agree that all agreements, notices, disclosures, and other communications we provide to you electronically, via email and on the Mobile application DOMEZ, satisfy any legal requirement that such communication be in writing. YOU HEREBY AGREE TO THE USE OF ELECTRONIC SIGNATURES, CONTRACTS, ORDERS, AND OTHER RECORDS AND TO THE ELECTRONIC DELIVERY OF NOTICES, POLICIES, AND RECORDS OF TRANSACTIONS INITIATED OR COMPLETED BY US OR VIA THE MOBILE APPLICATION DOMEZ. You hereby waive any rights or requirements under any statutes, regulations, rules, ordinances, or other laws in any jurisdiction which require an original signature or delivery or retention of non-electronic records, or to payments or the granting of credits by any means other than electronic means.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>21. MISCELLANEOUS</strong></p>\r\n\r\n<p>These Terms of Use and any policies or operating rules posted by us on the Mobile application DOMEZ or in respect to the Mobile application DOMEZ constitute the entire agreement and understanding between you and us. Our failure to exercise or enforce any right or provision of these Terms of Use shall not operate as a waiver of such right or provision. These Terms of Use operate to the fullest extent permissible by law. We may assign any or all of our rights and obligations to others at any time. We shall not be responsible or liable for any loss, damage, delay, or failure to act caused by any cause beyond our reasonable control. If any provision or part of a provision of these Terms of Use is determined to be unlawful, void, or unenforceable, that provision or part of the provision is deemed severable from these Terms of Use and does not affect the validity and enforceability of any remaining provisions. There is no joint venture, partnership, employment or agency relationship created between you and us as a result of these Terms of Use or use of the Mobile application DOMEZ. You agree that these Terms of Use will not be construed against us by virtue of having drafted them. You hereby waive any and all defenses you may have based on the electronic form of these Terms of Use and the lack of signing by the parties hereto to execute these Terms of Use.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>22. CONTACT US</strong></p>\r\n\r\n<p>In order to resolve a complaint regarding the Mobile application DOMEZ or to receive further information regarding use of the Mobile application DOMEZ, please contact us at: dev@domez.io</p>', '2023-03-10 04:36:27', '2023-04-14 10:31:45'),
(2, 1, '<h1>Privacy Policy</h1>\r\n\r\n<p>We at Most Advanced Booking System For Your Dome take your privacy seriously. This Privacy Policy outlines our practices for collecting, using, maintaining, protecting, and disclosing your information when you use our website.</p>\r\n\r\n<p>Please read this Privacy Policy carefully to understand our policies and practices regarding your information and how we will treat it. By accessing or using our website, you agree to this Privacy Policy. This Privacy Policy may change from time to time. Your continued use of our website after we make changes is deemed to be acceptance of those changes, so please check this Privacy Policy periodically for updates.</p>\r\n\r\n<h2>Information We Collect</h2>\r\n\r\n<p>We may collect personal information from you, such as your name, email address, and phone number, when you use our website. We may also collect non-personal information, such as your IP address and browser type, when you use our website.</p>\r\n\r\n<h2>How We Use Your Information</h2>\r\n\r\n<p>We may use your personal information to contact you, respond to your inquiries, and provide you with information about our services. We may also use your non-personal information to improve our website and customize your user experience.</p>\r\n\r\n<h2>How We Protect Your Information</h2>\r\n\r\n<p>We take reasonable measures to protect your information from unauthorized access, use, or disclosure. However, no method of transmission over the Internet or electronic storage is completely secure, so we cannot guarantee absolute security.</p>\r\n\r\n<h2>Disclosure of Your Information</h2>\r\n\r\n<p>We may disclose your information to third-party service providers who assist us in operating our website or providing our services. We may also disclose your information required by or we that disclosure is necessary to protect our rights, your safety, or the safety of others.</p>\r\n\r\n<h2>Links to Other Websites</h2>\r\n\r\n<p>Our website may contain links to other websites that are not owned or operated by us. We are not responsible for the privacy practices or content of these websites. We encourage you to read the privacy policies of these websites.</p>\r\n\r\n<h2>Contacting Us</h2>\r\n\r\n<p>If you have any questions or comments about this Privacy Policy or our practices, please contact us at info@domez.io</p>\r\n\r\n<h2>Effective Date</h2>\r\n\r\n<p>This Privacy Policy is effective as of January 1, 2023.</p>', '2023-03-10 04:37:12', '2023-04-12 11:02:02'),
(3, 4, '<h1>Cancellation Policy:</h1>  <p>&nbsp;</p>  <h4>Cancellation by the User:</h4> <p>If you cancel your booking at least more than 2 hours before the scheduled start time, you will receive a refund minus a 3% cancellation fee.</p>  <p>You will not receive a refund if you cancel your booking less than 2 hours before the scheduled start time.</p>  <p>&nbsp;</p>  <h4>Cancellation by the Service Provider:</h4>  <p>If the service provider cancels your booking for any reason, you will receive a full refund.</p>  <p>If the service provider cancels your booking due to unforeseen circumstances such as weather conditions or equipment failure), you will receive a full refund or the option to reschedule your booking.</p>  <p>&nbsp;</p>  <h4>No-Show Policy:</h4>  <p>If you do not show up for your booking without prior notice, you will not receive a refund.</p>  <p>Please note that the above policies may be subject to change and may vary depending on the service provider you choose. We recommend that you carefully review the specific service provider&#39;s cancellation policy before booking.</p>', '2023-03-31 01:43:18', '2023-04-12 13:48:44'),
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

INSERT INTO `domes` (`id`, `vendor_id`, `sport_id`, `name`, `price`, `hst`, `address`, `pin_code`, `city`, `state`, `country`, `slot_duration`, `description`, `lat`, `lng`, `benefits`, `benefits_description`, `is_deleted`, `created_at`, `updated_at`) VALUES
(35, 2, '6,7,8,10', 'Domez', 0.00, 5.00, 'Costen Tax Solutions, Inc, Birdneck Road North, Virginia Beach, VA, USA', '23451', 'Summerside', 'Prince Edward Island', 'Canada', 1, 'DESCRIPTION', '28.5156729', '-81.4824233', 'Free Wifi|Changing Room|Parking|Pool|Others', 'Our All sports boasts an impressive range of amenities, all designed to enhance your experience and ensure you have everything you need to make the most of your time on the field. From ample parking to clean and modern restroom facilities, we strive to provide a comfortable and enjoyable environment for all our guests. Our well-maintained playing surface is perfect for a variety of sports, and we offer an array of equipment to help you get the most out of your game. Additionally, our knowledgeable staff is always available to assist you with any questions or concerns you may have. Come experience the best in sports field amenities with us!', 2, '2023-02-20 03:57:09', '2023-05-04 05:35:33'),
(55, 2, '6,7,8,9,10,11,12', 'Sora Dome', 0.00, 16.00, 'VIP Circle, Uttran, Surat, Gujarat, India', '394105', 'Surat', 'Gujarat', 'India', 1, 'Lorem Is Ip[sum. Lorem Is Ip[sum. Lorem Is Ip[sum. Lorem Is Ip[sum. Lorem Is Ip[sum. Lorem Is Ip[sum', '21.2316919', '72.8662349', '', 'Lorem Is Ip[sum. Lorem Is Ip[sum. Lorem Is Ip[sum. Lorem Is Ip[sum. Lorem Is Ip[sum. Lorem Is Ip[sum', 2, '2023-05-02 12:24:13', '2023-05-03 05:53:01'),
(56, 97, '6,7,8,9,10,11,12', 'Shott', 0.00, 18.00, 'SHOTT Mumbai, New Link Road, Sahayog Nagar, Bhudargarh Colony, Andheri West, Mumbai, Maharashtra, India', '400053', 'Mumbai', 'Maharashtra', 'India', 1, 'test', '19.1309003', '72.83086209999999', 'Free Wifi|Changing Room|Parking|Pool|Others', 'test', 2, '2023-05-04 10:38:49', '2023-05-04 12:36:23');

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
(34, NULL, 1, 'league-6437ba0ebcf322.png', '2023-02-20 05:06:09', '2023-02-20 05:06:09'),
(35, NULL, 11, 'league-63f33f137daf5.png', '2023-02-20 05:06:44', '2023-02-20 05:06:44'),
(41, NULL, 16, 'league-6437ba0ebcf32.png', '2023-04-13 08:15:10', '2023-04-13 08:15:10'),
(42, 53, NULL, 'dome-643f94fc606fb.jpg', '2023-04-19 07:15:08', '2023-04-19 07:15:08'),
(44, NULL, 23, 'league-643fdb1dc68c5.png', '2023-04-19 12:14:21', '2023-04-19 12:14:21'),
(45, NULL, 24, 'league-644f51a80b480.jpg', '2023-05-01 05:44:08', '2023-05-01 05:44:08'),
(46, 55, NULL, 'dome-645100ed0b24d.png', '2023-05-02 12:24:13', '2023-05-02 12:24:13'),
(47, 56, NULL, 'dome-64538b39b7c36.jpg', '2023-05-04 10:38:49', '2023-05-04 10:38:49'),
(48, 56, NULL, 'dome-64538b39b8fc6.png', '2023-05-04 10:38:49', '2023-05-04 10:38:49');

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
  `is_accepted` tinyint(1) NOT NULL DEFAULT 2 COMMENT '1=Yes, 2=Pending, 3=No',
  `is_deleted` tinyint(1) NOT NULL DEFAULT 2 COMMENT '1=Yes, 2=No',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `enquiries`
--

INSERT INTO `enquiries` (`id`, `vendor_id`, `type`, `dome_name`, `dome_zipcode`, `dome_city`, `dome_state`, `dome_country`, `venue_name`, `venue_address`, `name`, `email`, `phone`, `subject`, `message`, `is_replied`, `is_accepted`, `is_deleted`, `created_at`, `updated_at`) VALUES
(1, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'shivakar@gmail.com', NULL, 'heyyya', 'hello big big issues', 2, 2, 2, '2023-04-06 09:58:12', '2023-04-09 04:17:30'),
(3, NULL, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'James', 'james@yopmail.com', NULL, 'Lorem Ipsum', 'Lorem si dummy text to ttyype settiugng Lorem si dummy text to ttyype settiugng Lorem si dummy text to ttyype settiugng Lorem si dummy text to ttyype settiugng Lorem si dummy text to ttyype settiugng Lorem si dummy text to ttyype settiugng Lorem si dummy ', 2, 2, 2, '2023-04-09 04:21:49', '2023-04-09 04:21:49'),
(5, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'dummy@yopmail.com', NULL, 'dome inquiry', 'I have one dome.Can I join with you?', 2, 2, 2, '2023-04-12 11:59:22', '2023-04-12 11:59:22'),
(6, NULL, 4, NULL, NULL, NULL, NULL, NULL, 'asdfs', 'asd', 'soham', 'dummy@yopmail.com', NULL, NULL, '', 2, 2, 2, '2023-04-12 12:40:59', '2023-04-12 12:40:59'),
(7, NULL, 4, NULL, NULL, NULL, NULL, NULL, 'dscdsfdsew', 'dswfdsf', NULL, 'dummy@yopmail.com', NULL, NULL, '', 2, 2, 2, '2023-04-12 13:12:29', '2023-04-12 13:12:29'),
(11, 96, 3, 'test', 'test', 'test', 'test', 'test', NULL, 'test', 'Rahul Ghaskata', 'rahul.vrajtechnosys@gmail.com', '0123456798', NULL, NULL, 2, 2, 2, '2023-04-27 13:09:50', '2023-04-27 13:09:50'),
(12, 97, 3, 'Shott', NULL, 'test', 'test', 'test', NULL, 'test', 'hiren', 'hiren@yopmail.com', '1234567890', NULL, NULL, 1, 1, 2, '2023-05-04 10:32:11', '2023-05-04 10:33:54');

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
(2, 2, 35, '10', '2', 452.00, 5, 30, 'field-6712.jpg', NULL, 2, 1, 2, '2023-02-20 05:57:52', '2023-04-12 11:24:28'),
(8, 2, 35, '10', '3', 452.00, 10, 20, 'field-3851.jpg', NULL, 2, 1, 2, '2023-02-20 05:57:52', '2023-04-26 07:02:49'),
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
(57, 2, 35, '12', '5', 0.00, 10, 20, 'field-8987.jpg', '2023-04-28', 1, 1, 2, '2023-03-16 06:43:04', '2023-04-14 08:57:01'),
(58, 51, 53, '10', '31', 200.00, 2, 20, 'field-643faca34fc45.jpg', NULL, 2, 1, 2, '2023-04-19 08:56:03', '2023-04-19 09:12:11'),
(59, 97, 56, '12', '1', 500.00, 6, 19, 'field-64538b61202e7.png', NULL, 2, 1, 2, '2023-05-04 10:39:29', '2023-05-04 10:39:29'),
(60, 97, 56, '11', '1', 200.00, 4, 22, 'field-64538ba2c2f6f.jpg', NULL, 2, 1, 2, '2023-05-04 10:40:34', '2023-05-04 10:40:34'),
(61, 97, 56, '10', '1', 300.00, 3, 15, 'field-64538bb8bbec0.png', NULL, 2, 1, 2, '2023-05-04 10:40:56', '2023-05-04 10:40:56'),
(62, 97, 56, '9', '1', 10000.00, 12, 24, 'field-64538be2ba846.jpg', NULL, 2, 1, 2, '2023-05-04 10:41:38', '2023-05-04 10:41:38'),
(63, 97, 56, '8', '1', 400.00, 6, 18, 'field-64538bf8ee281.png', NULL, 2, 1, 2, '2023-05-04 10:42:00', '2023-05-04 10:42:00');

-- --------------------------------------------------------

--
-- Table structure for table `leagues`
--

CREATE TABLE `leagues` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `vendor_id` int(11) NOT NULL,
  `provider_id` int(11) DEFAULT NULL,
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

INSERT INTO `leagues` (`id`, `vendor_id`, `provider_id`, `dome_id`, `field_id`, `sport_id`, `name`, `booking_deadline`, `start_date`, `end_date`, `start_time`, `end_time`, `from_age`, `to_age`, `gender`, `min_player`, `max_player`, `team_limit`, `price`, `is_deleted`, `created_at`, `updated_at`) VALUES
(1, 2, NULL, 35, '32,30', 6, 'The Golf League', '2023-05-25', '2023-05-26', '2023-08-25', '09:00 AM', '01:00 PM', 16, 28, 1, 12, 17, 13, 350, 2, '2023-02-20 06:56:50', '2023-04-13 13:04:10'),
(11, 2, NULL, 35, '35,33,32,31,30', 6, 'The Soccer League', '2023-04-30', '2023-05-01', '2023-06-30', '09:00 AM', '11:00 AM', 16, 28, 1, 12, 17, 13, 250, 2, '2023-02-20 06:56:50', '2023-04-02 12:30:39'),
(16, 2, NULL, 35, '35,33,32,31,30', 6, 'The Volleyball League', '2023-04-27', '2023-04-28', '2023-07-28', '09:00 AM', '03:00 PM', 16, 28, 1, 12, 17, 13, 150, 2, '2023-02-20 06:56:50', '2023-04-13 13:03:49'),
(23, 51, 93, 53, '58', 10, 'Lorem League', '2023-05-14', '2023-05-15', '2023-05-31', '11:00 AM', '02:00 PM', 12, 26, 1, 2, 9, 6, 400, 2, '2023-04-19 12:14:21', '2023-04-19 12:14:21'),
(24, 2, NULL, 35, '20,14', 10, 'Jamews', '2023-05-02', '2023-05-03', '2023-05-24', '06:00 AM', '10:00 AM', 24, 28, 1, 8, 13, 5, 1220, 2, '2023-05-01 05:44:08', '2023-05-01 05:44:08'),
(25, 2, NULL, 35, '26,20,8', 10, 'gbgbgb', '2023-05-01', '2023-05-02', '2023-06-03', '07:00 AM', '11:00 AM', 50, 50, 1, 30, 30, 5, 120, 2, '2023-05-01 09:03:24', '2023-05-01 09:03:24');

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
(16, '2023_02_17_092343_create_leagues_table', 14),
(17, '2023_05_02_170442_create_working_hours_table', 15);

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
(1, 1, 1, '', 'pk_test_51LlAvQFysF0okTxJcqvqe5FuA6eGnvPGx09mjkD9XamI1ZY3JDyRZyfI0yMohFkUmYfrYaQVkTqqqXwLtcu5DL4q00sg52wJEO', 'sk_test_51LlAvQFysF0okTxJjCODF1rt79hZpNypYCfAAUaSgy9EGXbg5dL3h9a93rxNCgXMpBJEFETvdWO1y5xyClOxn6D200JgDzWUe5', '2022-11-22 00:35:31', '2023-04-04 05:53:07'),
(2, 1, 2, 'acct_1MtkxuKQdlw84kQX', NULL, NULL, '2023-04-04 05:55:59', '2023-04-17 10:22:33'),
(3, 1, 51, 'acct_1Mxpi2SE0Vpmtyar', NULL, NULL, '2023-04-17 05:03:35', '2023-04-17 05:25:29');

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
(3, 35, 35, 7, 4, 'Lorem Ipsum', NULL, NULL, '2023-04-12 11:27:57', '2023-04-12 11:27:57');

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
(1, 2, 35, 6, NULL, NULL, 1, 150, '2023-05-03 09:57:07', '2023-05-04 05:35:33'),
(2, 2, 35, 7, NULL, NULL, 1, 180, '2023-05-03 09:57:07', '2023-05-04 05:35:33'),
(3, 2, 35, 8, NULL, NULL, 1, 190, '2023-05-03 09:57:07', '2023-05-04 05:35:33'),
(4, 2, 35, 10, NULL, NULL, 1, 110, '2023-05-03 09:57:07', '2023-05-04 05:35:33'),
(6, 2, 35, 10, '2023-06-01', '2023-07-31', 2, 0, '2023-05-03 12:22:14', '2023-05-03 12:22:14'),
(7, 97, 56, 6, NULL, NULL, 1, 150, '2023-05-04 10:38:49', '2023-05-04 10:38:49'),
(8, 97, 56, 7, NULL, NULL, 1, 151, '2023-05-04 10:38:49', '2023-05-04 10:38:49'),
(9, 97, 56, 8, NULL, NULL, 1, 51, '2023-05-04 10:38:49', '2023-05-04 10:38:49'),
(10, 97, 56, 9, NULL, NULL, 1, 515, '2023-05-04 10:38:49', '2023-05-04 10:38:49'),
(11, 97, 56, 10, NULL, NULL, 1, 514, '2023-05-04 10:38:49', '2023-05-04 10:38:49'),
(12, 97, 56, 11, NULL, NULL, 1, 521, '2023-05-04 10:38:49', '2023-05-04 10:38:49'),
(13, 97, 56, 12, NULL, NULL, 1, 215, '2023-05-04 10:38:49', '2023-05-04 10:38:49'),
(14, 97, 56, 12, '2023-05-11', '2023-05-31', 2, 0, '2023-05-04 12:40:00', '2023-05-04 12:40:00');

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
(1, 6, 35, 10, '2023-06-01', '10:00:00', '11:30:00', 'thursday', 150, 1, '2023-05-03 12:22:14', '2023-05-03 12:22:14'),
(2, 6, 35, 10, '2023-06-01', '11:30:00', '13:00:00', 'thursday', 150, 1, '2023-05-03 12:22:14', '2023-05-03 12:22:14'),
(3, 6, 35, 10, '2023-06-01', '13:00:00', '14:00:00', 'thursday', 100, 1, '2023-05-03 12:22:14', '2023-05-03 12:22:14'),
(4, 6, 35, 10, '2023-06-02', '12:00:00', '13:30:00', 'friday', 100, 1, '2023-05-03 12:22:14', '2023-05-03 12:22:14'),
(5, 6, 35, 10, '2023-06-02', '13:30:00', '15:00:00', 'friday', 140, 1, '2023-05-03 12:22:14', '2023-05-03 12:22:14'),
(6, 6, 35, 10, '2023-06-02', '15:00:00', '16:30:00', 'friday', 150, 1, '2023-05-03 12:22:14', '2023-05-03 12:22:14'),
(7, 6, 35, 10, '2023-06-02', '16:30:00', '17:00:00', 'friday', 120, 1, '2023-05-03 12:22:14', '2023-05-03 12:22:14'),
(8, 6, 35, 10, '2023-06-03', '10:00:00', '11:30:00', 'saturday', 100, 1, '2023-05-03 12:22:14', '2023-05-03 12:22:14'),
(9, 6, 35, 10, '2023-06-03', '11:30:00', '13:00:00', 'saturday', 150, 1, '2023-05-03 12:22:14', '2023-05-03 12:22:14'),
(10, 6, 35, 10, '2023-06-03', '13:00:00', '14:30:00', 'saturday', 120, 1, '2023-05-03 12:22:14', '2023-05-03 12:22:14'),
(11, 6, 35, 10, '2023-06-03', '14:30:00', '16:00:00', 'saturday', 130, 1, '2023-05-03 12:22:14', '2023-05-03 12:22:14'),
(12, 6, 35, 10, '2023-06-03', '16:00:00', '17:00:00', 'saturday', 140, 1, '2023-05-03 12:22:14', '2023-05-03 12:22:14'),
(13, 6, 35, 10, '2023-06-04', '11:00:00', '12:30:00', 'sunday', 10, 1, '2023-05-03 12:22:14', '2023-05-03 12:22:14'),
(14, 6, 35, 10, '2023-06-04', '12:30:00', '14:00:00', 'sunday', 20, 1, '2023-05-03 12:22:14', '2023-05-03 12:22:14'),
(15, 6, 35, 10, '2023-06-04', '14:00:00', '15:30:00', 'sunday', 30, 1, '2023-05-03 12:22:14', '2023-05-03 12:22:14'),
(16, 6, 35, 10, '2023-06-04', '15:30:00', '16:00:00', 'sunday', 40, 1, '2023-05-03 12:22:14', '2023-05-03 12:22:14'),
(17, 6, 35, 10, '2023-06-05', '07:00:00', '08:30:00', 'monday', 150, 1, '2023-05-03 12:22:14', '2023-05-03 12:22:14'),
(18, 6, 35, 10, '2023-06-05', '08:30:00', '10:00:00', 'monday', 140, 1, '2023-05-03 12:22:14', '2023-05-03 12:22:14'),
(19, 6, 35, 10, '2023-06-05', '10:00:00', '11:30:00', 'monday', 120, 1, '2023-05-03 12:22:14', '2023-05-03 12:22:14'),
(20, 6, 35, 10, '2023-06-05', '11:30:00', '13:00:00', 'monday', 130, 1, '2023-05-03 12:22:14', '2023-05-03 12:22:14'),
(21, 6, 35, 10, '2023-06-05', '13:00:00', '14:30:00', 'monday', 170, 1, '2023-05-03 12:22:14', '2023-05-03 12:22:14'),
(22, 6, 35, 10, '2023-06-05', '14:30:00', '16:00:00', 'monday', 180, 1, '2023-05-03 12:22:14', '2023-05-03 12:22:14'),
(23, 6, 35, 10, '2023-06-05', '16:00:00', '17:30:00', 'monday', 130, 1, '2023-05-03 12:22:14', '2023-05-03 12:22:14'),
(24, 6, 35, 10, '2023-06-05', '17:30:00', '18:00:00', 'monday', 140, 1, '2023-05-03 12:22:14', '2023-05-03 12:22:14'),
(81, 6, 35, 10, '2023-06-06', '12:00:00', '13:30:00', 'tuesday', 11, 1, '2023-05-03 12:22:14', '2023-05-03 12:22:14'),
(82, 6, 35, 10, '2023-06-06', '13:30:00', '15:00:00', 'tuesday', 22, 1, '2023-05-03 12:22:14', '2023-05-03 12:22:14'),
(83, 6, 35, 10, '2023-06-06', '15:00:00', '16:30:00', 'tuesday', 33, 1, '2023-05-03 12:22:14', '2023-05-03 12:22:14'),
(84, 6, 35, 10, '2023-06-06', '16:30:00', '18:00:00', 'tuesday', 44, 1, '2023-05-03 12:22:14', '2023-05-03 12:22:14'),
(85, 6, 35, 10, '2023-06-06', '18:00:00', '19:00:00', 'tuesday', 150, 1, '2023-05-03 12:22:14', '2023-05-03 12:22:14'),
(86, 6, 35, 10, '2023-06-07', '09:00:00', '10:30:00', 'wednesday', 140, 1, '2023-05-03 12:22:14', '2023-05-03 12:22:14'),
(87, 6, 35, 10, '2023-06-07', '10:30:00', '12:00:00', 'wednesday', 150, 1, '2023-05-03 12:22:14', '2023-05-03 12:22:14'),
(88, 6, 35, 10, '2023-06-07', '12:00:00', '13:30:00', 'wednesday', 120, 1, '2023-05-03 12:22:14', '2023-05-03 12:22:14'),
(89, 6, 35, 10, '2023-06-07', '13:30:00', '15:00:00', 'wednesday', 110, 1, '2023-05-03 12:22:14', '2023-05-03 12:22:14'),
(90, 6, 35, 10, '2023-06-07', '15:00:00', '16:30:00', 'wednesday', 100, 1, '2023-05-03 12:22:14', '2023-05-03 12:22:14'),
(91, 6, 35, 10, '2023-06-07', '16:30:00', '17:00:00', 'wednesday', 190, 1, '2023-05-03 12:22:14', '2023-05-03 12:22:14'),
(92, 6, 35, 10, '2023-06-08', '10:00:00', '11:30:00', 'thursday', 150, 1, '2023-05-03 12:22:14', '2023-05-03 12:22:14'),
(93, 6, 35, 10, '2023-06-08', '11:30:00', '13:00:00', 'thursday', 150, 1, '2023-05-03 12:22:14', '2023-05-03 12:22:14'),
(94, 6, 35, 10, '2023-06-08', '13:00:00', '14:00:00', 'thursday', 100, 1, '2023-05-03 12:22:14', '2023-05-03 12:22:14'),
(95, 6, 35, 10, '2023-06-09', '12:00:00', '13:30:00', 'friday', 100, 1, '2023-05-03 12:22:14', '2023-05-03 12:22:14'),
(96, 6, 35, 10, '2023-06-09', '13:30:00', '15:00:00', 'friday', 140, 1, '2023-05-03 12:22:14', '2023-05-03 12:22:14'),
(97, 6, 35, 10, '2023-06-09', '15:00:00', '16:30:00', 'friday', 150, 1, '2023-05-03 12:22:14', '2023-05-03 12:22:14'),
(98, 6, 35, 10, '2023-06-09', '16:30:00', '17:00:00', 'friday', 120, 1, '2023-05-03 12:22:14', '2023-05-03 12:22:14'),
(99, 6, 35, 10, '2023-06-10', '10:00:00', '11:30:00', 'saturday', 100, 1, '2023-05-03 12:22:14', '2023-05-03 12:22:14'),
(100, 6, 35, 10, '2023-06-10', '11:30:00', '13:00:00', 'saturday', 150, 1, '2023-05-03 12:22:14', '2023-05-03 12:22:14'),
(101, 6, 35, 10, '2023-06-10', '13:00:00', '14:30:00', 'saturday', 120, 1, '2023-05-03 12:22:14', '2023-05-03 12:22:14'),
(102, 6, 35, 10, '2023-06-10', '14:30:00', '16:00:00', 'saturday', 130, 1, '2023-05-03 12:22:14', '2023-05-03 12:22:14'),
(103, 6, 35, 10, '2023-06-10', '16:00:00', '17:00:00', 'saturday', 140, 1, '2023-05-03 12:22:14', '2023-05-03 12:22:14'),
(104, 6, 35, 10, '2023-06-11', '11:00:00', '12:30:00', 'sunday', 10, 1, '2023-05-03 12:22:14', '2023-05-03 12:22:14'),
(105, 6, 35, 10, '2023-06-11', '12:30:00', '14:00:00', 'sunday', 20, 1, '2023-05-03 12:22:14', '2023-05-03 12:22:14'),
(106, 6, 35, 10, '2023-06-11', '14:00:00', '15:30:00', 'sunday', 30, 1, '2023-05-03 12:22:14', '2023-05-03 12:22:14'),
(107, 6, 35, 10, '2023-06-11', '15:30:00', '16:00:00', 'sunday', 40, 1, '2023-05-03 12:22:14', '2023-05-03 12:22:14'),
(108, 6, 35, 10, '2023-06-12', '07:00:00', '08:30:00', 'monday', 150, 1, '2023-05-03 12:22:14', '2023-05-03 12:22:14'),
(109, 6, 35, 10, '2023-06-12', '08:30:00', '10:00:00', 'monday', 140, 1, '2023-05-03 12:22:14', '2023-05-03 12:22:14'),
(110, 6, 35, 10, '2023-06-12', '10:00:00', '11:30:00', 'monday', 120, 1, '2023-05-03 12:22:14', '2023-05-03 12:22:14'),
(111, 6, 35, 10, '2023-06-12', '11:30:00', '13:00:00', 'monday', 130, 1, '2023-05-03 12:22:14', '2023-05-03 12:22:14'),
(112, 6, 35, 10, '2023-06-12', '13:00:00', '14:30:00', 'monday', 170, 1, '2023-05-03 12:22:14', '2023-05-03 12:22:14'),
(113, 6, 35, 10, '2023-06-12', '14:30:00', '16:00:00', 'monday', 180, 1, '2023-05-03 12:22:14', '2023-05-03 12:22:14'),
(114, 6, 35, 10, '2023-06-12', '16:00:00', '17:30:00', 'monday', 130, 1, '2023-05-03 12:22:14', '2023-05-03 12:22:14'),
(115, 6, 35, 10, '2023-06-12', '17:30:00', '18:00:00', 'monday', 140, 1, '2023-05-03 12:22:14', '2023-05-03 12:22:14'),
(172, 6, 35, 10, '2023-06-13', '12:00:00', '13:30:00', 'tuesday', 11, 1, '2023-05-03 12:22:14', '2023-05-03 12:22:14'),
(173, 6, 35, 10, '2023-06-13', '13:30:00', '15:00:00', 'tuesday', 22, 1, '2023-05-03 12:22:14', '2023-05-03 12:22:14'),
(174, 6, 35, 10, '2023-06-13', '15:00:00', '16:30:00', 'tuesday', 33, 1, '2023-05-03 12:22:14', '2023-05-03 12:22:14'),
(175, 6, 35, 10, '2023-06-13', '16:30:00', '18:00:00', 'tuesday', 44, 1, '2023-05-03 12:22:14', '2023-05-03 12:22:14'),
(176, 6, 35, 10, '2023-06-13', '18:00:00', '19:00:00', 'tuesday', 150, 1, '2023-05-03 12:22:14', '2023-05-03 12:22:14'),
(177, 6, 35, 10, '2023-06-14', '09:00:00', '10:30:00', 'wednesday', 140, 1, '2023-05-03 12:22:14', '2023-05-03 12:22:14'),
(178, 6, 35, 10, '2023-06-14', '10:30:00', '12:00:00', 'wednesday', 150, 1, '2023-05-03 12:22:14', '2023-05-03 12:22:14'),
(179, 6, 35, 10, '2023-06-14', '12:00:00', '13:30:00', 'wednesday', 120, 1, '2023-05-03 12:22:15', '2023-05-03 12:22:15'),
(180, 6, 35, 10, '2023-06-14', '13:30:00', '15:00:00', 'wednesday', 110, 1, '2023-05-03 12:22:15', '2023-05-03 12:22:15'),
(181, 6, 35, 10, '2023-06-14', '15:00:00', '16:30:00', 'wednesday', 100, 1, '2023-05-03 12:22:15', '2023-05-03 12:22:15'),
(182, 6, 35, 10, '2023-06-14', '16:30:00', '17:00:00', 'wednesday', 190, 1, '2023-05-03 12:22:15', '2023-05-03 12:22:15'),
(183, 6, 35, 10, '2023-06-15', '10:00:00', '11:30:00', 'thursday', 150, 1, '2023-05-03 12:22:15', '2023-05-03 12:22:15'),
(184, 6, 35, 10, '2023-06-15', '11:30:00', '13:00:00', 'thursday', 150, 1, '2023-05-03 12:22:15', '2023-05-03 12:22:15'),
(185, 6, 35, 10, '2023-06-15', '13:00:00', '14:00:00', 'thursday', 100, 1, '2023-05-03 12:22:15', '2023-05-03 12:22:15'),
(186, 6, 35, 10, '2023-06-16', '12:00:00', '13:30:00', 'friday', 100, 1, '2023-05-03 12:22:15', '2023-05-03 12:22:15'),
(187, 6, 35, 10, '2023-06-16', '13:30:00', '15:00:00', 'friday', 140, 1, '2023-05-03 12:22:15', '2023-05-03 12:22:15'),
(188, 6, 35, 10, '2023-06-16', '15:00:00', '16:30:00', 'friday', 150, 1, '2023-05-03 12:22:15', '2023-05-03 12:22:15'),
(189, 6, 35, 10, '2023-06-16', '16:30:00', '17:00:00', 'friday', 120, 1, '2023-05-03 12:22:15', '2023-05-03 12:22:15'),
(190, 6, 35, 10, '2023-06-17', '10:00:00', '11:30:00', 'saturday', 100, 1, '2023-05-03 12:22:15', '2023-05-03 12:22:15'),
(191, 6, 35, 10, '2023-06-17', '11:30:00', '13:00:00', 'saturday', 150, 1, '2023-05-03 12:22:15', '2023-05-03 12:22:15'),
(192, 6, 35, 10, '2023-06-17', '13:00:00', '14:30:00', 'saturday', 120, 1, '2023-05-03 12:22:15', '2023-05-03 12:22:15'),
(193, 6, 35, 10, '2023-06-17', '14:30:00', '16:00:00', 'saturday', 130, 1, '2023-05-03 12:22:15', '2023-05-03 12:22:15'),
(194, 6, 35, 10, '2023-06-17', '16:00:00', '17:00:00', 'saturday', 140, 1, '2023-05-03 12:22:15', '2023-05-03 12:22:15'),
(195, 6, 35, 10, '2023-06-18', '11:00:00', '12:30:00', 'sunday', 10, 1, '2023-05-03 12:22:15', '2023-05-03 12:22:15'),
(196, 6, 35, 10, '2023-06-18', '12:30:00', '14:00:00', 'sunday', 20, 1, '2023-05-03 12:22:15', '2023-05-03 12:22:15'),
(197, 6, 35, 10, '2023-06-18', '14:00:00', '15:30:00', 'sunday', 30, 1, '2023-05-03 12:22:15', '2023-05-03 12:22:15'),
(198, 6, 35, 10, '2023-06-18', '15:30:00', '16:00:00', 'sunday', 40, 1, '2023-05-03 12:22:15', '2023-05-03 12:22:15'),
(199, 6, 35, 10, '2023-06-19', '07:00:00', '08:30:00', 'monday', 150, 1, '2023-05-03 12:22:15', '2023-05-03 12:22:15'),
(200, 6, 35, 10, '2023-06-19', '08:30:00', '10:00:00', 'monday', 140, 1, '2023-05-03 12:22:15', '2023-05-03 12:22:15'),
(201, 6, 35, 10, '2023-06-19', '10:00:00', '11:30:00', 'monday', 120, 1, '2023-05-03 12:22:15', '2023-05-03 12:22:15'),
(202, 6, 35, 10, '2023-06-19', '11:30:00', '13:00:00', 'monday', 130, 1, '2023-05-03 12:22:15', '2023-05-03 12:22:15'),
(203, 6, 35, 10, '2023-06-19', '13:00:00', '14:30:00', 'monday', 170, 1, '2023-05-03 12:22:15', '2023-05-03 12:22:15'),
(204, 6, 35, 10, '2023-06-19', '14:30:00', '16:00:00', 'monday', 180, 1, '2023-05-03 12:22:15', '2023-05-03 12:22:15'),
(205, 6, 35, 10, '2023-06-19', '16:00:00', '17:30:00', 'monday', 130, 1, '2023-05-03 12:22:15', '2023-05-03 12:22:15'),
(206, 6, 35, 10, '2023-06-19', '17:30:00', '18:00:00', 'monday', 140, 1, '2023-05-03 12:22:15', '2023-05-03 12:22:15'),
(263, 6, 35, 10, '2023-06-20', '12:00:00', '13:30:00', 'tuesday', 11, 1, '2023-05-03 12:22:15', '2023-05-03 12:22:15'),
(264, 6, 35, 10, '2023-06-20', '13:30:00', '15:00:00', 'tuesday', 22, 1, '2023-05-03 12:22:15', '2023-05-03 12:22:15'),
(265, 6, 35, 10, '2023-06-20', '15:00:00', '16:30:00', 'tuesday', 33, 1, '2023-05-03 12:22:15', '2023-05-03 12:22:15'),
(266, 6, 35, 10, '2023-06-20', '16:30:00', '18:00:00', 'tuesday', 44, 1, '2023-05-03 12:22:15', '2023-05-03 12:22:15'),
(267, 6, 35, 10, '2023-06-20', '18:00:00', '19:00:00', 'tuesday', 150, 1, '2023-05-03 12:22:15', '2023-05-03 12:22:15'),
(268, 6, 35, 10, '2023-06-21', '09:00:00', '10:30:00', 'wednesday', 140, 1, '2023-05-03 12:22:15', '2023-05-03 12:22:15'),
(269, 6, 35, 10, '2023-06-21', '10:30:00', '12:00:00', 'wednesday', 150, 1, '2023-05-03 12:22:15', '2023-05-03 12:22:15'),
(270, 6, 35, 10, '2023-06-21', '12:00:00', '13:30:00', 'wednesday', 120, 1, '2023-05-03 12:22:15', '2023-05-03 12:22:15'),
(271, 6, 35, 10, '2023-06-21', '13:30:00', '15:00:00', 'wednesday', 110, 1, '2023-05-03 12:22:15', '2023-05-03 12:22:15'),
(272, 6, 35, 10, '2023-06-21', '15:00:00', '16:30:00', 'wednesday', 100, 1, '2023-05-03 12:22:15', '2023-05-03 12:22:15'),
(273, 6, 35, 10, '2023-06-21', '16:30:00', '17:00:00', 'wednesday', 190, 1, '2023-05-03 12:22:15', '2023-05-03 12:22:15'),
(274, 6, 35, 10, '2023-06-22', '10:00:00', '11:30:00', 'thursday', 150, 1, '2023-05-03 12:22:15', '2023-05-03 12:22:15'),
(275, 6, 35, 10, '2023-06-22', '11:30:00', '13:00:00', 'thursday', 150, 1, '2023-05-03 12:22:15', '2023-05-03 12:22:15'),
(276, 6, 35, 10, '2023-06-22', '13:00:00', '14:00:00', 'thursday', 100, 1, '2023-05-03 12:22:15', '2023-05-03 12:22:15'),
(277, 6, 35, 10, '2023-06-23', '12:00:00', '13:30:00', 'friday', 100, 1, '2023-05-03 12:22:15', '2023-05-03 12:22:15'),
(278, 6, 35, 10, '2023-06-23', '13:30:00', '15:00:00', 'friday', 140, 1, '2023-05-03 12:22:15', '2023-05-03 12:22:15'),
(279, 6, 35, 10, '2023-06-23', '15:00:00', '16:30:00', 'friday', 150, 1, '2023-05-03 12:22:15', '2023-05-03 12:22:15'),
(280, 6, 35, 10, '2023-06-23', '16:30:00', '17:00:00', 'friday', 120, 1, '2023-05-03 12:22:15', '2023-05-03 12:22:15'),
(281, 6, 35, 10, '2023-06-24', '10:00:00', '11:30:00', 'saturday', 100, 1, '2023-05-03 12:22:15', '2023-05-03 12:22:15'),
(282, 6, 35, 10, '2023-06-24', '11:30:00', '13:00:00', 'saturday', 150, 1, '2023-05-03 12:22:15', '2023-05-03 12:22:15'),
(283, 6, 35, 10, '2023-06-24', '13:00:00', '14:30:00', 'saturday', 120, 1, '2023-05-03 12:22:15', '2023-05-03 12:22:15'),
(284, 6, 35, 10, '2023-06-24', '14:30:00', '16:00:00', 'saturday', 130, 1, '2023-05-03 12:22:15', '2023-05-03 12:22:15'),
(285, 6, 35, 10, '2023-06-24', '16:00:00', '17:00:00', 'saturday', 140, 1, '2023-05-03 12:22:15', '2023-05-03 12:22:15'),
(286, 6, 35, 10, '2023-06-25', '11:00:00', '12:30:00', 'sunday', 10, 1, '2023-05-03 12:22:15', '2023-05-03 12:22:15'),
(287, 6, 35, 10, '2023-06-25', '12:30:00', '14:00:00', 'sunday', 20, 1, '2023-05-03 12:22:15', '2023-05-03 12:22:15'),
(288, 6, 35, 10, '2023-06-25', '14:00:00', '15:30:00', 'sunday', 30, 1, '2023-05-03 12:22:15', '2023-05-03 12:22:15'),
(289, 6, 35, 10, '2023-06-25', '15:30:00', '16:00:00', 'sunday', 40, 1, '2023-05-03 12:22:15', '2023-05-03 12:22:15'),
(290, 6, 35, 10, '2023-06-26', '07:00:00', '08:30:00', 'monday', 150, 1, '2023-05-03 12:22:15', '2023-05-03 12:22:15'),
(291, 6, 35, 10, '2023-06-26', '08:30:00', '10:00:00', 'monday', 140, 1, '2023-05-03 12:22:15', '2023-05-03 12:22:15'),
(292, 6, 35, 10, '2023-06-26', '10:00:00', '11:30:00', 'monday', 120, 1, '2023-05-03 12:22:15', '2023-05-03 12:22:15'),
(293, 6, 35, 10, '2023-06-26', '11:30:00', '13:00:00', 'monday', 130, 1, '2023-05-03 12:22:15', '2023-05-03 12:22:15'),
(294, 6, 35, 10, '2023-06-26', '13:00:00', '14:30:00', 'monday', 170, 1, '2023-05-03 12:22:15', '2023-05-03 12:22:15'),
(295, 6, 35, 10, '2023-06-26', '14:30:00', '16:00:00', 'monday', 180, 1, '2023-05-03 12:22:15', '2023-05-03 12:22:15'),
(296, 6, 35, 10, '2023-06-26', '16:00:00', '17:30:00', 'monday', 130, 1, '2023-05-03 12:22:15', '2023-05-03 12:22:15'),
(297, 6, 35, 10, '2023-06-26', '17:30:00', '18:00:00', 'monday', 140, 1, '2023-05-03 12:22:15', '2023-05-03 12:22:15'),
(354, 6, 35, 10, '2023-06-27', '12:00:00', '13:30:00', 'tuesday', 11, 1, '2023-05-03 12:22:15', '2023-05-03 12:22:15'),
(355, 6, 35, 10, '2023-06-27', '13:30:00', '15:00:00', 'tuesday', 22, 1, '2023-05-03 12:22:15', '2023-05-03 12:22:15'),
(356, 6, 35, 10, '2023-06-27', '15:00:00', '16:30:00', 'tuesday', 33, 1, '2023-05-03 12:22:15', '2023-05-03 12:22:15'),
(357, 6, 35, 10, '2023-06-27', '16:30:00', '18:00:00', 'tuesday', 44, 1, '2023-05-03 12:22:15', '2023-05-03 12:22:15'),
(358, 6, 35, 10, '2023-06-27', '18:00:00', '19:00:00', 'tuesday', 150, 1, '2023-05-03 12:22:15', '2023-05-03 12:22:15'),
(359, 6, 35, 10, '2023-06-28', '09:00:00', '10:30:00', 'wednesday', 140, 1, '2023-05-03 12:22:15', '2023-05-03 12:22:15'),
(360, 6, 35, 10, '2023-06-28', '10:30:00', '12:00:00', 'wednesday', 150, 1, '2023-05-03 12:22:15', '2023-05-03 12:22:15'),
(361, 6, 35, 10, '2023-06-28', '12:00:00', '13:30:00', 'wednesday', 120, 1, '2023-05-03 12:22:15', '2023-05-03 12:22:15'),
(362, 6, 35, 10, '2023-06-28', '13:30:00', '15:00:00', 'wednesday', 110, 1, '2023-05-03 12:22:15', '2023-05-03 12:22:15'),
(363, 6, 35, 10, '2023-06-28', '15:00:00', '16:30:00', 'wednesday', 100, 1, '2023-05-03 12:22:15', '2023-05-03 12:22:15'),
(364, 6, 35, 10, '2023-06-28', '16:30:00', '17:00:00', 'wednesday', 190, 1, '2023-05-03 12:22:15', '2023-05-03 12:22:15'),
(365, 6, 35, 10, '2023-06-29', '10:00:00', '11:30:00', 'thursday', 150, 1, '2023-05-03 12:22:15', '2023-05-03 12:22:15'),
(366, 6, 35, 10, '2023-06-29', '11:30:00', '13:00:00', 'thursday', 150, 1, '2023-05-03 12:22:15', '2023-05-03 12:22:15'),
(367, 6, 35, 10, '2023-06-29', '13:00:00', '14:00:00', 'thursday', 100, 1, '2023-05-03 12:22:15', '2023-05-03 12:22:15'),
(368, 6, 35, 10, '2023-06-30', '12:00:00', '13:30:00', 'friday', 100, 1, '2023-05-03 12:22:15', '2023-05-03 12:22:15'),
(369, 6, 35, 10, '2023-06-30', '13:30:00', '15:00:00', 'friday', 140, 1, '2023-05-03 12:22:15', '2023-05-03 12:22:15'),
(370, 6, 35, 10, '2023-06-30', '15:00:00', '16:30:00', 'friday', 150, 1, '2023-05-03 12:22:15', '2023-05-03 12:22:15'),
(371, 6, 35, 10, '2023-06-30', '16:30:00', '17:00:00', 'friday', 120, 1, '2023-05-03 12:22:15', '2023-05-03 12:22:15'),
(372, 6, 35, 10, '2023-07-01', '10:00:00', '11:30:00', 'saturday', 100, 1, '2023-05-03 12:22:15', '2023-05-03 12:22:15'),
(373, 6, 35, 10, '2023-07-01', '11:30:00', '13:00:00', 'saturday', 150, 1, '2023-05-03 12:22:15', '2023-05-03 12:22:15'),
(374, 6, 35, 10, '2023-07-01', '13:00:00', '14:30:00', 'saturday', 120, 1, '2023-05-03 12:22:15', '2023-05-03 12:22:15'),
(375, 6, 35, 10, '2023-07-01', '14:30:00', '16:00:00', 'saturday', 130, 1, '2023-05-03 12:22:15', '2023-05-03 12:22:15'),
(376, 6, 35, 10, '2023-07-01', '16:00:00', '17:00:00', 'saturday', 140, 1, '2023-05-03 12:22:15', '2023-05-03 12:22:15'),
(377, 6, 35, 10, '2023-07-02', '11:00:00', '12:30:00', 'sunday', 10, 1, '2023-05-03 12:22:15', '2023-05-03 12:22:15'),
(378, 6, 35, 10, '2023-07-02', '12:30:00', '14:00:00', 'sunday', 20, 1, '2023-05-03 12:22:15', '2023-05-03 12:22:15'),
(379, 6, 35, 10, '2023-07-02', '14:00:00', '15:30:00', 'sunday', 30, 1, '2023-05-03 12:22:15', '2023-05-03 12:22:15'),
(380, 6, 35, 10, '2023-07-02', '15:30:00', '16:00:00', 'sunday', 40, 1, '2023-05-03 12:22:15', '2023-05-03 12:22:15'),
(381, 6, 35, 10, '2023-07-03', '07:00:00', '08:30:00', 'monday', 150, 1, '2023-05-03 12:22:15', '2023-05-03 12:22:15'),
(382, 6, 35, 10, '2023-07-03', '08:30:00', '10:00:00', 'monday', 140, 1, '2023-05-03 12:22:15', '2023-05-03 12:22:15'),
(383, 6, 35, 10, '2023-07-03', '10:00:00', '11:30:00', 'monday', 120, 1, '2023-05-03 12:22:15', '2023-05-03 12:22:15'),
(384, 6, 35, 10, '2023-07-03', '11:30:00', '13:00:00', 'monday', 130, 1, '2023-05-03 12:22:15', '2023-05-03 12:22:15'),
(385, 6, 35, 10, '2023-07-03', '13:00:00', '14:30:00', 'monday', 170, 1, '2023-05-03 12:22:15', '2023-05-03 12:22:15'),
(386, 6, 35, 10, '2023-07-03', '14:30:00', '16:00:00', 'monday', 180, 1, '2023-05-03 12:22:15', '2023-05-03 12:22:15'),
(387, 6, 35, 10, '2023-07-03', '16:00:00', '17:30:00', 'monday', 130, 1, '2023-05-03 12:22:15', '2023-05-03 12:22:15'),
(388, 6, 35, 10, '2023-07-03', '17:30:00', '18:00:00', 'monday', 140, 1, '2023-05-03 12:22:15', '2023-05-03 12:22:15'),
(445, 6, 35, 10, '2023-07-04', '12:00:00', '13:30:00', 'tuesday', 11, 1, '2023-05-03 12:22:15', '2023-05-03 12:22:15'),
(446, 6, 35, 10, '2023-07-04', '13:30:00', '15:00:00', 'tuesday', 22, 1, '2023-05-03 12:22:15', '2023-05-03 12:22:15'),
(447, 6, 35, 10, '2023-07-04', '15:00:00', '16:30:00', 'tuesday', 33, 1, '2023-05-03 12:22:15', '2023-05-03 12:22:15'),
(448, 6, 35, 10, '2023-07-04', '16:30:00', '18:00:00', 'tuesday', 44, 1, '2023-05-03 12:22:15', '2023-05-03 12:22:15'),
(449, 6, 35, 10, '2023-07-04', '18:00:00', '19:00:00', 'tuesday', 150, 1, '2023-05-03 12:22:15', '2023-05-03 12:22:15'),
(450, 6, 35, 10, '2023-07-05', '09:00:00', '10:30:00', 'wednesday', 140, 1, '2023-05-03 12:22:15', '2023-05-03 12:22:15'),
(451, 6, 35, 10, '2023-07-05', '10:30:00', '12:00:00', 'wednesday', 150, 1, '2023-05-03 12:22:15', '2023-05-03 12:22:15'),
(452, 6, 35, 10, '2023-07-05', '12:00:00', '13:30:00', 'wednesday', 120, 1, '2023-05-03 12:22:15', '2023-05-03 12:22:15'),
(453, 6, 35, 10, '2023-07-05', '13:30:00', '15:00:00', 'wednesday', 110, 1, '2023-05-03 12:22:15', '2023-05-03 12:22:15'),
(454, 6, 35, 10, '2023-07-05', '15:00:00', '16:30:00', 'wednesday', 100, 1, '2023-05-03 12:22:15', '2023-05-03 12:22:15'),
(455, 6, 35, 10, '2023-07-05', '16:30:00', '17:00:00', 'wednesday', 190, 1, '2023-05-03 12:22:15', '2023-05-03 12:22:15'),
(456, 6, 35, 10, '2023-07-06', '10:00:00', '11:30:00', 'thursday', 150, 1, '2023-05-03 12:22:15', '2023-05-03 12:22:15'),
(457, 6, 35, 10, '2023-07-06', '11:30:00', '13:00:00', 'thursday', 150, 1, '2023-05-03 12:22:15', '2023-05-03 12:22:15'),
(458, 6, 35, 10, '2023-07-06', '13:00:00', '14:00:00', 'thursday', 100, 1, '2023-05-03 12:22:15', '2023-05-03 12:22:15'),
(459, 6, 35, 10, '2023-07-07', '12:00:00', '13:30:00', 'friday', 100, 1, '2023-05-03 12:22:15', '2023-05-03 12:22:15'),
(460, 6, 35, 10, '2023-07-07', '13:30:00', '15:00:00', 'friday', 140, 1, '2023-05-03 12:22:15', '2023-05-03 12:22:15'),
(461, 6, 35, 10, '2023-07-07', '15:00:00', '16:30:00', 'friday', 150, 1, '2023-05-03 12:22:15', '2023-05-03 12:22:15'),
(462, 6, 35, 10, '2023-07-07', '16:30:00', '17:00:00', 'friday', 120, 1, '2023-05-03 12:22:15', '2023-05-03 12:22:15'),
(463, 6, 35, 10, '2023-07-08', '10:00:00', '11:30:00', 'saturday', 100, 1, '2023-05-03 12:22:15', '2023-05-03 12:22:15'),
(464, 6, 35, 10, '2023-07-08', '11:30:00', '13:00:00', 'saturday', 150, 1, '2023-05-03 12:22:15', '2023-05-03 12:22:15'),
(465, 6, 35, 10, '2023-07-08', '13:00:00', '14:30:00', 'saturday', 120, 1, '2023-05-03 12:22:15', '2023-05-03 12:22:15'),
(466, 6, 35, 10, '2023-07-08', '14:30:00', '16:00:00', 'saturday', 130, 1, '2023-05-03 12:22:15', '2023-05-03 12:22:15'),
(467, 6, 35, 10, '2023-07-08', '16:00:00', '17:00:00', 'saturday', 140, 1, '2023-05-03 12:22:15', '2023-05-03 12:22:15'),
(468, 6, 35, 10, '2023-07-09', '11:00:00', '12:30:00', 'sunday', 10, 1, '2023-05-03 12:22:15', '2023-05-03 12:22:15'),
(469, 6, 35, 10, '2023-07-09', '12:30:00', '14:00:00', 'sunday', 20, 1, '2023-05-03 12:22:15', '2023-05-03 12:22:15'),
(470, 6, 35, 10, '2023-07-09', '14:00:00', '15:30:00', 'sunday', 30, 1, '2023-05-03 12:22:15', '2023-05-03 12:22:15'),
(471, 6, 35, 10, '2023-07-09', '15:30:00', '16:00:00', 'sunday', 40, 1, '2023-05-03 12:22:15', '2023-05-03 12:22:15'),
(472, 6, 35, 10, '2023-07-10', '07:00:00', '08:30:00', 'monday', 150, 1, '2023-05-03 12:22:15', '2023-05-03 12:22:15'),
(473, 6, 35, 10, '2023-07-10', '08:30:00', '10:00:00', 'monday', 140, 1, '2023-05-03 12:22:15', '2023-05-03 12:22:15'),
(474, 6, 35, 10, '2023-07-10', '10:00:00', '11:30:00', 'monday', 120, 1, '2023-05-03 12:22:15', '2023-05-03 12:22:15'),
(475, 6, 35, 10, '2023-07-10', '11:30:00', '13:00:00', 'monday', 130, 1, '2023-05-03 12:22:15', '2023-05-03 12:22:15'),
(476, 6, 35, 10, '2023-07-10', '13:00:00', '14:30:00', 'monday', 170, 1, '2023-05-03 12:22:15', '2023-05-03 12:22:15'),
(477, 6, 35, 10, '2023-07-10', '14:30:00', '16:00:00', 'monday', 180, 1, '2023-05-03 12:22:15', '2023-05-03 12:22:15'),
(478, 6, 35, 10, '2023-07-10', '16:00:00', '17:30:00', 'monday', 130, 1, '2023-05-03 12:22:15', '2023-05-03 12:22:15'),
(479, 6, 35, 10, '2023-07-10', '17:30:00', '18:00:00', 'monday', 140, 1, '2023-05-03 12:22:15', '2023-05-03 12:22:15'),
(536, 6, 35, 10, '2023-07-11', '12:00:00', '13:30:00', 'tuesday', 11, 1, '2023-05-03 12:22:16', '2023-05-03 12:22:16'),
(537, 6, 35, 10, '2023-07-11', '13:30:00', '15:00:00', 'tuesday', 22, 1, '2023-05-03 12:22:16', '2023-05-03 12:22:16'),
(538, 6, 35, 10, '2023-07-11', '15:00:00', '16:30:00', 'tuesday', 33, 1, '2023-05-03 12:22:16', '2023-05-03 12:22:16'),
(539, 6, 35, 10, '2023-07-11', '16:30:00', '18:00:00', 'tuesday', 44, 1, '2023-05-03 12:22:16', '2023-05-03 12:22:16'),
(540, 6, 35, 10, '2023-07-11', '18:00:00', '19:00:00', 'tuesday', 150, 1, '2023-05-03 12:22:16', '2023-05-03 12:22:16'),
(541, 6, 35, 10, '2023-07-12', '09:00:00', '10:30:00', 'wednesday', 140, 1, '2023-05-03 12:22:16', '2023-05-03 12:22:16'),
(542, 6, 35, 10, '2023-07-12', '10:30:00', '12:00:00', 'wednesday', 150, 1, '2023-05-03 12:22:16', '2023-05-03 12:22:16'),
(543, 6, 35, 10, '2023-07-12', '12:00:00', '13:30:00', 'wednesday', 120, 1, '2023-05-03 12:22:16', '2023-05-03 12:22:16'),
(544, 6, 35, 10, '2023-07-12', '13:30:00', '15:00:00', 'wednesday', 110, 1, '2023-05-03 12:22:16', '2023-05-03 12:22:16'),
(545, 6, 35, 10, '2023-07-12', '15:00:00', '16:30:00', 'wednesday', 100, 1, '2023-05-03 12:22:16', '2023-05-03 12:22:16'),
(546, 6, 35, 10, '2023-07-12', '16:30:00', '17:00:00', 'wednesday', 190, 1, '2023-05-03 12:22:16', '2023-05-03 12:22:16'),
(547, 6, 35, 10, '2023-07-13', '10:00:00', '11:30:00', 'thursday', 150, 1, '2023-05-03 12:22:16', '2023-05-03 12:22:16'),
(548, 6, 35, 10, '2023-07-13', '11:30:00', '13:00:00', 'thursday', 150, 1, '2023-05-03 12:22:16', '2023-05-03 12:22:16'),
(549, 6, 35, 10, '2023-07-13', '13:00:00', '14:00:00', 'thursday', 100, 1, '2023-05-03 12:22:16', '2023-05-03 12:22:16'),
(550, 6, 35, 10, '2023-07-14', '12:00:00', '13:30:00', 'friday', 100, 1, '2023-05-03 12:22:16', '2023-05-03 12:22:16'),
(551, 6, 35, 10, '2023-07-14', '13:30:00', '15:00:00', 'friday', 140, 1, '2023-05-03 12:22:16', '2023-05-03 12:22:16'),
(552, 6, 35, 10, '2023-07-14', '15:00:00', '16:30:00', 'friday', 150, 1, '2023-05-03 12:22:16', '2023-05-03 12:22:16'),
(553, 6, 35, 10, '2023-07-14', '16:30:00', '17:00:00', 'friday', 120, 1, '2023-05-03 12:22:16', '2023-05-03 12:22:16'),
(554, 6, 35, 10, '2023-07-15', '10:00:00', '11:30:00', 'saturday', 100, 1, '2023-05-03 12:22:16', '2023-05-03 12:22:16'),
(555, 6, 35, 10, '2023-07-15', '11:30:00', '13:00:00', 'saturday', 150, 1, '2023-05-03 12:22:16', '2023-05-03 12:22:16'),
(556, 6, 35, 10, '2023-07-15', '13:00:00', '14:30:00', 'saturday', 120, 1, '2023-05-03 12:22:16', '2023-05-03 12:22:16'),
(557, 6, 35, 10, '2023-07-15', '14:30:00', '16:00:00', 'saturday', 130, 1, '2023-05-03 12:22:16', '2023-05-03 12:22:16'),
(558, 6, 35, 10, '2023-07-15', '16:00:00', '17:00:00', 'saturday', 140, 1, '2023-05-03 12:22:16', '2023-05-03 12:22:16'),
(559, 6, 35, 10, '2023-07-16', '11:00:00', '12:30:00', 'sunday', 10, 1, '2023-05-03 12:22:16', '2023-05-03 12:22:16'),
(560, 6, 35, 10, '2023-07-16', '12:30:00', '14:00:00', 'sunday', 20, 1, '2023-05-03 12:22:16', '2023-05-03 12:22:16'),
(561, 6, 35, 10, '2023-07-16', '14:00:00', '15:30:00', 'sunday', 30, 1, '2023-05-03 12:22:16', '2023-05-03 12:22:16'),
(562, 6, 35, 10, '2023-07-16', '15:30:00', '16:00:00', 'sunday', 40, 1, '2023-05-03 12:22:16', '2023-05-03 12:22:16'),
(563, 6, 35, 10, '2023-07-17', '07:00:00', '08:30:00', 'monday', 150, 1, '2023-05-03 12:22:16', '2023-05-03 12:22:16'),
(564, 6, 35, 10, '2023-07-17', '08:30:00', '10:00:00', 'monday', 140, 1, '2023-05-03 12:22:16', '2023-05-03 12:22:16'),
(565, 6, 35, 10, '2023-07-17', '10:00:00', '11:30:00', 'monday', 120, 1, '2023-05-03 12:22:16', '2023-05-03 12:22:16'),
(566, 6, 35, 10, '2023-07-17', '11:30:00', '13:00:00', 'monday', 130, 1, '2023-05-03 12:22:16', '2023-05-03 12:22:16'),
(567, 6, 35, 10, '2023-07-17', '13:00:00', '14:30:00', 'monday', 170, 1, '2023-05-03 12:22:16', '2023-05-03 12:22:16'),
(568, 6, 35, 10, '2023-07-17', '14:30:00', '16:00:00', 'monday', 180, 1, '2023-05-03 12:22:16', '2023-05-03 12:22:16'),
(569, 6, 35, 10, '2023-07-17', '16:00:00', '17:30:00', 'monday', 130, 1, '2023-05-03 12:22:16', '2023-05-03 12:22:16'),
(570, 6, 35, 10, '2023-07-17', '17:30:00', '18:00:00', 'monday', 140, 1, '2023-05-03 12:22:16', '2023-05-03 12:22:16'),
(627, 6, 35, 10, '2023-07-18', '12:00:00', '13:30:00', 'tuesday', 11, 1, '2023-05-03 12:22:16', '2023-05-03 12:22:16'),
(628, 6, 35, 10, '2023-07-18', '13:30:00', '15:00:00', 'tuesday', 22, 1, '2023-05-03 12:22:16', '2023-05-03 12:22:16'),
(629, 6, 35, 10, '2023-07-18', '15:00:00', '16:30:00', 'tuesday', 33, 1, '2023-05-03 12:22:16', '2023-05-03 12:22:16'),
(630, 6, 35, 10, '2023-07-18', '16:30:00', '18:00:00', 'tuesday', 44, 1, '2023-05-03 12:22:16', '2023-05-03 12:22:16'),
(631, 6, 35, 10, '2023-07-18', '18:00:00', '19:00:00', 'tuesday', 150, 1, '2023-05-03 12:22:16', '2023-05-03 12:22:16'),
(632, 6, 35, 10, '2023-07-19', '09:00:00', '10:30:00', 'wednesday', 140, 1, '2023-05-03 12:22:16', '2023-05-03 12:22:16'),
(633, 6, 35, 10, '2023-07-19', '10:30:00', '12:00:00', 'wednesday', 150, 1, '2023-05-03 12:22:16', '2023-05-03 12:22:16'),
(634, 6, 35, 10, '2023-07-19', '12:00:00', '13:30:00', 'wednesday', 120, 1, '2023-05-03 12:22:16', '2023-05-03 12:22:16'),
(635, 6, 35, 10, '2023-07-19', '13:30:00', '15:00:00', 'wednesday', 110, 1, '2023-05-03 12:22:16', '2023-05-03 12:22:16'),
(636, 6, 35, 10, '2023-07-19', '15:00:00', '16:30:00', 'wednesday', 100, 1, '2023-05-03 12:22:16', '2023-05-03 12:22:16'),
(637, 6, 35, 10, '2023-07-19', '16:30:00', '17:00:00', 'wednesday', 190, 1, '2023-05-03 12:22:16', '2023-05-03 12:22:16'),
(638, 6, 35, 10, '2023-07-20', '10:00:00', '11:30:00', 'thursday', 150, 1, '2023-05-03 12:22:16', '2023-05-03 12:22:16'),
(639, 6, 35, 10, '2023-07-20', '11:30:00', '13:00:00', 'thursday', 150, 1, '2023-05-03 12:22:16', '2023-05-03 12:22:16'),
(640, 6, 35, 10, '2023-07-20', '13:00:00', '14:00:00', 'thursday', 100, 1, '2023-05-03 12:22:16', '2023-05-03 12:22:16'),
(641, 6, 35, 10, '2023-07-21', '12:00:00', '13:30:00', 'friday', 100, 1, '2023-05-03 12:22:16', '2023-05-03 12:22:16'),
(642, 6, 35, 10, '2023-07-21', '13:30:00', '15:00:00', 'friday', 140, 1, '2023-05-03 12:22:16', '2023-05-03 12:22:16'),
(643, 6, 35, 10, '2023-07-21', '15:00:00', '16:30:00', 'friday', 150, 1, '2023-05-03 12:22:16', '2023-05-03 12:22:16'),
(644, 6, 35, 10, '2023-07-21', '16:30:00', '17:00:00', 'friday', 120, 1, '2023-05-03 12:22:16', '2023-05-03 12:22:16'),
(645, 6, 35, 10, '2023-07-22', '10:00:00', '11:30:00', 'saturday', 100, 1, '2023-05-03 12:22:16', '2023-05-03 12:22:16'),
(646, 6, 35, 10, '2023-07-22', '11:30:00', '13:00:00', 'saturday', 150, 1, '2023-05-03 12:22:16', '2023-05-03 12:22:16'),
(647, 6, 35, 10, '2023-07-22', '13:00:00', '14:30:00', 'saturday', 120, 1, '2023-05-03 12:22:16', '2023-05-03 12:22:16'),
(648, 6, 35, 10, '2023-07-22', '14:30:00', '16:00:00', 'saturday', 130, 1, '2023-05-03 12:22:16', '2023-05-03 12:22:16'),
(649, 6, 35, 10, '2023-07-22', '16:00:00', '17:00:00', 'saturday', 140, 1, '2023-05-03 12:22:16', '2023-05-03 12:22:16'),
(650, 6, 35, 10, '2023-07-23', '11:00:00', '12:30:00', 'sunday', 10, 1, '2023-05-03 12:22:16', '2023-05-03 12:22:16'),
(651, 6, 35, 10, '2023-07-23', '12:30:00', '14:00:00', 'sunday', 20, 1, '2023-05-03 12:22:16', '2023-05-03 12:22:16'),
(652, 6, 35, 10, '2023-07-23', '14:00:00', '15:30:00', 'sunday', 30, 1, '2023-05-03 12:22:16', '2023-05-03 12:22:16'),
(653, 6, 35, 10, '2023-07-23', '15:30:00', '16:00:00', 'sunday', 40, 1, '2023-05-03 12:22:16', '2023-05-03 12:22:16'),
(654, 6, 35, 10, '2023-07-24', '07:00:00', '08:30:00', 'monday', 150, 1, '2023-05-03 12:22:16', '2023-05-03 12:22:16'),
(655, 6, 35, 10, '2023-07-24', '08:30:00', '10:00:00', 'monday', 140, 1, '2023-05-03 12:22:16', '2023-05-03 12:22:16'),
(656, 6, 35, 10, '2023-07-24', '10:00:00', '11:30:00', 'monday', 120, 1, '2023-05-03 12:22:16', '2023-05-03 12:22:16'),
(657, 6, 35, 10, '2023-07-24', '11:30:00', '13:00:00', 'monday', 130, 1, '2023-05-03 12:22:16', '2023-05-03 12:22:16'),
(658, 6, 35, 10, '2023-07-24', '13:00:00', '14:30:00', 'monday', 170, 1, '2023-05-03 12:22:16', '2023-05-03 12:22:16'),
(659, 6, 35, 10, '2023-07-24', '14:30:00', '16:00:00', 'monday', 180, 1, '2023-05-03 12:22:16', '2023-05-03 12:22:16'),
(660, 6, 35, 10, '2023-07-24', '16:00:00', '17:30:00', 'monday', 130, 1, '2023-05-03 12:22:16', '2023-05-03 12:22:16'),
(661, 6, 35, 10, '2023-07-24', '17:30:00', '18:00:00', 'monday', 140, 1, '2023-05-03 12:22:16', '2023-05-03 12:22:16'),
(718, 6, 35, 10, '2023-07-25', '12:00:00', '13:30:00', 'tuesday', 11, 1, '2023-05-03 12:22:16', '2023-05-03 12:22:16'),
(719, 6, 35, 10, '2023-07-25', '13:30:00', '15:00:00', 'tuesday', 22, 1, '2023-05-03 12:22:16', '2023-05-03 12:22:16'),
(720, 6, 35, 10, '2023-07-25', '15:00:00', '16:30:00', 'tuesday', 33, 1, '2023-05-03 12:22:16', '2023-05-03 12:22:16'),
(721, 6, 35, 10, '2023-07-25', '16:30:00', '18:00:00', 'tuesday', 44, 1, '2023-05-03 12:22:16', '2023-05-03 12:22:16'),
(722, 6, 35, 10, '2023-07-25', '18:00:00', '19:00:00', 'tuesday', 150, 1, '2023-05-03 12:22:16', '2023-05-03 12:22:16'),
(723, 6, 35, 10, '2023-07-26', '09:00:00', '10:30:00', 'wednesday', 140, 1, '2023-05-03 12:22:16', '2023-05-03 12:22:16'),
(724, 6, 35, 10, '2023-07-26', '10:30:00', '12:00:00', 'wednesday', 150, 1, '2023-05-03 12:22:16', '2023-05-03 12:22:16'),
(725, 6, 35, 10, '2023-07-26', '12:00:00', '13:30:00', 'wednesday', 120, 1, '2023-05-03 12:22:16', '2023-05-03 12:22:16'),
(726, 6, 35, 10, '2023-07-26', '13:30:00', '15:00:00', 'wednesday', 110, 1, '2023-05-03 12:22:16', '2023-05-03 12:22:16'),
(727, 6, 35, 10, '2023-07-26', '15:00:00', '16:30:00', 'wednesday', 100, 1, '2023-05-03 12:22:16', '2023-05-03 12:22:16'),
(728, 6, 35, 10, '2023-07-26', '16:30:00', '17:00:00', 'wednesday', 190, 1, '2023-05-03 12:22:16', '2023-05-03 12:22:16'),
(729, 6, 35, 10, '2023-07-27', '10:00:00', '11:30:00', 'thursday', 150, 1, '2023-05-03 12:22:16', '2023-05-03 12:22:16'),
(730, 6, 35, 10, '2023-07-27', '11:30:00', '13:00:00', 'thursday', 150, 1, '2023-05-03 12:22:16', '2023-05-03 12:22:16'),
(731, 6, 35, 10, '2023-07-27', '13:00:00', '14:00:00', 'thursday', 100, 1, '2023-05-03 12:22:16', '2023-05-03 12:22:16'),
(732, 6, 35, 10, '2023-07-28', '12:00:00', '13:30:00', 'friday', 100, 1, '2023-05-03 12:22:16', '2023-05-03 12:22:16'),
(733, 6, 35, 10, '2023-07-28', '13:30:00', '15:00:00', 'friday', 140, 1, '2023-05-03 12:22:16', '2023-05-03 12:22:16'),
(734, 6, 35, 10, '2023-07-28', '15:00:00', '16:30:00', 'friday', 150, 1, '2023-05-03 12:22:16', '2023-05-03 12:22:16'),
(735, 6, 35, 10, '2023-07-28', '16:30:00', '17:00:00', 'friday', 120, 1, '2023-05-03 12:22:16', '2023-05-03 12:22:16'),
(736, 6, 35, 10, '2023-07-29', '10:00:00', '11:30:00', 'saturday', 100, 1, '2023-05-03 12:22:16', '2023-05-03 12:22:16'),
(737, 6, 35, 10, '2023-07-29', '11:30:00', '13:00:00', 'saturday', 150, 1, '2023-05-03 12:22:16', '2023-05-03 12:22:16'),
(738, 6, 35, 10, '2023-07-29', '13:00:00', '14:30:00', 'saturday', 120, 1, '2023-05-03 12:22:16', '2023-05-03 12:22:16'),
(739, 6, 35, 10, '2023-07-29', '14:30:00', '16:00:00', 'saturday', 130, 1, '2023-05-03 12:22:16', '2023-05-03 12:22:16'),
(740, 6, 35, 10, '2023-07-29', '16:00:00', '17:00:00', 'saturday', 140, 1, '2023-05-03 12:22:16', '2023-05-03 12:22:16'),
(741, 6, 35, 10, '2023-07-30', '11:00:00', '12:30:00', 'sunday', 10, 1, '2023-05-03 12:22:16', '2023-05-03 12:22:16'),
(742, 6, 35, 10, '2023-07-30', '12:30:00', '14:00:00', 'sunday', 20, 1, '2023-05-03 12:22:16', '2023-05-03 12:22:16'),
(743, 6, 35, 10, '2023-07-30', '14:00:00', '15:30:00', 'sunday', 30, 1, '2023-05-03 12:22:16', '2023-05-03 12:22:16'),
(744, 6, 35, 10, '2023-07-30', '15:30:00', '16:00:00', 'sunday', 40, 1, '2023-05-03 12:22:16', '2023-05-03 12:22:16'),
(745, 6, 35, 10, '2023-07-31', '07:00:00', '08:30:00', 'monday', 150, 1, '2023-05-03 12:22:16', '2023-05-03 12:22:16'),
(746, 6, 35, 10, '2023-07-31', '08:30:00', '10:00:00', 'monday', 140, 1, '2023-05-03 12:22:16', '2023-05-03 12:22:16'),
(747, 6, 35, 10, '2023-07-31', '10:00:00', '11:30:00', 'monday', 120, 1, '2023-05-03 12:22:16', '2023-05-03 12:22:16'),
(748, 6, 35, 10, '2023-07-31', '11:30:00', '13:00:00', 'monday', 130, 1, '2023-05-03 12:22:16', '2023-05-03 12:22:16'),
(749, 6, 35, 10, '2023-07-31', '13:00:00', '14:30:00', 'monday', 170, 1, '2023-05-03 12:22:16', '2023-05-03 12:22:16'),
(750, 6, 35, 10, '2023-07-31', '14:30:00', '16:00:00', 'monday', 180, 1, '2023-05-03 12:22:16', '2023-05-03 12:22:16'),
(751, 6, 35, 10, '2023-07-31', '16:00:00', '17:30:00', 'monday', 130, 1, '2023-05-03 12:22:16', '2023-05-03 12:22:16'),
(752, 6, 35, 10, '2023-07-31', '17:30:00', '18:00:00', 'monday', 140, 1, '2023-05-03 12:22:16', '2023-05-03 12:22:16'),
(809, 0, 35, 10, '2023-04-30', '10:00:00', '11:00:00', 'sunday', 110, 1, '2023-05-04 05:17:33', '2023-05-04 05:17:33'),
(810, 0, 35, 10, '2023-04-30', '11:00:00', '12:00:00', 'sunday', 110, 1, '2023-05-04 05:17:33', '2023-05-04 05:17:33'),
(811, 0, 35, 10, '2023-04-30', '12:00:00', '13:00:00', 'sunday', 110, 1, '2023-05-04 05:17:33', '2023-05-04 05:17:33'),
(812, 0, 35, 10, '2023-04-30', '13:00:00', '14:00:00', 'sunday', 110, 1, '2023-05-04 05:17:33', '2023-05-04 05:17:33'),
(813, 0, 35, 10, '2023-05-25', '10:00:00', '11:00:00', 'thursday', 110, 1, '2023-05-04 10:27:10', '2023-05-04 10:27:10'),
(814, 0, 35, 10, '2023-05-25', '11:00:00', '12:00:00', 'thursday', 110, 1, '2023-05-04 10:27:11', '2023-05-04 10:27:11'),
(815, 0, 35, 10, '2023-05-25', '12:00:00', '13:00:00', 'thursday', 110, 1, '2023-05-04 10:27:11', '2023-05-04 10:27:11'),
(816, 0, 35, 10, '2023-05-25', '13:00:00', '14:00:00', 'thursday', 110, 1, '2023-05-04 10:27:11', '2023-05-04 10:27:11'),
(817, 0, 56, 7, '2023-05-25', '06:00:00', '07:00:00', 'thursday', 151, 1, '2023-05-04 10:43:12', '2023-05-04 10:43:12'),
(818, 0, 56, 7, '2023-05-25', '07:00:00', '08:00:00', 'thursday', 151, 1, '2023-05-04 10:43:12', '2023-05-04 10:43:12'),
(819, 0, 56, 7, '2023-05-25', '08:00:00', '09:00:00', 'thursday', 151, 1, '2023-05-04 10:43:12', '2023-05-04 10:43:12'),
(820, 0, 56, 7, '2023-05-25', '09:00:00', '10:00:00', 'thursday', 151, 1, '2023-05-04 10:43:12', '2023-05-04 10:43:12'),
(821, 0, 56, 7, '2023-05-25', '10:00:00', '11:00:00', 'thursday', 151, 1, '2023-05-04 10:43:12', '2023-05-04 10:43:12'),
(822, 0, 56, 7, '2023-05-25', '11:00:00', '12:00:00', 'thursday', 151, 1, '2023-05-04 10:43:12', '2023-05-04 10:43:12'),
(823, 0, 56, 7, '2023-05-25', '12:00:00', '13:00:00', 'thursday', 151, 1, '2023-05-04 10:43:12', '2023-05-04 10:43:12'),
(824, 0, 56, 7, '2023-05-25', '13:00:00', '14:00:00', 'thursday', 151, 1, '2023-05-04 10:43:12', '2023-05-04 10:43:12'),
(825, 0, 56, 7, '2023-05-25', '14:00:00', '15:00:00', 'thursday', 151, 1, '2023-05-04 10:43:12', '2023-05-04 10:43:12'),
(826, 0, 56, 7, '2023-05-25', '15:00:00', '16:00:00', 'thursday', 151, 1, '2023-05-04 10:43:12', '2023-05-04 10:43:12'),
(827, 14, 56, 12, '2023-05-11', '06:00:00', '07:30:00', 'thursday', 10, 1, '2023-05-04 12:40:00', '2023-05-04 12:40:00'),
(828, 14, 56, 12, '2023-05-11', '07:30:00', '09:00:00', 'thursday', 10, 1, '2023-05-04 12:40:00', '2023-05-04 12:40:00'),
(829, 14, 56, 12, '2023-05-11', '09:00:00', '10:30:00', 'thursday', 20, 1, '2023-05-04 12:40:00', '2023-05-04 12:40:00'),
(830, 14, 56, 12, '2023-05-11', '10:30:00', '12:00:00', 'thursday', 30, 1, '2023-05-04 12:40:00', '2023-05-04 12:40:00'),
(831, 14, 56, 12, '2023-05-11', '06:00:00', '07:30:00', 'thursday', 10, 1, '2023-05-04 12:40:00', '2023-05-04 12:40:00'),
(832, 14, 56, 12, '2023-05-11', '07:30:00', '09:00:00', 'thursday', 10, 1, '2023-05-04 12:40:00', '2023-05-04 12:40:00'),
(833, 14, 56, 12, '2023-05-11', '09:00:00', '10:30:00', 'thursday', 20, 1, '2023-05-04 12:40:00', '2023-05-04 12:40:00'),
(834, 14, 56, 12, '2023-05-11', '10:30:00', '12:00:00', 'thursday', 30, 1, '2023-05-04 12:40:00', '2023-05-04 12:40:00'),
(835, 14, 56, 12, '2023-05-12', '07:00:00', '08:30:00', 'friday', 20, 1, '2023-05-04 12:40:00', '2023-05-04 12:40:00'),
(836, 14, 56, 12, '2023-05-12', '08:30:00', '10:00:00', 'friday', 50, 1, '2023-05-04 12:40:00', '2023-05-04 12:40:00'),
(837, 14, 56, 12, '2023-05-12', '07:00:00', '08:30:00', 'friday', 20, 1, '2023-05-04 12:40:00', '2023-05-04 12:40:00'),
(838, 14, 56, 12, '2023-05-12', '08:30:00', '10:00:00', 'friday', 50, 1, '2023-05-04 12:40:00', '2023-05-04 12:40:00'),
(839, 14, 56, 12, '2023-05-13', '08:00:00', '09:30:00', 'saturday', 20, 1, '2023-05-04 12:40:00', '2023-05-04 12:40:00'),
(840, 14, 56, 12, '2023-05-13', '09:30:00', '11:00:00', 'saturday', 30, 1, '2023-05-04 12:40:00', '2023-05-04 12:40:00'),
(841, 14, 56, 12, '2023-05-13', '11:00:00', '12:00:00', 'saturday', 50, 1, '2023-05-04 12:40:00', '2023-05-04 12:40:00'),
(842, 14, 56, 12, '2023-05-13', '12:00:00', '13:00:00', 'saturday', 20, 1, '2023-05-04 12:40:00', '2023-05-04 12:40:00'),
(843, 14, 56, 12, '2023-05-13', '08:00:00', '09:30:00', 'saturday', 20, 1, '2023-05-04 12:40:00', '2023-05-04 12:40:00'),
(844, 14, 56, 12, '2023-05-13', '09:30:00', '11:00:00', 'saturday', 30, 1, '2023-05-04 12:40:00', '2023-05-04 12:40:00'),
(845, 14, 56, 12, '2023-05-13', '11:00:00', '12:00:00', 'saturday', 50, 1, '2023-05-04 12:40:00', '2023-05-04 12:40:00'),
(846, 14, 56, 12, '2023-05-13', '12:00:00', '13:00:00', 'saturday', 20, 1, '2023-05-04 12:40:00', '2023-05-04 12:40:00'),
(847, 14, 56, 12, '2023-05-14', '05:00:00', '06:30:00', 'sunday', 510, 1, '2023-05-04 12:40:00', '2023-05-04 12:40:00'),
(848, 14, 56, 12, '2023-05-14', '06:30:00', '08:00:00', 'sunday', 20, 1, '2023-05-04 12:40:00', '2023-05-04 12:40:00'),
(849, 14, 56, 12, '2023-05-14', '08:00:00', '09:00:00', 'sunday', 20, 1, '2023-05-04 12:40:00', '2023-05-04 12:40:00'),
(850, 14, 56, 12, '2023-05-14', '05:00:00', '06:30:00', 'sunday', 510, 1, '2023-05-04 12:40:00', '2023-05-04 12:40:00'),
(851, 14, 56, 12, '2023-05-14', '06:30:00', '08:00:00', 'sunday', 20, 1, '2023-05-04 12:40:00', '2023-05-04 12:40:00'),
(852, 14, 56, 12, '2023-05-14', '08:00:00', '09:00:00', 'sunday', 20, 1, '2023-05-04 12:40:00', '2023-05-04 12:40:00'),
(853, 14, 56, 12, '2023-05-15', '06:00:00', '07:00:00', 'monday', 20, 1, '2023-05-04 12:40:00', '2023-05-04 12:40:00'),
(854, 14, 56, 12, '2023-05-15', '07:00:00', '08:00:00', 'monday', 20, 1, '2023-05-04 12:40:00', '2023-05-04 12:40:00'),
(855, 14, 56, 12, '2023-05-15', '08:00:00', '09:00:00', 'monday', 50, 1, '2023-05-04 12:40:00', '2023-05-04 12:40:00'),
(856, 14, 56, 12, '2023-05-15', '06:00:00', '07:00:00', 'monday', 20, 1, '2023-05-04 12:40:00', '2023-05-04 12:40:00'),
(857, 14, 56, 12, '2023-05-15', '07:00:00', '08:00:00', 'monday', 20, 1, '2023-05-04 12:40:00', '2023-05-04 12:40:00'),
(858, 14, 56, 12, '2023-05-15', '08:00:00', '09:00:00', 'monday', 50, 1, '2023-05-04 12:40:00', '2023-05-04 12:40:00'),
(859, 14, 56, 12, '2023-05-16', '06:00:00', '07:30:00', 'tuesday', 20, 1, '2023-05-04 12:40:00', '2023-05-04 12:40:00'),
(860, 14, 56, 12, '2023-05-16', '07:30:00', '09:00:00', 'tuesday', 20, 1, '2023-05-04 12:40:00', '2023-05-04 12:40:00'),
(861, 14, 56, 12, '2023-05-16', '09:00:00', '10:30:00', 'tuesday', 20, 1, '2023-05-04 12:40:00', '2023-05-04 12:40:00'),
(862, 14, 56, 12, '2023-05-16', '10:30:00', '11:00:00', 'tuesday', 10, 1, '2023-05-04 12:40:00', '2023-05-04 12:40:00'),
(863, 14, 56, 12, '2023-05-16', '06:00:00', '07:30:00', 'tuesday', 20, 1, '2023-05-04 12:40:00', '2023-05-04 12:40:00'),
(864, 14, 56, 12, '2023-05-16', '07:30:00', '09:00:00', 'tuesday', 20, 1, '2023-05-04 12:40:00', '2023-05-04 12:40:00'),
(865, 14, 56, 12, '2023-05-16', '09:00:00', '10:30:00', 'tuesday', 20, 1, '2023-05-04 12:40:00', '2023-05-04 12:40:00'),
(866, 14, 56, 12, '2023-05-16', '10:30:00', '11:00:00', 'tuesday', 10, 1, '2023-05-04 12:40:00', '2023-05-04 12:40:00'),
(867, 14, 56, 12, '2023-05-17', '06:00:00', '07:00:00', 'wednesday', 50, 1, '2023-05-04 12:40:00', '2023-05-04 12:40:00'),
(868, 14, 56, 12, '2023-05-17', '07:00:00', '08:00:00', 'wednesday', 10, 1, '2023-05-04 12:40:00', '2023-05-04 12:40:00'),
(869, 14, 56, 12, '2023-05-17', '08:00:00', '09:00:00', 'wednesday', 50, 1, '2023-05-04 12:40:00', '2023-05-04 12:40:00'),
(870, 14, 56, 12, '2023-05-17', '06:00:00', '07:00:00', 'wednesday', 50, 1, '2023-05-04 12:40:00', '2023-05-04 12:40:00'),
(871, 14, 56, 12, '2023-05-17', '07:00:00', '08:00:00', 'wednesday', 10, 1, '2023-05-04 12:40:00', '2023-05-04 12:40:00'),
(872, 14, 56, 12, '2023-05-17', '08:00:00', '09:00:00', 'wednesday', 50, 1, '2023-05-04 12:40:00', '2023-05-04 12:40:00'),
(873, 14, 56, 12, '2023-05-18', '06:00:00', '07:30:00', 'thursday', 10, 1, '2023-05-04 12:40:00', '2023-05-04 12:40:00'),
(874, 14, 56, 12, '2023-05-18', '07:30:00', '09:00:00', 'thursday', 10, 1, '2023-05-04 12:40:00', '2023-05-04 12:40:00'),
(875, 14, 56, 12, '2023-05-18', '09:00:00', '10:30:00', 'thursday', 20, 1, '2023-05-04 12:40:00', '2023-05-04 12:40:00'),
(876, 14, 56, 12, '2023-05-18', '10:30:00', '12:00:00', 'thursday', 30, 1, '2023-05-04 12:40:00', '2023-05-04 12:40:00'),
(877, 14, 56, 12, '2023-05-18', '06:00:00', '07:30:00', 'thursday', 10, 1, '2023-05-04 12:40:00', '2023-05-04 12:40:00'),
(878, 14, 56, 12, '2023-05-18', '07:30:00', '09:00:00', 'thursday', 10, 1, '2023-05-04 12:40:00', '2023-05-04 12:40:00'),
(879, 14, 56, 12, '2023-05-18', '09:00:00', '10:30:00', 'thursday', 20, 1, '2023-05-04 12:40:00', '2023-05-04 12:40:00'),
(880, 14, 56, 12, '2023-05-18', '10:30:00', '12:00:00', 'thursday', 30, 1, '2023-05-04 12:40:00', '2023-05-04 12:40:00'),
(881, 14, 56, 12, '2023-05-19', '07:00:00', '08:30:00', 'friday', 20, 1, '2023-05-04 12:40:00', '2023-05-04 12:40:00'),
(882, 14, 56, 12, '2023-05-19', '08:30:00', '10:00:00', 'friday', 50, 1, '2023-05-04 12:40:00', '2023-05-04 12:40:00'),
(883, 14, 56, 12, '2023-05-19', '07:00:00', '08:30:00', 'friday', 20, 1, '2023-05-04 12:40:00', '2023-05-04 12:40:00'),
(884, 14, 56, 12, '2023-05-19', '08:30:00', '10:00:00', 'friday', 50, 1, '2023-05-04 12:40:00', '2023-05-04 12:40:00'),
(885, 14, 56, 12, '2023-05-20', '08:00:00', '09:30:00', 'saturday', 20, 1, '2023-05-04 12:40:00', '2023-05-04 12:40:00'),
(886, 14, 56, 12, '2023-05-20', '09:30:00', '11:00:00', 'saturday', 30, 1, '2023-05-04 12:40:00', '2023-05-04 12:40:00'),
(887, 14, 56, 12, '2023-05-20', '11:00:00', '12:00:00', 'saturday', 50, 1, '2023-05-04 12:40:00', '2023-05-04 12:40:00'),
(888, 14, 56, 12, '2023-05-20', '12:00:00', '13:00:00', 'saturday', 20, 1, '2023-05-04 12:40:00', '2023-05-04 12:40:00'),
(889, 14, 56, 12, '2023-05-20', '08:00:00', '09:30:00', 'saturday', 20, 1, '2023-05-04 12:40:00', '2023-05-04 12:40:00'),
(890, 14, 56, 12, '2023-05-20', '09:30:00', '11:00:00', 'saturday', 30, 1, '2023-05-04 12:40:00', '2023-05-04 12:40:00'),
(891, 14, 56, 12, '2023-05-20', '11:00:00', '12:00:00', 'saturday', 50, 1, '2023-05-04 12:40:00', '2023-05-04 12:40:00'),
(892, 14, 56, 12, '2023-05-20', '12:00:00', '13:00:00', 'saturday', 20, 1, '2023-05-04 12:40:00', '2023-05-04 12:40:00'),
(893, 14, 56, 12, '2023-05-21', '05:00:00', '06:30:00', 'sunday', 510, 1, '2023-05-04 12:40:00', '2023-05-04 12:40:00'),
(894, 14, 56, 12, '2023-05-21', '06:30:00', '08:00:00', 'sunday', 20, 1, '2023-05-04 12:40:00', '2023-05-04 12:40:00'),
(895, 14, 56, 12, '2023-05-21', '08:00:00', '09:00:00', 'sunday', 20, 1, '2023-05-04 12:40:00', '2023-05-04 12:40:00'),
(896, 14, 56, 12, '2023-05-21', '05:00:00', '06:30:00', 'sunday', 510, 1, '2023-05-04 12:40:00', '2023-05-04 12:40:00'),
(897, 14, 56, 12, '2023-05-21', '06:30:00', '08:00:00', 'sunday', 20, 1, '2023-05-04 12:40:00', '2023-05-04 12:40:00'),
(898, 14, 56, 12, '2023-05-21', '08:00:00', '09:00:00', 'sunday', 20, 1, '2023-05-04 12:40:00', '2023-05-04 12:40:00'),
(899, 14, 56, 12, '2023-05-22', '06:00:00', '07:00:00', 'monday', 20, 1, '2023-05-04 12:40:00', '2023-05-04 12:40:00'),
(900, 14, 56, 12, '2023-05-22', '07:00:00', '08:00:00', 'monday', 20, 1, '2023-05-04 12:40:00', '2023-05-04 12:40:00'),
(901, 14, 56, 12, '2023-05-22', '08:00:00', '09:00:00', 'monday', 50, 1, '2023-05-04 12:40:00', '2023-05-04 12:40:00'),
(902, 14, 56, 12, '2023-05-22', '06:00:00', '07:00:00', 'monday', 20, 1, '2023-05-04 12:40:00', '2023-05-04 12:40:00'),
(903, 14, 56, 12, '2023-05-22', '07:00:00', '08:00:00', 'monday', 20, 1, '2023-05-04 12:40:00', '2023-05-04 12:40:00'),
(904, 14, 56, 12, '2023-05-22', '08:00:00', '09:00:00', 'monday', 50, 1, '2023-05-04 12:40:00', '2023-05-04 12:40:00'),
(905, 14, 56, 12, '2023-05-23', '06:00:00', '07:30:00', 'tuesday', 20, 1, '2023-05-04 12:40:00', '2023-05-04 12:40:00'),
(906, 14, 56, 12, '2023-05-23', '07:30:00', '09:00:00', 'tuesday', 20, 1, '2023-05-04 12:40:00', '2023-05-04 12:40:00'),
(907, 14, 56, 12, '2023-05-23', '09:00:00', '10:30:00', 'tuesday', 20, 1, '2023-05-04 12:40:00', '2023-05-04 12:40:00'),
(908, 14, 56, 12, '2023-05-23', '10:30:00', '11:00:00', 'tuesday', 10, 1, '2023-05-04 12:40:00', '2023-05-04 12:40:00'),
(909, 14, 56, 12, '2023-05-23', '06:00:00', '07:30:00', 'tuesday', 20, 1, '2023-05-04 12:40:00', '2023-05-04 12:40:00'),
(910, 14, 56, 12, '2023-05-23', '07:30:00', '09:00:00', 'tuesday', 20, 1, '2023-05-04 12:40:00', '2023-05-04 12:40:00'),
(911, 14, 56, 12, '2023-05-23', '09:00:00', '10:30:00', 'tuesday', 20, 1, '2023-05-04 12:40:00', '2023-05-04 12:40:00'),
(912, 14, 56, 12, '2023-05-23', '10:30:00', '11:00:00', 'tuesday', 10, 1, '2023-05-04 12:40:00', '2023-05-04 12:40:00'),
(913, 14, 56, 12, '2023-05-24', '06:00:00', '07:00:00', 'wednesday', 50, 1, '2023-05-04 12:40:00', '2023-05-04 12:40:00'),
(914, 14, 56, 12, '2023-05-24', '07:00:00', '08:00:00', 'wednesday', 10, 1, '2023-05-04 12:40:00', '2023-05-04 12:40:00'),
(915, 14, 56, 12, '2023-05-24', '08:00:00', '09:00:00', 'wednesday', 50, 1, '2023-05-04 12:40:00', '2023-05-04 12:40:00'),
(916, 14, 56, 12, '2023-05-24', '06:00:00', '07:00:00', 'wednesday', 50, 1, '2023-05-04 12:40:00', '2023-05-04 12:40:00'),
(917, 14, 56, 12, '2023-05-24', '07:00:00', '08:00:00', 'wednesday', 10, 1, '2023-05-04 12:40:00', '2023-05-04 12:40:00'),
(918, 14, 56, 12, '2023-05-24', '08:00:00', '09:00:00', 'wednesday', 50, 1, '2023-05-04 12:40:00', '2023-05-04 12:40:00'),
(919, 14, 56, 12, '2023-05-25', '06:00:00', '07:30:00', 'thursday', 10, 1, '2023-05-04 12:40:00', '2023-05-04 12:40:00'),
(920, 14, 56, 12, '2023-05-25', '07:30:00', '09:00:00', 'thursday', 10, 1, '2023-05-04 12:40:00', '2023-05-04 12:40:00'),
(921, 14, 56, 12, '2023-05-25', '09:00:00', '10:30:00', 'thursday', 20, 1, '2023-05-04 12:40:00', '2023-05-04 12:40:00'),
(922, 14, 56, 12, '2023-05-25', '10:30:00', '12:00:00', 'thursday', 30, 1, '2023-05-04 12:40:00', '2023-05-04 12:40:00'),
(923, 14, 56, 12, '2023-05-25', '06:00:00', '07:30:00', 'thursday', 10, 1, '2023-05-04 12:40:00', '2023-05-04 12:40:00');
INSERT INTO `set_prices_days_slots` (`id`, `set_prices_id`, `dome_id`, `sport_id`, `date`, `start_time`, `end_time`, `day`, `price`, `status`, `created_at`, `updated_at`) VALUES
(924, 14, 56, 12, '2023-05-25', '07:30:00', '09:00:00', 'thursday', 10, 1, '2023-05-04 12:40:00', '2023-05-04 12:40:00'),
(925, 14, 56, 12, '2023-05-25', '09:00:00', '10:30:00', 'thursday', 20, 1, '2023-05-04 12:40:00', '2023-05-04 12:40:00'),
(926, 14, 56, 12, '2023-05-25', '10:30:00', '12:00:00', 'thursday', 30, 1, '2023-05-04 12:40:00', '2023-05-04 12:40:00'),
(927, 14, 56, 12, '2023-05-26', '07:00:00', '08:30:00', 'friday', 20, 1, '2023-05-04 12:40:00', '2023-05-04 12:40:00'),
(928, 14, 56, 12, '2023-05-26', '08:30:00', '10:00:00', 'friday', 50, 1, '2023-05-04 12:40:00', '2023-05-04 12:40:00'),
(929, 14, 56, 12, '2023-05-26', '07:00:00', '08:30:00', 'friday', 20, 1, '2023-05-04 12:40:00', '2023-05-04 12:40:00'),
(930, 14, 56, 12, '2023-05-26', '08:30:00', '10:00:00', 'friday', 50, 1, '2023-05-04 12:40:00', '2023-05-04 12:40:00'),
(931, 14, 56, 12, '2023-05-27', '08:00:00', '09:30:00', 'saturday', 20, 1, '2023-05-04 12:40:00', '2023-05-04 12:40:00'),
(932, 14, 56, 12, '2023-05-27', '09:30:00', '11:00:00', 'saturday', 30, 1, '2023-05-04 12:40:00', '2023-05-04 12:40:00'),
(933, 14, 56, 12, '2023-05-27', '11:00:00', '12:00:00', 'saturday', 50, 1, '2023-05-04 12:40:00', '2023-05-04 12:40:00'),
(934, 14, 56, 12, '2023-05-27', '12:00:00', '13:00:00', 'saturday', 20, 1, '2023-05-04 12:40:00', '2023-05-04 12:40:00'),
(935, 14, 56, 12, '2023-05-27', '08:00:00', '09:30:00', 'saturday', 20, 1, '2023-05-04 12:40:00', '2023-05-04 12:40:00'),
(936, 14, 56, 12, '2023-05-27', '09:30:00', '11:00:00', 'saturday', 30, 1, '2023-05-04 12:40:00', '2023-05-04 12:40:00'),
(937, 14, 56, 12, '2023-05-27', '11:00:00', '12:00:00', 'saturday', 50, 1, '2023-05-04 12:40:00', '2023-05-04 12:40:00'),
(938, 14, 56, 12, '2023-05-27', '12:00:00', '13:00:00', 'saturday', 20, 1, '2023-05-04 12:40:00', '2023-05-04 12:40:00'),
(939, 14, 56, 12, '2023-05-28', '05:00:00', '06:30:00', 'sunday', 510, 1, '2023-05-04 12:40:00', '2023-05-04 12:40:00'),
(940, 14, 56, 12, '2023-05-28', '06:30:00', '08:00:00', 'sunday', 20, 1, '2023-05-04 12:40:00', '2023-05-04 12:40:00'),
(941, 14, 56, 12, '2023-05-28', '08:00:00', '09:00:00', 'sunday', 20, 1, '2023-05-04 12:40:00', '2023-05-04 12:40:00'),
(942, 14, 56, 12, '2023-05-28', '05:00:00', '06:30:00', 'sunday', 510, 1, '2023-05-04 12:40:00', '2023-05-04 12:40:00'),
(943, 14, 56, 12, '2023-05-28', '06:30:00', '08:00:00', 'sunday', 20, 1, '2023-05-04 12:40:00', '2023-05-04 12:40:00'),
(944, 14, 56, 12, '2023-05-28', '08:00:00', '09:00:00', 'sunday', 20, 1, '2023-05-04 12:40:00', '2023-05-04 12:40:00'),
(945, 14, 56, 12, '2023-05-29', '06:00:00', '07:00:00', 'monday', 20, 1, '2023-05-04 12:40:00', '2023-05-04 12:40:00'),
(946, 14, 56, 12, '2023-05-29', '07:00:00', '08:00:00', 'monday', 20, 1, '2023-05-04 12:40:00', '2023-05-04 12:40:00'),
(947, 14, 56, 12, '2023-05-29', '08:00:00', '09:00:00', 'monday', 50, 1, '2023-05-04 12:40:00', '2023-05-04 12:40:00'),
(948, 14, 56, 12, '2023-05-29', '06:00:00', '07:00:00', 'monday', 20, 1, '2023-05-04 12:40:00', '2023-05-04 12:40:00'),
(949, 14, 56, 12, '2023-05-29', '07:00:00', '08:00:00', 'monday', 20, 1, '2023-05-04 12:40:00', '2023-05-04 12:40:00'),
(950, 14, 56, 12, '2023-05-29', '08:00:00', '09:00:00', 'monday', 50, 1, '2023-05-04 12:40:00', '2023-05-04 12:40:00'),
(951, 14, 56, 12, '2023-05-30', '06:00:00', '07:30:00', 'tuesday', 20, 1, '2023-05-04 12:40:00', '2023-05-04 12:40:00'),
(952, 14, 56, 12, '2023-05-30', '07:30:00', '09:00:00', 'tuesday', 20, 1, '2023-05-04 12:40:00', '2023-05-04 12:40:00'),
(953, 14, 56, 12, '2023-05-30', '09:00:00', '10:30:00', 'tuesday', 20, 1, '2023-05-04 12:40:00', '2023-05-04 12:40:00'),
(954, 14, 56, 12, '2023-05-30', '10:30:00', '11:00:00', 'tuesday', 10, 1, '2023-05-04 12:40:00', '2023-05-04 12:40:00'),
(955, 14, 56, 12, '2023-05-30', '06:00:00', '07:30:00', 'tuesday', 20, 1, '2023-05-04 12:40:00', '2023-05-04 12:40:00'),
(956, 14, 56, 12, '2023-05-30', '07:30:00', '09:00:00', 'tuesday', 20, 1, '2023-05-04 12:40:00', '2023-05-04 12:40:00'),
(957, 14, 56, 12, '2023-05-30', '09:00:00', '10:30:00', 'tuesday', 20, 1, '2023-05-04 12:40:00', '2023-05-04 12:40:00'),
(958, 14, 56, 12, '2023-05-30', '10:30:00', '11:00:00', 'tuesday', 10, 1, '2023-05-04 12:40:00', '2023-05-04 12:40:00'),
(959, 14, 56, 12, '2023-05-31', '06:00:00', '07:00:00', 'wednesday', 50, 1, '2023-05-04 12:40:00', '2023-05-04 12:40:00'),
(960, 14, 56, 12, '2023-05-31', '07:00:00', '08:00:00', 'wednesday', 10, 1, '2023-05-04 12:40:00', '2023-05-04 12:40:00'),
(961, 14, 56, 12, '2023-05-31', '08:00:00', '09:00:00', 'wednesday', 50, 1, '2023-05-04 12:40:00', '2023-05-04 12:40:00'),
(962, 14, 56, 12, '2023-05-31', '06:00:00', '07:00:00', 'wednesday', 50, 1, '2023-05-04 12:40:00', '2023-05-04 12:40:00'),
(963, 14, 56, 12, '2023-05-31', '07:00:00', '08:00:00', 'wednesday', 10, 1, '2023-05-04 12:40:00', '2023-05-04 12:40:00'),
(964, 14, 56, 12, '2023-05-31', '08:00:00', '09:00:00', 'wednesday', 50, 1, '2023-05-04 12:40:00', '2023-05-04 12:40:00');

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
(2, 2, 1, NULL, 3, 'domez', 'domez@yopmail.com', 'CA', '1234657890', '$2y$10$z0eXm5BtjQQP77GHRvJAGOIp1osY2Lx0NvMvmkpTgPzpiTUvnIlri', NULL, NULL, NULL, NULL, NULL, 'default.png', 1, 1, 2, '2023-02-06 00:03:03', '2023-02-22 04:12:48'),
(35, 3, 1, NULL, NULL, 'Mona Vosa', 'mona@gmail.com', 'CA', '8946555414', '$2y$10$gtan0ZH/DCiZmnR2yLGiyeZAR0YeEu9krVXGHQfXBqk63ep0WQEEm', NULL, NULL, NULL, NULL, NULL, 'default.png', 1, 1, 2, '2023-05-19 02:22:29', '2023-05-19 05:28:51'),
(34, 3, 1, NULL, NULL, 'Docote Voho', 'docote@gmail.com', 'CA', '54654154654', '$2y$10$gtan0ZH/DCiZmnR2yLGiyeZAR0YeEu9krVXGHQfXBqk63ep0WQEEm', NULL, NULL, NULL, NULL, NULL, 'default.png', 1, 1, 2, '2023-05-19 02:22:29', '2023-05-19 05:28:51'),
(7, 3, 1, NULL, NULL, 'test1', 'dummy@yopmail.com', 'CA', '5445435435', '$2y$10$z0eXm5BtjQQP77GHRvJAGOIp1osY2Lx0NvMvmkpTgPzpiTUvnIlri', NULL, NULL, NULL, '', NULL, 'profiles-64369b0a15641.png', 1, 1, 2, '2023-02-19 02:22:29', '2023-04-13 06:20:49'),
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
(51, 2, 1, NULL, 2, 'Lorem Dome', 'loremdome@yopmail.com', 'CA', '8945454546', '$2y$10$z0eXm5BtjQQP77GHRvJAGOIp1osY2Lx0NvMvmkpTgPzpiTUvnIlri', NULL, NULL, NULL, NULL, '4975', 'default.png', 1, 1, 2, '2023-04-06 00:03:03', '2023-04-19 09:08:35'),
(52, 2, 1, NULL, NULL, 'Carter Dome', 'carterdome@yopmail.com', 'CA', '123890', '$2y$10$z0eXm5BtjQQP77GHRvJAGOIp1osY2Lx0NvMvmkpTgPzpiTUvnIlri', NULL, NULL, NULL, NULL, NULL, 'default.png', 1, 1, 2, '2023-04-06 00:03:03', '2023-02-22 04:12:48'),
(53, 2, 1, NULL, NULL, 'Shotty Dome', 'shottydome@yopmail.com', 'CA', '4651651', '$2y$10$z0eXm5BtjQQP77GHRvJAGOIp1osY2Lx0NvMvmkpTgPzpiTUvnIlri', NULL, NULL, NULL, NULL, NULL, 'default.png', 1, 1, 2, '2023-05-06 00:03:03', '2023-02-22 04:12:48'),
(54, 2, 1, NULL, NULL, 'Jecky\"s Dome', 'jeckydome@yopmail.com', 'CA', '1237890', '$2y$10$x29.6zyEkzk0Vvbp6EmiLeBNtypp3P1AoFkBjj5UHBPtM4uV4VoQS', NULL, NULL, NULL, NULL, '0', 'default.png', 1, 1, 2, '2023-07-06 00:03:03', '2023-04-28 08:18:05'),
(55, 2, 1, NULL, NULL, 'Domaz Domez', 'domazdomez@yopmail.com', 'CA', '894651651', '$2y$10$z0eXm5BtjQQP77GHRvJAGOIp1osY2Lx0NvMvmkpTgPzpiTUvnIlri', NULL, NULL, NULL, NULL, NULL, 'default.png', 1, 1, 2, '2023-07-06 00:03:03', '2023-02-22 04:12:48'),
(56, 2, 1, NULL, NULL, 'Lomar Dome', 'lomardome@yopmail.com', 'CA', '894546515', '$2y$10$z0eXm5BtjQQP77GHRvJAGOIp1osY2Lx0NvMvmkpTgPzpiTUvnIlri', NULL, NULL, NULL, NULL, NULL, 'default.png', 1, 1, 2, '2023-08-06 00:03:03', '2023-02-22 04:12:48'),
(57, 2, 1, NULL, NULL, 'Ikara Dome', 'ikaradome@yopmail.com', 'CA', '4545151', '$2y$10$z0eXm5BtjQQP77GHRvJAGOIp1osY2Lx0NvMvmkpTgPzpiTUvnIlri', NULL, NULL, NULL, NULL, NULL, 'default.png', 1, 1, 2, '2023-08-06 00:03:03', '2023-02-22 04:12:48'),
(58, 2, 1, NULL, NULL, 'Sitara Domez', 'sitaradome@yopmail.com', 'CA', '84651151', '$2y$10$z0eXm5BtjQQP77GHRvJAGOIp1osY2Lx0NvMvmkpTgPzpiTUvnIlri', NULL, NULL, NULL, NULL, NULL, 'default.png', 1, 1, 2, '2023-09-06 00:03:03', '2023-02-22 04:12:48'),
(59, 2, 1, NULL, NULL, 'Coras Domez', 'corasdomez@yopmail.com', 'CA', '654565615', '$2y$10$z0eXm5BtjQQP77GHRvJAGOIp1osY2Lx0NvMvmkpTgPzpiTUvnIlri', NULL, NULL, NULL, NULL, NULL, 'default.png', 1, 1, 2, '2023-10-06 00:03:03', '2023-02-22 04:12:48'),
(60, 2, 1, NULL, NULL, 'Just Play Domez', 'justplaydomez@yopmail.com', 'CA', '5854854', '$2y$10$z0eXm5BtjQQP77GHRvJAGOIp1osY2Lx0NvMvmkpTgPzpiTUvnIlri', NULL, NULL, NULL, NULL, NULL, 'default.png', 1, 1, 2, '2023-10-06 00:03:03', '2023-02-22 04:12:48'),
(61, 4, 1, 2, NULL, 'Employee 1', 'emp1@gmail.com', NULL, NULL, '$2y$10$JrluFobu/xBEBKQZY1kr6.gAJe4QGuWZP6Ugp6ctXHWz4My5lnfeO', NULL, NULL, NULL, NULL, NULL, 'default.png', 1, 1, 2, '2023-03-29 09:29:58', '2023-04-21 10:05:29'),
(62, 3, 1, NULL, NULL, NULL, 's@gmail.com', NULL, NULL, '$2y$10$Em2kx11cJcQLN9iM2mK/ueOh7FrLUkTYOPxRt3AurFEAbITt67ZsK', NULL, NULL, NULL, NULL, NULL, 'default.png', 1, 1, 2, '2023-04-05 08:49:20', '2023-04-05 08:49:20'),
(63, 3, 1, NULL, NULL, 'santosh', 'santosh.vrajtechnosys@gmail.com', 'IN', '9998557245', '$2y$10$yd.DhVEEvTXUpF4M9mSueOwGzllrd8IGtUoa.PY9zA2Cl/DRQHW5O', NULL, NULL, NULL, NULL, NULL, 'default.png', 1, 1, 2, '2023-04-06 04:58:01', '2023-04-06 04:58:01'),
(64, 3, 1, NULL, NULL, NULL, 'null', NULL, NULL, '$2y$10$LhL0JeLWTAEE5atbggy4qO0Rq2bWdUpOiRAkeQZEEGoTsPdyE7zXG', NULL, NULL, NULL, NULL, NULL, 'default.png', 1, 1, 2, '2023-04-06 08:41:38', '2023-04-06 08:41:38'),
(65, 3, 1, NULL, NULL, NULL, 'abcd@gmail.com', NULL, NULL, '$2y$10$g0vu7lRdsBxOGbJiSPg0N.b6q/Q9Auvfdfi.sIQoiisl9xwM15sci', NULL, NULL, NULL, NULL, NULL, 'default.png', 1, 1, 2, '2023-04-06 08:47:26', '2023-04-06 08:47:26'),
(66, 3, 1, NULL, NULL, 'soham', 'domez@gmail.com', 'CA', '6359478772', '$2y$10$1cbNnJ379uwLbf0cBlmooupypHFEzQDVdZWL5jgA0XHfnYseLtpD2', NULL, NULL, NULL, '', NULL, 'default.png', 1, 1, 2, '2023-04-06 08:54:44', '2023-04-09 05:28:40'),
(94, 3, 2, NULL, NULL, 'Soham Shah', 'developersoham7@gmail.com', '', '', NULL, '102066544323619435645', NULL, NULL, '', NULL, 'default.png', 1, 1, 2, '2023-04-21 11:27:41', '2023-04-21 11:27:41'),
(69, 3, 1, NULL, NULL, 'diwakar', 'shivakar@gmail.com', 'CA', '1556699777', '$2y$10$gOpL3PLWkmtYfV81XSRZuOZYDR.msIC0w/Vve5g8/qbjGLzGZ3xze', NULL, NULL, NULL, '', NULL, 'profiles-642ebfd246f2a.png', 1, 1, 2, '2023-04-06 09:50:53', '2023-04-08 12:03:43'),
(70, 3, 1, NULL, NULL, 'test1', 'merry@gmail.com', 'CA', '6359478772', '$2y$10$2FVv8hx6eQKUDRINeMQPV.zLye95Og0u1GhYlXUV419PLAJIx6Bfm', NULL, NULL, NULL, '', NULL, 'default.png', 1, 1, 2, '2023-04-06 10:06:53', '2023-04-06 10:06:53'),
(71, 3, 1, NULL, NULL, 'Harshi Soham', 'harshisoham@gmail.com', 'IN', '6359496669', '$2y$10$Hq1ytlv4YIGouAbVxUAxaOE7ABZH.MgbC1LPWKmt41N/hHmRigaqu', NULL, NULL, NULL, '', NULL, 'default.png', 1, 1, 2, '2023-04-06 10:12:50', '2023-04-06 10:21:27'),
(72, 3, 1, NULL, NULL, 'khushi Sheth', 'khushi@gmail.com', 'CA', '6359487667', '$2y$10$XBnd9zLsm7UwUbr8rn3FWenmjzNIMPq/3pO6V5kxLTwkWvdJD5Pou', NULL, NULL, NULL, '', NULL, 'profiles-642eb73a6308e.png', 1, 1, 2, '2023-04-06 10:54:41', '2023-04-06 12:12:42'),
(73, 3, 1, NULL, NULL, 'test1', 'shivdxxa@gmail.comx', 'CA', '12345679', '$2y$10$xVmIHKFe/rH6Kk2fqG1G7uiUry3FTmYumXsyLswaLB9T0Lz7Un4Tu', NULL, NULL, NULL, '', NULL, 'default.png', 1, 1, 2, '2023-04-08 12:00:31', '2023-04-08 12:00:31'),
(74, 3, 1, NULL, NULL, 'test1', 'shivdxxtta@gmail.comx', 'CA', '12345679', '$2y$10$0z8f/kn1CtWhFEP9J5QL5e7jxRENI090E4pe./BPaBIQzI07htx56', NULL, NULL, NULL, '', NULL, 'default.png', 1, 1, 2, '2023-04-08 12:00:48', '2023-04-08 12:00:48'),
(75, 3, 1, NULL, NULL, 'test1', 'shivdxxtt5a@gmail.comx', 'CA', '123456795', '$2y$10$lv6v6tSgefQElc0BLcOKzOPR30ZbNdhoEpuhqpTrtWOhc/Or5I7gS', NULL, NULL, NULL, '', NULL, 'default.png', 1, 1, 2, '2023-04-08 12:01:00', '2023-04-08 12:01:00'),
(76, 3, 1, NULL, NULL, 'cc', 'd@gmail.com', 'CA', '2257456654', '$2y$10$Bvqk37uodVDmjfthpTSQF.dX4dP2S3/Q/1CmeQLZeArqpYf59J2Vu', NULL, NULL, NULL, '', NULL, 'profiles-643692cf7abc7.png', 1, 1, 2, '2023-04-08 12:04:47', '2023-04-12 11:15:27'),
(77, 2, 1, NULL, NULL, 'test', 'test@yopmail.com', NULL, '1234567890', '$2y$10$TxjYjP9a8TEpBSEhNnNDHerPNPSWIu1/6Nca8JWKrBjRwalBWb59.', NULL, NULL, NULL, NULL, NULL, 'default.png', 1, 1, 2, '2023-04-09 04:23:27', '2023-04-09 04:59:56'),
(78, 3, 1, NULL, NULL, 'Soham', 'soham.vrajtechnosys@gmail.com', 'CA', '6358948725', '$2y$10$v5XC2Y7ekv6ZYL.IYcXKauF1STHmgnEjJx0VuDEeYpFMhtAHTx84S', NULL, NULL, NULL, '', NULL, 'default.png', 1, 1, 2, '2023-04-09 05:52:45', '2023-04-09 05:52:45'),
(79, 3, 1, NULL, NULL, 'soham', 'diwakar.vrajtechnosys@gmail.com', 'CA', '6359478771', '$2y$10$Be57UGLm2GgtihGkP.Knz.wCWMBqSNoFG/XxBrKgV9kSt7st6qNaW', NULL, NULL, NULL, '', NULL, 'profiles-64352dccc1211.png', 1, 1, 2, '2023-04-10 08:42:48', '2023-04-11 09:52:12'),
(87, 3, 1, NULL, NULL, NULL, 'gfg@gmail.com', NULL, NULL, '$2y$10$5gLBQ6MVQKwmE54vsWMa3OXtdwUCVWyvEZyx9zP83niqpn19n8IbW', NULL, NULL, NULL, NULL, NULL, 'default.png', 1, 1, 2, '2023-04-14 11:27:48', '2023-04-14 11:27:48'),
(80, 5, 1, 2, NULL, 'provider 123', 'provider@yopmail.com', NULL, NULL, '$2y$10$cqtH6uTTZ9sx12dNQFpbE.n3TECEuOAcfLzEee00b2fVdu/1OOJiW', NULL, NULL, NULL, NULL, NULL, 'default.png', 1, 1, 2, '2023-04-11 15:11:21', '2023-04-21 10:10:53'),
(81, 3, 1, NULL, NULL, NULL, 'developersoham7@gmail.com', NULL, NULL, '$2y$10$Xv4oGUmtEuQFstrD1lJQVe67wvLXchUTCbvrSaCP4MxRvx5uxTak2', NULL, NULL, NULL, NULL, NULL, 'default.png', 1, 1, 2, '2023-04-12 05:24:59', '2023-04-12 05:24:59'),
(82, 3, 1, NULL, NULL, NULL, 'sohamshah7120@gmaill.com', NULL, NULL, '$2y$10$OfttbpfmvnSI18VY5i/UDuwRc2zf702UdCAoW5xtUjd/lX6a3RW0y', NULL, NULL, NULL, NULL, NULL, 'default.png', 1, 1, 2, '2023-04-12 06:11:12', '2023-04-12 06:11:12'),
(83, 3, 1, NULL, NULL, NULL, 'sohamshah712@gmail.com', NULL, NULL, '$2y$10$/BbeN7fZ86aVJyoVK12vSeJUe5hXeMYHwOXTtio7f7XO7KlUt7b/y', NULL, NULL, NULL, NULL, NULL, 'default.png', 1, 1, 2, '2023-04-12 06:53:04', '2023-04-12 06:53:04'),
(84, 3, 1, NULL, NULL, NULL, 'de@gmail.com', NULL, NULL, '$2y$10$ghuQ.gJ2mDaSrh2KkpoGmeeFcJhrT5/as7Q6P8PdZlMLuM.xhcnre', NULL, NULL, NULL, NULL, NULL, 'default.png', 1, 1, 2, '2023-04-12 07:27:00', '2023-04-12 07:27:00'),
(85, 3, 1, NULL, NULL, NULL, 'soham@gmail.com', NULL, NULL, '$2y$10$3Jgb6YFWvR69LrV/vdGY9.k9/mKwdE58z3yA.dTE1eyvyRpXXqWG2', NULL, NULL, NULL, NULL, NULL, 'default.png', 1, 1, 2, '2023-04-12 07:49:14', '2023-04-12 07:49:14'),
(86, 3, 1, NULL, NULL, NULL, 'dfvdfv@gmail.com', NULL, NULL, '$2y$10$6BC8DWEf02k/lbAQA7wLxuIHz7af2zDhCz.2zZ6CGxWWGO4srmNKq', NULL, NULL, NULL, NULL, NULL, 'default.png', 1, 1, 2, '2023-04-12 07:53:26', '2023-04-12 07:53:26'),
(88, 3, 1, NULL, NULL, NULL, 'dsa@gmail.com', NULL, NULL, '$2y$10$9LYV5uhNGg8IbviMLjykr..yi7AZAUK.v61jDzToSzMgf8dy.zbkS', NULL, NULL, NULL, NULL, NULL, 'default.png', 1, 1, 2, '2023-04-14 11:30:46', '2023-04-14 11:30:46'),
(93, 5, 1, 51, NULL, 'Lorem Provider', 'loremprovider@yopmail.com', NULL, NULL, '$2y$10$cPLiVS76oFh05Tq1Y0rOsOv3kcXq2xkdktl4EKqRt1eoJHIionpbu', NULL, NULL, NULL, NULL, NULL, 'default.png', 1, 1, 2, '2023-04-19 11:45:44', '2023-04-19 11:45:44'),
(95, 2, 1, NULL, 1, 'Dhrutish Ramoliya', 'dhrutish.vrajtechnosys@gmail.com', NULL, '0123456789', '$2y$10$Z0JamgmvCxagvyI0ics1..ypXYBSVmTepm0RHkpT9ux5LdN5dik0m', NULL, NULL, NULL, NULL, NULL, 'profiles-644a0f6f15a2d.jpg', 1, 1, 2, '2023-04-27 05:58:07', '2023-04-27 06:15:11'),
(96, 2, 1, NULL, 1, 'Rahul Ghaskata', 'rahul.vrajtechnosys@gmail.com', NULL, '0123456798', '$2y$10$vdGrEPZuxEa.qq3AqFp1A.ZLg/CGabEx3utypXLGZUUjJJf1gpcsi', NULL, NULL, NULL, NULL, NULL, 'default.png', 1, 1, 2, '2023-04-27 09:51:01', '2023-04-27 13:10:40'),
(97, 2, 1, NULL, 1, 'hiren', 'hiren@yopmail.com', NULL, '1234567890', '$2y$10$9PxlKw8UuIItY/VBvQcLPOvUJfrAYgPJEaZtVDi0VpEQIp01qHBlG', NULL, NULL, NULL, NULL, NULL, 'default.png', 1, 1, 2, '2023-05-04 10:33:54', '2023-05-04 10:34:33');

-- --------------------------------------------------------

--
-- Table structure for table `working_hours`
--

CREATE TABLE `working_hours` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `vendor_id` int(11) NOT NULL,
  `dome_id` int(11) NOT NULL,
  `day` varchar(255) NOT NULL,
  `open_time` time NOT NULL,
  `close_time` time NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `working_hours`
--

INSERT INTO `working_hours` (`id`, `vendor_id`, `dome_id`, `day`, `open_time`, `close_time`, `created_at`, `updated_at`) VALUES
(1, 2, 55, 'monday', '03:00:00', '18:00:00', '2023-05-02 12:24:13', '2023-05-03 05:53:01'),
(2, 2, 55, 'tuesday', '05:00:00', '16:00:00', '2023-05-02 12:24:13', '2023-05-03 05:53:01'),
(3, 2, 55, 'wednesday', '10:00:00', '15:00:00', '2023-05-02 12:24:13', '2023-05-03 05:53:01'),
(4, 2, 55, 'thursday', '13:00:00', '20:00:00', '2023-05-02 12:24:13', '2023-05-03 05:53:01'),
(5, 2, 55, 'friday', '12:00:00', '22:00:00', '2023-05-02 12:24:13', '2023-05-03 05:53:01'),
(6, 2, 55, 'saturday', '15:00:00', '20:00:00', '2023-05-02 12:24:13', '2023-05-03 05:53:01'),
(7, 2, 55, 'sunday', '06:00:00', '11:00:00', '2023-05-02 12:24:13', '2023-05-03 05:53:01'),
(8, 2, 35, 'monday', '07:00:00', '18:00:00', '2023-05-03 03:47:23', '2023-05-04 05:35:33'),
(9, 2, 35, 'tuesday', '12:00:00', '19:00:00', '2023-05-03 03:47:23', '2023-05-04 05:35:33'),
(10, 2, 35, 'wednesday', '09:00:00', '17:00:00', '2023-05-03 03:47:23', '2023-05-04 05:35:33'),
(11, 2, 35, 'thursday', '10:00:00', '14:00:00', '2023-05-03 03:47:23', '2023-05-04 05:35:33'),
(12, 2, 35, 'friday', '12:00:00', '17:00:00', '2023-05-03 03:47:23', '2023-05-04 05:35:33'),
(13, 2, 35, 'saturday', '10:00:00', '17:00:00', '2023-05-03 03:47:23', '2023-05-04 05:35:33'),
(14, 2, 35, 'sunday', '11:00:00', '16:00:00', '2023-05-03 03:47:23', '2023-05-04 05:35:33'),
(15, 97, 56, 'monday', '06:00:00', '09:00:00', '2023-05-04 10:38:49', '2023-05-04 12:36:23'),
(16, 97, 56, 'tuesday', '06:00:00', '11:00:00', '2023-05-04 10:38:49', '2023-05-04 12:36:23'),
(17, 97, 56, 'wednesday', '06:00:00', '09:00:00', '2023-05-04 10:38:49', '2023-05-04 12:36:23'),
(18, 97, 56, 'thursday', '06:00:00', '12:00:00', '2023-05-04 10:38:49', '2023-05-04 12:36:23'),
(19, 97, 56, 'friday', '07:00:00', '10:00:00', '2023-05-04 10:38:49', '2023-05-04 12:36:23'),
(20, 97, 56, 'saturday', '08:00:00', '13:00:00', '2023-05-04 10:38:49', '2023-05-04 12:36:23'),
(21, 97, 56, 'sunday', '05:00:00', '09:00:00', '2023-05-04 10:38:49', '2023-05-04 12:36:23');

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
-- Indexes for table `working_hours`
--
ALTER TABLE `working_hours`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cms`
--
ALTER TABLE `cms`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `domes`
--
ALTER TABLE `domes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `dome_images`
--
ALTER TABLE `dome_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `enquiries`
--
ALTER TABLE `enquiries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `favourites`
--
ALTER TABLE `favourites`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=152;

--
-- AUTO_INCREMENT for table `fields`
--
ALTER TABLE `fields`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `leagues`
--
ALTER TABLE `leagues`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `payment_gateways`
--
ALTER TABLE `payment_gateways`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `set_prices`
--
ALTER TABLE `set_prices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `set_prices_days_slots`
--
ALTER TABLE `set_prices_days_slots`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=965;

--
-- AUTO_INCREMENT for table `sports`
--
ALTER TABLE `sports`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=98;

--
-- AUTO_INCREMENT for table `working_hours`
--
ALTER TABLE `working_hours`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
