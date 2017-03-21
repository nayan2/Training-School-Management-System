-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 19, 2017 at 07:49 AM
-- Server version: 10.1.16-MariaDB
-- PHP Version: 5.6.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tsms`
--

-- --------------------------------------------------------

--
-- Table structure for table `batches`
--

CREATE TABLE `batches` (
  `course_name` varchar(700) NOT NULL,
  `batch_code` varchar(200) NOT NULL,
  `batch_starting_date` date NOT NULL,
  `room_number` varchar(100) NOT NULL,
  `faculty_name` varchar(500) NOT NULL,
  `amount` int(11) NOT NULL,
  `details` varchar(1000) NOT NULL,
  `routine` varchar(700) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `batches`
--

INSERT INTO `batches` (`course_name`, `batch_code`, `batch_starting_date`, `room_number`, `faculty_name`, `amount`, `details`, `routine`) VALUES
('JUNIFER-X', 'ccna-117', '2017-02-16', '4023', 'imran chowdhury', 12000, 'this is a ccna course.', 'Sunday-12 PM-4 PM\r\ntuesday-10 AM-12 PM'),
('JUNIFER-X', 'ccnp-2', '2017-02-14', '1024', 'imran chowdhury', 10500, '      ', 'monday-11.00 to 4.00 PM and null-null to null'),
('JUNIFER-X', 'ccnp-3', '0000-00-00', '7022', 'imran chowdhury', 12000, '      ', 'null-null to null and null-null to null');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `vendor_heading` varchar(700) NOT NULL,
  `name` varchar(700) NOT NULL,
  `code` varchar(200) NOT NULL,
  `pic_path` varchar(1000) NOT NULL,
  `adding_date` date NOT NULL,
  `details` varchar(5000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`vendor_heading`, `name`, `code`, `pic_path`, `adding_date`, `details`) VALUES
('JUNIFER', 'JUNIFER-X', 'jfhhjhjgjgjhgjjh', '../coursespic/JUNIFER-X.png', '2017-01-22', 'ekwhfjwhefjheskhdf');

-- --------------------------------------------------------

--
-- Table structure for table `faculties`
--

CREATE TABLE `faculties` (
  `id` int(11) NOT NULL,
  `course_name` varchar(700) NOT NULL,
  `batch_code` varchar(200) NOT NULL,
  `pic_path` varchar(700) NOT NULL,
  `first_name` varchar(400) NOT NULL,
  `last_name` varchar(400) NOT NULL,
  `faculty_name` varchar(200) NOT NULL,
  `company_name` varchar(100) DEFAULT NULL,
  `city` varchar(200) NOT NULL,
  `phone_number` int(14) NOT NULL,
  `email` varchar(200) NOT NULL,
  `zip_code` int(11) NOT NULL,
  `nationality` varchar(30) NOT NULL,
  `sex` varchar(6) NOT NULL,
  `religion` varchar(20) NOT NULL,
  `blood_group` varchar(50) NOT NULL,
  `dob` date NOT NULL,
  `faculty_activation_date` date NOT NULL,
  `faculty_inactivation_date` date DEFAULT NULL,
  `faculty_active` varchar(8) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `faculties`
--

INSERT INTO `faculties` (`id`, `course_name`, `batch_code`, `pic_path`, `first_name`, `last_name`, `faculty_name`, `company_name`, `city`, `phone_number`, `email`, `zip_code`, `nationality`, `sex`, `religion`, `blood_group`, `dob`, `faculty_activation_date`, `faculty_inactivation_date`, `faculty_active`) VALUES
(1, 'JUNIFER-X', 'ccna-117', 'profilepic/nayan2.jpg', 'imran', 'chowdhury', 'imran chowdhury', 'aiub', 'dhaka', 1830954149, 'nayanchowdhury92@gmail.com', 1362, 'bangladeshi', 'male', 'islam', 'o-pos', '1995-02-25', '2017-02-05', NULL, 'active');

-- --------------------------------------------------------

--
-- Table structure for table `financeofinstructor`
--

CREATE TABLE `financeofinstructor` (
  `id` int(11) NOT NULL,
  `instructorName` varchar(200) NOT NULL,
  `monthlyPayment` int(11) NOT NULL,
  `netTotal` int(11) NOT NULL,
  `totalPaid` int(11) NOT NULL,
  `due` int(11) NOT NULL,
  `lastTrunsaction` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `financeofstudents`
--

CREATE TABLE `financeofstudents` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `fullName` varchar(200) NOT NULL,
  `netTotal` int(11) NOT NULL,
  `paid` int(11) NOT NULL,
  `discount` int(11) NOT NULL,
  `due` int(11) NOT NULL,
  `lastTrunsaction` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `level` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `pic_path` varchar(700) DEFAULT NULL,
  `first_name` varchar(400) NOT NULL,
  `last_name` varchar(400) NOT NULL,
  `company_name` varchar(100) DEFAULT NULL,
  `city` varchar(200) NOT NULL,
  `phone_number` int(14) NOT NULL,
  `email` varchar(200) DEFAULT NULL,
  `zip_code` int(11) DEFAULT NULL,
  `nationality` varchar(30) NOT NULL,
  `sex` varchar(6) NOT NULL,
  `religion` varchar(20) NOT NULL,
  `blood_group` varchar(50) NOT NULL,
  `dob` date NOT NULL,
  `password` varchar(200) NOT NULL,
  `user_activation_date` date NOT NULL,
  `user_inactivation_date` date DEFAULT NULL,
  `usr_active` varchar(100) DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `level`, `username`, `pic_path`, `first_name`, `last_name`, `company_name`, `city`, `phone_number`, `email`, `zip_code`, `nationality`, `sex`, `religion`, `blood_group`, `dob`, `password`, `user_activation_date`, `user_inactivation_date`, `usr_active`) VALUES
(1, 'admin', 'nayan2', 'profilepic/nayan2.jpg', 'nayan', 'chowdhury', 'aiub', 'dhaka', 1830954149, 'nayanchowdhury92@gmail.com', 1361, 'bangladeshi', 'male', 'islam', 'o-pos', '1992-02-25', 'p7836y617u', '0000-00-00', '0000-00-00', 'active'),
(2, 'student', 'nayan', 'profilepic/junifer.jpg', 'nayan', 'chowdhury', 'aiub', 'dhaka', 1830954149, 'nayanchowdhury92@gmail.com', 1362, 'bangladeshi', 'male', 'islam', 'o-pos', '2017-02-01', '12345', '2017-01-11', '2017-02-15', 'active'),
(5, 'student', 'nayan5', 'profilepic/nayan5.jpg', 'nayan', 'chowdhury', 'aiub', 'dhaka', 1830954149, 'nayanchowdhury92@gmail.com', 1362, 'bangladeshi', 'male', 'islam', 'o-pos', '2017-01-11', '1234', '2017-01-20', NULL, 'active');

-- --------------------------------------------------------

--
-- Table structure for table `vendors`
--

CREATE TABLE `vendors` (
  `pic_path` varchar(1000) NOT NULL,
  `heading` varchar(700) NOT NULL,
  `adding_date` date NOT NULL,
  `body` varchar(5000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vendors`
