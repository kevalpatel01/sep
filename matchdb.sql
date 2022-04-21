-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 03, 2022 at 08:32 PM
-- Server version: 5.7.36
-- PHP Version: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `matchdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `matches`
--

DROP TABLE IF EXISTS `matches`;
CREATE TABLE IF NOT EXISTS `matches` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `home` varchar(30) NOT NULL,
  `visitor` varchar(30) NOT NULL,
  `date` datetime NOT NULL,
  `place_id` int(8) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `matches`
--

INSERT INTO `matches` (`id`, `home`, `visitor`, `date`, `place_id`) VALUES
(1, 'Manchester United', 'Portsmouth', '2008-08-10 16:00:00', 1),
(2, 'Manchester United', 'Newcastle United', '2008-08-17 16:00:00', 3),
(3, 'Portsmouth', 'Manchester United', '2008-08-25 16:00:00', 6),
(4, 'Manchester United', 'Zenit St Petersburg', '2008-08-29 21:00:00', 2),
(5, 'Liverpool', 'Manchester United', '2008-09-13 16:00:00', 3),
(6, 'Manchester United', 'Villarreal', '2008-09-17 20:45:00', 5),
(7, 'Chelsea', 'Manchester United', '2008-09-21 16:00:00', 4),
(8, 'Manchester United', 'Middlesbrough', '2008-09-23 21:00:00', 6),
(9, 'Manchester United', 'Bolton Wanderers', '2008-09-27 16:00:00', 2),
(10, 'Aalborg', 'Manchester United', '2008-09-30 20:45:00', 1),
(11, 'Blackburn Rovers', 'Manchester United', '2008-10-04 16:00:00', 3),
(12, 'Manchester United', 'West Bromwich Albion', '2008-10-18 16:00:00', 4),
(13, 'Manchester United', 'Celtic', '2008-10-21 20:45:00', 6),
(14, 'Everton', 'Manchester United', '2008-10-25 16:00:00', 5),
(15, 'Manchester United', 'West Ham United', '2008-10-29 16:00:00', 4),
(16, 'Manchester United', 'Hull City', '2008-11-01 16:00:00', 1),
(17, 'Celtic', 'Manchester United', '2008-11-05 20:45:00', 5),
(18, 'Arsenal', 'Manchester United', '2008-11-08 16:00:00', 6),
(19, 'Manchester United', 'Queens Park Rangers', '2008-11-11 21:00:00', 4),
(20, 'Manchester United', 'Stoke City', '2008-11-15 16:00:00', 1),
(21, 'Aston Villa', 'Manchester United', '2008-11-22 16:00:00', 6),
(22, 'Villarreal', 'Manchester United', '2008-11-25 20:45:00', 2),
(23, 'Manchester City', 'Manchester United', '2008-11-30 16:00:00', 3),
(24, 'Blackburn Rovers', 'Manchester United', '2008-12-03 21:00:00', 2),
(25, 'Manchester United', 'Sunderland', '2008-11-06 16:00:00', 5),
(26, 'Manchester United', 'Aalborg', '2008-12-10 20:45:00', 6),
(27, 'Tottenham Hotspur', 'Manchester United', '2008-12-13 18:30:00', 3),
(28, 'Stoke City', 'Manchester United', '2008-12-26 13:45:00', 2),
(29, 'Manchester United', 'Middlesbrough', '2008-12-29 21:00:00', 5),
(30, 'Southampton', 'Manchester United', '2009-01-04 17:00:00', 6),
(31, 'Manchester United', 'Chelsea', '2009-01-10 16:00:00', 3),
(32, 'Bolton Wanderers', 'Manchester United', '2009-01-17 16:00:00', 3),
(33, 'West Bromwich Albion', 'Manchester United', '2009-01-27 16:00:00', 2),
(34, 'Manchester United', 'Everton', '2009-01-31 16:00:00', 5),
(35, 'West Ham United', 'Manchester United', '2009-02-07 16:00:00', 5),
(36, 'Manchester United', 'Blackburn Rovers', '2009-02-21 16:00:00', 2),
(37, 'Manchester United', 'Portsmouth', '2009-02-28 16:00:00', 5),
(38, 'Newcastle United', 'Manchester United', '2009-03-04 20:45:00', 1),
(39, 'Manchester United', 'Liverpool', '2009-03-14 16:00:00', 4),
(40, 'Fulham', 'Manchester United', '2009-03-21 16:00:00', 2),
(41, 'Manchester United', 'Aston Villa', '2009-04-04 16:00:00', 5),
(42, 'Sunderland', 'Manchester United', '2009-04-11 16:00:00', 5),
(43, 'Wigan Athletic', 'Manchester United', '2009-04-18 16:00:00', 2),
(44, 'Manchester United', 'Tottenham Hotspur', '2009-04-25 16:00:00', 4),
(45, 'Middlesbrough', 'Manchester United', '2009-05-02 16:00:00', 6),
(46, 'Manchester United', 'Manchester City', '2009-05-09 16:00:00', 4),
(47, 'Manchester United', 'Arsenal', '2009-05-16 16:00:00', 6),
(48, 'Hull City', 'Manchester United', '2009-05-24 16:00:00', 3),
(49, 'Colts', 'Mu', '2022-03-09 00:00:00', 4);

-- --------------------------------------------------------

--
-- Table structure for table `meetings`
--

DROP TABLE IF EXISTS `meetings`;
CREATE TABLE IF NOT EXISTS `meetings` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `match_id` int(8) NOT NULL,
  `user_id` int(8) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=419 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `meetings`
--

INSERT INTO `meetings` (`id`, `match_id`, `user_id`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 1, 3),
(4, 1, 4),
(5, 1, 5),
(6, 1, 6),
(7, 2, 7),
(8, 2, 8),
(9, 2, 9),
(10, 2, 10),
(11, 3, 11),
(12, 3, 12),
(13, 3, 13),
(14, 3, 14),
(15, 3, 15),
(16, 3, 16),
(17, 3, 1),
(18, 3, 2),
(19, 4, 3),
(20, 4, 4),
(21, 4, 5),
(22, 4, 6),
(23, 4, 7),
(24, 4, 8),
(25, 4, 9),
(26, 4, 10),
(27, 5, 11),
(28, 5, 12),
(29, 5, 13),
(30, 5, 14),
(31, 5, 15),
(32, 5, 16),
(33, 5, 1),
(34, 5, 2),
(35, 5, 3),
(36, 5, 4),
(37, 5, 5),
(38, 5, 6),
(39, 6, 7),
(40, 6, 8),
(41, 6, 9),
(42, 6, 10),
(43, 6, 11),
(44, 6, 12),
(45, 6, 13),
(46, 6, 14),
(47, 6, 15),
(48, 6, 16),
(49, 6, 1),
(50, 7, 2),
(51, 7, 3),
(52, 7, 4),
(53, 7, 5),
(54, 7, 6),
(55, 7, 7),
(56, 7, 8),
(57, 7, 9),
(58, 7, 10),
(59, 7, 11),
(60, 8, 12),
(61, 8, 13),
(62, 8, 14),
(63, 8, 15),
(64, 8, 16),
(65, 8, 1),
(66, 8, 2),
(67, 8, 3),
(68, 8, 4),
(69, 8, 5),
(70, 8, 6),
(71, 8, 7),
(72, 8, 8),
(73, 9, 9),
(74, 9, 10),
(75, 9, 11),
(76, 9, 12),
(77, 9, 13),
(78, 9, 14),
(79, 9, 15),
(80, 9, 16),
(81, 9, 1),
(82, 10, 2),
(83, 10, 3),
(84, 10, 4),
(85, 10, 5),
(86, 10, 6),
(87, 10, 7),
(88, 10, 8),
(89, 10, 9),
(90, 10, 10),
(91, 11, 11),
(92, 11, 12),
(93, 11, 13),
(94, 11, 14),
(95, 12, 15),
(96, 12, 16),
(97, 12, 1),
(98, 12, 2),
(99, 13, 3),
(100, 13, 4),
(101, 13, 5),
(102, 13, 6),
(103, 13, 7),
(104, 13, 8),
(105, 13, 9),
(106, 13, 10),
(107, 13, 11),
(108, 13, 12),
(109, 14, 13),
(110, 14, 14),
(111, 14, 15),
(112, 14, 16),
(113, 15, 1),
(114, 15, 2),
(115, 15, 3),
(116, 15, 4),
(117, 15, 5),
(118, 15, 6),
(119, 15, 7),
(120, 15, 8),
(121, 15, 9),
(122, 16, 10),
(123, 16, 11),
(124, 16, 12),
(125, 16, 13),
(126, 16, 14),
(127, 16, 15),
(128, 17, 16),
(129, 17, 1),
(130, 17, 2),
(131, 18, 3),
(132, 18, 4),
(133, 18, 5),
(134, 18, 6),
(135, 18, 7),
(136, 18, 8),
(137, 18, 9),
(138, 18, 10),
(139, 18, 11),
(140, 18, 12),
(141, 18, 13),
(142, 18, 14),
(143, 18, 15),
(144, 18, 16),
(145, 19, 1),
(146, 19, 2),
(147, 19, 3),
(148, 19, 4),
(149, 19, 5),
(150, 19, 6),
(151, 19, 7),
(152, 19, 8),
(153, 19, 9),
(154, 19, 10),
(155, 20, 11),
(156, 20, 12),
(157, 20, 13),
(158, 20, 14),
(159, 20, 15),
(160, 21, 16),
(161, 21, 1),
(162, 21, 2),
(163, 21, 3),
(164, 21, 4),
(165, 21, 5),
(166, 21, 6),
(167, 21, 7),
(168, 22, 8),
(169, 22, 9),
(170, 22, 10),
(171, 22, 11),
(172, 22, 12),
(173, 22, 13),
(174, 22, 14),
(175, 22, 15),
(176, 23, 16),
(177, 23, 1),
(178, 23, 2),
(179, 23, 3),
(180, 23, 4),
(181, 23, 5),
(182, 24, 6),
(183, 24, 7),
(184, 24, 8),
(185, 24, 9),
(186, 24, 10),
(187, 24, 11),
(188, 24, 12),
(189, 24, 13),
(190, 25, 14),
(191, 25, 15),
(192, 25, 16),
(193, 25, 1),
(194, 25, 2),
(195, 25, 3),
(196, 25, 4),
(197, 25, 5),
(198, 25, 6),
(199, 25, 7),
(200, 25, 8),
(201, 26, 9),
(202, 26, 10),
(203, 26, 11),
(204, 26, 12),
(205, 26, 13),
(206, 26, 14),
(207, 26, 15),
(208, 26, 16),
(209, 26, 1),
(210, 26, 2),
(211, 26, 3),
(212, 26, 4),
(213, 27, 5),
(214, 27, 6),
(215, 27, 7),
(216, 27, 8),
(217, 27, 9),
(218, 27, 10),
(219, 27, 11),
(220, 27, 12),
(221, 28, 13),
(222, 28, 14),
(223, 28, 15),
(224, 28, 16),
(225, 28, 1),
(226, 28, 2),
(227, 28, 3),
(228, 28, 4),
(229, 28, 5),
(230, 28, 6),
(231, 29, 7),
(232, 29, 8),
(233, 29, 9),
(234, 29, 10),
(235, 30, 11),
(236, 30, 12),
(237, 30, 13),
(238, 30, 14),
(239, 30, 15),
(240, 30, 16),
(241, 31, 1),
(242, 31, 2),
(243, 31, 3),
(244, 31, 4),
(245, 31, 5),
(246, 32, 6),
(247, 32, 7),
(248, 32, 8),
(249, 32, 9),
(250, 33, 10),
(251, 33, 11),
(252, 33, 12),
(253, 33, 13),
(254, 33, 14),
(255, 33, 15),
(256, 35, 16),
(257, 35, 1),
(258, 35, 2),
(259, 35, 3),
(260, 35, 4),
(261, 35, 5),
(262, 35, 6),
(263, 35, 7),
(264, 35, 8),
(265, 35, 9),
(266, 35, 10),
(267, 35, 11),
(268, 35, 12),
(269, 36, 13),
(270, 36, 14),
(271, 36, 15),
(272, 36, 16),
(273, 36, 1),
(274, 36, 2),
(275, 36, 3),
(276, 36, 4),
(277, 37, 5),
(278, 37, 6),
(279, 37, 7),
(280, 37, 8),
(281, 37, 9),
(282, 37, 10),
(283, 38, 11),
(284, 38, 12),
(285, 38, 13),
(286, 38, 14),
(287, 38, 15),
(288, 38, 16),
(289, 38, 1),
(290, 38, 2),
(291, 39, 3),
(292, 39, 4),
(293, 39, 5),
(294, 39, 6),
(295, 39, 7),
(296, 39, 8),
(297, 39, 9),
(298, 39, 10),
(299, 39, 11),
(300, 39, 12),
(301, 40, 13),
(302, 40, 14),
(303, 40, 15),
(304, 40, 16),
(305, 40, 1),
(306, 40, 2),
(307, 41, 3),
(308, 41, 4),
(309, 41, 5),
(310, 41, 6),
(311, 41, 7),
(312, 41, 8),
(313, 41, 9),
(314, 41, 10),
(315, 41, 11),
(316, 41, 12),
(317, 41, 13),
(318, 42, 14),
(319, 42, 15),
(320, 42, 16),
(321, 42, 1),
(322, 42, 2),
(323, 42, 3),
(324, 42, 4),
(325, 42, 5),
(326, 42, 6),
(327, 42, 7),
(328, 42, 8),
(329, 42, 9),
(330, 42, 10),
(331, 43, 11),
(332, 43, 12),
(333, 43, 13),
(334, 43, 14),
(335, 43, 15),
(336, 43, 16),
(337, 43, 1),
(338, 43, 2),
(339, 44, 3),
(340, 44, 4),
(341, 44, 5),
(342, 44, 6),
(343, 44, 7),
(344, 44, 8),
(345, 44, 9),
(346, 44, 10),
(347, 44, 11),
(348, 44, 12),
(349, 45, 13),
(350, 45, 14),
(351, 45, 15),
(352, 45, 16),
(353, 45, 1),
(354, 45, 2),
(355, 45, 3),
(356, 45, 4),
(357, 45, 5),
(358, 45, 6),
(359, 45, 7),
(360, 45, 8),
(361, 46, 9),
(362, 46, 10),
(363, 46, 11),
(364, 46, 12),
(365, 46, 13),
(366, 46, 14),
(367, 46, 15),
(368, 46, 16),
(369, 46, 1),
(370, 46, 2),
(371, 46, 3),
(372, 46, 4),
(373, 47, 5),
(374, 47, 6),
(375, 47, 7),
(376, 47, 8),
(377, 47, 9),
(378, 47, 10),
(379, 47, 11),
(380, 47, 12),
(381, 47, 13),
(382, 47, 14),
(383, 47, 15),
(384, 47, 16),
(385, 47, 1),
(386, 47, 2),
(387, 47, 3),
(388, 47, 4),
(389, 48, 5),
(390, 48, 6),
(391, 48, 7),
(392, 48, 8),
(393, 48, 9),
(394, 48, 10),
(395, 48, 11),
(396, 48, 12),
(397, 48, 13),
(398, 48, 14),
(399, 48, 15),
(400, 48, 16),
(401, 48, 1),
(402, 48, 2),
(403, 48, 3),
(404, 48, 4),
(405, 2, 2),
(406, 4, 2),
(407, 13, 2),
(408, 24, 2),
(409, 41, 2),
(410, 6, 2),
(411, 11, 2),
(412, 16, 2),
(413, 20, 2),
(414, 22, 2),
(415, 29, 2),
(416, 32, 2),
(417, 33, 2),
(418, 49, 18);

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

DROP TABLE IF EXISTS `menus`;
CREATE TABLE IF NOT EXISTS `menus` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `restaurant_id` int(20) NOT NULL,
  `category` varchar(100) NOT NULL,
  `itemname` varchar(100) NOT NULL,
  `ingredients` varchar(500) NOT NULL,
  `price` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=31 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`id`, `restaurant_id`, `category`, `itemname`, `ingredients`, `price`) VALUES
(1, 1223343, 'categoery', 'cordon b ler', 'something', 123334),
(2, 1223343, 'coldcuts', 'sandwich', 'hame, egg, cheese', 123123),
(3, 1223343, 'coldcuts', 'werwer', 'rtgwrth', 345345),
(4, 1223343, 'blablabla', 'sdfsdf', 'sdfdsf', 12312),
(5, 1223343, 'coldcuts', 'newnewnew', 'newnewnew', 872364),
(6, 1223343, 'oldold', 'oldoldold', 'kwjehrtkhew0', 87324),
(7, 1223343, 'another', 'category', 'ergerg', 2134234),
(8, 1223343, 'oldold', 'submit', 'submit', 234234),
(21, 9, 'coldcuts', 'Cake', 'ergert', 1232134),
(10, 6, '123', '123', '123', 123),
(11, 6, '1231231', '213123', '123123123112', 12312312),
(12, 6, '1231231', 'yxcyxc', 'yxcyxc', 0),
(13, 6, '1231231', 'qqqq', 'qqqqq', 444444),
(14, 6, 'newnew', 'humm', 'humm', 654654),
(15, 5, 'iuzweiuzwer', 'lkjeflwer', 'ljwelrkgj', 222222),
(20, 9, 'blablabla', 'oeirjfo1', 'sojfij', 987645),
(17, 7, 'qweqwe', 'wer', 'qwer', 234234),
(18, 1, 'beverages', 'sdf', 'wewe', 123123),
(19, 8, 'coldcuts', 'weqwe', 'qweqwe', 123123),
(22, 9, 'oldold', 'dgerfg', 'ferfer', 7698678),
(23, 9, 'qweqweqe', 'ssssssssss', 'sfsefrs', 456345),
(24, 9, 'coldcuts', 'new additional food', 'ezoteric shit', 31415),
(25, 9, 'coldcuts', 'new additional food 222', 'ezoteric shit', 31415),
(26, 9, 'coldcuts', 'new additional food', 'ezoteric shit', 31415),
(27, 9, 'coldcuts', 'new additional food', 'ezoteric shit', 31415),
(28, 9, 'coldcuts', 'new additional food', 'ezoteric shit', 31415),
(29, 9, 'coldcuts', 'new additional food 2', 'ezoteric shit', 31415),
(30, 9, 'deserts', 'new food', 'new ing', 123);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `places`
--

DROP TABLE IF EXISTS `places`;
CREATE TABLE IF NOT EXISTS `places` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `places`
--

INSERT INTO `places` (`id`, `name`, `address`, `phone`, `email`) VALUES
(1, 'Véndiák', 'Bp. Egyetem tér 5.', '', ''),
(2, 'Champs Sport Pub', 'Bp. Dohány u. 60.', '', ''),
(3, 'Longford Irish Pub', 'Bp. Fehérhajó u. 5.', '', ''),
(4, 'Box-utca', 'Bp. Bajcsy Zs. út 21.', '', ''),
(5, 'Stex House', 'Bp. József krt. 55-57.', '', ''),
(6, 'Henry J. Bean\'s Pub', 'Bp. Szent István krt. 13.', '', ''),
(7, 'Bitcoin Bar', 'Bp. Astoria', '', ''),
(8, 'New place', 'new@test', '', ''),
(9, 'New 2', 'New 2 address', 'new 2 phone', 'new2@test');

-- --------------------------------------------------------

--
-- Table structure for table `restaurants`
--

DROP TABLE IF EXISTS `restaurants`;
CREATE TABLE IF NOT EXISTS `restaurants` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `cusine` varchar(50) NOT NULL,
  `address` varchar(50) NOT NULL,
  `phone` int(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `user_id` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `restaurants`
--

INSERT INTO `restaurants` (`id`, `name`, `cusine`, `address`, `phone`, `email`, `user_id`) VALUES
(1, 'name', 'cusine', 'address', 0, '', 20),
(2, '1', '2', '3', 44, '5', 20),
(3, 'Bitcoin Bar', 'crypto', 'cybernet', 120120, 'binance@binance.hu', 20),
(5, 'Fresh bar drink', 'update food', 'Adailade beach', 222, 'cool@grenada.com.au', 1),
(8, 'qweqwe', 'qweqwe', 'qweqwe', 12012, 'qweqwe', 32),
(9, 'Update bar 222', 'cool food', 'Adailade beach', 11111, 'upcoolistic@grenada.com.au', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `password` varchar(50) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `year` year(4) NOT NULL,
  `gender` enum('M','F') NOT NULL DEFAULT 'M',
  `userlevel` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `fullname`, `phone`, `email`, `year`, `gender`, `userlevel`) VALUES
(1, 'everred', '1fe9d2701b30106bd3a4dfd91fc87659', 'Tobb nev egyben tovabb', '000000', 'emailaddress', 1986, 'F', 0),
(2, 'red-devil', '9a9982269bf894c45257889025c82d2f', '', '', '', 1981, 'M', 0),
(3, 'giornalista', '2a933eee593487c4ecc29f16d30290ca', '', '', '', 1982, 'M', 0),
(4, 'for-dzsi', '82415301f8a76f5f2659bfc277d474b6', '', '', '', 1977, 'M', 0),
(5, 'Rob Gordon', '97776e9c9696caa05e69dccbbcfae6d3', '', '', '', 1959, 'M', 0),
(6, 'Matt-fradi', 'c5c660707ccbfdbaa7892e5bb7150781', '', '', '', 1982, 'M', 0),
(7, 'aragorn', 'fc26a25b41496f0d05eca5ded010218f', '', '', '', 1952, 'F', 0),
(8, 'milton keynes', '3632fb9284708e0a5f627ce2c3fcb687', '', '', '', 1971, 'F', 0),
(9, 'aftersun', '31227af9f4022f2fb64462bf69db8faa', '', '', '', 1981, 'M', 0),
(10, 'm.b.d.', '435def9f6b6adbebf43b03d8857340bf', '', '', '', 1968, 'M', 0),
(11, 'm.r.a.', '11626767d97fc554493757170ba80712', '', '', '', 1991, 'M', 0),
(12, 'xhege-papa', '85ad4057ae4219ea6cf8566b946352fa', '', '', '', 1963, 'M', 0),
(13, 'heinci', '8f2bc84f89d67bef2e9d6e0ab7bc2ce8', '', '', '', 1974, 'M', 0),
(14, 'Jay-X', '108a08775d9f36bdd00f402aaaba482a', '', '', '', 1976, 'M', 0),
(15, 'gottó', 'c926ce4932ddb994a7e912af278fd049', '', '', '', 1984, 'M', 0),
(16, 'fighting', '10933ceaff3c94fa3844de8a15af6a45', '', '', '', 1973, 'M', 0),
(20, 'septest', '1fe9d2701b30106bd3a4dfd91fc87659', '', '', '', 1901, 'M', 1),
(32, 'septest3', '72324388a37b98951d693a8757f0a453', 'qweqwe', '654654', 'binance@binance.hu', 1919, 'F', 0);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
