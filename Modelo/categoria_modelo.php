<?php
class categoria_modelo{

	public function __construct(){}

	public static function mdlCrearCategoria($datos){
		$bd = new conexion();
		$c = $bd->conectarse();
		$sql = array("CAT_NOMBRE"  => $datos["nombre"],
			"CAT_FCH_RGT" => date("Y-m-d H:i:s"));
		$rta = $bd->insertar($c, "t_categoria", $sql);
		return $rta;
	}

	public static function mdlListarCategorias(){
		$bd = new conexion();
		$c = $bd->conectarse();
		$sql = "SELECT * FROM t_categoria";
		$s = $c->prepare($sql);
		$s->execute();
		return $s->fetchAll();
	}

	public static function mdlEliminar($id){
		$bd = new conexion();
		$c = $bd->conectarse();
		$sql = "DELETE FROM t_categoria WHERE CAT_ID = :id";
		$s = $c->prepare($sql);
		return $s->execute(array("id" => $id));
	}

	public static function mdlConsultarcatXID($id){
		$bd = new conexion();
		$c = $bd->conectarse();
		$sql = "SELECT * FROM t_categoria WHERE CAT_ID = :id";
		$s = $c->prepare($sql);
		$s->execute(array("id" => $id));
		if($s->rowCount() > 0){
			return $s->fetch();
		} else {
			return array();
		}
	}
	
	public static function mdlEditar($datos){
		$bd = new conexion();
		$c = $bd->conectarse();
		$sql = array("CAT_NOMBRE"  => $datos["nombre"]);

		$rta = $bd->actualizar($c, "t_categoria", $sql, "WHERE CAT_ID = ".$datos["id"]);
		return $rta;
	}
}