--

INSERT INTO `vendors` (`pic_path`, `heading`, `adding_date`, `body`) VALUES
('../vendorspic/Cisco-Networking-Academy.jpg', 'CISCO', '2017-01-01', 'Cisco Systems, Inc. (known as Cisco) is an American multinational technology conglomerate headquartered in San JosÃ©, California, that develops, manufactures, and sells networking hardware, telecommunications equipment, and other high-technology services and products.[4] Through its numerous acquired subsidiaries, such as OpenDNS, Cisco Meraki, and Cisco Jasper, Cisco specializes into specific tech markets, such as Internet of Things (IoT), domain security, and energy management.'),
('../vendorspic/junifer.jpg', 'JUNIFER', '2017-01-20', 'Juniper Networks is an American multinational corporation headquartered in Sunnyvale, California that develops and markets networking products. Its products include routers, switches, network management software, network security products and software-defined networking technology.'),
('../vendorspic/oracle.png', 'ORACLE', '2017-01-19', 'Oracle Corporation is an American multinational computer technology corporation, headquartered in Redwood Shores, California. The company primarily specializes in developing and marketing database software and technology, cloud engineered systems and enterprise software productsâ€”particularly its own brands of database management systems. In 2015 Oracle was the second-largest software maker by revenue, after Microsoft.');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `batches`
--
ALTER TABLE `batches`
  ADD PRIMARY KEY (`course_name`,`batch_code`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`vendor_heading`,`name`);

--
-- Indexes for table `faculties`
--
ALTER TABLE `faculties`
  ADD PRIMARY KEY (`id`,`course_name`,`batch_code`,`email`);

--
-- Indexes for table `financeofinstructor`
--
ALTER TABLE `financeofinstructor`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `financeofstudents`
--
ALTER TABLE `financeofstudents`
  ADD PRIMARY KEY (`id`,`username`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`,`username`);

--
-- Indexes for table `vendors`
--
ALTER TABLE `vendors`
  ADD PRIMARY KEY (`heading`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `faculties`
--
ALTER TABLE `faculties`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
