<?php
include("../../conexion.php");
session_start();

try {
    $patente = $_POST['patente']; 

    $sql_eliminar = "UPDATE vehiculo SET activo = 'no', rut = NULL WHERE patente = ?";

    $stmt_eliminar = mysqli_prepare($conexion, $sql_eliminar);
    mysqli_stmt_bind_param($stmt_eliminar, "s", $patente);
    mysqli_stmt_execute($stmt_eliminar);

    if (mysqli_stmt_affected_rows($stmt_eliminar) > 0) {
        $icono = "success";
        $mensaje = "Vehículo eliminado correctamente.";
    } else {
        throw new Exception("No se encontró el vehículo o no se pudo actualizar.");
    }

} catch (Exception $e) {
    $icono = "error";
    $mensaje = "Error al eliminar: " . $e->getMessage();
}

// Redirigir de nuevo a la página principal con el estado y el mensaje
header("Location: ../vehiculos.php?status=$icono&mensaje=$mensaje");
exit();
?>
