<?php
include("head.php");
$IdAceiteLote = VarClean($_GET['id']);
$Tipo = VarClean($_GET['tipo']);
$ClaveDelProducto = Procimart_ClaveProducto($Tipo);
$ClaveDelProducto_id_rep = ClaveDelProducto_id_rep($ClaveDelProducto);


$id_rep = $ClaveDelProducto_id_rep; //Consulta para esa clave de producto
// $TipoReporte = ReporteTipo($id_rep); // $Tipo = 1; // 0 = html, 1= DataTable, 2 = PDF, 3 = Excel, 4 = Word
$TipoReporte = 1; $ClaseTabla ="tabla"; $ClaseDiv="col-12"; 
$Data =  DataFromSQLSERVERTOJSON($id_rep, $TipoReporte, $ClaseTabla, $ClaseDiv, $RinteraUser);


echo "<div class='row'>".$Data."</div>";

echo "<div style='font-size:7pt; color:gray;'>Id=".$IdAceiteLote.", Tipo=".$Tipo.", ClaveDelProducto=".$ClaveDelProducto.", idReporte=".$id_rep."</div>";



include("footer.php");
?>