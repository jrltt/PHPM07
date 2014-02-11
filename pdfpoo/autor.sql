-- phpMyAdmin SQL Dump
-- version 4.0.6
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 06, 2014 at 07:41 PM
-- Server version: 5.5.33
-- PHP Version: 5.5.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `test`
--

-- --------------------------------------------------------

--
-- Table structure for table `autor`
--

CREATE TABLE `autor` (
  `autid` int(11) NOT NULL AUTO_INCREMENT,
  `autnom` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`autid`),
  KEY `autid` (`autid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

--
-- Dumping data for table `autor`
--

INSERT INTO `autor` (`autid`, `autnom`) VALUES
(9, 'Cortazar'),
(10, 'Avedon'),
(11, 'Machado'),
(12, 'Ubrico'),
(13, 'Marc Levin'),
(14, 'Isac Asimov'),
(15, 'Dan Brown'),
(16, 'Andrea Camilleri'),
(17, 'Kafka');
