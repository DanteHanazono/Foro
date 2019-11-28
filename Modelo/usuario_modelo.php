<?php
class usuario_modelo{

	public function __construct(){}

	public function mdlRegUsuario($datos){
		$bd = new conexion();
		$c = $bd->conectarse();
		$sql = array("USU_NOMBRES" => $datos["nombres"],
			"USU_NICK"    => $datos["nick"],
			"USU_FOTO"	   => $datos["foto"],
			"USU_CORREO"  => $datos["correo"],
			"USU_PASS"    => sha1($datos["password"]),
			"USU_FCH_NAC" => $datos["fecha"],
			"USU_ESTADO"  => 1,
			"USU_ROL"     => 2,
			"USU_FCH_RGT" => date("Y_m_d H_i_s"));
		$rta = $bd->insertar($c, "t_usuario", $sql);
		return $rta;
	}

	public function mdlValidarNick($nick){
		$bd = new conexion();
		$c = $bd->conectarse();
		$sql = "SELECT * FROM t_usuario WHERE USU_NICK = :USU_NICK";
		$s = $c->prepare($sql);
		$s->execute(array("USU_NICK" => $nick));
		return $s->rowCount();
	}

	public function mdlValidarUsuario($nick, $password){
		$bd = new conexion();
		$c = $bd->conectarse();
		$sql = "SELECT * FROM t_usuario WHERE USU_NICK = :USU_NICK AND USU_PASS = :USU_PASS";
		$s = $c->prepare($sql);
		$s->execute(array("USU_NICK" => $nick, "USU_PASS" => sha1($password)));
		if ($s->rowCount() > 0){
			return $s->fetch();
		}else{
			return array(); 
		}
	}	

	public static function mdlListarUsuarios(){
		$bd = new conexion();
		$c = $bd->conectarse();
		$sql = "SELECT * FROM t_usuario";
		$s = $c->prepare($sql);
		$s->execute();
		return $s->fetchAll();
	}

	public static function mdlEliminar($id){
		$bd = new conexion();
		$c = $bd->conectarse();
		$sql = "DELETE FROM t_usuario WHERE USU_ID = :id AND USU_ROL != 1";
		$s = $c->prepare($sql);
		return $s->execute(array("id" => $id));
	}
	public static function mdlConsultarUsuXID($id){
		$bd = new conexion();
		$c = $bd->conectarse();
		$sql = "SELECT * FROM t_usuario WHERE USU_ID = :id";
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
		$sql = array("USU_ESTADO"  => $datos["estado"],
						"USU_ROL"  => $datos["rol"]);

		$rta = $bd->actualizar($c, "t_usuario", $sql, "WHERE USU_ID = ".$datos["id"]);
		return $rta;
	}
	public static function mdlEditarPerfil($datos){
		$bd = new conexion();
		$c = $bd->conectarse();
		$sql = array("USU_NOMBRES"  => $datos["nombre"],
						"USU_FCH_NAC"  => $datos["nacimiento"],
							"USU_CORREO"  => $datos["correo"]);

		$rta = $bd->actualizar($c, "t_usuario", $sql, "WHERE USU_ID = ".$datos["id"]);
		return $rta;
	}
	public static function mdlBUsuario($dato){
		$bd = new conexion();
		$c = $bd->conectarse();
		$sql = "SELECT * FROM t_usuario WHERE USU_NICK LIKE '".$dato."%'";
		$s = $c->prepare($sql);
		$s->execute(array("nick" => $dato));
		
			return $s->fetchAll();
	}
}