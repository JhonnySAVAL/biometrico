-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
<<<<<<<< HEAD:db/biometrico (2).sql
-- Tiempo de generación: 25-11-2024 a las 04:50:52
========
-- Tiempo de generación: 25-11-2024 a las 04:48:25
>>>>>>>> 35e28d9e85137a58700178e977ff539a4e4b4ec7:db/biometricopruebaOLD.sql
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
  `hora_receso` time DEFAULT NULL,
  `hora_receso_final` time DEFAULT NULL,
  `horas_extras` time DEFAULT '00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `asistencia`
--

<<<<<<<< HEAD:db/biometrico (2).sql
INSERT INTO `asistencia` (`idAsistencia`, `idEmpleado`, `fecha_registro`, `hora_entrada`, `hora_salida`, `minutos_tardanza`, `tipo_registro`, `hora_receso`, `horas_extras`) VALUES
(1, 7, '2024-11-24', '22:13:25', '22:13:40', 0, 'manual', NULL, '00:00:00');
========
INSERT INTO `asistencia` (`idAsistencia`, `idEmpleado`, `fecha_registro`, `hora_entrada`, `hora_salida`, `minutos_tardanza`, `tipo_registro`, `hora_receso`, `hora_receso_final`, `horas_extras`) VALUES
(1, 1, '2024-11-24 00:00:00', '22:14:02', '22:14:20', 0, 'manual', NULL, NULL, '00:00:00');
>>>>>>>> 35e28d9e85137a58700178e977ff539a4e4b4ec7:db/biometricopruebaOLD.sql

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
<<<<<<<< HEAD:db/biometrico (2).sql
(1, 'asd', 'asd', '12345678', 'qqq@gma', '123456789', 1, 1, 'Activo', 0, NULL, NULL, '', ''),
(2, '432', '432', '432', '432@123', '432', 1, 1, 'Activo', 1, NULL, NULL, '', ''),
(3, 'mono', 'mano', '56451654', 'mono@gmail.com', '454151542', 1, 1, 'Activo', 1, NULL, NULL, '', ''),
(4, 'mene', 'mana', '34436547', 'mar@nose.com', '345643657', 1, 1, 'Activo', 1, NULL, NULL, '', ''),
(5, 'amaner', 'perezat', '43243243', 'roca@gmail.com', '555555555', 1, 1, 'Activo', 1, NULL, NULL, '', ''),
(6, 'jhonny arturo', 'sanes valdivia', '75209807', 'jhonny-529@outlook.com', '970780460', 1, 1, 'Activo', 1, NULL, NULL, '', ''),
(7, 'cxcxds', 'sadas', '88888888', 'admin@gmail.com', '999999999', 1, 1, 'Activo', 1, NULL, NULL, 'cxsa', '8ddcf');
========
(1, 'mfdsafda', 'grwgrw', '43243243', 'gfreger@gmail.com', '123456789', 0, 0, 'Activo', 0, NULL, NULL, 'wsder', 'dfghy');
>>>>>>>> 35e28d9e85137a58700178e977ff539a4e4b4ec7:db/biometricopruebaOLD.sql

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
<<<<<<<< HEAD:db/biometrico (2).sql
(1, 6, '2024-11-24', '2024-11-25', 'LN,JKM', '/biometrico/uploads/1.png');
========
(1, 1, '2024-11-22', '2024-11-30', 'y54tytryhr', '/biometrico/uploads/468079443_1146371870437793_3548631805690819992_n(2).jpg');
>>>>>>>> 35e28d9e85137a58700178e977ff539a4e4b4ec7:db/biometricopruebaOLD.sql

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
<<<<<<<< HEAD:db/biometrico (2).sql
(2, 'sillass', '2024-11-22', 'anual', 2024),
(3, 'sillas', '2024-11-23', 'anual', 2024);
========
(1, 'dia libre', '2024-11-23', 'simple', 2024),
(2, 'htrgesbnfg', '2024-11-24', 'anual', 2024),
(3, 'hghtygehtge', '2024-11-25', 'simple', 2024),
(4, 'jytkyukuyjkyutik', '2024-11-24', 'simple', 2024);
>>>>>>>> 35e28d9e85137a58700178e977ff539a4e4b4ec7:db/biometricopruebaOLD.sql

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

--
-- Volcado de datos para la tabla `justificaciones`
--

