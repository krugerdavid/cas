-- phpMyAdmin SQL Dump
-- version 3.1.1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 29-06-2009 a las 11:33:32
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
-- Volcar la base de datos para la tabla `autoridad`
--


--
-- Volcar la base de datos para la tabla `comunidad`
--


INSERT INTO `pais` (`pais_id`, `pais_nombre`) VALUES
(1, 'Paraguay');


INSERT INTO `confesion` (`cnf_id`, `cnf_nombre`) VALUES
(1, 'Evangelica'),
(2, 'Catolica Apostolico Romano'),
(4, 'Adventista'),
(5, 'Testigos de Jehova');

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
(12, 1, '&Ntilde;eembuc&uacute;'),
(13, 1, 'Amambay'),
(14, 1, 'Canindey&uacute;'),
(15, 1, 'Alto Paraguay'),
(16, 1, 'Presidente Hayes'),
(17, 1, 'Boquer&oacute;n');


INSERT INTO `comunidad` (`cmn_id`, `dto_id`, `pais_id`, `cmn_nombre`) VALUES
(1, 7, 1, 'Encarnacion'),
(2, 7, 1, 'Hohenau II'),
(3, 7, 1, 'Bella Vista'),
(5, 7, 1, 'Arroyo Pora'),
(6, 2, 1, 'Capitan Meza'),
(8, 7, 1, 'Trinidad'),
(9, 7, 1, 'Alto Vera'),
(10, 5, 1, 'Nueva Germania');

--
-- Volcar la base de datos para la tabla `miembro`
--

INSERT INTO `persona` (`prs_id`, `prs_apellidos`, `prs_nombres`, `prs_doc_num`, `prs_direccion`, `prs_telefono`, `prs_email`, `prs_sexo`, `prs_fecha_nacimiento`, `prs_lugar_nacimiento`, `prs_bautizado`, `prs_bautismo`, `prs_lugar_bautismo`, `prs_confirmado`, `prs_defunsion`, `prs_lugar_sepultado`, `prs_casado`, `prs_observacion`, `cnf_id`, `cmn_id`, `prs_estado`) VALUES
(1, 'Kruger', 'David', 2072234, 'Constitucion y Carlos Antonio Lopez', '0985 752011', 'david@buenasideaspy.com', 'M', '1985-12-28 00:00:00', 'Asuncion', 'N', '0000-00-00 00:00:00', '', 'N', NULL, NULL, '0', NULL, 1, 1, 'A');

--
-- Volcar la base de datos para la tabla `pais`
--



--
-- Volcar la base de datos para la tabla `parametro`
--

INSERT INTO `parametro` (`par_id`, `par_congregacion`, `par_ruc`, `par_direccion`, `par_telefono`, `par_membrete`, `par_descripcion`) VALUES
(1, 'Congregacion Evangelica del Alto Parana', '80034299-2', 'Avda. de los Fundadores 1712', '0775232302', NULL, NULL);

--
-- Volcar la base de datos para la tabla `permiso`
--

INSERT INTO `permiso` (`prm_id`, `prm_nombre`, `prm_controller_funcion`, `prm_modulo`, `prm_controller`) VALUES
(1, 'Agregar Miembro', 'agregar', 'Miembro', 'miembro'),
(2, 'Listar Miembros', 'listar_miembro', 'Miembro', 'miembro'),
(3, 'Agregar Comunidad', 'agregar', 'Comunidad', 'comunidad'),
(4, 'Listar Comunidades', '', 'Comunidad', 'comunidad'),
(5, 'Agregar Confesion', 'agregar', 'Confesion', 'confesion'),
(6, 'Listar Confesiones', '', 'Confesion', 'confesion'),
(7, 'Agregar Aporte', 'agregar', 'Aporte', 'aporte'),
(8, 'Listado de Dptos.', 'reporte_depto', 'Reportes', 'reportes'),
(9, 'Listado de Paises', 'reporte_pais', 'Reportes', 'reportes'),
(10, 'Listado de Roles', 'reporte_rol', 'Reportes', 'reportes'),
(11, 'Listado de Confesion', 'reporte_confesion', 'Reportes', 'reportes'),
(12, 'Listado de Comunidades', 'reporte_comunidad', 'Reportes', 'reportes'),
(13, 'Listado de Miembros', 'reporte_miembro', 'Reportes', 'reportes'),
(14, 'Aportes por Miembros', 'reporte_aporte', 'Reportes', 'reportes'),
(15, 'Listar Aportes', 'listar_aporte', 'Aporte', 'aporte'),
(16, 'Opciones del Sistema', '', 'Administracion', 'admin'),
(17, 'Control de Auditoria', 'listar_logs', 'Auditoria', 'auditoria');

