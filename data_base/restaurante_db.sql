-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 09, 2022 at 04:56 PM
-- Server version: 8.0.29-0ubuntu0.20.04.3
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `restaurante_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `cardapio`
--

CREATE TABLE `cardapio` (
  `id` int NOT NULL,
  `nomePrato` varchar(255) NOT NULL,
  `preco` float NOT NULL,
  `tempoPreparo` int NOT NULL,
  `ingredientes` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `cardapio`
--

INSERT INTO `cardapio` (`id`, `nomePrato`, `preco`, `tempoPreparo`, `ingredientes`) VALUES
(2, 'prato2', 2, 3, 'ing'),
(3, 'prato3', 4, 5, 'ing'),
(4, 'prato4', 5, 6, 'ing'),
(5, 'prato5', 6, 7, 'ing'),
(6, 'Caipirinha', 11, 2, 'limão, açúcar, gelo, 51'),
(7, 'bebida2', 2, 5, 'in'),
(8, 'bebida3', 6, 6, 'in'),
(9, 'bebida4', 4, 6, 'in');

-- --------------------------------------------------------

--
-- Table structure for table `pedidos`
--

CREATE TABLE `pedidos` (
  `id` int NOT NULL,
  `idMesa` int NOT NULL,
  `pedido` varchar(255) NOT NULL,
  `obs` varchar(255) NOT NULL,
  `nomeCliente` varchar(255) NOT NULL,
  `estado` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `pedidos`
--

INSERT INTO `pedidos` (`id`, `idMesa`, `pedido`, `obs`, `nomeCliente`, `estado`) VALUES
(1, 2, '2 - bebida;2 - bebida2;2 - bebida3;', 'Sem bacon no x bacon', 'Carlos', 1),
(2, 5, '1 - bebida4;1 - bebida;', 'sem ovo no omelete', 'Roberto', 1),
(3, 1, '1 - bebida;', 'Sem água na água com gás', 'Diego', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cardapio`
--
ALTER TABLE `cardapio`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cardapio`
--
ALTER TABLE `cardapio`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
