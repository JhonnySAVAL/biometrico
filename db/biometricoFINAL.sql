-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 25-11-2024 a las 18:19:10
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
  `estado` enum('Sin acciones','presente','receso','regreso','tarde','salida','falto') DEFAULT 'Sin acciones',
  `hora_receso` time DEFAULT NULL,
  `hora_receso_final` time NOT NULL,
  `horas_extras` time DEFAULT '00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `asistencia`
--

INSERT INTO `asistencia` (`idAsistencia`, `idEmpleado`, `fecha_registro`, `hora_entrada`, `hora_salida`, `minutos_tardanza`, `tipo_registro`, `estado`, `hora_receso`, `hora_receso_final`, `horas_extras`) VALUES
(1, 1, '2024-10-01 08:00:00', '08:00:00', '17:00:00', 0, 'automatica', 'presente', '12:00:00', '12:30:00', '00:00:00'),
(2, 2, '2024-10-02 08:15:00', '08:15:00', '17:00:00', 15, 'manual', 'tarde', '12:30:00', '13:00:00', '01:00:00'),
(3, 3, '2024-10-03 07:50:00', '07:50:00', '17:00:00', 0, 'automatica', 'presente', '12:00:00', '12:45:00', '00:00:00'),
(4, 4, '2024-10-04 09:00:00', '09:00:00', '17:00:00', 30, 'manual', 'tarde', '12:00:00', '12:30:00', '00:00:00'),
(5, 5, '2024-10-05 08:00:00', '08:00:00', '17:00:00', 0, 'automatica', 'presente', '12:30:00', '13:00:00', '00:00:00'),
(6, 6, '2024-10-06 08:00:00', '08:00:00', '17:00:00', 0, 'manual', 'presente', '12:00:00', '12:30:00', '00:00:00'),
(7, 7, '2024-10-07 08:05:00', '08:05:00', '17:00:00', 5, 'automatica', 'presente', '12:00:00', '12:30:00', '00:00:00'),
(8, 8, '2024-10-08 09:00:00', '09:00:00', '17:00:00', 30, 'manual', 'tarde', '12:30:00', '13:00:00', '01:00:00'),
(9, 9, '2024-10-09 08:00:00', '08:00:00', '17:00:00', 0, 'automatica', 'presente', '12:00:00', '12:45:00', '00:00:00'),
(10, 10, '2024-10-10 08:10:00', '08:10:00', '17:00:00', 10, 'manual', 'tarde', '12:00:00', '12:30:00', '00:00:00'),
(11, 11, '2024-10-11 08:00:00', '08:00:00', '17:00:00', 0, 'automatica', 'presente', '12:30:00', '13:00:00', '00:00:00'),
(12, 12, '2024-10-12 08:00:00', '08:00:00', '17:00:00', 0, 'manual', 'presente', '12:00:00', '12:30:00', '00:00:00'),
(13, 13, '2024-10-13 08:20:00', '08:20:00', '17:00:00', 20, 'automatica', 'tarde', '12:00:00', '12:30:00', '00:00:00'),
(14, 14, '2024-10-14 08:00:00', '08:00:00', '17:00:00', 0, 'manual', 'presente', '12:00:00', '12:30:00', '00:00:00'),
(15, 15, '2024-10-15 08:00:00', '08:00:00', '17:00:00', 0, 'automatica', 'presente', '12:30:00', '13:00:00', '01:00:00'),
(16, 16, '2024-10-16 09:00:00', '09:00:00', '17:00:00', 30, 'manual', 'tarde', '12:00:00', '12:30:00', '00:00:00'),
(17, 17, '2024-10-17 08:00:00', '08:00:00', '17:00:00', 0, 'automatica', 'presente', '12:30:00', '13:00:00', '00:00:00'),
(18, 18, '2024-10-18 08:10:00', '08:10:00', '17:00:00', 10, 'manual', 'tarde', '12:00:00', '12:30:00', '01:00:00'),
(19, 19, '2024-10-19 08:00:00', '08:00:00', '17:00:00', 0, 'automatica', 'presente', '12:00:00', '12:30:00', '00:00:00'),
(20, 20, '2024-10-20 08:00:00', '08:00:00', '17:00:00', 0, 'manual', 'presente', '12:30:00', '13:00:00', '00:00:00'),
(41, 1, '2024-11-01 08:05:00', '08:05:00', '17:00:00', 5, 'automatica', 'presente', '12:00:00', '12:30:00', '00:00:00'),
(42, 2, '2024-11-02 08:30:00', '08:30:00', '17:00:00', 30, 'manual', 'tarde', '12:15:00', '12:45:00', '01:00:00'),
(43, 3, '2024-11-03 08:15:00', '08:15:00', '17:00:00', 15, 'automatica', 'presente', '12:00:00', '12:30:00', '00:00:00'),
(44, 4, '2024-11-04 08:00:00', '08:00:00', '17:00:00', 0, 'manual', 'presente', '12:00:00', '12:30:00', '00:00:00'),
(45, 5, '2024-11-05 08:40:00', '08:40:00', '17:00:00', 40, 'automatica', 'tarde', '12:15:00', '12:45:00', '01:00:00'),
(46, 6, '2024-11-06 08:05:00', '08:05:00', '17:00:00', 5, 'manual', 'presente', '12:00:00', '12:30:00', '00:00:00'),
(47, 7, '2024-11-07 08:30:00', '08:30:00', '17:00:00', 30, 'automatica', 'presente', '12:00:00', '12:30:00', '00:00:00'),
(48, 8, '2024-11-08 08:00:00', '08:00:00', '17:00:00', 0, 'manual', 'presente', '12:00:00', '12:30:00', '00:00:00'),
(49, 9, '2024-11-09 08:20:00', '08:20:00', '17:00:00', 20, 'automatica', 'presente', '12:00:00', '12:30:00', '00:00:00'),
(50, 10, '2024-11-10 08:50:00', '08:50:00', '17:00:00', 50, 'manual', 'tarde', '12:15:00', '12:45:00', '01:30:00'),
(51, 11, '2024-11-11 08:00:00', '08:00:00', '17:00:00', 0, 'automatica', 'presente', '12:00:00', '12:30:00', '00:00:00'),
(52, 12, '2024-11-12 08:30:00', '08:30:00', '17:00:00', 30, 'manual', 'presente', '12:00:00', '12:30:00', '00:00:00'),
(53, 13, '2024-11-13 08:00:00', '08:00:00', '17:00:00', 0, 'automatica', 'presente', '12:00:00', '12:30:00', '00:00:00'),
(54, 14, '2024-11-14 08:15:00', '08:15:00', '17:00:00', 15, 'manual', 'presente', '12:00:00', '12:30:00', '00:00:00'),
(55, 15, '2024-11-15 08:25:00', '08:25:00', '17:00:00', 25, 'automatica', 'presente', '12:00:00', '12:30:00', '00:00:00'),
(56, 16, '2024-11-16 08:40:00', '08:40:00', '17:00:00', 40, 'manual', 'tarde', '12:15:00', '12:45:00', '01:00:00'),
(57, 17, '2024-11-17 08:30:00', '08:30:00', '17:00:00', 30, 'automatica', 'presente', '12:00:00', '12:30:00', '00:00:00'),
(58, 18, '2024-11-18 08:05:00', '08:05:00', '17:00:00', 5, 'manual', 'presente', '12:00:00', '12:30:00', '00:00:00'),
(59, 19, '2024-11-19 08:00:00', '08:00:00', '17:00:00', 0, 'automatica', 'presente', '12:00:00', '12:30:00', '00:00:00'),
(60, 20, '2024-11-20 08:10:00', '08:10:00', '17:00:00', 10, 'manual', 'tarde', '12:15:00', '12:45:00', '01:00:00'),
(61, 2, '2024-11-25 09:10:31', '09:09:00', NULL, 0, 'manual', 'regreso', '09:12:00', '09:12:00', '00:00:00'),
(62, 4, '2024-11-25 00:00:00', '10:43:45', '10:46:05', 0, 'automatica', 'Sin acciones', NULL, '00:00:00', '00:00:00');

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
(1, 'Juan Carlos', 'Pérez Rodríguez', '12345678', 'juancarlosperez@gmail.com', '987654321', 1, 1, 'Activo', 1, NULL, NULL, 'jupe', 'e99a1'),
(2, 'Laura María', 'Gómez Torres', '23456789', 'lauragomeztorres@gmail.com', '987654322', 2, 2, 'Activo', 1, NULL, NULL, 'lago', 'd2d2d'),
(3, 'Roberto Luis', 'Fernández Martínez', '34567890', 'robertoluisfernandez@gmail.com', '987654323', 3, 3, 'Activo', 1, NULL, NULL, 'rofe', 'b9f83'),
(4, 'Ana Isabel', 'Vargas López', '45678901', 'anaisabelvargas@gmail.com', '987654324', 1, 4, 'Activo', 1, NULL, NULL, 'anva', '11a8c'),
(5, 'Carlos Eduardo', 'Ramírez Sánchez', '56789012', 'carloseduardoramirez@gmail.com', '987654325', 2, 2, 'Activo', 1, NULL, NULL, 'cara', 'aadf2'),
(6, 'Sofía Fernanda', 'López Hernández', '67890123', 'sofiafernandalopez@gmail.com', '987654326', 3, 3, 'Activo', 1, NULL, NULL, 'sofe', 'acbd1'),
(7, 'Pedro Alejandro', 'González Pérez', '78901234', 'pedroalejandrogonzalez@gmail.com', '987654327', 1, 1, 'Activo', 1, NULL, NULL, 'pego', '98a04'),
(8, 'María Eugenia', 'Martínez García', '89012345', 'mariaeugeniamartinez@gmail.com', '987654328', 2, 2, 'Activo', 1, NULL, NULL, 'mama', 'b32c9'),
(9, 'Miguel Ángel', 'Jiménez Ruiz', '90123456', 'miguelangeljimenez@gmail.com', '987654329', 3, 3, 'Activo', 1, NULL, NULL, 'miji', '2a4e4'),
(10, 'Lucía Beatriz', 'Morales Díaz', '12341234', 'luciabeatrizmorales@gmail.com', '987654330', 1, 1, 'Activo', 1, NULL, NULL, 'lumo', 'e4e9b'),
(11, 'David Francisco', 'Torres Romero', '23452345', 'davidfranciscotorres@gmail.com', '987654331', 2, 2, 'Activo', 1, NULL, NULL, 'dato', '3f1d0'),
(12, 'Gloria Patricia', 'Sánchez Vargas', '34563456', 'gloriapatriciasanchez@gmail.com', '987654332', 3, 3, 'Activo', 1, NULL, NULL, 'glsa', '56e9f'),
(13, 'Andrés Felipe', 'Cruz Martínez', '45674567', 'andresfelipecruz@gmail.com', '987654333', 1, 1, 'Activo', 1, NULL, NULL, 'ancr', 'f7639'),
(14, 'Natalia Mariana', 'Pérez García', '56785678', 'nataliamarianaperez@gmail.com', '987654334', 2, 2, 'Activo', 1, NULL, NULL, 'nape', '4bd91'),
(15, 'Eduardo Augusto', 'Sosa Molina', '67896789', 'eduardoaugustososa@gmail.com', '987654335', 3, 3, 'Activo', 1, NULL, NULL, 'edso', '02d2e'),
(16, 'Cristina Elvira', 'García Gómez', '78907890', 'cristinaelviragarcia@gmail.com', '987654336', 1, 1, 'Activo', 1, NULL, NULL, 'crga', 'e0e8f'),
(17, 'Héctor Javier', 'Rivera Delgado', '89018901', 'hectorjavierrivera@gmail.com', '987654337', 2, 2, 'Activo', 1, NULL, NULL, 'heri', '33de5'),
(18, 'Vanessa Carolina', 'Ramírez Castillo', '90129012', 'vanessacarolinaramirez@gmail.com', '987654338', 3, 3, 'Activo', 1, NULL, NULL, 'vaca', 'a38fd'),
(19, 'Francisco Javier', 'Torres Martínez', '12355678', 'franciscojaviertorres@gmail.com', '987654339', 1, 1, 'Activo', 1, NULL, NULL, 'frto', '542cf'),
(20, 'Patricia Beatriz', 'González Ramírez', '23466789', 'patriciabeatrizgonzalez@gmail.com', '987654340', 2, 2, 'Activo', 1, NULL, NULL, 'pabe', '6e774'),
(21, 'jose', 'perez', '12125555', 'jose@gmail.com', '312312345', 6, 5, 'Activo', 1, NULL, NULL, 'jope', '3cb7a'),
(22, 'mario', 'gomez', '55548787', 'mario@gmail.com', '321329879', 2, 2, 'Activo', 1, NULL, NULL, 'mago', '6bb61');

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
(1, 14, '2024-11-25', '2024-11-26', 'sda', NULL);

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
(4, 'feriado', '2024-11-25', 'anual', 2024);

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
(1, 14, '2024-11-25', '2024-11-26', 'asd', '/biometrico/uploads/1(1).png'),
(2, 14, '2024-11-25', '2024-11-26', 'asd', '/biometrico/uploads/1(2).png'),
(3, 14, '2024-11-25', '2024-11-26', 'asd', '/biometrico/uploads/1(3).png');

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
(1, 5, '2024-11-25', '2024-11-26', 'sda', '/biometrico/uploads/Presentación Mi proyecto Final Femenino Delicado Rosa y Nude_20240809_141009_0000.pdf'),
(2, 8, '2024-11-25', '2024-11-26', 'a', '/biometrico/uploads/tefa.docx'),
(3, 14, '2024-11-25', '2024-11-26', 'as', '/biometrico/uploads/1.png'),
(4, 22, '2024-11-25', '2024-11-26', 'permiso por salud', '/biometrico/uploads/WhatsApp Image 2024-11-16 at 10.47.37 AM.jpeg');

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
(1, 'Supervisor de Operaciones', 'Operaciones', 'Encargado de supervisar las operaciones diarias en'),
(2, 'Ingeniero de Minas', 'Ingeniería', 'Responsable de la planificación, diseño y ejecució'),
(3, 'Técnico de Perforación', 'Operaciones', 'Realiza la perforación de los bloques de roca segú'),
(4, 'Operador de Excavadora', 'Operaciones', 'Operador de maquinaria pesada para la excavación y'),
(5, 'Encargado de Seguridad Minera', 'Seguridad', 'Asegura que se cumplan las normativas de seguridad'),
(6, 'prueba', 'b', 'zonab'),
(7, 'puesto prueba', 'c', 'prueba c');

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
(1, 'Turno Mañana', '07:00:00', '08:00:00', '16:00:00', '01:00:00'),
(2, 'Turno Tarde', '14:00:00', '15:00:00', '23:00:00', '00:30:00'),
(3, 'Turno Noche', '22:00:00', '23:00:00', '07:00:00', '01:00:00'),
(4, 'TurnoPuerba', '00:00:00', '09:00:00', '10:46:00', '09:20:00'),
(5, 'turno prueba A', '00:00:00', '12:00:00', '18:00:00', '14:00:00');

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
(1, 1, '2024-11-14', '2024-12-06', 'dsa'),
(2, 2, '2024-11-25', '2024-11-28', 'J'),
(3, 21, '2024-11-25', '2024-11-26', 'vacaciones planeadas');

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
  MODIFY `idAsistencia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT de la tabla `empleados`
--
ALTER TABLE `empleados`
  MODIFY `idEmpleado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de la tabla `exoneraciones`
--
ALTER TABLE `exoneraciones`
  MODIFY `idExoneraciones` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `feriados`
--
ALTER TABLE `feriados`
  MODIFY `idFeriado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `justificaciones`
--
ALTER TABLE `justificaciones`
  MODIFY `idJustificaciones` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `login_intentos`
--
ALTER TABLE `login_intentos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `permisos`
--
ALTER TABLE `permisos`
  MODIFY `idPermiso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `puestos`
--
ALTER TABLE `puestos`
  MODIFY `idPuesto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `reportes_asistencia`
--
ALTER TABLE `reportes_asistencia`
  MODIFY `idReporte` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `turnos`
--
ALTER TABLE `turnos`
  MODIFY `idTurno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `vacaciones`
--
ALTER TABLE `vacaciones`
  MODIFY `idVacacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
