$(function(){

	$("#frmCCat").submit(function(){
		var url = $(this).attr("action");
		var datos = $(this).serialize();

		$.post(url, datos, function(e){

			$.notify({
				icon: e.icono,
				message: e.mensaje 
			},{
				type: e.estado 
			}); 
			$("#nombre").val("");
		},"json");

		return false;
	});

	$("#frmECat").submit(function(){
		var url = $(this).attr("action");
		var datos = $(this).serialize();

		$.post(url, datos, function(e){

			$.notify({
				icon: e.icono,
				message: e.mensaje 
			},{
				type: e.estado 
			}); 
		},"json");

		return false;
	});

	$("#frmLogin").submit(function(){
		var url = $(this).attr("action");
		var datos = $(this).serialize();

		$.post(url, datos, function(e){
			if (e.estado == "danger") {
				$.notify({
					icon: e.icono,
					message: e.mensaje 
				},{
					type: e.estado 
				}); 
			}else{
				window.location= e.url;
			}
		},"json");

		return false;
	});

	$("#frmCPublicacion").submit(function(){
		var url = $(this).attr("action");
		var datos = $(this).serialize();

		$.post(url, datos, function(e){
			$('#exampleModal').modal('toggle');
			$.notify({
				icon: e.icono,
				message: e.mensaje 
			},{
				type: e.estado 
			});
			if (e.estado == "success") {
				setTimeout("document.location.reload()", 3000);
			}
		},"json");

		return false;

	});

	$("#frmEPerfil").submit(function(){
		var url = $(this).attr("action");
		var datos = $(this).serialize();

		$.post(url, datos, function(e){

			$.notify({
				icon: e.icono,
				message: e.mensaje 
			},{
				type: e.estado 
			}); 
		},"json");

		return false;
	});
	$("#nick").keyup(function(){
		var dato = $("#nick").val();
		if (dato != "") {
			var url = $("#frmBuscar").attr("action");
			dato = "dato="+dato;
			$.post(url,dato, function(e){
				$("#resultado").html(e.texto);
			},"json");
		}else{
			$("#resultado").html("");
		}
		return false;
	});

	$("#frmCComentario").submit(function(){
		var url = $(this).attr("action");
		var datos = $(this).serialize();
		$.post(url, datos, function(e){
			$('#exampleModal').modal('toggle');
			$.notify({
				icon: e.icono,
				message: e.mensaje 
			},{
				type: e.estado 
			});
			if (e.estado == "success") {
				setTimeout("document.location.reload()", 3000);
			}
		},"json");
		return false;
	});

	$(".editar").click(function(){
		var titulo = $(this).attr("data-titulo");
		var contenido = $(this).attr("data-contenido");
		var pub_id = $(this).attr("data-pub_id");
		$("#titulo1").val(titulo);
		$("#contenido1").val(contenido);
		$("#pub_id").val(pub_id);
	});
});