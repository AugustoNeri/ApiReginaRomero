-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 20-06-2022 a las 09:42:52
-- Versión del servidor: 10.4.19-MariaDB
-- Versión de PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `datarr`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `llegadas`
--

CREATE TABLE `llegadas` (
  `codigo_pedido` varchar(100) NOT NULL,
  `status` varchar(50) NOT NULL,
  `t22` int(11) NOT NULL,
  `t225` int(11) NOT NULL,
  `t23` int(11) NOT NULL,
  `t235` int(11) NOT NULL,
  `t24` int(11) NOT NULL,
  `t245` int(11) NOT NULL,
  `t25` int(11) NOT NULL,
  `t255` int(11) NOT NULL,
  `t26` int(11) NOT NULL,
  `t265` int(11) NOT NULL,
  `t27` int(11) NOT NULL,
  `t275` int(11) NOT NULL,
  `t28` int(11) NOT NULL,
  `t285` int(11) NOT NULL,
  `fechallegada` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `llegadas`
--

INSERT INTO `llegadas` (`codigo_pedido`, `status`, `t22`, `t225`, `t23`, `t235`, `t24`, `t245`, `t25`, `t255`, `t26`, `t265`, `t27`, `t275`, `t28`, `t285`, `fechallegada`) VALUES
('GOT_MAR22-066-A_1980_ALMENDRA', 'DE ESPERA EN LLEGADA', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '0000-00-00'),
('GOT_MAR22-066-A_1980_NEGRO', 'DE ESPERA EN LLEGADA', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '0000-00-00'),
('GOT_MAR22-066-A_1980_VINO', 'DE ESPERA EN LLEGADA', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '0000-00-00'),
('GOT_ABR22-094-A_1980_ALMENDRA', 'DE ESPERA EN LLEGADA', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '0000-00-00'),
('GOT_ABR22-094-A_1980_NEGRO', 'DE ESPERA EN LLEGADA', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '0000-00-00'),
('GOT_ABR22-094-A_1980_VINO', 'DE ESPERA EN LLEGADA', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '0000-00-00'),
('GOT_ABR22-094-A_1980_ALMENDRA', 'DE ESPERA EN LLEGADA', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '0000-00-00'),
('GOT_ABR22-094-A_1980_NEGRO', 'DE ESPERA EN LLEGADA', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '0000-00-00'),
('GOT_ABR22-094-A_1980_VINO', 'DE ESPERA EN LLEGADA', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '0000-00-00'),
('GOT_DIC21-229-A_1990_NEGRO', 'DE ESPERA EN LLEGADA', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '0000-00-00'),
('GOT_DIC21-229-A_1990_LIZARD CREMA', 'ENTREGADO', 1, 1, 3, 3, 4, 3, 3, 2, 1, 1, 1, 0, 0, 0, '2022-05-17'),
('GOT_DIC21-229-A_1990_LIZARD SADDLE', 'DE ESPERA EN LLEGADA', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '0000-00-00'),
('GOT_DIC21-229-A_1990_LIZARD HENNA', 'DE ESPERA EN LLEGADA', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '0000-00-00'),
('GOT_MAR22-071-A_1990_NEGRO', 'DE ESPERA EN LLEGADA', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '0000-00-00'),
('GOT_MAR22-071-A_1990_LIZARD CREMA', 'DE ESPERA EN LLEGADA', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '0000-00-00'),
('GOT_MAR22-071-A_1990_LIZARD SADDLE', 'DE ESPERA EN LLEGADA', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '0000-00-00'),
('GOT_MAR22-071-A_1990_LIZARD HENNA', 'DE ESPERA EN LLEGADA', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '0000-00-00'),
('GOT_ABR22-089-A_1990_NEGRO', 'DE ESPERA EN LLEGADA', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '0000-00-00'),
('GOT_ABR22-089-A_1990_LIZARD CREMA', 'DE ESPERA EN LLEGADA', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '0000-00-00'),
('GOT_ABR22-089-A_1990_LIZARD SADDLE', 'DE ESPERA EN LLEGADA', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '0000-00-00'),
('GOT_ABR22-089-A_1990_LIZARD HENNA', 'DE ESPERA EN LLEGADA', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '0000-00-00'),
('GOT_ENE22-009-A_ALEXA_NEGRO Y ORO', 'ENTREGADO', 2, 2, 6, 6, 10, 6, 7, 3, 3, 2, 1, 0, 0, 0, '2022-01-29'),
('GOT_ENE22-009-A_ALEXA_UVA', 'ENTREGADO', 2, 2, 6, 6, 10, 6, 7, 3, 3, 2, 1, 0, 0, 0, '2022-01-25'),
('GOT_FEB22-017-A_ALEXA_YOGURT', 'ENTREGADO', 1, 1, 5, 5, 7, 7, 4, 4, 1, 0, 1, 0, 0, 0, '2022-01-26'),
('GOT_MAR22-046-A_ALEXA_BUVARD', 'DE ESPERA EN LLEGADA', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '0000-00-00'),
('GOT_MAR22-046-A_ALEXA_NEGRO', 'PARCIAL', 0, 0, 0, 0, 4, 4, 0, 0, 0, 0, 0, 0, 0, 0, '2022-03-29'),
('GOT_MAR22-046-A_ALEXA_ROJO', 'DE ESPERA EN LLEGADA', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '0000-00-00'),
('GOT_ABR22-098-A_ALEXA_NEGRO', 'DE ESPERA EN LLEGADA', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '0000-00-00'),
('GOT_ABR22-098-A_ALEXA_BUVARD', 'DE ESPERA EN LLEGADA', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '0000-00-00'),
('GOT_ABR22-098-A_ALEXA_ROJO', 'DE ESPERA EN LLEGADA', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '0000-00-00'),
('GOT_ABR22-098-A_ALEXA_YOGURT', 'DE ESPERA EN LLEGADA', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '0000-00-00'),
('GOT_ABR22-098-A_ALEXA_NEGRO Y ORO', 'DE ESPERA EN LLEGADA', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '0000-00-00'),
('GOT_MAY22-123-A_ALEXA_NEGRO', 'ENTREGADO', 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2022-05-05'),
('GOT_MAY22-123-A_ALEXA_BUVARD', 'DE ESPERA EN LLEGADA', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '0000-00-00'),
('GOT_MAY22-123-A_ALEXA_ROJO', 'ENTREGADO', 2, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2022-05-05'),
('GOT_MAY22-123-A_ALEXA_YOGURT', 'DE ESPERA EN LLEGADA', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '0000-00-00'),
('GOT_MAY22-123-A_ALEXA_PLATA', 'ENTREGADO', 1, 1, 2, 2, 3, 2, 3, 1, 1, 1, 1, 0, 0, 0, '2022-04-11'),
('GOT_MAY22-123-A_ALEXA_ORO', 'PARCIAL', 1, 1, 1, 1, 1, 2, 2, 1, 1, 1, 1, 0, 0, 0, '2022-04-11'),
('GOT_MAY22-123-A_ALEXA_ROSA', 'ENTREGADO', 1, 2, 2, 2, 3, 2, 4, 1, 1, 1, 0, 0, 0, 0, '2022-04-11'),
('GOT_MAY22-123-A_ALEXA_AZUL', 'DE ESPERA EN LLEGADA', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '0000-00-00'),
('GOT_MAY22-123-A_ALEXA_NEGRO Y ORO', 'DE ESPERA EN LLEGADA', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '0000-00-00'),
('RIG_ENE22-007-A_ALICE_NEGRO', 'ENTREGADO', 1, 1, 3, 3, 5, 4, 5, 2, 3, 2, 1, 0, 0, 0, '2022-02-23'),
('RIG_ENE22-007-A_ALICE_MIX ROSE', 'ENTREGADO', 0, 0, 2, 3, 5, 4, 4, 3, 4, 0, 0, 0, 0, 0, '2022-03-07'),
('RIG_ENE22-007-A_ALICE_NEGRO Y COBRA METALICO', 'ENTREGADO', 1, 1, 3, 4, 4, 4, 5, 2, 3, 2, 1, 0, 0, 0, '2022-03-07'),
('RIG_MAY22-064-A_ALICE_NEGRO', 'ENTREGADO', 1, 1, 3, 3, 5, 4, 5, 2, 3, 2, 1, 0, 0, 0, '2022-04-04'),
('RIG_MAY22-064-A_ALICE_MIX ROSE', 'ENTREGADO', 0, 0, 3, 4, 6, 4, 5, 4, 2, 2, 0, 0, 0, 0, '2022-03-31'),
('RIG_MAY22-064-A_ALICE_NEGRO Y COBRA METALICO', 'PARCIAL', 1, 1, 3, 3, 5, 4, 4, 2, 2, 2, 1, 0, 0, 0, '2022-04-09'),
('GOT_ABR22-001-A_ANETTE_TAN', 'DE ESPERA EN LLEGADA', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '0000-00-00'),
('GOT_ABR22-001-A_ANETTE_ROJO', 'DE ESPERA EN LLEGADA', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '0000-00-00'),
('GOT_ABR22-001-A_ANETTE_NEGRO', 'DE ESPERA EN LLEGADA', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '0000-00-00'),
('GOT_ABR22-001-A_ANETTE_BLANCO', 'DE ESPERA EN LLEGADA', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '0000-00-00'),
('GOT_ABR22-001-A_ANETTE_SEDA', 'DE ESPERA EN LLEGADA', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '0000-00-00'),
('GOT_ABR22-142-A_BAILEY ED LIM_CAFE', 'DE ESPERA EN LLEGADA', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '0000-00-00'),
('GOT_ABR22-142-A_BAILEY ED LIM_NEGRO', 'DE ESPERA EN LLEGADA', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '0000-00-00'),
('GOT_ABR22-142-A_BAILEY ED LIM_ORO', 'DE ESPERA EN LLEGADA', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '0000-00-00'),
('GOT_ABR22-142-A_BAILEY ED LIM_VINO', 'DE ESPERA EN LLEGADA', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '0000-00-00'),
('GOT_ABR22-142-A_BAILEY ED LIM_OLIVO', 'DE ESPERA EN LLEGADA', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '0000-00-00'),
('GOT_ABR22-142-A_BAILEY ED LIM_ARENA MADERA', 'DE ESPERA EN LLEGADA', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '0000-00-00'),
('GOT_MAY22-122-A_CALIPSO_ROSA', 'DE ESPERA EN LLEGADA', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '0000-00-00'),
('GOT_MAY22-122-A_CALIPSO_MANDARINA', 'DE ESPERA EN LLEGADA', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '0000-00-00'),
('GOT_MAY22-122-A_CALIPSO_UVA', 'DE ESPERA EN LLEGADA', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '0000-00-00'),
('GOT_MAY22-122-A_CALIPSO_ROSA', 'DE ESPERA EN LLEGADA', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '0000-00-00'),
('GOT_MAY22-122-A_CALIPSO_MANDARINA', 'DE ESPERA EN LLEGADA', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '0000-00-00'),
('GOT_MAY22-122-A_CALIPSO_UVA', 'DE ESPERA EN LLEGADA', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '0000-00-00'),
('RIG_DIC21-189-A_CARINA_INOX', 'DE ESPERA EN LLEGADA', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '0000-00-00'),
('RIG_NOV21-172-A_CARINA_BEIGE', 'DE ESPERA EN LLEGADA', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '0000-00-00'),
('RIG_NOV22-172-A_CARINA_INOX NEGRO', 'PARCIAL', 0, 0, 4, 4, 6, 5, 9, 5, 4, 0, 0, 0, 0, 0, '2022-01-07'),
('RIG_NOV22-172-A_CARINA_MARINO', 'PARCIAL', 0, 0, 1, 2, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, '2022-02-23'),
('RIG_MAR22-020-A_CARINA_BEIGE', 'PARCIAL', 0, 0, 0, 0, 0, 2, 0, 0, 0, 0, 0, 0, 0, 0, '2022-02-23'),
('RIG_MAR22-020-A_CARINA_INOX NEGRO', 'PARCIAL', 0, 0, 0, 0, 2, 1, 0, 2, 0, 0, 0, 0, 0, 0, '2022-03-22'),
('RIG_MAR22-020-A_CARINA_MARINO', 'ENTREGADO', 0, 0, 1, 4, 2, 6, 1, 0, 0, 0, 0, 0, 0, 0, '2022-03-31'),
('RIG_ABR22-044-A_CARINA_BEIGE', 'PARCIAL', 0, 0, 1, 3, 4, 3, 4, 1, 2, 0, 0, 0, 0, 0, '2022-03-23'),
('RIG_ABR22-044-A_CARINA_INOX NEGRO', 'ENTREGADO', 0, 0, 4, 5, 8, 6, 8, 5, 4, 3, 1, 0, 0, 0, '2022-03-23'),
('RIG_ABR22-044-A_CARINA_MARINO', 'PARCIAL', 0, 1, 4, 4, 3, 7, 4, 2, 2, 0, 0, 0, 0, 0, '2022-04-04'),
('RIG_ENE22-006-A_CAROLA_MIX ROSE', 'PARCIAL', 0, 0, 0, 0, 0, 0, 0, 0, 3, 3, 0, 0, 0, 0, '2022-01-27'),
('RIG_ENE22-006-A_CAROLA_TERRACOTA Y NEGRO', 'PARCIAL', 0, 0, 2, 5, 10, 7, 8, 6, 5, 4, 0, 0, 0, 0, '2022-01-24'),
('RIG_MAR22-026-A_CAROLA_MIX ROSE', 'DE ESPERA EN LLEGADA', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '0000-00-00'),
('RIG_MAR22-026-A_CAROLA_TERRACOTA Y NEGRO', 'DE ESPERA EN LLEGADA', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '0000-00-00'),
('RIG_MAR22-026-A_CAROLA_MIX ROSE', 'DE ESPERA EN LLEGADA', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '0000-00-00'),
('RIG_MAR22-026-A_CAROLA_TERRACOTA Y NEGRO', 'DE ESPERA EN LLEGADA', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '0000-00-00'),
('RIG_FEB22-015-A_CARSON_NEGRO', 'PARCIAL', 1, 1, 4, 5, 7, 6, 6, 5, 3, 2, 1, 0, 0, 0, '2022-03-22'),
('RIG_FEB22-015-A_CARSON_MIX ROSE', 'PARCIAL', 1, 1, 3, 4, 6, 5, 6, 5, 3, 2, 1, 0, 0, 0, '2022-02-11'),
('RIG_MAR22-027-A_CARSON_NEGRO', 'DE ESPERA EN LLEGADA', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '0000-00-00'),
('RIG_MAR22-027-A_CARSON_MIX ROSE', 'DE ESPERA EN LLEGADA', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '0000-00-00'),
('RIG_FEB22-014-A_CINDY_ROJO', 'PARCIAL', 1, 1, 5, 6, 9, 6, 8, 5, 6, 2, 2, 0, 0, 0, '2022-03-02'),
('RIG_FEB22-014-A_CINDY_MANDARINA', 'PARCIAL', 1, 1, 5, 6, 9, 6, 7, 8, 4, 1, 0, 0, 0, 0, '2022-02-19'),
('RIG_FEB22-014-A_CINDY_AZUL', 'PARCIAL', 1, 1, 4, 5, 8, 6, 8, 3, 3, 2, 2, 0, 0, 0, '2022-02-11'),
('GOT_FEB22-019-A_CLAUDINE 85_LIZARD CREMA', 'ENTREGADO', 1, 1, 2, 2, 5, 3, 4, 2, 2, 1, 1, 0, 0, 0, '2022-01-21'),
('GOT_FEB22-042-A_CLAUDINE 85_LIZARD STONE', 'DE ESPERA EN LLEGADA', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '0000-00-00'),
('GOT_FEB22-042-A_CLAUDINE 85_LIZARD HENNA', 'DE ESPERA EN LLEGADA', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '0000-00-00'),
('GOT_FEB22-042-A_CLAUDINE 85_LIZARD GRIS', 'DE ESPERA EN LLEGADA', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '0000-00-00'),
('RIG_FEB22-013-A_CONSTANZA_NEGRO', 'ENTREGADO', 1, 1, 3, 4, 7, 5, 5, 4, 3, 2, 1, 0, 0, 0, '2022-02-01'),
('RIG_FEB22-013-A_CONSTANZA_TAN / SHEDRON', 'PARCIAL', 1, 1, 3, 4, 8, 5, 3, 4, 3, 2, 1, 0, 0, 0, '2022-02-03'),
('RIG_MAR22-019-A_CONY_CAFE', 'PARCIAL', 0, 0, 2, 1, 0, 4, 0, 3, 0, 1, 1, 0, 0, 0, '2022-02-19'),
('RIG_MAR22-019-A_CONY_NEGRO', 'ENTREGADO', 0, 0, 2, 2, 5, 5, 0, 4, 0, 2, 1, 0, 0, 0, '2022-02-09'),
('RIG_ABR22-038-A_CONY_NEGRO', 'ENTREGADO', 1, 1, 3, 6, 8, 8, 3, 4, 1, 1, 0, 0, 0, 0, '2022-04-04'),
('RIG_JUN22-089-A_CONY_CAFE', 'DE ESPERA EN LLEGADA', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '0000-00-00'),
('RIG_JUN22-089-A_CONY_NEGRO', 'DE ESPERA EN LLEGADA', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '0000-00-00'),
('RIG_NOV21-182-A_DANNA_NEGRO Y CHAI', 'PARCIAL', 1, 1, 4, 5, 8, 10, 14, 10, 5, 1, 1, 0, 0, 0, '2022-01-20'),
('RIG_NOV21-182-A_DANNA_MIEL Y PALO DE ROSA', 'ENTREGADO', 1, 2, 7, 7, 15, 7, 11, 7, 6, 1, 1, 0, 0, 0, '2022-01-20'),
('RIG_MAR22-024-A_DANNA_NEGRO Y CHAI', 'PARCIAL', 0, 0, 4, 5, 9, 7, 8, 5, 3, 1, 0, 0, 0, 0, '2022-03-08'),
('RIG_MAR22-024-A_DANNA_MIEL Y PALO DE ROSA', 'PARCIAL', 0, 0, 2, 2, 2, 2, 3, 2, 2, 0, 0, 0, 0, 0, '2022-05-18'),
('RIG_MAR22-022-A_EMMA_BLANCO Y NEGRO', 'ENTREGADO', 1, 1, 4, 1, 3, 5, 3, 0, 0, 0, 0, 0, 0, 0, '2022-02-15'),
('RIG_MAR22-022-A_EMMA_CLASSIC', 'ENTREGADO', 0, 0, 4, 1, 3, 2, 1, 1, 0, 0, 0, 0, 0, 0, '2022-03-07'),
('RIG_MAR22-035-A_EMMA_BLANCO Y NEGRO', 'ENTREGADO', 0, 0, 5, 3, 6, 5, 5, 2, 2, 0, 0, 0, 0, 0, '2022-03-08'),
('RIG_MAR22-035-A_EMMA_CLASSIC', 'ENTREGADO', 0, 0, 4, 2, 5, 3, 3, 2, 1, 0, 0, 0, 0, 0, '2022-03-22'),
('RIV_MAR22-021-A_ERICA_NEGRO', 'DE ESPERA EN LLEGADA', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '0000-00-00'),
('RIV_MAR22-021-A_ERICA_CAFE', 'PARCIAL', 1, 1, 4, 7, 11, 8, 8, 4, 4, 2, 1, 0, 0, 0, '2022-05-06'),
('RIV_ABR22-027-A_ERICA_NEGRO', 'DE ESPERA EN LLEGADA', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '0000-00-00'),
('RIV_ABR22-027-A_ERICA_CAFE', 'ENTREGADO', 0, 0, 3, 4, 7, 5, 6, 4, 3, 0, 0, 0, 0, 0, '2022-05-06'),
('RIV_ENE22-002-A / RIV_NOV21-046-A_GAIA_SNAKE UVA', 'PARCIAL', 1, 1, 1, 1, 0, 1, 1, 1, 1, 1, 0, 0, 0, 0, '2022-03-28'),
('RIV_ENE22-002-A / RIV_NOV21-046-A_GAIA_NEGRO', 'DE ESPERA EN LLEGADA', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '0000-00-00'),
('RIV_ENE22-002-A / RIV_NOV21-046-A_GAIA_MIX ROSE', 'DE ESPERA EN LLEGADA', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '0000-00-00'),
('RIG_NOV21-083-A_GILDA_MIX ROSE', 'DE ESPERA EN LLEGADA', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '0000-00-00'),
('RIG_NOV21-083-A_GILDA_NEGRO Y CHAI', 'DE ESPERA EN LLEGADA', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '0000-00-00'),
('RIG_NOV21-083-A_GILDA_SNAKE UVA', 'DE ESPERA EN LLEGADA', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '0000-00-00'),
('RIG_ABR22-037-A_GILDA_MIX ROSE', 'PARCIAL', 0, 0, 0, 0, 0, 2, 3, 2, 1, 0, 0, 0, 0, 0, '2022-03-23'),
('RIG_ABR22-037-A_GILDA_NEGRO Y CHAI', 'DE ESPERA EN LLEGADA', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '0000-00-00'),
('RIG_ABR22-037-A_GILDA_SNAKE UVA', 'PARCIAL', 1, 1, 4, 4, 6, 5, 4, 3, 1, 0, 0, 0, 0, 0, '2022-03-23'),
('RIG_ABR22-048-A_GILDA_MIX ROSE', 'DE ESPERA EN LLEGADA', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '0000-00-00'),
('RIG_ABR22-048-A_GILDA_NEGRO Y CHAI', 'DE ESPERA EN LLEGADA', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '0000-00-00'),
('RIG_ABR22-048-A_GILDA_SNAKE UVA', 'DE ESPERA EN LLEGADA', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '0000-00-00'),
('GOT_NOV21-216-A_HELENA_ORO PLATA', 'ENTREGADO', 0, 0, 0, 2, 3, 5, 0, 2, 0, 0, 0, 0, 0, 0, '2022-01-24'),
('GOT_NOV21-216-A_HELENA_NEGRO', 'ENTREGADO', 1, 1, 5, 5, 8, 6, 5, 4, 0, 1, 1, 0, 0, 0, '2022-01-24'),
('GOT_MAR22-063-A_HELENA_ORO PLATA', 'DE ESPERA EN LLEGADA', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '0000-00-00'),
('GOT_MAR22-063-A_HELENA_NEGRO', 'ENTREGADO', 0, 1, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, '2022-03-25'),
('GOT_ABR22-085-A_HELENA_ORO PLATA', 'DE ESPERA EN LLEGADA', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '0000-00-00'),
('GOT_ABR22-085-A_HELENA_NEGRO', 'DE ESPERA EN LLEGADA', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '0000-00-00'),
('GOT_NOV22-143-A_JESSIE_TAN', 'DE ESPERA EN LLEGADA', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '0000-00-00'),
('GOT_NOV22-143-A_JESSIE_ROJO', 'DE ESPERA EN LLEGADA', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '0000-00-00'),
('GOT_NOV22-143-A_JESSIE_NEGRO', 'DE ESPERA EN LLEGADA', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '0000-00-00'),
('GOT_MAR22-035-A_JOANA_NEGRO', 'ENTREGADO', 1, 2, 6, 7, 10, 8, 8, 4, 3, 2, 1, 0, 0, 0, '2022-04-05'),
('GOT_MAR22-035-A_JOANA_VERDE LIMON', 'ENTREGADO', 1, 2, 6, 7, 10, 8, 8, 4, 3, 2, 1, 0, 0, 0, '2022-04-11'),
('GOT_ABR22-095-A_JOANA_NEGRO', 'DE ESPERA EN LLEGADA', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '0000-00-00'),
('GOT_ABR22-095-A_JOANA_VERDE LIMON', 'DE ESPERA EN LLEGADA', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '0000-00-00'),
('RIG_NOV21-169-A_JUDY_MARINO', 'DE ESPERA EN LLEGADA', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '0000-00-00'),
('RIG_NOV21-169-A_JUDY_NEGRO', 'DE ESPERA EN LLEGADA', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '0000-00-00'),
('RIG_NOV21-169-A_JUDY_ROJO', 'PARCIAL', 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 1, 0, 1, '2022-01-24'),
('RIG_NOV21-169-A_JUDY_ROSA', 'PARCIAL', 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, '2022-04-18'),
('RIG_NOV21-169-A_JUDY_SNAKE BEIGE', 'DE ESPERA EN LLEGADA', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '0000-00-00'),
('RIG_NOV21-169-A_JUDY_VERDE BOTELLA', 'PARCIAL', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 1, 0, '2022-01-24'),
('RIG_MAR22-028-A	_JUDY_MARINO', 'ENTREGADO', 0, 0, 2, 2, 3, 10, 0, 3, 0, 1, 1, 0, 0, 0, '2022-03-07'),
('RIG_MAR22-028-A	_JUDY_NEGRO', 'PARCIAL', 0, 0, 2, 2, 4, 1, 1, 4, 3, 2, 1, 0, 0, 0, '2022-03-07'),
('RIG_MAR22-028-A	_JUDY_ROJO', 'ENTREGADO', 1, 2, 10, 3, 4, 6, 5, 4, 4, 2, 1, 0, 0, 0, '2022-03-22'),
('RIG_MAR22-028-A	_JUDY_ROSA', 'PARCIAL', 0, 0, 2, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2022-03-07'),
('RIG_MAR22-028-A	_JUDY_SNAKE BEIGE', 'ENTREGADO', 0, 0, 0, 0, 0, 2, 0, 2, 2, 1, 0, 0, 0, 0, '2022-03-07'),
('RIG_MAR22-028-A	_JUDY_AZUL ACERO', 'ENTREGADO', 0, 0, 2, 2, 4, 3, 4, 4, 3, 2, 0, 0, 0, 0, '2022-03-07'),
('RIG_MAR22-028-A	_JUDY_COBRA METALICO', 'ENTREGADO', 0, 0, 1, 1, 4, 4, 1, 3, 0, 0, 0, 0, 0, 0, '2022-03-02'),
('RIG_MAR22-028-A	_JUDY_PALO DE ROSA', 'PARCIAL', 0, 0, 2, 1, 4, 3, 4, 3, 2, 0, 0, 0, 0, 0, '2022-03-24'),
('RIG_ABR22-042-A_JUDY_MARINO', 'ENTREGADO', 0, 0, 1, 3, 4, 4, 4, 3, 2, 2, 1, 0, 0, 0, '2022-03-23'),
('RIG_ABR22-042-A_JUDY_NEGRO', 'ENTREGADO', 0, 1, 8, 3, 9, 7, 9, 6, 2, 0, 1, 0, 0, 0, '2022-04-04'),
('RIG_ABR22-042-A_JUDY_ROJO', 'ENTREGADO', 1, 1, 3, 5, 9, 4, 8, 5, 2, 0, 1, 0, 0, 0, '2022-04-04'),
('RIG_ABR22-042-A_JUDY_ROSA', 'DE ESPERA EN LLEGADA', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '0000-00-00'),
('RIG_ABR22-042-A_JUDY_SNAKE BEIGE', 'PARCIAL', 0, 0, 1, 0, 0, 2, 0, 1, 1, 1, 0, 0, 0, 0, '2022-04-04'),
('RIG_ABR22-042-A_JUDY_AZUL ACERO', 'ENTREGADO', 0, 0, 2, 1, 3, 4, 2, 2, 1, 1, 0, 0, 0, 0, '2022-04-18'),
('RIG_ABR22-042-A_JUDY_COBRA METALICO', 'ENTREGADO', 0, 0, 4, 4, 6, 4, 6, 2, 2, 2, 0, 0, 0, 0, '2022-04-18'),
('RIG_ABR22-042-A_JUDY_PALO DE ROSA', 'PARCIAL', 0, 0, 2, 2, 2, 2, 2, 2, 1, 0, 0, 0, 0, 0, '2022-04-18'),
('RIG_ABR22-047-A_JUDY_MARINO', 'PARCIAL', 0, 0, 0, 1, 1, 3, 3, 1, 0, 0, 0, 0, 0, 0, '2022-04-18'),
('RIG_ABR22-047-A_JUDY_NEGRO', 'DE ESPERA EN LLEGADA', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '0000-00-00'),
('RIG_ABR22-047-A_JUDY_ROJO', 'DE ESPERA EN LLEGADA', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '0000-00-00'),
('RIG_ABR22-047-A_JUDY_SNAKE BEIGE', 'DE ESPERA EN LLEGADA', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '0000-00-00'),
('RIG_ABR22-047-A_JUDY_AZUL ACERO', 'PARCIAL', 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2022-05-06'),
('RIG_ABR22-047-A_JUDY_COBRA METALICO', 'DE ESPERA EN LLEGADA', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '0000-00-00'),
('RIG_ABR22-052-A	_JUDY_COBRA METALICO', 'DE ESPERA EN LLEGADA', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '0000-00-00'),
('RIG_MAY22-069-A_JUDY_MARINO', 'DE ESPERA EN LLEGADA', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '0000-00-00'),
('RIG_MAY22-069-A_JUDY_NEGRO', 'PARCIAL', 0, 3, 4, 3, 6, 3, 4, 3, 3, 0, 2, 0, 0, 0, '2022-04-18'),
('RIG_MAY22-069-A_JUDY_ROJO', 'DE ESPERA EN LLEGADA', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '0000-00-00'),
('RIG_MAY22-069-A_JUDY_ROSA', 'DE ESPERA EN LLEGADA', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '0000-00-00'),
('RIG_MAY22-069-A_JUDY_SNAKE BEIGE', 'ENTREGADO', 0, 3, 1, 8, 5, 4, 4, 4, 6, 2, 2, 0, 0, 0, '2022-04-18'),
('RIG_MAY22-069-A_JUDY_COBRA METALICO', 'DE ESPERA EN LLEGADA', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '0000-00-00'),
('RIG_MAY22-071-A_JUDY_MARINO', 'DE ESPERA EN LLEGADA', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '0000-00-00'),
('RIG_MAY22-071-A_JUDY_NEGRO', 'PARCIAL', 0, 0, 3, 4, 5, 2, 4, 2, 6, 1, 0, 0, 0, 0, '2022-05-06'),
('RIG_MAY22-071-A_JUDY_ROJO', 'DE ESPERA EN LLEGADA', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '0000-00-00'),
('RIG_MAY22-071-A_JUDY_SNAKE BEIGE', 'DE ESPERA EN LLEGADA', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '0000-00-00'),
('RIG_MAY22-071-A_JUDY_COBRA METALICO', 'DE ESPERA EN LLEGADA', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '0000-00-00'),
('RIG_JUN22-081-A_JUDY_MARINO', 'DE ESPERA EN LLEGADA', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '0000-00-00'),
('RIG_JUN22-081-A_JUDY_NEGRO', 'DE ESPERA EN LLEGADA', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '0000-00-00'),
('RIG_JUN22-081-A_JUDY_ROJO', 'DE ESPERA EN LLEGADA', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '0000-00-00'),
('RIG_JUN22-081-A_JUDY_SNAKE BEIGE', 'DE ESPERA EN LLEGADA', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '0000-00-00'),
('RIG_JUN22-081-A_JUDY_COBRA METALICO', 'DE ESPERA EN LLEGADA', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '0000-00-00'),
('RIG_JUN22-081-A_JUDY_PALO DE ROSA', 'DE ESPERA EN LLEGADA', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '0000-00-00'),
('RIG_DIC21-186-A_KENDALL_NEGRO', 'PARCIAL', 0, 0, 11, 8, 10, 12, 17, 9, 8, 2, 0, 0, 0, 0, '2022-02-15'),
('RIG_DIC21-186-A_KENDALL_TAN', 'PARCIAL', 0, 0, 4, 4, 7, 6, 6, 6, 3, 2, 0, 0, 0, 0, '2022-02-09'),
('RIG_DIC21-186-A_KENDALL_BEIGE', 'ENTREGADO', 0, 0, 4, 6, 8, 7, 9, 5, 3, 5, 0, 0, 0, 0, '2022-02-11'),
('RIG_ABR22-043-A_KENDALL_NEGRO', 'PARCIAL', 1, 1, 8, 7, 9, 8, 3, 7, 0, 2, 2, 0, 0, 0, '2022-04-01'),
('RIG_ABR22-043-A_KENDALL_TAN', 'PARCIAL', 0, 0, 4, 2, 4, 3, 3, 5, 2, 1, 0, 0, 0, 0, '2022-04-04'),
('RIG_ABR22-039-A_KENDALL_NEGRO', 'DE ESPERA EN LLEGADA', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '0000-00-00'),
('RIG_ABR22-039-A_KENDALL_TAN', 'DE ESPERA EN LLEGADA', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '0000-00-00'),
('RIG_ABR22-051-A_KENDALL_NEGRO', 'DE ESPERA EN LLEGADA', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '0000-00-00'),
('RIG_MAR21-023-A_KOURTNEY_LIZARD ALMENDRA', 'DE ESPERA EN LLEGADA', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '0000-00-00'),
('RIG_MAR21-023-A_KOURTNEY_LIZARD NEGRO', 'PARCIAL', 1, 1, 1, 1, 0, 2, 1, 0, 0, 1, 1, 0, 0, 0, '2022-02-23'),
('GOT_NOV22-214-A_LAUREN_ROJO', 'ENTREGADO', 0, 0, 1, 1, 3, 3, 1, 1, 0, 0, 0, 0, 0, 0, '2021-01-26'),
('GOT_NOV22-214-A_LAUREN_TAN', 'ENTREGADO', 0, 0, 1, 3, 1, 1, 2, 1, 0, 0, 0, 0, 0, 0, '2022-02-23'),
('GOT_DIC22-230-A_LAUREN_INOX', 'ENTREGADO', 1, 1, 1, 1, 3, 3, 2, 1, 1, 0, 1, 0, 0, 0, '2022-01-12'),
('GOT_DIC22-230-A_LAUREN_ROJO', 'ENTREGADO', 0, 0, 2, 2, 5, 3, 4, 3, 2, 1, 1, 0, 0, 0, '2022-01-12'),
('GOT_DIC22-230-A_LAUREN_TAN', 'ENTREGADO', 1, 1, 4, 3, 5, 4, 4, 4, 2, 0, 1, 0, 0, 0, '2022-04-07'),
('GOT_DIC21-231-A_LETICIA_SEDA', 'ENTREGADO', 1, 1, 6, 4, 3, 4, 5, 2, 1, 1, 1, 0, 0, 0, '2022-01-11'),
('GOT_DIC21-231-A_LETICIA_NEGRO', 'ENTREGADO', 1, 1, 3, 2, 4, 5, 6, 3, 1, 1, 1, 0, 0, 0, '2022-01-10'),
('GOT_DIC21-231-A_LETICIA_ROJO', 'DE ESPERA EN LLEGADA', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '0000-00-00'),
('GOT_MAR22-072-A_LETICIA_BLUE STEEL', 'ENTREGADO', 1, 1, 3, 3, 4, 4, 3, 2, 1, 1, 0, 0, 0, 0, '2022-04-11'),
('GOT_MAR22-072-A_LETICIA_BANANA', 'ENTREGADO', 0, 0, 3, 4, 3, 3, 2, 1, 1, 0, 0, 0, 0, 0, '2022-04-11'),
('GOT_MAR22-072-A_LETICIA_DUNE', 'ENTREGADO', 1, 1, 4, 3, 5, 5, 4, 1, 1, 1, 0, 0, 0, 0, '2022-04-11'),
('GOT_MAR22-072-A_LETICIA_KIWI', 'ENTREGADO', 1, 1, 2, 3, 3, 3, 2, 2, 1, 0, 0, 0, 0, 0, '2022-04-11'),
('GOT_MAR22-072-A_LETICIA_AURORA', 'PARCIAL', 0, 1, 3, 3, 4, 3, 0, 0, 1, 0, 0, 0, 0, 0, '2022-04-11'),
('GOT_MAR22-072-A_LETICIA_SUGAR', 'ENTREGADO', 0, 0, 1, 0, 1, 0, 1, 0, 0, 0, 0, 0, 0, 0, '2022-04-11'),
('GOT_MAR22-069-A_LYRA_VERDE OLIVO', 'ENTREGADO', 1, 1, 4, 3, 2, 2, 0, 1, 1, 1, 0, 0, 0, 0, '2022-03-11'),
('GOT_MAR22-069-A_LYRA_AZUL MARINO', 'DE ESPERA EN LLEGADA', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '0000-00-00'),
('PIR_MAR22-002-A_MACARENA_CONCRETO', 'DE ESPERA EN LLEGADA', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '0000-00-00'),
('PIR_MAR22-002-A_MACARENA_ORO VIEJO', 'DE ESPERA EN LLEGADA', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '0000-00-00'),
('GOT_FEB22-016-A_MAGDALENA_BLANCO', 'DE ESPERA EN LLEGADA', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '0000-00-00'),
('GOT_FEB22-025-A_MARCELA_INOX CONCRETO', 'PARCIAL', 1, 1, 3, 5, 6, 6, 5, 3, 3, 1, 1, 0, 0, 0, '2022-03-10'),
('GOT_FEB22-025-A_MARCELA_NEGRO CHAI', 'ENTREGADO', 1, 1, 3, 5, 7, 6, 5, 3, 3, 1, 1, 0, 0, 0, '2022-03-18'),
('RIG_ENE22-009-A_MARIA_NEGRO Y CONCRETO', 'ENTREGADO', 0, 0, 3, 4, 5, 4, 5, 3, 3, 2, 1, 0, 0, 0, '2022-02-23'),
('RIG_ENE22-009-A_MARIA_BLANCO Y NEGRO', 'ENTREGADO', 0, 0, 3, 4, 5, 4, 5, 3, 3, 2, 1, 0, 0, 0, '2022-03-02'),
('RIG_ENE22-009-A_MARIA_BLANCO', 'PARCIAL', 0, 0, 3, 4, 5, 4, 5, 2, 2, 2, 1, 0, 0, 0, '2022-02-18'),
('RIG_ENE22-009-A_MARIA_COBRA ORO', 'ENTREGADO', 0, 0, 3, 3, 4, 3, 4, 2, 3, 2, 1, 0, 0, 0, '2022-03-23'),
('GOT_FEB22-028-A_MARIAN_UVA', 'PARCIAL', 1, 1, 4, 4, 6, 5, 6, 4, 2, 2, 1, 0, 0, 0, '2022-03-10'),
('GOT_FEB22-028-A_MARIAN_PALO DE ROSA', 'PARCIAL', 1, 1, 5, 6, 8, 6, 7, 5, 3, 1, 1, 0, 0, 0, '2022-03-09'),
('GOT_FEB22-028-A_MARIN_MANDARINA', 'DE ESPERA EN LLEGADA', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '0000-00-00'),
('GOT_MAR22-070-A_MASHA 40_BEIGE', 'ENTREGADO', 1, 1, 1, 6, 0, 0, 5, 3, 1, 1, 1, 0, 0, 0, '2022-03-30'),
('GOT_MAR22-070-A_MASHA 40_CHAROL NEGRO', 'PARCIAL', 0, 0, 0, 0, 2, 1, 2, 0, 0, 1, 0, 0, 0, 0, '2022-05-11'),
('GOT_ABR22-097-A_MASHA 40_BEIGE', 'DE ESPERA EN LLEGADA', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '0000-00-00'),
('GOT_ABR22-097-A_MASHA 40_CHAROL NEGRO', 'DE ESPERA EN LLEGADA', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '0000-00-00'),
('GOT_FEB22-015-A_MURPHY_CARAMELO ROSA', 'DE ESPERA EN LLEGADA', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '0000-00-00'),
('GOT_FEB22-015-A_MURPHY_NEGRO CONCRETO', 'PARCIAL', 1, 1, 6, 5, 6, 5, 5, 3, 2, 1, 0, 0, 0, 0, '2022-03-17'),
('GOT_FEB22-015-A_MURPHY_AZUL', 'DE ESPERA EN LLEGADA', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '0000-00-00'),
('RIG_ABR22-040-A_OXFORD SPORT_NEGRO', 'PARCIAL', 0, 0, 0, 0, 0, 3, 3, 2, 2, 2, 0, 0, 0, 0, '2022-04-18'),
('GOT_MAR22-034-A_PIA_ESMERALDA', 'ENTREGADO', 1, 2, 3, 4, 7, 5, 6, 3, 3, 1, 1, 0, 0, 0, '2022-04-07'),
('GOT_MAR22-034-A_PIA_ZAFIRO', 'ENTREGADO', 1, 2, 3, 4, 7, 5, 6, 3, 3, 1, 1, 0, 0, 0, '2022-04-08'),
('GOT_MAR22-034-A_PIA_ORO HINDU', 'ENTREGADO', 1, 2, 3, 4, 7, 5, 6, 3, 3, 1, 1, 0, 0, 0, '2022-04-08'),
('GOT_MAR22-034-A_PIA_GALIO AMATISTA', 'ENTREGADO', 1, 2, 3, 4, 7, 5, 6, 3, 3, 1, 1, 0, 0, 0, '2022-04-07'),
('GOT_MAR22-034-A_PIA_PLATA', 'ENTREGADO', 1, 2, 3, 4, 7, 5, 6, 3, 3, 1, 1, 0, 0, 0, '2022-04-08'),
('GOT_ABR22-144-A_PIA_NARANJA ORANGEL', 'DE ESPERA EN LLEGADA', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '0000-00-00'),
('GOT_ABR22-144-A_PIA_ROSA', 'DE ESPERA EN LLEGADA', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '0000-00-00'),
('GOT_ABR22-144-A_PIA_LIME GREEN', 'DE ESPERA EN LLEGADA', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '0000-00-00'),
('RIG_FEB22-012-A_REESE_MIX ROSE', 'ENTREGADO', 0, 0, 6, 5, 10, 8, 8, 6, 4, 2, 0, 0, 0, 0, '2022-02-03'),
('RIG_FEB22-012-A_REESE_NEGRO', 'ENTREGADO', 0, 0, 5, 5, 10, 8, 9, 6, 5, 2, 0, 0, 0, 0, '2022-03-22'),
('RIG_MAR22-060-A_REESE_MIX ROSE', 'PARCIAL', 0, 0, 1, 3, 6, 4, 3, 3, 1, 1, 0, 0, 0, 0, '2022-03-31'),
('RIG_MAR22-060-A_REESE_NEGRO', 'PARCIAL', 0, 0, 0, 4, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2022-03-23'),
('RIG_ABR22-063-A_REESE_MIX ROSE', 'ENTREGADO', 0, 0, 2, 4, 9, 4, 4, 3, 2, 1, 0, 0, 0, 0, '2022-04-18'),
('RIG_ABR22-063-A_REESE_NEGRO', 'ENTREGADO', 0, 0, 1, 4, 3, 1, 2, 0, 0, 0, 0, 0, 0, 0, '2022-04-18'),
('RIG_ABR22-065-A_REESE_MIX ROSE', 'DE ESPERA EN LLEGADA', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '0000-00-00'),
('RIG_ABR22-065-A_REESE_NEGRO', 'ENTREGADO', 0, 0, 1, 2, 9, 4, 4, 3, 2, 1, 0, 0, 0, 0, '2022-04-18'),
('RIG_ABR22-087-A_REESE_MIX ROSE', 'DE ESPERA EN LLEGADA', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '0000-00-00'),
('RIG_ABR22-087-A_REESE_NEGRO', 'DE ESPERA EN LLEGADA', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '0000-00-00'),
('RIG_ABR22-087-A_REESE_ARENA TERRACOTA VERDE', 'PARCIAL', 0, 0, 1, 2, 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, '2022-05-04'),
('RIG_ABR22-087-A_REESE_ARENA CANELA', 'PARCIAL', 0, 0, 1, 1, 2, 1, 1, 1, 1, 0, 0, 0, 0, 0, '2022-05-05'),
('GOT_MAR22-047-A_REGINA PUMP 75_MARINO', 'PARCIAL', 0, 0, 2, 1, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, '2022-03-11'),
('GOT_MAR22-047-A_REGINA PUMP 75_NEGRO', 'ENTREGADO', 1, 1, 3, 1, 1, 0, 3, 0, 0, 1, 1, 0, 0, 0, '2022-03-10'),
('GOT_MAR22-047-A_REGINA PUMP 75_BUVARD', 'DE ESPERA EN LLEGADA', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '0000-00-00'),
('GOT_MAR22-047-A_REGINA PUMP 75_YOGURT', 'DE ESPERA EN LLEGADA', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '0000-00-00'),
('GOT_MAR22-080-A_REGINA PUMP 75_CASCABEL', 'DE ESPERA EN LLEGADA', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '0000-00-00'),
('GOT_ABR22-086-A_SABRINA_BEIGE', 'DE ESPERA EN LLEGADA', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '0000-00-00'),
('GOT_ABR22-086-A_SABRINA_SEDA', 'DE ESPERA EN LLEGADA', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '0000-00-00'),
('GOT_ABR22-086-A_SABRINA_NEGRO', 'DE ESPERA EN LLEGADA', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '0000-00-00'),
('GOT_ABR22-086-A_SABRINA_ROJO', 'DE ESPERA EN LLEGADA', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '0000-00-00'),
('GOT_ABR22-143-A_SABRINA_AZUL TURQUESA', 'DE ESPERA EN LLEGADA', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '0000-00-00'),
('RIV_SEP21-018-A_TAMARA_NEGRO', 'ENTREGADO', 1, 1, 3, 3, 5, 4, 5, 3, 3, 1, 1, 0, 0, 0, '2022-04-09'),
('RIV_SEP21-018-A_TAMARA_CROCO ROJO', 'ENTREGADO', 2, 3, 5, 6, 11, 8, 10, 5, 3, 0, 2, 0, 0, 0, '2022-03-28'),
('RIV_SEP21-019-A_TANIA_LIZARD NEGRO', 'ENTREGADO', 1, 2, 3, 4, 7, 5, 6, 3, 3, 1, 1, 0, 0, 0, '2022-03-28'),
('RIV_SEP21-019-A_TANIA_LIZARD ROJO', 'ENTREGADO', 1, 2, 3, 4, 7, 5, 6, 3, 3, 1, 1, 0, 0, 0, '2022-03-28'),
('RIV_SEP21-019-A_TANIA_LIZARD TAUPE', 'ENTREGADO', 1, 2, 3, 4, 7, 5, 6, 3, 3, 1, 1, 0, 0, 0, '2022-03-28'),
('RIG_ABR22-034-A_TONY_SNAKE HUNTER (MOSTAZA)', 'PARCIAL', 0, 0, 2, 7, 3, 4, 4, 1, 3, 2, 0, 0, 0, 0, '2022-03-08'),
('RIG_ABR22-034-A_TONY_SNAKE AZUL', 'PARCIAL', 0, 0, 1, 0, 5, 4, 5, 2, 1, 0, 0, 0, 0, 0, '2022-04-04'),
('GOT_MAR22-067-A_VENUS_SEDA', 'DE ESPERA EN LLEGADA', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '0000-00-00'),
('GOT_ABR22-088-A_VENUS_SEDA', 'DE ESPERA EN LLEGADA', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '0000-00-00'),
('GOT_OCT22-064-A_1980_AQUA', 'ENTREGADO', 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 4, '0000-00-00'),
('GOT_OCT22-064-A_1980_AZUL ACERO', 'PARCIAL', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, '0000-00-00'),
('GOT_NOV21-211-A_LYRA_VERDE OLIVO', 'DE ESPERA EN LLEGADA', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '0000-00-00'),
('GOT_NOV21-211-A_LYRA_AZUL MARINO', 'ENTREGADO', 1, 1, 5, 6, 9, 6, 2, 2, 0, 0, 0, 0, 0, 0, '2022-01-14'),
('RIG_MAR22-021-A_VALENTINA_NEGRO', 'PARCIAL', 1, 1, 4, 4, 5, 7, 0, 5, 2, 2, 0, 0, 0, 0, '2022-03-02'),
('RIG_MAR22-021-A_VALENTINA_SNAKE GRIS', 'PARCIAL', 0, 0, 1, 2, 4, 6, 3, 2, 1, 1, 0, 0, 0, 0, '2022-03-02'),
('GOT_DIC21-229-A_1990_LIZARD ROJO', 'ENTREGADO', 1, 1, 2, 3, 5, 4, 3, 3, 2, 1, 1, 0, 0, 0, '2022-01-17'),
('GOT_DIC21-229-A_1990_LIZARD CAFE', 'ENTREGADO', 1, 1, 2, 3, 5, 4, 3, 3, 2, 1, 1, 0, 0, 0, '2022-01-14'),
('__', 'DE ESPERA EN LLEGADA', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '0000-00-00'),
('__', 'DE ESPERA EN LLEGADA', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '0000-00-00'),
('__', 'DE ESPERA EN LLEGADA', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '0000-00-00'),
('__', 'DE ESPERA EN LLEGADA', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '0000-00-00'),
('__', 'DE ESPERA EN LLEGADA', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '0000-00-00'),
('__', 'DE ESPERA EN LLEGADA', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '0000-00-00'),
('__', 'DE ESPERA EN LLEGADA', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '0000-00-00');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
