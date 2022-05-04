-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 27, 2022 at 04:09 PM
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
  `due_date` date NOT NULL,
  `staffid` varchar(20) NOT NULL,
  `courseid` int(11) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `assignment`
--

INSERT INTO `assignment` (`assignmentid`, `name`, `description`, `create_date`, `due_date`, `staffid`, `courseid`, `status`) VALUES
(1, 'Essay 1', 'Write about yourself', '2022-04-26', '2022-04-27', 'S-002', 1, 'Active'),
(2, 'Essay 2', 'Write about your family', '2022-04-26', '2022-04-29', 'S-002', 1, 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `assignmentdetail`
--

CREATE TABLE `assignmentdetail` (
  `assignmentdetailid` int(11) NOT NULL,
  `uploadfile` varchar(255) NOT NULL,
  `uploaddate` date NOT NULL DEFAULT current_timestamp(),
  `status` varchar(20) NOT NULL,
  `assignmentid` int(11) NOT NULL,
  `studentid` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `assignmentdetail`
--

INSERT INTO `assignmentdetail` (`assignmentdetailid`, `uploadfile`, `uploaddate`, `status`, `assignmentid`, `studentid`) VALUES
(1, 'assignmentfile/_interaction mode (HCI).txt', '2022-04-26', 'Graded', 1, 'ST-000001'),
(2, 'assignmentfile/_thant_zin_tun.PNG', '2022-04-26', 'Not Graded', 2, 'ST-000002'),
(3, 'assignmentfile/_Screenshot (2).png', '2022-04-26', 'Not Graded', 1, 'ST-000009'),
(6, 'assignmentfile/_Thant Zin Tun Student Registration Form.docx', '2022-04-27', 'Not Graded', 2, 'ST-000001');

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
(1, '2022-04-20', 'Present', 'E-000001'),
(2, '2022-04-20', 'Present', 'E-000002'),
(3, '2022-04-20', 'Present', 'E-000009'),
(4, '2022-04-22', 'Present', 'E-000001'),
(5, '2022-04-22', 'Leave', 'E-000002'),
(6, '2022-04-22', 'Absent', 'E-000009'),
(7, '2022-04-24', 'Absent', 'E-000001'),
(8, '2022-04-24', 'Present', 'E-000002'),
(9, '2022-04-24', 'Present', 'E-000009'),
(10, '2022-04-26', 'Present', 'E-000001'),
(11, '2022-04-26', 'Absent', 'E-000002'),
(12, '2022-04-26', 'Absent', 'E-000009'),
(13, '2022-04-25', 'Present', 'E-000003'),
(14, '2022-04-25', 'Present', 'E-000004'),
(15, '2022-04-25', 'Absent', 'E-000010'),
(16, '2022-04-25', 'Present', 'E-000005'),
(17, '2022-04-25', 'Leave', 'E-000006'),
(18, '2022-04-25', 'Present', 'E-000001'),
(19, '2022-04-25', 'Absent', 'E-000002'),
(20, '2022-04-25', 'Present', 'E-000009'),
(21, '2022-04-27', 'Present', 'E-000001'),
(22, '2022-04-27', 'Absent', 'E-000002'),
(23, '2022-04-27', 'Leave', 'E-000009');

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
(2, 'Sanchaung Branch', 'N0.32, Sanchaung Township'),
(4, 'Lathar Branch', 'Lathar 5 St, Upper Block, Yangon'),
(5, 'Branch Sample', 'Yangon');

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
  `enddate` date NOT NULL,
  `registerdate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `languageid` int(11) NOT NULL,
  `roomid` int(11) NOT NULL,
  `staffid` varchar(20) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`courseid`, `coursename`, `fee`, `discount`, `startdate`, `enddate`, `registerdate`, `languageid`, `roomid`, `staffid`, `status`) VALUES
(1, 'Basic', '150000', '0', '2022-04-04', '2022-07-08', '2022-04-27 13:04:52', 1, 1, 'S-002', 'Active'),
(2, 'N5', '120000', '0', '2022-04-02', '2022-07-02', '2022-04-26 16:26:47', 2, 2, 'S-004', 'Active'),
(3, 'Basic Chinese', '200000', '50000', '2022-04-04', '2022-07-15', '2022-04-26 16:27:31', 5, 3, 'S-005', 'Active'),
(4, 'Basic Korean', '150000', '0', '2022-04-16', '2022-07-24', '2022-04-26 16:28:11', 9, 4, 'S-006', 'Active'),
(5, 'Intermediate', '250000', '20000', '2022-04-30', '2022-08-26', '2022-04-27 12:36:40', 1, 6, 'S-002', 'Active'),
(6, 'N4', '200000', '0', '2022-04-27', '2022-07-27', '2022-04-27 12:49:05', 2, 6, 'S-004', 'Active');

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
('E-000001', 'ST-000001', 1, '2022-04-26'),
('E-000002', 'ST-000002', 1, '2022-04-26'),
('E-000003', 'ST-000003', 2, '2022-04-26'),
('E-000004', 'ST-000004', 2, '2022-04-26'),
('E-000005', 'ST-000005', 3, '2022-04-26'),
('E-000006', 'ST-000006', 3, '2022-04-26'),
('E-000007', 'ST-000007', 4, '2022-04-26'),
('E-000008', 'ST-000008', 4, '2022-04-26'),
('E-000009', 'ST-000009', 1, '2022-04-26'),
('E-000010', 'ST-000010', 2, '2022-04-26'),
('E-000011', 'ST-000003', 6, '2022-04-27');

-- --------------------------------------------------------

--
-- Table structure for table `exam`
--

CREATE TABLE `exam` (
  `examid` int(11) NOT NULL,
  `examname` varchar(100) NOT NULL,
  `exam_date` date NOT NULL,
  `min_mark` int(11) NOT NULL,
  `max_mark` int(11) NOT NULL,
  `status` varchar(20) NOT NULL,
  `courseid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `exam`
--

INSERT INTO `exam` (`examid`, `examname`, `exam_date`, `min_mark`, `max_mark`, `status`, `courseid`) VALUES
(1, 'Basic Exam', '2022-07-28', 40, 100, 'Active', 1),
(2, 'N5 Exam', '2022-06-23', 50, 100, 'Active', 2),
(3, 'Basic Chinese Exam', '2022-05-31', 60, 100, 'Active', 3);

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
(9, 'Korean'),
(12, 'French');

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
('P-000001', '150000', '150000', '2022-04-13', 0, 'Full Paid', 'ST-000001', 1),
('P-000002', '150000', '75000', '2022-04-06', 1, 'Half Paid', 'ST-000002', 1),
('P-000003', '120000', '120000', '2022-03-18', 0, 'Full Paid', 'ST-000003', 2),
('P-000004', '120000', '120000', '2022-04-05', 0, 'Full Paid', 'ST-000004', 2),
('P-000005', '200000', '100000', '2022-04-06', 1, 'Full Paid', 'ST-000004', 3),
('P-000006', '200000', '100000', '2022-04-03', 1, 'Half Paid', 'ST-000006', 3),
('P-000007', '200000', '200000', '2022-04-27', 0, 'Full Paid', 'ST-000001', 5);

-- --------------------------------------------------------

--
-- Table structure for table `result`
--

CREATE TABLE `result` (
  `resultid` int(11) NOT NULL,
  `mark` int(11) NOT NULL,
  `status` varchar(50) NOT NULL,
  `studentid` varchar(20) NOT NULL,
  `examid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `result`
--

INSERT INTO `result` (`resultid`, `mark`, `status`, `studentid`, `examid`) VALUES
(1, 60, 'Pass', 'ST-000001', 1),
(2, 80, 'Pass', 'ST-000002', 1),
(3, 36, 'Fail', 'ST-000009', 1),
(4, 60, 'Pass', 'ST-000003', 2),
(5, 50, 'Pass', 'ST-000004', 2),
(6, 80, 'Pass', '-- Select Student --', 2),
(7, 80, 'Pass', 'ST-000010', 2),
(8, 50, 'Fail', 'ST-000005', 3),
(9, 70, 'Pass', 'ST-000006', 3);

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
(4, 'S2', 2),
(6, 'L1', 4),
(7, 'L2', 4);

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
  `entrydate` date NOT NULL DEFAULT current_timestamp(),
  `stafftypeid` int(11) NOT NULL,
  `status` varchar(50) NOT NULL,
  `basicsalary` int(11) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`staffid`, `name`, `gender`, `dob`, `nrc`, `address`, `phone`, `email`, `profile`, `entrydate`, `stafftypeid`, `status`, `basicsalary`, `password`) VALUES
('S-001', 'Tun Tun', 'Male', '2022-03-08', '11/EEL(N)283978', 'Ygn', '09427865683', 'staff@gmail.com', 'image/_8270fae617816e520e79857932ef2394.jpg', '2022-02-28', 1, 'Active', 250000, '12345'),
('S-002', 'Thant Zin', 'Male', '2022-03-10', '12/EFE(N)233923', 'Yangon', '9653339823', 'instructor@gmail.com', 'image/_212-2128069_leopard-butterfly-3d-graphics.jpg', '2022-03-13', 2, 'Active', 350000, '12345'),
('S-003', 'May Zin', 'Female', '2022-03-11', '10/GHT(N)893742', 'Yangon', '23488', 'mayzin@gmail.com', 'image/_76dc6959d75380718c559b450e65a048.png', '2022-03-13', 3, 'Active', 3000000, '12345'),
('S-004', 'Kyaw Gyii', 'Male', '2000-03-12', '12/DLN(N)32432', 'Yangon', '0923443243243', 'kyawgyii@gmail.com', 'image/_communityIcon_vn92glo5ugy51.png', '2022-03-28', 2, 'Active', 2500000, '12345'),
('S-005', 'Ye Yint', 'Male', '1999-02-22', '9/BNL(N)234093', 'Yangon', '092362888364', 'yeyint@gmail.com', 'image/_pexels-photo-8078448.jpeg', '2022-04-02', 2, 'Active', 500000, '12345'),
('S-006', 'Win Win Shwe', 'Female', '1990-01-08', '10/KDE(N)234987', 'Yangon', '09222392832', 'winwin@gmail.com', 'image/_31f8487f3ac2eb1e93d7eb334248ed0a.jpg', '2022-04-26', 2, 'Active', 5000000, '12345');

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
(1, 'Branch Manager'),
(2, 'Instructor'),
(3, 'Office Staff'),
(4, 'Finance Staff');

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
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`studentid`, `name`, `dob`, `gender`, `address`, `phone`, `email`, `profile`, `entrydate`, `password`) VALUES
('ST-000001', 'Ag Ag', '2022-02-22', 'Male', 'Yangon 1', '82304', 'agag@gmail.com', 'image/_5d3cb37b103ef62fb4042d348f12fcf5.jpg', '2022-02-22', '12345'),
('ST-000002', 'Kg Kg', '2022-02-15', 'Male', 'Sanchaung', '234323', 'kgkg@gmail.com', 'image/_Shinobi-Cat.jpg', '2022-02-22', '12345'),
('ST-000003', 'Su Su', '2022-03-01', 'Female', 'Yangon', '0942738394', 'susu@gmail.com', 'image/_communityIcon_vn92glo5ugy51.png', '2022-03-05', '12345'),
('ST-000004', 'Ve Ve', '2022-03-08', 'Female', 'Yangon', '09739992347', 'veve@gmail.com', 'image/_5d3cb37b103ef62fb4042d348f12fcf5.jpg', '2022-03-05', '12345'),
('ST-000005', 'Gu Gu', '2022-03-08', 'Female', 'Yangon', '23432', 'gugu@gmail.com', 'image/_21286f34a02a07099be5c71a671506d8.jpg', '2022-03-05', '12345'),
('ST-000006', 'Min Khant', '2000-03-17', 'Male', 'Yangon', '09834324', 'minkhant@gmail.com', 'image/_7e8b53e7-091e-4d6f-a8b5-cb6b42ba507d_1920x1080.jpg', '2022-03-15', '12345'),
('ST-000007', 'Sakura', '1999-02-02', 'Female', 'Yangon', '9283048302', 'sakura@gmail.com', 'image/_pexels-photo.jpg', '2022-03-28', '12345'),
('ST-000008', 'Hsu Ye Win', '2000-01-02', 'Female', 'Mandalay', '093749237328', 'hsuyewin@gmail.com', 'image/_coffee-cup-working-happy.jpg', '2022-04-16', '12345'),
('ST-000009', 'Kaung Htet', '1999-04-02', 'Male', 'Yangon', '09429992372', 'kaunghtet@gmail.com', 'image/_pexels-photo-374592.jpeg', '2022-04-16', '12345'),
('ST-000010', 'Zin Lin Tun', '1980-06-30', 'Male', 'Yangon', '09234324334', 'zinlin@gmail.com', 'image/_pexels-photo-2530586.jpeg', '2022-04-16', '12345');

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
(1, 'Saturday', '12:00:00', '15:00:00', 1, 'Active'),
(2, 'Sunday', '12:00:00', '15:00:00', 1, 'Active'),
(3, 'Monday', '10:00:00', '12:00:00', 2, 'Active'),
(4, 'Friday', '10:00:00', '12:00:00', 2, 'Active'),
(5, 'Tuesday', '16:00:00', '18:00:00', 3, 'Active'),
(6, 'Thursday', '16:00:00', '18:00:00', 3, 'Active'),
(7, 'Wednesday', '13:00:00', '15:00:00', 4, 'Active'),
(8, 'Sunday', '13:00:00', '15:00:00', 4, 'Active'),
(9, 'Saturday', '13:00:00', '15:00:00', 4, 'Active');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `assignment`
--
ALTER TABLE `assignment`
  ADD PRIMARY KEY (`assignmentid`);

--
-- Indexes for table `assignmentdetail`
--
ALTER TABLE `assignmentdetail`
  ADD PRIMARY KEY (`assignmentdetailid`);

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
-- Indexes for table `result`
--
ALTER TABLE `result`
  ADD PRIMARY KEY (`resultid`);

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
-- AUTO_INCREMENT for table `assignmentdetail`
--
ALTER TABLE `assignmentdetail`
  MODIFY `assignmentdetailid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `attendanceid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `branch`
--
ALTER TABLE `branch`
  MODIFY `branchid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `course`
--
ALTER TABLE `course`
  MODIFY `courseid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `exam`
--
ALTER TABLE `exam`
  MODIFY `examid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `language`
--
ALTER TABLE `language`
  MODIFY `languageid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `result`
--
ALTER TABLE `result`
  MODIFY `resultid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `room`
--
ALTER TABLE `room`
  MODIFY `roomid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `stafftype`
--
ALTER TABLE `stafftype`
  MODIFY `stafftypeid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `timetable`
--
ALTER TABLE `timetable`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
