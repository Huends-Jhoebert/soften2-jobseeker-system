-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 15, 2022 at 09:04 AM
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

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`feedback_id`, `user_id`, `type`, `feedback_message`, `date_created`) VALUES
(30, 98, 'good', 'Nice app', '2022-05-02 08:24:11'),
(31, 96, 'bad', 'asdasd', '2022-05-15 01:14:26');

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
(27, 98, 'good', '2022-05-02'),
(28, 96, 'bad', '2022-05-15');

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
(35, 97, 'Network Engineer', '../dist/job-images/kpRXTyUM/new_windows_11-wallpaper-1920x1080.jpg', 'Sorsogon City', 'html5,css3,javascript', '25000 - 35000', 'We are looking for Secretary for our President & CEO. The candidate we are looking is someone able to speak and write good English.\r\n\r\nOther administrative tasks included but not limited to:\r\nArrange meeting schedule for President & CEO\r\nAssist President & CEO in his daily jobs\r\nTo greet visitors and arrange them to meet President & CEO\r\nAnswer phone calls and reply emails\r\nPerform administrative tasks', '2022-05-01 19:04:04', 'college degree,5 years experience', 'We are looking for Secretary for our President & CEO. The candidate we are looking is someone able to speak and write good English.\r\n\r\nOther administrative tasks included but not limited to:\r\nArrange meeting schedule for President & CEO\r\nAssist President & CEO in his daily jobs\r\nTo greet visitors and arrange them to meet President & CEO\r\nAnswer phone calls and reply emails\r\nPerform administrative tasks', 3, 15, 52),
(36, 102, 'Marketing supervisor', '../dist/job-images/NGrRP4wM/images (1).jpg', 'manila', 'communication skill,leadership', '1500-2500', 'Excellent listening skills.\r\nA willingness to problem solve.\r\nStrong verbal & written communication skills.\r\nResilience - being able to handle complaints from customers.\r\nThe ability to work as part of a team.\r\nBe self-driven & pro-active.\r\n', '2022-05-12 06:07:15', 'degree holder,business administration', 'ututregoire094', 0, 0, 0);

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
(32, 35, 97, 98, '../../dist/jobseeker-files/DiChevn9/recebido_act1.pdf', 0, '2022-05-04 12:58:10'),
(33, 35, 97, 96, '../../dist/jobseeker-files/7SWMLQKa/IS Project Management Template.docx', 0, '2022-05-12 04:32:40'),
(34, 36, 102, 96, '../../dist/jobseeker-files/3DTCTgEj/IS Project Management Template.docx', 0, '2022-05-12 06:13:17');

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
(205, 597341726, 402233168, 'Hello world', '2022-05-04 13:03:59'),
(206, 597341726, 402233168, 'Hello world', '2022-05-04 13:04:06'),
(207, 597341726, 402233168, 'asdasdasd', '2022-05-04 13:04:36'),
(208, 402233168, 597341726, '...', '2022-05-04 13:07:32'),
(209, 402233168, 597341726, 'asdasdasd', '2022-05-04 13:07:34'),
(210, 402233168, 597341726, 'asdasdasd', '2022-05-04 13:07:42'),
(211, 597341726, 402233168, 'asdasdaksldasd', '2022-05-04 13:07:45'),
(212, 402233168, 597341726, 'asdasdasd', '2022-05-04 13:07:47'),
(213, 666559154, 858345289, 'annyeong', '2022-05-12 06:10:15');

-- --------------------------------------------------------

--
-- Table structure for table `system_update`
--

CREATE TABLE `system_update` (
  `system_update_id` int(10) NOT NULL,
  `update_title` varchar(200) NOT NULL,
  `update_information` varchar(5000) NOT NULL,
  `date` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `system_update`
--

INSERT INTO `system_update` (`system_update_id`, `update_title`, `update_information`, `date`) VALUES
(2, 'New Design', 'Return value changed in 5.3.3 - between 5.3.0 and 5.3.2 (incl.) when the result set was empty NULL was returned. 5.3.3+ returns an empty array.\r\nAlso, mysqli_fetch_all works only for buffered result sets, which are the default for mysqli_query. MYSQLI_USE_RESULT will be supported in 5.3.4+\r\nHowever, it makes little sense to use it this way, materialising unbuffered sets. In this case choose STORE_RESULT, and fetch_all won\'t copy the data, but reference it, as it is stored already in mysqlnd.', '2022-05-15'),
(3, 'Hello World', 'I was very happy to find your code to create a print button that only printed one div on a page. I’m using Squarespace and your code worked perfectly. My web page in question has multiple photographs and the print button will allow a user to print the photos onto a single output page.\r\n\r\nI’d like to modify this code to specify that the final document printed is limited to a single page. Right now one photo prints across 3-4 pages!\r\n\r\nI’d be grateful if you could please tell me how to modify the code to do the following:\r\n1) modify your code so that the output is always on a single page;\r\n2) if possible – for example, if the code is used to print two or three divs – how can I modify the code to specify that the print output has the divs side-by-side. For example, I’d like to have two images side-by-side in the final printing page. Alternatively, I’m also interested how to modify the code so each photo (what I’m calling a div) prints in a specific area – for example, photo one takes up the top left 1/3 of the page, photo two takes up the top middle 1/3rd of the page, and photo three takes up the top right 1/3 of the page.', '2022-05-15');

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
  `signup_date` varchar(50) NOT NULL,
  `verification_code` varchar(6) NOT NULL,
  `verification_status` varchar(10) NOT NULL,
  `last_seen` datetime NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `unique_id`, `name`, `password`, `contact_number`, `email_account`, `address`, `school`, `degree`, `study_field`, `study_years`, `type`, `contact_person`, `p_p`, `skills`, `coe`, `signup_date`, `verification_code`, `verification_status`, `last_seen`, `status`) VALUES
