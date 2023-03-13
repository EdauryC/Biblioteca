-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 27-10-2021 a las 02:59:06
-- Versión del servidor: 10.4.18-MariaDB
-- Versión de PHP: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `biblioteca`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria_libro`
--

CREATE TABLE `categoria_libro` (
  `id_categoria_libro` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `descripcion` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `categoria_libro`
--

INSERT INTO `categoria_libro` (`id_categoria_libro`, `nombre`, `descripcion`) VALUES
(10, 'Bibliografía', 'Bibliografía'),
(20, 'Bibliotecología y ciencias de la información', 'Bibliotecología y ciencias de la información'),
(30, 'Enciclopedias generales', 'Enciclopedias generales'),
(40, 'Libre', 'Libre'),
(50, 'Publicaciones en serie', 'Publicaciones en serie'),
(60, 'Organizaciones y museografía', 'Organizaciones y museografía'),
(70, 'Periodismo, editoriales, diarios', 'Periodismo, editoriales, diarios'),
(80, 'Colecciones generales', 'Colecciones generales'),
(90, 'Manuscritos y libros raros', 'Manuscritos y libros raros'),
(100, 'Filosofía y psicología', 'Filosofía y psicología'),
(110, 'Metafísica', 'Metafísica'),
(120, 'Conocimiento, causa, fin, hombre', 'Conocimiento, causa, fin, hombre'),
(130, 'Parapsicología, ocultismo, fenómenos paranorm', 'Parapsicología, ocultismo, fenómenos paranorm'),
(140, 'Escuelas filosóficas específicas', 'Escuelas filosóficas específicas'),
(150, 'Psicología', 'Psicología'),
(160, 'Lógica', 'Lógica'),
(170, 'Ética (filosofía moral)', 'Ética (filosofía moral)'),
(180, 'Filosofía antigua, medieval, oriental', 'Filosofía antigua, medieval, oriental'),
(190, 'Filosofía moderna occidental', 'Filosofía moderna occidental'),
(200, 'Religión', 'Religión'),
(210, 'Filosofía y teoría de la religión', 'Filosofía y teoría de la religión'),
(220, 'Biblia', 'Biblia'),
(230, 'Teología cristiana', 'Teología cristiana'),
(240, 'Moral y prácticas cristianas', 'Moral y prácticas cristianas'),
(250, 'Iglesia local y órdenes religiosas', 'Iglesia local y órdenes religiosas'),
(260, 'Teología social y eclesiástica', 'Teología social y eclesiástica'),
(270, 'Historia y geografía de la iglesia cristiana', 'Historia y geografía de la iglesia cristiana'),
(280, 'Credos y sectas de la iglesia cristiana', 'Credos y sectas de la iglesia cristiana'),
(290, 'Otras religiones', 'Otras religiones'),
(300, 'Ciencias sociales', 'Ciencias sociales'),
(310, 'Estadística', 'Estadística'),
(320, 'Ciencia política', 'Ciencia política'),
(330, 'Economía', 'Economía'),
(340, 'Derecho', 'Derecho'),
(350, 'Administración pública y ciencia militar', 'Administración pública y ciencia militar'),
(360, 'Problemas y servicios sociales', 'Problemas y servicios sociales'),
(370, 'Educación', 'Educación'),
(380, 'Comercio, comunicaciones y transporte', 'Comercio, comunicaciones y transporte'),
(390, 'Costumbres y folklore', 'Costumbres y folklore'),
(400, 'Lenguas ', 'Lenguas '),
(401, 'Generalidades', 'Generalidades'),
(410, 'Lingüística', 'Lingüística'),
(420, 'Inglés e inglés antiguo', 'Inglés e inglés antiguo'),
(430, 'Lenguas germánicas; alemán', 'Lenguas germánicas; alemán'),
(440, 'Lenguas romances; francés', 'Lenguas romances; francés'),
(450, 'Italiano, rumano, rético', 'Italiano, rumano, rético'),
(460, 'Español y portugués', 'Español y portugués'),
(470, 'Lenguas itálicas; latín', 'Lenguas itálicas; latín'),
(480, 'Lenguas helénicas; griego clásico', 'Lenguas helénicas; griego clásico'),
(490, 'Otras lenguas', 'Otras lenguas'),
(500, 'Matemáticas y ciencias naturales', 'Matemáticas y ciencias naturales'),
(510, 'Matemáticas', 'Matemáticas'),
(520, 'Astronomía y ciencias afines', 'Astronomía y ciencias afines'),
(530, 'Física', 'Física'),
(540, 'Química y ciencias afines', 'Química y ciencias afines'),
(550, 'Geociencias', 'Geociencias'),
(560, 'Paleontología. paleozoología', 'Paleontología. paleozoología'),
(570, 'Ciencias biológicas', 'Ciencias biológicas'),
(580, 'Ciencias botánicas', 'Ciencias botánicas'),
(590, 'Ciencias zoológicas', 'Ciencias zoológicas'),
(600, 'Tecnología y ciencias aplicadas', 'Tecnología y ciencias aplicadas'),
(610, 'Ciencias médicas', 'Ciencias médicas'),
(620, 'Ingeniería y operaciones afines', 'Ingeniería y operaciones afines'),
(630, 'Agricultura y tecnologías afines', 'Agricultura y tecnologías afines'),
(640, 'Economía doméstica', 'Economía doméstica'),
(650, 'Servicios administrativos empresariales', 'Servicios administrativos empresariales'),
(660, 'Química industrial', 'Química industrial'),
(670, 'Manufacturas', 'Manufacturas'),
(680, 'Manufacturas varias', 'Manufacturas varias'),
(690, 'Construcciones', 'Construcciones'),
(700, 'Artes', 'Artes'),
(710, 'Urbanismo y arquitectura del paisaje', 'Urbanismo y arquitectura del paisaje'),
(720, 'Arquitectura', 'Arquitectura'),
(730, 'Artes plásticas; escultura', 'Artes plásticas; escultura'),
(740, 'Dibujo, artes decorativas', 'Dibujo, artes decorativas'),
(750, 'Pintura y pinturas', 'Pintura y pinturas'),
(760, 'Artes gráficas; grabados', 'Artes gráficas; grabados'),
(770, 'Fotografía y fotografías', 'Fotografía y fotografías'),
(780, 'Música', 'Música'),
(790, 'Entretenimiento', 'Entretenimiento'),
(800, 'Literatura', 'Literatura'),
(810, 'Literatura americana en inglés', 'Literatura americana en inglés'),
(820, 'Literatura inglesa e inglesa antigua', 'Literatura inglesa e inglesa antigua'),
(830, 'Literaturas germánicas', 'Literaturas germánicas'),
(840, 'Literaturas de las lenguas romances', 'Literaturas de las lenguas romances'),
(850, 'Literaturas italiana, rumana', 'Literaturas italiana, rumana'),
(860, 'Literaturas española y portuguesa', 'Literaturas española y portuguesa'),
(870, 'Literaturas de las lenguas itálicas', 'Literaturas de las lenguas itálicas'),
(880, 'Literaturas de las lenguas helénicas', 'Literaturas de las lenguas helénicas'),
(890, 'Literaturas de otras lenguas', 'Literaturas de otras lenguas'),
(900, 'Historia y geografía', 'Historia y geografía'),
(910, 'Geografía; viajes', 'Geografía; viajes'),
(920, 'Biografía y genealogía', 'Biografía y genealogía'),
(930, 'Historia del mundo antiguo', 'Historia del mundo antiguo'),
(940, 'Historia de Europa', 'Historia de Europa'),
(950, 'Historia de Asia', 'Historia de Asia'),
(960, 'Historia de África', 'Historia de África'),
(970, 'Historia de América del Norte', 'Historia de América del Norte'),
(980, 'Historia de América del Sur', 'Historia de América del Sur'),
(990, 'Historia de otras regiones', 'Historia de otras regiones');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleado`
--

