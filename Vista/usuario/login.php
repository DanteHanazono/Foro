<div class="card">
	<h5 class="card-header">Inicio de sesión</h5>
	<div class="card-body">
		<form method="post" action="?controlador=usuario&accion=validarUsuario" id="frmLogin">
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label>Nickname</label>
						<input type="text" name="nick" class="form-control" required>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label>Password</label>
						<input type="password" name="password" class="form-control" required>
					</div>
				</div>
			</div>
			<input type="submit" name="aceptar" value="Iniciar" class="btn btn-success">
			<br />
			<?php
			if (isset($this->mensaje)) {
				echo $this->mensaje;
			}
			?>
		</form>
	</div>
</div>