-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jun 18, 2023 at 05:22 PM
-- Server version: 5.7.36
-- PHP Version: 7.4.26

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
  `tid` int(11) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `firstname` varchar(50) DEFAULT NULL,
  `lastname` varchar(50) DEFAULT NULL,
  `startdate` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mod_telegram_member`
--

INSERT INTO `mod_telegram_member` (`id`, `tid`, `username`, `firstname`, `lastname`, `startdate`) VALUES
(1, 12345, 'username', 'firstname', 'lastname', '2023-06-01 22:11:13'),
(2, 12345, 'username', 'firstname', 'lastname', '2023-06-01 22:11:13'),
(3, 12345, 'username', 'firstname', 'lastname', '2023-06-01 22:11:13'),
(4, 12345, 'username', 'firstname', 'lastname', '2023-06-01 22:11:13'),
(5, 12345, 'username', 'firstname', 'lastname', '2023-06-01 22:11:13'),
(6, 12345, 'username', 'firstname', 'lastname', '2023-06-01 22:11:13'),
(7, 12345, 'username', 'firstname', 'lastname', '2023-06-01 22:11:13'),
(8, 12345, 'username', 'firstname', 'lastname', '2023-06-01 22:11:13'),
(9, 12345, 'username', 'firstname', 'lastname', '2023-06-01 22:11:13'),
(10, 12345, 'username', 'firstname', 'lastname', '2023-06-01 22:11:13'),
(11, 12345, 'username', 'firstname', 'lastname', '2023-06-01 22:11:13'),
(12, 12345, 'username', 'firstname', 'lastname', '2023-06-01 22:11:13'),
(13, 12345, 'username', 'firstname', 'lastname', '2023-06-01 22:11:13'),
(14, 12345, 'username', 'firstname', 'lastname', '2023-06-01 22:11:13'),
(15, 12345, 'username', 'firstname', 'lastname', '2023-06-01 22:11:13');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
