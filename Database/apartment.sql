-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 02, 2021 at 08:43 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `apartment`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `no` int(10) NOT NULL,
  `aname` varchar(30) NOT NULL,
  `eMail` varchar(60) NOT NULL,
  `phoneNo` varchar(11) NOT NULL,
  `pwd` varchar(20) NOT NULL,
  `arrivalDate` date NOT NULL,
  `isActive` tinyint(1) NOT NULL DEFAULT 1,
  `leavingDate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`no`, `aname`, `eMail`, `phoneNo`, `pwd`, `arrivalDate`, `isActive`, `leavingDate`) VALUES
(1, 'Ramazan Halid', 'ramazan.halid.35@gmail.com', '12312312312', '123', '0000-00-00', 1, NULL),
(11, 'Melih Gunay', 'melihgunay07@gmail.com', '05396586586', '123123', '2021-01-15', 0, '2021-01-22'),
(12, 'Taha Yigit', 'taha07@gmail.com', '05475854558', '123123', '2021-01-26', 0, '2021-01-21'),
(13, 'Fatma Ramiz', 'fatmaramiz@gmail.com', '05079665856', '123123', '2021-01-22', 0, '2021-03-03');

-- --------------------------------------------------------

--
-- Table structure for table `announcement`
--

CREATE TABLE `announcement` (
  `announcementID` int(10) NOT NULL,
  `theText` text NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp(),
  `cTime` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `announcement`
--

INSERT INTO `announcement` (`announcementID`, `theText`, `date`, `cTime`) VALUES
(59, 'Aidatlari odeyin lutfen!', '2021-01-06', '2021-01-06 10:19:55'),
(60, 'Bir zahmet', '2021-01-06', '2021-01-06 10:20:09'),
(61, 'Melih hoca', '2021-01-06', '2021-01-06 12:14:02'),
(62, 'Duyuru Aidatlari odeyin lutfen!', '2021-01-06', '2021-01-06 20:13:23'),
(63, 'sdfsdfdsg\r\ndsfgdfgdfg\r\ndfg\r\ndfg\r\ndfg\r\ndf\r\ngdfgdfgdfgdf\r\ngdf\r\ngd\r\nfg\r\ndfg\r\ndf\r\ngd', '2021-01-22', '2021-01-22 14:55:51'),
(64, 'asdfasfasdf', '2021-02-01', '2021-01-31 21:33:53');

-- --------------------------------------------------------

--
-- Table structure for table `apartments`
--

CREATE TABLE `apartments` (
  `apartmentID` int(10) NOT NULL,
  `blok` varchar(15) NOT NULL,
  `doorNo` varchar(3) NOT NULL,
  `apartmentIsFull` tinyint(1) NOT NULL DEFAULT 1,
  `aUserID` int(11) NOT NULL,
  `aArrivalDate` date NOT NULL,
  `aLeavingDate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `apartments`
--

