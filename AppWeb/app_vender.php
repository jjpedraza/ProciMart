<?php
include("head.php");
include("header.php");
require("app_funciones.php");

$IdRegreso = VarClean($_GET['back']);
$Tipo = VarClean($_GET['tipo']);

if (isset($_GET['id'])) {
    $IdAceiteLote = VarClean($_GET['id']);
    $IdProducto = $IdAceiteLote;
           
            $ClaveDelProducto = Procimart_ClaveProducto($Tipo);
            $ClaveDelProducto_id_rep = ClaveDelProducto_id_rep($ClaveDelProducto);
            $id_rep = $ClaveDelProducto_id_rep; //Consulta para esa clave de producto
            // echo $id_rep;
            $Envasado = "";
            $IdLote = "";
            $Certificado_General ="";
            $Certificado_CocaCola = "";
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

            $IdCon = 2; $Lote = "";
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
                            
                            if ($key == 'Envasado'){
                                $Envasado = $val;
                            }
                            
                            if ($key == 'Lote'){
                                $IdLote = $val;
                            }
                                
                            $row = $row + 1;    
                        }
                        
                    }
                    $TablaDetaT="<table class='tabla' border=0>".$TablaDeta."</table>";
                    
                
                    
                        
                
                    
                    
                    
                    
                }

            }

            //Trae tabla sola, columnas en lineas = 1 reg
            $TipoReporte = 5; $ClaseTabla ="table-striped table-hover"; $ClaseDiv="table container";         
            $Data =  DataFromSQLSERVERTOJSON($id_rep, $TipoReporte, $ClaseTabla, $ClaseDiv, $RinteraUser);

            //Trae con option
            $TipoReporte = 6; $ClaseTabla =""; $ClaseDiv="";        
            $ClienteOptions =  DataFromSQLSERVERTOJSON(11, $TipoReporte, $ClaseTabla, $ClaseDiv, $RinteraUser)."<option value='' selected></opcion>";
            // var_dump($ClienteOptions);


            //Trae con option
            $TipoReporte = 6; $ClaseTabla =""; $ClaseDiv="";        
            $MonedaOptions =  DataFromSQLSERVERTOJSON(12, $TipoReporte, $ClaseTabla, $ClaseDiv, $RinteraUser)."";
            // var_dump($ClienteOptions);

            $DetallesDeProducto = $Data;
            $Footer  =  ReporteFooter($id_rep);
            $Titulo = ""."".ReporteEncabezado($id_rep)."";
            $DetallesInfo = $TablaDetaT;
            $BotonRegresar = "<div style='margin-top:5px; text-align:right; margin-right:5px;'>
            <a href='r.php?id=".$IdRegreso."' class='btn btn-secondary' style='font-size:8pt;background-color:".Preference("ColorPrincipal", "", "")."'><img src='icon/btn_izquierda.png' style='width:18px;'> Regresar</a><br></div>";

            echo "<div id='DetallesTitulo' style='
            background-color: #82828224;
            width: 98%;
            border-radius: 5px;
            '>"; 

            echo "<table width=100%><tr>";
            echo "<td>";
            echo "<img src='img/carrito.png' style='width:70px;' class='pc'>";
            echo "</td>";
            echo "<td>";
                echo $Titulo."";
            echo "</td><td width=20% class='pc'>";
            echo $BotonRegresar;
            echo "</td></tr></table>";
            echo "</div>";

            echo "<div  id='DetallesTabla' class=''style='
            background-color: #fff;
            margin: 5px;
                margin-top: 5px;
            border-radius: 4px;
            margin-top: 15px;

            display: inline-block;
            padding: 10px;
            text-align: justify;
            '>";       
                
            $IdTransaccion = IdTransaccion();
            echo "
            <div class='form-group'>
            <label>IdTransaccion: </label><br>
            <input type='text' id='IdTransaccion' name='IdTransaccion' value='".$IdTransaccion."' class='form-control disable ' readonly style='border:solid 1px ".Preference("ColorPrincipal", "", "").";'>
            </div>
            ";

            echo "
            <div class='form-group'>
            <label>Cliente: </label><br>
            <select id='IdCliente' class='form-control' onChange='ChecaCorreo();' style='border:solid 1px ".Preference("ColorPrincipal", "", "").";'>";
            echo $ClienteOptions;
            echo "</select>
            </div>
            ";

            echo "
            <div class='form-groupMid'>
            <table width=100% border=0>";
            echo "<tr><td colspan=3><label style='margin:0px;'>Fecha:</label></td></tr>";
            echo "<tr><td class='pc' align=right  valign=top><label style='margin:0px;'><img src='icon/calendar.png' style='width:22px'>";
            echo "</label></td><td align=left valign=top>
            <input type='date' id='Fecha' name='Fecha' class='form-control' style='border:solid 1px ".Preference("ColorPrincipal", "", "").";' value='";
            echo $fecha;
            echo "'> ";

            echo "</td></tr></table>
            </div>
            ";


            echo "<input type='hidden' id='Produccion' value='".$Produccion."'>";
            echo "
            <div class='form-groupMid'>
            <table width=100% border=0>";
            echo "<tr><td colspan=3><label style='margin:0px;'>Cantidad: <span class='pc'>(<span id='LProduccion' title='Inventario' style='cursor:pointer'> ".$Produccion." </span> ".$Envasado.   " )</span></label></td></tr>";

            echo "<tr><td align=left valign=top >
            <input type='number' id='Cantidad' name='Cantidad' class='form-control' value='0'  style='border:solid 1px ".Preference("ColorPrincipal", "", "").";' min='1' max='".$Produccion."'>";
            echo "</td>";

            echo "</tr></table>
            </div>
            ";

            echo "
            <div class='form-groupMid' id='DivCosto'>
            <table width=100% border=0>";
            echo "<tr><td colspan=3><label style='margin:0px;'>Costo Del Producto:</label></td></tr>";

            echo "<tr>";
            echo "<td align=left valign=top width=60%>
            <input type='text' id='Costo' name='Costo' class='form-control'  onBlur='toFinalNumberFormat(this);' placeholder='$#,###.00' style='border:solid 1px ".Preference("ColorPrincipal", "", "").";' >";
            echo "</td>";
            echo "<td width=30% align=left valign=top>";
            echo "<select id='IdMoneda' name='IdMoneda' class='form-control' style= 'border:solid 1px ".Preference("ColorPrincipal", "", "")."'>";
            echo $MonedaOptions;
            echo "</select>";

            echo "</td>";
            echo "</tr></table>
            </div>
            ";

            echo "
            <div class='form-groupMid' id='DivPrecio'>
            <table width=100% border=0>";
            echo "<tr><td colspan=3><label style='margin:0px;'>Precio:</label></td></tr>";

            echo "<tr>";
            echo "<td align=left valign=top width=60%>
            <input type='text' id='Precio' name='Precio' class='form-control'  onBlur='toFinalNumberFormat(this);' placeholder='$#,###.00' style='border:solid 1px ".Preference("ColorPrincipal", "", "").";' >";
            echo "</td>";
            echo "<td width=30% align=left valign=top>";
            echo "<select id='IdMoneda' name='IdMoneda' class='form-control' style='border:solid 1px ".Preference("ColorPrincipal", "", "")."'>";
            echo $MonedaOptions;
            echo "</select>";

            echo "</td>";
            echo "</tr></table>
            </div>
            ";


            $OptionsIncoterms = "";
            $OptionsIncoterms.="<option value='EXW'>EXW. (Ex-Works / En Fábrica)</option>";
            $OptionsIncoterms.="<option value='FCA'>FCA (Free Carrier / Libre Transportista)</option>";
            $OptionsIncoterms.="<option value='FAS'>FAS (Free Alongside Ship / Franco al Costado del Buque)</option>";
            $OptionsIncoterms.="<option value='FOB'>FOB (Free On Board / Libre a Bordo)</option>";
            $OptionsIncoterms.="<option value='CFR'>CFR (Cost and Freight / Coste y Flete)</option>";
            $OptionsIncoterms.="<option value='CIF'>CIF (Cost, Insurance and Freight / Coste, Seguro y Flete)</option>";
            $OptionsIncoterms.="<option value='CPT'>CPT (Carriage Paid To / Transporte Pagado Hasta)</option>";
            $OptionsIncoterms.="<option value='CIP'>CIP (Carriage and Insurance Paid To / Transporte y Seguro Pagados Hasta)</option>";
            $OptionsIncoterms.="<option value='DPU'>DPU (Delivered Place Unloaded / Entrega y Descarga en Lugar Acordado)</option>";
            $OptionsIncoterms.="<option value='CIP'>DAP (Delivered At Place / Entregado en un Punto)</option>";
            $OptionsIncoterms.="<option value='DDP'>DDP (Delivered Duty Paid / Entregado con Derechos Pagados):</option>";


            echo "<div id='IncotermsHelp' class='MyModal'>";
            echo "<img src='img/iconterms.jpg' style='width:90%;'>";
            echo "</div>";
            echo "
            <div class='form-group' id='Incoterms'>
            <table width=100% border=0>";
            echo "<tr><td colspan=3><label style='margin:0px;'>Tipo de incoterms: <a href='#IncotermsHelp' rel='MyModal:open'><img src='icon/ayuda.png' style='width:16px;'></a></label></td></tr>";
            echo "<tr>";
            echo "<td  align=left valign=top>";
            echo "<select id='IdIncoterms' name='IdIncoterms' class='form-control' style='border:solid 1px ".Preference("ColorPrincipal", "", "").";'>";
            echo $OptionsIncoterms;
            echo "</select>";

            echo "</td>";
            echo "</tr></table>
            </div>
            ";

            $OptionAdjudicacion = "";
            $OptionAdjudicacion.="<option value='VENTA'>Venta definitiva</option>";
            $OptionAdjudicacion.="<option value='OFERTA'>Ofertar producto</option>";

            echo "
            <div class='form-groupMid' id='AdjudicacionDiv' >
            <table width=100% border=0>";
            echo "<tr><td colspan=3><label style='margin:0px;'>Tipo de Adjudicacion: </label></td></tr>";
            echo "<tr>";
            echo "<td  align=left valign=top>";
            echo "<select id='IdAdjudicacion' name='IdAdjudicaion' class='form-control' style='border:solid 1px ".Preference("ColorPrincipal", "", "").";'>";
            echo $OptionAdjudicacion;
            echo "</select>";

            echo "</td>";
            echo "</tr></table>
            </div>
            ";

            echo "
            <div class='form-groupMid' id='Envio'>
            <table width=100% border=0>";
            echo "<tr><td colspan=3><label style='margin:0px;'>Tiempo de Envio (dias): </label></td></tr>";
            echo "<tr>";
            echo "<td  align=left valign=top>";
            echo "<input type='number' id='TiempoDeEnvio' name='TiempoDeEnvio' class='form-control' value='0' style='border:solid 1px ".Preference("ColorPrincipal", "", "").";'>";

            echo "</td>";
            echo "</tr></table>
            </div>
            ";

            echo "
            <div class='form-groupMid' id='MuestraDiv'>
            <table width=100% border=0>";
            echo "<tr><td colspan=3><label style='margin:0px;'>Solicitud de Muestra: </label></td></tr>";
            echo "<tr>";
            echo "<td  align=left valign=top >";
            echo "<select id='Muestra' name='Muestra' class='form-control' style='border:solid 1px ".Preference("ColorPrincipal", "", "").";'>
            <option value='SI'>SI</option>
            <option value='NO'>NO</option>
            </select>
            ";

            echo "</td>";
            echo "</tr></table>
            </div>
            ";

            echo "
            <div class='form-group' style='width:99%;'>
                <div style='width: 70%; float:left'>
                    <label>Texto del Correo que enviara al cliente: <span style='color:#cc4960;' id='Correo'></span> </label><br>
                    <textarea id='CorreoContenido' name='CorreoContenido' class='form-control' style='border:solid 1px ".Preference("ColorPrincipal", "", "").";'></textarea>
                </div>
                <div style='width: 1%; float:center'>
                </div>            
                <div style='width: 29%; float:right'>
                    <label>Con copia para:<span style='color:#cc4960;' id='ConCopiaPara'></span> </label><br>
                    <input   style='width:100%; border: solid 1px ".Preference("ColorPrincipal", "", "").";' type='mail' id='CorreoCopia' name='CorreoCopia' class='form-control'   >
                </div>            
            </div>
            ";

            // echo "
            // <div class='form-group' style='width:99%; border: solid 1px red'>
            //     <label>Texto del Correo que enviara al cliente: <span style='color:#cc4960;' id='Correo'></span> </label><br>
            //     <textarea id='CorreoContenido' name='CorreoContenido' class='form-control' style='border:solid 1px ".Preference("ColorPrincipal", "", "").";'></textarea>
            // </div>
            // ";
            //
            // echo "
            // <div class='form-group' style='width:97%; '>
            // <label>Con copia para:<br>
            // <input   style='width:150%; border: solid 1px ".Preference("ColorPrincipal", "", "").";' type='mail' id='CorreoCopia' name='CorreoCopia' class='form-control'   >
            // </div>
            // ";

            if ($ClaveDelProducto == "A"){
                $Certificado_General ="";
                $Certificado_CocaCola = "";
                $sqlCertificado = "select * from Aceites_COA_Certificados where Convert(varchar(max),Batch,103) = '".$IdLote."'";
                // echo $sqlCertificado;
                    
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
                        $sql = $sqlCertificado;
                        $token = $wsP1_value;

                        //Peticion
                        $myObj = new stdClass;
                        $myObj->token = $token;
                        $myObj->sql = $sqlCertificado;
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
                        // var_dump($opciones);

                        $jsonIterator = new RecursiveIteratorIterator(
                            new RecursiveArrayIterator(json_decode($archivo_web, TRUE)),
                            RecursiveIteratorIterator::SELF_FIRST
                        );
                
                        $TablaDeta = "";
                        $row = 0;    
                        foreach ($jsonIterator as $key => $val) {
                            if (is_numeric($key)){ //rows                        
                                $rowC = 0;
                            } else {
                                // echo $key." = ".$val."<br>";
                        
                                if ($val=="Certificado_General"){
                                    $Certificado_General = "GeneraCertificado_Aceite_FormatoGeneral.php";
                                }

                                if ($val=="Certificado_CocaCola"){
                                    $Certificado_CocaCola = "pdfProcimart2.php";
                                }

                                
                            
                        
                            $row = $row + 1;    
                        }
                        
                        }
                    }

                    }
                }


                if ($Certificado_General <> ''){
                            
                    echo "
                    <div class='form-group btn btn-secondary' id='Cert1' >
                    <table width=100% border=0>";        
                    echo "<tr>";
                    echo "<td  align=left valign=middle>";
                    echo "
                    <a href='GeneraCertificado_Aceite_FormatoGeneral.php?Batch=".$IdLote."' title='Haga clic aqui para ver el certificado' download>
                    <img src='icon/pdf.png' style='width:32px;'>
                    </a>

                    ";
                    echo "</td>";

                    echo "<td style='font-size:12pt;'>
                    <a  style='display:block; color:white; text-decoration:none;'  href='GeneraCertificado_Aceite_FormatoGeneral.php?Batch=".$IdLote."' title='Haga clic aqui para ver el certificado' download>
                    Inv. Aceites - Certificado de análisis</a></td>";
                    echo "</tr></table>
                    </div>
                    ";
                }


                
                if ($Certificado_CocaCola <> ''){
                            
                    echo "
                    <div class='form-group btn btn-secondary' id='Cert1' >
                    <table width=100% border=0>";        
                    echo "<tr>";
                    echo "<td  align=left valign=middle>";
                    echo "
                    <a href='GeneraCertificado_Aceite_FormatoCocaCola.php?Batch=".$IdLote."' title='Haga clic aqui para ver el certificado' download>
                    <img src='icon/pdf.png' style='width:32px;'>
                    </a>

                    ";
                    echo "</td>";

                    echo "<td style='font-size:12pt;'> <a style='display:block; color:white; text-decoration:none;' href='GeneraCertificado_Aceite_FormatoCocaCola.php?Batch=".$IdLote."' title='Haga clic aqui para ver el certificado' download>
                    Certificado de análisis</a></td>";
                    echo "</tr></table>
                    </div>
                    ";
                }

                echo "<div class='form-group btn btn-success' id='btnGuadar' onclick='Save();' >";
                echo "<img src='icon/guardar.png' style='width:32px;'>Guardar";
                echo "</div>";

                // echo "<a href='app_movs.php' class='form-group btn btn-primary' id='btnGuadar' >";
                // echo "<img src='icon/permisos.png' style='width:32px;'> Movimientos";
                // echo "</a>";

                echo "<div class='form-group ' id='btnGuadar' id='InfoMov' >";
                
                echo "</div>";


            echo "</div>";

            echo "<div id='DetallesInfo' style='
            padding: 10px;
            background-color: #a8a8a845;
            border-radius: 5px;
            '>";
                //echo $DetallesInfo;
                echo "<h4>Especificaciones del producto</h4>";
                echo $DetallesDeProducto;       
            echo "</div>";

