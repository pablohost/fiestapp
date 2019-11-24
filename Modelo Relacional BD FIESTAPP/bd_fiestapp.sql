-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 23-11-2019 a las 14:37:45
-- Versión del servidor: 10.3.16-MariaDB
-- Versión de PHP: 7.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `id11130881_fiestapp`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Amigos`
--

CREATE TABLE `Amigos` (
  `ind` int(11) NOT NULL,
  `indUsu` int(11) NOT NULL,
  `indAmi` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Boletas`
--

CREATE TABLE `Boletas` (
  `ind` int(11) NOT NULL,
  `indEve` int(11) NOT NULL,
  `dias` int(3) NOT NULL,
  `tipoPago` varchar(65) COLLATE utf8_spanish_ci NOT NULL,
  `total` int(7) NOT NULL,
  `fecha` datetime NOT NULL,
  `fechaIni` datetime NOT NULL,
  `fechaFin` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `CapPersonas`
--

CREATE TABLE `CapPersonas` (
  `ind` int(11) NOT NULL,
  `max` int(5) NOT NULL,
  `uso` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Categorias`
--

CREATE TABLE `Categorias` (
  `ind` int(11) NOT NULL,
  `des` varchar(65) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `CategoriasDen`
--

CREATE TABLE `CategoriasDen` (
  `ind` int(11) NOT NULL,
  `des` varchar(65) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `CategoriasEve`
--

CREATE TABLE `CategoriasEve` (
  `ind` int(11) NOT NULL,
  `indEve` int(11) NOT NULL,
  `indCat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Denuncias`
--

CREATE TABLE `Denuncias` (
  `ind` int(11) NOT NULL,
  `indSin` int(11) NOT NULL,
  `indCat` int(11) NOT NULL,
  `des` varchar(250) COLLATE utf8_spanish_ci NOT NULL,
  `estado` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Estacionamientos`
--

CREATE TABLE `Estacionamientos` (
  `ind` int(11) NOT NULL,
  `max` int(5) NOT NULL,
  `uso` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Eventos`
--

CREATE TABLE `Eventos` (
  `ind` int(11) NOT NULL,
  `indLoc` int(11) NOT NULL,
  `fecIni` datetime NOT NULL,
  `fecFin` datetime NOT NULL,
  `titulo` varchar(85) COLLATE utf8_spanish_ci NOT NULL,
  `des` varchar(700) COLLATE utf8_spanish_ci NOT NULL,
  `fly` varchar(120) COLLATE utf8_spanish_ci NOT NULL,
  `estado` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `GaleriasLoc`
--

CREATE TABLE `GaleriasLoc` (
  `ind` int(11) NOT NULL,
  `indLocal` int(11) NOT NULL,
  `img` varchar(120) COLLATE utf8_spanish_ci NOT NULL,
  `estado` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `GaleriasUsu`
--

CREATE TABLE `GaleriasUsu` (
  `ind` int(11) NOT NULL,
  `indUsu` int(11) NOT NULL,
  `img` varchar(120) COLLATE utf8_spanish_ci NOT NULL,
  `estado` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Generos`
--

CREATE TABLE `Generos` (
  `ind` int(11) NOT NULL,
  `des` varchar(45) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Locales`
--

CREATE TABLE `Locales` (
  `ind` int(11) NOT NULL,
  `indCap` int(11) NOT NULL,
  `indEst` int(11) NOT NULL,
  `lon` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `lat` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `nombre` varchar(125) COLLATE utf8_spanish_ci NOT NULL,
  `des` varchar(700) COLLATE utf8_spanish_ci NOT NULL,
  `fono` varchar(12) COLLATE utf8_spanish_ci NOT NULL,
  `correo` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `web` varchar(65) COLLATE utf8_spanish_ci NOT NULL,
  `estado` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Mensajes`
--

CREATE TABLE `Mensajes` (
  `ind` int(11) NOT NULL,
  `indEmi` int(11) NOT NULL,
  `indRec` int(11) NOT NULL,
  `des` varchar(700) COLLATE utf8_spanish_ci NOT NULL,
  `fechaHora` datetime NOT NULL,
  `estado` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Resenas`
--

CREATE TABLE `Resenas` (
  `ind` int(11) NOT NULL,
  `indSin` int(11) NOT NULL,
  `cal` int(1) NOT NULL,
  `des` varchar(250) COLLATE utf8_spanish_ci NOT NULL,
  `estado` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Sinapsis`
--

CREATE TABLE `Sinapsis` (
  `ind` int(11) NOT NULL,
  `indUsu` int(11) NOT NULL,
  `indEve` int(11) NOT NULL,
  `nivel` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `TiposUsu`
--

CREATE TABLE `TiposUsu` (
  `ind` int(11) NOT NULL,
  `des` varchar(60) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Usuarios`
--

CREATE TABLE `Usuarios` (
  `ind` int(11) NOT NULL,
  `indTip` int(11) NOT NULL,
  `indGen` int(11) NOT NULL,
  `priv` int(1) NOT NULL,
  `correo` varchar(120) COLLATE utf8_spanish_ci NOT NULL,
  `clave` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `nombre` varchar(120) COLLATE utf8_spanish_ci NOT NULL,
  `apelli` varchar(120) COLLATE utf8_spanish_ci NOT NULL,
  `fono` varchar(12) COLLATE utf8_spanish_ci NOT NULL,
  `edad` int(3) NOT NULL,
  `estado` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `Amigos`
--
ALTER TABLE `Amigos`
  ADD PRIMARY KEY (`ind`),
  ADD KEY `AmigosUsuarios` (`indUsu`),
  ADD KEY `AmigosAmigos` (`indAmi`);

--
-- Indices de la tabla `Boletas`
--
ALTER TABLE `Boletas`
  ADD PRIMARY KEY (`ind`),
  ADD KEY `BoletasEventos` (`indEve`);

--
-- Indices de la tabla `CapPersonas`
--
ALTER TABLE `CapPersonas`
  ADD PRIMARY KEY (`ind`);

--
-- Indices de la tabla `Categorias`
--
ALTER TABLE `Categorias`
  ADD PRIMARY KEY (`ind`);

--
-- Indices de la tabla `CategoriasDen`
--
ALTER TABLE `CategoriasDen`
  ADD PRIMARY KEY (`ind`);

--
-- Indices de la tabla `CategoriasEve`
--
ALTER TABLE `CategoriasEve`
  ADD PRIMARY KEY (`ind`),
  ADD KEY `CategoriasEventos` (`indCat`),
  ADD KEY `EventosCategorias` (`indEve`);

--
-- Indices de la tabla `Denuncias`
--
ALTER TABLE `Denuncias`
  ADD PRIMARY KEY (`ind`),
  ADD KEY `DenunciasSinapsis` (`indSin`),
  ADD KEY `DenunciasCategorias` (`indCat`);

--
-- Indices de la tabla `Estacionamientos`
--
ALTER TABLE `Estacionamientos`
  ADD PRIMARY KEY (`ind`);

--
-- Indices de la tabla `Eventos`
--
ALTER TABLE `Eventos`
  ADD PRIMARY KEY (`ind`),
  ADD KEY `LocalesEventos` (`indLoc`);

--
-- Indices de la tabla `GaleriasLoc`
--
ALTER TABLE `GaleriasLoc`
  ADD PRIMARY KEY (`ind`),
  ADD KEY `GaleriasLocales` (`indLocal`);

--
-- Indices de la tabla `GaleriasUsu`
--
ALTER TABLE `GaleriasUsu`
  ADD PRIMARY KEY (`ind`),
  ADD KEY `GaleriasUsuarios` (`indUsu`);

--
-- Indices de la tabla `Generos`
--
ALTER TABLE `Generos`
  ADD PRIMARY KEY (`ind`);

--
-- Indices de la tabla `Locales`
--
ALTER TABLE `Locales`
  ADD PRIMARY KEY (`ind`),
  ADD KEY `CapLocales` (`indCap`),
  ADD KEY `EstacionamientosLocales` (`indEst`);

--
-- Indices de la tabla `Mensajes`
--
ALTER TABLE `Mensajes`
  ADD PRIMARY KEY (`ind`),
  ADD KEY `MensajesEmisores` (`indEmi`),
  ADD KEY `MensajesReceptores` (`indRec`);

--
-- Indices de la tabla `Resenas`
--
ALTER TABLE `Resenas`
  ADD PRIMARY KEY (`ind`),
  ADD KEY `ResenasSinapsis` (`indSin`);

--
-- Indices de la tabla `Sinapsis`
--
ALTER TABLE `Sinapsis`
  ADD PRIMARY KEY (`ind`),
  ADD KEY `SinapsisUsuarios` (`indUsu`),
  ADD KEY `SinapsisEventos` (`indEve`);

--
-- Indices de la tabla `TiposUsu`
--
ALTER TABLE `TiposUsu`
  ADD PRIMARY KEY (`ind`);

--
-- Indices de la tabla `Usuarios`
--
ALTER TABLE `Usuarios`
  ADD PRIMARY KEY (`ind`),
  ADD KEY `UsuariosTipos` (`indTip`),
  ADD KEY `UsuariosGeneros` (`indGen`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `Amigos`
--
ALTER TABLE `Amigos`
  MODIFY `ind` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `Boletas`
--
ALTER TABLE `Boletas`
  MODIFY `ind` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `CapPersonas`
--
ALTER TABLE `CapPersonas`
  MODIFY `ind` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `Categorias`
--
ALTER TABLE `Categorias`
  MODIFY `ind` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `CategoriasDen`
--
ALTER TABLE `CategoriasDen`
  MODIFY `ind` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `CategoriasEve`
--
ALTER TABLE `CategoriasEve`
  MODIFY `ind` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `Denuncias`
--
ALTER TABLE `Denuncias`
  MODIFY `ind` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `Estacionamientos`
--
ALTER TABLE `Estacionamientos`
  MODIFY `ind` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `Eventos`
--
ALTER TABLE `Eventos`
  MODIFY `ind` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `GaleriasLoc`
--
ALTER TABLE `GaleriasLoc`
  MODIFY `ind` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `GaleriasUsu`
--
ALTER TABLE `GaleriasUsu`
  MODIFY `ind` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `Generos`
--
ALTER TABLE `Generos`
  MODIFY `ind` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `Locales`
--
ALTER TABLE `Locales`
  MODIFY `ind` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `Mensajes`
--
ALTER TABLE `Mensajes`
  MODIFY `ind` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `Resenas`
--
ALTER TABLE `Resenas`
  MODIFY `ind` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `Sinapsis`
--
ALTER TABLE `Sinapsis`
  MODIFY `ind` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `TiposUsu`
--
ALTER TABLE `TiposUsu`
  MODIFY `ind` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `Usuarios`
--
ALTER TABLE `Usuarios`
  MODIFY `ind` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `Amigos`
--
ALTER TABLE `Amigos`
  ADD CONSTRAINT `AmigosAmigos` FOREIGN KEY (`indAmi`) REFERENCES `Usuarios` (`ind`),
  ADD CONSTRAINT `AmigosUsuarios` FOREIGN KEY (`indUsu`) REFERENCES `Usuarios` (`ind`);

--
-- Filtros para la tabla `Boletas`
--
ALTER TABLE `Boletas`
  ADD CONSTRAINT `BoletasEventos` FOREIGN KEY (`indEve`) REFERENCES `Eventos` (`ind`);

--
-- Filtros para la tabla `CategoriasEve`
--
ALTER TABLE `CategoriasEve`
  ADD CONSTRAINT `CategoriasEventos` FOREIGN KEY (`indCat`) REFERENCES `Categorias` (`ind`),
  ADD CONSTRAINT `EventosCategorias` FOREIGN KEY (`indEve`) REFERENCES `Eventos` (`ind`);

--
-- Filtros para la tabla `Denuncias`
--
ALTER TABLE `Denuncias`
  ADD CONSTRAINT `DenunciasCategorias` FOREIGN KEY (`indCat`) REFERENCES `CategoriasDen` (`ind`),
  ADD CONSTRAINT `DenunciasSinapsis` FOREIGN KEY (`indSin`) REFERENCES `Sinapsis` (`ind`);

--
-- Filtros para la tabla `Eventos`
--
ALTER TABLE `Eventos`
  ADD CONSTRAINT `LocalesEventos` FOREIGN KEY (`indLoc`) REFERENCES `Locales` (`ind`);

--
-- Filtros para la tabla `GaleriasLoc`
--
ALTER TABLE `GaleriasLoc`
  ADD CONSTRAINT `GaleriasLocales` FOREIGN KEY (`indLocal`) REFERENCES `Locales` (`ind`);

--
-- Filtros para la tabla `GaleriasUsu`
--
ALTER TABLE `GaleriasUsu`
  ADD CONSTRAINT `GaleriasUsuarios` FOREIGN KEY (`indUsu`) REFERENCES `Usuarios` (`ind`);

--
-- Filtros para la tabla `Locales`
--
ALTER TABLE `Locales`
  ADD CONSTRAINT `CapLocales` FOREIGN KEY (`indCap`) REFERENCES `CapPersonas` (`ind`),
  ADD CONSTRAINT `EstacionamientosLocales` FOREIGN KEY (`indEst`) REFERENCES `Estacionamientos` (`ind`);

--
-- Filtros para la tabla `Mensajes`
--
ALTER TABLE `Mensajes`
  ADD CONSTRAINT `MensajesEmisores` FOREIGN KEY (`indEmi`) REFERENCES `Usuarios` (`ind`),
  ADD CONSTRAINT `MensajesReceptores` FOREIGN KEY (`indRec`) REFERENCES `Usuarios` (`ind`);

--
-- Filtros para la tabla `Resenas`
--
ALTER TABLE `Resenas`
  ADD CONSTRAINT `ResenasSinapsis` FOREIGN KEY (`indSin`) REFERENCES `Sinapsis` (`ind`);

--
-- Filtros para la tabla `Sinapsis`
--
ALTER TABLE `Sinapsis`
  ADD CONSTRAINT `SinapsisEventos` FOREIGN KEY (`indEve`) REFERENCES `Eventos` (`ind`),
  ADD CONSTRAINT `SinapsisUsuarios` FOREIGN KEY (`indUsu`) REFERENCES `Usuarios` (`ind`);

--
-- Filtros para la tabla `Usuarios`
--
ALTER TABLE `Usuarios`
  ADD CONSTRAINT `UsuariosGeneros` FOREIGN KEY (`indGen`) REFERENCES `Generos` (`ind`),
  ADD CONSTRAINT `UsuariosTipos` FOREIGN KEY (`indTip`) REFERENCES `TiposUsu` (`ind`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
