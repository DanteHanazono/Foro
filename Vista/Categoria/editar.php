<div class="card">
	<h5 class="card-header bg-dark text-white">Editar categoría</h5>
	<div class="card-body">
		<form method="post" action="?controlador=categoria&accion=editarCategoria" id="frmECat">
			<div class="row">
				<div class="input-group input-group-sm mb-1 col-md-6">
					<div class="input-group-prepend">
						<span class="input-group-text" id="inputGroup-sizing-sm">Nombre de categoria</span>
					</div>
					<input type="text" class="form-control" name="nombre" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" value="<?php echo $this->datos["CAT_NOMBRE"]; ?>">
				</div>
			</div>
			<input type="submit" name="aceptar" value="Editar" class="btn btn-dark">
			<input type="hidden" name="id" value="<?php echo $this->datos["CAT_ID"]; ?>">
			<br />
			<?php
			if (isset($this->mensaje)) {
				echo $this->mensaje;
			}
			?>
		</form>
	</div>
</div>