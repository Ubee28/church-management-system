-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 08, 2026 at 04:36 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `remnant_church`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(50) NOT NULL,
  `admin_fullname` varchar(255) NOT NULL,
  `admin_email` varchar(255) NOT NULL,
  `admin_password` varchar(255) NOT NULL,
  `admin_lastloggedin` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `admin_fullname`, `admin_email`, `admin_password`, `admin_lastloggedin`) VALUES
(5, 'dorothy Ukpong', 'dorathymiles@gmail.com', '$2y$10$/XYUHk7r8VfSnAAUP5/8ZOMDhqLpObMiXv0hh7XNVadSb0g1uMHzO', '2024-09-03 04:48:54'),
(6, 'Bola Ahmed', 'Bola@gmail.com', '$2y$10$0ltgxUd6SMJf86tq1GDgtukwPNGZVrMGWjzx/8rMlxA9HvpeH/tpS', '2024-09-11 04:49:12'),
(7, 'Ubong Elijah', 'danelijah7@gmail.com', '$2y$10$UjXS9OEtfAIpOvPunpD5BOUS5B4e8.v74WoOEH6tEMxCs/FSKqB.O', '2024-09-25 05:47:06');

-- --------------------------------------------------------

--
-- Table structure for table `donations`
--

CREATE TABLE `donations` (
  `donation_id` int(11) NOT NULL,
  `member_id` int(11) DEFAULT NULL,
  `donor_name` varchar(100) DEFAULT NULL,
  `donor_email` varchar(100) DEFAULT NULL,
  `donor_phone` varchar(20) DEFAULT NULL,
  `purpose` varchar(100) DEFAULT NULL,
  `amount` decimal(12,2) DEFAULT NULL,
  `is_anonymous` tinyint(1) DEFAULT 0,
  `payment_method` varchar(100) DEFAULT NULL,
  `status` enum('pending','successful','failed','abandoned') DEFAULT 'pending',
  `prayer_request` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `reference` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `donations`
--

INSERT INTO `donations` (`donation_id`, `member_id`, `donor_name`, `donor_email`, `donor_phone`, `purpose`, `amount`, `is_anonymous`, `payment_method`, `status`, `prayer_request`, `created_at`, `reference`) VALUES
(1, NULL, 'Ubong Daniel Elijah', 'danelijah7@gmail.com', '08086270309', 'Offering', 10000.00, 1, 'card', 'pending', 'Purpose re-alignment', '2026-06-16 14:15:04', 'DON_1781619304_6a315a6808e28'),
(2, NULL, 'Ubong Daniel Elijah', 'danelijah7@gmail.com', '08086270309', 'Select Donation purpose', 2000.00, 0, 'card', 'pending', '', '2026-06-17 04:05:48', 'DON_1781669148_6a321d1c09ac8'),
(3, NULL, 'Ubong Daniel Elijah', 'danelijah7@gmail.com', '08086270309', 'Select Donation purpose', 2000.00, 0, 'card', 'pending', '', '2026-06-17 08:44:45', 'DON_1781685885_6a325e7d08d3c'),
(4, NULL, 'Ubong Daniel Elijah', 'danelijah7@gmail.com', '08086270309', 'Offering', 2000.00, 0, 'card', 'pending', 'Grace to become a true disciple', '2026-06-17 09:40:05', 'DON_1781689205_6a326b75e62b2'),
(5, NULL, 'Ubong Daniel Elijah', 'danelijah7@gmail.com', '08086270309', 'Building Project', 5000.00, 0, 'card', 'pending', 'eyes to see, ears to hear.', '2026-06-17 09:50:13', 'DON_1781689813_6a326dd55c5ff'),
(6, NULL, 'Ubong Daniel Elijah', 'danelijah7@gmail.com', '08086270309', 'Building Project', 5000.00, 0, 'card', 'pending', 'eyes to see, ears to hear.', '2026-06-17 10:29:51', 'DON_1781692191_6a32771faa1c0'),
(7, NULL, 'Ubong Daniel Elijah', 'danelijah7@gmail.com', '08086270309', 'Offering', 5000.00, 0, 'card', 'pending', 'eyes to see, ears to hear', '2026-06-17 10:55:32', 'DON_1781693732_6a327d248771d'),
(8, NULL, 'Ubong Daniel Elijah', 'danelijah7@gmail.com', '08086270309', 'Offering', 100.00, 0, 'card', 'failed', 'eyes to see, ears to hear', '2026-06-17 14:43:38', 'DON_1781707418_6a32b29ae5199'),
(9, NULL, 'Ubong Daniel Elijah', 'danelijah7@gmail.com', '08086270309', 'Thanksgiving', 100.00, 0, 'card', 'failed', 'To work toward meeting all the conditions that makes for a disciple ', '2026-06-17 15:03:26', 'DON_1781708606_6a32b73e925f4'),
(10, NULL, 'ezra elijah', 'ub.devops7@gmail.com', '07050962997', 'Missions', 50.00, 0, 'card', 'failed', 'hejdhe', '2026-06-17 15:12:43', 'DON_1781709163_6a32b96b16567'),
(11, NULL, 'Ubong Daniel Elijah', 'ub.devops7@gmail.com', '07050962997', 'Thanksgiving', 70.00, 1, 'card', 'pending', 'widow&#039;s mite', '2026-06-17 22:17:38', 'DON_1781734658_6a331d02930ee'),
(12, NULL, 'Ajibola Praise', 'ub.devops7@gmail.com', '08086270309', 'Welfare Support', 200.00, 0, 'card', 'successful', 'let me serious Oh Lord', '2026-06-18 17:22:56', 'DON_1781803376_6a34297088c73'),
(13, NULL, 'Ubong Daniel Elijah', 'danelijah7@gmail.com', '08086270309', 'Missions', 1000.00, 1, 'card', 'pending', 'fdgfjh', '2026-06-18 18:28:42', 'DON_1781807322_6a3438da596e7'),
(14, 5, 'Ubong Daniel Elijah', 'danelijah7@gmail.com', '08086270309', 'Thanksgiving', 5000.00, 0, 'card', 'failed', 'hgjhjjjjkl', '2026-06-19 09:31:35', 'DON_1781861495_6a350c7705c71'),
(15, 5, 'Ubong Daniel Elijah', 'danelijah7@gmail.com', '08086270309', 'Welfare Support', 10000.00, 0, 'card', 'pending', 'jkjk;;ll;', '2026-06-19 09:42:27', 'DON_1781862147_6a350f0339b06'),
(16, NULL, 'Ubong Daniel Elijah', 'danelijah7@gmail.com', '08086270309', 'Offering', 20000.00, 0, 'card', 'pending', '', '2026-06-23 13:51:36', 'DON_1782222696_6a3a8f68d91bd'),
(17, NULL, 'Ubong Daniel Elijah', 'danelijah7@gmail.com', '08086270309', 'Offering', 34566.00, 0, 'card', 'pending', '', '2026-06-24 13:24:19', 'DON_1782307459_6a3bda83dc26e');

-- --------------------------------------------------------

--
-- Table structure for table `donation_purposes`
--

CREATE TABLE `donation_purposes` (
  `purpose_id` int(11) NOT NULL,
  `purpose_name` varchar(100) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `active` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `donation_purposes`
--

INSERT INTO `donation_purposes` (`purpose_id`, `purpose_name`, `description`, `active`) VALUES
(1, 'Levite Fund', 'A fund to support those who are willing to give themselves fulltime to the service of the ministry just as the levites in the scriptures did. As such their needs must be taken care of.', 1),
(2, 'Tithe', 'Contrary to what is majorly taught in the church in Nigeria, it is some of the tithe that was requested by the Lord not all', 1),
(3, 'Offering', 'There are many things we may give as offerings to the Lord other than our money. We could give our time, physical effort and so', 1),
(4, 'Accomodations', 'Raising disciples is not an esay task. It is infact space consuming. The littlelest amount could subsidize accomodations for one who is ready for discipleship and on who is in need', 1),
(5, 'GAMAID', 'GAMAID is our contribution of love and support to society modelling Jesus\' life of giving and empathy.', 1);

-- --------------------------------------------------------

--
-- Table structure for table `donation_receipts`
--

CREATE TABLE `donation_receipts` (
  `receipt_id` int(11) NOT NULL,
  `donation_id` int(11) DEFAULT NULL,
  `receipt_number` varchar(50) DEFAULT NULL,
  `generated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `event_id` int(11) NOT NULL,
  `event_name` varchar(255) NOT NULL,
  `event_date` date NOT NULL,
  `event_time` time NOT NULL,
  `event_location` varchar(255) NOT NULL,
  `event_desc` varchar(255) NOT NULL,
  `event_type` enum('Upcoming','Past','Special','') NOT NULL,
  `event_flier` varchar(255) NOT NULL,
  `in_carousel` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`event_id`, `event_name`, `event_date`, `event_time`, `event_location`, `event_desc`, `event_type`, `event_flier`, `in_carousel`) VALUES
(1, 'Charity Fundraiser', '2024-09-15', '10:00:00', 'New York', ' A fundraiser for the mission effort in the Dazigau area of Damaturu, Yobe state.', 'Past', 'uploads/fliers/blog1.jpg', 1),
(2, 'Youth Conference', '2024-10-05', '09:38:43', 'Los Angeles', 'A conference focused on youth development.', 'Past', 'uploads/fliers/blog1.jpg', 0),
(3, 'Annual Meeting', '2024-11-20', '09:39:06', 'Chicago', 'Annual general meeting for all members.', 'Past', 'uploads/fliers/blog1.jpg', 0),
(4, 'Christmas Gala', '2024-12-24', '09:39:23', 'Boston', 'A festive celebration for the church community.', 'Upcoming', 'uploads/fliers/blog1.jpg', 0),
(5, 'Leadership Workshop', '2024-09-28', '09:39:45', 'Houston', 'A workshop for upcoming leaders.', 'Past', 'uploads/fliers/blog1.jpg', 1),
(6, 'Annual Retreat', '2024-09-22', '10:00:00', 'Emerald Hotels, Uyo, Akwa-Ibom State, Nigeria.', 'The end of the Age:Preparations and Expectations.', 'Past', 'uploads/fliers/blog1.jpg', 1),
(7, 'Last Sunday of the Month Service', '2024-09-29', '09:00:00', 'RCM Auditorium Yaba, Lagos, Nigeria.', 'A prayer day for entering the new month.', 'Past', 'uploads/fliers/blog1.jpg', 0),
(11, 'Youth Ignite 2024', '2024-09-21', '05:30:00', '78, Marine road, Olodi-Apapa, Lagos.', 'This is an event organized to ignite the fires of the youths of this generation for kingdom greatness.', 'Past', 'uploads/fliers/blog1.jpg', 1),
(12, 'Youth Ignite 2024', '2024-12-15', '08:30:00', '78, Marine road, Olodi-Apapa, Lagos.', 'hfjgjvght', 'Upcoming', 'uploads/fliers/blog1.jpg', 0),
(13, 'Prophetic conclave 2 2024', '2024-11-17', '09:00:00', '15, Ikpa road, Uyo, Akwa-Ibom state, Nigeria.', 'testing update method', 'Past', 'uploads/fliers/blog1.jpg', 0),
(15, 'Prophetic conclave 2026', '2026-01-04', '01:48:00', '15, Ikpa road, Uyo, Akwa-Ibom state, Nigeria.', 'tt5yu6u6565', 'Special', 'fbdudes.PNG', 0),
(16, 'Prophetic conclave 2027', '2024-11-22', '10:00:00', '78, Marine road, Olodi-Apapa, Lagos.', 'Another time understanding prophetic ministry', 'Past', 'fbdudes.PNG', 0),
(17, 'Youth Ignite 2025', '2024-11-22', '10:00:00', '78, Marine road, Olodi-Apapa, Lagos.', 'Another time with God', 'Past', '../uploads/ytClone.PNG', 0),
(18, 'Tabernacles conference 2024', '2024-11-23', '10:00:00', '15, Ikpa road, Uyo, Akwa-Ibom state, Nigeria.', 'The experience....', 'Past', '../uploads/blog1.jpg', 0),
(19, 'Women in Ministry', '2026-05-31', '09:00:00', 'conference center University of Lagos, Akoka Lagos.', 'A conference to answer questions and end debates about women in ministry', 'Upcoming', '../uploads/send_to_GPT.png', 0);

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `member_id` int(11) NOT NULL,
  `member_fname` varchar(255) NOT NULL,
  `member_lname` varchar(255) NOT NULL,
  `member_email` varchar(100) NOT NULL,
  `member_phone` varchar(20) NOT NULL,
  `member_dob` date NOT NULL,
  `member_address` varchar(255) NOT NULL,
  `member_pwd` varchar(255) NOT NULL,
  `date_added` datetime DEFAULT current_timestamp(),
  `member_status` enum('active','inactive','','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`member_id`, `member_fname`, `member_lname`, `member_email`, `member_phone`, `member_dob`, `member_address`, `member_pwd`, `date_added`, `member_status`) VALUES
(2, 'Adesina', 'Dorathy', 'adesina@gmail.com', '2147463647', '1979-07-04', '17, Idewu Street, Olodi-Apapa, Lagos', '$2y$10$r.sFdyHEPJwRXTHd7IA5k.Wl21eSkKQwNIOkvBxz0rhbsh2SpRUce', '2024-09-11 21:20:18', 'active'),
(3, 'Tunde', 'Wasiu', 'taiwo@gmail.com', '2147483647', '1995-01-04', '17, Idewu Street, Olodi-Apapa, Lagos.', '$2y$10$wMbebmDhdYsIU9tCsxkevumnMV8Wqg.Q4XBNrvxK17IXuEPuMK0aS', '2024-09-13 22:05:30', 'active'),
(5, 'somto', 'anado', 'somto@gmail.com', '2147483647', '1997-06-07', '2, Idewu street,Olodi-Apapa, Lagos', '$2y$10$WL990l80bveIlsgqbKpbeOgBfaEARkHkgiSSSbkIVb3LJ2Ib2rsPu', '2024-09-26 22:06:43', 'active'),
(6, 'Nsikan', 'Wasiu', 'Nsikan@gmail.com', '080155992345', '2003-06-02', '17, Idewu Street, Olodi-Apapa, Lagos.', '$2y$10$k1jMGjY3R0MHcLGWbiD5feO90/hQgqP44ApQlis0o8.SjFFI.Wrw2', '2024-09-24 22:06:08', 'active'),
(7, 'Ubong', 'Elijah', 'danelijah7@gmail.com', '08086270309', '2026-06-03', '5 Iyalode Street, Raliatu boundary-ajegule, Lagos.', '$2y$10$4qzTTptdfOQdGjm43YA3iedjLdlnLpcmdaAtw725lMTMMTLZAGSCi', '2026-06-19 12:28:32', 'active'),
(8, 'Praise', 'Ajibola', 'preciousAjibola@gmail.com', '44446677889', '2026-06-01', '5 Iyalode Street, Raliatu boundary-ajegule, Lagos.', '$2y$10$HLZ1AUG4cTGrbnVf7/X/CuaDh6QuJmspc8FaGgroT9lcsoXKd94nK', '2026-06-20 12:45:21', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `type` varchar(50) NOT NULL,
  `message` text NOT NULL,
  `flier` varchar(255) DEFAULT NULL,
  `audience` varchar(50) NOT NULL,
  `status` enum('unread','read') DEFAULT 'unread',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `type`, `message`, `flier`, `audience`, `status`, `created_at`) VALUES
(2, 'new_event', 'A new event, \"Tabernacles conference 2024\", has been added!', '../uploads/blog1.jpg', 'all_members', 'read', '2024-11-23 17:20:25'),
(3, 'new_event', 'A new event, \"Women in Ministry\", has been added!', '../uploads/send_to_GPT.png', 'all_members', 'read', '2026-05-24 14:14:18');

-- --------------------------------------------------------

--
-- Table structure for table `pastors`
--

CREATE TABLE `pastors` (
  `pastor_id` int(20) NOT NULL,
  `pastor_fullname` varchar(255) NOT NULL,
  `pastor_email` varchar(50) NOT NULL,
  `pastor_phone` int(20) NOT NULL,
  `pastor_address` varchar(255) NOT NULL,
  `pastor_pwd` varchar(255) NOT NULL,
  `date_added` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pastors`
--

INSERT INTO `pastors` (`pastor_id`, `pastor_fullname`, `pastor_email`, `pastor_phone`, `pastor_address`, `pastor_pwd`, `date_added`) VALUES
(1, 'Rev. Mikel Udoh', 'MikelUdoh@gmail.com', 812346677, '23, Mokoya street, olodi-apapa, Lagos, Nigeria.', '', '2024-11-10 15:56:36'),
(2, 'Rev Stephen Asuquo ', 'stephenasuquo@yahoo.com', 903344261, '25, Fasasi street, olodi-apapa, Lagos.', '', '2024-11-10 15:56:36'),
(3, 'Tom Horn', '', 0, '', '', '2024-11-10 15:56:36'),
(4, 'Ita Udoh', '', 0, '', '', '2024-11-10 15:56:36'),
(5, 'Pastor Ubong Elijah', 'danelijah7@gmail.com', 0, 'plot-36B1 Durbar Estate Amuwo-Odofin, Lagos.', '$2y$10$nKgtauWBtAFLSH0mNHXGlewTUfJgyJTc6IWQInlyJVbwr1mTn7WsS', '2024-11-10 20:03:54');

-- --------------------------------------------------------

--
-- Table structure for table `payment_transactions`
--

CREATE TABLE `payment_transactions` (
  `transaction_id` int(11) NOT NULL,
  `donation_id` int(11) DEFAULT NULL,
  `provider` varchar(50) DEFAULT NULL,
  `provider_reference` varchar(100) DEFAULT NULL,
  `amount` decimal(12,2) DEFAULT NULL,
  `status` enum('pending','successful','failed') DEFAULT NULL,
  `payment_channel` varchar(50) DEFAULT NULL,
  `paid_at` datetime DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `recurring_donations`
--

CREATE TABLE `recurring_donations` (
  `recurring_id` int(11) NOT NULL,
  `member_id` int(11) DEFAULT NULL,
  `purpose_id` int(11) DEFAULT NULL,
  `amount` decimal(12,2) DEFAULT NULL,
  `frequency` enum('weekly','monthly','yearly') DEFAULT NULL,
  `active` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sermon`
--

CREATE TABLE `sermon` (
  `sermon_id` int(20) NOT NULL,
  `sermon_title` varchar(255) NOT NULL,
  `pastor_id` int(20) NOT NULL,
  `sermon_date` date NOT NULL,
  `sermon_audio` varchar(255) NOT NULL,
  `sermon_video` varchar(255) NOT NULL,
  `Transcript` varchar(255) DEFAULT NULL,
  `sermon_outline` varchar(255) DEFAULT NULL,
  `sermon_type` varchar(255) NOT NULL,
  `in_carousel` tinyint(1) DEFAULT 0,
  `notifications` tinyint(1) DEFAULT 0,
  `audio_file_id` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sermon`
--

INSERT INTO `sermon` (`sermon_id`, `sermon_title`, `pastor_id`, `sermon_date`, `sermon_audio`, `sermon_video`, `Transcript`, `sermon_outline`, `sermon_type`, `in_carousel`, `notifications`, `audio_file_id`) VALUES
(5, 'The end of the age', 2, '2024-10-13', 'https://drive.google.com/file/d/1khKdNrD-A9kljmiDRGXbGnWPGSH3ElzY/view?usp=drive_link', 'https://www.youtube.com/embed/86QJ8ITJE1M', 'Uploads/transcript/the_end_of_the_age.txt', 'Day_one.txt', 'full', 1, 0, '1khKdNrD-A9kljmiDRGXbGnWPGSH3ElzY'),
(6, 'Rapture explained', 1, '2024-10-20', 'https://drive.google.com/file/d/1khKdNrD-A9kljmiDRGXbGnWPGSH3ElzY/view?usp=drive_link', 'https://www.youtube.com/embed/g9fSui5NarY', 'Uploads/sermon_video/rapture_explained.text', 'Day_Two.txt', 'full', 1, 0, '1khKdNrD-A9kljmiDRGXbGnWPGSH3ElzY'),
(8, 'Zeitegist 2025', 3, '2024-11-03', 'https://drive.google.com/file/d/1khKdNrD-A9kljmiDRGXbGnWPGSH3ElzY/view?usp=drive_link', 'https://www.youtube.com/watch?v=xrn45xRHMo8', 'HERMENEUTICS.docx', 'Day_Three.txt', 'full', 0, 0, '1khKdNrD-A9kljmiDRGXbGnWPGSH3ElzY'),
(9, 'The sons of God series', 4, '2025-01-05', 'https://drive.google.com/file/d/1khKdNrD-A9kljmiDRGXbGnWPGSH3ElzY/view?usp=drive_link', 'https://www.youtube.com/watch?v=xrn55xRHMo8', 'Faithful_Stewards[The called].docx', 'Day_four.txt', 'full', 0, 0, '1khKdNrD-A9kljmiDRGXbGnWPGSH3ElzY'),
(10, 'True Priesthood', 4, '2025-01-12', 'https://drive.google.com/file/d/1khKdNrD-A9kljmiDRGXbGnWPGSH3ElzY/view?usp=drive_link', 'https://www.youtube.com/watch?v=xrn65xRHMo8', 'The Church part 1.docx', 'Day_five.txt', 'full', 0, 0, '1khKdNrD-A9kljmiDRGXbGnWPGSH3ElzY'),
(11, 'Dating vs Courtship', 4, '2025-01-11', 'https://drive.google.com/file/d/1khKdNrD-A9kljmiDRGXbGnWPGSH3ElzY/view?usp=drive_link', 'https://www.youtube.com/watch?v=xrn75xRHMo8', 'The glory of God.docx', 'Day_six.txt', 'full', 0, 0, '1khKdNrD-A9kljmiDRGXbGnWPGSH3ElzY'),
(12, 'Zeitegist 2026', 3, '2024-08-30', 'https://drive.google.com/file/d/1khKdNrD-A9kljmiDRGXbGnWPGSH3ElzY/view?usp=drive_link', 'https://www.youtube.com/watch?v=xrn45xRHMo8', '1 Corinthians 2 Principles Of Scriptural Interpretation.docx', 'Day_seven.txt', 'full', 0, 0, '1khKdNrD-A9kljmiDRGXbGnWPGSH3ElzY'),
(13, 'Zeitegist 2026', 4, '2026-02-01', 'https://drive.google.com/file/d/1khKdNrD-A9kljmiDRGXbGnWPGSH3ElzY/view?usp=drive_link', 'https://www.youtube.com/watch?v=xrn45xRHMo8', '1 Corinthians 2 Principles Of Scriptural Interpretation.docx', 'Day_eight.txt', 'full', 0, 0, '1khKdNrD-A9kljmiDRGXbGnWPGSH3ElzY'),
(14, 'Prophets: Pitfalls And Principles', 4, '2024-11-15', 'https://drive.google.com/file/d/1khKdNrD-A9kljmiDRGXbGnWPGSH3ElzY/view?usp=drive_link', 'https://www.youtube.com/watch?v=xrn45xRHMo8', '084e0760c33c84f06adc9bbc05affdfe27bf944d-ReadEra.jpg', 'Day_nine.txt', 'full', 0, 0, '1khKdNrD-A9kljmiDRGXbGnWPGSH3ElzY'),
(15, 'The goal of Christianity', 4, '2024-11-20', 'https://drive.google.com/file/d/1khKdNrD-A9kljmiDRGXbGnWPGSH3ElzY/view?usp=drive_link', '', '', '', 'audio', 0, 0, '1khKdNrD-A9kljmiDRGXbGnWPGSH3ElzY'),
(16, 'What Faith is not', 3, '2024-11-20', 'https://drive.google.com/file/d/1khKdNrD-A9kljmiDRGXbGnWPGSH3ElzY/view?usp=drive_link', 'gjjhkjl', '', '', 'video', 0, 0, '1khKdNrD-A9kljmiDRGXbGnWPGSH3ElzY'),
(17, 'The goal of Christianity', 4, '2024-11-20', 'https://drive.google.com/file/d/1khKdNrD-A9kljmiDRGXbGnWPGSH3ElzY/view?usp=drive_link', '', NULL, '../uploads/sermons673df1fb318e3-AEONIAN JUDGMENT- Expanded.docx', 'text', 0, 0, '1khKdNrD-A9kljmiDRGXbGnWPGSH3ElzY'),
(18, 'The goal of Christianity 2', 4, '2024-11-20', 'https://drive.google.com/file/d/1khKdNrD-A9kljmiDRGXbGnWPGSH3ElzY/view?usp=drive_link', '', NULL, NULL, 'audio', 0, 0, '1khKdNrD-A9kljmiDRGXbGnWPGSH3ElzY'),
(19, 'The resurrection of the dead 2', 5, '2024-11-20', 'https://drive.google.com/file/d/1khKdNrD-A9kljmiDRGXbGnWPGSH3ElzY/view?usp=drive_link', 'googledrive.com/sonsofGod/Rcm', NULL, NULL, 'video', 0, 0, '1khKdNrD-A9kljmiDRGXbGnWPGSH3ElzY'),
(20, 'The goal of Christianity 3', 5, '2024-11-20', 'https://drive.google.com/file/d/1khKdNrD-A9kljmiDRGXbGnWPGSH3ElzY/view?usp=drive_link', 'googledrive.com/sonsofGod/Rcm', '../uploads/sermons673e1ea9abb48-AEONIAN JUDGMENT- Expanded-1.docx', NULL, 'full', 0, 0, '1khKdNrD-A9kljmiDRGXbGnWPGSH3ElzY'),
(21, 'Zeitegist 2026 2', 4, '2024-11-20', 'https://drive.google.com/file/d/1khKdNrD-A9kljmiDRGXbGnWPGSH3ElzY/view?usp=drive_link', '', '../uploads/sermons673e219c2983d-AEONIAN JUDGMENT- Expanded.docx', NULL, 'transcript', 0, 0, '1khKdNrD-A9kljmiDRGXbGnWPGSH3ElzY'),
(22, 'Zeitegist 2025 2', 4, '2024-11-20', 'googledrive.com/sonsofGod/Rcm', 'googledrive.com/sonsofGod/Rcm', '../uploads/sermons673e21c48cf93-AEONIAN JUDGMENT- Expanded-1.docx', NULL, 'full', 0, 0, NULL),
(23, 'True Priesthood 2', 1, '2024-11-20', 'googledrive.com/zeitegist26/Rcm', 'googledrive.com/zeitegist26/Rcm', 'googledrive.com/zeitegist26/Rcm', 'Day_four.txt', 'full', 0, 0, NULL),
(25, 'The sons of God series 2', 3, '2024-11-20', 'https://drive.google.com/file/d/1khKdNrD-A9kljmiDRGXbGnWPGSH3ElzY/view?usp=drive_link', '', NULL, '../uploads/sermons673e2216a8d6f-AEONIAN JUDGMENT- Expanded.docx', 'text', 0, 0, '1khKdNrD-A9kljmiDRGXbGnWPGSH3ElzY');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`),
  ADD UNIQUE KEY `admin_email` (`admin_email`);

--
-- Indexes for table `donations`
--
ALTER TABLE `donations`
  ADD PRIMARY KEY (`donation_id`),
  ADD UNIQUE KEY `reference` (`reference`);

--
-- Indexes for table `donation_purposes`
--
ALTER TABLE `donation_purposes`
  ADD PRIMARY KEY (`purpose_id`);

--
-- Indexes for table `donation_receipts`
--
ALTER TABLE `donation_receipts`
  ADD PRIMARY KEY (`receipt_id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`event_id`);

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`member_id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pastors`
--
ALTER TABLE `pastors`
  ADD PRIMARY KEY (`pastor_id`);

--
-- Indexes for table `payment_transactions`
--
ALTER TABLE `payment_transactions`
  ADD PRIMARY KEY (`transaction_id`);

--
-- Indexes for table `recurring_donations`
--
ALTER TABLE `recurring_donations`
  ADD PRIMARY KEY (`recurring_id`);

--
-- Indexes for table `sermon`
--
ALTER TABLE `sermon`
  ADD PRIMARY KEY (`sermon_id`),
  ADD KEY `pastor_id` (`pastor_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `donations`
--
ALTER TABLE `donations`
  MODIFY `donation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `donation_purposes`
--
ALTER TABLE `donation_purposes`
  MODIFY `purpose_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `donation_receipts`
--
ALTER TABLE `donation_receipts`
  MODIFY `receipt_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `event_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `member_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pastors`
--
ALTER TABLE `pastors`
  MODIFY `pastor_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `payment_transactions`
--
ALTER TABLE `payment_transactions`
  MODIFY `transaction_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `recurring_donations`
--
ALTER TABLE `recurring_donations`
  MODIFY `recurring_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sermon`
--
ALTER TABLE `sermon`
  MODIFY `sermon_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `sermon`
--
ALTER TABLE `sermon`
  ADD CONSTRAINT `sermon_ibfk_1` FOREIGN KEY (`pastor_id`) REFERENCES `pastors` (`pastor_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
