-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 03-Ago-2016 às 17:41
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
(227, '1982-04-01', 'Female'),
(228, '1989-07-26', 'Male'),
(229, '1982-09-11', 'Male'),
(230, '1984-02-03', 'Male'),
(231, '1985-01-05', 'Male');

-- --------------------------------------------------------

--
-- Estrutura da tabela `agents_experience`
--

CREATE TABLE `agents_experience` (
  `id` int(11) NOT NULL,
  `agent_id` int(11) NOT NULL,
  `artist_name` varchar(255) NOT NULL,
  `region` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `city_state` varchar(255) DEFAULT NULL,
  `artist_type` varchar(255) NOT NULL,
  `artist_username` varchar(255) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `main_genre` varchar(255) NOT NULL,
  `number_concerts` int(11) NOT NULL,
  `number_tours` int(11) NOT NULL,
  `number_albums` int(11) NOT NULL,
  `demo_link` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `agents_experience`
--

INSERT INTO `agents_experience` (`id`, `agent_id`, `artist_name`, `region`, `country`, `city_state`, `artist_type`, `artist_username`, `start_date`, `end_date`, `main_genre`, `number_concerts`, `number_tours`, `number_albums`, `demo_link`) VALUES
(1, 227, 'los crocochitos 26', 'North America', 'United States', 'Ricketts, IA', 'Solo Artist', '', '1989-01-04', '2005-08-22', 'Jazz', 100, 14, 4, 'https://www.youtube.com/watch?v=xHVSptF3_G8'),
(2, 228, 'los crocochitos 85', 'North America', 'United States', 'Acmar, AL', 'Solo Artist', '', '2001-01-13', '2006-09-17', 'jazz', 122, 4, 8, 'https://www.youtube.com/watch?v=xHVSptF3_G8'),
(3, 229, 'los crocochitos 62', 'North America', 'United States', 'New York, NY', 'Solo Artist', '', '2003-07-16', '2005-05-12', 'jazz', 437, 49, 48, 'https://www.youtube.com/watch?v=xHVSptF3_G8'),
(4, 230, 'los crocochitos 97', 'North America', 'United States', 'Annandale, MN', 'Solo Artist', '', '2002-09-28', '2006-11-22', 'jazz', 235, 0, 49, 'https://www.youtube.com/watch?v=xHVSptF3_G8'),
(5, 231, 'los crocochitos 73', 'Asia', 'Bhutan', 'Thimphu', 'Band', '', '2001-02-25', '2006-09-27', 'Hip Hop', 8, 34, 44, 'https://www.youtube.com/watch?v=xHVSptF3_G8'),
(6, 120, 'ertyfg', 'Europe', 'Spain', 'Madrid', 'band', '', '2016-07-01', '0000-00-00', 'rock', 0, 0, 0, '');

-- --------------------------------------------------------

--
-- Estrutura da tabela `bands`
--

CREATE TABLE `bands` (
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `formation_date` date NOT NULL,
  `number_elements` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `bands`
--

INSERT INTO `bands` (`user_id`, `name`, `formation_date`, `number_elements`) VALUES
(122, 'the douchebags_1463767549', '1986-10-22', 2),
(131, 'the douchebags_1464281946', '1991-09-22', 6),
(183, 'coir', '1999-02-01', 3);

-- --------------------------------------------------------

--
-- Estrutura da tabela `bands_experience`
--

CREATE TABLE `bands_experience` (
  `id` int(11) NOT NULL,
  `band_id` int(11) NOT NULL,
  `songs_type` varchar(255) NOT NULL,
  `main_genre` varchar(255) NOT NULL,
  `hours_practice` int(11) DEFAULT NULL,
  `number_concerts` int(11) NOT NULL,
  `number_tours` int(11) NOT NULL,
  `number_albums` int(11) NOT NULL,
  `number_songs` int(11) NOT NULL,
  `demo_link` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `bands_experience`
--

INSERT INTO `bands_experience` (`id`, `band_id`, `songs_type`, `main_genre`, `hours_practice`, `number_concerts`, `number_tours`, `number_albums`, `number_songs`, `demo_link`) VALUES
(1, 122, 'Covers', 'rock', 180, 17, 5, 26, 94, 'https://www.youtube.com/watch?v=xHVSptF3_G8'),
(3, 122, 'Both', 'rock', 180, 252, 2, 48, 6, 'https://www.youtube.com/watch?v=xHVSptF3_G8'),
(4, 131, 'Both', 'Doom Metal', 100, 3, 11, 2, 2, 'https://www.youtube.com/watch?v=xHVSptF3_G8'),
(5, 131, 'Both', 'Death Metal', 180, 9, 2, 1, 158, 'https://www.youtube.com/watch?v=xHVSptF3_G8'),
(6, 131, 'Covers', 'Doom Metal', 100, 27, 2, 3, 39, 'https://www.youtube.com/watch?v=xHVSptF3_G8'),
(7, 183, 'Originals', 'rock', 180, 166, 45, 40, 113, 'https://www.youtube.com/watch?v=xHVSptF3_G8'),
(8, 183, 'Originals', 'rock', 180, 476, 11, 1, 70, 'https://www.youtube.com/watch?v=xHVSptF3_G8'),
(9, 183, 'Originals', 'jazz', 360, 441, 41, 39, 21, 'https://www.youtube.com/watch?v=xHVSptF3_G8');

-- --------------------------------------------------------

--
-- Estrutura da tabela `bands_members`
--

CREATE TABLE `bands_members` (
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
-- Extraindo dados da tabela `bands_members`
--

INSERT INTO `bands_members` (`id`, `band_id`, `name`, `birth_date`, `gender`, `instrument`, `join_date`, `username`) VALUES
(13, 131, 'bm_10_band_131a', '1993-12-21', 'Female', 'Guitar', '1991-09-22', ''),
(14, 131, 'bm_11_band_131', '1993-03-02', 'Male', 'Bass', '1991-09-22', ''),
(15, 131, 'bm_12_band_131', '1993-06-16', 'Male', 'Drums', '1991-09-22', ''),
(188, 183, 'bm11', '1993-02-02', 'Male', 'Drums', '1997-05-04', ''),
(190, 183, 'bb', '1993-02-02', 'Male', 'Guitar', '1993-02-03', '');

-- --------------------------------------------------------

--
-- Estrutura da tabela `content`
--

CREATE TABLE `content` (
  `id` int(11) NOT NULL,
  `user_id_from` int(11) NOT NULL,
  `user_id_to` int(11) NOT NULL,
  `content` varchar(500) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `invitations`
--

CREATE TABLE `invitations` (
  `id` int(11) NOT NULL,
  `user_id_from` int(11) NOT NULL,
  `user_id_to` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `invitations`
--

INSERT INTO `invitations` (`id`, `user_id_from`, `user_id_to`, `created_at`) VALUES
(61, 181, 184, '2016-07-31 19:40:30'),
(64, 181, 229, '2016-07-31 19:45:28'),
(65, 131, 227, '2016-08-01 14:36:50'),
(68, 227, 131, '2016-08-01 14:50:33'),
(69, 227, 198, '2016-08-01 14:51:17'),
(70, 181, 131, '2016-08-02 20:32:03'),
(71, 131, 181, '2016-08-03 14:51:53');

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
(118, '2000-01-01', 'Male'),
(121, '1979-08-21', 'Female'),
(181, '1990-07-24', 'Female'),
(184, '1989-10-31', 'Male'),
(198, '1978-08-02', 'Female'),
(225, '1982-11-03', 'Male'),
(226, '1973-07-25', 'Male');

-- --------------------------------------------------------

--
-- Estrutura da tabela `musicians_experience_alone`
--

CREATE TABLE `musicians_experience_alone` (
  `id` int(11) NOT NULL,
  `musician_id` int(11) NOT NULL,
  `instrument` varchar(255) NOT NULL,
  `genre` varchar(255) NOT NULL,
  `hours_practice` int(11) DEFAULT NULL,
  `writes_composes` varchar(255) NOT NULL,
  `sings` varchar(255) NOT NULL,
  `demo_link` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `musicians_experience_alone`
--

INSERT INTO `musicians_experience_alone` (`id`, `musician_id`, `instrument`, `genre`, `hours_practice`, `writes_composes`, `sings`, `demo_link`) VALUES
(18, 181, 'Vocals', 'Doom Metal', 200, 'None', 'Yes', ''),
(20, 184, 'Drums', 'rock', 360, 'Both', 'No', 'https://www.youtube.com/watch?v=xHVSptF3_G8'),
(24, 198, 'Guitar', 'jazz', 360, 'Both', 'No', 'https://www.youtube.com/watch?v=xHVSptF3_G8'),
(32, 225, 'Bass', 'jazz', 180, 'Both', 'Yes', 'https://www.youtube.com/watch?v=xHVSptF3_G8'),
(33, 226, 'Guitar', 'rock', 360, 'Composing', 'No', 'https://www.youtube.com/watch?v=xHVSptF3_G8'),
(35, 181, 'Guitar', 'Jazz', 100, 'Writing', 'Yes', '');

-- --------------------------------------------------------

--
-- Estrutura da tabela `musicians_experience_bands`
--

CREATE TABLE `musicians_experience_bands` (
  `id` int(11) NOT NULL,
  `musician_id` int(11) NOT NULL,
  `band_name` varchar(255) NOT NULL,
  `region` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `city_state` varchar(255) DEFAULT NULL,
  `band_username` varchar(255) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `instrument` varchar(255) NOT NULL,
  `songs_type` varchar(255) NOT NULL,
  `main_genre` varchar(255) NOT NULL,
  `hours_practice` int(11) DEFAULT NULL,
  `number_concerts` int(11) NOT NULL,
  `number_tours` int(11) NOT NULL,
  `number_albums` int(11) NOT NULL,
  `number_songs` int(11) NOT NULL,
  `sings` varchar(255) NOT NULL,
  `demo_link` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `musicians_experience_bands`
--

INSERT INTO `musicians_experience_bands` (`id`, `musician_id`, `band_name`, `region`, `country`, `city_state`, `band_username`, `start_date`, `end_date`, `instrument`, `songs_type`, `main_genre`, `hours_practice`, `number_concerts`, `number_tours`, `number_albums`, `number_songs`, `sings`, `demo_link`) VALUES
(6, 181, '00', 'Asia', 'Bangladesh', 'Dhaka', '', '2001-06-05', '0000-00-00', 'Guitar', 'Originals', 'Doom Metal', 100, 50, 30, 2, 139, 'No', 'https://www.youtube.com/watch?v=xHVSptF3_G8'),
(7, 184, 'the cocochulas 40', 'North America', 'United States', 'Alabama', '', '2003-07-18', '2008-05-05', 'Drums', 'Both', 'jazz', 180, 84, 3, 30, 48, 'No', 'https://www.youtube.com/watch?v=xHVSptF3_G8'),
(11, 198, 'the cocochulas 22', 'North America', 'United States', 'Alabama', '', '2000-09-03', '2005-02-05', 'Guitar', 'Originals', 'jazz', 360, 351, 47, 13, 134, 'No', 'https://www.youtube.com/watch?v=xHVSptF3_G8'),
(19, 225, 'the cocochulas 92', 'North America', 'United States', 'Alabama', '', '2002-03-23', '2007-05-28', 'Guitar', 'Originals', 'jazz', 180, 14, 4, 36, 36, 'No', 'https://www.youtube.com/watch?v=xHVSptF3_G8'),
(20, 226, 'the cocochulas 79', 'North America', 'United States', 'Alabama', '', '2004-06-01', '2006-12-11', 'Guitar', 'Originals', 'jazz', 360, 200, 23, 2, 136, 'No', 'https://www.youtube.com/watch?v=xHVSptF3_G8'),
(21, 181, 'bertyoun', 'Europe', 'Portugal', 'Porto', '', '2008-08-03', '2016-04-03', 'Vocals', 'Both', 'Jazz', 100, 40, 1, 1, 1, 'Yes', '');

-- --------------------------------------------------------

--
-- Estrutura da tabela `pursuits`
--

CREATE TABLE `pursuits` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `role_pursuited` varchar(255) NOT NULL,
  `instrument` varchar(255) NOT NULL,
  `genre` varchar(255) NOT NULL,
  `urgency` varchar(255) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `pursuits`
--

INSERT INTO `pursuits` (`id`, `user_id`, `role_pursuited`, `instrument`, `genre`, `urgency`, `created_at`, `updated_at`) VALUES
(29, 184, 'band', 'Bass', 'rock', '1', '2016-06-22 19:58:01', '2016-06-22 19:58:01'),
(35, 198, 'band', 'Bass', 'rock', '0', '2016-06-23 14:59:46', '2016-06-23 14:59:46'),
(67, 181, 'Band', 'Vocals', 'Jazz', 'Yes', '2016-07-01 14:55:01', '2016-07-24 19:48:26'),
(71, 181, 'Agent', 'Guitar', 'Jazz', 'Yes', '2016-07-01 20:48:36', '2016-07-24 19:48:46'),
(72, 225, 'Agent', 'Vocals', 'jazz', 'Yes', '2016-07-12 17:50:09', '2016-07-12 17:50:09'),
(73, 226, 'Band', 'Guitar', 'jazz', 'Yes', '2016-07-12 17:51:22', '2016-07-12 17:51:22'),
(74, 227, 'Band', '', 'Jazz', 'No', '0000-00-00 00:00:00', '2016-07-30 15:33:32'),
(75, 229, 'Band', '', 'jazz', 'No', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(76, 230, 'Band', '', 'jazz', 'Yes', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(77, 231, 'Band', '', 'jazz', 'Yes', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(78, 131, 'Musician', 'Vocals', 'Jazz', '0', '0000-00-00 00:00:00', '2016-07-24 19:40:08'),
(79, 131, 'Agent', '', 'Jazz', '0', '0000-00-00 00:00:00', '2016-07-30 15:33:06');

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
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `role` varchar(255) NOT NULL,
  `invitation_count` tinyint(4) NOT NULL DEFAULT '0',
  `last_invitation` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `other_details` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `first_name`, `email`, `last_name`, `email_code`, `active`, `password_recover`, `type`, `allow_email`, `profile`, `profile_img_name`, `premium`, `first_failed_login`, `failed_login_count`, `is_locked`, `region`, `country`, `city_state`, `phone_number`, `last_activity`, `last_login`, `is_online`, `created_at`, `updated_at`, `role`, `invitation_count`, `last_invitation`, `other_details`) VALUES
(118, 'user_1', '$2y$10$CzLlcJDgpY7MD4nIRJ24C.Nrzr718yC.AkMuuibKm/EZ8Gyv.3hE.', 'userum', 'henriquebroculo@gmail.com', '', 'email_code', 1, 0, 0, 1, '', '', 0, '0000-00-00 00:00:00', 0, 0, 'Europe', 'Finland', 'Lappi', 0, '0000-00-00 00:00:00', '2016-06-19 15:03:26', 0, '2016-05-20 18:05:24', '2016-06-18 16:05:35', 'musician', 0, '0000-00-00 00:00:00', NULL),
(120, 'user_120', '$2y$10$cMKowuOBLenE5ufrOhYliOGgauXKk/g80Am7s6EeAX6PwKsz.U0Xq', 'user', 'henriquebroculo@gmail.com', '', 'email_code', 1, 0, 0, 1, '', '', 0, '0000-00-00 00:00:00', 0, 0, 'Africa', 'Equatorial Guinea', 'Annobon', 0, '0000-00-00 00:00:00', '2016-06-08 15:43:21', 0, '2016-05-20 18:05:28', '2016-05-25 16:05:52', 'agent', 0, '0000-00-00 00:00:00', NULL),
(121, 'user_121', '$2y$10$LYP4Fd4l1f8dZIgqpAcGZ.ZyERxJicdQIeLUr7B2MEUv3BhEhAsNK', 'user_121', 'henriquebroculo@gmail.com', NULL, 'email_code', 1, 0, 0, 1, '', '', 0, '0000-00-00 00:00:00', 0, 0, 'North America', 'United States', 'Annandale, MN', 0, '0000-00-00 00:00:00', '2016-06-08 15:55:24', 0, '2016-05-20 18:05:47', '2016-07-12 17:55:59', 'musician', 0, '0000-00-00 00:00:00', NULL),
(122, 'user_122', '$2y$10$ip9LPB9dmLbYzl.D8PWw1uiJ8PngkJasZZGVBEE2S6Hez5UO5TAPG', 'use', 'henriquebroculo@gmail.com', '', 'email_code', 1, 0, 0, 1, '', '', 0, '0000-00-00 00:00:00', 0, 0, 'Central America', 'Belize', 'Belmopan', 0, '0000-00-00 00:00:00', '2016-06-02 15:24:04', 0, '2016-05-20 18:05:49', '2016-06-02 15:33:26', 'band', 0, '0000-00-00 00:00:00', NULL),
(131, 'user_131', '$2y$10$3fMo2QeQZkBFfFGcq3vORer67HNrDLdji7IG/LXqIvkmg3hTbtDr.', 'user', 'henriquebroculo@gmail.com', '', 'email_code', 1, 0, 0, 1, '', '', 1, '0000-00-00 00:00:00', 0, 0, 'North America', 'United States', 'New York, NY', 0, '0000-00-00 00:00:00', '2016-08-03 14:50:12', 1, '2016-05-26 16:59:05', '2016-08-03 14:51:53', 'band', 2, '2016-08-03 14:51:53', NULL),
(181, 'user_181', '$2y$10$pTbK46dJCa1bODlS8OI2WeM0GRjcGDxxDtqgb2aI4oGlhkz86lytu', 'chicos', 'henriquebroculo@gmail.com', 'conde', 'email_code', 1, 0, 0, 1, '', '', 1, '2016-07-01 16:01:58', 1, 0, 'North America', 'United States', 'New York, NY', 0, '0000-00-00 00:00:00', '2016-08-03 14:27:15', 1, '2016-06-08 16:07:46', '2016-08-03 14:27:15', 'musician', 1, '2016-08-02 20:32:04', NULL),
(183, 'bandnew', '$2y$10$4ha7NXtSwY7odonWIz3Ix.//5TICJfkO/5Ht9Xoyn/2LkhcVY5SMa', 'bn', 'henrique.gaia@gmail.com', '', '$2y$10$neqE1L1Pgd1rAcz9/UyNOu11ppHGGW60WCSCsuO0EI8F4ff6iv3ge', 1, 0, 0, 1, '', '', 0, '0000-00-00 00:00:00', 0, 0, 'Asia', 'Brunei', 'Belait', 0, '0000-00-00 00:00:00', '2016-07-01 16:08:45', 0, '2016-06-18 18:15:55', '2016-07-01 16:09:15', 'band', 0, '0000-00-00 00:00:00', NULL),
(184, 'user_184', '$2y$10$HUJkZxgrB/FXi.MTOB9FaumNWmNDdEdGpzqfFiurRopNt7IEX6zaS', 'user_184', 'henriquebroculo@gmail.com', NULL, 'email_code', 1, 0, 0, 1, '', '', 0, '0000-00-00 00:00:00', 0, 0, 'North America', 'United States', 'Ricketts, IA', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '2016-06-22 19:58:00', '2016-07-12 17:57:36', 'musician', 0, '0000-00-00 00:00:00', NULL),
(198, 'user_198', '$2y$10$AVcVloJ1ZLWWsewCC1X5Q.810G8oAKqISnG7Hn30Wcm5ElVia/vz6', 'user_198', 'henriquebroculo@gmail.com', 'last', 'email_code', 1, 0, 0, 1, '', '', 0, '0000-00-00 00:00:00', 0, 0, 'Oceania', 'Tonga', 'Vava''u', 0, '0000-00-00 00:00:00', '2016-07-20 16:59:26', 0, '2016-06-23 14:59:45', '2016-08-01 15:34:45', 'musician', 0, '0000-00-00 00:00:00', NULL),
(225, 'user_225', '$2y$10$YnFZjIC6dtrmivbAbqG6wO8KvF/lP7shCWp.op0xFkBrmM7CcA6vu', 'user_225', 'henriquebroculo@gmail.com', NULL, 'email_code', 1, 0, 0, 1, '', '', 0, '0000-00-00 00:00:00', 0, 0, 'North America', 'United States', 'Acmar, AL', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '2016-07-12 17:50:09', '2016-07-12 17:50:09', 'musician', 0, '0000-00-00 00:00:00', NULL),
(226, 'user_226', '$2y$10$TXq2/r1HE6P5sNOiWcnqXOsdMT6bDCRPW9qPTdcXrsJIV5GX8imfG', 'user_226', 'henriquebroculo@gmail.com', NULL, 'email_code', 1, 0, 0, 1, '', '', 0, '0000-00-00 00:00:00', 0, 0, 'North America', 'United States', 'Acmar, AL', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '2016-07-12 17:51:22', '2016-07-12 17:51:22', 'musician', 0, '0000-00-00 00:00:00', NULL),
(227, 'user_227', '$2y$10$nsrk0VeJgE52.mqemsmfJuXWWx1tXGNHGwkqKtME29pBlzaxJDdom', 'user_227', 'henriquebroculo@gmail.com', NULL, 'email_code', 1, 0, 0, 1, '', '', 1, '0000-00-00 00:00:00', 0, 0, 'North America', 'United States', 'New York, NY', 0, '0000-00-00 00:00:00', '2016-08-01 14:55:59', 1, '2016-07-15 15:12:27', '2016-08-01 14:55:59', 'agent', 2, '2016-08-01 14:51:18', NULL),
(228, 'user_228', '$2y$10$TwbCWDVoUVe7q04cCKWDPu.b.uFPDiCrlBcon2YcC8XhjzL/.K95O', 'user_228', 'henriquebroculo@gmail.com', NULL, 'email_code', 1, 0, 0, 1, '', '', 0, '0000-00-00 00:00:00', 0, 0, 'North America', 'United States', 'Acmar, AL', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '2016-07-15 15:15:41', '2016-07-15 15:15:41', 'agent', 0, '0000-00-00 00:00:00', NULL),
(229, 'user_229', '$2y$10$9tU4Esvr3ZUonIB5pee5leY/zDup4pep81zxAgHzp8jOTeUgSBTLO', 'user_229', 'henriquebroculo@gmail.com', NULL, 'email_code', 1, 0, 0, 1, '', '', 0, '0000-00-00 00:00:00', 0, 0, 'North America', 'United States', 'Acmar, AL', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '2016-07-15 15:16:06', '2016-07-15 15:16:06', 'agent', 0, '0000-00-00 00:00:00', NULL),
(230, 'user_230', '$2y$10$PC4tDC71MKQPXHoJnfURpubAg0oiKRsNXAIIxDEoEVGQRmjFMwwwy', 'user_230', 'henriquebroculo@gmail.com', NULL, 'email_code', 1, 0, 0, 1, '', '', 0, '0000-00-00 00:00:00', 0, 0, 'North America', 'United States', 'Acmar, AL', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '2016-07-15 15:16:36', '2016-07-15 15:16:36', 'agent', 0, '0000-00-00 00:00:00', NULL),
(231, 'user_231', '$2y$10$Z1TY//d.LzHadco6LgLfWO1ONtlOR4sBgFa9xwskkTIoKF3P.XewS', 'user_231', 'henriquebroculo@gmail.com', NULL, 'email_code', 1, 0, 0, 1, '', '', 0, '0000-00-00 00:00:00', 0, 0, 'North America', 'United States', 'Acmar, AL', 0, '0000-00-00 00:00:00', '2016-07-23 15:53:36', 0, '2016-07-15 15:19:09', '2016-08-01 15:35:26', 'agent', 0, '0000-00-00 00:00:00', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `agents`
--
ALTER TABLE `agents`
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `agents_experience`
--
ALTER TABLE `agents_experience`
  ADD PRIMARY KEY (`id`),
  ADD KEY `agents_experience_ibfk_1` (`agent_id`);

--
-- Indexes for table `bands`
--
ALTER TABLE `bands`
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `bands_experience`
--
ALTER TABLE `bands_experience`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bands_experience_ibfk_1` (`band_id`);

--
-- Indexes for table `bands_members`
--
ALTER TABLE `bands_members`
  ADD PRIMARY KEY (`id`),
  ADD KEY `band_members_ibfk_1` (`band_id`);

--
-- Indexes for table `content`
--
ALTER TABLE `content`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invitations`
--
ALTER TABLE `invitations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `invitations_ibfk_1` (`user_id_from`),
  ADD KEY `invitations_ibfk_2` (`user_id_to`);

--
-- Indexes for table `musicians`
--
ALTER TABLE `musicians`
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `musicians_experience_alone`
--
ALTER TABLE `musicians_experience_alone`
  ADD PRIMARY KEY (`id`),
  ADD KEY `musicians_experience_alone_ibfk_1` (`musician_id`);

--
-- Indexes for table `musicians_experience_bands`
--
ALTER TABLE `musicians_experience_bands`
  ADD PRIMARY KEY (`id`),
  ADD KEY `musicians_experience_bands_ibfk_1` (`musician_id`);

--
-- Indexes for table `pursuits`
--
ALTER TABLE `pursuits`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pursuit_ibfk_1` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `agents_experience`
--
ALTER TABLE `agents_experience`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `bands_experience`
--
ALTER TABLE `bands_experience`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `bands_members`
--
ALTER TABLE `bands_members`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=191;
--
-- AUTO_INCREMENT for table `invitations`
--
ALTER TABLE `invitations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;
--
-- AUTO_INCREMENT for table `musicians_experience_alone`
--
ALTER TABLE `musicians_experience_alone`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
--
-- AUTO_INCREMENT for table `musicians_experience_bands`
--
ALTER TABLE `musicians_experience_bands`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `pursuits`
--
ALTER TABLE `pursuits`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=232;
--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `agents`
--
ALTER TABLE `agents`
  ADD CONSTRAINT `agents_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `agents_experience`
--
ALTER TABLE `agents_experience`
  ADD CONSTRAINT `agents_experience_ibfk_1` FOREIGN KEY (`agent_id`) REFERENCES `agents` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `bands`
--
ALTER TABLE `bands`
  ADD CONSTRAINT `bands_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `bands_experience`
--
ALTER TABLE `bands_experience`
  ADD CONSTRAINT `bands_experience_ibfk_1` FOREIGN KEY (`band_id`) REFERENCES `bands` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `bands_members`
--
ALTER TABLE `bands_members`
  ADD CONSTRAINT `bands_members_ibfk_1` FOREIGN KEY (`band_id`) REFERENCES `bands` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `invitations`
--
ALTER TABLE `invitations`
  ADD CONSTRAINT `invitations_ibfk_1` FOREIGN KEY (`user_id_from`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `invitations_ibfk_2` FOREIGN KEY (`user_id_to`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `musicians`
--
ALTER TABLE `musicians`
  ADD CONSTRAINT `musicians_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `musicians_experience_alone`
--
ALTER TABLE `musicians_experience_alone`
  ADD CONSTRAINT `musicians_experience_alone_ibfk_1` FOREIGN KEY (`musician_id`) REFERENCES `musicians` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `musicians_experience_bands`
--
ALTER TABLE `musicians_experience_bands`
  ADD CONSTRAINT `musicians_experience_bands_ibfk_1` FOREIGN KEY (`musician_id`) REFERENCES `musicians` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `pursuits`
--
ALTER TABLE `pursuits`
  ADD CONSTRAINT `pursuits_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
