-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jun 02, 2019 at 05:11 PM
-- Server version: 5.7.26
-- PHP Version: 7.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cats_club`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `username` varchar(255) COLLATE utf8_bin NOT NULL,
  `password` varchar(255) COLLATE utf8_bin NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `cats`
--

DROP TABLE IF EXISTS `cats`;
CREATE TABLE IF NOT EXISTS `cats` (
  `cat_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) COLLATE utf8_bin NOT NULL,
  `age` int(11) NOT NULL,
  `cat_model` varchar(11) COLLATE utf8_bin NOT NULL,
  `owner_id` int(11) NOT NULL,
  PRIMARY KEY (`cat_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `cats`
--

INSERT INTO `cats` (`cat_id`, `name`, `age`, `cat_model`, `owner_id`) VALUES
(1, '123', 123, '123', 1231),
(2, '123', 123, '123', 1231),
(3, '123', 123, '123', 123),
(4, '567', 57, '567', 567);

-- --------------------------------------------------------

--
-- Table structure for table `cat_model`
--

DROP TABLE IF EXISTS `cat_model`;
CREATE TABLE IF NOT EXISTS `cat_model` (
  `cat_model_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) COLLATE utf8_bin NOT NULL,
  `comment` varchar(200) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`cat_model_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `cat_owners`
--

DROP TABLE IF EXISTS `cat_owners`;
CREATE TABLE IF NOT EXISTS `cat_owners` (
  `owner_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) COLLATE utf8_bin NOT NULL,
  `phone` varchar(200) COLLATE utf8_bin NOT NULL,
  `personal_code` varchar(200) COLLATE utf8_bin NOT NULL,
  `username` varchar(255) COLLATE utf8_bin NOT NULL,
  `password` varchar(255) COLLATE utf8_bin NOT NULL,
  `role` VARCHAR(100) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`owner_id`),
  UNIQUE KEY `phone` (`phone`),
  UNIQUE KEY `personal_code` (`personal_code`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `cat_owners`
--

INSERT INTO `cat_owners` (`owner_id`, `name`, `phone`, `personal_code`, `username`, `password`) VALUES
(5, '1', '2', '3', '', ''),
(3, 'DD', 'ww', 'cc', '', ''),
(7, '12312', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `tourniments`
--

DROP TABLE IF EXISTS `tourniments`;
CREATE TABLE IF NOT EXISTS `tourniments` (
  `tourniment_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) COLLATE utf8_bin NOT NULL,
  `description` varchar(200) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`tourniment_id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `tourniments`
--


-- --------------------------------------------------------

--
-- Table structure for table `tourniment_apply`
--

DROP TABLE IF EXISTS `tourniment_apply`;
CREATE TABLE IF NOT EXISTS `tourniment_apply` (
  `record_id` int(11) NOT NULL AUTO_INCREMENT,
  `cat_id` int(11) NOT NULL,
  `tourniment_id` int(11) NOT NULL,
  PRIMARY KEY (`record_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
