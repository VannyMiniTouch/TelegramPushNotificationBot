-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jun 20, 2023 at 09:50 AM
-- Server version: 5.7.36
-- PHP Version: 8.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bot_members`
--

-- --------------------------------------------------------

--
-- Table structure for table `mod_telegram_member`
--

DROP TABLE IF EXISTS `mod_telegram_member`;
CREATE TABLE IF NOT EXISTS `mod_telegram_member` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tid` bigint(11) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `firstname` varchar(50) DEFAULT NULL,
  `lastname` varchar(50) DEFAULT NULL,
  `startdate` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=38 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mod_telegram_member`
--

INSERT INTO `mod_telegram_member` (`id`, `tid`, `username`, `firstname`, `lastname`, `startdate`) VALUES
(36, 717459508, 'pao_chen', 'Chen', 'SAM', '2023-06-20 10:11:43'),
(35, 355352669, 'rayateng', 'Raya', 'Teng', '2023-06-20 09:45:20'),
(34, 489399945, 'ChhunVanny', 'Vanny', 'MiniTouch', '2023-06-20 09:44:35'),
(37, 48939994, '@ChhunVanny2', 'Vanny', 'Chhun', '2024-06-19 22:11:13');

-- --------------------------------------------------------

--
-- Table structure for table `mod_user_login`
--

DROP TABLE IF EXISTS `mod_user_login`;
CREATE TABLE IF NOT EXISTS `mod_user_login` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL,
  `password` bigint(20) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mod_user_login`
--

INSERT INTO `mod_user_login` (`id`, `username`, `password`, `email`) VALUES
(1, 'vanny', 123, NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
