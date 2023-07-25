-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 14, 2022 at 04:13 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `queuing_database`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity_log`
--

CREATE TABLE `activity_log` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  `actions` text NOT NULL,
  `date` date NOT NULL,
  `time` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `activity_log`
--

INSERT INTO `activity_log` (`id`, `name`, `role`, `actions`, `date`, `time`) VALUES
(1, 'Judy Ann  Gerilla  Arribe', 'Admin', 'Logs into its account', '2022-11-14', '11:02:56 pm'),
(2, 'Judy Ann  Gerilla  Arribe', 'Admin', 'Added Admission', '2022-11-14', '11:03:34 pm'),
(3, 'Judy Ann  Gerilla  Arribe', 'Admin', 'Edited Admission', '2022-11-14', '11:03:54 pm'),
(4, 'Judy Ann  Gerilla  Arribe', 'Admin', 'Paused Admission', '2022-11-14', '11:04:13 pm'),
(5, 'Judy Ann  Gerilla  Arribe', 'Admin', 'Continue Admission', '2022-11-14', '11:04:46 pm'),
(6, 'Judy Ann  Gerilla  Arribe', 'Admin', 'Added Enrollment', '2022-11-14', '11:05:01 pm'),
(7, 'Judy Ann  Gerilla  Arribe', 'Admin', 'Added Judy Ann    Arribe account', '2022-11-14', '11:05:57 pm'),
(8, 'Judy Ann  Gerilla  Arribe', 'Admin', 'Edit Judy Ann    Arribe account', '2022-11-14', '11:06:32 pm');

-- --------------------------------------------------------

--
-- Table structure for table `offices`
--

CREATE TABLE `offices` (
  `id` int(11) NOT NULL,
  `office_name` varchar(255) NOT NULL,
  `number_of_transaction` int(11) DEFAULT NULL,
  `available_transactions` int(11) DEFAULT NULL,
  `date` date NOT NULL,
  `office_status` varchar(255) NOT NULL DEFAULT 'Active',
  `transaction_status` varchar(255) NOT NULL DEFAULT 'Continue'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `offices`
--

INSERT INTO `offices` (`id`, `office_name`, `number_of_transaction`, `available_transactions`, `date`, `office_status`, `transaction_status`) VALUES
(49, 'Library', 100, 100, '2022-11-14', 'Active', 'Continue'),
(50, 'Cashier', 300, 300, '2022-11-08', 'Archive', 'Continue'),
(51, 'Registrar', 500, 499, '2022-11-13', 'Active', 'Continue'),
(59, 'Guard', 1, 1, '2022-10-29', 'Active', 'Continue'),
(60, 'Admin', 1, 1, '2022-10-29', 'Active', 'Continue'),
(63, 'Admission', 1000, 1000, '2022-11-14', 'Active', 'Continue');

-- --------------------------------------------------------

--
-- Table structure for table `reservations`
--

CREATE TABLE `reservations` (
  `id` int(11) NOT NULL,
  `transaction_number` varchar(255) DEFAULT NULL,
  `reference_number` varchar(255) DEFAULT NULL,
  `firstname` varchar(255) NOT NULL,
  `middlename` varchar(255) DEFAULT NULL,
  `lastname` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `user_status` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `office` varchar(255) NOT NULL,
  `transaction` varchar(255) NOT NULL,
  `transaction_type` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `window_name` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `transferred_by` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reservations`
--

