-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 27-Ago-2016 às 17:13
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
(268, '1974-06-30', 'Male'),
(270, '1993-07-29', 'Male'),
(272, '1974-06-21', 'Male'),
(273, '1987-03-25', 'Male'),
(274, '1971-06-24', 'Male'),
(275, '1986-06-04', 'Male'),
(276, '1971-07-16', 'Female'),
(277, '1977-12-25', 'Female'),
(278, '1982-02-14', 'Female'),
(279, '1975-04-19', 'Female');

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
(1, 268, 'Kafy', 'North America', 'United States', 'Towaoc, CO', 'Band', '', '2000-05-11', '2009-07-08', 'Pop Rock', 5, 0, 0, ''),
(2, 270, 'Fastio', 'North America', 'United States', 'Yellow Jacket, CO', 'Band', '', '2001-10-23', '2007-07-21', 'Heavy Metal', 9, 0, 0, ''),
(3, 272, 'Girandola', 'North America', 'United States', 'Beverly, KS', 'Band', '', '2000-08-20', '2008-12-25', 'Funk Metal', 52, 1, 1, ''),
(4, 273, 'TFHB', 'North America', 'United States', 'Kremlin, MT', 'Solo Artist', '', '2004-04-06', '2005-11-19', 'Rap', 3, 0, 1, ''),
(5, 274, 'Cramping', 'North America', 'United States', 'Noble, OH', 'Band', '', '2002-01-17', '2008-03-25', 'Progressive Rock', 10, 0, 1, ''),
(6, 275, 'Calcium', 'North America', 'United States', 'Chester, VT', 'Solo Artist', '', '2001-04-11', '2006-09-25', 'Soul', 25, 0, 1, ''),
(7, 276, 'Near the Road', 'North America', 'United States', 'Orem, UT', 'Band', '', '2003-12-02', '2009-01-24', 'Jazz', 20, 0, 0, ''),
(8, 277, 'Caps Unlocked', 'North America', 'United States', 'Crum Lynne, PA', 'Solo Artist', '', '2004-03-25', '2008-04-25', 'House Music', 23, 0, 0, ''),
(9, 278, '1 Liter', 'North America', 'United States', 'Goldston, NC', 'Band', '', '2001-08-01', '2009-01-10', 'Rhythm and Blues (R&B)', 8, 1, 0, ''),
(10, 279, 'Why Now', 'North America', 'United States', 'Wynot, NE', 'Band', '', '2000-06-10', '2007-09-19', 'Blues', 31, 0, 1, '');

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
(248, 'Tired Dog', '2013-12-24', 5),
(249, 'Megiddo', '2013-06-16', 2),
(250, 'Run Away', '2011-07-05', 2),
(251, 'One Down', '2014-01-31', 6),
(252, 'Diamonds', '2013-03-17', 6),
(254, 'Sexual Healing', '2013-04-18', 4),
(255, 'Another Day', '2014-07-26', 3),
(256, 'Excuse Me, Sir', '2014-04-28', 3),
(257, 'The 21', '2014-06-28', 4),
(258, 'Stax, Biatch', '2014-12-08', 3);

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
(10, 248, 'Covers', 'Southern Rock', 1000, 1, 0, 2, 20, ''),
(11, 249, 'Originals', 'Funk Metal', 6000, 19, 2, 1, 14, ''),
(12, 250, 'Covers', 'Latin', 5000, 19, 0, 0, 15, ''),
(13, 251, 'Originals', 'Rap', 1000, 12, 0, 1, 15, ''),
(14, 252, 'Originals', 'Southern Rock', 4000, 10, 1, 1, 0, ''),
(16, 254, 'Covers', 'Rock n Roll', 3000, 6, 0, 2, 20, ''),
(17, 255, 'Both', 'Grindcore Metal', 400, 0, 0, 0, 20, ''),
(18, 256, 'Both', 'Jazz', 3000, 14, 0, 2, 28, ''),
(19, 257, 'Both', 'Grindcore Metal', 100, 0, 0, 0, 4, ''),
(20, 258, 'Originals', 'Punk Rock', 6000, 50, 1, 2, 34, '');

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
(191, 248, 'maria', '1988-02-05', 'Female', 'Electric guitar', '2013-12-24', ''),
(192, 248, 'chris', '1984-01-26', 'Male', 'Drums', '2013-12-24', ''),
(193, 248, 'izabella', '1989-04-13', 'Female', 'Vocals', '2013-12-24', ''),
(194, 248, 'iker', '1988-12-29', 'Male', 'Keyboard', '2013-12-24', ''),
(195, 248, 'enrique', '1990-06-25', 'Male', 'Electric bass guitar', '2013-12-24', ''),
(196, 249, 'korea', '1980-05-15', 'Female', 'Vocals', '2013-06-16', ''),
(197, 249, 'dik von groin', '1982-05-17', 'Male', 'Electric guitar', '2013-06-16', ''),
(198, 250, 'luciana', '1980-06-14', 'Female', 'Vocals', '2011-07-05', ''),
(199, 250, 'karmell', '1985-05-20', 'Female', 'Vocals', '2011-07-05', ''),
(200, 251, 'x-quisito', '1981-04-25', 'Male', 'Vocals', '2014-01-31', ''),
(201, 251, 'limp finger', '1989-05-14', 'Male', 'Vocals', '2014-01-31', ''),
(202, 251, 'chocolate breath', '1981-06-15', 'Male', 'Vocals', '2014-01-31', ''),
(203, 251, 'the d', '1986-06-15', 'Male', 'Vocals', '2014-01-31', ''),
(204, 251, 'asshole', '1983-11-19', 'Male', 'Drums', '2014-01-31', ''),
(205, 251, 'boss', '1983-11-29', 'Male', 'Electric bass guitar', '2014-01-31', ''),
(206, 252, 'igzilo', '1991-01-19', 'Female', 'Vocals', '2013-03-17', ''),
(207, 252, 'harper', '1986-03-11', 'Male', 'Electric bass guitar', '2013-03-17', ''),
(208, 252, 'park ji sung', '1994-05-01', 'Male', 'Keyboard', '2013-03-17', ''),
(209, 252, 'jose almeida', '1995-02-23', 'Male', 'Vocals', '2013-03-17', ''),
(210, 252, 'chico science', '1989-04-28', 'Male', 'Electric guitar', '2013-03-17', ''),
(211, 252, 'max silva', '1995-02-18', 'Male', 'Electric guitar', '2013-03-17', ''),
(213, 254, 'china', '1990-07-22', 'Female', 'Electric bass guitar', '2013-04-18', ''),
(214, 254, 'pat lucy', '1992-04-20', 'Female', 'Drums', '2013-04-18', ''),
(215, 254, 'grampa', '1990-06-20', 'Male', 'Electric guitar', '2013-04-18', ''),
(216, 254, 'lili', '1988-02-13', 'Female', 'Vocals', '2013-04-18', ''),
(217, 255, 'reinaldo', '1982-04-04', 'Male', 'Electric guitar', '2014-07-26', ''),
(218, 255, 'jucando', '1983-03-25', 'Male', 'Drums', '2014-07-26', ''),
(219, 255, 'juliana', '1982-10-12', 'Female', 'Electric bass guitar', '2014-07-26', ''),
(220, 256, 'john patiovsky', '1984-12-18', 'Male', 'Double Bass', '2014-04-28', ''),
(221, 256, 'matt moreira', '1989-09-22', 'Male', 'Trumpet', '2014-04-28', ''),
(222, 256, 'joyce', '1984-06-15', 'Female', 'Drums', '2014-04-28', ''),
(223, 257, 'throts', '1991-07-14', 'Male', 'Vocals', '2014-06-28', ''),
(224, 257, 'mucus', '1992-11-09', 'Male', 'Drums', '2014-06-28', ''),
(225, 257, 'infection', '1990-02-12', 'Male', 'Electric guitar', '2014-06-28', ''),
(226, 257, 'canniboid', '1987-06-11', 'Male', 'Electric bass guitar', '2014-06-28', ''),
(227, 258, 'sponge', '1985-06-04', 'Male', 'Electric guitar', '2014-12-08', ''),
(228, 258, 'kakikuluo', '1988-08-04', 'Male', 'Vocals', '2014-12-08', ''),
(229, 258, 'chamine', '1986-02-18', 'Female', 'Electric bass guitar', '2014-12-08', '');

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

