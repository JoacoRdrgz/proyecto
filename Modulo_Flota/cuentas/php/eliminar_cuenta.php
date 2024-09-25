<?php
include("../../conexion.php");
session_start();

try {
    $rut = $_POST['rut'];

    // Validar que el RUT no esté vacío
    if (empty($rut)) {
        throw new Exception("El RUT del usuario es obligatorio para eliminar la cuenta.");
    }

    // Consulta SQL para vaciar los campos 'Usuario' y 'clave'
    $sql_eliminar = "UPDATE usuario SET Usuario = NULL, clave = NULL WHERE rut = ?";

    $stmnt_eliminar = mysqli_prepare($conexion, $sql_eliminar);
    mysqli_stmt_bind_param($stmnt_eliminar, "s", $rut);
    mysqli_stmt_execute($stmnt_eliminar);

    if (mysqli_stmt_affected_rows($stmnt_eliminar) > 0) {
        $icono = "success";
        $mensaje = "Cuenta eliminada correctamente.";
    } else {
        throw new Exception("No se pudo eliminar la cuenta. Verifique el RUT.");
    }

    mysqli_stmt_close($stmnt_eliminar);
} catch (Exception $e) {
    $icono = "error";
    $mensaje = "Hubo un error al eliminar la cuenta: " . $e->getMessage();
}

// Redirigir de nuevo a la página principal con el estado y el mensaje
header("Location: ../cuentas.php?status=$icono&mensaje=$mensaje");
