<div class="card">
	<h5 class="card-header bg-dark text-white">Usuario</h5>
	<div class="card-body">
		<h5 class="card-title">Información del usuario</h5>
		<p class="card-text">Aquí se crea o edita la información del usuario</p>

		<?php
		echo "<table class='table table-bordered'>";
		echo "<tr>";
		echo "<th>NOMBRE USUARIO</th>";
		echo "<th>NICK</th>";
		echo "<th>CORREO</th>";
		echo "<th>ESTADO</th>";
		echo "<th>ROL</th>";
		echo "<th></th>";
		echo "<th></th>";
		echo "</tr>";
		foreach ($this->datos as $valor) {
			$estado = ($valor["USU_ESTADO"]==1)?"Activo":"Inactivo";
			$rol = ($valor["USU_ROL"]==1)?"Administrador":"Publicador";
			echo "<tr>";
			echo "<td>".$valor["USU_NOMBRES"]."</td>";
			echo "<td>".$valor["USU_NICK"]."</td>";
			echo "<td>".$valor["USU_CORREO"]."</td>";
			echo "<td>".$estado."</td>";
			echo "<td>".$rol."</td>";

			echo "<td><a href='?controlador=usuario&accion=frmEditar&id=".$valor['USU_ID']."'>Editar</a></td>";
			$opcion = "";
			if($valor["USU_ROL"] != 1) {
				$opcion = "<a href='?controlador=usuario&accion=eliminar&id=".$valor['USU_ID']."' onclick='return confirm(\"¿Está seguro que desea eliminar?\")'>Eliminar</a>";
			}
			echo "<td>$opcion</td>";
			echo "</tr>";	
		}
		echo "</table>";
		?>

	</div>
</div>