-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 05-12-2024 a las 04:14:44
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
-- Base de datos: `fluffy_pasteleria`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `add_product` (IN `p_id_category` TINYINT UNSIGNED, IN `p_product_name` VARCHAR(255), IN `p_description` TEXT, IN `p_price` DECIMAL(10,2), IN `p_unity_price` DECIMAL(6,2), IN `p_available_unity` TINYINT UNSIGNED)   BEGIN
    INSERT INTO products (id_category, product_name, description, price, unity_price, available_unity)
    VALUES (p_id_category, p_product_name, p_description, p_price, p_unity_price, p_available_unity);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `create_order` (IN `p_document_number` BIGINT UNSIGNED, OUT `order_id` BIGINT UNSIGNED)   BEGIN
    INSERT INTO orders (document_number) VALUES (p_document_number);
    SET order_id = LAST_INSERT_ID();
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `delete_product` (IN `p_product_code` BIGINT UNSIGNED)   BEGIN
    DELETE FROM products WHERE product_code = p_product_code;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `register_user` (IN `p_document_number` BIGINT UNSIGNED, IN `p_document_type` VARCHAR(30), IN `p_email` VARCHAR(100), IN `p_password` VARCHAR(255), IN `p_name` VARCHAR(50), IN `p_lastname` VARCHAR(50))   BEGIN
    INSERT INTO register (document_number, document_type, email, password)
    VALUES (p_document_number, p_document_type, p_email, p_password);
    INSERT INTO users (document_number, name, lastname, document_type, email)
    VALUES (p_document_number, p_name, p_lastname, p_document_type, p_email);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `update_info_product` (IN `p_product_code` BIGINT UNSIGNED, IN `p_price` DECIMAL(10,2), IN `p_discount` DECIMAL(5,2), IN `p_status` ENUM('available','out_of_stock','discontinued'))   BEGIN
    UPDATE products 
    SET price = p_price, discount = p_discount, status = p_status 
    WHERE product_code = p_product_code;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `update_users_details` (IN `p_document_number` BIGINT UNSIGNED, IN `p_name` VARCHAR(50), IN `p_lastname` VARCHAR(50), IN `p_email` VARCHAR(100), IN `p_country` VARCHAR(50), IN `p_state` VARCHAR(50), IN `p_city` VARCHAR(50), IN `p_address` VARCHAR(150), IN `p_phone` VARCHAR(20))   BEGIN
    UPDATE users_details d
    INNER JOIN users u ON d.document_number = u.document_number
    SET u.name = p_name, u.lastname = p_lastname, u.email = p_email, d.country = p_country, d.state = p_state, d.city = p_city, d.address = p_address, d.phone = p_phone
    WHERE d.document_number = p_document_number;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cancellations_order`
--

CREATE TABLE `cancellations_order` (
  `id_cancellations_order` bigint(20) UNSIGNED NOT NULL,
  `id_orders` bigint(20) UNSIGNED NOT NULL,
  `cancellations_date` datetime NOT NULL DEFAULT current_timestamp(),
  `motive` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `cancellations_order`
--

INSERT INTO `cancellations_order` (`id_cancellations_order`, `id_orders`, `cancellations_date`, `motive`) VALUES
(1, 4, '2024-11-21 15:00:00', 'Cancelación por error en la dirección'),
(2, 8, '2024-11-24 09:30:00', 'Pedido duplicado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `category`
--

CREATE TABLE `category` (
  `id_category` tinyint(3) UNSIGNED NOT NULL,
  `category_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `category`
--

INSERT INTO `category` (`id_category`, `category_name`) VALUES
(5, 'Alfajores'),
(4, 'Brookies'),
(3, 'Brownies'),
(2, 'Cakes'),
(7, 'Caseritas'),
(8, 'Cheescake'),
(1, 'Cookies'),
(6, 'Cupcakes');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `config`
--

