<?php
class conexion{
	private $con;

	public function __construct() {
		try{
			if ($_SERVER["HTTP_HOST"] == "localhost") {
				$this->con = new PDO("mysql:host=localhost:3306;dbname=bd_foro", "root", "");
			}else{
				$this->con = new PDO("mysql:host=localhost:3306;dbname=bd_foro", "DanteHanazono", "Sae_1010Rhady_0611");
				$this->con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			}
		} catch(Exception $e){
			echo "Error al conectarse:" .$e -> getMessage();
		}
	}

	public function conectarse(){
		if($this ->con instanceof PDO){
			return $this ->con;
		}
	}
	public function actualizar($con, $nombreTabla, $datos, $condicion){
		$campoValor = "";
		foreach ($datos as $clave => $valor) {
			$campoValor .= $clave. "= :".$clave.", ";
		}
		$campoValor = rtrim($campoValor, ", ");
		$sql = "UPDATE $nombreTabla SET $campoValor $condicion";
		$s = $con->prepare($sql);
		foreach ($datos as $clave => $valor) {
			$s->bindValue(":".$clave, $valor);
		}
		$s->execute();
		return $s->rowCount();
	}
	public function insertar($con, $nombreTabla, $datos){
		$nombreCampos = implode(", ", array_keys($datos));
		$valoresCampos = ":".implode(", :", array_keys($datos));
		$sql = "INSERT INTO $nombreTabla ($nombreCampos) VALUES ($valoresCampos)";
		$s = $con->prepare($sql);
		foreach ($datos as $clave => $valor) {
			$s->bindValue(":".$clave, $valor);
		}
		$s->execute();
		return $s->rowCount();
	}
	public function eliminar($con, $nombreTabla, $condicion){
		$sql = "DELETE FROM $nombreTabla $condicion";
		$s = $con->prepare($sql);
		$s->execute();
		return $s->rowCount();
	}
}