echo "<div style='font-size:7pt; color:gray;'>Id=".$IdAceiteLote.", Tipo=".$Tipo.", ClaveDelProducto=".$ClaveDelProducto.", idReporte=".$id_rep."</div>";


} 

else 

{ 
    // nueva programacion juntando todos los inventarios ----------------------------
        $IdCertificado =  VarClean($_GET['idCer']);
        $IdProducto = $IdCertificado;
        $ClaveDelProducto = $Tipo;
        $TipoDeInventario = (int)$ClaveDelProducto;
    
        $Footer  =  ReporteFooter($IdRegreso);
        $Titulo = ""."".ReporteEncabezado($IdRegreso)."";

        $BotonRegresar = "<div style='margin-top:5px; text-align:right; margin-right:5px;'>
        <a href='r.php?id=".$IdRegreso."' class='btn btn-secondary' style='font-size:8pt;'><img src='icon/btn_izquierda.png' style='width:18px;'> Regresar</a><br></div>";

        echo "<div id='DetallesTitulo' style='
        background-color: #82828224;
        width: 98%;
        border-radius: 5px;
        '>"; 

        echo "<table width=100%><tr>";
        echo "<td>";
        echo "<img src='img/carrito.png' style='width:70px;' class='pc'>";
        echo "</td>";
        echo "<td>";
            echo $Titulo."";
        echo "</td><td width=20% class='pc'>";
        echo $BotonRegresar;
        echo "</td></tr></table>";
        echo "</div>";

        //Trae con option
        $TipoReporte = 6; $ClaseTabla =""; $ClaseDiv="";        
        $ClienteOptions =  DataFromSQLSERVERTOJSON(11, $TipoReporte, $ClaseTabla, $ClaseDiv, $RinteraUser)."<option value='' selected></opcion>";
        // var_dump($ClienteOptions);


        //Trae con option
        $TipoReporte = 6; $ClaseTabla =""; $ClaseDiv="";        
        $MonedaOptions =  DataFromSQLSERVERTOJSON(12, $TipoReporte, $ClaseTabla, $ClaseDiv, $RinteraUser)."";
        // var_dump($ClienteOptions);


        if ($TipoDeInventario == 9) {
            $QueryDetalle = "
            SELECT     IdCertificado, Fecha, Turno, Producto, LoteNum, TanquePF, Temperatura, TipoDeEnvasado, Disponibilidad, PesoBruto, PesoTara, PesoNeto, PorcAlcohol, Aldehidos, Re, Opp, Trifluralin, 
            Dimetoato, MetilParation, Malation, Clorpirifos, Etion, Pybutrin, Fenpropatrin, Fthalato, Permetrina, Cyflutrin, Dicofol, Bifentrina, Dybutil, Decision, CausaDeRechazo
            FROM         Laboratorio_DetalleDelLote
            Where IdCertificado = '".$IdCertificado."'";
        } else {
            $QueryDetalle = "
            Select IdCertificado, Fecha, Turno, Producto, LoteNum, TanquePF, Temperatura, TipoDeEnvasado, Disponibilidad, 
            Silos, NivelInicial, NivelFinal, PulgadasTotales, GalonesTotales, BxDirectos, BxCorreg, RelacionGPL, PorcPulpa, 
            PorcDeAceite, Color, Sabor, Defectos, Calificacion, pH, PorcAcidez, CorrAcidez, PorcAire, PorcPww, PorcEstab, 
            Visc, VitaminaC, Limonina, Peu, Diacetil, QuickFiber, Concentracion, Decision, CausaDeRechazo, Analizo, Supervisor, 
            EncLlenado from Laboratorio_DetalleDelLote Where IdCertificado = '".$IdCertificado."'";
        }

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
                                
                                $TablaDeta.= "<tr><td align=right style='font-size:10pt; font-weight:bold;'>".$key."</td><td align=left
                                style='font-size:10pt; '
                                >".$val."</td></tr>";
                                
                                break;
                        }
                        
                        
                            
                        $row = $row + 1;    
                        if ($key == 'LoteNum'){
                            $IdLote = $val;
                        }
                    }
                    
                }
                $TablaDetaT="<table class='tabla' border=0>".$TablaDeta."</table>";
            }
    
        }

        echo "<div  id='FormVender' class=''style='
        background-color: #ffffff80;
            margin: 5px;
                margin-top: 5px;
            border-radius: 4px;
            margin-top: 15px;

            display: inline-block;
            padding: 10px;
            text-align: justify;
        '>";       

        $IdTransaccion = IdTransaccion();
        echo "
        <div class='form-group'>
        <label>Clave de rastreo</label><br>
        <input type='text' id='IdTransaccion' name='IdTransaccion' value='".$IdTransaccion."' style='border:solid 1px ".Preference("ColorPrincipal", "", "").";' class='form-control disable' readonly>
        </div>";

        echo "
        <div class='form-group'>
        <label>Especifique cliente</label><br>
        <select id='IdCliente' class='form-control' onChange='ChecaCorreo();' style='border:solid 1px ".Preference("ColorPrincipal", "", "").";'>";
        echo $ClienteOptions;
        echo "</select>
        </div>";

        echo "
        <div class='form-groupMid'>
        <table width=100% border=0>";
        echo "<tr><td colspan=3><label style='margin:0px;'>Fecha:</label></td></tr>";
        echo "<tr><td class='pc' align=right  valign=top><label style='margin:0px;'><img src='icon/calendar.png' style='width:22px'>";
        echo "</label></td><td align=left valign=top>
        <input type='date' id='Fecha' style='border:solid 1px ".Preference("ColorPrincipal", "", "").";' name='Fecha' class='form-control' value='"; 
        echo $fecha;
        echo "'> ";

        echo "</td></tr></table>
        </div>";

        echo "
        <div class='form-groupMid'>
        <table width=100% border=0>";
        echo "<tr><td colspan=3><label style='margin:0px;'>Cantidad de producto ofertado/vendido</label></td></tr>";
        echo "<tr><td align=left valign=top >
        <input type='number' id='Cantidad' name='Cantidad' class='form-control' value='0' style='border:solid 1px ".Preference("ColorPrincipal", "", "").";'>";
        echo "</td>";
        echo "</tr></table>
        </div>";

        echo "
        <div class='form-groupMid' id='DivCosto'>
        <table width=100% border=0>";
        echo "<tr><td colspan=3><label style='margin:0px;'>Costo de producción</label></td></tr>";

        echo "<tr>";
        echo "<td align=left valign=top width=60%>
        <input type='text' id='Costo' style='border:solid 1px ".Preference("ColorPrincipal", "", "").";' name='Costo' class='form-control'  onBlur='toFinalNumberFormat(this);' placeholder='$#,###.00'  >";
        echo "</td>";
        echo "<td width=30% align=left valign=top>";
        echo "<select id='IdMoneda' name='IdMoneda' class='form-control' style='border:solid 1px ".Preference("ColorPrincipal", "", "").";'>";
        echo $MonedaOptions;
        echo "</select>";
        echo "</td>";
        echo "</tr></table>
        </div>";

        echo "
        <div class='form-groupMid' id='DivPrecio'>
        <table width=100% border=0>";
        echo "<tr><td colspan=3><label style='margin:0px;'>Precio de venta</label></td></tr>";

        echo "<tr>";
        echo "<td align=left valign=top width=60%>
        <input type='text' id='Precio' name='Precio' style='border:solid 1px ".Preference("ColorPrincipal", "", "").";' class='form-control'  onBlur='toFinalNumberFormat(this);' placeholder='$#,###.00'  >";
        echo "</td>";
        echo "<td width=30% align=left valign=top >";
        echo "<select id='IdMoneda' name='IdMoneda' class='form-control' style='border:solid 1px ".Preference("ColorPrincipal", "", "").";'>";
        echo $MonedaOptions;
        echo "</select>";
        echo "</td>";
        echo "</tr></table>
        </div>";

        $OptionsIncoterms = "";
        $OptionsIncoterms.="<option value='EXW'>EXW. (Ex-Works / En Fábrica)</option>";
        $OptionsIncoterms.="<option value='FCA'>FCA (Free Carrier / Libre Transportista)</option>";
        $OptionsIncoterms.="<option value='FAS'>FAS (Free Alongside Ship / Franco al Costado del Buque)</option>";
        $OptionsIncoterms.="<option value='FOB'>FOB (Free On Board / Libre a Bordo)</option>";
        $OptionsIncoterms.="<option value='CFR'>CFR (Cost and Freight / Coste y Flete)</option>";
        $OptionsIncoterms.="<option value='CIF'>CIF (Cost, Insurance and Freight / Coste, Seguro y Flete)</option>";
        $OptionsIncoterms.="<option value='CPT'>CPT (Carriage Paid To / Transporte Pagado Hasta)</option>";
        $OptionsIncoterms.="<option value='CIP'>CIP (Carriage and Insurance Paid To / Transporte y Seguro Pagados Hasta)</option>";
        $OptionsIncoterms.="<option value='DPU'>DPU (Delivered Place Unloaded / Entrega y Descarga en Lugar Acordado)</option>";
        $OptionsIncoterms.="<option value='CIP'>DAP (Delivered At Place / Entregado en un Punto)</option>";
        $OptionsIncoterms.="<option value='DDP'>DDP (Delivered Duty Paid / Entregado con Derechos Pagados):</option>";

        echo "<div id='IncotermsHelp' class='MyModal'>";
        echo "<img src='img/iconterms.jpg' style='width:90%;'>";
        echo "</div>";
        echo "
        <div class='form-group' id='Incoterms'>
        <table width=100% border=0>";
        echo "<tr><td colspan=3><label style='margin:0px;'>Tipo de incoterms: <a href='#IncotermsHelp' rel='MyModal:open'><img src='icon/ayuda.png' style='width:16px;'></a></label></td></tr>";
        echo "<tr>";
        echo "<td  align=left valign=top>";
        echo "<select id='IdIncoterms' name='IdIncoterms' class='form-control' style='border:solid 1px ".Preference("ColorPrincipal", "", "").";'>";
        echo $OptionsIncoterms;
        echo "</select>";
        echo "</td>";
        echo "</tr></table>
        </div>";

        $OptionAdjudicacion = "";
        $OptionAdjudicacion.="<option value='VENTA'>Venta definitiva</option>";
        $OptionAdjudicacion.="<option value='OFERTA'>Ofertar producto</option>";

        echo "<div class='form-groupMid' id='AdjudicacionDiv'> <table width=100% border=0>";
        echo "<tr><td colspan=3><label style='margin:0px;'>Tipo de Adjudicacion: </label></td></tr>";
        echo "<tr>";
        echo "<td  align=left valign=top>";
        echo "<select id='IdAdjudicacion' name='IdAdjudicaion' class='form-control' style='border:solid 1px ".Preference("ColorPrincipal", "", "").";'>";
        echo $OptionAdjudicacion;
        echo "</select>";
        echo "</td>";
        echo "</tr></table>
        </div>";

        echo "<div class='form-groupMid' id='Envio'> <table width=100% border=0>";
        echo "<tr><td colspan=3><label style='margin:0px;'>Tiempo de Envio (Representado en dias): </label></td></tr>";
        echo "<tr>";
        echo "<td  align=left valign=top>";
        echo "<input type='number' id='TiempoDeEnvio' name='TiempoDeEnvio' class='form-control' style='border:solid 1px ".Preference("ColorPrincipal", "", "").";'>";
        echo "</td>";
        echo "</tr></table>
        </div>";

        echo "<div class='form-groupMid' id='MuestraDiv'> <table width=100% border=0>";
        echo "<tr><td colspan=3><label style='margin:0px;'>Cliente solicito MUESTRA</label></td></tr>";
        echo "<tr>";
        echo "<td  align=left valign=top>";
        echo "<select id='Muestra' name='Muestra' class='form-control' style='border:solid 1px ".Preference("ColorPrincipal", "", "").";'>
                <option value='SI'>SI</option>
                <option value='NO'>NO</option>
              </select>";
        echo "</td>";
        echo "</tr></table>
        </div>";





        // if ($ClaveDelProducto == "A"){
        //     $Certificado_General ="";
        //     $Certificado_CocaCola = "";
        //     $sqlCertificado = "select * from Aceites_COA_Certificados where Convert(varchar(max),Batch,103) = '".$IdLote."'";
        //     // echo $sqlCertificado;
                
        //     $IdCon = 2;
        //     $WSSQL = "select * from dbs where IdCon='".$IdCon."' AND Active=1 AND ConType =2"; //SQLSERVERTOJSON
        //     $WSCon = $db0 -> query($WSSQL);
        //     $Produccion = 0;
        //     if($WSConF = $WSCon -> fetch_array())
        //     {
        //         if ($WSConF['wsurl'] <>'' &&  $WSConF['wsmethod']<>'' && $WSConF['wsjson']<>'' )    
        //         {
        //             $WSurl = $WSConF['wsurl'];
        //             $WSmethod = $WSConF['wsmethod'];
        //             $WSjson = $WSConF['wsjson'];
        //             $WSparametros = $WSConF['parametros'];

        //             $wsP1_id = $WSConF['wsP1_id'];  $wsP1_value = $WSConF['wsP1_value'];
        //             $wsP2_id = $WSConF['wsP2_id'];  $wsP2_value = $WSConF['wsP2_value'];
        //             $wsP3_id = $WSConF['wsP3_id'];  $wsP3_value = $WSConF['wsP3_value'];
        //             $wsP4_id = $WSConF['wsP4_id'];  $wsP4_value = $WSConF['wsP4_value'];
        //             $WS_Val = TRUE;        
        //             $url = $WSurl;            
        //             $sql = $sqlCertificado;
        //             $token = $wsP1_value;

        //             //Peticion
        //             $myObj = new stdClass;
        //             $myObj->token = $token;
        //             $myObj->sql = $sqlCertificado;
        //             $myJSON = json_encode($myObj,JSON_UNESCAPED_SLASHES);
                    
        //             $datos_post = http_build_query(
        //                 $myObj
        //             );

        //             $opciones = array('http' =>
        //                 array(
        //                     'method'  => 'POST',
        //                     'header'  => 'Content-type: application/x-www-form-urlencoded',
        //                     'content' => $datos_post
        //                 )
        //             );
        //             ini_set('max_execution_time', 7000);
        //             ini_set('max_execution_time', 0);
        //             $context = stream_context_create($opciones);            
        //             $archivo_web = file_get_contents($url, false, $context);                    
        //             $data = json_decode($archivo_web);
        //             // var_dump($opciones);

        //             $jsonIterator = new RecursiveIteratorIterator(
        //                 new RecursiveArrayIterator(json_decode($archivo_web, TRUE)),
        //                 RecursiveIteratorIterator::SELF_FIRST
        //             );
            
        //             $TablaDeta = "";
        //             $row = 0;    
        //             foreach ($jsonIterator as $key => $val) {
        //                 if (is_numeric($key)){ //rows                        
        //                     $rowC = 0;
        //                 } else {
        //                     // echo $key." = ".$val."<br>";
                    
        //                     if ($val=="Certificado_General"){
        //                         $Certificado_General = "GeneraCertificado_Aceite_FormatoCocaCola.php";
        //                     }

        //                     if ($val=="Certificado_CocaCola"){
        //                         $Certificado_CocaCola = "pdfProcimart2.php";
        //                     }

                            
                        
                    
        //                 $row = $row + 1;    
        //             }
                    
        //             }
        //         }

        //         }
        //     }


        //     if ($Certificado_General <> ''){
                        
        //         echo "
        //         <div class='form-group btn btn-secondary' id='Cert1' >
        //         <table width=100% border=0>";        
        //         echo "<tr>";
        //         echo "<td  align=left valign=middle>";
        //         echo "
        //         <a href='GeneraCertificado_Aceite_FormatoGeneral.php?IdLote=".$IdLote."' title='Haga clic aqui para ver el certificado' download>
        //         <img src='icon/pdf.png' style='width:32px;'>
        //         </a>

        //         ";
        //         echo "</td>";

        //         echo "<td style='font-size:10pt;'>
        //         <a  style='display:block; color:white; text-decoration:none;'  href='GeneraCertificado_Aceite_FormatoGeneral.php?IdLote=".$IdLote."' title='Haga clic aqui para ver el certificado' download>
        //         Certificado General</a></td>";
        //         echo "</tr></table>
        //         </div>
        //         ";
        //     }


            
        //     if ($Certificado_CocaCola <> ''){
                        
        //         echo "
        //         <div class='form-group btn btn-secondary' id='Cert1' >
        //         <table width=100% border=0>";        
        //         echo "<tr>";
        //         echo "<td  align=left valign=middle>";
        //         echo "
        //         <a href='GeneraCertificado_Aceite_FormatoCocaCola.php?IdLote=".$IdLote."' title='Haga clic aqui para ver el certificado' download>
        //         <img src='icon/pdf.png' style='width:32px;'>
        //         </a>

        //         ";
        //         echo "</td>";

        //         echo "<td style='font-size:10pt;'> <a style='display:block; color:white; text-decoration:none;' href='GeneraCertificado_Aceite_FormatoCocaCola.php?IdLote=".$IdLote."' title='Haga clic aqui para ver el certificado' download>
        //         Certificado General</a></td>";
        //         echo "</tr></table>
        //         </div>
        //         ";
        //     }
        


        // echo "
        // <div class='form-group' style='width:97%;'>
        // <label>Texto del Correo que enviara al cliente: <span style='color:#cc4960;' id='Correo'></span> </label><br>
        // <textarea id='CorreoContenido' name='CorreoContenido' class='form-control  '></textarea>
        // </div>
        // ";

        // echo "
        // <div class='form-group' style='width:97%;'>
        // <label>Con copia para:<br>
        // <input   style='width:150%;' type='mail' id='CorreoCopia' name='CorreoCopia' class='form-control  '>
        // </div>
        // ";

        
        echo "
        <div class='form-group' style='width:99%;'>
            <div style='width: 70%; float:left'>
                <label>Texto del Correo que enviara al cliente: <span style='color:#cc4960;' id='Correo'></span> </label><br>
                <textarea id='CorreoContenido' name='CorreoContenido' class='form-control' style='border:solid 1px ".Preference("ColorPrincipal", "", "").";'></textarea>
            </div>
            <div style='width: 1%; float:center'>
            </div>            
            <div style='width: 29%; float:right'>
                <label>Con copia para:<span style='color:#cc4960;' id='ConCopiaPara'></span> </label><br>
                <input   style='width:100%; border: solid 1px ".Preference("ColorPrincipal", "", "").";' type='mail' id='CorreoCopia' name='CorreoCopia' class='form-control'   >
            </div>            
        </div>
        ";


            echo "<div class='form-group btn btn-success' id='btnGuadar' onclick='Save();' >";
            echo "<img src='icon/guardar.png' style='width:32px;'>Guardar Transacción Actual";
            echo "</div>";

            if ($TipoDeInventario == 9) {
                // Inventario de aceite
                $Certificado_General ="";
                $Certificado_CocaCola = "";
                $sqlCertificado = "select * from Aceites_COA_Certificados where IdCertificadoAceite = ".$IdCertificado;
                    
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
                                $sql = $sqlCertificado;
                                $token = $wsP1_value;

                                $myObj = new stdClass;
                                $myObj->token = $token;
                                $myObj->sql = $sqlCertificado;
                                $myJSON = json_encode($myObj,JSON_UNESCAPED_SLASHES);
                        
                                $datos_post = http_build_query($myObj);
                                $opciones = array('http' => array('method'  => 'POST', 'header'  => 'Content-type: application/x-www-form-urlencoded', 'content' => $datos_post));

                                ini_set('max_execution_time', 7000);
                                ini_set('max_execution_time', 0);
                                $context = stream_context_create($opciones);            
                                $archivo_web = file_get_contents($url, false, $context);                    
                                $data = json_decode($archivo_web);

                                $jsonIterator = new RecursiveIteratorIterator(new RecursiveArrayIterator(json_decode($archivo_web, TRUE)), RecursiveIteratorIterator::SELF_FIRST);
                
                                $TablaDeta = "";
                                $row = 0;    
                                foreach ($jsonIterator as $key => $val) 
                                    {
                                        if (is_numeric($key))
                                            {$rowC = 0;}
                                        else
                                            {
                                                if ($val=="Certificado_General")
                                                    {$Certificado_General = "GeneraCertificado_Aceite_FormatoGeneral.php";}

                                                if ($val=="Certificado_CocaCola")
                                                    {$Certificado_CocaCola = "pdfProcimart2.php";}
                                                $row = $row + 1;    
                                            }
                        
                                    }
 
                                if ($Certificado_General <> '')
                                    {
                                        echo "
                                        <div class='form-group btn btn-secondary' id='Cert1' >
                                        <table width=100% border=0>";        
                                        echo "<tr>";
                                        echo "<td  align=left valign=middle>";
                                        echo "
                                        <a href='GeneraCertificado_Aceite_FormatoGeneral.php?Batch=".$IdLote."' title='Haga clic aqui para ver el certificado' download>
                                        <img src='icon/pdf.png' style='width:32px;'>
                                        </a>
                                        ";
                                        echo "</td>";

                                        echo "<td style='font-size:10pt;'> <a  style='display:block; color:white; text-decoration:none;'  href='GeneraCertificado_Aceite_FormatoGeneral.php?Batch=".$IdLote."' title='Haga clic aqui para ver el certificado' download>Descargar Certificado del producto</a></td>";
                                        echo "</tr></table>
                                        </div>
                                        ";
                                    }

                                    if ($Certificado_CocaCola <> '')
                                        {
                                            echo "
                                            <div class='form-group btn btn-secondary' id='Cert1' >
                                            <table width=100% border=0>";        
                                            echo "<tr>";
                                            echo "<td  align=left valign=middle>";
                                            echo "
                                            <a href='GeneraCertificado_Aceite_FormatoCocaCola.php?Batch=".$IdLote."' title='Haga clic aqui para ver el certificado' download>
                                            <img src='icon/pdf.png' style='width:32px;'>
                                            </a>
                                            ";
                                            echo "</td>";

                                            echo "<td style='font-size:10pt;'> <a style='display:block; color:white; text-decoration:none;' href='GeneraCertificado_Aceite_FormatoCocaCola.php?Batch=".$IdLote."' title='Haga clic aqui para ver el certificado' download>Descargar Certificado del producto</a></td>";
                                            echo "</tr></table>
                                            </div>
                                            ";
                                        }
            
                            }
                    }
            }
        else
            if ($TipoDeInventario == 10) 
                {
                    //Producto sobrante

                }
            else 
                if ($TipoDeInventario == 8) 
                    {
                        //Producto Cascara
                        
                    }
                else 
                    if ($TipoDeInventario == 8) 
                        {
                            //Producto PULPA - Orgánica, PULPA - Convencional, NFC - Convencional, NFC - Orgánico, CONCENTRADO - Convencional, CONCENTRADO - Orgánico

                        }

            //echo "<a href='app_movs.php' class='form-group btn btn-primary' id='btnGuadar' >";
            //echo "<img src='icon/permisos.png' style='width:32px;'> Movimientos";
            //echo "</a>";

            echo "<div class='form-group ' id='btnGuadar' id='InfoMov' >";
            echo "</div>";

            echo "</div>";
            echo "</div>";
            echo "<div id='DetallesVender'><h4>Especificaciones del producto</h4>".$TablaDetaT."</div>";
        
}


