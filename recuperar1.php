<?php
    require "conexion.php";
    
    // Iniciar sesión para almacenar el número aleatorio generado
    session_start();
    
    if(isset($_POST['correo']) && isset($_POST['usuario'])) {
        $cor = $_POST['correo'];
        $usu = $_POST['usuario'];

        // Verificar que las variables no estén vacías
        if(!empty($cor) && !empty($usu)) {
            // Consulta para verificar si el usuario ya existe
            $consulta_usuario_existente = "SELECT * FROM usuarios WHERE usuario = '$usu'";
            $resultado_usuario_existente = mysqli_query($mysqli, $consulta_usuario_existente);
            
            // Verificar si se encontró algún usuario con el mismo nombre de usuario
            if (mysqli_num_rows($resultado_usuario_existente) > 0) {
                // Si el usuario ya existe, generar y almacenar el número aleatorio
                $numeroAleatorio = rand(100000, 999999);
                $_SESSION['numeroAleatorio'] = $numeroAleatorio;
                $_SESSION['usuario'] = $usu; // Guardar el usuario en la sesión
                $_SESSION['correo'] = $cor; // Guardar el correo en la sesión

                // Enviar correo electrónico con el número aleatorio
                $to = $cor;
                $subject = 'Recuperación de contraseña';
                $message = 'Tu número de recuperación de contraseña es: ' . $numeroAleatorio;
                $headers = 'From: yalvareza@fcpn.edu.bo' . "\r\n" .
                        'X-Mailer: PHP/' . phpversion();
                if (mail($to, $subject, $message, $headers)) {
                    echo "<script>
                        alert('Correo de recuperación de contraseña enviado.');
                        </script>";
                } else {
                    echo "<script>
                        alert('Ha ocurrido un error al enviar el correo de recuperación de contraseña.');
                        </script>";
                }
            } else {
                // Si el usuario no existe, mostrar un mensaje de error
                echo "<script>
                        alert('El usuario no existe, por favor elige otro nombre de usuario.');
                      </script>";
            }
        } else {
            // Si alguna de las variables está vacía, mostrar un mensaje de error
            echo "<script>
                    alert('Por favor, complete todos los campos.');
                    </script>";
        }
    } elseif(isset($_POST['numero'])) {
        // Verificar el número ingresado por el usuario
        if(isset($_SESSION['numeroAleatorio'])) {
            $numeroAleatorioGenerado = $_SESSION['numeroAleatorio'];
            $numeroIngresadoPorUsuario = $_POST['numero'];
            
            if($numeroAleatorioGenerado == $numeroIngresadoPorUsuario) {
                // El número ingresado por el usuario coincide con el número aleatorio generado
                echo "<script>
                        alert('Número verificado correctamente.');
                        window.location.href='contranueva.php';
                     </script>";
                // Realiza aquí las acciones adicionales, como restablecer la contraseña
            } else {
                // El número ingresado por el usuario no coincide con el número aleatorio generado
                echo "<script>
                        alert('Número incorrecto. Inténtelo de nuevo.');
                        window.location.href='recupera1.php';
                     </script>";
            }
        } else {
            // No se ha generado ningún número aleatorio
            echo "<script>
                    alert('Error: No se ha generado ningún número aleatorio.');
                 </script>";
        }
        // Eliminar el número aleatorio de la sesión después de verificarlo
        unset($_SESSION['numeroAleatorio']);
    }
?>



<?php include("template/cabecera3.php");?>
<section class="vh-100 bg-image" style= "background-image: url('https://images.pexels.com/photos/2749481/pexels-photo-2749481.jpeg');">
                <div class="mask d-flex align-items-center h-100">
                <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-7">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Autentificacion</h3></div>
                                    <div class="card-body">
                                        <form action="recuperar1.php" method="post" enctype="multipart/form-data"><!--enctype="multipart/form-data" esto sirve para guardar imagenes jpg-->
                                            <div class="sb-sidenav-menu-heading">Codigo de verificacion de recuperacion</div>    
                                                <div class="form-floating mb-3">
                                                    <input class="form-control" name="numero" id="numero" type="numero" placeholder="Create a usuario" />
                                                    <label for="inputusuario">Numero</label>
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