<?php include("head.php"); ?>


<?php
    if (isset($RinteraUser)){
    $MiToken = MiToken($RinteraUser, "Search");
    if ($MiToken == '') {
        $MiToken = MiToken_Init($RinteraUser, "Search");
    }
    } else {
    }
?>

<?php
include("header.php");
?>
<style type="text/css">
    #app_contenedor {
        display: grid;
        grid-template-columns: 33.3% 33.3% 33.3%;
        background-color: #cac0c0;
    }
    

    #silo {
        background-color: #0E3B76;
        border: 1px #0E3B76 solid;
        vertical-align: top;
        overflow: hidden;
        margin: 6px;
        border-radius: 10px;
        -webkit-box-shadow: 0px 3px 6px 0px rgba(0,0,0,0.75);
        -moz-box-shadow: 0px 3px 6px 0px rgba(0,0,0,0.75);
        box-shadow: 0px 3px 6px 0px rgba(0,0,0,0.75);

    }
    #container {
        clip-path: polygon(40% 0, 60% 0, 75% 10%, 75% 80%, 55% 100%, 45% 100%, 25% 80%, 25% 10%);
        width: 100px;
        height: 200px;
        background-image: linear-gradient( 0deg, #F36D10 0%, #F36D10 35%, #292423 35%, #292423 35%);
    }

#myProgress {
  width: 100%;
  background-color: #fff;
}

#myBar {
  width: 1%;
  height: 30px;
  background-color: green;
}
</style>


<section id='Busqueda' style='
background-color: <?php echo Preference("ColorPrincipal", "", ""); ?>;
'>

<div style='
background-color: <?php echo Preference("ColorPrincipal", "", ""); ?>;
text-align: center;
color: white;
font-size: 10pt;  height:22px;

-webkit-box-shadow: 1px 5px 5px -3px rgba(0,0,0,0.75);
-moz-box-shadow: 1px 5px 5px -3px rgba(0,0,0,0.75);
box-shadow: 1px 5px 5px -3px rgba(0,0,0,0.75);
margin-top:  -21px;
'>
    <div id='PreloaderBuscando' style='display:none;'>
        Buscando <img src='img/loader_bar.gif'>
    </div>
</div>

</section>
<?php
if (Preference("MostrarApps", "", "")=='TRUE'){
    echo '
    <div class="row" style="margin:0px;">
    <section id="Resultados" >
    

    </section>

    <section id="MisApp" >
    ';
   
   
    echo '

    </section>
    </div>
    ';
} else {
    echo '
    
    <section id="Resultados" style="width:100%">    

    </section>

    
    ';
}
?>

<div id='Dashboard'>
    <div id="DashboardCol1"  >
        <?php
        // $QueryG = "
        // select DISTINCT a.IdClienteName,
        // (select SUM(Cantidad) from productosmov WHERE IdClienteName = a.IdClienteName) as Count
        // from productosmov a WHERE IdAdjudicacion ='VENTA'
        // ";
        // $rF= $db0 -> query($QueryG);    
        // $Datas = 0; $Labels="";
        // while($Fr = $rF -> fetch_array()) {   
        //     $Datas.= intval($Fr['Count']).", ";
        //     $Labels.="'".$Fr['IdClienteName']."',";
        // }
        // unset($rf);unset($Fr);
        // $Datas = substr($Datas, 0, -1); //quita la ultima coma.
        // $Labels = substr($Labels, 0, -1); //quita la ultima coma.

        
        //     echo '<div style="" class="Graficas">';
        //     GraficaBar($Labels,$Datas,"Clientes Venta");
        //     echo '</div>';


        // $QueryG = "
        // select DISTINCT a.IdClienteName,
        // (select SUM(Cantidad) from productosmov WHERE IdClienteName = a.IdClienteName) as Count
        // from productosmov a WHERE IdAdjudicacion ='OFERTA'
        // ";
        // $rF= $db0 -> query($QueryG);    
        // $Datas = 0; $Labels="";
        // while($Fr = $rF -> fetch_array()) {   
        //     $Datas.= intval($Fr['Count']).", ";
        //     $Labels.="'".$Fr['IdClienteName']."',";
        // }
        // unset($rf);unset($Fr);
        // $Datas = substr($Datas, 0, -1); //quita la ultima coma.
        // $Labels = substr($Labels, 0, -1); //quita la ultima coma.

        
        //     echo '<div style="" class="Graficas">';
        //     GraficaBar($Labels,$Datas,"Clientes OFERTA");
        //     echo '</div>';
        ?>

        <?php
        // $QueryG = "select DISTINCT a.Tipo,
        // (select count(*) from productosmov WHERE Tipo = a.Tipo) as Count
        // from productosmov a";
        // $rF= $db0 -> query($QueryG);    
        // $Datas = 0; $Labels="";
        // while($Fr = $rF -> fetch_array()) {   
        //     $Datas.= $Fr['Count'].", ";
        //     $Labels.="'".$Fr['Tipo']."',";
        // }
        // unset($rf);unset($Fr);
        // $Datas = substr($Datas, 0, -1); //quita la ultima coma.
        // $Labels = substr($Labels, 0, -1); //quita la ultima coma.

        
        //     echo '<div style="" class="Graficas">';
        //     GraficaBar($Labels,$Datas,"Tipo con mas Mov");
        //     echo '</div>';
        ?>
