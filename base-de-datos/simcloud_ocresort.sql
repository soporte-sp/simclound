-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 12-07-2024 a las 09:15:45
-- Versión del servidor: 10.6.18-MariaDB-cll-lve
-- Versión de PHP: 8.1.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `tusimtest`
--
CREATE DATABASE IF NOT EXISTS `tusimtest` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `tusimtest`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `destinos`
--

CREATE TABLE `destinos` (
  `id` int(10) NOT NULL,
  `nombre_destino` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Volcado de datos para la tabla `destinos`
--

INSERT INTO `destinos` (`id`, `nombre_destino`) VALUES
(3, 'Republica Dominicana\r\n'),
(13, 'Estados Unidos / Puerto Rico / Hawai'),
(14, 'Mexico y Canada'),
(15, 'Planes Por Dias Estados Unidos Mexico Canada'),
(16, 'Europa Clasica'),
(17, 'Europa y Turquia'),
(18, 'TuSim Global'),
(19, 'Centro y Sur America');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `planes`
--

CREATE TABLE `planes` (
  `id` int(11) NOT NULL,
  `tiposimcard` varchar(100) NOT NULL,
  `destino` int(10) NOT NULL,
  `tipodeplan` varchar(50) NOT NULL,
  `preciodolares` float NOT NULL,
  `descripcion` text NOT NULL,
  `codigointerno` varchar(15) NOT NULL,
  `estado` int(10) NOT NULL,
  `created_at` datetime(6) NOT NULL DEFAULT current_timestamp(6)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `planes`
--

INSERT INTO `planes` (`id`, `tiposimcard`, `destino`, `tipodeplan`, `preciodolares`, `descripcion`, `codigointerno`, `estado`, `created_at`) VALUES
(1, 'F', 13, 'Datos ilimitados -  30 días', 65, 'Plan de datos ilimitado en velocidad 4G LTE, llamadas ilimitadas dentro de USA y llamadas ilimitadas a Colombia a celular y fijo.', 'R305', 0, '0000-00-00 00:00:00.000000'),
(2, 'F', 13, '50GB - 30 días', 60, '50GB datos en velocidad 4G LTE, llamadas ilimitadas dentro de USA y llamadas ilimitadas a Colombia a celular y fijo.', 'R304', 0, '0000-00-00 00:00:00.000000'),
(3, 'F', 13, '25GB - 30 días', 50, '25GB de datos en velocidad 4G LTE, llamadas ilimitadas dentro de USA y llamadas ilimitadas a Colombia a celular y fijo.', 'R303', 0, '0000-00-00 00:00:00.000000'),
(4, 'F', 13, '15GB - 30 días', 40, '15GB de datos en velocidad 4G LTE, llamadas ilimitadas dentro de USA y llamadas ilimitadas a Colombia a celular y fijo.', 'R302', 0, '0000-00-00 00:00:00.000000'),
(5, 'F', 13, '3GB - 30 días', 30, '3GB de datos en velocidad 4G LTE, llamadas ilimitadas dentro de USA y llamadas ilimitadas a Colombia a celular y fijo.', 'R301', 0, '0000-00-00 00:00:00.000000'),
(6, 'E', 13, 'Datos ilimitados -  30 días', 65, 'Plan de datos ilimitado en velocidad 4G LTE, llamadas ilimitadas dentro de USA y llamadas ilimitadas a Colombia a celular y fijo.', 'R305', 0, '0000-00-00 00:00:00.000000'),
(7, 'E', 13, '50GB - 30 días', 60, '50GB datos en velocidad 4G LTE, llamadas ilimitadas dentro de USA y llamadas ilimitadas a Colombia a celular y fijo.', 'R304', 0, '0000-00-00 00:00:00.000000'),
(8, 'E', 13, '25GB - 30 días', 50, '25GB de datos en velocidad 4G LTE, llamadas ilimitadas dentro de USA y llamadas ilimitadas a Colombia a celular y fijo.', 'R303', 0, '0000-00-00 00:00:00.000000'),
(9, 'F', 14, '7GB - 30 días', 55, '7GB de datos en velocidad 4G LTE, llamadas ilimitadas dentro de México y Canadá celular y fijo.', 'R701', 0, '0000-00-00 00:00:00.000000'),
(10, 'F', 14, '5GB - 30 días', 45, '5GB de datos en velocidad 4G LTE, llamadas ilimitadas dentro de México y Canadá celular y fijo.', 'R702', 0, '0000-00-00 00:00:00.000000'),
(11, 'F', 14, 'ilimitado - 15 días', 55, 'Paquete de solo datos ilimitados en velocidad 4G LTE.', 'R615', 0, '0000-00-00 00:00:00.000000'),
(12, 'F', 14, 'ilimitado - 10 días', 50, 'Paquete de solo datos ilimitados en velocidad 4G LTE.', 'R6010', 0, '0000-00-00 00:00:00.000000'),
(13, 'F', 14, 'ilimitado - 5 días', 35, 'Paquete de solo datos ilimitados en velocidad 4G LTE.', 'R605', 0, '0000-00-00 00:00:00.000000'),
(14, 'E', 14, '7GB - 30 días', 55, '7GB de datos en velocidad 4G LTE, llamadas ilimitadas dentro de México y Canadá celular y fijo.', 'R701', 0, '0000-00-00 00:00:00.000000'),
(15, 'E', 14, '5GB - 30 días', 45, '5GB de datos en velocidad 4G LTE, llamadas ilimitadas dentro de México y Canadá celular y fijo.', 'R702', 0, '0000-00-00 00:00:00.000000'),
(16, 'E', 14, 'ilimitado - 15 días', 55, 'Paquete de solo datos ilimitados en velocidad 4G LTE.', 'R615', 0, '0000-00-00 00:00:00.000000'),
(17, 'E', 14, 'ilimitado - 10 días', 50, 'Paquete de solo datos ilimitados en velocidad 4G LTE.', 'R6010', 0, '0000-00-00 00:00:00.000000'),
(18, 'E', 14, 'ilimitado - 5 días', 35, 'Paquete de solo datos ilimitados en velocidad 4G LTE.', 'R605', 0, '0000-00-00 00:00:00.000000'),
(19, 'E', 15, 'ilimitado - 10 días', 40, 'Plan de datos ilimitados en velocidad 4G LTE mas llamadas ilimitadas dentro de EEUU, MÉXICO Y CANADÁ', 'R610', 0, '0000-00-00 00:00:00.000000'),
(20, 'E', 15, 'ilimitado - 8 días', 35, 'Plan de datos ilimitados en velocidad 4G LTE mas llamadas ilimitadas dentro de EEUU, MÉXICO Y CANADÁ', 'R608', 0, '0000-00-00 00:00:00.000000'),
(21, 'F', 3, 'ilimitado - 15 días', 55, 'Paquete de solo datos ilimitados en velocidad 4G LTE.', 'RD203', 0, '0000-00-00 00:00:00.000000'),
(22, 'F', 3, 'ilimitado - 10 días', 50, 'Paquete de solo datos ilimitados en velocidad 4G LTE.', 'RD202', 0, '0000-00-00 00:00:00.000000'),
(23, 'F', 3, 'ilimitado - 5 días', 35, 'Paquete de solo datos ilimitados en velocidad 4G LTE.', 'RD201', 0, '0000-00-00 00:00:00.000000'),
(24, 'E', 3, 'ilimitado - 15 días', 55, 'Paquete de solo datos ilimitados en velocidad 4G LTE.', 'RD203', 0, '0000-00-00 00:00:00.000000'),
(25, 'E', 3, 'ilimitado - 10 días', 50, 'Paquete de solo datos ilimitados en velocidad 4G LTE.', 'RD202', 0, '0000-00-00 00:00:00.000000'),
(26, 'E', 3, 'ilimitado - 5 días', 35, 'Paquete de solo datos ilimitados en velocidad 4G LTE.', 'RD201', 0, '0000-00-00 00:00:00.000000'),
(27, 'F', 16, 'ilimitado - 28 días', 40, 'Plan de datos ilimitados en velocidad 4G LTE mas llamadas ilimitadas dentro de Europa a números europeos, Cobertura en  Alemania - Austria - Azores - Bélgica - Bulgaria - Chipre - C. Vaticano - Croacia - Dinamarca - Gibraltar - Estonia - Eslovaquia - Eslovenia - España - Estonia - Finlandia - Francia - Grecia - Holanda - Hungría - Islandia - Islas Aland -Islas Baleares - Islas Canarias - Italia - Letonia - Liechtenstein - Lituania - Luxemburgo - Malta - Noruega - Polonia - Portugal - Reino Unido - R. Checa - R. Irlanda - Rumania - Suecia ', 'E405', 0, '0000-00-00 00:00:00.000000'),
(28, 'F', 16, '120GB - 28 días', 35, '120GB de datos en velocidad 4G LTE mas llamadas ilimitadas dentro de Europa a números europeos, Cobertura en  Alemania - Austria - Azores - Bélgica - Bulgaria - Chipre - C. Vaticano - Croacia - Dinamarca - Gibraltar - Estonia - Eslovaquia - Eslovenia - España - Estonia - Finlandia - Francia - Grecia - Holanda - Hungría - Islandia - Islas Aland -Islas Baleares - Islas Canarias - Italia - Letonia - Liechtenstein - Lituania - Luxemburgo - Malta - Noruega - Polonia - Portugal - Reino Unido - R. Checa - R. Irlanda - Rumania - Suecia ', 'E404', 0, '0000-00-00 00:00:00.000000'),
(29, 'F', 16, '60GB - 28 días', 30, '60GB de datos en velocidad 4G LTE mas llamadas ilimitadas dentro de Europa a números europeos, Cobertura en  Alemania - Austria - Azores - Bélgica - Bulgaria - Chipre - C. Vaticano - Croacia - Dinamarca - Gibraltar - Estonia - Eslovaquia - Eslovenia - España - Estonia - Finlandia - Francia - Grecia - Holanda - Hungría - Islandia - Islas Aland -Islas Baleares - Islas Canarias - Italia - Letonia - Liechtenstein - Lituania - Luxemburgo - Malta - Noruega - Polonia - Portugal - Reino Unido - R. Checa - R. Irlanda - Rumania - Suecia ', 'E403', 0, '0000-00-00 00:00:00.000000'),
(30, 'E', 16, '25GB - 28 días', 40, '25GB de datos en velocidad 4G LTE mas llamadas ilimitadas dentro de Europa a números europeos, Cobertura en  Alemania - Austria - Azores - Bélgica - Bulgaria - Chipre - C. Vaticano - Croacia - Dinamarca - Gibraltar - Estonia - Eslovaquia - Eslovenia - España - Estonia - Finlandia - Francia - Grecia - Holanda - Hungría - Islandia - Islas Aland -Islas Baleares - Islas Canarias - Italia - Letonia - Liechtenstein - Lituania - Luxemburgo - Malta - Noruega - Polonia - Portugal - R. Checa - R. Irlanda - Rumania - Suecia ', 'E401', 0, '0000-00-00 00:00:00.000000'),
(31, 'F', 17, '40GB + 150GB - 28 días', 55, '40GB de datos + 150GB adicionales para España en velocidad 4G LTE mas llamadas ilimitadas dentro de Europa a números europeos, Cobertura en  Alemania - Austria - Azores - Bélgica - Bulgaria - Chipre - C. Vaticano - Croacia - Dinamarca - Gibraltar - Estonia - Eslovaquia - Eslovenia - España - Estonia - Finlandia - Francia - Grecia - Holanda - Hungría - Islandia - Islas Aland -Islas Baleares - Islas Canarias - Italia - Letonia - Liechtenstein - Lituania - Luxemburgo - Malta - Mónaco - Noruega - Polonia - Portugal - R. Checa - R. Irlanda - Rumania - Suecia - Suiza - Turquía ', 'E205', 0, '0000-00-00 00:00:00.000000'),
(32, 'F', 17, '30GB + 120GB - 28 días', 50, '30GB de datos + 120GB adicionales para España en velocidad 4G LTE mas llamadas ilimitadas dentro de Europa a números europeos, Cobertura en  Alemania - Austria - Azores - Bélgica - Bulgaria - Chipre - C. Vaticano - Croacia - Dinamarca - Gibraltar - Estonia - Eslovaquia - Eslovenia - España - Estonia - Finlandia - Francia - Grecia - Holanda - Hungría - Islandia - Islas Aland -Islas Baleares - Islas Canarias - Italia - Letonia - Liechtenstein - Lituania - Luxemburgo - Malta - Mónaco - Noruega - Polonia - Portugal - R. Checa - R. Irlanda - Rumania - Suecia - Suiza - Turquía ', 'E204', 0, '0000-00-00 00:00:00.000000'),
(33, 'F', 17, '20GB + 100GB - 28 días', 40, '20GB de datos + 100GB adicionales para España en velocidad 4G LTE mas llamadas ilimitadas dentro de Europa a números europeos, Cobertura en  Alemania - Austria - Azores - Bélgica - Bulgaria - Chipre - C. Vaticano - Croacia - Dinamarca - Gibraltar - Estonia - Eslovaquia - Eslovenia - España - Estonia - Finlandia - Francia - Grecia - Holanda - Hungría - Islandia - Islas Aland -Islas Baleares - Islas Canarias - Italia - Letonia - Liechtenstein - Lituania - Luxemburgo - Malta - Mónaco - Noruega - Polonia - Portugal - R. Checa - R. Irlanda - Rumania - Suecia - Suiza - Turquía ', 'E203', 0, '0000-00-00 00:00:00.000000'),
(34, 'F', 17, '15GB + 50GB - 28 días', 35, '15GB de datos + 50GB adicionales para España en velocidad 4G LTE mas llamadas ilimitadas dentro de Europa a números europeos, Cobertura en  Alemania - Austria - Azores - Bélgica - Bulgaria - Chipre - C. Vaticano - Croacia - Dinamarca - Gibraltar - Estonia - Eslovaquia - Eslovenia - España - Estonia - Finlandia - Francia - Grecia - Holanda - Hungría - Islandia - Islas Aland -Islas Baleares - Islas Canarias - Italia - Letonia - Liechtenstein - Lituania - Luxemburgo - Malta - Mónaco - Noruega - Polonia - Portugal - R. Checa - R. Irlanda - Rumania - Suecia - Suiza - Turquía ', 'E202', 0, '0000-00-00 00:00:00.000000'),
(35, 'F', 17, '10GB + 25GB - 28 días', 30, '10GB de datos + 25GB adicionales para España en velocidad 4G LTE mas llamadas ilimitadas dentro de Europa a números europeos, Cobertura en  Alemania - Austria - Azores - Bélgica - Bulgaria - Chipre - C. Vaticano - Croacia - Dinamarca - Gibraltar - Estonia - Eslovaquia - Eslovenia - España - Estonia - Finlandia - Francia - Grecia - Holanda - Hungría - Islandia - Islas Aland -Islas Baleares - Islas Canarias - Italia - Letonia - Liechtenstein - Lituania - Luxemburgo - Malta - Mónaco - Noruega - Polonia - Portugal - R. Checa - R. Irlanda - Rumania - Suecia - Suiza - Turquía ', 'E201', 0, '0000-00-00 00:00:00.000000'),
(36, 'F', 4, '12GB - 30 días', 55, 'Paquete de solo datos con 12GB en velocidad 4G LTE, con cobertura  Brasil - Chile - Costa Rica - El Salvador - Guatemala - Nicaragua - Panamá - Perú - Puerto Rico - Uruguay', 'R102', 0, '0000-00-00 00:00:00.000000'),
(37, 'F', 4, '8GB - 30 días', 45, 'Paquete de solo datos con 8GB en velocidad 4G LTE, con cobertura  Brasil - Chile - Costa Rica - El Salvador - Guatemala - Nicaragua - Panamá - Perú - Puerto Rico - Uruguay', 'R101', 0, '0000-00-00 00:00:00.000000'),
(38, 'F', 18, 'ilmitado - 30 días', 75, 'Plan solo datos ilimitados, para uso de cualquier aplicación en velocidad 4G LTE, con cobertura en Albania - Alemania - Argelia - Anguila - Argentina - Armenia - Arabia Saudita - Aruba - Australia - Austria - Azerbaiyán - Azores - Banglades - Barbados - Bielorrusia - Bélgica - Bermudas - Bosnia - Brasil - Brunei - Bulgaria - Camboya - Camerún - Canadá - Centrafique - Chile - China - Colombia - Costa Rica - Costa de Marfil - Corea del Sur - Croacia - Chipre - C. Vaticano - Croacia - Dinamarca - Gibraltar - Ecuador - EAU ( Dubai) - EEUU - Egipto - Estonia - Eslovaquia - Eslovenia - España - Estonia - Finlandia - Finlandia - Filipinas - Francia - G. Francesa - Giorgía - Ghana - Gibraltar - Granada - Grecia - Guam - Guatemala - haiti - herze5ovina - honduras - Hong Kong  - Hungría - Islandia - Islas Caimán - Islas Faroe - Islas Turcas y Caicos - India - Indonesia - Irán - Islas Aland -Islas Baleares - Islas Canarias - Irlanda - Israel - Italia - Jamaica - Japón - Jordania - Kasajstán - Kenia - Kirdguistan - Laos - Letonia - Liberia - Lituania - Liechtenstein - Lituania - Luxemburgo - Macao - Madagascar - Malasia -Malta - Martinica - Mauricio - Marruecos - México - Moldavia - Mongolia - Montenegro - Mozambique -  Mónaco - Nepal -  Noruega - Paises Bajo Paraguay - Panamá - Perú - Polonia - Portugal - Qatar - R. Checa - R. Dominicana - Reino Unido - Rusia - Ruanda - R. Irlanda - Rumania - Serbia - Singapur - Sur Africa - Santa Lucia - San Vicente - Sudán - Suecia - Suiza - Turquía ', 'CH30', 0, '0000-00-00 00:00:00.000000'),
(39, 'F', 18, 'ilmitado - 25 días', 70, 'Plan solo datos ilimitados, para uso de cualquier aplicación en velocidad 4G LTE, con cobertura en Albania - Alemania - Argelia - Anguila - Argentina - Armenia - Arabia Saudita - Aruba - Australia - Austria - Azerbaiyán - Azores - Banglades - Barbados - Bielorrusia - Bélgica - Bermudas - Bosnia - Brasil - Brunei - Bulgaria - Camboya - Camerún - Canadá - Centrafique - Chile - China - Colombia - Costa Rica - Costa de Marfil - Corea del Sur - Croacia - Chipre - C. Vaticano - Croacia - Dinamarca - Gibraltar - Ecuador - EAU ( Dubai) - EEUU - Egipto - Estonia - Eslovaquia - Eslovenia - España - Estonia - Finlandia - Finlandia - Filipinas - Francia - G. Francesa - Giorgía - Ghana - Gibraltar - Granada - Grecia - Guam - Guatemala - haiti - herze5ovina - honduras - Hong Kong  - Hungría - Islandia - Islas Caimán - Islas Faroe - Islas Turcas y Caicos - India - Indonesia - Irán - Islas Aland -Islas Baleares - Islas Canarias - Irlanda - Israel - Italia - Jamaica - Japón - Jordania - Kasajstán - Kenia - Kirdguistan - Laos - Letonia - Liberia - Lituania - Liechtenstein - Lituania - Luxemburgo - Macao - Madagascar - Malasia -Malta - Martinica - Mauricio - Marruecos - México - Moldavia - Mongolia - Montenegro - Mozambique -  Mónaco - Nepal -  Noruega - Paises Bajo Paraguay - Panamá - Perú - Polonia - Portugal - Qatar - R. Checa - R. Dominicana - Reino Unido - Rusia - Ruanda - R. Irlanda - Rumania - Serbia - Singapur - Sur Africa - Santa Lucia - San Vicente - Sudán - Suecia - Suiza - Turquía ', 'CH25', 0, '0000-00-00 00:00:00.000000'),
(40, 'F', 18, 'ilimitado - 20 días', 65, 'Plan solo datos ilimitados, para uso de cualquier aplicación en velocidad 4G LTE, con cobertura en Albania - Alemania - Argelia - Anguila - Argentina - Armenia - Arabia Saudita - Aruba - Australia - Austria - Azerbaiyán - Azores - Banglades - Barbados - Bielorrusia - Bélgica - Bermudas - Bosnia - Brasil - Brunei - Bulgaria - Camboya - Camerún - Canadá - Centrafique - Chile - China - Colombia - Costa Rica - Costa de Marfil - Corea del Sur - Croacia - Chipre - C. Vaticano - Croacia - Dinamarca - Gibraltar - Ecuador - EAU ( Dubai) - EEUU - Egipto - Estonia - Eslovaquia - Eslovenia - España - Estonia - Finlandia - Finlandia - Filipinas - Francia - G. Francesa - Giorgía - Ghana - Gibraltar - Granada - Grecia - Guam - Guatemala - haiti - herze5ovina - honduras - Hong Kong  - Hungría - Islandia - Islas Caimán - Islas Faroe - Islas Turcas y Caicos - India - Indonesia - Irán - Islas Aland -Islas Baleares - Islas Canarias - Irlanda - Israel - Italia - Jamaica - Japón - Jordania - Kasajstán - Kenia - Kirdguistan - Laos - Letonia - Liberia - Lituania - Liechtenstein - Lituania - Luxemburgo - Macao - Madagascar - Malasia -Malta - Martinica - Mauricio - Marruecos - México - Moldavia - Mongolia - Montenegro - Mozambique -  Mónaco - Nepal -  Noruega - Paises Bajo Paraguay - Panamá - Perú - Polonia - Portugal - Qatar - R. Checa - R. Dominicana - Reino Unido - Rusia - Ruanda - R. Irlanda - Rumania - Serbia - Singapur - Sur Africa - Santa Lucia - San Vicente - Sudán - Suecia - Suiza - Turquía ', 'CH20', 0, '0000-00-00 00:00:00.000000'),
(41, 'F', 18, 'ilimitado - 15 días', 55, 'Plan solo datos ilimitados, para uso de cualquier aplicación en velocidad 4G LTE, con cobertura en Albania - Alemania - Argelia - Anguila - Argentina - Armenia - Arabia Saudita - Aruba - Australia - Austria - Azerbaiyán - Azores - Banglades - Barbados - Bielorrusia - Bélgica - Bermudas - Bosnia - Brasil - Brunei - Bulgaria - Camboya - Camerún - Canadá - Centrafique - Chile - China - Colombia - Costa Rica - Costa de Marfil - Corea del Sur - Croacia - Chipre - C. Vaticano - Croacia - Dinamarca - Gibraltar - Ecuador - EAU ( Dubai) - EEUU - Egipto - Estonia - Eslovaquia - Eslovenia - España - Estonia - Finlandia - Finlandia - Filipinas - Francia - G. Francesa - Giorgía - Ghana - Gibraltar - Granada - Grecia - Guam - Guatemala - haiti - herze5ovina - honduras - Hong Kong  - Hungría - Islandia - Islas Caimán - Islas Faroe - Islas Turcas y Caicos - India - Indonesia - Irán - Islas Aland -Islas Baleares - Islas Canarias - Irlanda - Israel - Italia - Jamaica - Japón - Jordania - Kasajstán - Kenia - Kirdguistan - Laos - Letonia - Liberia - Lituania - Liechtenstein - Lituania - Luxemburgo - Macao - Madagascar - Malasia -Malta - Martinica - Mauricio - Marruecos - México - Moldavia - Mongolia - Montenegro - Mozambique -  Mónaco - Nepal -  Noruega - Paises Bajo Paraguay - Panamá - Perú - Polonia - Portugal - Qatar - R. Checa - R. Dominicana - Reino Unido - Rusia - Ruanda - R. Irlanda - Rumania - Serbia - Singapur - Sur Africa - Santa Lucia - San Vicente - Sudán - Suecia - Suiza - Turquía ', 'CH15', 0, '0000-00-00 00:00:00.000000'),
(42, 'F', 18, 'ilimitado - 10 días', 50, 'Plan solo datos ilimitados, para uso de cualquier aplicación en velocidad 4G LTE, con cobertura en Albania - Alemania - Argelia - Anguila - Argentina - Armenia - Arabia Saudita - Aruba - Australia - Austria - Azerbaiyán - Azores - Banglades - Barbados - Bielorrusia - Bélgica - Bermudas - Bosnia - Brasil - Brunei - Bulgaria - Camboya - Camerún - Canadá - Centrafique - Chile - China - Colombia - Costa Rica - Costa de Marfil - Corea del Sur - Croacia - Chipre - C. Vaticano - Croacia - Dinamarca - Gibraltar - Ecuador - EAU ( Dubai) - EEUU - Egipto - Estonia - Eslovaquia - Eslovenia - España - Estonia - Finlandia - Finlandia - Filipinas - Francia - G. Francesa - Giorgía - Ghana - Gibraltar - Granada - Grecia - Guam - Guatemala - haiti - herze5ovina - honduras - Hong Kong  - Hungría - Islandia - Islas Caimán - Islas Faroe - Islas Turcas y Caicos - India - Indonesia - Irán - Islas Aland -Islas Baleares - Islas Canarias - Irlanda - Israel - Italia - Jamaica - Japón - Jordania - Kasajstán - Kenia - Kirdguistan - Laos - Letonia - Liberia - Lituania - Liechtenstein - Lituania - Luxemburgo - Macao - Madagascar - Malasia -Malta - Martinica - Mauricio - Marruecos - México - Moldavia - Mongolia - Montenegro - Mozambique -  Mónaco - Nepal -  Noruega - Paises Bajo Paraguay - Panamá - Perú - Polonia - Portugal - Qatar - R. Checa - R. Dominicana - Reino Unido - Rusia - Ruanda - R. Irlanda - Rumania - Serbia - Singapur - Sur Africa - Santa Lucia - San Vicente - Sudán - Suecia - Suiza - Turquía ', 'CH10', 0, '0000-00-00 00:00:00.000000'),
(43, 'F', 18, 'ilimitado - 5 días', 35, 'Plan solo datos ilimitados, para uso de cualquier aplicación en velocidad 4G LTE, con cobertura en Albania - Alemania - Argelia - Anguila - Argentina - Armenia - Arabia Saudita - Aruba - Australia - Austria - Azerbaiyán - Azores - Banglades - Barbados - Bielorrusia - Bélgica - Bermudas - Bosnia - Brasil - Brunei - Bulgaria - Camboya - Camerún - Canadá - Centrafique - Chile - China - Colombia - Costa Rica - Costa de Marfil - Corea del Sur - Croacia - Chipre - C. Vaticano - Croacia - Dinamarca - Gibraltar - Ecuador - EAU ( Dubai) - EEUU - Egipto - Estonia - Eslovaquia - Eslovenia - España - Estonia - Finlandia - Finlandia - Filipinas - Francia - G. Francesa - Giorgía - Ghana - Gibraltar - Granada - Grecia - Guam - Guatemala - haiti - herze5ovina - honduras - Hong Kong  - Hungría - Islandia - Islas Caimán - Islas Faroe - Islas Turcas y Caicos - India - Indonesia - Irán - Islas Aland -Islas Baleares - Islas Canarias - Irlanda - Israel - Italia - Jamaica - Japón - Jordania - Kasajstán - Kenia - Kirdguistan - Laos - Letonia - Liberia - Lituania - Liechtenstein - Lituania - Luxemburgo - Macao - Madagascar - Malasia -Malta - Martinica - Mauricio - Marruecos - México - Moldavia - Mongolia - Montenegro - Mozambique -  Mónaco - Nepal -  Noruega - Paises Bajo Paraguay - Panamá - Perú - Polonia - Portugal - Qatar - R. Checa - R. Dominicana - Reino Unido - Rusia - Ruanda - R. Irlanda - Rumania - Serbia - Singapur - Sur Africa - Santa Lucia - San Vicente - Sudán - Suecia - Suiza - Turquía ', 'CH5', 0, '0000-00-00 00:00:00.000000'),
(44, 'E', 18, 'ilmitado - 30 días', 75, 'Plan solo datos ilimitados, para uso de cualquier aplicación en velocidad 4G LTE, con cobertura en Albania - Alemania - Argelia - Anguila - Argentina - Armenia - Arabia Saudita - Aruba - Australia - Austria - Azerbaiyán - Azores - Banglades - Barbados - Bielorrusia - Bélgica - Bermudas - Bosnia - Brasil - Brunei - Bulgaria - Camboya - Camerún - Canadá - Centrafique - Chile - China - Colombia - Costa Rica - Costa de Marfil - Corea del Sur - Croacia - Chipre - C. Vaticano - Croacia - Dinamarca - Gibraltar - Ecuador - EAU ( Dubai) - EEUU - Egipto - Estonia - Eslovaquia - Eslovenia - España - Estonia - Finlandia - Finlandia - Filipinas - Francia - G. Francesa - Giorgía - Ghana - Gibraltar - Granada - Grecia - Guam - Guatemala - haiti - herze5ovina - honduras - Hong Kong  - Hungría - Islandia - Islas Caimán - Islas Faroe - Islas Turcas y Caicos - India - Indonesia - Irán - Islas Aland -Islas Baleares - Islas Canarias - Irlanda - Israel - Italia - Jamaica - Japón - Jordania - Kasajstán - Kenia - Kirdguistan - Laos - Letonia - Liberia - Lituania - Liechtenstein - Lituania - Luxemburgo - Macao - Madagascar - Malasia -Malta - Martinica - Mauricio - Marruecos - México - Moldavia - Mongolia - Montenegro - Mozambique -  Mónaco - Nepal -  Noruega - Paises Bajo Paraguay - Panamá - Perú - Polonia - Portugal - Qatar - R. Checa - R. Dominicana - Reino Unido - Rusia - Ruanda - R. Irlanda - Rumania - Serbia - Singapur - Sur Africa - Santa Lucia - San Vicente - Sudán - Suecia - Suiza - Turquía ', 'CH30', 0, '0000-00-00 00:00:00.000000'),
(45, 'E', 18, 'ilmitado - 25 días', 70, 'Plan solo datos ilimitados, para uso de cualquier aplicación en velocidad 4G LTE, con cobertura en Albania - Alemania - Argelia - Anguila - Argentina - Armenia - Arabia Saudita - Aruba - Australia - Austria - Azerbaiyán - Azores - Banglades - Barbados - Bielorrusia - Bélgica - Bermudas - Bosnia - Brasil - Brunei - Bulgaria - Camboya - Camerún - Canadá - Centrafique - Chile - China - Colombia - Costa Rica - Costa de Marfil - Corea del Sur - Croacia - Chipre - C. Vaticano - Croacia - Dinamarca - Gibraltar - Ecuador - EAU ( Dubai) - EEUU - Egipto - Estonia - Eslovaquia - Eslovenia - España - Estonia - Finlandia - Finlandia - Filipinas - Francia - G. Francesa - Giorgía - Ghana - Gibraltar - Granada - Grecia - Guam - Guatemala - haiti - herze5ovina - honduras - Hong Kong  - Hungría - Islandia - Islas Caimán - Islas Faroe - Islas Turcas y Caicos - India - Indonesia - Irán - Islas Aland -Islas Baleares - Islas Canarias - Irlanda - Israel - Italia - Jamaica - Japón - Jordania - Kasajstán - Kenia - Kirdguistan - Laos - Letonia - Liberia - Lituania - Liechtenstein - Lituania - Luxemburgo - Macao - Madagascar - Malasia -Malta - Martinica - Mauricio - Marruecos - México - Moldavia - Mongolia - Montenegro - Mozambique -  Mónaco - Nepal -  Noruega - Paises Bajo Paraguay - Panamá - Perú - Polonia - Portugal - Qatar - R. Checa - R. Dominicana - Reino Unido - Rusia - Ruanda - R. Irlanda - Rumania - Serbia - Singapur - Sur Africa - Santa Lucia - San Vicente - Sudán - Suecia - Suiza - Turquía ', 'CH25', 0, '0000-00-00 00:00:00.000000'),
(46, 'E', 18, 'ilimitado - 20 días', 65, 'Plan solo datos ilimitados, para uso de cualquier aplicación en velocidad 4G LTE, con cobertura en Albania - Alemania - Argelia - Anguila - Argentina - Armenia - Arabia Saudita - Aruba - Australia - Austria - Azerbaiyán - Azores - Banglades - Barbados - Bielorrusia - Bélgica - Bermudas - Bosnia - Brasil - Brunei - Bulgaria - Camboya - Camerún - Canadá - Centrafique - Chile - China - Colombia - Costa Rica - Costa de Marfil - Corea del Sur - Croacia - Chipre - C. Vaticano - Croacia - Dinamarca - Gibraltar - Ecuador - EAU ( Dubai) - EEUU - Egipto - Estonia - Eslovaquia - Eslovenia - España - Estonia - Finlandia - Finlandia - Filipinas - Francia - G. Francesa - Giorgía - Ghana - Gibraltar - Granada - Grecia - Guam - Guatemala - haiti - herze5ovina - honduras - Hong Kong  - Hungría - Islandia - Islas Caimán - Islas Faroe - Islas Turcas y Caicos - India - Indonesia - Irán - Islas Aland -Islas Baleares - Islas Canarias - Irlanda - Israel - Italia - Jamaica - Japón - Jordania - Kasajstán - Kenia - Kirdguistan - Laos - Letonia - Liberia - Lituania - Liechtenstein - Lituania - Luxemburgo - Macao - Madagascar - Malasia -Malta - Martinica - Mauricio - Marruecos - México - Moldavia - Mongolia - Montenegro - Mozambique -  Mónaco - Nepal -  Noruega - Paises Bajo Paraguay - Panamá - Perú - Polonia - Portugal - Qatar - R. Checa - R. Dominicana - Reino Unido - Rusia - Ruanda - R. Irlanda - Rumania - Serbia - Singapur - Sur Africa - Santa Lucia - San Vicente - Sudán - Suecia - Suiza - Turquía ', 'CH20', 0, '0000-00-00 00:00:00.000000'),
(47, 'E', 18, 'ilimitado - 15 días', 55, 'Plan solo datos ilimitados, para uso de cualquier aplicación en velocidad 4G LTE, con cobertura en Albania - Alemania - Argelia - Anguila - Argentina - Armenia - Arabia Saudita - Aruba - Australia - Austria - Azerbaiyán - Azores - Banglades - Barbados - Bielorrusia - Bélgica - Bermudas - Bosnia - Brasil - Brunei - Bulgaria - Camboya - Camerún - Canadá - Centrafique - Chile - China - Colombia - Costa Rica - Costa de Marfil - Corea del Sur - Croacia - Chipre - C. Vaticano - Croacia - Dinamarca - Gibraltar - Ecuador - EAU ( Dubai) - EEUU - Egipto - Estonia - Eslovaquia - Eslovenia - España - Estonia - Finlandia - Finlandia - Filipinas - Francia - G. Francesa - Giorgía - Ghana - Gibraltar - Granada - Grecia - Guam - Guatemala - haiti - herze5ovina - honduras - Hong Kong  - Hungría - Islandia - Islas Caimán - Islas Faroe - Islas Turcas y Caicos - India - Indonesia - Irán - Islas Aland -Islas Baleares - Islas Canarias - Irlanda - Israel - Italia - Jamaica - Japón - Jordania - Kasajstán - Kenia - Kirdguistan - Laos - Letonia - Liberia - Lituania - Liechtenstein - Lituania - Luxemburgo - Macao - Madagascar - Malasia -Malta - Martinica - Mauricio - Marruecos - México - Moldavia - Mongolia - Montenegro - Mozambique -  Mónaco - Nepal -  Noruega - Paises Bajo Paraguay - Panamá - Perú - Polonia - Portugal - Qatar - R. Checa - R. Dominicana - Reino Unido - Rusia - Ruanda - R. Irlanda - Rumania - Serbia - Singapur - Sur Africa - Santa Lucia - San Vicente - Sudán - Suecia - Suiza - Turquía ', 'CH15', 0, '0000-00-00 00:00:00.000000'),
(48, 'E', 18, 'ilimitado - 10 días', 50, 'Plan solo datos ilimitados, para uso de cualquier aplicación en velocidad 4G LTE, con cobertura en Albania - Alemania - Argelia - Anguila - Argentina - Armenia - Arabia Saudita - Aruba - Australia - Austria - Azerbaiyán - Azores - Banglades - Barbados - Bielorrusia - Bélgica - Bermudas - Bosnia - Brasil - Brunei - Bulgaria - Camboya - Camerún - Canadá - Centrafique - Chile - China - Colombia - Costa Rica - Costa de Marfil - Corea del Sur - Croacia - Chipre - C. Vaticano - Croacia - Dinamarca - Gibraltar - Ecuador - EAU ( Dubai) - EEUU - Egipto - Estonia - Eslovaquia - Eslovenia - España - Estonia - Finlandia - Finlandia - Filipinas - Francia - G. Francesa - Giorgía - Ghana - Gibraltar - Granada - Grecia - Guam - Guatemala - haiti - herze5ovina - honduras - Hong Kong  - Hungría - Islandia - Islas Caimán - Islas Faroe - Islas Turcas y Caicos - India - Indonesia - Irán - Islas Aland -Islas Baleares - Islas Canarias - Irlanda - Israel - Italia - Jamaica - Japón - Jordania - Kasajstán - Kenia - Kirdguistan - Laos - Letonia - Liberia - Lituania - Liechtenstein - Lituania - Luxemburgo - Macao - Madagascar - Malasia -Malta - Martinica - Mauricio - Marruecos - México - Moldavia - Mongolia - Montenegro - Mozambique -  Mónaco - Nepal -  Noruega - Paises Bajo Paraguay - Panamá - Perú - Polonia - Portugal - Qatar - R. Checa - R. Dominicana - Reino Unido - Rusia - Ruanda - R. Irlanda - Rumania - Serbia - Singapur - Sur Africa - Santa Lucia - San Vicente - Sudán - Suecia - Suiza - Turquía ', 'CH10', 0, '0000-00-00 00:00:00.000000'),
(49, 'E', 18, 'ilimitado - 5 dias', 35, 'Plan solo datos ilimitados, para uso de cualquier aplicacion en velocidad 4G LTE, con cobertura en Albania - Alemania - Argelia - Anguila - Argentina - Armenia - Arabia Saudita - Aruba - Australia - Austria - Azerbaiyán - Azores - Banglades - Barbados - Bielorrusia - Bélgica - Bermudas - Bosnia - Brasil - Brunei - Bulgaria - Camboya - Camerún - Canadá - Centrafique - Chile - China - Colombia - Costa Rica - Costa de Marfil - Corea del Sur - Croacia - Chipre - C. Vaticano - Croacia - Dinamarca - Gibraltar - Ecuador - EAU ( Dubai) - EEUU - Egipto - Estonia - Eslovaquia - Eslovenia - España - Estonia - Finlandia - Finlandia - Filipinas - Francia - G. Francesa - Giorgía - Ghana - Gibraltar - Granada - Grecia - Guam - Guatemala - haiti - herze5ovina - honduras - Hong Kong  - Hungría - Islandia - Islas Caimán - Islas Faroe - Islas Turcas y Caicos - India - Indonesia - Irán - Islas Aland -Islas Baleares - Islas Canarias - Irlanda - Israel - Italia - Jamaica - Japón - Jordania - Kasajstán - Kenia - Kirdguistan - Laos - Letonia - Liberia - Lituania - Liechtenstein - Lituania - Luxemburgo - Macao - Madagascar - Malasia -Malta - Martinica - Mauricio - Marruecos - México - Moldavia - Mongolia - Montenegro - Mozambique -  Mónaco - Nepal -  Noruega - Paises Bajo Paraguay - Panamá - Perú - Polonia - Portugal - Qatar - R. Checa - R. Dominicana - Reino Unido - Rusia - Ruanda - R. Irlanda - Rumania - Serbia - Singapur - Sur Africa - Santa Lucia - San Vicente - Sudán - Suecia - Suiza - Turquía ', 'CH5Y', 0, '0000-00-00 00:00:00.000000'),
(53, 'F', 17, '40GB + 150GB - 28 días', 55, '40GB de datos + 150GB adicionales para España en velocidad 4G LTE mas llamadas ilimitadas dentro de Europa a números europeos, Cobertura en Alemania - Austria - Azores - Bélgica - Bulgaria - Chipre - C. Vaticano - Croacia - Dinamarca - Gibraltar - Estonia - Eslovaquia - Eslovenia - España - Estonia - Finlandia - Francia - Grecia - Holanda - Hungría - Islandia - Islas Aland -Islas Baleares - Islas Canarias - Italia - Letonia - Liechtenstein - Lituania - Luxemburgo - Malta - Mónaco - Noruega - Polonia - Portugal - R. Checa - R. Irlanda - Rumania - Suecia - Suiza - Turquía', 'E206', 0, '2023-05-21 14:06:32.596271'),
(54, 'E', 13, '15GB - 30 días', 40, '15GB de datos en velocidad 4G LTE, llamadas ilimitadas dentro de USA y llamadas ilimitadas a Colombia a celular y fijo.', 'R302', 0, '2023-08-10 16:03:15.937759'),
(55, 'E', 13, '3GB - 30 días', 30, '3GB de datos en velocidad 4G LTE, llamadas ilimitadas dentro de USA y llamadas ilimitadas a Colombia a celular y fijo.', 'R301', 0, '2023-08-11 09:36:40.006585'),
(56, 'E', 17, 'ORANGE - 40GB', 55, 'eSIM de ORANGE. 40GB de datos. Valor 55USD', '23H23', 0, '2023-08-12 09:16:16.391667'),
(57, 'E', 17, 'ORANGE - 30GB', 50, 'eSIM de ORANGE. 30GB de datos. Valor 50USD', '23H21', 0, '2023-08-12 09:19:07.949875'),
(58, 'E', 17, 'ORANGE - 20GB', 40, 'eSIM de ORANGE. 20GB de datos. Valor 40USD', '23H22', 0, '2023-08-12 09:20:49.903914'),
(59, 'E', 17, 'ORANGE - 15GB', 35, 'eSIM de ORANGE. 15GB de datos. Valor 35USD. ', '23H20', 0, '2023-08-12 09:22:04.212303'),
(60, 'E', 17, 'ORANGE - 10GB', 30, 'eSIM de ORANGE. 10GB de datos. Valor 30USD', '23H24', 0, '2023-08-12 09:22:42.995604'),
(61, 'E', 18, 'ilimitado - 7 días', 40, 'Plan solo datos ilimitados, para uso de cualquier aplicación en velocidad 4G LTE, con cobertura en Albania - Alemania - Argelia - Anguila - Argentina - Armenia - Arabia Saudita - Aruba - Australia - Austria - Azerbaiyán - Azores - Banglades - Barbados - Bielorrusia - Bélgica - Bermudas - Bosnia - Brasil - Brunei - Bulgaria - Camboya - Camerún - Canadá - Centrafique - Chile - China - Colombia - Costa Rica - Costa de Marfil - Corea del Sur - Croacia - Chipre - C. Vaticano - Croacia - Dinamarca - Gibraltar - Ecuador - EAU ( Dubai) - EEUU - Egipto - Estonia - Eslovaquia - Eslovenia - España - Estonia - Finlandia - Finlandia - Filipinas - Francia - G. Francesa - Giorgía - Ghana - Gibraltar - Granada - Grecia - Guam - Guatemala - haiti - herze5ovina - honduras - Hong Kong - Hungría - Islandia - Islas Caimán - Islas Faroe - Islas Turcas y Caicos - India - Indonesia - Irán - Islas Aland -Islas Baleares - Islas Canarias - Irlanda - Israel - Italia - Jamaica - Japón - Jordania - Kasajstán - Kenia - Kirdguistan - Laos - Letonia - Liberia - Lituania - Liechtenstein - Lituania - Luxemburgo - Macao - Madagascar - Malasia -Malta - Martinica - Mauricio - Marruecos - México - Moldavia - Mongolia - Montenegro - Mozambique - Mónaco - Nepal - Noruega - Paises Bajo Paraguay - Panamá - Perú - Polonia - Portugal - Qatar - R. Checa - R. Dominicana - Reino Unido - Rusia - Ruanda - R. Irlanda - Rumania - Serbia - Singapur - Sur Africa - Santa Lucia - San Vicente - Sudán - Suecia - Suiza - Turquía', 'CH7', 0, '2023-10-03 08:34:29.207534'),
(62, 'F', 18, 'ilimitado - 7 días', 40, 'Plan solo datos ilimitados, para uso de cualquier aplicación en velocidad 4G LTE, con cobertura en Albania - Alemania - Argelia - Anguila - Argentina - Armenia - Arabia Saudita - Aruba - Australia - Austria - Azerbaiyán - Azores - Banglades - Barbados - Bielorrusia - Bélgica - Bermudas - Bosnia - Brasil - Brunei - Bulgaria - Camboya - Camerún - Canadá - Centrafique - Chile - China - Colombia - Costa Rica - Costa de Marfil - Corea del Sur - Croacia - Chipre - C. Vaticano - Croacia - Dinamarca - Gibraltar - Ecuador - EAU ( Dubai) - EEUU - Egipto - Estonia - Eslovaquia - Eslovenia - España - Estonia - Finlandia - Finlandia - Filipinas - Francia - G. Francesa - Giorgía - Ghana - Gibraltar - Granada - Grecia - Guam - Guatemala - haiti - herze5ovina - honduras - Hong Kong - Hungría - Islandia - Islas Caimán - Islas Faroe - Islas Turcas y Caicos - India - Indonesia - Irán - Islas Aland -Islas Baleares - Islas Canarias - Irlanda - Israel - Italia - Jamaica - Japón - Jordania - Kasajstán - Kenia - Kirdguistan - Laos - Letonia - Liberia - Lituania - Liechtenstein - Lituania - Luxemburgo - Macao - Madagascar - Malasia -Malta - Martinica - Mauricio - Marruecos - México - Moldavia - Mongolia - Montenegro - Mozambique - Mónaco - Nepal - Noruega - Paises Bajo Paraguay - Panamá - Perú - Polonia - Portugal - Qatar - R. Checa - R. Dominicana - Reino Unido - Rusia - Ruanda - R. Irlanda - Rumania - Serbia - Singapur - Sur Africa - Santa Lucia - San Vicente - Sudán - Suecia - Suiza - Turquía', 'CH7', 0, '2023-10-03 08:34:56.366871');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `simcards`
--

CREATE TABLE `simcards` (
  `id` int(11) NOT NULL,
  `usuario` int(11) NOT NULL,
  `simcard` text NOT NULL,
  `tipoplan` text NOT NULL,
  `agrego` text NOT NULL,
  `destino` text NOT NULL,
  `valor` int(11) NOT NULL,
  `creacion` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `addcoodininve` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `nombre` text NOT NULL,
  `usuario2` text NOT NULL,
  `correo` varchar(80) NOT NULL,
  `password` text NOT NULL,
  `perfil` text NOT NULL,
  `foto` text NOT NULL,
  `estado` int(11) NOT NULL,
  `ultimo_login` datetime NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `mostrar` int(11) NOT NULL,
  `nit` text NOT NULL,
  `comercial` text NOT NULL,
  `idpadre` int(11) NOT NULL,
  `coordinador` int(11) NOT NULL,
  `idcoordinadordeadmin` int(11) NOT NULL,
  `admin_enlazado` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `nombre`, `usuario2`, `correo`, `password`, `perfil`, `foto`, `estado`, `ultimo_login`, `fecha`, `mostrar`, `nit`, `comercial`, `idpadre`, `coordinador`, `idcoordinadordeadmin`, `admin_enlazado`) VALUES
(25, 'TuSIM Admin', 'admin', 'correoUser@simcloud.com', '$2a$07$asxx54ahjppf45sd87a5aunhbsmCLsFJCYMxSJwVA0LP77gVeny/6', 'Administrador', 'vistas/img/usuarios/admin/654.jpg', 1, '2024-07-10 22:20:46', '2024-07-11 03:20:46', 0, '', '0', 0, 0, 0, ''),
(399, 'Efrain Martinez', 'emartinez', 'emartinez@tusimtravel.com', '$2a$07$asxx54ahjppf45sd87a5auFL5K1.Cmt9ZheoVVuudOi5BCi10qWly', 'Coordinador', '', 1, '0000-00-00 00:00:00', '2023-08-09 21:49:31', 1, '', '', 0, 0, 0, ''),
(400, 'Venta Directa', 'ventadirecta', 'emartinez@tusimtravel.com', '$2a$07$asxx54ahjppf45sd87a5auFL5K1.Cmt9ZheoVVuudOi5BCi10qWly', 'Agencias', '', 1, '2023-10-31 10:45:20', '2023-10-31 15:45:20', 1, '1045696447', '', 0, 0, 399, ''),
(401, 'Carlos Castillo', 'ccastillo', 'ccastillo@tusimtravel.com', '$2a$07$asxx54ahjppf45sd87a5auFL5K1.Cmt9ZheoVVuudOi5BCi10qWly', 'Coordinador', '', 1, '0000-00-00 00:00:00', '2023-08-17 15:25:51', 1, '', '', 0, 0, 0, ''),
(402, 'Travel and travel', 'travelandtravel', 'ccastillo@tusimtravel.com', '$2a$07$asxx54ahjppf45sd87a5auFL5K1.Cmt9ZheoVVuudOi5BCi10qWly', 'Agencias', '', 1, '2023-08-17 10:27:27', '2023-08-17 15:27:27', 1, '901676333', '', 0, 0, 401, ''),
(403, 'Sp Soluciones Tic', 'sp_soluciones_tic', 'proyectos@spsolucionestic.co', '$2a$07$asxx54ahjppf45sd87a5aujxivA8HylOh6fKPoFTmu1B2bnH9giu6', 'Coordinador', '', 1, '2023-09-12 07:37:57', '2023-09-12 12:37:57', 1, '', '', 0, 0, 0, ''),
(404, 'Sixto Alberto', 'ingsixtoalberto', 'ingsixtoalberto@gmail.com', '$2a$07$asxx54ahjppf45sd87a5auJen.ukg758ZGUakYs.9kmfkeAM/YWuq', 'Agencias', '', 1, '2024-01-02 11:07:34', '2024-01-02 16:07:34', 1, '1129567514', '', 0, 0, 403, ''),
(405, 'Efrain Martinez', 'ventasefrain', 'emartinez@tusimtravel.com', '$2a$07$asxx54ahjppf45sd87a5auFL5K1.Cmt9ZheoVVuudOi5BCi10qWly', 'Agencias', '', 1, '2024-07-08 21:40:32', '2024-07-09 02:40:32', 1, '4567890', '', 0, 0, 399, ''),
(406, 'ventastusim', 'ventastusim', 'soporte@tusimtravel.com', '$2a$07$asxx54ahjppf45sd87a5auFL5K1.Cmt9ZheoVVuudOi5BCi10qWly', 'Agencias', '', 1, '2024-07-08 10:58:55', '2024-07-08 15:58:55', 1, '12345678', '', 0, 0, 401, ''),
(407, 'JIREH TRAVEL', 'jtraveladmin', 'cotizaciones@jirehtravel.com.co', '$2a$07$asxx54ahjppf45sd87a5auzXGw7x5AtLnkSHPGsTixkPzRZMYErZ6', 'Agencias', '', 1, '2024-04-04 10:09:17', '2024-04-04 15:09:17', 1, '8020066170', '', 0, 0, 401, ''),
(408, 'Kelly Hernandez', 'Hernandez', 'khernandez@jirehtravel.com.co', '$2a$07$asxx54ahjppf45sd87a5auM1XZPNI47/yGdSaSRLiGzvA.HPjYWBy', 'Comercial', '', 1, '2024-01-23 14:53:27', '2024-01-23 19:53:27', 1, '', 'jtraveladmin', 407, 1, 0, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

CREATE TABLE `ventas` (
  `id` int(11) NOT NULL,
  `cliente` text NOT NULL,
  `vendedor` int(11) NOT NULL,
  `simcard` varchar(400) NOT NULL,
  `tipoplan` text NOT NULL,
  `fechallegada` date NOT NULL,
  `fecharegreso` date NOT NULL,
  `fechaventa` date NOT NULL,
  `imei` text NOT NULL,
  `observacion` text NOT NULL,
  `valor` text NOT NULL,
  `estado` text NOT NULL,
  `numero` int(11) NOT NULL,
  `codigo` int(11) NOT NULL,
  `agrego` text NOT NULL,
  `celular` text NOT NULL,
  `email` text NOT NULL,
  `pasaporte` text NOT NULL,
  `agregopadre` text NOT NULL,
  `lineaexterior` text NOT NULL,
  `destino` text NOT NULL,
  `horaingreso` int(11) NOT NULL,
  `horacierre` text NOT NULL,
  `coordinador` int(11) NOT NULL,
  `descripcion` text NOT NULL,
  `tiposimcard` varchar(10) NOT NULL,
  `imagelinea` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Indices de la tabla `destinos`
--
ALTER TABLE `destinos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `planes`
--
ALTER TABLE `planes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `destino_fk` (`destino`);

--
-- Indices de la tabla `simcards`
--
ALTER TABLE `simcards`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `destinos`
--
ALTER TABLE `destinos`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `planes`
--
ALTER TABLE `planes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT de la tabla `simcards`
--
ALTER TABLE `simcards`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=409;

--
-- AUTO_INCREMENT de la tabla `ventas`
--
ALTER TABLE `ventas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4024;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
