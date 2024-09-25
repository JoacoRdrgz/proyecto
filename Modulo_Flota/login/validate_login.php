<?php
session_start();
include '../conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $usuario = $_POST['Usuario'];
    $clave = $_POST['clave'];

    // Verifica si los campos están vacíos
    if (empty($usuario) || empty($clave)) {
        header("Location: login.php?error=Todos los campos son obligatorios");
        exit();
    }

    // Prepara la consulta para obtener el rut, clave, nombre y rol del usuario
    $stmt = $conexion->prepare("SELECT rut, clave, nombre, Id_Rol FROM usuario WHERE Usuario = ?");
    $stmt->bind_param("s", $usuario);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        
        // Encriptamos la clave ingresada con sha-256
        $hashed_input_clave = hash('sha256', $clave);

        // Verificamos si el hash generado coincide con el hash almacenado
        if ($hashed_input_clave === $row['clave']) {
            // Iniciar la sesión y guardar el rut, nombre y rol del usuario en la sesión
            $_SESSION['rut'] = $row['rut'];
            $_SESSION['nombre'] = $row['nombre']; // Almacenar el nombre del usuario en la sesión
            $_SESSION['rol'] = $row['Id_Rol'];    // Almacenar el rol del usuario en la sesión

            // Redirigir a la página principal
            header("Location: ../index.php");
            exit();
        } else {
            header("Location: login.php?error=Usuario o clave incorrecta");
            exit();
        }
    } else {
        header("Location: login.php?error=Usuario o clave incorrecta");
        exit();
    }

    $stmt->close();
    $conexion->close();
}
?>

