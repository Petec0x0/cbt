-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 14, 2020 at 11:26 AM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.1.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cbt`
--

-- --------------------------------------------------------

--
-- Table structure for table `administrator`
--

CREATE TABLE `administrator` (
  `id` int(11) NOT NULL,
  `firstname` varchar(255) DEFAULT NULL,
  `lastname` varchar(255) DEFAULT NULL,
  `level` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `administrator`
--

INSERT INTO `administrator` (`id`, `firstname`, `lastname`, `level`, `password`, `email`) VALUES
(1, 'onyedikachi', 'peter', '0', 'administrator_password', 'petecdev@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `candidates`
--

CREATE TABLE `candidates` (
  `candidates_id` int(11) NOT NULL,
  `candidates_fullname` varchar(255) NOT NULL,
  `candidates_registration_no` varchar(255) NOT NULL,
  `candidates_phone_no` varchar(255) NOT NULL,
  `candidates_email` varchar(255) NOT NULL,
  `course1_id` int(11) NOT NULL,
  `course2_id` int(11) NOT NULL,
  `course3_id` int(11) NOT NULL,
  `course4_id` int(11) NOT NULL,
  `course1_score` varchar(255) DEFAULT '0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0',
  `course2_score` varchar(255) DEFAULT '0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0',
  `course3_score` varchar(255) DEFAULT '0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0',
  `course4_score` varchar(255) DEFAULT '0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0',
  `time_available` int(11) NOT NULL DEFAULT 79,
  `correct_option1` varchar(255) DEFAULT '1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1',
  `correct_option2` varchar(255) DEFAULT '1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1',
  `correct_option3` varchar(255) DEFAULT '1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1',
  `correct_option4` varchar(255) DEFAULT '1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `candidates`
--

INSERT INTO `candidates` (`candidates_id`, `candidates_fullname`, `candidates_registration_no`, `candidates_phone_no`, `candidates_email`, `course1_id`, `course2_id`, `course3_id`, `course4_id`, `course1_score`, `course2_score`, `course3_score`, `course4_score`, `time_available`, `correct_option1`, `correct_option2`, `correct_option3`, `correct_option4`) VALUES
(1, 'Ugwu Chinonso', '5202829271EF', '08123456789', 'petecdev@gmail.com', 1, 2, 6, 7, '0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0', '0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0', '0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0', '0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0', 79, 'D,D,C,A,A,A,D,A,D,C,D,A,C,D,B,D,A,A,D,C,C,D,A,D,B,B,D,A,D,A,C,B,C,B,B,B,C,A,C,D,A,D,A,C,D,A,C,D,C,C,A,D,A,C,D,B,B,A,A,A', 'D,D,C,A,E,D,C,C,A,D,A,A,B,E,A,E,D,B,D,E,A,C,A,C,C,E,B,D,D,D,B,E,A,C,B,E,B,D,B,E,B,A,A,C,E,B,A,C,C,E', 'B,A,C,B,C,A,B,B,A,C,D,D,B,A,B,B,C,A,B,C,C,B,B,B,B,D,C,C,B,C,C,B,C,A,D,C,B,A,D,C,B,B,C,3,D,D,C,A,C,C', 'A,E,A,A,A,A,A,A,A,A,D,C,A,A,A,D,A,A,C,A,,A,A,A,B,A,C,C,A,A,A,D,B,A,A,A,C,C,A,D,C,C,A,A,A,C,A,A,A,A'),
(2, 'Kedi Anthony', '5202829271EA', '08123456789', 'kedi@gmail.com', 1, 8, 9, 10, '0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0', '0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0', '0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0', '0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0', 79, 'D,D,C,A,A,A,D,A,D,C,D,A,C,D,B,D,A,A,D,C,C,D,A,D,B,B,D,A,D,A,C,B,C,B,B,B,C,A,C,D,A,D,A,C,D,A,C,D,C,C,A,D,A,C,D,B,B,A,A,A', 'D,D,B,C,D,C,B,B,B,B,B,C,D,A,C,A,C,A,A,D,A,B,C,A,C,A,A,D,C,C,A,B,B,B,C,D,D,B,A,B,A,C,D,B,B,B,D,D,B,D', 'A,A,A,,A,C,B,D,A,C,C,A,C,B,A,C,D,D,A,C,c,D,A,C,A,D,A,A,D,C,C,D,D,A,B,B,C,C,A,C,B,D,A,D,C,B,A,D,C,A', 'A,A,A,D,A,D,C,B,B,D,D,C,D,A,C,A,B,B,D,D,B,B,A,B,D,C,C,A,B,D,C,B,A,B,D,A,B,D,A,B,B,B,B,A,D,D,C,C,C,C'),
(3, 'Igwe Tochi', '5202829271EC', '08123456789', 'corky@gmail.com', 1, 11, 12, 13, 'C,C,C,D,C,B,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0', 'D,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0', 'C,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0', 'D,C,B,A,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0', 11, 'D,D,C,A,A,A,D,A,D,C,D,A,C,D,B,D,A,A,D,C,C,D,A,D,B,B,D,A,D,A,C,B,C,B,B,B,C,A,C,D,A,D,A,C,D,A,C,D,C,C,A,D,A,C,D,B,B,A,A,A', 'C,C,D,D,C,B,D,A,A,C,C,B,B,C,D,D,B,A,C,C,B,A,B,B,A,D,D,B,A,D,C,C,A,A,C,D,C,D,B,D,C,C,A,B,A,D,D,A,A,A,', 'B,B,A,D,B,B,D,A,A,D,A,B,D,C,A,D,C,D,C,A,D,C,A,A,A,A,C,D,A,C,C,C,D,C,D,B,A,A,C,C,D,A,D,B,B,A,A,C,C,B', 'B,,C,D,D,C,B,A,D,D,B,B,D,A,A,A,A,B,B,A,C,C,D,D,B,D,C,B,A,D,C,C,C,B,C,B,C,B,B,B,A,C,A,C,B,D,A,A,D,A'),
(4, 'Udeh Onyedikachi', '5202829271ED', '098765432', 'udeh@gmail.com', 1, 4, 3, 5, '0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0', '0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0', '0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0', '0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0', 41, 'D,D,C,A,A,A,D,A,D,C,D,A,C,D,B,D,A,A,D,C,C,D,A,D,B,B,D,A,D,A,C,B,C,B,B,B,C,A,C,D,A,D,A,C,D,A,C,D,C,C,A,D,A,C,D,B,B,A,A,A', 'D,D,A,B,B,D,C,A,D,B,B,D,C,A,B,B,D,C,A,a,D,B,C,C,C,D,C,D,B,D,B,C,C,B,A,B,A,B,C,B,C,B,D,B,B,D,A,C,A,D', 'A,D,C,A,B,B,D,A,B,C,B,A,B,D,D,C,B,A,A,D,A,D,C,B,D,B,C,B,A,A,D,D,A,A,A,B,D,C,D,B,D,C,B,A,C,B,a,C,D,A', 'A,C,B,B,B,A,D,D,A,B,C,B,B,C,B,D,D,D,A,C,B,D,B,A,A,B,A,D,B,B,D,D,B,B,C,A,D,B,B,A,C,B,A,C,A,A,D,C,D,D');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` int(11) NOT NULL,
  `course_name` varchar(255) DEFAULT NULL,
  `course_code` varchar(255) DEFAULT NULL,
  `filename` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `course_name`, `course_code`, `filename`) VALUES
