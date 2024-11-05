5<!--UPDATE usuarios SET password = '123456789' WHERE usuario = 'Yhared4321' AND correo = 'yhorelyharedalvareza@gmail.com';-->
<?php
    require "conexion.php";
    
    // Iniciar sesión para almacenar el número aleatorio generado
    session_start();

    if(isset($_POST['contrasena']) && isset($_POST['contrasena_confirm'])) {
        $usuario = $_SESSION['usuario'];
        $correo = $_SESSION['correo'];
        $contrasena_nueva = $_POST['contrasena']; // Obtener la contraseña nueva desde el formulario

        // Validar que las contraseñas sean iguales
        if($_POST['contrasena'] == $_POST['contrasena_confirm']) {
            // Consulta SQL para actualizar la contraseña en la base de datos
            $contrasena_encriptada = sha1($_POST['contrasena']);
            $consulta_actualizar_contrasena = "UPDATE usuarios SET password = '$contrasena_encriptada' WHERE usuario = '$usuario' AND correo = '$correo';";
            
            // Ejecutar la consulta
            $resultado_actualizar_contrasena = mysqli_query($mysqli, $consulta_actualizar_contrasena);

            // Verificar si la consulta se ejecutó correctamente
            if($resultado_actualizar_contrasena) {
                unset($_SESSION['usuario']);
                unset($_SESSION['correo']);
                echo "<script>
                        alert('Se actualizó su contraseña :D');
                        window.location.href='index.php';
                      </script>";
            } else {
                echo "<script>
                        alert('Ha ocurrido un error al actualizar la contraseña. Por favor, inténtelo de nuevo.');
                        window.location.href='contranueva.php';
                      </script>";
            }
        } else {
            echo "<script>
                    alert('Las contraseñas no coinciden. Por favor, inténtelo de nuevo.');
                    window.location.href='contranueva.php';
                  </script>";
        }
    }
?>

<?php include("template/cabecera3.php");?>
<section class="vh-100 bg-image" style= "background-image: url('https://images.pexels.com/photos/2749481/pexels-photo-2749481.jpeg');">
    <div class="mask d-flex align-items-center h-100">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-7">
                    <div class="card shadow-lg border-0 rounded-lg mt-5">
                        <div class="card-header"><h3 class="text-center font-weight-light my-4">Nueva Contraseña</h3></div>
                        <div class="card-body">
                            <form action="contranueva.php" method="post" onsubmit="return validarContraseña()" enctype="multipart/form-data">
                                <div class="sb-sidenav-menu-heading">Contraseña nueva</div>    
                                <div class="form-floating mb-3">
                                    <input class="form-control" name="contrasena" id="contrasena" type="password" placeholder="Ingrese la contraseña nueva" />
                                    <label for="inputusuario">Contraseña nueva</label>
                                    <span id="togglePassword" class="password-toggle" onclick="togglePasswordVisibility()">
                                        <i id="passwordIcon" class="fas fa-eye"></i> <!-- Font Awesome icon for an eye -->
                                        <label class="form-label" for="inputPassword">Password</label>
                                    </span>
                                </div>
                                <div class="form-floating mb-3">
                                    <input class="form-control" name="contrasena_confirm" id="contrasena_confirm" type="password" placeholder="Confirme la contraseña nueva" />
                                    <label for="inputEmail">Confirmar contraseña nueva</label>
                                    <span id="togglePassword" class="password-toggle" onclick="togglePasswordVisibility1()">
                                        <i id="passwordIcon1" class="fas fa-eye"></i> <!-- Font Awesome icon for an eye -->
                                        <label class="form-label" for="inputPassword">Password</label>
                                    </span>
                                </div>
                                
                                <div class="mt-4 mb-0">
                                    <div class="d-grid"><button type="submit" value="registrar" class="btn btn-warning btn-block">Recuperar mi Cuenta</button></div>
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
    <script>
        function validarContraseña() {
            // Obtener el valor de la contraseña ingresada por el usuario
            var contraseña = document.getElementById("contrasena").value;

            // Expresiones regulares para verificar si la contraseña cumple con los requisitos
            var tieneAlMenosUnNumero = /[0-9]/.test(contraseña);
            var tieneAlMenosUnaMayuscula = /[A-Z]/.test(contraseña);
            var tieneAlMenosUnaMinuscula = /[a-z]/.test(contraseña);
            var tieneAlMenosOchoCaracteres = contraseña.length >= 8;

            // Verificar si la contraseña cumple con todos los requisitos
            if (tieneAlMenosUnNumero && tieneAlMenosUnaMayuscula && tieneAlMenosUnaMinuscula && tieneAlMenosOchoCaracteres) {
                // La contraseña es válida, se puede enviar el formulario
                return true;
            } else {
                // La contraseña no cumple con los requisitos, mostrar un mensaje de error
                alert("La contraseña debe tener al menos 8 caracteres, incluyendo al menos un número, una mayúscula y una minúscula.");
                return false;
            }
        }
        function togglePasswordVisibility() {
            const passwordInput = document.getElementById("contrasena");
            const passwordIcon = document.getElementById("passwordIcon");

            if (passwordInput.type === "password") {
                passwordInput.type = "text";
                passwordIcon.classList.remove("fa-eye");
                passwordIcon.classList.add("fa-eye-slash");
            } else {
                passwordInput.type = "password";
                passwordIcon.classList.remove("fa-eye-slash");
                passwordIcon.classList.add("fa-eye");
            }
        }
        function togglePasswordVisibility1() {
            const passwordInput = document.getElementById("contrasena_confirm");
            const passwordIcon = document.getElementById("passwordIcon1");

            if (passwordInput.type === "password") {
                passwordInput.type = "text";
                passwordIcon.classList.remove("fa-eye");
                passwordIcon.classList.add("fa-eye-slash");
            } else {
                passwordInput.type = "password";
                passwordIcon.classList.remove("fa-eye-slash");
                passwordIcon.classList.add("fa-eye");
            }
        }
    </script>
</section>    
<?php include("template/pie.php");?>
