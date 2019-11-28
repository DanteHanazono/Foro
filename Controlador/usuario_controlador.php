<?php
require_once "Modelo/usuario_modelo.php";
class usuario_controlador{

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
		$this->vista->datos = usuario_modelo::mdlListarUsuarios();
		$this->vista->mostrarPagina("usuario/index");
	}

	public function frmLogin(){
		$this->vista->mostrarPagina("usuario/login");
	}

	public function frmRegistro(){
		$this->vista->mostrarPagina("usuario/registro");
	}
	public function frmPerfil(){
		$this->vista->datos = usuario_modelo::mdlConsultarUsuXID($_SESSION["USU_ID"]);
		$this->vista->mostrarPagina("usuario/perfil");
	}

	public function crearUsuario(){
		extract($_REQUEST);
		if (!isset($_REQUEST["aceptar"])) {
			header("Location: /FORO");
			exit;
		}
		$rta = usuario_modelo::mdlValidarNick($nick);
		if ($rta > 0) {
			$this->vista->mensaje = "Este nick esta registrado";
		}else{	
			$nombre_archivo = $_FILES["foto"]["name"];
			$extension = explode(".", $nombre_archivo);
			$longitud = count($extension);
			$e = $extension[$longitud-1];
			$nombre_archivo = date ("Y_m_d H_i_s")."".$nombre_archivo;
			if (strtolower($e) == "jpg" || strtolower($e) == "gif" || strtolower($e) == "png") {
				$archivo = $_FILES["foto"]["tmp_name"];
				if (move_uploaded_file($archivo, "./Public/imagen/fotos/".$nombre_archivo)) {
					$datos["nombres"]  = $nombres;
					$datos["nick"]     = $nick;
					$datos["foto"]     = $nombre_archivo;
					$datos["password"] = $password;
					$datos["correo"]   = $correo;
					$datos["fecha"]    = $fecha;
					$rta = usuario_modelo::mdlRegUsuario($datos);
					if ($rta > 0) {
						$this->vista->mensaje = "Usuario registrado";
					}else{
						$this->vista->mensaje = "Error al registrar";
					}

				}else{
					$this->vista->mensaje = "Error al subir";
				}
			}else{
				$this->vista->mensaje = "Este tipo de archivo no esta permitido";
			}
		}
		$this->vista->mostrarPagina("usuario/registro");
	}

	public function validarUsuario(){
		extract($_REQUEST);
		$rta = usuario_modelo::mdlValidarUsuario($nick, $password);
		if (count($rta) > 0) {
			$_SESSION["USU_ID"] = $rta["USU_ID"];
			$_SESSION["USU_NOMBRES"] = $rta["USU_NOMBRES"];
			$_SESSION["USU_ROL"] = $rta["USU_ROL"];
			$_SESSION["USU_NICK"] = $rta["USU_NICK"];
			$_SESSION["USU_CORREO"] = $rta["USU_CORREO"];
			$_SESSION["USU_FCH_NAC"] = $rta["USU_FCH_NAC"];
			//header("Location: /FORO");
			$this->vista->mensaje = "Bienvenido";
			$estado = "success";
			if ($_SERVER["HTTP_HOST"] == "localhost") {
				$url = "http://localhost/FORO";
			}else{
				$url = "https://foro.sit.moe/";
			}
			$icono = "";
		}else{
			$this->vista->mensaje = "Verifique usuario o contraseña";
			$estado = "danger";
			$icono = "ti-na";
			$url = "";
		}
		echo json_encode(array("mensaje" => $this->vista->mensaje,
			"estado" => $estado,
			"icono" => $icono,
		    "url" => $url));
	}

	public function cerrar(){
		session_destroy();
		header("Location: /FORO");
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
		$rta = usuario_modelo::mdlEliminar($id);
		header("Location:?controlador=usuario&accion=index");
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
		$this->vista->datos = usuario_modelo::mdlConsultarUsuXID($id);
		$this->vista->mostrarPagina("usuario/editar");
	}
	public function editarUsuario(){
		if (!isset($_REQUEST["aceptar"])) {
			header("Location: /FORO");
		}else{
			extract($_REQUEST);
			$datos["estado"] = $estado;
			$datos["rol"] = $rol;
			$datos["id"] = $id;
			$r = usuario_modelo::mdlEditar($datos);
			header("Location: ?controlador=usuario&accion=index");
		}
	}
	public function frmEditarPerfil(){
		if(isset($_SESSION["USU_ID"])){
			if($_SESSION["USU_ROL"] != 1){
				header("Location: /FORO");
			}
		}else{
			header("Location: /FORO");
		}
		extract($_REQUEST);
		$this->vista->datos = usuario_modelo::
		mdlEditarPerfil($id);
		$this->vista->mostrarPagina("usuario/perfil");
	}
	public function editarPerfil(){
		//if (!isset($_REQUEST["aceptar"])) {
		//	header("Location: /FORO");
		//}else{
			extract($_REQUEST);
			$datos["nombre"] = $nombre;
			$datos["nacimiento"] = $nacimiento;
			$datos["correo"] = $correo;
			$datos["id"] = $_SESSION["USU_ID"];
			$r = usuario_modelo::mdlEditarPerfil($datos);
		//}
		if ($r > 0) {
			$this->vista->mensaje = "Perfil editado exitosamente";
			$estado = "success";
			$icono = "ti-thumb-up";
		}else{	
			$this->vista->mensaje = "Error al editar perfil";
			$estado = "danger";
			$icono = "ti-close";
		}
		echo json_encode(array("mensaje" => $this->vista->mensaje,
			"estado" => $estado,
			"icono" => $icono));
	}
	public function frmBuscar(){
		if(isset($_SESSION["USU_ID"])){
			if($_SESSION["USU_ROL"] != 1){
				header("Location: /FORO");
			}
		}else{
			header("Location: /FORO");
		}
		$this->vista->mostrarPagina("usuario/frmBuscar");
	}
	//la busqueda se realiza por el nick
	public function busquedaUsuario(){
		extract($_REQUEST);
		$r = usuario_modelo::mdlBUsuario($dato);
		$tabla = "";
		$tabla .= "<table class='table table-bordered'>";
		$tabla .= "<tr>";
		$tabla .= "<th>NOMBRE USUARIO</th>";
		$tabla .= "<th>NICK</th>";
		$tabla .= "<th>CORREO</th>";
		$tabla .= "<th>ESTADO</th>";
		$tabla .= "<th>ROL</th>";
		$tabla .= "<th></th>";
		$tabla .= "<th></th>";
		$tabla .= "</tr>";
		foreach ($r as $valor) {
			$estado = ($valor["USU_ESTADO"]==1)?"Activo":"Inactivo";
			$rol = ($valor["USU_ROL"]==1)?"Administrador":"Publicador";
			$tabla .= "<tr>";
			$tabla .= "<td>".$valor["USU_NOMBRES"]."</td>";
			$tabla .= "<td>".$valor["USU_NICK"]."</td>";
			$tabla .= "<td>".$valor["USU_CORREO"]."</td>";
			$tabla .= "<td>".$estado."</td>";
			$tabla .= "<td>".$rol."</td>";

			$tabla .= "<td><a href='?controlador=usuario&accion=frmEditar&id=".$valor['USU_ID']."'>Editar</a></td>";
			$opcion = "";
			if($valor["USU_ROL"] != 1) {
				$opcion = "<a href='?controlador=usuario&accion=eliminar&id=".$valor['USU_ID']."' onclick='return confirm(\"¿Está seguro que desea eliminar?\")'>Eliminar</a>";
			}
			$tabla .= "<td>$opcion</td>";
			$tabla .= "</tr>";	
		}
		$tabla .= "</table>";
		echo json_encode(array("texto"=>$tabla));
	}
}
