<div class="modal fade" id="modal_eliminar" tabindex="-1" aria-labelledby="modal_eliminar_label" aria-hidden="true">
    <div class="modal-dialog">
        <form action="php/eliminar_vehiculo.php" method="POST">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="modal_eliminar_label">Eliminar Vehículo</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>¿Estás seguro de que deseas eliminar este vehículo? Esta acción no puede deshacerse.</p>
                    <input type="hidden" name="patente" id="rut_eliminar" value="">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-danger">Eliminar</button>
                </div>
            </div>
        </form>
    </div>
</div>
