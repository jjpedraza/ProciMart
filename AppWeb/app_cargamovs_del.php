<?php
require ("rintera-config.php");
require ("components.php");
require ("app_funciones.php");
include("seguridad.php");



$IdMov = VarClean($_POST['IdMov']);

     $sql = "DELETE FROM productosmov 
     WHERE IdMov = '".$IdMov."'";
        if ($db0->query($sql) == TRUE)
        {
            Toast("Borrado con exito",4,"");
        }
        else {
            Toast("Error al Borrar",2,"");
        }

Historia($RinteraUser, "Borro el Producto de las ventas", "".$IdMov."");

echo '
<script>
CargaMovs();
CargaMovs2();
</script>';

?>