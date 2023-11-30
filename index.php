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
                    include('templates/navbar.php')
                ?>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-12" style="margin:4em">
                <h1>¿Que votos quieres conocer?</h1>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-12" style="margin-bottom: 2em;">
                <img class="img-fluid" src="/assets/logo_elecciones_2023.png" height="300" width="200">
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <a class="btn btn-primary" href="../pages/gobernador.php"><h1>Gobernacion</h1></a>
            </div>
            <div class="col-md-3">
                <a class="btn btn-primary" href="../pages/asamblea.php"><h1>Asambleas</h1></a>
            </div>
            <div class="col-md-3">
                <a class="btn btn-primary" href="../pages/alcalde.php"><h1>Alcaldias</h1></a>
            </div>
            <div class="col-md-3">
                <a class="btn btn-primary" href="../pages/concejo.php"><h1>Concejos</h1></a>
            </div>
        </div>
    </body>
</html>