--
-- Volcar la base de datos para la tabla `permiso_x_rol`



INSERT INTO `rol` (`rol_id`, `rol_nombre`) VALUES
(1, 'Administrador');
--

INSERT INTO `permiso_x_rol` (`rol_id`, `prm_id`) VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 4),
(1, 5),
(1, 6),
(1, 7),
(1, 8),
(1, 9),
(1, 10),
(1, 11),
(1, 12),
(1, 13),
(1, 14),
(1, 15),
(1, 16),
(1, 17);

--
-- Volcar la base de datos para la tabla `persona`
--


--
-- Volcar la base de datos para la tabla `persona_relacion`
--


--
-- Volcar la base de datos para la tabla `rol`
--

--
-- Volcar la base de datos para la tabla `tipo_relacion`
--

INSERT INTO `tipo_relacion` (`rlc_id`, `rlc_tipo`) VALUES
(100, 'HIJO'),
(200, 'CONYUGUE'),
(300, 'OTRO');

--
-- Volcar la base de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`usr_id`, `prs_id`, `rol_id`, `usr_contrasena`, `usr_nombre`, `usr_super`, `usr_fecha_registro`, `usr_ultimo_login`) VALUES
(1, 1, 1, '21232f297a57a5a743894a0e4a801fc3', 'admin', '1', '2009-05-04 00:00:00', '2009-06-29 11:21:12');

