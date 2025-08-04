-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 31, 2025 at 05:16 AM
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `candidates`
--

INSERT INTO `candidates` (`id`, `election_id`, `full_name`, `position`, `photo_url`, `course`, `year`, `platform`, `age`, `motto`, `others`, `created_at`) VALUES
(1, 1, 'Alice Mendoza', 'President', 'https://i.pravatar.cc/150?img=1', 'BSIT', '3rd Year', 'Improve campus Wi-Fi, student engagement', 21, 'Together, We Rise!', 'Leader of IT Club', '2025-07-24 05:23:07'),
(2, 1, 'Brian Santos', 'Vice President', 'https://i.pravatar.cc/150?img=2', 'BSIT', '3rd Year', 'Modernize labs, more org support', 22, 'Your Voice, My Mission', 'Interned at Globe Telecom', '2025-07-24 05:23:07'),
(8, 2, 'Grace Uy', 'Vice President', 'https://i.pravatar.cc/150?img=6', 'BA English', '3rd Year', 'Stronger org funding, academic relief', 21, 'We Hear You', 'Creative Writing Guild head', '2025-07-24 05:34:29'),
(9, 2, 'Henry Cruz', 'Secretary', 'https://i.pravatar.cc/150?img=7', 'BA English', '2nd Year', 'Faster requests, online archives', 20, 'Clear, Quick, Correct', 'Essay contest winner', '2025-07-24 05:34:29'),
(10, 3, 'Isabel Lopez', 'Treasurer', 'https://i.pravatar.cc/150?img=8', 'BSBA', '2nd Year', 'E-budgeting system, fund workshops', 20, 'Plan. Save. Lead.', 'Budgeting Bootcamp grad', '2025-07-24 05:34:29'),
(11, 3, 'Joshua Lim', 'Auditor', 'https://i.pravatar.cc/150?img=9', 'BSBA', '4th Year', 'Accurate records, full transparency', 22, 'Details Matter', 'Finalist, National Audit Cup', '2025-07-24 05:34:29'),
(12, 3, 'Karen David', 'Secretary', 'https://i.pravatar.cc/150?img=10', 'BSBA', '3rd Year', 'Instant notifications, minutes tracker', 21, 'Stay Informed, Stay Empowered', 'BA Secretary', '2025-07-24 05:34:29'),
(13, 2, 'Leo Salazar', 'Treasurer', 'https://i.pravatar.cc/150?img=11', 'BA English', '4th Year', 'Budget reports, scholarship drives', 23, 'Smart Spending, Brighter Future', 'Head, Poetry Org', '2025-07-24 05:34:29'),
(14, 1, 'Juan Dela Cruz', 'President', 'path/to/photo1.jpg', 'BSIT', '3', 'Digital transformation.', 20, 'Together We Can', NULL, '2025-07-25 14:32:39'),
(15, 1, 'Maria Santos', 'President', 'path/to/photo2.jpg', 'BSIT', '4', 'Improve lab resources.', 21, 'Tech for All', NULL, '2025-07-25 14:32:39'),
(18, 10, 'Charlou T Ybarley', 'President', 'uploads/1753610100_4750c5cb49b03bdcc5b4337ebf05a628.jpg', 'BSIT', '4', 'xcvcvcv', NULL, 'zxcxc', NULL, '2025-07-27 09:55:00'),
(19, 10, 'cvcv', 'President', 'uploads/1753610112_700e8c7335eb548a8bf82cb86d5f1b85.jpg', 'BSIT', '3', 'sdsd', NULL, 'sds', NULL, '2025-07-27 09:55:12'),
(20, 10, 'sdsd', 'Secretary', 'uploads/1753610134_663918a778847e3b3b19f8a31f8c1c00.jpg', 'BSIT', '2', 'sdsdsd', NULL, 'sdsd', NULL, '2025-07-27 09:55:34'),
(22, 10, 'dfdf', 'Secretary', 'uploads/1753885343_700e8c7335eb548a8bf82cb86d5f1b85.jpg', 'BSIT', '3', 'sdsd', NULL, 'sdsd', NULL, '2025-07-30 14:22:23'),
(23, 10, 'dfdf', 'Secretary', 'uploads/1753916632_a24c6fa6bf52af8a94e68617a6a91efd.jpg', 'BSIT', '3', 'dfdf', NULL, 'dfdf', NULL, '2025-07-30 23:03:52');

