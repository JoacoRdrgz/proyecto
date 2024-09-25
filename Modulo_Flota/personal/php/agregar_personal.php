<?php
include("../../conexion.php");
session_start();

try {
    // Obtener los datos del formulario
    $rut = $_POST['rut'];
    $nombre = $_POST['nombre'];
    $fecha_ingreso = $_POST['fecha_ingreso'];
    $Id_Rol = $_POST['Id_Rol'];

    // Validaciones del lado del servidor
    if (empty($rut) || empty($nombre) || empty($fecha_ingreso) || empty($Id_Rol)) {
        throw new Exception("Todos los campos son obligatorios.");
    }

    // Validar formato del RUT (puedes ajustar esto según las reglas de formato del RUT chileno)
    if (!preg_match('/^\d{1,2}\.\d{3}\.\d{3}-[\dkK]$/', $rut)) {
        throw new Exception("El formato del RUT es inválido.");
    }

    // Validar que el nombre solo contenga letras de la A a la Z (incluyendo acentos y espacios)
    if (!preg_match('/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/', $nombre)) {
        throw new Exception("El nombre solo puede contener letras de la A a la Z.");
    }

    // Validar formato de la fecha de ingreso
    if (!preg_match('/\d{4}-\d{2}-\d{2}/', $fecha_ingreso)) {
        throw new Exception("Formato de fecha inválido. Debe ser AAAA-MM-DD.");
    }

    // Consulta SQL para insertar un nuevo usuario
    $sql_insertar = "
        INSERT INTO usuario (rut, nombre, fecha_ingreso, Id_Rol)
        VALUES (?, ?, ?, ?)";

    $stmnt_insertar = mysqli_prepare($conexion, $sql_insertar);
    mysqli_stmt_bind_param($stmnt_insertar, "sssi", $rut, $nombre, $fecha_ingreso, $Id_Rol);
    mysqli_stmt_execute($stmnt_insertar);

    if (mysqli_stmt_affected_rows($stmnt_insertar) > 0) {
        $icono = "success";
        $mensaje = "Personal agregado exitosamente.";
    } else {
        throw new Exception("No se pudo agregar el personal.");
    }

    mysqli_stmt_close($stmnt_insertar);
} catch (Exception $e) {
    $icono = "error";
    $mensaje = "Hubo un error al agregar el personal: " . $e->getMessage();
}

// Redirigir de nuevo a la página principal con el estado y el mensaje
header("Location: ../lista_empleados.php?status=$icono&mensaje=$mensaje");
exit();
