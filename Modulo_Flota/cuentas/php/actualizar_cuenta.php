<?php
include("../../conexion.php");
session_start();

try {
    // Obtener los datos del formulario
    $rut = $_POST['rut'];  // Asegúrate de que el campo 'rut' se ha enviado correctamente
    $Usuario = $_POST['Usuario'];
    $clave = $_POST['clave'];
    $Id_Rol = $_POST['Id_Rol'];

    // Validaciones del lado del servidor
    if (empty($rut) || empty($Id_Rol)) {
        throw new Exception("El RUT y el Rol son obligatorios.");
    }

    // Validar que el nombre de usuario no tenga más de 20 caracteres (si fue modificado)
    if (!empty($Usuario) && strlen($Usuario) > 20) {
        throw new Exception("El nombre de usuario no puede tener más de 20 caracteres.");
    }

    // Validar la contraseña solo si se proporcionó
    if (!empty($clave)) {
        if (!preg_match('/^(?=.*[A-Z])(?=.*\d)[A-Za-z\d]{8,}$/', $clave)) {
            throw new Exception("La contraseña debe tener al menos 8 caracteres, una mayúscula y un número.");
        }
        // Encriptar la contraseña con SHA-256
        $clave_encriptada = hash('sha256', $clave);
    }

    // Construir la consulta SQL dinámicamente
    $sql_actualizar = "UPDATE usuario SET Id_Rol = ?";
    $params = [$Id_Rol];  // Parámetros a vincular en la consulta

    if (!empty($Usuario)) {
        $sql_actualizar .= ", Usuario = ?";
        $params[] = $Usuario;  // Agregar Usuario si fue modificado
    }

    if (!empty($clave)) {
        $sql_actualizar .= ", clave = ?";
        $params[] = $clave_encriptada;  // Agregar la clave encriptada si fue modificada
    }

    $sql_actualizar .= " WHERE rut = ?";
    $params[] = $rut;  // Siempre vincular el RUT

    // Preparar y ejecutar la consulta
    $stmnt_actualizar = mysqli_prepare($conexion, $sql_actualizar);
    $types = str_repeat('s', count($params));  // Construir los tipos de datos para mysqli_stmt_bind_param
    mysqli_stmt_bind_param($stmnt_actualizar, $types, ...$params);
    mysqli_stmt_execute($stmnt_actualizar);

    if (mysqli_stmt_affected_rows($stmnt_actualizar) > 0) {
        $icono = "success";
        $mensaje = "Cuenta actualizada exitosamente.";
    } else {
        throw new Exception("No se realizaron cambios en los datos.");
    }

    mysqli_stmt_close($stmnt_actualizar);
} catch (Exception $e) {
    $icono = "error";
    $mensaje = "Hubo un error al actualizar: " . $e->getMessage();
}

// Redirigir de nuevo a la página principal con el estado y el mensaje
header("Location: ../cuentas.php?status=$icono&mensaje=$mensaje");
exit();
?>
