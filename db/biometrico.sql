-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 22-11-2024 a las 23:09:31
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
  `fecha_registro` date NOT NULL,
  `hora_entrada` time DEFAULT NULL,
  `hora_salida` time DEFAULT NULL,
  `minutos_tardanza` int(11) DEFAULT 0,
  `tipo_registro` enum('automatica','manual') DEFAULT 'automatica',
  `hora_receso` time DEFAULT NULL,
  `horas_extras` time DEFAULT '00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(1, 'asd', 'asd', '12345678', 'qqq@gma', '123456789', 1, 1, 'Activo', 0, NULL, NULL, '', ''),
(2, '432', '432', '432', '432@123', '432', 1, 1, 'Activo', 1, NULL, NULL, '', ''),
(3, 'mono', 'mano', '56451654', 'mono@gmail.com', '454151542', 1, 1, 'Activo', 1, NULL, NULL, '', ''),
(4, 'mene', 'mana', '34436547', 'mar@nose.com', '345643657', 1, 1, 'Activo', 1, NULL, NULL, '', ''),
(5, 'amaner', 'perezat', '43243243', 'roca@gmail.com', '555555555', 1, 1, 'Activo', 1, NULL, NULL, '', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `exoneraciones`
--

CREATE TABLE `exoneraciones` (
  `idPermiso` int(11) NOT NULL,
  `idEmpleado` int(11) DEFAULT NULL,
  `fecha_inicio` date DEFAULT NULL,
  `fecha_fin` date DEFAULT NULL,
  `motivo` varchar(100) DEFAULT NULL,
  `documento` varchar(455) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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

--
-- Volcado de datos para la tabla `feriados`
--

INSERT INTO `feriados` (`idFeriado`, `nombre`, `fecha`, `tipo`, `anio`) VALUES
(2, 'sillass', '2024-11-22', 'anual', 2024),
(3, 'sillas', '2024-11-23', 'anual', 2024);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `justificaciones`
--

CREATE TABLE `justificaciones` (
  `idPermiso` int(11) NOT NULL,
  `idEmpleado` int(11) DEFAULT NULL,
  `fecha_inicio` date DEFAULT NULL,
  `fecha_fin` date DEFAULT NULL,
  `motivo` varchar(100) DEFAULT NULL,
  `documento` varchar(455) DEFAULT NULL
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

--
-- Volcado de datos para la tabla `login_intentos`
--

INSERT INTO `login_intentos` (`id`, `usuario`, `intentos`, `ultimo_intento`) VALUES
(1, '', 1, '2024-11-18 13:54:56'),
(2, 'jume', 0, '2024-11-22 19:27:43');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permisos`
--

CREATE TABLE `permisos` (
  `idPermiso` int(11) NOT NULL,
  `idEmpleado` int(11) DEFAULT NULL,
  `fecha_inicio` date DEFAULT NULL,
  `fecha_fin` date DEFAULT NULL,
  `motivo` varchar(100) DEFAULT NULL,
  `documento` varchar(455) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(1, 'Electricista', 'Zona B mina 5', 'Encargado del mantneimiento en el area de electric');

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
(1, 'Turno Mañana', '00:00:00', '08:00:00', '16:00:00', '00:30:00');

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
(1, 1, '2024-11-22', '2024-11-24', 'vnb'),
(2, 2, '2024-11-22', '2024-11-24', 'c');

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
-- Indices de la tabla `feriados`
--
ALTER TABLE `feriados`
  ADD PRIMARY KEY (`idFeriado`);

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
  MODIFY `idAsistencia` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `empleados`
--
ALTER TABLE `empleados`
  MODIFY `idEmpleado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `feriados`
--
ALTER TABLE `feriados`
  MODIFY `idFeriado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `login_intentos`
--
ALTER TABLE `login_intentos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `permisos`
--
ALTER TABLE `permisos`
  MODIFY `idPermiso` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `vacaciones`
--
ALTER TABLE `vacaciones`
  MODIFY `idVacacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
