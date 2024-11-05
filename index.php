<?php
    require "conexion.php";

    session_start();

    if ($_POST) {
        $usuario = $_POST['usuario'];
        $password = $_POST['password'];

        // Consulta ajustada a la nueva estructura
        $sql = "SELECT id_usuario, nombre, CI, telefono, email, usuario, contraseña, tipo_idtipo
                FROM usuario
                WHERE usuario = '$usuario'";
                
        $resultado = $mysqli->query($sql);
        $num = $resultado->num_rows;

        if ($num > 0) {
            $row = $resultado->fetch_assoc();
            $password_bd = $row['contraseña'];
            $pass_c = sha1($password); // Encriptación SHA1 del password ingresado

            if ($password_bd == $pass_c) {
                // Asignar las variables de sesión
                $_SESSION['idUSUARIO'] = $row['id_usuario'];
                $_SESSION['nombre'] = $row['nombre'];
                $_SESSION['tipo_idtipo'] = $row['tipo_idtipo'];
                $_SESSION['CI'] = $row['CI'];
                $_SESSION['email'] = $row['email'];
                if($row['tipo_idtipo'] == 1){
                    $_SESSION['nivel'] = "Administrador"; 
                }
                if($row['tipo_idtipo'] == 2){
                    $_SESSION['nivel'] = "Artesano"; 
                }
                if($row['tipo_idtipo'] == 3){
                    $_SESSION['nivel'] = "Comprador"; 
                }
                if($row['tipo_idtipo'] == 4){
                    $_SESSION['nivel'] = "Delivery"; 
                }
                $_SESSION['telefono'] = $row['telefono']; 
                // Añadido el campo teléfono
                echo "<script>
                        alert('Contraseña verificada correctamente.');
                        window.location.href='principal.php';
                     </script>"; 
            } else {
                echo "<script>
                        alert('La contraseña no coincide');
                        window.location.href='index.php';
                    </script>";
            }
        } else {
            echo "<script>
                    alert('No existe usuario');
                    window.location.href='index.php';
                </script>";
        }
    }
?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Login - Raices Artesanales </title>
        <!--acabo de aumentar esto-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    </head>
    <body class="vh-100" style="background-color: #9df199;">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container py-5 h-100">
             <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col col-xl-10">
            <div class="container py-5">
                <div class="row h-100 justify-content-center align-items-center">
                    <div class="col-md-6 col-lg-5 d-none d-md-block d-flex justify-content-center align-items-center">
                        <img src="./img/logo.png" alt="login form" class="img-fluid" style="border-radius: 1rem 0 0 1rem;" />
                    </div>
                    <div class="col-md-6 col-lg-7 d-flex align-items-center">

                        <div class="card-body p-4 p-lg-5 text-black">
      
                            <form method="POST" action="<?php echo $_SERVER['PHP_SELF'];?>"><!--para el formulario se envie asi mismo y se vuelva a cargar-->
      
                            <div class="d-flex align-items-center mb-3 pb-1">
                            <i class="fa-brands fa-shopify fa-2x me-3" style="color: #000000;"></i>
                            <h2>INICIAR SESIÓN</h2>
                            </div>
                            <h6 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Bienvenido, estamos felices de que estes aqui! :)</h6>
                            <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Iniciar sesión en su cuenta</h5>
        
                            <div class="form-outline mb-4">
                                <input class="form-control form-control-lg" id="inputEmail" name="usuario" type="text" />
                                <!--en imput se agrega name para trabajar con POST-->
                                <label class="form-label" for="inputEmail">Usuario</label>
                            </div>
        
                            <div class="form-outline mb-4">
                                <input class="form-control form-control-lg" id="inputPassword" name="password" type="password" />
                                <!--agregamos name = password-->
                                <span id="togglePassword" class="password-toggle" onclick="togglePasswordVisibility()">
                                    <i id="passwordIcon" class="fas fa-eye"></i> <!-- Font Awesome icon for an eye -->
                                </span>

                                <label class="form-label" for="inputPassword">Password</label>
                            </div>
        
                            <div class="pt-1 mb-4">
                                <!--combiamos este botos y le quitamos el la redireccion html esto era antes (a)(/a)-->
                                <button class="btn btn-primary btn-lg btn-block" type="submit">Acceder</button>
                            </div>
        
                            <a class="small" href="recuperar.php">¿Has olvidado tu contraseña?</a>
                            <p class="mb-5 pb-lg-2" style="color: #393f81;">¿No tienes una cuenta? <a href="formulariousu.php" >Registrar aquí</a></p>
                            <a href="#!" class="small text-muted">Terminos y Condiciones.</a>
                            <a href="#!" class="small text-muted">Politica de Privacidad</a>
                        </form>
        
                        </div>
                    </div>
                    </div>
                    
                </div>
                </div>
            </div>
            </div>
            
                    </main>
                </div>
                <div id="layoutAuthentication_footer">
                    <footer class="py-4 bg-light mt-auto">
                        <div class="container-fluid px-4">
                            <div class="d-flex align-items-center justify-content-between small">
                                <div class="text-muted">Raíces Artesanales &copy;  2024</div>
                                <div>
                                    <a href="#">Politica de privacidad</a>
                                    &middot;
                                    <a href="#">Terminos &amp; Condiciones</a>
                                </div>
                            </div>
                        </div>
                    </footer>
                </div>
            </div>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
            <script src="js/scripts.js"></script>
            <script>
                function togglePasswordVisibility() {
                    const passwordInput = document.getElementById("inputPassword");
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
            </script>
        </body>
    </html>
