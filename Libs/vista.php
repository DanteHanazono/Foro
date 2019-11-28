<?php
class vista{

	public function __construct(){}

	public function mostrarPagina($contenido, $estructuraCompleta = true) {
		if ($estructuraCompleta == true) {
			require_once "Vista/header.php";
			require_once "Vista/".$contenido.".php";
			require_once "Vista/footer.php";
		} else {
			require_once "Vista/".$contenido.".php";
		}
	}
}