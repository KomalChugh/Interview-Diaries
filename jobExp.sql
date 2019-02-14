-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 11, 2017 at 11:16 AM
-- Server version: 5.7.14
-- PHP Version: 5.6.25

drop database if exists jobexp;
create database jobexp;

USE jobexp;


SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `internship-job-experience`
--

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `content` text NOT NULL,
  `time_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `category` int(1) NOT NULL,
  `views` int(11) NOT NULL DEFAULT '0',
  `department` int(2) NOT NULL,
  `year` int(4) NOT NULL,
  `graduate` int(1) NOT NULL,
  `place` varchar(80) NOT NULL,
  `user_name` varchar(120) NOT NULL,
  `title` varchar(60) NOT NULL,
  `accepted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `oauth_provider` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `oauth_uid` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `first_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `gender` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `locale` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `picture` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `link` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `admin` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `oauth_provider`, `oauth_uid`, `first_name`, `last_name`, `email`, `gender`, `locale`, `picture`, `link`, `created`, `modified`, `admin`) VALUES
(10001, 'google', '109513784350067844699', 'VAIBHAV', 'CHOPRA', '2016eeb1104@iitrpr.ac.in', 'N', 'en', 'https://lh3.googleusercontent.com/-XdUIqdMkCWA/AAAAAAAAAAI/AAAAAAAAAAA/4252rscbv5M/photo.jpg', '/', '2017-08-06 04:52:12', '2017-08-08 11:36:53', 0),
(10002, 'google', '109209694254888455674', 'PRATIK', 'CHHAJER', '2015csb1025@iitrpr.ac.in', 'male', 'en', 'https://lh3.googleusercontent.com/-ayRPU0g8awc/AAAAAAAAAAI/AAAAAAAAAAA/f4Z5BFkKuTo/photo.jpg', 'https://plus.google.com/109209694254888455674', '2017-08-06 04:57:08', '2017-08-08 11:27:05', 1),
(10003, 'google', '102824107243280268415', 'VINIT', ' KOTHAWADE', '2015csb1039@iitrpr.ac.in', 'male', 'en', 'https://lh6.googleusercontent.com/-ZSyxrzDOK34/AAAAAAAAAAI/AAAAAAAAAH0/pqsxmHI0J9c/photo.jpg', 'https://plus.google.com/102824107243280268415', '2017-08-06 07:00:46', '2017-08-06 07:05:26', 0),
(10004, 'google', '114797395459691793466', 'Priyanka', 'Kurkure', '2015eeb1061@iitrpr.ac.in', 'female', 'en', 'https://lh6.googleusercontent.com/-XCNLyyMZveU/AAAAAAAAAAI/AAAAAAAAAV8/-FSb34WdqKo/photo.jpg', 'https://plus.google.com/114797395459691793466', '2017-08-06 07:02:58', '2017-08-06 07:03:00', 0),
(10005, 'google', '108280345494377401596', 'AAKASH', 'AGGARWAL', '2015med1001@iitrpr.ac.in', 'N', 'en', 'https://lh6.googleusercontent.com/-oTTH0NOF0c4/AAAAAAAAAAI/AAAAAAAAABA/41FCflVjqPY/photo.jpg', '/', '2017-08-07 09:22:55', '2017-08-09 16:37:52', 1),
(10006, 'google', '108418221740956355498', 'Subodh', 'sharma', 'subodh.sharma@iitrpr.ac.in', 'N', 'en', 'https://lh3.googleusercontent.com/-XdUIqdMkCWA/AAAAAAAAAAI/AAAAAAAAAAA/4252rscbv5M/photo.jpg', '/', '2017-08-07 09:31:39', '2017-08-07 09:46:20', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
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
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10007;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
