<?php
    include("head.php");
    include("header.php");
    require("app_funciones.php");
?>

<!DOCTYPE html>
<html lang="es">

<head>
<meta charset=utf-8>
  <meta http-equiv=x-ua-compatible content="ie=edge">
  <meta name=viewport content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name=apple-mobile-web-app-capable content=yes />
  <meta name=apple-mobile-web-app-status-bar-style content=black />
  <meta name=format-detection content="telephone=no" />
  <title>Procimart</title>
  <meta name=author content="Procimart">
  <link rel="shortcut icon" href="img/logo.ico" type="image/x-icon" />

  <link href="lib/calendario/bootstrap-4.3.1/css/bootstrap.min.css" rel="stylesheet">
  <link href="lib/calendario/datatables/datatables.min.css" rel="stylesheet">
  <link href="lib/calendario/clockpicker/bootstrap-clockpicker.css" rel="stylesheet">
  <link href="lib/calendario/fullcalendar-4.3.1/packages/core/main.css" rel="stylesheet">
  <link href="lib/calendario/fullcalendar-4.3.1/packages/daygrid/main.css" rel="stylesheet">
  <link href="lib/calendario/fullcalendar-4.3.1/packages/timegrid/main.css" rel="stylesheet">
  <link href="lib/calendario/fullcalendar-4.3.1/packages/list/main.css" rel="stylesheet">
  <link href="lib/calendario/fullcalendar-4.3.1/packages/bootstrap/main.css" rel="stylesheet">

  <script src="lib/calendario/js/jquery-3.4.1.js"></script>
  <script src="lib/calendario/js/popper.min.js"></script>
  <script src="lib/calendario/bootstrap-4.3.1/js/bootstrap.min.js"></script>
  <script src="lib/calendario/datatables/datatables.min.js"></script>
  <script src="lib/calendario/clockpicker/bootstrap-clockpicker.js"></script>
  <script src='lib/calendario/js/moment-with-locales.js'></script>
  <script src='lib/calendario/fullcalendar-4.3.1/packages/core/main.js'></script>
  <script src='lib/calendario/fullcalendar-4.3.1/packages/daygrid/main.js'></script>
  <script src='lib/calendario/fullcalendar-4.3.1/packages/timegrid/main.js'></script>
  <script src='lib/calendario/fullcalendar-4.3.1/packages/interaction/main.js'></script>
  <script src='lib/calendario/fullcalendar-4.3.1/packages/list/main.js'></script>
  <script src='lib/calendario/fullcalendar-4.3.1/packages/core/locales/es.js'></script>
  <script src='lib/calendario/fullcalendar-4.3.1/packages/bootstrap/main.js'></script>
</head>

