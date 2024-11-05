<?php include("template/cabecera3.php");?>
 <section class="vh-100 bg-image" style= "background-image: url('https://images.pexels.com/photos/2749481/pexels-photo-2749481.jpeg');">
                <div class="mask d-flex align-items-center h-100">
                <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-7">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Recuperacion de mi cuenta</h3></div>
                                    <div class="card-body">
                                        <form action="recuperar1.php" method="post" enctype="multipart/form-data"><!--enctype="multipart/form-data" esto sirve para guardar imagenes jpg-->
                                            <div class="sb-sidenav-menu-heading">Datos de recuperacion</div>    
                                                <div class="form-floating mb-3">
                                                    <input class="form-control" name="usuario" id="usuario" type="usuario" placeholder="Create a usuario" />
                                                    <label for="inputusuario">Usuario</label>
                                                </div>
                                            <div class="form-floating mb-3">
                                                <input class="form-control" name="correo" id="correo" type="email" placeholder="name@example.com" />
                                                <label for="inputEmail">Correo electronico</label>
                                            </div>
                                            
                                            
                                            <div class="mt-4 mb-0">
                                                <div class="d-grid"><button type="submit" value = "registrar" class="btn btn-warning btn-block">Recuperar mi Cuenta</button></div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="card-footer text-center py-3">
                                        <div class="small"><a href="index.php">¿Recordaste tu cuenta? Ir a iniciar sesión</a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>    
<?php include("template/pie.php");?>