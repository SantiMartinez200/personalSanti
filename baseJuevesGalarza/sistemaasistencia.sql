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

-- Volcando datos para la tabla sistemaasistencia.alumno: ~4 rows (aproximadamente)
INSERT INTO `alumno` (`dni`, `nombre`, `apellido`, `fecha_nacimiento`) VALUES
	(123, 'aleja', 'aleji', '1974-09-15'),
	(456, 'Martin', 'Chabay', '8888-08-08'),
	(20100311, 'peti', 'martine', '8888-06-19'),
	(44440531, 'Marcos Jeremias', 'Martínez Bender ', '2002-12-02');

-- Volcando estructura para tabla sistemaasistencia.asistencia
CREATE TABLE IF NOT EXISTS `asistencia` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `dni` bigint DEFAULT NULL,
  `fecha_asistencia` datetime NOT NULL,
  `dni_profesor` bigint DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  KEY `FK_asistencia_alumno` (`dni`),
  KEY `FK_asistencia_profesor` (`dni_profesor`),
  CONSTRAINT `FK_asistencia_alumno` FOREIGN KEY (`dni`) REFERENCES `alumno` (`dni`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_asistencia_profesor` FOREIGN KEY (`dni_profesor`) REFERENCES `profesor` (`dni_profesor`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=248 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla sistemaasistencia.asistencia: ~27 rows (aproximadamente)
INSERT INTO `asistencia` (`id`, `dni`, `fecha_asistencia`, `dni_profesor`) VALUES
	(181, 123, '2023-09-28 15:52:24', NULL),
	(221, 44440531, '2023-09-28 16:19:53', NULL),
	(222, 44440531, '2023-09-28 16:20:13', NULL),
	(223, 44440531, '2023-09-28 16:21:35', NULL),
	(224, 44440531, '2023-09-28 16:21:38', NULL),
	(225, 44440531, '2023-09-28 16:21:53', NULL),
	(226, 44440531, '2023-09-28 16:22:38', NULL),
	(227, 44440531, '2023-09-28 16:22:39', NULL),
	(228, 44440531, '2023-09-28 16:22:56', NULL),
	(229, 44440531, '2023-09-28 16:23:09', NULL),
	(230, 44440531, '2023-09-28 16:23:53', NULL),
	(231, 44440531, '2023-09-28 16:24:06', NULL),
	(232, 44440531, '2023-09-28 16:24:14', NULL),
	(233, 44440531, '2023-09-28 16:24:42', NULL),
	(234, 44440531, '2023-09-28 16:24:52', NULL),
	(235, 44440531, '2023-09-28 16:25:02', NULL),
	(236, 44440531, '2023-09-28 16:25:13', NULL),
	(237, 44440531, '2023-09-28 16:25:18', NULL),
	(238, 44440531, '2023-09-28 16:25:38', NULL),
	(239, 44440531, '2023-09-28 16:26:11', NULL),
	(240, 44440531, '2023-09-28 16:26:23', NULL),
	(241, 44440531, '2023-09-28 16:26:39', NULL),
	(242, 44440531, '2023-09-28 16:26:46', NULL),
	(243, 44440531, '2023-09-28 16:26:51', NULL),
	(244, 44440531, '2023-09-28 16:26:58', NULL),
	(245, 44440531, '2023-09-28 16:27:05', NULL),
	(246, 44440531, '2023-09-28 16:27:13', NULL),
	(247, 44440531, '2023-09-28 16:27:43', NULL);

-- Volcando estructura para tabla sistemaasistencia.materia
CREATE TABLE IF NOT EXISTS `materia` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre_materia` varchar(50) NOT NULL,
  `descripcion` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `dia_imparte` varchar(50) NOT NULL,
  `hora_imparte` time NOT NULL,
  `dni_profesor` bigint NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla sistemaasistencia.materia: ~2 rows (aproximadamente)
INSERT INTO `materia` (`id`, `nombre_materia`, `descripcion`, `dia_imparte`, `hora_imparte`, `dni_profesor`) VALUES
	(1, 'Programación II', 'En programación II se enseñan lenguajes de desarrollo web como PHP, JavaScript, HTML, CSS y además usar bases de datos', 'Jueves', '17:30:00', 20100311),
	(2, 'Matemática II', 'de la profe sofi', 'Jueves', '19:30:00', 99999990);

-- Volcando estructura para tabla sistemaasistencia.profesor
CREATE TABLE IF NOT EXISTS `profesor` (
  `dni_profesor` bigint NOT NULL,
  `nombre` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `apellido` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `fecha_nacimiento` date DEFAULT NULL,
  `titulo` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`dni_profesor`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla sistemaasistencia.profesor: ~2 rows (aproximadamente)
INSERT INTO `profesor` (`dni_profesor`, `nombre`, `apellido`, `fecha_nacimiento`, `titulo`) VALUES
	(11222333, 'Pancho', 'Sanpa', '1955-10-13', 'Mecanico'),
	(26789987, 'Sofia', 'Espino', '1985-10-12', 'Profesora');

-- Volcando estructura para tabla sistemaasistencia.usuarios
CREATE TABLE IF NOT EXISTS `usuarios` (
  `username` varchar(50) NOT NULL,
  `pass` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla sistemaasistencia.usuarios: ~0 rows (aproximadamente)
INSERT INTO `usuarios` (`username`, `pass`) VALUES
	('santimartinez', '1234');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
