<?php include('../includes/bd.php');
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    foreach ($_POST as $key => $value) {
        // Verificamos si el campo tiene el prefijo "input_"
        if (strpos($key, "for") === 0) {
            // Obtenemos la parte de la ID después del prefijo
            if(is_numeric($value)){
                // Escapamos los datos para evitar inyección SQL (importante)
                $inputValue = $conexion->quote($value);
            
                // Actualizamos el registro en la base de datos
                $consulta = "UPDATE formularios SET vot_can_for = $inputValue WHERE id_for = '$key' ";
                $conexion->exec($consulta);
            }
        }
    }
    header("Location: http://proyecto_final.test/pages/jurado.php");
    exit();
}
?>