-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 27, 2022 at 07:55 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ala_sms`
--

-- --------------------------------------------------------

--
-- Table structure for table `assignment`
--

CREATE TABLE `assignment` (
  `assignmentid` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `create_date` date NOT NULL DEFAULT current_timestamp(),
  `publish_date` date NOT NULL,
  `due_date` date NOT NULL,
  `staffid` varchar(20) NOT NULL,
  `courseid` int(11) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `assignment`
--

INSERT INTO `assignment` (`assignmentid`, `name`, `description`, `create_date`, `publish_date`, `due_date`, `staffid`, `courseid`, `status`) VALUES
(1, 'Assignment 1', 'this is description 1', '2022-03-27', '2022-03-31', '2022-03-31', 'S-001', 7, 'Inactive'),
(2, 'Assignment 2', 'this is description 2', '2022-03-27', '2022-03-31', '2022-04-05', 'S-001', 6, 'Inactive'),
(3, 'Assignment 3', 'this is description 3', '2022-03-27', '2022-03-30', '2022-04-07', 'S-001', 6, 'Inactive'),
(4, 'Assingment 4', 'this is description 4', '2022-03-27', '2022-03-15', '2022-03-25', 'S-001', 6, 'Inactive');

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `attendanceid` int(11) NOT NULL,
  `attendance_date` date NOT NULL,
  `status` varchar(20) NOT NULL,
  `enrollmentid` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`attendanceid`, `attendance_date`, `status`, `enrollmentid`) VALUES
(1, '2022-03-27', 'Present', 'E-000001'),
(2, '2022-03-27', 'Present', 'E-000002'),
(3, '2022-03-27', 'Present', 'E-000003'),
(4, '2022-03-27', 'Absent', 'E-000004'),
(5, '2022-03-27', 'Absent', 'E-000005'),
(6, '2022-03-27', 'Leave', 'E-000006'),
(7, '2022-03-27', 'Absent', 'E-000007'),
(8, '2022-03-27', 'Leave', 'E-000008'),
(9, '2022-03-28', 'Present', 'E-000001'),
(10, '2022-03-29', 'Leave', 'E-000001');

-- --------------------------------------------------------

--
-- Table structure for table `branch`
--

CREATE TABLE `branch` (
  `branchid` int(11) NOT NULL,
  `branchname` varchar(199) NOT NULL,
  `address` varchar(199) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `branch`
--

INSERT INTO `branch` (`branchid`, `branchname`, `address`) VALUES
(1, 'Ahlone Branch', 'N0,23. Ahlone Township\r\n'),
(2, 'Sanchaung Branch', 'N0.32, Sanchaung Township');

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `courseid` int(11) NOT NULL,
  `coursename` varchar(199) NOT NULL,
  `fee` varchar(199) NOT NULL,
  `discount` varchar(199) NOT NULL,
  `startdate` date NOT NULL,
  `duration` int(11) NOT NULL,
  `registerdate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `languageid` int(11) NOT NULL,
  `roomid` int(11) NOT NULL,
  `instructorid` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`courseid`, `coursename`, `fee`, `discount`, `startdate`, `duration`, `registerdate`, `languageid`, `roomid`, `instructorid`) VALUES
(6, 'Basic', '150000', '0', '2022-03-15', 2, '2022-03-14 15:43:41', 1, 1, 'S-002'),
(7, 'Intermediate', '200000', '0', '2022-03-09', 3, '2022-03-20 08:40:00', 2, 2, 'S-002');

-- --------------------------------------------------------

--
-- Table structure for table `enrollment`
--

