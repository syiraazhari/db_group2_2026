-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jun 16, 2026 at 10:38 AM
-- Server version: 8.2.0
-- PHP Version: 8.3.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fruit_grocery_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `AdminID` int NOT NULL,
  `Username` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `Password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`AdminID`, `Username`, `Password`) VALUES
(1, 'admin1', '123456'),
(2, 'admin2', '123456'),
(3, 'admin3', '123456'),
(4, 'admin4', '123456'),
(5, 'admin5', '123456');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `CartID` int NOT NULL,
  `CustomerID` int NOT NULL,
  `ProductID` int NOT NULL,
  `Quantity` int NOT NULL,
  `AddedDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`CartID`, `CustomerID`, `ProductID`, `Quantity`, `AddedDate`) VALUES
(1, 1, 1, 2, '2026-06-10 00:00:00'),
(2, 1, 3, 1, '2026-06-10 00:00:00'),
(3, 2, 5, 1, '2026-06-10 00:00:00'),
(4, 2, 6, 2, '2026-06-13 00:00:00'),
(5, 5, 5, 3, '2026-06-13 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `CategoryID` int NOT NULL,
  `CategoryName` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `CategoryDescription` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`CategoryID`, `CategoryName`, `CategoryDescription`) VALUES
(1, 'Citrus', 'Citrus fruits'),
(2, 'Tropical', 'Tropical fruits'),
(3, 'Berries', 'Berry fruits'),
(4, 'Melons', 'Melon Fruits'),
(5, 'Exotic', 'Exotic Fruits');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `CustomerID` int NOT NULL,
  `CustomerName` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `Email` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `PhoneNo` varchar(15) COLLATE utf8mb4_general_ci NOT NULL,
  `Address` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `Username` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `Password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `AccountStatus` varchar(20) COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'Active',
  `RegistrationDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`CustomerID`, `CustomerName`, `Email`, `PhoneNo`, `Address`, `Username`, `Password`, `AccountStatus`, `RegistrationDate`) VALUES
(1, 'John Tan', 'john@gmail.com', '0123456789', 'Kuala Lumpur', 'john', '123456', 'Active', '2026-06-10'),
(2, 'Ali Ahmad', 'ali@gmail.com', '0132223333', 'Selangor', 'ali', '123456', 'Active', '2026-06-10'),
(3, 'Siti Aminah', 'siti@gmail.com', '0145556666', 'Penang', 'siti', '123456', 'Active', '2026-06-10'),
(5, 'Phua Chu Kang', 'phua@gmail.com', '0198765432', 'Johor', 'phuachukang', '123456', 'Active', '2026-06-10'),
(6, 'John Smith', 'johnsmith@gmail.com', '0124682468', 'Johor', 'johnsmith', '123456', 'Active', '2026-06-11');

-- --------------------------------------------------------

--
-- Table structure for table `manager`
--

