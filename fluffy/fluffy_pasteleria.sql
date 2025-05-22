-- PROYECTO: Fluffy Pastelería
-- DESCRIPCIÓN: Es un cliente real que tiene una pasteleria y solicitó un inventario para llevar el control de las ventas e información de sus clientes.
-- INTEGRANTES: Luna Velez Arango, Ana Sofia Ucros Rios, Ana Elvia Gonzalez Guerra, Camila Yorgelis Rodriguez Granados
drop database if exists fluffy_pasteleria;
create database if not exists fluffy_pasteleria;
use fluffy_pasteleria;
-- TABLAS --
-- Idiomas
CREATE TABLE IF NOT EXISTS languages (
    id_language TINYINT UNSIGNED NOT NULL UNIQUE AUTO_INCREMENT,
    language_code CHAR(5) NOT NULL UNIQUE,
    language_name VARCHAR(50) NOT NULL,
    status ENUM('active', 'inactive') DEFAULT 'active',
    date_add DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    date_updated DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id_language)
);
-- Registro de usuarios
CREATE TABLE IF NOT EXISTS register (
    document_number BIGINT UNSIGNED NOT NULL UNIQUE,
    document_type VARCHAR(30) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    date_add DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    registration_status ENUM('pending', 'verified', 'rejected') DEFAULT 'pending',
    PRIMARY KEY (document_number)
);
-- Usuarios
CREATE TABLE IF NOT EXISTS users (
    document_number BIGINT UNSIGNED NOT NULL UNIQUE,
    id_language TINYINT UNSIGNED NOT NULL,
    active TINYINT UNSIGNED NOT NULL,
    name VARCHAR(50) NOT NULL,
    lastname VARCHAR(50) NOT NULL,
    document_type VARCHAR(30) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    rol ENUM('admin','cliente') NOT NULL DEFAULT 'cliente',
    date_add DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    date_upd DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (document_number),
    FOREIGN KEY (document_number) REFERENCES register (document_number),
    FOREIGN KEY (id_language) REFERENCES languages (id_language),
    INDEX reference_active_users (active),
    INDEX reference_name_users (name),
    INDEX reference_lastname_users (lastname),
    INDEX reference_date_add_users (date_add)
);
-- Detalles de usuario
CREATE TABLE IF NOT EXISTS users_details (
    document_number BIGINT UNSIGNED NOT NULL UNIQUE,
    country VARCHAR(50) NOT NULL,
    state VARCHAR(50) NULL,
    city VARCHAR(50) NULL,
    address VARCHAR(150) NULL,
    phone VARCHAR(20) NULL,
    date_update DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (document_number),
    FOREIGN KEY (document_number) REFERENCES users (document_number)
);
-- Historial de login
CREATE TABLE IF NOT EXISTS login_history (
    id_login BIGINT UNSIGNED NOT NULL UNIQUE AUTO_INCREMENT,
    document_number BIGINT UNSIGNED NOT NULL, 
    login_timestamp DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    logout_timestamp DATETIME NULL, 
    device_info VARCHAR(255) NULL,
    browser_info VARCHAR(255) NULL,
    success ENUM('success', 'failure') NOT NULL,
    PRIMARY KEY (id_login),
    FOREIGN KEY (document_number) REFERENCES users (document_number)
);
-- Actividad del usuario
CREATE TABLE IF NOT EXISTS user_activity (
    id_activity BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    document_number BIGINT UNSIGNED NOT NULL,
    activity_timestamp DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    action_type VARCHAR(100) NOT NULL,
    action_description TEXT NULL,
    PRIMARY KEY (id_activity),
    FOREIGN KEY (document_number) REFERENCES users (document_number),
    INDEX reference_activity_timestamp (activity_timestamp),
    INDEX reference_type_action (action_type)
);
-- Historial de contraseñas
CREATE TABLE IF NOT EXISTS password_history (
    id_history BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    document_number BIGINT UNSIGNED NOT NULL,
    old_password VARCHAR(255) NOT NULL,
    password_reset_reason ENUM('forgotten','user_request','security_update'),
    change_date DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id_history),
    FOREIGN KEY (document_number) REFERENCES users (document_number),
    INDEX reference_change_date_idx (change_date)
);
-- Categorías
CREATE TABLE IF NOT EXISTS category (
    id_category TINYINT UNSIGNED NOT NULL AUTO_INCREMENT,
    category_name VARCHAR(50) NOT NULL,
    PRIMARY KEY (id_category),
    INDEX reference_name (category_name)
);
-- Productos
CREATE TABLE IF NOT EXISTS products (
    product_code BIGINT UNSIGNED NOT NULL UNIQUE,
    id_category TINYINT UNSIGNED NOT NULL,
    product_name VARCHAR(255) NOT NULL UNIQUE,
    description TEXT NOT NULL,
    ingredients TEXT NULL,
    price DECIMAL(10, 0) NOT NULL,
    discount DECIMAL(5, 2) DEFAULT 0.00,
    available_unity TINYINT UNSIGNED NULL,
    minimum_stock INT UNSIGNED DEFAULT 10,
    maximum_stock INT UNSIGNED DEFAULT 50,
    status ENUM('available', 'out_of_stock', 'discontinued') DEFAULT 'available',
    date_add DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    date_upd DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    display_order INT UNSIGNED DEFAULT 1,
    PRIMARY KEY (product_code),
    FOREIGN KEY (id_category) REFERENCES category (id_category),
    INDEX reference_name_product (product_name),
    INDEX reference_price_product (price),
    INDEX reference_status_product (status)
);
-- Pedidos
CREATE TABLE IF NOT EXISTS orders (
    id_orders BIGINT UNSIGNED NOT NULL UNIQUE AUTO_INCREMENT,
    document_number BIGINT UNSIGNED NOT NULL,
    order_date DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    status ENUM('pending','confirmed','delivered','cancelled') DEFAULT 'pending' NOT NULL,
    payment_status ENUM('paid','unpaid','pending') DEFAULT 'pending',
    payment_method ENUM('bank_transfer', 'cash') NOT NULL,
    total_price DECIMAL(10, 0) NOT NULL,
    discount DECIMAL(5, 2) DEFAULT 0.00,
    date_upd DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP, 
    PRIMARY KEY (id_orders),
    FOREIGN KEY (document_number) REFERENCES users (document_number),
    INDEX reference_date (order_date),
    INDEX reference_status (status),
    INDEX reference_discount_order (discount)
);
-- Productos pedidos (intermedia)
CREATE TABLE IF NOT EXISTS product_order (
    id_product_order BIGINT UNSIGNED NOT NULL UNIQUE AUTO_INCREMENT,
    id_orders BIGINT UNSIGNED NOT NULL,
    product_code BIGINT UNSIGNED NOT NULL,
    quantity INT UNSIGNED NOT NULL DEFAULT 1,
    unit_price DECIMAL(10, 0) NOT NULL,
    discount DECIMAL(5, 2) DEFAULT 0.00,
    total_price DECIMAL(10, 0) NOT NULL,
    PRIMARY KEY (id_product_order),
    FOREIGN KEY (id_orders) REFERENCES orders (id_orders),
    FOREIGN KEY (product_code) REFERENCES products (product_code)
);
-- Ventas
CREATE TABLE IF NOT EXISTS sales (
    sales_code BIGINT UNSIGNED NOT NULL UNIQUE AUTO_INCREMENT,
    id_orders BIGINT UNSIGNED NOT NULL UNIQUE,
    sale_date DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    delivery_date DATETIME DEFAULT CURRENT_TIMESTAMP,
    delivery_address VARCHAR(150),
    delivery_city VARCHAR(50),
    delivery_state VARCHAR(50),
    delivery_country VARCHAR(50),
    date_upd DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (sales_code),
    FOREIGN KEY (id_orders) REFERENCES orders (id_orders),
    INDEX reference_date_sales (sale_date),
    INDEX reference_date_delivery (delivery_date),
    INDEX reference_city (delivery_city),
    INDEX reference_state (delivery_state),
    INDEX reference_country (delivery_country)    
);
-- Carrito de compras
CREATE TABLE IF NOT EXISTS shopping_cart (
    cart_id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    document_number BIGINT UNSIGNED NOT NULL,
    product_code BIGINT UNSIGNED NOT NULL,
    quantity INT UNSIGNED NOT NULL DEFAULT 1,
    date_added DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (cart_id),
    FOREIGN KEY (document_number) REFERENCES users (document_number),
    FOREIGN KEY (product_code) REFERENCES products (product_code),
    INDEX reference_date_added_idx (date_added)
);
-- Configuración
CREATE TABLE IF NOT EXISTS config (
    id_config BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    document_number BIGINT UNSIGNED,
    scope VARCHAR(50) NOT NULL,
    category ENUM('theme', 'notification', 'other') NOT NULL DEFAULT 'other',
    config_key VARCHAR(100) NOT NULL,
    config_value TEXT NOT NULL,
    data_type ENUM('string', 'integer', 'boolean', 'float', 'json', 'xml', 'array') NOT NULL DEFAULT 'string',
    is_active TINYINT UNSIGNED DEFAULT 1,
    date_add DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    date_upd DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (id_config),
    FOREIGN KEY (document_number) REFERENCES users (document_number),
    UNIQUE KEY scope_key_unique (scope, config_key, document_number),
    INDEX reference_category (category),
    INDEX reference_scope (scope),
    INDEX reference_idx_date_add (date_add),
    INDEX reference_idx_date_upd (date_upd)
);
-- Inserción de registros en las tablas de la base de datos 
INSERT INTO languages (language_code, language_name, status) VALUES 
('es-CO', 'Español (Colombia)', 'active'),
('en-US', 'English (United States)', 'active'),
('es-ES', 'Español (España)', 'active'),
('fr-FR', 'Français (France)', 'inactive'),
('it-IT', 'Italiano (Italia)', 'inactive'),
('de-DE', 'Deutsch (Deutschland)', 'inactive'),
('pt-BR', 'Português (Brasil)', 'inactive'),
('zh-CN', '中文 (简体)', 'inactive'),
('ja-JP', '日本語 (日本)', 'inactive'),
('ru-RU', 'Русский (Россия)', 'inactive');
INSERT INTO register (document_number, document_type, email, password, registration_status) VALUES 
(1039476766,'cc','a.g.g0109180@gmail.com','Aa12345*','verified'),
(1039476451,'cc','paolaandreagonzalezg231@gmail.com','Pp12345*','vrified'),
(21698160,'cc','martha.nelsi.guerra@gmail.com','Mm12345*','rejected'),
(30028670,'cc','patriciapuerta1030@gmail.com','Oo12345*','verified'),
(1034567827,'cc','lunava0505@gmail.com','Ll12345*','pending'),
(102034678,'t.i','carlos.lopez@gmail.com','Cc12345*','pending'),
(93117052,'cc','emily.jones@gmail.com','Ee12345*','verified'),
(1039675432,'cc','michael.brown@gmail.com','Bb12345*','pending'),
(21345678,'cc','sarah.davis@gmail.com','Ss12345*','rejected'),
(12345678,'cc','luis.lopez@gmail.com','Zz12345*','verified');
INSERT INTO users (document_number, id_language, active, name, lastname, document_type, email, rol) VALUES
(1039476766, 1, 1, 'Ana', 'Gonzalez', 'cc', 'a.g.g0109180@gmail.com', 'admin'), 
(1039476451, 1, 1, 'Paola', 'Gonzalez', 'cc', 'paolaandreagonzalezg231@gmail.com', 'cliente'), 
(21698160, 1, 0, 'Martha', 'Guerra', 'cc', 'martha.nelsi.guerra@gmail.com', 'cliente'), 
(30028670, 1, 1, 'Patricia', 'Puerta', 'cc', 'patriciapuerta1030@gmail.com', 'cliente'), 
(1034567827, 1, 1, 'Luna', 'Navarro', 'cc', 'lunava0505@gmail.com', 'cliente'), 
(102034678, 1, 1, 'Carlos', 'Lopez', 't.i', 'carlos.lopez@gmail.com', 'cliente'), 
(93117052, 2, 1, 'Emily', 'Jones', 'cc', 'emily.jones@gmail.com', 'cliente'), 
(1039675432, 2, 1, 'Michael', 'Brown', 'cc', 'michael.brown@gmail.com', 'cliente'), 
(21345678, 2, 0, 'Sarah', 'Davis', 'cc', 'sarah.davis@gmail.com', 'cliente'), 
(12345678, 1, 1, 'Luis', 'Lopez', 'cc', 'luis.lopez@gmail.com', 'cliente'); 
INSERT INTO users_details (document_number, country, state, city, address, phone) VALUES
(1039476766, 'Colombia', 'Antioquia', 'Medellín', 'Cra 50 #10-20', '+573001234567'),
(1039476451, 'Colombia', 'Valle del Cauca', 'Cali', 'Calle 15 #20-30', '+573004567890'),
(21698160, 'Colombia', 'Bogotá D.C.', 'Bogotá', 'Av. Caracas #30-40', '+573005678901'),
(30028670, 'Colombia', 'Santander', 'Bucaramanga', 'Calle 25 #15-50', '+573002345678'),
(1034567827, 'Colombia', 'Antioquia', 'Medellín', 'Calle 10 #20-50', '+573006789012'),
(102034678, 'Colombia', 'Atlántico', 'Barranquilla', 'Carrera 5 #10-15', '+573007890123'),
(93117052, 'USA', 'Florida', 'Miami', '123 Ocean Dr', '+13055550123'),
(1039675432, 'USA', 'California', 'Los Angeles', '456 Sunset Blvd', '+13215550234'),
(21345678, 'USA', 'New York', 'New York', '789 Broadway', '+12125550345'),
(12345678, 'Colombia', 'Cundinamarca', 'Soacha', 'Carrera 10 #15-20', '+573008901234');
INSERT INTO login_history (document_number, login_timestamp, logout_timestamp, device_info, browser_info, success) VALUES
(1039476766, '2024-11-20 08:30:00', '2024-11-20 09:00:00', 'Windows 10', 'Chrome 95', 'success'),
(1039476451, '2024-11-19 10:15:00', '2024-11-19 10:45:00', 'iOS', 'Safari 15', 'success'),
(21698160, '2024-11-18 11:00:00', NULL, 'Android', 'Chrome 95', 'failure'),
(30028670, '2024-11-18 14:30:00', '2024-11-18 15:00:00', 'MacOS', 'Firefox 93', 'success'),
(1034567827, '2024-11-17 16:00:00', '2024-11-17 16:30:00', 'Windows 10', 'Edge 94', 'success'),
(102034678, '2024-11-16 18:00:00', '2024-11-16 18:30:00', 'Android', 'Chrome 95', 'failure'),
(93117052, '2024-11-15 20:00:00', '2024-11-15 20:45:00', 'iOS', 'Safari 15', 'success'),
(1039675432, '2024-11-15 21:00:00', NULL, 'Linux', 'Chrome 95', 'failure'),
(21345678, '2024-11-14 22:00:00', NULL, 'Windows 7', 'Chrome 92', 'failure'),
(12345678, '2024-11-13 23:00:00', '2024-11-13 23:30:00', 'Windows 10', 'Edge 94', 'success');
INSERT INTO user_activity (document_number, action_type, action_description) VALUES
(1039476766, 'login', 'Inicio de sesión exitoso desde Chrome en Windows'),
(1039476451, 'purchase', 'Compra realizada en el sistema'),
(21698160, 'login', 'Intento de inicio de sesión fallido desde Android'),
(30028670, 'update_profile', 'Actualización de dirección en el perfil'),
(1034567827, 'login', 'Inicio de sesión exitoso desde Edge en Windows'),
(102034678, 'password_reset', 'Solicitud de restablecimiento de contraseña'),
(93117052, 'login', 'Inicio de sesión exitoso desde Safari en iOS'),
(1039675432, 'login', 'Intento de inicio de sesión fallido desde Chrome en Linux'),
(21345678, 'login', 'Intento de inicio de sesión fallido desde Chrome en Windows'),
(12345678, 'purchase', 'Compra realizada con éxito en el sistema');
INSERT INTO password_history (document_number, old_password, password_reset_reason, change_date) VALUES
(1039476451, 'Aa12345*', 'user_request', '2024-11-10 10:00:00'),
(1039476766, 'Pp12345*', 'security_update', '2024-11-15 14:00:00'),
(30028670, 'Oo12345*', 'forgotten', '2024-11-18 12:30:00'),
(93117052, 'Ee12345*', 'user_request', '2024-11-20 09:00:00'),
(1034567827, 'Ll12345*', 'security_update', '2024-11-22 10:30:00'),
(12345678, 'Zz12345*', 'forgotten', '2024-11-23 14:00:00');
INSERT INTO category (category_name) VALUES
('Cookies'),
('Cakes'),
('Brownies'),
('Brookies'),
('Alfajores'),
('Cupcakes'),
('Caseritas'),
('Cheescake');
INSERT INTO products (product_code, id_category, product_name, price, available_unity) VALUES
(101, 1, 'Cookie SMORE', 8500, 20),
(102, 1, 'Cookie CHOCOCRUJI', 8500, 20),
(103, 1, 'Cookie CHOCO CLÁSICA', 8500, 20),
(104, 1, 'Cookie NUTELLA', 8500, 20),
(105, 1, 'Cookie PIE DE LIMÓN', 8500, 20),
(106, 1, 'Cookie PIE DE MANZANA', 8500, 20),
(107, 1, 'Cookie RED VELVET', 8500, 20),
(108, 1, 'Cookie CUMPLEAÑOS', 8500, 20),
(109, 1, 'Cookie CHURRO CON AREQUIPE', 8500, 20),
(110, 1, 'Cookie PISTACHO', 8500, 20),
(111, 1, 'Cookie CHOCO BLANCO CON NUECES', 8500, 20),
(112, 1, 'Cookie OREO RELLENA DE CHEESECAKE', 8500, 20),
(113, 1, 'Caja x4 Cookies', 28000, 20),
(114, 1, 'Caja x6 Cookies', 42000, 20);
INSERT INTO orders (document_number, order_date, status, payment_status, payment_method, total_price, discount) VALUES
(1039476451, '2024-11-20 10:30:00', 'confirmed', 'paid', 'cash', 17000, 0.00),
(1039476766, '2024-11-20 12:15:00', 'confirmed', 'paid', 'cash', 25200, 0.10), 
(30028670, '2024-11-21 14:00:00', 'delivered', 'paid', 'bank_transfer', 39900, 0.10), 
(1039675432, '2024-11-22 16:45:00', 'pending', 'unpaid', 'cash', 24225, 0.10),
(93117052, '2024-11-23 18:30:00', 'confirmed', 'paid', 'bank_transfer', 84000, 0.00), 
(1034567827, '2024-11-24 11:20:00', 'confirmed', 'paid', 'cash', 28000, 0), 
(12345678, '2024-11-24 15:30:00', 'confirmed', 'paid', 'bank_transfer', 42500, 0), 
(21345678, '2024-11-25 09:50:00', 'cancelled', 'unpaid', 'bank_transfer', 37800, 0.10), 
(102034678, '2024-11-25 13:40:00', 'confirmed', 'paid', 'cash', 26600, 0.10), 
(21698160, '2024-11-26 17:10:00', 'pending', 'unpaid', 'bank_transfer', 80750, 0.10); 
INSERT INTO product_order (id_orders, product_code, quantity, unit_price, discount, total_price) VALUES
(1, 101, 1, 8500, 0, 8500),  
(2, 113, 1, 28000, 0.10, 28000),  
(3, 114, 2, 42000, 0.10, 84000),  
(4, 110, 1, 8500, 0.10, 8500),  
(5, 108, 1, 8500, 0, 8500),  
(6, 102, 3, 8500, 0, 25500), 
(7, 103, 1, 8500, 0, 8500),  
(8, 114, 1, 42000, 0.10, 42000), 
(9, 107, 4, 8500, 0.10, 34000), 
(10, 104, 2, 8500, 0.10, 17000); 
INSERT INTO sales (id_orders, sale_date, delivery_date, delivery_address, delivery_city, delivery_state, delivery_country) VALUES
(1, '2024-11-20 10:30:00', '2024-11-21 14:00:00', 'Calle 10 #34-56', 'Bogotá', 'Cundinamarca', 'Colombia'),
(2, '2024-11-20 12:30:00', '2024-11-22 10:00:00', 'Carrera 45 #23-90', 'Medellín', 'Antioquia', 'Colombia'),
(3, '2024-11-21 14:30:00', '2024-11-23 16:00:00', 'Carrera 12 #34-78', 'Cali', 'Valle del Cauca', 'Colombia'),
(5, '2024-11-23 18:00:00', '2024-11-25 14:30:00', 'Avenida 6 #78-90', 'Cartagena', 'Bolívar', 'Colombia'),
(6, '2024-11-24 12:00:00', '2024-11-26 12:00:00', 'Calle 34 #56-12', 'Barranquilla', 'Atlántico', 'Colombia'),
(7, '2024-11-24 16:00:00', '2024-11-26 18:00:00', 'Carrera 78 #45-23', 'Bucaramanga', 'Santander', 'Colombia');
INSERT INTO shopping_cart (document_number, product_code, quantity, date_added) VALUES
(1039476451, 101, 1, '2024-11-19 15:30:00'),
(1039476766, 102, 2, '2024-11-20 09:00:00'),
(30028670, 103, 1, '2024-11-21 13:00:00'),
(93117052, 102, 1, '2024-11-23 11:00:00'),
(1034567827, 103, 3, '2024-11-24 10:30:00'),
(12345678, 101, 2, '2024-11-24 14:00:00');
-- Configuración de cada usuario
INSERT INTO config (document_number, scope, category, config_key, config_value, data_type, is_active) VALUES
(1039476451, 'user', 'theme', 'current_theme', 'dark', 'string', 1),
(1039476766, 'user', 'theme', 'current_theme', 'light', 'string', 1),
(30028670, 'user', 'notification', 'notifications_enable', 'false', 'boolean', 1),
(93117052, 'user', 'notification', 'notifications_enable', 'true', 'boolean', 1),
(1034567827, 'user', 'notification', 'notification_destination_email', 'luis.lopez@gmail.com', 'string', 1),
(12345678, 'user', 'notification', 'preferences', '{"enabled": true, "app": true, "email": "usuario123@email.com"}', 'json', 1);
-- Configuración general
INSERT INTO config (scope, category, config_key, config_value, data_type, is_active) VALUES
('general', 'theme', 'default_theme', 'light', 'string', 1),
('general', 'notification', 'default_channel_new_user', 'email', 'string', 1);
-- TRIGGERS
DELIMITER //
-- 1. verificación del registro
CREATE TRIGGER verify_registration AFTER INSERT ON users FOR EACH ROW
BEGIN
    UPDATE register
    SET registration_status = 'verified'
    WHERE document_number = NEW.document_number;
