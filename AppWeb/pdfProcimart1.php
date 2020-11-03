<?php


require("app_funciones.php");
require("components.php");
require("rintera-config.php");
$IdLote = VarClean($_GET['IdLote']);
$sqlCertificado = "select * from Aceites_COA_Certificados where Convert(varchar(max),Batch,103) = '".$IdLote."'";


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
           
                if ($key == "CertificateType" and $val=="Certificado_General"){
                    $Certificado_General = "pdfProcimart1.php";
                }

                if ($key == "CertificateType" and  $val=="Certificado_CocaCola"){
                    $Certificado_CocaCola = "pdfProcimart2.php";
                }

                if ($key == "NameOfProduct") {
                    $material = $val;
                }

                if ($key == "Batch") {
                    $batch = $val;
                      // $batch = 'LPACT01/19';
                }
                           
                $supplier = 'PROCIMART S.A. de C.V.';

                if ($key == "ProductionDate") {
                    $productiondate = $val;
                }

                if ($key == "ExpiryDate") {
                    $expirydate = $val;
                }

                // //RESULTADOS
                if ($key == "Aldheydes") {
                    if ($val == ''){
                        $aldheydes = $val." N/A";
                    } else {
                        $aldheydes = $val." % ";
                    }
                }
                
                if ($key == "GasCromatogram") {
                    $gascromatogram = $val." ";
                }
               
                if ($key == "OpticalRotation") {
                    $opticalrotation = $val." ";
                }

                if ($key == "RefractiveIndex") {
                    $refractive = $val." ";
                }

                if ($key == "SpecificGravity") {
                    $gravity = $val." ";
                }

                if ($key == "AlcoholSolubility") {
                    $alcohol = $val." ";
                }

                if ($key == "ColdHaze") {
                    $coldhaze = $val." ";
                }

                if ($key == "Appearance") {
                    $appearance = $val." ";
                }

                if ($key == "TasteAndOdor") {
                    $taste = $val." ";
                }

                if ($key == "ErWeight") {
                    $erweight = $val." ";
                }
                
                if ($key == "GallDrum") {
                    if ($val == ''){
                        $galldrum = $val."N/A";
                    } else {
                        $galldrum = $val." ";
                    }
                    
                }
                
                if ($key == "NetWeigth") {
                    if ($val == ''){
                        $netweight = $val."N/A";
                    } else {
                        $netweight = $val." ";
                    }
                    
                }
                
                             
                if ($key == "ToDrum") {
                    if ($val == ''){
                        $todrum = $val."N/A";
                    } else {
                        $todrum = $val." ";
                    }
                    
                }
                

                if ($key == "OfDrum") {
                    if ($val == ''){
                        $ofdrum = $val."N/A";
                    } else {
                        $ofdrum = $val." ";
                    }
                    
                }
                
              
                if ($key == "NDrums") {
                    if ($val == ''){
                        $ndrums = $val."N/A";
                    } else {
                        $ndrums = $val." ";
                    }
                    
                }
              
                if ($key == "Additives") {
                    if ($val == ''){
                        $additives = $val."N/A";
                    } else {
                        $additives = $val." ";
                    }
                    
                }
                
            
                if ($key == "QualityAssurance") {
                    
                        $QualityAssurance  = $val;
                    
                    
                }
              
              
              
             
                
               
              
            
            
           
           
            $row = $row + 1;    
        }
         
        }
    }

}



ob_start();
require_once('lib/pdf/tcpdf.php');


$hoy = date("F j, Y");


$orientacion='P';
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
// set document information


$pdf->setPrintHeader(false);
$pdf->SetCreator(PDF_CREATOR);

$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
//$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
//$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
//$pdf->SetFooterData("Impreso: ".fecha_larga($fecha).", ".hora12($hora)." por ".nitavu_nombre($nitavu),array(0, 64, 0),array(0, 64, 128));
//$pdf->SetFooterData('c', 0, 'xd', 'hola');
// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'lib/pdf/lang/eng.php')) {
	require_once(dirname(__FILE__).'lib/pdf/lang/eng.php');
	$pdf->setLanguageArray($l);
}

//$pdf->AddFont('basisgrotesqueprolight');        //custom font
$pdf->AddFont('basisgrotesqueprolight', '', '' . "'basisgrotesqueprolight'.php");
// set font
$pdf->SetFont('basisgrotesqueprolight', '', 9,'',true);

