<?php
require_once "Modelo/categoria_modelo.php";
class categoria_controlador{

	public function __construct(){
		$this->vista = new vista();
	} 

	public function index(){
		if(isset($_SESSION["USU_ID"])){
			if($_SESSION["USU_ROL"] != 1){
				header("Location: /FORO");
			}
		}else{
			header("Location: /FORO");
		}
		$this->vista->datos = categoria_modelo::mdlListarCategorias();
		$this->vista->mostrarPagina("categoria/index");
	}

	public function frmCrear(){
		if(isset($_SESSION["USU_ID"])){
			if($_SESSION["USU_ROL"] != 1){
				header("Location: /FORO");
			}
		}else{
			header("Location: /FORO");
		}
		$this->vista->mostrarPagina("categoria/crear");
	}

	public function crearCategoria(){
		extract($_REQUEST);
		//if (!isset($_REQUEST["aceptar"])) {
		//	header("Location: /FORO");
		//	exit;
		//}
		$datos["nombre"] = $nombre;
		$rta = categoria_modelo::mdlCrearCategoria($datos);
		if ($rta > 0) {
			$this->vista->mensaje = "Categoría creada";
			$estado = "success";
			$icono = "ti-thumb-up";
		}else{	
			$this->vista->mensaje = "Error al crear";
			$estado = "danger";
			$icono = "ti-close";
		}
		echo json_encode(array("mensaje" => $this->vista->mensaje,
			"estado" => $estado,
			"icono" => $icono));
		//$this->vista->mostrarPagina("categoria/crear");
	}

	public function eliminar(){
		if(isset($_SESSION["USU_ID"])){
			if($_SESSION["USU_ROL"] != 1){
				header("Location: /FORO");
			}
		}else{
			header("Location: /FORO");
		}
		extract($_REQUEST);
		$rta = categoria_modelo::mdlEliminar($id);
		header("Location:?controlador=categoria&accion=index");
	}
	
	public function frmEditar(){
		if(isset($_SESSION["USU_ID"])){
			if($_SESSION["USU_ROL"] != 1){
				header("Location: /FORO");
			}
		}else{
			header("Location: /FORO");
		}
		extract($_REQUEST);
		$this->vista->datos = categoria_modelo::
		mdlConsultarcatXID($id);
		$this->vista->mostrarPagina("categoria/editar");
	}
	public function editarCategoria(){
		//if (!isset($_REQUEST["aceptar"])) {
		//	header("Location: /FORO");
		//}else{
		extract($_REQUEST);
		$datos["nombre"] = $nombre;
		$datos["id"] = $id;
		$r = categoria_modelo::mdlEditar($datos);
		if ($r > 0) {
			$this->vista->mensaje = "Categoría editada exitosamente";
			$estado = "success";
			$icono = "ti-thumb-up";
		}else{	
			$this->vista->mensaje = "Error al editar categoria";
			$estado = "danger";
			$icono = "ti-close";
		}
		echo json_encode(array("mensaje" => $this->vista->mensaje,
			"estado" => $estado,
			"icono" => $icono));
	}
//}
}//fin de la clase