CREATE TABLE `empleado` (
  `id_empleado` int(11) NOT NULL,
  `n_cedula` varchar(45) NOT NULL,
  `nombres` varchar(45) NOT NULL,
  `apellidos` varchar(45) NOT NULL,
  `correo` varchar(45) NOT NULL,
  `usuario` varchar(45) NOT NULL,
  `clave` varchar(45) NOT NULL,
  `tipo_empleado_id_tipo_empleado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `empleado`
--

INSERT INTO `empleado` (`id_empleado`, `n_cedula`, `nombres`, `apellidos`, `correo`, `usuario`, `clave`, `tipo_empleado_id_tipo_empleado`) VALUES
(1, '123456', 'JOSE ANTONIO', 'PEREZ CONTRERAS', 'MAIL@MAIL.COM', 'JAPEREZ', '12345', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `libro`
--

CREATE TABLE `libro` (
  `id_libro` int(11) NOT NULL,
  `codigo` varchar(45) NOT NULL,
  `autor` varchar(100) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `descripcion` varchar(150) DEFAULT NULL,
  `n_ejemplares` int(11) NOT NULL,
  `status` varchar(45) NOT NULL,
  `ISNB` varchar(45) DEFAULT NULL,
  `categoria_libro_id_categoria_libro` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `libro`
--

INSERT INTO `libro` (`id_libro`, `codigo`, `autor`, `nombre`, `descripcion`, `n_ejemplares`, `status`, `ISNB`, `categoria_libro_id_categoria_libro`) VALUES
(1, '12-34-56', 'AURELIO BALDOR', 'ALGEBRA DE BALDOR', 'ES UN LIBRO DE ARITMÉTICA Y MATEMÁTICAS CON MULTIPLES EJERCICIOS Y EJEMPLOS', 25, '1', '978-7-1587-6', 510),
(2, '11-22-33', 'DANSO DELAPAZ TAMEZ', 'LA OSAMENTA ESTUDIANTE', 'LA OSAMENTA ESTUDIANTE, ES UNA OBRA DEL AUTOR VENEZOLANO DANSO DELAPAZ TAMEZ. PERTENECE AL GENERO DE CIENCIA FICCIÓN‎, PUBLICADO EN 1963 POR LA EDITOR', 5, '1', '98-0890-976-0', 800),
(3, '11-33-22', 'VALLIS CERVANTEZ CARRION', 'EL ALCOHOL MAQUINISTA', 'LOREM IPSUM DOLOR SIT AMET, CONSECTETUR ADIPISCING ELIT, SED DO EIUSMOD TEMPOR INCIDIDUNT UT LABORE ET DOLORE MAGNA ALIQUA. ULTRICIES MI QUIS HENDRERI', 10, '1', '98-0746-756-1', 550),
(4, '33-22-11', 'AUTOR PROBANDO', 'EL SABOREAR MECÁNICO', 'ELEMENTUM SAGITTIS VITAE ET LEO. GRAVIDA ARCU AC TORTOR DIGNISSIM CONVALLIS AENEAN ET. ULLAMCORPER MALESUADA PROIN LIBERO NUNC CONSEQUAT INTERDUM VARI', 5, '1', '98-0873-341-7', 380),
(5, '55-44-33', 'ABRAM DELAGARZA MONTANO', 'EL CALCETÍN PEZ', 'QUIS RISUS SED VULPUTATE ODIO UT. DIAM VOLUTPAT COMMODO SED EGESTAS EGESTAS FRINGILLA. VEHICULA IPSUM A ARCU CURSUS VITAE CONGUE MAURIS. ID EU NISL NU', 2, '1', '98-0756-861-7', 100);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `libro_x_prestamo`
--

CREATE TABLE `libro_x_prestamo` (
  `libro_id_libro` int(11) NOT NULL,
  `prestamo_id_prestamo` int(11) NOT NULL,
  `codigo_ejemplar` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `prestamo`
--

CREATE TABLE `prestamo` (
  `id_prestamo` int(11) NOT NULL,
  `status` varchar(45) NOT NULL,
  `fecha_prestamo` date NOT NULL,
  `fecha_vencimiento` date NOT NULL,
  `usuario_id_usuario` int(11) NOT NULL,
  `empleado_id_empleado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sancion`
--

CREATE TABLE `sancion` (
  `id_sancion` int(11) NOT NULL,
  `status` varchar(45) NOT NULL,
  `fecha_inicio` date NOT NULL,
  `fecha_fin` date NOT NULL,
  `usuario_id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_empleado`
--

CREATE TABLE `tipo_empleado` (
  `id_tipo_empleado` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `descripcion` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tipo_empleado`
--

INSERT INTO `tipo_empleado` (`id_tipo_empleado`, `nombre`, `descripcion`) VALUES
(1, 'Ayudante', 'Ayudante de la Biblioteca'),
(2, 'Empleado', 'Empleado adscrito a la Biblioteca'),
(3, 'Administrador', 'Administrador adscrito a la Biblioteca');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id_usuario` int(11) NOT NULL,
  `n_cedula` varchar(45) NOT NULL,
  `nombres` varchar(45) NOT NULL,
  `apellidos` varchar(45) NOT NULL,
  `status` varchar(45) NOT NULL,
  `usuario` varchar(45) NOT NULL,
  `clave` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `n_cedula`, `nombres`, `apellidos`, `status`, `usuario`, `clave`) VALUES
(1, '123456', 'ALGUNOS NOMBRES', 'APELLIDOS EJEMPLO', 'activo', 'USER', 'USER');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categoria_libro`
--
ALTER TABLE `categoria_libro`
  ADD PRIMARY KEY (`id_categoria_libro`);

--
-- Indices de la tabla `empleado`
--
ALTER TABLE `empleado`
  ADD PRIMARY KEY (`id_empleado`,`tipo_empleado_id_tipo_empleado`),
  ADD UNIQUE KEY `correo_UNIQUE` (`correo`),
  ADD UNIQUE KEY `usuario_UNIQUE` (`usuario`),
  ADD UNIQUE KEY `n_cedula_UNIQUE` (`n_cedula`),
  ADD KEY `fk_empleado_tipo_empleado1_idx` (`tipo_empleado_id_tipo_empleado`);

--
-- Indices de la tabla `libro`
--
ALTER TABLE `libro`
  ADD PRIMARY KEY (`id_libro`,`categoria_libro_id_categoria_libro`),
  ADD KEY `fk_libro_categoria_libro1_idx` (`categoria_libro_id_categoria_libro`);

--
-- Indices de la tabla `libro_x_prestamo`
--
ALTER TABLE `libro_x_prestamo`
  ADD PRIMARY KEY (`libro_id_libro`,`prestamo_id_prestamo`),
  ADD KEY `fk_libro_x_prestamo_prestamo1_idx` (`prestamo_id_prestamo`);

--
-- Indices de la tabla `prestamo`
--
ALTER TABLE `prestamo`
  ADD PRIMARY KEY (`id_prestamo`,`usuario_id_usuario`,`empleado_id_empleado`),
  ADD KEY `fk_prestamo_usuario1_idx` (`usuario_id_usuario`),
  ADD KEY `fk_prestamo_empleado1_idx` (`empleado_id_empleado`);

--
-- Indices de la tabla `sancion`
--
ALTER TABLE `sancion`
  ADD PRIMARY KEY (`id_sancion`,`usuario_id_usuario`),
  ADD KEY `fk_sancion_usuario1_idx` (`usuario_id_usuario`);

--
-- Indices de la tabla `tipo_empleado`
--
ALTER TABLE `tipo_empleado`
  ADD PRIMARY KEY (`id_tipo_empleado`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usuario`),
  ADD UNIQUE KEY `n_cedula_UNIQUE` (`n_cedula`),
  ADD UNIQUE KEY `usuario_UNIQUE` (`usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categoria_libro`
--
ALTER TABLE `categoria_libro`
  MODIFY `id_categoria_libro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=991;

--
-- AUTO_INCREMENT de la tabla `empleado`
--
ALTER TABLE `empleado`
  MODIFY `id_empleado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `libro`
--
ALTER TABLE `libro`
  MODIFY `id_libro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `prestamo`
--
ALTER TABLE `prestamo`
  MODIFY `id_prestamo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `sancion`
--
ALTER TABLE `sancion`
  MODIFY `id_sancion` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tipo_empleado`
--
ALTER TABLE `tipo_empleado`
  MODIFY `id_tipo_empleado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `empleado`
--
ALTER TABLE `empleado`
  ADD CONSTRAINT `fk_empleado_tipo_empleado1` FOREIGN KEY (`tipo_empleado_id_tipo_empleado`) REFERENCES `tipo_empleado` (`id_tipo_empleado`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `libro`
--
ALTER TABLE `libro`
  ADD CONSTRAINT `fk_libro_categoria_libro1` FOREIGN KEY (`categoria_libro_id_categoria_libro`) REFERENCES `categoria_libro` (`id_categoria_libro`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `libro_x_prestamo`
--
ALTER TABLE `libro_x_prestamo`
  ADD CONSTRAINT `fk_libro_x_prestamo_libro1` FOREIGN KEY (`libro_id_libro`) REFERENCES `libro` (`id_libro`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_libro_x_prestamo_prestamo1` FOREIGN KEY (`prestamo_id_prestamo`) REFERENCES `prestamo` (`id_prestamo`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `prestamo`
--
ALTER TABLE `prestamo`
  ADD CONSTRAINT `fk_prestamo_empleado1` FOREIGN KEY (`empleado_id_empleado`) REFERENCES `empleado` (`id_empleado`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_prestamo_usuario1` FOREIGN KEY (`usuario_id_usuario`) REFERENCES `usuario` (`id_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `sancion`
--
ALTER TABLE `sancion`
  ADD CONSTRAINT `fk_sancion_usuario1` FOREIGN KEY (`usuario_id_usuario`) REFERENCES `usuario` (`id_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
