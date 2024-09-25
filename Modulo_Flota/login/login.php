<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Incluir Bootstrap 5 -->
    <link rel="stylesheet" href="../estilos_generales/login.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="cl-icon/css/all.min.css">
    <!-- Titulo e Ícono -->
    <link rel="shortcut icon" href="../img/logo.png" />
    <title>Modulo Flota | Principal</title>
</head>

<body>
    <div class="wrapper">
        <form action="validate_login.php" class="form" method="POST">
            <h1 class="title">Inicio</h1>

            <div class="inp">
                <!-- <label for="Usuario" class="form-label">Usuario</label> -->
                <input type="text" class="input" id="Usuario" name="Usuario" placeholder="Ingresa tu usuario" required>
                <i class="fa-solid fa-user"></i>
            </div>

            <div class="inp">
                <!-- <label for="clave" class="form-label">Clave</label> -->
                <input type="password" class="input" id="clave" name="clave" placeholder="Ingresa tu clave" required>
                <i class="fa-solid fa-lock"></i>
            </div>

            <button type="submit" class="submit">Iniciar Sesión</button>
        </form>
        <div></div>
        <div class="banner">
            <h1 class="wel_text"></h1><br>
            <p class="para"></p>
        </div>
    </div>
</body>

</html>

<!-- Mostrar mensaje de error, si lo hay -->
<?php
if (isset($_GET['error'])) {
    echo '<div class="alert alert-danger mt-3" role="alert">' . htmlspecialchars($_GET['error']) . '</div>';
}
?>