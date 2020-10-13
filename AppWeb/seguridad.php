<?php
//AUTORIZACION PARA WEBSITE DEL USUARIO
require("rintera-config.php");

session_name($SesionName);
session_start();	
// echo "id: ".session_id();
// echo "error: ".$_SESSION['RinteraUser'];

// if (isset($_SESSION['RinteraUser']) <> ''){
// 	echo "Hay Session";
// } else {
// 	echo "NO Hay Session";
// }


if (isset($_SESSION['RinteraUser'])){


	//SENTINELA DE SESSION
	$IdSession = session_id();
	if (SESSION_Validate($IdSession) == TRUE) { //<-- Si la session esta abierta

		//actualizar el id de session
		$id_sesion_antigua = session_id(); //<-- guardamos el id session actual
		$RinteraUser = $_SESSION['RinteraUser']; //<-- Guardamos al usuario actual
		$RinteraUserName = $_SESSION['RinteraUserName'];
		
		
		session_regenerate_id();$id_sesion_nueva = session_id(); //<-- regneramos el id de session		
		$_SESSION['RinteraUser'] = $RinteraUser; //<- Pasamos los valores a la nueva session

		SESSION_closeRegenerate($id_sesion_antigua); //<-- Cerramos la sessión actual
		SESSION_initRegenerate($id_sesion_nueva, $RinteraUser, $SesionName, URLActual(), ""); //<-- guardamos la nueva session


		//De esta manera la proxima vez que entren a un link detectara si esta activa la session, y si esta activa
		// la regenera
		

	} else {
		$_SESSION = array(); 
		session_destroy();		
		unset($RinteraUser);
		header("location:login.php?info=Sesion Expirada");	
	}




					
}
else

{	
	
	$_SESSION = array(); session_destroy();		   
	unset($IdUser);
	if (isset($_GET['IdUser'])){
        $IdUser = VarClean($_GET['IdUser']);
    } else {$IdUser = "";}
    if (isset($_GET['id'])){
        $id_rep = VarClean($_GET['id']);
	} else {$id_rep = "";}
	
	$url = "";
	if ($IdUser <> '') {
		$url.="IdUser=".$IdUser;
	}

	if ($id_rep <> '') {
		$url.="&id_rep=".$id_rep;
	}
	if ($url <> '' ){
		header("location:login.php?".$url);		
	} else {
		header("location:login.php");		
	}
	
	
}




















function LogOut(){
	$_SESSION = array(); session_destroy();		   
	unset($IdUser);
	header("location:login.php");		

}


function SESSION_Validate($id){ // solo existe en seguridad
	require("rintera-config.php");    
    $sql = "select  count(*) as n  from sessiones 
	where id='".$id."' and cierre_fecha = '0000-00-00'" ;
	// echo $sql;
	// echo "<script>console.log(".$sql.");</script>";
    $r= $db0 -> query($sql); if($f = $r -> fetch_array()){
			if ($f['n']==0)	{
				return FALSE;
			} else {
				return TRUE; //<-- Sesion abierta
			}
		
    }else{
            return FALSE;
    }
        

}



function SESSION_initRegenerate($id, $user, $session_name, $session_comentario){
	require("rintera-config.php");	
	$sql = "INSERT INTO sessiones (id, session_name,  usuario, fecha, hora, comentarios) 
	VALUES ('".$id."', '".$session_name."', '".$user."', '".$fecha."', '".$hora."', '".$session_comentario."')";
	// echo $sql;
	// mensaje($sql,'login.php');
		if ($db0->query($sql) == TRUE)
			{return TRUE;}
		else {return FALSE;}
		
}


function url_origin($s, $use_forwarded_host=false) {

	$ssl = ( ! empty($s['HTTPS']) && $s['HTTPS'] == 'on' ) ? true:false;
	$sp = strtolower( $s['SERVER_PROTOCOL'] );
	$protocol = substr( $sp, 0, strpos( $sp, '/'  )) . ( ( $ssl ) ? 's' : '' );
  
	$port = $s['SERVER_PORT'];
	$port = ( ( ! $ssl && $port == '80' ) || ( $ssl && $port=='443' ) ) ? '' : ':' . $port;
	
	$host = ( $use_forwarded_host && isset( $s['HTTP_X_FORWARDED_HOST'] ) ) ? $s['HTTP_X_FORWARDED_HOST'] : ( isset( $s['HTTP_HOST'] ) ? $s['HTTP_HOST'] : null );
	$host = isset( $host ) ? $host : $s['SERVER_NAME'] . $port;
  
	return $protocol . '://' . $host;
  
  }
  
  function full_url( $s, $use_forwarded_host=false ) {
	return url_origin( $s, $use_forwarded_host ) . $s['REQUEST_URI'];
  }
  
  function URLActual(){
	  $absolute_url = full_url( $_SERVER );
	  return $absolute_url;
  }
  

function SESSION_closeRegenerate($id){
require("rintera-config.php");
	
	$sql="UPDATE sessiones  SET cierre_fecha='".$fecha."', cierre_hora='".$hora."'  WHERE id='".$id."'";
	// //echo $sql;
	if ($db0->query($sql) == TRUE)
		{return TRUE;}
	else {return FALSE;}
}

// ob_end_clean();

?>