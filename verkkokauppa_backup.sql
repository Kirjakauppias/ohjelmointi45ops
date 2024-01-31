-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 31.01.2024 klo 07:05
-- Palvelimen versio: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `verkkokauppa`
--

-- --------------------------------------------------------

--
-- Rakenne taululle `orderitems`
--

CREATE TABLE `orderitems` (
  `OrderItemID` int(11) NOT NULL,
  `OrderID` int(11) DEFAULT NULL,
  `ProductID` int(11) DEFAULT NULL,
  `Quantity` int(11) DEFAULT NULL,
  `Subtotal` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Vedos taulusta `orderitems`
--

INSERT INTO `orderitems` (`OrderItemID`, `OrderID`, `ProductID`, `Quantity`, `Subtotal`) VALUES
(1, 1, 1, 1, 19.99),
(2, 2, 2, 1, 24.99),
(3, 3, 3, 1, 14.99),
(4, 4, 1, 1, 79.99),
(5, 4, 5, 1, 129.99),
(6, 5, 9, 1, 179.99),
(7, 6, 8, 1, 149.99),
(8, 7, 7, 1, 999.99),
(9, 7, 2, 1, 49.99),
(10, 8, 3, 3, 449.97),
(11, 9, 6, 1, 24.99),
(12, 10, 4, 1, 59.99),
(13, 10, 8, 1, 149.99),
(14, 11, 9, 1, 179.99),
(15, 12, 2, 1, 49.99),
(16, 12, 4, 1, 59.99),
(17, 13, 4, 1, 59.99),
(18, 13, 1, 1, 79.99),
(19, 14, 2, 1, 49.99),
(20, 15, 1, 1, 79.99);

-- --------------------------------------------------------

--
-- Rakenne taululle `orders`
--

CREATE TABLE `orders` (
  `OrderID` int(11) NOT NULL,
  `UserID` int(11) DEFAULT NULL,
  `OrderDate` datetime DEFAULT NULL,
  `Status` enum('Pending','Shipped','Delivered') DEFAULT NULL,
  `TotalPrice` decimal(10,2) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Vedos taulusta `orders`
--

INSERT INTO `orders` (`OrderID`, `UserID`, `OrderDate`, `Status`, `TotalPrice`, `deleted_at`) VALUES
(1, 1, '2023-10-15 10:30:00', 'Pending', 19.99, NULL),
(2, 2, '2023-10-16 14:45:00', 'Shipped', 24.99, NULL),
(3, 3, '2023-10-17 11:15:00', 'Delivered', 14.99, NULL),
(4, 8, '2024-01-17 17:49:30', 'Delivered', 209.98, NULL),
(5, 8, '2024-01-17 17:49:34', '', 179.99, NULL),
(6, 8, '2024-01-17 17:56:38', '', 149.99, NULL),
(7, 8, '2024-01-17 18:02:27', 'Pending', 1049.98, NULL),
(8, 8, '2024-01-18 21:17:53', 'Pending', 149.99, NULL),
(9, 10, '2024-01-19 17:01:10', 'Pending', 24.99, NULL),
(10, 10, '2024-01-19 17:01:51', 'Pending', 209.98, NULL),
(11, 8, '2024-01-21 21:41:10', 'Pending', 179.99, '2024-01-30 09:30:01'),
(12, 8, '2024-01-22 10:20:20', 'Pending', 109.98, '2024-01-30 09:30:00'),
(13, 8, '2024-01-24 20:23:11', 'Pending', 139.98, '2024-01-30 09:29:58'),
(14, 16, '2024-01-25 17:22:01', 'Pending', 49.99, '2024-01-30 09:29:57'),
(15, 8, '2024-01-28 17:45:40', 'Pending', 79.99, '2024-01-30 09:29:55');

-- --------------------------------------------------------

--
-- Rakenne taululle `products`
--

CREATE TABLE `products` (
  `ProductID` int(11) NOT NULL,
  `ProductName` varchar(100) DEFAULT NULL,
  `Description` text DEFAULT NULL,
  `Price` decimal(10,2) DEFAULT NULL,
  `ImageURL` varchar(255) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Vedos taulusta `products`
--

INSERT INTO `products` (`ProductID`, `ProductName`, `Description`, `Price`, `ImageURL`, `deleted_at`) VALUES
(1, 'Elegant Wristwatch', 'A sleek and stylish wristwatch with a genuine leather strap.', 79.99, 'wristwatch.jpg', NULL),
(2, 'Artisanal Handbag', 'Handcrafted handbag with intricate embroidery and a timeless design.', 49.99, 'handbag.jpg', NULL),
(3, 'Smart Home Speaker', 'Voice-activated smart speaker with built-in virtual assistant and impressive sound quality.', 149.00, 'smart_speaker.jpg', NULL),
(4, 'Luxury Perfume', 'Exquisite perfume with a captivating scent in an elegant glass bottle.', 59.99, 'perfume.jpg', NULL),
(5, 'Designer Dress', 'Fashion-forward designer dress that is perfect for special occasions.', 129.99, 'designer_dress.jpg', NULL),
(6, 'Gourmet Cheese Selection', 'Indulge in a variety of artisanal cheeses from around the world.', 24.99, 'cheese_selection.jpg', NULL),
(7, 'High-Performance Laptop', 'Powerful laptop for work and entertainment with a high-resolution display.', 999.99, 'laptop.jpg', NULL),
(8, 'Vintage Record Player', 'Enjoy your vinyl collection with a vintage-style record player.', 149.99, 'record_player.jpg', NULL),
(9, 'Leather Office Chair', 'Ergonomic office chair with genuine leather upholstery for superior comfort.', 179.99, 'office_chair.jpg', NULL),
(10, 'Wireless Gaming Mouse', 'Responsive gaming mouse with customizable RGB lighting and precision tracking.', 39.99, 'gaming_mouse.jpg', NULL),
(11, 'Mobile Phone', 'The lastest model of our new serie.', 750.00, 'mobile_phone.jpg', NULL);

-- --------------------------------------------------------

--
-- Rakenne taululle `users`
--

CREATE TABLE `users` (
  `UserID` int(11) NOT NULL,
  `FirstName` varchar(50) DEFAULT NULL,
  `LastName` varchar(50) DEFAULT NULL,
  `Password` varchar(255) DEFAULT NULL,
  `Email` varchar(100) DEFAULT NULL,
  `Address` varchar(255) DEFAULT NULL,
  `UserType` enum('Customer','Admin') DEFAULT NULL,
  `Username` varchar(255) DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Vedos taulusta `users`
--

INSERT INTO `users` (`UserID`, `FirstName`, `LastName`, `Password`, `Email`, `Address`, `UserType`, `Username`, `deleted_at`) VALUES
(1, 'John', 'Doe', 'hashed_password', 'toinenuusi@osoite.com', '123 Main St', 'Customer', 'JhonnyBoy', NULL),
(2, 'Jane', 'Smith', 'hashed_password', 'uusi@hotmail.com', '456 Elm St', 'Admin', 'Mary', NULL),
(3, 'Alice', 'Johnson', 'hashed_password', 'lissu@yahoo.com', '789 Oak St', 'Customer', 'Lissu', NULL),
(8, 'Jaska', 'Leppari', '$2y$10$61fSp/PpxURHv5.T16OnfeFzg8pX.hl3jRfk7kwxxXzr5nHU8k6P2', 'metarktis@gmail.com', 'Uusi osoite 2', 'Admin', 'Miguli', NULL),
(10, 'Katja ', 'Ylikotila', '$2y$10$nHpZt9QiMNxIzfoVmpb1DO9PUOTeeEznD07dpEfxiDOvhgDw2se2e', 'katja_hannele@hotmail.com', 'Särkiranta', 'Customer', 'Katja', NULL),
(16, 'ZorroForro', 'Engard', '$2y$10$2jYR3aErnA37JU5ucgh4mu6YnLJ22wDbvqvBYXi8iEorS0.1kUuby', 'zorro@zorro.com', 'Zorrola 5', 'Customer', 'Zorro', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `orderitems`
--
ALTER TABLE `orderitems`
  ADD PRIMARY KEY (`OrderItemID`),
  ADD KEY `OrderID` (`OrderID`),
  ADD KEY `ProductID` (`ProductID`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`OrderID`),
  ADD KEY `UserID` (`UserID`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`ProductID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`UserID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `orderitems`
--
ALTER TABLE `orderitems`
  MODIFY `OrderItemID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `OrderID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `ProductID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Rajoitteet vedostauluille
--

--
-- Rajoitteet taululle `orderitems`
--
ALTER TABLE `orderitems`
  ADD CONSTRAINT `orderitems_ibfk_1` FOREIGN KEY (`OrderID`) REFERENCES `orders` (`OrderID`),
  ADD CONSTRAINT `orderitems_ibfk_2` FOREIGN KEY (`ProductID`) REFERENCES `products` (`ProductID`);

--
-- Rajoitteet taululle `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
