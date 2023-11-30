<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Document</title>
        <link href="/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <script src="/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
    </head>
    <body>
    <div class="container text-center">
        <div class="row">
            <div class="col-12" style="margin-bottom: 100px">
                <!--Navbar de la pagina web-->
                <?php
                    $mostrarElementoJurado = true;
                    $mostrarElementoSelect = true;
                    $mostrarElementoVertical = true;
                    $mostrarMenuVertical = true;
                    include('../templates/navbar.php')
                ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 order-md-2" style="margin-bottom: 100px; position: sticky; top: 50px">
                <canvas id="miGrafico" style="position: sticky; top: 100px" height="295"></canvas>
            </div>
            <div class="col-md-6 order-md-1">
                <div class="row">
                    <div class="col-12" id="puntajesC">
                        <div class="card">
                            <h1>Escoge una ciudad</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script>
            $(document).ready(function(){
                // Agrega un listener al evento change del select
                $("#filtroCiudad").change(function () {
                    // Obtiene el valor seleccionado
                    var ciudadElegida = $("#filtroCiudad").val();
                    var cargo = 'Concejo';
                    // Envia el valor al servidor usando AJAX
                    $.ajax({
                        url: "../consultas/resultados_c.php",
                        method: "POST",
                        data: { ciudadElegida: ciudadElegida, cargo: cargo},
                        success: function (data) {
                            // Muestra la respuesta del servidor
                            $("#puntajesC").html(data);
                        }
                    });
                    $.ajax({
                        url: "../includes/grafica_c.php",
                        method: "POST",
                        data: { ciudadElegida: ciudadElegida, cargo: cargo},
                        success: function (data) {
                            // Muestra la respuesta del servidor
                            var candidatosC = JSON.parse(data)
                            mostrarGrafica(candidatosC);
                        }
                    });
                });
            });
            function mostrarGrafica(candidatosC){
                const ctx = document.getElementById('miGrafico').getContext('2d');
                const miGrafico = new Chart(ctx, {
                    type: "doughnut",
                    data: {
                        labels: candidatosC.map(item => item.nom_par),
                        datasets: [{
                        backgroundColor: candidatosC.map((item, index) => getRandomColor(index)),
                        data: candidatosC.map(item => item.vot_can)
                        }]
                    },
                    options: {
                        title: {
                        display: true,
                        text: "Resultados Elecciones 2023",
                        }
                    }
                    });
                    function getRandomColor(index) {
                    // Puedes personalizar la generación de colores según tu preferencia
                    const hue = (index * 137.508) % 360;
                    return `hsl(${hue}, 70%, 60%)`;
                };
            }
        </script>
    </body>
</html>