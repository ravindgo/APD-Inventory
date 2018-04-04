-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 25, 2017 at 09:13 AM
-- Server version: 5.7.14
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `apd`
--

-- --------------------------------------------------------

--
-- Table structure for table `indent_table`
--

CREATE TABLE `indent_table` (
  `Indent_Id` int(11) NOT NULL,
  `Description` longtext,
  `Units` longtext,
  `State` varchar(50) NOT NULL,
  `User_Type` varchar(50) NOT NULL,
  `TechName` varchar(100) NOT NULL,
  `Product_Id` varchar(20) DEFAULT NULL,
  `Name` varchar(500) DEFAULT NULL,
  `Raised_Date` date DEFAULT NULL,
  `Approved_Date` date DEFAULT NULL,
  `Patient_Id` int(11) DEFAULT NULL,
  `Camp_Name` mediumtext,
  `Comments` mediumtext
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `indent_table`
--

INSERT INTO `indent_table` (`Indent_Id`, `Description`, `Units`, `State`, `User_Type`, `TechName`, `Product_Id`, `Name`, `Raised_Date`, `Approved_Date`, `Patient_Id`, `Camp_Name`, `Comments`) VALUES
(1, NULL, 'height 10cm', 'Approved', 'Store Keeper', 'Fieldtech', 'M-2', NULL, '2017-10-25', '2017-10-25', 1, 'Bangalore', 'approved'),
(2, NULL, 'width 100cm', 'Approved', 'Store Keeper', 'Fieldtech', 'M-6', NULL, '2017-10-25', '2017-10-25', 2, '', ''),
(3, NULL, 'no 5', 'Approved', 'Admin', 'Fieldtech', 'O-1', NULL, '2017-10-25', '2017-10-25', 3, '', ''),
(4, NULL, 'feet 6', 'Rejected', 'Admin', 'Fieldtech', 'P-2', NULL, '2017-10-25', '2017-10-25', 4, 'Gadag', ''),
(5, NULL, 'length 3m', 'Approved', 'Admin', 'Fieldtech', 'P-4', NULL, '2017-10-25', '2017-10-25', 5, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `patient_details`
--

CREATE TABLE `patient_details` (
  `Patient_Id` int(11) NOT NULL,
  `Patient_Name` varchar(30) NOT NULL,
  `Age` int(11) NOT NULL,
  `Disease` text,
  `Address` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `patient_details`
--

INSERT INTO `patient_details` (`Patient_Id`, `Patient_Name`, `Age`, `Disease`, `Address`) VALUES
(1, 'a', 34, NULL, NULL),
(2, 'C', 36, NULL, ''),
(3, 'B', 45, NULL, NULL),
(4, 'D', 23, NULL, NULL),
(5, 'E', 45, NULL, NULL),
(6, 'g', 34, NULL, NULL),
(7, 'E', 34, NULL, NULL),
(8, 'G', 56, NULL, NULL),
(9, 'h', 34, NULL, NULL),
(10, 'i', 45, NULL, '');

-- --------------------------------------------------------

--
-- Table structure for table `prefab_indent_table`
--

CREATE TABLE `prefab_indent_table` (
  `Pre_Id` int(11) NOT NULL,
  `Description` longtext,
  `Units` longtext,
  `State` varchar(50) NOT NULL,
  `User_Type` varchar(50) NOT NULL,
  `TechName` varchar(100) NOT NULL,
  `Name` varchar(500) DEFAULT NULL,
  `Raised_Date` date DEFAULT NULL,
  `Approved_Date` date DEFAULT NULL,
  `Patient_Id` int(11) DEFAULT NULL,
  `Camp_Name` mediumtext,
  `Comments` mediumtext
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `prefab_indent_table`
--

INSERT INTO `prefab_indent_table` (`Pre_Id`, `Description`, `Units`, `State`, `User_Type`, `TechName`, `Name`, `Raised_Date`, `Approved_Date`, `Patient_Id`, `Camp_Name`, `Comments`) VALUES
(1, NULL, 'width 1', 'Approved', 'Store Keeper', 'Fieldtech', 'Axilary Crutches Large', '2017-10-25', '2017-10-25', 6, 'Hubli', ''),
(2, NULL, '1m', 'Rejected', 'Admin', 'Fieldtech', 'Crutches Bush Black 1', '2017-10-25', '2017-10-25', 7, '', ''),
(3, NULL, '3m', 'Rejected', 'Store Keeper', 'Fieldtech', 'Knee cap Small', '2017-10-25', '2017-10-25', 8, '', ''),
(4, NULL, 'size 10cm', 'Approved', 'Admin', 'Fieldtech', 'Watches', '2017-10-25', '2017-10-25', 9, '', ''),
(5, NULL, '20cm', 'Raised', 'Field Technician', 'Fieldtech', 'Colar Soft', '2017-10-25', NULL, 10, '', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pre_fabricated_entity`
--

CREATE TABLE `pre_fabricated_entity` (
  `Id` int(11) NOT NULL,
  `Name` varchar(500) NOT NULL,
  `Quantity` int(11) DEFAULT NULL,
  `Amount` int(11) DEFAULT NULL,
  `Added_Date` date DEFAULT NULL,
  `Used_Date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pre_fabricated_entity`
--

INSERT INTO `pre_fabricated_entity` (`Id`, `Name`, `Quantity`, `Amount`, `Added_Date`, `Used_Date`) VALUES
(1, 'Axilary Crutches Large', NULL, NULL, NULL, NULL),
(2, 'Axilary Crutch Small', NULL, NULL, NULL, NULL),
(3, 'Axilary Crutch Medium', NULL, NULL, NULL, NULL),
(4, 'Ad Belt', NULL, NULL, NULL, NULL),
(5, 'Colar Soft', NULL, NULL, NULL, NULL),
(6, 'Crutches Bush Visco', NULL, NULL, NULL, NULL),
(7, 'Crutches Bush Black 5/8', NULL, NULL, NULL, NULL),
(8, 'Crutches Bush Black 3/4', NULL, NULL, NULL, NULL),
(9, 'Crutches Bush Black 7/8', NULL, NULL, NULL, NULL),
(10, 'Crutches Bush Black 1"', NULL, NULL, NULL, NULL),
(11, 'Crutches Bush Visco 1*1/4', NULL, NULL, NULL, NULL),
(12, 'Elbow Crutches Small', NULL, NULL, NULL, NULL),
(13, 'Elbow Crutches Large', NULL, NULL, NULL, NULL),
(14, 'Finger Exercise', NULL, NULL, NULL, NULL),
(15, 'Dynamic Cockup Splint', NULL, NULL, NULL, NULL),
(16, 'Knee cap Small', NULL, NULL, NULL, NULL),
(17, 'Knee cap Medium', NULL, NULL, NULL, NULL),
(18, 'Knee cap Large', NULL, NULL, NULL, NULL),
(19, 'Knee Neoropian Knee Brace Small', NULL, NULL, NULL, NULL),
(20, 'Knee Neoropian Knee Brace Medium', NULL, NULL, NULL, NULL),
(21, 'Knee Neoropian Knee Brace Large ', NULL, NULL, NULL, NULL),
(22, 'Knee Neoropian Knee Brace  XL', NULL, NULL, NULL, NULL),
(23, 'K.T.Braze', NULL, NULL, NULL, NULL),
(24, 'L.S Belts Small', NULL, NULL, NULL, NULL),
(25, 'L.S Belts Medium', NULL, NULL, NULL, NULL),
(26, 'L.S.Belts Large', NULL, NULL, NULL, NULL),
(27, 'L.S.Belts XL', NULL, NULL, NULL, NULL),
(28, 'Mirror', NULL, NULL, NULL, NULL),
(29, 'Pouch Arms Sling Small', NULL, NULL, NULL, NULL),
(30, 'Pouch Arms Sling Meduim', NULL, NULL, NULL, NULL),
(31, 'Pouch Arms Sling Large', NULL, NULL, NULL, NULL),
(32, 'Pelvik Traction Kit', NULL, NULL, NULL, NULL),
(33, 'Pettala Knee Bindar', NULL, NULL, NULL, NULL),
(34, 'Rolator', NULL, NULL, NULL, NULL),
(35, 'Swich Ball', NULL, NULL, NULL, NULL),
(36, 'Test Belt', NULL, NULL, NULL, NULL),
(37, 'Tennis Elbow Band', NULL, NULL, NULL, NULL),
(38, 'Visco Toilet Commode', NULL, NULL, NULL, NULL),
(39, 'Tonmatic Exercise', NULL, NULL, NULL, NULL),
(40, 'Therapy Items', NULL, NULL, NULL, NULL),
(41, 'Visco Wheel 8"', NULL, NULL, NULL, NULL),
(42, 'Visco Wheel big', NULL, NULL, NULL, NULL),
(43, 'Varicosvein Stocking Small', NULL, NULL, NULL, NULL),
(44, 'Varicosvein Stocking Medium', NULL, NULL, NULL, NULL),
(45, 'Varicoscein Stocking Large', NULL, NULL, NULL, NULL),
(46, 'Walking Stick Singale', NULL, NULL, NULL, NULL),
(47, 'Walking Stick Q.Poid', NULL, NULL, NULL, NULL),
(48, 'Walking Stick T.Poid', NULL, NULL, NULL, NULL),
(49, 'Walker Foldable Visco', NULL, NULL, NULL, NULL),
(50, 'Walker Foldable others', NULL, NULL, NULL, NULL),
(51, 'Walker Non Foldable', NULL, NULL, NULL, NULL),
(52, 'Walker Visco Small', NULL, NULL, NULL, NULL),
(53, 'White Cane Foldable', NULL, NULL, NULL, NULL),
(54, 'Watches', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product_details`
--

CREATE TABLE `product_details` (
  `Product_Id` varchar(20) NOT NULL,
  `Product_Name` mediumtext NOT NULL,
  `Quantity` int(11) DEFAULT NULL,
  `Amount` int(11) DEFAULT NULL,
  `Added_Date` date DEFAULT NULL,
  `Used_Date` date DEFAULT NULL,
  `Product_Path` varchar(100) DEFAULT NULL,
  `Product_Description` longtext
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_details`
--

INSERT INTO `product_details` (`Product_Id`, `Product_Name`, `Quantity`, `Amount`, `Added_Date`, `Used_Date`, `Product_Path`, `Product_Description`) VALUES
('F-1', 'Surgical Shoe', NULL, NULL, NULL, NULL, 'images/surgicalShoe.png', NULL),
('F-2', 'MCR Chapel & Sandal', NULL, NULL, NULL, NULL, 'images/mcrSandal.png', NULL),
('M-1', 'Rolater', NULL, NULL, NULL, NULL, 'images/rolater.png', NULL),
('M-2', 'Cornor Chair', NULL, NULL, NULL, NULL, 'images/cornorChair.png', NULL),
('M-3', 'Standing Frame', NULL, NULL, NULL, NULL, 'images/standingChair.png', NULL),
('M-4', 'Commode', NULL, NULL, NULL, NULL, 'images/commode.png', NULL),
('M-5', 'Posterior Walker', NULL, NULL, NULL, NULL, 'images/pWalker.png', NULL),
('M-6', 'Special Modified Seat', NULL, NULL, NULL, NULL, 'images/specialModifiedSeat.png', NULL),
('M-7', 'Tricycle', NULL, NULL, NULL, NULL, 'images/tricycle.png', NULL),
('O-1', 'Ankle Foot Orthosis (AFO)', NULL, NULL, NULL, NULL, 'images/afo.png', NULL),
('O-2', 'Knee Ankle Foot Orthosis (KAFO)', NULL, NULL, NULL, NULL, 'images/kafo.png', NULL),
('O-3', 'Hip Knee Ankle Foot Orthosis (HKAFO)', NULL, NULL, NULL, NULL, 'images/hkafo.png', NULL),
('O-4', 'Gaiters', NULL, NULL, NULL, NULL, 'images/gaiters.png', NULL),
('O-5', 'Cock-up Splint', NULL, NULL, NULL, NULL, 'images/splint.png', NULL),
('O-6', 'Body Brace', NULL, NULL, NULL, NULL, 'images/bodyBrace.png', NULL),
('O-7', 'Knight Taylor Brace', NULL, NULL, NULL, NULL, 'images/taylorBrace.png', NULL),
('P-1', 'Below Elbow  Prosthetic (Functional)', NULL, NULL, NULL, NULL, 'images/belowElbow.png', NULL),
('P-2', 'Below Knee Prosthetic', NULL, NULL, NULL, NULL, 'images/belowKnee.png', NULL),
('P-3', 'Above Knee Prosthetic', NULL, NULL, NULL, NULL, 'images/aboveknee.png', NULL),
('P-4', 'Above elbow Prosthetic (Cosmetic)', NULL, NULL, NULL, NULL, 'images/aboveElbow.png', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product_mapping_details`
--

CREATE TABLE `product_mapping_details` (
  `Product_Id` varchar(20) NOT NULL,
  `R_Id` int(11) NOT NULL,
  `Map_Quantity` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_mapping_details`
--

INSERT INTO `product_mapping_details` (`Product_Id`, `R_Id`, `Map_Quantity`) VALUES
('O-1', 1, 11),
('O-1', 2, 7),
('O-1', 3, 2),
('O-1', 4, 5),
('O-1', 5, 3),
('O-1', 6, 0.25),
('O-1', 7, 0.5),
('O-1', 8, 0.5),
('O-1', 9, 0.5),
('O-1', 10, 0.5),
('O-1', 11, 0.5),
('O-1', 12, 0.25),
('O-1', 13, 10),
('O-1', 14, 0),
('O-1', 15, 1),
('O-1', 16, 1),
('O-1', 17, 0.25),
('O-1', 18, 0.5),
('O-1', 19, 2),
('O-1', 20, 2),
('O-1', 21, 12),
('O-1', 22, 6),
('O-1', 23, 6),
('O-1', 24, 3),
('O-2', 1, 11),
('O-2', 2, 7),
('O-2', 3, 2),
('O-2', 4, 5),
('O-2', 5, 3),
('O-2', 25, 3),
('O-2', 6, 0.25),
('O-2', 7, 0.5),
('O-2', 26, 2),
('O-2', 8, 0.5),
('O-2', 9, 0.5),
('O-2', 10, 0.5),
('O-2', 11, 0.5),
('O-2', 12, 0.25),
('O-2', 13, 10),
('O-2', 27, 8),
('O-2', 14, 0),
('O-2', 15, 1),
('O-2', 16, 1),
('O-2', 17, 0.25),
('O-2', 18, 0.5),
('O-2', 19, 2),
('O-2', 20, 2),
('O-2', 21, 12),
('O-2', 22, 6),
('O-2', 23, 6),
('O-2', 24, 3),
('O-3', 1, 11),
('O-3', 2, 7),
('O-3', 4, 5),
('O-3', 3, 2),
('O-3', 5, 3),
('O-3', 28, 1),
('O-3', 29, 30),
('O-3', 25, 3),
('O-3', 6, 0.25),
('O-3', 7, 0.5),
('O-3', 26, 2),
('O-3', 8, 0.5),
('O-3', 9, 0.5),
('O-3', 10, 0.5),
('O-3', 11, 0.5),
('O-3', 12, 0.25),
('O-3', 13, 10),
('O-3', 27, 8),
('O-3', 14, 0),
('O-3', 15, 1),
('O-3', 16, 1),
('O-3', 17, 0.25),
('O-3', 18, 0.5),
('O-3', 19, 2),
('O-3', 20, 2),
('O-3', 21, 12),
('O-3', 22, 6),
('O-3', 23, 6),
('O-3', 24, 3),
('O-4', 30, 0.5),
('O-4', 31, 1),
('O-4', 7, 0.5),
('O-4', 33, 1),
('O-4', 32, 2),
('O-4', 34, 2),
('O-4', 14, 0),
('O-4', 35, 2),
('O-4', 36, 2),
('O-4', 24, 3),
('O-5', 1, 11),
('O-5', 2, 7),
('O-5', 4, 5),
('O-5', 37, 1.5),
('O-5', 6, 0.25),
('O-5', 7, 0.5),
('O-5', 8, 0.5),
('O-5', 9, 0.5),
('O-5', 10, 0.5),
('O-5', 11, 0.5),
('O-5', 13, 10),
('O-5', 14, 0),
('O-5', 24, 3),
('O-6', 1, 11),
('O-6', 2, 7),
('O-6', 4, 5),
('O-6', 37, 1.5),
('O-6', 6, 0.25),
('O-6', 7, 0.5),
('O-6', 8, 0.5),
('O-6', 9, 0.5),
('O-6', 10, 0.5),
('O-6', 11, 0.5),
('O-6', 13, 10),
('O-6', 14, 0),
('O-6', 15, 1),
('O-6', 16, 1),
('O-6', 17, 0.25),
('O-6', 31, 1),
('O-6', 18, 0.5),
('O-6', 23, 6),
('O-6', 24, 3),
('P-3', 1, 11),
('P-3', 2, 7),
('P-3', 3, 2),
('P-3', 4, 5),
('P-3', 25, 3),
('P-3', 44, 2),
('P-3', 39, 1),
('P-3', 45, 1),
('P-3', 42, 20),
('P-3', 21, 12),
('P-3', 27, 8),
('P-3', 43, 0.75),
('P-3', 7, 0.5),
('P-3', 14, 0),
('P-3', 24, 3),
('P-2', 1, 11),
('P-2', 2, 7),
('P-3', 3, 2),
('P-2', 4, 5),
('P-2', 25, 3),
('P-2', 38, 1),
('P-2', 39, 1),
('P-2', 40, 1),
('P-2', 41, 6),
('P-2', 42, 20),
('P-2', 43, 0.75),
('P-2', 7, 0.5),
('P-2', 14, 0),
('P-2', 24, 3),
('P-1', 1, 11),
('P-1', 2, 7),
('P-1', 3, 2),
('P-1', 4, 5),
('P-1', 25, 3),
('P-1', 38, 1),
('P-1', 29, 30),
('P-1', 46, 1),
('P-1', 21, 12),
('P-1', 47, 1),
('P-1', 7, 0.5),
('P-1', 14, 0),
('P-1', 24, 3),
('P-4', 1, 11),
('P-4', 2, 7),
('P-4', 3, 2),
('P-4', 4, 5),
('P-4', 25, 3),
('P-4', 49, 1),
('P-4', 29, 30),
('P-4', 46, 1),
('P-4', 21, 12),
('P-4', 7, 0.5),
('P-4', 14, 0),
('P-4', 24, 3),
('F-1', 29, 30),
('F-1', 51, 1),
('F-1', 52, 1),
('F-1', 53, 1),
('F-1', 54, 20),
('F-1', 55, 0.25),
('F-1', 14, 0),
('F-1', 24, 3),
('F-2', 29, 30),
('F-2', 50, 35),
('F-2', 52, 1),
('F-2', 32, 2),
('F-2', 34, 2),
('F-2', 56, 0.4),
('F-2', 14, 0),
('F-2', 24, 3),
('M-1', 57, 12),
('M-1', 58, 0.5),
('M-1', 59, 5),
('M-1', 60, 0.5),
('M-1', 61, 1),
('M-1', 62, 1),
('M-1', 63, 1),
('M-1', 64, 2),
('M-1', 65, 0.25),
('M-1', 66, 0),
('M-1', 67, 2),
('M-1', 68, 2),
('M-1', 69, 2),
('M-1', 70, 2),
('M-1', 71, 2),
('M-1', 72, 4),
('M-1', 73, 2),
('M-3', 95, 1),
('M-3', 96, 6),
('M-3', 97, 13),
('M-3', 98, 7),
('M-3', 99, 4),
('M-3', 100, 4),
('M-3', 101, 0.25),
('M-3', 74, 0.5),
('M-3', 75, 0.5),
('M-3', 76, 0.5),
('M-3', 77, 0),
('M-3', 78, 6),
('M-3', 79, 3),
('M-3', 29, 30),
('M-3', 80, 0.5),
('M-3', 81, 0.5),
('M-3', 10, 0.5),
('M-3', 11, 0.5),
('M-3', 82, 0),
('M-3', 63, 1),
('M-3', 65, 0.25),
('M-3', 66, 0),
('M-3', 68, 2),
('M-3', 83, 12),
('M-3', 84, 12),
('M-3', 72, 4),
('M-3', 73, 2),
('M-7', 95, 1),
('M-7', 96, 6),
('M-7', 98, 7),
('M-7', 99, 4),
('M-7', 102, 0.5),
('M-7', 101, 0.25),
('M-7', 74, 0.5),
('M-7', 103, 0.5),
('M-7', 104, 0),
('M-7', 42, 20),
('M-7', 79, 3),
('M-7', 105, 3),
('M-7', 80, 0.5),
('M-7', 106, 1),
('M-7', 81, 0.5),
('M-7', 65, 0.25),
('M-7', 66, 0),
('M-7', 68, 2),
('M-7', 84, 12),
('M-7', 14, 0),
('M-7', 72, 4),
('M-7', 73, 2),
('M-2', 95, 1),
('M-2', 97, 13),
('M-2', 99, 4),
('M-2', 101, 0.25),
('M-2', 74, 0.5),
('M-2', 104, 0),
('M-2', 79, 3),
('M-2', 80, 0.5),
('M-2', 81, 0.5),
('M-2', 107, 1),
('M-2', 10, 0.5),
('M-2', 11, 0.5),
('M-2', 31, 1),
('M-2', 65, 0.25),
('M-2', 108, 0.5),
('M-2', 82, 0),
('M-2', 66, 0),
('M-2', 83, 12),
('M-2', 14, 0),
('M-2', 72, 4),
('M-2', 73, 2),
('M-4', 109, 12),
('M-4', 81, 0.5),
('M-4', 107, 1),
('M-4', 80, 0.5),
('M-4', 14, 0),
('M-4', 86, 0.5),
('M-6', 95, 1),
('M-6', 97, 13),
('M-6', 99, 4),
('M-6', 104, 0),
('M-6', 79, 3),
('M-6', 80, 0.5),
('M-6', 81, 0.5),
('M-6', 107, 1),
('M-6', 10, 0.5),
('M-6', 101, 0.25),
('M-6', 74, 0.5),
('M-6', 11, 0.5),
('M-6', 18, 0.5),
('M-6', 65, 0.25),
('M-6', 108, 0.5),
('M-6', 61, 1),
('M-6', 66, 0),
('M-6', 83, 12),
('M-6', 109, 12),
('M-6', 14, 0),
('M-6', 85, 6),
('M-6', 73, 2),
('M-5', 95, 1),
('M-5', 87, 21),
('M-5', 42, 20),
('M-5', 65, 0.25),
('M-5', 66, 0),
('M-5', 63, 1),
('M-5', 88, 1),
('M-5', 89, 1),
('M-5', 90, 4),
('M-5', 67, 2),
('M-5', 68, 2),
('M-5', 91, 6),
('M-5', 92, 12),
('M-5', 14, 0),
('M-5', 72, 4),
('M-5', 93, 4),
('M-5', 94, 2),
('F-1', 50, 35);

-- --------------------------------------------------------

--
-- Table structure for table `raw_indent_table`
--

CREATE TABLE `raw_indent_table` (
  `R_Indent_Id` int(11) NOT NULL,
  `Description` longtext,
  `Units` longtext,
  `State` varchar(50) NOT NULL,
  `User_Type` varchar(50) NOT NULL,
  `TechName` varchar(100) NOT NULL,
  `R_Ids` longtext,
  `Raised_Date` date DEFAULT NULL,
  `Approved_Date` date DEFAULT NULL,
  `Comments` mediumtext
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `raw_indent_table`
--

INSERT INTO `raw_indent_table` (`R_Indent_Id`, `Description`, `Units`, `State`, `User_Type`, `TechName`, `R_Ids`, `Raised_Date`, `Approved_Date`, `Comments`) VALUES
(1, '4', '5,10,10,10,', 'Approved', 'Admin', 'StoreKeeper', '1,2,3,4,', '2017-10-25', '2017-10-25', '');

-- --------------------------------------------------------

--
-- Table structure for table `raw_material_details`
--

CREATE TABLE `raw_material_details` (
  `R_Id` int(11) NOT NULL,
  `R_Name` mediumtext NOT NULL,
  `Quantity` float DEFAULT NULL,
  `Amount` float DEFAULT NULL,
  `Added_Date` date DEFAULT NULL,
  `Used_Date` date DEFAULT NULL,
  `UOM` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `raw_material_details`
--

INSERT INTO `raw_material_details` (`R_Id`, `R_Name`, `Quantity`, `Amount`, `Added_Date`, `Used_Date`, `UOM`) VALUES
(1, 'P.O.P .Bandage 15CM 2.7 Mtrs', 14, 760, NULL, NULL, 'Nos'),
(2, 'Stockinet 15 cm -- Width', -7, 60, NULL, NULL, 'Meter'),
(3, 'Stockinet 5 cm -- Width', -2, 20, NULL, NULL, 'Meter'),
(4, 'P.O.P .Powder --Suryacem or Asian', -5, 25, NULL, NULL, 'Kgs'),
(5, 'PP Sheet 6mm', 3, 113, NULL, NULL, 'Square Feet'),
(6, 'Ethaflex 4mm', 0.25, 43, NULL, NULL, 'Sheet'),
(7, 'Padding Leather (Sheep Napa)', 14, 6, NULL, NULL, 'Dcm'),
(8, 'Velcro1" Smooth Black', 0.5, 10, NULL, NULL, 'Meter'),
(9, 'Velcro1" Ruguf Black', 0.5, 10, NULL, NULL, 'Meter'),
(10, 'Velcro2" Smooth Black', -1, 20, NULL, NULL, 'Meter'),
(11, 'Velcro2" Ruguf Black', -1, 20, NULL, NULL, 'Meter'),
(12, 'Rubber Sheet or Welt Rubber', 0.25, 100, NULL, NULL, 'Sheet'),
(13, 'Reveit button', 10, 1, NULL, NULL, 'Nos'),
(14, 'Solution-- fevicol-- 707', 0, 310, NULL, NULL, 'ML'),
(15, 'D Ring1"', 1, 5, NULL, NULL, 'Nos'),
(16, 'D Ring 2"', 1, 7, NULL, NULL, 'Nos'),
(17, 'Nylon tape 1"', 0.25, 6.16, NULL, NULL, 'Meter'),
(18, 'Nylon tape 2"', 0, 10.76, NULL, NULL, 'Feet'),
(19, 'Ankle Joint Right', 2, 10, NULL, NULL, 'Nos'),
(20, 'Ankle Joint Left', 2, 10, NULL, NULL, 'Nos'),
(21, 'Nut & Bolt 4mm 3/4"(4 /20) csk head', -12, 0.2, NULL, NULL, 'Nos'),
(22, 'Copper Rivet4mm3/4"(4/20) flat head', 6, 0.5, NULL, NULL, 'Nos'),
(23, 'Washer 4mm ID ', 6, 0.1, NULL, NULL, 'Nos'),
(24, 'Thread # 30 (Vardan Products) Black', -12, 1, NULL, NULL, 'Meter'),
(25, 'PP Sheet 4mm', -3, 94, NULL, NULL, 'Square Feet'),
(26, 'Mi Kneew joint', 2, 550, NULL, NULL, 'Nos'),
(27, 'Ms Rivit', 8, 1, NULL, NULL, 'Nos'),
(28, 'Aluminium Flat 3mm', 1, 15, NULL, NULL, 'Feet'),
(29, 'Upperlather', -120, 7.5, NULL, NULL, 'Dcm'),
(30, 'Ethaflex 3mm', 0.5, 110, NULL, NULL, 'Sheet'),
(31, 'Cotton Cloth', -1, 183, NULL, NULL, 'Meter'),
(32, 'Velcro2" Smooth White', 2, 20, NULL, NULL, 'Meter'),
(33, 'Ms Flat 3/4" 3mm', 1, 55, NULL, NULL, 'Nos'),
(34, 'Velcro2" Ruguf White', 2, 20, NULL, NULL, 'Meters'),
(35, 'Cotton Tape 1"', 2, 6, NULL, NULL, 'Meters'),
(36, 'Cotton Tape 2"', 2, 10, NULL, NULL, 'Feet'),
(37, 'PP Sheet 3mm', 1.5, 57, NULL, NULL, 'Square Feet'),
(38, 'Bk Kit', 0, 1950, NULL, NULL, 'Nos'),
(39, 'Foot', 1, 550, NULL, NULL, 'Nos'),
(40, 'Knee cap', 1, 250, NULL, NULL, 'Nos'),
(41, 'Sponge', 6, 25, NULL, NULL, 'Nos'),
(42, 'Rapping Papper', 20, 1, NULL, NULL, 'Meters'),
(43, 'Ethaflex 8mm', 0.75, 687, NULL, NULL, 'Sheet'),
(44, 'Kneejoint', 2, 550, NULL, NULL, 'Nos'),
(45, 'Tees Belt', 1, 4500, NULL, NULL, 'Nos'),
(46, 'Hand Glouse', -1, 300, NULL, NULL, 'Nos'),
(47, 'Buckle', 0, 5, NULL, NULL, 'Nos'),
(48, 'BE Kit', 1, 2800, NULL, NULL, 'Nos'),
(49, 'AE Kit', 0, 4500, NULL, NULL, 'Nos'),
(50, 'Lining Lather', -70, 7.5, NULL, NULL, 'Dcm'),
(51, 'Stepner', -2, 5, NULL, NULL, 'Meters'),
(52, 'Rubber Sole', -2, 50, NULL, NULL, 'Sheet'),
(53, 'Laze', -2, 10, NULL, NULL, 'Pair'),
(54, 'I Let', -40, 1, NULL, NULL, 'Nos'),
(55, 'Bt sole', -0.5, 0.25, NULL, NULL, 'Kgs'),
(56, 'MCR', 0.4, 300, NULL, NULL, 'Sheet'),
(57, 'Ms Pipe 7 /8"', 12, 15, NULL, NULL, 'Feet'),
(58, 'Ms Pipe 1"', 0.5, 17, NULL, NULL, 'Feet'),
(59, 'Ms Pipe 3/4', 5, 10, NULL, NULL, 'Feet'),
(60, 'Ms Flat1" 6mm & 3/4"', 0.5, 55, NULL, NULL, 'Kgs'),
(61, 'Hand Grip', 0, 20, NULL, NULL, 'Pair'),
(62, 'Rubber Bush', 1, 140, NULL, NULL, 'Pair'),
(63, 'Plating Charge', 1, 650, NULL, NULL, 'Nos'),
(64, 'Ceat Clamp', 2, 45, NULL, NULL, 'Nos'),
(65, 'Carbet', -0.5, 120, NULL, NULL, 'Kgs'),
(66, 'Gas welding rod', 0, 90, NULL, NULL, 'Kgs'),
(67, 'Spring', 2, 25, NULL, NULL, 'Nos'),
(68, 'Ark welding rod', 2, 10, NULL, NULL, 'Nos'),
(69, 'Coster Wheel 6"', 2, 380, NULL, NULL, 'Nos'),
(70, 'Bold & Nut 12mm', 2, 15, NULL, NULL, 'Dcm'),
(71, 'Bold & Nut 8mm', 2, 3, NULL, NULL, 'ML'),
(72, 'Washer', -4, 2, NULL, NULL, 'Nos'),
(73, 'Bold & Nut 5mm', -4, 0.5, NULL, NULL, 'Meters'),
(74, 'Paint', -1, 310, NULL, NULL, 'Liter'),
(75, 'Patti', 0.5, 90, NULL, NULL, 'Liter'),
(76, 'Wood Primer', 0.5, 75, NULL, NULL, 'Liter'),
(77, 'Nail', 0, 190, NULL, NULL, 'Kgs'),
(78, 'Wood Beeding', 6, 3, NULL, NULL, 'Feet'),
(79, 'Played 1/2"', -6, 75, NULL, NULL, 'Square Feet'),
(80, 'Rexen', -1, 130, NULL, NULL, 'Meters'),
(81, 'Thermafoom', -1, 90, NULL, NULL, 'Meters'),
(82, 'Eath Foom 10mm', 0, 900, NULL, NULL, 'Sheet'),
(83, 'Wing Bold', -24, 38, NULL, NULL, 'Dcm'),
(84, 'Bold & Nut 6mm', 12, 3, NULL, NULL, 'ML'),
(85, 'T nut', 0, 10, NULL, NULL, 'Nos'),
(86, 'Bold & Nut 6mm 1"', 0.5, 225, NULL, NULL, 'Box'),
(87, 'Ms Pipe 1"18 gauge', 21, 17, NULL, NULL, 'Feet'),
(88, 'Powder Coating Chrges', 1, 650, NULL, NULL, 'Set'),
(89, 'Plastic Cap', 1, 650, NULL, NULL, 'Set'),
(90, 'Coster Wheel 4"', 4, 242, NULL, NULL, 'Nos'),
(91, 'Link Bush', 6, 10, NULL, NULL, 'Nos'),
(92, 'Bold & Nut 6mm 3"', 12, 6, NULL, NULL, 'ML'),
(93, 'Bold & Nut 8mm 4"', 4, 10, NULL, NULL, 'Meter'),
(94, 'Bold & Nut 6mm 4"', 2, 10, NULL, NULL, 'Meter'),
(95, 'Ms Pipe 7/8"18 gauge', -2, 15, NULL, NULL, 'Feet'),
(96, 'Ms Pipe 1"16 gauge', 6, 17, NULL, NULL, 'Feet'),
(97, 'Ms Pipe 3/4 18 gauge', -26, 10, NULL, NULL, 'Feet'),
(98, 'Ms Pipe 1 1/4"16 gauge', 7, 22, NULL, NULL, 'Feet'),
(99, 'Ms Flat1" 6mm & 3/4" 1 1/4"', -8, 25, NULL, NULL, 'Kgs'),
(100, 'Played 3/4"', 4, 109, NULL, NULL, 'Square Feet'),
(101, 'Tinner', -0.5, 90, NULL, NULL, 'Liter'),
(102, 'M S round Rod 12mm', 0.5, 55, NULL, NULL, 'Kgs'),
(103, 'Matal Past', 0.5, 90, NULL, NULL, 'Liter'),
(104, 'Tingles', 0, 190, NULL, NULL, 'Kgs'),
(105, 'M S Sheet', 3, 60, NULL, NULL, 'Square Feet'),
(106, 'Cycle parts', 1, 3200, NULL, NULL, 'Set'),
(107, 'Aluminium Ankal', -2, 25, NULL, NULL, 'Feet'),
(108, 'Eva Sheet', -1, 100, NULL, NULL, 'Sheet'),
(109, 'PP Sheet 12mm', 0, 225, NULL, NULL, 'Square Feet');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `User_Id` int(11) NOT NULL,
  `User_Name` varchar(30) NOT NULL,
  `Password` mediumtext NOT NULL,
  `User_Type` varchar(50) NOT NULL,
  `Email` varchar(100) DEFAULT NULL,
  `Contact_No` int(11) DEFAULT NULL,
  `Address` mediumtext
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`User_Id`, `User_Name`, `Password`, `User_Type`, `Email`, `Contact_No`, `Address`) VALUES
(1, 'Admin', 'Admin123*', 'Admin', 'admin@gmail.com', NULL, NULL),
(2, 'Fieldtech', 'Tech123*', 'Field Technician', 'technician@gmail.com', NULL, NULL),
(3, 'StoreKeeper', 'Store123*', 'Store Keeper', 'keeper@gmail.com', NULL, NULL),
(9, 'Aish', 'Aish123*', 'Field Technician', 'aish@gmail.com', NULL, NULL),
(10, 'Satish', 'Satish123*', 'Field Technician', 'satish@gmail.com', NULL, NULL),
(11, 'Ravindra', 'Ravindra123*', 'Field Technician', 'r@gmail.com', NULL, NULL),
(12, 'Timappa', 'timappa123*', 'Store Keeper', 't@gamil.com', NULL, NULL),
(13, 'asd', '123', 'Store Keeper', 'asdad@a.in', NULL, NULL),
(14, 'manmohan singh', '1', 'Field Technician', 'mandy@pmo.in', NULL, NULL),
(15, 'trump', '1', 'Field Technician', 'idiot@fool.com', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `vendor_details`
--

CREATE TABLE `vendor_details` (
  `Vendor_Id` int(11) NOT NULL,
  `Vendor_Name` varchar(30) NOT NULL,
  `Email` varchar(100) DEFAULT NULL,
  `Contact_No` int(11) DEFAULT NULL,
  `Address` mediumtext,
  `Manufacture_Type` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vendor_details`
--

INSERT INTO `vendor_details` (`Vendor_Id`, `Vendor_Name`, `Email`, `Contact_No`, `Address`, `Manufacture_Type`) VALUES
(1, 'Ravindra', NULL, NULL, NULL, NULL),
(2, 'Medha', NULL, NULL, NULL, NULL),
(3, 'Satish', NULL, NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `indent_table`
--
ALTER TABLE `indent_table`
  ADD UNIQUE KEY `Indent_Id` (`Indent_Id`),
  ADD KEY `fk_patient` (`Patient_Id`),
  ADD KEY `fk_product` (`Product_Id`),
  ADD KEY `fk_pre_name` (`Name`);

--
-- Indexes for table `patient_details`
--
ALTER TABLE `patient_details`
  ADD PRIMARY KEY (`Patient_Id`);

--
-- Indexes for table `prefab_indent_table`
--
ALTER TABLE `prefab_indent_table`
  ADD UNIQUE KEY `Pre_Id` (`Pre_Id`);

--
-- Indexes for table `pre_fabricated_entity`
--
ALTER TABLE `pre_fabricated_entity`
  ADD UNIQUE KEY `Id` (`Id`),
  ADD UNIQUE KEY `Name` (`Name`);

--
-- Indexes for table `product_details`
--
ALTER TABLE `product_details`
  ADD PRIMARY KEY (`Product_Id`);

--
-- Indexes for table `product_mapping_details`
--
ALTER TABLE `product_mapping_details`
  ADD KEY `fk_raw_mapping` (`R_Id`),
  ADD KEY `fk_product_mapping` (`Product_Id`);

--
-- Indexes for table `raw_indent_table`
--
ALTER TABLE `raw_indent_table`
  ADD UNIQUE KEY `R_Indent_Id` (`R_Indent_Id`);

--
-- Indexes for table `raw_material_details`
--
ALTER TABLE `raw_material_details`
  ADD PRIMARY KEY (`R_Id`),
  ADD UNIQUE KEY `uc_name` (`R_Name`(500));

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD UNIQUE KEY `User` (`User_Id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `indent_table`
--
ALTER TABLE `indent_table`
  MODIFY `Indent_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `prefab_indent_table`
--
ALTER TABLE `prefab_indent_table`
  MODIFY `Pre_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `raw_indent_table`
--
ALTER TABLE `raw_indent_table`
  MODIFY `R_Indent_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `User_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `indent_table`
--
ALTER TABLE `indent_table`
  ADD CONSTRAINT `fk_patient` FOREIGN KEY (`Patient_Id`) REFERENCES `patient_details` (`Patient_Id`),
  ADD CONSTRAINT `fk_pre_name` FOREIGN KEY (`Name`) REFERENCES `pre_fabricated_entity` (`Name`),
  ADD CONSTRAINT `fk_product` FOREIGN KEY (`Product_Id`) REFERENCES `product_details` (`Product_Id`);

--
-- Constraints for table `product_mapping_details`
--
ALTER TABLE `product_mapping_details`
  ADD CONSTRAINT `fk_product_mapping` FOREIGN KEY (`Product_Id`) REFERENCES `product_details` (`Product_Id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_raw_mapping` FOREIGN KEY (`R_Id`) REFERENCES `raw_material_details` (`R_Id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
