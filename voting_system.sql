-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 25, 2025 at 02:37 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `voting_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `candidates`
--

CREATE TABLE `candidates` (
  `id` int(11) NOT NULL,
  `election_id` int(11) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `position` varchar(50) NOT NULL,
  `photo_url` text DEFAULT NULL,
  `course` varchar(100) DEFAULT NULL,
  `year` varchar(50) DEFAULT NULL,
  `platform` text DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `motto` text DEFAULT NULL,
  `others` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `candidates`
--

INSERT INTO `candidates` (`id`, `election_id`, `full_name`, `position`, `photo_url`, `course`, `year`, `platform`, `age`, `motto`, `others`, `created_at`) VALUES
(1, 1, 'Alice Mendoza', 'President', 'https://i.pravatar.cc/150?img=1', 'BSIT', '3rd Year', 'Improve campus Wi-Fi, student engagement', 21, 'Together, We Rise!', 'Leader of IT Club', '2025-07-24 05:23:07'),
(2, 1, 'Brian Santos', 'Vice President', 'https://i.pravatar.cc/150?img=2', 'BSIT', '3rd Year', 'Modernize labs, more org support', 22, 'Your Voice, My Mission', 'Interned at Globe Telecom', '2025-07-24 05:23:07'),
(3, 2, 'Catherine Dela Cruz', 'President', 'https://i.pravatar.cc/150?img=3', 'BA English', '4th Year', 'Library reform, academic support', 23, 'Knowledge is Power', 'Debate team captain', '2025-07-24 05:23:07'),
(4, 3, 'Erika Tan', 'President', 'https://i.pravatar.cc/150?img=4', 'BSBA', '3rd Year', 'Financial literacy seminars, entrepreneurship fairs', 21, 'Lead with Purpose', 'CEO of student startup', '2025-07-24 05:23:07'),
(5, 1, 'David Reyes', 'Secretary', 'https://i.pravatar.cc/150?img=3', 'BSIT', '2nd Year', 'Digitalize forms, faster processing', 20, 'Efficiency First', 'Secretary of IT Org', '2025-07-24 05:34:29'),
(6, 1, 'Ella Gonzales', 'Treasurer', 'https://i.pravatar.cc/150?img=4', 'BSBA', '3rd Year', 'Budget transparency, savings plans', 21, 'Every Peso Counts', 'Finance intern', '2025-07-24 05:34:29'),
(7, 1, 'Felix Navarro', 'Auditor', 'https://i.pravatar.cc/150?img=5', 'BSAcc', '4th Year', 'Fair reporting, audit training', 22, 'Trust but Verify', 'Auditing Club VP', '2025-07-24 05:34:29'),
(8, 2, 'Grace Uy', 'Vice President', 'https://i.pravatar.cc/150?img=6', 'BA English', '3rd Year', 'Stronger org funding, academic relief', 21, 'We Hear You', 'Creative Writing Guild head', '2025-07-24 05:34:29'),
(9, 2, 'Henry Cruz', 'Secretary', 'https://i.pravatar.cc/150?img=7', 'BA English', '2nd Year', 'Faster requests, online archives', 20, 'Clear, Quick, Correct', 'Essay contest winner', '2025-07-24 05:34:29'),
(10, 3, 'Isabel Lopez', 'Treasurer', 'https://i.pravatar.cc/150?img=8', 'BSBA', '2nd Year', 'E-budgeting system, fund workshops', 20, 'Plan. Save. Lead.', 'Budgeting Bootcamp grad', '2025-07-24 05:34:29'),
(11, 3, 'Joshua Lim', 'Auditor', 'https://i.pravatar.cc/150?img=9', 'BSBA', '4th Year', 'Accurate records, full transparency', 22, 'Details Matter', 'Finalist, National Audit Cup', '2025-07-24 05:34:29'),
(12, 3, 'Karen David', 'Secretary', 'https://i.pravatar.cc/150?img=10', 'BSBA', '3rd Year', 'Instant notifications, minutes tracker', 21, 'Stay Informed, Stay Empowered', 'BA Secretary', '2025-07-24 05:34:29'),
(13, 2, 'Leo Salazar', 'Treasurer', 'https://i.pravatar.cc/150?img=11', 'BA English', '4th Year', 'Budget reports, scholarship drives', 23, 'Smart Spending, Brighter Future', 'Head, Poetry Org', '2025-07-24 05:34:29');

-- --------------------------------------------------------

--
-- Table structure for table `colleges`
--

CREATE TABLE `colleges` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `colleges`
--

INSERT INTO `colleges` (`id`, `name`) VALUES
(1, 'College of Engineering'),
(2, 'College of Arts and Sciences'),
(3, 'College of Business');

-- --------------------------------------------------------

--
-- Table structure for table `elections`
--

CREATE TABLE `elections` (
  `id` int(11) NOT NULL,
  `college_id` int(11) DEFAULT NULL,
  `title` varchar(150) DEFAULT NULL,
  `status` enum('active','closed') DEFAULT 'active',
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `course` varchar(50) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `elections`
--

INSERT INTO `elections` (`id`, `college_id`, `title`, `status`, `start_date`, `end_date`, `course`) VALUES
(1, 1, 'Engineering Student Council Election 2025', 'active', '2025-07-01', '2025-07-30', 'BSIT'),
(2, 2, 'Arts Student Election', 'closed', '2025-06-01', '2025-06-15', 'BA'),
(3, 3, 'Business Council Election', 'active', '2025-07-15', '2025-07-30', 'BSBA');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `student_id` varchar(20) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `college_id` int(11) DEFAULT NULL,
  `first_name` varchar(50) NOT NULL,
  `middle_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) NOT NULL,
  `ext` varchar(10) DEFAULT NULL,
  `gender` enum('Male','Female','Other') NOT NULL,
  `course_year_section` varchar(100) DEFAULT NULL,
  `year_level` int(11) DEFAULT NULL,
  `status` enum('active','inactive') DEFAULT 'active',
  `course` varchar(50) DEFAULT NULL,
  `section` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `student_id`, `name`, `password`, `college_id`, `first_name`, `middle_name`, `last_name`, `ext`, `gender`, `course_year_section`, `year_level`, `status`, `course`, `section`) VALUES