-- --------------------------------------------------------

--
-- Estrutura da tabela `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `user_id_from` int(11) NOT NULL,
  `user_id_to` int(11) NOT NULL,
  `content` varchar(500) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
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
(232, '1979-01-04', 'Female'),
(235, '1986-10-04', 'Male'),
(237, '1980-12-04', 'Male'),
(239, '1991-01-03', 'Male'),
(241, '1992-12-19', 'Male'),
(242, '1987-03-25', 'Male'),
(243, '1991-09-02', 'Male'),
(244, '1986-06-25', 'Male'),
(245, '1981-12-31', 'Female'),
(246, '1974-07-30', 'Female'),
(280, '0000-00-00', '');

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
(36, 232, 'Keyboard', 'Punk Rock', 2000, 'Both', 'Yes', ''),
(37, 235, 'Electric bass guitar', 'Electronic Rock', 1000, 'Composing', 'No', ''),
(38, 237, 'Keyboard', 'Gothic Metal', 300, 'None', 'Yes', ''),
(39, 239, 'Electric guitar', 'Electronic Rock', 200, 'Composing', 'Yes', ''),
(40, 241, 'Saxophone', 'Jazz', 5000, 'Writing', 'No', ''),
(41, 242, 'Electric guitar', 'Pop', 500, 'Composing', 'No', ''),
(42, 243, 'Classical guitar', 'Jazz', 200, 'Composing', 'Yes', ''),
(43, 244, 'Drums', 'Grindcore Metal', 300, 'Composing', 'Yes', ''),
(44, 245, 'Vocals', 'Punk Rock', 6000, 'Both', 'Yes', ''),
(45, 246, 'Drums', 'Reggae', 3000, 'None', 'No', '');

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
(23, 235, 'the pointers', 'North America', 'United States', 'Saint Peter, IL', '', '2001-12-29', '2008-04-03', 'Saxophone', 'Originals', 'Jazz', 6000, 22, 0, 0, 14, 'No', ''),
(25, 239, 'hammer in the weather', 'North America', 'United States', 'Littleton, NH', '', '2004-04-29', '2005-10-18', 'Electric guitar', 'Both', 'Electronic Rock', 200, 23, 1, 0, 11, 'No', ''),
(27, 242, 'whatever', 'North America', 'United States', 'Oak Creek, WI', '', '2003-06-24', '2009-01-31', 'Electric bass guitar', 'Both', 'Funk Metal', 600, 23, 1, 1, 10, 'Yes', ''),
(28, 243, 'flambeaux', 'North America', 'United States', 'Ruther Glen, VA', '', '2000-01-03', '2008-04-30', 'Turntables', 'Both', 'Rap', 700, 16, 0, 1, 13, 'No', ''),
(30, 245, 'On My Side', 'North America', 'United States', 'Belle Chasse, LA', '', '2003-12-30', '2005-07-24', 'Vocals', 'Originals', 'Electronic Rock', 400, 17, 0, 0, 10, 'No', '');

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
(83, 232, 'Band', 'Trumpet', 'Rock', 'No', '2016-08-21 16:09:17', '2016-08-21 16:09:17'),
(84, 235, 'Band', 'Electric bass guitar', 'Soul', 'Yes', '2016-08-21 16:18:35', '2016-08-21 19:55:58'),
(85, 237, 'Agent', 'Keyboard', 'Gothic Metal', 'No', '2016-08-21 16:22:29', '2016-08-22 14:31:05'),
(86, 239, 'Agent', 'Electric guitar', 'Country', 'Yes', '2016-08-21 16:25:55', '2016-08-21 19:56:49'),
(87, 241, 'Band', 'Saxophone', 'Jazz', 'Yes', '2016-08-21 16:28:20', '2016-08-21 19:57:17'),
(88, 242, 'Band', 'Electric guitar', 'Hip Hop', 'Yes', '2016-08-21 16:32:06', '2016-08-21 16:32:06'),
(89, 243, 'Agent', 'Classical guitar', 'Rock n Roll', 'Yes', '2016-08-21 18:19:36', '2016-08-21 18:19:36'),
(90, 244, 'Band', 'Drums', 'Grindcore Metal', 'No', '2016-08-21 18:22:13', '2016-08-22 14:31:10'),
(91, 245, 'Agent', 'Vocals', 'Punk Rock', 'Yes', '2016-08-21 18:24:23', '2016-08-21 19:59:43'),
(92, 246, 'Agent', 'Drums', 'Grunge', 'No', '2016-08-21 18:27:58', '2016-08-21 20:00:02'),
(93, 248, 'Agent', '', 'Southern Rock', 'No', '2016-08-21 18:38:00', '2016-08-21 18:38:00'),
(94, 249, 'Musician', 'Electric bass guitar', 'Funk Metal', 'No', '2016-08-21 18:43:46', '2016-08-21 18:46:32'),
(95, 250, 'Agent', '', 'Pop Rock', 'Yes', '2016-08-21 18:50:57', '2016-08-21 18:50:57'),
(96, 251, 'Musician', 'Turntables', 'Hip Hop', 'No', '2016-08-21 18:55:41', '2016-08-21 19:01:35'),
(97, 252, 'Musician', 'Drums', 'Southern Rock', 'Yes', '2016-08-21 19:03:12', '2016-08-21 19:03:12'),
(99, 254, 'Agent', '', 'Rock n Roll', 'No', '2016-08-21 19:17:10', '2016-08-21 19:17:10'),
(100, 255, 'Musician', 'Vocals', 'Grindcore Metal', 'Yes', '2016-08-21 19:22:42', '2016-08-22 14:31:15'),
(101, 256, 'Musician', 'Saxophone', 'Jazz', 'Yes', '2016-08-21 19:27:34', '2016-08-21 19:31:41'),
(102, 257, 'Agent', '', 'Groove Metal', 'No', '2016-08-21 19:30:14', '2016-08-21 19:30:37'),
(103, 258, 'Agent', '', 'Punk Rock', 'Yes', '2016-08-21 19:38:34', '2016-08-21 19:39:21'),
(105, 268, 'Musician', 'Electric bass guitar', 'Black Metal', 'No', '2016-08-22 14:53:03', '2016-08-22 14:53:03'),
(106, 270, 'Band', '', 'Heavy Metal', 'Yes', '2016-08-22 15:14:02', '2016-08-22 15:15:31'),
(107, 272, 'Band', '', 'Techno', 'Yes', '2016-08-22 15:17:21', '2016-08-22 15:17:21'),
(108, 273, 'Musician', 'Turntables', 'Rap', 'No', '2016-08-22 15:20:47', '2016-08-22 15:23:43'),
(109, 274, 'Musician', 'Keyboard', 'Electronic Rock', 'Yes', '2016-08-22 15:25:43', '2016-08-22 15:28:05'),
(110, 275, 'Band', '', 'Soul', 'No', '2016-08-22 15:30:52', '2016-08-22 15:32:18'),
(111, 276, 'Musician', 'Double Bass', 'Jazz', 'Yes', '2016-08-22 15:33:47', '2016-08-22 15:35:14'),
(112, 277, 'Band', '', 'House Music', 'No', '2016-08-22 15:36:33', '2016-08-22 15:37:26'),
(113, 278, 'Musician', 'Electric guitar', 'Rhythm and Blues (R&amp;B)', 'No', '2016-08-22 15:38:54', '2016-08-22 15:40:44'),
(114, 279, 'Band', '', 'Blues', 'No', '2016-08-22 15:43:14', '2016-08-22 15:44:24');

-- --------------------------------------------------------

--
-- Estrutura da tabela `transactions_paypal`
--

CREATE TABLE `transactions_paypal` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `payment_id` varchar(255) NOT NULL,
  `hash` varchar(255) NOT NULL,
  `complete` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  `premium` tinyint(1) NOT NULL DEFAULT '1',
  `premium_begin` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `premium_end` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
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
  `message_count` int(11) NOT NULL,
  `last_message` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `other_details` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `first_name`, `email`, `last_name`, `email_code`, `active`, `password_recover`, `type`, `allow_email`, `profile`, `profile_img_name`, `premium`, `premium_begin`, `premium_end`, `first_failed_login`, `failed_login_count`, `is_locked`, `region`, `country`, `city_state`, `phone_number`, `last_activity`, `last_login`, `is_online`, `created_at`, `updated_at`, `role`, `invitation_count`, `last_invitation`, `message_count`, `last_message`, `other_details`) VALUES
(232, 'mconorbroc', '$2y$10$nQ2q33bkLSPQIy9fvDrhbuXWx0EVcJpqXLhBezSwMOvoqqdrKFP3W', 'conor', 'henriquebroculo@gmail.com', NULL, 'email_code', 1, 0, 0, 1, '', '', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 'North America', 'United States', 'Acmar, AL', 0, '0000-00-00 00:00:00', '2016-08-21 16:16:20', 0, '2016-08-21 16:17:00', '2016-08-21 16:17:00', 'musician', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', NULL),
(235, 'milesaway', '$2y$10$zX5wzJGPbozNX1AJS8IUTuSBF.AZhUcM3MtUyaPXVEbsdBn9WUXHi', 'davis', 'henriquebroculo@gmail.com', NULL, 'email_code', 1, 0, 0, 1, '', '', 0, '2016-08-23 15:46:59', '2016-09-22 16:46:59', '0000-00-00 00:00:00', 0, 0, 'North America', 'United States', 'Saint Peter, IL', 0, '0000-00-00 00:00:00', '2016-08-27 14:23:13', 0, '2016-08-21 16:19:14', '2016-08-27 14:23:21', 'musician', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', NULL),
(237, 'mydearhair', '$2y$10$EGm9QNhU4MdxbRtRUWJh6O4xudkEvh94OQkP9dXxE5ou3XJvq64YK', 'danny', 'henriquebroculo@gmail.com', NULL, 'email_code', 1, 0, 0, 1, '', '', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 'North America', 'United States', 'Enfield, ME', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '2016-08-21 16:22:57', '2016-08-21 16:22:57', 'musician', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', NULL),
(239, 'its_not_so_cold', '$2y$10$wufSt/fAWi9lqMg287e5lO0MahISovAC2L65XLT8iGll09TrUFenK', 'john', 'henriquebroculo@gmail.com', NULL, 'email_code', 1, 0, 0, 1, '', '', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 'North America', 'United States', 'Littleton, NH', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '2016-08-21 16:26:24', '2016-08-21 16:26:24', 'musician', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', NULL),
(241, 'rigth_here', '$2y$10$mb8wDrCCaRE1Um825QVQoOj/f9ZS6GCt5UXzR43.NFYx.v.2K9fTy', 'lawrence', 'henriquebroculo@gmail.com', NULL, 'email_code', 1, 0, 0, 1, '', '', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 'North America', 'United States', 'Nottingham, PA', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '2016-08-21 16:28:20', '2016-08-21 18:28:44', 'musician', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', NULL),
(242, 'ketyosis', '$2y$10$poKobdSl9Yhx0tHdPtDKkuActdKP5oU/51zvwvisYagrPdv.4Wyta', 'peter', 'henriquebroculo@gmail.com', NULL, 'email_code', 1, 0, 0, 1, '', '', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 'North America', 'United States', 'Oak Creek, WI', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '2016-08-21 16:32:05', '2016-08-21 16:32:05', 'musician', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', NULL),
(243, 'lifelessly', '$2y$10$SBfJKeU3M/CeHsR5r1lOgeKWwOOXLf.EmWyj/S1rCKxHwyHI95Nc.', 'phil', 'henriquebroculo@gmail.com', NULL, 'email_code', 1, 0, 0, 1, '', '', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 'North America', 'United States', 'Ruther Glen, VA', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '2016-08-21 18:19:35', '2016-08-21 18:19:35', 'musician', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', NULL),
(244, 'xamppoo', '$2y$10$B6ONuXNBlfmlQZN.8G.kzu9DlkGZRULzOQ8sTVLC2xKHYyI36JLDm', 'mark', 'henriquebroculo@gmail.com', NULL, 'email_code', 1, 0, 0, 1, '', '', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 'North America', 'United States', 'Metairie, LA', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '2016-08-21 18:22:12', '2016-08-21 18:22:12', 'musician', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', NULL),
(245, 'glass_cross', '$2y$10$uIUAZJun2v40swNApx/BDu9Nr/6KcB75GbAtNnDYOkWzd/rAAfiQu', 'joanna', 'henriquebroculo@gmail.com', NULL, 'email_code', 1, 0, 0, 1, '', '', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 'North America', 'United States', 'Belle Chasse, LA', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '2016-08-21 18:24:23', '2016-08-21 18:24:23', 'musician', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', NULL),
(246, 'ghosts', '$2y$10$.94xRYJUov4FWE6X7RE.Iu1Z2LRR0cCuBgRxkT507thZVYReCwZxu', 'katherine', 'henriquebroculo@gmail.com', NULL, 'email_code', 1, 0, 0, 1, '', '', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 'North America', 'United States', 'Buras, LA', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '2016-08-21 18:34:37', '2016-08-21 18:35:46', 'musician', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', NULL),
(247, 'ghosts', '$2y$10$fY8.gbkLa74p6GpixSowq.GDhr3LosQlK81ykVL/E.79QxQc.Ez4S', 'katherine ', 'henriquebroculo@gmail.com', NULL, 'email_code', 1, 0, 0, 1, '', '', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 'North America', 'United States', 'Buras, LA', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '2016-08-21 18:34:37', '2016-08-21 18:34:37', 'band', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', NULL),
(248, 'tired_dog', '$2y$10$yNImfzkBJxYmwRyb.eINi.Tao/ww2R.5L0i7/v6eZDEw20.O9X/Bu', 'chris', 'henriquebroculo@gmail.com', NULL, 'email_code', 1, 0, 0, 1, '', '', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 'North America', 'United States', 'Chalmette, LA', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '2016-08-21 18:37:57', '2016-08-21 18:42:54', 'band', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', NULL),
(249, 'megiddo', '$2y$10$hQhsRxbli2JJEFdv/QDy0.w9IKkkixTwqsf2S1PTnvbAugcq.gqs.', 'mariuz', 'henriquebroculo@gmail.com', NULL, 'email_code', 1, 0, 0, 1, '', '', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 'North America', 'United States', 'New Site, AL', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '2016-08-21 18:43:46', '2016-08-21 18:43:46', 'band', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', NULL),
(250, 'run_away', '$2y$10$DQYeiLKRb3MRQzsnlO2dferk2BQ2Z3a3x8Yo8FKVz8kGLz.fBdesO', 'pietov', 'henriquebroculo@gmail.com', NULL, 'email_code', 1, 0, 0, 1, '', '', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 'North America', 'United States', 'Ellaville, GA', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '2016-08-21 18:50:57', '2016-08-21 18:50:57', 'band', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', NULL),
(251, 'one_down', '$2y$10$egmXvQXgQpmL2PK7v7uimOzvglkwCauae2wmUBBwK/NqkvDx0z7n6', 'ben', 'henriquebroculo@gmail.com', NULL, 'email_code', 1, 0, 0, 1, '', '', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 'North America', 'United States', 'Emery, SD', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '2016-08-21 18:55:40', '2016-08-21 18:55:40', 'band', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', NULL),
(252, 'diamonds', '$2y$10$tUZH5awwDfS4.GiME7eeAOWlH/NpnlZ1CgU5V1LIhyWUT8LFG0xRe', 'olivia', 'henriquebroculo@gmail.com', NULL, 'email_code', 1, 0, 0, 1, '', '', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 'North America', 'United States', 'Dimock, SD', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '2016-08-21 19:03:11', '2016-08-21 19:03:11', 'band', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', NULL),
(254, 'sexual_healing', '$2y$10$TdQwf7tL.kNpXMxR0drm/eYvazQxZNijushycIS/BsoX86oJBXT5u', 'jay', 'henriquebroculo@gmail.com', NULL, 'email_code', 1, 0, 0, 1, '', '', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 'North America', 'United States', 'Fedora, SD', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '2016-08-21 19:17:09', '2016-08-21 19:17:09', 'band', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', NULL),
(255, 'another_day', '$2y$10$u1meAyPFxriyORZ89R19Z..nTwBFCsGWitRvwXN68Y0pC/zYeqsE2', 'lucio', 'henriquebroculo@gmail.com', NULL, 'email_code', 1, 0, 0, 1, '', '', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 'North America', 'United States', 'Fairfax, SD', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '2016-08-21 19:22:42', '2016-08-21 19:22:42', 'band', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', NULL),
(256, 'excuse_me_sir', '$2y$10$gw6GZ6xqTB.AywZkiNCBX.T31RireoTqUJ/wlN.E2gqkjduI553Te', 'kasparov', 'henriquebroculo@gmail.com', NULL, 'email_code', 1, 0, 0, 1, '', '', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 'North America', 'United States', 'Gann Valley, SD', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '2016-08-21 19:27:33', '2016-08-21 19:27:33', 'band', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', NULL),
(257, 'the_twenty_one', '$2y$10$5Q5lnFHrRhDqSL9B0HR9S.R4Xqr3tb2ldlbIkYhnOYi6wK9f/nmGm', 'matt', 'henriquebroculo@gmail.com', NULL, 'email_code', 1, 0, 0, 1, '', '', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 'North America', 'United States', 'Glenwood, IN', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '2016-08-21 19:30:13', '2016-08-21 19:30:13', 'band', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', NULL),
(258, 'stax_biatch', '$2y$10$Ex5yb0g0yxdPR4q.DRraaeeTpaHr9XnvBDfa9wZpSYm0WwmDOo7dS', 'gregory', 'henriquebroculo@gmail.com', NULL, 'email_code', 1, 0, 0, 1, '', '', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 'North America', 'United States', 'Adger, AL', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '2016-08-21 19:38:34', '2016-08-21 19:38:34', 'band', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', NULL),
(268, 'bjorn_svensson', '$2y$10$Sghid88At1oqvXoJlEQwA.Sqx4m5W/A8oKEg5UVnG7Aq/KlT9K/Ye', 'Bjorn', 'henriquebroculo@gmail.com', 'Svensson', 'email_code', 1, 0, 0, 1, '', '', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 'North America', 'United States', 'Towaoc, CO', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '2016-08-22 14:54:43', '2016-08-22 14:54:43', 'agent', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', NULL),
(270, 'charles_rogan', '$2y$10$aR8fp8WkjWsu9Usfk5lDEO.Di3c53wyewNevAHE0tFoTmv1PoVPl.', 'Charles', 'henriquebroculo@gmail.com', 'Rogan', 'email_code', 1, 0, 0, 1, '', '', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 'North America', 'United States', 'Yellow Jacket, CO', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '2016-08-22 15:15:43', '2016-08-22 15:15:43', 'agent', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', NULL),
(272, 'brian_sterling', '$2y$10$C39tZZLDfIEAC25m7p4jdezY9OAbGl9OHueb6u0wPUqAesbklDFgm', 'Brian', 'henriquebroculo@gmail.com', 'Sterling', 'email_code', 1, 0, 0, 1, '', '', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 'North America', 'United States', 'Beverly, KS', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '2016-08-22 15:17:21', '2016-08-22 15:17:21', 'agent', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', NULL),
(273, 'john_scofield', '$2y$10$WViwVaCT7/IcuAUStMkH7OIOyKvHS8V9J3xVcEjgK9TsgIwsEv4Qa', 'John', 'henriquebroculo@gmail.com', 'Scofield', 'email_code', 1, 0, 0, 1, '', '', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 'North America', 'United States', 'Kremlin, MT', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '2016-08-22 15:20:47', '2016-08-22 15:21:48', 'agent', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', NULL),
(274, 'albert_valderrama', '$2y$10$fuc7CV1QDqXsrkFXWinkH.PY7VK4IM9edBdGN4DbrlLj12x9wqD2a', 'Albert', 'henriquebroculo@gmail.com', 'Valderrama', 'email_code', 1, 0, 0, 1, '', '', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 'North America', 'United States', 'Noble, OH', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '2016-08-22 15:25:43', '2016-08-22 15:25:43', 'agent', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', NULL),
(275, 'ronald_silva', '$2y$10$qs/9WRDTpsBJW6WvqDBDauAqYTl2bt/Zzpk9dM8dDegQcK.rMPmla', 'Ronald', 'henriquebroculo@gmail.com', 'Silva', 'email_code', 1, 0, 0, 1, '', '', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 'North America', 'United States', 'Chester, VT', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '2016-08-22 15:30:52', '2016-08-22 15:30:52', 'agent', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', NULL),
(276, 'marie_colbert', '$2y$10$0G95v8DfhhyRC/tcR2dzculNZSeSwZb/s26TKhtvwWo891EFmdTPK', 'Marie', 'henriquebroculo@gmail.com', 'Colbert', 'email_code', 1, 0, 0, 1, '', '', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 'North America', 'United States', 'Orem, UT', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '2016-08-22 15:33:46', '2016-08-22 15:33:46', 'agent', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', NULL),
(277, 'rose_sparks', '$2y$10$MvWylKDmZFy50E/e7rgfueVbV1u0mv4ao/5lx.2CciVIUNHtGi56q', 'Rose', 'henriquebroculo@gmail.com', 'Sparks', 'email_code', 1, 0, 0, 1, '', '', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 'North America', 'United States', 'Crum Lynne, PA', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '2016-08-22 15:36:33', '2016-08-22 15:36:33', 'agent', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', NULL),
(278, 'ashley_thompson', '$2y$10$hccAkAODnEsqWQ9j/HRpdO0NoxmXQROWETInOuBqdRMTaqeGdA8Qm', 'Ashley', 'henriquebroculo@gmail.com', 'Thompson', 'email_code', 1, 0, 0, 1, '', '', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 'North America', 'United States', 'Goldston, NC', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '2016-08-22 15:38:53', '2016-08-22 15:38:53', 'agent', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', NULL),
(279, 'margaret_del_monte', '$2y$10$Wo07S9VHyFROD8cU7rAy3O/nPaYqW2aEWGs/QKCE15IA9e.d9.Nsi', 'Maria', 'henriquebroculo@gmail.com', 'Del Monte', 'email_code', 1, 0, 0, 1, '', '', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 'North America', 'United States', 'Wynot, NE', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '2016-08-22 15:43:14', '2016-08-22 15:43:14', 'agent', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', NULL),
(280, 'fredic', '$2y$10$Cv.SVaaSMPrLa2d2oRX4x.Sy7eQjTF2DuKP48ysMSJilmzFj67gsO', 'fred', 'henrique.gaia@gmail.com', NULL, '$2y$10$xjq0y7Fs5Ow91pP1ueG7LuMlBBAGcmtQ6.Zw6ccGL5avnVtV1rOb2', 1, 0, 0, 1, '', '', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 'Africa', 'Algeria', 'Algiers', 0, '0000-00-00 00:00:00', '2016-08-27 14:28:19', 0, '2016-08-27 14:27:02', '2016-08-27 14:30:25', 'musician', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', NULL);

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
-- Indexes for table `invitations`
--
ALTER TABLE `invitations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `invitations_ibfk_1` (`user_id_from`),
  ADD KEY `invitations_ibfk_2` (`user_id_to`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `messages_ibfk_1` (`user_id_from`),
  ADD KEY `messages_ibfk_2` (`user_id_to`);

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
-- Indexes for table `transactions_paypal`
--
ALTER TABLE `transactions_paypal`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transactions_paypal_ibfk_1` (`user_id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `bands_experience`
--
ALTER TABLE `bands_experience`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `bands_members`
--
ALTER TABLE `bands_members`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=230;
--
-- AUTO_INCREMENT for table `invitations`
--
ALTER TABLE `invitations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `musicians_experience_alone`
--
ALTER TABLE `musicians_experience_alone`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;
--
-- AUTO_INCREMENT for table `musicians_experience_bands`
--
ALTER TABLE `musicians_experience_bands`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT for table `pursuits`
--
ALTER TABLE `pursuits`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=115;
--
-- AUTO_INCREMENT for table `transactions_paypal`
--
ALTER TABLE `transactions_paypal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=281;
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
-- Limitadores para a tabela `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_ibfk_1` FOREIGN KEY (`user_id_from`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `messages_ibfk_2` FOREIGN KEY (`user_id_to`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

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

--
-- Limitadores para a tabela `transactions_paypal`
--
ALTER TABLE `transactions_paypal`
  ADD CONSTRAINT `transactions_paypal_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
