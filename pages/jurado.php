<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Document</title>
        <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
    </head>
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <body>
    <div class="container text-center">
        <div class="row">
            <div class="col-12" style="margin-bottom: 100px">
                <!--Navbar de la pagina web-->
                <?php
                    $mostrarElementoJurado = false;
                    $mostrarElementoSelect = false;
                    $mostrarElementoVolver = true;
                    $mostrarElementoVertical = false;
                    include('../templates/navbar.php')
                ?>
            </div>
        </div>
        <?php  
            include ('../includes/bd.php');
            include ('../consultas/ciudades.php');
            include ('../consultas/pue_mes.php');
            include ('../consultas/candidatos.php');
            include('../consultas/u_candidatos.php');
        ?>
        <div class="row justify-content-center">
            <div class="col-auto">
                <select class="form-select" aria-label="Default select example" id="ciudadSelect" name="ciudadSelect">
                    <option value="0">Ciudad</option>
                    <?php foreach ($ciudades as $ciudad) : 
                        $idCiudad = $ciudad["id_ciu"] ?>
                    <option value=<?php echo $idCiudad ?>><?= $ciudad["nom_ciu"] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-auto">
                <select class="form-select" aria-label="Default select example" id="puestoSelect" name="puestoSelect">
                    <option value="0">Puesto</option>
                </select>
            </div>
            <div class="col-auto">
                <select class="form-select" aria-label="Default select example" id="mesaSelect" name="mesaSelect">
                <option value="0">Mesa</option>
                </select>
            </div>
            <div class="col-auto">
                <select class="form-select" aria-label="Default select example" id="cargoSelect" name="cargoSelect">
                    <option value="0">Cargo</option>
                    <option value="Gobernacion">Gorbernacion</option>
                    <option value="Alcaldia">Alcaldia</option>
                    <option value="Asamblea">Asamblea</option>
                    <option value="Concejo">Concejo</option>
                </select>
            </div>
        </div>
        <div class="row justify-content-center" style="margin-top: 2em;">
            <div class="col-11">
                <form id="candidatos" action="../consultas/u_candidatos.php" method="post" >
                </form>
            </div>
        </div>
    </div>
    <script>
            $(document).ready(function(){
                // Agrega un listener al evento change del select
                $("#ciudadSelect").change(function () {
                    // Obtiene el valor seleccionado
                    var ciudadSeleccionada = $("#ciudadSelect").val();
                    // Envia el valor al servidor usando AJAX
                    $.ajax({
                        url: "../consultas/pue_mes.php",
                        method: "POST",
                        data: { ciudadSeleccionada: ciudadSeleccionada },
                        success: function (data) {
                            // Muestra la respuesta del servidor
                            $("#puestoSelect").html(data);
                        }
                    });
                });
            });

            $(document).ready(function(){
                // Agrega un listener al evento change del select
                $("#puestoSelect").change(function () {
                    // Obtiene el valor seleccionado
                    var puestoSeleccionado = $("#puestoSelect").val();
                    // Envia el valor al servidor usando AJAX
                    $.ajax({
                        url: "../consultas/pue_mes.php",
                        method: "POST",
                        data: { puestoSeleccionado: puestoSeleccionado },
                        success: function (data) {
                            // Muestra la respuesta del servidor
                            $("#mesaSelect").html(data);
                        }
                    });
                });
            });

            $(document).ready(function(){
                // Agrega un listener al evento change del select
                $("#mesaSelect, #cargoSelect").change(function () {
                    // Obtiene el valor seleccionado
                    var mesaSeleccionada = $("#mesaSelect").val();
                    var cargoSeleccionado = $('#cargoSelect').val();
                    // Envia el valor al servidor usando AJAX
                    $.ajax({
                        url: "../consultas/candidatos.php",
                        method: "POST",
                        data: { mesaSeleccionada: mesaSeleccionada, cargoSeleccionado: cargoSeleccionado },
                        success: function (data) {
                            // Muestra la respuesta del servidor
                            $("#candidatos").html(data);
                        }
                    });
                });
            });
        </script>
    </body>
</html>