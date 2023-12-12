-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 12-12-2023 a las 02:11:47
-- Versión del servidor: 8.0.31
-- Versión de PHP: 8.1.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bdmicesar`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

DROP TABLE IF EXISTS `categoria`;
CREATE TABLE IF NOT EXISTS `categoria` (
  `idCategoria` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `estado` char(1) COLLATE utf8mb4_general_ci NOT NULL DEFAULT '1',
  PRIMARY KEY (`idCategoria`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`idCategoria`, `nombre`, `estado`) VALUES
(1, 'Bebidas', '1'),
(2, 'Postres', '1'),
(3, 'Entradas', '1'),
(4, 'Segundos', '1'),
(5, 'Piqueos', '1'),
(6, 'ad', '1'),
(7, 'asdf adf', '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

DROP TABLE IF EXISTS `cliente`;
CREATE TABLE IF NOT EXISTS `cliente` (
  `idCliente` int NOT NULL AUTO_INCREMENT,
  `nombres` varchar(80) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `telefono` varchar(9) COLLATE utf8mb4_general_ci NOT NULL,
  `direccion` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `estado` char(1) COLLATE utf8mb4_general_ci NOT NULL DEFAULT '1',
  `documento` varchar(8) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`idCliente`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`idCliente`, `nombres`, `email`, `telefono`, `direccion`, `estado`, `documento`) VALUES
(1, 'Daniel', 'elar@elar.com', '519805026', 'afunn', '1', '65798789'),
(2, 'Daniel', 'elar@elar.com', '519805026', 'afunn', '1', '85219752'),
(3, 'Daniel', 'elar@elar.com', '519805026', 'afunn', '1', '96387542'),
(4, 'Daniel', 'elar@elar.com', '519805026', 'afunn', '1', '89764513'),
(5, 'Daniel', 'elar@elar.com', '519805026', 'afunn', '1', '65846555'),
(6, 'Daniel', 'elar@elar.com', '519805026', 'afunn', '1', '12345678');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `delivery`
--

DROP TABLE IF EXISTS `delivery`;
CREATE TABLE IF NOT EXISTS `delivery` (
  `idDelivery` int NOT NULL AUTO_INCREMENT,
  `idpedido` int NOT NULL,
  `ciudad` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `direccion` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `costo` decimal(10,2) NOT NULL,
  `fecha` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `estado` char(1) COLLATE utf8mb4_general_ci NOT NULL DEFAULT '0',
  PRIMARY KEY (`idDelivery`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `delivery`
--

INSERT INTO `delivery` (`idDelivery`, `idpedido`, `ciudad`, `direccion`, `costo`, `fecha`, `estado`) VALUES
(3, 15, NULL, 'Castilla', '20.00', '2023-12-10 21:27:39', '0');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle`
--

