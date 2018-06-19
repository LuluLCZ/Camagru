<?php
require_once("database.php");
$db_con = connect_db();
$db_con->exec("CREATE DATABASE IF NOT EXISTS `camagru` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `camagru`;

-- --------------------------------------------------------

--
-- Table structure for table `imgs`
--

CREATE TABLE `imgs` (
  `id` int(11) NOT NULL,
  `author` varchar(255) NOT NULL,
  `uid` int(11) NOT NULL,
  `date_uplo` date NOT NULL,
  `content` longblob NOT NULL,
  `nrate` int(11) NOT NULL,
  `ncoms` int(11) NOT NULL,
  `filter_path` text NOT NULL,
  `commentaires` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `imgs`
--

-- --------------------------------------------------------

--
-- Table structure for table `img_com`
--

CREATE TABLE `img_com` (
  `id` int(11) NOT NULL,
  `img_id` int(11) NOT NULL,
  `date_com` date NOT NULL,
  `auth` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `rate` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `img_com`
--

-- --------------------------------------------------------

--
-- Table structure for table `img_vote`
--

CREATE TABLE `img_vote` (
  `img_id` int(11) NOT NULL,
  `uid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `img_vote`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `pseudo` varchar(255) NOT NULL,
  `passwd` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `admin` int(11) NOT NULL,
  `confirm` int(11) NOT NULL,
  `confirm_key` varchar(255) NOT NULL,
  `sumup` text NOT NULL,
  `autonotif` int(11) NOT NULL,
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

--
-- Indexes for dumped tables
--

--
-- Indexes for table `imgs`
--
ALTER TABLE `imgs` ADD PRIMARY KEY( `id`);
ALTER TABLE `imgs` CHANGE `id` `id` INT(11) NOT NULL AUTO_INCREMENT;
--
-- Indexes for table `img_com`
--
ALTER TABLE `img_com` ADD PRIMARY KEY( `id`);
ALTER TABLE `img_com` CHANGE `id` `id` INT(11) NOT NULL AUTO_INCREMENT;
--
-- Indexes for table `users`
--
ALTER TABLE `users` ADD PRIMARY KEY( `id`);
ALTER TABLE `users` CHANGE `id` `id` INT(11) NOT NULL AUTO_INCREMENT;
");
?>