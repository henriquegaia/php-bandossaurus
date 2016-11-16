-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 19-Maio-2016 às 18:23
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
(117, '0000-00-00', ''),
(118, '0000-00-00', ''),
(119, '0000-00-00', ''),
(120, '0000-00-00', ''),
(121, '0000-00-00', '');

-- --------------------------------------------------------

--
-- Estrutura da tabela `bands`
--

CREATE TABLE `bands` (
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `formation_date` date NOT NULL,
  `number_elements` int(11) NOT NULL,
  `songs_type` varchar(255) NOT NULL,
  `main_genre` varchar(255) NOT NULL,
  `hours_practise` int(11) NOT NULL,
  `number_records` int(11) NOT NULL,
  `number_concerts` int(11) NOT NULL,
  `number_tours` int(11) NOT NULL,
  `number_albums` int(11) NOT NULL,
  `number_songs` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `bands`
--

INSERT INTO `bands` (`user_id`, `name`, `formation_date`, `number_elements`, `songs_type`, `main_genre`, `hours_practise`, `number_records`, `number_concerts`, `number_tours`, `number_albums`, `number_songs`) VALUES
(112, '', '0000-00-00', 0, '', '', 0, 0, 0, 0, 0, 0),
(113, '', '0000-00-00', 0, '', '', 0, 0, 0, 0, 0, 0),
(114, '', '0000-00-00', 0, '', '', 0, 0, 0, 0, 0, 0),
(115, '', '0000-00-00', 0, '', '', 0, 0, 0, 0, 0, 0),
(116, '', '0000-00-00', 0, '', '', 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `bands_requests`
--

CREATE TABLE `bands_requests` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `matchs`
--

CREATE TABLE `matchs` (
  `id` int(11) NOT NULL,
  `musician_request_id` int(11) DEFAULT NULL,
  `band_request_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
(38, '2014-10-14', ''),
(107, '0000-00-00', ''),
(108, '0000-00-00', ''),
(109, '0000-00-00', ''),
(110, '0000-00-00', ''),
(111, '0000-00-00', '');

-- --------------------------------------------------------

--
-- Estrutura da tabela `musicians_requests`
--

CREATE TABLE `musicians_requests` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `musicians_requests`
--

INSERT INTO `musicians_requests` (`id`, `user_id`) VALUES
(1, 38),
(2, 38);

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
  `city` varchar(255) NOT NULL,
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

INSERT INTO `users` (`id`, `username`, `password`, `first_name`, `email`, `last_name`, `email_code`, `active`, `password_recover`, `type`, `allow_email`, `profile`, `profile_img_name`, `premium`, `first_failed_login`, `failed_login_count`, `is_locked`, `region`, `country`, `city`, `phone_number`, `last_activity`, `last_login`, `is_online`, `created_at`, `updated_at`, `role`, `other_details`) VALUES
(38, 'thehulk', '$2y$10$04bTOxX2uOF/b1.Iqjsd2ehy6R3Fi5ALCcJnLPVNQd.dn0kBIPGka', 'coisos', 'henriquebroculo@gmail.com', 'dasilvas', '$2y$10$UUGEuKOHMs6AK/rU1DImVennS', 1, 0, 1, 1, '', '', 0, '0000-00-00 00:00:00', 0, 0, '', '', '', 0, '0000-00-00 00:00:00', '2016-05-18 18:07:21', 1, '0000-00-00 00:00:00', '2016-05-18 15:38:56', '', ''),
(107, 'user_39', '$2y$10$Crb9.rAf0H1Sn1IZdcUyl./P1.qJJqGT.fzrJOroLVrebe6IG0C5O', 'user_39', 'henriquebroculo@gmail.com', NULL, 'email_code', 1, 0, 0, 1, '', '', 0, '0000-00-00 00:00:00', 0, 0, 'region', '0', '1', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '2016-05-19 16:20:46', '0000-00-00 00:00:00', 'musician', NULL),
(108, 'user_40', '$2y$10$g2ZL/4uiUelm.zeUcysugOBPuEU.NDl3FWGAxbueSJyrtr9wtlIFW', 'user_40', 'henriquebroculo@gmail.com', NULL, 'email_code', 1, 0, 0, 1, '', '', 0, '0000-00-00 00:00:00', 0, 0, 'region', '0', '1', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '2016-05-19 16:20:48', '0000-00-00 00:00:00', 'musician', NULL),
(109, 'user_41', '$2y$10$.m2n7bDoVFor3mZyIprg.urLJ7O5ehdJh8i6v7EQr7SfFlJFVfMSS', 'user_41', 'henriquebroculo@gmail.com', NULL, 'email_code', 1, 0, 0, 1, '', '', 0, '0000-00-00 00:00:00', 0, 0, 'region', '1', '0', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '2016-05-19 16:20:50', '0000-00-00 00:00:00', 'musician', NULL),
(110, 'user_42', '$2y$10$w2/lcbgjkLecywBvqmh7tuaz/yVhG3nbNcrtmt4DptESxZiQe/R1.', 'user_42', 'henriquebroculo@gmail.com', NULL, 'email_code', 1, 0, 0, 1, '', '', 0, '0000-00-00 00:00:00', 0, 0, 'region', '0', '0', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '2016-05-19 16:20:52', '0000-00-00 00:00:00', 'musician', NULL),
(111, 'user_43', '$2y$10$X0/qyro2cr9HnBaHG/V7WuaWiRWxToGu0IERNwWld1Wo2UELGmH1a', 'user_43', 'henriquebroculo@gmail.com', NULL, 'email_code', 1, 0, 0, 1, '', '', 0, '0000-00-00 00:00:00', 0, 0, 'region', '0', '0', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '2016-05-19 16:20:54', '0000-00-00 00:00:00', 'musician', NULL),
(112, 'user_112', '$2y$10$AmPvCN9plmOxs6uXgqYeMOm/Xfd9nVGHKIjlHhlEf4t1lc26Oro7O', 'user_112', 'henriquebroculo@gmail.com', NULL, 'email_code', 1, 0, 0, 1, '', '', 0, '0000-00-00 00:00:00', 0, 0, 'region', '0', '1', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '2016-05-19 16:20:56', '0000-00-00 00:00:00', 'band', NULL),
(113, 'user_113', '$2y$10$f0nu1Kyd28dB.wVhQArN3OElvzdRo51CL9JCEju8PoUaxTh1Qv.EW', 'user_113', 'henriquebroculo@gmail.com', NULL, 'email_code', 1, 0, 0, 1, '', '', 0, '0000-00-00 00:00:00', 0, 0, 'region', '1', '1', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '2016-05-19 16:20:59', '0000-00-00 00:00:00', 'band', NULL),
(114, 'user_114', '$2y$10$TXLDrhgYdEq1XRIKzlz6oeWZGNBc8bCa/92WHIu3OUuuF8TvGayHG', 'user_114', 'henriquebroculo@gmail.com', NULL, 'email_code', 1, 0, 0, 1, '', '', 0, '0000-00-00 00:00:00', 0, 0, 'region', '0', '1', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '2016-05-19 16:21:01', '0000-00-00 00:00:00', 'band', NULL),
(115, 'user_115', '$2y$10$50uLNa7GvQK1di.h3rCD5Oco49FKi8zkPFog5CGf6bixWGD0tWFx2', 'user_115', 'henriquebroculo@gmail.com', NULL, 'email_code', 1, 0, 0, 1, '', '', 0, '0000-00-00 00:00:00', 0, 0, 'region', '1', '1', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '2016-05-19 16:21:03', '0000-00-00 00:00:00', 'band', NULL),
(116, 'user_116', '$2y$10$.Cej8zvEJuxsFy69AsaeoOufAxuDeiCpq4aMiQfIt578oJ2qiLm5u', 'user_116', 'henriquebroculo@gmail.com', NULL, 'email_code', 1, 0, 0, 1, '', '', 0, '0000-00-00 00:00:00', 0, 0, 'region', '0', '1', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '2016-05-19 16:21:05', '0000-00-00 00:00:00', 'band', NULL),
(117, 'user_117', '$2y$10$b8RiTKRHj/iWpR4xT3/NMe1vkIAC8Xog4q4xTJlz6g98Mztcc4ytm', 'user_117', 'henriquebroculo@gmail.com', NULL, 'email_code', 1, 0, 0, 1, '', '', 0, '0000-00-00 00:00:00', 0, 0, 'region', '0', '1', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '2016-05-19 16:21:07', '0000-00-00 00:00:00', 'agent', NULL),
(118, 'user_118', '$2y$10$MkcUDBV5Yfo8y4O1kNFEr.F0dvo0eshn6UsZmhkpWtS21StlZko2O', 'user_118', 'henriquebroculo@gmail.com', NULL, 'email_code', 1, 0, 0, 1, '', '', 0, '0000-00-00 00:00:00', 0, 0, 'region', '1', '0', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '2016-05-19 16:21:10', '0000-00-00 00:00:00', 'agent', NULL),
(119, 'user_119', '$2y$10$mHmwgQSxkArtk9v8kSw2/Op8CrIX2erUGT84Y/uC47EFSC3/RvU0m', 'user_119', 'henriquebroculo@gmail.com', NULL, 'email_code', 1, 0, 0, 1, '', '', 0, '0000-00-00 00:00:00', 0, 0, 'region', '1', '0', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '2016-05-19 16:21:12', '0000-00-00 00:00:00', 'agent', NULL),
(120, 'user_120', '$2y$10$TuMs9rZX6y9rkXMKLVL8q.hJwQyVaTIYWcvb41t4TXN9nDJ9iBzZG', 'user_120', 'henriquebroculo@gmail.com', NULL, 'email_code', 1, 0, 0, 1, '', '', 0, '0000-00-00 00:00:00', 0, 0, 'region', '1', '1', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '2016-05-19 16:21:14', '0000-00-00 00:00:00', 'agent', NULL),
(121, 'user_121', '$2y$10$KZQqPC/modRSR.8YPM25UOErSyUJH7bSywrpOpboz40fDNXIhFNZ6', 'user_121', 'henriquebroculo@gmail.com', NULL, 'email_code', 1, 0, 0, 1, '', '', 0, '0000-00-00 00:00:00', 0, 0, 'region', '1', '0', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '2016-05-19 16:21:16', '0000-00-00 00:00:00', 'agent', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `agents`
--
ALTER TABLE `agents`
  ADD KEY `agents_ibfk_1` (`user_id`);

--
-- Indexes for table `bands`
--
ALTER TABLE `bands`
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `bands_requests`
--
ALTER TABLE `bands_requests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `matchs`
--
ALTER TABLE `matchs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `musician_request_id` (`musician_request_id`),
  ADD KEY `band_request_id` (`band_request_id`);

--
-- Indexes for table `musicians`
--
ALTER TABLE `musicians`
  ADD KEY `user_ind` (`user_id`);

--
-- Indexes for table `musicians_requests`
--
ALTER TABLE `musicians_requests`
  ADD PRIMARY KEY (`id`),
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
-- AUTO_INCREMENT for table `bands_requests`
--
ALTER TABLE `bands_requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `matchs`
--
ALTER TABLE `matchs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `musicians_requests`
--
ALTER TABLE `musicians_requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=122;
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
-- Limitadores para a tabela `bands_requests`
--
ALTER TABLE `bands_requests`
  ADD CONSTRAINT `bands_requests_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `bands` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `matchs`
--
ALTER TABLE `matchs`
  ADD CONSTRAINT `matchs_ibfk_1` FOREIGN KEY (`musician_request_id`) REFERENCES `musicians_requests` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `matchs_ibfk_2` FOREIGN KEY (`band_request_id`) REFERENCES `bands_requests` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `musicians`
--
ALTER TABLE `musicians`
  ADD CONSTRAINT `musicians_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `musicians_requests`
--
ALTER TABLE `musicians_requests`
  ADD CONSTRAINT `musicians_requests_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `musicians` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
