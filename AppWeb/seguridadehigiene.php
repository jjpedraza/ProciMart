<?php
  include ("head.php");
  include ("header.php");
?>

<!DOCTYPE html>
  <html lang="en">

    <head>
      <meta charset="utf-8" />
      <meta http-equiv="X-UA-Compatible" content="IE=edge" />
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
      <meta name="description" content="" />
      <meta name="author" content="" />
      <title>Procimart</title>
      <link href="lib/seguridadehigiene.css" rel="stylesheet" />
      <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet"
        crossorigin="anonymous" />
      <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous">
      </script>
    </head>

    <body class="sb-nav-fixed">
      <!-- <div id="layoutSidenav_content"> -->
          <main>
            <div class="container-fluid">
              <h5 class="mt-4">DASHBOARD: Seguridad e Higiene</h5>
              <div class="alert alert-info alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  <p style="font-size:15px">
                    <i class="icon fa fa-user"></i> Bienvenido <strong>Epifanio Guzman Baez</strong> a la aplicación de tablero de mando.
                  </p>        
              </div>

              <div class="row">
                <div class="col-xl-3 col-md-6">
                  <div class="card bg-primary text-white mb-4">
                    <div class="card-body">
                      <table class="tftable">
                        <tr>
                          <td style="width:87%">Número de eventos registrados en el sistema PROCIMART</td>
                          <td style="width:13%"><h3>1</h3></td>
                        </tr>
                      </table>
                    </div>
                    <!-- <div class="card-footer d-flex align-items-center justify-content-between">
                      <a class="small text-white stretched-link" href="#">Ver detalles</a>
                      <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div> -->
                  </div>
                </div>

                <div class="col-xl-3 col-md-6">
                  <div class="card bg-warning text-white mb-4">
                    <div class="card-body">
                      <table class="tftable">
                        <tr>
                          <td style="width:87%">Número de eventos registrados en <?php echo date("Y"); ?></td>
                          <td style="width:13%"><h3>0</h3></td>
                        </tr>
                      </table>
                    </div>
                    <!-- <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="#">Ver detalles</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div> -->
                  </div>
                </div>

                <div class="col-xl-3 col-md-6">
                  <div class="card bg-danger text-white mb-4">
                    <div class="card-body">
                      <table class="tftable">
                        <tr>
                          <td style="width:87%">Número de personas incapacitadas en lo que va del año.</td>
                          <td style="width:13%"><h3>0</h3></td>
                        </tr>
                      </table>
                    </div>
                    <!-- <div class="card-footer d-flex align-items-center justify-content-between">
                      <a class="small text-white stretched-link" href="#">Ver detalles</a>
                      <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div> -->
                  </div>
                </div>

                <div class="col-xl-3 col-md-6">
                  <div class="card bg-success text-white mb-4">
                    <div class="card-body">
                      <table class="tftable">
                        <tr>
                          <td style="width:87%">Número de personas incapacitadas actualmente.</td>
                          <td style="width:13%"><h3>0</h3></td>
                        </tr>
                      </table>
                    </div>
                    <!-- <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="#">Ver detalles</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div> -->
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-xl-6">
                  <div class="card mb-4">
                    <div class="card-header">
                      <i class="fas fa-chart-area mr-1"></i>
                      Concentrados de eventos
                    </div>
                    <div class="card-body"><canvas id="myAreaChart" width="100%" height="40"></canvas></div>
                  </div>
                </div>
                <div class="col-xl-6">
                  <div class="card mb-4">
                    <div class="card-header">
                      <i class="fas fa-chart-bar mr-1"></i>
                      Comportamiento de eventos por mes
                    </div>
                    <div class="card-body"><canvas id="myBarChart" width="100%" height="40"></canvas></div>
                  </div>
                </div>
              </div>
              <div class="card mb-4">
                <div class="card-header">
                  <i class="fas fa-table mr-1"></i>
                  Ultimos eventos registrados en PLANTA
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                      <thead>
                        <tr>
                          <th>Name</th>
                          <th>Position</th>
                          <th>Office</th>
                          <th>Age</th>
                          <th>Start date</th>
                          <th>Salary</th>
                        </tr>
                      </thead>
                      <tfoot>
                        <tr>
                          <th>Name</th>
                          <th>Position</th>
                          <th>Office</th>
                          <th>Age</th>
                          <th>Start date</th>
                          <th>Salary</th>
                        </tr>
                      </tfoot>
                      <tbody>
                        <tr>
                          <td>Tiger Nixon</td>
                          <td>System Architect</td>
                          <td>Edinburgh</td>
                          <td>61</td>
                          <td>2011/04/25</td>
                          <td>$320,800</td>
                        </tr>
                        <tr>
                          <td>Garrett Winters</td>
                          <td>Accountant</td>
                          <td>Tokyo</td>
                          <td>63</td>
                          <td>2011/07/25</td>
                          <td>$170,750</td>
                        </tr>
                        <tr>
                          <td>Ashton Cox</td>
                          <td>Junior Technical Author</td>
                          <td>San Francisco</td>
                          <td>66</td>
                          <td>2009/01/12</td>
                          <td>$86,000</td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </main>
        </div>

        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
        </script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="lib/seguridadehigiene_grafica01.js"></script>
        <script src="lib/seguridadehigiene_grafica02.js"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/datatables-demo.js"></script>
    
      <!-- </body> -->

</html>

<?php
  include ("footer.php");
?>