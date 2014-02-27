-- phpMyAdmin SQL Dump
-- version 4.0.6
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 23, 2014 at 06:12 PM
-- Server version: 5.5.33
-- PHP Version: 5.5.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `reyes`
--

-- --------------------------------------------------------

--
-- Table structure for table `ingrediente`
--

CREATE TABLE `ingrediente` (
  `ingid` int(11) NOT NULL AUTO_INCREMENT,
  `ingnom` varchar(35) COLLATE latin1_spanish_ci NOT NULL,
  `unidad` varchar(35) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`ingid`),
  KEY `unidad` (`unidad`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci AUTO_INCREMENT=16 ;

--
-- Dumping data for table `ingrediente`
--

INSERT INTO `ingrediente` (`ingid`, `ingnom`, `unidad`) VALUES
(5, 'Azucar 100', 'gr'),
(6, 'Aceite 10', 'ml'),
(7, 'Sal 1', 'tsk'),
(8, 'Tomate 1', 'kilo'),
(9, 'Harina 500', 'gr'),
(12, 'Queso 250', 'gr'),
(13, 'Cebolla 1/2', 'kilo'),
(15, 'Jamón 500', 'gr');

-- --------------------------------------------------------

--
-- Table structure for table `receta`
--

CREATE TABLE `receta` (
  `recid` int(11) NOT NULL AUTO_INCREMENT,
  `recnom` varchar(35) NOT NULL,
  PRIMARY KEY (`recid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `receta`
--

INSERT INTO `receta` (`recid`, `recnom`) VALUES
(1, 'macarrones bolognesa'),
(2, 'pizza 4 quesos'),
(3, 'Croquetas');

-- --------------------------------------------------------

--
-- Table structure for table `rexin`
--

CREATE TABLE `rexin` (
  `recid` int(11) NOT NULL,
  `ingid` int(11) NOT NULL,
  PRIMARY KEY (`recid`,`ingid`),
  KEY `recid` (`recid`,`ingid`),
  KEY `ing_cons` (`ingid`),
  KEY `recid_2` (`recid`,`ingid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rexin`
--

INSERT INTO `rexin` (`recid`, `ingid`) VALUES
(1, 6),
(1, 7),
(1, 8),
(2, 8),
(3, 9),
(2, 12),
(1, 13),
(3, 13),
(3, 15);

-- --------------------------------------------------------

--
-- Table structure for table `unidad`
--

CREATE TABLE `unidad` (
  `tipo` varchar(25) NOT NULL,
  PRIMARY KEY (`tipo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `unidad`
--

INSERT INTO `unidad` (`tipo`) VALUES
('cc'),
('gr'),
('kilo'),
('litro'),
('ml'),
('tsk');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `ingrediente`
--
ALTER TABLE `ingrediente`
  ADD CONSTRAINT `uni_con` FOREIGN KEY (`unidad`) REFERENCES `unidad` (`tipo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `rexin`
--
ALTER TABLE `rexin`
  ADD CONSTRAINT `ing_cons` FOREIGN KEY (`ingid`) REFERENCES `ingrediente` (`ingid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `rec_cons` FOREIGN KEY (`recid`) REFERENCES `receta` (`recid`) ON DELETE CASCADE ON UPDATE CASCADE;
