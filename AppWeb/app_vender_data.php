<?php
require ("rintera-config.php");
require ("components.php");
require ("app_funciones.php");
include("seguridad.php");



$IdProducto = VarClean($_POST['IdProducto']);
$Tipo = VarClean($_POST['Tipo']);
$ClaveDelProducto = VarClean($_POST['ClaveDelProducto']);
$IdLote = VarClean($_POST['IdLote']);

$IdUser  = VarClean($_POST['IdUser']);
$IdTransaccion = VarClean($_POST['IdTransaccion']);
$IdCliente = VarClean($_POST['IdCliente']);
$IdClienteName = VarClean($_POST['IdClienteName']);
$FechaOperacion = VarClean($_POST['FechaOperacion']);
// echo "Fecha Operacion = ".$FechaOperacion;
$Cantidad = VarClean($_POST['Cantidad']);
$Costo = VarClean($_POST['Costo']);
$IdIncoterms = VarClean($_POST['IdIncoterms']);
$IdIncotermsName = VarClean($_POST['IdIncotermsName']);
$TiempoDeEnvio = VarClean($_POST['TiempoDeEnvio']);
$Muestra = VarClean($_POST['Muestra']);
$IdAdjudicacion = VarClean($_POST['IdAdjudicacion']);

if ($IdAdjudicacion == "VENTA"){ //VENTA
    // Toast("VENTA",1,"");
} else {//OFERTA
    // Toast("OFERTA",1,"");
}

     $sql = "INSERT INTO productosmov 
     (IdProducto, Tipo, ClaveDelProducto,IdUser,IdTransaccion, IdCliente,IdClienteName, FechaOperacion,Cantidad,Costo,IdIncoterms, IdIncotermsName, TiempoDeEnvio, Muestra, IdAdjudicacion, Fecha, Hora, IdLote) 
    VALUES (
        '".$IdProducto."',".
        "'".$Tipo."',".
        "'".$ClaveDelProducto."',".
        "'".$RinteraUser."',".
        "'".$IdTransaccion."',".
        "'".$IdCliente."',".
        "'".$IdClienteName."',".
        "'".$FechaOperacion."',".
        "'".$Cantidad."',".
        "'".$Costo."',".
        "'".$IdIncoterms."',".
        "'".$IdIncotermsName."',".
        "'".$TiempoDeEnvio."',".
        "'".$Muestra."',".
        "'".$IdAdjudicacion."',".
        "'".$fecha."',".
        "'".$hora."',".
        "'".$IdLote."'".
        ")";
        if ($db0->query($sql) == TRUE)
        {
            Toast("Guardado con exito",4,"");
        }
        else {
            Toast("Error al guardar",2,"");
        }

Historia($RinteraUser, "Guardo Producto", "".$sql."");

echo '
<script>
function redireccionarPagina() {
    window.location = "app_movs.php";
  }
  setTimeout("redireccionarPagina()", 3000);
</script>';


?>