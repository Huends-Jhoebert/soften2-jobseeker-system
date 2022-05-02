-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 12, 2022 at 12:56 PM
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

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `p_p`, `username`, `password`) VALUES
(11, 'Jhoebert Huenda', '../../../dist/user-images/Z0snTh3m/photo-1633332755192-727a05c4013d.jpeg', 'huends20', 'huends20'),
(12, 'Huenda Jhoebert', '../../../dist/user-images/tjFt8BEJ/profile.jpg', 'huends2021', 'huends2021'),
(14, 'Jhoebert Huenda', '../../../dist/user-images/Ubv0aMPx/photo-1633332755192-727a05c4013d (1).jpeg', 'huends2022', 'huends2022');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `feedback_id` int(20) NOT NULL,
  `user_id` int(20) NOT NULL,
  `type` varchar(50) NOT NULL,
  `feedback_message` varchar(2500) NOT NULL,
  `date_created` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`feedback_id`, `user_id`, `type`, `feedback_message`, `date_created`) VALUES
(23, 82, 'good', '123', '2022-04-07 12:06:52'),
(28, 81, 'good', 'it was a nice experience', '2022-04-07 10:04:57'),
(29, 92, 'good', 'vsbdvjshbdjf', '2022-04-07 11:52:26');

-- --------------------------------------------------------

--
-- Table structure for table `feedback_report`
--

CREATE TABLE `feedback_report` (
  `feedback_report_id` int(20) NOT NULL,
  `user_id` int(11) NOT NULL,
  `type` varchar(10) NOT NULL,
  `date_created` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `feedback_report`
--

INSERT INTO `feedback_report` (`feedback_report_id`, `user_id`, `type`, `date_created`) VALUES
(13, 87, 'bad', '2022-04-06'),
(14, 82, 'bad', '2022-04-06'),
(15, 82, 'good', '2022-04-06'),
(16, 82, 'good', '2022-04-06'),
(17, 82, 'good', '2022-04-06'),
(18, 82, 'bad', '2022-04-06'),
(19, 82, 'bad', '2022-04-07'),
(20, 82, 'good', '2022-04-07'),
(21, 82, 'bad', '2022-04-07'),
(22, 82, 'bad', '2022-04-07'),
(23, 88, 'bad', '2022-04-07'),
(24, 87, 'good', '2022-04-07'),
(25, 81, 'good', '2022-04-07'),
(26, 92, 'good', '2022-04-07');

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
(34, 81, 'Software Engineer', '../dist/job-images/x5KVuqTK/software-engineer-skills-section-scaled.jpg', 'Sorsogon City', 'Critical thinker,Css,HTML 5', '35000 - 45000 Pesos Monthly', 'asdasdasd', '2022-04-09 21:33:30');

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
(30, 34, 81, 89, '../../dist/jobseeker-files/pHkfY1mV/amor-resume.pdf', 0, '2022-04-09 21:37:39');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `msg_id` int(11) NOT NULL,
  `incoming_msg_id` int(255) NOT NULL,
  `outgoing_msg_id` int(255) NOT NULL,
  `msg` varchar(1000) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`msg_id`, `incoming_msg_id`, `outgoing_msg_id`, `msg`, `date_created`) VALUES