INSERT INTO `justificaciones` (`idJustificaciones`, `idEmpleado`, `fecha_inicio`, `fecha_fin`, `motivo`, `documento`) VALUES
(1, 6, '2024-11-24', '2024-11-25', 'fh', '/biometrico/uploads/1.png');

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
(2, 'jume', 0, '2024-11-24 00:16:42');

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
<<<<<<<< HEAD:db/biometrico (2).sql
(1, 6, '2024-11-24', '2024-11-25', 'sdf', NULL),
(2, 6, '2024-11-27', '2024-11-28', 'adfs', '/uploads/1.png'),
(3, 6, '2024-11-25', '2024-11-25', 'hgj', '/biometrico/uploads/121.png'),
(4, 6, '2024-11-25', '2024-11-25', 'dfg', '/biometrico/uploads/1(1).png');
========
(1, 1, '2024-11-25', '2024-11-26', 'tjthygjthy', '/biometrico/uploads/468079443_1146371870437793_3548631805690819992_n.jpg'),
(2, 1, '2024-11-18', '2024-12-05', 'htyjntyjuyt', '/biometrico/uploads/468079443_1146371870437793_3548631805690819992_n(1).jpg');
>>>>>>>> 35e28d9e85137a58700178e977ff539a4e4b4ec7:db/biometricopruebaOLD.sql

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
<<<<<<<< HEAD:db/biometrico (2).sql
(1, 'Electricista', 'Zona B mina 5', 'Encargado del mantneimiento en el area de electric');
========
(0, 'marioneta', 'pinga', 'nose');
>>>>>>>> 35e28d9e85137a58700178e977ff539a4e4b4ec7:db/biometricopruebaOLD.sql

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
<<<<<<<< HEAD:db/biometrico (2).sql
(1, 'Turno Mañana', '00:00:00', '08:00:00', '16:00:00', '00:30:00');
========
(0, 'waca', '00:00:00', '08:20:00', '10:20:00', '07:20:00');
>>>>>>>> 35e28d9e85137a58700178e977ff539a4e4b4ec7:db/biometricopruebaOLD.sql

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
<<<<<<<< HEAD:db/biometrico (2).sql
(1, 1, '2024-11-22', '2024-11-24', 'vnb'),
(2, 2, '2024-11-22', '2024-11-24', 'c'),
(3, 3, '2024-11-22', '2024-11-26', 'safsad');
========
(1, 1, '2024-11-12', '2024-12-04', 'vacaciones');
>>>>>>>> 35e28d9e85137a58700178e977ff539a4e4b4ec7:db/biometricopruebaOLD.sql

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
  MODIFY `idAsistencia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `empleados`
--
ALTER TABLE `empleados`
<<<<<<<< HEAD:db/biometrico (2).sql
  MODIFY `idEmpleado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
========
  MODIFY `idEmpleado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
>>>>>>>> 35e28d9e85137a58700178e977ff539a4e4b4ec7:db/biometricopruebaOLD.sql

--
-- AUTO_INCREMENT de la tabla `exoneraciones`
--
ALTER TABLE `exoneraciones`
  MODIFY `idExoneraciones` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `feriados`
--
ALTER TABLE `feriados`
<<<<<<<< HEAD:db/biometrico (2).sql
  MODIFY `idFeriado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
========
  MODIFY `idFeriado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
>>>>>>>> 35e28d9e85137a58700178e977ff539a4e4b4ec7:db/biometricopruebaOLD.sql

--
-- AUTO_INCREMENT de la tabla `justificaciones`
--
ALTER TABLE `justificaciones`
  MODIFY `idJustificaciones` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `login_intentos`
--
ALTER TABLE `login_intentos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `permisos`
--
ALTER TABLE `permisos`
<<<<<<<< HEAD:db/biometrico (2).sql
  MODIFY `idPermiso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

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
========
  MODIFY `idPermiso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
>>>>>>>> 35e28d9e85137a58700178e977ff539a4e4b4ec7:db/biometricopruebaOLD.sql

--
-- AUTO_INCREMENT de la tabla `vacaciones`
--
ALTER TABLE `vacaciones`
<<<<<<<< HEAD:db/biometrico (2).sql
  MODIFY `idVacacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
========
  MODIFY `idVacacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
>>>>>>>> 35e28d9e85137a58700178e977ff539a4e4b4ec7:db/biometricopruebaOLD.sql

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
