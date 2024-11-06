<?php

    session_start();
    require "conexion.php";

    if(!isset($_SESSION['tipo_idtipo'])){//indica que el usuario inicio secion
        header("location: index.php");
    }
    
    $nombre = $_SESSION['nombre'];
    $nivel = $_SESSION['nivel'];
    //$pater = $_SESSION['tipo_idtipo'];//para crear aca necesitamos mandarnos ap en la consulta y en la sesion, desde index.php
    //echo $nivel;
    $tipo_idtipo = $_SESSION['tipo_idtipo'];//sabemos si es 1 o 2 tipo de usuario
    $idusu = $_SESSION['tipo_idtipo'];//como ya tenemos idUSUARIO mandandonos desde index le damos este valor a idusu para poder utilizar este registro
    

?>

<?php include("template/cabecera.php"); ?>

<body>
  <!-- card meses -->
  <div class="card">
    <div class="card-header border-0">
      <div class="d-flex justify-content-between">
        <h3 class="card-title">Ventas por mes</h3>
      </div>
    </div>
    <div class="card-body">
      <div class="position-relative mb-4">
        <canvas id="sales-chart" height="200"></canvas>
      </div>

      <div class="d-flex flex-row justify-content-end">
        <span class="mr-2">
          <i class="fas fa-square text-primary"></i> Ventas 
        </span>

        <span>
          <i class="fas fa-square text-gray"></i> Productos
        </span>
      </div>
    </div>
  </div>
  <!-- /.card -->
  
  <!-- card hoy -->
  <div class="card">
    <div class="card-header border-0">
      <div class="d-flex justify-content-between">
        <h3 class="card-title">Ventas de hoy</h3>
      </div>
    </div>
    <div class="card-body">
      <div class="position-relative mb-4">
        <canvas id="sales-today-chart" height="200"></canvas>
      </div>

      <div class="d-flex flex-row justify-content-end">
        <span class="mr-2">
          <i class="fas fa-square text-primary"></i> Ventas 
        </span>

        <span>
          <i class="fas fa-square text-gray"></i> Productos
        </span>
      </div>
    </div>
  </div>
  <!-- /.card -->
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-6">
            <div class="card">
              <div class="card-header border-0">
                <div class="d-flex justify-content-between">
                  <h3 class="card-title">Estado de los pedidos</h3>
                </div>
              </div>
              <div class="card-body">
                <div class="position-relative mb-4">
                  <canvas id="visitors-chart" height="200"></canvas>
                </div>

                <div class="d-flex flex-row justify-content-end">
                  <span class="mr-2">
                    <i class="fas fa-square text-primary"></i>Aceptado 
                  </span>
                  <span>
                    <i class="fas fa-square text-gray"></i> Rechazado
                  </span>
                  <span>
                    <i class="fas fa-square text-danger"></i> Pendiente
                  </span>
                </div>
              </div>
            </div>
            <!-- /.card -->

            <!-- <div class="card">
              <div class="card-header border-0">
                <h3 class="card-title">Products</h3>
                <div class="card-tools">
                  <a href="#" class="btn btn-tool btn-sm">
                    <i class="fas fa-download"></i>
                  </a>
                  <a href="#" class="btn btn-tool btn-sm">
                    <i class="fas fa-bars"></i>
                  </a>
                </div>
              </div>
              <div class="card-body table-responsive p-0">
                <table class="table table-striped table-valign-middle">
                  <thead>
                  <tr>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Sales</th>
                    <th>More</th>
                  </tr>
                  </thead>
                  <tbody>
                  <tr>
                    <td>
                      <img src="dist/img/default-150x150.png" alt="Product 1" class="img-circle img-size-32 mr-2">
                      Some Product
                    </td>
                    <td>$13 USD</td>
                    <td>
                      <small class="text-success mr-1">
                        <i class="fas fa-arrow-up"></i>
                        12%
                      </small>
                      12,000 Sold
                    </td>
                    <td>
                      <a href="#" class="text-muted">
                        <i class="fas fa-search"></i>
                      </a>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <img src="dist/img/default-150x150.png" alt="Product 1" class="img-circle img-size-32 mr-2">
                      Another Product
                    </td>
                    <td>$29 USD</td>
                    <td>
                      <small class="text-warning mr-1">
                        <i class="fas fa-arrow-down"></i>
                        0.5%
                      </small>
                      123,234 Sold
                    </td>
                    <td>
                      <a href="#" class="text-muted">
                        <i class="fas fa-search"></i>
                      </a>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <img src="dist/img/default-150x150.png" alt="Product 1" class="img-circle img-size-32 mr-2">
                      Amazing Product
                    </td>
                    <td>$1,230 USD</td>
                    <td>
                      <small class="text-danger mr-1">
                        <i class="fas fa-arrow-down"></i>
                        3%
                      </small>
                      198 Sold
                    </td>
                    <td>
                      <a href="#" class="text-muted">
                        <i class="fas fa-search"></i>
                      </a>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <img src="dist/img/default-150x150.png" alt="Product 1" class="img-circle img-size-32 mr-2">
                      Perfect Item
                      <span class="badge bg-danger">NEW</span>
                    </td>
                    <td>$199 USD</td>
                    <td>
                      <small class="text-success mr-1">
                        <i class="fas fa-arrow-up"></i>
                        63%
                      </small>
                      87 Sold
                    </td>
                    <td>
                      <a href="#" class="text-muted">
                        <i class="fas fa-search"></i>
                      </a>
                    </td>
                  </tr>
                  </tbody>
                </table>
              </div>
            </div> -->
            <!-- /.card -->
          </div>
          <!-- /.col-md-6 -->
          <div class="col-lg-6">

            <div class="card">
              <div class="card-header border-0">
                <h3 class="card-title">Estado de los pedidos</h3>
                <div class="card-tools">
                  <a href="#" class="btn btn-sm btn-tool">
                    <i class="fas fa-download"></i>
                  </a>
                  <a href="#" class="btn btn-sm btn-tool">
                    <i class="fas fa-bars"></i>
                  </a>
                </div>
              </div>
              <div class="card-body">
                <div class="d-flex justify-content-between align-items-center border-bottom mb-3">
                  <p class="text-success text-xl">
                    <i class="ion ion-ios-refresh-empty"></i>
                  </p>
                  <p class="d-flex flex-column text-right">
                    <span class="font-weight-bold">
                      <i class="ion ion-android-arrow-up text-success"></i> 12%
                    </span>
                    <span class="text-muted">Pendientes</span>
                  </p>
                </div>
                <!-- /.d-flex -->
                <div class="d-flex justify-content-between align-items-center border-bottom mb-3">
                  <p class="text-warning text-xl">
                    <i class="ion ion-ios-cart-outline"></i>
                  </p>
                  <p class="d-flex flex-column text-right">
                    <span class="font-weight-bold">
                      <i class="ion ion-android-arrow-up text-warning"></i> 0.8%
                    </span>
                    <span class="text-muted">Aceptados</span>
                  </p>
                </div>
                <!-- /.d-flex -->
                <div class="d-flex justify-content-between align-items-center mb-0">
                  <p class="text-danger text-xl">
                    <i class="ion ion-ios-people-outline"></i>
                  </p>
                  <p class="d-flex flex-column text-right">
                    <span class="font-weight-bold">
                      <i class="ion ion-android-arrow-down text-danger"></i> 1%
                    </span>
                    <span class="text-muted">Rechazados</span>
                  </p>
                </div>
                <!-- /.d-flex -->
              </div>
            </div>
          </div>
          <!-- /.col-md-6 -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->

</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE -->
<script src="dist/js/adminlte.js"></script>

<!-- OPTIONAL SCRIPTS -->
<script src="plugins/chart.js/Chart.min.js"></script>
<!-- AdminLTE for demo purposes -->
<!-- <script src="dist/js/demo.js"></script> -->
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="dist/js/pages/dashboard3.js"></script>
</body>
