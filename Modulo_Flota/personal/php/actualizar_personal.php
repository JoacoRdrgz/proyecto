<?php
include("../../conexion.php");
session_start();

try {
    $rut = $_POST['rut'];
    $nombre = $_POST['nombre'];
    $fecha_ingreso = $_POST['fecha_ingreso'];
    $Id_Rol = $_POST['Id_Rol'];

    // Validaciones del lado del servidor
    if (empty($rut) || empty($nombre) || empty($fecha_ingreso) || empty($Id_Rol)) {
        throw new Exception("Todos los campos son obligatorios.");
    }

    // Validar que el nombre solo contenga letras de la A a la Z (incluyendo acentos y espacios)
    if (!preg_match('/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/', $nombre)) {
        throw new Exception("El nombre solo puede contener letras de la A a la Z.");
    }

    // Validar fecha de ingreso
    if (!preg_match('/\d{4}-\d{2}-\d{2}/', $fecha_ingreso)) {
        throw new Exception("Formato de fecha inválido. Debe ser AAAA-MM-DD.");
    }

    // Consulta SQL para actualizar los datos del empleado
    $sql_actualizar = "
        UPDATE usuario 
        SET nombre = ?, 
            fecha_ingreso = ?, 
            Id_Rol = ?
        WHERE rut = ?";

    $stmnt_actualizar = mysqli_prepare($conexion, $sql_actualizar);
    mysqli_stmt_bind_param($stmnt_actualizar, "ssis", $nombre, $fecha_ingreso, $Id_Rol, $rut);
    mysqli_stmt_execute($stmnt_actualizar);

    if (mysqli_stmt_affected_rows($stmnt_actualizar) > 0) {
        // Si el usuario conectado es el mismo que se está actualizando, actualizar su rol en la sesión
        if ($_SESSION['rut'] == $rut) {
            $_SESSION['rol'] = $Id_Rol;
        }
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
header("Location: ../lista_empleados.php?status=$icono&mensaje=$mensaje");
exit();
