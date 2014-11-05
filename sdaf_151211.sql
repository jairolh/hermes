-- phpMyAdmin SQL Dump
-- version 3.2.0.1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 15-12-2011 a las 06:17:58
-- Versión del servidor: 5.1.36
-- Versión de PHP: 5.3.0

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `sdaf`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sdaf_area`
--

DROP TABLE IF EXISTS `sdaf_area`;
CREATE TABLE IF NOT EXISTS `sdaf_area` (
  `id_area` int(7) NOT NULL COMMENT 'CAMPO QUE ALMACENA EL CODIGO UNICO DE IDENTIFICACION DEL AREA DE UNA DEPENDENCIA',
  `id_dependencia` int(7) NOT NULL COMMENT 'CAMPO QUE INDICA EL CODIGO DE LA DEPENDENCIA AL QUE PERTENECE EL AREA',
  `nombre` varchar(200) COLLATE utf8_spanish_ci NOT NULL COMMENT 'CAMPO EN EL QUE SE ALMACENA EL NOMBRE DEL AREA',
  `descripcion` text COLLATE utf8_spanish_ci COMMENT 'CAMPO EN EL QUE SE ALMACENA LA DESCRIPCION DEL AREA',
  `estado` varchar(1) COLLATE utf8_spanish_ci NOT NULL DEFAULT '1' COMMENT 'CAMPO QUE INDICA EL ESTADO DEL AREA',
  PRIMARY KEY (`id_area`),
  KEY `id_dependencia` (`id_dependencia`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcar la base de datos para la tabla `sdaf_area`
--

INSERT INTO `sdaf_area` (`id_area`, `id_dependencia`, `nombre`, `descripcion`, `estado`) VALUES
(0, 0, 'ADMINISTRADOR', 'ADMINISTRADOR DEL SISTEMA', '1'),
(1, 4, 'ADMINISTRATIVA', 'AREA ADMINISTRATIVA DE LA DEPENDENCIA  DIVISION DE RECURSOS FINANCIEROS', '1'),
(2, 4, 'RADICACION', 'SE REGISTRA EL DOCUMENTO PARA TRAMITES DIVISION DE RECURSOS FINANCIEROS', '1'),
(3, 4, 'REPARTO - CENTRAL DE CUENTAS', 'REPARTO – CENTRAL DE CUENTAS DIVISIÓN DE RECURSOS FINANCIEROS', '1'),
(4, 33, 'CUENTA CONTABLE - CONVENIOS', 'CUENTA CONTABLE – CONVENIOS SECCIÓN DE PRESUPUESTO', '1'),
(5, 4, 'REPARTO - ORDEN DE PAGO', 'REPARTO - ORDEN DE PAGO DIVISIÓN DE RECURSOS FINANCIEROS', '1'),
(6, 31, 'REGISTRO CONTABILIDAD', 'REGISTRO CONTABILIDAD SECCIÓN DE CONTABILIDAD', '1'),
(7, 33, 'REGISTRO PRESUPUESTAL', 'REGISTRO PRESUPUESTAL SECCIÓN DE PRESUPUESTO', '1'),
(8, 33, 'REGISTRO PRESUPUESTAL - CONVENIOS', 'REGISTRO PRESUPUESTAL - CONVENIOS SECCIÓN DE PRESUPUESTO', '1'),
(9, 4, 'APROBACION D. FINANCIERA', 'APROBACION D. FINANCIERA DIVISION DE RECURSOS FINANCIEROS', '1'),
(10, 34, 'APROBACION TESORERIA', 'APROBACION TESORERIA SECCION DE TESORERÍA', '1'),
(11, 34, 'PAGO - GIRO', 'PAGO -GIRO SECCIÓN DE TESORERÍA', '1'),
(12, 33, 'ADMINISTRATIVA', 'AREA ADMINISTRATIVA, DONDE SE PUEDE REALIZAR DEVOLUCIONES A DEPENDENCIAS Y SEGUIMIENTO A TRAMITES', '1'),
(13, 33, 'RADICACION', 'AREA RADICACION, SE REGISTRAN LAS SOLICITUDES PARA TRAMITES', '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sdaf_area_ttramite`
--

