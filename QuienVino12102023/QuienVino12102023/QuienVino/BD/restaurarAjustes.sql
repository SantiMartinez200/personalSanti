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

-- Volcando datos para la tabla sistemaasistencia.alumno: ~28 rows (aproximadamente)
DELETE FROM `alumno`;
INSERT INTO `alumno` (`dni`, `nombre`, `apellido`, `fecha_nacimiento`) VALUES
	(38570361, 'Marcos', 'Reynoso', '2003-12-12'),
	(39255959, 'Franco Antonio', 'Robles', '2003-12-12'),
	(40018598, 'Kevin Gustavo', 'Quiroga', '1995-12-17'),
	(40790201, 'Esteban', 'Copello', '2003-12-12'),
	(40790545, 'Daian Exequiel', 'Fernandez', '2003-12-12'),
	(41872676, 'Facundo Ariel', 'Janusa', '2003-12-12'),
	(42069298, 'Marcos Damián', 'Godoy', '2003-12-12'),
	(42070085, 'María Pía', 'Melgarejo', '2003-12-12'),
	(42850626, 'Lucas Gabriel', 'Barreiro  ', '2000-12-12'),
	(43149316, 'Franco Agustin', 'Chappe', '2003-12-12'),
	(43414566, 'Maximiliano', 'Weyler', '2003-12-12'),
	(43631710, 'Thiago Jeremías', 'Meseguer', '2003-12-12'),
	(43631803, 'Bruno', 'Godoy', '2003-12-12'),
	(43632750, 'Roman', 'Coletti', '2003-12-12'),
	(44282007, 'Bianca Ariana', 'Quiroga', '2003-12-12'),
	(44623314, 'Facundo Gerónimo', 'Figun', '2003-12-12'),
	(44644523, 'Ignacio Agustín', 'Piter', '2003-12-12'),
	(44980999, 'Nicolas Osvaldo', 'Fernandez', '2003-12-12'),
	(44981059, 'Federico José', 'Martinolich', '2003-12-12'),
	(45048325, 'Felipe', 'Franco', '2003-12-12'),
	(45048950, 'Facundo Martín', 'Jara', '2003-12-12'),
	(45385675, 'Teo', 'Hildt', '2003-12-12'),
	(45387761, 'Santiago Nicolas', 'Martínez Bender', '2023-10-10'),
	(45389325, 'Lucas Jeremías', 'Fiorotto', '2003-12-12'),
	(45741185, 'Pablo Federico', 'Martínez', '2003-12-12'),
	(45847922, 'Franco', 'Cabrera', '2003-12-12');

-- Volcando estructura para tabla sistemaasistencia.asistencia
CREATE TABLE IF NOT EXISTS `asistencia` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `dni` bigint DEFAULT NULL,
  `fecha_asistencia` datetime NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  KEY `FK_asistencia_alumno` (`dni`),
  CONSTRAINT `FK_asistencia_alumno` FOREIGN KEY (`dni`) REFERENCES `alumno` (`dni`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla sistemaasistencia.asistencia: ~0 rows (aproximadamente)
DELETE FROM `asistencia`;

-- Volcando estructura para tabla sistemaasistencia.parametros
CREATE TABLE IF NOT EXISTS `parametros` (
  `clave_ajuste` tinyint NOT NULL AUTO_INCREMENT,
  `dias_clases` smallint DEFAULT NULL,
  `promedio_promocion` int DEFAULT NULL,
  `promedio_regularidad` int DEFAULT NULL,
  `edad_minima` tinyint DEFAULT NULL,
  PRIMARY KEY (`clave_ajuste`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla sistemaasistencia.parametros: ~1 rows (aproximadamente)
DELETE FROM `parametros`;
INSERT INTO `parametros` (`clave_ajuste`, `dias_clases`, `promedio_promocion`, `promedio_regularidad`, `edad_minima`) VALUES
	(1, 24, 80, 60, 17);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
