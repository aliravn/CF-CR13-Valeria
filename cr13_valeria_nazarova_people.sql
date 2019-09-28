-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 28, 2019 at 04:56 PM
-- Server version: 5.7.27-0ubuntu0.18.04.1
-- PHP Version: 7.2.19-0ubuntu0.18.04.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cr13_valeria_nazarova_people`
--

-- --------------------------------------------------------

--
-- Table structure for table `friendships`
--

CREATE TABLE `friendships` (
  `friendshipID` int(11) NOT NULL,
  `fk_userID_from` int(11) DEFAULT NULL,
  `fk_userID_to` int(11) DEFAULT NULL,
  `friend_status` enum('request','confirmed','declined') DEFAULT 'request'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `friendships`
--

INSERT INTO `friendships` (`friendshipID`, `fk_userID_from`, `fk_userID_to`, `friend_status`) VALUES
(1, 2, 3, 'confirmed'),
(2, 4, 3, 'confirmed'),
(3, 3, 5, 'confirmed'),
(4, 4, 2, 'confirmed'),
(5, 2, 5, 'confirmed'),
(6, 4, 5, 'request'),
(7, 5, 6, 'request'),
(8, 5, 7, 'request'),
(9, 4, 7, 'request'),
(40, 12, 11, 'request'),
(41, 12, 10, 'request'),
(42, 13, 2, 'confirmed'),
(56, 5, 8, 'request'),
(57, 7, 12, 'request'),
(58, 7, 11, 'request'),
(59, 13, 1, 'request'),
(60, 13, 3, 'request'),
(61, 13, 4, 'request'),
(62, 13, 5, 'confirmed');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userID` int(11) NOT NULL,
  `useremail` varchar(50) DEFAULT NULL,
  `userpass` varchar(255) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `userpic` varchar(255) DEFAULT 'img/avatar_default.jpg',
  `userpriv` varchar(6) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userID`, `useremail`, `userpass`, `username`, `userpic`, `userpriv`) VALUES
(1, 'alira@ex.org', '2785dc722d888c0b5bed8c746271ba4e67681b1e15f222ca6aecfd1e8ec356b0', 'Alira', 'img/avatar_alira.jpg', 'master'),
(2, 'valeria@ex.org', 'd8474b674d6b6c348505e84739159904552878c2c04fa6e9ab2662f87121ad7a', 'Valeria', 'img/avatar_alira.jpg', '0'),
(3, 'anja@ex.org', '997a112833e93377df20380853e8dde95dca0f26273cb85dc20ed43be369a17c', 'Anja', 'img/avatar_default.jpg', '0'),
(4, 'tina@ex.org', '21ffadb766525fbdf8340f82833c377333aff1a568770778ab19512d6a74ebdc', 'Tina', 'img/avatar_eva.jpg', '0'),
(5, 'beeke@ex.org', 'b8b3f07f6e48102e7280d29026d9bd2db9d88515a309ca25a0c14a41b4a330bb', 'Beeke', 'img/avatar_eva.jpg', '0'),
(6, 'nicole@ex.org', 'df722832b9972928c24233c7f09470ce4b5d4e7c488cac30cdc2f62cedaf16c9', 'Nicole', 'img/avatar_eva.jpg', '0'),
(7, 'sarah@ex.org', '0f6e93a7fe8970d39dd027471d12c09cf6dc37032e740d2e23ebc58c804d6578', 'Sarah', 'img/avatar_eva.jpg', '0'),
(8, 'jessica@ex.org', '226718ad68407327e935babdf9394cc51383af875dbb24db6915cc12684e663c', 'Jessica', 'img/avatar_eva.jpg', '0'),
(9, 'karrianne@ex.org', 'cdf9cc7ec3ae4e84cc98ac13df2c5a4cabf85ef64b65a45282bc09cc0ab2d29e', 'Karianne', 'img/avatar_eva.jpg', '0'),
(10, 'vildan@ex.org', '65df3f48cb1c8c43034d17236df49690fcbf08ce72e21f47c413a9f50975296a', 'Vildan', 'img/avatar_eva.jpg', '0'),
(11, 'kathi@ex.org', 'a6725a2fc35c4dcb82d5ca190c20aadc72eb332f1220219239f9af48f5b2b61e', 'Kathi', 'img/avatar_eva.jpg', '0'),
(12, 'goran@ex.org', '3d381e35a0d93c77ab5a8b09e07cb2f2f0ad09a645791d7745782f94e6d1007a', 'Goran', 'img/avatar_default.jpg', '0'),
(13, 'alexmy@email.com', '5a15dc7f4f003e8ee1aa49829d9f1e0f0183f64a3c53839b2a24583d40a8aace', 'Alex', 'img/avatar_default.jpg', '0');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `friendships`
--
ALTER TABLE `friendships`
  ADD PRIMARY KEY (`friendshipID`),
  ADD KEY `fk_userID_from` (`fk_userID_from`),
  ADD KEY `fk_userID_to` (`fk_userID_to`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `friendships`
--
ALTER TABLE `friendships`
  MODIFY `friendshipID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `friendships`
--
ALTER TABLE `friendships`
  ADD CONSTRAINT `friendships_ibfk_1` FOREIGN KEY (`fk_userID_from`) REFERENCES `users` (`userID`),
  ADD CONSTRAINT `friendships_ibfk_2` FOREIGN KEY (`fk_userID_to`) REFERENCES `users` (`userID`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
