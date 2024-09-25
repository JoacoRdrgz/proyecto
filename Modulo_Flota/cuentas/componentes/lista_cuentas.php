<div class="row">
    <div class="col">
        <h1>Gestión de Usuario</h1>
    </div>

    <div class="col-auto">
        <form action="" method="POST">
            <input type="hidden" name="tipo_vista" value="editar">
            <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#modalAgregarUsuario">
                Registrar Usuario
            </button>
        </form>
    </div>
</div>

<?php
if (!isset($conexion)) {
    include($_SERVER['DOCUMENT_ROOT'] . "/Modulo_Flota/conexion.php");
}

$sql_usuarios = "
    SELECT u.rut, u.nombre, u.Usuario, u.Id_Rol, r.nombre_rol 
    FROM usuario u
    LEFT JOIN roles r ON u.Id_Rol = r.Id_Rol
    WHERE u.Usuario IS NOT NULL AND u.clave IS NOT NULL;
";

$stmt_usuarios = $conexion->prepare($sql_usuarios);
$stmt_usuarios->execute();
$resultado_usuarios = $stmt_usuarios->get_result();
?>

<table id="tabla_usuarios">
    <thead>
        <tr>
            <th style="width: 20%;">Nombre</th>
            <th style="width: 20%;">Usuario</th>
            <th style="width: 20%;">Rol</th>
            <th style="width: 20%;">Acción</th>
        </tr>
    </thead>

    <tbody>
        <?php foreach ($resultado_usuarios as $usuario) : ?>
            <tr>
                <td><?= htmlspecialchars($usuario['nombre']) ?></td>
                <td><?= htmlspecialchars($usuario['Usuario']) ?></td>
                <td><?= htmlspecialchars($usuario['nombre_rol']) ?></td>
                <td>
                    <div class="btn-group" role="group">
                        <!-- Botón para abrir el modal de Actualizar Cuenta -->
                        <button class="btn no-colapse" style="color: #cfbb4a" data-bs-toggle="modal" data-bs-target="#modalActualizarCuenta"
                            onclick="completar_datos_modal_actualizar('<?= htmlspecialchars($usuario['nombre']) ?>', '<?= htmlspecialchars($usuario['Usuario']) ?>', '<?= htmlspecialchars($usuario['Id_Rol']) ?>', '<?= htmlspecialchars($usuario['rut']) ?>')">
                            <i class="fa-regular fa-pen-to-square"></i>
                            &nbsp;
                            <span class="subrayado">Actualizar</span>
                        </button>

                        <!-- Botón para abrir el modal de Eliminar Cuenta -->
                        <button class="btn no-colapse" style="color: #ff0000" data-bs-toggle="modal" data-bs-target="#modal_eliminar" onclick="completar_datos_modal_eliminar('<?= htmlspecialchars($usuario['rut']) ?>')">
                            <i class="fa-regular fa-trash-can"></i>
                            &nbsp;
                            <span class="subrayado">Eliminar</span>
                        </button>
                    </div>
                </td>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>

<?php mysqli_commit($conexion) ?>

<script>
    $(document).ready(function() {
        $('#tabla_usuarios').DataTable({
            language: {
                url: 'https://cdn.datatables.net/plug-ins/1.13.7/i18n/es-CL.json',
            },
            order: [
                [0, 'desc']
            ]
        });
    });

    function completar_datos_modal_actualizar(nombre, Usuario, Id_Rol, rut) {
        document.getElementById("input_nombre").value = nombre;
        document.getElementById("input_usuario").value = Usuario;
        document.getElementById("input_rut").value = rut;
        document.getElementById("input_rol").value = Id_Rol;
    }

    function completar_datos_modal_eliminar(rut) {
        console.log("RUT enviado al modal: ", rut); // Verifica que el RUT se esté enviando correctamente
        document.getElementById("rut_eliminar").value = rut;
    }
</script>