<?php
include("../../conexion.php");
session_start();

try {
    // Obtener los datos del formulario
    $patente = $_POST['patente']; 
    $marca = $_POST['marca']; 
    $modelo = $_POST['modelo']; 
    $año = $_POST['año']; 
    $km_actual = $_POST['km_actual']; 
    $revision_tecnica = $_POST['fecha_revision_tecnica']; 
    $encargado = $_POST['rut']; 
    $activo = $_POST['activo'];

    // Validaciones del lado del servidor
    if (!is_numeric($año) || strlen($año) != 4 || $año < 1990 || $año > 3000) {
        throw new Exception("El año debe ser un número de 4 dígitos entre 1990 y 3000.");
    }

    if (!preg_match('/^[A-Z]{2,4}[0-9]{2,4}$/', $patente) || strlen($patente) != 6) {
        throw new Exception("La patente debe tener el formato Chileno XXXX00 - XX0000");
    }

    if (!is_numeric($km_actual) || $km_actual < 0) {
        throw new Exception("El kilometraje debe ser un número positivo.");
    }

    if (empty($encargado)) {
        $encargado = NULL;
    }

    if ($activo != "Si" && $activo != "No") {
        throw new Exception("El estado 'activo' debe ser 'Si' o 'No'.");
    }

    // Consulta SQL para insertar un nuevo vehículo
    $sql_insertar = "
        INSERT INTO vehiculo (patente, marca, modelo, año, km_actual, fecha_revision_tecnica, rut, activo)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

    $stmnt_insertar = mysqli_prepare($conexion, $sql_insertar);
    mysqli_stmt_bind_param($stmnt_insertar, "sssiisss", $patente, $marca, $modelo, $año, $km_actual, $revision_tecnica, $encargado, $activo);
    mysqli_stmt_execute($stmnt_insertar);

    if (mysqli_stmt_affected_rows($stmnt_insertar) > 0) {
        $icono = "success";
        $mensaje = "Vehículo agregado exitosamente.";
    } else {
        throw new Exception("No se pudo agregar el vehículo.");
    }

} catch (Exception $e) {
    $icono = "error";
    $mensaje = "Hubo un error al agregar el vehículo: " . $e->getMessage();
}

// Redirigir de nuevo a la página principal con el estado y el mensaje
header("Location: ../vehiculos.php?status=$icono&mensaje=$mensaje");
exit();
?>
