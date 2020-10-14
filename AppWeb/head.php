
<?php
require ("rintera-config.php");
require ("components.php");








    include("seguridad.php");   
    MiToken_CloseALL($RinteraUser);



?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">	
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?php echo Preference("RinteraName","","")." ".Preference("RinteraDescription","","")." by Rintera" ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=yes">
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

    
    
    <!-- <link href="lib/jquery.flexdatalist.css" rel="stylesheet" type="text/css">
    <script src="lib/jquery.flexdatalist.js"></script> -->
    <!-- <script src="lib/jcanvas.min.js"></script> --> 
    <!-- <script src="lib/apexcharts.min.js"></script> -->
    <!-- <link rel="stylesheet" type="text/css" href="lib/bootstrap/css/bootstrap.css">
    
    
    <link rel="stylesheet" type="text/css" href="lib/datatables.min.css"/> 
    <script type="text/javascript" src="lib/datatables.min.js"></script>
    <script src="lib/jquery.modalpdz.js"></script> 
    <link rel="stylesheet" href="lib/jquery.modalcsspdz.css" /> -->


 

<link rel="icon" href="data:;base64,iVBORw0KGgo=">
<link rel="shortcut icon" href="favicon.ico">
<link rel="shortcut icon" href="data:image/x-icon;," type="image/x-icon">
</head>
<body style="
background-color: <?php echo Preference("ColorDeFondo", "", ""); ?>;
text-align:center;
">
<?php
// Init();
?>

<div id='PreLoader'>
    <div id='Loader'>
        <img src='img/loader_classic.gif'><br>
    </div>
</div>