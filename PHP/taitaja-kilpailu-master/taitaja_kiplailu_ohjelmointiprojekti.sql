-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 08, 2018 at 11:09 AM
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
-- Database: `taitaja_kiplailu_ohjelmointiprojekti`
--

-- --------------------------------------------------------

--
-- Table structure for table `ilmoittautuminen`
--

CREATE TABLE `ilmoittautuminen` (
  `id` int(11) NOT NULL,
  `kilpailja` int(11) NOT NULL,
  `laji` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ilmoittautuminen`
--

INSERT INTO `ilmoittautuminen` (`id`, `kilpailja`, `laji`) VALUES
(52, 29, 1),
(53, 29, 2),
(54, 29, 3);

-- --------------------------------------------------------

--
-- Table structure for table `kayttaja`
--

CREATE TABLE `kayttaja` (
  `id` int(11) NOT NULL,
  `tunnus` varchar(40) NOT NULL,
  `salasana` varchar(100) NOT NULL,
  `rooli` varchar(20) NOT NULL,
  `etunimi` varchar(20) NOT NULL,
  `sukunimi` varchar(20) NOT NULL,
  `email` varchar(255) NOT NULL,
  `puhelin` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kayttaja`
--

INSERT INTO `kayttaja` (`id`, `tunnus`, `salasana`, `rooli`, `etunimi`, `sukunimi`, `email`, `puhelin`) VALUES
(13, 'mico', '$2y$10$dCb5XNr3oJA/Gko1LNs0be71pZqNzl64J0TDhEFYrhEjxMGl3NpSW', 'user', 'Mico', 'Rintala', 'mico.rintala@gmail.com', '451534055'),
(14, 'admin', '$2y$10$m0utLhnsPVeiN8mjM1ZdCu5UiJbpIboKIVcEk5cMlHYt5iK4WC6iK', 'admin', 'admin', 'admin', 'admin@admin.admin', '404576574'),
(17, 'opettaja1', '$2y$10$OlBLfV61NDvbK1qRVjjd2Oz.JVfmBUXHhl4IoUssq4SzGXEOG.G1m', 'opettaja', 'opettaja1', 'opettaja1', 'opettaja1@opettaja.opettaja', '400400404'),
(18, 'opettaja2', '$2y$10$Q3vnu/NjzjIcaV5yJHSx4uNqBO2hXbP1lF6qFSV5wp5m4ylp9v6RK', 'opettaja', 'opettaja2', 'opettaja2', 'opettaja2@opettaja.opettaja', '404576574'),
(19, 'opettaja3', '$2y$10$PRfMdA0drbtUCtFiYZuGTu/poJQfdW3jPz4dVbisaKmVFrJrrkw5m', 'opettaja', 'opettaja3', 'opettaja3', 'opettaja3@opettaja.opettaja', '400400404');

-- --------------------------------------------------------

--
-- Table structure for table `kipailija`
--

CREATE TABLE `kipailija` (
  `id` int(11) NOT NULL,
  `etunimi` varchar(20) NOT NULL,
  `sukunimi` varchar(20) NOT NULL,
  `puhelin` varchar(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `osoite` varchar(255) NOT NULL,
  `postinumero` varchar(11) NOT NULL,
  `postitoimipaikka` varchar(25) NOT NULL,
  `syntymaaika` varchar(20) NOT NULL,
  `erityisruokavalio` varchar(255) NOT NULL,
  `kuvauslupa` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kipailija`
--

INSERT INTO `kipailija` (`id`, `etunimi`, `sukunimi`, `puhelin`, `email`, `osoite`, `postinumero`, `postitoimipaikka`, `syntymaaika`, `erityisruokavalio`, `kuvauslupa`) VALUES
(29, 'Mico', 'Rintala', '451534055', 'mico.rintala@gmail.com', 'Muurikuja 1 E 111', '00580', 'Helsinki', '21062000', 'Esimerkki', 0);

-- --------------------------------------------------------

--
-- Table structure for table `laji`
--

CREATE TABLE `laji` (
  `id` int(11) NOT NULL,
  `numero` varchar(10) NOT NULL,
  `nimi` varchar(40) NOT NULL,
  `valmentaja` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `laji`
--

INSERT INTO `laji` (`id`, `numero`, `nimi`, `valmentaja`) VALUES
(1, '204', 'Tietojenkäsittely', 17),
(2, '205', 'Tietokoneet ja verkot', 18),
(3, '206', 'Verkkosivujen tuottaminen', 19);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ilmoittautuminen`
--
ALTER TABLE `ilmoittautuminen`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kilpailja` (`kilpailja`),
  ADD KEY `laji` (`laji`);

--
-- Indexes for table `kayttaja`
--
ALTER TABLE `kayttaja`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kipailija`
--
ALTER TABLE `kipailija`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `laji`
--
ALTER TABLE `laji`
  ADD PRIMARY KEY (`id`),
  ADD KEY `valmentaja` (`valmentaja`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ilmoittautuminen`
--
ALTER TABLE `ilmoittautuminen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `kayttaja`
--
ALTER TABLE `kayttaja`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `kipailija`
--
ALTER TABLE `kipailija`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `laji`
--
ALTER TABLE `laji`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `ilmoittautuminen`
--
ALTER TABLE `ilmoittautuminen`
  ADD CONSTRAINT `ilmoittautuminen_ibfk_1` FOREIGN KEY (`kilpailja`) REFERENCES `kipailija` (`id`),
  ADD CONSTRAINT `ilmoittautuminen_ibfk_2` FOREIGN KEY (`laji`) REFERENCES `laji` (`id`);

--
-- Constraints for table `laji`
--
ALTER TABLE `laji`
  ADD CONSTRAINT `laji_ibfk_1` FOREIGN KEY (`valmentaja`) REFERENCES `kayttaja` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