INSERT INTO `reservations` (`id`, `transaction_number`, `reference_number`, `firstname`, `middlename`, `lastname`, `name`, `user_status`, `email`, `office`, `transaction`, `transaction_type`, `date`, `window_name`, `status`, `transferred_by`) VALUES
(1, 'OL-4', 'OL-581244', 'Judy Ann', '', 'Arribe', 'Judy Ann  Arribe', 'New Visitor', 'judyannarribe16@gmail.com', 'Admission', 'Application for Graduation', 'Online', '2022-11-13', NULL, 'Cancelled', NULL),
(2, 'OL-3', 'OL-676644', 'Yvonne', '', 'Gaudiano', 'Yvonne  Gaudiano', 'New Visitor', 'yvonnegaudiano@gmail.com', 'Admission', 'Others', 'Online', '2022-11-13', NULL, 'Cancelled', NULL),
(3, 'OL-2', 'OL-642173', 'Syrill', '', 'Ramos', 'Syrill  Ramos', 'Student', '201910521@btech.ph.education', 'Library', 'Book Borrowing', 'Online', '2022-11-13', NULL, 'Cancelled', NULL),
(4, 'OL-1', 'OL-359029', 'Angelo Vhon', '', 'Faustino', 'Angelo Vhon  Faustino', 'New Visitor', 'angelovhonnfaustino@gmail.com', 'Registrar', 'COR', 'Online', '2022-11-13', NULL, 'Cancelled', NULL),
(5, 'WI-1', NULL, 'Phatrine Jane', '', 'Ferol', 'Phatrine Jane  Ferol', 'Student', '201910523@btech.ph.education', 'Registrar', 'Title Audit', 'Walk-in', '2022-11-13', NULL, 'Cancelled', NULL),
(6, 'WI-2', NULL, 'Emmanuel', '', 'Cruz', 'Emmanuel  Cruz', 'Student', '201910536@btech.ph.education', 'Library', 'Book Borrowing', 'Walk-in', '2022-11-13', NULL, 'Cancelled', NULL),
(7, 'OL-2', 'OL-773124', 'Judy Ann', '', 'Arribe', 'Judy Ann  Arribe', 'Student', '201910521@btech.ph.education', 'Admission', 'Enrollment', 'Online', '2022-11-14', NULL, 'Pending', NULL),
(8, 'OL-1', 'OL-228071', 'Yvonne', '', 'Gaudiano', 'Yvonne  Gaudiano', 'New Visitor', 'yvonnegaudiano@gmail.com', 'Library', 'Book Borrowing', 'Online', '2022-11-14', NULL, 'Pending', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` int(11) NOT NULL,
  `office_name` varchar(255) NOT NULL,
  `transaction` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `office_name`, `transaction`, `status`) VALUES
(1, 'Cashier', 'Payment', 'Active'),
(3, 'Library', 'Clearance', 'Archive'),
(4, 'Registrar', 'Enrollment', 'Active'),
(6, 'Registrar', 'COR', 'Active'),
(7, 'Registrar', 'Grades', 'Active'),
(8, 'Registrar', 'Certify', 'Active'),
(9, 'Ninmo', 'ID', 'Active'),
(10, 'Registrar', 'TOR', 'Active'),
(11, 'Registrar', 'Title Audit', 'Active'),
(13, 'Library', 'Book Borrowing', 'Active'),
(14, 'Library', 'Book Return', 'Active'),
(15, 'Library', 'Clearance Signing', 'Active'),
(17, 'Admission', 'Enrollment', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `middlename` varchar(255) DEFAULT NULL,
  `lastname` varchar(255) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  `window_name` varchar(255) DEFAULT NULL,
  `user_status` varchar(255) NOT NULL DEFAULT 'Active',
  `confirmation_code` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `firstname`, `middlename`, `lastname`, `fullname`, `email`, `password`, `role`, `window_name`, `user_status`, `confirmation_code`) VALUES
(1, 'Judy Ann', 'Gerilla', 'Arribe', 'Judy Ann  Gerilla  Arribe', '201910521@btech.ph.education', '$2y$10$53a9122c3bea3872fc03beW28cDYyuU0teSt4fOtOHlJtkUipawNC', 'Admin', 'Window 1', 'Active', NULL),
(53, 'Judy Ann', '', 'Arribe', 'Judy Ann    Arribe', 'guard@gmail.com', '$2y$10$53a9122c3bea3872fc03beW28cDYyuU0teSt4fOtOHlJtkUipawNC', 'Guard', '', 'Active', NULL),
(54, 'Yvonne', '', 'Gaudiano', 'Yvonne    Gaudiano', 'library@gmail.com', '$2y$10$53a9122c3bea3872fc03beW28cDYyuU0teSt4fOtOHlJtkUipawNC', 'Library', 'Window 2', 'Active', NULL),
(55, 'Syrill', '', 'Ramos', 'Syrill    Ramos', 'cashier@gmail.com', '$2y$10$53a9122c3bea3872fc03be0fxKwiFnuUWDcWsyWnfgowUxmRO1ty2', 'Cashier', 'Window 1', 'Active', NULL),
(67, 'Judy Ann', '', 'Arribe', 'Judy Ann    Arribe', 'judyann16@gmail.com', '$2y$10$53a9122c3bea3872fc03beW28cDYyuU0teSt4fOtOHlJtkUipawNC', 'Admission', 'Window 1', 'Active', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity_log`
--
ALTER TABLE `activity_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `offices`
--
ALTER TABLE `offices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activity_log`
--
ALTER TABLE `activity_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `offices`
--
ALTER TABLE `offices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `reservations`
--
ALTER TABLE `reservations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
