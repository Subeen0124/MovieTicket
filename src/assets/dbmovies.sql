-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 02, 2025 at 12:35 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbmovies`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `email`, `password`) VALUES
(1, 'admin', 'admin1@gmail.com', '@Admin1#');

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `bookingid` int(11) NOT NULL,
  `bookingdate` timestamp NOT NULL DEFAULT current_timestamp(),
  `userid` int(11) NOT NULL,
  `showtimeid` int(11) NOT NULL,
  `totalprice` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`bookingid`, `bookingdate`, `userid`, `showtimeid`, `totalprice`) VALUES
(1, '2025-01-01 06:29:48', 12, 3, 300),
(2, '2025-01-10 06:35:30', 3, 3, 700);

-- --------------------------------------------------------

--
-- Table structure for table `movies1`
--

CREATE TABLE `movies1` (
  `movieid` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `genre` varchar(100) DEFAULT NULL,
  `release_date` date DEFAULT NULL,
  `duration` int(11) DEFAULT NULL,
  `now_showing` tinyint(1) DEFAULT 0,
  `poster_url` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `movies1`
--

INSERT INTO `movies1` (`movieid`, `title`, `description`, `genre`, `release_date`, `duration`, `now_showing`, `poster_url`) VALUES
(1, 'Dev', 'An exciting adventure.', 'Action', '2024-01-01', 120, 1, 'https://picsum.photos/id/1/200/300'),
(2, 'Devi', 'A romantic drama.', 'Romance', '2023-12-15', 95, 1, 'https://picsum.photos/id/2/200/300'),
(3, 'Movie Title 3', 'A hilarious comedy.', 'Comedy', '2023-11-20', 110, 0, 'https://picsum.photos/id/3/200/300'),
(4, 'Marco', 'A gripping thriller.', 'Thriller', '2024-02-10', 130, 1, 'https://picsum.photos/id/4/200/300');

-- --------------------------------------------------------

--
-- Table structure for table `seats`
--

CREATE TABLE `seats` (
  `seatid` int(11) NOT NULL,
  `showtimeid` int(11) NOT NULL,
  `seatnumber` varchar(50) NOT NULL,
  `isbooked` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `seats`
--

INSERT INTO `seats` (`seatid`, `showtimeid`, `seatnumber`, `isbooked`) VALUES
(505, 12, 'A5', 1);

-- --------------------------------------------------------

--
-- Table structure for table `showtimes`
--

CREATE TABLE `showtimes` (
  `showtimeid` int(11) NOT NULL,
  `days` varchar(50) NOT NULL,
  `date` date NOT NULL,
  `price` int(11) NOT NULL,
  `timing` varchar(50) NOT NULL,
  `movieid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `showtimes`
--

INSERT INTO `showtimes` (`showtimeid`, `days`, `date`, `price`, `timing`, `movieid`) VALUES
(3, 'Sunday', '2025-01-01', 300, '125', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tickets`
--

CREATE TABLE `tickets` (
  `ticketid` int(11) NOT NULL,
  `bookingid` int(11) NOT NULL,
  `seatid` int(11) NOT NULL,
  `price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tickets`
--

INSERT INTO `tickets` (`ticketid`, `bookingid`, `seatid`, `price`) VALUES
(505, 67, 5, 300);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userid` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userid`, `name`, `email`, `password`) VALUES
(1, 'Ram', 'ram1@gmail.com', '@Ram123#'),
(2, 'Jackson Wyatt', 'gowuxyxohy@mailinator.com', '$2y$10$Tv4jrXrzoyA8w7h5F8rjHu0JcGyksjiLI.IWMB0IlS7'),
(3, 'Mary Blankenship', 'juxugel@mailinator.com', '$2y$10$ATCIWrGUJk/rG.87rLJa6./ZfzB/DdqcXg.zle2Aj.e'),
(4, 'Idona Gillespie', 'wyzah@mailinator.com', '$2y$10$hwtRZEtqEn2JPSq9oM/dkuNazKBaPerRKYP0rovdHT8'),
(5, 'Rachel Haynes', 'bodadogobo@mailinator.com', '$2y$10$9qZEEFsVqT8fJbwR3olObOtH6ElDVsFPhgTz/a2ulRE'),
(6, 'Kirestin Price', 'behofa@mailinator.com', '$2y$10$233DEXCFDyGiJfT8j2MgveN82bRGG9dbE3X9h8lt0UO'),
(7, 'Moses Hodge', 'bitaken@mailinator.com', '$2y$10$JRMmEQU4qhrBAyixocl6cOyBvdbYx6gdxmss64FindZXukU9oqj4u'),
(8, 'Vaughan Love', 'doloxyreju@mailinator.com', '$2y$10$JD5bSCqYrO9S5OYFoGsw6.58nbhHgvSaB6mhTZjvJqzzuoRqw2yau'),
(9, 'Gretchen Craig', 'kifidiwos@mailinator.com', '$2y$10$CJ3LUvZzL1eOuOSNADKGD.PAW978MUM8MVtmmvPWSZkwJHxybti5G');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`bookingid`),
  ADD KEY `fk_showtime` (`showtimeid`);

--
-- Indexes for table `movies1`
--
ALTER TABLE `movies1`
  ADD PRIMARY KEY (`movieid`);

--
-- Indexes for table `seats`
--
ALTER TABLE `seats`
  ADD PRIMARY KEY (`seatid`);

--
-- Indexes for table `showtimes`
--
ALTER TABLE `showtimes`
  ADD PRIMARY KEY (`showtimeid`),
  ADD KEY `movieid` (`movieid`);

--
-- Indexes for table `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`ticketid`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `bookingid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `movies1`
--
ALTER TABLE `movies1`
  MODIFY `movieid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `seats`
--
ALTER TABLE `seats`
  MODIFY `seatid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=506;

--
-- AUTO_INCREMENT for table `showtimes`
--
ALTER TABLE `showtimes`
  MODIFY `showtimeid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tickets`
--
ALTER TABLE `tickets`
  MODIFY `ticketid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=506;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `booking`
--
ALTER TABLE `booking`
  ADD CONSTRAINT `fk_showtime` FOREIGN KEY (`showtimeid`) REFERENCES `showtimes` (`showtimeid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `showtimes`
--
ALTER TABLE `showtimes`
  ADD CONSTRAINT `movieid` FOREIGN KEY (`movieid`) REFERENCES `movies1` (`movieid`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