(53, '23-19846', NULL, '23-198463', NULL, 'Rendell', 'Manigway', 'Abindan', '', 'Male', NULL, 3, 'active', 'BSIT', 'A'),
(54, '24-214213', NULL, '24-2142132', NULL, 'Keana Ann', 'Lisalis', 'Abuli', '', 'Female', NULL, 2, 'active', 'BSIT', 'A'),
(55, '25-117108', NULL, '25-1171082', NULL, 'Japhet', 'Agetyeng', 'Aclayan', '', 'Male', NULL, 2, 'active', 'BSIT', 'B'),
(56, '22-10078', NULL, '22-100784', NULL, 'Moh Yassir', 'Islao', 'Adoma', '', 'Male', NULL, 4, 'active', 'BSIT', 'A'),
(57, '25-115637', NULL, '25-1156371', NULL, 'Yasnor', 'Islao', 'Adoma', '', 'Male', NULL, 1, 'active', 'BSIT', 'A'),
(58, '23-19454', NULL, '23-194543', NULL, 'Ruel', 'Arnold', 'Aduca', '', 'Male', NULL, 3, 'active', 'BSIT', 'A'),
(59, '25-115539', NULL, '25-1155391', NULL, 'Vincent', 'David', 'Aggueban', '', 'Male', NULL, 1, 'active', 'BSIT', 'B'),
(60, '24-113854', NULL, '24-1138542', NULL, 'Princes Ryla', 'Appag', 'Agpad', '', 'Female', NULL, 2, 'active', 'BSIT', 'A'),
(61, '24-111860', NULL, '24-1118602', NULL, 'Precious Lara', 'Masibag', 'Alingod', '', 'Female', NULL, 2, 'active', 'BSIT', 'A'),
(62, '24-112985', NULL, '24-1129851', NULL, 'Justin', 'Ramos', 'Alisto', '', 'Male', NULL, 1, 'active', 'BSIT', 'C'),
(63, '25-115864', NULL, '25-1158641', NULL, 'Lenord', 'Puday', 'Alngag', '', 'Male', NULL, 1, 'active', 'BSIT', 'A'),
(64, '23-19399', NULL, '23-193993', NULL, 'Jarley', 'Parrocha', 'Amador', '', 'Male', NULL, 3, 'active', 'BSIT', 'A'),
(65, '25-116706', NULL, '25-1167061', NULL, 'Shiena Mae', 'Baltar', 'Ambong', '', 'Female', NULL, 1, 'active', 'BSIT', 'B');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `candidates`
--
ALTER TABLE `candidates`
  ADD PRIMARY KEY (`id`),
  ADD KEY `election_id` (`election_id`);

--
-- Indexes for table `colleges`
--
ALTER TABLE `colleges`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `elections`
--
ALTER TABLE `elections`
  ADD PRIMARY KEY (`id`),
  ADD KEY `college_id` (`college_id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `student_id` (`student_id`),
  ADD KEY `college_id` (`college_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `candidates`
--
ALTER TABLE `candidates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `colleges`
--
ALTER TABLE `colleges`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `elections`
--
ALTER TABLE `elections`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `candidates`
--
ALTER TABLE `candidates`
  ADD CONSTRAINT `candidates_ibfk_1` FOREIGN KEY (`election_id`) REFERENCES `elections` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `elections`
--
ALTER TABLE `elections`
  ADD CONSTRAINT `elections_ibfk_1` FOREIGN KEY (`college_id`) REFERENCES `colleges` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `students_ibfk_1` FOREIGN KEY (`college_id`) REFERENCES `colleges` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
