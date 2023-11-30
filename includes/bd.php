<?php
$servidor = "127.0.0.1";
$usuario = "root";
$contrasena = "";
$basedatos = "elecciones";

try {
    $conexion = new PDO("mysql:host=$servidor;dbname=$basedatos", $usuario, $contrasena);
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Error de conexión: " . $e->getMessage();
}
?>
    