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
    </head>
    <body>
    <div class="container text-center">
        <div class="row">
            <div class="col-12" style="margin-bottom: 100px">
                <!--Navbar de la pagina web-->
                <?php
                    $mostrarElementoJurado = true;
                    $mostrarElementoSelect = false;
                    $mostrarElementoVertical = true;
                    $mostrarMenuVertical = true;
                    include('../templates/navbar.php')
                ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 order-md-2" style="margin-bottom: 100px; position: sticky; top: 50px">
                <!--Form de la pagina web-->
                <?php include('../includes/grafica_as.php')?>
            </div>
            <div class="col-md-6 order-md-1">
                <div class="row">
                    <div class="col-12" id="puntajes">
                        <?php include('../consultas/resultados_as.php') ?>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>