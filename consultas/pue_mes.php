<?php
include('../includes/bd.php');
if (isset($_POST['ciudadSeleccionada'])){
    $ciudadSeleccionada = $_POST["ciudadSeleccionada"];
    
    $stmt = $conexion->query("SELECT id_pue, nom_pue FROM puestos, ciudades WHERE
    puestos.id_ciu = ciudades.id_ciu AND puestos.id_ciu = '$ciudadSeleccionada'");
    $puestos = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
    echo '<option value="0">Puesto</option>';
    foreach ($puestos as $puesto) : 
        $idPuesto = $puesto["id_pue"];
        echo '<option value='. $idPuesto .'>'. $puesto["nom_pue"] .'</option>';
    endforeach;
}

if (isset($_POST['puestoSeleccionado'])){
    $puestoSeleccionado = $_POST["puestoSeleccionado"];
    
    $stmt = $conexion->query("SELECT id_mes, num_mes FROM puestos, mesas WHERE
    puestos.id_pue = mesas.id_pue AND mesas.id_pue = '$puestoSeleccionado' 
    ORDER BY num_mes");
    $mesas = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo '<option value="0">Mesa</option>';
    foreach ($mesas as $mesa) : 
        $idMesa = $mesa["id_mes"];
        echo '<option value='. $idMesa .'>'. $mesa["num_mes"] .'</option>';
    endforeach;
}
?>
