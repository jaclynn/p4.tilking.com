-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 20, 2013 at 02:40 AM
-- Server version: 5.6.12
-- PHP Version: 5.5.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `tilkingc_p4_tilking_com`
--
CREATE DATABASE IF NOT EXISTS `tilkingc_p4_tilking_com` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `tilkingc_p4_tilking_com`;

-- --------------------------------------------------------

--
-- Table structure for table `bricks`
--

CREATE TABLE IF NOT EXISTS `bricks` (
  `brick_id` int(11) NOT NULL AUTO_INCREMENT,
  `created` int(11) NOT NULL,
  `modified` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `price` float NOT NULL,
  `content` text NOT NULL,
  `location` varchar(255) NOT NULL,
  `availability` enum('AVAILABLE','PPU','SOLD') NOT NULL DEFAULT 'AVAILABLE',
  PRIMARY KEY (`brick_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=46 ;

--
-- Dumping data for table `bricks`
--

INSERT INTO `bricks` (`brick_id`, `created`, `modified`, `user_id`, `image`, `price`, `content`, `location`, `availability`) VALUES
(35, 1387501468, 1387501468, 15, '/uploads/items/brickpic_user15_1387501468.png', 45, 'Boots. Got them online and they are too small. 7.5 but fit more like 7', 'Landenberg', 'AVAILABLE'),
(36, 1387501520, 1387503549, 15, '/uploads/items/brickpic_user15_1387501520.png', 15, 'Cabbage Patch. New in box.', 'Landenberg', 'SOLD'),
(37, 1387501600, 1387501600, 16, '/uploads/items/brickpic_user16_1387501600.png', 160, 'Tires. Set of two. ', 'West Grove', 'AVAILABLE'),
(38, 1387501760, 1387503150, 17, '/uploads/items/brickpic_user17_1387501760.png', 10, 'Rabbit. Undisciplined. Comes with cage, leash, etc.', 'Avondale', 'PPU'),
(39, 1387502668, 1387502911, 18, '/uploads/items/brickpic_user18_1387502668.png', 23, 'Candelabra. Too fancy for me.', 'Avondale', 'PPU'),
(40, 1387502964, 1387502964, 18, '/uploads/items/brickpic_user18_1387502964.png', 10, 'Spatula. Never used.', 'Avondale', 'AVAILABLE'),
(41, 1387502981, 1387502981, 18, '/uploads/items/brickpic_user18_1387502981.png', 12, 'Colander. Used twice.', 'Avondale', 'AVAILABLE'),
(42, 1387503125, 1387503125, 20, '/uploads/items/brickpic_user20_1387503125.png', 200, 'Chicken Coop. Made to order.', 'Kemblesville', 'AVAILABLE'),
(43, 1387503264, 1387503264, 19, '/uploads/items/brickpic_user19_1387503264.png', 3, 'Book. I no longer need this.', 'Landenberg', 'AVAILABLE'),
(44, 1387503342, 1387503342, 19, '/uploads/items/brickpic_user19_1387503342.png', 11, 'Radio. I don''t use radios anymore.', 'Landenberg', 'AVAILABLE'),
(45, 1387503504, 1387503504, 19, '/uploads/items/brickpic_user19_1387503504.png', 500, 'TV. I have too many. New in box.', 'Landenberg', 'AVAILABLE');

-- --------------------------------------------------------

--
-- Table structure for table `interest`
--

CREATE TABLE IF NOT EXISTS `interest` (
  `user_id` int(11) NOT NULL,
  `brick_id` int(11) NOT NULL,
  `created` int(11) NOT NULL,
  PRIMARY KEY (`user_id`,`brick_id`),
  KEY `user_id` (`user_id`),
  KEY `brick_id` (`brick_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `interest`
--

INSERT INTO `interest` (`user_id`, `brick_id`, `created`) VALUES
(15, 37, 1387502864),
(15, 39, 1387502866),
(18, 36, 1387502069),
(18, 37, 1387503038),
(18, 38, 1387502905),
(19, 36, 1387503530),
(19, 37, 1387502366),
(19, 39, 1387503184),
(19, 41, 1387503191),
(20, 35, 1387503082),
(20, 38, 1387503085),
(20, 40, 1387503090);

-- --------------------------------------------------------

--
-- Table structure for table `profiles`
--

CREATE TABLE IF NOT EXISTS `profiles` (
  `profile_id` int(11) NOT NULL AUTO_INCREMENT,
  `created` int(11) NOT NULL,
  `modified` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `city` varchar(255) NOT NULL,
  `state` varchar(2) NOT NULL,
  `dob` date NOT NULL,
  `avatar` varchar(255) NOT NULL,
  PRIMARY KEY (`profile_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=20 ;

--
-- Dumping data for table `profiles`
--

INSERT INTO `profiles` (`profile_id`, `created`, `modified`, `user_id`, `city`, `state`, `dob`, `avatar`) VALUES
(14, 1387501091, 1387501091, 15, 'West Palm Beach', 'FL', '0000-00-00', '/img/placeholder.png'),
(15, 1387501552, 1387501552, 16, 'West Palm Beach', 'FL', '0000-00-00', '/img/placeholder.png'),
(16, 1387501670, 1387501670, 17, 'West Palm Beach', 'FL', '0000-00-00', '/img/placeholder.png'),
(17, 1387502052, 1387502723, 18, 'Avondale', 'PA', '0000-00-00', '/uploads/avatars/profpic_small18.png'),
(18, 1387502347, 1387502347, 19, 'West Palm Beach', 'FL', '0000-00-00', '/img/placeholder.png'),
(19, 1387503067, 1387503067, 20, 'West Palm Beach', 'FL', '0000-00-00', '/img/placeholder.png');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `created` int(11) NOT NULL,
  `modified` int(11) NOT NULL,
  `token` varchar(255) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `last_login` int(11) NOT NULL,
  `timezone` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=21 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `created`, `modified`, `token`, `password`, `last_login`, `timezone`, `first_name`, `last_name`, `email`) VALUES
(15, 1387501091, 1387501091, 'f84848579e741da219d1bebef335fca82a234db7', '53d936c3d20036e5445a30a435e3a6ff7248edb5', 0, '', 'Jackie', 'Wilson', 'jackie@jackie.com'),
(16, 1387501552, 1387501552, '992baed6a45270f24f732dd698451ffe45cf3ed9', '1bc3bfbc7f5d27f5e7b98263f1af913767b15050', 0, '', 'Tom', 'Jones', 'tom@tom.com'),
(17, 1387501670, 1387501670, 'ed4239dad59fc1814aa9246493e62d4c3c5b1156', '306f1761ef35a51bf5998a0a2ce6c4a61f853dab', 0, '', 'Mike', 'Rowe', 'mike@mike.com'),
(18, 1387502052, 1387502052, '4ef486f10387b8c012dc2e230d12eec4f2a7b3fa', 'b158cda46d725eb1b5f68bf1594cc30422469419', 0, '', 'Mary', 'Smith', 'mary@mary.com'),
(19, 1387502347, 1387502347, '63b2d06a210f60fbd32d7009d9c340591f9964bf', 'fee30bfb0b08d7d65f019d9bc800fbab5beb064f', 0, '', 'Bob', 'Newhart', 'bob@bob.com'),
(20, 1387503067, 1387503067, 'cccd513403d92f97ec9e1dd91d889386df55d0d4', '3bd6c86c9aaecde691a424363f36f6a88ad65ae4', 0, '', 'Betty', 'Boop', 'betty@betty.com');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bricks`
--
ALTER TABLE `bricks`
  ADD CONSTRAINT `fk_bricks_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `interest`
--
ALTER TABLE `interest`
  ADD CONSTRAINT `interest_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `interest_ibfk_2` FOREIGN KEY (`brick_id`) REFERENCES `bricks` (`brick_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `profiles`
--
ALTER TABLE `profiles`
  ADD CONSTRAINT `fk_profile_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
