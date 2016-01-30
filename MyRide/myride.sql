-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 30, 2016 at 02:58 PM
-- Server version: 5.6.24
-- PHP Version: 5.5.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `myride`
--

-- --------------------------------------------------------

--
-- Table structure for table `administartor`
--

CREATE TABLE IF NOT EXISTS `administartor` (
  `Admin_id` varchar(50) NOT NULL DEFAULT '',
  `Admin_Name` varchar(100) NOT NULL,
  `Admin_Password` varchar(100) NOT NULL,
  `Agence` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `agencies`
--

CREATE TABLE IF NOT EXISTS `agencies` (
  `AgencyId` int(11) NOT NULL,
  `Agency_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `bus`
--

CREATE TABLE IF NOT EXISTS `bus` (
  `Bus_id` varchar(50) NOT NULL,
  `Bus_Name` varchar(100) NOT NULL,
  `Bus_DriverId` varchar(50) NOT NULL,
  `Bus_RouteCode` varchar(50) NOT NULL,
  `Bus_Agency` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `busstatus`
--

CREATE TABLE IF NOT EXISTS `busstatus` (
  `Status_Id` int(11) NOT NULL,
  `Status` text NOT NULL,
  `Importance` varchar(20) NOT NULL,
  `date_Time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `busstops`
--

CREATE TABLE IF NOT EXISTS `busstops` (
  `Bus_Stop_Id` int(11) NOT NULL,
  `Bus_Stop_Name` varchar(100) NOT NULL,
  `RouteId` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `driver`
--

CREATE TABLE IF NOT EXISTS `driver` (
  `DriverId` varchar(50) NOT NULL,
  `Driver_Name` varchar(100) NOT NULL,
  `DriverBus_Id` varchar(50) NOT NULL,
  `Driver_RouteCode` varchar(50) NOT NULL,
  `Driver_Agence` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `googlemap`
--

CREATE TABLE IF NOT EXISTS `googlemap` (
  `Name` varchar(100) NOT NULL,
  `Adress` varchar(100) DEFAULT NULL,
  `Latitude` float NOT NULL,
  `Longitude` float NOT NULL,
  `Type` varchar(100) DEFAULT NULL,
  `MpId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `gpsdevise`
--

CREATE TABLE IF NOT EXISTS `gpsdevise` (
  `Device_Id` varchar(50) NOT NULL,
  `Name` varchar(100) NOT NULL,
  `Latitude` float NOT NULL,
  `Longitude` float NOT NULL,
  `adress` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE IF NOT EXISTS `payment` (
  `payment_Mode_id` int(11) NOT NULL,
  `payment_mode` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `rider`
--

CREATE TABLE IF NOT EXISTS `rider` (
  `Rider_Id` int(11) NOT NULL,
  `Rider_LocationName` varchar(150) NOT NULL,
  `Latitude` float NOT NULL,
  `Longitude` float NOT NULL,
  `Payment_Option` int(11) NOT NULL,
  `Amount_Paid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `routes`
--

CREATE TABLE IF NOT EXISTS `routes` (
  `Route_Code` varchar(50) NOT NULL,
  `Route_Name` varchar(100) NOT NULL,
  `StartRoute_Latitude` float NOT NULL,
  `StartRoute_longitude` float NOT NULL,
  `EndLongitude` int(11) NOT NULL,
  `EndLatitude` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `trafficupdate`
--

CREATE TABLE IF NOT EXISTS `trafficupdate` (
  `UpdateId` int(11) NOT NULL,
  `Updates_By` varchar(60) NOT NULL,
  `Update_Date_Time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `Update_Statement` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `administartor`
--
ALTER TABLE `administartor`
  ADD PRIMARY KEY (`Admin_id`);

--
-- Indexes for table `agencies`
--
ALTER TABLE `agencies`
  ADD PRIMARY KEY (`AgencyId`);

--
-- Indexes for table `busstatus`
--
ALTER TABLE `busstatus`
  ADD PRIMARY KEY (`Status_Id`);

--
-- Indexes for table `busstops`
--
ALTER TABLE `busstops`
  ADD PRIMARY KEY (`Bus_Stop_Id`);

--
-- Indexes for table `driver`
--
ALTER TABLE `driver`
  ADD PRIMARY KEY (`DriverId`);

--
-- Indexes for table `googlemap`
--
ALTER TABLE `googlemap`
  ADD PRIMARY KEY (`MpId`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`payment_Mode_id`);

--
-- Indexes for table `trafficupdate`
--
ALTER TABLE `trafficupdate`
  ADD PRIMARY KEY (`UpdateId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `agencies`
--
ALTER TABLE `agencies`
  MODIFY `AgencyId` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `busstatus`
--
ALTER TABLE `busstatus`
  MODIFY `Status_Id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `busstops`
--
ALTER TABLE `busstops`
  MODIFY `Bus_Stop_Id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `googlemap`
--
ALTER TABLE `googlemap`
  MODIFY `MpId` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `trafficupdate`
--
ALTER TABLE `trafficupdate`
  MODIFY `UpdateId` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
