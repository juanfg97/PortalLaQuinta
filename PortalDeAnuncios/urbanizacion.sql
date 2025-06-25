-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 26-06-2025 a las 00:18:29
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `urbanizacion`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `anunciosg`
--

CREATE TABLE `anunciosg` (
  `Id` int(11) NOT NULL,
  `Titulo` varchar(255) NOT NULL,
  `Descripcion` text NOT NULL,
  `Autor` varchar(255) NOT NULL,
  `Categoria` enum('General','Mantenimiento','Seguridad','Eventos','Urgente') NOT NULL,
  `Imagen` varchar(500) DEFAULT NULL,
  `Fecha` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `anunciosg`
--

INSERT INTO `anunciosg` (`Id`, `Titulo`, `Descripcion`, `Autor`, `Categoria`, `Imagen`, `Fecha`) VALUES
(5, '¡Jornada de Mantenimiento de Áreas Verdes!', 'Estimados residentes,\r\n\r\nLes informamos que el día 8 de junio de 2025 se llevará a cabo una jornada de mantenimiento y embellecimiento de nuestras áreas verdes. Durante este día, nuestro equipo de jardinería realizará diversas labores como poda, desmalezado y riego para mantener nuestro entorno hermoso y agradable para todos.\r\n\r\nAgradecemos de antemano su colaboración.', 'Presidente central', 'General', '../../Vista/anunciosimg/anuncio_68446d96ca8a94.80572216.jpg', '2025-06-07 12:49:26'),
(8, '¡AVISO URGENTE! Interrupción Programada del Servicio de Agua', 'Estimados residentes, les informamos que el servicio de agua potable será interrumpido el viernes 13 de junio de 2025, de 9:00 a.m. a 3:00 p.m., debido a trabajos de reparación esenciales en la tubería principal. Les rogamos tomar las precauciones necesarias y almacenar agua para ese período. Agradecemos su comprensión y colaboración.', 'Presidente central', 'Urgente', '../../Vista/anunciosimg/anuncio_684486c0cb830.png', '2025-06-07 14:36:48'),
(9, ' Reforzando la Seguridad en Nuestra Urbanización ', 'La seguridad de nuestra comunidad es una prioridad. Queremos recordarles la importancia de mantener puertas y portones cerrados con llave y de no permitir el acceso a personas desconocidas. Si observan alguna actividad sospechosa, por favor repórtenla de inmediato a la garita de seguridad al  04161234567. ¡Trabajemos juntos para mantener nuestra urbanización segura!', 'Equipo de seguridad', 'Seguridad', NULL, '2025-06-07 14:38:09'),
(10, 'Novedades y Recordatorios para Nuestros Residentes ', '¡Hola a todos! Les recordamos la importancia de mantener limpias las áreas comunes y de recoger los desechos de sus mascotas. Próximamente compartiremos detalles sobre la asamblea vecinal. Su participación es fundamental para el bienestar de nuestra comunidad. ¡Gracias por ser parte de nuestra urbanización!', 'Presidente central', 'General', NULL, '2025-06-07 14:39:50'),
(11, 'Próximo Mantenimiento de Áreas azul', 'Les informamos que el equipo de mantenimiento realizará trabajos de jardinería y poda en las áreas verdes comunes la próxima semana, del lunes 16 al miércoles 18 de junio de 2025. Agradecemos su colaboración evitando transitar por las zonas señalizadas durante estos días. Esto nos permitirá mantener nuestra urbanización hermosa y bien cuidada.', 'Equipo de mantenimiento', 'Mantenimiento', '../../Vista/anunciosimg/anuncio_684487c8eedc1.jpg', '2025-06-14 14:30:46');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `anuncios_edificio`
--

CREATE TABLE `anuncios_edificio` (
  `Id` int(11) NOT NULL,
  `Terraza` enum('1','2','3','4','5','6','7','8','9','10','11','12','13') NOT NULL,
  `Edificio` enum('A','B','C','D','E','F','G','H','I','J','K') NOT NULL,
  `Titulo` varchar(255) NOT NULL,
  `Descripcion` text NOT NULL,
  `Autor` varchar(255) NOT NULL,
  `Imagen` varchar(500) DEFAULT NULL,
  `Fecha` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `anuncios_edificio`
--

INSERT INTO `anuncios_edificio` (`Id`, `Terraza`, `Edificio`, `Titulo`, `Descripcion`, `Autor`, `Imagen`, `Fecha`) VALUES
(4, '1', 'A', 'Mantenimiento de Jardinería y Áreas Verdes', 'Queremos recordarles la importancia de nuestro continuo mantenimiento de jardinería y áreas verdes. Esta inversión es crucial para mantener la belleza y el valor de nuestra propiedad, creando un entorno agradable para todos.\r\nLos gastos asociados con la jardinería incluyen la poda regular de árboles y arbustos, el riego, la fertilización, el control de plagas y enfermedades, y la resiembra cuando es necesario. Unas áreas verdes bien cuidadas no solo mejoran la estética, sino que también contribuyen a un ambiente más fresco y limpio.\r\nAgradecemos su comprensión y apoyo continuo para mantener nuestras zonas verdes en óptimas condiciones.', 'Juan Fernandez', '../../Vista/anunciosEdificio/anuncio_684d763a808e14.85818473.jpg', '2025-06-14 13:28:08'),
(7, '1', 'A', 'Reparación de Tubería Rota', 'Estimados residentes,\r\nLes informamos que hemos detectado una tubería de agua rota en el apartamento 1A-22 . Nuestro equipo de mantenimiento ya está trabajando en la reparación, pero es posible que experimenten interrupciones temporales en el servicio de agua mientras se realizan los trabajos.\r\nEstamos haciendo todo lo posible para resolver esta situación con la mayor brevedad y minimizar cualquier inconveniente. La seguridad de la infraestructura es nuestra prioridad.\r\nLes pedimos disculpas por las molestias que esto pueda causar y agradecemos su paciencia y comprensión. Si notan alguna filtración o problema adicional, por favor, repórtenlo de inmediato a la administración.', 'Juan Fernandez', '../../Vista/anunciosEdificio/anuncio_684d79fe1f93d.jpg', '2025-06-14 13:32:57'),
(8, '1', 'A', 'Gastos de Mantenimiento y Mejoras', 'Estimados residentes,\r\nQueremos mantenerlos al tanto de algunos gastos recientes y planificados que benefician a nuestra comunidad.\r\nRecientemente, hemos cubierto la reparación mayor de la bomba de agua principal, lo cual asegura un suministro constante para todo el edificio. Este fue un gasto significativo pero necesario para evitar problemas futuros.\r\nAdemás, estamos en el proceso de evaluar presupuestos para la modernización del sistema de iluminación en las áreas comunes, buscando opciones más eficientes energéticamente que a largo plazo reducirán nuestros costos operativos y mejorarán la seguridad.\r\nSu cuota de condominio hace posible estas mejoras y el mantenimiento continuo que garantiza la calidad de vida en nuestro hogar. Valoramos su compromiso y estamos siempre buscando formas de mejorar nuestro entorno.\r\nSi tienen alguna pregunta o sugerencia, no duden en contactar a la administración.', 'Juan Fernandez', NULL, '2025-06-14 13:34:08'),
(9, '1', 'B', 'Mantenimiento de Jardinería y Áreas Verdes', 'Queremos recordarles la importancia de nuestro continuo mantenimiento de jardinería y áreas verdes. Esta inversión es crucial para mantener la belleza y el valor de nuestra propiedad, creando un entorno agradable para todos.\r\nLos gastos asociados con la jardinería incluyen la poda regular de árboles y arbustos, el riego, la fertilización, el control de plagas y enfermedades, y la resiembra cuando es necesario. Unas áreas verdes bien cuidadas no solo mejoran la estética, sino que también contribuyen a un ambiente más fresco y limpio.\r\nAgradecemos su comprensión y apoyo continuo para mantener nuestras zonas verdes en óptimas condiciones.', 'Juan Fernandez', '../../Vista/anunciosEdificio/anuncio_684d763a808e14.85818473.jpg', '2025-06-14 13:28:08'),
(10, '1', 'B', 'Reparación de Tubería Rota', 'Estimados residentes,\r\nLes informamos que hemos detectado una tubería de agua rota en el apartamento 1B-22 . Nuestro equipo de mantenimiento ya está trabajando en la reparación, pero es posible que experimenten interrupciones temporales en el servicio de agua mientras se realizan los trabajos.\r\nEstamos haciendo todo lo posible para resolver esta situación con la mayor brevedad y minimizar cualquier inconveniente. La seguridad de la infraestructura es nuestra prioridad.\r\nLes pedimos disculpas por las molestias que esto pueda causar y agradecemos su paciencia y comprensión. Si notan alguna filtración o problema adicional, por favor, repórtenlo de inmediato a la administración.', 'Juan Fernandez', '../../Vista/anunciosEdificio/anuncio_684d79fe1f93d.jpg', '2025-06-14 13:32:57');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `archivos_adjuntos`
--

CREATE TABLE `archivos_adjuntos` (
  `id` int(11) NOT NULL,
  `informe_id` int(11) NOT NULL,
  `nombre_archivo` varchar(255) NOT NULL,
  `ruta_archivo` varchar(500) NOT NULL,
  `tipo_mime` varchar(100) NOT NULL,
  `tamano` bigint(20) NOT NULL,
  `fecha_subida` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `archivos_adjuntos`
--

INSERT INTO `archivos_adjuntos` (`id`, `informe_id`, `nombre_archivo`, `ruta_archivo`, `tipo_mime`, `tamano`, `fecha_subida`) VALUES
(3, 7, 'Libro1.xlsx', 'informeadjunto/adjunto_6846031763dd9.xlsx', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', 16824, '2025-06-08 17:39:35'),
(4, 12, '1_5064349874636457031.doc', 'informeadjunto/adjunto_684dbf88186f1.doc', 'application/msword', 97280, '2025-06-14 14:29:28');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comunicados`
--

CREATE TABLE `comunicados` (
  `Id` int(11) NOT NULL,
  `Destinatario` varchar(50) NOT NULL,
  `Asunto` varchar(255) DEFAULT NULL,
  `Mensaje` varchar(255) NOT NULL,
  `Prioridad` enum('normal','importante','urgente') NOT NULL,
  `Fecha` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `comunicados`
--

INSERT INTO `comunicados` (`Id`, `Destinatario`, `Asunto`, `Mensaje`, `Prioridad`, `Fecha`) VALUES
(27, 'todos', 'Aumento del condominio', 'Estimados presidentes de la junta de condominio,\nLes escribimos para informarles sobre un ajuste necesario en la cuota de condominio mensual. A partir del próximo mes, la cuota se establecerá en Bs. 500.\n\nEsta decisión, aunque difícil, se ha tomado debido', 'urgente', '2025-06-14 15:06:18'),
(28, 'todos', 'Recordatorio Importante: Cumplimiento de Cuotas de Condominio', 'Comunicación para Presidentes de Condominio\nAquí tienes varias opciones de comunicados que un presidente central de la junta de condominio podría enviar a los presidentes de los demás condominios, adaptados a diferentes situaciones:\n\nOpción 1: Recordatori', 'normal', '2025-06-14 15:08:06'),
(29, 'todos', 'Asunto: Solicitud de Aportes para Próxima Reunión de la Junta Central', 'Estimados presidentes,\n\nEsperando que tengan una buena semana, les informo que estamos preparando la agenda para nuestra próxima reunión de la Junta Central, que se llevará a cabo el [Fecha de la reunión].\n\nPara hacer esta reunión lo más productiva posibl', 'importante', '2025-06-14 15:09:02'),
(30, '1', 'Asunto: Solicitud de Información: Insumos de Limpieza del Edificio 1A', 'Estimado Presidente del Edificio 1A,\n\nLe saludo cordialmente.\n\nEstamos realizando una revisión de los inventarios y consumos de los insumos de limpieza en cada edificio para optimizar nuestros recursos. En este sentido, me gustaría solicitarle el inventar', 'normal', '2025-06-14 15:10:41'),
(31, 'todos', 'Aumento del condominio', 'orem Ipsum es simplemente el texto de relleno de las imprentas y archivos de texto. Lorem Ipsum ha sido el texto de relleno estándar de las industrias desde el año 1500, cuando un impresor (N. del T. persona que se dedica a la imprenta) desconocido usó un', 'normal', '2025-06-14 20:32:25'),
(32, 'todos', 'Aumento del condominio', 'orem Ipsum es simplemente el texto de relleno de las imprentas y archivos de texto. Lorem Ipsum ha sido el texto de relleno estándar de las industrias desde el año 1500, cuando un impresor (N. del T. persona que se dedica a la imprenta) desconocido usó un', 'normal', '2025-06-14 20:43:14'),
(33, 'todos', 'Prueba', 'orem Ipsum es simplemente el texto de relleno de las imprentas y archivos de texto. Lorem Ipsum ha sido el texto de relleno estándar de las industrias desde el año 1500, cuando un impresor (N. del T. persona que se dedica a la imprenta) desconocido usó un', 'normal', '2025-06-23 00:42:46');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `deudas`
--

CREATE TABLE `deudas` (
  `id` int(11) NOT NULL,
  `usuario` varchar(20) NOT NULL,
  `tipo_deuda` enum('condominio','otros') NOT NULL,
  `monto` decimal(10,2) NOT NULL,
  `fecha_vencimiento` date NOT NULL,
  `descripcion` text DEFAULT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp(),
  `estado` enum('pendiente','en proceso','completo') NOT NULL DEFAULT 'pendiente',
  `Motivo` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `deudas`
--

INSERT INTO `deudas` (`id`, `usuario`, `tipo_deuda`, `monto`, `fecha_vencimiento`, `descripcion`, `fecha_creacion`, `estado`, `Motivo`) VALUES
(22, '1A-11', 'condominio', 0.00, '2025-07-01', 'Cuota mensual de condominio', '2025-06-11 04:00:00', 'completo', ''),
(23, '1A-11', 'otros', 0.00, '2025-06-14', 'optvrijgbbghri', '2025-06-13 04:00:00', 'completo', ''),
(24, '1A-11', 'condominio', 0.00, '2025-06-17', 'Pago de condominio', '2025-06-13 04:00:00', 'completo', 'Ese pago movil es falso'),
(25, '1A-11', 'condominio', 500.99, '2025-07-01', 'Cuota Mensual de condominio', '2025-06-14 04:00:00', 'pendiente', ''),
(26, '1A-12', 'condominio', 500.99, '2025-07-01', 'Cuota Mensual de condominio', '2025-06-14 04:00:00', 'pendiente', ''),
(27, '1A-13', 'condominio', 500.99, '2025-07-01', 'Cuota Mensual de condominio', '2025-06-14 04:00:00', 'pendiente', 'No se lee la imagen'),
(28, '1A-14', 'condominio', 500.99, '2025-07-01', 'Cuota Mensual de condominio', '2025-06-14 04:00:00', 'pendiente', 'Los datos no son legibles'),
(29, '1A-21', 'condominio', 500.99, '2025-07-01', 'Cuota Mensual de condominio', '2025-06-14 04:00:00', 'pendiente', ''),
(30, '1A-22', 'condominio', 500.99, '2025-07-01', 'Cuota Mensual de condominio', '2025-06-14 04:00:00', 'pendiente', ''),
(31, '1A-23', 'condominio', 500.99, '2025-07-01', 'Cuota Mensual de condominio', '2025-06-14 04:00:00', 'pendiente', ''),
(32, '1A-24', 'condominio', 500.99, '2025-07-01', 'Cuota Mensual de condominio', '2025-06-14 04:00:00', 'pendiente', ''),
(33, '1A-31', 'condominio', 500.99, '2025-07-01', 'Cuota Mensual de condominio', '2025-06-14 04:00:00', 'pendiente', ''),
(34, '1A-32', 'condominio', 500.99, '2025-07-01', 'Cuota Mensual de condominio', '2025-06-14 04:00:00', 'pendiente', ''),
(35, '1A-33', 'condominio', 500.99, '2025-07-01', 'Cuota Mensual de condominio', '2025-06-14 04:00:00', 'pendiente', ''),
(36, '1A-34', 'condominio', 500.99, '2025-07-01', 'Cuota Mensual de condominio', '2025-06-14 04:00:00', 'pendiente', ''),
(37, '1A-41', 'condominio', 500.99, '2025-07-01', 'Cuota Mensual de condominio', '2025-06-14 04:00:00', 'pendiente', ''),
(38, '1A-42', 'condominio', 500.99, '2025-07-01', 'Cuota Mensual de condominio', '2025-06-14 04:00:00', 'pendiente', ''),
(39, '1A-43', 'condominio', 500.99, '2025-07-01', 'Cuota Mensual de condominio', '2025-06-14 04:00:00', 'pendiente', ''),
(40, '1A-44', 'condominio', 500.99, '2025-07-01', 'Cuota Mensual de condominio', '2025-06-14 04:00:00', 'pendiente', ''),
(41, '1A-51', 'condominio', 500.99, '2025-07-01', 'Cuota Mensual de condominio', '2025-06-14 04:00:00', 'pendiente', ''),
(42, '1A-52', 'condominio', 500.99, '2025-07-01', 'Cuota Mensual de condominio', '2025-06-14 04:00:00', 'pendiente', ''),
(43, '1A-53', 'condominio', 500.99, '2025-07-01', 'Cuota Mensual de condominio', '2025-06-14 04:00:00', 'pendiente', ''),
(44, '1A-54', 'condominio', 500.99, '2025-07-01', 'Cuota Mensual de condominio', '2025-06-14 04:00:00', 'pendiente', ''),
(46, '1A-14', 'otros', 100.00, '2025-06-16', 'Cuota de pago de mantenimiento', '2025-06-14 04:00:00', 'pendiente', ''),
(49, '1A-13', 'condominio', 500.00, '2025-06-30', '', '2025-06-25 04:00:00', 'pendiente', ''),
(50, '1A-14', 'condominio', 500.00, '2025-06-30', '', '2025-06-25 04:00:00', 'pendiente', ''),
(51, '1A-21', 'condominio', 500.00, '2025-06-30', '', '2025-06-25 04:00:00', 'pendiente', ''),
(52, '1A-22', 'condominio', 500.00, '2025-06-30', '', '2025-06-25 04:00:00', 'pendiente', ''),
(53, '1A-23', 'condominio', 500.00, '2025-06-30', '', '2025-06-25 04:00:00', 'pendiente', ''),
(54, '1A-24', 'condominio', 500.00, '2025-06-30', '', '2025-06-25 04:00:00', 'pendiente', ''),
(55, '1A-31', 'condominio', 500.00, '2025-06-30', '', '2025-06-25 04:00:00', 'pendiente', ''),
(56, '1A-32', 'condominio', 500.00, '2025-06-30', '', '2025-06-25 04:00:00', 'pendiente', ''),
(57, '1A-33', 'condominio', 500.00, '2025-06-30', '', '2025-06-25 04:00:00', 'pendiente', ''),
(58, '1A-34', 'condominio', 500.00, '2025-06-30', '', '2025-06-25 04:00:00', 'pendiente', ''),
(59, '1A-41', 'condominio', 500.00, '2025-06-30', '', '2025-06-25 04:00:00', 'pendiente', ''),
(60, '1A-42', 'condominio', 500.00, '2025-06-30', '', '2025-06-25 04:00:00', 'pendiente', ''),
(61, '1A-43', 'condominio', 500.00, '2025-06-30', '', '2025-06-25 04:00:00', 'pendiente', ''),
(62, '1A-44', 'condominio', 500.00, '2025-06-30', '', '2025-06-25 04:00:00', 'pendiente', ''),
(63, '1A-51', 'condominio', 500.00, '2025-06-30', '', '2025-06-25 04:00:00', 'pendiente', ''),
(64, '1A-52', 'condominio', 500.00, '2025-06-30', '', '2025-06-25 04:00:00', 'pendiente', ''),
(65, '1A-53', 'condominio', 500.00, '2025-06-30', '', '2025-06-25 04:00:00', 'pendiente', ''),
(66, '1A-54', 'condominio', 500.00, '2025-06-30', '', '2025-06-25 04:00:00', 'pendiente', ''),
(67, '1A-11', 'otros', 500.00, '2025-06-24', '', '2025-06-25 04:00:00', 'pendiente', NULL),
(68, '1A-11', 'otros', 600.00, '2025-06-28', '', '2025-06-25 04:00:00', 'pendiente', NULL),
(69, '1A-11', 'condominio', 500.00, '2025-06-26', '', '2025-06-25 04:00:00', 'pendiente', NULL),
(70, '1A-12', 'condominio', 500.00, '2025-06-26', '', '2025-06-25 04:00:00', 'pendiente', NULL),
(71, '1A-13', 'condominio', 500.00, '2025-06-26', '', '2025-06-25 04:00:00', 'pendiente', NULL),
(72, '1A-14', 'condominio', 500.00, '2025-06-26', '', '2025-06-25 04:00:00', 'pendiente', NULL),
(73, '1A-21', 'condominio', 500.00, '2025-06-26', '', '2025-06-25 04:00:00', 'pendiente', NULL),
(74, '1A-22', 'condominio', 500.00, '2025-06-26', '', '2025-06-25 04:00:00', 'pendiente', NULL),
(75, '1A-23', 'condominio', 500.00, '2025-06-26', '', '2025-06-25 04:00:00', 'pendiente', NULL),
(76, '1A-24', 'condominio', 500.00, '2025-06-26', '', '2025-06-25 04:00:00', 'pendiente', NULL),
(77, '1A-31', 'condominio', 500.00, '2025-06-26', '', '2025-06-25 04:00:00', 'pendiente', NULL),
(78, '1A-32', 'condominio', 500.00, '2025-06-26', '', '2025-06-25 04:00:00', 'pendiente', NULL),
(79, '1A-33', 'condominio', 500.00, '2025-06-26', '', '2025-06-25 04:00:00', 'pendiente', NULL),
(80, '1A-34', 'condominio', 500.00, '2025-06-26', '', '2025-06-25 04:00:00', 'pendiente', NULL),
(81, '1A-41', 'condominio', 500.00, '2025-06-26', '', '2025-06-25 04:00:00', 'pendiente', NULL),
(82, '1A-42', 'condominio', 500.00, '2025-06-26', '', '2025-06-25 04:00:00', 'pendiente', NULL),
(83, '1A-43', 'condominio', 500.00, '2025-06-26', '', '2025-06-25 04:00:00', 'pendiente', NULL),
(84, '1A-44', 'condominio', 500.00, '2025-06-26', '', '2025-06-25 04:00:00', 'pendiente', NULL),
(85, '1A-51', 'condominio', 500.00, '2025-06-26', '', '2025-06-25 04:00:00', 'pendiente', NULL),
(86, '1A-52', 'condominio', 500.00, '2025-06-26', '', '2025-06-25 04:00:00', 'pendiente', NULL),
(87, '1A-53', 'condominio', 500.00, '2025-06-26', '', '2025-06-25 04:00:00', 'pendiente', NULL),
(88, '1A-54', 'condominio', 500.00, '2025-06-26', '', '2025-06-25 04:00:00', 'pendiente', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `edificios`
--

CREATE TABLE `edificios` (
  `Terraza` enum('1','2','3','4','5','6','7','8','9','10','11','12','13') NOT NULL,
  `Edificio` enum('A','B','C','D','E','F','G','H','I','J','K') NOT NULL,
  `Piso` enum('1','2','3','4','5') NOT NULL,
  `Apartamento` enum('1','2','3','4') NOT NULL,
  `usuario` varchar(20) NOT NULL,
  `nombre_completo` varchar(100) NOT NULL DEFAULT 'Propietario Pendiente',
  `password` varchar(255) NOT NULL,
  `ultima_modificacion` date DEFAULT NULL,
  `correo` varchar(255) NOT NULL DEFAULT 'correo@example.com',
  `telefono` varchar(15) NOT NULL DEFAULT '000-0000000'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `edificios`
--

INSERT INTO `edificios` (`Terraza`, `Edificio`, `Piso`, `Apartamento`, `usuario`, `nombre_completo`, `password`, `ultima_modificacion`, `correo`, `telefono`) VALUES
('10', 'A', '1', '1', '10A-11', 'Jesus Fernandez', '$2y$10$H7YBqvFvQxlzfu6/C5JwU.vcdxTwR/13z8cSg8TNA6rliTKBDhc.y', '2025-06-04', 'jesus@gmail.com', '04141234567'),
('10', 'A', '1', '2', '10A-12', 'Juan Gonzalez', '$2y$10$fAQ4g7y1NSu5PkYgWzq5ruTwF.NACY4FrF0TXh2tk3HBX6OvmGayG', '2025-06-04', 'juan1@gmail.com', '04161234567'),
('10', 'A', '1', '3', '10A-13', 'Propietario Pendiente', '10A-13', NULL, 'correo@example.com', '000-0000000'),
('10', 'A', '1', '4', '10A-14', 'Propietario Pendiente', '10A-14', NULL, 'correo@example.com', '000-0000000'),
('10', 'A', '2', '1', '10A-21', 'Propietario Pendiente', '10A-21', NULL, 'correo@example.com', '000-0000000'),
('10', 'A', '2', '2', '10A-22', 'Propietario Pendiente', '10A-22', NULL, 'correo@example.com', '000-0000000'),
('10', 'A', '2', '3', '10A-23', 'Propietario Pendiente', '10A-23', NULL, 'correo@example.com', '000-0000000'),
('10', 'A', '2', '4', '10A-24', 'Propietario Pendiente', '10A-24', NULL, 'correo@example.com', '000-0000000'),
('10', 'A', '3', '1', '10A-31', 'Propietario Pendiente', '10A-31', NULL, 'correo@example.com', '000-0000000'),
('10', 'A', '3', '2', '10A-32', 'Propietario Pendiente', '10A-32', NULL, 'correo@example.com', '000-0000000'),
('10', 'A', '3', '3', '10A-33', 'Propietario Pendiente', '10A-33', NULL, 'correo@example.com', '000-0000000'),
('10', 'A', '3', '4', '10A-34', 'Propietario Pendiente', '10A-34', NULL, 'correo@example.com', '000-0000000'),
('10', 'A', '4', '1', '10A-41', 'Propietario Pendiente', '10A-41', NULL, 'correo@example.com', '000-0000000'),
('10', 'A', '4', '2', '10A-42', 'Propietario Pendiente', '10A-42', NULL, 'correo@example.com', '000-0000000'),
('10', 'A', '4', '3', '10A-43', 'Propietario Pendiente', '10A-43', NULL, 'correo@example.com', '000-0000000'),
('10', 'A', '4', '4', '10A-44', 'Propietario Pendiente', '10A-44', NULL, 'correo@example.com', '000-0000000'),
('10', 'A', '5', '1', '10A-51', 'Propietario Pendiente', '10A-51', NULL, 'correo@example.com', '000-0000000'),
('10', 'A', '5', '2', '10A-52', 'Propietario Pendiente', '10A-52', NULL, 'correo@example.com', '000-0000000'),
('10', 'A', '5', '3', '10A-53', 'Propietario Pendiente', '10A-53', NULL, 'correo@example.com', '000-0000000'),
('10', 'A', '5', '4', '10A-54', 'Propietario Pendiente', '10A-54', NULL, 'correo@example.com', '000-0000000'),
('10', 'B', '1', '1', '10B-11', 'Propietario Pendiente', '10B-11', NULL, 'correo@example.com', '000-0000000'),
('10', 'B', '1', '2', '10B-12', 'Propietario Pendiente', '10B-12', NULL, 'correo@example.com', '000-0000000'),
('10', 'B', '1', '3', '10B-13', 'Propietario Pendiente', '10B-13', NULL, 'correo@example.com', '000-0000000'),
('10', 'B', '1', '4', '10B-14', 'Propietario Pendiente', '10B-14', NULL, 'correo@example.com', '000-0000000'),
('10', 'B', '2', '1', '10B-21', 'Propietario Pendiente', '10B-21', NULL, 'correo@example.com', '000-0000000'),
('10', 'B', '2', '2', '10B-22', 'Propietario Pendiente', '10B-22', NULL, 'correo@example.com', '000-0000000'),
('10', 'B', '2', '3', '10B-23', 'Propietario Pendiente', '10B-23', NULL, 'correo@example.com', '000-0000000'),
('10', 'B', '2', '4', '10B-24', 'Propietario Pendiente', '10B-24', NULL, 'correo@example.com', '000-0000000'),
('10', 'B', '3', '1', '10B-31', 'Propietario Pendiente', '10B-31', NULL, 'correo@example.com', '000-0000000'),
('10', 'B', '3', '2', '10B-32', 'Propietario Pendiente', '10B-32', NULL, 'correo@example.com', '000-0000000'),
('10', 'B', '3', '3', '10B-33', 'Propietario Pendiente', '10B-33', NULL, 'correo@example.com', '000-0000000'),
('10', 'B', '3', '4', '10B-34', 'Propietario Pendiente', '10B-34', NULL, 'correo@example.com', '000-0000000'),
('10', 'B', '4', '1', '10B-41', 'Propietario Pendiente', '10B-41', NULL, 'correo@example.com', '000-0000000'),
('10', 'B', '4', '2', '10B-42', 'Propietario Pendiente', '10B-42', NULL, 'correo@example.com', '000-0000000'),
('10', 'B', '4', '3', '10B-43', 'Propietario Pendiente', '10B-43', NULL, 'correo@example.com', '000-0000000'),
('10', 'B', '4', '4', '10B-44', 'Propietario Pendiente', '10B-44', NULL, 'correo@example.com', '000-0000000'),
('10', 'B', '5', '1', '10B-51', 'Propietario Pendiente', '10B-51', NULL, 'correo@example.com', '000-0000000'),
('10', 'B', '5', '2', '10B-52', 'Propietario Pendiente', '10B-52', NULL, 'correo@example.com', '000-0000000'),
('10', 'B', '5', '3', '10B-53', 'Propietario Pendiente', '10B-53', NULL, 'correo@example.com', '000-0000000'),
('10', 'B', '5', '4', '10B-54', 'Propietario Pendiente', '10B-54', NULL, 'correo@example.com', '000-0000000'),
('10', 'C', '1', '1', '10C-11', 'Propietario Pendiente', '10C-11', NULL, 'correo@example.com', '000-0000000'),
('10', 'C', '1', '2', '10C-12', 'Propietario Pendiente', '10C-12', NULL, 'correo@example.com', '000-0000000'),
('10', 'C', '1', '3', '10C-13', 'Propietario Pendiente', '10C-13', NULL, 'correo@example.com', '000-0000000'),
('10', 'C', '1', '4', '10C-14', 'Propietario Pendiente', '10C-14', NULL, 'correo@example.com', '000-0000000'),
('10', 'C', '2', '1', '10C-21', 'Propietario Pendiente', '10C-21', NULL, 'correo@example.com', '000-0000000'),
('10', 'C', '2', '2', '10C-22', 'Propietario Pendiente', '10C-22', NULL, 'correo@example.com', '000-0000000'),
('10', 'C', '2', '3', '10C-23', 'Propietario Pendiente', '10C-23', NULL, 'correo@example.com', '000-0000000'),
('10', 'C', '2', '4', '10C-24', 'Propietario Pendiente', '10C-24', NULL, 'correo@example.com', '000-0000000'),
('10', 'C', '3', '1', '10C-31', 'Propietario Pendiente', '10C-31', NULL, 'correo@example.com', '000-0000000'),
('10', 'C', '3', '2', '10C-32', 'Propietario Pendiente', '10C-32', NULL, 'correo@example.com', '000-0000000'),
('10', 'C', '3', '3', '10C-33', 'Propietario Pendiente', '10C-33', NULL, 'correo@example.com', '000-0000000'),
('10', 'C', '3', '4', '10C-34', 'Propietario Pendiente', '10C-34', NULL, 'correo@example.com', '000-0000000'),
('10', 'C', '4', '1', '10C-41', 'Propietario Pendiente', '10C-41', NULL, 'correo@example.com', '000-0000000'),
('10', 'C', '4', '2', '10C-42', 'Propietario Pendiente', '10C-42', NULL, 'correo@example.com', '000-0000000'),
('10', 'C', '4', '3', '10C-43', 'Propietario Pendiente', '10C-43', NULL, 'correo@example.com', '000-0000000'),
('10', 'C', '4', '4', '10C-44', 'Propietario Pendiente', '10C-44', NULL, 'correo@example.com', '000-0000000'),
('10', 'C', '5', '1', '10C-51', 'Propietario Pendiente', '10C-51', NULL, 'correo@example.com', '000-0000000'),
('10', 'C', '5', '2', '10C-52', 'Propietario Pendiente', '10C-52', NULL, 'correo@example.com', '000-0000000'),
('10', 'C', '5', '3', '10C-53', 'Propietario Pendiente', '10C-53', NULL, 'correo@example.com', '000-0000000'),
('10', 'C', '5', '4', '10C-54', 'Propietario Pendiente', '10C-54', NULL, 'correo@example.com', '000-0000000'),
('10', 'D', '1', '1', '10D-11', 'Propietario Pendiente', '10D-11', NULL, 'correo@example.com', '000-0000000'),
('10', 'D', '1', '2', '10D-12', 'Propietario Pendiente', '10D-12', NULL, 'correo@example.com', '000-0000000'),
('10', 'D', '1', '3', '10D-13', 'Propietario Pendiente', '10D-13', NULL, 'correo@example.com', '000-0000000'),
('10', 'D', '1', '4', '10D-14', 'Propietario Pendiente', '10D-14', NULL, 'correo@example.com', '000-0000000'),
('10', 'D', '2', '1', '10D-21', 'Propietario Pendiente', '10D-21', NULL, 'correo@example.com', '000-0000000'),
('10', 'D', '2', '2', '10D-22', 'Propietario Pendiente', '10D-22', NULL, 'correo@example.com', '000-0000000'),
('10', 'D', '2', '3', '10D-23', 'Propietario Pendiente', '10D-23', NULL, 'correo@example.com', '000-0000000'),
('10', 'D', '2', '4', '10D-24', 'Propietario Pendiente', '10D-24', NULL, 'correo@example.com', '000-0000000'),
('10', 'D', '3', '1', '10D-31', 'Propietario Pendiente', '10D-31', NULL, 'correo@example.com', '000-0000000'),
('10', 'D', '3', '2', '10D-32', 'Propietario Pendiente', '10D-32', NULL, 'correo@example.com', '000-0000000'),
('10', 'D', '3', '3', '10D-33', 'Propietario Pendiente', '10D-33', NULL, 'correo@example.com', '000-0000000'),
('10', 'D', '3', '4', '10D-34', 'Propietario Pendiente', '10D-34', NULL, 'correo@example.com', '000-0000000'),
('10', 'D', '4', '1', '10D-41', 'Propietario Pendiente', '10D-41', NULL, 'correo@example.com', '000-0000000'),
('10', 'D', '4', '2', '10D-42', 'Propietario Pendiente', '10D-42', NULL, 'correo@example.com', '000-0000000'),
('10', 'D', '4', '3', '10D-43', 'Propietario Pendiente', '10D-43', NULL, 'correo@example.com', '000-0000000'),
('10', 'D', '4', '4', '10D-44', 'Propietario Pendiente', '10D-44', NULL, 'correo@example.com', '000-0000000'),
('10', 'D', '5', '1', '10D-51', 'Propietario Pendiente', '10D-51', NULL, 'correo@example.com', '000-0000000'),
('10', 'D', '5', '2', '10D-52', 'Propietario Pendiente', '10D-52', NULL, 'correo@example.com', '000-0000000'),
('10', 'D', '5', '3', '10D-53', 'Propietario Pendiente', '10D-53', NULL, 'correo@example.com', '000-0000000'),
('10', 'D', '5', '4', '10D-54', 'Propietario Pendiente', '10D-54', NULL, 'correo@example.com', '000-0000000'),
('10', 'E', '1', '1', '10E-11', 'Propietario Pendiente', '10E-11', NULL, 'correo@example.com', '000-0000000'),
('10', 'E', '1', '2', '10E-12', 'Propietario Pendiente', '10E-12', NULL, 'correo@example.com', '000-0000000'),
('10', 'E', '1', '3', '10E-13', 'Propietario Pendiente', '10E-13', NULL, 'correo@example.com', '000-0000000'),
('10', 'E', '1', '4', '10E-14', 'Propietario Pendiente', '10E-14', NULL, 'correo@example.com', '000-0000000'),
('10', 'E', '2', '1', '10E-21', 'Propietario Pendiente', '10E-21', NULL, 'correo@example.com', '000-0000000'),
('10', 'E', '2', '2', '10E-22', 'Propietario Pendiente', '10E-22', NULL, 'correo@example.com', '000-0000000'),
('10', 'E', '2', '3', '10E-23', 'Propietario Pendiente', '10E-23', NULL, 'correo@example.com', '000-0000000'),
('10', 'E', '2', '4', '10E-24', 'Propietario Pendiente', '10E-24', NULL, 'correo@example.com', '000-0000000'),
('10', 'E', '3', '1', '10E-31', 'Propietario Pendiente', '10E-31', NULL, 'correo@example.com', '000-0000000'),
('10', 'E', '3', '2', '10E-32', 'Propietario Pendiente', '10E-32', NULL, 'correo@example.com', '000-0000000'),
('10', 'E', '3', '3', '10E-33', 'Propietario Pendiente', '10E-33', NULL, 'correo@example.com', '000-0000000'),
('10', 'E', '3', '4', '10E-34', 'Propietario Pendiente', '10E-34', NULL, 'correo@example.com', '000-0000000'),
('10', 'E', '4', '1', '10E-41', 'Propietario Pendiente', '10E-41', NULL, 'correo@example.com', '000-0000000'),
('10', 'E', '4', '2', '10E-42', 'Propietario Pendiente', '10E-42', NULL, 'correo@example.com', '000-0000000'),
('10', 'E', '4', '3', '10E-43', 'Propietario Pendiente', '10E-43', NULL, 'correo@example.com', '000-0000000'),
('10', 'E', '4', '4', '10E-44', 'Propietario Pendiente', '10E-44', NULL, 'correo@example.com', '000-0000000'),
('10', 'E', '5', '1', '10E-51', 'Propietario Pendiente', '10E-51', NULL, 'correo@example.com', '000-0000000'),
('10', 'E', '5', '2', '10E-52', 'Propietario Pendiente', '10E-52', NULL, 'correo@example.com', '000-0000000'),
('10', 'E', '5', '3', '10E-53', 'Propietario Pendiente', '10E-53', NULL, 'correo@example.com', '000-0000000'),
('10', 'E', '5', '4', '10E-54', 'Propietario Pendiente', '10E-54', NULL, 'correo@example.com', '000-0000000'),
('10', 'F', '1', '1', '10F-11', 'Propietario Pendiente', '10F-11', NULL, 'correo@example.com', '000-0000000'),
('10', 'F', '1', '2', '10F-12', 'Propietario Pendiente', '10F-12', NULL, 'correo@example.com', '000-0000000'),
('10', 'F', '1', '3', '10F-13', 'Propietario Pendiente', '10F-13', NULL, 'correo@example.com', '000-0000000'),
('10', 'F', '1', '4', '10F-14', 'Propietario Pendiente', '10F-14', NULL, 'correo@example.com', '000-0000000'),
('10', 'F', '2', '1', '10F-21', 'Propietario Pendiente', '10F-21', NULL, 'correo@example.com', '000-0000000'),
('10', 'F', '2', '2', '10F-22', 'Propietario Pendiente', '10F-22', NULL, 'correo@example.com', '000-0000000'),
('10', 'F', '2', '3', '10F-23', 'Propietario Pendiente', '10F-23', NULL, 'correo@example.com', '000-0000000'),
('10', 'F', '2', '4', '10F-24', 'Propietario Pendiente', '10F-24', NULL, 'correo@example.com', '000-0000000'),
('10', 'F', '3', '1', '10F-31', 'Propietario Pendiente', '10F-31', NULL, 'correo@example.com', '000-0000000'),
('10', 'F', '3', '2', '10F-32', 'Propietario Pendiente', '10F-32', NULL, 'correo@example.com', '000-0000000'),
('10', 'F', '3', '3', '10F-33', 'Propietario Pendiente', '10F-33', NULL, 'correo@example.com', '000-0000000'),
('10', 'F', '3', '4', '10F-34', 'Propietario Pendiente', '10F-34', NULL, 'correo@example.com', '000-0000000'),
('10', 'F', '4', '1', '10F-41', 'Propietario Pendiente', '10F-41', NULL, 'correo@example.com', '000-0000000'),
('10', 'F', '4', '2', '10F-42', 'Propietario Pendiente', '10F-42', NULL, 'correo@example.com', '000-0000000'),
('10', 'F', '4', '3', '10F-43', 'Propietario Pendiente', '10F-43', NULL, 'correo@example.com', '000-0000000'),
('10', 'F', '4', '4', '10F-44', 'Propietario Pendiente', '10F-44', NULL, 'correo@example.com', '000-0000000'),
('10', 'F', '5', '1', '10F-51', 'Propietario Pendiente', '10F-51', NULL, 'correo@example.com', '000-0000000'),
('10', 'F', '5', '2', '10F-52', 'Propietario Pendiente', '10F-52', NULL, 'correo@example.com', '000-0000000'),
('10', 'F', '5', '3', '10F-53', 'Propietario Pendiente', '10F-53', NULL, 'correo@example.com', '000-0000000'),
('10', 'F', '5', '4', '10F-54', 'Propietario Pendiente', '10F-54', NULL, 'correo@example.com', '000-0000000'),
('10', 'G', '1', '1', '10G-11', 'Propietario Pendiente', '10G-11', NULL, 'correo@example.com', '000-0000000'),
('10', 'G', '1', '2', '10G-12', 'Propietario Pendiente', '10G-12', NULL, 'correo@example.com', '000-0000000'),
('10', 'G', '1', '3', '10G-13', 'Propietario Pendiente', '10G-13', NULL, 'correo@example.com', '000-0000000'),
('10', 'G', '1', '4', '10G-14', 'Propietario Pendiente', '10G-14', NULL, 'correo@example.com', '000-0000000'),
('10', 'G', '2', '1', '10G-21', 'Propietario Pendiente', '10G-21', NULL, 'correo@example.com', '000-0000000'),
('10', 'G', '2', '2', '10G-22', 'Propietario Pendiente', '10G-22', NULL, 'correo@example.com', '000-0000000'),
('10', 'G', '2', '3', '10G-23', 'Propietario Pendiente', '10G-23', NULL, 'correo@example.com', '000-0000000'),
('10', 'G', '2', '4', '10G-24', 'Propietario Pendiente', '10G-24', NULL, 'correo@example.com', '000-0000000'),
('10', 'G', '3', '1', '10G-31', 'Propietario Pendiente', '10G-31', NULL, 'correo@example.com', '000-0000000'),
('10', 'G', '3', '2', '10G-32', 'Propietario Pendiente', '10G-32', NULL, 'correo@example.com', '000-0000000'),
('10', 'G', '3', '3', '10G-33', 'Propietario Pendiente', '10G-33', NULL, 'correo@example.com', '000-0000000'),
('10', 'G', '3', '4', '10G-34', 'Propietario Pendiente', '10G-34', NULL, 'correo@example.com', '000-0000000'),
('10', 'G', '4', '1', '10G-41', 'Propietario Pendiente', '10G-41', NULL, 'correo@example.com', '000-0000000'),
('10', 'G', '4', '2', '10G-42', 'Propietario Pendiente', '10G-42', NULL, 'correo@example.com', '000-0000000'),
('10', 'G', '4', '3', '10G-43', 'Propietario Pendiente', '10G-43', NULL, 'correo@example.com', '000-0000000'),
('10', 'G', '4', '4', '10G-44', 'Propietario Pendiente', '10G-44', NULL, 'correo@example.com', '000-0000000'),
('10', 'G', '5', '1', '10G-51', 'Propietario Pendiente', '10G-51', NULL, 'correo@example.com', '000-0000000'),
('10', 'G', '5', '2', '10G-52', 'Propietario Pendiente', '10G-52', NULL, 'correo@example.com', '000-0000000'),
('10', 'G', '5', '3', '10G-53', 'Propietario Pendiente', '10G-53', NULL, 'correo@example.com', '000-0000000'),
('10', 'G', '5', '4', '10G-54', 'Propietario Pendiente', '10G-54', NULL, 'correo@example.com', '000-0000000'),
('10', 'H', '1', '1', '10H-11', 'Propietario Pendiente', '10H-11', NULL, 'correo@example.com', '000-0000000'),
('10', 'H', '1', '2', '10H-12', 'Propietario Pendiente', '10H-12', NULL, 'correo@example.com', '000-0000000'),
('10', 'H', '1', '3', '10H-13', 'Propietario Pendiente', '10H-13', NULL, 'correo@example.com', '000-0000000'),
('10', 'H', '1', '4', '10H-14', 'Propietario Pendiente', '10H-14', NULL, 'correo@example.com', '000-0000000'),
('10', 'H', '2', '1', '10H-21', 'Propietario Pendiente', '10H-21', NULL, 'correo@example.com', '000-0000000'),
('10', 'H', '2', '2', '10H-22', 'Propietario Pendiente', '10H-22', NULL, 'correo@example.com', '000-0000000'),
('10', 'H', '2', '3', '10H-23', 'Propietario Pendiente', '10H-23', NULL, 'correo@example.com', '000-0000000'),
('10', 'H', '2', '4', '10H-24', 'Propietario Pendiente', '10H-24', NULL, 'correo@example.com', '000-0000000'),
('10', 'H', '3', '1', '10H-31', 'Propietario Pendiente', '10H-31', NULL, 'correo@example.com', '000-0000000'),
('10', 'H', '3', '2', '10H-32', 'Propietario Pendiente', '10H-32', NULL, 'correo@example.com', '000-0000000'),
('10', 'H', '3', '3', '10H-33', 'Propietario Pendiente', '10H-33', NULL, 'correo@example.com', '000-0000000'),
('10', 'H', '3', '4', '10H-34', 'Propietario Pendiente', '10H-34', NULL, 'correo@example.com', '000-0000000'),
('10', 'H', '4', '1', '10H-41', 'Propietario Pendiente', '10H-41', NULL, 'correo@example.com', '000-0000000'),
('10', 'H', '4', '2', '10H-42', 'Propietario Pendiente', '10H-42', NULL, 'correo@example.com', '000-0000000'),
('10', 'H', '4', '3', '10H-43', 'Propietario Pendiente', '10H-43', NULL, 'correo@example.com', '000-0000000'),
('10', 'H', '4', '4', '10H-44', 'Propietario Pendiente', '10H-44', NULL, 'correo@example.com', '000-0000000'),
('10', 'H', '5', '1', '10H-51', 'Propietario Pendiente', '10H-51', NULL, 'correo@example.com', '000-0000000'),
('10', 'H', '5', '2', '10H-52', 'Propietario Pendiente', '10H-52', NULL, 'correo@example.com', '000-0000000'),
('10', 'H', '5', '3', '10H-53', 'Propietario Pendiente', '10H-53', NULL, 'correo@example.com', '000-0000000'),
('10', 'H', '5', '4', '10H-54', 'Propietario Pendiente', '10H-54', NULL, 'correo@example.com', '000-0000000'),
('10', 'I', '1', '1', '10I-11', 'Propietario Pendiente', '10I-11', NULL, 'correo@example.com', '000-0000000'),
('10', 'I', '1', '2', '10I-12', 'Propietario Pendiente', '10I-12', NULL, 'correo@example.com', '000-0000000'),
('10', 'I', '1', '3', '10I-13', 'Propietario Pendiente', '10I-13', NULL, 'correo@example.com', '000-0000000'),
('10', 'I', '1', '4', '10I-14', 'Propietario Pendiente', '10I-14', NULL, 'correo@example.com', '000-0000000'),
('10', 'I', '2', '1', '10I-21', 'Propietario Pendiente', '10I-21', NULL, 'correo@example.com', '000-0000000'),
('10', 'I', '2', '2', '10I-22', 'Propietario Pendiente', '10I-22', NULL, 'correo@example.com', '000-0000000'),
('10', 'I', '2', '3', '10I-23', 'Propietario Pendiente', '10I-23', NULL, 'correo@example.com', '000-0000000'),
('10', 'I', '2', '4', '10I-24', 'Propietario Pendiente', '10I-24', NULL, 'correo@example.com', '000-0000000'),
('10', 'I', '3', '1', '10I-31', 'Propietario Pendiente', '10I-31', NULL, 'correo@example.com', '000-0000000'),
('10', 'I', '3', '2', '10I-32', 'Propietario Pendiente', '10I-32', NULL, 'correo@example.com', '000-0000000'),
('10', 'I', '3', '3', '10I-33', 'Propietario Pendiente', '10I-33', NULL, 'correo@example.com', '000-0000000'),
('10', 'I', '3', '4', '10I-34', 'Propietario Pendiente', '10I-34', NULL, 'correo@example.com', '000-0000000'),
('10', 'I', '4', '1', '10I-41', 'Propietario Pendiente', '10I-41', NULL, 'correo@example.com', '000-0000000'),
('10', 'I', '4', '2', '10I-42', 'Propietario Pendiente', '10I-42', NULL, 'correo@example.com', '000-0000000'),
('10', 'I', '4', '3', '10I-43', 'Propietario Pendiente', '10I-43', NULL, 'correo@example.com', '000-0000000'),
('10', 'I', '4', '4', '10I-44', 'Propietario Pendiente', '10I-44', NULL, 'correo@example.com', '000-0000000'),
('10', 'I', '5', '1', '10I-51', 'Propietario Pendiente', '10I-51', NULL, 'correo@example.com', '000-0000000'),
('10', 'I', '5', '2', '10I-52', 'Propietario Pendiente', '10I-52', NULL, 'correo@example.com', '000-0000000'),
('10', 'I', '5', '3', '10I-53', 'Propietario Pendiente', '10I-53', NULL, 'correo@example.com', '000-0000000'),
('10', 'I', '5', '4', '10I-54', 'Propietario Pendiente', '10I-54', NULL, 'correo@example.com', '000-0000000'),
('10', 'J', '1', '1', '10J-11', 'Propietario Pendiente', '10J-11', NULL, 'correo@example.com', '000-0000000'),
('10', 'J', '1', '2', '10J-12', 'Propietario Pendiente', '10J-12', NULL, 'correo@example.com', '000-0000000'),
('10', 'J', '1', '3', '10J-13', 'Propietario Pendiente', '10J-13', NULL, 'correo@example.com', '000-0000000'),
('10', 'J', '1', '4', '10J-14', 'Propietario Pendiente', '10J-14', NULL, 'correo@example.com', '000-0000000'),
('10', 'J', '2', '1', '10J-21', 'Propietario Pendiente', '10J-21', NULL, 'correo@example.com', '000-0000000'),
('10', 'J', '2', '2', '10J-22', 'Propietario Pendiente', '10J-22', NULL, 'correo@example.com', '000-0000000'),
('10', 'J', '2', '3', '10J-23', 'Propietario Pendiente', '10J-23', NULL, 'correo@example.com', '000-0000000'),
('10', 'J', '2', '4', '10J-24', 'Propietario Pendiente', '10J-24', NULL, 'correo@example.com', '000-0000000'),
('10', 'J', '3', '1', '10J-31', 'Propietario Pendiente', '10J-31', NULL, 'correo@example.com', '000-0000000'),
('10', 'J', '3', '2', '10J-32', 'Propietario Pendiente', '10J-32', NULL, 'correo@example.com', '000-0000000'),
('10', 'J', '3', '3', '10J-33', 'Propietario Pendiente', '10J-33', NULL, 'correo@example.com', '000-0000000'),
('10', 'J', '3', '4', '10J-34', 'Propietario Pendiente', '10J-34', NULL, 'correo@example.com', '000-0000000'),
('10', 'J', '4', '1', '10J-41', 'Propietario Pendiente', '10J-41', NULL, 'correo@example.com', '000-0000000'),
('10', 'J', '4', '2', '10J-42', 'Propietario Pendiente', '10J-42', NULL, 'correo@example.com', '000-0000000'),
('10', 'J', '4', '3', '10J-43', 'Propietario Pendiente', '10J-43', NULL, 'correo@example.com', '000-0000000'),
('10', 'J', '4', '4', '10J-44', 'Propietario Pendiente', '10J-44', NULL, 'correo@example.com', '000-0000000'),
('10', 'J', '5', '1', '10J-51', 'Propietario Pendiente', '10J-51', NULL, 'correo@example.com', '000-0000000'),
('10', 'J', '5', '2', '10J-52', 'Propietario Pendiente', '10J-52', NULL, 'correo@example.com', '000-0000000'),
('10', 'J', '5', '3', '10J-53', 'Propietario Pendiente', '10J-53', NULL, 'correo@example.com', '000-0000000'),
('10', 'J', '5', '4', '10J-54', 'Propietario Pendiente', '10J-54', NULL, 'correo@example.com', '000-0000000'),
('10', 'K', '1', '1', '10K-11', 'Propietario Pendiente', '10K-11', NULL, 'correo@example.com', '000-0000000'),
('10', 'K', '1', '2', '10K-12', 'Propietario Pendiente', '10K-12', NULL, 'correo@example.com', '000-0000000'),
('10', 'K', '1', '3', '10K-13', 'Propietario Pendiente', '10K-13', NULL, 'correo@example.com', '000-0000000'),
('10', 'K', '1', '4', '10K-14', 'Propietario Pendiente', '10K-14', NULL, 'correo@example.com', '000-0000000'),
('10', 'K', '2', '1', '10K-21', 'Propietario Pendiente', '10K-21', NULL, 'correo@example.com', '000-0000000'),
('10', 'K', '2', '2', '10K-22', 'Propietario Pendiente', '10K-22', NULL, 'correo@example.com', '000-0000000'),
('10', 'K', '2', '3', '10K-23', 'Propietario Pendiente', '10K-23', NULL, 'correo@example.com', '000-0000000'),
('10', 'K', '2', '4', '10K-24', 'Propietario Pendiente', '10K-24', NULL, 'correo@example.com', '000-0000000'),
('10', 'K', '3', '1', '10K-31', 'Propietario Pendiente', '10K-31', NULL, 'correo@example.com', '000-0000000'),
('10', 'K', '3', '2', '10K-32', 'Propietario Pendiente', '10K-32', NULL, 'correo@example.com', '000-0000000'),
('10', 'K', '3', '3', '10K-33', 'Propietario Pendiente', '10K-33', NULL, 'correo@example.com', '000-0000000'),
('10', 'K', '3', '4', '10K-34', 'Propietario Pendiente', '10K-34', NULL, 'correo@example.com', '000-0000000'),
('10', 'K', '4', '1', '10K-41', 'Propietario Pendiente', '10K-41', NULL, 'correo@example.com', '000-0000000'),
('10', 'K', '4', '2', '10K-42', 'Propietario Pendiente', '10K-42', NULL, 'correo@example.com', '000-0000000'),
('10', 'K', '4', '3', '10K-43', 'Propietario Pendiente', '10K-43', NULL, 'correo@example.com', '000-0000000'),
('10', 'K', '4', '4', '10K-44', 'Propietario Pendiente', '10K-44', NULL, 'correo@example.com', '000-0000000'),
('10', 'K', '5', '1', '10K-51', 'Propietario Pendiente', '10K-51', NULL, 'correo@example.com', '000-0000000'),
('10', 'K', '5', '2', '10K-52', 'Propietario Pendiente', '10K-52', NULL, 'correo@example.com', '000-0000000'),
('10', 'K', '5', '3', '10K-53', 'Propietario Pendiente', '10K-53', NULL, 'correo@example.com', '000-0000000'),
('10', 'K', '5', '4', '10K-54', 'Propietario Pendiente', '10K-54', NULL, 'correo@example.com', '000-0000000'),
('11', 'A', '1', '1', '11A-11', 'Propietario Pendiente', '11A-11', NULL, 'correo@example.com', '000-0000000'),
('11', 'A', '1', '2', '11A-12', 'Propietario Pendiente', '11A-12', NULL, 'correo@example.com', '000-0000000'),
('11', 'A', '1', '3', '11A-13', 'Propietario Pendiente', '11A-13', NULL, 'correo@example.com', '000-0000000'),
('11', 'A', '1', '4', '11A-14', 'Propietario Pendiente', '11A-14', NULL, 'correo@example.com', '000-0000000'),
('11', 'A', '2', '1', '11A-21', 'Propietario Pendiente', '11A-21', NULL, 'correo@example.com', '000-0000000'),
('11', 'A', '2', '2', '11A-22', 'Propietario Pendiente', '11A-22', NULL, 'correo@example.com', '000-0000000'),
('11', 'A', '2', '3', '11A-23', 'Propietario Pendiente', '11A-23', NULL, 'correo@example.com', '000-0000000'),
('11', 'A', '2', '4', '11A-24', 'Propietario Pendiente', '11A-24', NULL, 'correo@example.com', '000-0000000'),
('11', 'A', '3', '1', '11A-31', 'Propietario Pendiente', '11A-31', NULL, 'correo@example.com', '000-0000000'),
('11', 'A', '3', '2', '11A-32', 'Propietario Pendiente', '11A-32', NULL, 'correo@example.com', '000-0000000'),
('11', 'A', '3', '3', '11A-33', 'Propietario Pendiente', '11A-33', NULL, 'correo@example.com', '000-0000000'),
('11', 'A', '3', '4', '11A-34', 'Propietario Pendiente', '11A-34', NULL, 'correo@example.com', '000-0000000'),
('11', 'A', '4', '1', '11A-41', 'Propietario Pendiente', '11A-41', NULL, 'correo@example.com', '000-0000000'),
('11', 'A', '4', '2', '11A-42', 'Propietario Pendiente', '11A-42', NULL, 'correo@example.com', '000-0000000'),
('11', 'A', '4', '3', '11A-43', 'Propietario Pendiente', '11A-43', NULL, 'correo@example.com', '000-0000000'),
('11', 'A', '4', '4', '11A-44', 'Propietario Pendiente', '11A-44', NULL, 'correo@example.com', '000-0000000'),
('11', 'A', '5', '1', '11A-51', 'Propietario Pendiente', '11A-51', NULL, 'correo@example.com', '000-0000000'),
('11', 'A', '5', '2', '11A-52', 'Propietario Pendiente', '11A-52', NULL, 'correo@example.com', '000-0000000'),
('11', 'A', '5', '3', '11A-53', 'Propietario Pendiente', '11A-53', NULL, 'correo@example.com', '000-0000000'),
('11', 'A', '5', '4', '11A-54', 'Propietario Pendiente', '11A-54', NULL, 'correo@example.com', '000-0000000'),
('11', 'B', '1', '1', '11B-11', 'Propietario Pendiente', '11B-11', NULL, 'correo@example.com', '000-0000000'),
('11', 'B', '1', '2', '11B-12', 'Propietario Pendiente', '11B-12', NULL, 'correo@example.com', '000-0000000'),
('11', 'B', '1', '3', '11B-13', 'Propietario Pendiente', '11B-13', NULL, 'correo@example.com', '000-0000000'),
('11', 'B', '1', '4', '11B-14', 'Propietario Pendiente', '11B-14', NULL, 'correo@example.com', '000-0000000'),
('11', 'B', '2', '1', '11B-21', 'Propietario Pendiente', '11B-21', NULL, 'correo@example.com', '000-0000000'),
('11', 'B', '2', '2', '11B-22', 'Propietario Pendiente', '11B-22', NULL, 'correo@example.com', '000-0000000'),
('11', 'B', '2', '3', '11B-23', 'Propietario Pendiente', '11B-23', NULL, 'correo@example.com', '000-0000000'),
('11', 'B', '2', '4', '11B-24', 'Propietario Pendiente', '11B-24', NULL, 'correo@example.com', '000-0000000'),
('11', 'B', '3', '1', '11B-31', 'Propietario Pendiente', '11B-31', NULL, 'correo@example.com', '000-0000000'),
('11', 'B', '3', '2', '11B-32', 'Propietario Pendiente', '11B-32', NULL, 'correo@example.com', '000-0000000'),
('11', 'B', '3', '3', '11B-33', 'Propietario Pendiente', '11B-33', NULL, 'correo@example.com', '000-0000000'),
('11', 'B', '3', '4', '11B-34', 'Propietario Pendiente', '11B-34', NULL, 'correo@example.com', '000-0000000'),
('11', 'B', '4', '1', '11B-41', 'Propietario Pendiente', '11B-41', NULL, 'correo@example.com', '000-0000000'),
('11', 'B', '4', '2', '11B-42', 'Propietario Pendiente', '11B-42', NULL, 'correo@example.com', '000-0000000'),
('11', 'B', '4', '3', '11B-43', 'Propietario Pendiente', '11B-43', NULL, 'correo@example.com', '000-0000000'),
('11', 'B', '4', '4', '11B-44', 'Propietario Pendiente', '11B-44', NULL, 'correo@example.com', '000-0000000'),
('11', 'B', '5', '1', '11B-51', 'Propietario Pendiente', '11B-51', NULL, 'correo@example.com', '000-0000000'),
('11', 'B', '5', '2', '11B-52', 'Propietario Pendiente', '11B-52', NULL, 'correo@example.com', '000-0000000'),
('11', 'B', '5', '3', '11B-53', 'Propietario Pendiente', '11B-53', NULL, 'correo@example.com', '000-0000000'),
('11', 'B', '5', '4', '11B-54', 'Propietario Pendiente', '11B-54', NULL, 'correo@example.com', '000-0000000'),
('11', 'C', '1', '1', '11C-11', 'Propietario Pendiente', '11C-11', NULL, 'correo@example.com', '000-0000000'),
('11', 'C', '1', '2', '11C-12', 'Propietario Pendiente', '11C-12', NULL, 'correo@example.com', '000-0000000'),
('11', 'C', '1', '3', '11C-13', 'Propietario Pendiente', '11C-13', NULL, 'correo@example.com', '000-0000000'),
('11', 'C', '1', '4', '11C-14', 'Propietario Pendiente', '11C-14', NULL, 'correo@example.com', '000-0000000'),
('11', 'C', '2', '1', '11C-21', 'Propietario Pendiente', '11C-21', NULL, 'correo@example.com', '000-0000000'),
('11', 'C', '2', '2', '11C-22', 'Propietario Pendiente', '11C-22', NULL, 'correo@example.com', '000-0000000'),
('11', 'C', '2', '3', '11C-23', 'Propietario Pendiente', '11C-23', NULL, 'correo@example.com', '000-0000000'),
('11', 'C', '2', '4', '11C-24', 'Propietario Pendiente', '11C-24', NULL, 'correo@example.com', '000-0000000'),
('11', 'C', '3', '1', '11C-31', 'Propietario Pendiente', '11C-31', NULL, 'correo@example.com', '000-0000000'),
('11', 'C', '3', '2', '11C-32', 'Propietario Pendiente', '11C-32', NULL, 'correo@example.com', '000-0000000'),
('11', 'C', '3', '3', '11C-33', 'Propietario Pendiente', '11C-33', NULL, 'correo@example.com', '000-0000000'),
('11', 'C', '3', '4', '11C-34', 'Propietario Pendiente', '11C-34', NULL, 'correo@example.com', '000-0000000'),
('11', 'C', '4', '1', '11C-41', 'Propietario Pendiente', '11C-41', NULL, 'correo@example.com', '000-0000000'),
('11', 'C', '4', '2', '11C-42', 'Propietario Pendiente', '11C-42', NULL, 'correo@example.com', '000-0000000'),
('11', 'C', '4', '3', '11C-43', 'Propietario Pendiente', '11C-43', NULL, 'correo@example.com', '000-0000000'),
('11', 'C', '4', '4', '11C-44', 'Propietario Pendiente', '11C-44', NULL, 'correo@example.com', '000-0000000'),
('11', 'C', '5', '1', '11C-51', 'Propietario Pendiente', '11C-51', NULL, 'correo@example.com', '000-0000000'),
('11', 'C', '5', '2', '11C-52', 'Propietario Pendiente', '11C-52', NULL, 'correo@example.com', '000-0000000'),
('11', 'C', '5', '3', '11C-53', 'Propietario Pendiente', '11C-53', NULL, 'correo@example.com', '000-0000000'),
('11', 'C', '5', '4', '11C-54', 'Propietario Pendiente', '11C-54', NULL, 'correo@example.com', '000-0000000'),
('11', 'D', '1', '1', '11D-11', 'Propietario Pendiente', '11D-11', NULL, 'correo@example.com', '000-0000000'),
('11', 'D', '1', '2', '11D-12', 'Propietario Pendiente', '11D-12', NULL, 'correo@example.com', '000-0000000'),
('11', 'D', '1', '3', '11D-13', 'Propietario Pendiente', '11D-13', NULL, 'correo@example.com', '000-0000000'),
('11', 'D', '1', '4', '11D-14', 'Propietario Pendiente', '11D-14', NULL, 'correo@example.com', '000-0000000'),
('11', 'D', '2', '1', '11D-21', 'Propietario Pendiente', '11D-21', NULL, 'correo@example.com', '000-0000000'),
('11', 'D', '2', '2', '11D-22', 'Propietario Pendiente', '11D-22', NULL, 'correo@example.com', '000-0000000'),
('11', 'D', '2', '3', '11D-23', 'Propietario Pendiente', '11D-23', NULL, 'correo@example.com', '000-0000000'),
('11', 'D', '2', '4', '11D-24', 'Propietario Pendiente', '11D-24', NULL, 'correo@example.com', '000-0000000'),
('11', 'D', '3', '1', '11D-31', 'Propietario Pendiente', '11D-31', NULL, 'correo@example.com', '000-0000000'),
('11', 'D', '3', '2', '11D-32', 'Propietario Pendiente', '11D-32', NULL, 'correo@example.com', '000-0000000'),
('11', 'D', '3', '3', '11D-33', 'Propietario Pendiente', '11D-33', NULL, 'correo@example.com', '000-0000000'),
('11', 'D', '3', '4', '11D-34', 'Propietario Pendiente', '11D-34', NULL, 'correo@example.com', '000-0000000'),
('11', 'D', '4', '1', '11D-41', 'Propietario Pendiente', '11D-41', NULL, 'correo@example.com', '000-0000000'),
('11', 'D', '4', '2', '11D-42', 'Propietario Pendiente', '11D-42', NULL, 'correo@example.com', '000-0000000'),
('11', 'D', '4', '3', '11D-43', 'Propietario Pendiente', '11D-43', NULL, 'correo@example.com', '000-0000000'),
('11', 'D', '4', '4', '11D-44', 'Propietario Pendiente', '11D-44', NULL, 'correo@example.com', '000-0000000'),
('11', 'D', '5', '1', '11D-51', 'Propietario Pendiente', '11D-51', NULL, 'correo@example.com', '000-0000000'),
('11', 'D', '5', '2', '11D-52', 'Propietario Pendiente', '11D-52', NULL, 'correo@example.com', '000-0000000'),
('11', 'D', '5', '3', '11D-53', 'Propietario Pendiente', '11D-53', NULL, 'correo@example.com', '000-0000000'),
('11', 'D', '5', '4', '11D-54', 'Propietario Pendiente', '11D-54', NULL, 'correo@example.com', '000-0000000'),
('11', 'E', '1', '1', '11E-11', 'Propietario Pendiente', '11E-11', NULL, 'correo@example.com', '000-0000000'),
('11', 'E', '1', '2', '11E-12', 'Propietario Pendiente', '11E-12', NULL, 'correo@example.com', '000-0000000'),
('11', 'E', '1', '3', '11E-13', 'Propietario Pendiente', '11E-13', NULL, 'correo@example.com', '000-0000000'),
('11', 'E', '1', '4', '11E-14', 'Propietario Pendiente', '11E-14', NULL, 'correo@example.com', '000-0000000'),
('11', 'E', '2', '1', '11E-21', 'Propietario Pendiente', '11E-21', NULL, 'correo@example.com', '000-0000000'),
('11', 'E', '2', '2', '11E-22', 'Propietario Pendiente', '11E-22', NULL, 'correo@example.com', '000-0000000'),
('11', 'E', '2', '3', '11E-23', 'Propietario Pendiente', '11E-23', NULL, 'correo@example.com', '000-0000000'),
('11', 'E', '2', '4', '11E-24', 'Propietario Pendiente', '11E-24', NULL, 'correo@example.com', '000-0000000'),
('11', 'E', '3', '1', '11E-31', 'Propietario Pendiente', '11E-31', NULL, 'correo@example.com', '000-0000000'),
('11', 'E', '3', '2', '11E-32', 'Propietario Pendiente', '11E-32', NULL, 'correo@example.com', '000-0000000'),
('11', 'E', '3', '3', '11E-33', 'Propietario Pendiente', '11E-33', NULL, 'correo@example.com', '000-0000000'),
('11', 'E', '3', '4', '11E-34', 'Propietario Pendiente', '11E-34', NULL, 'correo@example.com', '000-0000000'),
('11', 'E', '4', '1', '11E-41', 'Propietario Pendiente', '11E-41', NULL, 'correo@example.com', '000-0000000'),
('11', 'E', '4', '2', '11E-42', 'Propietario Pendiente', '11E-42', NULL, 'correo@example.com', '000-0000000'),
('11', 'E', '4', '3', '11E-43', 'Propietario Pendiente', '11E-43', NULL, 'correo@example.com', '000-0000000'),
('11', 'E', '4', '4', '11E-44', 'Propietario Pendiente', '11E-44', NULL, 'correo@example.com', '000-0000000'),
('11', 'E', '5', '1', '11E-51', 'Propietario Pendiente', '11E-51', NULL, 'correo@example.com', '000-0000000'),
('11', 'E', '5', '2', '11E-52', 'Propietario Pendiente', '11E-52', NULL, 'correo@example.com', '000-0000000'),
('11', 'E', '5', '3', '11E-53', 'Propietario Pendiente', '11E-53', NULL, 'correo@example.com', '000-0000000'),
('11', 'E', '5', '4', '11E-54', 'Propietario Pendiente', '11E-54', NULL, 'correo@example.com', '000-0000000'),
('11', 'F', '1', '1', '11F-11', 'Propietario Pendiente', '11F-11', NULL, 'correo@example.com', '000-0000000'),
('11', 'F', '1', '2', '11F-12', 'Propietario Pendiente', '11F-12', NULL, 'correo@example.com', '000-0000000'),
('11', 'F', '1', '3', '11F-13', 'Propietario Pendiente', '11F-13', NULL, 'correo@example.com', '000-0000000'),
('11', 'F', '1', '4', '11F-14', 'Propietario Pendiente', '11F-14', NULL, 'correo@example.com', '000-0000000'),
('11', 'F', '2', '1', '11F-21', 'Propietario Pendiente', '11F-21', NULL, 'correo@example.com', '000-0000000'),
('11', 'F', '2', '2', '11F-22', 'Propietario Pendiente', '11F-22', NULL, 'correo@example.com', '000-0000000'),
('11', 'F', '2', '3', '11F-23', 'Propietario Pendiente', '11F-23', NULL, 'correo@example.com', '000-0000000'),
('11', 'F', '2', '4', '11F-24', 'Propietario Pendiente', '11F-24', NULL, 'correo@example.com', '000-0000000'),
('11', 'F', '3', '1', '11F-31', 'Propietario Pendiente', '11F-31', NULL, 'correo@example.com', '000-0000000'),
('11', 'F', '3', '2', '11F-32', 'Propietario Pendiente', '11F-32', NULL, 'correo@example.com', '000-0000000'),
('11', 'F', '3', '3', '11F-33', 'Propietario Pendiente', '11F-33', NULL, 'correo@example.com', '000-0000000'),
('11', 'F', '3', '4', '11F-34', 'Propietario Pendiente', '11F-34', NULL, 'correo@example.com', '000-0000000'),
('11', 'F', '4', '1', '11F-41', 'Propietario Pendiente', '11F-41', NULL, 'correo@example.com', '000-0000000'),
('11', 'F', '4', '2', '11F-42', 'Propietario Pendiente', '11F-42', NULL, 'correo@example.com', '000-0000000'),
('11', 'F', '4', '3', '11F-43', 'Propietario Pendiente', '11F-43', NULL, 'correo@example.com', '000-0000000'),
('11', 'F', '4', '4', '11F-44', 'Propietario Pendiente', '11F-44', NULL, 'correo@example.com', '000-0000000'),
('11', 'F', '5', '1', '11F-51', 'Propietario Pendiente', '11F-51', NULL, 'correo@example.com', '000-0000000'),
('11', 'F', '5', '2', '11F-52', 'Propietario Pendiente', '11F-52', NULL, 'correo@example.com', '000-0000000'),
('11', 'F', '5', '3', '11F-53', 'Propietario Pendiente', '11F-53', NULL, 'correo@example.com', '000-0000000'),
('11', 'F', '5', '4', '11F-54', 'Propietario Pendiente', '11F-54', NULL, 'correo@example.com', '000-0000000'),
('12', 'A', '1', '1', '12A-11', 'Propietario Pendiente', '12A-11', NULL, 'correo@example.com', '000-0000000'),
('12', 'A', '1', '2', '12A-12', 'Propietario Pendiente', '12A-12', NULL, 'correo@example.com', '000-0000000'),
('12', 'A', '1', '3', '12A-13', 'Propietario Pendiente', '12A-13', NULL, 'correo@example.com', '000-0000000'),
('12', 'A', '1', '4', '12A-14', 'Propietario Pendiente', '12A-14', NULL, 'correo@example.com', '000-0000000'),
('12', 'A', '2', '1', '12A-21', 'Propietario Pendiente', '12A-21', NULL, 'correo@example.com', '000-0000000'),
('12', 'A', '2', '2', '12A-22', 'Propietario Pendiente', '12A-22', NULL, 'correo@example.com', '000-0000000'),
('12', 'A', '2', '3', '12A-23', 'Propietario Pendiente', '12A-23', NULL, 'correo@example.com', '000-0000000'),
('12', 'A', '2', '4', '12A-24', 'Propietario Pendiente', '12A-24', NULL, 'correo@example.com', '000-0000000'),
('12', 'A', '3', '1', '12A-31', 'Propietario Pendiente', '12A-31', NULL, 'correo@example.com', '000-0000000'),
('12', 'A', '3', '2', '12A-32', 'Propietario Pendiente', '12A-32', NULL, 'correo@example.com', '000-0000000'),
('12', 'A', '3', '3', '12A-33', 'Propietario Pendiente', '12A-33', NULL, 'correo@example.com', '000-0000000'),
('12', 'A', '3', '4', '12A-34', 'Propietario Pendiente', '12A-34', NULL, 'correo@example.com', '000-0000000'),
('12', 'A', '4', '1', '12A-41', 'Propietario Pendiente', '12A-41', NULL, 'correo@example.com', '000-0000000'),
('12', 'A', '4', '2', '12A-42', 'Propietario Pendiente', '12A-42', NULL, 'correo@example.com', '000-0000000'),
('12', 'A', '4', '3', '12A-43', 'Propietario Pendiente', '12A-43', NULL, 'correo@example.com', '000-0000000'),
('12', 'A', '4', '4', '12A-44', 'Propietario Pendiente', '12A-44', NULL, 'correo@example.com', '000-0000000'),
('12', 'A', '5', '1', '12A-51', 'Propietario Pendiente', '12A-51', NULL, 'correo@example.com', '000-0000000'),
('12', 'A', '5', '2', '12A-52', 'Propietario Pendiente', '12A-52', NULL, 'correo@example.com', '000-0000000'),
('12', 'A', '5', '3', '12A-53', 'Propietario Pendiente', '12A-53', NULL, 'correo@example.com', '000-0000000'),
('12', 'A', '5', '4', '12A-54', 'Propietario Pendiente', '12A-54', NULL, 'correo@example.com', '000-0000000'),
('12', 'B', '1', '1', '12B-11', 'Propietario Pendiente', '12B-11', NULL, 'correo@example.com', '000-0000000'),
('12', 'B', '1', '2', '12B-12', 'Propietario Pendiente', '12B-12', NULL, 'correo@example.com', '000-0000000'),
('12', 'B', '1', '3', '12B-13', 'Propietario Pendiente', '12B-13', NULL, 'correo@example.com', '000-0000000'),
('12', 'B', '1', '4', '12B-14', 'Propietario Pendiente', '12B-14', NULL, 'correo@example.com', '000-0000000'),
('12', 'B', '2', '1', '12B-21', 'Propietario Pendiente', '12B-21', NULL, 'correo@example.com', '000-0000000'),
('12', 'B', '2', '2', '12B-22', 'Propietario Pendiente', '12B-22', NULL, 'correo@example.com', '000-0000000'),
('12', 'B', '2', '3', '12B-23', 'Propietario Pendiente', '12B-23', NULL, 'correo@example.com', '000-0000000'),
('12', 'B', '2', '4', '12B-24', 'Propietario Pendiente', '12B-24', NULL, 'correo@example.com', '000-0000000'),
('12', 'B', '3', '1', '12B-31', 'Propietario Pendiente', '12B-31', NULL, 'correo@example.com', '000-0000000'),
('12', 'B', '3', '2', '12B-32', 'Propietario Pendiente', '12B-32', NULL, 'correo@example.com', '000-0000000'),
('12', 'B', '3', '3', '12B-33', 'Propietario Pendiente', '12B-33', NULL, 'correo@example.com', '000-0000000'),
('12', 'B', '3', '4', '12B-34', 'Propietario Pendiente', '12B-34', NULL, 'correo@example.com', '000-0000000'),
('12', 'B', '4', '1', '12B-41', 'Propietario Pendiente', '12B-41', NULL, 'correo@example.com', '000-0000000'),
('12', 'B', '4', '2', '12B-42', 'Propietario Pendiente', '12B-42', NULL, 'correo@example.com', '000-0000000'),
('12', 'B', '4', '3', '12B-43', 'Propietario Pendiente', '12B-43', NULL, 'correo@example.com', '000-0000000'),
('12', 'B', '4', '4', '12B-44', 'Propietario Pendiente', '12B-44', NULL, 'correo@example.com', '000-0000000'),
('12', 'B', '5', '1', '12B-51', 'Propietario Pendiente', '12B-51', NULL, 'correo@example.com', '000-0000000'),
('12', 'B', '5', '2', '12B-52', 'Propietario Pendiente', '12B-52', NULL, 'correo@example.com', '000-0000000'),
('12', 'B', '5', '3', '12B-53', 'Propietario Pendiente', '12B-53', NULL, 'correo@example.com', '000-0000000'),
('12', 'B', '5', '4', '12B-54', 'Propietario Pendiente', '12B-54', NULL, 'correo@example.com', '000-0000000'),
('12', 'C', '1', '1', '12C-11', 'Propietario Pendiente', '12C-11', NULL, 'correo@example.com', '000-0000000'),
('12', 'C', '1', '2', '12C-12', 'Propietario Pendiente', '12C-12', NULL, 'correo@example.com', '000-0000000'),
('12', 'C', '1', '3', '12C-13', 'Propietario Pendiente', '12C-13', NULL, 'correo@example.com', '000-0000000'),
('12', 'C', '1', '4', '12C-14', 'Propietario Pendiente', '12C-14', NULL, 'correo@example.com', '000-0000000'),
('12', 'C', '2', '1', '12C-21', 'Propietario Pendiente', '12C-21', NULL, 'correo@example.com', '000-0000000'),
('12', 'C', '2', '2', '12C-22', 'Propietario Pendiente', '12C-22', NULL, 'correo@example.com', '000-0000000'),
('12', 'C', '2', '3', '12C-23', 'Propietario Pendiente', '12C-23', NULL, 'correo@example.com', '000-0000000'),
('12', 'C', '2', '4', '12C-24', 'Propietario Pendiente', '12C-24', NULL, 'correo@example.com', '000-0000000'),
('12', 'C', '3', '1', '12C-31', 'Propietario Pendiente', '12C-31', NULL, 'correo@example.com', '000-0000000'),
('12', 'C', '3', '2', '12C-32', 'Propietario Pendiente', '12C-32', NULL, 'correo@example.com', '000-0000000'),
('12', 'C', '3', '3', '12C-33', 'Propietario Pendiente', '12C-33', NULL, 'correo@example.com', '000-0000000'),
('12', 'C', '3', '4', '12C-34', 'Propietario Pendiente', '12C-34', NULL, 'correo@example.com', '000-0000000'),
('12', 'C', '4', '1', '12C-41', 'Propietario Pendiente', '12C-41', NULL, 'correo@example.com', '000-0000000'),
('12', 'C', '4', '2', '12C-42', 'Propietario Pendiente', '12C-42', NULL, 'correo@example.com', '000-0000000'),
('12', 'C', '4', '3', '12C-43', 'Propietario Pendiente', '12C-43', NULL, 'correo@example.com', '000-0000000'),
('12', 'C', '4', '4', '12C-44', 'Propietario Pendiente', '12C-44', NULL, 'correo@example.com', '000-0000000'),
('12', 'C', '5', '1', '12C-51', 'Propietario Pendiente', '12C-51', NULL, 'correo@example.com', '000-0000000'),
('12', 'C', '5', '2', '12C-52', 'Propietario Pendiente', '12C-52', NULL, 'correo@example.com', '000-0000000'),
('12', 'C', '5', '3', '12C-53', 'Propietario Pendiente', '12C-53', NULL, 'correo@example.com', '000-0000000'),
('12', 'C', '5', '4', '12C-54', 'Propietario Pendiente', '12C-54', NULL, 'correo@example.com', '000-0000000'),
('12', 'D', '1', '1', '12D-11', 'Propietario Pendiente', '12D-11', NULL, 'correo@example.com', '000-0000000'),
('12', 'D', '1', '2', '12D-12', 'Propietario Pendiente', '12D-12', NULL, 'correo@example.com', '000-0000000'),
('12', 'D', '1', '3', '12D-13', 'Propietario Pendiente', '12D-13', NULL, 'correo@example.com', '000-0000000'),
('12', 'D', '1', '4', '12D-14', 'Propietario Pendiente', '12D-14', NULL, 'correo@example.com', '000-0000000'),
('12', 'D', '2', '1', '12D-21', 'Propietario Pendiente', '12D-21', NULL, 'correo@example.com', '000-0000000'),
('12', 'D', '2', '2', '12D-22', 'Propietario Pendiente', '12D-22', NULL, 'correo@example.com', '000-0000000'),
('12', 'D', '2', '3', '12D-23', 'Propietario Pendiente', '12D-23', NULL, 'correo@example.com', '000-0000000'),
('12', 'D', '2', '4', '12D-24', 'Propietario Pendiente', '12D-24', NULL, 'correo@example.com', '000-0000000'),
('12', 'D', '3', '1', '12D-31', 'Propietario Pendiente', '12D-31', NULL, 'correo@example.com', '000-0000000'),
('12', 'D', '3', '2', '12D-32', 'Propietario Pendiente', '12D-32', NULL, 'correo@example.com', '000-0000000'),
('12', 'D', '3', '3', '12D-33', 'Propietario Pendiente', '12D-33', NULL, 'correo@example.com', '000-0000000'),
('12', 'D', '3', '4', '12D-34', 'Propietario Pendiente', '12D-34', NULL, 'correo@example.com', '000-0000000'),
('12', 'D', '4', '1', '12D-41', 'Propietario Pendiente', '12D-41', NULL, 'correo@example.com', '000-0000000'),
('12', 'D', '4', '2', '12D-42', 'Propietario Pendiente', '12D-42', NULL, 'correo@example.com', '000-0000000'),
('12', 'D', '4', '3', '12D-43', 'Propietario Pendiente', '12D-43', NULL, 'correo@example.com', '000-0000000'),
('12', 'D', '4', '4', '12D-44', 'Propietario Pendiente', '12D-44', NULL, 'correo@example.com', '000-0000000'),
('12', 'D', '5', '1', '12D-51', 'Propietario Pendiente', '12D-51', NULL, 'correo@example.com', '000-0000000'),
('12', 'D', '5', '2', '12D-52', 'Propietario Pendiente', '12D-52', NULL, 'correo@example.com', '000-0000000'),
('12', 'D', '5', '3', '12D-53', 'Propietario Pendiente', '12D-53', NULL, 'correo@example.com', '000-0000000'),
('12', 'D', '5', '4', '12D-54', 'Propietario Pendiente', '12D-54', NULL, 'correo@example.com', '000-0000000'),
('13', 'A', '1', '1', '13A-11', 'Pedro Pascal', '$2y$10$at5wtlPACrQUEJM7rCUbx.p3L7iKvt3D2S6mnIcNAOSkuX4Pui8f2', NULL, 'pedropascal@gmail.com', '04168288065'),
('13', 'A', '1', '2', '13A-12', 'Propietario Pendiente', '13A-12', NULL, 'correo@example.com', '000-0000000'),
('13', 'A', '1', '3', '13A-13', 'Propietario Pendiente', '13A-13', NULL, 'correo@example.com', '000-0000000'),
('13', 'A', '1', '4', '13A-14', 'Propietario Pendiente', '13A-14', NULL, 'correo@example.com', '000-0000000'),
('13', 'A', '2', '1', '13A-21', 'Propietario Pendiente', '13A-21', NULL, 'correo@example.com', '000-0000000'),
('13', 'A', '2', '2', '13A-22', 'Propietario Pendiente', '13A-22', NULL, 'correo@example.com', '000-0000000'),
('13', 'A', '2', '3', '13A-23', 'Propietario Pendiente', '13A-23', NULL, 'correo@example.com', '000-0000000'),
('13', 'A', '2', '4', '13A-24', 'Propietario Pendiente', '13A-24', NULL, 'correo@example.com', '000-0000000'),
('13', 'A', '3', '1', '13A-31', 'Propietario Pendiente', '13A-31', NULL, 'correo@example.com', '000-0000000'),
('13', 'A', '3', '2', '13A-32', 'Propietario Pendiente', '13A-32', NULL, 'correo@example.com', '000-0000000'),
('13', 'A', '3', '3', '13A-33', 'Propietario Pendiente', '13A-33', NULL, 'correo@example.com', '000-0000000'),
('13', 'A', '3', '4', '13A-34', 'Propietario Pendiente', '13A-34', NULL, 'correo@example.com', '000-0000000'),
('13', 'A', '4', '1', '13A-41', 'Propietario Pendiente', '13A-41', NULL, 'correo@example.com', '000-0000000'),
('13', 'A', '4', '2', '13A-42', 'Propietario Pendiente', '13A-42', NULL, 'correo@example.com', '000-0000000'),
('13', 'A', '4', '3', '13A-43', 'Propietario Pendiente', '13A-43', NULL, 'correo@example.com', '000-0000000'),
('13', 'A', '4', '4', '13A-44', 'Propietario Pendiente', '13A-44', NULL, 'correo@example.com', '000-0000000'),
('13', 'A', '5', '1', '13A-51', 'Propietario Pendiente', '13A-51', NULL, 'correo@example.com', '000-0000000'),
('13', 'A', '5', '2', '13A-52', 'Propietario Pendiente', '13A-52', NULL, 'correo@example.com', '000-0000000'),
('13', 'A', '5', '3', '13A-53', 'Propietario Pendiente', '13A-53', NULL, 'correo@example.com', '000-0000000'),
('13', 'A', '5', '4', '13A-54', 'Propietario Pendiente', '13A-54', NULL, 'correo@example.com', '000-0000000'),
('13', 'B', '1', '1', '13B-11', 'Propietario Pendiente', '13B-11', NULL, 'correo@example.com', '000-0000000'),
('13', 'B', '1', '2', '13B-12', 'Propietario Pendiente', '13B-12', NULL, 'correo@example.com', '000-0000000'),
('13', 'B', '1', '3', '13B-13', 'Propietario Pendiente', '13B-13', NULL, 'correo@example.com', '000-0000000'),
('13', 'B', '1', '4', '13B-14', 'Propietario Pendiente', '13B-14', NULL, 'correo@example.com', '000-0000000'),
('13', 'B', '2', '1', '13B-21', 'Propietario Pendiente', '13B-21', NULL, 'correo@example.com', '000-0000000'),
('13', 'B', '2', '2', '13B-22', 'Propietario Pendiente', '13B-22', NULL, 'correo@example.com', '000-0000000'),
('13', 'B', '2', '3', '13B-23', 'Propietario Pendiente', '13B-23', NULL, 'correo@example.com', '000-0000000'),
('13', 'B', '2', '4', '13B-24', 'Propietario Pendiente', '13B-24', NULL, 'correo@example.com', '000-0000000'),
('13', 'B', '3', '1', '13B-31', 'Propietario Pendiente', '13B-31', NULL, 'correo@example.com', '000-0000000'),
('13', 'B', '3', '2', '13B-32', 'Propietario Pendiente', '13B-32', NULL, 'correo@example.com', '000-0000000'),
('13', 'B', '3', '3', '13B-33', 'Propietario Pendiente', '13B-33', NULL, 'correo@example.com', '000-0000000'),
('13', 'B', '3', '4', '13B-34', 'Propietario Pendiente', '13B-34', NULL, 'correo@example.com', '000-0000000'),
('13', 'B', '4', '1', '13B-41', 'Propietario Pendiente', '13B-41', NULL, 'correo@example.com', '000-0000000'),
('13', 'B', '4', '2', '13B-42', 'Propietario Pendiente', '13B-42', NULL, 'correo@example.com', '000-0000000'),
('13', 'B', '4', '3', '13B-43', 'Propietario Pendiente', '13B-43', NULL, 'correo@example.com', '000-0000000');
INSERT INTO `edificios` (`Terraza`, `Edificio`, `Piso`, `Apartamento`, `usuario`, `nombre_completo`, `password`, `ultima_modificacion`, `correo`, `telefono`) VALUES
('13', 'B', '4', '4', '13B-44', 'Propietario Pendiente', '13B-44', NULL, 'correo@example.com', '000-0000000'),
('13', 'B', '5', '1', '13B-51', 'Propietario Pendiente', '13B-51', NULL, 'correo@example.com', '000-0000000'),
('13', 'B', '5', '2', '13B-52', 'Propietario Pendiente', '13B-52', NULL, 'correo@example.com', '000-0000000'),
('13', 'B', '5', '3', '13B-53', 'Propietario Pendiente', '13B-53', NULL, 'correo@example.com', '000-0000000'),
('13', 'B', '5', '4', '13B-54', 'Propietario Pendiente', '13B-54', NULL, 'correo@example.com', '000-0000000'),
('13', 'C', '1', '1', '13C-11', 'Propietario Pendiente', '13C-11', NULL, 'correo@example.com', '000-0000000'),
('13', 'C', '1', '2', '13C-12', 'Propietario Pendiente', '13C-12', NULL, 'correo@example.com', '000-0000000'),
('13', 'C', '1', '3', '13C-13', 'Propietario Pendiente', '13C-13', NULL, 'correo@example.com', '000-0000000'),
('13', 'C', '1', '4', '13C-14', 'Propietario Pendiente', '13C-14', NULL, 'correo@example.com', '000-0000000'),
('13', 'C', '2', '1', '13C-21', 'Propietario Pendiente', '13C-21', NULL, 'correo@example.com', '000-0000000'),
('13', 'C', '2', '2', '13C-22', 'Propietario Pendiente', '13C-22', NULL, 'correo@example.com', '000-0000000'),
('13', 'C', '2', '3', '13C-23', 'Propietario Pendiente', '13C-23', NULL, 'correo@example.com', '000-0000000'),
('13', 'C', '2', '4', '13C-24', 'Propietario Pendiente', '13C-24', NULL, 'correo@example.com', '000-0000000'),
('13', 'C', '3', '1', '13C-31', 'Propietario Pendiente', '13C-31', NULL, 'correo@example.com', '000-0000000'),
('13', 'C', '3', '2', '13C-32', 'Propietario Pendiente', '13C-32', NULL, 'correo@example.com', '000-0000000'),
('13', 'C', '3', '3', '13C-33', 'Propietario Pendiente', '13C-33', NULL, 'correo@example.com', '000-0000000'),
('13', 'C', '3', '4', '13C-34', 'Propietario Pendiente', '13C-34', NULL, 'correo@example.com', '000-0000000'),
('13', 'C', '4', '1', '13C-41', 'Propietario Pendiente', '13C-41', NULL, 'correo@example.com', '000-0000000'),
('13', 'C', '4', '2', '13C-42', 'Propietario Pendiente', '13C-42', NULL, 'correo@example.com', '000-0000000'),
('13', 'C', '4', '3', '13C-43', 'Propietario Pendiente', '13C-43', NULL, 'correo@example.com', '000-0000000'),
('13', 'C', '4', '4', '13C-44', 'Propietario Pendiente', '13C-44', NULL, 'correo@example.com', '000-0000000'),
('13', 'C', '5', '1', '13C-51', 'Propietario Pendiente', '13C-51', NULL, 'correo@example.com', '000-0000000'),
('13', 'C', '5', '2', '13C-52', 'Propietario Pendiente', '13C-52', NULL, 'correo@example.com', '000-0000000'),
('13', 'C', '5', '3', '13C-53', 'Propietario Pendiente', '13C-53', NULL, 'correo@example.com', '000-0000000'),
('13', 'C', '5', '4', '13C-54', 'Propietario Pendiente', '13C-54', NULL, 'correo@example.com', '000-0000000'),
('13', 'D', '1', '1', '13D-11', 'Propietario Pendiente', '13D-11', NULL, 'correo@example.com', '000-0000000'),
('13', 'D', '1', '2', '13D-12', 'Propietario Pendiente', '13D-12', NULL, 'correo@example.com', '000-0000000'),
('13', 'D', '1', '3', '13D-13', 'Propietario Pendiente', '13D-13', NULL, 'correo@example.com', '000-0000000'),
('13', 'D', '1', '4', '13D-14', 'Propietario Pendiente', '13D-14', NULL, 'correo@example.com', '000-0000000'),
('13', 'D', '2', '1', '13D-21', 'Propietario Pendiente', '13D-21', NULL, 'correo@example.com', '000-0000000'),
('13', 'D', '2', '2', '13D-22', 'Propietario Pendiente', '13D-22', NULL, 'correo@example.com', '000-0000000'),
('13', 'D', '2', '3', '13D-23', 'Propietario Pendiente', '13D-23', NULL, 'correo@example.com', '000-0000000'),
('13', 'D', '2', '4', '13D-24', 'Propietario Pendiente', '13D-24', NULL, 'correo@example.com', '000-0000000'),
('13', 'D', '3', '1', '13D-31', 'Propietario Pendiente', '13D-31', NULL, 'correo@example.com', '000-0000000'),
('13', 'D', '3', '2', '13D-32', 'Propietario Pendiente', '13D-32', NULL, 'correo@example.com', '000-0000000'),
('13', 'D', '3', '3', '13D-33', 'Propietario Pendiente', '13D-33', NULL, 'correo@example.com', '000-0000000'),
('13', 'D', '3', '4', '13D-34', 'Propietario Pendiente', '13D-34', NULL, 'correo@example.com', '000-0000000'),
('13', 'D', '4', '1', '13D-41', 'Propietario Pendiente', '13D-41', NULL, 'correo@example.com', '000-0000000'),
('13', 'D', '4', '2', '13D-42', 'Propietario Pendiente', '13D-42', NULL, 'correo@example.com', '000-0000000'),
('13', 'D', '4', '3', '13D-43', 'Propietario Pendiente', '13D-43', NULL, 'correo@example.com', '000-0000000'),
('13', 'D', '4', '4', '13D-44', 'Propietario Pendiente', '13D-44', NULL, 'correo@example.com', '000-0000000'),
('13', 'D', '5', '1', '13D-51', 'Propietario Pendiente', '13D-51', NULL, 'correo@example.com', '000-0000000'),
('13', 'D', '5', '2', '13D-52', 'Propietario Pendiente', '13D-52', NULL, 'correo@example.com', '000-0000000'),
('13', 'D', '5', '3', '13D-53', 'Propietario Pendiente', '13D-53', NULL, 'correo@example.com', '000-0000000'),
('13', 'D', '5', '4', '13D-54', 'Propietario Pendiente', '13D-54', NULL, 'correo@example.com', '000-0000000'),
('13', 'E', '1', '1', '13E-11', 'Propietario Pendiente', '13E-11', NULL, 'correo@example.com', '000-0000000'),
('13', 'E', '1', '2', '13E-12', 'Propietario Pendiente', '13E-12', NULL, 'correo@example.com', '000-0000000'),
('13', 'E', '1', '3', '13E-13', 'Propietario Pendiente', '13E-13', NULL, 'correo@example.com', '000-0000000'),
('13', 'E', '1', '4', '13E-14', 'Propietario Pendiente', '13E-14', NULL, 'correo@example.com', '000-0000000'),
('13', 'E', '2', '1', '13E-21', 'Propietario Pendiente', '13E-21', NULL, 'correo@example.com', '000-0000000'),
('13', 'E', '2', '2', '13E-22', 'Propietario Pendiente', '13E-22', NULL, 'correo@example.com', '000-0000000'),
('13', 'E', '2', '3', '13E-23', 'Propietario Pendiente', '13E-23', NULL, 'correo@example.com', '000-0000000'),
('13', 'E', '2', '4', '13E-24', 'Propietario Pendiente', '13E-24', NULL, 'correo@example.com', '000-0000000'),
('13', 'E', '3', '1', '13E-31', 'Propietario Pendiente', '13E-31', NULL, 'correo@example.com', '000-0000000'),
('13', 'E', '3', '2', '13E-32', 'Propietario Pendiente', '13E-32', NULL, 'correo@example.com', '000-0000000'),
('13', 'E', '3', '3', '13E-33', 'Propietario Pendiente', '13E-33', NULL, 'correo@example.com', '000-0000000'),
('13', 'E', '3', '4', '13E-34', 'Propietario Pendiente', '13E-34', NULL, 'correo@example.com', '000-0000000'),
('13', 'E', '4', '1', '13E-41', 'Propietario Pendiente', '13E-41', NULL, 'correo@example.com', '000-0000000'),
('13', 'E', '4', '2', '13E-42', 'Propietario Pendiente', '13E-42', NULL, 'correo@example.com', '000-0000000'),
('13', 'E', '4', '3', '13E-43', 'Propietario Pendiente', '13E-43', NULL, 'correo@example.com', '000-0000000'),
('13', 'E', '4', '4', '13E-44', 'Propietario Pendiente', '13E-44', NULL, 'correo@example.com', '000-0000000'),
('13', 'E', '5', '1', '13E-51', 'Propietario Pendiente', '13E-51', NULL, 'correo@example.com', '000-0000000'),
('13', 'E', '5', '2', '13E-52', 'Propietario Pendiente', '13E-52', NULL, 'correo@example.com', '000-0000000'),
('13', 'E', '5', '3', '13E-53', 'Propietario Pendiente', '13E-53', NULL, 'correo@example.com', '000-0000000'),
('13', 'E', '5', '4', '13E-54', 'Propietario Pendiente', '13E-54', NULL, 'correo@example.com', '000-0000000'),
('13', 'F', '1', '1', '13F-11', 'Propietario Pendiente', '13F-11', NULL, 'correo@example.com', '000-0000000'),
('13', 'F', '1', '2', '13F-12', 'Propietario Pendiente', '13F-12', NULL, 'correo@example.com', '000-0000000'),
('13', 'F', '1', '3', '13F-13', 'Propietario Pendiente', '13F-13', NULL, 'correo@example.com', '000-0000000'),
('13', 'F', '1', '4', '13F-14', 'Propietario Pendiente', '13F-14', NULL, 'correo@example.com', '000-0000000'),
('13', 'F', '2', '1', '13F-21', 'Propietario Pendiente', '13F-21', NULL, 'correo@example.com', '000-0000000'),
('13', 'F', '2', '2', '13F-22', 'Propietario Pendiente', '13F-22', NULL, 'correo@example.com', '000-0000000'),
('13', 'F', '2', '3', '13F-23', 'Propietario Pendiente', '13F-23', NULL, 'correo@example.com', '000-0000000'),
('13', 'F', '2', '4', '13F-24', 'Propietario Pendiente', '13F-24', NULL, 'correo@example.com', '000-0000000'),
('13', 'F', '3', '1', '13F-31', 'Propietario Pendiente', '13F-31', NULL, 'correo@example.com', '000-0000000'),
('13', 'F', '3', '2', '13F-32', 'Propietario Pendiente', '13F-32', NULL, 'correo@example.com', '000-0000000'),
('13', 'F', '3', '3', '13F-33', 'Propietario Pendiente', '13F-33', NULL, 'correo@example.com', '000-0000000'),
('13', 'F', '3', '4', '13F-34', 'Propietario Pendiente', '13F-34', NULL, 'correo@example.com', '000-0000000'),
('13', 'F', '4', '1', '13F-41', 'Propietario Pendiente', '13F-41', NULL, 'correo@example.com', '000-0000000'),
('13', 'F', '4', '2', '13F-42', 'Propietario Pendiente', '13F-42', NULL, 'correo@example.com', '000-0000000'),
('13', 'F', '4', '3', '13F-43', 'Propietario Pendiente', '13F-43', NULL, 'correo@example.com', '000-0000000'),
('13', 'F', '4', '4', '13F-44', 'Propietario Pendiente', '13F-44', NULL, 'correo@example.com', '000-0000000'),
('13', 'F', '5', '1', '13F-51', 'Propietario Pendiente', '13F-51', NULL, 'correo@example.com', '000-0000000'),
('13', 'F', '5', '2', '13F-52', 'Propietario Pendiente', '13F-52', NULL, 'correo@example.com', '000-0000000'),
('13', 'F', '5', '3', '13F-53', 'Propietario Pendiente', '13F-53', NULL, 'correo@example.com', '000-0000000'),
('13', 'F', '5', '4', '13F-54', 'Propietario Pendiente', '13F-54', NULL, 'correo@example.com', '000-0000000'),
('1', 'A', '1', '1', '1A-11', 'Juan Fernández', '$2y$10$pZa9I0LY5r48HKnQz2xOMuoqaMcf/pWHWAmoNduajF6gbuF/NWQBy', '2025-06-07', 'juanmanuelfg95@gmail.cpm', '04121234567'),
('1', 'A', '1', '2', '1A-12', 'Antonio Perez', '$2y$10$ur8/./xMmyrauZfNWYJ0XuOHkKOGVE8OOA3DxLMHoVy4wUchm1Uze', '2025-06-14', 'antonio3216@gmail.com', '04143001934'),
('1', 'A', '1', '3', '1A-13', 'Antonio Perez', '$2y$10$g5DQ2rGIH0/InFUsdO2pdezt9II6TsedGkCkuDo0u3jrQzLMDqZqK', '2025-06-14', 'antonio321@gmail.com', '04143001934'),
('1', 'A', '1', '4', '1A-14', 'Juan Gonzalez', '$2y$10$Zw9GBoBjJ.l3AhpKVSEIp.Fr58HGg0.KEpqbRoYmwb6E5eFWJuiUe', '2025-06-14', 'juanmanuelfg123@gmail.com', '04143001934'),
('1', 'A', '2', '1', '1A-21', 'Propietario Pendiente', '1A-21', NULL, 'correo@example.com', '000-0000000'),
('1', 'A', '2', '2', '1A-22', 'Propietario Pendiente', '$2y$10$2RRaJJ4V.ATQtEaPQeKay.6tBnDxNAVRGdKEedVACn7qws8XUiQZe', NULL, 'correo@example.com', '000-0000000'),
('1', 'A', '2', '3', '1A-23', 'Propietario Pendiente', '1A-23', NULL, 'correo@example.com', '000-0000000'),
('1', 'A', '2', '4', '1A-24', 'Propietario Pendiente', '1A-24', NULL, 'correo@example.com', '000-0000000'),
('1', 'A', '3', '1', '1A-31', 'Propietario Pendiente', '1A-31', NULL, 'correo@example.com', '000-0000000'),
('1', 'A', '3', '2', '1A-32', 'Propietario Pendiente', '1A-32', NULL, 'correo@example.com', '000-0000000'),
('1', 'A', '3', '3', '1A-33', 'Propietario Pendiente', '1A-33', NULL, 'correo@example.com', '000-0000000'),
('1', 'A', '3', '4', '1A-34', 'Propietario Pendiente', '1A-34', NULL, 'correo@example.com', '000-0000000'),
('1', 'A', '4', '1', '1A-41', 'Propietario Pendiente', '1A-41', NULL, 'correo@example.com', '000-0000000'),
('1', 'A', '4', '2', '1A-42', 'Propietario Pendiente', '1A-42', NULL, 'correo@example.com', '000-0000000'),
('1', 'A', '4', '3', '1A-43', 'Propietario Pendiente', '1A-43', NULL, 'correo@example.com', '000-0000000'),
('1', 'A', '4', '4', '1A-44', 'Propietario Pendiente', '1A-44', NULL, 'correo@example.com', '000-0000000'),
('1', 'A', '5', '1', '1A-51', 'Propietario Pendiente', '1A-51', NULL, 'correo@example.com', '000-0000000'),
('1', 'A', '5', '2', '1A-52', 'Propietario Pendiente', '1A-52', NULL, 'correo@example.com', '000-0000000'),
('1', 'A', '5', '3', '1A-53', 'Propietario Pendiente', '1A-53', NULL, 'correo@example.com', '000-0000000'),
('1', 'A', '5', '4', '1A-54', 'Propietario Pendiente', '1A-54', NULL, 'correo@example.com', '000-0000000'),
('1', 'B', '1', '1', '1B-11', 'Propietario Pendiente', '1B-11', NULL, 'correo@example.com', '000-0000000'),
('1', 'B', '1', '2', '1B-12', 'Propietario Pendiente', '1B-12', NULL, 'correo@example.com', '000-0000000'),
('1', 'B', '1', '3', '1B-13', 'Propietario Pendiente', '1B-13', NULL, 'correo@example.com', '000-0000000'),
('1', 'B', '1', '4', '1B-14', 'Propietario Pendiente', '1B-14', NULL, 'correo@example.com', '000-0000000'),
('1', 'B', '2', '1', '1B-21', 'Propietario Pendiente', '1B-21', NULL, 'correo@example.com', '000-0000000'),
('1', 'B', '2', '2', '1B-22', 'Propietario Pendiente', '1B-22', NULL, 'correo@example.com', '000-0000000'),
('1', 'B', '2', '3', '1B-23', 'Propietario Pendiente', '1B-23', NULL, 'correo@example.com', '000-0000000'),
('1', 'B', '2', '4', '1B-24', 'Propietario Pendiente', '1B-24', NULL, 'correo@example.com', '000-0000000'),
('1', 'B', '3', '1', '1B-31', 'Propietario Pendiente', '1B-31', NULL, 'correo@example.com', '000-0000000'),
('1', 'B', '3', '2', '1B-32', 'Propietario Pendiente', '1B-32', NULL, 'correo@example.com', '000-0000000'),
('1', 'B', '3', '3', '1B-33', 'Propietario Pendiente', '1B-33', NULL, 'correo@example.com', '000-0000000'),
('1', 'B', '3', '4', '1B-34', 'Propietario Pendiente', '1B-34', NULL, 'correo@example.com', '000-0000000'),
('1', 'B', '4', '1', '1B-41', 'Propietario Pendiente', '1B-41', NULL, 'correo@example.com', '000-0000000'),
('1', 'B', '4', '2', '1B-42', 'Propietario Pendiente', '1B-42', NULL, 'correo@example.com', '000-0000000'),
('1', 'B', '4', '3', '1B-43', 'Propietario Pendiente', '1B-43', NULL, 'correo@example.com', '000-0000000'),
('1', 'B', '4', '4', '1B-44', 'Propietario Pendiente', '1B-44', NULL, 'correo@example.com', '000-0000000'),
('1', 'B', '5', '1', '1B-51', 'Propietario Pendiente', '1B-51', NULL, 'correo@example.com', '000-0000000'),
('1', 'B', '5', '2', '1B-52', 'Propietario Pendiente', '1B-52', NULL, 'correo@example.com', '000-0000000'),
('1', 'B', '5', '3', '1B-53', 'Propietario Pendiente', '1B-53', NULL, 'correo@example.com', '000-0000000'),
('1', 'B', '5', '4', '1B-54', 'Propietario Pendiente', '1B-54', NULL, 'correo@example.com', '000-0000000'),
('2', 'A', '1', '1', '2A-11', 'Propietario Pendiente', '2A-11', NULL, 'correo@example.com', '000-0000000'),
('2', 'A', '1', '2', '2A-12', 'Propietario Pendiente', '2A-12', NULL, 'correo@example.com', '000-0000000'),
('2', 'A', '1', '3', '2A-13', 'Propietario Pendiente', '2A-13', NULL, 'correo@example.com', '000-0000000'),
('2', 'A', '1', '4', '2A-14', 'Propietario Pendiente', '2A-14', NULL, 'correo@example.com', '000-0000000'),
('2', 'A', '2', '1', '2A-21', 'Propietario Pendiente', '2A-21', NULL, 'correo@example.com', '000-0000000'),
('2', 'A', '2', '2', '2A-22', 'Propietario Pendiente', '2A-22', NULL, 'correo@example.com', '000-0000000'),
('2', 'A', '2', '3', '2A-23', 'Propietario Pendiente', '2A-23', NULL, 'correo@example.com', '000-0000000'),
('2', 'A', '2', '4', '2A-24', 'Propietario Pendiente', '2A-24', NULL, 'correo@example.com', '000-0000000'),
('2', 'A', '3', '1', '2A-31', 'Propietario Pendiente', '2A-31', NULL, 'correo@example.com', '000-0000000'),
('2', 'A', '3', '2', '2A-32', 'Propietario Pendiente', '2A-32', NULL, 'correo@example.com', '000-0000000'),
('2', 'A', '3', '3', '2A-33', 'Propietario Pendiente', '2A-33', NULL, 'correo@example.com', '000-0000000'),
('2', 'A', '3', '4', '2A-34', 'Propietario Pendiente', '2A-34', NULL, 'correo@example.com', '000-0000000'),
('2', 'A', '4', '1', '2A-41', 'Propietario Pendiente', '2A-41', NULL, 'correo@example.com', '000-0000000'),
('2', 'A', '4', '2', '2A-42', 'Propietario Pendiente', '2A-42', NULL, 'correo@example.com', '000-0000000'),
('2', 'A', '4', '3', '2A-43', 'Propietario Pendiente', '2A-43', NULL, 'correo@example.com', '000-0000000'),
('2', 'A', '4', '4', '2A-44', 'Propietario Pendiente', '2A-44', NULL, 'correo@example.com', '000-0000000'),
('2', 'A', '5', '1', '2A-51', 'Propietario Pendiente', '2A-51', NULL, 'correo@example.com', '000-0000000'),
('2', 'A', '5', '2', '2A-52', 'Propietario Pendiente', '2A-52', NULL, 'correo@example.com', '000-0000000'),
('2', 'A', '5', '3', '2A-53', 'Propietario Pendiente', '2A-53', NULL, 'correo@example.com', '000-0000000'),
('2', 'A', '5', '4', '2A-54', 'Propietario Pendiente', '2A-54', NULL, 'correo@example.com', '000-0000000'),
('2', 'B', '1', '1', '2B-11', 'Propietario Pendiente', '2B-11', NULL, 'correo@example.com', '000-0000000'),
('2', 'B', '1', '2', '2B-12', 'Propietario Pendiente', '2B-12', NULL, 'correo@example.com', '000-0000000'),
('2', 'B', '1', '3', '2B-13', 'Propietario Pendiente', '2B-13', NULL, 'correo@example.com', '000-0000000'),
('2', 'B', '1', '4', '2B-14', 'Propietario Pendiente', '2B-14', NULL, 'correo@example.com', '000-0000000'),
('2', 'B', '2', '1', '2B-21', 'Propietario Pendiente', '2B-21', NULL, 'correo@example.com', '000-0000000'),
('2', 'B', '2', '2', '2B-22', 'Propietario Pendiente', '2B-22', NULL, 'correo@example.com', '000-0000000'),
('2', 'B', '2', '3', '2B-23', 'Propietario Pendiente', '2B-23', NULL, 'correo@example.com', '000-0000000'),
('2', 'B', '2', '4', '2B-24', 'Propietario Pendiente', '2B-24', NULL, 'correo@example.com', '000-0000000'),
('2', 'B', '3', '1', '2B-31', 'Propietario Pendiente', '2B-31', NULL, 'correo@example.com', '000-0000000'),
('2', 'B', '3', '2', '2B-32', 'Propietario Pendiente', '2B-32', NULL, 'correo@example.com', '000-0000000'),
('2', 'B', '3', '3', '2B-33', 'Propietario Pendiente', '2B-33', NULL, 'correo@example.com', '000-0000000'),
('2', 'B', '3', '4', '2B-34', 'Propietario Pendiente', '2B-34', NULL, 'correo@example.com', '000-0000000'),
('2', 'B', '4', '1', '2B-41', 'Propietario Pendiente', '2B-41', NULL, 'correo@example.com', '000-0000000'),
('2', 'B', '4', '2', '2B-42', 'Propietario Pendiente', '2B-42', NULL, 'correo@example.com', '000-0000000'),
('2', 'B', '4', '3', '2B-43', 'Propietario Pendiente', '2B-43', NULL, 'correo@example.com', '000-0000000'),
('2', 'B', '4', '4', '2B-44', 'Propietario Pendiente', '2B-44', NULL, 'correo@example.com', '000-0000000'),
('2', 'B', '5', '1', '2B-51', 'Propietario Pendiente', '2B-51', NULL, 'correo@example.com', '000-0000000'),
('2', 'B', '5', '2', '2B-52', 'Propietario Pendiente', '2B-52', NULL, 'correo@example.com', '000-0000000'),
('2', 'B', '5', '3', '2B-53', 'Propietario Pendiente', '2B-53', NULL, 'correo@example.com', '000-0000000'),
('2', 'B', '5', '4', '2B-54', 'Propietario Pendiente', '2B-54', NULL, 'correo@example.com', '000-0000000'),
('2', 'C', '1', '1', '2C-11', 'Propietario Pendiente', '2C-11', NULL, 'correo@example.com', '000-0000000'),
('2', 'C', '1', '2', '2C-12', 'Propietario Pendiente', '2C-12', NULL, 'correo@example.com', '000-0000000'),
('2', 'C', '1', '3', '2C-13', 'Propietario Pendiente', '2C-13', NULL, 'correo@example.com', '000-0000000'),
('2', 'C', '1', '4', '2C-14', 'Propietario Pendiente', '2C-14', NULL, 'correo@example.com', '000-0000000'),
('2', 'C', '2', '1', '2C-21', 'Propietario Pendiente', '2C-21', NULL, 'correo@example.com', '000-0000000'),
('2', 'C', '2', '2', '2C-22', 'Propietario Pendiente', '2C-22', NULL, 'correo@example.com', '000-0000000'),
('2', 'C', '2', '3', '2C-23', 'Propietario Pendiente', '2C-23', NULL, 'correo@example.com', '000-0000000'),
('2', 'C', '2', '4', '2C-24', 'Propietario Pendiente', '2C-24', NULL, 'correo@example.com', '000-0000000'),
('2', 'C', '3', '1', '2C-31', 'Propietario Pendiente', '2C-31', NULL, 'correo@example.com', '000-0000000'),
('2', 'C', '3', '2', '2C-32', 'Propietario Pendiente', '2C-32', NULL, 'correo@example.com', '000-0000000'),
('2', 'C', '3', '3', '2C-33', 'Propietario Pendiente', '2C-33', NULL, 'correo@example.com', '000-0000000'),
('2', 'C', '3', '4', '2C-34', 'Propietario Pendiente', '2C-34', NULL, 'correo@example.com', '000-0000000'),
('2', 'C', '4', '1', '2C-41', 'Propietario Pendiente', '2C-41', NULL, 'correo@example.com', '000-0000000'),
('2', 'C', '4', '2', '2C-42', 'Propietario Pendiente', '2C-42', NULL, 'correo@example.com', '000-0000000'),
('2', 'C', '4', '3', '2C-43', 'Propietario Pendiente', '2C-43', NULL, 'correo@example.com', '000-0000000'),
('2', 'C', '4', '4', '2C-44', 'Propietario Pendiente', '2C-44', NULL, 'correo@example.com', '000-0000000'),
('2', 'C', '5', '1', '2C-51', 'Propietario Pendiente', '2C-51', NULL, 'correo@example.com', '000-0000000'),
('2', 'C', '5', '2', '2C-52', 'Propietario Pendiente', '2C-52', NULL, 'correo@example.com', '000-0000000'),
('2', 'C', '5', '3', '2C-53', 'Propietario Pendiente', '2C-53', NULL, 'correo@example.com', '000-0000000'),
('2', 'C', '5', '4', '2C-54', 'Propietario Pendiente', '2C-54', NULL, 'correo@example.com', '000-0000000'),
('2', 'D', '1', '1', '2D-11', 'Propietario Pendiente', '2D-11', NULL, 'correo@example.com', '000-0000000'),
('2', 'D', '1', '2', '2D-12', 'Propietario Pendiente', '2D-12', NULL, 'correo@example.com', '000-0000000'),
('2', 'D', '1', '3', '2D-13', 'Propietario Pendiente', '2D-13', NULL, 'correo@example.com', '000-0000000'),
('2', 'D', '1', '4', '2D-14', 'Propietario Pendiente', '2D-14', NULL, 'correo@example.com', '000-0000000'),
('2', 'D', '2', '1', '2D-21', 'Propietario Pendiente', '2D-21', NULL, 'correo@example.com', '000-0000000'),
('2', 'D', '2', '2', '2D-22', 'Propietario Pendiente', '2D-22', NULL, 'correo@example.com', '000-0000000'),
('2', 'D', '2', '3', '2D-23', 'Propietario Pendiente', '2D-23', NULL, 'correo@example.com', '000-0000000'),
('2', 'D', '2', '4', '2D-24', 'Propietario Pendiente', '2D-24', NULL, 'correo@example.com', '000-0000000'),
('2', 'D', '3', '1', '2D-31', 'Propietario Pendiente', '2D-31', NULL, 'correo@example.com', '000-0000000'),
('2', 'D', '3', '2', '2D-32', 'Propietario Pendiente', '2D-32', NULL, 'correo@example.com', '000-0000000'),
('2', 'D', '3', '3', '2D-33', 'Propietario Pendiente', '2D-33', NULL, 'correo@example.com', '000-0000000'),
('2', 'D', '3', '4', '2D-34', 'Propietario Pendiente', '2D-34', NULL, 'correo@example.com', '000-0000000'),
('2', 'D', '4', '1', '2D-41', 'Propietario Pendiente', '2D-41', NULL, 'correo@example.com', '000-0000000'),
('2', 'D', '4', '2', '2D-42', 'Propietario Pendiente', '2D-42', NULL, 'correo@example.com', '000-0000000'),
('2', 'D', '4', '3', '2D-43', 'Propietario Pendiente', '2D-43', NULL, 'correo@example.com', '000-0000000'),
('2', 'D', '4', '4', '2D-44', 'Propietario Pendiente', '2D-44', NULL, 'correo@example.com', '000-0000000'),
('2', 'D', '5', '1', '2D-51', 'Propietario Pendiente', '2D-51', NULL, 'correo@example.com', '000-0000000'),
('2', 'D', '5', '2', '2D-52', 'Propietario Pendiente', '2D-52', NULL, 'correo@example.com', '000-0000000'),
('2', 'D', '5', '3', '2D-53', 'Propietario Pendiente', '2D-53', NULL, 'correo@example.com', '000-0000000'),
('2', 'D', '5', '4', '2D-54', 'Propietario Pendiente', '2D-54', NULL, 'correo@example.com', '000-0000000'),
('2', 'E', '1', '1', '2E-11', 'Propietario Pendiente', '2E-11', NULL, 'correo@example.com', '000-0000000'),
('2', 'E', '1', '2', '2E-12', 'Propietario Pendiente', '2E-12', NULL, 'correo@example.com', '000-0000000'),
('2', 'E', '1', '3', '2E-13', 'Propietario Pendiente', '2E-13', NULL, 'correo@example.com', '000-0000000'),
('2', 'E', '1', '4', '2E-14', 'Propietario Pendiente', '2E-14', NULL, 'correo@example.com', '000-0000000'),
('2', 'E', '2', '1', '2E-21', 'Propietario Pendiente', '2E-21', NULL, 'correo@example.com', '000-0000000'),
('2', 'E', '2', '2', '2E-22', 'Propietario Pendiente', '2E-22', NULL, 'correo@example.com', '000-0000000'),
('2', 'E', '2', '3', '2E-23', 'Propietario Pendiente', '2E-23', NULL, 'correo@example.com', '000-0000000'),
('2', 'E', '2', '4', '2E-24', 'Propietario Pendiente', '2E-24', NULL, 'correo@example.com', '000-0000000'),
('2', 'E', '3', '1', '2E-31', 'Propietario Pendiente', '2E-31', NULL, 'correo@example.com', '000-0000000'),
('2', 'E', '3', '2', '2E-32', 'Propietario Pendiente', '2E-32', NULL, 'correo@example.com', '000-0000000'),
('2', 'E', '3', '3', '2E-33', 'Propietario Pendiente', '2E-33', NULL, 'correo@example.com', '000-0000000'),
('2', 'E', '3', '4', '2E-34', 'Propietario Pendiente', '2E-34', NULL, 'correo@example.com', '000-0000000'),
('2', 'E', '4', '1', '2E-41', 'Propietario Pendiente', '2E-41', NULL, 'correo@example.com', '000-0000000'),
('2', 'E', '4', '2', '2E-42', 'Propietario Pendiente', '2E-42', NULL, 'correo@example.com', '000-0000000'),
('2', 'E', '4', '3', '2E-43', 'Propietario Pendiente', '2E-43', NULL, 'correo@example.com', '000-0000000'),
('2', 'E', '4', '4', '2E-44', 'Propietario Pendiente', '2E-44', NULL, 'correo@example.com', '000-0000000'),
('2', 'E', '5', '1', '2E-51', 'Propietario Pendiente', '2E-51', NULL, 'correo@example.com', '000-0000000'),
('2', 'E', '5', '2', '2E-52', 'Propietario Pendiente', '2E-52', NULL, 'correo@example.com', '000-0000000'),
('2', 'E', '5', '3', '2E-53', 'Propietario Pendiente', '2E-53', NULL, 'correo@example.com', '000-0000000'),
('2', 'E', '5', '4', '2E-54', 'Propietario Pendiente', '2E-54', NULL, 'correo@example.com', '000-0000000'),
('2', 'F', '1', '1', '2F-11', 'Propietario Pendiente', '2F-11', NULL, 'correo@example.com', '000-0000000'),
('2', 'F', '1', '2', '2F-12', 'Propietario Pendiente', '2F-12', NULL, 'correo@example.com', '000-0000000'),
('2', 'F', '1', '3', '2F-13', 'Propietario Pendiente', '2F-13', NULL, 'correo@example.com', '000-0000000'),
('2', 'F', '1', '4', '2F-14', 'Propietario Pendiente', '2F-14', NULL, 'correo@example.com', '000-0000000'),
('2', 'F', '2', '1', '2F-21', 'Propietario Pendiente', '2F-21', NULL, 'correo@example.com', '000-0000000'),
('2', 'F', '2', '2', '2F-22', 'Propietario Pendiente', '2F-22', NULL, 'correo@example.com', '000-0000000'),
('2', 'F', '2', '3', '2F-23', 'Propietario Pendiente', '2F-23', NULL, 'correo@example.com', '000-0000000'),
('2', 'F', '2', '4', '2F-24', 'Propietario Pendiente', '2F-24', NULL, 'correo@example.com', '000-0000000'),
('2', 'F', '3', '1', '2F-31', 'Propietario Pendiente', '2F-31', NULL, 'correo@example.com', '000-0000000'),
('2', 'F', '3', '2', '2F-32', 'Propietario Pendiente', '2F-32', NULL, 'correo@example.com', '000-0000000'),
('2', 'F', '3', '3', '2F-33', 'Propietario Pendiente', '2F-33', NULL, 'correo@example.com', '000-0000000'),
('2', 'F', '3', '4', '2F-34', 'Propietario Pendiente', '2F-34', NULL, 'correo@example.com', '000-0000000'),
('2', 'F', '4', '1', '2F-41', 'Propietario Pendiente', '2F-41', NULL, 'correo@example.com', '000-0000000'),
('2', 'F', '4', '2', '2F-42', 'Propietario Pendiente', '2F-42', NULL, 'correo@example.com', '000-0000000'),
('2', 'F', '4', '3', '2F-43', 'Propietario Pendiente', '2F-43', NULL, 'correo@example.com', '000-0000000'),
('2', 'F', '4', '4', '2F-44', 'Propietario Pendiente', '2F-44', NULL, 'correo@example.com', '000-0000000'),
('2', 'F', '5', '1', '2F-51', 'Propietario Pendiente', '2F-51', NULL, 'correo@example.com', '000-0000000'),
('2', 'F', '5', '2', '2F-52', 'Propietario Pendiente', '2F-52', NULL, 'correo@example.com', '000-0000000'),
('2', 'F', '5', '3', '2F-53', 'Propietario Pendiente', '2F-53', NULL, 'correo@example.com', '000-0000000'),
('2', 'F', '5', '4', '2F-54', 'Propietario Pendiente', '2F-54', NULL, 'correo@example.com', '000-0000000'),
('2', 'G', '1', '1', '2G-11', 'Propietario Pendiente', '2G-11', NULL, 'correo@example.com', '000-0000000'),
('2', 'G', '1', '2', '2G-12', 'Propietario Pendiente', '2G-12', NULL, 'correo@example.com', '000-0000000'),
('2', 'G', '1', '3', '2G-13', 'Propietario Pendiente', '2G-13', NULL, 'correo@example.com', '000-0000000'),
('2', 'G', '1', '4', '2G-14', 'Propietario Pendiente', '2G-14', NULL, 'correo@example.com', '000-0000000'),
('2', 'G', '2', '1', '2G-21', 'Propietario Pendiente', '2G-21', NULL, 'correo@example.com', '000-0000000'),
('2', 'G', '2', '2', '2G-22', 'Propietario Pendiente', '2G-22', NULL, 'correo@example.com', '000-0000000'),
('2', 'G', '2', '3', '2G-23', 'Propietario Pendiente', '2G-23', NULL, 'correo@example.com', '000-0000000'),
('2', 'G', '2', '4', '2G-24', 'Propietario Pendiente', '2G-24', NULL, 'correo@example.com', '000-0000000'),
('2', 'G', '3', '1', '2G-31', 'Propietario Pendiente', '2G-31', NULL, 'correo@example.com', '000-0000000'),
('2', 'G', '3', '2', '2G-32', 'Propietario Pendiente', '2G-32', NULL, 'correo@example.com', '000-0000000'),
('2', 'G', '3', '3', '2G-33', 'Propietario Pendiente', '2G-33', NULL, 'correo@example.com', '000-0000000'),
('2', 'G', '3', '4', '2G-34', 'Propietario Pendiente', '2G-34', NULL, 'correo@example.com', '000-0000000'),
('2', 'G', '4', '1', '2G-41', 'Propietario Pendiente', '2G-41', NULL, 'correo@example.com', '000-0000000'),
('2', 'G', '4', '2', '2G-42', 'Propietario Pendiente', '2G-42', NULL, 'correo@example.com', '000-0000000'),
('2', 'G', '4', '3', '2G-43', 'Propietario Pendiente', '2G-43', NULL, 'correo@example.com', '000-0000000'),
('2', 'G', '4', '4', '2G-44', 'Propietario Pendiente', '2G-44', NULL, 'correo@example.com', '000-0000000'),
('3', 'A', '1', '1', '3A-11', 'Propietario Pendiente', '3A-11', NULL, 'correo@example.com', '000-0000000'),
('3', 'A', '1', '2', '3A-12', 'Propietario Pendiente', '3A-12', NULL, 'correo@example.com', '000-0000000'),
('3', 'A', '1', '3', '3A-13', 'Propietario Pendiente', '3A-13', NULL, 'correo@example.com', '000-0000000'),
('3', 'A', '1', '4', '3A-14', 'Propietario Pendiente', '3A-14', NULL, 'correo@example.com', '000-0000000'),
('3', 'A', '2', '1', '3A-21', 'Propietario Pendiente', '3A-21', NULL, 'correo@example.com', '000-0000000'),
('3', 'A', '2', '2', '3A-22', 'Propietario Pendiente', '3A-22', NULL, 'correo@example.com', '000-0000000'),
('3', 'A', '2', '3', '3A-23', 'Propietario Pendiente', '3A-23', NULL, 'correo@example.com', '000-0000000'),
('3', 'A', '2', '4', '3A-24', 'Propietario Pendiente', '3A-24', NULL, 'correo@example.com', '000-0000000'),
('3', 'A', '3', '1', '3A-31', 'Propietario Pendiente', '3A-31', NULL, 'correo@example.com', '000-0000000'),
('3', 'A', '3', '2', '3A-32', 'Propietario Pendiente', '3A-32', NULL, 'correo@example.com', '000-0000000'),
('3', 'A', '3', '3', '3A-33', 'Propietario Pendiente', '3A-33', NULL, 'correo@example.com', '000-0000000'),
('3', 'A', '3', '4', '3A-34', 'Propietario Pendiente', '3A-34', NULL, 'correo@example.com', '000-0000000'),
('3', 'A', '4', '1', '3A-41', 'Propietario Pendiente', '3A-41', NULL, 'correo@example.com', '000-0000000'),
('3', 'A', '4', '2', '3A-42', 'Propietario Pendiente', '3A-42', NULL, 'correo@example.com', '000-0000000'),
('3', 'A', '4', '3', '3A-43', 'Propietario Pendiente', '3A-43', NULL, 'correo@example.com', '000-0000000'),
('3', 'A', '4', '4', '3A-44', 'Propietario Pendiente', '3A-44', NULL, 'correo@example.com', '000-0000000'),
('3', 'A', '5', '1', '3A-51', 'Propietario Pendiente', '3A-51', NULL, 'correo@example.com', '000-0000000'),
('3', 'A', '5', '2', '3A-52', 'Propietario Pendiente', '3A-52', NULL, 'correo@example.com', '000-0000000'),
('3', 'A', '5', '3', '3A-53', 'Propietario Pendiente', '3A-53', NULL, 'correo@example.com', '000-0000000'),
('3', 'A', '5', '4', '3A-54', 'Propietario Pendiente', '3A-54', NULL, 'correo@example.com', '000-0000000'),
('3', 'B', '1', '1', '3B-11', 'Propietario Pendiente', '3B-11', NULL, 'correo@example.com', '000-0000000'),
('3', 'B', '1', '2', '3B-12', 'Propietario Pendiente', '3B-12', NULL, 'correo@example.com', '000-0000000'),
('3', 'B', '1', '3', '3B-13', 'Propietario Pendiente', '3B-13', NULL, 'correo@example.com', '000-0000000'),
('3', 'B', '1', '4', '3B-14', 'Propietario Pendiente', '3B-14', NULL, 'correo@example.com', '000-0000000'),
('3', 'B', '2', '1', '3B-21', 'Propietario Pendiente', '3B-21', NULL, 'correo@example.com', '000-0000000'),
('3', 'B', '2', '2', '3B-22', 'Propietario Pendiente', '3B-22', NULL, 'correo@example.com', '000-0000000'),
('3', 'B', '2', '3', '3B-23', 'Propietario Pendiente', '3B-23', NULL, 'correo@example.com', '000-0000000'),
('3', 'B', '2', '4', '3B-24', 'Propietario Pendiente', '3B-24', NULL, 'correo@example.com', '000-0000000'),
('3', 'B', '3', '1', '3B-31', 'Propietario Pendiente', '3B-31', NULL, 'correo@example.com', '000-0000000'),
('3', 'B', '3', '2', '3B-32', 'Propietario Pendiente', '3B-32', NULL, 'correo@example.com', '000-0000000'),
('3', 'B', '3', '3', '3B-33', 'Propietario Pendiente', '3B-33', NULL, 'correo@example.com', '000-0000000'),
('3', 'B', '3', '4', '3B-34', 'Propietario Pendiente', '3B-34', NULL, 'correo@example.com', '000-0000000'),
('3', 'B', '4', '1', '3B-41', 'Propietario Pendiente', '3B-41', NULL, 'correo@example.com', '000-0000000'),
('3', 'B', '4', '2', '3B-42', 'Propietario Pendiente', '3B-42', NULL, 'correo@example.com', '000-0000000'),
('3', 'B', '4', '3', '3B-43', 'Juan Fernandez', '$2y$10$cYosoLq25xjmtcyxhsO5ru6JddIiEL8jRb3UoHBp3dfAtaZLFm60i', NULL, 'juanmanuelfg9@gmail.com', '04143001934'),
('3', 'B', '4', '4', '3B-44', 'Propietario Pendiente', '3B-44', NULL, 'correo@example.com', '000-0000000'),
('3', 'B', '5', '1', '3B-51', 'Propietario Pendiente', '3B-51', NULL, 'correo@example.com', '000-0000000'),
('3', 'B', '5', '2', '3B-52', 'Propietario Pendiente', '3B-52', NULL, 'correo@example.com', '000-0000000'),
('3', 'B', '5', '3', '3B-53', 'Propietario Pendiente', '3B-53', NULL, 'correo@example.com', '000-0000000'),
('3', 'B', '5', '4', '3B-54', 'Propietario Pendiente', '3B-54', NULL, 'correo@example.com', '000-0000000'),
('3', 'C', '1', '1', '3C-11', 'Propietario Pendiente', '3C-11', NULL, 'correo@example.com', '000-0000000'),
('3', 'C', '1', '2', '3C-12', 'Propietario Pendiente', '3C-12', NULL, 'correo@example.com', '000-0000000'),
('3', 'C', '1', '3', '3C-13', 'Propietario Pendiente', '3C-13', NULL, 'correo@example.com', '000-0000000'),
('3', 'C', '1', '4', '3C-14', 'Propietario Pendiente', '3C-14', NULL, 'correo@example.com', '000-0000000'),
('3', 'C', '2', '1', '3C-21', 'Propietario Pendiente', '3C-21', NULL, 'correo@example.com', '000-0000000'),
('3', 'C', '2', '2', '3C-22', 'Propietario Pendiente', '3C-22', NULL, 'correo@example.com', '000-0000000'),
('3', 'C', '2', '3', '3C-23', 'Propietario Pendiente', '3C-23', NULL, 'correo@example.com', '000-0000000'),
('3', 'C', '2', '4', '3C-24', 'Propietario Pendiente', '3C-24', NULL, 'correo@example.com', '000-0000000'),
('3', 'C', '3', '1', '3C-31', 'Propietario Pendiente', '3C-31', NULL, 'correo@example.com', '000-0000000'),
('3', 'C', '3', '2', '3C-32', 'Propietario Pendiente', '3C-32', NULL, 'correo@example.com', '000-0000000'),
('3', 'C', '3', '3', '3C-33', 'Propietario Pendiente', '3C-33', NULL, 'correo@example.com', '000-0000000'),
('3', 'C', '3', '4', '3C-34', 'Propietario Pendiente', '3C-34', NULL, 'correo@example.com', '000-0000000'),
('3', 'C', '4', '1', '3C-41', 'Propietario Pendiente', '3C-41', NULL, 'correo@example.com', '000-0000000'),
('3', 'C', '4', '2', '3C-42', 'Propietario Pendiente', '3C-42', NULL, 'correo@example.com', '000-0000000'),
('3', 'C', '4', '3', '3C-43', 'Propietario Pendiente', '3C-43', NULL, 'correo@example.com', '000-0000000'),
('3', 'C', '4', '4', '3C-44', 'Propietario Pendiente', '3C-44', NULL, 'correo@example.com', '000-0000000'),
('3', 'C', '5', '1', '3C-51', 'Propietario Pendiente', '3C-51', NULL, 'correo@example.com', '000-0000000'),
('3', 'C', '5', '2', '3C-52', 'Propietario Pendiente', '3C-52', NULL, 'correo@example.com', '000-0000000'),
('3', 'C', '5', '3', '3C-53', 'Propietario Pendiente', '3C-53', NULL, 'correo@example.com', '000-0000000'),
('3', 'C', '5', '4', '3C-54', 'Propietario Pendiente', '3C-54', NULL, 'correo@example.com', '000-0000000'),
('3', 'D', '1', '1', '3D-11', 'Propietario Pendiente', '3D-11', NULL, 'correo@example.com', '000-0000000'),
('3', 'D', '1', '2', '3D-12', 'Propietario Pendiente', '3D-12', NULL, 'correo@example.com', '000-0000000'),
('3', 'D', '1', '3', '3D-13', 'Propietario Pendiente', '3D-13', NULL, 'correo@example.com', '000-0000000'),
('3', 'D', '1', '4', '3D-14', 'Propietario Pendiente', '3D-14', NULL, 'correo@example.com', '000-0000000'),
('3', 'D', '2', '1', '3D-21', 'Propietario Pendiente', '3D-21', NULL, 'correo@example.com', '000-0000000'),
('3', 'D', '2', '2', '3D-22', 'Propietario Pendiente', '3D-22', NULL, 'correo@example.com', '000-0000000'),
('3', 'D', '2', '3', '3D-23', 'Propietario Pendiente', '3D-23', NULL, 'correo@example.com', '000-0000000'),
('3', 'D', '2', '4', '3D-24', 'Propietario Pendiente', '3D-24', NULL, 'correo@example.com', '000-0000000'),
('3', 'D', '3', '1', '3D-31', 'Propietario Pendiente', '3D-31', NULL, 'correo@example.com', '000-0000000'),
('3', 'D', '3', '2', '3D-32', 'Propietario Pendiente', '3D-32', NULL, 'correo@example.com', '000-0000000'),
('3', 'D', '3', '3', '3D-33', 'Propietario Pendiente', '3D-33', NULL, 'correo@example.com', '000-0000000'),
('3', 'D', '3', '4', '3D-34', 'Propietario Pendiente', '3D-34', NULL, 'correo@example.com', '000-0000000'),
('3', 'D', '4', '1', '3D-41', 'Propietario Pendiente', '3D-41', NULL, 'correo@example.com', '000-0000000'),
('3', 'D', '4', '2', '3D-42', 'Propietario Pendiente', '3D-42', NULL, 'correo@example.com', '000-0000000'),
('3', 'D', '4', '3', '3D-43', 'Propietario Pendiente', '3D-43', NULL, 'correo@example.com', '000-0000000'),
('3', 'D', '4', '4', '3D-44', 'Propietario Pendiente', '3D-44', NULL, 'correo@example.com', '000-0000000'),
('3', 'D', '5', '1', '3D-51', 'Propietario Pendiente', '3D-51', NULL, 'correo@example.com', '000-0000000'),
('3', 'D', '5', '2', '3D-52', 'Propietario Pendiente', '3D-52', NULL, 'correo@example.com', '000-0000000'),
('3', 'D', '5', '3', '3D-53', 'Propietario Pendiente', '3D-53', NULL, 'correo@example.com', '000-0000000'),
('3', 'D', '5', '4', '3D-54', 'Propietario Pendiente', '3D-54', NULL, 'correo@example.com', '000-0000000'),
('4', 'A', '1', '1', '4A-11', 'Maria Rios', '$2y$10$AiUU/LDK96NSpiHMkA.P4Oypi2ciWKh1c95/IFyyQeb7g7bxHlNIu', '2025-06-04', 'Maria@gmail.com', '041212345678'),
('4', 'A', '1', '2', '4A-12', 'Propietario Pendiente', '4A-12', NULL, 'correo@example.com', '000-0000000'),
('4', 'A', '1', '3', '4A-13', 'Propietario Pendiente', '4A-13', NULL, 'correo@example.com', '000-0000000'),
('4', 'A', '1', '4', '4A-14', 'Propietario Pendiente', '4A-14', NULL, 'correo@example.com', '000-0000000'),
('4', 'A', '2', '1', '4A-21', 'Propietario Pendiente', '4A-21', NULL, 'correo@example.com', '000-0000000'),
('4', 'A', '2', '2', '4A-22', 'Propietario Pendiente', '4A-22', NULL, 'correo@example.com', '000-0000000'),
('4', 'A', '2', '3', '4A-23', 'Propietario Pendiente', '4A-23', NULL, 'correo@example.com', '000-0000000'),
('4', 'A', '2', '4', '4A-24', 'Propietario Pendiente', '4A-24', NULL, 'correo@example.com', '000-0000000'),
('4', 'A', '3', '1', '4A-31', 'Propietario Pendiente', '4A-31', NULL, 'correo@example.com', '000-0000000'),
('4', 'A', '3', '2', '4A-32', 'Propietario Pendiente', '4A-32', NULL, 'correo@example.com', '000-0000000'),
('4', 'A', '3', '3', '4A-33', 'Propietario Pendiente', '4A-33', NULL, 'correo@example.com', '000-0000000'),
('4', 'A', '3', '4', '4A-34', 'Propietario Pendiente', '4A-34', NULL, 'correo@example.com', '000-0000000'),
('4', 'A', '4', '1', '4A-41', 'Propietario Pendiente', '4A-41', NULL, 'correo@example.com', '000-0000000'),
('4', 'A', '4', '2', '4A-42', 'Propietario Pendiente', '4A-42', NULL, 'correo@example.com', '000-0000000'),
('4', 'A', '4', '3', '4A-43', 'Propietario Pendiente', '4A-43', NULL, 'correo@example.com', '000-0000000'),
('4', 'A', '4', '4', '4A-44', 'Propietario Pendiente', '4A-44', NULL, 'correo@example.com', '000-0000000'),
('4', 'B', '1', '1', '4B-11', 'Propietario Pendiente', '4B-11', NULL, 'correo@example.com', '000-0000000'),
('4', 'B', '1', '2', '4B-12', 'Propietario Pendiente', '4B-12', NULL, 'correo@example.com', '000-0000000'),
('4', 'B', '1', '3', '4B-13', 'Propietario Pendiente', '4B-13', NULL, 'correo@example.com', '000-0000000'),
('4', 'B', '1', '4', '4B-14', 'Propietario Pendiente', '4B-14', NULL, 'correo@example.com', '000-0000000'),
('4', 'B', '2', '1', '4B-21', 'Propietario Pendiente', '4B-21', NULL, 'correo@example.com', '000-0000000'),
('4', 'B', '2', '2', '4B-22', 'Propietario Pendiente', '4B-22', NULL, 'correo@example.com', '000-0000000'),
('4', 'B', '2', '3', '4B-23', 'Propietario Pendiente', '4B-23', NULL, 'correo@example.com', '000-0000000'),
('4', 'B', '2', '4', '4B-24', 'Propietario Pendiente', '4B-24', NULL, 'correo@example.com', '000-0000000'),
('4', 'B', '3', '1', '4B-31', 'Propietario Pendiente', '4B-31', NULL, 'correo@example.com', '000-0000000'),
('4', 'B', '3', '2', '4B-32', 'Propietario Pendiente', '4B-32', NULL, 'correo@example.com', '000-0000000'),
('4', 'B', '3', '3', '4B-33', 'Propietario Pendiente', '4B-33', NULL, 'correo@example.com', '000-0000000'),
('4', 'B', '3', '4', '4B-34', 'Propietario Pendiente', '4B-34', NULL, 'correo@example.com', '000-0000000'),
('4', 'B', '4', '1', '4B-41', 'Propietario Pendiente', '4B-41', NULL, 'correo@example.com', '000-0000000'),
('4', 'B', '4', '2', '4B-42', 'Propietario Pendiente', '4B-42', NULL, 'correo@example.com', '000-0000000'),
('4', 'B', '4', '3', '4B-43', 'Propietario Pendiente', '4B-43', NULL, 'correo@example.com', '000-0000000'),
('4', 'B', '4', '4', '4B-44', 'Propietario Pendiente', '4B-44', NULL, 'correo@example.com', '000-0000000'),
('5', 'A', '1', '1', '5A-11', 'Propietario Pendiente', '5A-11', NULL, 'correo@example.com', '000-0000000'),
('5', 'A', '1', '2', '5A-12', 'Propietario Pendiente', '5A-12', NULL, 'correo@example.com', '000-0000000'),
('5', 'A', '1', '3', '5A-13', 'Propietario Pendiente', '5A-13', NULL, 'correo@example.com', '000-0000000'),
('5', 'A', '1', '4', '5A-14', 'Propietario Pendiente', '5A-14', NULL, 'correo@example.com', '000-0000000'),
('5', 'A', '2', '1', '5A-21', 'Propietario Pendiente', '5A-21', NULL, 'correo@example.com', '000-0000000'),
('5', 'A', '2', '2', '5A-22', 'Propietario Pendiente', '5A-22', NULL, 'correo@example.com', '000-0000000'),
('5', 'A', '2', '3', '5A-23', 'Propietario Pendiente', '5A-23', NULL, 'correo@example.com', '000-0000000'),
('5', 'A', '2', '4', '5A-24', 'Propietario Pendiente', '5A-24', NULL, 'correo@example.com', '000-0000000'),
('5', 'A', '3', '1', '5A-31', 'Propietario Pendiente', '5A-31', NULL, 'correo@example.com', '000-0000000'),
('5', 'A', '3', '2', '5A-32', 'Propietario Pendiente', '5A-32', NULL, 'correo@example.com', '000-0000000'),
('5', 'A', '3', '3', '5A-33', 'Propietario Pendiente', '5A-33', NULL, 'correo@example.com', '000-0000000'),
('5', 'A', '3', '4', '5A-34', 'Propietario Pendiente', '5A-34', NULL, 'correo@example.com', '000-0000000'),
('5', 'A', '4', '1', '5A-41', 'Propietario Pendiente', '5A-41', NULL, 'correo@example.com', '000-0000000'),
('5', 'A', '4', '2', '5A-42', 'Propietario Pendiente', '5A-42', NULL, 'correo@example.com', '000-0000000'),
('5', 'A', '4', '3', '5A-43', 'Propietario Pendiente', '5A-43', NULL, 'correo@example.com', '000-0000000'),
('5', 'A', '4', '4', '5A-44', 'Propietario Pendiente', '5A-44', NULL, 'correo@example.com', '000-0000000'),
('5', 'A', '5', '1', '5A-51', 'Propietario Pendiente', '5A-51', NULL, 'correo@example.com', '000-0000000'),
('5', 'A', '5', '2', '5A-52', 'Propietario Pendiente', '5A-52', NULL, 'correo@example.com', '000-0000000'),
('5', 'A', '5', '3', '5A-53', 'Propietario Pendiente', '5A-53', NULL, 'correo@example.com', '000-0000000'),
('5', 'A', '5', '4', '5A-54', 'Propietario Pendiente', '5A-54', NULL, 'correo@example.com', '000-0000000'),
('5', 'B', '1', '1', '5B-11', 'Propietario Pendiente', '5B-11', NULL, 'correo@example.com', '000-0000000'),
('5', 'B', '1', '2', '5B-12', 'Propietario Pendiente', '5B-12', NULL, 'correo@example.com', '000-0000000'),
('5', 'B', '1', '3', '5B-13', 'Propietario Pendiente', '5B-13', NULL, 'correo@example.com', '000-0000000'),
('5', 'B', '1', '4', '5B-14', 'Propietario Pendiente', '5B-14', NULL, 'correo@example.com', '000-0000000'),
('5', 'B', '2', '1', '5B-21', 'Propietario Pendiente', '5B-21', NULL, 'correo@example.com', '000-0000000'),
('5', 'B', '2', '2', '5B-22', 'Propietario Pendiente', '5B-22', NULL, 'correo@example.com', '000-0000000'),
('5', 'B', '2', '3', '5B-23', 'Propietario Pendiente', '5B-23', NULL, 'correo@example.com', '000-0000000'),
('5', 'B', '2', '4', '5B-24', 'Propietario Pendiente', '5B-24', NULL, 'correo@example.com', '000-0000000'),
('5', 'B', '3', '1', '5B-31', 'Propietario Pendiente', '5B-31', NULL, 'correo@example.com', '000-0000000'),
('5', 'B', '3', '2', '5B-32', 'Propietario Pendiente', '5B-32', NULL, 'correo@example.com', '000-0000000'),
('5', 'B', '3', '3', '5B-33', 'Propietario Pendiente', '5B-33', NULL, 'correo@example.com', '000-0000000'),
('5', 'B', '3', '4', '5B-34', 'Propietario Pendiente', '5B-34', NULL, 'correo@example.com', '000-0000000'),
('5', 'B', '4', '1', '5B-41', 'Propietario Pendiente', '5B-41', NULL, 'correo@example.com', '000-0000000'),
('5', 'B', '4', '2', '5B-42', 'Propietario Pendiente', '5B-42', NULL, 'correo@example.com', '000-0000000'),
('5', 'B', '4', '3', '5B-43', 'Propietario Pendiente', '5B-43', NULL, 'correo@example.com', '000-0000000'),
('5', 'B', '4', '4', '5B-44', 'Propietario Pendiente', '5B-44', NULL, 'correo@example.com', '000-0000000'),
('5', 'B', '5', '1', '5B-51', 'Propietario Pendiente', '5B-51', NULL, 'correo@example.com', '000-0000000'),
('5', 'B', '5', '2', '5B-52', 'Propietario Pendiente', '5B-52', NULL, 'correo@example.com', '000-0000000'),
('5', 'B', '5', '3', '5B-53', 'Propietario Pendiente', '5B-53', NULL, 'correo@example.com', '000-0000000'),
('5', 'B', '5', '4', '5B-54', 'Propietario Pendiente', '5B-54', NULL, 'correo@example.com', '000-0000000'),
('5', 'C', '1', '1', '5C-11', 'Propietario Pendiente', '5C-11', NULL, 'correo@example.com', '000-0000000'),
('5', 'C', '1', '2', '5C-12', 'Propietario Pendiente', '5C-12', NULL, 'correo@example.com', '000-0000000'),
('5', 'C', '1', '3', '5C-13', 'Propietario Pendiente', '5C-13', NULL, 'correo@example.com', '000-0000000'),
('5', 'C', '1', '4', '5C-14', 'Propietario Pendiente', '5C-14', NULL, 'correo@example.com', '000-0000000'),
('5', 'C', '2', '1', '5C-21', 'Propietario Pendiente', '5C-21', NULL, 'correo@example.com', '000-0000000'),
('5', 'C', '2', '2', '5C-22', 'Propietario Pendiente', '5C-22', NULL, 'correo@example.com', '000-0000000'),
('5', 'C', '2', '3', '5C-23', 'Propietario Pendiente', '5C-23', NULL, 'correo@example.com', '000-0000000'),
('5', 'C', '2', '4', '5C-24', 'Propietario Pendiente', '5C-24', NULL, 'correo@example.com', '000-0000000'),
('5', 'C', '3', '1', '5C-31', 'Propietario Pendiente', '5C-31', NULL, 'correo@example.com', '000-0000000'),
('5', 'C', '3', '2', '5C-32', 'Propietario Pendiente', '5C-32', NULL, 'correo@example.com', '000-0000000'),
('5', 'C', '3', '3', '5C-33', 'Propietario Pendiente', '5C-33', NULL, 'correo@example.com', '000-0000000'),
('5', 'C', '3', '4', '5C-34', 'Propietario Pendiente', '5C-34', NULL, 'correo@example.com', '000-0000000'),
('5', 'C', '4', '1', '5C-41', 'Propietario Pendiente', '5C-41', NULL, 'correo@example.com', '000-0000000'),
('5', 'C', '4', '2', '5C-42', 'Propietario Pendiente', '5C-42', NULL, 'correo@example.com', '000-0000000'),
('5', 'C', '4', '3', '5C-43', 'Propietario Pendiente', '5C-43', NULL, 'correo@example.com', '000-0000000'),
('5', 'C', '4', '4', '5C-44', 'Propietario Pendiente', '5C-44', NULL, 'correo@example.com', '000-0000000'),
('5', 'C', '5', '1', '5C-51', 'Propietario Pendiente', '5C-51', NULL, 'correo@example.com', '000-0000000'),
('5', 'C', '5', '2', '5C-52', 'Propietario Pendiente', '5C-52', NULL, 'correo@example.com', '000-0000000'),
('5', 'C', '5', '3', '5C-53', 'Propietario Pendiente', '5C-53', NULL, 'correo@example.com', '000-0000000'),
('5', 'C', '5', '4', '5C-54', 'Propietario Pendiente', '5C-54', NULL, 'correo@example.com', '000-0000000'),
('6', 'A', '1', '1', '6A-11', 'Propietario Pendiente', '6A-11', NULL, 'correo@example.com', '000-0000000'),
('6', 'A', '1', '2', '6A-12', 'Propietario Pendiente', '6A-12', NULL, 'correo@example.com', '000-0000000'),
('6', 'A', '1', '3', '6A-13', 'Propietario Pendiente', '6A-13', NULL, 'correo@example.com', '000-0000000'),
('6', 'A', '1', '4', '6A-14', 'Propietario Pendiente', '6A-14', NULL, 'correo@example.com', '000-0000000'),
('6', 'A', '2', '1', '6A-21', 'Propietario Pendiente', '6A-21', NULL, 'correo@example.com', '000-0000000'),
('6', 'A', '2', '2', '6A-22', 'Propietario Pendiente', '6A-22', NULL, 'correo@example.com', '000-0000000'),
('6', 'A', '2', '3', '6A-23', 'Propietario Pendiente', '6A-23', NULL, 'correo@example.com', '000-0000000'),
('6', 'A', '2', '4', '6A-24', 'Propietario Pendiente', '6A-24', NULL, 'correo@example.com', '000-0000000'),
('6', 'A', '3', '1', '6A-31', 'Propietario Pendiente', '6A-31', NULL, 'correo@example.com', '000-0000000'),
('6', 'A', '3', '2', '6A-32', 'Propietario Pendiente', '6A-32', NULL, 'correo@example.com', '000-0000000'),
('6', 'A', '3', '3', '6A-33', 'Propietario Pendiente', '6A-33', NULL, 'correo@example.com', '000-0000000'),
('6', 'A', '3', '4', '6A-34', 'Propietario Pendiente', '6A-34', NULL, 'correo@example.com', '000-0000000'),
('6', 'A', '4', '1', '6A-41', 'Propietario Pendiente', '6A-41', NULL, 'correo@example.com', '000-0000000'),
('6', 'A', '4', '2', '6A-42', 'Propietario Pendiente', '6A-42', NULL, 'correo@example.com', '000-0000000'),
('6', 'A', '4', '3', '6A-43', 'Propietario Pendiente', '6A-43', NULL, 'correo@example.com', '000-0000000'),
('6', 'A', '4', '4', '6A-44', 'Propietario Pendiente', '6A-44', NULL, 'correo@example.com', '000-0000000'),
('6', 'A', '5', '1', '6A-51', 'Propietario Pendiente', '6A-51', NULL, 'correo@example.com', '000-0000000'),
('6', 'A', '5', '2', '6A-52', 'Propietario Pendiente', '6A-52', NULL, 'correo@example.com', '000-0000000'),
('6', 'A', '5', '3', '6A-53', 'Propietario Pendiente', '6A-53', NULL, 'correo@example.com', '000-0000000'),
('6', 'A', '5', '4', '6A-54', 'Propietario Pendiente', '6A-54', NULL, 'correo@example.com', '000-0000000'),
('6', 'B', '1', '1', '6B-11', 'Propietario Pendiente', '6B-11', NULL, 'correo@example.com', '000-0000000'),
('6', 'B', '1', '2', '6B-12', 'Propietario Pendiente', '6B-12', NULL, 'correo@example.com', '000-0000000'),
('6', 'B', '1', '3', '6B-13', 'Propietario Pendiente', '6B-13', NULL, 'correo@example.com', '000-0000000'),
('6', 'B', '1', '4', '6B-14', 'Propietario Pendiente', '6B-14', NULL, 'correo@example.com', '000-0000000'),
('6', 'B', '2', '1', '6B-21', 'Propietario Pendiente', '6B-21', NULL, 'correo@example.com', '000-0000000'),
('6', 'B', '2', '2', '6B-22', 'Propietario Pendiente', '6B-22', NULL, 'correo@example.com', '000-0000000'),
('6', 'B', '2', '3', '6B-23', 'Propietario Pendiente', '6B-23', NULL, 'correo@example.com', '000-0000000'),
('6', 'B', '2', '4', '6B-24', 'Propietario Pendiente', '6B-24', NULL, 'correo@example.com', '000-0000000'),
('6', 'B', '3', '1', '6B-31', 'Propietario Pendiente', '6B-31', NULL, 'correo@example.com', '000-0000000'),
('6', 'B', '3', '2', '6B-32', 'Propietario Pendiente', '6B-32', NULL, 'correo@example.com', '000-0000000');
INSERT INTO `edificios` (`Terraza`, `Edificio`, `Piso`, `Apartamento`, `usuario`, `nombre_completo`, `password`, `ultima_modificacion`, `correo`, `telefono`) VALUES
('6', 'B', '3', '3', '6B-33', 'Propietario Pendiente', '6B-33', NULL, 'correo@example.com', '000-0000000'),
('6', 'B', '3', '4', '6B-34', 'Propietario Pendiente', '6B-34', NULL, 'correo@example.com', '000-0000000'),
('6', 'B', '4', '1', '6B-41', 'Propietario Pendiente', '6B-41', NULL, 'correo@example.com', '000-0000000'),
('6', 'B', '4', '2', '6B-42', 'Propietario Pendiente', '6B-42', NULL, 'correo@example.com', '000-0000000'),
('6', 'B', '4', '3', '6B-43', 'Propietario Pendiente', '6B-43', NULL, 'correo@example.com', '000-0000000'),
('6', 'B', '4', '4', '6B-44', 'Propietario Pendiente', '6B-44', NULL, 'correo@example.com', '000-0000000'),
('6', 'B', '5', '1', '6B-51', 'Propietario Pendiente', '6B-51', NULL, 'correo@example.com', '000-0000000'),
('6', 'B', '5', '2', '6B-52', 'Propietario Pendiente', '6B-52', NULL, 'correo@example.com', '000-0000000'),
('6', 'B', '5', '3', '6B-53', 'Propietario Pendiente', '6B-53', NULL, 'correo@example.com', '000-0000000'),
('6', 'B', '5', '4', '6B-54', 'Propietario Pendiente', '6B-54', NULL, 'correo@example.com', '000-0000000'),
('6', 'C', '1', '1', '6C-11', 'Propietario Pendiente', '6C-11', NULL, 'correo@example.com', '000-0000000'),
('6', 'C', '1', '2', '6C-12', 'Propietario Pendiente', '6C-12', NULL, 'correo@example.com', '000-0000000'),
('6', 'C', '1', '3', '6C-13', 'Propietario Pendiente', '6C-13', NULL, 'correo@example.com', '000-0000000'),
('6', 'C', '1', '4', '6C-14', 'Propietario Pendiente', '6C-14', NULL, 'correo@example.com', '000-0000000'),
('6', 'C', '2', '1', '6C-21', 'Propietario Pendiente', '6C-21', NULL, 'correo@example.com', '000-0000000'),
('6', 'C', '2', '2', '6C-22', 'Propietario Pendiente', '6C-22', NULL, 'correo@example.com', '000-0000000'),
('6', 'C', '2', '3', '6C-23', 'Propietario Pendiente', '6C-23', NULL, 'correo@example.com', '000-0000000'),
('6', 'C', '2', '4', '6C-24', 'Propietario Pendiente', '6C-24', NULL, 'correo@example.com', '000-0000000'),
('6', 'C', '3', '1', '6C-31', 'Propietario Pendiente', '6C-31', NULL, 'correo@example.com', '000-0000000'),
('6', 'C', '3', '2', '6C-32', 'Propietario Pendiente', '6C-32', NULL, 'correo@example.com', '000-0000000'),
('6', 'C', '3', '3', '6C-33', 'Propietario Pendiente', '6C-33', NULL, 'correo@example.com', '000-0000000'),
('6', 'C', '3', '4', '6C-34', 'Propietario Pendiente', '6C-34', NULL, 'correo@example.com', '000-0000000'),
('6', 'C', '4', '1', '6C-41', 'Propietario Pendiente', '6C-41', NULL, 'correo@example.com', '000-0000000'),
('6', 'C', '4', '2', '6C-42', 'Propietario Pendiente', '6C-42', NULL, 'correo@example.com', '000-0000000'),
('6', 'C', '4', '3', '6C-43', 'Propietario Pendiente', '6C-43', NULL, 'correo@example.com', '000-0000000'),
('6', 'C', '4', '4', '6C-44', 'Propietario Pendiente', '6C-44', NULL, 'correo@example.com', '000-0000000'),
('6', 'C', '5', '1', '6C-51', 'Propietario Pendiente', '6C-51', NULL, 'correo@example.com', '000-0000000'),
('6', 'C', '5', '2', '6C-52', 'Propietario Pendiente', '6C-52', NULL, 'correo@example.com', '000-0000000'),
('6', 'C', '5', '3', '6C-53', 'Propietario Pendiente', '6C-53', NULL, 'correo@example.com', '000-0000000'),
('6', 'C', '5', '4', '6C-54', 'Propietario Pendiente', '6C-54', NULL, 'correo@example.com', '000-0000000'),
('6', 'D', '1', '1', '6D-11', 'Propietario Pendiente', '6D-11', NULL, 'correo@example.com', '000-0000000'),
('6', 'D', '1', '2', '6D-12', 'Propietario Pendiente', '6D-12', NULL, 'correo@example.com', '000-0000000'),
('6', 'D', '1', '3', '6D-13', 'Propietario Pendiente', '6D-13', NULL, 'correo@example.com', '000-0000000'),
('6', 'D', '1', '4', '6D-14', 'Propietario Pendiente', '6D-14', NULL, 'correo@example.com', '000-0000000'),
('6', 'D', '2', '1', '6D-21', 'Propietario Pendiente', '6D-21', NULL, 'correo@example.com', '000-0000000'),
('6', 'D', '2', '2', '6D-22', 'Propietario Pendiente', '6D-22', NULL, 'correo@example.com', '000-0000000'),
('6', 'D', '2', '3', '6D-23', 'Propietario Pendiente', '6D-23', NULL, 'correo@example.com', '000-0000000'),
('6', 'D', '2', '4', '6D-24', 'Propietario Pendiente', '6D-24', NULL, 'correo@example.com', '000-0000000'),
('6', 'D', '3', '1', '6D-31', 'Propietario Pendiente', '6D-31', NULL, 'correo@example.com', '000-0000000'),
('6', 'D', '3', '2', '6D-32', 'Propietario Pendiente', '6D-32', NULL, 'correo@example.com', '000-0000000'),
('6', 'D', '3', '3', '6D-33', 'Propietario Pendiente', '6D-33', NULL, 'correo@example.com', '000-0000000'),
('6', 'D', '3', '4', '6D-34', 'Propietario Pendiente', '6D-34', NULL, 'correo@example.com', '000-0000000'),
('6', 'D', '4', '1', '6D-41', 'Propietario Pendiente', '6D-41', NULL, 'correo@example.com', '000-0000000'),
('6', 'D', '4', '2', '6D-42', 'Propietario Pendiente', '6D-42', NULL, 'correo@example.com', '000-0000000'),
('6', 'D', '4', '3', '6D-43', 'Propietario Pendiente', '6D-43', NULL, 'correo@example.com', '000-0000000'),
('6', 'D', '4', '4', '6D-44', 'Propietario Pendiente', '6D-44', NULL, 'correo@example.com', '000-0000000'),
('6', 'D', '5', '1', '6D-51', 'Propietario Pendiente', '6D-51', NULL, 'correo@example.com', '000-0000000'),
('6', 'D', '5', '2', '6D-52', 'Propietario Pendiente', '6D-52', NULL, 'correo@example.com', '000-0000000'),
('6', 'D', '5', '3', '6D-53', 'Propietario Pendiente', '6D-53', NULL, 'correo@example.com', '000-0000000'),
('6', 'D', '5', '4', '6D-54', 'Propietario Pendiente', '6D-54', NULL, 'correo@example.com', '000-0000000'),
('7', 'A', '1', '1', '7A-11', 'Propietario Pendiente', '7A-11', NULL, 'correo@example.com', '000-0000000'),
('7', 'A', '1', '2', '7A-12', 'Propietario Pendiente', '7A-12', NULL, 'correo@example.com', '000-0000000'),
('7', 'A', '1', '3', '7A-13', 'Propietario Pendiente', '7A-13', NULL, 'correo@example.com', '000-0000000'),
('7', 'A', '1', '4', '7A-14', 'Propietario Pendiente', '7A-14', NULL, 'correo@example.com', '000-0000000'),
('7', 'A', '2', '1', '7A-21', 'Propietario Pendiente', '7A-21', NULL, 'correo@example.com', '000-0000000'),
('7', 'A', '2', '2', '7A-22', 'Propietario Pendiente', '7A-22', NULL, 'correo@example.com', '000-0000000'),
('7', 'A', '2', '3', '7A-23', 'Propietario Pendiente', '7A-23', NULL, 'correo@example.com', '000-0000000'),
('7', 'A', '2', '4', '7A-24', 'Propietario Pendiente', '7A-24', NULL, 'correo@example.com', '000-0000000'),
('7', 'A', '3', '1', '7A-31', 'Propietario Pendiente', '7A-31', NULL, 'correo@example.com', '000-0000000'),
('7', 'A', '3', '2', '7A-32', 'Propietario Pendiente', '7A-32', NULL, 'correo@example.com', '000-0000000'),
('7', 'A', '3', '3', '7A-33', 'Propietario Pendiente', '7A-33', NULL, 'correo@example.com', '000-0000000'),
('7', 'A', '3', '4', '7A-34', 'Propietario Pendiente', '7A-34', NULL, 'correo@example.com', '000-0000000'),
('7', 'A', '4', '1', '7A-41', 'Propietario Pendiente', '7A-41', NULL, 'correo@example.com', '000-0000000'),
('7', 'A', '4', '2', '7A-42', 'Propietario Pendiente', '7A-42', NULL, 'correo@example.com', '000-0000000'),
('7', 'A', '4', '3', '7A-43', 'Propietario Pendiente', '7A-43', NULL, 'correo@example.com', '000-0000000'),
('7', 'A', '4', '4', '7A-44', 'Propietario Pendiente', '7A-44', NULL, 'correo@example.com', '000-0000000'),
('7', 'A', '5', '1', '7A-51', 'Propietario Pendiente', '7A-51', NULL, 'correo@example.com', '000-0000000'),
('7', 'A', '5', '2', '7A-52', 'Propietario Pendiente', '7A-52', NULL, 'correo@example.com', '000-0000000'),
('7', 'A', '5', '3', '7A-53', 'Propietario Pendiente', '7A-53', NULL, 'correo@example.com', '000-0000000'),
('7', 'A', '5', '4', '7A-54', 'Propietario Pendiente', '7A-54', NULL, 'correo@example.com', '000-0000000'),
('7', 'B', '1', '1', '7B-11', 'Propietario Pendiente', '7B-11', NULL, 'correo@example.com', '000-0000000'),
('7', 'B', '1', '2', '7B-12', 'Propietario Pendiente', '7B-12', NULL, 'correo@example.com', '000-0000000'),
('7', 'B', '1', '3', '7B-13', 'Propietario Pendiente', '7B-13', NULL, 'correo@example.com', '000-0000000'),
('7', 'B', '1', '4', '7B-14', 'Propietario Pendiente', '7B-14', NULL, 'correo@example.com', '000-0000000'),
('7', 'B', '2', '1', '7B-21', 'Propietario Pendiente', '7B-21', NULL, 'correo@example.com', '000-0000000'),
('7', 'B', '2', '2', '7B-22', 'Propietario Pendiente', '7B-22', NULL, 'correo@example.com', '000-0000000'),
('7', 'B', '2', '3', '7B-23', 'Propietario Pendiente', '7B-23', NULL, 'correo@example.com', '000-0000000'),
('7', 'B', '2', '4', '7B-24', 'Propietario Pendiente', '7B-24', NULL, 'correo@example.com', '000-0000000'),
('7', 'B', '3', '1', '7B-31', 'Propietario Pendiente', '7B-31', NULL, 'correo@example.com', '000-0000000'),
('7', 'B', '3', '2', '7B-32', 'Propietario Pendiente', '7B-32', NULL, 'correo@example.com', '000-0000000'),
('7', 'B', '3', '3', '7B-33', 'Propietario Pendiente', '7B-33', NULL, 'correo@example.com', '000-0000000'),
('7', 'B', '3', '4', '7B-34', 'Propietario Pendiente', '7B-34', NULL, 'correo@example.com', '000-0000000'),
('7', 'B', '4', '1', '7B-41', 'Propietario Pendiente', '7B-41', NULL, 'correo@example.com', '000-0000000'),
('7', 'B', '4', '2', '7B-42', 'Propietario Pendiente', '7B-42', NULL, 'correo@example.com', '000-0000000'),
('7', 'B', '4', '3', '7B-43', 'Propietario Pendiente', '7B-43', NULL, 'correo@example.com', '000-0000000'),
('7', 'B', '4', '4', '7B-44', 'Propietario Pendiente', '7B-44', NULL, 'correo@example.com', '000-0000000'),
('7', 'B', '5', '1', '7B-51', 'Propietario Pendiente', '7B-51', NULL, 'correo@example.com', '000-0000000'),
('7', 'B', '5', '2', '7B-52', 'Propietario Pendiente', '7B-52', NULL, 'correo@example.com', '000-0000000'),
('7', 'B', '5', '3', '7B-53', 'Propietario Pendiente', '7B-53', NULL, 'correo@example.com', '000-0000000'),
('7', 'B', '5', '4', '7B-54', 'Propietario Pendiente', '7B-54', NULL, 'correo@example.com', '000-0000000'),
('8', 'A', '1', '1', '8A-11', 'Propietario Pendiente', '8A-11', NULL, 'correo@example.com', '000-0000000'),
('8', 'A', '1', '2', '8A-12', 'Propietario Pendiente', '8A-12', NULL, 'correo@example.com', '000-0000000'),
('8', 'A', '1', '3', '8A-13', 'Propietario Pendiente', '8A-13', NULL, 'correo@example.com', '000-0000000'),
('8', 'A', '1', '4', '8A-14', 'Propietario Pendiente', '8A-14', NULL, 'correo@example.com', '000-0000000'),
('8', 'A', '2', '1', '8A-21', 'Propietario Pendiente', '8A-21', NULL, 'correo@example.com', '000-0000000'),
('8', 'A', '2', '2', '8A-22', 'Propietario Pendiente', '8A-22', NULL, 'correo@example.com', '000-0000000'),
('8', 'A', '2', '3', '8A-23', 'Propietario Pendiente', '8A-23', NULL, 'correo@example.com', '000-0000000'),
('8', 'A', '2', '4', '8A-24', 'Propietario Pendiente', '8A-24', NULL, 'correo@example.com', '000-0000000'),
('8', 'A', '3', '1', '8A-31', 'Propietario Pendiente', '8A-31', NULL, 'correo@example.com', '000-0000000'),
('8', 'A', '3', '2', '8A-32', 'Propietario Pendiente', '8A-32', NULL, 'correo@example.com', '000-0000000'),
('8', 'A', '3', '3', '8A-33', 'Propietario Pendiente', '8A-33', NULL, 'correo@example.com', '000-0000000'),
('8', 'A', '3', '4', '8A-34', 'Propietario Pendiente', '8A-34', NULL, 'correo@example.com', '000-0000000'),
('8', 'A', '4', '1', '8A-41', 'Propietario Pendiente', '8A-41', NULL, 'correo@example.com', '000-0000000'),
('8', 'A', '4', '2', '8A-42', 'Propietario Pendiente', '8A-42', NULL, 'correo@example.com', '000-0000000'),
('8', 'A', '4', '3', '8A-43', 'Propietario Pendiente', '8A-43', NULL, 'correo@example.com', '000-0000000'),
('8', 'A', '4', '4', '8A-44', 'Propietario Pendiente', '8A-44', NULL, 'correo@example.com', '000-0000000'),
('8', 'A', '5', '1', '8A-51', 'Propietario Pendiente', '8A-51', NULL, 'correo@example.com', '000-0000000'),
('8', 'A', '5', '2', '8A-52', 'Propietario Pendiente', '8A-52', NULL, 'correo@example.com', '000-0000000'),
('8', 'A', '5', '3', '8A-53', 'Propietario Pendiente', '8A-53', NULL, 'correo@example.com', '000-0000000'),
('8', 'A', '5', '4', '8A-54', 'Propietario Pendiente', '8A-54', NULL, 'correo@example.com', '000-0000000'),
('8', 'B', '1', '1', '8B-11', 'Propietario Pendiente', '8B-11', NULL, 'correo@example.com', '000-0000000'),
('8', 'B', '1', '2', '8B-12', 'Propietario Pendiente', '8B-12', NULL, 'correo@example.com', '000-0000000'),
('8', 'B', '1', '3', '8B-13', 'Propietario Pendiente', '8B-13', NULL, 'correo@example.com', '000-0000000'),
('8', 'B', '1', '4', '8B-14', 'Propietario Pendiente', '8B-14', NULL, 'correo@example.com', '000-0000000'),
('8', 'B', '2', '1', '8B-21', 'Propietario Pendiente', '8B-21', NULL, 'correo@example.com', '000-0000000'),
('8', 'B', '2', '2', '8B-22', 'Propietario Pendiente', '8B-22', NULL, 'correo@example.com', '000-0000000'),
('8', 'B', '2', '3', '8B-23', 'Propietario Pendiente', '8B-23', NULL, 'correo@example.com', '000-0000000'),
('8', 'B', '2', '4', '8B-24', 'Propietario Pendiente', '8B-24', NULL, 'correo@example.com', '000-0000000'),
('8', 'B', '3', '1', '8B-31', 'Propietario Pendiente', '8B-31', NULL, 'correo@example.com', '000-0000000'),
('8', 'B', '3', '2', '8B-32', 'Propietario Pendiente', '8B-32', NULL, 'correo@example.com', '000-0000000'),
('8', 'B', '3', '3', '8B-33', 'Propietario Pendiente', '8B-33', NULL, 'correo@example.com', '000-0000000'),
('8', 'B', '3', '4', '8B-34', 'Propietario Pendiente', '8B-34', NULL, 'correo@example.com', '000-0000000'),
('8', 'B', '4', '1', '8B-41', 'Propietario Pendiente', '8B-41', NULL, 'correo@example.com', '000-0000000'),
('8', 'B', '4', '2', '8B-42', 'Propietario Pendiente', '8B-42', NULL, 'correo@example.com', '000-0000000'),
('8', 'B', '4', '3', '8B-43', 'Propietario Pendiente', '8B-43', NULL, 'correo@example.com', '000-0000000'),
('8', 'B', '4', '4', '8B-44', 'Propietario Pendiente', '8B-44', NULL, 'correo@example.com', '000-0000000'),
('8', 'B', '5', '1', '8B-51', 'Propietario Pendiente', '8B-51', NULL, 'correo@example.com', '000-0000000'),
('8', 'B', '5', '2', '8B-52', 'Propietario Pendiente', '8B-52', NULL, 'correo@example.com', '000-0000000'),
('8', 'B', '5', '3', '8B-53', 'Propietario Pendiente', '8B-53', NULL, 'correo@example.com', '000-0000000'),
('8', 'B', '5', '4', '8B-54', 'Propietario Pendiente', '8B-54', NULL, 'correo@example.com', '000-0000000'),
('8', 'C', '1', '1', '8C-11', 'Propietario Pendiente', '8C-11', NULL, 'correo@example.com', '000-0000000'),
('8', 'C', '1', '2', '8C-12', 'Propietario Pendiente', '8C-12', NULL, 'correo@example.com', '000-0000000'),
('8', 'C', '1', '3', '8C-13', 'Propietario Pendiente', '8C-13', NULL, 'correo@example.com', '000-0000000'),
('8', 'C', '1', '4', '8C-14', 'Propietario Pendiente', '8C-14', NULL, 'correo@example.com', '000-0000000'),
('8', 'C', '2', '1', '8C-21', 'Propietario Pendiente', '8C-21', NULL, 'correo@example.com', '000-0000000'),
('8', 'C', '2', '2', '8C-22', 'Propietario Pendiente', '8C-22', NULL, 'correo@example.com', '000-0000000'),
('8', 'C', '2', '3', '8C-23', 'Propietario Pendiente', '8C-23', NULL, 'correo@example.com', '000-0000000'),
('8', 'C', '2', '4', '8C-24', 'Propietario Pendiente', '8C-24', NULL, 'correo@example.com', '000-0000000'),
('8', 'C', '3', '1', '8C-31', 'Propietario Pendiente', '8C-31', NULL, 'correo@example.com', '000-0000000'),
('8', 'C', '3', '2', '8C-32', 'Propietario Pendiente', '8C-32', NULL, 'correo@example.com', '000-0000000'),
('8', 'C', '3', '3', '8C-33', 'Propietario Pendiente', '8C-33', NULL, 'correo@example.com', '000-0000000'),
('8', 'C', '3', '4', '8C-34', 'Propietario Pendiente', '8C-34', NULL, 'correo@example.com', '000-0000000'),
('8', 'C', '4', '1', '8C-41', 'Propietario Pendiente', '8C-41', NULL, 'correo@example.com', '000-0000000'),
('8', 'C', '4', '2', '8C-42', 'Propietario Pendiente', '8C-42', NULL, 'correo@example.com', '000-0000000'),
('8', 'C', '4', '3', '8C-43', 'Propietario Pendiente', '8C-43', NULL, 'correo@example.com', '000-0000000'),
('8', 'C', '4', '4', '8C-44', 'Propietario Pendiente', '8C-44', NULL, 'correo@example.com', '000-0000000'),
('8', 'C', '5', '1', '8C-51', 'Propietario Pendiente', '8C-51', NULL, 'correo@example.com', '000-0000000'),
('8', 'C', '5', '2', '8C-52', 'Propietario Pendiente', '8C-52', NULL, 'correo@example.com', '000-0000000'),
('8', 'C', '5', '3', '8C-53', 'Propietario Pendiente', '8C-53', NULL, 'correo@example.com', '000-0000000'),
('8', 'C', '5', '4', '8C-54', 'Propietario Pendiente', '8C-54', NULL, 'correo@example.com', '000-0000000'),
('8', 'D', '1', '1', '8D-11', 'Propietario Pendiente', '8D-11', NULL, 'correo@example.com', '000-0000000'),
('8', 'D', '1', '2', '8D-12', 'Propietario Pendiente', '8D-12', NULL, 'correo@example.com', '000-0000000'),
('8', 'D', '1', '3', '8D-13', 'Propietario Pendiente', '8D-13', NULL, 'correo@example.com', '000-0000000'),
('8', 'D', '1', '4', '8D-14', 'Propietario Pendiente', '8D-14', NULL, 'correo@example.com', '000-0000000'),
('8', 'D', '2', '1', '8D-21', 'Propietario Pendiente', '8D-21', NULL, 'correo@example.com', '000-0000000'),
('8', 'D', '2', '2', '8D-22', 'Propietario Pendiente', '8D-22', NULL, 'correo@example.com', '000-0000000'),
('8', 'D', '2', '3', '8D-23', 'Propietario Pendiente', '8D-23', NULL, 'correo@example.com', '000-0000000'),
('8', 'D', '2', '4', '8D-24', 'Propietario Pendiente', '8D-24', NULL, 'correo@example.com', '000-0000000'),
('8', 'D', '3', '1', '8D-31', 'Propietario Pendiente', '8D-31', NULL, 'correo@example.com', '000-0000000'),
('8', 'D', '3', '2', '8D-32', 'Propietario Pendiente', '8D-32', NULL, 'correo@example.com', '000-0000000'),
('8', 'D', '3', '3', '8D-33', 'Propietario Pendiente', '8D-33', NULL, 'correo@example.com', '000-0000000'),
('8', 'D', '3', '4', '8D-34', 'Propietario Pendiente', '8D-34', NULL, 'correo@example.com', '000-0000000'),
('8', 'D', '4', '1', '8D-41', 'Propietario Pendiente', '8D-41', NULL, 'correo@example.com', '000-0000000'),
('8', 'D', '4', '2', '8D-42', 'Propietario Pendiente', '8D-42', NULL, 'correo@example.com', '000-0000000'),
('8', 'D', '4', '3', '8D-43', 'Propietario Pendiente', '8D-43', NULL, 'correo@example.com', '000-0000000'),
('8', 'D', '4', '4', '8D-44', 'Propietario Pendiente', '8D-44', NULL, 'correo@example.com', '000-0000000'),
('8', 'D', '5', '1', '8D-51', 'Propietario Pendiente', '8D-51', NULL, 'correo@example.com', '000-0000000'),
('8', 'D', '5', '2', '8D-52', 'Propietario Pendiente', '8D-52', NULL, 'correo@example.com', '000-0000000'),
('8', 'D', '5', '3', '8D-53', 'Propietario Pendiente', '8D-53', NULL, 'correo@example.com', '000-0000000'),
('8', 'D', '5', '4', '8D-54', 'Propietario Pendiente', '8D-54', NULL, 'correo@example.com', '000-0000000'),
('9', 'A', '1', '1', '9A-11', 'Propietario Pendiente', '9A-11', NULL, 'correo@example.com', '000-0000000'),
('9', 'A', '1', '2', '9A-12', 'Propietario Pendiente', '9A-12', NULL, 'correo@example.com', '000-0000000'),
('9', 'A', '1', '3', '9A-13', 'Propietario Pendiente', '9A-13', NULL, 'correo@example.com', '000-0000000'),
('9', 'A', '1', '4', '9A-14', 'Propietario Pendiente', '9A-14', NULL, 'correo@example.com', '000-0000000'),
('9', 'A', '2', '1', '9A-21', 'Propietario Pendiente', '9A-21', NULL, 'correo@example.com', '000-0000000'),
('9', 'A', '2', '2', '9A-22', 'Propietario Pendiente', '9A-22', NULL, 'correo@example.com', '000-0000000'),
('9', 'A', '2', '3', '9A-23', 'Propietario Pendiente', '9A-23', NULL, 'correo@example.com', '000-0000000'),
('9', 'A', '2', '4', '9A-24', 'Propietario Pendiente', '9A-24', NULL, 'correo@example.com', '000-0000000'),
('9', 'A', '3', '1', '9A-31', 'Propietario Pendiente', '9A-31', NULL, 'correo@example.com', '000-0000000'),
('9', 'A', '3', '2', '9A-32', 'Propietario Pendiente', '9A-32', NULL, 'correo@example.com', '000-0000000'),
('9', 'A', '3', '3', '9A-33', 'Propietario Pendiente', '9A-33', NULL, 'correo@example.com', '000-0000000'),
('9', 'A', '3', '4', '9A-34', 'Propietario Pendiente', '9A-34', NULL, 'correo@example.com', '000-0000000'),
('9', 'A', '4', '1', '9A-41', 'Propietario Pendiente', '9A-41', NULL, 'correo@example.com', '000-0000000'),
('9', 'A', '4', '2', '9A-42', 'Propietario Pendiente', '9A-42', NULL, 'correo@example.com', '000-0000000'),
('9', 'A', '4', '3', '9A-43', 'Propietario Pendiente', '9A-43', NULL, 'correo@example.com', '000-0000000'),
('9', 'A', '4', '4', '9A-44', 'Propietario Pendiente', '9A-44', NULL, 'correo@example.com', '000-0000000'),
('9', 'A', '5', '1', '9A-51', 'Propietario Pendiente', '9A-51', NULL, 'correo@example.com', '000-0000000'),
('9', 'A', '5', '2', '9A-52', 'Propietario Pendiente', '9A-52', NULL, 'correo@example.com', '000-0000000'),
('9', 'A', '5', '3', '9A-53', 'Propietario Pendiente', '9A-53', NULL, 'correo@example.com', '000-0000000'),
('9', 'A', '5', '4', '9A-54', 'Propietario Pendiente', '9A-54', NULL, 'correo@example.com', '000-0000000'),
('9', 'B', '1', '1', '9B-11', 'Propietario Pendiente', '9B-11', NULL, 'correo@example.com', '000-0000000'),
('9', 'B', '1', '2', '9B-12', 'Propietario Pendiente', '9B-12', NULL, 'correo@example.com', '000-0000000'),
('9', 'B', '1', '3', '9B-13', 'Propietario Pendiente', '9B-13', NULL, 'correo@example.com', '000-0000000'),
('9', 'B', '1', '4', '9B-14', 'Propietario Pendiente', '9B-14', NULL, 'correo@example.com', '000-0000000'),
('9', 'B', '2', '1', '9B-21', 'Propietario Pendiente', '9B-21', NULL, 'correo@example.com', '000-0000000'),
('9', 'B', '2', '2', '9B-22', 'Propietario Pendiente', '9B-22', NULL, 'correo@example.com', '000-0000000'),
('9', 'B', '2', '3', '9B-23', 'Propietario Pendiente', '9B-23', NULL, 'correo@example.com', '000-0000000'),
('9', 'B', '2', '4', '9B-24', 'Propietario Pendiente', '9B-24', NULL, 'correo@example.com', '000-0000000'),
('9', 'B', '3', '1', '9B-31', 'Propietario Pendiente', '9B-31', NULL, 'correo@example.com', '000-0000000'),
('9', 'B', '3', '2', '9B-32', 'Propietario Pendiente', '9B-32', NULL, 'correo@example.com', '000-0000000'),
('9', 'B', '3', '3', '9B-33', 'Propietario Pendiente', '9B-33', NULL, 'correo@example.com', '000-0000000'),
('9', 'B', '3', '4', '9B-34', 'Propietario Pendiente', '9B-34', NULL, 'correo@example.com', '000-0000000'),
('9', 'B', '4', '1', '9B-41', 'Propietario Pendiente', '9B-41', NULL, 'correo@example.com', '000-0000000'),
('9', 'B', '4', '2', '9B-42', 'Propietario Pendiente', '9B-42', NULL, 'correo@example.com', '000-0000000'),
('9', 'B', '4', '3', '9B-43', 'Propietario Pendiente', '9B-43', NULL, 'correo@example.com', '000-0000000'),
('9', 'B', '4', '4', '9B-44', 'Propietario Pendiente', '9B-44', NULL, 'correo@example.com', '000-0000000'),
('9', 'B', '5', '1', '9B-51', 'Propietario Pendiente', '9B-51', NULL, 'correo@example.com', '000-0000000'),
('9', 'B', '5', '2', '9B-52', 'Propietario Pendiente', '9B-52', NULL, 'correo@example.com', '000-0000000'),
('9', 'B', '5', '3', '9B-53', 'Propietario Pendiente', '9B-53', NULL, 'correo@example.com', '000-0000000'),
('9', 'B', '5', '4', '9B-54', 'Propietario Pendiente', '9B-54', NULL, 'correo@example.com', '000-0000000'),
('9', 'C', '1', '1', '9C-11', 'Propietario Pendiente', '9C-11', NULL, 'correo@example.com', '000-0000000'),
('9', 'C', '1', '2', '9C-12', 'Propietario Pendiente', '9C-12', NULL, 'correo@example.com', '000-0000000'),
('9', 'C', '1', '3', '9C-13', 'Propietario Pendiente', '9C-13', NULL, 'correo@example.com', '000-0000000'),
('9', 'C', '1', '4', '9C-14', 'Propietario Pendiente', '9C-14', NULL, 'correo@example.com', '000-0000000'),
('9', 'C', '2', '1', '9C-21', 'Propietario Pendiente', '9C-21', NULL, 'correo@example.com', '000-0000000'),
('9', 'C', '2', '2', '9C-22', 'Propietario Pendiente', '9C-22', NULL, 'correo@example.com', '000-0000000'),
('9', 'C', '2', '3', '9C-23', 'Propietario Pendiente', '9C-23', NULL, 'correo@example.com', '000-0000000'),
('9', 'C', '2', '4', '9C-24', 'Propietario Pendiente', '9C-24', NULL, 'correo@example.com', '000-0000000'),
('9', 'C', '3', '1', '9C-31', 'Propietario Pendiente', '9C-31', NULL, 'correo@example.com', '000-0000000'),
('9', 'C', '3', '2', '9C-32', 'Propietario Pendiente', '9C-32', NULL, 'correo@example.com', '000-0000000'),
('9', 'C', '3', '3', '9C-33', 'Propietario Pendiente', '9C-33', NULL, 'correo@example.com', '000-0000000'),
('9', 'C', '3', '4', '9C-34', 'Propietario Pendiente', '9C-34', NULL, 'correo@example.com', '000-0000000'),
('9', 'C', '4', '1', '9C-41', 'Propietario Pendiente', '9C-41', NULL, 'correo@example.com', '000-0000000'),
('9', 'C', '4', '2', '9C-42', 'Propietario Pendiente', '9C-42', NULL, 'correo@example.com', '000-0000000'),
('9', 'C', '4', '3', '9C-43', 'Propietario Pendiente', '9C-43', NULL, 'correo@example.com', '000-0000000'),
('9', 'C', '4', '4', '9C-44', 'Propietario Pendiente', '9C-44', NULL, 'correo@example.com', '000-0000000'),
('9', 'C', '5', '1', '9C-51', 'Propietario Pendiente', '9C-51', NULL, 'correo@example.com', '000-0000000'),
('9', 'C', '5', '2', '9C-52', 'Propietario Pendiente', '9C-52', NULL, 'correo@example.com', '000-0000000'),
('9', 'C', '5', '3', '9C-53', 'Propietario Pendiente', '9C-53', NULL, 'correo@example.com', '000-0000000'),
('9', 'C', '5', '4', '9C-54', 'Propietario Pendiente', '9C-54', NULL, 'correo@example.com', '000-0000000'),
('9', 'D', '1', '1', '9D-11', 'Propietario Pendiente', '9D-11', NULL, 'correo@example.com', '000-0000000'),
('9', 'D', '1', '2', '9D-12', 'Propietario Pendiente', '9D-12', NULL, 'correo@example.com', '000-0000000'),
('9', 'D', '1', '3', '9D-13', 'Propietario Pendiente', '9D-13', NULL, 'correo@example.com', '000-0000000'),
('9', 'D', '1', '4', '9D-14', 'Propietario Pendiente', '9D-14', NULL, 'correo@example.com', '000-0000000'),
('9', 'D', '2', '1', '9D-21', 'Propietario Pendiente', '9D-21', NULL, 'correo@example.com', '000-0000000'),
('9', 'D', '2', '2', '9D-22', 'Propietario Pendiente', '9D-22', NULL, 'correo@example.com', '000-0000000'),
('9', 'D', '2', '3', '9D-23', 'Propietario Pendiente', '9D-23', NULL, 'correo@example.com', '000-0000000'),
('9', 'D', '2', '4', '9D-24', 'Propietario Pendiente', '9D-24', NULL, 'correo@example.com', '000-0000000'),
('9', 'D', '3', '1', '9D-31', 'Propietario Pendiente', '9D-31', NULL, 'correo@example.com', '000-0000000'),
('9', 'D', '3', '2', '9D-32', 'Propietario Pendiente', '9D-32', NULL, 'correo@example.com', '000-0000000'),
('9', 'D', '3', '3', '9D-33', 'Propietario Pendiente', '9D-33', NULL, 'correo@example.com', '000-0000000'),
('9', 'D', '3', '4', '9D-34', 'Propietario Pendiente', '9D-34', NULL, 'correo@example.com', '000-0000000'),
('9', 'D', '4', '1', '9D-41', 'Propietario Pendiente', '9D-41', NULL, 'correo@example.com', '000-0000000'),
('9', 'D', '4', '2', '9D-42', 'Propietario Pendiente', '9D-42', NULL, 'correo@example.com', '000-0000000'),
('9', 'D', '4', '3', '9D-43', 'Propietario Pendiente', '9D-43', NULL, 'correo@example.com', '000-0000000'),
('9', 'D', '4', '4', '9D-44', 'Propietario Pendiente', '9D-44', NULL, 'correo@example.com', '000-0000000'),
('9', 'D', '5', '1', '9D-51', 'Propietario Pendiente', '9D-51', NULL, 'correo@example.com', '000-0000000'),
('9', 'D', '5', '2', '9D-52', 'Propietario Pendiente', '9D-52', NULL, 'correo@example.com', '000-0000000'),
('9', 'D', '5', '3', '9D-53', 'Propietario Pendiente', '9D-53', NULL, 'correo@example.com', '000-0000000'),
('9', 'D', '5', '4', '9D-54', 'Propietario Pendiente', '9D-54', NULL, 'correo@example.com', '000-0000000'),
('9', 'E', '1', '1', '9E-11', 'Propietario Pendiente', '9E-11', NULL, 'correo@example.com', '000-0000000'),
('9', 'E', '1', '2', '9E-12', 'Propietario Pendiente', '9E-12', NULL, 'correo@example.com', '000-0000000'),
('9', 'E', '1', '3', '9E-13', 'Propietario Pendiente', '9E-13', NULL, 'correo@example.com', '000-0000000'),
('9', 'E', '1', '4', '9E-14', 'Propietario Pendiente', '9E-14', NULL, 'correo@example.com', '000-0000000'),
('9', 'E', '2', '1', '9E-21', 'Propietario Pendiente', '9E-21', NULL, 'correo@example.com', '000-0000000'),
('9', 'E', '2', '2', '9E-22', 'Propietario Pendiente', '9E-22', NULL, 'correo@example.com', '000-0000000'),
('9', 'E', '2', '3', '9E-23', 'Propietario Pendiente', '9E-23', NULL, 'correo@example.com', '000-0000000'),
('9', 'E', '2', '4', '9E-24', 'Propietario Pendiente', '9E-24', NULL, 'correo@example.com', '000-0000000'),
('9', 'E', '3', '1', '9E-31', 'Propietario Pendiente', '9E-31', NULL, 'correo@example.com', '000-0000000'),
('9', 'E', '3', '2', '9E-32', 'Propietario Pendiente', '9E-32', NULL, 'correo@example.com', '000-0000000'),
('9', 'E', '3', '3', '9E-33', 'Propietario Pendiente', '9E-33', NULL, 'correo@example.com', '000-0000000'),
('9', 'E', '3', '4', '9E-34', 'Propietario Pendiente', '9E-34', NULL, 'correo@example.com', '000-0000000'),
('9', 'E', '4', '1', '9E-41', 'Propietario Pendiente', '9E-41', NULL, 'correo@example.com', '000-0000000'),
('9', 'E', '4', '2', '9E-42', 'Propietario Pendiente', '9E-42', NULL, 'correo@example.com', '000-0000000'),
('9', 'E', '4', '3', '9E-43', 'Propietario Pendiente', '9E-43', NULL, 'correo@example.com', '000-0000000'),
('9', 'E', '4', '4', '9E-44', 'Propietario Pendiente', '9E-44', NULL, 'correo@example.com', '000-0000000'),
('9', 'E', '5', '1', '9E-51', 'Propietario Pendiente', '9E-51', NULL, 'correo@example.com', '000-0000000'),
('9', 'E', '5', '2', '9E-52', 'Propietario Pendiente', '9E-52', NULL, 'correo@example.com', '000-0000000'),
('9', 'E', '5', '3', '9E-53', 'Propietario Pendiente', '9E-53', NULL, 'correo@example.com', '000-0000000'),
('9', 'E', '5', '4', '9E-54', 'Propietario Pendiente', '9E-54', NULL, 'correo@example.com', '000-0000000'),
('9', 'F', '1', '1', '9F-11', 'Propietario Pendiente', '9F-11', NULL, 'correo@example.com', '000-0000000'),
('9', 'F', '1', '2', '9F-12', 'Propietario Pendiente', '9F-12', NULL, 'correo@example.com', '000-0000000'),
('9', 'F', '1', '3', '9F-13', 'Propietario Pendiente', '9F-13', NULL, 'correo@example.com', '000-0000000'),
('9', 'F', '1', '4', '9F-14', 'Propietario Pendiente', '9F-14', NULL, 'correo@example.com', '000-0000000'),
('9', 'F', '2', '1', '9F-21', 'Propietario Pendiente', '9F-21', NULL, 'correo@example.com', '000-0000000'),
('9', 'F', '2', '2', '9F-22', 'Propietario Pendiente', '9F-22', NULL, 'correo@example.com', '000-0000000'),
('9', 'F', '2', '3', '9F-23', 'Propietario Pendiente', '9F-23', NULL, 'correo@example.com', '000-0000000'),
('9', 'F', '2', '4', '9F-24', 'Propietario Pendiente', '9F-24', NULL, 'correo@example.com', '000-0000000'),
('9', 'F', '3', '1', '9F-31', 'Propietario Pendiente', '9F-31', NULL, 'correo@example.com', '000-0000000'),
('9', 'F', '3', '2', '9F-32', 'Propietario Pendiente', '9F-32', NULL, 'correo@example.com', '000-0000000'),
('9', 'F', '3', '3', '9F-33', 'Propietario Pendiente', '9F-33', NULL, 'correo@example.com', '000-0000000'),
('9', 'F', '3', '4', '9F-34', 'Propietario Pendiente', '9F-34', NULL, 'correo@example.com', '000-0000000'),
('9', 'F', '4', '1', '9F-41', 'Propietario Pendiente', '9F-41', NULL, 'correo@example.com', '000-0000000'),
('9', 'F', '4', '2', '9F-42', 'Propietario Pendiente', '9F-42', NULL, 'correo@example.com', '000-0000000'),
('9', 'F', '4', '3', '9F-43', 'Propietario Pendiente', '9F-43', NULL, 'correo@example.com', '000-0000000'),
('9', 'F', '4', '4', '9F-44', 'Propietario Pendiente', '9F-44', NULL, 'correo@example.com', '000-0000000'),
('9', 'F', '5', '1', '9F-51', 'Propietario Pendiente', '9F-51', NULL, 'correo@example.com', '000-0000000'),
('9', 'F', '5', '2', '9F-52', 'Propietario Pendiente', '9F-52', NULL, 'correo@example.com', '000-0000000'),
('9', 'F', '5', '3', '9F-53', 'Propietario Pendiente', '9F-53', NULL, 'correo@example.com', '000-0000000'),
('9', 'F', '5', '4', '9F-54', 'Propietario Pendiente', '9F-54', NULL, 'correo@example.com', '000-0000000'),
('9', 'G', '1', '1', '9G-11', 'Propietario Pendiente', '9G-11', NULL, 'correo@example.com', '000-0000000'),
('9', 'G', '1', '2', '9G-12', 'Propietario Pendiente', '9G-12', NULL, 'correo@example.com', '000-0000000'),
('9', 'G', '1', '3', '9G-13', 'Propietario Pendiente', '9G-13', NULL, 'correo@example.com', '000-0000000'),
('9', 'G', '1', '4', '9G-14', 'Propietario Pendiente', '9G-14', NULL, 'correo@example.com', '000-0000000'),
('9', 'G', '2', '1', '9G-21', 'Propietario Pendiente', '9G-21', NULL, 'correo@example.com', '000-0000000'),
('9', 'G', '2', '2', '9G-22', 'Propietario Pendiente', '9G-22', NULL, 'correo@example.com', '000-0000000'),
('9', 'G', '2', '3', '9G-23', 'Propietario Pendiente', '9G-23', NULL, 'correo@example.com', '000-0000000'),
('9', 'G', '2', '4', '9G-24', 'Propietario Pendiente', '9G-24', NULL, 'correo@example.com', '000-0000000'),
('9', 'G', '3', '1', '9G-31', 'Propietario Pendiente', '9G-31', NULL, 'correo@example.com', '000-0000000'),
('9', 'G', '3', '2', '9G-32', 'Propietario Pendiente', '9G-32', NULL, 'correo@example.com', '000-0000000'),
('9', 'G', '3', '3', '9G-33', 'Propietario Pendiente', '9G-33', NULL, 'correo@example.com', '000-0000000'),
('9', 'G', '3', '4', '9G-34', 'Propietario Pendiente', '9G-34', NULL, 'correo@example.com', '000-0000000'),
('9', 'G', '4', '1', '9G-41', 'Propietario Pendiente', '9G-41', NULL, 'correo@example.com', '000-0000000'),
('9', 'G', '4', '2', '9G-42', 'Propietario Pendiente', '9G-42', NULL, 'correo@example.com', '000-0000000'),
('9', 'G', '4', '3', '9G-43', 'Propietario Pendiente', '9G-43', NULL, 'correo@example.com', '000-0000000'),
('9', 'G', '4', '4', '9G-44', 'Propietario Pendiente', '9G-44', NULL, 'correo@example.com', '000-0000000'),
('9', 'G', '5', '1', '9G-51', 'Propietario Pendiente', '9G-51', NULL, 'correo@example.com', '000-0000000'),
('9', 'G', '5', '2', '9G-52', 'Propietario Pendiente', '9G-52', NULL, 'correo@example.com', '000-0000000'),
('9', 'G', '5', '3', '9G-53', 'Propietario Pendiente', '9G-53', NULL, 'correo@example.com', '000-0000000'),
('9', 'G', '5', '4', '9G-54', 'Propietario Pendiente', '9G-54', NULL, 'correo@example.com', '000-0000000'),
('9', 'H', '1', '1', '9H-11', 'Propietario Pendiente', '9H-11', NULL, 'correo@example.com', '000-0000000'),
('9', 'H', '1', '2', '9H-12', 'Propietario Pendiente', '9H-12', NULL, 'correo@example.com', '000-0000000'),
('9', 'H', '1', '3', '9H-13', 'Propietario Pendiente', '9H-13', NULL, 'correo@example.com', '000-0000000'),
('9', 'H', '1', '4', '9H-14', 'Propietario Pendiente', '9H-14', NULL, 'correo@example.com', '000-0000000'),
('9', 'H', '2', '1', '9H-21', 'Propietario Pendiente', '9H-21', NULL, 'correo@example.com', '000-0000000'),
('9', 'H', '2', '2', '9H-22', 'Propietario Pendiente', '9H-22', NULL, 'correo@example.com', '000-0000000'),
('9', 'H', '2', '3', '9H-23', 'Propietario Pendiente', '9H-23', NULL, 'correo@example.com', '000-0000000'),
('9', 'H', '2', '4', '9H-24', 'Propietario Pendiente', '9H-24', NULL, 'correo@example.com', '000-0000000'),
('9', 'H', '3', '1', '9H-31', 'Propietario Pendiente', '9H-31', NULL, 'correo@example.com', '000-0000000'),
('9', 'H', '3', '2', '9H-32', 'Propietario Pendiente', '9H-32', NULL, 'correo@example.com', '000-0000000'),
('9', 'H', '3', '3', '9H-33', 'Propietario Pendiente', '9H-33', NULL, 'correo@example.com', '000-0000000'),
('9', 'H', '3', '4', '9H-34', 'Propietario Pendiente', '9H-34', NULL, 'correo@example.com', '000-0000000'),
('9', 'H', '4', '1', '9H-41', 'Propietario Pendiente', '9H-41', NULL, 'correo@example.com', '000-0000000'),
('9', 'H', '4', '2', '9H-42', 'Propietario Pendiente', '9H-42', NULL, 'correo@example.com', '000-0000000'),
('9', 'H', '4', '3', '9H-43', 'Propietario Pendiente', '9H-43', NULL, 'correo@example.com', '000-0000000'),
('9', 'H', '4', '4', '9H-44', 'Propietario Pendiente', '9H-44', NULL, 'correo@example.com', '000-0000000'),
('9', 'H', '5', '1', '9H-51', 'Propietario Pendiente', '9H-51', NULL, 'correo@example.com', '000-0000000'),
('9', 'H', '5', '2', '9H-52', 'Propietario Pendiente', '9H-52', NULL, 'correo@example.com', '000-0000000'),
('9', 'H', '5', '3', '9H-53', 'Propietario Pendiente', '9H-53', NULL, 'correo@example.com', '000-0000000'),
('9', 'H', '5', '4', '9H-54', 'Propietario Pendiente', '9H-54', NULL, 'correo@example.com', '000-0000000'),
('9', 'I', '1', '1', '9I-11', 'Propietario Pendiente', '9I-11', NULL, 'correo@example.com', '000-0000000'),
('9', 'I', '1', '2', '9I-12', 'Propietario Pendiente', '9I-12', NULL, 'correo@example.com', '000-0000000'),
('9', 'I', '1', '3', '9I-13', 'Propietario Pendiente', '9I-13', NULL, 'correo@example.com', '000-0000000'),
('9', 'I', '1', '4', '9I-14', 'Propietario Pendiente', '9I-14', NULL, 'correo@example.com', '000-0000000'),
('9', 'I', '2', '1', '9I-21', 'Propietario Pendiente', '9I-21', NULL, 'correo@example.com', '000-0000000'),
('9', 'I', '2', '2', '9I-22', 'Propietario Pendiente', '9I-22', NULL, 'correo@example.com', '000-0000000'),
('9', 'I', '2', '3', '9I-23', 'Propietario Pendiente', '9I-23', NULL, 'correo@example.com', '000-0000000'),
('9', 'I', '2', '4', '9I-24', 'Propietario Pendiente', '9I-24', NULL, 'correo@example.com', '000-0000000'),
('9', 'I', '3', '1', '9I-31', 'Propietario Pendiente', '9I-31', NULL, 'correo@example.com', '000-0000000'),
('9', 'I', '3', '2', '9I-32', 'Propietario Pendiente', '9I-32', NULL, 'correo@example.com', '000-0000000'),
('9', 'I', '3', '3', '9I-33', 'Propietario Pendiente', '9I-33', NULL, 'correo@example.com', '000-0000000'),
('9', 'I', '3', '4', '9I-34', 'Propietario Pendiente', '9I-34', NULL, 'correo@example.com', '000-0000000'),
('9', 'I', '4', '1', '9I-41', 'Propietario Pendiente', '9I-41', NULL, 'correo@example.com', '000-0000000'),
('9', 'I', '4', '2', '9I-42', 'Propietario Pendiente', '9I-42', NULL, 'correo@example.com', '000-0000000'),
('9', 'I', '4', '3', '9I-43', 'Propietario Pendiente', '9I-43', NULL, 'correo@example.com', '000-0000000'),
('9', 'I', '4', '4', '9I-44', 'Propietario Pendiente', '9I-44', NULL, 'correo@example.com', '000-0000000'),
('9', 'I', '5', '1', '9I-51', 'Propietario Pendiente', '9I-51', NULL, 'correo@example.com', '000-0000000'),
('9', 'I', '5', '2', '9I-52', 'Propietario Pendiente', '9I-52', NULL, 'correo@example.com', '000-0000000'),
('9', 'I', '5', '3', '9I-53', 'Propietario Pendiente', '9I-53', NULL, 'correo@example.com', '000-0000000'),
('9', 'I', '5', '4', '9I-54', 'Propietario Pendiente', '9I-54', NULL, 'correo@example.com', '000-0000000'),
('9', 'J', '1', '1', '9J-11', 'Propietario Pendiente', '9J-11', NULL, 'correo@example.com', '000-0000000'),
('9', 'J', '1', '2', '9J-12', 'Propietario Pendiente', '9J-12', NULL, 'correo@example.com', '000-0000000'),
('9', 'J', '1', '3', '9J-13', 'Propietario Pendiente', '9J-13', NULL, 'correo@example.com', '000-0000000'),
('9', 'J', '1', '4', '9J-14', 'Propietario Pendiente', '9J-14', NULL, 'correo@example.com', '000-0000000'),
('9', 'J', '2', '1', '9J-21', 'Propietario Pendiente', '9J-21', NULL, 'correo@example.com', '000-0000000'),
('9', 'J', '2', '2', '9J-22', 'Propietario Pendiente', '9J-22', NULL, 'correo@example.com', '000-0000000'),
('9', 'J', '2', '3', '9J-23', 'Propietario Pendiente', '9J-23', NULL, 'correo@example.com', '000-0000000'),
('9', 'J', '2', '4', '9J-24', 'Propietario Pendiente', '9J-24', NULL, 'correo@example.com', '000-0000000'),
('9', 'J', '3', '1', '9J-31', 'Propietario Pendiente', '9J-31', NULL, 'correo@example.com', '000-0000000'),
('9', 'J', '3', '2', '9J-32', 'Propietario Pendiente', '9J-32', NULL, 'correo@example.com', '000-0000000'),
('9', 'J', '3', '3', '9J-33', 'Propietario Pendiente', '9J-33', NULL, 'correo@example.com', '000-0000000'),
('9', 'J', '3', '4', '9J-34', 'Propietario Pendiente', '9J-34', NULL, 'correo@example.com', '000-0000000'),
('9', 'J', '4', '1', '9J-41', 'Propietario Pendiente', '9J-41', NULL, 'correo@example.com', '000-0000000'),
('9', 'J', '4', '2', '9J-42', 'Propietario Pendiente', '9J-42', NULL, 'correo@example.com', '000-0000000'),
('9', 'J', '4', '3', '9J-43', 'Propietario Pendiente', '9J-43', NULL, 'correo@example.com', '000-0000000'),
('9', 'J', '4', '4', '9J-44', 'Propietario Pendiente', '9J-44', NULL, 'correo@example.com', '000-0000000'),
('9', 'J', '5', '1', '9J-51', 'Propietario Pendiente', '9J-51', NULL, 'correo@example.com', '000-0000000'),
('9', 'J', '5', '2', '9J-52', 'Propietario Pendiente', '9J-52', NULL, 'correo@example.com', '000-0000000'),
('9', 'J', '5', '3', '9J-53', 'Propietario Pendiente', '9J-53', NULL, 'correo@example.com', '000-0000000'),
('9', 'J', '5', '4', '9J-54', 'Propietario Pendiente', '9J-54', NULL, 'correo@example.com', '000-0000000');

--
-- Disparadores `edificios`
--
DELIMITER $$
CREATE TRIGGER `generar_usuario_antes_insert` BEFORE INSERT ON `edificios` FOR EACH ROW BEGIN
    IF NEW.usuario IS NULL OR NEW.usuario = '' THEN
        SET NEW.usuario = CONCAT(NEW.Terraza, NEW.Edificio, '-', NEW.Piso, NEW.Apartamento);
    END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `set_default_password_plain` BEFORE INSERT ON `edificios` FOR EACH ROW BEGIN
    IF NEW.password = '' THEN  -- Si no se especifica contraseña
        SET NEW.password = NEW.usuario;
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `informes`
--

CREATE TABLE `informes` (
  `id` int(11) NOT NULL,
  `tipo` varchar(50) NOT NULL,
  `asunto` varchar(255) NOT NULL,
  `descripcion` text NOT NULL,
  `prioridad` enum('baja','media','alta') NOT NULL,
  `remitente` varchar(10) NOT NULL,
  `fecha_creacion` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `informes`
--

INSERT INTO `informes` (`id`, `tipo`, `asunto`, `descripcion`, `prioridad`, `remitente`, `fecha_creacion`) VALUES
(7, 'general', 'Envio de pagos del condominio', 'Estimado Presidente Central:\r\n\r\nMe dirijo a usted con el fin de informarle que se ha realizado el envío de todos los comprobantes de pago de condominio correspondientes a los residentes del Edificio 2B.\r\n\r\nQuedamos a su disposición para notificarle de inmediato ante cualquier eventualidad o problema que pudiera surgir en relación con la verificación de dichos pagos.\r\n\r\nAgradecemos de antemano su atención.', 'baja', '2B', '2025-06-08 17:39:35'),
(8, 'seguridad', 'Mantenimiento Preventivo Necesario en el Edificio 1A', 'Estimado Presidente Central,\r\nEspero que este mensaje lo encuentre bien.\r\nLe escribo para solicitar la programación de un mantenimiento preventivo general en el Edificio 1A. Hemos identificado algunas áreas que requieren atención para asegurar la durabilidad de nuestras instalaciones y la comodidad de los residentes.\r\nEspecíficamente, nos gustaría que se revisara el estado de la pintura exterior, se verificaran las juntas de dilatación, y se realizara una inspección de rutina de las áreas comunes como el vestíbulo y las escaleras. Creemos que abordar esto a tiempo evitará reparaciones mayores y más costosas en el futuro.\r\nQuedo atento a su respuesta para coordinar las acciones a seguir.\r\n\r\nAtentamente,\r\n\r\nJuan Fernandez\r\nPresidente de la Junta de Condominio, Edificio 1A', 'media', '1A', '2025-06-14 09:45:50'),
(9, 'mantenimiento', 'Mantenimiento Preventivo Necesario en el Edificio 1B', 'Estimado Presidente Central,\r\nEspero que este mensaje lo encuentre bien.\r\nLe escribo para solicitar la programación de un mantenimiento preventivo general en el Edificio 1B. Hemos identificado algunas áreas que requieren atención para asegurar la durabilidad de nuestras instalaciones y la comodidad de los residentes.\r\nEspecíficamente, nos gustaría que se revisara el estado de la pintura exterior, se verificaran las juntas de dilatación, y se realizara una inspección de rutina de las áreas comunes como el vestíbulo y las escaleras. Creemos que abordar esto a tiempo evitará reparaciones mayores y más costosas en el futuro.\r\nQuedo atento a su respuesta para coordinar las acciones a seguir.\r\n\r\nAtentamente,\r\n\r\nJuan Fernandez\r\nPresidente de la Junta de Condominio, Edificio 1B', 'media', '1B', '2025-06-14 09:45:50'),
(10, 'general', 'Envio de pagos del condominio', 'Estimado Presidente Central:\r\n\r\nMe dirijo a usted con el fin de informarle que se ha realizado el envío de todos los comprobantes de pago de condominio correspondientes a los residentes del Edificio 1A.\r\n\r\nQuedamos a su disposición para notificarle de inmediato ante cualquier eventualidad o problema que pudiera surgir en relación con la verificación de dichos pagos.\r\n\r\nAgradecemos de antemano su atención.', 'baja', '1A', '2025-06-08 17:39:35'),
(11, 'general', 'Envio de pagos del condominio', 'Estimado Presidente Central:\r\n\r\nMe dirijo a usted con el fin de informarle que se ha realizado el envío de todos los comprobantes de pago de condominio correspondientes a los residentes del Edificio 10A.\r\n\r\nQuedamos a su disposición para notificarle de inmediato ante cualquier eventualidad o problema que pudiera surgir en relación con la verificación de dichos pagos.\r\n\r\nAgradecemos de antemano su atención.', 'baja', '10A', '2025-06-14 10:27:13'),
(12, 'mantenimiento', 'Ejemplo', 'Lorem Ipsum es simplemente el texto de relleno de las imprentas y archivos de texto. Lorem Ipsum ha sido el texto de relleno estándar de las industrias desde el año 1500, cuando un impresor (N. del T. persona que se dedica a la imprenta) desconocido usó una galería de textos y los mezcló de tal manera que logró hacer un libro de textos especimen. No sólo sobrevivió 500 años, sino que tambien ingresó como texto de relleno en documentos electrónicos, quedando esencialmente igual al original. Fue popularizado en los 60s con la creación de las hojas \"Letraset\", las cuales contenian pasajes de Lorem Ipsum, y más recientemente con software de autoedición, como por ejemplo Aldus PageMaker, el cual incluye versiones de Lorem Ipsum.', 'media', '1A', '2025-06-14 14:29:28');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pagos`
--

CREATE TABLE `pagos` (
  `id` int(11) NOT NULL,
  `usuario` varchar(20) NOT NULL,
  `metodo_pago` enum('transferencia','pago_movil') NOT NULL,
  `deudaid` int(11) NOT NULL,
  `fecha_pago` date NOT NULL,
  `banco_origen` varchar(100) NOT NULL,
  `referencia` varchar(50) NOT NULL,
  `cedula` varchar(20) NOT NULL,
  `monto_pagado` decimal(10,2) NOT NULL,
  `telefono` varchar(20) NOT NULL,
  `archivo_comprobante` varchar(255) NOT NULL,
  `fecha_registro` timestamp NOT NULL DEFAULT current_timestamp(),
  `comentario` varchar(255) DEFAULT NULL,
  `estado` enum('aprobado','rechazado','en proceso','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pagos`
--

INSERT INTO `pagos` (`id`, `usuario`, `metodo_pago`, `deudaid`, `fecha_pago`, `banco_origen`, `referencia`, `cedula`, `monto_pagado`, `telefono`, `archivo_comprobante`, `fecha_registro`, `comentario`, `estado`) VALUES
(6, '1A-11', 'transferencia', 22, '2025-06-13', 'Mercantil', '0590512854102', 'V-29557849', 200.00, '04143001934', 'comprobante_684c7c111f8fd_pago cuota 1.pdf', '2025-06-13 19:29:21', NULL, 'aprobado'),
(7, '1A-11', 'transferencia', 23, '2025-06-13', 'Mercantil', '1234567891234', 'V-29557849', 300.00, '04143001934', 'comprobante_684c7e434190f_descarga (1).jpg', '2025-06-13 19:38:43', 'Pago de mantenimiento', 'aprobado'),
(9, '1A-11', 'transferencia', 24, '2025-06-13', 'Banesco', '1234567891234', 'V-29557849', 100.00, '04143001934', 'comprobante_684c937eca313_descarga.jpg', '2025-06-13 21:09:18', 'uyyugygygy', 'aprobado'),
(11, '1A-11', 'pago_movil', 24, '2025-06-12', 'Banesco', '0987654321123', 'V-29557849', 50.00, '04143001934', 'comprobante_684c970b0b384_IMG-20250321-WA0070-scaled.jpg', '2025-06-13 21:24:27', 'jkuggyy', 'rechazado'),
(12, '1A-11', 'transferencia', 24, '2025-06-14', 'Mercantil', '1234567890123', 'V-29557849', 50.00, '04143001934', 'comprobante_684d81df3175c_pago cuota 1.pdf', '2025-06-14 14:06:23', 'Pago de condominio', 'aprobado'),
(13, '1A-13', 'pago_movil', 27, '2025-06-14', 'Banesco', '1234567890123', 'V-29557849', 500.99, '04143001934', 'comprobante_684d82ff9effe_pago cuota 1.pdf', '2025-06-14 14:11:11', 'Pago de condominio', 'rechazado'),
(14, '1A-14', 'transferencia', 28, '2025-06-14', 'Mercantil', '1234567891234', 'V-29557849', 500.99, '04143001934', 'comprobante_684dbd4c5265c_pago cuota 1.pdf', '2025-06-14 18:19:56', 'Pago de la cuota mensual de condominio', 'rechazado'),
(15, '1A-14', 'transferencia', 46, '2025-06-14', 'Banesco', '1234567891234', 'V-29557849', 100.00, '04143001934', 'comprobante_684dbf1c6125f_descarga.jpg', '2025-06-14 18:27:40', 'Cuota de mantenimiento pago', 'aprobado'),
(16, '1A-11', 'transferencia', 24, '2025-06-14', 'banesco', '1234567890123', 'V-29557849', 50.00, '04143001934', 'comprobante_684dc18a734db_pago cuota 1.pdf', '2025-06-14 18:38:02', 'pago', 'aprobado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `presidente_central`
--

CREATE TABLE `presidente_central` (
  `id` int(11) NOT NULL,
  `usuario` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `ultima_modificacion` date DEFAULT NULL,
  `nombre_completo` varchar(255) NOT NULL,
  `telefono` varchar(15) NOT NULL,
  `correo` varchar(255) NOT NULL,
  `ultimo_login` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `presidente_central`
--

INSERT INTO `presidente_central` (`id`, `usuario`, `password`, `ultima_modificacion`, `nombre_completo`, `telefono`, `correo`, `ultimo_login`) VALUES
(1, 'juanfg', '$2y$10$FmKuIYZCteoB9NcsP5LVhuNQsGa1HJdv9rTN8lA1eDz4R8W/J2qZy', '2025-06-07', 'Juan Perez', '02123032547', 'juanito1@gmail.com', '2025-06-24 21:12:29');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `presidente_condominio`
--

CREATE TABLE `presidente_condominio` (
  `id` int(11) NOT NULL,
  `Terraza` enum('1','2','3','4','5','6','7','8','9','10','11','12','13') NOT NULL,
  `Edificio` enum('A','B','C','D','E','F','G','H','I','J','K') NOT NULL,
  `usuario` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `ultima_modificacion` date DEFAULT NULL,
  `nombre_completo` varchar(255) NOT NULL,
  `telefono` varchar(15) NOT NULL,
  `correo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `presidente_condominio`
--

INSERT INTO `presidente_condominio` (`id`, `Terraza`, `Edificio`, `usuario`, `password`, `ultima_modificacion`, `nombre_completo`, `telefono`, `correo`) VALUES
(1, '1', 'A', 'juanfg', '$2y$10$QOPWbDtQ5XmL8NcuyhPrx.0PO7FmWuYDD82assdjTH/6QD/V8NsS6', NULL, 'Juan Fernandez', '04143001934', 'juanmanuelfg9@gmail.com'),
(2, '1', 'B', 'juangf', '$2y$10$..cbUUm8A8x0AyAx80Bwx.TvNVvBemxuQDXDgVnzePD17mbvqtSJy', NULL, 'Juan Gonzalez', '04143001934', 'juanmanuelfg95@gmail.com'),
(4, '2', 'B', 'pedro11', '$2y$10$xYsnJfDogBxbwkKw4iCdb.FfnIWDp/DJaBOryclIV9UYSQU77LX.q', NULL, 'Pedro Perez', '04241234567', 'pedro@gmail.com'),
(5, '5', 'C', 'mariav', '$2y$10$20qhpu.qWkFuJf4z9JBPguNPVNqWZTCynsz./x55cRR0SizuEtEPG', NULL, 'Maria Victoria', '041612345678', 'maria@gmail.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicios`
--

CREATE TABLE `servicios` (
  `Id` int(11) NOT NULL,
  `Nombre` varchar(255) NOT NULL,
  `Descripcion` text NOT NULL,
  `Proveedor` varchar(150) NOT NULL,
  `Categoria` varchar(100) NOT NULL,
  `Contacto` varchar(255) NOT NULL,
  `Fecha` datetime NOT NULL,
  `Imagen` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `servicios`
--

INSERT INTO `servicios` (`Id`, `Nombre`, `Descripcion`, `Proveedor`, `Categoria`, `Contacto`, `Fecha`, `Imagen`) VALUES
(12, 'Powerlink: Conectando tu Mundo a la Velocidad de la Luz', 'En Powerlink, creemos que una conexión a internet no es solo un servicio, es tu ventana al mundo. Te ofrecemos una experiencia digital sin límites, con planes de alta velocidad que se adaptan a tus necesidades, ya sea que trabajes desde casa, disfrutes de tus series favoritas en streaming o te mantengas conectado con tus seres queridos. Olvídate de las interrupciones y la lentitud; con nuestra tecnología de vanguardia y un equipo de soporte dedicado, tu navegación será fluida, rápida y confiable. ¡Conéctate con Powerlink y descubre un universo de posibilidades!', 'Powerlink', 'Otros', '04241551884', '2025-06-08 09:29:12', '../../Vista/serviciosimg/servicio_68459028783af2.24189424.png'),
(14, 'Sparkle & Shine: Tu Hogar Impecable, Siempre', 'En Sparkle & Shine, entendemos que tu tiempo es valioso y tu hogar es tu santuario. Por eso, te ofrecemos un servicio de limpieza profesional y confiable, diseñado para devolverle el brillo a cada rincón de tu espacio. Desde limpiezas profundas hasta mantenimiento regular, nuestro equipo experto utiliza productos ecológicos y técnicas avanzadas para asegurar un ambiente impecable y saludable para ti y tu familia. Libérate de las tareas domésticas y déjanos el trabajo a nosotros. ¡Con Sparkle & Shine, tu hogar no solo estará limpio, estará reluciente!', 'Sparkle & Shine', 'Limpieza', '0412 987 6543', '2025-06-08 09:38:53', '../../Vista/serviciosimg/servicio_68459254172fd.jpg'),
(15, 'Soluciones Hogar: Mantenimiento Estructural para Tu Apartamento', 'En Soluciones Hogar, sabemos que tu apartamento es una inversión y un espacio vital que merece el mejor cuidado. Ofrecemos un servicio de mantenimiento especializado en la estructura interna de tu propiedad, asegurando que cada detalle funcione a la perfección y luzca impecable. Desde el cambio de cerámica y reparaciones de pisos, hasta la solución de problemas en paredes y techos, nuestro equipo de expertos está listo para afrontar cualquier desafío. Con profesionalismo, eficiencia y atención al detalle, garantizamos resultados duraderos que mejoran la funcionalidad y estética de tu hogar. Confía en Soluciones Hogar para mantener tu apartamento en óptimas condiciones, ¡y disfruta de la tranquilidad de un espacio perfecto!', 'Soluciones Hogar', 'Mantenimiento', '04165551234', '2025-06-08 09:46:34', '../../Vista/serviciosimg/servicio_6845943aa8f0b.png'),
(16, 'El Gran Salón: Donde Tus Sueños se Hacen Fiesta', 'En El Gran Salón, convertimos tus celebraciones en recuerdos inolvidables. Sabemos que cada evento es único, y por eso te ofrecemos un espacio versátil y elegante, perfecto para bodas, cumpleaños, quinceañeras, eventos corporativos y cualquier otra ocasión especial. Nuestro salón está diseñado para adaptarse a tus necesidades, con amplias áreas para tus invitados, una pista de baile vibrante y opciones de decoración personalizables que harán que tu visión cobre vida. Además, nuestro equipo experimentado te brindará el apoyo necesario para que cada detalle sea perfecto, desde la planificación hasta el último brindis. En El Gran Salón, tú pones el sueño y nosotros la fiesta.', 'Salón de fiesta La Quinta', 'Eventos', '04127890123', '2025-06-08 09:49:31', '../../Vista/serviciosimg/servicio_684594eba3b89.jpg'),
(17, 'Respuesta Inmediata: Tu Aliado en Emergencias', 'En Respuesta Inmediata, entendemos que cada segundo cuenta cuando se trata de una emergencia. Somos un servicio integral que combina la rapidez de una ambulancia con la efectividad de los bomberos, listos para actuar ante cualquier situación crítica. Desde emergencias médicas que requieren atención inmediata hasta incendios, rescates o accidentes, nuestro equipo altamente capacitado y equipado con tecnología de punta está disponible las 24 horas del día, los 7 días de la semana, para brindarte la ayuda que necesitas. Tu seguridad y bienestar son nuestra máxima prioridad. En momentos de incertidumbre, confía en Respuesta Inmediata para una intervención profesional y humana.', 'Respuesta Inmediata', 'Emergencia', '04127890123', '2025-06-08 09:52:05', '../../Vista/serviciosimg/servicio_6845958596bd3.jpg'),
(18, 'La Quinta Futsal: Pura Pasión en Cada Partido', '¿Eres de la Urbanización La Quinta y te apasiona el fútbol sala? ¡Entonces La Quinta Futsal es tu equipo! Somos más que un grupo de jugadores; somos una comunidad unida por el amor al balón, la sana competencia y la diversión. Nos reunimos regularmente para entrenar, mejorar nuestras habilidades y disputar emocionantes partidos llenos de estrategia y goles. Ya sea que busques mantenerte en forma, perfeccionar tu técnica o simplemente disfrutar del deporte y hacer nuevos amigos, La Quinta Futsal te ofrece el ambiente perfecto. ¡Únete a nosotros y vive la emoción de cada jugada en tu propia urbanización!', 'La Quinta Futsal', 'Recreativo', '04127890123', '2025-06-08 09:57:32', '../../Vista/serviciosimg/servicio_684596cc028ae.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `visitas`
--

CREATE TABLE `visitas` (
  `id` int(11) NOT NULL,
  `usuario` varchar(255) DEFAULT NULL,
  `tipo_usuario` varchar(50) DEFAULT NULL,
  `ip` varchar(45) DEFAULT NULL,
  `fecha` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `visitas`
--

INSERT INTO `visitas` (`id`, `usuario`, `tipo_usuario`, `ip`, `fecha`) VALUES
(1, 'juanfg', 'presidente_central', '::1', '2025-06-21 00:00:00'),
(2, 'juanfg', 'presidente_central', '::1', '2025-06-21 18:19:45'),
(3, 'juanfg', 'presidente_junta', '::1', '2025-06-21 00:00:00'),
(4, 'juanfg', 'presidente_central', '::1', '2025-06-22 15:15:38'),
(5, 'juanfg', 'presidente_junta', '::1', '2025-06-24 19:26:41'),
(6, 'juanfg', 'presidente_central', '::1', '2025-06-24 19:40:30'),
(7, 'juanfg', 'presidente_junta', '::1', '2025-06-24 19:44:55'),
(8, 'juanfg', 'presidente_central', '::1', '2025-06-24 21:12:29'),
(9, 'juanfg', 'presidente_junta', '::1', '2025-06-24 21:38:03');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `anunciosg`
--
ALTER TABLE `anunciosg`
  ADD PRIMARY KEY (`Id`);

--
-- Indices de la tabla `anuncios_edificio`
--
ALTER TABLE `anuncios_edificio`
  ADD PRIMARY KEY (`Id`);

--
-- Indices de la tabla `archivos_adjuntos`
--
ALTER TABLE `archivos_adjuntos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `informe_id` (`informe_id`);

--
-- Indices de la tabla `comunicados`
--
ALTER TABLE `comunicados`
  ADD PRIMARY KEY (`Id`);

--
-- Indices de la tabla `deudas`
--
ALTER TABLE `deudas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario` (`usuario`);

--
-- Indices de la tabla `edificios`
--
ALTER TABLE `edificios`
  ADD PRIMARY KEY (`usuario`);

--
-- Indices de la tabla `informes`
--
ALTER TABLE `informes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `pagos`
--
ALTER TABLE `pagos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario` (`usuario`),
  ADD KEY `pagos_ibfk_deuda` (`deudaid`);

--
-- Indices de la tabla `presidente_central`
--
ALTER TABLE `presidente_central`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `presidente_condominio`
--
ALTER TABLE `presidente_condominio`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `servicios`
--
ALTER TABLE `servicios`
  ADD PRIMARY KEY (`Id`);

--
-- Indices de la tabla `visitas`
--
ALTER TABLE `visitas`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `anunciosg`
--
ALTER TABLE `anunciosg`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `anuncios_edificio`
--
ALTER TABLE `anuncios_edificio`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `archivos_adjuntos`
--
ALTER TABLE `archivos_adjuntos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `comunicados`
--
ALTER TABLE `comunicados`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT de la tabla `deudas`
--
ALTER TABLE `deudas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;

--
-- AUTO_INCREMENT de la tabla `informes`
--
ALTER TABLE `informes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT de la tabla `pagos`
--
ALTER TABLE `pagos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `presidente_central`
--
ALTER TABLE `presidente_central`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `presidente_condominio`
--
ALTER TABLE `presidente_condominio`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `servicios`
--
ALTER TABLE `servicios`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `visitas`
--
ALTER TABLE `visitas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `archivos_adjuntos`
--
ALTER TABLE `archivos_adjuntos`
  ADD CONSTRAINT `archivos_adjuntos_ibfk_1` FOREIGN KEY (`informe_id`) REFERENCES `informes` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `deudas`
--
ALTER TABLE `deudas`
  ADD CONSTRAINT `deudas_ibfk_1` FOREIGN KEY (`usuario`) REFERENCES `edificios` (`usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `pagos`
--
ALTER TABLE `pagos`
  ADD CONSTRAINT `pagos_ibfk_1` FOREIGN KEY (`usuario`) REFERENCES `edificios` (`usuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pagos_ibfk_deuda` FOREIGN KEY (`deudaid`) REFERENCES `deudas` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
