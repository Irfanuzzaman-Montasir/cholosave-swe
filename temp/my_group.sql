-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 22, 2025 at 08:19 PM
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
-- Table structure for table `my_group`
--

CREATE TABLE `my_group` (
  `group_id` int(11) NOT NULL,
  `group_name` varchar(255) DEFAULT NULL,
  `members` int(11) NOT NULL,
  `group_admin_id` int(11) DEFAULT NULL,
  `dps_type` enum('weekly','monthly') DEFAULT NULL,
  `time_period` int(11) DEFAULT NULL,
  `amount` decimal(8,2) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `goal_amount` int(11) DEFAULT NULL,
  `warning_time` int(11) DEFAULT NULL,
  `emergency_fund` decimal(8,2) DEFAULT NULL,
  `bKash` varchar(255) DEFAULT NULL,
  `Rocket` varchar(255) DEFAULT NULL,
  `Nagad` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `my_group`
--

INSERT INTO `my_group` (`group_id`, `group_name`, `members`, `group_admin_id`, `dps_type`, `time_period`, `amount`, `start_date`, `goal_amount`, `warning_time`, `emergency_fund`, `bKash`, `Rocket`, `Nagad`, `created_at`, `description`) VALUES
(21, 'Savings Squad', 10, 17, 'monthly', 12, 500.00, '2025-01-29', 60000, NULL, 6000.00, '1712345678', '01712345678', '01712345678', '2025-01-26 21:01:48', 'Monthly contributions, shared motivation, and collective growth towards personal and group financial milestones.'),
(22, 'Wealth Wave', 6, 23, 'weekly', 32, 200.00, '2025-01-31', 50110, NULL, 5000.00, '1648248681', '01648248681', NULL, '2025-01-26 21:07:56', 'Riding the momentum of consistent savings, supporting each member&#39;s journey from financial uncertainty to economic confidence.'),
(23, 'Dashboard Showing', 10, 23, 'monthly', 12, 1000.00, '2024-12-28', 100000, NULL, 9000.00, '1634132218', '01634132218', '01634132218', '2025-01-26 21:14:11', 'This is for showing dashboard graphs and others. Also for payment reminders'),
(24, 'Final Boss', 12, 17, 'weekly', 12, 325.00, '2025-01-31', 500000, NULL, 5000.00, '1634132218', '01634132218', '01634132218', '2025-01-27 06:08:00', 'hthdt');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `my_group`
--
ALTER TABLE `my_group`
  ADD PRIMARY KEY (`group_id`),
  ADD KEY `group_admin_id` (`group_admin_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `my_group`
--
ALTER TABLE `my_group`
  MODIFY `group_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `my_group`
--
ALTER TABLE `my_group`
  ADD CONSTRAINT `my_group_ibfk_1` FOREIGN KEY (`group_admin_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
