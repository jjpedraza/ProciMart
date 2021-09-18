<?php
require ("rintera-config.php");
require ("components.php");
require ("app_funciones.php");
include("seguridad.php");



// $IdProducto = VarClean($_POST['IdProducto']);
// $Tipo = VarClean($_POST['Tipo']);
$sql = "
Select 
IdMov,
Adjudicacion,
Producto as NumLote,
Cantidad,
Costo as Precio,
Cliente
from movs order by IdMov DESC";
$IdTabla = "MiTabla";
$Clase = "tabla ReporteFooter ";
$db= 0 ;        
echo "<h5>Movimientos de productos</h5>";
DynamicTable_MySQL($sql, "DivUsuarios", $IdTabla, $Clase, 0, $db);
?>