END //
-- 2. historial de login
CREATE TRIGGER login_history AFTER INSERT ON users FOR EACH ROW 
BEGIN 
    INSERT INTO login_history (document_number, login_timestamp, success)
   	VALUES (NEW.document_number, NOW(), 'success'); 
END //
-- 3. registro actividad del usuario
CREATE TRIGGER user_activity AFTER INSERT ON orders 
FOR EACH ROW 
BEGIN 
    INSERT INTO user_activity (document_number, activity_timestamp, action_type, action_description)
   	VALUES (NEW.document_number, NOW(), 'Order Created', CONCAT('Order ID: ', NEW.id_orders)); 
END //
-- 4. precio total del pedido
CREATE TRIGGER total_price_order BEFORE INSERT ON product_order FOR EACH ROW
BEGIN
    SET NEW.total_price = NEW.unit_price * NEW.quantity - (NEW.unit_price * NEW.quantity * (NEW.discount / 100));
END //
-- 5. actualización de la cantidad de productos disponibles
CREATE TRIGGER update_product_inventory AFTER INSERT ON product_order FOR EACH ROW
BEGIN
    UPDATE products
    SET available_unity = available_unity - NEW.quantity
    WHERE product_code = NEW.product_code;
END //
-- 6. actualización del estado del pedido
CREATE TRIGGER update_order_status AFTER INSERT ON sales FOR EACH ROW 
BEGIN 
    UPDATE orders SET status = 'delivered' 
   	WHERE id_orders = NEW.id_orders; 
