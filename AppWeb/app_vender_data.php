<?php
    require ("rintera-config.php");
    require ("components.php");
    require ("app_funciones.php");
    include("seguridad.php");

    $CorreoContenido = VarClean($_POST['CorreoContenido']);
    $CorreoCopia = VarClean($_POST['CorreoCopia']);
    $IdProducto = VarClean($_POST['IdProducto']);
    $Tipo = VarClean($_POST['Tipo']);
    $ClaveDelProducto = VarClean($_POST['ClaveDelProducto']);
    $IdLote = VarClean($_POST['IdLote']);
    $IdUser  = VarClean($_POST['IdUser']);
    $IdTransaccion = VarClean($_POST['IdTransaccion']);
    $IdCliente = VarClean($_POST['IdCliente']);
    $IdClienteName = VarClean($_POST['IdClienteName']);
    $FechaOperacion = VarClean($_POST['FechaOperacion']);
    $Cantidad = VarClean($_POST['Cantidad']);
    $Costo = VarClean($_POST['Costo']);
    $Precio = VarClean($_POST['Precio']);
    $IdIncoterms = VarClean($_POST['IdIncoterms']);
    $IdIncotermsName = VarClean($_POST['IdIncotermsName']);
    $TiempoDeEnvio = VarClean($_POST['TiempoDeEnvio']);
    $Muestra = VarClean($_POST['Muestra']);
    $IdAdjudicacion = VarClean($_POST['IdAdjudicacion']);
    $Referencia = "";
    $IdMuestra=2;

    if ($Muestra=='SI') {
        $IdMuestra = 1;
    } 

    if ($IdAdjudicacion == "VENTA"){
            EnviarGuardar($Referencia, $IdTransaccion, $IdCliente, $IdLote, $Cantidad, $Costo, $IdIncoterms, "1", $TiempoDeEnvio, $IdMuestra, $ClaveDelProducto, "A", $IdProducto, $Precio, 3);
        }
    } else {
            EnviarGuardar($Referencia, $IdTransaccion, $IdCliente, $IdLote, $Cantidad, $Costo, $IdIncoterms, "2", $TiempoDeEnvio, $IdMuestra, $ClaveDelProducto, "A", $IdProducto, $Precio, 4);
        }
    }

    // if ($IdAdjudicacion == "VENTA"){ //VENTA
    //     if (is_numeric($ClaveDelProducto)){
    //         $Referencia.= "BE";
    //         $Referencia.= str_pad($IdProducto, 7, "0", STR_PAD_LEFT)."001";
    //         EnviarGuardar($Referencia, $IdTransaccion, $IdCliente, $IdLote, $Cantidad, $Costo, $IdIncoterms, "1", $TiempoDeEnvio, $IdMuestra, "E","B", $IdProducto, $Precio);
    //     } else {
    //         $Referencia.="A".$ClaveDelProducto;
    //         $Referencia.= str_pad($IdProducto, 7, "0", STR_PAD_LEFT)."001";
    //         EnviarGuardar($Referencia, $IdTransaccion, $IdCliente, $IdLote, $Cantidad, $Costo, $IdIncoterms, "1", $TiempoDeEnvio, $IdMuestra, $ClaveDelProducto, "A", $IdProducto, $Precio);
    //     }
    // } else {//OFERTA
    //     // Toast("OFERTA",1,"");
    //     if (is_numeric($ClaveDelProducto)){
    //         $Referencia.= "BE";
    //         $Referencia.= str_pad($IdProducto, 7, "0", STR_PAD_LEFT)."001";
    //         EnviarGuardar($Referencia, $IdTransaccion, $IdCliente, $IdLote, $Cantidad, $Costo, $IdIncoterms, "2", $TiempoDeEnvio, $IdMuestra, "E","B", $IdProducto,$Precio);
    //     } else {
    //         $Referencia.="A".$ClaveDelProducto;
    //         $Referencia.= str_pad($IdProducto, 7, "0", STR_PAD_LEFT)."001";
    //         EnviarGuardar($Referencia, $IdTransaccion, $IdCliente, $IdLote, $Cantidad, $Costo, $IdIncoterms, "2", $TiempoDeEnvio, $IdMuestra, $ClaveDelProducto, "A", $IdProducto, $Precio);
    //     }
    // }

    $Referencia = "";

     $sql = "INSERT INTO productosmov 
     (IdProducto, Tipo, ClaveDelProducto,IdUser,IdTransaccion, IdCliente,IdClienteName, FechaOperacion,Cantidad,
     Costo,IdIncoterms, IdIncotermsName, TiempoDeEnvio, Muestra, IdAdjudicacion, Fecha, Hora, IdLote, Precio) 
    VALUES (
        '".$IdProducto."',".
        "'".$Tipo."',".
        "'".$ClaveDelProducto."',".
        "'".$RinteraUser."',".
        "'".$IdTransaccion."',".
        "'".$IdCliente."',".
        "'".$IdClienteName."',".
        "'".$FechaOperacion."',".
        "'".$Cantidad."',".
        "'".$Costo."',".
        "'".$IdIncoterms."',".
        "'".$IdIncotermsName."',".
        "'".$TiempoDeEnvio."',".
        "'".$Muestra."',".
        "'".$IdAdjudicacion."',".
        "'".$fecha."',".
        "'".$hora."',".
        "'".$IdLote."',".
        "'".$Precio."'".
        ")";

        if ($db0->query($sql) == TRUE)
        {
            Toast("Guardado con exito, haga clic en movimientos para verlo",4,"");

            $CorreoDelCliente = ClienteEmail($IdCliente);
            if ($CorreoDelCliente <> ''){
                if ($CorreoContenido <> ''){

                    if (DonWebEnviarCorreo($CorreoDelCliente, $IdClienteName, "IdTransaccion: ".$IdTransaccion." - ".$IdLote, $CorreoContenido)==TRUE){                        
                        Toast("Se envio correo a ".$CorreoDelCliente,4,"");
                        if ($CorreoCopia <> ''){
                            $CorreoContenido.= '<br> * copia enviada, del correo que se le envio al cliente '.$IdClienteName.' - '.$CorreoDelCliente;
                            if (DonWebEnviarCorreo($CorreoCopia, $IdClienteName, "IdTransaccion: ".$IdTransaccion." - ".$IdLote, $CorreoContenido)==TRUE){                        
                                Toast("Se te envio copia de este correo a ".$CorreoCopia." -> ".$CorreoDelCliente,1,"");
                            } else {
                                Toast("No se envio correo, ERROR AL ENVIAR COPIA",2,"");
                            }
                        }
                    } else {
                        Toast("No se envio correo, ERROR AL ENVIAR",2,"");
                    }
                } else {
                    Toast("No se envio correo, SIN TEXTO PARA ENVIAR",2,"");
                }
             } else {
                Toast("No se envio correo, SIN CORREO REGISTRADO",2,"");
            }

        }
        else {
            // echo $sql;
            Toast("Error al guardar",2,"");
        }

Historia($RinteraUser, "Guardo producto en Sql Server", "".$sql."");

// echo '
// <script>
// function redireccionarPagina() {
//     window.location = "app_movs.php";
//   }
//   setTimeout("redireccionarPagina()", 1000);
// </script>';

function EnviarGuardar($Referencia, $IdTransaccion, $IdCliente, $IdLote, $Cantidad,$Costo, $IdIncoterms, $IdAdjudicacion, $TiempoDeEnvio, $Muestra, $ClaveDelProducto, $Clave2, $IdProducto, $Precio, $IdEstatusMtto)
{
    $sql = "
    EXEC VentasAfectandoInventarios @Referencia = '".$Referencia."'
    , @IdTransaccion = '".$IdTransaccion."'
    , @IdCliente = ".$IdCliente."
    , @Fecha = '".date("Ymd g:i")."'
    , @NoLote = '".$IdLote."'
    , @Cantidad = ".$Cantidad."
    , @FormaDeEnvase = 'TAMBOR (ES)'
    , @UnidadDeMedida = 'Kilogramos'
    , @PrecioDeventa = '".$Precio."'
    , @IdMoneda_PrecioDeVenta = 1
    , @CostoDeventa = '".$Costo."'
    , @IdMoneda_CostoDeVenta = 1
    , @IdIncoterms = '".$IdIncoterms."'
    , @TipoDeAdjudicacion = ".$IdAdjudicacion."
    , @LimiteParaEmbarcar = ".$TiempoDeEnvio."
    , @VigenciaEnDiasDeLaOferta = 0
    , @ClienteSolicitoMuestra = ".$Muestra."
    , @UbicacionLogica_Producto = '".$ClaveDelProducto."'
    , @UbicacionLogica_SubProducto = '".$ClaveDelProducto."'
    , @UbicacionLogica_ID = ".$IdProducto."
    , @UbicacionLogica_UnidadDeMedida = 1
    , @OrdenVisual = 0
    , @IdEstatusDelRegistro = 0
    , @FechaDeCreacion = '".date("Ymd g:i")."'
    , @IdUsuarioCreo = 1
    , @IdEstatusMtto = ".$IdEstatusMtto."
    ";
    echo $sql;


    require("rintera-config.php");
    $IdCon = 2; $Lote = "";
    $WSSQL = "select * from dbs where IdCon='".$IdCon."' AND Active=1 AND ConType =2"; //SQLSERVERTOJSON
    $WSCon = $db0 -> query($WSSQL);    
    if($WSConF = $WSCon -> fetch_array())
    {
        if ($WSConF['wsurl'] <>'' &&  $WSConF['wsmethod']<>'' && $WSConF['wsjson']<>'' )    
        {
            $WSurl = $WSConF['wsurl'];
            $WSmethod = $WSConF['wsmethod'];
            $WSjson = $WSConF['wsjson'];
            $WSparametros = $WSConF['parametros'];

            $wsP1_id = $WSConF['wsP1_id'];  $wsP1_value = $WSConF['wsP1_value'];
            $wsP2_id = $WSConF['wsP2_id'];  $wsP2_value = $WSConF['wsP2_value'];
            $wsP3_id = $WSConF['wsP3_id'];  $wsP3_value = $WSConF['wsP3_value'];
            $wsP4_id = $WSConF['wsP4_id'];  $wsP4_value = $WSConF['wsP4_value'];
            $WS_Val = TRUE;        
            $url = $WSurl;            
            $sql = $sql;
            $token = $wsP1_value;

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
            var_dump($archivo_web);
            $data = json_decode($archivo_web);

            $jsonIterator = new RecursiveIteratorIterator(
                new RecursiveArrayIterator(json_decode($archivo_web, TRUE)),
                RecursiveIteratorIterator::SELF_FIRST
            );
        
            $Der = "";
            // var_dump( $jsonIterator);    
            $TablaDeta = "";
            $row = 0;    
            foreach ($jsonIterator as $key => $val) {
                if (is_numeric($key)){ //rows                        
                    $rowC = 0;
                } else {
                    
                }
                
            }

        }
        
    }
    
    if (CheckTransaccion($IdTransaccion)==TRUE){
        Toast("Guardado correctamente en el Sistema de la Planta",4,"");
    } else {
        Toast("Error al guardar en el Sistema de la Planta",3,"");
    }
}



function CheckTransaccion($IdTransaccion)
{
    $sql = "
    select count(*) as R from HistorialDeTransacciones where IdTransaccion = '".$IdTransaccion."'
    ";
    echo $sql;
    require("rintera-config.php");
    $IdCon = 2; $Lote = "";
    $WSSQL = "select * from dbs where IdCon='".$IdCon."' AND Active=1 AND ConType =2"; //SQLSERVERTOJSON
    $WSCon = $db0 -> query($WSSQL);    
    if($WSConF = $WSCon -> fetch_array())
    {
        if ($WSConF['wsurl'] <>'' &&  $WSConF['wsmethod']<>'' && $WSConF['wsjson']<>'' )    
        {
            $WSurl = $WSConF['wsurl'];
            $WSmethod = $WSConF['wsmethod'];
            $WSjson = $WSConF['wsjson'];
            $WSparametros = $WSConF['parametros'];

            $wsP1_id = $WSConF['wsP1_id'];  $wsP1_value = $WSConF['wsP1_value'];
            $wsP2_id = $WSConF['wsP2_id'];  $wsP2_value = $WSConF['wsP2_value'];
            $wsP3_id = $WSConF['wsP3_id'];  $wsP3_value = $WSConF['wsP3_value'];
            $wsP4_id = $WSConF['wsP4_id'];  $wsP4_value = $WSConF['wsP4_value'];
            $WS_Val = TRUE;        
            $url = $WSurl;            
            $sql = $sql;
            $token = $wsP1_value;

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
            $data = json_decode($archivo_web);

            $jsonIterator = new RecursiveIteratorIterator(
                new RecursiveArrayIterator(json_decode($archivo_web, TRUE)),
                RecursiveIteratorIterator::SELF_FIRST
            );
        
            $Der = "";
            // var_dump( $jsonIterator);    
            $TablaDeta = "";
            $row = 0;   
            $R = ""; 
            foreach ($jsonIterator as $key => $val) {
                if (is_numeric($key)){ //rows                        
                    $rowC = 0;
                } else {
                    if ($key=='R'){
                        $R = $val();
                    }
                    
                }
                
            }

        }
        
    }
    
    if ($R ==''){
        return FALSE;
    } else {
        return TRUE;
    }
}
?>