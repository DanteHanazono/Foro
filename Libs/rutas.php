<?php
class rutas{
	public function cargarContenido($nombreControlador, $nombreAccion) {
		$nombreArchivo = $nombreControlador."_controlador";
		if (file_exists("Controlador/".$nombreArchivo.".php")) {
			require_once "Controlador/".$nombreArchivo.".php";
			$obj = new $nombreArchivo();
			if (method_exists($obj, $nombreAccion)) {
				$obj->$nombreAccion();
			} else {
				echo "funcion/ metodo/ accion no definida";
			}

		} else {
			header("location: /FORO");
		}
	}
}
