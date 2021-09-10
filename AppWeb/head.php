<?php
require ("seguridad.php");   
require ("rintera-config.php");
require ("components.php");

    if (isset($RinteraUser)){
        MiToken_CloseALL($RinteraUser);
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset=utf-8>
    <meta http-equiv=x-ua-compatible content="ie=edge">
    <meta name=viewport content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name=apple-mobile-web-app-capable content=yes />
    <meta name=apple-mobile-web-app-status-bar-style content=black />
    <meta name=format-detection content="telephone=no" />
    <title>Procimart</title>
    <link rel="shortcut icon" href="img/logo.ico" type="image/x-icon" />
    <meta name=author content="Procimart">
    <meta http-equiv="x-ua-compatible" content="ie-edge">
    <link rel="stylesheet" href="src/default.css">

    <!-- JQUERY -->
    <script src="node_modules/jquery/dist/jquery.min.js"></script>

    <!-- BOOTSTRAP -->
    <script src="node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css">    
    <script src="node_modules/popper.js/dist/popper.min.js"></script>
    
    <!-- DATATABLE -->
    <script src="lib/datatables.min.js"></script>
    <!-- <script src="lib/jquery.dataTables.min.js"></script> -->
    <script src="lib/dataTables.fixedColumns.min.js"></script>    
    <script src="lib/dataTables.buttons.min.js"></script>    
    <script src="lib/jszip.min.js"></script>    
    <script src="lib/pdfmake.min.js"></script>    
    <script src="lib/vfs_fonts.js"></script>    
    <script src="lib/buttons.html5.min.js"></script>    
    <!-- <script src="lib/datetime.js"></script>     -->

    <link rel="stylesheet" href="lib/jquery.dataTables.min.css">    
    <link rel="stylesheet" href="lib/buttons.dataTables.min.css">    
    
    <!-- fontawesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">    

    <!-- TOAST -->
    <link rel="stylesheet" href="lib/jquery.toast.min.css">
    <script type="text/javascript" src="lib/jquery.toast.min.js"></script>

    <!-- Modal -->
    <script src="lib/jquery.modalpdz.js"></script> 
    <link rel="stylesheet" href="lib/jquery.modalcsspdz.css" />

    <!-- ChatJS -->
    <script src="node_modules/chart.js/dist/Chart.bundle.js"></script> 
    <link rel="stylesheet" href="node_modules/chart.js/dist/Chart.css" />

    <!-- <link rel="icon" href="data:;base64,iVBORw0KGgo=">
    <link rel="shortcut icon" href="favicon.ico">
    <link rel="shortcut icon" href="data:image/x-icon;," type="image/x-icon"> -->
</head>

<body style="
background-color: #cac0c0;
text-align:center;
">

<?php
//   echo   "1".$_SESSION['RinteraUser'];
// Init();
?>

<div id='PreLoader' style='
    background-color: <?php echo Preference("ColorPrincipal", "", ""); ?> ;
    opacity: 0.7;
'>
    <div id='Loader' style='
        left: 30%;
        top: 26%;
        '>
        <img src='img/Logo.png' style='width:80px;'><br>
        <b style='color:white;'>Un momento por favor, cargando información</b> <img src='img/loader1.gif' style='width:30px;'><br>
    </div>
</div>