DROP TABLE IF EXISTS `sdaf_area_ttramite`;
CREATE TABLE IF NOT EXISTS `sdaf_area_ttramite` (
  `id_area` int(7) NOT NULL,
  `id_Ttramite` int(7) NOT NULL,
  `fecha_registro` date NOT NULL,
  `fecha_fin` date DEFAULT NULL,
  `estado` varchar(1) COLLATE utf8_spanish_ci NOT NULL DEFAULT '1',
  `descripcion` text COLLATE utf8_spanish_ci,
  `posicion_tramite` int(3) NOT NULL,
  KEY `id_area` (`id_area`,`id_Ttramite`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcar la base de datos para la tabla `sdaf_area_ttramite`
--

INSERT INTO `sdaf_area_ttramite` (`id_area`, `id_Ttramite`, `fecha_registro`, `fecha_fin`, `estado`, `descripcion`, `posicion_tramite`) VALUES
(1, 1, '2011-07-22', '0000-00-00', '1', 'ADMINISTRATIVA, DEVOLUCIONES Y SEGUIMIENTO_SOLICITUD DE PAGO PRESUPUESTO', 0),
(2, 1, '2011-07-22', '0000-00-00', '1', 'RADICACIÓN_SOLICITUD DE PAGO PRESUPUESTO', 1),
(3, 1, '2011-07-22', '0000-00-00', '1', 'REPARTO – CENTRAL DE CUENTAS_SOLICITUD DE PAGO PRESUPUESTO', 2),
(5, 1, '2011-07-22', '0000-00-00', '1', 'REPARTO - ORDEN DE PAGO_SOLICITUD DE PAGO PRESUPUESTO', 3),
(6, 1, '2011-07-22', '0000-00-00', '1', 'REGISTRO CONTABILIDAD_SOLICITUD DE PAGO PRESUPUESTO', 4),
(7, 1, '2011-07-22', '0000-00-00', '1', 'REGISTRO PRESUPUESTAL_SOLICITUD DE PAGO PRESUPUESTO', 5),
(9, 1, '2011-07-22', '0000-00-00', '1', 'APROBACIÓN D. FINANCIERA_SOLICITUD DE PAGO PRESUPUESTO', 6),
(10, 1, '2011-07-22', '0000-00-00', '1', 'APROBACIÓN TESORERÍA_SOLICITUD DE PAGO PRESUPUESTO', 7),
(11, 1, '2011-07-22', '0000-00-00', '1', 'PAGO -GIRO_SOLICITUD DE PAGO PRESUPUESTO', 8),
(1, 2, '2011-07-22', '0000-00-00', '1', 'ADMINISTRATIVA, DEVOLUCIONES Y SEGUIMIENTO_SOLICITUD DE PAGO CONVENIOS', 0),
(2, 2, '2011-07-22', '0000-00-00', '1', 'RADICACIÓN_SOLICITUD DE PAGO CONVENIOS', 1),
(4, 2, '2011-07-22', '0000-00-00', '1', 'CUENTA CONTABLE – CONVENIOS_SOLICITUD DE PAGO CONVENIOS', 2),
(3, 2, '2011-07-22', '0000-00-00', '1', 'REPARTO – CENTRAL DE CUENTAS_SOLICITUD DE PAGO CONVENIOS', 3),
(5, 2, '2011-07-22', '0000-00-00', '1', 'REPARTO - ORDEN DE PAGO_SOLICITUD DE PAGO CONVENIOS', 4),
(6, 2, '2011-07-22', '0000-00-00', '1', 'REGISTRO CONTABILIDAD_SOLICITUD DE PAGO CONVENIOS', 5),
(8, 2, '2011-07-22', '0000-00-00', '1', 'REGISTRO PRESUPUESTAL - CONVENIOS_SOLICITUD DE PAGO CONVENIOS', 6),
(9, 2, '2011-07-22', '0000-00-00', '1', 'APROBACIÓN D. FINANCIERA_SOLICITUD DE PAGO CONVENIOS', 7),
(10, 2, '2011-07-22', '0000-00-00', '1', 'APROBACIÓN TESORERÍA_SOLICITUD DE PAGO CONVENIOS', 8),
(11, 2, '2011-07-22', '0000-00-00', '1', 'PAGO -GIRO_SOLICITUD DE PAGO CONVENIOS', 9);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sdaf_bloque`
--

DROP TABLE IF EXISTS `sdaf_bloque`;
CREATE TABLE IF NOT EXISTS `sdaf_bloque` (
  `id_bloque` int(5) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) CHARACTER SET latin1 NOT NULL DEFAULT '',
  `descripcion` text CHARACTER SET latin1,
  `grupo` varchar(20) CHARACTER SET latin1 NOT NULL DEFAULT '',
  PRIMARY KEY (`id_bloque`),
  KEY `id_bloque` (`id_bloque`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci PACK_KEYS=0 ROW_FORMAT=DYNAMIC COMMENT='Bloques disponibles' AUTO_INCREMENT=29 ;

--
-- Volcar la base de datos para la tabla `sdaf_bloque`
--

INSERT INTO `sdaf_bloque` (`id_bloque`, `nombre`, `descripcion`, `grupo`) VALUES
(1, 'mensaje', 'Bloque para gestionar el contenido estatico de una pagina', ''),
(2, 'admin_noticia', 'bloque para administracion de noticias', 'admin'),
(3, 'menu_principal', 'Menu General de la Pagina principal del Sistema', 'MENU'),
(4, 'registro_usuario', 'Bloque con el formulario de registro de usuarios', 'REGISTRO'),
(5, 'pie', 'Pie de pagina', 'MENSAJE'),
(6, 'banner', 'Banner para las paginas de contenido', 'MENSAJE'),
(7, 'login', 'Formulario principal para el ingreso de nombre de usuario y clave', 'REGISTRO'),
(8, 'logout', 'Bloque para gestionar la terminacion de sesiones en el sistema', 'REGISTRO'),
(9, 'menu_administrador', 'menu principal para el submodulo de administrador', 'MENU'),
(10, 'listar_noticia', 'bloque que permite la administracion de noticias', 'REGISTRO'),
(11, 'menu_noticia', 'menu de administracion de noticias', 'MENU'),
(12, 'registro_noticia', 'modulo para la ingresar modificar eliminar \r\nnoticias', ''),
(13, 'ver_noticia', 'permite visualizar el contenido completo de una noticia', 'REGISTRO'),
(14, 'borrar_registro', 'Bloque principal para borrar registros', 'REGISTRO'),
(15, 'admin_usuario', 'bloque para administracion de usuarios', 'REGISTRO'),
(16, 'menu_usuario', 'menu para la administracion de ususarios', 'MENU'),
(17, 'admin_radica', 'bloque para administracion de la radicaciond etramites', 'REGISTRO'),
(18, 'menu_radica', 'menu para la administracion de radicaciones', 'MENU'),
(19, 'menu_general', 'menu general', 'MENU'),
(20, 'admin_general', 'bloque para administracion de los daos basicos', 'REGISTRO'),
(21, 'admin_tramite', 'bloque para administracion de los tramites radicados', 'REGISTRO'),
(22, 'menu_tramite', 'menu para la administracion de tramites', 'MENU'),
(23, 'menu_consulta', 'menu que permite la consulat de radicaciones', 'MENU'),
(24, 'admin_consulta', 'bloque para consulta de la radicacion de tramites', 'REGISTRO'),
(25, 'admin_tipotramite', 'bloque para administracion de los tipos de tramites', 'REGISTRO'),
(26, 'menu_tipotramite', 'menu para la administracion de tipos de tramites', 'MENU'),
(27, 'admin_seguimiento', 'bloque para el seguimiento de los tramites', 'REGISTRO'),
(28, 'menu_seguimiento', 'menu para el seguimiento de radicaciones', 'MENU');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sdaf_bloque_pagina`
--

DROP TABLE IF EXISTS `sdaf_bloque_pagina`;
CREATE TABLE IF NOT EXISTS `sdaf_bloque_pagina` (
  `id_pagina` int(5) NOT NULL DEFAULT '0',
  `id_bloque` int(5) NOT NULL DEFAULT '0',
  `seccion` char(1) COLLATE utf8_spanish_ci NOT NULL DEFAULT '',
  `posicion` int(2) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='Estructura de bloques de las paginas en el aplicativo';

--
-- Volcar la base de datos para la tabla `sdaf_bloque_pagina`
--

INSERT INTO `sdaf_bloque_pagina` (`id_pagina`, `id_bloque`, `seccion`, `posicion`) VALUES
(1, 1, 'C', 1),
(1, 3, 'B', 1),
(2, 4, 'C', 1),
(1, 6, 'A', 1),
(1, 7, 'B', 2),
(3, 1, 'C', 1),
(3, 5, 'E', 1),
(3, 6, 'A', 1),
(3, 9, 'B', 2),
(4, 8, 'C', 1),
(3, 19, 'B', 1),
(5, 11, 'D', 1),
(5, 6, 'A', 1),
(5, 5, 'E', 1),
(5, 9, 'B', 2),
(5, 8, 'B', 3),
(5, 2, 'C', 1),
(6, 6, 'A', 1),
(6, 12, 'C', 1),
(6, 5, 'E', 1),
(6, 8, 'B', 3),
(6, 19, 'B', 1),
(6, 11, 'D', 1),
(1, 10, 'E', 1),
(1, 13, 'C', 2),
(7, 14, 'C', 1),
(7, 6, 'A', 1),
(7, 5, 'E', 1),
(8, 6, 'A', 1),
(8, 5, 'E', 1),
(8, 8, 'B', 3),
(8, 19, 'B', 1),
(8, 15, 'C', 1),
(8, 16, 'D', 1),
(9, 6, 'A', 1),
(9, 5, 'E', 1),
(9, 8, 'B', 2),
(9, 19, 'B', 1),
(9, 17, 'C', 1),
(9, 18, 'D', 1),
(10, 6, 'A', 1),
(10, 5, 'E', 1),
(10, 8, 'B', 2),
(10, 19, 'B', 1),
(10, 20, 'C', 1),
(8, 9, 'B', 2),
(5, 19, 'B', 1),
(3, 8, 'B', 3),
(6, 9, 'B', 2),
(11, 6, 'A', 1),
(11, 5, 'E', 1),
(11, 8, 'B', 2),
(11, 19, 'B', 1),
(11, 1, 'C', 1),
(11, 18, 'D', 1),
(12, 6, 'A', 1),
(12, 5, 'E', 1),
(12, 8, 'B', 2),
(12, 19, 'B', 1),
(12, 1, 'C', 1),
(12, 22, 'D', 1),
(13, 6, 'A', 1),
(13, 5, 'E', 1),
(13, 8, 'B', 2),
(13, 19, 'B', 1),
(13, 21, 'C', 1),
(13, 22, 'D', 1),
(1, 23, 'D', 1),
(14, 24, 'C', 1),
(14, 3, 'B', 1),
(14, 6, 'A', 1),
(14, 7, 'B', 2),
(14, 10, 'E', 1),
(14, 23, 'D', 1),
(15, 17, 'C', 1),
(16, 6, 'A', 1),
(16, 5, 'E', 1),
(16, 8, 'B', 3),
(16, 19, 'B', 1),
(16, 25, 'C', 1),
(16, 26, 'D', 1),
(16, 9, 'B', 2),
(17, 6, 'A', 1),
(17, 5, 'E', 1),
(17, 8, 'B', 2),
(17, 19, 'B', 1),
(17, 27, 'C', 1),
(17, 28, 'D', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sdaf_configuracion`
--

DROP TABLE IF EXISTS `sdaf_configuracion`;
CREATE TABLE IF NOT EXISTS `sdaf_configuracion` (
  `id_parametro` int(3) NOT NULL AUTO_INCREMENT,
  `parametro` char(255) COLLATE utf8_spanish_ci NOT NULL DEFAULT '',
  `valor` char(255) COLLATE utf8_spanish_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`id_parametro`),
  KEY `parametro` (`parametro`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='Variables de configuracion' AUTO_INCREMENT=20 ;

--
-- Volcar la base de datos para la tabla `sdaf_configuracion`
--

INSERT INTO `sdaf_configuracion` (`id_parametro`, `parametro`, `valor`) VALUES
(1, 'titulo', 'SDAF - Area Financiera Universidad Distrital Francisco José de Caldas'),
(2, 'raiz_documento', 'C:\\wamp\\www\\sdaf'),
(3, 'host', 'http://localhost'),
(4, 'site', '/sdaf'),
(5, 'clave', 'sdaf'),
(6, 'correo', 'financi@udistrital.edu.co'),
(7, 'prefijo', 'sdaf_'),
(8, 'registro', '10'),
(9, 'expiracion', '1440'),
(10, 'wikipedia', 'http://es.wikipedia.org/wiki/'),
(11, 'enlace', 'index'),
(12, 'tamanno_gui', '960'),
(13, 'grafico', '/grafico'),
(14, 'bloques', '/bloque'),
(15, 'javascript', '/funcion'),
(16, 'documento', '/documento'),
(17, 'estilo', '/estilo'),
(18, 'clases', '/clase'),
(19, 'configuracion', '/configuracion');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sdaf_dbms`
--

DROP TABLE IF EXISTS `sdaf_dbms`;
CREATE TABLE IF NOT EXISTS `sdaf_dbms` (
  `nombre` char(50) COLLATE utf8_spanish_ci NOT NULL,
  `dbms` char(20) COLLATE utf8_spanish_ci NOT NULL,
  `servidor` char(50) COLLATE utf8_spanish_ci NOT NULL,
  `puerto` int(6) NOT NULL,
  `ssl` char(50) COLLATE utf8_spanish_ci NOT NULL,
  `db` char(100) COLLATE utf8_spanish_ci NOT NULL,
  `usuario` char(100) COLLATE utf8_spanish_ci NOT NULL,
  `password` char(100) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcar la base de datos para la tabla `sdaf_dbms`
--

INSERT INTO `sdaf_dbms` (`nombre`, `dbms`, `servidor`, `puerto`, `ssl`, `db`, `usuario`, `password`) VALUES
('localxe', 'oci8', 'localhost', 1521, '', 'XE', 'system', 'system');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sdaf_dependencia`
--

DROP TABLE IF EXISTS `sdaf_dependencia`;
CREATE TABLE IF NOT EXISTS `sdaf_dependencia` (
  `id_dependencia` int(7) NOT NULL COMMENT 'CAMPO QUE ALMACENA EL IDENTIFICADOR UNICO DE LA DEPENDENCIA',
  `nombre` varchar(100) COLLATE utf8_spanish_ci NOT NULL COMMENT 'CAMPO EN EL QUE SE ALMACENA EL NOMBRE DE LA DEPENDENCIA',
  `descripcion` text COLLATE utf8_spanish_ci COMMENT 'CAMPO EN EL QUE SE REGISTRA UNA DESCRIPCION DEL DEPARTAMENTO',
  `estado` varchar(1) COLLATE utf8_spanish_ci NOT NULL COMMENT 'CAMPO QUE INDICA EL ESTADO DE LA DEPENDENCIA - CONSULTAR TABLA ESTADO-',
  PRIMARY KEY (`id_dependencia`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcar la base de datos para la tabla `sdaf_dependencia`
--

INSERT INTO `sdaf_dependencia` (`id_dependencia`, `nombre`, `descripcion`, `estado`) VALUES
(1, 'BIENESTAR INSTITUCIONAL', ' DEPENDENCIA ADMINISTRATIVA', '1'),
(2, 'CENTRO DE INVESTIGACIONES Y DESARROLLO CIENTIFICO', ' DEPENDENCIA ADMINISTRATIVA', '1'),
(3, 'COORDINACION GENERAL DE AUTOEVALUACION Y ACREDITACION', ' DEPENDENCIA ADMINISTRATIVA', '1'),
(4, 'DIVISION DE RECURSOS FINANCIEROS', ' DEPENDENCIA ADMINISTRATIVA', '1'),
(5, 'DIVISION DE RECURSOS FISICOS', ' DEPENDENCIA ADMINISTRATIVA', '1'),
(6, 'DIVISION DE RECURSOS HUMANOS', ' DEPENDENCIA ADMINISTRATIVA', '1'),
(7, 'DOCENCIA', ' DEPENDENCIA ADMINISTRATIVA', '1'),
(8, 'EGRESADOS', ' DEPENDENCIA ADMINISTRATIVA', '1'),
(9, 'EMISORA LAUD 90.4 FM', ' DEPENDENCIA ADMINISTRATIVA', '1'),
(10, 'FACULTAD DE ARTES - ASAB', ' DEPENDENCIA ADMINISTRATIVA', '1'),
(11, 'FACULTAD DE CIENCIAS Y EDUCACION', ' DEPENDENCIA ADMINISTRATIVA', '1'),
(12, 'FACULTAD DE INGENIERIA', ' DEPENDENCIA ADMINISTRATIVA', '1'),
(13, 'FACULTAD DEL MEDIO AMBIENTE', ' DEPENDENCIA ADMINISTRATIVA', '1'),
(14, 'FACULTAD TECNOLOGICA', ' DEPENDENCIA ADMINISTRATIVA', '1'),
(15, 'IDEXUD', ' DEPENDENCIA ADMINISTRATIVA', '1'),
(16, 'ILUD', ' DEPENDENCIA ADMINISTRATIVA', '1'),
(17, 'IPAZUD', ' DEPENDENCIA ACADEMICA', '1'),
(18, 'OFICINA ASESORA DE ASUNTOS DISCIPLINARIOS', ' DEPENDENCIA ADMINISTRATIVA', '1'),
(19, 'OFICINA ASESORA DE CONTROL INTERNO', ' DEPENDENCIA ADMINISTRATIVA', '1'),
(20, 'OFICINA ASESORA DE PLANEACION Y CONTROL', ' DEPENDENCIA ADMINISTRATIVA', '1'),
(21, 'OFICINA ASESORA DE SISTEMAS', ' DEPENDENCIA ADMINISTRATIVA', '1'),
(22, 'OFICINA ASESORA JURIDICA', ' DEPENDENCIA ADMINISTRATIVA', '1'),
(23, 'OFICINA DE PUBLICACIONES', ' DEPENDENCIA ADMINISTRATIVA', '1'),
(24, 'OFICINA DE QUEJAS, RECLAMOS Y ATENCION AL CIUDADANO', ' DEPENDENCIA ADMINISTRATIVA', '1'),
(25, 'RECTORIA', ' DEPENDENCIA ADMINISTRATIVA', '1'),
(26, 'RED DE DATOS UDNET', ' DEPENDENCIA ADMINISTRATIVA', '1'),
(27, 'OFICINA DE RELACIONES INTERINSTITUCIONALES', ' DEPENDENCIA ADMINISTRATIVA', '1'),
(28, 'SECCION BIBLIOTECA', ' DEPENDENCIA ADMINISTRATIVA', '1'),
(29, 'SECCION DE ALMACEN GENERAL E INVENTARIOS', ' DEPENDENCIA ADMINISTRATIVA', '1'),
(30, 'SECCION DE COMPRAS', ' DEPENDENCIA ADMINISTRATIVA', '1'),
(31, 'SECCION DE CONTABILIDAD', ' DEPENDENCIA ADMINISTRATIVA', '1'),
(32, 'SECCION DE NOVEDADES', ' DEPENDENCIA ADMINISTRATIVA', '1'),
(33, 'SECCION DE PRESUPUESTO', ' DEPENDENCIA ADMINISTRATIVA', '1'),
(34, 'SECCION DE TESORERIA', ' DEPENDENCIA ADMINISTRATIVA', '1'),
(35, 'SECRETARIA ACADEMICA FACULTAD DE ARTES - ASAB', ' DEPENDENCIA ADMINISTRATIVA', '1'),
(36, 'SECRETARIA ACADEMICA FACULTAD DE CIENCIAS Y EDUCACION', ' DEPENDENCIA ADMINISTRATIVA', '1'),
(37, 'SECRETARIA ACADEMICA FACULTAD DE INGENIERIA', ' DEPENDENCIA ADMINISTRATIVA', '1'),
(38, 'SECRETARIA ACADEMICA FACULTAD DEL MEDIO AMBIENTE Y RECURSOS NATURALES', ' DEPENDENCIA ADMINISTRATIVA', '1'),
(39, 'SECRETARIA ACADEMICA FACULTAD TECNOLOGICA', ' DEPENDENCIA ADMINISTRATIVA', '1'),
(40, 'SECRETARIA GENERAL', ' DEPENDENCIA ADMINISTRATIVA', '1'),
(41, 'SINDICATO DE TRABAJADORES UNIVERSIDAD DISTRITAL', ' DEPENDENCIA ADMINISTRATIVA', '1'),
(42, 'UNIDAD DE EXTENSION FACULTAD DE CIENCIAS Y EDUCACION', ' DEPENDENCIA ADMINISTRATIVA', '1'),
(43, 'UNIDAD DE EXTENSION FACULTAD DE INGENIERIA', ' DEPENDENCIA ADMINISTRATIVA', '1'),
(44, 'UNIDAD DE EXTENSION FACULTAD DEL MEDIO AMBIENTE', ' DEPENDENCIA ADMINISTRATIVA', '1'),
(45, 'UNIDAD DE EXTENSION FACULTAD TECNOLOGICA', ' DEPENDENCIA ADMINISTRATIVA', '1'),
(46, 'VICERRECTORIA ACADEMICA', ' DEPENDENCIA ADMINISTRATIVA', '1'),
(47, 'VICERRECTORIA ADMINISTRATIVAISTRATIVA Y FINANCIERA', ' DEPENDENCIA ADMINISTRATIVA', '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sdaf_estado`
--

DROP TABLE IF EXISTS `sdaf_estado`;
CREATE TABLE IF NOT EXISTS `sdaf_estado` (
  `id_estado` varchar(1) COLLATE utf8_spanish_ci NOT NULL COMMENT 'CAMPO EN EL QUE SE REGISTRA EN CODIGO UNICO DEL ESTADO',
  `nombre` varchar(50) COLLATE utf8_spanish_ci NOT NULL COMMENT 'CAMPO EN EL QUE SE ALMACENA EL NOMBRE DEL ESTADO',
  `tipo` varchar(2) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id_estado`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcar la base de datos para la tabla `sdaf_estado`
--

INSERT INTO `sdaf_estado` (`id_estado`, `nombre`, `tipo`) VALUES
('0', 'INACTIVO', 'U'),
('1', 'ACTIVO', 'U'),
('2', 'PARA TRAMITE', 'A'),
('3', 'EN TRAMITE', 'A'),
('4', 'PARA REVISION', 'A'),
('5', 'EN REVISION', 'A'),
('6', 'APROBADO', 'T'),
('7', 'NO APROBADO', 'T'),
('8', 'DEVUELTO A DEPENDENCIA', 'R'),
('9', 'TRAMITE FINALIZADO', 'A');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sdaf_estilo`
--

DROP TABLE IF EXISTS `sdaf_estilo`;
CREATE TABLE IF NOT EXISTS `sdaf_estilo` (
  `usuario` char(50) COLLATE utf8_spanish_ci NOT NULL DEFAULT '0',
  `estilo` char(50) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`usuario`,`estilo`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='Estilo de pagina en el sitio';

--
-- Volcar la base de datos para la tabla `sdaf_estilo`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sdaf_logger`
--

DROP TABLE IF EXISTS `sdaf_logger`;
CREATE TABLE IF NOT EXISTS `sdaf_logger` (
  `id_usuario` varchar(5) COLLATE utf8_spanish_ci NOT NULL DEFAULT '',
  `evento` varchar(255) COLLATE utf8_spanish_ci NOT NULL DEFAULT '',
  `fecha` varchar(50) COLLATE utf8_spanish_ci NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='Registro de acceso de los usuarios';

--
-- Volcar la base de datos para la tabla `sdaf_logger`
--

INSERT INTO `sdaf_logger` (`id_usuario`, `evento`, `fecha`) VALUES
('1', 'Salida del sistema.', '1319061539'),
('1', 'Salida del sistema.', '1319114164'),
('1', 'Salida del sistema.', '1319239113'),
('1', 'Salida del sistema.', '1319429262'),
('1', 'Salida del sistema.', '1319520125'),
('1', 'Salida del sistema.', '1319591147'),
('3', 'Salida del sistema.', '1319593878'),
('1', 'Salida del sistema.', '1319593968'),
('3', 'Salida del sistema.', '1319594445'),
('1', 'Salida del sistema.', '1319597282'),
('4', 'Salida del sistema.', '1319598461'),
('3', 'Salida del sistema.', '1319598613'),
('4', 'Salida del sistema.', '1319608849'),
('1', 'Salida del sistema.', '1320373779'),
('1', 'Salida del sistema.', '1320897004'),
('1', 'Salida del sistema.', '1320899480'),
('3', 'Salida del sistema.', '1320987406'),
('1', 'Salida del sistema.', '1321043595'),
('3', 'Salida del sistema.', '1321051556'),
('4', 'Salida del sistema.', '1323913089'),
('3', 'Salida del sistema.', '1323925555');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sdaf_log_usuario`
--

DROP TABLE IF EXISTS `sdaf_log_usuario`;
CREATE TABLE IF NOT EXISTS `sdaf_log_usuario` (
  `id_usuario` int(4) NOT NULL,
  `accion` char(100) COLLATE utf8_spanish_ci NOT NULL,
  `id_registro` int(11) NOT NULL,
  `tipo_registro` char(100) COLLATE utf8_spanish_ci NOT NULL,
  `nombre_registro` char(255) COLLATE utf8_spanish_ci NOT NULL,
  `fecha_log` char(100) COLLATE utf8_spanish_ci NOT NULL,
  `descripcion` char(255) COLLATE utf8_spanish_ci NOT NULL,
  KEY `id_usuario` (`id_usuario`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci ROW_FORMAT=COMPACT;

--
-- Volcar la base de datos para la tabla `sdaf_log_usuario`
--

INSERT INTO `sdaf_log_usuario` (`id_usuario`, `accion`, `id_registro`, `tipo_registro`, `nombre_registro`, `fecha_log`, `descripcion`) VALUES
(1, 'REGISTRAR', 1, 'ROL', '3', '1319591099', 'Registra al usuario 3 en el area 11 con el rol 4'),
(1, 'REGISTRAR', 1, 'ROL', '3', '1319591087', 'Registra al usuario 3 en el area 10 con el rol 4'),
(1, 'REGISTRAR', 1, 'ROL', '3', '1319591064', 'Registra al usuario 3 en el area 7 con el rol 4'),
(1, 'REGISTRAR', 1, 'ROL', '3', '1319591045', 'Registra al usuario 3 en el area 6 con el rol 4'),
(1, 'REGISTRAR', 1, 'ROL', '3', '1319591029', 'Registra al usuario 3 en el area 5 con el rol 4'),
(1, 'REGISTRAR', 1, 'ROL', '3', '1319591017', 'Registra al usuario 3 en el area 9 con el rol 4'),
(1, 'REGISTRAR', 1, 'ROL', '3', '1319591006', 'Registra al usuario 3 en el area 3 con el rol 4'),
(1, 'CREAR', 0, 'USUARIO', '123456', '1319590981', 'Registra usuario 123456 al Area  con rol'),
(3, 'REGISTRAR', 0, 'RADICADO', '2011-1', '1319591197', 'Registra radicado 2011-1 de la dependencia 47, para el tramite 1, en el concepto 3'),
(3, 'REGISTRAR', 3, 'RECIBE SOLICITUD', '1,', '1319591221', 'Recibe solicitudes 1, para ser tramitadas en el area 3, para el tramite 1'),
(3, 'TRAMITAR', 1, 'RADICADO', '', '1319593747', 'Se Tramito solicitud 1 por el usuario 3'),
(3, 'REGISTRAR', 3, 'RECIBE SOLICITUD', '1,', '1319593765', 'Recibe solicitudes 1, para ser tramitadas en el area 5, para el tramite 1'),
(3, 'TRAMITAR', 1, 'RADICADO', '', '1319593820', 'Se Tramito solicitud 1 por el usuario 3'),
(3, 'REGISTRAR', 3, 'RECIBE SOLICITUD', '1,', '1319593834', 'Recibe solicitudes 1, para ser tramitadas en el area 6, para el tramite 1'),
(1, 'CREAR', 0, 'USUARIO', '234567', '1319593963', 'Registra usuario 234567 al Area  con rol'),
(3, 'TRAMITAR', 1, 'RADICADO', '', '1319594002', 'Se Tramito solicitud 1 por el usuario 3'),
(3, 'REGISTRAR', 0, 'RADICADO', '2011-2', '1319594044', 'Registra radicado 2011-2 de la dependencia 2, para el tramite 1, en el concepto 2'),
(3, 'REGISTRAR', 3, 'RECIBE SOLICITUD', '2,', '1319594055', 'Recibe solicitudes 2, para ser tramitadas en el area 3, para el tramite 1'),
(3, 'TRAMITAR', 2, 'RADICADO', '', '1319594091', 'Se Tramito solicitud 2 por el usuario 3'),
(3, 'REGISTRAR', 3, 'RECIBE SOLICITUD', '2,', '1319594104', 'Recibe solicitudes 2, para ser tramitadas en el area 5, para el tramite 1'),
(3, 'TRAMITAR', 2, 'RADICADO', '', '1319594122', 'Se Tramito solicitud 2 por el usuario 3'),
(3, 'REGISTRAR', 3, 'RECIBE SOLICITUD', '2,', '1319594130', 'Recibe solicitudes 2, para ser tramitadas en el area 6, para el tramite 1'),
(3, 'TRAMITAR', 2, 'RADICADO', '', '1319594161', 'Se Tramito solicitud 2 por el usuario 3'),
(3, 'REGISTRAR', 3, 'RECIBE SOLICITUD', '2,', '1319594172', 'Recibe solicitudes 2, para ser tramitadas en el area 7, para el tramite 1'),
(3, 'TRAMITAR', 2, 'RADICADO', '', '1319594220', 'Se Tramito solicitud 2 por el usuario 3'),
(3, 'REGISTRAR', 3, 'RECIBE SOLICITUD', '2,', '1319594228', 'Recibe solicitudes 2, para ser tramitadas en el area 9, para el tramite 1'),
(3, 'TRAMITAR', 2, 'RADICADO', '', '1319594247', 'Se Tramito solicitud 2 por el usuario 3'),
(3, 'REGISTRAR', 3, 'RECIBE SOLICITUD', '2,', '1319594274', 'Recibe solicitudes 2, para ser tramitadas en el area 10, para el tramite 1'),
(3, 'TRAMITAR', 2, 'RADICADO', '', '1319594293', 'Se Tramito solicitud 2 por el usuario 3'),
(3, 'REGISTRAR', 3, 'RECIBE SOLICITUD', '2,', '1319594304', 'Recibe solicitudes 2, para ser tramitadas en el area 11, para el tramite 1'),
(3, 'TRAMITAR', 2, 'RADICADO', '', '1319594328', 'Se Tramito solicitud 2 por el usuario 3'),
(1, 'REGISTRAR', 1, 'ROL', '4', '1319597277', 'Registra al usuario 4 en el area 1 con el rol 5'),
(4, 'REGISTRAR', 4, 'RECIBE SOLICITUD', '1,', '1319607759', 'Recibe solicitudes 1, para ser tramitadas en el area 1, para el tramite 1'),
(0, 'EDITAR', 4, 'USUARIO', '4', '1320944904', 'Modifica Estado del usuario 4 a INACTIVO'),
(1, 'EDITAR', 4, 'USUARIO', '4', '1320944923', 'Modifica Estado del usuario 4 a ACTIVO'),
(1, 'CREAR', 0, 'USUARIO', '9876543', '1320953205', 'Registra usuario 9876543 al Area  con rol'),
(1, 'REGISTRAR', 1, 'ROL', '4', '1320956565', 'Registra al usuario 4 en el area 6 con el rol 4'),
(0, 'REGISTRAR', 0, 'RADICADO', '2011-3', '1320981237', 'Registra radicado 2011-3 de la dependencia 46, para el tramite 1, en el concepto 3'),
(3, 'REGISTRAR', 0, 'RADICADO', '2011-4', '1320981519', 'Registra radicado 2011-4 de la dependencia 46, para el tramite 1, en el concepto 3'),
(3, 'REGISTRAR', 3, 'RECIBE SOLICITUD', '3,4,', '1321045504', 'Recibe solicitudes 3,4, para ser tramitadas en el area 3, para el tramite 1'),
(3, 'TRAMITAR', 3, 'RADICADO', '', '1321050789', 'Se Tramito solicitud 3 por el usuario 3'),
(3, 'REGISTRAR', 0, 'RADICADO', '2011-1', '1323921818', 'Registra radicado 2011-1 de la dependencia 2, para el tramite 2, en el concepto 3'),
(3, 'REGISTRAR', 0, 'RADICADO', '2011-2', '1323921848', 'Registra radicado 2011-2 de la dependencia 3, para el tramite 2, en el concepto 3'),
(3, 'REGISTRAR', 0, 'RADICADO', '2011-5', '1323925584', 'Registra radicado 2011-5 de la dependencia 6, para el tramite 1, en el concepto 3'),
(3, 'REGISTRAR', 0, 'RADICADO', '2011-1', '1323925645', 'Registra radicado 2011-1 de la dependencia 47, para el tramite 2, en el concepto 3'),
(3, 'REGISTRAR', 0, 'RADICADO', '2011-1', '1323926247', 'Registra radicado 2011-1 de la dependencia 5, para el tramite 2, en el concepto 3'),
(3, 'REGISTRAR', 0, 'RADICADO', '2011-1', '1323926646', 'Registra radicado 2011-1 de la dependencia 10, para el tramite 2, en el concepto 3'),
(3, 'REGISTRAR', 0, 'RADICADO', '2011-2', '1323926751', 'Registra radicado 2011-2 de la dependencia 23, para el tramite 2, en el concepto 2');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sdaf_noticia`
--

DROP TABLE IF EXISTS `sdaf_noticia`;
CREATE TABLE IF NOT EXISTS `sdaf_noticia` (
  `id_noticia` int(11) NOT NULL AUTO_INCREMENT,
  `tipo_noticia` int(4) NOT NULL,
  `titulo_noticia` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `noticia` text COLLATE utf8_spanish_ci NOT NULL,
  `fecha_publicacion` char(100) CHARACTER SET utf8 COLLATE utf8_swedish_ci NOT NULL,
  `id_usuario` int(4) NOT NULL,
  `estado` varchar(1) COLLATE utf8_spanish_ci NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_noticia`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci ROW_FORMAT=DYNAMIC AUTO_INCREMENT=2 ;

--
-- Volcar la base de datos para la tabla `sdaf_noticia`
--

INSERT INTO `sdaf_noticia` (`id_noticia`, `tipo_noticia`, `titulo_noticia`, `noticia`, `fecha_publicacion`, `id_usuario`, `estado`) VALUES
(1, 3, 'Prueba', 'noticia de prueba\r\n\r\n', '1320970697', 1, '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sdaf_pagina`
--

DROP TABLE IF EXISTS `sdaf_pagina`;
CREATE TABLE IF NOT EXISTS `sdaf_pagina` (
  `id_pagina` int(7) NOT NULL AUTO_INCREMENT,
  `nombre` char(50) COLLATE utf8_spanish_ci NOT NULL DEFAULT '',
  `descripcion` char(250) COLLATE utf8_spanish_ci NOT NULL DEFAULT '',
  `modulo` char(50) COLLATE utf8_spanish_ci NOT NULL DEFAULT '',
  `nivel` int(2) NOT NULL DEFAULT '0',
  `parametro` char(255) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id_pagina`),
  UNIQUE KEY `id_pagina` (`id_pagina`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci PACK_KEYS=0 ROW_FORMAT=FIXED COMMENT='Relacion de paginas en el aplicativo' AUTO_INCREMENT=18 ;

--
-- Volcar la base de datos para la tabla `sdaf_pagina`
--

INSERT INTO `sdaf_pagina` (`id_pagina`, `nombre`, `descripcion`, `modulo`, `nivel`, `parametro`) VALUES
(1, 'index', 'Pagina Principal del sdaf', 'GENERAL', 0, ''),
(2, 'registroUsuario', 'Pagina Principal con formulario para registro de usuario', 'GENERAL', 0, ''),
(3, 'administrador', 'Pagina principal del subsistema de administracion', 'ADMINISTRADOR', 1, ''),
(4, 'logout', 'Pagina intermedia para la finalizacion de seseiones', 'GENERAL', 0, ''),
(5, 'adminNoticia', 'pagina principal administrar noticias', 'ADMINISTRADOR', 1, ''),
(6, 'crearNoticia', 'pagina para insertar nuevas noticias', 'ADMINISTRADOR', 1, ''),
(7, 'borrar_registro', 'Pagina general para borrar registros en el sistema', 'GENERAL', 0, ''),
(8, 'adminUsuario', 'Pagina para la administracion de los usuarios', 'ADMINISTRADOR', 1, '&xajax=AREA&xajax_file=Usuarios'),
(9, 'adminRadica', 'Pagina para la administracion de las radicaciones', 'RADICACION', 1, '&xajax=AREA|DOCUMENTO&xajax_file=Radica'),
(10, 'adminGeneral', 'Pagina para la administracion de DATOS BASICOS', 'GENERAL', 1, ''),
(11, 'radicacion', 'Pagina principal de las radicaciones', 'RADICACION', 1, ''),
(12, 'tramite', 'Pagina principal para realizar los tramites', 'TRAMITES', 1, ''),
(13, 'adminTramite', 'Pagina principal para consultar y tramitar solicitudes', 'TRAMITES', 1, '&xajax=ASIG_USUARIO&xajax_file=Usuarios'),
(14, 'consulta', 'Pagina Principal para la consulta de solicitudes de tramite radicadas', 'GENERAL', 0, ''),
(15, 'imprime', 'Imprime el numero del radicado', 'GENERAL', 1, ''),
(16, 'adminTipoTramite', 'Pagina para registrar tipos de tramites', 'ADMINISTRADOR', 1, '&xajax=AREA&xajax_file=Usuarios'),
(17, 'seguimiento', 'Pagina principal del subsistema de seguimiento a los tramites', 'SEGUIMIENTO', 1, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sdaf_registrado`
--

DROP TABLE IF EXISTS `sdaf_registrado`;
CREATE TABLE IF NOT EXISTS `sdaf_registrado` (
  `id_usuario` int(7) NOT NULL AUTO_INCREMENT,
  `identificacion` varchar(15) COLLATE utf8_spanish_ci NOT NULL,
  `nombre` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `apellido` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `correo` char(250) COLLATE utf8_spanish_ci NOT NULL,
  `telefono1` int(7) NOT NULL,
  `extensiones1` varchar(50) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Guarda las extensiones separadas por guion(-)',
  `usuario` char(50) COLLATE utf8_spanish_ci NOT NULL,
  `clave` char(50) COLLATE utf8_spanish_ci NOT NULL,
  `celular` varchar(15) COLLATE utf8_spanish_ci DEFAULT NULL,
  `fecha_registro` date NOT NULL,
  `estado` varchar(1) COLLATE utf8_spanish_ci NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_usuario`),
  KEY `id_usuario` (`id_usuario`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci PACK_KEYS=0 ROW_FORMAT=FIXED AUTO_INCREMENT=6 ;

--
-- Volcar la base de datos para la tabla `sdaf_registrado`
--

INSERT INTO `sdaf_registrado` (`id_usuario`, `identificacion`, `nombre`, `apellido`, `correo`, `telefono1`, `extensiones1`, `usuario`, `clave`, `celular`, `fecha_registro`, `estado`) VALUES
(1, '1', 'ADMINISTRADOR', 'ADMINISTRADOR', '', 0, '0', 'administrador', '21232f297a57a5a743894a0e4a801fc3', NULL, '2011-07-21', '1'),
(0, '0', 'SIN', 'ASIGNAR', 'NA', 0, 'NA', 'NA', 'NA', NULL, '2011-08-01', '0'),
(3, '123456', 'PRUEBAS', 'P', 'qwe@ww.com', 123456, '123', '123456', 'e10adc3949ba59abbe56e057f20f883e', '', '2011-10-25', '1'),
(4, '234567', 'PRUEBAS DOS', 'PP', 'sdfsd@ddd.co', 4567890, '78', '234567', '508df4cb2f4d8f80519256258cfb975f', '', '2011-10-25', '1'),
(5, '9876543', 'NOMBRES USUARIO', 'APELLIDOS DE USUARIO', 'corre@electronico.com', 34567890, '55', '9876543', '7c51a5e6ea3214af970a86df89793b19', '', '2011-11-10', '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sdaf_registrado_borrador`
--

DROP TABLE IF EXISTS `sdaf_registrado_borrador`;
CREATE TABLE IF NOT EXISTS `sdaf_registrado_borrador` (
  `nombre` char(250) NOT NULL DEFAULT '',
  `apellido` char(250) NOT NULL DEFAULT '',
  `correo` char(100) NOT NULL DEFAULT '',
  `telefono` char(50) NOT NULL DEFAULT '',
  `usuario` char(50) NOT NULL DEFAULT '',
  `identificador` char(50) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=latin1 PACK_KEYS=0;

--
-- Volcar la base de datos para la tabla `sdaf_registrado_borrador`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sdaf_registrado_subsistema`
--

DROP TABLE IF EXISTS `sdaf_registrado_subsistema`;
CREATE TABLE IF NOT EXISTS `sdaf_registrado_subsistema` (
  `id_usuario` int(7) NOT NULL DEFAULT '0',
  `id_subsistema` int(7) NOT NULL DEFAULT '0',
  `estado` int(2) NOT NULL DEFAULT '0',
  `id_area` int(7) NOT NULL COMMENT 'CAMPO QUE INDICA EL CODIGO DEL AREA AL QUE PERTENECE EL USUARIO',
  `fecha_registro` date NOT NULL COMMENT 'CAMPO EN EL QUE SE ALMACENA LA FECHA DE REGISTRO DEL USUARIO PARA EL AREA Y PERFIL',
  `fecha_fin` date DEFAULT NULL COMMENT 'CAMPO QUE INDICA LA FECHA EN QUE SE DESACTIVA EL USUARIO'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='Relacion de usuarios que tienen acceso a modulos especiales';

--
-- Volcar la base de datos para la tabla `sdaf_registrado_subsistema`
--

INSERT INTO `sdaf_registrado_subsistema` (`id_usuario`, `id_subsistema`, `estado`, `id_area`, `fecha_registro`, `fecha_fin`) VALUES
(1, 1, 1, 0, '2011-07-25', '2020-12-31'),
(3, 4, 1, 3, '2011-10-25', '2011-12-31'),
(3, 3, 1, 2, '2011-10-25', '2011-12-31'),
(3, 4, 1, 9, '2011-10-25', '2011-12-31'),
(3, 4, 1, 5, '2011-10-25', '2011-12-31'),
(3, 4, 1, 6, '2011-10-25', '2011-12-31'),
(3, 4, 1, 7, '2011-10-25', '2011-12-31'),
(3, 4, 1, 10, '2011-10-25', '2011-12-31'),
(3, 4, 1, 11, '2011-10-25', '2011-12-31'),
(4, 4, 1, 1, '2011-10-25', '2011-12-31'),
(4, 5, 1, 1, '2011-10-25', '2011-12-31'),
(5, 4, 0, 5, '2011-11-10', '2011-11-11'),
(4, 4, 1, 6, '2011-11-10', '2011-12-31');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sdaf_subsistema`
--

DROP TABLE IF EXISTS `sdaf_subsistema`;
CREATE TABLE IF NOT EXISTS `sdaf_subsistema` (
  `id_subsistema` int(7) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(250) COLLATE utf8_spanish_ci NOT NULL DEFAULT '',
  `etiqueta` varchar(100) COLLATE utf8_spanish_ci NOT NULL DEFAULT '',
  `id_pagina` int(7) NOT NULL DEFAULT '0',
  `observacion` text COLLATE utf8_spanish_ci,
  PRIMARY KEY (`id_subsistema`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci PACK_KEYS=0 COMMENT='Subsistemas que componen el aplicativo' AUTO_INCREMENT=6 ;

--
-- Volcar la base de datos para la tabla `sdaf_subsistema`
--

INSERT INTO `sdaf_subsistema` (`id_subsistema`, `nombre`, `etiqueta`, `id_pagina`, `observacion`) VALUES
(1, 'administrador', 'Administrador', 3, 'Subsistema para la administracion del Sistema'),
(2, 'consulta', 'Consulta', 8, 'PAGINA PARA SOLO CONSULTA'),
(3, 'radicacion', 'Radicaci&oacute;n', 11, 'PAGINA PARA RADICAR LAS SOLICITUDES DE TRAMITE'),
(4, 'tramite', 'Tramite', 12, 'PAGINA PARA REALIZAR LOS TRAMITES'),
(5, 'seguimiento', 'Seguimiento', 17, 'PAGINA PARA CONSULTA Y SEGUIMIENTO DE TRAMITES REALIZADOS');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sdaf_tconcep_ttramite`
--

DROP TABLE IF EXISTS `sdaf_tconcep_ttramite`;
CREATE TABLE IF NOT EXISTS `sdaf_tconcep_ttramite` (
  `id_Ttramite` int(7) NOT NULL,
  `id_tconcep` int(7) NOT NULL,
  `fecha_registro` date NOT NULL,
  `fecha_fin` date DEFAULT NULL,
  `estado` varchar(1) COLLATE utf8_spanish_ci NOT NULL DEFAULT '1',
  KEY `id_Ttramite` (`id_Ttramite`,`id_tconcep`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcar la base de datos para la tabla `sdaf_tconcep_ttramite`
--

INSERT INTO `sdaf_tconcep_ttramite` (`id_Ttramite`, `id_tconcep`, `fecha_registro`, `fecha_fin`, `estado`) VALUES
(1, 1, '2011-07-22', '0000-00-00', '1'),
(1, 2, '2011-07-22', '0000-00-00', '1'),
(1, 3, '2011-07-22', '0000-00-00', '1'),
(2, 1, '2011-07-22', '0000-00-00', '1'),
(2, 2, '2011-07-22', '0000-00-00', '1'),
(2, 3, '2011-07-22', '0000-00-00', '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sdaf_tipo_concepto`
--

DROP TABLE IF EXISTS `sdaf_tipo_concepto`;
CREATE TABLE IF NOT EXISTS `sdaf_tipo_concepto` (
  `id_tconcep` int(7) NOT NULL,
  `nombre` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `descripcion` text COLLATE utf8_spanish_ci,
  `estado` varchar(1) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id_tconcep`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcar la base de datos para la tabla `sdaf_tipo_concepto`
--

INSERT INTO `sdaf_tipo_concepto` (`id_tconcep`, `nombre`, `descripcion`, `estado`) VALUES
(1, 'AVANCE', 'DOCUMENTO QUE SOLICITA AVANCE', '1'),
(2, 'ORDEN DE COMPRAS', 'DOCUMENTO QUE SOLICITA EL PAGO DE ORDEN DE COMPRA', '1'),
(3, 'NOMINA', 'DOCUMENTO QUE SOLICITA EL PAGO DE LA NOMINA DE LAS DEPENDENCIAS DE LA UNIVERSIDAD', '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sdaf_tipo_tramite`
--

DROP TABLE IF EXISTS `sdaf_tipo_tramite`;
CREATE TABLE IF NOT EXISTS `sdaf_tipo_tramite` (
  `id_Ttramite` int(7) NOT NULL,
  `nombre` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `descripcion` text COLLATE utf8_spanish_ci,
  `estado` varchar(1) COLLATE utf8_spanish_ci NOT NULL,
  `fecha_registro` date NOT NULL,
  `resumen` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `id_dependencia` int(7) NOT NULL,
  `dias_respuesta` int(11) NOT NULL,
  `gen_consec` varchar(2) COLLATE utf8_spanish_ci DEFAULT NULL COMMENT 'se define si el tramite genera consecutivos',
  `id_tipo` int(11) DEFAULT NULL COMMENT 'indica el tipo de consecutivo que genera el  tramite',
  PRIMARY KEY (`id_Ttramite`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcar la base de datos para la tabla `sdaf_tipo_tramite`
--

INSERT INTO `sdaf_tipo_tramite` (`id_Ttramite`, `nombre`, `descripcion`, `estado`, `fecha_registro`, `resumen`, `id_dependencia`, `dias_respuesta`, `gen_consec`, `id_tipo`) VALUES
(1, 'SOLICITUD DE PAGO PRESUPUESTO', 'TRAMITE MEDIANTE EL CUAL SE SOLICITA EL PAGO CUENTAS DEL PRESUPUESTO DE LA UNIVERSIDAD', '1', '2011-07-22', 'PRESUPUESTO', 4, 3, 'S', 5),
(2, 'SOLICITUD DE PAGO CONVENIOS', 'TRAMITE MEDIANTE EL CUAL SE SOLICITAN LOS PAGOS DE LOS CONVENIOS DE LA UNIVERSIDAD', '1', '2011-07-22', 'CONVENIOS', 4, 12, 'S', 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sdaf_tmp_asigna`
--

DROP TABLE IF EXISTS `sdaf_tmp_asigna`;
CREATE TABLE IF NOT EXISTS `sdaf_tmp_asigna` (
  `id_sol` int(11) NOT NULL DEFAULT '0',
  `id_area` int(7) NOT NULL DEFAULT '0',
  `id_usuario` int(7) NOT NULL DEFAULT '0',
  `estado` varchar(1) COLLATE utf8_spanish_ci NOT NULL DEFAULT '1',
  `fecha_registro` date NOT NULL,
  `fecha_fin` date NOT NULL,
  KEY `id_sol` (`id_sol`,`id_area`,`id_usuario`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='Tabla en la que se registran la asignacion de documento';

--
-- Volcar la base de datos para la tabla `sdaf_tmp_asigna`
--

INSERT INTO `sdaf_tmp_asigna` (`id_sol`, `id_area`, `id_usuario`, `estado`, `fecha_registro`, `fecha_fin`) VALUES
(1, 6, 3, '0', '2011-10-25', '2011-10-25'),
(2, 11, 3, '0', '2011-10-25', '2011-10-25');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sdaf_tramita_solicitud`
--

DROP TABLE IF EXISTS `sdaf_tramita_solicitud`;
CREATE TABLE IF NOT EXISTS `sdaf_tramita_solicitud` (
  `id_sol` int(11) NOT NULL DEFAULT '0',
  `id_area` int(7) NOT NULL DEFAULT '0',
  `id_usuario` int(7) NOT NULL DEFAULT '0',
  `estado` varchar(1) COLLATE utf8_spanish_ci NOT NULL DEFAULT '1',
  `descripcion` text COLLATE utf8_spanish_ci,
  `fecha_registro` datetime NOT NULL,
  `fecha_tramitado` datetime DEFAULT NULL,
  `fecha_traslado` datetime DEFAULT NULL,
  KEY `id_sol` (`id_sol`,`id_area`,`id_usuario`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='Tabla en la que se registran el seguimiento del tramite';

--
-- Volcar la base de datos para la tabla `sdaf_tramita_solicitud`
--

INSERT INTO `sdaf_tramita_solicitud` (`id_sol`, `id_area`, `id_usuario`, `estado`, `descripcion`, `fecha_registro`, `fecha_tramitado`, `fecha_traslado`) VALUES
(1, 3, 3, '6', 'SE APROBO', '2011-10-25 20:07:01', '2011-10-26 20:49:07', '2011-10-26 20:49:25'),
(1, 5, 3, '6', 'SE APROBO', '2011-10-26 20:49:25', '2011-10-27 20:50:20', '2011-10-27 20:50:34'),
(1, 6, 3, '7', 'NO SE APROBO', '2011-10-27 20:50:34', '2011-10-28 20:53:22', '2011-10-28 00:42:39'),
(1, 1, 4, '5', NULL, '2011-10-28 21:42:39', NULL, NULL),
(2, 3, 3, '6', 'APROBADO', '2011-10-25 20:54:15', '2011-10-25 20:54:51', '2011-10-25 20:55:04'),
(2, 5, 3, '6', 'APROBADO', '2011-10-25 20:55:04', '2011-10-25 20:55:22', '2011-10-25 20:55:30'),
(2, 6, 3, '6', 'APROBADO', '2011-10-25 20:55:30', '2011-10-25 20:56:01', '2011-10-25 20:56:12'),
(2, 7, 3, '6', 'APROBADO', '2011-10-25 20:56:12', '2011-10-25 20:57:00', '2011-10-25 20:57:08'),
(2, 9, 3, '6', 'APROBADO', '2011-10-25 20:57:08', '2011-10-25 20:57:27', '2011-10-25 20:57:54'),
(2, 10, 3, '6', 'APROBADO', '2011-10-25 20:57:54', '2011-10-25 20:58:13', '2011-10-25 20:58:24'),
(2, 11, 3, '6', 'APROBADO', '2011-10-25 20:58:24', '2011-10-25 20:58:48', NULL),
(3, 3, 3, '6', '\r\n\r\n\r\nDESCRIPCION DEL RESULTADO DEL TRAMITE', '2011-11-11 21:05:04', '2011-11-11 22:33:09', NULL),
(10, 4, 0, '4', NULL, '2011-12-15 05:24:06', NULL, NULL),
(11, 4, 0, '4', NULL, '2011-12-15 05:25:51', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sdaf_tsolicitud`
--

DROP TABLE IF EXISTS `sdaf_tsolicitud`;
CREATE TABLE IF NOT EXISTS `sdaf_tsolicitud` (
  `id_sol` int(11) NOT NULL AUTO_INCREMENT,
  `id_dependencia` int(7) NOT NULL DEFAULT '0',
  `id_Ttramite` int(7) NOT NULL DEFAULT '0',
  `id_tconcep` int(7) NOT NULL DEFAULT '0',
  `vigencia` int(6) NOT NULL DEFAULT '0',
  `num_radica` int(11) NOT NULL DEFAULT '0',
  `cod_oficio` varchar(16) COLLATE utf8_spanish_ci NOT NULL DEFAULT '0',
  `descripcion` text COLLATE utf8_spanish_ci,
  `fecha_registro` datetime NOT NULL,
  `estado` varchar(1) COLLATE utf8_spanish_ci NOT NULL DEFAULT '2',
  `id_usuario` int(7) NOT NULL,
  PRIMARY KEY (`id_sol`),
  KEY `id_Ttramite` (`id_dependencia`,`id_Ttramite`,`id_tconcep`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='Tabla en la que se registran la sredicaciones de tramite' AUTO_INCREMENT=12 ;

--
-- Volcar la base de datos para la tabla `sdaf_tsolicitud`
--

INSERT INTO `sdaf_tsolicitud` (`id_sol`, `id_dependencia`, `id_Ttramite`, `id_tconcep`, `vigencia`, `num_radica`, `cod_oficio`, `descripcion`, `fecha_registro`, `estado`, `id_usuario`) VALUES
(1, 47, 1, 3, 2011, 1, '1234', 'solicitud de pago', '2011-10-20 20:06:37', '3', 3),
(2, 2, 1, 2, 2011, 2, '4567', 'otra prueba', '2011-10-25 20:54:04', '9', 3),
(3, 46, 1, 3, 2011, 3, 'OFICIO 001', 'descripcion de la solicitud de tramite', '2011-11-11 03:13:57', '3', 0),
(4, 46, 1, 3, 2011, 4, 'OFICIO 002', 'descripcion de la radicacion para tramite', '2011-11-11 03:18:39', '3', 3),
(11, 23, 2, 2, 2011, 2, 'QPOS', 'asdasd', '2011-12-15 05:25:51', '2', 3),
(10, 10, 2, 3, 2011, 1, 'OTRO123', 'de nuevo', '2011-12-15 05:24:06', '2', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sdaf_valor_sesion`
--

DROP TABLE IF EXISTS `sdaf_valor_sesion`;
CREATE TABLE IF NOT EXISTS `sdaf_valor_sesion` (
  `id_sesion` varchar(32) COLLATE utf8_spanish_ci NOT NULL DEFAULT '',
  `variable` varchar(20) COLLATE utf8_spanish_ci NOT NULL DEFAULT '',
  `valor` text COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id_sesion`,`variable`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='Valores de sesion';

--
-- Volcar la base de datos para la tabla `sdaf_valor_sesion`
--

INSERT INTO `sdaf_valor_sesion` (`id_sesion`, `variable`, `valor`) VALUES
('f1aa5b286ad79a3dc910633ee7132013', 'usuario', 'PRUEBAS'),
('f1aa5b286ad79a3dc910633ee7132013', 'acceso', '3'),
('f1aa5b286ad79a3dc910633ee7132013', 'id_usuario', '3'),
('f1aa5b286ad79a3dc910633ee7132013', 'expiracion', '1323930957'),
('f1aa5b286ad79a3dc910633ee7132013', 'identificacion', '3');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sdaf_variable`
--

DROP TABLE IF EXISTS `sdaf_variable`;
CREATE TABLE IF NOT EXISTS `sdaf_variable` (
  `id_tipo` int(4) NOT NULL AUTO_INCREMENT,
  `valor` char(100) COLLATE utf8_spanish_ci NOT NULL,
  `descripcion` char(255) COLLATE utf8_spanish_ci NOT NULL,
  `tipo` char(100) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id_tipo`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci ROW_FORMAT=FIXED AUTO_INCREMENT=6 ;

--
-- Volcar la base de datos para la tabla `sdaf_variable`
--

INSERT INTO `sdaf_variable` (`id_tipo`, `valor`, `descripcion`, `tipo`) VALUES
(1, 'CEDULA CIUDADANIA', '', 'DOCUMENTO'),
(2, 'CEDULA DE EXTRANJERIA', '', 'DOCUMENTO'),
(3, 'GENERAL', 'Noticias Generales', 'NOTICIA'),
(4, 'DEVOLUCIONES', 'Noticias de devoluciones de tramite', 'NOTICIA'),
(5, 'ORDEN DE PAGO', 'Consecutivo de ordenes de pago, para tramites de pago', 'CONSECUTIVOS');
