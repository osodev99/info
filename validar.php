<?php
require "conexion.php";

// Iniciar sesión para almacenar el número aleatorio generado
session_start();

if (isset($_POST['numero'])) {
    // Verificar el número ingresado por el usuario
    if (isset($_SESSION['numAleatorio'])) {
        $numeroAleatorioGenerado = $_SESSION['numAleatorio'];  // Corrige la variable de sesión
        $numeroIngresadoPorUsuario = $_POST['numero'];
        
        if ($numeroAleatorioGenerado == $numeroIngresadoPorUsuario) {
            // El número ingresado por el usuario coincide con el número aleatorio generado
            echo "<script>
                    alert('Número verificado correctamente.');
                    window.location.href='principal.php';
                 </script>";
            // Realiza aquí las acciones adicionales, como restablecer la contraseña
        } else {
            // El número ingresado por el usuario no coincide con el número aleatorio generado
            echo "<script>
                    alert('Número incorrecto. Inténtelo de nuevo.');
                    window.location.href='validar.php';
                 </script>";
        }
        
        // Eliminar el número aleatorio de la sesión después de verificarlo
        unset($_SESSION['numAleatorio']);
    } else {
        // No se ha generado ningún número aleatorio
        echo "<script>
                alert('Error: No se ha generado ningún número aleatorio.');
             </script>";
    }
}
?>

<?php include("template/cabecera3.php");?>

<section class="vh-100 bg-image" style="background-image: url('https://images.pexels.com/photos/2749481/pexels-photo-2749481.jpeg');">
    <div class="mask d-flex align-items-center h-100">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-7">
                    <div class="card shadow-lg border-0 rounded-lg mt-5">
                        <div class="card-header">
                            <h3 class="text-center font-weight-light my-4">Validar ingreso</h3>
                        </div>
                        <div class="card-body">
                            <form action="validar.php" method="post">
                                <div class="sb-sidenav-menu-heading">Código de verificación de inicio de sesión</div>
                                <div class="form-floating mb-3">
                                    <input class="form-control" name="numero" id="numero" type="text" placeholder="Ingrese el código" required />
                                    <label for="numero">Número</label>
                                </div>
                                <div class="mt-4 mb-0">
                                    <div class="d-grid">
                                        <button type="submit" class="btn btn-warning btn-block">Verificar el Inicio</button>
                                    </div>
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
