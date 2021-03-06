-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 26-02-2019 a las 22:34:54
-- Versión del servidor: 5.6.21
-- Versión de PHP: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `riderz`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dbactivacionusuarios`
--

CREATE TABLE IF NOT EXISTS `dbactivacionusuarios` (
`idactivacionusuario` int(11) NOT NULL,
  `refusuarios` int(11) NOT NULL,
  `token` varchar(36) COLLATE utf8_spanish2_ci NOT NULL,
  `vigenciadesde` date NOT NULL,
  `vigenciahasta` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `dbactivacionusuarios`
--

INSERT INTO `dbactivacionusuarios` (`idactivacionusuario`, `refusuarios`, `token`, `vigenciadesde`, `vigenciahasta`) VALUES
(1, 21, 'C436C158-D4ED-4D3F-8AEB-CD62FE870EC9', '2019-02-25', '2019-02-27'),
(2, 22, 'ECF93218-783F-4795-B890-C3D9BAA2F80A', '2019-02-25', '2019-02-27');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dbarchivos`
--

CREATE TABLE IF NOT EXISTS `dbarchivos` (
`idarchivo` int(11) NOT NULL,
  `refclientes` int(11) NOT NULL,
  `refcategorias` int(11) NOT NULL,
  `anio` int(11) NOT NULL,
  `mes` int(11) NOT NULL,
  `token` varchar(36) NOT NULL,
  `type` varchar(45) DEFAULT NULL,
  `observacion` varchar(150) DEFAULT NULL,
  `imagen` varchar(149) DEFAULT NULL,
  `fechacreacion` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `reftipoarchivos` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `dbarchivos`
--

INSERT INTO `dbarchivos` (`idarchivo`, `refclientes`, `refcategorias`, `anio`, `mes`, `token`, `type`, `observacion`, `imagen`, `fechacreacion`, `reftipoarchivos`) VALUES
(14, 10, 1, 2019, 2, '24444B42-6686-4598-AC53-D72FD6DBAEAE', 'application/pdf', '', 'DI-2018-342-GDEBA-DGAMEGPAMTAE.pdf', '2019-02-14 14:05:50', 1),
(15, 11, 1, 2019, 2, 'E0D12501-C7BD-4DE6-84DE-A277AC07B27A', 'application/pdf', '', 'PVSA-PortaldeLicitaciones-Workana.pdf', '2019-02-14 14:29:40', 1),
(16, 12, 1, 2019, 2, '2C17680C-0350-4FF1-935B-77B5D4393248', 'application/pdf', '', 'DI-2018-342-GDEBA-DGAMEGPAMTAE.pdf', '2019-02-14 14:31:20', 1),
(17, 13, 1, 2019, 2, '5ADEE799-F0CE-4C34-8001-4402024C51DB', 'application/pdf', '', 'Nota_DEPOSITARENCUENTAEXISTENTE_20140429.pdf', '2019-02-14 14:33:01', 1),
(18, 14, 1, 2019, 2, '741FBC4D-C877-46DF-BA5A-4901C7D41735', 'application/pdf', '', 'ALTA-JUGADOR-2019-02-202.pdf', '2019-02-25 17:30:45', 1),
(19, 15, 1, 2019, 2, 'D93E1ED5-868B-4736-A0E3-35BD954D3FB5', 'application/pdf', '', 'DI-2018-342-GDEBA-DGAMEGPAMTAE.pdf', '2019-02-25 17:31:12', 1),
(20, 16, 1, 2019, 2, 'B67E4FD2-81FE-49BC-8BB1-91C8E685AB57', 'application/pdf', '', 'Nota_DEPOSITARENCUENTAEXISTENTE_20140429.pdf', '2019-02-25 17:32:16', 1),
(21, 17, 1, 2019, 2, '24E39B8B-4A1F-4736-8354-8B338932579C', 'image/jpeg', '', 'madera_olaff.jpg', '2019-02-26 17:43:30', 1),
(23, 19, 1, 2019, 2, 'B636A1DF-C6DC-48EE-9587-A10166BC2CCD', 'image/jpeg', '', 'madera_olaff.jpg', '2019-02-26 17:45:42', 1),
(24, 1, 1, 2019, 5, 'A239E2BB-4091-4B26-AB3D-B9E008FD28AD', 'image/png', '', '1-F39pvf.png', '2019-02-26 18:38:06', 2),
(25, 1, 1, 2018, 8, '4BB3A91F-1BEE-44A7-A100-793E673FBC97', 'image/png', '', 'olaff_logo13.png', '2019-02-26 20:05:46', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dbclientes`
--

CREATE TABLE IF NOT EXISTS `dbclientes` (
`idcliente` int(11) NOT NULL,
  `reftipodocumentos` int(11) NOT NULL,
  `nrodocumento` varchar(10) COLLATE utf8_spanish2_ci NOT NULL,
  `apellido` varchar(120) COLLATE utf8_spanish2_ci NOT NULL,
  `nombre` varchar(120) COLLATE utf8_spanish2_ci NOT NULL,
  `telefono` varchar(25) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `celular` varchar(25) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `email` varchar(60) COLLATE utf8_spanish2_ci NOT NULL,
  `aceptaterminos` bit(1) NOT NULL DEFAULT b'0',
  `subscripcion` bit(1) NOT NULL DEFAULT b'0',
  `activo` bit(1) DEFAULT b'0',
  `ciudad` varchar(120) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `fechanacimiento` date DEFAULT NULL,
  `domicilio` varchar(250) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `codigopostal` varchar(12) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `municipio` varchar(120) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `iban` varchar(24) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `nroseguro` varchar(12) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `fotofrente` varchar(120) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `fotodorsal` varchar(120) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `codigoreferencia` varchar(60) COLLATE utf8_spanish2_ci DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `dbclientes`
--

INSERT INTO `dbclientes` (`idcliente`, `reftipodocumentos`, `nrodocumento`, `apellido`, `nombre`, `telefono`, `celular`, `email`, `aceptaterminos`, `subscripcion`, `activo`, `ciudad`, `fechanacimiento`, `domicilio`, `codigopostal`, `municipio`, `iban`, `nroseguro`, `fotofrente`, `fotodorsal`, `codigoreferencia`) VALUES
(1, 1, '1', 'Admin', 'Admin', NULL, NULL, 'admin@admin.com', b'1', b'0', b'1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(24, 1, '31553466', 'SAFAR', 'Marcos Saupurein', '1698564654', '', 'campochico@aif.org.ar', b'1', b'0', b'1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(26, 1, '984986', 'ropaldo', 'daniela', '', '', 'ropaldo@gmail.com', b'1', b'1', b'1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(27, 1, '31552466P', 'Rolle', 'Roman', '', '', 'aranjuez@aif.org.ar', b'1', b'0', b'1', '', '0000-00-00', '', '', '', '', NULL, '', '', ''),
(28, 1, '31552465F', 'asdasd', 'asdasd', '', '', 'aranzazu@aif.org.ar', b'1', b'0', b'0', '', '0000-00-00', '', '', '', '', NULL, '', '', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dbfacturas`
--

CREATE TABLE IF NOT EXISTS `dbfacturas` (
`idfactura` int(11) NOT NULL,
  `refclientes` int(11) NOT NULL,
  `reftipofacturas` int(11) NOT NULL,
  `refestados` int(11) NOT NULL,
  `refmeses` int(11) NOT NULL,
  `anio` int(11) NOT NULL,
  `concepto` varchar(180) COLLATE utf8_spanish_ci DEFAULT NULL,
  `total` decimal(18,2) DEFAULT '0.00',
  `iva` decimal(10,2) DEFAULT '0.00',
  `irff` decimal(10,2) DEFAULT '0.00',
  `fechaingreso` date NOT NULL,
  `fechasubido` date NOT NULL,
  `imagen` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `dbfacturas`
--

INSERT INTO `dbfacturas` (`idfactura`, `refclientes`, `reftipofacturas`, `refestados`, `refmeses`, `anio`, `concepto`, `total`, `iva`, `irff`, `fechaingreso`, `fechasubido`, `imagen`) VALUES
(10, 26, 1, 1, 1, 2019, 'tarjetaVisa', '2500.00', '25.00', '100.00', '2019-01-15', '2019-01-20', 'asduhas'),
(11, 26, 2, 1, 1, 2019, '', '2500.00', '25.00', '100.00', '2019-01-12', '2019-01-15', 'asduhas'),
(12, 26, 2, 1, 1, 2019, '', NULL, '25.00', '100.00', '2019-01-12', '2019-01-15', 'asduhas'),
(13, 26, 1, 1, 1, 2019, '', NULL, NULL, NULL, '2019-01-12', '2019-01-15', 'asduhas'),
(14, 27, 1, 2, 1, 2019, 'valor 1', '65000.00', '13650.00', '15600.00', '2019-02-25', '2019-02-25', 'asduhas'),
(15, 27, 2, 2, 1, 2019, 'valor 2', '4300.00', '903.00', '0.00', '2019-02-25', '2019-02-25', 'asduhas'),
(16, 27, 1, 2, 1, 2019, 'valor 3', '38000.00', '7980.00', '9120.00', '2019-02-25', '2019-02-25', 'asduhas'),
(19, 28, 1, 1, 1, 2019, '', NULL, NULL, NULL, '2019-02-26', '2019-02-26', 'asduhas');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dbusuarios`
--

CREATE TABLE IF NOT EXISTS `dbusuarios` (
`idusuario` int(11) NOT NULL,
  `usuario` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `refroles` int(11) NOT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `nombrecompleto` varchar(120) COLLATE utf8_unicode_ci NOT NULL,
  `activo` bit(1) DEFAULT b'0',
  `refclientes` int(11) DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `dbusuarios`
--

INSERT INTO `dbusuarios` (`idusuario`, `usuario`, `password`, `refroles`, `email`, `nombrecompleto`, `activo`, `refclientes`) VALUES
(1, 'msredhortero', 'marcos', 1, 'msredhotero@msn.com', 'Saupurein Marcos', b'1', 1),
(19, 'SAFAR Marcos Saupurein', 'marcos', 3, 'campochico@aif.org.ar', 'SAFAR Marcos Saupurein', b'1', 24),
(20, 'ropaldo daniela', '123456', 3, 'ropaldo@gmail.com', 'ropaldo daniela', b'1', 26),
(21, 'asdasd asdasd', 'asdasd', 3, 'aranjuez@aif.org.ar', 'asdasd asdasd', b'1', 27),
(22, 'asdasd asdasd', '123456', 3, 'aranzazu@aif.org.ar', 'asdasd asdasd', b'1', 28),
(23, 'Genaro', '123456', 1, 'msredhotero@gmail.com', 'Genaro Juan', b'1', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `images`
--

CREATE TABLE IF NOT EXISTS `images` (
`idfoto` int(11) NOT NULL,
  `refproyecto` int(11) NOT NULL,
  `refuser` int(11) NOT NULL,
  `imagen` varchar(149) DEFAULT NULL,
  `type` varchar(45) DEFAULT NULL,
  `principal` bit(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `predio_menu`
--

CREATE TABLE IF NOT EXISTS `predio_menu` (
  `idmenu` int(11) NOT NULL,
  `url` varchar(65) COLLATE utf8_spanish_ci NOT NULL,
  `icono` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `nombre` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `Orden` smallint(6) DEFAULT NULL,
  `hover` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `permiso` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `administracion` bit(1) DEFAULT NULL,
  `torneo` bit(1) DEFAULT NULL,
  `reportes` bit(1) DEFAULT NULL,
  `grupo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `predio_menu`
--

INSERT INTO `predio_menu` (`idmenu`, `url`, `icono`, `nombre`, `Orden`, `hover`, `permiso`, `administracion`, `torneo`, `reportes`, `grupo`) VALUES
(0, '../categorias/', 'list', 'Categorias', 6, NULL, 'Administrador', b'1', b'0', b'0', 0),
(11, '../documentos/', 'description', 'Mis Documentos', 6, NULL, 'Cliente', b'1', b'1', b'1', 0),
(13, '../index.php', 'dashboard', 'Dashboard', 1, NULL, 'Administrador, Cliente, Empleado', b'1', b'1', b'0', 0),
(14, '../perfil/', 'account_circle', 'Mi Perfil', 3, '', 'Cliente', b'1', b'1', b'1', 0),
(15, '../facturas/', 'list', 'Mis Facturas', 4, NULL, 'Cliente', b'1', b'1', b'1', 0),
(16, '../impuestos/', 'gavel', 'Mis Impuestos', 5, NULL, 'Cliente', b'1', b'1', b'1', 0),
(19, '../clientes/', 'people_outline', 'Clientes', 2, NULL, 'Administrador, Empleado', b'1', b'0', b'0', 0),
(20, '../usuarios/', 'account_circle', 'Usuarios', 12, NULL, 'Administrador, Empleado', b'1', b'0', b'0', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbcategorias`
--

CREATE TABLE IF NOT EXISTS `tbcategorias` (
`idcategoria` int(11) NOT NULL,
  `categoria` varchar(50) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `tbcategorias`
--

INSERT INTO `tbcategorias` (`idcategoria`, `categoria`) VALUES
(1, 'Impuestos'),
(2, 'Consultoria'),
(3, 'Retenciones');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbconfiguracion`
--

CREATE TABLE IF NOT EXISTS `tbconfiguracion` (
`idconfiguracion` int(11) NOT NULL,
  `razonsocial` varchar(80) COLLATE utf8_spanish_ci DEFAULT NULL,
  `empresa` varchar(80) COLLATE utf8_spanish_ci DEFAULT NULL,
  `sistema` varchar(80) COLLATE utf8_spanish_ci DEFAULT NULL,
  `direccion` varchar(80) COLLATE utf8_spanish_ci DEFAULT NULL,
  `telefono` varchar(20) COLLATE utf8_spanish_ci DEFAULT NULL,
  `email` varchar(120) COLLATE utf8_spanish_ci DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tbconfiguracion`
--

INSERT INTO `tbconfiguracion` (`idconfiguracion`, `razonsocial`, `empresa`, `sistema`, `direccion`, `telefono`, `email`) VALUES
(1, 'RIDERZ', 'RIDERZ', 'RIDERZ', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbestados`
--

CREATE TABLE IF NOT EXISTS `tbestados` (
`idestado` int(11) NOT NULL,
  `estado` varchar(80) COLLATE utf8_spanish_ci NOT NULL,
  `color` varchar(200) COLLATE utf8_spanish_ci DEFAULT NULL,
  `icono` varchar(80) COLLATE utf8_spanish_ci DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tbestados`
--

INSERT INTO `tbestados` (`idestado`, `estado`, `color`, `icono`) VALUES
(1, 'Iniciado', 'blue', NULL),
(2, 'Aceptado', 'green', NULL),
(3, 'Rechazado', 'red', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbmeses`
--

CREATE TABLE IF NOT EXISTS `tbmeses` (
`idmes` int(11) NOT NULL,
  `meses` varchar(80) COLLATE utf8_spanish_ci NOT NULL,
  `desde` int(11) NOT NULL,
  `hasta` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tbmeses`
--

INSERT INTO `tbmeses` (`idmes`, `meses`, `desde`, `hasta`) VALUES
(1, 'Enero - Marzo', 1, 3),
(2, 'Abril - Junio', 4, 6),
(3, 'Julio - Septiembre', 7, 9),
(4, 'Octubre - Noviembre', 10, 12);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbroles`
--

CREATE TABLE IF NOT EXISTS `tbroles` (
`idrol` int(11) NOT NULL,
  `descripcion` varchar(45) NOT NULL,
  `activo` bit(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tbroles`
--

INSERT INTO `tbroles` (`idrol`, `descripcion`, `activo`) VALUES
(1, 'Administrador', b'1'),
(2, 'Empleado', b'1'),
(3, 'Cliente', b'1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbtipodocumentos`
--

CREATE TABLE IF NOT EXISTS `tbtipodocumentos` (
`idtipodocumento` int(11) NOT NULL,
  `tipodocumento` varchar(60) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tbtipodocumentos`
--

INSERT INTO `tbtipodocumentos` (`idtipodocumento`, `tipodocumento`) VALUES
(1, 'DNI'),
(2, 'NIE');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbtipofacturas`
--

CREATE TABLE IF NOT EXISTS `tbtipofacturas` (
`idtipofactura` int(11) NOT NULL,
  `tipofactura` varchar(60) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tbtipofacturas`
--

INSERT INTO `tbtipofacturas` (`idtipofactura`, `tipofactura`) VALUES
(1, 'Ingresos'),
(2, 'Gastos');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `dbactivacionusuarios`
--
ALTER TABLE `dbactivacionusuarios`
 ADD PRIMARY KEY (`idactivacionusuario`);

--
-- Indices de la tabla `dbarchivos`
--
ALTER TABLE `dbarchivos`
 ADD PRIMARY KEY (`idarchivo`);

--
-- Indices de la tabla `dbclientes`
--
ALTER TABLE `dbclientes`
 ADD PRIMARY KEY (`idcliente`), ADD KEY `fk_c_td_idx` (`reftipodocumentos`);

--
-- Indices de la tabla `dbfacturas`
--
ALTER TABLE `dbfacturas`
 ADD PRIMARY KEY (`idfactura`), ADD KEY `fk_f_e_idx` (`refestados`), ADD KEY `fk_f_tf_idx` (`reftipofacturas`), ADD KEY `fk_f_m_idx` (`refmeses`);

--
-- Indices de la tabla `dbusuarios`
--
ALTER TABLE `dbusuarios`
 ADD PRIMARY KEY (`idusuario`), ADD KEY `fk_dbusuarios_tbroles1_idx` (`refroles`);

--
-- Indices de la tabla `images`
--
ALTER TABLE `images`
 ADD PRIMARY KEY (`idfoto`);

--
-- Indices de la tabla `predio_menu`
--
ALTER TABLE `predio_menu`
 ADD PRIMARY KEY (`idmenu`);

--
-- Indices de la tabla `tbcategorias`
--
ALTER TABLE `tbcategorias`
 ADD PRIMARY KEY (`idcategoria`);

--
-- Indices de la tabla `tbconfiguracion`
--
ALTER TABLE `tbconfiguracion`
 ADD PRIMARY KEY (`idconfiguracion`);

--
-- Indices de la tabla `tbestados`
--
ALTER TABLE `tbestados`
 ADD PRIMARY KEY (`idestado`);

--
-- Indices de la tabla `tbmeses`
--
ALTER TABLE `tbmeses`
 ADD PRIMARY KEY (`idmes`);

--
-- Indices de la tabla `tbroles`
--
ALTER TABLE `tbroles`
 ADD PRIMARY KEY (`idrol`);

--
-- Indices de la tabla `tbtipodocumentos`
--
ALTER TABLE `tbtipodocumentos`
 ADD PRIMARY KEY (`idtipodocumento`);

--
-- Indices de la tabla `tbtipofacturas`
--
ALTER TABLE `tbtipofacturas`
 ADD PRIMARY KEY (`idtipofactura`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `dbactivacionusuarios`
--
ALTER TABLE `dbactivacionusuarios`
MODIFY `idactivacionusuario` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `dbarchivos`
--
ALTER TABLE `dbarchivos`
MODIFY `idarchivo` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT de la tabla `dbclientes`
--
ALTER TABLE `dbclientes`
MODIFY `idcliente` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT de la tabla `dbfacturas`
--
ALTER TABLE `dbfacturas`
MODIFY `idfactura` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT de la tabla `dbusuarios`
--
ALTER TABLE `dbusuarios`
MODIFY `idusuario` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT de la tabla `images`
--
ALTER TABLE `images`
MODIFY `idfoto` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tbcategorias`
--
ALTER TABLE `tbcategorias`
MODIFY `idcategoria` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `tbconfiguracion`
--
ALTER TABLE `tbconfiguracion`
MODIFY `idconfiguracion` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `tbestados`
--
ALTER TABLE `tbestados`
MODIFY `idestado` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `tbmeses`
--
ALTER TABLE `tbmeses`
MODIFY `idmes` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `tbroles`
--
ALTER TABLE `tbroles`
MODIFY `idrol` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `tbtipodocumentos`
--
ALTER TABLE `tbtipodocumentos`
MODIFY `idtipodocumento` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `tbtipofacturas`
--
ALTER TABLE `tbtipofacturas`
MODIFY `idtipofactura` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `dbclientes`
--
ALTER TABLE `dbclientes`
ADD CONSTRAINT `fk_c_td` FOREIGN KEY (`reftipodocumentos`) REFERENCES `tbtipodocumentos` (`idtipodocumento`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `dbfacturas`
--
ALTER TABLE `dbfacturas`
ADD CONSTRAINT `fk_f_e` FOREIGN KEY (`refestados`) REFERENCES `tbestados` (`idestado`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_f_m` FOREIGN KEY (`refmeses`) REFERENCES `tbmeses` (`idmes`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_f_tf` FOREIGN KEY (`reftipofacturas`) REFERENCES `tbtipofacturas` (`idtipofactura`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
