<div class="card">
	<h5 class="card-header bg-dark text-white">Perfil</h5>
	<div class="card-body">
		<form method="post" action="?controlador=usuario&accion=editarPerfil" id="frmEPerfil">
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label>Nombres</label>
						<input type="text" name="nombre" class="form-control" value="<?php echo $this->datos["USU_NOMBRES"]; ?>">
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label>Fecha de nacimiento</label>
						<input type="date" name="nacimiento" class="form-control" value="<?php echo $this->datos["USU_FCH_NAC"]; ?>">
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label>Correo</label>
						<input type="text" name="correo" class="form-control" value="<?php echo $this->datos["USU_CORREO"]; ?>">
					</div>
				</div>
			</div>
			<input type="submit" name="aceptar" value="Actualizar" class="btn btn-dark">
			<br />
			<?php
			if (isset($this->mensaje)) {
				echo $this->mensaje;
			}
			?>
		</form>
	</div>
</div>