(1, 'USE OF ENGLISH\r\n', 'UOE', 'useofenglish.txt'),
(2, 'BIOLOGY', 'BIO', 'biology.txt'),
(3, 'MATHEMATICS', 'MAT', 'mathematics.txt'),
(4, 'Accounting', 'ACCO', 'accounting.txt'),
(5, 'Agricultural Science', 'AGC', 'agricultural_science.txt'),
(6, 'Chemistry', 'CHEM', 'chemistry.txt'),
(7, 'Physics', 'PHYS', 'physics.txt'),
(8, 'Economics', 'ECON', 'economics.txt'),
(9, 'Geography', 'GEOG', 'geograph.txt'),
(10, 'Commerce', 'BUSS', 'commerce.txt'),
(11, 'Christian Religious Studies', 'CRK', 'christian_religious_knowlegde.txt'),
(12, 'Literature In English', 'LIT', 'literature_in_english.txt'),
(13, 'Government', 'GOVT', 'government.txt');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `administrator`
--
ALTER TABLE `administrator`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `candidates`
--
ALTER TABLE `candidates`
  ADD PRIMARY KEY (`candidates_id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `administrator`
--
ALTER TABLE `administrator`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `candidates`
--
ALTER TABLE `candidates`
  MODIFY `candidates_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
