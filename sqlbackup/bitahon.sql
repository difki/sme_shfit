-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 20, 2015 at 05:37 PM
-- Server version: 5.6.25-0ubuntu0.15.04.1
-- PHP Version: 5.6.4-4ubuntu6.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bitahon`
--

-- --------------------------------------------------------

--
-- Table structure for table `ApprovedUser`
--

CREATE TABLE IF NOT EXISTS `ApprovedUser` (
  `id` bigint(9) NOT NULL,
  `Sname` varchar(20) DEFAULT NULL,
  `Lname` varchar(20) DEFAULT NULL,
  `telephone1` varchar(20) DEFAULT NULL,
  `telephone2` varchar(20) DEFAULT NULL,
  `mail` varchar(50) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `password` varchar(20) DEFAULT NULL,
  `role` varchar(20) DEFAULT NULL,
  `gpid` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ApprovedUser`
--

INSERT INTO `ApprovedUser` (`id`, `Sname`, `Lname`, `telephone1`, `telephone2`, `mail`, `address`, `password`, `role`, `gpid`) VALUES
(123, 'tal', 'almog', '1', '1', 'tal.almog@gmail.com', 'add', '1234', 'kabat', 1),
(312425036, 'Bar', 'Ifrah', NULL, NULL, NULL, NULL, '1234', 'admin', 0);

-- --------------------------------------------------------

--
-- Table structure for table `AssignedAt`
--

