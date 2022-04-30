-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 30, 2022 at 03:37 AM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 7.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `schedule`
--

--
-- Dumping data for table `tasks_table`
--

INSERT INTO `tasks_table` (`id`, `title`, `description`, `deadline`, `assigned_user`, `status`) VALUES
(3, 'yy', 'yy', '2022-04-22', 'user1', 1),
(4, 'yy', 'yy', '2022-04-29', 'user1', 0),
(5, 'no', 'ooo', '2022-04-29', 'user1', 0),
(6, 'ok', 'kk', '2022-05-07', 'user2', 0),
(7, 'no', 'no', '2022-04-28', 'user1', 1),
(8, 'right', 'wrong', '2022-04-30', 'user1', 0),
(9, '2', '2', '2022-04-29', 'user2', 0),
(10, 'bokolaa', 'bokola', '2022-05-19', 'user1', 2),
(11, 'mooshda', 'do it', '2022-05-10', 'user2', 2),
(12, 'mauf', 'maufmauf', '2022-05-20', 'user2', 0),
(15, 'bb', 'bb', '2022-05-06', 'user1', 0),
(16, 'a', 'a', '2022-05-04', 'user2', 0),
(17, 's', 'ss', '2022-05-07', 'user1', 0),
(18, 'dd', 'dd', '2022-05-07', 'user1', 0),
(19, 'fff', 'f', '2022-05-05', 'user1', 0),
(20, 'ggg', 'gg', '2022-05-11', 'user1', 0),
(21, 'qq', 'q', '2022-05-01', 'user1', 0),
(22, 'ww', 'ww', '2022-05-04', 'user2', 0),
(24, 'tt', 'tt', '2022-05-07', 'user1', 0);

--
-- Dumping data for table `user_table`
--

INSERT INTO `user_table` (`id`, `username`, `email`, `password`, `user_type`) VALUES
(5, 'admin1', 'admin1@gmail.com', '21232f297a57a5a743894a0e4a801fc3', 'admin'),
(7, 'user1', 'user1@gmail.com', '24c9e15e52afc47c225b757e7bee1f9d', 'user'),
(8, 'user2', 'user2@gmail.com', 'ee11cbb19052e40b07aac0ca060c23ee', 'user');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