DROP TABLE IF EXISTS `detalle`;
CREATE TABLE IF NOT EXISTS `detalle` (
  `idpedido` int NOT NULL,
  `iditem` int NOT NULL,
  `costo` decimal(10,2) NOT NULL,
  `cantidad` int NOT NULL,
  `subtotal` decimal(10,2) GENERATED ALWAYS AS ((`costo` * `cantidad`)) VIRTUAL NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `detalle`
--

INSERT INTO `detalle` (`idpedido`, `iditem`, `costo`, `cantidad`) VALUES
(14, 1, '15.00', 2),
(14, 2, '20.00', 1),
(15, 2, '20.00', 1),
(15, 1, '15.00', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `item`
--

DROP TABLE IF EXISTS `item`;
CREATE TABLE IF NOT EXISTS `item` (
  `idItem` int NOT NULL AUTO_INCREMENT,
  `idcategoria` int NOT NULL,
  `tipo` enum('Producto','Plato') COLLATE utf8mb4_general_ci NOT NULL,
  `precio_c` decimal(10,2) NOT NULL,
  `precio_v` decimal(10,2) NOT NULL,
  `stock` int NOT NULL,
  `stock_min` int NOT NULL,
  `foto` varchar(200) COLLATE utf8mb4_general_ci NOT NULL,
  `descripcion` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `f_registro` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `estado` char(1) COLLATE utf8mb4_general_ci NOT NULL DEFAULT '1',
  PRIMARY KEY (`idItem`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `item`
--

INSERT INTO `item` (`idItem`, `idcategoria`, `tipo`, `precio_c`, `precio_v`, `stock`, `stock_min`, `foto`, `descripcion`, `f_registro`, `estado`) VALUES
(1, 1, 'Producto', '10.00', '15.00', 100, 0, '', 'cusqueña', '2023-12-02 16:40:54', '1'),
(2, 2, 'Producto', '10.00', '20.00', 50, 0, '', '3 leches', '2023-12-02 16:41:31', '1'),
(3, 1, 'Producto', '1.00', '1.00', 1, 1, '', '1', '2023-12-11 20:39:15', '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pago`
--

DROP TABLE IF EXISTS `pago`;
CREATE TABLE IF NOT EXISTS `pago` (
  `idPago` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `estado` char(1) COLLATE utf8mb4_general_ci NOT NULL DEFAULT '1',
  PRIMARY KEY (`idPago`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pago`
--

INSERT INTO `pago` (`idPago`, `nombre`, `estado`) VALUES
(1, 'Efectivo', '1'),
(2, 'Transferencia', '1'),
(3, 'Yape', '1'),
(4, 'Plin', '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedido`
--

DROP TABLE IF EXISTS `pedido`;
CREATE TABLE IF NOT EXISTS `pedido` (
  `idPedido` int NOT NULL AUTO_INCREMENT,
  `idcliente` int NOT NULL,
  `idusuario` int NOT NULL,
  `tipo` enum('delivery','reserva','local') COLLATE utf8mb4_general_ci NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `fecha` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `estado` char(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '1',
  PRIMARY KEY (`idPedido`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pedido`
--

INSERT INTO `pedido` (`idPedido`, `idcliente`, `idusuario`, `tipo`, `total`, `fecha`, `estado`) VALUES
(14, 6, 1, 'local', '50.00', '2023-12-10 15:31:40', '1'),
(15, 6, 1, 'delivery', '35.00', '2023-12-10 21:27:39', '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permisos`
--

DROP TABLE IF EXISTS `permisos`;
CREATE TABLE IF NOT EXISTS `permisos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `idvista` int NOT NULL,
  `idtipousuario` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `permisos`
--

INSERT INTO `permisos` (`id`, `idvista`, `idtipousuario`) VALUES
(1, 1, 1),
(2, 2, 1),
(3, 3, 1),
(9, 4, 1),
(10, 10, 1),
(6, 6, 1),
(7, 7, 1),
(8, 11, 1),
(11, 8, 1),
(13, 5, 1),
(14, 12, 1),
(15, 13, 1),
(16, 14, 1),
(17, 15, 1),
(18, 1, 2),
(19, 2, 2),
(20, 3, 2),
(21, 12, 2),
(22, 13, 2),
(23, 14, 2),
(24, 5, 2),
(25, 8, 2),
(26, 15, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reserva`
--

DROP TABLE IF EXISTS `reserva`;
CREATE TABLE IF NOT EXISTS `reserva` (
  `idReserva` int NOT NULL AUTO_INCREMENT,
  `idpedido` int NOT NULL,
  `costo` decimal(10,2) NOT NULL,
  `fecha` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `estado` char(1) COLLATE utf8mb4_general_ci NOT NULL DEFAULT '0',
  PRIMARY KEY (`idReserva`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipousuario`
--

DROP TABLE IF EXISTS `tipousuario`;
CREATE TABLE IF NOT EXISTS `tipousuario` (
  `idTipo` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `estado` char(1) COLLATE utf8mb4_general_ci NOT NULL DEFAULT '1',
  PRIMARY KEY (`idTipo`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tipousuario`
--

INSERT INTO `tipousuario` (`idTipo`, `nombre`, `estado`) VALUES
(1, 'Admin', '1'),
(2, 'Empleado', '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

DROP TABLE IF EXISTS `usuario`;
CREATE TABLE IF NOT EXISTS `usuario` (
  `idUsuario` int NOT NULL AUTO_INCREMENT,
  `idtipo` int NOT NULL,
  `nombres` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(200) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `telefono` varchar(15) COLLATE utf8mb4_general_ci NOT NULL,
  `direccion` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `estado` char(1) COLLATE utf8mb4_general_ci NOT NULL DEFAULT '1',
  PRIMARY KEY (`idUsuario`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`idUsuario`, `idtipo`, `nombres`, `email`, `password`, `telefono`, `direccion`, `estado`) VALUES
(1, 1, 'Elar', 'elar@elar.com', '$2y$10$v6ANqw2ZUyUrv7SUKMuVluReGRGM9Ph4pMLjG.Uu3sLBnC8C/OtHK', '987654321', 'Piura', '1'),
(2, 1, 'Danieladfasdf', 'daniel@daniel.com', '$2y$10$5hGbotW.kl.HZyhcUqc4guVThQLc2/93xceVocjKU7AKuQLaCBt0C', '986574123', 'Ayacucho', '1'),
(3, 2, 'Empleado', 'empleado@gmail.com', '$2y$10$rh0dOvlk1YI45s7sEM4CoOsneSN/P7eTZV2VTQgsPkv8F3CTIxSSe', '51980502603', 'Piura', '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `venta`
--

DROP TABLE IF EXISTS `venta`;
CREATE TABLE IF NOT EXISTS `venta` (
  `idventa` int NOT NULL AUTO_INCREMENT,
  `idpedido` int NOT NULL,
  `idpago` int NOT NULL,
  `comprobante` enum('B','F') COLLATE utf8mb4_general_ci NOT NULL,
  `descripcion` varchar(500) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `subtotal` decimal(10,0) NOT NULL,
  `igv` decimal(10,0) NOT NULL,
  `total` decimal(10,0) NOT NULL,
  `fecha` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `estado` char(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '1',
  `serie` enum('B001','F001') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `correlativo` int NOT NULL,
  PRIMARY KEY (`idventa`)
) ENGINE=InnoDB AUTO_INCREMENT=1006 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `venta`
--

INSERT INTO `venta` (`idventa`, `idpedido`, `idpago`, `comprobante`, `descripcion`, `subtotal`, `igv`, `total`, `fecha`, `estado`, `serie`, `correlativo`) VALUES
(1004, 14, 1, 'B', 'a', '41', '9', '50', '2023-12-10 15:31:40', '1', 'B001', 1),
(1005, 15, 1, 'B', 'a', '29', '6', '35', '2023-12-10 21:27:39', '1', 'B001', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vistas`
--

DROP TABLE IF EXISTS `vistas`;
CREATE TABLE IF NOT EXISTS `vistas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `vistas`
--

INSERT INTO `vistas` (`id`, `nombre`) VALUES
(1, 'main'),
(2, 'logout'),
(3, 'cliente'),
(4, 'usuario'),
(5, 'venta'),
(6, 'permiso'),
(7, 'vista'),
(8, 'delivery'),
(11, 'tipousuario'),
(10, 'reserva'),
(12, 'pedido'),
(13, 'item'),
(14, 'categoria'),
(15, 'pago');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
