-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 24, 2024 at 07:13 PM
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
('akshatakhambe97@gmail.com', 'Akshata!!!', 'user', 1),
('haarrykhambe2003@gmail.com', 'harry!!!', 'user', 0),
('harsh123@gmail.com', '12345678', 'user', 1),
('harshal234@gmail.com', 'Harsha123456', 'user', 1),
('omkartupe@gmail.com', 'Omkar!!!', 'admin', 1),
('ruhi@gmail.com', '123445678jh', 'user', 1),
('sakshi321@gmail.com', 'sakshi!!!', 'admin', 1),
('sakshikhambe@gmail.com', '123456789', 'user', 1),
('soham321@gmail.com', 'soham!!!', 'admin', 0);

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
(1, 'haarrykhambe2003@gmail.com', '2024-04-19 14:47:56', 3, 3, 3, 3, 2, 5, NULL),
(1, 'haarrykhambe2003@gmail.com', '2024-04-19 14:49:05', 4, 1, 5, 4, 1, 2, NULL),
(1, 'haarrykhambe2003@gmail.com', '2024-04-19 14:50:59', 5, 5, 2, 3, 4, 1, NULL),
(1, 'haarrykhambe2003@gmail.com', '2024-04-19 14:51:14', 5, 5, 2, 3, 5, 1, NULL),
(5, 'sakshi321@gmail.com', '2024-04-19 15:21:08', 2, 3, 1, 3, 2, 5, NULL),
(1, 'sakshi321@gmail.com', '2024-04-21 15:09:52', 2, 4, 5, 2, 3, 4, 'all is well organized'),
(1, 'soham321@gmail.com', '2024-04-21 15:10:38', 2, 1, 3, 4, 5, 2, 'all is ok'),
(1, 'haarrykhambe2003@gmail.com', '2024-04-21 15:11:14', 2, 4, 1, 2, 1, 3, 'event was very fantastic'),
(1, 'aditya321@gmail.com', '2024-04-21 15:39:34', 2, 2, 4, 3, 4, 2, 'this is an excellent event I have seen over now ! We gain lot of real world experience from this value able event. Thank you so much for all of you team.'),
(1, 'haarrykhambe2003@gmail.com', '2024-04-22 02:20:06', 2, 2, 4, 4, 4, 3, 'good'),
(1, 'haarrykhambe2003@gmail.com', '2024-04-22 05:54:05', 4, 4, 5, 3, 2, 3, 'good'),
(1, 'haarrykhambe2003@gmail.com', '2024-04-22 05:54:44', 3, 2, 4, 1, 5, 2, 'great job'),
(1, 'harshal234@gmail.com', '2024-04-22 05:56:42', 3, 1, 1, 1, 1, 2, ''),
(1, 'sakshi321@gmail.com', '2024-04-22 14:34:20', 3, 4, 2, 4, 1, 5, 'please solve the problem of speakers'),
(8, 'haarrykhambe2003@gmail.com', '2024-04-22 14:43:47', 3, 4, 5, 3, 3, 3, 'appreciate with such events. Jay ShreeRam, Jay Hanumann');

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
(1, 'abcd', '2024-04-17 02:30:00', 'ABCD event will sharp start at 8:00 AM at KARDE BEACH. Be present\r\n', 'KARDE BEACH\r\n\r\n', 1),
(5, 'ram navami 2', '2024-04-17 05:30:00', '2nd event for cs 2 B', 'jspm auditorium ', 2),
(8, 'Hanuman Jayanti', '2024-04-23 04:30:00', 'this is event for all the sanatani hindi', 'Hanuman Mandir Tathawade', 1);

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
  MODIFY `eventId` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

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
