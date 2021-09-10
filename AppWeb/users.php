<?php include("head.php"); ?>

<?php
//TOKENS
// $MiToken = MiToken($RinteraUser, "Users");
// if ($MiToken == ''){
//     $MiToken = MiToken_Init($RinteraUser, "Edit");
// }
// echo "Token: ".$MiToken;

include ("header.php");

?>

<?php

if (UserAdmin($RinteraUser)==TRUE){
    if (Preference("UsuariosForaneos", "", "") == "FALSE"){

        if (isset($_GET['i1'])){//Se actualizo correctamente
            Toast("Se actualizo correctamente a ".$_GET['i1'],1,"");
        }
        if (isset($_POST['BtnActualizar'])){
            $IdUser = VarClean($_POST['IdUser']);
            $RinteraLevel = 0;
            $UserName = VarClean($_POST['UserName']);
            $NIP = VarClean($_POST['NIP']);
            $sql = "UPDATE users SET RinteraLevel='".$RinteraLevel."', UserName='".$UserName."', NIP='".$NIP."' WHERE IdUser='".$IdUser."'";

            if ($db0->query($sql) == TRUE)
                {
                    $page = "users.php?i1=".$IdUser;            
                    Historia($RinteraUser, "Usuarios", "Actualizo al usuario".$IdUser." [SQL=".$sql."]");
                    LocationFull($page);

                }
                else {
                    // MiToken_Close($IdUser, $ElToken);             
                    Toast("Ha habido un Error al intentar actualizar",2,"");
                    // echo "Ha habido un error al intentar guardar tu reporte: <br>QUERY= <br>".$sql;
                }
       
        }

        if (isset($_GET['i2'])){//Se actualizo correctamente
            Toast("Se ha eliminado al usuario ".$_GET['i2'],1,"");
        }
        if (isset($_GET['x'])){
            $IdUser = VarClean($_GET['x']);
            if ($IdUser == 'admin'){
                Toast("No puedes eliminar al usuario admin",2,"");

            } else {
                $sql = "DELETE from users WHERE IdUser='".$IdUser."'";
                echo $sql;

                if ($db0->query($sql) == TRUE)
                    {
                        $page = "users.php?i2=".$IdUser;            
                        Historia($RinteraUser, "Usuarios", "Elimino al usuario".$IdUser." [SQL=".$sql."]");
                        LocationFull($page);

                    }
                    else {
                        // MiToken_Close($IdUser, $ElToken);             
                        Toast("Ha habido un Error al intentar eliminar",2,"");
                        // echo "Ha habido un error al intentar guardar tu reporte: <br>QUERY= <br>".$sql;
                    }
            }
       
        }

        if (isset($_GET['id'])){
            $IdUser = VarClean($_GET['id']);
            $sql = "select * from users WHERE IdUser ='".$IdUser."'";
            $rc= $db0 -> query($sql);
            if($f = $rc -> fetch_array())
            {
                echo "<h3 style='text-align:center; color: #28a745;' class=''>
                
                Usuario: ".$IdUser." 
                
                </h3><br>";
                
                echo "
                <center>
                <form action='' method='POST' class='row container' style='
                background-color:#ececec;
                border-radius: 5px;
                padding: 5px;

                '>";
                echo "<input type='hidden' name='IdUser' value='".$IdUser."'>";
                echo "<div class='col-sm-4'><label>Nombre: <input class='form-control' type='text' name='UserName' value='".$f['UserName']."'></label></div>";
                
                // echo "<div class='col-sm-4'><label>Tipo: ";
                // echo "<select name='RinteraLevel' class='form-control'>";

                // if ($f['RinteraLevel']==0) {
                //     echo "<option value='' selected>No Definido</option>";
                //     echo "<option value='1' >Administrador</option>";
                //     echo "<option value='2' >Consulta</option>";
                // } else {
                //     if ($f['RinteraLevel']==1) {
                //         echo "<option value='1' selected>Administrador</option>";                    
                //         echo "<option value='2' >Consulta</option>";
                //     } else {
                //         echo "<option value='2' selected>Consulta</option>";
                //         echo "<option value='1' >Administrador</option>";                    

                //     }

                // }
                // echo "</select>";
                
                echo "</label></div>";
                echo "<div class='col-sm-4'><label>NIP: <input class='form-control' type='text' name='NIP' value='".$f['NIP']."'></label></div>";
                echo "<div class='col-sm-12'><label><br><input class='btn btn-success' type='submit' name='BtnActualizar' value='Actualizar' ></label></div>";
            
                echo "</form>
                </center>
                ";
                
            } else {
                echo "<p>ERROR: Usuario no localizado</p>";
            }


            
        }
        
        //AGREGAMOS CODIGO PARA ELIMINAR UN REGISTRO
        if(isset($_POST['eliminar'])){
            $IdUser = $_POST['usuarioEliminar'];
           
            //$sql = "DELETE from users WHERE IdUser='".$IdUser."'";
            $sql = "UPDATE users SET Estatus = 2 WHERE IdUser='".$IdUser."'";

            if ($db0->query($sql) == TRUE)
            {           
                Historia($RinteraUser, "Usuarios", "Elimino al usuario".$IdUser." [SQL=".$sql."]");
                Toast("Se ha eliminado satisfactoriamente el registro.",4,"");
            }else {
                Toast("Ha ocurrido un error al eliminar al usuario, por favor intentelo nuevamente",2,"");
            }
            
        }

        //AGREGAMOS CODIGO PARA MODIFICAR UN USUARIO
        //AQUI SE AGREGA A LA PANTALLA LOS ELEMENTOS PARA MODIFICAR EL REGISTRO

        if(isset($_POST['editar'])){
            $IdUser = $_POST['usuarioEditar'];
            echo "
            <center>
            <div style='
        border: dashed 1px #bfbfbf;
        '><div class='container' style='
        background-color:white;
            border-radius: 5px;
            padding: 5px;'>
            <h3 style='
        text-align: center;
        font-size: 17pt;
        background-color: #0E3B76;
        color: white;
        border-top-left-radius: 4px;
        border-top-right-radius: 4px;
        '><b>Editar información del usuario ".$IdUser."</b></h3><br>
            <form action='users.php' method='POST' class='row container' style='
            background-color:#ececec;
            border-radius: 5px;
            padding: 5px;

            '>";
            $sql='SELECT * FROM users WHERE IdUser = "'.$IdUser.'"';
            //echo $sql;
             $rc= $db0 -> query($sql);
            while($f = $rc -> fetch_array()) {
            echo "<input class='form-control' type='hidden' name='IdUser' value='".$f['IdUser']."'>";
            //echo "<div class='col-sm-4'><label>Usuario: <input class='form-control' type='text' name='IdUser' value='".$f['IdUser']."'> </label></div>";
            echo "<div class='col-sm-4'><label>Contraseña: <input class='form-control' type='text' name='NIP' value='".$f['NIP']."' ></label></div>";
            echo "<div class='col-sm-4'><label>Nombre completo: <input class='form-control' type='text' name='UserName' value='".$f['UserName']."'></label></div>";
            echo "<div class='col-sm-4'><label>eMail: <input class='form-control' type='text' name='eMail' value='".$f['eMail']."' ></label></div>";

            echo "<div class='col-sm-4'><label>Tipo: ";
            echo "<select name='RinteraLevel' class='form-control' required>";

                if($f['RinteraLevel'] == ''){
                   echo "<option value='' selected>No Definido</option>";
                    echo "<option value='1' >Administrador</option>";
                    echo "<option value='2' >Consulta</option>";
                }else if($f['RinteraLevel']==1){
                    echo "<option value='' >No Definido</option>";
                    echo "<option value='1' selected >Administrador</option>";
                    echo "<option value='2' >Consulta</option>";
                }else{
                    echo "<option value='' >No Definido</option>";
                    echo "<option value='1'  >Administrador</option>";
                    echo "<option value='2' selected>Consulta</option>";
                }
                
            echo "</select>";
            echo "</label></div>";

            echo "<div class='col-sm-4'><label>Estatus: ";
            echo "<select name='Estatus' class='form-control' required>";

                if($f['Estatus'] == ''){
                   echo "<option value='' selected>No Definido</option>";
                    echo "<option value='1' >Administrador</option>";
                    echo "<option value='2' >Consulta</option>";
                }else if($f['Estatus']==1){
                    echo "<option value='' >No Definido</option>";
                    echo "<option value='1' selected>Vigente</option>";
                echo "<option value='2' >Cancelado</option>";
                }else{
                    echo "<option value='' >No Definido</option>";
                    echo "<option value='1' >Vigente</option>";
                    echo "<option value='2' selected>Cancelado</option>";
                }
                
            echo "</select>";
            echo "</label></div>";
            }
            echo "<center><div class='col-sm-4'><label><br><input class='btn btn-success' type='submit' name='editUser' id='editUser' value='Modificar' ></label></div></center>";
            
            echo "</form>
            </div>
            </center>
            ";

        }

        //CODIGO PARA MODIFICAR AL USUARIO EN LA BD
        if(isset($_POST['editUser'])){
            $IdUser = VarClean($_POST['IdUser']);
            $NIP = VarClean($_POST['NIP']);
            $UserName = VarClean($_POST['UserName']);
            $RinteraLevel = VarClean($_POST['RinteraLevel']);
            $eMail = VarClean($_POST['eMail']);
            $Estatus = VarClean($_POST['Estatus']);;

            $sql = "UPDATE users SET NIP = '".$NIP."', UserName = '".$UserName."', RinteraLevel=".$RinteraLevel.", eMail='".$eMail."', Estatus = ".$Estatus."
            WHERE IdUser = '".$IdUser."'";
            //echo $sql;
            if ($db0->query($sql) == TRUE){          
                Historia($RinteraUser, "Usuarios", "Creo Al Usuario al usuario".$IdUser." [SQL=".$sql."]");
                Toast("Se ha modificado satisfactoriamente el registro.",4,"");
            }else{            
                Toast("Ha ocurrido un Error al intentar actualizar, favor de intentarlo nuevamente.",2,"");
            }
        }

        if (isset($_GET['new'])){
                if (isset($_GET['i3'])){//Se actualizo correctamente
                    Toast("Se creo el usuario = ".$_GET['i3'],1,"");
                }
                if (isset($_POST['BtnNew'])){
                    $IdUser = VarClean($_POST['IdUser']);
                    $NIP = VarClean($_POST['NIP']);
                    $UserName = VarClean($_POST['UserName']);
                    $RinteraLevel = VarClean($_POST['RinteraLevel']);
                    $eMail = VarClean($_POST['eMail']);
                    $Estatus = VarClean($_POST['Estatus']);;

                    $sql = "INSERT INTO users
                    (IdUser, NIP, UserName, RinteraLevel, eMail, Estatus)
                    VALUES
                    ('".$IdUser."','".$NIP."','".$UserName."',".$RinteraLevel.",'".$eMail."',".$Estatus.")
                    ";

                    if ($db0->query($sql) == TRUE)
                        {
                            $page = "users.php?i3=".$IdUser;            
                            Historia($RinteraUser, "Usuarios", "Creo Al Usuario al usuario".$IdUser." [SQL=".$sql."]");
                            LocationFull($page);
                        }
                        else 
                        {
                            // MiToken_Close($IdUser, $ElToken);             
                            Toast("Ha habido un Error al intentar actualizar",2,"");
                            // echo "Ha habido un error al intentar guardar tu reporte: <br>QUERY= <br>".$sql;
                        }
               
                }
        

            
        

            echo "
            <center>
            <h3>Crear nuevo usuario</h3><br>
            <form action='' method='POST' class='row container' style='
            background-color:#ececec;
            border-radius: 5px;
            padding: 5px;

            '>";
            
            echo "<div class='col-sm-4'><label>Usuario: <input class='form-control' type='text' name='IdUser' value='' required></label></div>";
            echo "<div class='col-sm-4'><label>Contraseña: <input class='form-control' type='text' name='NIP' value='' required></label></div>";
            echo "<div class='col-sm-4'><label>Nombre completo: <input class='form-control' type='text' name='UserName' value='' required></label></div>";
            echo "<div class='col-sm-4'><label>eMail: <input class='form-control' type='text' name='eMail' value='' required></label></div>";

            echo "<div class='col-sm-4'><label>Tipo: ";
            echo "<select name='RinteraLevel' class='form-control' required>";
                echo "<option value='' selected>No Definido</option>";
                echo "<option value='1' >Administrador</option>";
                echo "<option value='2' >Consulta</option>";
            echo "</select>";
            echo "</label></div>";

            echo "<div class='col-sm-4'><label>Estatus: ";
            echo "<select name='Estatus' class='form-control' required>";
                echo "<option value='1' >Vigente</option>";
                echo "<option value='2' >Cancelado</option>";
            echo "</select>";
            echo "</label></div>";

            echo "<div class='col-sm-4'><label><br><input class='btn btn-success' type='submit' name='BtnNew' value='Guardar' ></label></div>";
            
            echo "</form>

            </center>
            ";

        } else {

        echo "<hr style='
        border: dashed 1px #bfbfbf;
        '><div class='container' style='
        background-color:white;
            border-radius: 5px;
            padding: 5px;'>
        
        
        <h2 style='
        text-align: center;
        font-size: 17pt;
        background-color: #0E3B76;
        color: white;
        border-top-left-radius: 4px;
        border-top-right-radius: 4px;
        '>
        <table border=0 width=100%>
        <tr><td align=center>
        <b>Administración de accesos</b>
        </td><td width=30px align=right>
        <a href='?new=' title='Haga clic aqui para agregar un nuevo usuario'>
        <img src='icon/user_add.png' style='width:32px;'>
        </a>

        </td>
        </tr>
        </table>
        
        </h2><br>";

        /*$sql ="
        SELECT
	    IdUser,
	    `rintera`.`users`.`UserName` AS `UserName`,
	    concat( '<a href=\'?x=', `rintera`.`users`.`IdUser`, '\' title=\'Haga clic para Eliminar al Usuario\' class=\'btn btn-warning\'><img src=\'icon/x.png\' style=\'width:17px;\'></a>' ) AS `Eliminar` 
        FROM
	    `users`
        ";*/

        //CREAMOS LA TABLA
        $sql="SELECT * FROM users WHERE Estatus = 1";
        $rc= $db0 -> query($sql);
        echo "<table class='tabla'>";
        echo "<tr>";
        echo "<th>Usario</th>";
        echo "<th>CONTRASEÑA</th>";
        echo "<th>NOMBRE COMPLETO</th>";
        echo "<th>EMAIL</th>";
        echo "<th>PERMISOS</th>";
        echo "<th>ESTATUS</th>";
        echo "<th>EDITAR</th>";
        echo "<th>ELIMINAR</th>";
        echo "</tr>";
        while($f = $rc -> fetch_array()) {
            echo "<tr>";
            echo "<td>".$f['IdUser']."</td>";
            echo "<td>".$f['NIP']."</td>";
            echo "<td>".$f['UserName']."</td>";
            echo "<td>".$f['eMail']."</td>";

            IF ($f['RinteraLevel'] == '') {echo "<td>No definido</td>";}
            IF ($f['RinteraLevel'] == 1) {echo "<td>Administrador</td>";}
            IF ($f['RinteraLevel'] == 2) {echo "<td>Consulta</td>";}
            /*echo "<td>".$f['RinteraLevel']."</td>";*/

            IF ($f['Estatus'] == 1) {echo "<td>Vigente</td>";}
            IF ($f['Estatus'] == 2) {echo "<td>Cancelado</td>";}

            /*echo "<td>".$f['Estatus']."</td>";*/
            echo '<td>';
                echo "<form action='users.php' method='POST'>";
                echo "<input type='hidden' name='usuarioEditar' id='usuarioEditar' value='".$f['IdUser']."'>";
                    echo "<button type='submit' class='Mbtn btn-edit' id='editar' name='editar'>";
                            echo "<img src='icon/edit.png' style='width:20px; height:20px;'>"; 							
                    echo "</button>";
                echo "</form>";
            echo '</td>';
            echo '<td>';
                echo "<form action='users.php' method='POST'>";
                echo "<input type='hidden' name='usuarioEliminar' id='usuarioEliminar' value='".$f['IdUser']."'>";
                    echo "<button class='Mbtn btn-cancel' id='eliminar' name='eliminar'>";
                            echo "<img src='icon/eliminar.png' style='width:20px; height:20px;'>"; 							
                    echo "</button>";
                echo "</form>";
            echo '</td>';
            
            echo "</tr>";

        }
        echo "</table>";
        
        /*$IdTabla = "MiTabla";
        $Clase = "container ";
        $db= 0 ;        
        echo  $sql;
        DynamicTable_MySQL('select IdUser As Usuario, NIP Contraseña, UserName As NombreCompleto, eMail, RinteraLevel As Permisos, Estatus from users', "DivUsuarios", $IdTabla, $Clase, 0, $db);
        */
        }
        echo "</div>";
    } else {
        echo "<p>La administración de usuarios se realiza en una base de datos externa!.</p>";
    }
    
} else {
    LocationFull("index.php");
}
?>



<?php include ("footer.php"); ?>