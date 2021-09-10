<?php
    include 'conexion_android.php';

    $usu_usuario=$_POST['usuario'];
    $usu_password=$_POST['password'];

    //$usu_usuario="user";
    //$usu_password="user";

    $sentencia=$conexion->prepare("SELECT * FROM users WHERE IdUser=? and NIP=?");
    $sentencia->bind_param('ss',$usu_usuario,$usu_password);
    $sentencia->execute();

    $resultado = $sentencia->get_result();
    if ($fila = $resultado->fetch_assoc()) 
    {
        echo json_encode($fila,JSON_UNESCAPED_UNICODE);
    }
    $sentencia->close();
    $conexion->close();
?>