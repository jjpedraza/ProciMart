<?php
function IdTransaccion(){
    $UltimoMov = Transaccion_UltimoMov();
    $SiguienteMov = 0;
    $IdTransaccion = "";
    $AnioActual = date("Y");
    $MesActual = date("d");

    if ($UltimoMov == 0){//agregamos un nuevo registro
        $SiguienteMov = 1;
        Transaccion_Insert();
    } else { //Actualizamos
        $SiguienteMov = $UltimoMov + 1;
        Transaccion_Actualizar();
    }
    
    $IdTransaccion = $AnioActual.$MesActual.str_pad($SiguienteMov, 4, '0', STR_PAD_LEFT);
    return $IdTransaccion ;
    // $SiguienteMov4zero =  str_pad($SiguienteMov, 4, '0', STR_PAD_LEFT);

}


function Transaccion_UltimoMov(){
    require("rintera-config.php");
    $sql = "
	select 
	case when (select count(*) from ControlDeTransacciones a WHERE Año = year(getdate()) AND mes = MONTH(getdate())) = 1 then 
			(select Movimiento from ControlDeTransacciones a WHERE Año = year(getdate()) AND mes = MONTH(getdate()))
			
	else 
		0
	end as UltimoMov;
    
    ";
    // echo "<hr>".$sql;
    $url = $url_;
    
    $token = $token_;
    //Peticion
    $myObj = new stdClass;
    $myObj->token = $token;
    $myObj->sql = $sql;
    $myJSON = json_encode($myObj,JSON_UNESCAPED_SLASHES);
    
    $datos_post = http_build_query(
        $myObj
    );

    $opciones = array('http' =>
        array(
            'method'  => 'POST',
            'header'  => 'Content-type: application/x-www-form-urlencoded',
            'content' => $datos_post
        )
    );
    ini_set('max_execution_time', 7000);
    ini_set('max_execution_time', 0);
    $context = stream_context_create($opciones);            
    $archivo_web = file_get_contents($url, false, $context);            
    // var_dump($archivo_web);
    $data = json_decode($archivo_web,true);

    $jsonIterator = new RecursiveIteratorIterator(
        new RecursiveArrayIterator(json_decode($archivo_web, TRUE)),
        RecursiveIteratorIterator::SELF_FIRST
    );

    $r = "";
    foreach ($jsonIterator as $key => $val) {
        if (is_numeric($key)){ //rows                        
            $rowC = 0;
        } else {
            $r = $val;
        }
    }
    return $r;
}

function Transaccion_Insert(){
    require("rintera-config.php");
    // $UltimoMov = Transaccion_UltimoMov();
    // $SiguienteMov = $UltimoMov + 1;
    // $SiguienteMov4zero =  str_pad($SiguienteMov, 4, '0', STR_PAD_LEFT);
    $sql = "
	
    INSERT INTO 
    ControlDeTransacciones (Año, mes, Movimiento, IdTransaccion) 
    VALUES(year(getdate()), MONTH(getdate()), '001', 
    (CONVERT(varchar(4),year(getdate())) +
    CONVERT(varchar(2),MONTH(getdate())) + 
    '0001'));
            
    ";
    // echo "<hr>".$sql;
    $url = $url_;
    $token = $token_;
    //Peticion
    $myObj = new stdClass;
    $myObj->token = $token;
    $myObj->sql = $sql;
    $myJSON = json_encode($myObj,JSON_UNESCAPED_SLASHES);
    
    $datos_post = http_build_query(
        $myObj
    );

    $opciones = array('http' =>
        array(
            'method'  => 'POST',
            'header'  => 'Content-type: application/x-www-form-urlencoded',
            'content' => $datos_post
        )
    );
    ini_set('max_execution_time', 7000);
    ini_set('max_execution_time', 0);
    $context = stream_context_create($opciones);            
    $archivo_web = file_get_contents($url, false, $context);            
    // var_dump($archivo_web);
    // $data = json_decode($archivo_web,true);

    // $jsonIterator = new RecursiveIteratorIterator(
    //     new RecursiveArrayIterator(json_decode($archivo_web, TRUE)),
    //     RecursiveIteratorIterator::SELF_FIRST
    // );

    // $r = "";
    // foreach ($jsonIterator as $key => $val) {
    //     if (is_numeric($key)){ //rows                        
    //         $rowC = 0;
    //     } else {
    //         $r = $val;
    //     }
    // }
    // return $r;
}




function Transaccion_Actualizar(){
    require("rintera-config.php");
    $UltimoMov = Transaccion_UltimoMov();
    $SiguienteMov = $UltimoMov + 1;
    $SiguienteMov4zero =  str_pad($SiguienteMov, 4, '0', STR_PAD_LEFT);
    $sql = "
	
        UPDATE ControlDeTransacciones 
        SET Movimiento = ".$SiguienteMov.", 
        IdTransaccion = (CONVERT(varchar(4),year(getdate())) + CONVERT(varchar(2),MONTH(getdate())) + '".$SiguienteMov4zero."')

        WHERE Año = year(getdate()) AND mes = MONTH(getdate())
            
    ";
    // echo "<hr>".$sql;
    $url = $url_;
    $token = $token_;
    //Peticion
    $myObj = new stdClass;
    $myObj->token = $token;
    $myObj->sql = $sql;
    $myJSON = json_encode($myObj,JSON_UNESCAPED_SLASHES);
    
    $datos_post = http_build_query(
        $myObj
    );

    $opciones = array('http' =>
        array(
            'method'  => 'POST',
            'header'  => 'Content-type: application/x-www-form-urlencoded',
            'content' => $datos_post
        )
    );
    ini_set('max_execution_time', 7000);
    ini_set('max_execution_time', 0);
    $context = stream_context_create($opciones);            
    $archivo_web = file_get_contents($url, false, $context);            
    // var_dump($archivo_web);
    // $data = json_decode($archivo_web,true);

    // $jsonIterator = new RecursiveIteratorIterator(
    //     new RecursiveArrayIterator(json_decode($archivo_web, TRUE)),
    //     RecursiveIteratorIterator::SELF_FIRST
    // );

    // $r = "";
    // foreach ($jsonIterator as $key => $val) {
    //     if (is_numeric($key)){ //rows                        
    //         $rowC = 0;
    //     } else {
    //         $r = $val;
    //     }
    // }
    // return $r;
}

?>
