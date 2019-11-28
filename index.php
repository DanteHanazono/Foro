<?php
session_start();
require_once "Libs/conexion.php";
require_once "Libs/rutas.php";
require_once "Libs/vista.php";
date_default_timezone_set("America/bogota");
if (isset($_GET['controlador']) && isset($_GET['accion'])) {
	$nombreControlador = $_GET['controlador'];
	$nombreAccion      = $_GET['accion'];
} else {
	$nombreControlador = "inicio";
	$nombreAccion      = "index";
}
rutas::cargarContenido($nombreControlador, $nombreAccion);

