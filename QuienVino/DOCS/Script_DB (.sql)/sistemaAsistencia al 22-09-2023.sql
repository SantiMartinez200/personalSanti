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
	(456, 'Martin', 'Chabay', '8888-08-08'),
	(20100311, 'Hector', 'Ricardo', '1968-04-09'),
	(44440531, 'Marcos Jeremias', 'Martínez Bender ', '2002-12-02'),
	(45387759, 'Santiago Nicolas', 'Martínez ', '2003-11-28');

-- Volcando estructura para tabla sistemaasistencia.asistencia
CREATE TABLE IF NOT EXISTS `asistencia` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `dni` bigint NOT NULL,
  `fecha_asistencia` datetime NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  KEY `FK_asistencia_alumno` (`dni`),
  CONSTRAINT `FK_asistencia_alumno` FOREIGN KEY (`dni`) REFERENCES `alumno` (`dni`)
) ENGINE=InnoDB AUTO_INCREMENT=87 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla sistemaasistencia.asistencia: ~8 rows (aproximadamente)
INSERT INTO `asistencia` (`id`, `dni`, `fecha_asistencia`) VALUES
	(79, 44440531, '2023-09-22 10:53:20'),
	(80, 456, '2023-09-22 14:14:05'),
	(81, 456, '2023-09-22 14:16:39'),
	(82, 456, '2023-09-22 14:16:46'),
	(83, 44440531, '2023-09-22 14:25:27'),
	(84, 456, '2023-09-22 14:37:50'),
	(85, 44440531, '2023-09-22 15:35:52'),
	(86, 44440531, '2023-09-22 15:35:57');

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
  `id` bigint NOT NULL AUTO_INCREMENT,
  `dni_profesor` bigint NOT NULL,
  `nombre` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `apellido` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `fecha_nacimiento` date DEFAULT NULL,
  `titulo` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`id`,`dni_profesor`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla sistemaasistencia.profesor: ~2 rows (aproximadamente)
INSERT INTO `profesor` (`id`, `dni_profesor`, `nombre`, `apellido`, `fecha_nacimiento`, `titulo`) VALUES
	(2, 99999990, 'Iván', 'Gonzalez ', '1980-12-18', 'Ingeniero'),
	(7, 11222333, 'Javier', 'Parra', '1900-12-12', 'Profesor');

-- Volcando estructura para tabla sistemaasistencia.usuarios
CREATE TABLE IF NOT EXISTS `usuarios` (
  `username` varchar(50) NOT NULL,
  `pass` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla sistemaasistencia.usuarios: ~1 rows (aproximadamente)
INSERT INTO `usuarios` (`username`, `pass`) VALUES
	('santimartinez', '1234');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