CREATE TABLE `enrollment` (
  `enrollmentid` varchar(50) NOT NULL,
  `studentid` varchar(50) NOT NULL,
  `courseid` int(11) NOT NULL,
  `registerdate` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `enrollment`
--

INSERT INTO `enrollment` (`enrollmentid`, `studentid`, `courseid`, `registerdate`) VALUES
('E-000001', 'ST-000001', 6, '2022-03-14'),
('E-000002', 'ST-000002', 6, '2022-03-14'),
('E-000003', 'ST-000003', 6, '2022-03-14'),
('E-000004', 'ST-000004', 6, '2022-03-14'),
('E-000005', 'ST-000005', 6, '2022-03-14'),
('E-000006', 'ST-000001', 7, '2022-03-14'),
('E-000007', 'ST-000002', 7, '2022-03-14'),
('E-000008', 'ST-000003', 7, '2022-03-14');

-- --------------------------------------------------------

--
-- Table structure for table `exam`
--

CREATE TABLE `exam` (
  `examid` int(11) NOT NULL,
  `examname` varchar(100) NOT NULL,
  `exam_date` date NOT NULL,
  `exam_time` time NOT NULL,
  `min_mark` int(11) NOT NULL,
  `max_mark` int(11) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `exam`
--

INSERT INTO `exam` (`examid`, `examname`, `exam_date`, `exam_time`, `min_mark`, `max_mark`, `status`) VALUES
(1, 'Basic English', '2022-03-08', '12:00:00', 50, 100, 'Active'),
(2, 'Basic Japanese', '2022-03-10', '14:00:00', 60, 100, 'Active'),
(3, 'Basic English', '2022-02-27', '16:06:00', 30, 0, 'Inactive');

-- --------------------------------------------------------

--
-- Table structure for table `language`
--

CREATE TABLE `language` (
  `languageid` int(11) NOT NULL,
  `languagename` varchar(199) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `language`
--

INSERT INTO `language` (`languageid`, `languagename`) VALUES
(1, 'English'),
(2, 'Japanese'),
(5, 'Chinese'),
(7, 'French'),
(9, 'Korean');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `paymentid` varchar(50) NOT NULL,
  `fee` varchar(50) NOT NULL,
  `paidamount` varchar(50) NOT NULL,
  `paymentdate` date NOT NULL,
  `installmentnumber` int(11) NOT NULL,
  `status` varchar(50) NOT NULL,
  `studentid` varchar(20) NOT NULL,
  `courseid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`paymentid`, `fee`, `paidamount`, `paymentdate`, `installmentnumber`, `status`, `studentid`, `courseid`) VALUES
('P-000001', '200000', '100000', '2022-03-17', 1, 'Half Paid', 'ST-000001', 6),
('P-000002', '300000', '300000', '2022-03-17', 1, 'Full Paid', 'ST-000002', 7);

-- --------------------------------------------------------

--
-- Table structure for table `room`
--

CREATE TABLE `room` (
  `roomid` int(11) NOT NULL,
  `roomname` varchar(199) NOT NULL,
  `branchid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `room`
--

INSERT INTO `room` (`roomid`, `roomname`, `branchid`) VALUES
(1, 'A1', 1),
(2, 'A2', 1),
(3, 'S1', 2),
(4, 'S2', 2);

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `staffid` varchar(20) NOT NULL,
  `name` varchar(199) NOT NULL,
  `gender` varchar(20) NOT NULL,
  `dob` date NOT NULL,
  `nrc` varchar(50) NOT NULL,
  `address` varchar(199) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `profile` varchar(255) NOT NULL,
  `currentposition` varchar(50) NOT NULL,
  `entrydate` date NOT NULL DEFAULT current_timestamp(),
  `stafftypeid` int(11) NOT NULL,
  `status` varchar(50) NOT NULL,
  `basicsalary` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`staffid`, `name`, `gender`, `dob`, `nrc`, `address`, `phone`, `email`, `profile`, `currentposition`, `entrydate`, `stafftypeid`, `status`, `basicsalary`, `username`, `password`) VALUES
('S-001', 'Tun Tun', 'Male', '2022-03-08', '11/EEL(N)283978', 'Ygn', '09427865683', 'staff@gmail.com', 'image/_212-2128069_leopard-butterfly-3d-graphics.jpg', 'Finance Staff', '2022-02-28', 1, 'Active', 250000, 'tuntun', '12345'),
('S-002', 'Thant Zin', 'Male', '2022-03-10', '12/EFE(N)233923', 'Yangon', '9653339823', 'instructor@gmail.com', 'image/_212-2128069_leopard-butterfly-3d-graphics.jpg', 'Instructor', '2022-03-13', 2, 'Active', 350000, 'thantzin', '12345'),
('S-003', 'May Zin', 'Female', '2022-03-11', '10/GHT(N)893742', 'Yangon', '23488', 'mayzin@gmail.com', 'image/_76dc6959d75380718c559b450e65a048.png', 'Finance Staff', '2022-03-13', 1, 'Active', 3000000, 'mayzin', '12345');

-- --------------------------------------------------------

--
-- Table structure for table `stafftype`
--

CREATE TABLE `stafftype` (
  `stafftypeid` int(11) NOT NULL,
  `stafftype` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stafftype`
--

INSERT INTO `stafftype` (`stafftypeid`, `stafftype`) VALUES
(1, 'Staff'),
(2, 'Instructor');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `studentid` varchar(20) NOT NULL,
  `name` varchar(199) NOT NULL,
  `dob` date NOT NULL,
  `gender` varchar(11) NOT NULL,
  `address` varchar(199) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `profile` varchar(199) NOT NULL,
  `entrydate` date NOT NULL DEFAULT current_timestamp(),
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`studentid`, `name`, `dob`, `gender`, `address`, `phone`, `email`, `profile`, `entrydate`, `username`, `password`) VALUES
('ST-000001', 'Ag Ag', '2022-02-22', 'Male', 'Yangon', '82304', 'agag@gmail.com', 'image/_8270fae617816e520e79857932ef2394.jpg', '2022-02-22', 'agag', '12345'),
('ST-000002', 'Kg Kg', '2022-02-15', 'Male', 'Sanchaung', '234323', 'kgkg@gmail.com', 'image/_Shinobi-Cat.jpg', '2022-02-22', 'kgkg', '12345'),
('ST-000003', 'Su Su', '2022-03-01', 'Female', 'Yangon', '0942738394', 'susu@gmail.com', 'image/_communityIcon_vn92glo5ugy51.png', '2022-03-05', 'susu', '12345'),
('ST-000004', 'Ve Ve', '2022-03-08', 'Female', 'Yangon', '09739992347', 'veve@gmail.com', 'image/_5d3cb37b103ef62fb4042d348f12fcf5.jpg', '2022-03-05', 'susu', '12345'),
('ST-000005', 'Gu Gu', '2022-03-08', 'Female', 'Yangon', '23432', 'gugu@gmail.com', 'image/_21286f34a02a07099be5c71a671506d8.jpg', '2022-03-05', 'gugu', '12345'),
('ST-000006', 'Min Khant', '2000-03-17', 'Male', 'Yangon', '09834324', 'minkhant@gmail.com', 'image/_7e8b53e7-091e-4d6f-a8b5-cb6b42ba507d_1920x1080.jpg', '2022-03-15', 'minkhant', '12345');

-- --------------------------------------------------------

--
-- Table structure for table `timetable`
--

CREATE TABLE `timetable` (
  `id` int(11) NOT NULL,
  `day` varchar(20) NOT NULL,
  `starttime` time DEFAULT NULL,
  `endtime` time DEFAULT NULL,
  `courseid` int(11) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `timetable`
--

INSERT INTO `timetable` (`id`, `day`, `starttime`, `endtime`, `courseid`, `status`) VALUES
(1, 'Sunday', '09:00:00', '10:00:00', 6, 'Active'),
(2, 'Saturday', '09:00:00', '10:00:00', 6, 'Active'),
(3, 'Sunday', '17:37:00', '18:37:00', 7, 'Active'),
(4, 'Saturday', '07:40:00', '09:40:00', 7, 'Active'),
(5, 'Wednesday', '07:00:00', '09:00:00', 6, 'Active'),
(6, 'Tuesday', '17:00:00', '19:00:00', 7, 'Active');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `assignment`
--
ALTER TABLE `assignment`
  ADD PRIMARY KEY (`assignmentid`);

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`attendanceid`);

--
-- Indexes for table `branch`
--
ALTER TABLE `branch`
  ADD PRIMARY KEY (`branchid`);

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`courseid`);

--
-- Indexes for table `enrollment`
--
ALTER TABLE `enrollment`
  ADD PRIMARY KEY (`enrollmentid`);

--
-- Indexes for table `exam`
--
ALTER TABLE `exam`
  ADD PRIMARY KEY (`examid`);

--
-- Indexes for table `language`
--
ALTER TABLE `language`
  ADD PRIMARY KEY (`languageid`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`paymentid`);

--
-- Indexes for table `room`
--
ALTER TABLE `room`
  ADD PRIMARY KEY (`roomid`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`staffid`);

--
-- Indexes for table `stafftype`
--
ALTER TABLE `stafftype`
  ADD PRIMARY KEY (`stafftypeid`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`studentid`);

--
-- Indexes for table `timetable`
--
ALTER TABLE `timetable`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `assignment`
--
ALTER TABLE `assignment`
  MODIFY `assignmentid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `attendanceid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `branch`
--
ALTER TABLE `branch`
  MODIFY `branchid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `course`
--
ALTER TABLE `course`
  MODIFY `courseid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `exam`
--
ALTER TABLE `exam`
  MODIFY `examid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `language`
--
ALTER TABLE `language`
  MODIFY `languageid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `room`
--
ALTER TABLE `room`
  MODIFY `roomid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `stafftype`
--
ALTER TABLE `stafftype`
  MODIFY `stafftypeid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `timetable`
--
ALTER TABLE `timetable`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
