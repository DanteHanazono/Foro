
<div class="card">
	<h5 class="card-header bg-dark text-white">Categoria 
		<?php echo $this->categoria["CAT_NOMBRE"]; ?>
	</h5>
	<div class="card-body">
		<a href="" type="button" class="btn btn-dark" data-toggle="modal" data-target="#exampleModal">Crear publicacion</a>
		<br/><br/>
		<?php 

		foreach ($this->datos as $valor) {
			echo '<div class="card">
			<div class="card-body">
			<h5 class="card-title"><a href="?controlador=comentario&accion=index&id=' .$valor["PUB_ID"].'">'.utf8_decode($valor["PUB_TITULO"]).'</a></h5>
			<h6 class="card-subtitle mb-2 text-muted">'.$valor["USU_NICK"].'</h6>
			<h6 class="card-subtitle mb-2 text-muted">'.$valor["USU_FCH_RGT"].'</h6>';
			if(isset($_SESSION["USU_ID"])) {
				if($_SESSION["USU_ID"] == $valor["USU_ID"] || $_SESSION["USU_ROL"] == 1){
					echo '<a href="#" class="card-link editar" data-toggle="modal" data-target="#editarmodal"
					data-titulo="' .$valor["PUB_TITULO"].'"
					data-contenido="' .$valor["PUB_DESCRIPCION"].'"
					data-pub_id="' .$valor["PUB_ID"].'"> Editar</a>';
					echo '<a href="?controlador=publicacion&accion=eliminar&id='.$valor["PUB_ID"].'&catID='.$_REQUEST["id"].'" class="card-link")>Eliminar</a>';
				}
			}
			echo '</div>';
			echo '</div><br/>';
			
		}
		//echo "</table>";

		?>
	</div>
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Crear publicacion</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form method="post" action="?controlador=publicacion&accion=CrearPublicacion" id="frmCPublicacion">
					<div class="form-group">
						<label for="recipient-name" class="col-form-label">Titulo</label>
						<input type="text" name="titulo" class="form-control" id="titulo">
					</div>
					<div class="form-group">
						<label for="message-text" class="col-form-label">Contenido</label>
						<textarea class="form-control" name="contenido" id="contenido"></textarea>
					</div>
					<div class="modal-footer">
						<input type="hidden" name="id" value="<?php echo $_REQUEST["id"]; ?>">
						<button type="button" name="aceptar"class="btn btn-danger" data-dismiss="modal">Cancelar</button>
						<button type="submit" class="btn btn-success">Publicar</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="editarmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Editar publicacion</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form method="post" action="?controlador=publicacion&accion=EditarPublicacion" id="frmEPublicacion">
					<div class="form-group">
						<label for="recipient-name" class="col-form-label">Titulo</label>
						<input type="text" name="titulo1" class="form-control" id="titulo1">
					</div>
					<div class="form-group">
						<label for="message-text" class="col-form-label">Contenido</label>
						<textarea class="form-control" name="contenido1" id="contenido1"></textarea>
					</div>
					<div class="modal-footer">
						<input type="hidden" name="id1" value="<?php echo $_REQUEST["id"]; ?>">
						<input type="hidden" name="pub_id" id="pub_id">
						<button type="button" name="aceptar"class="btn btn-danger" data-dismiss="modal">Cancelar</button>
						<button type="submit" class="btn btn-success">Publicar</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
