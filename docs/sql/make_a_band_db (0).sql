-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 26-Abr-2016 às 20:36
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
-- Estrutura da tabela `bands`
--

CREATE TABLE `bands` (
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `bands`
--

INSERT INTO `bands` (`user_id`, `name`) VALUES
(41, 'the dudes');

-- --------------------------------------------------------

--
-- Estrutura da tabela `bands_requests`
--

CREATE TABLE `bands_requests` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `bands_requests`
--

INSERT INTO `bands_requests` (`id`, `user_id`) VALUES
(1, 41),
(2, 41);

-- --------------------------------------------------------

--
-- Estrutura da tabela `matchs`
--

CREATE TABLE `matchs` (
  `id` int(11) NOT NULL,
  `musician_request_id` int(11) DEFAULT NULL,
  `band_request_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `matchs`
--

INSERT INTO `matchs` (`id`, `musician_request_id`, `band_request_id`) VALUES
(1, 1, 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `musicians`
--

CREATE TABLE `musicians` (
  `user_id` int(11) DEFAULT NULL,
  `birth_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `musicians`
--

INSERT INTO `musicians` (`user_id`, `birth_date`) VALUES
(38, '2014-10-14');

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
  `user_id` int(11) NOT NULL,
  `username` varchar(32) NOT NULL,
  `password` char(255) NOT NULL,
  `first_name` varchar(32) NOT NULL,
  `email` varchar(1024) NOT NULL,
  `last_name` varchar(32) DEFAULT NULL,
  `email_code` varchar(32) NOT NULL,
  `active` int(11) NOT NULL DEFAULT '0',
  `password_recover` int(11) NOT NULL DEFAULT '0',
  `type` int(1) NOT NULL DEFAULT '0',
  `allow_email` int(11) NOT NULL DEFAULT '1',
  `profile` varchar(100) NOT NULL,
  `profile_img_name` varchar(100) NOT NULL,
  `premium` tinyint(1) NOT NULL DEFAULT '0',
  `first_failed_login` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `failed_login_count` int(11) DEFAULT '0',
  `is_locked` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `first_name`, `email`, `last_name`, `email_code`, `active`, `password_recover`, `type`, `allow_email`, `profile`, `profile_img_name`, `premium`, `first_failed_login`, `failed_login_count`, `is_locked`) VALUES
(38, 'thehulk', '$2y$10$VSkKWs5OrpW72.5JsrKxnuDmz9VB.qrzuoyUG0i/Iv3H/rCw0Xpjy', 'hulkinho', 'henriquebroculo@gmail.com', 'silva', '$2y$10$UUGEuKOHMs6AK/rU1DImVennS', 1, 0, 0, 1, '', '', 0, '2016-04-14 14:15:54', 0, 1),
(41, 'tmntninja', '$2y$10$/jCGeFLX.NkFKuW.FQICHeQsOcKzYJWebGe1DQ4xbh70Zpe7QO/uW', 'ninjaBoyszz', 'henrique.gaia@gmail.com', 'aasL', '$2y$10$PNyaBTyB7PLWPR691rw.XePmE', 1, 0, 1, 1, '', '', 0, '2016-04-14 15:27:36', 0, 0),
(44, 'coisinio1', '$2y$10$5mSXDYrgVMhHMyx9xmwn7uVvm4xlZ4eA6iH8kwLOKDjZSOi9QNTQC', 'sdi', 'henrique.perosinho@gmail.com', '', '$2y$10$O6B0Cgn9tkdiQfvcPMJLvOEFE', 1, 0, 0, 1, '', '', 0, '0000-00-00 00:00:00', 0, 0);

--
-- Indexes for dumped tables
--

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
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bands_requests`
--
ALTER TABLE `bands_requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `matchs`
--
ALTER TABLE `matchs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `musicians_requests`
--
ALTER TABLE `musicians_requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;
--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `bands`
--
ALTER TABLE `bands`
  ADD CONSTRAINT `bands_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Limitadores para a tabela `bands_requests`
--
ALTER TABLE `bands_requests`
  ADD CONSTRAINT `bands_requests_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `bands` (`user_id`);

--
-- Limitadores para a tabela `matchs`
--
ALTER TABLE `matchs`
  ADD CONSTRAINT `matchs_ibfk_1` FOREIGN KEY (`musician_request_id`) REFERENCES `musicians_requests` (`id`),
  ADD CONSTRAINT `matchs_ibfk_2` FOREIGN KEY (`band_request_id`) REFERENCES `bands_requests` (`id`);

--
-- Limitadores para a tabela `musicians`
--
ALTER TABLE `musicians`
  ADD CONSTRAINT `musicians_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Limitadores para a tabela `musicians_requests`
--
ALTER TABLE `musicians_requests`
  ADD CONSTRAINT `musicians_requests_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `musicians` (`user_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
