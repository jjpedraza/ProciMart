<?php
require ("rintera-config.php");
require ("components.php");
require ("app_funciones.php");
include("seguridad.php");



$IdProducto = VarClean($_POST['IdProducto']);
$Tipo = VarClean($_POST['Tipo']);
$ClaveDelProducto = VarClean($_POST['ClaveDelProducto']);
$IdLote = VarClean($_POST['IdLote']);

$IdUser  = VarClean($_POST['IdUser']);
$IdTransaccion = VarClean($_POST['IdTransaccion']);
$IdCliente = VarClean($_POST['IdCliente']);
$IdClienteName = VarClean($_POST['IdClienteName']);
$FechaOperacion = VarClean($_POST['FechaOperacion']);
// echo "Fecha Operacion = ".$FechaOperacion;
$Cantidad = VarClean($_POST['Cantidad']);
$Costo = VarClean($_POST['Costo']);
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
if ($IdAdjudicacion == "VENTA"){ //VENTA
    $Referencia.= str_pad($IdProducto, 7, "0", STR_PAD_LEFT)."001";
    if (is_numeric($ClaveDelProducto)){
        $Referencia.= "BE";
        EnviarGuardar($Referencia, $IdTransaccion, $IdCliente, $IdLote, $Cantidad, $Costo, $IdIncoterms, "1", $TiempoDeEnvio, $IdMuestra, "E","B", $IdProducto);
    } else {
        $Referencia.="A".$ClaveDelProducto;
        EnviarGuardar($Referencia, $IdTransaccion, $IdCliente, $IdLote, $Cantidad, $Costo, $IdIncoterms, "1", $TiempoDeEnvio, $IdMuestra, $ClaveDelProducto, "A", $IdProducto);
    }

    
  
} else {//OFERTA
    // Toast("OFERTA",1,"");
    $Referencia.= str_pad($IdProducto, 7, "0", STR_PAD_LEFT)."001";
    if (is_numeric($ClaveDelProducto)){
        $Referencia.= "BE";
        EnviarGuardar($Referencia, $IdTransaccion, $IdCliente, $IdLote, $Cantidad, $Costo, $IdIncoterms, "2", $TiempoDeEnvio, $IdMuestra, "E","B", $IdProducto);
    } else {
        $Referencia.="A".$ClaveDelProducto;
        EnviarGuardar($Referencia, $IdTransaccion, $IdCliente, $IdLote, $Cantidad, $Costo, $IdIncoterms, "2", $TiempoDeEnvio, $IdMuestra, $ClaveDelProducto, "A", $IdProducto);
    }

}
$Referencia = "";



     $sql = "INSERT INTO productosmov 
     (IdProducto, Tipo, ClaveDelProducto,IdUser,IdTransaccion, IdCliente,IdClienteName, FechaOperacion,Cantidad,
     Costo,IdIncoterms, IdIncotermsName, TiempoDeEnvio, Muestra, IdAdjudicacion, Fecha, Hora, IdLote) 
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
        "'".$IdLote."'".
        ")";
        if ($db0->query($sql) == TRUE)
        {
            Toast("Guardado con exito, haga clic en movimientos para verlo",4,"");
        }
        else {
            Toast("Error al guardar",2,"");
        }

Historia($RinteraUser, "Guardo Producto", "".$sql."");

// echo '
// <script>
// function redireccionarPagina() {
//     window.location = "app_movs.php";
//   }
//   setTimeout("redireccionarPagina()", 1000);
// </script>';

function EnviarGuardar($Referencia, $IdTransaccion, $IdCliente, $IdLote, $Cantidad,$Precio, $IdIncoterms, $IdAdjudicacion, $TiempoDeEnvio, $Muestra, $ClaveDelProducto, $Clave2, $IdProducto){
    $sql = "
    EXEC Ventas_Almacenamiento @Referencia = '".$Referencia."'
    , @IdTransaccion = '".$IdTransaccion."'
    , @IdCliente = ".$IdCliente."
    , @Fecha = '".date("Ymd g:i")."'
    , @NoLote = '".$IdLote."'
    , @Cantidad = ".$Cantidad."
    , @FormaDeEnvase = 'TAMBOR (ES)'
    , @UnidadDeMedida = 'Kilogramos'
    , @PrecioDeventa = '".$Precio."'
    , @IdMoneda_PrecioDeVenta = 1
    , @CostoDeventa = '".$Precio."'
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
            foreach ($jsonIterator as $key => $val) {
                if (is_numeric($key)){ //rows                        
                    $rowC = 0;
                } else {
                    
                }
                
            }

        }
        
    }
    
    
}
?>