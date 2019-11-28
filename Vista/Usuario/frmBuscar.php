<div class="card">
	<h5 class="card-header bg-dark text-white">Buscar Usuario</h5>
	<div class="card-body">
		<form method="post" action="?controlador=usuario&accion=busquedaUsuario" id="frmBuscar" autocomplete="off">
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label>Nick</label>
						<input type="text" name="nick" id="nick" class="form-control" placeholder="Digite nick de usuario" required onkeydown="return (event.keyCode != 13)" >
					</div>
				</div>
			</form>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div id="resultado"></div>
			</div>
		</div>
	</div>