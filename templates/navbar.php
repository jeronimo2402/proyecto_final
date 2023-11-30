<nav class="navbar navbar-dark bg-dark fixed-top">
    <div class="container-fluid">
        <?php if(isset($mostrarElementoVertical) && $mostrarElementoVertical): ?>
        <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <?php endif; ?>
        <!--Mostrar Los select para resultados-->
        <?php 
        if(isset($mostrarElementoSelect) && $mostrarElementoSelect): 
        include ('../includes/bd.php');
        include ('../consultas/ciudades.php')
        ?>
        <div class="col-auto">
            <select class="form-select" aria-label="Default select example" id="filtroCiudad" name="filtroCiudad">
                <option value="0">Seleccione</option>
                <?php foreach ($ciudades as $ciudad) : ?>
                    <option value=<?php echo $ciudad["id_ciu"]?>><?= $ciudad["nom_ciu"] ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        
        <?php endif; ?>
            <!--Mostrar el boton 'JURADOS'-->
        <?php if(isset($mostrarElementoJurado) && $mostrarElementoJurado): ?>
            <a href="../pages/jurado.php"><button class="btn btn-primary text-center"><h4>Soy Jurado</h4></button></a>
        <?php endif; ?>
            <!--Mostrar el boton 'volver' -->
        <?php if(isset($mostrarElementoVolver) && $mostrarElementoVolver): ?>
            <a href="../index.php"><button class="btn btn-primary text-center"><h4>Volver</h4></button></a>
        <?php endif; ?>

        <!-- Menu Vetical -->
        <?php if(isset($mostrarMenuVertical) && $mostrarMenuVertical): ?>
            <div class="offcanvas offcanvas-start text-bg-dark text-start" tabindex="-1" id="offcanvasDarkNavbar" aria-labelledby="offcanvasDarkNavbarLabel">
                <div class="offcanvas-header">
                    <h3 class="offcanvas-title" id="offcanvasDarkNavbarLabel">Cargos Públicos</h3>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                        <li class="nav-item">
                            <a class="nav-link" href="../index.php">Inicio</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../pages/alcalde.php">Alcaldia</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../pages/gobernador.php">Gobernacion</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../pages/concejo.php">Concejo</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../pages/asamblea.php">Asamblea</a>
                        </li>
                    </ul>
                </div>
            </div>
        <?php endif; ?>
    </div>
</nav>


