<?php
include('../includes/bd.php');
if (isset($_POST['ciudadElegida']) && isset($_POST['cargo'])){
    $ciudad = $_POST["ciudadElegida"];
    $cargo = $_POST["cargo"];
    
    $stmt = $conexion->query("SELECT partidos.id_par, nom_par FROM ciudades, puestos,
    mesas, formularios, candidatos, partidos WHERE ciudades.id_ciu = puestos.id_ciu AND
    puestos.id_pue = mesas.id_pue AND mesas.id_mes = formularios.id_mes AND
    formularios.id_can = candidatos.id_can AND candidatos.id_par = partidos.id_par AND
    ciudades.id_ciu = '$ciudad' AND car_for= '$cargo' GROUP BY partidos.id_par");
    $partidos = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $stmt = $conexion->query("SELECT sum(vot_can_for) AS vot_tot FROM ciudades, puestos,
    mesas, formularios WHERE ciudades.id_ciu = puestos.id_ciu AND
    puestos.id_pue = mesas.id_pue AND mesas.id_mes = formularios.id_mes AND
    ciudades.id_ciu = '$ciudad' AND car_for= '$cargo'");
    $vot_tot = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach($partidos as $partido):
        echo '<div class="card mb-3" style="max-width: 540px;">
        <div class="card-header text-bg-dark" style="margin-bottom:1em">'.$partido["nom_par"].'</div>
        <div class="row g-1" >';
        $id = $partido['id_par'];
        $stmt = $conexion->query("SELECT formularios.id_can, num_can, nom_can FROM ciudades, puestos,
        mesas, formularios, candidatos, partidos WHERE ciudades.id_ciu = puestos.id_ciu AND
        puestos.id_pue = mesas.id_pue AND mesas.id_mes = formularios.id_mes AND
        formularios.id_can = candidatos.id_can AND candidatos.id_par = partidos.id_par AND
        puestos.id_ciu = '$ciudad' AND car_for= '$cargo' AND partidos.id_par = '$id' GROUP BY
        formularios.id_can ORDER BY CAST(num_can AS UNSIGNED)");
        $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($resultados as $resultado) :
            $candidato = $resultado["id_can"];
            $stmt = $conexion->query("SELECT sum(vot_can_for) AS vot_can FROM ciudades, puestos,
            mesas, formularios, candidatos WHERE ciudades.id_ciu = puestos.id_ciu AND
            puestos.id_pue = mesas.id_pue AND mesas.id_mes = formularios.id_mes AND
            formularios.id_can = candidatos.id_can AND ciudades.id_ciu = '$ciudad' AND
            car_for= '$cargo' AND formularios.id_can='$candidato'");
            $votos = $stmt->fetchAll(PDO::FETCH_ASSOC);

            echo '<div class="col-md-9 align-self-center" style="width: 75%; float: left; border-right: 2px solid #ccc; padding-right: 20px">
                    <div class="card-body">
                        <h2 class="card-text">('.$resultado["num_can"].') '.$resultado["nom_can"].'</h2>
                    </div>
                </div>';
            foreach($vot_tot as $vot_t):
                foreach($votos as $voto):
                    if ($vot_t["vot_tot"]>0){
                        $porcentaje = number_format(($voto["vot_can"]/$vot_t["vot_tot"])*100, 2);
                    }else{
                        $porcentaje = 0;
                    }
                    echo '<div class="col-md-3 align-middle">
                            <div class="card-body">
                                <h1>'.$porcentaje.'%</h1>
                                <h2>'.$voto["vot_can"].'</h2>
                            </div>
                        </div>';
                endforeach;
            endforeach;
        endforeach;
        echo '</div></div>';
    endforeach;
}
?>