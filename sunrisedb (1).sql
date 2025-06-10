-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Cze 10, 2025 at 07:43 PM
-- Wersja serwera: 10.4.28-MariaDB
-- Wersja PHP: 8.1.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sunrisedb`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `address`
--

CREATE TABLE `address` (
  `id` int(11) NOT NULL,
  `city` varchar(50) NOT NULL,
  `postal` varchar(10) NOT NULL,
  `address` varchar(75) NOT NULL,
  `create_date` datetime NOT NULL,
  `mod_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `address`
--

INSERT INTO `address` (`id`, `city`, `postal`, `address`, `create_date`, `mod_date`) VALUES
(7, 'adminss', '11-111', 'admin 2', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(24, 'dsad', '12-121', 'dsada 32', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(27, 'Miasto', '12-121', 'ulica 12', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(28, 'Miasto', '12-121', 'ulica 12', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(29, 'Miasto', '12-121', 'ulica 12', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(30, 'Miasto', '12-121', 'ulica 12', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(31, 'Miasto', '12-121', 'ulica 12', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(33, 'sdad', '11-111', 'dsadsa 123', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `category_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `category_name`) VALUES
(1, 'Wódka'),
(2, 'Whisky'),
(6, 'Gin'),
(14, 'wino wytrawne');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `info_pages`
--

CREATE TABLE `info_pages` (
  `id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `filename` varchar(20) NOT NULL,
  `path` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `info_pages`
--

INSERT INTO `info_pages` (`id`, `name`, `filename`, `path`) VALUES
(1, 'Polityka Prywatności', 'privacy', '../info_pages/privacy'),
(3, 'Dostawa', 'shipping', '../info_pages/shipping');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `order_data`
--

CREATE TABLE `order_data` (
  `id` int(11) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `mail` varchar(100) NOT NULL,
  `telephone` varchar(11) NOT NULL,
  `address_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `invoice_name` varchar(100) NOT NULL,
  `invoice_mail` varchar(100) NOT NULL,
  `invoice_telephone` varchar(11) NOT NULL,
  `invoice_address_id` int(11) NOT NULL,
  `status` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_data`
--

INSERT INTO `order_data` (`id`, `firstname`, `lastname`, `mail`, `telephone`, `address_id`, `order_id`, `invoice_name`, `invoice_mail`, `invoice_telephone`, `invoice_address_id`, `status`) VALUES
(12, 'dsad', 'Seroka', 'kubax2208@gmail.com', '123123123', 24, 17, 'Jakub Seroka', 'kubax2208@gmail.com', '123 321 223', 24, 0),
(13, 'Jakubs', 'Seroka', 'kubax2208@gmail.com', '', 24, 18, 'Jakub Seroka', 'kubax2208@gmail.com', '123 321 223', 24, 0),
(14, 'Jakub', 'Seroka', 'kubax2208@gmail.com', '123 321 223', 24, 19, 'Jakub Seroka', 'kubax2208@gmail.com', '123 321 223', 24, 0),
(15, 'Jakub', 'Seroka', 'kubax2208@gmail.com', '123 321 222', 24, 20, 'Jakub Seroka', 'kubax2208@gmail.com', '123 321 222', 24, 0),
(16, 'Jakub', 'Seroka', 'kubax2208@gmail.com', '123 321 222', 24, 21, 'Jakub Seroka', 'kubax2208@gmail.com', '123 321 222', 24, 0),
(22, 'admin', 'admin', 'admin@admin.com', '123123123', 7, 27, 'admin admin', 'admin@admin.com', '323 232 323', 7, 1),
(23, 'admin', 'admin', 'admin@admin.com', '321312313', 7, 28, 'admin admin', 'admin@admin.com', '321 312 313', 7, 2),
(24, 'admin', 'admin', 'admin@admin.com', '123123321', 7, 29, 'admin admin', 'admin@admin.com', '123 123 321', 7, 2),
(25, 'admin', 'admin', 'admin@admin.com', '123123321', 7, 30, 'admin admin', 'admin@admin.com', '123 123 321', 7, 0),
(26, 'admin', 'admin', 'admin@admin.com', '123123321', 7, 31, 'admin admin', 'admin@admin.com', '123 123 321', 7, 0);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `order_details`
--

CREATE TABLE `order_details` (
  `id` int(11) NOT NULL,
  `total` float NOT NULL,
  `payment_id` int(11) NOT NULL,
  `shipping_id` int(11) NOT NULL,
  `status` varchar(20) NOT NULL,
  `creation_date` datetime NOT NULL,
  `mod_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`id`, `total`, `payment_id`, `shipping_id`, `status`, `creation_date`, `mod_date`) VALUES
(17, 100, 3, 1, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(18, 300, 3, 1, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(19, 300, 3, 1, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(20, 100, 3, 1, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(21, 100, 3, 1, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(27, 151, 3, 2, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(28, 100, 3, 2, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(29, 100, 3, 1, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(30, 200, 3, 2, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(31, 400, 5, 2, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `order_product`
--

CREATE TABLE `order_product` (
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_product`
--

INSERT INTO `order_product` (`order_id`, `product_id`, `quantity`) VALUES
(17, 59, 1),
(18, 30, 2),
(19, 30, 2),
(20, 59, 1),
(21, 59, 1),
(27, 30, 1),
(28, 59, 1),
(29, 59, 1),
(30, 71, 1),
(31, 71, 2);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `parameters`
--

CREATE TABLE `parameters` (
  `id` int(11) NOT NULL,
  `param_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `parameters`
--

INSERT INTO `parameters` (`id`, `param_name`) VALUES
(10, 'testowy'),
(11, 'parametr 1'),
(12, 'niga'),
(13, 'Moc'),
(14, 'guh'),
(15, 'dsa'),
(16, 'Pochodzenie');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `payment`
--

CREATE TABLE `payment` (
  `id` int(11) NOT NULL,
  `payment_name` varchar(50) NOT NULL,
  `payment_cost` float NOT NULL,
  `isActive` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`id`, `payment_name`, `payment_cost`, `isActive`) VALUES
(3, 'Przelew tradycyjny', 0, 1),
(4, 'BLIK', 0, 1),
(5, 'PayU', 0.02, 1),
(6, 'Karta kredytowa', 0.02, 1);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `photos`
--

CREATE TABLE `photos` (
  `id` int(11) NOT NULL,
  `path` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `photos`
--

INSERT INTO `photos` (`id`, `path`) VALUES
(27, '../../img/testowy Gin_img.png'),
(56, '../../img/tets123_img.png'),
(59, '../../img/test_img.png'),
(67, '../../img/Wino_img.png'),
(68, '../../img/Singleton_img.png'),
(69, '../../img/dsad_img.png');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `product_name` varchar(50) NOT NULL,
  `category_id` int(11) NOT NULL,
  `price` float NOT NULL,
  `description` text NOT NULL,
  `stock` int(11) NOT NULL,
  `photo_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `product_name`, `category_id`, `price`, `description`, `stock`, `photo_id`) VALUES
(30, 'testowy Gin', 6, 151, 'teścik', 290, 27),
(59, 'tets123', 6, 100, 'testowy opis produktu', 1234, 56),
(62, 'test', 1, 2132, 'dsadas', 3, 59),
(70, 'Wino', 14, 50, 'Bardzo smaczne wino', 20, 67),
(71, 'Singleton', 2, 200, 'Single Malt Whisky', 30, 68),
(72, 'dsad', 2, 321, 'dsada', 32, 69);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `product-params`
--

CREATE TABLE `product-params` (
  `product_id` int(11) NOT NULL,
  `param_id` int(11) NOT NULL,
  `param_value` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product-params`
--

INSERT INTO `product-params` (`product_id`, `param_id`, `param_value`) VALUES
(30, 14, 'asd'),
(59, 11, 'wartosc 1'),
(62, 13, '40'),
(70, 16, '14%'),
(71, 13, '40%'),
(72, 13, '40%'),
(72, 16, 'liberia');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `returns`
--

CREATE TABLE `returns` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `reason` text NOT NULL,
  `submitted_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `returns`
--

INSERT INTO `returns` (`id`, `order_id`, `user_id`, `reason`, `submitted_at`) VALUES
(1, 29, 4, 'dsa', '2025-06-01 19:40:07'),
(2, 28, 4, 'dsad', '2025-06-01 19:49:27'),
(3, 27, 4, '', '2025-06-01 19:49:56'),
(4, 27, 4, '', '2025-06-01 19:56:10'),
(5, 27, 4, '', '2025-06-01 19:56:40');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `shipping`
--

CREATE TABLE `shipping` (
  `id` int(11) NOT NULL,
  `shipper_name` varchar(50) NOT NULL,
  `shipping_cost` float NOT NULL,
  `isActive` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `shipping`
--

INSERT INTO `shipping` (`id`, `shipper_name`, `shipping_cost`, `isActive`) VALUES
(1, 'InPost Kurier', 12.99, 1),
(2, 'InPost Paczkomat', 14.99, 1),
(3, 'DPD', 12, 0),
(4, 'DHL', 13, 1),
(5, 'Poczta Polska', 21, 1);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `mail` varchar(100) NOT NULL,
  `login` varchar(20) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `address_id` int(11) NOT NULL,
  `telephone` varchar(9) NOT NULL,
  `isAdmin` tinyint(1) NOT NULL,
  `isActive` tinyint(1) NOT NULL,
  `activationHash` varchar(255) NOT NULL,
  `create_date` datetime NOT NULL,
  `mod_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `mail`, `login`, `pass`, `firstname`, `lastname`, `address_id`, `telephone`, `isAdmin`, `isActive`, `activationHash`, `create_date`, `mod_date`) VALUES
(4, 'admin@admin.com', 'admin', '$2y$10$5uD5za5g99lQELGRNnC68eL3E6LbIojE9BG5.y4Tuf4LORB620dsS', 'admin', 'admin', 7, '123123321', 1, 1, '1232131313123123123', '2023-09-28 17:49:34', '2025-06-01 20:48:33'),
(5, 'admin1@admin.com', 'admin1', '$2y$10$BGBnendFIOVYupzHoNeOsuu90KdIWzMA3txMPahrljHye9vtnmicu', 'admin1', 'admin1', 7, '000000000', 0, 1, '', '2023-09-28 00:00:00', '2025-05-26 19:57:57'),
(18, 'kubax2208@gmail.com', 'jseroka', '$2y$10$sQfFIHs7b3WYsLTpKC40We/M4YxNlFfLbYoyCSJvHbSXGx.iNryGy', 'dsada', 'Seroka', 24, '213123123', 0, 1, '$2y$10$SJMWCPa80ULyy8k69GBp0OPaoNwD7xZFlvKmW/PKiIhCeFwPyY0vq', '2025-03-23 09:01:58', '2025-05-28 13:52:54'),
(27, 'dsada@ds.ds', 'dsadsa', '$2y$10$LG1uzE4tWuXY0eQvXwq/7eMOkE.xZl5zH/QX6KR1zEEZUyoVDI1PG', 'dsadsa', 'dsada', 33, '222 222 2', 0, 1, '$2y$10$cROLM0zxAbmchHCrGl5RT.PsNdb5vYMqYXS6KF1dkwT9e/2/8nD3.', '2025-06-10 18:22:55', '0000-00-00 00:00:00');

--
-- Wyzwalacze `user`
--
DELIMITER $$
CREATE TRIGGER `user_create_date` BEFORE INSERT ON `user` FOR EACH ROW set new.create_date = now()
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `user_mod_date` BEFORE UPDATE ON `user` FOR EACH ROW set new.mod_date = now()
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `user_order`
--

CREATE TABLE `user_order` (
  `user_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_order`
--

INSERT INTO `user_order` (`user_id`, `order_id`) VALUES
(4, 25),
(4, 26),
(4, 27),
(4, 28),
(4, 29),
(4, 30),
(4, 31),
(18, 16),
(18, 17),
(18, 18),
(18, 19),
(18, 20),
(18, 21),
(18, 22),
(18, 23),
(18, 24);

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `address`
--
ALTER TABLE `address`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `info_pages`
--
ALTER TABLE `info_pages`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `order_data`
--
ALTER TABLE `order_data`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `payment_id` (`payment_id`),
  ADD KEY `shipping_id` (`shipping_id`);

--
-- Indeksy dla tabeli `order_product`
--
ALTER TABLE `order_product`
  ADD PRIMARY KEY (`order_id`,`product_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indeksy dla tabeli `parameters`
--
ALTER TABLE `parameters`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `photos`
--
ALTER TABLE `photos`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `photo_id` (`photo_id`);

--
-- Indeksy dla tabeli `product-params`
--
ALTER TABLE `product-params`
  ADD PRIMARY KEY (`product_id`,`param_id`),
  ADD KEY `param_id` (`param_id`);

--
-- Indeksy dla tabeli `returns`
--
ALTER TABLE `returns`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indeksy dla tabeli `shipping`
--
ALTER TABLE `shipping`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `mail` (`mail`),
  ADD KEY `address_id` (`address_id`);

--
-- Indeksy dla tabeli `user_order`
--
ALTER TABLE `user_order`
  ADD PRIMARY KEY (`user_id`,`order_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `address`
--
ALTER TABLE `address`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `info_pages`
--
ALTER TABLE `info_pages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `order_data`
--
ALTER TABLE `order_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `parameters`
--
ALTER TABLE `parameters`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `photos`
--
ALTER TABLE `photos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT for table `returns`
--
ALTER TABLE `returns`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `shipping`
--
ALTER TABLE `shipping`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `order_details_ibfk_2` FOREIGN KEY (`payment_id`) REFERENCES `payment` (`id`),
  ADD CONSTRAINT `order_details_ibfk_3` FOREIGN KEY (`shipping_id`) REFERENCES `shipping` (`id`);

--
-- Constraints for table `order_product`
--
ALTER TABLE `order_product`
  ADD CONSTRAINT `order_product_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `order_details` (`id`),
  ADD CONSTRAINT `order_product_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`);

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`photo_id`) REFERENCES `photos` (`id`);

--
-- Constraints for table `product-params`
--
ALTER TABLE `product-params`
  ADD CONSTRAINT `product-params_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`),
  ADD CONSTRAINT `product-params_ibfk_2` FOREIGN KEY (`param_id`) REFERENCES `parameters` (`id`);

--
-- Constraints for table `returns`
--
ALTER TABLE `returns`
  ADD CONSTRAINT `returns_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `order_details` (`id`),
  ADD CONSTRAINT `returns_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`address_id`) REFERENCES `address` (`id`);

--
-- Constraints for table `user_order`
--
ALTER TABLE `user_order`
  ADD CONSTRAINT `user_order_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
