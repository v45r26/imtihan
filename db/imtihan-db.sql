-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 01, 2024 at 01:51 PM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `imtihan-db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin-table`
--

CREATE TABLE `admin-table` (
  `Sno` int(11) NOT NULL,
  `admin_id` varchar(12) NOT NULL,
  `admin_name` varchar(250) NOT NULL,
  `admin_username` varchar(250) NOT NULL,
  `admin_gender` varchar(250) NOT NULL,
  `admin_country` varchar(250) NOT NULL,
  `admin_password` varchar(250) NOT NULL,
  `date_time` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `option-table`
--

CREATE TABLE `option-table` (
  `sno` int(11) NOT NULL,
  `q_id` varchar(50) NOT NULL,
  `option_title` text NOT NULL,
  `option_no` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `question-table`
--

CREATE TABLE `question-table` (
  `sno` int(11) NOT NULL,
  `test_id` varchar(40) NOT NULL,
  `q_id` varchar(50) NOT NULL,
  `question-title` text NOT NULL,
  `correct-option` text NOT NULL,
  `point-marks` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `student-result-table`
--

CREATE TABLE `student-result-table` (
  `Sno` int(11) NOT NULL,
  `test-id` text NOT NULL,
  `test-takers-name` text NOT NULL,
  `total-question-attempt` text NOT NULL,
  `marks` text NOT NULL,
  `percentege` text NOT NULL,
  `p-o-f` text NOT NULL,
  `starting_time` text NOT NULL,
  `finishing_time` text NOT NULL,
  `total_time_taken` text NOT NULL,
  `rigth_ans` int(11) NOT NULL,
  `wrong_ans` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `test-table`
--

CREATE TABLE `test-table` (
  `sno` int(11) NOT NULL,
  `admin_id` varchar(25) NOT NULL,
  `test_id` varchar(25) NOT NULL,
  `test_title` text NOT NULL,
  `test_status` text NOT NULL,
  `test_password_status` varchar(25) NOT NULL,
  `test_password` varchar(40) NOT NULL,
  `test_intro` text NOT NULL,
  `test_theme` text NOT NULL,
  `test_time_limit` int(11) NOT NULL,
  `d_right_click` varchar(3) NOT NULL,
  `d_copy_paste` varchar(3) NOT NULL,
  `d_selection` varchar(3) NOT NULL,
  `rand_ques` varchar(3) NOT NULL,
  `rand_opt` varchar(3) NOT NULL,
  `download_q_p` text NOT NULL,
  `at_t_e_display_res` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin-table`
--
ALTER TABLE `admin-table`
  ADD PRIMARY KEY (`Sno`);

--
-- Indexes for table `option-table`
--
ALTER TABLE `option-table`
  ADD PRIMARY KEY (`sno`);

--
-- Indexes for table `question-table`
--
ALTER TABLE `question-table`
  ADD PRIMARY KEY (`sno`);

--
-- Indexes for table `student-result-table`
--
ALTER TABLE `student-result-table`
  ADD PRIMARY KEY (`Sno`);

--
-- Indexes for table `test-table`
--
ALTER TABLE `test-table`
  ADD PRIMARY KEY (`sno`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin-table`
--
ALTER TABLE `admin-table`
  MODIFY `Sno` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `option-table`
--
ALTER TABLE `option-table`
  MODIFY `sno` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `question-table`
--
ALTER TABLE `question-table`
  MODIFY `sno` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `student-result-table`
--
ALTER TABLE `student-result-table`
  MODIFY `Sno` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `test-table`
--
ALTER TABLE `test-table`
  MODIFY `sno` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
