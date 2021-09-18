<?php
    include("head.php");
    include("header.php");
    require("app_funciones.php");
?>

<div id='InfoMov2' class=' movil' style='width: 97%; padding: 5px; background-color: white; border-radius: 4px; margin-top: 14px;'> </div>
<div id='InfoMov' class=' pc' style='width: 97%; padding: 5px; background-color: white; border-radius: 4px; margin-top: 14px;'> </div>

<script>
    function CargaMovs(){
        $.ajax({
        url: 'app_cargamovs.php',
        type: 'post',
        data: {
        
        },
        success: function(data) {
            $('#InfoMov').html(data);
            $('#PreLoader').hide(); }
        }); 
    }

    CargaMovs();

    function CargaMovs2(){
        $.ajax({
        url: 'app_cargamovs2.php',
        type: 'post',
        data: {
        
        },
        success: function(data) {
            $('#InfoMov2').html(data);
            $('#PreLoader').hide(); }
        }); 
    }

    CargaMovs2();
    
    function Del(IdMov){
        $.ajax({
        url: 'app_cargamovs_del.php',
        type: 'post',
        data: {
           IdMov:IdMov
        },
        success: function(data) {
            $('#R').html(data);
            $('#PreLoader').hide(); }
        }); 
    }
</script>
<?php
    include("footer.php");
?>