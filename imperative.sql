-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 03, 2024 at 07:00 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `imperative`
--

-- --------------------------------------------------------

--
-- Table structure for table `cabin`
--

CREATE TABLE `cabin` (
  `device_id` varchar(20) NOT NULL,
  `device_uniqueId` varchar(20) NOT NULL,
  `building` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cabin`
--

INSERT INTO `cabin` (`device_id`, `device_uniqueId`, `building`) VALUES
('BO-L1-0', '20202', 'SKY VISTA'),
('BO-L1-1', '20203', 'SKY VISTA'),
('BO-L1-2', '20204', 'SKY VISTA'),
('BO-L1-3', '20205', 'SKY VISTA'),
('BO-L1-4', '20206', 'SKY VISTA'),
('BO-L1-5', '20207', 'SKY VISTA'),
('BO-L1-6', '20208', 'SKY VISTA'),
('BO-L1-7', '20209', 'SKY VISTA'),
('BO-L1-8', '20210', 'SKY VISTA'),
('BO-L1-9', '20211', 'SKY VISTA'),
('BO-L2-1', '20212', 'SKY VISTA'),
('BO-L2-2', '20213', 'SKY VISTA'),
('BO-L2-3', '20214', 'SKY VISTA'),
('BO-L2-4', '20215', 'SKY VISTA'),
('BO-L2-5', '20216', 'SKY VISTA'),
('BO-L2-6', '20217', 'SKY VISTA'),
('BO-L2-7', '20218', 'SKY VISTA'),
('BO-L2-8', '20219', 'SKY VISTA'),
('D-C', '', ''),
('HR-C', '', ''),
('QC-L1-1', '20220', 'SKY VISTA'),
('QC-L1-10', '20229', 'SKY VISTA'),
('QC-L1-2', '20221', 'SKY VISTA'),
('QC-L1-3', '20222', 'SKY VISTA'),
('QC-L1-4', '20223', 'SKY VISTA'),
('QC-L1-5', '20224', 'SKY VISTA'),
('QC-L1-6', '20225', 'SKY VISTA'),
('QC-L1-7', '10226', 'SKY VISTA'),
('QC-L1-8', '20227', 'SKY VISTA'),
('QC-L1-9', '20228', 'SKY VISTA'),
('QC-L2-1', '20230', 'SKY VISTA'),
('QC-L2-2', '20231', 'SKY VISTA'),
('QC-L2-3', '20232', 'SKY VISTA'),
('QC-L2-4', '20233', 'SKY VISTA'),
('QC-L2-5', '20234', 'SKY VISTA'),
('QC-L2-6', '20235', 'SKY VISTA'),
('QC-L2-7', '20236', 'SKY VISTA'),
('QC-L2-8', '20237', 'SKY VISTA'),
('QC-L2-9', '20238', 'SKY VISTA'),
('S-C', '', ''),
('T-C', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `cabin_details`
--

CREATE TABLE `cabin_details` (
  `id` int(11) NOT NULL,
  `device_id` varchar(8) NOT NULL,
  `monitor_sr_num` varchar(13) NOT NULL,
  `cpu_sr_num` varchar(13) NOT NULL,
  `keyboard_sr_num` varchar(13) NOT NULL,
  `mouse_sr_num` varchar(13) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cabin_details`
--

INSERT INTO `cabin_details` (`id`, `device_id`, `monitor_sr_num`, `cpu_sr_num`, `keyboard_sr_num`, `mouse_sr_num`) VALUES
(1, 'Bo-L1-8', 'bomonitor1234', 'bocpu12345678', 'bokeyboard123', 'bomouse123456'),
(2, 'QC-L1-10', 'qcmonitor1235', 'qccpu12345678', 'qckeyboard120', 'qcmouse123456');

-- --------------------------------------------------------

--
-- Table structure for table `devices`
--

CREATE TABLE `devices` (
  `device_id` varchar(20) NOT NULL,
  `device_uniqueId` varchar(20) NOT NULL,
  `building` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `devices`
--

INSERT INTO `devices` (`device_id`, `device_uniqueId`, `building`) VALUES
('L1-1', '10000', 'SKY VISTA'),
('L1-2', '10001', 'SKY VISTA'),
('L1-3', '10002', 'SKY VISTA'),
('L1-4', '10003', 'SKY VISTA'),
('L1-5', '10004', 'SKY VISTA'),
('L10-1', '10061', 'SKY VISTA'),
('L10-2', '10062', 'SKY VISTA'),
('L10-3', '10063', 'SKY VISTA'),
('L10-4', '10064', 'SKY VISTA'),
('L10-5', '10065', 'SKY VISTA'),
('L11-1', '10066', 'SKY VISTA'),
('L11-2', '10067', 'SKY VISTA'),
('L11-3', '10068', 'SKY VISTA'),
('L11-4', '10069', 'SKY VISTA'),
('L11-5', '10070', 'SKY VISTA'),
('L11-6', '10071', 'SKY VISTA'),
('L11-7', '10072', 'SKY VISTA'),
('L11-8', '10073', 'SKY VISTA'),
('L11-9', '10074', 'SKY VISTA'),
('L12-1', '10075', 'SKY VISTA'),
('L12-2', '10076', 'SKY VISTA'),
('L12-3', '10077', 'SKY VISTA'),
('L12-4', '10078', 'SKY VISTA'),
('L12-5', '10079', 'SKY VISTA'),
('L12-6', '10080', 'SKY VISTA'),
('L12-7', '10081', 'SKY VISTA'),
('L12-8', '10082', 'SKY VISTA'),
('L12-9', '10083', 'SKY VISTA'),
('L13-1', '10084', 'SKY VISTA'),
('L13-2', '10085', 'SKY VISTA'),
('L13-3', '10086', 'SKY VISTA'),
('L13-4', '10087', 'SKY VISTA'),
('L13-5', '10088', 'SKY VISTA'),
('L13-6', '10089', 'SKY VISTA'),
('L13-7', '10090', 'SKY VISTA'),
('L13-8', '10091', 'SKY VISTA'),
('L13-9', '10092', 'SKY VISTA'),
('L14-1', '10093', 'SKY VISTA'),
('L14-2', '10094', 'SKY VISTA'),
('L14-3', '10095', 'SKY VISTA'),
('L14-4', '10096', 'SKY VISTA'),
('L14-5', '10097', 'SKY VISTA'),
('L14-6', '10098', 'SKY VISTA'),
('L14-7', '10099', 'SKY VISTA'),
('L14-8', '10100', 'SKY VISTA'),
('L14-9', '10101', 'SKY VISTA'),
('L15-1', '10102', 'SKY VISTA'),
('L15-2', '10103', 'SKY VISTA'),
('L15-3', '10104', 'SKY VISTA'),
('L15-4', '10105', 'SKY VISTA'),
('L15-5', '10106', 'SKY VISTA'),
('L16-1', '10107', 'SKY VISTA'),
('L16-2', '10108', 'SKY VISTA'),
('L16-3', '10109', 'SKY VISTA'),
('L16-4', '10110', 'SKY VISTA'),
('L16-5', '10111', 'SKY VISTA'),
('L16-6', '10112', 'SKY VISTA'),
('L16-7', '10113', 'SKY VISTA'),
('L16-8', '10114', 'SKY VISTA'),
('L16-9', '10115', 'SKY VISTA'),
('L17-1', '10116', 'SKY VISTA'),
('L17-2', '10117', 'SKY VISTA'),
('L17-3', '10118', 'SKY VISTA'),
('L17-4', '10119', 'SKY VISTA'),
('L17-5', '10120', 'SKY VISTA'),
('L17-6', '10121', 'SKY VISTA'),
('L17-7', '10122', 'SKY VISTA'),
('L17-8', '10123', 'SKY VISTA'),
('L17-9', '10124', 'SKY VISTA'),
('L18-1', '10125', 'SKY VISTA'),
('L18-2', '10126', 'SKY VISTA'),
('L18-3', '10127', 'SKY VISTA'),
('L18-4', '10128', 'SKY VISTA'),
('L18-5', '10129', 'SKY VISTA'),
('L18-6', '10130', 'SKY VISTA'),
('L18-7', '10131', 'SKY VISTA'),
('L18-8', '10132', 'SKY VISTA'),
('L18-9', '10133', 'SKY VISTA'),
('L19-1', '10134', 'SKY VISTA'),
('L19-2', '10135', 'SKY VISTA'),
('L19-3', '10136', 'SKY VISTA'),
('L19-4', '10137', 'SKY VISTA'),
('L19-5', '10138', 'SKY VISTA'),
('L19-6', '10139', 'SKY VISTA'),
('L19-7', '10140', 'SKY VISTA'),
('L19-8', '10141', 'SKY VISTA'),
('L19-9', '10142', 'SKY VISTA'),
('L2-1', '10005', 'SKY VISTA'),
('L2-2', '10006', 'SKY VISTA'),
('L2-3', '10007', 'SKY VISTA'),
('L2-4', '10008', 'SKY VISTA'),
('L2-5', '10009', 'SKY VISTA'),
('L20-1', '10143', 'SKY VISTA'),
('L20-2', '10144', 'SKY VISTA'),
('L20-3', '10145', 'SKY VISTA'),
('L20-4', '10146', 'SKY VISTA'),
('L20-5', '10147', 'SKY VISTA'),
('L21-1', '10148', 'SKY VISTA'),
('L21-2', '10149', 'SKY VISTA'),
('L21-3', '10150', 'SKY VISTA'),
('L21-4', '10151', 'SKY VISTA'),
('L21-5', '10152', 'SKY VISTA'),
('L21-6', '10153', 'SKY VISTA'),
('L21-7', '10154', 'SKY VISTA'),
('L21-8', '10155', 'SKY VISTA'),
('L21-9', '10156', 'SKY VISTA'),
('L22-1', '10157', 'SKY VISTA'),
('L22-2', '10158', 'SKY VISTA'),
('L22-3', '10159', 'SKY VISTA'),
('L22-4', '10160', 'SKY VISTA'),
('L22-5', '10161', 'SKY VISTA'),
('L22-6', '10162', 'SKY VISTA'),
('L22-7', '10163', 'SKY VISTA'),
('L22-8', '10164', 'SKY VISTA'),
('L22-9', '10165', 'SKY VISTA'),
('L23-1', '10166', 'SKY VISTA'),
('L23-2', '10167', 'SKY VISTA'),
('L23-3', '10168', 'SKY VISTA'),
('L23-4', '10169', 'SKY VISTA'),
('L23-5', '10170', 'SKY VISTA'),
('L23-6', '10171', 'SKY VISTA'),
('L23-7', '10172', 'SKY VISTA'),
('L23-8', '10173', 'SKY VISTA'),
('L23-9', '10174', 'SKY VISTA'),
('L24-1', '10175', 'SKY VISTA'),
('L24-2', '10176', 'SKY VISTA'),
('L24-3', '10177', 'SKY VISTA'),
('L24-4', '10178', 'SKY VISTA'),
('L24-5', '10179', 'SKY VISTA'),
('L24-6', '10180', 'SKY VISTA'),
('L24-7', '10181', 'SKY VISTA'),
('L24-8', '10182', 'SKY VISTA'),
('L24-9', '10183', 'SKY VISTA'),
('L25-1', '10184', 'SKY VISTA'),
('L25-2', '10185', 'SKY VISTA'),
('L25-3', '10186', 'SKY VISTA'),
('L25-4', '10187', 'SKY VISTA'),
('L26-1', '10188', 'SKY VISTA'),
('L26-2', '10189', 'SKY VISTA'),
('L26-3', '10190', 'SKY VISTA'),
('L26-4', '10191', 'SKY VISTA'),
('L27-1', '10192', 'SKY VISTA'),
('L27-2', '10193', 'SKY VISTA'),
('L27-3', '10194', 'SKY VISTA'),
('L27-4', '10195', 'SKY VISTA'),
('L28-1', '10196', 'SKY VISTA'),
('L28-2', '10197', 'SKY VISTA'),
('L28-3', '10198', 'SKY VISTA'),
('L29-1', '10199', 'SKY VISTA'),
('L29-2', '10200', 'SKY VISTA'),
('L29-3', '10201', 'SKY VISTA'),
('L3-1', '10010', 'SKY VISTA'),
('L3-2', '10011', 'SKY VISTA'),
('L3-3', '10012', 'SKY VISTA'),
('L3-4', '10013', 'SKY VISTA'),
('L3-5', '10014', 'SKY VISTA'),
('L4-1', '10015', 'SKY VISTA'),
('L4-2', '10016', 'SKY VISTA'),
('L4-3', '10017', 'SKY VISTA'),
('L4-4', '10018', 'SKY VISTA'),
('L4-5', '10019', 'SKY VISTA'),
('L5-1', '10020', 'SKY VISTA'),
('L5-2', '10021', 'SKY VISTA'),
('L5-3', '10022', 'SKY VISTA'),
('L5-4', '10023', 'SKY VISTA'),
('L5-5', '10024', 'SKY VISTA'),
('L6-1', '10025', 'SKY VISTA'),
('L6-2', '10026', 'SKY VISTA'),
('L6-3', '10027', 'SKY VISTA'),
('L6-4', '10028', 'SKY VISTA'),
('L6-5', '10029', 'SKY VISTA'),
('L6-6', '10030', 'SKY VISTA'),
('L6-7', '10031', 'SKY VISTA'),
('L6-8', '10032', 'SKY VISTA'),
('L6-9', '10033', 'SKY VISTA'),
('L7-1', '10034', 'SKY VISTA'),
('L7-2', '10035', 'SKY VISTA'),
('L7-3', '10036', 'SKY VISTA'),
('L7-4', '10037', 'SKY VISTA'),
('L7-5', '10038', 'SKY VISTA'),
('L7-6', '10039', 'SKY VISTA'),
('L7-7', '10040', 'SKY VISTA'),
('L7-8', '10041', 'SKY VISTA'),
('L7-9', '10042', 'SKY VISTA'),
('L8-1', '10043', 'SKY VISTA'),
('L8-2', '10044', 'SKY VISTA'),
('L8-3', '10045', 'SKY VISTA'),
('L8-4', '10046', 'SKY VISTA'),
('L8-5', '10047', 'SKY VISTA'),
('L8-6', '10048', 'SKY VISTA'),
('L8-7', '10049', 'SKY VISTA'),
('L8-8', '10050', 'SKY VISTA'),
('L8-9', '10051', 'SKY VISTA'),
('L9-1', '10052', 'SKY VISTA'),
('L9-2', '10053', 'SKY VISTA'),
('L9-3', '10054', 'SKY VISTA'),
('L9-4', '10055', 'SKY VISTA'),
('L9-5', '10056', 'SKY VISTA'),
('L9-6', '10057', 'SKY VISTA'),
('L9-7', '10058', 'SKY VISTA'),
('L9-8', '10059', 'SKY VISTA'),
('L9-9', '10060', 'SKY VISTA');

-- --------------------------------------------------------

--
-- Table structure for table `device_details`
--

CREATE TABLE `device_details` (
  `id` int(11) NOT NULL,
  `device_id` varchar(8) NOT NULL,
  `monitor_sr_num` varchar(13) NOT NULL,
  `cpu_sr_num` varchar(13) NOT NULL,
  `keyboard_sr_num` varchar(13) NOT NULL,
  `mouse_sr_num` varchar(13) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `device_details`
--

INSERT INTO `device_details` (`id`, `device_id`, `monitor_sr_num`, `cpu_sr_num`, `keyboard_sr_num`, `mouse_sr_num`) VALUES
(2, 'L1-1', 'ibvlmonitor24', 'googlecpuibvp', 'keyboardibvll', 'googlemouse3p'),
(4, 'l10-5', 'l10monitor124', 'l10cpu1234555', 'l10keyboard99', 'l10mouse12345'),
(5, 'l15-3', 'l15monitor121', 'l15cpu1234555', 'l15keyboard12', 'l15mouse12345'),
(6, 'l20-4', 'l20monitor123', 'l20cpu123456p', 'l20keyboardiv', 'l20mouse12345'),
(7, 'l25-1', 'l25monitor123', 'l25cpu1234567', 'l25keyboard12', 'iblmouse12346'),
(8, 'l28-2', 'l28monitor123', 'l28cpu1234567', 'l28keyboard12', 'l28mouse12345');

-- --------------------------------------------------------

--
-- Table structure for table `executive`
--

CREATE TABLE `executive` (
  `executive_id` int(5) NOT NULL,
  `executive_pass` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `executive`
--

INSERT INTO `executive` (`executive_id`, `executive_pass`) VALUES
(20211, 'soham'),
(20212, 'chirag'),
(20231, 'shweta'),
(20222, 'soham'),
(12345, '12345');

-- --------------------------------------------------------

--
-- Table structure for table `resolver`
--

CREATE TABLE `resolver` (
  `r_email` varchar(50) NOT NULL,
  `r_password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `resolver`
--

INSERT INTO `resolver` (`r_email`, `r_password`) VALUES
('chirag01@gmail.com', 'cs'),
('chirag1@gmail.com', 'c'),
('kamal@gmail.com', 'kamal'),
('shwetajangam@gmail.com', 's'),
('soham@gmail.com', 'soham'),
('sohamshedale@gmail.com', 'soham');

-- --------------------------------------------------------

--
-- Table structure for table `ticket`
--

CREATE TABLE `ticket` (
  `ticket_id` int(11) NOT NULL,
  `executive_id` int(11) NOT NULL,
  `desk_num` varchar(30) NOT NULL,
  `issue_type` varchar(30) NOT NULL,
  `ticket_description` varchar(1000) NOT NULL,
  `issue_status` tinyint(1) NOT NULL,
  `date_issue` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ticket`
--

INSERT INTO `ticket` (`ticket_id`, `executive_id`, `desk_num`, `issue_type`, `ticket_description`, `issue_status`, `date_issue`) VALUES
(114, 12345, 'bo-l1-2', 'Other', 'other', 1, '2023-12-13'),
(115, 12345, 'bo-l1-1', 'Software', 's/w', 1, '2023-12-15'),
(116, 12345, 'l2-3', 'Hardware', 'hardware', 1, '2023-12-22'),
(117, 12345, 'qc-l1-3', 'Software', 'software', 1, '2023-12-19'),
(119, 20211, 'l1-1', 'Hardware', 'some', 0, '2023-12-24'),
(121, 20222, 'bo-l1-0', 'Network', 'internet', 0, '2023-12-24'),
(122, 20212, 'l1-5', 'Software', 'some', 1, '2023-12-24'),
(123, 20212, 'l10-5', 'Software', 'some', 1, '2023-12-24'),
(124, 20212, 'l15-4', 'Network', 'internet', 0, '2023-12-30'),
(125, 12345, 'hr-c', 'Hardware', 'some', 1, '2024-01-02'),
(126, 12345, 'd-c', 'Hardware', 'pwq', 0, '2024-01-04');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cabin`
--
ALTER TABLE `cabin`
  ADD PRIMARY KEY (`device_id`);

--
-- Indexes for table `cabin_details`
--
ALTER TABLE `cabin_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `toCabinDetailsFromCabin` (`device_id`);

--
-- Indexes for table `devices`
--
ALTER TABLE `devices`
  ADD PRIMARY KEY (`device_id`),
  ADD UNIQUE KEY `device_uniqueId` (`device_uniqueId`),
  ADD UNIQUE KEY `device_id` (`device_id`);

--
-- Indexes for table `device_details`
--
ALTER TABLE `device_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `toDeviceDetailsFromDevices` (`device_id`);

--
-- Indexes for table `resolver`
--
ALTER TABLE `resolver`
  ADD PRIMARY KEY (`r_email`);

--
-- Indexes for table `ticket`
--
ALTER TABLE `ticket`
  ADD PRIMARY KEY (`ticket_id`),
  ADD KEY `desk_num` (`desk_num`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cabin_details`
--
ALTER TABLE `cabin_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `device_details`
--
ALTER TABLE `device_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `ticket`
--
ALTER TABLE `ticket`
  MODIFY `ticket_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=127;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cabin_details`
--
ALTER TABLE `cabin_details`
  ADD CONSTRAINT `toCabinDetailsFromCabin` FOREIGN KEY (`device_id`) REFERENCES `cabin` (`device_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `device_details`
--
ALTER TABLE `device_details`
  ADD CONSTRAINT `toDeviceDetailsFromDevices` FOREIGN KEY (`device_id`) REFERENCES `devices` (`device_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
