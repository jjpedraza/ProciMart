<?php include("head.php"); ?>


<?php
    if (isset($RinteraUser)){
    $MiToken = MiToken($RinteraUser, "Search");
    if ($MiToken == '') {
        $MiToken = MiToken_Init($RinteraUser, "Search");
    }
    } else {
     
    }

// echo "Token: ".$MiToken."";
?>





<?php
include("header.php");
?>

<section id='Busqueda' style='
background-color: <?php echo Preference("ColorPrincipal", "", ""); ?>;
'>

<table width=100%><tr><td>
    <?php
    if (isset($_GET['q'])) {
        echo '<input id="InputBusqueda" list="busquedas"     data-min-length="1" style="background-color: '.Preference("ColorPrincipal", "", "").';"
        class="InputBusqueda flexdatalist" type="text" placeholder="¿Que reporte necesitas?"  value="' . VarClean($_GET['q']) . '">';

    } else {
        echo '<input id="InputBusqueda" list="busquedas"  data-min-length="1" style="background-color: '.Preference("ColorPrincipal", "", "").';"
        class="InputBusqueda flexdatalist" type="text" placeholder="¿Que reporte necesitas?" >';
    }

    if (isset($_GET['i1'])) {
        Toast("Guardado correctamente " . VarClean($_GET['q']), 1, "");
    }

    if (isset($_GET['e1'])) {
        Toast("ERROR:Al localizar el Reporte " . VarClean($_GET['e1']), 2, "");
    }
    ?>

</td>
<td width=50px align=right valign=middle 
    style='background-color: <?php echo Preference("ColorPrincipal", "", ""); ?>;'>
    <button  class="Mbtn btn-Success"  onclick="Search();" style="
    background-color:  <?php echo Preference("ColorResaltado", "", ""); ?>;
    box-shadow: 0 3px  #4d4c49; margin:10px;

    "> 
    <img src='icon/busqueda.png' style='width:24px;'></button>
</td>
</tr>
</table>

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
        $QueryG = "
        select DISTINCT a.IdClienteName,
        (select SUM(Cantidad) from productosmov WHERE IdClienteName = a.IdClienteName) as Count
        from productosmov a WHERE IdAdjudicacion ='VENTA'
        ";
        $rF= $db0 -> query($QueryG);    
        $Datas = 0; $Labels="";
        while($Fr = $rF -> fetch_array()) {   
            $Datas.= intval($Fr['Count']).", ";
            $Labels.="'".$Fr['IdClienteName']."',";
        }
        unset($rf);unset($Fr);
        $Datas = substr($Datas, 0, -1); //quita la ultima coma.
        $Labels = substr($Labels, 0, -1); //quita la ultima coma.

        
            echo '<div style="" class="Graficas">';
            GraficaBar($Labels,$Datas,"Clientes Venta");
            echo '</div>';


        $QueryG = "
        select DISTINCT a.IdClienteName,
        (select SUM(Cantidad) from productosmov WHERE IdClienteName = a.IdClienteName) as Count
        from productosmov a WHERE IdAdjudicacion ='OFERTA'
        ";
        $rF= $db0 -> query($QueryG);    
        $Datas = 0; $Labels="";
        while($Fr = $rF -> fetch_array()) {   
            $Datas.= intval($Fr['Count']).", ";
            $Labels.="'".$Fr['IdClienteName']."',";
        }
        unset($rf);unset($Fr);
        $Datas = substr($Datas, 0, -1); //quita la ultima coma.
        $Labels = substr($Labels, 0, -1); //quita la ultima coma.

        
            echo '<div style="" class="Graficas">';
            GraficaBar($Labels,$Datas,"Clientes OFERTA");
            echo '</div>';




        ?>

        <?php
        $QueryG = "select DISTINCT a.Tipo,
        (select count(*) from productosmov WHERE Tipo = a.Tipo) as Count
        from productosmov a";
        $rF= $db0 -> query($QueryG);    
        $Datas = 0; $Labels="";
        while($Fr = $rF -> fetch_array()) {   
            $Datas.= $Fr['Count'].", ";
            $Labels.="'".$Fr['Tipo']."',";
        }
        unset($rf);unset($Fr);
        $Datas = substr($Datas, 0, -1); //quita la ultima coma.
        $Labels = substr($Labels, 0, -1); //quita la ultima coma.

        
            echo '<div style="" class="Graficas">';
            GraficaBar($Labels,$Datas,"Tipo con mas Mov");
            echo '</div>';

            
        ?>

<?php
        $QueryG = "
        select DISTINCT a.IdAdjudicacion, (select sum(Cantidad) from productosmov WHERE IdAdjudicacion = a.IdAdjudicacion) as Count from productosmov a
        ";
        $rF= $db0 -> query($QueryG);    
        $Datas = 0; $Labels="";
        while($Fr = $rF -> fetch_array()) {   
            $Datas.= intval($Fr['Count']).", ";
            $Labels.="'".$Fr['IdAdjudicacion']."',";
        }
        unset($rf);unset($Fr);
        $Datas = substr($Datas, 0, -1); //quita la ultima coma.
        $Labels = substr($Labels, 0, -1); //quita la ultima coma.
        // echo $Datas."|".$Labels;
        
        
            echo '<div style="" class="Graficas">';
            GraficaDona($Labels,$Datas,"OFERTA/VENTA");
            echo '</div>';

            
        ?>



<?php
       
        ?>

       <?php
        $Datas = SilosData('Data');
        $Labels = SilosData('Label');
        unset($rf);unset($Fr);
        $Datas = substr($Datas, 0, -1); //quita la ultima coma.
        $Labels = substr($Labels, 0, -1); //quita la ultima coma.
        // echo "<br>Labels=".$Labels."<br>Datas=".$Datas."<br>";
        
            echo '<div style="" class="Graficas">';
            GraficaBar2($Labels,$Datas,"Silos");
            echo '</div>';


        ?>


        <?php
        $Total = SilosDataTotal('Data');
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


        ?>
    </div>

    <div id="DashboardCol2" style="vertical-align:top;">
    

    <?php
     $rF= $db0 -> query("select * from reportes where Portada=1");    
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
         opacity: 0.6;'>Inventarios</h6>";
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
    ?>
    </div>


    
    
</div>

<?php
UltimasBusquedas_buble($RinteraUser);

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

<!-- <a href='#DivModal' rel=MyModal:open onclick='URLModal(1)' class='icon'><img src='icon/check3.png'></a> -->

<!-- <a href="app_detalles.php?id=1&amp;tipo=AROMA&amp;var1=1" rel="MyModal:open" class="icon"><img src="icon/info.png"></a> -->

<?php
Historia($RinteraUser, "HOME", "Acceso a la pagina principal");


function SilosData($Data){
require("rintera-config.php");

$QueryEncabezado = "
Select * from NivelesDeLosSilos order by IdSilo
";

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
                    $DataG.= "".$val.",";
                }

                    
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
}



function SilosDataTotal($Data){
    require("rintera-config.php");
    
    $QueryEncabezado = "
    Select * from NivelesDeLosSilos order by IdSilo
    ";
    
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
                        $DataG.= "".$val.",";
                        $Total = $Total + $val;
                    }
    
                        
                        // $TablaDeta.= "<tr><td>".$key."</td><td>".$val."</td></tr>";
                        
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
