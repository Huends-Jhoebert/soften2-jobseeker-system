-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 02, 2022 at 01:41 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.3.31

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
  `job_date_posted` timestamp NOT NULL DEFAULT current_timestamp(),
  `job_requirements` varchar(500) NOT NULL,
  `career_growth` varchar(1000) NOT NULL,
  `rate` int(5) NOT NULL,
  `number_of_raters` int(5) NOT NULL,
  `total_rate` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `job`
--

INSERT INTO `job` (`job_id`, `job_employer_id`, `job_title`, `job_image`, `job_place`, `job_skills`, `job_salary_range`, `job_description`, `job_date_posted`, `job_requirements`, `career_growth`, `rate`, `number_of_raters`, `total_rate`) VALUES
(35, 97, 'Network Engineer', '../dist/job-images/kpRXTyUM/new_windows_11-wallpaper-1920x1080.jpg', 'Sorsogon City', 'html5,css3,javascript', '25000 - 35000', 'We are looking for Secretary for our President & CEO. The candidate we are looking is someone able to speak and write good English.\r\n\r\nOther administrative tasks included but not limited to:\r\nArrange meeting schedule for President & CEO\r\nAssist President & CEO in his daily jobs\r\nTo greet visitors and arrange them to meet President & CEO\r\nAnswer phone calls and reply emails\r\nPerform administrative tasks', '2022-05-01 19:04:04', 'college degree,5 years experience', 'We are looking for Secretary for our President & CEO. The candidate we are looking is someone able to speak and write good English.\r\n\r\nOther administrative tasks included but not limited to:\r\nArrange meeting schedule for President & CEO\r\nAssist President & CEO in his daily jobs\r\nTo greet visitors and arrange them to meet President & CEO\r\nAnswer phone calls and reply emails\r\nPerform administrative tasks', 3, 6, 20);

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
(31, 35, 97, 99, '../../dist/jobseeker-files/03XqG4Kg/GAME OF THE GENERALS.pdf', 0, '2022-05-02 06:22:09');

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
(184, 858345289, 597341726, 'Good Morning', '2022-05-01 17:42:22'),
(185, 597341726, 858345289, 'hey', '2022-05-01 17:48:30'),
(186, 597341726, 858345289, 'aasasd', '2022-05-01 17:51:26'),
(187, 597341726, 858345289, 'asdasd', '2022-05-01 17:52:37'),
(188, 858345289, 597341726, 'Hello world', '2022-05-01 17:52:45'),
(189, 597341726, 858345289, 'asdasd', '2022-05-01 17:52:53'),
(190, 597341726, 858345289, 'asdasd', '2022-05-01 17:52:54'),
(191, 597341726, 858345289, 'asdasd', '2022-05-01 17:52:55'),
(192, 597341726, 858345289, 'asd', '2022-05-01 17:52:57'),
(193, 858345289, 597341726, 'asdasd', '2022-05-01 17:53:00'),
(194, 597341726, 858345289, 'asdasdasd', '2022-05-02 02:16:59'),
(195, 597341726, 1336420799, 'hey', '2022-05-02 05:02:50'),
(196, 597341726, 1336420799, 'asdjsaklm askldamklsdasdassssssssssssssssssssssssssssssssssssssssssssssssssssssssssssdml', '2022-05-02 05:20:54'),
(197, 597341726, 1336420799, 'hey ', '2022-05-02 05:25:23'),
(198, 1336420799, 597341726, 'heelo world', '2022-05-02 05:25:32'),
(199, 1336420799, 597341726, ';asdasd', '2022-05-02 05:25:33'),
(200, 597341726, 1336420799, 'okay asdasd', '2022-05-02 05:25:38'),
(201, 597341726, 1336420799, 'asdasdasd', '2022-05-02 05:26:31'),
(202, 1336420799, 597341726, 'asdasdasd', '2022-05-02 10:46:51'),
(203, 597341726, 1336420799, 'asdasdasd', '2022-05-02 10:47:19'),
(204, 1336420799, 597341726, 'asdasdasd', '2022-05-02 10:47:21');

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
(86, 522287705, 'user', 'user', 'user', 'user@gmail.com', 'sample', '', '', '', '', 'user', NULL, '../dist/user-images/default/default.png', '', '', '2022-04-05 19:01:44', '123456', 'verified', '2022-04-06 02:59:07', 'Offline now'),
(96, 858345289, 'Christina Amor', 'amor123', '09095734538', 'jhoeberthuenda@thelewiscollege.edu.ph', 'Purok 9 Sampaloc, Sorsogon 4700 Sorsogon Bicol', 'The Lewis College,The Lewis College,The Lewis College', 'Bachelor Of Science in Information Technology,Master\'s in Information Technology,PhD in Information Technology', 'College,Masters,PhD', '2019  - 2022,2023  - 2025,2026  - 2028', 'Jobseeker', NULL, '../dist/user-images/fPkJox3I/id ko.bmp', '																	html5,																																	css3,																																	javascript,React js', 'best in math', '2022-05-02 03:25:32', '557602', 'verified', '2022-05-02 11:25:27', 'Offline now'),
(97, 597341726, 'Macdonald', 'amor123', '09123456789', '	huendahuenda20@gmail.com', 'purok 9 Balogo, Sorsogon 4700 Sorsogon Bicol', '', '', '', '', 'Employer', 'Maria Cristina Amor', '../dist/user-images/GH191IJE/download (3).jpg', '', '', '2022-05-02 10:46:44', '201150', 'verified', '2022-05-02 18:46:44', 'Active now'),
(98, 402233168, 'Abegail Paulino', 'love', '09095734538', 'sample1@gmail.com', 'purok 9 Sampaloc, Sorsogon 4700 Sorsogon Bicol', 'The Lewis College,The Lewis College', 'Bachelor Of Science in Information Technology,Master\'s in Information Technology', 'College,Masters', '2020  - 2024,2025  - 2027 ', 'Jobseeker', NULL, '../dist/user-images/uT7T01FJ/th (1).jpg', 'html5,css,javascript', 'best in math', '2022-05-02 04:53:46', '310314', 'verified', '2022-05-02 12:50:50', 'Offline now'),
(99, 1336420799, 'Jhoebert Huenda', 'sample2', '0912026165', 'sample2@gmail.com', 'purok 9 Sampaloc, Sorsogon 4700 Sorsogon Bicol', 'The Lewis College,The Lewis College', 'Bachelor Of Science in Information Technology,Master\'s in Information Technology', 'College,Masters', '2019  - 2023,2023  - 2025', 'Jobseeker', NULL, '../dist/user-images/oLgordUk/photo-1633332755192-727a05c4013d (1).jpeg', 'html5,css3', 'best in parainom', '2022-05-02 10:46:56', '105630', 'verified', '2022-05-02 18:46:56', 'Active now');

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
  MODIFY `job_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `job_applicant`
--
ALTER TABLE `job_applicant`
  MODIFY `job_applicant_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `msg_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=205;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