-- --------------------------------------------------------

--
-- Table structure for table `colleges`
--

CREATE TABLE `colleges` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `college_id`, `name`, `acro_name`) VALUES
(2, 1, 'BSIT', NULL),
(10, 1, 'DIUYFTGUIOGHPUIOHPIOHIOPHIPOHPUIOHPHUIO', 'BSMATH'),
(11, 2, 'sdfsdfsd', 'ddd');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `elections`
--

INSERT INTO `elections` (`id`, `college_id`, `title`, `status`, `start_date`, `end_date`, `course`, `created_at`, `description`) VALUES
(1, 1, 'Engineering Student Council Election 2025', 'active', '2025-07-01', '2025-07-30', 'BSIT', '2025-07-27 11:41:57', NULL),
(2, 2, 'Arts Student Election', 'closed', '2025-06-01', '2025-06-15', 'BA', '2025-07-27 11:41:57', NULL),
(3, 3, 'Business Council Election', 'active', '2025-07-15', '2025-07-30', 'BSBA', '2025-07-27 11:41:57', NULL),
(10, 1, 'NEW ITS OFFICER', 'active', '2025-07-27', '2025-07-27', 'BSIT', '2025-07-27 17:27:54', 'dfdfsdxcxc');

-- --------------------------------------------------------

--
-- Table structure for table `election_positions`
--

