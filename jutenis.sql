-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 15-09-2020 a las 22:05:33
-- Versión del servidor: 10.4.6-MariaDB
-- Versión de PHP: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `jutenis`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `acl_roles`
--

CREATE TABLE `acl_roles` (
  `cod_role` int(11) NOT NULL,
  `nombre` varchar(30) COLLATE utf8_spanish2_ci NOT NULL,
  `puede_acceder` tinyint(1) NOT NULL DEFAULT 0,
  `puede_configurar` tinyint(1) NOT NULL DEFAULT 0,
  `permiso1` tinyint(1) NOT NULL DEFAULT 0,
  `permiso2` tinyint(1) NOT NULL DEFAULT 0,
  `permiso3` tinyint(1) NOT NULL DEFAULT 0,
  `permiso4` tinyint(1) NOT NULL DEFAULT 0,
  `permiso5` tinyint(1) NOT NULL DEFAULT 0,
  `permiso6` tinyint(1) NOT NULL DEFAULT 0,
  `permiso7` tinyint(1) NOT NULL DEFAULT 0,
  `permiso8` tinyint(1) NOT NULL DEFAULT 0,
  `permiso9` tinyint(1) NOT NULL DEFAULT 0,
  `permiso10` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `acl_roles`
--

INSERT INTO `acl_roles` (`cod_role`, `nombre`, `puede_acceder`, `puede_configurar`, `permiso1`, `permiso2`, `permiso3`, `permiso4`, `permiso5`, `permiso6`, `permiso7`, `permiso8`, `permiso9`, `permiso10`) VALUES
(1, 'administradores', 1, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(2, 'usuarios', 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(3, 'organizadores', 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `acl_usuarios`
--

CREATE TABLE `acl_usuarios` (
  `cod_usuario` int(11) NOT NULL,
  `nombre` varchar(30) COLLATE utf8_spanish2_ci NOT NULL,
  `nick` varchar(30) COLLATE utf8_spanish2_ci NOT NULL,
  `contrasena` varchar(32) COLLATE utf8_spanish2_ci NOT NULL,
  `cod_role` int(11) NOT NULL,
  `borrado` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `acl_usuarios`
--

INSERT INTO `acl_usuarios` (`cod_usuario`, `nombre`, `nick`, `contrasena`, `cod_role`, `borrado`) VALUES
(1, 'Samuel', 'samuel', 'f41d85c1553b4c8be0dd748eb3399d42', 1, 0),
(2, 'Matias', 'matias', 'b31bf053dcc6827ffa9411c727022c10', 3, 0),
(3, 'Fátima', 'fatima', '416dce982380c307d91fbbd03694a537', 2, 0),
(4, 'Roman', 'Roman', '21875efcb013afd78e13ae92749ce7f8', 2, 0),
(5, 'prueba', 'pruebaju', '437fdcfae788217c022f68c8a3308af7', 2, 0),
(6, 'prueba1', 'prueba1', 'cc9f3c693bf40ff1a0cec2e5152614af', 2, 0);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `cons_acl_usuarios`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `cons_acl_usuarios` (
`cod_usuario` int(11)
,`nombre` varchar(30)
,`nick` varchar(30)
,`contrasena` varchar(32)
,`cod_role` int(11)
,`borrado` tinyint(1)
,`nombre_role` varchar(30)
);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `eventos`
--

CREATE TABLE `eventos` (
  `cod_evento` int(11) NOT NULL,
  `titulo` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `contenido` varchar(3000) COLLATE utf8_spanish2_ci NOT NULL,
  `fecha` date NOT NULL,
  `cod_poblacion` int(11) NOT NULL,
  `edad_requerida` int(2) NOT NULL,
  `edad_maxima` int(11) NOT NULL DEFAULT 0,
  `cod_tipo_evento` int(11) NOT NULL,
  `aforo` int(11) NOT NULL,
  `borrado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `eventos`
--

INSERT INTO `eventos` (`cod_evento`, `titulo`, `contenido`, `fecha`, `cod_poblacion`, `edad_requerida`, `edad_maxima`, `cod_tipo_evento`, `aforo`, `borrado`) VALUES
(1, 'Evento de prueba nº1', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi dapibus tempus ex, sit amet sodales magna suscipit quis. Phasellus rhoncus commodo nisl, id auctor tortor dictum nec. Sed risus ipsum, posuere ac dignissim in, feugiat ut massa. In vulputate ut eros quis dignissim. Quisque volutpat faucibus fermentum. Praesent laoreet sapien massa, a mattis felis accumsan a. Aenean sed elit vitae lectus malesuada vulputate.</p>\r\n<p>&nbsp;</p>\r\n<p>Duis maximus ligula eu arcu molestie, vel efficitur odio ullamcorper. Morbi non dolor magna. Ut viverra euismod tellus, vitae egestas lectus aliquet euismod. Curabitur iaculis ornare interdum. Mauris vitae justo tempor, faucibus tellus id, dignissim leo.</p>', '2020-06-17', 7, 16, 22, 2, 10, 0),
(2, 'Evento de prueba nº2', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi dapibus tempus ex, sit amet sodales magna suscipit quis. Phasellus rhoncus commodo nisl, id auctor tortor dictum nec. Sed risus ipsum, posuere ac dignissim in, feugiat ut massa. In vulputate ut eros quis dignissim. Quisque volutpat faucibus fermentum. Praesent laoreet sapien massa, a mattis felis accumsan a. Aenean sed elit vitae lectus malesuada vulputate.</p>\r\n<p>&nbsp;</p>\r\n<p>Duis maximus ligula eu arcu molestie, vel efficitur odio ullamcorper. Morbi non dolor magna. Ut viverra euismod tellus, vitae egestas lectus aliquet euismod. Curabitur iaculis ornare interdum. Mauris vitae justo tempor, faucibus tellus id, dignissim leo.</p>', '2020-06-22', 4, 20, 50, 3, 6, 0),
(3, 'Evento de prueba nº5', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi dapibus tempus ex, sit amet sodales magna suscipit quis. Phasellus rhoncus commodo nisl, id auctor tortor dictum nec. Sed risus ipsum, posuere ac dignissim in, feugiat ut massa. In vulputate ut eros quis dignissim. Quisque volutpat faucibus fermentum. Praesent laoreet sapien massa, a mattis felis accumsan a. Aenean sed elit vitae lectus malesuada vulputate.dasdasdasdasdasdasd</p>\r\n<p>&nbsp;</p>\r\n<p>Duis maximus ligula eu arcu molestie, vel efficitur odio ullamcorper. Morbi non dolor magna. Ut viverra euismod tellus, vitae egestas lectus aliquet euismod. Curabitur iaculis ornare interdum. Mauris vitae justo tempor, faucibus tellus id, dignissim leo.</p>', '2021-06-14', 3, 5, 60, 2, 3, 0),
(4, 'Mejora física y mentalmenteee', '<p>contenido de prueba</p>\r\n<p>contenido de prueba</p>\r\n<p>contenido de prueba</p>\r\n<p>contenido de prueba</p>\r\n<p>contenido de prueba</p>', '2020-06-16', 5, 15, 20, 5, 1, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `eventos_usuarios`
--

CREATE TABLE `eventos_usuarios` (
  `cod_evento_usuario` int(11) NOT NULL,
  `cod_usuario` int(11) NOT NULL,
  `cod_evento` int(11) NOT NULL,
  `borrado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `eventos_usuarios`
--

INSERT INTO `eventos_usuarios` (`cod_evento_usuario`, `cod_usuario`, `cod_evento`, `borrado`) VALUES
(1, 1, 1, 0),
(2, 4, 1, 0),
(3, 1, 3, 0),
(4, 1, 4, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mensajes`
--

CREATE TABLE `mensajes` (
  `cod_mensaje` int(11) NOT NULL,
  `nombre` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `correo` varchar(320) COLLATE utf8_spanish2_ci NOT NULL,
  `mensaje` varchar(3000) COLLATE utf8_spanish2_ci NOT NULL,
  `fecha` datetime NOT NULL DEFAULT current_timestamp(),
  `borrado` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `mensajes`
--

INSERT INTO `mensajes` (`cod_mensaje`, `nombre`, `correo`, `mensaje`, `fecha`, `borrado`) VALUES
(1, 'Nombre de prueba', 'mensajedeprueba@gmail.com', 'Hola, esto es un mensaje de prueba.', '2020-06-14 20:22:18', 0),
(2, 'Nombre de prueba', 'mensajedeprueba@gmail.com', 'Hola, esto es un mensaje de prueba.', '2020-06-14 20:23:32', 0),
(3, 'nombre de prueba', 'correodeprueba@gmail.com', 'Este es un mensaje de prueba 2 ', '2020-06-14 20:24:46', 0),
(4, 'mensaje de prueba 3', 'correodeprueba@gmail.com', 'mensaje de prueba 3', '2020-06-14 20:25:43', 0),
(5, 'nombre de prueba 4', 'correodeprueba@gmail.com', 'correo de prueba 4', '2020-06-14 20:26:31', 0),
(6, 'nombre de prueba', 'samuelr1522@gmail.com', 'hola esto es un mensaje de prueba', '2020-06-16 10:03:10', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `noticias`
--

CREATE TABLE `noticias` (
  `cod_noticia` int(11) NOT NULL,
  `titulo` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `mensaje` varchar(10000) COLLATE utf8_spanish_ci NOT NULL,
  `fecha` datetime NOT NULL DEFAULT current_timestamp(),
  `imagen` varchar(1000) COLLATE utf8_spanish_ci NOT NULL,
  `autor` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `borrado` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `noticias`
--

INSERT INTO `noticias` (`cod_noticia`, `titulo`, `mensaje`, `fecha`, `imagen`, `autor`, `borrado`) VALUES
(1, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit n1.', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi dapibus tempus ex, sit amet sodales magna suscipit quis. Phasellus rhoncus commodo nisl, id auctor tortor dictum nec. Sed risus ipsum, posuere ac dignissim in, feugiat ut massa. In vulputate ut eros quis dignissim. Quisque volutpat faucibus fermentum. Praesent laoreet sapien massa, a mattis felis accumsan a. Aenean sed elit vitae lectus malesuada vulputate.</p>\r\n<p>&nbsp;</p>\r\n<p>Duis maximus ligula eu arcu molestie, vel efficitur odio ullamcorper. Morbi non dolor magna. Ut viverra euismod tellus, vitae egestas lectus aliquet euismod. Curabitur iaculis ornare interdum. Mauris vitae justo tempor, faucibus tellus id, dignissim leo. Nullam viverra ut metus eget fermentum. Duis quis ante in ante aliquam rutrum et quis orci. Aenean consequat ante ut felis facilisis consectetur sit amet ac magna. Nulla maximus vehicula tincidunt. Curabitur tristique turpis lacinia enim commodo lacinia. Curabitur accumsan tortor purus, sed consequat dui gravida vel. Phasellus gravida venenatis ipsum ut malesuada. Mauris varius ullamcorper aliquam.</p>\r\n<p>&nbsp;</p>\r\n<p>Sed consectetur turpis eget est volutpat iaculis. Nunc sem turpis, accumsan vel leo sit amet, egestas iaculis diam. Maecenas blandit malesuada condimentum. Nunc ac maximus odio. Donec sit amet tempor magna. Nam fermentum risus at augue volutpat euismod. Phasellus a nulla erat. Nam mauris ligula, feugiat vel dictum nec, sagittis ut ex. In vehicula, lectus et vulputate congue, nunc lorem condimentum erat, ac tincidunt urna ligula sed lectus. Aenean sapien tellus, volutpat eget metus eget, maximus hendrerit erat.</p>\r\n<p>&nbsp;</p>\r\n<p>Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed nisl diam, semper volutpat aliquet sed, hendrerit a lacus. Vivamus elementum velit vitae turpis rutrum dignissim. Nunc nec posuere nisi. Nullam sodales arcu at scelerisque vehicula. Nam in nisi id libero malesuada ultricies. Mauris blandit lacus id turpis vestibulum suscipit quis et enim. Aenean molestie risus id nisl tristique eleifend. Proin est metus, placerat in lacus sit amet, maximus eleifend ligula. Proin commodo non arcu vel placerat.</p>\r\n<p>&nbsp;</p>\r\n<p>Integer molestie convallis velit. Aliquam pharetra lacinia accumsan. In bibendum laoreet fermentum. Curabitur quis nulla ipsum. Suspendisse vel arcu nec lacus ultrices rhoncus. Interdum et malesuada fames ac ante ipsum primis in faucibus. Maecenas in lacus commodo, euismod lorem vitae, condimentum tellus. Proin dapibus, magna ac porttitor consequat, ante magna pharetra tellus, lacinia rutrum eros arcu sed lectus. Quisque quis ligula blandit, dapibus turpis nec, gravida eros. Maecenas placerat rutrum condimentum. Donec venenatis euismod iaculis. Nulla pharetra orci sit amet consectetur lacinia. Interdum et malesuada fames ac ante ipsum primis in faucibus.</p>', '2020-06-14 19:55:55', '', 'Samuel', 0),
(2, 'Noticia de prueba nº1', '<p>Noticia de prueba Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi dapibus tempus ex, sit amet sodales magna suscipit quis. Phasellus rhoncus commodo nisl, id auctor tortor dictum nec. Sed risus ipsum, posuere ac dignissim in, feugiat ut massa. In vulputate ut eros quis dignissim. Quisque volutpat faucibus fermentum. Praesent laoreet sapien massa, a mattis felis accumsan a. Aenean sed elit vitae lectus malesuada vulputate.</p>\r\n<p>&nbsp;</p>\r\n<p>Duis maximus ligula eu arcu molestie, vel efficitur odio ullamcorper. Morbi non dolor magna. Ut viverra euismod tellus, vitae egestas lectus aliquet euismod. Curabitur iaculis ornare interdum. Mauris vitae justo tempor, faucibus tellus id, dignissim leo. Nullam viverra ut metus eget fermentum. Duis quis ante in ante aliquam rutrum et quis orci. Aenean consequat ante ut felis facilisis consectetur sit amet ac magna. Nulla maximus vehicula tincidunt. Curabitur tristique turpis lacinia enim commodo lacinia. Curabitur accumsan tortor purus, sed consequat dui gravida vel. Phasellus gravida venenatis ipsum ut malesuada. Mauris varius ullamcorper aliquam.</p>\r\n<p>&nbsp;</p>\r\n<p>Sed consectetur turpis eget est volutpat iaculis. Nunc sem turpis, accumsan vel leo sit amet, egestas iaculis diam. Maecenas blandit malesuada condimentum. Nunc ac maximus odio. Donec sit amet tempor magna. Nam fermentum risus at augue volutpat euismod. Phasellus a nulla erat. Nam mauris ligula, feugiat vel dictum nec, sagittis ut ex. In vehicula, lectus et vulputate congue, nunc lorem condimentum erat, ac tincidunt urna ligula sed lectus. Aenean sapien tellus, volutpat eget metus eget, maximus hendrerit erat.</p>\r\n<p>&nbsp;</p>\r\n<p>Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed nisl diam, semper volutpat aliquet sed, hendrerit a lacus. Vivamus elementum velit vitae turpis rutrum dignissim. Nunc nec posuere nisi. Nullam sodales arcu at scelerisque vehicula. Nam in nisi id libero malesuada ultricies. Mauris blandit lacus id turpis vestibulum suscipit quis et enim. Aenean molestie risus id nisl tristique eleifend. Proin est metus, placerat in lacus sit amet, maximus eleifend ligula. Proin commodo non arcu vel placerat.</p>\r\n<p>&nbsp;</p>\r\n<p>Integer molestie convallis velit. Aliquam pharetra lacinia accumsan. In bibendum laoreet fermentum. Curabitur quis nulla ipsum. Suspendisse vel arcu nec lacus ultrices rhoncus. Interdum et malesuada fames ac ante ipsum primis in faucibus. Maecenas in lacus commodo, euismod lorem vitae, condimentum tellus. Proin dapibus, magna ac porttitor consequat, ante magna pharetra tellus, lacinia rutrum eros arcu sed lectus. Quisque quis ligula blandit, dapibus turpis nec, gravida eros. Maecenas placerat rutrum condimentum. Donec venenatis euismod iaculis. Nulla pharetra orci sit amet consectetur lacinia. Interdum et malesuada fames ac ante ipsum primis in faucibus.</p>', '2020-06-14 19:57:42', '159215746220770627845ee6651623f75.jpg', 'Juan', 0),
(3, 'Noticia de prueba nº2', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi dapibus tempus ex, sit amet sodales magna suscipit quis. Phasellus rhoncus commodo nisl, id auctor tortor dictum nec. Sed risus ipsum, posuere ac dignissim in, feugiat ut massa. In vulputate ut eros quis dignissim. Quisque volutpat faucibus fermentum. Praesent laoreet sapien massa, a mattis felis accumsan a. Aenean sed elit vitae lectus malesuada vulputate.</p>\r\n<p>&nbsp;</p>\r\n<p>Duis maximus ligula eu arcu molestie, vel efficitur odio ullamcorper. Morbi non dolor magna. Ut viverra euismod tellus, vitae egestas lectus aliquet euismod. Curabitur iaculis ornare interdum. Mauris vitae justo tempor, faucibus tellus id, dignissim leo. Nullam viverra ut metus eget fermentum. Duis quis ante in ante aliquam rutrum et quis orci. Aenean consequat ante ut felis facilisis consectetur sit amet ac magna. Nulla maximus vehicula tincidunt. Curabitur tristique turpis lacinia enim commodo lacinia. Curabitur accumsan tortor purus, sed consequat dui gravida vel. Phasellus gravida venenatis ipsum ut malesuada. Mauris varius ullamcorper aliquam.</p>\r\n<p>&nbsp;</p>\r\n<p>Sed consectetur turpis eget est volutpat iaculis. Nunc sem turpis, accumsan vel leo sit amet, egestas iaculis diam. Maecenas blandit malesuada condimentum. Nunc ac maximus odio. Donec sit amet tempor magna. Nam fermentum risus at augue volutpat euismod. Phasellus a nulla erat. Nam mauris ligula, feugiat vel dictum nec, sagittis ut ex. In vehicula, lectus et vulputate congue, nunc lorem condimentum erat, ac tincidunt urna ligula sed lectus. Aenean sapien tellus, volutpat eget metus eget, maximus hendrerit erat.</p>\r\n<p>&nbsp;</p>\r\n<p>Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed nisl diam, semper volutpat aliquet sed, hendrerit a lacus. Vivamus elementum velit vitae turpis rutrum dignissim. Nunc nec posuere nisi. Nullam sodales arcu at scelerisque vehicula. Nam in nisi id libero malesuada ultricies. Mauris blandit lacus id turpis vestibulum suscipit quis et enim. Aenean molestie risus id nisl tristique eleifend. Proin est metus, placerat in lacus sit amet, maximus eleifend ligula. Proin commodo non arcu vel placerat.</p>\r\n<p>&nbsp;</p>\r\n<p>Integer molestie convallis velit. Aliquam pharetra lacinia accumsan. In bibendum laoreet fermentum. Curabitur quis nulla ipsum. Suspendisse vel arcu nec lacus ultrices rhoncus. Interdum et malesuada fames ac ante ipsum primis in faucibus. Maecenas in lacus commodo, euismod lorem vitae, condimentum tellus. Proin dapibus, magna ac porttitor consequat, ante magna pharetra tellus, lacinia rutrum eros arcu sed lectus. Quisque quis ligula blandit, dapibus turpis nec, gravida eros. Maecenas placerat rutrum condimentum. Donec venenatis euismod iaculis. Nulla pharetra orci sit amet consectetur lacinia. Interdum et malesuada fames ac ante ipsum primis in faucibus.</p>', '2020-06-14 20:01:49', '159215770918454054745ee6660d12322.jpg', 'Samuel', 0),
(4, 'Noticia de prueba nº3', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi dapibus tempus ex, sit amet sodales magna suscipit quis. Phasellus rhoncus commodo nisl, id auctor tortor dictum nec. Sed risus ipsum, posuere ac dignissim in, feugiat ut massa. In vulputate ut eros quis dignissim. Quisque volutpat faucibus fermentum. Praesent laoreet sapien massa, a mattis felis accumsan a. Aenean sed elit vitae lectus malesuada vulputate.</p>\r\n<p>&nbsp;</p>\r\n<p>Duis maximus ligula eu arcu molestie, vel efficitur odio ullamcorper. Morbi non dolor magna. Ut viverra euismod tellus, vitae egestas lectus aliquet euismod. Curabitur iaculis ornare interdum. Mauris vitae justo tempor, faucibus tellus id, dignissim leo. Nullam viverra ut metus eget fermentum. Duis quis ante in ante aliquam rutrum et quis orci. Aenean consequat ante ut felis facilisis consectetur sit amet ac magna. Nulla maximus vehicula tincidunt. Curabitur tristique turpis lacinia enim commodo lacinia. Curabitur accumsan tortor purus, sed consequat dui gravida vel. Phasellus gravida venenatis ipsum ut malesuada. Mauris varius ullamcorper aliquam.</p>\r\n<p>&nbsp;</p>\r\n<p>Sed consectetur turpis eget est volutpat iaculis. Nunc sem turpis, accumsan vel leo sit amet, egestas iaculis diam. Maecenas blandit malesuada condimentum. Nunc ac maximus odio. Donec sit amet tempor magna. Nam fermentum risus at augue volutpat euismod. Phasellus a nulla erat. Nam mauris ligula, feugiat vel dictum nec, sagittis ut ex. In vehicula, lectus et vulputate congue, nunc lorem condimentum erat, ac tincidunt urna ligula sed lectus. Aenean sapien tellus, volutpat eget metus eget, maximus hendrerit erat.</p>\r\n<p>&nbsp;</p>\r\n<p>Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed nisl diam, semper volutpat aliquet sed, hendrerit a lacus. Vivamus elementum velit vitae turpis rutrum dignissim. Nunc nec posuere nisi. Nullam sodales arcu at scelerisque vehicula. Nam in nisi id libero malesuada ultricies. Mauris blandit lacus id turpis vestibulum suscipit quis et enim. Aenean molestie risus id nisl tristique eleifend. Proin est metus, placerat in lacus sit amet, maximus eleifend ligula. Proin commodo non arcu vel placerat.</p>\r\n<p>&nbsp;</p>\r\n<p>Integer molestie convallis velit. Aliquam pharetra lacinia accumsan. In bibendum laoreet fermentum. Curabitur quis nulla ipsum. Suspendisse vel arcu nec lacus ultrices rhoncus. Interdum et malesuada fames ac ante ipsum primis in faucibus. Maecenas in lacus commodo, euismod lorem vitae, condimentum tellus. Proin dapibus, magna ac porttitor consequat, ante magna pharetra tellus, lacinia rutrum eros arcu sed lectus. Quisque quis ligula blandit, dapibus turpis nec, gravida eros. Maecenas placerat rutrum condimentum. Donec venenatis euismod iaculis. Nulla pharetra orci sit amet consectetur lacinia. Interdum et malesuada fames ac ante ipsum primis in faucibus.</p>', '2020-06-14 20:04:55', '', 'Samuel', 0),
(5, 'Noticia de prueba nº4', '<p style=\"margin: 0px 0px 15px; padding: 0px; text-align: justify; font-family: \'Open Sans\', Arial, sans-serif; font-size: 14px; background-color: #ffffff;\">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi dapibus tempus ex, sit amet sodales magna suscipit quis. Phasellus rhoncus commodo nisl, id auctor tortor dictum nec. Sed risus ipsum, posuere ac dignissim in, feugiat ut massa. In vulputate ut eros quis dignissim. Quisque volutpat faucibus fermentum. Praesent laoreet sapien massa, a mattis felis accumsan a. Aenean sed elit vitae lectus malesuada vulputate.</p>\r\n<p style=\"margin: 0px 0px 15px; padding: 0px; text-align: justify; font-family: \'Open Sans\', Arial, sans-serif; font-size: 14px; background-color: #ffffff;\">Duis maximus ligula eu arcu molestie, vel efficitur odio ullamcorper. Morbi non dolor magna. Ut viverra euismod tellus, vitae egestas lectus aliquet euismod. Curabitur iaculis ornare interdum. Mauris vitae justo tempor, faucibus tellus id, dignissim leo. Nullam viverra ut metus eget fermentum. Duis quis ante in ante aliquam rutrum et quis orci. Aenean consequat ante ut felis facilisis consectetur sit amet ac magna. Nulla maximus vehicula tincidunt. Curabitur tristique turpis lacinia enim commodo lacinia. Curabitur accumsan tortor purus, sed consequat dui gravida vel. Phasellus gravida venenatis ipsum ut malesuada. Mauris varius ullamcorper aliquam.</p>\r\n<p style=\"margin: 0px 0px 15px; padding: 0px; text-align: justify; font-family: \'Open Sans\', Arial, sans-serif; font-size: 14px; background-color: #ffffff;\">Sed consectetur turpis eget est volutpat iaculis. Nunc sem turpis, accumsan vel leo sit amet, egestas iaculis diam. Maecenas blandit malesuada condimentum. Nunc ac maximus odio. Donec sit amet tempor magna. Nam fermentum risus at augue volutpat euismod. Phasellus a nulla erat. Nam mauris ligula, feugiat vel dictum nec, sagittis ut ex. In vehicula, lectus et vulputate congue, nunc lorem condimentum erat, ac tincidunt urna ligula sed lectus. Aenean sapien tellus, volutpat eget metus eget, maximus hendrerit erat.</p>\r\n<p style=\"margin: 0px 0px 15px; padding: 0px; text-align: justify; font-family: \'Open Sans\', Arial, sans-serif; font-size: 14px; background-color: #ffffff;\">Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed nisl diam, semper volutpat aliquet sed, hendrerit a lacus. Vivamus elementum velit vitae turpis rutrum dignissim. Nunc nec posuere nisi. Nullam sodales arcu at scelerisque vehicula. Nam in nisi id libero malesuada ultricies. Mauris blandit lacus id turpis vestibulum suscipit quis et enim. Aenean molestie risus id nisl tristique eleifend. Proin est metus, placerat in lacus sit amet, maximus eleifend ligula. Proin commodo non arcu vel placerat.</p>\r\n<p style=\"margin: 0px 0px 15px; padding: 0px; text-align: justify; font-family: \'Open Sans\', Arial, sans-serif; font-size: 14px; background-color: #ffffff;\">Integer molestie convallis velit. Aliquam pharetra lacinia accumsan. In bibendum laoreet fermentum. Curabitur quis nulla ipsum. Suspendisse vel arcu nec lacus ultrices rhoncus. Interdum et malesuada fames ac ante ipsum primis in faucibus. Maecenas in lacus commodo, euismod lorem vitae, condimentum tellus. Proin dapibus, magna ac porttitor consequat, ante magna pharetra tellus, lacinia rutrum eros arcu sed lectus. Quisque quis ligula blandit, dapibus turpis nec, gravida eros. Maecenas placerat rutrum condimentum. Donec venenatis euismod iaculis. Nulla pharetra orci sit amet consectetur lacinia. Interdum et malesuada fames ac ante ipsum primis in faucibus.</p>', '2020-06-14 20:06:07', '15921579677107544145ee6670f9d53e.jpg', 'David', 0),
(6, 'Noticia de prueba nº5', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi dapibus tempus ex, sit amet sodales magna suscipit quis. Phasellus rhoncus commodo nisl, id auctor tortor dictum nec. Sed risus ipsum, posuere ac dignissim in, feugiat ut massa. In vulputate ut eros quis dignissim. Quisque volutpat faucibus fermentum. Praesent laoreet sapien massa, a mattis felis accumsan a. Aenean sed elit vitae lectus malesuada vulputate.</p>\r\n<p>&nbsp;</p>\r\n<p>Duis maximus ligula eu arcu molestie, vel efficitur odio ullamcorper. Morbi non dolor magna. Ut viverra euismod tellus, vitae egestas lectus aliquet euismod. Curabitur iaculis ornare interdum. Mauris vitae justo tempor, faucibus tellus id, dignissim leo. Nullam viverra ut metus eget fermentum. Duis quis ante in ante aliquam rutrum et quis orci. Aenean consequat ante ut felis facilisis consectetur sit amet ac magna. Nulla maximus vehicula tincidunt. Curabitur tristique turpis lacinia enim commodo lacinia. Curabitur accumsan tortor purus, sed consequat dui gravida vel. Phasellus gravida venenatis ipsum ut malesuada. Mauris varius ullamcorper aliquam.</p>\r\n<p>&nbsp;</p>\r\n<p>Sed consectetur turpis eget est volutpat iaculis. Nunc sem turpis, accumsan vel leo sit amet, egestas iaculis diam. Maecenas blandit malesuada condimentum. Nunc ac maximus odio. Donec sit amet tempor magna. Nam fermentum risus at augue volutpat euismod. Phasellus a nulla erat. Nam mauris ligula, feugiat vel dictum nec, sagittis ut ex. In vehicula, lectus et vulputate congue, nunc lorem condimentum erat, ac tincidunt urna ligula sed lectus. Aenean sapien tellus, volutpat eget metus eget, maximus hendrerit erat.</p>\r\n<p>&nbsp;</p>\r\n<p>Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed nisl diam, semper volutpat aliquet sed, hendrerit a lacus. Vivamus elementum velit vitae turpis rutrum dignissim. Nunc nec posuere nisi. Nullam sodales arcu at scelerisque vehicula. Nam in nisi id libero malesuada ultricies. Mauris blandit lacus id turpis vestibulum suscipit quis et enim. Aenean molestie risus id nisl tristique eleifend. Proin est metus, placerat in lacus sit amet, maximus eleifend ligula. Proin commodo non arcu vel placerat.</p>\r\n<p>&nbsp;</p>\r\n<p>Integer molestie convallis velit. Aliquam pharetra lacinia accumsan. In bibendum laoreet fermentum. Curabitur quis nulla ipsum. Suspendisse vel arcu nec lacus ultrices rhoncus. Interdum et malesuada fames ac ante ipsum primis in faucibus. Maecenas in lacus commodo, euismod lorem vitae, condimentum tellus. Proin dapibus, magna ac porttitor consequat, ante magna pharetra tellus, lacinia rutrum eros arcu sed lectus. Quisque quis ligula blandit, dapibus turpis nec, gravida eros. Maecenas placerat rutrum condimentum. Donec venenatis euismod iaculis. Nulla pharetra orci sit amet consectetur lacinia. Interdum et malesuada fames ac ante ipsum primis in faucibus.</p>', '2020-06-14 20:07:56', '15921582177328270795ee668097fbe6.jpg', 'Paco', 0),
(7, 'Noticia de prueba nº6', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi dapibus tempus ex, sit amet sodales magna suscipit quis. Phasellus rhoncus commodo nisl, id auctor tortor dictum nec. Sed risus ipsum, posuere ac dignissim in, feugiat ut massa. In vulputate ut eros quis dignissim. Quisque volutpat faucibus fermentum. Praesent laoreet sapien massa, a mattis felis accumsan a. Aenean sed elit vitae lectus malesuada vulputate.</p>\r\n<p>&nbsp;</p>\r\n<p>Duis maximus ligula eu arcu molestie, vel efficitur odio ullamcorper. Morbi non dolor magna. Ut viverra euismod tellus, vitae egestas lectus aliquet euismod. Curabitur iaculis ornare interdum. Mauris vitae justo tempor, faucibus tellus id, dignissim leo. Nullam viverra ut metus eget fermentum. Duis quis ante in ante aliquam rutrum et quis orci. Aenean consequat ante ut felis facilisis consectetur sit amet ac magna. Nulla maximus vehicula tincidunt. Curabitur tristique turpis lacinia enim commodo lacinia. Curabitur accumsan tortor purus, sed consequat dui gravida vel. Phasellus gravida venenatis ipsum ut malesuada. Mauris varius ullamcorper aliquam.</p>\r\n<p>&nbsp;</p>\r\n<p>Sed consectetur turpis eget est volutpat iaculis. Nunc sem turpis, accumsan vel leo sit amet, egestas iaculis diam. Maecenas blandit malesuada condimentum. Nunc ac maximus odio. Donec sit amet tempor magna. Nam fermentum risus at augue volutpat euismod. Phasellus a nulla erat. Nam mauris ligula, feugiat vel dictum nec, sagittis ut ex. In vehicula, lectus et vulputate congue, nunc lorem condimentum erat, ac tincidunt urna ligula sed lectus. Aenean sapien tellus, volutpat eget metus eget, maximus hendrerit erat.</p>\r\n<p>&nbsp;</p>\r\n<p>Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed nisl diam, semper volutpat aliquet sed, hendrerit a lacus. Vivamus elementum velit vitae turpis rutrum dignissim. Nunc nec posuere nisi. Nullam sodales arcu at scelerisque vehicula. Nam in nisi id libero malesuada ultricies. Mauris blandit lacus id turpis vestibulum suscipit quis et enim. Aenean molestie risus id nisl tristique eleifend. Proin est metus, placerat in lacus sit amet, maximus eleifend ligula. Proin commodo non arcu vel placerat.</p>\r\n<p>&nbsp;</p>\r\n<p>Integer molestie convallis velit. Aliquam pharetra lacinia accumsan. In bibendum laoreet fermentum. Curabitur quis nulla ipsum. Suspendisse vel arcu nec lacus ultrices rhoncus. Interdum et malesuada fames ac ante ipsum primis in faucibus. Maecenas in lacus commodo, euismod lorem vitae, condimentum tellus. Proin dapibus, magna ac porttitor consequat, ante magna pharetra tellus, lacinia rutrum eros arcu sed lectus. Quisque quis ligula blandit, dapibus turpis nec, gravida eros. Maecenas placerat rutrum condimentum. Donec venenatis euismod iaculis. Nulla pharetra orci sit amet consectetur lacinia. Interdum et malesuada fames ac ante ipsum primis in faucibus.</p>', '2020-06-14 20:08:52', '159215815714251968825ee667cdb6446.jpg', 'Samuel', 0),
(8, 'Noticia de prueba nº7', '<p style=\"margin: 0px 0px 15px; padding: 0px; text-align: justify; font-family: \'Open Sans\', Arial, sans-serif; font-size: 14px; background-color: #ffffff;\">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi dapibus tempus ex, sit amet sodales magna suscipit quis. Phasellus rhoncus commodo nisl, id auctor tortor dictum nec. Sed risus ipsum, posuere ac dignissim in, feugiat ut massa. In vulputate ut eros quis dignissim. Quisque volutpat faucibus fermentum. Praesent laoreet sapien massa, a mattis felis accumsan a. Aenean sed elit vitae lectus malesuada vulputate.</p>\r\n<p style=\"margin: 0px 0px 15px; padding: 0px; text-align: justify; font-family: \'Open Sans\', Arial, sans-serif; font-size: 14px; background-color: #ffffff;\">Duis maximus ligula eu arcu molestie, vel efficitur odio ullamcorper. Morbi non dolor magna. Ut viverra euismod tellus, vitae egestas lectus aliquet euismod. Curabitur iaculis ornare interdum. Mauris vitae justo tempor, faucibus tellus id, dignissim leo. Nullam viverra ut metus eget fermentum. Duis quis ante in ante aliquam rutrum et quis orci. Aenean consequat ante ut felis facilisis consectetur sit amet ac magna. Nulla maximus vehicula tincidunt. Curabitur tristique turpis lacinia enim commodo lacinia. Curabitur accumsan tortor purus, sed consequat dui gravida vel. Phasellus gravida venenatis ipsum ut malesuada. Mauris varius ullamcorper aliquam.</p>\r\n<p style=\"margin: 0px 0px 15px; padding: 0px; text-align: justify; font-family: \'Open Sans\', Arial, sans-serif; font-size: 14px; background-color: #ffffff;\">Sed consectetur turpis eget est volutpat iaculis. Nunc sem turpis, accumsan vel leo sit amet, egestas iaculis diam. Maecenas blandit malesuada condimentum. Nunc ac maximus odio. Donec sit amet tempor magna. Nam fermentum risus at augue volutpat euismod. Phasellus a nulla erat. Nam mauris ligula, feugiat vel dictum nec, sagittis ut ex. In vehicula, lectus et vulputate congue, nunc lorem condimentum erat, ac tincidunt urna ligula sed lectus. Aenean sapien tellus, volutpat eget metus eget, maximus hendrerit erat.</p>\r\n<p style=\"margin: 0px 0px 15px; padding: 0px; text-align: justify; font-family: \'Open Sans\', Arial, sans-serif; font-size: 14px; background-color: #ffffff;\">Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed nisl diam, semper volutpat aliquet sed, hendrerit a lacus. Vivamus elementum velit vitae turpis rutrum dignissim. Nunc nec posuere nisi. Nullam sodales arcu at scelerisque vehicula. Nam in nisi id libero malesuada ultricies. Mauris blandit lacus id turpis vestibulum suscipit quis et enim. Aenean molestie risus id nisl tristique eleifend. Proin est metus, placerat in lacus sit amet, maximus eleifend ligula. Proin commodo non arcu vel placerat.</p>\r\n<p style=\"margin: 0px 0px 15px; padding: 0px; text-align: justify; font-family: \'Open Sans\', Arial, sans-serif; font-size: 14px; background-color: #ffffff;\">Integer molestie convallis velit. Aliquam pharetra lacinia accumsan. In bibendum laoreet fermentum. Curabitur quis nulla ipsum. Suspendisse vel arcu nec lacus ultrices rhoncus. Interdum et malesuada fames ac ante ipsum primis in faucibus. Maecenas in lacus commodo, euismod lorem vitae, condimentum tellus. Proin dapibus, magna ac porttitor consequat, ante magna pharetra tellus, lacinia rutrum eros arcu sed lectus. Quisque quis ligula blandit, dapibus turpis nec, gravida eros. Maecenas placerat rutrum condimentum. Donec venenatis euismod iaculis. Nulla pharetra orci sit amet consectetur lacinia. Interdum et malesuada fames ac ante ipsum primis in faucibus.</p>', '2020-06-14 20:11:00', '15921584162168663035ee668d0b3899.jpg', 'Samuel', 0),
(9, 'Noticia de prueba nº8', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi dapibus tempus ex, sit amet sodales magna suscipit quis. Phasellus rhoncus commodo nisl, id auctor tortor dictum nec. Sed risus ipsum, posuere ac dignissim in, feugiat ut massa. In vulputate ut eros quis dignissim. Quisque volutpat faucibus fermentum. Praesent laoreet sapien massa, a mattis felis accumsan a. Aenean sed elit vitae lectus malesuada vulputate.</p>\r\n<p>&nbsp;</p>\r\n<p>Duis maximus ligula eu arcu molestie, vel efficitur odio ullamcorper. Morbi non dolor magna. Ut viverra euismod tellus, vitae egestas lectus aliquet euismod. Curabitur iaculis ornare interdum. Mauris vitae justo tempor, faucibus tellus id, dignissim leo. Nullam viverra ut metus eget fermentum. Duis quis ante in ante aliquam rutrum et quis orci. Aenean consequat ante ut felis facilisis consectetur sit amet ac magna. Nulla maximus vehicula tincidunt. Curabitur tristique turpis lacinia enim commodo lacinia. Curabitur accumsan tortor purus, sed consequat dui gravida vel. Phasellus gravida venenatis ipsum ut malesuada. Mauris varius ullamcorper aliquam.</p>\r\n<p>&nbsp;</p>\r\n<p>Sed consectetur turpis eget est volutpat iaculis. Nunc sem turpis, accumsan vel leo sit amet, egestas iaculis diam. Maecenas blandit malesuada condimentum. Nunc ac maximus odio. Donec sit amet tempor magna. Nam fermentum risus at augue volutpat euismod. Phasellus a nulla erat. Nam mauris ligula, feugiat vel dictum nec, sagittis ut ex. In vehicula, lectus et vulputate congue, nunc lorem condimentum erat, ac tincidunt urna ligula sed lectus. Aenean sapien tellus, volutpat eget metus eget, maximus hendrerit erat.</p>\r\n<p>&nbsp;</p>\r\n<p>Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed nisl diam, semper volutpat aliquet sed, hendrerit a lacus. Vivamus elementum velit vitae turpis rutrum dignissim. Nunc nec posuere nisi. Nullam sodales arcu at scelerisque vehicula. Nam in nisi id libero malesuada ultricies. Mauris blandit lacus id turpis vestibulum suscipit quis et enim. Aenean molestie risus id nisl tristique eleifend. Proin est metus, placerat in lacus sit amet, maximus eleifend ligula. Proin commodo non arcu vel placerat.</p>\r\n<p>&nbsp;</p>\r\n<p>Integer molestie convallis velit. Aliquam pharetra lacinia accumsan. In bibendum laoreet fermentum. Curabitur quis nulla ipsum. Suspendisse vel arcu nec lacus ultrices rhoncus. Interdum et malesuada fames ac ante ipsum primis in faucibus. Maecenas in lacus commodo, euismod lorem vitae, condimentum tellus. Proin dapibus, magna ac porttitor consequat, ante magna pharetra tellus, lacinia rutrum eros arcu sed lectus. Quisque quis ligula blandit, dapibus turpis nec, gravida eros. Maecenas placerat rutrum condimentum. Donec venenatis euismod iaculis. Nulla pharetra orci sit amet consectetur lacinia. Interdum et malesuada fames ac ante ipsum primis in faucibus.</p>', '2020-06-14 20:15:42', '15921585425538539005ee6694e3a071.jpg', 'Martin', 0),
(10, 'Noticia de prueba nº9', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi dapibus tempus ex, sit amet sodales magna suscipit quis. Phasellus rhoncus commodo nisl, id auctor tortor dictum nec. Sed risus ipsum, posuere ac dignissim in, feugiat ut massa. In vulputate ut eros quis dignissim. Quisque volutpat faucibus fermentum. Praesent laoreet sapien massa, a mattis felis accumsan a. Aenean sed elit vitae lectus malesuada vulputate.</p>\r\n<p>&nbsp;</p>\r\n<p>Duis maximus ligula eu arcu molestie, vel efficitur odio ullamcorper. Morbi non dolor magna. Ut viverra euismod tellus, vitae egestas lectus aliquet euismod. Curabitur iaculis ornare interdum. Mauris vitae justo tempor, faucibus tellus id, dignissim leo. Nullam viverra ut metus eget fermentum. Duis quis ante in ante aliquam rutrum et quis orci. Aenean consequat ante ut felis facilisis consectetur sit amet ac magna. Nulla maximus vehicula tincidunt. Curabitur tristique turpis lacinia enim commodo lacinia. Curabitur accumsan tortor purus, sed consequat dui gravida vel. Phasellus gravida venenatis ipsum ut malesuada. Mauris varius ullamcorper aliquam.</p>\r\n<p>&nbsp;</p>\r\n<p>Sed consectetur turpis eget est volutpat iaculis. Nunc sem turpis, accumsan vel leo sit amet, egestas iaculis diam. Maecenas blandit malesuada condimentum. Nunc ac maximus odio. Donec sit amet tempor magna. Nam fermentum risus at augue volutpat euismod. Phasellus a nulla erat. Nam mauris ligula, feugiat vel dictum nec, sagittis ut ex. In vehicula, lectus et vulputate congue, nunc lorem condimentum erat, ac tincidunt urna ligula sed lectus. Aenean sapien tellus, volutpat eget metus eget, maximus hendrerit erat.</p>\r\n<p>&nbsp;</p>\r\n<p>Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed nisl diam, semper volutpat aliquet sed, hendrerit a lacus. Vivamus elementum velit vitae turpis rutrum dignissim. Nunc nec posuere nisi. Nullam sodales arcu at scelerisque vehicula. Nam in nisi id libero malesuada ultricies. Mauris blandit lacus id turpis vestibulum suscipit quis et enim. Aenean molestie risus id nisl tristique eleifend. Proin est metus, placerat in lacus sit amet, maximus eleifend ligula. Proin commodo non arcu vel placerat.</p>\r\n<p>&nbsp;</p>\r\n<p>Integer molestie convallis velit. Aliquam pharetra lacinia accumsan. In bibendum laoreet fermentum. Curabitur quis nulla ipsum. Suspendisse vel arcu nec lacus ultrices rhoncus. Interdum et malesuada fames ac ante ipsum primis in faucibus. Maecenas in lacus commodo, euismod lorem vitae, condimentum tellus. Proin dapibus, magna ac porttitor consequat, ante magna pharetra tellus, lacinia rutrum eros arcu sed lectus. Quisque quis ligula blandit, dapibus turpis nec, gravida eros. Maecenas placerat rutrum condimentum. Donec venenatis euismod iaculis. Nulla pharetra orci sit amet consectetur lacinia. Interdum et malesuada fames ac ante ipsum primis in faucibus.</p>', '2020-06-14 20:16:16', '', 'Samuel', 0),
(11, 'Noticia de prueba exposición editado', '<p>esto es una noticia para la exposici&oacute;n</p>\r\n<p>esto es una noticia para la exposici&oacute;n</p>\r\n<p>esto es una noticia para la exposici&oacute;n</p>\r\n<p>esto es una noticia para la exposici&oacute;n</p>\r\n<p>esto es una noticia para la exposici&oacute;n</p>\r\n<p>esto es una noticia para la exposici&oacute;n</p>\r\n<p>esto es una noticia para la exposici&oacute;n</p>\r\n<p>esto es una noticia para la exposici&oacute;n editado</p>', '2020-06-16 10:09:01', '159229499412250443985ee87e528c24a.png', 'prueba editado', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `poblaciones`
--

CREATE TABLE `poblaciones` (
  `cod_poblacion` int(11) NOT NULL,
  `nombre` varchar(20) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `poblaciones`
--

INSERT INTO `poblaciones` (`cod_poblacion`, `nombre`) VALUES
(1, 'Almería'),
(2, 'Cádiz'),
(3, 'Córdoba'),
(4, 'Granada'),
(5, 'Huelva'),
(6, 'Jaén'),
(7, 'Málaga'),
(8, 'Sevilla');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_eventos`
--

CREATE TABLE `tipo_eventos` (
  `cod_tipo_evento` int(11) NOT NULL,
  `nombre` varchar(20) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `tipo_eventos`
--

INSERT INTO `tipo_eventos` (`cod_tipo_evento`, `nombre`) VALUES
(1, 'Torneo'),
(2, 'Campeonato'),
(3, 'Torneo amateur'),
(4, 'Jornadas intensivas'),
(5, 'Master class');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `cod_usuario` int(11) NOT NULL,
  `nick` varchar(30) COLLATE utf8_spanish2_ci NOT NULL,
  `correo` varchar(320) COLLATE utf8_spanish2_ci NOT NULL,
  `nombre` varchar(30) COLLATE utf8_spanish2_ci NOT NULL,
  `apellidos` varchar(40) COLLATE utf8_spanish2_ci NOT NULL,
  `dni` varchar(9) COLLATE utf8_spanish2_ci NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `sexo` tinyint(1) NOT NULL,
  `telefono` varchar(9) COLLATE utf8_spanish2_ci NOT NULL,
  `imagen` varchar(1000) COLLATE utf8_spanish2_ci NOT NULL DEFAULT '',
  `activado` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`cod_usuario`, `nick`, `correo`, `nombre`, `apellidos`, `dni`, `fecha_nacimiento`, `sexo`, `telefono`, `imagen`, `activado`) VALUES
(1, 'samuel', 'samuel@gmail.com', 'Samuel', 'Diaz Galisteo', '11111111W', '2000-07-15', 0, '123456789', '159229468712791543925ee87d1fd07ba.jpg', 1),
(2, 'matias', 'matiasjimenez@gmail.com', 'Matias', 'Jimenez', '22222222W', '1967-08-08', 1, '987654321', '15921565407172638095ee6617ca1fbd.jpg', 1),
(3, 'fatima', 'fatimamartinez@gmail.com', 'Fátima', 'Martinez Galindo', '33333333W', '1992-07-02', 0, '789789789', '15921568079026334565ee6628761027.jpg', 1),
(4, 'Roman', 'romanalcantara@gmail.com', 'Roman', 'Alcántara Camacho', '44444444W', '2001-12-12', 1, '854343543', '15922964978664607535ee88431b5a4d.jpg', 1),
(5, 'pruebaju', 'aa@aaa.es', 'prueba', 'presentacion jutenis', '12345678W', '1980-12-12', 1, '465487989', '159229587012935956485ee881be201c9.png', 0),
(6, 'prueba1', 'prueba1@gmail.com', 'prueba1', 'prueba apellido', '13321546D', '1970-07-12', 0, '123456789', '', 0);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `vista_eventos`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `vista_eventos` (
`cod_evento` int(11)
,`titulo` varchar(50)
,`contenido` varchar(3000)
,`fecha` date
,`cod_poblacion` int(11)
,`poblacion` varchar(20)
,`edad_requerida` int(2)
,`edad_maxima` int(11)
,`cod_tipo_evento` int(11)
,`tipo_evento` varchar(20)
,`aforo` int(11)
,`n_inscritos` bigint(21)
,`borrado` tinyint(1)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `vista_usuarios`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `vista_usuarios` (
`cod_usuario_acl` int(11)
,`cod_usuario_usu` int(11)
,`nick` varchar(30)
,`nombre_acl` varchar(30)
,`nombre_usu` varchar(30)
,`apellidos` varchar(40)
,`correo` varchar(320)
,`contrasena` varchar(32)
,`dni` varchar(9)
,`fecha_nacimiento` date
,`sexo` tinyint(1)
,`telefono` varchar(9)
,`imagen` varchar(1000)
,`activado` tinyint(1)
,`borrado` tinyint(1)
,`cod_role` int(11)
,`nombre_role` varchar(30)
);

-- --------------------------------------------------------

--
-- Estructura para la vista `cons_acl_usuarios`
--
DROP TABLE IF EXISTS `cons_acl_usuarios`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `cons_acl_usuarios`  AS  select `au`.`cod_usuario` AS `cod_usuario`,`au`.`nombre` AS `nombre`,`au`.`nick` AS `nick`,`au`.`contrasena` AS `contrasena`,`au`.`cod_role` AS `cod_role`,`au`.`borrado` AS `borrado`,`ar`.`nombre` AS `nombre_role` from (`acl_usuarios` `au` join `acl_roles` `ar` on(`au`.`cod_role` = `ar`.`cod_role`)) ;

-- --------------------------------------------------------

--
-- Estructura para la vista `vista_eventos`
--
DROP TABLE IF EXISTS `vista_eventos`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vista_eventos`  AS  select `e`.`cod_evento` AS `cod_evento`,`e`.`titulo` AS `titulo`,`e`.`contenido` AS `contenido`,`e`.`fecha` AS `fecha`,`e`.`cod_poblacion` AS `cod_poblacion`,`p`.`nombre` AS `poblacion`,`e`.`edad_requerida` AS `edad_requerida`,`e`.`edad_maxima` AS `edad_maxima`,`e`.`cod_tipo_evento` AS `cod_tipo_evento`,`te`.`nombre` AS `tipo_evento`,`e`.`aforo` AS `aforo`,(select count(0) from `eventos_usuarios` `eu` where `e`.`cod_evento` = `eu`.`cod_evento` and `eu`.`borrado` = 0) AS `n_inscritos`,`e`.`borrado` AS `borrado` from ((`eventos` `e` join `poblaciones` `p` on(`p`.`cod_poblacion` = `e`.`cod_poblacion`)) join `tipo_eventos` `te` on(`te`.`cod_tipo_evento` = `e`.`cod_tipo_evento`)) ;

-- --------------------------------------------------------

--
-- Estructura para la vista `vista_usuarios`
--
DROP TABLE IF EXISTS `vista_usuarios`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vista_usuarios`  AS  select `a`.`cod_usuario` AS `cod_usuario_acl`,`u`.`cod_usuario` AS `cod_usuario_usu`,`a`.`nick` AS `nick`,`a`.`nombre` AS `nombre_acl`,`u`.`nombre` AS `nombre_usu`,`u`.`apellidos` AS `apellidos`,`u`.`correo` AS `correo`,`a`.`contrasena` AS `contrasena`,`u`.`dni` AS `dni`,`u`.`fecha_nacimiento` AS `fecha_nacimiento`,`u`.`sexo` AS `sexo`,`u`.`telefono` AS `telefono`,`u`.`imagen` AS `imagen`,`u`.`activado` AS `activado`,`a`.`borrado` AS `borrado`,`a`.`cod_role` AS `cod_role`,`a`.`nombre_role` AS `nombre_role` from (`usuarios` `u` join `cons_acl_usuarios` `a` on(`u`.`nick` = `a`.`nick`)) where 1 ;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `acl_roles`
--
ALTER TABLE `acl_roles`
  ADD PRIMARY KEY (`cod_role`);

--
-- Indices de la tabla `acl_usuarios`
--
ALTER TABLE `acl_usuarios`
  ADD PRIMARY KEY (`cod_usuario`),
  ADD UNIQUE KEY `UQ_NICK` (`nick`),
  ADD KEY `FK_ROLES` (`cod_role`);

--
-- Indices de la tabla `eventos`
--
ALTER TABLE `eventos`
  ADD PRIMARY KEY (`cod_evento`),
  ADD KEY `FK_TIPOS_EVENTO` (`cod_tipo_evento`),
  ADD KEY `FK_POBLACIONES` (`cod_poblacion`);

--
-- Indices de la tabla `eventos_usuarios`
--
ALTER TABLE `eventos_usuarios`
  ADD PRIMARY KEY (`cod_evento_usuario`),
  ADD UNIQUE KEY `UQ_USUARIO_EVENTO` (`cod_usuario`,`cod_evento`),
  ADD KEY `FK_EVENTOS_USUARIOS1` (`cod_evento`),
  ADD KEY `FK_EVENTOS_USUARIOS2` (`cod_usuario`);

--
-- Indices de la tabla `mensajes`
--
ALTER TABLE `mensajes`
  ADD PRIMARY KEY (`cod_mensaje`);

--
-- Indices de la tabla `noticias`
--
ALTER TABLE `noticias`
  ADD PRIMARY KEY (`cod_noticia`);

--
-- Indices de la tabla `poblaciones`
--
ALTER TABLE `poblaciones`
  ADD PRIMARY KEY (`cod_poblacion`);

--
-- Indices de la tabla `tipo_eventos`
--
ALTER TABLE `tipo_eventos`
  ADD PRIMARY KEY (`cod_tipo_evento`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`cod_usuario`),
  ADD UNIQUE KEY `UQ_NICK` (`nick`),
  ADD KEY `UQ_USUARIOS` (`nick`) USING BTREE;

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `acl_roles`
--
ALTER TABLE `acl_roles`
  MODIFY `cod_role` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `acl_usuarios`
--
ALTER TABLE `acl_usuarios`
  MODIFY `cod_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `eventos`
--
ALTER TABLE `eventos`
  MODIFY `cod_evento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `eventos_usuarios`
--
ALTER TABLE `eventos_usuarios`
  MODIFY `cod_evento_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `mensajes`
--
ALTER TABLE `mensajes`
  MODIFY `cod_mensaje` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `noticias`
--
ALTER TABLE `noticias`
  MODIFY `cod_noticia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `poblaciones`
--
ALTER TABLE `poblaciones`
  MODIFY `cod_poblacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `tipo_eventos`
--
ALTER TABLE `tipo_eventos`
  MODIFY `cod_tipo_evento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `cod_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `acl_usuarios`
--
ALTER TABLE `acl_usuarios`
  ADD CONSTRAINT `FK_ROLES` FOREIGN KEY (`cod_role`) REFERENCES `acl_roles` (`cod_role`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Filtros para la tabla `eventos`
--
ALTER TABLE `eventos`
  ADD CONSTRAINT `FK_POBLACIONES` FOREIGN KEY (`cod_poblacion`) REFERENCES `poblaciones` (`cod_poblacion`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_TIPOS_EVENTO` FOREIGN KEY (`cod_tipo_evento`) REFERENCES `tipo_eventos` (`cod_tipo_evento`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Filtros para la tabla `eventos_usuarios`
--
ALTER TABLE `eventos_usuarios`
  ADD CONSTRAINT `FK_EVENTOS_USUARIOS1` FOREIGN KEY (`cod_evento`) REFERENCES `eventos` (`cod_evento`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_EVENTOS_USUARIOS2` FOREIGN KEY (`cod_usuario`) REFERENCES `usuarios` (`cod_usuario`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`nick`) REFERENCES `acl_usuarios` (`nick`) ON DELETE NO ACTION ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
