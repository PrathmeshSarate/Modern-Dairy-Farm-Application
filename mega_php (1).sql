-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 19, 2023 at 10:13 PM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mega_php`
--

-- --------------------------------------------------------

--
-- Table structure for table `animal_health_info`
--

CREATE TABLE `animal_health_info` (
  `id` int(150) NOT NULL,
  `d_title` text COLLATE utf8_bin NOT NULL,
  `d_description` text COLLATE utf8_bin NOT NULL,
  `t_title` text COLLATE utf8_bin NOT NULL,
  `t_description` text COLLATE utf8_bin NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` datetime NOT NULL,
  `deleted_at` datetime NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `animal_health_info`
--

INSERT INTO `animal_health_info` (`id`, `d_title`, `d_description`, `t_title`, `t_description`, `created_at`, `modified_at`, `deleted_at`, `is_active`) VALUES
(1, 'sample_t', '', 'sample_t2', 'sample_d2', '2023-05-05 21:25:54', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(2, 'sdsad', 'das', 'das', 'asd', '2023-05-05 23:06:11', '0000-00-00 00:00:00', '2023-05-05 23:08:33', 0),
(3, 'Lumpy Skin Disease in Cattle', 'Lumpy skin disease is a viral infection of cattle. Originally found in Africa, it has also spread to countries in the Middle East, Asia, and eastern Europe.\r\nClinical signs include fever, lacrimation, hypersalivation, and characteristic skin eruptions. Diagnosis is by histopathology, virus isolation, or PCR. Attenuated vaccines may help control outbreaks.', 'Treatment and Prevention of Lumpy Skin Disease in Cattle', 'The spread of lumpy skin disease in recent years beyond its ancestral home of Africa is alarming. Quarantine restrictions have proved to be of limited use. Vaccination with attenuated virus offers the most promising method of control and was effective in halting the spread of the disease in the Balkans.\r\nAdministration of antibiotics to control secondary infection and good nursing care are recommended, but the large number of affected animals within a herd may preclude treatment.', '2023-05-05 23:07:46', '0000-00-00 00:00:00', '2023-05-05 23:08:29', 1),
(4, '1', '2', '3', '4', '2023-05-06 10:41:11', '0000-00-00 00:00:00', '2023-05-12 23:38:45', 0);

-- --------------------------------------------------------

--
-- Table structure for table `direct_sell`
--

CREATE TABLE `direct_sell` (
  `direct_sell_id` varchar(200) COLLATE utf8_bin NOT NULL,
  `supervisor_id` text COLLATE utf8_bin NOT NULL,
  `liter` text COLLATE utf8_bin NOT NULL,
  `rate` text COLLATE utf8_bin NOT NULL,
  `total` text COLLATE utf8_bin NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `direct_sell`
--

INSERT INTO `direct_sell` (`direct_sell_id`, `supervisor_id`, `liter`, `rate`, `total`, `created_at`) VALUES
('83D720230507152155', '101', '10', '30', '300.00', '2023-05-07 15:21:55'),
('D32220230505211120', '101', '4', '30', '120.00', '2023-05-05 21:11:20');

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE `member` (
  `member_id` varchar(150) COLLATE utf8_bin NOT NULL,
  `name` varchar(150) COLLATE utf8_bin NOT NULL,
  `email` text COLLATE utf8_bin NOT NULL,
  `phone` varchar(100) COLLATE utf8_bin NOT NULL,
  `cow` text COLLATE utf8_bin NOT NULL,
  `buffalo` text COLLATE utf8_bin NOT NULL,
  `address` text COLLATE utf8_bin NOT NULL,
  `activated_date` datetime DEFAULT current_timestamp(),
  `deactivated_date` datetime DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`member_id`, `name`, `email`, `phone`, `cow`, `buffalo`, `address`, `activated_date`, `deactivated_date`, `is_active`) VALUES
('017BD', 'fy', 'ty@t.thy', '7020471874', '7', '3', 'kop', '2023-05-15 10:39:12', NULL, 1),
('02BD7', 'dsafda', 'b@f.ccsa', '7020471874', '4', '6', 'ds', '2023-05-15 10:51:36', NULL, 1),
('04D0E', 'pppppppppp', 'ppppp@pppppppp.ppppp', '7020471874', '3', '5', 'vcdssf', '2023-05-05 09:54:42', NULL, 1),
('0563B', 'fsgf', 'reerre@sad.saasd', '34342', '4', '4', 'gfsdf', '2023-05-05 11:51:28', '2023-05-05 17:10:15', 0),
('09AB9', 'dsad', 'dsa@f.fdg', '7020471874', '4', '4', 'sfdsf', '2023-05-05 09:21:51', NULL, 1),
('0EF4E', 'oiiiiiiiiiii', 'iiiiiiiiii@iiiiii.iiiiiiii', '7020471874', '13', '3', 'sjdvd', '2023-05-05 03:54:51', NULL, 1),
('1234', 'Adi Kadam2', 'adi@gmail.com', '7020471874', '3', '4', '   Balinge,Kolhapur10', '2023-05-05 09:54:51', NULL, 1),
('123481', 'Name Changed2', '$email2@gmail.com', '$phone', '$noc', '$nob', '$address', '2023-05-05 12:00:18', '2023-05-06 10:39:36', 0),
('12734', 'hguyi', 'juhf@f.cs', '7020471874', '6', '4', 'kop', '2023-05-15 10:50:55', NULL, 1),
('19809', 'Rohit Diwan', 'formoto@gmail.com', '7020471874', '4', '8', 'kop', '2023-05-05 11:44:27', NULL, 1),
('1A798', 'dasda', 'dasd@dsf.asd', '7020471874', '6', '4', 'ds', '2023-05-04 11:51:55', NULL, 1),
('23863', 'aaaaaaaaaaa', 'aaaaaaa@aaaa.aaaaa', '7020471874', '1', '1', 'aaaaaaaaaaaaaa', '2023-05-05 09:59:38', NULL, 1),
('2DD04', 'Tanmay Yadav', 'tanmayyadav@gmail.com', '7498794647', '2', '3', 'Kop', '2023-05-13 10:49:37', NULL, 1),
('56311', 'aditya k', 'asda@sad.caom', '7020471874', '4', '6', 'dada\r\n', '2023-05-13 11:49:03', NULL, 1),
('5AD88', 'dsds', 'ds@ds.cas', '7020471874', '3', '4', 'dasdasd', '2023-05-05 10:30:53', NULL, 1),
('63372', 'Vaibhav Ingle', 'vingle@gmail.com', '7020471874', '4', '3', 'kop', '2023-05-15 10:32:23', NULL, 1),
('6926D', 'fffffff', 'fff@ggggg.sssss', '51646', '5', '5', 'dsffd', '2023-05-05 11:51:04', '2023-05-05 17:10:24', 0),
('69F2B', 'dasd', 'dsa@dwa.dsag', '7020471874', '5', '5', '456dsa', '2023-05-05 09:54:51', NULL, 1),
('6BFDC', 'Mayur Redekar', 'mayurredkar@gmail.com', '9168843322', '6', '4', 'Ichalkaranji', '2023-05-15 11:05:18', NULL, 1),
('73755', 'fdsfsfdsfsf', 'fdsfsf@fffffsfdsfs.dfg', '7020471874', '33333333333333333333', '333333333333333333', 'fdsfs', '2023-05-05 09:54:51', NULL, 1),
('7C605', 'Akshay Mithari', 'akshaymithari@gmail.com', '7020471874', '4', '3', 'Ichalkaranji, Kolhapur', '2023-05-13 10:19:38', NULL, 1),
('88413', 'dasd', 'dsa@sad', '7020471874', '2147483647', '2147483647', 'sdfsf', '2023-05-05 09:54:51', NULL, 1),
('9068B', 'dsad', 'dsa@fd.dhgdfg', '7020471874', '0', '0', 'das', '2023-05-05 09:54:51', NULL, 1),
('988C1', '123', '1d@d.sc', '7020471874', '5', '5', 'vjdf\r\n', '2023-05-05 09:54:51', NULL, 1),
('9F846', 'Prathmesh Patil', 'pp@gmail.com', '7020471874', '2', '4', 'kop', '2023-05-13 10:43:30', NULL, 1),
('A8A20', 'fsfsfs', 'fsfs@fsfs.fs', '1324567984', '5', '6', 'fdfdfd', '2023-05-13 14:38:51', NULL, 1),
('AE346', 'Parth Bhosale', 'parth@gmail.com', '7020471874', '3', '4', 'kop', '2023-05-13 10:33:45', NULL, 1),
('B580C', 'Liladhar Hari Kamble', 'lildharkamble@gmail.com', '8805121071', '4', '2', 'Wakare,Kolhapur', '2023-05-15 10:58:02', NULL, 1),
('C3656', 'ssss', 'sss@ss.ss', '7020471874', '1', '3', 'sssssssss', '2023-05-05 09:54:51', NULL, 1),
('DC185', 'fffffffffaaaaaaaaaaaa', 'ffffffffaaaaa@fas.sa', '7020471874', '2147483647', '2147483647', 'fa', '2023-05-05 09:54:51', NULL, 1),
('DDFDC', 'dsas', 'dsas@dasd.sa', '7020471874', '5', '3', 'dasdad', '2023-05-05 10:33:33', NULL, 1),
('DE685', 'dsa', 'dsa@das.csa', '7020471874', '1', '2', 'ds', '2023-05-05 10:34:52', NULL, 1),
('DEEAD', 'ds', 'ds@sd.s', '7020471874', 'ds', 'ds', 'ds', '2023-05-05 10:09:19', NULL, 1),
('ECA72', 'abc', 'abc@gmail.com', '7020471874', '2', '3', 'dsasasasasad', '2023-05-05 09:54:51', NULL, 1),
('F3DFC', 'dsa', 'das@as.asd', '7020471874', '6', '4', 'sadasd', '2023-05-05 10:31:29', NULL, 1),
('F5AE0', 'dsada', 'dasd@a.asd', '7020471874', '6', '4', 'afad', '2023-05-05 09:54:51', NULL, 1),
('F5AF2', 'ds', 'ds@ds.cs', '4444445555555555', '7', '5', 'ds', '2023-05-05 12:04:10', '2023-05-05 17:05:19', 0),
('FCCBA', 'Mayur', 'das@fdsa.fdh', '7020471874', '45', '4', 'sdf1111111111', '2023-05-05 11:49:59', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `message_id` int(11) NOT NULL,
  `sender_id` text COLLATE utf8_bin DEFAULT NULL,
  `receiver_id` text COLLATE utf8_bin DEFAULT NULL,
  `subject` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `content` text COLLATE utf8_bin DEFAULT NULL,
  `timestamp` datetime DEFAULT NULL,
  `is_read` tinyint(1) DEFAULT 0,
  `is_deleted` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`message_id`, `sender_id`, `receiver_id`, `subject`, `content`, `timestamp`, `is_read`, `is_deleted`) VALUES
(1, '101', '1234', '1234', 'dsdsad', '2023-05-13 14:49:24', 1, 0),
(2, '101', '73755', 'sas', 'sasaqwqq', '2023-05-13 14:50:26', 1, 0),
(3, '1234', '101', 'S1', 'D1', '2023-05-19 17:12:39', 1, 0),
(4, '1234', '101', 'Hi', 'HELLO', '2023-05-19 18:11:36', 1, 0),
(5, '1234', '101', 's', 'd', '2023-05-19 18:14:00', 1, 0),
(6, '101', '1234', 'first', 'second', '2023-05-19 18:22:28', 0, 0),
(7, '1234', '101', 'Hi From Member', 'd member', '2023-05-19 22:21:31', 1, 0),
(8, '6BFDC', '101', 'Hi from Mayur', 'D Mayur', '2023-05-19 22:28:20', 1, 0),
(9, '101', '6BFDC', 'MR', 'HELLO MR', '2023-05-19 22:45:02', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `milk_collection`
--

CREATE TABLE `milk_collection` (
  `bil_id` varchar(200) COLLATE utf8_bin NOT NULL,
  `member_id` text COLLATE utf8_bin NOT NULL,
  `member_name` text COLLATE utf8_bin NOT NULL,
  `supervisor_id` text COLLATE utf8_bin NOT NULL,
  `time_slot` enum('morning','evening','-') COLLATE utf8_bin NOT NULL,
  `animal_category` enum('cow','buffalo') COLLATE utf8_bin NOT NULL,
  `liter` varchar(100) COLLATE utf8_bin NOT NULL,
  `fat` varchar(100) COLLATE utf8_bin NOT NULL,
  `snf` varchar(100) COLLATE utf8_bin NOT NULL,
  `clr` varchar(100) COLLATE utf8_bin NOT NULL,
  `rate` varchar(100) COLLATE utf8_bin NOT NULL,
  `total` varchar(100) COLLATE utf8_bin NOT NULL,
  `created_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `milk_collection`
--

INSERT INTO `milk_collection` (`bil_id`, `member_id`, `member_name`, `supervisor_id`, `time_slot`, `animal_category`, `liter`, `fat`, `snf`, `clr`, `rate`, `total`, `created_date`) VALUES
('121620230519151629', '23863', 'aaaaaaaaaaa', '101', 'morning', 'buffalo', '7', '3.5', '6', '1', '42', '1029.00', '2023-05-19 15:16:29'),
('5BC920230519232159', '6BFDC', 'Mayur Redekar', '101', 'morning', 'cow', '4', '3', '4', '7', '40', '480.00', '2023-05-19 23:21:59'),
('5FB420230519151521', '017BD', 'fy', '101', 'morning', 'cow', '5', '3', '4', '6', '40', '600.00', '2023-05-19 15:15:21'),
('A30B20230519163228', '1234', 'Adi Kadam2', '101', 'evening', 'buffalo', '6', '3.5', '6', '8', '42', '882.00', '2023-05-19 16:32:28'),
('A5CF20230519150136', '1234', 'Adi Kadam2', '101', 'morning', 'cow', '4', '6', '16', '4', '52', '1248.00', '2023-05-19 15:01:36'),
('FD3220230519151215', '9F846', 'Prathmesh Patil', '101', 'morning', 'buffalo', '4', '6', '4', '6', '52', '1248.00', '2023-05-19 15:12:15');

-- --------------------------------------------------------

--
-- Table structure for table `owner`
--

CREATE TABLE `owner` (
  `owner_id` int(11) NOT NULL,
  `username` varchar(250) COLLATE utf8_bin NOT NULL,
  `password` text COLLATE utf8_bin NOT NULL,
  `name` varchar(250) COLLATE utf8_bin NOT NULL,
  `phone` varchar(200) COLLATE utf8_bin NOT NULL,
  `email` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `owner`
--

INSERT INTO `owner` (`owner_id`, `username`, `password`, `name`, `phone`, `email`) VALUES
(1, 'mdfa', '1234', 'MDFA', '9112101159', 'prathmeshsarate26@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `rate`
--

CREATE TABLE `rate` (
  `id` int(100) NOT NULL,
  `fat` decimal(10,1) DEFAULT NULL,
  `rate` float DEFAULT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `rate`
--

INSERT INTO `rate` (`id`, `fat`, `rate`, `created_at`) VALUES
(1, '3.0', 40, '2023-05-14 20:00:30'),
(2, '3.5', 42, '2023-05-14 20:02:59'),
(3, '4.0', 44, '2023-05-14 20:03:05'),
(4, '4.5', 46, '2023-05-14 20:03:35'),
(5, '5.0', 48, '2023-05-14 20:11:28'),
(6, '5.5', 50, '2023-05-14 20:13:07'),
(8, '6.0', 52, '2023-05-14 20:28:36');

-- --------------------------------------------------------

--
-- Table structure for table `supervisor`
--

CREATE TABLE `supervisor` (
  `supervisor_id` int(11) NOT NULL,
  `name` varchar(150) COLLATE utf8_bin NOT NULL,
  `email` text COLLATE utf8_bin NOT NULL,
  `password` text COLLATE utf8_bin NOT NULL,
  `phone` varchar(100) COLLATE utf8_bin NOT NULL,
  `address` text COLLATE utf8_bin NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deactivated_at` datetime DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `supervisor`
--

INSERT INTO `supervisor` (`supervisor_id`, `name`, `email`, `password`, `phone`, `address`, `created_at`, `deactivated_at`, `is_active`) VALUES
(101, 'Prathmesh J. Sarate', 'prathmesh@gmail.com', '1234', '9112101159', 'Kasaba Bawada,Kolhapur', '2023-05-19 20:02:12', NULL, 1),
(102, 'Rohit Ardalkar', 'rohitr@gmail.com', '123456', '7020471874', '', '2023-05-19 20:06:49', '2023-05-20 01:36:19', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `animal_health_info`
--
ALTER TABLE `animal_health_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `direct_sell`
--
ALTER TABLE `direct_sell`
  ADD PRIMARY KEY (`direct_sell_id`);

--
-- Indexes for table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`member_id`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`message_id`);

--
-- Indexes for table `milk_collection`
--
ALTER TABLE `milk_collection`
  ADD PRIMARY KEY (`bil_id`);

--
-- Indexes for table `owner`
--
ALTER TABLE `owner`
  ADD PRIMARY KEY (`owner_id`);

--
-- Indexes for table `rate`
--
ALTER TABLE `rate`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `supervisor`
--
ALTER TABLE `supervisor`
  ADD PRIMARY KEY (`supervisor_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `animal_health_info`
--
ALTER TABLE `animal_health_info`
  MODIFY `id` int(150) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `message_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `owner`
--
ALTER TABLE `owner`
  MODIFY `owner_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `rate`
--
ALTER TABLE `rate`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
