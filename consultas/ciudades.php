<?php
$stmt = $conexion->query("SELECT id_ciu, nom_ciu FROM ciudades");
$ciudades = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>