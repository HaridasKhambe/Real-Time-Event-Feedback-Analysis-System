-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 25, 2024 at 05:32 PM
-- Server version: 8.0.35
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rtefa`
--

-- --------------------------------------------------------

--
-- Table structure for table `credentials`
--

CREATE TABLE `credentials` (
  `userId` varchar(255) NOT NULL COMMENT 'email-id',
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `usertype` varchar(50) NOT NULL,
  `fenable` tinyint(1) NOT NULL COMMENT 'feedback enable/disable'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `credentials`
--

INSERT INTO `credentials` (`userId`, `password`, `usertype`, `fenable`) VALUES
('aditya321@gmail.com', 'aditya!!!', 'admin', 1),
('akashsingh45@gmail.com', 'akash111', 'user', 1),
('Arnav321@gmal.com', 'Arnav!!!', 'user', 1),
('harry321@gmail.com', 'harry!!!', 'admin', 1),
('pramilmane345@gmail.com', 'pramil!!!', 'user', 1),
('sakshi321@gmail.com', 'sakshi!!!', 'admin', 1),
('sam321@gmail.com', 'Sam123!!!', 'user', 1),
('soham321@gmail.com', 'soham!!!', 'admin', 1),
('thomas234@gmail.com', 'Thomas!!!', 'user', 1);

-- --------------------------------------------------------

--
-- Table structure for table `efeedback`
--

CREATE TABLE `efeedback` (
  `eventId` bigint NOT NULL,
  `userId` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `dataTime` timestamp NOT NULL,
  `relevance` int NOT NULL,
  `clarity` int NOT NULL,
  `engagement` int NOT NULL,
  `interaction` int NOT NULL,
  `tech_quality` int NOT NULL,
  `overall_satisfaction` int NOT NULL,
  `comment` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `efeedback`
--

INSERT INTO `efeedback` (`eventId`, `userId`, `dataTime`, `relevance`, `clarity`, `engagement`, `interaction`, `tech_quality`, `overall_satisfaction`, `comment`) VALUES
(10, 'pramilmane345@gmail.com', '2024-04-25 02:58:07', 5, 5, 5, 5, 5, 5, 'Engaging and informative presentations!'),
(10, 'pramilmane345@gmail.com', '2024-04-25 02:58:49', 4, 3, 2, 2, 3, 3, 'Great networking opportunities.'),
(10, 'pramilmane345@gmail.com', '2024-04-25 02:59:36', 3, 2, 4, 2, 1, 4, 'Poor sound quality during the presentations.'),
(10, 'pramilmane345@gmail.com', '2024-04-25 03:00:23', 3, 3, 3, 2, 2, 2, 'Long waiting times for food.'),
(10, 'akashsingh45@gmail.com', '2024-04-25 03:09:31', 1, 2, 3, 5, 3, 3, 'event organization is not proper'),
(10, 'akashsingh45@gmail.com', '2024-04-25 03:10:52', 2, 1, 3, 5, 5, 5, 'best experience. thank you for organizers '),
(10, 'sam321@gmail.com', '2024-04-25 03:16:02', 4, 3, 3, 3, 3, 3, 'nice event. '),
(10, 'sam321@gmail.com', '2024-04-25 03:18:12', 1, 4, 1, 4, 4, 1, 'Long waiting times for food.');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `eventId` bigint NOT NULL,
  `title` varchar(255) NOT NULL,
  `dataTime` timestamp NOT NULL,
  `description` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`eventId`, `title`, `dataTime`, `description`, `location`, `status`) VALUES
(10, 'Career Development Workshop', '2024-04-24 03:00:00', 'Interactive sessions and panel discussions on career opportunities in technology.', 'Seminar Hall A, City College', 2),
(11, 'Hackathon: Code for Good', '2024-04-30 04:30:00', 'ntensive coding competition aimed at solving social challenges using technology.', 'Innovation Hub, Tech Park', 1),
(12, 'Health and Wellness Expo', '2024-04-24 19:00:00', 'A health-focused event featuring fitness demonstrations, nutrition workshops, and wellness product showcases.', 'Exhibition Center, Downtown Convention Center', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `credentials`
--
ALTER TABLE `credentials`
  ADD PRIMARY KEY (`userId`);

--
-- Indexes for table `efeedback`
--
ALTER TABLE `efeedback`
  ADD KEY `eventId` (`eventId`),
  ADD KEY `userId` (`userId`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`eventId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `eventId` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `efeedback`
--
ALTER TABLE `efeedback`
  ADD CONSTRAINT `efeedback_ibfk_1` FOREIGN KEY (`eventId`) REFERENCES `events` (`eventId`),
  ADD CONSTRAINT `efeedback_ibfk_2` FOREIGN KEY (`userId`) REFERENCES `credentials` (`userId`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
