<?php
include("../../conexion.php");
session_start();

try {
    // Obtener los datos del formulario
    $rut = $_POST['rut'];
    $Usuario = $_POST['Usuario'];
    $clave = $_POST['clave'];
    $Id_Rol = $_POST['Id_Rol'];

    // Validaciones del lado del servidor
    if (empty($rut) || empty($Usuario) || empty($clave) || empty($Id_Rol)) {
        throw new Exception("Todos los campos son obligatorios.");
    }

    // Validar que el nombre de usuario no tenga más de 20 caracteres
    if (strlen($Usuario) > 20) {
        throw new Exception("El nombre de usuario no puede tener más de 20 caracteres.");
    }

    // Validar si el usuario ya tiene una cuenta
    $sql_verificar_cuenta = "SELECT Usuario FROM usuario WHERE rut = ? AND Usuario IS NOT NULL";
    $stmnt_verificar = mysqli_prepare($conexion, $sql_verificar_cuenta);
    mysqli_stmt_bind_param($stmnt_verificar, "s", $rut);
    mysqli_stmt_execute($stmnt_verificar);
    mysqli_stmt_store_result($stmnt_verificar);

    if (mysqli_stmt_num_rows($stmnt_verificar) > 0) {
        throw new Exception("Este usuario ya tiene una cuenta creada.");
    }

    mysqli_stmt_close($stmnt_verificar);

    // Validar que la contraseña tenga al menos 8 caracteres, una mayúscula y un número
    if (!preg_match('/^(?=.*[A-Z])(?=.*\d)[A-Za-z\d]{8,}$/', $clave)) {
        throw new Exception("La contraseña debe tener al menos 8 caracteres, una mayúscula y un número.");
    }

    // Encriptar la contraseña con SHA-256
    $clave_encriptada = hash('sha256', $clave);

    // Consulta SQL para actualizar el usuario con la nueva cuenta
    $sql_actualizar = "
        UPDATE usuario 
        SET Usuario = ?, 
            clave = ?, 
            Id_Rol = ?
        WHERE rut = ?";

    $stmnt_actualizar = mysqli_prepare($conexion, $sql_actualizar);
    mysqli_stmt_bind_param($stmnt_actualizar, "ssis", $Usuario, $clave_encriptada, $Id_Rol, $rut);
    mysqli_stmt_execute($stmnt_actualizar);

    if (mysqli_stmt_affected_rows($stmnt_actualizar) > 0) {
        $icono = "success";
        $mensaje = "Usuario agregado exitosamente.";
    } else {
        throw new Exception("No se pudo agregar el usuario.");
    }

    mysqli_stmt_close($stmnt_actualizar);
} catch (Exception $e) {
    $icono = "error";
    $mensaje = "Hubo un error al agregar el usuario: " . $e->getMessage();
}

// Redirigir de nuevo a la página principal con el estado y el mensaje
header("Location: ../cuentas.php?status=$icono&mensaje=$mensaje");
exit();
?>
