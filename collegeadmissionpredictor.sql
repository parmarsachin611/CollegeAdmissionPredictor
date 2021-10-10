-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 10, 2021 at 11:48 AM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 8.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `collegeadmissionpredictor`
--

-- --------------------------------------------------------

--
-- Table structure for table `addcollege`
--

CREATE TABLE `addcollege` (
  `c_id` int(11) NOT NULL,
  `c_name` varchar(100) NOT NULL,
  `c_branch` varchar(255) NOT NULL,
  `c_address` varchar(100) NOT NULL,
  `c_city` varchar(100) NOT NULL,
  `c_zip` int(10) NOT NULL,
  `c_contact` bigint(100) NOT NULL,
  `DATE/TIME` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `addcollege`
--

INSERT INTO `addcollege` (`c_id`, `c_name`, `c_branch`, `c_address`, `c_city`, `c_zip`, `c_contact`, `DATE/TIME`) VALUES
(5, 'FRCRCE', 'Information Technology,Computer Science,Electronics and Computer Science,', 'Bandra- West', 'Mumbai', 400010, 9876543214, '2021-10-10 06:29:01');

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `aid` int(3) NOT NULL,
  `adminusername` varchar(10) NOT NULL,
  `adminpass` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`aid`, `adminusername`, `adminpass`) VALUES
(1, 'admin', '$2y$10$nL/FWm5JAEK6Ehvfv.97VOnyL./nNhx2k4Zaa/3lyu3op6gnCK5o6');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `sid` int(100) NOT NULL,
  `marksflag` int(2) NOT NULL COMMENT '0- Branch and Marks are not set \r\n1- branch and marks are set',
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` text NOT NULL,
  `branch` varchar(50) NOT NULL,
  `password` text NOT NULL,
  `marks` text NOT NULL,
  `game` varchar(50) NOT NULL,
  `TimeStamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`sid`, `marksflag`, `fname`, `lname`, `email`, `phone`, `branch`, `password`, `marks`, `game`, `TimeStamp`) VALUES
(2, 0, 'Sachin', 'Parmar', 'crce.9076.ecs@gmail.com', '9082572209', '', '$2y$10$KP9eSbKoM8o2WftXv76uZujuFM8pEE.cr0.3WYsRajQa6/PA82v5C', '', 'Cricket', '2021-10-02 11:25:33'),
(3, 0, 'Darshal', 'Parmar', 'crce.9075.ecs@gmail.com', '7894561233', '', '$2y$10$ZHaOeYZVcOTkD8geKMiMbOIZd2cwI8r0WafjX4N/Vn1mbadlJRdhS', '', 'hockey', '2021-10-01 03:54:12');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `addcollege`
--
ALTER TABLE `addcollege`
  ADD PRIMARY KEY (`c_id`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`aid`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`sid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `addcollege`
--
ALTER TABLE `addcollege`
  MODIFY `c_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `aid` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `sid` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
