-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 07, 2025 at 06:10 AM
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
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `username` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`username`, `email`, `password`) VALUES
('admin', '', 'admin');

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
(68, 27, 'Charlou Ybarley', 'President', 'uploads/img_6892b6580ce541.53465746.png', 'BSIT', '4', 'All For One', NULL, 'The Harder The Battle The Sweeter The Victory', NULL, '2025-08-06 01:16:05'),
(69, 27, 'Corpuz, Wayne Chester Olao', 'President', 'uploads/1754443274_user.png', 'BSIT', '4', 'Ill Do What I want', NULL, 'Do What You Want', NULL, '2025-08-06 01:21:14'),
(70, 27, 'Cosmiano, Abraham Kyle Bagliw', 'Vice President', 'uploads/1754443304_user.png', 'BSIT', '4', 'sdsdsd', NULL, 'dssddssd', NULL, '2025-08-06 01:21:44'),
(71, 27, 'Cullapoy, Xyril Joyce A', 'Auditor', 'uploads/1754443327_user.png', 'BSIT', '3', 'sdsd', NULL, 'zsdsd', NULL, '2025-08-06 01:22:07'),
(113, 27, 'Amador, Jarley Parrocha', 'President', 'uploads/img_6892b66229f0a9.08556773.png', 'BSIT', '3', 'My platform for president.', 20, 'Excellence in president.', 'Active student leader.', '2025-08-05 17:35:20'),
(116, 27, 'Anggati, Edilbert Dao-gas', 'Vice President', 'uploads/img_6892b6693f59b4.03890754.png', 'BSIT', '4', 'My platform for vice president.', 18, 'Excellence in vice president.', 'Active student leader.', '2025-08-05 17:35:20'),
(117, 27, 'Alisto, Justin Ramos', 'Vice President', 'uploads/img_6892b66fe1ce99.64411052.png', 'BSIT', '1', 'My platform for vice president.', 23, 'Excellence in vice president.', 'Active student leader.', '2025-08-05 17:35:20'),
(118, 27, 'Aggueban, Vincent David', 'Secretary', 'uploads/img_6892b69dc7b312.87486187.png', 'BSIT', '1', 'My platform for secretary.', 19, 'Excellence in secretary.', 'Active student leader.', '2025-08-05 17:35:20'),
(119, 27, 'Agpad, Princes Ryla Appag', 'Secretary', 'uploads/img_6892b6a70b8383.17626914.png', 'BSIT', '2', 'My platform for secretary.', 24, 'Excellence in secretary.', 'Active student leader.', '2025-08-05 17:35:20'),
(120, 27, 'Anniban, Norvie Dangelan', 'Auditor', 'uploads/img_6892b67767b010.64990636.png', 'BSIT', '2', 'My platform for auditor.', 21, 'Excellence in auditor.', 'Active student leader.', '2025-08-05 17:35:20'),
(121, 27, 'Alingod, Precious Lara Masibag', 'Auditor', 'uploads/img_6892b6be947199.64614096.png', 'BSIT', '2', 'My platform for auditor.', 19, 'Excellence in auditor.', 'Active student leader.', '2025-08-05 17:35:20'),
(122, 27, 'Alngag, Lenord Puday', 'Treasurer', 'uploads/img_6892b6cd746dc1.62430062.png', 'BSIT', '1', 'My platform for treasurer.', 21, 'Excellence in treasurer.', 'Active student leader.', '2025-08-05 17:35:20'),
(123, 27, 'Angpao, Rising Hope Dalalo', 'Treasurer', 'uploads/img_6892b6b7931bf9.09787946.png', 'BSIT', '4', 'My platform for treasurer.', 22, 'Excellence in treasurer.', 'Active student leader.', '2025-08-05 17:35:20'),
(124, 27, 'Adoma, Yasnor Islao', 'Business Manager', 'uploads/img_6892b6f33010c0.33806308.png', 'BSIT', '1', 'My platform for business manager.', 22, 'Excellence in business manager.', 'Active student leader.', '2025-08-05 17:35:20'),
(125, 27, 'Aclayan, Japhet Agetyeng', 'Business Manager', 'uploads/img_6892b6fbcd3c10.44783411.png', 'BSIT', '2', 'My platform for business manager.', 23, 'Excellence in business manager.', 'Active student leader.', '2025-08-05 17:35:20'),
(126, 27, 'Angalao, Neri Cullapoy Ii', 'Sentinel', 'uploads/img_6892b704de28d8.25493794.png', 'BSIT', '2', 'My platform for sentinel.', 20, 'Excellence in sentinel.', 'Active student leader.', '2025-08-05 17:35:20'),
(127, 27, 'Abuli, Keana Ann Lisalis', 'Sentinel', 'uploads/img_6892b70da0c662.92159913.png', 'BSIT', '2', 'My platform for sentinel.', 22, 'Excellence in sentinel.', 'Active student leader.', '2025-08-05 17:35:20'),
(128, 27, 'Anniban, Kerwin Liggayu', 'First Year Rep', 'uploads/img_6892b6d5f21596.73172136.png', 'BSIT', '1', 'My platform for first year rep.', 22, 'Excellence in first year rep.', 'Active student leader.', '2025-08-05 17:35:20'),
(129, 27, 'Abindan, Rendell Manigway', 'First Year Rep', 'uploads/img_6892b6c67f7db4.92885464.png', 'BSIT', '3', 'My platform for first year rep.', 21, 'Excellence in first year rep.', 'Active student leader.', '2025-08-05 17:35:20'),
(130, 27, 'Andem, Kurt Kurvey Casanova', 'Second Year Rep', 'uploads/img_6892b6b0b50ef7.81697818.png', 'BSIT', '2', 'My platform for second year rep.', 20, 'Excellence in second year rep.', 'Active student leader.', '2025-08-05 17:35:20'),
(131, 27, 'Adoma, Moh Yassir Islao', 'Second Year Rep', 'uploads/img_6892b6e7899248.20886358.png', 'BSIT', '2', 'My platform for second year rep.', 19, 'Excellence in second year rep.', 'Active student leader.', '2025-08-05 17:35:20'),
(134, 27, 'Villanueva, Rei Jethro Tenay', 'Third Year Representative', 'uploads/1754445288_user.png', 'BSIT', '4', 'sd', NULL, 'sd', NULL, '2025-08-06 01:54:48'),
(135, 27, 'Wayyag, Vina Guimba', 'Auditor', 'uploads/1754445312_user.png', 'BSIT', '2', 'sd', NULL, 'sd', NULL, '2025-08-06 01:55:12'),
(136, 27, 'Ulod, Patrick Sib-at Patrick', 'Fourth Year Representative', 'uploads/1754445356_user.png', 'BSIT', '4', 'sd', NULL, 'sd', NULL, '2025-08-06 01:55:56'),
(137, 27, 'Wanawan, Ilyne Joy Antonio', 'Third Year Representative', 'uploads/1754445370_user.png', 'BSIT', '3', 'as', NULL, 'as', NULL, '2025-08-06 01:56:10'),
(138, 27, 'Wanawan, Ilyne Joy Antonio', 'Third Year Representative', 'uploads/1754445384_user.png', 'BSIT', '3', 'as', NULL, 'as', NULL, '2025-08-06 01:56:24'),
(139, 27, 'Valdez, Jake Julakit', 'Fourth Year Representative', 'uploads/1754445674_user.png', 'BSIT', '4', 'sd', NULL, 'sd', NULL, '2025-08-06 02:01:14'),
(140, 27, 'Mark Joby Aguilar', 'Business Manager', '', 'BSIT', '3', '', NULL, '', NULL, '2025-08-06 02:18:29');

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
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` int(11) NOT NULL,
  `college_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `acro_name` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `college_id`, `name`, `acro_name`) VALUES
(2, 1, 'BSIT', NULL);

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
  `course` varchar(50) NOT NULL DEFAULT '',
  `created_at` datetime DEFAULT current_timestamp(),
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `elections`
--

INSERT INTO `elections` (`id`, `college_id`, `title`, `status`, `start_date`, `end_date`, `course`, `created_at`, `description`) VALUES
(27, 1, 'Information Technology Officers Election', 'active', '2025-08-06', '2025-08-30', 'BSIT', '2025-08-06 09:12:41', 'Election for new officers to represent the IT department.');

-- --------------------------------------------------------

--
-- Table structure for table `election_positions`
--

CREATE TABLE `election_positions` (
  `id` int(11) NOT NULL,
  `election_id` int(11) NOT NULL,
  `position` varchar(255) NOT NULL,
  `count` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `election_positions`
--

INSERT INTO `election_positions` (`id`, `election_id`, `position`, `count`) VALUES
(65, 27, 'President', 1),
(66, 27, 'Vice President', 1),
(67, 27, 'Secretary', 1),
(68, 27, 'Auditor', 1),
(69, 27, 'Business Manager', 2),
(70, 27, 'Sentinel', 1),
(71, 27, 'First Year Representative', 1),
(72, 27, 'Second Year Representative', 1),
(73, 27, 'Third Year Representative', 1),
(74, 27, 'Fourth Year Representative', 1);

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
  `course` varchar(500) DEFAULT NULL,
  `section` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `student_id`, `name`, `password`, `college_id`, `first_name`, `middle_name`, `last_name`, `ext`, `gender`, `course_year_section`, `year_level`, `status`, `course`, `section`) VALUES
