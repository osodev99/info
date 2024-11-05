<?php

session_start();
require "conexion.php";

if (!isset($_SESSION['tipo_idtipo'])) { //indica que el usuario inicio secion
    include("template/cabecera2.php");
} else {
    $nombre = $_SESSION['nombre'];
    $nivel = $_SESSION['nivel'];
    $pater = $_SESSION['tipo_idtipo']; //para crear aca necesitamos mandarnos ap en la consulta y en la sesion, desde index.php
    //echo $nivel;
    $tipo_idtipo = $_SESSION['tipo_idtipo']; //sabemos si es 1 o 2 tipo de usuario
    include("template/cabecera.php");
}
?>
<section class="vh-100 bg-image" style="background-image: url('https://images.pexels.com/photos/2749481/pexels-photo-2749481.jpeg');">
    <div class="mask d-flex align-items-center h-100">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-7">
                    <div class="card shadow-lg border-0 rounded-lg mt-5">
                        <div class="card-header">
                            <h3 class="text-center font-weight-light my-4">Registro Nuevo Usuario</h3>
                        </div>
                        <div class="card-body">
                            <form action="grabarusu.php" method="post" onsubmit="return validarContraseña()" enctype="multipart/form-data"><!--enctype="multipart/form-data" esto sirve para guardar imagenes jpg-->
                                <input type="hidden" name="Tipo_Usu" id="Tipo_Usu" value="2">
                                <div class="form-floating mb-3">
                                    <input class="form-control" name="nombre" id="nombre" type="text" placeholder="Enter your first name" />
                                    <label for="inputEmail">Nombres</label>
                                </div>
                                <!-- <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                        <input class="form-control" name="ap_paterno" id="ap_paterno" type="text" placeholder="Enter your last name" />
                                                        <label for="inputFirstName">Apellido Paterno</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-floating">
                                                        <input class="form-control" name="ap_materno" id="ap_materno" type="text" placeholder="Enter your last name" />
                                                        <label for="inputLastName">Apellido Materno</label>
                                                    </div>
                                                </div>
                                            </div>-->
                                <div class="form-floating mb-3">
                                    <input class="form-control" name="email" id="email" type="email" placeholder="name@example.com" />
                                    <label for="inputEmail">Correo electronico</label>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <div class="form-floating mb-3 mb-md-0">
                                            <input class="form-control" name="ci" id="ci" type="text" placeholder="Enter your ID Number" />
                                            <label for="inputFirstName">CI</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input class="form-control" name="telefono" id="telefono" type="text" placeholder="Enter your Cell Phone" />
                                            <label for="inputLastName">Telefono / Celular</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <div class="form-floating mb-3 mb-md-0">
                                            <input class="form-control" name="usuario" id="usuario" type="usuario" placeholder="Create a usuario" />
                                            <label for="inputusuario">Usuario</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating mb-3 mb-md-0">
                                            <input class="form-control" name="password" id="password" type="password" placeholder="Create a password" />
                                            <label for="inputPassword">Contraseña</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <div class="form-floating mb-3 mb-md-0">
                                            <input class="form-control" name="confirm_password" id="confirm_password" type="password" placeholder="Repeat the password" />
                                            <label for="confirm_password">Repite Contraseña</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="checkbox" id="show_passwords" onclick="togglePasswordsVisibility()"> Mostrar Contraseñas
                                    </div>
                                </div>



                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <!-- probando sexo opcion-->
                                        <div class="form-group mb-3 mb-md-0">
                                            <label for="exampleFormControlSelect1">Rol</label>
                                            <select class="form-control" name="rol" id="rol">
                                                <option>Artesano</option>
                                                <option>Comprador</option>
                                                <option>Delivery</option>
                                            </select>
                                        </div>
                                    </div>
                                    <!-- <div class="col-md-6">
                                                <div class="form-group mb-3 mb-md-0">
                                                        <label for="foto">Adjuntar una Foto</label>
                                                        <input type="file"  name="foto" id="foto">
                                                        <p class="help-block">Seleccione foto para el Estudiante.</p>
                                                    </div>
                                                </div>
                                            </div>-->
                                    <div class="mt-4 mb-0">
                                        <div class="d-grid"><button type="submit" value="registrar" class="btn btn-success btn-block">Crear cuenta</button></div>
                                    </div>
                            </form>
                        </div>
                        <div class="card-footer text-center py-3 ">
                            <div class="small"><a href="index.php">¿Tienes una cuenta? Ir a iniciar sesión</a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function validarContraseña() {
            // Obtener el valor de la contraseña ingresada por el usuario
            var contraseña = document.getElementById("password").value;
            //aumente esto para repetir contraseña
            var repetirContraseña = document.getElementById("confirm_password").value;

            // Expresiones regulares para verificar si la contraseña cumple con los requisitos
            var tieneAlMenosUnNumero = /[0-9]/.test(contraseña);
            var tieneAlMenosUnaMayuscula = /[A-Z]/.test(contraseña);
            var tieneAlMenosUnaMinuscula = /[a-z]/.test(contraseña);
            var tieneAlMenosOchoCaracteres = contraseña.length >= 8;
            /*si tiene simbolo*/
            var tieneSimbolo = /[!@#$%^&*]/.test(contraseña);

            // Verificar si la contraseña cumple con todos los requisitos
            if (tieneAlMenosUnNumero && tieneAlMenosUnaMayuscula && tieneAlMenosUnaMinuscula && tieneAlMenosOchoCaracteres && tieneSimbolo) {
                // La contraseña es válida, se puede enviar el formulario
                return true;
            } else {
                // La contraseña no cumple con los requisitos, mostrar un mensaje de error
                alert("La contraseña debe tener al menos 8 caracteres, incluyendo al menos un número, una mayúscula, una minúscula y un simbolo.");
                return false;
            }

            if (contraseña !== repetirContraseña) {
                alert("Las contraseñas no coinciden");
                return false;
            } else {
                alert("Las contraseñas si coinciden");
                return true;
            }


        }

        function togglePasswordsVisibility() {
            var passwordField = document.getElementById("password");
            var confirmPasswordField = document.getElementById("confirm_password");
            if (passwordField.type === "password") {
                passwordField.type = "text";
                confirmPasswordField.type = "text";
            } else {
                passwordField.type = "password";
                confirmPasswordField.type = "password";
            }
        }
    </script>
</section>
<?php include("template/pie.php"); ?>