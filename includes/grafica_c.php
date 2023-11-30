<?php include('../includes/bd.php');

if (isset($_POST['ciudadElegida']) && isset($_POST['cargo'])){
    $ciudad = $_POST["ciudadElegida"];
    $cargo = $_POST["cargo"];
    $query = "SELECT nom_par, sum(vot_can_for) AS vot_can FROM puestos, mesas, formularios,
    candidatos, partidos WHERE formularios.id_can = candidatos.id_can AND
    formularios.id_mes = mesas.id_mes AND mesas.id_pue = puestos.id_pue AND 
    candidatos.id_par = partidos.id_par AND id_ciu = '$ciudad' AND car_for='$cargo' 
    GROUP BY nom_par ORDER BY vot_can";
    $stmt = $conexion->query($query);
    $data1 = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($data1);
}
?> 