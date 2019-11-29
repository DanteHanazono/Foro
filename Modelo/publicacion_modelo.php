<?php
class publicacion_modelo{

	public function __construct(){}

	public static function mdlCrearPublicacion($datos){
		$bd = new conexion();
		$c = $bd->conectarse();

		$sql = array("PUB_TITULO"  => $datos["titulo"],
		    "PUB_DESCRIPCION"  => $datos["contenido"],
		    "PUB_USU_ID"  => $datos["usu_id"],
		    "PUB_CAT_ID"  => $datos["cat_id"],
		    "PUB_FCH_RGT" => date("Y-m-d H:i:s"));
		$rta = $bd->insertar($c, "t_publicacion", $sql);
		return $rta;
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
	public static function mdlListarPublicaciones($id){
		$bd = new conexion();
		$c = $bd->conectarse();
		$sql = "SELECT * FROM t_publicacion inner join t_usuario on USU_ID = PUB_USU_ID 
		WHERE PUB_CAT_ID =".$id. " ORDER BY PUB_ID DESC";
		$s = $c->prepare($sql);
		$s->execute();
		return $s->fetchAll();
	}

	public static function mdlEliminar($id){
		$bd = new conexion();
		$c = $bd->conectarse();
		$sql = "DELETE FROM t_publicacion WHERE PUB_ID = :id";
		$s = $c->prepare($sql);
		return $s->execute(array("id" => $id));
	}
	public static function mdlEditar($datos){
		$bd = new conexion();
		$c = $bd->conectarse();
		$sql = array("PUB_TITULO"  => $datos["titulo"], "PUB_DESCRIPCION"  => $datos["contenido"]);
		$rta = $bd->actualizar($c, "t_publicacion", $sql, "WHERE PUB_ID = ".$datos["id"]);
		return $rta;
	}
}
