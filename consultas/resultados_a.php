<?php
include('../includes/bd.php');
if (isset($_POST['ciudadElegida']) && isset($_POST['cargo'])){
    $ciudad = $_POST["ciudadElegida"];
    $cargo = $_POST["cargo"];
    
    $stmt = $conexion->query("SELECT sum(vot_can_for) AS vot_tot FROM ciudades, puestos,
    mesas, formularios WHERE ciudades.id_ciu = puestos.id_ciu AND
    puestos.id_pue = mesas.id_pue AND mesas.id_mes = formularios.id_mes AND
    ciudades.id_ciu = '$ciudad' AND car_for= '$cargo'");
    $vot_tot = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt = $conexion->query("SELECT formularios.id_can, num_can, nom_can, nom_par FROM ciudades, puestos,
    mesas, formularios, candidatos, partidos WHERE ciudades.id_ciu = puestos.id_ciu AND
    puestos.id_pue = mesas.id_pue AND mesas.id_mes = formularios.id_mes AND
    formularios.id_can = candidatos.id_can AND candidatos.id_par = partidos.id_par AND
    ciudades.id_ciu = '$ciudad' AND car_for= '$cargo' GROUP BY formularios.id_can ORDER BY CAST(num_can AS UNSIGNED)");
    $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($resultados as $resultado) :
        $candidato = $resultado["id_can"];
        $stmt = $conexion->query("SELECT sum(vot_can_for) AS vot_can FROM ciudades, puestos,
        mesas, formularios, candidatos WHERE ciudades.id_ciu = puestos.id_ciu AND
        puestos.id_pue = mesas.id_pue AND mesas.id_mes = formularios.id_mes AND
        formularios.id_can = candidatos.id_can AND ciudades.id_ciu = '$ciudad' AND
        car_for= '$cargo' AND formularios.id_can='$candidato'");
        $votos = $stmt->fetchAll(PDO::FETCH_ASSOC);

        echo '<div class="card mb-3" style="max-width: 540px;">
        <div class="row g-1" >
        <div class="col-md-9 align-self-center" style="width: 75%; float: left; border-right: 2px solid #ccc; padding-right: 20px">
                <div class="card-body">
                    <h2 class="card-text">('.$resultado["num_can"].') '.$resultado["nom_can"].'</h2>
                    <p class="card-text">Partido: '.$resultado["nom_par"].'</p>
                </div>
            </div>';
        foreach($vot_tot as $vot_t):
            foreach($votos as $voto):
                if ($vot_t["vot_tot"]>0){
                    $porcentaje = number_format(($voto["vot_can"]/$vot_t["vot_tot"])*100,2);
                }else{
                    $porcentaje = 0;
                }
                echo '<div class="col-md-3 align-middle">
                        <div class="card-body">
                            <h2>'.$porcentaje.'%</h2>
                            <h2>'.$voto["vot_can"].'</h2>
                        </div>
                    </div></div></div>';
            endforeach;
        endforeach;
    endforeach;
}
?>