-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 10, 2023 at 06:10 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gestion_calificaciones`
--

-- --------------------------------------------------------

--
-- Table structure for table `administradores`
--

CREATE TABLE `administradores` (
  `id_admin` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellido` varchar(50) NOT NULL,
  `correo` varchar(50) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `contraseña` varchar(255) NOT NULL,
  `id_sexo` int(11) NOT NULL,
  `id_estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `administradores`
--

INSERT INTO `administradores` (`id_admin`, `nombre`, `apellido`, `correo`, `usuario`, `contraseña`, `id_sexo`, `id_estado`) VALUES
(1, 'Franco', 'Zaragoza', 'coria9404@gmail.com', 'admin10', '1234', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `alumnos`
--

CREATE TABLE `alumnos` (
  `id_alumno` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellido` varchar(50) NOT NULL,
  `correo` varchar(50) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `contraseña` varchar(50) NOT NULL,
  `id_sexo` int(11) NOT NULL,
  `id_estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `alumnos`
--

INSERT INTO `alumnos` (`id_alumno`, `nombre`, `apellido`, `correo`, `usuario`, `contraseña`, `id_sexo`, `id_estado`) VALUES
(3, 'Laura', 'Casas', 'laurita@gmail.com', 'laurita10', '1234', 2, 1),
(5, 'Daniel', 'Coria', 'dani22@gmail.com', 'dani09', 'dani0099', 1, 1),
(6, 'Lolo', 'Sanchez', 'loloSanchez@gmial.com', 'lolo77', '7777', 1, 1),
(7, 'pepito', 'boedo', 'perez@gmail.com', 'pepe66', '1234', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `calificacion_alumnos`
--

CREATE TABLE `calificacion_alumnos` (
  `id_calificacion` int(11) NOT NULL,
  `id_alumno` int(11) NOT NULL,
  `id_profesor` int(11) NOT NULL,
  `id_materia` int(11) NOT NULL,
  `id_curso` int(11) NOT NULL,
  `punt_1` int(11) NOT NULL,
  `punt_2` int(11) NOT NULL,
  `promedio` decimal(11,0) NOT NULL,
  `comentario` varchar(50) NOT NULL,
  `id_estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `calificacion_alumnos`
--

INSERT INTO `calificacion_alumnos` (`id_calificacion`, `id_alumno`, `id_profesor`, `id_materia`, `id_curso`, `punt_1`, `punt_2`, `promedio`, `comentario`, `id_estado`) VALUES
(39, 5, 1, 1, 1, 2, 2, '2', 'Casi !!!', 5),
(40, 5, 1, 2, 1, 9, 9, '9', 'bien', 4),
(41, 5, 1, 3, 1, 7, 7, '7', 'biennnn', 4),
(42, 5, 1, 4, 1, 8, 8, '8', 'exelente', 4),
(43, 5, 1, 5, 1, 2, 10, '6', 'casiii', 5),
(44, 5, 1, 5, 1, 2, 10, '6', 'casiii', 5),
(45, 5, 1, 6, 1, 1, 1, '1', 'pesimooo', 5);

-- --------------------------------------------------------

--
-- Table structure for table `calificacion_alumnos_historial`
--

