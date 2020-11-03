<?php
require ("rintera-config.php");
require ("components.php");
require ("app_funciones.php");
include("seguridad.php");



$IdProducto = VarClean($_POST['IdProducto']);
$Tipo = VarClean($_POST['Tipo']);
$sql = "select 
CONCAT(IdAdjudicacion,' - ',FechaOperacion) as Adjudicacion,
CONCAT('(',IdLote,') ',Tipo, ' - ',IdProducto,'(', IdIncoterms,')') as Producto,
Cantidad,
Costo,
IdClienteName as Cliente


from 
productosmov

order by Fecha DESC, Hora DESC";
$IdTabla = "MiTabla";
$Clase = "tabla ReporteFooter ";
$db= 0 ;        
echo "<hr><h5>Movimientos de este producto: </h5>";
DynamicTable_MySQL($sql, "DivUsuarios", $IdTabla, $Clase, 0, $db);
?>