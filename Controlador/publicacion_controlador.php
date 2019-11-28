<?php
require_once "Modelo/publicacion_modelo.php";
class publicacion_controlador{

	public function __construct(){
		$this->vista = new vista();
	} 
	public function index(){
		extract($_REQUEST);
		$this->vista->categoria = publicacion_modelo::mdlConsultarcatXID($id);
		$this->vista->datos = publicacion_modelo::mdlListarPublicaciones($id);
		$this->vista->mostrarPagina("Publicacion/index");
	}
	public function CrearPublicacion(){
		extract($_REQUEST);
		$datos["titulo"] = $titulo;
		$datos["contenido"] = $contenido;
		$datos["cat_id"] = $id;
		$datos["usu_id"] = $_SESSION["USU_ID"];
		$datos["fecha"] = date("Y-m-d H:i:s");
		$r = publicacion_modelo::mdlCrearPublicacion($datos);
		if ($r > 0) {
			$this->vista->mensaje = "Publicacion creada";
			$estado = "success";
			$icono = "ti-thumb-up";
		}else{	
			$this->vista->mensaje = "Error al publicar";
			$estado = "danger";
			$icono = "ti-close";
		}
		echo json_encode(array("mensaje" => $this->vista->mensaje,
			"estado" => $estado,
			"icono" => $icono));

	}

	public function eliminar(){
		if(isset($_SESSION["USU_ID"])){
			extract($_REQUEST);
			$rta = publicacion_modelo::mdlEliminar($id);
			header("Location:?controlador=publicacion&accion=index&id=".$catID);
		}else{
			header("Location: /");
		}
		extract($_REQUEST);
		
	}

}
