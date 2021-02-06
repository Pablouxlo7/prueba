<?php
	session_start();
	require_once 'includes/connection.php';


// %%%%%%%%%%%%%%      IMPORTANTE      %%%%%%%%%%%%%%%% //
//                                                      //
//      Aqui mandamos a llamar el archivo deseado       //
//                                                      //
// %%%%%%%%%%%%%%      IMPORTANTE      %%%%%%%%%%%%%%%% //
	
switch ($identificador) {
	// Inicio en default

	case 2:
		$title = "Registro de usuario";
		include "includes/includes.php";
		include 'pages/inicio.php';
		break;


	default:
		$title = "Registro de usuario";
		include "includes/includes.php";	
		include 'pages/inicio.php';
		break;
}


mysqli_close($CONEXION);
if (file_exists('error_log')) {
	unlink('error_log');
}