END //
-- 7. pedidos cancelados
CREATE TRIGGER order_cancellation AFTER UPDATE ON orders FOR EACH ROW 
BEGIN 
    IF OLD.status != 'cancelled' AND NEW.status = 'cancelled' THEN 
        INSERT INTO cancellations_order (id_orders, cancellation_date) VALUES (NEW.id_orders, NOW()); 
    END IF;  
END //
-- 8. verificar cambio de contraseña y añadirla al historial
CREATE TRIGGER verify_change_password BEFORE UPDATE ON register FOR EACH ROW
BEGIN
    IF OLD.password != NEW.password THEN
        INSERT INTO password_history (document_number, old_password, password_reset_reason, change_date)
        VALUES (OLD.document_number, OLD.password, 'forgotten', NOW());
    END IF;
END //
-- 9. verificación del stock minimo
CREATE TRIGGER check_minimum_stock AFTER UPDATE ON products FOR EACH ROW 
BEGIN 
    IF NEW.available_unity < NEW.minimum_stock THEN 
        INSERT INTO stock_alerts (product_code, alert_date) 
       	VALUES (NEW.product_code, NOW()); 
    END IF; 
END //
-- 10. Registro de cambios en datos del usuario
CREATE TRIGGER log_user_update AFTER UPDATE ON users FOR EACH ROW 
BEGIN 
	INSERT INTO users_activity (document_number, activity_timestamp, action_type, action_description)
	VALUES (NEW.document_number, NOW(), 'User Update',
	CONCAT('Update fields: ',
	IF(OLD.name != NEW.name, 'name, ', ''),
	IF(OLD.lastname != NEW.lastname, 'lastname, ', ''),
	IF(OLD.email != NEW.email, 'email, ','')));