// add a page
$pdf->AddPage($orientacion, 'LETTER');
//$pdf->Cell(0, 0, 'A4 LANDSCAPE', 1, 1, 'C');
//$pdf->AddPage($orientacion); //en la tabla de reporte L o P


$encabezado ="";
$encabezado  = $encabezado .'
<table width="100%" cellpadding="1" cellspacing="1" border="1" style="text-align:center;"> 
<tr>
    <td width="50%" height="80px" style="text-align:center;" rowspan="2"><img src="img/Logo_large.png" alt="test alt attribute" border="0" width="300px" height="80px" align="middle"/></td>
    <td width="50%"  height="40px" style="text-align:center;"><p  style="font-size:14px"><br>CERTIFICATE OF ANALYSIS</p></td>
</tr>
<tr>
    <td width="50%" height="40px" style="text-align:center;" ><p style="font-size:14px">QUALITY ASSURANCE</p></td>
</tr>
</table>
';

//$toolcopy = ' my content <br>';
//$toolcopy .= '<img src="logo.jpg"  width="50" height="50">';
//$toolcopy .= '<br> other content';

$pdf->writeHTML($encabezado, true, false, true, false,'');

$pdf->AddFont('basisgrotesqueprob', '', '' . "'basisgrotesqueprob'.php");

// set font
$pdf->SetFont('basisgrotesqueprob', '', 10,'',true);


$cont="";
$cont = $cont.'<table border="0" cellpadding="0" cellspacing="0"><tr><td width="30px"></td>
<td><table width="600px" border="0" cellpadding="0" cellspacing="0"><tr><td align="right"><b>F-AC-31</b></td></tr>
<tr><td width="50%"><b>NAME OF PRODUCT</b></td> <td width="50%" align="center"><b> Cold Pressed Lime Oil: </b></td> </tr>
</table></td>
<td width="30px"></td></tr></table>
';

$pdf->writeHTML($cont, true, false, true, false,'');

