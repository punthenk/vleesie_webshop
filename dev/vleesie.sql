-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: db
-- Generation Time: May 21, 2025 at 05:02 PM
-- Server version: 8.3.0
-- PHP Version: 8.2.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `webshop`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `ID` bigint UNSIGNED NOT NULL,
  `customer_id` bigint UNSIGNED NOT NULL,
  `ordered` tinyint UNSIGNED NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`ID`, `customer_id`, `ordered`, `created_at`, `updated_at`) VALUES
(22, 27, 0, '2025-05-20 17:32:01', NULL),
(23, 16, 0, '2025-05-20 18:53:35', NULL),
(24, 28, 0, '2025-05-21 07:16:49', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cart_items`
--

CREATE TABLE `cart_items` (
  `ID` bigint NOT NULL,
  `cart_id` bigint NOT NULL,
  `product_id` bigint NOT NULL,
  `amount` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `cart_items`
--

INSERT INTO `cart_items` (`ID`, `cart_id`, `product_id`, `amount`) VALUES
(244, 22, 7, 11),
(245, 22, 8, 13),
(246, 22, 10, 8),
(247, 22, 11, 17),
(249, 23, 1, 2),
(250, 23, 10, 5),
(251, 23, 11, 3),
(252, 23, 4, 3),
(254, 24, 5, 5),
(255, 24, 9, 15),
(256, 24, 6, 10);

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `ID` int NOT NULL,
  `firstname` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `lastname` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `prefix` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `street` varchar(120) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `house_number` varchar(100) NOT NULL,
  `addition` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `zipcode` varchar(10) NOT NULL,
  `city` varchar(60) NOT NULL,
  `email` varchar(60) NOT NULL,
  `password` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`ID`, `firstname`, `lastname`, `prefix`, `street`, `house_number`, `addition`, `zipcode`, `city`, `email`, `password`) VALUES
(14, 'Koen', 'Brouwer', '', 'Jerden', '10', '', '9292 VL', 'Drachten', 'koenbrouwer@gmail.com', '$2y$10$jxrAa3B6DKfGbX.fh8Wc6uRf4mPNL1OvdcpPZpLSwJEs.SaXks9fy'),
(16, 'Michiel', 'Nijenhuis', '', 'De Wieren', '16', '', '9866 AK', 'Lutjegast', 'Michielmitsjol@gmail.com', '$2y$10$fJkarr4i422DjWuWtJZK4O0ePWuOe4E1rJTitzhER3NzuRFot6PCu'),
(27, 'Kees', 'Kip', 'Van Der', 'kippenlaan', '13', 'A', '1234 AB', 'Kippenvallei', 'keeskip@kippenmail.com', '$2y$10$mfdsDrJRMjD0isXnBGw6MuQQBeHHeG/j4FX9miK.RdjlADq7ENm5K'),
(28, 'Auke', 'Meijer', '', 'laan', '1', '', '1234 AB', 'Kippenvallei', 'Auke@vleesie.com', '$2y$10$HirL0xWIBCs2xTigBmyu8O7pRXxNcaPib2z/yQhXrhjyAYaxlTWsK');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `ID` int NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` varchar(300) NOT NULL,
  `image` varchar(100) NOT NULL,
  `price` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`ID`, `name`, `description`, `image`, `price`) VALUES
(1, 'Rouw Vleesie speciaal', 'Dit is een van ons masterpies. Het is het lekkerste rouw vlees wat je ooit gehad hebt. Je MOET het eens proberen. (Niet gelogen).', '/img/pngtree-raw-piece-of-meat-steak-png-image_13021108.png\r\n', 9.95),
(4, 'Kogel gras', 'Dit is vlees met de naam kogelgras. Vraag mij niet waarom maar dat is het gewoon. Het is vrij goedkoop. Dus KOPEN, NU! (En het zijn 2 stukjes vlees)', '/img/Kogel-grasgevoerd.webp', 19.99),
(5, 'Tournedos Vlees', 'Tournedos vlees een van de meest pure vleesen van de wereld. Dat betenkt natuurlijk ook het duurste :) HAHA', 'img/Tournedos-vlees.png', 99.95),
(6, 'Bacon', 'Bacon vers van de kip. Je denkt vast \'nee dat kan niet\', maar dat kan WEL. Want wij hebben namelijk een bacon kip', '/img/bacon.png', 8.95),
(7, 'Vlees', 'Dit is vlees. Het plaatje hete meat dus dit is waarschijnlijk vlees', '/img/meat-htkoxlkkcfb64.avif', 5.95),
(8, 'Steak', 'Dit is een steak dat je kan eten want dat is de bedoeling', 'img/steak.webp', 49.95),
(9, 'Hollandse vleeskruiden', 'Dit zijn kruiden voor vlees. Je kan dat gebruiken om je vlees te kruiden. Als vleeskruiden nodig hebt voor jouw vlees ben je bij het goede adress, want dit is hele goede vleeskruiden.', '/img/Hollandse-Vleeskruiden.jpeg', 2.99),
(10, 'Tuana vleeskruiden', 'Ik ga niet meer uitleggen waarom je vleeskruiden nodig hebt, maar dit is ook een uitstekende topper als je wat nodig hebt.', '/img/Vlees-Kruiden-Tuana-1687710455541_68d11203-6c82-44c5-9440-072d472feac2_1200x1200.webp', 4.95),
(11, 'Vlees messenset', 'Dit zijn messen om vlees mee te snijden. Wij bij vleesie zijn er natuurlijk om het beste vlees te verkopen, maar wat nou als je je lekkkere stukje vlees niet goed kan snijden. Dat zou jammer zijn. Dus hierbij een goede messenset voor jouw vlees. \r\nKijk maar niet naar de prijs.', '/img/steak-knife.webp', 79.95),
(12, 'Vlees koekenpan', 'Moet je je voorstellen, je hebt net een prachtig stuk vlees binnen van vleesie.com en je kan het niet koken omdat je geen pan hebt. Gelukkig hebben we bij vleesie altijd goede raad. Koop deze pan.', '/img/vlees_koekenpan.jpg', 9.95);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `cart_items`
--
ALTER TABLE `cart_items`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `ID` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `cart_items`
--
ALTER TABLE `cart_items`
  MODIFY `ID` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=257;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