END //
-- 11. Eliminación en el carrito de compras 
CREATE TRIGGER update_products_on_cart_delete AFTER DELETE ON shopping_cart FOR EACH ROW 
BEGIN
	UPDATE products
	SET available_unity = available_unity + OLD.quantity
	WHERE product_code = OLD.product_code;
END //
-- 12. Verificación de inactividad de usuarios
CREATE TRIGGER log_user_inactivity AFTER UPDATE ON users FOR EACH ROW
BEGIN 
	IF OLD.active = 1 AND NEW.active = 0 THEN 
		INSERT INTO user_activity (document_number, activity_timestamp, action_type, action_description)
		VALUES (NEW.document_number, NOW(), 'user inactivity', 'user marked as inactive');
	END IF;
END //
-- VISTAS
-- 1. información de usuario sin la contraseña
CREATE VIEW user_details_view AS
SELECT 
  u.document_number,
  name,
  lastname,
  document_type,
  email,
  rol,
  country,
  state,
  city,
  address,
  phone
FROM users u
INNER JOIN users_details d ON u.document_number = d.document_number;
-- 2. Pedidos realizados por un usuario
CREATE VIEW user_orders_view AS
SELECT 
  id_orders,
  order_date,
  status,
  payment_status,
  total_price,
  discount,
  u.document_number
