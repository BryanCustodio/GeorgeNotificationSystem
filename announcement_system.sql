-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 09, 2024 at 12:50 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `announcement_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `announcements`
--

CREATE TABLE `announcements` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `announcements`
--

INSERT INTO `announcements` (`id`, `title`, `content`, `created_at`) VALUES
(15, 'SUSPENSION OF CLASSES IN ALL LEVELS, TOMORROW (PUBLIC & PRIVATE) IN LAGUNA CITY.', '\"AN ORDER DECLARING THE SUSPENSION OF CLASSES IN ALL LEVELS, BOTH PUBLIC AND PRIVATE SCHOOLS IN THE CITY OF LAGUNA CITY ON SEPTEMBER 2, 2024 (MONDAY) DUE TO \"TROPICAL DEPRESSION ENTENG\"\r\nWHEREAS, Republic Act No. 7160 otherwise known as the Local Government Code of 1991 mandates local government units (LGUs) to be at the frontline of emergency measures in the prevention of disasters to ensure the general welfare of its constituents;\r\nWHEREAS, the Local Government of Sorsogon City is mandated to uphold the people\'s constitutional rights to life, Health, safety and property and to promote the general welfare of its people at all times, especially during disasters and calamities;\r\nWHEREAS, DOST-PAGASA issued a Tropical Cyclone Bulletin for \"Tropical Depression ENTENG\" placing LAGUNA CITY under TCWS No. 1 with Heavy Rainfall Outlook Forecast of accumulated rainfall from 100-200 mm;\r\nWHEREAS, the Local Disaster Risk Reduction and Management Council of Laguna City recommends the Suspension of classes in All Levels, both in Public and Private Schools within Laguna City as a precautionary measure to assure safety and to anticipate the possible effects of Weather System;\r\nNOW, THEREFORE, I, MA. ESTER E. HAMOR, City Mayor of Laguna City, by virtue of powers vested in me by law, do hereby order the Suspension of Classes in ALL LEVELS in Laguna City on September 2, 2024 (Monday).\r\nThis Executive Order shall take effect immediately.\r\nDONE AND EXECUTED on this 1st day of September 2024 at Laguna City, Laguna, Philippines.\r\nCity Mayor/CDRRMC Chairperson', '2024-09-01 10:02:11');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','student') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`) VALUES
(3, 'admin', '$2b$12$Os5De/BDWMjUBuJUnoutreWHw3ZUCq6Qx6WGZ/kV9TKvkmjEZSBTa', 'admin'),
(4, 'student', '$2b$12$Os5De/BDWMjUBuJUnoutreWHw3ZUCq6Qx6WGZ/kV9TKvkmjEZSBTa', 'student');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `announcements`
--
ALTER TABLE `announcements`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `announcements`
--
ALTER TABLE `announcements`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
