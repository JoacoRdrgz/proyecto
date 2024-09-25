<!-- Modal Agregar Usuario -->
<div class="modal fade" id="modalAgregarUsuario" tabindex="-1" role="dialog" aria-labelledby="modalAgregarUsuarioLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form id="formAgregarUsuario" method="POST" action="php/agregar_cuenta.php">

            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="modalAgregarUsuarioLabel">Agregar Cuenta de Usuario</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
                </div>

                <div class="modal-body">
                    <!-- Campo Usuario (Lista desplegable con RUT y Nombre) -->
                    <label for="usuario">Seleccione el Usuario</label>
                    <select name="rut" id="usuario" class="form-control" required>
                        <option value="">Seleccione un usuario</option>
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
                    <br>

                    <!-- Campo Nombre de Usuario -->
                    <label for="nombre_usuario">Nombre de Usuario</label>
                    <input type="text" class="form-control" id="nombre_usuario" name="Usuario" placeholder="Nombre de Usuario" required>
                    <br>

                    <!-- Campo Contraseña -->
                    <label for="clave">Contraseña</label>
                    <input type="password" class="form-control" id="clave" name="clave" placeholder="Ingrese la contraseña" required>

                    <!-- Información sobre los requisitos de la contraseña -->
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
                <button type="submit" class="btn btn-primary">Agregar Usuario</button>
            </div>
        </form>
    </div>
</div>
</div>