FROM orders o
INNER JOIN users u ON o.document_number = u.document_number;
-- 3. Productos de un usuario en el carrito de compras
CREATE VIEW cart_users_view AS
SELECT 
  cart_id,
  product_name,
  price,
  quantity,
  (price * quantity) AS total_producto
FROM shopping_cart s
INNER JOIN products p ON s.product_code = p.product_code;
-- 4. Productos que estan disponibles para la venta
CREATE VIEW available_products_view AS
SELECT * FROM products
WHERE status = 'available';
-- 5. Total de ventas por mes
CREATE VIEW sales_month_view AS
SELECT 
  MONTH(sale_date) AS mes,
  YEAR(sale_date) AS año,
  SUM(total_price) AS total_ventas
FROM sales s
JOIN orders o ON s.id_orders = o.id_orders
GROUP BY año, mes
ORDER BY año, mes;
-- 6. Detalles de un pedido
CREATE VIEW order_details_view AS
SELECT 
  o.id_orders,
  order_date,
  o.status,
  payment_status,
  o.total_price,
  o.discount,
  p.product_code,
  product_name,
  quantity,
  unit_price,
  p.discount AS product_discount
FROM orders o
INNER JOIN product_order po ON o.id_orders = po.id_orders
INNER JOIN products p ON po.product_code = p.product_code;
-- 7. Agrupación de los productos por categoría
CREATE VIEW products_by_category_view AS
SELECT 
  product_code,
  product_name,
  price,
  category_name
