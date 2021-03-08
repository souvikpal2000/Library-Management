-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 08, 2021 at 06:45 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `library`
--

-- --------------------------------------------------------

--
-- Table structure for table `book`
--

CREATE TABLE `book` (
  `bid` int(11) NOT NULL,
  `name` tinytext NOT NULL,
  `status` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `book`
--

INSERT INTO `book` (`bid`, `name`, `status`) VALUES
(1, 'Great Expectation', '1'),
(2, '1984', '1'),
(3, 'Normal Things', '1'),
(4, 'Selection Day', '1'),
(5, 'Ready Player One', '1'),
(6, 'Harry Potter', '1'),
(7, 'Ready Player One', '1'),
(8, 'Ready Player One', '1'),
(9, '1984', '1'),
(10, 'Great Expectation', '1'),
(11, 'Room', '1'),
(12, 'Kite Runner', '1'),
(13, 'Secret of Nagas', '0'),
(14, 'Secret of Nagas', '1');

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `id` int(11) NOT NULL,
  `user` tinytext NOT NULL,
  `complain` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`id`, `user`, `complain`) VALUES
(1, 'spal62588', 'Need Thriller Type of Book');

-- --------------------------------------------------------

--
-- Table structure for table `issuereturn`
--

CREATE TABLE `issuereturn` (
  `id` int(11) NOT NULL,
  `uidName` tinytext NOT NULL,
  `bid` int(11) NOT NULL,
  `BookName` tinytext NOT NULL,
  `issueDate` date NOT NULL,
  `returnDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `issuereturn`
--

INSERT INTO `issuereturn` (`id`, `uidName`, `bid`, `BookName`, `issueDate`, `returnDate`) VALUES
(4, 'henry123', 13, 'Secret of Nagas', '2021-01-30', '2021-02-09');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `uid` int(11) NOT NULL,
  `fullname` tinytext NOT NULL,
  `uidusers` tinytext NOT NULL,
  `email` tinytext NOT NULL,
  `dob` date NOT NULL,
  `phone` tinytext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`uid`, `fullname`, `uidusers`, `email`, `dob`, `phone`) VALUES
(1, 'Souvik Pal', 'spal62588', 'spal62588@gmail.com', '2000-09-08', '8017137650'),
(2, 'Subhayan Sarkar', 'subhayan123', 'test@gmail.com', '2021-01-01', '252725727272'),
(3, 'Rupam Halder', 'rupam123', 'rupam@gmail.com', '2021-01-20', '648572468'),
(4, 'X', 'x123', 'x@gmail.com', '2021-01-04', '151111111'),
(5, 'Romik Majumdar', 'romik123', 'romik@gmail.com', '2021-01-01', '8754976545'),
(6, 'Sayan Maiti', 'sayan123', 'sayan@gmail.com', '2021-01-02', '8754965214'),
(7, 'Bob Sharma', 'bob123', 'bob@gmail.com', '2014-08-09', '7456875454'),
(8, 'Henry Calvin', 'henry123', 'henry@gmail.com', '2021-01-14', '7458754524');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `book`
--
ALTER TABLE `book`
  ADD PRIMARY KEY (`bid`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `issuereturn`
--
ALTER TABLE `issuereturn`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`uid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `book`
--
ALTER TABLE `book`
  MODIFY `bid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `issuereturn`
--
ALTER TABLE `issuereturn`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
