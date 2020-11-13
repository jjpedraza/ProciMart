<?php
include("head.php");
include("header.php");

$Tipo = VarClean($_GET['tipo']);
$IdRegreso = VarClean($_GET['back']);
if (isset($_GET['id'])) {
    $IdAceiteLote = VarClean($_GET['id']);
    $ClaveDelProducto = Procimart_ClaveProducto($Tipo);
    $ClaveDelProducto_id_rep = ClaveDelProducto_id_rep($ClaveDelProducto);
    $id_rep = $ClaveDelProducto_id_rep; //Consulta para esa clave de producto



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
                
                   
                    
                $row = $row + 1;    
            }
             
        }
        $TablaDetaT="<table class='tabla' border=1>".$TablaDeta."</table>";
        
       
           
            
       
        
        
        
        
    }

}


$TipoReporte = 5; $ClaseTabla ="table-striped table-hover"; $ClaseDiv="table container";         
$Data =  DataFromSQLSERVERTOJSON($id_rep, $TipoReporte, $ClaseTabla, $ClaseDiv, $RinteraUser);

$DetallesDeProducto = $Data;
$Footer  =  ReporteFooter($id_rep);
$Titulo = ""."".ReporteEncabezado($id_rep)."";
$DetallesInfo = $TablaDetaT;
$BotonRegresar = "<div style='margin-top:5px; text-align:right; margin-right:5px;'>
<a href='r.php?id=".$IdRegreso."' class='btn btn-secondary' style='font-size:8pt;'><img src='icon/btn_izquierda.png' style='width:18px;'> Regresar</a><br></div>";

echo "<div id='DetallesTitulo' style='
background-color: #82828224;
width: 98%;
border-radius: 5px;
'>"; 
echo "<table width=100%><tr><td>"   ;
    echo $Titulo."";
echo "</td><td width=20%>";
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
    echo $DetallesDeProducto;        
echo "</div>";



echo "<div id='DetallesInfo' style='
padding: 10px;
background-color: #a8a8a845;
border-radius: 5px;
'>";
    echo $DetallesInfo;
echo "</div>";
echo "<div style='font-size:7pt; color:gray;'>Id=".$IdAceiteLote.", Tipo=".$Tipo.", ClaveDelProducto=".$ClaveDelProducto.", idReporte=".$id_rep."</div>";

} else {
    $IdCertificado =  VarClean($_GET['idCer']);

    $Footer  =  ReporteFooter($IdRegreso);
    $Titulo = ""."".ReporteEncabezado($IdRegreso)."";
    $BotonRegresar = "<div style='margin-top:5px; text-align:right; margin-right:5px;'>
<a href='r.php?id=".$IdRegreso."' class='btn btn-secondary' style='font-size:8pt;'><img src='icon/btn_izquierda.png' style='width:18px;'> Regresar</a><br></div>";


    echo "<div id='DetallesTitulo' style='
    background-color: #82828224;
    width: 98%;
    border-radius: 5px;
    '>"; 
    echo "<table width=100%><tr><td>"   ;
        echo $Titulo."";
    echo "</td><td width=20%>";
    echo $BotonRegresar;
    echo "</td></tr></table>";
    echo "</div>";

    
            



        $QueryDetalle = "
        Select 
            ISNULL(IdCertificado, '') as IdCertificado,
            ISNULL(Fecha, '') as Fecha,
            ISNULL(Turno, '') as Turno,
            ISNULL(Producto, '') as Producto,
            ISNULL(LoteNum, '') as LoteNum,
            ISNULL(TanquePF, '') as TanquePF,
            ISNULL(Temperatura, '') as Temperatura,
            ISNULL(TipoDeEnvasado, '') as TipoDeEnvasado,
            ISNULL(TotalTambores, 0) as TotalTambores,
            ISNULL(del, 0) as del,
            ISNULL(al, 0) as al,
            ISNULL(Silos, '') as Silos,
            ISNULL(NivelInicial, '') as NivelInicial,
            ISNULL(NivelFinal, '') as NivelFinal,
            ISNULL(PulgadasTotales, '') as PulgadasTotales,
            ISNULL(GalonesTotales, '') as GalonesTotales,
            ISNULL(BxDirectos, '') as BxDirectos,
            ISNULL(BxCorreg, '') as BxCorreg,
            ISNULL(RelacionGPL, '') as RelacionGPL,
            ISNULL(PorcPulpa, '') as PorcPulpa,
            ISNULL(PorcDeAceite, '') as PorcDeAceite,
            ISNULL(Color, '') as Color,
            ISNULL(Sabor, '') as Sabor,
            ISNULL(Defectos, '') as Defectos,
            ISNULL(Calificacion, '') as Calificacion,
            ISNULL(pH, '') as pH,
            ISNULL(PorcAcidez, '') as PorcAcidez,
            ISNULL(CorrAcidez, '') as CorrAcidez,
            ISNULL(PorcAire, '') as PorcAire,
            ISNULL(PorcPww, '') as PorcPww,
            ISNULL(PorcEstab, '') as PorcEstab,
            ISNULL(Visc, '') as Visc,
            ISNULL(VitaminaC, '') as VitaminaC,
            ISNULL(Limonina, '') as Limonina,
            ISNULL(Peu, '') as Peu,
            ISNULL(Diacetil, '') as Diacetil,
            ISNULL(QuickFiber, '') as QuickFiber,
            ISNULL(Concentracion, '') as Concentracion,
            ISNULL(Decision, '') as Decision,
            ISNULL(CausaDeRechazo, '') as CausaDeRechazo,
            ISNULL(Analizo, '') as Analizo,
            ISNULL(Supervisor, '') as Supervisor,
            ISNULL(EncLlenado, '') as EncLlenado
            from Laboratorio_DetalleDelLote Where IdCertificado = '".$IdCertificado."'
            ";

    $IdCon = 2;
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
            $sql = $QueryDetalle;
            $token = $wsP1_value;

            //Peticion
            $myObj = new stdClass;
            $myObj->token = $token;
            $myObj->sql = $QueryDetalle;
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
                            // $Der.= "<article class='Tit'>";
                            // $Der.= "<b>".$val."</b> ".$key."";
                            // $Der.= "</article>";
                            // break;
                        case 1:
                            // $Der.= "<article class='Sub'>";                        
                            // $Der.= "<b title='".$key."'>".$val."</b> ".$Tipo;
                            // if ($key =='Fruta'){
                                
                            //     // Bakcground(" ".$val);
                                
                            // }
                            // $Der.= "</article>";
                            // break;
                        default:
                            
                            $TablaDeta.= "<tr><td width=50% align=right style='font-size:12pt; font-weight:bold;'>".$key."</td><td align=left
                            style='font-size:12pt; '
                            >".$val."</td></tr>";
                            
                            break;
                    }
                    
                    
                        
                    $row = $row + 1;    
                }
                
            }
            $TablaDetaT="<table class='tabla' border=1>".$TablaDeta."</table>";
            
        
            
                
        
            
            
            
            
        }

    }


    echo "<div id='Detalles'><h4>Detalles:</h4>".$TablaDetaT."</div>";
    
        
    


}







include("footer.php");
?>