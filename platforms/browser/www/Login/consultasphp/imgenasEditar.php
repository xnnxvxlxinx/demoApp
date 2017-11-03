<?php
include "../../archivosbase/conexion.php";
	$conexion = new mysqli($host_db, $user_db, $pass_db, $db_name);
	if ($conexion->connect_error) {
	 die("La conexion falló: " . $conexion->connect_error);
	}
	$datos=array();
	
	if(isset($_GET['Usuario']) && $_GET['Usuario']!=''){
		if(isset($_GET['ID']) && $_GET['ID']!=''){
	$consultaproducto="SELECT * FROM PRODUCTOS WHERE ID_Usuario='$_GET[Usuario]' AND ID='$_GET[ID]'";
	$resultprin = $conexion->query($consultaproducto);
	while ($fila = $resultprin->fetch_row()){
		$sql = "SELECT * FROM FotoProductos WHERE ID_Producto = '$fila[0]'";
		$result = $conexion->query($sql);
		$imagen=array();
		while ($fila2 = $result->fetch_row()){
			$imagen[]=$fila2[3];
		}
		$datos[]=array('ID'=>$fila[0],
			'ID_Usuario'=>$fila[1],
			'Titulo'=>$fila[4],
			'Descri'=>utf8_encode($fila[5]),
			'Precio'=>$fila[6],
			'Tagprincipal'=>$fila[2],
			'TagSecundario'=>$fila[3],
			'Imagen'=>$imagen
			);	
			
	}
	}else{
		$error='ERROR ID';
		$datos[]=array('ID'=>$error);
	}
	}else{
		$error='Su sesión expiró';
		$datos[]=array('ID'=>$error);
	}
	echo "".json_encode($datos)."";
	mysqli_close($conexion);
	header("Content-type: application/json");
	header("Access-Control-Allow-Origin: *");
?>