CREATE TABLE `manager` (
  `ManagerID` int NOT NULL,
  `ManagerName` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `Email` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `Username` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `Password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `manager`
--

INSERT INTO `manager` (`ManagerID`, `ManagerName`, `Email`, `Username`, `Password`) VALUES
(1, 'Manager Ahmad', 'manager1@gmail.com', 'manager1', '123456'),
(2, 'Manager Jason', 'manager2@gmail.com', 'manager2', '123456'),
(3, 'Manager Alice', 'manager3@gmail.com', 'manager3', '123456'),
(4, 'Manager Ben', 'manager4@gmail.com', 'manager4', '123456'),
(5, 'Manager Tom', 'manager5@gmail.com', 'manager5', '123456');

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `OrderID` int NOT NULL,
  `CustomerID` int NOT NULL,
  `OrderDate` datetime NOT NULL,
  `TotalAmount` decimal(10,2) NOT NULL,
  `DeliveryAddress` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `OrderStatus` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `PaymentMethod` varchar(30) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`OrderID`, `CustomerID`, `OrderDate`, `TotalAmount`, `DeliveryAddress`, `OrderStatus`, `PaymentMethod`) VALUES
(1, 1, '2026-06-10 00:00:00', 15.90, 'Kuala Lumpur', 'Completed', 'Online Banking'),
(2, 2, '2026-06-10 00:00:00', 12.50, 'Selangor', 'Pending', 'Credit Card'),
(3, 3, '2026-06-13 00:00:00', 26.50, 'Perak', 'Delivered', 'Credit Card'),
(4, 6, '2026-06-13 00:00:00', 33.20, 'Selangor', 'Pending', 'e-Wallet'),
(5, 5, '2026-06-13 00:00:00', 36.70, 'Johor', 'Delivered', 'Online Banking');

-- --------------------------------------------------------

--
-- Table structure for table `order_item`
--

CREATE TABLE `order_item` (
  `OrderItemID` int NOT NULL,
  `OrderID` int NOT NULL,
  `ProductID` int NOT NULL,
  `Quantity` int NOT NULL,
  `UnitPrice` decimal(8,2) NOT NULL,
  `Subtotal` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_item`
--

INSERT INTO `order_item` (`OrderItemID`, `OrderID`, `ProductID`, `Quantity`, `UnitPrice`, `Subtotal`) VALUES
(1, 1, 1, 2, 3.50, 7.00),
(2, 1, 3, 1, 8.90, 8.90),
(3, 2, 5, 1, 12.50, 12.50),
(6, 2, 6, 2, 4.00, 8.00),
(7, 5, 5, 3, 12.50, 37.50);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `ProductID` int NOT NULL,
  `CategoryID` int NOT NULL,
  `ProductName` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `Description` text COLLATE utf8mb4_general_ci,
  `Price` decimal(8,2) NOT NULL,
  `StockQuantity` int NOT NULL DEFAULT '0',
  `ImageFilename` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `DateAdded` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`ProductID`, `CategoryID`, `ProductName`, `Description`, `Price`, `StockQuantity`, `ImageFilename`, `DateAdded`) VALUES
(1, 1, 'Orange', 'Fresh sweet orange', 3.50, 100, 'orange.jpg', '2026-06-10'),
(2, 1, 'Lemon', 'Sour lemon', 2.50, 80, 'lemon.jpg', '2026-06-10'),
(3, 2, 'Mango', 'Sweet mango', 8.90, 80, 'mango.jpg', '2026-06-10'),
(5, 3, 'Strawberry', 'Fresh strawberry', 12.50, 30, 'strawberry.jpg', '2026-06-10'),
(6, 1, 'Orange', 'Fresh sweet orange', 4.00, 80, 'orange.jpg', '2026-06-10');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`AdminID`),
  ADD UNIQUE KEY `Username` (`Username`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`CartID`),
  ADD KEY `CustomerID` (`CustomerID`),
  ADD KEY `ProductID` (`ProductID`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`CategoryID`),
  ADD UNIQUE KEY `CategoryName` (`CategoryName`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`CustomerID`),
  ADD UNIQUE KEY `Email` (`Email`),
  ADD UNIQUE KEY `Username` (`Username`);

--
-- Indexes for table `manager`
--
ALTER TABLE `manager`
  ADD PRIMARY KEY (`ManagerID`),
  ADD UNIQUE KEY `Email` (`Email`),
  ADD UNIQUE KEY `Username` (`Username`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`OrderID`),
  ADD KEY `CustomerID` (`CustomerID`);

--
-- Indexes for table `order_item`
--
ALTER TABLE `order_item`
  ADD PRIMARY KEY (`OrderItemID`),
  ADD KEY `OrderID` (`OrderID`),
  ADD KEY `ProductID` (`ProductID`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`ProductID`),
  ADD KEY `CategoryID` (`CategoryID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `AdminID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `CartID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `CategoryID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `CustomerID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `manager`
--
ALTER TABLE `manager`
  MODIFY `ManagerID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `OrderID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `order_item`
--
ALTER TABLE `order_item`
  MODIFY `OrderItemID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `ProductID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`CustomerID`) REFERENCES `customer` (`CustomerID`) ON DELETE CASCADE,
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`ProductID`) REFERENCES `product` (`ProductID`) ON DELETE CASCADE;

--
-- Constraints for table `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `order_ibfk_1` FOREIGN KEY (`CustomerID`) REFERENCES `customer` (`CustomerID`);

--
-- Constraints for table `order_item`
--
ALTER TABLE `order_item`
  ADD CONSTRAINT `order_item_ibfk_1` FOREIGN KEY (`OrderID`) REFERENCES `order` (`OrderID`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_item_ibfk_2` FOREIGN KEY (`ProductID`) REFERENCES `product` (`ProductID`);

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`CategoryID`) REFERENCES `category` (`CategoryID`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
