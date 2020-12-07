-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 10, 2018 at 12:12 PM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cat-clicker`
--

-- --------------------------------------------------------

--
-- Table structure for table `upgrades`
--

CREATE TABLE `upgrades` (
  `id` int(11) NOT NULL,
  `name` varchar(25) NOT NULL,
  `cost` int(25) NOT NULL,
  `profit` int(25) NOT NULL,
  `type` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `upgrades`
--

INSERT INTO `upgrades` (`id`, `name`, `cost`, `profit`, `type`) VALUES
(2, 'passive_1', 20, 2, 'passive'),
(3, 'passive_2', 100, 10, 'passive'),
(5, 'passive_3', 500, 50, 'passive'),
(6, 'passive_4', 2500, 250, 'passive'),
(7, 'passive_5', 12500, 1250, 'passive'),
(8, 'passive_6', 62500, 6250, 'passive'),
(9, 'passive_7', 312500, 31250, 'passive'),
(10, 'passive_8', 1562500, 156250, 'passive'),
(11, 'passive_9', 7812500, 781250, 'passive'),
(12, 'passive_10', 39062500, 3906250, 'passive'),
(13, 'active_1', 100, 5, 'active'),
(14, 'active_2', 500, 5, 'active'),
(15, 'active_3', 2500, 5, 'active'),
(16, 'active_4', 12500, 5, 'active'),
(17, 'active_5', 62500, 5, 'active'),
(18, 'active_6', 312500, 5, 'active'),
(19, 'active_7', 1562500, 5, 'active'),
(20, 'active_8', 7812500, 5, 'active'),
(21, 'active_9', 39062500, 5, 'active'),
(22, 'active_10', 195312500, 5, 'active');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(25) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `currency` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `email`, `password`, `currency`) VALUES
(24, 'mico', 'mico@mico', '$2y$10$r9bIwga5By2tbq5PiZME0uFkpr413zLsvOodwlVvYPQYDGQBibX4m', 4);

-- --------------------------------------------------------

--
-- Table structure for table `user-upgrades`
--

CREATE TABLE `user-upgrades` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `upgrade_id` int(11) NOT NULL,
  `amount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user-upgrades`
--

INSERT INTO `user-upgrades` (`id`, `user_id`, `upgrade_id`, `amount`) VALUES
(1, 24, 2, 1),
(2, 24, 3, 0),
(3, 24, 5, 0),
(4, 24, 6, 0),
(5, 24, 7, 0),
(6, 24, 8, 0),
(7, 24, 9, 0),
(8, 24, 10, 0),
(9, 24, 11, 0),
(10, 24, 12, 0),
(11, 24, 13, 0),
(12, 24, 14, 0),
(13, 24, 15, 0),
(14, 24, 16, 0),
(15, 24, 17, 0),
(16, 24, 18, 0),
(17, 24, 19, 0),
(18, 24, 20, 0),
(19, 24, 21, 0),
(20, 24, 22, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `upgrades`
--
ALTER TABLE `upgrades`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user-upgrades`
--
ALTER TABLE `user-upgrades`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `upgrade_id` (`upgrade_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `upgrades`
--
ALTER TABLE `upgrades`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `user-upgrades`
--
ALTER TABLE `user-upgrades`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `user-upgrades`
--
ALTER TABLE `user-upgrades`
  ADD CONSTRAINT `user-upgrades_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `user-upgrades_ibfk_2` FOREIGN KEY (`upgrade_id`) REFERENCES `upgrades` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
