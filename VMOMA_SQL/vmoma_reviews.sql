-- phpMyAdmin SQL Dump
-- version 4.9.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 01, 2021 at 01:52 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cforsythe04`
--

-- --------------------------------------------------------

--
-- Table structure for table `vmoma_reviews`
--

CREATE TABLE `vmoma_reviews` (
  `id` int(11) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `comment` varchar(1000) NOT NULL,
  `rating` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vmoma_reviews`
--

INSERT INTO `vmoma_reviews` (`id`, `user_name`, `comment`, `rating`) VALUES
(7, 'chris f', 'Great visit - loved the exhibitions. Would recommened.', 5),
(10, 'simon', 'Meh', 1),
(11, 'Prilly', 'Pretty good. Had fun.', 3),
(12, 'Shane', 'Good museum', 4),
(14, 'chris f', 'fun', 4),
(16, 'demo', 'good', 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `vmoma_reviews`
--
ALTER TABLE `vmoma_reviews`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `vmoma_reviews`
--
ALTER TABLE `vmoma_reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
