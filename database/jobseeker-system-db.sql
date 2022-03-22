-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 22, 2022 at 10:44 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jobseeker-system-db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(10) NOT NULL,
  `name` varchar(50) NOT NULL,
  `p_p` varchar(120) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `chats`
--

CREATE TABLE `chats` (
  `chat_id` int(11) NOT NULL,
  `from_id` int(11) NOT NULL,
  `to_id` int(11) NOT NULL,
  `message` text NOT NULL,
  `opened` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `chats`
--

INSERT INTO `chats` (`chat_id`, `from_id`, `to_id`, `message`, `opened`, `created_at`) VALUES
(215, 78, 74, 'asdasd', 0, '2022-03-23 05:31:16'),
(216, 78, 74, 'asdasd', 0, '2022-03-23 05:31:17'),
(217, 78, 74, 'asdasd', 0, '2022-03-23 05:31:19'),
(218, 78, 74, 'asdasd', 0, '2022-03-23 05:31:23'),
(219, 78, 74, 'asdasd', 0, '2022-03-23 05:31:24'),
(220, 78, 74, 'asdasd', 0, '2022-03-23 05:31:28'),
(221, 78, 74, 'asdasd', 0, '2022-03-23 05:31:30'),
(222, 78, 74, 'asdasdasd', 0, '2022-03-23 05:31:36'),
(223, 78, 74, 'asdasd', 0, '2022-03-23 05:31:38'),
(224, 78, 74, 'asdasd', 0, '2022-03-23 05:31:39'),
(225, 76, 75, 'asdasd', 0, '2022-03-23 05:33:01'),
(226, 76, 75, 'asdasd', 0, '2022-03-23 05:33:03'),
(227, 76, 75, 'asdasd', 0, '2022-03-23 05:33:04'),
(228, 76, 75, 'asdasd', 0, '2022-03-23 05:33:06'),
(229, 76, 75, 'asdasd', 0, '2022-03-23 05:33:07'),
(230, 78, 76, 'asdasd', 1, '2022-03-23 05:33:56'),
(231, 78, 76, 'asdasd', 1, '2022-03-23 05:33:57'),
(232, 78, 76, 'asdasd', 1, '2022-03-23 05:33:58'),
(233, 77, 76, 'asdasd', 1, '2022-03-23 05:34:41'),
(234, 77, 76, 'asdasd', 1, '2022-03-23 05:34:42'),
(235, 77, 76, 'asdasd', 1, '2022-03-23 05:34:44'),
(236, 77, 76, 'asdasd', 1, '2022-03-23 05:34:45'),
(237, 77, 76, 'asdasd', 1, '2022-03-23 05:34:49'),
(238, 77, 76, 'asdasd', 1, '2022-03-23 05:34:50'),
(239, 77, 76, 'asdasd', 1, '2022-03-23 05:39:29'),
(240, 76, 78, 'asdasd', 0, '2022-03-23 05:39:55'),
(241, 76, 78, 'asdasd', 0, '2022-03-23 05:39:56'),
(242, 76, 78, 'asdasd', 0, '2022-03-23 05:39:57'),
(243, 76, 78, 'asdasd', 0, '2022-03-23 05:39:58'),
(244, 76, 77, 'asdasdasd', 1, '2022-03-23 05:40:17'),
(245, 76, 77, 'asdasd', 1, '2022-03-23 05:40:19');

-- --------------------------------------------------------

--
-- Table structure for table `conversations`
--

CREATE TABLE `conversations` (
  `conversation_id` int(11) NOT NULL,
  `user_1` int(11) NOT NULL,
  `user_2` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `conversations`
--

INSERT INTO `conversations` (`conversation_id`, `user_1`, `user_2`) VALUES
(25, 78, 74),
(26, 76, 75),
(27, 78, 76),
(28, 77, 76);

-- --------------------------------------------------------

--
-- Table structure for table `job`
--

CREATE TABLE `job` (
  `job_id` int(20) NOT NULL,
  `job_employer_id` int(20) NOT NULL,
  `job_title` varchar(50) NOT NULL,
  `job_image` varchar(200) NOT NULL,
  `job_place` varchar(50) NOT NULL,
  `job_skills` varchar(1000) NOT NULL,
  `job_salary_range` varchar(50) NOT NULL,
  `job_description` varchar(10000) NOT NULL,
  `job_date_posted` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `job`
--

INSERT INTO `job` (`job_id`, `job_employer_id`, `job_title`, `job_image`, `job_place`, `job_skills`, `job_salary_range`, `job_description`, `job_date_posted`) VALUES
(18, 75, 'Software Engineer', '../dist/job-images/Z18XeYtm/software-engineer-skills-section-scaled.jpg', 'Metro Manila', 'Basic Computer Programming,Leadership Skills,Communication Skills', '35000 - 45000 Pesos Monthly', '\r\nLorem ipsum dolor sit amet consectetur adipisicing elit. Numquam minima tempora officiis nostrum illum nesciunt saepe quae esse ea ipsam omnis sequi, inventore, fugiat cumque incidunt aspernatur architecto autem laboriosam quasi delectus nobis atque eaque? Nostrum enim sequi laudantium iste possimus assumenda dicta officiis perferendis eaque vel eveniet rem, ducimus vero adipisci saepe exercitationem doloremque alias numquam? Vel qui porro iure harum eos? Excepturi dolore quo provident iste libero illo obcaecati, suscipit in sapiente, enim, nobis quas. Aperiam natus asperiores voluptatem aliquid iusto, voluptate quam in ex inventore dolorem, eveniet sit quos consectetur saepe fuga repellat impedit dolore ipsam omnis.', '2022-03-20 17:55:28'),
(21, 77, 'System Analyst', '../dist/job-images/nKpJZjq8/Clinical-Systems-Analyst.jpg', 'Sorsogon City', 'Critical Thinking ,Basic Computer Programming,Communication Skills', '35000 - 45000 Pesos Monthly', 'aslda;lsdjalskndkaslkdklasd', '2022-03-22 20:06:56');

-- --------------------------------------------------------

--
-- Table structure for table `job_applicant`
--

CREATE TABLE `job_applicant` (
  `job_applicant_id` int(10) NOT NULL,
  `job_id` int(10) NOT NULL,
  `job_applicant_employer_id` int(10) NOT NULL,
  `job_applicant_jobseeker_id` int(10) NOT NULL,
  `job_applicant_file` varchar(200) NOT NULL,
  `job_applicant_status` int(1) NOT NULL,
  `job_applicant_submitted_time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `job_applicant`
--

INSERT INTO `job_applicant` (`job_applicant_id`, `job_id`, `job_applicant_employer_id`, `job_applicant_jobseeker_id`, `job_applicant_file`, `job_applicant_status`, `job_applicant_submitted_time`) VALUES
(17, 18, 75, 74, '../../dist/jobseeker-files/EVCFGnsB/amor-resume.pdf', 0, '2022-03-20 17:55:56'),
(21, 21, 77, 76, '../../dist/jobseeker-files/iOgPlDro/tala.docx', 0, '2022-03-22 20:07:29');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `password` varchar(1000) NOT NULL,
  `contact_number` varchar(12) NOT NULL,
  `email_account` varchar(100) NOT NULL,
  `address` varchar(150) NOT NULL,
  `school` varchar(200) NOT NULL,
  `degree` varchar(200) NOT NULL,
  `study_field` varchar(200) NOT NULL,
  `study_years` varchar(200) NOT NULL,
  `type` varchar(50) NOT NULL,
  `contact_person` varchar(50) DEFAULT NULL,
  `p_p` varchar(255) DEFAULT NULL,
  `skills` varchar(5000) NOT NULL,
  `coe` varchar(5000) NOT NULL,
  `signup_date` varchar(50) NOT NULL,
  `verification_code` varchar(6) NOT NULL,
  `verification_status` varchar(10) NOT NULL,
  `last_seen` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `name`, `password`, `contact_number`, `email_account`, `address`, `school`, `degree`, `study_field`, `study_years`, `type`, `contact_person`, `p_p`, `skills`, `coe`, `signup_date`, `verification_code`, `verification_status`, `last_seen`) VALUES
(74, 'Maria Christina Amor', 'amor123', '09095734538', '	itsmariacristinaeve@gmail.com', 'Purok 1 Balogo, Bacon 4700 Sorsogon Bicol', 'The Lewis College', 'Bachelor of Science', 'Information Technology', '2019  - 2023', 'Jobseeker', NULL, '../dist/user-images/naLcyazq/275395979_632056024673866_252733733811926935_n.jpg', 'HTML5,CSS3,JAVASCRIPT,PHP,MYSQL,SQL', 'MAGNA CUM LAUDE,BEST IN KOROPYAHAN,BEST IN IRINUMAN', '22-03-20', '285723', 'verified', '2022-03-21 00:29:35'),
(75, 'ACCENTURE PHILIPPINES', 'test123', '09095734538', 'test123@gmail.com', 'Bernardino St Bagbaguin, Valenzuela 4500 3rd District Metro Manila', '', '', '', '', 'Employer', 'Jhoebert Huenda', '../dist/user-images/mLUiw55X/download (2).png', '', '', '22-03-20', '978653', 'verified', '2022-03-23 03:34:41'),
(76, 'Jhoebert Huenda', 'huends20', '09120266165', '	huendahuenda20@gmail.com', 'Purok 9 Sampaloc, Sorsogon City 4700 Sorsogon Bicol', 'The Lewis College', 'Bachelor of Science', 'Information Technology', '2019  - 2023', 'Jobseeker', NULL, '../dist/user-images/SQFZaL0h/profile.jpg', '																	HTML5,																																	CSS3,																																	JAVASCRIPT,PHP', 'BEST IN KAGWAPOHAN', '22-03-20', '330446', 'verified', '2022-03-23 05:44:17'),
(77, 'Lucky Chinatown', 'Qq@4KlgwtC0e8Gi', '+63951154985', '	abglpaulino@gmail.com', 'Purok 1 Behia, Sorsogon 4705 Magallanes Region V', '', '', '', '', 'Employer', 'Abegail paulino', '../dist/user-images/lp3RgJWY/inbound7237129827717532666.png', '', '', '22-03-22', '209042', 'verified', '2022-03-23 05:44:11'),
(78, 'Test Corp', 'test99', '09450323708', '	test99@gmail.com', 'Purok 7 Bibincahan, Sorsogon 4705 Sorsogon Bicol', '', '', '', '', 'Employer', 'John Dope II', '../dist/user-images/halhUoYh/corporate-company-logo-design-template-2402e0689677112e3b2b6e0f399d7dc3_screen.jpg', '', '', '22-03-22', '351742', 'verified', '2022-03-23 05:33:55');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chats`
--
ALTER TABLE `chats`
  ADD PRIMARY KEY (`chat_id`);

--
-- Indexes for table `conversations`
--
ALTER TABLE `conversations`
  ADD PRIMARY KEY (`conversation_id`);

--
-- Indexes for table `job`
--
ALTER TABLE `job`
  ADD PRIMARY KEY (`job_id`);

--
-- Indexes for table `job_applicant`
--
ALTER TABLE `job_applicant`
  ADD PRIMARY KEY (`job_applicant_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `chats`
--
ALTER TABLE `chats`
  MODIFY `chat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=246;

--
-- AUTO_INCREMENT for table `conversations`
--
ALTER TABLE `conversations`
  MODIFY `conversation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `job`
--
ALTER TABLE `job`
  MODIFY `job_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `job_applicant`
--
ALTER TABLE `job_applicant`
  MODIFY `job_applicant_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
