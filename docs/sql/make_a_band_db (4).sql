-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 26-Maio-2016 às 19:00
-- Versão do servidor: 10.1.9-MariaDB
-- PHP Version: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `make_a_band_db`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `agents`
--

CREATE TABLE `agents` (
  `user_id` int(11) DEFAULT NULL,
  `birth_date` date NOT NULL,
  `gender` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `agents`
--

INSERT INTO `agents` (`user_id`, `birth_date`, `gender`) VALUES
(120, '1997-01-06', 'Female'),
(123, '1994-06-08', 'Female');

-- --------------------------------------------------------

--
-- Estrutura da tabela `bands`
--

CREATE TABLE `bands` (
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `formation_date` date NOT NULL,
  `number_elements` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `bands`
--

INSERT INTO `bands` (`user_id`, `name`, `formation_date`, `number_elements`) VALUES
(122, 'the douchebags_1463767549', '1986-10-22', 9),
(126, '', '0000-00-00', 0),
(127, 'the douchebags_1464281489', '2002-12-14', 7),
(128, 'the douchebags_1464281625', '1980-06-22', 15),
(129, 'the douchebags_1464281644', '1990-11-14', 16),
(130, 'the douchebags_1464281926', '1999-08-17', 13),
(131, 'the douchebags_1464281946', '1991-09-22', 19);

-- --------------------------------------------------------

--
-- Estrutura da tabela `band_members`
--

CREATE TABLE `band_members` (
  `id` int(11) NOT NULL,
  `band_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `birth_date` date NOT NULL,
  `gender` varchar(255) NOT NULL,
  `instrument` varchar(255) NOT NULL,
  `join_date` date NOT NULL,
  `username` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `band_members`
--

INSERT INTO `band_members` (`id`, `band_id`, `name`, `birth_date`, `gender`, `instrument`, `join_date`, `username`) VALUES
(3, 122, 'bm_u_band_122', '1976-08-06', 'Male', 'Guitar', '1986-10-22', ''),
(4, 131, 'bm_1_band_131', '1972-06-12', 'Female', 'Vocals', '1991-09-22', ''),
(5, 131, 'bm_2_band_131', '1989-06-03', 'Male', 'Bass', '1991-09-22', ''),
(6, 131, 'bm_3_band_131', '1988-02-23', 'Female', 'Drums', '1991-09-22', ''),
(7, 131, 'bm_4_band_131', '1978-04-19', 'Female', 'Drums', '1991-09-22', ''),
(8, 131, 'bm_5_band_131', '1971-07-16', 'Female', 'Drums', '1991-09-22', ''),
(9, 131, 'bm_6_band_131', '1987-03-29', 'Female', 'Guitar', '1991-09-22', ''),
(10, 131, 'bm_7_band_131', '1976-04-16', 'Female', 'Drums', '1991-09-22', ''),
(11, 131, 'bm_8_band_131', '1971-01-10', 'Male', 'Guitar', '1991-09-22', ''),
(12, 131, 'bm_9_band_131', '1989-08-18', 'Male', 'Guitar', '1991-09-22', ''),
(13, 131, 'bm_10_band_131', '1983-12-21', 'Female', 'Guitar', '1991-09-22', ''),
(14, 131, 'bm_11_band_131', '1973-03-02', 'Male', 'Bass', '1991-09-22', ''),
(15, 131, 'bm_12_band_131', '1980-06-16', 'Male', 'Drums', '1991-09-22', ''),
(16, 131, 'bm_13_band_131', '1981-05-14', 'Male', 'Bass', '1991-09-22', ''),
(17, 131, 'bm_14_band_131', '1970-07-20', 'Female', 'Drums', '1991-09-22', ''),
(18, 131, 'bm_15_band_131', '1983-02-12', 'Male', 'Bass', '1991-09-22', ''),
(19, 131, 'bm_16_band_131', '1973-08-14', 'Female', 'Guitar', '1991-09-22', ''),
(20, 131, 'bm_17_band_131', '1970-06-08', 'Male', 'Guitar', '1991-09-22', ''),
(21, 131, 'bm_18_band_131', '1970-10-31', 'Female', 'Guitar', '1991-09-22', ''),
(22, 131, 'bm_19_band_131', '1986-10-19', 'Male', 'Drums', '1991-09-22', '');

-- --------------------------------------------------------

--
-- Estrutura da tabela `musicians`
--

CREATE TABLE `musicians` (
  `user_id` int(11) DEFAULT NULL,
  `birth_date` date NOT NULL,
  `gender` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `musicians`
--

INSERT INTO `musicians` (`user_id`, `birth_date`, `gender`) VALUES
(118, '1999-01-04', 'Male'),
(121, '1979-08-21', 'Female');

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(32) NOT NULL,
  `password` char(255) NOT NULL,
  `first_name` varchar(32) NOT NULL,
  `email` varchar(1024) NOT NULL,
  `last_name` varchar(32) DEFAULT NULL,
  `email_code` varchar(255) NOT NULL,
  `active` int(11) NOT NULL DEFAULT '0',
  `password_recover` int(11) NOT NULL DEFAULT '0',
  `type` int(1) NOT NULL DEFAULT '0',
  `allow_email` int(11) NOT NULL DEFAULT '1',
  `profile` varchar(100) NOT NULL,
  `profile_img_name` varchar(100) NOT NULL,
  `premium` tinyint(1) NOT NULL DEFAULT '0',
  `first_failed_login` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `failed_login_count` int(11) DEFAULT '0',
  `is_locked` tinyint(4) NOT NULL DEFAULT '0',
  `region` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `city_state` varchar(255) DEFAULT NULL,
  `phone_number` bigint(255) NOT NULL,
  `last_activity` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `last_login` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `is_online` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `role` varchar(255) NOT NULL,
  `other_details` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `first_name`, `email`, `last_name`, `email_code`, `active`, `password_recover`, `type`, `allow_email`, `profile`, `profile_img_name`, `premium`, `first_failed_login`, `failed_login_count`, `is_locked`, `region`, `country`, `city_state`, `phone_number`, `last_activity`, `last_login`, `is_online`, `created_at`, `updated_at`, `role`, `other_details`) VALUES
(118, 'user_1', '$2y$10$CzLlcJDgpY7MD4nIRJ24C.Nrzr718yC.AkMuuibKm/EZ8Gyv.3hE.', 'userum', 'henriquebroculo@gmail.com', '', 'email_code', 1, 0, 0, 1, '', '', 0, '0000-00-00 00:00:00', 0, 0, 'Europe', 'Finland', 'Etela-Suomen Laani', 0, '0000-00-00 00:00:00', '2016-05-26 14:51:28', 0, '2016-05-20 18:05:24', '2016-05-25 16:07:32', 'musician', NULL),
(120, 'user_120', '$2y$10$cMKowuOBLenE5ufrOhYliOGgauXKk/g80Am7s6EeAX6PwKsz.U0Xq', 'user', 'henriquebroculo@gmail.com', '', 'email_code', 1, 0, 0, 1, '', '', 0, '0000-00-00 00:00:00', 0, 0, 'Africa', 'Equatorial Guinea', 'Annobon', 0, '0000-00-00 00:00:00', '2016-05-25 17:09:45', 0, '2016-05-20 18:05:28', '2016-05-25 16:05:52', 'agent', NULL),
(121, 'user_121', '$2y$10$LYP4Fd4l1f8dZIgqpAcGZ.ZyERxJicdQIeLUr7B2MEUv3BhEhAsNK', 'user_121', 'henriquebroculo@gmail.com', NULL, 'email_code', 1, 0, 0, 1, '', '', 0, '0000-00-00 00:00:00', 0, 0, 'North America', 'United States', 'Alabama', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '2016-05-20 18:05:47', '0000-00-00 00:00:00', 'musician', NULL),
(122, 'user_122', '$2y$10$ip9LPB9dmLbYzl.D8PWw1uiJ8PngkJasZZGVBEE2S6Hez5UO5TAPG', 'user_122', 'henriquebroculo@gmail.com', NULL, 'email_code', 1, 0, 0, 1, '', '', 0, '0000-00-00 00:00:00', 0, 0, 'North America', 'United States', 'Alabama', 0, '0000-00-00 00:00:00', '2016-05-25 16:18:57', 0, '2016-05-20 18:05:49', '0000-00-00 00:00:00', 'band', NULL),
(123, 'user_123', '$2y$10$KieOiFVuICBzwc7dRz3cLO0gtP8beJ29iDAu/oaCq8.yERNaxJ/G.', 'user_123', 'henriquebroculo@gmail.com', NULL, 'email_code', 1, 0, 0, 1, '', '', 0, '0000-00-00 00:00:00', 0, 0, 'North America', 'United States', 'Alabama', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '2016-05-20 18:05:51', '0000-00-00 00:00:00', 'agent', NULL),
(126, 'qwerty1', '$2y$10$601UeACmA.KaNsxzcrhMP.6wBHguanDEu54Jn2yuyvEcEK5x92fOq', 'fname', 'henrique.perosinho@gmail.com', NULL, '$2y$10$5.k47QVIwdluSVy/RqfZIuurf7HTen2lcOonXkbOZyMYmxlofdD2m', 0, 0, 0, 1, '', '', 0, '0000-00-00 00:00:00', 0, 0, 'Asia', 'Indonesia', 'Jakarta', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '2016-05-25 15:42:54', '0000-00-00 00:00:00', 'band', NULL),
(127, 'user_127', '$2y$10$M9v6ZamUbo2dMSpyFjPYUe8kDgGhais8DiueEZJyT2mIwdKRUDZ9a', 'user_127', 'henriquebroculo@gmail.com', NULL, 'email_code', 1, 0, 0, 1, '', '', 0, '0000-00-00 00:00:00', 0, 0, 'North America', 'United States', 'Alabama', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '2016-05-26 16:51:28', '0000-00-00 00:00:00', 'band', NULL),
(128, 'user_128', '$2y$10$AOAcGO4nBx1iJiZBPEW/b.fHWJGjxEi38JKRW48dQWPkdwTbWSNv6', 'user_128', 'henriquebroculo@gmail.com', NULL, 'email_code', 1, 0, 0, 1, '', '', 0, '0000-00-00 00:00:00', 0, 0, 'North America', 'United States', 'Alabama', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '2016-05-26 16:53:45', '0000-00-00 00:00:00', 'band', NULL),
(129, 'user_129', '$2y$10$rwkjcA8uXhqk62UEXM4KwOWdqlAl4MOpyCEY0lMsRK4mFenCjfeXe', 'user_129', 'henriquebroculo@gmail.com', NULL, 'email_code', 1, 0, 0, 1, '', '', 0, '0000-00-00 00:00:00', 0, 0, 'North America', 'United States', 'Alabama', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '2016-05-26 16:54:04', '0000-00-00 00:00:00', 'band', NULL),
(130, 'user_130', '$2y$10$akCDs8Py2vZSu/5xYPrIH.Gi.HllMSoYYnUhZuY1osj/QIqfF/8hy', 'user_130', 'henriquebroculo@gmail.com', NULL, 'email_code', 1, 0, 0, 1, '', '', 0, '0000-00-00 00:00:00', 0, 0, 'North America', 'United States', 'Alabama', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '2016-05-26 16:58:46', '0000-00-00 00:00:00', 'band', NULL),
(131, 'user_131', '$2y$10$O8TzfOLM417r1PlbxrLwE.EuWzgbZYy4ykb5wZ3GQ3jCG/EoZ63iq', 'user_131', 'henriquebroculo@gmail.com', NULL, 'email_code', 1, 0, 0, 1, '', '', 0, '0000-00-00 00:00:00', 0, 0, 'North America', 'United States', 'Alabama', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '2016-05-26 16:59:05', '0000-00-00 00:00:00', 'band', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `agents`
--
ALTER TABLE `agents`
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `bands`
--
ALTER TABLE `bands`
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `band_members`
--
ALTER TABLE `band_members`
  ADD PRIMARY KEY (`id`),
  ADD KEY `band_members_ibfk_1` (`band_id`);

--
-- Indexes for table `musicians`
--
ALTER TABLE `musicians`
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `band_members`
--
ALTER TABLE `band_members`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=132;
--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `agents`
--
ALTER TABLE `agents`
  ADD CONSTRAINT `agents_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `bands`
--
ALTER TABLE `bands`
  ADD CONSTRAINT `bands_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `band_members`
--
ALTER TABLE `band_members`
  ADD CONSTRAINT `band_members_ibfk_1` FOREIGN KEY (`band_id`) REFERENCES `bands` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `musicians`
--
ALTER TABLE `musicians`
  ADD CONSTRAINT `musicians_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
