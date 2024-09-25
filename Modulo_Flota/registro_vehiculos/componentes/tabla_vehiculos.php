<div class="row">
    <div class="col">
        <h1>Gestión de Flota</h1>
    </div>

    <div class="col-auto">


        <form action="" method="POST">
            <input type="hidden" name="tipo_vista" value="editar">
            <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#modalAgregarVehiculo">
                Registrar Vehículo
            </button>
        </form>

    </div>
</div>



<?php
if (!isset($conexion)) {
    include($_SERVER['DOCUMENT_ROOT'] . "/Modulo_Flota/conexion.php");
}

$sql_vehiculo = " SELECT v.patente, v.marca, v.modelo, v.año, v.km_actual, v.fecha_revision_tecnica, v.rut, u.nombre, v.activo
FROM vehiculo v
LEFT JOIN usuario u ON v.rut = u.rut
WHERE v.activo = 'si';";

$stmt_vehiculo = $conexion->prepare($sql_vehiculo);
$stmt_vehiculo->execute();
$resultado_vehiculo = $stmt_vehiculo->get_result();
?>

<table id="tabla_vehiculo">
    <thead>
        <tr>
            <th style="width: 10%;">Patente</th>
            <th style="width: 10%;">Marca</th>
            <th style="width: 10%;">Modelo</th>
            <th style="width: 10%;">Año</th>
            <th style="width: 10%;">Km Actual</th>
            <th style="width: 10%;">Revision Tecnica</th>
            <th style="width: 10%;">Nombre Encargado</th>
            <th style="width: 10%;">Acción</th>
        </tr>
    </thead>

    <tbody>
        <?php foreach ($resultado_vehiculo as $vehiculo) : ?>
            <tr>
                <td><?= htmlspecialchars($vehiculo['patente']) ?></td>
                <td><?= htmlspecialchars($vehiculo['marca']) ?></td>
                <td><?= htmlspecialchars($vehiculo['modelo']) ?></td>
                <td><?= htmlspecialchars($vehiculo['año']) ?></td>
                <td><?= htmlspecialchars($vehiculo['km_actual']) ?></td>
                <td><?= htmlspecialchars($vehiculo['fecha_revision_tecnica']) ?></td>
                <td><?= htmlspecialchars($vehiculo['nombre']) ?></td>
                <td>
                    <div class="btn-group" role="group">
                        <button class="btn no-colapse" style="color: #cfbb4a" data-bs-toggle="modal" data-bs-target="#modal_actualizar"
                            onclick="completar_datos_modal_actualizar('<?= htmlspecialchars($vehiculo['patente']) ?>', '<?= htmlspecialchars($vehiculo['marca']) ?>', '<?= htmlspecialchars($vehiculo['modelo']) ?>', '<?= htmlspecialchars($vehiculo['año']) ?>', '<?= htmlspecialchars($vehiculo['km_actual']) ?>', '<?= htmlspecialchars($vehiculo['fecha_revision_tecnica']) ?>', '<?= htmlspecialchars($vehiculo['rut']) ?>', '<?= htmlspecialchars($vehiculo['nombre']) ?>' )">
                            <i class="fa-regular fa-pen-to-square"></i>
                            &nbsp;
                            <span class="subrayado">Actualizar</span>
                        </button>

                        <button class="btn no-colapse" style="color: #ff0000" data-bs-toggle="modal" data-bs-target="#modal_eliminar" onclick="completar_datos_modal_eliminar('<?= htmlspecialchars($vehiculo['patente']) ?>')">
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

<?php
// Modal de botones
require_once("modal_actualizar_vehiculo.php");
require_once("componentes/modal_eliminar_vehiculo.php");
?>

<script>
    $(document).ready(function() {
        $('#tabla_vehiculo').DataTable({
            language: {
                url: 'https://cdn.datatables.net/plug-ins/1.13.7/i18n/es-CL.json',
            },
            order: [
                [0, 'desc']
            ]
        });
    });

    function completar_datos_modal_actualizar(patente, marca, modelo, año, km_actual, fecha_revision_tecnica, rut, nombre) {
        document.getElementById("input_patente").value = patente;
        document.getElementById("input_marca").value = marca;
        document.getElementById("input_modelo").value = modelo;
        document.getElementById("input_año").value = año;
        document.getElementById("input_km_actual").value = km_actual;
        document.getElementById("input_fecha_revision_tecnica").value = fecha_revision_tecnica;
        document.getElementById("input_rut").value = rut;
        document.getElementById("input_nombre_encargado").value = nombre;
    }

    function completar_datos_modal_eliminar(patente) {
        document.getElementById("rut_eliminar").value = patente;
    }
</script>