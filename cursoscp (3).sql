-- phpMyAdmin SQL Dump
-- version 5.1.1deb5ubuntu1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 13-01-2025 a las 22:22:47
-- Versión del servidor: 8.0.40-0ubuntu0.22.04.1
-- Versión de PHP: 8.1.2-1ubuntu2.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `cursoscp`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cursos`
--

CREATE TABLE `cursos` (
  `codigo` int NOT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `abierto` tinyint(1) DEFAULT '0',
  `numeroplazas` int DEFAULT NULL,
  `plazoinscripcion` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `cursos`
--

INSERT INTO `cursos` (`codigo`, `nombre`, `abierto`, `numeroplazas`, `plazoinscripcion`) VALUES
(100001, 'Curso de Matemáticas Avanzadas', 1, 14, '2025-01-31'),
(100002, 'Introducción a la Física', 1, 17, '2025-02-15'),
(100003, 'Taller de Inglés para Profesores', 1, 16, '2024-12-01');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitantes`
--

CREATE TABLE `solicitantes` (
  `dni` varchar(9) NOT NULL,
  `apellidos` varchar(50) DEFAULT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `telefono` varchar(15) DEFAULT NULL,
  `correo` varchar(50) DEFAULT NULL,
  `codigocentro` varchar(8) DEFAULT NULL,
  `coordinadortc` tinyint(1) DEFAULT NULL,
  `grupotc` tinyint(1) DEFAULT NULL,
  `nombregrupo` varchar(5) DEFAULT NULL,
  `pbilin` tinyint(1) DEFAULT NULL,
  `cargo` tinyint(1) DEFAULT NULL,
  `nombrecargo` varchar(15) DEFAULT NULL,
  `situacion` enum('activo','inactivo') DEFAULT NULL,
  `fechanac` date DEFAULT NULL,
  `especialidad` varchar(50) DEFAULT NULL,
  `puntos` int DEFAULT NULL,
  `password` varchar(50) NOT NULL,
  `admin` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `solicitantes`
--

INSERT INTO `solicitantes` (`dni`, `apellidos`, `nombre`, `telefono`, `correo`, `codigocentro`, `coordinadortc`, `grupotc`, `nombregrupo`, `pbilin`, `cargo`, `nombrecargo`, `situacion`, `fechanac`, `especialidad`, `puntos`, `password`, `admin`) VALUES
('11223344C', 'Hernández Ruiz', 'Carlos', '680555333', 'carlos.hernandez@example.com', 'CT003', 1, 1, 'G3', 1, 1, 'Coordinador', 'inactivo', '1975-08-10', 'Inglés', 20, '12345', 1),
('11223344D', 'Morena', 'adrian', '131313134', 'adri@example.com', 'CT004', 0, 0, 'G4', 1, 1, 'Profesor', 'activo', '2025-01-04', 'Informatica', 0, '12345', 0),
('11223344J', 'Morena', 'Alejandro', '639864187', 'alexmorena@gmail.com', 'CT004', 0, 0, 'G4', 1, 1, 'Profesor', 'activo', '2011-02-11', 'Informatica', 0, '12345', 0),
('11223344P', 'Morena', 'alex', '121212123', 'alexmorena@gmail.com', 'CT004', NULL, NULL, 'G4', 1, 1, 'Profesor', 'activo', '2025-01-03', 'Nada', 0, '12345', 0),
('11223344Z', 'Morena', 'alex', '121212123', 'alexmorena@gmail.com', 'CT004', 0, 0, 'G4', 1, 1, 'Profesor', 'activo', '2025-01-03', 'Todo', 0, '12345', 0),
('12345678A', 'García López', 'Juan', '600123456', 'juan.garcia@example.com', 'CT001', 1, 0, 'G1', 0, 1, 'Profesor', 'activo', '1980-05-15', 'Matemáticas', 25, '12345', 0),
('87654321B', 'Martínez Sánchez', 'Laura', '650987654', 'laura.martinez@example.com', 'CT002', 0, 1, 'G2', 1, 0, NULL, 'activo', '1990-03-22', 'Ciencias', 30, '12345', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitudes`
--

CREATE TABLE `solicitudes` (
  `dni` varchar(9) NOT NULL,
  `codigocurso` int NOT NULL,
  `fechasolicitud` date DEFAULT NULL,
  `admitido` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `solicitudes`
--

INSERT INTO `solicitudes` (`dni`, `codigocurso`, `fechasolicitud`, `admitido`) VALUES
('11223344C', 100001, '2025-01-12', 1),
('11223344C', 100002, '2025-01-10', 1),
('11223344Z', 100001, '2025-01-13', 1),
('11223344Z', 100002, '2025-01-13', 1),
('87654321B', 100002, '2025-01-09', 1),
('87654321B', 100003, '2025-01-10', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `usuario` varchar(9) NOT NULL,
  `contrasena` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`usuario`, `contrasena`) VALUES
('11223344C', 'Hernández'),
('12345678A', 'García'),
('87654321B', 'Martínez');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cursos`
--
ALTER TABLE `cursos`
  ADD PRIMARY KEY (`codigo`);

--
-- Indices de la tabla `solicitantes`
--
ALTER TABLE `solicitantes`
  ADD PRIMARY KEY (`dni`);

--
-- Indices de la tabla `solicitudes`
--
ALTER TABLE `solicitudes`
  ADD PRIMARY KEY (`dni`,`codigocurso`),
  ADD KEY `codigocurso` (`codigocurso`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cursos`
--
ALTER TABLE `cursos`
  MODIFY `codigo` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100010;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `solicitudes`
--
ALTER TABLE `solicitudes`
  ADD CONSTRAINT `solicitudes_ibfk_1` FOREIGN KEY (`dni`) REFERENCES `solicitantes` (`dni`),
  ADD CONSTRAINT `solicitudes_ibfk_2` FOREIGN KEY (`codigocurso`) REFERENCES `cursos` (`codigo`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