CREATE TABLE `calificacion_alumnos_historial` (
  `id_cal_historial` int(11) NOT NULL,
  `id_alumno` int(11) DEFAULT NULL,
  `id_profesor` int(11) DEFAULT NULL,
  `id_materia` int(11) DEFAULT NULL,
  `id_curso` int(11) DEFAULT NULL,
  `punt_1` int(11) DEFAULT NULL,
  `punt_2` int(11) DEFAULT NULL,
  `promedio` decimal(5,2) DEFAULT NULL,
  `comentario` text DEFAULT NULL,
  `id_estado` int(11) DEFAULT NULL,
  `fecha_registro` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `calificacion_alumnos_historial`
--

INSERT INTO `calificacion_alumnos_historial` (`id_cal_historial`, `id_alumno`, `id_profesor`, `id_materia`, `id_curso`, `punt_1`, `punt_2`, `promedio`, `comentario`, `id_estado`, `fecha_registro`) VALUES
(1, 5, 1, 1, 1, 2, 2, '2.00', 'Casi !!!', 5, '2023-08-09 12:44:01'),
(2, 5, 1, 2, 1, 9, 9, '9.00', 'bien', 4, '2023-08-10 12:35:22'),
(3, 5, 1, 3, 1, 7, 7, '7.00', 'biennnn', 4, '2023-08-10 12:35:41'),
(4, 5, 1, 4, 1, 8, 8, '8.00', 'exelente', 4, '2023-08-10 12:36:02'),
(5, 5, 1, 5, 1, 2, 10, '6.00', 'casiii', 5, '2023-08-10 12:36:22'),
(6, 5, 1, 5, 1, 2, 10, '6.00', 'casiii', 5, '2023-08-10 12:36:26'),
(7, 5, 1, 6, 1, 1, 1, '1.00', 'pesimooo', 5, '2023-08-10 12:36:45');

-- --------------------------------------------------------

--
-- Table structure for table `curso`
--

CREATE TABLE `curso` (
  `id_curso` int(11) NOT NULL,
  `tipo` varchar(50) NOT NULL,
  `nivel` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `curso`
--

INSERT INTO `curso` (`id_curso`, `tipo`, `nivel`) VALUES
(1, 'Primero A', 1),
(2, 'Segundo B', 2),
(3, 'Tercero A', 3),
(4, 'Tercero B', 3),
(6, 'Cuarto A', 4);

-- --------------------------------------------------------

--
-- Table structure for table `curso_alumno`
--

CREATE TABLE `curso_alumno` (
  `id_ca` int(11) NOT NULL,
  `id_alumno` int(11) NOT NULL,
  `id_curso` int(11) NOT NULL,
  `id_estado` int(11) NOT NULL,
  `fecha_desde` datetime NOT NULL,
  `fech_hasta` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `curso_alumno`
--

INSERT INTO `curso_alumno` (`id_ca`, `id_alumno`, `id_curso`, `id_estado`, `fecha_desde`, `fech_hasta`) VALUES
(66, 3, 1, 1, '2023-08-04 13:23:04', '2023-08-04 13:35:34'),
(67, 5, 1, 1, '2023-08-04 13:23:08', NULL),
(68, 6, 1, 1, '2023-08-04 13:23:11', NULL),
(69, 7, 1, 1, '2023-08-04 13:23:14', '2023-08-04 13:31:41'),
(70, 7, 1, 2, '2023-08-04 13:31:41', NULL),
(71, 3, 1, 3, '2023-08-04 13:35:34', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `curso_alumno_historial`
--

CREATE TABLE `curso_alumno_historial` (
  `id_cah` int(11) NOT NULL,
  `id_ca` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `curso_alumno_historial`
--

INSERT INTO `curso_alumno_historial` (`id_cah`, `id_ca`) VALUES
(25, 66),
(26, 67),
(27, 68),
(28, 69),
(29, 70),
(30, 71);

-- --------------------------------------------------------

--
-- Table structure for table `curso_materia`
--

CREATE TABLE `curso_materia` (
  `id_cm` int(11) NOT NULL,
  `id_curso` int(11) NOT NULL,
  `id_materia` int(11) NOT NULL,
  `id_estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `curso_materia`
--

INSERT INTO `curso_materia` (`id_cm`, `id_curso`, `id_materia`, `id_estado`) VALUES
(10, 1, 1, 1),
(11, 1, 2, 1),
(12, 1, 3, 1),
(4, 1, 4, 1),
(9, 1, 5, 1),
(7, 1, 6, 1),
(2, 2, 3, 1),
(5, 3, 1, 1),
(8, 3, 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `curso_profe`
--

CREATE TABLE `curso_profe` (
  `id_cp` int(11) NOT NULL,
  `id_profesor` int(11) NOT NULL,
  `id_curso` int(11) NOT NULL,
  `id_estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `curso_profe`
--

INSERT INTO `curso_profe` (`id_cp`, `id_profesor`, `id_curso`, `id_estado`) VALUES
(4, 1, 1, 1),
(2, 1, 2, 1),
(3, 1, 4, 1),
(1, 7, 3, 2),
(5, 9, 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `estado`
--

CREATE TABLE `estado` (
  `id_estado` int(11) NOT NULL,
  `tipo` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `estado`
--

INSERT INTO `estado` (`id_estado`, `tipo`) VALUES
(1, 'Activo'),
(2, 'Inactivo'),
(3, 'Finalizado'),
(4, 'Aprobado'),
(5, 'Desaprobado');

-- --------------------------------------------------------

--
-- Table structure for table `materia`
--

CREATE TABLE `materia` (
  `id_materia` int(11) NOT NULL,
  `tipo` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `materia`
--

INSERT INTO `materia` (`id_materia`, `tipo`) VALUES
(1, 'Matematica'),
(2, 'Lengua'),
(3, 'Deporte'),
(4, 'Historia'),
(5, 'Arte'),
(6, 'Biologia');

-- --------------------------------------------------------

--
-- Table structure for table `profesores`
--

CREATE TABLE `profesores` (
  `id_profesor` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellido` varchar(50) NOT NULL,
  `correo` varchar(50) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `contraseña` varchar(50) NOT NULL,
  `id_sexo` int(11) NOT NULL,
  `id_estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `profesores`
--

INSERT INTO `profesores` (`id_profesor`, `nombre`, `apellido`, `correo`, `usuario`, `contraseña`, `id_sexo`, `id_estado`) VALUES
(1, 'Franco', 'Coria', 'coria9404@gmail.com', 'admin', '1234', 1, 1),
(7, 'pepito', 'dada', 'marito@gmail.com', 'pepe10', '1212', 1, 2),
(9, 'Emilia', 'Gonzalez', 'emiliawey@gmail.com', 'emilia10', '1234', 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `profe_materia`
--

CREATE TABLE `profe_materia` (
  `id_pm` int(11) NOT NULL,
  `id_profesor` int(11) NOT NULL,
  `id_materia` int(11) NOT NULL,
  `id_estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `profe_materia`
--

INSERT INTO `profe_materia` (`id_pm`, `id_profesor`, `id_materia`, `id_estado`) VALUES
(3, 1, 1, 1),
(2, 1, 2, 1),
(5, 1, 3, 1),
(6, 1, 4, 1),
(7, 1, 5, 1),
(8, 1, 6, 1),
(1, 7, 4, 2),
(4, 9, 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `sexo`
--

CREATE TABLE `sexo` (
  `id_sexo` int(11) NOT NULL,
  `tipo` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sexo`
--

INSERT INTO `sexo` (`id_sexo`, `tipo`) VALUES
(1, 'Masculino'),
(2, 'Femenino');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `administradores`
--
ALTER TABLE `administradores`
  ADD PRIMARY KEY (`id_admin`),
  ADD KEY `id_sexo` (`id_sexo`,`id_estado`),
  ADD KEY `id_estado` (`id_estado`);

--
-- Indexes for table `alumnos`
--
ALTER TABLE `alumnos`
  ADD PRIMARY KEY (`id_alumno`),
  ADD KEY `id_sexo` (`id_sexo`,`id_estado`),
  ADD KEY `id_estado` (`id_estado`);

--
-- Indexes for table `calificacion_alumnos`
--
ALTER TABLE `calificacion_alumnos`
  ADD PRIMARY KEY (`id_calificacion`),
  ADD KEY `id_alumno` (`id_alumno`,`id_profesor`,`id_materia`,`id_curso`,`id_estado`),
  ADD KEY `id_profesor` (`id_profesor`),
  ADD KEY `id_materia` (`id_materia`),
  ADD KEY `id_curso` (`id_curso`),
  ADD KEY `id_estado` (`id_estado`);

--
-- Indexes for table `calificacion_alumnos_historial`
--
ALTER TABLE `calificacion_alumnos_historial`
  ADD PRIMARY KEY (`id_cal_historial`),
  ADD KEY `id_alumno` (`id_alumno`),
  ADD KEY `id_profesor` (`id_profesor`),
  ADD KEY `id_materia` (`id_materia`),
  ADD KEY `id_curso` (`id_curso`),
  ADD KEY `id_estado` (`id_estado`);

--
-- Indexes for table `curso`
--
ALTER TABLE `curso`
  ADD PRIMARY KEY (`id_curso`);

--
-- Indexes for table `curso_alumno`
--
ALTER TABLE `curso_alumno`
  ADD PRIMARY KEY (`id_ca`),
  ADD KEY `id_alumno` (`id_alumno`,`id_curso`,`id_estado`),
  ADD KEY `id_curso` (`id_curso`),
  ADD KEY `id_estado` (`id_estado`);

--
-- Indexes for table `curso_alumno_historial`
--
ALTER TABLE `curso_alumno_historial`
  ADD PRIMARY KEY (`id_cah`),
  ADD KEY `id_ca` (`id_ca`);

--
-- Indexes for table `curso_materia`
--
ALTER TABLE `curso_materia`
  ADD PRIMARY KEY (`id_cm`),
  ADD KEY `id_curso` (`id_curso`,`id_materia`,`id_estado`),
  ADD KEY `id_materia` (`id_materia`),
  ADD KEY `id_estado` (`id_estado`);

--
-- Indexes for table `curso_profe`
--
ALTER TABLE `curso_profe`
  ADD PRIMARY KEY (`id_cp`),
  ADD KEY `id_profesor` (`id_profesor`,`id_curso`,`id_estado`),
  ADD KEY `id_curso` (`id_curso`),
  ADD KEY `id_estado` (`id_estado`);

--
-- Indexes for table `estado`
--
ALTER TABLE `estado`
  ADD PRIMARY KEY (`id_estado`);

--
-- Indexes for table `materia`
--
ALTER TABLE `materia`
  ADD PRIMARY KEY (`id_materia`);

--
-- Indexes for table `profesores`
--
ALTER TABLE `profesores`
  ADD PRIMARY KEY (`id_profesor`),
  ADD KEY `id_sexo` (`id_sexo`,`id_estado`),
  ADD KEY `id_estado` (`id_estado`);

--
-- Indexes for table `profe_materia`
--
ALTER TABLE `profe_materia`
  ADD PRIMARY KEY (`id_pm`),
  ADD KEY `id_profesor` (`id_profesor`,`id_materia`,`id_estado`),
  ADD KEY `id_materia` (`id_materia`),
  ADD KEY `id_estado` (`id_estado`);

--
-- Indexes for table `sexo`
--
ALTER TABLE `sexo`
  ADD PRIMARY KEY (`id_sexo`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `administradores`
--
ALTER TABLE `administradores`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `alumnos`
--
ALTER TABLE `alumnos`
  MODIFY `id_alumno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `calificacion_alumnos`
--
ALTER TABLE `calificacion_alumnos`
  MODIFY `id_calificacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `calificacion_alumnos_historial`
--
ALTER TABLE `calificacion_alumnos_historial`
  MODIFY `id_cal_historial` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `curso`
--
ALTER TABLE `curso`
  MODIFY `id_curso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `curso_alumno`
--
ALTER TABLE `curso_alumno`
  MODIFY `id_ca` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT for table `curso_alumno_historial`
--
ALTER TABLE `curso_alumno_historial`
  MODIFY `id_cah` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `curso_materia`
--
ALTER TABLE `curso_materia`
  MODIFY `id_cm` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `curso_profe`
--
ALTER TABLE `curso_profe`
  MODIFY `id_cp` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `estado`
--
ALTER TABLE `estado`
  MODIFY `id_estado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `materia`
--
ALTER TABLE `materia`
  MODIFY `id_materia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `profesores`
--
ALTER TABLE `profesores`
  MODIFY `id_profesor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `profe_materia`
--
ALTER TABLE `profe_materia`
  MODIFY `id_pm` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `sexo`
--
ALTER TABLE `sexo`
  MODIFY `id_sexo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `administradores`
--
ALTER TABLE `administradores`
  ADD CONSTRAINT `administradores_ibfk_1` FOREIGN KEY (`id_sexo`) REFERENCES `sexo` (`id_sexo`) ON UPDATE CASCADE,
  ADD CONSTRAINT `administradores_ibfk_2` FOREIGN KEY (`id_estado`) REFERENCES `estado` (`id_estado`) ON UPDATE CASCADE;

--
-- Constraints for table `alumnos`
--
ALTER TABLE `alumnos`
  ADD CONSTRAINT `alumnos_ibfk_1` FOREIGN KEY (`id_sexo`) REFERENCES `sexo` (`id_sexo`) ON UPDATE CASCADE,
  ADD CONSTRAINT `alumnos_ibfk_2` FOREIGN KEY (`id_estado`) REFERENCES `estado` (`id_estado`) ON UPDATE CASCADE;

--
-- Constraints for table `calificacion_alumnos`
--
ALTER TABLE `calificacion_alumnos`
  ADD CONSTRAINT `calificacion_alumnos_ibfk_1` FOREIGN KEY (`id_alumno`) REFERENCES `alumnos` (`id_alumno`) ON UPDATE CASCADE,
  ADD CONSTRAINT `calificacion_alumnos_ibfk_2` FOREIGN KEY (`id_profesor`) REFERENCES `profesores` (`id_profesor`) ON UPDATE CASCADE,
  ADD CONSTRAINT `calificacion_alumnos_ibfk_3` FOREIGN KEY (`id_materia`) REFERENCES `materia` (`id_materia`) ON UPDATE CASCADE,
  ADD CONSTRAINT `calificacion_alumnos_ibfk_4` FOREIGN KEY (`id_curso`) REFERENCES `curso` (`id_curso`) ON UPDATE CASCADE,
  ADD CONSTRAINT `calificacion_alumnos_ibfk_5` FOREIGN KEY (`id_estado`) REFERENCES `estado` (`id_estado`) ON UPDATE CASCADE;

--
-- Constraints for table `calificacion_alumnos_historial`
--
ALTER TABLE `calificacion_alumnos_historial`
  ADD CONSTRAINT `calificacion_alumnos_historial_ibfk_1` FOREIGN KEY (`id_alumno`) REFERENCES `alumnos` (`id_alumno`),
  ADD CONSTRAINT `calificacion_alumnos_historial_ibfk_2` FOREIGN KEY (`id_profesor`) REFERENCES `profesores` (`id_profesor`),
  ADD CONSTRAINT `calificacion_alumnos_historial_ibfk_3` FOREIGN KEY (`id_materia`) REFERENCES `materia` (`id_materia`),
  ADD CONSTRAINT `calificacion_alumnos_historial_ibfk_4` FOREIGN KEY (`id_curso`) REFERENCES `curso` (`id_curso`),
  ADD CONSTRAINT `calificacion_alumnos_historial_ibfk_5` FOREIGN KEY (`id_estado`) REFERENCES `estado` (`id_estado`);

--
-- Constraints for table `curso_alumno`
--
ALTER TABLE `curso_alumno`
  ADD CONSTRAINT `curso_alumno_ibfk_1` FOREIGN KEY (`id_alumno`) REFERENCES `alumnos` (`id_alumno`) ON UPDATE CASCADE,
  ADD CONSTRAINT `curso_alumno_ibfk_2` FOREIGN KEY (`id_curso`) REFERENCES `curso` (`id_curso`) ON DELETE CASCADE,
  ADD CONSTRAINT `curso_alumno_ibfk_3` FOREIGN KEY (`id_estado`) REFERENCES `estado` (`id_estado`) ON UPDATE CASCADE;

--
-- Constraints for table `curso_alumno_historial`
--
ALTER TABLE `curso_alumno_historial`
  ADD CONSTRAINT `curso_alumno_historial_ibfk_1` FOREIGN KEY (`id_ca`) REFERENCES `curso_alumno` (`id_ca`) ON UPDATE CASCADE;

--
-- Constraints for table `curso_materia`
--
ALTER TABLE `curso_materia`
  ADD CONSTRAINT `curso_materia_ibfk_1` FOREIGN KEY (`id_curso`) REFERENCES `curso` (`id_curso`) ON UPDATE CASCADE,
  ADD CONSTRAINT `curso_materia_ibfk_2` FOREIGN KEY (`id_materia`) REFERENCES `materia` (`id_materia`) ON UPDATE CASCADE,
  ADD CONSTRAINT `curso_materia_ibfk_3` FOREIGN KEY (`id_estado`) REFERENCES `estado` (`id_estado`) ON UPDATE CASCADE;

--
-- Constraints for table `curso_profe`
--
ALTER TABLE `curso_profe`
  ADD CONSTRAINT `curso_profe_ibfk_1` FOREIGN KEY (`id_profesor`) REFERENCES `profesores` (`id_profesor`) ON UPDATE CASCADE,
  ADD CONSTRAINT `curso_profe_ibfk_2` FOREIGN KEY (`id_curso`) REFERENCES `curso` (`id_curso`) ON UPDATE CASCADE,
  ADD CONSTRAINT `curso_profe_ibfk_3` FOREIGN KEY (`id_estado`) REFERENCES `estado` (`id_estado`) ON UPDATE CASCADE;

--
-- Constraints for table `profesores`
--
ALTER TABLE `profesores`
  ADD CONSTRAINT `profesores_ibfk_1` FOREIGN KEY (`id_sexo`) REFERENCES `sexo` (`id_sexo`) ON UPDATE CASCADE,
  ADD CONSTRAINT `profesores_ibfk_2` FOREIGN KEY (`id_estado`) REFERENCES `estado` (`id_estado`) ON UPDATE CASCADE;

--
-- Constraints for table `profe_materia`
--
ALTER TABLE `profe_materia`
  ADD CONSTRAINT `profe_materia_ibfk_1` FOREIGN KEY (`id_profesor`) REFERENCES `profesores` (`id_profesor`) ON UPDATE CASCADE,
  ADD CONSTRAINT `profe_materia_ibfk_2` FOREIGN KEY (`id_materia`) REFERENCES `materia` (`id_materia`) ON UPDATE CASCADE,
  ADD CONSTRAINT `profe_materia_ibfk_3` FOREIGN KEY (`id_estado`) REFERENCES `estado` (`id_estado`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
