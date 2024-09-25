<div class="modal fade" id="modal_actualizar" tabindex="-1" aria-labelledby="modal_actualizar" aria-hidden="true">
    <div class="modal-dialog">
        <form action="php/actualizar_personal.php" method="POST" onsubmit="return validarFormulario()">

            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="modal_actualizar">Actualizar Personal</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">

                    <!-- Campo RUT (readonly) -->
                    <label for="input_rut">RUT</label>
                    <input type="text" name="rut" id="input_rut" class="form-control" readonly required>
                    <br>

                    <!-- Campo Nombre -->
                    <label for="input_nombre">Nombre</label>
                    <input type="text" name="nombre" id="input_nombre" class="form-control" required>
                    <br>

                    <!-- Campo Fecha de Ingreso -->
                    <label for="input_fecha_ingreso">Fecha de Ingreso</label>
                    <input type="date" name="fecha_ingreso" id="input_fecha_ingreso" class="form-control" required>
                    <br>

                    <!-- Campo Rol (select con Id_Rol y nombre_rol) -->
                    <label for="input_rol">Rol</label>
                    <select name="Id_Rol" id="input_rol" class="form-control" required>
                        <option value="">Seleccione un rol</option>
                        <?php
                        // Conectarse a la base de datos y obtener los roles disponibles
                        $sql_roles = "SELECT Id_Rol, nombre_rol FROM roles";
                        $resultado_roles = $conexion->query($sql_roles);

                        // Iterar sobre los resultados y crear una opción para cada rol
                        while ($rol = $resultado_roles->fetch_assoc()) {
                            echo '<option value="' . htmlspecialchars($rol['Id_Rol']) . '">' . htmlspecialchars($rol['nombre_rol']) . '</option>';
                        }
                        ?>
                    </select>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Actualizar</button>
                </div>
            </div>
        </form>
    </div>
</div>