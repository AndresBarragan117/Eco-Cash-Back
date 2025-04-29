<?php
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "ecocashback";

	// conectar a la base de datos
	$conexion = mysqli_connect($servername, $username, $password, $dbname);

	// verificar la conexión
	if ($conexion->connect_error) {
	    die("Connection failed: " . $conexion->connect_error);
	}
?>