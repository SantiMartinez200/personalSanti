-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         8.0.30 - MySQL Community Server - GPL
-- SO del servidor:              Win64
-- HeidiSQL Versión:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Volcando estructura de base de datos para sistemaasistencia
CREATE DATABASE IF NOT EXISTS `sistemaasistencia` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `sistemaasistencia`;

-- Volcando estructura para tabla sistemaasistencia.alumno
CREATE TABLE IF NOT EXISTS `alumno` (
  `dni` bigint NOT NULL,
  `nombre` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `apellido` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  PRIMARY KEY (`dni`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla sistemaasistencia.alumno: ~23 rows (aproximadamente)
INSERT INTO `alumno` (`dni`, `nombre`, `apellido`, `fecha_nacimiento`) VALUES
	(38570361, 'Marcos', 'Reynoso', '2003-12-12'),
	(39255959, 'Franco Antonio', 'Robles', '2003-12-12'),
	(40018598, 'Kevin Gustavo', 'Quiroga', '1995-12-17'),
	(40790201, 'Esteban', 'Copello    ', '2003-12-12'),
	(40790545, 'Daian Exequiel', 'Fernandez ', '2003-12-12'),
	(41872676, 'Facundo Ariel', 'Janusa', '2003-12-12'),
	(42069298, 'Marcos Damián', 'Godoy', '2003-12-12'),
	(42070087, 'Maria Pia', 'Melgarejo                    ', '2003-12-12'),
	(42850626, 'Lucas ', 'Barreiro                     ', '2000-12-12'),
	(43631710, 'Thiago Jeremias', 'Meseguer ', '2003-12-12'),
	(43631803, 'Bruno', 'Godoy ', '2003-12-12'),
	(44282007, 'Bianca Ariana', 'Quiroga', '2003-12-12'),
	(44440531, 'Marcos', 'Martinez ', '2002-12-01'),
	(44623314, 'Facundo Geronimo', 'Figun ', '2003-12-12'),
	(44644522, 'Ignacio Agustin', 'Piter  ', '2003-12-12'),
	(44980999, 'Nicolas Osvaldo', 'Fernandez  ', '2003-12-12'),
	(44981059, 'Federico José', 'Martinolich', '2003-12-12'),
	(45048325, 'Felipe', 'Franco  ', '2003-12-12'),
	(45048950, 'Facundo Martin', 'Jara ', '2003-12-12'),
	(45385675, 'Teo', 'Hildt', '2003-12-12'),
	(45387761, 'Santiago Nicolas', 'Martinez Bender ', '2003-11-28'),
	(45389325, 'Lucas Jeremias', 'Fiorotto                     ', '2003-12-12'),
	(45741185, 'Pablo Federico', 'Martinez      ', '2003-12-12');

-- Volcando estructura para tabla sistemaasistencia.asistencia
CREATE TABLE IF NOT EXISTS `asistencia` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `dni` bigint DEFAULT NULL,
  `fecha_asistencia` datetime NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  KEY `FK_asistencia_alumno` (`dni`),
  CONSTRAINT `FK_asistencia_alumno` FOREIGN KEY (`dni`) REFERENCES `alumno` (`dni`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=375 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla sistemaasistencia.asistencia: ~92 rows (aproximadamente)
INSERT INTO `asistencia` (`id`, `dni`, `fecha_asistencia`) VALUES
	(79, 44981059, '2023-10-28 22:50:43'),
	(80, 43631710, '2023-10-28 22:50:47'),
	(81, 44282007, '2023-10-28 22:50:50'),
	(83, 42069298, '2023-10-28 23:27:43'),
	(84, 39255959, '2023-10-28 23:34:07'),
	(87, 45385675, '2023-10-28 23:52:32'),
	(89, 44980999, '2023-10-28 23:52:37'),
	(90, 45048950, '2023-10-28 23:52:39'),
	(91, 45741185, '2023-10-28 23:52:45'),
	(93, 42070087, '2023-10-28 23:52:52'),
	(94, 44644522, '2023-10-28 23:52:55'),
	(96, 38570361, '2023-10-28 23:53:01'),
	(101, 44981059, '2023-10-29 00:03:29'),
	(102, 45048325, '2023-10-29 00:04:57'),
	(103, 45741185, '2023-10-29 00:22:55'),
	(106, 45048950, '2023-10-29 15:16:46'),
	(112, 44623314, '2023-10-29 16:11:47'),
	(113, 45389325, '2023-10-29 16:13:08'),
	(114, 42069298, '2023-10-29 16:13:28'),
	(120, 43631803, '2023-10-29 16:18:55'),
	(121, 45385675, '2023-10-29 16:20:49'),
	(125, 42070087, '2023-10-29 16:36:33'),
	(126, 43631710, '2023-10-29 16:53:33'),
	(127, 44644522, '2023-10-29 16:58:05'),
	(203, 44980999, '2023-10-30 01:51:05'),
	(204, 44623314, '2023-10-30 01:52:34'),
	(207, 42069298, '2023-10-30 01:54:18'),
	(208, 43631803, '2023-10-30 01:54:32'),
	(210, 41872676, '2023-10-30 01:55:51'),
	(213, 45741185, '2023-10-30 02:01:03'),
	(217, 40018598, '2023-10-30 02:07:47'),
	(218, 43631710, '2023-10-30 02:08:07'),
	(219, 44644522, '2023-10-30 02:08:21'),
	(221, 38570361, '2023-10-30 02:11:46'),
	(222, 39255959, '2023-10-30 02:11:49'),
	(223, 42070087, '2023-10-30 02:13:08'),
	(224, 44981059, '2023-10-30 02:13:14'),
	(225, 45389325, '2023-10-30 02:15:14'),
	(226, 45048325, '2023-10-30 02:16:30'),
	(230, 44981059, '2023-11-07 18:10:52'),
	(248, 40790545, '2023-11-08 09:09:17'),
	(249, 44980999, '2023-11-08 09:09:19'),
	(250, 44623314, '2023-11-08 09:09:46'),
	(251, 40790201, '2023-11-08 09:11:09'),
	(252, 45741185, '2023-11-08 09:11:12'),
	(253, 45389325, '2023-11-08 09:11:18'),
	(256, 42850626, '2023-11-08 10:44:43'),
	(257, 38570361, '2023-11-08 12:01:59'),
	(258, 45048325, '2023-11-08 16:25:33'),
	(295, 45387761, '2022-11-10 00:00:00'),
	(299, 45387761, '2023-01-09 00:00:00'),
	(301, 45387761, '2023-08-16 00:00:00'),
	(302, 45387761, '2023-08-19 00:00:00'),
	(303, 45387761, '2023-08-20 00:00:00'),
	(304, 45387761, '2023-08-21 00:00:00'),
	(305, 45387761, '2023-08-22 00:00:00'),
	(307, 45387761, '2022-12-28 00:00:00'),
	(309, 42850626, '2022-11-08 00:00:00'),
	(314, 44981059, '2023-11-09 08:40:00'),
	(319, 45387761, '2002-11-28 00:00:00'),
	(324, 45387761, '2023-11-09 00:00:00'),
	(329, 42850626, '2023-11-09 09:32:56'),
	(331, 45387761, '2022-10-12 00:00:00'),
	(336, 40790201, '2023-11-09 09:44:42'),
	(338, 40790545, '2023-11-09 09:55:56'),
	(341, 44980999, '2023-11-09 10:02:33'),
	(342, 43631803, '2023-11-09 10:02:44'),
	(346, 42850626, '2023-11-10 00:20:42'),
	(347, 40790201, '2023-11-10 00:20:48'),
	(348, 40790545, '2023-11-10 00:20:51'),
	(349, 44980999, '2023-11-10 00:20:53'),
	(350, 44623314, '2023-11-10 00:20:56'),
	(351, 45389325, '2023-11-10 00:20:58'),
	(352, 45048325, '2023-11-10 00:21:01'),
	(353, 42069298, '2023-11-10 00:21:04'),
	(354, 43631803, '2023-11-10 00:21:06'),
	(355, 45385675, '2023-11-10 00:21:09'),
	(356, 41872676, '2023-11-10 09:22:16'),
	(357, 44440531, '2023-11-10 15:03:50'),
	(358, 45048950, '2023-11-10 15:03:52'),
	(359, 45741185, '2023-11-10 15:03:56'),
	(360, 45387761, '2023-11-10 15:03:59'),
	(361, 44981059, '2023-11-10 15:04:01'),
	(362, 42070087, '2023-11-10 15:04:04'),
	(363, 43631710, '2023-11-10 15:04:07'),
	(364, 44644522, '2023-11-10 15:04:09'),
	(365, 40018598, '2023-11-10 15:04:11'),
	(366, 44282007, '2023-11-10 15:04:14'),
	(367, 38570361, '2023-11-10 15:04:16'),
	(368, 39255959, '2023-11-10 15:04:19'),
	(373, 44981059, '2023-11-08 00:00:00'),
	(374, 44981059, '2023-11-06 00:00:00');

-- Volcando estructura para tabla sistemaasistencia.parametros
CREATE TABLE IF NOT EXISTS `parametros` (
  `clave_ajuste` tinyint NOT NULL AUTO_INCREMENT,
  `dias_clases` smallint DEFAULT NULL,
  `promedio_promocion` int DEFAULT NULL,
  `promedio_regularidad` int DEFAULT NULL,
  `edad_minima` tinyint DEFAULT NULL,
  `tolerancia` time DEFAULT NULL,
  `horario_fijo` time DEFAULT NULL,
  PRIMARY KEY (`clave_ajuste`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla sistemaasistencia.parametros: ~1 rows (aproximadamente)
INSERT INTO `parametros` (`clave_ajuste`, `dias_clases`, `promedio_promocion`, `promedio_regularidad`, `edad_minima`, `tolerancia`, `horario_fijo`) VALUES
	(1, 12, 80, 60, 17, NULL, NULL);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