INSERT INTO `apartments` (`apartmentID`, `blok`, `doorNo`, `apartmentIsFull`, `aUserID`, `aArrivalDate`, `aLeavingDate`) VALUES
(30, 'A', '1', 1, 31, '2021-01-07', NULL),
(31, 'B', '10', 0, 32, '2021-01-25', '2021-01-08'),
(32, 'A', '6', 0, 33, '2021-01-10', '2021-01-21'),
(33, 'C', '5', 0, 34, '2021-01-09', '2021-01-08'),
(34, 'A', '3', 0, 35, '2021-01-07', '2021-01-29'),
(35, 'C', '14', 0, 36, '2021-01-19', '2021-02-24'),
(36, 'D', '9', 1, 37, '2021-01-16', NULL),
(37, 'B', '13', 0, 38, '2021-01-28', '2021-02-25'),
(38, 'D', '7', 1, 39, '2021-01-08', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `dues`
--

CREATE TABLE `dues` (
  `duesID` int(10) NOT NULL,
  `duesName` varchar(20) NOT NULL,
  `amount` int(11) NOT NULL,
  `duesDescription` varchar(50) NOT NULL,
  `adminNo` int(10) NOT NULL,
  `isActiveDues` tinyint(1) NOT NULL DEFAULT 1,
  `startsDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dues`
--

INSERT INTO `dues` (`duesID`, `duesName`, `amount`, `duesDescription`, `adminNo`, `isActiveDues`, `startsDate`) VALUES
(64, 'Aidat', 150, 'Genel', 1, 1, '2021-01-07'),
(65, 'Boya', 150, 'Apartman boyama parasi', 1, 1, '2021-01-28'),
(66, 'Aralik', 25, 'ara', 1, 1, '2021-01-06'),
(67, 'Ocak', 100, 'Ocak ayi aidat', 1, 1, '2021-02-05'),
(68, 'Subat', 175, 'Aidat', 1, 1, '2021-02-18'),
(69, 'irem', 33, 'waesrdwerf', 1, 1, '2021-01-21'),
(70, 'wddqwdirem', 332, 'waesrdwerf', 1, 1, '2021-01-21'),
(71, 'qweqwewddqwdirem', 3322, 'waesrdwerf', 1, 1, '2021-01-21'),
(72, 'wqdqwd', 12, 'dsfsf', 1, 1, '2021-01-28'),
(73, 'wqdqwd', 12, 'dsfsf', 1, 1, '2021-01-28'),
(74, 'ramo', 150, 'Boya icin top', 1, 1, '2021-01-28'),
(75, 'Ocak', 125, 'asdasd', 1, 1, '2021-01-30'),
(76, 'dsdfOcak', 125, 'asdasd', 1, 1, '2021-01-30');

-- --------------------------------------------------------

--
-- Table structure for table `outgoing`
--

CREATE TABLE `outgoing` (
  `outgoingID` int(10) NOT NULL,
  `oName` varchar(20) NOT NULL,
  `oAmount` int(11) NOT NULL,
  `oDescription` varchar(60) NOT NULL,
  `adminID` int(10) NOT NULL,
  `beginDate` date NOT NULL,
  `oWhenPaid` date DEFAULT NULL,
  `isItPaid` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `outgoing`
--

INSERT INTO `outgoing` (`outgoingID`, `oName`, `oAmount`, `oDescription`, `adminID`, `beginDate`, `oWhenPaid`, `isItPaid`) VALUES
(19, 'Boya', 150, 'Boya icin toplanacak para', 1, '2021-02-17', '2021-01-06', 1),
(20, 'gider', 125, 'Boya icin toplanacak para', 1, '2021-01-14', '2021-01-06', 1),
(21, 'Boya', 250, 'Boya icin toplanacak para', 1, '2021-01-28', '2021-01-22', 1),
(22, 'Boya parasi', 275, 'Boya icin toplanacak para', 1, '2021-01-30', '2021-01-06', 1),
(23, 'Ramazan', 2000, 'Boya icin toplanacak parafwefewfewf', 1, '2021-01-31', '2021-01-22', 1);

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `paymentID` int(10) NOT NULL,
  `userNo` int(10) NOT NULL,
  `isPaid` tinyint(1) NOT NULL DEFAULT 0,
  `duesID` int(10) NOT NULL,
  `whenPaid` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`paymentID`, `userNo`, `isPaid`, `duesID`, `whenPaid`) VALUES
(199, 31, 1, 74, '2021-01-22'),
(200, 35, 1, 74, '2021-01-22'),
(201, 37, 1, 74, '2021-02-01'),
(202, 38, 1, 74, '2021-01-16'),
(203, 39, 1, 74, '2021-02-01'),
(204, 31, 1, 75, '2021-01-22'),
(205, 35, 0, 75, NULL),
(206, 37, 1, 75, '2021-02-01'),
(207, 38, 1, 75, '2021-02-01'),
(208, 39, 1, 75, '2021-02-01'),
(209, 31, 0, 76, NULL),
(210, 35, 0, 76, NULL),
(211, 37, 1, 76, '2021-02-01'),
(212, 38, 0, 76, NULL),
(213, 39, 1, 76, '2021-02-01');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userID` int(11) NOT NULL,
  `uname` varchar(30) NOT NULL,
  `eMail` varchar(60) NOT NULL,
  `phoneNo` varchar(11) NOT NULL,
  `phoneNo2` varchar(11) DEFAULT NULL,
  `pwd` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userID`, `uname`, `eMail`, `phoneNo`, `phoneNo2`, `pwd`) VALUES
(31, 'Ramazan Halid', 'ramazan@gmail.com', '05079111139', '', '123123'),
(32, 'Mehmet Abdul', 'mehmet@gmail.com', '05389865658', '05248635696', '123123'),
(33, 'Fatma Turgut', 'fatma@gmail.com', '05396987585', '05696887936', '123123'),
(34, 'Remziye Aslan', 'remziye@gmail.com', '05365447857', '', '123123'),
(35, 'Melih Gunay', 'melihgunay@gmail.com', '05857896868', '05079778545', '123123123'),
(36, 'Taha Yigit', 'taha@gmail.com', '05396548746', '05396587425', '123123'),
(37, 'Aylin Gul', 'aylin@gmail.com', '05365678956', '05478552441', '123123'),
(38, 'Dilan Yilmaz', 'yilmazdilan@gmail.com', '05474203636', '05235236398', '123123'),
(39, 'Mersin Tantuni', 'mersin@gmail.com', '05447856986', '05366568987', '123');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`no`),
  ADD UNIQUE KEY `eMail` (`eMail`);

--
-- Indexes for table `announcement`
--
ALTER TABLE `announcement`
  ADD PRIMARY KEY (`announcementID`);

--
-- Indexes for table `apartments`
--
ALTER TABLE `apartments`
  ADD PRIMARY KEY (`apartmentID`),
  ADD KEY `A` (`aUserID`);

--
-- Indexes for table `dues`
--
ALTER TABLE `dues`
  ADD PRIMARY KEY (`duesID`),
  ADD KEY `D` (`adminNo`);

--
-- Indexes for table `outgoing`
--
ALTER TABLE `outgoing`
  ADD PRIMARY KEY (`outgoingID`),
  ADD KEY `adminID` (`adminID`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`paymentID`),
  ADD KEY `B` (`duesID`),
  ADD KEY `C` (`userNo`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `no` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `announcement`
--
ALTER TABLE `announcement`
  MODIFY `announcementID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `apartments`
--
ALTER TABLE `apartments`
  MODIFY `apartmentID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `dues`
--
ALTER TABLE `dues`
  MODIFY `duesID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT for table `outgoing`
--
ALTER TABLE `outgoing`
  MODIFY `outgoingID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `paymentID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=214;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `apartments`
--
ALTER TABLE `apartments`
  ADD CONSTRAINT `A` FOREIGN KEY (`aUserID`) REFERENCES `users` (`userID`);

--
-- Constraints for table `dues`
--
ALTER TABLE `dues`
  ADD CONSTRAINT `D` FOREIGN KEY (`adminNo`) REFERENCES `admins` (`no`);

--
-- Constraints for table `outgoing`
--
ALTER TABLE `outgoing`
  ADD CONSTRAINT `outgoing_ibfk_1` FOREIGN KEY (`adminID`) REFERENCES `admins` (`no`);

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `B` FOREIGN KEY (`duesID`) REFERENCES `dues` (`duesID`),
  ADD CONSTRAINT `C` FOREIGN KEY (`userNo`) REFERENCES `users` (`userID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
