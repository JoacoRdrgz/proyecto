<?php
session_start();
session_destroy(); // Destruye todas las variables de sesión
header("Location: ../login/login.php"); // Redirige al login después de cerrar sesión
exit();
?>
