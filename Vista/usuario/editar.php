<div class="card">
	<h5 class="card-header bg-dark text-white">Editar usuarios</h5>
	<div class="card-body">
		<form method="post" action="?controlador=usuario&accion=editarUsuario">
			<div class="row">
				<div class="input-group input-group-sm mb-1 col-md-6">
					<div class="input-group-prepend">
						<span class="input-group-text" id="inputGroup-sizing-sm">Nombre usuario</span>
					</div>
					<input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" value="<?php echo $this->datos["USU_NOMBRES"]; ?>"  disabled>
				</div>
				<div class="input-group input-group-sm mb-1 col-md-6">
					<div class="input-group-prepend">
						<span class="input-group-text" id="inputGroup-sizing-sm">Nick usuario</span>
					</div>
					<input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" value="<?php echo $this->datos["USU_NICK"]; ?>"  disabled>
				</div>
			</div>
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label>Estado</label>
						<select name="estado" class="form-control">
							<option value="1" <?php if ($this->datos["USU_ESTADO"]== 1){
								echo "selected";
							} 
							?>>Activo</option>
							<option value="2" <?php if ($this->datos["USU_ESTADO"]== 2){
								echo "selected";
							} 
							?>>Inactivo</option>
						</select>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label>Rol</label>
						<select name="rol" class="form-control">
							<option value="1" <?php if ($this->datos["USU_ROL"]== 1){
								echo "selected";
							} 
							?> > Administrador </option>
							<option value="2" <?php if ($this->datos["USU_ROL"]== 2) {
								echo "selected";
							}
							?>>Publicador</option>
						</select>
					</div>
				</div>
			</div>
			<input type="submit" name="aceptar" value="Editar" class="btn btn-dark">
			<input type="hidden" name="id" value="<?php echo $this->datos["USU_ID"]; ?>">
			<br />
			<?php
			if (isset($this->mensaje)) {
				echo $this->mensaje;
			}
			?>
		</form>
	</div>
</div>