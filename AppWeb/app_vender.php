<?php
include("head.php");
include("header.php");
require("app_funciones.php");
$IdAceiteLote = VarClean($_GET['id']);
$IdRegreso = VarClean($_GET['back']);
$Tipo = VarClean($_GET['tipo']);
$ClaveDelProducto = Procimart_ClaveProducto($Tipo);
$ClaveDelProducto_id_rep = ClaveDelProducto_id_rep($ClaveDelProducto);
$id_rep = $ClaveDelProducto_id_rep; //Consulta para esa clave de producto
// echo $id_rep;


$QueryEncabezado = "
    Select 
    ISNULL(Aldehidos,'') as Aldehidos
    ,ISNULL(Fruta, '') as Fruta
    ,ISNULL(CONVERT(varchar(50), IdAceiteLote), 0) as IdAceiteLote
    ,ISNULL(Tipo, '') as Tipo    
    ,ISNULL(Fecha, '') as Fecha
    ,ISNULL(Lote,'') as Lote
    ,ISNULL(Aldehidos,'') as Aldehidos
    ,ISNULL(Envasado,'') as Envasado
    ,ISNULL(CONVERT(varchar(50), Produccion),'') as Produccion
    ,ISNULL(CONVERT(varchar(50), Utilizados),'') as Utilizados
    ,ISNULL(InventarioFinal,'') as InventarioFinal
    ,ISNULL(Estatus, '') as Estatus
    ,ISNULL(TiempoAlmacen,'') as TiempoAlmacen
    ,ISNULL(KgMezcla,'') as KgMezcla
    ,ISNULL(ValorDeUnidad,'') as ValorDeUnidad
    ,ISNULL(UnidadDeMedida,0) as UnidadDeMedida
    from InventarioDeAceites('Kilogramos',1) 

    WHERE IdAceitelote='".$IdAceiteLote."' and Tipo='".$Tipo."'
";

$IdCon = 2;
$WSSQL = "select * from dbs where IdCon='".$IdCon."' AND Active=1 AND ConType =2"; //SQLSERVERTOJSON
$WSCon = $db0 -> query($WSSQL);
$Produccion = 0;
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
        $sql = $QueryEncabezado;
        $token = $wsP1_value;

        //Peticion
        $myObj = new stdClass;
        $myObj->token = $token;
        $myObj->sql = $QueryEncabezado;
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
                switch ($row) {                    
                    case 0:
                        $Der.= "<article class='Tit'>";
                        $Der.= "<b>".$val."</b> ".$key."";
                        $Der.= "</article>";
                        break;
                    case 1:
                        $Der.= "<article class='Sub'>";                        
                        $Der.= "<b title='".$key."'>".$val."</b> ".$Tipo;
                        if ($key =='Fruta'){
                            
                            // Bakcground(" ".$val);
		                    
                        }
                        $Der.= "</article>";
                        break;
                    default:
                        
                        $TablaDeta.= "<tr><td>".$key."</td><td>".$val."</td></tr>";
                        
                        break;
                }
                if ($key=='Produccion'){
                    $Produccion = $val;
                }
                
                   
                    
                $row = $row + 1;    
            }
             
        }
        $TablaDetaT="<table class='tabla' border=1>".$TablaDeta."</table>";
        
       
           
            
       
        
        
        
        
    }

}

//Trae tabla sola, columnas en lineas = 1 reg
$TipoReporte = 5; $ClaseTabla ="table-striped table-hover"; $ClaseDiv="table container";         
$Data =  DataFromSQLSERVERTOJSON($id_rep, $TipoReporte, $ClaseTabla, $ClaseDiv, $RinteraUser);

//Trae con option
$TipoReporte = 6; $ClaseTabla =""; $ClaseDiv="";        
$ClienteOptions =  DataFromSQLSERVERTOJSON(11, $TipoReporte, $ClaseTabla, $ClaseDiv, $RinteraUser)."<option value='' selected></opcion>";
// var_dump($ClienteOptions);

$DetallesDeProducto = $Data;
$Footer  =  ReporteFooter($id_rep);
$Titulo = ""."".ReporteEncabezado($id_rep)."";
$DetallesInfo = $TablaDetaT;
$BotonRegresar = "<div style='margin-top:5px; text-align:right; margin-right:5px;'>
<a href='r.php?id=".$IdRegreso."' class='btn btn-secondary' style='font-size:8pt;'><img src='icons/btn_izquierda.png' style='width:18px;'> Regresar</a><br></div>";

echo "<div id='DetallesTitulo' style='
background-color: #82828224;
width: 98%;
border-radius: 5px;
'>"; 
echo "<table width=100%><tr>";
echo "<td>";
echo "<img src='icons/ofertar.png' style='width:32px;' class='pc'>";
echo "</td>";
echo "<td>";
    echo $Titulo."";
echo "</td><td width=20% class='pc'>";
echo $BotonRegresar;
echo "</td></tr></table>";
echo "</div>";


echo "<div  id='DetallesTabla' class=''style='
background-color: #f7f7f77d;
margin: 5px;
    margin-top: 5px;
border-radius: 4px;
margin-top: 15px;

display: inline-block;
padding: 10px;
'>";       
    
$IdTransaccion = IdTransaccion();
echo "
<div class='form-group'>
<label>IdTransaccion: </label><br>
<input type='text' id='IdTransaccion' name='IdTransaccion' value='".$IdTransaccion."' class='form-control disable ' readonly>
</div>


";

echo "
<div class='form-group'>
<label>Cliente: </label><br>
<select id='IdCliente' class='form-control'>";
echo $ClienteOptions;
echo "</select>
</div>
";

echo "
<div class='form-groupMid'>
<table width=100% ><tr><td algin=right valing=top>
<label>";
echo "<img src='icons/calendar.png' style='width:22px'>";
echo "</label></td><td align=left valign=top>
<input type='date' id='Fecha' name='Fecha' class='form-control' value='";
echo $fecha;
echo "'> ";

echo "</td></tr></table>
</div>
";


echo "<input type='hidden' id='Produccion' value='".$Produccion."'>";
echo "
<div class='form-groupMid'>
<table width=100% ><tr><td algin=right  valign=top>
<label>";
echo "<img src='icons/productos.png' style='width:18px'>";
echo "<label><span id='LProduccion' title='Produccion' style='cursor:pointer'>".$Produccion."</span>";
echo "</label></td><td align=left valign=top>
<input type='number' id='Cantidad' name='Cantidad' class='form-control' value='0'  min='1' max='".$Produccion."'>";
echo "</td></tr></table>
</div>
";









echo "</div>";



echo "<div id='DetallesInfo' style='
padding: 10px;
background-color: #a8a8a845;
border-radius: 5px;
'>";
    echo $DetallesInfo;
    echo "<hr>";
    echo $DetallesDeProducto;       
echo "</div>";





echo "<div style='font-size:7pt; color:gray;'>Id=".$IdAceiteLote.", Tipo=".$Tipo.", ClaveDelProducto=".$ClaveDelProducto.", idReporte=".$id_rep."</div>";


?>


<script>
$("#Cantidad").bind('keyup mouseup', function () {
    Cantidad = $('#Cantidad').val();
    Produccion =  $('#Produccion').val();
    PreInventario = Produccion - Cantidad;
    $('#LProduccion').html(PreInventario)      
});


</script>
<?php
include("footer.php");
?>