-- phpMyAdmin SQL Dump
-- version 3.1.1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 18-05-2009 a las 22:39:06
-- Versión del servidor: 5.1.30
-- Versión de PHP: 5.2.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `censo_ap`
--

--
-- Volcar la base de datos para la tabla `aporte`
--


--
-- Volcar la base de datos para la tabla `auditoria`
--


--
-- Volcar la base de datos para la tabla `autoridad`
--


--
-- Volcar la base de datos para la tabla `comunidad`
--

INSERT INTO `comunidad` (`cmn_id`, `dto_id`, `pais_id`, `cmn_nombre`) VALUES
(1, 7, NULL, 'Encarnacion');

--
-- Volcar la base de datos para la tabla `confesion`
--

INSERT INTO `confesion` (`cnf_id`, `cnf_nombre`) VALUES
(1, 'Evangelica');

--
-- Volcar la base de datos para la tabla `departamento`
--

INSERT INTO `departamento` (`dto_id`, `pais_id`, `dto_nombre`) VALUES
(1, 1, 'Concepci&oacute;n'),
(2, 1, 'San Pedro'),
(3, 1, 'Cordillera'),
(4, 1, 'Guair&aacute;'),
(5, 1, 'Caaguaz&uacute;'),
(6, 1, 'Caazap&aacute;'),
(7, 1, 'Itap&uacute;a'),
(8, 1, 'Misiones'),
(9, 1, 'Paraguar&iacute;'),
(10, 1, 'Alto Paran&aacute;'),
(11, 1, 'Central'),
(12, 1, 'Ntilde;eembuc&uacute;'),
(13, 1, 'Amambay'),
(14, 1, 'Canindey&uacute;'),
(15, 1, 'Alto Paraguay'),
(16, 1, 'Presidente Hayes'),
(17, 1, 'Boquer&oacute;n');

--
-- Volcar la base de datos para la tabla `miembro`
--


--
-- Volcar la base de datos para la tabla `pais`
--

INSERT INTO `pais` (`pais_id`, `pais_nombre`) VALUES
(1, 'Paraguay');

--
-- Volcar la base de datos para la tabla `parametro`
--


--
-- Volcar la base de datos para la tabla `permiso`
--

INSERT INTO `permiso` (`prm_id`, `prm_nombre`, `prm_controller_funcion`, `prm_modulo`, `prm_controller`) VALUES
(1, 'Agregar Miembro', 'agregar', 'Miembro', 'miembro'),
(2, 'Agregar Conyugue', 'agregar_conyugue', 'Miembro', 'miembro'),
(3, 'Agregar Hijo', 'agregar_hijo', 'Miembro', 'miembro'),
(4, 'Agregar Persona', 'agregar_otro', 'Miembro', 'miembro'),
(5, 'Listar Miembros', 'listar_miembro', 'Miembro', 'miembro'),
(6, 'Listar Hijos', 'listar_hijo', 'Miembro', 'miembro'),
(7, 'Listar Otras Personas', 'listar_otro', 'Miembro', 'miembro'),
(8, 'Agregar Comunidad', 'agregar', 'Comunidad', 'comunidad'),
(9, 'Listar Comunidades', '', 'Comunidad', 'comunidad'),
(10, 'Agregar Confesion', 'agregar', 'Confesion', 'confesion'),
(11, 'Listar Confesiones', '', 'Confesion', 'confesion'),
(12, 'Agregar Aporte', 'agregar', 'Aportes', 'aportes'),
(13, 'Listar Aportes', '', 'Aportes', 'aportes'),
(14, 'Listado de Roles', 'reporte_rol', 'Reportes', 'reportes'),
(15, 'Listado de Confesion', 'reporte_confesion', 'Reportes', 'reportes'),
(16, 'Listado de Comunidades', 'reporte_comunidad', 'Reportes', 'reportes'),
(17, 'Listado de Miembros', 'reporte_miembro', 'Reportes', 'reportes'),
(18, 'Opciones del Sistema', '', 'Administracion', 'admin'),
(19, 'Listado de Dptos.', 'reporte_deptos', 'Reportes', 'reportes'),
(20, 'Listado de Países', 'reporte_paises', 'Reportes', 'reportes');

--
-- Volcar la base de datos para la tabla `permiso_x_rol`
--

INSERT INTO `permiso_x_rol` (`rol_id`, `prm_id`) VALUES
(1, 1),
(3, 1),
(1, 2),
(1, 3),
(1, 4),
(2, 4),
(1, 5),
(3, 5),
(1, 6),
(1, 7),
(1, 8),
(1, 9),
(2, 9),
(1, 10),
(1, 11),
(3, 11),
(1, 12),
(1, 13),
(1, 14),
(3, 14),
(1, 15),
(1, 16),
(3, 16),
(1, 17),
(1, 18),
(1, 19),
(1, 20),
(3, 18);

--
-- Volcar la base de datos para la tabla `persona`
--

INSERT INTO `persona` (`prs_id`, `prs_apellidos`, `prs_nombres`, `prs_doc_num`, `prs_direccion`, `prs_telefono`, `prs_email`, `prs_sexo`, `prs_fecha_nacimiento`, `prs_lugar_nacimiento`, `prs_bautizado`, `prs_bautismo`, `prs_lugar_bautismo`, `prs_confirmado`, `prs_defunsion`, `prs_lugar_sepultado`, `prs_casado`, `prs_observacion`, `cnf_id`, `cmn_id`) VALUES
(1, 'Kruger', 'David', 2072234, 'Constitucion y Carlos Antonio Lopez', '0985 752011', 'vincenkruger22@gmail.com', 'M', '1985-12-28 00:00:00', 'Asuncion', 'N', '0000-00-00 00:00:00', '', 'N', NULL, NULL, 'N', NULL, 1, 1);

--
-- Volcar la base de datos para la tabla `persona_relacion`
--


--
-- Volcar la base de datos para la tabla `rol`
--

INSERT INTO `rol` (`rol_id`, `rol_nombre`) VALUES
(1, 'Admin'),
(2, 'prueba'),
(3, 'Prueba2');

--
-- Volcar la base de datos para la tabla `tipo_relacion`
--


--
-- Volcar la base de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`usr_id`, `prs_id`, `rol_id`, `usr_contrasena`, `usr_nombre`, `usr_super`, `usr_fecha_registro`, `usr_ultimo_login`) VALUES
(1, 1, 1, '21232f297a57a5a743894a0e4a801fc3', 'admin', '1', '2009-05-04 00:00:00', '2009-05-18 10:35:54');
