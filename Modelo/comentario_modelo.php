<?php
class comentario_modelo{

	public function __construct(){}

	public static function mdlBuscarPubXID($id){
		$bd = new conexion();
		$c = $bd->conectarse();
		$sql = "SELECT * FROM t_publicacion INNER JOIN t_usuario on USU_ID = PUB_USU_ID WHERE PUB_ID = :id";
		$s = $c->prepare($sql);
		$s->execute(array("id" => $id));
		if($s->rowCount() > 0){
			return $s->fetch();
		} else {
			return array();
		}
	}

	public static function mdlBuscarComentarioXPudID($id){
		$bd = new conexion();
		$c = $bd->conectarse();
		$sql = "SELECT * FROM t_comentario INNER JOIN t_usuario on USU_ID = COM_USU_ID WHERE COM_PUB_ID = :id";
		$s = $c->prepare($sql);
		$s->execute(array("id" => $id));
		if($s->rowCount() > 0){
			return $s->fetchAll();
		} else {
			return array();
		}
	}

	public static function mdlCrearComentario($datos){
		$bd = new conexion();
		$c = $bd->conectarse();
		$sql = array("COM_DESCRIPCION"  => $datos["contenido"],
		    "COM_USU_ID"  => $datos["usu_id"],
		    "COM_PUB_ID"  => $datos["pub_id"],
		    "COM_FCH_RGT" => $datos["fecha"]);
		$rta = $bd->insertar($c, "t_comentario", $sql);
		return $rta;
	}
}