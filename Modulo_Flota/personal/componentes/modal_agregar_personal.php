<!-- Modal Agregar Personal -->
<div class="modal fade" id="modalAgregarPersonal" tabindex="-1" role="dialog" aria-labelledby="modalAgregarPersonalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form id="formAgregarPersonal" method="POST" action="php/agregar_personal.php">

            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="modalAgregarPersonalLabel">Agregar Nuevo Personal</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
                </div>

                <div class="modal-body">
                    <!-- Campo RUT -->
                    <label for="rut">RUT</label>
                    <input type="text" class="form-control" id="rut" name="rut" placeholder="Ingrese el rut con puntos y guión" required>
                    <br>

                    <!-- Campo Nombre -->
                    <label for="nombre">Nombre</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Primer Nombre y los dos Apellidos" required>
                    <br>

                    <!-- Campo Fecha de Ingreso -->
                    <label for="fecha_ingreso">Fecha de Ingreso</label>
                    <input type="date" class="form-control" id="fecha_ingreso" name="fecha_ingreso" required>
                    <br>

                    <!-- Campo Rol (select con Id_Rol y nombre_rol) -->
                    <label for="Id_Rol">Rol</label>
                    <select name="Id_Rol" id="Id_Rol" class="form-control" required>
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
                    <button type="submit" class="btn btn-primary">Agregar Personal</button>
                </div>
        </form>
    </div>
</div>
</div>