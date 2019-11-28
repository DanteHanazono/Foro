<?php
require_once "Modelo/comentario_modelo.php";
class comentario_controlador{

	public function __construct(){
		$this->vista = new vista();
	} 
	public function index(){
		extract($_REQUEST);
		$this->vista->r = comentario_modelo::mdlBuscarPubXID($id);
		$this->vista->comentarios = comentario_modelo::mdlBuscarComentarioXPudID($id);
		$this->vista->mostrarPagina("Comentario/index");
	}

	public function CrearComentario(){
		extract($_REQUEST);
		$datos["contenido"] = $contenido;
		$datos["usu_id"] = $_SESSION["USU_ID"];
		$datos["pub_id"] = $id;
		$datos["fecha"] = date("Y-m-d H:i:s");
		$r = comentario_modelo::mdlCrearComentario($datos);
		if ($r > 0) {
			$this->vista->mensaje = "Comentario creada";
			$estado = "success";
			$icono = "ti-thumb-up";
		}else{	
			$this->vista->mensaje = "Error al comentar";
			$estado = "danger";
			$icono = "ti-close";
		}
		echo json_encode(array("mensaje" => $this->vista->mensaje,
			"estado" => $estado,
			"icono" => $icono));

	}
}