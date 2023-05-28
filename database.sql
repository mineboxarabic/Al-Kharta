-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3308
-- Generation Time: May 22, 2023 at 03:05 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `al_kharta_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `articles`
--

CREATE TABLE `articles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(300) DEFAULT NULL,
  `subtitle` varchar(300) DEFAULT NULL,
  `writer` varchar(300) DEFAULT NULL,
  `content` text DEFAULT NULL,
  `tags` int(11) DEFAULT NULL,
  `thumnail` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `articles`
--

INSERT INTO `articles` (`id`, `title`, `subtitle`, `writer`, `content`, `tags`, `thumnail`) VALUES
(1, 'Welcome to article number 1.', 'Welcome to article number 1.', 'Yassin YOUNES', '\r\n\r\n<h1> Welcome to the contents </h1>\r\n\r\n<table class=\"table\">\r\n  <thead>\r\n    <tr>\r\n      <th scope=\"col\">#</th>\r\n      <th scope=\"col\">First</th>\r\n      <th scope=\"col\">Last</th>\r\n      <th scope=\"col\">Handle</th>\r\n    </tr>\r\n  </thead>\r\n  <tbody>\r\n    <tr>\r\n      <th scope=\"row\">1</th>\r\n      <td>Mark</td>\r\n      <td>Otto</td>\r\n      <td>@mdo</td>\r\n    </tr>\r\n    <tr>\r\n      <th scope=\"row\">2</th>\r\n      <td>Jacob</td>\r\n      <td>Thornton</td>\r\n      <td>@fat</td>\r\n    </tr>\r\n    <tr>\r\n      <th scope=\"row\">3</th>\r\n      <td colspan=\"2\">Larry the Bird</td>\r\n      <td>@twitter</td>\r\n    </tr>\r\n  </tbody>\r\n</table>', 1, 'https://thumbs.dreamstime.com/z/d-num%C3%A9ro-un-d-isolement-au-dessus-du-blanc-93393701.jpg'),
(2, 'Welcome to article number 2.', 'Welcome to article number 2.', 'Yassin YOUNES', '\r\n\r\n<h1> Welcome to the contents </h1>\r\n\r\n<table class=\"table\">\r\n  <thead>\r\n    <tr>\r\n      <th scope=\"col\">#</th>\r\n      <th scope=\"col\">First</th>\r\n      <th scope=\"col\">Last</th>\r\n      <th scope=\"col\">Handle</th>\r\n    </tr>\r\n  </thead>\r\n  <tbody>\r\n    <tr>\r\n      <th scope=\"row\">1</th>\r\n      <td>Mark</td>\r\n      <td>Otto</td>\r\n      <td>@mdo</td>\r\n    </tr>\r\n    <tr>\r\n      <th scope=\"row\">2</th>\r\n      <td>Jacob</td>\r\n      <td>Thornton</td>\r\n      <td>@fat</td>\r\n    </tr>\r\n    <tr>\r\n      <th scope=\"row\">3</th>\r\n      <td colspan=\"2\">Larry the Bird</td>\r\n      <td>@twitter</td>\r\n    </tr>\r\n  </tbody>\r\n</table>', 2, 'data:image/jpeg;base64,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'),
(3, 'Welcome to article number 3.', 'Welcome to article number 3.', 'Yassin YOUNES', '\r\n\r\n<h1> Welcome to the contents </h1>\r\n\r\n<table class=\"table\">\r\n  <thead>\r\n    <tr>\r\n      <th scope=\"col\">#</th>\r\n      <th scope=\"col\">First</th>\r\n      <th scope=\"col\">Last</th>\r\n      <th scope=\"col\">Handle</th>\r\n    </tr>\r\n  </thead>\r\n  <tbody>\r\n    <tr>\r\n      <th scope=\"row\">1</th>\r\n      <td>Mark</td>\r\n      <td>Otto</td>\r\n      <td>@mdo</td>\r\n    </tr>\r\n    <tr>\r\n      <th scope=\"row\">2</th>\r\n      <td>Jacob</td>\r\n      <td>Thornton</td>\r\n      <td>@fat</td>\r\n    </tr>\r\n    <tr>\r\n      <th scope=\"row\">3</th>\r\n      <td colspan=\"2\">Larry the Bird</td>\r\n      <td>@twitter</td>\r\n    </tr>\r\n  </tbody>\r\n</table>', 3, 'data:image/jpeg;base64,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');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `articles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;
-------------------------------------------------------------
-- Table structure for table `tags`
--

CREATE TABLE `tags` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL
);

--
-- Table structure for table `article_tag`

CREATE TABLE `article_tag` (
  `article_id` bigint(20) UNSIGNED NOT NULL,
  `tag_id` bigint(20) UNSIGNED NOT NULL
);

-- Insert data into tables

INSERT INTO `articles` (`id`, `title`, `body`, `created_at`, `updated_at`) VALUES
(1, 'First Article', 'This is the body of the first article', '2018-01-01 00:00:00', '2018-01-01 00:00:00'),
(2, 'Second Article', 'This is the body of the second article', '2018-01-01 00:00:00', '2018-01-01 00:00:00'),
(3, 'Third Article', 'This is the body of the third article', '2018-01-01 00:00:00', '2018-01-01 00:00:00');

INSERT INTO `tags` (`id`, `name`) VALUES
(1, 'News'),
(2, 'Updates'),
(3, 'Announcements');

INSERT INTO `article_tag` (`article_id`, `tag_id`) VALUES
(1, 1),
(1, 2),
(2, 2),
(3, 3);
```