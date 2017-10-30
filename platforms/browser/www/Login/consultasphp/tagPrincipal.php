<?php
include "../../archivosbase/conexion.php";
	$conexion = new mysqli($host_db, $user_db, $pass_db, $db_name);
	if ($conexion->connect_error) {
	 die("La conexion fall?: " . $conexion->connect_error);
	}
	$concultaTag="SELECT * FROM ImgTagPrincipal";
			$result = $conexion->query($concultaTag);
			$txto="";
			while ($fila = $result->fetch_row()){
				$txto=$txto."<img src='../$fila[1]' onclick='linkimgtags(this)'/>";
			}
			echo "$txto";
?>