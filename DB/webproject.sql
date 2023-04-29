-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 29, 2023 at 09:13 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `webproject`
--

-- --------------------------------------------------------

--
-- Table structure for table `credentials`
--

CREATE TABLE `credentials` (
  `user_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `credentials`
--

INSERT INTO `credentials` (`user_id`, `username`, `password`) VALUES
(597896, 'omar', '$2y$10$OGwpp6M2tw1deT9lClPd3uyrhq/ruZc73y1e8JwJAuD3NkAp8Uire'),
(696801, 'omar2', '$2y$10$Lw6t6GeDnpv9RJsuNEbtGu9P/sz6pcAzVCxaXm.NDMz0DVqOBaU2C'),
(907441, 'omar3', '$2y$10$Fo7zGlwV3mqOyrq7wrjOPeKIxOjYcdnAY8PFsg5n6LD4/8ltN8dSq');

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `identity_number` varchar(50) NOT NULL,
  `nationality` varchar(50) NOT NULL,
  `address` varchar(3000) NOT NULL,
  `mobile_number` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `photo` varchar(3000) DEFAULT NULL,
  `qualification` varchar(3000) NOT NULL,
  `experience` varchar(3000) NOT NULL,
  `cv` varchar(3000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`id`, `name`, `identity_number`, `nationality`, `address`, `mobile_number`, `email`, `photo`, `qualification`, `experience`, `cv`) VALUES
(597896, 'omar qalalweh', '12211', 'PS', 'ramallah', '045654', 'omarqalaweh@gmail.com', 'omar.257351354_1243731889474177_5993517193560157553_n.jpg', 'qw', '2', 'omar.257351354_1243731889474177_5993517193560157553_n.jpg'),
(696801, 'salem asam', '123456', 'PS', 'ramallah', '0305454', 'omarqalalweh11@gmail.com', 'omar2.Screenshot 2023-01-19 171832.png', 'eddes', '33', 'omar2.257351354_1243731889474177_5993517193560157553_n.jpg'),
(907441, 'sasa qaq', '21332', 'AS', 'ramallah', '0568347131', 'omarqalalweh.ddss@gmail.com', 'omar3.wallpaperflare.com_wallpaper(4).jpg', '3', '5', 'omar3.wallpaperflare.com_wallpaper(6).jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `task_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `start_date` date NOT NULL,
  `due_date` date NOT NULL,
  `priority` int(11) NOT NULL,
  `assigned_to` int(11) NOT NULL,
  `assigned_by` int(11) NOT NULL,
  `status` int(10) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`task_id`, `title`, `description`, `start_date`, `due_date`, `priority`, `assigned_to`, `assigned_by`, `status`) VALUES
(3, 'omas', 'jkuhkj', '2023-02-15', '2023-02-16', 1, 597896, 696801, 2),
(5, 'hihihi', 'you have to make', '2023-02-15', '2023-02-16', 3, 597896, 696801, 2),
(6, 'sadbikjvcd', 'scdsdcs', '2023-02-15', '2023-02-16', 2, 696801, 597896, 2),
(8, 'dsc', 'lknsclkd', '2023-02-15', '2023-02-06', 3, 696801, 597896, 2),
(9, 'lll', 'efre', '2023-02-16', '2023-02-16', 2, 907441, 597896, 3),
(10, 'ewfe', 'wedsc', '2023-02-16', '2023-02-17', 3, 597896, 696801, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `credentials`
--
ALTER TABLE `credentials`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`task_id`),
  ADD KEY `assigned_to` (`assigned_to`),
  ADD KEY `assigned_by` (`assigned_by`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `task_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `credentials`
--
ALTER TABLE `credentials`
  ADD CONSTRAINT `credentials_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `members` (`id`);

--
-- Constraints for table `tasks`
--
ALTER TABLE `tasks`
  ADD CONSTRAINT `tasks_ibfk_1` FOREIGN KEY (`assigned_to`) REFERENCES `members` (`id`),
  ADD CONSTRAINT `tasks_ibfk_2` FOREIGN KEY (`assigned_by`) REFERENCES `members` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
