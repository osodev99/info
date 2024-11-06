<!DOCTYPE html>
<html lang="es">

<head>
    <!-- Plantilla -->
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Raices Artesanales</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.0/css/all.min.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/styless.css" rel="stylesheet">
    <!--tipo_idtipo le quite eso despues de nombre -->

      <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- IonIcons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">

</head>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3"><span class="text-success">R</span>aices <span class="text-success">A</span>rtesanales</a>
        <!-- Sidebar Toggle-->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
        <!-- Navbar-->
        <ul class="navbar-nav ms-auto me-0 me-md-3 my-2 my-md-0">
            <li class="nav-item dropdown"> <!-- MENU EN CASCADA DE USUARIO-->
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><?php echo $nivel; ?>&nbsp;- &nbsp;<?php echo $nombre; ?>&nbsp;<i class="fas fa-user fa-fw"></i></a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="principal.php"><i class="fa fa-user fa-fw"></i>Perfil</a></li>
                    <li><a class="dropdown-item" href="listaevento.php"><i class="fa fa-pencil fa-fw"></i>Actividades</a></li>
                    <li><a class="dropdown-item" href="#!"><i class="fa fa-cog fa-spin fa-lg fa-fw"></i>Configuración</a></li>
                    <li>
                        <hr class="dropdown-divider" />
                    </li>
                    <li><a class="dropdown-item" href="logout.php"><i class="fa fa-unlock"></i>Cerrar Sesion</a></li>
                </ul>
            </li>
        </ul>
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion"><!--sb-sidenav-light (barra blanca)-->
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <div class="sb-sidenav-menu-heading">Configuracion</div><!--esta parte lo quitas si quieres-->
                        <a class="nav-link" href="principal.php">
                            <div class="sb-nav-link-icon"><i class="fa fa-home fa-fw" aria-hidden="true"></i></div>
                            Inicio
                        </a>
                        <?php if ($tipo_idtipo == 1) { ?><!--privilegiuos para solo para ADMIN empieza-->
                            <div class="sb-sidenav-menu-heading">Pedidsos</div>
                            <a class="nav-link" href="dashboard.php">
                                <div class="sb-nav-link-icon"><i class="fa fa-book fa-fw" aria-hidden="true"></i></div>
                                Dashboard
                            </a>
                        <?php } ?>

                        <?php if ($tipo_idtipo == 2) { ?><!--privilegiuos para solo para ADMIN empieza-->
                            <div class="sb-sidenav-menu-heading">Productos</div>
                            <a class="nav-link" href="producto.php">
                                <div class="sb-nav-link-icon"><i class="fa fa-book fa-fw" aria-hidden="true"></i></div>
                                Registro mis Prductos
                            </a>
                            <a class="nav-link" href="mostra_producto.php">
                                <div class="sb-nav-link-icon"><i class="fa fa-book fa-fw" aria-hidden="true"></i></div>
                                Mis Productos
                            </a>
                            <a class="nav-link" href="carrito.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Carrito
                            </a>
                            <div class="sb-sidenav-menu-heading">Pedidos</div>
                            <a class="nav-link" href="productof.php">
                                <div class="sb-nav-link-icon"><i class="fa fa-book fa-fw" aria-hidden="true"></i></div>
                                Pedidos Aceptados y Rechazados
                            </a>
                        <?php } ?>

                        <?php if ($tipo_idtipo == 3) { ?><!--privilegiuos para solo para ADMIN empieza-->
                            <div class="sb-sidenav-menu-heading">Productos</div>
                            <a class="nav-link" href="mostra_producto.php">
                                <div class="sb-nav-link-icon"><i class="fa fa-book fa-fw" aria-hidden="true"></i></div>
                                Productos
                            </a>
                            <a class="nav-link" href="carrito1.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Carrito
                            </a>
                            <div class="sb-sidenav-menu-heading">Pagos</div>
                            <a class="nav-link" href="productof.php">
                                <div class="sb-nav-link-icon"><i class="fa fa-book fa-fw" aria-hidden="true"></i></div>
                                Pedidos Aceptados y Rechazados
                            </a>
                        <?php } ?><!--privilegiuos para usuarios acabas-->

                        <?php if ($tipo_idtipo == 4) { ?><!--privilegiuos para solo para ADMIN empieza-->
                            <div class="sb-sidenav-menu-heading">Pedidsos</div>
                            <a class="nav-link" href="delivery.php">
                                <div class="sb-nav-link-icon"><i class="fa fa-book fa-fw" aria-hidden="true"></i></div>
                                Pedidos
                            </a>
                            <a class="nav-link" href="entrega.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Entrega
                            </a>
                            <div class="sb-sidenav-menu-heading">Entregas</div>
                            <a class="nav-link" href="pedidosf.php">
                                <div class="sb-nav-link-icon"><i class="fa fa-book fa-fw" aria-hidden="true"></i></div>
                                Pedidos Aceptados y Rechazados
                            </a>
                        <?php } ?><!--privilegiuos para usuarios acabas-->

                    </div>
                </div>
                <div class="sb-sidenav-footer">
                    <div class="small">Conectado como:</div>
                    <?php echo $nivel; ?>
                </div>
            </nav>
        </div>
        <!--este seria el cuerpo de la pagina-->
        <div id="layoutSidenav_content">