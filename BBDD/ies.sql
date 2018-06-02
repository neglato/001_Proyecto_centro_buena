-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 02-06-2018 a las 14:47:28
-- Versión del servidor: 10.1.26-MariaDB
-- Versión de PHP: 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `ies`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentarios`
--

CREATE TABLE `comentarios` (
  `id_comentario` int(11) NOT NULL,
  `id_proyecto` int(11) NOT NULL,
  `usuario` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `comentario` varchar(255) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `comentarios`
--

INSERT INTO `comentarios` (`id_comentario`, `id_proyecto`, `usuario`, `comentario`) VALUES
(1, 3, 'Dani Domínguez', 'Estubo bastante bien, muy entretenido, pasamos un buen rato'),
(3, 5, 'migue', 'un coñazo hacerlo'),
(4, 5, 'Dani Domínguez', 'ya ves, pensaba que nunca lo \r\nacabariamos'),
(5, 3, 'Anonimo', 'Yo estube por ayi y antonio oliva \r\nlos apalizo a todos'),
(6, 4, 'Pablo', 'Yo estube ayi, aunque fue en \r\nbolivia, pille un avion y me plante \r\nallí, para que al final me ganase el \r\nque sale en la foto'),
(7, 5, 'Moon', 'Jajajajajaja toda la tarde de todos \r\nlos días liados!!'),
(10, 3, 'Domingo', 'mu bonito');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cursos`
--