(110, '23-19846', NULL, '23-19846', 1, 'Rendell', 'Manigway', 'Abindan', '', 'Male', 'BSIT - 3-A', 3, 'active', 'BSIT', '3-A'),
(111, '24-214213', NULL, '24-214213', 1, 'Keana Ann', 'Lisalis', 'Abuli', '', 'Female', 'BSIT - 2-A', 2, 'active', 'BSIT', '2-A'),
(112, '25-117108', NULL, '25-117108', 1, 'Japhet', 'Agetyeng', 'Aclayan', '', 'Male', 'BSIT - 2-B', 2, 'active', 'BSIT', '2-B'),
(113, '22-10078', NULL, '22-10078', 1, 'Moh Yassir', 'Islao', 'Adoma', '', 'Male', 'BSIT - 4-A', 4, 'active', 'BSIT', '4-A'),
(114, '25-115637', NULL, '25-115637', 1, 'Yasnor', 'Islao', 'Adoma', '', 'Male', 'BSIT - 1-A', 1, 'active', 'BSIT', '1-A'),
(115, '23-19454', NULL, '23-19454', 1, 'Ruel', 'Arnold', 'Aduca', '', 'Male', 'BSIT - 3-A', 3, 'active', 'BSIT', '3-A'),
(116, '25-115539', NULL, '25-115539', 1, 'Vincent', 'David', 'Aggueban', '', 'Male', 'BSIT - 1-B', 1, 'active', 'BSIT', '1-B'),
(117, '24-113854', NULL, '24-113854', 1, 'Princes Ryla', 'Appag', 'Agpad', '', 'Female', 'BSIT - 2-A', 2, 'active', 'BSIT', '2-A'),
(118, '24-111860', NULL, '24-111860', 1, 'Precious Lara', 'Masibag', 'Alingod', '', 'Female', 'BSIT - 2-A', 2, 'active', 'BSIT', '2-A'),
(119, '24-112985', NULL, '24-112985', 1, 'Justin', 'Ramos', 'Alisto', '', 'Male', 'BSIT - 1-C', 1, 'active', 'BSIT', '1-C'),
(120, '25-115864', NULL, '25-115864', 1, 'Lenord', 'Puday', 'Alngag', '', 'Male', 'BSIT - 1-A', 1, 'active', 'BSIT', '1-A'),
(121, '23-19399', NULL, '23-19399', 1, 'Jarley', 'Parrocha', 'Amador', '', 'Male', 'BSIT - 3-A', 3, 'active', 'BSIT', '3-A'),
(122, '25-116706', NULL, '25-116706', 1, 'Shiena Mae', 'Baltar', 'Ambong', '', 'Female', 'BSIT - 1-B', 1, 'active', 'BSIT', '1-B'),
(123, '24-111861', NULL, '24-111861', 1, 'Kurt Kurvey', 'Casanova', 'Andem', '', 'Male', 'BSIT - 2-A', 2, 'active', 'BSIT', '2-A'),
(124, '24-112026', NULL, '24-112026', 1, 'Lyrah', 'Vidad', 'Andres', '', 'Female', 'BSIT - 2-B', 2, 'active', 'BSIT', '2-B'),
(125, '24-214175', NULL, '24-214175', 1, 'Neri', 'Cullapoy', 'Angalao', 'Ii', 'Male', 'BSIT - 2-A', 2, 'active', 'BSIT', '2-A'),
(126, '20-20112', NULL, '20-20112', 1, 'Edilbert', 'Dao-gas', 'Anggati', '', 'Male', 'BSIT - 4-A', 4, 'active', 'BSIT', '4-A'),
(127, '20-20480', NULL, '20-20480', 1, 'Rising Hope', 'Dalalo', 'Angpao', '', 'Female', 'BSIT - 4-A', 4, 'active', 'BSIT', '4-A'),
(128, '24-113879', NULL, '24-113879', 1, 'Kerwin', 'Liggayu', 'Anniban', '', 'Male', 'BSIT - 1-C', 1, 'active', 'BSIT', '1-C'),
(129, '24-112025', NULL, '24-112025', 1, 'Norvie', 'Dangelan', 'Anniban', '', 'Female', 'BSIT - 2-B', 2, 'active', 'BSIT', '2-B'),
(310, '20-10345', NULL, '20-10345', 1, 'Jannah Mae', 'Diwayan', 'Lapuz', '', 'Female', NULL, 4, 'active', 'BSIT', NULL),
(329, '20-20099', NULL, '20-20099', 1, 'Yahya', 'Mangondato', 'Camad', '', 'Male', 'BSIT - 2-B', 2, 'active', 'BSIT', '2-B'),
(330, '23-19453', NULL, '23-19453', 1, 'Teodoro Jr.', 'Gumaad', 'Camalao', '', 'Male', 'BSIT - 2-B', 2, 'active', 'BSIT', '2-B'),
(331, '22-10334', NULL, '22-10334', 1, 'Justin', 'Gollingan', 'Camilo', '', 'Male', 'BSIT - 4-A', 4, 'active', 'BSIT', '4-A'),
(332, '25-115372', NULL, '25-115372', 1, 'Anderson', 'Gabor', 'Canabang', '', 'Male', 'BSIT - 1-C', 1, 'active', 'BSIT', '1-C'),
(333, '23-19378', NULL, '23-19378\r\n', 1, 'Marc Miguel', 'Doligas', 'Cañas', '', 'Male', 'BSIT - 2-A', 2, 'active', 'BSIT', '2-A'),
(334, '22-10834', NULL, '22-10834', 1, 'John Ryan', 'Baruzo', 'Caoile', '', 'Male', 'BSIT - 4-B', 4, 'active', 'BSIT', '4-B'),
(335, '22-10542', NULL, '22-10542', 1, 'Jeus', 'Morales', 'Caranguian', '', 'Male', 'BSIT - 4-B', 4, 'active', 'BSIT', '4-B'),
(336, '22-10404', NULL, '22-10404', 1, 'Rexton', 'Masaway', 'Carbonell', '', 'Male', 'BSIT - 3-A', 3, 'active', 'BSIT', '3-A'),
(337, '23-19439', NULL, '23-19439', 1, 'Reyster', 'Masaway', 'Carbonell', '', 'Male', 'BSIT - 3-A', 3, 'active', 'BSIT', '3-A'),
(338, '24-111936', NULL, '24-111936', 1, 'John Rey', 'Binay-og', 'Cardenas', '', 'Male', 'BSIT - 2-A', 2, 'active', 'BSIT', '2-A'),
(339, '22-10718', NULL, '22-10718', 1, 'Edward', 'Sacki', 'Caronan', '', 'Male', 'BSIT - 4-B', 4, 'active', 'BSIT', '4-B'),
(340, '25-116847', NULL, '25-116847', 1, 'Shyra', 'Cadatal', 'Casing', '', 'Female', 'BSIT - 1-C', 1, 'active', 'BSIT', '1-C'),
(341, '21-11821', NULL, '21-11821', 1, 'Enrique', 'Dela Peña', 'Casirayan', 'Jr', 'Male', 'BSIT - 2-B', 2, 'active', 'BSIT', '2-B'),
(342, '24-111923', NULL, '24-111923', 1, 'Daryl', 'Alipit', 'Castillo', '', 'Male', 'BSIT - 2-A', 2, 'active', 'BSIT', '2-A'),
(343, '22-10875', NULL, '22-10875', 1, 'Justin Lee', 'Sannadan', 'Castro', '', 'Male', 'BSIT - 2-A', 2, 'active', 'BSIT', '2-A'),
(344, '25-116364', NULL, '25-116364', 1, 'Rhea', 'Desay', 'Catriz', '', 'Female', 'BSIT - 1-A', 1, 'active', 'BSIT', '1-A'),
(345, '22-10731', NULL, '22-10731', 1, 'Chansai', 'Agustin', 'Cera', '', 'Female', 'BSIT - 3-A', 3, 'active', 'BSIT', '3-A'),
(346, '25-115005', NULL, '25-115005', 1, 'Margie', 'Laggui', 'Codiam', '', 'Female', 'BSIT - 1-A', 1, 'active', 'BSIT', '1-A'),
(347, '21-11069', NULL, '21-11069', 1, 'Rashil', 'Balangui', 'Codiam', '', 'Female', 'BSIT - 4-A', 4, 'active', 'BSIT', '4-A'),
(348, '24-111892', NULL, '24-111892', 1, 'Danielle', 'Aquino', 'Collado', '', 'Female', 'BSIT - 2-A', 2, 'active', 'BSIT', '2-A'),
(349, '25-116667', NULL, '25-116667', 1, 'Sunshine Kieth', 'Dawaton', 'Comadre', '', 'Female', 'BSIT - 1-A', 1, 'active', 'BSIT', '1-A'),
(350, '21-11952', NULL, '21-11952', 1, 'Leian Andrie', 'Julakit', 'Coquia', '', 'Male', 'BSIT - 4-B', 4, 'active', 'BSIT', '4-B'),
(351, '22-10291', NULL, '22-10291', 1, 'Wayne Chester', 'Olao', 'Corpuz', '', 'Male', 'BSIT - 4-A', 4, 'active', 'BSIT', '4-A'),
(352, '21-12134', NULL, '21-12134', 1, 'Alfred Anthony', 'C.', 'Cortez', '', 'Male', 'BSIT - 3-B', 3, 'active', 'BSIT', '3-B'),
(353, '21-11349', NULL, '21-11349', 1, 'Abraham Kyle', 'Bagliw', 'Cosmiano', '', 'Male', 'BSIT - 4-B', 4, 'active', 'BSIT', '4-B'),
(354, '25-115635', NULL, '25-115635', 1, 'Xyril Joyce', 'A', 'Cullapoy', '', 'Female', 'BSIT - 1-A', 1, 'active', 'BSIT', '1-A'),
(355, '25-115626', NULL, '25-115626', 1, 'Genrous', 'Casiano', 'Cureg', '', 'Female', 'BSIT - 1-B', 1, 'active', 'BSIT', '1-B'),
(356, '21-12282', NULL, '21-12282', 1, 'Arvie', 'Mangaoang', 'Dacio', '', 'Male', 'BSIT - 4-A', 4, 'active', 'BSIT', '4-A'),
(357, '23-19526', NULL, '23-19526', 1, 'Irish', 'Cañete', 'Dacnas', '', 'Female', 'BSIT - 3-A', 3, 'active', 'BSIT', '3-A'),
(358, '25-115382', NULL, '25-115382', 1, 'Revan', 'Salingbay', 'Dakiwag', '', 'Male', 'BSIT - 1-A', 1, 'active', 'BSIT', '1-A'),
(359, '25-116915', NULL, '25-116915', 1, 'Jeanylyn Mewag', 'Daligdig', 'Daligdig', '', 'Female', 'BSIT - 1-B', 1, 'active', 'BSIT', '1-B'),
(360, '25-115631', NULL, '25-115631', 1, 'Jonathan Calica', 'Dalingay', 'Dalingay', '', 'Male', 'BSIT - 1-C', 1, 'active', 'BSIT', '1-C'),
(361, '22-10095', NULL, '22-10095', 1, 'Mariam Abe', 'Dalire', 'Dalire', '', 'Female', 'BSIT - 4-A', 4, 'active', 'BSIT', '4-A'),
(362, '24-113874', NULL, '24-113874', 1, 'Zhean Wassig', 'Daluson', 'Daluson', '', 'Male', 'BSIT - 2-B', 2, 'active', 'BSIT', '2-B'),
(363, '25-116824', NULL, '25-116824', 1, 'Mira', 'Abalos', 'Dalwines', '', 'Female', 'BSIT - 1-B', 1, 'active', 'BSIT', '1-B'),
(364, '25-116634', NULL, '25-116634', 1, 'Reinheart', 'Nagoy', 'Damagon', '', 'Male', 'BSIT - 1-B', 1, 'active', 'BSIT', '1-B'),
(365, '22-11507', NULL, '22-11507', 1, 'Mhelle Anthony', 'Cunanan', 'Damian', '', 'Male', 'BSIT - 1-C', 1, 'active', 'BSIT', '1-C'),
(366, '25-116898', NULL, '25-116898', 1, 'Marie Faye', 'Dalwines', 'Dammay', '', 'Female', 'BSIT - 1-B', 1, 'active', 'BSIT', '1-B'),
(367, '23-19457', NULL, '23-19457', 1, 'Carl Vincent', 'Hemoya', 'Dang-as', '', 'Male', 'BSIT - 3-A', 3, 'active', 'BSIT', '3-A'),
(368, '25-115479', NULL, '25-115479', 1, 'Junnah Clair', 'Calading', 'Dangpason', '', 'Female', 'BSIT - 1-C', 1, 'active', 'BSIT', '1-C'),
(369, '24-112464', NULL, '24-112464', 1, 'Renz Omar', 'Paganao', 'Dañoso', '', 'Male', 'BSIT - 2-A', 2, 'active', 'BSIT', '2-A'),
(370, '20-01801', NULL, '20-01801', 1, 'Janet', 'Gannaban', 'Daodawen', '', 'Female', 'BSIT - 2-B', 2, 'active', 'BSIT', '2-B'),
(371, '25-116373', NULL, '25-116373', 1, 'Eugene', 'Diwayan', 'Daowag', 'Jr.', 'Male', 'BSIT - 1-A', 1, 'active', 'BSIT', '1-A'),
(372, '24-S11927', NULL, '24-S11927', 1, 'Sirverio', 'Bannoya', 'Dapanas', '', 'Male', 'BSIT - 2-A', 2, 'active', 'BSIT', '2-A'),
(373, '22-10571', NULL, '22-105714', 1, 'Ark Jorden', 'Topi', 'Datul', '', 'Male', 'BSIT - 4-B', 4, 'active', 'BSIT', '4-B'),
(374, '21-11083', NULL, '21-110834', 1, 'Keno Dave', 'Bangibang', 'Dawaten', '', 'Male', 'BSIT - 4-A', 4, 'active', 'BSIT', '4-A'),
(375, '22-10430', NULL, '22-104304', 1, 'John Rey', 'Liaban', 'Dawaton', '', 'Male', 'BSIT - 4-A', 4, 'active', 'BSIT', '4-A'),
(376, '24-112677', NULL, '24-1126771', 1, 'Angelo', 'Banisal', 'De Belen', '', 'Male', 'BSIT - 1-C', 1, 'active', 'BSIT', '1-C'),
(377, '24-214185', NULL, '24-2141852', 1, 'James', 'Balawag', 'De Leon', '', 'Male', 'BSIT - 2-A', 2, 'active', 'BSIT', '2-A'),
(378, '25-116077', NULL, '25-1160771', 1, 'Isaiah', 'Chomarsing', 'De Vera', '', 'Male', 'BSIT - 1-A', 1, 'active', 'BSIT', '1-A'),
(379, '23-19433', NULL, '23-194333', 1, 'Hanz Gabriel', 'Cardosa', 'Dela Cruz', '', 'Male', 'BSIT - 3-A', 3, 'active', 'BSIT', '3-A'),
(380, '23-110208', NULL, '23-1102083', 1, 'Crystel Mae', 'Carbonel', 'Dela Cueva', '', 'Female', 'BSIT - 3-A', 3, 'active', 'BSIT', '3-A'),
(381, '23-19465', NULL, '23-194653', 1, 'Janelle Anne', 'Carbonel', 'Dela Cueva', '', 'Female', 'BSIT - 3-A', 3, 'active', 'BSIT', '3-A'),
(382, '23-19856', NULL, '23-198563', 1, 'Jerwin Paul', 'Carbonel', 'Dela Cueva', '', 'Female', 'BSIT - 3-A', 3, 'active', 'BSIT', '3-A'),
(383, '23-19350', NULL, '23-193503', 1, 'Messiah', 'Gumpad', 'Delarna', '', 'Male', 'BSIT - 3-A', 3, 'active', 'BSIT', '3-A'),
(384, '21-11524', NULL, '21-115244', 1, 'Reina Shalimar', 'Baguiwan', 'Delos Reyes', '', 'Female', 'BSIT - 4-B', 4, 'active', 'BSIT', '4-B'),
(385, '25-116874', NULL, '25-1168741', 1, 'Georjanna', 'Cauinian', 'Demot', '', 'Female', 'BSIT - 1-B', 1, 'active', 'BSIT', '1-B'),
(386, '25-116627', NULL, '25-1166271', 1, 'Lloyd', 'Wandaga', 'Denna', 'Lloyd', 'Male', 'BSIT - 1-A', 1, 'active', 'BSIT', '1-A'),
(387, '22-10347', NULL, '22-103474', 1, 'Jayson', 'Santos', 'Denosta', 'Jr.', 'Male', 'BSIT - 4-A', 4, 'active', 'BSIT', '4-A'),
(388, '20-02370', NULL, '20-023703', 1, 'Johnwayne', 'Gayyed', 'Devalde', '', 'Male', 'BSIT - 3-A', 3, 'active', 'BSIT', '3-A'),
(389, '20-20047', NULL, '20-200474', 1, 'Bee Gee', 'Baliaga', 'Deyag', '', 'Male', 'BSIT - 4-A', 4, 'active', 'BSIT', '4-A'),
(390, '25-116883', NULL, '25-1168831', 1, 'Elrey Mar', 'Nawi', 'Diawan', '', 'Male', 'BSIT - 1-B', 1, 'active', 'BSIT', '1-B'),
(391, '25-116642', NULL, '25-1166421', 1, 'Kent Andrei', 'Valdez', 'Diaz', '', 'Male', 'BSIT - 1-A', 1, 'active', 'BSIT', '1-A'),
(392, '24-113689', NULL, '24-1136892', 1, 'Marnel', 'Calonge', 'Diego', '', 'Male', 'BSIT - 2-A', 2, 'active', 'BSIT', '2-A'),
(393, '24-113911', NULL, '24-1139112', 1, 'Samo', 'Alicmas', 'Dinnao', '', 'Male', 'BSIT - 2-A', 2, 'active', 'BSIT', '2-A'),
(394, '25-116666', NULL, '25-1166661', 1, 'Princess Mhae', 'Enesperos', 'Diwayan', '', 'Female', 'BSIT - 1-A', 1, 'active', 'BSIT', '1-A'),
(395, '24-113936', NULL, '24-1139362', 1, 'Rainer', 'Sison', 'Diwayan', '', 'Female', 'BSIT - 2-B', 2, 'active', 'BSIT', '2-B'),
(396, '24-113488', NULL, '24-1134882', 1, 'Jeremy', 'Dang-awan', 'Dolores', '', 'Male', 'BSIT - 2-B', 2, 'active', 'BSIT', '2-B'),
(397, '21-11084', NULL, '21-110844', 1, 'Jesler', 'Lumasoc', 'Domingo', '', 'Male', 'BSIT - 4-B', 4, 'active', 'BSIT', '4-B'),
(398, '25-116863', NULL, '25-1168631', 1, 'Jed Zandrie', 'Gunaban', 'Dontogan', '', 'Male', 'BSIT - 1-B', 1, 'active', 'BSIT', '1-B'),
(399, '25-117078', NULL, '25-1170781', 1, 'Beverly', 'Ammiyao', 'Ducayag', '', 'Female', 'BSIT - 1-B', 1, 'active', 'BSIT', '1-B'),
(400, '24-113706', NULL, '24-1137062', 1, 'Krizel', 'Borreta', 'Dugayon', '', 'Female', 'BSIT - 2-B', 2, 'active', 'BSIT', '2-B'),
(401, '25-115629', NULL, '25-1156291', 1, 'John', 'Bas-il', 'Dugui-is', '', 'Male', 'BSIT - 1-A', 1, 'active', 'BSIT', '1-A'),
(402, '25-115445', NULL, '25-1154451', 1, 'Brendo', 'Wandaga', 'Duguiawe', '', 'Male', 'BSIT - 1-A', 1, 'active', 'BSIT', '1-A'),
(403, '25-116186', NULL, '25-1161861', 1, 'Krizzette', 'Awid', 'Dul-ay', '', 'Female', 'BSIT - 1-B', 1, 'active', 'BSIT', '1-B'),
(404, '24-112010', NULL, '24-1120102', 1, 'Larvy Gaile', 'Ambong', 'Dulawen', '', 'Female', 'BSIT - 2-B', 2, 'active', 'BSIT', '2-B'),
(405, '23-110180', NULL, '23-1101803', 1, 'John Paul', 'Dason', 'Dulliyao', '', 'Male', 'BSIT - 3-B', 3, 'active', 'BSIT', '3-B'),
(406, '23-110186', NULL, '23-1101863', 1, 'Shaila', 'Malaga', 'Duritan', '', 'Female', 'BSIT - 3-A', 3, 'active', 'BSIT', '3-A'),
(407, '24-113734', NULL, '24-1137342', 1, 'Rayan Jy', 'Ramos', 'Duruin', '', 'Male', 'BSIT - 2-B', 2, 'active', 'BSIT', '2-B'),
(408, '21-11861', NULL, '21-11861', 1, 'Charlou', 'Tenebro', 'Ybarley', '', 'Male', NULL, 4, 'active', '2', NULL),
(409, '21-11770', NULL, '21-11770', 1, 'France Kelly', 'Kikong', 'Villanueva', '', 'Male', NULL, 4, 'active', '2', NULL),
(410, '24-214130', 'Edao, Karl Max Lingayo', '24-214130', 1, 'Karl Max', 'Lingayo', 'Edao', '', 'Male', 'BSIT - 1-C', 1, 'active', 'BSIT', 'C'),
(411, '25-115632', 'Edao, Keneth Dale Lingayo', '25-115632', 1, 'Keneth Dale', 'Lingayo', 'Edao', '', 'Male', 'BSIT - 1-B', 1, 'active', 'BSIT', 'B'),
(412, '20-01125', 'Eng-op, Veshell Umba-ang', '20-01125', 1, 'Veshell', 'Umba-ang', 'Eng-op', '', 'Female', 'BSIT - 4-B', 4, 'active', 'BSIT', 'B'),
(413, '25-116926', 'Espejo, Lydia Subido', '25-116926', 1, 'Lydia', 'Subido', 'Espejo', '', 'Female', 'BSIT - 1-C', 1, 'active', 'BSIT', 'C'),
(414, '25-116879', 'Espita, Mark Christian Isidro', '25-116879', 1, 'Mark Christian', 'Isidro', 'Espita', '', 'Male', 'BSIT - 1-B', 1, 'active', 'BSIT', 'B'),
(415, '25-116911', 'Estacio, Joar Cabling', '25-116911', 1, 'Joar', 'Cabling', 'Estacio', '', 'Male', 'BSIT - 1-C', 1, 'active', 'BSIT', 'C'),
(416, '20-00845', 'Esteban, Jane De Belen', '20-00845', 1, 'Jane', 'De Belen', 'Esteban', '', 'Female', 'BSIT - 2-A', 2, 'active', 'BSIT', 'A'),
(417, '21-12340', 'Eyawa, Noel Sagmayao', '21-12340', 1, 'Noel', 'Sagmayao', 'Eyawa', '', 'Male', 'BSIT - 3-A', 3, 'active', 'BSIT', 'A'),
(418, '24-113688', 'Fati-ig, Gilbert Afuyog Jr', '24-113688', 1, 'Gilbert', 'Afuyog', 'Fati-ig', 'Jr', 'Male', 'BSIT - 2-A', 2, 'active', 'BSIT', 'A'),
(419, '23-19440', 'Feliciano, Skyla Olino', '23-19440', 1, 'Skyla', 'Olino', 'Feliciano', '', 'Female', 'BSIT - 3-A', 3, 'active', 'BSIT', 'A'),
(420, '23-19853', 'Fernandez, Jelly Grail Lambayong', '23-19853', 1, 'Jelly Grail', 'Lambayong', 'Fernandez', '', 'Female', 'BSIT - 3-B', 3, 'active', 'BSIT', 'B'),
(421, '23-110194', 'Fernandez, Jezreel Sacayle', '23-110194', 1, 'Jezreel', 'Sacayle', 'Fernandez', '', 'Male', 'BSIT - 3-B', 3, 'active', 'BSIT', 'B'),
(422, '21-11099', 'Fernandez, Jona-marie Macuroy', '21-11099', 1, 'Jona-marie', 'Macuroy', 'Fernandez', '', 'Female', 'BSIT - 4-B', 4, 'active', 'BSIT', 'B'),
(423, '20-20425', 'Fernandez, Pinky Ramirez', '20-20425', 1, 'Pinky', 'Ramirez', 'Fernandez', '', 'Female', 'BSIT - 3-A', 3, 'active', 'BSIT', 'A'),
(424, '23-19158', 'Fontanilla, Angela Kassandra Domingo', '23-19158', 1, 'Angela Kassandra', 'Domingo', 'Fontanilla', '', 'Female', 'BSIT - 2-B', 2, 'active', 'BSIT', 'B'),
(425, '23-19385', 'Fontanilla, Benjie Balintaculo', '23-19385', 1, 'Benjie', 'Balintaculo', 'Fontanilla', '', 'Male', 'BSIT - 3-A', 3, 'active', 'BSIT', 'A'),
(426, '25-115004', 'Gacuya, Klein Xenos Busway', '25-115004', 1, 'Klein Xenos', 'Busway', 'Gacuya', '', 'Male', 'BSIT - 1-A', 1, 'active', 'BSIT', 'A'),
(427, '21-11111', 'Gaddao, Joshua Padilla', '21-11111', 1, 'Joshua', 'Padilla', 'Gaddao', '', 'Male', 'BSIT - 4-B', 4, 'active', 'BSIT', 'B'),
(428, '21-11488', 'Gagelonia, Karl Jearous Calngan', '21-11488', 1, 'Karl Jearous', 'Calngan', 'Gagelonia', '', 'Male', 'BSIT - 4-A', 4, 'active', 'BSIT', 'A'),
(429, '25-116458', 'Gallema, Ever Lee Diwayan', '25-116458', 1, 'Ever Lee', 'Diwayan', 'Gallema', '', 'Female', 'BSIT - 1-A', 1, 'active', 'BSIT', 'A'),
(430, '24-113486', 'Gallema, Rianfroi Santuwa', '24-113486', 1, 'Rianfroi', 'Santuwa', 'Gallema', '', 'Male', 'BSIT - 2-B', 2, 'active', 'BSIT', 'B'),
(431, '25-116674', 'Gallema, Russelle Shyne Baggas', '25-116674', 1, 'Russelle Shyne', 'Baggas', 'Gallema', '', 'Female', 'BSIT - 1-A', 1, 'active', 'BSIT', 'A'),
(432, '25-115368', 'Galwat, Christian Comadre', '25-115368', 1, 'Christian', 'Comadre', 'Galwat', '', 'Male', 'BSIT - 1-C', 1, 'active', 'BSIT', 'C'),
(433, '25-116648', 'Gana-ac, Harvey Atalig', '25-116648', 1, 'Harvey', 'Atalig', 'Gana-ac', '', 'Male', 'BSIT - 1-B', 1, 'active', 'BSIT', 'B'),
(434, '25-115634', 'Gana-ac, Reishelle Mae Panner', '25-115634', 1, 'Reishelle Mae', 'Panner', 'Gana-ac', '', 'Female', 'BSIT - 1-B', 1, 'active', 'BSIT', 'B'),
(435, '24-113900', 'Gannisi, Novie Cosidon', '24-113900', 1, 'Novie', 'Cosidon', 'Gannisi', '', 'Female', 'BSIT - 2-B', 2, 'active', 'BSIT', 'B'),
(436, '22-10209', 'Gapasin, Jamaica Lay-og', '22-10209', 1, 'Jamaica', 'Lay-og', 'Gapasin', '', 'Female', 'BSIT - 4-A', 4, 'active', 'BSIT', 'A'),
(437, '21-11092', 'Garcia, Karen Faye Buado', '21-11092', 1, 'Karen Faye', 'Buado', 'Garcia', '', 'Female', 'BSIT - 4-B', 4, 'active', 'BSIT', 'B'),
(438, '24-214120', 'Garcia, Stanley Buado', '24-214120', 1, 'Stanley', 'Buado', 'Garcia', '', 'Male', 'BSIT - 1-C', 1, 'active', 'BSIT', 'C'),
(439, '24-112012', 'Gawang, Sheila Gunday', '24-112012', 1, 'Sheila', 'Gunday', 'Gawang', '', 'Female', 'BSIT - 2-A', 2, 'active', 'BSIT', 'A'),
(440, '24-111893', 'Gaytoc, Camille Jelica Retotal', '24-111893', 1, 'Camille Jelica', 'Retotal', 'Gaytoc', '', 'Female', 'BSIT - 2-A', 2, 'active', 'BSIT', 'A'),
(441, '25-115486', 'Gayyaman, Zion Jesse Joe Lopez', '25-115486', 1, 'Zion Jesse Joe', 'Lopez', 'Gayyaman', '', 'Male', 'BSIT - 1-C', 1, 'active', 'BSIT', 'C'),
(442, '21-10855', 'Gazzingan, Estela Mariz Pattung', '21-10855', 1, 'Estela Mariz', 'Pattung', 'Gazzingan', '', 'Female', 'BSIT - 3-A', 3, 'active', 'BSIT', 'A'),
(443, '25-116630', 'Gilao, Byoshiko Dariz Dawing Jr', '25-116630', 1, 'Byoshiko Dariz', 'Dawing', 'Gilao', 'Jr', 'Male', 'BSIT - 1-B', 1, 'active', 'BSIT', 'B'),
(444, '25-116884', 'Giwagiw, Kevin Sibaton', '25-116884', 1, 'Kevin', 'Sibaton', 'Giwagiw', '', 'Male', 'BSIT - 1-B', 1, 'active', 'BSIT', 'B'),
(445, '25-115786', 'Godday, Grace Abbacan', '25-115786', 1, 'Grace', 'Abbacan', 'Godday', '', 'Female', 'BSIT - 1-A', 1, 'active', 'BSIT', 'A'),
(446, '24-111885', 'Gom-o, Eliezer Malagyab', '24-111885', 1, 'Eliezer', 'Malagyab', 'Gom-o', '', 'Male', 'BSIT - 2-A', 2, 'active', 'BSIT', 'A'),
(447, '25-116836', 'Gomintong, John Marc Polano', '25-116836', 1, 'John Marc', 'Polano', 'Gomintong', '', 'Male', 'BSIT - 1-B', 1, 'active', 'BSIT', 'B'),
(448, '25-115374', 'Gonayon, Fidel Abawag Jr', '25-115374', 1, 'Fidel', 'Abawag', 'Gonayon', 'Jr', 'Male', 'BSIT - 1-A', 1, 'active', 'BSIT', 'A'),
(449, '22-10752', 'Gonayon, M-a Abawag', '22-10752', 1, 'M-a', 'Abawag', 'Gonayon', '', 'Female', 'BSIT - 4-B', 4, 'active', 'BSIT', 'B'),
(450, '23-19363', 'Gonzales, Jolly Jane Mudlong', '23-19363', 1, 'Jolly Jane', 'Mudlong', 'Gonzales', '', 'Female', 'BSIT - 3-A', 3, 'active', 'BSIT', 'A'),
(451, '24-113895', 'Gragasin, Alexis Dela Cruz', '24-113895', 1, 'Alexis', 'Dela Cruz', 'Gragasin', '', 'Male', 'BSIT - 2-B', 2, 'active', 'BSIT', 'B'),
(452, '23-19423', 'Guban, Ian King Galut', '23-19423', 1, 'Ian King', 'Galut', 'Guban', '', 'Male', 'BSIT - 3-A', 3, 'active', 'BSIT', 'A'),
(453, '25-117110', 'Guimbawan, Diren Banatao', '25-117110', 1, 'Diren', 'Banatao', 'Guimbawan', '', 'Male', 'BSIT - 1-C', 1, 'active', 'BSIT', 'C'),
(454, '23-19982', 'Gulitod, Briana Joyce Sumundod', '23-19982', 1, 'Briana Joyce', 'Sumundod', 'Gulitod', '', 'Female', 'BSIT - 3-B', 3, 'active', 'BSIT', 'B'),
(455, '22-10106', 'Gumpad, Jolina Root', '22-10106', 1, 'Jolina', 'Root', 'Gumpad', '', 'Female', 'BSIT - 4-A', 4, 'active', 'BSIT', 'A'),
(456, '25-117115', 'Gumpad, Wary Dawing', '25-117115', 1, 'Wary', 'Dawing', 'Gumpad', '', 'Female', 'BSIT - 2-B', 2, 'active', 'BSIT', 'B'),
(457, '25-117075', 'Gunaban, Frederick Morales', '25-117075', 1, 'Frederick', 'Morales', 'Gunaban', '', 'Male', 'BSIT - 2-B', 2, 'active', 'BSIT', 'B'),
(458, '22-10816', 'Gupaal, Friema Malaggay', '22-10816', 1, 'Friema', 'Malaggay', 'Gupaal', '', 'Female', 'BSIT - 3-B', 3, 'active', 'BSIT', 'B'),
(459, '23-19370', 'Guron, Jay-ann Manzano', '23-19370', 1, 'Jay-ann', 'Manzano', 'Guron', '', 'Female', 'BSIT - 3-A', 3, 'active', 'BSIT', 'A'),
(460, '21-11865', 'Henora, Karen Joy Hontillo', '21-11865', 1, 'Karen Joy', 'Hontillo', 'Henora', '', 'Female', 'BSIT - 4-B', 4, 'active', 'BSIT', 'B'),
(461, '25-115790', 'Igloria, Nash Ramos', '25-115790', 1, 'Nash', 'Ramos', 'Igloria', '', 'Male', 'BSIT - 1-A', 1, 'active', 'BSIT', 'A'),
(462, '25-117079', 'Inggao, Kaithlyne Imgay', '25-117079', 1, 'Kaithlyne', 'Imgay', 'Inggao', '', 'Female', 'BSIT - 1-C', 1, 'active', 'BSIT', 'C'),
(463, '25-117046', 'Isleta, Paul Darey Abawag', '25-117046', 1, 'Paul Darey', 'Abawag', 'Isleta', '', 'Male', 'BSIT - 2-B', 2, 'active', 'BSIT', 'B'),
(464, '22-10854', 'Itay, Kingster Gonayon', '22-10854', 1, 'Kingster', 'Gonayon', 'Itay', '', 'Male', 'BSIT - 4-A', 4, 'active', 'BSIT', 'A'),
(465, '22-10724', 'Javier, Kim Chassey Hora', '22-10724', 1, 'Kim Chassey', 'Hora', 'Javier', '', 'Female', 'BSIT - 4-B', 4, 'active', 'BSIT', 'B'),
(466, '20-20391', 'Jiminez, Jhon Rey Bawit', '20-20391', 1, 'Jhon Rey', 'Bawit', 'Jiminez', '', 'Male', 'BSIT - 3-A', 3, 'active', 'BSIT', 'A'),
(467, '24-111813', 'Labrador, Jan Rondel Rostigue', '24-111813', 1, 'Jan Rondel', 'Rostigue', 'Labrador', '', 'Male', 'BSIT - 2-B', 2, 'active', 'BSIT', 'B'),
(468, '25-115845', 'Labrador, Jieda Mae Banawag', '25-115845', 1, 'Jieda Mae', 'Banawag', 'Labrador', '', 'Female', 'BSIT - 1-B', 1, 'active', 'BSIT', 'B'),
(469, '23-19529', 'Lacwasan, Ritcher Bulante', '23-19529', 1, 'Ritcher', 'Bulante', 'Lacwasan', '', 'Male', 'BSIT - 3-A', 3, 'active', 'BSIT', 'A'),
(470, '22-12047', 'Ladrido, Pia Lux Peralta', '22-12047', 1, 'Pia Lux', 'Peralta', 'Ladrido', '', 'Female', 'BSIT - 4-A', 4, 'active', 'BSIT', 'A'),
(471, '23-19929', 'Ladwingon, Shaina Dalutag', '23-19929', 1, 'Shaina', 'Dalutag', 'Ladwingon', '', 'Female', 'BSIT - 3-B', 3, 'active', 'BSIT', 'B'),
(514, '25-116813', 'Antivo, Antonio Jedraye Batang-ay', '25-116813', 1, 'Antonio Jedraye', 'Batang-ay', 'Antivo', NULL, 'Male', 'BSIT - 1-B', 1, 'active', 'BSIT', 'B'),
(515, '25-116703', 'Ao-wat, Reisner Batoy', '25-116703', 1, 'Reisner', 'Batoy', 'Ao-wat', NULL, 'Male', 'BSIT - 1-B', 1, 'active', 'BSIT', 'B'),
(516, '24-112024', 'Apatas, Melvin Bagwan', '24-112024', 1, 'Melvin', 'Bagwan', 'Apatas', NULL, 'Male', 'BSIT - 2-A', 2, 'active', 'BSIT', 'A'),
(517, '24-111862', 'Apay-yeo, Lhester Kyi Foy-os', '24-111862', 1, 'Lhester Kyi', 'Foy-os', 'Apay-yeo', NULL, 'Male', 'BSIT - 2-A', 2, 'active', 'BSIT', 'A'),
(518, '24-111924', 'Apito, Anthony Jr. Quezon', '24-111924', 1, 'Anthony Jr.', 'Quezon', 'Apito', NULL, 'Male', 'BSIT - 2-A', 2, 'active', 'BSIT', 'A'),
(519, '25-115380', 'Araña, Jestony Baguiwong', '25-115380', 1, 'Jestony', 'Baguiwong', 'Araña', NULL, 'Male', 'BSIT - 1-A', 1, 'active', 'BSIT', 'A'),
(520, '23-110813', 'Aromin, Kervy Caranguian', '23-110813', 1, 'Kervy', 'Caranguian', 'Aromin', NULL, 'Male', 'BSIT - 3-B', 3, 'active', 'BSIT', 'B'),
(521, '25-115396', 'Ascaño, Raymart Agustin', '25-115396', 1, 'Raymart', 'Agustin', 'Ascaño', NULL, 'Male', 'BSIT - 1-A', 1, 'active', 'BSIT', 'A'),
(522, '22-10121', 'Awingan, Ranee Mae Oggang', '22-10121', 1, 'Ranee Mae', 'Oggang', 'Awingan', NULL, 'Female', 'BSIT - 4-A', 4, 'active', 'BSIT', 'A'),
(523, '22-10101', 'Baawa, Joshua Ralph Gasatan', '22-10101', 1, 'Joshua Ralph', 'Gasatan', 'Baawa', NULL, 'Male', 'BSIT - 4-A', 4, 'active', 'BSIT', 'A'),
(524, '23-110188', 'Babalan, Christian Bingcan', '23-110188', 1, 'Christian', 'Bingcan', 'Babalan', NULL, 'Male', 'BSIT - 3-B', 3, 'active', 'BSIT', 'B'),
(525, '25-116675', 'Bacaya, Rex Dupali Jr', '25-116675', 1, 'Rex', 'Dupali', 'Bacaya', 'Jr', 'Male', 'BSIT - 1-C', 1, 'active', 'BSIT', 'C'),
(526, '18-10542', 'Bacdayan, Wayne T.', '18-10542', 1, 'Wayne', 'T.', 'Bacdayan', NULL, 'Male', 'BSIT - 2-B', 2, 'active', 'BSIT', 'B'),
(527, '22-10676', 'Bacud, Rosalie Otan', '22-10676', 1, 'Rosalie', 'Otan', 'Bacud', NULL, 'Female', 'BSIT - 4-B', 4, 'active', 'BSIT', 'B'),
(528, '23-19394', 'Baggas, Hinden Von Picat', '23-19394', 1, 'Hinden Von', 'Picat', 'Baggas', NULL, 'Male', 'BSIT - 3-A', 3, 'active', 'BSIT', 'A'),
(529, '25-117006', 'Baggas, Raymar Gassat', '25-117006', 1, 'Raymar', 'Gassat', 'Baggas', NULL, 'Male', 'BSIT - 1-B', 1, 'active', 'BSIT', 'B'),
(530, '20-00308', 'Bagsalay, Leslie Mamattong', '20-00308', 1, 'Leslie', 'Mamattong', 'Bagsalay', NULL, 'Male', 'BSIT - 4-B', 4, 'active', 'BSIT', 'B'),
(531, '22-10967', 'Bagtang, Brandon Benedict Wandaga', '22-10967', 1, 'Brandon Benedict', 'Wandaga', 'Bagtang', NULL, 'Male', 'BSIT - 4-A', 4, 'active', 'BSIT', 'A'),
(532, '22-10813', 'Balacang, Shadrock Albing', '22-10813', 1, 'Shadrock', 'Albing', 'Balacang', NULL, 'Male', 'BSIT - 4-B', 4, 'active', 'BSIT', 'B'),
(533, '20-00983', 'Balangue, Jetlee Lastimosa', '20-00983', 1, 'Jetlee', 'Lastimosa', 'Balangue', NULL, 'Male', 'BSIT - 3-A', 3, 'active', 'BSIT', 'A'),
(582, '23-08693', 'Laed, James Michael Gao-ay', '23-08693', 1, 'James Michael', 'Gao-ay', 'Laed', NULL, 'Male', 'BSIT - 3-B', 3, 'active', 'BSIT', 'B'),
(583, '25-116671', 'Lagrio, Ram-lester Salvador', '25-116671', 1, 'Ram-lester', 'Salvador', 'Lagrio', NULL, 'Male', 'BSIT - 1-A', 1, 'active', 'BSIT', 'A'),
(584, '22-10065', 'Laguisma, Kei-zi Pascion', '22-10065', 1, 'Kei-zi', 'Pascion', 'Laguisma', NULL, 'Female', 'BSIT - 4-A', 4, 'active', 'BSIT', 'A'),
(585, '25-115393', 'Lamarca, Queen Aira Lingbawan', '25-115393', 1, 'Queen Aira', 'Lingbawan', 'Lamarca', NULL, 'Female', 'BSIT - 1-A', 1, 'active', 'BSIT', 'A'),
(586, '25-115429', 'Lambayong, Lexlyn Sicdawag', '25-115429', 1, 'Lexlyn', 'Sicdawag', 'Lambayong', NULL, 'Female', 'BSIT - 1-A', 1, 'active', 'BSIT', 'A'),
(587, '25-116902', 'Lambayong, Yail Salpad', '25-116902', 1, 'Yail', 'Salpad', 'Lambayong', NULL, 'Male', 'BSIT - 1-B', 1, 'active', 'BSIT', 'B'),
(588, '25-117146', 'Lang-ayan, Thony Blaire Lunday', '25-117146', 1, 'Thony Blaire', 'Lunday', 'Lang-ayan', NULL, 'Male', 'BSIT - 1-C', 1, 'active', 'BSIT', 'C'),
(589, '25-117137', 'Langoban, Shane Anilom', '25-117137', 1, 'Shane', 'Anilom', 'LANGOBAN', NULL, 'Male', 'BSIT - 1-C', 1, 'active', 'BSIT', 'C'),
(590, '25-116639', 'Lapa-an, Samuel Nonog', '25-116639', 1, 'Samuel', 'Nonog', 'Lapa-an', NULL, 'Male', 'BSIT - 1-A', 1, 'active', 'BSIT', 'A'),
(591, '20-20019', 'Lapada, Jobelle Cabreros', '20-20019', 1, 'Jobelle', 'Cabreros', 'Lapada', NULL, 'Female', 'BSIT - 4-A', 4, 'active', 'BSIT', 'A'),
(592, '25-115627', 'Latugan, Jerusa Dumondon', '25-115627', 1, 'Jerusa', 'Dumondon', 'Latugan', NULL, 'Female', 'BSIT - 1-A', 1, 'active', 'BSIT', 'A'),
(593, '25-116001', 'Lawad, Jet-li Tollangao Jr', '25-116001', 1, 'Jet-li', 'Tollangao', 'Lawad', 'Jr', 'Male', 'BSIT - 1-A', 1, 'active', 'BSIT', 'A'),
(594, '22-10113', 'Lawad, Kadji Latawan', '22-10113', 1, 'Kadji', 'Latawan', 'Lawad', NULL, 'Male', 'BSIT - 4-A', 4, 'active', 'BSIT', 'A'),
(595, '25-115625', 'Layaban, Cristine Jane Latap', '25-115625', 1, 'Cristine Jane', 'Latap', 'Layaban', NULL, 'Female', 'BSIT - 1-C', 1, 'active', 'BSIT', 'C'),
(596, '25-116439', 'Liagao, Walter Glen Dug-a', '25-116439', 1, 'Walter Glen', 'Dug-a', 'Liagao', NULL, 'Male', 'BSIT - 1-C', 1, 'active', 'BSIT', 'C'),
(597, '24-113913', 'Licuanan, Jurgei Almeda', '24-113913', 1, 'Jurgei', 'Almeda', 'Licuanan', NULL, 'Male', 'BSIT - 2-B', 2, 'active', 'BSIT', 'B'),
(598, '23-110004', 'Lingayo, Karyle Jane Senica', '23-110004', 1, 'Karyle Jane', 'Senica', 'Lingayo', NULL, 'Female', 'BSIT - 3-A', 3, 'active', 'BSIT', 'A'),
(599, '23-211261', 'Lingbaoan, Renze Bangit', '23-211261', 1, 'Renze', 'Bangit', 'Lingbaoan', NULL, 'Male', 'BSIT - 1-C', 1, 'active', 'BSIT', 'C'),
(600, '23-19848', 'Linggayo, Sherylyn Dawig', '23-19848', 1, 'Sherylyn', 'Dawig', 'Linggayo', NULL, 'Female', 'BSIT - 3-A', 3, 'active', 'BSIT', 'A'),
(601, '21-20052', 'Linggayo, Van Aldrin B.', '21-20052', 1, 'Van Aldrin', 'B.', 'Linggayo', NULL, 'Male', 'BSIT - 3-B', 3, 'active', 'BSIT', 'B'),
(602, '24-113771', 'Lisalis, Jetro Onalan', '24-113771', 1, 'Jetro', 'Onalan', 'Lisalis', NULL, 'Male', 'BSIT - 2-A', 2, 'active', 'BSIT', 'A'),
(603, '24-113918', 'Lisalis, Marjeff Angya', '24-113918', 1, 'Marjeff', 'Angya', 'Lisalis', NULL, 'Male', 'BSIT - 2-A', 2, 'active', 'BSIT', 'A'),
(604, '25-116705', 'Lisalis, Sheryn Gumabay', '25-116705', 1, 'Sheryn', 'Gumabay', 'Lisalis', NULL, 'Female', 'BSIT - 1-B', 1, 'active', 'BSIT', 'B'),
(605, '24-111894', 'Litorco, Khen Sillatoc', '24-111894', 1, 'Khen', 'Sillatoc', 'Litorco', NULL, 'Male', 'BSIT - 2-A', 2, 'active', 'BSIT', 'A'),
(606, '24-111925', 'Liw-liw, Charly Banson', '24-111925', 1, 'Charly', 'Banson', 'Liw-liw', NULL, 'Male', 'BSIT - 2-A', 2, 'active', 'BSIT', 'A'),
(607, '24-111921', 'Logao, Prescott Ghoule Angngad', '24-111921', 1, 'Prescott Ghoule', 'Angngad', 'Logao', NULL, 'Male', 'BSIT - 2-A', 2, 'active', 'BSIT', 'A'),
(608, '25-115636', 'Loguibis, Xyzerlene Faith Banawa', '25-115636', 1, 'Xyzerlene Faith', 'Banawa', 'Loguibis', NULL, 'Female', 'BSIT - 1-B', 1, 'active', 'BSIT', 'B'),
(609, '23-18689', 'Longawis, Keith Winslet Bumacas', '23-18689', 1, 'Keith Winslet', 'Bumacas', 'Longawis', NULL, 'Female', 'BSIT - 2-B', 2, 'active', 'BSIT', 'B'),
(610, '24-112348', 'Lopez, Brian Palactao', '24-112348', 1, 'Brian', 'Palactao', 'Lopez', NULL, 'Male', 'BSIT - 2-A', 2, 'active', 'BSIT', 'A'),
(611, '24-113686', 'Lubfonan, Rica Jane Lapawen', '24-113686', 1, 'Rica Jane', 'Lapawen', 'Lubfonan', NULL, 'Female', 'BSIT - 2-A', 2, 'active', 'BSIT', 'A'),
(612, '24-111929', 'Lucas, Danica Banganan', '24-111929', 1, 'Danica', 'Banganan', 'Lucas', NULL, 'Female', 'BSIT - 2-A', 2, 'active', 'BSIT', 'A'),
(613, '25-117175', 'Lumaday, Jello Bilwayan Jr', '25-117175', 1, 'Jello', 'Bilwayan', 'Lumaday', 'Jr', 'Male', 'BSIT - 1-C', 1, 'active', 'BSIT', 'C'),
(614, '24-113909', 'Lumatac, Hilskin Van Tangday', '24-113909', 1, 'Hilskin Van', 'Tangday', 'Lumatac', NULL, 'Male', 'BSIT - 2-A', 2, 'active', 'BSIT', 'A'),
(615, '20-01341', 'Macad, Remy Tambalong', '20-01341', 1, 'Remy', 'Tambalong', 'Macad', NULL, 'Female', 'BSIT - 4-B', 4, 'active', 'BSIT', 'B'),
(616, '21-11446', 'Macanas, Kian Angelo Arias', '21-11446', 1, 'Kian Angelo', 'Arias', 'Macanas', NULL, 'Male', 'BSIT - 4-B', 4, 'active', 'BSIT', 'B'),
(617, '25-115448', 'Madannas, Avril Camma', '25-115448', 1, 'Avril', 'Camma', 'Madannas', NULL, 'Female', 'BSIT - 1-B', 1, 'active', 'BSIT', 'B'),
(618, '22-10359', 'Madriaga, Katleen Joy Addum', '22-10359', 1, 'Katleen Joy', 'Addum', 'Madriaga', NULL, 'Female', 'BSIT - 4-A', 4, 'active', 'BSIT', 'A'),
(619, '25-116182', 'Maga-ao, Venus Gunnawa', '25-116182', 1, 'Venus', 'Gunnawa', 'Maga-ao', NULL, 'Female', 'BSIT - 1-A', 1, 'active', 'BSIT', 'A'),
(620, '25-114998', 'Magalim, Frank Chales De-eg', '25-114998', 1, 'Frank Chales', 'De-eg', 'Magalim', NULL, 'Male', 'BSIT - 1-C', 1, 'active', 'BSIT', 'C'),
(621, '21-11162', 'Magaway, Aeron Agub', '21-11162', 1, 'Aeron', 'Agub', 'Magaway', NULL, 'Male', 'BSIT - 4-A', 4, 'active', 'BSIT', 'A'),
(622, '25-116609', 'Magayam, Angel Bandoc', '25-116609', 1, 'Angel', 'Bandoc', 'Magayam', NULL, 'Female', 'BSIT - 1-C', 1, 'active', 'BSIT', 'C'),
(623, '16-10278', 'Magayam, Josiah Ira Dauz', '16-10278', 1, 'Josiah Ira', 'Dauz', 'Magayam', NULL, 'Male', 'BSIT - 3-A', 3, 'active', 'BSIT', 'A'),
(624, '24-112014', 'Magdalas, Marian Altayo', '24-112014', 1, 'Marian', 'Altayo', 'Magdalas', NULL, 'Female', 'BSIT - 2-A', 2, 'active', 'BSIT', 'A'),
(625, '25-115994', 'Magmuyao, Raiza Jay Gamata', '25-115994', 1, 'Raiza Jay', 'Gamata', 'Magmuyao', NULL, 'Female', 'BSIT - 1-B', 1, 'active', 'BSIT', 'B'),
(626, '22-10343', 'Magno, Clarence Tabin', '22-10343', 1, 'Clarence', 'Tabin', 'Magno', NULL, 'Male', 'BSIT - 4-A', 4, 'active', 'BSIT', 'A'),
(627, '25-115791', 'Maguigad, Rikki Turo', '25-115791', 1, 'Rikki', 'Turo', 'Maguigad', NULL, 'Male', 'BSIT - 1-B', 1, 'active', 'BSIT', 'B'),
(628, '25-115493', 'Magwin, Garry Sama-on Jr', '25-115493', 1, 'Garry', 'Sama-on', 'Magwin', 'Jr', 'Male', 'BSIT - 1-A', 1, 'active', 'BSIT', 'A'),
(629, '25-117095', 'Makiling, Nathaniel Tumamao.', '25-117095', 1, 'Nathaniel', 'Tumamao.', 'Makiling', NULL, 'Male', 'BSIT - 2-B', 2, 'active', 'BSIT', 'B'),
(630, '24-113057', 'Malaggay, Denjumark Duyan', '24-113057', 1, 'Denjumark', 'Duyan', 'Malaggay', NULL, 'Male', 'BSIT - 1-C', 1, 'active', 'BSIT', 'C'),
(631, '21-11054', 'Malana, Mervie Nicolas', '21-11054', 1, 'Mervie', 'Nicolas', 'Malana', NULL, 'Female', 'BSIT - 4-B', 4, 'active', 'BSIT', 'B'),
(632, '23-110191', 'Maling, Sharon Tumbali', '23-110191', 1, 'Sharon', 'Tumbali', 'Maling', NULL, 'Female', 'BSIT - 2-A', 2, 'active', 'BSIT', 'A'),
(633, '25-116603', 'Mallongga, Shaidee Balocnit', '25-116603', 1, 'Shaidee', 'Balocnit', 'Mallongga', NULL, 'Female', 'BSIT - 1-B', 1, 'active', 'BSIT', 'B'),
(634, '25-115364', 'Malnawa, Aldritch Batalao', '25-115364', 1, 'Aldritch', 'Batalao', 'Malnawa', NULL, 'Male', 'BSIT - 1-A', 1, 'active', 'BSIT', 'A'),
(635, '24-111922', 'Mamicao, Carl Banggawan', '24-111922', 1, 'Carl', 'Banggawan', 'Mamicao', NULL, 'Male', 'BSIT - 2-A', 2, 'active', 'BSIT', 'A'),
(636, '25-115952', 'Mana-ing, Imee Dona-al', '25-115952', 1, 'Imee', 'Dona-al', 'Mana-ing', NULL, 'Female', 'BSIT - 1-B', 1, 'active', 'BSIT', 'B'),
(637, '22-10161', 'Manaltag, Clarence Ladyong', '22-10161', 1, 'Clarence', 'Ladyong', 'Manaltag', NULL, 'Male', 'BSIT - 3-A', 3, 'active', 'BSIT', 'A'),
(638, '23-110913', 'Manangan, Nijael Van Jael', '23-110913', 1, 'Nijael', 'Van', 'Manangan', 'Jael', 'Male', 'BSIT - 2-A', 2, 'active', 'BSIT', 'A'),
(639, '23-110183', 'Mariano, Heiden Riech Dumalsin', '23-110183', 1, 'Heiden Riech', 'Dumalsin', 'Mariano', NULL, 'Male', 'BSIT - 3-B', 3, 'active', 'BSIT', 'B'),
(640, '20-00954', 'Marzan, Bryan Duggoy', '20-00954', 1, 'Bryan', 'Duggoy', 'Marzan', NULL, 'Male', 'BSIT - 2-A', 2, 'active', 'BSIT', 'A'),
(641, '21-11933', 'Marzan, Jeronimo Bangan', '21-11933', 1, 'Jeronimo', 'Bangan', 'Marzan', NULL, 'Male', 'BSIT - 4-A', 4, 'active', 'BSIT', 'A'),
(642, '25-116899', 'Massagan, Jundy Cusipag', '25-116899', 1, 'Jundy', 'Cusipag', 'Massagan', NULL, 'Male', 'BSIT - 1-C', 1, 'active', 'BSIT', 'C'),
(643, '21-11244', 'Masubay, Francis Carl Moldero', '21-11244', 1, 'Francis Carl', 'Moldero', 'Masubay', NULL, 'Male', 'BSIT - 4-A', 4, 'active', 'BSIT', 'A'),
(644, '20-01145', 'Matnao, Junia Ban-os', '20-01145', 1, 'Junia', 'Ban-os', 'Matnao', NULL, 'Female', 'BSIT - 4-A', 4, 'active', 'BSIT', 'A'),
(645, '19-10662', 'Mayor, Romelchito Dacio', '19-10662', 1, 'Romelchito', 'Dacio', 'Mayor', NULL, 'Male', 'BSIT - 4-B', 4, 'active', 'BSIT', 'B'),
(646, '24-112737', 'Mendoza, Jezziebel Agpawan', '24-112737', 1, 'Jezziebel', 'Agpawan', 'Mendoza', NULL, 'Female', 'BSIT - 2-B', 2, 'active', 'BSIT', 'B'),
(647, '24-113055', 'Mendoza, Mark Angelo Sarol', '24-113055', 1, 'Mark Angelo', 'Sarol', 'Mendoza', NULL, 'Male', 'BSIT - 1-C', 1, 'active', 'BSIT', 'C'),
(648, '07-08059', 'Mendoza, Ordilyn Ganggangan', '07-08059', 1, 'Ordilyn', 'Ganggangan', 'Mendoza', NULL, 'Female', 'BSIT - 3-A', 3, 'active', 'BSIT', 'A'),
(649, '23-13728', 'Minor, Aldwin Aguilar', '23-13728', 1, 'Aldwin', 'Aguilar', 'Minor', NULL, 'Male', 'BSIT - 3-A', 3, 'active', 'BSIT', 'A'),
(650, '25-117107', 'Molano, Kimberly Leones', '25-117107', 1, 'Kimberly', 'Leones', 'Molano', NULL, 'Female', 'BSIT - 1-C', 1, 'active', 'BSIT', 'C'),
(651, '24-111886', 'Morales, Bianca Pearl Massagan', '24-111886', 1, 'Bianca Pearl', 'Massagan', 'Morales', NULL, 'Female', 'BSIT - 2-A', 2, 'active', 'BSIT', 'A'),
(652, '23-110170', 'Mundo, Krisha-mae Lumboy', '23-110170', 1, 'Krisha-mae', 'Lumboy', 'Mundo', NULL, 'Female', 'BSIT - 3-A', 3, 'active', 'BSIT', 'A'),
(653, '25-116638', 'Nacotta, Aldrin Log-an', '25-116638', 1, 'Aldrin', 'Log-an', 'Nacotta', NULL, 'Male', 'BSIT - 1-A', 1, 'active', 'BSIT', 'A'),
(654, '24-112479', 'Nazaro, Rico James Javier', '24-112479', 1, 'Rico James', 'Javier', 'Nazaro', NULL, 'Male', 'BSIT - 1-C', 1, 'active', 'BSIT', 'C'),
(655, '24-112469', 'Nepagtic, Mark Angelo Dupli', '24-112469', 1, 'Mark Angelo', 'Dupli', 'Nepagtic', NULL, 'Male', 'BSIT - 1-C', 1, 'active', 'BSIT', 'C'),
(656, '21-11828', 'Ngawoy, Jesielyn Magdalas', '21-11828', 1, 'Jesielyn', 'Magdalas', 'Ngawoy', NULL, 'Female', 'BSIT - 2-A', 2, 'active', 'BSIT', 'A'),
(657, '25-116817', 'Obena, Jonel Quilang', '25-116817', 1, 'Jonel', 'Quilang', 'Obena', NULL, 'Male', 'BSIT - 1-B', 1, 'active', 'BSIT', 'B'),
(658, '23-19458', 'Oclit, Jaycel Wandagan', '23-19458', 1, 'Jaycel', 'Wandagan', 'Oclit', NULL, 'Female', 'BSIT - 3-A', 3, 'active', 'BSIT', 'A'),
(659, '23-211263', 'Oggang, Karly Roh Cortrez', '23-211263', 1, 'Karly Roh', 'Cortrez', 'Oggang', NULL, 'Male', 'BSIT - 2-B', 2, 'active', 'BSIT', 'B'),
(660, '20-01063', 'Ollipas, Jedea Agusing', '20-01063', 1, 'Jedea', 'Agusing', 'Ollipas', NULL, 'Female', 'BSIT - 4-B', 4, 'active', 'BSIT', 'B'),
(661, '24-113383', 'Oplay, Alken Manondoy', '24-113383', 1, 'Alken', 'Manondoy', 'Oplay', NULL, 'Male', 'BSIT - 2-A', 2, 'active', 'BSIT', 'A'),
(662, '23-110236', 'Ottao, Perseus Jeshua Sulca', '23-110236', 1, 'Perseus Jeshua', 'Sulca', 'Ottao', NULL, 'Male', 'BSIT - 3-B', 3, 'active', 'BSIT', 'B'),
(663, '22-11594', 'Oyando, Carlos John Ayabas', '22-11594', 1, 'Carlos John', 'Ayabas', 'Oyando', NULL, 'Male', 'BSIT - 3-B', 3, 'active', 'BSIT', 'B'),
(664, '25-115367', 'Pa-in, Charlz Melvin Balao-od', '25-115367', 1, 'Charlz Melvin', 'Balao-od', 'Pa-in', NULL, 'Male', 'BSIT - 1-C', 1, 'active', 'BSIT', 'C'),
(665, '25-115469', 'Pa-it, Khelly-ann Cawis', '25-115469', 1, 'Khelly-ann', 'Cawis', 'Pa-it', NULL, 'Female', 'BSIT - 1-C', 1, 'active', 'BSIT', 'C'),
(666, '25-115002', 'Pacad, Jemille Valerie Dalingay', '25-115002', 1, 'Jemille Valerie', 'Dalingay', 'Pacad', NULL, 'Female', 'BSIT - 1-A', 1, 'active', 'BSIT', 'A'),
(667, '20-00389', 'Padayao, Angeline Balintaculo', '20-00389', 1, 'Angeline', 'Balintaculo', 'Padayao', NULL, 'Female', 'BSIT - 4-A', 4, 'active', 'BSIT', 'A'),
(668, '23-110174', 'Padilla, Rainy Von Bayado', '23-110174', 1, 'Rainy Von', 'Bayado', 'Padilla', NULL, 'Male', 'BSIT - 3-A', 3, 'active', 'BSIT', 'A'),
(669, '23-19473', 'Padua, Knight Shield Andres', '23-19473', 1, 'Knight Shield', 'Andres', 'Padua', NULL, 'Male', 'BSIT - 3-B', 3, 'active', 'BSIT', 'B'),
(670, '24-112015', 'Pagalilauan, Niña Rashinie Aguban', '24-112015', 1, 'Niña Rashinie', 'Aguban', 'Pagalilauan', NULL, 'Female', 'BSIT - 2-A', 2, 'active', 'BSIT', 'A'),
(671, '25-115003', 'Pagtud, Jessica Caswang', '25-115003', 1, 'Jessica', 'Caswang', 'Pagtud', NULL, 'Female', 'BSIT - 1-B', 1, 'active', 'BSIT', 'B'),
(672, '25-116730', 'Palangdao, Jaylord Aduca', '25-116730', 1, 'Jaylord', 'Aduca', 'Palangdao', NULL, 'Male', 'BSIT - 1-B', 1, 'active', 'BSIT', 'B'),
(673, '25-115538', 'Palangeo, Rio Ngayom', '25-115538', 1, 'Rio', 'Ngayom', 'Palangeo', NULL, 'Male', 'BSIT - 1-A', 1, 'active', 'BSIT', 'A'),
(674, '21-11107', 'Palayad, Anton Gayawet', '21-11107', 1, 'Anton', 'Gayawet', 'Palayad', NULL, 'Male', 'BSIT - 4-A', 4, 'active', 'BSIT', 'A'),
(675, '25-115630', 'Pallogan, John Tucnang', '25-115630', 1, 'John', 'Tucnang', 'Pallogan', NULL, 'Male', 'BSIT - 1-A', 1, 'active', 'BSIT', 'A'),
(676, '21-10834', 'Palos, Bonrod Zildian Lumines', '21-10834', 1, 'Bonrod Zildian', 'Lumines', 'Palos', NULL, 'Male', 'BSIT - 3-B', 3, 'active', 'BSIT', 'B'),
(677, '23-19435', 'Paltao, Spencer Amboni', '23-19435', 1, 'Spencer', 'Amboni', 'Paltao', NULL, 'Male', 'BSIT - 3-B', 3, 'active', 'BSIT', 'B'),
(678, '25-115633', 'Pang-ay, Paul Jeferson Pao-iton', '25-115633', 1, 'Paul Jeferson', 'Pao-iton', 'Pang-ay', NULL, 'Male', 'BSIT - 1-A', 1, 'active', 'BSIT', 'A'),
(679, '24-214128', 'Pangosban, Rynne John Awan', '24-214128', 1, 'Rynne John', 'Awan', 'Pangosban', NULL, 'Male', 'BSIT - 2-A', 2, 'active', 'BSIT', 'A'),
(680, '24-111805', 'Pao-iton, John Frey Agon-e', '24-111805', 1, 'John Frey', 'Agon-e', 'Pao-iton', NULL, 'Male', 'BSIT - 1-C', 1, 'active', 'BSIT', 'C'),
(681, '20-00739', 'Par-ong, Joey Glen Cosme', '20-00739', 1, 'Joey Glen', 'Cosme', 'Par-ong', NULL, 'Male', 'BSIT - 4-A', 4, 'active', 'BSIT', 'A'),
(682, '23-110815', 'Parizal, Angel Ninalga', '23-110815', 1, 'Angel', 'Ninalga', 'Parizal', NULL, 'Male', 'BSIT - 2-A', 2, 'active', 'BSIT', 'A'),
(683, '24-112482', 'Pasudag, Julius Sindanum', '24-112482', 1, 'Julius', 'Sindanum', 'Pasudag', NULL, 'Male', 'BSIT - 1-C', 1, 'active', 'BSIT', 'C'),
(684, '24-113687', 'Pattang, Edmund Apil', '24-113687', 1, 'Edmund', 'Apil', 'Pattang', NULL, 'Male', 'BSIT - 2-B', 2, 'active', 'BSIT', 'B'),
(685, '24-111887', 'Patungao, Brandon Narciza Jr', '24-111887', 1, 'Brandon', 'Narciza', 'Patungao', 'Jr', 'Male', 'BSIT - 2-B', 2, 'active', 'BSIT', 'B'),
(686, '14-11646', 'Pawac, Allen Jhon Baglan', '14-11646', 1, 'Allen Jhon', 'Baglan', 'Pawac', NULL, 'Male', 'BSIT - 4-A', 4, 'active', 'BSIT', 'A'),
(687, '25-116644', 'Pedoy, Renzo Cortel', '25-116644', 1, 'Renzo', 'Cortel', 'Pedoy', NULL, 'Male', 'BSIT - 1-A', 1, 'active', 'BSIT', 'A'),
(688, '15-11520', 'Pingol, Rhona May Gardoque', '15-11520', 1, 'Rhona May', 'Gardoque', 'Pingol', NULL, 'Female', 'BSIT - 4-A', 4, 'active', 'BSIT', 'A'),
(689, '22-10764', 'Pocpoc, Marciano Wadwad', '22-10764', 1, 'Marciano', 'Wadwad', 'Pocpoc', NULL, 'Male', 'BSIT - 4-B', 4, 'active', 'BSIT', 'B'),
(690, '20-01032', 'Pooten, John Paul Tengay', '20-01032', 1, 'John Paul', 'Tengay', 'Pooten', NULL, 'Male', 'BSIT - 3-B', 3, 'active', 'BSIT', 'B'),
(691, '22-10252', 'Pugal, Mark Alvin Malawis', '22-10252', 1, 'Mark Alvin', 'Malawis', 'Pugal', NULL, 'Male', 'BSIT - 4-A', 4, 'active', 'BSIT', 'A'),
(692, '25-115001', 'Pugao, Jan-jan Dalire', '25-115001', 1, 'Jan-jan', 'Dalire', 'Pugao', NULL, 'Male', 'BSIT - 1-B', 1, 'active', 'BSIT', 'B'),
(693, '22-10657', 'Purisima, Arjon Favia', '22-10657', 1, 'Arjon', 'Favia', 'Purisima', NULL, 'Male', 'BSIT - 4-A', 4, 'active', 'BSIT', 'A'),
(694, '24-214181', 'Puya-ao, Aubry Ottog', '24-214181', 1, 'Aubry', 'Ottog', 'Puya-ao', NULL, 'Female', 'BSIT - 2-B', 2, 'active', 'BSIT', 'B'),
(695, '20-20016', 'Puyao, Shanedy Manallog', '20-20016', 1, 'Shanedy', 'Manallog', 'Puyao', NULL, 'Female', 'BSIT - 4-B', 4, 'active', 'BSIT', 'B'),
(696, '22-10417', 'Quinagoran, Jay Mark Casirayan', '22-10417', 1, 'Jay Mark', 'Casirayan', 'Quinagoran', NULL, 'Male', 'BSIT - 4-A', 4, 'active', 'BSIT', 'A'),
(697, '19-10848', 'Rabanzo, Mike Christian Cos-agon', '19-10848', 1, 'Mike Christian', 'Cos-agon', 'Rabanzo', NULL, 'Male', 'BSIT - 4-A', 4, 'active', 'BSIT', 'A'),
(698, '24-113897', 'Ramos, Clyde Lysander Lapangan', '24-113897', 1, 'Clyde Lysander', 'Lapangan', 'Ramos', NULL, 'Male', 'BSIT - 2-B', 2, 'active', 'BSIT', 'B'),
(699, '22-10088', 'Ramos, James Angelo Leones', '22-10088', 1, 'James Angelo', 'Leones', 'Ramos', NULL, 'Male', 'BSIT - 4-A', 4, 'active', 'BSIT', 'A'),
(700, '22-10412', 'Ramos, Kyier Roaquin', '22-10412', 1, 'Kyier', 'Roaquin', 'Ramos', NULL, 'Male', 'BSIT - 4-A', 4, 'active', 'BSIT', 'A'),
(701, '25-117032', 'Ramos, Michael John Melad', '25-117032', 1, 'Michael John', 'Melad', 'Ramos', NULL, 'Male', 'BSIT - 1-C', 1, 'active', 'BSIT', 'C'),
(702, '22-11733', 'Reyes, David Jude Basadre', '22-11733', 1, 'David Jude', 'Basadre', 'Reyes', NULL, 'Male', 'BSIT - 4-B', 4, 'active', 'BSIT', 'B'),
(703, '25-115000', 'Ridad, Jay Ann Mabborang', '25-115000', 1, 'Jay Ann', 'Mabborang', 'Ridad', NULL, 'Female', 'BSIT - 1-A', 1, 'active', 'BSIT', 'A'),
(704, '25-116702', 'Roy, Frankie Dayagon Jr', '25-116702', 1, 'Frankie', 'Dayagon', 'Roy', 'Jr', 'Male', 'BSIT - 1-B', 1, 'active', 'BSIT', 'B'),
(705, '23-19800', 'Rueco, Mevelle Ann Diocares', '23-19800', 1, 'Mevelle Ann', 'Diocares', 'Rueco', NULL, 'Female', 'BSIT - 2-B', 2, 'active', 'BSIT', 'B'),
(706, '24-111888', 'Saggob, Mhyca De Quiroz', '24-111888', 1, 'Mhyca', 'De Quiroz', 'Saggob', NULL, 'Female', 'BSIT - 2-B', 2, 'active', 'BSIT', 'B'),
(707, '22-10839', 'Sagun, Ralph Jake Paguigian', '22-10839', 1, 'Ralph Jake', 'Paguigian', 'Sagun', NULL, 'Male', 'BSIT - 4-B', 4, 'active', 'BSIT', 'B'),
(708, '24-113491', 'Salbang, Grill Tongay', '24-113491', 1, 'Grill', 'Tongay', 'Salbang', NULL, 'Female', 'BSIT - 2-B', 2, 'active', 'BSIT', 'B'),
(709, '25-115365', 'Salibad, Brix Ivan Ramos', '25-115365', 1, 'Brix Ivan', 'Ramos', 'Salibad', NULL, 'Male', 'BSIT - 1-A', 1, 'active', 'BSIT', 'A'),
(710, '20-00312', 'Salida, John Paul', '20-00312', 1, 'John Paul', NULL, 'Salida', NULL, 'Male', 'BSIT - 4-B', 4, 'active', 'BSIT', 'B'),
(711, '22-10216', 'Salingbay, Nerienale Ngalot', '22-10216', 1, 'Nerienale', 'Ngalot', 'Salingbay', NULL, 'Male', 'BSIT - 3-A', 3, 'active', 'BSIT', 'A'),
(712, '24-111932', 'Salvador, Diane Pattung', '24-111932', 1, 'Diane', 'Pattung', 'Salvador', NULL, 'Female', 'BSIT - 2-B', 2, 'active', 'BSIT', 'B'),
(713, '24-113685', 'Salvador, Harry Sia', '24-113685', 1, 'Harry', 'Sia', 'Salvador', NULL, 'Male', 'BSIT - 2-B', 2, 'active', 'BSIT', 'B'),
(714, '25-116912', 'Sangdaan, Shena P.', '25-116912', 1, 'Shena', 'P.', 'Sangdaan', NULL, 'Female', 'BSIT - 1-B', 1, 'active', 'BSIT', 'B'),
(715, '20-01815', 'Sanidad, Hazel Kate Dumagay', '20-01815', 1, 'Hazel Kate', 'Dumagay', 'Sanidad', NULL, 'Female', 'BSIT - 3-B', 3, 'active', 'BSIT', 'B'),
(716, '19-11158', 'Sanidad, Khaye-ann Dumagay', '19-11158', 1, 'Khaye-ann', 'Dumagay', 'Sanidad', NULL, 'Female', 'BSIT - 4-A', 4, 'active', 'BSIT', 'A'),
(717, '25-116633', 'Santiago, Ian Jade Badong', '25-116633', 1, 'Ian Jade', 'Badong', 'Santiago', NULL, 'Male', 'BSIT - 1-A', 1, 'active', 'BSIT', 'A'),
(718, '20-00304', 'Sarol, Mark Windel Regacho', '20-00304', 1, 'Mark Windel', 'Regacho', 'Sarol', NULL, 'Male', 'BSIT - 4-A', 4, 'active', 'BSIT', 'A'),
(719, '25-115991', 'Sawattang, Jsca Ollipas', '25-115991', 1, 'Jsca', 'Ollipas', 'Sawattang', NULL, 'Female', 'BSIT - 1-B', 1, 'active', 'BSIT', 'B'),
(720, '21-11102', 'Serafica, Aivie Gaddao', '21-11102', 1, 'Aivie', 'Gaddao', 'Serafica', NULL, 'Female', 'BSIT - 4-A', 4, 'active', 'BSIT', 'A'),
(721, '23-19275', 'Sibayan, Shaina May Lingbawan', '23-19275', 1, 'Shaina May', 'Lingbawan', 'Sibayan', NULL, 'Female', 'BSIT - 1-C', 1, 'active', 'BSIT', 'C'),
(722, '20-00980', 'Silva, Florich Joy Cortez', '20-00980', 1, 'Florich Joy', 'Cortez', 'Silva', NULL, 'Female', 'BSIT - 3-A', 3, 'active', 'BSIT', 'A'),
(723, '21-11085', 'Simangan, Daine Grace C', '21-11085', 1, 'Daine Grace', 'C', 'Simangan', NULL, 'Female', 'BSIT - 4-A', 4, 'active', 'BSIT', 'A'),
(724, '23-19851', 'Solang, Charlie Domingo', '23-19851', 1, 'Charlie', 'Domingo', 'Solang', NULL, 'Male', 'BSIT - 1-A', 1, 'active', 'BSIT', 'A'),
(725, '25-115760', 'Solinon, Ednorie Manaltag', '25-115760', 1, 'Ednorie', 'Manaltag', 'Solinon', NULL, 'Female', 'BSIT - 1-B', 1, 'active', 'BSIT', 'B'),
(726, '24-113490', 'Sotto, Junard Pay-o', '24-113490', 1, 'Junard', 'Pay-o', 'Sotto', NULL, 'Male', 'BSIT - 1-B', 1, 'active', 'BSIT', 'B'),
(727, '24-113676', 'Suwan, Zariane Joy Paut Crystal', '24-113676', 1, 'Zariane Joy', 'Paut', 'Suwan', 'Crystal', 'Female', 'BSIT - 2-B', 2, 'active', 'BSIT', 'B'),
(728, '24-111649', 'Tabbagon, Aljhun Salida', '24-111649', 1, 'Aljhun', 'Salida', 'Tabbagon', NULL, 'Male', 'BSIT - 1-A', 1, 'active', 'BSIT', 'A'),
(729, '24-S12018', 'Taguibao, Jyvon-rey Mugal', '24-S12018', 1, 'Jyvon-rey', 'Mugal', 'Taguibao', NULL, 'Male', 'BSIT - 2-A', 2, 'active', 'BSIT', 'A'),
(730, '23-110706', 'Talingdan, Jovelyn Cabinta', '23-110706', 1, 'Jovelyn', 'Cabinta', 'Talingdan', NULL, 'Female', 'BSIT - 3-B', 3, 'active', 'BSIT', 'B'),
(731, '23-19531', 'Taluyan, Frederickjr Moldero', '23-19531', 1, 'Frederickjr', 'Moldero', 'Taluyan', NULL, 'Male', 'BSIT - 3-B', 3, 'active', 'BSIT', 'B'),
(732, '25-116043', 'Tamayao, Xandrix Kier Iyadan', '25-116043', 1, 'Xandrix Kier', 'Iyadan', 'Tamayao', NULL, 'Male', 'BSIT - 1-A', 1, 'active', 'BSIT', 'A'),
(733, '25-117077', 'Tangdol, Ian Jay Nugal', '25-117077', 1, 'Ian Jay', 'Nugal', 'Tangdol', NULL, 'Male', 'BSIT - 1-C', 1, 'active', 'BSIT', 'C'),
(734, '24-113867', 'Tangguiyac, Rex Taluyan', '24-113867', 1, 'Rex', 'Taluyan', 'Tangguiyac', NULL, 'Male', 'BSIT - 2-B', 2, 'active', 'BSIT', 'B'),
(735, '24-113492', 'Tawagon, Suzette Angalao', '24-113492', 1, 'Suzette', 'Angalao', 'Tawagon', NULL, 'Female', 'BSIT - 2-B', 2, 'active', 'BSIT', 'B'),
(736, '23-211246', 'Taya-an, Aaron Vince Pannogan', '23-211246', 1, 'Aaron Vince', 'Pannogan', 'Taya-an', NULL, 'Male', 'BSIT - 1-C', 1, 'active', 'BSIT', 'C'),
(737, '22-10133', 'Tayab, Joselyn Anggowos', '22-10133', 1, 'Joselyn', 'Anggowos', 'Tayab', NULL, 'Female', 'BSIT - 4-A', 4, 'active', 'BSIT', 'A'),
(738, '15-30011', 'Tejano, Randolf Lopez', '15-30011', 1, 'Randolf', 'Lopez', 'Tejano', NULL, 'Male', 'BSIT - 1-C', 1, 'active', 'BSIT', 'C'),
(739, '24-113856', 'Teodorico, Kim Dawayen', '24-113856', 1, 'Kim', 'Dawayen', 'Teodorico', NULL, 'Female', 'BSIT - 2-B', 2, 'active', 'BSIT', 'B'),
(740, '24-113896', 'Toc-oc, Senya Cawor', '24-113896', 1, 'Senya', 'Cawor', 'Toc-oc', NULL, 'Female', 'BSIT - 2-B', 2, 'active', 'BSIT', 'B'),
(741, '23-19441', 'Tockiapao, Kenneth Christian Masaway', '23-19441', 1, 'Kenneth Christian', 'Masaway', 'Tockiapao', NULL, 'Male', 'BSIT - 3-B', 3, 'active', 'BSIT', 'B'),
(742, '22-10564', 'Topi, Algeron Tongdo', '22-10564', 1, 'Algeron', 'Tongdo', 'Topi', NULL, 'Male', 'BSIT - 4-B', 4, 'active', 'BSIT', 'B'),
(743, '23-19455', 'Torres, Jowayne Bewog', '23-19455', 1, 'Jowayne', 'Bewog', 'Torres', NULL, 'Male', 'BSIT - 3-B', 3, 'active', 'BSIT', 'B'),
(744, '25-114999', 'Tovera, Isidreign Rivera', '25-114999', 1, 'Isidreign', 'Rivera', 'Tovera', NULL, 'Female', 'BSIT - 1-A', 1, 'active', 'BSIT', 'A');
INSERT INTO `students` (`id`, `student_id`, `name`, `password`, `college_id`, `first_name`, `middle_name`, `last_name`, `ext`, `gender`, `course_year_section`, `year_level`, `status`, `course`, `section`) VALUES
(745, '25-115482', 'Tresvalles, Zoren Bolingon', '25-115482', 1, 'Zoren', 'Bolingon', 'Tresvalles', NULL, 'Male', 'BSIT - 1-C', 1, 'active', 'BSIT', 'C'),
(746, '24-112019', 'Tuclab, Rahamier Colayot', '24-112019', 1, 'Rahamier', 'Colayot', 'Tuclab', NULL, 'Male', 'BSIT - 2-A', 2, 'active', 'BSIT', 'A'),
(747, '22-10337', 'Tuliao, Dexter Deguzman', '22-10337', 1, 'Dexter', 'Deguzman', 'Tuliao', NULL, 'Male', 'BSIT - 4-A', 4, 'active', 'BSIT', 'A'),
(748, '25-116948', 'Tumbag, Marvin Bayudang', '25-116948', 1, 'Marvin', 'Bayudang', 'Tumbag', NULL, 'Male', 'BSIT - 1-C', 1, 'active', 'BSIT', 'C'),
(749, '24-113684', 'Ulod, Patrick Sib-at Patrick', '24-113684', 1, 'Patrick', 'Sib-at', 'Ulod', 'Patrick', 'Male', 'BSIT - 2-A', 2, 'active', 'BSIT', 'A'),
(750, '21-11940', 'Valdez, Jake Julakit', '21-11940', 1, 'Jake', 'Julakit', 'Valdez', NULL, 'Male', 'BSIT - 4-B', 4, 'active', 'BSIT', 'B'),
(751, '23-10077', 'Valencia, Jonathan Lorenzo', '23-10077', 1, 'Jonathan', 'Lorenzo', 'Valencia', NULL, 'Male', 'BSIT - 3-B', 3, 'active', 'BSIT', 'B'),
(752, '25-115377', 'Velasquez, Regine Gayagay', '25-115377', 1, 'Regine', 'Gayagay', 'Velasquez', NULL, 'Female', 'BSIT - 1-B', 1, 'active', 'BSIT', 'B'),
(753, '21-11196', 'Ventura, Froilan Remegio', '21-11196', 1, 'Froilan', 'Remegio', 'Ventura', NULL, 'Male', 'BSIT - 4-A', 4, 'active', 'BSIT', 'A'),
(754, '21-11096', 'Villanueva, Rei Jethro Tenay', '21-11096', 1, 'Rei Jethro', 'Tenay', 'Villanueva', NULL, 'Male', 'BSIT - 4-A', 4, 'active', 'BSIT', 'A'),
(755, '22-10356', 'Viloria, Lorie Ann Padilla', '22-10356', 1, 'Lorie Ann', 'Padilla', 'Viloria', NULL, 'Female', 'BSIT - 4-A', 4, 'active', 'BSIT', 'A'),
(756, '21-11123', 'Viteño, Nichole Shyne Sanidad', '21-11123', 1, 'Nichole Shyne', 'Sanidad', 'Viteño', NULL, 'Female', 'BSIT - 3-A', 3, 'active', 'BSIT', 'A'),
(757, '25-115148', 'Wagason, James Batang-i', '25-115148', 1, 'James', 'Batang-i', 'Wagason', NULL, 'Male', 'BSIT - 1-C', 1, 'active', 'BSIT', 'C'),
(758, '25-116668', 'Wailan, James Marc Espinosa', '25-116668', 1, 'James Marc', 'Espinosa', 'Wailan', NULL, 'Male', 'BSIT - 1-C', 1, 'active', 'BSIT', 'C'),
(759, '25-116913', 'Wanawan, Ilyne Joy Antonio', '25-116913', 1, 'Ilyne Joy', 'Antonio', 'Wanawan', NULL, 'Female', 'BSIT - 1-B', 1, 'active', 'BSIT', 'B'),
(760, '24-111904', 'Wanawan, Zemma Kane Malichan', '24-111904', 1, 'Zemma Kane', 'Malichan', 'Wanawan', NULL, 'Female', 'BSIT - 2-A', 2, 'active', 'BSIT', 'A'),
(761, '24-113873', 'Wassig, Rico Dangiwan', '24-113873', 1, 'Rico', 'Dangiwan', 'Wassig', NULL, 'Male', 'BSIT - 3-B', 3, 'active', 'BSIT', 'B'),
(762, '23-19499', 'Wayaway, John Lloyd Daodaoen', '23-19499', 1, 'John Lloyd', 'Daodaoen', 'Wayaway', NULL, 'Male', 'BSIT - 2-B', 2, 'active', 'BSIT', 'B'),
(763, '22-11815', 'Wayyag, Vina Guimba', '22-11815', 1, 'Vina', 'Guimba', 'Wayyag', NULL, 'Female', 'BSIT - 1-C', 1, 'active', 'BSIT', 'C'),
(764, '22-10277', 'Yacapin, Aeron Berto', '22-10277', 1, 'Aeron', 'Berto', 'Yacapin', NULL, 'Male', 'BSIT - 4-A', 4, 'active', 'BSIT', 'A'),
(765, '25-115404', 'Balanon, Marvilyn Alacquiao', '25-115404', 1, 'Marvilyn', 'Alacquiao', 'Balanon', NULL, 'Female', 'BSIT - 1-A', 1, 'active', 'BSIT', 'A'),
(766, '23-110078', 'Balansi, Aiza Coom', '23-110078', 1, 'Aiza', 'Coom', 'Balansi', NULL, 'Female', 'BSIT - 3-A', 3, 'active', 'BSIT', 'A'),
(767, '25-116734', 'Balbi, Jericho Tulugan', '25-116734', 1, 'Jericho', 'Tulugan', 'Balbi', NULL, 'Male', 'BSIT - 1-B', 1, 'active', 'BSIT', 'B'),
(768, '24-113818', 'Balbuena, Jovi Martinez', '24-113818', 1, 'Jovi', 'Martinez', 'Balbuena', NULL, 'Male', 'BSIT - 3-B', 3, 'active', 'BSIT', 'B'),
(769, '23-19854', 'Baliaga, Naya Camille Dawiguey', '23-19854', 1, 'Naya Camille', 'Dawiguey', 'Baliaga', NULL, 'Female', 'BSIT - 3-A', 3, 'active', 'BSIT', 'A'),
(770, '24-111891', 'Balino, Eirohnjan Anciado', '24-111891', 1, 'Eirohnjan', 'Anciado', 'Balino', NULL, 'Male', 'BSIT - 2-A', 2, 'active', 'BSIT', 'A'),
(771, '25-117106', 'Balisong, Mhyra Kate Na-oy', '25-117106', 1, 'Mhyra Kate', 'Na-oy', 'Balisong', NULL, 'Female', 'BSIT - 2-B', 2, 'active', 'BSIT', 'B'),
(772, '23-19374', 'Balitnang, Gean Baswit', '23-19374', 1, 'Gean', 'Baswit', 'Balitnang', NULL, 'Female', 'BSIT - 3-A', 3, 'active', 'BSIT', 'A'),
(773, '25-115800', 'Baliwag, Camilo Logao', '25-115800', 1, 'Camilo', 'Logao', 'Baliwag', NULL, 'Male', 'BSIT - 1-A', 1, 'active', 'BSIT', 'A'),
(774, '21-11346', 'Baluga, Farrah Lyn Cammagay', '21-11346', 1, 'Farrah Lyn', 'Cammagay', 'Baluga', NULL, 'Female', 'BSIT - 4-A', 4, 'active', 'BSIT', 'A'),
(775, '24-214210', 'Baluga, Jea Toling', '24-214210', 1, 'Jea', 'Toling', 'Baluga', NULL, 'Female', 'BSIT - 2-A', 2, 'active', 'BSIT', 'A'),
(776, '22-10788', 'Banag, David Allab', '22-10788', 1, 'David', 'Allab', 'Banag', NULL, 'Male', 'BSIT - 4-B', 4, 'active', 'BSIT', 'B'),
(777, '25-116494', 'Banasan, Benjie Andomang', '25-116494', 1, 'Benjie', 'Andomang', 'Banasan', NULL, 'Male', 'BSIT - 1-A', 1, 'active', 'BSIT', 'A'),
(778, '22-10398', 'Banawag, Jeremy Aranca', '22-10398', 1, 'Jeremy', 'Aranca', 'Banawag', NULL, 'Male', 'BSIT - 4-A', 4, 'active', 'BSIT', 'A'),
(779, '19-10510', 'Banggawan, Renalyn Gaayon', '19-10510', 1, 'Renalyn', 'Gaayon', 'Banggawan', NULL, 'Female', 'BSIT - 4-B', 4, 'active', 'BSIT', 'B'),
(780, '25-117134', 'Banggollay, Reian Carl Addawe', '25-117134', 1, 'Reian Carl', 'Addawe', 'Banggollay', NULL, 'Male', 'BSIT - 2-B', 2, 'active', 'BSIT', 'B'),
(781, '25-114997', 'Banglag, Churchill Angga-o', '25-114997', 1, 'Churchill', 'Angga-o', 'Banglag', NULL, 'Male', 'BSIT - 1-B', 1, 'active', 'BSIT', 'B'),
(782, '25-116844', 'Banglot, Aeron Luk Dalipog', '25-116844', 1, 'Aeron Luk', 'Dalipog', 'Banglot', NULL, 'Male', 'BSIT - 1-B', 1, 'active', 'BSIT', 'B'),
(783, '22-10850', 'Baruzo, Rienard Uyam', '22-10850', 1, 'Rienard', 'Uyam', 'Baruzo', NULL, 'Male', 'BSIT - 4-B', 4, 'active', 'BSIT', 'B'),
(784, '24-112022', 'Basitao, John Alvin Gumaad', '24-112022', 1, 'John Alvin', 'Gumaad', 'Basitao', NULL, 'Male', 'BSIT - 2-A', 2, 'active', 'BSIT', 'A'),
(785, '25-115764', 'Basnic, Vince-erne Atalig', '25-115764', 1, 'Vince-erne', 'Atalig', 'Basnic', NULL, 'Male', 'BSIT - 1-C', 1, 'active', 'BSIT', 'C'),
(786, '21-11926', 'Bassiag, Carl Jian Emil W.', '21-11926', 1, 'Carl Jian Emil', 'W.', 'Bassiag', NULL, 'Male', 'BSIT - 1-C', 1, 'active', 'BSIT', 'C'),
(787, '25-116469', 'Basungit, Shane Michael Galwa', '25-116469', 1, 'Shane Michael', 'Galwa', 'Basungit', NULL, 'Male', 'BSIT - 1-A', 1, 'active', 'BSIT', 'A'),
(788, '24-111902', 'Basuyang, Jamaica Sheena Lagasi', '24-111902', 1, 'Jamaica Sheena', 'Lagasi', 'Basuyang', NULL, 'Female', 'BSIT - 2-A', 2, 'active', 'BSIT', 'A'),
(810, '25-116826', 'Batoon, Rexon Balicao Sr', '25-116826', 1, 'Rexon', 'Balicao', 'Batoon', 'Sr', 'Male', 'BSIT - 1-B', 1, 'active', 'BSIT', 'B'),
(811, '21-11480', 'Bautista, Florentino Piog', '21-11480', 1, 'Florentino', 'Piog', 'Bautista', NULL, 'Male', 'BSIT - 4-A', 4, 'active', 'BSIT', 'A'),
(812, '24-214180', 'Bautista, Josephine Doctor', '24-214180', 1, 'Josephine', 'Doctor', 'Bautista', NULL, 'Female', 'BSIT - 2-A', 2, 'active', 'BSIT', 'A'),
(813, '23-19495', 'Bawing, Jefferson Dacanay', '23-19495', 1, 'Jefferson', 'Dacanay', 'Bawing', NULL, 'Male', 'BSIT - 3-A', 3, 'active', 'BSIT', 'A'),
(814, '23-19400', 'Bayangan, Van Riddick Rebancos', '23-19400', 1, 'Van Riddick', 'Rebancos', 'Bayangan', NULL, 'Male', 'BSIT - 3-A', 3, 'active', 'BSIT', 'A'),
(815, '21-12348', 'Bayongasan, Arkein Sokaw', '21-12348', 1, 'Arkein', 'Sokaw', 'Bayongasan', NULL, 'Male', 'BSIT - 4-B', 4, 'active', 'BSIT', 'B'),
(816, '25-116717', 'Bayubay, Ruthsie Dangiwan', '25-116717', 1, 'Ruthsie', 'Dangiwan', 'Bayubay', NULL, 'Female', 'BSIT - 1-C', 1, 'active', 'BSIT', 'C'),
(817, '21-11829', 'Benaton, Mary Joy Balutoc', '21-11829', 1, 'Mary Joy', 'Balutoc', 'Benaton', NULL, 'Female', 'BSIT - 4-A', 4, 'active', 'BSIT', 'A'),
(818, '19-10223', 'Benganio, Rose Belinda Dela Cruz', '19-10223', 1, 'Rose Belinda', 'Dela Cruz', 'Benganio', NULL, 'Female', 'BSIT - 3-A', 3, 'active', 'BSIT', 'A'),
(819, '23-211243', 'Benitez, Jaydee Licuben', '23-211243', 1, 'Jaydee', 'Licuben', 'Benitez', NULL, 'Male', 'BSIT - 2-B', 2, 'active', 'BSIT', 'B'),
(820, '24-113152', 'Betao, Weldon Domongit', '24-113152', 1, 'Weldon', 'Domongit', 'Betao', NULL, 'Male', 'BSIT - 2-B', 2, 'active', 'BSIT', 'B'),
(821, '25-116964', 'Bilin, Deborah Amiyan', '25-116964', 1, 'Deborah', 'Amiyan', 'Bilin', NULL, 'Female', 'BSIT - 1-C', 1, 'active', 'BSIT', 'C'),
(822, '23-110414', 'Binaraba, Jhon Rey Tuccalay', '23-110414', 1, 'Jhon Rey', 'Tuccalay', 'Binaraba', NULL, 'Male', 'BSIT - 3-B', 3, 'active', 'BSIT', 'B'),
(823, '25-116871', 'Bitanga, Shina Odam', '25-116871', 1, 'Shina', 'Odam', 'Bitanga', NULL, 'Female', 'BSIT - 1-B', 1, 'active', 'BSIT', 'B'),
(824, '24-112021', 'Blante, Justine Dugayon', '24-112021', 1, 'Justine', 'Dugayon', 'Blante', NULL, 'Male', 'BSIT - 2-A', 2, 'active', 'BSIT', 'A'),
(825, '25-116125', 'Boccol, Rexsyl Ambong', '25-116125', 1, 'Rexsyl', 'Ambong', 'Boccol', NULL, 'Male', 'BSIT - 1-A', 1, 'active', 'BSIT', 'A'),
(826, '25-115423', 'Bodoy, Reynalyn Catalino', '25-115423', 1, 'Reynalyn', 'Catalino', 'Bodoy', NULL, 'Female', 'BSIT - 1-A', 1, 'active', 'BSIT', 'A'),
(827, '25-115006', 'Bonagan, Mary Joyce Almeda', '25-115006', 1, 'Mary Joyce', 'Almeda', 'Bonagan', NULL, 'Female', 'BSIT - 1-A', 1, 'active', 'BSIT', 'A'),
(828, '22-11633', 'Bonifacio, Brent Charles Ramos', '22-11633', 1, 'Brent Charles', 'Ramos', 'Bonifacio', NULL, 'Male', 'BSIT - 3-B', 3, 'active', 'BSIT', 'B'),
(829, '23-211239', 'Boog, Van Rutherford Lao-aten', '23-211239', 1, 'Van Rutherford', 'Lao-aten', 'Boog', NULL, 'Male', 'BSIT - 3-A', 3, 'active', 'BSIT', 'A'),
(900, '21-11108', 'Buado, Leonelyn Aposta', '21-11108', 1, 'Leonelyn', 'Aposta', 'Buado', NULL, 'Female', 'BSIT - 4-B', 4, 'active', 'BSIT', 'B'),
(901, '23-19395', 'Bucao, Rodneil Macar', '23-19395', 1, 'Rodneil', 'Macar', 'Bucao', NULL, 'Male', 'BSIT - 3-A', 3, 'active', 'BSIT', 'A'),
(902, '24-113056', 'Bulao, Quenand Liam Hidalgo', '24-113056', 1, 'Quenand Liam', 'Hidalgo', 'Bulao', NULL, 'Male', 'BSIT - 1-C', 1, 'active', 'BSIT', 'C'),
(903, '22-10537', 'Bunagan, Cheryl Dalay On', '22-10537', 1, 'Cheryl', 'Dalay On', 'Bunagan', NULL, 'Female', 'BSIT - 4-B', 4, 'active', 'BSIT', 'B'),
(904, '24-S11900', 'Busal, Welly Geisler Duclawit', '24-S11900', 1, 'Welly Geisler', 'Duclawit', 'Busal', NULL, 'Male', 'BSIT - 1-C', 1, 'active', 'BSIT', 'C'),
(905, '22-11075', 'Buslig, Mischa Allyne Reza Kirsteine Ayang-ang', '22-11075', 1, 'Mischa Allyne Reza Kirsteine', 'Ayang-ang', 'Buslig', NULL, 'Female', 'BSIT - 4-A', 4, 'active', 'BSIT', 'A'),
(939, '24-111919', 'Cabar, Bea Lorrain Pranada', '24-111919', 1, 'Bea Lorrain', 'Pranada', 'Cabar', NULL, 'Female', 'BSIT - 2-B', 2, 'active', 'BSIT', 'B'),
(940, '25-116673', 'Cabay, Reanne Jazz Sumalbag', '25-116673', 1, 'Reanne Jazz', 'Sumalbag', 'Cabay', NULL, 'Female', 'BSIT - 1-C', 1, 'active', 'BSIT', 'C'),
(941, '25-115781', 'Cacatian, Rose Ann Cuaresma', '25-115781', 1, 'Rose Ann', 'Cuaresma', 'Cacatian', NULL, 'Female', 'BSIT - 1-A', 1, 'active', 'BSIT', 'A'),
(942, '21-11089', 'Caggong, Revie Ann Alunday', '21-11089', 1, 'Revie Ann', 'Alunday', 'Caggong', NULL, 'Female', 'BSIT - 4-B', 4, 'active', 'BSIT', 'B'),
(943, '23-110192', 'Caldito, Henyce Jean Bermudez', '23-110192', 1, 'Henyce Jean', 'Bermudez', 'Caldito', NULL, 'Female', 'BSIT - 3-A', 3, 'active', 'BSIT', 'A'),
(944, '24-112028', 'Cale, Benjamine Dakiwag', '24-112028', 1, 'Benjamine', 'Dakiwag', 'Cale', NULL, 'Male', 'BSIT - 2-A', 2, 'active', 'BSIT', 'A'),
(945, '25-116895', 'Camad, Mus\'ab R.', '25-116895', 1, 'Mus\'ab', 'R.', 'Camad', NULL, 'Male', 'BSIT - 1-B', 1, 'active', 'BSIT', 'B');

