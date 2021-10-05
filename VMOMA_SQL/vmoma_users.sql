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
-- Table structure for table `vmoma_users`
--

CREATE TABLE `vmoma_users` (
  `id` int(11) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vmoma_users`
--

INSERT INTO `vmoma_users` (`id`, `user_name`, `user_email`, `user_password`) VALUES
(60, 'chris f', 'crickrick8998@gmail.com', '$2y$10$P8oex4O14oYvvRF10RZMgeJ.SF7aDH/cwd0m5jlDVoKlIZAF.5tqq'),
(61, 'chris123', 'christopherforsythe123@gmail.com', '$2y$10$W7w3nUiVqY.t.wDPrzxfS.AMFOlXBLexHgXWdGQJqYadWaFj.ebRm'),
(62, 'simon', 'christopherforsythe123@gmail.com', '$2y$10$vgRH4mCvbayr6TDs6ORH5OfOO2lw28mdKpYPPpGuAhEtMUjEgXD5y'),
(63, 'Prilly', 'aprillialee96@gmail.com', '$2y$10$uSDWEwVkZpyG8tpIicJQmu0qYpMQVQ1gggmnGkf/Y9lRX6lew644K'),
(64, 'Shane', 'sforsy68@yahoo.co.uk', '$2y$10$3e4HOqXhRa4/jHrMYAAdKurCIkjzJdUMZPQlbNEk1lG2GV0YvbMha'),
(65, 'Maria', 'mforsy4@yahoo.co.uk', '$2y$10$ypqIe7ALTYlob3QNaNqbe.eL2UL4wc3AWxo/yGjaE1DV5lwgQZblS'),
(66, 'Sammy B', 'sforsy68@yahoo.co.uk', '$2y$10$dxlwiZlKovfBDMmEkoiK1uYUP.QfSp5.TgLv7xrzMC1fitm9VJ7FO'),
(67, 'Marty', 'marty@mail.com', '$2y$10$dpXX1NmBC3oO9FbyZe62kO50PLj2Dm/joUqKRPrgSgHcoBShaPlY6'),
(72, 'John', 'jb@mail.com', '$2y$10$VJkcmLZaBtJ2Pxy0myKax.1.Z9VxCDtJyMZ3bCxj/JTXda39DLVhe'),
(74, 'demo', 'demo@mail.com', '$2y$10$fucbZhCqYJuSc9xl26eBlOu9adz0234Tu0mtKcjOojysYnEl6vKYq');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `vmoma_users`
--
ALTER TABLE `vmoma_users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `vmoma_users`
--
ALTER TABLE `vmoma_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