CREATE TABLE `cursos` (
  `id_curso` int(11) NOT NULL,
  `curso` varchar(255) COLLATE utf8mb4_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `cursos`
--

INSERT INTO `cursos` (`id_curso`, `curso`) VALUES
(1, '2017-2018'),
(2, '2016-2017'),
(3, '2015-2016');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `imagenes_ies`
--

CREATE TABLE `imagenes_ies` (
  `id_img` tinyint(4) NOT NULL,
  `nombre_img` varchar(255) COLLATE utf8mb4_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `imagenes_ies`
--

INSERT INTO `imagenes_ies` (`id_img`, `nombre_img`) VALUES
(2, 'hall+escalera.jpg'),
(3, 'IES-escalera1.jpg'),
(4, 'pasillo-profesores.jpg'),
(5, 'patio1.jpg'),
(6, 'patio2.jpg'),
(7, 'patio3.jpg'),
(8, 'pasillo-profesores2.jpg'),
(9, 'aula-arte1.jpg'),
(10, 'aula-arte3.jpg'),
(11, 'aula-arte2.jpg'),
(12, 'aula-2asir.jpg'),
(13, 'gimnasio1.jpg'),
(18, 'gimnasio2.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `imgproy`
--

CREATE TABLE `imgproy` (
  `id_img` int(11) NOT NULL,
  `id_proyecto` int(11) NOT NULL,
  `imagen` varchar(255) COLLATE utf8mb4_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `imgproy`
--

INSERT INTO `imgproy` (`id_img`, `id_proyecto`, `imagen`) VALUES
(1, 3, 'ajedrez01.jpg'),
(2, 3, 'ajedrez02.jpg'),
(3, 3, 'ajedrez03.jpg'),
(4, 3, 'ajedrez04.jpg'),
(5, 5, 'creaciona.jpg'),
(6, 5, 'creacionb.jpg'),
(7, 5, 'creacionc.jpg'),
(8, 5, 'creacion4.jpg'),
(9, 5, 'creacion5.jpg'),
(10, 5, 'creacion6.jpg'),
(15, 4, 'sia2.jpg'),
(16, 4, 'poe1.jpg'),
(27, 2, 'eco1.jpg'),
(28, 2, 'ecoescuela2.jpg'),
(29, 2, 'waaa005.jpg'),
(33, 24, 'Screenshot_1.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proyectos`
--

CREATE TABLE `proyectos` (
  `id_proyecto` int(11) NOT NULL,
  `id_curso` int(11) NOT NULL,
  `fecha_pub` date NOT NULL,
  `nombre_pro` varchar(255) COLLATE utf8mb4_spanish_ci NOT NULL,
  `name_pro` varchar(255) COLLATE utf8mb4_spanish_ci NOT NULL,
  `contenido` varchar(255) COLLATE utf8mb4_spanish_ci NOT NULL DEFAULT '1es.php',
  `content` varchar(255) COLLATE utf8mb4_spanish_ci NOT NULL DEFAULT '1en.php',
  `mostrar` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `proyectos`
--

INSERT INTO `proyectos` (`id_proyecto`, `id_curso`, `fecha_pub`, `nombre_pro`, `name_pro`, `contenido`, `content`, `mostrar`) VALUES
(2, 1, '2018-03-17', 'Eco-escuela', 'Eco-School', '1es.php', '1en.php', 1),
(3, 1, '2018-04-22', 'Ajedrez', 'Chess', '1es.php', '1en.php', 1),
(4, 2, '2016-03-01', 'Concurso de Poesía', 'Poetry Contest', '1es.php', '1en.php', 1),
(5, 1, '2018-03-18', 'Creación de este Proyecto', 'Creation of this Project', '1es.php', '1en.php', 1),
(19, 3, '2015-01-01', 'Hola', 'Hellow', '1es.php', '1en.php', 0),
(20, 3, '2018-05-13', 'Prueba', 'Test', '1es.php', '1en.php', 0),
(24, 1, '2018-05-13', 'Correo', 'Email', '1es.php', '1en.php', 0),
(28, 1, '2018-05-19', 'Variable pruebas', 'Variable test', '1es.php', '1en.php', 0),
(29, 1, '0000-00-00', 'Y', 'U', '1es.php', '1en.php', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_user` int(11) NOT NULL,
  `nombre` varchar(255) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `apellidos` varchar(255) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `sexo` int(11) NOT NULL,
  `foto` varchar(255) COLLATE utf8mb4_spanish2_ci NOT NULL DEFAULT 'img.jpg',
  `email` varchar(255) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `codigo_recuperacion` varchar(255) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `baja` tinyint(1) NOT NULL DEFAULT '0',
  `tipo` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_user`, `nombre`, `apellidos`, `sexo`, `foto`, `email`, `password`, `codigo_recuperacion`, `baja`, `tipo`) VALUES
(1, 'Dani', 'Admin', 0, 'img.jpg', 'ddl@hotmail.com', '64f5088480973464637fefd371de4c4f', '', 0, 0),
(2, 'Miguel Angel', 'Romero Pinto', 0, 'img.jpg', 'marp@hotmail.es', '64f5088480973464637fefd371de4c4f', '', 0, 0),
(3, 'Pepe', 'Moscoso García', 0, 'img.jpg', 'pepe@moscoso.es', '64f5088480973464637fefd371de4c4f', '', 0, 1),
(4, 'Pablo', 'Suricato', 0, 'img.jpg', 'pablo@suri.es', '64f5088480973464637fefd371de4c4f', '', 0, 2),
(5, 'María', 'Vazquez', 1, 'img.jpg', 'maria@hotmail.com', '64f5088480973464637fefd371de4c4f', '', 0, 1),
(6, 'Juan', 'Ramirez', 0, 'img.jpg', 'juan@juan.com', '64f5088480973464637fefd371de4c4f', '', 0, 2),
(7, 'Da', 'Flores', 0, 'img.jpg', 'da@flores.es', '64f5088480973464637fefd371de4c4f', '', 0, 2),
(8, 'Isa', 'Noseque', 1, 'img.jpg', 'isa@gmail.es', '64f5088480973464637fefd371de4c4f', '', 0, 1),
(9, 'Julio', 'Lopez', 0, 'img.jpg', 'julio@gmail.es', '64f5088480973464637fefd371de4c4f', '', 0, 2),
(10, 'Manuel', 'Lucero', 0, 'img.jpg', 'manue@lucero.es', '64f5088480973464637fefd371de4c4f', '', 0, 1),
(11, 'Alberto', 'Rodriguez', 0, 'img.jpg', 'alberto@gmail.es', '64f5088480973464637fefd371de4c4f', '', 0, 2),
(12, 'abm', 'abm', 0, 'img.jpg', 'abm@abm.com', '64f5088480973464637fefd371de4c4f', '', 1, 0),
(13, 'Dani', 'Hhvg', 0, 'img.jpg', 'a@a.es', '64f5088480973464637fefd371de4c4f', '', 0, 2),
(14, 'Dani', 'Fhhcf', 0, 'img.jpg', 'b@b.es', '64f5088480973464637fefd371de4c4f', '', 1, 2),
(18, 'Ygfrh', 'Jvfhhv', 0, 'img.jpg', 'c@c.es', '64f5088480973464637fefd371de4c4f', '', 0, 1),
(19, 'Admin', 'Admin', 0, 'img.jpg', 'idhappmaster@gmail.com', '64f5088480973464637fefd371de4c4f', '', 0, 0),
(24, 'Miguel angel', 'Romero', 0, 'img.jpg', 'miguelangelromeropinto@gmail.com', '64f5088480973464637fefd371de4c4f', '', 1, 2),
(31, 'Dani', 'Coordina', 0, 'img.jpg', 'dani--ef-@hotmail.com', '64f5088480973464637fefd371de4c4f', '', 0, 1),
(58, 'Dani', 'Prueba', 0, 'img.jpg', 'neglato@gmail.com', '64f5088480973464637fefd371de4c4f', '', 0, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuproy`
--

CREATE TABLE `usuproy` (
  `id_proyecto` int(11) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `usuproy`
--

INSERT INTO `usuproy` (`id_proyecto`, `id_user`) VALUES
(2, 4),
(2, 6),
(2, 7),
(2, 10),
(3, 3),
(3, 4),
(3, 6),
(3, 7),
(4, 3),
(4, 7),
(4, 9),
(4, 11),
(5, 7),
(5, 9),
(5, 10),
(19, 3),
(19, 24),
(20, 3),
(20, 24),
(28, 31),
(29, 31);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `comentarios`
--
ALTER TABLE `comentarios`
  ADD PRIMARY KEY (`id_comentario`),
  ADD KEY `id_proyecto` (`id_proyecto`);

--
-- Indices de la tabla `cursos`
--
ALTER TABLE `cursos`
  ADD PRIMARY KEY (`id_curso`);

--
-- Indices de la tabla `imagenes_ies`
--
ALTER TABLE `imagenes_ies`
  ADD PRIMARY KEY (`id_img`);

--
-- Indices de la tabla `imgproy`
--
ALTER TABLE `imgproy`
  ADD PRIMARY KEY (`id_img`),
  ADD KEY `id_proyecto` (`id_proyecto`);

--
-- Indices de la tabla `proyectos`
--
ALTER TABLE `proyectos`
  ADD PRIMARY KEY (`id_proyecto`),
  ADD KEY `Foreign_key` (`id_curso`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `id_user` (`id_user`);

--
-- Indices de la tabla `usuproy`
--
ALTER TABLE `usuproy`
  ADD KEY `id_proyecto` (`id_proyecto`,`id_user`),
  ADD KEY `id_user` (`id_user`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `comentarios`
--
ALTER TABLE `comentarios`
  MODIFY `id_comentario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `cursos`
--
ALTER TABLE `cursos`
  MODIFY `id_curso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `imagenes_ies`
--
ALTER TABLE `imagenes_ies`
  MODIFY `id_img` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `imgproy`
--
ALTER TABLE `imgproy`
  MODIFY `id_img` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT de la tabla `proyectos`
--
ALTER TABLE `proyectos`
  MODIFY `id_proyecto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `comentarios`
--
ALTER TABLE `comentarios`
  ADD CONSTRAINT `comentarios_ibfk_1` FOREIGN KEY (`id_proyecto`) REFERENCES `proyectos` (`id_proyecto`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `imgproy`
--
ALTER TABLE `imgproy`
  ADD CONSTRAINT `imgproy_ibfk_1` FOREIGN KEY (`id_proyecto`) REFERENCES `proyectos` (`id_proyecto`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `proyectos`
--
ALTER TABLE `proyectos`
  ADD CONSTRAINT `Foreign_key` FOREIGN KEY (`id_curso`) REFERENCES `cursos` (`id_curso`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuproy`
--
ALTER TABLE `usuproy`
  ADD CONSTRAINT `usuproy_ibfk_1` FOREIGN KEY (`id_proyecto`) REFERENCES `proyectos` (`id_proyecto`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `usuproy_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `usuarios` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
