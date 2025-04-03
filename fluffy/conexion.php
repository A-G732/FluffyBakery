<?php
$servidor = "localhost";
$usuario = "root";
$password = "";
$basededatos = "fluffy_pasteleria";

// Crear conexión
$conexion = new mysqli($servidor, $usuario, $password, $basededatos);

// Verificar conexión
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}
?>
