-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 31, 2017 at 07:56 AM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 5.6.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `thesis`
--

-- --------------------------------------------------------

--
-- Table structure for table `approved_thesis`
--

CREATE TABLE `approved_thesis` (
  `at_id` int(11) NOT NULL,
  `at_title` varchar(255) NOT NULL,
  `at_conducted_by` varchar(30) NOT NULL,
  `at_advisory` varchar(30) NOT NULL,
  `at_desc` text NOT NULL,
  `tt_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `major`
--

CREATE TABLE `major` (
  `major_id` int(11) NOT NULL,
  `major_name` varchar(255) NOT NULL,
  `major_hop` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `stud_id` int(11) NOT NULL,
  `stud_nim` varchar(30) NOT NULL,
  `stud_firstname` varchar(50) NOT NULL,
  `stud_lastname` varchar(50) NOT NULL,
  `stud_gender` enum('M','F') NOT NULL,
  `stud_major` tinyint(4) NOT NULL,
  `stud_phone` varchar(20) NOT NULL,
  `stud_email` varchar(30) NOT NULL,
  `stud_address` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`stud_id`, `stud_nim`, `stud_firstname`, `stud_lastname`, `stud_gender`, `stud_major`, `stud_phone`, `stud_email`, `stud_address`) VALUES
(1, '10510044', 'Mario', 'Supit', 'M', 0, '08124541588', 'mario@unklab.ac.id', 'Lansot'),
(2, '10510045', 'Steven', 'Lasut', 'M', 0, '08454333', 'steven@gmail.com', 'Kaasar');

-- --------------------------------------------------------

--
-- Table structure for table `teacher_staff`
--

CREATE TABLE `teacher_staff` (
  `ts_id` int(11) NOT NULL,
  `ts_nip` varchar(30) NOT NULL,
  `ts_firstname` varchar(50) NOT NULL,
  `ts_lastname` varchar(50) NOT NULL,
  `ts_gender` enum('M','F') NOT NULL,
  `ts_role` enum('1','2','3','4') NOT NULL,
  `ts_phone` varchar(20) NOT NULL,
  `ts_email` varchar(50) NOT NULL,
  `ts_address` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `teacher_staff`
--

INSERT INTO `teacher_staff` (`ts_id`, `ts_nip`, `ts_firstname`, `ts_lastname`, `ts_gender`, `ts_role`, `ts_phone`, `ts_email`, `ts_address`) VALUES
(1, '11013242', 'Patrick', 'Sangian', 'M', '3', '08124541588', 'patricksangian@gmail.com', 'kaasar'),
(2, '11013243', 'Flory', 'Tipak', 'M', '1', '081234554', 'flory@gmail.com', 'asrama'),
(3, '11013244', 'Suandi', '', 'M', '2', '797897', 'asdf@ff.com', 'kanaan'),
(4, '11013245', 'Nivilia', 'Dayoh', 'F', '4', '0987555', 'nivi@gmail.com', 'kaasar'),
(5, '11013246', 'Melkianus', 'Lobo', 'M', '3', '98989898', 'kian@gmail.com', 'Kanaan'),
(6, '11013247', 'Ivander', 'Lansart', 'M', '4', '123456789', 'van@gmail.com', 'tubir');

-- --------------------------------------------------------

--
-- Table structure for table `tmp_thesis`
--

CREATE TABLE `tmp_thesis` (
  `tt_id` int(11) NOT NULL,
  `tt_title` varchar(255) NOT NULL,
  `tt_submitted_by` varchar(30) NOT NULL,
  `tt_advisory` varchar(30) NOT NULL,
  `tt_desc` text NOT NULL,
  `tt_approval` tinyint(1) NOT NULL,
  `tt_comment` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `user_username` varchar(30) NOT NULL,
  `user_password` varchar(32) NOT NULL,
  `user_level` enum('1','2','3') NOT NULL,
  `user_status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `user_username`, `user_password`, `user_level`, `user_status`) VALUES
(1, '11013242', '25d55ad283aa400af464c76d713c07ad', '1', 1),
(2, '11013243', '25d55ad283aa400af464c76d713c07ad', '2', 1),
(3, '11013244', '25d55ad283aa400af464c76d713c07ad', '2', 1),
(4, '11013245', '743283e704bd79f821c22f279f70b978', '2', 1),
(5, '11013246', '1bc29b36f623ba82aaf6724fd3b16718', '2', 1),
(6, '11013247', '1bc29b36f623ba82aaf6724fd3b16718', '2', 1),
(7, '10510044', '1bc29b36f623ba82aaf6724fd3b16718', '2', 1),
(8, '10510045', '1bc29b36f623ba82aaf6724fd3b16718', '2', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `approved_thesis`
--
ALTER TABLE `approved_thesis`
  ADD PRIMARY KEY (`at_id`);

--
-- Indexes for table `major`
--
ALTER TABLE `major`
  ADD PRIMARY KEY (`major_id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`stud_id`);

--
-- Indexes for table `teacher_staff`
--
ALTER TABLE `teacher_staff`
  ADD PRIMARY KEY (`ts_id`);

--
-- Indexes for table `tmp_thesis`
--
ALTER TABLE `tmp_thesis`
  ADD PRIMARY KEY (`tt_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `approved_thesis`
--
ALTER TABLE `approved_thesis`
  MODIFY `at_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `major`
--
ALTER TABLE `major`
  MODIFY `major_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `stud_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `teacher_staff`
--
ALTER TABLE `teacher_staff`
  MODIFY `ts_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `tmp_thesis`
--
ALTER TABLE `tmp_thesis`
  MODIFY `tt_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
