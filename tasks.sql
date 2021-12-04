-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 23, 2021 at 01:01 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `larsfactorydb`
--

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `id` int(10) UNSIGNED NOT NULL,
  `BatchNo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Recorder` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Location` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `DateTime` datetime DEFAULT NULL,
  `Comment` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `LatexTemperature` double(8,2) DEFAULT NULL,
  `LatexPH` double(8,2) DEFAULT NULL,
  `LatexViscosity` double(8,2) DEFAULT NULL,
  `ProductSymbol` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Quantity` int(11) DEFAULT NULL,
  `Drum` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `TotalSolids` int(11) DEFAULT NULL,
  `ChloroformTest` int(11) DEFAULT NULL,
  `GellPoint` int(11) DEFAULT NULL,
  `LatexMechanical` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Delete` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`id`, `BatchNo`, `Recorder`, `Location`, `DateTime`, `Comment`, `LatexTemperature`, `LatexPH`, `LatexViscosity`, `ProductSymbol`, `Quantity`, `Drum`, `TotalSolids`, `ChloroformTest`, `GellPoint`, `LatexMechanical`, `Delete`) VALUES
(1, '#23', 'sst', 'ieutoeriut', '2021-11-22 00:00:00', 'rktuetje', 20.00, 9.00, 25.00, 'kkk', 20, '3/8', 50, -3, 30, NULL, 1),
(2, '#23', 'kent', 'laboratory', '2021-11-22 18:09:00', 'ritureiut', 20.00, 9.00, 25.00, NULL, NULL, NULL, NULL, NULL, NULL, 'Yes', 1),
(3, '#25', 'sim', 'kjdhfkjdhf', '2021-11-21 00:00:00', 'fkhgkgj\r\nsjskj', 19.00, 8.80, 35.00, 'aaa', 15, '3/8', 70, -4, 33, NULL, 1),
(4, '#25', 'kent', 'laboratory', '2021-11-19 18:11:00', 'jgjkdjgkdl\r\ndfhkshfkjs', 21.00, 9.00, 35.00, NULL, NULL, NULL, NULL, NULL, NULL, 'Yes', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
