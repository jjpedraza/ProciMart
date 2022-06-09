<?php
    include ("head.php");
    include ("header.php");
?>

<div id='Dashboard'>
    <div id="DashboardCol1"  >
       <?php
            echo "<div style='background-color: #0E3B76; border-radius: 1px;'>";
                echo "<table style='width:100%; font-size: 14pt; color:#fff; padding-right: 10px; padding-left: 10px; padding-top:10px; padding-bottom:20px;'>";
                    echo "<td style='width:100%; color: white; vertical-align: middle;'> Proceso de subir inventarios a la NUBE </td>";
                echo "</table>";
            echo "</div>";
        ?>
    </div>
</div>
        
<?php
    //------------------ Proceso de importacion de información --------------------------------
    echo "<div id='app_contenedor'>";
        //------------------ Proceso de importacion de SILOS --------------------------------
        $Labels = SilosData('Label');
        $Datas =  SilosData('Data');
        $FechaUltMov = SilosData('Fecha');

        $Datas = substr($Datas, 0, -1);                     //quita la ultima coma.
        $Labels = substr($Labels, 0, -1);                   //quita la ultima coma.
        $FechaUltMov = substr($FechaUltMov, 0, -1);         //quita la ultima coma.
        
        $cantidad = explode(",", $Datas);
        $nombre = explode(",", $Labels);
        $ultimomov = explode(",", $FechaUltMov);

        for($i=0; $i< sizeof($cantidad); $i++)
            {
                $silo = $i + 1;
                $fecha = substr($ultimomov[$i], 6, 4)."-".substr($ultimomov[$i], 3, 2)."-".substr($ultimomov[$i], 0, 2);

                $sql = "Update nivelesdelossilos set capacidad = 97200, existencia = ".$cantidad[$i].", fecultmovimiento = '".$fecha."' Where idsilo  = ".$silo;
                if ($db0->query($sql) == TRUE)
                    {          

                    }
                else
                    {            

                    }
            }
        echo 'Tabla: nivelesdelossilos';

        //------------------ Proceso de importacion de concentrado de silos  --------------------------------
        $idsilo_data = concentradodesilos_data('idsilo');
        $tank_data = concentradodesilos_data('tank');
        $variety_data = concentradodesilos_data('variety');
        $ingall_data = concentradodesilos_data('ingall');
        $brix_data = concentradodesilos_data('brix');
        $ps_data = concentradodesilos_data('ps');
        $ratio_data = concentradodesilos_data('ratio');
        $acid_data = concentradodesilos_data('acid');
        $oil_data = concentradodesilos_data('oil');
        $color_data = concentradodesilos_data('color');
        $n_data = concentradodesilos_data('n');
        $defects_data = concentradodesilos_data('defects');
        $flavor_data = concentradodesilos_data('flavor');
        $score_data = concentradodesilos_data('score');
        $porchow_data = concentradodesilos_data('porchow');
        $visc_data = concentradodesilos_data('visc');

        $idsilo_data = substr($idsilo_data, 0, -1);
        $tank_data = substr($tank_data, 0, -1);
        $variety_data = substr($variety_data, 0, -1);
        $ingall_data = substr($ingall_data, 0, -1);
        $brix_data = substr($brix_data, 0, -1);
        $ps_data = substr($ps_data, 0, -1);
        $ratio_data = substr($ratio_data, 0, -1);
        $acid_data = substr($acid_data, 0, -1);
        $oil_data = substr($oil_data, 0, -1);
        $color_data = substr($color_data, 0, -1);
        $n_data = substr($n_data, 0, -1);
        $defects_data = substr($defects_data, 0, -1);
        $flavor_data = substr($flavor_data, 0, -1);
        $score_data = substr($score_data, 0, -1);
        $porchow_data = substr($porchow_data, 0, -1);
        $visc_data = substr($visc_data, 0, -1);

        $idsilo_valor = explode(",", $idsilo_data);
        $tank_valor = explode(",", $tank_data);
        $variety_valor = explode(",", $variety_data);
        $ingall_valor = explode(",", $ingall_data);
        $brix_valor = explode(",", $brix_data);
        $ps_valor = explode(",", $ps_data);
        $ratio_valor = explode(",", $ratio_data);
        $acid_valor = explode(",", $acid_data);
        $oil_valor = explode(",", $oil_data);
        $color_valor = explode(",", $color_data);
        $n_valor = explode(",", $n_data);
        $defects_valor = explode(",", $defects_data);
        $flavor_valor = explode(",", $flavor_data);
        $score_valor = explode(",", $score_data);
        $porchow_valor = explode(",", $porchow_data);
        $visc_valor = explode(",", $visc_data);

        for($i=0; $i< sizeof($idsilo_valor); $i++)
            {
                $sql = "delete from informacionconcentradodesilos where idsilo = '".$idsilo_valor[$i]."'";
                if ($db0->query($sql) == TRUE){}
                else{}

                $sql = "Insert into informacionconcentradodesilos (idsilo, tank, variety, ingall, brix, ps, ratio, acid, oil, color, n, defects, flavor, score, porchow, visc) values (
                    $idsilo_valor[$i]".","."
                    $tank_valor[$i]".","."
                    $variety_valor[$i]".","."
                    $ingall_valor[$i]".","."
                    $brix_valor[$i]".","."
                    $ps_valor[$i]".","."
                    $ratio_valor[$i]".","."
                    $acid_valor[$i]".","."
                    $oil_valor[$i]".","."
                    $color_valor[$i]".","."
                    $n_valor[$i]".","."
                    $defects_valor[$i]".","."
                    $flavor_valor[$i]".","."
                    $score_valor[$i]".","."
                    $porchow_valor[$i]".","."
                    $visc_valor[$i]".""."
                )";

                if ($db0->query($sql) == TRUE){}
                else{}
            }
        echo 'Tabla: informacionconcentradodesilos';

        //------------------ Proceso de subir dettales de un silo --------------------------------
        $sql = "delete from silos_detalle";
        if ($db0->query($sql) == TRUE){}
        else{}

        $idsilo = Extrae_SilosDetalle('IdSilo');
        $idcertificado = Extrae_SilosDetalle('IdCertificado');
        $idtipodeenvasado = Extrae_SilosDetalle('IdTipoDeEnvasado');
        $secuencia = Extrae_SilosDetalle('Secuencia');
        $lotenum = Extrae_SilosDetalle('LoteNum');
        $fecha = Extrae_SilosDetalle('Fecha');
        $ingall = Extrae_SilosDetalle('InGall');
        $brix = Extrae_SilosDetalle('Brix');
        $brixred = Extrae_SilosDetalle('BrixRed');
        $factor = Extrae_SilosDetalle('Factor');
        $ps = Extrae_SilosDetalle('Ps');
        $ratio = Extrae_SilosDetalle('Ratio');
        $acid = Extrae_SilosDetalle('Acid');
        $oil = Extrae_SilosDetalle('Oil');
        $color = Extrae_SilosDetalle('Color');
        $n = Extrae_SilosDetalle('N');
        $defects = Extrae_SilosDetalle('Defects');
        $flavor = Extrae_SilosDetalle('Flavor');
        $score = Extrae_SilosDetalle('Score');
        $porcpulpa = Extrae_SilosDetalle('PorcPulpa');
        $ph = Extrae_SilosDetalle('Ph');
        $porcpww = Extrae_SilosDetalle('Porcpww');
        $porcaire = Extrae_SilosDetalle('PorcAire');
        $vitaminac = Extrae_SilosDetalle('VitaminaC');
        $porchow = Extrae_SilosDetalle('PorcHow');
        $visc = Extrae_SilosDetalle('Visc');

        $idsilo_data = substr($idsilo, 0, -1);
        $idcertificado_data = substr($idcertificado, 0, -1);
        $idtipodeenvasado_data = substr($idtipodeenvasado, 0, -1);
        $secuencia_data = substr($secuencia, 0, -1);
        $lotenum_data = substr($lotenum, 0, -1);
        $fecha_data = substr($fecha, 0, -1);
        $ingall_data = substr($ingall, 0, -1);
        $brix_data = substr($brix, 0, -1);
        $brixred_data = substr($brixred, 0, -1);
        $factor_data = substr($factor, 0, -1);
        $ps_data = substr($ps, 0, -1);
        $ratio_data = substr($ratio, 0, -1);
        $acid_data = substr($acid, 0, -1);
        $oil_data = substr($oil, 0, -1);
        $color_data = substr($color, 0, -1);
        $n_data = substr($n, 0, -1);
        $defects_data = substr($defects, 0, -1);
        $flavor_data = substr($flavor, 0, -1);
        $score_data = substr($score, 0, -1);
        $porcpulpa_data = substr($porcpulpa, 0, -1);
        $ph_data = substr($ph, 0, -1);
        $porcpww_data = substr($porcpww, 0, -1);
        $porcaire_data = substr($porcaire, 0, -1);
        $vitaminac_data = substr($vitaminac, 0, -1);
        $porchow_data = substr($porchow, 0, -1);
        $visc_data = substr($visc, 0, -1);

        $Valor_idsilo = explode(",", $idsilo_data);
        $Valor_idcerticado = explode(",", $idcertificado_data);
        $Valor_idtipodeenvasado = explode(",", $idtipodeenvasado_data);
        $Valor_secuencia = explode(",", $secuencia_data);
        $Valor_lotenum = explode(",", $lotenum_data);
        $Valor_fecha = explode(",", $fecha_data);
        $Valor_ingall = explode(",", $ingall_data);
        $Valor_brix = explode(",", $brix_data);
        $Valor_brixred = explode(",", $brixred_data);
        $Valor_factor = explode(",", $factor_data);
        $Valor_ps = explode(",", $ps_data);
        $Valor_ratio = explode(",", $ratio_data);
        $Valor_acid = explode(",", $acid_data);
        $Valor_oil = explode(",", $oil_data);
        $Valor_color = explode(",", $color_data);
        $Valor_n = explode(",", $n_data);
        $Valor_defects = explode(",", $defects_data);
        $Valor_flavor = explode(",", $flavor_data);
        $Valor_score = explode(",", $score_data);
        $Valor_porcpulpa = explode(",", $porcpulpa_data);
        $Valor_ph = explode(",", $ph_data);
        $Valor_porcpww = explode(",", $porcpww_data);
        $Valor_porcaire = explode(",", $porcaire_data);
        $Valor_vitaminac = explode(",", $vitaminac_data);
        $Valor_porchow = explode(",", $porchow_data);
        $Valor_visc = explode(",", $visc_data);
        
        for($i=0; $i< sizeof($Valor_idsilo); $i++)
            {
                $fecha = substr($Valor_fecha[$i], 6, 4)."-".substr($Valor_fecha[$i], 3, 2)."-".substr($Valor_fecha[$i], 0, 2);
                $sql = "Insert into silos_detalle (idsilo, idcertificado, lotenum, fecha, ingall, brix, brixred, factor, ps, ratio, acid, oil, color, n, defects, flavor, score, porcpulpa, ph, porcpww, porcaire, vitaminac, porchow, visc) 
                values 
                ("
                    .$Valor_idsilo[$i].","
                    .$Valor_idcerticado[$i].",'"
                    .$Valor_lotenum[$i]."','"
                    .$fecha."',"
                    .$Valor_ingall[$i].","
                    .$Valor_brix[$i].","
                    .$Valor_brixred[$i].","
                    .$Valor_factor[$i].","
                    .$Valor_ps[$i].","
                    .$Valor_ratio[$i].","
                    .$Valor_acid[$i].","
                    .$Valor_oil[$i].","
                    .$Valor_color[$i].","
                    .$Valor_n[$i].","
                    .$Valor_defects[$i].","
                    .$Valor_flavor[$i].","
                    .$Valor_score[$i].","
                    .$Valor_porcpulpa[$i].","
                    .$Valor_ph[$i].","
                    .$Valor_porcpww[$i].","
                    .$Valor_porcaire[$i].","
                    .$Valor_vitaminac[$i].","
                    .$Valor_porchow[$i].","
                    .$Valor_visc[$i].")";
                if ($db0->query($sql) == TRUE){}
                else{}
            }
        echo 'Tabla: silos_detalle';

            //------------------ Proceso de subir empleados --------------------------------            
        $Usuario_Data = UsuarioData('Usuario');
        $Contraseña_Data  =  UsuarioData('Contraseña');
        $NombreCompleto_Data  = UsuarioData('NombreCompleto');

        $Usuario_Data = substr($Usuario_Data, 0, -1);
        $Contraseña_Data = substr($Contraseña_Data, 0, -1);
        $NombreCompleto_Data = substr($NombreCompleto_Data, 0, -1);

        $Valor_Usuario = explode(",", $Usuario_Data);
        $Valor_Contraseña = explode(",", $Contraseña_Data);
        $Valor_NombreCompleto = explode(",", $NombreCompleto_Data);

        for($i=0; $i< sizeof($Valor_Usuario); $i++)
            {
                $sql = "delete from users where IdUser = '".$Valor_Usuario[$i]."'";
                if ($db0->query($sql) == TRUE){}
                else{}

                $sql = "Insert into users (IdUser, NIP, UserName, RinteraLevel, Estatus) values ('".$Valor_Usuario[$i]."',"."'".$Valor_Contraseña[$i]."'".","."'".$Valor_NombreCompleto[$i]."',1, 1)";
                if ($db0->query($sql) == TRUE){}
                else{}
            }
        echo 'Tabla: users';

        //------------------ Proceso de subir lugar de almacenamientos  --------------------------------
        $sql = "delete from catalogolugardealmacenamientos";
        if ($db0->query($sql) == TRUE){}
        else{}

        $idlugardealmacenamiento = LugarDealmacenamientos_Data('IdLugarDeAlmacenamiento');
        $lugardealmacenamiento = LugarDealmacenamientos_Data('LugarDeAlmacenamiento');
        $ordenvisual = LugarDealmacenamientos_Data('OrdenVisual');

        $idlugardealmacenamiento_Data = substr($idlugardealmacenamiento, 0, -1);
        $lugardealmacenamiento_Data = substr($lugardealmacenamiento, 0, -1);
        $ordenvisual_Data = substr($ordenvisual, 0, -1);

        $Valor_idlugardealmacenamiento = explode(",", $idlugardealmacenamiento_Data);
        $Valor_lugardealmacenamiento = explode(",", $lugardealmacenamiento_Data);
        $Valor_ordenvisual = explode(",", $ordenvisual_Data);

        for($i=0; $i< sizeof($Valor_idlugardealmacenamiento); $i++)
            {
                $sql = "Insert into catalogolugardealmacenamientos (idlugardealmacenamiento, lugardealmacenamiento, ordenvisual) 
                values 
                ("
                    .$Valor_idlugardealmacenamiento[$i].",'".
                    $Valor_lugardealmacenamiento[$i]."',".
                    $Valor_ordenvisual[$i].""."
                )
                ";
                if ($db0->query($sql) == TRUE){}
                else{}
            }
        echo 'Tabla: catalogolugardealmacenamientos';


        //------------------ Proceso de subir Grupo de Citricos --------------------------------
        $sql = "delete from catalogogruposdecitricos";
        if ($db0->query($sql) == TRUE){}
        else{}

        $idgrupocitrico = GrupoDeCitricos_Data('IdGrupoCitrico');
        $descripcion = GrupoDeCitricos_Data('Descripcion');
        $ordenvisual = GrupoDeCitricos_Data('OrdenVisual');
        $idestatusdelregistro = GrupoDeCitricos_Data('IdEstatusDelRegistro');

        $idgrupocitrico_data = substr($idgrupocitrico, 0, -1);
        $descripcion_data = substr($descripcion, 0, -1);
        $ordenvisual_data = substr($ordenvisual, 0, -1);
        $idestatusdelregistro_data = substr($idestatusdelregistro, 0, -1);

        $Valor_idgrupocitrico = explode(",", $idgrupocitrico_data);
        $Valor_descripcion = explode(",", $descripcion_data);
        $Valor_ordenvisual = explode(",", $ordenvisual_data);
        $Valor_idestatusdelregistro = explode(",", $idestatusdelregistro_data);

        for($i=0; $i< sizeof($Valor_idgrupocitrico); $i++)
            {
                $sql = "Insert into catalogogruposdecitricos (idgrupocitrico, descripcion, ordenvisual, idestatusdelregistro) 
                values 
                ("
                    .$Valor_idgrupocitrico[$i].",'".
                    $Valor_descripcion[$i]."',".
                    $Valor_ordenvisual[$i].",".
                    $Valor_idestatusdelregistro[$i]."
                )";
                if ($db0->query($sql) == TRUE){}
                else{}
            }
        echo 'Tabla: catalogogruposdecitricos';

        //------------------ Proceso de subir catalogo de frutas --------------------------------
        $sql = "delete from catalogodefrutas";
        if ($db0->query($sql) == TRUE){}
        else{}

        $idfruta = catalogodefrutas_Data('IdFruta');
        $descripcion = catalogodefrutas_Data('Descripcion');
        $ordenvisual = catalogodefrutas_Data('OrdenVisual');
        $idestatusdelregistro = catalogodefrutas_Data('IdEstatusDelRegistro');

        $idfruta_data = substr($idfruta, 0, -1);
        $descripcion_data = substr($descripcion, 0, -1);
        $ordenvisual_data = substr($ordenvisual, 0, -1);
        $idestatusdelregistro_data = substr($idestatusdelregistro, 0, -1);

        $Valor_idfruta = explode(",", $idfruta_data);
        $Valor_descripcion = explode(",", $descripcion_data);
        $Valor_ordenvisual = explode(",", $ordenvisual_data);
        $Valor_idestatusdelregistro = explode(",", $idestatusdelregistro_data);

        for($i=0; $i< sizeof($Valor_idfruta); $i++)
            {
                $sql = "Insert into catalogodefrutas (idfruta, descripcion, ordenvisual, idestatusdelregistro) 
                values 
                ("
                    .$Valor_idfruta[$i].",'".
                    $Valor_descripcion[$i]."',".
                    $Valor_ordenvisual[$i].",".
                    $Valor_idestatusdelregistro[$i]."
                )";
                if ($db0->query($sql) == TRUE){}
                else{}
            }
        echo 'Tabla: catalogodefrutas';

        //------------------ Proceso de subir tipo de inventario --------------------------------
        $sql = "delete from catalogotipodeinventario";
        if ($db0->query($sql) == TRUE){}
        else{}

        $idtipodeinventario = catalogotipodeinventarios_Data('IdTipoDeInventario');
        $tipodeinventario = catalogotipodeinventarios_Data('TipoDeInventario');
        $ordenvisual = catalogotipodeinventarios_Data('OrdenVisual');
        $idestatusdelregistro = catalogotipodeinventarios_Data('IdEstatusDelRegistro');

        $IdTipoDeInventario_data = substr($idtipodeinventario, 0, -1);
        $TipoDeInventario_data = substr($tipodeinventario, 0, -1);
        $ordenvisual_data = substr($ordenvisual, 0, -1);
        $idestatusdelregistro_data = substr($idestatusdelregistro, 0, -1);

        $Valor_IdTipoDeInventario = explode(",", $IdTipoDeInventario_data);
        $Valor_tipodeinventario = explode(",", $TipoDeInventario_data);
        $Valor_ordenvisual = explode(",", $ordenvisual_data);
        $Valor_idestatusdelregistro = explode(",", $idestatusdelregistro_data);

        for($i=0; $i< sizeof($Valor_IdTipoDeInventario); $i++)
            {
                $sql = "Insert into catalogotipodeinventario (idtipodeinventario, tipodeinventario, ordenvisual, idestatusdelregistro) 
                values 
                ("
                    .$Valor_IdTipoDeInventario[$i].",'".
                    $Valor_tipodeinventario[$i]."',".
                    $Valor_ordenvisual[$i].",".
                    $Valor_idestatusdelregistro[$i]."
                )";
                if ($db0->query($sql) == TRUE){}
                else{}
            }
        echo 'Tabla: catalogotipodeinventario';

        //------------------ Proceso de subir catalogo de almacen --------------------------------
        $sql = "delete from catalogodealmacenes";
        if ($db0->query($sql) == TRUE){}
        else{}

        $idalmacen = catalogodealmacenes_Data('IdAlmacen');
        $nombrecorto = catalogodealmacenes_Data('NombreCorto');
        $ordenvisual = catalogodealmacenes_Data('OrdenVisual');
        $idestatusdelregistro = catalogodealmacenes_Data('IdEstatusDelRegistro');

        $idalmacen_data = substr($idalmacen, 0, -1);
        $nombrecorto_data = substr($nombrecorto, 0, -1);
        $ordenvisual_data = substr($ordenvisual, 0, -1);
        $idestatusdelregistro_data = substr($idestatusdelregistro, 0, -1);

        $Valor_idalmacen = explode(",", $idalmacen_data);
        $Valor_nombrecorto = explode(",", $nombrecorto_data);
        $Valor_ordenvisual = explode(",", $ordenvisual_data);
        $Valor_idestatusdelregistro = explode(",", $idestatusdelregistro_data);

        for($i=0; $i< sizeof($Valor_idalmacen); $i++)
            {
                $sql = "Insert into catalogodealmacenes (idalmacen, nombrecorto, ordenvisual, idestatusdelregistro) 
                values 
                ("
                    .$Valor_idalmacen[$i].",'".
                    $Valor_nombrecorto[$i]."',".
                    $Valor_ordenvisual[$i].",".
                    $Valor_idestatusdelregistro[$i]."
                )";
                if ($db0->query($sql) == TRUE){}
                else{}
            }
        echo 'Tabla: catalogodealmacenes';

        //------------------ Proceso de subir calendario de embarques --------------------------------
        $sql = "delete from calendariodeembarques";
        if ($db0->query($sql) == TRUE){}
        else{}

        $codigo = calendariodeembarques_Data('codigo');
        $titulo = calendariodeembarques_Data('titulo');
        $descripcion = calendariodeembarques_Data('descripcion');
        $inicio = calendariodeembarques_Data('inicio');
        $fin = calendariodeembarques_Data('fin');
        $colortexto = calendariodeembarques_Data('colortexto');
        $colorfondo = calendariodeembarques_Data('colorfondo');

        $codigo_data = substr($codigo, 0, -1);
        $titulo_data = substr($titulo, 0, -1);
        $descripcion_data = substr($descripcion, 0, -1);
        $inicio_data = substr($inicio, 0, -1);
        $fin_data = substr($fin, 0, -1);
        $colortexto_data = substr($colortexto, 0, -1);
        $colorfondo_data = substr($colorfondo, 0, -1);

        $Valor_codigo = explode(",", $codigo_data);
        $Valor_titulo = explode(",", $titulo_data);
        $Valor_descripcion = explode(",", $descripcion_data);
        $Valor_inicio = explode(",", $inicio_data);
        $Valor_fin = explode(",", $fin_data);
        $Valor_colortexto = explode(",", $colortexto_data);
        $Valor_colorfondo = explode(",", $colorfondo_data);

        for($i=0; $i< sizeof($Valor_codigo); $i++)
            {
                $fecha = substr($Valor_inicio[$i], 6, 4)."-".substr($Valor_inicio[$i], 3, 2)."-".substr($Valor_inicio[$i], 0, 2);
                $sql = "Insert into calendariodeembarques (codigo, titulo, descripcion, inicio, fin, colortexto, colorfondo) 
                values 
                ("
                    .$Valor_codigo[$i].",'".$Valor_titulo[$i]."',".$Valor_descripcion[$i].",'".$fecha."','".$fecha."','#000000','#3788d8'"."
                )";
                if ($db0->query($sql) == TRUE){}
                else{}
            }
        echo 'Tabla: calendariodeembarques';


        //------------------ Proceso de subir inventarios  --------------------------------
        $sql = "delete from inventarios";
        if ($db0->query($sql) == TRUE){}
        else{}

            $idlugardealmacenamiento = Inventarios_Data('IdLugarDeAlmacenamiento');
            $lugardealmacenamiento = Inventarios_Data('LugarDeAlmacenamiento');
        $idcertificado = Inventarios_Data('IdCertificado');
        $idtipodeinventario = Inventarios_Data('IdTipoDeInventario');
        $tipodeinventario = Inventarios_Data('TipoDeInventario');
            $estatuslote = Inventarios_Data('EstatusLote');
            $idfruta = Inventarios_Data('IdFruta');
            $producto = Inventarios_Data('Producto');
            $idgrupocitrico = Inventarios_Data('IdGrupoCitrico');
        $fruta = Inventarios_Data('Fruta');
        $fechaproduccion = Inventarios_Data('FechaProduccion');
        $lotenum= Inventarios_Data('LoteNum');
            $descripcion = Inventarios_Data('Descripcion');
            $observaciones = Inventarios_Data('Observaciones');
        $envasado = Inventarios_Data('Envasado');
        $produccion = Inventarios_Data('Produccion');
            $retorno = Inventarios_Data('Retorno');
        $sobrantes = Inventarios_Data('Sobrantes');
        $vendido = Inventarios_Data('Vendido');
        $ofertado = Inventarios_Data('Ofertado');
            $reproceso = Inventarios_Data('Reproceso');
        $disponibilidad = Inventarios_Data('Disponibilidad');
            $bajasalmacen = Inventarios_Data('BajasAlmacen');
        $tiempoalmacen = Inventarios_Data('TiempoAlmacen');
        $kgtambor = Inventarios_Data('KgTambor');
            $totalkgtambor  = Inventarios_Data('TotalKgTambor');
        $unidaddemedida = Inventarios_Data('UnidadDeMedida');
            $expr1 = Inventarios_Data('Expr1');
        $idanden = Inventarios_Data('IdAnden');
        $anden = Inventarios_Data('Anden');
        $idcamara = Inventarios_Data('IdCamara');
        $camara = Inventarios_Data('Camara');
        $idtipocamara = Inventarios_Data('IdTipoCamara');
        $tipocamara = Inventarios_Data('TipoCamara');
        $idalmacen = Inventarios_Data('IdAlmacen');
        $bodega_nomcorto = Inventarios_Data('Bodega_NomCorto');
        $bodega_nomoficial = Inventarios_Data('Bodega_NomOficial');
            $productosobrante = Inventarios_Data('ProductoSobrante');

        $idlugardealmacenamiento_data = substr($idlugardealmacenamiento, 0, -1);
        $lugardealmacenamiento_data = substr($lugardealmacenamiento, 0, -1);
        $idcertificado_data = substr($idcertificado, 0, -1);
        $idtipodeinventario_data = substr($idtipodeinventario, 0, -1);
        $tipodeinventario_data = substr($tipodeinventario, 0, -1);
        $estatuslote_data = substr($estatuslote, 0, -1);
        $idfruta_data = substr($idfruta, 0, -1);
        $producto_data = substr($producto, 0, -1);
        $idgrupocitrico_data = substr($idgrupocitrico, 0, -1);
        $fruta_data = substr($fruta, 0, -1);
        $fechaproduccion_data = substr($fechaproduccion, 0, -1);
        $lotenum_data = substr($lotenum, 0, -1);
        $descripcion_data = substr($descripcion, 0, -1);
        $observaciones_data = substr($observaciones, 0, -1);
        $envasado_data = substr($envasado, 0, -1);
        $produccion_data = substr($produccion, 0, -1);
        $retorno_data = substr($retorno, 0, -1);
        $sobrantes_data = substr($sobrantes, 0, -1);
        $vendido_data = substr($vendido, 0, -1);
        $ofertado_data = substr($ofertado, 0, -1);
        $reproceso_data = substr($reproceso, 0, -1);
        $disponibilidad_data = substr($disponibilidad, 0, -1);
        $bajasalmacen_data = substr($bajasalmacen, 0, -1);
        $tiempoalmacen_data = substr($tiempoalmacen, 0, -1);
        $kgtambor_data = substr($kgtambor, 0, -1);
        $totalkgtambor_data = substr($totalkgtambor, 0, -1);
        $unidaddemedida_data = substr($unidaddemedida, 0, -1);
        $expr1_data = substr($expr1, 0, -1);
        $idanden_data = substr($idanden, 0, -1);
        $anden_data = substr($anden, 0, -1);
        $idcamara_data = substr($idcamara, 0, -1);
        $camara_data = substr($camara, 0, -1);
        $idtipocamara_data = substr($idtipocamara, 0, -1);
        $tipocamara_data = substr($tipocamara, 0, -1);
        $idalmacen_data = substr($idalmacen, 0, -1);
        $bodega_nomcorto_data = substr($bodega_nomcorto, 0, -1);
        $bodega_nomoficial_data = substr($bodega_nomoficial, 0, -1);
        $productosobrante_data = substr($productosobrante, 0, -1);

        $Valor_idlugardealmacenamiento = explode(",", $idlugardealmacenamiento_data);
        $Valor_lugardealmacenamiento = explode(",", $lugardealmacenamiento_data);
        $Valor_idcertificado = explode(",", $idcertificado_data);
        $Valor_idtipodeinventario = explode(",", $idtipodeinventario_data);
        $Valor_tipodeinventario = explode(",", $tipodeinventario_data);
        $Valor_estatuslote = explode(",", $estatuslote_data);
        $Valor_idfruta = explode(",", $idfruta_data);
        $Valor_producto = explode(",", $producto_data);
        $Valor_idgrupocitrico = explode(",", $idgrupocitrico_data);
        $Valor_fruta = explode(",", $fruta_data);
        $Valor_fechaproduccion = explode(",", $fechaproduccion_data);
        $Valor_lotenum = explode(",", $lotenum_data);
        $Valor_descripcion = explode(",", $descripcion_data);
        $Valor_observaciones = explode(",", $observaciones_data);
        $Valor_envasado = explode(",", $envasado_data);
        $Valor_produccion = explode(",", $produccion_data);
        $Valor_retorno = explode(",", $retorno_data);
        $Valor_sobrantes = explode(",", $sobrantes_data);
        $Valor_vendido = explode(",", $vendido_data);
        $Valor_ofertado = explode(",", $ofertado_data);
        $Valor_reproceso = explode(",", $reproceso_data);
        $Valor_disponibilidad = explode(",", $disponibilidad_data);
        $Valor_bajasalmacen = explode(",", $bajasalmacen_data);
        $Valor_tiempoalmacen = explode(",", $tiempoalmacen_data);
        $Valor_kgtambor = explode(",", $kgtambor_data);
        $Valor_totalkgtambor = explode(",", $totalkgtambor_data);
        $Valor_unidaddemedida = explode(",", $unidaddemedida_data);
        $Valor_expr1 = explode(",", $expr1_data);
        $Valor_idanden = explode(",", $idanden_data);
        $Valor_anden = explode(",", $anden_data);
        $Valor_idcamara = explode(",", $idcamara_data);
        $Valor_camara = explode(",", $camara_data);
        $Valor_idtipocamara = explode(",", $idtipocamara_data);
        $Valor_tipocamara = explode(",", $tipocamara_data);
        $Valor_idalmacen = explode(",", $idalmacen_data);
        $Valor_bodega_nomcorto = explode(",", $bodega_nomcorto_data);
        $Valor_bodega_nomoficial = explode(",", $bodega_nomoficial_data);
        $Valor_productosobrante = explode(",", $productosobrante_data);

        for($i=0; $i< sizeof($Valor_idcertificado); $i++)
            {
                $fecha = substr($Valor_fechaproduccion[$i], 6, 4)."-".substr($Valor_fechaproduccion[$i], 3, 2)."-".substr($Valor_fechaproduccion[$i], 0, 2);
                $sql = "Insert into inventarios 
                (
                    idlugardealmacenamiento, lugardealmacenamiento, idcertificado, idtipodeinventario, tipodeinventario, estatuslote, idfruta, producto, 
                    idgrupocitrico, fruta, fechaproduccion, lotenum, descripcion, observaciones, envasado, produccion, retorno, sobrantes, vendido, ofertado, reproceso, disponibilidad,
                    bajasalmacen, tiempoalmacen, kgtambor, totalkgtambor, unidaddemedida, expr1, idanden, anden, idcamara, camara, idtipocamara, tipocamara, idalmacen, bodega_nomcorto, 
                    bodega_nomoficial, productosobrante
                ) 
                values 
                (
                    "
                    .$Valor_idlugardealmacenamiento[$i].",".
                    "'".$Valor_lugardealmacenamiento[$i]."',".
                    $Valor_idcertificado[$i].",".
                    $Valor_idtipodeinventario[$i].",".
                    "'".$Valor_tipodeinventario[$i]."',".
                    "'".$Valor_estatuslote[$i]."',".
                    $Valor_idfruta[$i].",".
                    "'".$Valor_producto[$i]."',".
                    $Valor_idgrupocitrico[$i].",".
                    "'".$Valor_fruta[$i]."',".
                    "'".$fecha."',".
                    "'".$Valor_lotenum[$i]."',".
                    "'".$Valor_descripcion[$i]."',".
                    "'".$Valor_observaciones[$i]."',".
                    "'".$Valor_envasado[$i]."',".
                    $Valor_produccion[$i].",".
                    $Valor_retorno[$i].",".
                    $Valor_sobrantes[$i].",".
                    $Valor_vendido[$i].",".
                    $Valor_ofertado[$i].",".
                    $Valor_reproceso[$i].",".
                    $Valor_disponibilidad[$i].",".
                    $Valor_bajasalmacen[$i].",".
                    $Valor_tiempoalmacen[$i].",".
                    $Valor_kgtambor[$i].",".
                    $Valor_totalkgtambor[$i].",".
                    $Valor_unidaddemedida[$i].",".
                    $Valor_expr1[$i].",".
                    $Valor_idanden[$i].",".
                    "'".$Valor_anden[$i]."',".
                    $Valor_idcamara[$i].",".
                    "'".$Valor_camara[$i]."',".
                    $Valor_idtipocamara[$i].",".
                    "'".$Valor_tipocamara[$i]."',".
                    $Valor_idalmacen[$i].",".
                    "'".$Valor_bodega_nomcorto[$i]."',".
                    "'".$Valor_bodega_nomoficial[$i]."',".
                    $Valor_productosobrante[$i].""."
                )
                ";
                if ($db0->query($sql) == TRUE){}
                else{}
            }
        echo 'Tabla: inventarios';














            //------------------ Proceso de CIERRE del proceso de importacion --------------------------------            
        $sql = "insert into actualizaciones (fecha) values (now())";
        if ($db0->query($sql) == TRUE)
            {          

            }
        else
            {            

            }



            


        Toast("Proceso de importación de información a la nube, terminado satisfactoriamente",4,"");
    echo "</div>";

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
                    //var_dump( $jsonIterator);    
                    $TablaDeta = "";
                    $row = 0;    
                    $DataG ="";
                    $LabelG = "";
                    $FechasG = "";
                    
                    foreach ($jsonIterator as $key => $val) {
                        if (is_numeric($key)){ //rows                        
                            $rowC = 0;
                        } else {
                            switch ($row) 
                                {
                                    case 0:
                                        break;
                                        default:
                                        if ($key == 'silo') {$LabelG.= "'".$val."',";}
                                        if ($key == 'Existencia') {$DataG.= "".intval($val).",";}
                                        if ($key == 'FecUltMovimiento') 
                                            {
                                                $FechasG.= "".($val).",";
                                            }
                                        break;
                                }
                    $row = $row + 1;    
                }
            
            }
        }

    }

    if ($Data == 'Data') {return $DataG;}
    if ($Data == 'Label') {return $LabelG;}
    if ($Data == 'Fecha') {return $FechasG;}
    
}

    function concentradodesilos_data($Data)
    {
        require("rintera-config.php");

        $QueryEncabezado = "select * from InformacionConcentradoDeSILOS_Nivel3 order by idsilo";

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

                    $myObj = new stdClass;
                    $myObj->token = $token;
                    $myObj->sql = $QueryEncabezado;
                    $myJSON = json_encode($myObj,JSON_UNESCAPED_SLASHES);
    
                    $datos_post = http_build_query($myObj);
                    $opciones = array('http' => array('method'  => 'POST', 'header'  => 'Content-type: application/x-www-form-urlencoded', 'content' => $datos_post));

                    ini_set('max_execution_time', 7000);
                    ini_set('max_execution_time', 0);
                    $context = stream_context_create($opciones);            
                    $archivo_web = file_get_contents($url, false, $context);                    
                    $data = json_decode($archivo_web);

                    $jsonIterator = new RecursiveIteratorIterator(new RecursiveArrayIterator(json_decode($archivo_web, TRUE)), RecursiveIteratorIterator::SELF_FIRST);

                    $Der = "";
                    $TablaDeta = "";
                    $row = 0;    

                    $idsiloG ="";
                    $tankG ="";
                    $varietyG ="";
                    $ingallG ="";
                    $brixG ="";
                    $psG ="";
                    $ratioG ="";
                    $acidG ="";
                    $oilG ="";
                    $colorG ="";
                    $nG ="";
                    $defectsG ="";
                    $flavorG ="";
                    $scoreG ="";
                    $porchowG ="";
                    $viscG ="";

                    foreach ($jsonIterator as $key => $val) 
                    {
                        if ($key == 'IDSilo') {$idsiloG.= "".intval($val).",";}
                        if ($key == 'Tank') {$tankG.= "'".$val."',";}
                        if ($key == 'Variety') {$varietyG.= "'".$val."',";}
                        if ($key == 'InGall') {$ingallG.= "".$val.",";}
                        if ($key == 'Brix') {$brixG.= "".$val.",";}
                        if ($key == 'Ps') {$psG.= "".$val.",";}
                        if ($key == 'Ratio') {$ratioG.= "".$val.",";}
                        if ($key == 'Acid') {$acidG.= "".$val.",";}
                        if ($key == 'Oil') {$oilG.= "".$val.",";}
                        if ($key == 'Color') {$colorG.= "".$val.",";}
                        if ($key == 'N') {$nG.= "".$val.",";}
                        if ($key == 'Defects') {$defectsG.= "".$val.",";}
                        if ($key == 'Flavor') {$flavorG.= "".$val.",";}
                        if ($key == 'Score') {$scoreG.= "".$val.",";}
                        if ($key == 'PorcHow') {$porchowG .= "".$val.",";}
                        if ($key == 'Visc') {$viscG.= "".$val.",";}
                    }
                    $row = $row + 1;    
                }
            
            }

            if ($Data == 'idsilo') {return $idsiloG;}
            if ($Data == 'tank') {return $tankG;}
            if ($Data == 'variety') {return $varietyG;}
            if ($Data == 'ingall') {return $ingallG;}
            if ($Data == 'brix') {return $brixG;}
            if ($Data == 'ps') {return $psG;}
            if ($Data == 'ratio') {return $ratioG;}
            if ($Data == 'acid') {return $acidG;}
            if ($Data == 'oil') {return $oilG;}
            if ($Data == 'color') {return $colorG;}
            if ($Data == 'n') {return $nG;}
            if ($Data == 'defects') {return $defectsG;}
            if ($Data == 'flavor') {return $flavorG;}
            if ($Data == 'score') {return $scoreG;}
            if ($Data == 'porchow') {return $porchowG;}
            if ($Data == 'visc') {return $viscG;}

    }


    function UsuarioData($Data)
    {
        require("rintera-config.php");

        $QueryEncabezado = "SELECT     cUsuarios.Usuario, cUsuarios.Contraseña, cEmpleados.NombreCompleto
        FROM         CatalogoDeUsuarios AS cUsuarios LEFT OUTER JOIN
                            CatalogoDeEmpleados AS cEmpleados ON cUsuarios.IdEmpleado = cEmpleados.IdEmpleado
        WHERE     (cUsuarios.IdEmpleado IN
                                (SELECT     IdUsuario
                                    FROM          CatalogoDePermisos
                                    WHERE      (IdAcceso = 89) AND (IdEstatusDelRegistro = 0)))";

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
                    //var_dump( $jsonIterator);    
                    $TablaDeta = "";
                    $row = 0;   

                    $UsuarioData ="";
                    $contraseñaData = "";
                    $NombreData = "";
            
                    foreach ($jsonIterator as $key => $val) 
                        {
                            if (is_numeric($key))
                                {
                                    $rowC = 0;
                                }
                            else 
                                {
                                    if ($key == 'Usuario') {$UsuarioData.= "".$val.",";}
                                    if ($key == 'Contraseña') {$contraseñaData.= "".$val.",";}
                                    if ($key == 'NombreCompleto') {$NombreData.= "".$val.",";}
                                }
                            $row = $row + 1;    
                    }
                }
            }

        if ($Data == 'Usuario') {return $UsuarioData;}
        if ($Data == 'Contraseña') {return $contraseñaData;}
        if ($Data == 'NombreCompleto') {return $NombreData;}
            
    }

    function Inventarios_Data($Data)
    {
        require("rintera-config.php");

        $QueryEncabezado = "select * from InventariosPrincipales(1, '')";

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

                    $myObj = new stdClass;
                    $myObj->token = $token;
                    $myObj->sql = $QueryEncabezado;
                    $myJSON = json_encode($myObj,JSON_UNESCAPED_SLASHES);
                    $datos_post = http_build_query($myObj);

                    $opciones = array('http' => array('method'  => 'POST', 'header'  => 'Content-type: application/x-www-form-urlencoded', 'content' => $datos_post));

                    ini_set('max_execution_time', 7000);
                    ini_set('max_execution_time', 0);
                    $context = stream_context_create($opciones);            
                    $archivo_web = file_get_contents($url, false, $context);                    
                    $data = json_decode($archivo_web);

                    $jsonIterator = new RecursiveIteratorIterator(new RecursiveArrayIterator(json_decode($archivo_web, TRUE)), RecursiveIteratorIterator::SELF_FIRST);

                    $Der = "";
                    $TablaDeta = "";
                    $row = 0;   

                    $idlugardealmacenamientodata = "";
                    $lugardealmacenamientodata = "";
                    $idcertificadodata = "";
                    $idtipodeinventariodata = "";
                    $tipodeinventariodata = "";
                    $estatuslotedata = "";
                    $idfrutadata = "";
                    $productodata = "";
                    $idgrupocitricodata = "";
                    $frutadata = "";
                    $fechaproducciondata = "";
                    $lotenumdata = "";
                    $descripciondata = "";
                    $observacionesdata = "";
                    $envasadodata = "";
                    $producciondata = "";
                    $retornodata = "";
                    $sobrantesdata = "";
                    $vendidodata = "";
                    $ofertadodata = "";
                    $reprocesodata = "";
                    $disponibilidaddata = "";
                    $bajasalmacendata = "";
                    $tiempoalmacendata = "";
                    $kgtambordata = "";
                    $TotalKgTambordata = "";
                    $unidaddemedidadata = "";
                    $expr1data = "";
                    $idandendata = "";
                    $andendata = "";
                    $idcamaradata = "";
                    $camaradata = "";
                    $idtipocamaradata = "";
                    $tipocamaradata = "";
                    $idalmacendata = "";
                    $bodega_nomcortodata = "";
                    $bodega_nomoficialdata = "";
                    $productosobrantedata = "";

                    foreach ($jsonIterator as $key => $val) 
                        {
                            if (is_numeric($key))
                                {$rowC = 0;}
                            else 
                                {
                                    if ($key == 'IdLugarDeAlmacenamiento') {$idlugardealmacenamientodata.= "".$val.",";}
                                    if ($key == 'LugarDeAlmacenamiento') {$lugardealmacenamientodata.= "".$val.",";}
                                    if ($key == 'IdCertificado') {$idcertificadodata.= "".$val.",";}
                                    if ($key == 'IdTipoDeInventario') {$idtipodeinventariodata.= "".$val.",";}
                                    if ($key == 'TipoDeInventario') {$tipodeinventariodata.= "".$val.",";}
                                    if ($key == 'EstatusLote') {$estatuslotedata.= "".$val.",";}
                                    if ($key == 'IdFruta') {$idfrutadata.= "".$val.",";}
                                    if ($key == 'Producto') {$productodata.= "".$val.",";}
                                    if ($key == 'IdGrupoCitrico') {$idgrupocitricodata.= "".$val.",";}
                                    if ($key == 'Fruta') {$frutadata.= "".$val.",";}
                                    if ($key == 'FechaProduccion') {$fechaproducciondata.= "".$val.",";}
                                    if ($key == 'LoteNum') {$lotenumdata.= "".$val.",";}
                                    if ($key == 'Descripcion') {$descripciondata.= "".$val.",";}
                                    if ($key == 'Observaciones') {$observacionesdata.= "".$val.",";}
                                    if ($key == 'Envasado') {$envasadodata.= "".$val.",";}
                                    if ($key == 'Produccion') {$producciondata.= "".$val.",";}
                                    if ($key == 'Retorno') {$retornodata.= "".$val.",";}
                                    if ($key == 'Sobrantes') {$sobrantesdata.= "".$val.",";}
                                    if ($key == 'Vendido') {$vendidodata.= "".$val.",";}
                                    if ($key == 'Ofertado') {$ofertadodata.= "".$val.",";}
                                    if ($key == 'Reproceso') {$reprocesodata.= "".$val.",";}
                                    if ($key == 'Disponibilidad') {$disponibilidaddata.= "".$val.",";}
                                    if ($key == 'BajasAlmacen') {$bajasalmacendata.= "".$val.",";}
                                    if ($key == 'TiempoAlmacen') {$tiempoalmacendata.= "".$val.",";}
                                    if ($key == 'KgTambor') {$kgtambordata.= "".$val.",";}
                                    if ($key == 'TotalKgTambor') {$TotalKgTambordata.= "".$val.",";}
                                    if ($key == 'UnidadDeMedida') {$unidaddemedidadata.= "".$val.",";}
                                    if ($key == 'Expr1') {$expr1data.= "".$val.",";}
                                    if ($key == 'IdAnden') {$idandendata.= "".$val.",";}
                                    if ($key == 'Anden') {$andendata.= "".$val.",";}
                                    if ($key == 'IdCamara') {$idcamaradata.= "".$val.",";}
                                    if ($key == 'Camara') {$camaradata.= "".$val.",";}
                                    if ($key == 'IdTipoCamara') {$idtipocamaradata.= "".$val.",";}
                                    if ($key == 'TipoCamara') {$tipocamaradata.= "".$val.",";}
                                    if ($key == 'IdAlmacen') {$idalmacendata.= "".$val.",";}
                                    if ($key == 'Bodega_NomCorto') {$bodega_nomcortodata.= "".$val.",";}
                                    if ($key == 'Bodega_NomOficial') {$bodega_nomoficialdata.= "".$val.",";}
                                    if ($key == 'ProductoSobrante') {$productosobrantedata.= "".$val.",";}
                                }
                            $row = $row + 1;    
                    }
                }
            }

        if ($Data == 'IdLugarDeAlmacenamiento') {return $idlugardealmacenamientodata;}
        if ($Data == 'LugarDeAlmacenamiento') {return $lugardealmacenamientodata;}
        if ($Data == 'IdCertificado') {return $idcertificadodata;}
        if ($Data == 'IdTipoDeInventario') {return $idtipodeinventariodata;}
        if ($Data == 'TipoDeInventario') {return $tipodeinventariodata;}
        if ($Data == 'EstatusLote') {return $estatuslotedata;}
        if ($Data == 'IdFruta') {return $idfrutadata;}
        if ($Data == 'Producto') {return $productodata;}
        if ($Data == 'IdGrupoCitrico') {return $idgrupocitricodata;}
        if ($Data == 'Fruta') {return $frutadata;}
        if ($Data == 'FechaProduccion') {return $fechaproducciondata;}
        if ($Data == 'LoteNum') {return $lotenumdata;}
        if ($Data == 'Descripcion') {return $descripciondata;}
        if ($Data == 'Observaciones') {return $observacionesdata;}
        if ($Data == 'Envasado') {return $envasadodata;}
        if ($Data == 'Produccion') {return $producciondata;}
        if ($Data == 'Retorno') {return $retornodata;}
        if ($Data == 'Sobrantes') {return $sobrantesdata;}
        if ($Data == 'Vendido') {return $vendidodata;}
        if ($Data == 'Ofertado') {return $ofertadodata;}
        if ($Data == 'Reproceso') {return $reprocesodata;}
        if ($Data == 'Disponibilidad') {return $disponibilidaddata;}
        if ($Data == 'BajasAlmacen') {return $bajasalmacendata;}
        if ($Data == 'TiempoAlmacen') {return $tiempoalmacendata;}
        if ($Data == 'KgTambor') {return $kgtambordata;}
        if ($Data == 'TotalKgTambor') {return $TotalKgTambordata;}
        if ($Data == 'UnidadDeMedida') {return $unidaddemedidadata;}
        if ($Data == 'Expr1') {return $expr1data;}
        if ($Data == 'IdAnden') {return $idandendata;}
        if ($Data == 'Anden') {return $andendata;}
        if ($Data == 'IdCamara') {return $idcamaradata;}
        if ($Data == 'Camara') {return $camaradata;}
        if ($Data == 'IdTipoCamara') {return $idtipocamaradata;}
        if ($Data == 'TipoCamara') {return $tipocamaradata;}
        if ($Data == 'IdAlmacen') {return $idalmacendata;}
        if ($Data == 'Bodega_NomCorto') {return $bodega_nomcortodata;}
        if ($Data == 'Bodega_NomOficial') {return $bodega_nomoficialdata;}
        if ($Data == 'ProductoSobrante') {return $productosobrantedata;}

    }

    function LugarDealmacenamientos_Data($Data)
    {
        require("rintera-config.php");

        $QueryEncabezado = "select * from CatalogoLugarDeAlmacenamientos";

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

                    $myObj = new stdClass;
                    $myObj->token = $token;
                    $myObj->sql = $QueryEncabezado;
                    $myJSON = json_encode($myObj,JSON_UNESCAPED_SLASHES);
                    $datos_post = http_build_query($myObj);

                    $opciones = array('http' => array('method'  => 'POST', 'header'  => 'Content-type: application/x-www-form-urlencoded', 'content' => $datos_post));

                    ini_set('max_execution_time', 7000);
                    ini_set('max_execution_time', 0);
                    $context = stream_context_create($opciones);            
                    $archivo_web = file_get_contents($url, false, $context);                    
                    $data = json_decode($archivo_web);

                    $jsonIterator = new RecursiveIteratorIterator(new RecursiveArrayIterator(json_decode($archivo_web, TRUE)), RecursiveIteratorIterator::SELF_FIRST);

                    $Der = "";
                    $TablaDeta = "";
                    $row = 0;   

                    $IdLugarDeAlmacenamientoData = "";
                    $lugardealmacenamientoData = "";
                    $ordenvisualData = "";

                    foreach ($jsonIterator as $key => $val) 
                        {
                            if (is_numeric($key))
                                {$rowC = 0;}
                            else 
                                {
                                    if ($key == 'IdLugarDeAlmacenamiento') {$IdLugarDeAlmacenamientoData.= "".$val.",";}
                                    if ($key == 'LugarDeAlmacenamiento') {$lugardealmacenamientoData.= "".$val.",";}
                                    if ($key == 'OrdenVisual') {$ordenvisualData.= "".$val.",";}
                                }
                            $row = $row + 1;    
                    }
                }
            }

        if ($Data == 'IdLugarDeAlmacenamiento') {return $IdLugarDeAlmacenamientoData;}
        if ($Data == 'LugarDeAlmacenamiento') {return $lugardealmacenamientoData;}
        if ($Data == 'OrdenVisual') {return $ordenvisualData;}


    }


    function GrupoDeCitricos_Data($Data)
    {
        require("rintera-config.php");

        $QueryEncabezado = "select * from CatalogoGruposDeCitrico";

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

                    $myObj = new stdClass;
                    $myObj->token = $token;
                    $myObj->sql = $QueryEncabezado;
                    $myJSON = json_encode($myObj,JSON_UNESCAPED_SLASHES);
                    $datos_post = http_build_query($myObj);

                    $opciones = array('http' => array('method'  => 'POST', 'header'  => 'Content-type: application/x-www-form-urlencoded', 'content' => $datos_post));

                    ini_set('max_execution_time', 7000);
                    ini_set('max_execution_time', 0);
                    $context = stream_context_create($opciones);            
                    $archivo_web = file_get_contents($url, false, $context);                    
                    $data = json_decode($archivo_web);

                    $jsonIterator = new RecursiveIteratorIterator(new RecursiveArrayIterator(json_decode($archivo_web, TRUE)), RecursiveIteratorIterator::SELF_FIRST);

                    $Der = "";
                    $TablaDeta = "";
                    $row = 0;   

                    $idgrupocitricoData = "";
                    $descripcionData = "";
                    $ordenvisualData = "";
                    $idestatusdelregistroData = "";

                    foreach ($jsonIterator as $key => $val) 
                        {
                            if (is_numeric($key))
                                {$rowC = 0;}
                            else 
                                {
                                    if ($key == 'IdGrupoCitrico') {$idgrupocitricoData.= "".$val.",";}
                                    if ($key == 'Descripcion') {$descripcionData.= "".$val.",";}
                                    if ($key == 'OrdenVisual') {$ordenvisualData.= "".$val.",";}
                                    if ($key == 'IdEstatusDelRegistro') {$idestatusdelregistroData.= "".$val.",";}
                                }
                            $row = $row + 1;    
                    }
                }
            }

        if ($Data == 'IdGrupoCitrico') {return $idgrupocitricoData;}
        if ($Data == 'Descripcion') {return $descripcionData;}
        if ($Data == 'OrdenVisual') {return $ordenvisualData;}
        if ($Data == 'IdEstatusDelRegistro') {return $idestatusdelregistroData;}


    }

    function catalogodefrutas_Data($Data)
    {
        require("rintera-config.php");

        $QueryEncabezado = "select * from CatalogoDeFrutas";

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

                    $myObj = new stdClass;
                    $myObj->token = $token;
                    $myObj->sql = $QueryEncabezado;
                    $myJSON = json_encode($myObj,JSON_UNESCAPED_SLASHES);
                    $datos_post = http_build_query($myObj);

                    $opciones = array('http' => array('method'  => 'POST', 'header'  => 'Content-type: application/x-www-form-urlencoded', 'content' => $datos_post));

                    ini_set('max_execution_time', 7000);
                    ini_set('max_execution_time', 0);
                    $context = stream_context_create($opciones);            
                    $archivo_web = file_get_contents($url, false, $context);                    
                    $data = json_decode($archivo_web);

                    $jsonIterator = new RecursiveIteratorIterator(new RecursiveArrayIterator(json_decode($archivo_web, TRUE)), RecursiveIteratorIterator::SELF_FIRST);

                    $Der = "";
                    $TablaDeta = "";
                    $row = 0;   

                    $idfrutaData = "";
                    $descripcionData = "";
                    $ordenvisualData = "";
                    $idestatusdelregistroData = "";

                    foreach ($jsonIterator as $key => $val) 
                        {
                            if (is_numeric($key))
                                {$rowC = 0;}
                            else 
                                {
                                    if ($key == 'IdFruta') {$idfrutaData.= "".$val.",";}
                                    if ($key == 'Descripcion') {$descripcionData.= "".$val.",";}
                                    if ($key == 'OrdenVisual') {$ordenvisualData.= "".$val.",";}
                                    if ($key == 'IdEstatusDelRegistro') {$idestatusdelregistroData.= "".$val.",";}
                                }
                            $row = $row + 1;    
                    }
                }
            }

        if ($Data == 'IdFruta') {return $idfrutaData;}
        if ($Data == 'Descripcion') {return $descripcionData;}
        if ($Data == 'OrdenVisual') {return $ordenvisualData;}
        if ($Data == 'IdEstatusDelRegistro') {return $idestatusdelregistroData;}


    }
        
    function catalogotipodeinventarios_Data($Data)
    {
        require("rintera-config.php");

        $QueryEncabezado = "select * from Catalogo_TipoDeInventario";

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

                    $myObj = new stdClass;
                    $myObj->token = $token;
                    $myObj->sql = $QueryEncabezado;
                    $myJSON = json_encode($myObj,JSON_UNESCAPED_SLASHES);
                    $datos_post = http_build_query($myObj);

                    $opciones = array('http' => array('method'  => 'POST', 'header'  => 'Content-type: application/x-www-form-urlencoded', 'content' => $datos_post));

                    ini_set('max_execution_time', 7000);
                    ini_set('max_execution_time', 0);
                    $context = stream_context_create($opciones);            
                    $archivo_web = file_get_contents($url, false, $context);                    
                    $data = json_decode($archivo_web);

                    $jsonIterator = new RecursiveIteratorIterator(new RecursiveArrayIterator(json_decode($archivo_web, TRUE)), RecursiveIteratorIterator::SELF_FIRST);

                    $Der = "";
                    $TablaDeta = "";
                    $row = 0;   

                    $idtipodeinventarioData = "";
                    $tipodeinventarioData = "";
                    $ordenvisualData = "";
                    $idestatusdelregistroData = "";

                    foreach ($jsonIterator as $key => $val) 
                        {
                            if (is_numeric($key))
                                {$rowC = 0;}
                            else 
                                {
                                    if ($key == 'IdTipoDeInventario') {$idtipodeinventarioData.= "".$val.",";}
                                    if ($key == 'TipoDeInventario') {$tipodeinventarioData.= "".$val.",";}
                                    if ($key == 'OrdenVisual') {$ordenvisualData.= "".$val.",";}
                                    if ($key == 'IdEstatusDelRegistro') {$idestatusdelregistroData.= "".$val.",";}
                                }
                            $row = $row + 1;    
                    }
                }
            }

        if ($Data == 'IdTipoDeInventario') {return $idtipodeinventarioData;}
        if ($Data == 'TipoDeInventario') {return $tipodeinventarioData;}
        if ($Data == 'OrdenVisual') {return $ordenvisualData;}
        if ($Data == 'IdEstatusDelRegistro') {return $idestatusdelregistroData;}


    }
        
    function catalogodealmacenes_Data($Data)
    {
        require("rintera-config.php");

        $QueryEncabezado = "select * from CatalogoDeAlmacenes";

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

                    $myObj = new stdClass;
                    $myObj->token = $token;
                    $myObj->sql = $QueryEncabezado;
                    $myJSON = json_encode($myObj,JSON_UNESCAPED_SLASHES);
                    $datos_post = http_build_query($myObj);

                    $opciones = array('http' => array('method'  => 'POST', 'header'  => 'Content-type: application/x-www-form-urlencoded', 'content' => $datos_post));

                    ini_set('max_execution_time', 7000);
                    ini_set('max_execution_time', 0);
                    $context = stream_context_create($opciones);            
                    $archivo_web = file_get_contents($url, false, $context);                    
                    $data = json_decode($archivo_web);

                    $jsonIterator = new RecursiveIteratorIterator(new RecursiveArrayIterator(json_decode($archivo_web, TRUE)), RecursiveIteratorIterator::SELF_FIRST);

                    $Der = "";
                    $TablaDeta = "";
                    $row = 0;   

                    $idalmacenData = "";
                    $nombrecortoData = "";
                    $ordenvisualData = "";
                    $idestatusdelregistroData = "";

                    foreach ($jsonIterator as $key => $val) 
                        {
                            if (is_numeric($key))
                                {$rowC = 0;}
                            else 
                                {
                                    if ($key == 'IdAlmacen') {$idalmacenData.= "".$val.",";}
                                    if ($key == 'NombreCorto') {$nombrecortoData.= "".$val.",";}
                                    if ($key == 'OrdenVisual') {$ordenvisualData.= "".$val.",";}
                                    if ($key == 'IdEstatusDelRegistro') {$idestatusdelregistroData.= "".$val.",";}
                                }
                            $row = $row + 1;    
                    }
                }
            }

        if ($Data == 'IdAlmacen') {return $idalmacenData;}
        if ($Data == 'NombreCorto') {return $nombrecortoData;}
        if ($Data == 'OrdenVisual') {return $ordenvisualData;}
        if ($Data == 'IdEstatusDelRegistro') {return $idestatusdelregistroData;}


    }

    function calendariodeembarques_Data($Data)
    {
        require("rintera-config.php");

        $QueryEncabezado = "select idembarque as codigo, referencia as titulo, 'descripcion' As descripcion, fecha as inicio, fecha as fin from OrdenDeEmbarque where IdEstatusDelRegistro = 0";

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

                    $myObj = new stdClass;
                    $myObj->token = $token;
                    $myObj->sql = $QueryEncabezado;
                    $myJSON = json_encode($myObj,JSON_UNESCAPED_SLASHES);
                    $datos_post = http_build_query($myObj);

                    $opciones = array('http' => array('method'  => 'POST', 'header'  => 'Content-type: application/x-www-form-urlencoded', 'content' => $datos_post));

                    ini_set('max_execution_time', 7000);
                    ini_set('max_execution_time', 0);
                    $context = stream_context_create($opciones);            
                    $archivo_web = file_get_contents($url, false, $context);                    
                    $data = json_decode($archivo_web);

                    $jsonIterator = new RecursiveIteratorIterator(new RecursiveArrayIterator(json_decode($archivo_web, TRUE)), RecursiveIteratorIterator::SELF_FIRST);

                    $Der = "";
                    $TablaDeta = "";
                    $row = 0;   

                    $codigodata = "";
                    $titulodata = "";
                    $descripciondata = "";
                    $inciodata = "";
                    $findata = "";

                    foreach ($jsonIterator as $key => $val) 
                        {
                            if (is_numeric($key))
                                {$rowC = 0;}
                            else 
                                {
                                    if ($key == 'codigo') {$codigodata.= "".$val.",";}
                                    if ($key == 'titulo') {$titulodata.= "".$val.",";}
                                    if ($key == 'descripcion') {$descripciondata.= "".$val.",";}
                                    if ($key == 'inicio') {$inciodata.= "".$val.",";}
                                    if ($key == 'fin') {$findata.= "".$val.",";}
                                }
                            $row = $row + 1;    
                    }
                }
            }

        if ($Data == 'codigo') {return $codigodata;}
        if ($Data == 'titulo') {return $titulodata;}
        if ($Data == 'descripcion') {return $descripciondata;}
        if ($Data == 'inicio') {return $inciodata;}
        if ($Data == 'fin') {return $findata;}


    }


    function Extrae_SilosDetalle($Data)
    {
        require("rintera-config.php");

        $QueryEncabezado = "
            SELECT IdSilo, Formato As Tipo, isnull(IdCertificado, '') IdCertificado, isnull(LoteNum, '') As LoteNum, isnull(Fecha, '') As Fecha, isnull(InGall, '') As InGall, isnull(Brix, '') as Brix, 
            isnull(BrixRed, '') As BrixRed, isnull(Factor, '') As Factor, isnull(Ps, '') As Ps, isnull(Ratio, '') As Ratio, isnull(Acid, '') As Acid, isnull(Oil, '') As Oil, 
            isnull(Color, '') As Color, isnull(N, '') As N, isnull(Defects, '') As Defects, isnull(Flavor, '') As Flavor, isnull(Score, '') As Score, isnull(PorcPulpa, '') As PorcPulpa, 
            isnull(Ph, '') As Ph, isnull(Porcpww, '') As Porcpww, isnull(PorcAire, '') As PorcAire, isnull(VitaminaC, '') As VitaminaC, isnull(PorcHow, '') As PorcHow, isnull(Visc, '') As Visc
            FROM dbo.f_DetalleDeUnSilo(1) where Formato = 1
            union
            SELECT  IdSilo, Formato As Tipo, isnull(IdCertificado, '') IdCertificado, isnull(LoteNum, '') As LoteNum, isnull(Fecha, '') As Fecha, isnull(InGall, '') As InGall, isnull(Brix, '') as Brix, 
            isnull(BrixRed, '') As BrixRed, isnull(Factor, '') As Factor, isnull(Ps, '') As Ps, isnull(Ratio, '') As Ratio, isnull(Acid, '') As Acid, isnull(Oil, '') As Oil, 
            isnull(Color, '') As Color, isnull(N, '') As N, isnull(Defects, '') As Defects, isnull(Flavor, '') As Flavor, isnull(Score, '') As Score, isnull(PorcPulpa, '') As PorcPulpa, 
            isnull(Ph, '') As Ph, isnull(Porcpww, '') As Porcpww, isnull(PorcAire, '') As PorcAire, isnull(VitaminaC, '') As VitaminaC, isnull(PorcHow, '') As PorcHow, isnull(Visc, '') As Visc
            FROM dbo.f_DetalleDeUnSilo(2) where Formato = 1
            union
            SELECT  IdSilo, Formato As Tipo, isnull(IdCertificado, '') IdCertificado, isnull(LoteNum, '') As LoteNum, isnull(Fecha, '') As Fecha, isnull(InGall, '') As InGall, isnull(Brix, '') as Brix, 
            isnull(BrixRed, '') As BrixRed, isnull(Factor, '') As Factor, isnull(Ps, '') As Ps, isnull(Ratio, '') As Ratio, isnull(Acid, '') As Acid, isnull(Oil, '') As Oil, 
            isnull(Color, '') As Color, isnull(N, '') As N, isnull(Defects, '') As Defects, isnull(Flavor, '') As Flavor, isnull(Score, '') As Score, isnull(PorcPulpa, '') As PorcPulpa, 
            isnull(Ph, '') As Ph, isnull(Porcpww, '') As Porcpww, isnull(PorcAire, '') As PorcAire, isnull(VitaminaC, '') As VitaminaC, isnull(PorcHow, '') As PorcHow, isnull(Visc, '') As Visc
            FROM dbo.f_DetalleDeUnSilo(3) where Formato = 1
            union
            SELECT  IdSilo, Formato As Tipo, isnull(IdCertificado, '') IdCertificado, isnull(LoteNum, '') As LoteNum, isnull(Fecha, '') As Fecha, isnull(InGall, '') As InGall, isnull(Brix, '') as Brix, 
            isnull(BrixRed, '') As BrixRed, isnull(Factor, '') As Factor, isnull(Ps, '') As Ps, isnull(Ratio, '') As Ratio, isnull(Acid, '') As Acid, isnull(Oil, '') As Oil, 
            isnull(Color, '') As Color, isnull(N, '') As N, isnull(Defects, '') As Defects, isnull(Flavor, '') As Flavor, isnull(Score, '') As Score, isnull(PorcPulpa, '') As PorcPulpa, 
            isnull(Ph, '') As Ph, isnull(Porcpww, '') As Porcpww, isnull(PorcAire, '') As PorcAire, isnull(VitaminaC, '') As VitaminaC, isnull(PorcHow, '') As PorcHow, isnull(Visc, '') As Visc
            FROM dbo.f_DetalleDeUnSilo(4) where Formato = 1
            union
            SELECT  IdSilo, Formato As Tipo, isnull(IdCertificado, '') IdCertificado, isnull(LoteNum, '') As LoteNum, isnull(Fecha, '') As Fecha, isnull(InGall, '') As InGall, isnull(Brix, '') as Brix, 
            isnull(BrixRed, '') As BrixRed, isnull(Factor, '') As Factor, isnull(Ps, '') As Ps, isnull(Ratio, '') As Ratio, isnull(Acid, '') As Acid, isnull(Oil, '') As Oil, 
            isnull(Color, '') As Color, isnull(N, '') As N, isnull(Defects, '') As Defects, isnull(Flavor, '') As Flavor, isnull(Score, '') As Score, isnull(PorcPulpa, '') As PorcPulpa, 
            isnull(Ph, '') As Ph, isnull(Porcpww, '') As Porcpww, isnull(PorcAire, '') As PorcAire, isnull(VitaminaC, '') As VitaminaC, isnull(PorcHow, '') As PorcHow, isnull(Visc, '') As Visc
            FROM dbo.f_DetalleDeUnSilo(5) where Formato = 1
            union
            SELECT  IdSilo, Formato As Tipo, isnull(IdCertificado, '') IdCertificado, isnull(LoteNum, '') As LoteNum, isnull(Fecha, '') As Fecha, isnull(InGall, '') As InGall, isnull(Brix, '') as Brix, 
            isnull(BrixRed, '') As BrixRed, isnull(Factor, '') As Factor, isnull(Ps, '') As Ps, isnull(Ratio, '') As Ratio, isnull(Acid, '') As Acid, isnull(Oil, '') As Oil, 
            isnull(Color, '') As Color, isnull(N, '') As N, isnull(Defects, '') As Defects, isnull(Flavor, '') As Flavor, isnull(Score, '') As Score, isnull(PorcPulpa, '') As PorcPulpa, 
            isnull(Ph, '') As Ph, isnull(Porcpww, '') As Porcpww, isnull(PorcAire, '') As PorcAire, isnull(VitaminaC, '') As VitaminaC, isnull(PorcHow, '') As PorcHow, isnull(Visc, '') As Visc
            FROM dbo.f_DetalleDeUnSilo(6) where Formato = 1
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

                    $myObj = new stdClass;
                    $myObj->token = $token;
                    $myObj->sql = $QueryEncabezado;
                    $myJSON = json_encode($myObj,JSON_UNESCAPED_SLASHES);
                    $datos_post = http_build_query($myObj);

                    $opciones = array('http' => array('method'  => 'POST', 'header'  => 'Content-type: application/x-www-form-urlencoded', 'content' => $datos_post));

                    ini_set('max_execution_time', 7000);
                    ini_set('max_execution_time', 0);
                    $context = stream_context_create($opciones);            
                    $archivo_web = file_get_contents($url, false, $context);                    
                    $data = json_decode($archivo_web);

                    $jsonIterator = new RecursiveIteratorIterator(new RecursiveArrayIterator(json_decode($archivo_web, TRUE)), RecursiveIteratorIterator::SELF_FIRST);

                    $Der = "";
                    $TablaDeta = "";
                    $row = 0;   

                    $idsilodata = "";
                    $idcertificadodata = "";
                    $idtipodeenvasadodata="";
                    $secuenciadata = "";
                    $lotenumdata = "";
                    $fechadata = "";
                    $ingalldata = "";
                    $brixdata = "";
                    $brixreddata = "";
                    $factordata = "";
                    $psdata = "";
                    $ratiodata = "";
                    $aciddata = "";
                    $oildata = "";
                    $colordata = "";
                    $ndata = "";
                    $defectsdata = "";
                    $flavordata = "";
                    $scoredata = "";
                    $porpulpadata = "";
                    $phdata = "";
                    $porcpwwdata = "";
                    $porcairedata="";
                    $vitaminacdata = "";
                    $porchowdata="";
                    $viscdata = "";


                    foreach ($jsonIterator as $key => $val) 
                        {
                            if (is_numeric($key))
                                {$rowC = 0;}
                            else 
                                {
                                    if ($key == 'IdSilo') {$idsilodata.= "".$val.",";}
                                    if ($key == 'IdCertificado') {$idcertificadodata.= "".$val.",";}
                                    if ($key == 'IdTipoDeEnvasado') {$idtipodeenvasadodata.= "".$val.",";}
                                    if ($key == 'Secuencia') {$secuenciadata.= "".$val.",";}
                                    if ($key == 'LoteNum') {$lotenumdata.= "".$val.",";}
                                    if ($key == 'Fecha') {$fechadata.= "".$val.",";}
                                    if ($key == 'InGall') {$ingalldata.= "".$val.",";}
                                    if ($key == 'Brix') {$brixdata.= "".$val.",";}
                                    if ($key == 'BrixRed') {$brixreddata.= "".$val.",";}
                                    if ($key == 'Factor') {$factordata.= "".$val.",";}
                                    if ($key == 'Ps') {$psdata.= "".$val.",";}
                                    if ($key == 'Ratio') {$ratiodata.= "".$val.",";}
                                    if ($key == 'Acid') {$aciddata.= "".$val.",";}
                                    if ($key == 'Oil') {$oildata.= "".$val.",";}
                                    if ($key == 'Color') {$colordata.= "".$val.",";}
                                    if ($key == 'N') {$ndata.= "".$val.",";}
                                    if ($key == 'Defects') {$defectsdata.= "".$val.",";}
                                    if ($key == 'Flavor') {$flavordata.= "".$val.",";}
                                    if ($key == 'Score') {$scoredata.= "".$val.",";}
                                    if ($key == 'PorcPulpa') {$porpulpadata.= "".$val.",";}
                                    if ($key == 'Ph') {$phdata.= "".$val.",";}
                                    if ($key == 'Porcpww') {$porcpwwdata.= "".$val.",";}
                                    if ($key == 'PorcAire') {$porcairedata.= "".$val.",";}
                                    if ($key == 'VitaminaC') {$vitaminacdata.= "".$val.",";}
                                    if ($key == 'PorcHow') {$porchowdata.= "".$val.",";}
                                    if ($key == 'Visc') {$viscdata.= "".$val.",";}
                                }
                            $row = $row + 1;    
                    }
                }
            }

        if ($Data == 'IdSilo') {return $idsilodata;}
        if ($Data == 'IdCertificado') {return $idcertificadodata;}
        if ($Data == 'IdTipoDeEnvasado') {return $idtipodeenvasadodata;}
        if ($Data == 'Secuencia') {return $secuenciadata;}
        if ($Data == 'LoteNum') {return $lotenumdata;}
        if ($Data == 'Fecha') {return $fechadata;}
        if ($Data == 'InGall') {return $ingalldata;}
        if ($Data == 'Brix') {return $brixdata;}
        if ($Data == 'BrixRed') {return $brixreddata;}
        if ($Data == 'Factor') {return $factordata;}
        if ($Data == 'Ps') {return $psdata;}
        if ($Data == 'Ratio') {return $ratiodata;}
        if ($Data == 'Acid') {return $aciddata;}
        if ($Data == 'Oil') {return $oildata;}
        if ($Data == 'Color') {return $colordata;}
        if ($Data == 'N') {return $ndata;}
        if ($Data == 'Defects') {return $defectsdata;}
        if ($Data == 'Flavor') {return $flavordata;}
        if ($Data == 'Score') {return $scoredata;}
        if ($Data == 'PorcPulpa') {return $porpulpadata;}
        if ($Data == 'Ph') {return $phdata;}
        if ($Data == 'Porcpww') {return $porcpwwdata;}
        if ($Data == 'PorcAire') {return $porcairedata;}
        if ($Data == 'VitaminaC') {return $porcairedata;}
        if ($Data == 'PorcHow') {return $porchowdata;}
        if ($Data == 'Visc') {return $viscdata;}


    }

    














?>        

<?php
    include ("footer.php");
?>