<body>
  <div class="container-fluid">
    <section class="content-header">
      <h1></h1>
    </section>

    <div class="row">

      <div class="col-10">
        <div id="Calendario1" style="background-color: white; border: 1px solid #a69a8d;padding:2px"></div>
      </div>

      <div class="col-2">
        <div id='external-events' style="background-color: white; margin-bottom:1em; height: 350px; border: 1px solid #a69a8d; overflow: auto;padding:1em">
          <h5 class="text-center">Resumen de envios</h5>
          <!-- <h6 class="text-center">Linea2</h6> -->
          <div id='listaeventospredefinidos'>

            <?php
              require("rintera-config.php");

              $TipoReporte = 6; $ClaseTabla =""; $ClaseDiv="";        
              $ResumenDeEnvios  =  DataFromSQLSERVERTOJSON(29, $TipoReporte, $ClaseTabla, $ClaseDiv, $RinteraUser)."";
              echo $ResumenDeEnvios;

              $datos = mysqli_query($db0, "SELECT codigo,titulo,inicio,fin,colortexto,colorfondo FROM calendariodeembarques");
              
              // select IdEmbarque, Referencia, Fecha as Inicio, Fecha As fin,'#000000' as ColorTexto, '#3788d8' As ColorFondo from OrdenDeEmbarque

              $ep = mysqli_fetch_all($datos, MYSQLI_ASSOC);
              foreach ($ep as $fila)
                echo "<div class='fc-event' data-titulo='$fila[titulo]' data-horafin='$fila[fin]' data-horainicio='$fila[inicio]' 
                        data-colorfondo='$fila[colorfondo]' data-colortexto='$fila[colortexto]' data-codigo='$fila[codigo]'
                        style='border-color:#cac9c8;color:$fila[colortexto];background-color:#cac9c8;margin:10px'>
                        $fila[titulo]  
                      </div>";
            ?>
          </div>
        </div>
        <hr>
        <!-- <div style="text-align:center"><button type="button" id="BotonExtraerMasInfo" class="btn btn-success">Extraer +información de AdminPaq</button> -->
      </div>
    </div>
  </div>


  <!-- FormularioEventos -->
  <div class="modal fade" id="FormularioEventos" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <div class="modal-body">
          <input type="hidden" id="Codigo">
          <div class="form-row">
            <div class="form-group col-md-12">
              <label>Referencia del embarque</label>
              <input type="text" id="Titulo" class="form-control" placeholder="">
            </div>
          </div>

          <div class="form-row">
            <div class="form-group col-md-6">
              <label>Fecha de embarque:</label>
              <div class="input-group" data-autoclose="true">
                <input type="date" id="FechaInicio" value="" class="form-control" />
              </div>
            </div>

            <div class="form-group col-md-6" id="TituloHoraInicio">
              <label>Hora de inicio:</label>
              <div class="input-group clockpicker" data-autoclose="true">
                <input type="text" id="HoraInicio" value="" class="form-control" autocomplete="off" />
              </div>
            </div>
          </div>

          <!-- <div class="form-row">
            <div class="form-group col-md-6">
              <label>Fecha de fin:</label>

              <div class="input-group" data-autoclose="true">
                <input type="date" id="FechaFin" value="" class="form-control" />
              </div>
            </div>
            <div class="form-group col-md-6" id="TituloHoraFin">
              <label>Hora de fin:</label>

              <div class="input-group clockpicker" data-autoclose="true">
                <input type="text" id="HoraFin" value="" class="form-control" autocomplete="off" />
              </div>
            </div>
          </div> -->

          <!-- <div class="form-group">
            <label>Descripción:</label>
            <textarea id="Descripcion" rows="3" class="form-control"></textarea>
          </div>
          <div class="form-group">
            <label>Color de fondo:</label>
            <input type="color" value="#3788D8" id="ColorFondo" class="form-control" style="height:36px;">
          </div>
          <div class="form-group">
            <label>Color de texto:</label>
            <input type="color" value="#ffffff" id="ColorTexto" class="form-control" style="height:36px;">
          </div> -->

        </div>
        <div class="modal-footer">
          <!-- <button type="button" id="BotonAgregar" class="btn btn-success">Agregar</button>
          <button type="button" id="BotonModificar" class="btn btn-success">Modificar</button>
          <button type="button" id="BotonBorrar" class="btn btn-success">Borrar</button> -->
          <button type="button" class="btn btn-success" data-dismiss="modal">Aceptar</button>

        </div>
      </div>
    </div>
  </div>


  <script>
    document.addEventListener("DOMContentLoaded", function() {

      $('.clockpicker').clockpicker();

      let calendario1 = new FullCalendar.Calendar(document.getElementById('Calendario1'), {
        plugins: ['dayGrid', 'timeGrid', 'interaction'],
        height: 680,
        droppable: true,
        locale: 'es',
        showNonCurrentDates: false,
        header: {
          left: 'today,prev,next',
          center: 'title',
          right: 'dayGridMonth,timeGridWeek,timeGridDay'
        },
        editable: true,
        events: 'calendario_cargaembarques.php?accion=listar',
        dateClick: function(info) {
          limpiarFormulario();
          $('#BotonAgregar').show();
          $('#BotonModificar').hide();
          $('#BotonBorrar').hide();
          if (info.allDay) {
            $('#FechaInicio').val(info.dateStr);
            $('#FechaFin').val(info.dateStr);
          } else {
            let fechaHora = info.dateStr.split("T");
            $('#FechaInicio').val(fechaHora[0]);
            $('#FechaFin').val(fechaHora[0]);
            $('#HoraInicio').val(fechaHora[1].substring(0, 5));
          }
          $("#FormularioEventos").modal();
        },
        eventClick: function(info) {
          $('#BotonModificar').show();
          $('#BotonBorrar').show();
          $('#BotonAgregar').hide();
          $('#Codigo').val(info.event.id);
          $('#Titulo').val(info.event.title);
          $('#Descripcion').val(info.event.extendedProps.descripcion);
          $('#FechaInicio').val(moment(info.event.start).format("YYYY-MM-DD"));
          $('#FechaFin').val(moment(info.event.end).format("YYYY-MM-DD"));
          $('#HoraInicio').val(moment(info.event.start).format("HH:mm"));
          $('#HoraFin').val(moment(info.event.end).format("HH:mm"));
          $('#ColorFondo').val(info.event.backgroundColor);
          $('#ColorTexto').val(info.event.textColor);
          $("#FormularioEventos").modal();
        },
        eventResize: function(info) {
          $('#Codigo').val(info.event.id);
          $('#Titulo').val(info.event.title);
          $('#FechaInicio').val(moment(info.event.start).format("YYYY-MM-DD"));
          $('#FechaFin').val(moment(info.event.end).format("YYYY-MM-DD"));
          $('#HoraInicio').val(moment(info.event.start).format("HH:mm"));
          $('#HoraFin').val(moment(info.event.end).format("HH:mm"));
          $('#ColorFondo').val(info.event.backgroundColor);
          $('#ColorTexto').val(info.event.textColor);
          $('#Descripcion').val(info.event.extendedProps.descripcion);          
          let registro = recuperarDatosFormulario();
          modificarRegistro(registro);
        },
        eventDrop: function(info) {
          $('#Codigo').val(info.event.id);
          $('#Titulo').val(info.event.title);
          $('#FechaInicio').val(moment(info.event.start).format("YYYY-MM-DD"));
          $('#FechaFin').val(moment(info.event.end).format("YYYY-MM-DD"));
          $('#HoraInicio').val(moment(info.event.start).format("HH:mm"));
          $('#HoraFin').val(moment(info.event.end).format("HH:mm"));
          $('#ColorFondo').val(info.event.backgroundColor);
          $('#ColorTexto').val(info.event.textColor);
          $('#Descripcion').val(info.event.extendedProps.descripcion);
          let registro = recuperarDatosFormulario();
          modificarRegistro(registro);
        },
        drop: function(info) {
          limpiarFormulario();
          $('#ColorFondo').val(info.draggedEl.dataset.colorfondo);
          $('#ColorTexto').val(info.draggedEl.dataset.colortexto);
          $('#Titulo').val(info.draggedEl.dataset.titulo);
          let fechaHora = info.dateStr.split("T");
          $('#FechaInicio').val(fechaHora[0]);
          $('#FechaFin').val(fechaHora[0]);
          if (info.allDay) { //verdadero si el calendario esta en vista de mes
            $('#HoraInicio').val(info.draggedEl.dataset.horainicio);
            $('#HoraFin').val(info.draggedEl.dataset.horafin);
          } else {
            $('#HoraInicio').val(fechaHora[1].substring(0, 5));
            $('#HoraFin').val(moment(fechaHora[1].substring(0, 5)).add(1, 'hours'));
          }
          let registro = recuperarDatosFormulario();
          agregarEventoPredefinido(registro);
        }
      });

      calendario1.render();


      new FullCalendarInteraction.Draggable(document.getElementById('listaeventospredefinidos'), {
        itemSelector: '.fc-event',
        eventData: function(eventEl) {
          return {
            title: eventEl.innerText.trim()
          }
        }
      });

      //Eventos de botones de la aplicación
      $('#BotonAgregar').click(function() {
        let registro = recuperarDatosFormulario();
        agregarRegistro(registro);
        $("#FormularioEventos").modal('hide');
      });

      $('#BotonModificar').click(function() {
        let registro = recuperarDatosFormulario();
        modificarRegistro(registro);
        $("#FormularioEventos").modal('hide');
      });

      $('#BotonBorrar').click(function() {
        let registro = recuperarDatosFormulario();
        borrarRegistro(registro);
        $("#FormularioEventos").modal('hide');
      });

      $('#BotonEventosPredefinidos').click(function() {
        window.location = "index.php";
      });


      // funciones para comunicarse con el servidor via ajax
      function agregarRegistro(registro) {
        $.ajax({
          type: 'POST',
          url: 'datoseventos.php?accion=agregar',
          data: registro,
          success: function(msg) {
            calendario1.refetchEvents();
          },
          error: function(error) {
            alert("Hay un problema:" + error);
          }
        });
      }

      function modificarRegistro(registro) {
        $.ajax({
          type: 'POST',
          url: 'datoseventos.php?accion=modificar',
          data: registro,
          success: function(msg) {
            calendario1.refetchEvents();
          },
          error: function(error) {
            alert("Hay un problema:" + error);
          }
        });
      }

      function borrarRegistro(registro) {
        $.ajax({
          type: 'POST',
          url: 'datoseventos.php?accion=borrar',
          data: registro,
          success: function(msg) {
            calendario1.refetchEvents();
          },
          error: function(error) {
            alert("Hay un problema:" + error);
          }
        });
      }

      function agregarEventoPredefinido(registro) {
        $.ajax({
          type: 'POST',
          url: 'datoseventos.php?accion=agregar',
          data: registro,
          success: function(msg) {
            calendario1.removeAllEvents();
            calendario1.refetchEvents();
          },
          error: function(error) {
            alert("Hay un problema:" + error);
          }
        });
      }

      // funciones que interactuan con el formulario de entrada de datos
      function limpiarFormulario() {
        $('#Codigo').val('');
        $('#Titulo').val('');
        $('#Descripcion').val('');
        $('#FechaInicio').val('');
        $('#FechaFin').val('');
        $('#HoraInicio').val('');
        $('#HoraFin').val('');
        $('#ColorFondo').val('#3788D8');
        $('#ColorTexto').val('#ffffff');
      }

      function recuperarDatosFormulario() {
        let registro = {
          codigo: $('#Codigo').val(),
          titulo: $('#Titulo').val(),
          descripcion: $('#Descripcion').val(),
          inicio: $('#FechaInicio').val() + ' ' + $('#HoraInicio').val(),
          fin: $('#FechaFin').val() + ' ' + $('#HoraFin').val(),
          colorfondo: $('#ColorFondo').val(),
          colortexto: $('#ColorTexto').val()
        };
        return registro;
      }


    });
  </script>

</body>

</html>