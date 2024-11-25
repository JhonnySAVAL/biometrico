-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 25-11-2024 a las 08:15:49
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `biometrico`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `admins`
--

CREATE TABLE `admins` (
  `codigo` int(10) NOT NULL,
  `nombres` varchar(50) NOT NULL,
  `apellidos` varchar(50) NOT NULL,
  `dni` varchar(8) NOT NULL,
  `usergen` varchar(5) NOT NULL,
  `passgen` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `admins`
--

INSERT INTO `admins` (`codigo`, `nombres`, `apellidos`, `dni`, `usergen`, `passgen`) VALUES
(1, 'julios', 'mendoza', '12345678', 'jume', '25d55'),
(2, 'marta', 'juliana', '54355425', 'maju', '25f7f'),
(3, 'elizabeth', 'mariana', '43243243', 'elma', '5b903'),
(4, 'torreon', 'josemiro', '99789678', 'tojo', 'c93a5'),
(5, 'jhonny', 'sanes', '75209245', 'jhsa', '85a54'),
(1, 'julios', 'mendoza', '12345678', 'jume', '25d55'),
(2, 'marta', 'juliana', '54355425', 'maju', '25f7f'),
(3, 'elizabeth', 'mariana', '43243243', 'elma', '5b903'),
(4, 'torreon', 'josemiro', '99789678', 'tojo', 'c93a5'),
(5, 'jhonny', 'sanes', '75209245', 'jhsa', '85a54');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asistencia`
--

CREATE TABLE `asistencia` (
  `idAsistencia` int(11) NOT NULL,
  `idEmpleado` int(11) DEFAULT NULL,
  `fecha_registro` datetime NOT NULL,
  `hora_entrada` time DEFAULT NULL,
  `hora_salida` time DEFAULT NULL,
  `minutos_tardanza` int(11) DEFAULT 0,
  `tipo_registro` enum('automatica','manual') DEFAULT 'automatica',
  `estado` enum('Sin acciones','presente','en_receso','tarde','salida','falto') DEFAULT 'Sin acciones',
  `hora_receso` time DEFAULT NULL,
  `hora_receso_final` time NOT NULL,
  `horas_extras` time DEFAULT '00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `asistencia`
--

INSERT INTO `asistencia` (`idAsistencia`, `idEmpleado`, `fecha_registro`, `hora_entrada`, `hora_salida`, `minutos_tardanza`, `tipo_registro`, `estado`, `hora_receso`, `hora_receso_final`, `horas_extras`) VALUES
(2, 2, '2024-11-25 00:00:00', '01:14:10', '01:17:40', 0, '', 'Sin acciones', NULL, '00:00:00', '00:00:00'),
(3, 6, '2024-11-25 00:00:00', '01:43:37', '01:43:51', 0, '', 'Sin acciones', NULL, '00:00:00', '00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleados`
--

CREATE TABLE `empleados` (
  `idEmpleado` int(11) NOT NULL,
  `nombres` varchar(50) NOT NULL,
  `apellidos` varchar(50) NOT NULL,
  `dni` varchar(8) NOT NULL,
  `correo` varchar(50) NOT NULL,
  `telefono` varchar(15) DEFAULT NULL,
  `idPuesto` int(11) DEFAULT NULL,
  `idTurno` int(11) DEFAULT NULL,
  `estado` enum('Activo','Inactivo') DEFAULT 'Activo',
  `habilitado` tinyint(1) NOT NULL,
  `idApp` varchar(10) DEFAULT NULL COMMENT 'id para la app',
  `passwordApp` varchar(20) DEFAULT NULL COMMENT 'contra para la app',
  `idmarcar` varchar(5) NOT NULL,
  `passmarcar` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `empleados`
--

INSERT INTO `empleados` (`idEmpleado`, `nombres`, `apellidos`, `dni`, `correo`, `telefono`, `idPuesto`, `idTurno`, `estado`, `habilitado`, `idApp`, `passwordApp`, `idmarcar`, `passmarcar`) VALUES
(2, 'mariano', 'escobedo', '78563589', 'mariano@gmail.com', '225656588', 1, 1, 'Activo', 1, NULL, NULL, 'maes', 'ea695'),
(3, 'jose', 'torres', '98989898', 'amaro@gmail.com', '159487777', 1, 1, 'Activo', 1, NULL, NULL, 'joto', '5a7b2'),
(4, 'omar', 'araujo', '33326262', 'araujo@gmail.com', '555874857', 1, 1, 'Activo', 1, NULL, NULL, 'omar', '88f49'),
(5, 'menendez', 'amir', '12313212', 'general@gmail.com', '787979879', 1, 1, 'Activo', 1, NULL, NULL, 'meam', '0d1bf'),
(6, 'prueba', 'tres', '45483645', 'memememe@gmail.com', '715654746', 1, 1, 'Activo', 1, NULL, NULL, 'prtr', '836b1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `exoneraciones`
--

CREATE TABLE `exoneraciones` (
  `idExoneraciones` int(11) NOT NULL,
  `idEmpleado` int(11) NOT NULL,
  `fecha_inicio` date NOT NULL,
  `fecha_fin` date NOT NULL,
  `motivo` varchar(255) NOT NULL,
  `documento` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `exoneraciones`
--

INSERT INTO `exoneraciones` (`idExoneraciones`, `idEmpleado`, `fecha_inicio`, `fecha_fin`, `motivo`, `documento`) VALUES
(1, 4, '2024-11-23', '2024-11-27', 'no desea', '/biometrico/uploads/81hp447i1fL._AC_UF894,1000_QL80_(2).jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `feriados`
--

CREATE TABLE `feriados` (
  `idFeriado` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `fecha` date NOT NULL,
  `tipo` enum('simple','anual') DEFAULT 'simple',
  `anio` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `justificaciones`
--

CREATE TABLE `justificaciones` (
  `idJustificaciones` int(11) NOT NULL,
  `idEmpleado` int(11) NOT NULL,
  `fecha_inicio` date NOT NULL,
  `fecha_fin` date NOT NULL,
  `motivo` varchar(255) NOT NULL,
  `documento` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `login_intentos`
--

CREATE TABLE `login_intentos` (
  `id` int(11) NOT NULL,
  `usuario` varchar(255) NOT NULL,
  `intentos` int(11) DEFAULT 0,
  `ultimo_intento` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permisos`
--

CREATE TABLE `permisos` (
  `idPermiso` int(11) NOT NULL,
  `idEmpleado` int(11) NOT NULL,
  `fecha_inicio` date NOT NULL,
  `fecha_fin` date NOT NULL,
  `motivo` varchar(255) NOT NULL,
  `documento` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `permisos`
--

INSERT INTO `permisos` (`idPermiso`, `idEmpleado`, `fecha_inicio`, `fecha_fin`, `motivo`, `documento`) VALUES
(1, 3, '2024-11-23', '2024-11-26', 'enfermo', '/biometrico/uploads/81hp447i1fL._AC_UF894,1000_QL80_(1).jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `puestos`
--

CREATE TABLE `puestos` (
  `idPuesto` int(11) NOT NULL,
  `nombrePuesto` varchar(50) NOT NULL,
  `area` varchar(50) DEFAULT NULL,
  `descripcion` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `puestos`
--

INSERT INTO `puestos` (`idPuesto`, `nombrePuesto`, `area`, `descripcion`) VALUES
(1, 't345t54t', 'hgregtre', 'gtregtregtre');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reportes_asistencia`
--

CREATE TABLE `reportes_asistencia` (
  `idReporte` int(11) NOT NULL,
  `idEmpleado` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `estado` enum('presente','ausente','falta','permiso','exonerado','tardanza') NOT NULL,
  `horaEntrada` time DEFAULT NULL,
  `horaSalida` time DEFAULT NULL,
  `minutosTardanza` int(11) DEFAULT 0,
  `minutosAnticipados` int(11) DEFAULT 0,
  `tipoRegistro` enum('automatica','manual') DEFAULT 'automatica'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `turnos`
--

CREATE TABLE `turnos` (
  `idTurno` int(11) NOT NULL,
  `descripcion` varchar(50) NOT NULL,
  `entrada_previa` time NOT NULL,
  `entrada` time DEFAULT NULL,
  `salida` time DEFAULT NULL,
  `receso` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `turnos`
--

INSERT INTO `turnos` (`idTurno`, `descripcion`, `entrada_previa`, `entrada`, `salida`, `receso`) VALUES
(1, 'tretrwtrewrw', '00:00:00', '03:04:00', '05:43:00', '05:43:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vacaciones`
--

CREATE TABLE `vacaciones` (
  `idVacacion` int(11) NOT NULL,
  `idEmpleado` int(11) DEFAULT NULL,
  `fecha_inicio` date DEFAULT NULL,
  `fecha_fin` date DEFAULT NULL,
  `motivo` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `vacaciones`
--

INSERT INTO `vacaciones` (`idVacacion`, `idEmpleado`, `fecha_inicio`, `fecha_fin`, `motivo`) VALUES
(1, 5, '2024-11-12', '2024-12-04', 'vacaciones');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `asistencia`
--
ALTER TABLE `asistencia`
  ADD PRIMARY KEY (`idAsistencia`);

--
-- Indices de la tabla `empleados`
--
ALTER TABLE `empleados`
  ADD PRIMARY KEY (`idEmpleado`);

--
-- Indices de la tabla `exoneraciones`
--
ALTER TABLE `exoneraciones`
  ADD PRIMARY KEY (`idExoneraciones`),
  ADD KEY `idEmpleado` (`idEmpleado`);

--
-- Indices de la tabla `feriados`
--
ALTER TABLE `feriados`
  ADD PRIMARY KEY (`idFeriado`);

--
-- Indices de la tabla `justificaciones`
--
ALTER TABLE `justificaciones`
  ADD PRIMARY KEY (`idJustificaciones`),
  ADD KEY `idEmpleado` (`idEmpleado`);

--
-- Indices de la tabla `login_intentos`
--
ALTER TABLE `login_intentos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `permisos`
--
ALTER TABLE `permisos`
  ADD PRIMARY KEY (`idPermiso`),
  ADD KEY `idEmpleado` (`idEmpleado`);

--
-- Indices de la tabla `puestos`
--
ALTER TABLE `puestos`
  ADD PRIMARY KEY (`idPuesto`);

--
-- Indices de la tabla `reportes_asistencia`
--
ALTER TABLE `reportes_asistencia`
  ADD PRIMARY KEY (`idReporte`),
  ADD KEY `idEmpleado` (`idEmpleado`) USING BTREE;

--
-- Indices de la tabla `turnos`
--
ALTER TABLE `turnos`
  ADD PRIMARY KEY (`idTurno`);

--
-- Indices de la tabla `vacaciones`
--
ALTER TABLE `vacaciones`
  ADD PRIMARY KEY (`idVacacion`),
  ADD KEY `idEmpleado` (`idEmpleado`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `asistencia`
--
ALTER TABLE `asistencia`
  MODIFY `idAsistencia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `empleados`
--
ALTER TABLE `empleados`
  MODIFY `idEmpleado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `exoneraciones`
--
ALTER TABLE `exoneraciones`
  MODIFY `idExoneraciones` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `feriados`
--
ALTER TABLE `feriados`
  MODIFY `idFeriado` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `justificaciones`
--
ALTER TABLE `justificaciones`
  MODIFY `idJustificaciones` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `login_intentos`
--
ALTER TABLE `login_intentos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `permisos`
--
ALTER TABLE `permisos`
  MODIFY `idPermiso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `puestos`
--
ALTER TABLE `puestos`
  MODIFY `idPuesto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `reportes_asistencia`
--
ALTER TABLE `reportes_asistencia`
  MODIFY `idReporte` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `turnos`
--
ALTER TABLE `turnos`
  MODIFY `idTurno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `vacaciones`
--
ALTER TABLE `vacaciones`
  MODIFY `idVacacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `exoneraciones`
--
ALTER TABLE `exoneraciones`
  ADD CONSTRAINT `exoneraciones_ibfk_1` FOREIGN KEY (`idEmpleado`) REFERENCES `empleados` (`idEmpleado`);

--
-- Filtros para la tabla `justificaciones`
--
ALTER TABLE `justificaciones`
  ADD CONSTRAINT `justificaciones_ibfk_1` FOREIGN KEY (`idEmpleado`) REFERENCES `empleados` (`idEmpleado`);

--
-- Filtros para la tabla `permisos`
--
ALTER TABLE `permisos`
  ADD CONSTRAINT `permisos_ibfk_1` FOREIGN KEY (`idEmpleado`) REFERENCES `empleados` (`idEmpleado`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
