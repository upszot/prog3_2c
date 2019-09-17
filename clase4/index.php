<?php 


$metodo=$_SERVER["REQUEST_METHOD"];
switch ($metodo) {
	case 'GET':
		# traer datos
		echo "por get";
		break;
	case 'POST':
		# 			
		// var_dump($_FILES);
		 $tmp=$_FILES["archivo"]["tmp_name"];		
		$tipoArchivo = pathinfo($_FILES["archivo"]["name"], PATHINFO_EXTENSION);		
		move_uploaded_file($tmp,"./archivos/foto2.$tipoArchivo");		
		var_dump($tipoArchivo);
		break;	
}

?>