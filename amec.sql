-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: May 09, 2022 at 04:57 AM
-- Server version: 5.7.34
-- PHP Version: 7.4.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `amec`
--

-- --------------------------------------------------------

--
-- Table structure for table `Drive`
--

CREATE TABLE `Drive` (
  `ID` int(6) UNSIGNED NOT NULL,
  `StartTime` datetime NOT NULL,
  `EndTime` datetime NOT NULL,
  `Mileage` decimal(4,2) NOT NULL,
  `DriverID` int(6) UNSIGNED DEFAULT NULL,
  `CoDriverID` int(6) UNSIGNED DEFAULT NULL,
  `DriveRoute` varchar(20) NOT NULL,
  `ShiftID` int(6) UNSIGNED DEFAULT NULL,
  `ProjectID` int(6) UNSIGNED DEFAULT NULL,
  `VIN` char(17) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Drive`
--

INSERT INTO `Drive` (`ID`, `StartTime`, `EndTime`, `Mileage`, `DriverID`, `CoDriverID`, `DriveRoute`, `ShiftID`, `ProjectID`, `VIN`) VALUES
(1, '2022-01-15 10:30:00', '2022-01-15 11:00:00', '25.00', 2, 3, 'Route 1', 1, 3, '5NPEC4ABXDH539433'),
(2, '2022-01-15 15:15:00', '2022-01-15 16:00:00', '30.00', 1, 4, 'Route 6 - New', 2, 1, '1FVACWCT67HY22127'),
(3, '2022-05-03 22:38:00', '2022-05-03 22:38:00', '16.00', 2, 4, 'New route', 33, 3, '3C8FY68B82T297664'),
(4, '1969-12-31 16:00:00', '2022-05-03 22:39:00', '16.00', 2, 4, 'New route', 33, 3, '3C8FY68B82T297664'),
(5, '2022-05-03 23:03:00', '2022-05-03 23:03:00', '24.00', 1, 3, 'New route', 34, 2, '3C8FY68B82T297664'),
(6, '2022-05-08 20:39:00', '2022-05-08 20:40:00', '20.00', 1, 4, 'Test route', 35, 3, '5NPEC4ABXDH539433');

-- --------------------------------------------------------

--
-- Table structure for table `Employee`
--

CREATE TABLE `Employee` (
  `ID` int(6) UNSIGNED NOT NULL,
  `FirstName` varchar(30) NOT NULL,
  `LastName` varchar(30) NOT NULL,
  `Email` varchar(40) NOT NULL,
  `Passcode` char(128) DEFAULT NULL,
  `Designation` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Employee`
--

INSERT INTO `Employee` (`ID`, `FirstName`, `LastName`, `Email`, `Passcode`, `Designation`) VALUES
(1, 'Daniel', 'Ricciardo', 'dricciardo@amec.com', 'password', 'Driver'),
(2, 'Charles', 'Leclerc', 'cleclerc@amec.com', 'password', 'Driver'),
(3, 'Carlos', 'Sainz', 'csainz@amec.com', 'password', 'Driver'),
(4, 'Lewis', 'Hamilton', 'lhamilton@amec.com', 'password', 'Driver'),
(5, 'Toto', 'Wolff', 'twolff@amec.com', 'password', 'Manager'),
(6, 'Christian', 'Horner', 'chorner@amec.com', 'password', 'Manager'),
(7, 'Guenther', 'Steiner', 'gsteiner@amec.com', 'password', 'Manager');

-- --------------------------------------------------------

--
-- Table structure for table `Project`
--

CREATE TABLE `Project` (
  `ID` int(6) UNSIGNED NOT NULL,
  `ProjectName` varchar(30) NOT NULL,
  `Designation` varchar(30) NOT NULL,
  `ManagerID` int(6) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Project`
--

INSERT INTO `Project` (`ID`, `ProjectName`, `Designation`, `ManagerID`) VALUES
(1, 'Long Beach McLaren', 'F1', 5),
(2, 'LA Porsche', 'F2', 6),
(3, 'San Diego Mercedes', 'F1', 5),
(4, 'LA Redbull', 'F2', 7);

-- --------------------------------------------------------

--
-- Table structure for table `Report`
--

CREATE TABLE `Report` (
  `ID` int(6) UNSIGNED NOT NULL,
  `IssueTime` datetime NOT NULL,
  `Mileage` decimal(4,2) NOT NULL,
  `Speed` decimal(5,2) NOT NULL,
  `Temperature` decimal(5,2) DEFAULT NULL,
  `TriggerValue` varchar(3) DEFAULT NULL,
  `RoadType` varchar(50) DEFAULT NULL,
  `RoadConditionNotes` varchar(100) DEFAULT NULL,
  `CustomerConcernLevel` int(2) NOT NULL,
  `Comments` text,
  `CreatedBy` int(6) UNSIGNED DEFAULT NULL,
  `DriveID` int(6) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Report`
--

INSERT INTO `Report` (`ID`, `IssueTime`, `Mileage`, `Speed`, `Temperature`, `TriggerValue`, `RoadType`, `RoadConditionNotes`, `CustomerConcernLevel`, `Comments`, `CreatedBy`, `DriveID`) VALUES
(2, '2022-01-15 11:15:00', '25.00', '98.55', '80.00', 'No', 'Freeway', 'Dry and hot', 6, 'Tires worn out very easily. Additional comments here.', 2, 1),
(3, '2022-01-15 16:15:00', '30.00', '80.00', '85.30', 'Yes', 'Expressway', 'Dry and hot', 1, 'Great drive by Daniel and Lewis! Gotta love the LA weather!', 1, 2),
(5, '2022-05-03 22:39:00', '16.00', '80.00', '75.00', 'No', 'Circuit', 'God knows', 9, 'My comments', 2, 4),
(6, '2022-05-03 23:03:00', '24.00', '100.00', '90.00', 'Yes', 'Street', 'Empty streets', 3, 'I was way too fast for the street but hey! I am Danny Ric! So I get a free pass. Also, I am adorable. Cheers, mate!', 1, 5),
(7, '2022-05-08 20:40:00', '20.00', '200.00', '80.00', 'Yes', 'Freeway', 'God knows', 3, 'This is my report.', 1, 6);

-- --------------------------------------------------------

--
-- Table structure for table `Shift`
--

CREATE TABLE `Shift` (
  `ID` int(6) UNSIGNED NOT NULL,
  `ShiftType` varchar(10) NOT NULL,
  `StartTime` datetime NOT NULL,
  `EndTime` datetime NOT NULL,
  `Comments` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Shift`
--

INSERT INTO `Shift` (`ID`, `ShiftType`, `StartTime`, `EndTime`, `Comments`) VALUES
(1, 'Morning', '2022-01-15 09:30:00', '2022-01-15 13:30:00', 'My shift notes'),
(2, 'Afternoon', '2022-01-15 14:00:00', '2022-01-15 17:00:00', 'My shift notes'),
(3, 'Evening', '2022-01-23 18:00:00', '2022-01-23 21:00:00', 'My shift notes'),
(4, 'Morning', '2022-05-01 22:40:00', '2022-05-01 23:40:00', 'Testing shift form'),
(5, 'Night', '2022-05-01 22:59:00', '2022-05-01 23:59:00', 'Testing shift form'),
(6, 'Night', '2022-05-01 22:59:00', '2022-05-01 23:59:00', 'Testing shift form'),
(7, 'Night', '2022-05-01 22:59:00', '2022-05-01 23:59:00', 'Testing shift form'),
(8, 'Morning', '2022-05-01 23:08:00', '2022-05-02 00:08:00', 'Testing shift form'),
(17, 'Morning', '2022-05-01 23:08:00', '2022-05-02 00:08:00', 'Testing shift form'),
(18, 'Morning', '2022-05-01 23:08:00', '2022-05-02 00:08:00', 'Testing shift form'),
(19, 'Morning', '2022-05-01 23:08:00', '2022-05-02 00:08:00', 'Testing shift form'),
(20, 'Morning', '2022-05-01 23:08:00', '2022-05-02 00:08:00', 'Testing shift form'),
(21, 'Morning', '2022-05-01 23:08:00', '2022-05-02 00:08:00', 'Testing shift form'),
(22, '', '1969-12-31 16:00:00', '1969-12-31 16:00:00', ''),
(24, 'Night', '2022-05-02 00:32:00', '2022-05-02 02:32:00', 'Testing shift form'),
(25, '', '1969-12-31 16:00:00', '1969-12-31 16:00:00', ''),
(26, 'Night', '2022-05-02 00:34:00', '2022-05-02 01:34:00', 'Testing shift form'),
(27, '', '1969-12-31 16:00:00', '1969-12-31 16:00:00', ''),
(28, 'Morning', '2022-05-02 00:43:00', '2022-05-02 01:43:00', 'Testing shift form'),
(29, 'Night', '2022-05-02 22:01:00', '2022-05-02 23:02:00', 'Testing shift form again'),
(30, 'Night', '2022-05-03 20:07:00', '2022-05-03 21:07:00', 'Testing shift form again'),
(31, 'Night', '2022-05-03 22:15:00', '2022-05-03 23:15:00', 'Testing shift form again'),
(32, 'Night', '2022-05-03 22:22:00', '2022-05-03 23:22:00', 'Testing shift form'),
(33, 'Evening', '2022-05-03 22:37:00', '2022-05-03 23:37:00', 'Testing shift form'),
(34, 'Afternoon', '2022-05-03 23:01:00', '2022-05-04 00:02:00', 'Testing shift form'),
(35, 'Evening', '2022-05-08 20:38:00', '2022-05-08 21:38:00', 'Testing shift form again');

-- --------------------------------------------------------

--
-- Table structure for table `Vehicle`
--

CREATE TABLE `Vehicle` (
  `VIN` char(17) NOT NULL,
  `Make` varchar(30) NOT NULL,
  `Model` varchar(30) NOT NULL,
  `Designation` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Vehicle`
--

INSERT INTO `Vehicle` (`VIN`, `Make`, `Model`, `Designation`) VALUES
('1FVACWCT67HY22127', 'Freightliner', 'M2', 'Truck'),
('3C8FY68B82T297664', 'Chrysler', 'PT Cruiser', 'Compact'),
('5NPEC4ABXDH539433', 'Hyundai', 'Sonata', 'Sedan');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Drive`
--
ALTER TABLE `Drive`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ShiftID` (`ShiftID`),
  ADD KEY `DriverID` (`DriverID`),
  ADD KEY `CoDriverID` (`CoDriverID`),
  ADD KEY `ProjectID` (`ProjectID`),
  ADD KEY `VIN` (`VIN`);

--
-- Indexes for table `Employee`
--
ALTER TABLE `Employee`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `Project`
--
ALTER TABLE `Project`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ManagerID` (`ManagerID`);

--
-- Indexes for table `Report`
--
ALTER TABLE `Report`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `CreatedBy` (`CreatedBy`),
  ADD KEY `DriveID` (`DriveID`);

--
-- Indexes for table `Shift`
--
ALTER TABLE `Shift`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `Vehicle`
--
ALTER TABLE `Vehicle`
  ADD PRIMARY KEY (`VIN`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Drive`
--
ALTER TABLE `Drive`
  MODIFY `ID` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `Employee`
--
ALTER TABLE `Employee`
  MODIFY `ID` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `Project`
--
ALTER TABLE `Project`
  MODIFY `ID` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `Report`
--
ALTER TABLE `Report`
  MODIFY `ID` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `Shift`
--
ALTER TABLE `Shift`
  MODIFY `ID` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Drive`
--
ALTER TABLE `Drive`
  ADD CONSTRAINT `drive_ibfk_1` FOREIGN KEY (`ShiftID`) REFERENCES `Shift` (`ID`),
  ADD CONSTRAINT `drive_ibfk_2` FOREIGN KEY (`DriverID`) REFERENCES `Employee` (`ID`),
  ADD CONSTRAINT `drive_ibfk_3` FOREIGN KEY (`CoDriverID`) REFERENCES `Employee` (`ID`),
  ADD CONSTRAINT `drive_ibfk_4` FOREIGN KEY (`ProjectID`) REFERENCES `Project` (`ID`),
  ADD CONSTRAINT `drive_ibfk_5` FOREIGN KEY (`VIN`) REFERENCES `Vehicle` (`VIN`);

--
-- Constraints for table `Project`
--
ALTER TABLE `Project`
  ADD CONSTRAINT `project_ibfk_1` FOREIGN KEY (`ManagerID`) REFERENCES `Employee` (`ID`);

--
-- Constraints for table `Report`
--
ALTER TABLE `Report`
  ADD CONSTRAINT `report_ibfk_1` FOREIGN KEY (`CreatedBy`) REFERENCES `Employee` (`ID`),
  ADD CONSTRAINT `report_ibfk_2` FOREIGN KEY (`DriveID`) REFERENCES `Drive` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
