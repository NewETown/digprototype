-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 23, 2014 at 05:12 PM
-- Server version: 5.6.11
-- PHP Version: 5.5.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `digprototype`
--
CREATE DATABASE IF NOT EXISTS `digprototype` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `digprototype`;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(10) NOT NULL,
  `password` varchar(25) NOT NULL,
  `email` varchar(30) NOT NULL,
  `reg_date` date NOT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `user_name` (`user_name`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `password`, `email`, `reg_date`) VALUES
(1, 'test1', 'asdf', 'bob@bob.bob', '2014-01-22'),
(12, 'test2', 'asdf', 'jim@jim.jim', '2014-01-22'),
(14, 'test5', '1234', 'joe@jim.bob', '2014-01-22');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