CREATE TABLE IF NOT EXISTS `AssignedAt` (
  `start` varchar(20) NOT NULL DEFAULT '',
  `end` varchar(20) NOT NULL DEFAULT '',
  `date` date NOT NULL DEFAULT '0000-00-00',
  `gpid` int(11) NOT NULL DEFAULT '0',
  `id` bigint(9) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Date`
--

CREATE TABLE IF NOT EXISTS `Date` (
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Event`
--

CREATE TABLE IF NOT EXISTS `Event` (
  `id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `norm` int(11) DEFAULT NULL,
  `location` varchar(50) DEFAULT NULL,
  `description` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `EventInDate`
--

CREATE TABLE IF NOT EXISTS `EventInDate` (
  `id` int(11) NOT NULL DEFAULT '0',
  `date` date NOT NULL DEFAULT '0000-00-00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `FavoriteShifts`
--

CREATE TABLE IF NOT EXISTS `FavoriteShifts` (
  `start` varchar(20) NOT NULL DEFAULT '',
  `end` varchar(20) NOT NULL DEFAULT '',
  `date` date NOT NULL DEFAULT '0000-00-00',
  `id` bigint(9) DEFAULT NULL,
  `rank` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `GuardPost`
--

CREATE TABLE IF NOT EXISTS `GuardPost` (
  `gpid` int(11) NOT NULL,
  `name` varchar(20) DEFAULT NULL,
  `norm` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `GuardPost`
--

INSERT INTO `GuardPost` (`gpid`, `name`, `norm`) VALUES
(0, 'global', 1),
(1, 'moked', 1);

-- --------------------------------------------------------

--
-- Table structure for table `Oncall`
--

CREATE TABLE IF NOT EXISTS `Oncall` (
  `start` varchar(20) NOT NULL DEFAULT '',
  `end` varchar(20) NOT NULL DEFAULT '',
  `date` date NOT NULL DEFAULT '0000-00-00',
  `gpid` int(11) NOT NULL DEFAULT '0',
  `id` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Permissions`
--

CREATE TABLE IF NOT EXISTS `Permissions` (
  `name` varchar(20) NOT NULL,
  `link` varchar(256) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Permissions`
--

INSERT INTO `Permissions` (`name`, `link`) VALUES
('add shift', 'http://www.ynet.co.il'),
('kabat', 'www.walla.co.il');

-- --------------------------------------------------------

--
-- Table structure for table `RangeDate`
--

CREATE TABLE IF NOT EXISTS `RangeDate` (
  `start` varchar(20) NOT NULL DEFAULT '',
  `end` varchar(20) NOT NULL DEFAULT '',
  `date` date NOT NULL DEFAULT '0000-00-00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `RangeH`
--

CREATE TABLE IF NOT EXISTS `RangeH` (
  `start` varchar(20) NOT NULL DEFAULT '',
  `end` varchar(20) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Role`
--

CREATE TABLE IF NOT EXISTS `Role` (
  `rolename` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Role`
--

INSERT INTO `Role` (`rolename`) VALUES
('admin'),
('kabat');

-- --------------------------------------------------------

--
-- Table structure for table `Shift`
--

CREATE TABLE IF NOT EXISTS `Shift` (
  `start` varchar(20) NOT NULL DEFAULT '',
  `end` varchar(20) NOT NULL DEFAULT '',
  `date` date NOT NULL DEFAULT '0000-00-00',
  `gpid` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `TestPersons`
--

CREATE TABLE IF NOT EXISTS `TestPersons` (
  `PersonID` int(11) DEFAULT NULL,
  `LastName` varchar(255) DEFAULT NULL,
  `FirstName` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `TestPersons`
--

INSERT INTO `TestPersons` (`PersonID`, `LastName`, `FirstName`) VALUES
(1, 'Ilya', 'Stoliar'),
(2, 'Tomer', 'Z'),
(2, 'Bar', 'Y'),
(4, 'G', 'T'),
(4, 'Tal', 'Almog'),
(8, 'Don', 'Bon'),
(5, 'Yosi', 'Gde'),
(17, 'Gabi', 'Tam');

-- --------------------------------------------------------

--
-- Table structure for table `TrainedAt`
--

CREATE TABLE IF NOT EXISTS `TrainedAt` (
  `id` bigint(9) NOT NULL DEFAULT '0',
  `gpid` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `User`
--

CREATE TABLE IF NOT EXISTS `User` (
  `id` bigint(9) NOT NULL,
  `Sname` varchar(20) DEFAULT NULL,
  `Lname` varchar(20) DEFAULT NULL,
  `telephone1` varchar(20) DEFAULT NULL,
  `telephone2` varchar(20) DEFAULT NULL,
  `mail` varchar(50) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `password` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `User`
--

INSERT INTO `User` (`id`, `Sname`, `Lname`, `telephone1`, `telephone2`, `mail`, `address`, `password`) VALUES
(123, 'tal', 'almog', '1', '1', 'tal.almog@gmail.com', 'add', '1234');

-- --------------------------------------------------------

--
-- Table structure for table `UserPermission`
--

CREATE TABLE IF NOT EXISTS `UserPermission` (
  `name` varchar(20) NOT NULL DEFAULT '',
  `rolename` varchar(20) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `UserPermission`
--

INSERT INTO `UserPermission` (`name`, `rolename`) VALUES
('add shift', 'kabat'),
('kabat', 'kabat');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ApprovedUser`
--
ALTER TABLE `ApprovedUser`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role` (`role`),
  ADD KEY `gpid` (`gpid`);

--
-- Indexes for table `AssignedAt`
--
ALTER TABLE `AssignedAt`
  ADD PRIMARY KEY (`start`,`end`,`date`,`gpid`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `Date`
--
ALTER TABLE `Date`
  ADD PRIMARY KEY (`date`);

--
-- Indexes for table `Event`
--
ALTER TABLE `Event`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `EventInDate`
--
ALTER TABLE `EventInDate`
  ADD PRIMARY KEY (`id`,`date`);

--
-- Indexes for table `FavoriteShifts`
--
ALTER TABLE `FavoriteShifts`
  ADD PRIMARY KEY (`start`,`end`,`date`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `GuardPost`
--
ALTER TABLE `GuardPost`
  ADD PRIMARY KEY (`gpid`);

--
-- Indexes for table `Oncall`
--
ALTER TABLE `Oncall`
  ADD PRIMARY KEY (`start`,`end`,`date`,`gpid`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `Permissions`
--
ALTER TABLE `Permissions`
  ADD PRIMARY KEY (`name`);

--
-- Indexes for table `RangeDate`
--
ALTER TABLE `RangeDate`
  ADD PRIMARY KEY (`start`,`end`,`date`),
  ADD KEY `date` (`date`);

--
-- Indexes for table `RangeH`
--
ALTER TABLE `RangeH`
  ADD PRIMARY KEY (`start`,`end`);

--
-- Indexes for table `Role`
--
ALTER TABLE `Role`
  ADD PRIMARY KEY (`rolename`);

--
-- Indexes for table `Shift`
--
ALTER TABLE `Shift`
  ADD PRIMARY KEY (`start`,`end`,`date`,`gpid`),
  ADD KEY `gpid` (`gpid`);

--
-- Indexes for table `TrainedAt`
--
ALTER TABLE `TrainedAt`
  ADD PRIMARY KEY (`id`,`gpid`),
  ADD KEY `gpid` (`gpid`);

--
-- Indexes for table `User`
--
ALTER TABLE `User`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `UserPermission`
--
ALTER TABLE `UserPermission`
  ADD PRIMARY KEY (`name`,`rolename`),
  ADD KEY `rolename` (`rolename`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `ApprovedUser`
--
ALTER TABLE `ApprovedUser`
  ADD CONSTRAINT `ApprovedUser_ibfk_1` FOREIGN KEY (`role`) REFERENCES `Role` (`rolename`) ON UPDATE CASCADE,
  ADD CONSTRAINT `ApprovedUser_ibfk_2` FOREIGN KEY (`gpid`) REFERENCES `GuardPost` (`gpid`) ON UPDATE CASCADE;

--
-- Constraints for table `AssignedAt`
--
ALTER TABLE `AssignedAt`
  ADD CONSTRAINT `AssignedAt_ibfk_1` FOREIGN KEY (`start`, `end`, `date`, `gpid`) REFERENCES `Shift` (`start`, `end`, `date`, `gpid`) ON DELETE CASCADE,
  ADD CONSTRAINT `AssignedAt_ibfk_2` FOREIGN KEY (`id`) REFERENCES `ApprovedUser` (`id`);

--
-- Constraints for table `EventInDate`
--
ALTER TABLE `EventInDate`
  ADD CONSTRAINT `EventInDate_ibfk_1` FOREIGN KEY (`id`) REFERENCES `Event` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `FavoriteShifts`
--
ALTER TABLE `FavoriteShifts`
  ADD CONSTRAINT `FavoriteShifts_ibfk_1` FOREIGN KEY (`id`) REFERENCES `ApprovedUser` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FavoriteShifts_ibfk_2` FOREIGN KEY (`start`, `end`, `date`) REFERENCES `RangeDate` (`start`, `end`, `date`);

--
-- Constraints for table `Oncall`
--
ALTER TABLE `Oncall`
  ADD CONSTRAINT `Oncall_ibfk_1` FOREIGN KEY (`start`, `end`, `date`, `gpid`) REFERENCES `Shift` (`start`, `end`, `date`, `gpid`) ON DELETE CASCADE,
  ADD CONSTRAINT `Oncall_ibfk_2` FOREIGN KEY (`id`) REFERENCES `ApprovedUser` (`id`);

--
-- Constraints for table `RangeDate`
--
ALTER TABLE `RangeDate`
  ADD CONSTRAINT `RangeDate_ibfk_1` FOREIGN KEY (`start`, `end`) REFERENCES `RangeH` (`start`, `end`) ON DELETE CASCADE,
  ADD CONSTRAINT `RangeDate_ibfk_2` FOREIGN KEY (`date`) REFERENCES `Date` (`date`) ON DELETE CASCADE;

--
-- Constraints for table `Shift`
--
ALTER TABLE `Shift`
  ADD CONSTRAINT `Shift_ibfk_1` FOREIGN KEY (`gpid`) REFERENCES `GuardPost` (`gpid`) ON UPDATE CASCADE,
  ADD CONSTRAINT `Shift_ibfk_2` FOREIGN KEY (`start`, `end`, `date`) REFERENCES `RangeDate` (`start`, `end`, `date`) ON DELETE CASCADE;

--
-- Constraints for table `TrainedAt`
--
ALTER TABLE `TrainedAt`
  ADD CONSTRAINT `TrainedAt_ibfk_1` FOREIGN KEY (`id`) REFERENCES `ApprovedUser` (`id`),
  ADD CONSTRAINT `TrainedAt_ibfk_2` FOREIGN KEY (`gpid`) REFERENCES `GuardPost` (`gpid`);

--
-- Constraints for table `UserPermission`
--
ALTER TABLE `UserPermission`
  ADD CONSTRAINT `UserPermission_ibfk_1` FOREIGN KEY (`name`) REFERENCES `Permissions` (`name`) ON DELETE CASCADE,
  ADD CONSTRAINT `UserPermission_ibfk_2` FOREIGN KEY (`rolename`) REFERENCES `Role` (`rolename`) ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
