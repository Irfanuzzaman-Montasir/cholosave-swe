-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 22, 2025 at 08:24 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cholosave_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `group_membership`
--

CREATE TABLE `group_membership` (
  `membership_id` int(11) NOT NULL,
  `group_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `status` enum('pending','approved','declined') DEFAULT 'pending',
  `is_admin` tinyint(1) DEFAULT 0,
  `leave_request` enum('pending','approved','declined','no') DEFAULT 'no',
  `join_date` date DEFAULT NULL,
  `join_request_date` date DEFAULT NULL,
  `time_period_remaining` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `group_membership`
--

INSERT INTO `group_membership` (`membership_id`, `group_id`, `user_id`, `status`, `is_admin`, `leave_request`, `join_date`, `join_request_date`, `time_period_remaining`) VALUES
(33, 21, 17, 'approved', 1, 'no', '2025-01-27', NULL, 11),
(34, 21, 23, 'approved', 0, 'no', '2025-01-26', '2025-01-27', 11),
(35, 22, 23, 'approved', 1, 'no', '2025-01-27', NULL, 32),
(36, 21, 19, 'pending', 0, 'no', NULL, '2025-01-27', NULL),
(37, 23, 17, 'approved', 0, 'no', '2025-01-27', NULL, 7),
(38, 23, 23, 'approved', 1, 'no', '2025-01-26', '2025-01-27', 9),
(39, 24, 17, 'approved', 1, 'no', '2025-01-27', NULL, 12);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `group_membership`
--
ALTER TABLE `group_membership`
  ADD PRIMARY KEY (`membership_id`),
  ADD KEY `group_id` (`group_id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `group_membership`
--
ALTER TABLE `group_membership`
  MODIFY `membership_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `group_membership`
--
ALTER TABLE `group_membership`
  ADD CONSTRAINT `group_membership_ibfk_1` FOREIGN KEY (`group_id`) REFERENCES `my_group` (`group_id`),
  ADD CONSTRAINT `group_membership_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