(86, 522287705, 'user', 'user', 'user', 'user@gmail.com', 'sample', '', '', '', '', 'user', NULL, '../dist/user-images/default/default.png', '', '', '2022-04-06', '123456', 'verified', '2022-04-06 02:59:07', 'Offline now'),
(96, 858345289, 'Christina Amor', 'amor123', '09095734538', 'jhoeberthuenda@thelewiscollege.edu.ph', 'Purok 9 Sampaloc, Sorsogon 4700 Sorsogon Bicol', 'The Lewis College,The Lewis College,The Lewis College', 'Bachelor Of Science in Information Technology,Master\'s in Information Technology,PhD in Information Technology', 'College,Masters,PhD', '2019  - 2022,2023  - 2025,2026  - 2028', 'Jobseeker', NULL, '../dist/user-images/fPkJox3I/id ko.bmp', '																	html5,																																	css3,																																	javascript,React js', 'best in math', '2022-05-05', '557602', 'verified', '2022-05-15 13:55:32', 'Offline now'),
(97, 597341726, 'Macdonald', 'amor123', '09123456789', '	huendahuenda20@gmail.com', 'purok 9 Balogo, Sorsogon 4700 Sorsogon Bicol', '', '', '', '', 'Employer', 'Maria Cristina Amor', '../dist/user-images/GH191IJE/download (3).jpg', '', '', '2022-05-04', '201150', 'verified', '2022-05-15 15:03:11', 'Offline now'),
(98, 402233168, 'Abegail Paulino', 'love123', '09095734538', 'sample1@gmail.com', 'purok 9 Sampaloc, Sorsogon 4700 Sorsogon Bicol', 'The Lewis College,The Lewis College', 'Bachelor Of Science in Information Technology,Master\'s in Information Technology', 'College,Masters', '2020  - 2024,2025  - 2027 ', 'Jobseeker', NULL, '../dist/user-images/uT7T01FJ/th (1).jpg', 'html5,css,javascript', 'best in math', '2022-05-05', '310314', 'verified', '2022-05-04 21:11:24', 'Offline now'),
(101, 875450077, 'angelica reolo', 'oct081992', '09095734123', 'angeljejillosreolo@gmail.com', 'purok 9 Sampaloc, Sorsogon 4700 Sorsogon Bicol', 'The Lewis College,The Lewis College,The Lewis College', 'Bachelor Of Science in Information Technology,Bachelor Of Science in Information Technology,PhD in Information Technology', 'College,Masters,PhD', '2019  - 2023,2019  - 2023,2019  - 2023', 'Jobseeker', NULL, '../dist/user-images/PoKVyYsb/photo-1494790108377-be9c29b29330.jpg', 'programmer', 'best in math,best in neat ,with honor', '2022-05-12', '327725', 'verified', '0000-00-00 00:00:00', ''),
(102, 666559154, 'Lucky Chinatown', '12345', '09095734538', 'abglpaulino@gmail.com', 'Purok 9 Sampaloc, Sorsogon 4700 Sorsogon Bicol', '', '', '', '', 'Employer', 'Abegail Paulino', '../dist/user-images/D7iQ6Ljy/download (3).jpg', '', '', '2022-05-12', '288258', 'verified', '2022-05-12 14:18:59', 'Active now');

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
-- Indexes for table `system_update`
--
ALTER TABLE `system_update`
  ADD PRIMARY KEY (`system_update_id`);

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
  MODIFY `feedback_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `feedback_report`
--
ALTER TABLE `feedback_report`
  MODIFY `feedback_report_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `job`
--
ALTER TABLE `job`
  MODIFY `job_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `job_applicant`
--
ALTER TABLE `job_applicant`
  MODIFY `job_applicant_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `msg_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=214;

--
-- AUTO_INCREMENT for table `system_update`
--
ALTER TABLE `system_update`
  MODIFY `system_update_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