function DesTipo($Tipo){

    switch ($Tipo) {
        case 6:
            return "CONCENTRADO - Convencional - 6";
            break;
    
        case 7:
            return "CONCENTRADO - Orgánico - 7";
            break;

        case 4:
            return "NFC - Convencional - 4";
            break;

        case 5:
            return "NFC - Orgánico - 5";
            break;

        case 3:
            return "PULPA - Convencional - 3";
            break;

        case 2:
            return "PULPA - Orgánica - 2";
            break;
        
        default:
            return "";
        break;
    
    }



}

?>


<script>
// $("#Cantidad").bind('keyup mouseup', function () {
//     Cantidad = $('#Cantidad').val();
//     Produccion =  $('#Produccion').val();
//     PreInventario = Produccion - Cantidad;
//     $('#LProduccion').html(PreInventario)      
// });


function Save(){
    go = "";
    
    if ($('#IdCliente').val()==''){
        $('#IdCliente').css('outline', 'solid 1px red'); 
        go = "FALSE";
        $.toast({heading: 'Error', text: 'Selecciona el Cliente', showHideTransition: 'slide', icon: 'error'})
    } else {$('#IdCliente').css('outline', 'solid 0px red'); }

    if ($('#Cantidad').val()<=0){
        $('#Cantidad').css('outline', 'solid 1px red'); 
        $go = "FALSE";
        $.toast({heading: 'Error', text: 'Ingresa el una Cantidad', showHideTransition: 'slide', icon: 'error'})
    } else {$('#Cantidad').css('outline', 'solid 0px red'); }

    if ($('#Costo').val().replace('$','') == '0.00'  || $('#Costo').val().replace('$','') == '00.00' || $('#Costo').val().replace('$','') == '0' || $('#Costo').val().replace('$','') == '') {
        $('#Costo').css('outline', 'solid 1px red'); 
        $go = "FALSE";
        $.toast({heading: 'Error', text: 'Debe ingresar un Costo', showHideTransition: 'slide', icon: 'error'})
    }else {$('#Costo').css('outline', 'solid 0px red'); }

if (go == ''){
    $('#PreLoader').show();
    IdTransaccion = $('#IdTransaccion').val();
    IdCliente = $('#IdCliente').val();
    IdClienteName = $("#IdCliente option:selected").text();
    FechaOperacion = $("#Fecha").val();
    Cantidad = $('#Cantidad').val();
    Costo = $('#Costo').val().replace('$','');
    Precio = $('#Precio').val().replace('$','');
    IdIncoterms = $('#IdIncoterms').val();
    IdIncotermsName = $('#IdIncoterms option:selected').text();
    TiempoDeEnvio = $('#TiempoDeEnvio').val();
    Muestra = $('#Muestra').val();
    IdAdjudicacion = $('#IdAdjudicacion').val();
    CorreoContenido = $('#CorreoContenido').val();
    CorreoCopia = $('#CorreoCopia').val();

    $.ajax({
        url: 'app_vender_data.php',
        type: 'post',
        data: {
            IdUser: '<?php echo $RinteraUser; ?>',              
            IdProducto: '<?php echo $IdProducto; ?>',              
            ClaveDelProducto: '<?php echo $ClaveDelProducto; ?>',              
            Tipo: '<?php echo DesTipo($Tipo); ?>',              
            IdLote: '<?php echo $IdLote; ?>',              
            IdTransaccion : IdTransaccion,
            IdCliente: IdCliente,
            IdClienteName:IdClienteName,
            FechaOperacion:FechaOperacion,
            Cantidad:Cantidad,
            Costo:Costo,
            Precio:Precio,
            IdIncoterms:IdIncoterms,
            IdIncotermsName: IdIncotermsName,
            TiempoDeEnvio:TiempoDeEnvio,
            Muestra:Muestra,
            IdAdjudicacion:IdAdjudicacion,
            CorreoContenido: CorreoContenido,
            CorreoCopia: CorreoCopia
        },
        success: function(data) {
            $('#R').html(data);
            $('#PreLoader').hide();
        }
    }); 
}

}
function ChecaCorreo(){
    IdCliente = $('#IdCliente').val();
    $.ajax({
        url: 'checacorreo.php',
        type: 'post',
        data: {
            IdCliente:IdCliente            
        },
        success: function(data) {
            $('#Correo').html(data);
            
        }
    }); 


}



function CargaMovs(IdProducto, Tipo){
    $.ajax({
        url: 'app_cargamovs2.php',
        type: 'post',
        data: {
            IdProducto:IdProducto,
            Tipo:Tipo
        },
        success: function(data) {
            $('#InfoMov').html(data);
            $('#PreLoader').hide();
        }
    }); 


}
CargaMovs("");
function toFinalNumberFormat(controlToCheck){
var enteredNumber = '' + controlToCheck.value;
enteredNumber = enteredNumber.replace(/[^0-9\.]+/g, ''); // remove any non-numeric, non-period character
controlToCheck.value = Number(enteredNumber).toLocaleString('en-US', { style: 'currency', currency: 'USD' }); // Number(enteredNumber).toLocaleString('en'); // enteredNumber.toLocaleString('en-US', { style: 'currency', currency: 'USD' });
}

</script>
<?php
include("footer.php");
?>