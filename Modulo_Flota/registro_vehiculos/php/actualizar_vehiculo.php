<?php
include("../../conexion.php");
session_start();

try {
    $patente = $_POST['patente'];
    $marca = $_POST['marca'];
    $modelo = $_POST['modelo'];
    $año = $_POST['año'];
    $km_actual = $_POST['km_actual'];
    $revision_tecnica = $_POST['fecha_revision_tecnica'];
    $encargado = $_POST['rut'];

    // Validaciones del lado del servidor
    if (!is_numeric($año) || strlen($año) != 4 || $año < 1990 || $año > 3000) {
        throw new Exception("El año debe ser un número de 4 dígitos entre 1990 y 3000.");
    }

    if (!is_numeric($km_actual) || $km_actual < 0) {
        throw new Exception("El kilometraje debe ser un número positivo.");
    }

    if (empty($encargado)) {
        $encargado = NULL;
    }

    // Obtener el kilometraje actual desde la base de datos
    $sql_select = "SELECT km_actual FROM vehiculo WHERE patente = ?";
    $stmnt_select = mysqli_prepare($conexion, $sql_select);
    mysqli_stmt_bind_param($stmnt_select, "s", $patente);
    mysqli_stmt_execute($stmnt_select);
    mysqli_stmt_bind_result($stmnt_select, $km_actual_bd);
    mysqli_stmt_fetch($stmnt_select);
    mysqli_stmt_close($stmnt_select);

    // Verificar si el kilometraje ingresado es menor al almacenado
    if ($km_actual < $km_actual_bd) {
        throw new Exception("El kilometraje ingresado no puede ser menor al kilometraje actual registrado ($km_actual_bd km).");
    }

    // Consulta SQL para actualizar los datos del vehículo
    $sql_actualizar = "
        UPDATE vehiculo 
        SET marca = ?, 
            modelo = ?, 
            año = ?, 
            km_actual = ?, 
            fecha_revision_tecnica = ?, 
            rut = ?
        WHERE patente = ?";

    $stmnt_actualizar = mysqli_prepare($conexion, $sql_actualizar);
    mysqli_stmt_bind_param($stmnt_actualizar, "ssiisss", $marca, $modelo, $año, $km_actual, $revision_tecnica, $encargado, $patente);
    mysqli_stmt_execute($stmnt_actualizar);

    if (mysqli_stmt_affected_rows($stmnt_actualizar) > 0) {
        $icono = "success";
        $mensaje = "Actualización exitosa.";
    } else {
        throw new Exception("No se realizaron cambios en los datos.");
    }

    mysqli_stmt_close($stmnt_actualizar);
} catch (Exception $e) {
    $icono = "error";
    $mensaje = "Hubo un error al actualizar: " . $e->getMessage();
}

// Redirigir de nuevo a la página principal con el estado y el mensaje
header("Location: ../vehiculos.php?status=$icono&mensaje=$mensaje");
exit();
?>
