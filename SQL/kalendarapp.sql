-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 09, 2022 at 06:59 PM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kalendarapp`
--

-- --------------------------------------------------------

--
-- Table structure for table `nacin_obavljanja`
--

CREATE TABLE `nacin_obavljanja` (
  `idNacinObavljanja` int(11) NOT NULL,
  `idKorisnika` varchar(30) NOT NULL,
  `ponedeljak` varchar(30) DEFAULT NULL,
  `utorak` varchar(30) DEFAULT NULL,
  `sreda` varchar(30) DEFAULT NULL,
  `cetvrtak` varchar(30) DEFAULT NULL,
  `petak` varchar(30) DEFAULT NULL,
  `subota` varchar(30) DEFAULT NULL,
  `nedelja` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `nacin_obavljanja`
--

INSERT INTO `nacin_obavljanja` (`idNacinObavljanja`, `idKorisnika`, `ponedeljak`, `utorak`, `sreda`, `cetvrtak`, `petak`, `subota`, `nedelja`) VALUES
(1, 'admin', 'Sa daljine', 'Sa daljine', 'U kancelariji', 'U kancelariji', 'Sa daljine', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `svi_korisnici`
--

CREATE TABLE `svi_korisnici` (
  `id` int(11) NOT NULL,
  `korisnicko` varchar(30) NOT NULL,
  `lozinka` varchar(50) NOT NULL,
  `mejl_adresa` varchar(60) NOT NULL,
  `ime` varchar(30) DEFAULT NULL,
  `prezime` varchar(30) DEFAULT NULL,
  `datum_rodjenja` date DEFAULT NULL,
  `tip_zaposlenja` varchar(30) DEFAULT NULL,
  `kreiran` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `svi_korisnici`
--

INSERT INTO `svi_korisnici` (`id`, `korisnicko`, `lozinka`, `mejl_adresa`, `ime`, `prezime`, `datum_rodjenja`, `tip_zaposlenja`, `kreiran`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin@gmail.com', 'admin', ' ', '2000-12-18', 'Administrator', '2022-01-09');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `nacin_obavljanja`
--
ALTER TABLE `nacin_obavljanja`
  ADD PRIMARY KEY (`idNacinObavljanja`);

--
-- Indexes for table `svi_korisnici`
--
ALTER TABLE `svi_korisnici`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `nacin_obavljanja`
--
ALTER TABLE `nacin_obavljanja`
  MODIFY `idNacinObavljanja` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `svi_korisnici`
--
ALTER TABLE `svi_korisnici`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
