<div class="card">
	<h5 class="card-header bg-dark text-white">Administración de Categorías</h5>
	<div class="card-body">
		<h5 class="card-title">Categoría</h5>
		<a class="btn btn-dark" href="?controlador=categoria&accion=frmCrear">Crear categoría</a>

		<?php
		echo "<table class='table table-bordered'>";
		echo "<tr>";
		echo "<th>NOMBRE CATEGORÍA</th>";
		echo "<th></th>";
		echo "<th></th>";
		echo "</tr>";
		foreach ($this->datos as $valor) {
		echo "<tr>";
		echo "<td>".$valor["CAT_NOMBRE"]."</td>";
		echo "<td><a href='?controlador=categoria&accion=frmEditar&id=".$valor['CAT_ID']."'>Editar</a></td>";
		echo "<td><a href='?controlador=categoria&accion=eliminar&id=".$valor['CAT_ID']."' onclick='return confirm(\"¿Está seguro que desea eliminar?\")'>Eliminar</a></td>";
		echo "</tr>";	
		}
		echo "</table>";
		?>
		</div>
</div>