CREATE TABLE `election_positions` (
  `id` int(11) NOT NULL,
  `election_id` int(11) NOT NULL,
  `position` varchar(255) NOT NULL,
  `count` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `election_positions`
--

INSERT INTO `election_positions` (`id`, `election_id`, `position`, `count`) VALUES
(19, 10, 'President', 1),
(22, 10, 'Secretary', 2);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `student_id`, `name`, `password`, `college_id`, `first_name`, `middle_name`, `last_name`, `ext`, `gender`, `course_year_section`, `year_level`, `status`, `course`, `section`) VALUES
(110, '23-19846', NULL, '23-19846', 1, 'Rendell', 'Manigway', 'Abindan', '', 'Male', 'BSIT - 3-A', 3, 'active', '2', '3-A'),
(111, '24-214213', NULL, '24-214213', 1, 'Keana Ann', 'Lisalis', 'Abuli', '', 'Female', 'BSIT - 2-A', 2, 'active', '2', '2-A'),
(112, '25-117108', NULL, '25-117108', 1, 'Japhet', 'Agetyeng', 'Aclayan', '', 'Male', 'BSIT - 2-B', 2, 'active', '2', '2-B'),
(113, '22-10078', NULL, '22-10078', 1, 'Moh Yassir', 'Islao', 'Adoma', '', 'Male', 'BSIT - 4-A', 4, 'active', '2', '4-A'),
(114, '25-115637', NULL, '25-115637', 1, 'Yasnor', 'Islao', 'Adoma', '', 'Male', 'BSIT - 1-A', 1, 'active', '2', '1-A'),
(115, '23-19454', NULL, '23-19454', 1, 'Ruel', 'Arnold', 'Aduca', '', 'Male', 'BSIT - 3-A', 3, 'active', '2', '3-A'),
(116, '25-115539', NULL, '25-115539', 1, 'Vincent', 'David', 'Aggueban', '', 'Male', 'BSIT - 1-B', 1, 'active', '2', '1-B'),
(117, '24-113854', NULL, '24-113854', 1, 'Princes Ryla', 'Appag', 'Agpad', '', 'Female', 'BSIT - 2-A', 2, 'active', '2', '2-A'),
(118, '24-111860', NULL, '24-111860', 1, 'Precious Lara', 'Masibag', 'Alingod', '', 'Female', 'BSIT - 2-A', 2, 'active', '2', '2-A'),
(119, '24-112985', NULL, '24-112985', 1, 'Justin', 'Ramos', 'Alisto', '', 'Male', 'BSIT - 1-C', 1, 'active', '2', '1-C'),
(120, '25-115864', NULL, '25-115864', 1, 'Lenord', 'Puday', 'Alngag', '', 'Male', 'BSIT - 1-A', 1, 'active', '2', '1-A'),
(121, '23-19399', NULL, '23-19399', 1, 'Jarley', 'Parrocha', 'Amador', '', 'Male', 'BSIT - 3-A', 3, 'active', '2', '3-A'),
(122, '25-116706', NULL, '25-116706', 1, 'Shiena Mae', 'Baltar', 'Ambong', '', 'Female', 'BSIT - 1-B', 1, 'active', '2', '1-B'),
(123, '24-111861', NULL, '24-111861', 1, 'Kurt Kurvey', 'Casanova', 'Andem', '', 'Male', 'BSIT - 2-A', 2, 'active', '2', '2-A'),
(124, '24-112026', NULL, '24-112026', 1, 'Lyrah', 'Vidad', 'Andres', '', 'Female', 'BSIT - 2-B', 2, 'active', '2', '2-B'),
(125, '24-214175', NULL, '24-214175', 1, 'Neri', 'Cullapoy', 'Angalao', 'Ii', 'Male', 'BSIT - 2-A', 2, 'active', '2', '2-A'),
(126, '20-20112', NULL, '20-20112', 1, 'Edilbert', 'Dao-gas', 'Anggati', '', 'Male', 'BSIT - 4-A', 4, 'active', '2', '4-A'),
(127, '20-20480', NULL, '20-20480', 1, 'Rising Hope', 'Dalalo', 'Angpao', '', 'Female', 'BSIT - 4-A', 4, 'active', '2', '4-A'),
(128, '24-113879', NULL, '24-113879', 1, 'Kerwin', 'Liggayu', 'Anniban', '', 'Male', 'BSIT - 1-C', 1, 'active', '2', '1-C'),
(129, '24-112025', NULL, '24-112025', 1, 'Norvie', 'Dangelan', 'Anniban', '', 'Female', 'BSIT - 2-B', 2, 'active', '2', '2-B'),
(191, '25-116813', NULL, 'password', 1, 'Antonio Jedraye', 'Batang-ay', 'Antivo', '', 'Male', 'BSIT - 1-B', 1, 'active', '2', '1-B'),
(192, '25-116703', NULL, 'password', 1, 'Reisner', 'Batoy', 'Ao-wat', '', 'Male', 'BSIT - 1-B', 1, 'active', '2', '1-B'),
(193, '24-112024', NULL, 'password', 1, 'Melvin', 'Bagwan', 'Apatas', '', 'Male', 'BSIT - 2-A', 2, 'active', '2', '2-A'),
(194, '24-111862', NULL, 'password', 1, 'Lhester Kyi', 'Foy-os', 'Apay-yeo', '', 'Male', 'BSIT - 2-A', 2, 'active', '2', '2-A'),
(195, '24-111924', NULL, 'password', 1, 'Anthony Jr.', 'Quezon', 'Apito', '', 'Male', 'BSIT - 2-A', 2, 'active', '2', '2-A'),
(196, '25-115380', NULL, 'password', 1, 'Jestony', 'Baguiwong', 'Araña', '', 'Male', 'BSIT - 1-A', 1, 'active', '2', '1-A'),
(197, '23-110813', NULL, 'password', 1, 'Kervy', 'Caranguian', 'Aromin', '', 'Male', 'BSIT - 3-B', 3, 'active', '2', '3-B'),
(198, '25-115396', NULL, 'password', 1, 'Raymart', 'Agustin', 'Ascaño', '', 'Male', 'BSIT - 1-A', 1, 'active', '2', '1-A'),
(199, '22-10121', NULL, 'password', 1, 'Ranee Mae', 'Oggang', 'Awingan', '', 'Female', 'BSIT - 4-A', 4, 'active', '2', '4-A'),
(200, '22-10101', NULL, 'password', 1, 'Joshua Ralph', 'Gasatan', 'Baawa', '', 'Male', 'BSIT - 4-A', 4, 'active', '2', '4-A'),
(201, '23-110188', NULL, 'password', 1, 'Christian', 'Bingcan', 'Babalan', '', 'Male', 'BSIT - 3-B', 3, 'active', '2', '3-B'),
(202, '25-116675', NULL, 'password', 1, 'Rex', 'Dupali', 'Bacaya', 'Jr', 'Male', 'BSIT - 1-C', 1, 'active', '2', '1-C'),
(203, '18-10542', NULL, 'password', 1, 'Wayne', 'T.', 'Bacdayan', '', 'Male', 'BSIT - 2-B', 2, 'active', '2', '2-B'),
(204, '22-10676', NULL, 'password', 1, 'Rosalie', 'Otan', 'Bacud', '', 'Female', 'BSIT - 4-B', 4, 'active', '2', '4-B'),
(205, '23-19394', NULL, 'password', 1, 'Hinden Von', 'Picat', 'Baggas', '', 'Male', 'BSIT - 3-A', 3, 'active', '2', '3-A'),
(206, '25-117006', NULL, 'password', 1, 'Raymar', 'Gassat', 'Baggas', '', 'Male', 'BSIT - 1-B', 1, 'active', '2', '1-B'),
(207, '20-00308', NULL, 'password', 1, 'Leslie', 'Mamattong', 'Bagsalay', '', 'Male', 'BSIT - 4-B', 4, 'active', '2', '4-B'),
(208, '22-10967', NULL, 'password', 1, 'Brandon Benedict', 'Wandaga', 'Bagtang', '', 'Male', 'BSIT - 4-A', 4, 'active', '2', '4-A'),
(209, '22-10813', NULL, 'password', 1, 'Shadrock', 'Albing', 'Balacang', '', 'Male', 'BSIT - 4-B', 4, 'active', '2', '4-B'),
(210, '20-00983', NULL, 'password', 1, 'Jetlee', 'Lastimosa', 'Balangue', '', 'Male', 'BSIT - 3-A', 3, 'active', '2', '3-A'),
(211, '25-115404', NULL, 'password', 1, 'Marvilyn', 'Alacquiao', 'Balanon', '', 'Female', 'BSIT - 1-A', 1, 'active', '2', '1-A'),
(212, '23-110078', NULL, 'password', 1, 'Aiza', 'Coom', 'Balansi', '', 'Female', 'BSIT - 3-A', 3, 'active', '2', '3-A'),
(213, '25-116734', NULL, 'password', 1, 'Jericho', 'Tulugan', 'Balbi', '', 'Male', 'BSIT - 1-B', 1, 'active', '2', '1-B'),
(214, '24-113818', NULL, 'password', 1, 'Jovi', 'Martinez', 'Balbuena', '', 'Male', 'BSIT - 3-B', 3, 'active', '2', '3-B'),
(215, '23-19854', NULL, 'password', 1, 'Naya Camille', 'Dawiguey', 'Baliaga', '', 'Female', 'BSIT - 3-A', 3, 'active', '2', '3-A'),
(216, '24-111891', NULL, 'password', 1, 'Eirohnjan', 'Anciado', 'Balino', '', 'Male', 'BSIT - 2-A', 2, 'active', '2', '2-A'),
(217, '25-117106', NULL, 'password', 1, 'Mhyra Kate', 'Na-oy', 'Balisong', '', 'Female', 'BSIT - 2-B', 2, 'active', '2', '2-B'),
(218, '23-19374', NULL, 'password', 1, 'Gean', 'Baswit', 'Balitnang', '', 'Female', 'BSIT - 3-A', 3, 'active', '2', '3-A'),
(219, '25-115800', NULL, 'password', 1, 'Camilo', 'Logao', 'Baliwag', '', 'Male', 'BSIT - 1-A', 1, 'active', '2', '1-A'),
(220, '21-11346', NULL, 'password', 1, 'Farrah Lyn', 'Cammagay', 'Baluga', '', 'Female', 'BSIT - 4-A', 4, 'active', '2', '4-A'),
(221, '24-214210', NULL, 'password', 1, 'Jea', 'Toling', 'Baluga', '', 'Female', 'BSIT - 2-A', 2, 'active', '2', '2-A'),
(222, '22-10788', NULL, 'password', 1, 'David', 'Allab', 'Banag', '', 'Male', 'BSIT - 4-B', 4, 'active', '2', '4-B'),
(223, '25-116494', NULL, 'password', 1, 'Benjie', 'Andomang', 'Banasan', '', 'Male', 'BSIT - 1-A', 1, 'active', '2', '1-A'),
(224, '22-10398', NULL, 'password', 1, 'Jeremy', 'Aranca', 'Banawag', '', 'Male', 'BSIT - 4-A', 4, 'active', '2', '4-A'),
(225, '19-10510', NULL, 'password', 1, 'Renalyn', 'Gaayon', 'Banggawan', '', 'Female', 'BSIT - 4-B', 4, 'active', '2', '4-B'),
(226, '25-117134', NULL, 'password', 1, 'Reian Carl', 'Addawe', 'Banggollay', '', 'Male', 'BSIT - 2-B', 2, 'active', '2', '2-B'),
(227, '25-114997', NULL, 'password', 1, 'Churchill', 'Angga-o', 'Banglag', '', 'Male', 'BSIT - 1-B', 1, 'active', '2', '1-B'),
(228, '25-116844', NULL, 'password', 1, 'Aeron Luk', 'Dalipog', 'Banglot', '', 'Male', 'BSIT - 1-B', 1, 'active', '2', '1-B'),
(229, '22-10850', NULL, 'password', 1, 'Rienard', 'Uyam', 'Baruzo', '', 'Male', 'BSIT - 4-B', 4, 'active', '2', '4-B'),
(230, '24-112022', NULL, 'password', 1, 'John Alvin', 'Gumaad', 'Basitao', '', 'Male', 'BSIT - 2-A', 2, 'active', '2', '2-A'),
(231, '25-115764', NULL, 'password', 1, 'Vince-erne', 'Atalig', 'Basnic', '', 'Male', 'BSIT - 1-C', 1, 'active', '2', '1-C'),
(232, '21-11926', NULL, 'password', 1, 'Carl Jian Emil', 'W.', 'Bassiag', '', 'Male', 'BSIT - 1-C', 1, 'active', '2', '1-C'),
(233, '25-116469', NULL, 'password', 1, 'Shane Michael', 'Galwa', 'Basungit', '', 'Male', 'BSIT - 1-A', 1, 'active', '2', '1-A'),
(234, '24-111902', NULL, 'password', 1, 'Jamaica Sheena', 'Lagasi', 'Basuyang', '', 'Female', 'BSIT - 2-A', 2, 'active', '2', '2-A'),
(235, '25-116826', NULL, 'password', 1, 'Rexon', 'Balicao', 'Batoon', 'Sr', 'Male', 'BSIT - 1-B', 1, 'active', '2', '1-B'),
(236, '21-11480', NULL, 'password', 1, 'Florentino', 'Piog', 'Bautista', '', 'Male', 'BSIT - 4-A', 4, 'active', '2', '4-A'),
(237, '24-214180', NULL, 'password', 1, 'Josephine', 'Doctor', 'Bautista', '', 'Female', 'BSIT - 2-A', 2, 'active', '2', '2-A'),
(238, '23-19495', NULL, 'password', 1, 'Jefferson', 'Dacanay', 'Bawing', '', 'Male', 'BSIT - 3-A', 3, 'active', '2', '3-A'),
(239, '23-19400', NULL, 'password', 1, 'Van Riddick', 'Rebancos', 'Bayangan', '', 'Male', 'BSIT - 3-A', 3, 'active', '2', '3-A'),
(240, '21-12348', NULL, 'password', 1, 'Arkein', 'Sokaw', 'Bayongasan', '', 'Male', 'BSIT - 4-B', 4, 'active', '2', '4-B'),
(241, '25-116717', NULL, 'password', 1, 'Ruthsie', 'Dangiwan', 'Bayubay', '', 'Female', 'BSIT - 1-C', 1, 'active', '2', '1-C'),
(242, '21-11829', NULL, 'password', 1, 'Mary Joy', 'Balutoc', 'Benaton', '', 'Female', 'BSIT - 4-A', 4, 'active', '2', '4-A'),
(243, '19-10223', NULL, 'password', 1, 'Rose Belinda', 'Dela Cruz', 'Benganio', '', 'Female', 'BSIT - 3-A', 3, 'active', '2', '3-A'),
(244, '23-211243', NULL, 'password', 1, 'Jaydee', 'Licuben', 'Benitez', '', 'Male', 'BSIT - 2-B', 2, 'active', '2', '2-B'),
(245, '24-113152', NULL, 'password', 1, 'Weldon', 'Domongit', 'Betao', '', 'Male', 'BSIT - 2-B', 2, 'active', '2', '2-B'),
(246, '25-116964', NULL, 'password', 1, 'Deborah', 'Amiyan', 'Bilin', '', 'Female', 'BSIT - 1-C', 1, 'active', '2', '1-C'),
(247, '23-110414', NULL, 'password', 1, 'Jhon Rey', 'Tuccalay', 'Binaraba', '', 'Male', 'BSIT - 3-B', 3, 'active', '2', '3-B'),
(248, '25-116871', NULL, 'password', 1, 'Shina', 'Odam', 'Bitanga', '', 'Female', 'BSIT - 1-B', 1, 'active', '2', '1-B'),
(249, '24-112021', NULL, 'password', 1, 'Justine', 'Dugayon', 'Blante', '', 'Male', 'BSIT - 2-A', 2, 'active', '2', '2-A'),
(250, '25-116125', NULL, 'password', 1, 'Rexsyl', 'Ambong', 'Boccol', '', 'Male', 'BSIT - 1-A', 1, 'active', '2', '1-A'),
(251, '25-115423', NULL, 'password', 1, 'Reynalyn', 'Catalino', 'Bodoy', '', 'Female', 'BSIT - 1-A', 1, 'active', '2', '1-A'),
(252, '25-115006', NULL, 'password', 1, 'Mary Joyce', 'Almeda', 'Bonagan', '', 'Female', 'BSIT - 1-A', 1, 'active', '2', '1-A'),
(253, '22-11633', NULL, 'password', 1, 'Brent Charles', 'Ramos', 'Bonifacio', '', 'Male', 'BSIT - 3-B', 3, 'active', '2', '3-B'),
(254, '23-211239', NULL, 'password', 1, 'Van Rutherford', 'Lao-aten', 'Boog', '', 'Male', 'BSIT - 3-A', 3, 'active', '2', '3-A'),
(255, '21-11088', NULL, 'password', 1, 'Arnelene', 'Madanum', 'Bowat', '', 'Female', 'BSIT - 4-B', 4, 'active', '2', '4-B'),
(256, '21-11108', NULL, 'password', 1, 'Leonelyn', 'Aposta', 'Buado', '', 'Female', 'BSIT - 4-B', 4, 'active', '2', '4-B'),
(257, '23-19395', NULL, 'password', 1, 'Rodneil', 'Macar', 'Bucao', '', 'Male', 'BSIT - 3-A', 3, 'active', '2', '3-A'),
(258, '24-113056', NULL, 'password', 1, 'Quenand Liam', 'Hidalgo', 'Bulao', '', 'Male', 'BSIT - 1-C', 1, 'active', '2', '1-C'),
(259, '89', NULL, 'password89', 1, 'Cheryl', 'Dalay On', 'Bunagan', '', 'Female', 'BSIT - 4-B', 4, 'active', '2', '4-B'),
(260, '90', NULL, 'password90', 1, 'Welly Geisler', 'Duclawit', 'Busal', '', 'Male', 'BSIT - 1-C', 1, 'active', '2', '1-C'),
(261, '91', NULL, 'password91', 1, 'Mischa Allyne Reza Kirsteine', 'Ayang-ang', 'Buslig', '', 'Female', 'BSIT - 4-A', 4, 'active', '2', '4-A'),
(262, '92', NULL, 'password92', 1, 'Bea Lorrain', 'Pranada', 'Cabar', '', 'Female', 'BSIT - 2-B', 2, 'active', '2', '2-B'),
(263, '93', NULL, 'password93', 1, 'Reanne Jazz', 'Sumalbag', 'Cabay', '', 'Female', 'BSIT - 1-C', 1, 'active', '2', '1-C'),
(264, '94', NULL, 'password94', 1, 'Rose Ann', 'Cuaresma', 'Cacatian', '', 'Female', 'BSIT - 1-A', 1, 'active', '2', '1-A'),
(265, '95', NULL, 'password95', 1, 'Revie Ann', 'Alunday', 'Caggong', '', 'Female', 'BSIT - 4-B', 4, 'active', '2', '4-B'),
(266, '96', NULL, 'password96', 1, 'Henyce Jean', 'Bermudez', 'Caldito', '', 'Female', 'BSIT - 3-A', 3, 'active', '2', '3-A'),
(267, '97', NULL, 'password97', 1, 'Benjamine', 'Dakiwag', 'Cale', '', 'Male', 'BSIT - 2-A', 2, 'active', '2', '2-A'),
(268, '98', NULL, 'password98', 1, 'Mus\'ab', 'R.', 'Camad', '', 'Male', 'BSIT - 1-B', 1, 'active', '2', '1-B'),
(269, '99', NULL, 'password99', 1, 'Yahya', 'Mangondato', 'Camad', '', 'Male', 'BSIT - 2-B', 2, 'active', '2', '2-B'),
(270, '100', NULL, 'password100', 1, 'Teodoro Jr.', 'Gumaad', 'Camalao', '', 'Male', 'BSIT - 2-B', 2, 'active', '2', '2-B'),
(271, '101', NULL, 'password101', 1, 'Justin', 'Gollingan', 'Camilo', '', 'Male', 'BSIT - 4-A', 4, 'active', '2', '4-A'),
(272, '102', NULL, 'password102', 1, 'Anderson', 'Gabor', 'Canabang', '', 'Male', 'BSIT - 1-C', 1, 'active', '2', '1-C'),
(273, '103', NULL, 'password103', 1, 'Marc Miguel', 'Doligas', 'Cañas', '', 'Male', 'BSIT - 2-A', 2, 'active', '2', '2-A'),
(274, '104', NULL, 'password104', 1, 'John Ryan', 'Baruzo', 'Caoile', '', 'Male', 'BSIT - 4-B', 4, 'active', '2', '4-B'),
(275, '105', NULL, 'password105', 1, 'Jeus', 'Morales', 'Caranguian', '', 'Male', 'BSIT - 4-B', 4, 'active', '2', '4-B'),
(276, '106', NULL, 'password106', 1, 'Rexton', 'Masaway', 'Carbonell', '', 'Male', 'BSIT - 3-A', 3, 'active', '2', '3-A'),
(277, '107', NULL, 'password107', 1, 'Reyster', 'Masaway', 'Carbonell', '', 'Male', 'BSIT - 3-A', 3, 'active', '2', '3-A'),
(278, '108', NULL, 'password108', 1, 'John Rey', 'Binay-og', 'Cardenas', '', 'Male', 'BSIT - 2-A', 2, 'active', '2', '2-A'),
(279, '109', NULL, 'password109', 1, 'Edward', 'Sacki', 'Caronan', '', 'Male', 'BSIT - 4-B', 4, 'active', '2', '4-B'),
(280, '110', NULL, 'password110', 1, 'Shyra', 'Cadatal', 'Casing', '', 'Female', 'BSIT - 1-C', 1, 'active', '2', '1-C'),
(281, '111', NULL, 'password111', 1, 'Enrique', 'Dela Peña', 'Casirayan', 'Jr', 'Male', 'BSIT - 2-B', 2, 'active', '2', '2-B'),
(282, '112', NULL, 'password112', 1, 'Daryl', 'Alipit', 'Castillo', '', 'Male', 'BSIT - 2-A', 2, 'active', '2', '2-A'),
(283, '113', NULL, 'password113', 1, 'Justin Lee', 'Sannadan', 'Castro', '', 'Male', 'BSIT - 2-A', 2, 'active', '2', '2-A'),
(284, '114', NULL, 'password114', 1, 'Rhea', 'Desay', 'Catriz', '', 'Female', 'BSIT - 1-A', 1, 'active', '2', '1-A'),
(285, '115', NULL, 'password115', 1, 'Chansai', 'Agustin', 'Cera', '', 'Female', 'BSIT - 3-A', 3, 'active', '2', '3-A'),
(286, '116', NULL, 'password116', 1, 'Margie', 'Laggui', 'Codiam', '', 'Female', 'BSIT - 1-A', 1, 'active', '2', '1-A'),
(287, '117', NULL, 'password117', 1, 'Rashil', 'Balangui', 'Codiam', '', 'Female', 'BSIT - 4-A', 4, 'active', '2', '4-A'),
(288, '118', NULL, 'password118', 1, 'Danielle', 'Aquino', 'Collado', '', 'Female', 'BSIT - 2-A', 2, 'active', '2', '2-A'),
(289, '119', NULL, 'password119', 1, 'Sunshine Kieth', 'Dawaton', 'Comadre', '', 'Female', 'BSIT - 1-A', 1, 'active', '2', '1-A'),
(290, '120', NULL, 'password120', 1, 'Leian Andrie', 'Julakit', 'Coquia', '', 'Male', 'BSIT - 4-B', 4, 'active', '2', '4-B'),
(291, '121', NULL, 'password121', 1, 'Wayne Chester', 'Olao', 'Corpuz', '', 'Male', 'BSIT - 4-A', 4, 'active', '2', '4-A'),
(292, '122', NULL, 'password122', 1, 'Alfred Anthony', 'C.', 'Cortez', '', 'Male', 'BSIT - 3-B', 3, 'active', '2', '3-B'),
(293, '123', NULL, 'password123', 1, 'Abraham Kyle', 'Bagliw', 'Cosmiano', '', 'Male', 'BSIT - 4-B', 4, 'active', '2', '4-B'),
(294, '124', NULL, 'password124', 1, 'Xyril Joyce', 'A', 'Cullapoy', '', 'Female', 'BSIT - 1-A', 1, 'active', '2', '1-A'),
(295, '125', NULL, 'password125', 1, 'Genrous', 'Casiano', 'Cureg', '', 'Female', 'BSIT - 1-B', 1, 'active', '2', '1-B'),
(296, '126', NULL, 'password126', 1, 'Arvie', 'Mangaoang', 'Dacio', '', 'Male', 'BSIT - 4-A', 4, 'active', '2', '4-A'),
(297, '127', NULL, 'password127', 1, 'Irish', 'Cañete', 'Dacnas', '', 'Female', 'BSIT - 3-A', 3, 'active', '2', '3-A'),
(298, '128', NULL, 'password128', 1, 'Revan', 'Salingbay', 'Dakiwag', '', 'Male', 'BSIT - 1-A', 1, 'active', '2', '1-A');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `votes`
--

INSERT INTO `votes` (`vote_id`, `student_id`, `election_id`, `voter_id`, `candidate_id`, `vote_time`, `position`) VALUES
(55, '22-10718', 10, 22, 19, '2025-07-31 01:53:45', 'President'),
(56, '22-10718', 10, 22, 22, '2025-07-31 01:53:45', 'Secretary'),
(57, '22-10718', 10, 22, 23, '2025-07-31 01:53:45', 'Secretary');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `election_positions`
--
ALTER TABLE `election_positions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=300;

--
-- AUTO_INCREMENT for table `votes`
--
ALTER TABLE `votes`
  MODIFY `vote_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

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
