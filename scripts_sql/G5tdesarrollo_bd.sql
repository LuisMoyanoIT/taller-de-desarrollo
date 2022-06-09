-- phpMyAdmin SQL Dump
-- version 4.6.6deb4+deb9u2
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 20-01-2021 a las 09:41:32
-- Versión del servidor: 5.7.28
-- Versión de PHP: 7.0.33-0+deb9u10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `G5tdesarrollo_bd`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `accidenteareaseguridad`
--

CREATE TABLE `accidenteareaseguridad` (
  `ID_Accidente` int(11) NOT NULL,
  `Nombre_Completo` varchar(400) NOT NULL,
  `Rut_Trabajador` varchar(45) NOT NULL,
  `Fecha_Accidente` date NOT NULL,
  `Hora_Accidente` time NOT NULL,
  `Descripcion_Accidente` varchar(2000) NOT NULL,
  `Derivacion_trabajador` varchar(45) DEFAULT NULL,
  `Nombre_Obra` varchar(45) DEFAULT NULL,
  `Nombre_ImagenAccidente` varchar(45) DEFAULT NULL,
  `GravedadEventoSeguridad_ID_GravedadEventoSeguridad` int(11) NOT NULL,
  `TipoEventoSeguridad_ID_TipoEventoSeguridad` int(11) NOT NULL,
  `SancionEventoSeguridad_ID_SancionEventoSeguridad` int(11) DEFAULT NULL,
  `ObraEtapaObra_ID_ObraEtapaObra` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `antecedente`
--

CREATE TABLE `antecedente` (
  `ID_Antecedente` int(11) NOT NULL,
  `Tipo_Antecedente` varchar(45) DEFAULT NULL,
  `Descripcion_Antecedente` varchar(250) DEFAULT NULL,
  `Documento_Antecedente` varchar(45) DEFAULT NULL,
  `ID_OfertaLicit` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `anuncio`
--

CREATE TABLE `anuncio` (
  `ID_Anuncio` int(11) NOT NULL,
  `Nombre_Anuncio` varchar(45) DEFAULT NULL,
  `Tipo_Anuncio` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asigna_material`
--

CREATE TABLE `asigna_material` (
  `ID_Bodega` int(5) NOT NULL,
  `Stock_total` int(11) DEFAULT NULL,
  `ID_Asigna_Material` int(11) NOT NULL,
  `ID_Estado_reasigna` int(11) NOT NULL,
  `ID_Material` int(11) NOT NULL,
  `Fecha` datetime DEFAULT NULL,
  `CantidadMinima` int(11) DEFAULT NULL,
  `CantidadMaxima` int(11) DEFAULT NULL,
  `HistorialMaterial` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `avance/etapaobra`
--

CREATE TABLE `avance/etapaobra` (
  `ID_Avance/EtapaObra` int(11) NOT NULL,
  `AvanceObra_ID_AvanceObra` int(11) NOT NULL,
  `Obra/EtapaObra_ID_Obra/EtapaObra` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `avanceobra`
--

CREATE TABLE `avanceobra` (
  `ID_AvanceObra` int(11) NOT NULL,
  `Nombre_AvanceObra` varchar(45) DEFAULT NULL,
  `Descripcion_AvanceObra` varchar(250) DEFAULT NULL,
  `FechaRegistro_AvanceObra` timestamp NULL DEFAULT NULL,
  `Porcentaje_AvanceObra` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `banco`
--

CREATE TABLE `banco` (
  `ID_Banco` int(11) NOT NULL,
  `Nombre_Banco` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bodega`
--

CREATE TABLE `bodega` (
  `ID_Bodega` int(5) NOT NULL,
  `Nombre_Bodega` varchar(100) DEFAULT NULL,
  `ID_Tipobodega` int(5) NOT NULL,
  `EstadoBodega` tinyint(4) DEFAULT NULL,
  `ID_Obra` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bodega_y_proveedor`
--

CREATE TABLE `bodega_y_proveedor` (
  `ID_Bodega` int(5) NOT NULL,
  `ID_Proveedor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `boletasyfacturas`
--

CREATE TABLE `boletasyfacturas` (
  `ID_Boletasyfacturas` int(11) NOT NULL,
  `Imagen_Boletasyfacturas` varchar(100) DEFAULT NULL,
  `Rut_Trabajador` char(20) NOT NULL,
  `Descripcion` varchar(250) DEFAULT NULL,
  `Estado` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `calendario`
--

CREATE TABLE `calendario` (
  `ID_Calendario` int(11) NOT NULL,
  `Publicacion_Oferta` date DEFAULT NULL,
  `CierreDeOfertas` date DEFAULT NULL,
  `InicioPregunta` date DEFAULT NULL,
  `FinPregunta` date DEFAULT NULL,
  `RespuestaPregunta` date DEFAULT NULL,
  `Adjudicacion` date DEFAULT NULL,
  `ID_OfertaLicit` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='		';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria_material`
--

CREATE TABLE `categoria_material` (
  `ID_Categoria_Material` int(11) NOT NULL,
  `Nombre_Categoria_Material` varchar(100) NOT NULL,
  `ID_Categoria_Material_Padre` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ciudad`
--

CREATE TABLE `ciudad` (
  `ID_Ciudad` int(11) NOT NULL,
  `Nombre_Ciudad` varchar(45) DEFAULT NULL,
  `ID_Region` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `ciudad`
--

INSERT INTO `ciudad` (`ID_Ciudad`, `Nombre_Ciudad`, `ID_Region`) VALUES
(1, 'Gran Concenpcion', 1),
(2, 'Los Angeles', 1),
(3, 'Arauco', 1),
(4, 'Cañete', 1),
(5, 'Curanilahue', 1),
(6, 'Mulchen', 1),
(7, 'Calama', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `Rut_Cliente` char(12) NOT NULL,
  `Nombre_Cliente` varchar(45) DEFAULT NULL,
  `Apellido_Cliente` varchar(45) DEFAULT NULL,
  `Email_Cliente` varchar(45) DEFAULT NULL,
  `Contraseña_Cliente` varchar(45) DEFAULT NULL,
  `Telefono_Cliente` varchar(45) DEFAULT NULL,
  `Financiemiento_Cliente` varchar(45) DEFAULT NULL,
  `GrupoFamiliar_Cliente` int(11) DEFAULT NULL,
  `Detalles_Cliente` varchar(250) DEFAULT NULL,
  `ID_Banco` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contrato`
--

CREATE TABLE `contrato` (
  `ID_Contrato` bigint(20) NOT NULL,
  `Nombre_Contrato` varchar(100) DEFAULT NULL,
  `FechaInicio_Contrato` date DEFAULT NULL,
  `FechaTermino_Contrato` date DEFAULT NULL,
  `Descripcion_Contrato` varchar(250) DEFAULT NULL,
  `RutaImagen_Contrato` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `controlareaseguridad`
--

CREATE TABLE `controlareaseguridad` (
  `ID_ControlAreaSeguridad` int(11) NOT NULL,
  `NombreControl` varchar(55) NOT NULL,
  `Fecha_PlanificadaControl` date NOT NULL,
  `Fecha_Realizacion` date DEFAULT NULL,
  `Objetivos_Control` varchar(800) NOT NULL,
  `Protocolos_Control` varchar(800) NOT NULL,
  `Resultados_Control` varchar(1000) DEFAULT NULL,
  `Nombre_Obra` varchar(45) NOT NULL,
  `ObraEtapaObra_ID_ObraEtapaObra` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `control_de_calidad_maestro`
--

CREATE TABLE `control_de_calidad_maestro` (
  `ID_ControlDeCalidad` int(11) NOT NULL,
  `Nombre_ControlDeCalidadMaestro` varchar(45) NOT NULL,
  `ID_TipoDeControl` int(11) NOT NULL,
  `PlanDeCalidad_ID_PlanDeCalidad` int(11) DEFAULT NULL,
  `EtapaProyecto_ID_Etapa` int(11) NOT NULL,
  `Version_Control` varchar(45) NOT NULL DEFAULT '1.0',
  `FechaAprobacion_Control` date DEFAULT NULL,
  `Descripcion_ControlM` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `control_de_calidad_obras`
--

CREATE TABLE `control_de_calidad_obras` (
  `ID_ControlDeCalidadObras` int(11) NOT NULL,
  `Nombre_CTCObras` varchar(45) NOT NULL,
  `FechaInicioReal_CTCObras` date DEFAULT NULL,
  `FechaFinalReal_CTCObras` date DEFAULT NULL,
  `Observaciones` varchar(500) DEFAULT NULL,
  `ID_ControlDeCalidad` int(11) NOT NULL,
  `Localizacion_CTC` varchar(500) DEFAULT NULL,
  `FechaInicioEst_CTCObras` date DEFAULT NULL,
  `FechaFinalEst_CTCObras` date DEFAULT NULL,
  `ID_Obra/EtapaObra` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `direccion`
--

CREATE TABLE `direccion` (
  `ID_Direccion` int(11) NOT NULL,
  `Nombre_Direccion` varchar(45) DEFAULT NULL,
  `Numero_Direccion` int(11) DEFAULT NULL,
  `ID_Ciudad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `direccion`
--

INSERT INTO `direccion` (`ID_Direccion`, `Nombre_Direccion`, `Numero_Direccion`, `ID_Ciudad`) VALUES
(1, 'Barros Arana 1080, Concepción, Bío Bío', 1080, 1),
(2, 'Tegualda 860, Concepción, Bío Bío', 860, 1),
(3, 'Av. Balmaceda 3242, Calama, Antofagasta', 3242, 7),
(4, 'Colo colo 577, Concepción, Bío Bío', 577, 1),
(5, 'Av Colon 2214, Calama Antofagasta', 2214, 7),
(6, 'Lautaro 3652, Calama Antofagasta', 3652, 7),
(7, 'Freire 403, Concepción, Bío Bío', 403, 1),
(8, 'Freire 273, Concepción, Bío Bío', 273, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `documento`
--

CREATE TABLE `documento` (
  `ID_Documento` bigint(20) NOT NULL,
  `Formato_Documento` varchar(45) DEFAULT NULL,
  `Nombre_Documento` varchar(45) DEFAULT NULL,
  `Ruta_Documento` varchar(45) DEFAULT NULL,
  `Hora_Documento` time DEFAULT NULL,
  `Fecha_Documento` date DEFAULT NULL,
  `Rut_Trabajador` char(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `documentoslicitacion`
--

CREATE TABLE `documentoslicitacion` (
  `idDocumentosLicitacion` int(11) NOT NULL,
  `Documento_Criterio` varchar(200) DEFAULT NULL,
  `Documento_Requisito` varchar(200) DEFAULT NULL,
  `Documento_Requerimiento` varchar(45) DEFAULT NULL,
  `Documento_Garantia` varchar(45) DEFAULT NULL,
  `ID_OfertaLicit` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `encargado`
--

CREATE TABLE `encargado` (
  `Rut_Encargado` char(45) NOT NULL,
  `Nombre_Encargado` varchar(45) DEFAULT NULL,
  `Apellido_Encargado` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `especialidad`
--

CREATE TABLE `especialidad` (
  `ID_Especialidad` bigint(20) NOT NULL,
  `Nombre_Especialidad` varchar(45) DEFAULT NULL,
  `Estado_Especialidad` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado`
--

CREATE TABLE `estado` (
  `ID_Estado` bigint(20) NOT NULL,
  `Nombre_Estado` varchar(45) DEFAULT NULL,
  `Descripcion_Estado` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `estado`
--

INSERT INTO `estado` (`ID_Estado`, `Nombre_Estado`, `Descripcion_Estado`) VALUES
(1, 'Vigente', 'Se mantiene trabajando ');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estadomaterial`
--

CREATE TABLE `estadomaterial` (
  `ID_EstadoMaterial` int(11) NOT NULL,
  `Nombre_EstadoMaterial` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estadopropiedadio`
--

CREATE TABLE `estadopropiedadio` (
  `ID_EstadoPropiedadIO` int(11) NOT NULL,
  `EstadoPropiedadIO` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estadosolicitud`
--

CREATE TABLE `estadosolicitud` (
  `idEstadoSolicitud` int(11) NOT NULL,
  `NombreEstadoSolicitud` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estadostablasobras`
--

CREATE TABLE `estadostablasobras` (
  `idEstadosTablasObras` int(11) NOT NULL,
  `descripcion_estado` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado_reasigna`
--

CREATE TABLE `estado_reasigna` (
  `ID_Estado_reasigna` int(11) NOT NULL,
  `Nombre_Estado_reasigna` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `etapalicitacion`
--

CREATE TABLE `etapalicitacion` (
  `idetapa` int(11) NOT NULL,
  `Nombre_Etapa` varchar(25) NOT NULL,
  `Inicio_Etapa` date DEFAULT NULL,
  `Fin_Etapa` date DEFAULT NULL,
  `Comentario` varchar(200) DEFAULT NULL,
  `Actual` varchar(5) NOT NULL,
  `ID_OfertaLicit` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `etapaproyecto`
--

CREATE TABLE `etapaproyecto` (
  `ID_Etapa` int(11) NOT NULL,
  `Nombre_Etapa` varchar(200) DEFAULT NULL,
  `Descripcion_Etapa` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=REDUNDANT;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gravedadeventoseguridad`
--

CREATE TABLE `gravedadeventoseguridad` (
  `ID_GravedadEventoSeguridad` int(11) NOT NULL,
  `Nombre_GravedadEvento` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `imagenobra`
--

CREATE TABLE `imagenobra` (
  `idImagenObra` int(11) NOT NULL,
  `NombreImagen` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `incidenteareaseguridad`
--

CREATE TABLE `incidenteareaseguridad` (
  `ID_IncidenteAreaSeguridad` int(11) NOT NULL,
  `Nombre_Completo` varchar(400) NOT NULL,
  `Rut_Trabajador` varchar(45) NOT NULL,
  `Fecha_Incidente` date NOT NULL,
  `Hora_Accidente` time NOT NULL,
  `Descripcion_Incidente` varchar(800) NOT NULL,
  `Nombre_ImagenIncidente` varchar(45) DEFAULT NULL,
  `SancionEventoSeguridad_ID_SancionEventoSeguridad` int(11) DEFAULT NULL,
  `TipoEventoSeguridad_ID_TipoEventoSeguridad` int(11) NOT NULL,
  `GravedadEventoSeguridad_ID_GravedadEventoSeguridad` int(11) NOT NULL,
  `ControlAreaSeguridad_ID_ControlAreaSeguridad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `MaqAsigna`
--

CREATE TABLE `MaqAsigna` (
  `ID_MaqAsigna` int(11) NOT NULL,
  `FechaProgrInicio_MaqAsigna` date NOT NULL,
  `FechaProgrFin_MaqAsigna` date NOT NULL,
  `FechaRealInicio_MaqAsigna` date DEFAULT NULL,
  `FechaRealFin_MaqAsigna` date DEFAULT NULL,
  `HorasTrabajadas_MaqAsigna` int(11) NOT NULL,
  `FechaInicioTraslado_MaqAsigna` date DEFAULT NULL,
  `FechaFinTraslado_MaqAsigna` date DEFAULT NULL,
  `ID_Obra` bigint(20) NOT NULL,
  `ID_MaqTipoTraslado` int(11) NOT NULL,
  `ID_MaqMaquina` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `MaqAsigna`
--

INSERT INTO `MaqAsigna` (`ID_MaqAsigna`, `FechaProgrInicio_MaqAsigna`, `FechaProgrFin_MaqAsigna`, `FechaRealInicio_MaqAsigna`, `FechaRealFin_MaqAsigna`, `HorasTrabajadas_MaqAsigna`, `FechaInicioTraslado_MaqAsigna`, `FechaFinTraslado_MaqAsigna`, `ID_Obra`, `ID_MaqTipoTraslado`, `ID_MaqMaquina`) VALUES
(2, '2020-01-26', '2020-03-31', '2020-01-27', '2020-04-01', 95, NULL, NULL, 1, 4, 96),
(4, '2021-01-03', '2021-01-29', '2021-01-03', '2021-01-29', 108, NULL, NULL, 2, 4, 98),
(5, '2020-12-26', '2021-01-30', '2020-12-26', '2021-01-30', 120, NULL, NULL, 2, 4, 99),
(7, '2020-04-21', '2020-05-25', '2020-04-21', '2020-06-03', 28, NULL, NULL, 1, 4, 106),
(8, '2021-01-02', '2021-01-22', '2021-01-02', '2021-01-22', 30, NULL, NULL, 3, 4, 101),
(9, '2019-01-21', '2019-01-31', '2019-01-21', '2019-01-31', 69, NULL, NULL, 1, 4, 103),
(10, '2021-01-20', '2021-02-20', '2021-01-21', '2021-02-20', 30, NULL, NULL, 3, 4, 93),
(11, '2021-01-21', '2021-01-31', '2021-01-21', '2021-01-31', 30, NULL, NULL, 1, 4, 95),
(12, '2020-12-20', '2021-01-15', '2020-12-20', '2021-01-15', 95, NULL, NULL, 1, 4, 102),
(13, '2021-01-15', '2021-01-31', '2021-01-15', '2021-01-31', 130, NULL, NULL, 3, 4, 104),
(16, '2021-01-21', '2021-02-02', '2021-01-21', '2021-02-02', 60, NULL, NULL, 3, 4, 112),
(17, '2021-01-22', '2021-01-31', '2021-01-22', '2021-01-31', 70, NULL, NULL, 1, 4, 105),
(18, '2021-01-20', '2021-02-03', '2021-01-20', '2021-02-03', 100, NULL, NULL, 3, 4, 116);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `MaqMantencion`
--

CREATE TABLE `MaqMantencion` (
  `ID_MaqMantencion` int(11) NOT NULL,
  `Descripcion_MaqMantencion` varchar(45) NOT NULL,
  `FechaProgramada_MaqMantencion` date NOT NULL,
  `FechaInicio_MaqMantencion` date DEFAULT NULL,
  `FechaFin_MaqMantencion` date DEFAULT NULL,
  `TipoMantencion_MaqMantencion` enum('Preventiva','Correctiva') NOT NULL,
  `ID_MaqMaquina` int(11) NOT NULL,
  `ID_MaqTipoEstadoMantencion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `MaqMantencion`
--

INSERT INTO `MaqMantencion` (`ID_MaqMantencion`, `Descripcion_MaqMantencion`, `FechaProgramada_MaqMantencion`, `FechaInicio_MaqMantencion`, `FechaFin_MaqMantencion`, `TipoMantencion_MaqMantencion`, `ID_MaqMaquina`, `ID_MaqTipoEstadoMantencion`) VALUES
(1, 'Rutina', '2021-01-22', '2021-01-22', '2021-01-28', 'Preventiva', 94, 2),
(2, 'Revisión ruedas', '2021-01-21', '2021-01-21', '2021-01-23', 'Preventiva', 97, 1),
(3, 'Horas cumplidas', '2021-01-28', '2021-01-28', '2021-01-29', 'Correctiva', 113, 1),
(4, 'Cambio de aceite', '2021-01-25', '2021-01-25', NULL, 'Correctiva', 100, 1),
(5, 'Problemas con el motor', '2021-01-21', '2021-01-21', NULL, 'Correctiva', 124, 2),
(6, 'Ruido en el motor', '2021-01-28', '2021-01-28', NULL, 'Preventiva', 129, 3),
(7, 'Rutina', '2021-01-21', '2021-01-21', NULL, 'Preventiva', 125, 1),
(8, 'Rutina', '2021-01-29', '2021-01-29', NULL, 'Preventiva', 104, 2),
(9, 'Rutina', '2021-01-22', '2021-01-22', NULL, 'Preventiva', 106, 1),
(11, 'Rutina', '2021-01-29', '2021-01-29', NULL, 'Preventiva', 109, 3),
(12, 'Revisión motor', '2021-02-09', '2021-02-09', NULL, 'Correctiva', 128, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `MaqMaquina`
--

CREATE TABLE `MaqMaquina` (
  `ID_MaqMaquina` int(11) NOT NULL,
  `Nombre_MaqMaquina` varchar(45) NOT NULL,
  `Descripcion_MaqMaquina` varchar(45) NOT NULL,
  `HorasTotales_MaqMaquina` int(11) NOT NULL,
  `ID_MaqTipoMaquina` int(11) NOT NULL,
  `ID_MaqTipoEstadoMaquina` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `MaqMaquina`
--

INSERT INTO `MaqMaquina` (`ID_MaqMaquina`, `Nombre_MaqMaquina`, `Descripcion_MaqMaquina`, `HorasTotales_MaqMaquina`, `ID_MaqTipoMaquina`, `ID_MaqTipoEstadoMaquina`) VALUES
(93, 'Motoniveladora matrixo locopeyo', 'Modelo de motor Cat C7 ACERT™', 0, 7, 2),
(94, 'Pala de Cadenas 953K', 'Modelo de motor Cat C7.1', 10, 1, 4),
(95, 'Pala de Cadenas 963K', 'Modelo de motor Cat C7.1', 0, 1, 2),
(96, 'Cargador de Cadenas 973K', 'Modelo de motor Cat C9.3', 10, 1, 1),
(97, 'Compactador de Suelos Vibratorio CS54B', 'Peso en orden de trabajo: con cabina 10555.0 ', 0, 3, 4),
(98, 'Compactador de Suelos Vibratorio CS533E', 'Peso en orden de trabajo: con cabina 10840.0 ', 0, 3, 2),
(99, 'Miniexcavadora Hidráulica 303.5E CR', 'Modelo de motor Cat® C1.8', 0, 4, 4),
(100, 'Excavadora Pequeña 312D/D2 L', 'Modelo de motor 3054C', 0, 4, 4),
(101, 'Excavadora Hidráulica Mediana 320D2 GC', 'Modelo de motor C4.4 ACERT', 0, 4, 2),
(102, 'Manipulador Telescópico TH414C', 'Modelo de motor Cat® C4.4 DITAAC', 0, 5, 2),
(103, 'Cargador de Ruedas Pequeño 924K', 'Potencia bruta máxima 105.0 kW', 0, 2, 2),
(104, 'Cargador de Ruedas Pequeño 930K', 'Potencia bruta máxima 119.0 kW', 0, 2, 4),
(105, 'Cargador de Ruedas Pequeño 938K', 'Potencia bruta máxima 140.0 kW', 5, 2, 3),
(106, 'Minicargador 216B Serie 3', 'Potencia bruta: SAEJ1995 38.0 kW', 120, 6, 4),
(107, 'Minicargador 226B Serie 3', 'Potencia bruta 45.5 kW', 0, 6, 1),
(108, 'Minicargador 236D3 de Cat®', 'Potencia bruta: SAEJ1995 55.4 kW', 0, 6, 2),
(109, 'Motoniveladora 140M', 'Modelo de motor Cat C7 ACERT™', 2, 7, 4),
(110, 'Motoniveladora 12M', 'Modelo de motor Cat C7 ACERT™', 0, 7, 2),
(111, 'Motoniveladora 140K', 'Modelo de motor Cat C7', 0, 7, 1),
(112, 'Retroexcavadora Cargadora 416F2', 'Potencia neta: SAE J1349 64.0 kW', 1, 8, 3),
(113, 'Retroexcavadora Cargadora 420F2', 'Potencia neta: SAE J1349 70.0 kW', 0, 8, 4),
(114, 'Hoja topadora D6T', 'Modelo de motor Cat C9', 0, 9, 1),
(115, 'Tractor Topador D8T', 'Modelo de motor Cat C15', 60, 9, 1),
(116, 'Tractor Topador D8T grande', 'Modelo de motor C15 ACERT™ Cat®', 30, 9, 3),
(118, 'compactador', 'Maquinaria nueva año 2020', 0, 3, 1),
(119, 'cargador de cadenas', 'Arriendo por temporada de invierno', 0, 1, 1),
(120, 'Maquinas Pesadas', 'Muy pesadas', 0, 4, 1),
(121, 'Maquina de prueba*', 'prueba prueba', 0, 6, 5),
(122, 'Maquina de prueba${=¡¿\\^%&hola hola', 'prueba prueba esditar', 110, 6, 5),
(123, 'Motoniveladora matrixo locopeyo', 'sdsadas', 0, 1, 1),
(124, 'Motoniveladora Mixta T532', 'Modelo de motor Cat C9', 0, 7, 4),
(125, 'Minitractor rt-359', 'Tractor pequeño', 0, 9, 4),
(126, 'Motoniveladora 41D', 'Maquinaria nueva año 2021', 0, 8, 1),
(127, 'Cargador de cadenas XT-200', 'Motor Cat K2-3 Potencia neta 10000 kW', 0, 1, 1),
(128, 'Cargador de cadenas DS/4000', 'Motor Cat K2-3 Potencia neta 10000 kW', 0, 1, 4),
(129, 'Excavadora R-max 555', 'Broca-300 mm de bronce', 0, 4, 1),
(130, 'Cargador de Ruedas Pequeño 32-k', 'Maquinaria nueva año 2021', 0, 2, 1),
(131, 'Cargador MT-123', 'Capacidad maxima 300 toneladas', 0, 2, 1),
(132, 'Manipulador Telescópico TR-45X', 'Capacidad máxima 2000Kg', 0, 5, 1),
(133, 'Mini Cargador MT-123', 'Capacidad 520 toneladas', 0, 6, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `MaqMaquinaArrendada`
--

CREATE TABLE `MaqMaquinaArrendada` (
  `ID_MaqMaquinaArrendada` int(11) NOT NULL,
  `Empresa_MaqMaquinaArrendada` varchar(45) NOT NULL,
  `Nombre_MaqMaquinaArrendada` varchar(45) NOT NULL,
  `FechaInicio_MaqMaquinaArrendada` date NOT NULL,
  `FechaFin_MaqMaquinaArrendada` date NOT NULL,
  `HorasTrabajadas_MaqMaquinaArrendada` int(11) NOT NULL,
  `Operador_MaqMaquinaArrendada` varchar(45) NOT NULL,
  `ID_Obra` bigint(20) NOT NULL,
  `ID_MaqTipoMaquina` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `MaqMaquinaArrendada`
--

INSERT INTO `MaqMaquinaArrendada` (`ID_MaqMaquinaArrendada`, `Empresa_MaqMaquinaArrendada`, `Nombre_MaqMaquinaArrendada`, `FechaInicio_MaqMaquinaArrendada`, `FechaFin_MaqMaquinaArrendada`, `HorasTrabajadas_MaqMaquinaArrendada`, `Operador_MaqMaquinaArrendada`, `ID_Obra`, `ID_MaqTipoMaquina`) VALUES
(3, 'Nueva Atlentis', 'asdasd', '2020-12-03', '2020-12-17', 2, 'Carlos Tevez', 2, 1),
(4, 'CMPC', 'MAla', '2020-12-19', '2020-12-24', 45, 'Carlos Muñoz', 2, 9),
(5, 'Fallabella SA', 'se arrienda porque no hay maquinas :V', '2019-01-01', '2022-02-01', 100, 'José David', 2, 1),
(6, 'CMPC', 'MAquina max-teel2019', '2020-12-23', '2021-01-01', 45, 'Carlos tome', 2, 8),
(10, 'Adidas', 'Goku necesita una maquinaria', '2020-12-16', '2021-01-08', 45, 'Elena Toro', 3, 6),
(12, 'CMPC', 'MAla', '2021-01-01', '2021-01-04', 25, 'Carlos tome', 2, 9),
(13, 'Europa World', 'ninguna', '2021-01-08', '2021-01-11', 24, 'Carlos Muñoz', 1, 5),
(14, 'DC comics', 'Ninguna', '2021-01-09', '2021-01-10', 8, 'Benito Cardenas', 3, 3),
(15, 'DC comics', 'Ninguna', '2021-01-09', '2021-01-10', 12, 'Benito matelo', 3, 3),
(16, 'Marvel', 'hulk Lo necesita', '2020-12-29', '2020-12-30', 8, 'Matias Campos', 2, 9),
(18, 'CMPC', 'Arriendo Largo', '2021-01-15', '2021-01-16', 33, 'Carlos Muñoz', 3, 4),
(19, 'Empresa S.A San Carlos', 'Gas', '2021-01-15', '2021-01-30', 22, 'Pedro Toro', 1, 7),
(20, 'Torres Paine SA', 'esta arriendable', '2021-01-16', '2021-01-24', 25, 'lady gaga', 4, 2),
(21, 'Dr simi', 'esta arriendable', '2021-01-16', '2021-01-17', 100, 'lady gaga', 1, 2),
(24, 'Marvel', 'hulk Lo necesita', '2021-01-18', '2021-01-19', 25, 'Carlos tome', 1, 8),
(26, 'Fallafel', 'esta arriendable', '2021-01-28', '2021-01-31', 16, 'nulo', 1, 7),
(28, 'Dwalt', 'nulo', '2021-01-22', '2021-01-31', 20, 'nulo', 1, 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `MaqReasigna`
--

CREATE TABLE `MaqReasigna` (
  `ID_MaqReasigna` int(11) NOT NULL,
  `FechaProgrInicio_MaqReasigna` date NOT NULL,
  `FechaProgrFin_MaqReasigna` date NOT NULL,
  `FechaRealInicio_MaqReasigna` date DEFAULT NULL,
  `FechaRealFinal_MaqReasigna` date DEFAULT NULL,
  `FeachaInicioTraslado_MaqReasigna` date DEFAULT NULL,
  `FechaFinalTraslado_MaqReasigna` date DEFAULT NULL,
  `HorasTrabajadas_MaqReasigna` int(11) NOT NULL,
  `ID_Obra` bigint(20) NOT NULL,
  `ID_MaqTipoTraslado` int(11) NOT NULL,
  `ID_MaqMaquina` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `MaqReasigna`
--

INSERT INTO `MaqReasigna` (`ID_MaqReasigna`, `FechaProgrInicio_MaqReasigna`, `FechaProgrFin_MaqReasigna`, `FechaRealInicio_MaqReasigna`, `FechaRealFinal_MaqReasigna`, `FeachaInicioTraslado_MaqReasigna`, `FechaFinalTraslado_MaqReasigna`, `HorasTrabajadas_MaqReasigna`, `ID_Obra`, `ID_MaqTipoTraslado`, `ID_MaqMaquina`) VALUES
(4, '2021-01-21', '2021-01-31', '2021-01-21', '2021-01-31', NULL, NULL, 70, 3, 4, 112),
(5, '2021-01-20', '2021-01-26', '2021-01-20', '2021-01-26', NULL, NULL, 60, 1, 4, 105),
(6, '2021-02-05', '2021-02-15', '2021-02-05', '2021-02-15', NULL, NULL, 80, 1, 4, 116);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `MaqTipoEstadoMantencion`
--

CREATE TABLE `MaqTipoEstadoMantencion` (
  `ID_MaqTipoEstadoMantencion` int(11) NOT NULL,
  `Descripcion_MaqTipoEstadoMantencion` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `MaqTipoEstadoMantencion`
--

INSERT INTO `MaqTipoEstadoMantencion` (`ID_MaqTipoEstadoMantencion`, `Descripcion_MaqTipoEstadoMantencion`) VALUES
(1, 'Pendiente'),
(2, 'Mantencion'),
(3, 'Terminada');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `MaqTipoEstadoMaquina`
--

CREATE TABLE `MaqTipoEstadoMaquina` (
  `ID_MaqTipoEstadoMaquina` int(11) NOT NULL,
  `Descripcion_MaqTipoEstadoMaquina` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `MaqTipoEstadoMaquina`
--

INSERT INTO `MaqTipoEstadoMaquina` (`ID_MaqTipoEstadoMaquina`, `Descripcion_MaqTipoEstadoMaquina`) VALUES
(1, 'Disponible'),
(2, 'Asignada'),
(3, 'Reasignada'),
(4, 'En mantencion'),
(5, 'Inhabilitada');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `MaqTipoMaquina`
--

CREATE TABLE `MaqTipoMaquina` (
  `ID_MaqTipoMaquina` int(11) NOT NULL,
  `Descripcion_MaqTipoMaquina` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `MaqTipoMaquina`
--

INSERT INTO `MaqTipoMaquina` (`ID_MaqTipoMaquina`, `Descripcion_MaqTipoMaquina`) VALUES
(1, 'Cargadores de cadenas'),
(2, 'Cargadores de Ruedas'),
(3, 'Compactadores'),
(4, 'Excavadoras'),
(5, 'Manipuladores telescopicos'),
(6, 'Minicargadores y cargador de cadenas compacto'),
(7, 'Motoniveladoras'),
(8, 'Retroexcavadoras cargadoras'),
(9, 'Tractores topadores');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `MaqTipoTraslado`
--

CREATE TABLE `MaqTipoTraslado` (
  `ID_MaqTipoTraslado` int(11) NOT NULL,
  `Descripcion_MaqTipoTraslado` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `MaqTipoTraslado`
--

INSERT INTO `MaqTipoTraslado` (`ID_MaqTipoTraslado`, `Descripcion_MaqTipoTraslado`) VALUES
(1, 'Pendiente'),
(2, 'En camino'),
(3, 'Finalizado'),
(4, 'No tiene');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `material`
--

CREATE TABLE `material` (
  `ID_Material` int(11) NOT NULL,
  `Nombre_Material` varchar(45) DEFAULT NULL,
  `ID_Categoria_Material` int(11) NOT NULL,
  `Alto_Material` float DEFAULT NULL,
  `Ancho_Material` float DEFAULT NULL,
  `Espesor_Material` float DEFAULT NULL,
  `Largo_Material` float DEFAULT NULL,
  `Precio_Material` int(11) DEFAULT NULL,
  `Peso_Material` int(11) DEFAULT NULL,
  `Visible` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `normas`
--

CREATE TABLE `normas` (
  `ID_Normas` int(11) NOT NULL,
  `Reglamento` varchar(45) DEFAULT NULL,
  `Ley` varchar(45) DEFAULT NULL,
  `Descripcion_Normas` varchar(1000) DEFAULT NULL,
  `AñoCreacion_Norma` date DEFAULT NULL,
  `ID_ProtocoloDeCalidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Obra`
--

CREATE TABLE `Obra` (
  `ID_Obra` bigint(20) NOT NULL,
  `Nombre_Obra` varchar(45) DEFAULT NULL,
  `FechaInicio_Obra` timestamp NULL DEFAULT NULL,
  `FechaEntrega_Obra` date DEFAULT NULL,
  `FechaTermino_Obra` date DEFAULT NULL,
  `Presupuesto_Obra` bigint(20) DEFAULT NULL,
  `ID_Proyecto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `Obra`
--

INSERT INTO `Obra` (`ID_Obra`, `Nombre_Obra`, `FechaInicio_Obra`, `FechaEntrega_Obra`, `FechaTermino_Obra`, `Presupuesto_Obra`, `ID_Proyecto`) VALUES
(1, 'Reconstruccion hospital higueras ', '2019-12-02 00:00:00', NULL, '2021-01-25', NULL, 1),
(2, 'Construccion cesfam Udec', '2020-12-01 00:00:00', NULL, '2021-11-01', NULL, 2),
(3, 'Construccion Mall Barrio Norte', '2019-10-05 00:00:00', NULL, '2021-02-25', NULL, 3),
(4, 'Construccion Edificio Freire', '2018-03-01 00:00:00', NULL, '2019-04-27', NULL, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `obra/etapaproyecto_has_control_de_calidad_maestro`
--

CREATE TABLE `obra/etapaproyecto_has_control_de_calidad_maestro` (
  `EtapaObra_ID_Etapa` int(11) NOT NULL,
  `ID_ControlDeCalidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `obraetapaobra`
--

CREATE TABLE `obraetapaobra` (
  `ID_ObraEtapaObra` int(11) NOT NULL,
  `Nombre_ObraEtapaProyecto` varchar(45) DEFAULT NULL,
  `FechaInicio_ObraEtapaObra` date DEFAULT NULL,
  `FechaTermino_ObraEtapaObra` date DEFAULT NULL,
  `Descripcion_ObraEtapaObra` varchar(45) DEFAULT NULL,
  `ID_Obra` bigint(20) NOT NULL,
  `EtapaProyecto_ID_Etapa1` int(11) NOT NULL,
  `ImagenObra_idImagenObra` int(11) NOT NULL,
  `EstadosTablasObras_idEstadosTablasObras` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ofertalicit`
--

CREATE TABLE `ofertalicit` (
  `ID_OfertaLicit` int(11) NOT NULL,
  `Nombre_OfertaLicit` char(45) DEFAULT NULL,
  `Estado_OfertaLicit` char(45) DEFAULT NULL,
  `Descripcion_OfertaLicit` varchar(250) DEFAULT NULL,
  `Rut_Trabajador` char(20) NOT NULL,
  `ID_Organismo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `ofertalicit`
--

INSERT INTO `ofertalicit` (`ID_OfertaLicit`, `Nombre_OfertaLicit`, `Estado_OfertaLicit`, `Descripcion_OfertaLicit`, `Rut_Trabajador`, `ID_Organismo`) VALUES
(1, 'Las malvinas', '1', 'por detallar', '19.222.222-2', 1),
(2, 'Cisnes', '1', 'por detallar', '19.333.333-3', 2),
(3, 'Klausula', '1', 'por detallar', '19.444.444-4', 1),
(4, 'Construcción Edificio Freire', '1', 'por detallar', '19.555.555-5', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `organismo`
--

CREATE TABLE `organismo` (
  `ID_Organismo` int(11) NOT NULL,
  `Nombre_Organismo` varchar(45) NOT NULL,
  `Rut_Organismo` char(45) NOT NULL,
  `ID_Direccion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `organismo`
--

INSERT INTO `organismo` (`ID_Organismo`, `Nombre_Organismo`, `Rut_Organismo`, `ID_Direccion`) VALUES
(1, 'Bellolio', '67.198.678-4', 2),
(2, 'Petrobrasca', '58.322.566-2', 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `parteproyecto`
--

CREATE TABLE `parteproyecto` (
  `Id_Proyecto` int(11) NOT NULL,
  `Nombre_Proyecto` varchar(45) NOT NULL,
  `Tipo_Proyecto` varchar(45) NOT NULL,
  `Parte_deProyecto` varchar(45) NOT NULL,
  `Proyecto_ID_Proyecto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `plandecalidad`
--

CREATE TABLE `plandecalidad` (
  `ID_PlanDeCalidad` int(11) NOT NULL,
  `Descripcion_PlanDeCalidad` varchar(500) DEFAULT NULL,
  `Nombre_PlanDeCalidad` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `postulacion`
--

CREATE TABLE `postulacion` (
  `ID_Postulacion` bigint(20) NOT NULL,
  `FechaTermino_Postulacion` date DEFAULT NULL,
  `FechaInicio_Postulacion` date DEFAULT NULL,
  `Estado_Postulacion` int(1) DEFAULT NULL,
  `Cantidad_Postulacion` int(11) DEFAULT NULL,
  `ID_Obra` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `postulacionespecialidad`
--

CREATE TABLE `postulacionespecialidad` (
  `Postulacion_ID_Postulacion` bigint(20) NOT NULL,
  `Especialidad_ID_Especialidad` bigint(20) NOT NULL,
  `Cantidad_PostulacionEspecialidad` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `propiedadio`
--

CREATE TABLE `propiedadio` (
  `ID_PropiedadIO` int(11) NOT NULL,
  `IDTipodePropiedad` int(11) NOT NULL,
  `ID_EstadoPropiedadIO` int(11) NOT NULL DEFAULT '4',
  `ID_Venta` int(11) DEFAULT NULL,
  `Rut_Cliente` char(12) DEFAULT NULL,
  `Direccion_PropiedadIO` varchar(70) DEFAULT NULL,
  `MetrosCuadrados_PropiedadIO` int(11) DEFAULT NULL,
  `Dormitorios_PropiedadIO` int(11) DEFAULT NULL,
  `Baños_PropiedadIO` int(11) DEFAULT NULL,
  `FechaRecepcion_PropiedadIO` date DEFAULT NULL,
  `Precio_PropiedadIO` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `protocolo_de_calidad`
--

CREATE TABLE `protocolo_de_calidad` (
  `ID_ProtocoloDeCalidad` int(11) NOT NULL,
  `Descripcion_ProtocoloDeCalidad` varchar(500) DEFAULT NULL,
  `Nombre_Protocolo` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `protocolo_de_calidad_has_control_de_calidad_maestro`
--

CREATE TABLE `protocolo_de_calidad_has_control_de_calidad_maestro` (
  `ID_ProtocoloDeCalidad` int(11) NOT NULL,
  `ID_ControlDeCalidad` int(11) NOT NULL,
  `FechaActivacion_ProtocoloMaestro` date NOT NULL,
  `Estado_ProtocoloMaestro` varchar(45) DEFAULT NULL,
  `FechaDesactivacion_ProtocoloMaestro` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedor`
--

CREATE TABLE `proveedor` (
  `ID_Proveedor` int(11) NOT NULL,
  `Nombre_Proveedor` varchar(45) DEFAULT NULL,
  `NombreEmpresa_Proveedor` varchar(45) DEFAULT NULL,
  `Telefono_Proveedor` varchar(45) DEFAULT NULL,
  `Email_Proveedor` varchar(45) DEFAULT NULL,
  `ID_Direccion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proyecto`
--

CREATE TABLE `proyecto` (
  `ID_Proyecto` int(11) NOT NULL,
  `Nombre_Proyecto` varchar(200) DEFAULT NULL,
  `Estado` varchar(200) DEFAULT NULL,
  `Tipo` varchar(200) DEFAULT NULL,
  `Presupuesto` int(11) DEFAULT NULL,
  `FechaInicio` date DEFAULT NULL,
  `Duracion` int(11) DEFAULT NULL,
  `ID_Direccion` int(11) NOT NULL,
  `ID_OfertaLicit` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `proyecto`
--

INSERT INTO `proyecto` (`ID_Proyecto`, `Nombre_Proyecto`, `Estado`, `Tipo`, `Presupuesto`, `FechaInicio`, `Duracion`, `ID_Direccion`, `ID_OfertaLicit`) VALUES
(1, 'Reconstrucción Hospital Higueras', '1', '1', 2000000000, '2019-09-01', 10000, 4, 1),
(2, 'Construccion Cesfam Udec', '1', '1', 1000000000, '2020-10-21', 11000, 6, 2),
(3, 'Construcción Mall Barrio Norte', '1', '1', 1500000000, '2019-07-20', 12000, 7, 3),
(4, 'Construcción Edificio Freire', '1', '1', 1800000000, '2018-01-03', 13000, 8, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proyecto/anuncio`
--

CREATE TABLE `proyecto/anuncio` (
  `ID_Proyecto` int(11) NOT NULL,
  `ID_Anuncio` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proyecto_has_etapaproyecto`
--

CREATE TABLE `proyecto_has_etapaproyecto` (
  `Proyecto_ID_Proyecto` int(11) NOT NULL,
  `EtapaProyecto_ID_Etapa` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proyecto_has_tarea`
--

CREATE TABLE `proyecto_has_tarea` (
  `ID_Proyecto` int(11) NOT NULL,
  `Periodo` varchar(60) DEFAULT NULL,
  `Tarea_idSubsubetapa` int(11) NOT NULL,
  `Tarea_Subestapa_idSubestapa` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pruebas_de_ctc`
--

CREATE TABLE `pruebas_de_ctc` (
  `ID_PruebasDeCTC` int(11) NOT NULL,
  `Nombre_PruebasCTC` varchar(45) NOT NULL,
  `Descripcion_PruebasCTC` varchar(500) DEFAULT NULL,
  `Duracion_PruebasCTC` int(11) DEFAULT NULL,
  `ID_ProtocoloDeCalidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reasigna_material`
--

CREATE TABLE `reasigna_material` (
  `Stock_material` int(11) DEFAULT NULL,
  `ID_ReAsigna_Material` int(11) NOT NULL,
  `ID_Asigna_Material_Origen` int(11) NOT NULL,
  `ID_Asigna_Material_Destino` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `recepcionpv`
--

CREATE TABLE `recepcionpv` (
  `idRecepcionPV` int(11) NOT NULL,
  `idSubelemento` int(11) NOT NULL,
  `idTipodeElemento` int(11) NOT NULL,
  `ID_PropiedadIO` int(11) NOT NULL,
  `Estado_Subelemento` tinyint(4) DEFAULT NULL,
  `Observacion_Subelemento` varchar(300) DEFAULT NULL,
  `Estado_Garantia` tinyint(4) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `recursoestimado`
--

CREATE TABLE `recursoestimado` (
  `idRecursoEstimado` int(11) NOT NULL,
  `Nombre` varchar(200) DEFAULT NULL,
  `Precio_referencia` int(11) DEFAULT NULL,
  `Unidad_medida` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `recursoestimado_has_tarea`
--

CREATE TABLE `recursoestimado_has_tarea` (
  `RecursoEstimado_idRecursoEstimado` int(11) NOT NULL,
  `Tarea_idSubsubetapa` int(11) NOT NULL,
  `Tarea_Subestapa_idSubestapa` int(11) NOT NULL,
  `Cantidad` int(11) DEFAULT NULL,
  `Precio_otorgado` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `region`
--

CREATE TABLE `region` (
  `ID_Region` int(11) NOT NULL,
  `Nombre_Region` varchar(45) DEFAULT NULL,
  `Numero_Region` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='			';

--
-- Volcado de datos para la tabla `region`
--

INSERT INTO `region` (`ID_Region`, `Nombre_Region`, `Numero_Region`) VALUES
(1, 'Región del Biobío', 8),
(2, 'Región de Antofagasta', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `registro`
--

CREATE TABLE `registro` (
  `ID_Registro` int(11) NOT NULL,
  `Fecha_Registro` date NOT NULL,
  `Hora_Registro` varchar(45) NOT NULL,
  `Cliente_Rut_Cliente` char(20) NOT NULL,
  `Encargado_Rut_Encargado` char(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `registroestadomaterial`
--

CREATE TABLE `registroestadomaterial` (
  `ID_EstadoMaterial` int(11) NOT NULL,
  `ID_Asigna_Material` int(11) NOT NULL,
  `Stock` int(11) DEFAULT NULL,
  `ID_RegistroEstadoMaterial` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reparacion`
--

CREATE TABLE `reparacion` (
  `ID_Reparacion` int(11) NOT NULL,
  `ID_Solicitud` int(11) NOT NULL,
  `Diagnostico` varchar(300) NOT NULL,
  `Costo_Reparacion` int(11) DEFAULT NULL,
  `FechaReparacionInicio` date DEFAULT NULL,
  `FechaReparacionTermino` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `requieremaquinarias`
--

CREATE TABLE `requieremaquinarias` (
  `idRequiereMaquinarias` int(11) NOT NULL,
  `MaqTipoMaquina_ID_MaqTipoMaquina` int(11) NOT NULL,
  `Obra/EtapaProyecto_EtapaObra_ID_Etapa` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `requieremateriales`
--

CREATE TABLE `requieremateriales` (
  `idRequiereMateriales` int(11) NOT NULL,
  `Cantidad_Materiales` int(11) DEFAULT NULL,
  `Material_ID_Material` int(11) NOT NULL,
  `Obra/EtapaProyecto_EtapaObra_ID_Etapa` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `requieretrabajador`
--

CREATE TABLE `requieretrabajador` (
  `idRequiereTrabajador` int(11) NOT NULL,
  `Especialidad_ID_Especialidad` bigint(20) NOT NULL,
  `Obra/EtapaProyecto_EtapaObra_ID_Etapa` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `resultados_pruebas`
--

CREATE TABLE `resultados_pruebas` (
  `ID_ResultadosPruebas` int(11) NOT NULL,
  `Valor_Resultado` int(11) DEFAULT NULL,
  `Observaciones_Pruebas` varchar(45) DEFAULT NULL,
  `ID_PruebasDeCTC` int(11) NOT NULL,
  `ID_ControlDeCalidadObras` int(11) NOT NULL,
  `Estado_pruebas` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sancioneventoseguridad`
--

CREATE TABLE `sancioneventoseguridad` (
  `ID_SancionEventoSeguridad` int(11) NOT NULL,
  `Nombre_SancionEvento` varchar(55) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitudreparacion`
--

CREATE TABLE `solicitudreparacion` (
  `ID_Solicitud` int(11) NOT NULL,
  `ID_PropiedadIO` int(11) NOT NULL,
  `idEstadoSolicitud` int(11) NOT NULL DEFAULT '1',
  `Categoria_Solicitud` varchar(60) NOT NULL,
  `Descripcion_Solicitud` varchar(300) DEFAULT NULL,
  `DisponibilidadFechaInspeccion1` date DEFAULT NULL,
  `DisponibilidadFechaInspeccion2` date DEFAULT NULL,
  `Imagen_Solicitud` varchar(75) DEFAULT NULL,
  `FechaIngresoSolicitud` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitud_material`
--

CREATE TABLE `solicitud_material` (
  `Rut_Trabajador` char(20) NOT NULL,
  `ID_Bodega` int(5) NOT NULL,
  `ID_Solicitud_material` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitud_material_y_material`
--

CREATE TABLE `solicitud_material_y_material` (
  `ID_Solicitud_material` int(11) NOT NULL,
  `ID_Material` int(11) NOT NULL,
  `Stock` int(11) NOT NULL,
  `ID_S_y_M` int(11) NOT NULL,
  `Estado` int(11) DEFAULT NULL,
  `Comentario` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `subelemento`
--

CREATE TABLE `subelemento` (
  `idSubelemento` int(11) NOT NULL,
  `idTipodeElemento` int(11) NOT NULL,
  `Nombre_Subelemento` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `subetapa`
--

CREATE TABLE `subetapa` (
  `idSubestapa` int(11) NOT NULL,
  `Nombre Subetapa` varchar(200) DEFAULT NULL,
  `Descripcion` varchar(500) DEFAULT NULL,
  `EtapaProyecto_ID_Etapa` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tarea`
--

CREATE TABLE `tarea` (
  `idSubsubetapa` int(11) NOT NULL,
  `Nombre subsubetapa` varchar(200) DEFAULT NULL,
  `Descripción` varchar(500) DEFAULT NULL,
  `Subestapa_idSubestapa` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipodeelemento`
--

CREATE TABLE `tipodeelemento` (
  `idTipodeElemento` int(11) NOT NULL,
  `Nombre` varchar(45) DEFAULT NULL,
  `Años` int(11) DEFAULT NULL,
  `IDTipodePropiedad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipodepropiedad`
--

CREATE TABLE `tipodepropiedad` (
  `IDTipodePropiedad` int(11) NOT NULL,
  `TipodePropiedad` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipoeventoseguridad`
--

CREATE TABLE `tipoeventoseguridad` (
  `ID_TipoEventoSeguridad` int(11) NOT NULL,
  `Nombre_TipoEvento` varchar(45) NOT NULL,
  `Categoria_TipoEvento` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_bodega`
--

CREATE TABLE `tipo_bodega` (
  `ID_Tipobodega` int(5) NOT NULL,
  `Nombre_Tipobodega` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_de_control_de_calidad`
--

CREATE TABLE `tipo_de_control_de_calidad` (
  `ID_TipoDeControl` int(11) NOT NULL,
  `Nombre_TipoDeControl` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `trabajador`
--

CREATE TABLE `trabajador` (
  `Rut_Trabajador` char(20) NOT NULL,
  `Nombres_Trabajador` varchar(45) DEFAULT NULL,
  `Apellidos_Trabajador` varchar(45) DEFAULT NULL,
  `Correo_Trabajador` varchar(100) DEFAULT NULL,
  `Contrasena_Trabajador` varchar(50) DEFAULT NULL,
  `Telefono_Trabajador` int(11) DEFAULT NULL,
  `FotoPerfil_Trabajador` varchar(100) DEFAULT NULL,
  `FechaNacimiento_Trabajador` date DEFAULT NULL,
  `Estado_Trabajador` int(11) DEFAULT NULL,
  `Cargo_Trabajador` varchar(45) DEFAULT NULL,
  `ID_Estado` bigint(20) NOT NULL,
  `ID_Direccion` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `trabajador`
--

INSERT INTO `trabajador` (`Rut_Trabajador`, `Nombres_Trabajador`, `Apellidos_Trabajador`, `Correo_Trabajador`, `Contrasena_Trabajador`, `Telefono_Trabajador`, `FotoPerfil_Trabajador`, `FechaNacimiento_Trabajador`, `Estado_Trabajador`, `Cargo_Trabajador`, `ID_Estado`, `ID_Direccion`) VALUES
('19.222.222-2', 'Carlos', 'Pinto', 'mail@mail.com', '123456', 123456789, 'adsdas', '1966-01-13', 1, 'Junior', 1, 1),
('19.333.333-3', 'Nicolas', 'Tesla', 'NicolasT@gmail.com', '987654321', 24681312, 'jpgjpg', '1951-01-04', 1, 'Junior', 1, 7),
('19.444.444-4', 'Lionel', 'Ronaldo', 'CRMSS@gmail.com', '369456', 632546, 'jpgjpg', '1991-01-18', 1, 'Junior', 1, 6),
('19.555.555-5', 'Esteban', 'Gomez', 'Esgo@gmail.com', '5464545456', 79881687, 'jpg', '1991-01-04', 1, 'Junior', 1, 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `trabajadorespecialidad`
--

CREATE TABLE `trabajadorespecialidad` (
  `Rut_Trabajador` char(20) NOT NULL,
  `ID_Especialidad` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `trabajadorobra`
--

CREATE TABLE `trabajadorobra` (
  `Rut_Trabajador` char(20) NOT NULL,
  `ID_Obra` bigint(20) NOT NULL,
  `ID_Contrato` bigint(20) NOT NULL,
  `FechaIngreso_TrabajadorObra` date DEFAULT NULL,
  `FechaTermino_TrabajadorObra` date DEFAULT NULL,
  `Remuneracion_TrabajadorObra` int(11) DEFAULT NULL,
  `DiasTrabajados_TrabajadorObra` int(11) DEFAULT NULL,
  `Reasignacion_TrabajadorObra` int(1) DEFAULT NULL,
  `Cargo_TrabajadorObra` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `trabajadorpostulacion`
--

CREATE TABLE `trabajadorpostulacion` (
  `ID_Postulacion` bigint(20) NOT NULL,
  `Rut_Trabajador` char(20) NOT NULL,
  `Fecha_TrabajadorPostulacion` date DEFAULT NULL,
  `Estado_TrabajadorPostulacion` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `trabajador_y_reparacion`
--

CREATE TABLE `trabajador_y_reparacion` (
  `Rut_Trabajador` char(20) NOT NULL,
  `ID_Reparacion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `trabajo`
--

CREATE TABLE `trabajo` (
  `ID_Trabajo` int(11) NOT NULL,
  `Fecha_inicio_Trabajo` date DEFAULT NULL,
  `Fecha_termino_Trabajo` date DEFAULT NULL,
  `Descripcion_Trabajo` varchar(250) DEFAULT NULL,
  `Metros_cubicos_Trabajo` varchar(45) DEFAULT NULL,
  `Nombre_Encargado_Trabajo` varchar(45) DEFAULT NULL,
  `AvanceObra_ID_AvanceObra` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `venta`
--

CREATE TABLE `venta` (
  `ID_Venta` int(11) NOT NULL,
  `Estado_Venta` varchar(45) NOT NULL,
  `Pie_Venta` int(11) NOT NULL,
  `Reporte_Venta` varchar(45) NOT NULL,
  `ID_Proyecto` int(11) NOT NULL,
  `ParteProyecto_Id_Proyecto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `venta/registro`
--

CREATE TABLE `venta/registro` (
  `ID_Venta` int(11) NOT NULL,
  `ID_Registro` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `visitaareaseguridad`
--

CREATE TABLE `visitaareaseguridad` (
  `ID_VisitaAreaSeguridad` bigint(20) NOT NULL,
  `Nombre_Coordinador` varchar(45) NOT NULL,
  `Fecha_Visita` date NOT NULL,
  `Hora_Visita` time NOT NULL,
  `Observaciones_Visita` varchar(2000) DEFAULT NULL,
  `ID_Obra` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `ciudad`
--
ALTER TABLE `ciudad`
  ADD PRIMARY KEY (`ID_Ciudad`);

--
-- Indices de la tabla `direccion`
--
ALTER TABLE `direccion`
  ADD PRIMARY KEY (`ID_Direccion`);

--
-- Indices de la tabla `MaqAsigna`
--
ALTER TABLE `MaqAsigna`
  ADD PRIMARY KEY (`ID_MaqAsigna`);

--
-- Indices de la tabla `MaqMantencion`
--
ALTER TABLE `MaqMantencion`
  ADD PRIMARY KEY (`ID_MaqMantencion`);

--
-- Indices de la tabla `MaqMaquina`
--
ALTER TABLE `MaqMaquina`
  ADD PRIMARY KEY (`ID_MaqMaquina`);

--
-- Indices de la tabla `MaqMaquinaArrendada`
--
ALTER TABLE `MaqMaquinaArrendada`
  ADD PRIMARY KEY (`ID_MaqMaquinaArrendada`);

--
-- Indices de la tabla `MaqReasigna`
--
ALTER TABLE `MaqReasigna`
  ADD PRIMARY KEY (`ID_MaqReasigna`);

--
-- Indices de la tabla `MaqTipoEstadoMantencion`
--
ALTER TABLE `MaqTipoEstadoMantencion`
  ADD PRIMARY KEY (`ID_MaqTipoEstadoMantencion`);

--
-- Indices de la tabla `MaqTipoEstadoMaquina`
--
ALTER TABLE `MaqTipoEstadoMaquina`
  ADD PRIMARY KEY (`ID_MaqTipoEstadoMaquina`);

--
-- Indices de la tabla `MaqTipoMaquina`
--
ALTER TABLE `MaqTipoMaquina`
  ADD PRIMARY KEY (`ID_MaqTipoMaquina`);

--
-- Indices de la tabla `MaqTipoTraslado`
--
ALTER TABLE `MaqTipoTraslado`
  ADD PRIMARY KEY (`ID_MaqTipoTraslado`);

--
-- Indices de la tabla `Obra`
--
ALTER TABLE `Obra`
  ADD PRIMARY KEY (`ID_Obra`);

--
-- Indices de la tabla `ofertalicit`
--
ALTER TABLE `ofertalicit`
  ADD PRIMARY KEY (`ID_OfertaLicit`);

--
-- Indices de la tabla `organismo`
--
ALTER TABLE `organismo`
  ADD PRIMARY KEY (`ID_Organismo`);

--
-- Indices de la tabla `proyecto`
--
ALTER TABLE `proyecto`
  ADD PRIMARY KEY (`ID_Proyecto`);

--
-- Indices de la tabla `region`
--
ALTER TABLE `region`
  ADD PRIMARY KEY (`ID_Region`);

--
-- Indices de la tabla `trabajador`
--
ALTER TABLE `trabajador`
  ADD PRIMARY KEY (`Rut_Trabajador`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `ciudad`
--
ALTER TABLE `ciudad`
  MODIFY `ID_Ciudad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT de la tabla `MaqAsigna`
--
ALTER TABLE `MaqAsigna`
  MODIFY `ID_MaqAsigna` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT de la tabla `MaqMantencion`
--
ALTER TABLE `MaqMantencion`
  MODIFY `ID_MaqMantencion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT de la tabla `MaqMaquina`
--
ALTER TABLE `MaqMaquina`
  MODIFY `ID_MaqMaquina` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=134;
--
-- AUTO_INCREMENT de la tabla `MaqMaquinaArrendada`
--
ALTER TABLE `MaqMaquinaArrendada`
  MODIFY `ID_MaqMaquinaArrendada` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT de la tabla `MaqReasigna`
--
ALTER TABLE `MaqReasigna`
  MODIFY `ID_MaqReasigna` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `MaqTipoEstadoMantencion`
--
ALTER TABLE `MaqTipoEstadoMantencion`
  MODIFY `ID_MaqTipoEstadoMantencion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `MaqTipoEstadoMaquina`
--
ALTER TABLE `MaqTipoEstadoMaquina`
  MODIFY `ID_MaqTipoEstadoMaquina` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `MaqTipoMaquina`
--
ALTER TABLE `MaqTipoMaquina`
  MODIFY `ID_MaqTipoMaquina` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT de la tabla `MaqTipoTraslado`
--
ALTER TABLE `MaqTipoTraslado`
  MODIFY `ID_MaqTipoTraslado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `Obra`
--
ALTER TABLE `Obra`
  MODIFY `ID_Obra` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `proyecto`
--
ALTER TABLE `proyecto`
  MODIFY `ID_Proyecto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