FROM products p
INNER JOIN category c ON p.id_category = c.id_category;
-- 8. Registra las actividades realizadas por los usuarios
CREATE VIEW user_activity_view AS
SELECT 
  u.document_number,
  name,
  lastname,
  activity_timestamp,
  action_type,
  action_description
FROM user_activity a
INNER JOIN users u ON a.document_number = u.document_number;
-- 9. productos por rango de precios
CREATE VIEW products_by_price_range AS
SELECT 
	product_code, 
	product_name, 
	price, 
	available_unity
FROM products
WHERE price BETWEEN 1000 AND 100000;
-- 10. pedidos pendientes
CREATE VIEW pending_orders AS
SELECT 
	id_orders, 
	u.document_number, 
	order_date, 
	total_price, 
	name, 
	lastname
FROM orders o
INNER JOIN users u ON o.document_number = u.document_number
WHERE status = 'pending';
-- 11. productos agotados
CREATE VIEW out_of_stock_products AS
SELECT 
	product_code, 
	product_name, 
	description
FROM products
WHERE status = 'out_of_stock';
-- 12. info de ventas por usuario
CREATE VIEW sales_summary_by_user AS
SELECT 
    u.document_number,
    name,
    lastname,
    COUNT(sales_code) AS total_transactions,
    SUM(total_price) AS total_sales