INSERT INTO `auditoria` (`adt_id`, `usr_id`, `adt_hora_trans`, `adt_nombre_tabla`, `adt_nombre_col`, `adt_evento`, `adt_valor_ant`, `adt_valor_nuevo`) VALUES
(1, 1, '2009-06-16 14:19:50', 'usuario', 'usr_id', 'delete', '5', NULL),
(2, 1, '2009-06-16 14:19:50', 'usuario', 'prs_id', 'delete', '7', NULL),
(3, 1, '2009-06-16 14:19:50', 'usuario', 'rol_id', 'delete', '1', NULL),
(4, 1, '2009-06-16 14:19:50', 'usuario', 'usr_nombre', 'delete', 'oscar', NULL),
(5, 1, '2009-06-16 14:19:50', 'usuario', 'usr_contrasena', 'delete', '52f7fdf78e7e676a135e9f57ec0315a9', NULL),
(6, 1, '2009-06-16 14:19:50', 'usuario', 'usr_super', 'delete', '0', NULL),
(7, 1, '2009-06-16 14:19:50', 'usuario', 'usr_fecha_registro', 'delete', '2009-06-15 08:01:40', NULL),
(8, 1, '2009-06-16 14:19:50', 'usuario', 'usr_ultimo_login', 'delete', '0000-00-00 00:00:00', NULL),
(9, 1, '2009-06-16 14:19:50', 'usuario', 'usr_id', 'delete', '4', NULL),
(10, 1, '2009-06-16 14:19:50', 'usuario', 'prs_id', 'delete', '6', NULL),
(11, 1, '2009-06-16 14:19:50', 'usuario', 'rol_id', 'delete', '2', NULL),
(12, 1, '2009-06-16 14:19:50', 'usuario', 'usr_nombre', 'delete', 'jschamli', NULL),
(13, 1, '2009-06-16 14:19:50', 'usuario', 'usr_contrasena', 'delete', 'dd194f087fc3adfba71b5453dda7c6ca', NULL),
(14, 1, '2009-06-16 14:19:50', 'usuario', 'usr_super', 'delete', '0', NULL),
(15, 1, '2009-06-16 14:19:50', 'usuario', 'usr_fecha_registro', 'delete', '2009-06-15 07:05:22', NULL),
(16, 1, '2009-06-16 14:19:50', 'usuario', 'usr_ultimo_login', 'delete', '2009-06-16 07:53:45', NULL),
(17, 1, '2009-06-16 14:19:50', 'persona', 'prs_id', 'delete', '6', NULL),
(18, 1, '2009-06-16 14:19:50', 'persona', 'prs_apellidos', 'delete', 'Schamli', NULL),
(19, 1, '2009-06-16 14:19:50', 'persona', 'prs_nombres', 'delete', 'Javier', NULL),
(20, 1, '2009-06-16 14:19:50', 'persona', 'prs_doc_num', 'delete', '12345667', NULL),
(21, 1, '2009-06-16 14:19:50', 'persona', 'prs_direccion', 'delete', NULL, NULL),
(22, 1, '2009-06-16 14:19:50', 'persona', 'prs_telefono', 'delete', NULL, NULL),
(23, 1, '2009-06-16 14:19:50', 'persona', 'prs_email', 'delete', 'vincenkruger2@mail.com', NULL),
(24, 1, '2009-06-16 14:19:50', 'persona', 'prs_sexo', 'delete', 'M', NULL),
(25, 1, '2009-06-16 14:19:50', 'persona', 'prs_fecha_nacimiento', 'delete', '1967-12-12 00:00:00', NULL),
(26, 1, '2009-06-16 14:19:50', 'persona', 'prs_lugar_nacimiento', 'delete', 'parana', NULL),
(27, 1, '2009-06-16 14:19:50', 'persona', 'prs_bautizado', 'delete', '', NULL),
(28, 1, '2009-06-16 14:19:50', 'persona', 'prs_bautismo', 'delete', NULL, NULL),
(29, 1, '2009-06-16 14:19:50', 'persona', 'prs_lugar_bautismo', 'delete', NULL, NULL),
(30, 1, '2009-06-16 14:19:50', 'persona', 'prs_confirmado', 'delete', '', NULL),
(31, 1, '2009-06-16 14:19:50', 'persona', 'prs_defunsion', 'delete', NULL, NULL),
(32, 1, '2009-06-16 14:19:50', 'persona', 'prs_lugar_sepultado', 'delete', NULL, NULL),
(33, 1, '2009-06-16 14:19:50', 'persona', 'prs_casado', 'delete', 'S', NULL),
(34, 1, '2009-06-16 14:19:50', 'persona', 'prs_observacion', 'delete', NULL, NULL),
(35, 1, '2009-06-16 14:19:50', 'persona', 'cnf_id', 'delete', '1', NULL),
(36, 1, '2009-06-16 14:19:50', 'persona', 'cmn_id', 'delete', '1', NULL),
(37, 1, '2009-06-16 14:19:50', 'persona', 'prs_id', 'delete', '7', NULL),
(38, 1, '2009-06-16 14:19:50', 'persona', 'prs_apellidos', 'delete', 'Yoshimi', NULL),
(39, 1, '2009-06-16 14:19:50', 'persona', 'prs_nombres', 'delete', 'Oscar', NULL),
(40, 1, '2009-06-16 14:19:50', 'persona', 'prs_doc_num', 'delete', '123455555', NULL),
(41, 1, '2009-06-16 14:19:50', 'persona', 'prs_direccion', 'delete', NULL, NULL),
(42, 1, '2009-06-16 14:19:50', 'persona', 'prs_telefono', 'delete', NULL, NULL),
(43, 1, '2009-06-16 14:19:50', 'persona', 'prs_email', 'delete', 'osfasdfas@gasdgm.com', NULL),
(44, 1, '2009-06-16 14:19:50', 'persona', 'prs_sexo', 'delete', 'M', NULL),
(45, 1, '2009-06-16 14:19:50', 'persona', 'prs_fecha_nacimiento', 'delete', '1985-12-12 00:00:00', NULL),
(46, 1, '2009-06-16 14:19:50', 'persona', 'prs_lugar_nacimiento', 'delete', 'hohenau', NULL),
(47, 1, '2009-06-16 14:19:50', 'persona', 'prs_bautizado', 'delete', '', NULL),
(48, 1, '2009-06-16 14:19:50', 'persona', 'prs_bautismo', 'delete', NULL, NULL),
(49, 1, '2009-06-16 14:19:50', 'persona', 'prs_lugar_bautismo', 'delete', NULL, NULL),
(50, 1, '2009-06-16 14:19:50', 'persona', 'prs_confirmado', 'delete', '', NULL),
(51, 1, '2009-06-16 14:19:50', 'persona', 'prs_defunsion', 'delete', NULL, NULL),
(52, 1, '2009-06-16 14:19:50', 'persona', 'prs_lugar_sepultado', 'delete', NULL, NULL),
(53, 1, '2009-06-16 14:19:50', 'persona', 'prs_casado', 'delete', 'S', NULL),
(54, 1, '2009-06-16 14:19:50', 'persona', 'prs_observacion', 'delete', NULL, NULL),
(55, 1, '2009-06-16 14:19:50', 'persona', 'cnf_id', 'delete', '1', NULL),
(56, 1, '2009-06-16 14:19:50', 'persona', 'cmn_id', 'delete', '1', NULL),
(77, 1, '2009-06-16 14:19:50', 'persona', 'prs_id', 'delete', '8', NULL),
(78, 1, '2009-06-16 14:19:50', 'persona', 'prs_apellidos', 'delete', 'Kruger', NULL),
(79, 1, '2009-06-16 14:19:50', 'persona', 'prs_nombres', 'delete', 'Ricardo', NULL),
(80, 1, '2009-06-16 14:19:50', 'persona', 'prs_doc_num', 'delete', '12341233', NULL),
(81, 1, '2009-06-16 14:19:50', 'persona', 'prs_direccion', 'delete', 'Jose Felix Bogado', NULL),
(82, 1, '2009-06-16 14:19:50', 'persona', 'prs_telefono', 'delete', '0775232648', NULL),
(83, 1, '2009-06-16 14:19:50', 'persona', 'prs_email', 'delete', 'kruger@itacom.com.py', NULL),
(84, 1, '2009-06-16 14:19:50', 'persona', 'prs_sexo', 'delete', 'F', NULL),
(85, 1, '2009-06-16 14:19:50', 'persona', 'prs_fecha_nacimiento', 'delete', '1957-06-02 00:00:00', NULL),
(86, 1, '2009-06-16 14:19:50', 'persona', 'prs_lugar_nacimiento', 'delete', 'Hohenau II', NULL),
(87, 1, '2009-06-16 14:19:50', 'persona', 'prs_bautizado', 'delete', 'S', NULL),
(88, 1, '2009-06-16 14:19:50', 'persona', 'prs_bautismo', 'delete', NULL, NULL),
(89, 1, '2009-06-16 14:19:50', 'persona', 'prs_lugar_bautismo', 'delete', '', NULL),
(90, 1, '2009-06-16 14:19:50', 'persona', 'prs_confirmado', 'delete', 'S', NULL),
(91, 1, '2009-06-16 14:19:50', 'persona', 'prs_defunsion', 'delete', NULL, NULL),
(92, 1, '2009-06-16 14:19:50', 'persona', 'prs_lugar_sepultado', 'delete', '', NULL),
(93, 1, '2009-06-16 14:19:50', 'persona', 'prs_casado', 'delete', 'S', NULL),
(94, 1, '2009-06-16 14:19:50', 'persona', 'prs_observacion', 'delete', '', NULL),
(95, 1, '2009-06-16 14:19:50', 'persona', 'cnf_id', 'delete', '1', NULL),
(96, 1, '2009-06-16 14:19:50', 'persona', 'cmn_id', 'delete', '2', NULL),
(97, 1, '2009-06-16 14:19:50', 'persona', 'prs_id', 'delete', '9', NULL);
