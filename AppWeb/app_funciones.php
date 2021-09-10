<?php

function ReferenciaN(){
    require_once("preference.php");
    
    $n = Preference("ReferenciaN", "", "") + 1;
    PreferenceEdit("ReferenciaN", "", "", $n);

    $n2 = Preference("ReferenciaN", "", "");
    return $n2;

}


function IdTransaccion(){
    $UltimoMov = Transaccion_UltimoMov();
    $SiguienteMov = 0;
    $IdTransaccion = "";
    $AnioActual = date("Y");
    $MesActual = date("m");

    if ($UltimoMov == 0)
        {
            $SiguienteMov = 1;
            Transaccion_Insert();
        } 
    else
        { 
            $SiguienteMov = $UltimoMov + 1;
            Transaccion_Actualizar();
        }
    
    $IdTransaccion = $AnioActual.$MesActual.'1'.str_pad($SiguienteMov, 3, '0', STR_PAD_LEFT);
    return $IdTransaccion ;

}




function Transaccion_UltimoMov(){
    require("rintera-config.php");

    $sql = "select movimiento from controldetransacciones where año = year(NOW()) and mes = MONTH(NOW())";

    $rc = $db0->query($sql);    
    if ($db0->query($sql) == TRUE){
        if($f = $rc -> fetch_array())
        {
            return $f['movimiento'];
        } else {
            return 1;
        }
        

    } else {
        
    }

    // $url = $url_;
    
    // $token = $token_;
    // $myObj = new stdClass;
    // $myObj->token = $token;
    // $myObj->sql = $sql;
    // $myJSON = json_encode($myObj,JSON_UNESCAPED_SLASHES);
    
    // $datos_post = http_build_query(
    //     $myObj
    // );

    // $opciones = array('http' =>
    //     array(
    //         'method'  => 'POST',
    //         'header'  => 'Content-type: application/x-www-form-urlencoded',
    //         'content' => $datos_post
    //     )
    // );
    // ini_set('max_execution_time', 7000);
    // ini_set('max_execution_time', 0);
    // $context = stream_context_create($opciones);            
    // $archivo_web = file_get_contents($url, false, $context);            
    // // var_dump($archivo_web);
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
}


function Transaccion_Actualizar(){
    require("rintera-config.php");
    $UltimoMov = Transaccion_UltimoMov();
    $SiguienteMov = $UltimoMov + 1;
    //$AplicaCerosEnElMov =  str_pad($SiguienteMov, 5, '0', STR_PAD_LEFT);
    //$sql = "UPDATE ControlDeTransacciones SET Movimiento = ".$SiguienteMov.", IdTransaccion = (CONVERT(varchar(4),year(getdate())) + CONVERT(varchar(2),MONTH(getdate())) + '".$SiguienteMov4zero."') WHERE Año = year(getdate()) AND mes = MONTH(getdate())";
    $sql = "Update controldetransacciones Set movimiento = ".$SiguienteMov." Where año = YEAR(NOW()) And mes  = month(NOW())";
    if ($db0->query($sql) == TRUE) {return TRUE;} else {return FALSE;}
    
    // $url = $url_;
    // $token = $token_;

    // $myObj = new stdClass;
    // $myObj->token = $token;
    // $myObj->sql = $sql;
    // $myJSON = json_encode($myObj,JSON_UNESCAPED_SLASHES);
    
    // $datos_post = http_build_query($myObj);

    // $opciones = array('http' =>
    //     array(
    //         'method'  => 'POST',
    //         'header'  => 'Content-type: application/x-www-form-urlencoded',
    //         'content' => $datos_post
    //     )
    // );
    // ini_set('max_execution_time', 7000);
    // ini_set('max_execution_time', 0);
    // $context = stream_context_create($opciones);            
    // $archivo_web = file_get_contents($url, false, $context);            
}

function ProductosMov(){
    require("rintera-config.php");
    $r= $db0 -> query("select * from dbs where Active=1");    
    while($finfo = $r -> fetch_array()) {   
        echo "<option value='".$finfo['IdCon']."'>".$finfo['ConName']."</opion>";
    }
}




function ClienteEmail($IdCliente){
    require("rintera-config.php");
    $sql = "Select ISNULL(eMail,'') as eMail from CatalogoDeClientes where IdCliente='".$IdCliente."'
    
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
?>