CREATE TABLE `config` (
  `id_config` bigint(20) UNSIGNED NOT NULL,
  `document_number` bigint(20) UNSIGNED DEFAULT NULL,
  `category` enum('theme','font','color','other') NOT NULL DEFAULT 'other',
  `config_key` varchar(100) NOT NULL,
  `config_value` text NOT NULL,
  `is_active` tinyint(3) UNSIGNED DEFAULT 1,
  `date_add` datetime NOT NULL DEFAULT current_timestamp(),
  `date_upd` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `languages`
--

CREATE TABLE `languages` (
  `id_language` tinyint(3) UNSIGNED NOT NULL,
  `language_code` char(5) NOT NULL,
  `language_name` varchar(50) NOT NULL,
  `status` enum('active','inactive') DEFAULT 'active',
  `date_add` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `languages`
--

INSERT INTO `languages` (`id_language`, `language_code`, `language_name`, `status`, `date_add`, `date_updated`) VALUES
(1, 'es-CO', 'Español (Colombia)', 'active', '2024-12-04 22:10:56', '2024-12-04 22:10:56'),
(2, 'en-US', 'English (United States)', 'active', '2024-12-04 22:10:56', '2024-12-04 22:10:56'),
(3, 'es-ES', 'Español (España)', 'active', '2024-12-04 22:10:56', '2024-12-04 22:10:56'),
(4, 'fr-FR', 'Français (France)', 'inactive', '2024-12-04 22:10:56', '2024-12-04 22:10:56'),
(5, 'it-IT', 'Italiano (Italia)', 'inactive', '2024-12-04 22:10:56', '2024-12-04 22:10:56'),
(6, 'de-DE', 'Deutsch (Deutschland)', 'inactive', '2024-12-04 22:10:56', '2024-12-04 22:10:56'),
(7, 'pt-BR', 'Português (Brasil)', 'inactive', '2024-12-04 22:10:56', '2024-12-04 22:10:56'),
(8, 'zh-CN', '中文 (简体)', 'inactive', '2024-12-04 22:10:56', '2024-12-04 22:10:56'),
(9, 'ja-JP', '日本語 (日本)', 'inactive', '2024-12-04 22:10:56', '2024-12-04 22:10:56'),
(10, 'ru-RU', 'Русский (Россия)', 'inactive', '2024-12-04 22:10:56', '2024-12-04 22:10:56');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `login_history`
--

CREATE TABLE `login_history` (
  `id_login` bigint(20) UNSIGNED NOT NULL,
  `document_number` bigint(20) UNSIGNED NOT NULL,
  `login_timestamp` datetime NOT NULL DEFAULT current_timestamp(),
  `logout_timestamp` datetime DEFAULT NULL,
  `device_info` varchar(255) DEFAULT NULL,
  `browser_info` varchar(255) DEFAULT NULL,
  `success` enum('success','failure') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `login_history`
--

INSERT INTO `login_history` (`id_login`, `document_number`, `login_timestamp`, `logout_timestamp`, `device_info`, `browser_info`, `success`) VALUES
(1, 1039476766, '2024-11-20 08:30:00', '2024-11-20 09:00:00', 'Windows 10', 'Chrome 95', 'success'),
(2, 1039476451, '2024-11-19 10:15:00', '2024-11-19 10:45:00', 'iOS', 'Safari 15', 'success'),
(3, 21698160, '2024-11-18 11:00:00', NULL, 'Android', 'Chrome 95', 'failure'),
(4, 30028670, '2024-11-18 14:30:00', '2024-11-18 15:00:00', 'MacOS', 'Firefox 93', 'success'),
(5, 1034567827, '2024-11-17 16:00:00', '2024-11-17 16:30:00', 'Windows 10', 'Edge 94', 'success'),
(6, 102034678, '2024-11-16 18:00:00', '2024-11-16 18:30:00', 'Android', 'Chrome 95', 'failure'),
(7, 93117052, '2024-11-15 20:00:00', '2024-11-15 20:45:00', 'iOS', 'Safari 15', 'success'),
(8, 1039675432, '2024-11-15 21:00:00', NULL, 'Linux', 'Chrome 95', 'failure'),
(9, 21345678, '2024-11-14 22:00:00', NULL, 'Windows 7', 'Chrome 92', 'failure'),
(10, 12345678, '2024-11-13 23:00:00', '2024-11-13 23:30:00', 'Windows 10', 'Edge 94', 'success');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `orders`
--

CREATE TABLE `orders` (
  `id_orders` bigint(20) UNSIGNED NOT NULL,
  `document_number` bigint(20) UNSIGNED NOT NULL,
  `order_date` datetime NOT NULL DEFAULT current_timestamp(),
  `status` enum('pending','confirmed','delivered','cancelled') NOT NULL DEFAULT 'pending',
  `payment_status` enum('paid','unpaid','pending') DEFAULT 'pending',
  `total_price` decimal(10,2) NOT NULL,
  `discount` decimal(5,2) DEFAULT 0.00,
  `date_upd` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `orders`
--

INSERT INTO `orders` (`id_orders`, `document_number`, `order_date`, `status`, `payment_status`, `total_price`, `discount`, `date_upd`) VALUES
(1, 1039476451, '2024-11-20 10:30:00', 'confirmed', 'paid', 17000.00, 0.00, '2024-12-04 22:10:56'),
(2, 1039476766, '2024-11-20 12:15:00', 'confirmed', 'paid', 25200.00, 999.99, '2024-12-04 22:10:56'),
(3, 30028670, '2024-11-21 14:00:00', 'delivered', 'paid', 39900.00, 999.99, '2024-12-04 22:10:56'),
(4, 1039675432, '2024-11-22 16:45:00', 'pending', 'unpaid', 24225.00, 999.99, '2024-12-04 22:10:56'),
(5, 93117052, '2024-11-23 18:30:00', 'confirmed', 'paid', 84000.00, 0.00, '2024-12-04 22:10:56'),
(6, 1034567827, '2024-11-24 11:20:00', 'confirmed', 'paid', 28000.00, 0.00, '2024-12-04 22:10:56'),
(7, 12345678, '2024-11-24 15:30:00', 'confirmed', 'paid', 42500.00, 0.00, '2024-12-04 22:10:56'),
(8, 21345678, '2024-11-25 09:50:00', 'cancelled', 'unpaid', 37800.00, 999.99, '2024-12-04 22:10:56'),
(9, 102034678, '2024-11-25 13:40:00', 'confirmed', 'paid', 26600.00, 999.99, '2024-12-04 22:10:56'),
(10, 21698160, '2024-11-26 17:10:00', 'pending', 'unpaid', 80750.00, 999.99, '2024-12-04 22:10:56');

--
-- Disparadores `orders`
--
DELIMITER $$
CREATE TRIGGER `order_cancellation` AFTER UPDATE ON `orders` FOR EACH ROW BEGIN 
    IF OLD.status != 'cancelled' AND NEW.status = 'cancelled' THEN 
        INSERT INTO cancellations_order (id_orders, cancellation_date) VALUES (NEW.id_orders, NOW()); 
    END IF;  
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `user_activity` AFTER INSERT ON `orders` FOR EACH ROW BEGIN 
    INSERT INTO user_activity (document_number, activity_timestamp, action_type, action_description)
   	VALUES (NEW.document_number, NOW(), 'Order Created', CONCAT('Order ID: ', NEW.id_orders)); 
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_history`
--

CREATE TABLE `password_history` (
  `id_history` bigint(20) UNSIGNED NOT NULL,
  `document_number` bigint(20) UNSIGNED NOT NULL,
  `old_password` varchar(255) NOT NULL,
  `password_reset_reason` enum('forgotten','user_request','security_update') DEFAULT NULL,
  `change_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `password_history`
--

INSERT INTO `password_history` (`id_history`, `document_number`, `old_password`, `password_reset_reason`, `change_date`) VALUES
(1, 1039476451, 'Aa12345*', 'user_request', '2024-11-10 10:00:00'),
(2, 1039476766, 'Pp12345*', 'security_update', '2024-11-15 14:00:00'),
(3, 30028670, 'Oo12345*', 'forgotten', '2024-11-18 12:30:00'),
(4, 93117052, 'Ee12345*', 'user_request', '2024-11-20 09:00:00'),
(5, 1034567827, 'Ll12345*', 'security_update', '2024-11-22 10:30:00'),
(6, 12345678, 'Zz12345*', 'forgotten', '2024-11-23 14:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `products`
--

CREATE TABLE `products` (
  `product_code` bigint(20) UNSIGNED NOT NULL,
  `id_category` tinyint(3) UNSIGNED NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `ingredients` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `discount` decimal(5,2) DEFAULT 0.00,
  `available_unity` tinyint(3) UNSIGNED DEFAULT NULL,
  `minimum_stock` int(10) UNSIGNED DEFAULT 10,
  `maximum_stock` int(10) UNSIGNED DEFAULT 50,
  `unity_price` decimal(6,2) NOT NULL,
  `date_add` datetime NOT NULL DEFAULT current_timestamp(),
  `date_upd` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` enum('available','out_of_stock','discontinued') DEFAULT 'available',
  `display_order` int(10) UNSIGNED DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `products`
--

INSERT INTO `products` (`product_code`, `id_category`, `product_name`, `description`, `ingredients`, `price`, `discount`, `available_unity`, `minimum_stock`, `maximum_stock`, `unity_price`, `date_add`, `date_upd`, `status`, `display_order`) VALUES
(101, 1, 'Cookie SMORE', '', NULL, 8500.00, 0.00, NULL, 10, 50, 0.00, '2024-12-04 22:10:56', '2024-12-04 22:10:56', 'available', 1),
(102, 1, 'Cookie CHOCOCRUJI', '', NULL, 8500.00, 0.00, NULL, 10, 50, 0.00, '2024-12-04 22:10:56', '2024-12-04 22:10:56', 'available', 1),
(103, 1, 'Cookie CHOCO CLÁSICA', '', NULL, 8500.00, 0.00, NULL, 10, 50, 0.00, '2024-12-04 22:10:56', '2024-12-04 22:10:56', 'available', 1),
(104, 1, 'Cookie NUTELLA', '', NULL, 8500.00, 0.00, NULL, 10, 50, 0.00, '2024-12-04 22:10:56', '2024-12-04 22:10:56', 'available', 1),
(105, 1, 'Cookie PIE DE LIMÓN', '', NULL, 8500.00, 0.00, NULL, 10, 50, 0.00, '2024-12-04 22:10:56', '2024-12-04 22:10:56', 'available', 1),
(106, 1, 'Cookie PIE DE MANZANA', '', NULL, 8500.00, 0.00, NULL, 10, 50, 0.00, '2024-12-04 22:10:56', '2024-12-04 22:10:56', 'available', 1),
(107, 1, 'Cookie RED VELVET', '', NULL, 8500.00, 0.00, NULL, 10, 50, 0.00, '2024-12-04 22:10:56', '2024-12-04 22:10:56', 'available', 1),
(108, 1, 'Cookie CUMPLEAÑOS', '', NULL, 8500.00, 0.00, NULL, 10, 50, 0.00, '2024-12-04 22:10:56', '2024-12-04 22:10:56', 'available', 1),
(109, 1, 'Cookie CHURRO CON AREQUIPE', '', NULL, 8500.00, 0.00, NULL, 10, 50, 0.00, '2024-12-04 22:10:56', '2024-12-04 22:10:56', 'available', 1),
(110, 1, 'Cookie PISTACHO', '', NULL, 8500.00, 0.00, NULL, 10, 50, 0.00, '2024-12-04 22:10:56', '2024-12-04 22:10:56', 'available', 1),
(111, 1, 'Cookie CHOCO BLANCO CON NUECES', '', NULL, 8500.00, 0.00, NULL, 10, 50, 0.00, '2024-12-04 22:10:56', '2024-12-04 22:10:56', 'available', 1),
(112, 1, 'Cookie OREO RELLENA DE CHEESECAKE', '', NULL, 8500.00, 0.00, NULL, 10, 50, 0.00, '2024-12-04 22:10:56', '2024-12-04 22:10:56', 'available', 1),
(113, 1, 'Caja x4 Cookies', '', NULL, 28000.00, 0.00, NULL, 10, 50, 0.00, '2024-12-04 22:10:56', '2024-12-04 22:10:56', 'available', 1),
(114, 1, 'Caja x6 Cookies', '', NULL, 42000.00, 0.00, NULL, 10, 50, 0.00, '2024-12-04 22:10:56', '2024-12-04 22:10:56', 'available', 1);

--
-- Disparadores `products`
--
DELIMITER $$
CREATE TRIGGER `check_minimum_stock` AFTER UPDATE ON `products` FOR EACH ROW BEGIN 
    IF NEW.available_unity < NEW.minimum_stock THEN 
        INSERT INTO stock_alerts (product_code, alert_date) 
       	VALUES (NEW.product_code, NOW()); 
    END IF; 
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `product_order`
--

CREATE TABLE `product_order` (
  `id_product_order` bigint(20) UNSIGNED NOT NULL,
  `id_orders` bigint(20) UNSIGNED NOT NULL,
  `product_code` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(10) UNSIGNED NOT NULL DEFAULT 1,
  `unit_price` decimal(10,2) NOT NULL,
  `discount` decimal(10,2) DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Disparadores `product_order`
--
DELIMITER $$
CREATE TRIGGER `update_product_inventory` AFTER INSERT ON `product_order` FOR EACH ROW BEGIN
    UPDATE products
    SET available_unity = available_unity - NEW.quantity
    WHERE product_code = NEW.product_code;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `register`
--

CREATE TABLE `register` (
  `document_number` bigint(20) UNSIGNED NOT NULL,
  `document_type` varchar(30) NOT NULL,
  `name` varchar(100),
  `lastname` varchar(100),
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `date_add` datetime NOT NULL DEFAULT current_timestamp(),
  `registration_status` enum('pending','verified','rejected') DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `register`
--

INSERT INTO `register` (`document_number`, `document_type`, `email`, `password`, `date_add`, `registration_status`) VALUES
(12345678, 'cc', 'luis.lopez@gmail.com', 'Zz12345*', '2024-12-04 22:10:56', 'verified'),
(21345678, 'cc', 'sarah.davis@gmail.com', 'Ss12345*', '2024-12-04 22:10:56', 'rejected'),
(21698160, 'cc', 'martha.nelsi.guerra@gmail.com', 'Mm12345*', '2024-12-04 22:10:56', 'rejected'),
(30028670, 'cc', 'patriciapuerta1030@gmail.com', 'Oo12345*', '2024-12-04 22:10:56', 'verified'),
(93117052, 'cc', 'emily.jones@gmail.com', 'Ee12345*', '2024-12-04 22:10:56', 'verified'),
(102034678, 't.i', 'carlos.lopez@gmail.com', 'Cc12345*', '2024-12-04 22:10:56', 'pending'),
(1034567827, 'cc', 'lunava0505@gmail.com', 'Ll12345*', '2024-12-04 22:10:56', 'pending'),
(1039476451, 'cc', 'paolaandreagonzalezg231@gmail.com', 'Pp12345*', '2024-12-04 22:10:56', ''),
(1039476766, 'cc', 'a.g.g0109180@gmail.com', 'Aa12345*', '2024-12-04 22:10:56', 'verified'),
(1039675432, 'cc', 'michael.brown@gmail.com', 'Bb12345*', '2024-12-04 22:10:56', 'pending');

--
-- Disparadores `register`
--
DELIMITER $$
CREATE TRIGGER `verify_change_password` BEFORE UPDATE ON `register` FOR EACH ROW BEGIN
    IF OLD.password != NEW.password THEN
        INSERT INTO password_history (document_number, old_password, password_reset_reason, change_date)
        VALUES (OLD.document_number, OLD.password, 'forgotten', NOW());
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sales`
--

CREATE TABLE `sales` (
  `sales_code` bigint(20) UNSIGNED NOT NULL,
  `id_orders` bigint(20) UNSIGNED NOT NULL,
  `document_number` bigint(20) UNSIGNED NOT NULL,
  `sale_date` datetime NOT NULL DEFAULT current_timestamp(),
  `total_price` decimal(10,0) NOT NULL,
  `discount` decimal(5,2) DEFAULT 0.00,
  `payment_method` enum('bank_transfer, cash') NOT NULL,
  `delivery_date` datetime DEFAULT current_timestamp(),
  `delivery_address` varchar(150) DEFAULT NULL,
  `delivery_city` varchar(50) DEFAULT NULL,
  `delivery_state` varchar(50) DEFAULT NULL,
  `delivery_country` varchar(50) DEFAULT NULL,
  `date_upd` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `sales`
--

INSERT INTO `sales` (`sales_code`, `id_orders`, `document_number`, `sale_date`, `total_price`, `discount`, `payment_method`, `delivery_date`, `delivery_address`, `delivery_city`, `delivery_state`, `delivery_country`, `date_upd`) VALUES
(1, 1, 1039476451, '2024-11-20 10:30:00', 17000, 0.00, '', '2024-11-21 14:00:00', 'Calle 10 #34-56', 'Bogotá', 'Cundinamarca', 'Colombia', '2024-12-04 22:10:56'),
(2, 2, 1039476766, '2024-11-20 12:30:00', 25200, 999.99, '', '2024-11-22 10:00:00', 'Carrera 45 #23-90', 'Medellín', 'Antioquia', 'Colombia', '2024-12-04 22:10:56'),
(3, 3, 30028670, '2024-11-21 14:30:00', 39900, 999.99, '', '2024-11-23 16:00:00', 'Carrera 12 #34-78', 'Cali', 'Valle del Cauca', 'Colombia', '2024-12-04 22:10:56'),
(4, 5, 93117052, '2024-11-23 18:00:00', 84000, 0.00, '', '2024-11-25 14:30:00', 'Avenida 6 #78-90', 'Cartagena', 'Bolívar', 'Colombia', '2024-12-04 22:10:56'),
(5, 6, 1034567827, '2024-11-24 12:00:00', 28000, 0.00, '', '2024-11-26 12:00:00', 'Calle 34 #56-12', 'Barranquilla', 'Atlántico', 'Colombia', '2024-12-04 22:10:56'),
(6, 7, 12345678, '2024-11-24 16:00:00', 42500, 0.00, '', '2024-11-26 18:00:00', 'Carrera 78 #45-23', 'Bucaramanga', 'Santander', 'Colombia', '2024-12-04 22:10:56');

--
-- Disparadores `sales`
--
DELIMITER $$
CREATE TRIGGER `update_order_status` AFTER INSERT ON `sales` FOR EACH ROW BEGIN 
    UPDATE orders SET status = 'delivered' 
   	WHERE id_orders = NEW.id_orders; 
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `shopping_cart`
--

CREATE TABLE `shopping_cart` (
  `cart_id` bigint(20) UNSIGNED NOT NULL,
  `document_number` bigint(20) UNSIGNED NOT NULL,
  `product_code` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(10) UNSIGNED NOT NULL DEFAULT 1,
  `date_added` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Disparadores `shopping_cart`
--
DELIMITER $$
CREATE TRIGGER `update_products_on_cart_delete` AFTER DELETE ON `shopping_cart` FOR EACH ROW BEGIN
	UPDATE products
	SET available_unity = available_unity + OLD.quantity
	WHERE product_code = OLD.product_code;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `document_number` bigint(20) UNSIGNED NOT NULL,
  `id_language` tinyint(3) UNSIGNED NOT NULL,
  `active` tinyint(3) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `document_type` varchar(30) NOT NULL,
  `email` varchar(100) NOT NULL,
  `rol` enum('admin','cliente') NOT NULL DEFAULT 'cliente',
  `date_add` datetime NOT NULL DEFAULT current_timestamp(),
  `date_upd` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`document_number`, `id_language`, `active`, `name`, `lastname`, `document_type`, `email`, `rol`, `date_add`, `date_upd`) VALUES
(12345678, 1, 1, 'Luis', 'Lopez', 'cc', 'luis.lopez@gmail.com', 'cliente', '2024-12-04 22:10:56', '2024-12-04 22:10:56'),
(21345678, 2, 0, 'Sarah', 'Davis', 'cc', 'sarah.davis@gmail.com', 'cliente', '2024-12-04 22:10:56', '2024-12-04 22:10:56'),
(21698160, 1, 0, 'Martha', 'Guerra', 'cc', 'martha.nelsi.guerra@gmail.com', 'cliente', '2024-12-04 22:10:56', '2024-12-04 22:10:56'),
(30028670, 1, 1, 'Patricia', 'Puerta', 'cc', 'patriciapuerta1030@gmail.com', 'cliente', '2024-12-04 22:10:56', '2024-12-04 22:10:56'),
(93117052, 2, 1, 'Emily', 'Jones', 'cc', 'emily.jones@gmail.com', 'cliente', '2024-12-04 22:10:56', '2024-12-04 22:10:56'),
(102034678, 1, 1, 'Carlos', 'Lopez', 't.i', 'carlos.lopez@gmail.com', 'cliente', '2024-12-04 22:10:56', '2024-12-04 22:10:56'),
(1034567827, 1, 1, 'Luna', 'Navarro', 'cc', 'lunava0505@gmail.com', 'cliente', '2024-12-04 22:10:56', '2024-12-04 22:10:56'),
(1039476451, 1, 1, 'Paola', 'Gonzalez', 'cc', 'paolaandreagonzalezg231@gmail.com', 'cliente', '2024-12-04 22:10:56', '2024-12-04 22:10:56'),
(1039476766, 1, 1, 'Ana', 'Gonzalez', 'cc', 'a.g.g0109180@gmail.com', 'admin', '2024-12-04 22:10:56', '2024-12-04 22:10:56'),
(1039675432, 2, 1, 'Michael', 'Brown', 'cc', 'michael.brown@gmail.com', 'cliente', '2024-12-04 22:10:56', '2024-12-04 22:10:56');

--
-- Disparadores `users`
--
DELIMITER $$
CREATE TRIGGER `log_user_inactivity` AFTER UPDATE ON `users` FOR EACH ROW BEGIN 
	IF OLD.active = 1 AND NEW.active = 0 THEN 
		INSERT INTO user_activity (document_number, activity_timestamp, action_type, action_description)
		VALUES (NEW.document_number, NOW(), 'user inactivity', 'user marked as inactive');
	END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `log_user_update` AFTER UPDATE ON `users` FOR EACH ROW BEGIN 
	INSERT INTO users_activity (document_number, activity_timestamp, action_type, action_description)
	VALUES (NEW.document_number, NOW(), 'User Update',
	CONCAT('Update fields: ',
	IF(OLD.name != NEW.name, 'name, ', ''),
	IF(OLD.lastname != NEW.lastname, 'lastname, ', ''),
	IF(OLD.email != NEW.email, 'email, ','')));
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `login_history` AFTER INSERT ON `users` FOR EACH ROW BEGIN 
    INSERT INTO login_history (document_number, login_timestamp, success)
   	VALUES (NEW.document_number, NOW(), 'success'); 
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `verify_registration` AFTER INSERT ON `users` FOR EACH ROW BEGIN
    UPDATE register
    SET registration_status = 'verified'
    WHERE document_number = NEW.document_number;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users_details`
--

CREATE TABLE `users_details` (
  `document_number` bigint(20) UNSIGNED NOT NULL,
  `country` varchar(50) NOT NULL,
  `state` varchar(50) DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL,
  `address` varchar(150) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `date_update` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `users_details`
--

INSERT INTO `users_details` (`document_number`, `country`, `state`, `city`, `address`, `phone`, `date_update`) VALUES
(12345678, 'Colombia', 'Cundinamarca', 'Soacha', 'Carrera 10 #15-20', '+573008901234', '2024-12-04 22:10:56'),
(21345678, 'USA', 'New York', 'New York', '789 Broadway', '+12125550345', '2024-12-04 22:10:56'),
(21698160, 'Colombia', 'Bogotá D.C.', 'Bogotá', 'Av. Caracas #30-40', '+573005678901', '2024-12-04 22:10:56'),
(30028670, 'Colombia', 'Santander', 'Bucaramanga', 'Calle 25 #15-50', '+573002345678', '2024-12-04 22:10:56'),
(93117052, 'USA', 'Florida', 'Miami', '123 Ocean Dr', '+13055550123', '2024-12-04 22:10:56'),
(102034678, 'Colombia', 'Atlántico', 'Barranquilla', 'Carrera 5 #10-15', '+573007890123', '2024-12-04 22:10:56'),
(1034567827, 'Colombia', 'Antioquia', 'Medellín', 'Calle 10 #20-50', '+573006789012', '2024-12-04 22:10:56'),
(1039476451, 'Colombia', 'Valle del Cauca', 'Cali', 'Calle 15 #20-30', '+573004567890', '2024-12-04 22:10:56'),
(1039476766, 'Colombia', 'Antioquia', 'Medellín', 'Cra 50 #10-20', '+573001234567', '2024-12-04 22:10:56'),
(1039675432, 'USA', 'California', 'Los Angeles', '456 Sunset Blvd', '+13215550234', '2024-12-04 22:10:56');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user_activity`
--

CREATE TABLE `user_activity` (
  `id_activity` bigint(20) UNSIGNED NOT NULL,
  `document_number` bigint(20) UNSIGNED NOT NULL,
  `activity_timestamp` datetime NOT NULL DEFAULT current_timestamp(),
  `action_type` varchar(100) NOT NULL,
  `action_description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `user_activity`
--

INSERT INTO `user_activity` (`id_activity`, `document_number`, `activity_timestamp`, `action_type`, `action_description`) VALUES
(1, 1039476766, '2024-12-04 22:10:56', 'login', 'Inicio de sesión exitoso desde Chrome en Windows'),
(2, 1039476451, '2024-12-04 22:10:56', 'purchase', 'Compra realizada en el sistema'),
(3, 21698160, '2024-12-04 22:10:56', 'login', 'Intento de inicio de sesión fallido desde Android'),
(4, 30028670, '2024-12-04 22:10:56', 'update_profile', 'Actualización de dirección en el perfil'),
(5, 1034567827, '2024-12-04 22:10:56', 'login', 'Inicio de sesión exitoso desde Edge en Windows'),
(6, 102034678, '2024-12-04 22:10:56', 'password_reset', 'Solicitud de restablecimiento de contraseña'),
(7, 93117052, '2024-12-04 22:10:56', 'login', 'Inicio de sesión exitoso desde Safari en iOS'),
(8, 1039675432, '2024-12-04 22:10:56', 'login', 'Intento de inicio de sesión fallido desde Chrome en Linux'),
(9, 21345678, '2024-12-04 22:10:56', 'login', 'Intento de inicio de sesión fallido desde Chrome en Windows'),
(10, 12345678, '2024-12-04 22:10:56', 'purchase', 'Compra realizada con éxito en el sistema');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cancellations_order`
--
ALTER TABLE `cancellations_order`
  ADD PRIMARY KEY (`id_cancellations_order`),
  ADD UNIQUE KEY `id_cancellations_order` (`id_cancellations_order`),
  ADD UNIQUE KEY `id_orders` (`id_orders`);

--
-- Indices de la tabla `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id_category`),
  ADD KEY `reference_name` (`category_name`);

--
-- Indices de la tabla `config`
--
ALTER TABLE `config`
  ADD PRIMARY KEY (`id_config`),
  ADD UNIQUE KEY `config_key` (`config_key`),
  ADD KEY `document_number` (`document_number`),
  ADD KEY `reference_idx_date_add` (`date_add`),
  ADD KEY `reference_idx_date_upd` (`date_upd`);

--
-- Indices de la tabla `languages`
--
ALTER TABLE `languages`
  ADD PRIMARY KEY (`id_language`),
  ADD UNIQUE KEY `id_language` (`id_language`),
  ADD UNIQUE KEY `language_code` (`language_code`);

--
-- Indices de la tabla `login_history`
--
ALTER TABLE `login_history`
  ADD PRIMARY KEY (`id_login`),
  ADD UNIQUE KEY `id_login` (`id_login`),
  ADD KEY `document_number` (`document_number`);

--
-- Indices de la tabla `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id_orders`),
  ADD UNIQUE KEY `id_orders` (`id_orders`),
  ADD KEY `document_number` (`document_number`),
  ADD KEY `reference_date` (`order_date`),
  ADD KEY `reference_status` (`status`),
  ADD KEY `reference_discount_order` (`discount`);

--
-- Indices de la tabla `password_history`
--
ALTER TABLE `password_history`
  ADD PRIMARY KEY (`id_history`),
  ADD KEY `document_number` (`document_number`),
  ADD KEY `reference_change_date_idx` (`change_date`);

--
-- Indices de la tabla `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_code`),
  ADD UNIQUE KEY `product_code` (`product_code`),
  ADD UNIQUE KEY `product_name` (`product_name`),
  ADD KEY `id_category` (`id_category`),
  ADD KEY `reference_name_product` (`product_name`),
  ADD KEY `reference_price_product` (`price`);

--
-- Indices de la tabla `product_order`
--
ALTER TABLE `product_order`
  ADD PRIMARY KEY (`id_product_order`),
  ADD UNIQUE KEY `id_product_order` (`id_product_order`),
  ADD KEY `id_orders` (`id_orders`),
  ADD KEY `product_code` (`product_code`);

--
-- Indices de la tabla `register`
--
ALTER TABLE `register`
  ADD PRIMARY KEY (`document_number`),
  ADD UNIQUE KEY `document_number` (`document_number`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indices de la tabla `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`sales_code`),
  ADD UNIQUE KEY `sales_code` (`sales_code`),
  ADD UNIQUE KEY `id_orders` (`id_orders`),
  ADD KEY `document_number` (`document_number`),
  ADD KEY `reference_date_sales` (`sale_date`),
  ADD KEY `reference_discount_sales` (`discount`),
  ADD KEY `reference_date_delivery` (`delivery_date`),
  ADD KEY `reference_city` (`delivery_city`),
  ADD KEY `reference_state` (`delivery_state`),
  ADD KEY `reference_country` (`delivery_country`);

--
-- Indices de la tabla `shopping_cart`
--
ALTER TABLE `shopping_cart`
  ADD PRIMARY KEY (`cart_id`),
  ADD KEY `document_number` (`document_number`),
  ADD KEY `product_code` (`product_code`),
  ADD KEY `reference_date_added_idx` (`date_added`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`document_number`),
  ADD UNIQUE KEY `document_number` (`document_number`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `id_language` (`id_language`),
  ADD KEY `reference_active_users` (`active`),
  ADD KEY `reference_name_users` (`name`),
  ADD KEY `reference_lastname_users` (`lastname`),
  ADD KEY `reference_date_add_users` (`date_add`);

--
-- Indices de la tabla `users_details`
--
ALTER TABLE `users_details`
  ADD PRIMARY KEY (`document_number`),
  ADD UNIQUE KEY `document_number` (`document_number`);

--
-- Indices de la tabla `user_activity`
--
ALTER TABLE `user_activity`
  ADD PRIMARY KEY (`id_activity`),
  ADD KEY `document_number` (`document_number`),
  ADD KEY `reference_activity_timestamp` (`activity_timestamp`),
  ADD KEY `reference_type_action` (`action_type`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `category`
--
ALTER TABLE `category`
  MODIFY `id_category` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `config`
--
ALTER TABLE `config`
  MODIFY `id_config` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `languages`
--
ALTER TABLE `languages`
  MODIFY `id_language` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `login_history`
--
ALTER TABLE `login_history`
  MODIFY `id_login` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `orders`
--
ALTER TABLE `orders`
  MODIFY `id_orders` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `password_history`
--
ALTER TABLE `password_history`
  MODIFY `id_history` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `product_order`
--
ALTER TABLE `product_order`
  MODIFY `id_product_order` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `sales`
--
ALTER TABLE `sales`
  MODIFY `sales_code` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `shopping_cart`
--
ALTER TABLE `shopping_cart`
  MODIFY `cart_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `user_activity`
--
ALTER TABLE `user_activity`
  MODIFY `id_activity` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `cancellations_order`
--
ALTER TABLE `cancellations_order`
  ADD CONSTRAINT `cancellations_order_ibfk_1` FOREIGN KEY (`id_orders`) REFERENCES `orders` (`id_orders`);

--
-- Filtros para la tabla `config`
--
ALTER TABLE `config`
  ADD CONSTRAINT `config_ibfk_1` FOREIGN KEY (`document_number`) REFERENCES `users` (`document_number`);

--
-- Filtros para la tabla `login_history`
--
ALTER TABLE `login_history`
  ADD CONSTRAINT `login_history_ibfk_1` FOREIGN KEY (`document_number`) REFERENCES `users` (`document_number`);

--
-- Filtros para la tabla `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`document_number`) REFERENCES `users` (`document_number`);

--
-- Filtros para la tabla `password_history`
--
ALTER TABLE `password_history`
  ADD CONSTRAINT `password_history_ibfk_1` FOREIGN KEY (`document_number`) REFERENCES `users` (`document_number`);

--
-- Filtros para la tabla `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`id_category`) REFERENCES `category` (`id_category`);

--
-- Filtros para la tabla `product_order`
--
ALTER TABLE `product_order`
  ADD CONSTRAINT `product_order_ibfk_1` FOREIGN KEY (`id_orders`) REFERENCES `orders` (`id_orders`),
  ADD CONSTRAINT `product_order_ibfk_2` FOREIGN KEY (`product_code`) REFERENCES `products` (`product_code`);

--
-- Filtros para la tabla `sales`
--
ALTER TABLE `sales`
  ADD CONSTRAINT `sales_ibfk_1` FOREIGN KEY (`id_orders`) REFERENCES `orders` (`id_orders`),
  ADD CONSTRAINT `sales_ibfk_2` FOREIGN KEY (`document_number`) REFERENCES `users` (`document_number`);

--
-- Filtros para la tabla `shopping_cart`
--
ALTER TABLE `shopping_cart`
  ADD CONSTRAINT `shopping_cart_ibfk_1` FOREIGN KEY (`document_number`) REFERENCES `users` (`document_number`),
  ADD CONSTRAINT `shopping_cart_ibfk_2` FOREIGN KEY (`product_code`) REFERENCES `products` (`product_code`);

--
-- Filtros para la tabla `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`document_number`) REFERENCES `register` (`document_number`),
  ADD CONSTRAINT `users_ibfk_2` FOREIGN KEY (`id_language`) REFERENCES `languages` (`id_language`);

--
-- Filtros para la tabla `users_details`
--
ALTER TABLE `users_details`
  ADD CONSTRAINT `users_details_ibfk_1` FOREIGN KEY (`document_number`) REFERENCES `users` (`document_number`);

--
-- Filtros para la tabla `user_activity`
--
ALTER TABLE `user_activity`
  ADD CONSTRAINT `user_activity_ibfk_1` FOREIGN KEY (`document_number`) REFERENCES `users` (`document_number`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
