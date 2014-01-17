-- phpMyAdmin SQL Dump
-- version 4.0.6
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 14, 2014 at 11:38 PM
-- Server version: 5.5.33
-- PHP Version: 5.5.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `gestiproj`
--

-- --------------------------------------------------------

--
-- Table structure for table `persona`
--

CREATE TABLE `persona` (
  `dni` varchar(10) NOT NULL,
  `nombre` varchar(25) NOT NULL,
  `foto` mediumblob NOT NULL,
  `nomProjec` varchar(25) NOT NULL,
  PRIMARY KEY (`dni`),
  KEY `nomProjec` (`nomProjec`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `proyecto`
--

CREATE TABLE `proyecto` (
  `nombre` varchar(25) NOT NULL,
  `di` date NOT NULL,
  `df` date NOT NULL,
  `presu` int(30) NOT NULL,
  PRIMARY KEY (`nombre`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `persona`
--
ALTER TABLE `persona`
  ADD CONSTRAINT `persona_ibfk_1` FOREIGN KEY (`nomProjec`) REFERENCES `proyecto` (`nombre`) ON UPDATE CASCADE;
