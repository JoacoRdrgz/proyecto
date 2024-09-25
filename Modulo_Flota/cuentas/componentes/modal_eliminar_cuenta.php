<div class="modal fade" id="modal_eliminar" tabindex="-1" aria-labelledby="modal_eliminar_label" aria-hidden="true">
    <div class="modal-dialog">
        <form action="php/eliminar_cuenta.php" method="POST">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="modal_eliminar_label">Eliminar Cuenta de Usuario</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>¿Estás seguro de que deseas eliminar la cuenta de este usuario? Solo se eliminarán el nombre de usuario y la contraseña, pero no el usuario completo.</p>
                    <input type="hidden" name="rut" id="rut_eliminar" value="">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-danger">Eliminar Cuenta</button>
                </div>
            </div>
        </form>
    </div>
</div>
