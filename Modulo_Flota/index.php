<?php
session_start();

// Verifica si el usuario ha iniciado sesión
if (!isset($_SESSION['rut'])) {
    // Si no está autenticado, redirige al login
    header("Location: login.php");
    exit();
}

include("conexion.php");

// Verificar si el usuario está autenticado y si la sesión tiene un rol definido
if (!isset($_SESSION['rut']) || !isset($_SESSION['rol'])) {
    header("Location: login.php");
    exit();
}

$rol = $_SESSION['rol']; // Obtener el rol del usuario desde la sesión
?>

<!DOCTYPE html>
<html lang="es" dir="ltr">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Css -->
    <link rel="stylesheet" type="text/css" href="estilos_generales/sidebar.css">
    <link rel="stylesheet" type="text/css" href="estilos_generales/formulario.css">
    <!--Bootstrap 5-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <!-- Sweetalert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Titulo e Ícono -->
    <link rel="shortcut icon" href="img/logo.png" />
    <title>Modulo Flota | Principal</title>
</head>

<body>
    <!-- Sidebar -->
    <nav class="sidebar">
        <div class="cuadricula">
            <a href="admin.php">
                <img src="img/logo.png" alt="Logo" class="logo_Blanco">
            </a>
            <hr class="sidebarHr">

            <!-- Enlaces de menú según el rol del usuario -->
            <?php if (isset($rol)): ?>
                <?php if ($rol == 1): // Admin ?>
                    <a class="elemento" href="personal/lista_empleados.php">Administración de Personal</a>
                    <a class="elemento" href="cuentas/cuentas.php">Administración de Cuentas</a>
                    <a class="elemento" href="registro_vehiculos/vehiculos.php">Registro de Vehiculos</a>
                    <a class="elemento" href="">Reporte de Vehiculos</a>
                    <a class="elemento" href="">Historial de siniestro</a>
                    <a class="elemento" href="">Solicitud de Combustible</a>
                    <a class="elemento" href="">Panel de Control y Reportes</a>
                    <a class="elemento" href="">Control de Dinero</a>
                <?php elseif ($rol == 2): // Supervisor ?>
                    <a class="elemento" href="personal/lista_empleados.php">Administración de Personal</a>
                    <a class="elemento" href="registro_vehiculos/vehiculos.php">Registro de Vehiculos</a>
                    <a class="elemento" href="">Reporte de Vehiculos</a>
                    <a class="elemento" href="">Historial de siniestro</a>
                    <a class="elemento" href="">Solicitud de Combustible</a>
                    <a class="elemento" href="">Panel de Control y Reportes</a>
                    <a class="elemento" href="">Control de Dinero</a>
                <?php elseif ($rol == 3): // Chofer ?>
                    <a class="elemento" href="">Reporte de Vehiculos</a>
                    <a class="elemento" href="">Historial de siniestro</a>
                    <a class="elemento" href="">Solicitud de Combustible</a>
                <?php endif; ?>
            <?php else: ?>
                <!-- Si no hay rol definido -->
                <p>Error: El rol del usuario no está definido.</p>
            <?php endif; ?>
        </div>

        <!-- Dropdown Menú -->
        <div class="dropdown">
            <hr class="sidebarHr">
            <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                <img src="img/logo.png" alt="" width="32" height="32" class="rounded-circle me-2">
                <!-- Mostrar nombre de usuario, o 'Usuario' si no está definido -->
                <strong><?php echo isset($_SESSION['nombre']) ? htmlspecialchars($_SESSION['nombre']) : 'Usuario'; ?></strong>
            </a>
            <ul class="dropdown-menu dropdown-menu text-small shadow">
                <li><a class="dropdown-item" href="">Creacion de Usuario</a></li>
                <li><a class="dropdown-item" href="">Actualizar Perfil</a></li>
                <li>
                    <hr class="dropdown-divider">
                </li>
                <li><a class="dropdown-item" href="/modulo_flota/login/cerrar_sesion.php">Cerrar Sesión</a></li>
            </ul>
        </div>
    </nav>

    <!-- Contenido -->
    <main class="content">
        <img class="logo" src="img/logo.png" alt="Logo Dominion">
        <!-- Mostrar el nombre del usuario o 'Usuario' si no está definido -->
        <h1>Bienvenido/a, <?php echo isset($_SESSION['nombre']) ? htmlspecialchars($_SESSION['nombre']) : 'Usuario'; ?></h1>

        <!-- Mostrar mensaje de error si existe en la URL -->
        <?php if (isset($_GET['error'])): ?>
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: '<?php echo htmlspecialchars($_GET['error']); ?>',
                    showConfirmButton: true,
                    confirmButtonText: 'OK'
                });
            </script>
        <?php endif; ?>
    </main>
</body>

</html>

