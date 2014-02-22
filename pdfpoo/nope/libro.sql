-- phpMyAdmin SQL Dump
-- version 4.0.6
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 06, 2014 at 07:40 PM
-- Server version: 5.5.33
-- PHP Version: 5.5.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `test`
--

-- --------------------------------------------------------

--
-- Table structure for table `libro`
--

CREATE TABLE `libro` (
  `libid` smallint(6) NOT NULL AUTO_INCREMENT,
  `libtitulo` varchar(50) NOT NULL,
  `libnumpag` int(11) NOT NULL,
  `autlid` int(11) DEFAULT NULL,
  PRIMARY KEY (`libid`),
  KEY `autlid` (`autlid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `libro`
--

INSERT INTO `libro` (`libid`, `libtitulo`, `libnumpag`, `autlid`) VALUES
(7, 'Rayuela', 12, 12),
(8, 'El viejo y el mar', 12, 9),
(9, 'Saber y ganar', 200, 10),
(10, 'Aprender Java', 500, 13),
(11, 'La fundacion', 400, 17),
(12, 'El sentido de la vida', 1034, 14);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `libro`
--
ALTER TABLE `libro`
  ADD CONSTRAINT `libro_ibfk_1` FOREIGN KEY (`autlid`) REFERENCES `autor` (`autid`) ON DELETE CASCADE ON UPDATE CASCADE;
