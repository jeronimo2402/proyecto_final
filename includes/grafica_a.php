<?php include('../includes/bd.php');

if (isset($_POST['ciudadElegida']) && isset($_POST['cargo'])){
    $ciudad = $_POST["ciudadElegida"];
    $cargo = $_POST["cargo"];
    $query = "SELECT nom_can, sum(vot_can_for) AS vot_can FROM puestos, mesas, formularios,
    candidatos WHERE formularios.id_can = candidatos.id_can AND
    formularios.id_mes = mesas.id_mes AND mesas.id_pue = puestos.id_pue AND id_ciu = '$ciudad'
    AND car_for='$cargo' GROUP BY nom_can ORDER BY vot_can";
    $stmt = $conexion->query($query);
    $data1 = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($data1);
}
?> 
