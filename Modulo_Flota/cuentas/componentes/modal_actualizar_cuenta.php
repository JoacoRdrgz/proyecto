<div class="modal fade" id="modalActualizarCuenta" tabindex="-1" aria-labelledby="modalActualizarCuentaLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="php/actualizar_cuenta.php" method="POST" onsubmit="return validarFormulario()">

            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="modalActualizarCuentaLabel">Actualizar Cuenta de Usuario</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">

                    <!-- Campo oculto para el RUT -->
                    <input type="hidden" name="rut" id="input_rut">
                    <br>

                    <!-- Campo Nombre (readonly, se carga automáticamente) -->
                    <label for="input_nombre">Nombre del Usuario</label>
                    <input type="text" name="nombre" id="input_nombre" class="form-control" readonly required>
                    <br>

                    <!-- Campo Nombre de Usuario -->
                    <label for="input_usuario">Nombre de Usuario</label>
                    <input type="text" name="Usuario" id="input_usuario" class="form-control">
                    <br>

                    <!-- Campo Contraseña (opcional) -->
                    <label for="input_clave">Contraseña (opcional)</label>
                    <input type="password" name="clave" id="input_clave" class="form-control" placeholder="Dejar vacío si no desea cambiar la contraseña">
                    <div class="alert alert-info mt-2" role="alert">
                        La contraseña debe tener:
                        <ul>
                            <li>Al menos 8 caracteres</li>
                            <li>Incluir una letra mayúscula</li>
                            <li>Debe tener mínimo un número</li>
                        </ul>
                    </div>
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
        </form>
    </div>
</div>