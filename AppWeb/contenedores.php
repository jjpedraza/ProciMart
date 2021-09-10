<?php
    include ("lib/body_head.php");
?>
<style type="text/css">
    #app_contenedor {
        display: grid;
        grid-template-columns: 33.3% 33.3% 33.3%;
        background-color: #fff;
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

</style>
<?php
$sqlCat="select * from Contenedores ";

$rc = $conexion -> query($sqlCat);
echo "<div id='app_contenedor' >";
$c=0;
while($fc = $rc -> fetch_array())
{

    $porcentaje = ($fc['Existencia']*100)/$fc['Capacidad'];
    
    echo "<div id='silo' >";
    echo "<table style='width:100%; '>";
    echo "<tr>";
    echo "<td style='width:70%; font-size:12pt; color:#33E0FF; 
        padding-right: 10px;
        padding-left: 10px;
        padding-top: 10px;'>";
    echo "NOMBRE";
    echo "</td>";
    echo "<td>";
    echo "</td>";
    echo "</tr>";
    echo "<tr>";
    echo "<td style='width:70%; border-bottom: 1px solid #fff; font-size:16pt; color:#fff; 
        padding-right: 10px;
        padding-left: 10px;'>";
    echo $fc['Nombre'];
    echo "</td>";
    echo "<td style='width:30%;  
        padding-right: 10px;
        padding-bottom: 10px;
     ' rowspan='4'>";
    echo '<div style="clip-path: polygon(40% 0, 60% 0, 75% 10%, 75% 80%, 55% 100%, 45% 100%, 25% 80%, 25% 10%);
        width: 150px;
        height: 200px;
        background-image: linear-gradient( 0deg, #F36D10 0%, #F36D10 '.$porcentaje.'%, #292423 0%, #292423 100%);">';
    echo '</div>';
    echo "</td>";
    echo "</tr>";
    echo "<tr>";
    echo "<td style='width:70%; font-size:12pt; color:#33E0FF; 
        padding-right: 10px;
        padding-left: 10px;'>";
    echo "CAPACIDAD";
    echo "</td>";
    echo "</tr>";
    echo "<tr>";
    echo "<td style=' width:70%; font-size:16pt; color:#fff; 
        padding-right: 10px;
        padding-left: 10px;'>";
    echo $fc['Capacidad'].' Kilogramos';
    echo "</td>";
    echo "</tr>";
    echo "<tr>";
    echo "<td style=' width:70%; font-size:12pt; color:#33E0FF; 
        padding-right: 10px;
        padding-left: 10px;'>";
    echo "DISPONIBLE";
    echo "</td>";
    echo "</tr>";
    echo "<tr>";
    echo "<td style='width:70%; font-size:16pt; color:#fff; 
        padding-right: 10px;
        padding-left: 10px;'>";
    echo $fc['Existencia'].' Kilogramos';
    echo "</td>";
    echo "<td style='width:30%; font-size:16pt; color:#fff; text-align: center; 
        padding-right: 10px;
        padding-left: 10px;' >";
    echo number_format($porcentaje,2,'.',',').'%';
    echo "</td>";
    echo "</tr>";
    echo "<tr>";
    echo "<td colspan='2' style='text-align:center; width:100%; font-size:14pt; color:#fff; 
        padding-top: 10px;
        padding-right: 10px;
        padding-left: 10px;
        padding-bottom: 10px;'>";
    echo date("F j, Y");
    echo "</td>";
    echo "</tr>";
    echo "</table>";
    echo "</div>";
     
}

echo "</div>";

?>
<?php include ("lib/body_footer.php"); ?>