<?php
class inicio_modelo{

	public function __construct(){}

	public static function mdlListarCategorias(){
		$bd = new conexion();
		$c = $bd->conectarse();
		$sql = "SELECT * FROM t_categoria";
		$s = $c->prepare($sql);
		$s->execute();
		return $s->fetchAll();
	}
	
}