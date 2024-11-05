<?php
session_start();
// Incluye los archivos de PHPMailer manualmente
require 'C:/xampp/htdocs/INF281/PHPMailer/src/Exception.php';
require 'C:/xampp/htdocs/INF281/PHPMailer/src/PHPMailer.php';
require 'C:/xampp/htdocs/INF281/PHPMailer/src/SMTP.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require "conexion.php";
// Obtener los valores del formulario
$nom = $_POST['nombre'];
$ci = $_POST['ci'];
$tel = $_POST['telefono'];
$cor = $_POST['email'];
$usu = $_POST['usuario'];
$pas = $_POST['password'];
$confirm_password = $_POST['confirm_password'];
$typeUsu = $_POST['rol'];
// Validar el rol del usuario
switch ($typeUsu) {
    case "Administrador":
        $typeUsu = 1;
        break;
    case "Artesano":
        $typeUsu = 2;
        break;
    case "Comprador":
        $typeUsu = 3;
        break;
    case "Delivery":
        $typeUsu = 4;
        break;
    default:
        echo "<script>alert('Rol no válido'); window.location.href='formulariousu.php';</script>";
        exit;
}
// Validar que las contraseñas coincidan
if ($pas !== $confirm_password) {
    echo "<script>alert('Las contraseñas no coinciden.'); window.location.href='formulariousu.php';</script>";
    exit;
}
// Validar que la contraseña tenga al menos un símbolo
if (!preg_match('/[!@#$%^&*]/', $pas)) {
    echo "<script>alert('La contraseña debe tener al menos un símbolo (!@#$%^&*).'); window.location.href='formulariousu.php';</script>";
    exit;
}
// Encriptar la contraseña
$contrasena_encriptada = sha1($pas);
// Insertar el nuevo usuario en la base de datos
$consulta = "INSERT INTO usuario (nombre, email, contraseña, CI, telefono, Usuario, tipo_idtipo)  
             VALUES ('$nom', '$cor', '$contrasena_encriptada', '$ci', '$tel', '$usu', $typeUsu)";
// Ejecutar la consulta y verificar errores
if ($res = mysqli_query($mysqli, $consulta)) {
    // Si la inserción fue exitosa
    $numeroAleatorio = rand(100000, 999999);
    $_SESSION['numAleatorio'] = $numeroAleatorio;
    // Enviar correo de confirmación usando PHPMailer
    $mail = new PHPMailer(true);
    try {
        // Configuración del servidor SMTP
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'ltorrezq2@fcpn.edu.bo';
        $mail->Password = 'tejn povp rblw xntm';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;
        // Destinatarios
        $mail->setFrom('ltorrezq2@fcpn.edu.bo', 'Registro de Usuario');
        $mail->addAddress($cor);  // Dirección del destinatario
        // Contenido del correo
        $mail->isHTML(true);
        $mail->Subject = 'Confirmación de registro';
        $mail->Body = 'Gracias por registrarte! Tu número de inicio de sesión es: ' . $numeroAleatorio;
        $mail->send();
        echo "<script>
            alert('Correo de inicio de sesión enviado.');
            window.location.href='validar.php';
        </script>";
    } catch (Exception $e) {
        echo "El mensaje no pudo ser enviado. Error de Mailer: {$mail->ErrorInfo}";
    }
} else {
    // Mostrar mensaje de error específico si la consulta falla
    echo "<script>
        alert('Error al registrar el usuario: " . mysqli_error($mysqli) . "');
        window.location.href='formulariousu.php';
    </script>";
}
?>