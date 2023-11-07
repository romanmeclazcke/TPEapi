<?php
class Model {
    protected $db;

    function __construct() {
        $this->db = new PDO('mysql:host='. MYSQL_HOST .';dbname='. MYSQL_DB .';charset=utf8', MYSQL_USER, MYSQL_PASS);
        $this->deploy();
    }

    function deploy() {
        $query = $this->db->query('SHOW TABLES');
        $tables = $query->fetchAll(); 
        if(count($tables)==0) {
            $sql = <<<END
            -- phpMyAdmin SQL Dump
            -- version 5.2.1
            -- https://www.phpmyadmin.net/
            --
            -- Servidor: 127.0.0.1
            -- Tiempo de generación: 07-11-2023 a las 16:33:52
            -- Versión del servidor: 10.4.28-MariaDB
            -- Versión de PHP: 8.2.4
            
            SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
            START TRANSACTION;
            SET time_zone = "+00:00";
            
            
            /*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
            /*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
            /*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
            /*!40101 SET NAMES utf8mb4 */;
            
            --
            -- Base de datos: `tpe`
            --
            
            -- --------------------------------------------------------
            
            --
            -- Estructura de tabla para la tabla `categoria`
            --
            
            CREATE TABLE `categoria` (
              `id` int(11) NOT NULL,
              `tipo` varchar(200) NOT NULL
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
            
            --
            -- Volcado de datos para la tabla `categoria`
            --
            
            INSERT INTO `categoria` (`id`, `tipo`) VALUES
            (1, 'Exterior'),
            (2, 'Cocina'),
            (3, 'Baño'),
            (4, 'Oficina'),
            (5, 'Interior');
            
            -- --------------------------------------------------------
            
            --
            -- Estructura de tabla para la tabla `productos`
            --
            
            CREATE TABLE `productos` (
              `id` int(11) NOT NULL,
              `nombre` varchar(200) NOT NULL,
              `material` varchar(200) NOT NULL,
              `precio` double NOT NULL,
              `imagen` varchar(1000) NOT NULL,
              `categoria` int(11) NOT NULL
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
            
            --
            -- Volcado de datos para la tabla `productos`
            --
            
            INSERT INTO `productos` (`id`, `nombre`, `material`, `precio`, `imagen`, `categoria`) VALUES
            (4, 'Silla oficina', 'Plastico', 8750, 'https://http2.mlstatic.com/D_NQ_NP_601919-MLA52213058676_102022-O.webp', 4),
            (6, 'Tocador doble', 'Marmol', 16500, 'https://hips.hearstapps.com/es.h-cdn.co/mcres/images/mi-casa/banos/tocador-doble/1316665-2-esl-ES/tocador-doble.jpg?resize=640:*', 3),
            (7, 'Tocador simple', 'Marmol', 13800, 'https://www.elmueble.com/medio/2023/02/27/bano-con-ducha-y-mueble-volado-blanco_00000000_00495436_230227225011_600x600.jpg', 3),
            (11, 'Reposera de playa', 'Metal', 8000, 'https://http2.mlstatic.com/D_NQ_NP_2X_876334-MLU71211856642_082023-F.webp', 1),
            (13, 'Reposera doble', 'Aluminio', 30000, 'https://http2.mlstatic.com/D_NQ_NP_2X_805418-MLA69553507784_052023-F.webp', 1),
            (14, 'asasd', 'Madera', 89000, 'https://http2.mlstatic.com/D_NQ_NP_2X_787937-MLA43407388198_092020-F.webp', 3),
            (15, 'Organizador de Baño', 'Madera', 16000, 'https://http2.mlstatic.com/D_NQ_NP_2X_601909-MLA71086972510_082023-F.webp', 3),
            (16, 'Organizador de baño', 'Aluminio', 12800, 'https://http2.mlstatic.com/D_NQ_NP_2X_760338-MLA71826850502_092023-F.webp', 3),
            (17, 'Mesa de comedor Simple', 'Madera', 16780, 'https://http2.mlstatic.com/D_NQ_NP_2X_767044-MLA71125146869_082023-F.webp', 2),
            (18, 'Alacena 2 Puertas', 'Madera', 10999, ' https://http2.mlstatic.com/D_NQ_NP_2X_804487-MLA70002035183_062023-F.webp', 2),
            (20, 'Organizador colgante', 'Madera', 13500, 'https://http2.mlstatic.com/D_NQ_NP_2X_816150-MLU71139771797_082023-F.webp', 3),
            (21, 'Tacho de basura', 'Aluminio', 8900, 'https://http2.mlstatic.com/D_NQ_NP_2X_660724-MLA71954567485_092023-F.webp', 2),
            (22, 'Sofa esquienro', 'Madera/lona', 87000, 'https://http2.mlstatic.com/D_NQ_NP_2X_807117-MLA51739692118_092022-F.webp', 5),
            (23, 'Sillon individual', 'Madera/Lona', 28000, 'https://http2.mlstatic.com/D_NQ_NP_2X_892538-MLA71898784946_092023-F.webp', 5),
            (28, 'Estanteria Libros', 'Madera', 13000, 'https://http2.mlstatic.com/D_NQ_NP_2X_682539-MLA44678279022_012021-F.webp', 4),
            (29, 'Hamaca paraguaya', 'tela', 9999, 'https://http2.mlstatic.com/D_NQ_NP_2X_726973-MLA53226764822_012023-F.webp', 1),
            (30, 'Combo 6 sillas y mesa', 'plastico', 40000, 'https://http2.mlstatic.com/D_NQ_NP_2X_943509-MLA71435186403_082023-F.webp', 1),
            (32, 'Escritorio y silla oficina', 'Aluminio', 56000, 'https://http2.mlstatic.com/D_NQ_NP_2X_908293-MLA53966224426_022023-F.webp', 4),
            (33, 'Placard ', 'Madera', 23800, 'https://http2.mlstatic.com/D_NQ_NP_2X_670742-MLA52347344819_112022-F.webp', 5),
            (34, 'asdasd', 'Madera', 80000, 'https://http2.mlstatic.com/D_NQ_NP_2X_660914-MLA49951522983_052022-F.webp', 5);
            
            -- --------------------------------------------------------
            
            --
            -- Estructura de tabla para la tabla `usuarios`
            --
            
            CREATE TABLE `usuarios` (
              `id` int(11) NOT NULL,
              `email` varchar(150) NOT NULL,
              `password` varchar(150) NOT NULL,
              `admin` tinyint(1) NOT NULL
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
            
            --
            -- Volcado de datos para la tabla `usuarios`
            --
            
            INSERT INTO `usuarios` (`id`, `email`, `password`, `admin`) VALUES
            (16, 'webadmin@gmail.com', '$2y$10$86Byn3XALNtLZjd84kcOZesKnFOA3WtqY6TsQ2aCx5c4WHJf92I8m', 1),
            (18, 'maia.manze@gmail.com', '$2y$10$J315ytKj5WJyR8l7vY3p..VzVy3MpF6Diie/Vwy3kENJ5XNZqrT0a', 0);
            
            --
            -- Índices para tablas volcadas
            --
            
            --
            -- Indices de la tabla `categoria`
            --
            ALTER TABLE `categoria`
              ADD PRIMARY KEY (`id`);
            
            --
            -- Indices de la tabla `productos`
            --
            ALTER TABLE `productos`
              ADD PRIMARY KEY (`id`),
              ADD KEY `categoria_fk` (`categoria`);
            
            --
            -- Indices de la tabla `usuarios`
            --
            ALTER TABLE `usuarios`
              ADD PRIMARY KEY (`id`);
            
            --
            -- AUTO_INCREMENT de las tablas volcadas
            --
            
            --
            -- AUTO_INCREMENT de la tabla `categoria`
            --
            ALTER TABLE `categoria`
              MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;
            
            --
            -- AUTO_INCREMENT de la tabla `productos`
            --
            ALTER TABLE `productos`
              MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
            
            --
            -- AUTO_INCREMENT de la tabla `usuarios`
            --
            ALTER TABLE `usuarios`
              MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
            
            --
            -- Restricciones para tablas volcadas
            --
            
            --
            -- Filtros para la tabla `productos`
            --
            ALTER TABLE `productos`
              ADD CONSTRAINT `categoria_fk` FOREIGN KEY (`categoria`) REFERENCES `categoria` (`id`);
            COMMIT;
            
            /*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
            /*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
            /*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
            

            END;
            $this->db->query($sql);
        }
    }
}