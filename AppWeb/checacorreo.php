<?php
require ("rintera-config.php");
require ("components.php");
require ("app_funciones.php");
include("seguridad.php");

$IdCliente = VarClean($_POST['IdCliente']);
$Correo = ClienteEmail($IdCliente);
if ($Correo == '') {
    echo 'Sin correo electronico registrado';
} else {
    echo $Correo;
}


?>