$tabla = '';
$tabla = $tabla.'<table style="vertical-align:top" cellspacing="0" cellpadding="0">
<tr><td width="50%" height="30px" align="right"><div style="font-size:10pt">&nbsp;</div> Production date </td>         <td width="50%" height="30px" border="1" align="center"><div style="font-size:10pt">&nbsp;</div>'.$productiondate.'</td>            </tr>
<tr><td width="50%" height="30px" align="right"><div style="font-size:10pt">&nbsp;</div> Expiry date  </td>                     <td width="50%" height="30px" border="1" align="center"><div style="font-size:10pt">&nbsp;</div>'.$expirydate.'</td>            </tr>
<tr><td width="50%" height="30px" align="right"><div style="font-size:10pt">&nbsp;</div> Batch  </td>            <td width="50%" height="30px" border="1"align="center"><div style="font-size:10pt">&nbsp;</div>'.$batch.'</td>            </tr>
<tr><td width="50%" height="30px" align="right"><div style="font-size:10pt">&nbsp;</div> gall/drum  </td>            <td width="50%" height="30px" border="1" align="center"><div style="font-size:10pt">&nbsp;</div>'.$galldrum.'</td>            </tr>
<tr><td width="50%" height="30px" align="right"><div style="font-size:10pt">&nbsp;</div> Net weigth (kg)  </td>         <td width="50%" height="30px" border="1" align="center"><div style="font-size:10pt">&nbsp;</div>'.$netweight.'</td>            </tr>
<tr><td width="50%" height="30px" align="right"><div style="font-size:10pt">&nbsp;</div> Of drum  </td>   <td width="50%" height="30px" border="1" align="center"><div style="font-size:10pt">&nbsp;</div>'.$ofdrum.'</td>        </tr>
<tr><td width="50%" height="30px" align="right"><div style="font-size:10pt">&nbsp;</div> To drum  </td>          <td width="50%" height="30px" border="1" align="center"><div style="font-size:10pt">&nbsp;</div>'.$todrum.'</td>            </tr>
<tr><td width="50%" height="30px" align="right"><div style="font-size:10pt">&nbsp;</div> N. drums  </td>                           <td width="50%" height="30px" border="1" align="center"><div style="font-size:10pt">&nbsp;</div>'.$ndrums.'</td>            </tr>
<tr><td width="50%" height="30px" align="right"><div style="font-size:10pt">&nbsp;</div> Additives  </td>                      <td width="50%" height="30px" border="1" align="center"><div style="font-size:10pt">&nbsp;</div>'.$additives.'</td>            </tr>
<tr><td width="50%" height="30px" align="right"><div style="font-size:10pt">&nbsp;</div> Aldheydes (wt%) by tritation:  </td>                       <td width="50%" height="30px" border="1" align="center"><div style="font-size:10pt">&nbsp;</div>'.$aldheydes.'</td>            </tr>
<tr><td width="50%" height="30px" align="right"><div style="font-size:10pt">&nbsp;</div> Gas Cromatogram:  </td>                            <td width="50%" height="30px" border="1" align="center"><div style="font-size:10pt">&nbsp;</div>'.$gascromatogram.'</td>            </tr>
<tr><td width="50%" height="30px" align="right"><div style="font-size:10pt">&nbsp;</div> Optical Rotation @ 25 ° C:  </td>                                     <td width="50%" height="30px" border="1" align="center"><div style="font-size:10pt">&nbsp;</div>'.$opticalrotation.'</td>            </tr>
<tr><td width="50%" height="30px" align="right"><div style="font-size:10pt">&nbsp;</div> Refractive Index @ 20° C:  </td>                                     <td width="50%" height="30px" border="1" align="center"><div style="font-size:10pt">&nbsp;</div>'.$refractive.'</td>            </tr>
<tr><td width="50%" height="30px" align="right"><div style="font-size:10pt">&nbsp;</div> Specific Gravity @ 25/25° C:  </td>                                     <td width="50%" height="30px" border="1" align="center"><div style="font-size:10pt">&nbsp;</div>'.$gravity.'</td>            </tr>
<tr><td width="50%" height="30px" align="right"><div style="font-size:10pt">&nbsp;</div> Alcohol Solubility Test (Pass/Fail):  </td>                                     <td width="50%" height="30px" border="1" align="center"><div style="font-size:10pt">&nbsp;</div>'.$alcohol.'</td>            </tr>
<tr><td width="50%" height="30px" align="right"><div style="font-size:10pt">&nbsp;</div> Cold/Haze Test (Pass/Fail):  </td>                                     <td width="50%" height="30px" border="1" align="center"><div style="font-size:10pt">&nbsp;</div>'.$coldhaze.'</td>            </tr>
<tr><td width="50%" height="30px" align="right"><div style="font-size:10pt">&nbsp;</div> Appearance:  </td>                                     <td width="50%" height="30px" border="1" align="center"><div style="font-size:10pt">&nbsp;</div>'.$appearance.'</td>            </tr>
<tr><td width="50%" height="30px" align="right"><div style="font-size:10pt">&nbsp;</div> Taste and Odor:  </td>                                     <td width="50%" height="30px" border="1" align="center"><div style="font-size:10pt">&nbsp;</div>'.$taste.'</td>            </tr>
<tr><td width="50%" height="30px" align="right"><div style="font-size:10pt">&nbsp;</div> E.R. % weight:  </td>                                     <td width="50%" height="30px" border="1" align="center"><div style="font-size:10pt">&nbsp;</div>'.$erweight.'</td>            </tr>

</table></center>

<BR><BR><BR><BR><BR><BR>
<table width="100%;"><tr><td width="30%;"></td>
<td width="40%;">
<table  align="center ">
<tr>
    <td style="border-bottom:1pt solid black;"></td>
</tr>
<tr>
    <td>'.$QualityAssurance.'</td>
</tr>
<tr>
    <td> Quality Assurance</td>
</tr>
<tr>
    <td>PROCIMART S.A. de C.V.</td>
</tr>
</table>
</td>
<td width="30%;"></td></td></table>
';

//$pdf->AddFont('basisgrotesqueprolight');        //custom font
$pdf->AddFont('basisgrotesqueprolight', '', '' . "'basisgrotesqueprolight'.php");
// set font
$pdf->SetFont('basisgrotesqueprolight', '', 9,'',true);

$pdf->writeHTML($tabla, true, false, true, false, '');
//echo $toolcopy;
//echo $html;
// reset pointer to the last page
$pdf->lastPage();
//Close and output PDF document}
ob_end_clean();
$pdf->Output('reporte.pdf', 'I');


?>