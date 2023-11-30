<?php include('../includes/bd.php');

if (isset($_POST['mesaSeleccionada']) && isset($_POST['cargoSeleccionado'])){
    $mesaSeleccionada = $_POST["mesaSeleccionada"];
    $cargoSeleccionado = $_POST["cargoSeleccionado"];
    
    $stmt = $conexion->query("SELECT id_for, num_can, nom_can, nom_par FROM candidatos, 
    formularios, partidos WHERE partidos.id_par = candidatos.id_par AND
    candidatos.id_can = formularios.id_can AND formularios.id_mes = '$mesaSeleccionada'
    AND car_for = '$cargoSeleccionado' ORDER BY CAST(num_can AS UNSIGNED)");
    $candidatos = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $stmt = $conexion->query("SELECT nom_par FROM candidatos, 
    formularios, partidos WHERE partidos.id_par = candidatos.id_par AND
    candidatos.id_can = formularios.id_can AND formularios.id_mes = '$mesaSeleccionada'
    AND car_for = '$cargoSeleccionado' GROUP BY nom_par");
    $partidos = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if ($cargoSeleccionado=='Alcaldia' || $cargoSeleccionado == 'Gobernacion'):
        foreach ($candidatos as $candidato) : 
            echo '<div class="card text-bg-light mb-3">
            <div class="row justify-content-between">
                <div class="col-md-1 text-center align-self-center" style="margin-left:1em"> 
                    <span class="input-text text-center"><h3>'. $candidato["num_can"] .'</h3></span>
                </div>
                <div class="col-md-2 align-self-center">
                    <h5>'.$candidato["nom_par"].'</h5> 
                </div>
                <div class="col-md-4 align-self-center"><h3>'. $candidato["nom_can"].'</h3></div> 
                <div class="col-md-4 align-self-center" style="margin-right:1em">
                    <input class="form-control" placeholder="Votos" type="number" id="'.$candidato["id_for"].'" name="'.$candidato["id_for"].'"></input></div> 
                </div>
            </div>';
        endforeach;
        echo '<button type="submit" class="btn btn-primary">Guardar</button>';
    elseif($cargoSeleccionado=='Asamblea' || $cargoSeleccionado == 'Concejo'):
        foreach ($partidos as $partido):
            echo '<div class="card text-bg-light mb-3">
            <div class="card-header text-bg-dark" style="margin-bottom:1em">
                <h3>'.$partido["nom_par"].'</h3>
            </div>
            <div class="row justify-content-between">';
            foreach ($candidatos as $candidato) :
                if ($candidato["nom_par"]==$partido["nom_par"]):
                    echo '<div class="col-md-1 text-center align-self-center" style="margin-left:1em"> 
                            <span class="input-text text-center"><h3>'. $candidato["num_can"] .'</h3></span>
                        </div>
                        <div class="col-md-6 align-self-center"><h3>'. $candidato["nom_can"].'</h3></div> 
                        <div class="col-md-4 align-self-center" style="margin-right:1em">
                            <input class="form-control" placeholder="Votos" type="number" id="'.$candidato["id_for"].'" name="'.$candidato["id_for"].'"></input>
                        </div>';
                        
                endif;
            endforeach;
            echo '</div></div>';
        endforeach;
        echo '<button href="http://proyecto_final.test/pages/jurado.php" type="submit" class="btn btn-primary">Guardar</button>';
    endif;
}



?>