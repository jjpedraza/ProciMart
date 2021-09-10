<?php
    include("head.php");
    include("header.php");

    $IdCertificado =  VarClean($_GET['idCer']);
    $Tipo = VarClean($_GET['tipo']);
    $TipoDeInventario = (int)$Tipo;
    $IdRegreso = VarClean($_GET['back']);

    $Footer  =  ReporteFooter($IdRegreso);
    $Titulo = ""."".ReporteEncabezado($IdRegreso)."";
    $BotonRegresar = "<div style='margin-top:5px; text-align:right; margin-right:5px;'> <a href='r.php?id=".$IdRegreso."' class='btn btn-secondary' style='font-size:8pt;'><img src='icon/btn_izquierda.png' style='width:18px;'> Regresar</a><br></div>";

    echo "<div id='DetallesTitulo' style='background-color: #82828224; width: 98%; border-radius: 5px;'>"; 
    echo "<table width=100%><tr><td>";
        echo $Titulo."";
    echo "</td><td width=7%>";
    echo $BotonRegresar;
    echo "</td></tr></table>";
    echo "</div>";

    if ($TipoDeInventario == 9) {
        $QueryDetalle = "
        SELECT IdCertificado, Fecha, Turno, Producto, LoteNum, TanquePF, Temperatura, TipoDeEnvasado, Disponibilidad, PesoBruto, PesoTara, PesoNeto, PorcAlcohol, Aldehidos, Re, Opp, Trifluralin, 
        Dimetoato, MetilParation, Malation, Clorpirifos, Etion, Pybutrin, Fenpropatrin, Fthalato, Permetrina, Cyflutrin, Dicofol, Bifentrina, Dybutil, Decision, CausaDeRechazo
        FROM Laboratorio_DetalleDelLote Where IdCertificado = '".$IdCertificado."'";
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

    include("footer.php");
?>