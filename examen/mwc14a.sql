-- phpMyAdmin SQL Dump
-- version 4.0.6
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 04, 2014 at 11:43 AM
-- Server version: 5.5.33
-- PHP Version: 5.5.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `mwc14a`
--

-- --------------------------------------------------------

--
-- Table structure for table `empresa`
--

CREATE TABLE `empresa` (
  `empid` int(11) NOT NULL AUTO_INCREMENT,
  `empnom` varchar(45) NOT NULL,
  PRIMARY KEY (`empid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `empresa`
--

INSERT INTO `empresa` (`empid`, `empnom`) VALUES
(1, 'Samsung'),
(2, 'Nokia'),
(3, 'Microsoft');

-- --------------------------------------------------------

--
-- Table structure for table `visitant`
--

CREATE TABLE `visitant` (
  `visid` int(11) NOT NULL AUTO_INCREMENT,
  `visnom` varchar(45) NOT NULL,
  `visdatan` date NOT NULL,
  `visfoto` blob,
  `visdia1` tinyint(1) DEFAULT NULL,
  `visdia2` tinyint(1) DEFAULT NULL,
  `visdia3` tinyint(1) DEFAULT NULL,
  `visdia4` tinyint(1) DEFAULT NULL,
  `empid` int(11) NOT NULL,
  PRIMARY KEY (`visid`),
  KEY `fk_visitant_empresa_idx` (`empid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `visitant`
--

INSERT INTO `visitant` (`visid`, `visnom`, `visdatan`, `visfoto`, `visdia1`, `visdia2`, `visdia3`, `visdia4`, `empid`) VALUES
(1, 'hola', '2014-01-31', NULL, 1, 1, 0, 0, 1),
(2, 'marta', '2014-01-03', NULL, 1, 1, 1, 1, 2),
(3, 'marcos', '2014-02-01', NULL, 1, 0, 0, 0, 3),
(4, 'otro', '2014-02-02', NULL, 1, 0, 0, 0, 1),
(5, 'hi sung', '2014-02-01', NULL, 1, 1, 0, 0, 1);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `visitant`
--
ALTER TABLE `visitant`
  ADD CONSTRAINT `fk_visitant_empresa` FOREIGN KEY (`empid`) REFERENCES `empresa` (`empid`) ON DELETE NO ACTION ON UPDATE NO ACTION;