FROM sales s
INNER JOIN orders o ON s.id_orders = o.id_orders
INNER JOIN users u ON s.document_number = u.document_number
GROUP BY document_number, name, lastname
ORDER BY total_sales DESC;
-- PROCEDIMIENTOS ALMACENADOS (no se importó a phpmyadmin desde aqui)
-- 1. registrar un nuevo usuario
DELIMITER //
CREATE PROCEDURE register_user(
    IN p_document_number BIGINT UNSIGNED,
    IN p_document_type VARCHAR(30),
    IN p_email VARCHAR(100),
    IN p_password VARCHAR(255),
    IN p_name VARCHAR(50),
    IN p_lastname VARCHAR(50)
) BEGIN
    INSERT INTO register (document_number, document_type, email, password)
    VALUES (p_document_number, p_document_type, p_email, p_password);
    INSERT INTO users (document_number, name, lastname, document_type, email)
    VALUES (p_document_number, p_name, p_lastname, p_document_type, p_email);
END //
-- 2. actualizar la información de un usuario
DELIMITER //
CREATE PROCEDURE update_users_details(
    IN p_document_number BIGINT UNSIGNED,
    IN p_name VARCHAR(50),
    IN p_lastname VARCHAR(50),
    IN p_email VARCHAR(100),
    IN p_country VARCHAR(50),
    IN p_state VARCHAR(50),
    IN p_city VARCHAR(50),
    IN p_address VARCHAR(150),
    IN p_phone VARCHAR(20)
) BEGIN
    UPDATE users_details d
    INNER JOIN users u ON d.document_number = u.document_number
    SET u.name = p_name, u.lastname = p_lastname, u.email = p_email, d.country = p_country, d.state = p_state, d.city = p_city, d.address = p_address, d.phone = p_phone
    WHERE d.document_number = p_document_number;
END //
-- 3. agregar un producto
DELIMITER //
CREATE PROCEDURE add_product(
    IN p_id_category TINYINT UNSIGNED,
    IN p_product_name VARCHAR(255),
    IN p_description TEXT,
    IN p_price DECIMAL(10, 2),
    IN p_unity_price DECIMAL(6, 2),
    IN p_available_unity TINYINT UNSIGNED
) BEGIN
    INSERT INTO products (id_category, product_name, description, price, unity_price, available_unity)
    VALUES (p_id_category, p_product_name, p_description, p_price, p_unity_price, p_available_unity);
END //
-- 4. eliminar un producto
DELIMITER //
CREATE PROCEDURE delete_product(
	IN p_product_code BIGINT unsigned
) BEGIN
    DELETE FROM products WHERE product_code = p_product_code;
END //
-- 5. actualizar información de los productos
DELIMITER //
CREATE PROCEDURE update_info_product(
    IN p_product_code BIGINT UNSIGNED,
    IN p_price DECIMAL(10, 2),
    IN p_discount DECIMAL(5, 2),
    IN p_status ENUM('available', 'out_of_stock', 'discontinued')
) BEGIN
    UPDATE products 
    SET price = p_price, discount = p_discount, status = p_status 
    WHERE product_code = p_product_code;
END //
-- 6. crear un pedido
DELIMITER //
CREATE PROCEDURE create_order(
    IN p_document_number BIGINT UNSIGNED,
    OUT order_id BIGINT UNSIGNED
) BEGIN
    INSERT INTO orders (document_number) VALUES (p_document_number);
    SET order_id = LAST_INSERT_ID();
END //
-- 7. añadir productos al pedido
DELIMITER //
CREATE PROCEDURE add_product_to_order(
    IN order_id BIGINT UNSIGNED,
    IN product_code BIGINT UNSIGNED,
    IN quantity INT UNSIGNED
) BEGIN
    DECLARE unit_price DECIMAL(10, 2);
    SELECT price INTO unit_price FROM products WHERE product_code = product_code;
    INSERT INTO product_order (id_orders, product_code, quantity, unit_price) 
    VALUES (order_id, product_code, quantity, unit_price);
END //
-- 8. actualizar el estado de un pedido
DELIMITER //
CREATE PROCEDURE update_order_status(
    IN p_id_orders BIGINT UNSIGNED,
    IN p_status ENUM('pending', 'confirmed', 'delivered', 'cancelled')
) BEGIN
    UPDATE orders
    SET status = p_status
    WHERE id_orders = p_id_orders;
