-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 05, 2023 at 05:25 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `game_fixation`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_account`
--

CREATE TABLE `tbl_account` (
  `id` int(11) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `paswwrd` text DEFAULT NULL,
  `role` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_account`
--

INSERT INTO `tbl_account` (`id`, `username`, `email`, `paswwrd`, `role`, `status`) VALUES
(1, 'shoaib', 'shoaib@gmail.com', 'cb87541b95c402ba76d969240afd660d', 1, 0),
(2, 'test', 'test@gmail.com', 'a3876fafbc8b9b9d3820b6e3a610e3d2', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category`
--

CREATE TABLE `tbl_category` (
  `id` int(11) NOT NULL,
  `category` varchar(255) DEFAULT NULL,
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_category`
--

INSERT INTO `tbl_category` (`id`, `category`, `status`) VALUES
(3, 'Xbox', 0),
(5, 'PS5', 0),
(6, 'Iphone', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_comment`
--

CREATE TABLE `tbl_comment` (
  `id` int(11) NOT NULL,
  `gameid` int(11) DEFAULT NULL,
  `title` text DEFAULT NULL,
  `comment` text DEFAULT NULL,
  `username` varchar(100) DEFAULT NULL,
  `userid` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_comment`
--

INSERT INTO `tbl_comment` (`id`, `gameid`, `title`, `comment`, `username`, `userid`, `status`) VALUES
(1, 1, 'test', 'test', 'shoaib', 1, 0),
(2, 1, 'test', 'esde', 'shoaib', 1, 0),
(3, 3, 'Assassin\'s Creed: Mirage plot', '', 'shoaib', 1, 0),
(4, 3, 'Assassin\'s Creed: Mirage plot', 'test', 'shoaib', 1, 0),
(5, 3, 'Assassin\'s Creed: Mirage plot', 'new platform', 'test', 2, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_contact`
--

CREATE TABLE `tbl_contact` (
  `id` int(11) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `email` text DEFAULT NULL,
  `title` text DEFAULT NULL,
  `message` text DEFAULT NULL,
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_contact`
--

INSERT INTO `tbl_contact` (`id`, `username`, `email`, `title`, `message`, `status`) VALUES
(1, 'shoaib', 'test@gmail.com', 'testing', 'testing', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_game`
--

CREATE TABLE `tbl_game` (
  `id` int(11) NOT NULL,
  `title` text NOT NULL,
  `genre` text NOT NULL,
  `releaseDate` date DEFAULT NULL,
  `publisher` varchar(100) DEFAULT NULL,
  `category` varchar(50) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `multiplayerSupport` enum('Yes','No') DEFAULT NULL,
  `dLCsExpansions` text DEFAULT NULL,
  `systemRequirements` text DEFAULT NULL,
  `screenshots` text DEFAULT NULL,
  `trailer` text DEFAULT NULL,
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_game`
--

INSERT INTO `tbl_game` (`id`, `title`, `genre`, `releaseDate`, `publisher`, `category`, `description`, `multiplayerSupport`, `dLCsExpansions`, `systemRequirements`, `screenshots`, `trailer`, `status`) VALUES
(1, 'test', 'test', '2023-07-04', 'test', 'PS5', 'test', 'Yes', 'assets/uploads/setup/wpide.zip', 'test', 'assets/uploads/img/no-mans-sky-game-wallpaper.jpg', 'test', 0),
(2, 'Alan Wake II plot', 'Action, Adventure, Horror, Shooter', '2023-10-17', 'Epic Games Publishing', 'PS5', 'Saga Anderson arrives to investigate ritualistic murders in a small town. Alan Wake pens a dark story to shape the reality around him. These two heroes are somehow connected. Can they become the heroes they need to be?<br><br><br>A string of ritualistic murders threatens Bright Falls, a small-town community surrounded by the Pacific Northwest wilderness. Saga Anderson, an accomplished FBI agent with a reputation for solving impossible cases, arrives to investigate the murders. Anderson’s case spirals into a nightmare when she discovers pages of a horror story that start to come true around her.<br><br>Alan Wake, a lost writer trapped in a nightmare beyond our world, writes a dark story in an attempt to shape the reality around him and escape his prison. With a dark horror hunting him, Wake is trying to retain his sanity and beat the devil at his own game.<br><br>Anderson and Wake are two heroes on two desperate journeys in two separate realities, connected at heart in ways neither of them can understand: reflecting each other, echoing each other, and affecting the worlds around them.\r\n<br><br>Fueled by the horror story, supernatural darkness invades Bright Falls, corrupting the locals and threatening the loved ones of both Anderson and Wake. Light is their weapon—and their safe haven — against the darkness they face. Trapped in a sinister horror story where there are only victims and monsters, can they break out to be the heroes they need to be?<br><br>\r\n<h4>Solve a Deadly Mystery</h4>\r\nWhat begins as a small-town murder investigation rapidly spirals into a nightmare journey. Uncover the source of the supernatural darkness in this psychological horror story filled with intense suspense and unexpected twists.', 'No', 'assets/uploads/setup/GrammarlyInstaller.cZWmaA62utho83iojddc0302.exe', '0', 'assets/uploads/img/9dce19a1-5003-4577-856d-920b904a8fac.jpeg', 'https://youtu.be/q6TmhvIpIoI', 0),
(3, 'Assassin\'s Creed: Mirage plot', 'Action,Adventure', '2002-12-10', 'Ubisoft', 'PS5', 'Experience the story of Basim, a cunning street thief seeking answers and justice as he navigates the bustling streets of ninth-century Baghdad. Through a mysterious, ancient organization known as the Hidden Ones, he will become a deadly Master Assassin and change his fate in ways he never could have imagined.\r\n\r\nExperience a modern take on the iconic features and gameplay that have defined a franchise for 15 years.\r\n\r\nParkour seamlessly through the city and stealthily take down targets with more visceral assassinations than ever before.\r\n\r\nExplore an incredibly dense and vibrant city whose inhabitants react to your every move, and uncover the secrets of four unique districts as you venture through the Golden Age of Baghdad.', 'No', 'assets/uploads/setup/HPSupportSolutionsFramework-12.19.53.13.exe', '0', 'assets/uploads/img/1b98f5e1-ced5-464e-95d5-55a82f49aacf.jpeg', 'https://youtu.be/KNdpbE-JiKY', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_review`
--

CREATE TABLE `tbl_review` (
  `id` int(11) NOT NULL,
  `gameid` int(11) DEFAULT NULL,
  `title` text DEFAULT NULL,
  `rating` double DEFAULT NULL,
  `review` text DEFAULT NULL,
  `username` varchar(100) DEFAULT NULL,
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_review`
--

INSERT INTO `tbl_review` (`id`, `gameid`, `title`, `rating`, `review`, `username`, `status`) VALUES
(1, 3, 'Assassin\'s Creed: Mirage plot', 3.2, 'testing', 'shoaib', 0),
(2, 2, 'Alan Wake II plot', 7.6, 'lorem ipsum', 'shoaib', 0),
(3, 2, 'Alan Wake II plot', 9.8, 'dasewq ddsadas asasa', 'shoaib', 0),
(4, 1, 'test', 4.3, 'wasxcx dcsf', 'shoaib', 1),
(5, 3, 'Assassin\'s Creed: Mirage plot', 9.8, 'test', 'shoaib', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_slider`
--

CREATE TABLE `tbl_slider` (
  `id` int(11) NOT NULL,
  `heading` text DEFAULT NULL,
  `text` text DEFAULT NULL,
  `image` text DEFAULT NULL,
  `category` varchar(100) DEFAULT NULL,
  `url` text DEFAULT NULL,
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_slider`
--

INSERT INTO `tbl_slider` (`id`, `heading`, `text`, `image`, `category`, `url`, `status`) VALUES
(1, 'test', 'test', 'no-mans-sky-game-wallpaper.jpg', 'PS5', 'test', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_video`
--

CREATE TABLE `tbl_video` (
  `id` int(11) NOT NULL,
  `video` text DEFAULT NULL,
  `url` text DEFAULT NULL,
  `thumbnail` text NOT NULL,
  `voption` varchar(100) DEFAULT NULL,
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_video`
--

INSERT INTO `tbl_video` (`id`, `video`, `url`, `thumbnail`, `voption`, `status`) VALUES
(3, 'test', '1675182504762.mp4', '', 'Upload', 0),
(4, 'youtube', 'link', '', 'Youtube', 0),
(6, 'testing', '1675182504762.mp4', '', 'Upload', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_account`
--
ALTER TABLE `tbl_account`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `tbl_category`
--
ALTER TABLE `tbl_category`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `category` (`category`);

--
-- Indexes for table `tbl_comment`
--
ALTER TABLE `tbl_comment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_contact`
--
ALTER TABLE `tbl_contact`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_game`
--
ALTER TABLE `tbl_game`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_review`
--
ALTER TABLE `tbl_review`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_slider`
--
ALTER TABLE `tbl_slider`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_video`
--
ALTER TABLE `tbl_video`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_account`
--
ALTER TABLE `tbl_account`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_category`
--
ALTER TABLE `tbl_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_comment`
--
ALTER TABLE `tbl_comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_contact`
--
ALTER TABLE `tbl_contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_game`
--
ALTER TABLE `tbl_game`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_review`
--
ALTER TABLE `tbl_review`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_slider`
--
ALTER TABLE `tbl_slider`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_video`
--
ALTER TABLE `tbl_video`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
