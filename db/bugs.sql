-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 02, 2023 at 11:12 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bugs`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `post_id` varchar(250) NOT NULL,
  `user_id` varchar(250) NOT NULL,
  `comment` varchar(2000) NOT NULL,
  `nick_name` varchar(250) NOT NULL,
  `pic` varchar(1000) NOT NULL,
  `date` varchar(250) NOT NULL,
  `time` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `post_id`, `user_id`, `comment`, `nick_name`, `pic`, `date`, `time`) VALUES
(33, '71', '14', 'crazy', 'renz', 'uploads/47d945f9d42cc90c711ab5451c691354.jpg', 'December 22, 2022', '11:58 AM'),
(34, '74', '14', 'hey help kita', 'renz', 'uploads/47d945f9d42cc90c711ab5451c691354.jpg', 'December 22, 2022', '11:58 AM'),
(35, '74', '14', 'para ez', 'renz', 'uploads/47d945f9d42cc90c711ab5451c691354.jpg', 'December 22, 2022', '11:58 AM');

-- --------------------------------------------------------

--
-- Table structure for table `hearts`
--

CREATE TABLE `hearts` (
  `id` int(11) NOT NULL,
  `post_id` varchar(250) NOT NULL,
  `user_id` varchar(250) NOT NULL,
  `value` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `hearts`
--

INSERT INTO `hearts` (`id`, `post_id`, `user_id`, `value`) VALUES
(75, '73', '17', '1'),
(76, '71', '14', '1'),
(77, '74', '14', '1');

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `id` int(11) NOT NULL,
  `sender_id` varchar(250) NOT NULL,
  `receiver_id` varchar(250) NOT NULL,
  `date` varchar(250) NOT NULL,
  `time` varchar(250) NOT NULL,
  `message_text` mediumtext NOT NULL,
  `message_upload` varchar(5000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`id`, `sender_id`, `receiver_id`, `date`, `time`, `message_text`, `message_upload`) VALUES
(46, '14', '16', 'December 22, 2022', '10:31 AM', 'hi', 'uploads_message/'),
(47, '14', '16', 'December 22, 2022', '10:31 AM', 'this is the sample logo', 'uploads_message/214-2146391_web-development-icon-png.png'),
(48, '14', '16', 'December 22, 2022', '10:31 AM', '', 'uploads_message/214-2146391_web-development-icon-png.png'),
(49, '16', '14', 'December 22, 2022', '10:32 AM', 'okay', 'uploads_message/'),
(50, '16', '14', 'December 22, 2022', '10:32 AM', 'noted', 'uploads_message/'),
(51, '16', '14', 'December 22, 2022', '10:32 AM', 'do you want this to be back ground of your logo?', 'uploads_message/57d3963e43d0574d8c2f27e58ce4799d.jpg'),
(52, '16', '14', 'December 22, 2022', '10:32 AM', '', 'uploads_message/992507.jpg'),
(53, '16', '14', 'December 22, 2022', '10:32 AM', 'or this?', 'uploads_message/'),
(56, '14', '16', 'December 22, 2022', '11:52 AM', 'hi', 'uploads_message/'),
(57, '16', '14', 'December 22, 2022', '11:57 AM', '<****** nice', 'uploads_message/');

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `id` int(11) NOT NULL,
  `user_id` varchar(250) NOT NULL,
  `user_nickname` varchar(250) NOT NULL,
  `profile_img` varchar(1000) NOT NULL,
  `post_text` varchar(1000) NOT NULL,
  `bg_color` varchar(250) NOT NULL,
  `uploaded_img` varchar(1000) NOT NULL,
  `date` varchar(200) NOT NULL,
  `time` varchar(200) NOT NULL,
  `edit` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`id`, `user_id`, `user_nickname`, `profile_img`, `post_text`, `bg_color`, `uploaded_img`, `date`, `time`, `edit`) VALUES
(71, '16', 'iori yagami', 'uploads/Mc1.webp', 'Cool', '#000000', 'uploads_img_post/47d945f9d42cc90c711ab5451c691354.jpg', 'December 21, 2022', '12:14 PM', 'NO'),
(72, '14', 'renz', 'uploads/47d945f9d42cc90c711ab5451c691354.jpg', 'Hello everyone', '#3bb052', 'uploads_img_post/', 'December 21, 2022', '12:15 PM', 'NO'),
(73, '17', 'kong D.', 'uploads/artworks-000512958213-xt4gpw-t500x500.jpg', 'Sample post with text', '#000000', 'uploads_img_post/HD-wallpaper-jay-jo-flash-graphy-manhwa-wind-breaker.jpg', 'December 21, 2022', '1:08 PM', 'YES'),
(74, '17', 'kong D.', 'uploads/artworks-000512958213-xt4gpw-t500x500.jpg', 'hirap mag isip ng gagawin sa profile hayup', '#000000', 'uploads_img_post/', 'December 22, 2022', '10:50 AM', 'NO');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `nickname` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  `picture` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `nickname`, `email`, `password`, `picture`) VALUES
(14, 'renz collin capena', 'renz', 'renz@io', 'renz', 'uploads/47d945f9d42cc90c711ab5451c691354.jpg'),
(16, 'iori yagami', 'iori yagami', 'king@io', 'king', 'uploads/Mc1.webp'),
(17, 'kong delacurz', 'kong D.', 'kong@io', 'kong', 'uploads/artworks-000512958213-xt4gpw-t500x500.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hearts`
--
ALTER TABLE `hearts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `hearts`
--
ALTER TABLE `hearts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
