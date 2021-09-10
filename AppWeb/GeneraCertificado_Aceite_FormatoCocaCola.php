<?php
    ob_start();

    require("app_funciones.php");
    require("components.php");
    require("rintera-config.php");

    $LoteNum = VarClean($_GET['Batch']);
    $Script = "select * from Aceites_COA_Certificados where Convert(varchar(max),Batch,103) = '".$LoteNum."'";

    $hoy = date("F j, Y");

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
            $sql = $Script;
            $token = $wsP1_value;

            //Peticion
            $myObj = new stdClass;
            $myObj->token = $token;
            $myObj->sql = $Script;
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
            
                    if ($key == "CertificateType" and $val=="Certificado_General"){$Certificado_General = "GeneraCertificado_Aceite_FormatoGeneral.php";}
                    if ($key == "CertificateType" and  $val=="Certificado_CocaCola"){$Certificado_CocaCola = "pdfProcimart2.php";}
                    if ($key == "NameOfProduct") {$material = $val;}
                    if ($key == "Batch") {$lotnumber = $val;}
                    $supplier = 'PROCIMART S.A. de C.V.';
                    if ($key == "ProductionDate") {$dateofManufacture = $val;}
                    if ($key == "ExpiryDate") {$dateofExpiration = $val;}

                    // //RESULTADOS
                    if ($key == "Aldheydes") {$aldheydesR = $val." % ";}
                    if ($key == "GasCromatogram") {$gasR = $val." ";}
                    if ($key == "OpticalRotation") {$opticalR = $val." ";}
                    if ($key == "RefractiveIndex") {$refractiveR = $val." ";}
                    if ($key == "SpecificGravity") {$gravityR = $val." ";}
                    if ($key == "AlcoholSolubility") {$alcoholR = $val." ";}
                    if ($key == "ColdHaze") {$coldhazeR = $val." ";}
                    if ($key == "Appearance") {$apperanceR = $val." ";}
                    if ($key == "TasteAndOdor") {$tasteR = $val." ";}
                    if ($key == "ErWeight") {$erweightR = $val." ";}
                    if ($key == "Comments") {$comments = $val." ";}

                    // //ESPECIFICACIONES
                    if ($key == "Aldheydes_Rangos") {$aldheydesS = $val." ";}
                    if ($key == "GasCromatogram_Rangos") {$gasS = $val." ";}  
                    if ($key == "OpticalRotation_Rangos") {$opticalS = $val." ";}  
                    if ($key == "RefractiveIndex_Rangos") {$refractiveS = $val." ";}  
                    if ($key == "SpecificGravity_Rangos") {$gravityS = $val." ";}
                    if ($key == "AlcoholSolubility_Rangos") {$alcoholS = $val." ";}
                    if ($key == "ColdHaze_Rangos") {$coldhazeS = $val." ";}
                    if ($key == "Appearance_Rangos") {$apperanceS = $val." ";}
                    if ($key == "TasteAndOdor_Rangos") {$tasteS = $val." ";}
                    if ($key == "ErWeight_Rangos") {$erweightS = $val." ";}

                    // //FIRMAS
                    // $submittedby  = 'Marco Gutiérrez Castillo';
                    if ($key == "QualityAssurance") {
                        $submittedby = $val." ";
                    }
                
            
                $row = $row + 1;    
            }
            
            }
        }
    }

    require_once('lib/tcpdf/tcpdf_include.php');
    
    $date = $hoy;

    $orientacion='P';
    $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
    $pdf->setPrintHeader(false);
    $pdf->SetCreator(PDF_CREATOR);

    $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
    $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
    $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
    $pdf->SetMargins(PDF_MARGIN_LEFT, 10, PDF_MARGIN_RIGHT);
    $pdf->SetAutoPageBreak(TRUE, 10);
    $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

    if (@file_exists(dirname(__FILE__).'/lib/pdf/lang/eng.php')) 
        {
            require_once(dirname(__FILE__).'/lib/pdf/lang/eng.php');
            $pdf->setLanguageArray($l);
        }

    $pdf->SetFont('courier', '', 10);
    $pdf->AddPage($orientacion, 'LETTER');
    $html = $cont;

    $encabezado ="";
    $encabezado = "<center>";
    $encabezado  = $encabezado .'<table width="90%"> 
    <tr>
        <td align="right"><img src="img/Logo_large.jpg"  width="200" height="50"></td>
        <td align="left"><p style="font-size:14px">Certificate of Analysis</p></td>
    </tr>
    </table>';
    $encabezado = $encabezado."<center>";

    $pdf->writeHTML($encabezado, true, false, true, false,'');

    $cont="";
    $cont = $cont."<br><br><br>";
    $cont = $cont.'

    <table align="center">
        <tr>
            <td width="80px">Material</td>  <td style="border-bottom:1pt solid black;">'.$material.'</td> <td>Supplier: </td> <td style="border-bottom:1pt solid black;" width="250px">'.$supplier.'</td>
        </tr>
        <tr>
            <td width="80px">Lot Number</td>  <td style="border-bottom:1pt solid black;"><b>'.$lotnumber.'</b></td> <td>Date of Manufacture: </td> <td style="border-bottom:1pt solid black;" width="250px">'.$dateofManufacture.'</td>
        </tr>
        <tr>
            <td></td>  <td></td> <td>Date of Expiration: </td> <td style="border-bottom:1pt solid black;" width="250px">'.$dateofExpiration.'</td>
        </tr>
    </table>

    <BR><BR>
    <center><table width="90%" align="center">
    <tr><td width="50%">ANALYSIS</td>                                           <td width="165px"><b> RESULTS: </b></td>      <td width="165px"><b>SPECIFICATIONS:</b></td></tr>
    <tr><td width="50%" align="right" height="23px">Aldheydes (wt%) by triation:</td>         <td width="165px" border="1">'.$aldheydesR.'</td>            <td width="165px" border="1">'.$aldheydesS.'</td></tr>
    <tr><td width="50%" align="right" height="23px">Gas Cromatogram:</td>                     <td width="165px" border="1">'.$gasR.'</td>            <td width="165px" border="1">'.$gasS.'</td></tr>
    <tr><td width="50%" align="right" height="23px">Optical Rotation @ 25 °C:</td>            <td width="165px" border="1">'.$opticalR.'</td>            <td width="165px" border="1">'.$opticalS.'</td></tr>
    <tr><td width="50%" align="right" height="23px">Refractive Index @ 20 °C:</td>            <td width="165px" border="1">'.$refractiveR.'</td>            <td width="165px" border="1">'.$refractiveS.'</td></tr>
    <tr><td width="50%" align="right" height="23px">Specific Gravity @ 25/25 °C:</td>         <td width="165px" border="1">'.$gravityR.'</td>            <td width="165px" border="1">'.$gravityS.'</td></tr>
    <tr><td width="50%" align="right" height="23px">Alcohol Solubility Test (Pass / Fail):</td>   <td width="165px" border="1">'.$alcoholR.'</td>            <td width="165px" border="1">'.$alcoholS.'</td></tr>
    <tr><td width="50%" align="right" height="23px">Cold/Haze Test (Pass/Fail):</td>          <td width="165px" border="1">'.$coldhazeR.'</td>            <td width="165px" border="1">'.$coldhazeS.'</td></tr>
    <tr><td width="50%" align="right" height="23px">Apperance:</td>                           <td width="165px" border="1">'.$apperanceR.'</td>            <td width="165px" border="1">'.$apperanceS.'</td></tr>
    <tr><td width="50%" align="right" height="23px">Taste and Odor:</td>                      <td width="165px" border="1">'.$tasteR.'</td>            <td width="165px" border="1">'.$tasteS.'</td></tr>
    <tr><td width="50%" align="right" height="23px">E.R. % weight:</td>                       <td width="165px" border="1">'.$erweightR.'</td>            <td width="165px" border="1">'.$erweightS.'</td></tr>
    <tr><td width="50%" align="right" height="23px">Comments:</td>                            <td border="1" colspan="2">'.$comments.'</td>            </tr>
    <tr><td width="50%" align="right" height="23px"></td>                                     <td border="1" colspan="2"></td>            </tr>
    </table></center>

    <BR><BR><BR>
    <p>COMMENTS:</p><BR>

    <table>
        <tr><td width="165px">Pass:</td>              <td width="80%">Clear with not peripitate or very slight amount of precipitate</td></tr>
        <tr><td width="165px">Fail:</td>              <td width="80%">Turbid and / or moderate to heavy precipitate</td></tr>
        <tr><td width="165px">Cold / Haze Test:</td>  <td width="80%">Run for 48 hrs @ 4°C.</td></tr>
        <tr><td width="165px">Appearance:</td>        <td width="80%">Color, clear, no clear, etc.</td></tr>
        <tr><td width="165px">E.R.% Weight:</td>      <td width="80%">Evaporation Residue.</td></tr>
    </table>

    <BR><BR><BR><BR>
    <table><tr><td>This ingredient is considered NOT genetically modified or NOT derived from a genetically organism as defined by the EC directives 
    1830/2033/EC on labeling and traceability and 1829/2003/EC on genetically modifiedfoot and feed and any amending legislation.</td></tr></table>

    <BR><BR><BR><BR><BR><BR><BR>
    <table>
    <tr>
        <td width="100px;">Submitted by:</td> <td width="250px;" style="border-bottom:1pt solid black;"> '.$submittedby.'</td>
        <td width="100px;" align="right">Date:</td>         <td width="180px;" style="border-bottom:1pt solid black;"> '.$dateofManufacture.'</td>
    </tr>
    </table>
    <BR>
    <BR>
    <center><p style="font-size:8px">Carretera Victoria Monterrey Km 12.9 Ej, Tierra Nueva Cd. Victoria, Tam. México C.P. 87261 (52) 834 31 8030    (52)834 31 80309</p></center>';

    $pdf->writeHTML($cont, true, 0, true, 0);
    $pdf->writeHTML($html, true, false, true, false, '');
    $pdf->lastPage();

    ob_end_clean();
    $pdf->Output($lotnumber.'.pdf', 'I');
?>