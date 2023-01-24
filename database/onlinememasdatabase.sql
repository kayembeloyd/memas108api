-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 24, 2023 at 06:06 AM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `onlinememasdatabase`
--

-- --------------------------------------------------------

--
-- Table structure for table `avatarstable`
--

CREATE TABLE `avatarstable` (
  `id` int(11) NOT NULL,
  `name` varchar(256) DEFAULT NULL,
  `uploaded` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `databaselogstable`
--

CREATE TABLE `databaselogstable` (
  `id` int(11) NOT NULL,
  `createdByUserId` int(11) DEFAULT NULL,
  `createdAt` date DEFAULT NULL,
  `object` varchar(256) DEFAULT NULL,
  `objectId` int(11) DEFAULT NULL,
  `beforeUpdateDatabaseVersion` int(11) DEFAULT NULL,
  `statementExecuted` varchar(256) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `databaseversiontable`
--

CREATE TABLE `databaseversiontable` (
  `id` int(11) NOT NULL,
  `databaseVersion` int(11) DEFAULT NULL,
  `uploaded` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `defaultmaintenacelogdata`
--

CREATE TABLE `defaultmaintenacelogdata` (
  `id` int(11) NOT NULL,
  `name` varchar(256) DEFAULT NULL,
  `equipmentId` int(11) DEFAULT NULL,
  `uploaded` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `departmentstable`
--

CREATE TABLE `departmentstable` (
  `id` int(11) NOT NULL,
  `name` varchar(256) DEFAULT NULL,
  `uploaded` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `equipmentstatusoptionstable`
--

CREATE TABLE `equipmentstatusoptionstable` (
  `id` int(11) NOT NULL,
  `name` varchar(256) DEFAULT NULL,
  `uploaded` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `equipmenttable`
--

CREATE TABLE `equipmenttable` (
  `id` int(11) NOT NULL,
  `name` varchar(256) DEFAULT NULL,
  `assetTag` varchar(256) DEFAULT NULL,
  `departmentId` int(11) DEFAULT NULL,
  `make` varchar(256) DEFAULT NULL,
  `model` varchar(256) DEFAULT NULL,
  `serialNumber` varchar(256) DEFAULT NULL,
  `commissionDate` date DEFAULT NULL,
  `lastMaintenanceDate` date DEFAULT NULL,
  `nextMaintenanceDate` date DEFAULT NULL,
  `statusOptionId` int(11) DEFAULT NULL,
  `uploaded` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `maintenancelogdatatable`
--

CREATE TABLE `maintenancelogdatatable` (
  `id` int(11) NOT NULL,
  `name` varchar(256) DEFAULT NULL,
  `value` text DEFAULT NULL,
  `maintenanceLogId` int(11) DEFAULT NULL,
  `uploaded` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `maintenancelogstable`
--

CREATE TABLE `maintenancelogstable` (
  `id` int(11) NOT NULL,
  `equipmentId` int(11) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `doneByUserId` int(11) DEFAULT NULL,
  `type` varchar(256) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `uploaded` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `technicalspecificationstable`
--

CREATE TABLE `technicalspecificationstable` (
  `id` int(11) NOT NULL,
  `name` text DEFAULT NULL,
  `value` text DEFAULT NULL,
  `equipmentId` int(11) DEFAULT NULL,
  `uploaded` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `userstable`
--

CREATE TABLE `userstable` (
  `id` int(11) NOT NULL,
  `username` varchar(256) DEFAULT NULL,
  `password` text DEFAULT NULL,
  `avatarId` int(11) DEFAULT NULL,
  `name` varchar(256) DEFAULT NULL,
  `position` varchar(256) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `avatarstable`
--
ALTER TABLE `avatarstable`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `databaselogstable`
--
ALTER TABLE `databaselogstable`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `databaseversiontable`
--
ALTER TABLE `databaseversiontable`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `defaultmaintenacelogdata`
--
ALTER TABLE `defaultmaintenacelogdata`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `departmentstable`
--
ALTER TABLE `departmentstable`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `equipmentstatusoptionstable`
--
ALTER TABLE `equipmentstatusoptionstable`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `equipmenttable`
--
ALTER TABLE `equipmenttable`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `maintenancelogdatatable`
--
ALTER TABLE `maintenancelogdatatable`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `maintenancelogstable`
--
ALTER TABLE `maintenancelogstable`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `technicalspecificationstable`
--
ALTER TABLE `technicalspecificationstable`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `userstable`
--
ALTER TABLE `userstable`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `avatarstable`
--
ALTER TABLE `avatarstable`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `databaselogstable`
--
ALTER TABLE `databaselogstable`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `databaseversiontable`
--
ALTER TABLE `databaseversiontable`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `defaultmaintenacelogdata`
--
ALTER TABLE `defaultmaintenacelogdata`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `departmentstable`
--
ALTER TABLE `departmentstable`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `equipmentstatusoptionstable`
--
ALTER TABLE `equipmentstatusoptionstable`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `equipmenttable`
--
ALTER TABLE `equipmenttable`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `maintenancelogdatatable`
--
ALTER TABLE `maintenancelogdatatable`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `maintenancelogstable`
--
ALTER TABLE `maintenancelogstable`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `technicalspecificationstable`
--
ALTER TABLE `technicalspecificationstable`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `userstable`
--
ALTER TABLE `userstable`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
