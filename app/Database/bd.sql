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


-- Volcando estructura de base de datos para todoapp
-- CREATE DATABASE IF NOT EXISTS `todoappshare` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_bin */ /*!80016 DEFAULT ENCRYPTION='N' */;
-- USE `todoappshare`;

-- Volcando estructura para tabla todoapp.usuarios
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id_usuario` int unsigned NOT NULL AUTO_INCREMENT,
  `usuario` varchar(255) NOT NULL,
  `contrasenia` text NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `paterno` varchar(255) NOT NULL,
  `estatus` varchar(2) NOT NULL,
  `fecha_creacion` datetime DEFAULT CURRENT_TIMESTAMP,
  `fecha_actualizacion` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3;

-- Volcando datos para la tabla todoapp.usuarios: ~4 rows (aproximadamente)
INSERT INTO `usuarios` (`id_usuario`, `usuario`, `contrasenia`, `nombre`, `paterno`, `estatus`, `fecha_creacion`, `fecha_actualizacion`) VALUES
	(1, 'super.admin@hotmail.com', '$2y$12$82s1LTJMUmhay5jSZzK8VuNWfvGvcD/FboMnv8gpbMKVdbBS3/qDG', 'super', 'admin', '1', '2025-04-17 14:33:39', '2025-04-25 17:57:23'),
	(2, 'profesor@hotmail.com', '$2y$12$82s1LTJMUmhay5jSZzK8VuNWfvGvcD/FboMnv8gpbMKVdbBS3/qDG', '', '', '1', '2025-04-17 14:33:39', '2025-04-25 17:57:16'),
	(3, 'daniela.sanchez@autotraffic.com.mx', '$2y$12$82s1LTJMUmhay5jSZzK8VuNWfvGvcD/FboMnv8gpbMKVdbBS3/qDG', 'autotraficc', 'empresa', '1', '2025-04-25 17:42:52', '2025-05-11 09:43:24'),
	(4, 'marrinmarrin23@gmail.com', '$2y$12$82s1LTJMUmhay5jSZzK8VuNWfvGvcD/FboMnv8gpbMKVdbBS3/qDG', 'cristobal', 'marin', '1', '2025-04-25 17:42:52', '2025-05-12 07:14:09');

-- Volcando estructura para tabla todoapp.alumnos
CREATE TABLE IF NOT EXISTS `alumnos` (
  `id_alumno` int unsigned NOT NULL AUTO_INCREMENT,
  `codigo` varchar(255) NOT NULL,
  `nombre` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `apellido_p` varchar(255) NOT NULL,
  `apellido_m` varchar(255) NOT NULL,
  `telefono` varchar(10) NOT NULL,
  `correo` varchar(255) NOT NULL,
  `carrera` varchar(255) NOT NULL,
  `situacion` varchar(255) NOT NULL,
  `id_usuario` int unsigned NOT NULL,
  `estatus` varchar(5) NOT NULL,
  `sexo` varchar(255) DEFAULT NULL,
  `avatar` text,
  `fecha_creacion` datetime DEFAULT CURRENT_TIMESTAMP,
  `fecha_actualizacion` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_alumno`),
  KEY `id_usuario` (`id_usuario`),
  CONSTRAINT `alumnos_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;

-- Volcando datos para la tabla todoapp.alumnos: ~2 rows (aproximadamente)
INSERT INTO `alumnos` (`id_alumno`, `codigo`, `nombre`, `apellido_p`, `apellido_m`, `telefono`, `correo`, `carrera`, `situacion`, `id_usuario`, `estatus`, `sexo`, `avatar`, `fecha_creacion`, `fecha_actualizacion`) VALUES
	(1, '1232', 'CRISTOBAL ', 'MARIN', 'DE LOS SANTOS', '', 'marrinmarrin23@gmail.com', '', '', 4, '1', 'MASCULINO', NULL, '2025-04-17 14:47:28', '2025-05-12 07:14:19'),
	(2, '1212', 'DANIELA', 'AUTOTRAFIC', 'AUTOTRAFIC', '444', 'daniela.sanchez@autotraffic.com.mx', 'prueba', 'prueba', 3, '1', 'MASCULINO', NULL, '2025-04-25 17:46:57', '2025-05-12 06:36:32');

-- Volcando estructura para tabla todoapp.bitacora_actividades
CREATE TABLE IF NOT EXISTS `bitacora_actividades` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_usuario` int NOT NULL,
  `tipo_actividad` varchar(100) NOT NULL,
  `descripcion` text,
  `ip_origen` varchar(45) DEFAULT NULL,
  `user_agent` text,
  `fecha_hora` datetime DEFAULT CURRENT_TIMESTAMP,
  `fecha_creacion` datetime DEFAULT CURRENT_TIMESTAMP,
  `fecha_actualizacion` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `id_usuario` (`id_usuario`),
  KEY `fecha_hora` (`fecha_hora`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- Volcando datos para la tabla todoapp.bitacora_actividades: ~0 rows (aproximadamente)

-- Volcando estructura para tabla todoapp.permisos
CREATE TABLE IF NOT EXISTS `permisos` (
  `id_permiso` int unsigned NOT NULL AUTO_INCREMENT,
  `descripcion` text NOT NULL,
  `id_consecutivo` int unsigned NOT NULL,
  `id_modulo` int unsigned NOT NULL,
  `id_unidad` int unsigned NOT NULL,
  `estatus` varchar(255) NOT NULL,
  `isitem` varchar(255) NOT NULL,
  `opc` varchar(255) NOT NULL,
  `typ` varchar(255) NOT NULL,
  `fecha_creacion` datetime DEFAULT CURRENT_TIMESTAMP,
  `fecha_actualizacion` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_permiso`)
) ENGINE=InnoDB AUTO_INCREMENT=263 DEFAULT CHARSET=utf8mb3;

-- Volcando datos para la tabla todoapp.permisos: ~225 rows (aproximadamente)
INSERT INTO `permisos` (`id_permiso`, `descripcion`, `id_consecutivo`, `id_modulo`, `id_unidad`, `estatus`, `isitem`, `opc`, `typ`, `fecha_creacion`, `fecha_actualizacion`) VALUES
	(1, 'Bienvenida', 1, 0, 0, '1', 'M', '1', '', '2025-04-17 14:47:29', '2025-04-17 14:47:29'),
	(2, 'Intrdouccion', 2, 0, 0, '1', 'M', '2', '', '2025-04-17 14:47:29', '2025-04-17 14:47:29'),
	(3, 'Temario del curso', 3, 0, 0, '1', 'M', '3', '', '2025-04-17 14:47:29', '2025-04-17 14:47:29'),
	(4, 'Objetivo 1 1 Introducción al programa antizombie', 4, 1, 1, '1', 'M', '1', '', '2025-04-17 14:47:29', '2025-04-17 14:47:29'),
	(5, 'Conoce el Programa Antizombie', 5, 1, 1, '1', 'U', '1', '', '2025-04-17 14:47:29', '2025-04-17 14:47:29'),
	(6, 'Antecedentes del Programa', 6, 1, 1, '1', 'U', '2', '', '2025-04-17 14:47:29', '2025-04-17 14:47:29'),
	(7, '¿Qué es un Zombie?', 7, 1, 1, '1', 'U', '3', '', '2025-04-17 14:47:29', '2025-04-17 14:47:29'),
	(8, 'Definición de Zombie', 8, 1, 1, '1', 'U', '4', '', '2025-04-17 14:47:29', '2025-04-17 14:47:29'),
	(9, 'Diagnóstico para conocer ¿Qué tan muerto viviente eres?', 9, 1, 1, '1', 'A', '1', 'check', '2025-04-17 14:47:29', '2025-04-17 14:47:29'),
	(10, 'El diagnóstico final', 10, 1, 1, '1', 'U', '101', '', '2025-04-17 14:47:29', '2025-04-17 14:47:29'),
	(11, 'Identifica tus Virtudes', 11, 1, 1, '1', 'A', '14', 'input', '2025-04-17 14:47:29', '2025-04-17 14:47:29'),
	(12, 'Ya estás listo para empezar con la cura', 12, 1, 1, '1', 'U', '5', '', '2025-04-17 14:47:29', '2025-04-17 14:47:29'),
	(13, '¿Qué tanto te conoces?', 13, 1, 2, '1', 'U', '1', '', '2025-04-17 14:47:29', '2025-04-17 14:47:29'),
	(14, '¿En qué consiste el Análisis Personal Profundo?', 14, 1, 2, '1', 'U', '2', '', '2025-04-17 14:47:29', '2025-04-17 14:47:29'),
	(15, '¿Quién soy ahora y quién quiero ser?', 15, 1, 2, '1', 'U', '3', '', '2025-04-17 14:47:29', '2025-04-17 14:47:29'),
	(16, 'Ejercicio 1 FODA', 16, 1, 2, '1', 'A', '2', 'input', '2025-04-17 14:47:29', '2025-04-17 14:47:29'),
	(17, 'Tu tiempo de vida', 17, 1, 2, '1', 'U', '4', '', '2025-04-17 14:47:29', '2025-04-17 14:47:29'),
	(18, 'Esferas', 18, 1, 2, '1', 'A', '3', 'input', '2025-04-17 14:47:29', '2025-04-17 14:47:29'),
	(19, 'La importancia de una buena actitud', 19, 1, 2, '1', 'U', '5', '', '2025-04-17 14:47:29', '2025-04-17 14:47:29'),
	(20, '¿Cómo afectan las emociones a nuestro cuerpo?', 20, 1, 3, '1', 'U', '1', '', '2025-04-17 14:47:29', '2025-04-17 14:47:29'),
	(21, 'Todo pasa en nuestro interior', 21, 1, 3, '1', 'U', '2', '', '2025-04-17 14:47:29', '2025-04-17 14:47:29'),
	(22, 'Los químicos de nuestro cuerpo', 22, 1, 3, '1', 'U', '3', '', '2025-04-17 14:47:29', '2025-04-17 14:47:29'),
	(23, 'Lo que pones de tu parte', 23, 1, 3, '1', 'A', '5', 'cmbSiNo', '2025-04-17 14:47:29', '2025-04-17 14:47:29'),
	(24, 'La imagen personal', 24, 1, 3, '1', 'U', '4', '', '2025-04-17 14:47:29', '2025-04-17 14:47:29'),
	(25, 'Manejo de imagen o frivolidad', 25, 1, 3, '1', 'A', '4', 'cmb', '2025-04-17 14:47:29', '2025-04-17 14:47:29'),
	(26, 'El diagnóstico y la solución', 26, 1, 3, '1', 'U', '5', '', '2025-04-17 14:47:29', '2025-04-17 14:47:29'),
	(27, 'Evaluación del Módulo 1', 27, 1, 1, '1', 'E', '1', '', '2025-04-17 14:47:29', '2025-04-17 14:47:29'),
	(30, 'Objetivo 11  2 El Bullying en tu vida', 30, 11, 20, '1', 'M', '1', '', '2025-04-17 14:47:29', '2025-04-17 14:47:29'),
	(31, 'Introdccion al bullung', 31, 11, 20, '1', 'U', '1', '', '2025-04-17 14:47:29', '2025-04-17 14:47:29'),
	(32, 'Que es el ciclo del bullung', 32, 11, 20, '1', 'U', '2', '', '2025-04-17 14:47:29', '2025-04-17 14:47:29'),
	(33, 'El autobullying', 33, 11, 20, '1', 'A', '28', 'areaPorPregunta', '2025-04-17 14:47:29', '2025-04-17 14:47:29'),
	(34, 'Mi proyecto para combatir el bullyng en mi comunidad', 34, 11, 20, '1', 'A', '35', 'areaPorPregunta', '2025-04-17 14:47:29', '2025-04-17 14:47:29'),
	(35, 'Conviértete en agente del cambio', 35, 11, 20, '1', 'U', '3', '', '2025-04-17 14:47:29', '2025-04-17 14:47:29'),
	(36, 'Evaluación del Módulo 2', 36, 2, 1, '1', 'E', '2', '', '2025-04-17 14:47:29', '2025-04-17 14:47:29'),
	(40, 'Objetivo  2  3 Conectando con los sentimientos', 40, 2, 4, '1', 'M', '1', '', '2025-04-17 14:47:29', '2025-04-17 14:47:29'),
	(41, 'Introducción al Autoconocimiento', 41, 2, 4, '1', 'U', '1', '', '2025-04-17 14:47:29', '2025-04-17 14:47:29'),
	(42, '¿Qué es el Autoconocimiento?', 42, 2, 4, '1', 'U', '2', '', '2025-04-17 14:47:29', '2025-04-17 14:47:29'),
	(43, 'Es un Proceso de Vida', 43, 2, 4, '1', 'U', '3', '', '2025-04-17 14:47:29', '2025-04-17 14:47:29'),
	(44, 'Proceso constante de vida', 44, 2, 4, '1', 'U', '4', '', '2025-04-17 14:47:29', '2025-04-17 14:47:29'),
	(45, 'EL IKIGAI', 45, 2, 4, '1', 'A', '6', 'areaPorPregunta', '2025-04-17 14:47:29', '2025-04-17 14:47:29'),
	(46, 'Ventana de Johari', 46, 2, 4, '1', 'A', '7', 'areaPorPregunta', '2025-04-17 14:47:29', '2025-04-17 14:47:29'),
	(47, 'Virtudes SMART', 47, 2, 4, '1', 'A', '8', 'areaPorPregunta', '2025-04-17 14:47:29', '2025-04-17 14:47:29'),
	(48, 'El Beneficio de conocerte', 48, 2, 4, '1', 'U', '5', '', '2025-04-17 14:47:29', '2025-04-17 14:47:29'),
	(49, 'La Importancia del Autoconocimiento', 49, 2, 4, '1', 'U', '6', '', '2025-04-17 14:47:29', '2025-04-17 14:47:29'),
	(50, 'Tu árbol de la vida', 50, 2, 5, '1', 'U', '1', '', '2025-04-17 14:47:29', '2025-04-17 14:47:29'),
	(51, 'El Árbol de la Vida', 51, 2, 5, '1', 'U', '2', '', '2025-04-17 14:47:29', '2025-04-17 14:47:29'),
	(52, 'Cuál es tu motor y hacia donde te dirige?', 52, 2, 5, '1', 'A', '9', 'areaPorPregunta', '2025-04-17 14:47:29', '2025-04-17 14:47:29'),
	(53, '6 Pasos de tu Árbol de la vida', 53, 2, 5, '1', 'U', '3', '', '2025-04-17 14:47:29', '2025-04-17 14:47:29'),
	(54, 'Consejos de un Árbol', 54, 2, 5, '1', 'U', '4', '', '2025-04-17 14:47:29', '2025-04-17 14:47:29'),
	(55, 'Evaluación del Módulo 3', 55, 3, 5, '1', 'E', '3', '', '2025-04-17 14:47:29', '2025-04-17 14:47:29'),
	(60, 'Tu lugar en el Universo', 60, 3, 6, '1', 'M', '1', '', '2025-04-17 14:47:29', '2025-04-17 14:47:29'),
	(61, 'Objetivo  3 4. Presencia en el entorno', 61, 3, 6, '1', 'M', '2', '', '2025-04-17 14:47:29', '2025-04-17 14:47:29'),
	(62, 'Entornos del ser Humano', 62, 3, 6, '1', 'U', '1', '', '2025-04-17 14:47:29', '2025-04-17 14:47:29'),
	(63, 'Familia, Escuela, Sociedad', 63, 3, 6, '1', 'U', '2', '', '2025-04-17 14:47:29', '2025-04-17 14:47:29'),
	(64, 'Entornos controlables', 64, 3, 6, '1', 'U', '3', '', '2025-04-17 14:47:29', '2025-04-17 14:47:29'),
	(65, 'Niveles de control', 65, 3, 6, '1', 'U', '4', '', '2025-04-17 14:47:29', '2025-04-17 14:47:29'),
	(66, 'Entornos fuera del área de control', 66, 3, 6, '1', 'U', '5', '', '2025-04-17 14:47:29', '2025-04-17 14:47:29'),
	(67, 'Yo, mi medio y sociabilidad', 67, 3, 6, '1', 'U', '6', '', '2025-04-17 14:47:29', '2025-04-17 14:47:29'),
	(68, 'La isla', 68, 3, 6, '1', 'A', '10', 'areaPorPregunta', '2025-04-17 14:47:29', '2025-04-17 14:47:29'),
	(69, '¿Qué hago con mis emociones?', 69, 3, 7, '1', 'U', '1', '', '2025-04-17 14:47:29', '2025-04-17 14:47:29'),
	(70, 'El Propósito de las Emociones', 70, 3, 7, '1', 'U', '2', '', '2025-04-17 14:47:29', '2025-04-17 14:47:29'),
	(71, 'Las Emociones y su Propósito', 71, 3, 7, '1', 'U', '3', '', '2025-04-17 14:47:29', '2025-04-17 14:47:29'),
	(72, '¿Qué son las emociones y de dónde vienen?', 72, 3, 7, '1', 'U', '4', '', '2025-04-17 14:47:29', '2025-04-17 14:47:29'),
	(73, '¿Qué son y de dónde vienen las emociones?', 73, 3, 7, '1', 'U', '5', '', '2025-04-17 14:47:29', '2025-04-17 14:47:29'),
	(74, 'Experiencia y análisis de las emociones Etapa 1', 74, 3, 7, '1', 'A', '11', 'areaPorPregunta', '2025-04-17 14:47:29', '2025-04-17 14:47:29'),
	(75, 'Entendiendo las emociones', 75, 3, 7, '1', 'U', '6', '', '2025-04-17 14:47:29', '2025-04-17 14:47:29'),
	(76, 'La Ruta de las Emociones', 76, 3, 7, '1', 'U', '7', '', '2025-04-17 14:47:29', '2025-04-17 14:47:29'),
	(77, 'Experiencia y análisis de las emociones Etapa 2', 77, 3, 7, '1', 'A', '12', 'check', '2025-04-17 14:47:29', '2025-04-17 14:47:29'),
	(78, 'La Inteligencia emocional', 78, 3, 8, '1', 'U', '1', '', '2025-04-17 14:47:29', '2025-04-17 14:47:29'),
	(79, '¿Qué tipo de inteligencia tienes?', 79, 3, 8, '1', 'U', '2', '', '2025-04-17 14:47:29', '2025-04-17 14:47:29'),
	(80, '¿Qué es inteligencia múltiple y emocional?', 80, 3, 8, '1', 'U', '3', '', '2025-04-17 14:47:29', '2025-04-17 14:47:29'),
	(81, 'Inteligencias Múltiples Etapa 1', 81, 3, 8, '1', 'A', '13', 'check', '2025-04-17 14:47:29', '2025-04-17 14:47:29'),
	(82, 'Desarrolla tu nivel de inteligencia emocional', 82, 3, 8, '1', 'U', '4', '', '2025-04-17 14:47:29', '2025-04-17 14:47:29'),
	(83, 'Inteligencia múltiple y emocional', 83, 3, 8, '1', 'U', '5', '', '2025-04-17 14:47:29', '2025-04-17 14:47:29'),
	(84, 'Inteligencias Múltiples Etapa 2', 84, 3, 8, '1', 'A', '15', 'check', '2025-04-17 14:47:29', '2025-04-17 14:47:29'),
	(85, 'Conócete Mejor', 85, 3, 8, '1', 'U', '6', '', '2025-04-17 14:47:29', '2025-04-17 14:47:29'),
	(86, 'Evaluación del Módulo 4', 86, 4, 8, '1', 'E', '4', '', '2025-04-17 14:47:29', '2025-04-17 14:47:29'),
	(90, 'Objetivo', 90, 5, 11, '1', 'M', '1', '', '2025-04-17 14:47:29', '2025-04-17 14:47:29'),
	(91, 'Tarea que todos tenemos que hacer', 91, 5, 11, '1', 'U', '1', '', '2025-04-17 14:47:29', '2025-04-17 14:47:29'),
	(92, 'Tarea de todos los tiempos', 92, 5, 11, '1', 'U', '2', '', '2025-04-17 14:47:29', '2025-04-17 14:47:29'),
	(93, '¿Qué es el autocontrol?', 93, 5, 11, '1', 'U', '3', '', '2025-04-17 14:47:29', '2025-04-17 14:47:29'),
	(94, 'Definición de autocontrol', 94, 5, 11, '1', 'U', '4', '', '2025-04-17 14:47:29', '2025-04-17 14:47:29'),
	(95, 'Otro punto atención otra emoción', 95, 5, 11, '1', 'U', '5', '', '2025-04-17 14:47:29', '2025-04-17 14:47:29'),
	(96, 'Gestón del foco de atención', 96, 5, 11, '1', 'U', '6', '', '2025-04-17 14:47:29', '2025-04-17 14:47:29'),
	(97, 'Enojo: emoción difícil de manejar', 97, 5, 11, '1', 'U', '7', '', '2025-04-17 14:47:29', '2025-04-17 14:47:29'),
	(98, 'La anatomía del enojo', 98, 5, 11, '1', 'U', '8', '', '2025-04-17 14:47:29', '2025-04-17 14:47:29'),
	(99, 'La reacción a la emoción es enseñable', 99, 5, 11, '1', 'U', '9', '', '2025-04-17 14:47:29', '2025-04-17 14:47:29'),
	(100, 'Herramientas de autocontrol', 100, 5, 11, '1', 'U', '10', '', '2025-04-17 14:47:29', '2025-04-17 14:47:29'),
	(101, 'Prevención: Reflexionar para anticipar', 101, 5, 11, '1', 'U', '11', '', '2025-04-17 14:47:29', '2025-04-17 14:47:29'),
	(102, 'Fórmula preventiva', 102, 5, 11, '1', 'U', '12', '', '2025-04-17 14:47:29', '2025-04-17 14:47:29'),
	(103, 'Haz tu propia fórmula', 103, 5, 11, '1', 'A', '18', 'check', '2025-04-17 14:47:29', '2025-04-17 14:47:29'),
	(104, 'Práctica de conteo', 104, 5, 11, '1', 'A', '19', 'check', '2025-04-17 14:47:29', '2025-04-17 14:47:29'),
	(105, 'Rutinas como herramientas', 105, 5, 11, '1', 'U', '13', '', '2025-04-17 14:47:29', '2025-04-17 14:47:29'),
	(106, 'Rutinas de autocontrol', 106, 5, 11, '1', 'U', '14', '', '2025-04-17 14:47:29', '2025-04-17 14:47:29'),
	(107, 'Inicia tu plan de acción', 107, 4, 9, '1', 'U', '1', '', '2025-04-17 14:47:29', '2025-04-17 14:47:29'),
	(108, 'Plan de acción para alcanzar el éxito', 108, 4, 9, '1', 'U', '2', '', '2025-04-17 14:47:29', '2025-04-17 14:47:29'),
	(109, 'Trabaja en tu día a día', 109, 4, 9, '1', 'U', '3', '', '2025-04-17 14:47:29', '2025-04-17 14:47:29'),
	(110, 'La Integración con la herramienta', 110, 4, 9, '1', 'U', '4', '', '2025-04-17 14:47:29', '2025-04-17 14:47:29'),
	(111, 'Elige la recompensa adecuada', 111, 4, 9, '1', 'A', '16', 'check', '2025-04-17 14:47:29', '2025-04-17 14:47:29'),
	(112, 'Descarga la APP', 112, 4, 10, '1', 'A', '17', 'check', '2025-04-17 14:47:29', '2025-04-17 14:47:29'),
	(113, 'Conoce la APP ¿Soy Zombie?', 113, 4, 10, '1', 'U', '1', '', '2025-04-17 14:47:29', '2025-04-17 14:47:29'),
	(114, 'Conclusión de autocontrol', 114, 5, 11, '1', 'M', '2', '', '2025-04-17 14:47:29', '2025-04-17 14:47:29'),
	(115, 'Evaluación del Módulo 5', 115, 5, 11, '1', 'E', '5', '', '2025-04-17 14:47:29', '2025-04-17 14:47:29'),
	(120, 'te comparto mis experiencias y aprendizaje', 120, 6, 12, '1', 'M', '1', '', '2025-04-17 14:47:29', '2025-04-17 14:47:29'),
	(121, 'Te doy una coidial bienvenida', 121, 6, 12, '1', 'M', '2', '', '2025-04-17 14:47:29', '2025-04-17 14:47:29'),
	(122, 'la importancia de tomar de diciiones', 122, 6, 12, '1', 'U', '1', '', '2025-04-17 14:47:29', '2025-04-17 14:47:29'),
	(123, 'el camino para tomar decisiones', 123, 6, 12, '1', 'U', '2', '', '2025-04-17 14:47:29', '2025-04-17 14:47:29'),
	(124, 'el objetivo', 124, 6, 12, '1', 'U', '3', '', '2025-04-17 14:47:29', '2025-04-17 14:47:29'),
	(125, 'la tecnica', 125, 6, 12, '1', 'U', '4', '', '2025-04-17 14:47:29', '2025-04-17 14:47:29'),
	(126, 'tienes el control', 126, 6, 12, '1', 'U', '5', '', '2025-04-17 14:47:29', '2025-04-17 14:47:29'),
	(127, 'el procesio de la reflexion', 127, 6, 12, '1', 'U', '6', '', '2025-04-17 14:47:29', '2025-04-17 14:47:29'),
	(128, 'la eleccion correcta', 128, 6, 12, '1', 'U', '7', '', '2025-04-17 14:47:29', '2025-04-17 14:47:29'),
	(129, 'eleccion de opciones', 129, 6, 12, '1', 'U', '8', '', '2025-04-17 14:47:29', '2025-04-17 14:47:29'),
	(130, 'tipos de pensamiento', 130, 6, 12, '1', 'U', '9', '', '2025-04-17 14:47:29', '2025-04-17 14:47:29'),
	(131, 'el juicio de valor ', 131, 6, 12, '1', 'U', '10', '', '2025-04-17 14:47:29', '2025-04-17 14:47:29'),
	(132, 'Autoanálisis toma de decisiones', 132, 6, 12, '1', 'A', '20', 'check', '2025-04-17 14:47:29', '2025-04-17 14:47:29'),
	(133, 'la importancia del pensamiento critico', 133, 6, 13, '1', 'U', '1', '', '2025-04-17 14:47:29', '2025-04-17 14:47:29'),
	(134, 'los posibles escenarios', 134, 6, 13, '1', 'U', '2', '', '2025-04-17 14:47:29', '2025-04-17 14:47:29'),
	(135, 'El riesgo, certidumbre e incertumbre', 135, 6, 13, '1', 'U', '3', '', '2025-04-17 14:47:29', '2025-04-17 14:47:29'),
	(136, '¿Cómo se toma una decisión?', 136, 6, 13, '1', 'U', '4', '', '2025-04-17 14:47:29', '2025-04-17 14:47:29'),
	(137, 'que es urgente y que es importante', 137, 6, 14, '1', 'U', '1', '', '2025-04-17 14:47:29', '2025-04-17 14:47:29'),
	(138, 'Primero lo primero', 138, 6, 14, '1', 'U', '2', '', '2025-04-17 14:47:29', '2025-04-17 14:47:29'),
	(139, 'Clasificación de importante contra urgente', 139, 6, 14, '1', 'A', '22', 'check', '2025-04-17 14:47:29', '2025-04-17 14:47:29'),
	(140, 'ahora ya saves tomar deciciones', 140, 6, 14, '1', 'U', '3', '', '2025-04-17 14:47:29', '2025-04-17 14:47:29'),
	(141, 'que es acertividad', 141, 6, 15, '1', 'U', '1', '', '2025-04-17 14:47:29', '2025-04-17 14:47:29'),
	(142, 'Significado de asertividad', 142, 6, 15, '1', 'U', '2', '', '2025-04-17 14:47:29', '2025-04-17 14:47:29'),
	(143, 'Saber decir NO', 143, 6, 15, '1', 'U', '3', '', '2025-04-17 14:47:29', '2025-04-17 14:47:29'),
	(144, 'objetivo', 144, 6, 15, '1', 'U', '4', '', '2025-04-17 14:47:29', '2025-04-17 14:47:29'),
	(145, 'Etimología y significado', 145, 6, 15, '1', 'U', '5', '', '2025-04-17 14:47:29', '2025-04-17 14:47:29'),
	(146, 'Autoevaluación de asertividad', 146, 6, 15, '1', 'A', '23', 'check', '2025-04-17 14:47:29', '2025-04-17 14:47:29'),
	(147, 'los roles en los procesos de comunicacion', 147, 6, 15, '1', 'U', '6', '', '2025-04-17 14:47:29', '2025-04-17 14:47:29'),
	(148, 'Asertividad y comunicación – diferentes role', 148, 6, 15, '1', 'U', '7', '', '2025-04-17 14:47:29', '2025-04-17 14:47:29'),
	(149, 'atrevete a ser asertivo', 149, 6, 15, '1', 'U', '8', '', '2025-04-17 14:47:29', '2025-04-17 14:47:29'),
	(150, 'Los Factores que inhiben la asertividad', 150, 6, 15, '1', 'U', '9', '', '2025-04-17 14:47:29', '2025-04-17 14:47:29'),
	(151, 'Los Beneficios de la asertivida', 151, 6, 15, '1', 'U', '10', '', '2025-04-17 14:47:29', '2025-04-17 14:47:29'),
	(152, 'Evaluación Modulo 6', 152, 6, 15, '1', 'E', '6', '', '2025-04-17 14:47:29', '2025-04-17 14:47:29'),
	(160, 'Introducción a la empatía', 160, 7, 16, '1', 'M', '1', '', '2025-04-17 14:47:29', '2025-04-17 14:47:29'),
	(161, 'Objetivos y temario de la empatía  7    7. La empatía y tu rutina', 161, 7, 16, '1', 'M', '2', '', '2025-04-17 14:47:29', '2025-04-17 14:47:29'),
	(162, 'Definición de empatía', 162, 7, 16, '1', 'U', '1', '', '2025-04-17 14:47:29', '2025-04-17 14:47:29'),
	(163, 'El poder de la empatía', 163, 7, 16, '1', 'U', '2', '', '2025-04-17 14:47:29', '2025-04-17 14:47:29'),
	(164, 'Exploremos más allá de la definición', 164, 7, 16, '1', 'U', '3', '', '2025-04-17 14:47:29', '2025-04-17 14:47:29'),
	(165, 'Teorías de la empatía', 165, 7, 16, '1', 'U', '4', '', '2025-04-17 14:47:29', '2025-04-17 14:47:29'),
	(166, 'Conectarse: primer paso de la empatía', 166, 7, 16, '1', 'A', '24', 'check', '2025-04-17 14:47:29', '2025-04-17 14:47:29'),
	(167, '¿Oso, zorro o jirafa. ¿ Cuál eres tu? ', 167, 7, 16, '1', 'U', '5', '', '2025-04-17 14:47:29', '2025-04-17 14:47:29'),
	(168, 'El oso, zorro y jirafa', 168, 7, 16, '1', 'U', '6', '', '2025-04-17 14:47:29', '2025-04-17 14:47:29'),
	(169, 'Reflexiones del video', 169, 7, 16, '1', 'U', '7', '', '2025-04-17 14:47:29', '2025-04-17 14:47:29'),
	(170, 'Brené Brown y la empatía', 170, 7, 16, '1', 'U', '8', '', '2025-04-17 14:47:29', '2025-04-17 14:47:29'),
	(171, 'Características de la gente empática ', 171, 7, 16, '1', 'U', '9', '', '2025-04-17 14:47:29', '2025-04-17 14:47:29'),
	(172, '¿Tienes atributos  de empatía? ', 172, 7, 16, '1', 'U', '10', '', '2025-04-17 14:47:29', '2025-04-17 14:47:29'),
	(173, 'Los 6 atributos de la empatía ', 173, 7, 16, '1', 'U', '11', '', '2025-04-17 14:47:29', '2025-04-17 14:47:29'),
	(174, 'Estaba equivocada', 174, 7, 16, '1', 'U', '12', '', '2025-04-17 14:47:29', '2025-04-17 14:47:29'),
	(175, 'Empatía vs. Simpatía ', 175, 7, 16, '1', 'U', '13', '', '2025-04-17 14:47:29', '2025-04-17 14:47:29'),
	(176, '"Desde donde se habla en la empatía', 176, 7, 16, '1', 'U', '14', '', '2025-04-17 14:47:29', '2025-04-17 14:47:29'),
	(177, 'Mensaje tú y mensajes yo', 177, 7, 16, '1', 'U', '15', '', '2025-04-17 14:47:29', '2025-04-17 14:47:29'),
	(178, 'La empatía y la perspectiva ', 178, 7, 16, '1', 'U', '16', '', '2025-04-17 14:47:29', '2025-04-17 14:47:29'),
	(179, 'La empatía, emociones y perspectiva ', 179, 7, 16, '1', 'U', '17', '', '2025-04-17 14:47:29', '2025-04-17 14:47:29'),
	(180, 'Conclusiones de la empatía ', 180, 7, 16, '1', 'U', '18', '', '2025-04-17 14:47:29', '2025-04-17 14:47:29'),
	(181, '¿Qué haces todos los días?', 181, 7, 17, '1', 'U', '1', '', '2025-04-17 14:47:29', '2025-04-17 14:47:29'),
	(182, 'Tu rutina, frente a una rutina feliz', 182, 7, 17, '1', 'U', '2', '', '2025-04-17 14:47:29', '2025-04-17 14:47:29'),
	(183, 'Priorización de actividades', 183, 7, 16, '1', 'A', '25', 'check', '2025-04-17 14:47:29', '2025-04-17 14:47:29'),
	(184, 'Diferencia entre rutinas', 184, 7, 17, '1', 'U', '3', '', '2025-04-17 14:47:29', '2025-04-17 14:47:29'),
	(185, 'Evaluación Modulo 7', 185, 7, 17, '1', 'E', '7', '', '2025-04-17 14:47:29', '2025-04-17 14:47:29'),
	(190, 'Portada, Objetivo, temario  8  8. Habilidades sociales y manejo de conflictos', 190, 8, 18, '1', 'M', '1', '', '2025-04-17 14:47:29', '2025-04-17 14:47:29'),
	(191, 'Habilidades sociales anécdota', 191, 8, 18, '1', 'U', '1', '', '2025-04-17 14:47:29', '2025-04-17 14:47:29'),
	(192, 'Portada y definición', 192, 8, 18, '1', 'U', '2', '', '2025-04-17 14:47:29', '2025-04-17 14:47:29'),
	(193, 'Habilidades sociales para qué sirven, básicas, avanzadas, afectivas, de autocontrol y conclusión', 193, 8, 18, '1', 'U', '3', '', '2025-04-17 14:47:29', '2025-04-17 14:47:29'),
	(194, 'Habilidades sociales básicas', 194, 8, 18, '1', 'U', '4', '', '2025-04-17 14:47:29', '2025-04-17 14:47:29'),
	(195, 'Habilidades sociales avanzadas', 195, 8, 18, '1', 'U', '5', '', '2025-04-17 14:47:29', '2025-04-17 14:47:29'),
	(196, 'Habilidades sociales afectivas', 196, 8, 18, '1', 'U', '6', '', '2025-04-17 14:47:29', '2025-04-17 14:47:29'),
	(197, 'Habilidades sociales de autocontro', 197, 8, 18, '1', 'U', '7', '', '2025-04-17 14:47:29', '2025-04-17 14:47:29'),
	(198, 'Inventario de habilidades sociales', 198, 8, 18, '1', 'A', '26', 'check', '2025-04-17 14:47:29', '2025-04-17 14:47:29'),
	(199, 'Manejo de conflictos, objetivo, temario, definición y por qué surge', 199, 8, 19, '1', 'U', '1', '', '2025-04-17 14:47:29', '2025-04-17 14:47:29'),
	(200, 'Introducción, objetivo, temario, definición y por qué surge', 200, 8, 19, '1', 'U', '2', '', '2025-04-17 14:47:29', '2025-04-17 14:47:29'),
	(201, 'Complementa el video anterior', 201, 8, 19, '1', 'U', '3', '', '2025-04-17 14:47:29', '2025-04-17 14:47:29'),
	(202, 'Tipos de conflicto y formas de actuar ', 202, 8, 19, '1', 'U', '4', '', '2025-04-17 14:47:29', '2025-04-17 14:47:29'),
	(203, 'Tipos de conflicto', 203, 8, 19, '1', 'U', '5', '', '2025-04-17 14:47:29', '2025-04-17 14:47:29'),
	(204, 'Formas de actuar – competitivo ', 204, 8, 19, '1', 'U', '6', '', '2025-04-17 14:47:29', '2025-04-17 14:47:29'),
	(205, 'Formas de actuar -  complaciente', 205, 8, 19, '1', 'U', '7', '', '2025-04-17 14:47:29', '2025-04-17 14:47:29'),
	(206, 'Formas de actuar – evasivo', 206, 8, 19, '1', 'U', '8', '', '2025-04-17 14:47:29', '2025-04-17 14:47:29'),
	(207, 'Formas de actuar - colaborativo ', 207, 8, 19, '1', 'U', '9', '', '2025-04-17 14:47:29', '2025-04-17 14:47:29'),
	(208, 'Formas de actuar – transigir', 208, 8, 19, '1', 'U', '10', '', '2025-04-17 14:47:29', '2025-04-17 14:47:29'),
	(209, 'Manejo adecuado del conflicto ', 209, 8, 19, '1', 'U', '11', '', '2025-04-17 14:47:29', '2025-04-17 14:47:29'),
	(210, 'Manejo adecuado del conflicto ', 210, 8, 19, '1', 'U', '12', '', '2025-04-17 14:47:29', '2025-04-17 14:47:29'),
	(211, 'Negociación y los cuatro cuadrantes ', 211, 8, 19, '1', 'U', '13', '', '2025-04-17 14:47:29', '2025-04-17 14:47:29'),
	(212, 'Negociación y los cuatro cuadrantes ', 212, 8, 19, '1', 'U', '14', '', '2025-04-17 14:47:29', '2025-04-17 14:47:29'),
	(213, 'Habilidades, características, la mediación y resumen', 213, 8, 19, '1', 'U', '15', '', '2025-04-17 14:47:29', '2025-04-17 14:47:29'),
	(214, 'Negociación ganar-perder', 214, 8, 19, '1', 'U', '16', '', '2025-04-17 14:47:29', '2025-04-17 14:47:29'),
	(215, 'Negociación perder-perder ', 215, 8, 19, '1', 'U', '17', '', '2025-04-17 14:47:29', '2025-04-17 14:47:29'),
	(216, 'Negociación perder-ganar', 216, 8, 19, '1', 'U', '18', '', '2025-04-17 14:47:29', '2025-04-17 14:47:29'),
	(217, 'Características de un buen negociador', 217, 8, 19, '1', 'U', '19', '', '2025-04-17 14:47:29', '2025-04-17 14:47:29'),
	(218, 'Manejo de conflictos - el mediador y conclusión ', 218, 8, 19, '1', 'U', '20', '', '2025-04-17 14:47:29', '2025-04-17 14:47:29'),
	(219, 'Introducción al bullying', 219, 8, 20, '1', 'U', '1', '', '2025-04-17 14:47:29', '2025-04-17 14:47:29'),
	(220, '¿Qué es el círculo del bullying? ', 220, 8, 20, '1', 'U', '2', '', '2025-04-17 14:47:29', '2025-04-17 14:47:29'),
	(221, 'Inventario de habilidades sociales', 221, 8, 20, '1', 'A', '28', 'check', '2025-04-17 14:47:29', '2025-04-17 14:47:29'),
	(222, 'Conviértete en agente del cambio', 222, 8, 20, '1', 'U', '3', '', '2025-04-17 14:47:29', '2025-04-17 14:47:29'),
	(223, 'Evaluación Modulo 8', 223, 8, 20, '1', 'E', '8', '', '2025-04-17 14:47:29', '2025-04-17 14:47:29'),
	(230, 'Introducción a la automotivación. Yo soy mi equipo', 230, 9, 21, '1', 'M', '1', '', '2025-04-17 14:47:29', '2025-04-17 14:47:29'),
	(231, 'Objetivos y temario de la automotivación 9  9. La automotivación', 231, 9, 21, '1', 'M', '2', '', '2025-04-17 14:47:29', '2025-04-17 14:47:29'),
	(232, 'La automotivación: discurso para ponerte en acción', 232, 9, 21, '1', 'U', '1', '', '2025-04-17 14:47:29', '2025-04-17 14:47:29'),
	(233, '¿Qué es la automotivación?', 233, 9, 21, '1', 'U', '2', '', '2025-04-17 14:47:29', '2025-04-17 14:47:29'),
	(234, '¿Qué líder no motiva a su equipo?', 234, 9, 21, '1', 'U', '3', '', '2025-04-17 14:47:29', '2025-04-17 14:47:29'),
	(235, 'Otimismo aprendido', 235, 9, 21, '1', 'U', '4', '', '2025-04-17 14:47:29', '2025-04-17 14:47:29'),
	(236, 'Martin Selligman', 236, 9, 21, '1', 'U', '5', '', '2025-04-17 14:47:29', '2025-04-17 14:47:29'),
	(237, 'Del fracaso también se aprende: 3Ps', 237, 9, 21, '1', 'U', '6', '', '2025-04-17 14:47:29', '2025-04-17 14:47:29'),
	(238, 'No te des por vencido', 238, 9, 21, '1', 'A', '29', 'check', '2025-04-17 14:47:29', '2025-04-17 14:47:29'),
	(239, 'Haz tu propia pirámide', 239, 9, 21, '1', 'A', '30', 'check', '2025-04-17 14:47:29', '2025-04-17 14:47:29'),
	(240, 'Identificar qué hábitos no tengo y cómo me comprometo a adquirirlos', 240, 9, 21, '1', 'A', '31', 'check', '2025-04-17 14:47:29', '2025-04-17 14:47:29'),
	(241, '¿Cómo mantenerme motivado?', 241, 9, 21, '1', 'U', '7', '', '2025-04-17 14:47:29', '2025-04-17 14:47:29'),
	(242, 'Mantener la motivación', 242, 9, 21, '1', 'U', '8', '', '2025-04-17 14:47:29', '2025-04-17 14:47:29'),
	(243, 'Motivación parte de la inteligencia emocional', 243, 9, 21, '1', 'U', '9', '', '2025-04-17 14:47:29', '2025-04-17 14:47:29'),
	(244, 'Conclusiones de la automotivación', 244, 9, 21, '1', 'U', '10', '', '2025-04-17 14:47:29', '2025-04-17 14:47:29'),
	(245, 'Evaluación Modulo 9', 245, 9, 21, '1', 'E', '9', '', '2025-04-17 14:47:29', '2025-04-17 14:47:29'),
	(250, 'Objetivo 10  10. Sé un embajador del cambio', 250, 10, 22, '1', 'M', '1', '', '2025-04-17 14:47:29', '2025-04-17 14:47:29'),
	(251, 'Tu proyecto persobal', 251, 10, 22, '1', 'U', '1', '', '2025-04-17 14:47:29', '2025-04-17 14:47:29'),
	(252, 'Crea tu propio proyexto ', 252, 10, 22, '1', 'U', '2', '', '2025-04-17 14:47:29', '2025-04-17 14:47:29'),
	(253, 'Identificación de obstáculos', 253, 10, 22, '1', 'A', '32', 'check', '2025-04-17 14:47:29', '2025-04-17 14:47:29'),
	(254, 'Trabaja en tu proyecto personal', 254, 10, 22, '1', 'U', '3', '', '2025-04-17 14:47:29', '2025-04-17 14:47:29'),
	(255, 'Empieza a entender el mundo', 255, 10, 23, '1', 'U', '1', '', '2025-04-17 14:47:29', '2025-04-17 14:47:29'),
	(256, 'Amplia tu horizonte', 256, 10, 23, '1', 'U', '2', '', '2025-04-17 14:47:29', '2025-04-17 14:47:29'),
	(257, 'Cuestionario de orientación', 257, 10, 23, '1', 'A', '33', 'check', '2025-04-17 14:47:29', '2025-04-17 14:47:29'),
	(258, 'Emprende tu viaje', 258, 10, 23, '1', 'U', '3', '', '2025-04-17 14:47:29', '2025-04-17 14:47:29'),
	(259, 'Aquí empieza el cambio', 259, 10, 24, '1', 'U', '1', '', '2025-04-17 14:47:29', '2025-04-17 14:47:29'),
	(260, 'Pasa la vacuna ', 260, 10, 24, '1', 'U', '2', '', '2025-04-17 14:47:29', '2025-04-17 14:47:29'),
	(261, 'Acciones concretas para cambiar tu realidad', 261, 10, 24, '1', 'A', '34', 'check', '2025-04-17 14:47:29', '2025-04-17 14:47:29'),
	(262, 'Evaluación Modulo 10', 262, 10, 24, '1', 'E', '10', '', '2025-04-17 14:47:29', '2025-04-17 14:47:29');

-- Volcando estructura para tabla todoapp.permisos_usuarios
CREATE TABLE IF NOT EXISTS `permisos_usuarios` (
  `id_permiso_usuario` int unsigned NOT NULL AUTO_INCREMENT,
  `id_permiso` int unsigned NOT NULL,
  `id_usuario` int unsigned NOT NULL,
  `estado` varchar(5) NOT NULL,
  `fecha_creacion` datetime DEFAULT CURRENT_TIMESTAMP,
  `fecha_actualizacion` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_permiso_usuario`),
  KEY `id_permiso` (`id_permiso`),
  KEY `id_usuario` (`id_usuario`),
  CONSTRAINT `permisos_usuarios_ibfk_1` FOREIGN KEY (`id_permiso`) REFERENCES `permisos` (`id_permiso`),
  CONSTRAINT `permisos_usuarios_ibfk_2` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- Volcando datos para la tabla todoapp.permisos_usuarios: ~0 rows (aproximadamente)

-- Volcando estructura para tabla todoapp.plataforma_permisos
CREATE TABLE IF NOT EXISTS `plataforma_permisos` (
  `id_permiso` int unsigned NOT NULL AUTO_INCREMENT,
  `clave` varchar(100) NOT NULL,
  `descripcion` text,
  `estatus` tinyint DEFAULT '1' COMMENT '1 = activo, 0 = inactivo',
  `fecha_creacion` datetime DEFAULT CURRENT_TIMESTAMP,
  `fecha_actualizacion` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_permiso`),
  UNIQUE KEY `clave` (`clave`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb3;

-- Volcando datos para la tabla todoapp.plataforma_permisos: ~19 rows (aproximadamente)
INSERT INTO `plataforma_permisos` (`id_permiso`, `clave`, `descripcion`, `estatus`, `fecha_creacion`, `fecha_actualizacion`) VALUES
	(1, 'dashboard.view', 'Acceder al panel de control', 1, '2025-04-17 15:18:28', '2025-04-17 15:18:28'),
	(2, 'users.index', 'Ver listado de usuarios', 1, '2025-04-17 15:18:28', '2025-04-17 15:18:28'),
	(3, 'users.create', 'Crear nuevos usuarios', 1, '2025-04-17 15:18:28', '2025-04-17 15:18:28'),
	(4, 'users.edit', 'Editar usuarios existentes', 1, '2025-04-17 15:18:28', '2025-04-17 15:18:28'),
	(5, 'users.delete', 'Eliminar usuarios', 1, '2025-04-17 15:18:28', '2025-04-17 15:18:28'),
	(6, 'roles.index', 'Ver roles', 1, '2025-04-17 15:18:28', '2025-04-17 15:18:28'),
	(7, 'roles.assign', 'Asignar roles a usuarios', 1, '2025-04-17 15:18:28', '2025-04-17 15:18:28'),
	(8, 'courses.index', 'Ver cursos', 1, '2025-04-17 15:18:28', '2025-04-17 15:18:28'),
	(9, 'courses.create', 'Crear cursos', 1, '2025-04-17 15:18:28', '2025-04-17 15:18:28'),
	(10, 'courses.edit', 'Editar cursos', 1, '2025-04-17 15:18:28', '2025-04-17 15:18:28'),
	(11, 'courses.delete', 'Eliminar cursos', 1, '2025-04-17 15:18:28', '2025-04-17 15:18:28'),
	(12, 'courses.publish', 'Publicar cursos', 1, '2025-04-17 15:18:28', '2025-04-17 15:18:28'),
	(13, 'students.index', 'Ver listado de alumnos', 1, '2025-04-17 15:18:28', '2025-04-17 15:18:28'),
	(14, 'students.edit', 'Editar alumnos', 1, '2025-04-17 15:18:28', '2025-04-17 15:18:28'),
	(15, 'memberships.manage', 'Gestionar membresías', 1, '2025-04-17 15:18:28', '2025-04-17 15:18:28'),
	(16, 'reports.view', 'Acceder a reportes del sistema', 1, '2025-04-17 15:18:28', '2025-04-17 15:18:28'),
	(17, 'teachers.index', 'Ver listao de profesores', 1, '2025-04-29 07:42:26', '2025-04-29 07:42:26'),
	(18, 'teachers.create', 'Crear profesor', 1, '2025-04-29 07:42:45', '2025-04-29 07:43:08'),
	(19, 'teachers.edit', 'Editar profesor', 1, '2025-04-29 07:42:56', '2025-04-29 07:42:58');

-- Volcando estructura para tabla todoapp.profesores
CREATE TABLE IF NOT EXISTS `profesores` (
  `id_profesor` int unsigned NOT NULL AUTO_INCREMENT COMMENT 'Identificador único del profesor',
  `id_usuario` int unsigned NOT NULL COMMENT 'Referencia al usuario general en la tabla usuarios',
  `nombre` varchar(255) NOT NULL COMMENT 'Nombre del profesor',
  `apellido_p` varchar(255) NOT NULL COMMENT 'Apellido paternon del profesor',
  `apellido_m` varchar(255) NOT NULL COMMENT 'Apellido materno del profesor',
  `especialidad` varchar(255) DEFAULT NULL COMMENT 'Área de especialidad o enfoque académico',
  `biografia` text COMMENT 'Descripción del perfil o trayectoria del profesor',
  `avatar` varchar(255) DEFAULT NULL COMMENT 'Ruta o URL de la imagen de perfil',
  `estatus` tinyint DEFAULT '1' COMMENT '1 = activo, 0 = inactivo',
  `fecha_creacion` datetime DEFAULT CURRENT_TIMESTAMP,
  `fecha_actualizacion` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_profesor`),
  KEY `id_usuario` (`id_usuario`),
  CONSTRAINT `profesores_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COMMENT='Información adicional y extendida de los profesores';

-- Volcando datos para la tabla todoapp.profesores: ~0 rows (aproximadamente)

-- Volcando estructura para tabla todoapp.roles
CREATE TABLE IF NOT EXISTS `roles` (
  `id_rol` int unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `descripcion` text,
  `orden` int DEFAULT '0',
  `estatus` tinyint DEFAULT '1' COMMENT '1 = activo, 0 = inactivo',
  `fecha_creacion` datetime DEFAULT CURRENT_TIMESTAMP,
  `fecha_actualizacion` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_rol`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb3;

-- Volcando datos para la tabla todoapp.roles: ~0 rows (aproximadamente)
INSERT INTO `roles` (`id_rol`, `nombre`, `descripcion`, `orden`, `estatus`, `fecha_creacion`, `fecha_actualizacion`) VALUES
	(1, 'Super Admin', 'Acceso total a todas las funciones del sistema', 1, 1, '2025-04-17 15:15:35', '2025-04-17 15:15:35'),
	(2, 'Admin', 'Administrador con acceso amplio, pero limitado frente al Super Admin', 2, 1, '2025-04-17 15:15:35', '2025-04-17 15:15:35'),
	(3, 'Supervisor', 'Supervisa contenido, usuarios y estadísticas', 3, 1, '2025-04-17 15:15:35', '2025-04-17 15:15:35'),
	(4, 'Profesor', 'Puede crear y gestionar sus propios cursos', 4, 1, '2025-04-17 15:15:35', '2025-04-17 15:15:35'),
	(5, 'Alumno', 'Puede tomar cursos', 5, 1, '2025-04-25 17:15:32', '2025-04-25 17:15:32');

-- Volcando estructura para tabla todoapp.roles_plataforma_permisos
CREATE TABLE IF NOT EXISTS `roles_plataforma_permisos` (
  `id_rol_permiso` int unsigned NOT NULL AUTO_INCREMENT,
  `id_rol` int unsigned NOT NULL,
  `id_permiso` int unsigned NOT NULL,
  `estatus` tinyint DEFAULT '1' COMMENT '1 = activo, 0 = inactivo',
  `fecha_asignacion` datetime DEFAULT CURRENT_TIMESTAMP,
  `fecha_creacion` datetime DEFAULT CURRENT_TIMESTAMP,
  `fecha_actualizacion` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_rol_permiso`),
  UNIQUE KEY `id_rol` (`id_rol`,`id_permiso`),
  KEY `id_permiso` (`id_permiso`),
  CONSTRAINT `roles_plataforma_permisos_ibfk_1` FOREIGN KEY (`id_rol`) REFERENCES `roles` (`id_rol`),
  CONSTRAINT `roles_plataforma_permisos_ibfk_2` FOREIGN KEY (`id_permiso`) REFERENCES `plataforma_permisos` (`id_permiso`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8mb3;

-- Volcando datos para la tabla todoapp.roles_plataforma_permisos: ~0 rows (aproximadamente)
INSERT INTO `roles_plataforma_permisos` (`id_rol_permiso`, `id_rol`, `id_permiso`, `estatus`, `fecha_asignacion`, `fecha_creacion`, `fecha_actualizacion`) VALUES
	(1, 1, 1, 1, '2025-04-17 15:19:28', '2025-04-17 15:19:28', '2025-04-17 15:19:28'),
	(2, 1, 2, 1, '2025-04-17 15:19:28', '2025-04-17 15:19:28', '2025-04-17 15:19:28'),
	(3, 1, 3, 1, '2025-04-17 15:19:28', '2025-04-17 15:19:28', '2025-04-17 15:19:28'),
	(4, 1, 4, 1, '2025-04-17 15:19:28', '2025-04-17 15:19:28', '2025-04-17 15:19:28'),
	(5, 1, 5, 1, '2025-04-17 15:19:28', '2025-04-17 15:19:28', '2025-04-17 15:19:28'),
	(6, 1, 6, 1, '2025-04-17 15:19:28', '2025-04-17 15:19:28', '2025-04-17 15:19:28'),
	(7, 1, 7, 1, '2025-04-17 15:19:28', '2025-04-17 15:19:28', '2025-04-17 15:19:28'),
	(8, 1, 8, 1, '2025-04-17 15:19:28', '2025-04-17 15:19:28', '2025-04-17 15:19:28'),
	(9, 1, 9, 1, '2025-04-17 15:19:28', '2025-04-17 15:19:28', '2025-04-17 15:19:28'),
	(10, 1, 10, 1, '2025-04-17 15:19:28', '2025-04-17 15:19:28', '2025-04-17 15:19:28'),
	(11, 1, 11, 1, '2025-04-17 15:19:28', '2025-04-17 15:19:28', '2025-04-17 15:19:28'),
	(12, 1, 12, 1, '2025-04-17 15:19:28', '2025-04-17 15:19:28', '2025-04-17 15:19:28'),
	(13, 1, 13, 1, '2025-04-17 15:19:28', '2025-04-17 15:19:28', '2025-04-17 15:19:28'),
	(14, 1, 14, 1, '2025-04-17 15:19:28', '2025-04-17 15:19:28', '2025-04-17 15:19:28'),
	(15, 1, 15, 1, '2025-04-17 15:19:28', '2025-04-17 15:19:28', '2025-04-17 15:19:28'),
	(16, 1, 16, 1, '2025-04-17 15:19:28', '2025-04-17 15:19:28', '2025-04-17 15:19:28'),
	(32, 1, 17, 1, '2025-04-29 07:57:09', '2025-04-29 07:57:09', '2025-04-29 07:57:09'),
	(33, 1, 18, 1, '2025-04-29 07:57:23', '2025-04-29 07:57:23', '2025-04-29 07:57:23'),
	(34, 1, 19, 1, '2025-04-29 07:57:35', '2025-04-29 07:57:35', '2025-04-29 07:57:35');

-- Volcando estructura para tabla todoapp.tareas
CREATE TABLE IF NOT EXISTS `tareas` (
  `id_tarea` int unsigned NOT NULL AUTO_INCREMENT,
  `id_alumno` int unsigned NOT NULL,
  `titulo` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `descripcion` text COLLATE utf8mb4_bin,
  `completada` tinyint(1) DEFAULT '0',
  `fecha_creacion` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `fecha_actualizacion` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_tarea`),
  KEY `id_alumno` (`id_alumno`),
  CONSTRAINT `tareas_ibfk_1` FOREIGN KEY (`id_alumno`) REFERENCES `alumnos` (`id_alumno`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- Volcando datos para la tabla todoapp.tareas: ~18 rows (aproximadamente)
INSERT INTO `tareas` (`id_tarea`, `id_alumno`, `titulo`, `descripcion`, `completada`, `fecha_creacion`, `fecha_actualizacion`) VALUES
	(1, 2, 'Leer capítulo 6 del libro de historia', 'Actualizar resumen con nuevo contenido', 1, '2025-05-11 19:34:10', '2025-05-11 19:49:24'),
	(2, 2, 'Estudiar en Platzi', 'Tomar la clases de manejo avanzado de react', 1, '2025-05-11 19:41:51', '2025-05-12 00:21:10'),
	(3, 2, 'Salir por la comida', 'comer', 1, '2025-05-11 19:48:15', '2025-05-12 05:27:19'),
	(4, 1, 'dasd', 'asdsad', 1, '2025-05-11 19:49:47', '2025-05-12 12:46:45'),
	(5, 2, 'Ir al parque', 'Ir al parque', 1, '2025-05-11 23:03:20', '2025-05-12 05:27:28'),
	(6, 2, 'Entrevista de trabajo', 'Platicar con RH', 1, '2025-05-11 23:03:21', '2025-05-12 00:21:58'),
	(7, 2, 'Sacar a mi perro a pasear', 'Sacar a charro', 0, '2025-05-11 23:03:22', '2025-05-12 05:29:00'),
	(8, 2, 'Buscar en mercado libre', 'Buscar en mercado libre', 0, '2025-05-11 23:03:23', '2025-05-12 04:28:34'),
	(9, 2, 'Leer capítulo 5 del libro de historia', 'Subrayar ideas principales y hacer resumen', 0, '2025-05-11 23:03:24', '2025-05-12 05:27:11'),
	(10, 2, 'prueba', 'esta es una prueba', 1, '2025-05-11 23:03:25', '2025-05-11 23:51:50'),
	(11, 2, 'Estudiar C#', 'Estudiar C#', 0, '2025-05-12 00:52:34', '2025-05-12 04:29:12'),
	(12, 2, 'Estudiar Python', 'Estudiar Python', 0, '2025-05-12 00:52:35', '2025-05-12 04:29:00'),
	(13, 2, 'Buscar una computadora', 'Buscar una computadora', 0, '2025-05-12 00:52:36', '2025-05-12 04:28:22'),
	(14, 2, 'Cantar una canción ', 'Cantar una canción ', 0, '2025-05-12 00:52:37', '2025-05-12 04:27:51'),
	(15, 2, 'Limpiar la mesa', 'limpiar la mesa', 0, '2025-05-12 00:52:38', '2025-05-12 04:27:25'),
	(16, 2, 'Escribir una canción ', 'Escribir una canción ', 0, '2025-05-12 00:52:38', '2025-05-12 04:28:07'),
	(17, 2, 'Grabar un video ', 'Grabar un video ', 1, '2025-05-12 00:52:39', '2025-05-12 05:54:03'),
	(18, 2, 'Leer capítulo 5 del libro de historia', 'Subrayar ideas principales y hacer resumen', 1, '2025-05-12 00:52:40', '2025-05-12 05:53:59');

-- Volcando estructura para tabla todoapp.tareas_compartidas
CREATE TABLE IF NOT EXISTS `tareas_compartidas` (
  `id_tarea_compartida` int unsigned NOT NULL AUTO_INCREMENT,
  `id_tarea` int unsigned NOT NULL,
  `id_alumno` int unsigned NOT NULL,
  `activa` tinyint(1) DEFAULT '1',
  `fecha_compartida` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_tarea_compartida`),
  KEY `id_tarea` (`id_tarea`),
  KEY `id_alumno` (`id_alumno`),
  CONSTRAINT `tareas_compartidas_ibfk_1` FOREIGN KEY (`id_tarea`) REFERENCES `tareas` (`id_tarea`),
  CONSTRAINT `tareas_compartidas_ibfk_2` FOREIGN KEY (`id_alumno`) REFERENCES `alumnos` (`id_alumno`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- Volcando datos para la tabla todoapp.tareas_compartidas: ~16 rows (aproximadamente)
INSERT INTO `tareas_compartidas` (`id_tarea_compartida`, `id_tarea`, `id_alumno`, `activa`, `fecha_compartida`) VALUES
	(1, 3, 2, 1, '2025-05-12 14:05:53'),
	(2, 18, 2, 1, '2025-05-12 14:05:50'),
	(3, 17, 2, 1, '2025-05-12 07:00:20'),
	(4, 15, 2, 0, '2025-05-12 04:51:06'),
	(5, 10, 2, 1, '2025-05-12 06:53:44'),
	(6, 9, 2, 0, '2025-05-12 04:56:40'),
	(7, 14, 2, 0, '2025-05-12 04:56:55'),
	(8, 13, 2, 0, '2025-05-12 04:57:05'),
	(9, 12, 2, 0, '2025-05-12 04:57:08'),
	(10, 2, 2, 0, '2025-05-12 07:00:29'),
	(11, 7, 2, 0, '2025-05-12 04:57:26'),
	(12, 6, 2, 1, '2025-05-12 07:15:07'),
	(13, 1, 2, 1, '2025-05-12 06:53:27'),
	(14, 16, 2, 0, '2025-05-12 05:06:04'),
	(15, 5, 2, 1, '2025-05-12 07:00:18'),
	(16, 4, 1, 1, '2025-05-12 13:45:43');

-- Volcando estructura para tabla todoapp.tareas_compromisos
CREATE TABLE IF NOT EXISTS `tareas_compromisos` (
  `id_compromiso` int unsigned NOT NULL AUTO_INCREMENT,
  `id_tarea` int unsigned NOT NULL,
  `id_alumno_comprometido` int unsigned NOT NULL,
  `id_alumno_testigo` int unsigned NOT NULL,
  `compromiso` text COLLATE utf8mb4_bin NOT NULL,
  `fue_cumplido` tinyint(1) DEFAULT NULL,
  `fecha_compromiso` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `fecha_evaluacion` timestamp NULL DEFAULT NULL,
  `observaciones` text COLLATE utf8mb4_bin,
  PRIMARY KEY (`id_compromiso`),
  KEY `id_tarea` (`id_tarea`),
  KEY `id_alumno_comprometido` (`id_alumno_comprometido`),
  KEY `id_alumno_testigo` (`id_alumno_testigo`),
  CONSTRAINT `tareas_compromisos_ibfk_1` FOREIGN KEY (`id_tarea`) REFERENCES `tareas` (`id_tarea`),
  CONSTRAINT `tareas_compromisos_ibfk_2` FOREIGN KEY (`id_alumno_comprometido`) REFERENCES `alumnos` (`id_alumno`),
  CONSTRAINT `tareas_compromisos_ibfk_3` FOREIGN KEY (`id_alumno_testigo`) REFERENCES `alumnos` (`id_alumno`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- Volcando datos para la tabla todoapp.tareas_compromisos: ~0 rows (aproximadamente)

-- Volcando estructura para tabla todoapp.tareas_likes
CREATE TABLE IF NOT EXISTS `tareas_likes` (
  `id_like` int unsigned NOT NULL AUTO_INCREMENT,
  `id_tarea_compartida` int unsigned NOT NULL,
  `id_alumno` int unsigned NOT NULL,
  `fecha_like` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_like`),
  UNIQUE KEY `id_tarea_compartida` (`id_tarea_compartida`,`id_alumno`),
  KEY `id_alumno` (`id_alumno`),
  CONSTRAINT `tareas_likes_ibfk_1` FOREIGN KEY (`id_tarea_compartida`) REFERENCES `tareas_compartidas` (`id_tarea_compartida`),
  CONSTRAINT `tareas_likes_ibfk_2` FOREIGN KEY (`id_alumno`) REFERENCES `alumnos` (`id_alumno`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- Volcando datos para la tabla todoapp.tareas_likes: ~0 rows (aproximadamente)
INSERT INTO `tareas_likes` (`id_like`, `id_tarea_compartida`, `id_alumno`, `fecha_like`) VALUES
	(1, 1, 2, '2025-05-11 20:07:15'),
	(3, 1, 1, '2025-05-12 00:26:29'),
	(4, 15, 2, '2025-05-12 06:05:48'),
	(5, 13, 2, '2025-05-12 06:09:51'),
	(6, 5, 2, '2025-05-12 06:12:19'),
	(7, 3, 2, '2025-05-12 06:12:23'),
	(8, 2, 2, '2025-05-12 06:14:59'),
	(9, 12, 2, '2025-05-12 06:15:16'),
	(10, 15, 1, '2025-05-12 12:59:30'),
	(11, 13, 1, '2025-05-12 13:01:23'),
	(12, 3, 1, '2025-05-12 13:01:26'),
	(13, 16, 2, '2025-05-12 13:05:39');

-- Volcando estructura para tabla todoapp.usuarios_historico_acceso
CREATE TABLE IF NOT EXISTS `usuarios_historico_acceso` (
  `id_historial` int unsigned NOT NULL AUTO_INCREMENT,
  `fecha_acceso` varchar(255) NOT NULL,
  `hora_acceso` varchar(255) NOT NULL,
  `fecha_acceso_termino` varchar(255) NOT NULL,
  `hora_acceso_termino` varchar(255) NOT NULL,
  `id_alumno` int unsigned NOT NULL,
  `id_usuario` int unsigned NOT NULL,
  `id_curso` int unsigned NOT NULL,
  `id_curso_alumno` int unsigned NOT NULL,
  `fecha_creacion` datetime DEFAULT CURRENT_TIMESTAMP,
  `fecha_actualizacion` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_historial`),
  KEY `id_usuario` (`id_usuario`),
  CONSTRAINT `usuarios_historico_acceso_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=328 DEFAULT CHARSET=utf8mb3;

-- Volcando datos para la tabla todoapp.usuarios_historico_acceso: ~0 rows (aproximadamente)

-- Volcando estructura para tabla todoapp.usuarios_roles
CREATE TABLE IF NOT EXISTS `usuarios_roles` (
  `id_usuario_rol` int unsigned NOT NULL AUTO_INCREMENT,
  `id_usuario` int unsigned NOT NULL,
  `id_rol` int unsigned NOT NULL,
  `fecha_asignacion` datetime DEFAULT CURRENT_TIMESTAMP,
  `estatus` tinyint DEFAULT '1' COMMENT '1 = activo, 0 = inactivo',
  PRIMARY KEY (`id_usuario_rol`),
  KEY `id_usuario` (`id_usuario`),
  KEY `id_rol` (`id_rol`),
  CONSTRAINT `usuarios_roles_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`),
  CONSTRAINT `usuarios_roles_ibfk_2` FOREIGN KEY (`id_rol`) REFERENCES `roles` (`id_rol`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb3;

-- Volcando datos para la tabla todoapp.usuarios_roles: ~5 rows (aproximadamente)
INSERT INTO `usuarios_roles` (`id_usuario_rol`, `id_usuario`, `id_rol`, `fecha_asignacion`, `estatus`) VALUES
	(1, 1, 1, '2025-04-23 19:35:10', 1),
	(2, 1, 5, '2025-04-25 17:18:13', 1),
	(3, 1, 4, '2025-04-25 17:20:12', 1),
	(4, 3, 5, '2025-04-25 17:53:33', 1),
	(5, 4, 5, '2025-05-12 06:44:15', 1);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
