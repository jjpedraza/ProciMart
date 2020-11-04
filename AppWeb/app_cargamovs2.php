<?php
require ("rintera-config.php");
require ("components.php");
require ("app_funciones.php");
include("seguridad.php");



// $IdProducto = VarClean($_POST['IdProducto']);
// $Tipo = VarClean($_POST['Tipo']);
$sql = "
Select 
CONCAT(Adjudicacion,'<br><b>',Producto, '</b><br>', Cantidad, ' - $',Costo, '<br><cite>',Cliente,'</cite>') as Producto,
X

from Movs order by IdMov DESC";
$IdTabla = "MiTabl2a";
$Clase = "tabla ReporteFooter ";
$db= 0 ;        
echo "<h5>Movimientos de productos: </h5>";
DynamicTable_MySQL($sql, "DivUsuarios2", $IdTabla, $Clase, 0, $db);
?>