-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 06, 2022 at 10:26 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `books_store`
--

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `id` int(100) NOT NULL,
  `description` varchar(500) DEFAULT NULL,
  `title` varchar(100) NOT NULL,
  `price` int(100) NOT NULL,
  `stock` int(100) NOT NULL,
  `author` varchar(100) NOT NULL,
  `cat_id` int(100) NOT NULL,
  `img` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`id`, `description`, `title`, `price`, `stock`, `author`, `cat_id`, `img`) VALUES
(1, 'I am a book for agatha christie', 'And Then There Were None', 2, 4, 'agatha christie', 1, 'https://i.ibb.co/0jD99pp/1.jpg'),
(2, 'the secret of love that lasts', 'the 5 love languages', 20, 2, 'Gary Chapman', 2, 'https://i.ibb.co/Hhf0T87/2.jpg'),
(3, 'Who are you?<br>What have we done to each other?', 'Gone girl', 10, 5, 'Gillian Flynn', 1, 'https://i.ibb.co/M61VTjZ/3.jpg'),
(4, 'he\'s absolutely not falling for the good girl.', 'Things We Never Got Over', 7, 9, 'Lucy Score', 2, 'https://i.ibb.co/86kP2Gb/60060431-SY475.jpg'),
(5, 'Would you defend your husband if he was accused of killing his mistress?', 'The Perfect Marriage', 11, 8, 'Jeneva Rose', 1, 'https://i.ibb.co/7JmkHqp/53450790.jpg'),
(6, 'When Mary receives a blank diary as a present, she thinks nothing of it. Until she opens the diary, and sees it’s not blank after all.', 'The Murder List', 15, 9, 'Jackie Kabler', 1, 'https://i.ibb.co/VW0KcGj/the-murder-list-8.jpg'),
(7, 'Would you sign up to a medical trial if you didn’t know the possible side effects?', 'The Trial', 20, 5, 'S.R. Masters', 1, 'https://i.ibb.co/QN4206L/41qsf-EZik-AL.jpg'),
(8, 'Essays on Midlife and Motherhood', 'I\'ll Show Myself Out', 14, 6, 'Jessi Klein', 3, 'https://i.ibb.co/h2QN9jt/714vv1-T7we-L.jpg'),
(9, 'If we must live in interesting times, there is no one better to chronicle them than the incomparable David Sedaris.', 'Happy-Go-Lucky Hardcover', 20, 8, 'David Sedaris', 3, 'https://i.ibb.co/x5785GK/9781408714102.webp'),
(10, 'For every intellectual misfit who thought they were the only ones to think the things that Lawson dares to say out loud, this is a poignant and hysterical look at the dark, disturbing, yet wonderful moments of our lives.', 'Let\'s Pretend This Never Happened', 18, 7, 'Jenny Lawson', 3, 'https://i.ibb.co/st7tNn9/517-W5q2i-QSL.jpg'),
(11, '“The degree to which The Devil Wears Prada has penetrated pop culture needs no explanation.”—Vanity Fair', 'The Devil Wears Prada a Novel', 20, 6, 'Lauren Weisberger', 3, 'https://i.ibb.co/1ryVLcy/81o-WMd-Wtl-AL.jpg'),
(12, 'Meet Ove. He’s a curmudgeon—the kind of man who points at people he dislikes as if they were burglars caught outside his bedroom window.', 'A Man Called Ove', 10, 8, 'Fredrik Backman', 4, 'https://i.ibb.co/hm1fCLS/8192k-BRq-Z0-L.jpg'),
(13, 'this story of seemingly unbearable tragedy is transformed into a suspenseful and touching story about family, memory, love, heaven, and living.', 'The Lovely Bones', 20, 10, 'Alice Seboldn', 4, 'https://i.ibb.co/WKKGKgW/the-lovely-bones-6.jpg'),
(14, 'No one’s ever told Eleanor that life should be better than fine. ', 'Eleanor Oliphant Is Completely Fine', 14, 6, 'Gail Honeyman', 4, 'https://i.ibb.co/ZfcLSSK/91n-HC-xa5-KL.jpg'),
(15, '“I can\'t even express how much I love this book! I didn\'t want this story to end!”—Reese Witherspoon', 'Where the Crawdads Sing', 20, 7, 'Delia Owens', 4, 'https://i.ibb.co/pzr3GSN/where-the-crawdads-sing-2.jpg'),
(16, 'A mesmerizing tale of unjust imprisonment and offbeat escape, Rita Hayworth and Shawshank Redemption is one of Stephen King’s most beloved and iconic stories', 'Rita Hayworth and Shawshank Redemption', 14, 10, 'Stephen King', 4, 'https://i.ibb.co/vVnvnS1/61-Dk3-RDghh-L.jpg'),
(17, 'Coraline discovered the door a little while after they moved into the house....', 'Coraline', 15, 10, 'Neil Gaiman', 5, 'https://i.ibb.co/VHTZ0G7/coraline.jpg'),
(18, 'Interweaving past and present, Josh Malerman’s breathtaking debut is a horrific and gripping snapshot of a world unraveled that will have you racing to the final page.', 'Bird Box', 25, 4, 'Josh Malerman', 5, 'https://i.ibb.co/0ydhTKn/418-JCd-EBd-GL-SX323-BO1-204-203-200.jpg'),
(19, '“It’s as if a supernatural power compels us to turn the pages of the gripping Mexican Gothic.”—The Washington Post', 'Mexican Gothic', 22, 10, 'Silvia Moreno-Garcia ', 5, 'https://i.ibb.co/vkRq4sP/511-SNjn-A2-UL-AC-SY780.jpg'),
(20, 'The new voice in Amanda\'s head, the one that tells her to steal things and talk to strange men in bars, is strange and frightening, and Amanda struggles to wrest back control of her life.', 'Come Closer', 20, 12, 'Sara Gran ', 5, 'https://i.ibb.co/7zG4T66/91cx-U8-FJDML.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `book_cart`
--

CREATE TABLE `book_cart` (
  `cart_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `amount` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `book_order`
--

CREATE TABLE `book_order` (
  `book_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `amount` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `book_order`
--

INSERT INTO `book_order` (`book_id`, `order_id`, `amount`) VALUES
(2, 11, 2),
(2, 12, 2),
(3, 12, 1),
(4, 11, 2),
(4, 12, 2),
(7, 13, 2),
(17, 11, 1),
(17, 12, 1),
(18, 14, 2),
(18, 15, 2),
(18, 16, 2),
(18, 17, 2),
(18, 18, 2),
(18, 19, 2);

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `user_id`) VALUES
(1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `book_count` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `book_count`) VALUES
(1, 'thriller', 5),
(2, 'Romance', 2),
(3, 'comedy', 5),
(4, 'drama', 5),
(5, 'horror', 4);

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `message` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(100) NOT NULL,
  `total_price` int(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `date` datetime(6) NOT NULL,
  `user_id` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `total_price`, `address`, `date`, `user_id`) VALUES
(5, 69, 'Sidi Beshr, alexandria, Egypt', '2022-09-01 16:13:07.000000', 1),
(6, 69, 'Sidi Beshr, alexandria, Egypt', '2022-09-01 16:13:07.000000', 1),
(7, 69, 'Sidi Beshr, alexandria, Egypt', '2022-09-01 16:18:24.000000', 1),
(8, 69, 'Sidi Beshr, alexandria, Egypt', '2022-09-01 16:43:27.000000', 1),
(9, 69, 'Sidi Beshr, alexandria, Egypt', '2022-09-01 16:44:07.000000', 1),
(10, 69, 'Sidi Beshr, alexandria, Egypt', '2022-09-01 16:44:31.000000', 1),
(11, 69, 'Sidi Beshr, alexandria, Egypt', '2022-09-01 16:45:57.000000', 1),
(12, 79, 'Sidi Beshr, alexandria, Egypt', '2022-09-01 17:00:20.000000', 1),
(13, 40, 'Sidi Beshr, alexandria, Egypt', '2022-09-01 17:05:50.000000', 1),
(14, 50, 'Sidi Beshr, alexandria, Egypt', '2022-09-01 17:07:22.000000', 1),
(15, 50, 'Sidi Beshr, alexandria, Egypt', '2022-09-01 17:08:14.000000', 1),
(16, 50, 'Sidi Beshr, alexandria, Egypt', '2022-09-01 17:08:48.000000', 1),
(17, 50, 'Sidi Beshr, alexandria, Egypt', '2022-09-01 17:09:07.000000', 1),
(18, 50, 'Sidi Beshr, alexandria, Egypt', '2022-09-01 17:11:34.000000', 1),
(19, 50, 'Sidi Beshr, alexandria, Egypt', '2022-09-01 17:12:18.000000', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `name`, `password`) VALUES
(1, 'malaknasser26@gmail.com', 'Malak Nasser', '123456');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cat_id` (`cat_id`);

--
-- Indexes for table `book_cart`
--
ALTER TABLE `book_cart`
  ADD PRIMARY KEY (`cart_id`,`book_id`),
  ADD KEY `book_id` (`book_id`);

--
-- Indexes for table `book_order`
--
ALTER TABLE `book_order`
  ADD PRIMARY KEY (`book_id`,`order_id`),
  ADD KEY `order_id` (`order_id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `books`
--
ALTER TABLE `books`
  ADD CONSTRAINT `books_ibfk_1` FOREIGN KEY (`cat_id`) REFERENCES `categories` (`id`);

--
-- Constraints for table `book_cart`
--
ALTER TABLE `book_cart`
  ADD CONSTRAINT `book_cart_ibfk_1` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`),
  ADD CONSTRAINT `book_cart_ibfk_2` FOREIGN KEY (`cart_id`) REFERENCES `cart` (`id`);

--
-- Constraints for table `book_order`
--
ALTER TABLE `book_order`
  ADD CONSTRAINT `book_order_ibfk_1` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`),
  ADD CONSTRAINT `book_order_ibfk_2` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`);

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
