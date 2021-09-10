<?php
header('Content-Type: application/json');
require("rintera-config.php");

switch ($_GET['accion']) {
    case 'listar':
        $datos = mysqli_query($db0, "select codigo as id,
                                                 titulo as title,
                                                 descripcion,
                                                 inicio as start,
                                                 fin as end,
                                                 colortexto as textColor,
                                                 colorfondo as backgroundColor 
                                            from calendariodeembarques");
        $resultado = mysqli_fetch_all($datos, MYSQLI_ASSOC);
        echo json_encode($resultado);
        break;

    case 'agregar':
        $respuesta = mysqli_query($db0, "insert into calendariodeembarques(titulo,descripcion,inicio,fin,colortexto,colorfondo) values 
                                                ('$_POST[titulo]','$_POST[descripcion]','$_POST[inicio]','$_POST[fin]','$_POST[colortexto]','$_POST[colorfondo]')");
        echo json_encode($respuesta);
        break;

    case 'modificar':
        $respuesta = mysqli_query($db0, "update calendariodeembarques set titulo='$_POST[titulo]',
                                                                 descripcion='$_POST[descripcion]',
                                                                 inicio='$_POST[inicio]',
                                                                 fin='$_POST[fin]',
                                                                 colortexto='$_POST[colortexto]',
                                                                 colorfondo='$_POST[colorfondo]'
                                                            where codigo=$_POST[codigo]");
        echo json_encode($respuesta);
        break;

    case 'borrar':
        $respuesta = mysqli_query($db0, "delete from calendariodeembarques where codigo=$_POST[codigo]");
        echo json_encode($respuesta);
        break;
}