-- --------------------------------------------------------

--
-- Table structure for table `votes`
--

CREATE TABLE `votes` (
  `vote_id` int(11) NOT NULL,
  `student_id` varchar(250) DEFAULT NULL,
  `election_id` int(11) NOT NULL,
  `voter_id` int(11) NOT NULL,
  `candidate_id` int(11) NOT NULL,
  `vote_time` timestamp NOT NULL DEFAULT current_timestamp(),
  `position` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `votes`
--

INSERT INTO `votes` (`vote_id`, `student_id`, `election_id`, `voter_id`, `candidate_id`, `vote_time`, `position`) VALUES
(62, '24-214175', 27, 24, 68, '2025-08-06 02:08:24', 'President'),
(63, '24-214175', 27, 24, 116, '2025-08-06 02:08:24', 'Vice President'),
(64, '24-214175', 27, 24, 121, '2025-08-06 02:08:24', 'Auditor'),
(65, '24-214175', 27, 24, 123, '2025-08-06 02:08:24', 'Treasurer'),
(66, '24-214175', 27, 24, 124, '2025-08-06 02:08:24', 'Business Manager'),
(67, '24-214175', 27, 24, 126, '2025-08-06 02:08:24', 'Sentinel'),
(68, '24-214175', 27, 24, 129, '2025-08-06 02:08:24', 'First Year Rep'),
(69, '24-214175', 27, 24, 130, '2025-08-06 02:08:24', 'Second Year Rep'),
(70, '24-214175', 27, 24, 137, '2025-08-06 02:08:24', 'Third Year Representative'),
(71, '24-214175', 27, 24, 136, '2025-08-06 02:08:24', 'Fourth Year Representative'),
(72, '25-116883', 27, 25, 68, '2025-08-06 02:16:13', 'President'),
(73, '25-116883', 27, 25, 70, '2025-08-06 02:16:13', 'Vice President'),
(74, '25-116883', 27, 25, 71, '2025-08-06 02:16:13', 'Auditor'),
(75, '25-116883', 27, 25, 118, '2025-08-06 02:16:13', 'Secretary'),
(76, '25-116883', 27, 25, 122, '2025-08-06 02:16:13', 'Treasurer'),
(77, '25-116883', 27, 25, 124, '2025-08-06 02:16:13', 'Business Manager'),
(78, '25-116883', 27, 25, 125, '2025-08-06 02:16:13', 'Business Manager'),
(79, '25-116883', 27, 25, 126, '2025-08-06 02:16:13', 'Sentinel'),
(80, '25-116883', 27, 25, 128, '2025-08-06 02:16:13', 'First Year Rep'),
(81, '25-116883', 27, 25, 130, '2025-08-06 02:16:13', 'Second Year Rep'),
(82, '25-116883', 27, 25, 134, '2025-08-06 02:16:13', 'Third Year Representative'),
(83, '25-116883', 27, 25, 136, '2025-08-06 02:16:13', 'Fourth Year Representative'),
(84, '23-110180', 27, 23, 113, '2025-08-06 02:21:55', 'President'),
(85, '23-110180', 27, 23, 117, '2025-08-06 02:21:55', 'Vice President'),
(86, '23-110180', 27, 23, 135, '2025-08-06 02:21:55', 'Auditor'),
(87, '23-110180', 27, 23, 119, '2025-08-06 02:21:55', 'Secretary'),
(88, '23-110180', 27, 23, 123, '2025-08-06 02:21:55', 'Treasurer'),
(89, '23-110180', 27, 23, 140, '2025-08-06 02:21:55', 'Business Manager'),
(90, '23-110180', 27, 23, 127, '2025-08-06 02:21:55', 'Sentinel'),
(91, '23-110180', 27, 23, 131, '2025-08-06 02:21:55', 'Second Year Rep'),
(92, '23-110180', 27, 23, 137, '2025-08-06 02:21:55', 'Third Year Representative'),
(93, '23-110180', 27, 23, 139, '2025-08-06 02:21:55', 'Fourth Year Representative');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

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
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `college_id` (`college_id`);

--
-- Indexes for table `elections`
--
ALTER TABLE `elections`
  ADD PRIMARY KEY (`id`),
  ADD KEY `college_id` (`college_id`);

--
-- Indexes for table `election_positions`
--
ALTER TABLE `election_positions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `election_id` (`election_id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `student_id` (`student_id`),
  ADD KEY `college_id` (`college_id`);

--
-- Indexes for table `votes`
--
ALTER TABLE `votes`
  ADD PRIMARY KEY (`vote_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `candidates`
--
ALTER TABLE `candidates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=141;

--
-- AUTO_INCREMENT for table `colleges`
--
ALTER TABLE `colleges`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `elections`
--
ALTER TABLE `elections`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `election_positions`
--
ALTER TABLE `election_positions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=961;

--
-- AUTO_INCREMENT for table `votes`
--
ALTER TABLE `votes`
  MODIFY `vote_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `candidates`
--
ALTER TABLE `candidates`
  ADD CONSTRAINT `candidates_ibfk_1` FOREIGN KEY (`election_id`) REFERENCES `elections` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `courses`
--
ALTER TABLE `courses`
  ADD CONSTRAINT `courses_ibfk_1` FOREIGN KEY (`college_id`) REFERENCES `colleges` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `elections`
--
ALTER TABLE `elections`
  ADD CONSTRAINT `elections_ibfk_1` FOREIGN KEY (`college_id`) REFERENCES `colleges` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `election_positions`
--
ALTER TABLE `election_positions`
  ADD CONSTRAINT `election_positions_ibfk_1` FOREIGN KEY (`election_id`) REFERENCES `elections` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `students_ibfk_1` FOREIGN KEY (`college_id`) REFERENCES `colleges` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
