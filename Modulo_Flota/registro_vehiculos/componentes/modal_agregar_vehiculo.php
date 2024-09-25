<!-- Modal Agregar Vehículo -->
<div class="modal fade" id="modalAgregarVehiculo" tabindex="-1" role="dialog" aria-labelledby="modalAgregarVehiculoLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form id="formAgregarVehiculo" method="POST" action="php/agregar_vehiculo.php">

            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="modalAgregarVehiculoLabel">Agregar Nuevo Vehículo</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
                </div>


                <div class="modal-body">
                    <label for="patente">Patente</label>
                    <input type="text" class="form-control" id="patente" name="patente" required>

                    <label for="marca">Marca</label>
                    <input type="text" class="form-control" id="marca" name="marca" required>

                    <label for="modelo">Modelo</label>
                    <input type="text" class="form-control" id="modelo" name="modelo" required>

                    <label for="año">Año</label>
                    <input type="number" class="form-control" id="año" name="año" required>

                    <label for="km_actual">Kilometraje Actual</label>
                    <input type="number" class="form-control" id="km_actual" name="km_actual" required>

                    <label for="fecha_revision_tecnica">Fecha Revisión Técnica</label>
                    <input type="date" class="form-control" id="fecha_revision_tecnica" name="fecha_revision_tecnica" required>

                    <!-- Campo Encargado (select con RUT y nombre) -->
                    <label for="input_rut">Encargado</label>
                    <select name="rut" id="input_rut" class="form-control" required>
                        <option value="">Seleccione un encargado</option>
                        <?php
                        // Conectarse a la base de datos y obtener los usuarios registrados
                        $sql_usuarios = "SELECT rut, nombre FROM usuario";
                        $resultado_usuarios = $conexion->query($sql_usuarios);

                        // Iterar sobre los resultados y crear una opción para cada usuario
                        while ($usuario = $resultado_usuarios->fetch_assoc()) {
                            echo '<option value="' . htmlspecialchars($usuario['rut']) . '">' . htmlspecialchars($usuario['rut']) . ' | ' . htmlspecialchars($usuario['nombre']) . '</option>';
                        }
                        ?>
                    </select>

                    <label for="activo">Activo</label>
                    <select class="form-control" id="activo" name="activo">
                        <option value="Si">Sí</option>
                        <option value="No">No</option>
                    </select>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Agregar Vehículo</button>
                </div>
        </form>
    </div>
</div>
</div>