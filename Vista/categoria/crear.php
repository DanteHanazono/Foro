<div class="card">
	<h5 class="card-header bg-dark text-white">Crear categoría</h5>
	<div class="card-body">
		<form method="post" action="?controlador=categoria&accion=crearCategoria" id="frmCCat">
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label>Nombre de categoría</label>
						<input type="text" name="nombre" id="nombre" class="form-control" required>
					</div>
				</div>
			</div>
			<input type="submit" name="aceptar" value="Crear" class="btn btn-dark">
			<br />
			<?php
			if (isset($this->mensaje)) {
				echo $this->mensaje;
			}
			?>
		</form>
	</div>
</div>