END //
-- 9. registro de ventas
DELIMITER //
CREATE PROCEDURE register_sale(
    IN p_id_orders BIGINT UNSIGNED,
    IN p_document_number BIGINT UNSIGNED,
    IN p_total_price DECIMAL(10),
	IN p_discount DECIMAL (5,2),
    IN p_payment_method ENUM('bank_transfer', 'cash'),
    IN p_delivery_address VARCHAR(150),
    IN p_delivery_city VARCHAR(50),
    IN p_delivery_state VARCHAR(50),
    IN p_delivery_country VARCHAR(50)
) BEGIN
    INSERT INTO sales (id_orders, document_number, total_price, discount, payment_method, delivery_address, delivery_city, delivery_state, delivery_country)
    VALUES (p_id_orders, p_document_number, p_total_price, p_discount, p_payment_method, p_delivery_address, p_delivery_city, p_delivery_state, p_delivery_country);
END //
-- 10. actualizar el stock de los productos
DELIMITER //
CREATE PROCEDURE update_product_stock(
    IN p_product_code BIGINT UNSIGNED,
    IN p_new_stock TINYINT UNSIGNED
) BEGIN
    UPDATE products
    SET available_unity = p_new_stock
    WHERE product_code = p_product_code;
END //
-- 11. Registrar actividad de usuario
DELIMITER //
CREATE PROCEDURE log_user_activity(
    IN p_document_number BIGINT UNSIGNED,
    IN p_action_type VARCHAR(100),
    IN p_action_description TEXT
) BEGIN
    INSERT INTO user_activity (document_number, action_type, action_description)
    VALUES (p_document_number, p_action_type, p_action_description);
END //
-- 12. eliminar usuario
DELIMITER //
CREATE PROCEDURE delete_user(
	IN p_document_number BIGINT unsigned
) BEGIN
    DELETE FROM users WHERE document_number = p_document_number;
    DELETE FROM register WHERE document_number = p_document_number;
END //
-- CONSULTAS
-- 1. info de un usuario
SELECT * FROM user_details_view
WHERE document_number = 1234567890;
-- 2. pedidos por un usuario
SELECT * FROM user_orders_view 
WHERE document_number = 1234567890;
-- 3. detalles de un pedido
select * from order_details_view
where id_orders = 1;
-- 4. pedidos pendientes en general
SELECT * FROM orders 
WHERE status = 'pending';
-- 5. productos por categoria
SELECT * FROM products_by_category_view 
where category_name = 'Tortas';
-- 6. productos disponibles
SELECT product_name FROM products 
WHERE status = 'available';
-- 7. productos agotados
SELECT product_name FROM products 
WHERE status = 'out_of_stock';
-- 8. productos mas vendidos
SELECT p.product_name AS producto, SUM(po.quantity) AS cantidad_vendida, SUM(po.quantity * po.unit_price) AS precio_total
FROM product_order po
INNER JOIN products p ON po.product_code = p.product_code
GROUP BY p.product_name
ORDER by cantidad_vendida DESC;
-- 9. usuarios que mas compran
SELECT u.document_number, CONCAT(u.name, ' ', u.lastname) AS nombre, COUNT(s.sales_code) AS cantidad_compras, 
SUM(o.total_price) AS precio_total FROM sales s
INNER JOIN orders o ON s.id_orders = o.id_orders
INNER JOIN users u ON o.document_number = u.document_number
GROUP BY u.document_number, nombre
ORDER BY precio_total DESC;
-- 10. actividades realizadas por un usuario 
SELECT * FROM user_activity_view 
WHERE document_number=1234567890;
-- 11. usuarios inactivos
SELECT document_number, CONCAT(name, ' ', lastname) AS nombre, email, date_add AS fecha_registro,
date_upd AS fecha_ultima_actualizacion FROM users
WHERE active = 0
ORDER BY date_upd ASC;
-- 12. pedidos de hoy
SELECT id_orders, document_number, order_date, total_price FROM orders
WHERE DATE(order_date) = CURDATE();
-- 13. pedidos en un rango de fechas
SELECT id_orders, document_number, order_date, total_price FROM orders
WHERE order_date BETWEEN '2024-11-01' AND '2024-11-30';
-- 14. información de usuarios activosVOYACA
SELECT * FROM user_details_view
WHERE document_number IN (SELECT document_number FROM users WHERE active = 1);
-- 15. configuraciones activas por los usuarios
SELECT document_number, category, config_key, config_value FROM config
WHERE is_active = 1;
-- 16. Usuarios que han intentado iniciar sesión y han fallado
SELECT document_number, name, lastname FROM user_activity_view
WHERE action_type = 'login' AND action_description LIKE '%fallido%';
-- 17. Consulta Productos disponibles en un rango de precios específico
SELECT * FROM available_products_view
WHERE price BETWEEN 8000 AND 25000;
