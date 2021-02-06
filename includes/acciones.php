<?php                                    
	session_start();
	include 'connection.php';
	$msjClase = 'danger';
	$msjIcon  = 'warning';
	$msjTxt   = 'Error';
	$estatus  = '';
	$horario  = '';
	$xtras    = '';
	$fallo    = 1;

if(isset($_POST['new-user'])){
	if(isset($_POST['name'])){ $name=strtolower($_POST['name']); }else{ $name=false; $legendFail.="<br><br>Username missing";}
	if(isset($_POST['last_name'])){ $last_name=$_POST['last_name']; }else{ $last_name=false; $legendFail.="<br><br>User last name is missing";}
	
	$job_id=$_POST['job_id'];
	

	$USER = $CONEXION -> query("SELECT * FROM users WHERE name = '$name'");
	$numRows = $USER ->num_rows;
	if ($numRows==0) {

		$sql = "INSERT INTO users (name,last_name,job_id)".
			"VALUES ('$name','$last_name','$job_id')";
		if($insertar = $CONEXION->query($sql))
		{
			$exito='success';
			$legendSuccess.="<br>User added";
		}else{
			$fallo='danger';  
			$legendFail.="<br>User could not be added";
		}
	}else{
		$fallo='danger';  
		$legendFail.="<br>The user is already exist";
	}

	header('Location: ../insertar');
		
}

//    Mostrar mensaje                    
	echo '{ "msj":"<div class=\'uk-text-center color-blanco bg-'.$msjClase.' padding-10 text-lg\'><i uk-icon=\'icon:'.$msjIcon.';ratio:2;\'></i> &nbsp; '.$msjTxt.'</div>", "estatus":"'.$fallo.'", "xtras":"'.$xtras.'" '.$estatus.''.$horario.'}';

//    Cerrar conexión y Borrar Error_log         
	mysqli_close($CONEXION);
	if (file_exists('error_log')) {
		unlink('error_log');
	}