(183, 549804937, 522377705, 'Good Morning', '2022-04-09 21:45:50');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `unique_id` int(255) NOT NULL,
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
  `signup_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `verification_code` varchar(6) NOT NULL,
  `verification_status` varchar(10) NOT NULL,
  `last_seen` datetime NOT NULL DEFAULT current_timestamp(),
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `unique_id`, `name`, `password`, `contact_number`, `email_account`, `address`, `school`, `degree`, `study_field`, `study_years`, `type`, `contact_person`, `p_p`, `skills`, `coe`, `signup_date`, `verification_code`, `verification_status`, `last_seen`, `status`) VALUES
(81, 522377705, 'lucky chinatown', 'accenture123', '09506812312', '	accenture123@gmail.com', 'Bernardino St Bagbaguin, Valenzuela 3650 3rd District Metro Manila', '', '', '', '', 'Employer', 'John Dope II', '../dist/user-images/a68kJ1Dw/Accenture-Logo-768x768.jpg', '', '', '2022-04-10 09:28:01', '291378', 'verified', '2022-04-10 17:27:59', 'Offline now'),
(83, 1043835846, 'The Lewis College', 'tlc123', '09120266163', '	tlc123@gmail.com', 'Magsasay st Cogon, Sorsogon 4700 Sorsogon Bicol', '', '', '', '', 'Employer', 'John Dope III', '../dist/user-images/ZjrDAUN5/tlc_logo.png', '', '', '2022-04-06 15:06:59', '659778', 'verified', '2022-04-06 23:06:59', 'Offline now'),
(86, 522287705, 'user', 'user', 'user', 'user@gmail.com', 'sample', '', '', '', '', 'user', NULL, '../dist/user-images/default/default.png', '', '', '2022-04-05 19:01:44', '123456', 'verified', '2022-04-06 02:59:07', 'Offline now'),
(87, 879496068, 'Jhoebert Huenda ', 'huenda20', '09120266165', 'huendahuenda20@gmail.com', 'Purok 1 Cogon, Sorsogon 4700 Sorsogon Bicol', 'The Lewis College,Standford', 'Bachelor of Science,Masters', 'Information Technology,Information Technology', '2019  - 2023,2024 - 2026', 'Jobseeker', NULL, '../dist/user-images/fnRuhRQi/profile.jpg', '																																		HTML5,																																	Team Leader', '																	BEST IN SCIENCE,BEST IN MATH', '2022-04-08 13:25:42', '330441', 'verified', '2022-04-08 21:25:28', 'Offline now'),
(88, 689746479, 'Microsoft Philippines ', 'microsoft123', '09456784532', '	jpajenago127@gmail.com', 'Purok 1 Almendras, Bacon 4700 Sorosogon Bicol', '', '', '', '', 'Employer', 'John Dope II', '../dist/user-images/DUHgHgMu/Microsoft-Logo.jpg', '', '', '2022-04-07 02:58:54', '472436', 'verified', '2022-04-07 10:58:51', 'Offline now'),
(89, 549804937, 'Angelica Reolo', 'oct081992', '09120266163', 'angeljejillosreolo@gmail.com', 'Purok 2 New Bato, Sorsogon 4700 Sorsogon Bicol', 'The Lewis College', 'Bachelor of Science', 'Information Technology', '2019  - 2023', 'Jobseeker', NULL, '../dist/user-images/gslVW16e/photo-1633332755192-727a05c4013d (1).jpeg', 'singer', 'Best in Capstone', '2022-04-09 21:53:23', '164352', 'verified', '2022-04-10 05:45:52', 'Offline now'),
(90, 1230472720, 'Tesla Corporation', 'paulino234', '09456784532', '	abglpaulino@gmail.com', 'purok1 behia, magallanes 5657 Sorsogon Bicol', '', '', '', '', 'Employer', 'abby', '../dist/user-images/bxUpke7Z/photo-1633332755192-727a05c4013d (1).jpeg', '', '', '2022-04-08 13:20:54', '238813', 'verified', '2022-04-08 21:20:34', 'Offline now'),
(91, 977648784, 'Mr bean', '12345', '09487341368', 'test12312@gmail.com', ' ,    Bicol', 'Oxford university', 'Bachelor of Science and technolgies', 'Programming', '2011  - 2015', 'Jobseeker', NULL, '../dist/user-images/CR1LyJLC/282-2825992_mr-bean-peekaboo-mr-bean-hd.png', 'multi tasking ,hard working ,fast hand', 'Diploma ,driver license,national id', '2022-04-09 20:51:13', '188936', 'verified', '2022-04-10 04:51:09', 'Offline now'),
(92, 338651517, 'Testla Corporation', 'rivera345', '09120266165', '	jayrivera@thelewiscollege.edu.ph', 'Purok 1 Bacon, Bacon 4700 Sorsogon Bicol', '', '', '', '', 'Employer', 'jay revera', '../dist/user-images/1QzzOZ8y/Accenture-Logo-768x768.jpg', '', '', '2022-04-07 04:09:07', '286538', 'verified', '2022-04-07 12:08:47', 'Offline now'),
(94, 626188390, 'JanDarren Pajenago', '12345', '09458519601', 'jandarrenpajenago@thelewiscollege.edu.ph', '2683QuezonSt Polvorista, Sorsogon 4700 Sorsogon bicol', 'Sorsogon State College', 'Bachelor of Science', 'Information Technology', '2011  - 2015', 'Jobseeker', NULL, '../dist/user-images/6BL826FP/photo-1633332755192-727a05c4013d (1).jpeg', 'hardworking', 'Diploma', '2022-04-08 13:13:06', '135864', 'unverified', '2022-04-07 11:40:33', 'Offline now');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`feedback_id`);

--
-- Indexes for table `feedback_report`
--
ALTER TABLE `feedback_report`
  ADD PRIMARY KEY (`feedback_report_id`);

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
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`msg_id`);

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
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `feedback_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `feedback_report`
--
ALTER TABLE `feedback_report`
  MODIFY `feedback_report_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `job`
--
ALTER TABLE `job`
  MODIFY `job_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `job_applicant`
--
ALTER TABLE `job_applicant`
  MODIFY `job_applicant_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `msg_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=184;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=96;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
