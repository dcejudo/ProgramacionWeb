-- phpMyAdmin SQL Dump
-- version 2.10.3
-- http://www.phpmyadmin.net
-- 
-- Servidor: localhost
-- Tiempo de generación: 25-06-2019 a las 14:06:12
-- Versión del servidor: 5.0.51
-- Versión de PHP: 5.2.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

-- 
-- Base de datos: `blog`
-- 

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `post`
-- 

CREATE TABLE `post` (
  `id` int(8) unsigned NOT NULL auto_increment,
  `title` varchar(50) NOT NULL,
  `content` varchar(250) NOT NULL,
  `idAutor` int(11) NOT NULL,
  `created` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

-- 
-- Volcar la base de datos para la tabla `post`
-- 

INSERT INTO `post` VALUES (6, '¿Qué es la federación de identidades?', 'Una federación es un conjunto de entidades que comparten tecnología y estándares, para transmitir información e identificar a un usuario de manera segura, facilitando la autenticación y autorización entre diferentes sistemas informáticos.', 1, '2019-06-25 12:06:13');
INSERT INTO `post` VALUES (11, 'La integración de los sistemas informáticos dentro', 'La integración de los sistemas informáticos, son parte fundamental para un buen flujo de información generada en cada proceso o actividad dentro de una organización, misma que puede ser factor importante para el apoyo en la toma de decisiones dentro ', 2, '2019-06-25 12:08:38');

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `usuarios`
-- 

CREATE TABLE `usuarios` (
  `id` int(6) NOT NULL auto_increment,
  `email` varchar(150) NOT NULL,
  `password` varchar(20) NOT NULL,
  `nombre` varchar(70) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

-- 
-- Volcar la base de datos para la tabla `usuarios`
-- 

INSERT INTO `usuarios` VALUES (1, 'jmorfin@ucol.mx', 'pppp', 'JOSE NABOR');
INSERT INTO `usuarios` VALUES (2, 'jl@ucol.mx', 'jjjj', 'Juan Luis Campos');
