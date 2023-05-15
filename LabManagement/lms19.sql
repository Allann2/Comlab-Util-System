-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 13, 2023 at 10:20 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lms19`
--

-- --------------------------------------------------------

--
-- Table structure for table `history_logs`
--

CREATE TABLE `history_logs` (
  `id` int(11) NOT NULL,
  `description` text NOT NULL,
  `table_name` varchar(100) NOT NULL,
  `status_name` text NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_type` int(11) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `history_logs`
--

INSERT INTO `history_logs` (`id`, `description`, `table_name`, `status_name`, `user_id`, `user_type`, `date_created`) VALUES
(60, 'add new room 104', 'room', '', 1, 1, '2023-05-13 12:58:11'),
(61, 'add new room 1101', 'room', '', 1, 1, '2023-05-13 15:05:43'),
(62, 'add new student', 'client', '', 1, 1, '2023-05-13 15:11:20'),
(63, 'edit client', 'client', '', 1, 1, '2023-05-13 15:11:26'),
(64, 'deactivate client', 'client', '', 1, 1, '2023-05-13 15:12:29'),
(65, 'activate client', 'client', '', 1, 1, '2023-05-13 15:19:29'),
(66, 'deactivate user', 'user', '', 1, 1, '2023-05-13 15:22:11'),
(67, 'activate user', 'user', '', 1, 1, '2023-05-13 15:22:13'),
(68, 'deactivate user', 'user', '', 1, 1, '2023-05-13 15:22:17'),
(69, 'activate user', 'user', '', 1, 1, '2023-05-13 15:22:18'),
(70, 'add usertina', 'user', '', 1, 1, '2023-05-13 15:37:10'),
(71, 'deactivate client', 'client', '', 1, 1, '2023-05-13 15:45:28');

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE `member` (
  `id` int(11) NOT NULL,
  `m_school_id` int(11) NOT NULL,
  `m_fname` varchar(50) NOT NULL,
  `m_lname` varchar(50) NOT NULL,
  `m_gender` varchar(10) NOT NULL,
  `m_contact` varchar(15) NOT NULL,
  `m_department` varchar(50) NOT NULL,
  `m_year_section` varchar(20) NOT NULL,
  `m_type` varchar(50) NOT NULL,
  `m_password` varchar(50) NOT NULL,
  `m_status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`id`, `m_school_id`, `m_fname`, `m_lname`, `m_gender`, `m_contact`, `m_department`, `m_year_section`, `m_type`, `m_password`, `m_status`) VALUES
(15, 123123, 'klevie', 'caseres', 'Male', '48486165156', 'CIT', '', 'Faculty', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `room`
--

CREATE TABLE `room` (
  `id` int(11) NOT NULL,
  `rm_name` varchar(50) NOT NULL,
  `rm_date_added` datetime NOT NULL DEFAULT current_timestamp(),
  `rm_status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `room`
--

INSERT INTO `room` (`id`, `rm_name`, `rm_date_added`, `rm_status`) VALUES
(17, 'room 1101', '2023-05-13 15:05:43', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `type` int(11) NOT NULL COMMENT '1=admin, 2=stafff',
  `status` int(11) NOT NULL DEFAULT 1 COMMENT '1=active, 2=inactive'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `username`, `password`, `type`, `status`) VALUES
(1, 'Administrator', 'admin', '0192023a7bbd73250516f069df18b500', 1, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `history_logs`
--
ALTER TABLE `history_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `room`
--
ALTER TABLE `room`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `history_logs`
--
ALTER TABLE `history_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT for table `member`
--
ALTER TABLE `member`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `room`
--
ALTER TABLE `room`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
