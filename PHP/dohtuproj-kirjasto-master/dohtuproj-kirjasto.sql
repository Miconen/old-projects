-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 25, 2018 at 01:08 PM
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
-- Database: `dohtuproj-kirjasto`
--

-- --------------------------------------------------------

--
-- Table structure for table `dohtuproj_kirjasto_kayttaja`
--

CREATE TABLE `dohtuproj_kirjasto_kayttaja` (
  `id` int(11) NOT NULL,
  `tunnus` varchar(40) NOT NULL,
  `salasana` varchar(100) NOT NULL,
  `rooli` varchar(20) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dohtuproj_kirjasto_kayttaja`
--

INSERT INTO `dohtuproj_kirjasto_kayttaja` (`id`, `tunnus`, `salasana`, `rooli`, `email`) VALUES
(22, 'test', '$2y$10$CJ8/IdLNzg89ZYBmCCk7NOGUfEWlC65LaBTPXRbeL5H1CGKgKAzF6', 'user', 'test@test.test'),
(23, 'admin', '$2y$10$TWTqkXbSaoRJQyDKttd4jOwW0uZ1euiysYx2yldN.QsBKnMHu0k.m', 'admin', 'admin@admin.admin');

-- --------------------------------------------------------

--
-- Table structure for table `dohtuproj_kirjasto_kirjat`
--

CREATE TABLE `dohtuproj_kirjasto_kirjat` (
  `id` int(11) NOT NULL,
  `nimi` varchar(255) NOT NULL,
  `laji` varchar(25) NOT NULL,
  `vuosi` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dohtuproj_kirjasto_kirjat`
--

INSERT INTO `dohtuproj_kirjasto_kirjat` (`id`, `nimi`, `laji`, `vuosi`) VALUES
(1, '123', '1123', 1233),
(2, 'Pikku Papun laulut', 'Lapset', 2017),
(3, 'Siinan taikaradio', 'Lapset', 2015),
(4, 'Test', 'Test', 1990),
(5, 'Esimerkki', 'Esimerkki', 1999);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dohtuproj_kirjasto_kayttaja`
--
ALTER TABLE `dohtuproj_kirjasto_kayttaja`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dohtuproj_kirjasto_kirjat`
--
ALTER TABLE `dohtuproj_kirjasto_kirjat`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dohtuproj_kirjasto_kayttaja`
--
ALTER TABLE `dohtuproj_kirjasto_kayttaja`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `dohtuproj_kirjasto_kirjat`
--
ALTER TABLE `dohtuproj_kirjasto_kirjat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
