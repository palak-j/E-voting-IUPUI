-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 30, 2022 at 11:30 PM
-- Server version: 10.3.34-MariaDB-0ubuntu0.20.04.1
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vimittal_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_tbl`
--

CREATE TABLE `admin_tbl` (
  `admin_id` int(5) NOT NULL,
  `first_name` varchar(45) NOT NULL,
  `last_name` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin_tbl`
--

INSERT INTO `admin_tbl` (`admin_id`, `first_name`, `last_name`, `email`, `password`) VALUES
(1, 'Palak', 'Jain', 'paljain@iu.edu', 'paljain'),
(2, 'Vijay', 'Mittal', 'vimittal@iu.edu', 'vimittal');

-- --------------------------------------------------------

--
-- Table structure for table `candidates_tbl`
--

CREATE TABLE `candidates_tbl` (
  `candidate_id` int(5) NOT NULL,
  `candidate_name` varchar(45) NOT NULL,
  `candidate_email` varchar(50) NOT NULL,
  `candidate_position` int(5) NOT NULL,
  `candidate_pic` varchar(50) DEFAULT NULL,
  `candidate_cvotes` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `candidates_tbl`
--

INSERT INTO `candidates_tbl` (`candidate_id`, `candidate_name`, `candidate_email`, `candidate_position`, `candidate_pic`, `candidate_cvotes`) VALUES
(1, 'John ', 'john@iu.edu', 1, 'john.jpg', 0),
(2, 'Merry', 'merry@iu.edu', 2, 'henry.jpg', 0),
(3, 'Meghan', 'meghan@iu.edu', 3, 'meghan.jpg', 0),
(4, 'Trevon', 'trevon@iu.edu', 3, 'trevon.jpg', 0),
(5, 'joseph', 'joseph@iu.edu', 1, 'joseph.jpg', 0),
(6, 'Amanda', 'amanda@iu.edu', 1, 'amanda.jpg', 0),
(7, 'Ruby', 'ruby@iu.edu', 6, 'ruby.jpg', 0),
(16, 'Ruby', 'ruby@iu.edu', 4, 'ruby.jpg', 0),
(17, 'Ruby', 'ruby@iu.edu', 3, 'ruby.jpg', 0),
(18, 'Amanda', 'amanda@iu.edu', 6, 'amanda.jpg', 0),
(19, 'John ', 'john@iu.edu', 4, 'john.jpg', 0),
(20, 'John ', 'john@iu.edu', 6, 'john.jpg', 0),
(21, 'Meghan', 'meghan@iu.edu', 4, 'meghan.jpg', 0),
(22, 'Amanda', 'amanda@iu.edu', 4, 'amanda.jpg', 0),
(23, 'joseph', 'joseph@iu.edu', 5, 'joseph.jpg', 0);

-- --------------------------------------------------------

--
-- Table structure for table `members_tbl`
--

CREATE TABLE `members_tbl` (
  `member_id` int(5) NOT NULL,
  `first_name` varchar(45) NOT NULL,
  `last_name` varchar(45) NOT NULL,
  `is_student` varchar(10) NOT NULL,
  `is_employee` varchar(10) NOT NULL,
  `email` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `members_tbl`
--

INSERT INTO `members_tbl` (`member_id`, `first_name`, `last_name`, `is_student`, `is_employee`, `email`, `password`) VALUES
(1, 'Ruhi', 'Sen', 'Yes', 'No', 'ruhi@iu.edu', 'ruhi'),
(2, 'Manila', 'Sharma', 'Yes', 'Yes', 'man@iu.edu', 'manila'),
(3, 'Mehal', 'Dixit', 'No', 'Yes', 'meh@iu.edu', 'mehal'),
(4, 'Rui', 'Cheng', 'Yes', 'Yes', 'rui@iu.edu', 'rui'),
(5, 'Vijay', 'Mittal', 'Yes', 'Yes', 'vimittal@iu.edu', 'vimittal'),
(6, 'raj', 'Sharma', 'Yes', 'No', 'raj@iu.edu', 'raj');

-- --------------------------------------------------------

--
-- Table structure for table `positions_tbl`
--

CREATE TABLE `positions_tbl` (
  `position_id` int(5) NOT NULL,
  `position_name` varchar(45) NOT NULL,
  `Voters` varchar(10) NOT NULL,
  `voting_deadline` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `positions_tbl`
--

INSERT INTO `positions_tbl` (`position_id`, `position_name`, `Voters`, `voting_deadline`) VALUES
(1, 'Club Secretary', 'A', '2022-04-13'),
(2, 'President', 'A', '2022-04-18'),
(3, 'SOIC Director', 'E', '2022-04-20'),
(4, 'SOIC Treasurer', 'A', '2022-05-31'),
(5, 'Executive Director', 'A', '2022-04-30'),
(6, 'Finance Head', 'E', '2022-05-30'),
(7, 'HOD', 'E', '2022-05-16');

-- --------------------------------------------------------

--
-- Table structure for table `votes_tbl`
--

CREATE TABLE `votes_tbl` (
  `id` int(11) NOT NULL,
  `voter_id` int(11) NOT NULL,
  `position_id` int(5) NOT NULL,
  `candidate_id` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `votes_tbl`
--

INSERT INTO `votes_tbl` (`id`, `voter_id`, `position_id`, `candidate_id`) VALUES
(1, 1, 1, 1),
(2, 2, 1, 1),
(3, 3, 1, 1),
(4, 4, 1, 5),
(5, 5, 1, 4),
(13, 1, 4, 2),
(16, 5, 6, 23),
(17, 5, 2, 23),
(20, 5, 5, 23),
(23, 5, 4, 16);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_tbl`
--
ALTER TABLE `admin_tbl`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `candidates_tbl`
--
ALTER TABLE `candidates_tbl`
  ADD PRIMARY KEY (`candidate_id`),
  ADD KEY `voting_id_fk` (`candidate_position`);

--
-- Indexes for table `members_tbl`
--
ALTER TABLE `members_tbl`
  ADD PRIMARY KEY (`member_id`);

--
-- Indexes for table `positions_tbl`
--
ALTER TABLE `positions_tbl`
  ADD PRIMARY KEY (`position_id`);

--
-- Indexes for table `votes_tbl`
--
ALTER TABLE `votes_tbl`
  ADD PRIMARY KEY (`id`),
  ADD KEY `voter_id_fk` (`voter_id`),
  ADD KEY `candidate_id_fk` (`candidate_id`),
  ADD KEY `position_id_fk` (`position_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_tbl`
--
ALTER TABLE `admin_tbl`
  MODIFY `admin_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `candidates_tbl`
--
ALTER TABLE `candidates_tbl`
  MODIFY `candidate_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `members_tbl`
--
ALTER TABLE `members_tbl`
  MODIFY `member_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `positions_tbl`
--
ALTER TABLE `positions_tbl`
  MODIFY `position_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `votes_tbl`
--
ALTER TABLE `votes_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `candidates_tbl`
--
ALTER TABLE `candidates_tbl`
  ADD CONSTRAINT `voting_id_fk` FOREIGN KEY (`candidate_position`) REFERENCES `positions_tbl` (`position_id`);

--
-- Constraints for table `votes_tbl`
--
ALTER TABLE `votes_tbl`
  ADD CONSTRAINT `candidate_id_fk` FOREIGN KEY (`candidate_id`) REFERENCES `candidates_tbl` (`candidate_id`),
  ADD CONSTRAINT `position_id_fk` FOREIGN KEY (`position_id`) REFERENCES `positions_tbl` (`position_id`),
  ADD CONSTRAINT `voter_id_fk` FOREIGN KEY (`voter_id`) REFERENCES `members_tbl` (`member_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
