
<div class="card">
	<h5 class="card-header bg-dark text-white">Comentarios 
	</h5>
	<div class="card-body">
		<?php  
		if (isset($_SESSION["USU_ID"])){?>
			<a href="" type="button" class="btn btn-dark" data-toggle="modal" data-target="#exampleModal">Crear comentario</a>
			<br/><br/>
			<div class="card">
				<div class="card-body">
					<h5 class="card-title">
						<?php echo strtoupper(utf8_encode($this->r["PUB_TITULO"])); ?>
					</h5>
					<h6 class="card-subtitle mb-2 text-muted"><?php echo $this->r["USU_NICK"]; ?>
				</h6>
				<h6 class="card-subtitle mb-2 text-muted"> <?php echo $this->r["PUB_FCH_RGT"];?>
			</h6>
			<p><?php echo utf8_encode($this->r["PUB_DESCRIPCION"]); ?></p>
		</div>
	<?php } ?>
</div>
</div>
<br/><br/>
<?php 

foreach ($this->comentarios as $valor) {
	echo '<div class="row">
	<div class="col-md-10">

	<div class="card">
	<div class="card-body">

	<h5 class="card-title">'.utf8_decode($valor["COM_DESCRIPCION"]).'</a></h5>

	<h6 class="card-subtitle mb-2 text-muted">'.$valor["USU_NICK"].'</h6>
	<h6 class="card-subtitle mb-2 text-muted">'.$valor["COM_FCH_RGT"].'</h6>';
	echo '</div></div>';
	echo '<br/><br/>';
}
	?>
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Crear cometario
					</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form method="post" action="?controlador=comentario&accion=CrearComentario" id="frmCComentario">
						<div class="form-group">
							<label for="message-text" class="col-form-label">Comentario</label>
							<textarea class="form-control" name="contenido" id="contenido" required=""></textarea>
						</div>
						<div class="modal-footer">
							<input type="hidden" name="id" value="<?php echo $_REQUEST["id"]; ?>">
							<button type="button" name="aceptar"class="btn btn-danger" data-dismiss="modal">Cancelar</button>
							<button type="submit" class="btn btn-success">Comentar</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