<?php
        // $QueryG = "
        // select DISTINCT a.IdAdjudicacion, (select sum(Cantidad) from productosmov WHERE IdAdjudicacion = a.IdAdjudicacion) as Count from productosmov a
        // ";
        // $rF= $db0 -> query($QueryG);    
        // $Datas = 0; $Labels="";
        // while($Fr = $rF -> fetch_array()) {   
        //     $Datas.= intval($Fr['Count']).", ";
        //     $Labels.="'".$Fr['IdAdjudicacion']."',";
        // }
        // unset($rf);unset($Fr);
        // $Datas = substr($Datas, 0, -1); //quita la ultima coma.
        // $Labels = substr($Labels, 0, -1); //quita la ultima coma.
        // // echo $Datas."|".$Labels;
        
        
        //     echo '<div style="" class="Graficas">';
        //     GraficaDona($Labels,$Datas,"OFERTA/VENTA");
        //     echo '</div>';

            
        ?>



<?php
       
        ?>

       <?php


      /*  $Datas = SilosData('Data');
        $Labels = SilosData('Label');
        unset($rf);unset($Fr);
        $Datas = substr($Datas, 0, -1); //quita la ultima coma.
        $Labels = substr($Labels, 0, -1); //quita la ultima coma.
        // echo "<br>Labels=".$Labels."<br>Datas=".$Datas."<br>";
        
           /* echo '<div style="" class="Graficas">';
            GraficaBar2($Labels,$Datas,"Silos");
            echo '</div>';*/
            //ENCABEZADO SILOS
            $Total = SilosDataTotal('Data');
            
            $CapacidadMaxima = 97200*6;
            $CapacidadRestante = $CapacidadMaxima - $Total;
            $Ocupado = $CapacidadMaxima - $CapacidadRestante;
            $por = ($Ocupado * 100)/$CapacidadMaxima;
            $PorDisponible = 100 - $por;

            echo "<div style='background-color: #0E3B76; border-radius: 1px;'>";
                echo "<table style='width:100%; font-size: 14pt; color:#fff; padding-right: 10px; padding-left: 10px; padding-top:10px; padding-bottom:20px;'>";
                        echo "<td style='width:100%; color:#33E0FF; vertical-align: middle;'><b>CONTROL DE NIVELES DE LOS SILOS</b></td>";
                echo "</table>";
            echo "</div>";

            echo "<div style='background-color: #0E3B76; border-radius: 1px;'>";
                echo "<table style='width:100%; font-size: 12pt; color:#fff; padding-right: 10px; padding-left: 10px; padding-top:10px; padding-bottom:20px;'>";
                    echo "<td style='width:10%; color:#33E0FF; vertical-align: middle;'><b>Capacidad</b></td>";
                    echo "<td style='width:12%; vertical-align: middle;'><b>".number_format($CapacidadMaxima,2,'.',',').' Gal.'."</b></td>";
                    echo "<td style='width:7%; color:#33E0FF; vertical-align: middle;'><b>Ocupación</b></td>";
                    echo "<td style='width:31%; vertical-align: middle;'>";
                    echo "<table style='width:100%;'><td style='width:40%;'>";
                    echo '<div id="myProgress" title="100%">
                        <div id="myBar" title="'.number_format($por,2,'.',',').'%"></div>
                    </div>';
                    echo '<script>
                        var elem = document.getElementById("myBar");
                        elem.style.width =  '.$por.'+ "%"
                    </script>';
                    echo "</td><td style='width:60%; font-size: 12pt; text-align:center;'>";
                    echo number_format($por,2,'.',',').'% ('.number_format($Total,2,'.',',').' Gal.)';
                    echo "</td></table>";

                    echo "</td>";
                    echo "<td style='width:10%; vertical-align: middle; color:#33E0FF;'><b>Disponible</b></td>";
                    echo "<td style='width:20%; vertical-align: middle;'><b>".number_format($PorDisponible,2,'.',',').' %  ('.number_format($CapacidadRestante,2,'.',',').' Gal.)'."</b></td>";
                echo "</table>";
            echo "</div>";

            ///AGREGAR SILOS 
            echo "<div id='app_contenedor'>";
            $Datas = SilosData('Data');
            echo "$Datas";
            $Labels = SilosData('Label');
            $Datas = substr($Datas, 0, -1); //quita la ultima coma.
            $Labels = substr($Labels, 0, -1); //quita la ultima coma.
            $cantidad= explode(",", $Datas);
            $nombre = explode(",", $Labels);

            for($i=0; $i< sizeof($cantidad); $i++){
                $porcentaje = ($cantidad[$i]*100)/97200;
            
                echo "<div id='silo' >";
                    echo "<table style='width:100%; text-align:left;'>";
                        echo "<tr>";
                        echo "<td style='width:70%; border-bottom: 1px solid #fff; font-size:16pt; color:#fff; 
                                padding-right: 10px;
                                padding-left: 10px;
                                padding-top: 10px;'>";
                                $nuevoNombre = str_replace("'",'',$nombre[$i]);  
                                echo $nuevoNombre;
                            echo "</td>";
                            echo "<td>";
                            echo "</td>";
                        echo "</tr>";

                    echo "<tr>";
                
                    echo "<td style='width:70%; font-size:12pt; color:#33E0FF; 
                    padding-right: 10px;
                    padding-left: 10px;'>";
                        echo "Capacidad disponible";
                    echo "</td>";

                    /*Original*/
                    /*echo '<div style="clip-path: polygon(40% 0, 60% 0, 75% 10%, 75% 80%, 55% 100%, 45% 100%, 25% 80%, 25% 10%);*/

                    /*Original*/
                    /*echo '<div style="clip-path: polygon(40% 0, 60% 0, 75% 0%, 75% 80%, 55% 100%, 45% 100%, 25% 80%, 25% 0%);*/

                    echo "<td style='width:30%;  
                            padding-right: 10px;
                            padding-bottom: 10px;
                            ' rowspan='4'>";
                    echo '<div style="clip-path: polygon(40% 0, 60% 0, 75% 8%, 75% 80%, 55% 100%, 45% 100%, 25% 80%, 25% 8%);
                    width: 150px;
                    height: 150px;
                    background-image: linear-gradient( 0deg, #F36D10 0%, #F36D10 '.$porcentaje.'%, #fff 0%, #fff 100%);">';
                    echo '</div>';
                    echo "</td>";
                echo "</tr>";
                
                echo "<tr>";
                echo "<td style=' width:70%; font-size:14pt; color:#fff; 
                padding-right: 10px;
                padding-left: 10px;'>";
                    echo number_format(97200 - $cantidad[$i],2,'.',',').' Galones';
                echo "</td>";
                echo "</tr>";

                echo "<td style=' width:70%; font-size:12pt; color:#33E0FF; 
                padding-right: 10px;
                padding-left: 10px;'>";
                    echo "Capacidad ocupada";
                echo "</td>";

                echo "<tr>";
                echo "<td style='width:70%; font-size:14pt; color:#fff; 
                padding-right: 10px;
                padding-left: 10px;'>";
                    echo number_format($cantidad[$i],2,'.',',').' Galones';
                echo "</td>";
                echo "</tr>";

                echo "<tr>";
                    echo "<td style=' width:70%; font-size:12pt; color:#33E0FF; 
                    padding-right: 10px;
                    padding-left: 10px;'>";
                        echo "Capacidad total";
                    echo "</td>";

                    echo "<td style='width:30%; font-size:16pt; color:#fff; text-align: center; 
                    padding-right: 10px;
                    padding-left: 10px;' >";
                        echo number_format($porcentaje,2,'.',',').'%';
                    echo "</td>";
                echo "</tr>";

                echo "<td style='width:70%; font-size:14pt; color:#fff; 
                padding-right: 10px;
                padding-left: 10px;'>";
                    echo number_format(97200,2,'.',',').' Galones';
                echo "</td>";

                echo "</table>";

                echo "</div>";
  
            }


            echo "</div>";




        ?>


        <?php
        //codigo de grafica de pastel
       /* $Total = SilosDataTotal('Data');
        $CapacidadMaxima = 97200*6;
        $CapacidadRestante = $CapacidadMaxima - $Total;
        $Datas = $CapacidadRestante.", ".$Total.",";
        $Labels = "'Capacidad Disponible', 'Ocupacion en Silos',";
        unset($rf);unset($Fr);
        $Datas = substr($Datas, 0, -1); //quita la ultima coma.
        $Labels = substr($Labels, 0, -1); //quita la ultima coma.
        // echo "<br>Labels=".$Labels."<br>Datas=".$Datas."<br>";
        
            echo '<div style="" class="Graficas">';
            GraficaPie($Labels,$Datas,"Capacidad en Silos");
            echo '</div>';
*/

        ?>
    </div>

    <div id="DashboardCol2" style="vertical-align:top;">
    <!-- <h6 style='font-size: 14pt; '>Opciones disponibles</h6> -->
    

    <?php
     $rF= $db0 -> query("select * from reportes where Portada=1 order by id_rep");    
     $repos = 0; $repolist="";

     while($Fr = $rF -> fetch_array()) {   
         $repolist.= "<a href='r.php?id=".$Fr['id_rep']."' title='Haga Clic aqui para ver el reporte' class='btn btn-success'
         style='
            // background-color: #e6e6e6;
            // color: #625f5f;
            width: 100%;
            font-size: 10pt;
            text-align:left;
            margin-bottom:5px;
         '
         >".$Fr['rep_name']."</a>";
         $repos = $repos + 1;
     }
    
     unset($rf);unset($Fr);
     if ($repos > 0 ){
         echo "<h6 style='font-size: 8pt;
         opacity: 0.6;'></h6>";
         echo $repolist;
     }

     echo "<a href='app_movs.php' title='Haga Clic aqui para ver la activivad' class='btn btn-primary'
         style='
            // background-color: #e6e6e6;
            // color: #625f5f;
            width: 100%;
            font-size: 10pt;
            text-align:left;
            margin-top:10px;
         '
         >";
     echo "<img src='icon/permisos.png' style='width:32px;'> Movimientos";
     echo "</a>";

     echo "<a href='calendariodeembarques.php' title='Haga Clic aqui para ver la activivad' class='btn btn-primary'
     style='
        // background-color: #e6e6e6;
        // color: #625f5f;
        width: 100%;
        font-size: 10pt;
        text-align:left;
        margin-top:10px;
     '
     >";
    echo "<img src='icon/permisos.png' style='width:32px;'> Calendario de embarques";
    echo "</a>";

    if (UserAdmin($RinteraUser)==TRUE){
            echo "<a href='users.php' title='Haga Clic aqui para ver administrar esta página' class='btn btn-primary'
                style='
                    // background-color: #e6e6e6;
                    // color: #625f5f;
                    width: 100%;
                    font-size: 10pt;
                    text-align:left;
                    margin-top:10px;
                '
                >";
            echo "<img src='icon/empleados.png' style='width:32px;'> Usuarios";
            echo "</a>";
        }

    ?>
    </div>

</div>

<?php
//UltimasBusquedas_buble($RinteraUser);

if (UserAdmin($RinteraUser) == TRUE) {
    if (Preference("NuevosReportes", "", "")=='TRUE'){
    echo "<div class='btnMas' title='Haz clic aquí para crear un nuevo reporte'>
    <a href='nuevo.php' > <img src='src/mas.png' style='width:100%;'>
    </a>
    </div>";
    }

}
?>




<?php


if (TestConectionWS(2) ==  FALSE) {
    echo '
    <div class="alert alert-danger" role="alert">
    <b>Sin Comunicacion con la Base de Datos de la Planta.</b>
    <cite>Se recomienda verificar que este encendido y en condiciones el equipo donde se encuentra dicha base de datos.<br></cite>
    
    </div>
  ';
    
}
echo "
<script> 
$('.InputBusqueda').css('background-color','".Preference("ColorPrincipal", "", "")."');
$('.InputBusqueda').css('color','white');
</script>
";
echo "
    <script>
    function Search(){
        var busqueda = $('#InputBusqueda').val();
         $('#PreloaderBuscando').show();                
            $.ajax({
                url: 'search.php',
                type: 'post',        
                data: {IdUser:'" . $RinteraUser . "', Token: '" . $MiToken . "',
                    busqueda:busqueda

                },
            success: function(data){
                $('#Resultados').html(data);
                
                $('#PreloaderBuscando').hide();
                $('#Dashboard').hide();
            }
            });
        
       


            
    }
    
    // Search();
    </script>

";
if (isset($_GET['q'])){
    if ($_GET['q']<>''){
        echo '
        <script>
            Search();
            $("#Dashboard").hide();
        </script>
        ';
    }
}
?>

<?php
Historia($RinteraUser, "HOME", "Acceso a la pagina principal");


function SilosData($Data){
require("rintera-config.php");

$QueryEncabezado = "Select * from NivelesDeLosSilos order by IdSilo";

$IdCon = 2;
$WSSQL = "select * from dbs where IdCon='".$IdCon."' AND Active=1 AND ConType =2"; //SQLSERVERTOJSON
$WSCon = $db0 -> query($WSSQL);

if($WSConF = $WSCon -> fetch_array())
{
if ($WSConF['wsurl'] <>'' &&  $WSConF['wsmethod']<>'' && $WSConF['wsjson']<>'' )    
{
    $WSurl = $WSConF['wsurl'];
    $WSmethod = $WSConF['wsmethod'];
    $WSjson = $WSConF['wsjson'];
    $WSparametros = $WSConF['parametros'];

    $wsP1_id = $WSConF['wsP1_id'];  $wsP1_value = $WSConF['wsP1_value'];
    $wsP2_id = $WSConF['wsP2_id'];  $wsP2_value = $WSConF['wsP2_value'];
    $wsP3_id = $WSConF['wsP3_id'];  $wsP3_value = $WSConF['wsP3_value'];
    $wsP4_id = $WSConF['wsP4_id'];  $wsP4_value = $WSConF['wsP4_value'];
    $WS_Val = TRUE;        
    $url = $WSurl;            
    $sql = $QueryEncabezado;
    $token = $wsP1_value;

    //Peticion
    $myObj = new stdClass;
    $myObj->token = $token;
    $myObj->sql = $QueryEncabezado;
    $myJSON = json_encode($myObj,JSON_UNESCAPED_SLASHES);
    
    $datos_post = http_build_query(
        $myObj
    );

    $opciones = array('http' =>
        array(
            'method'  => 'POST',
            'header'  => 'Content-type: application/x-www-form-urlencoded',
            'content' => $datos_post
        )
    );
    ini_set('max_execution_time', 7000);
    ini_set('max_execution_time', 0);
    $context = stream_context_create($opciones);            
    $archivo_web = file_get_contents($url, false, $context);                    
    $data = json_decode($archivo_web);

    $jsonIterator = new RecursiveIteratorIterator(
        new RecursiveArrayIterator(json_decode($archivo_web, TRUE)),
        RecursiveIteratorIterator::SELF_FIRST
    );

    $Der = "";
    // var_dump( $jsonIterator);    
    $TablaDeta = "";
    $row = 0;    
    $DataG ="";
    $LabelG = "";
    $FechasG = "";
    foreach ($jsonIterator as $key => $val) {
        if (is_numeric($key)){ //rows                        
            $rowC = 0;
        } else {
            switch ($row) {                    
                case 0:
                   
                    break;
               
                default:
                    
                if ($key == 'silo'){
                    $LabelG.= "'".$val."',";
                }
                if ($key == 'Existencia'){
                    $DataG.= "".intval($val).",";
                }
               /* if ($key == 'FechaUltimaMov'){
                    $FechasG.= "".$val.",";
                }*/
                    
                    // $TablaDeta.= "<tr><td>".$key."</td><td>".$val."</td></tr>";
                    
                    break;
            }
            
               
                
            $row = $row + 1;    
        }
         
    }
    // $TablaDetaT="<table class='tabla' border=1>".$TablaDeta."</table>";
    
   
       
        
   
    
    
    
    
}

}
if ($Data == 'Data'){
    return $DataG;
}
if ($Data = 'Label'){
    return $LabelG;
}
/*if ($Data = 'Fechas'){
    return $FechasG;
}*/
}



function SilosDataTotal($Data){
    require("rintera-config.php");
    
    $QueryEncabezado = "Select * from NivelesDeLosSilos order by IdSilo";
    
    $IdCon = 2;
    $WSSQL = "select * from dbs where IdCon='".$IdCon."' AND Active=1 AND ConType =2"; //SQLSERVERTOJSON
    $WSCon = $db0 -> query($WSSQL);
    
    if($WSConF = $WSCon -> fetch_array())
    {
    if ($WSConF['wsurl'] <>'' &&  $WSConF['wsmethod']<>'' && $WSConF['wsjson']<>'' )    
    {
        $WSurl = $WSConF['wsurl'];
        $WSmethod = $WSConF['wsmethod'];
        $WSjson = $WSConF['wsjson'];
        $WSparametros = $WSConF['parametros'];
    
        $wsP1_id = $WSConF['wsP1_id'];  $wsP1_value = $WSConF['wsP1_value'];
        $wsP2_id = $WSConF['wsP2_id'];  $wsP2_value = $WSConF['wsP2_value'];
        $wsP3_id = $WSConF['wsP3_id'];  $wsP3_value = $WSConF['wsP3_value'];
        $wsP4_id = $WSConF['wsP4_id'];  $wsP4_value = $WSConF['wsP4_value'];
        $WS_Val = TRUE;        
        $url = $WSurl;            
        $sql = $QueryEncabezado;
        $token = $wsP1_value;
    
        //Peticion
        $myObj = new stdClass;
        $myObj->token = $token;
        $myObj->sql = $QueryEncabezado;
        $myJSON = json_encode($myObj,JSON_UNESCAPED_SLASHES);
        
        $datos_post = http_build_query(
            $myObj
        );
    
        $opciones = array('http' =>
            array(
                'method'  => 'POST',
                'header'  => 'Content-type: application/x-www-form-urlencoded',
                'content' => $datos_post
            )
        );
        ini_set('max_execution_time', 7000);
        ini_set('max_execution_time', 0);
        $context = stream_context_create($opciones);            
        $archivo_web = file_get_contents($url, false, $context);                    
        $data = json_decode($archivo_web);
    
        //var_dump ($data);
        $jsonIterator = new RecursiveIteratorIterator(
            new RecursiveArrayIterator(json_decode($archivo_web, TRUE)),
            RecursiveIteratorIterator::SELF_FIRST
        );
    
        $Der = "";
        // var_dump( $jsonIterator);    
        $TablaDeta = "";
        $row = 0;    
        $DataG ="";
        $LabelG = "";
        $Total = 0;
        foreach ($jsonIterator as $key => $val) {
            if (is_numeric($key)){ //rows                        
                $rowC = 0;
            } else {
                switch ($row) {                    
                    case 0:
                       
                        break;
                   
                    default:
                        
                    if ($key == 'silo'){
                        $LabelG.= "'".$val."',";
                    }
                    if ($key == 'Existencia'){
                        $DataG.= "".intval($val).",";
                        $Total = $Total + intval($val);
                    }

                    break;
                }
                
                   
                    
                $row = $row + 1;    
            }
             
        }
        // $TablaDetaT="<table class='tabla' border=1>".$TablaDeta."</table>";

    }
    
    }
    return $Total;
    }

include ("footer.php");
?>
