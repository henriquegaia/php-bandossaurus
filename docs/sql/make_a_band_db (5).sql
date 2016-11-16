-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 21-Jun-2016 às 17:38
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
(123, '1994-06-08', 'Female'),
(178, '1984-01-02', 'Male');

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
  `number_records` int(11) NOT NULL,
  `number_concerts` int(11) NOT NULL,
  `number_tours` int(11) NOT NULL,
  `number_albums` int(11) NOT NULL,
  `demo_link` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `agents_experience`
--

INSERT INTO `agents_experience` (`id`, `agent_id`, `artist_name`, `region`, `country`, `city_state`, `artist_type`, `artist_username`, `start_date`, `end_date`, `main_genre`, `number_records`, `number_concerts`, `number_tours`, `number_albums`, `demo_link`) VALUES
(2, 178, 'los crocochitos 7', 'Europe', 'Albania', 'Tirana', 'Band', '', '2002-07-31', '0000-00-00', 'rock', 0, 14, 12, 24, 'https://www.youtube.com/watch?v=xHVSptF3_G8');

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
(127, 'the douchebags_1464281489', '2002-12-14', 7),
(128, 'the douchebags_1464281625', '1980-06-22', 15),
(129, 'the douchebags_1464281644', '1990-11-14', 16),
(130, 'the douchebags_1464281926', '1999-08-17', 13),
(131, 'the douchebags_1464281946', '1991-09-22', 6),
(132, 'the douchebags_1464282058', '1977-08-03', 13),
(143, 'the douchebags_1464286502', '1974-03-12', 11),
(179, 'the douchebags_1465397409', '1987-05-04', 4),
(180, 'the douchebags_1465397429', '2004-12-05', 8),
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
  `hours_practise` varchar(255) NOT NULL,
  `number_records` int(11) NOT NULL,
  `number_concerts` int(11) NOT NULL,
  `number_tours` int(11) NOT NULL,
  `number_albums` int(11) NOT NULL,
  `number_songs` int(11) NOT NULL,
  `demo_link` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `bands_experience`
--

INSERT INTO `bands_experience` (`id`, `band_id`, `songs_type`, `main_genre`, `hours_practise`, `number_records`, `number_concerts`, `number_tours`, `number_albums`, `number_songs`, `demo_link`) VALUES
(3, 179, 'Covers', 'rock', '360', 0, 0, 0, 0, 0, 'https://www.youtube.com/watch?v=xHVSptF3_G8'),
(4, 180, 'Originals', 'jazz', '360', 14, 336, 16, 14, 120, 'https://www.youtube.com/watch?v=xHVSptF3_G8'),
(5, 179, 'Covers', 'rock', '360', 47, 413, 17, 39, 0, 'https://www.youtube.com/watch?v=xHVSptF3_G8'),
(10, 179, 'Originals', 'rock', '180', 0, 0, 0, 11, 0, '');

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
(13, 131, 'bm_10_band_131a', '1983-12-21', 'Female', 'Guitar', '1991-09-22', ''),
(14, 131, 'bm_11_band_131', '1973-03-02', 'Male', 'Bass', '1991-09-22', ''),
(15, 131, 'bm_12_band_131', '1980-06-16', 'Male', 'Drums', '1991-09-22', ''),
(144, 143, 'bm_1_band_143', '1979-08-19', 'Female', 'Guitar', '1974-03-12', ''),
(145, 143, 'bm_2_band_143', '1972-03-28', 'Female', 'Bass', '1974-03-12', ''),
(146, 143, 'bm_3_band_143', '1986-04-20', 'Female', 'Vocals', '1974-03-12', ''),
(147, 143, 'bm_4_band_143', '1972-07-28', 'Female', 'Vocals', '1974-03-12', ''),
(148, 143, 'bm_5_band_143', '1981-08-12', 'Male', 'Bass', '1974-03-12', ''),
(149, 143, 'bm_6_band_143', '1979-04-22', 'Female', 'Guitar', '1974-03-12', ''),
(150, 143, 'bm_7_band_143', '1984-11-09', 'Female', 'Drums', '1974-03-12', ''),
(151, 143, 'bm_8_band_143', '1983-10-31', 'Female', 'Bass', '1974-03-12', ''),
(152, 143, 'bm_9_band_143', '1977-08-31', 'Male', 'Vocals', '1974-03-12', ''),
(153, 143, 'bm_10_band_143', '1978-04-29', 'Male', 'Vocals', '1974-03-12', ''),
(154, 143, 'bm_11_band_143', '1971-03-15', 'Female', 'Vocals', '1974-03-12', ''),
(168, 179, 'bm_1_band_179', '1976-11-12', 'Female', 'Drums', '1987-05-04', ''),
(169, 179, 'bm_2_band_179', '1974-03-13', 'Female', 'Guitar', '1987-05-04', ''),
(170, 179, 'bm_3_band_179', '1979-06-11', 'Male', 'Bass', '1987-05-04', ''),
(171, 179, 'bm_4_band_179', '1975-10-09', 'Female', 'Drums', '1987-05-04', ''),
(173, 180, 'bm_1_band_180', '1982-12-31', 'Male', 'Vocals', '2004-12-05', ''),
(174, 180, 'bm_2_band_180', '1975-12-26', 'Female', 'Drums', '2004-12-05', ''),
(175, 180, 'bm_3_band_180', '1984-11-02', 'Female', 'Vocals', '2004-12-05', ''),
(176, 180, 'bm_4_band_180', '1984-01-10', 'Male', 'Vocals', '2004-12-05', ''),
(177, 180, 'bm_5_band_180', '1982-07-21', 'Male', 'Bass', '2004-12-05', ''),
(178, 180, 'bm_6_band_180', '1970-05-09', 'Female', 'Guitar', '2004-12-05', ''),
(179, 180, 'bm_7_band_180', '1977-08-10', 'Male', 'Guitar', '2004-12-05', ''),
(180, 180, 'bm_8_band_180', '1976-05-17', 'Female', 'Drums', '2004-12-05', ''),
(188, 183, 'bm11', '1993-02-02', 'Male', 'Drums', '1997-05-04', ''),
(190, 183, 'bb', '1993-02-02', 'Male', 'Guitar', '1993-02-03', '');

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
(145, '0000-00-00', ''),
(181, '1990-07-24', 'Female');

