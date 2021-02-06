<?php 
/* %%%%%%%%%%%%%%%%% CONFIGURACIÓN   */
	$logo 			= 'img/design/logo.png';
	$mailBGcolor 	= '#DDD';
	$mailButton 	= '#ff8b00';
	$uikitVersion	= '3.5.5';
	$languaje		= 'es';

	$database 		= '';
	$username 		= '';
	$password		= '';

	/* Cambiar estos datos por los accesos a tu base de datos si estas en localhost*/


	$databaseLocal 	= 'prueba';
	$usernameLocal 	= 'root';
	$passwordLocal 	= 'root';

	/* /Cambiar estos datos por los accesos a tu base de datos si estas en localhost*/



	/* Cambiar estos datos por los accesos a tu base de datos si esta en un servidor*/

	$previewDomain  = 'eshot.mx';
	$databasePreview= 'eshotmx_';
	$usernamePreview= 'eshotmx_eshotmx';
	$passwordPreview= '1WnXgx$Y$N4&';

	/* /Cambiar estos datos por los accesos a tu base de datos si esta en un servidor*/


/* %%%%%%%%%%%%%%%%% OTRAS VARIABLES   */
	global $ruta;
	global $rutaEstaPagina;
	global $CONEXION;
    global $uid;
	global $caracteres_si_validos;
	global $caracteres_no_validos;
	global $linkToShare;
	global $es_movil;


	$caracteres_si_validos  = array('',' ','','','','','','','','','a','A','e','E','i','I','o','O','u','U','n','N');
	$caracteres_no_validos  = array('%','  ',',','_','|','/','®','¿','"',':','á','Á','é','É','í','Í','ó','Ó','ú','Ú','ñ','Ñ');
	$noPic='img/design/camara.jpg';

	$mensajeClase='';
	$mensajes='';
	$mensaje='';

	$legendSuccess='';
	$legendFail='';
	$scripts='';
	
	date_default_timezone_set('America/Mexico_City');
	$hoy=date('Y-m-d');
	$ahora=date('Y-m-d H:i:s');

	$dominio=str_replace('www.', '', $_SERVER["SERVER_NAME"]);
	$ip=substr($dominio,0,-2);
	$debug=($dominio=='localhost')?1:0;
	$protocolo=($debug==1)?'http://':'https://';
	$raiz=$protocolo.$dominio;
	$urlSufijo=$_SERVER["REQUEST_URI"];
	$slash=(strrpos($urlSufijo,'/'))+1;
	$ruta=$raiz.substr($urlSufijo,0,$slash);
	$ruta = (str_replace('admin/', '', $ruta));
	$ruta = (str_replace('includes/', '', $ruta));
	$rutaEstaPagina=$raiz.$_SERVER["REQUEST_URI"];
	$linkToShare=str_replace('+', '%2B', $rutaEstaPagina);
	$linkToShare=str_replace(':', '%3A', $linkToShare);
	$logo=$ruta.$logo;

	$hostname = 'localhost';
	if($dominio=='localhost' or $ip=='192.168.100'){
		$database 	= $databaseLocal;
		$username 	= $usernameLocal;
		$password 	= $passwordLocal;
	}elseif($dominio==$previewDomain){
		$database 	= $databasePreview;
		$username 	= $usernamePreview;
		$password 	= $passwordPreview;
	}


	$CONEXION = mysqli_init();
	mysqli_real_connect($CONEXION, $hostname, $username, $password, $database) or die("Error: " . mysqli_connect_error($CONEXION)); 
	mysqli_set_charset($CONEXION,'utf8');

	mysqli_free_result($CONSULTA);
	unset($row_CONSULTA);

/* %%%%%%%%%%%%%%%%%%%% MÓVIL O ESCRITORIO     */
	// Detectamos si es móvil o escritorio
	$navegadorUser = $_SERVER['HTTP_USER_AGENT'];		// Info del navegador
	// Lista de navegadores móviles
	$navegadores_moviles = "Android, AvantGo, Blackberry, Blazer, Cellphone, Danger, DoCoMo, EPOC, EudoraWeb, Handspring, HTC, Kyocera, LG, MMEF20, MMP, MOT-V, Mot, Motorola, NetFront, Newt, Nokia, Opera Mini, Palm, Palm, PalmOS, PlayStation Portable, ProxiNet, Proxinet, SHARP-TQ-GX10, Samsung, Small, Smartphone, SonyEricsson, SonyEricsson, Symbian, SymbianOS, TS21i-10, UP.Browser, UP.Link, WAP, webOS, Windows CE, hiptop, iPhone, iPod, portalmmm, Elaine, OPWV";
	// Almacenar como array
	$navegadores_moviles_array = explode(',',$navegadores_moviles);
	// Ciclo comparativo
	$es_movil=FALSE;
	foreach($navegadores_moviles_array AS $navegadorList){
		if ($es_movil===FALSE) {
			$es_movil=(preg_match("/".trim($navegadorList)."/i",$navegadorUser))?TRUE:FALSE;
		}
	}

	$socialWhats = ($es_movil===FALSE) ? 'https://web.whatsapp.com/521'.$telefono1.'?text=Me%20gustaría%20saber%20...':$socialWhats;

/* %%%%%%%%%%%%%%%%%%%% Explorer < 8           */
	if(preg_match('/(?i)msie [1-8]/',$navegadorUser)){
		$mensaje='Este sitio está diseñado para navegadores modernos.<br>Vuelva a visitarnos desde Google Chrome, Firefox o su Dispositivo Movil.';
		$mensajeClase='danger';
	}

