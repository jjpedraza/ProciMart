<?php
  session_start();
  // session_regenerate_id();    
  echo "Id: ".session_id();            

  
  $_SESSION['RinteraUser'] = "root";
  
    echo   $_SESSION['RinteraUser'];
?>