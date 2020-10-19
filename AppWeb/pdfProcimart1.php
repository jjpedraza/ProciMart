<?php
ob_start();
require_once('lib/pdf/tcpdf.php');


$hoy = date("F j, Y");

$productiondate = $hoy;
$expirydate = 'June 31, 2019';
$batch = 'LPACT01/19';
$galldrum = 'N/A';
$netweight = '10,500';
$ofdrum = '01';
$todrum = '60';
$ndrums = '60';
$additives = 'Absent';
$aldheydes = '4.57%';
$gascromatogram = '-';
$opticalrotation = '-';
$refractive = '1.4842';
$gravity = '0.8817';
$alcohol = 'N/A';
$coldhaze = 'N/A';
$appearance = 'Characteristic';
$taste = 'Characteristic';
$erweight = '11.33';



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
    <td>Marco Antonio Gutiérrez</td>
</tr>
<tr>
    <td>Quality Assurance</td>
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