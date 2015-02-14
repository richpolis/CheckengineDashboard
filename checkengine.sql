-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 12-02-2015 a las 23:57:30
-- Versión del servidor: 5.6.21
-- Versión de PHP: 5.5.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `checkengine`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `amigos`
--

CREATE TABLE IF NOT EXISTS `amigos` (
  `usuario_source` int(11) NOT NULL,
  `usuario_target` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `busquedas`
--

CREATE TABLE IF NOT EXISTS `busquedas` (
`id` int(11) NOT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `busca` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `clicks` int(11) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentarios`
--

CREATE TABLE IF NOT EXISTS `comentarios` (
`id` int(11) NOT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `comentario` longtext COLLATE utf8_unicode_ci NOT NULL,
  `calificacion` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contacto_comentarios`
--

CREATE TABLE IF NOT EXISTS `contacto_comentarios` (
  `contacto_id` int(11) NOT NULL,
  `comentario_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresas`
--

CREATE TABLE IF NOT EXISTS `empresas` (
`id` int(11) NOT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `rubro` longtext COLLATE utf8_unicode_ci,
  `sucursal` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `direccion` longtext COLLATE utf8_unicode_ci,
  `rut` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `region` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `comuna` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `horarios` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `imagen` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ubicacion_longitud` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ubicacion_latitud` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `empresas`
--

INSERT INTO `empresas` (`id`, `usuario_id`, `nombre`, `rubro`, `sucursal`, `direccion`, `rut`, `region`, `comuna`, `horarios`, `imagen`, `ubicacion_longitud`, `ubicacion_latitud`, `is_active`, `created_at`, `updated_at`) VALUES
(3, 6, 'Refaccionionaria Don Pancho SA de CV', 'Refacciones de todo tipo de repuestos', 'Centro', 'En algun lugar', '123.113.234-4', 'RM', 'Coyoacan', 'De lunes a viernes 9am a 9pm, sabados de 9am a 1pm.', '9905147a6e7e46e4ae7d919a412c3e9098ae1dfc.jpeg', NULL, NULL, 1, '2015-02-01 18:06:38', '2015-02-01 18:06:38'),
(4, 6, 'Taller Don Pepe SA de CV', 'Taller mecanico en general', 'Norte', 'en algun lugar', '12345.1234.54-1', 'RM', 'Gustavo A. Madero', 'De lunes a viernes 9am a 9pm, sabados de 9am a 1pm.', '42ee84df7c6b2629d778bfb38d520a395f9bf6a2.jpeg', NULL, NULL, 1, '2015-02-01 18:12:49', '2015-02-01 18:12:49');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresa_comentarios`
--

CREATE TABLE IF NOT EXISTS `empresa_comentarios` (
  `empresa_id` int(11) NOT NULL,
  `comentario_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresa_especialidades`
--

CREATE TABLE IF NOT EXISTS `empresa_especialidades` (
  `empresa_id` int(11) NOT NULL,
  `especialidad_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `empresa_especialidades`
--

INSERT INTO `empresa_especialidades` (`empresa_id`, `especialidad_id`) VALUES
(4, 1),
(4, 2),
(4, 3),
(4, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresa_servicios`
--

CREATE TABLE IF NOT EXISTS `empresa_servicios` (
  `empresa_id` int(11) NOT NULL,
  `servicio_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresa_tipos`
--

CREATE TABLE IF NOT EXISTS `empresa_tipos` (
  `empresa_id` int(11) NOT NULL,
  `tipoempresa_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `empresa_tipos`
--

INSERT INTO `empresa_tipos` (`empresa_id`, `tipoempresa_id`) VALUES
(3, 10),
(4, 10);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `especialidades`
--

CREATE TABLE IF NOT EXISTS `especialidades` (
`id` int(11) NOT NULL,
  `tipo_empresa_id` int(11) DEFAULT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `orden` int(11) NOT NULL,
  `imagen` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `especialidades`
--

INSERT INTO `especialidades` (`id`, `tipo_empresa_id`, `nombre`, `orden`, `imagen`, `created_at`, `updated_at`) VALUES
(1, 10, 'Mecánica General', 1, NULL, '2015-01-31 22:57:50', '2015-01-31 22:57:50'),
(2, 10, 'Desabolladura y Pintura', 2, NULL, '2015-01-31 22:57:50', '2015-01-31 22:57:50'),
(3, 10, 'Frenos', 3, NULL, '2015-01-31 22:57:50', '2015-01-31 22:57:50'),
(4, 10, 'Suspensión', 4, NULL, '2015-01-31 22:57:50', '2015-01-31 22:57:50'),
(5, 10, 'Electricidad', 5, NULL, '2015-01-31 22:57:50', '2015-01-31 22:57:50'),
(6, 10, 'Alineación y balanceo', 6, NULL, '2015-01-31 22:57:50', '2015-01-31 22:57:50'),
(7, 11, 'Cambio de aceite', 1, NULL, '2015-01-31 22:57:50', '2015-01-31 22:57:50'),
(8, 11, 'Mantención', 2, NULL, '2015-01-31 22:57:50', '2015-01-31 22:57:50'),
(9, 11, 'Limpieza Inyectores', 3, NULL, '2015-01-31 22:57:50', '2015-01-31 22:57:50'),
(10, 11, 'Aditivos', 4, NULL, '2015-01-31 22:57:50', '2015-01-31 22:57:50'),
(11, 11, 'Revisión Niveles', 5, NULL, '2015-01-31 22:57:50', '2015-01-31 22:57:50'),
(12, 11, 'Accesorios', 6, NULL, '2015-01-31 22:57:50', '2015-01-31 22:57:50'),
(13, NULL, 'Seguro', 1, NULL, '2015-01-31 22:57:50', '2015-01-31 22:57:50'),
(14, NULL, 'Carreteras', 2, NULL, '2015-01-31 22:57:50', '2015-01-31 22:57:50'),
(15, NULL, 'Grua', 3, NULL, '2015-01-31 22:57:50', '2015-01-31 22:57:50'),
(16, NULL, 'Vulcanización', 4, NULL, '2015-01-31 22:57:50', '2015-01-31 22:57:50'),
(17, NULL, 'Peajes', 5, NULL, '2015-01-31 22:57:50', '2015-01-31 22:57:50'),
(18, NULL, 'Urgencias', 6, NULL, '2015-01-31 22:57:50', '2015-01-31 22:57:50');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `favoritos`
--

CREATE TABLE IF NOT EXISTS `favoritos` (
`id` int(11) NOT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `empresa_id` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `no_ofertas`
--

CREATE TABLE IF NOT EXISTS `no_ofertas` (
  `usuario_id` int(11) NOT NULL,
  `empresa_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ofertas`
--

CREATE TABLE IF NOT EXISTS `ofertas` (
`id` int(11) NOT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `titulo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `descripcion` longtext COLLATE utf8_unicode_ci NOT NULL,
  `tipo` int(11) NOT NULL,
  `tipo_oferta` int(11) NOT NULL,
  `oferta` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `banner` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `inicia` date NOT NULL,
  `termina` date NOT NULL,
  `tipo_pago` int(11) NOT NULL,
  `marcas` int(11) NOT NULL,
  `modelos` int(11) NOT NULL,
  `clicks` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `is_active` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `oferta_comentarios`
--

CREATE TABLE IF NOT EXISTS `oferta_comentarios` (
  `oferta_id` int(11) NOT NULL,
  `comentario_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `oferta_sucursales`
--

CREATE TABLE IF NOT EXISTS `oferta_sucursales` (
  `oferta_id` int(11) NOT NULL,
  `empresa_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Par`
--

CREATE TABLE IF NOT EXISTS `Par` (
`id` int(11) NOT NULL,
  `oferta` int(11) NOT NULL,
  `marca` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `modelo` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `preguntas`
--

CREATE TABLE IF NOT EXISTS `preguntas` (
`id` int(11) NOT NULL,
  `pregunta` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `respuesta` longtext COLLATE utf8_unicode_ci NOT NULL,
  `orden` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicios`
--

CREATE TABLE IF NOT EXISTS `servicios` (
`id` int(11) NOT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tickets`
--

CREATE TABLE IF NOT EXISTS `tickets` (
`id` int(11) NOT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipos_empresa`
--

CREATE TABLE IF NOT EXISTS `tipos_empresa` (
`id` int(11) NOT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `orden` int(11) NOT NULL,
  `imagen` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `tipos_empresa`
--

INSERT INTO `tipos_empresa` (`id`, `nombre`, `orden`, `imagen`, `created_at`, `updated_at`) VALUES
(10, 'Taller Mecánico', 1, NULL, '2015-01-31 22:57:50', '2015-01-31 22:57:50'),
(11, 'Lubricentros', 2, NULL, '2015-01-31 22:57:50', '2015-01-31 22:57:50'),
(12, 'Llantas y Neumáticos', 3, NULL, '2015-01-31 22:57:50', '2015-01-31 22:57:50'),
(13, 'Lavado', 4, NULL, '2015-01-31 22:57:50', '2015-01-31 22:57:50'),
(14, 'Asistencia de ruta', 5, NULL, '2015-01-31 22:57:50', '2015-01-31 22:57:50'),
(15, 'Estacionamiento', 6, NULL, '2015-01-31 22:57:50', '2015-01-31 22:57:50'),
(16, 'Seguridad', 7, NULL, '2015-01-31 22:57:50', '2015-01-31 22:57:50'),
(17, 'Repuestos y Accesorios', 8, NULL, '2015-01-31 22:57:50', '2015-01-31 22:57:50'),
(18, 'Car Audio', 9, NULL, '2015-01-31 22:57:50', '2015-01-31 22:57:50');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
`id` int(11) NOT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `apellidos` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `imagen` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `salt` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `celular` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fecha_nacimiento` date DEFAULT NULL,
  `genero` int(11) DEFAULT NULL,
  `ubicacion_longitud` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ubicacion_latitud` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL,
  `grupo` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `facebook_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `facebook_access_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `token_celular` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `marca_celular` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `apellidos`, `imagen`, `email`, `password`, `salt`, `celular`, `fecha_nacimiento`, `genero`, `ubicacion_longitud`, `ubicacion_latitud`, `is_active`, `grupo`, `created_at`, `updated_at`, `facebook_id`, `facebook_access_token`, `token_celular`, `marca_celular`) VALUES
(4, 'Administrador', 'General', NULL, 'admin@checkengine.com', 'LT14MEPX9U8cxyTCfKrJInkRVeu+dFNtycIDjf6GV96ULnAKdVMJk124Hut4EpyTxJlv8yBGrMqb5m+E4d+qeQ==', 'gu19ks4onbk84koskk4oco8ww4goooo', NULL, NULL, 1, NULL, NULL, 1, 3, '2015-01-31 22:57:50', '2015-01-31 22:57:50', NULL, NULL, NULL, NULL),
(6, 'Ricardo', 'Alcantara', NULL, 'richpolis@hotmail.com', 'gAJMOgeEEPhO3zlyNL1F1YRvRq+XGkIXZz94VufiXmtcyuDJRxnOJtVAgMKWzFJYsOiBqmmD2BEWMpylsZ+Mwg==', 'thdtccov6lw8ws0s4gcgk0k8kk08s8o', NULL, NULL, 1, NULL, NULL, 1, 1, '2015-01-31 22:57:50', '2015-01-31 22:57:50', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario_amigos`
--

CREATE TABLE IF NOT EXISTS `usuario_amigos` (
  `usuario_source` int(11) NOT NULL,
  `usuario_target` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario_favoritos`
--

CREATE TABLE IF NOT EXISTS `usuario_favoritos` (
  `usuario_id` int(11) NOT NULL,
  `empresa_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vehiculos`
--

CREATE TABLE IF NOT EXISTS `vehiculos` (
`id` int(11) NOT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `tipo` int(11) NOT NULL,
  `marca` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `modelo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `year` int(11) NOT NULL,
  `puertas` int(11) NOT NULL,
  `cilindros` int(11) NOT NULL,
  `kms` bigint(20) NOT NULL,
  `combustible` int(11) NOT NULL,
  `transmision` int(11) NOT NULL,
  `seguro` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `amigos`
--
ALTER TABLE `amigos`
 ADD PRIMARY KEY (`usuario_source`,`usuario_target`), ADD KEY `IDX_3317FC62A5989C7A` (`usuario_source`), ADD KEY `IDX_3317FC62BC7DCCF5` (`usuario_target`);

--
-- Indices de la tabla `busquedas`
--
ALTER TABLE `busquedas`
 ADD PRIMARY KEY (`id`), ADD KEY `IDX_AA2C47B8DB38439E` (`usuario_id`);

--
-- Indices de la tabla `comentarios`
--
ALTER TABLE `comentarios`
 ADD PRIMARY KEY (`id`), ADD KEY `IDX_F54B3FC0DB38439E` (`usuario_id`);

--
-- Indices de la tabla `contacto_comentarios`
--
ALTER TABLE `contacto_comentarios`
 ADD PRIMARY KEY (`contacto_id`,`comentario_id`), ADD KEY `IDX_803852256B505CA9` (`contacto_id`), ADD KEY `IDX_80385225F3F2D7EC` (`comentario_id`);

--
-- Indices de la tabla `empresas`
--
ALTER TABLE `empresas`
 ADD PRIMARY KEY (`id`), ADD KEY `IDX_70DD49A5DB38439E` (`usuario_id`);

--
-- Indices de la tabla `empresa_comentarios`
--
ALTER TABLE `empresa_comentarios`
 ADD PRIMARY KEY (`empresa_id`,`comentario_id`), ADD KEY `IDX_43EDA427521E1991` (`empresa_id`), ADD KEY `IDX_43EDA427F3F2D7EC` (`comentario_id`);

--
-- Indices de la tabla `empresa_especialidades`
--
ALTER TABLE `empresa_especialidades`
 ADD PRIMARY KEY (`empresa_id`,`especialidad_id`), ADD KEY `IDX_1E536D01521E1991` (`empresa_id`), ADD KEY `IDX_1E536D0116A490EC` (`especialidad_id`);

--
-- Indices de la tabla `empresa_servicios`
--
ALTER TABLE `empresa_servicios`
 ADD PRIMARY KEY (`empresa_id`,`servicio_id`), ADD KEY `IDX_CCC81250521E1991` (`empresa_id`), ADD KEY `IDX_CCC8125071CAA3E7` (`servicio_id`);

--
-- Indices de la tabla `empresa_tipos`
--
ALTER TABLE `empresa_tipos`
 ADD PRIMARY KEY (`empresa_id`,`tipoempresa_id`), ADD KEY `IDX_771D2BAC521E1991` (`empresa_id`), ADD KEY `IDX_771D2BACFDEC07C2` (`tipoempresa_id`);

--
-- Indices de la tabla `especialidades`
--
ALTER TABLE `especialidades`
 ADD PRIMARY KEY (`id`), ADD KEY `IDX_1FFEFE9EC3981BB9` (`tipo_empresa_id`);

--
-- Indices de la tabla `favoritos`
--
ALTER TABLE `favoritos`
 ADD PRIMARY KEY (`id`), ADD KEY `IDX_1E86887FDB38439E` (`usuario_id`), ADD KEY `IDX_1E86887F521E1991` (`empresa_id`);

--
-- Indices de la tabla `no_ofertas`
--
ALTER TABLE `no_ofertas`
 ADD PRIMARY KEY (`usuario_id`,`empresa_id`), ADD KEY `IDX_F6DD0927DB38439E` (`usuario_id`), ADD KEY `IDX_F6DD0927521E1991` (`empresa_id`);

--
-- Indices de la tabla `ofertas`
--
ALTER TABLE `ofertas`
 ADD PRIMARY KEY (`id`), ADD KEY `IDX_48C925F3DB38439E` (`usuario_id`);

--
-- Indices de la tabla `oferta_comentarios`
--
ALTER TABLE `oferta_comentarios`
 ADD PRIMARY KEY (`oferta_id`,`comentario_id`), ADD KEY `IDX_BF390C0BFAFBF624` (`oferta_id`), ADD KEY `IDX_BF390C0BF3F2D7EC` (`comentario_id`);

--
-- Indices de la tabla `oferta_sucursales`
--
ALTER TABLE `oferta_sucursales`
 ADD PRIMARY KEY (`oferta_id`,`empresa_id`), ADD KEY `IDX_E22B2954FAFBF624` (`oferta_id`), ADD KEY `IDX_E22B2954521E1991` (`empresa_id`);

--
-- Indices de la tabla `Par`
--
ALTER TABLE `Par`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `preguntas`
--
ALTER TABLE `preguntas`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `servicios`
--
ALTER TABLE `servicios`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tickets`
--
ALTER TABLE `tickets`
 ADD PRIMARY KEY (`id`), ADD KEY `IDX_54469DF4DB38439E` (`usuario_id`);

--
-- Indices de la tabla `tipos_empresa`
--
ALTER TABLE `tipos_empresa`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuario_amigos`
--
ALTER TABLE `usuario_amigos`
 ADD PRIMARY KEY (`usuario_source`,`usuario_target`), ADD KEY `IDX_C9051F6BA5989C7A` (`usuario_source`), ADD KEY `IDX_C9051F6BBC7DCCF5` (`usuario_target`);

--
-- Indices de la tabla `usuario_favoritos`
--
ALTER TABLE `usuario_favoritos`
 ADD PRIMARY KEY (`usuario_id`,`empresa_id`), ADD KEY `IDX_97BD626DDB38439E` (`usuario_id`), ADD KEY `IDX_97BD626D521E1991` (`empresa_id`);

--
-- Indices de la tabla `vehiculos`
--
ALTER TABLE `vehiculos`
 ADD PRIMARY KEY (`id`), ADD KEY `IDX_82CE64A7DB38439E` (`usuario_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `busquedas`
--
ALTER TABLE `busquedas`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `comentarios`
--
ALTER TABLE `comentarios`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `empresas`
--
ALTER TABLE `empresas`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `especialidades`
--
ALTER TABLE `especialidades`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT de la tabla `favoritos`
--
ALTER TABLE `favoritos`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `ofertas`
--
ALTER TABLE `ofertas`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `Par`
--
ALTER TABLE `Par`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `preguntas`
--
ALTER TABLE `preguntas`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `servicios`
--
ALTER TABLE `servicios`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tickets`
--
ALTER TABLE `tickets`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tipos_empresa`
--
ALTER TABLE `tipos_empresa`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `vehiculos`
--
ALTER TABLE `vehiculos`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `amigos`
--
ALTER TABLE `amigos`
ADD CONSTRAINT `FK_3317FC62A5989C7A` FOREIGN KEY (`usuario_source`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE,
ADD CONSTRAINT `FK_3317FC62BC7DCCF5` FOREIGN KEY (`usuario_target`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `busquedas`
--
ALTER TABLE `busquedas`
ADD CONSTRAINT `FK_AA2C47B8DB38439E` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`);

--
-- Filtros para la tabla `comentarios`
--
ALTER TABLE `comentarios`
ADD CONSTRAINT `FK_F54B3FC0DB38439E` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`);

--
-- Filtros para la tabla `contacto_comentarios`
--
ALTER TABLE `contacto_comentarios`
ADD CONSTRAINT `FK_803852256B505CA9` FOREIGN KEY (`contacto_id`) REFERENCES `tickets` (`id`) ON DELETE CASCADE,
ADD CONSTRAINT `FK_80385225F3F2D7EC` FOREIGN KEY (`comentario_id`) REFERENCES `comentarios` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `empresas`
--
ALTER TABLE `empresas`
ADD CONSTRAINT `FK_70DD49A5DB38439E` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`);

--
-- Filtros para la tabla `empresa_comentarios`
--
ALTER TABLE `empresa_comentarios`
ADD CONSTRAINT `FK_43EDA427521E1991` FOREIGN KEY (`empresa_id`) REFERENCES `empresas` (`id`) ON DELETE CASCADE,
ADD CONSTRAINT `FK_43EDA427F3F2D7EC` FOREIGN KEY (`comentario_id`) REFERENCES `comentarios` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `empresa_especialidades`
--
ALTER TABLE `empresa_especialidades`
ADD CONSTRAINT `FK_1E536D0116A490EC` FOREIGN KEY (`especialidad_id`) REFERENCES `especialidades` (`id`) ON DELETE CASCADE,
ADD CONSTRAINT `FK_1E536D01521E1991` FOREIGN KEY (`empresa_id`) REFERENCES `empresas` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `empresa_servicios`
--
ALTER TABLE `empresa_servicios`
ADD CONSTRAINT `FK_CCC81250521E1991` FOREIGN KEY (`empresa_id`) REFERENCES `empresas` (`id`) ON DELETE CASCADE,
ADD CONSTRAINT `FK_CCC8125071CAA3E7` FOREIGN KEY (`servicio_id`) REFERENCES `servicios` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `empresa_tipos`
--
ALTER TABLE `empresa_tipos`
ADD CONSTRAINT `FK_771D2BAC521E1991` FOREIGN KEY (`empresa_id`) REFERENCES `empresas` (`id`) ON DELETE CASCADE,
ADD CONSTRAINT `FK_771D2BACFDEC07C2` FOREIGN KEY (`tipoempresa_id`) REFERENCES `tipos_empresa` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `especialidades`
--
ALTER TABLE `especialidades`
ADD CONSTRAINT `FK_1FFEFE9EC3981BB9` FOREIGN KEY (`tipo_empresa_id`) REFERENCES `tipos_empresa` (`id`);

--
-- Filtros para la tabla `favoritos`
--
ALTER TABLE `favoritos`
ADD CONSTRAINT `FK_1E86887F521E1991` FOREIGN KEY (`empresa_id`) REFERENCES `empresas` (`id`),
ADD CONSTRAINT `FK_1E86887FDB38439E` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`);

--
-- Filtros para la tabla `no_ofertas`
--
ALTER TABLE `no_ofertas`
ADD CONSTRAINT `FK_F6DD0927521E1991` FOREIGN KEY (`empresa_id`) REFERENCES `empresas` (`id`) ON DELETE CASCADE,
ADD CONSTRAINT `FK_F6DD0927DB38439E` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `ofertas`
--
ALTER TABLE `ofertas`
ADD CONSTRAINT `FK_48C925F3DB38439E` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`);

--
-- Filtros para la tabla `oferta_comentarios`
--
ALTER TABLE `oferta_comentarios`
ADD CONSTRAINT `FK_BF390C0BF3F2D7EC` FOREIGN KEY (`comentario_id`) REFERENCES `comentarios` (`id`) ON DELETE CASCADE,
ADD CONSTRAINT `FK_BF390C0BFAFBF624` FOREIGN KEY (`oferta_id`) REFERENCES `ofertas` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `oferta_sucursales`
--
ALTER TABLE `oferta_sucursales`
ADD CONSTRAINT `FK_E22B2954521E1991` FOREIGN KEY (`empresa_id`) REFERENCES `empresas` (`id`) ON DELETE CASCADE,
ADD CONSTRAINT `FK_E22B2954FAFBF624` FOREIGN KEY (`oferta_id`) REFERENCES `ofertas` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `tickets`
--
ALTER TABLE `tickets`
ADD CONSTRAINT `FK_54469DF4DB38439E` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`);

--
-- Filtros para la tabla `usuario_amigos`
--
ALTER TABLE `usuario_amigos`
ADD CONSTRAINT `FK_C9051F6BA5989C7A` FOREIGN KEY (`usuario_source`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE,
ADD CONSTRAINT `FK_C9051F6BBC7DCCF5` FOREIGN KEY (`usuario_target`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `usuario_favoritos`
--
ALTER TABLE `usuario_favoritos`
ADD CONSTRAINT `FK_97BD626D521E1991` FOREIGN KEY (`empresa_id`) REFERENCES `empresas` (`id`) ON DELETE CASCADE,
ADD CONSTRAINT `FK_97BD626DDB38439E` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `vehiculos`
--
ALTER TABLE `vehiculos`
ADD CONSTRAINT `FK_82CE64A7DB38439E` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