-- --------------------------------------------------------

--
-- Estrutura da tabela `musicians_experience_alone`
--

CREATE TABLE `musicians_experience_alone` (
  `id` int(11) NOT NULL,
  `musician_id` int(11) NOT NULL,
  `instrument` varchar(255) NOT NULL,
  `genre` varchar(255) NOT NULL,
  `hours_practise` int(11) NOT NULL,
  `writes_composes` varchar(255) NOT NULL,
  `sings` varchar(255) NOT NULL,
  `demo_link` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `musicians_experience_alone`
--

INSERT INTO `musicians_experience_alone` (`id`, `musician_id`, `instrument`, `genre`, `hours_practise`, `writes_composes`, `sings`, `demo_link`) VALUES
(18, 181, 'Guitar', 'jazz', 180, 'None', 'No', ''),
(19, 181, 'Vocals', 'rock', 180, 'Writing', 'No', '');

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
  `hours_practise` int(11) NOT NULL,
  `number_records` int(11) NOT NULL,
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

INSERT INTO `musicians_experience_bands` (`id`, `musician_id`, `band_name`, `region`, `country`, `city_state`, `band_username`, `start_date`, `end_date`, `instrument`, `songs_type`, `main_genre`, `hours_practise`, `number_records`, `number_concerts`, `number_tours`, `number_albums`, `number_songs`, `sings`, `demo_link`) VALUES
(6, 181, '00', 'Africa', 'Algeria', 'Algiers', '', '2001-06-05', '0000-00-00', 'Guitar', 'Originals', 'rock', 180, 30, 0, 30, 2, 139, 'No', 'https://www.youtube.com/watch?v=xHVSptF3_G8');

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
(118, 'user_1', '$2y$10$CzLlcJDgpY7MD4nIRJ24C.Nrzr718yC.AkMuuibKm/EZ8Gyv.3hE.', 'userum', 'henriquebroculo@gmail.com', '', 'email_code', 1, 0, 0, 1, '', '', 0, '0000-00-00 00:00:00', 0, 0, 'Europe', 'Finland', 'Lappi', 0, '0000-00-00 00:00:00', '2016-06-19 15:03:26', 0, '2016-05-20 18:05:24', '2016-06-18 16:05:35', 'musician', NULL),
(120, 'user_120', '$2y$10$cMKowuOBLenE5ufrOhYliOGgauXKk/g80Am7s6EeAX6PwKsz.U0Xq', 'user', 'henriquebroculo@gmail.com', '', 'email_code', 1, 0, 0, 1, '', '', 0, '0000-00-00 00:00:00', 0, 0, 'Africa', 'Equatorial Guinea', 'Annobon', 0, '0000-00-00 00:00:00', '2016-06-08 15:43:21', 0, '2016-05-20 18:05:28', '2016-05-25 16:05:52', 'agent', NULL),
(121, 'user_121', '$2y$10$LYP4Fd4l1f8dZIgqpAcGZ.ZyERxJicdQIeLUr7B2MEUv3BhEhAsNK', 'user_121', 'henriquebroculo@gmail.com', NULL, 'email_code', 1, 0, 0, 1, '', '', 0, '0000-00-00 00:00:00', 0, 0, 'North America', 'United States', 'Alabama', 0, '0000-00-00 00:00:00', '2016-06-08 15:55:24', 0, '2016-05-20 18:05:47', '0000-00-00 00:00:00', 'musician', NULL),
(122, 'user_122', '$2y$10$ip9LPB9dmLbYzl.D8PWw1uiJ8PngkJasZZGVBEE2S6Hez5UO5TAPG', 'use', 'henriquebroculo@gmail.com', '', 'email_code', 1, 0, 0, 1, '', '', 0, '0000-00-00 00:00:00', 0, 0, 'Central America', 'Belize', 'Belmopan', 0, '0000-00-00 00:00:00', '2016-06-02 15:24:04', 0, '2016-05-20 18:05:49', '2016-06-02 15:33:26', 'band', NULL),
(123, 'user_123', '$2y$10$KieOiFVuICBzwc7dRz3cLO0gtP8beJ29iDAu/oaCq8.yERNaxJ/G.', 'user_123', 'henriquebroculo@gmail.com', NULL, 'email_code', 1, 0, 0, 1, '', '', 0, '0000-00-00 00:00:00', 0, 0, 'North America', 'United States', 'Alabama', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '2016-05-20 18:05:51', '0000-00-00 00:00:00', 'agent', NULL),
(127, 'user_127', '$2y$10$M9v6ZamUbo2dMSpyFjPYUe8kDgGhais8DiueEZJyT2mIwdKRUDZ9a', 'user_127', 'henriquebroculo@gmail.com', NULL, 'email_code', 1, 0, 0, 1, '', '', 0, '0000-00-00 00:00:00', 0, 0, 'North America', 'United States', 'Alabama', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '2016-05-26 16:51:28', '0000-00-00 00:00:00', 'band', NULL),
(128, 'user_128', '$2y$10$AOAcGO4nBx1iJiZBPEW/b.fHWJGjxEi38JKRW48dQWPkdwTbWSNv6', 'user_128', 'henriquebroculo@gmail.com', NULL, 'email_code', 1, 0, 0, 1, '', '', 0, '0000-00-00 00:00:00', 0, 0, 'North America', 'United States', 'Alabama', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '2016-05-26 16:53:45', '0000-00-00 00:00:00', 'band', NULL),
(129, 'user_129', '$2y$10$rwkjcA8uXhqk62UEXM4KwOWdqlAl4MOpyCEY0lMsRK4mFenCjfeXe', 'user_129', 'henriquebroculo@gmail.com', NULL, 'email_code', 1, 0, 0, 1, '', '', 0, '0000-00-00 00:00:00', 0, 0, 'North America', 'United States', 'Alabama', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '2016-05-26 16:54:04', '0000-00-00 00:00:00', 'band', NULL),
(130, 'user_130', '$2y$10$akCDs8Py2vZSu/5xYPrIH.Gi.HllMSoYYnUhZuY1osj/QIqfF/8hy', 'user_130', 'henriquebroculo@gmail.com', NULL, 'email_code', 1, 0, 0, 1, '', '', 0, '0000-00-00 00:00:00', 0, 0, 'North America', 'United States', 'Alabama', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '2016-05-26 16:58:46', '0000-00-00 00:00:00', 'band', NULL),
(131, 'user_131', '$2y$10$3fMo2QeQZkBFfFGcq3vORer67HNrDLdji7IG/LXqIvkmg3hTbtDr.', 'user', 'henriquebroculo@gmail.com', '', 'email_code', 1, 0, 0, 1, '', '', 0, '0000-00-00 00:00:00', 0, 0, 'Africa', 'Algeria', 'Chlef', 0, '0000-00-00 00:00:00', '2016-06-08 15:40:22', 0, '2016-05-26 16:59:05', '2016-06-04 17:53:45', 'band', NULL),
(132, 'user_132', '$2y$10$L3Xn/X1vqttQ1wR7LMeAvOj4umzppvd1GlQFCCpGsZQvdKsZfAI62', 'user_132', 'henriquebroculo@gmail.com', NULL, 'email_code', 1, 0, 0, 1, '', '', 0, '0000-00-00 00:00:00', 0, 0, 'North America', 'United States', 'Alabama', 0, '0000-00-00 00:00:00', '2016-05-27 15:34:06', 1, '2016-05-26 17:00:58', '0000-00-00 00:00:00', 'band', NULL),
(143, 'user_133', '$2y$10$lsjGMwCpsvgmyz.qkm61p.VB3ixgO1YAxTPxkIa6FS2S633i6scXW', 'user_133', 'henriquebroculo@gmail.com', NULL, 'email_code', 1, 0, 0, 1, '', '', 0, '0000-00-00 00:00:00', 0, 0, 'North America', 'United States', 'Alabama', 0, '0000-00-00 00:00:00', '2016-05-31 14:45:01', 1, '2016-05-26 18:15:02', '0000-00-00 00:00:00', 'band', NULL),
(145, 'jhstana', '$2y$10$Z6ZgutHG4yOSJCAJE4OBt.fQw4gRmL.OJ2nxsnPqVf4aGfwyecAoy', 'dd', 'henrique.perosinho@gmail.com', NULL, '$2y$10$xtL9HKSKrxDWAv0GPWomZexNWXWd7J1wF6CxDFEIEiG9d198gfHee', 0, 0, 0, 1, '', '', 0, '0000-00-00 00:00:00', 0, 0, 'Islands', 'Pacific Ocean (North)', 'Chuuk', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '2016-06-02 14:40:22', '0000-00-00 00:00:00', 'musician', NULL),
(178, 'user_147', '$2y$10$PsjzVg4MCrRO32bwipx1neRN63lDigo41x9Igi.E.ZaY85sJozMki', 'user_147', 'henriquebroculo@gmail.com', NULL, 'email_code', 1, 0, 0, 1, '', '', 0, '0000-00-00 00:00:00', 0, 0, 'North America', 'United States', 'Alabama', 0, '0000-00-00 00:00:00', '2016-06-20 14:19:01', 1, '2016-06-08 14:47:35', '2016-06-20 20:04:57', 'agent', NULL),
(179, 'user_179', '$2y$10$LHkvVTX9JWS9XqfyoOsb2ucp3RGNQYRjqODWdxt.f1Jtgsp0TaKGG', 'user_179', 'henriquebroculo@gmail.com', NULL, 'email_code', 1, 0, 0, 1, '', '', 0, '0000-00-00 00:00:00', 0, 0, 'North America', 'United States', 'Alabama', 0, '0000-00-00 00:00:00', '2016-06-20 14:14:18', 1, '2016-06-08 14:50:09', '2016-06-20 19:57:16', 'band', NULL),
(180, 'user_180', '$2y$10$VVDRzDMe6AR3ZO3Ku01rUecZ.TtRkYa2bxCM79TKhwc6Qmr.RpRoi', 'user_180', 'henriquebroculo@gmail.com', NULL, 'email_code', 1, 0, 0, 1, '', '', 0, '0000-00-00 00:00:00', 0, 0, 'North America', 'United States', 'Alabama', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '2016-06-08 14:50:29', '0000-00-00 00:00:00', 'band', NULL),
(181, 'user_181', '$2y$10$egQP4YivGMhgR1zFWOjiKOQWmNNB.npHaSVrJnZiJ6gOsauXDKtN.', 'user_181', 'henriquebroculo@gmail.com', NULL, 'email_code', 1, 0, 0, 1, '', '', 0, '0000-00-00 00:00:00', 0, 0, 'North America', 'United States', 'Alabama', 0, '0000-00-00 00:00:00', '2016-06-21 14:15:31', 1, '2016-06-08 16:07:46', '2016-06-21 14:48:10', 'musician', NULL),
(183, 'bandnew', '$2y$10$8MswEe1t4kDnYbTm0o9o9em3qTVOJGts0023esI2kRswMuNXlBrf.', 'bn', 'henrique.gaia@gmail.com', '', '$2y$10$neqE1L1Pgd1rAcz9/UyNOu11ppHGGW60WCSCsuO0EI8F4ff6iv3ge', 1, 0, 0, 1, '', '', 0, '0000-00-00 00:00:00', 0, 0, 'Asia', 'Brunei', 'Belait', 0, '0000-00-00 00:00:00', '2016-06-19 15:04:22', 0, '2016-06-18 18:15:55', '2016-06-19 16:29:07', 'band', NULL);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `bands_experience`
--
ALTER TABLE `bands_experience`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `bands_members`
--
ALTER TABLE `bands_members`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=191;
--
-- AUTO_INCREMENT for table `musicians_experience_alone`
--
ALTER TABLE `musicians_experience_alone`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `musicians_experience_bands`
--
ALTER TABLE `musicians_experience_bands`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=184;
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

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
