<?php
$sombra = "
-webkit-box-shadow: inset 0px -36px 13px -31px rgba(0,0,0,0.39);
-moz-box-shadow: inset 0px -36px 13px -31px rgba(0,0,0,0.39);
box-shadow: inset 0px -36px 13px -31px rgba(0,0,0,0.39);
";


    echo "
    <div id='Welcome' style=''>
    <table width=100% border=0><tr>
    ";

    if (Preference("VisualLogo","","")=="TRUE"){
        echo "<td width=10px style='
        background-color: ".Preference("ColorPrincipal", "", "").";
        ".$sombra."
        '>";
        echo "<a href='index.php'>";
        $ArchivoLogo = "";
         if (Preference("LogoImagePNG","","")=="TRUE"){
            $ArchivoLogo = "img/Logo.png";
         } else {
            $ArchivoLogo = "img/Logo.jpg";
         }

         if (Preference("LogoColorInverso", "", "")=='TRUE') {
            echo "<img src='".$ArchivoLogo."' style='height:85px; padding:2px; filter: invert(100%) brightness(183%);'>";
         } else {
            echo "<img src='".$ArchivoLogo."' style='height:85px; padding:2px;'>";
         }
         echo "</a>";
        echo "</td>";
    }

    echo "
    <td 
 
    style='
    background-color: ".Preference("ColorPrincipal", "", "").";
    color: white;
    font-size: 13pt;
    text-align: left;
    ".$sombra."

    '>
    ";
    echo "<a style='
    display: block;
    color: white;
    font-family: ExtraBold;
    text-transform: uppercase;
    
    font-size: 17pt;
    margin-bottom: -10px

      ' href='index.php' title='Haz clic aqui para retomar al inicio'>".Preference("RinteraName","","")."</a>
   <cite style='font-size:8pt;'>"."Control de inventarios"."</cite>
   </td>";
   




    echo "<td  
            valing=middle  style='text-align: right; background-color: ".Preference("ColorPrincipal", "", "").";
            color: white; font-size: 15pt; padding-right: 15px;
            ".$sombra."'>
            <img src='icon/atencion.png' style='width:27px;' class='pc'>
            <span class='pc'> "
               .$_SESSION['RinteraUserName'].
            "</span> 
         </td>";

         echo "<td  valing=middle  style='
    text-align: right;
    background-color: ".Preference("ColorPrincipal", "", "").";
    color: white;
    padding-right: 15px;
    ".$sombra."
    '><a href='nip.php' title='Cambiar contraseña actual'><img src='icon/candado.png' style='width:27px;'></a> </td>";

    if (UserAdmin($RinteraUser)==TRUE){
        
        
        if (Preference("Custom", "", "")=='TRUE'){
         echo "<td width=22px align=right 
         style='
         
         background-color: ".Preference("ColorPrincipal", "", "").";
         font-size: 15pt;
         color: white;
         padding-right: 5px;
         ".$sombra."
         '
         >";
        echo "<a href='custom.php?db=' title='Haga clic aqui para ajustar las preferencias'>";
        echo " <img src='icon/config.png' style='width:27px; margin:3px;'> ";
        echo "</a>";
        echo "</td>";
        }
        
       
    
    }
    

    // $Pendientes = 3;

    // if ($Pendientes >0 ){
    //     echo "
    //     <td  style='background-color:".Preference("ColorResaltado", "", "").";color:white; font-weight:bold;     ".$sombra."' align=center title='Pendientes por checar'>
    //     ".$Pendientes."
    //     </td>";

    // } else {
    //     echo "
    //     <td width=0px  style='background-color:".Preference("ColorPrincipal", "", "").";     ".$sombra."' align=center>
        
    //     </td>";
    // }


    echo "
    <td width=10px valign=midle style='background-color:".Preference("ColorPrincipal", "", "").";     ".$sombra."'>
    <a href='logout.php'  title='Cerrar sesión actual' style=''>    
    <img src='icon/salir2.png' style='width:17px; margin-right:4px;'></a>
    
    </td>";
   //  <a href='logout.php'  title='Cerrar sesión: ".$RinteraUserName."' style=''>     

   //  echo "
   //  <td width=10px valign=midle style='background-color:".Preference("ColorPrincipal", "", "").";     ".$sombra."'>
   //  <a href='index.php'  title='Ir a pagina principal' style=''>    
   //  <img src='icon/home.png' style='width:30px; margin-right:0px;'></a>
   //  </td>";

   //  <a href='index.php'  title='Home: ".$RinteraUserName."' style=''>    
    
    echo "</tr> </table> </div> ";


    //Validamos si se reseteo el nIp
   //  if (UserNIP($RinteraUser) == $RinteraUser) {
   //    echo '<script>window.location.replace("nip.php")</script>'; 
   //  }

?>