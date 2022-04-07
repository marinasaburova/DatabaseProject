-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 06, 2022 at 04:56 PM
-- Server version: 5.7.37
-- PHP Version: 7.3.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jewelryshop`
--

-- --------------------------------------------------------

--
-- Table structure for table `CUSTOMER`
--

CREATE TABLE `CUSTOMER` (
  `CEmail` varchar(30) NOT NULL,
  `CPassword` varchar(60) NOT NULL,
  `CFName` varchar(15) NOT NULL,
  `CLName` varchar(15) NOT NULL,
  `isActive` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `CUSTOMER`
--

INSERT INTO `CUSTOMER` (`CEmail`, `CPassword`, `CFName`, `CLName`, `isActive`) VALUES
('maddie@gmail.com', '$2y$10$kE.iPnBVYgoSoky7gbfAFeoXA/Bx4ckPnZnKjTSW4KmsXnN7aJvSa', 'Maddie', 'Rooney', 1),
('ellewoods@gmail.com', '$2y$10$8gPdvOe/iRljb4.HqDINkeDHO/zUnSJWMkq9RcaWGTNjllwsv0PW6', 'Elle', 'Woods', 1),
('sharpay@gmail.com', '$2y$10$d7V.sQ84iKZUhyUhW2ATzeXzDwytwSdHGFqd09kEETqBueJhAnG7e', 'Sharpay', 'Evans', 1),
('london@tipton.com', '$2y$10$lgIUPIgqvT8ysrPdiHNyQu38zx0xyV.r5Udg5BWpGZY73krrLFxk2', 'London', 'Tipton', 1),
('xsaboxtagex86@gmail.com', '$2y$10$C5QzL8617APU/PVYe82rH.wHWaQgn8nHErpWC99TVQz.C2OS9r8Fm', 'Drew', 'Sabo', 1),
('ryanevans@gmail.com', '$2y$10$DdsbXcOOcEkInSLKDN/sMOipl5JUS0yyca.Ndqle3IIdW.7TtnYEa', 'Ryan', 'Evans', 1),
('1', '$2y$10$C3PH1tDmZhwYFSebpd6A7ejOtdiMr3GaSgbD8x/elNsYD/GHVkNH2', '1', '1', 1),
('123@gmail.com', '$2y$10$AiCgNtN0IIbY4gteoeBBAuMlXVaexWbs5cf5wJaVm4GhovJ3aVxwa', '1', '2', 1),
('bob@montclair.edu', '$2y$10$JEntgePveO9HjjGDPBtpO.Olp1kZNKo2fN8gtCwqkUwoKKqtackyS', 'Bob', 'Steve', 1);

-- --------------------------------------------------------

--
-- Table structure for table `EMPLOYEE`
--

CREATE TABLE `EMPLOYEE` (
  `EmpID` char(5) NOT NULL,
  `EmpEmail` varchar(30) NOT NULL,
  `EmpPassword` varchar(60) NOT NULL,
  `EmpFName` varchar(15) NOT NULL,
  `EmpLName` varchar(15) NOT NULL,
  `isActive` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `EMPLOYEE`
--

INSERT INTO `EMPLOYEE` (`EmpID`, `EmpEmail`, `EmpPassword`, `EmpFName`, `EmpLName`, `isActive`) VALUES
('11111', 'saburovam1@montclair.edu', '$2y$10$Cam6wbQmPKdV.sY0/VxPk.ouiHGTOCdzfz9doXrmXUPae6e5YbYqS', 'Marina', 'Saburova', 1),
('11112', 'livrooney@gmail.com', '$2y$10$HTh60acd5OAW6LSF.5np0ezR7yojKTU2hRN.MxuW.FgOZ3RIJu.fm', 'Liv', 'Rooney', 1),
('11113', 'kccooper@gmail.com', '$2y$10$niOqc/HgloyOsL0eguQSlunPmKZHXnHX4TsH.s4ISd3VF9Zsf25Pq', 'KC', 'Cooper', 1),
('11114', 'codymartin@tipton.com', '$2y$10$vSOBvVO/.5eSjvWPmutsSOHkNhWOcxUDUJmSi1iLwlB2qxv6h4zNK', 'Cody', 'Martin', 1),
('11115', 'elsa@gmail.com', '$2y$10$r.Bnw8kBF3dd.woH5cyiueQIgXRI2FO61zHNAzYeXl4HpchwzDgpy', 'Elsa', 'Martin', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ITEM`
--

CREATE TABLE `ITEM` (
  `ItemID` char(10) NOT NULL,
  `Name` varchar(40) NOT NULL,
  `Price` decimal(5,2) NOT NULL,
  `JewelryType` varchar(10) NOT NULL,
  `Crystal` varchar(20) NOT NULL,
  `Metal` varchar(10) NOT NULL,
  `QuantityInStock` int(3) UNSIGNED NOT NULL,
  `Description` text NOT NULL,
  `DateAdded` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ITEM`
--

INSERT INTO `ITEM` (`ItemID`, `Name`, `Price`, `JewelryType`, `Crystal`, `Metal`, `QuantityInStock`, `Description`, `DateAdded`) VALUES
('1111111111', 'Raw Gemstone Stud Earrings', 18.00, 'earring', 'rose quartz', 'silver', 17, 'Bring nature closer to you with the power of these organic stones! Rose quartz is said to bring love into your life. This pair of earrings is very minimal, too!', '2021-11-22 10:37:38'),
('1111111113', 'Opal Sea Turtle Earring', 20.00, 'earring', 'opal', 'silver', 15, 'Take it slow in our Opal Sea Turtle Earrings! This cute sea turtle design gets extra chic with a sparkly opal center in blue or white on rose gold or silver studs.', '2021-12-06 19:55:01'),
('1111111112', 'Raw Gemstone Stud Earrings', 18.00, 'earring', 'amazonite', 'silver', 20, 'Amazonite is said to bring peace, good luck, and fortune. These earrings are simple, minimal, and made with an un-polished stone. ', '2021-12-06 19:52:59'),
('1111111114', 'Moonstone Drop Earrings', 16.00, 'earring', 'moonstone', 'rose gold', 19, 'These long earrings drop down and accentuate your neck. At the bottom hangs a moonstone shaped like a teardrop.', '2021-12-06 19:59:02'),
('1111111115', 'Teardrop Earring', 14.00, 'earring', 'howlite', 'gold', 18, 'This earring is like your regular hoop earrings: but longer and oval-shaped. At the base, there are several tiny crystal beaded on.', '2021-12-06 20:01:00'),
('1111111116', 'Single Stone Labret Push-Pin', 8.00, 'earring', 'rose quartz', 'rose gold', 0, 'This is a super tiny earring with a push-pin labret back design: perfect for cartilage piercings! The earring itself is just one simple, polished gemstone. ', '2021-12-06 20:02:29'),
('1111111117', 'Sun Pendant Necklace', 22.00, 'necklace', 'clear quartz', 'gold', 19, 'This necklace is a medium-length piece with a small sun-shaped pendant in the middle. A gemstone is placed delicately in the middle of the pendant. Perfect for anyone who loves the summer or sunshine.', '2021-12-06 20:07:36'),
('1111111118', 'Bitty Square Opal Choker', 18.00, 'necklace', 'opal', 'silver', 16, 'Make a statement while still keeping it minimal with this choker! It is a short necklace, with a tiny square-shaped gem charm.', '2021-12-06 20:10:46'),
('1111111119', 'Raw Gemstone Necklace', 24.00, 'necklace', 'rose quartz', 'rose gold', 16, 'Rose quartz is said to bring love into your life, whether it is self-love and compassion or the love of others. This necklace features a non-polished, natural cut stone as a tiny and minimal pendant.', '2021-12-06 20:12:22'),
('1111111120', 'Aquamarine Beaded Choker', 16.00, 'necklace', 'aquamarine', 'silver', 0, 'Bring the ocean to you when wearing this necklace! The choker is tighter around the neck, and features several smooth, round beads of aquamarine threaded together.', '2021-12-06 20:13:46'),
('1111111121', 'Triple Bead Bracelet', 12.00, 'bracelet', 'clear quartz', 'gold', 18, 'Keep things natural and classy with our clear quartz bracelet. This piece is neutral, but the gold metal gives it a nice pop. The three gemstones are polished and perfectly round.', '2021-12-06 20:16:28'),
('1111111122', 'Raw Gemstone Bracelet', 14.00, 'bracelet', 'rose quartz', 'silver', 18, 'This bracelet matches perfectly with the raw gemstone earrings! It features a single charm, which is an unpolished and natural piece of rose quartz. Each stone is unique!', '2021-12-06 20:17:59'),
('1111111123', 'Turtle Pendant Necklace', 20.00, 'necklace', 'aquamarine', 'silver', 19, 'For each necklace purchased, we donate 25% of the profit to protect sea turtles! This necklace is medium length with an adorable turtle-shaped gemstone.', '2021-12-08 17:30:04'),
('1111111124', 'Three-layered Necklace Set', 18.00, 'necklace', 'howlite', 'gold', 20, 'This product comes with three necklaces, each a different length to give you that trendy layered look!', '2021-12-08 17:32:39'),
('1111111125', 'Turtle Pendant Bracelet', 16.00, 'bracelet', 'aquamarine', 'silver', 18, 'For each bracelet purchased, we donate 25% of the profit to protect sea turtles! This bracelet has an adorable turtle-shaped gemstone.', '2021-12-08 17:34:34'),
('1111111126', 'Wave Bracelet', 9.00, 'bracelet', 'aquamarine', 'gold', 20, 'Bring the ocean to you when wearing this bracelet! This bracelet features a wave-shaped charm, as well as several beads of natural-cut, unpolished aquamarine.', '2021-12-08 18:49:32'),
('1111111127', 'Bling Bracelet', 12.50, 'bracelet', 'clear quartz', 'silver', 20, 'This bracelet is super glamorous. The clear quartz is polished to look like diamonds, at fraction of the price! Plus, clear quartz has incredible healing properties. It is said to amplify any positive energy, increase concentration, and even boost the immune system.', '2021-12-08 18:53:33'),
('1111111128', 'Mountain Charm Bracelet', 18.50, 'bracelet', 'opal', 'rose gold', 20, 'The mountain charm bracelet symbolizes the great outdoors. Perfect for anyone who loves nature! The opal and rose gold glisten beautifully together to create the effect of a sunrise over a snowy peak.', '2021-12-08 18:55:43'),
('1111111129', 'Raw Gemstone Ring', 8.70, 'ring', 'rose quartz', 'rose gold', 20, 'This ring features a minimal, thin band with an unpolished piece of rose quartz. It is perfect for someone who believes in the healing powers of crystals, since the untouched quartz still possesses its natural energy.', '2021-12-08 19:08:27'),
('1111111130', 'Pave Ring', 8.00, 'ring', 'clear quartz', 'gold', 20, 'A simple ring with tiny gemstones all around the perimeter. Very glamorous, yet delicate.', '2021-12-08 19:10:00'),
('1111111131', 'Sun Ring', 12.30, 'ring', 'clear quartz', 'gold', 20, 'This ring has a small sun shape on the front, with a crystal in the middle. Not too over-the-top, and perfect for anyone who loves the summer.', '2021-12-08 19:11:21'),
('1111111132', 'Triple Ring Stack', 17.00, 'ring', 'aquamarine', 'silver', 20, 'This is a set of three tiny rings, each with a slightly different arrangement of miniscule crystals. The stacked look is very trendy now!', '2021-12-08 19:12:50'),
('1111111133', 'Cosmos Ring Stack', 18.00, 'ring', 'amethyst', 'silver', 20, 'This stack features five, yes five! rings. One has a crescent moon, another has a star, the third has tiny gemstones all around, and the other two are textured bands. This is an incredible set!', '2021-12-08 19:17:02'),
('1111111134', 'Wave Ring', 14.00, 'ring', 'opal', 'silver', 20, 'This wave-shaped ring is perfect for anyone who misses the beach. Very simple, shaped as a wave, with a few mismatched crystals to give it that carefree look.', '2021-12-08 19:19:16'),
('1111111135', 'Raw Gemstone Bobby Pin Set', 10.00, 'hair', 'rose quartz', 'rose gold', 20, 'These bobby pins are not meant to be hidden! Each one has a unique, natural-cut gemstone at the end. The rose-gold is pretty with any hair color, too.', '2021-12-08 19:20:44'),
('1111111136', 'Triple Moonstone Hair Clip', 12.00, 'hair', 'moonstone', 'rose gold', 20, 'This hair clip features three moonstones, each of a different size.', '2021-12-08 19:22:22'),
('1111111137', 'Sun Charm Bobby Pin Set', 10.00, 'hair', 'clear quartz', 'gold', 20, 'Each bobby pin in this set of five has a sun charm with a crystal in the center. Perfect for anyone missing summer.', '2021-12-08 19:24:04'),
('1111111138', 'Rose Quartz Hair Flowers', 18.00, 'hair', 'rose quartz', 'silver', 20, 'Are you going to a prom, a wedding, or another glamorous event? These are perfect to decorate your hairstyle. Each flower is small but shimmery, and spins into your hair. Recommended to use with an updo or braided style.', '2021-12-08 19:26:04'),
('1111111139', 'Pave Bobby Pin', 7.50, 'hair', 'clear quartz', 'gold', 20, 'This sparkly bobby pin is meant to be seen! It is made of a beautiful gold metal with shimmery crystals going down the length of it.', '2021-12-10 09:59:20'),
('1111111140', 'Wave Hair Clip', 12.50, 'hair', 'aquamarine', 'silver', 20, 'This hair clip is in a cute, minimal wave shape, with little crystals all throughout.', '2021-12-10 10:00:33'),
('1111111141', 'Threader Earring With Natural Stone', 15.00, 'earring', 'opal', 'rose gold', 20, 'Threader earrings are so elegant, and customizable! If you have multiple piercings, try threading the earrings through several of them. This particular one features a delicate chain with a natural-cut opal on the end.', '2021-12-10 11:03:50'),
('1111111142', 'Pave Bangle', 16.00, 'bracelet', 'clear quartz', 'gold', 20, 'This is a hard bangle bracelet, with delicate crystals all around the gold base.', '2021-12-10 11:05:01');

-- --------------------------------------------------------

--
-- Table structure for table `ORDERS`
--

CREATE TABLE `ORDERS` (
  `OrderID` char(10) NOT NULL,
  `OrderStatus` varchar(20) NOT NULL,
  `OrderTimeStamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ShipFName` varchar(15) NOT NULL,
  `ShipLName` varchar(15) NOT NULL,
  `ShipAddrStreet` varchar(20) NOT NULL,
  `ShipAddrCity` varchar(20) NOT NULL,
  `ShipAddrState` char(2) NOT NULL,
  `ShipAddrZip` char(5) NOT NULL,
  `Customer` varchar(30) NOT NULL,
  `Employee` char(5) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ORDERS`
--

INSERT INTO `ORDERS` (`OrderID`, `OrderStatus`, `OrderTimeStamp`, `ShipFName`, `ShipLName`, `ShipAddrStreet`, `ShipAddrCity`, `ShipAddrState`, `ShipAddrZip`, `Customer`, `Employee`) VALUES
('1111111113', 'shipped', '2021-12-07 14:36:50', 'Elle', 'Woods', '3 Palm Tree Lane', 'Malibu', 'CA', '40510', 'ellewoods@gmail.com', '11112'),
('1111111112', 'processing', '2021-12-07 14:35:06', 'Elle', 'Woods', '3 Palm Tree Lane', 'Malibu', 'CA', '40510', 'ellewoods@gmail.com', NULL),
('1111111111', 'shipped', '2021-12-07 01:49:45', 'Elle', 'Woods', '3 Palm Tree Lane', 'Malibu', 'CA', '40510', 'ellewoods@gmail.com', '11111'),
('1111111114', 'processing', '2021-12-07 15:47:10', 'Sharpay', 'Evans', '4 Wildcat Ave', 'Albuquerque', 'NM', '74385', 'sharpay@gmail.com', NULL),
('1111111115', 'processing', '2021-12-07 15:47:31', 'Sharpay', 'Evans', '4 Wildcat Ave', 'Albuquerque', 'NM', '74385', 'sharpay@gmail.com', '11111'),
('1111111116', 'processing', '2021-12-07 15:51:56', 'Elle', 'Woods', '3 Palm Tree Lane', 'Malibu', 'CA', '40510', 'ellewoods@gmail.com', NULL),
('1111111117', 'delivered', '2021-12-09 02:49:14', 'Drew', 'Sabo', '123 House Street', 'City', 'NJ', '12345', 'xsaboxtagex86@gmail.com', '11111'),
('1111111118', 'shipped', '2021-12-09 15:50:23', 'Sharpay', 'Evans', '4 Wildcat Ave', 'Albuquerque', 'NM', '74385', 'sharpay@gmail.com', '11111'),
('1111111119', 'delivered', '2021-12-16 17:45:45', 'Marina', 'Saburova', '1 Normal Ave', 'Montclair', 'NJ', '07043', 'sharpay@gmail.com', '11111');

-- --------------------------------------------------------

--
-- Table structure for table `ORDER_ITEMS`
--

CREATE TABLE `ORDER_ITEMS` (
  `OrderID` char(10) NOT NULL,
  `ItemID` char(10) NOT NULL,
  `Quantity` int(3) NOT NULL,
  `OrderPrice` decimal(5,2) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ORDER_ITEMS`
--

INSERT INTO `ORDER_ITEMS` (`OrderID`, `ItemID`, `Quantity`, `OrderPrice`) VALUES
('1111111119', '1111111115', 1, 14.00),
('1111111119', '1111111113', 3, 20.00),
('1111111119', '1111111119', 2, 24.00),
('1111111118', '1111111125', 2, 16.00),
('1111111118', '1111111123', 1, 20.00),
('1111111118', '1111111111', 1, 18.00),
('1111111117', '1111111120', 17, 16.00),
('1111111116', '1111111120', 3, 16.00),
('1111111116', '1111111116', 20, 8.00),
('1111111115', '1111111121', 1, 12.00),
('1111111114', '1111111114', 1, 16.00),
('1111111114', '1111111119', 1, 24.00),
('1111111114', '1111111117', 1, 22.00),
('1111111113', '1111111115', 1, 14.00),
('1111111112', '1111111121', 1, 12.00),
('1111111112', '1111111118', 4, 18.00),
('1111111112', '1111111113', 1, 20.00),
('1111111111', '1111111122', 2, 14.00),
('1111111111', '1111111119', 1, 24.00),
('1111111111', '1111111113', 1, 20.00),
('1111111111', '1111111111', 2, 18.00);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `CUSTOMER`
--
ALTER TABLE `CUSTOMER`
  ADD PRIMARY KEY (`CEmail`);

--
-- Indexes for table `EMPLOYEE`
--
ALTER TABLE `EMPLOYEE`
  ADD PRIMARY KEY (`EmpID`),
  ADD UNIQUE KEY `EmpEmail` (`EmpEmail`);

--
-- Indexes for table `ITEM`
--
ALTER TABLE `ITEM`
  ADD PRIMARY KEY (`ItemID`);

--
-- Indexes for table `ORDERS`
--
ALTER TABLE `ORDERS`
  ADD PRIMARY KEY (`OrderID`);

--
-- Indexes for table `ORDER_ITEMS`
--
ALTER TABLE `ORDER_ITEMS`
  ADD PRIMARY KEY (`OrderID`,`ItemID`),
  ADD KEY `ItemID` (`ItemID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
